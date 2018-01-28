var hwSlideSpeed = 700;
var hwTimeOut = 3000;
$(document).ready(function (e) {
    var $slider = $('.W_slider'),
        $slide = $slider.filter(".-js").children(".B");
    $slide.eq(0).show();
    var slideNum = 0;
    var slideTime;
    slideCount = $slide.size();
    var animSlide = function (arrow) {
        clearTimeout(slideTime);
        $slide.eq(slideNum).fadeOut(hwSlideSpeed);
        if (arrow == "next") {
            if (slideNum == (slideCount - 1)) {
                slideNum = 0;
            }
            else {
                slideNum++
            }
        }
        else if (arrow == "prew") {
            if (slideNum == 0) {
                slideNum = slideCount - 1;
            }
            else {
                slideNum -= 1
            }
        }
        else {
            slideNum = arrow;
        }
        $('.W_slider > .B').eq(slideNum).fadeIn(hwSlideSpeed, rotator);
        $(".control-slide.active").removeClass("active");
        $('.control-slide').eq(slideNum).addClass('active');
    }
    var $adderSpan = '';
    $slide.each(function (index) {
        $adderSpan += '<span class = "control-slide">' + index + '</span>';
    });
    $('<div class="wrapSli"><div class ="sli-links">' + $adderSpan + '</div></div>').appendTo('.W_slider');
    $(".control-slide:first").addClass("active");
    $('.control-slide').click(function () {
        var goToNum = parseFloat($(this).text());
        animSlide(goToNum);
    });
    var pause = false;
    var rotator = function () {
        if (!pause) {
            slideTime = setTimeout(function () {
                animSlide('next')
            }, hwTimeOut);
        }
    }
    $slider.hover(
        function () {
            clearTimeout(slideTime);
            pause = true;
        },
        function () {
            pause = false;
            rotator();
        });
    rotator();

    //slider
    var blocks = $slider.children(".B");
    blocks.hide();
    var slides = $slider.find(".slide");
    slides.each(function () {
        var path = $(this).attr("src");
        $(this).parent(".B").css({
            background: "url('" + path + "') center top no-repeat",
            backgroundSize: "cover"
        })
        $(this).hide();
    });
    blocks.first().show();
});










//-var stopq = false;
//-function slidesChange(active,delay) {
//-$('.pagination a').click(function(){
//-    slidesChange($('.W_slider > .B:nth-child(' + ($(this).parents('li').index() + 1) + ')').next(), 5000);
//-});
//-if (stopq)
//-    return false
//-delay = delay || 2000;
//-$('.pagination a').removeClass("active");
//-if (active.index() == 0)
//-    $('.pagination li:nth-child(' + ($(".W_slider > .B").length) + ') a').addClass("active");
//-else
//-    $('.pagination li:nth-child(' + active.index() + ') a').addClass("active");
//-if (active.index() == 0)
//-    active.parents('.W_slider').find('.paginationWrap').prev('.B').delay(delay).fadeOut('slow');
//-else
//-    active.prev('.B').delay(delay).fadeOut('slow');
//-active.delay(delay).fadeIn("slow", function () {
//-    if (active.index() == ($(".W_slider > .B").length - 1))
//-        slidesChange($(this).parents('.W_slider').find('.B:first-child'),delay);
//-    else
//-        slidesChange($(this).next('.B'),delay);
//-});
//-};
(function ($) {
    $(window).load(function () {
        $('.ie7 input[type="text"],.ie7 input[type="email"],' +
            '.ie8 input[type="text"],.ie8 input[type="email"],' +
            '.ie9 input[type="text"],.ie9 input[type="email"]').each(function (i) {
            var value = $(this).attr("placeholder");
            $(this).attr("value", value);
        });
        $(".M_dropdown").each(function () {
            var $this = $(this),
                positionTop = $this.outerHeight() + 15;
            $this.find("ul").css({top: positionTop});
        });
        //$(".M_dropdown>a").click(function(e){
        //    e.preventDefault();
        //    var $this = $(this),
        //        href = $this.attr("href");
        //    $(href).toggle("slow");
        //});
        var $dropul = $(".M_dropdown>ul"),
            $dropa = $(".M_dropdown>a");
        function drop(e) {
            var $this = $(this),
                href = $this.attr("href");
            if (!href) {
                href = $this.children("a").attr("href");
            };
            if ($dropul.is(":visible")) {
                $dropul.stop().hide("normal");
            }
            $(href).show("normal");
        };
        function drop_close(e) {
                $dropul.stop().hide("normal");
        };
        $dropa.click(function (e) {
            e.preventDefault();
        });
        if ('ontouchstart' in document.documentElement) {
            $dropa.click(drop);
            $(document).click(function(e){
                if ($(e.target).closest('.M_dropdown').length == 0) {
                    drop_close();
                };
            });
        }else{
            $dropa.mouseover(drop);
            $(".M_dropdown").mouseleave(drop_close);
        };
        $(".form").validate();
        var posHead = $(".header").css("top"),
            posFoot = $(".footer").css("bottom"),
            bgWide =  - ($(".wrap").position().left+$(".wrap").outerWidth());
            /*$(".BG_wide").css({left: bgWide});*/
		
        $('#fullPage').fullpage({
            verticalCentered: false,

            //to avoid problems with css3 transforms and fixed elements in Chrome, as detailed here: https://github.com/alvarotrigo/fullPage.js/issues/208
            css3:false,
            anchors: ["main","company","products","clients","services","contacts"],
            menu: "#menu",
            onLeave: function(index, nextIndex, direction) {




                var $thisSection = $(this);
       
                if (index == 1 && direction == "down" || index == 3 && direction == "down" || index == 4 && direction == "down" || index == 5 && direction == "down"  ) {
                    $(".header").animate({top:-150},"slow");
                    $(".footer").animate({bottom:-150},"slow");
                    $(".column header").slideDown("slow");
             
                    
                }else if (nextIndex == 1) {
                    $(".column header").slideUp("slow");
                    $(".header").animate({top:posHead},"slow");
                    $(".footer").animate({bottom:posFoot},"slow");
                    
                      
                };
                if (nextIndex == 3 || nextIndex == 5  || nextIndex == 6) {
                    //$(".column header").slideUp("slow");
                    $(".footer").animate({bottom:posFoot},"slow");
                }; 
                if (nextIndex == 2 || nextIndex == 4 ) {
                    $(".header").animate({top:-150},"slow");
                    $(".footer").animate({bottom:-150},"slow");
                    $(".column header").slideDown("slow");
                };  
                
                if( direction == "down" ){
        
                $(".BG_wide-1").addClass('animated bounceInLeft b2-anim-1 opacity');
                $(".info-comp").addClass('animated bounceIn b2-anim-2 opacity');
                $(".BG_wide-2").addClass('animated bounceInLeft b2-anim-3 opacity');
                $(".marker-1").addClass('animated bounceInUp b2-anim-4 opacity');
                $(".marker-2").addClass('animated bounceInUp b2-anim-5 opacity');
                $(".marker-3").addClass('animated bounceInUp b2-anim-6 opacity');
                $(".marker-4").addClass('animated bounceInUp b2-anim-7 opacity');
                $(".marker-5").addClass('animated bounceInUp b2-anim-8 opacity');
                $(".marker-6").addClass('animated bounceInUp b2-anim-9 opacity');
                $(".marker-7").addClass('animated bounceInUp b2-anim-10 opacity');
                };
                
       if( index == 2 && direction == "down" || index == 3){
            $("#idProducts .BG_wide").addClass('animated bounceInLeft b2-anim-1 opacity');
            $("#idProducts .wrap h2").addClass('animated bounceInLeft b2-anim-3 opacity');
            $("#idProducts .list-product-min").addClass('animated bounceInUp b2-anim-4 opacity');
        };   
       if( index == 3 && direction == "down" || index == 4 ){
            $(".BG_wide-3").addClass('animated bounceInLeft b2-anim-1 opacity');
            $(".slide-klientfirst").addClass('animated zoomInDown b2-anim-2 opacity');
            $(".wrapper-slider .prev").addClass('animated bounceInLeft b2-anim-3 opacity');
            $(".wrapper-slider .next").addClass('animated bounceInRight  b2-anim-4 opacity');
            $(".BG_wide-4").addClass('animated bounceInLeft b2-anim-5 opacity');
            $(".slide-klientsecond").addClass('animated zoomInDown b2-anim-6 opacity');
            $(".wrapper-slider-next .prev").addClass('animated bounceInLeft b2-anim-7 opacity');
            $(".wrapper-slider-next .next").addClass('animated bounceInRight  b2-anim-8 opacity');
        }; 
       if( index == 4 && direction == "down" || index == 5 ){
            $(".BG_wide-5").addClass('animated bounceInLeft b2-anim-1 opacity');
            $(".marker-8").addClass('animated bounceInUp b2-anim-2 opacity');
            $(".marker-9").addClass('animated bounceInUp b2-anim-3 opacity');
            $(".marker-10").addClass('animated bounceInUp b2-anim-4 opacity');
            $(".marker-11").addClass('animated bounceInUp b2-anim-5 opacity');
        };   
       if( index == 5 && direction == "down" || index == 6){
            $(".BG_wide-6").addClass('animated bounceInLeft b2-anim-1 opacity');
            $(".B.kaliningrad").addClass('animated bounceIn b2-anim-2 opacity');
            $(".B_map").addClass('animated bounceIn b2-anim-3 opacity');
            $(".W_accordion").addClass('animated bounceInUp b2-anim-4 opacity');
        };        
		
         if( index == 2){      
		 //alert(index);.//
		$(".sss").addClass("active");
		  //$('#ddd0').click();
           };                 
            },
            afterLoad: function(anchorLink, index) {
                var $loadedSection = $(this);
               /* $(".BG_wide").css({left:bgWide}); 
                $loadedSection.find(".BG_wide").animate({left:0}, "slow"); */
                if(index==1){

                    $('.column > .ins > div').fadeOut(500);

                }else{

                    $('.column > .ins > div').fadeIn(500);

                }
                 
            }
        });
		$('#fullPage').css('height',"100%");
		$('.section').css('height',"100%");
        $(".intro").mCustomScrollbar({
            axis: "y",
            setHeight: "100%"
        });
        var $blocksHide = $(".B.-hide");
        $blocksHide.children(".TL").click(function(){

        });
        var $list = $(".marker li.-hide");
        $list.hover(
            function(){

            },
            function(){

            }
        );
        //-var blockActive = blocks.first();
        //-blockActive.fadeIn();
        //-for(var i = 0; i < blocks.length; i++){
        //-    slider.find('.pagination').append('<li><a href="#"></a></li>');
        //-}
        //-$('.pagination li:first-child a').addClass('active');
        //-slidesChange(blockActive.next(), 5000);*/
    });
})(jQuery);

$(window).load(function () {
        
       $('.fp-prev.fp-controlArrow').addClass('animated bounceInLeft b2-anim-7');
    $('.fp-next.fp-controlArrow').addClass('animated bounceInRight b2-anim-8');
});
/*Accordeon*/
$(document).ready(function () {
         
      
		$(document).on('click', '#cont', function() {
            $(".contacts-link a").click();
            
        });  


        $(document).on('click', '.toggle-link-prod', function() {
            $('.column .M li.parent ul li a.toggle-link-prod').css('color','#fff');
            $(this).addClass('active');

        }); 

        
        $(window).load(function () {
            $('.column .M li.parent ul li a.toggle-link-prod.ss').addClass('active');
        });

        
        


		$(document).on('click', '.sss', function() {
            $("#ddd"+$(this).attr('ids')).click();
            $(this).addClass('active');
			 $(this).addClass('active');
        }); 
		
       $('.toggle-link-prod').on('click',function(e){
            $("#idProducts .BG_wide").addClass('animated bounceInLeft b2-anim-1 opacity');
            $("#idProducts .wrap h2").addClass('animated bounceInLeft b2-anim-3 opacity');
            $("#idProducts .list-product-min").addClass('animated bounceInUp b2-anim-4 opacity');
        });   
       $('.clients-link').on('click',function(e){
            $(".BG_wide-3").addClass('animated bounceInLeft b2-anim-1 opacity');
            $(".slide-klientfirst").addClass('animated zoomInDown b2-anim-2 opacity');
            $(".wrapper-slider .prev").addClass('animated bounceInLeft b2-anim-3 opacity');
            $(".wrapper-slider .next").addClass('animated bounceInRight  b2-anim-4 opacity');
            $(".BG_wide-4").addClass('animated bounceInLeft b2-anim-5 opacity');
            $(".slide-klientsecond").addClass('animated zoomInDown b2-anim-6 opacity');
            $(".wrapper-slider-next .prev").addClass('animated bounceInLeft b2-anim-7 opacity');
            $(".wrapper-slider-next .next").addClass('animated bounceInRight  b2-anim-8 opacity');
        });  
       $('.services-link').on('click',function(e){
            $(".BG_wide-5").addClass('animated bounceInLeft b2-anim-1 opacity');
            $(".marker-8").addClass('animated bounceInUp b2-anim-2 opacity');
            $(".marker-9").addClass('animated bounceInUp b2-anim-3 opacity');
            $(".marker-10").addClass('animated bounceInUp b2-anim-4 opacity');
            $(".marker-11").addClass('animated bounceInUp b2-anim-5 opacity');
        });   
       $('.contacts-link').on('click',function(e){
            $(".BG_wide-6").addClass('animated bounceInLeft b2-anim-1 opacity');
            $(".B.kaliningrad").addClass('animated bounceIn b2-anim-2 opacity');
            $(".B_map").addClass('animated bounceIn b2-anim-3 opacity');
            $(".W_accordion").addClass('animated bounceInUp b2-anim-4 opacity');
        });                  
                
    
    
    
    
    
    
    $("#callback").submit(function() {
		$.ajax({
			type: "POST",
			url: "/include/mail.php",
			data: $("#callback").serialize()
		}).done(function() {
			$('#zayavka').fadeIn();
            $('.zayavka-prinata p span').removeClass('zero');
            setTimeout(function() {
				$('.zayavka-prinata p span').addClass('two'); 
			}, 1000); 
            setTimeout(function() {
                $('.zayavka-prinata p span').removeClass('two'); 
				$('.zayavka-prinata p span').addClass('one'); 
			}, 2000);
            setTimeout(function() {
                $('.zayavka-prinata p span').removeClass('one'); 
				$('.zayavka-prinata p span').addClass('zero'); 
			}, 3000);             
            setTimeout(function() {
			   $('#zayavka').fadeOut();
               $("#callback").trigger("reset");
			}, 4000);
		});
		return false;
	});
    
    $('.zayavka-prinata .right .close').on('click',function(e){
        $('#zayavka').fadeOut();
    });
    
    
     $('.accordeon-trigger').on('click',function(e){
         
         
         var $this = $(this),
             item = $this.closest('.accordeon-item'),
             list = $this.closest('.W_accordion'),
             button = item.find('.accordeon-trigger'),
             buttons = list.find('.accordeon-trigger'),
             items = list.find('.accordeon-item'),
             content = item.find('.text'),
             otherContent = list.find('.text'),
             duration = 100,
             itemPositon = button.index();
  
         if(!item.hasClass('active')){
             items.removeClass('active');
             item.addClass('active');
             otherContent.stop().slideUp(duration);
             content.stop().slideDown(duration);
         }else{
             item.stop().removeClass('active');
             content.stop().slideUp(duration);
         }
     });   
    
    $('.trigger-1').on('click',function(e){
         if($('.moskva-item').hasClass('active')  ){
             $('span.dots').removeClass('active');
             $('span.moskva').addClass('active');  
         }else{
             $('span.dots').removeClass('active');
         }        
    });
    $('.trigger-2').on('click',function(e){
         if($('.peterburg-item').hasClass('active')  ){
             $('span.dots').removeClass('active');
             $(' span.peterburg').addClass('active');  
         }else{
             $('span.dots').removeClass('active');
         }      
    });   
    $('.trigger-3').on('click',function(e){
         if($('.krasnodar-item').hasClass('active')  ){
             $('span.dots').removeClass('active');
             $('span.krasnodar').addClass('active');  
         }else{
             $('span.dots').removeClass('active');
         }        
    });
    $('.trigger-4').on('click',function(e){
         if($('.chelab-item').hasClass('active')  ){
             $('span.dots').removeClass('active');
             $(' span.chelab').addClass('active');  
         }else{
             $('span.dots').removeClass('active');
         }      
    });     
    
    
    $('span.moskva').on('click',function(e){
        if(!$('span.moskva').hasClass('active') ){
                $('span.dots').removeClass('active');
                $('span.moskva').addClass('active');
                $('.accordeon-item').removeClass('active');
                $('.moskva-item').addClass('active');
                $('.accordeon-item .text').stop().slideUp(100);
                $('.moskva-item .text').stop().slideDown(100);
        }else{
            $('span.moskva').removeClass('active');
            $('.moskva-item .text').stop().slideUp(100);
            $('.moskva-item').removeClass('active');
        }
    });
    
    $('span.peterburg').on('click',function(e){
        if(!$('span.peterburg').hasClass('active') ){
                $('span.dots').removeClass('active');
                $('span.peterburg').addClass('active');
                $('.accordeon-item').removeClass('active');
                $('.peterburg-item').addClass('active');
                $('.accordeon-item .text').stop().slideUp(100);
                $('.peterburg-item .text').stop().slideDown(100);
        }else{
            $('span.peterburg').removeClass('active');
            $('.peterburg-item .text').stop().slideUp(100);
            $('.peterburg-item').removeClass('active');
        }        
 
    });   
    
    $('span.chelab').on('click',function(e){
        if(!$('span.chelab').hasClass('active') ){
                $('span.dots').removeClass('active');
                $('span.chelab').addClass('active');
                $('.accordeon-item').removeClass('active');
                $('.chelab-item').addClass('active');
                $('.accordeon-item .text').stop().slideUp(100);
                $('.chelab-item .text').stop().slideDown(100);
        }else{
            $('span.chelab').removeClass('active');
            $('.chelab-item .text').stop().slideUp(100);
            $('.chelab-item').removeClass('active');
        }                
    }); 
    $('span.krasnodar').on('click',function(e){
        if(!$('span.krasnodar').hasClass('active') ){
                $('span.dots').removeClass('active');
                $('span.krasnodar').addClass('active');
                $('.accordeon-item').removeClass('active');
                $('.krasnodar-item').addClass('active');
                $('.accordeon-item .text').stop().slideUp(100);
                $('.krasnodar-item .text').stop().slideDown(100);
        }else{
            $('span.krasnodar').removeClass('active');
            $('.krasnodar-item .text').stop().slideUp(100);
            $('.krasnodar-item').removeClass('active');
        }           
    });   
    
     
    
});
/*Accordeon*/

$(document).ready(function () {
    
        $('.list-product-min').slick({
        slidesToShow: 9,
        slidesToScroll: 1,
		 speed: 1000,
        prevArrow:'.wplist .controllers .prev',
        nextArrow:'.wplist .controllers  .next', 
          responsive: [
            {
              breakpoint: 1280,
              settings: {
                slidesToShow: 6,
                slidesToScroll: 1
              }
            },
            {
              breakpoint: 780,
              settings: {
                slidesToShow: 5,
                slidesToScroll: 1
              }
            },
           {
              breakpoint: 450,
              settings: {
                slidesToShow: 4,
                slidesToScroll: 1
              }
            }			  
            // You can unslick at a given breakpoint now by adding:
            // settings: "unslick"
            // instead of a settings object
          ]       
     }); 
    
    
       $('.button-aside').on('click', function(){
           $('body aside.column').toggleClass('active');
       });    
    
    
       $('.parent').on('click', function(){
           $('.parent').addClass('active');
		   $('#ddd0').click();
       });
        
     
 
    
    $('.slide-klientfirst').slick({
        slidesToShow: 2,
        slidesToScroll: 1,
        autoplay:false,
         autoplaySpeed:3000,
		 dots:false,
		 fade:false,
		 speed: 1000,
        prevArrow:'.wrapper-slider .controllers .prev',
        nextArrow:'.wrapper-slider .controllers  .next',   
          responsive: [
            {
              breakpoint: 480,
              settings: {
                slidesToShow: 1
              }
            }
          ]        
        
        
     });
    
    $('.slide-klientsecond').slick({
        slidesToShow: 3,
        slidesToScroll: 1,
        autoplay:false,
         autoplaySpeed:3000,
		 dots:false,
		 fade:false,
		 speed: 1000,
        prevArrow:'.wrapper-slider-next .controllers .prev',
        nextArrow:'.wrapper-slider-next .controllers  .next', 
          responsive: [
            {
              breakpoint: 480,
              settings: {
                slidesToShow: 1
              }
            }
          ]        
     });  
 
    
    
   $("a.grouped_elements").fancybox();
   $("a.BTN_sm").fancybox({'width':'360','height':'360','minWidth'  : '360', 'minHeight' : '420',});
   $(document).on('click', ".okitoki", function() {
		 $.fancybox.close();
	});
   
   
   $(".sends").on("click",function(event){
	
			$.post("/include/mail.php", {name:$("#names").val(),phone: $("#phoness").val(),type: 'Обратный звонок'} , function(data) {
				$(".content_for").css('background','#fff');
				$(".content_for").html('<center><h3 Class="zvanok_title_od">Заявка успешно отправлена!</h3><img width="80px" src="/bitrix/templates/neman/img/oks.jpg"><p>наш менеджер связется с вами в билайшее время</p><a href="javascript:void(0);" class="okitoki"></a></center>');
					
				});
	
	});

   
    $('#idProducts .display').on('click',function(e){
        $('.text').stop().slideUp(); 
        $('header').removeClass('active');
    });
   $('#idProducts header').on('click',function(e){
       
       var 
             $this = $(this),
             item = $this.closest('.B_hide'),
             list = $this.closest('.section'),
             moreOther = list.find('header'),
             content = item.find('.text'),
             otherContent = list.find('.text');   
       
        if(!$this.hasClass('active')){
             moreOther.removeClass('active');
             $this.addClass('active');
             otherContent.stop().slideUp(); 
             content.stop().slideDown();            
            
         }else{
             $this.stop().removeClass('active');
             otherContent.stop().slideUp();               
         }        
   }); 
    
    
    
   $('.toggle-link-prod').on('click',function(e){
       
       var 
             $this = $(this),
             item = $this.closest('.parent li'),
             list = $this.closest('.parent'),
             otherItem = list.find('.toggle-link-prod');   
       
        if(!$this.hasClass('active')){
             otherItem.removeClass('active');
             $this.addClass('active');          
            
         }else{
             otherItem.removeClass('active');           
         }        
   }); 
    
});

$(document).ready(function () {
	
  $('.next_pic').on('click',function(e){
      curent=$(this).parent().find('.list-product-min').find('li.actives');
	
	if((curent.index()+1)==$(this).parent().find('.list-product-min').find('li').length){
		next=$(this).parent().find('.list-product-min').find('li').eq(0);
	}else{
		next=curent.next();
	}
	var $this = $(this),
	display = $(this).parent().find('.display'),
             path = next.find('img').attr('src'),
             duration = 0;
         
         display.find('img').stop().fadeIn( function(){
             $(this).attr('src', path).stop().show();
			  });
	  next.addClass('actives');
	  curent.removeClass('actives');
     });



	 
$('.pref_pic').on('click',function(e){
      curent=$(this).parent().find('.list-product-min').find('li.actives');
	
	if(next.index()==0){
		next=$(this).parent().find('.list-product-min').find('li').eq(($(this).parent().find('.list-product-min').find('li').length-1));
	}else{
		next=curent.prev();
	}
	var $this = $(this),
	display = $(this).parent().find('.display'),
             path = next.find('img').attr('src'),
             duration = 0;
         
         display.find('img').stop().fadeIn( function(){
             $(this).attr('src', path).stop().show();
			  });
	  next.addClass('actives');
	  curent.removeClass('actives');
     });
	 
     $('.product_pic').on('click',function(e){
		 
         e.preventDefault(); 
          curent=$(this).parent().parent().parent().parent().parent().find('.list-product-min').find('li.actives');
         var $this = $(this),
             item = $this.closest('.product_item'),
             container = $this.closest('.slide-1'),
             display = container.find('.display'),
             path = item.find('img').attr('src'),
             duration = 0;
         
         display.find('img').stop().fadeIn( function(){
             $(this).attr('src', path).stop().show();
         });
		curent.removeClass('actives');
		$(this).parent().addClass('actives');
     }); 
     $('.product_pic_2').on('click',function(e){
         e.preventDefault(); 
         curent=$(this).parent().find('.list-product-min').find('li.actives');
         var $this = $(this),
             item = $this.closest('.product_item'),
             container = $this.closest('.slide-2'),
             display = container.find('.display'),
             path = item.find('img').attr('src'),
             duration = 300;
         
        display.find('img').stop().fadeIn( function(){
             $(this).attr('src', path).stop().show();
         });
curent.removeClass('actives');
		$(this).parent().addClass('actives');
     });    
     $('.product_pic_3').on('click',function(e){
         e.preventDefault(); 
          curent=$(this).parent().find('.list-product-min').find('li.actives');
         var $this = $(this),
             item = $this.closest('.product_item'),
             container = $this.closest('.slide-3'),
             display = container.find('.display'),
             path = item.find('img').attr('src'),
             duration = 300;
         
         display.find('img').stop().fadeIn( function(){
             $(this).attr('src', path).stop().show();
         });
curent.removeClass('actives');
		$(this).parent().addClass('actives');
     });     
});

$(window).load(function () {
  new WOW().init();
   
   
});





