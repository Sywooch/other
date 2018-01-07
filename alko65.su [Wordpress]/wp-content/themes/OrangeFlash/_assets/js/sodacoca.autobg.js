/*!
 * AutoBg
 * http://sodacoca.com/
 */


	var here = 0;
	var here2 = 0;
	var imageWidth = 300;
	var bodyWidth = $('html').width();

	var startPos = -(imageWidth - bodyWidth);
	
	function sodacoca(element1, element2){
		
		here += 1;
		here2 += 2;
		
		if (here == startPos){
			here = 0;
		}
		if (here2 == startPos){
			here2 = 0;
		}
		
		if (!$.browser.msie){
			$('#'+ element1).fadeIn(5000);
			$('#'+ element2).fadeIn(5000);
		}
		else {
			$('#'+ element1).show();
			$('#'+ element2).show();
		}
		
		$('#'+ element1).css("background-position", here+"px -50px");
		$('#'+ element2).css("background-position", here2+"px 0");
		
	}


	
	
