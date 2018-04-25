<?php

namespace AppBundle\Utils;

abstract class ConstantesDeRolUsuario extends ConstantesAbstractas {
	const Secretario = "ROLE_SECRETARIO";
	const Miembro_Junta = "ROLE_MIEMBRO_DE_JUNTA";
	const Psicologo = "ROLE_PSICOLOGO";
	const Administrador_Junta = "ROLE_ADMIN_JUNTA";
	const Super_Admin = "ROLE_SUPER_ADMIN";
}
