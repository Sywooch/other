/**
 * @file
 * A JavaScript file for the theme.
 *
 * In order for this JavaScript to be loaded on pages, see the instructions in
 * the README.txt next to this file.
 */

// JavaScript should be made compatible with libraries other than jQuery by
// wrapping it with an "anonymous closure". See:
// - http://drupal.org/node/1446420
// - http://www.adequatelygood.com/2010/3/JavaScript-Module-Pattern-In-Depth
(function ($, Drupal, window, document, undefined) {

  Drupal.behaviors.rgo = {
    attach: function (context, settings) {
		// Create text-shadow for IE (styles have to be already created with appropriate mixin)
		if (typeof(Modernizr) != 'undefined' && !Modernizr.textshadow) {
			$('#block-block-3 a').textshadow({useStyle: false});
			$('#block-user-login a').textshadow({useStyle: false});
		}
		

// Popup
/*
		if ($.cookie('zaglushka1') || $('html').attr('lang') == 'en') {
		    // empty
		} else {
		    $('#zaglushka').show();
		    $('#fade').show();
		}
		
		$('#zaglushka a.close').click(function(){
 $.cookie('zaglushka1', true);
 $('#zaglushka').hide();
 $('#fade').hide();
 });
*/
		// Accordion enable
		$(".accordion").accordion({ active: false, collapsible: true, heightStyle: "content" });

		// Frontpage switch news
/*
		$('#news-switch-main').click(function(){
			$('.news-switch').removeClass('active');
			$(this).addClass('active');
			$('.view-news-main > .view-content').show();
//			$('.view-news-main > .attachment').hide();
			$('.view-news-main > .attachment').css('position', 'absolute');		// We need it 'cause jCarousel can't be rendered in hidden block
		});
		$('#news-switch-region').click(function(){
			$('.news-switch').removeClass('active');
			$(this).addClass('active');
//			$('.view-news-main > .attachment').show();
			$('.view-news-main > .attachment').css('position', 'static');	// We need it 'cause jCarousel can't be rendered in hidden block
			$('.view-news-main > .view-content').hide();
		});
*/

			// Text block show/hide
			$('.field-name-body em.hide, .taxonomy-term-description em.hide').each(function(){
				$(this).data('content', $(this).text()).html('<u>показать</u>');
			}).click(function(){
				$(this).text($(this).data('content'));
			})
		
		
			// Article votes popup show
			$('.view-articles .views-field-php-2 a.poll_vote_button').click(function(){
				$(this).siblings('.poll_vote_popup').fadeToggle();				
				return false;
			});
    }
  };

})(jQuery, Drupal, this, this.document);
