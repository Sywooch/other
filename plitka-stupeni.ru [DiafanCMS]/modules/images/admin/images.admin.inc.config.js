var resize_count = 0;
$(document).ready(function(){
	$('#images_variations, #images_variations_cat').each(function(){
		show_delete_images_variation($(this));
		if($(this).find(".images_variation").length == $(this).find(".images_variation").first().find('select option').length + 1)
		{
			$(this).find('.images_variation_plus').hide();
		}
	});
	$('.images_variation_plus').click(function(){
		var contaner = $(this).parents('#images_variations, #images_variations_cat');
		var last = contaner.find(".images_variation").last();
		if(contaner.find(".images_variation").length >= last.find('select option').length + 1)
		{
			return false;
		}
		last.before(last.clone(true));
		last = last.prev('.images_variation');
		last.show().find("select, input").val('');
		last.find('input').attr('name', str_replace('hide_', '', last.find('input').attr('name'), 1));
		show_delete_images_variation(contaner);
		if(contaner.find(".images_variation").length == last.find('select option').length + 1)
		{
			contaner.find('.images_variation_plus').hide();
		}
	});
	$('.images_variation_delete').live('click', function(){
		var contaner = $(this).parents('#images_variations, #images_variations_cat');
		if(contaner.find('.images_variation').length == 1)
		{
			return false;
		}
		if(! confirm($(this).attr('confirm')))
		{
			return false;
		}
		$(this).parents('.images_variation').remove();
		show_delete_images_variation(contaner);
		contaner.find('.images_variation_plus').show();
	});

	$("#resize input[type=button]").live('click', function() {
		var self = $(this);
		if (!resize_count && self.attr("confirm") && ! confirm(self.attr("confirm")))
		{
			return false;
		}
		var data = $('#save').serializeArray();
		$('.images_loading_resize').show();
		data.push({name: 'action', value: 'resize'});
		data.push({name: 'module', value: 'images'});
		data.push({name: 'resize_count', value: resize_count});
		$.ajax({
			url : window.location.href,
			type : 'POST',
			dataType : 'json',
			data : data,
			success : (function(response)
			{
				if (response.hash)
				{
					$('input[name=check_hash_user]').val(response.hash);
					$('.check_hash_user').text(response.hash);
				}
				if (response.error)
				{
					if(response.error == 'next')
					{
						resize_count += 30;
						$("#resize input[type=button]").click();
					}
					else
					{
						alert(response.error);
						$('.images_loading_resize').hide();
						resize_count = 0;
					}
				}
			})
		});
		return false;
	});
});

function show_delete_images_variation(contaner)
{
	if(contaner.find('.images_variation').length == 1)
	{
		contaner.find('.images_variation_delete').hide();
	}
	else
	{
		contaner.find('.images_variation_delete').show();
	}
}