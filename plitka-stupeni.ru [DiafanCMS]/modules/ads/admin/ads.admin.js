$(document).ready(function(){
    change_param();
	$("select[name=cat_id], select[name='cat_ids[]']").change(change_param);
});

function change_param()
{
	$(".ads_param, .ads_param_td").addClass("hide");
	$(".ads_param[cat0=true], .ads_param_td[cat0=true]").removeClass("hide");
	$(".ads_param[cat"+$('select[name=cat_id]').val()+"=true]").removeClass("hide");
	$(".ads_param_td[cat"+$('select[name=cat_id]').val()+"=true]").removeClass("hide");
	$("select[name='cat_ids[]'] option:selected").each(function(){
		$(".ads_param[cat"+$(this).attr("value")+"=true]").removeClass("hide");
		$(".ads_param_td[cat"+$(this).attr("value")+"=true]").removeClass("hide");
	});
}