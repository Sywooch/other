<?php
/**
 * Created by PhpStorm.
 * User: GSU
 * Date: 29.07.2017
 * Time: 13:48
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
<body class="page-template-default page page-id-65 wpb-js-composer js-comp-ver-5.1 vc_responsive">
<nav
    class="navbar navbar-default navbar-fixed-top nav-transparent overlay-nav sticky-nav transparent-header nav-border-bottom  nav-white "
    data-menu-hover-delay="100">
    <div class="container">
        <div class="row">
            <?php
            include $_SERVER['DOCUMENT_ROOT'] . '/includes/head_logo_white-2.php';
            ?>
            <div class="navbar-header col-sm-8 sm-width-auto col-xs-2 pull-right">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse"><span
                        class="sr-only">Toggle navigation</span> <span class="icon-bar"></span> <span
                        class="icon-bar"></span> <span class="icon-bar"></span></button>
            </div>
            <div class="col-md-8 no-padding-right accordion-menu text-right pull-right menu-position-right">
                <div id="mega-menu" class="navbar-collapse collapse navbar-right">
                    <ul id="menu-onepage" class="mega-menu-ul nav navbar-nav navbar-right panel-group">
                        <?php
                        include $_SERVER['DOCUMENT_ROOT'] . '/includes/main_menu.php';
                        ?>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</nav>
<section class="parent-section no-padding post-65 page type-page status-publish hentry">
    <div class="container-fluid">
        <div class="row">
            <div class="entry-content">
                <section id="slider" class="  no-padding">
                    <div class="container-fluid">
                        <div class="row">
                            <div class="wpb_column hcode-column-container  col-xs-mobile-fullwidth">
                                <div class="vc-column-innner-wrapper">
                                    <div class="wpb_revslider_element wpb_content_element">
                                        <link href="http://fonts.googleapis.com/css?family=Open+Sans:300%2C600%2C400"
                                              rel="stylesheet" property="stylesheet" type="text/css" media="all">
                                        <div id="rev_slider_41_1_wrapper"
                                             class="rev_slider_wrapper fullscreen-container" data-source="gallery"
                                             style="background:transparent;padding:0px;">
                                            <div id="rev_slider_41_1" class="rev_slider fullscreenbanner"
                                                 style="display:none;" data-version="5.4.1">
                                                <ul>
                                                    
                                                    <?php foreach($arProjectAllImages as $keyImage => $image){ ?>
                                                    <li data-index="rs-<?php echo $keyImage; ?>" data-transition="fade"
                                                        data-slotamount="default" data-hideafterloop="0"
                                                        data-hideslideonmobile="off" data-easein="default"
                                                        data-easeout="default" data-masterspeed="default"
                                                        data-thumb="<?php echo $image; ?>"
                                                        data-delay="9000" data-rotate="0" data-saveperformance="off"
                                                        class="no-transition" data-title="Slide" data-param1=""
                                                        data-param2="" data-param3="" data-param4="" data-param5=""
                                                        data-param6="" data-param7="" data-param8="" data-param9=""
                                                        data-param10="" data-description=""><img
                                                            src="<?php echo $image; ?>"
                                                            alt="" title="revolution1-slider-img2" width="1908"
                                                            height="1079" data-bgposition="center top"
                                                            data-bgfit="cover" data-bgrepeat="no-repeat"
                                                            class="rev-slidebg" data-no-retina>
                                                        <div
                                                            class="tp-caption Fashion-BigDisplay   tp-resizeme  tp-caption
                                                            light_medium_30_shadowed lfb ltt tp-resizeme"
                                                            id="slide-195-layer-1" data-x="center" data-hoffset=""
                                                            data-y="center" data-voffset="-50" data-width="['auto']"
                                                            data-height="['auto']" data-type="text"
                                                            data-responsive_offset="on"
                                                            data-frames='[{"from":"y:bottom;","speed":600,"to":"o:1;","delay":800,"ease":"Power4.easeOut"},{"delay":7100,"speed":500,"to":"y:top;","ease":"Power4.easeIn"}]'
                                                            data-textAlign="['left','left','left','left']"
                                                            data-paddingtop="[0,0,0,0]" data-paddingright="[0,0,0,0]"
                                                            data-paddingbottom="[0,0,0,0]" data-paddingleft="[0,0,0,0]"
                                                            style="z-index: 5; white-space: nowrap; font-size: 16px; line-height: 80px; font-weight: 300; color: rgba(255,255,255,1);font-family:Open Sans;text-transform:uppercase;text-decoration:none;background-color:transparent;z-index:2;letter-spacing:8px;">
                                                            <?php echo get_post_meta($arProject["ID"], 'YEAR')[0]; ?>
                                                        </div>
                                                        <div
                                                            class="tp-caption Fashion-BigDisplay   tp-resizeme  tp-caption light_heavy_70_shadowed lfb ltt tp-resizeme"
                                                            id="slide-195-layer-2" data-x="center" data-hoffset=""
                                                            data-y="center" data-voffset="" data-width="['auto']"
                                                            data-height="['auto']" data-type="text"
                                                            data-responsive_offset="on"
                                                            data-frames='[{"from":"y:bottom;","speed":600,"to":"o:1;","delay":900,"ease":"Power4.easeOut"},{"delay":7000,"speed":500,"to":"y:top;","ease":"Power4.easeIn"}]'
                                                            data-textAlign="['left','left','left','left']"
                                                            data-paddingtop="[0,0,0,0]" data-paddingright="[0,0,0,0]"
                                                            data-paddingbottom="[0,0,0,0]" data-paddingleft="[0,0,0,0]"
                                                            style="z-index: 6; white-space: nowrap; font-size: 35px; line-height: 20px; font-weight: 600; color: rgba(255,255,255,1);font-family:Open Sans;text-transform:uppercase;text-decoration:none;background-color:transparent;z-index:3;letter-spacing:7px;">
                                                            <?php if($keyImage == 0) echo $arProject["post_title"];
                                                            else displayRandomElement($arPostTagsNames); ?>
                                                        </div>
                                                        <a class="tp-caption rev-btn  tp-resizeme  inner-link"
                                                           href="#features" target="_self" id="slide-195-layer-4"
                                                           data-x="center" data-hoffset="" data-y="center"
                                                           data-voffset="80" data-width="['auto']"
                                                           data-height="['auto']" data-type="button" data-actions=''
                                                           data-responsive_offset="on"
                                                           data-frames='[{"from":"opacity:0;","speed":500,"to":"o:1;","delay":1200,"ease":"Power3.easeInOut"},{"delay":6800,"speed":500,"to":"opacity:0;","ease":"nothing"},{"frame":"hover","speed":"0","ease":"Linear.easeNone","to":"o:1;rX:0;rY:0;rZ:0;z:0;","style":"c:rgba(0,0,0,1);bg:rgba(255,255,255,1);"}]'
                                                           data-textAlign="['left','left','left','left']"
                                                           data-paddingtop="[10,10,10,10]"
                                                           data-paddingright="[30,30,30,30]"
                                                           data-paddingbottom="[10,10,10,10]"
                                                           data-paddingleft="[30,30,30,30]"
                                                           style="z-index: 7; white-space: nowrap; font-size: 11px; line-height: 23px;
                                                            font-weight: 400; color: rgba(255,255,255,1);font-family:Open Sans;
                                                            text-transform:uppercase;text-decoration:none;background-color:rgba(0,0,0,0.75);
                                                            outline:none;box-shadow:none;box-sizing:border-box;-moz-box-sizing:border-box;
                                                            -webkit-box-sizing:border-box;z-index:4;letter-spacing:3px;color:#fff !important;
                                                            padding:6px 25px;background:transparent;border:2px solid #fff;display:inline-block;
                                                            cursor:pointer;text-decoration: none;">
                                                            Далее</a></li>
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
                                                var htmlDivCss = ".tp-caption.Fashion-BigDisplay,.Fashion-BigDisplay{color:rgba(0,0,0,1.00);font-size:60px;line-height:60px;font-weight:900;font-style:normal;font-family:Raleway;text-decoration:none;background-color:transparent;border-color:transparent;border-style:none;border-width:0px;border-radius:0 0 0 0px;letter-spacing:2px}";
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
                                                        var e = new Object, i = jQuery(window).width(), t = 9999, r = 0,
                                                            n = 0, l = 0, f = 0, s = 0, h = 0;
                                                        e.c = jQuery('#rev_slider_41_1');
                                                        e.gridwidth = [1170];
                                                        e.gridheight = [700];
                                                        e.sliderLayout = "fullscreen";
                                                        e.fullScreenAutoWidth = 'off';
                                                        e.fullScreenAlignForce = 'off';
                                                        e.fullScreenOffsetContainer = '.header';
                                                        e.fullScreenOffset = '';
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
                                                var revapi41;
                                                tpj(document).ready(function () {
                                                    if (tpj("#rev_slider_41_1").revolution == undefined) {
                                                        revslider_showDoubleJqueryError("#rev_slider_41_1");
                                                    } else {
                                                        revapi41 = tpj("#rev_slider_41_1").show().revolution({
                                                            sliderType: "standard",
                                                            jsFileLocation: "//wpdemos.themezaa.com/h-code/wp-content/plugins/revslider/public/assets/js/",
                                                            sliderLayout: "fullscreen",
                                                            dottedOverlay: "none",
                                                            delay: 9000,
                                                            navigation: {
                                                                keyboardNavigation: "on",
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
                                                                    style: "hades",
                                                                    enable: true,
                                                                    hide_onmobile: true,
                                                                    hide_under: 600,
                                                                    hide_onleave: true,
                                                                    hide_delay: 200,
                                                                    hide_delay_mobile: 1200,
                                                                    tmp: '<div class="tp-arr-allwrapper"> <div class="tp-arr-imgholder"></div></div>',
                                                                    left: {
                                                                        h_align: "left",
                                                                        v_align: "center",
                                                                        h_offset: 0,
                                                                        v_offset: 0
                                                                    },
                                                                    right: {
                                                                        h_align: "right",
                                                                        v_align: "center",
                                                                        h_offset: 0,
                                                                        v_offset: 0
                                                                    }
                                                                }
                                                            },
                                                            visibilityLevels: [1240, 1024, 778, 480],
                                                            gridwidth: 1170,
                                                            gridheight: 700,
                                                            lazyType: "none",
                                                            shadow: 0,
                                                            spinner: "off",
                                                            stopLoop: "off",
                                                            stopAfterLoops: -1,
                                                            stopAtSlide: -1,
                                                            shuffle: "off",
                                                            autoHeight: "off",
                                                            fullScreenAutoWidth: "off",
                                                            fullScreenAlignForce: "off",
                                                            fullScreenOffsetContainer: ".header",
                                                            fullScreenOffset: "",
                                                            disableProgressBar: "on",
                                                            hideThumbsOnMobile: "off",
                                                            hideSliderAtLimit: 0,
                                                            hideCaptionAtLimit: 0,
                                                            hideAllCaptionAtLilmit: 0,
                                                            startWithSlide: 0,
                                                            debugMode: false,
                                                            fallbacks: {
                                                                simplifyAll: "off",
                                                                nextSlideOnWindowFocus: "off",
                                                                disableFocusListener: true,
                                                            }
                                                        });
                                                    }
                                                });
                                                /*]]>*/</script>
                                            <script>/*<![CDATA[*/
                                                var htmlDivCss = unescape("div.tp-bannertimer%20%7B%0Adisplay%3A%20none%20%21important%3B%0Aopacity%3A%200%20%21important%3B%0Avisibility%3A%20hidden%20%21important%3B%0A%7D");
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
                                            <script>/*<![CDATA[*/
                                                var htmlDivCss = unescape(".hades.tparrows%20%7B%0A%09cursor%3Apointer%3B%0A%09background%3Argba%280%2C0%2C0%2C0.25%29%3B%0A%09width%3A100px%3B%0A%09height%3A100px%3B%0A%09position%3Aabsolute%3B%0A%09display%3Ablock%3B%0A%09z-index%3A100%3B%0A%7D%0A%0A.hades.tparrows%3Abefore%20%7B%0A%09font-family%3A%20%22revicons%22%3B%0A%09font-size%3A30px%3B%0A%09color%3Argba%28255%2C%20255%2C%20255%2C%201%29%3B%0A%09display%3Ablock%3B%0A%09line-height%3A%20100px%3B%0A%09text-align%3A%20center%3B%0A%20%20transition%3A%20background%200.3s%2C%20color%200.3s%3B%0A%7D%0A.hades.tparrows.tp-leftarrow%3Abefore%20%7B%0A%09content%3A%20%22%5Ce824%22%3B%0A%7D%0A.hades.tparrows.tp-rightarrow%3Abefore%20%7B%0A%09content%3A%20%22%5Ce825%22%3B%0A%7D%0A%0A.hades.tparrows%3Ahover%3Abefore%20%7B%0A%20%20%20color%3Argba%280%2C0%2C0%2C0.5%29%3B%0A%20%20%20background%3Argba%28255%2C%20255%2C%20255%2C%201%29%3B%0A%20%7D%0A.hades%20.tp-arr-allwrapper%20%7B%0A%20%20position%3Aabsolute%3B%0A%20%20left%3A100%25%3B%0A%20%20top%3A0px%3B%0A%20%20background%3A%23888%3B%20%0A%20%20width%3A100px%3Bheight%3A100px%3B%0A%20%20-webkit-transition%3A%20all%200.3s%3B%0A%20%20transition%3A%20all%200.3s%3B%0A%20%20-ms-filter%3A%20%22progid%3Adximagetransform.microsoft.alpha%28opacity%3D0%29%22%3B%0A%20%20filter%3A%20alpha%28opacity%3D0%29%3B%0A%20%20-moz-opacity%3A%200.0%3B%0A%20%20-khtml-opacity%3A%200.0%3B%0A%20%20opacity%3A%200.0%3B%0A%20%20-webkit-transform%3A%20rotatey%28-90deg%29%3B%0A%20%20transform%3A%20rotatey%28-90deg%29%3B%0A%20%20-webkit-transform-origin%3A%200%25%2050%25%3B%0A%20%20transform-origin%3A%200%25%2050%25%3B%0A%7D%0A.hades.tp-rightarrow%20.tp-arr-allwrapper%20%7B%0A%20%20%20left%3Aauto%3B%0A%20%20%20right%3A100%25%3B%0A%20%20%20-webkit-transform-origin%3A%20100%25%2050%25%3B%0A%20%20transform-origin%3A%20100%25%2050%25%3B%0A%20%20%20-webkit-transform%3A%20rotatey%2890deg%29%3B%0A%20%20transform%3A%20rotatey%2890deg%29%3B%0A%7D%0A%0A.hades%3Ahover%20.tp-arr-allwrapper%20%7B%0A%20%20%20-ms-filter%3A%20%22progid%3Adximagetransform.microsoft.alpha%28opacity%3D100%29%22%3B%0A%20%20filter%3A%20alpha%28opacity%3D100%29%3B%0A%20%20-moz-opacity%3A%201%3B%0A%20%20-khtml-opacity%3A%201%3B%0A%20%20opacity%3A%201%3B%20%20%0A%20%20%20%20-webkit-transform%3A%20rotatey%280deg%29%3B%0A%20%20transform%3A%20rotatey%280deg%29%3B%0A%0A%20%7D%0A%20%20%20%20%0A.hades%20.tp-arr-iwrapper%20%7B%0A%7D%0A.hades%20.tp-arr-imgholder%20%7B%0A%20%20background-size%3Acover%3B%0A%20%20position%3Aabsolute%3B%0A%20%20top%3A0px%3Bleft%3A0px%3B%0A%20%20width%3A100%25%3Bheight%3A100%25%3B%0A%7D%0A.hades%20.tp-arr-titleholder%20%7B%0A%7D%0A.hades%20.tp-arr-subtitleholder%20%7B%0A%7D%0A%0A");
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
                        </div>
                    </div>
                </section>
                <section id="features">
                    <div class="container">
                        <div class="row">
                            <div
                                class="wpb_column hcode-column-container  col-md-12 col-xs-mobile-fullwidth text-center">
                                <div class="vc-column-innner-wrapper">
                                    <h3 class="section-title  black-text">
                                        Этапы разработки
                                    </h3></div>
                            </div>
                            <?php
                            include $_SERVER['DOCUMENT_ROOT'] . '/includes/detail_iterations.php';
                            ?>
                            <div class="wpb_column hcode-column-container  col-md-12 col-xs-mobile-fullwidth col-sm-12">
                                <div class="vc-column-innner-wrapper">
                                    <div class="wide-separator-line margin-eight no-margin-lr"
                                         style=" background:#e5e5e5;"></div>
                                </div>
                            </div>
                            <?php
                            include $_SERVER['DOCUMENT_ROOT'] . '/includes/detail_other_projects__key-person.php';
                            ?>
                        </div>
                    </div>
                </section>
                <?php
                include $_SERVER['DOCUMENT_ROOT'] . '/includes/detail_button_portfolio__btn-extra-large.php';
                ?>


                <?php
                include $_SERVER['DOCUMENT_ROOT'] . '/includes/detail_projects__approach-slider__pagination-false__items-4__stopOnHover-true.php';
                ?>
                <?php
                include $_SERVER['DOCUMENT_ROOT'] . '/includes/detail_animated-tab.php';
                ?>



                <?php
                include $_SERVER['DOCUMENT_ROOT'] . '/includes/detail_chart-percent.php';
                ?>
                <?php
                include $_SERVER['DOCUMENT_ROOT'] . '/includes/detail_portfolio__title__random-text__800-600__big_1-3.php';
                ?>
                <?php
                include $_SERVER['DOCUMENT_ROOT'] . '/includes/portfolio_development-stage.php';
                ?>

                <?php
                include $_SERVER['DOCUMENT_ROOT'] . '/includes/detail_testimonial_projects.php';
                ?>

                <?php
                include $_SERVER['DOCUMENT_ROOT'] . '/includes/detail_section_projects.php';
                ?>

                <?php
                include $_SERVER['DOCUMENT_ROOT'] . '/includes/detail_section_projects-thimb.php';
                ?>

                <?php
                include $_SERVER['DOCUMENT_ROOT'] . '/includes/detail_contact-us.php';
                ?>
                <?php
                include $_SERVER['DOCUMENT_ROOT'] . '/includes/detail_parallax-fix_parallax3.php';
                ?>
            </div>
        </div>
    </div>
</section>
<?php
include $_SERVER['DOCUMENT_ROOT'] . '/includes/detail_footer_onepage.php';
?>
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
