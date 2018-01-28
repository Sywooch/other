var muliupload = false;
$(document).ready(function(){
	$('.file-uploader').each(function(){
		var id = $(this).attr('id');
		var param_id = $(this).attr('param_id');
		var tmpcode = $('input[name=tmpcode]').val();
		if(tmpcode == undefined)
		{
			tmpcode = '';
		}
		var uploader = new qq.FileUploader({
			element: document.getElementById(id),
			action: window.location.href,
			maxConnections: 30,
			params: {
				action : "upload",
				module: "images",
				id: $('input[name=id]').val(),
				tmpcode: tmpcode,
				name: $('input[name=name]').val(),
				site_id: $('input[name=site_id], select[name=site_id]').val(),
				param_id: param_id
			},
			onSubmit: function(){
				$('.errors').hide();
			},
			onComplete: function(id, fileName, response)
			{
				result_upload(response, param_id);
			}
		});
	});

	$(".images_actions a").live('click', function() {
		var param_id = $(this).parents('td').attr('param_id');
		var self = $(this);
		if (! self.attr("action"))
		{
			return true;
		}
		if (self.attr("confirm") && ! confirm(self.attr("confirm")))
		{
			return false;
		}
		$.ajax({
			url : window.location.href,
			type : 'POST',
			dataType : 'json',
			data : {
				action: self.attr("action"),
				module: 'images',
				element_id : self.parents(".images_actions").attr("element_id"),
				tmpcode: $('input[name=tmpcode]').val(),
				image_id : self.parents(".images_actions").attr("image_id"),
				check_hash_user : $('.check_hash_user').text()
			},
			success : (function(response)
			{
				if (response.error)
				{
					$(".error_images"+param_id).html(response.error).show();
				}
				if(response.errors && response.errors['image'])
				{
					$(form).find(".error_images"+param_id).html(response.errors['image']).show();
				}
				if (response.target)
				{
					$(response.target).html(prepare(response.data));
				}
				else
				{
					$(th).parents(".images_actions").html(prepare(response.data));
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

	$(".images_actions").live('mouseover', function(){
		$(this).addClass('hover');
		$(this).find('.images_button').show();
	});

	$(".images_actions").live('mouseout', function(){
		$(this).removeClass('hover');
		$(this).find('.images_button').hide();
	});

	$(".ajax_save_image").live('click', function(){
		var self = $(this);
		$.ajax({
			url : window.location.href,
			type : 'POST',
			dataType : 'json',
			data : {
				action: 'save',
				module: 'images',
				element_id : self.parents(".images_actions").attr("element_id"),
				tmpcode: $('input[name=tmpcode]').val(),
				image_id : self.parents(".images_actions").attr("image_id"),
				check_hash_user : $('.check_hash_user').text(),
				alt : self.parents("div").find("input[name=alt]").val(),
				title : self.parents("div").find("input[name=title]").val()
			},
			success : (function(response)
			{
				if (response.data && response.target)
				{
					$(response.target).html(prepare(response.data));
				}
				if (response.hash)
				{
					$('input[name=check_hash_user]').val(response.hash);
					$('.check_hash_user').text(response.hash);
				}
			})
		});
	});
	$(".images_selectarea_button").live('click', function(){
		var selectarea_div = $(this).parents('.selectarea');

		var param_id = selectarea_div.parents('td').attr('param_id');

		if(selectarea_div.find("input[name=x1]").val() == selectarea_div.find("input[name=x2]").val()
		||  selectarea_div.find("input[name=y1]").val() == selectarea_div.find("input[name=y2]").val())
		{
			alert(selectarea_div.find(".images_selectarea_info").text());
			return false;
		}
		$.ajax({
			type : "POST",
			data : {
				action: "selectarea",
				module : "images",
				x1: selectarea_div.find("input[name=x1]").val(),
				x2: selectarea_div.find("input[name=x2]").val(),
				y1: selectarea_div.find("input[name=y1]").val(),
				y2: selectarea_div.find("input[name=y2]").val(),
				id: selectarea_div.find("input[name=image_id]").val(),
				variation_id: selectarea_div.find("input[name=variation_id]").val(),
				check_hash_user : $('.check_hash_user').text()
			},
			dataType: "json",
			url: window.location.href,
	
			success: function(response, statusText, xhr, form)
			{
				if (response.hash)
				{
					$('input[name=check_hash_user]').val(response.hash);
					$('.check_hash_user').text(response.hash);
				}
				selectarea_div.text('');
				selectarea_div.hide();
				$('.imgareaselect-outer, .imgareaselect-handle, .imgareaselect-border1, .imgareaselect-border2, .imgareaselect-border3, .imgareaselect-border4, .imgareaselect-selection').remove();
				get_selectarea(param_id);
				return false;
			}
		});
		return false;
	});
});

function result_upload(response, param_id)
{
	if(muliupload)
	{
		setTimeout('result_upload('+response+', '+param_id+')', 1000);
	}
	else
	{
		muliupload = true;
		if (response.selectarea)
		{
			$.each(response.selectarea, function (k, v) {
				$('td[param_id='+param_id+'] .selectarea').after('<div class="selectarea_next" style="display:none">'+prepare(v)+'</div>');
			});
			get_selectarea(param_id);
		}
		if (response.id)
		{
			$("input[name=id]").val(response.id);
		}
		if (response.error)
		{
			$(".error_images"+param_id).html(response.error).show();
		}
		if(response.errors && response.errors['image'])
		{
				$(".error_images"+param_id).html(response.errors['image']).show();
		}
		if (response.data && response.target)
		{
			$(response.target).html(prepare(response.data));
		}
		if (response.hash)
		{
			$('input[name=check_hash_user]').val(response.hash);
			$('.check_hash_user').text(response.hash);
		}
		muliupload = false;
	}
}
function get_selectarea(param_id)
{
	var selectarea = $("td[param_id="+param_id+"] .selectarea");
	if(selectarea.html())
	{
		return;
	}
	if($('td[param_id='+param_id+'] .selectarea_next').length)
	{
		selectarea.html($('td[param_id='+param_id+'] .selectarea_next').last().html()).show();
		$('td[param_id='+param_id+'] .selectarea_next').last().remove();

		selectarea.find(".images_selectarea").imgAreaSelect({
			aspectRatio: selectarea.find('.images_selectarea').attr('select_width')+":"+selectarea.find('.images_selectarea').attr('select_height'),
			handles: true,
			onSelectEnd: function (img, selection) {
				selectarea.find("input[name=x1]").val(selection.x1);
				selectarea.find("input[name=y1]").val(selection.y1);
				selectarea.find("input[name=x2]").val(selection.x2);
				selectarea.find("input[name=y2]").val(selection.y2);
			}
		});
	}
}