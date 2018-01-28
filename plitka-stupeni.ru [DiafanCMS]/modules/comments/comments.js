$(document).ready(function() {
	$('.comments_show_form').live('click', function(){
		$(this).next('div').toggle();
	});
});