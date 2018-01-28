$(document).ready(function(){
	show_param_shop_order($("#type select"));
	$("#type select").change(function(){
		show_param_shop_order($(this));
	});
});
function show_param_shop_order(obj)
{
	if (obj.val() == "attachments")
	{
		$("#show_in_form_register_number").hide();
	}
	else
	{
		$("#show_in_form_register_number").show();
	}
}