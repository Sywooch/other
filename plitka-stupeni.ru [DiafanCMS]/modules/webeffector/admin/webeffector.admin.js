$(document).ready(function(){
	$("form input[type=button]").click(function(){
		if ($(this).attr("confirm") && !confirm($(this).attr("confirm")))
		{
			return false;
		}
		$(this).parents('form').find('input[name=action]').val($(this).attr('action'));
		$(this).parents('form').submit();
	});
	$('#webeffector_select_all').click(function () {
		var c = $(this).attr('checked') ? 'checked' : null;
		$(this).parents('table').find("input[type=checkbox]").attr('checked', c);
	});
});