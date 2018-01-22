jQuery(function($) {
	$(document).ready(function($) {
		update();
	});
	$( window ).resize(function(event) {
		update();
		setTimeout(function(){
			update();
		}, 100);
	});

	function update(){

		// full map
		$(".fullmap").height($(".center").height());

		// full weather
		var leftpos = $(".weather").position().left;
		$(".weatherfull").css({ left:leftpos - 30});

		// width noresize to other width
		var w = $(".logo").width() + $(".noresize").width();
	//	$(".other").css({ width: 'calc(100% - ' + w + 'px)' });
/*
		// profile
		if(parseInt($(".mypage").width()) < 150){
			$(".mypage .clicked .avatar").hide();
		} else $(".mypage .clicked .avatar").show();

		var leftpos = $(".mypage").position().left;
		leftpos = leftpos - $(".mypagefull").width() + $(".mypage .clicked").width();
		$(".mypagefull").css({ left: leftpos });

		$(".radio .clicked").width($(".radio").width()-2);

		var leftpos = $(".radio").position().left;
		leftpos = leftpos - $(".radiochosefull").width() + $(".radio .clicked").width(); 
		if(jQuery(document).width()>1400){
			leftpos = leftpos + 30;
		}
		$(".radiochosefull").css({ left: leftpos });

		var leftpos = $(".radio").position().left;
		leftpos = leftpos - $(".radioplayerfull").width() + $(".radio .clicked").width(); 
		if(jQuery(document).width()>1400){
			leftpos = leftpos + 30;
		}
		$(".radioplayerfull").css({ left: leftpos });
*/
	};

	// map
	var isShowMap = false;
	$(".map").click(function() {
		if(!isShowMap){
			hideAll();
			isShowMap = true;

			$(".fullmap").height($(".center").height());
			$(".fullmap").show("fold", 1000);
		}else{
			isShowMap = false;
			$(".fullmap").hide("fold", 1000);
		}
	});

	// weather
	isShowWeather = false;
	time1=false;
	$(".wth2 .clicked").click(function() {
	    
	   // if(time1==false){
		if(!isShowWeather){
			hideAll();
			isShowWeather = true;

			var leftpos = $(".weather").position().left;
			$(".weatherfull").css({ left:leftpos - 30});

			$(".weatherfull").show("blind", 500);
			$(".weather").addClass('opened');
		    
		    time1=true;
		    
		   
		}else{
		     isShowWeather = false;
    		$(".weatherfull").hide("blind", 500);
    		$(".weather").removeClass('opened');
		}
	  //  }else{
	        
	  //     isShowWeather = false;
	//		$(".weatherfull").hide("blind", 500); 
	        
	  //  }
	});
	
	/*$(".wth2").mouseleave(function() {
        
        if(time1==false){
        if(isShowWeather){
            isShowWeather = false;
			$(".weatherfull").hide("blind", 500);
			setTimeout(function(){
				$(".weather").removeClass('opened');
			}, 500);
			
			
			time1=true;
		    
		    setInterval( function() {
		        time1=false;
		    } , 3000);
		    
		    
		    
		    
		}
        }

	});*/
	
	
	
	

	// mypage
	var isShowMypage = false;
	/*$(".mypage .clicked").click(function() {
		ShowMypage();
	});*/

	$(".mypage .clicked .avatar").click(function() {
		ShowMypage();
	});

	function ShowMypage(){
		if(!isShowMypage){
			hideAll();
			isShowMypage = true;

			var leftpos = $(".mypage").position().left;
			leftpos = leftpos - $(".mypagefull").width() + $(".mypage .clicked").width();
			$(".mypagefull").css({ left: leftpos });

			$(".mypagefull").show("blind", 500);
			$(".mypage").addClass('opened');
		}else{
			isShowMypage = false;
			$(".mypagefull").hide("blind", 500);
			setTimeout(function(){
				$(".mypage").removeClass('opened');
			}, 500);
		}
	}

	// radio
	var isShowRadio = false;
	var isRadioPlay = false;
	$(".radio .clicked").click(function() {
	/*	if(!isShowRadio){
			hideAll();
			isShowRadio = true; 

			var leftpos = $(".radio").position().left;
			leftpos = leftpos - $(".radiochosefull").width() + $(".radio .clicked").width();
			if(jQuery(document).width()>1400){
				leftpos = leftpos + 30;
			}
			$(".radiochosefull").css({ left: leftpos });

			var leftpos = $(".radio").position().left;
			leftpos = leftpos - $(".radioplayerfull").width() + $(".radio .clicked").width(); 
			if(jQuery(document).width()>1400){
				leftpos = leftpos + 30;
			}
			$(".radioplayerfull").css({ left: leftpos });

			if(!isRadioPlay) $(".radiochosefull").show("blind", 500);
			else $(".radioplayerfull").show("blind", 500);
			$(".radio").addClass('opened');
		}else{
			isShowRadio = false;
			
			$(".radiochosefull").hide("blind", 500);
			$(".radioplayerfull").hide("blind", 500);
			setTimeout(function(){
				$(".radio").removeClass('opened');
			}, 500);
		}*/
	});

	// search
	
	var class1=0;
	
	$(".search input[type='submit']").click(function() {
		var searchWidth = parseInt($(".social").css("width"));
		var text = $('.search input[type="text"]').val();
		 
		 
		//var class1=$(".search").hasClass("opened");
		
		
		
        if(class1==0){
		if(searchWidth>0){
			$('.search input[type="text"]').focus();
			$(".search").addClass('opened');
			$(".social").css({ width:'0'});


			$(".search").css({ transition: 'width 0.5s ease-out 0s' });
			$(".social").css({ transition: 'width 0.5s ease-out 0s' });

			setTimeout(function() {
				$(".search").css({ transition: '' });
				$(".social").css({ transition: '' });
			}, 500);
		}
		class1=1;
		
        }else{
		
		
		
		
		$(".social").css({ width:''});
			$(".search").removeClass('opened');

			$(".search").css({ transition: 'width 0.5s ease-out 0s' });
			$(".social").css({ transition: 'width 0.5s ease-out 0s' });

			setTimeout(function() {
				$(".search").css({ transition: '' });
				$(".social").css({ transition: '' });
			}, 500);
		
		
		class1=0;
		
		
        }
		
		return false;
		
		

		
		
		
	});

	$('.search input[type="text"]').focusout(function(event) {

		var searchWidth = parseInt($(".social").css("width"));
		var text = $('.search input[type="text"]').val();

		if(searchWidth==0 && $.trim(text) == ""){
			$(".social").css({ width:''});
			$(".search").removeClass('opened');

			$(".search").css({ transition: 'width 0.5s ease-out 0s' });
			$(".social").css({ transition: 'width 0.5s ease-out 0s' });

			setTimeout(function() {
				$(".search").css({ transition: '' });
				$(".social").css({ transition: '' });
			}, 500);
		}

	});

	$('.search input[type="text"]').change(function(event) {
		var text = $(this).val();

		if($.trim(text) == ""){
			$(".search input[type='submit']").attr("onclick","return false;");
		} else {
			$(".search input[type='submit']").attr("onclick","return true;");
		}
	});

	// footer
	$(".footer .top").click(function() {

		var bottomPos = parseInt($( ".footer" ).css("bottom"));

		if(bottomPos<0){
			hideAll();
			$( ".footer" ).css({ bottom:'0px'});
			$( ".footer > .top .spoil").css({ backgroundImage:'url(/templates/infinitilife/images/spoil1.png)'});
			$( ".footer .spoil").html("Инструменты, нажмите чтобы свернуть");
			
		}else{
			$( ".footer" ).css({ bottom:'-350px'});
			$( ".footer > .top .spoil").css({ backgroundImage:'url(/templates/infinitilife/images/spoil.png)'});
			$( ".footer .spoil").html("Инструменты, нажмите чтобы развернуть");
		}
	});


	function hideAll(){
		// hide all
		isShowMap = false;
		$(".fullmap").hide("fold", 1000);

		isShowWeather = false;
		$(".weatherfull").hide("blind", 500);
		$(".weather").removeClass('opened');

		isShowMypage = false;
		$(".mypagefull").hide("blind", 500);
			$(".mypage").removeClass('opened');

		isShowRadio = false;
		
		$(".radiochosefull").hide("blind", 500);
		$(".radioplayerfull").hide("blind", 500);
		$(".radio").removeClass('opened');
		$( ".footer" ).css({ bottom:'-350px'});
	}

var log1=0;

    $('.datepick').pickmeup({
        format  : 'd.m.Y',
        position		: 'left',
        hide_on_select	: true,
        locale			: {
            days		: ["Воскресенье", "Понедельник", "Вторник", "Среда", "Четверг", "Пятница", "Суббота", "Воскресенье"],
            daysShort	: ['Вс', 'Пн', 'Вт', 'Ср', 'Чт', 'Пт', 'Сб', 'Вс'],
            daysMin		: ['Вс', 'Пн', 'Вт', 'Ср', 'Чт', 'Пт', 'Сб', 'Вс'],
            months		: ['Январь', 'Февраль', 'Март', 'Апрель', 'Май', 'Июнь', 'Июль', 'Август', 'Сентябрь', 'Октябрь', 'Ноябрь', 'Декабрь'],
            monthsShort	: ['Янв', 'Фев', 'Март', 'Апр', 'Май', 'Июнь', 'Июль', 'Авг', 'Сент', 'Окт', 'Нояб', 'Дек']
        },
        change: function(event){
            $(".datepick a").text(event);
			
            $(".datepick .datepickhidden").val(event);
            var date = event.split(".")
           // window.location.href = '?day='+date[0]+'&month='+date[1]+'&year='+date[2]+'';
        window.location.href = '?day='+date[2]+'-'+date[1]+'-'+date[0]+'';
		},
		show : function(event){
			
			//alert(log1);
			if(log1==0){
			log1=1;	
			$(".hd1").css("display", "block"); 
			$(".hd1").css("position", "absolute");
			$(".hd1").css("width", "100%");
			$(".hd1").css("height", "100%");
			$(".hd1").css("z-index", "9999");
			
			
			
			}else{

			
			log1=0;	
			
			$(".hd1").css("display", "none");
			
			
			}
	
	
	
		}
    });
    
    
    $('.hd1').click(function(){
        
    $('.datepick').pickmeup('hide');
	$(".hd1").css("display", "none");
        //
        
        
   
    });
  
    
    
    
    
    
    
});