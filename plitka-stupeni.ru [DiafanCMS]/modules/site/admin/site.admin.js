$(document).ready(function() { 
    $('input[name=block]').each(function(){
		if(! $(this).attr("checked"))
		{
			$('#site_ids').hide();
		}
	})
    $('input[name=block]').click(function(){
		if(! $(this).attr("checked"))
		{
			$('#site_ids').hide();
		}
		else
		{
			$('#site_ids').show();
		}
	})
});