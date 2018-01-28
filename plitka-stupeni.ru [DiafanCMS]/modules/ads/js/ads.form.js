$(document).ready(function() {
	$('.ads_form').each(function(){
		if($(this).find('.ads_form_cat_ids select').length)
		{
			ads_select_form_cat_id($(this), $(this).find('.ads_form_cat_ids select').val());
		}
		if($(this).find('.ads_form_site_ids select').length)
		{
			ads_select_form_site_id($(this), $(this).find('.ads_form_site_ids select').val());
		}
	});
	$('.ads_form_cat_ids select').change(function(){
		ads_select_form_cat_id($(this).parents('form'), $(this).val());
	});
	$('.ads_form_site_ids select').change(function(){
		ads_select_form_site_id($(this).parents('form'), $(this).val());
	});
});
function ads_select_form_site_id(form, site_id)
{
	form.attr('action', form.find('.ads_form_site_ids select option:selected').attr('path'));
	if(! form.find('select[name=cat_id]').length)
	{
		return;
	}
	var current_cat_id = form.find('select[name=cat_id] option:selected');
	if(current_cat_id.attr('site_id') != site_id)
	{
		form.find('select[name=cat_id] option').hide();
		form.find('select[name=cat_id] option[site_id='+site_id+']').show();
		var cat_id = form.find('select[name=cat_id] option[site_id='+site_id+']').first().attr('value');
		form.find('select[name=cat_id]').val(cat_id);
		ads_select_form_cat_id(form, cat_id);
	}
	
}
function ads_select_form_cat_id(form, cat_id)
{
	form.find('.ads_form_param').each(function(){
		var cat_ids = $(this).attr('cat_ids').split(',');
		if(cat_ids == cat_id || cat_ids == 0 || $.inArray(0, cat_ids) > 1 || $.inArray(cat_id, cat_ids) > 1)
		{
			$(this).show();
		}
		else
		{
			$(this).hide();
		}
	});
}