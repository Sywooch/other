<?php
/**
 * Created by PhpStorm.
 * User: GSU
 * Date: 23.07.2017
 * Time: 23:08
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
<body class="page-template-default page page-id-12 wpb-js-composer js-comp-ver-5.1 vc_responsive">
<nav
    class="navbar navbar-default navbar-fixed-top nav-transparent overlay-nav sticky-nav transparent-header
    nav-border-bottom  nav-white "
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
            <div class="col-md-8 no-padding-right accordion-menu text-right">
                <div id="mega-menu" class="navbar-collapse collapse navbar-right">
                    <ul id="menu-main-menu" class="mega-menu-ul nav navbar-nav navbar-right panel-group">
                        <?php
                        include $_SERVER['DOCUMENT_ROOT'] . '/includes/main_menu.php';
                        ?>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</nav>
<section class="parent-section no-padding post-12 page type-page status-publish hentry">
    <div class="container-fluid">
        <div class="row">
            <div class="entry-content">
                <section class="  no-padding">
                    <div class="container-fluid">
                        <div class="row">
                            <div class="wpb_column hcode-column-container  col-xs-mobile-fullwidth">
                                <div class="vc-column-innner-wrapper">
                                    <div class="wpb_revslider_element wpb_content_element">
                                        <link href="http://fonts.googleapis.com/css?family=Open+Sans:700%2C900"
                                              rel="stylesheet" property="stylesheet" type="text/css" media="all">
                                        <div id="rev_slider_1_1_wrapper" class="rev_slider_wrapper fullscreen-container"
                                             data-source="gallery" style="background:transparent;padding:0px;">
                                            <div id="rev_slider_1_1" class="rev_slider fullscreenbanner"
                                                 style="display:none;" data-version="5.4.1">
                                                <ul>
                                                    <li data-index="rs-1" data-transition="fade"
                                                        data-slotamount="default" data-hideafterloop="0"
                                                        data-hideslideonmobile="off" data-easein="default"
                                                        data-easeout="default" data-masterspeed="default"
                                                        data-thumb="<? displayRandomElement($currentBackgroundImage);?>"
                                                        data-delay="9000" data-rotate="0" data-saveperformance="off"
                                                        class="no-transition" data-title="Slide" data-param1=""
                                                        data-param2="" data-param3="" data-param4="" data-param5=""
                                                        data-param6="" data-param7="" data-param8="" data-param9=""
                                                        data-param10="" data-description=""><img
                                                            src="http://wpdemos.themezaa.com/h-code/wp-content/plugins/revslider/admin/assets/images/dummy.png"
                                                            alt="" title="photography-01" width="1908" height="1079"
                                                            data-lazyload="<? displayRandomElement($currentBackgroundImage);?>"
                                                            data-bgposition="center top" data-bgfit="cover"
                                                            data-bgrepeat="no-repeat" data-bgparallax="off"
                                                            class="rev-slidebg" data-no-retina>
                                                        <div
                                                            class="tp-caption Fashion-BigDisplay   tp-resizeme  tp-caption photography-very_large_text_90 sfr stl tp-resizeme start"
                                                            id="slide-1-layer-4" data-x="center" data-hoffset=""
                                                            data-y="center" data-voffset="" data-width="['846']"
                                                            data-height="['70']" data-type="text"
                                                            data-responsive_offset="on"
                                                            data-frames='[{"from":"x:50px;opacity:1;","speed":600,"to":"o:1;","delay":800,"ease":"Power4.easeOut"},{"delay":7100,"speed":500,"to":"x:-50px;opacity:0;","ease":"Power4.easeIn"}]'
                                                            data-textAlign="['left','left','left','left']"
                                                            data-paddingtop="[0,0,0,0]" data-paddingright="[0,0,0,0]"
                                                            data-paddingbottom="[0,0,0,0]" data-paddingleft="[0,0,0,0]"
                                                            style="z-index: 5; min-width: 846px; max-width: 846px;
                                                            max-width: 70px; max-width: 70px; white-space: normal; font-size: 50px; font-weight: 700;
                                                            color: rgba(255,255,255,1);font-family:Open Sans;text-transform:uppercase;z-index:2;position:absolute;margin:0px;white-space:nowrap;letter-spacing:50px;">
                                                            <?php
                                                            $arProjectTitle = explode(" ", $arProject["post_title"]);

                                                            /*
                                                            $arProjectTitle = array_chunk($arProjectTitle, count($arProjectTitle) / 2);
                                                            $projectTitle = "";
                                                            foreach($arProjectTitle as $itemTitles){
                                                                $projectTitle = $projectTitle . "<br>" . implode( ' ', $itemTitles );
                                                            }


                                                            echo $projectTitle;
                                                            */

                                                            echo implode("<br>", $arProjectTitle);
                                                            ?>
                                                        </div>
                                                        <div
                                                            class="tp-caption   tp-resizeme  tp-caption light_heavy_70_shadowed sfl str tp-resizeme"
                                                            id="slide-1-layer-5" data-x="center" data-hoffset=""
                                                            data-y="center" data-voffset=""
                                                            data-width="['none','none','none','none']"
                                                            data-height="['none','none','none','none']"
                                                            data-type="image" data-responsive_offset="on"
                                                            data-frames='[{"from":"x:-50px;opacity:0;","speed":600,"to":"o:1;","delay":900,"ease":"Power4.easeOut"},{"delay":7000,"speed":500,"to":"x:50px;opacity:0;","ease":"Power4.easeIn"}]'
                                                            data-textAlign="['left','left','left','left']"
                                                            data-paddingtop="[0,0,0,0]" data-paddingright="[0,0,0,0]"
                                                            data-paddingbottom="[0,0,0,0]" data-paddingleft="[0,0,0,0]"
                                                            style="z-index: 6;text-transform:left;z-index:3;"><img
                                                                src="http://wpdemos.themezaa.com/h-code/wp-content/plugins/revslider/admin/assets/images/dummy.png"
                                                                alt="" data-ww="30px" data-hh="219px"
                                                                data-lazyload=" http://wpdemos.themezaa.com/h-code/wp-content/uploads/2015/08/photography-slider-text-line.png"
                                                                data-no-retina></div>
                                                    </li>
                                                    <li data-index="rs-2" data-transition="fade"
                                                        data-slotamount="default" data-hideafterloop="0"
                                                        data-hideslideonmobile="off" data-easein="default"
                                                        data-easeout="default" data-masterspeed="default"
                                                        data-thumb="<? displayRandomElement($currentBackgroundImage);?>"
                                                        data-delay="9000" data-rotate="0" data-saveperformance="off"
                                                        class="no-transition" data-title="Slide" data-param1=""
                                                        data-param2="" data-param3="" data-param4="" data-param5=""
                                                        data-param6="" data-param7="" data-param8="" data-param9=""
                                                        data-param10="" data-description=""><img
                                                            src="http://wpdemos.themezaa.com/h-code/wp-content/plugins/revslider/admin/assets/images/dummy.png"
                                                            alt="" title="photography-02" width="1908" height="1079"
                                                            data-lazyload="<? displayRandomElement($currentBackgroundImage);?>"
                                                            data-bgposition="center top" data-bgfit="cover"
                                                            data-bgrepeat="no-repeat" data-bgparallax="off"
                                                            class="rev-slidebg" data-no-retina>
                                                        <div
                                                            class="tp-caption Fashion-BigDisplay   tp-resizeme  tp-caption photography-very_large_text_90 sfr stl tp-resizeme"
                                                            id="slide-2-layer-1" data-x="center" data-hoffset=""
                                                            data-y="center" data-voffset="" data-width="['889']"
                                                            data-height="['66']" data-type="text"
                                                            data-responsive_offset="on"
                                                            data-frames='[{"from":"x:50px;opacity:1;","speed":600,"to":"o:1;","delay":800,"ease":"Power4.easeOut"},{"delay":7100,"speed":500,"to":"x:-50px;opacity:0;","ease":"Power4.easeIn"}]'
                                                            data-textAlign="['left','left','left','left']"
                                                            data-paddingtop="[0,0,0,0]" data-paddingright="[0,0,0,0]"
                                                            data-paddingbottom="[0,0,0,0]" data-paddingleft="[0,0,0,0]"
                                                            style="z-index: 7; min-width: 889px; max-width: 889px; max-width: 66px; max-width: 66px; white-space: normal; font-size: 90px; font-weight: 700; color: rgba(255,255,255,1);font-family:Open Sans;text-transform:uppercase;z-index:2;position:absolute;margin:0px;white-space:nowrap;letter-spacing:50px;">
                                                            <?php echo get_post_meta($arProject["ID"], 'YEAR')[0]; ?>
                                                        </div>
                                                        <div
                                                            class="tp-caption   tp-resizeme  tp-caption light_heavy_70_shadowed sfl str tp-resizeme"
                                                            id="slide-2-layer-2" data-x="center" data-hoffset=""
                                                            data-y="center" data-voffset=""
                                                            data-width="['none','none','none','none']"
                                                            data-height="['none','none','none','none']"
                                                            data-type="image" data-responsive_offset="on"
                                                            data-frames='[{"from":"x:-50px;opacity:0;","speed":600,"to":"o:1;","delay":900,"ease":"Power4.easeOut"},{"delay":7000,"speed":500,"to":"x:50px;opacity:0;","ease":"Power4.easeIn"}]'
                                                            data-textAlign="['left','left','left','left']"
                                                            data-paddingtop="[0,0,0,0]" data-paddingright="[0,0,0,0]"
                                                            data-paddingbottom="[0,0,0,0]" data-paddingleft="[0,0,0,0]"
                                                            style="z-index: 8;text-transform:left;z-index:3;"><img
                                                                src="http://wpdemos.themezaa.com/h-code/wp-content/plugins/revslider/admin/assets/images/dummy.png"
                                                                alt="" data-ww="30px" data-hh="219px"
                                                                data-lazyload=" http://wpdemos.themezaa.com/h-code/wp-content/uploads/2015/08/photography-slider-text-line.png"
                                                                data-no-retina></div>
                                                    </li>
                                                    <li data-index="rs-3" data-transition="fade"
                                                        data-slotamount="default" data-hideafterloop="0"
                                                        data-hideslideonmobile="off" data-easein="default"
                                                        data-easeout="default" data-masterspeed="default"
                                                        data-thumb="<? displayRandomElement($currentBackgroundImage);?>"
                                                        data-delay="9000" data-rotate="0" data-saveperformance="off"
                                                        class="no-transition" data-title="Slide" data-param1=""
                                                        data-param2="" data-param3="" data-param4="" data-param5=""
                                                        data-param6="" data-param7="" data-param8="" data-param9=""
                                                        data-param10="" data-description=""><img
                                                            src="http://wpdemos.themezaa.com/h-code/wp-content/plugins/revslider/admin/assets/images/dummy.png"
                                                            alt="" title="photography-03" width="1908" height="1079"
                                                            data-lazyload="<? displayRandomElement($currentBackgroundImage);?>"
                                                            data-bgposition="center top" data-bgfit="cover"
                                                            data-bgrepeat="no-repeat" data-bgparallax="off"
                                                            class="rev-slidebg" data-no-retina>
                                                        <div
                                                            class="tp-caption Fashion-BigDisplay   tp-resizeme  tp-caption photography-very_large_text_90 sfr stl tp-resizeme"
                                                            id="slide-3-layer-1" data-x="center" data-hoffset=""
                                                            data-y="center" data-voffset="" data-width="['854']"
                                                            data-height="['66']" data-type="text"
                                                            data-responsive_offset="on"
                                                            data-frames='[{"from":"x:50px;opacity:1;","speed":600,"to":"o:1;","delay":800,"ease":"Power4.easeOut"},{"delay":7100,"speed":500,"to":"x:-50px;opacity:0;","ease":"Power4.easeIn"}]'
                                                            data-textAlign="['left','left','left','left']"
                                                            data-paddingtop="[0,0,0,0]" data-paddingright="[0,0,0,0]"
                                                            data-paddingbottom="[0,0,0,0]" data-paddingleft="[0,0,0,0]"
                                                            style="z-index: 9; min-width: 854px; max-width: 854px; max-width: 66px; max-width: 66px; white-space: normal; font-size: 90px; font-weight: 700; color: rgba(255,255,255,1);font-family:Open Sans;text-transform:uppercase;z-index:2;position:absolute;margin:0px;white-space:nowrap;letter-spacing:50px;">
                                                            <?php displayRandomElement($arPostTagsNames); ?>
                                                        </div>
                                                        <div class="tp-caption   tp-resizeme" id="slide-3-layer-2"
                                                             data-x="center" data-hoffset="" data-y="center"
                                                             data-voffset="" data-width="['none','none','none','none']"
                                                             data-height="['none','none','none','none']"
                                                             data-type="image" data-responsive_offset="on"
                                                             data-frames='[{"from":"x:-50px;opacity:0;","speed":600,"to":"o:1;","delay":900,"ease":"Power4.easeOut"},{"delay":7000,"speed":500,"to":"x:50px;opacity:0;","ease":"Power4.easeIn"}]'
                                                             data-textAlign="['left','left','left','left']"
                                                             data-paddingtop="[0,0,0,0]" data-paddingright="[0,0,0,0]"
                                                             data-paddingbottom="[0,0,0,0]" data-paddingleft="[0,0,0,0]"
                                                             style="z-index: 10;text-transform:left;"><img
                                                                src="http://wpdemos.themezaa.com/h-code/wp-content/plugins/revslider/admin/assets/images/dummy.png"
                                                                alt="" data-ww="30px" data-hh="219px"
                                                                data-lazyload=" http://wpdemos.themezaa.com/h-code/wp-content/uploads/2015/08/photography-slider-text-line.png"
                                                                data-no-retina></div>
                                                    </li>
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
                                                        e.c = jQuery('#rev_slider_1_1');
                                                        e.gridwidth = [1903];
                                                        e.gridheight = [700];
                                                        e.sliderLayout = "fullscreen";
                                                        e.fullScreenAutoWidth = 'on';
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
                                                var revapi1;
                                                tpj(document).ready(function () {
                                                    if (tpj("#rev_slider_1_1").revolution == undefined) {
                                                        revslider_showDoubleJqueryError("#rev_slider_1_1");
                                                    } else {
                                                        revapi1 = tpj("#rev_slider_1_1").show().revolution({
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
                                                                bullets: {
                                                                    enable: true,
                                                                    hide_onmobile: false,
                                                                    style: "hermes",
                                                                    hide_onleave: false,
                                                                    direction: "horizontal",
                                                                    h_align: "center",
                                                                    v_align: "bottom",
                                                                    h_offset: 0,
                                                                    v_offset: 30,
                                                                    space: 10,
                                                                    tmp: ''
                                                                }
                                                            },
                                                            visibilityLevels: [1240, 1024, 778, 480],
                                                            gridwidth: 1903,
                                                            gridheight: 700,
                                                            lazyType: "all",
                                                            parallax: {
                                                                type: "mouse",
                                                                origo: "slidercenter",
                                                                speed: 2000,
                                                                levels: [2, 3, 4, 5, 6, 7, 12, 16, 10, 50, 47, 48, 49, 50, 51, 55],
                                                                disable_onmobile: "on"
                                                            },
                                                            shadow: 0,
                                                            spinner: "spinner0",
                                                            stopLoop: "off",
                                                            stopAfterLoops: -1,
                                                            stopAtSlide: -1,
                                                            shuffle: "off",
                                                            autoHeight: "off",
                                                            fullScreenAutoWidth: "on",
                                                            fullScreenAlignForce: "off",
                                                            fullScreenOffsetContainer: ".header",
                                                            fullScreenOffset: "",
                                                            disableProgressBar: "on",
                                                            hideThumbsOnMobile: "off",
                                                            hideSliderAtLimit: 0,
                                                            hideCaptionAtLimit: 0,
                                                            hideAllCaptionAtLilmit: 0,
                                                            debugMode: false,
                                                            fallbacks: {
                                                                simplifyAll: "on",
                                                                nextSlideOnWindowFocus: "off",
                                                                disableFocusListener: true,
                                                            }
                                                        });
                                                    }
                                                });
                                                /*]]>*/</script>
                                            <script>/*<![CDATA[*/
                                                var htmlDivCss = unescape(".hermes.tp-bullets%20%7B%0A%7D%0A%0A.hermes%20.tp-bullet%20%7B%0A%20%20%20%20overflow%3Ahidden%3B%0A%20%20%20%20border-radius%3A50%25%3B%0A%20%20%20%20width%3A16px%3B%0A%20%20%20%20height%3A16px%3B%0A%20%20%20%20background-color%3A%20rgba%280%2C%200%2C%200%2C%200%29%3B%0A%20%20%20%20box-shadow%3A%20inset%200%200%200%202px%20rgb%28255%2C%20255%2C%20255%29%3B%0A%20%20%20%20-webkit-transition%3A%20background%200.3s%20ease%3B%0A%20%20%20%20transition%3A%20background%200.3s%20ease%3B%0A%20%20%20%20position%3Aabsolute%3B%0A%7D%0A%0A.hermes%20.tp-bullet%3Ahover%20%7B%0A%09%20%20background-color%3A%20rgba%280%2C0%2C0%2C0.21%29%3B%0A%7D%0A.hermes%20.tp-bullet%3Aafter%20%7B%0A%20%20content%3A%20%27%20%27%3B%0A%20%20position%3A%20absolute%3B%0A%20%20bottom%3A%200%3B%0A%20%20height%3A%200%3B%0A%20%20left%3A%200%3B%0A%20%20width%3A%20100%25%3B%0A%20%20background-color%3A%20rgb%28255%2C%20255%2C%20255%29%3B%0A%20%20box-shadow%3A%200%200%201px%20rgb%28255%2C%20255%2C%20255%29%3B%0A%20%20-webkit-transition%3A%20height%200.3s%20ease%3B%0A%20%20transition%3A%20height%200.3s%20ease%3B%0A%7D%0A.hermes%20.tp-bullet.selected%3Aafter%20%7B%0A%20%20height%3A100%25%3B%0A%7D%0A%0A");
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
                <section class="  no-padding">
                    <div class="container-fluid">
                        <div class="row">
                            <div
                                class="wpb_column hcode-column-container  col-xs-mobile-fullwidth col-sm-12 no-padding">
                                <div class="vc-column-innner-wrapper">
                                    <div class="work-5col masonry wide photography-grid">
                                        <div class="tab-content">
                                            <ul class="grid masonry-block-items">
                                                <li>
                                                    <?php
                                                    $filename = getRandomElement($arProjectImages);
                                                    $new_filen = $_SERVER["DOCUMENT_ROOT"].'/wp-content/uploads/' . basename($filename);


                                                    $fileNew = "/wp-content/uploads/" . basename($filename);

                                                    cropImage($filename,
                                                        $_SERVER['DOCUMENT_ROOT'] . $fileNew,
                                                        900, 900);
                                                    ?>
                                                    <img

                                                        src="<?php echo $fileNew; ?>" data-image="<?php echo $fileNew; ?>"
                                                        class="js-img"
                                                        alt="" width="900" height="900"></li>
                                                <li>
                                                    <?php
                                                    $filename = getRandomElement($arProjectImages);
                                                    $new_filen = $_SERVER["DOCUMENT_ROOT"].'/wp-content/uploads/' . basename($filename);


                                                    $fileNew = "/wp-content/uploads/" . basename($filename);

                                                    cropImage($filename,
                                                        $_SERVER['DOCUMENT_ROOT'] . $fileNew,
                                                        900, 900);
                                                    ?>
                                                    <img
                                                            src="<?php echo $fileNew; ?>" data-image="<?php echo $fileNew; ?>"
                                                            class="js-img" alt="" width="900" height="900"></li>
                                                <li>
                                                    <?php
                                                    $filename = getRandomElement($arProjectImages);
                                                    $new_filen = $_SERVER["DOCUMENT_ROOT"].'/wp-content/uploads/' . basename($filename);


                                                    $fileNew = "/wp-content/uploads/" . basename($filename);

                                                    cropImage($filename,
                                                        $_SERVER['DOCUMENT_ROOT'] . $fileNew,
                                                        900, 900);
                                                    ?>
                                                    <img
                                                            src="<?php echo $fileNew; ?>" data-image="<?php echo $fileNew; ?>"
                                                            class="js-img" alt="" width="900" height="1800"></li>
                                                <li>
                                                    <?php
                                                    $filename = getRandomElement($arProjectImages);
                                                    $new_filen = $_SERVER["DOCUMENT_ROOT"].'/wp-content/uploads/' . basename($filename);


                                                    $fileNew = "/wp-content/uploads/" . basename($filename);

                                                    cropImage($filename,
                                                        $_SERVER['DOCUMENT_ROOT'] . $fileNew,
                                                        900, 900);
                                                    ?>
                                                    <img
                                                            src="<?php echo $fileNew; ?>" data-image="<?php echo $fileNew; ?>"
                                                            class="js-img" alt="" width="900" height="900">
                                                    <div
                                                        class="img-border-small img-border-small-gray border-transperent-light"></div>
                                                    <figure>
                                                        <figcaption>
                                                            <div class="photography-grid-details">
                                                                <div
                                                                    class="separator-line-thick bg-white display-block no-margin-top"></div>
                                                                <span
                                                                    class="text-large letter-spacing-3 white-text font-weight-600"><a
                                                                        href="/info/about/" class="white-text">о себе</a></span>
                                                                <div
                                                                    class="separator-line-thick bg-white display-block
                                                                    no-margin-bottom"></div>
                                                            </div>
                                                        </figcaption>
                                                    </figure>
                                                </li>
                                                <li>
                                                    <?php
                                                    $filename = getRandomElement($arProjectImages);
                                                    $new_filen = $_SERVER["DOCUMENT_ROOT"].'/wp-content/uploads/' . basename($filename);


                                                    $fileNew = "/wp-content/uploads/" . basename($filename);

                                                    cropImage($filename,
                                                        $_SERVER['DOCUMENT_ROOT'] . $fileNew,
                                                        900, 900);
                                                    ?>
                                                    <img
                                                            src="<?php echo $fileNew; ?>" data-image="<?php echo $fileNew; ?>"
                                                            class="js-img" alt="" width="900" height="900"></li>
                                                <li>
                                                    <?php
                                                    $filename = getRandomElement($arProjectImages);
                                                    $new_filen = $_SERVER["DOCUMENT_ROOT"].'/wp-content/uploads/' . basename($filename);


                                                    $fileNew = "/wp-content/uploads/" . basename($filename);

                                                    cropImage($filename,
                                                        $_SERVER['DOCUMENT_ROOT'] . $fileNew,
                                                        900, 900);
                                                    ?>
                                                    <img
                                                            src="<?php echo $fileNew; ?>" data-image="<?php echo $fileNew; ?>"
                                                            class="js-img" alt="" width="900" height="900"></li>
                                                <li>
                                                    <?php
                                                    $filename = getRandomElement($arProjectImages);
                                                    $new_filen = $_SERVER["DOCUMENT_ROOT"].'/wp-content/uploads/' . basename($filename);


                                                    $fileNew = "/wp-content/uploads/" . basename($filename);

                                                    cropImage($filename,
                                                        $_SERVER['DOCUMENT_ROOT'] . $fileNew,
                                                        900, 900);
                                                    ?>
                                                    <img
                                                            src="<?php echo $fileNew; ?>" data-image="<?php echo $fileNew; ?>"
                                                            class="js-img" alt="" width="900" height="900">
                                                    <figure>
                                                        <figcaption>
                                                            <div class="photography-grid-details"><p
                                                                    class="text-med gray-text text-transform-unset width-90 center-col">
                                                                    <?php displayRandomElement($currentDetailTitle); ?></p>
                                                                <a href="/projects/"><img
                                                                        src="http://wpdemos.themezaa.com/h-code/wp-content/uploads/2015/08/photography-13.jpg"
                                                                        width="33" height="33" alt=""
                                                                        class="width-auto margin-ten no-margin-bottom"/></a>
                                                            </div>
                                                        </figcaption>
                                                    </figure>
                                                </li>
                                                <li>
                                                    <?php
                                                    $filename = getRandomElement($arProjectImages);
                                                    $new_filen = $_SERVER["DOCUMENT_ROOT"].'/wp-content/uploads/' . basename($filename);


                                                    $fileNew = "/wp-content/uploads/" . basename($filename);

                                                    cropImage($filename,
                                                        $_SERVER['DOCUMENT_ROOT'] . $fileNew,
                                                        900, 900);
                                                    ?>
                                                    <img
                                                            src="<?php echo $fileNew; ?>" data-image="<?php echo $fileNew; ?>"
                                                            class="js-img" alt="" width="900" height="900"></li>
                                                <li>
                                                    <?php
                                                    $filename = getRandomElement($arProjectImages);
                                                    $new_filen = $_SERVER["DOCUMENT_ROOT"].'/wp-content/uploads/' . basename($filename);


                                                    $fileNew = "/wp-content/uploads/" . basename($filename);

                                                    cropImage($filename,
                                                        $_SERVER['DOCUMENT_ROOT'] . $fileNew,
                                                        900, 900);
                                                    ?>
                                                    <img
                                                            src="<?php echo $fileNew; ?>" data-image="<?php echo $fileNew; ?>"
                                                            class="js-img" alt="" width="900" height="900">
                                                    <figure>
                                                        <figcaption>
                                                            <div class="photography-grid-details text-center"><span
                                                                    class="title-med font-weight-100">
                                                                    <?php displayRandomElement($currentDetailTitle); ?>
                                                                </span>
                                                            </div>
                                                        </figcaption>
                                                    </figure>
                                                </li>
                                                <li>
                                                    <?php
                                                    $filename = getRandomElement($arProjectImages);
                                                    $new_filen = $_SERVER["DOCUMENT_ROOT"].'/wp-content/uploads/' . basename($filename);


                                                    $fileNew = "/wp-content/uploads/" . basename($filename);

                                                    cropImage($filename,
                                                        $_SERVER['DOCUMENT_ROOT'] . $fileNew,
                                                        900, 900);
                                                    ?>
                                                    <img
                                                            src="<?php echo $fileNew; ?>" data-image="<?php echo $fileNew; ?>"
                                                            class="js-img" alt="" width="900" height="900"></li>
                                                <li>
                                                    <?php
                                                    $filename = getRandomElement($arProjectImages);
                                                    $new_filen = $_SERVER["DOCUMENT_ROOT"].'/wp-content/uploads/' . basename($filename);


                                                    $fileNew = "/wp-content/uploads/" . basename($filename);

                                                    cropImage($filename,
                                                        $_SERVER['DOCUMENT_ROOT'] . $fileNew,
                                                        900, 900);
                                                    ?>
                                                    <img
                                                            src="<?php echo $fileNew; ?>" data-image="<?php echo $fileNew; ?>"
                                                            class="js-img" alt="" width="900" height="900"></li>
                                                <li>
                                                    <?php
                                                    $filename = getRandomElement($arProjectImages);
                                                    $new_filen = $_SERVER["DOCUMENT_ROOT"].'/wp-content/uploads/' . basename($filename);


                                                    $fileNew = "/wp-content/uploads/" . basename($filename);

                                                    cropImage($filename,
                                                        $_SERVER['DOCUMENT_ROOT'] . $fileNew,
                                                        900, 900);
                                                    ?>
                                                    <img
                                                            src="<?php echo $fileNew; ?>" data-image="<?php echo $fileNew; ?>"
                                                            class="js-img" alt="" width="900" height="900">
                                                    <div
                                                        class="img-border-small img-border-small-gray border-transperent-light"></div>
                                                    <figure>
                                                        <figcaption>
                                                            <div class="photography-grid-details">
                                                                <div
                                                                    class="separator-line-thick bg-white display-block no-margin-top"></div>
                                                                <span
                                                                    class="text-large letter-spacing-3 white-text font-weight-600"><a
                                                                        href="/services/" class="white-text">Мои услуги</a></span>
                                                                <div
                                                                    class="separator-line-thick bg-white display-block no-margin-bottom"></div>
                                                            </div>
                                                        </figcaption>
                                                    </figure>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
                <section class="  no-padding">
                    <div class="container-fluid">
                        <div class="row">
                            <div
                                class="wpb_column hcode-column-container  col-xs-mobile-fullwidth col-sm-12 no-padding">
                                <div class="vc-column-innner-wrapper">
                                    <div class="work-5col masonry wide photography-grid photography-services">
                                        <div class="tab-content">
                                            <ul class="grid masonry-block-items">



                                                <?php

                                                $categoryId = PORTFOLIO_WP_CATEGORY_SITES_ID;

                                                $args = array(
                                                    'numberposts' => 5,
                                                    'category' => $categoryId,
                                                    'orderby' => 'rand',
                                                    'order' => 'ASC',
                                                    'include' => array(),
                                                    'exclude' => array(),
                                                    'meta_key' => '',
                                                    'meta_value' => '',
                                                    'post_type' => 'post',
                                                    'suppress_filters' => true,
                                                    // подавление работы фильтров изменения SQL запроса
                                                );

                                                $posts = get_posts($args);

                                                $i = 0;
                                                foreach ($posts as $post) {
                                                    setup_postdata($post);


                                                    ?>


                                                    <li class="overflow-hidden ">
                                                        <div class="opacity-light bg-dark-gray"></div>
                                                        <?php
                                                        $filename = getRandomElement($arProjectImages);
                                                        $new_filen = $_SERVER["DOCUMENT_ROOT"].'/wp-content/uploads/' . basename($filename);


                                                        $fileNew = "/wp-content/uploads/" . basename($filename);

                                                        cropImage($filename,
                                                            $_SERVER['DOCUMENT_ROOT'] . $fileNew,
                                                            900, 1200);
                                                        ?>
                                                        <img
                                                                src="<?php echo $fileNew; ?>" data-image="<?php echo $fileNew; ?>"
                                                                class="js-img" alt="" width="900" height="1200">
                                                        <div
                                                                class="img-border-small img-border-small-gray border-transperent-light"></div>
                                                        <figure>
                                                            <figcaption>
                                                                <div class="photography-grid-details">
                                                                    <span
                                                                            class="text-large letter-spacing-9 font-weight-600 white-text"><a
                                                                                href="/projects/">
                                                                            <?php echo $post->post_title;?>
                                                                        </a>
                                                                    </span>
                                                                </div>
                                                                <a class="btn-small-white btn btn-small no-margin-right"
                                                                   href="http://wpdemos.themezaa.com/h-code/portfolio-lightbox/"
                                                                   target="_self">Посмотреть портфолио</a></figcaption>
                                                        </figure>
                                                    </li>




                                                    <?php
                                                    $i++;
                                                }

                                                wp_reset_postdata();
                                                ?>





                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
                <section class="  no-padding">
                    <div class="container-fluid">
                        <div class="row">
                            <div
                                class="wpb_column hcode-column-container  col-xs-mobile-fullwidth col-sm-12 no-padding">
                                <div class="vc-column-innner-wrapper">
                                    <div class="work-5col masonry wide photography-grid">
                                        <div class="tab-content">
                                            <ul class="grid masonry-block-items">
                                                <li>
                                                    <?php
                                                    $filename = getRandomElement($arProjectImages);
                                                    $new_filen = $_SERVER["DOCUMENT_ROOT"].'/wp-content/uploads/' . basename($filename);


                                                    $fileNew = "/wp-content/uploads/" . basename($filename);

                                                    cropImage($filename,
                                                        $_SERVER['DOCUMENT_ROOT'] . $fileNew,
                                                        900, 900);
                                                    ?>
                                                    <img
                                                        src="http://wpdemos.themezaa.com/h-code/wp-content/uploads/2015/08/photography-07.jpg"
                                                        alt="" width="900" height="900"></li>
                                                <li>
                                                    <?php
                                                    $filename = getRandomElement($arProjectImages);
                                                    $new_filen = $_SERVER["DOCUMENT_ROOT"].'/wp-content/uploads/' . basename($filename);


                                                    $fileNew = "/wp-content/uploads/" . basename($filename);

                                                    cropImage($filename,
                                                        $_SERVER['DOCUMENT_ROOT'] . $fileNew,
                                                        900, 900);
                                                    ?>
                                                    <img
                                                            src="<?php echo $fileNew; ?>" data-image="<?php echo $fileNew; ?>"
                                                            class="js-img" alt="" width="900" height="900">
                                                    <div
                                                        class="img-border-small img-border-small-gray border-transperent-light"></div>
                                                    <figure>
                                                        <figcaption>
                                                            <div class="photography-grid-details">
                                                                <div
                                                                    class="separator-line-thick bg-white display-block no-margin-top"></div>
                                                                <span
                                                                    class="text-large letter-spacing-3 white-text font-weight-600"><a
                                                                        href="/sertificates/"
                                                                        class="white-text">Сертификаты</a></span>
                                                                <div
                                                                    class="separator-line-thick bg-white display-block no-margin-bottom"></div>
                                                            </div>
                                                        </figcaption>
                                                    </figure>
                                                </li>
                                                <li>
                                                    <?php
                                                    $filename = getRandomElement($arProjectImages);
                                                    $new_filen = $_SERVER["DOCUMENT_ROOT"].'/wp-content/uploads/' . basename($filename);


                                                    $fileNew = "/wp-content/uploads/" . basename($filename);

                                                    cropImage($filename,
                                                        $_SERVER['DOCUMENT_ROOT'] . $fileNew,
                                                        900, 900);
                                                    ?>
                                                    <img
                                                            src="<?php echo $fileNew; ?>" data-image="<?php echo $fileNew; ?>"
                                                            class="js-img" alt="" width="900" height="900"></li>
                                                <li>
                                                    <?php
                                                    $filename = getRandomElement($arProjectImages);
                                                    $new_filen = $_SERVER["DOCUMENT_ROOT"].'/wp-content/uploads/' . basename($filename);


                                                    $fileNew = "/wp-content/uploads/" . basename($filename);

                                                    cropImage($filename,
                                                        $_SERVER['DOCUMENT_ROOT'] . $fileNew,
                                                        900, 900);
                                                    ?>
                                                    <img
                                                            src="<?php echo $fileNew; ?>" data-image="<?php echo $fileNew; ?>"
                                                            class="js-img" alt="" width="900" height="900">
                                                    <figure>
                                                        <figcaption>
                                                            <div class="photography-grid-details"><p
                                                                    class="text-med gray-text text-transform-unset width-90 center-col">
                                                                    <?php displayRandomElement($currentDetailTitle); ?></p>
                                                                <a href="/skills/"><img
                                                                        src="http://wpdemos.themezaa.com/h-code/wp-content/uploads/2015/08/photography-13.jpg"
                                                                        width="33" height="33" alt=""
                                                                        class="width-auto margin-ten no-margin-bottom"/></a>
                                                            </div>
                                                        </figcaption>
                                                    </figure>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
                <section class="  no-padding-top">
                    <div class="container-fluid">
                        <div class="row">
                            <div
                                class="wpb_column hcode-column-container  col-xs-mobile-fullwidth col-sm-12 no-padding margin-three-top sm-margin-six-top">
                                <div class="vc-column-innner-wrapper">
                                    <div class="col-md-12 text-center">
                                        <div class="text-center">
                                            <ul class="portfolio-filter nav nav-tabs nav-tabs-gray" 
                                            style="height:auto; margin-bottom:20px;">
                                                <?php
                                                include $_SERVER['DOCUMENT_ROOT'] . '/includes/portfolio_filter.php';
                                                ?>
                                            </ul>
                                        </div>
                                    </div>
                                    <div class="work-4col gutter work-with-title ">
                                        <div
                                            class="col-md-12  no-padding grid-gallery overflow-hidden  content-section">
                                            <div class="tab-content">
                                                <ul class="grid masonry-items lightbox-gallery">




                                                    <?php
                                                    include $_SERVER['DOCUMENT_ROOT'] . '/includes/portfolio_grid_gallery.php';
                                                    ?>





                                                                    <?php
                                                                    foreach ($posts as $post) {

                                                                        $private = get_post_meta($post->ID, 'PRIVATE');

                                                                        //?mode=private
                                                                        if ((!isset($_SESSION["mode"]) || ($_SESSION["mode"] != "private")) &&
                                                                            ($private[0] == "1")
                                                                        ) {
                                                                            continue;
                                                                        }

                                                                        setup_postdata($post);

                                                                        ?>

                                                                        <?php
                                                                        $thumb_id = get_post_thumbnail_id($post->ID);
                                                                        $thumb_url = wp_get_attachment_image_src($thumb_id, 'full',
                                                                            false);

                                                                        $thumb_url[0] = str_replace(get_site_url(),
                                                                            PORTFOLIO_WP_URL,
                                                                            $thumb_url[0]);

                                                                        $thumb_url_medium = wp_get_attachment_image_src($thumb_id, 'large',
                                                                            false);
                                                                        $thumb_url_medium[0] = str_replace(get_site_url(),
                                                                            PORTFOLIO_WP_URL,
                                                                            $thumb_url_medium[0]);

                                                                        $arPostTags = wp_get_post_tags($post->ID);

                                                                        ?>




                                                                        <li class="<?php
                                                                        foreach ($arPostTags as $keyTag => $tag) {
                                                                            echo " portfolio-filter-".$tag->term_id;

                                                                        }
                                                                        ?>">
                                                                            <figure>
                                                                                <div class="gallery-img"><a
                                                                                            href="<?php echo $thumb_url[0]; ?>"
                                                                                            class="lightboxgalleryitem"
                                                                                            data-group="general"><img
                                                                                                data-image="<?php echo $thumb_url[0]; ?>"
                                                                                                class="js-img"
                                                                                                src="<?php echo $thumb_url_medium[0]; ?>" width="900" height="900" alt=""></a></div>
                                                                                <figcaption><h3><?php echo $post->post_title; ?></h3>
                                                                                    <p><?php if(in_array($post->ID, $arNewProjects)){ ?>
                                                                                            New
                                                                                        <?php } ?></p>
                                                                                    <div
                                                                                            class="separator-line-thick display-block no-margin-bottom"
                                                                                            style="background:#ff513b;height:2px;"></div>
                                                                                </figcaption>
                                                                            </figure>
                                                                        </li>


                                                                        <?php
                                                                        $i++;

                                                                    }
                                                                    ?>



                                                                    <?php

                                                                    wp_reset_postdata(); // сброс
                                                                    ?>




                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
                <section class="  fix-background is-background"
                         data-image="<?php displayRandomElement($currentBackgroundImage); ?>"
                         style=" background-image: url(); ">
                    <div class="selection-overlay" style=" opacity:0.8; background-color:#f4f5f6;"></div>
                    <div class="container">
                        <div class="row">
                            <div
                                class="wpb_column hcode-column-container  col-md-6 col-xs-mobile-fullwidth
                                col-sm-10 text-center center-col wow bounce">
                                <div class="vc-column-innner-wrapper">
                                    <div class="testimonial-style2"><i
                                            class="fa fa-quote-left medium-icon margin-five no-margin-top"
                                            style="color:#000000 !important"></i><h6
                                            class="line-height text-small text-uppercase letter-spacing-3"><span
                                                class="text-small text-uppercase letter-spacing-3">
                                                <?php displayRandomElement($currentDetailTitle); ?></span>
                                        </h6> <span class="name light-gray-text2" style="color:#000000 !important">
                                            <?php displayRandomElement($arPostTagsNames); ?>
                                        </span>
                                    </div>
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
include $_SERVER['DOCUMENT_ROOT'] . '/includes/detail_pagination_margin-top.php';
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