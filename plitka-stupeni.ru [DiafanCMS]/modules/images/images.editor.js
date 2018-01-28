var ImagesDialog = {
	init : function(ed) {
		tinyMCEPopup.resizeToInnerSize();
	},

	insert : function(text) {
		var ed = tinyMCEPopup.editor, dom = ed.dom;
		tinyMCEPopup.execCommand('mceInsertContent', false, text);
		//tinyMCEPopup.close();
	}
};

tinyMCEPopup.onInit.add(ImagesDialog.init, ImagesDialog);

var selectarea = [];
var muliupload = false;
var list = false;
$(document).ready(function(){
	$("#tabs").tabs();
	if(list)
	{
		var uploader = new qq.FileUploader({
			element: document.getElementById("file-uploader"),
			action: window.location.href,
			maxConnections: 30,
			params: {
				action : "upload",
				folder_id: folder_id,
				module: "images"
			},
			onSubmit: function(){
				selectarea = [];
			},
			onComplete: function(id, fileName, response)
			{
				result_upload(response);
			}
		});
	}

	$(".images_actions a").live('click', function() {
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
				image_id : self.parents(".images_actions").attr("image_id"),
				check_hash_user : $('input[name=check_hash_user]').val()
			},
			success : (function(response)
			{
				if (response.error)
				{
					$(".error_images").html(response.error).show();
				}
				if(response.errors && response.errors['image'])
				{
					$(form).find(".error_images").html(response.errors['image']).show();
				}
				if (response.target)
				{
					$(response.target).html(prepare(response.data));
				}
				if (response.hash)
				{
					$('input[name=check_hash_user]').val(response.hash);
				}
				if(response.result == 'success' && self.attr("action") == 'delete')
				{
					self.parents('.images_actions').remove();
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

	$("#images_selectarea_button").live('click', function(){
		if($("input[name=x1]").val() == $("input[name=x2]").val()
		||  $("input[name=y1]").val() == $("input[name=y2]").val())
		{
			alert($("#images_selectarea_info").text());
			return false;
		}
		$.ajax({
			type : "POST",
			data : {
				action: "selectarea",
				x1: $("input[name=x1]").val(),
				x2: $("input[name=x2]").val(),
				y1: $("input[name=y1]").val(),
				y2: $("input[name=y2]").val(),
				id: $("input[name=image_id]").val(),
				variation_id: $("input[name=variation_id]").val(),
				check_hash_user : $('input[name=check_hash_user]').val()
			},
			dataType: "json",
			url: window.location.href,
	
			success: function(response, statusText, xhr, form)
			{
				if (response.hash)
				{
					$('input[name=check_hash_user]').val(response.hash);
				}
				$("#selectarea").hide();
				$('.imgareaselect-outer, .imgareaselect-handle, .imgareaselect-border1, .imgareaselect-border2, .imgareaselect-border3, .imgareaselect-border4, .imgareaselect-selection').remove();
				get_selectarea();
				return false;
			}
		});
		return false;
	});
	$('#images_variations').each(function(){
		show_delete_images_variation($(this));
	});
	$('.images_variation_plus').click(function(){
		var contaner = $(this).parents('#images_variations');
		var last = contaner.find(".images_variation").last();
		if(contaner.find(".images_variation").length >= last.find('select option').length)
		{
			return false;
		}
		last.after(last.clone(true));
		contaner.find(".images_variation").last().find("select, input").val('');
		show_delete_images_variation(contaner);
		if(contaner.find(".images_variation").length == last.find('select option').length)
		{
			contaner.find('.images_variation_plus').hide();
		}
	});
	$('.images_variation_delete').live('click', function(){
		var contaner = $(this).parents('#images_variations');
		if(contaner.find('.images_variation').length == 1)
		{
			return false;
		}
		if(! confirm($(this).attr('confirm')))
		{
			return false;
		}
		$(this).parents('.images_variation').remove();
		show_delete_images_variation(contaner);
		contaner.find('.images_variation_plus').show();
	});

	$(".folder img, .folder_open img").hide();

	$(".folder, .folder_open").live('mouseover', function(){
		$(this).find('img').show();
	});

	$(".folder, .folder_open").live('mouseout', function(){
		$(this).find('img').hide();
	});
	
	$('.images_close').live('click', function(){
		tinyMCEPopup.close();
	});
	$('.images_insert').live('click', function(){
		var text = '';
		var src = '';
		var width = 0;
		var height = 0;
		$('.tabs_image').each(function(){
			if($(this).css('display') == 'block')
			{
				src = $(this).find('img').attr('src');
				width = $(this).find('img').width();
				height = $(this).find('img').height();
			}
		});
		if(src)
		{
			text = '<img src="'+src+'" alt="'+$('input[name=alt]').val()+'" title="'+$('input[name=title]').val()+'" width="'+width+'" height="'+height+'">';
			
			if($('select[name=link_to]').val())
			{
				text = '<a href="'+$('select[name=link_to]').val()+'" rel="prettyPhoto[editor]">'+text+'</a>';
			}
			ImagesDialog.insert(text);
		}
		tinyMCEPopup.close();
	});
});

function result_upload(response)
{
	if(muliupload)
	{
		setTimeout('result_upload('+response+')', 1000);
	}
	else
	{
		muliupload = true;
		if (response.selectarea)
		{
			if(selectarea.length)
			{
				var start_selectarea = false;
			}
			else
			{
				var start_selectarea = true;
			}
			$.each(response.selectarea, function (k, v) {
				selectarea.push(v);
			});
			if(start_selectarea)
			{
				get_selectarea();
			}
		}
		if (response.error)
		{
			$(".error_images").html(response.error).show();
		}
		if(response.errors && response.errors['image'])
		{
			$(".error_images").html(response.errors['image']).show();
		}
		if (response.data)
		{
			$('#file-uploader').before(prepare(response.data));
		}
		if (response.hash)
		{
			$('input[name=check_hash_user]').val(response.hash);
		}
		muliupload = false;
	}
}

function prepare(string) {
	string = str_replace('&lt;', '<', string);
	string = str_replace('&gt;', '>', string);
	string = str_replace('&amp;', '&', string);
	return string;
}

function str_replace(search, replace, subject, count) {
	f = [].concat(search),
		r = [].concat(replace),
		s = subject,
		ra = r instanceof Array, sa = s instanceof Array;
	s = [].concat(s);
	if (count) {
		this.window[count] = 0;
	}
	for (i = 0, sl = s.length; i < sl; i++) {
		if (s[i] === '') {
			continue;
		}
		for (j = 0, fl = f.length; j < fl; j++) {
			temp = s[i] + '';
			repl = ra ? (r[j] !== undefined ? r[j] : '') : r[0];
			s[i] = (temp).split(f[j]).join(repl);
			if (count && s[i] !== temp) {
				this.window[count] += (temp.length - s[i].length) / f[j].length;
			}
		}
	}
	return sa ? s : s[0];
}
function get_selectarea()
{
	var stop = false;
	$.each(selectarea, function (k, v) {
		if(! stop && v)
		{
			$("#selectarea").html(prepare(v)).show();
			selectarea[k] = '';
			stop = true;
		}
	});
}

function show_delete_images_variation(contaner)
{
	if(contaner.find('.images_variation').length == 1)
	{
		contaner.find('.images_variation_delete').hide();
	}
	else
	{
		contaner.find('.images_variation_delete').show();
	}
}