$(document).ready(function(){
	$("select[name=role_id]").live('change',function(){
		show_param_rele_rel(this);
	});
	show_param_rele_rel("select[name=role_id]");
    
	$(".registration_form input[type=text],.registration_form input[type=password]").blur(function(){
		var name = $(this).attr('name');
		var value2 = $(".registration_form input[name=password]").val();
		$.ajax({
			url:window.location.href,
			type:'POST',
			dataType:'html',
			data:{
				action:'fast_validate',
				name: name,
				module: 'registration',
				value: $(this).val(),
				value2: value2
			},
			success:(function (response) {
				if (response) {
					$(".error_"+name).text(response).show();
				}
				else
				{
					$(".error_"+name).text('').hide();
				}
			})
		});
	});
});
function show_param_rele_rel(th)
{
	$('.param_role_rels').hide();
	$('.param_role_'+$(th).val()).show();
}