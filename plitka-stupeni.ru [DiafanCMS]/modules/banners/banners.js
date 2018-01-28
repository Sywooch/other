$(document).ready(function() { 
    $('.banners_counter').click(function(){
        var banner_id = $(this).attr('rel');
        $("input[name='banner_id']").val(banner_id);
        $('.banners_form').submit();
	if($(this).attr('target') == '_blank')
	{
	    window.open($(this).attr('href'), '_blank');
	}
	return false;
	});
});