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
				action: 'delete_discount_good',
				module: 'shop',
				discount_id : $('input[name=id]').val(),
				good_id : self.parents(".rel_element").attr("good_id"),
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
				action: 'show_discount_goods',
				module: 'shop',
				discount_id: $('input[name=id]').val(),
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
				action: 'show_discount_goods',
				module: 'shop',
				discount_id: $('input[name=id]').val(),
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
	$('.rel_module_search').live('keyup', function() {
		var self = $(this);
		$.ajax({
			url : window.location.href,
			type : 'POST',
			dataType : 'json',
			data : {
				action: 'show_discount_goods',
				module: 'shop',
				discount_id: $('input[name=id]').val(),
				search: self.val(),
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

	$('.rel_module a').live('click', function() {
		var self = $(this);
		if (! self.parents('.rel_module').find('div').is('.rel_module_selected'))
		{
			$.ajax({
				url : window.location.href,
				type : 'POST',
				dataType : 'json',
				data : {
					action: 'discount_good',
					module: 'shop',
					good_id: self.parents(".rel_module").attr("element_id"),
					discount_id: $('input[name=id]').val(),
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
					action: 'delete_discount_good',
					module: 'shop',
					discount_id: $('input[name=id]').val(),
					good_id : self.parents(".rel_module").attr("element_id"),
					check_hash_user : $('.check_hash_user').text()
				},
				success : (function(response)
				{
					self.parents('.rel_module').find('div').removeClass('rel_module_selected');
					$(".rel_element[good_id="+self.parents(".rel_module").attr("good_id")+"]").remove();
	
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
	$("#coupon_generate").click(function(){
		var r
		var digit = new Array("0","1","2","3","4","5","6","7","8","9")
		var lalp = new Array("a","b","c","d","e","f","g","h","i","j","k","l","m","n","o","p","q","r","s","t","u","v","w","y","z")
		pasw = new String()
		for (var i= 0; i<5; i++)
		{
			r = Math.random()
			if ( (r - 1.0/3.0) < 0.0)
			{
				r = Math.floor(Math.random() * 9);
				pasw += digit[r]
			}
			else
			{
				r = Math.floor(Math.random() * 24);
				pasw += lalp[r]
			}
		}
		$("input[name=coupon]").val(pasw);
	});
});