<?php
/**
 * Created by PhpStorm.
 * User: GSU
 * Date: 23.07.2017
 * Time: 23:11
 */
require $_SERVER['DOCUMENT_ROOT'] . '/wp-load.php';
include $_SERVER['DOCUMENT_ROOT'] . '/includes/head.php';

global $wpdb;
$wpdb->set_prefix('portfolio_');

include $_SERVER['DOCUMENT_ROOT'] . '/includes/head_detail.php';
?>


<!DOCTYPE html>
<html lang="en-US" class="no-js">
<head>
    <?php
    include $_SERVER['DOCUMENT_ROOT'] . '/includes/head_css.php';
    include $_SERVER['DOCUMENT_ROOT'] . '/includes/head_custom_css.php';
    include $_SERVER['DOCUMENT_ROOT'] . '/includes/head_main.php';
    ?>
</head>
<body class="page-template-default page page-id-16545 wpb-js-composer js-comp-ver-5.1 vc_responsive">
<nav
    class="navbar navbar-default navbar-fixed-top nav-transparent overlay-nav sticky-nav nav-dark  header-top-logo  nav-white "
    data-menu-hover-delay="100">
    <div class="container">
        <div class="row">
            <?php
            include $_SERVER['DOCUMENT_ROOT'] . '/includes/head_logo_white-4.php';
            ?>
            <div class="navbar-header col-sm-8 sm-width-auto col-xs-2 pull-right">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse"><span
                        class="sr-only">Toggle navigation</span> <span class="icon-bar"></span> <span
                        class="icon-bar"></span> <span class="icon-bar"></span></button>
            </div>
            <div class="col-md-8 no-padding-right accordion-menu text-right">
                <div id="mega-menu" class="navbar-collapse collapse navbar-left">
                    <ul id="menu-main-menu" class="mega-menu-ul nav navbar-nav navbar-left panel-group">
                        <?php
                        include $_SERVER['DOCUMENT_ROOT'] . '/includes/main_menu.php';
                        ?>
                    </ul>
                </div>
            </div>

        </div>
    </div>
</nav>
<section class="parent-section no-padding post-16545 page type-page status-publish hentry">
    <div class="container-fluid">
        <div class="row">
            <div class="entry-content">
                <section id="slider" class=" slider no-padding">
                    <div class="wpb_column hcode-column-container  col-xs-mobile-fullwidth">
                        <div class="vc-column-innner-wrapper">
                            <div class="wpb_revslider_element wpb_content_element">
                                <div id="rev_slider_49_1_wrapper" class="rev_slider_wrapper fullwidthbanner-container"
                                     data-source="gallery"
                                     style="margin:0px auto;background:#ffffff;padding:0px;margin-top:0px;margin-bottom:0px;background-image:url(http://revolution5.themepunch.com/wp-content/);background-repeat:no-repeat;background-size:cover;background-position:center center;">
                                    <div id="rev_slider_49_1" class="rev_slider fullwidthabanner tp-overflow-hidden"
                                         style="display:none;" data-version="5.4.1">
                                        <ul>


                                            <?php foreach($arProjectAllImages as $keyImage => $image){ ?>
                                                <?php
                                                $filename = $image;
                                                $fileNew = "/wp-content/uploads/" . basename($filename);

                                                $fileNew = cropImage($filename,
                                                    $_SERVER['DOCUMENT_ROOT'] . $fileNew,
                                                    100, 50);
                                                ?>

                                            <li data-index="rs-<?php echo $keyImage; ?>"
                                                data-transition="slideleft" data-slotamount="7"
                                                data-hideafterloop="0" data-hideslideonmobile="off"
                                                data-easein="Linear.easeNone" data-easeout="Power0.easeInOut"
                                                data-masterspeed="300"
                                                data-link="#"
                                                data-thumb="<?php echo $fileNew; ?>"
                                                data-rotate="0" data-saveperformance="off" data-title="Discover"
                                                data-param1="" data-param2="" data-param3="" data-param4=""
                                                data-param5="" data-param6="" data-param7="" data-param8=""
                                                data-param9="" data-param10="" data-description=""><img
                                                    src="<?php echo $image; ?>"
                                                    alt="" title="Top Logo" data-bgposition="center center"
                                                    data-kenburns="on" data-duration="10000" data-ease="Power0.easeIn"
                                                    data-scalestart="100" data-scaleend="100" data-rotatestart="0"
                                                    data-rotateend="0" data-blurstart="0" data-blurend="0"
                                                    data-offsetstart="500 500" data-offsetend="500 500"
                                                    class="rev-slidebg" data-no-retina></li>
                                            <?php } ?>



                                        </ul>
                                        <script>/*<![CDATA[*/
                                            var htmlDiv = document.getElementById("rs-plugin-settings-inline-css");
                                            var htmlDivCss = "";
                                            if (htmlDiv) {
                                                htmlDiv.innerHTML = htmlDiv.innerHTML + htmlDivCss;
                                            } else {
                                                var htmlDiv = document.createElement("div");
                                                htmlDiv.innerHTML = "<style>" + htmlDivCss + "</style>";
                                                document.getElementsByTagName("head")[0].appendChild(htmlDiv.childNodes[0]);
                                            }
                                            /*]]>*/</script>
                                        <div class="tp-bannertimer tp-bottom"
                                             style="visibility: hidden !important;"></div>
                                    </div>
                                    <script>/*<![CDATA[*/
                                        var htmlDiv = document.getElementById("rs-plugin-settings-inline-css");
                                        var htmlDivCss = "";
                                        if (htmlDiv) {
                                            htmlDiv.innerHTML = htmlDiv.innerHTML + htmlDivCss;
                                        } else {
                                            var htmlDiv = document.createElement("div");
                                            htmlDiv.innerHTML = "<style>" + htmlDivCss + "</style>";
                                            document.getElementsByTagName("head")[0].appendChild(htmlDiv.childNodes[0]);
                                        }
                                        /*]]>*/</script>
                                    <script type="text/javascript">/*<![CDATA[*/
                                        var setREVStartSize = function () {
                                            try {
                                                var e = new Object, i = jQuery(window).width(), t = 9999, r = 0, n = 0,
                                                    l = 0, f = 0, s = 0, h = 0;
                                                e.c = jQuery('#rev_slider_49_1');
                                                e.responsiveLevels = [1240, 1024, 1024, 1024];
                                                e.gridwidth = [1180, 640, 480, 480];
                                                e.gridheight = [991, 720, 480, 360];
                                                e.sliderLayout = "fullwidth";
                                                if (e.responsiveLevels && (jQuery.each(e.responsiveLevels, function (e, f) {
                                                        f > i && (t = r = f, l = e), i > f && f > r && (r = f, n = e)
                                                    }), t > r && (l = n)), f = e.gridheight[l] || e.gridheight[0] || e.gridheight, s = e.gridwidth[l] || e.gridwidth[0] || e.gridwidth, h = i / s, h = h > 1 ? 1 : h, f = Math.round(h * f), "fullscreen" == e.sliderLayout) {
                                                    var u = (e.c.width(), jQuery(window).height());
                                                    if (void 0 != e.fullScreenOffsetContainer) {
                                                        var c = e.fullScreenOffsetContainer.split(",");
                                                        if (c) jQuery.each(c, function (e, i) {
                                                            u = jQuery(i).length > 0 ? u - jQuery(i).outerHeight(!0) : u
                                                        }), e.fullScreenOffset.split("%").length > 1 && void 0 != e.fullScreenOffset && e.fullScreenOffset.length > 0 ? u -= jQuery(window).height() * parseInt(e.fullScreenOffset, 0) / 100 : void 0 != e.fullScreenOffset && e.fullScreenOffset.length > 0 && (u -= parseInt(e.fullScreenOffset, 0))
                                                    }
                                                    f = u
                                                } else void 0 != e.minHeight && f < e.minHeight && (f = e.minHeight);
                                                e.c.closest(".rev_slider_wrapper").css({height: f})
                                            } catch (d) {
                                                console.log("Failure at Presize of Slider:" + d)
                                            }
                                        };
                                        setREVStartSize();
                                        var tpj = jQuery;
                                        tpj.noConflict();
                                        var revapi49;
                                        tpj(document).ready(function () {
                                            if (tpj("#rev_slider_49_1").revolution == undefined) {
                                                revslider_showDoubleJqueryError("#rev_slider_49_1");
                                            } else {
                                                revapi49 = tpj("#rev_slider_49_1").show().revolution({
                                                    sliderType: "carousel",
                                                    jsFileLocation: "//wpdemos.themezaa.com/h-code/wp-content/plugins/revslider/public/assets/js/",
                                                    sliderLayout: "fullwidth",
                                                    dottedOverlay: "none",
                                                    delay: 9000,
                                                    navigation: {
                                                        keyboardNavigation: "off",
                                                        keyboard_direction: "horizontal",
                                                        mouseScrollNavigation: "off",
                                                        mouseScrollReverse: "default",
                                                        onHoverStop: "off",
                                                        touch: {
                                                            touchenabled: "on",
                                                            touchOnDesktop: "off",
                                                            swipe_threshold: 75,
                                                            swipe_min_touches: 1,
                                                            swipe_direction: "horizontal",
                                                            drag_block_vertical: false
                                                        },
                                                        arrows: {
                                                            style: "gyges",
                                                            enable: true,
                                                            hide_onmobile: false,
                                                            hide_onleave: false,
                                                            tmp: '',
                                                            left: {
                                                                h_align: "left",
                                                                v_align: "center",
                                                                h_offset: 20,
                                                                v_offset: 0
                                                            },
                                                            right: {
                                                                h_align: "right",
                                                                v_align: "center",
                                                                h_offset: 20,
                                                                v_offset: 0
                                                            }
                                                        }
                                                    },
                                                    carousel: {
                                                        horizontal_align: "center",
                                                        vertical_align: "center",
                                                        fadeout: "on",
                                                        vary_fade: "on",
                                                        maxVisibleItems: 3,
                                                        infinity: "on",
                                                        space: 0,
                                                        stretch: "off",
                                                        showLayersAllTime: "off",
                                                        easing: "Power3.easeInOut",
                                                        speed: "800"
                                                    },
                                                    responsiveLevels: [1240, 1024, 1024, 1024],
                                                    visibilityLevels: [1240, 1024, 1024, 1024],
                                                    gridwidth: [1180, 640, 480, 480],
                                                    gridheight: [991, 720, 480, 360],
                                                    lazyType: "none",
                                                    shadow: 0,
                                                    spinner: "off",
                                                    stopLoop: "off",
                                                    stopAfterLoops: -1,
                                                    stopAtSlide: -1,
                                                    shuffle: "off",
                                                    autoHeight: "off",
                                                    disableProgressBar: "on",
                                                    hideThumbsOnMobile: "off",
                                                    hideSliderAtLimit: 0,
                                                    hideCaptionAtLimit: 0,
                                                    hideAllCaptionAtLilmit: 0,
                                                    debugMode: false,
                                                    fallbacks: {
                                                        simplifyAll: "off",
                                                        nextSlideOnWindowFocus: "off",
                                                        disableFocusListener: false,
                                                    }
                                                });
                                            }
                                        });
                                        /*]]>*/</script>
                                    <script>/*<![CDATA[*/
                                        var htmlDivCss = unescape("%40import%20url%28http%3A%2F%2Ffonts.googleapis.com%2Fcss%3Ffamily%3DRoboto%2BSlab%3A400%2C100%2C300%2C700%29%3B");
                                        var htmlDiv = document.getElementById('rs-plugin-settings-inline-css');
                                        if (htmlDiv) {
                                            htmlDiv.innerHTML = htmlDiv.innerHTML + htmlDivCss;
                                        }
                                        else {
                                            var htmlDiv = document.createElement('div');
                                            htmlDiv.innerHTML = '<style>' + htmlDivCss + '</style>';
                                            document.getElementsByTagName('head')[0].appendChild(htmlDiv.childNodes[0]);
                                        }
                                        /*]]>*/</script>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
            </div>
        </div>
    </div>
</section>
<?php
include $_SERVER['DOCUMENT_ROOT'] . '/includes/detail_pagination.php';
?>
<footer class="bg-light-gray2">
    <?php
    include $_SERVER['DOCUMENT_ROOT'] . "/includes/footer_menu_bg-white.php";
    ?>
    <a class="scrollToTop" href="javascript:void(0);"> <i class="fa fa-angle-up"></i> </a></footer>
<?php
include $_SERVER['DOCUMENT_ROOT'] . '/includes/footer_scripts.php';
?>

<script type="text/javascript">/*<![CDATA[*/
    $("form#commentform").submit(function (e) {
        e.preventDefault();
    });
    if ($('body').hasClass('home')) {
        var lastli_html = $('.home #main-demo ul.portfolio-filter > li').last();
        var intro_li = $('.home #main-demo ul.portfolio-filter > li:eq( 2 )');
        $('.home #main-demo ul.portfolio-filter > li').last().remove();
        $('.home #main-demo ul.portfolio-filter > li:eq( 2 )').remove();
        $('.home #main-demo ul.portfolio-filter > li:eq( 2 )').before(lastli_html);
        $('.home #main-demo ul.portfolio-filter > li').last().before(intro_li);
        $(".main-demo-slider").find("div.slider-text-bottom").append("<div class='demo-slider-right-button'><a href='#features' class='inner-link highlight-button-white-border btn-medium button btn'>Awesome Demos</a><a href='http://themeforest.net/item/hcode-responsive-multipurpose-wordpress-theme/14561695?ref=themezaa' target='_blank' class='inner-link highlight-button-white-border btn-medium button btn'>Purchase Theme</a></div><div class='home-slider-bottom-image'></div>");
        $(".main-demo-slider").find("div.work-background-slider-text").children().next().addClass("display-none");
    }
    $(document).ready(function () {
        if ($('body').hasClass("error404")) {
            $('nav').removeClass('nav-black').addClass('nav-white');
        }
    });
    /*]]>*/</script>

<script type="text/javascript"
        src="/includes/js/images.js"></script>
</body>
</html>
