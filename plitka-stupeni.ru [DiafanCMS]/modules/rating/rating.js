var rating = 0;
$(document).ready(function(){
	$('.rating_votes').live('click', function(){
		if($(this).attr("disabled") == "disabled")
		{
			return false;
		}
		$.ajax({
			data: {
				module : "rating",
				element_id: $(this).attr("element_id"),
				module_name: $(this).attr("module_name"),
				rating: rating,
				ajax: 1
			},
			type : 'POST'
		});
		$(this).attr("disabled", "disabled");
		return false;
	});
	$('.rating_votes').live('mouseout', function(){
		if($(this).attr("disabled") == "disabled")
		{
			return false;
		}
		$(this).html($(this).next('.rating_votes_hide').html());
	});
	$('.rating_votes img').live('mouseover', function(){
		if($(this).parents('.rating_votes').attr("disabled") == "disabled")
		{
			return false;
		}
		if(! $(this).parents('.rating_votes').next('.rating_votes_hide').length)
		{
			$(this).parents('.rating_votes').after('<span class="rating_votes_hide">'+$(this).parents('.rating_votes').html()+'</span>');
			$(this).parents('.rating_votes').next('.rating_votes_hide').hide();
		}
		rating = 0;
		var plus = true;
		$(this).attr("current", "true");
		$(this).parents('.rating_votes').find('img').each(function(){
			if(plus)
			{
				rating = rating + 1;
				$(this).attr("src", $(this).attr("src").replace("rminus", "rplus"));
				$(this).attr("alt", "+");
			}
			else
			{
				$(this).attr("src", $(this).attr("src").replace("rplus", "rminus"));
				$(this).attr("alt", "-");
			}
			if($(this).attr("current") == "true")
			{
				plus = false;
			}
		});
		$(this).attr("current", "false");
	});
});