$(document).ready(function() {
	/* filter */
				   
 		 $( '#filterpro_box .box-heading' ).on('click',function() {
		setTimeout(function(){	 
		 $( '#filterpro_box .box-heading').addClass('open');
		 $( '.box-content.filterpro' ).toggle( 'fast'), 1000})
  	 
	});

	
	/* Search */
	
	$('.search-form .close').click(
function(event){
	
	$('.search-form').show().addClass('animated flipOutX');
	setTimeout(function(){
		$('.search-form').hide().removeClass('animated flipOutX');
		$('.search-form input:text').val('');
	},1000);
	event.preventDefault();
});


$('#search2 .button-search-view').click(function(event){
$('.search-form').show().addClass('animated flipInX');
setTimeout(function(){$('.search-form input:text').focus();
});
event.preventDefault();
});
	$('#search2 .button-search').bind('click', function() {
		url = $('base').attr('href') + 'index.php?route=product/search';
				 
		var search = $('#search input[name=\'filter_name\']').attr('value');
		
		if (search) {
			url += '&filter_name=' + encodeURIComponent(search);
		}
		
		location = url;
	});
	
	$(' #search2 input[name=\'filter_name\']').bind('keydown', function(e) {
		if (e.keyCode == 13) {
			url = $('base').attr('href') + 'index.php?route=product/search';
			 
			var search = $('#search input[name=\'filter_name\']').attr('value');
			
			if (search) {
				url += '&filter_name=' + encodeURIComponent(search);
			}
			
			location = url;
		}
	});
	
	
	
	$('#header .button-search').bind('click', function() {
		url = $('base').attr('href') + 'index.php?route=product/search';
				 
		var filter_name = $('input[name=\'filter_name\']').attr('value');
		
		if (filter_name) {
			url += '&filter_name=' + encodeURIComponent(filter_name);
		}
		
		location = url;
	});
	
	$('#header input[name=\'filter_name\']').bind('keydown', function(e) {
		if (e.keyCode == 13) {
			url = $('base').attr('href') + 'index.php?route=product/search';
			 
			var filter_name = $('input[name=\'filter_name\']').attr('value');
			
			if (filter_name) {
				url += '&filter_name=' + encodeURIComponent(filter_name);
			}
			
			location = url;
		}
	});
	
		/**/
	$('#menu .navbar-toggle').on('click', function () {
      	 $( '#menu ul' ).toggle( 'fast')
  		 $( '#menu ul' ).addClass('fast')
		 $(this).toggleClass('open')
		 console.log('ssss');
					
		});
	
		$('#menu .menu.parent > a').on('click', function (e) {
      	  	 /*e.preventDefault();
		
		 $('#menu .menu.parent div.fast').hide( 'fast')
		$('#menu .parent div.fast').removeClass('open')*/
	
		/*child*/
		
		if ($(this).hasClass("open") ) {
		$(this).next('div').hide( 'fast')
		$(this).removeClass('open')
		 }
		 else
		 {
		 $(this).next('div').toggle( 'fast')
  		 $(this).next('div').addClass('fast')
		$('#menu .menu.parent > a').removeClass('open')
		 $(this).toggleClass('open')	
		}
			});
	/* Ajax Cart */
	$('#cart > .heading a').live('click', function() {
		$('#cart').addClass('active');
		
		$('#cart').load('index.php?route=module/cart #cart > *');
		
		$('#cart').live('mouseleave', function() {
			$(this).removeClass('active');
		});
	});
	/* Mega Menu */
	$('#menu ul > li > a + div').each(function(index, element) {
		// IE6 & IE7 Fixes
		if ($.browser.msie && ($.browser.version == 7 || $.browser.version == 6)) {
			var category = $(element).find('a');
			var columns = $(element).find('ul').length;
			
			$(element).css('width', (columns * 143) + 'px');
			$(element).find('ul').css('float', 'left');
		}		
		
		var menu = $('#menu').offset();
		var dropdown = $(this).parent().offset();
		
		i = (dropdown.left + $(this).outerWidth()) - (menu.left + $('#menu').outerWidth());
		
		if (i > 0) {
			$(this).css('margin-left', '-' + (i + 5) + 'px');
		}
	});

	// IE6 & IE7 Fixes
	if ($.browser.msie) {
		if ($.browser.version <= 6) {
			$('#column-left + #column-right + #content, #column-left + #content').css('margin-left', '195px');
			
			$('#column-right + #content').css('margin-right', '195px');
		
			$('.box-category ul li a.active + ul').css('display', 'block');	
		}
		
		if ($.browser.version <= 7) {
			$('#menu > ul > li').bind('mouseover', function() {
				$(this).addClass('active');
			});
				
			$('#menu > ul > li').bind('mouseout', function() {
				$(this).removeClass('active');
			});	
		}
	}
	
	$('.success img, .warning img, .attention img, .information img').live('click', function() {
		$(this).parent().fadeOut('slow', function() {
			$(this).remove();
		});
	});	
});

function getURLVar(urlVarName) {
	var urlHalves = String(document.location).toLowerCase().split('?');
	var urlVarValue = '';
	
	if (urlHalves[1]) {
		var urlVars = urlHalves[1].split('&');

		for (var i = 0; i <= (urlVars.length); i++) {
			if (urlVars[i]) {
				var urlVarPair = urlVars[i].split('=');
				
				if (urlVarPair[0] && urlVarPair[0] == urlVarName.toLowerCase()) {
					urlVarValue = urlVarPair[1];
				}
			}
		}
	}
	
	return urlVarValue;
} 

function addToCart(product_id, quantity) {
	quantity = typeof(quantity) != 'undefined' ? quantity : 1;

	$.ajax({
		url: 'index.php?route=checkout/cart/add',
		type: 'post',
		data: 'product_id=' + product_id + '&quantity=' + quantity,
		dataType: 'json',
		success: function(json) {
			$('.success, .warning, .attention, .information, .error').remove();
			
			if (json['redirect']) {
				location = json['redirect'];
			}
			
			if (json['success']) {
				html = '';
				MainImg = $('input[onclick="addToCart(\'' + product_id + '\');"]').parents().find('.image a img');
				AltImg = $('input[onclick="addToCart(\'' + product_id + '\');"]').parent().eq(2).find('.left .image a img');
				if(MainImg.length) {
					html += '<div class="cart-box-img"><img class="img" src="' + MainImg.attr('src') + '" /></div>';
				} else if(AltImg.length) {
					html += '<div class="cart-box-img"><img class="img" src="' + AltImg.attr('src') + '" /></div>';
				} else {
					html += '<div class="cart-box-img"><img class="img" src="image/no_image1.jpg" title="Image Unavailable" alt="Image Unavailable" /></div>';
				}
				html += '<div class="cart-box-succ-img"><img src="catalog/view/theme/default/image/success1.png"></div>';
				html +=	'<div class="cart-box-succ-det">' + json['success'] + '</div>';
				html += '<div id="cart-box-list"></div>' + '<div id="cart-box-total"></div>';
				html +=	'<div class="popup-buttons"><div class="left"><a href="index.php?route=checkout/simplecheckout" class="button"><span>Корзина</span></a></div><div class="center"><a alt="Close &amp; Continue" onclick="closeCart();" title="Close &amp; Continue" class="button"><span>Продолжить</span></a></div><div class="right"><a href="index.php?route=checkout/simplecheckout" class="button"><span>Оформить</span></a></div></div>';
				$('#cart-success').html('<div class="cart-conf-popup" style="display:none;">' + html + '</div>');
				$('#cart-box-list').load('index.php?route=module/cart .mini-cart-info > *');
				$('#cart-box-total').load('index.php?route=module/cart .mini-cart-total > *');
				var opaclayerHeight = $(document).height();
				var opaclayerWidth = $(window).width();
				$('#opaclayer').css('height', opaclayerHeight);
				var winH = $(window).height();
				var winW = $(window).width();
				$('.cart-conf-popup').css('top',  winH/2-$('.cart-conf-popup').height()/2);
				$('.cart-conf-popup').css('left', winW/2-$('.cart-conf-popup').width()/2);				
				$('#opaclayer').fadeTo(500,0.8);
				$('.cart-conf-popup').fadeIn(500);				
				$('#cart-total').html(json['total']);
		}
		}
	});
}

function closeCart() {
	$('#opaclayer').fadeOut(500, function() {
		$('#opaclayer').hide().css('opacity','1');
	});
	$('.cart-conf-popup').fadeOut(500, function() {
		$('.cart-conf-popup').remove();
	});
}
function addToWishList(product_id) {
	$.ajax({
		url: 'index.php?route=account/wishlist/add',
		type: 'post',
		data: 'product_id=' + product_id,
		dataType: 'json',
		success: function(json) {
			$('.success, .warning, .attention, .information').remove();
						
			if (json['success']) {
				$('#cart-success').html('<div class="compwish-success" style="display: none;"><div class="compwish-success-details">' + json['success'] + '</div></div>');

				$('.compwish-success').fadeIn(1000).delay(3000).fadeOut(1500);				

				$('#wishlist-total').html(json['total']);
			}	
		}
	});
}

function addToCompare(product_id) { 
	$.ajax({
		url: 'index.php?route=product/compare/add',
		type: 'post',
		data: 'product_id=' + product_id,
		dataType: 'json',
		success: function(json) {
			$('.success, .warning, .attention, .information').remove();
						
			if (json['success']) {
				$('#cart-success').html('<div class="compwish-success" style="display: none;"><div class="compwish-success-details">' + json['success'] + '</div></div>');
				
				$('.compwish-success').fadeIn(1000).delay(3000).fadeOut(1500);				
				
				$('#compare-total').html(json['total']);
			}	
		}
	});
}