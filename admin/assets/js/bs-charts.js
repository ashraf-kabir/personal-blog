$(document).ready(function(){

	$('[data-bs-chart]').each(function(index, elem) {
		var chart = new Chart($(elem), $(elem).data('bs-chart'));
	});

});