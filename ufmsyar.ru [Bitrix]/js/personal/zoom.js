function viewImage(url, width, height, object)
{
	var title = '';

	if(object)
	{
		var img = object.getElementsByTagName('img');
		
		if(img.length)
			title = img[0].alt;
	}

	img = window.open(url + ';' + title, 'img', 'location=no,width=' + width + ',height=' + height + ',top=30,left=30');
	
	return false;
}


