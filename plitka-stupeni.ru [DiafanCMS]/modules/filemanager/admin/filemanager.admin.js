var path;
var muliupload_count = 0;
$(document).ready(function(){
	var path = $('input[name=path]').val();
	var uploader = new qq.FileUploader({
		element: document.getElementById("file-uploader"),
		action: $('input[name=action_url]').val(),
		maxConnections: 30,
		params: {
			path: (path ? path : ''),
			ajax: 1,
			module: "filemanager",
			action_filemanager : "upload_file"
		},
		onSubmit: function(){
			muliupload_count = muliupload_count + 1;
		},
		onComplete: function(id, fileName, response)
		{
			muliupload_count = muliupload_count - 1;
			if(! muliupload_count)
			{
				window.location.href = response.redirect;
			}
		}
	});
});