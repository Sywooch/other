$(document).ready(function(){
	$('#select_module').change(function() {
		var path = $(this).attr("rel");
		if ($(this).val())
		{
			path = path+'?'+$(this).attr("name")+'='+$(this).val();
		}
		window.location.href = path;
	});
});