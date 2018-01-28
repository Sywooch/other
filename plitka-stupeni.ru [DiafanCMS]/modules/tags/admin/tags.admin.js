$(document).ready(function(){
	$('.tags_upload').click(function(){
		var button = $(this);
		$(this).parents('form').ajaxSubmit({
			type : 'POST',
			data : {action: 'upload', module : 'tags'},
			dataType: 'json',
			url: window.location.href,

			beforeSubmit: function(a,form,o) {
				$('.errors').hide();
			},

			success: function(response, statusText, xhr, form)
			{
				if (response.error)
				{
					$(form).find(".error_tags").html(response.error).show();
				}
				if (response.id)
				{
					$(form).find("input[name=id]").val(response.id);
				}
				if (response.data && response.target)
				{
					$(response.target).html(prepare(response.data));
					$('input[name=tag]').val('');
				}
				if (response.hash)
				{
					$('input[name=check_hash_user]').val(response.hash);
					$('.check_hash_user').text(response.hash);
				}
				$(".tags_search").hide();
				return false;
			}
		});
		return false;
	});

	$(".tags_delete").live('click', function() {
		var self = $(this);
		if (! confirm(self.attr("confirm")))
		{
			return false;
		}
		$.ajax({
			url : window.location.href,
			type : 'POST',
			dataType : 'json',
			data : {
				action: 'delete',
				module: 'tags',
				tag_id : self.attr("tag_id"),
				check_hash_user : $('.check_hash_user').text()
			},
			success : (function(response)
			{
				if (response.error)
				{
					$(".error_tags").html(response.error).show();
				}
				else
				{
					$(".tags_container").html(prepare(response.data));
				}
				if (response.hash)
				{
					$('input[name=check_hash_user]').val(response.hash);
					$('.check_hash_user').text(response.hash);
				}
				$(".tags_search").hide();
			})
		});
		return false;
	});

	$('.tags_cloud').click(function() {
		var self = $(this);
		$.ajax({
			url : window.location.href,
			dataType : 'json',
			data : {
				action: 'search',
				module: 'tags',
				element_id : self.attr("element_id"),
				check_hash_user : $('.check_hash_user').text()
			},
			type : 'POST',
			success : (function(response)
			{
				if (response.error)
				{
					$(".error_tags").html(response.error).show();
				}
				if (response.data)
				{
					$(".tags_search").html(prepare(response.data)).show();
				}
				else
				{
					$(".tags_search").hide();
				}
				if (response.hash)
				{
					$('input[name=check_hash_user]').val(response.hash);
					$('.check_hash_user').text(response.hash);
				}
			})
		});
		return false;
	});

	$(".tags_add").live('click', function() {
		$("input[name=tag]").val($(this).text());
		$(".tags_upload").click();
	});
});