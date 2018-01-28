$(document).ready(function(){// skript opredelyaet 1 i posledniy element li v menu
  
    //$('.wrapp_list_catalog ul').find('li:first-child').addClass(" first");
    $('.wrapp_list_catalog ul').find('li:last-child').addClass(" last");
    
});
$(document).ready(function(){
    var hight = $(".wrapp_list_catalog").outerHeight();
    $(".wrapp_list_catalog").css({"height": "49px"});
    /*var html = $(".wrapp_list_catalog ul").html();*/
    var text_clic = $(".reset").text();
    var hight_clik = $(".reset").height();
    var width_clik = $(".reset").width();
    $(".reset").text("").css({
                "height": "49px",
                "width": "10px",
                "overflow": "hidden"
            }).addClass(" ok");
    $(".reset").click(function () {
        var size = $(".wrapp_list_catalog").outerHeight();
        if(size >= hight){
            $(".wrapp_list_catalog").animate({
                height: "49px"
            },1000);
            
            $(".reset").text("").animate({
                "height": "49px",
                "width": "10px",
                "overflow": "hidden"
            },1000).addClass(" ok");
			$(".next-prev-buttons").animate({
                top: "95px"
            },1000);
			$("#help_message_finder").animate({
                top: "-11px"
            },1000);
        }else{
            $(".wrapp_list_catalog").animate({
                height: hight
            },1000);
            /*$(".wrapp_list_catalog ul ").html(html);*/
            $(".reset").text(text_clic).animate({			
                "padding": "5px 15px",
                "height": hight_clik,
                "width": width_clik
            },1000).removeClass(" ok");
			$(".next-prev-buttons").animate({
                top: "210px"
            },1000);
			$("#help_message_finder").animate({
                top: "-135px"
            },1000);
        }
    });
	$(".tabNavigation a").click(function () {
		$(".wrapp_list_catalog").animate({
			height: hight
		},1000);
		/*$(".wrapp_list_catalog ul ").html(html);*/
		$(".reset").text(text_clic).animate({
			"height": hight_clik,
			"padding": "5px 15px",
			"width": width_clik
		},1000).removeClass(" ok");
	});

	// -------------------------------------------------------------------------
	if($(".photoslider ul").length > 0 && $(".photoslider ul li").length > 1)
	{
		$(".photoslider").jCarouselLite({
				mouseWheel: true,
				auto: false, 
				speed: 			800,
				btnNext: ".next",
				btnPrev: ".prev",
				visible: 4
			});
	}

	if($(".photoslider2 ul").length > 0 && $(".photoslider2 ul li").length > 1)
	{
		$(".photoslider2").jCarouselLite({
				mouseWheel: true,
				auto: false, 
				speed: 800,
				btnNext: ".next1",
				btnPrev: ".prev1",
				visible: 4
			});
	}

	$('.ps-full').each(function(){
		var clas = $(this).attr('class');
		clas = clas.replace(' ps-full', '');
		var id = clas.replace('photoslider', '');
		if( $('.' + clas + ' ul').length > 0 ){
			$('.' + clas).jCarouselLite({
				mouseWheel: true,
				auto: false, 
				speed: 800,
				btnNext: ".next" + id,
				btnPrev: ".prev" + id,
				visible: 1
			});
		}
	});
	
	if($('.coll-main-slider ul').length > 0 && $(".coll-main-slider ul li").length > 1)
	{
		var btnGoArr = [];
		$('.cont-mini img').each(function(){
			btnGoArr.push('#' + $(this).attr('id'));
		});
		console.log(btnGoArr);
		var carousel = $('.coll-main-slider').jCarouselLite({
			mouseWheel: true,
			auto: false, 
			speed: 800,
			btnNext: ".next",
			btnPrev: ".prev",
			btnGo: btnGoArr,
			afterEnd: function(e){
				var obj = e[0].getElementsByTagName('div');
				var id = obj[0].getAttribute('class').replace('slider_img img', '');
				
				$('.cont-mini img').each(function(){
					$(this).attr('class', '');
				});
				$('#mini-' + id).attr('class', 'cm-selected');
				// console.log();
			},
			visible: 1
		});
	}
	// -------------------------------------------------------------------------

	var return_data = [];
	$('.input_search').autocomplete({
            source: function(request, response)
			{
                var myreq = $.ajax({
					type: 'POST',
					url: '/poisk-po-saytu/',
					data: 'module=search&action=ajax_search&ajax=1&query=' + $('.input_search').val(),
					dataType: 'json',
					success: function(data){
						console.log(data);
						response($.map(data['data'], function(item, index){
							return { label: item.name, value: item.name, url: item.url, category: item.category };
						}));
					}
				});
            },
            minLength: 3,
            open: function()
			{
				$(this).autocomplete('widget').css('top', $(this).autocomplete('widget').offset().top - 7);
				$(this).autocomplete('widget').css('left', $(this).autocomplete('widget').offset().left - 135);
                $(this).autocomplete('widget').css('z-index', 100);
                return false;
            },
            select: function( event, ui )
			{
                if(ui.item.url){
                    location.href = ui.item.url;
                    return false;
                }
            }
        }).data('ui-autocomplete')._renderItem = function( ul, item ){
			if(item.category != 'explode')
			{
				return $( "<li>" )
					.data( "autocomplete-item", item )
					.append( '<a><span class="link">' + item.label + '</span><span class="type">' + item.category + '</span><div style="clear: both;"></div></a>' )
					.appendTo( ul );
			} else {
				return $( "<li>" )
					.data( "autocomplete-item", item )
					.append( '<div class="ui-autocomplete-explode"></div>' )
					.appendTo( ul );
			}
	};
	
	function returnData(data)
	{
		// return_data = [];
		console.log(data['data']);
		// return_data = data['data'];
		response($.map(data, function(item, index) {
                        return { label: item.name, value: item.name, url: item.url, category: item.category };
                    }));
		// return data['data'];
	}
	function doSearch(url, term, response) {
            $.getJSON(url, { query: term }, function (data) {
                    response($.map(data, function(item, index) {
                        return { label: item.name, value: item.name, url: item.url, category: item.category };
                    }));
                });
        }
});



jQuery(document).ready(function() {
    jQuery('#mycarousel').jcarousel({
        wrap: 'circular',
        scroll: 1,
        auto: 700
    });
});

$(window).load(function(){
	if($('.flexslider').length > 0)
	{
		$('.flexslider').flexslider({
			animation: "slide",
			start: function(slider){
				$('body').removeClass('loading');
			}
		});
	}
});
$(function () {
    var tabContainers = $('div.wrapp_list > div'); // получаем массив контейнеров
    tabContainers.hide().filter(':first').show(); // прячем все, кроме первого
    // далее обрабатывается клик по вкладке
    $('div.wrapp_list ul.tabNavigation a').click(function () {
        tabContainers.hide(); // прячем все табы
        tabContainers.filter(this.hash).show(); // показываем содержимое текущего
        $('div.wrapp_list ul.tabNavigation a').removeClass('selected'); // у всех убираем класс 'selected'
        $(this).addClass('selected'); // текушей вкладке добавляем класс 'selected'
        return false;
    }).filter(':first').click();
});
 
  
$(document).ready(function(){
	$(document).on('click','.next-fp', function(){
		var current = parseInt($('.filter-paginator span').html());
		var first = parseInt($('.filter-paginator a.fp_to_first').attr('id').replace('fp_to_first_', ''));
		var last = parseInt($('.filter-paginator a.fp_to_last').attr('id').replace('fp_to_last_', ''));
		if(current+1 == last){
			$('.next-fp').hide();
		}
		if(current+1!=first){
			$('.prev-fp').show();
			$('.next-prev-buttons').css('left','500px');
		}
		$('.filter-paginator #fp_to_' + (current+1)).click();
	});

	$(".big_img_show").fancybox();
	
	$(document).on('click','.prev-fp', function(){
		var current = parseInt($('.filter-paginator span').html());
		var first = parseInt($('.filter-paginator a.fp_to_first').attr('id').replace('fp_to_first_', ''));
		var last = parseInt($('.filter-paginator a.fp_to_last').attr('id').replace('fp_to_last_', ''));
		if(current-1 == first){
			$('.prev-fp').hide();
			$('.next-prev-buttons').css('left','595px');
		}
		if(current-1 != last){
			$('.next-fp').show();
		}
		$('.filter-paginator #fp_to_' + (current-1)).click();
	});
	$(document).on('click','.sess', function(){
		$(".bomber").hide();
	});
	
	
	
	
	
	$(document).on('click', '.filter-paginator a', function(){
		var id = $(this).attr('id').replace('fp_to_', '');
		var first_id = $('.filter-paginator a.fp_to_first').attr('id').replace('fp_to_first_', '');
		var last_id = $('.filter-paginator a.fp_to_last').attr('id').replace('fp_to_last_', '');
		
		if($(this).attr('class') == 'fp_to_first' || id==first_id){
			id = id.replace('first_', '');
			$('.prev-fp').hide();
		}else{
			$('.prev-fp').show();
		}
		if($(this).attr('class') == 'fp_to_last' || id==last_id){
			id = id.replace('last_', '');
			$('.next-fp').hide();
		}else{
			$('.next-fp').show();
		}

		var sid = $('.filter-paginator span').html();
		$('.filter-paginator span').after('<a href="javascript:void(0)" id="fp_to_' + sid + '" class="fp_to">' + sid + '</a>');
		$('.filter-paginator span').remove();
		
		// console.log(id + ' / ' + last_id + ' / ' + first_id);
		$('.fp_to').hide();
		$('.paginator>span').hide();
		id = parseInt(id);
		if(id>=7 && id+6<last_id){
			for(i=id; i<id+6; i++){
				$('.filter-paginator #fp_to_'+i).show();
			}
			for(i=id-5; i<id; i++){
				$('.filter-paginator #fp_to_'+i).show();
			}
		}else if(id<7){
			for(i=2; i<12; i++){
				$('.filter-paginator #fp_to_'+i).show();
			}
		}else if(id+6>=last_id){
			for(i=last_id-11; i<last_id; i++){
				$('.filter-paginator #fp_to_'+i).show();
			}
		}
		
		if(id+5 >= last_id)
		{
			$('.filter-paginator #fp_to_'+last_id).css('display', 'inline-block');
			$('.filter-paginator a.fp_to_last').css('display', 'none');
			//$('.next-fp').hide();
		} else {
			$('.filter-paginator #fp_to_'+last_id).css('display', 'none');
			$('.filter-paginator a.fp_to_last').css('display', 'inline-block');
			//$('.prev-fp').hide();
		}

		if(id > 6)
		{
			$('.filter-paginator #fp_to_'+first_id).css('display', 'none');
			$('.filter-paginator a.fp_to_first').css('display', 'inline-block');
		} else {
			$('.filter-paginator #fp_to_'+first_id).css('display', 'inline-block');
			$('.filter-paginator a.fp_to_first').css('display', 'none');
		}
			
		$('.filter-paginator #fp_to_' + id).after('<span>' + id + '</span>');
		$('.filter-paginator #fp_to_' + id).remove();

		$('div.fp_active').removeClass('fp_active');
		$('#filter-page-' + id).addClass('fp_active');
		
	});

	$('.fabrics-all a').click(function(){
		$('.popup-container-background').css('height', $(document).height());
		$('.popup-container-background').css('display', 'block');
		
		$('.popup-container').css('display', 'block');
	});

	$(document).mouseup(function(e) {
		
		var container = $('.popup-container');

		if (typeof container !== 'undefined' && !container.is(e.target) // if the target of the click isn't the container...
				&& container.has(e.target).length === 0) // ... nor a descendant of the container
		{	
			$('.popup-container-background').css('display', 'none');
		
			$('.popup-container').css('display', 'none');
		}
	});
});