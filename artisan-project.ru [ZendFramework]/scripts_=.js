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

  /*if (wwidth < 1000) {
    set_max_height(jQuery('.hiw_image'));

    console.log('>991');
    return false;
  }*/
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
    	
    	$( ".merch_select" ).selectmenu();

		$('.bxslider_front').bxSlider({
		  pagerCustom: '#slider_pager',
		  mode: 'fade',
		  auto: true,
		  controls: false,
		  pause: 6000
		});

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

	    $( "#slider-range" ).slider({
	      range: true,
	      min: 100,
	      max: 5000,
	      values: [ 250, 2500 ],
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