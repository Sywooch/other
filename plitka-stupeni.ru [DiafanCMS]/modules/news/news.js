$(document).ready(function() {
	$(".news_calendar_prev, .news_calendar_next").live('click', function(){
		if($(this).is(".news_calendar_prev"))
		{
			$(this).parents('form').find('input[name=arrow]').val('prev');
		}
		else
		{
			$(this).parents('form').find('input[name=arrow]').val('next');
		}
        $(this).parents('form').ajaxSubmit({
            dataType: 'html',
            success: function(response, statusText, xhr, form)
            {
				form.parents('.news_block').replaceWith(response);
                return false;
            }
        });
        return false;
	});
});