$(document).ready(function() {
	$(".shop_search_ajax").live('submit', function () {
		if(! $(".shop_list").length)
		{
			return true;
		}
		$('input[type=submit]', this).attr('disabled', 'disabled');
		$(this).find("input[name='module_ajax']").val('shop');
		$(this).ajaxSubmit({
			dataType:'html',
			success:function (response, statusText, xhr, form) {
				$('input[type=submit]', form).removeAttr('disabled');
				 $(this).find("input[name='module_ajax']").val('');
				 var k = 0;
				$(".shop_list").each(function(){
					if(! k)
					{
						$(this).html(prepare(response)).focus();
					}
					else
					{
						$(this).remove();
					}
					k++;
				});
				return false;
			}
		});
		return false;
	});
	$('.shop_search form').each(function(){
		if($(this).find('.shop_search_cat_ids select').length)
		{
			shop_select_search_cat_id($(this), $(this).find('.shop_search_cat_ids select').val());
		}
		if($(this).find('.shop_search_site_ids select').length)
		{
			shop_select_search_site_id($(this), $(this).find('.shop_search_site_ids select').val());
		}
	});
	$('.shop_search_cat_ids select').change(function(){
		shop_select_search_cat_id($(this).parents('form'), $(this).val());
	});
	$('.shop_search_site_ids select').change(function(){
		shop_select_search_site_id($(this).parents('form'), $(this).val());
	});
});
function shop_select_search_site_id(form, site_id)
{
	form.attr('action', form.find('.shop_search_site_ids select option:selected').attr('path'));
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
		shop_select_search_cat_id(form, cat_id);
	}
	
}
function shop_select_search_cat_id(form, cat_id)
{
	form.find('.shop_search_param').each(function(){
		var cat_ids = $(this).attr('cat_ids').split(',');
		if(cat_ids == cat_id || cat_ids == 0 || $.inArray(0, cat_ids) > 1 || $.inArray(cat_id, cat_ids) > -1)
		{
			$(this).show();
		}
		else
		{
			$(this).hide();
		}
	});
}