function include(url) {
    document.write('<script type="text/javascript" src="' + url + '"></script>')
}
include('js/jquery.easing.js');
include('js/jquery.mousewheel.min.js');
include('js/jquery-ui-1.10.3.custom.min.js');
include('js/jquery.ui.touch-punch.js');
include('js/jquery.touchSwipe.min.js');
include("js/jquery-migrate-1.1.1.js");
include('js/klass.min.js');
include("js/owl.carousel.js");
include('js/spin.min.js');
include('js/tmMultimediaGallery.js');
include('js/jquery.equalheights.js');
if (!FJSCore.mobile && !FJSCore.tablet) {
    include('js/jquery.superscrollorama.js');
}
if (!FJSCore.mobile) {
    include('js/hoverIntent.js');
    include('js/superfish.js');
    include('js/greensock/TweenMax.min.js');
    include("js/jquery.ui.totop.js");
} else {
}
var win = $(window), doc = $(document), previousState = currentState = '', defLocation, msie = (navigator.appVersion.indexOf("MSIE") !== -1);
currIndex = 0, showGallery = false;
function spinnerInit() {
    var opts = {
        lines: 11,
        length: 10,
        width: 5,
        radius: 14,
        corners: 1,
        color: '#fff',
        speed: 1.3,
        trail: 5
    }, spinner = new Spinner(opts).spin($('#webSiteLoader')[0]);
}
function spinnerInitGallery() {
    var opts = {lines: 11, length: 10, width: 5, radius: 14, corners: 1, color: '#fff', speed: 1.3, trail: 5}
    $('.imgSpinner').each(function () {
        var spinner = new Spinner(opts).spin($(this)[0]);
    })
}
function initCarousel() {
    var $owl = $("#owl1");
    $owl.owlCarousel({
        items: 4,
        itemsDesktop: [1220, 2],
        itemsDesktopSmall: [670, 2],
        itemsTablet: [500, 2],
        itemsMobile: [479, 1],
        navigation: true,
        pagination: false
    });
}
function initCarousel_2() {
    var $owl = $("#owl2");
    $owl.owlCarousel({
        items: 4,
        itemsDesktop: [1220, 2],
        itemsDesktopSmall: [670, 2],
        itemsTablet: [500, 2],
        itemsMobile: [479, 1],
        navigation: true,
        pagination: false
    });
}
function initCarousel_1() {
    var $owl = $("#owl_1");
    $owl.owlCarousel({
        items: 4,
        itemsDesktop: [1220, 2],
        itemsDesktopSmall: [670, 2],
        itemsTablet: [500, 2],
        itemsMobile: [479, 1],
        navigation: true,
        pagination: false
    });
}
function initCarousel2_1() {
    var $owl = $("#owl2_1");
    $owl.owlCarousel({
        items: 4,
        itemsDesktop: [1220, 2],
        itemsDesktopSmall: [670, 2],
        itemsTablet: [500, 2],
        itemsMobile: [479, 1],
        navigation: true,
        pagination: false
    });
}


function initGalleryImagesPosition(t){
    t.each(function(){


        var circPaddingBottom = $(this).find(".circ").css("paddingBottom");
        circPaddingBottom = circPaddingBottom.replace("px","");
        var circHeight = parseInt(circPaddingBottom) + parseInt($(this).find(".circ").height());

        var heightImage = $(this).find("a").find("img").height();
        var heightContainerImage = $(this).height() - circHeight;

        //alert($(this).find("a").find("img").attr("src"));
        //alert(heightImage + " -- " + heightContainerImage);

        if(heightImage < heightContainerImage){
            var marginTop = (heightContainerImage - heightImage) / 2;
            $(this).find("a").find("img").css("marginTop", marginTop);

        }else{
            $(this).find("a").find("img").css("marginTop", 0);
        };


    });
}


function initPlugins() {
    (!FJSCore.mobile && previousState && (FJSCore.state != previousState)) && ($('.historyBack').attr('href', './' + previousState));
    if (!FJSCore.mobile) {
        $().UItoTop({easingType: 'easeOutQuart'});
    }
    $(".galleryHolder").tmMultimediaGallery({
        startIndex: 0,
        showOnInit: showGallery,
        container: '.galleryContainer',
        imageHolder: '.imageHolder',
        pagination: '.inner',
        description: '.galleryDiscription',
        next: '.nextButton',
        prev: '.prevButton',
        spinner: '.imgSpinner',
        autoPlayState: false,
        paginationDisplay: true,
        controlDisplay: true,
        autoPlayTime: 12,
        alignIMG: 'center',
        mobile: false,
        onShowActions: function () {
            $("#other_pages").css('zIndex', 9999);

            /*
            $('#camera-slideshow').camera({
                alignment			: "center", //topLeft, topCenter, topRight, centerLeft, center, centerRight, bottomLeft, bottomCenter, bottomRight
                autoAdvance				: true,	//true, false
                mobileAutoAdvance	: true, //true, false. Auto-advancing for mobile devices

                barDirection			: "leftToRight",	//'leftToRight', 'rightToLeft', 'topToBottom', 'bottomToTop'
                barPosition				: "bottom",	//'bottom', 'left', 'top', 'right'
                cols							: 6,
                easing						: "easeInOutQuad",	//for the complete list https://jqueryui.com/demos/effect/easing.html
                mobileEasing			: "easeInOutExpo",	//leave empty if you want to display the same easing on mobile devices and on desktop etc.
                fx								: "simpleFade",
                mobileFx					: "simpleFade",		//leave empty if you want to display the same effect on mobile devices and on desktop etc.
                gridDifference		: 250,	//to make the grid blocks slower than the slices, this value must be smaller than transPeriod
                height						: "auto",	//here you can type pixels (for instance '300px'), a percentage (relative to the width of the slideshow, for instance '50%') or 'auto'
                // imagePath					: 'images/',	//the path to the image folder (it serves for the blank.gif, when you want to display videos)
                hover							: true,	//true, false. Puase on state hover. Not available for mobile devices
                loader						: "none",	//pie, bar, none (even if you choose "pie", old browsers like IE8- can't display it... they will display always a loading bar)
                loaderColor				: "#eeeeee",
                loaderBgColor			: "#222222",
                loaderOpacity			: .8,	//0, .1, .2, .3, .4, .5, .6, .7, .8, .9, 1
                loaderPadding			: 2,	//how many empty pixels you want to display between the loader and its background
                loaderStroke			: 7,	//the thickness both of the pie loader and of the bar loader. Remember: for the pie, the loader thickness must be less than a half of the pie diameter
                minHeight					: "200px",	//you can also leave it blank
                navigation				: true,	//true or false, to display or not the navigation buttons
                navigationHover		: false,	//if true the navigation button (prev, next and play/stop buttons) will be visible on hover state only, if false they will be 	visible always
                mobileNavHover		: true,	//same as above, but only for mobile devices
                opacityOnGrid			: false,	//true, false. Decide to apply a fade effect to blocks and slices: if your slideshow is fullscreen or simply big, I recommend to set it false to have a smoother effect
                overlayer					: false,	//a layer on the images to prevent the users grab them simply by clicking the right button of their mouse (.camera_overlayer)
                pagination				: false,
                playPause					: false,	//true or false, to display or not the play/pause buttons
                pauseOnClick			: false,	//true, false. It stops the slideshow when you click the sliders.
                pieDiameter				: 38,
                piePosition				: "rightTop",	//'rightTop', 'leftTop', 'leftBottom', 'rightBottom'
                portrait					: false, //true, false. Select true if you don't want that your images are cropped
                rows							: 4,
                slicedCols				: 6,	//if 0 the same value of cols
                slicedRows				: 4,	//if 0 the same value of rows
                // slideOn				: "",	//next, prev, random: decide if the transition effect will be applied to the current (prev) or the next slide
                thumbnails				: false,
                time							: 7000,	//milliseconds between the end of the sliding effect and the start of the nex one
                transPeriod				: 800	//lenght of the sliding effect in milliseconds
                // onEndTransition		: function() {  },	//this callback is invoked when the transition effect ends
                // onLoaded					: function() {  },	//this callback is invoked when the image on a slide has completely loaded
                // onStartLoading		: function() {  },	//this callback is invoked when the image on a slide start loading
                // onStartTransition	: function() {  }	//this callback is invoked when the transition effect starts
            });


            $('ul.sf-menu')

                .superfish({
                    hoverClass:    'sfHover',
                    pathClass:     'overideThisToUse',
                    pathLevels:    1,
                    delay:         500,
                    animation:     {opacity:'show', height:'show'},
                    speed:         'normal',
                    speedOut:      'fast',
                    autoArrows:    false,
                    disableHI:     false,
                    useClick:      0,
                    easing:        "swing",
                    onInit:        function(){},
                    onBeforeShow:  function(){},
                    onShow:        function(){},
                    onHide:        function(){},
                    onIdle:        function(){}
                });


            $('.sf-menu').mobileMenu({});

            var ismobile = navigator.userAgent.match(/(iPhone)|(iPod)|(android)|(webOS)/i)
            if(ismobile){
                $('.sf-menu').sftouchscreen({});
            }
            */



        },
        onHideActions: function () {
        }
    })
    $('.closeIconGallery').on('click', function () {
        $(".galleryHolder").trigger('hideGallery');
        $("#other_pages").css('zIndex', 0);
    });
    $('.closeIconGalleryMobile').on('click', function () {

        //alert("close");
        $(".ajax-page").css("display", "none");
        /*
         display: block;
         opacity: 1;
         overflow-y: scroll;
         top: 0px;
         */
        $("#page2").css("display", "block");

        $(".galleryHolder").trigger('hideGallery');
        $("#other_pages").css('zIndex', 0);

    });



    spinnerInitGallery();
    setTimeout(function () {
        win.trigger('resize');
    }, 500);
    spinnerInit();
}
function scrolloramaInit() {
    if (!FJSCore.mobile && !FJSCore.tablet) {
        var controller = $.superscrollorama();
        controller.addTween('#page1 .p1', TweenMax.from($('#page1 .p1'), 0.8, {
            delay: 0.4,
            css: {opacity: 0, scale: 0.2, rotation: 90, marginTop: -200},
            ease: Expo.easeOut
        })).addTween('#page1 .p2', TweenMax.from($('#page1 .p2'), 1.7, {
            delay: 1.3,
            css: {left: '-50%', opacity: 0},
            ease: Cubic.easeOut
        }), 0, -100).addTween('#page1 .p3', TweenMax.from($('#page1 .p3'), 1.7, {
            delay: 1.3,
            css: {right: '-50%', opacity: 0},
            ease: Cubic.easeOut
        }), 0, -200).addTween('#page1 .s_p', TweenMax.from($('#page1 .s_p'), 1.7, {
            delay: 1.3,
            css: {left: '-50%', opacity: 0},
            ease: Cubic.easeOut
        }), 0, -250).addTween('header', TweenMax.from($('header'), .5, {
            delay: 0.8,
            css: {top: -100},
            ease: Cubic.easeOut
        })).addTween('.slogan_block_1', TweenMax.from($('.slogan_block_1'), .5, {
            delay: 0.8,
            css: {opacity: 0, scale: 0.2},
            ease: Cubic.easeOut
        }), 0, -250).addTween('#page2 #owl1 .item', TweenMax.from($('#page2 #owl1 .item'), 1.7, {
            delay: 1.3,
            css: {left: '-50%', opacity: 0},
            ease: Cubic.easeOut
        }), 0, -250).addTween('#page2_1 #owl_1 .item', TweenMax.from($('#page2_1 #owl_1 .item'), 1.7, {
            delay: 1.3,
            css: {left: '-50%', opacity: 0},
            ease: Cubic.easeOut
        }), 0, -250).addTween('#page2 h2', TweenMax.from($('#page2 h2'), 1.7, {
            delay: 0.2,
            css: {left: -1000, opacity: 0},
            ease: Cubic.easeOut
        }), 0).addTween('#page2_1 h2', TweenMax.from($('#page2_1 h2'), 1.7, {
            delay: 0.2,
            css: {left: -1000, opacity: 0},
            ease: Cubic.easeOut
        }), 0).addTween('#page3 h2', TweenMax.from($('#page3 h2'), .7, {
            delay: 0.6,
            css: {right: '-50%', opacity: 0},
            ease: Cubic.easeOut
        }), -250).addTween('#page3 .p3_pic1', TweenMax.from($('#page3 .p3_pic1'), 0.7, {
            delay: 0.1,
            css: {right: '-100%', opacity: 0, scale: 0.2, rotation: 90},
            ease: Cubic.easeOut
        }), 0, -300).addTween('#page3 .p3_pic2', TweenMax.from($('#page3 .p3_pic2'), 0.8, {
            delay: 0.1,
            css: {left: '-100%', opacity: 0, scale: 0.2, rotation: 90},
            ease: Cubic.easeOut
        }), 0, -250).addTween('#page3 .p3_pic3', TweenMax.from($('#page3 .p3_pic3'), 0.5, {
            delay: 0.1,
            css: {right: '-100%', opacity: 0, scale: 0.2, rotation: 90},
            ease: Cubic.easeOut
        }), 0, -250).addTween('#page3 .p3_pic4', TweenMax.from($('#page3 .p3_pic4'), 0.1, {
            delay: 0.1,
            css: {left: '-100%', opacity: 0, scale: 0.2, rotation: 90},
            ease: Cubic.easeOut
        }), 0, -250).addTween('#page3 .p3_pic5', TweenMax.from($('#page3 .p3_pic5'), 0.7, {
            delay: 0.1,
            css: {right: '-100%', opacity: 0, scale: 0.2, rotation: 90},
            ease: Cubic.easeOut
        }), 0, -250).addTween('#page3 .p3_pic6', TweenMax.from($('#page3 .p3_pic6'), .7, {
            delay: 0.1,
            css: {left: '-100%', opacity: 0, scale: 0.2, rotation: 90},
            ease: Cubic.easeOut
        }), 0, -250).addTween('#page3 .p3_pic7', TweenMax.from($('#page3 .p3_pic7'), 0.7, {
            delay: 0.1,
            css: {right: '-100%', opacity: 0, scale: 0.2, rotation: 90},
            ease: Cubic.easeOut
        }), 0, -250).addTween('#page3 p', TweenMax.from($('#page3 p'), .7, {
            delay: 0.4,
            css: {bottom: '-100px', opacity: 0},
            ease: Cubic.easeOut
        }), 0, -250).addTween('#page4 h2', TweenMax.from($('#page4 h2'), .7, {
            delay: 0.6,
            css: {left: '-50%', opacity: 0},
            ease: Cubic.easeOut
        }), -350).addTween('#page4 .list_1', TweenMax.from($('#page4 .list_1'), .7, {
            delay: 1.4,
            css: {right: '-100%', opacity: 0, scale: 0.2},
            ease: Cubic.easeOut
        }), 0, -200).addTween('#page4 .tab_resize', TweenMax.from($('#page4 .tab_resize'), .7, {
            delay: 1.3,
            css: {scale: 0.2, opacity: 0},
            ease: Cubic.easeOut
        }), 0, -500).addTween('#page5 .p5_pic1', TweenMax.from($('#page5 .p5_pic1'), .7, {
            delay: 0.4,
            css: {right: '-100%', opacity: 0, scale: 0.2},
            ease: Cubic.easeOut
        }), 0, -300).addTween('#page5 h2', TweenMax.from($('#page5 h2'), .7, {
            delay: 0.6,
            css: {left: '-50%', opacity: 0},
            ease: Cubic.easeOut
        }), 0, -300).addTween('#page5 p', TweenMax.from($('#page5 p'), .7, {
            delay: 0.6,
            css: {right: '-50%', opacity: 0},
            ease: Cubic.easeOut
        }), 0, -300).addTween('#page5 .list_2', TweenMax.from($('#page5 .list_2'), .7, {
            delay: 0.6,
            css: {right: '-50%', opacity: 0},
            ease: Cubic.easeOut
        }), 0, -300).addTween('#page6', TweenMax.from($('#page6'), .7, {
            delay: 0.6,
            css: {bottom: '-200', opacity: 0},
            ease: Cubic.easeOut
        }), 0, -300).addTween('#page4_1 h2', TweenMax.from($('#page4_1 h2'), .7, {
            delay: 0.6,
            css: {right: '-50%', opacity: 0},
            ease: Cubic.easeOut
        }), -250).addTween('#page4_1 .p3_pic1', TweenMax.from($('#page4_1 .p3_pic1'), 0.7, {
            delay: 0.1,
            css: {right: '-100%', opacity: 0, scale: 0.2, rotation: 90},
            ease: Cubic.easeOut
        }), 0, -300).addTween('#page4_1 .p3_pic2', TweenMax.from($('#page4_1 .p3_pic2'), 0.8, {
            delay: 0.1,
            css: {left: '-100%', opacity: 0, scale: 0.2, rotation: 90},
            ease: Cubic.easeOut
        }), 0, -250).addTween('#page4_1 .p3_pic3', TweenMax.from($('#page4_1 .p3_pic3'), 0.5, {
            delay: 0.1,
            css: {right: '-100%', opacity: 0, scale: 0.2, rotation: 90},
            ease: Cubic.easeOut
        }), 0, -250).addTween('#page4_1 .p3_pic4', TweenMax.from($('#page4_1 .p3_pic4'), 0.1, {
            delay: 0.1,
            css: {left: '-100%', opacity: 0, scale: 0.2, rotation: 90},
            ease: Cubic.easeOut
        }), 0, -250).addTween('#page4_1 .p3_pic5', TweenMax.from($('#page4_1 .p3_pic5'), 0.7, {
            delay: 0.1,
            css: {right: '-100%', opacity: 0, scale: 0.2, rotation: 90},
            ease: Cubic.easeOut
        }), 0, -250).addTween('#page4_1 .p3_pic6', TweenMax.from($('#page4_1 .p3_pic6'), .7, {
            delay: 0.1,
            css: {left: '-100%', opacity: 0, scale: 0.2, rotation: 90},
            ease: Cubic.easeOut
        }), 0, -250).addTween('#page4_1 .p3_pic7', TweenMax.from($('#page4_1 .p3_pic7'), 0.7, {
            delay: 0.1,
            css: {right: '-100%', opacity: 0, scale: 0.2, rotation: 90},
            ease: Cubic.easeOut
        }), 0, -250).addTween('#page4_1 p', TweenMax.from($('#page4_1 p'), .7, {
            delay: 0.4,
            css: {bottom: '-100px', opacity: 0},
            ease: Cubic.easeOut
        }), 0, -250)
    }
}
$(document).on('changeLocation', function (e) {
    previousState = currentState;
    currentState = history.state;
})
$(document).on('changeState', function (e) {
})
$(function () {
    $("#year").text((new Date).getFullYear());
    $("#year1").text((new Date).getFullYear());
    previousState = currentState = history.state;
    $('#mainNav>ul>li>a').each(function () {
        var $this = $(this), txt = $this.text();
        $this.html('<div><span>' + txt + '</span></div><div><span>' + txt + '</span></div>');
    })
    initPlugins();
    if (FJSCore.mobile) {

        $('body').css({'min-width': 'inherit'});
        $(document).on('show', '#mobile-content>*', function (e, d) {
            initPlugins();
            $('.galleryHolder').trigger('showGallery');
            $(".folioList > li").click(function () {
                var instance = Code.photoSwipe('.photoSwipe1 a', this);
                Code.PhotoSwipe.Current.show(0);
            })
        }).on('hide', '#mobile-content>*', function (e, d) {
        })
    } else {
        $('#mainNav').superfish({animation: {height: 'show'}, animationOut: {height: 'hide'}, delay: 500});
        spinnerInit();
        scrolloramaInit();
    }
    var otherPageContainer = $('#other_pages'), $selector = !msie ? $('body') : $('html');


var trigger = 0;

    otherPageContainer.on('show', '>*', function (e, d) {
        $.when(d.elements).then(function () {
            $('a[href="./' + FJSCore.state + '"]').parents('.item').trigger('click');
            $('#category_pages .closeBtn').addClass('fa fa-times');
            if (!d.curr.hasClass('_active')) {
                d.curr.stop().css({display: 'block', opacity: 0}).animate({opacity: 1}, {
                    duration: 200,
                    complete: function () {
                        d.curr.addClass('_active');
                        win.trigger('resize');

                    }
                })
            }
            initPlugins();
            $('.galleryHolder').trigger('showGallery');
            $('body').addClass('show-sub-pages');
            d.curr.addClass('activeSubPage').stop(true, true).css({
                display: 'block',
                top: -$(window).outerHeight()
            }).animate({top: 0}, {
                duration: 800, ease: 'easeOutExpo', complete: function () {
                    FJSCore.modules.longScroller.blockScrollCalc = true;
                    $selector.css({'overflow': 'hidden', '-webkit-overflow-scrolling': 'none'});
                    $('body').trigger('resizeContent');
                    //trigger = 1;

                    //alert("==");


                    $(".closeIcon").off();
                    $(".closeIcon").on('click', function (e){
                        //trigger = 1;
                        //alert("==");


                        FJSCore.modules.longScroller.blockScrollCalc = false;
                        $(this).removeClass('activeSubPage').stop(true, true).animate({top: -$(window).outerHeight()}, {
                            duration: 800,
                            ease: 'easeInExpo',
                            complete: function () {
                                $(this).css({display: 'none'});
                                $selector.css({'overflow': 'visible', '-webkit-overflow-scrolling': 'touch'});
                                $('body').removeClass('show-sub-pages');
                                $('body').trigger('resizeContent');
                                $(".activeSubPage").slideToggle(500);
                            }
                        });
                        //



                    });



                }
            })
        });

    });




    otherPageContainer.on('hide', '>*', function (e, d){
        /*if(trigger == 0){
            trigger = 1;
            return false;
        }

        FJSCore.modules.longScroller.blockScrollCalc = false;
        $(this).removeClass('activeSubPage').stop(true, true).animate({top: -$(window).outerHeight()}, {
            duration: 800,
            ease: 'easeInExpo',
            complete: function () {
                $(this).css({display: 'none'});
                $selector.css({'overflow': 'visible', '-webkit-overflow-scrolling': 'touch'});
                $('body').removeClass('show-sub-pages');
                $('body').trigger('resizeContent');
            }
        });
        */
        //trigger = 1;
    });





    /*.on('hide', '>*', function (e, d){
        //if(trigger == 0){
        //    trigger = 1;
        //    return false;
        //}

        FJSCore.modules.longScroller.blockScrollCalc = false;
        $(this).removeClass('activeSubPage').stop(true, true).animate({top: -$(window).outerHeight()}, {
            duration: 800,
            ease: 'easeInExpo',
            complete: function () {
                $(this).css({display: 'none'});
                $selector.css({'overflow': 'visible', '-webkit-overflow-scrolling': 'touch'});
                $('body').removeClass('show-sub-pages');
                $('body').trigger('resizeContent');
            }
        });
        //trigger = 1;
    })*/





})
win.load(function () {
    if (!FJSCore.mobile) {
    }


    initCarousel();
    initCarousel_2();
    initCarousel_1();
    initCarousel2_1();
    
    $("#webSiteLoader").fadeOut(500, 0, function () {
        $(this).remove();
        win.trigger('resize').trigger('scroll').trigger('afterload');
        $('body').trigger('resizeContent');
    });
    FJSCore.modules.responsiveContainer({
        elementsSelector: '#other_pages>div',
        affectSelectors: '',
        type: 'inner',
        defStates: ',about,contacts,members'
    });
    win.trigger('resize');
    if (FJSCore.mobile) {
        $('#mobile-header>*').wrapAll('<div class="container"></div>');
        $('#mobile-footer>*').wrapAll('<div class="container"></div>');
    }



    initGalleryImagesPosition($('#owl1 .box'));

    initGalleryImagesPosition($('#owl_1 .box'));

    if (FJSCore.mobile) {
        $("html.mobile #owl2 .item a").on('click', function () {
            $(".ajax-page").show();
        });
    }


});





