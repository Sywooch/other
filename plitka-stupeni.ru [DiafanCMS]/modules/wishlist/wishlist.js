$(document).ready(function(){
    //	$('.wishlist_table_form input[type=submit]').hide();
    //	$('.wishlist_table_form input[type=text]').live('change', wishlist_submit);
    //	$('.wishlist_table_form input[type=checkbox], .wishlist_table_form input[type=radio]').live('click', wishlist_submit);
    //	$('.wishlist_table_form input[type=checkbox], .wishlist_table_form input[type=radio]').live('change', wishlist_submit);
    $('.wishlist_table_form').live('submit', wishlist_submit);
	
	$('.wishlist_buy input[type=button]').live('click', function(){
		var self = $(this);
		$.ajax({
			url : window.location.href,
			type : 'POST',
			dataType : 'json',
			data : {
				action: 'buy',
				module: 'wishlist',
				ajax: 1,
				good_id: self.attr('good_id'),
				count: self.parents('.wishlist tr').find('.wishlist_count input').val()
			},
			success : (function(response)
			{
				if (response.error)
				{
					$('.wishlist_table_form .error').html(prepare(response.error)).show();
				}
				if (response.table)
				{
					$(".wishlist_table_form .wishlist_table").html(prepare(response.table));
				}
				if (response.data && response.target)
				{
					$(response.target).html(prepare(response.data));
				}
			})
		});
		
	});
});

function wishlist_submit()
{
    var form = '.wishlist_table_form';
    $(form).find("input[name='ajax']").val('1');
    $(form).ajaxSubmit({
        dataType: 'json',

        success: function(response, statusText, xhr, form)
        {
            if (response.error)
            {
                $(form).find(".error").text(response.error).show();
            }
            if (response.table)
            {
                $(form).find(".wishlist_table").html(prepare(response.table));
            }
			if (response.data && response.target)
			{
				$(response.target).html(prepare(response.data));
			}
            return true;
        }
    });
    return false;
}