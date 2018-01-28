$(document).ready(function() {
	$('.useradmin_form').live('submit', function(){
		$(this).ajaxSubmit({
			dataType: 'json',
			success: function()
			{
				window.parent.location.reload(true);
			}
		});
		return false;
	});
});