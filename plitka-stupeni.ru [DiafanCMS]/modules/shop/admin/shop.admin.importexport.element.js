$(document).ready(function(){
    $('.shop_import_button').click(function(){
        var value = $(this).attr('rel');
        $('input[name="action"]').val(value);
    });
	$('select[name=cat_id]').change(check_type_cat);
	$('select[name=type]').change(check_type);
	$('select[name=param_id]').change(check_param);
	check_type_cat();
});
function check_type_cat()
{
	var type = $('select[name=cat_id] option:selected').attr('type');
	$('select[name=type] option').each(function(){
		if($(this).attr(type))
		{
			$(this).show();
		}
		else
		{
			$(this).hide();
		}
	});
	if(type == 'good')
	{
		$("select[name=param_type] option[value=article]").show();
	}
	else
	{
		$("select[name=param_type] option[value=article]").hide();
	}
	check_type();
}
function check_type()
{
	$('.params').hide();
	$('.param_'+$('select[name=type]').val()).show();
	check_param();
}
function check_param()
{
	if($('select[name=type]').val() == 'param' && ($('select[name=param_id] option:selected').attr("type") == 'select' || $('select[name=param_id] option:selected').attr("type") == 'multiple'))
	{
		$('#param_select_type').show();
	}
	else
	{
		$('#param_select_type').hide();
	}
}