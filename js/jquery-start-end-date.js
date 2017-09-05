$(function(){

	var startDateTextBox = $('#term_start');
	var endDateTextBox = $('#term_end');

	startDateTextBox.datepicker({ 
		dateFormat: 'dd/mm/yy',
		yearRange: "-100:+0", 
		changeMonth: true,
		changeYear: true,
		onClose: function(dateText, inst) {
			if (endDateTextBox.val() != '') {
				var startDate = startDateTextBox.datetimepicker('getDate');
				var endDate = endDateTextBox.datetimepicker('getDate');
				if (startDate > endDate)
					endDateTextBox.datetimepicker('setDate', startDate);
			}
			else {
				endDateTextBox.val(dateText);
			}
		},
		onSelect: function (selectedDateTime){
			endDateTextBox.datetimepicker('option', 'minDate', startDateTextBox.datetimepicker('getDate') );
		}
	});
	endDateTextBox.datepicker({ 
		dateFormat: 'dd/mm/yy',
		yearRange: "-100:+0", 
		changeMonth: true,
		changeYear: true,
		onClose: function(dateText, inst) {
			if (startDateTextBox.val() != '') {
				var startDate = startDateTextBox.datetimepicker('getDate');
				var endDate = endDateTextBox.datetimepicker('getDate');
				if (startDate > endDate)
					startDateTextBox.datetimepicker('setDate', endDate);
			}
			else {
				startDateTextBox.val(dateText);
			}
		},
		onSelect: function (selectedDateTime){
			startDateTextBox.datetimepicker('option', 'maxDate', endDateTextBox.datetimepicker('getDate') );
		}
	});

});