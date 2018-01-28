$(document).ready(function () {

var date_interval = 1;

var setTimeoutConst;
	$('.submit_search,.input_search').hover(function() {
			if($('.input_search').is(':focus')!=true){
				 setTimeoutConst = setTimeout(function(){
					$('#help_message_finder').fadeIn(1000);
				 }, 1000);
			 }
		}, function(){
		clearTimeout(setTimeoutConst);
    });
	  
	$('.input_search').focus(function() {
		setTimeout(function(){
					$('#help_message_finder').fadeOut(5000);
		}, 5000);
	 });
	 
	 $(document).mouseover(function(e){
		if(e.relatedTarget!=null){
			if(	e.relatedTarget.className!='submit_search' && 
				e.relatedTarget.className!='input_search search_form ui-autocomplete-input' && 
				!$('#help_message_finder').is(':hidden')
			  ){
				setTimeout(function(){
					$('#help_message_finder').fadeOut(5000);
				}, 5000);
			}
		}
	 });
	$(document).ready(function(){
					setTimeout(function(){
					$('.bomber').fadeOut(5000);
				}, 15000);
		
	 });  
	$(function(){
		var cookie = getCookie('help_message_finder');
		if(cookie==undefined){
			var date = new Date;
			date.setDate( date.getDate() + date_interval );
			options = {expires:date.toUTCString(),path:'/'};
			setCookie('help_message_finder','yes',options);
			get_help_window();
		}
	});
	function get_help_window(){
		$('#help_message_finder').fadeIn( 3000, function() {
				setTimeout(function(){
					$('#help_message_finder').fadeOut(5000);
				}, 5000);
			});
	}



	$('#close-help').click(function(){
		$('#help_message_finder').hide();
	});
	$('form.ajax').live('submit', function () {
		
		var myObj = $(this);
		$('input[type=submit]', this).attr('disabled', 'disabled');
		$(this).find("input[name='ajax']").val('1');
		$(this).ajaxSubmit({
			dataType:'json',

			beforeSubmit:function (a, form, o) {
				// console.log(a);
				// console.log(form);
				// console.log(o);
				$('.errors').hide();
			},
			complete: function (xhr, r){
				var cl = myObj.attr('class').replace('ajax ', '');
				// console.log(myObj.attr('class').replace('ajax ', ''));
				// console.log(xhr);
				// console.log(r);
				if(r == 'parsererror' && cl == 'filter_form'){
					
					$('.menu_right_go a').html('Показать');
					$('.menu_right_go a').css('cursor', 'pointer');
					alert('Ничего не найдено.');
				}
				
				
			},
			success:function (response, statusText, xhr, form) {
				// console.log(xhr);
				
				
				if(response.print_result == 1)
				{
					var decoded = $("<div/>").html(response.data).text();
					//alert(decoded)
					$('.text').html(decoded);
					//$.cookie('text_temp', decoded);
					//alert($.cookie('text_temp'));
					
					$.session.set('text_temp', decoded);
					//alert($.session.get('text_temp'));
					
					
					
					$('.cont>h1').html('Результаты поиска');
					var html_selected = 'Выбрано: ';
					//назначение
					$('#usefor_selects a').each(function(){
						html_selected += $(this).html()+', ';
					});
					//материал
					$('#materials_selects a').each(function(){
						html_selected += $(this).html()+', ';
					});
					//страна
					$('#countries_selects a').each(function(){
						html_selected += $(this).html()+', ';
					});
					// чекбоксы
					if($('#f_hit').is(':checked'))
						html_selected += ' Хиты,';
					if($('#f_new').is(':checked'))
						html_selected += ' Новинки,';
					if($('#f_sale').is(':checked'))
						html_selected += 'Со скидками, ';
					if($('#f_action').is(':checked'))
						html_selected += ' По акции,';
					//цена
					html_selected += ' от '+$('#f_minp').val()+' до '+$('#f_maxp').val()+' рублей за м2,';
					html_selected = html_selected.substr(0,html_selected.length-1);
					$('.selected_in_filter').remove();
					//добавляем информацию
					$('.cont>h1').after('<div class="selected_in_filter">'+html_selected+'</div>');
					//меняем крошки
					$('.path').html('<a href="/catalog/">Каталог продукции</a> ► <span>Результаты поиска</span>'+
					'<a class="back-button tmp2" href="javascript:void(0)">Вернутся назад</a>');
					//добавляем пейджинг
					$('.text').append('<div style="left:596px" class="next-prev-buttons"><a class="prev-fp" style="display:none;" href="javascript:void(0)">'+
						'< предыдущая</a><a class="next-fp" href="javascript:void(0)">'+
						'следующая ></a></div>');
					$('.catalog-first-page').remove();
					$('.text_t').remove();
					$('.ps-full').each(function(){
						var clas = $(this).attr('class');
						clas = clas.replace(' ps-full', '');
						var id = clas.replace('photoslider', '');
						// console.log(clas + ' / ' + $('.' + clas + ' ul').length);
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

					$('.fp_page').each(function(){
						$(this).addClass('filter_page');
						$(this).removeClass('fp_page');
					});

					$('.menu_right_go a').html('Показать');
					$('.menu_right_go a').css('cursor', 'pointer');
				}

				$('input[type=submit]', form).removeAttr('disabled');
				var update = $(form).find("input[name='update']").val();
				if (response.captcha) {
					if(response.captcha == "recaptcha")
					{
						Recaptcha.reload();
					}
					else
					{
						response.captcha = prepare(response.captcha);
						$(form).find(".captcha").html(response.captcha).show();
					}
				}
				if (!update && response.errors) {
					$.each(response.errors, function (k, val) {
						val = prepare(val);
						if(!response.form_hide) {
							$(form).find(".error" + (k != 0 ? "_" + k : '')).html(val).show();
						}
						else
						{
							$(form).parent().find(".error"+ (k != 0 ? "_" + k : '')).html(val).show();
						}
					});
				}
				if (response.success) {
					$(form).clearForm();
					$(form).find('.inpattachment input[type=file]').each(function () {
						if($(this).parents('.inpattachment').css('display') == 'none')
						{
							var clone = $(this).parents('.inpattachment');
							clone.before(clone.clone(true));
							clone.prev('.inpattachment').show();
							var name = str_replace('hide_', '', clone.prev('.inpattachment').find('input').val('').attr("name"), 0 );
							clone.prev('.inpattachment').find('input').val('').attr("name", name);
						}
						else
						{
							$(this).parents('.inpattachment').remove();
						}
					});
					$(form).find('input[type=file]').removeClass('last');
					$(form).find('input[type=file]').val('');
				}
				if (response.add) {
					$('.' + $(form).attr("id")).append(prepare(response.add));
					$('.' + $(form).attr("id")).show();
				}
				if (response.form) {
					$(form).html(prepare(response.form));
				}
				if (response.form_hide) {
					if (response.target_hide) {
						$(response.target_hide).hide();
					}
					else {
						$(form).hide();
					}
				}
				if (response.redirect) {
					window.location = response.redirect;
				}
				if (response.data && response.target) {
					$(response.target).html(prepare(response.data)).show();
					$(form).find("input[name=avatar]").val('');
				}
				if (response.data2 && response.target2) {
					$(response.target2).html(prepare(response.data2)).show();
				}
				if(response.attachments){
					 $.each(response.attachments, function (k, val) {
						val = prepare(val);
						$(form).find(".attachment[name='"+k+"']").remove();
						$(form).find(".inpattachment input[name='"+k+"']").parents('.inpattachment').remove();
						$(form).find(".inpattachment input[name='hide_"+k+"']").parents('.inpattachment').before(val);
						$(form).find(".attachment[name='"+k+"']").show();
						if($(form).find(".inpattachment input[name='hide_"+k+"']").attr("max") > $(form).find(".attachment[name='"+k+"']").length)
						{
							var clone = $(form).find("input[name='hide_" + k + "']").parents('.inpattachment');
							clone.before(clone.clone(true));
							clone.prev('.inpattachment').show();
							clone.prev('.inpattachment').find('input').val('').attr("name", k);
						}
					});
				}
				if(response.images){
					 $.each(response.images, function (k, val) {
						$(form).find("input[name='"+k+"']").val('');
						$(form).find("input[name='"+k+"']").parents('div').first().find('.image').remove();
						$(form).find("input[name='"+k+"']").before(prepare(val));
					});
				}
				if (response.hash) {
					$('input[name=check_hash_user]').val(response.hash);
				}
				return false;
			}
		});
		return false;
	});
	
	
	
	$(window).load(function(){
		
		var url=location.href;
		if(url.indexOf('minpr') + 1) {
			//$('#sort_type').remove();
			//$('form.ajax').append('<input type="hidden" id="sort_type" name="sort_by" value="price" />');
			//$('form.ajax').submit();
			$('.text').html($.session.get('text_temp'));
			//$('.catalog-first-page').remove();
			
			$('.cont>h1').html('Результаты поиска');
					var html_selected = 'Выбрано: ';
					//назначение
					$('#usefor_selects a').each(function(){
						html_selected += $(this).html()+', ';
					});
					//материал
					$('#materials_selects a').each(function(){
						html_selected += $(this).html()+', ';
					});
					//страна
					$('#countries_selects a').each(function(){
						html_selected += $(this).html()+', ';
					});
					// чекбоксы
					if($('#f_hit').is(':checked'))
						html_selected += ' Хиты,';
					if($('#f_new').is(':checked'))
						html_selected += ' Новинки,';
					if($('#f_sale').is(':checked'))
						html_selected += 'Со скидками, ';
					if($('#f_action').is(':checked'))
						html_selected += ' По акции,';
					//цена
					html_selected += ' от '+$('#f_minp').val()+' до '+$('#f_maxp').val()+' рублей за м2,';
					html_selected = html_selected.substr(0,html_selected.length-1);
					$('.selected_in_filter').remove();
					//добавляем информацию
					$('.cont>h1').after('<div class="selected_in_filter">'+html_selected+'</div>');
					//меняем крошки
					$('.path').html('<a href="/catalog/">Каталог продукции</a> ► <span>Результаты поиска</span>'+
					'<a class="back-button tmp3" href="javascript:void(0)">Вернутся назад</a>');
					//добавляем пейджинг
					$('.text').append('<div style="left:596px" class="next-prev-buttons"><a class="prev-fp" style="display:none;" href="javascript:void(0)">'+
						'< предыдущая</a><a class="next-fp" href="javascript:void(0)">'+
						'следующая ></a></div>');
					$('.catalog-first-page').remove();
					$('.text_t').remove();
					$('.ps-full').each(function(){
						var clas = $(this).attr('class');
						clas = clas.replace(' ps-full', '');
						var id = clas.replace('photoslider', '');
						// console.log(clas + ' / ' + $('.' + clas + ' ul').length);
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

					$('.fp_page').each(function(){
						$(this).addClass('filter_page');
						$(this).removeClass('fp_page');
					});

					$('.menu_right_go a').html('Показать');
					$('.menu_right_go a').css('cursor', 'pointer');
			
			
			
		}	
	});
	
	
	
	$('body').on('click','.head_page',function(){
		var url=location.href;
		if(url.indexOf('minpr=') + 1) {
			
			
			
			
			
			
			
			
			
			
			//$('#sort_type').remove();
			//$('form.ajax').append('<input type="hidden" id="sort_type" name="sort_by" value="price" />');
			//$('form.ajax').submit();
			
			/*
			var myObj = $('form.ajax');
			$('input[type=submit]', 'form.ajax').attr('disabled', 'disabled');
			$('form.ajax').find("input[name='ajax']").val('1');
			$('form.ajax').ajaxSubmit({
				dataType:'json',

				beforeSubmit:function (a, form, o) {
					// console.log(a);
					// console.log(form);
					// console.log(o);
					$('.errors').hide();
				},
				complete: function (xhr, r){
					var cl = myObj.attr('class').replace('ajax ', '');
					// console.log(myObj.attr('class').replace('ajax ', ''));
					// console.log(xhr);
					// console.log(r);
					if(r == 'parsererror' && cl == 'filter_form'){
						$('.menu_right_go a').html('Показать');
						$('.menu_right_go a').css('cursor', 'pointer');
						alert('Ничего не найдено.');
					}
				},
				success:function (response, statusText, xhr, form) {
					// console.log(xhr);
					if(response.print_result == 1)
					{
						var decoded = $("<div/>").html(response.data).text();
						$('.text').html(decoded);
						$('.cont>h1').html('Результаты поиска');
						var html_selected = 'Выбрано: ';
						//назначение
						$('#usefor_selects a').each(function(){
							html_selected += $('form.ajax').html()+', ';
						});
						//материал
						$('#materials_selects a').each(function(){
							html_selected += $('form.ajax').html()+', ';
						});
						//страна
						$('#countries_selects a').each(function(){
							html_selected += $('form.ajax').html()+', ';
						});
						// чекбоксы
						if($('#f_hit').is(':checked'))
							html_selected += ' Хиты,';
						if($('#f_new').is(':checked'))
							html_selected += ' Новинки,';
						if($('#f_sale').is(':checked'))
							html_selected += 'Со скидками, ';
						if($('#f_action').is(':checked'))
							html_selected += ' По акции,';
						//цена
						html_selected += ' от '+$('#f_minp').val()+' до '+$('#f_maxp').val()+' рублей за м2,';
						html_selected = html_selected.substr(0,html_selected.length-1);
						$('.selected_in_filter').remove();
						//добавляем информацию
						$('.cont>h1').after('<div class="selected_in_filter">'+html_selected+'</div>');
						//меняем крошки
						$('.path').html('<a href="/catalog/">Каталог продукции</a> ► <span>Результаты поиска</span>'+
						'<a class="back-button" href="javascript:void(0)">Вернутся назад</a>');
						//добавляем пейджинг
						$('.text').append('<div style="left:596px" class="next-prev-buttons"><a class="prev-fp" style="display:none;" href="javascript:void(0)">'+
						'< предыдущая</a><a class="next-fp" href="javascript:void(0)">'+
						'следующая ></a></div>');
						$('.catalog-first-page').remove();
						$('.text_t').remove();
						$('.ps-full').each(function(){
							var clas = $('form.ajax').attr('class');
							clas = clas.replace(' ps-full', '');
							var id = clas.replace('photoslider', '');
							// console.log(clas + ' / ' + $('.' + clas + ' ul').length);
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

						$('.fp_page').each(function(){
							$('form.ajax').addClass('filter_page');
							$('form.ajax').removeClass('fp_page');
						});

						$('.menu_right_go a').html('Показать');
						$('.menu_right_go a').css('cursor', 'pointer');
					}

					$('input[type=submit]', form).removeAttr('disabled');
					var update = $(form).find("input[name='update']").val();
					if (response.captcha) {
						if(response.captcha == "recaptcha")
						{
							Recaptcha.reload();
						}
						else
						{
							response.captcha = prepare(response.captcha);
							$(form).find(".captcha").html(response.captcha).show();
						}
					}
					if (!update && response.errors) {
						$.each(response.errors, function (k, val) {
							val = prepare(val);
							if(!response.form_hide) {
								$(form).find(".error" + (k != 0 ? "_" + k : '')).html(val).show();
							}
							else
							{
								$(form).parent().find(".error"+ (k != 0 ? "_" + k : '')).html(val).show();
							}
						});
					}
					if (response.success) {
						$(form).clearForm();
						$(form).find('.inpattachment input[type=file]').each(function () {
							if($('form.ajax').parents('.inpattachment').css('display') == 'none')
							{
								var clone = $('form.ajax').parents('.inpattachment');
								clone.before(clone.clone('form.ajax'));
								clone.prev('.inpattachment').show();
								var name = str_replace('hide_', '', clone.prev('.inpattachment').find('input').val('').attr("name"), 0 );
								clone.prev('.inpattachment').find('input').val('').attr("name", name);
							}
							else
							{
								$('form.ajax').parents('.inpattachment').remove();
							}
						});
						$(form).find('input[type=file]').removeClass('last');
						$(form).find('input[type=file]').val('');
					}
					if (response.add) {
						$('.' + $(form).attr("id")).append(prepare(response.add));
						$('.' + $(form).attr("id")).show();
					}
					if (response.form) {
						$(form).html(prepare(response.form));
					}
					if (response.form_hide) {
						if (response.target_hide) {
							$(response.target_hide).hide();
						}
						else {
							$(form).hide();
						}
					}
					if (response.redirect) {
						window.location = response.redirect;
					}
					if (response.data && response.target) {
						$(response.target).html(prepare(response.data)).show();
						$(form).find("input[name=avatar]").val('');
					}
					if (response.data2 && response.target2) {
						$(response.target2).html(prepare(response.data2)).show();
					}
					if(response.attachments){
					 	$.each(response.attachments, function (k, val) {
							val = prepare(val);
							$(form).find(".attachment[name='"+k+"']").remove();
							$(form).find(".inpattachment input[name='"+k+"']").parents('.inpattachment').remove();
							$(form).find(".inpattachment input[name='hide_"+k+"']").parents('.inpattachment').before(val);
							$(form).find(".attachment[name='"+k+"']").show();
							if($(form).find(".inpattachment input[name='hide_"+k+"']").attr("max") > $(form).find(".attachment[name='"+k+"']").length)
							{
								var clone = $(form).find("input[name='hide_" + k + "']").parents('.inpattachment');
								clone.before(clone.clone(true));
								clone.prev('.inpattachment').show();
								clone.prev('.inpattachment').find('input').val('').attr("name", k);
							}
						});
					}
					if(response.images){
					 	$.each(response.images, function (k, val) {
							$(form).find("input[name='"+k+"']").val('');
							$(form).find("input[name='"+k+"']").parents('div').first().find('.image').remove();
							$(form).find("input[name='"+k+"']").before(prepare(val));
						});
					}
					if (response.hash) {
						$('input[name=check_hash_user]').val(response.hash);
					}
					return false;
				}
				});
		*/
		
		
		}	
	
		
	});
	
		
	
	$('body').on('click','#sort_by_popular',function(){
		var ths = $(this);
		if(ths.attr('class')!='active'){
			$('#sort_type').remove();
			$('form.ajax').submit();
			ths.replaceWith('<a style="text-decoration: none;color:#fff;" href="javascript:void(0)">Загрузка...</a>');
		}
	});
	$('body').on('click','#sort_by_price',function(){
		var ths = $(this);
		if(ths.attr('class')!='active'){
			$('#sort_type').remove();
			$('form.ajax').append('<input type="hidden" id="sort_type" name="sort_by" value="price" />');
			$('form.ajax').submit();
			ths.replaceWith('<a style="text-decoration: none;color:#fff;" href="javascript:void(0)">Загрузка...</a>');
		}
	});
	$('body').on('click','#sort_by_alphabet',function(){
		var ths = $(this);
		if(ths.attr('class')!='active'){
			$('#sort_type').remove();
			$('form.ajax').append('<input type="hidden" name="sort_by" id="sort_type" value="alphabet" />');
			$('form.ajax').submit();
			ths.replaceWith('<a style="text-decoration: none;color:#fff;" href="javascript:void(0)">Загрузка...</a>');
		}
	});
	
	$(".inpfiles").live('change', function () {
		var inpattachment = $(this).parents('.inpattachment');
		if (! $(this).attr("max") || $(this).parents('form').find('input[name="' + $(this).attr("name") + '"], .attachment[name="' + $(this).attr("name") + '"]').length < $(this).attr("max")) {
			var clone = $(this).parents('form').find('input[name="hide_' + $(this).attr("name") + '"]').parents('.inpattachment');
			clone.before(clone.clone(true));
			clone.prev('.inpattachment').show().find('input').val('').attr("name", $(this).attr("name"));
		}
		if(! inpattachment.find(".inpattachment_delete").length)
		{
			inpattachment.append(' <a href="#" class="inpattachment_delete">x</a>');
		}
	});

	$(".inpattachment_delete").live('click', function () {
		var inpattachment = $(this).parents('.inpattachment');
		var input = inpattachment.find('.inpfiles');
		var last_input = input.parents('form').find('input[name="' + input.attr("name") + '"]').last();
		if (last_input.val()) {
			var clone = $(this).parents('form').find('input[name="hide_' + input.attr("name") + '"]').parents('.inpattachment');
			clone.before(clone.clone(true));
			clone.prev('.inpattachment').show().find('input').val('').attr("name", input.attr("name"));
		}
		inpattachment.remove();
		return false;
	});

	$(".attachment_delete").live('click', function(){
		var attachment = $(this).parents('.attachment');
		attachment.find("input[name='hide_attachment_delete[]']").attr("name", "attachment_delete[]");
		attachment.hide().removeClass('attachment');

		var last_input = attachment.parents('form').find('input[name="' + attachment.attr("name") + '"]').last();
		if(! last_input.length || last_input.val())
		{
			var clone = $(this).parents('form').find("input[name='hide_" + attachment.attr("name") + "']").parents('.inpattachment');
			clone.before(clone.clone(true));
			clone.prev('.inpattachment').show();
			clone.prev('.inpattachment').find('input').val('').attr("name", attachment.attr("name"));
		}
		return false;
	});

	$(".image_delete").live('click', function(){
		var image = $(this).parents('.image');
		image.find("input[name='hide_image_delete[]']").attr("name", "image_delete[]");
		image.hide().removeClass('image');
		return false;
	});

	$(".timecalendar").each(function () {
		var st = $(this).attr('showtime');

		if (st && st.match(/true/i)) {
			$(this).datetimepicker({
				dateFormat:'dd.mm.yy',
				timeFormat:'hh:mm'
			});
		}
		else {
			$(this).datepicker({
				dateFormat:'dd.mm.yy'
			});
		}
	});

	$("select[name=depend]").change(function () {
		var price_id = $(this).find('option:selected').attr('rel');
		$(this).parents('form').find('.shop-price-depend').hide();
		$(this).parents('form').find('.price_id' + price_id).show();
	});

	$('.inpnum').live('keydown', function (evt) {
		evt = (evt) ? evt : ((window.event) ? event : null);

		if (evt) {
			var elem = (evt.target)
				? evt.target
				: (
				evt.srcElement
					? evt.srcElement
					: null
				);

			if (elem) {
				var charCode = evt.charCode
					? evt.charCode
					: (evt.which
					? evt.which
					: evt.keyCode
					);

				if ((charCode < 32 ) ||
					(charCode > 44 && charCode < 47) ||
					(charCode > 95 && charCode < 106) ||
					(charCode > 47 && charCode < 58) || charCode == 188 || charCode == 191 || charCode == 190 || charCode == 110) {
					return true;
				}
				else {
					return false;
				}
			}
		}
	});
	$('.captcha_update').live('click', function () {
		$(this).parents("form").find("input[name=update]").val("1");
		$(this).parents("form").submit();
	});
	$('a[rel=large_image]').live('click', function () {
		var self = $(this);
		window.open(self.attr("href"), '', 'toolbar=no,location=no,status=no,menubar=no,scrollbars=yes,resizable=yes,width=' + (self.attr("width") * 1 + 40) + ',height=' + (self.attr("height") * 1 + 40));
		return false;
	});
	$('.menu_right_bg_box_1_zakl_1_span2>span').click(function(){
		var parent = $(this).parent();
		var input = parent.find('input').trigger('click');
	});
});

function prepare(string) {
	string = str_replace('&lt;', '<', string);
	string = str_replace('&gt;', '>', string);
	string = str_replace('&amp;', '&', string);
	return string;
}

function str_replace(search, replace, subject, count) {
	f = [].concat(search),
		r = [].concat(replace),
		s = subject,
		ra = r instanceof Array, sa = s instanceof Array;
	s = [].concat(s);
	if (count) {
		this.window[count] = 0;
	}
	for (i = 0, sl = s.length; i < sl; i++) {
		if (s[i] === '') {
			continue;
		}
		for (j = 0, fl = f.length; j < fl; j++) {
			temp = s[i] + '';
			repl = ra ? (r[j] !== undefined ? r[j] : '') : r[0];
			s[i] = (temp).split(f[j]).join(repl);
			if (count && s[i] !== temp) {
				this.window[count] += (temp.length - s[i].length) / f[j].length;
			}
		}
	}
	return sa ? s : s[0];
}

function add2Fav(a) {
	title = document.title;
	url = document.location;
	try {
		// Internet Explorer
		window.external.AddFavorite(url, title);
	}
	catch (e) {
		try {
			// Mozilla
			window.sidebar.addPanel(title, url, "");
		}
		catch (e) {
			// Opera
			if (typeof(opera) == "object") {
				a.rel = "sidebar";
				a.title = title;
				a.url = url;
				return true;
			}
			else {
				// Unknown
				alert('Нажмите Ctrl-D чтобы добавить страницу в закладки');
			}
		}
	}
	return false;
}

function getCookie(name) {
  var matches = document.cookie.match(new RegExp(
    "(?:^|; )" + name.replace(/([\.$?*|{}\(\)\[\]\\\/\+^])/g, '\\$1') + "=([^;]*)"
  ));
  return matches ? decodeURIComponent(matches[1]) : undefined;
}

function setCookie(name, value, options) {
  options = options || {};
 
  var expires = options.expires;
 
  if (typeof expires == "number" && expires) {
    var d = new Date();
    d.setTime(d.getTime() + expires*1000);
    expires = options.expires = d;
  }
  if (expires && expires.toUTCString) {
    options.expires = expires.toUTCString();
  }
 
  value = encodeURIComponent(value);
 
  var updatedCookie = name + "=" + value;
 
  for(var propName in options) {
    updatedCookie += "; " + propName;
    var propValue = options[propName];   
    if (propValue !== true) {
      updatedCookie += "=" + propValue;
     }
  }
 
  document.cookie = updatedCookie;
  
}

function input_check(data,type){
	if(type == "м2"){
		data = data.replace(/[^0-9\.\,]/g,"");
		data = data.replace(',', '.');
		if(data.indexOf('.') == 0){
			data = data.substr(1, data.length);
		}
		var point_position = data.indexOf('.');
		var first_num_block = data.substr(0, point_position+1);
		var sec_num_block = data.substr(point_position+1, data.length - (point_position+1)).replace(/\D+/g,"");
		return first_num_block+sec_num_block;
	}else{
		return Number(data.replace(/\D+/g,""));
	}
}