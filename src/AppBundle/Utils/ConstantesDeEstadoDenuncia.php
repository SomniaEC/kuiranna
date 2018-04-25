<?php

namespace AppBundle\Utils;

abstract class ConstantesDeEstadoDenuncia extends ConstantesAbstractas {
	const Validar = "Por Validar";
	const Avocar_Conocimiento = "Por Avocar Conocimiento";
	const Enviar_Notificacion = "Por Enviar Notificacion";
	const Espera_Psicologo = "En Espera del Psicologo";
	const Espera_Audiencia = "En Espera de Audiencia";
	const Archivado = "Archivado";
	const Cerrado = "Cerrado";
}