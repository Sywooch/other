$(document).ready(function(){
	$(".rel_element").live('mouseover', function(){
		$(this).addClass("hover");
		$(this).find(".rel_element_actions").show();
	});
	$(".rel_element").live('mouseout', function(){
		$(this).removeClass("hover");
		$(this).find(".rel_element_actions").hide();
	});        
	$(".rel_element_actions a").live('click', function() {
		var self = $(this);
		if (self.attr("action") != 'delete_rel_element')
		{
			return true;
		}
		if (! confirm(self.attr("confirm")))
		{
			return false;
		}
		$.ajax({
			url : window.location.href,
			type : 'POST',
			dataType : 'json',
			data : {
				action: 'delete_rel_element',
				element_id : self.parents(".rel_element").attr("element_id"),
				rel_id : self.parents(".rel_element").attr("rel_id"),
				rel_two_sided:  $("#rel_elements").attr("rel_two_sided"),
				check_hash_user : $('.check_hash_user').text()
			},
			success : (function(response)
			{
				self.parents(".rel_element").remove();

				if (response.hash)
				{
					$('input[name=check_hash_user]').val(response.hash);
					$('.check_hash_user').text(response.hash);
				}
			})
		});
		return false;
	});
	$('.rel_module_plus').click(function() {
		var self = $(this);
		$.ajax({
			url : window.location.href,
			type : 'POST',
			dataType : 'json',
			data : {
				action: 'show_rel_elements',
				element_id: $('input[name=id]').val(),
				rel_two_sided:  $("#rel_elements").attr("rel_two_sided"),
				check_hash_user : $('.check_hash_user').text()
			},
			success : (function(response)
			{
				if (response.data)
				{
					$("#rel_module_container").html(prepare(response.data));
					$.prettyPhoto.open("#rel_module_container");
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
	$('.rel_module_navig a').live('click', function() {
		var self = $(this);
		$.ajax({
			url : window.location.href,
			type : 'POST',
			dataType : 'json',
			data : {
				action: 'show_rel_elements',
				element_id: $('input[name=id]').val(),
				rel_two_sided:  $("#rel_elements").attr("rel_two_sided"),
				page: self.attr("page"),
				check_hash_user : $('.check_hash_user').text()
			},
			success : (function(response)
			{
				if (response.data)
				{
					$(".rel_all_elements_container").html(prepare(response.data));
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
	var search = '';
	var cat_id = '';
	$('.rel_module_search, .rel_module_cat_id').live('keyup change', function() {
		if($(this).is('.rel_module_search'))
		{
			search = $(this).val();
		}
		if($(this).is('.rel_module_cat_id'))
		{
			cat_id = $(this).val();
		}
		$.ajax({
			url : window.location.href,
			type : 'POST',
			dataType : 'json',
			data : {
				action: 'show_rel_elements',
				element_id: $('input[name=id]').val(),
				rel_two_sided:  $("#rel_elements").attr("rel_two_sided"),
				search: search,
				cat_id: cat_id,
				check_hash_user : $('.check_hash_user').text()
			},
			success : (function(response)
			{
				if (response.data)
				{
					$(".rel_all_elements_container").html(prepare(response.data));
				}
				if (response.hash)
				{
					$('input[name=check_hash_user]').val(response.hash);
					$('.check_hash_user').text(response.hash);
				}
			})
		});
	});
	$('.rel_module a').live('click', function() {
		var self = $(this);
		if (! self.parents('.rel_module').find('div').is('.rel_module_selected'))
		{
			$.ajax({
				url : window.location.href,
				type : 'POST',
				dataType : 'json',
				data : {
					action: 'rel_elements',
					rel_id: self.parents(".rel_module").attr("element_id"),
					element_id: $('input[name=id]').val(),
					rel_two_sided:  $("#rel_elements").attr("rel_two_sided"),
					check_hash_user : $('.check_hash_user').text()
				},
				success : (function(response)
				{
					self.parents('.rel_module').find('div').addClass('rel_module_selected');
					if (response.data)
					{
						$(".rel_elements").html(prepare(response.data));
					}
					if (response.id)
					{
						$("input[name=id]").val(response.id);
					}
					if (response.hash)
					{
						$('input[name=check_hash_user]').val(response.hash);
						$('.check_hash_user').text(response.hash);
					}
				})
			});
		}
		else
		{
			$.ajax({
				url : window.location.href,
				type : 'POST',
				dataType : 'json',
				data : {
					action: 'delete_rel_element',
					element_id : $('input[name=id]').val(),
					rel_id : self.parents(".rel_module").attr("element_id"),
					rel_two_sided:  $("#rel_elements").attr("rel_two_sided"),
					check_hash_user : $('.check_hash_user').text()
				},
				success : (function(response)
				{
					self.parents('.rel_module').find('div').removeClass('rel_module_selected');
					$(".rel_element[rel_id="+self.parents(".rel_module").attr("element_id")+"]").remove();

					if (response.hash)
					{
						$('input[name=check_hash_user]').val(response.hash);
						$('.check_hash_user').text(response.hash);
					}
				})
			});
		}
		return false;
	});
});