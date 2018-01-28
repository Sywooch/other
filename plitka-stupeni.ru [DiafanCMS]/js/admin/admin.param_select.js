$(document).ready(function(){
	show_param($("#type select"));
	$("#type select").change(function(){
		show_param($(this));
	});
	$(".param_actions a[action=up_param]").first().hide();
	$(".param_actions a[action=down_param]").last().hide();
	$(".param").live('mouseover', function(){
		$(this).addClass("hover");
		$(this).find(".param_actions").show();
	});
	$(".param").live('mouseout', function(){
		$(this).removeClass("hover");
		$(this).find(".param_actions").hide();
	});

	$(".param_actions a[action=delete_param]").live('click', function(){
		if ( $(this).attr("confirm") && ! confirm( $(this).attr("confirm")))
		{
			return false;
		}
		if($(this).parents(".param").find("a[action=down_param]").css('display') == 'none')
		{
			$(this).parents(".param").prev(".param").find("a[action=down_param]").hide();
		}
		if($(this).parents(".param").find("a[action=up_param]").css('display') == 'none')
		{
			$(this).parents(".param").next(".param").find("a[action=up_param]").hide();
		}
		$(this).parents(".param").remove();
		return false;
	});

	$(".param_actions a[action=up_param]").live('click', function() {
		var self = $(this).parents(".param");
		var change = $(this).parents(".param").prev(".param");
		var self_sort = self.find(".param_sort").val();
		self.find(".param_sort").val(change.find(".param_sort").val());
		change.find(".param_sort").val(self_sort);
		change.before(self.clone(true));
		self.remove();

		$(".param_actions a[action=up_param]").show();
		$(".param_actions a[action=down_param]").show();
		$(".param_actions a[action=up_param]").first().hide();
		$(".param_actions a[action=down_param]").last().hide();
		return false;
	});
	$(".param_actions a[action=down_param]").live('click', function() {
		var self = $(this).parents(".param");
		var change = $(this).parents(".param").next(".param");
		var self_sort = self.find(".param_sort").val();
		self.find(".param_sort").val(change.find(".param_sort").val());
		change.find(".param_sort").val(self_sort);
		change.after(self.clone(true));
		self.remove();

		$(".param_actions a[action=up_param]").show();
		$(".param_actions a[action=down_param]").show();
		$(".param_actions a[action=up_param]").first().hide();
		$(".param_actions a[action=down_param]").last().hide();
		return false;
	});
	$('.param_plus').click(function() {
		$('.param:last').clone(true).appendTo('#param table');
		$('.param:last .param_id, .param:last .param_actions a[action=down_param], .param:last .param_actions a[action=up_param]').remove();
		$('.param:last input').val('');
		$('.param:last .param_actions a[action=delete_param]').attr('confirm', '');

		$('.param:last input[type="checkbox"]').remove();
		return false;
	});

});
function show_param(obj)
{
	if (obj.val() == "select" || obj.val() == "multiple")
	{
		$("#param").show();
	}
	else
	{
		$("#param").hide();
	}
	if (obj.val() == "title")
	{
		$("#required").hide();
	}
	else
	{
		$("#required").show();
	}
	if (obj.val() == "checkbox")
	{
		$("#param_check").show();
	}
	else
	{
		$("#param_check").hide();
	}
	if(obj.val() == "attachments")
	{
		$('#attachments, #max_count_attachments, #attachment_extensions, #recognize_image, #attachments_access_admin, #upload_max_filesize').show();
		if($('#recognize_image input[type=checkbox]').attr('checked'))
		{
			$('#attach_big, #attach_medium, #attach_use_animation').show();
		}
	}
	else
	{
		$('#attachments, #max_count_attachments, #attachment_extensions, #recognize_image, #attach_big, #attach_medium, #attach_use_animation, #attachments_access_admin, #upload_max_filesize').hide();
	}
	if(obj.val() == "images")
	{
		$('#images_variations').show();
	}
	else
	{
		$('#images_variations').hide();
	}
}