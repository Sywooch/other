$(document).ready(function() {
	$(".previous_link a, .next_link a").live('click', function(){
		var url = $(this).attr("href");
		$.ajax({
			url : url,
			data : {module_ajax : 'photo'},
			type: 'POST',
			dataType : 'html',
			success : (function(response)
			{
				$(".photo_id").html(prepare(response));
			})
		});
		return false;
	});
});