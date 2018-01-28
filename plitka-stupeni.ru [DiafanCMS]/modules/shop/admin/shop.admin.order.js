var last_order_id; var title; var timeout;
var search;
var cat_id;
$(document).ready(function(){
	$("select[name=status]").change(function(){
		if ($(this).val() == "all")
		{
			$(this).attr("name", "");
		}
		$(this).parents("form").submit();
	})
	$('.order_good_plus').click(function() {
		var self = $(this);
		$.ajax({
			url : window.location.href,
			type : 'POST',
			dataType : 'json',
			data : {
				action: 'show_order_goods',
				module: 'shop',
				order_id: $('input[name=id]').val(),
				check_hash_user : $('.check_hash_user').text()
			},
			success : (function(response)
			{
				if (response.data)
				{
					$("#order_goods_container").html(prepare(response.data));
					$.prettyPhoto.open("#order_goods_container");
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
	$('.order_goods_navig a').live('click', function() {
		var self = $(this);
		$.ajax({
			url : window.location.href,
			type : 'POST',
			dataType : 'json',
			data : {
				action: 'show_order_goods',
				module: 'shop',
				order_id: $('input[name=id]').val(),
				page: self.attr("page"),
				search: search,
				cat_id: cat_id,
				check_hash_user : $('.check_hash_user').text()
			},
			success : (function(response)
			{
				if (response.data)
				{
					$(".order_all_goods_container").html(prepare(response.data));
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
	$('.order_goods_search').live('keyup', search_goods_order);
	$('.order_goods_cat_id').live('change', search_goods_order);
	$('.order_good a').live('click', function() {
		var self = $(this);
		$.ajax({
			url : window.location.href,
			type : 'POST',
			dataType : 'json',
			data : {
				action: 'add_order_good',
				module: 'shop',
				order_id: $('input[name=id]').val(),
				price_id: self.attr("price_id"),
				check_hash_user : $('.check_hash_user').text()
			},
			success : (function(response)
			{
				if (response.data)
				{
					$(".order_good_plus").parents('.tr_good').before(prepare(response.data));
				}
				if (response.order_id)
				{
					$('input[name=id]').val(response.order_id);
				}
				if (response.hash)
				{
					$('input[name=check_hash_user]').val(response.hash);
					$('.check_hash_user').text(response.hash);
				}
				$.prettyPhoto.close();
			})
		});
		return false;
	});
    $(".delete_order_good").live('click',function() { 
        var self = $(this);
        if (! confirm(self.attr("confirm")))
        {
            return false;
        }
		$(this).parents('.tr_good').remove();
        return false;
    });
});

function check_new_order()
{
	$.ajax({
		url : window.location.href,
		type : 'POST',
		dataType : 'json',
		data : {
			action: 'new_order',
			module: 'shop',
			last_order_id: last_order_id,
			check_hash_user : $('.check_hash_user').text()
		},
		success : (function(response)
		{
			if (response.next_order_id != false)
			{
				title_new_order();
			}
			else
			{
				setTimeout('check_new_order()', timeout ? timeout : 120000);
			}
			if (response.hash)
			{
				$('input[name=check_hash_user]').val(response.hash);
				$('.check_hash_user').text(response.hash);
			}
		})
	});
}
function search_goods_order()
{
	if($(this).is('.order_goods_search'))
	{
		search = $(this).val();
	}
	if($(this).is('.order_goods_cat_id'))
	{
		cat_id = $(this).val();
	}
	$.ajax({
		url : window.location.href,
		type : 'POST',
		dataType : 'json',
		data : {
			action: 'show_order_goods',
			module: 'shop',
			order_id: $('input[name=id]').val(),
			search: search,
			cat_id: cat_id,
			check_hash_user : $('.check_hash_user').text()
		},
		success : (function(response)
		{
			if (response.data)
			{
				$(".order_all_goods_container").html(prepare(response.data));
			}
			if (response.hash)
			{
				$('input[name=check_hash_user]').val(response.hash);
				$('.check_hash_user').text(response.hash);
			}
		})
	});
}
function title_new_order()
{
	var new_title  = '****************************************';
	if($('title').text() == new_title)
	{
		$('title').text(title);
	}
	else
	{
		$('title').text(new_title);
	}
	setTimeout('title_new_order()', 360);
}