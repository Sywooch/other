$(document).ready(function () {
	$(".diafan_errors").on('click', 'td.calls', function () {
		$(this).children('div').toggle();
	});
});