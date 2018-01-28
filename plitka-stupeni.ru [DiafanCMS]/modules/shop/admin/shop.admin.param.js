$(document).ready(function(){
	show_param_shop($("#type select"));
	$("#type select").change(function(){
		show_param_shop($(this));
	});
	$('#attachments_access_admin').remove();
});
function show_param_shop(obj)
{
	if (obj.val() == "multiple")
	{
		$("#required").show();
	}
	else
	{
		$("#required").hide();
	}
	if (obj.val() == "select" || obj.val() == "multiple")
	{
		$("#page").show();
	}
	else
	{
		$("#page").hide();
	}
	if(obj.val() == 'textarea' || obj.val() == 'select' || obj.val() == 'multiple' || obj.val() == 'editor' || obj.val() == 'title')
	{
		$('#display_in_sort').hide();
	}
	else
	{
		$('#display_in_sort').show();
	}

	if(obj.val() == 'numtext')
	{
		$('#measure_unit').show();
	}
	else
	{
		$('#measure_unit').hide();
	}
}