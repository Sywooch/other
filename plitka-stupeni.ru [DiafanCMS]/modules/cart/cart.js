$(document).ready(function(){
    	//$('.cart_table_form input[type=submit]').hide();
    	//$('.cart_table_form input[type=text]').live('change', cart_submit);
    	//$('.cart_table_form input[type=checkbox], .cart_table_form input[type=radio]').live('click', cart_submit);
    	//$('.cart_table_form input[type=checkbox], .cart_table_form input[type=radio]').live('change', cart_submit);
    $('.cart_table_form').live('submit', function(){cart_submit();return false});
    $('.cart_remove span').live('click', function(){
	$(this).find('input').attr('checked', 'checked');
	cart_submit();
    });
    $('.cart_count_minus').live('click', function(){
	var count = $(this).parents('.cart_count').find('input');
	if(count.val() > 1)
	{
	    count.val(count.val() * 1 - 1);
	}
	cart_submit();
    });
    $('.cart_count_plus').live('click', function(){
	var count = $(this).parents('.cart_count').find('input');
	count.val(count.val() * 1 + 1);
	cart_submit();
    });
});

function cart_submit()
{
    var form = '.cart_table_form';
    $(form).find("input[name='ajax']").val('1');
    $(form).ajaxSubmit({
        dataType: 'json',

        success: function(response, statusText, xhr, form)
        {
            if (response.empty)
            {
                $(".cart_order").hide();
            }
            else
            {
				$(".cart_order").show();
			}
            if (response.error)
            {
                $(form).find(".error_table").text(response.error).show();
            }
            if (response.table)
            {
                $(form).find(".cart_table").html(prepare(response.table));
            }
			if (response.data && response.target)
			{
				$(response.target).html(prepare(response.data));
			}
            return true;
        }
    });
}