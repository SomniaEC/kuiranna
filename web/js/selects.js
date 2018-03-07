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
	$elementos['identificacion_contacto'] = $contenedor.find('.identificacion_contacto');
	$elementos['nombres_contacto'] = $contenedor.find('.nombres_contacto');
	$elementos['cargo_contacto'] = $contenedor.find('.cargo_contacto');
	$elementos['email_contacto'] = $contenedor.find('.email_contacto');
	$elementos['telefono_contacto'] = $contenedor.find('.telefono_contacto');
	$elementos['fecha_nacimiento'] = $contenedor.find('.fecha_nacimiento');
	$elementos['edad'] = $contenedor.find('.edad');
	$elementos['sexo'] = $contenedor.find('.sexo');
	$elementos['genero'] = $contenedor.find('.genero');
	$elementos['nacionalidad'] = $contenedor.find('.nacionalidad');
	$elementos['interculturalidad'] = $contenedor.find('.interculturalidad');
	$elementos['actividad_economica'] = $contenedor.find('.actividad_economica');
	$elementos['lugar_trabajo'] = $contenedor.find('.lugar_trabajo');
	$elementos['direccion_trabajo'] = $contenedor.find('.direccion_trabajo');
	$elementos['instruccion'] = $contenedor.find('.instruccion');
	$elementos['capacidad_especial'] = $contenedor.find('.capacidad_especial');
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
		$elementos['identificacion_contacto'].show();
		$elementos['nombres_contacto'].show();
		$elementos['cargo_contacto'].show();
		$elementos['email_contacto'].show();
		$elementos['telefono_contacto'].show();
		$elementos['fecha_nacimiento'].hide();
		$elementos['edad'].hide();
		$elementos['sexo'].hide();
		$elementos['genero'].hide();
		$elementos['nacionalidad'].hide();
		$elementos['interculturalidad'].hide();
		$elementos['actividad_economica'].hide();
		$elementos['lugar_trabajo'].hide();
		$elementos['direccion_trabajo'].hide();
		$elementos['instruccion'].hide();
		$elementos['capacidad_especial'].hide();
		$elementos['relacion'].hide();
	} else {
		$elementos['identificacion_contacto'].hide();
		$elementos['nombres_contacto'].hide();
		$elementos['cargo_contacto'].hide();
		$elementos['email_contacto'].hide();
		$elementos['telefono_contacto'].hide();
		$elementos['fecha_nacimiento'].show();
		$elementos['edad'].show();
		$elementos['sexo'].show();
		$elementos['genero'].show();
		$elementos['nacionalidad'].show();
		$elementos['interculturalidad'].show();
		$elementos['actividad_economica'].show();
		$elementos['lugar_trabajo'].show();
		$elementos['instruccion'].show();
		$elementos['capacidad_especial'].show();
		$elementos['relacion'].show();
		if($rolSelect.val() == 'Denunciante') {
			$elementos['direccion_trabajo'].show();
		} else {
			$elementos['direccion_trabajo'].hide();
		}
	}
}