$(document).ready(function(){
	$(".shop_clone").live('click', function () { 
		$.ajax({
			url : window.location.href,
			type : 'POST',
			dataType : 'json',
			data : {
				action: 'clone_good',
				module: 'shop',
				id:$(this).attr('rel'),
				check_hash_user : $('.check_hash_user').text()
			},
			success : (function(response)
			{
				alert('Товар склонирован в список товаров с приставкой КОПИЯ');
			})
		});
	});
	$('.fast_edit_price a').live('click', function(){
		if($(this).text() == '↓')
		{
			$(this).text('↑');
		}
		else
		{
			$(this).text('↓');
		}
		$(this).parents('.fast_edit_price').find('div').toggle();
		return false;
	});

	$(".param").live('mouseover', function(){
		$(this).addClass("hover");
		$(this).find(".param_actions").show();
	});
	$(".param").live('mouseout', function(){
		$(this).removeClass("hover");
		$(this).find(".param_actions").hide();
	});
	$(".param_actions a").live('click', function() {
		var self = $(this);
		if (! self.attr("action"))
		{
			return true;
		}
		if (self.attr("confirm") && ! confirm(self.attr("confirm")))
		{
			return false;
		}
		if (! self.parents(".param").find(".param_id").length)
		{
			if (self.attr("action") == "delete_param")
			{
				self.parents(".param").remove();
			}
			return false;
		}
		return false;
	});
    
	$('.param_plus').click(function() {
        $('.param:last').clone(true).appendTo('#param_table');
        $('.param:last .param_id, .param:last .param_actions a[action=down_param], .param:last .param_actions a[action=up_param]').remove();
		$('.param:last input').val('');
		$('.param:last .param_actions a[action=delete_param]').attr('confirm', '');
		$('.param:last .param_image_rel_actions span').text('');
	});

    change_param();
	$("select[name=cat_id], select[name='cat_ids[]']").change(change_param);
	
	$(".delete_file").click(function(){
		$('input[name=delete_attachment]').val('1');
		$(this).parents('.attachment').remove();
		return false;
	});

	$('input[name=depend_price]').click(function(){
		if($(this).attr('checked'))
		{
			$("select[name='hide_param_value"+$(this).attr('rel')+"[]']").attr('name', 'param_value'+$(this).attr('rel')+'[]');
			$("select[name='param"+$(this).attr('rel')+"[]']").hide();
			$(".param_value_td"+$(this).attr('rel')).show();
		}
		else
		{
			$("select[name='param_value"+$(this).attr('rel')+"[]']").attr('name', 'hide_param_value'+$(this).attr('rel')+'[]');
			$("select[name='param"+$(this).attr('rel')+"[]']").show();
			$(".param_value_td"+$(this).attr('rel')).hide();
		}
	});
	$(".add_price_image_rel").live('click', function(){
		$(".add_price_image_rel").attr('current', 'false');
		$(this).attr('current', 'true');
		$('#shop_price_image_rel').remove();
		var shop_price_image_rel = '<div id="shop_price_image_rel"><div class="shop_price_image_rel">';
		$(".images_container0 .images_actions").each(function(){
			shop_price_image_rel += '<img src="'+$(this).find('.image').attr('src')+'" image_id="'+$(this).attr('image_id')+'"> ';
		});
		shop_price_image_rel += '</div></div>';
		$(".images_container0").after(shop_price_image_rel);
		$('#shop_price_image_rel').hide();
		$.prettyPhoto.open("#shop_price_image_rel");
	});
	$(".shop_price_image_rel img").live('click', function(){
		var span = $(".add_price_image_rel[current=true]").prev('span');
		span.find('img').remove();
		span.html('<img src="'+$(this).attr('src')+'">'+span.html()).show();
		$(".add_price_image_rel[current=true]").parents(".param_image_rel_actions").find('input[name="price_image_rel[]"]').val($(this).attr('image_id'));
		$.prettyPhoto.close();
	});
	$(".delete_price_image_rel").live('click', function(){
		$(this).parents('span').find('img').remove();
		$(this).parents('span').hide();
		$(this).parents(".param_image_rel_actions").find('input[name="price_image_rel[]"]').val("");
	});
});

function change_param()
{
	$(".shop_param, .shop_param_td").addClass("hide");
	$(".shop_param[cat0=true], .shop_param_td[cat0=true]").removeClass("hide");
	$(".shop_param[cat"+$('select[name=cat_id]').val()+"=true]").removeClass("hide");
	$(".shop_param_td[cat"+$('select[name=cat_id]').val()+"=true]").removeClass("hide");
	$("select[name='cat_ids[]'] option:selected").each(function(){
		$(".shop_param[cat"+$(this).attr("value")+"=true]").removeClass("hide");
		$(".shop_param_td[cat"+$(this).attr("value")+"=true]").removeClass("hide");
	});

	$('#price').show();
	$('#price_arr').hide();
	$(".shop_param_td").each(function(){
		if(! $(this).is(".hide"))
		{
			$('#price_arr').show();
			$('#price').hide();
		}
	});
}