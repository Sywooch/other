$(document).ready(function() {
	$(".shop_form .depend_param").change(function() {
		select_param_price($(this).parents('form'));
	});
	$(".shop_form").each(function() {
		select_param_price($(this));
	});
	$("input[action=buy]").click(function() {
		$(this).parents('form').find('input[name=action]').val('buy');
		$(this).parents('form').submit();
	});
	$("input[action=wish]").click(function() {
		$(this).parents('form').find('input[name=action]').val('wish');
		$(this).parents('form').submit();
	});
	$("input[action=wait]").click(function() {
		$(this).parents('form').find('input[name=action]').val('wait');
		$(this).parents('form').submit();
	});
	
	$('.shop_compare_contaner').click(function(){
		$(this).find('.shop_compare_button').click();
	});
	
	$('.shop_compare_button').click(function(){
		var shop_compare_form = $(this).parents('form');
		var shop_compare_add = shop_compare_form.find('input[name=shop_compare_add]');
		var shop_compare_contaner = $(this).parents('.shop_compare_contaner');
		if($(shop_compare_add).val() == 1)
		{
			$(shop_compare_add).val(0);
			$(shop_compare_contaner).removeClass('shop_compare_checked');
			
		}
		else
		{
			$(shop_compare_add).val(1);
			$(shop_compare_contaner).addClass('shop_compare_checked');
		}
		shop_compare_form.find("input[name='ajax']").val('1');
		shop_compare_form.ajaxSubmit({
			dataType: 'json',
			success: function(response, statusText, xhr, form)
			{
				if(response.shop_compare_id)
				{
					if(response.shop_compare_add)
					{
						 //добавляем в форму скрытое поле с id товара
						 $('.shop_compared_goods_list').each(function(){
							 $(this).append(prepare(response.shop_compare_input));
						 });
					}
					else
					{
						 //удаляем скрытое поле с id товара
						$('.shop_compared_goods_list').each(function(){
							$(this). find('.shop_compared_goods_'+response.shop_compare_id).remove();
						});
						
						//удаляем товар со страницы для сравнения
						$('.shop_compare_page').each(function(){
							$(this). find('.shop_compared_goods_'+response.shop_compare_id).remove();
							if($(this).find('.shop').length < 4)
							{
								$('.prev').remove();
								$('.next').remove();
							}
						});
					}
				}
				return false;
			}
		});
		return false;
	});
});
function select_param_price(th)
{
	var param_code = '';
	th.find(".depend_param").each(function(){
		param_code = param_code + '['+$(this).attr('name')+'='+$(this).val()+']';
	});
	if(th.find('.shop_param_price').length)
	{
		th.find('.shop_param_price').hide();
		if(th.find('.shop_param_price'+param_code).length)
		{
			th.find('.shop_param_price'+param_code).show();
			var image_id = th.find('.shop_param_price'+param_code).attr('image_id');
			if(image_id)
			{
				th.parents('.shop_id, .shop, .shop_rel, .shop_order_rel').find('.shop_img img, .shop_all_img img').each(function(){
					if($(this).attr('image_id') == image_id)
					{
						$(this).show();
					}
					else
					{
						if(th.find('.shop_param_price[image_id='+$(this).attr('image_id')+']').length)
						{
							$(this).hide();
						}
					}
				});
			}
			if(th.find('.shop_param_price'+param_code).find('.shop_no_buy').length)
			{
				th.find('.shop_waitlist').show();
				th.find('.button_wrap input[type=submit]').parents('.button_wrap').hide();
				if(! th.find('.button_wrap input[action=wish]').length)
				{
					th.find('input[name=count]').hide();
				}
			}
			else
			{
				if(th.find('.shop_no_buy_good').length)
				{
					th.find('.shop_waitlist').show();
				}
				else
				{
					th.find('.shop_waitlist').hide();
				}
				th.find('.button_wrap input[type=submit]').parents('.button_wrap').show();
				th.find('input[name=count]').show();
			}
			th.find('.button_wrap input[action=wish]').parents('.button_wrap').show();
		}
		else
		{
			th.parents('.shop_id, .shop, .shop_rel, .shop_order_rel').find('.shop_img img, .shop_all_img img').each(function(){
				if(th.find('.shop_param_price[image_id='+$(this).attr('image_id')+']').length)
				{
					$(this).hide();
				}
			});
			th.find('.button_wrap input[type=submit]').parents('.button_wrap').hide();
			th.find('.button_wrap input[action=wish]').parents('.button_wrap').hide();
			th.find('input[name=count]').hide();
			th.find('.shop_waitlist').hide();
		}
	}
}