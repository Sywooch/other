<?php
/**
 * Created by PhpStorm.
 * User: GSU
 * Date: 29.07.2017
 * Time: 15:14
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
<body class="page-template-default page page-id-38 wpb-js-composer js-comp-ver-5.1 vc_responsive">
<section class="parent-section no-padding post-38 page type-page status-publish hentry">
    <div class="container-fluid">
        <div class="row">
            <div class="entry-content">
                <section class=" no-transition intro-page no-padding">
                    <div class="container-fluid">
                        <div class="row">
                            <div class="wpb_column hcode-column-container  col-xs-mobile-fullwidth no-padding">
                                <div class="vc-column-innner-wrapper">
                                    <div class="wpb_revslider_element wpb_content_element">
                                        <link
                                            href="http://fonts.googleapis.com/css?family=Open+Sans:300%2C700%2C800%2C600|Roboto:300%2C500"
                                            rel="stylesheet" property="stylesheet" type="text/css" media="all">
                                        <div id="rev_slider_15_1_wrapper"
                                             class="rev_slider_wrapper fullscreen-container" data-source="gallery"
                                             style="background:transparent;padding:0px;">
                                            <div id="rev_slider_15_1" class="rev_slider fullscreenbanner"
                                                 style="display:none;" data-version="5.4.1">
                                                <ul>
                                                    <?php
                                                    $filename = getRandomElement($arProjectImages);

                                                    ?>
                                                    <li data-index="rs-84" data-transition="curtain-3"
                                                        data-slotamount="1" data-hideafterloop="0"
                                                        data-hideslideonmobile="off" data-easein="default"
                                                        data-easeout="default" data-masterspeed="500"
                                                        data-thumb="<?php echo $filename; ?>"
                                                        data-delay="8000" data-rotate="0" data-saveperformance="off"
                                                        class="no-transition" data-title="HELLO WORLD" data-param1=""
                                                        data-param2="" data-param3="" data-param4="" data-param5=""
                                                        data-param6="" data-param7="" data-param8="" data-param9=""
                                                        data-param10="" data-description="">
                                                        <?php
                                                        $filename = getRandomElement($arProjectImages);
                                                        $new_filen = $_SERVER["DOCUMENT_ROOT"].'/wp-content/uploads/' . basename($filename);


                                                        $fileNew = "/wp-content/uploads/" . basename($filename);

                                                        $fileNew = cropImage($filename,
                                                            $_SERVER['DOCUMENT_ROOT'] . $fileNew,
                                                            1920, 1080);
                                                        ?>
                                                        <img
                                                            src="http://wpdemos.themezaa.com/h-code/wp-content/plugins/revslider/admin/assets/images/dummy.png"
                                                            alt="" title="intro-travel-03-bg.jpg" width="1920"
                                                            height="1080"
                                                            data-lazyload="<?php echo $fileNew; ?>"
                                                            data-bgposition="center bottom" data-bgfit="cover"
                                                            data-bgrepeat="no-repeat" class="rev-slidebg"
                                                            data-no-retina>
                                                        <div class="tp-caption   tp-resizeme" id="slide-84-layer-1"
                                                             data-x="" data-y="center" data-voffset=""
                                                             data-width="['none','none','none','none']"
                                                             data-height="['none','none','none','none']"
                                                             data-type="image" data-responsive_offset="on"
                                                             data-frames='[{"from":"x:-50px;opacity:0;","speed":600,"to":"o:1;","delay":800,"ease":"Power4.easeOut"},{"delay":6000,"speed":600,"to":"x:-50px;opacity:0;","ease":"Power4.easeIn"}]'
                                                             data-textAlign="['left','left','left','left']"
                                                             data-paddingtop="[0,0,0,0]" data-paddingright="[0,0,0,0]"
                                                             data-paddingbottom="[0,0,0,0]" data-paddingleft="[0,0,0,0]"
                                                             style="z-index: 5;text-transform:uppercase;z-index:2;">

                                                            <?php
                                                            $filename = getRandomElement($arProjectImages);
                                                            $new_filen = $_SERVER["DOCUMENT_ROOT"].'/wp-content/uploads/' . basename($filename);


                                                            $fileNew = "/wp-content/uploads/" . basename($filename);

                                                            $fileNew = cropImage($filename,
                                                                $_SERVER['DOCUMENT_ROOT'] . $fileNew,
                                                                531, 140);
                                                            ?>
                                                            <img
                                                                src="http://wpdemos.themezaa.com/h-code/wp-content/plugins/revslider/admin/assets/images/dummy.png"
                                                                alt="" data-ww="531px" data-hh="140px" width="531"
                                                                height="140"
                                                                data-lazyload="<?php echo $fileNew; ?>"
                                                                data-no-retina></div>
                                                        <div class="tp-caption   tp-resizeme" id="slide-84-layer-2"
                                                             data-x="right" data-hoffset="" data-y="center"
                                                             data-voffset="210"
                                                             data-width="['none','none','none','none']"
                                                             data-height="['none','none','none','none']"
                                                             data-type="image" data-responsive_offset="on"
                                                             data-frames='[{"from":"x:right;","speed":800,"to":"o:1;","delay":1300,"ease":"Power4.easeOut"},{"delay":5600,"speed":600,"to":"x:right;","ease":"Power4.easeIn"}]'
                                                             data-textAlign="['left','left','left','left']"
                                                             data-paddingtop="[0,0,0,0]" data-paddingright="[0,0,0,0]"
                                                             data-paddingbottom="[0,0,0,0]" data-paddingleft="[0,0,0,0]"
                                                             style="z-index: 6;text-transform:uppercase;z-index:10;">
                                                            <?php
                                                            $filename = getRandomElement($arProjectImages);
                                                            $new_filen = $_SERVER["DOCUMENT_ROOT"].'/wp-content/uploads/' . basename($filename);


                                                            $fileNew = "/wp-content/uploads/" . basename($filename);

                                                            $fileNew = cropImage($filename,
                                                                $_SERVER['DOCUMENT_ROOT'] . $fileNew,
                                                                833, 586);
                                                            ?>
                                                            <img
                                                                src="http://wpdemos.themezaa.com/h-code/wp-content/plugins/revslider/admin/assets/images/dummy.png"
                                                                alt="" data-ww="833px" data-hh="586px" width="833"
                                                                height="586"
                                                                data-lazyload="<?php echo $fileNew; ?>"
                                                                data-no-retina></div>
                                                        <div class="tp-caption   tp-resizeme" id="slide-84-layer-3"
                                                             data-x="right" data-hoffset="350" data-y="center"
                                                             data-voffset="" data-width="['none','none','none','none']"
                                                             data-height="['none','none','none','none']"
                                                             data-type="image" data-responsive_offset="on"
                                                             data-frames='[{"from":"x:right;","speed":600,"to":"o:1;","delay":1800,"ease":"Power4.easeOut"},{"delay":5000,"speed":600,"to":"x:right;","ease":"Power4.easeIn"}]'
                                                             data-textAlign="['left','left','left','left']"
                                                             data-paddingtop="[0,0,0,0]" data-paddingright="[0,0,0,0]"
                                                             data-paddingbottom="[0,0,0,0]" data-paddingleft="[0,0,0,0]"
                                                             style="z-index: 7;text-transform:uppercase;z-index:8;">
                                                            <?php
                                                            $filename = getRandomElement($arProjectImages);
                                                            $new_filen = $_SERVER["DOCUMENT_ROOT"].'/wp-content/uploads/' . basename($filename);


                                                            $fileNew = "/wp-content/uploads/" . basename($filename);

                                                            $fileNew = cropImage($filename,
                                                                $_SERVER['DOCUMENT_ROOT'] . $fileNew,
                                                                355, 753);
                                                            ?>
                                                            <img
                                                                src="http://wpdemos.themezaa.com/h-code/wp-content/plugins/revslider/admin/assets/images/dummy.png"
                                                                alt="" data-ww="355px" data-hh="753px" width="355"
                                                                height="753"
                                                                data-lazyload="<?php echo $fileNew; ?>"
                                                                data-no-retina></div>
                                                        <div class="tp-caption Fashion-BigDisplay   tp-resizeme"
                                                             id="slide-84-layer-4" data-x="center" data-hoffset="-220"
                                                             data-y="center" data-voffset="" data-width="['auto']"
                                                             data-height="['auto']" data-type="text"
                                                             data-responsive_offset="on"
                                                             data-frames='[{"from":"y:50px;opacity:0;","speed":600,"to":"o:1;","delay":1300,"ease":"Power4.easeOut"},{"delay":1500,"speed":600,"to":"y:-50px;opacity:0;","ease":"Power4.easeIn"}]'
                                                             data-textAlign="['left','left','left','left']"
                                                             data-paddingtop="[0,0,0,0]" data-paddingright="[0,0,0,0]"
                                                             data-paddingbottom="[0,0,0,0]" data-paddingleft="[0,0,0,0]"
                                                             style="z-index: 8; white-space: nowrap; font-size: 32px; line-height: 40px; font-weight: 300; color: rgba(255,255,255,1);font-family:Open Sans;text-transform:uppercase;text-decoration:none;z-index:2;letter-spacing:4px;">
                                                            <?php echo $arProject["post_title"];?>
                                                        </div>
                                                        <div class="tp-caption Fashion-BigDisplay   tp-resizeme"
                                                             id="slide-84-layer-5" data-x="center" data-hoffset="-239"
                                                             data-y="center" data-voffset="" data-width="['auto']"
                                                             data-height="['auto']" data-type="text"
                                                             data-responsive_offset="on"
                                                             data-frames='[{"from":"y:50px;opacity:0;","speed":600,"to":"o:1;","delay":4500,"ease":"Power4.easeOut"},{"delay":2300,"speed":600,"to":"y:bottom;","ease":"Power4.easeIn"}]'
                                                             data-textAlign="['left','left','left','left']"
                                                             data-paddingtop="[0,0,0,0]" data-paddingright="[0,0,0,0]"
                                                             data-paddingbottom="[0,0,0,0]" data-paddingleft="[0,0,0,0]"
                                                             style="z-index: 9; white-space: nowrap; font-size: 32px; line-height: 40px; font-weight: 300; color: rgba(255,255,255,1);font-family:Open Sans;text-transform:uppercase;text-decoration:none;z-index:2;letter-spacing:4px;">
                                                            <?php echo implode("  ", $arPostTagsNames); ?>
                                                        </div>
                                                    </li>
                                                    <?php
                                                    $filename = getRandomElement($arProjectImages);
                                                    $new_filen = $_SERVER["DOCUMENT_ROOT"].'/wp-content/uploads/' . basename($filename);


                                                    $fileNew = "/wp-content/uploads/" . basename($filename);

                                                    $fileNew = cropImage($filename,
                                                        $_SERVER['DOCUMENT_ROOT'] . $fileNew,
                                                        100, 50);
                                                    ?>
                                                    <li data-index="rs-85" data-transition="curtain-3"
                                                        data-slotamount="1" data-hideafterloop="0"
                                                        data-hideslideonmobile="off" data-easein="default"
                                                        data-easeout="default" data-masterspeed="500"
                                                        data-thumb="<?php echo $fileNew; ?>100x50.jpg"
                                                        data-delay="10000" data-rotate="0" data-saveperformance="off"
                                                        class="no-transition" data-title="HELLO WORLD" data-param1=""
                                                        data-param2="" data-param3="" data-param4="" data-param5=""
                                                        data-param6="" data-param7="" data-param8="" data-param9=""
                                                        data-param10="" data-description="">
                                                        <?php
                                                        $filename = getRandomElement($arProjectImages);
                                                        $new_filen = $_SERVER["DOCUMENT_ROOT"].'/wp-content/uploads/' . basename($filename);


                                                        $fileNew = "/wp-content/uploads/" . basename($filename);

                                                        $fileNew = cropImage($filename,
                                                            $_SERVER['DOCUMENT_ROOT'] . $fileNew,
                                                            1920, 1080);
                                                        ?>
                                                        <img
                                                            src="http://wpdemos.themezaa.com/h-code/wp-content/plugins/revslider/admin/assets/images/dummy.png"
                                                            alt="" title="intro-travel-01-bg.jpg" width="1920"
                                                            height="1080"
                                                            data-lazyload="<?php echo $fileNew; ?>"
                                                            data-bgposition="center center" data-kenburns="on"
                                                            data-duration="10000" data-ease="Linear.easeNone"
                                                            data-scalestart="100" data-scaleend="130"
                                                            data-rotatestart="0" data-rotateend="0" data-blurstart="0"
                                                            data-blurend="0" data-offsetstart="0 0" data-offsetend="0 0"
                                                            class="rev-slidebg" data-no-retina>
                                                        <div class="tp-caption Fashion-BigDisplay   tp-resizeme"
                                                             id="slide-85-layer-1" data-x="200" data-y="center"
                                                             data-voffset="-150" data-width="['auto']"
                                                             data-height="['auto']" data-type="text"
                                                             data-responsive_offset="on"
                                                             data-frames='[{"from":"y:-50px;opacity:0;","speed":600,"to":"o:1;","delay":1300,"ease":"Power4.easeOut"},{"delay":2500,"speed":600,"to":"y:-50px;opacity:0;","ease":"Power4.easeIn"}]'
                                                             data-textAlign="['left','left','left','left']"
                                                             data-paddingtop="[0,0,0,0]" data-paddingright="[0,0,0,0]"
                                                             data-paddingbottom="[0,0,0,0]" data-paddingleft="[0,0,0,0]"
                                                             style="z-index: 10; white-space: nowrap; font-size: 90px; font-weight: 700; color: rgba(255,255,255,1);font-family:Open Sans;text-transform:uppercase;z-index:2;position:absolute;margin:0px;white-space:nowrap;letter-spacing:-2px;">
                                                            <?php echo $ProjectCLIENT; ?>
                                                        </div>
                                                        <div class="tp-caption Fashion-BigDisplay   tp-resizeme"
                                                             id="slide-85-layer-2" data-x="200" data-y="center"
                                                             data-voffset="-60" data-width="['auto']"
                                                             data-height="['auto']" data-type="text"
                                                             data-responsive_offset="on"
                                                             data-frames='[{"from":"x:50px;opacity:0;","speed":600,"to":"o:1;","delay":1800,"ease":"Power4.easeOut"},{"delay":2000,"speed":600,"to":"x:50px;opacity:0;","ease":"Power4.easeIn"}]'
                                                             data-textAlign="['left','left','left','left']"
                                                             data-paddingtop="[0,0,0,0]" data-paddingright="[0,0,0,0]"
                                                             data-paddingbottom="[0,0,0,0]" data-paddingleft="[0,0,0,0]"
                                                             style="z-index: 11; white-space: nowrap; font-size: 125px; font-weight: 800; color: rgba(255,255,255,1);font-family:Open Sans;text-transform:uppercase;z-index:2;position:absolute;margin:0px;white-space:nowrap;letter-spacing:-2px;">
                                                            <?php echo $ProjectTYPE; ?>
                                                        </div>
                                                        <div class="tp-caption Fashion-BigDisplay   tp-resizeme"
                                                             id="slide-85-layer-3" data-x="208" data-y="center"
                                                             data-voffset="30" data-width="['auto']"
                                                             data-height="['auto']" data-type="text"
                                                             data-responsive_offset="on"
                                                             data-frames='[{"from":"opacity:0;","speed":600,"to":"o:1;","delay":2200,"ease":"Power2.easeInOut"},{"delay":1600,"speed":600,"to":"opacity:0;","ease":"Power4.easeIn"}]'
                                                             data-textAlign="['left','left','left','left']"
                                                             data-paddingtop="[0,0,0,0]" data-paddingright="[0,0,0,0]"
                                                             data-paddingbottom="[0,0,0,0]" data-paddingleft="[0,0,0,0]"
                                                             style="z-index: 12; white-space: nowrap; font-size: 70px; font-weight: 600; color: rgba(255,255,255,1);font-family:Open Sans;text-transform:uppercase;z-index:2;position:absolute;margin:0px;white-space:nowrap;letter-spacing:-2px;">
                                                            <?php echo $YEAR; ?>
                                                        </div>
                                                        <div class="tp-caption Fashion-BigDisplay   tp-resizeme"
                                                             id="slide-85-layer-4" data-x="350" data-y="center"
                                                             data-voffset="45" data-width="['auto']"
                                                             data-height="['auto']" data-type="text"
                                                             data-responsive_offset="on"
                                                             data-frames='[{"from":"x:50px;opacity:0;","speed":600,"to":"o:1;","delay":2800,"ease":"Power4.easeOut"},{"delay":1000,"speed":600,"to":"x:50px;opacity:0;","ease":"Power4.easeIn"}]'
                                                             data-textAlign="['left','left','left','left']"
                                                             data-paddingtop="[0,0,0,0]" data-paddingright="[0,0,0,0]"
                                                             data-paddingbottom="[0,0,0,0]" data-paddingleft="[0,0,0,0]"
                                                             style="z-index: 13; white-space: nowrap; font-size: 125px; font-weight: 800; color: rgba(255,255,255,1);font-family:Open Sans;text-transform:uppercase;z-index:2;position:absolute;margin:0px;white-space:nowrap;letter-spacing:-2px;">
                                                            <?php displayRandomElement($arPostTagsNames); ?>
                                                        </div>
                                                        <div class="tp-caption Fashion-BigDisplay   tp-resizeme"
                                                             id="slide-85-layer-5" data-x="470" data-y="center"
                                                             data-voffset="140" data-width="['auto']"
                                                             data-height="['auto']" data-type="text"
                                                             data-responsive_offset="on"
                                                             data-frames='[{"from":"y:50px;opacity:0;","speed":600,"to":"o:1;","delay":3300,"ease":"Power4.easeOut"},{"delay":500,"speed":600,"to":"y:50px;opacity:0;","ease":"Power4.easeIn"}]'
                                                             data-textAlign="['left','left','left','left']"
                                                             data-paddingtop="[0,0,0,0]" data-paddingright="[0,0,0,0]"
                                                             data-paddingbottom="[0,0,0,0]" data-paddingleft="[0,0,0,0]"
                                                             style="z-index: 14; white-space: nowrap; font-size: 70px; font-weight: 800; color: rgba(255,255,255,1);font-family:Open Sans;text-transform:uppercase;z-index:2;position:absolute;margin:0px;white-space:nowrap;letter-spacing:-2px;">
                                                            <?php displayRandomElement($arPostTagsNames); ?>
                                                        </div>
                                                        <div class="tp-caption Fashion-BigDisplay   tp-resizeme"
                                                             id="slide-85-layer-6" data-x="200" data-y="center"
                                                             data-voffset="-150" data-width="['auto']"
                                                             data-height="['auto']" data-type="text"
                                                             data-responsive_offset="on"
                                                             data-frames='[{"from":"y:-50px;opacity:0;","speed":600,"to":"o:1;","delay":5300,"ease":"Power4.easeOut"},{"delay":3500,"speed":600,"to":"y:50px;opacity:0;","ease":"Power4.easeIn"}]'
                                                             data-textAlign="['left','left','left','left']"
                                                             data-paddingtop="[0,0,0,0]" data-paddingright="[0,0,0,0]"
                                                             data-paddingbottom="[0,0,0,0]" data-paddingleft="[0,0,0,0]"
                                                             style="z-index: 15; white-space: nowrap; font-size: 90px; font-weight: 800; color: rgba(255,255,255,1);font-family:Open Sans;text-transform:uppercase;z-index:2;position:absolute;margin:0px;white-space:nowrap;letter-spacing:-2px;">
                                                            <?php displayRandomElement($arPostTagsNames); ?>
                                                        </div>
                                                        <div class="tp-caption Fashion-BigDisplay   tp-resizeme"
                                                             id="slide-85-layer-7" data-x="200" data-y="center"
                                                             data-voffset="-60" data-width="['auto']"
                                                             data-height="['auto']" data-type="text"
                                                             data-responsive_offset="on"
                                                             data-frames='[{"from":"x:50px;opacity:0;","speed":600,"to":"o:1;","delay":5800,"ease":"Power4.easeOut"},{"delay":3000,"speed":600,"to":"y:50px;opacity:0;","ease":"Power4.easeIn"}]'
                                                             data-textAlign="['left','left','left','left']"
                                                             data-paddingtop="[0,0,0,0]" data-paddingright="[0,0,0,0]"
                                                             data-paddingbottom="[0,0,0,0]" data-paddingleft="[0,0,0,0]"
                                                             style="z-index: 16; white-space: nowrap; font-size: 125px; font-weight: 800; color: rgba(255,255,255,1);font-family:Open Sans;text-transform:uppercase;z-index:2;position:absolute;margin:0px;white-space:nowrap;letter-spacing:-2px;">
                                                            <?php displayRandomElement($arPostTagsNames); ?>
                                                        </div>
                                                        <div class="tp-caption Fashion-BigDisplay   tp-resizeme"
                                                             id="slide-85-layer-8" data-x="208" data-y="center"
                                                             data-voffset="30" data-width="['auto']"
                                                             data-height="['auto']" data-type="text"
                                                             data-responsive_offset="on"
                                                             data-frames='[{"from":"x:-50px;opacity:0;","speed":600,"to":"o:1;","delay":6200,"ease":"Power4.easeOut"},{"delay":2600,"speed":600,"to":"y:50px;opacity:0;","ease":"Power4.easeIn"}]'
                                                             data-textAlign="['left','left','left','left']"
                                                             data-paddingtop="[0,0,0,0]" data-paddingright="[0,0,0,0]"
                                                             data-paddingbottom="[0,0,0,0]" data-paddingleft="[0,0,0,0]"
                                                             style="z-index: 17; white-space: nowrap; font-size: 70px; font-weight: 800; color: rgba(255,255,255,1);font-family:Open Sans;text-transform:uppercase;z-index:2;position:absolute;margin:0px;white-space:nowrap;letter-spacing:-2px;">
                                                            <?php displayRandomElement($arPostTagsNames); ?>
                                                        </div>
                                                        <div class="tp-caption Fashion-BigDisplay   tp-resizeme"
                                                             id="slide-85-layer-9" data-x="350" data-y="center"
                                                             data-voffset="110" data-width="['auto']"
                                                             data-height="['auto']" data-type="text"
                                                             data-responsive_offset="on"
                                                             data-frames='[{"from":"opacity:0;","speed":600,"to":"o:1;","delay":6800,"ease":"Power2.easeInOut"},{"delay":2000,"speed":600,"to":"opacity:0;","ease":"Power4.easeIn"}]'
                                                             data-textAlign="['left','left','left','left']"
                                                             data-paddingtop="[0,0,0,0]" data-paddingright="[0,0,0,0]"
                                                             data-paddingbottom="[0,0,0,0]" data-paddingleft="[0,0,0,0]"
                                                             style="z-index: 18; white-space: nowrap; font-size: 125px; font-weight: 800; color: rgba(255,255,255,1);font-family:Open Sans;text-transform:uppercase;z-index:2;position:absolute;margin:0px;white-space:nowrap;letter-spacing:-2px;">
                                                            <?php displayRandomElement($arPostTagsNames); ?>
                                                        </div>
                                                    </li>

                                                    <?php
                                                    $filename = getRandomElement($arProjectImages);
                                                    $new_filen = $_SERVER["DOCUMENT_ROOT"].'/wp-content/uploads/' . basename($filename);


                                                    $fileNew = "/wp-content/uploads/" . basename($filename);

                                                    $fileNew = cropImage($filename,
                                                        $_SERVER['DOCUMENT_ROOT'] . $fileNew,
                                                        100, 50);
                                                    ?>
                                                    <li data-index="rs-86" data-transition="curtain-3"
                                                        data-slotamount="1" data-hideafterloop="0"
                                                        data-hideslideonmobile="off" data-easein="default"
                                                        data-easeout="default" data-masterspeed="500"
                                                        data-thumb="<?php echo $fileNew; ?>100x50.jpg"
                                                        data-delay="11000" data-rotate="0" data-saveperformance="off"
                                                        class="no-transition" data-title="SERVICES" data-param1=""
                                                        data-param2="" data-param3="" data-param4="" data-param5=""
                                                        data-param6="" data-param7="" data-param8="" data-param9=""
                                                        data-param10="" data-description="">
                                                        <?php
                                                        $filename = getRandomElement($arProjectImages);
                                                        $new_filen = $_SERVER["DOCUMENT_ROOT"].'/wp-content/uploads/' . basename($filename);


                                                        $fileNew = "/wp-content/uploads/" . basename($filename);

                                                        $fileNew = cropImage($filename,
                                                            $_SERVER['DOCUMENT_ROOT'] . $fileNew,
                                                            1920, 1080);
                                                        ?>
                                                        <img
                                                            src="http://wpdemos.themezaa.com/h-code/wp-content/plugins/revslider/admin/assets/images/dummy.png"
                                                            alt="" title="intro-travel-03-bg.jpg" width="1920"
                                                            height="1080"
                                                            data-lazyload="<?php echo $fileNew; ?>"
                                                            data-bgposition="center bottom" data-bgfit="cover"
                                                            data-bgrepeat="no-repeat" class="rev-slidebg"
                                                            data-no-retina>
                                                        <div class="tp-caption   tp-resizeme" id="slide-86-layer-1"
                                                             data-x="" data-y="-20"
                                                             data-width="['none','none','none','none']"
                                                             data-height="['none','none','none','none']"
                                                             data-type="image" data-responsive_offset="on"
                                                             data-frames='[{"from":"x:-50px;opacity:0;","speed":600,"to":"o:1;","delay":1300,"ease":"Power4.easeOut"},{"delay":8500,"speed":600,"to":"x:50px;opacity:0;","ease":"Power4.easeIn"}]'
                                                             data-textAlign="['left','left','left','left']"
                                                             data-paddingtop="[0,0,0,0]" data-paddingright="[0,0,0,0]"
                                                             data-paddingbottom="[0,0,0,0]" data-paddingleft="[0,0,0,0]"
                                                             style="z-index: 19;text-transform:uppercase;z-index:2;">
                                                            <?php
                                                            $filename = getRandomElement($arProjectImages);
                                                            $new_filen = $_SERVER["DOCUMENT_ROOT"].'/wp-content/uploads/' . basename($filename);


                                                            $fileNew = "/wp-content/uploads/" . basename($filename);

                                                            $fileNew = cropImage($filename,
                                                                $_SERVER['DOCUMENT_ROOT'] . $fileNew,
                                                                600, 160);
                                                            ?>
                                                            <img
                                                                src="http://wpdemos.themezaa.com/h-code/wp-content/plugins/revslider/admin/assets/images/dummy.png"
                                                                alt="" data-ww="600px" data-hh="160px" width="600"
                                                                height="160"
                                                                data-lazyload="<?php echo $fileNew; ?>"
                                                                data-no-retina></div>
                                                        <div class="tp-caption   tp-resizeme" id="slide-86-layer-2"
                                                             data-x="center" data-hoffset="" data-y="center"
                                                             data-voffset="-100"
                                                             data-width="['none','none','none','none']"
                                                             data-height="['none','none','none','none']"
                                                             data-type="image" data-responsive_offset="on"
                                                             data-frames='[{"from":"x:-50px;opacity:0;","speed":600,"to":"o:1;","delay":1500,"ease":"Power4.easeOut"},{"delay":8300,"speed":600,"to":"x:50px;opacity:0;","ease":"Power4.easeIn"}]'
                                                             data-textAlign="['left','left','left','left']"
                                                             data-paddingtop="[0,0,0,0]" data-paddingright="[0,0,0,0]"
                                                             data-paddingbottom="[0,0,0,0]" data-paddingleft="[0,0,0,0]"
                                                             style="z-index: 20;text-transform:uppercase;z-index:2;">
                                                            <?php
                                                            $filename = getRandomElement($arProjectImages);
                                                            $new_filen = $_SERVER["DOCUMENT_ROOT"].'/wp-content/uploads/' . basename($filename);


                                                            $fileNew = "/wp-content/uploads/" . basename($filename);

                                                            $fileNew = cropImage($filename,
                                                                $_SERVER['DOCUMENT_ROOT'] . $fileNew,
                                                                972, 436);
                                                            ?>
                                                            <img
                                                                src="http://wpdemos.themezaa.com/h-code/wp-content/plugins/revslider/admin/assets/images/dummy.png"
                                                                alt="" data-ww="972px" data-hh="436px" width="972"
                                                                height="436"
                                                                data-lazyload="<?php echo $fileNew; ?>"
                                                                data-no-retina></div>
                                                        <div class="tp-caption   tp-resizeme" id="slide-86-layer-3"
                                                             data-x="right" data-hoffset="" data-y=""
                                                             data-width="['none','none','none','none']"
                                                             data-height="['none','none','none','none']"
                                                             data-type="image" data-responsive_offset="on"
                                                             data-frames='[{"from":"x:-50px;opacity:0;","speed":600,"to":"o:1;","delay":1800,"ease":"Power4.easeOut"},{"delay":8000,"speed":600,"to":"x:50px;opacity:0;","ease":"Power4.easeIn"}]'
                                                             data-textAlign="['left','left','left','left']"
                                                             data-paddingtop="[0,0,0,0]" data-paddingright="[0,0,0,0]"
                                                             data-paddingbottom="[0,0,0,0]" data-paddingleft="[0,0,0,0]"
                                                             style="z-index: 21;text-transform:uppercase;z-index:2;">
                                                            <?php
                                                            $filename = getRandomElement($arProjectImages);
                                                            $new_filen = $_SERVER["DOCUMENT_ROOT"].'/wp-content/uploads/' . basename($filename);


                                                            $fileNew = "/wp-content/uploads/" . basename($filename);

                                                            $fileNew = cropImage($filename,
                                                                $_SERVER['DOCUMENT_ROOT'] . $fileNew,
                                                                812, 289);
                                                            ?>
                                                            <img
                                                                src="http://wpdemos.themezaa.com/h-code/wp-content/plugins/revslider/admin/assets/images/dummy.png"
                                                                alt="" data-ww="812px" data-hh="289px" width="812"
                                                                height="289"
                                                                data-lazyload="<?php echo $fileNew; ?>"
                                                                data-no-retina></div>
                                                        <div class="tp-caption   tp-resizeme" id="slide-86-layer-8"
                                                             data-x="right" data-hoffset="439" data-y="center"
                                                             data-voffset="-155"
                                                             data-width="['none','none','none','none']"
                                                             data-height="['none','none','none','none']"
                                                             data-type="image" data-responsive_offset="on"
                                                             data-frames='[{"from":"y:-50px;opacity:0;","speed":600,"to":"o:1;","delay":4200,"ease":"Power4.easeOut"},{"delay":5600,"speed":600,"to":"y:-50px;opacity:0;","ease":"Power4.easeIn"}]'
                                                             data-textAlign="['left','left','left','left']"
                                                             data-paddingtop="[0,0,0,0]" data-paddingright="[0,0,0,0]"
                                                             data-paddingbottom="[0,0,0,0]" data-paddingleft="[0,0,0,0]"
                                                             style="z-index: 22;text-transform:uppercase;z-index:2;">
                                                            <?php
                                                            $filename = getRandomElement($arProjectImages);
                                                            $new_filen = $_SERVER["DOCUMENT_ROOT"].'/wp-content/uploads/' . basename($filename);


                                                            $fileNew = "/wp-content/uploads/" . basename($filename);

                                                            $fileNew = cropImage($filename,
                                                                $_SERVER['DOCUMENT_ROOT'] . $fileNew,
                                                                60, 124);
                                                            ?>
                                                            <img
                                                                src="http://wpdemos.themezaa.com/h-code/wp-content/plugins/revslider/admin/assets/images/dummy.png"
                                                                alt="" data-ww="60px" data-hh="124px" width="60"
                                                                height="124"
                                                                data-lazyload="<?php echo $fileNew; ?>"
                                                                data-no-retina></div>
                                                        <div class="tp-caption Fashion-BigDisplay   tp-resizeme"
                                                             id="slide-86-layer-4" data-x="center" data-hoffset="-470"
                                                             data-y="center" data-voffset="-250" data-width="['526']"
                                                             data-height="['69']" data-type="text"
                                                             data-responsive_offset="on"
                                                             data-frames='[{"from":"y:-50px;opacity:0;","speed":600,"to":"o:1;","delay":2100,"ease":"Power4.easeOut"},{"delay":7700,"speed":600,"to":"y:-50px;opacity:0;","ease":"Power4.easeIn"}]'
                                                             data-textAlign="['left','left','left','left']"
                                                             data-paddingtop="[0,0,0,0]" data-paddingright="[0,0,0,0]"
                                                             data-paddingbottom="[0,0,0,0]" data-paddingleft="[0,0,0,0]"
                                                             style="z-index: 23; min-width: 526px; max-width: 526px; max-width: 69px; max-width: 69px; white-space: normal; font-size: 90px; font-weight: 800; color: rgba(255,255,255,1);font-family:Open Sans;text-transform:uppercase;z-index:2;position:absolute;margin:0px;white-space:nowrap;letter-spacing:-2px;">
                                                            <?php displayRandomElement($arPostTagsNames); ?>
                                                        </div>
                                                        <div class="tp-caption Fashion-BigDisplay   tp-resizeme"
                                                             id="slide-86-layer-5" data-x="center" data-hoffset="-495"
                                                             data-y="center" data-voffset="-150" data-width="['487']"
                                                             data-height="['auto']" data-type="text"
                                                             data-responsive_offset="on"
                                                             data-frames='[{"from":"x:50px;opacity:0;","speed":600,"to":"o:1;","delay":2600,"ease":"Power4.easeOut"},{"delay":7200,"speed":600,"to":"x:50px;opacity:0;","ease":"Power4.easeIn"}]'
                                                             data-textAlign="['left','left','left','left']"
                                                             data-paddingtop="[0,0,0,0]" data-paddingright="[0,0,0,0]"
                                                             data-paddingbottom="[0,0,0,0]" data-paddingleft="[0,0,0,0]"
                                                             style="z-index: 24; min-width: 487px; max-width: 487px; white-space: normal; font-size: 125px; font-weight: 800; color: rgba(255,255,255,1);font-family:Open Sans;text-transform:uppercase;z-index:2;position:absolute;margin:0px;white-space:nowrap;letter-spacing:-2px;">
                                                            <?php displayRandomElement($arPostTagsNames); ?>
                                                        </div>
                                                        <div class="tp-caption   tp-resizeme" id="slide-86-layer-6"
                                                             data-x="right" data-hoffset="20" data-y="bottom"
                                                             data-voffset="" data-width="['none','none','none','none']"
                                                             data-height="['none','none','none','none']"
                                                             data-type="image" data-responsive_offset="on"
                                                             data-frames='[{"from":"y:-50px;opacity:0;","speed":600,"to":"o:1;","delay":3600,"ease":"Power2.easeInOut"},{"delay":6200,"speed":600,"to":"y:-50px;opacity:0;","ease":"Power4.easeIn"}]'
                                                             data-textAlign="['left','left','left','left']"
                                                             data-paddingtop="[0,0,0,0]" data-paddingright="[0,0,0,0]"
                                                             data-paddingbottom="[0,0,0,0]" data-paddingleft="[0,0,0,0]"
                                                             style="z-index: 25;text-transform:left;">
                                                            <?php
                                                            $filename = getRandomElement($arProjectImages);
                                                            $new_filen = $_SERVER["DOCUMENT_ROOT"].'/wp-content/uploads/' . basename($filename);


                                                            $fileNew = "/wp-content/uploads/" . basename($filename);

                                                            $fileNew = cropImage($filename,
                                                                $_SERVER['DOCUMENT_ROOT'] . $fileNew,
                                                                765, 605);
                                                            ?>
                                                            <img
                                                                src="http://wpdemos.themezaa.com/h-code/wp-content/plugins/revslider/admin/assets/images/dummy.png"
                                                                alt="" data-ww="765px" data-hh="605px" width="765"
                                                                height="605"
                                                                data-lazyload="<?php echo $fileNew; ?>"
                                                                data-no-retina></div>
                                                        <div class="tp-caption   tp-resizeme" id="slide-86-layer-7"
                                                             data-x="right" data-hoffset="470" data-y="center"
                                                             data-voffset="-160"
                                                             data-width="['none','none','none','none']"
                                                             data-height="['none','none','none','none']"
                                                             data-type="image" data-responsive_offset="on"
                                                             data-frames='[{"from":"y:-50px;opacity:0;","speed":600,"to":"o:1;","delay":4000,"ease":"Power4.easeOut"},{"delay":5800,"speed":600,"to":"y:-50px;opacity:0;","ease":"Power4.easeIn"}]'
                                                             data-textAlign="['left','left','left','left']"
                                                             data-paddingtop="[0,0,0,0]" data-paddingright="[0,0,0,0]"
                                                             data-paddingbottom="[0,0,0,0]" data-paddingleft="[0,0,0,0]"
                                                             style="z-index: 26;text-transform:uppercase;z-index:2;">
                                                            <?php
                                                            $filename = getRandomElement($arProjectImages);
                                                            $new_filen = $_SERVER["DOCUMENT_ROOT"].'/wp-content/uploads/' . basename($filename);


                                                            $fileNew = "/wp-content/uploads/" . basename($filename);

                                                            $fileNew = cropImage($filename,
                                                                $_SERVER['DOCUMENT_ROOT'] . $fileNew,
                                                                89, 110);
                                                            ?>
                                                            <img
                                                                src="http://wpdemos.themezaa.com/h-code/wp-content/plugins/revslider/admin/assets/images/dummy.png"
                                                                alt="" data-ww="89px" data-hh="110px" width="89"
                                                                height="110"
                                                                data-lazyload="<?php echo $fileNew; ?>"
                                                                data-no-retina></div>
                                                        <div class="tp-caption   tp-resizeme" id="slide-86-layer-9"
                                                             data-x="right" data-hoffset="550" data-y="center"
                                                             data-voffset="-140"
                                                             data-width="['none','none','none','none']"
                                                             data-height="['none','none','none','none']"
                                                             data-type="image" data-responsive_offset="on"
                                                             data-frames='[{"from":"opacity:0;","speed":600,"to":"o:1;","delay":4400,"ease":"Power2.easeInOut"},{"delay":5400,"speed":600,"to":"opacity:0;","ease":"Power4.easeIn"}]'
                                                             data-textAlign="['left','left','left','left']"
                                                             data-paddingtop="[0,0,0,0]" data-paddingright="[0,0,0,0]"
                                                             data-paddingbottom="[0,0,0,0]" data-paddingleft="[0,0,0,0]"
                                                             style="z-index: 27;text-transform:uppercase;z-index:2;">
                                                            <?php
                                                            $filename = getRandomElement($arProjectImages);
                                                            $new_filen = $_SERVER["DOCUMENT_ROOT"].'/wp-content/uploads/' . basename($filename);


                                                            $fileNew = "/wp-content/uploads/" . basename($filename);

                                                            $fileNew = cropImage($filename,
                                                                $_SERVER['DOCUMENT_ROOT'] . $fileNew,
                                                                43, 86);
                                                            ?>
                                                            <img
                                                                src="http://wpdemos.themezaa.com/h-code/wp-content/plugins/revslider/admin/assets/images/dummy.png"
                                                                alt="" data-ww="43px" data-hh="86px" width="43"
                                                                height="86"
                                                                data-lazyload="<?php echo $fileNew; ?>"
                                                                data-no-retina></div>
                                                        <div class="tp-caption   tp-resizeme" id="slide-86-layer-10"
                                                             data-x="right" data-hoffset="575" data-y="center"
                                                             data-voffset="-130"
                                                             data-width="['none','none','none','none']"
                                                             data-height="['none','none','none','none']"
                                                             data-type="image" data-responsive_offset="on"
                                                             data-frames='[{"from":"y:-50px;opacity:0;","speed":600,"to":"o:1;","delay":4600,"ease":"Power4.easeOut"},{"delay":5200,"speed":600,"to":"y:-50px;opacity:0;","ease":"Power4.easeIn"}]'
                                                             data-textAlign="['left','left','left','left']"
                                                             data-paddingtop="[0,0,0,0]" data-paddingright="[0,0,0,0]"
                                                             data-paddingbottom="[0,0,0,0]" data-paddingleft="[0,0,0,0]"
                                                             style="z-index: 28;text-transform:uppercase;z-index:2;">
                                                            <?php
                                                            $filename = getRandomElement($arProjectImages);
                                                            $new_filen = $_SERVER["DOCUMENT_ROOT"].'/wp-content/uploads/' . basename($filename);


                                                            $fileNew = "/wp-content/uploads/" . basename($filename);

                                                            $fileNew = cropImage($filename,
                                                                $_SERVER['DOCUMENT_ROOT'] . $fileNew,
                                                                43, 82);
                                                            ?>
                                                            <img
                                                                src="http://wpdemos.themezaa.com/h-code/wp-content/plugins/revslider/admin/assets/images/dummy.png"
                                                                alt="" data-ww="43px" data-hh="82px" width="43"
                                                                height="82"
                                                                data-lazyload="<?php echo $fileNew; ?>"
                                                                data-no-retina></div>
                                                        <div class="tp-caption   tp-resizeme" id="slide-86-layer-11"
                                                             data-x="right" data-hoffset="500" data-y="center"
                                                             data-voffset="-232"
                                                             data-width="['none','none','none','none']"
                                                             data-height="['none','none','none','none']"
                                                             data-type="image" data-responsive_offset="on"
                                                             data-frames='[{"from":"y:-50px;opacity:0;","speed":600,"to":"o:1;","delay":4800,"ease":"Power4.easeOut"},{"delay":5000,"speed":600,"to":"y:-50px;opacity:0;","ease":"Power4.easeIn"}]'
                                                             data-textAlign="['left','left','left','left']"
                                                             data-paddingtop="[0,0,0,0]" data-paddingright="[0,0,0,0]"
                                                             data-paddingbottom="[0,0,0,0]" data-paddingleft="[0,0,0,0]"
                                                             style="z-index: 29;text-transform:uppercase;z-index:4;">
                                                            <?php
                                                            $filename = getRandomElement($arProjectImages);
                                                            $new_filen = $_SERVER["DOCUMENT_ROOT"].'/wp-content/uploads/' . basename($filename);


                                                            $fileNew = "/wp-content/uploads/" . basename($filename);

                                                            $fileNew = cropImage($filename,
                                                                $_SERVER['DOCUMENT_ROOT'] . $fileNew,
                                                                81, 276);
                                                            ?>
                                                            <img
                                                                src="http://wpdemos.themezaa.com/h-code/wp-content/plugins/revslider/admin/assets/images/dummy.png"
                                                                alt="" data-ww="81px" data-hh="276px" width="81"
                                                                height="276"
                                                                data-lazyload="<?php echo $fileNew; ?>"
                                                                data-no-retina></div>
                                                        <div class="tp-caption   tp-resizeme" id="slide-86-layer-12"
                                                             data-x="right" data-hoffset="550" data-y="center"
                                                             data-voffset="-180"
                                                             data-width="['none','none','none','none']"
                                                             data-height="['none','none','none','none']"
                                                             data-type="image" data-responsive_offset="on"
                                                             data-frames='[{"from":"y:-50px;opacity:0;","speed":600,"to":"o:1;","delay":5000,"ease":"Power4.easeOut"},{"delay":4800,"speed":600,"to":"y:-50px;opacity:0;","ease":"Power4.easeIn"}]'
                                                             data-textAlign="['left','left','left','left']"
                                                             data-paddingtop="[0,0,0,0]" data-paddingright="[0,0,0,0]"
                                                             data-paddingbottom="[0,0,0,0]" data-paddingleft="[0,0,0,0]"
                                                             style="z-index: 30;text-transform:uppercase;z-index:5;">
                                                            <?php
                                                            $filename = getRandomElement($arProjectImages);
                                                            $new_filen = $_SERVER["DOCUMENT_ROOT"].'/wp-content/uploads/' . basename($filename);


                                                            $fileNew = "/wp-content/uploads/" . basename($filename);

                                                            $fileNew = cropImage($filename,
                                                                $_SERVER['DOCUMENT_ROOT'] . $fileNew,
                                                                81, 223);
                                                            ?>
                                                            <img
                                                                src="http://wpdemos.themezaa.com/h-code/wp-content/plugins/revslider/admin/assets/images/dummy.png"
                                                                alt="" data-ww="81px" data-hh="223px" width="81"
                                                                height="223"
                                                                data-lazyload="<?php echo $fileNew; ?>"
                                                                data-no-retina></div>
                                                        <div class="tp-caption   tp-resizeme" id="slide-86-layer-13"
                                                             data-x="right" data-hoffset="456" data-y="center"
                                                             data-voffset="-170"
                                                             data-width="['none','none','none','none']"
                                                             data-height="['none','none','none','none']"
                                                             data-type="image" data-responsive_offset="on"
                                                             data-frames='[{"from":"opacity:0;","speed":600,"to":"o:1;","delay":5200,"ease":"Power2.easeInOut"},{"delay":4600,"speed":600,"to":"opacity:0;","ease":"Power4.easeIn"}]'
                                                             data-textAlign="['left','left','left','left']"
                                                             data-paddingtop="[0,0,0,0]" data-paddingright="[0,0,0,0]"
                                                             data-paddingbottom="[0,0,0,0]" data-paddingleft="[0,0,0,0]"
                                                             style="z-index: 31;text-transform:uppercase;z-index:5;">
                                                            <?php
                                                            $filename = getRandomElement($arProjectImages);
                                                            $new_filen = $_SERVER["DOCUMENT_ROOT"].'/wp-content/uploads/' . basename($filename);


                                                            $fileNew = "/wp-content/uploads/" . basename($filename);

                                                            $fileNew = cropImage($filename,
                                                                $_SERVER['DOCUMENT_ROOT'] . $fileNew,
                                                                110, 157);
                                                            ?>
                                                            <img
                                                                src="http://wpdemos.themezaa.com/h-code/wp-content/plugins/revslider/admin/assets/images/dummy.png"
                                                                alt="" data-ww="110px" data-hh="157px" width="110"
                                                                height="157"
                                                                data-lazyload="<?php echo $fileNew; ?>"
                                                                data-no-retina></div>
                                                        <div class="tp-caption   tp-resizeme" id="slide-86-layer-14"
                                                             data-x="right" data-hoffset="610" data-y="center"
                                                             data-voffset="-153"
                                                             data-width="['none','none','none','none']"
                                                             data-height="['none','none','none','none']"
                                                             data-type="image" data-responsive_offset="on"
                                                             data-frames='[{"from":"y:-50px;opacity:0;","speed":600,"to":"o:1;","delay":5400,"ease":"Power4.easeOut"},{"delay":4400,"speed":600,"to":"y:-50px;opacity:0;","ease":"Power4.easeIn"}]'
                                                             data-textAlign="['left','left','left','left']"
                                                             data-paddingtop="[0,0,0,0]" data-paddingright="[0,0,0,0]"
                                                             data-paddingbottom="[0,0,0,0]" data-paddingleft="[0,0,0,0]"
                                                             style="z-index: 32;text-transform:uppercase;z-index:3;">
                                                            <?php
                                                            $filename = getRandomElement($arProjectImages);
                                                            $new_filen = $_SERVER["DOCUMENT_ROOT"].'/wp-content/uploads/' . basename($filename);


                                                            $fileNew = "/wp-content/uploads/" . basename($filename);

                                                            $fileNew = cropImage($filename,
                                                                $_SERVER['DOCUMENT_ROOT'] . $fileNew,
                                                                76, 193);
                                                            ?>
                                                            <img
                                                                src="http://wpdemos.themezaa.com/h-code/wp-content/plugins/revslider/admin/assets/images/dummy.png"
                                                                alt="" data-ww="76px" data-hh="193px" width="76"
                                                                height="193"
                                                                data-lazyload="<?php echo $fileNew; ?>"
                                                                data-no-retina></div>
                                                        <div class="tp-caption   tp-resizeme" id="slide-86-layer-15"
                                                             data-x="center" data-hoffset="-700" data-y="center"
                                                             data-voffset="" data-width="['none','none','none','none']"
                                                             data-height="['none','none','none','none']"
                                                             data-type="image" data-responsive_offset="on"
                                                             data-frames='[{"from":"y:50px;opacity:0;","speed":600,"to":"o:1;","delay":5800,"ease":"Power4.easeOut"},{"delay":4000,"speed":600,"to":"y:bottom;","ease":"Power4.easeIn"}]'
                                                             data-textAlign="['left','left','left','left']"
                                                             data-paddingtop="[0,0,0,0]" data-paddingright="[0,0,0,0]"
                                                             data-paddingbottom="[0,0,0,0]" data-paddingleft="[0,0,0,0]"
                                                             style="z-index: 33;text-transform:left;z-index:2;">
                                                            <?php
                                                            $filename = getRandomElement($arProjectImages);
                                                            $new_filen = $_SERVER["DOCUMENT_ROOT"].'/wp-content/uploads/' . basename($filename);


                                                            $fileNew = "/wp-content/uploads/" . basename($filename);

                                                            $fileNew = cropImage($filename,
                                                                $_SERVER['DOCUMENT_ROOT'] . $fileNew,
                                                                54, 42);
                                                            ?>
                                                            <img
                                                                src="http://wpdemos.themezaa.com/h-code/wp-content/plugins/revslider/admin/assets/images/dummy.png"
                                                                alt="" data-ww="54px" data-hh="42px" width="54"
                                                                height="42"
                                                                data-lazyload="<?php echo $fileNew; ?>"
                                                                data-no-retina></div>
                                                        <div class="tp-caption Fashion-BigDisplay   tp-resizeme"
                                                             id="slide-86-layer-16" data-x="center" data-hoffset="-580"
                                                             data-y="center" data-voffset="" data-width="['auto']"
                                                             data-height="['auto']" data-type="text"
                                                             data-responsive_offset="on"
                                                             data-frames='[{"from":"y:50px;opacity:0;","speed":600,"to":"o:1;","delay":5800,"ease":"Power2.easeInOut"},{"delay":4000,"speed":600,"to":"y:bottom;","ease":"Power4.easeIn"}]'
                                                             data-textAlign="['left','left','left','left']"
                                                             data-paddingtop="[0,0,0,0]" data-paddingright="[0,0,0,0]"
                                                             data-paddingbottom="[0,0,0,0]" data-paddingleft="[0,0,0,0]"
                                                             style="z-index: 34; white-space: nowrap; font-size: 16px; line-height: 22px; font-weight: 300; color: rgba(255,255,255,1);font-family:Roboto;text-transform:left;z-index:2;display:inline-block;float:right;position:absolute;margin:0px;white-space:nowrap;letter-spacing:2px;">
                                                            <?php displayRandomElement($arPostTagsNames); ?>
                                                        </div>
                                                        <div class="tp-caption   tp-resizeme" id="slide-86-layer-17"
                                                             data-x="center" data-hoffset="-450" data-y="center"
                                                             data-voffset="" data-width="['none','none','none','none']"
                                                             data-height="['none','none','none','none']"
                                                             data-type="image" data-responsive_offset="on"
                                                             data-frames='[{"from":"y:50px;opacity:0;","speed":600,"to":"o:1;","delay":6200,"ease":"Power4.easeOut"},{"delay":3600,"speed":600,"to":"y:bottom;","ease":"Power4.easeIn"}]'
                                                             data-textAlign="['left','left','left','left']"
                                                             data-paddingtop="[0,0,0,0]" data-paddingright="[0,0,0,0]"
                                                             data-paddingbottom="[0,0,0,0]" data-paddingleft="[0,0,0,0]"
                                                             style="z-index: 35;text-transform:left;">
                                                            <?php
                                                            $filename = getRandomElement($arProjectImages);
                                                            $new_filen = $_SERVER["DOCUMENT_ROOT"].'/wp-content/uploads/' . basename($filename);


                                                            $fileNew = "/wp-content/uploads/" . basename($filename);

                                                            $fileNew = cropImage($filename,
                                                                $_SERVER['DOCUMENT_ROOT'] . $fileNew,
                                                                54, 42);
                                                            ?>
                                                            <img
                                                                src="http://wpdemos.themezaa.com/h-code/wp-content/plugins/revslider/admin/assets/images/dummy.png"
                                                                alt="" data-ww="54px" data-hh="42px" width="54"
                                                                height="42"
                                                                data-lazyload="<?php echo $fileNew; ?>"
                                                                data-no-retina></div>
                                                        <div class="tp-caption Fashion-BigDisplay   tp-resizeme"
                                                             id="slide-86-layer-18" data-x="center" data-hoffset="-350"
                                                             data-y="center" data-voffset="" data-width="['auto']"
                                                             data-height="['auto']" data-type="text"
                                                             data-responsive_offset="on"
                                                             data-frames='[{"from":"y:50px;opacity:0;","speed":600,"to":"o:1;","delay":6200,"ease":"Power4.easeOut"},{"delay":3600,"speed":600,"to":"y:bottom;","ease":"Power4.easeIn"}]'
                                                             data-textAlign="['left','left','left','left']"
                                                             data-paddingtop="[0,0,0,0]" data-paddingright="[0,0,0,0]"
                                                             data-paddingbottom="[0,0,0,0]" data-paddingleft="[0,0,0,0]"
                                                             style="z-index: 36; white-space: nowrap; font-size: 16px; line-height: 20px; font-weight: 300; color: rgba(255,255,255,1);font-family:Roboto;text-transform:left;z-index:2;display:inline-block;float:right;position:absolute;margin:0px;white-space:nowrap;letter-spacing:2px;">
                                                            <?php displayRandomElement($arPostTagsNames); ?>
                                                        </div>
                                                        <div class="tp-caption Fashion-BigDisplay   tp-resizeme"
                                                             id="slide-86-layer-19" data-x="center" data-hoffset="-700"
                                                             data-y="center" data-voffset="80"
                                                             data-width="['none','none','none','none']"
                                                             data-height="['none','none','none','none']"
                                                             data-type="image" data-responsive_offset="on"
                                                             data-frames='[{"from":"y:50px;opacity:0;","speed":600,"to":"o:1;","delay":6600,"ease":"Power4.easeOut"},{"delay":3200,"speed":600,"to":"y:bottom;","ease":"Power4.easeIn"}]'
                                                             data-textAlign="['left','left','left','left']"
                                                             data-paddingtop="[0,0,0,0]" data-paddingright="[0,0,0,0]"
                                                             data-paddingbottom="[0,0,0,0]" data-paddingleft="[0,0,0,0]"
                                                             style="z-index: 37; line-height: 20px;text-transform:left;z-index:2;">
                                                            <?php
                                                            $filename = getRandomElement($arProjectImages);
                                                            $new_filen = $_SERVER["DOCUMENT_ROOT"].'/wp-content/uploads/' . basename($filename);


                                                            $fileNew = "/wp-content/uploads/" . basename($filename);

                                                            $fileNew = cropImage($filename,
                                                                $_SERVER['DOCUMENT_ROOT'] . $fileNew,
                                                                54, 42);
                                                            ?>
                                                            <img
                                                                src="http://wpdemos.themezaa.com/h-code/wp-content/plugins/revslider/admin/assets/images/dummy.png"
                                                                alt="" data-ww="54px" data-hh="42px" width="54"
                                                                height="42"
                                                                data-lazyload="<?php echo $fileNew; ?>"
                                                                data-no-retina></div>
                                                        <div class="tp-caption Fashion-BigDisplay   tp-resizeme"
                                                             id="slide-86-layer-20" data-x="center" data-hoffset="-600"
                                                             data-y="center" data-voffset="80" data-width="['auto']"
                                                             data-height="['auto']" data-type="text"
                                                             data-responsive_offset="on"
                                                             data-frames='[{"from":"y:50px;opacity:0;","speed":600,"to":"o:1;","delay":6600,"ease":"Power4.easeOut"},{"delay":3200,"speed":600,"to":"y:bottom;","ease":"Power4.easeIn"}]'
                                                             data-textAlign="['left','left','left','left']"
                                                             data-paddingtop="[0,0,0,0]" data-paddingright="[0,0,0,0]"
                                                             data-paddingbottom="[0,0,0,0]" data-paddingleft="[0,0,0,0]"
                                                             style="z-index: 38; white-space: nowrap; font-size: 16px; line-height: 20px; font-weight: 300; color: rgba(255,255,255,1);font-family:Roboto;text-transform:left;z-index:2;display:inline-block;float:right;position:absolute;margin:0px;white-space:nowrap;letter-spacing:2px;">
                                                            <?php displayRandomElement($arPostTagsNames); ?>
                                                        </div>
                                                        <div class="tp-caption   tp-resizeme" id="slide-86-layer-21"
                                                             data-x="center" data-hoffset="-450" data-y="center"
                                                             data-voffset="80"
                                                             data-width="['none','none','none','none']"
                                                             data-height="['none','none','none','none']"
                                                             data-type="image" data-responsive_offset="on"
                                                             data-frames='[{"from":"y:50px;opacity:0;","speed":600,"to":"o:1;","delay":7000,"ease":"Power4.easeOut"},{"delay":2800,"speed":600,"to":"y:bottom;","ease":"Power4.easeIn"}]'
                                                             data-textAlign="['left','left','left','left']"
                                                             data-paddingtop="[0,0,0,0]" data-paddingright="[0,0,0,0]"
                                                             data-paddingbottom="[0,0,0,0]" data-paddingleft="[0,0,0,0]"
                                                             style="z-index: 39;text-transform:left;z-index:2;">
                                                            <?php
                                                            $filename = getRandomElement($arProjectImages);
                                                            $new_filen = $_SERVER["DOCUMENT_ROOT"].'/wp-content/uploads/' . basename($filename);


                                                            $fileNew = "/wp-content/uploads/" . basename($filename);

                                                            $fileNew = cropImage($filename,
                                                                $_SERVER['DOCUMENT_ROOT'] . $fileNew,
                                                                54, 42);
                                                            ?>
                                                            <img
                                                                src="http://wpdemos.themezaa.com/h-code/wp-content/plugins/revslider/admin/assets/images/dummy.png"
                                                                alt="" data-ww="54px" data-hh="42px" width="54"
                                                                height="42"
                                                                data-lazyload="<?php echo $fileNew; ?>"
                                                                data-no-retina></div>
                                                        <div class="tp-caption Fashion-BigDisplay   tp-resizeme"
                                                             id="slide-86-layer-22" data-x="center" data-hoffset="-350"
                                                             data-y="center" data-voffset="80" data-width="['auto']"
                                                             data-height="['auto']" data-type="text"
                                                             data-responsive_offset="on"
                                                             data-frames='[{"from":"y:50px;opacity:0;","speed":600,"to":"o:1;","delay":7000,"ease":"Power4.easeOut"},{"delay":2800,"speed":600,"to":"y:bottom;","ease":"Power4.easeIn"}]'
                                                             data-textAlign="['left','left','left','left']"
                                                             data-paddingtop="[0,0,0,0]" data-paddingright="[0,0,0,0]"
                                                             data-paddingbottom="[0,0,0,0]" data-paddingleft="[0,0,0,0]"
                                                             style="z-index: 40; white-space: nowrap; font-size: 16px; line-height: 20px; font-weight: 300; color: rgba(255,255,255,1);font-family:Roboto;text-transform:left;z-index:2;display:inline-block;float:right;margin:0px;white-space:nowrap;letter-spacing:2px;">
                                                            <?php displayRandomElement($arPostTagsNames); ?>
                                                        </div>
                                                        <div class="tp-caption   tp-resizeme" id="slide-86-layer-23"
                                                             data-x="center" data-hoffset="-700" data-y="center"
                                                             data-voffset="160"
                                                             data-width="['none','none','none','none']"
                                                             data-height="['none','none','none','none']"
                                                             data-type="image" data-responsive_offset="on"
                                                             data-frames='[{"from":"y:50px;opacity:0;","speed":600,"to":"o:1;","delay":7400,"ease":"Power4.easeOut"},{"delay":2400,"speed":600,"to":"y:bottom;","ease":"Power4.easeIn"}]'
                                                             data-textAlign="['left','left','left','left']"
                                                             data-paddingtop="[0,0,0,0]" data-paddingright="[0,0,0,0]"
                                                             data-paddingbottom="[0,0,0,0]" data-paddingleft="[0,0,0,0]"
                                                             style="z-index: 41;text-transform:left;z-index:2;">
                                                            <?php
                                                            $filename = getRandomElement($arProjectImages);
                                                            $new_filen = $_SERVER["DOCUMENT_ROOT"].'/wp-content/uploads/' . basename($filename);


                                                            $fileNew = "/wp-content/uploads/" . basename($filename);

                                                            $fileNew = cropImage($filename,
                                                                $_SERVER['DOCUMENT_ROOT'] . $fileNew,
                                                                54, 42);
                                                            ?>
                                                            <img
                                                                src="http://wpdemos.themezaa.com/h-code/wp-content/plugins/revslider/admin/assets/images/dummy.png"
                                                                alt="" data-ww="54px" data-hh="42px" width="54"
                                                                height="42"
                                                                data-lazyload="<?php echo $fileNew; ?>"
                                                                data-no-retina></div>
                                                        <div class="tp-caption Fashion-BigDisplay   tp-resizeme"
                                                             id="slide-86-layer-25" data-x="center" data-hoffset="-580"
                                                             data-y="center" data-voffset="160" data-width="['auto']"
                                                             data-height="['auto']" data-type="text"
                                                             data-responsive_offset="on"
                                                             data-frames='[{"from":"y:50px;opacity:0;","speed":600,"to":"o:1;","delay":7400,"ease":"Power4.easeOut"},{"delay":2400,"speed":600,"to":"y:bottom;","ease":"Power4.easeIn"}]'
                                                             data-textAlign="['left','left','left','left']"
                                                             data-paddingtop="[0,0,0,0]" data-paddingright="[0,0,0,0]"
                                                             data-paddingbottom="[0,0,0,0]" data-paddingleft="[0,0,0,0]"
                                                             style="z-index: 42; white-space: nowrap; font-size: 16px; line-height: 20px; font-weight: 300; color: rgba(255,255,255,1);font-family:Roboto;text-transform:left;z-index:2;display:inline-block;float:right;margin:0px;white-space:nowrap;letter-spacing:2px;">
                                                            <?php displayRandomElement($arPostTagsNames); ?>
                                                        </div>
                                                        <div class="tp-caption   tp-resizeme" id="slide-86-layer-26"
                                                             data-x="center" data-hoffset="-450" data-y="center"
                                                             data-voffset="160"
                                                             data-width="['none','none','none','none']"
                                                             data-height="['none','none','none','none']"
                                                             data-type="image" data-responsive_offset="on"
                                                             data-frames='[{"from":"y:50px;opacity:0;","speed":600,"to":"o:1;","delay":7800,"ease":"Power4.easeOut"},{"delay":2000,"speed":600,"to":"y:bottom;","ease":"Power4.easeIn"}]'
                                                             data-textAlign="['left','left','left','left']"
                                                             data-paddingtop="[0,0,0,0]" data-paddingright="[0,0,0,0]"
                                                             data-paddingbottom="[0,0,0,0]" data-paddingleft="[0,0,0,0]"
                                                             style="z-index: 43;text-transform:left;z-index:2;">
                                                            <?php
                                                            $filename = getRandomElement($arProjectImages);
                                                            $new_filen = $_SERVER["DOCUMENT_ROOT"].'/wp-content/uploads/' . basename($filename);


                                                            $fileNew = "/wp-content/uploads/" . basename($filename);

                                                            $fileNew = cropImage($filename,
                                                                $_SERVER['DOCUMENT_ROOT'] . $fileNew,
                                                                54, 42);
                                                            ?>
                                                            <img
                                                                src="http://wpdemos.themezaa.com/h-code/wp-content/plugins/revslider/admin/assets/images/dummy.png"
                                                                alt="" data-ww="54px" data-hh="42px" width="54"
                                                                height="42"
                                                                data-lazyload="<?php echo $fileNew; ?>"
                                                                data-no-retina></div>
                                                        <div class="tp-caption Fashion-BigDisplay   tp-resizeme"
                                                             id="slide-86-layer-27" data-x="center" data-hoffset="-350"
                                                             data-y="center" data-voffset="160" data-width="['auto']"
                                                             data-height="['auto']" data-type="text"
                                                             data-responsive_offset="on"
                                                             data-frames='[{"from":"y:50px;opacity:0;","speed":600,"to":"o:1;","delay":7800,"ease":"Power4.easeOut"},{"delay":2000,"speed":600,"to":"y:bottom;","ease":"Power4.easeIn"}]'
                                                             data-textAlign="['left','left','left','left']"
                                                             data-paddingtop="[0,0,0,0]" data-paddingright="[0,0,0,0]"
                                                             data-paddingbottom="[0,0,0,0]" data-paddingleft="[0,0,0,0]"
                                                             style="z-index: 44; white-space: nowrap; font-size: 16px; line-height: 20px; font-weight: 300; color: rgba(255,255,255,1);font-family:Roboto;text-transform:left;z-index:2;display:inline-block;float:right;position:absolute;margin:0px;white-space:nowrap;letter-spacing:2px;">
                                                            <?php displayRandomElement($arPostTagsNames); ?>
                                                        </div>
                                                    </li>
                                                    <?php
                                                    $filename = getRandomElement($arProjectImages);
                                                    $new_filen = $_SERVER["DOCUMENT_ROOT"].'/wp-content/uploads/' . basename($filename);


                                                    $fileNew = "/wp-content/uploads/" . basename($filename);

                                                    $fileNew = cropImage($filename,
                                                        $_SERVER['DOCUMENT_ROOT'] . $fileNew,
                                                        100, 50);
                                                    ?>
                                                    <li data-index="rs-87" data-transition="curtain-3"
                                                        data-slotamount="1" data-hideafterloop="0"
                                                        data-hideslideonmobile="off" data-easein="default"
                                                        data-easeout="default" data-masterspeed="500"
                                                        data-thumb="<?php echo $fileNew; ?>"
                                                        data-delay="11000" data-rotate="0" data-saveperformance="off"
                                                        class="no-transition" data-title="HONEYMOON TOURS"
                                                        data-param1="" data-param2="" data-param3="" data-param4=""
                                                        data-param5="" data-param6="" data-param7="" data-param8=""
                                                        data-param9="" data-param10="" data-description="">
                                                        <?php
                                                        $filename = getRandomElement($arProjectImages);
                                                        $new_filen = $_SERVER["DOCUMENT_ROOT"].'/wp-content/uploads/' . basename($filename);


                                                        $fileNew = "/wp-content/uploads/" . basename($filename);

                                                        $fileNew = cropImage($filename,
                                                            $_SERVER['DOCUMENT_ROOT'] . $fileNew,
                                                            1920, 1080);
                                                        ?>
                                                        <img
                                                            src="http://wpdemos.themezaa.com/h-code/wp-content/plugins/revslider/admin/assets/images/dummy.png"
                                                            alt="" title="intro-travel-05-bg" width="1920" height="1080"
                                                            data-lazyload="<?php echo $fileNew; ?>"
                                                            data-bgposition="center bottom" data-bgfit="cover"
                                                            data-bgrepeat="no-repeat" class="rev-slidebg"
                                                            data-no-retina>
                                                        <div class="tp-caption   tp-resizeme" id="slide-87-layer-1"
                                                             data-x="130" data-y="100"
                                                             data-width="['none','none','none','none']"
                                                             data-height="['none','none','none','none']"
                                                             data-type="image" data-responsive_offset="on"
                                                             data-frames='[{"from":"x:-50px;opacity:0;","speed":600,"to":"o:1;","delay":1300,"ease":"Power4.easeOut"},{"delay":8500,"speed":600,"to":"x:50px;opacity:0;","ease":"Power4.easeIn"}]'
                                                             data-textAlign="['left','left','left','left']"
                                                             data-paddingtop="[0,0,0,0]" data-paddingright="[0,0,0,0]"
                                                             data-paddingbottom="[0,0,0,0]" data-paddingleft="[0,0,0,0]"
                                                             style="z-index: 45;text-transform:uppercase;z-index:1;">
                                                            <?php
                                                            $filename = getRandomElement($arProjectImages);
                                                            $new_filen = $_SERVER["DOCUMENT_ROOT"].'/wp-content/uploads/' . basename($filename);


                                                            $fileNew = "/wp-content/uploads/" . basename($filename);

                                                            $fileNew = cropImage($filename,
                                                                $_SERVER['DOCUMENT_ROOT'] . $fileNew,
                                                                972, 436);
                                                            ?>
                                                            <img
                                                                src="http://wpdemos.themezaa.com/h-code/wp-content/plugins/revslider/admin/assets/images/dummy.png"
                                                                alt="" data-ww="972px" data-hh="436px" width="972"
                                                                height="436"
                                                                data-lazyload="<?php echo $fileNew; ?>"
                                                                data-no-retina></div>
                                                        <div class="tp-caption   tp-resizeme" id="slide-87-layer-2"
                                                             data-x="right" data-hoffset="-100" data-y="-150"
                                                             data-width="['none','none','none','none']"
                                                             data-height="['none','none','none','none']"
                                                             data-type="image" data-responsive_offset="on"
                                                             data-frames='[{"from":"x:-50px;opacity:0;","speed":600,"to":"o:1;","delay":1500,"ease":"Power4.easeOut"},{"delay":8300,"speed":600,"to":"x:50px;opacity:0;","ease":"Power4.easeIn"}]'
                                                             data-textAlign="['left','left','left','left']"
                                                             data-paddingtop="[0,0,0,0]" data-paddingright="[0,0,0,0]"
                                                             data-paddingbottom="[0,0,0,0]" data-paddingleft="[0,0,0,0]"
                                                             style="z-index: 46;text-transform:uppercase;z-index:1;">
                                                            <?php
                                                            $filename = getRandomElement($arProjectImages);
                                                            $new_filen = $_SERVER["DOCUMENT_ROOT"].'/wp-content/uploads/' . basename($filename);


                                                            $fileNew = "/wp-content/uploads/" . basename($filename);

                                                            $fileNew = cropImage($filename,
                                                                $_SERVER['DOCUMENT_ROOT'] . $fileNew,
                                                                812, 289);
                                                            ?>
                                                            <img
                                                                src="http://wpdemos.themezaa.com/h-code/wp-content/plugins/revslider/admin/assets/images/dummy.png"
                                                                alt="" data-ww="812px" data-hh="289px" width="812"
                                                                height="289"
                                                                data-lazyload="<?php echo $fileNew; ?>"
                                                                data-no-retina></div>
                                                        <div class="tp-caption   tp-resizeme" id="slide-87-layer-3"
                                                             data-x="right" data-hoffset="" data-y="bottom"
                                                             data-voffset="" data-width="['none','none','none','none']"
                                                             data-height="['none','none','none','none']"
                                                             data-type="image" data-responsive_offset="on"
                                                             data-frames='[{"from":"y:-50px;opacity:0;","speed":600,"to":"o:1;","delay":2000,"ease":"Power4.easeOut"},{"delay":7800,"speed":600,"to":"y:-50px;opacity:0;","ease":"Power4.easeIn"}]'
                                                             data-textAlign="['left','left','left','left']"
                                                             data-paddingtop="[0,0,0,0]" data-paddingright="[0,0,0,0]"
                                                             data-paddingbottom="[0,0,0,0]" data-paddingleft="[0,0,0,0]"
                                                             style="z-index: 47;text-transform:uppercase;z-index:2;">
                                                            <?php
                                                            $filename = getRandomElement($arProjectImages);
                                                            $new_filen = $_SERVER["DOCUMENT_ROOT"].'/wp-content/uploads/' . basename($filename);


                                                            $fileNew = "/wp-content/uploads/" . basename($filename);

                                                            $fileNew = cropImage($filename,
                                                                $_SERVER['DOCUMENT_ROOT'] . $fileNew,
                                                                1009, 669);
                                                            ?>
                                                            <img
                                                                src="http://wpdemos.themezaa.com/h-code/wp-content/plugins/revslider/admin/assets/images/dummy.png"
                                                                alt="" data-ww="1009px" data-hh="669px" width="1009"
                                                                height="669"
                                                                data-lazyload="<?php echo $fileNew; ?>"
                                                                data-no-retina></div>
                                                        <div class="tp-caption Fashion-BigDisplay   tp-resizeme"
                                                             id="slide-87-layer-4" data-x="350" data-y="center"
                                                             data-voffset="-150" data-width="['auto']"
                                                             data-height="['auto']" data-type="text"
                                                             data-responsive_offset="on"
                                                             data-frames='[{"from":"x:-50px;opacity:0;","speed":600,"to":"o:1;","delay":2500,"ease":"Power4.easeOut"},{"delay":7300,"speed":600,"to":"x:-50px;opacity:0;","ease":"Power4.easeIn"}]'
                                                             data-textAlign="['left','left','left','left']"
                                                             data-paddingtop="[0,0,0,0]" data-paddingright="[0,0,0,0]"
                                                             data-paddingbottom="[0,0,0,0]" data-paddingleft="[0,0,0,0]"
                                                             style="z-index: 48; white-space: nowrap; font-size: 62px; font-weight: 800; color: rgba(255,255,255,1);font-family:Open Sans;text-transform:uppercase;z-index:5;position:absolute;margin:0px;white-space:nowrap;letter-spacing:-2px;">
                                                            <?php displayRandomElement($arPostTagsNames); ?>
                                                        </div>
                                                        <div class="tp-caption Fashion-BigDisplay   tp-resizeme"
                                                             id="slide-87-layer-5" data-x="350" data-y="center"
                                                             data-voffset="-71" data-width="['auto']"
                                                             data-height="['auto']" data-type="text"
                                                             data-responsive_offset="on"
                                                             data-frames='[{"from":"x:50px;opacity:0;","speed":600,"to":"o:1;","delay":3000,"ease":"Power4.easeOut"},{"delay":6800,"speed":600,"to":"x:50px;opacity:0;","ease":"Power4.easeIn"}]'
                                                             data-textAlign="['left','left','left','left']"
                                                             data-paddingtop="[0,0,0,0]" data-paddingright="[0,0,0,0]"
                                                             data-paddingbottom="[0,0,0,0]" data-paddingleft="[0,0,0,0]"
                                                             style="z-index: 49; white-space: nowrap; font-size: 125px; font-weight: 800; color: rgba(255,255,255,1);font-family:Open Sans;text-transform:uppercase;z-index:2;position:absolute;margin:0px;white-space:nowrap;letter-spacing:-2px;">
                                                            <?php displayRandomElement($arPostTagsNames); ?>
                                                        </div>
                                                        <div class="tp-caption Fashion-BigDisplay   tp-resizeme"
                                                             id="slide-87-layer-6" data-x="350" data-y="center"
                                                             data-voffset="80" data-width="['auto']"
                                                             data-height="['auto']" data-type="text"
                                                             data-responsive_offset="on"
                                                             data-frames='[{"from":"x:50px;opacity:0;","speed":600,"to":"o:1;","delay":3500,"ease":"Power2.easeInOut"},{"delay":800,"speed":600,"to":"x:50px;opacity:0;","ease":"Power4.easeIn"}]'
                                                             data-textAlign="['left','left','left','left']"
                                                             data-paddingtop="[0,0,0,0]" data-paddingright="[0,0,0,0]"
                                                             data-paddingbottom="[0,0,0,0]" data-paddingleft="[0,0,0,0]"
                                                             style="z-index: 50; white-space: nowrap; font-size: 32px; font-weight: 700; color: rgba(255,255,255,1);font-family:Open Sans;text-transform:uppercase;z-index:2;position:absolute;margin:0px;white-space:nowrap;letter-spacing:-2px;">
                                                            <?php displayRandomElement($arPostTagsNames); ?>
                                                        </div>
                                                        <div class="tp-caption Fashion-BigDisplay   tp-resizeme"
                                                             id="slide-87-layer-7" data-x="350" data-y="center"
                                                             data-voffset="140" data-width="['auto']"
                                                             data-height="['auto']" data-type="text"
                                                             data-responsive_offset="on"
                                                             data-frames='[{"from":"x:-50px;opacity:0;","speed":600,"to":"o:1;","delay":4000,"ease":"Power4.easeOut"},{"delay":300,"speed":600,"to":"x:-50px;opacity:0;","ease":"Power4.easeIn"}]'
                                                             data-textAlign="['left','left','left','left']"
                                                             data-paddingtop="[0,0,0,0]" data-paddingright="[0,0,0,0]"
                                                             data-paddingbottom="[0,0,0,0]" data-paddingleft="[0,0,0,0]"
                                                             style="z-index: 51; white-space: nowrap; font-size: 70px; font-weight: 800; color: rgba(255,255,255,1);font-family:Open Sans;text-transform:uppercase;z-index:5;">
                                                            <?php displayRandomElement($arPostTagsNames); ?>
                                                        </div>
                                                        <div class="tp-caption Fashion-BigDisplay   tp-resizeme"
                                                             id="slide-87-layer-8" data-x="350" data-y="center"
                                                             data-voffset="80" data-width="['auto']"
                                                             data-height="['auto']" data-type="text"
                                                             data-responsive_offset="on"
                                                             data-frames='[{"from":"x:50px;opacity:0;","speed":600,"to":"o:1;","delay":6500,"ease":"Power4.easeOut"},{"delay":300,"speed":600,"to":"x:50px;opacity:0;","ease":"Power4.easeIn"}]'
                                                             data-textAlign="['left','left','left','left']"
                                                             data-paddingtop="[0,0,0,0]" data-paddingright="[0,0,0,0]"
                                                             data-paddingbottom="[0,0,0,0]" data-paddingleft="[0,0,0,0]"
                                                             style="z-index: 52; white-space: nowrap; font-size: 32px; font-weight: 700; color: rgba(255,255,255,1);font-family:Open Sans;text-transform:uppercase;z-index:2;position:absolute;margin:0px;white-space:nowrap;letter-spacing:-2px;">
                                                            <?php displayRandomElement($arPostTagsNames); ?>
                                                        </div>
                                                        <div class="tp-caption Fashion-BigDisplay   tp-resizeme"
                                                             id="slide-87-layer-9" data-x="350" data-y="center"
                                                             data-voffset="140" data-width="['auto']"
                                                             data-height="['auto']" data-type="text"
                                                             data-responsive_offset="on"
                                                             data-frames='[{"from":"x:-50px;opacity:0;","speed":600,"to":"o:1;","delay":6000,"ease":"Power4.easeOut"},{"delay":800,"speed":600,"to":"x:-50px;opacity:0;","ease":"Power4.easeIn"}]'
                                                             data-textAlign="['left','left','left','left']"
                                                             data-paddingtop="[0,0,0,0]" data-paddingright="[0,0,0,0]"
                                                             data-paddingbottom="[0,0,0,0]" data-paddingleft="[0,0,0,0]"
                                                             style="z-index: 53; white-space: nowrap; font-size: 70px; font-weight: 800; color: rgba(255,255,255,1);font-family:Open Sans;text-transform:uppercase;z-index:5;position:absolute;margin:0px;white-space:nowrap;letter-spacing:-2px;">
                                                            <?php displayRandomElement($arPostTagsNames); ?>
                                                        </div>
                                                        <div class="tp-caption Fashion-BigDisplay   tp-resizeme"
                                                             id="slide-87-layer-10" data-x="350" data-y="center"
                                                             data-voffset="80" data-width="['auto']"
                                                             data-height="['auto']" data-type="text"
                                                             data-responsive_offset="on"
                                                             data-frames='[{"from":"x:50px;opacity:0;","speed":600,"to":"o:1;","delay":9000,"ease":"Power4.easeOut"},{"delay":800,"speed":600,"to":"x:50px;opacity:0;","ease":"Power4.easeIn"}]'
                                                             data-textAlign="['left','left','left','left']"
                                                             data-paddingtop="[0,0,0,0]" data-paddingright="[0,0,0,0]"
                                                             data-paddingbottom="[0,0,0,0]" data-paddingleft="[0,0,0,0]"
                                                             style="z-index: 54; white-space: nowrap; font-size: 32px; font-weight: 700; color: rgba(255,255,255,1);font-family:Open Sans;text-transform:uppercase;z-index:2;position:absolute;margin:0px;white-space:nowrap;letter-spacing:-2px;">
                                                            <?php displayRandomElement($arPostTagsNames); ?>
                                                        </div>
                                                        <div class="tp-caption Fashion-BigDisplay   tp-resizeme"
                                                             id="slide-87-layer-11" data-x="350" data-y="center"
                                                             data-voffset="140" data-width="['auto']"
                                                             data-height="['auto']" data-type="text"
                                                             data-responsive_offset="on"
                                                             data-frames='[{"from":"x:-50px;opacity:0;","speed":600,"to":"o:1;","delay":8500,"ease":"Power4.easeOut"},{"delay":1300,"speed":600,"to":"x:-50px;opacity:0;","ease":"Power4.easeIn"}]'
                                                             data-textAlign="['left','left','left','left']"
                                                             data-paddingtop="[0,0,0,0]" data-paddingright="[0,0,0,0]"
                                                             data-paddingbottom="[0,0,0,0]" data-paddingleft="[0,0,0,0]"
                                                             style="z-index: 55; white-space: nowrap; font-size: 70px; font-weight: 800; color: rgba(255,255,255,1);font-family:Open Sans;text-transform:uppercase;z-index:5;position:absolute;margin:0px;white-space:nowrap;letter-spacing:-2px;">
                                                            <?php displayRandomElement($arPostTagsNames); ?>
                                                        </div>
                                                    </li>
                                                    <?php
                                                    $filename = getRandomElement($arProjectImages);
                                                    $new_filen = $_SERVER["DOCUMENT_ROOT"].'/wp-content/uploads/' . basename($filename);


                                                    $fileNew = "/wp-content/uploads/" . basename($filename);

                                                    $fileNew = cropImage($filename,
                                                        $_SERVER['DOCUMENT_ROOT'] . $fileNew,
                                                        100, 50);
                                                    ?>
                                                    <li data-index="rs-88" data-transition="curtain-3"
                                                        data-slotamount="1" data-hideafterloop="0"
                                                        data-hideslideonmobile="off" data-easein="default"
                                                        data-easeout="default" data-masterspeed="500"
                                                        data-thumb="<?php echo $fileNew; ?>"
                                                        data-delay="11000" data-rotate="0" data-saveperformance="off"
                                                        class="no-transition" data-title="FAMILY TOURS" data-param1=""
                                                        data-param2="" data-param3="" data-param4="" data-param5=""
                                                        data-param6="" data-param7="" data-param8="" data-param9=""
                                                        data-param10="" data-description="">
                                                        <?php
                                                        $filename = getRandomElement($arProjectImages);
                                                        $new_filen = $_SERVER["DOCUMENT_ROOT"].'/wp-content/uploads/' . basename($filename);


                                                        $fileNew = "/wp-content/uploads/" . basename($filename);

                                                        $fileNew = cropImage($filename,
                                                            $_SERVER['DOCUMENT_ROOT'] . $fileNew,
                                                            1920, 1080);
                                                        ?>
                                                        <img
                                                            src="http://wpdemos.themezaa.com/h-code/wp-content/plugins/revslider/admin/assets/images/dummy.png"
                                                            alt="" title="intro-travel-06-bg" width="1920" height="1080"
                                                            data-lazyload="<?php echo $fileNew; ?>"
                                                            data-bgposition="center center" data-bgfit="cover"
                                                            data-bgrepeat="no-repeat" class="rev-slidebg"
                                                            data-no-retina>
                                                        <div class="tp-caption   tp-resizeme" id="slide-88-layer-1"
                                                             data-x="right" data-hoffset="" data-y="bottom"
                                                             data-voffset="" data-width="['none','none','none','none']"
                                                             data-height="['none','none','none','none']"
                                                             data-type="image" data-responsive_offset="on"
                                                             data-frames='[{"from":"y:50px;opacity:0;","speed":600,"to":"o:1;","delay":2000,"ease":"Power4.easeOut"},{"delay":7800,"speed":600,"to":"y:50px;opacity:0;","ease":"Power4.easeIn"}]'
                                                             data-textAlign="['left','left','left','left']"
                                                             data-paddingtop="[0,0,0,0]" data-paddingright="[0,0,0,0]"
                                                             data-paddingbottom="[0,0,0,0]" data-paddingleft="[0,0,0,0]"
                                                             style="z-index: 56;text-transform:uppercase;z-index:2;">
                                                            <?php
                                                            $filename = getRandomElement($arProjectImages);
                                                            $new_filen = $_SERVER["DOCUMENT_ROOT"].'/wp-content/uploads/' . basename($filename);


                                                            $fileNew = "/wp-content/uploads/" . basename($filename);

                                                            $fileNew = cropImage($filename,
                                                                $_SERVER['DOCUMENT_ROOT'] . $fileNew,
                                                                1920, 912);
                                                            ?>
                                                            <img
                                                                src="http://wpdemos.themezaa.com/h-code/wp-content/plugins/revslider/admin/assets/images/dummy.png"
                                                                alt="" data-ww="1920px" data-hh="912px" width="1920"
                                                                height="912"
                                                                data-lazyload="<?php echo $fileNew; ?>"
                                                                data-no-retina></div>
                                                        <div class="tp-caption Fashion-BigDisplay   tp-resizeme"
                                                             id="slide-88-layer-2" data-x="350" data-y="center"
                                                             data-voffset="-150" data-width="['auto']"
                                                             data-height="['auto']" data-type="text"
                                                             data-responsive_offset="on"
                                                             data-frames='[{"from":"x:-50px;opacity:0;","speed":600,"to":"o:1;","delay":2500,"ease":"Power4.easeOut"},{"delay":7300,"speed":600,"to":"x:-50px;opacity:0;","ease":"Power4.easeIn"}]'
                                                             data-textAlign="['left','left','left','left']"
                                                             data-paddingtop="[0,0,0,0]" data-paddingright="[0,0,0,0]"
                                                             data-paddingbottom="[0,0,0,0]" data-paddingleft="[0,0,0,0]"
                                                             style="z-index: 57; white-space: nowrap; font-size: 62px; font-weight: 800; color: rgba(255,255,255,1);font-family:Open Sans;text-transform:uppercase;z-index:5;">
                                                            <?php displayRandomElement($arPostTagsNames); ?>
                                                        </div>
                                                        <div class="tp-caption Fashion-BigDisplay   tp-resizeme"
                                                             id="slide-88-layer-3" data-x="351" data-y="center"
                                                             data-voffset="-78" data-width="['auto']"
                                                             data-height="['auto']" data-type="text"
                                                             data-responsive_offset="on"
                                                             data-frames='[{"from":"x:50px;opacity:0;","speed":600,"to":"o:1;","delay":3000,"ease":"Power2.easeInOut"},{"delay":6800,"speed":600,"to":"x:50px;opacity:0;","ease":"Power4.easeIn"}]'
                                                             data-textAlign="['left','left','left','left']"
                                                             data-paddingtop="[0,0,0,0]" data-paddingright="[0,0,0,0]"
                                                             data-paddingbottom="[0,0,0,0]" data-paddingleft="[0,0,0,0]"
                                                             style="z-index: 58; white-space: nowrap; font-size: 125px; font-weight: 800; color: rgba(255,255,255,1);font-family:Open Sans;text-transform:uppercase;z-index:2;position:absolute;margin:0px;white-space:nowrap;letter-spacing:-2px;">
                                                            <?php displayRandomElement($arPostTagsNames); ?>
                                                        </div>
                                                        <div class="tp-caption Fashion-BigDisplay   tp-resizeme"
                                                             id="slide-88-layer-4" data-x="350" data-y="center"
                                                             data-voffset="80" data-width="['auto']"
                                                             data-height="['auto']" data-type="text"
                                                             data-responsive_offset="on"
                                                             data-frames='[{"from":"x:50px;opacity:0;","speed":600,"to":"o:1;","delay":3500,"ease":"Power4.easeOut"},{"delay":800,"speed":600,"to":"x:50px;opacity:0;","ease":"Power4.easeIn"}]'
                                                             data-textAlign="['left','left','left','left']"
                                                             data-paddingtop="[0,0,0,0]" data-paddingright="[0,0,0,0]"
                                                             data-paddingbottom="[0,0,0,0]" data-paddingleft="[0,0,0,0]"
                                                             style="z-index: 59; white-space: nowrap; font-size: 32px; font-weight: 700; color: rgba(255,255,255,1);font-family:Open Sans;text-transform:uppercase;z-index:2;position:absolute;margin:0px;white-space:nowrap;letter-spacing:-2px;">
                                                            <?php displayRandomElement($arPostTagsNames); ?>
                                                        </div>
                                                        <div class="tp-caption Fashion-BigDisplay   tp-resizeme"
                                                             id="slide-88-layer-5" data-x="350" data-y="center"
                                                             data-voffset="140" data-width="['auto']"
                                                             data-height="['auto']" data-type="text"
                                                             data-responsive_offset="on"
                                                             data-frames='[{"from":"x:-50px;opacity:0;","speed":600,"to":"o:1;","delay":4000,"ease":"Power4.easeOut"},{"delay":300,"speed":600,"to":"x:-50px;opacity:0;","ease":"Power4.easeIn"}]'
                                                             data-textAlign="['left','left','left','left']"
                                                             data-paddingtop="[0,0,0,0]" data-paddingright="[0,0,0,0]"
                                                             data-paddingbottom="[0,0,0,0]" data-paddingleft="[0,0,0,0]"
                                                             style="z-index: 60; white-space: nowrap; font-size: 70px; font-weight: 800; color: rgba(255,255,255,1);font-family:Open Sans;text-transform:uppercase;z-index:5;position:absolute;margin:0px;white-space:nowrap;letter-spacing:-2px;">
                                                            <?php displayRandomElement($arPostTagsNames); ?>
                                                        </div>
                                                        <div class="tp-caption Fashion-BigDisplay   tp-resizeme"
                                                             id="slide-88-layer-6" data-x="350" data-y="center"
                                                             data-voffset="80" data-width="['auto']"
                                                             data-height="['auto']" data-type="text"
                                                             data-responsive_offset="on"
                                                             data-frames='[{"from":"x:50px;opacity:0;","speed":600,"to":"o:1;","delay":6500,"ease":"Power4.easeOut"},{"delay":300,"speed":600,"to":"x:50px;opacity:0;","ease":"Power4.easeIn"}]'
                                                             data-textAlign="['left','left','left','left']"
                                                             data-paddingtop="[0,0,0,0]" data-paddingright="[0,0,0,0]"
                                                             data-paddingbottom="[0,0,0,0]" data-paddingleft="[0,0,0,0]"
                                                             style="z-index: 61; white-space: nowrap; font-size: 32px; font-weight: 700; color: rgba(255,255,255,1);font-family:Open Sans;text-transform:uppercase;z-index:2;position:absolute;margin:0px;white-space:nowrap;letter-spacing:-2px;">
                                                            <?php displayRandomElement($arPostTagsNames); ?>
                                                        </div>
                                                        <div class="tp-caption Fashion-BigDisplay   tp-resizeme"
                                                             id="slide-88-layer-7" data-x="350" data-y="center"
                                                             data-voffset="140" data-width="['auto']"
                                                             data-height="['auto']" data-type="text"
                                                             data-responsive_offset="on"
                                                             data-frames='[{"from":"x:-50px;opacity:0;","speed":600,"to":"o:1;","delay":6000,"ease":"Power2.easeInOut"},{"delay":800,"speed":600,"to":"x:-50px;opacity:0;","ease":"Power4.easeIn"}]'
                                                             data-textAlign="['left','left','left','left']"
                                                             data-paddingtop="[0,0,0,0]" data-paddingright="[0,0,0,0]"
                                                             data-paddingbottom="[0,0,0,0]" data-paddingleft="[0,0,0,0]"
                                                             style="z-index: 62; white-space: nowrap; font-size: 70px; font-weight: 800; color: rgba(255,255,255,1);font-family:Open Sans;text-transform:uppercase;z-index:5;position:absolute;margin:0px;white-space:nowrap;letter-spacing:-2px;">
                                                            <?php displayRandomElement($arPostTagsNames); ?>
                                                        </div>
                                                        <div class="tp-caption Fashion-BigDisplay   tp-resizeme"
                                                             id="slide-88-layer-8" data-x="350" data-y="center"
                                                             data-voffset="80" data-width="['auto']"
                                                             data-height="['auto']" data-type="text"
                                                             data-responsive_offset="on"
                                                             data-frames='[{"from":"x:50px;opacity:0;","speed":600,"to":"o:1;","delay":8500,"ease":"Power4.easeOut"},{"delay":1300,"speed":600,"to":"x:50px;opacity:0;","ease":"Power4.easeIn"}]'
                                                             data-textAlign="['left','left','left','left']"
                                                             data-paddingtop="[0,0,0,0]" data-paddingright="[0,0,0,0]"
                                                             data-paddingbottom="[0,0,0,0]" data-paddingleft="[0,0,0,0]"
                                                             style="z-index: 63; white-space: nowrap; font-size: 32px; font-weight: 700; color: rgba(255,255,255,1);font-family:Open Sans;text-transform:uppercase;z-index:2;position:absolute;margin:0px;white-space:nowrap;letter-spacing:-2px;">
                                                            <?php displayRandomElement($arPostTagsNames); ?>
                                                        </div>
                                                        <div class="tp-caption Fashion-BigDisplay   tp-resizeme"
                                                             id="slide-88-layer-9" data-x="350" data-y="center"
                                                             data-voffset="140" data-width="['auto']"
                                                             data-height="['auto']" data-type="text"
                                                             data-responsive_offset="on"
                                                             data-frames='[{"from":"x:-50px;opacity:0;","speed":600,"to":"o:1;","delay":9000,"ease":"Power4.easeOut"},{"delay":800,"speed":600,"to":"x:-50px;opacity:0;","ease":"Power4.easeIn"}]'
                                                             data-textAlign="['left','left','left','left']"
                                                             data-paddingtop="[0,0,0,0]" data-paddingright="[0,0,0,0]"
                                                             data-paddingbottom="[0,0,0,0]" data-paddingleft="[0,0,0,0]"
                                                             style="z-index: 64; white-space: nowrap; font-size: 70px; font-weight: 800; color: rgba(255,255,255,1);font-family:Open Sans;text-transform:uppercase;z-index:5;position:absolute;margin:0px;white-space:nowrap;letter-spacing:-2px;">
                                                            <?php displayRandomElement($arPostTagsNames); ?>
                                                        </div>
                                                    </li>
                                                    <?php
                                                    $filename = getRandomElement($arProjectImages);
                                                    
                                                    ?>
                                                    <li data-index="rs-89" data-transition="curtain-3"
                                                        data-slotamount="1" data-hideafterloop="0"
                                                        data-hideslideonmobile="off" data-easein="default"
                                                        data-easeout="default" data-masterspeed="500"
                                                        data-thumb="<?php echo $filename; ?>"
                                                        data-delay="11000" data-rotate="0" data-saveperformance="off"
                                                        class="no-transition" data-title="GROUP TOURS" data-param1=""
                                                        data-param2="" data-param3="" data-param4="" data-param5=""
                                                        data-param6="" data-param7="" data-param8="" data-param9=""
                                                        data-param10="" data-description="">
                                                        <?php
                                                        $filename = getRandomElement($arProjectImages);
                                                        $new_filen = $_SERVER["DOCUMENT_ROOT"].'/wp-content/uploads/' . basename($filename);


                                                        $fileNew = "/wp-content/uploads/" . basename($filename);

                                                        $fileNew = cropImage($filename,
                                                            $_SERVER['DOCUMENT_ROOT'] . $fileNew,
                                                            1920, 1080);
                                                        ?>
                                                        <img
                                                            src="http://wpdemos.themezaa.com/h-code/wp-content/plugins/revslider/admin/assets/images/dummy.png"
                                                            alt="" title="intro-travel-07-bg" width="1920" height="1080"
                                                            data-lazyload="<?php echo $fileNew; ?>"
                                                            data-bgposition="center center" data-bgfit="cover"
                                                            data-bgrepeat="no-repeat" class="rev-slidebg"
                                                            data-no-retina>
                                                        <div class="tp-caption   tp-resizeme" id="slide-89-layer-1"
                                                             data-x="right" data-hoffset="450" data-y="center"
                                                             data-voffset="-200"
                                                             data-width="['none','none','none','none']"
                                                             data-height="['none','none','none','none']"
                                                             data-type="image" data-responsive_offset="on"
                                                             data-frames='[{"from":"y:50px;opacity:0;","speed":600,"to":"o:1;","delay":1300,"ease":"Power4.easeOut"},{"delay":8500,"speed":600,"to":"y:50px;opacity:0;","ease":"Power4.easeIn"}]'
                                                             data-textAlign="['left','left','left','left']"
                                                             data-paddingtop="[0,0,0,0]" data-paddingright="[0,0,0,0]"
                                                             data-paddingbottom="[0,0,0,0]" data-paddingleft="[0,0,0,0]"
                                                             style="z-index: 65;text-transform:uppercase;z-index:2;">
                                                            <?php
                                                            $filename = getRandomElement($arProjectImages);
                                                            $new_filen = $_SERVER["DOCUMENT_ROOT"].'/wp-content/uploads/' . basename($filename);


                                                            $fileNew = "/wp-content/uploads/" . basename($filename);

                                                            $fileNew = cropImage($filename,
                                                                $_SERVER['DOCUMENT_ROOT'] . $fileNew,
                                                                196, 450);
                                                            ?>
                                                            <img
                                                                src="http://wpdemos.themezaa.com/h-code/wp-content/plugins/revslider/admin/assets/images/dummy.png"
                                                                alt="" data-ww="196px" data-hh="450px" width="196"
                                                                height="450"
                                                                data-lazyload="<?php echo $fileNew; ?>"
                                                                data-no-retina></div>
                                                        <div class="tp-caption   tp-resizeme" id="slide-89-layer-2"
                                                             data-x="right" data-hoffset="750" data-y="center"
                                                             data-voffset="" data-width="['none','none','none','none']"
                                                             data-height="['none','none','none','none']"
                                                             data-type="image" data-responsive_offset="on"
                                                             data-frames='[{"from":"y:50px;opacity:0;","speed":600,"to":"o:1;","delay":1800,"ease":"Power4.easeOut"},{"delay":8000,"speed":600,"to":"y:50px;opacity:0;","ease":"Power4.easeIn"}]'
                                                             data-textAlign="['left','left','left','left']"
                                                             data-paddingtop="[0,0,0,0]" data-paddingright="[0,0,0,0]"
                                                             data-paddingbottom="[0,0,0,0]" data-paddingleft="[0,0,0,0]"
                                                             style="z-index: 66;text-transform:uppercase;z-index:2;">
                                                            <?php
                                                            $filename = getRandomElement($arProjectImages);
                                                            $new_filen = $_SERVER["DOCUMENT_ROOT"].'/wp-content/uploads/' . basename($filename);


                                                            $fileNew = "/wp-content/uploads/" . basename($filename);

                                                            $fileNew = cropImage($filename,
                                                                $_SERVER['DOCUMENT_ROOT'] . $fileNew,
                                                                340, 646);
                                                            ?>
                                                            <img
                                                                src="http://wpdemos.themezaa.com/h-code/wp-content/plugins/revslider/admin/assets/images/dummy.png"
                                                                alt="" data-ww="340px" data-hh="646px" width="340"
                                                                height="646"
                                                                data-lazyload="<?php echo $fileNew; ?>"
                                                                data-no-retina></div>
                                                        <div class="tp-caption   tp-resizeme" id="slide-89-layer-3"
                                                             data-x="right" data-hoffset="" data-y="bottom"
                                                             data-voffset="-30"
                                                             data-width="['none','none','none','none']"
                                                             data-height="['none','none','none','none']"
                                                             data-type="image" data-responsive_offset="on"
                                                             data-frames='[{"from":"y:50px;opacity:0;","speed":600,"to":"o:1;","delay":2300,"ease":"Power4.easeOut"},{"delay":7500,"speed":600,"to":"y:50px;opacity:0;","ease":"Power4.easeIn"}]'
                                                             data-textAlign="['left','left','left','left']"
                                                             data-paddingtop="[0,0,0,0]" data-paddingright="[0,0,0,0]"
                                                             data-paddingbottom="[0,0,0,0]" data-paddingleft="[0,0,0,0]"
                                                             style="z-index: 67;text-transform:uppercase;z-index:2;">
                                                            <?php
                                                            $filename = getRandomElement($arProjectImages);
                                                            $new_filen = $_SERVER["DOCUMENT_ROOT"].'/wp-content/uploads/' . basename($filename);


                                                            $fileNew = "/wp-content/uploads/" . basename($filename);

                                                            $fileNew = cropImage($filename,
                                                                $_SERVER['DOCUMENT_ROOT'] . $fileNew,
                                                                599, 874);
                                                            ?>
                                                            <img
                                                                src="http://wpdemos.themezaa.com/h-code/wp-content/plugins/revslider/admin/assets/images/dummy.png"
                                                                alt="" data-ww="599px" data-hh="874px" width="599"
                                                                height="874"
                                                                data-lazyload=""<?php echo $fileNew; ?>"
                                                                data-no-retina></div>
                                                        <div class="tp-caption Fashion-BigDisplay   tp-resizeme"
                                                             id="slide-89-layer-4" data-x="350" data-y="center"
                                                             data-voffset="-150" data-width="['auto']"
                                                             data-height="['auto']" data-type="text"
                                                             data-responsive_offset="on"
                                                             data-frames='[{"from":"x:-50px;opacity:0;","speed":600,"to":"o:1;","delay":2500,"ease":"Power2.easeInOut"},{"delay":7300,"speed":600,"to":"x:-50px;opacity:0;","ease":"Power4.easeIn"}]'
                                                             data-textAlign="['left','left','left','left']"
                                                             data-paddingtop="[0,0,0,0]" data-paddingright="[0,0,0,0]"
                                                             data-paddingbottom="[0,0,0,0]" data-paddingleft="[0,0,0,0]"
                                                             style="z-index: 68; white-space: nowrap; font-size: 70px; font-weight: 800; color: rgba(255,255,255,1);font-family:Open Sans;text-transform:uppercase;z-index:5;position:absolute;margin:0px;white-space:nowrap;letter-spacing:-2px;">
                                                            <?php displayRandomElement($arPostTagsNames); ?>
                                                        </div>
                                                        <div class="tp-caption Fashion-BigDisplay   tp-resizeme"
                                                             id="slide-89-layer-5" data-x="350" data-y="center"
                                                             data-voffset="-74" data-width="['auto']"
                                                             data-height="['auto']" data-type="text"
                                                             data-responsive_offset="on"
                                                             data-frames='[{"from":"x:50px;opacity:0;","speed":600,"to":"o:1;","delay":3000,"ease":"Power4.easeOut"},{"delay":6800,"speed":600,"to":"x:50px;opacity:0;","ease":"Power4.easeIn"}]'
                                                             data-textAlign="['left','left','left','left']"
                                                             data-paddingtop="[0,0,0,0]" data-paddingright="[0,0,0,0]"
                                                             data-paddingbottom="[0,0,0,0]" data-paddingleft="[0,0,0,0]"
                                                             style="z-index: 69; white-space: nowrap; font-size: 125px; font-weight: 800; color: rgba(255,255,255,1);font-family:Open Sans;text-transform:uppercase;z-index:2;position:absolute;margin:0px;white-space:nowrap;letter-spacing:-2px;">
                                                            <?php displayRandomElement($arPostTagsNames); ?>
                                                        </div>
                                                        <div class="tp-caption Fashion-BigDisplay   tp-resizeme"
                                                             id="slide-89-layer-6" data-x="350" data-y="center"
                                                             data-voffset="80" data-width="['auto']"
                                                             data-height="['auto']" data-type="text"
                                                             data-responsive_offset="on"
                                                             data-frames='[{"from":"x:50px;opacity:0;","speed":600,"to":"o:1;","delay":3500,"ease":"Power2.easeInOut"},{"delay":800,"speed":600,"to":"x:50px;opacity:0;","ease":"Power4.easeIn"}]'
                                                             data-textAlign="['left','left','left','left']"
                                                             data-paddingtop="[0,0,0,0]" data-paddingright="[0,0,0,0]"
                                                             data-paddingbottom="[0,0,0,0]" data-paddingleft="[0,0,0,0]"
                                                             style="z-index: 70; white-space: nowrap; font-size: 32px; font-weight: 700; color: rgba(255,255,255,1);font-family:Open Sans;text-transform:uppercase;z-index:2;position:absolute;margin:0px;white-space:nowrap;letter-spacing:-2px;">
                                                            <?php displayRandomElement($arPostTagsNames); ?>
                                                        </div>
                                                        <div class="tp-caption Fashion-BigDisplay   tp-resizeme"
                                                             id="slide-89-layer-7" data-x="350" data-y="center"
                                                             data-voffset="140" data-width="['auto']"
                                                             data-height="['auto']" data-type="text"
                                                             data-responsive_offset="on"
                                                             data-frames='[{"from":"x:-50px;opacity:0;","speed":600,"to":"o:1;","delay":4000,"ease":"Power4.easeOut"},{"delay":300,"speed":600,"to":"x:-50px;opacity:0;","ease":"Power4.easeIn"}]'
                                                             data-textAlign="['left','left','left','left']"
                                                             data-paddingtop="[0,0,0,0]" data-paddingright="[0,0,0,0]"
                                                             data-paddingbottom="[0,0,0,0]" data-paddingleft="[0,0,0,0]"
                                                             style="z-index: 71; white-space: nowrap; font-size: 70px; font-weight: 800; color: rgba(255,255,255,1);font-family:Open Sans;text-transform:uppercase;z-index:5;position:absolute;margin:0px;white-space:nowrap;letter-spacing:-2px;">
                                                            <?php displayRandomElement($arPostTagsNames); ?>
                                                        </div>
                                                        <div class="tp-caption Fashion-BigDisplay   tp-resizeme"
                                                             id="slide-89-layer-8" data-x="350" data-y="center"
                                                             data-voffset="80" data-width="['auto']"
                                                             data-height="['auto']" data-type="text"
                                                             data-responsive_offset="on"
                                                             data-frames='[{"from":"x:50px;opacity:0;","speed":600,"to":"o:1;","delay":6500,"ease":"Power4.easeOut"},{"delay":300,"speed":600,"to":"x:50px;opacity:0;","ease":"Power4.easeIn"}]'
                                                             data-textAlign="['left','left','left','left']"
                                                             data-paddingtop="[0,0,0,0]" data-paddingright="[0,0,0,0]"
                                                             data-paddingbottom="[0,0,0,0]" data-paddingleft="[0,0,0,0]"
                                                             style="z-index: 72; white-space: nowrap; font-size: 32px; font-weight: 700; color: rgba(255,255,255,1);font-family:Open Sans;text-transform:uppercase;z-index:2;position:absolute;margin:0px;white-space:nowrap;letter-spacing:-2px;">
                                                            <?php displayRandomElement($arPostTagsNames); ?>
                                                        </div>
                                                        <div class="tp-caption Fashion-BigDisplay   tp-resizeme"
                                                             id="slide-89-layer-9" data-x="350" data-y="center"
                                                             data-voffset="140" data-width="['auto']"
                                                             data-height="['auto']" data-type="text"
                                                             data-responsive_offset="on"
                                                             data-frames='[{"from":"x:-50px;opacity:0;","speed":600,"to":"o:1;","delay":6500,"ease":"Power4.easeOut"},{"delay":300,"speed":600,"to":"x:-50px;opacity:0;","ease":"Power4.easeIn"}]'
                                                             data-textAlign="['left','left','left','left']"
                                                             data-paddingtop="[0,0,0,0]" data-paddingright="[0,0,0,0]"
                                                             data-paddingbottom="[0,0,0,0]" data-paddingleft="[0,0,0,0]"
                                                             style="z-index: 73; white-space: nowrap; font-size: 70px; font-weight: 800; color: rgba(255,255,255,1);font-family:Open Sans;text-transform:uppercase;z-index:5;position:absolute;margin:0px;white-space:nowrap;letter-spacing:-2px;">
                                                            <?php displayRandomElement($arPostTagsNames); ?>
                                                        </div>
                                                        <div class="tp-caption Fashion-BigDisplay   tp-resizeme"
                                                             id="slide-89-layer-10" data-x="350" data-y="center"
                                                             data-voffset="80" data-width="['auto']"
                                                             data-height="['auto']" data-type="text"
                                                             data-responsive_offset="on"
                                                             data-frames='[{"from":"x:50px;opacity:0;","speed":600,"to":"o:1;","delay":8500,"ease":"Power2.easeInOut"},{"delay":1300,"speed":600,"to":"x:50px;opacity:0;","ease":"Power4.easeIn"}]'
                                                             data-textAlign="['left','left','left','left']"
                                                             data-paddingtop="[0,0,0,0]" data-paddingright="[0,0,0,0]"
                                                             data-paddingbottom="[0,0,0,0]" data-paddingleft="[0,0,0,0]"
                                                             style="z-index: 74; white-space: nowrap; font-size: 32px; font-weight: 700; color: rgba(255,255,255,1);font-family:Open Sans;text-transform:uppercase;z-index:2;position:absolute;margin:0px;white-space:nowrap;letter-spacing:-2px;">
                                                            <?php displayRandomElement($arPostTagsNames); ?>
                                                        </div>
                                                        <div class="tp-caption Fashion-BigDisplay   tp-resizeme"
                                                             id="slide-89-layer-11" data-x="350" data-y="center"
                                                             data-voffset="140" data-width="['auto']"
                                                             data-height="['auto']" data-type="text"
                                                             data-responsive_offset="on"
                                                             data-frames='[{"from":"x:-50px;opacity:0;","speed":600,"to":"o:1;","delay":9000,"ease":"Power2.easeInOut"},{"delay":800,"speed":600,"to":"x:-50px;opacity:0;","ease":"Power4.easeIn"}]'
                                                             data-textAlign="['left','left','left','left']"
                                                             data-paddingtop="[0,0,0,0]" data-paddingright="[0,0,0,0]"
                                                             data-paddingbottom="[0,0,0,0]" data-paddingleft="[0,0,0,0]"
                                                             style="z-index: 75; white-space: nowrap; font-size: 70px; font-weight: 800; color: rgba(255,255,255,1);font-family:Open Sans;text-transform:uppercase;z-index:5;position:absolute;margin:0px;white-space:nowrap;letter-spacing:-2px;">
                                                            <?php displayRandomElement($arPostTagsNames); ?>
                                                        </div>
                                                    </li>
                                                    <?php
                                                    $filename = getRandomElement($arProjectImages);
                                                    $new_filen = $_SERVER["DOCUMENT_ROOT"].'/wp-content/uploads/' . basename($filename);


                                                    $fileNew = "/wp-content/uploads/" . basename($filename);

                                                    $fileNew = cropImage($filename,
                                                        $_SERVER['DOCUMENT_ROOT'] . $fileNew,
                                                        100, 50);
                                                    ?>
                                                    <li data-index="rs-90" data-transition="curtain-3"
                                                        data-slotamount="1" data-hideafterloop="0"
                                                        data-hideslideonmobile="off" data-easein="default"
                                                        data-easeout="default" data-masterspeed="500"
                                                        data-thumb="<?php echo $fileNew; ?>"
                                                        data-delay="11000" data-rotate="0" data-saveperformance="off"
                                                        class="no-transition" data-title="THANK YOU" data-param1=""
                                                        data-param2="" data-param3="" data-param4="" data-param5=""
                                                        data-param6="" data-param7="" data-param8="" data-param9=""
                                                        data-param10="" data-description="">
                                                        <?php
                                                        $filename = getRandomElement($arProjectImages);
                                                        $new_filen = $_SERVER["DOCUMENT_ROOT"].'/wp-content/uploads/' . basename($filename);


                                                        $fileNew = "/wp-content/uploads/" . basename($filename);

                                                        $fileNew = cropImage($filename,
                                                            $_SERVER['DOCUMENT_ROOT'] . $fileNew,
                                                            1920, 1080);
                                                        ?>
                                                        <img
                                                            src="http://wpdemos.themezaa.com/h-code/wp-content/plugins/revslider/admin/assets/images/dummy.png"
                                                            alt="" title="intro-travel-04-bg" width="1920" height="1080"
                                                            data-lazyload="<?php echo $fileNew; ?>"
                                                            data-bgposition="center bottom" data-bgfit="cover"
                                                            data-bgrepeat="no-repeat" class="rev-slidebg"
                                                            data-no-retina>
                                                        <div class="tp-caption Fashion-BigDisplay   tp-resizeme"
                                                             id="slide-90-layer-1" data-x="center" data-hoffset="300"
                                                             data-y="center" data-voffset="-210" data-width="['auto']"
                                                             data-height="['auto']" data-type="text"
                                                             data-responsive_offset="on"
                                                             data-frames='[{"delay":1300,"speed":600,"frame":"0","from":"x:-50px;opacity:0;","to":"o:1;","ease":"Power4.easeOut"},{"delay":"+8500","speed":600,"frame":"999","to":"x:-50px;opacity:0;","ease":"Power4.easeIn"}]'
                                                             data-textAlign="['left','left','left','left']"
                                                             data-paddingtop="[0,0,0,0]" data-paddingright="[0,0,0,0]"
                                                             data-paddingbottom="[0,0,0,0]" data-paddingleft="[0,0,0,0]"
                                                             style="z-index: 5; white-space: nowrap; font-size: 90px; font-weight: 800; color: rgba(255,255,255,1); letter-spacing: ;font-family:Open Sans;text-transform:uppercase;z-index:2;position:absolute;margin:0px;white-space:nowrap;letter-spacing:-2px;">
                                                            <?php displayRandomElement($arPostTagsNames); ?>
                                                        </div>
                                                        <div class="tp-caption Fashion-BigDisplay   tp-resizeme"
                                                             id="slide-90-layer-2" data-x="center" data-hoffset="284"
                                                             data-y="center" data-voffset="-135" data-width="['auto']"
                                                             data-height="['auto']" data-type="text"
                                                             data-responsive_offset="on"
                                                             data-frames='[{"delay":1800,"speed":600,"frame":"0","from":"x:50px;opacity:0;","to":"o:1;","ease":"Power4.easeOut"},{"delay":"+8300","speed":600,"frame":"999","to":"x:50px;opacity:0;","ease":"Power4.easeIn"}]'
                                                             data-textAlign="['left','left','left','left']"
                                                             data-paddingtop="[0,0,0,0]" data-paddingright="[0,0,0,0]"
                                                             data-paddingbottom="[0,0,0,0]" data-paddingleft="[0,0,0,0]"
                                                             style="z-index: 6; white-space: nowrap; font-size: 70px; font-weight: 800; color: rgba(255,255,255,1); letter-spacing: ;font-family:Open Sans;text-transform:uppercase;z-index:2;position:absolute;margin:0px;white-space:nowrap;letter-spacing:-2px;">
                                                            <?php displayRandomElement($arPostTagsNames); ?>
                                                        </div>
                                                        <div class="tp-caption Fashion-BigDisplay   tp-resizeme"
                                                             id="slide-90-layer-3" data-x="center" data-hoffset="243"
                                                             data-y="center" data-voffset="-70" data-width="['auto']"
                                                             data-height="['auto']" data-type="text"
                                                             data-responsive_offset="on"
                                                             data-frames='[{"delay":2100,"speed":600,"frame":"0","from":"x:-50px;opacity:0;","to":"o:1;","ease":"Power4.easeOut"},{"delay":"+7700","speed":600,"frame":"999","to":"x:-50px;opacity:0;","ease":"Power4.easeIn"}]'
                                                             data-textAlign="['left','left','left','left']"
                                                             data-paddingtop="[0,0,0,0]" data-paddingright="[0,0,0,0]"
                                                             data-paddingbottom="[0,0,0,0]" data-paddingleft="[0,0,0,0]"
                                                             style="z-index: 7; white-space: nowrap; font-size: 70px; font-weight: 800; color: rgba(255,255,255,1); letter-spacing: ;font-family:Open Sans;text-transform:uppercase;z-index:2;">
                                                            <?php displayRandomElement($arPostTagsNames); ?>
                                                        </div>
                                                        <div class="tp-caption Fashion-BigDisplay   tp-resizeme"
                                                             id="slide-90-layer-4" data-x="center" data-hoffset="320"
                                                             data-y="center" data-voffset="-10" data-width="['auto']"
                                                             data-height="['auto']" data-type="text"
                                                             data-responsive_offset="on"
                                                             data-frames='[{"delay":2300,"speed":600,"frame":"0","from":"x:50px;opacity:0;","to":"o:1;","ease":"Power4.easeOut"},{"delay":"wait","speed":300,"frame":"999","to":"x:50px;opacity:0;","ease":"Power4.easeIn"}]'
                                                             data-textAlign="['center','center','center','center']"
                                                             data-paddingtop="[0,0,0,0]" data-paddingright="[0,0,0,0]"
                                                             data-paddingbottom="[0,0,0,0]" data-paddingleft="[0,0,0,0]"
                                                             style="z-index: 8; white-space: nowrap; font-size: 20px; line-height: 30px; font-weight: 600; color: rgba(255,255,255,1); letter-spacing: px;font-family:Open Sans;text-transform:uppercase;text-decoration:none;z-index:2;letter-spacing:4px;">
                                                            <strong><?php echo $arProject["post_content_formatted"];?></strong>
                                                        </div>
                                                        <div class="tp-caption rev-btn " id="slide-90-layer-7"
                                                             data-x="center" data-hoffset="100" data-y="center"
                                                             data-voffset="70" data-width="['auto']"
                                                             data-height="['auto']" data-type="button"
                                                             data-responsive_offset="on"
                                                             data-frames='[{"delay":2800,"speed":300,"frame":"0","from":"opacity:0;","to":"o:1;","ease":"Power2.easeInOut"},{"delay":"wait","speed":300,"frame":"999","to":"opacity:0;","ease":"nothing"},{"frame":"hover","speed":"0","ease":"Linear.easeNone","to":"o:1;rX:0;rY:0;rZ:0;z:0;","style":"c:rgba(0, 0, 0, 1);bg:rgba(255, 255, 255, 1);bw:2 2 2 2;"}]'
                                                             data-textAlign="['center','center','center','center']"
                                                             data-paddingtop="[10,10,10,10]"
                                                             data-paddingright="[30,30,30,30]"
                                                             data-paddingbottom="[10,10,10,10]"
                                                             data-paddingleft="[30,30,30,30]"
                                                             style="z-index: 9; white-space: nowrap; font-size: 14px; line-height: 14px; font-weight: 500; color: rgba(255,255,255,1); letter-spacing: px;font-family:Roboto;border-color:rgba(255, 255, 255, 1);border-style:solid;border-width:2px 2px 2px 2px;outline:none;box-shadow:none;box-sizing:border-box;-moz-box-sizing:border-box;-webkit-box-sizing:border-box;cursor:pointer;">
                                                            <?php echo $arProject["post_title"];?>
                                                        </div>
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
                                                        e.c = jQuery('#rev_slider_15_1');
                                                        e.gridwidth = [1920];
                                                        e.gridheight = [980];
                                                        e.sliderLayout = "fullscreen";
                                                        e.fullScreenAutoWidth = 'off';
                                                        e.fullScreenAlignForce = 'off';
                                                        e.fullScreenOffsetContainer = '';
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
                                                var revapi15;
                                                tpj(document).ready(function () {
                                                    if (tpj("#rev_slider_15_1").revolution == undefined) {
                                                        revslider_showDoubleJqueryError("#rev_slider_15_1");
                                                    } else {
                                                        revapi15 = tpj("#rev_slider_15_1").show().revolution({
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
                                                                    style: "ares",
                                                                    enable: true,
                                                                    hide_onmobile: true,
                                                                    hide_under: 600,
                                                                    hide_onleave: false,
                                                                    tmp: '<div class="tp-title-wrap"> <span class="tp-arr-titleholder">{{title}}</span> </div>',
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
                                                            viewPort: {
                                                                enable: true,
                                                                outof: "wait",
                                                                visible_area: "80%",
                                                                presize: false
                                                            },
                                                            visibilityLevels: [1240, 1024, 778, 480],
                                                            gridwidth: 1920,
                                                            gridheight: 980,
                                                            lazyType: "single",
                                                            shadow: 0,
                                                            spinner: "spinner3",
                                                            stopLoop: "off",
                                                            stopAfterLoops: -1,
                                                            stopAtSlide: -1,
                                                            shuffle: "off",
                                                            autoHeight: "off",
                                                            fullScreenAutoWidth: "off",
                                                            fullScreenAlignForce: "off",
                                                            fullScreenOffsetContainer: "",
                                                            fullScreenOffset: "",
                                                            disableProgressBar: "on",
                                                            hideThumbsOnMobile: "off",
                                                            hideSliderAtLimit: 0,
                                                            hideCaptionAtLimit: 0,
                                                            hideAllCaptionAtLilmit: 0,
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
                                                var htmlDivCss = ' #rev_slider_15_1_wrapper .tp-loader.spinner3 div { background-color: #d6b642 !important; } ';
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
                                                var htmlDivCss = unescape(".ares.tparrows%20%7B%0A%09cursor%3Apointer%3B%0A%09background%3Argba%28255%2C%20255%2C%20255%2C%201%29%3B%0A%09min-width%3A60px%3B%0A%20%20%20%20min-height%3A60px%3B%0A%09position%3Aabsolute%3B%0A%09display%3Ablock%3B%0A%09z-index%3A100%3B%0A%20%20%20%20border-radius%3A50%25%3B%0A%7D%0A.ares.tparrows%3Ahover%20%7B%0A%7D%0A.ares.tparrows%3Abefore%20%7B%0A%09font-family%3A%20%22revicons%22%3B%0A%09font-size%3A25px%3B%0A%09color%3Argba%28170%2C%20170%2C%20170%2C%201%29%3B%0A%09display%3Ablock%3B%0A%09line-height%3A%2060px%3B%0A%09text-align%3A%20center%3B%0A%20%20%20%20-webkit-transition%3A%20color%200.3s%3B%0A%20%20%20%20-moz-transition%3A%20color%200.3s%3B%0A%20%20%20%20transition%3A%20color%200.3s%3B%0A%20%20%20%20z-index%3A2%3B%0A%20%20%20%20position%3Arelative%3B%0A%7D%0A.ares.tparrows.tp-leftarrow%3Abefore%20%7B%0A%09content%3A%20%22%5Ce81f%22%3B%0A%7D%0A.ares.tparrows.tp-rightarrow%3Abefore%20%7B%0A%09content%3A%20%22%5Ce81e%22%3B%0A%7D%0A.ares.tparrows%3Ahover%3Abefore%20%7B%0A%20color%3Argb%280%2C%200%2C%200%29%3B%0A%20%20%20%20%20%20%7D%0A.tp-title-wrap%20%7B%20%0A%20%20position%3Aabsolute%3B%0A%20%20z-index%3A1%3B%0A%20%20display%3Ainline-block%3B%0A%20%20background%3Argba%28255%2C%20255%2C%20255%2C%201%29%3B%0A%20%20min-height%3A60px%3B%0A%20%20line-height%3A60px%3B%0A%20%20top%3A0px%3B%0A%20%20margin-left%3A30px%3B%0A%20%20border-radius%3A0px%2030px%2030px%200px%3B%0A%20%20overflow%3Ahidden%3B%0A%20%20-webkit-transition%3A%20-webkit-transform%200.3s%3B%0A%20%20transition%3A%20transform%200.3s%3B%0A%20%20transform%3Ascalex%280%29%3B%20%20%0A%20%20-webkit-transform%3Ascalex%280%29%3B%20%20%0A%20%20transform-origin%3A0%25%2050%25%3B%20%0A%20%20%20-webkit-transform-origin%3A0%25%2050%25%3B%0A%7D%0A%20.ares.tp-rightarrow%20.tp-title-wrap%20%7B%20%0A%20%20%20right%3A0px%3B%0A%20%20%20margin-right%3A30px%3Bmargin-left%3A0px%3B%0A%20%20%20-webkit-transform-origin%3A100%25%2050%25%3B%0Aborder-radius%3A30px%200px%200px%2030px%3B%0A%20%7D%0A.ares.tparrows%3Ahover%20.tp-title-wrap%20%7B%0A%09transform%3Ascalex%281%29%20scaley%281%29%3B%0A%20%20%09-webkit-transform%3Ascalex%281%29%20scaley%281%29%3B%0A%7D%0A.ares%20.tp-arr-titleholder%20%7B%0A%20%20position%3Arelative%3B%0A%20%20-webkit-transition%3A%20-webkit-transform%200.3s%3B%0A%20%20transition%3A%20transform%200.3s%3B%0A%20%20transform%3Atranslatex%28200px%29%3B%20%20%0A%20%20text-transform%3Auppercase%3B%0A%20%20color%3Argb%280%2C%200%2C%200%29%3B%0A%20%20font-weight%3A400%3B%0A%20%20font-size%3A14px%3B%0A%20%20line-height%3A60px%3B%0A%20%20white-space%3Anowrap%3B%0A%20%20padding%3A0px%2020px%3B%0A%20%20margin-left%3A10px%3B%0A%20%20opacity%3A0%3B%0A%7D%0A%0A.ares.tp-rightarrow%20.tp-arr-titleholder%20%7B%0A%20%20%20transform%3Atranslatex%28-200px%29%3B%20%0A%20%20%20margin-left%3A0px%3B%20margin-right%3A10px%3B%0A%20%20%20%20%20%20%7D%0A%0A.ares.tparrows%3Ahover%20.tp-arr-titleholder%20%7B%0A%20%20%20transform%3Atranslatex%280px%29%3B%0A%20%20%20-webkit-transform%3Atranslatex%280px%29%3B%0A%20%20transition-delay%3A%200.1s%3B%0A%20%20opacity%3A1%3B%0A%7D%0A");
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
            </div>
        </div>
    </div>
</section>
<footer class="bg-light-gray2"><a class="scrollToTop" href="javascript:void(0);"> <i class="fa fa-angle-up"></i> </a>
</footer>
<?php
include $_SERVER['DOCUMENT_ROOT'] . '/includes/footer_scripts_detail__restaurant-intro.php';

include $_SERVER['DOCUMENT_ROOT'] . '/includes/detail_pagination_intro.php';
?>



<script type="text/javascript"
        src="/includes/js/images.js"></script>



</body>
</html>