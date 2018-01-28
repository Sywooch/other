"use strict";
var $portfolio;
var $masonry_block;
var $portfolio_selectors;
var $blog;

var isMobile = false;
var isiPhoneiPad = false;

if (/Android|webOS|iPhone|iPad|iPod|BlackBerry|IEMobile|Opera Mini/i.test(navigator.userAgent)) {
    isMobile = true;
}
if (/iPhone|iPad|iPod/i.test(navigator.userAgent)) {
    isiPhoneiPad = true;
}
/* For remove conflict */
$ = jQuery.noConflict();
$(document).ready(function () {

    HamburderMenuCustomScroll();    
    $(document).on("scroll", OnePageActiveOnScroll);

    /*==============================================================*/
    //Placeholder For IE - START CODE
    /*==============================================================*/

    jQuery('input, textarea').placeholder({customClass:'my-placeholder'});
    
    /*==============================================================*/
    //Placeholder For IE - START CODE
    /*==============================================================*/
    
    /*==============================================================*/
    //Smooth Scroll - START CODE
    /*==============================================================*/
    jQuery('.inner-top').smoothScroll({
        speed: 900,
        offset: -68
    });
    /*==============================================================*/
    //Smooth Scroll - END CODE
    /*==============================================================*/

    /*==============================================================*/
    //Set Resize Header Menu - START CODE
    /*==============================================================*/
    SetResizeHeaderMenu();
    /*==============================================================*/
    //Set Resize Header Menu - END CODE
    /*==============================================================*/

    /*==============================================================*/
    //Ipad And Mobile Icon Hover - START CODE
    /*==============================================================*/
    IpadMobileHover();
    /*==============================================================*/
    //Ipad And Mobile Icon Hover - END CODE
    /*==============================================================*/

    /*==============================================================*/
    //For shopping cart- START CODE
    /*==============================================================*/
    
    if (!isMobile) {
        jQuery(".top-cart a.shopping-cart, .cart-content").hover(function () {
            jQuery(".cart-content").css('opacity', '1');
            jQuery(".cart-content").css('visibility', 'visible');
        }, function () {
            jQuery(".cart-content").css('opacity', '0');
            jQuery(".cart-content").css('visibility', 'hidden');
        });

        jQuery(document).on({
            mouseenter: function() {
                jQuery(".cart-content").css('opacity', '1');
                jQuery(".cart-content").css('visibility', 'visible');
            },
            mouseleave: function() {
                jQuery(".cart-content").css('opacity', '0');
                jQuery(".cart-content").css('visibility', 'hidden');
            }
        }, ".top-cart a.shopping-cart, .cart-content");

    }
    if (isiPhoneiPad) {
        jQuery(".video-wrapper").css('display', 'none');
    }

    jQuery(".top-cart a.shopping-cart").click(function () {
        if(!isMobile){
            var carturl = $(this).attr('href');
            window.location = carturl;
        }
        if ($('.cart-content').css('visibility') == 'visible') {
            jQuery(".cart-content").css('opacity', '0');
            jQuery(".cart-content").css('visibility', 'hidden');
        }
        else {
            jQuery(".cart-content").css('opacity', '1');
            jQuery(".cart-content").css('visibility', 'visible');

        }
    });

    /*==============================================================*/
    //Shrink nav on scroll - START CODE
    /*==============================================================*/

    if( !$( 'nav.navigation-menu, nav.navbar' ).hasClass( 'no-shrink-nav' ) ) {
        if ($(window).scrollTop() > 10) {
            $('nav.navigation-menu, nav.navbar').addClass('shrink-nav');
        } else {
            $('nav.navigation-menu, nav.navbar').removeClass('shrink-nav');
        }
    }
    /*==============================================================*/
    //Shrink nav on scroll - END CODE
    /*==============================================================*/


    /*==============================================================*/
    //Portfolio - START CODE
    /*==============================================================*/
    if (Modernizr.touch) {
        // show the close overlay button
        $(".close-overlay").removeClass("hidden");
        // handle the adding of hover class when clicked
        $(".porfilio-item").click(function (e) {
            if (!$(this).hasClass("hover")) {
                $(this).addClass("hover");
            }
        });
        // handle the closing of the overlay
        $(".close-overlay").click(function (e) {
            e.preventDefault();
            e.stopPropagation();
            if ($(this).closest(".porfilio-item").hasClass("hover")) {
                $(this).closest(".porfilio-item").removeClass("hover");
            }
        });
    } else {
        // handle the mouseenter functionality
        $(".porfilio-item").mouseenter(function () {
            $(this).addClass("hover");
        })
        // handle the mouseleave functionality
        .mouseleave(function () {
            $(this).removeClass("hover");
        });
    }

    // use for portfolio sotring with masonry

    $portfolio = $('.masonry-items');
    var portfolio_selector = $portfolio.parents( 'section' ).find('.portfolio-filter li.nav.active a').attr('data-filter');
    
    $portfolio.imagesLoaded(function () {
        $portfolio.isotope({
            itemSelector: 'li',
            layoutMode: 'masonry',
            filter: portfolio_selector
        });
    });

    // use for simple masonry ( for example /home-photography page )

    $masonry_block = $('.masonry-block-items');
    $masonry_block.imagesLoaded(function () {
        $masonry_block.isotope({
            itemSelector: 'li',
            layoutMode: 'masonry'
        });
    });

    $portfolio_selectors = $('.portfolio-filter > li > a');
    $portfolio_selectors.on('click', function () {
        $portfolio_selectors.parent().removeClass('active');
        $(this).parent().addClass('active');
        var selector = $(this).attr('data-filter');
        $portfolio.isotope({filter: selector});
        return false;
    });
    $blog = $('.blog-masonry');
    $blog.imagesLoaded(function () {

        //ISOTOPE FUNCTION - FILTER PORTFOLIO FUNCTION
        $blog.isotope({
            itemSelector: '.blog-listing',
            layoutMode: 'masonry'
        });
    });
    $(window).resize(function () {
        setTimeout(function () {
            $portfolio.isotope('layout');
            $blog.isotope('layout');
            $masonry_block.isotope('layout');
        }, 500);
    });
    /*==============================================================*/
    //Portfolio - END CODE
    /*==============================================================*/

    /*==============================================================*/
    //Set Parallax - START CODE
    /*==============================================================*/
    SetParallax();
    /*==============================================================*/
    //Set Parallax - END CODE
    /*==============================================================*/

    /*==============================================================*/
    //Sliders owlCarousel - START CODE
    /*==============================================================*/

    // jQuery use in Post slide loop
    $(".blog-gallery").owlCarousel({
        navigation: true, // Show next and prev buttons
        slideSpeed: 300,
        paginationSpeed: 400,
        singleItem: true,
        navigationText: ["<i class='fa fa-angle-left'></i>", "<i class='fa fa-angle-right'></i>"]
    });
    // jQuery use in hcode_feature_product_shop in Shop top five shortcode
    $("#owl-demo-small").owlCarousel({
        navigation: true, // Show next and prev buttons
        slideSpeed: 300,
        paginationSpeed: 400,
        singleItem: true,
        navigationText: ["<i class='fa fa-angle-left'></i>", "<i class='fa fa-angle-right'></i>"]
    });

    /*==============================================================*/
    //Sliders owlCarousel - END CODE
    /*==============================================================*/

    /*==============================================================*/
    //Stop Closing magnificPopup on selected elements - START CODE
    /*==============================================================*/

    $(".owl-pagination > .owl-page").click(function (e) {
        if ($(e.target).is('.mfp-close'))
            return;
        return false;
    });
    $(".owl-buttons > .owl-prev").click(function (e) {
        if ($(e.target).is('.mfp-close'))
            return;
        return false;
    });
    $(".owl-buttons > .owl-next").click(function (e) {
        if ($(e.target).is('.mfp-close'))
            return;
        return false;
    });
    /*==============================================================*/
    //Stop Closing magnificPopup on selected elements - END CODE
    /*==============================================================*/

    /*==============================================================*/
    // Woocommerce Product Thumbnail Slider - START CODE
    /*==============================================================*/

    
        var sync1 = $(".hcode-single-big-product-thumbnail-carousel");
        var sync2 = $(".hcode-single-product-thumbnail-carousel");

        sync1.owlCarousel({
        singleItem : true,
        slideSpeed : 1000,
        navigation: true,
        pagination:false,
        navigationText: ["<i class='fa fa-angle-left'></i>", "<i class='fa fa-angle-right'></i>"],
        afterAction : syncPosition,
        responsiveRefreshRate : 200,
        });

        sync2.owlCarousel({
        items : 3,
        itemsDesktop      : [1199,3],
        itemsDesktopSmall     : [979,3],
        itemsTablet       : [768,3],
        itemsMobile       : [479,2],
        pagination:false,
        navigation: true,
        navigationText: ["<i class='fa fa-angle-left'></i>", "<i class='fa fa-angle-right'></i>"],
        responsiveRefreshRate : 100,
        afterInit : function(el){
          el.find(".owl-item").eq(0).addClass("active");
        }
        });

        function syncPosition(el){
        var current = this.currentItem;
        $(".hcode-single-product-thumbnail-carousel")
          .find(".owl-item")
          .removeClass("active")
          .eq(current)
          .addClass("active");
        if($(".hcode-single-product-thumbnail-carousel").data("owlCarousel") !== undefined){
          center(current)
        }
        }

        $(".hcode-single-product-thumbnail-carousel").on("click", ".owl-item", function(e){
        e.preventDefault();
        var number = $(this).data("owlItem");
        sync1.trigger("owl.goTo",number);
        });

        function center(number){
        var sync2visible = sync2.data("owlCarousel").owl.visibleItems;
        var num = number;
        var found = false;
        for(var i in sync2visible){
          if(num === sync2visible[i]){
            var found = true;
          }
        }

        if(found===false){
          if(num>sync2visible[sync2visible.length-1]){
            sync2.trigger("owl.goTo", num - sync2visible.length+2)
          }else{
            if(num - 1 === -1){
              num = 0;
            }
            sync2.trigger("owl.goTo", num);
          }
        } else if(num === sync2visible[sync2visible.length-1]){
          sync2.trigger("owl.goTo", sync2visible[1])
        } else if(num === sync2visible[0]){
          sync2.trigger("owl.goTo", num-1)
        }

        }

    /*==============================================================*/
    // Woocommerce Product Thumbnail Slider - End CODE
    /*==============================================================*/
    
    /*==============================================================*/
    // Add "intro-page" Class in Intro Pages  - START CODE
    /*==============================================================*/

    if(jQuery('section').hasClass('intro-page')){
        $('section').removeClass('intro-page');
        $('body').addClass('intro-page');
    }
    /*==============================================================*/
    // Add "intro-page" Class in Intro Pages  - End CODE
    /*==============================================================*/

    /*==============================================================*/
    //WOW Animation  - START CODE
    /*==============================================================*/

    var wow = new WOW({
        boxClass: 'wow',
        animateClass: 'animated',
        offset: 90,
        mobile: false,
        live: true
    });
    wow.init();
    /*==============================================================*/
    //WOW Animation  - END CODE
    /*==============================================================*/

    /*==============================================================*/
    //accordion  - START CODE
    /*==============================================================*/

    $('.collapse').on('show.bs.collapse', function () {
        var id = $(this).attr('id');
        $('a[href="#' + id + '"]').closest('.panel-heading').addClass('active-accordion');
        $('a[href="#' + id + '"] .panel-title span').html('<i class="fa fa-minus"></i>');
    });
    $('.collapse').on('hide.bs.collapse', function () {
        var id = $(this).attr('id');
        $('a[href="#' + id + '"]').closest('.panel-heading').removeClass('active-accordion');
        $('a[href="#' + id + '"] .panel-title span').html('<i class="fa fa-plus"></i>');
    });
    $('.nav.navbar-nav a.inner-link').click(function () {
        $(this).parents('ul.navbar-nav').find('a.inner-link').removeClass('active');
        $(this).addClass('active');
        if ($('.navbar-header .navbar-toggle').is(':visible'))
            $(this).parents('.navbar-collapse').collapse('hide');
    });
    $('.accordion-style2 .collapse').on('show.bs.collapse', function () {
        var id = $(this).attr('id');
        $('a[href="#' + id + '"]').closest('.panel-heading').addClass('active-accordion');
        $('a[href="#' + id + '"] .panel-title span').html('<i class="fa fa-angle-up"></i>');
    });
    $('.accordion-style2 .collapse').on('hide.bs.collapse', function () {
        var id = $(this).attr('id');
        $('a[href="#' + id + '"]').closest('.panel-heading').removeClass('active-accordion');
        $('a[href="#' + id + '"] .panel-title span').html('<i class="fa fa-angle-down"></i>');
    });
    $('.accordion-style3 .collapse').on('show.bs.collapse', function () {
        var id = $(this).attr('id');
        $('a[href="#' + id + '"]').closest('.panel-heading').addClass('active-accordion');
        $('a[href="#' + id + '"] .panel-title span').html('<i class="fa fa-angle-up"></i>');
    });
    $('.accordion-style3 .collapse').on('hide.bs.collapse', function () {
        var id = $(this).attr('id');
        $('a[href="#' + id + '"]').closest('.panel-heading').removeClass('active-accordion');
        $('a[href="#' + id + '"] .panel-title span').html('<i class="fa fa-angle-down"></i>');
    });
    /*==============================================================*/
    //accordion - END CODE
    /*==============================================================*/

    /*==============================================================*/
    //toggles  - START CODE
    /*==============================================================*/

    $('toggles .collapse').on('show.bs.collapse', function () {
        var id = $(this).attr('id');
        $('a[href="#' + id + '"]').closest('.panel-heading').addClass('active-accordion');
        $('a[href="#' + id + '"] .panel-title span').html('<i class="fa fa-minus"></i>');
    });
    $('toggles .collapse').on('hide.bs.collapse', function () {
        var id = $(this).attr('id');
        $('a[href="#' + id + '"]').closest('.panel-heading').removeClass('active-accordion');
        $('a[href="#' + id + '"] .panel-title span').html('<i class="fa fa-plus"></i>');
    });
    $('.toggles-style2 .collapse').on('show.bs.collapse', function () {
        var id = $(this).attr('id');
        $('a[href="#' + id + '"]').closest('.panel-heading').addClass('active-accordion');
        $('a[href="#' + id + '"] .panel-title span').html('<i class="fa fa-angle-up"></i>');
    });
    $('.toggles-style2 .collapse').on('hide.bs.collapse', function () {
        var id = $(this).attr('id');
        $('a[href="#' + id + '"]').closest('.panel-heading').removeClass('active-accordion');
        $('a[href="#' + id + '"] .panel-title span').html('<i class="fa fa-angle-down"></i>');
    });
    /*==============================================================*/
    //toggles  - END CODE
    /*==============================================================*/

    /*==============================================================*/
    //fit video  - START CODE
    /*==============================================================*/
    
    try {
        $(".fit-videos").fitVids();
    }
    catch (err) {

    }

    /*==============================================================*/
    //fit video  - END CODE
    /*==============================================================*/

    /*==============================================================*/
    //google map - mouse scrolling wheel behavior - START CODE
    /*==============================================================*/
    // you want to enable the pointer events only on click;

    $('#map_canvas1').addClass('scrolloff'); // set the pointer events to none on doc ready
    $('#canvas1').on('click', function () {
        $('#map_canvas1').removeClass('scrolloff'); // set the pointer events true on click
    });
    // you want to disable pointer events when the mouse leave the canvas area;

    $("#map_canvas1").mouseleave(function () {
        $('#map_canvas1').addClass('scrolloff'); // set the pointer events to none when mouse leaves the map area
    });
    /*==============================================================*/
    //google map - mouse scrolling wheel behavior - END CODE
    /*==============================================================*/

    /*==============================================================*/
    //Search - START CODE
    /*==============================================================*/
    $("input.search-input").bind("keypress", function (event) {
        if (event.which == 13 && !isMobile) {
            $("button.search-button").click();
            event.preventDefault();
        }
    });
    $("input.search-input").bind("keyup", function (event) {
        if ($(this).val() == null || $(this).val() == "") {
            $(this).css({"border": "none", "border-bottom": "2px solid red"});
        }
        else {
            $(this).css({"border": "none", "border-bottom": "2px solid #000"});
        }
    });
    function validationSearchForm() {
        var error = true;
        $('#search-header input[type=text]').each(function (index) {
            if (index == 0) {
                if ($(this).val() == null || $(this).val() == "") {
                    $("#search-header").find("input:eq(" + index + ")").css({"border": "none", "border-bottom": "2px solid red"});
                    error = false;
                }
                else {
                    $("#search-header").find("input:eq(" + index + ")").css({"border": "none", "border-bottom": "2px solid #000"});
                }
            }
        });
        return error;
    }
    $("form.search-form, form.search-form-result").submit(function (event) {
        var error = validationSearchForm();
        if (error) {
            var action = $(this).attr('action');
            action = action + '?' + $(this).serialize();
            window.location = action;
        }

        event.preventDefault();
    });

    $('.navbar .navbar-collapse a.dropdown-toggle, .accordion-style1 .panel-heading a, .accordion-style2 .panel-heading a, .accordion-style3 .panel-heading a, .toggles .panel-heading a, .toggles-style2 .panel-heading a, .toggles-style3 .panel-heading a, a.carousel-control, .nav-tabs a[data-toggle="tab"], a.shopping-cart').click(function (e) {
        e.preventDefault();
    });
    $('body').on('touchstart click', function (e) {
        if ($(window).width() < 992) {
            if (!$('.navbar-collapse').has(e.target).is('.navbar-collapse') && $('.navbar-collapse').hasClass('in') && !$(e.target).hasClass('navbar-toggle')) {
                $('.navbar-collapse').collapse('hide');
            }
        }
        else {
            if (!$('.navbar-collapse').has(e.target).is('.navbar-collapse') && $('.navbar-collapse ul').hasClass('in')) {
                $('.navbar-collapse').find('a.dropdown-toggle').addClass('collapsed');
                $('.navbar-collapse').find('ul.dropdown-menu').removeClass('in');
                $('.navbar-collapse a.dropdown-toggle').removeClass('active');
            }
        }
    });
    $('.navbar-collapse a.dropdown-toggle').on('touchstart', function (e) {
        $('.navbar-collapse a.dropdown-toggle').not(this).removeClass('active');
        if ($(this).hasClass('active'))
            $(this).removeClass('active');
        else
            $(this).addClass('active');
    });

    $("button.navbar-toggle").click(function () {
        if (isMobile) {
            jQuery(".cart-content").css('opacity', '0');
            jQuery(".cart-content").css('visibility', 'hidden');

        }
    });
    $("a.dropdown-toggle").click(function () {
        if (isMobile) {
            jQuery(".cart-content").css('opacity', '0');
            jQuery(".cart-content").css('visibility', 'hidden');

        }
    });

    /*==============================================================*/
    //Search - END CODE
    /*==============================================================*/

    /*==============================================================*/
    //Parallax - START CODE
    /*==============================================================*/

    var $elem = $('#content');
    $('#scroll_to_top').fadeIn('slow');
    $('#nav_down').fadeIn('slow');
    $(window).bind('scrollstart', function () {
        $('#scroll_to_top,#nav_down').stop().animate({'opacity': '0.2'});
    });
    $(window).bind('scrollstop', function () {
        $('#scroll_to_top,#nav_down').stop().animate({'opacity': '1'});
    });
    $('#nav_down').click(
            function (e) {
                $('html, body').animate({scrollTop: $elem.height()}, 800);
            }
    );
    $('#scroll_to_top').click(
            function (e) {
                $('html, body').animate({scrollTop: '0px'}, 800);
            }
    );
    /*==============================================================*/
    //Parallax - END CODE
    /*==============================================================*/

    // pull-menu close on href click event in mobile devices
    $( document ).on( 'click', '.pull-menu a.inner-link', function (e) {
        if( !( $( this ).parents( '.hamburger-menu1' ).length > 0 ) || isMobile ) {
            $('#close-button').click();
        }
    });

});

/*==============================================================*/
// Counter Number Appear - START CODE
/*==============================================================*/

$(document).ready(function () {
    // Check counter div is visible then animate counter
    $('.counter-number').appear();
    $(document.body).on('appear', '.counter-number', function (e) {
        // this code is executed for each appeared element
        var element = $(this);
        if (!$(this).hasClass('appear')) {
            animatecounters(element);
            $(this).addClass('appear');
        }
    });

    // Check chart div is visible then animate chart
    $('.chart').appear();
    $(document.body).on('appear', '.chart', function (e) {
        // this code is executed for each appeared element
        var element = $(this);
        if (!$(this).hasClass('appear')) {
            animatecharts(element);
            $(this).addClass('appear');
        }
    });
});

/*==============================================================*/
// Counter Number Appear - END CODE
/*==============================================================*/

/*==============================================================*/
//Counter Number - START CODE
/*==============================================================*/

function animatecounters(element) {
     var getCounterNumber = jQuery(element).attr('data-to');
     jQuery({ ValuerHbcO: 0 }).delay(0).animate({ ValuerHbcO: getCounterNumber },
     {
         duration: 2000,
         easing: "swing",
         step: function (currentLeft) {
             var roundNumber = Math.ceil( currentLeft );
             $(element).text( roundNumber );
         }
     });
}
/*==============================================================*/
//Counter Number - END CODE
/*==============================================================*/

/*==============================================================*/
//Chart Animated - START CODE
/*==============================================================*/

function animatecharts(element) {
    element.data('easyPieChart').update(0);
    element.data('easyPieChart').update(element.attr("data-percent"));
}
/*==============================================================*/
//Chart Animated - END CODE
/*==============================================================*/

/*==============================================================*/
//Navigation - START CODE
/*==============================================================*/
// Shrink nav on scroll
$(window).scroll(function () {
    if( !$( 'nav.navigation-menu, nav.navbar' ).hasClass( 'no-shrink-nav' ) ) {
        if ($(window).scrollTop() > 10) {
            $('nav.navigation-menu, nav.navbar').addClass('shrink-nav');
        } else {
            $('nav.navigation-menu, nav.navbar').removeClass('shrink-nav');
        }
    }
});
// Resize Header Menu
function SetResizeHeaderMenu() {
    var width = jQuery('nav.navbar').children('div.container').width();
    $("ul.mega-menu-full").each(function () {
        jQuery(this).css('width', width + 'px');
    });
}
/*==============================================================*/
//Navigation - END CODE
/*==============================================================*/


/*==============================================================*/
//Parallax - START CODE
/*==============================================================*/
// Parallax Fix Image Scripts 

$('.parallax-fix').each(function () {
    if ($(this).children('.parallax-background-img').length) {
        var imgSrc = jQuery(this).children('.parallax-background-img').attr('src');
        jQuery(this).css('background', 'url("' + imgSrc + '")');
        jQuery(this).children('.parallax-background-img').remove();
        $(this).css('background-position', '50% 0%');
    }

});
var IsParallaxGenerated = false;
function SetParallax() {
    if ($(window).width() > 1030 && !IsParallaxGenerated) {
        $('.parallax1').parallax("50%", 0.1);
        $('.parallax2').parallax("50%", 0.2);
        $('.parallax3').parallax("50%", 0.3);
        $('.parallax4').parallax("50%", 0.4);
        $('.parallax5').parallax("50%", 0.5);
        $('.parallax6').parallax("50%", 0.6);
        $('.parallax7').parallax("50%", 0.7);
        $('.parallax8').parallax("50%", 0.8);
        $('.parallax9').parallax("50%", 0.05);
        $('.parallax10').parallax("50%", 0.02);
        $('.parallax11').parallax("50%", 0.01);
        $('.parallax12').parallax("50%", 0.099);
        IsParallaxGenerated = true;
    }
}
/*==============================================================*/
//Parallax - END CODE
/*==============================================================*/

/*==============================================================*/
//Mobile Toggle Control - START CODE
/*==============================================================*/

$('.mobile-toggle').click(function () {
    $('nav').toggleClass('open-nav');
});
$('.dropdown-arrow').click(function () {
    if ($('.mobile-toggle').is(":visible")) {
        if ($(this).children('.dropdown').hasClass('open-nav')) {
            $(this).children('.dropdown').removeClass('open-nav');
        } else {
            $('.dropdown').removeClass('open-nav');
            $(this).children('.dropdown').addClass('open-nav');
        }
    }
});
/*==============================================================*/
//Mobile Toggle Control - END CODE
/*==============================================================*/

/*==============================================================*/
//Contact Form Focus Remove Border- START CODE
/*==============================================================*/
$("form.wpcf7-form input").focus(function () {
    if ($(this).hasClass("wpcf7-not-valid")) {
        $(this).removeClass("wpcf7-not-valid");
        $(this).parent().find(".wpcf7-not-valid-tip").remove();
        $(this).parents().find(".wpcf7-validation-errors").css("display", "none"); 
    }
});
/*==============================================================*/
//Contact Form Focus Remove Border- END CODE
/*==============================================================*/

/*==============================================================*/
//Position Fullwidth Subnavs fullwidth correctly - START CODE
/*==============================================================*/
$('.dropdown-fullwidth').each(function () {
    $(this).css('width', $('.row').width());
    var subNavOffset = -($('nav .row').innerWidth() - $('.menu').innerWidth() - 15);
    $(this).css('left', subNavOffset);
});
/*==============================================================*/
//Position Fullwidth Subnavs fullwidth correctly - END CODE
/*==============================================================*/

/*==============================================================*/
//Smooth Scroll - START CODE
/*==============================================================*/
var scrollAnimationTime = 1200,
    scrollAnimation = 'easeInOutExpo';
$('a.scrollto').bind('click.smoothscroll', function (event) {
    event.preventDefault();
    var target = this.hash;
    $('html, body').stop()
            .animate({
                'scrollTop': $(target)
                        .offset()
                        .top
            }, scrollAnimationTime, scrollAnimation, function () {
                window.location.hash = target;
            });
});

// Inner links
$('.inner-link').smoothScroll({
    speed: 900,
    offset: -0
});

// Stop Propagation After Button Click
$('.scrollToDownSection .inner-link, .scrollToDownSection form').click(function(event) {
    event.stopPropagation();
});

$('section.scrollToDownSection').click(function(){
   var section_id = $( $(this).attr('data-section-id') );
   $('html, body').animate({scrollTop: section_id.offset().top}, 800);
});

// Single Product Readmore button link
$('.woo-inner-link').click(function(){
    $(this).attr("data-toggle","tab");
    $("html,body").animate({scrollTop:$(".product-deails-tab").offset().top - 80 }, 1000);
    $(".nav-tabs-light li").removeClass("active");
    $(".nav-tabs-light li.description_tab ").addClass("active");
});

/*==============================================================*/
//Smooth Scroll - END CODE
/*==============================================================*/

/*==============================================================*/
//Full Screen Header - START CODE
/*==============================================================*/

function SetResizeContent() {
     var minheight = $(window).height();
     $(".full-screen").css('min-height', minheight);

     var minwidth = $(window).width();
     $(".full-screen-width").css('min-width', minwidth);

     $('.menu-first-level').each(function () {
         $(this).find('ul.collapse').removeClass('in');
         var menu_link = $(this).children('a');
         var dataurl = menu_link.attr('data-redirect-url');
         var datadefaulturl = menu_link.attr('data-default-url');
         if (minwidth >= 992) {
             $(menu_link).removeAttr('data-toggle');
             $(this).children('a').attr('href', dataurl);
         } else {
             $(menu_link).attr('data-toggle', 'collapse');
             $(this).children('a').attr('href', datadefaulturl);
         }
     });
}


SetResizeContent();
/*==============================================================*/
//Full Screen Header - END CODE
/*==============================================================*/


/*==============================================================*/
//Window Resize Events - START CODE
/*==============================================================*/
$(window).resize(function () {

    HamburderMenuCustomScroll();

    //Position Fullwidth Subnavs fullwidth correctly
    $('.dropdown-fullwidth').each(function () {
        $(this).css('width', $('.row').width());
        var subNavOffset = -($('nav .row').innerWidth() - $('.menu').innerWidth() - 15);
        $(this).css('left', subNavOffset);
    });
    SetResizeContent();
    setTimeout(function () {
        SetResizeHeaderMenu();
    }, 200);
    if ($(window).width() >= 992 && $('.navbar-collapse').hasClass('in')) {
        $('.navbar-collapse').removeClass('in');
        //$('.navbar-collapse').removeClass('in').find('ul.dropdown-menu').removeClass('in').parent('li.dropdown').addClass('open');
        $('.navbar-collapse ul.dropdown-menu').each(function () {
            if ($(this).hasClass('in')) {
                $(this).removeClass('in'); //.parent('li.dropdown').addClass('open');
            }
        });
        $('ul.navbar-nav > li.dropdown > a.dropdown-toggle').addClass('collapsed');
        $('.logo').focus();
        $('.navbar-collapse a.dropdown-toggle').removeClass('active');
    }

    setTimeout(function () {
        SetParallax();
    }, 1000);
});
/*==============================================================*/
//Window Resize Events - END CODE
/*==============================================================*/

/*==============================================================*/
//Countdown Timer - START CODE
/*==============================================================*/

$('.counter-hidden').each(function () {
    if($(this).hasClass('counter-underconstruction-date')){
        
        var $counter_date = $('.counter-underconstruction-date').html();

        /* Get Counter taxts */
        var $CounterDay, $CounterHours, $CounterMinutes, $CounterSeconds = '';
        var CounterDayattr = $(this).parent().find('#counter-underconstruction').attr('data-days-text');
        if( typeof CounterDayattr !== typeof undefined && CounterDayattr !== false ) {
            var $CounterDay = '<span>'+CounterDayattr+'%!d</span>';
        }
        var CounterHoursattr = $(this).parent().find('#counter-underconstruction').attr('data-hours-text');
        if( typeof CounterHoursattr !== typeof undefined && CounterHoursattr !== false ) {
            var $CounterHours = '<span>'+CounterHoursattr+'</span>';
        }
        var CounterMinutesattr = $(this).parent().find('#counter-underconstruction').attr('data-minutes-text');
        if( typeof CounterMinutesattr !== typeof undefined && CounterMinutesattr !== false ) {
            var $CounterMinutes = '<span>'+CounterMinutesattr+'</span>';
        }
        var CounterSecondsattr = $(this).parent().find('#counter-underconstruction').attr('data-seconds-text');
        if( typeof CounterSecondsattr !== typeof undefined && CounterSecondsattr !== false ) {
            var $CounterSeconds = '<span>'+CounterSecondsattr+'</span>';
        }
        
        $(this).parent().find('#counter-underconstruction').countdown($counter_date+' 12:00:00').on('update.countdown', function (event) {
            var $this = $(this).parent().find('#counter-underconstruction').html(event.strftime('' + 
                '<div class="counter-container"><div class="counter-box first"><div class="number">%-D</div>'+$CounterDay+'</div>' + 
                '<div class="counter-box"><div class="number">%H</div>'+$CounterHours+'</div>' + 
                '<div class="counter-box"><div class="number">%M</div>'+$CounterMinutes+'</div>' + 
                '<div class="counter-box last"><div class="number">%S</div>'+$CounterSeconds+'</div></div>'))
        });
    }
});

$('.counter-hidden').each(function () {
    if( $(this).hasClass('hcode-time-counter-date')){
        var $counter_date = $(this).html();

        /* Get Counter taxts */
        var $CounterDay, $CounterHours, $CounterMinutes, $CounterSeconds = '';
        var CounterDayattr = $(this).parent().find('#hcode-time-counter').attr('data-days-text');
        if( typeof CounterDayattr !== typeof undefined && CounterDayattr !== false ) {
            var $CounterDay = '<span>'+CounterDayattr+'%!d</span>';
        }
        var CounterHoursattr = $(this).parent().find('#hcode-time-counter').attr('data-hours-text');
        if( typeof CounterHoursattr !== typeof undefined && CounterHoursattr !== false ) {
            var $CounterHours = '<span>'+CounterHoursattr+'</span>';
        }
        var CounterMinutesattr = $(this).parent().find('#hcode-time-counter').attr('data-minutes-text');
        if( typeof CounterMinutesattr !== typeof undefined && CounterMinutesattr !== false ) {
            var $CounterMinutes = '<span>'+CounterMinutesattr+'</span>';
        }
        var CounterSecondsattr = $(this).parent().find('#hcode-time-counter').attr('data-seconds-text');
        if( typeof CounterSecondsattr !== typeof undefined && CounterSecondsattr !== false ) {
            var $CounterSeconds = '<span>'+CounterSecondsattr+'</span>';
        }

        
        $(this).parent().find('#hcode-time-counter').countdown($counter_date+' 12:00:00').on('update.countdown', function (event) {
            var $this = $(this).parent().find('#hcode-time-counter').html(event.strftime('' + 
                '<div class="counter-container"><div class="counter-box first"><div class="number">%-D</div>'+$CounterDay+'</div>' + 
                '<div class="counter-box"><div class="number">%H</div>'+$CounterHours+'</div>' + 
                '<div class="counter-box"><div class="number">%M</div>'+$CounterMinutes+'</div>' + 
                '<div class="counter-box last"><div class="number">%S</div>'+$CounterSeconds+'</div></div>'))
        });
    }
});
/*==============================================================*/
//Countdown Timer - END CODE
/*==============================================================*/


/*==============================================================*/
//Scroll To Top - START CODE
/*==============================================================*/
$(window).scroll(function () {
    if ($(this)
            .scrollTop() > 100) {
        $('.scrollToTop')
                .fadeIn();
    } else {
        $('.scrollToTop')
                .fadeOut();
    }
});
//Click event to scroll to top
$('.scrollToTop').click(function () {
    $('html, body').animate({
        scrollTop: 0
    }, 1000);
    return false;
});
/*==============================================================*/
//Scroll To Top - END CODE
/*==============================================================*/

$('nav ul.panel-group li.dropdown a.dropdown-toggle').click(function () {

    if ($(this).parent('li').find('ul.dropdown-menu').length > 0) {
        $(this).parents('ul').find('li.dropdown-toggle').not($(this).parent('li')).removeClass('open');
        if ($(this).parent('li').hasClass('open')) {
            $(this).parent('li').removeClass('open');
        }
        else {
            $(this).parent('li').addClass('open');
        }
    }
});

$('.hamburger-menu2 a.megamenu-right-icon, .hamburger-menu3 a.megamenu-right-icon').click(function () {

    if ($(this).parents('li').find('ul.sub-menu').length > 0) {
        
        if ($(this).hasClass('open')) {
            $(this).removeClass('open');
            $(this).next().slideUp();
        }
        else {
            $(this).addClass('open');
            $(this).next().slideDown();
        }
    }
    return false;
});

/*==============================================================*/
//To Make Checkbox/Radio Active/Disabled  - START CODE
/*==============================================================*/

$(".carousel .carousel-indicators > li:first-child").addClass("active");
$(".carousel .carousel-inner > div:first-child").addClass("active");

$('span.optionsradios input[value=Disabled]').attr('disabled', 'disabled');
$('span.optionscheckbox input[value=Disabled]').attr('disabled', 'disabled');
/*==============================================================*/
//To Make Checkbox/Radio Active/Disabled - END CODE
/*==============================================================*/


/*==============================================================*/
// NewsLetter Validation - START CODE
/*==============================================================*/

$('.submit_newsletter').click(function () {
    var reg = /^([A-Za-z0-9_\-\.])+\@([A-Za-z0-9_\-\.])+\.([A-Za-z]{2,4})$/;
    var current = $(this);
    var address = $(this).closest('form').find('.xyz_em_email').val();
    if(reg.test(address) == false) {
        //alert('Please check whether the email is correct.');
        current.closest('form').find('.xyz_em_email').addClass('newsletter-error');
    return false;
    }else{
    //document.subscription.submit();
    return true;
    }
});

$('.xyz_em_email').on('focus', function(){
  $(this).removeClass('newsletter-error');
});

/*==============================================================*/
// NewsLetter Validation - END CODE
/*==============================================================*/

if( $('div').hasClass('feature_nav')){
    $(".feature_nav .next").click(function () {
        $(this).parent().parent().find('.owl-carousel').trigger('owl.next');
    });
    $(".feature_nav .prev").click(function () {
        $(this).parent().parent().find('.owl-carousel').trigger('owl.prev');
    });
}

/*==============================================================*/
// Woocommerce Grid List View - START CODE
/*==============================================================*/
$('.hcode-product-grid-list-wrapper > a').click(function () {
    var set_product_view = $(this);
    var product_type = set_product_view.parents().find('.products');

    if( set_product_view.hasClass('hcode-list-view')){
        product_type.addClass('product-list-view');
        product_type.removeClass('product-grid-view');
    }
    if( set_product_view.hasClass('hcode-grid-view') ){
        product_type.addClass('product-grid-view');
        product_type.removeClass('product-list-view');
    }
    set_product_view.parent().find('.active').removeClass('active');
    set_product_view.addClass('active');

});


/*==============================================================*/
// Woocommerce Grid List View - END CODE
/*==============================================================*/

/*==============================================================*/
// Woocommerce Add Minus Plus Icon In Price Arround - START CODE
/*==============================================================*/
$(document).ready(function () {

    // Target quantity inputs on product pages
    $('input.qty:not(.product-quantity input.qty)').each(function () {
        var min = parseFloat($(this).attr('min'));

        if (min && min > 0 && parseFloat($(this).val()) < min) {
            $(this).val(min);
        }
    });

    $(document).on('click', '.plus, .minus', function () {

        // when on checkout remove product via ajax. click on plus or minus remove disabled on update button. 
        $( 'div.woocommerce form input[name="update_cart"]' ).prop( 'disabled', false );

        // Get values
        var $qty = $(this).closest('.quantity').find('.qty'),
          currentVal = parseFloat($qty.val()),
          max = parseFloat($qty.attr('max')),
          min = parseFloat($qty.attr('min')),
          step = $qty.attr('step');

        // Format values
        if (!currentVal || currentVal === '' || currentVal === 'NaN') currentVal = 0;
        if (max === '' || max === 'NaN') max = '';
        if (min === '' || min === 'NaN') min = 0;
        if (step === 'any' || step === '' || step === undefined || parseFloat(step) === 'NaN') step = 1;

        // Change the value
        if ($(this).is('.plus')) {

            if (max && (max == currentVal || currentVal > max)) {
                $qty.val(max);
            } else {
                $qty.val(currentVal + parseFloat(step));
            }

        } else {

            if (min && (min == currentVal || currentVal < min)) {
                $qty.val(min);
            } else if (currentVal > 0) {
                $qty.val(currentVal - parseFloat(step));
            }

        }

        // Trigger change event
        $qty.trigger('change');
    });
});
/*==============================================================*/
// Woocommerce Add Minus Plus Icon In Price Arround - END CODE
/*==============================================================*/

/*==============================================================*/
// Checkout Remove Close Event - START CODE
/*==============================================================*/
$(document).ready(function () {
    $(document).on('click', '.checkout-alert-remove', function () {
        var remove_parent = $(this).parent().parent();
        if( remove_parent.hasClass('alert-remove') ){
            remove_parent.remove();
        }
    });
});
/*==============================================================*/
// Checkout Remove Close Event - END CODE
/*==============================================================*/

/*==============================================================*/
// Post Like Dislike Button JQuery - START CODE
/*==============================================================*/
$(document).ready(function () {
    $(document).on('click', '.sl-button', function() {
        var button = $(this);
        var post_id = button.attr('data-post-id');
        var security = button.attr('data-nonce');
        var iscomment = button.attr('data-iscomment');
        var allbuttons;
        if ( iscomment === '1' ) { /* Comments can have same id */
            allbuttons = $('.sl-comment-button-'+post_id);
        } else {
            allbuttons = $('.sl-button-'+post_id);
        }
        var loader = allbuttons.next('#sl-loader');
        if (post_id !== '') {
            $.ajax({
                type: 'POST',
                url: simpleLikes.ajaxurl,
                data : {
                    action : 'process_simple_like',
                    post_id : post_id,
                    nonce : security,
                    is_comment : iscomment
                },
                beforeSend:function(){
                },  
                success: function(response){
                    var icon = response.icon;
                    var count = response.count;
                    allbuttons.html(icon+count);
                    if(response.status === 'unliked') {
                        var like_text = simpleLikes.like;
                        allbuttons.prop('title', like_text);
                        allbuttons.removeClass('liked');
                    } else {
                        var unlike_text = simpleLikes.unlike;
                        allbuttons.prop('title', unlike_text);
                        allbuttons.addClass('liked');
                    }
                    loader.empty();                 
                }
            });
            
        }
        return false;
    });
});
/*==============================================================*/
// Post Like Dislike Button JQuery - END CODE
/*==============================================================*/


/*==============================================================*/
// Menu Icon Click jQuery - START CODE
/*==============================================================*/

$(document).ready(function () {
     $('.menu-first-level a.dropdown-toggle:first-child').bind('click', function (event) {
         var minwidth = $(window).width();
         if (minwidth >= 992) {
             var geturl = $(this).attr('href');
             if (event.ctrlKey || event.metaKey) {
                 if (geturl != '#' && geturl != '') {
                     window.open(geturl, '_blank');
                 }
             } else {
                 if (geturl != '#' && geturl != '') {
                     if ($(this).attr('target') == '_blank') {
                         window.open(geturl, '_blank');
                     } else {
                         window.location.href = geturl;
                     }
                 }
             }
         } else {
             var geturl = $(this).attr('data-redirect-url');
             if (event.ctrlKey || event.metaKey) {
                 if (geturl != '#' && geturl != '') {
                     window.open(geturl, '_blank');
                 }
             } else {
                 if (geturl != '#' && geturl != '') {
                     if ($(this).attr('target') == '_blank') {
                         window.open(geturl, '_blank');
                     } else {
                         window.location.href = geturl;
                     }
                 }
             }
         }
     });
});
/*==============================================================*/
// Menu Icon Click jQuery - END CODE
/*==============================================================*/


/*==============================================================*/
// Menu Icon Add jQuery - START CODE
/*==============================================================*/
$(document).ready(function () {
    if($("li.menu-item-language").find("ul").first().length != 0){
        $("li.menu-item-language a:first").append("<i class='fa fa-angle-down'></i>");
    }
});
/*==============================================================*/
// Menu Icon Add jQuery - END CODE
/*==============================================================*/

/*==============================================================*/
// Comment Validation - START CODE
/*==============================================================*/

$(document).ready(function () {
  
    $(".comment-button").on("click", function () {
        var fields;
            fields = "";
        if($(this).parent().parent().find('#author').length == 1) {
            if ($("#author").val().length == 0 || $("#author").val().value == '')
            {
                fields ='1';
                $("#author").addClass("inputerror");
            }
        }
        if($(this).parent().parent().find('#comment').length == 1) {
            if ($("#comment").val().length == 0 || $("#comment").val().value == '')
            {
                fields ='1';
                $("#comment").addClass("inputerror");
            }
        }
        if($(this).parent().parent().find('#email').length == 1) {
            if ($("#email").val().length == 0 || $("#email").val().length =='')
            {
                fields ='1';
                $("#email").addClass("inputerror");
            }
            else
                {
                    var re = new RegExp();
                    re = /^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/;
                    var sinput ;
                    sinput= "" ;
                    sinput = $("#email").val();
                    if (!re.test(sinput))
                    {
                        fields ='1';
                        $("#email").addClass("inputerror");
                    }
                }
        }
        if(fields !="")
        {
            return false;
        }           
        else
        {
            return true;
        }
    });

});
function inputfocus(id){
    $('#'+id).removeClass('inputerror');
}
/*==============================================================*/
// Comment Validation - END CODE
/*==============================================================*/

var IpadMobileHover = function () {
	if((navigator.userAgent.match(/iPhone/i)) || (navigator.userAgent.match(/iPod/i)) || (navigator.userAgent.match(/iPad/i))) {
	    $('.icon-box > i').on('touchstart', function () {
	        $(this).trigger('hover');
	    }).on('touchend', function () {
	        $(this).trigger('hover');
	    });
	}
};

/*==============================================================*/
// Slider Integrate into Tab - START CODE
/*==============================================================*/

$(document).ready(function () {
    $('.nav-tabs a[data-toggle="tab"]').each(function () {
        var $this = $(this);
        $this.on('shown.bs.tab', function () {
            if( $('.masonry-items').length > 0 ) {
                $('.masonry-items').imagesLoaded( function () {
                    $('.masonry-items').masonry({
                        itemSelector: 'li',
                        layoutMode: 'masonry'
                    });
                });
            }
            if( $('.blog-masonry').length > 0 ) {
                $('.blog-masonry').imagesLoaded( function () {
                    $('.blog-masonry').masonry({
                        itemSelector: 'div.blog-listing',
                        layoutMode: 'masonry'
                    });
                });
            }
        });
    });
});

/*==============================================================*/
// Slider Integrate into Tab - END CODE
/*==============================================================*/

/*==============================================================*/
// Add extra class into menu - START CODE
/*==============================================================*/

$(document).ready(function () {
    hcodeMobileMenuDynamicClass();
});

$(window).resize(function () {
    hcodeMobileMenuDynamicClass();
});

function hcodeMobileMenuDynamicClass() {
    if (window.matchMedia('(max-width: 991px)').matches) {
        $( '.accordion-menu' ).addClass( 'mobile-accordion-menu' );
    } else {
        $( '.accordion-menu' ).removeClass( 'mobile-accordion-menu' );
    }
}

/*==============================================================*/
// Add extra class into menu - END CODE
/*==============================================================*/

/*==============================================================*/
// Portfolio gallery popup - START CODE
/*==============================================================*/

$(document).ready(function(){

    $( "figcaption" ).on( "click", ".parent-gallery-popup", function() {
        if ( $(this).parents('li').find('.gallery-img').children().length > 0 ) {
            $(this).parents('li').find('a.lightboxgalleryitem').first().trigger('click');
        }
    });

    $( "figure" ).on( "click", ".parallax-parent-gallery-popup", function() {
        console.log( $(this).parents('.parallax-portfolio-gallery-parent').find('a.lightboxgalleryitem').length );
        if ( $(this).parents('.parallax-portfolio-gallery-parent').find('a.lightboxgalleryitem').length > 0 ) {
            $(this).parents('.parallax-portfolio-gallery-parent').find('a.lightboxgalleryitem').first().trigger('click');
        }
    });

});

/*==============================================================*/
// Portfolio gallery popup - END CODE
/*==============================================================*/


/*==============================================================*/
// Infinite Scroll jQuery - START CODE
/*==============================================================*/

var pagesNum = $("div.hcode-infinite-scroll").attr('data-pagination');
$(document).ready(function(){
    $('.infinite-scroll-pagination').infinitescroll({
        nextSelector: 'div.hcode-infinite-scroll a',
        loading: {
            img: hcodeajaxurl.loading_image,
            msgText: '<div class="paging-loader" style="transform:scale(0.35);"><div class="circle"><div></div></div><div class="circle"><div></div></div><div class="circle"><div></div></div><div class="circle"><div></div></div></div>',
            finishedMsg: '<div class="finish-load">' + hcode_infinite_scroll_message.message + '</div>',
            speed: 'fast',
        },
        navSelector: 'div.hcode-infinite-scroll',
        contentSelector: '.infinite-scroll-pagination',
        itemSelector: '.infinite-scroll-pagination div.blog-single-post',
        maxPage: pagesNum,
    }, function (newElements) {
        $('.hcode-infinite-scroll').remove();
        $('#infscr-loading').remove();
        /* For new element set masonry */
        var $newblogpost = $(newElements);
        // append other items when they are loaded
        $newblogpost.imagesLoaded( function() {
        $('.blog-masonry').append( $newblogpost )
          .isotope( 'appended', $newblogpost );
        });

        try {
            $(".fit-videos").fitVids();
        }catch (err) { }

        /* For owl slider */
        $(".blog-gallery").owlCarousel({
            navigation: true, // Show next and prev buttons
            slideSpeed: 300,
            paginationSpeed: 400,
            singleItem: true,
            navigationText: ["<i class='fa fa-angle-left'></i>", "<i class='fa fa-angle-right'></i>"]
        });
        /* For Magnific Popup */
        var lightboxgallerygroups = {};
        $('.lightboxgalleryitem').each(function() {
          var id = $(this).attr('data-group');
          if(!lightboxgallerygroups[id]) {
            lightboxgallerygroups[id] = [];
          } 
          
          lightboxgallerygroups[id].push( this );
        });


        $.each(lightboxgallerygroups, function() {
            $(this).magnificPopup({
                type: 'image',
                closeOnContentClick: true,
                closeBtnInside: false,
                gallery: { enabled:true },
                image: {
                    titleSrc: function (item) {
                        var title = '';
                        var lightbox_caption = '';
                        if( item.el.attr('title') ){
                            title = item.el.attr('title');
                        }
                        if( item.el.attr('lightbox_caption') ){
                            lightbox_caption = '<span class="hcode-lightbox-caption">'+item.el.attr('lightbox_caption')+'</span>';
                        }
                        return title + lightbox_caption;
                    }
                },
                // Remove close on popup bg v1.5
                callbacks: {
                    open: function () {
                        $.magnificPopup.instance.close = function() {
                            if (!isMobile && !$('body').hasClass('hcode-custom-popup-close') ){
                                $.magnificPopup.proto.close.call(this);
                            } else {
                                $('button.mfp-close').click(function() {
                                    $.magnificPopup.proto.close.call(this);
                                });
                            }
                        }
                    }
                }
            });
        });
    });
});


/*==============================================================*/
// Infinite Scroll jQuery - END CODE
/*==============================================================*/

/*==============================================================
    Custom Scroll Bar - START CODE
 ==============================================================*/

function HamburderMenuCustomScroll() {

    var windowHeight = $(window).height();
    $(".hamburger-menu1 .navbar-default").css('height', ( windowHeight / 2 ) );

    $(".hamburger-menu1 .navbar-default").mCustomScrollbar({
        scrollInertia: 100,
        scrollButtons:{
            enable:false
        },
        keyboard:{
            enable: true
        },
        mouseWheel:{
            enable:true,
            scrollAmount:200
        },
        callbacks:{
            whileScrolling:function(){
            },
        }
    });
}

/*==============================================================
    Custom Scroll Bar - END CODE
 ==============================================================*/

/*==============================================================
    Hamburger Menu 1 Auto Active Menu - START CODE
 ==============================================================*/

function OnePageActiveOnScroll(event){
    var scrollPos = $(document).scrollTop();
    $('.navigation-menu a.inner-link, .navbar a.inner-link').each(function () {
        var currLink = $(this);
        var refElement = $(currLink.attr("href"));
        if( refElement.length > 0 ) {
            if (refElement.position().top <= scrollPos && refElement.position().top + refElement.height() > scrollPos) {
                $('a.inner-link').removeClass("active");
                currLink.addClass("active");
            }
            else{
                currLink.removeClass("active");
            }
        }
    });
}

/*==============================================================
    Hamburger Menu 1 Auto Active Menu - END CODE
 ==============================================================*/
;!function(a,b){"use strict";function c(){if(!e){e=!0;var a,c,d,f,g=-1!==navigator.appVersion.indexOf("MSIE 10"),h=!!navigator.userAgent.match(/Trident.*rv:11\./),i=b.querySelectorAll("iframe.wp-embedded-content");for(c=0;c<i.length;c++){if(d=i[c],!d.getAttribute("data-secret"))f=Math.random().toString(36).substr(2,10),d.src+="#?secret="+f,d.setAttribute("data-secret",f);if(g||h)a=d.cloneNode(!0),a.removeAttribute("security"),d.parentNode.replaceChild(a,d)}}}var d=!1,e=!1;if(b.querySelector)if(a.addEventListener)d=!0;if(a.wp=a.wp||{},!a.wp.receiveEmbedMessage)if(a.wp.receiveEmbedMessage=function(c){var d=c.data;if(d.secret||d.message||d.value)if(!/[^a-zA-Z0-9]/.test(d.secret)){var e,f,g,h,i,j=b.querySelectorAll('iframe[data-secret="'+d.secret+'"]'),k=b.querySelectorAll('blockquote[data-secret="'+d.secret+'"]');for(e=0;e<k.length;e++)k[e].style.display="none";for(e=0;e<j.length;e++)if(f=j[e],c.source===f.contentWindow){if(f.removeAttribute("style"),"height"===d.message){if(g=parseInt(d.value,10),g>1e3)g=1e3;else if(~~g<200)g=200;f.height=g}if("link"===d.message)if(h=b.createElement("a"),i=b.createElement("a"),h.href=f.getAttribute("src"),i.href=d.value,i.host===h.host)if(b.activeElement===f)a.top.location.href=d.value}else;}},d)a.addEventListener("message",a.wp.receiveEmbedMessage,!1),b.addEventListener("DOMContentLoaded",c,!1),a.addEventListener("load",c,!1)}(window,document);
;/*!
 * jQuery UI Core 1.11.4
 * http://jqueryui.com
 *
 * Copyright jQuery Foundation and other contributors
 * Released under the MIT license.
 * http://jquery.org/license
 *
 * http://api.jqueryui.com/category/ui-core/
 */
!function(a){"function"==typeof define&&define.amd?define(["jquery"],a):a(jQuery)}(function(a){function b(b,d){var e,f,g,h=b.nodeName.toLowerCase();return"area"===h?(e=b.parentNode,f=e.name,!(!b.href||!f||"map"!==e.nodeName.toLowerCase())&&(g=a("img[usemap='#"+f+"']")[0],!!g&&c(g))):(/^(input|select|textarea|button|object)$/.test(h)?!b.disabled:"a"===h?b.href||d:d)&&c(b)}function c(b){return a.expr.filters.visible(b)&&!a(b).parents().addBack().filter(function(){return"hidden"===a.css(this,"visibility")}).length}a.ui=a.ui||{},a.extend(a.ui,{version:"1.11.4",keyCode:{BACKSPACE:8,COMMA:188,DELETE:46,DOWN:40,END:35,ENTER:13,ESCAPE:27,HOME:36,LEFT:37,PAGE_DOWN:34,PAGE_UP:33,PERIOD:190,RIGHT:39,SPACE:32,TAB:9,UP:38}}),a.fn.extend({scrollParent:function(b){var c=this.css("position"),d="absolute"===c,e=b?/(auto|scroll|hidden)/:/(auto|scroll)/,f=this.parents().filter(function(){var b=a(this);return(!d||"static"!==b.css("position"))&&e.test(b.css("overflow")+b.css("overflow-y")+b.css("overflow-x"))}).eq(0);return"fixed"!==c&&f.length?f:a(this[0].ownerDocument||document)},uniqueId:function(){var a=0;return function(){return this.each(function(){this.id||(this.id="ui-id-"+ ++a)})}}(),removeUniqueId:function(){return this.each(function(){/^ui-id-\d+$/.test(this.id)&&a(this).removeAttr("id")})}}),a.extend(a.expr[":"],{data:a.expr.createPseudo?a.expr.createPseudo(function(b){return function(c){return!!a.data(c,b)}}):function(b,c,d){return!!a.data(b,d[3])},focusable:function(c){return b(c,!isNaN(a.attr(c,"tabindex")))},tabbable:function(c){var d=a.attr(c,"tabindex"),e=isNaN(d);return(e||d>=0)&&b(c,!e)}}),a("<a>").outerWidth(1).jquery||a.each(["Width","Height"],function(b,c){function d(b,c,d,f){return a.each(e,function(){c-=parseFloat(a.css(b,"padding"+this))||0,d&&(c-=parseFloat(a.css(b,"border"+this+"Width"))||0),f&&(c-=parseFloat(a.css(b,"margin"+this))||0)}),c}var e="Width"===c?["Left","Right"]:["Top","Bottom"],f=c.toLowerCase(),g={innerWidth:a.fn.innerWidth,innerHeight:a.fn.innerHeight,outerWidth:a.fn.outerWidth,outerHeight:a.fn.outerHeight};a.fn["inner"+c]=function(b){return void 0===b?g["inner"+c].call(this):this.each(function(){a(this).css(f,d(this,b)+"px")})},a.fn["outer"+c]=function(b,e){return"number"!=typeof b?g["outer"+c].call(this,b):this.each(function(){a(this).css(f,d(this,b,!0,e)+"px")})}}),a.fn.addBack||(a.fn.addBack=function(a){return this.add(null==a?this.prevObject:this.prevObject.filter(a))}),a("<a>").data("a-b","a").removeData("a-b").data("a-b")&&(a.fn.removeData=function(b){return function(c){return arguments.length?b.call(this,a.camelCase(c)):b.call(this)}}(a.fn.removeData)),a.ui.ie=!!/msie [\w.]+/.exec(navigator.userAgent.toLowerCase()),a.fn.extend({focus:function(b){return function(c,d){return"number"==typeof c?this.each(function(){var b=this;setTimeout(function(){a(b).focus(),d&&d.call(b)},c)}):b.apply(this,arguments)}}(a.fn.focus),disableSelection:function(){var a="onselectstart"in document.createElement("div")?"selectstart":"mousedown";return function(){return this.bind(a+".ui-disableSelection",function(a){a.preventDefault()})}}(),enableSelection:function(){return this.unbind(".ui-disableSelection")},zIndex:function(b){if(void 0!==b)return this.css("zIndex",b);if(this.length)for(var c,d,e=a(this[0]);e.length&&e[0]!==document;){if(c=e.css("position"),("absolute"===c||"relative"===c||"fixed"===c)&&(d=parseInt(e.css("zIndex"),10),!isNaN(d)&&0!==d))return d;e=e.parent()}return 0}}),a.ui.plugin={add:function(b,c,d){var e,f=a.ui[b].prototype;for(e in d)f.plugins[e]=f.plugins[e]||[],f.plugins[e].push([c,d[e]])},call:function(a,b,c,d){var e,f=a.plugins[b];if(f&&(d||a.element[0].parentNode&&11!==a.element[0].parentNode.nodeType))for(e=0;e<f.length;e++)a.options[f[e][0]]&&f[e][1].apply(a.element,c)}}});
;/*!
 * jQuery UI Widget 1.11.4
 * http://jqueryui.com
 *
 * Copyright jQuery Foundation and other contributors
 * Released under the MIT license.
 * http://jquery.org/license
 *
 * http://api.jqueryui.com/jQuery.widget/
 */
!function(a){"function"==typeof define&&define.amd?define(["jquery"],a):a(jQuery)}(function(a){var b=0,c=Array.prototype.slice;return a.cleanData=function(b){return function(c){var d,e,f;for(f=0;null!=(e=c[f]);f++)try{d=a._data(e,"events"),d&&d.remove&&a(e).triggerHandler("remove")}catch(g){}b(c)}}(a.cleanData),a.widget=function(b,c,d){var e,f,g,h,i={},j=b.split(".")[0];return b=b.split(".")[1],e=j+"-"+b,d||(d=c,c=a.Widget),a.expr[":"][e.toLowerCase()]=function(b){return!!a.data(b,e)},a[j]=a[j]||{},f=a[j][b],g=a[j][b]=function(a,b){return this._createWidget?void(arguments.length&&this._createWidget(a,b)):new g(a,b)},a.extend(g,f,{version:d.version,_proto:a.extend({},d),_childConstructors:[]}),h=new c,h.options=a.widget.extend({},h.options),a.each(d,function(b,d){return a.isFunction(d)?void(i[b]=function(){var a=function(){return c.prototype[b].apply(this,arguments)},e=function(a){return c.prototype[b].apply(this,a)};return function(){var b,c=this._super,f=this._superApply;return this._super=a,this._superApply=e,b=d.apply(this,arguments),this._super=c,this._superApply=f,b}}()):void(i[b]=d)}),g.prototype=a.widget.extend(h,{widgetEventPrefix:f?h.widgetEventPrefix||b:b},i,{constructor:g,namespace:j,widgetName:b,widgetFullName:e}),f?(a.each(f._childConstructors,function(b,c){var d=c.prototype;a.widget(d.namespace+"."+d.widgetName,g,c._proto)}),delete f._childConstructors):c._childConstructors.push(g),a.widget.bridge(b,g),g},a.widget.extend=function(b){for(var d,e,f=c.call(arguments,1),g=0,h=f.length;g<h;g++)for(d in f[g])e=f[g][d],f[g].hasOwnProperty(d)&&void 0!==e&&(a.isPlainObject(e)?b[d]=a.isPlainObject(b[d])?a.widget.extend({},b[d],e):a.widget.extend({},e):b[d]=e);return b},a.widget.bridge=function(b,d){var e=d.prototype.widgetFullName||b;a.fn[b]=function(f){var g="string"==typeof f,h=c.call(arguments,1),i=this;return g?this.each(function(){var c,d=a.data(this,e);return"instance"===f?(i=d,!1):d?a.isFunction(d[f])&&"_"!==f.charAt(0)?(c=d[f].apply(d,h),c!==d&&void 0!==c?(i=c&&c.jquery?i.pushStack(c.get()):c,!1):void 0):a.error("no such method '"+f+"' for "+b+" widget instance"):a.error("cannot call methods on "+b+" prior to initialization; attempted to call method '"+f+"'")}):(h.length&&(f=a.widget.extend.apply(null,[f].concat(h))),this.each(function(){var b=a.data(this,e);b?(b.option(f||{}),b._init&&b._init()):a.data(this,e,new d(f,this))})),i}},a.Widget=function(){},a.Widget._childConstructors=[],a.Widget.prototype={widgetName:"widget",widgetEventPrefix:"",defaultElement:"<div>",options:{disabled:!1,create:null},_createWidget:function(c,d){d=a(d||this.defaultElement||this)[0],this.element=a(d),this.uuid=b++,this.eventNamespace="."+this.widgetName+this.uuid,this.bindings=a(),this.hoverable=a(),this.focusable=a(),d!==this&&(a.data(d,this.widgetFullName,this),this._on(!0,this.element,{remove:function(a){a.target===d&&this.destroy()}}),this.document=a(d.style?d.ownerDocument:d.document||d),this.window=a(this.document[0].defaultView||this.document[0].parentWindow)),this.options=a.widget.extend({},this.options,this._getCreateOptions(),c),this._create(),this._trigger("create",null,this._getCreateEventData()),this._init()},_getCreateOptions:a.noop,_getCreateEventData:a.noop,_create:a.noop,_init:a.noop,destroy:function(){this._destroy(),this.element.unbind(this.eventNamespace).removeData(this.widgetFullName).removeData(a.camelCase(this.widgetFullName)),this.widget().unbind(this.eventNamespace).removeAttr("aria-disabled").removeClass(this.widgetFullName+"-disabled ui-state-disabled"),this.bindings.unbind(this.eventNamespace),this.hoverable.removeClass("ui-state-hover"),this.focusable.removeClass("ui-state-focus")},_destroy:a.noop,widget:function(){return this.element},option:function(b,c){var d,e,f,g=b;if(0===arguments.length)return a.widget.extend({},this.options);if("string"==typeof b)if(g={},d=b.split("."),b=d.shift(),d.length){for(e=g[b]=a.widget.extend({},this.options[b]),f=0;f<d.length-1;f++)e[d[f]]=e[d[f]]||{},e=e[d[f]];if(b=d.pop(),1===arguments.length)return void 0===e[b]?null:e[b];e[b]=c}else{if(1===arguments.length)return void 0===this.options[b]?null:this.options[b];g[b]=c}return this._setOptions(g),this},_setOptions:function(a){var b;for(b in a)this._setOption(b,a[b]);return this},_setOption:function(a,b){return this.options[a]=b,"disabled"===a&&(this.widget().toggleClass(this.widgetFullName+"-disabled",!!b),b&&(this.hoverable.removeClass("ui-state-hover"),this.focusable.removeClass("ui-state-focus"))),this},enable:function(){return this._setOptions({disabled:!1})},disable:function(){return this._setOptions({disabled:!0})},_on:function(b,c,d){var e,f=this;"boolean"!=typeof b&&(d=c,c=b,b=!1),d?(c=e=a(c),this.bindings=this.bindings.add(c)):(d=c,c=this.element,e=this.widget()),a.each(d,function(d,g){function h(){if(b||f.options.disabled!==!0&&!a(this).hasClass("ui-state-disabled"))return("string"==typeof g?f[g]:g).apply(f,arguments)}"string"!=typeof g&&(h.guid=g.guid=g.guid||h.guid||a.guid++);var i=d.match(/^([\w:-]*)\s*(.*)$/),j=i[1]+f.eventNamespace,k=i[2];k?e.delegate(k,j,h):c.bind(j,h)})},_off:function(b,c){c=(c||"").split(" ").join(this.eventNamespace+" ")+this.eventNamespace,b.unbind(c).undelegate(c),this.bindings=a(this.bindings.not(b).get()),this.focusable=a(this.focusable.not(b).get()),this.hoverable=a(this.hoverable.not(b).get())},_delay:function(a,b){function c(){return("string"==typeof a?d[a]:a).apply(d,arguments)}var d=this;return setTimeout(c,b||0)},_hoverable:function(b){this.hoverable=this.hoverable.add(b),this._on(b,{mouseenter:function(b){a(b.currentTarget).addClass("ui-state-hover")},mouseleave:function(b){a(b.currentTarget).removeClass("ui-state-hover")}})},_focusable:function(b){this.focusable=this.focusable.add(b),this._on(b,{focusin:function(b){a(b.currentTarget).addClass("ui-state-focus")},focusout:function(b){a(b.currentTarget).removeClass("ui-state-focus")}})},_trigger:function(b,c,d){var e,f,g=this.options[b];if(d=d||{},c=a.Event(c),c.type=(b===this.widgetEventPrefix?b:this.widgetEventPrefix+b).toLowerCase(),c.target=this.element[0],f=c.originalEvent)for(e in f)e in c||(c[e]=f[e]);return this.element.trigger(c,d),!(a.isFunction(g)&&g.apply(this.element[0],[c].concat(d))===!1||c.isDefaultPrevented())}},a.each({show:"fadeIn",hide:"fadeOut"},function(b,c){a.Widget.prototype["_"+b]=function(d,e,f){"string"==typeof e&&(e={effect:e});var g,h=e?e===!0||"number"==typeof e?c:e.effect||c:b;e=e||{},"number"==typeof e&&(e={duration:e}),g=!a.isEmptyObject(e),e.complete=f,e.delay&&d.delay(e.delay),g&&a.effects&&a.effects.effect[h]?d[b](e):h!==b&&d[h]?d[h](e.duration,e.easing,f):d.queue(function(c){a(this)[b](),f&&f.call(d[0]),c()})}}),a.widget});
;/*!
 * jQuery UI Mouse 1.11.4
 * http://jqueryui.com
 *
 * Copyright jQuery Foundation and other contributors
 * Released under the MIT license.
 * http://jquery.org/license
 *
 * http://api.jqueryui.com/mouse/
 */
!function(a){"function"==typeof define&&define.amd?define(["jquery","./widget"],a):a(jQuery)}(function(a){var b=!1;return a(document).mouseup(function(){b=!1}),a.widget("ui.mouse",{version:"1.11.4",options:{cancel:"input,textarea,button,select,option",distance:1,delay:0},_mouseInit:function(){var b=this;this.element.bind("mousedown."+this.widgetName,function(a){return b._mouseDown(a)}).bind("click."+this.widgetName,function(c){if(!0===a.data(c.target,b.widgetName+".preventClickEvent"))return a.removeData(c.target,b.widgetName+".preventClickEvent"),c.stopImmediatePropagation(),!1}),this.started=!1},_mouseDestroy:function(){this.element.unbind("."+this.widgetName),this._mouseMoveDelegate&&this.document.unbind("mousemove."+this.widgetName,this._mouseMoveDelegate).unbind("mouseup."+this.widgetName,this._mouseUpDelegate)},_mouseDown:function(c){if(!b){this._mouseMoved=!1,this._mouseStarted&&this._mouseUp(c),this._mouseDownEvent=c;var d=this,e=1===c.which,f=!("string"!=typeof this.options.cancel||!c.target.nodeName)&&a(c.target).closest(this.options.cancel).length;return!(e&&!f&&this._mouseCapture(c))||(this.mouseDelayMet=!this.options.delay,this.mouseDelayMet||(this._mouseDelayTimer=setTimeout(function(){d.mouseDelayMet=!0},this.options.delay)),this._mouseDistanceMet(c)&&this._mouseDelayMet(c)&&(this._mouseStarted=this._mouseStart(c)!==!1,!this._mouseStarted)?(c.preventDefault(),!0):(!0===a.data(c.target,this.widgetName+".preventClickEvent")&&a.removeData(c.target,this.widgetName+".preventClickEvent"),this._mouseMoveDelegate=function(a){return d._mouseMove(a)},this._mouseUpDelegate=function(a){return d._mouseUp(a)},this.document.bind("mousemove."+this.widgetName,this._mouseMoveDelegate).bind("mouseup."+this.widgetName,this._mouseUpDelegate),c.preventDefault(),b=!0,!0))}},_mouseMove:function(b){if(this._mouseMoved){if(a.ui.ie&&(!document.documentMode||document.documentMode<9)&&!b.button)return this._mouseUp(b);if(!b.which)return this._mouseUp(b)}return(b.which||b.button)&&(this._mouseMoved=!0),this._mouseStarted?(this._mouseDrag(b),b.preventDefault()):(this._mouseDistanceMet(b)&&this._mouseDelayMet(b)&&(this._mouseStarted=this._mouseStart(this._mouseDownEvent,b)!==!1,this._mouseStarted?this._mouseDrag(b):this._mouseUp(b)),!this._mouseStarted)},_mouseUp:function(c){return this.document.unbind("mousemove."+this.widgetName,this._mouseMoveDelegate).unbind("mouseup."+this.widgetName,this._mouseUpDelegate),this._mouseStarted&&(this._mouseStarted=!1,c.target===this._mouseDownEvent.target&&a.data(c.target,this.widgetName+".preventClickEvent",!0),this._mouseStop(c)),b=!1,!1},_mouseDistanceMet:function(a){return Math.max(Math.abs(this._mouseDownEvent.pageX-a.pageX),Math.abs(this._mouseDownEvent.pageY-a.pageY))>=this.options.distance},_mouseDelayMet:function(){return this.mouseDelayMet},_mouseStart:function(){},_mouseDrag:function(){},_mouseStop:function(){},_mouseCapture:function(){return!0}})});
;/*!
 * jQuery UI Slider 1.11.4
 * http://jqueryui.com
 *
 * Copyright jQuery Foundation and other contributors
 * Released under the MIT license.
 * http://jquery.org/license
 *
 * http://api.jqueryui.com/slider/
 */
!function(a){"function"==typeof define&&define.amd?define(["jquery","./core","./mouse","./widget"],a):a(jQuery)}(function(a){return a.widget("ui.slider",a.ui.mouse,{version:"1.11.4",widgetEventPrefix:"slide",options:{animate:!1,distance:0,max:100,min:0,orientation:"horizontal",range:!1,step:1,value:0,values:null,change:null,slide:null,start:null,stop:null},numPages:5,_create:function(){this._keySliding=!1,this._mouseSliding=!1,this._animateOff=!0,this._handleIndex=null,this._detectOrientation(),this._mouseInit(),this._calculateNewMax(),this.element.addClass("ui-slider ui-slider-"+this.orientation+" ui-widget ui-widget-content ui-corner-all"),this._refresh(),this._setOption("disabled",this.options.disabled),this._animateOff=!1},_refresh:function(){this._createRange(),this._createHandles(),this._setupEvents(),this._refreshValue()},_createHandles:function(){var b,c,d=this.options,e=this.element.find(".ui-slider-handle").addClass("ui-state-default ui-corner-all"),f="<span class='ui-slider-handle ui-state-default ui-corner-all' tabindex='0'></span>",g=[];for(c=d.values&&d.values.length||1,e.length>c&&(e.slice(c).remove(),e=e.slice(0,c)),b=e.length;b<c;b++)g.push(f);this.handles=e.add(a(g.join("")).appendTo(this.element)),this.handle=this.handles.eq(0),this.handles.each(function(b){a(this).data("ui-slider-handle-index",b)})},_createRange:function(){var b=this.options,c="";b.range?(b.range===!0&&(b.values?b.values.length&&2!==b.values.length?b.values=[b.values[0],b.values[0]]:a.isArray(b.values)&&(b.values=b.values.slice(0)):b.values=[this._valueMin(),this._valueMin()]),this.range&&this.range.length?this.range.removeClass("ui-slider-range-min ui-slider-range-max").css({left:"",bottom:""}):(this.range=a("<div></div>").appendTo(this.element),c="ui-slider-range ui-widget-header ui-corner-all"),this.range.addClass(c+("min"===b.range||"max"===b.range?" ui-slider-range-"+b.range:""))):(this.range&&this.range.remove(),this.range=null)},_setupEvents:function(){this._off(this.handles),this._on(this.handles,this._handleEvents),this._hoverable(this.handles),this._focusable(this.handles)},_destroy:function(){this.handles.remove(),this.range&&this.range.remove(),this.element.removeClass("ui-slider ui-slider-horizontal ui-slider-vertical ui-widget ui-widget-content ui-corner-all"),this._mouseDestroy()},_mouseCapture:function(b){var c,d,e,f,g,h,i,j,k=this,l=this.options;return!l.disabled&&(this.elementSize={width:this.element.outerWidth(),height:this.element.outerHeight()},this.elementOffset=this.element.offset(),c={x:b.pageX,y:b.pageY},d=this._normValueFromMouse(c),e=this._valueMax()-this._valueMin()+1,this.handles.each(function(b){var c=Math.abs(d-k.values(b));(e>c||e===c&&(b===k._lastChangedValue||k.values(b)===l.min))&&(e=c,f=a(this),g=b)}),h=this._start(b,g),h!==!1&&(this._mouseSliding=!0,this._handleIndex=g,f.addClass("ui-state-active").focus(),i=f.offset(),j=!a(b.target).parents().addBack().is(".ui-slider-handle"),this._clickOffset=j?{left:0,top:0}:{left:b.pageX-i.left-f.width()/2,top:b.pageY-i.top-f.height()/2-(parseInt(f.css("borderTopWidth"),10)||0)-(parseInt(f.css("borderBottomWidth"),10)||0)+(parseInt(f.css("marginTop"),10)||0)},this.handles.hasClass("ui-state-hover")||this._slide(b,g,d),this._animateOff=!0,!0))},_mouseStart:function(){return!0},_mouseDrag:function(a){var b={x:a.pageX,y:a.pageY},c=this._normValueFromMouse(b);return this._slide(a,this._handleIndex,c),!1},_mouseStop:function(a){return this.handles.removeClass("ui-state-active"),this._mouseSliding=!1,this._stop(a,this._handleIndex),this._change(a,this._handleIndex),this._handleIndex=null,this._clickOffset=null,this._animateOff=!1,!1},_detectOrientation:function(){this.orientation="vertical"===this.options.orientation?"vertical":"horizontal"},_normValueFromMouse:function(a){var b,c,d,e,f;return"horizontal"===this.orientation?(b=this.elementSize.width,c=a.x-this.elementOffset.left-(this._clickOffset?this._clickOffset.left:0)):(b=this.elementSize.height,c=a.y-this.elementOffset.top-(this._clickOffset?this._clickOffset.top:0)),d=c/b,d>1&&(d=1),d<0&&(d=0),"vertical"===this.orientation&&(d=1-d),e=this._valueMax()-this._valueMin(),f=this._valueMin()+d*e,this._trimAlignValue(f)},_start:function(a,b){var c={handle:this.handles[b],value:this.value()};return this.options.values&&this.options.values.length&&(c.value=this.values(b),c.values=this.values()),this._trigger("start",a,c)},_slide:function(a,b,c){var d,e,f;this.options.values&&this.options.values.length?(d=this.values(b?0:1),2===this.options.values.length&&this.options.range===!0&&(0===b&&c>d||1===b&&c<d)&&(c=d),c!==this.values(b)&&(e=this.values(),e[b]=c,f=this._trigger("slide",a,{handle:this.handles[b],value:c,values:e}),d=this.values(b?0:1),f!==!1&&this.values(b,c))):c!==this.value()&&(f=this._trigger("slide",a,{handle:this.handles[b],value:c}),f!==!1&&this.value(c))},_stop:function(a,b){var c={handle:this.handles[b],value:this.value()};this.options.values&&this.options.values.length&&(c.value=this.values(b),c.values=this.values()),this._trigger("stop",a,c)},_change:function(a,b){if(!this._keySliding&&!this._mouseSliding){var c={handle:this.handles[b],value:this.value()};this.options.values&&this.options.values.length&&(c.value=this.values(b),c.values=this.values()),this._lastChangedValue=b,this._trigger("change",a,c)}},value:function(a){return arguments.length?(this.options.value=this._trimAlignValue(a),this._refreshValue(),void this._change(null,0)):this._value()},values:function(b,c){var d,e,f;if(arguments.length>1)return this.options.values[b]=this._trimAlignValue(c),this._refreshValue(),void this._change(null,b);if(!arguments.length)return this._values();if(!a.isArray(arguments[0]))return this.options.values&&this.options.values.length?this._values(b):this.value();for(d=this.options.values,e=arguments[0],f=0;f<d.length;f+=1)d[f]=this._trimAlignValue(e[f]),this._change(null,f);this._refreshValue()},_setOption:function(b,c){var d,e=0;switch("range"===b&&this.options.range===!0&&("min"===c?(this.options.value=this._values(0),this.options.values=null):"max"===c&&(this.options.value=this._values(this.options.values.length-1),this.options.values=null)),a.isArray(this.options.values)&&(e=this.options.values.length),"disabled"===b&&this.element.toggleClass("ui-state-disabled",!!c),this._super(b,c),b){case"orientation":this._detectOrientation(),this.element.removeClass("ui-slider-horizontal ui-slider-vertical").addClass("ui-slider-"+this.orientation),this._refreshValue(),this.handles.css("horizontal"===c?"bottom":"left","");break;case"value":this._animateOff=!0,this._refreshValue(),this._change(null,0),this._animateOff=!1;break;case"values":for(this._animateOff=!0,this._refreshValue(),d=0;d<e;d+=1)this._change(null,d);this._animateOff=!1;break;case"step":case"min":case"max":this._animateOff=!0,this._calculateNewMax(),this._refreshValue(),this._animateOff=!1;break;case"range":this._animateOff=!0,this._refresh(),this._animateOff=!1}},_value:function(){var a=this.options.value;return a=this._trimAlignValue(a)},_values:function(a){var b,c,d;if(arguments.length)return b=this.options.values[a],b=this._trimAlignValue(b);if(this.options.values&&this.options.values.length){for(c=this.options.values.slice(),d=0;d<c.length;d+=1)c[d]=this._trimAlignValue(c[d]);return c}return[]},_trimAlignValue:function(a){if(a<=this._valueMin())return this._valueMin();if(a>=this._valueMax())return this._valueMax();var b=this.options.step>0?this.options.step:1,c=(a-this._valueMin())%b,d=a-c;return 2*Math.abs(c)>=b&&(d+=c>0?b:-b),parseFloat(d.toFixed(5))},_calculateNewMax:function(){var a=this.options.max,b=this._valueMin(),c=this.options.step,d=Math.floor(+(a-b).toFixed(this._precision())/c)*c;a=d+b,this.max=parseFloat(a.toFixed(this._precision()))},_precision:function(){var a=this._precisionOf(this.options.step);return null!==this.options.min&&(a=Math.max(a,this._precisionOf(this.options.min))),a},_precisionOf:function(a){var b=a.toString(),c=b.indexOf(".");return c===-1?0:b.length-c-1},_valueMin:function(){return this.options.min},_valueMax:function(){return this.max},_refreshValue:function(){var b,c,d,e,f,g=this.options.range,h=this.options,i=this,j=!this._animateOff&&h.animate,k={};this.options.values&&this.options.values.length?this.handles.each(function(d){c=(i.values(d)-i._valueMin())/(i._valueMax()-i._valueMin())*100,k["horizontal"===i.orientation?"left":"bottom"]=c+"%",a(this).stop(1,1)[j?"animate":"css"](k,h.animate),i.options.range===!0&&("horizontal"===i.orientation?(0===d&&i.range.stop(1,1)[j?"animate":"css"]({left:c+"%"},h.animate),1===d&&i.range[j?"animate":"css"]({width:c-b+"%"},{queue:!1,duration:h.animate})):(0===d&&i.range.stop(1,1)[j?"animate":"css"]({bottom:c+"%"},h.animate),1===d&&i.range[j?"animate":"css"]({height:c-b+"%"},{queue:!1,duration:h.animate}))),b=c}):(d=this.value(),e=this._valueMin(),f=this._valueMax(),c=f!==e?(d-e)/(f-e)*100:0,k["horizontal"===this.orientation?"left":"bottom"]=c+"%",this.handle.stop(1,1)[j?"animate":"css"](k,h.animate),"min"===g&&"horizontal"===this.orientation&&this.range.stop(1,1)[j?"animate":"css"]({width:c+"%"},h.animate),"max"===g&&"horizontal"===this.orientation&&this.range[j?"animate":"css"]({width:100-c+"%"},{queue:!1,duration:h.animate}),"min"===g&&"vertical"===this.orientation&&this.range.stop(1,1)[j?"animate":"css"]({height:c+"%"},h.animate),"max"===g&&"vertical"===this.orientation&&this.range[j?"animate":"css"]({height:100-c+"%"},{queue:!1,duration:h.animate}))},_handleEvents:{keydown:function(b){var c,d,e,f,g=a(b.target).data("ui-slider-handle-index");switch(b.keyCode){case a.ui.keyCode.HOME:case a.ui.keyCode.END:case a.ui.keyCode.PAGE_UP:case a.ui.keyCode.PAGE_DOWN:case a.ui.keyCode.UP:case a.ui.keyCode.RIGHT:case a.ui.keyCode.DOWN:case a.ui.keyCode.LEFT:if(b.preventDefault(),!this._keySliding&&(this._keySliding=!0,a(b.target).addClass("ui-state-active"),c=this._start(b,g),c===!1))return}switch(f=this.options.step,d=e=this.options.values&&this.options.values.length?this.values(g):this.value(),b.keyCode){case a.ui.keyCode.HOME:e=this._valueMin();break;case a.ui.keyCode.END:e=this._valueMax();break;case a.ui.keyCode.PAGE_UP:e=this._trimAlignValue(d+(this._valueMax()-this._valueMin())/this.numPages);break;case a.ui.keyCode.PAGE_DOWN:e=this._trimAlignValue(d-(this._valueMax()-this._valueMin())/this.numPages);break;case a.ui.keyCode.UP:case a.ui.keyCode.RIGHT:if(d===this._valueMax())return;e=this._trimAlignValue(d+f);break;case a.ui.keyCode.DOWN:case a.ui.keyCode.LEFT:if(d===this._valueMin())return;e=this._trimAlignValue(d-f)}this._slide(b,g,e)},keyup:function(b){var c=a(b.target).data("ui-slider-handle-index");this._keySliding&&(this._keySliding=!1,this._stop(b,c),this._change(b,c),a(b.target).removeClass("ui-state-active"))}}})});