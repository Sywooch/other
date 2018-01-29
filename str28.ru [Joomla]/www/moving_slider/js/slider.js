$(function() {

//while(1){
//alert('12343');
//setTimeout(alert('123'), 5000);

//};
	
	
	
	var totalPanels			= $(".scrollContainer").children().size();
		
	var regWidth			= $(".panel").css("width");
	var regImgWidth			= $(".panel img").css("width");
	var regTitleSize		= $(".panel h2").css("font-size");
	var regParSize			= $(".panel p").css("font-size");
	
	var movingDistance	    = 638;
	
	var curWidth			= 638;
	var curImgWidth			= 638;
	var curTitleSize		= "20px";
	var curParSize			= "15px";

	var $panels				= $('#slider .scrollContainer > div');
	var $container			= $('#slider .scrollContainer');

	$panels.css({'float' : 'left','position' : 'relative'});
    
	$("#slider").data("currentlyMoving", false);

	$container
		.css('width', ($panels[0].offsetWidth * $panels.length) + 100 )
		.css('left', "-1131px");

	var scroll = $('#slider .scroll').css('overflow', 'hidden');

	function returnToNormal(element) {
		$(element)
			.animate({ width: regWidth })
			.find("img")
			.animate({ width: regImgWidth })
		    .end()
			.find("h2")
			.animate({ fontSize: regTitleSize })
			.end()
			.find("p")
			.animate({ fontSize: regParSize });
	};
	
	function growBigger(element) {
		$(element)
			.animate({ width: curWidth })
			.find("img")
			.animate({ width: curImgWidth })
		    .end()
			.find("h2")
			.animate({ fontSize: curTitleSize })
			.end()
			.find("p")
			.animate({ fontSize: curParSize });
	}
	///////////////////////////////////////////////////////////////////////////
	// true = �����, false = ����
	function change(direction) {
	   
	   
	  
	    //���� �� ������ � �� ��������� ������
		if((direction && !(curPanel < totalPanels))) { 
		
		//�� ��������� � ��������� �����
        if (($("#slider").data("currentlyMoving") == false)) {
		//alert('lost');
		$("#slider").data("currentlyMoving", true);
			
		var next         =  curPanel - (totalPanels-1);
		var leftValue    = $(".scrollContainer").css("left");
		var movement	 =  (parseFloat(leftValue, 10) + (movingDistance * (totalPanels-1)));
    	$(".scrollContainer")
				.stop()
				.animate({
					"left": movement
				}, 300,  function() {
				setTimeout($("#slider").data("currentlyMoving", false), 3000);
				
				});
		returnToNormal("#panel_"+curPanel);
			growBigger("#panel_"+next);
			
			curPanel = next;
		//������� ��� ���������� ��������� �������.
			$("#panel_"+(curPanel+1)).unbind();	
			
			//������� �� ���������
			$("#panel_"+(curPanel+1)).click(function(){ change(true); });
			
            //������� ��� ���������� ��������� �������.														
			$("#panel_"+(curPanel-1)).unbind();
			
			//������� �� ����������
			$("#panel_"+(curPanel-1)).click(function(){ change(false); }); 
			
			//������� ��� ���������� ��������� �������.
			$("#panel_"+curPanel).unbind();
		
		}
		
		}
		else if((!direction && (curPanel <= 1))) { 
		
		//�� ��������� � ��������� �����
        if (($("#slider").data("currentlyMoving") == false)) {
		//alert('begin');
		//return false; 
		$("#slider").data("currentlyMoving", true);
			
		var next         =  curPanel + (totalPanels-1);
		var leftValue    = $(".scrollContainer").css("left");
		var movement	 =  (parseFloat(leftValue, 10) + (movingDistance * (totalPanels-1)));
    	$(".scrollContainer")
				.stop()
				.animate({
					"left": movement
				}, 300,   function() {
				setTimeout($("#slider").data("currentlyMoving", false), 3000);
				});
		returnToNormal("#panel_"+curPanel);
			growBigger("#panel_"+next);
			
			curPanel = next;
		//������� ��� ���������� ��������� �������.
			$("#panel_"+(curPanel+1)).unbind();	
			
			//������� �� ���������
			$("#panel_"+(curPanel+1)).click(function(){ change(true); });
			
            //������� ��� ���������� ��������� �������.														
			$("#panel_"+(curPanel-1)).unbind();
			
			//������� �� ����������
			$("#panel_"+(curPanel-1)).click(function(){ change(false); }); 
			
			//������� ��� ���������� ��������� �������.
			$("#panel_"+curPanel).unbind();
		}
		
		}
		else{
		
		
        //�� ��������� � ��������� �����
        if (($("#slider").data("currentlyMoving") == false)) {
            
			$("#slider").data("currentlyMoving", true);
			
			var next         = direction ? curPanel + 1 : curPanel - 1;
			//alert(next);
			
			
			var leftValue    = $(".scrollContainer").css("left");
			var movement	 = direction ? (parseFloat(leftValue, 10) - movingDistance) : (parseFloat(leftValue, 10) + movingDistance);
		
			$(".scrollContainer")
				.stop()
				.animate({
					"left": movement
				}, 2000, 'linear',  function() {
				setTimeout($("#slider").data("currentlyMoving", false), 3000);
					
				});
			
			returnToNormal("#panel_"+curPanel);
			growBigger("#panel_"+next);
			
			curPanel = next;
			
			//������� ��� ���������� ��������� �������.
			$("#panel_"+(curPanel+1)).unbind();	
			
			//������� �� ���������
			$("#panel_"+(curPanel+1)).click(function(){ change(true); });
			
            //������� ��� ���������� ��������� �������.														
			$("#panel_"+(curPanel-1)).unbind();
			
			//������� �� ����������
			$("#panel_"+(curPanel-1)).click(function(){ change(false); }); 
			
			//������� ��� ���������� ��������� �������.
			$("#panel_"+curPanel).unbind();
			
			
		}
		
		}
	}
	///////////////////////////////////////////////////////////////////////////
	
	// ��������� ������� ������ � ������ "���������" - "����������"
	growBigger("#panel_3");	
	var curPanel = 3;
	
	$("#panel_"+(curPanel+1)).click(function(){ change(true); });
	$("#panel_"+(curPanel-1)).click(function(){ change(false); });
	
	//����� ������ ����� ��� ������ ������
	$(".right").click(function(){ change(true); });	
	$(".left").click(function(){ change(false); });
	
	
	
	
	$(window).keydown(function(event){
	  switch (event.keyCode) {
			case 13: //enter
				$(".right").click();
				break;
			case 32: //space
				$(".right").click();
				break;
	    case 37: //left arrow
				$(".left").click();
				break;
			case 39: //right arrow
				$(".right").click();
				break;
	  }
	});
	
	

	
	
});



