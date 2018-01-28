$(document).ready(function() {
	$('.votes_result').live('click', function(){
		$(this).parents('form').find("input[name=result]").val(1);
		$(this).parents('form').submit();
	});
    
	$('.votes_form input:radio').live('click', function(){
		if($(this).attr('value') == 'userversion'){
		    $('.votes_userversion').show();
		}
		else
		{
		    $('.votes_userversion').hide();
		}
	});
	
});