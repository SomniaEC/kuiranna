<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Validator\Constraints\Date;
use Doctrine\ORM\EntityManager;
use AppBundle\Utils\Constantes;
use AppBundle\Utils\ConstantesDeRolUsuario;
use AppBundle\Utils\ConstantesDeEstadoDenuncia;

class DefaultController extends Controller {
	/**
	 * @Route("/", name="homepage")
	 */
	public function indexAction(Request $request) {
		$rol = $request->getSession ()->get ( 'user_rol' );
		if (! $this->get ( 'security.authorization_checker' )->isGranted ( 'IS_AUTHENTICATED_FULLY' ) || $rol == null || $rol == ConstantesDeRolUsuario::Super_Admin || $rol == ConstantesDeRolUsuario::Administrador_Junta) {
			return $this->render ( 'default/index.html.twig', [ 
					'base_dir' => realpath ( $this->getParameter ( 'kernel.root_dir' ) . '/..' ) . DIRECTORY_SEPARATOR 
			] );
		} else {
			$usuario = $this->getUser ();
			/* @var $em EntityManager */
			$em = $this->getDoctrine ()->getManager ();
			$queryBuilder = $em->getRepository ( 'AppBundle:Denuncia' )->createQueryBuilder ( 'd' )->leftJoin ( 'd.responsable', 'usuario' );
			$resumen = array();
			
			if ($rol == ConstantesDeRolUsuario::Miembro_Junta) {
				$queryBuilder->where ( 'd.estadoOperacion NOT IN (:noEstadoOperacion)' );
				$queryBuilder->andWhere ( 'd.responsable = :responsable' );
				$queryBuilder->setParameter ( 'responsable', $usuario );
				$queryBuilder->setParameter ( 'noEstadoOperacion', array (
						ConstantesDeEstadoDenuncia::Cerrado,
						ConstantesDeEstadoDenuncia::Archivado,
						ConstantesDeEstadoDenuncia::Espera_Psicologo 
				) );
			} elseif ($rol == ConstantesDeRolUsuario::Secretario) {
				$queryBuilder->where ( 'd.estadoOperacion NOT IN (:noEstadoOperacion)' );
				$queryBuilder->andWhere ( 'd.junta = :junta' );
				$queryBuilder->setParameter ( 'junta', $usuario->getJunta () );
				$queryBuilder->setParameter ( 'noEstadoOperacion', array (
						ConstantesDeEstadoDenuncia::Cerrado,
						ConstantesDeEstadoDenuncia::Archivado 
				) );
				//resumen
				$queryResumen = $em->getRepository ( 'AppBundle:Denuncia' )->createQueryBuilder ( 'd' )->innerJoin ( 'd.responsable', 'usuario' );
				$queryResumen->select('usuario.username, count(d.id)');
				$queryResumen->where ( 'd.estadoOperacion NOT IN (:noEstadoOperacion)' );
				$queryResumen->andWhere ( 'd.junta = :junta' );
				$queryResumen->andWhere ( 'usuario.rol = :rol' );
				$queryResumen->setParameter ( 'noEstadoOperacion', array (
						ConstantesDeEstadoDenuncia::Cerrado,
						ConstantesDeEstadoDenuncia::Archivado
				) );
				$queryResumen->setParameter ( 'junta', $usuario->getJunta () );
				$queryResumen->setParameter ( 'rol', ConstantesDeRolUsuario::Miembro_Junta );
				$queryResumen->addGroupBy('usuario.username');
				$asignados = $queryResumen->getQuery()->getResult();
				
				$queryResueltos = $em->getRepository ( 'AppBundle:Usuario' )->createQueryBuilder ( 'u' )
				->leftJoin ( 'AppBundle:Denuncia', 'd', 'WITH', 'u.id = d.responsable AND d.estadoOperacion IN (:estadoOperacion) AND d.creacion >= :fecha');
				$queryResueltos->select('u.username, COUNT(d.id)');
				$queryResueltos->addGroupBy('u.username');
				$queryResueltos->andWhere ( 'u.rol = :rol' );
				$queryResueltos->andWhere ( 'u.junta = :junta' );
				$queryResueltos->setParameter ( 'estadoOperacion', array (
						ConstantesDeEstadoDenuncia::Cerrado,
						ConstantesDeEstadoDenuncia::Archivado
				) );
				$queryResueltos->setParameter ('fecha', (new \DateTime())->sub(new \DateInterval(Constantes::TIEMPO_RESUELTOS)));
				$queryResueltos->setParameter ( 'rol', ConstantesDeRolUsuario::Miembro_Junta );
				$queryResueltos->setParameter ( 'junta', $usuario->getJunta () );
				$resueltos = $queryResueltos->getQuery()->getResult();
				
				foreach($resueltos as $resuelto) {
					$row = null;
					foreach ($asignados as $asignado) {
						if($resuelto['username'] == $asignado['username']) {
							$row = array($resuelto['username'], $asignado["1"], $resuelto["1"]);
							break;
						}
					}
					if($row == null) {
						$row = array($resuelto['username'], "0", $resuelto["1"]);
					}
					array_push($resumen, $row);
				}

			} elseif ($rol == ConstantesDeRolUsuario::Psicologo) {
				$queryBuilder->Where ( 'd.junta = :junta' );
				$queryBuilder->andWhere ( 'd.estadoOperacion = :estadoOperacion' );
				$queryBuilder->setParameter ( 'junta', $usuario->getJunta () );
				$queryBuilder->setParameter ( 'estadoOperacion', ConstantesDeEstadoDenuncia::Espera_Psicologo );
			}
			
			$queryBuilder->orderBy ( 'd.creacion', 'ASC' );
			$denuncias = $this->get('knp_paginator')->paginate(
				$queryBuilder->getQuery(),
				$request->query->getInt('page', 1),
				$request->query->getInt('limit', Constantes::ELEMENTOS_PAG_HOME)
			);
			return $this->render ( 'home/home.html.twig', array_merge ( array (
					'denuncias' => $denuncias,
					'hoy' => new \DateTime (),
					'rol' => $usuario->getRol (),
					'resumenes' => $resumen
			) ) );
		}
	}
}
