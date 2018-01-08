
$.extend($.validator.messages, {
	required: "Это поле необходимо заполнить.",
	remote: "Пожалуйста, введите правильное значение.",
	email: "Пожалуйста, введите корректный адрес электронной почты.",
	url: "Пожалуйста, введите корректный URL.",
	date: "Пожалуйста, введите корректную дату.",
	dateISO: "Пожалуйста, введите корректную дату в формате ISO.",
	number: "Пожалуйста, введите число.",
	digits: "Пожалуйста, вводите только цифры.",
	creditcard: "Пожалуйста, введите правильный номер кредитной карты.",
	equalTo: "Пожалуйста, введите такое же значение ещё раз.",
	extension: "Пожалуйста, выберите файл с правильным расширением.",
	maxlength: $.validator.format( "Пожалуйста, введите не больше {0} символов." ),
	minlength: $.validator.format( "Пожалуйста, введите не меньше {0} символов." ),
	rangelength: $.validator.format( "Пожалуйста, введите значение длиной от {0} до {1} символов." ),
	range: $.validator.format( "Пожалуйста, введите число от {0} до {1}." ),
	max: $.validator.format( "Пожалуйста, введите число, меньшее или равное {0}." ),
	min: $.validator.format( "Пожалуйста, введите число, большее или равное {0}." )
});




function set_max_height(elms, addh) {
  if (typeof(addh) === 'undefined') addh = 0;
  var maxHeight = Math.max.apply(null, elms.map(function (){
      return jQuery(this).height();
  }).get());
  elms.height(maxHeight+addh);
}
function set_makro_height() {
  var wwidth = window.innerWidth;
  console.log(wwidth);


  set_max_height(jQuery('.merch_item_1, .fix_height'));
  console.log('min');
}





$(window).load(function () {
	
	set_makro_height();
    $(".demo").customScrollbar();
	
	//$(".scroll_block").scrollbar();
	
	//$("html").niceScroll();
	//$(".filter_country_container .dropdown").removeClass("active");
    
	
	setTimeout(function(){ $(".filter_country_container .dropdown").removeClass("active"); $(".widget.widget_filters").css('visibility','visible'); }, 1000)
	setTimeout(function(){ $(".tab-content #tabc4").removeClass("active"); $(".tab-content #tabc4").removeClass("visible"); $(".tab-content #tabc1").addClass("active"); $("#ascrail2000").css('visibility','hidden'); }, 1000)
	
	
	
	
	$("#fixed-thumb-size-demo").customScrollbar({fixedThumbHeight: 50, fixedThumbWidth: 60});

    $(".scrollbarcontainer").customScrollbar({
		  skin: "default-skin", 
		  hScroll: false,
		  updateOnWindowResize: true,
		  fixedThumbHeight: 61
		});
});
$(window).resize(function () {
	set_makro_height();
});









var left_filter_html="";

$(window).load(function () {
	
    $(".demo").customScrollbar();
    $("#fixed-thumb-size-demo").customScrollbar({fixedThumbHeight: 50, fixedThumbWidth: 60});

    $(".scrollbarcontainer").customScrollbar({
		  skin: "default-skin", 
		  hScroll: false,
		  updateOnWindowResize: true,
		  fixedThumbHeight: 61
		});
		
	//search_collections_ajax(1);	
	left_filter_html=$(".widget.widget_filters").html();
	
	
	//var loc=location.href;
	//if(loc.indexOf('cat/type') + 1) {
	//	search_collections_ajax(1);
	//}

	
	
	params = {unset_session:'1'};
	//params2 = { product_id:product_id,material_name1:material_name1,material_name2:material_name2,price:price,size:size };
	$.ajax({
		  url: "/search_collections_ajax.php",
		  type: "POST",
		  async: true,
		  data: params,
		  headers: {
            'Cookie': document.cookie
          },
		  success: function(data)	{ 
		  		
				
		  }
		  
	});


	

	
	
	
		
});



function merch_search(n){
			
			var type=$("select[name='min1']").val();//идентификатор типа
				var factory=$("select[name='min2']").val();
				var collection=$("select[name='min3']").val();		
				var session_m=$.session.get("start_element_m");
				params = {type:type,factory:factory,collection:collection,start_number:session_m,number1:n};
					$.ajax({
		  				url: "/merch_filter.php",
		  				type: "POST",
		  				async: true,
		  				data: params,
						beforeSend(jqXHR, settings){
		  					$('.load_fon').fadeIn(100);
		  
		  				},
		 				success: function(data)	{ 
							
							//alert(data);
							var html = $('.ajax_container').html();
							html=html+data;
							$('.ajax_container').html(html);
							$('.load_fon').fadeOut(100);
							var t='<div class="moreBtns"><a class="more" style="margin-left:auto; margin-right:auto;" href="javascript:void(0)" onclick="merch_search('+(n+1)+');">Показать ещё</a>	</div>';
							 
							$('.pagination').html(t); 
						}
					});
			
			
		}
		

	

(function($) {
    $(document).ready(function() {
	
		$(".scroll_block").niceScroll();
		
		//$('.scroll_block').scrollbar();

		
		
		
		
		
    	$("select[name='min1']").selectmenu({

			change: function( event, ui ) {
				var type=$("select[name='min1']").val();//идентификатор типа
				var factory=$("select[name='min2']").val();
				var collection=$("select[name='min3']").val();		
				var session_m=$.session.get("start_element_m");
				params = {type:type,factory:factory,collection:collection,start_number:session_m,number1:1};
					$.ajax({
		  				url: "/merch_filter.php",
		  				type: "POST",
		  				async: true,
		  				data: params,
						beforeSend(jqXHR, settings){
		  					$('.load_fon').fadeIn(100);
		  
		  				},
		 				success: function(data)	{ 
							
							//alert(data);
							$('.ajax_container').html(data);
							$('.load_fon').fadeOut(100);
							var t='<div class="moreBtns"><a class="more" style="margin-left:auto; margin-right:auto;" href="javascript:void(0)" onclick="merch_search('+(1+1)+');">Показать ещё</a>	</div>';
							 
							$('.pagination').html(t); 
						}
					});
				
				
			}

		});
		
    	$("select[name='min2']").selectmenu({

			change: function( event, ui ) {
				var type=$("select[name='min1']").val();//идентификатор типа
				var factory=$("select[name='min2']").val();
				var collection=$("select[name='min3']").val();		
				var session_m=$.session.get("start_element_m");
				params = {type:type,factory:factory,collection:collection,start_number:session_m,number1:1};
					$.ajax({
		  				url: "/merch_filter.php",
		  				type: "POST",
		  				async: true,
		  				data: params,
		 				beforeSend(jqXHR, settings){
		  					$('.load_fon').fadeIn(100);
		  
		  				},
		 				success: function(data)	{ 
							
							//alert(data);
							$('.ajax_container').html(data);
							$('.load_fon').fadeOut(100);
							var t='<div class="moreBtns"><a class="more" style="margin-left:auto; margin-right:auto;" href="javascript:void(0)" onclick="search_collections_ajax('+(1+1)+');">Показать ещё</a>	</div>';
							 
							$('.pagination').html(t); 
						}
					});
				
				
				
			}

		});

    	$("select[name='min3']").selectmenu({

			change: function( event, ui ) {
				var type=$("select[name='min1']").val();//идентификатор типа
				var factory=$("select[name='min2']").val();
				var collection=$("select[name='min3']").val();		
				var session_m=$.session.get("start_element_m");
				params = {type:type,factory:factory,collection:collection,start_number:session_m,number1:1};
					$.ajax({
		  				url: "/merch_filter.php",
		  				type: "POST",
		  				async: true,
		  				data: params,
		 				beforeSend(jqXHR, settings){
		  					$('.load_fon').fadeIn(100);
		  
		  				},
		 				success: function(data)	{ 
							
							//alert(data);
							$('.ajax_container').html(data);
							$('.load_fon').fadeOut(100);
							var t='<div class="moreBtns"><a class="more" style="margin-left:auto; margin-right:auto;" href="javascript:void(0)" onclick="search_collections_ajax('+(1+1)+');">Показать ещё</a>	</div>';
							 
							$('.pagination').html(t); 
						}
					});
				
				
			}

		});

		$.session.set("start_element_m", "0");
		$.session.set("start_collection", "0");
		$('.bxslider_front').bxSlider({
		  pagerCustom: '#slider_pager',
		  mode: 'fade',
		  auto: true,
		  controls: false,
		  pause: 6000
		});
		
	
		//$('.slider_about').bxSlider({
		//  auto: false,
		//  pager: false,
		//  controls: true,
		//  minSlides: 4,
		//  maxSlides: 4,
		//  slideWidth: 155,
		//  slideMargin: 0
		//});
	
		
		
		

		$('.bxslider, .widget_slider > ul').bxSlider({
		  mode: 'fade',
		  auto: true,
		  controls: false
		});
		$('.scroll').click(function() {
	        str = $(this).attr("href");
	        $.scrollTo(str, 500);
	        return false;
	    });
		
		
		$('.about_docs_container a').hover(
		function(){
 			$(this).find('span').css('opacity','1');	
		},
		function(){
			$(this).find('span').css('opacity','0');
		});
		
		
		
		
		
		
		
		
		
		var data_min=$(".price_container input#price1").attr("data-value");
		var data_max=$(".price_container input#price2").attr("data-value");
		data_min=parseInt(data_min);
		data_max=parseInt(data_max);
	
		
	    $( "#slider-range" ).slider({
	      range: true,
	      min: data_min,
	      max: data_max,
	      values: [ data_min, data_max ],
	      slide: function( event, ui ) {
	        $( "#price1" ).val(ui.values[ 0 ]);
	        $( "#price2" ).val(ui.values[ 1 ]);
	      }
	    });
		
		
		
		
		
	    $( "#price1" ).val( $( "#slider-range" ).slider( "values", 0 ));
	    $( "#price2" ).val( $( "#slider-range" ).slider( "values", 1 ) );

	    $('#price1').change(function(){
		    $('#slider-range').slider("values",0,$(this).val());
		    $('#slider-range').slider("values",1,$('#price2').val());
		});


		$('#price2').change(function(){
		    $('#slider-range').slider("values",0,$('#price1').val());
		    $('#slider-range').slider("values",1,$(this).val());
		});

		$(".tag a").click(function(event){
			event.preventDefault();
			$(this).parent('.tag').remove();
			return false;
		});

		$('.fancybox').fancybox({padding: [40,22,22,22]});

		$('.filter_system_links_clear').click(function(e){
			e.preventDefault();
			$('.types_filter, .filter_container_colors > label').removeClass('active');
			return false;
		});
		
		

		$('#request1-form').validate();
		$('#request2-form').validate();
		$('#registration-form').validate(); // слитно с #request-form не работает :(
		$('#feedback-form').validate();
		$('#login-form').validate({
			rules: {
				name: {
					required: true,
					minlength: 3
				},
				password: {
					required: true
				}
			},
			messages: {
				name: {
					required: 'Пожалуйста, введите свой никнейи',
					minlength: 'Некорректное значение'
				},
				password: {
					required: 'Пожалуйста, введите пароль'
				}
			}
		});
		$('#restore_pass-form').validate({
			rules: {
				email: {
					required: true,
					email: true
				}
			},
			messages: {
				email: {
					required: 'Пожалуйста, введите свой email',
					email: 'Пожалуйста, введите корректный адрес'
				}
			}
		});

		$(document).on('click', '.form-restore_pass_link', function(){
	        $('#login').modal('hide');
	        $('#login').on('hidden.bs.modal', function(){
				$('#restore_pass').modal('show');
			});
	    });

	    $(document).on('click', '.get_order .get_order-btn', function(){
	    	$(this).parent().addClass('active');
	    	$(this).removeClass('get_order-btn').addClass('fancybox');
	    });
	    $(document).on('click', '.get_order .close-sm', function(){
	    	$(this).parent().removeClass('active');
	    	$(this).parent().find('.fancybox').removeClass('fancybox').addClass('get_order-btn');
	    });

	    $(document).on('click', '.color_sort .sort_link', function(e){
	    	e.preventDefault();
	    	$(this).parent().find('.dropdown').addClass('active');
	    });
	    $(document).on('click', '.color_sort .close-sm', function(){
	    	$(this).parent('.dropdown').removeClass('active');
	    });

	    $(document).on('click', '.filter_country_container .filter_link a', function(e){
	    	e.preventDefault();
	    	$('.dropdown').removeClass('active');
	    	$(this).parent().parent().find('.dropdown').addClass('active');
			
			$(".scroll_block").niceScroll();
			$("#ascrail2000").css('visibility','visible');
	    });
	    $(document).on('click', '.filter_country_container .close-sm', function(){
	    	$(this).parent('.dropdown').removeClass('active');
			$("#ascrail2000").css('visibility','hidden');
	    });
		
		
		
		change_search_link();
		
		$('.filter_system_links a.filter_system_links_do').click(function(){
			change_search_link();
			var loc=$('.filter_system_links a.filter_system_links_do').attr("data-href");
			location.href=loc;
		});	
		
		$('.filter_system_links_clear').click(function(){
			location.reload();
			
		});	
		
		
		$('.filter_country_container  .product_sell a').click(function(){
			change_search_link();
			$('.filter_system_links a.filter_system_links_do').click();

		});	
		
		
		$('#countries_container .btn-group.filter_container_types .btn.btn-primary.types_filter:first-child').click(function(){
			var t=$(this);
			function tm5(){
				
				if(t.hasClass('active')){
					var c=0;
					t.parents('.btn-group.filter_container_types').find('.btn.btn-primary.types_filter').each(function(){
						if(c!=0){
							$(this).addClass('active');
						}
						c=c+1;	
					});
				}else{
					t.parents('.btn-group.filter_container_types').find('.btn.btn-primary.types_filter').each(function(){
						if(c!=0){
							$(this).removeClass('active');
						}
						c=c+1;
						
					});	
				}
				//$(this) 
			}
			setTimeout(tm5, 500);
			
		});	
		
		
		
		
		
		$('#countries .dropdown .row:first-child .btn.btn-primary.types_filter').click(function(){
			
			
			var t=$(this);
			function tm5(){
				
				if(t.hasClass('active')){
					var c=0;
					$('#countries .dropdown .row:nth-child(2)').find('.btn.btn-primary.types_filter').each(function(){
						
							$(this).addClass('active');
						
					});
				}else{
					$('#countries .dropdown .row:nth-child(2)').find('.btn.btn-primary.types_filter').each(function(){
					
							$(this).removeClass('active');
					
						
					});	
				}
				//$(this) 
			}
			setTimeout(tm5, 500);
			
			
			
			
		});	
		
		$('#countries .country_button').click(function(){
			
			
			var t=$(this);
			function tm6(){
				
				if(t.hasClass('active')){
					var c=0;
					t.parents('.filter_container_types').find('.btn.btn-primary.types_filter').each(function(){
						
							$(this).addClass('active');
						
					});
				}else{
					t.parents('.filter_container_types').find('.btn.btn-primary.types_filter').each(function(){
					
							$(this).removeClass('active');
					
						
					});	
				}
				//$(this) 
			}
			setTimeout(tm6, 500);
			
			
			
			
		});	
		
		
		
		
		$(".gallery a[rel='prettyPhoto[gallery2]']").prettyPhoto({
			animation_speed: 'fast',
			slideshow: 1000, 
			social_tools: '',
			horizontal_padding: 0,
			default_width: 700,
			default_height: 444,
			markup: '<div class="pp_pic_holder"> \
						<div class="ppt">&nbsp;</div> \
						<div class="pp_content_container"> \
								<div class="pp_content"> \
									<div class="pp_loaderIcon"></div> \
									<div class="pp_fade"> \
										<a href="#" class="pp_expand" title="Expand the image">Expand</a> \
										<div class="pp_hoverContainer"> \
											<a class="pp_next" href="#">next</a> \
											<a class="pp_previous" href="#">previous</a> \
										</div> \
										<div id="pp_full_res"> \
										</div> \
										<button type="button" class="close-md pp_close_btn"></button> \
										<div class="pp_details"> \
										</div> \
									</div> \
								</div> \
						</div> \
					</div> \
					<div class="pp_overlay"></div>',
				gallery_markup: '<div class="pp_gallery"> \
								<div> \
									<ul> \
										{gallery} \
									</ul> \
								</div> \
								<a href="#" class="pp_arrow_previous">Previous</a> \
								<a href="#" class="pp_arrow_next">Next</a> \
							</div>'
		});
		
		
		
		

		});
		
		
		
		
		
		
		
		
		
		
})(jQuery)





function show_success_modal(){
	$('#success_modal .modal-title').html('Заявка получена');
	$('#success_modal .modal-body').css('padding-top', 0).html('<p>Спасибо, наш менеджер свяжется с вами в ближайшее время</p>');
	$('#success_modal').modal('show');
	$('#success_modal').on('hidden.bs.modal', function(){
		$('#success_modal .modal-title').html('');
		$('#success_modal .modal-body').html('');
	});
}



	


function change_search_link(){
	
		
		
		var param_price_min=$('.price_container input#price1').attr('data-value');
		var param_price_max=$('.price_container input#price2').attr('data-value');
		var param_factories="";
		
		var c=0;
		$('#countries_container').find('.btn.btn-primary.types_filter').each(function(){
    		if($(this).hasClass('active') && (c!=0)){
				param_factories=param_factories+$(this).attr('data-id')+":";	
			}
			c=c+1;
			
		});
		
		
		var param_based_sizes="";
		//$('.based_size_id').each(function(){
    	//	param_based_sizes=param_based_sizes+$(this).html()+":";
		//});
		
		
		$('#sizes_container').find('.btn.btn-primary.types_filter').each(function(){
		
    		if($(this).hasClass('active')){
				param_based_sizes=param_based_sizes+$(this).attr('data-id')+":";	
			}
			
			
		});
		
		
		
		
		var param_purposes="";
		$('.purposes_checkbox').each(function(){
    		if($(this).prop("checked")){ param_purposes=param_purposes+$(this).attr("data-id")+":"; }
		});
		
		var param_materials="";
		$('.materials_checkbox').each(function(){
    		if($(this).prop("checked")){ param_materials=param_materials+$(this).attr("data-id")+":"; }
		});
		
		
		
		
		var param_surfaces="";
		$('.ch_surface').each(function(){
			//alert($(this).attr('data-surface'));
    		//param_surfaces=param_surfaces+$(this).attr("data-id")+":";
			if($(this).hasClass("active")){ param_surfaces=param_surfaces+$(this).attr('data-surface')+":"; }
		});
		
		
		var param_styles="";
		$('.ch_style').each(function(){
    		//param_surfaces=param_surfaces+$(this).attr("data-id")+":";
			if($(this).hasClass("active")){ param_styles=param_styles+$(this).attr('data-style')+":"; }
		});
		
		var param_colors="";
		$('.ch_color').each(function(){
    		//param_surfaces=param_surfaces+$(this).attr("data-id")+":";
			if($(this).hasClass("active")){ param_colors=param_colors+$(this).attr('data-color')+":"; }
		});
		
		
		
		var url="/search/?collections=1&price_min="+param_price_min+"&price_max="+param_price_max+"&factories="+param_factories+"&based_sizes="+param_based_sizes+"&purposes="+param_purposes+"&materials="+param_materials+"&surfaces="+param_surfaces+"&styles="+param_styles+"&colors="+param_colors+"";
		//alert(url);
		$('.filter_system_links a.filter_system_links_do').attr("data-href", url);
		
		
		
}



// fade in #back-top
jQuery(function () {

	jQuery(window).scroll(function () {
  
		if (jQuery(this).scrollTop() > 100) {
			jQuery('#back-top').fadeIn();
		} else {
			jQuery('#back-top').fadeOut();
		}
	});

	// scroll body to 0px on click
	jQuery('#back-top .toplink').click(function () {
		jQuery('body,html').animate({
			scrollTop: 0
		}, 400);
		return false;
	});
});






jQuery(function () {
	
	jQuery('.slider_vertical__container .sv-top').click(function () {
		var top_1=jQuery('.slider_vertical__nav ul li:first-child').css("margin-top");
		if(top_1=="14px"){ return false; }
		top_1=top_1.replace("px","");
		top_1=parseInt(top_1)+82;
		top_1=top_1+"px";
		//alert(top_1);
		jQuery('.slider_vertical__nav ul li:first-child').animate({
			marginTop: top_1
		}, 400);
	});
	
	
	jQuery('.slider_vertical__container .sv-bottom').click(function () {
		var top_1=jQuery('.slider_vertical__nav ul li:first-child').css("margin-top");
		top_1=top_1.replace("px","");
		//alert(top_1);
		
		//alert( parseInt(jQuery('.slider_vertical__nav ul').height()) );
		//+parseInt(jQuery('.slider_vertical__nav ul').height())
		
		if(((Math.abs(top_1)))>(jQuery('.slider_vertical__nav ul').height())){ return false; }
		top_1=top_1-82;
		top_1=top_1+"px";
		//alert(top_1);
		jQuery('.slider_vertical__nav ul li:first-child').animate({
			marginTop: top_1
		}, 400);
		
	});
	
	
	jQuery('.slider_vertical__nav ul li img').click(function () {
		var image=jQuery(this).attr("src");
		jQuery('.inner_content_box .slider_vertical__item img').attr("src",image);
		
	
	});
	
	
	jQuery('.about_block__slider ul li > a span').hover(function () {
		jQuery(this).css("opacity","1");
	
	}, function() {
    	jQuery(this).css("opacity","0");
  	});
	
	
	
	jQuery('.about_block__slider .bx-wrapper .bx-controls-direction a.bx-prev').click(function () {
		var left_1=jQuery('.about_block__slider ul').css("left");
		if(left_1=="auto"){ left_1="0px"; };
		if(left_1=="0px"){ return false; };
		left_1=left_1.replace("px","");
		//alert(left_1);
		left_1=parseInt(left_1)+82;
		left_1=left_1+"px";
		jQuery('.about_block__slider ul').animate({
			left: left_1
		}, 400);
		
	});
	
	jQuery('.about_block__slider .bx-wrapper .bx-controls-direction a.bx-next').click(function () {
		var left_1=jQuery('.about_block__slider ul').css("left");
		if(left_1=="auto"){ left_1="0px"; };
		left_1=left_1.replace("px","");
		var width_1=(jQuery('.about_block__slider ul li').width())*(jQuery('.about_block__slider ul li').length); //
		
		//alert(width_1);
		if( (Math.abs(left_1)) > (width_1) ){ return false; }
		
		left_1=left_1-82;
		left_1=left_1+"px";
		jQuery('.about_block__slider ul').animate({
			left: left_1
		}, 400);
		
		
	
	});
	
	
	
	jQuery(document).on('click', '.form-restore_pass_link', function(){
	        jQuery('#login').modal('hide');
	        jQuery('#login').on('hidden.bs.modal', function(){
				jQuery('#restore_pass').modal('show');
			});
	    });
	
	
	
	jQuery(document).ready(function() {
    	jQuery("a[rel=group]").fancybox({
        	'transitionIn' : 'none',
        	'transitionOut' : 'none',
        	'titlePosition' : 'over',
        	'titleFormat' : function(title, currentArray, currentIndex, currentOpts) {
            	return '<span id="fancybox-title-over">Image ' + (currentIndex + 1) + ' / ' + currentArray.length + (title.length ? ' &nbsp; ' + title : '') + '</span>';
        	}
    	});
	});
	
	jQuery(document).ready(function() {
    	jQuery("a[rel=group2]").fancybox({
        	'transitionIn' : 'none',
        	'transitionOut' : 'none',
        	'titlePosition' : 'over',
        	'titleFormat' : function(title, currentArray, currentIndex, currentOpts) {
            	return '<span id="fancybox-title-over">Image ' + (currentIndex + 1) + ' / ' + currentArray.length + (title.length ? ' &nbsp; ' + title : '') + '</span>';
        	}
    	});
	});
	
	jQuery('.front_content_continer .tabbable .nav.nav-tabs li').click(function () {
		jQuery('.front_content_continer .tabbable .nav.nav-tabs li').removeClass('active');
		jQuery(this).addClass('active');
		var tab=jQuery(this).children().attr("href");
		tab=tab.replace("#","");
		jQuery('.front_content_continer .tabbable .tab-content .tab-pane').css("display","none");
		jQuery('.front_content_continer .tabbable .tab-content .tab-pane#'+tab).css("display","block"); 
		
	});
	
	
	
	jQuery(".widget.widget_filters").click(function () {
		search_collections_ajax(1);
	});

	
	jQuery(".widget_filters .price_container span").click(function () {
		search_collections_ajax(1);
	});
	
	jQuery(".filter_country_container .tag.label .glyphicon").click(function () {
		search_collections_ajax(1);
	});
	
	
	
	jQuery("#login button").click(function(e){
		
		e.preventDefault();
		
		jQuery("#login label").css("color","#3c3f45");
		jQuery("#login .input_alert").fadeOut(500);
		
		var login=jQuery("#login #login_login").val();
		var pass=jQuery("#login #login_pass").val();
		
		if(login==""){
			jQuery("#login .name_alert").fadeIn(500);
			jQuery("#login label[for='login_login']").css("color","#ff0000");
		}
		if(pass==""){
			jQuery("#login .pass_alert").fadeIn(500);
			jQuery("#login label[for='login_pass']").css("color","#ff0000");
		}
		
		
		//поиск пары логин/пароль в БД
		params = {login:login,pass:pass}
					$.ajax({
		  				url: "/auth_validate.php",
		  				type: "POST",
		  				async: true,
		  				data: params,
		 				success: function(data)	{ 
							
							if(data=="error"){
								jQuery("#login .auth_alert").fadeIn(500);
								jQuery("#login #login_login").css("border-color",'#ff0000');
								jQuery("#login #login_pass").css("border-color",'#ff0000');
								
								return false;	
							}else{
								jQuery("#login_form").submit();
							}
							
						}
					});
		
		
	});	
	
	jQuery("#restore_pass button").click(function(){
		jQuery("#restore_pass label").css("color","#3c3f45");
		jQuery("#restore_pass .input_alert").fadeOut(500);
		var email=jQuery("#restore_pass #res_email").val();
		
		if(email==""){
			
			jQuery("#restore_pass .mail_alert2").fadeIn(500);
			jQuery("#restore_pass label[for='email1']").css("color","#ff0000");
		}
		var pattern = /^([a-z0-9_\.-])+@[a-z0-9-]+\.([a-z]{2,4}\.)?[a-z]{2,4}$/i;
         
		if((email!="")&&( pattern.test(email)==false )){
			jQuery("#restore_pass .mail_alert").fadeIn(500);
		}
	});	
	
	
	
	jQuery("#restore_pass").submit(function(){
		
		//проверка, существует ли указанный логин в БД
		var login=jQuery("#restore_pass #res_login").val();
		
		params = {login:login}
		$.ajax({
		  url: "/send_restore_pass_mail_ajax.php",
		  type: "POST",
		  async: true,
		  data: params,
		  success: function(data)	{ 
		  		
				//alert(data);
				if(data=="0"){
					jQuery("#restore_pass .login_alert").fadeIn(500);	
					return false;	
				}else{
					
					//отправка пользователю письма со ссылкой для восстановления пароля
					var tmp_mail=data;
					params = {email:data}
					$.ajax({
		  				url: "/send_restore_pass_ajax.php",
		  				type: "POST",
		  				async: true,
		  				data: params,
		 				success: function(data)	{ 
		 					//alert(data);
							jQuery("#restore_pass .modal-title").html("Готово");
							jQuery("#restore_pass .modal-body").html("На <b>"+tmp_mail+"</b> отправлена ссылка на сброс пароля");
							
						}
					});
					
					
					
				}
				
				
				
				//jQuery("#request1 .modal-title").html("Заявка получена");
				//jQuery("#request1 .modal-body").html("Спасибо, наш менеджер свяжется с вами в ближайшее время");
				//jQuery("#request1 .modal-dialog").css("top","50%");
				//jQuery("#request1 .modal-content").css("margin-top","30%");
				
				
				},
		  error: function(jqxhr, status, errorMsg){ alert("Статус: " + status + " Ошибка: " + errorMsg);}	
				});
		
		
		
		return false;
	});	
		
		
		
	jQuery("#registration button").click(function(){	
		jQuery("#registration label").css("color","#3c3f45");
		jQuery("#registration .input_alert").fadeOut(500);
		
		var name=jQuery("#registration #name2").val();
		var email=jQuery("#registration #email2").val();	
		
		if(name==""){
			jQuery("#registration .name_alert").fadeIn(500);
			jQuery("#registration label[for='name2']").css("color","#ff0000");
		}
		if(email==""){
			
			jQuery("#registration .mail_alert2").fadeIn(500);
			jQuery("#registration label[for='email2']").css("color","#ff0000");
		}
		var pattern = /^([a-z0-9_\.-])+@[a-z0-9-]+\.([a-z]{2,4}\.)?[a-z]{2,4}$/i;
         
		if((email!="")&&( pattern.test(email)==false )){
			jQuery("#registration .mail_alert").fadeIn(500);
		}
			
		
	});		
	
	jQuery("#registration").submit(function(){
		

		var name=jQuery("#registration #name2").val();
		var email=jQuery("#registration #email2").val();
		
		var phone=jQuery("#registration #phone2").val();
		var message=jQuery("#registration #message2").val();

		
		
		params = {name:name,email:email,phone:phone,message:message}
		$.ajax({
		  url: "/send_form2_ajax.php",
		  type: "POST",
		  async: true,
		  data: params,
		  success: function(data)	{ 
		  		
				jQuery("#registration .modal-title").html("Заявка получена");
				jQuery("#registration .modal-body").html("Спасибо, наш менеджер свяжется с вами в ближайшее время");
				//jQuery("#request1 .modal-dialog").css("top","50%");
				jQuery("#registration .modal-content").css("margin-top","30%");
				
				
				},
		  error: function(jqxhr, status, errorMsg){ alert("Статус: " + status + " Ошибка: " + errorMsg);}	
				});
		
		
		
		
		
		
		return false;		
		
		
	});	
	
	
	
	//запрос на получение прайса на почту с главной
	jQuery("#sub_form input[type='submit']").click(function(){
		
		
		jQuery("#sub_form .input_alert").fadeOut(500);	
		var email=jQuery("#sub_form input[type='text']").val();
		if(email==""){
			
			jQuery("#sub_form .mail_alert2").fadeIn(500);
			
		}
		var pattern = /^([a-z0-9_\.-])+@[a-z0-9-]+\.([a-z]{2,4}\.)?[a-z]{2,4}$/i;
         
		if((email!="")&&( pattern.test(email)==false )){
			jQuery("#sub_form .mail_alert").fadeIn(500);
		}
		
		
	});	





	jQuery("#sub_form").submit(function(){
	
		var email=jQuery("#sub_form input[type='text']").val();
		
		params = {email:email}
		$.ajax({
		  url: "/send_form3_ajax.php",
		  type: "POST",
		  async: true,
		  data: params,
		  success: function(data)	{ 
		  		
				jQuery(".subscribe_container").html('<div class="success_msg text-center"><strong>МЫ ОТПРАВИМ РОЗНИЧНЫЕ ЦЕНЫ НА</strong> '+email+' <strong>В ТЕЧЕНИЕ ДВУХ МИНУТ</strong></div>');
				
					
				},
		  error: function(jqxhr, status, errorMsg){ alert("Статус: " + status + " Ошибка: " + errorMsg);}	
				});
		
	
	
	return false;
	});	
	
	
	
	
	
	//обратная связь
	jQuery("#feedback button").click(function(){
		
		
		jQuery("#feedback label").css("color","#3c3f45");
		jQuery("#feedback .input_alert").fadeOut(500);
		
		var name=jQuery("#feedback #name3").val();
		var email=jQuery("#feedback #email3").val();	
		
		if(name==""){
			jQuery("#feedback .name_alert").fadeIn(500);
			jQuery("#feedback label[for='name3']").css("color","#ff0000");
		}
		if(email==""){
			
			jQuery("#feedback .mail_alert2").fadeIn(500);
			jQuery("#feedback label[for='email3']").css("color","#ff0000");
		}
		var pattern = /^([a-z0-9_\.-])+@[a-z0-9-]+\.([a-z]{2,4}\.)?[a-z]{2,4}$/i;
         
		if((email!="")&&( pattern.test(email)==false )){
			jQuery("#feedback .mail_alert").fadeIn(500);
		}
		
		
		
	});	
	
	
	jQuery("#feedback").submit(function(){
		
		
		var name=jQuery("#feedback #name3").val();
		var email=jQuery("#feedback #email3").val();
		
		var phone=jQuery("#feedback #phone3").val();
		var message=jQuery("#feedback #message3").val();

		
		
		params = {name:name,email:email,phone:phone,message:message}
		$.ajax({
		  url: "/send_form4_ajax.php",
		  type: "POST",
		  async: true,
		  data: params,
		  success: function(data)	{ 
		  		
				jQuery("#feedback .modal-title").html("Обратная связь получена");
				jQuery("#feedback .modal-body").html("В случае необходимости наш менеджер свяжется с вами в ближайшее время");
				//jQuery("#request1 .modal-dialog").css("top","50%");
				jQuery("#feedback .modal-content").css("margin-top","30%");
				
				
				},
		  error: function(jqxhr, status, errorMsg){ alert("Статус: " + status + " Ошибка: " + errorMsg);}	
				});
		
		
		
		
		
		
		return false;		
		
		
	});
	
	
	
	
	
	
	
	jQuery("#request2 button").click(function(){
		
		jQuery("#request2 label").css("color","#3c3f45");
		jQuery("#request2 .input_alert").fadeOut(500);
		
		var name=jQuery("#request2 #name4").val();
		var phone=jQuery("#request2 #phone4").val();


		var message=jQuery("#request2 #message1").val();

		if(name==""){
			jQuery("#request2 .name_alert").fadeIn(500);
			jQuery("#request2 label[for='name4']").css("color","#ff0000");
		}
		if(phone==""){
			
			jQuery("#request2 .phone_alert").fadeIn(500);
			jQuery("#request2 label[for='phone4']").css("color","#ff0000");
		}
		var pattern = /^([a-z0-9_\.-])+@[a-z0-9-]+\.([a-z]{2,4}\.)?[a-z]{2,4}$/i;
         
		if((email!="")&&( pattern.test(email)==false )){
			jQuery("#request2 .mail_alert").fadeIn(500);
		}
	});	
	
		
	jQuery("#request2").submit(function(){

		var name=jQuery("#request2 #name4").val();
		var phone=jQuery("#request2 #phone4").val();


		var message=jQuery("#request2 #message4").val();

		
		params = {name:name,phone:phone,message:message}
		$.ajax({
		  url: "/send_form5_ajax.php",
		  type: "POST",
		  async: true,
		  data: params,
		  success: function(data)	{ 
		  		
				jQuery("#request2 .modal-title").html("Заявка получена");
				jQuery("#request2 .modal-body").html("Спасибо, наш менеджер свяжется с вами в ближайшее время");
				//jQuery("#request1 .modal-dialog").css("top","50%");
				jQuery("#request2 .modal-content").css("margin-top","30%");
				
				
				},
		  error: function(jqxhr, status, errorMsg){ alert("Статус: " + status + " Ошибка: " + errorMsg);}	
				});
		
		
		
		
		
		
		return false;
	});
	
	var good_id="";
    jQuery(".product_sell .get_order.dropdown a").click(function(){
		//alert("00");
	   //jQuery(".fancybox-inner").css("overflow","hudden");   .catalog_image img
		var image1=jQuery(this).parents(".catalog_item").find("img").attr('src');
		var name=jQuery(this).parents(".catalog_item").find(".catalog_item_name").find('a').html();
		var art=jQuery(this).parents(".catalog_item").find(".product_item_articul").html();
		good_id=jQuery(this).parents(".catalog_item").attr("data-id");
		
		var type="";
		var color="";
		var style="";
		var ves="";
		var count="";
		
		params = {good_id:good_id}
		$.ajax({
		  url: "/get_good_params_ajax.php",
		  type: "POST",
		  async: false,
		  data: params,
		  success: function(data)	{ 
		  		
		  		var json1 = JSON.parse(data); 
				
				type="Тип поверхности: "+json1[0];
				color="Цвет: "+json1[1];
				style="Стиль: "+json1[2];
				ves="Вес (коробка): "+json1[3];
				count="Штук (в коробке): "+json1[4];
				
				},
		  error: function(jqxhr, status, errorMsg){ alert("Статус: " + status + " Ошибка: " + errorMsg);}	
				});
		
		
		
		
		
		
		
		var price=jQuery(this).parents(".catalog_item").find(".catalog_item_price").find('span').html();
		var price_old="";
		price_old=jQuery(this).parents(".catalog_item").find(".catalog_item_price").find('i').html();
		
		var count2=jQuery(this).parents(".catalog_item").find(".get_order.dropdown").find('.get_order-num').val();
		//alert(price_old);
		
		jQuery("#plitka1 .plitka_image img").attr("src",image1);   
		jQuery("#plitka1 h2").html(name);
		jQuery("#plitka1 .row .col-sm-6:nth-child(2) .plitka_row:first").html(art.replace("Артикул:","<span>Артикул:</span>"));
		
		jQuery("#plitka1 .row .col-sm-6:nth-child(2) .plitka_row:nth-child(3)").html(type.replace("Тип поверхности:","<span>Тип поверхности:</span>"));
		jQuery("#plitka1 .row .col-sm-6:nth-child(2) .plitka_row:nth-child(4)").html(color.replace("Цвет:","<span>Цвет:</span>"));
		jQuery("#plitka1 .row .col-sm-6:nth-child(2) .plitka_row:nth-child(5)").html(style.replace("Стиль:","<span>Стиль:</span>"));
		jQuery("#plitka1 .row .col-sm-6:nth-child(2) .plitka_row:nth-child(6)").html(ves.replace("Вес (коробка):","<span>Вес (коробка):</span>"));
		jQuery("#plitka1 .row .col-sm-6:nth-child(2) .plitka_row:nth-child(7)").html(count.replace("Штук (в коробке):","<span>Штук (в коробке):</span>"));
		
		jQuery("#plitka1 .plitka_price span").html(price);
		jQuery("#plitka1 .plitka_price i").html(price_old);
		jQuery("#plitka1 #count").val(count2);
	
	
	});	
	
	
	
	
	
	jQuery(".gallery_big_data img").click(function(){
		
		function tm2(){
			jQuery("a.pp_next").click();
		}
		setTimeout(tm2, 1000);
		
		
	});	
	
	
	jQuery("#plitka1_img_zoom a").click(function(){
		if( jQuery("#plitka1_img_zoom #count").val()=="" ){
			jQuery("#plitka1_img_zoom #count").css("border-color", "red");	
			return false;
		}
		var session_id=jQuery(".session_id").html();
		good_id=jQuery("#plitka1_img_zoom").attr("data-popup-id");
		var count=$('#plitka1_img_zoom #count').val();
		//alert(count);
		params = {good_id:good_id,session_id:session_id,count:count}
		//alert(good_id);
		//alert(session_id);
		$.ajax({
		  url: "/send_good_to_basket.php",
		  type: "POST",
		  async: true,
		  data: params,
		  cache: false,
		  success: function(data)	{ 
		  		//alert("1");
		  		//alert(data);
				//jQuery("#request1 .modal-title").html("Заявка получена");
				//jQuery("#request1 .modal-body").html("Спасибо, наш менеджер свяжется с вами в ближайшее время");
				//jQuery("#request1 .modal-dialog").css("top","50%");
				//jQuery("#request1 .modal-content").css("margin-top","30%");
				$('.header_cart .header_total.cart_block').html('<a href="/cart">'+data+" товаров</a>");//#2
				$.fancybox.close();
				$('[data-id = '+good_id+']').find(".product_sell").html("<span class='blue underline'>В корзине</span>");
				$('[data-id = '+good_id+']').find("a.fancybox").attr("html","#");
				$('[data-id = '+good_id+']').find("a.fancybox").removeClass("fancybox");
				
				//$('[data-id = '+good_id+']').html("<span class='blue underline'>В корзине</span>");
				
				},
		  error: function(jqxhr, status, errorMsg){ alert("Статус: " + status + " Ошибка: " + errorMsg);}	
				});
		
		
	
	
	});	
	
	
	
	
	
	
	jQuery(".plitka_buy a.buy_link").click(function(){
		
		if( jQuery(".plitka_buy #count").val()=="" ){
			jQuery(".plitka_buy #count").css("border-color", "red");	
			return false;
		}
		//var good_id=jQuery(this).parents(".catalog_item").attr("data-id");
		//кидаем товар в корзину
		var session_id=jQuery(".session_id").html();
		var count=jQuery(".plitka_buy #count").val();
		//alert(count);
		params = {good_id:good_id,session_id:session_id,count:count}
	//	alert("1");
		jQuery.session.set("n", "2222");
		
		
		$.ajax({
		  url: "/send_good_to_basket.php",
		  type: "POST",
		  async: true,
		  data: params,
		  cache: false,
		  success: function(data)	{ 
		  		//alert(data);
				//jQuery("#request1 .modal-title").html("Заявка получена");
				//jQuery("#request1 .modal-body").html("Спасибо, наш менеджер свяжется с вами в ближайшее время");
				//jQuery("#request1 .modal-dialog").css("top","50%");
				//jQuery("#request1 .modal-content").css("margin-top","30%");
				$('.header_cart .header_total.cart_block').html('<a href="/cart">'+data+" товаров</a>");//#3
				$.fancybox.close();
				$('[data-id = '+good_id+']').find(".product_sell").html("<span class='blue underline'>В корзине</span>");
				$('[data-id = '+good_id+']').find("a.fancybox").attr("html","#");
				$('[data-id = '+good_id+']').find("a.fancybox").removeClass("fancybox");
				},
		  error: function(jqxhr, status, errorMsg){ alert("Статус: " + status + " Ошибка: " + errorMsg);}	
				});
		
		
	
	});	
	
	
	
	
	
	
	
	
	
	
	
	
	
	jQuery(".catalog_item .catalog_image").click(function(){
		
		var image1=jQuery(this).parents(".catalog_item").find("img").attr('src');
		var name=jQuery(this).parents(".catalog_item").find(".catalog_item_name").find('a').html();
		var count2="";
		count2=jQuery(this).parents(".catalog_item").find(".get_order.dropdown").find('.get_order-num').val();
		
		jQuery("#plitka1_img_zoom h2").html(name);
		jQuery("#plitka1_img_zoom .plitka_image img").attr('src',image1);
		jQuery("#plitka1_img_zoom #count").val(count2);
		var tmp=jQuery(this).parents('.catalog_item').attr('data-id');
		jQuery("#plitka1_img_zoom").attr('data-popup-id',tmp);
	
	});
		

	jQuery("#request1-form button").click(function(){
		
		jQuery("#request1-form label").css("color","#3c3f45");
		jQuery("#request1-form .input_alert").fadeOut(500);
		
		var name=jQuery("#request1-form #name1").val();
		var email=jQuery("#request1-form #email1").val();
		
		var phone=jQuery("#request1-form #phone1").val();
		var message=jQuery("#request1-form #message1").val();

		if(name==""){
			jQuery("#request1-form .name_alert").fadeIn(500);
			jQuery("#request1-form label[for='name1']").css("color","#ff0000");
		}
		if(email==""){
			
			jQuery("#request1-form .mail_alert2").fadeIn(500);
			jQuery("#request1-form label[for='email1']").css("color","#ff0000");
		}
		var pattern = /^([a-z0-9_\.-])+@[a-z0-9-]+\.([a-z]{2,4}\.)?[a-z]{2,4}$/i;
         
		if((email!="")&&( pattern.test(email)==false )){
			jQuery("#request1-form .mail_alert").fadeIn(500);
		}
	});	
	
	
	jQuery(".cart").submit(function(){
		
		
		var html=$(".cart .table-responsive").html();
		var name=$(".cart #name5").val();
		var phone=$(".cart #phone5").val();
		var message=$(".cart #message5").val();
		var session=$(".cart").attr('data-session');
		params = {html:html,name:name,phone:phone,message:message,session:session}
		$.ajax({
		  url: "/send_cart_ajax.php",
		  type: "POST",
		  async: true,
		  data: params,
		  success: function(data)	{ 
		  		
				
				location.reload();
				
				},
		  error: function(jqxhr, status, errorMsg){ alert("Статус: " + status + " Ошибка: " + errorMsg);}	
				});
		
		
		
		
		return false;
	});
	
	
	
	jQuery("#request1-form").submit(function(){

		var name=jQuery("#request1-form #name1").val();
		var email=jQuery("#request1-form #email1").val();
		
		var phone=jQuery("#request1-form #phone1").val();
		var message=jQuery("#request1-form #message1").val();

		
		
		params = {name:name,email:email,phone:phone,message:message}
		$.ajax({
		  url: "/send_form1_ajax.php",
		  type: "POST",
		  async: true,
		  data: params,
		  success: function(data)	{ 
		  		
				jQuery("#request1 .modal-title").html("Заявка получена");
				jQuery("#request1 .modal-body").html("Спасибо, наш менеджер свяжется с вами в ближайшее время");
				//jQuery("#request1 .modal-dialog").css("top","50%");
				jQuery("#request1 .modal-content").css("margin-top","30%");
				
				
				},
		  error: function(jqxhr, status, errorMsg){ alert("Статус: " + status + " Ошибка: " + errorMsg);}	
				});
		
		
		
		
		
		
		return false;
	});
	
	
	var filter_log=0;
	jQuery(".product_more_container .filter_container_items .color_filter_1").click(function(){
	
	
		var purpose_id=$(this).attr('data-purpose');
		var collection_id=$(this).attr('data-collection');
		
		//список выделенных цветов
		var param_colors="";
		var t=jQuery(this);
		
		function tm3(){
			t.parents(".filter_container_colors").find(".color_filter_1").each(function(){
    			//param_surfaces=param_surfaces+$(this).attr("data-id")+":";
				if(jQuery(this).hasClass("active")){ param_colors=param_colors+$(this).attr('data-color')+":"; }
			});
		
			
			
			//запрос
			var session_id=jQuery(".session_id").html();
			params = {purpose_id:purpose_id,collection_id:collection_id,param_colors:param_colors,session_id:session_id};
			$.ajax({
		  		url: "/color_filter_detail_ajax.php",
		  		type: "POST",
		  		async: true,
		  		data: params,
		  		success: function(data)	{ 
					
		  	 		t.parents(".product_more_container").find(".tab-pane").html(data);
					
					
					//if(filter_log==0){
					//alert("log");
					/////////////////////////
						
					$('#plitka1_img_zoom a').on('click', function(){
						
						
						
					if( $("#plitka1_img_zoom #count").val()=="" ){
						$("#plitka1_img_zoom #count").css("border-color", "red");	
						return false;
					}
					var session_id=jQuery(".session_id").html();
					good_id=jQuery("#plitka1_img_zoom").attr("data-popup-id");
					var count=$('#plitka1_img_zoom #count').val();
					//alert(count);
					params = {good_id:good_id,session_id:session_id,count:count}
					$.ajax({
		  				url: "/send_good_to_basket.php",
		  				type: "POST",
		  				async: true,
		  				data: params,
		  				cache: false,
		  				success: function(data)	{ 
		  	
							$('.header_cart .header_total.cart_block').html('<a href="/cart">'+data+" товаров</a>");//#4
							$.fancybox.close();
							$('[data-id = '+good_id+']').find(".product_sell").html("<span class='blue underline'>В корзине</span>");
							$('[data-id = '+good_id+']').find("a.fancybox").attr("html","#");
							$('[data-id = '+good_id+']').find("a.fancybox").removeClass("fancybox");
						},
		  				error: function(jqxhr, status, errorMsg){ alert("Статус: " + status + " Ошибка: " + errorMsg);}	
					});
					
		
	
					});
			
			
					///////////////////
					
					
					jQuery( ".plitka_buy > a.buy_link" ).off();

						
					jQuery('.plitka_buy > a.buy_link').on('click', function(){
					//alert("1");	
					
					
						if( jQuery(".plitka_buy #count").val()=="" ){
							jQuery(".plitka_buy #count").css("border-color", "red");	
							return false;
						}
					//var good_id=jQuery(this).parents(".catalog_item").attr("data-id");
					//кидаем товар в корзину
					var session_id=jQuery(".session_id").html();
					var count=jQuery(".plitka_buy #count").val();
					//alert(count);
					params = {good_id:good_id,session_id:session_id,count:count}
					//	alert("1");
					//jQuery.session.set("n", "2222");
					
		
					$.ajax({
		 				url: "/send_good_to_basket.php",
		  				type: "POST",
		  				async: true,
		 				data: params,
		  				cache: false,
		  				success: function(data)	{ 
		  					$('.header_cart .header_total.cart_block').html('<a href="/cart">'+data+" товаров</a>");//#5
							$.fancybox.close();
							$('[data-id = '+good_id+']').find(".product_sell").html("<span class='blue underline'>В корзине</span>");
							$('[data-id = '+good_id+']').find("a.fancybox").attr("html","#");
							$('[data-id = '+good_id+']').find("a.fancybox").removeClass("fancybox");
				
						},
		  				error: function(jqxhr, status, errorMsg){ alert("Статус: " + status + " Ошибка: " + errorMsg);}	
					});
					
	
					});
					/////////////
					
					
					
					jQuery(".catalog_item .catalog_image").on('click', function(){
					//alert("2");	
						var image1=jQuery(this).parents(".catalog_item").find("img").attr('src');
						var name=jQuery(this).parents(".catalog_item").find(".catalog_item_name").find('a').html();
						var count2="";
						count2=jQuery(this).parents(".catalog_item").find(".get_order.dropdown").find('.get_order-num').val();
		
						jQuery("#plitka1_img_zoom h2").html(name);
						jQuery("#plitka1_img_zoom .plitka_image img").attr('src',image1);
						jQuery("#plitka1_img_zoom #count").val(count2);
						var tmp=jQuery(this).parents('.catalog_item').attr('data-id');
						jQuery("#plitka1_img_zoom").attr('data-popup-id',tmp);
					});
	
					
					
					
					
					/////////////
	
					
					jQuery( ".product_sell .get_order.dropdown a" ).off();
	
					jQuery(".product_sell .get_order.dropdown a").click(function(){
					//alert("3");	
						var image1=jQuery(this).parents(".catalog_item").find("img").attr('src');
						var name=jQuery(this).parents(".catalog_item").find(".catalog_item_name").find('a').html();
						var art=jQuery(this).parents(".catalog_item").find(".product_item_articul").html();
						good_id=jQuery(this).parents(".catalog_item").attr("data-id");
		
						var type="";
						var color="";
						var style="";
						var ves="";
						var count="";
		
						params = {good_id:good_id}
						$.ajax({
		  					url: "/get_good_params_ajax.php",
		  					type: "POST",
		  					async: false,
		  					data: params,
		  					success: function(data)	{ 
		  			
		  						var json1 = JSON.parse(data); 
				
								type="Тип поверхности: "+json1[0];
								color="Цвет: "+json1[1];
								style="Стиль: "+json1[2];
								ves="Вес (коробка): "+json1[3];
								count="Штук (в коробке): "+json1[4];
				
							},
		 				 	error: function(jqxhr, status, errorMsg){ alert("Статус: " + status + " Ошибка: " + errorMsg);}	
						});
		
		
						var price=jQuery(this).parents(".catalog_item").find(".catalog_item_price").find('span').html();
						var price_old="";
						price_old=jQuery(this).parents(".catalog_item").find(".catalog_item_price").find('i').html();
		
						var count2=jQuery(this).parents(".catalog_item").find(".get_order.dropdown").find('.get_order-num').val();
						//alert(price_old);
		
						jQuery("#plitka1 .plitka_image img").attr("src",image1);   
						jQuery("#plitka1 h2").html(name);
						jQuery("#plitka1 .row .col-sm-6:nth-child(2) .plitka_row:first").html(art.replace("Артикул:","<span>Артикул:</span>"));
		
						jQuery("#plitka1 .row .col-sm-6:nth-child(2) .plitka_row:nth-child(3)").html(type.replace("Тип поверхности:","<span>Тип поверхности:</span>"));
						jQuery("#plitka1 .row .col-sm-6:nth-child(2) .plitka_row:nth-child(4)").html(color.replace("Цвет:","<span>Цвет:</span>"));
						jQuery("#plitka1 .row .col-sm-6:nth-child(2) .plitka_row:nth-child(5)").html(style.replace("Стиль:","<span>Стиль:</span>"));
						jQuery("#plitka1 .row .col-sm-6:nth-child(2) .plitka_row:nth-child(6)").html(ves.replace("Вес (коробка):","<span>Вес (коробка):</span>"));
						jQuery("#plitka1 .row .col-sm-6:nth-child(2) .plitka_row:nth-child(7)").html(count.replace("Штук (в коробке):","<span>Штук (в коробке):</span>"));
		
						jQuery("#plitka1 .plitka_price span").html(price);
						jQuery("#plitka1 .plitka_price i").html(price_old);
						jQuery("#plitka1 #count").val(count2);
	
	
					});	
	
					/////////////
					//filter_log=1;
					//}
	
					
					
					
					
						
				},
		  	error: function(jqxhr, status, errorMsg){ alert("Статус: " + status + " Ошибка: " + errorMsg);}	
			});

			
		}
		
		setTimeout(tm3, 500);
	
	});
	
	
	function cart_change_price(){
		var price=0;
		
		$("form.cart tr").each(function(index, element) {
			
			if( ($(this).css("display")!='none') && ($(this).hasClass('cart-final_price')==false) ){
				
				price=parseInt(price)+parseInt($(this).find(".cart-product_final_price span").html());
				
			}
		});
		$(".cart-final_price td.text-right span").html(price);
		
	}
	
	jQuery("form.cart .cart-product_num").bind('textchange', function (event, previousText) {
		var count=$(this).val();
		var price=$(this).parents('tr').find('.cart-product_price').html();
		price=price.replace(" P","");
		var final_price=count*price;
	
		$(this).parents('tr').find('.cart-product_final_price span').html(final_price);
		cart_change_price();
		$(this).attr('value',count);
		
	});
	
	
	
	jQuery("form.cart .delete_btn").click(function(){
		var type=$(this).attr('data-type');
		var id=$(this).attr('data-id');
		var session=$(this).attr('data-session');
		
		params = {id:id,type:type,session:session}
						$.ajax({
		  					url: "/delete_from_basket.php",
		  					type: "POST",
		  					async: false,
		  					data: params,
		  					success: function(data)	{ 
		  						$("tr#"+id).fadeOut(500);
								var price=0;
								$("form.cart tr").each(function(index, element) {
									if( ($(this).css("display")!='none') && ($(this).hasClass('cart-final_price')==false) ){
										//alert($(this).find(".cart-product_final_price span").html());
										price=parseInt(price)+parseInt($(this).find(".cart-product_final_price span").html());
										//alert(price);
									}
									
                                });
								$(".cart-final_price td.text-right span").html(price);
								
							},
		 				 	error: function(jqxhr, status, errorMsg){ alert("Статус: " + status + " Ошибка: " + errorMsg);}	
						});
		
	});	
	
	
	//фильтр цвета для рекомендуемых товаров
		jQuery(".product_more_container .filter_container_items .color_filter_2").click(function(){
	
	
		var purpose_id=$(this).attr('data-purpose');
		var collection_id=$(this).attr('data-collection');
		
		//список выделенных цветов
		var param_colors="";
		var t=jQuery(this);
		
		function tm3(){
			t.parents(".filter_container_colors").find(".color_filter_2").each(function(){
    			//param_surfaces=param_surfaces+$(this).attr("data-id")+":";
				if(jQuery(this).hasClass("active")){ param_colors=param_colors+$(this).attr('data-color')+":"; }
			});
		
			
			
			//запрос
			var session_id=jQuery(".session_id").html();
			params = {purpose_id:purpose_id,collection_id:collection_id,param_colors:param_colors,session_id:session_id};
			$.ajax({
		  		url: "/color_filter_detail_recomended_ajax.php",
		  		type: "POST",
		  		async: true,
		  		data: params,
		  		success: function(data)	{ 
					//alert(data);
		  	 		t.parents(".product_more_container").find(".tab-pane").html(data);
					
					//if(filter_log==0){
					//alert("log");
					/////////////////////////
						
					$('#plitka1_img_zoom a').on('click', function(){
						
						
						
					if( $("#plitka1_img_zoom #count").val()=="" ){
						$("#plitka1_img_zoom #count").css("border-color", "red");	
						return false;
					}
					var session_id=jQuery(".session_id").html();
					good_id=jQuery("#plitka1_img_zoom").attr("data-popup-id");
					var count=$('#plitka1_img_zoom #count').val();
					//alert(count);
					params = {good_id:good_id,session_id:session_id,count:count}
					$.ajax({
		  				url: "/send_good_to_basket.php",
		  				type: "POST",
		  				async: true,
		  				data: params,
		  				cache: false,
		  				success: function(data)	{ 
		  	
							$('.header_cart .header_total.cart_block').html('<a href="/cart">'+data+" товаров</a>");//#6
							$.fancybox.close();
							$('[data-id = '+good_id+']').find(".product_sell").html("<span class='blue underline'>В корзине</span>");
							$('[data-id = '+good_id+']').find("a.fancybox").attr("html","#");
							$('[data-id = '+good_id+']').find("a.fancybox").removeClass("fancybox");
						},
		  				error: function(jqxhr, status, errorMsg){ alert("Статус: " + status + " Ошибка: " + errorMsg);}	
					});
					
		
	
					});
			
			
					///////////////////
					
					
					jQuery( ".plitka_buy > a.buy_link" ).off();

						
					jQuery('.plitka_buy > a.buy_link').on('click', function(){
					//alert("1");	
					
					
						if( jQuery(".plitka_buy #count").val()=="" ){
							jQuery(".plitka_buy #count").css("border-color", "red");	
							return false;
						}
					//var good_id=jQuery(this).parents(".catalog_item").attr("data-id");
					//кидаем товар в корзину
					var session_id=jQuery(".session_id").html();
					var count=jQuery(".plitka_buy #count").val();
					//alert(count);
					params = {good_id:good_id,session_id:session_id,count:count}
					//	alert("1");
					//jQuery.session.set("n", "2222");
					
		
					$.ajax({
		 				url: "/send_good_to_basket.php",
		  				type: "POST",
		  				async: true,
		 				data: params,
		  				cache: false,
		  				success: function(data)	{ 
		  					$('.header_cart .header_total.cart_block').html('<a href="/cart">'+data+" товаров</a>");//#7
							$.fancybox.close();
							$('[data-id = '+good_id+']').find(".product_sell").html("<span class='blue underline'>В корзине</span>");
							$('[data-id = '+good_id+']').find("a.fancybox").attr("html","#");
							$('[data-id = '+good_id+']').find("a.fancybox").removeClass("fancybox");
				
						},
		  				error: function(jqxhr, status, errorMsg){ alert("Статус: " + status + " Ошибка: " + errorMsg);}	
					});
					
	
					});
					/////////////
					
					
					
					jQuery(".catalog_item .catalog_image").on('click', function(){
					//alert("2");	
						var image1=jQuery(this).parents(".catalog_item").find("img").attr('src');
						var name=jQuery(this).parents(".catalog_item").find(".catalog_item_name").find('a').html();
						var count2="";
						count2=jQuery(this).parents(".catalog_item").find(".get_order.dropdown").find('.get_order-num').val();
		
						jQuery("#plitka1_img_zoom h2").html(name);
						jQuery("#plitka1_img_zoom .plitka_image img").attr('src',image1);
						jQuery("#plitka1_img_zoom #count").val(count2);
						var tmp=jQuery(this).parents('.catalog_item').attr('data-id');
						jQuery("#plitka1_img_zoom").attr('data-popup-id',tmp);
	
					});
	
					
					
					
					
					/////////////
	
					
					jQuery( ".product_sell .get_order.dropdown a" ).off();
	
					jQuery(".product_sell .get_order.dropdown a").click(function(){
					//alert("3");	
						var image1=jQuery(this).parents(".catalog_item").find("img").attr('src');
						var name=jQuery(this).parents(".catalog_item").find(".catalog_item_name").find('a').html();
						var art=jQuery(this).parents(".catalog_item").find(".product_item_articul").html();
						good_id=jQuery(this).parents(".catalog_item").attr("data-id");
		
						var type="";
						var color="";
						var style="";
						var ves="";
						var count="";
		
						params = {good_id:good_id}
						$.ajax({
		  					url: "/get_good_params_ajax.php",
		  					type: "POST",
		  					async: false,
		  					data: params,
		  					success: function(data)	{ 
		  			
		  						var json1 = JSON.parse(data); 
				
								type="Тип поверхности: "+json1[0];
								color="Цвет: "+json1[1];
								style="Стиль: "+json1[2];
								ves="Вес (коробка): "+json1[3];
								count="Штук (в коробке): "+json1[4];
				
							},
		 				 	error: function(jqxhr, status, errorMsg){ alert("Статус: " + status + " Ошибка: " + errorMsg);}	
						});
		
		
						var price=jQuery(this).parents(".catalog_item").find(".catalog_item_price").find('span').html();
						var price_old="";
						price_old=jQuery(this).parents(".catalog_item").find(".catalog_item_price").find('i').html();
		
						var count2=jQuery(this).parents(".catalog_item").find(".get_order.dropdown").find('.get_order-num').val();
						//alert(price_old);
		
						jQuery("#plitka1 .plitka_image img").attr("src",image1);   
						jQuery("#plitka1 h2").html(name);
						jQuery("#plitka1 .row .col-sm-6:nth-child(2) .plitka_row:first").html(art.replace("Артикул:","<span>Артикул:</span>"));
		
						jQuery("#plitka1 .row .col-sm-6:nth-child(2) .plitka_row:nth-child(3)").html(type.replace("Тип поверхности:","<span>Тип поверхности:</span>"));
						jQuery("#plitka1 .row .col-sm-6:nth-child(2) .plitka_row:nth-child(4)").html(color.replace("Цвет:","<span>Цвет:</span>"));
						jQuery("#plitka1 .row .col-sm-6:nth-child(2) .plitka_row:nth-child(5)").html(style.replace("Стиль:","<span>Стиль:</span>"));
						jQuery("#plitka1 .row .col-sm-6:nth-child(2) .plitka_row:nth-child(6)").html(ves.replace("Вес (коробка):","<span>Вес (коробка):</span>"));
						jQuery("#plitka1 .row .col-sm-6:nth-child(2) .plitka_row:nth-child(7)").html(count.replace("Штук (в коробке):","<span>Штук (в коробке):</span>"));
		
						jQuery("#plitka1 .plitka_price span").html(price);
						jQuery("#plitka1 .plitka_price i").html(price_old);
						jQuery("#plitka1 #count").val(count2);
	
	
					});	
	
					/////////////
					//filter_log=1;
					//}
	
					
					
					
					
						
				},
		  	error: function(jqxhr, status, errorMsg){ alert("Статус: " + status + " Ошибка: " + errorMsg);}	
			});

			
		}
		
		setTimeout(tm3, 500);
	
	});
	

	
	
	
	
	
	
	
});

function collection_to_basket(id_collection,id_session){

	params = {id_collection:id_collection,id_session:id_session};
	$.ajax({
		  url: "/collection_to_basket.php",
		  type: "POST",
		  async: true,
		  data: params,
		  success: function(data)	{ 
		  //	alert(data);
				$('.product_buy_link').css("background-color","transparent");	
				$('.product_buy_link').css("color","#f39c0f");	
				$('.product_buy_link').html("<strong>Коллекция в корзине</strong>");
				$('.header_cart .header_total.cart_block').html('<a href="/cart">'+data+" товаров</a>");//#1
						
				},
		  error: function(jqxhr, status, errorMsg){ alert("Статус: " + status + " Ошибка: " + errorMsg);}	
	});


	
}


function parseGetParams() { 
   var $_GET = {}; 
   var __GET = window.location.search.substring(1).split("&"); 
   for(var i=0; i<__GET.length; i++) { 
      var getVar = __GET[i].split("="); 
      $_GET[getVar[0]] = typeof(getVar[1])=="undefined" ? "" : getVar[1]; 
   } 
   return $_GET; 
} 
	
	function search_collections_more(){
 
	 var data1 = $('a.more').attr('data-number');	
	 	
	 data1=parseInt(data1);
	
	
	var url=location.href;
	var get = parseGetParams(); 
	
	var n=2;
	
	var param_price_min=get.price_min;
	var param_price_max=get.price_max;
	var param_factories=get.factories;
	var param_based_sizes=get.based_sizes;
	var param_purposes=get.purposes;
	var param_materials=get.materials;
	var param_surfaces=get.surfaces;
	var param_styles=get.styles;
	var param_colors=get.colors;
		
		
		
		params = {price_min:param_price_min,price_max:param_price_max,factories:param_factories,based_sizes:param_based_sizes,purposes:param_purposes,materials:param_materials,surfaces:param_surfaces,styles:param_styles,colors:param_colors,start_number:data1,url:url,number1:n};
	
	
	$.ajax({
		  url: "/search_collections_main_ajax.php",
		  type: "POST",
		  async: true,
		  data: params,
		  headers: {
            'Cookie': document.cookie
          },
		  beforeSend(jqXHR, settings){
		  $('.load_fon').fadeIn(100);
		  $('.load_fon').css('z-index','9999999');
		  },
		  success: function(data)	{ 
		  		
							
				var m = data.split("-!-");

				
							
				$('.load_fon').fadeOut(100);		
			
				var html=$(".search_container").html(); 
				html=html+m[0]; $(".search_container").html(html);  
			
			
			
			/*
				data = data.replace(/\r|\n/g, '');
				data = data.replace(/   /g, '');
				
				data = data.replace(/> </g, '><');
				data = data.replace(/>  </g, '><');
				data = data.replace(/>   </g, '><');
				data = data.replace(/<\/span><i>/g, ' P</span><i>');
			
				
				
		  		  var html=$(".row.row_catalog_front:first").html(); 
						html=html+data; $(".row.row_catalog_front:first").html(html);  
				
				var t='<div class="moreBtns"><a class="more" style="margin-left:auto; margin-right:auto;" href="javascript:void(0)" onclick="search_collections_ajax('+(n+1)+');">Показать ещё</a>	</div>';
				$(".row.row_catalog_front.pagination").html(t);
				*/
				
				},
		  error: function(jqxhr, status, errorMsg){ alert("Статус: " + status + " Ошибка: " + errorMsg);}	
				});



	
	
	
	
	/*
	 for(i=data1;i<(data1+32);i++){
	 	$('.search_r_'+i+'').fadeIn(500);
	 }
	 data1=data1+32;
	 $('a.more').attr('data-number',data1);	
	*/
	
	
	
	
		
	 	
	}
	



function search_collections_ajax(n){



function tm(){
		
		//var param_price_min=$('.price_container input#price1').attr('data-value');
		//var param_price_max=$('.price_container input#price2').attr('data-value');
		var param_price_min=$('.price_container input#price1').val();
		var param_price_max=$('.price_container input#price2').val();
		
		
		var param_factories="";
		$('#countries .btn.btn-primary.types_filter').each(function(){
			if(($(this).attr('data-id')!=undefined) && ($(this).attr('data-id')!='') && ($(this).hasClass('active'))){
    			param_factories=param_factories+$(this).attr('data-id')+":";
			}
		});
		
		
		
		var param_based_sizes="";
		$('#sizes .btn.btn-primary.types_filter').each(function(){
			if($(this).hasClass('active')){
    			param_based_sizes=param_based_sizes+$(this).attr('data-id')+":";
			}
		});
		
		
		
		
		var param_purposes="";
		$('.purposes_checkbox').each(function(){
    		if($(this).prop("checked")){ param_purposes=param_purposes+$(this).attr("data-id")+":"; }
		});
		
		var param_materials="";
		$('.materials_checkbox').each(function(){
    		if($(this).prop("checked")){ param_materials=param_materials+$(this).attr("data-id")+":"; }
		});
		
		
		var param_surfaces="";
		$('.ch_surface').each(function(){
			//alert($(this).attr('data-surface'));
    		//param_surfaces=param_surfaces+$(this).attr("data-id")+":";
			if($(this).hasClass("active")){ param_surfaces=param_surfaces+$(this).attr('data-surface')+":"; }
		});
		
		
		var param_styles="";
		$('.ch_style').each(function(){
    		//param_surfaces=param_surfaces+$(this).attr("data-id")+":";
			if($(this).hasClass("active")){ param_styles=param_styles+$(this).attr('data-style')+":"; }
		});
		
		var param_colors="";
		$('.ch_color').each(function(){
    		//param_surfaces=param_surfaces+$(this).attr("data-id")+":";
			if($(this).hasClass("active")){ param_colors=param_colors+$(this).attr('data-color')+":"; }
		});
		
		
		//var url="price_min="+param_price_min+"&price_max="+param_price_max+"&factories="+param_factories+"&based_sizes="+param_based_sizes+"&purposes="+param_purposes+"&materials="+param_materials+"&surfaces="+param_surfaces+"&styles="+param_styles+"&colors="+param_colors+"";
		var session=$.session.get("start_collection");
		var url=location.href;
		params = {price_min:param_price_min,price_max:param_price_max,factories:param_factories,based_sizes:param_based_sizes,purposes:param_purposes,materials:param_materials,surfaces:param_surfaces,styles:param_styles,colors:param_colors,start_number:session,url:url,number1:n};
	//params2 = { product_id:product_id,material_name1:material_name1,material_name2:material_name2,price:price,size:size };
	$.ajax({
		  url: "/search_collections_ajax.php",
		  type: "POST",
		  async: true,
		  data: params,
		  headers: {
            'Cookie': document.cookie
          },
		  beforeSend(jqXHR, settings){
		  $('.load_fon').fadeIn(100);
		  
		  },
		  success: function(data)	{ 
		  		$('.load_fon').fadeOut(100);		
				//alert(typeof data);
				//alert(data);
		  		//data="==="+data;
		  		//data.replace(/catalog_item_price/g,'catalog_item_price tmp0');
				
				
				//data.replace(new RegExp("catalog_item_price",'g'),"tmp0")

				//data.replace('</span><i>',' Р </span><i>');
				data = data.replace(/\r|\n/g, '');
				data = data.replace(/   /g, '');
				
				data = data.replace(/> </g, '><');
				data = data.replace(/>  </g, '><');
				data = data.replace(/>   </g, '><');
				data = data.replace(/<\/span><i>/g, ' P</span><i>');
			
				 
				
				
		  		if(n==1){  $(".row.row_catalog_front:first").html(data.replace(/class="catalog_item_price"><span>/g,'class="catalog_item_price"><span>От ')); }
				else{  var html=$(".row.row_catalog_front:first").html(); 
						data = data.replace(/class="catalog_item_price"><span>/g,'class="catalog_item_price"><span>От ');
						html=html+data; $(".row.row_catalog_front:first").html(html);  } 
				
				var t='<div class="moreBtns"><a class="more" style="margin-left:auto; margin-right:auto;" href="javascript:void(0)" onclick="search_collections_ajax('+(n+1)+');">Показать ещё</a>	</div>';
				$(".row.row_catalog_front.pagination").html(t);
				
				
				},
		  error: function(jqxhr, status, errorMsg){ alert("Статус: " + status + " Ошибка: " + errorMsg);}	
				});



}
setTimeout(tm, 1000);


}









$.extend($.validator.messages, {
	required: "Это поле необходимо заполнить.",
	remote: "Пожалуйста, введите правильное значение.",
	email: "Пожалуйста, введите корректный адрес электронной почты.",
	url: "Пожалуйста, введите корректный URL.",
	date: "Пожалуйста, введите корректную дату.",
	dateISO: "Пожалуйста, введите корректную дату в формате ISO.",
	number: "Пожалуйста, введите число.",
	digits: "Пожалуйста, вводите только цифры.",
	creditcard: "Пожалуйста, введите правильный номер кредитной карты.",
	equalTo: "Пожалуйста, введите такое же значение ещё раз.",
	extension: "Пожалуйста, выберите файл с правильным расширением.",
	maxlength: $.validator.format( "Пожалуйста, введите не больше {0} символов." ),
	minlength: $.validator.format( "Пожалуйста, введите не меньше {0} символов." ),
	rangelength: $.validator.format( "Пожалуйста, введите значение длиной от {0} до {1} символов." ),
	range: $.validator.format( "Пожалуйста, введите число от {0} до {1}." ),
	max: $.validator.format( "Пожалуйста, введите число, меньшее или равное {0}." ),
	min: $.validator.format( "Пожалуйста, введите число, большее или равное {0}." )
});

function set_max_height(elms, addh) {
  if (typeof(addh) === 'undefined') addh = 0;
  var maxHeight = Math.max.apply(null, elms.map(function (){
      return jQuery(this).height();
  }).get());
  elms.height(maxHeight+addh);
}
function set_makro_height() {
  var wwidth = window.innerWidth;
  console.log(wwidth);

  //if (wwidth < 1000) {
  //set_max_height(jQuery('.hiw_image'));

  //console.log('>991');
  //return false;
  //}
  set_max_height(jQuery('.merch_item_1, .fix_height'));
  console.log('min');
}
$(window).load(function () {
	set_makro_height();
    $(".demo").customScrollbar();
    $("#fixed-thumb-size-demo").customScrollbar({fixedThumbHeight: 50, fixedThumbWidth: 60});

    $(".scrollbarcontainer").customScrollbar({
		  skin: "default-skin", 
		  hScroll: false,
		  updateOnWindowResize: true,
		  fixedThumbHeight: 61
		});
});
$(window).resize(function () {
	set_makro_height();
});




(function($) {
    $(document).ready(function() {
	
		$(".map_contacts img").click(function() {
			var code_id=$(this).attr('data-map');
			
			//var code=$('.inner_content_box_contacts #id_'+code_id).html();
			$('#modal_map_'+code_id).fadeIn(500);
		});
		
		$(".modal_map .close").click(function() {
			$(".modal_map").fadeOut(500);
		});
		//
		
		
    	$( ".merch_select" ).selectmenu();

		//$('.bxslider_front').bxSlider({
		//  pagerCustom: '#slider_pager',
		//  mode: 'fade',
		//  auto: true,
		//  controls: false,
		//  pause: 6000
		//});
		
		$('.slider_about').bxSlider({
		  auto: false,
		  pager: false,
		  controls: true,
		  minSlides: 4,
		  maxSlides: 4,
		  slideWidth: 155,
		  slideMargin: 0
		});

		$('.bxslider, .widget_slider > ul').bxSlider({
		  mode: 'fade',
		  auto: true,
		  controls: false
		});
		$('.scroll').click(function() {
	        str = $(this).attr("href");
	        $.scrollTo(str, 500);
	        return false;
	    });

	
	    //$( "#slider-range" ).slider({
	    //  range: true,
	    //  min: 100,
	    //  max: 5000,
	    //  values: [ 250, 2500 ],
	    //  slide: function( event, ui ) {
	    //    $( "#price1" ).val(ui.values[ 0 ]);
	    //    $( "#price2" ).val(ui.values[ 1 ]);
	    //  }
	    //});
	    //$( "#price1" ).val( $( "#slider-range" ).slider( "values", 0 ));
	    //$( "#price2" ).val( $( "#slider-range" ).slider( "values", 1 ) );

	    //$('#price1').change(function(){
		//    $('#slider-range').slider("values",0,$(this).val());
		//    $('#slider-range').slider("values",1,$('#price2').val());
		//});


		//$('#price2').change(function(){
		//    $('#slider-range').slider("values",0,$('#price1').val());
		//    $('#slider-range').slider("values",1,$(this).val());
		//});
		

		$(".tag a").click(function(event){
			event.preventDefault();
			$(this).parent('.tag').remove();
			return false;
		});

		$('.fancybox').fancybox({padding: [22,22,22,22]});

		// $('.fancybox-thumb').fancybox({
		// 	prevEffect	: 'none',
		// 	nextEffect	: 'none',
		// 	helpers	: {
		// 		title	: {
		// 			type: 'outside'
		// 		},
		// 		thumbs	: {
		// 			width	: 50,
		// 			height	: 50
		// 		}
		// 	}
		// });

		$('.filter_system_links_clear').click(function(e){
			e.preventDefault();
			$('.types_filter, .filter_container_colors > label').removeClass('active');
			return false;
		});

		// $('#modal').on('hidden.bs.modal', function(){
		// 	show_success_modal();
		// });

		$('#request1-form').validate();
		$('#request2-form').validate();
		$('#registration-form').validate(); // слитно с #request-form не работает :(
		$('#feedback-form').validate();
		$('#login-form').validate({
			rules: {
				name: {
					required: true,
					minlength: 3
				},
				password: {
					required: true
				}
			},
			messages: {
				name: {
					required: 'Пожалуйста, введите свой никнейи',
					minlength: 'Некорректное значение'
				},
				password: {
					required: 'Пожалуйста, введите пароль'
				}
			}
		});
		$('#restore_pass-form').validate({
			rules: {
				email: {
					required: true,
					email: true
				}
			},
			messages: {
				email: {
					required: 'Пожалуйста, введите свой email',
					email: 'Пожалуйста, введите корректный адрес'
				}
			}
		});

		$(document).on('click', '.form-restore_pass_link', function(){
	        $('#login').modal('hide');
	        $('#login').on('hidden.bs.modal', function(){
				$('#restore_pass').modal('show');
			});
	    });

	    $(document).on('click', '.get_order .get_order-btn', function(){
	    	$(this).parent().addClass('active');
	    	$(this).removeClass('get_order-btn').addClass('fancybox');
	    });
	    $(document).on('click', '.get_order .close-sm', function(){
	    	$(this).parent().removeClass('active');
	    	$(this).parent().find('.fancybox').removeClass('fancybox').addClass('get_order-btn');
	    });

	    $(document).on('click', '.color_sort .sort_link', function(e){
	    	e.preventDefault();
	    	$(this).parent().find('.dropdown').addClass('active');
	    });
	    $(document).on('click', '.color_sort .close-sm', function(){
	    	$(this).parent('.dropdown').removeClass('active');
	    });

	    $(document).on('click', '.filter_country_container .filter_link a', function(e){
	    	e.preventDefault();
	    	$('.dropdown').removeClass('active');
	    	$(this).parent().parent().find('.dropdown').addClass('active');
	    });
	    $(document).on('click', '.filter_country_container .close-sm', function(){
	    	$(this).parent('.dropdown').removeClass('active');
	    });
		
		
		
		
		$('.btn.btn-primary.color_filter_1').hover(function(){
			$(this).find(".name_container").fadeIn(100);
		},function(){
			$(this).find(".name_container").fadeOut(100);
		});
		
		
		
		
		$('.inner_content_box .button_up span').click(function(){
			var margin_top=$('.docs_container').css('margin-top');
			
			if(parseInt(margin_top)<0){
				margin_top=parseInt(margin_top)+40;
				//$('.docs_container').css('margin-top',margin_top+'px');
				
				$('.docs_container').animate(
  				{
    				marginTop: margin_top+"px",
    			},
				400);
				
			}
		});
		
		
		
		$('.product_sell a').click(function(){
			$('.dropdown').removeClass('active');
		
		});
		
		$('.inner_content_box .button_down span').click(function(){
		
			
			var margin_top=$('.docs_container').css('margin-top');
			margin_top=parseInt(margin_top);
			var height_full=$('.docs_container').css('height');
			height_full=parseInt(height_full);
			
			var height1=$('.about_docs_container').css('height');
			height1=parseInt(height1);
			
			
			
			//alert(Math.abs(margin_top));
			//alert((height_full-height1));
			
			if(Math.abs(margin_top)<(height_full-height1)){
				
				margin_top=parseInt(margin_top)-40;
				
				//$('.docs_container').animate({margin-top: margin_top+"px"}, 1000);
				
				$('.docs_container').animate(
  				{
    				marginTop: margin_top+"px",
    			},
				400);
				
				//$('.docs_container').css('margin-top',margin_top+'px');
			}
			
			
			
		
		});
		

		

	});

})(jQuery)

function show_success_modal(){
	$('#success_modal .modal-title').html('Заявка получена');
	$('#success_modal .modal-body').css('padding-top', 0).html('<p>Спасибо, наш менеджер свяжется с вами в ближайшее время</p>');
	$('#success_modal').modal('show');
	$('#success_modal').on('hidden.bs.modal', function(){
		$('#success_modal .modal-title').html('');
		$('#success_modal .modal-body').html('');
	});
}

// fade in #back-top
jQuery(function () {
	jQuery(window).scroll(function () {
  
		if (jQuery(this).scrollTop() > 100) {
			jQuery('#back-top').fadeIn();
		} else {
			jQuery('#back-top').fadeOut();
		}
	});

	// scroll body to 0px on click
	jQuery('#back-top .toplink').click(function () {
		jQuery('body,html').animate({
			scrollTop: 0
		}, 400);
		return false;
	});
});


	    jQuery(document).on('click', '.color_sort .sort_link', function(e){
			
	    	e.preventDefault();
	    	jQuery(this).parent().find('.dropdown').addClass('active');
	    });
	    jQuery(document).on('click', '.color_sort .close-sm', function(){
	    	jQuery(this).parent('.dropdown').removeClass('active');
	    });



    //window.prettyPrint && prettyPrint();







