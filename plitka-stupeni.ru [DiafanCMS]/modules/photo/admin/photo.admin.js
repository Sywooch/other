var muliupload_count = 0;
$(document).ready(function() {
	$('.upload_files').click(function(){
		var url = $(this).attr("href");
        var cat_id = $(this).attr("cat_id");
		var uploader = new qq.FileUploader({
			element: document.getElementById('file-uploader'),
			action: url,
			maxConnections: 30,
			params: {save_post : "1", cat_id : cat_id},
			onSubmit: function(){
				muliupload_count = muliupload_count + 1;
			},
			onComplete: function(id, fileName, response)
			{
				muliupload_count = muliupload_count - 1;
				if(! muliupload_count)
				{
					window.location.href = '';
				}
			}
		});
		return false;
	});
});