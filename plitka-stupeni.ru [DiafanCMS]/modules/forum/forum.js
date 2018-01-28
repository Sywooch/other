$(document).ready(function() {
	$('.delete_attachment').live('click', function(){
		var del_id = $(this).attr("del_id");
		if (! confirm($(this).attr("title")))
			return false;

		$.ajax({
			type : 'POST',
			dataType : 'json',
			data : { module : 'forum', ajax : true, action: 'delete_attachment', del_id: del_id , check_hash_user : $('input[name=check_hash_user]').val()},
			success : (function(response)
			{
				$(response.target).hide();
				if (response.hash)
				{
					$('input[name=check_hash_user]').val(response.hash);
				}
			})
		});
		return false;
	});

	$('.forum_message_show_form').live('click', function(){
		$(this).next('div').toggle();
	});

	$(".forum_message, .forum_category").live('mouseover', function() {
		$(this).find(".forum_actions span").show();
	});

	$(".forum_message, .forum_category").live('mouseout', function() {
		$(this).find(".forum_actions span").hide();
	});
	
	$('.forum_actions a').live('click', function(){
		if (! $(this).attr("action"))
		{
			return true;
		}
		if ($(this).attr("title"))
		{
			if (! confirm($(this).attr("title")))
			{
				return false;
			}
		}
		$(this).parents('form').find('input[name=action]').val($(this).attr("action"));
		$(this).parents('form').submit();
	});
});