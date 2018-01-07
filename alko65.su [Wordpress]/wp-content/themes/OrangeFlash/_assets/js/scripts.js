var $j = jQuery.noConflict();

$j('document').ready(function() {

	// SLIDING DROPDOWNS
			
	$j("#nav ul li").each(function() {	
		
		var $sublist = $j(this).find('ul:first');
		
		$j(this).hover(function() {	
			$j(this).addClass('hover');
			$sublist.stop().css( {height:"auto", overflow:"hidden", display:"none"} ).slideDown(400, function() {
				$j(this).css( {height:"auto", overflow:"visible"} );
			});	
		},
		function() {	
			$j(this).removeClass('hover');
			$sublist.stop().slideUp(400, function()	{	
				$j(this).css( {display:"none", overflow:"hidden"} );
			});
		});	
	});

	// CUFON - FONT REPLACEMENT
	
	Cufon.replace('h1', {
		textShadow: 'rgba(255,255,255,1) 0px 1px 0px'
	});
	
	
	// CSS ENCHACEMENTS 
	
	$j('#main .latest .post:odd').after('<br class="clear" />');
	$j('#main .next ol li:odd').after('<br class="clear" />');
	$j('ul li div.comment').after('<br class="clear" />');
	
	
	// TABS WIDGET 
	
	$j(function() {
		var contentWrapper = $j('#sidebar .tabs .wrap .tab');
		// only show the first item, hide the rest
		contentWrapper.hide().filter(':first').show();
		
		$j('.tabs ul.tabs-nav li a').click(function () {
		
		    // check if this item doesn't have class "current"
		    // if it has class "current" it must not execute the script again
		    if (this.className.indexOf('current') == -1){
		    	contentWrapper.hide();
		    	contentWrapper.filter(this.hash).fadeIn();
		    	$j('.tabs ul.tabs-nav li a').removeClass('current');
		    	$j(this).addClass('current');
		    }
		    return false;
		});
	});
	
	
	// SLIDER (by CSS-Tricks http://css-tricks.com/examples/FeaturedContentSlider/ )
	
	$j("#featwrap").fadeIn('fast');
		
	$j(function(){
	    
	    $j("#main-photo-slider").codaSlider();
	    
	    $navthumb = $j(".nav-thumb");
	    $crosslink = $j(".cross-link");
	    
	    $navthumb
	    .click(function() {
	    	var $this = $j(this);
	    	theInterval($this.parent().attr('href').slice(1) - 1);
	    	return false;
	    });
	    
	    theInterval();
	});	
	
	
		
});
