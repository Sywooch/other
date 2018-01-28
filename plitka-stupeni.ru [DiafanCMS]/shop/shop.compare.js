$(document).ready(function() {
    $('.compare_all').click(function(){
		$('.shop_param, .shop_param_existed').show();
		return false;
    });

    $('.compare_difference').click(function(){
        $('.shop_param, .shop_param_existed').hide();
        $('.shop_param.shop_param_difference, .shop_param_existed.shop_param_difference').show();
        return false;
    });

	compare_height();

    $(".default .jCarouselLite").jCarouselLite({
        btnNext: ".default .next",
        btnPrev: ".default .prev",
        circular:false
    });

	$(document).ajaxComplete(function(request, settings){
		setTimeout('compare_height()', 100);
	});

	$(".shop_form .depend_param").change(function() {
		setTimeout('compare_height()', 100);
	});
});

function compare_height()
{
	$('.shop_basic, .shop_compare_description, .shop_compare_param, .shop_existed_params, .shop').height('');
	var max_height_shop_basic = 0;
	var max_height_shop_compare_param = 0;
	var height = [];
	$('.shop_compare_param, .shop_existed_params').each(function(){
		var i = 0;
		$(this).find('.shop_param, .shop_param_existed').each(function(){
			var h = $(this).height();
			if(! height[i])
			{
				height.push(h);
			}
			else
			{
				if(height[i] < h)
				{
					height[i] = h;
				}
			}
			i = i+1;
		});
	});
	i = 0;
	$('.shop_compare_param, .shop_existed_params').each(function(){
		i = 0;
		$(this).find('.shop_param, .shop_param_existed').each(function(){
			$(this).height(height[i]);
			i = i+1;
		});
	});
	$('.shop_basic, .shop_compare_description').each(function(){
		if($(this).height() > max_height_shop_basic)
		{
			max_height_shop_basic = $(this).height();
		}
	});
	$('.shop_basic, .shop_compare_description').height(max_height_shop_basic);
	$('.shop_compare_param').each(function(){
		if($(this).height() > max_height_shop_compare_param)
		{
			max_height_shop_compare_param = $(this).height();
		}
	});
	$('.shop_compare_param').height(max_height_shop_compare_param);
}