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
	var $selectedParent = $parentSelect.find(':selected').data($dataName);
	var $selectedChild = $childSelect.find(':selected').data($dataName);
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