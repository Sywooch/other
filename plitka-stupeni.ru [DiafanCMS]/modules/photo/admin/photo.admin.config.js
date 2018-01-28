$(document).ready(function(){
	$("input[name=images]").attr("checked", true);
	show_tr_click_checkbox($("input[name=images]"));
	$("#images, #list_img").hide();
});