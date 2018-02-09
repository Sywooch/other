$(function() {
	try
	{
		$('#gallery a').each(function()
		{
			$(this).attr('data-fancybox-group', 'gallery');
		});
		$("#gallery a").fancybox();
	}
	catch(e)
	{alert (e.message)}
});