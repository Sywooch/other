function images (field_name, url, type, win) {
	var cmsURL = '<?php echo pathinfo($_SERVER['SCRIPT_NAME'],PATHINFO_DIRNAME); ?>/images.htm';

	tinyMCE.activeEditor.windowManager.open({
		file : cmsURL,
		title : 'Upload',
		width : 750,
		height : 550,
		resizable : "yes",
		inline : "yes",
		close_previous : "no"
	}, {
		window : win,
		input : field_name
	});
	return false;
}
