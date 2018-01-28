$(document).ready(function(){
	$(".ads_urls").click(function(){
		var urls="";
		var val= $(".counts").val();
		urls=prompt("Введите ссылку на страницу", "");
		if(urls!=""){
			$(".counts").val(((val*1)+1));
			$(".url_inputs").append('<p class="das'+val+'"><input type="text" name="url[]" value="'+urls+'" style="width:500px;"><a class="delsas" href="javascript:void(0)" my_del="das'+val+'" style="color:red;text-decoration:none;">Del</a></p>');
		}
	});
	$(".delsas").live("click",function(){
	var sdg=$(this).attr("my_del");
	//alert(sdg);
	$($("."+sdg)).remove();
	})
});