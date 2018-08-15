<?php

namespace AppBundle\Utils;

abstract class ConstantesDeEstadoDenuncia extends ConstantesAbstractas {
	const Asignar_Miembro = "Asignar Miembro";
	const Validar = "Por Validar";
	const Avocar_Conocimiento = "Por Avocar Conocimiento";
	const Enviar_Notificacion = "Por Enviar Notificacion";
	const Esperando_Psicologo = "Esperando del Psicologo";
	const Esperando_Audiencia = "Esperando de Audiencia";
	const Archivado = "Archivado";
	const Cerrado = "Cerrado";
}