jQuery(document).ready(function(){
    var slider = $('#flex1');
    $('#slider').html(slider);
});

(function($){
	$(window).load(function(){
		/* Page Scroll to id fn call */
			$("#navigation-menu a,a[href='#top'],a[rel='m_PageScroll2id']").mPageScroll2id({
				layout:"horizontal",
				highlightSelector:"#navigation-menu a"
			});
		/* demo functions */
			$("a[rel='next']").click(function(e){
				e.preventDefault();
				var to=$(this).parent().parent("section").next().attr("id");
				$.mPageScroll2id("scrollTo",to);
			});

/*
 *------------------------------------------------------------------------------
 * @script        Navigation for Site
 *------------------------------------------------------------------------------
 * @copyright     Copyright (C) 2014 Techno-mir.net. All Rights Reserved.
 * @author        Denius [deniuscoder@mail.ru]
 * @link:         http://vk.com/diordanov 
 *------------------------------------------------------------------------------
 */

 
/*  Plugin Hidden Logo  */
 	$(window).scroll(function() {
    	if ($(this).scrollTop() > 25) {
       	$('#logo').fadeOut(100);
    	}
    	if ($(this).scrollTop() < 25) {
        	$('#logo').fadeIn(300);
    	}
});
  
/*  Start Automatisation  */
jQuery('#grid1').toggle(
    function(){ 
        jQuery('#section-2 div.moduletable').animate({'height':'100px'}, 300, function(){ 
            jQuery('.hide').fadeIn(300); 
            jQuery(this).addClass('mini');
        }); 
        
    }, function(){ 
        jQuery('.hide').fadeOut(300, function(){  
        jQuery('#section-2 div.moduletable').animate({'height':'350px'}, 300).removeClass('mini'); 
       });
    });  

jQuery('#roz').click(function(){ 
    switch (jQuery('#roz').hasClass('hover')) {
        case (true):
        jQuery(this).removeClass('hover');
        jQuery('.hide2').fadeOut(300, function(){ 
        jQuery('.span6').animate({'height':'230px'}, 300).removeClass('mini');
        jQuery('.span6 img').show();            });
        jQuery('.hide3').hide(300);
        break;
        
        case (false):
        jQuery(this).addClass('hover');
        jQuery('.span6').addClass('mini');
        jQuery('.span6 img').hide();
        jQuery('#opt').removeClass('hover');
        jQuery('.hide3').hide(300);
        jQuery('.hide2').show(300);
        break;
    }
});

jQuery('#opt').click(function(){ 
    switch (jQuery("#opt").hasClass("hover")) {
        case (true):
        jQuery(this).removeClass('hover');
        jQuery('.hide3').fadeOut(300, function(){ 
        jQuery('.span6').animate({'height':'230px'}, 300).removeClass('mini');
        jQuery('.span6 img').show();            });
        jQuery('.hide2').hide(300);
        break;
        
        case (false):
        jQuery(this).addClass('hover');
        jQuery('.span6').addClass('mini');
        jQuery('.span6 img').hide();
        jQuery('#roz').removeClass('hover');
        jQuery('.hide2').hide(300);
        jQuery('.hide3').show(300);
    
        break;
    }
    
});

/*  Start Web Studio  */
jQuery('#grid5').click(function(){ 
    switch (jQuery("#section-3 div.moduletable").hasClass("mini2")) 
    {
        case (true):
            jQuery('.hide4').fadeOut(300, function(){  
            jQuery('#section-3 div.moduletable').animate({'height':'350px'}, 300).removeClass('mini2'); 
        });      
        break;
        
        case (false):
            jQuery('.hide5').hide(300);
            jQuery('#section-3 div.moduletable').removeClass('mini3');
            jQuery('#section-3 div.moduletable').animate({'height':'100px'}, 300, function(){ 
            jQuery('.hide4').show(300); 
            jQuery(this).addClass('mini2');
        }); 
        break;
    }
});

jQuery('#grid6').click(function(){ 
    switch (jQuery("#section-3 div.moduletable").hasClass("mini3")) 
    {
        case (true):
            jQuery('.hide5').fadeOut(300, function(){  
            jQuery('#section-3 div.moduletable').animate({'height':'350px'}, 300).removeClass('mini3'); 
        });      
        break;
        
        case (false):
            jQuery('.hide4').hide(300);
            jQuery('#section-3 div.moduletable').removeClass('mini2');
            jQuery('#section-3 div.moduletable').animate({'height':'100px'}, 300, function(){ 
            jQuery('.hide5').show(300); 
            jQuery(this).addClass('mini3');
        }); 
        break;
    }
});


/*  End script  */



/*  Start IT-maintenance  */
jQuery('#grid5_section4').click(function(){ 
    switch (jQuery("#section-4 div.moduletable").hasClass("mini2")) 
    {
        case (true):
            jQuery('.hide4_section4').fadeOut(300, function(){  
            jQuery('#section-4 div.moduletable').animate({'height':'350px'}, 300).removeClass('mini2'); 
        });      
        break;
        
        case (false):
            jQuery('.hide5_section4').hide(300);
            jQuery('#section-4 div.moduletable').removeClass('mini3');
            jQuery('#section-4 div.moduletable').animate({'height':'100px'}, 300, function(){ 
            jQuery('.hide4_section4').show(300); 
            jQuery(this).addClass('mini2');
        }); 
        break;
    }
});

jQuery('#grid6_section4').click(function(){ 
    switch (jQuery("#section-4 div.moduletable").hasClass("mini3")) 
    {
        case (true):
            jQuery('.hide5_section4').fadeOut(300, function(){  
            jQuery('#section-4 div.moduletable').animate({'height':'350px'}, 300).removeClass('mini3'); 
        });      
        break;
        
        case (false):
            jQuery('.hide4_section4').hide(300);
            jQuery('#section-4 div.moduletable').removeClass('mini2');
            jQuery('#section-4 div.moduletable').animate({'height':'100px'}, 300, function(){ 
            jQuery('.hide5_section4').show(300); 
            jQuery(this).addClass('mini3');
        }); 
        break;
    }
});


/*  End script  */
				
}); })(jQuery);



