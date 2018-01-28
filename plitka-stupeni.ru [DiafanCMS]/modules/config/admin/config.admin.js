$(document).ready(function() {
	check_route_method();
	$("select[name=route_method]").live('change', check_route_method);
});

function check_route_method()
{
	if($("select[name=route_method]").val() == 1)
	{
		$('#route_translit_from,#route_translit_to').show();
	}
	else
	{
		$('#route_translit_from,#route_translit_to').hide();
	}
	if($("select[name=route_method]").val() == 2)
	{
		$('#route_google_api_key').show();
	}
	else
	{
		$('#route_google_api_key').hide();
	}
}