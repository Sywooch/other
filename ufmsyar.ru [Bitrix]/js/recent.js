$.get('http://ufms-yaroslavl.info/forum/index.php?type=rss;action=.xml', function(data)
{
	$('#recent-posts-holder').empty();
	$('#recent-posts-holder').html('<ul class="list"></ul>');

	$(data).find('item').each(function()
	{
		var $item = $(this);
		var title = $item.find('title').text();
		var link = $item.find('link').text();
		var pubDate = $item.find('pubDate').text();

		var oDate = new Date();
		oDate.getDate(pubDate);

		var sDay = oDate.getUTCDate().toString();
		var sMonth = (oDate.getUTCMonth() + 1).toString();

		if(sDay.length == 1)
		{
			sDay = '0' + sDay;
		}

		if(sMonth.length == 1)
		{
			sMonth = '0' + sMonth;
		}

		var sDate = sDay + '.' + sMonth + '.' + oDate.getUTCFullYear().toString().substring(2, 4);

		var html = '<li>';
		html += '<span>' + sDate + '</span>';
		html += '<a href="' + link + '">' + title + '</a></li>';
		$('#recent-posts-holder ul').append($(html));
	});
}, 'xml');