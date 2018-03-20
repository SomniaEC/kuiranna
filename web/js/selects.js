/**
 * 
 */

function bindSelects ($parentSelect, $childSelect, $optionsArray, $dataName) {
	$parentSelect.change(function() {
		updateSelects ($parentSelect, $childSelect, $optionsArray, $dataName);
		$childSelect.trigger("change");
	});
	updateSelects ($parentSelect, $childSelect, $optionsArray, $dataName)
}

function updateSelects ($parentSelect, $childSelect, $optionsArray, $dataName) {
	var $selectedParent = $parentSelect.find(':selected').attr('data-'+$dataName);
	var $selectedChild = $childSelect.find(':selected').attr('data-'+$dataName);
	$childSelect.empty();
	$.each($optionsArray, function (key, options) {
		if(key === $selectedParent) {
			$.each(options, function (dataValue, value) {
				var option = $('<option>', { 
			        value: value,
			        text : value
			    }).attr('data-'+$dataName, key+dataValue);
				$childSelect.append(option);
				if(key+dataValue === $selectedChild) {
					$childSelect.val(value);
				}
			});
		}
	});
}

function actorSelect ($contenedor) {
	var $rolSelect = $contenedor.find('.rol select');
	var $tipoSelect = $contenedor.find('.tipo select');
	var $elementos = [];
	$elementos['identificacion'] = $contenedor.find('.identificacion');
	$elementos['nombres'] = $contenedor.find('.nombres');
	$elementos['telefono'] = $contenedor.find('.telefono');
	$elementos['email'] = $contenedor.find('.email');
	$elementos['identificacionContacto'] = $contenedor.find('.identificacionContacto');
	$elementos['nombresContacto'] = $contenedor.find('.nombresContacto');
	$elementos['cargoContacto'] = $contenedor.find('.cargoContacto');
	$elementos['emailContacto'] = $contenedor.find('.emailContacto');
	$elementos['telefonoContacto'] = $contenedor.find('.telefonoContacto');
	$elementos['fechaNacimiento'] = $contenedor.find('.fechaNacimiento');
	$elementos['edad'] = $contenedor.find('.edad');
	$elementos['sexo'] = $contenedor.find('.sexo');
	$elementos['genero'] = $contenedor.find('.genero');
	$elementos['nacionalidad'] = $contenedor.find('.nacionalidad');
	$elementos['interculturalidad'] = $contenedor.find('.interculturalidad');
	$elementos['actividadEconomica'] = $contenedor.find('.actividad_economica');
	$elementos['lugarTrabajo'] = $contenedor.find('.lugarTrabajo');
	$elementos['direccionTrabajo'] = $contenedor.find('.direccion_trabajo');
	$elementos['instruccion'] = $contenedor.find('.instruccion');
	$elementos['capacidadEspecial'] = $contenedor.find('.capacidadEspecial');
	$elementos['relacion'] = $contenedor.find('.relacion');
	$rolSelect.change(function() {
		changeActor ($rolSelect, $tipoSelect, $elementos);
	});
	$tipoSelect.change(function() {
		changeActor ($rolSelect, $tipoSelect, $elementos);
	});
	$tipoSelect.trigger("change");
}

function changeActor ($rolSelect, $tipoSelect, $elementos) {
	if($tipoSelect.val() == 'Entidad') {
		$elementos['identificacionContacto'].show();
		$elementos['nombresContacto'].show();
		$elementos['cargoContacto'].show();
		$elementos['emailContacto'].show();
		$elementos['telefonoContacto'].show();
		$elementos['fechaNacimiento'].hide();
		$elementos['edad'].hide();
		$elementos['sexo'].hide();
		$elementos['genero'].hide();
		$elementos['nacionalidad'].hide();
		$elementos['interculturalidad'].hide();
		$elementos['actividadEconomica'].hide();
		$elementos['lugarTrabajo'].hide();
		$elementos['direccionTrabajo'].hide();
		$elementos['instruccion'].hide();
		$elementos['capacidadEspecial'].hide();
		$elementos['relacion'].hide();
	} else {
		$elementos['identificacionContacto'].hide();
		$elementos['nombresContacto'].hide();
		$elementos['cargoContacto'].hide();
		$elementos['emailContacto'].hide();
		$elementos['telefonoContacto'].hide();
		$elementos['fechaNacimiento'].show();
		$elementos['edad'].show();
		$elementos['sexo'].show();
		$elementos['genero'].show();
		$elementos['nacionalidad'].show();
		$elementos['interculturalidad'].show();
		$elementos['actividadEconomica'].show();
		$elementos['lugarTrabajo'].show();
		$elementos['instruccion'].show();
		$elementos['capacidadEspecial'].show();
		$elementos['relacion'].show();
		if($rolSelect.val() == 'Denunciante') {
			$elementos['direccionTrabajo'].show();
		} else {
			$elementos['direccionTrabajo'].hide();
		}
	}
}