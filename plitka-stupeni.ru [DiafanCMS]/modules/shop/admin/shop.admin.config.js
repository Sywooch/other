$(document).ready(function(){
	$('.order_redirect_select').live('click', function(){
		$.ajax({
			url : window.location.href,
			type : 'POST',
			dataType : 'json',
			data : {
				action: "list_site_id",
				module: 'shop',
				parent_id: 0,
				check_hash_user : $('.check_hash_user').text()
			},
			success : (function(response)
			{
				if (response.error)
				{
					$(".error_shop").html(response.error).show();
				}
				if (response.data)
				{
					$("#inline").html(prepare(response.data));
					$.prettyPhoto.open("#inline");
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
	$('.menu_plus').live('click', function(){
		var self = $(this);
		if (self.parents("p").attr("module_name") == 'site')
		{
			var parent_id = self.parents("p").attr("site_id");
			var action = "list_site_id";
			var site_id = 0;
			var module_name = '';
		}
		else
		{
			var parent_id = self.parents("p").attr("cat_id");
			var action = "list_module";
			var site_id = self.parents("p").attr("site_id");
			var module_name = self.parents("p").attr("module_name");
		}
		$.ajax({
			url : window.location.href,
			type : 'POST',
			dataType : 'json',
			data : {
				action: action,
				module: 'menu',
				parent_id: parent_id,
				module_name: module_name,
				site_id: site_id,
				check_hash_user : $('.check_hash_user').text()
			},
			success : (function(response)
			{
				if (response.data)
				{
					self.parents("p").after(prepare(response.data));
					self.removeClass("menu_plus").addClass("menu_minus");
					self.text("—");
					$(".pp_content").height($(".pp_content .menu_list_first").height() + 50);
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
	$('.menu_minus').live('click', function(){
		$(this).parents("p").next(".menu_list").remove();
		$(this).addClass("menu_plus").removeClass("menu_minus");
		$(this).text("+");
		$(".pp_content").height($(".pp_content .menu_list_first").height() + 50);
		return false;
	});
	$('.menu_select').live('click', function(){
		$("input[name=order_redirect]").val($(this).parents("p").attr("site_id"));
		if(!$("input[name=name]").val())
		{
			$("input[name=name]").val($(this).text());
		}
		$(".menu_base_link").text($(this).text());
		$(".menu_base_link").attr("href", $(this).attr("href"));
		$.prettyPhoto.close();
		return false;
	});
});
