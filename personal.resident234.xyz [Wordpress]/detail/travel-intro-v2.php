<?php
/**
 * Created by PhpStorm.
 * User: GSU
 * Date: 29.07.2017
 * Time: 15:16
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
<body class="page-template-default page page-id-39 wpb-js-composer js-comp-ver-5.1 vc_responsive">
<section class="parent-section no-padding post-39 page type-page status-publish hentry">
    <div class="container-fluid">
        <div class="row">
            <div class="entry-content">
                <section class=" no-transition intro-page no-padding">
                    <div class="container-fluid">
                        <div class="row">
                            <div class="wpb_column hcode-column-container  col-xs-mobile-fullwidth">
                                <div class="vc-column-innner-wrapper">
                                    <div class="wpb_revslider_element wpb_content_element">
                                        <link
                                            href="http://fonts.googleapis.com/css?family=Oswald:400|Open+Sans:300%2C600"
                                            rel="stylesheet" property="stylesheet" type="text/css" media="all">
                                        <div id="rev_slider_17_1_wrapper"
                                             class="rev_slider_wrapper fullscreen-container" data-source="gallery"
                                             style="background:transparent;padding:0px;">
                                            <div id="rev_slider_17_1" class="rev_slider fullscreenbanner"
                                                 style="display:none;" data-version="5.4.1">
                                                <ul>
                                                    <?php
                                                    $filename = getRandomElement($arProjectImages);
                                                    $new_filen = $_SERVER["DOCUMENT_ROOT"].'/wp-content/uploads/' . basename($filename);


                                                    $fileNew = "/wp-content/uploads/" . basename($filename);

                                                    $fileNew = cropImage($filename,
                                                        $_SERVER['DOCUMENT_ROOT'] . $fileNew,
                                                        100, 50);
                                                    ?>
                                                    <li data-index="rs-100" data-transition="random-premium"
                                                        data-slotamount="1" data-hideafterloop="0"
                                                        data-hideslideonmobile="off" data-easein="default"
                                                        data-easeout="default" data-masterspeed="500"
                                                        data-thumb="<?php echo $fileNew; ?>"
                                                        data-delay="8000" data-rotate="0" data-saveperformance="off"
                                                        class="no-transition" data-title="<?php echo $arProject["post_title"];?>" data-param1=""
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
                                                            src="<?php echo $fileNew; ?>"
                                                            alt="" title="intro-travel2-01-bg" width="1920"
                                                            height="1080" data-bgposition="center bottom"
                                                            data-bgfit="cover" data-bgrepeat="no-repeat"
                                                            class="rev-slidebg" data-no-retina>
                                                        <div class="tp-caption   tp-resizeme" id="slide-100-layer-1"
                                                             data-x="center" data-hoffset="" data-y="center"
                                                             data-voffset="" data-width="['none','none','none','none']"
                                                             data-height="['none','none','none','none']"
                                                             data-type="image" data-responsive_offset="on"
                                                             data-frames='[{"from":"y:50px;opacity:0;","speed":1,"to":"o:1;","delay":1,"ease":"Power4.easeOut"},{"delay":"wait","speed":1,"to":"y:50px;opacity:0;","ease":"Power4.easeIn"}]'
                                                             data-textAlign="['left','left','left','left']"
                                                             data-paddingtop="[0,0,0,0]" data-paddingright="[0,0,0,0]"
                                                             data-paddingbottom="[0,0,0,0]" data-paddingleft="[0,0,0,0]"
                                                             style="z-index: 5;text-transform:left;z-index:100;">

                                                            <img
                                                                src="http://wpdemos.themezaa.com/h-code/wp-content/uploads/revslider/fashion_intro/white-up.png"
                                                                alt="" data-ww="5760px" data-hh="3240px" width="5760"
                                                                height="3240" data-no-retina></div>
                                                        <div class="tp-caption   tp-resizeme" id="slide-100-layer-2"
                                                             data-x="-100" data-y=""
                                                             data-width="['none','none','none','none']"
                                                             data-height="['none','none','none','none']"
                                                             data-type="image" data-responsive_offset="on"
                                                             data-frames='[{"from":"x:-50px;opacity:0;","speed":600,"to":"o:1;","delay":1500,"ease":"Power4.easeOut"},{"delay":4900,"speed":1000,"to":"y:-50px;opacity:0;","ease":"Power4.easeIn"}]'
                                                             data-textAlign="['left','left','left','left']"
                                                             data-paddingtop="[0,0,0,0]" data-paddingright="[0,0,0,0]"
                                                             data-paddingbottom="[0,0,0,0]" data-paddingleft="[0,0,0,0]"
                                                             style="z-index: 6;text-transform:left;z-index:1;">
                                                            <?php
                                                            $filename = getRandomElement($arProjectImages);
                                                            $new_filen = $_SERVER["DOCUMENT_ROOT"].'/wp-content/uploads/' . basename($filename);


                                                            $fileNew = "/wp-content/uploads/" . basename($filename);

                                                            $fileNew = cropImage($filename,
                                                                $_SERVER['DOCUMENT_ROOT'] . $fileNew,
                                                                848, 1500);
                                                            ?>
                                                            <img
                                                                src="<?php echo $fileNew; ?>"
                                                                alt="" data-ww="848px" data-hh="1500px" width="848"
                                                                height="1500" data-no-retina></div>
                                                        <div class="tp-caption   tp-resizeme" id="slide-100-layer-3"
                                                             data-x="1200" data-y="300"
                                                             data-width="['none','none','none','none']"
                                                             data-height="['none','none','none','none']"
                                                             data-type="image" data-responsive_offset="on"
                                                             data-frames='[{"from":"y:bottom;","speed":3000,"to":"o:1;","delay":1500,"ease":"Power4.easeOut"},{"delay":500,"speed":3000,"to":"y:top;","ease":"Power4.easeIn"}]'
                                                             data-textAlign="['left','left','left','left']"
                                                             data-paddingtop="[0,0,0,0]" data-paddingright="[0,0,0,0]"
                                                             data-paddingbottom="[0,0,0,0]" data-paddingleft="[0,0,0,0]"
                                                             style="z-index: 7;text-transform:left;z-index:8;">
                                                            <?php
                                                            $filename = getRandomElement($arProjectImages);
                                                            $new_filen = $_SERVER["DOCUMENT_ROOT"].'/wp-content/uploads/' . basename($filename);


                                                            $fileNew = "/wp-content/uploads/" . basename($filename);

                                                            $fileNew = cropImage($filename,
                                                                $_SERVER['DOCUMENT_ROOT'] . $fileNew,
                                                                541, 508);
                                                            ?>
                                                            <img
                                                                src="<?php echo $fileNew; ?>"
                                                                alt="" data-ww="541px" data-hh="508px" width="541"
                                                                height="508" data-no-retina></div>
                                                        <div class="tp-caption   tp-resizeme" id="slide-100-layer-4"
                                                             data-x="770" data-y="550"
                                                             data-width="['none','none','none','none']"
                                                             data-height="['none','none','none','none']"
                                                             data-type="image" data-responsive_offset="on"
                                                             data-frames='[{"from":"x:left;","speed":3000,"to":"o:1;","delay":1500,"ease":"Power4.easeOut"},{"delay":500,"speed":3000,"to":"x:right;","ease":"Power4.easeIn"}]'
                                                             data-textAlign="['left','left','left','left']"
                                                             data-paddingtop="[0,0,0,0]" data-paddingright="[0,0,0,0]"
                                                             data-paddingbottom="[0,0,0,0]" data-paddingleft="[0,0,0,0]"
                                                             style="z-index: 8;text-transform:left;z-index:4;">
                                                            <?php
                                                            $filename = getRandomElement($arProjectImages);
                                                            $new_filen = $_SERVER["DOCUMENT_ROOT"].'/wp-content/uploads/' . basename($filename);


                                                            $fileNew = "/wp-content/uploads/" . basename($filename);

                                                            $fileNew = cropImage($filename,
                                                                $_SERVER['DOCUMENT_ROOT'] . $fileNew,
                                                                972, 436);
                                                            ?>
                                                            <img
                                                                src="<?php echo $fileNew; ?>"
                                                                alt="" data-ww="972px" data-hh="436px" width="972"
                                                                height="436" data-no-retina></div>
                                                        <div class="tp-caption Fashion-BigDisplay   tp-resizeme"
                                                             id="slide-100-layer-5" data-x="200" data-y="350"
                                                             data-width="['auto']" data-height="['auto']"
                                                             data-type="text" data-responsive_offset="on"
                                                             data-frames='[{"from":"y:50px;opacity:0;","speed":1000,"to":"o:1;","delay":2000,"ease":"Power4.easeOut"},{"delay":4000,"speed":1000,"to":"y:-50px;opacity:0;","ease":"Power4.easeIn"}]'
                                                             data-textAlign="['left','left','left','left']"
                                                             data-paddingtop="[0,0,0,0]" data-paddingright="[0,0,0,0]"
                                                             data-paddingbottom="[0,0,0,0]" data-paddingleft="[0,0,0,0]"
                                                             style="z-index: 9; white-space: nowrap; font-size: 120px; line-height: 120px; font-weight: 400; color: rgba(255,255,255,1);font-family:Oswald;text-transform:uppercase;text-decoration:none;z-index:10;letter-spacing:normal;line-height:120px;text-shadow:5px 5px rgba(178, 125, 39, 1);">
                                                            <?php echo $arProject["post_title"];?>
                                                        </div>
                                                        <div class="tp-caption Fashion-BigDisplay   tp-resizeme"
                                                             id="slide-100-layer-6" data-x="210" data-y="640"
                                                             data-width="['auto']" data-height="['auto']"
                                                             data-type="text" data-responsive_offset="on"
                                                             data-frames='[{"from":"y:50px;opacity:0;","speed":1000,"to":"o:1;","delay":2400,"ease":"Power4.easeOut"},{"delay":3600,"speed":1000,"to":"y:-50px;opacity:0;","ease":"Power4.easeIn"}]'
                                                             data-textAlign="['left','left','left','left']"
                                                             data-paddingtop="[0,0,0,0]" data-paddingright="[0,0,0,0]"
                                                             data-paddingbottom="[0,0,0,0]" data-paddingleft="[0,0,0,0]"
                                                             style="z-index: 10; white-space: nowrap; font-size: 20px; line-height: 30px; font-weight: 300; color: rgba(255,255,255,1);font-family:Open Sans;text-transform:capitalize !important;text-decoration:none;z-index:10;letter-spacing:normal !important;">
                                                            <?php echo $arProject["post_content_formatted"];?>
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
                                                    <li data-index="rs-101" data-transition="random-premium"
                                                        data-slotamount="1" data-hideafterloop="0"
                                                        data-hideslideonmobile="off" data-easein="default"
                                                        data-easeout="default" data-masterspeed="500"
                                                        data-thumb="<?php echo $fileNew; ?>"
                                                        data-delay="6000" data-rotate="0" data-saveperformance="off"
                                                        class="no-transition" data-title="БЛОК 1" data-param1=""
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
                                                            src="<?php echo $fileNew; ?>"
                                                            alt="" title="intro-travel2-01-img-01" width="1920"
                                                            height="1080" data-bgposition="center bottom"
                                                            data-bgfit="cover" data-bgrepeat="no-repeat"
                                                            class="rev-slidebg" data-no-retina>
                                                        <div class="tp-caption   tp-resizeme" id="slide-101-layer-1"
                                                             data-x="center" data-hoffset="" data-y="center"
                                                             data-voffset="" data-width="['none','none','none','none']"
                                                             data-height="['none','none','none','none']"
                                                             data-type="image" data-responsive_offset="on"
                                                             data-frames='[{"from":"y:50px;opacity:0;","speed":1,"to":"o:1;","delay":1,"ease":"Power4.easeOut"},{"delay":"wait","speed":1,"to":"y:50px;opacity:0;","ease":"Power4.easeIn"}]'
                                                             data-textAlign="['left','left','left','left']"
                                                             data-paddingtop="[0,0,0,0]" data-paddingright="[0,0,0,0]"
                                                             data-paddingbottom="[0,0,0,0]" data-paddingleft="[0,0,0,0]"
                                                             style="z-index: 11;text-transform:left;z-index:100;">

                                                            <img
                                                                src="http://wpdemos.themezaa.com/h-code/wp-content/uploads/revslider/fashion_intro/white-up.png"
                                                                alt="" data-ww="auto" data-hh="auto" width="5760"
                                                                height="3240" data-no-retina></div>
                                                        <div class="tp-caption   tp-resizeme" id="slide-101-layer-2"
                                                             data-x="-20" data-y="bottom" data-voffset="-15"
                                                             data-width="['none','none','none','none']"
                                                             data-height="['none','none','none','none']"
                                                             data-type="image" data-responsive_offset="on"
                                                             data-frames='[{"from":"y:50px;opacity:0;","speed":1000,"to":"o:1;","delay":1500,"ease":"Power4.easeOut"},{"delay":2500,"speed":1000,"to":"y:-50px;opacity:0;","ease":"Power4.easeIn"}]'
                                                             data-textAlign="['left','left','left','left']"
                                                             data-paddingtop="[0,0,0,0]" data-paddingright="[0,0,0,0]"
                                                             data-paddingbottom="[0,0,0,0]" data-paddingleft="[0,0,0,0]"
                                                             style="z-index: 12;text-transform:left;">
                                                            <?php
                                                            $filename = getRandomElement($arProjectImages);
                                                            $new_filen = $_SERVER["DOCUMENT_ROOT"].'/wp-content/uploads/' . basename($filename);


                                                            $fileNew = "/wp-content/uploads/" . basename($filename);

                                                            $fileNew = cropImage($filename,
                                                                $_SERVER['DOCUMENT_ROOT'] . $fileNew,
                                                                2000, 575);
                                                            ?>
                                                            <img
                                                                src="<?php echo $fileNew; ?>"
                                                                alt="" data-ww="2000px" data-hh="575px" width="2000"
                                                                height="575" data-no-retina></div>
                                                        <div class="tp-caption Fashion-BigDisplay   tp-resizeme"
                                                             id="slide-101-layer-3" data-x="100" data-y="700"
                                                             data-width="['auto']" data-height="['auto']"
                                                             data-type="text" data-responsive_offset="on"
                                                             data-frames='[{"from":"y:50px;opacity:0;","speed":1000,"to":"o:1;","delay":2500,"ease":"Power4.easeOut"},{"delay":1500,"speed":1000,"to":"y:-50px;opacity:0;","ease":"Power4.easeIn"}]'
                                                             data-textAlign="['left','left','left','left']"
                                                             data-paddingtop="[0,0,0,0]" data-paddingright="[0,0,0,0]"
                                                             data-paddingbottom="[0,0,0,0]" data-paddingleft="[0,0,0,0]"
                                                             style="z-index: 13; white-space: nowrap; font-size: 110px; line-height: 120px; font-weight: 400;font-family:Oswald;text-transform:uppercase;text-decoration:none;z-index:10;letter-spacing:normal;">
                                                            <?php echo implode("  ", $arPostTagsNames); ?>
                                                        </div>
                                                        <div class="tp-caption Fashion-BigDisplay   tp-resizeme"
                                                             id="slide-101-layer-4" data-x="100" data-y="800"
                                                             data-width="['auto']" data-height="['auto']"
                                                             data-type="text" data-responsive_offset="on"
                                                             data-frames='[{"from":"y:50px;opacity:0;","speed":1000,"to":"o:1;","delay":2800,"ease":"Power4.easeOut"},{"delay":1200,"speed":1000,"to":"y:-50px;opacity:0;","ease":"Power4.easeIn"}]'
                                                             data-textAlign="['left','left','left','left']"
                                                             data-paddingtop="[0,0,0,0]" data-paddingright="[0,0,0,0]"
                                                             data-paddingbottom="[0,0,0,0]" data-paddingleft="[0,0,0,0]"
                                                             style="z-index: 14; white-space: nowrap; font-size: 70px; line-height: 120px; font-weight: 400;font-family:Oswald;text-transform:uppercase;text-decoration:none;z-index:10;letter-spacing:normal;">
                                                            <?php echo $ProjectCLIENT; ?>
                                                        </div>
                                                    </li>

                                                    <li data-index="rs-102" data-transition="random-premium"
                                                        data-slotamount="1" data-hideafterloop="0"
                                                        data-hideslideonmobile="off" data-easein="default"
                                                        data-easeout="default" data-masterspeed="500"
                                                        data-thumb="http://wpdemos.themezaa.com/h-code/wp-content/uploads/revslider/fashion_intro/dummy-100x50.png"
                                                        data-delay="13000" data-rotate="0" data-saveperformance="off"
                                                        class="no-transition" data-title="БЛОК 2"
                                                        data-param1="" data-param2="" data-param3="" data-param4=""
                                                        data-param5="" data-param6="" data-param7="" data-param8=""
                                                        data-param9="" data-param10="" data-description="">
                                                        
                                                        <img
                                                            src="http://wpdemos.themezaa.com/h-code/wp-content/uploads/revslider/fashion_intro/dummy.png"
                                                            alt="" title="dummy.png" width="10" height="10"
                                                            data-bgposition="center bottom" data-bgfit="cover"
                                                            data-bgrepeat="no-repeat" class="rev-slidebg"
                                                            data-no-retina>
                                                        <div class="tp-caption   tp-resizeme" id="slide-102-layer-1"
                                                             data-x="center" data-hoffset="" data-y="center"
                                                             data-voffset="" data-width="['none','none','none','none']"
                                                             data-height="['none','none','none','none']"
                                                             data-type="image" data-responsive_offset="on"
                                                             data-frames='[{"from":"y:50px;opacity:0;","speed":1,"to":"o:1;","delay":1,"ease":"Power4.easeOut"},{"delay":"wait","speed":1,"to":"y:50px;opacity:0;","ease":"Power4.easeIn"}]'
                                                             data-textAlign="['left','left','left','left']"
                                                             data-paddingtop="[0,0,0,0]" data-paddingright="[0,0,0,0]"
                                                             data-paddingbottom="[0,0,0,0]" data-paddingleft="[0,0,0,0]"
                                                             style="z-index: 15;text-transform:left;z-index:100;">

                                                            <img
                                                                src="http://wpdemos.themezaa.com/h-code/wp-content/uploads/revslider/fashion_intro/white-up.png"
                                                                alt="" data-ww="5760px" data-hh="3240px" width="5760"
                                                                height="3240" data-no-retina></div>
                                                        <div class="tp-caption   tp-resizeme" id="slide-102-layer-8"
                                                             data-x="center" data-hoffset="" data-y="center"
                                                             data-voffset="" data-width="['none','none','none','none']"
                                                             data-height="['none','none','none','none']"
                                                             data-type="image" data-responsive_offset="on"
                                                             data-frames='[{"from":"opacity:0;","speed":600,"to":"o:1;","delay":"1300","ease":"Power2.easeInOut"},{"delay":10800,"speed":300,"to":"opacity:0;","ease":"nothing"}]'
                                                             data-textAlign="['left','left','left','left']"
                                                             data-paddingtop="[0,0,0,0]" data-paddingright="[0,0,0,0]"
                                                             data-paddingbottom="[0,0,0,0]" data-paddingleft="[0,0,0,0]"
                                                             style="z-index: 16;text-transform:left;z-index:5;">
                                                            <?php
                                                            $filename = getRandomElement($arProjectImages);
                                                            $new_filen = $_SERVER["DOCUMENT_ROOT"].'/wp-content/uploads/' . basename($filename);


                                                            $fileNew = "/wp-content/uploads/" . basename($filename);

                                                            $fileNew = cropImage($filename,
                                                                $_SERVER['DOCUMENT_ROOT'] . $fileNew,
                                                                2000, 1200);
                                                            ?>
                                                            <img
                                                                src="<?php echo $fileNew; ?>"
                                                                alt="" data-ww="2000px" data-hh="1200px" width="2000"
                                                                height="1200" data-no-retina></div>
                                                        <div class="tp-caption   tp-resizeme" id="slide-102-layer-3"
                                                             data-x="center" data-hoffset="" data-y="center"
                                                             data-voffset="" data-width="['none','none','none','none']"
                                                             data-height="['none','none','none','none']"
                                                             data-type="image" data-responsive_offset="on"
                                                             data-frames='[{"from":"y:top;","speed":600,"to":"o:1;","delay":2000,"ease":"Power4.easeOut"},{"delay":10100,"speed":300,"to":"y:bottom;","ease":"Power4.easeIn"}]'
                                                             data-textAlign="['left','left','left','left']"
                                                             data-paddingtop="[0,0,0,0]" data-paddingright="[0,0,0,0]"
                                                             data-paddingbottom="[0,0,0,0]" data-paddingleft="[0,0,0,0]"
                                                             style="z-index: 17;text-transform:left;z-index:1;">
                                                            <?php
                                                            $filename = getRandomElement($arProjectImages);
                                                            $new_filen = $_SERVER["DOCUMENT_ROOT"].'/wp-content/uploads/' . basename($filename);


                                                            $fileNew = "/wp-content/uploads/" . basename($filename);

                                                            $fileNew = cropImage($filename,
                                                                $_SERVER['DOCUMENT_ROOT'] . $fileNew,
                                                                2200, 1200);
                                                            ?>
                                                            <img
                                                                src="<?php echo $fileNew; ?>"
                                                                alt="" data-ww="2200px" data-hh="1200px" width="2200"
                                                                height="1200" data-no-retina></div>
                                                        <div class="tp-caption   tp-resizeme" id="slide-102-layer-4"
                                                             data-x="center" data-hoffset="" data-y="-100"
                                                             data-width="['none','none','none','none']"
                                                             data-height="['none','none','none','none']"
                                                             data-type="image" data-responsive_offset="on"
                                                             data-frames='[{"from":"x:right;","speed":600,"to":"o:1;","delay":6000,"ease":"Power4.easeOut"},{"delay":6100,"speed":300,"to":"x:left;","ease":"Power4.easeIn"}]'
                                                             data-textAlign="['left','left','left','left']"
                                                             data-paddingtop="[0,0,0,0]" data-paddingright="[0,0,0,0]"
                                                             data-paddingbottom="[0,0,0,0]" data-paddingleft="[0,0,0,0]"
                                                             style="z-index: 18;text-transform:left;z-index:2;">
                                                            <?php
                                                            $filename = getRandomElement($arProjectImages);
                                                            $new_filen = $_SERVER["DOCUMENT_ROOT"].'/wp-content/uploads/' . basename($filename);


                                                            $fileNew = "/wp-content/uploads/" . basename($filename);

                                                            $fileNew = cropImage($filename,
                                                                $_SERVER['DOCUMENT_ROOT'] . $fileNew,
                                                                2200, 1200);
                                                            ?>
                                                            <img
                                                                src="<?php echo $fileNew; ?>"
                                                                alt="" data-ww="2200px" data-hh="1200px" width="2200"
                                                                height="1200" data-no-retina></div>
                                                        <div class="tp-caption   tp-resizeme" id="slide-102-layer-5"
                                                             data-x="center" data-hoffset="" data-y="center"
                                                             data-voffset="" data-width="['none','none','none','none']"
                                                             data-height="['none','none','none','none']"
                                                             data-type="image" data-responsive_offset="on"
                                                             data-frames='[{"from":"y:bottom;","speed":600,"to":"o:1;","delay":10000,"ease":"Power4.easeOut"},{"delay":2100,"speed":300,"to":"y:top;","ease":"Power4.easeIn"}]'
                                                             data-textAlign="['left','left','left','left']"
                                                             data-paddingtop="[0,0,0,0]" data-paddingright="[0,0,0,0]"
                                                             data-paddingbottom="[0,0,0,0]" data-paddingleft="[0,0,0,0]"
                                                             style="z-index: 19;text-transform:uppercase;z-index:3;">
                                                            <?php
                                                            $filename = getRandomElement($arProjectImages);
                                                            $new_filen = $_SERVER["DOCUMENT_ROOT"].'/wp-content/uploads/' . basename($filename);


                                                            $fileNew = "/wp-content/uploads/" . basename($filename);

                                                            $fileNew = cropImage($filename,
                                                                $_SERVER['DOCUMENT_ROOT'] . $fileNew,
                                                                2200, 1200);
                                                            ?>
                                                            <img
                                                                src="<?php echo $fileNew; ?>"
                                                                alt="" data-ww="2200px" data-hh="1200px" width="2200"
                                                                height="1200" data-no-retina></div>
                                                        <div class="tp-caption   tp-resizeme" id="slide-102-layer-6"
                                                             data-x="351" data-y="299"
                                                             data-width="['none','none','none','none']"
                                                             data-height="['none','none','none','none']"
                                                             data-type="image" data-responsive_offset="on"
                                                             data-frames='[{"from":"x:-50px;opacity:0;","speed":600,"to":"o:1;","delay":2500,"ease":"Power4.easeOut"},{"delay":9600,"speed":300,"to":"x:-50px;opacity:0;","ease":"Power4.easeIn"}]'
                                                             data-textAlign="['left','left','left','left']"
                                                             data-paddingtop="[0,0,0,0]" data-paddingright="[0,0,0,0]"
                                                             data-paddingbottom="[0,0,0,0]" data-paddingleft="[0,0,0,0]"
                                                             style="z-index: 20;text-transform:left;">
                                                            <?php
                                                            $filename = getRandomElement($arProjectImages);
                                                            $new_filen = $_SERVER["DOCUMENT_ROOT"].'/wp-content/uploads/' . basename($filename);


                                                            $fileNew = "/wp-content/uploads/" . basename($filename);

                                                            $fileNew = cropImage($filename,
                                                                $_SERVER['DOCUMENT_ROOT'] . $fileNew,
                                                                371, 544);
                                                            ?>
                                                            <img
                                                                src="<?php echo $fileNew; ?>"
                                                                alt="" data-ww="371px" data-hh="544px" width="371"
                                                                height="544" data-no-retina></div>
                                                        <div class="tp-caption   tp-resizeme" id="slide-102-layer-7"
                                                             data-x="1200" data-y="300"
                                                             data-width="['none','none','none','none']"
                                                             data-height="['none','none','none','none']"
                                                             data-type="image" data-responsive_offset="on"
                                                             data-frames='[{"from":"x:50px;opacity:0;","speed":600,"to":"o:1;","delay":3500,"ease":"Power4.easeOut"},{"delay":8600,"speed":300,"to":"x:50px;opacity:0;","ease":"Power4.easeIn"}]'
                                                             data-textAlign="['left','left','left','left']"
                                                             data-paddingtop="[0,0,0,0]" data-paddingright="[0,0,0,0]"
                                                             data-paddingbottom="[0,0,0,0]" data-paddingleft="[0,0,0,0]"
                                                             style="z-index: 21;text-transform:left;z-index:10;">
                                                            <?php
                                                            $filename = getRandomElement($arProjectImages);
                                                            $new_filen = $_SERVER["DOCUMENT_ROOT"].'/wp-content/uploads/' . basename($filename);


                                                            $fileNew = "/wp-content/uploads/" . basename($filename);

                                                            $fileNew = cropImage($filename,
                                                                $_SERVER['DOCUMENT_ROOT'] . $fileNew,
                                                                371, 544);
                                                            ?>
                                                            <img
                                                                src="<?php echo $fileNew; ?>"
                                                                alt="" data-ww="371px" data-hh="544px" width="371"
                                                                height="544" data-no-retina></div>
                                                        <div class="tp-caption   tp-resizeme" id="slide-102-layer-9"
                                                             data-x="center" data-hoffset="" data-y="300"
                                                             data-width="['none','none','none','none']"
                                                             data-height="['none','none','none','none']"
                                                             data-type="image" data-responsive_offset="on"
                                                             data-frames='[{"from":"opacity:0;","speed":300,"to":"o:1;","delay":3000,"ease":"Power2.easeInOut"},{"delay":9400,"speed":300,"to":"opacity:0;","ease":"nothing"}]'
                                                             data-textAlign="['left','left','left','left']"
                                                             data-paddingtop="[0,0,0,0]" data-paddingright="[0,0,0,0]"
                                                             data-paddingbottom="[0,0,0,0]" data-paddingleft="[0,0,0,0]"
                                                             style="z-index: 22;text-transform:left;">
                                                            <?php
                                                            $filename = getRandomElement($arProjectImages);
                                                            $new_filen = $_SERVER["DOCUMENT_ROOT"].'/wp-content/uploads/' . basename($filename);


                                                            $fileNew = "/wp-content/uploads/" . basename($filename);

                                                            $fileNew = cropImage($filename,
                                                                $_SERVER['DOCUMENT_ROOT'] . $fileNew,
                                                                371, 544);
                                                            ?>
                                                            <img
                                                                src="<?php echo $fileNew; ?>"
                                                                alt="" data-ww="371px" data-hh="544px" width="371"
                                                                height="544" data-no-retina></div>
                                                    </li>
                                                    <?php
                                                    $filename = getRandomElement($arProjectImages);
                                                    $new_filen = $_SERVER["DOCUMENT_ROOT"].'/wp-content/uploads/' . basename($filename);


                                                    $fileNew = "/wp-content/uploads/" . basename($filename);

                                                    $fileNew = cropImage($filename,
                                                        $_SERVER['DOCUMENT_ROOT'] . $fileNew,
                                                        100, 50);
                                                    ?>
                                                    <li data-index="rs-103" data-transition="random-premium"
                                                        data-slotamount="1" data-hideafterloop="0"
                                                        data-hideslideonmobile="off" data-easein="default"
                                                        data-easeout="default" data-masterspeed="500"
                                                        data-thumb="<?php echo $fileNew; ?>"
                                                        data-delay="11000" data-rotate="0" data-saveperformance="off"
                                                        class="no-transition" data-title="БЛОК 3" data-param1=""
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
                                                            src="<?php echo $fileNew; ?>"
                                                            alt="" title="intro-travel2-03-img-03" width="1920"
                                                            height="1080" data-bgposition="center bottom"
                                                            data-bgfit="cover" data-bgrepeat="no-repeat"
                                                            class="rev-slidebg" data-no-retina>
                                                        <div class="tp-caption   tp-resizeme" id="slide-103-layer-1"
                                                             data-x="center" data-hoffset="" data-y="center"
                                                             data-voffset="" data-width="['none','none','none','none']"
                                                             data-height="['none','none','none','none']"
                                                             data-type="image" data-responsive_offset="on"
                                                             data-frames='[{"from":"y:50px;opacity:0;","speed":1,"to":"o:1;","delay":1,"ease":"Power4.easeOut"},{"delay":"wait","speed":1,"to":"y:50px;opacity:0;","ease":"Power4.easeIn"}]'
                                                             data-textAlign="['left','left','left','left']"
                                                             data-paddingtop="[0,0,0,0]" data-paddingright="[0,0,0,0]"
                                                             data-paddingbottom="[0,0,0,0]" data-paddingleft="[0,0,0,0]"
                                                             style="z-index: 23;text-transform:left;z-index:100;">

                                                            <img
                                                                src="http://wpdemos.themezaa.com/h-code/wp-content/uploads/revslider/fashion_intro/white-up.png"
                                                                alt="" data-ww="5760px" data-hh="3240px" width="5760"
                                                                height="3240" data-no-retina></div>
                                                        <div class="tp-caption   tp-resizeme" id="slide-103-layer-2"
                                                             data-x="-20" data-y="-100"
                                                             data-width="['none','none','none','none']"
                                                             data-height="['none','none','none','none']"
                                                             data-type="image" data-responsive_offset="on"
                                                             data-frames='[{"from":"x:-50px;opacity:0;","speed":600,"to":"o:1;","delay":2000,"ease":"Power4.easeOut"},{"delay":8100,"speed":300,"to":"x:50px;opacity:0;","ease":"Power4.easeIn"}]'
                                                             data-textAlign="['left','left','left','left']"
                                                             data-paddingtop="[0,0,0,0]" data-paddingright="[0,0,0,0]"
                                                             data-paddingbottom="[0,0,0,0]" data-paddingleft="[0,0,0,0]"
                                                             style="z-index: 24;text-transform:left;z-index:3;">
                                                            <?php
                                                            $filename = getRandomElement($arProjectImages);
                                                            $new_filen = $_SERVER["DOCUMENT_ROOT"].'/wp-content/uploads/' . basename($filename);


                                                            $fileNew = "/wp-content/uploads/" . basename($filename);

                                                            $fileNew = cropImage($filename,
                                                                $_SERVER['DOCUMENT_ROOT'] . $fileNew,
                                                                2000, 1200);
                                                            ?>
                                                            <img
                                                                src="<?php echo $fileNew; ?>"
                                                                alt="" data-ww="2000px" data-hh="1200px" width="2000"
                                                                height="1200" data-no-retina></div>
                                                        <div class="tp-caption   tp-resizeme" id="slide-103-layer-3"
                                                             data-x="-20" data-y="-100"
                                                             data-width="['none','none','none','none']"
                                                             data-height="['none','none','none','none']"
                                                             data-type="image" data-responsive_offset="on"
                                                             data-frames='[{"from":"x:50px;opacity:0;","speed":600,"to":"o:1;","delay":2000,"ease":"Power4.easeOut"},{"delay":8100,"speed":300,"to":"x:-50px;opacity:0;","ease":"Power4.easeIn"}]'
                                                             data-textAlign="['left','left','left','left']"
                                                             data-paddingtop="[0,0,0,0]" data-paddingright="[0,0,0,0]"
                                                             data-paddingbottom="[0,0,0,0]" data-paddingleft="[0,0,0,0]"
                                                             style="z-index: 25;text-transform:left;z-index:2;">
                                                            <?php
                                                            $filename = getRandomElement($arProjectImages);
                                                            $new_filen = $_SERVER["DOCUMENT_ROOT"].'/wp-content/uploads/' . basename($filename);


                                                            $fileNew = "/wp-content/uploads/" . basename($filename);

                                                            $fileNew = cropImage($filename,
                                                                $_SERVER['DOCUMENT_ROOT'] . $fileNew,
                                                                1920, 1080);
                                                            ?>
                                                            <img
                                                                src="<?php echo $fileNew; ?>"
                                                                alt="" data-ww="1920px" data-hh="1080px" width="1920"
                                                                height="1080" data-no-retina></div>
                                                        <div class="tp-caption   tp-resizeme" id="slide-103-layer-4"
                                                             data-x="1260" data-y="40"
                                                             data-width="['none','none','none','none']"
                                                             data-height="['none','none','none','none']"
                                                             data-type="image" data-responsive_offset="on"
                                                             data-frames='[{"from":"x:-50px;opacity:0;","speed":600,"to":"o:1;","delay":2000,"ease":"Power4.easeOut"},{"delay":8100,"speed":300,"to":"x:50px;opacity:0;","ease":"Power4.easeIn"}]'
                                                             data-textAlign="['left','left','left','left']"
                                                             data-paddingtop="[0,0,0,0]" data-paddingright="[0,0,0,0]"
                                                             data-paddingbottom="[0,0,0,0]" data-paddingleft="[0,0,0,0]"
                                                             style="z-index: 26;text-transform:left;z-index:4;">
                                                            <?php
                                                            $filename = getRandomElement($arProjectImages);
                                                            $new_filen = $_SERVER["DOCUMENT_ROOT"].'/wp-content/uploads/' . basename($filename);


                                                            $fileNew = "/wp-content/uploads/" . basename($filename);

                                                            $fileNew = cropImage($filename,
                                                                $_SERVER['DOCUMENT_ROOT'] . $fileNew,
                                                                512, 977);
                                                            ?>
                                                            <img
                                                                src="<?php echo $fileNew; ?>"
                                                                alt="" data-ww="512px" data-hh="977px" width="512"
                                                                height="977" data-no-retina></div>
                                                    </li>
                                                    <?php
                                                    $filename = getRandomElement($arProjectImages);
                                                    $new_filen = $_SERVER["DOCUMENT_ROOT"].'/wp-content/uploads/' . basename($filename);


                                                    $fileNew = "/wp-content/uploads/" . basename($filename);

                                                    $fileNew = cropImage($filename,
                                                        $_SERVER['DOCUMENT_ROOT'] . $fileNew,
                                                        100, 50);
                                                    ?>
                                                    <li data-index="rs-104" data-transition="random-premium"
                                                        data-slotamount="1" data-hideafterloop="0"
                                                        data-hideslideonmobile="off" data-easein="default"
                                                        data-easeout="default" data-masterspeed="500"
                                                        data-thumb="<?php echo $fileNew; ?>"
                                                        data-delay="10000" data-rotate="0" data-saveperformance="off"
                                                        class="no-transition" data-title="БЛОК 4" data-param1=""
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
                                                            src="<?php echo $fileNew; ?>"
                                                            alt="" title="intro-travel2-04-img-bg" width="1920"
                                                            height="1080" data-bgposition="center bottom"
                                                            data-bgfit="cover" data-bgrepeat="no-repeat"
                                                            class="rev-slidebg" data-no-retina>
                                                        <div class="tp-caption   tp-resizeme" id="slide-104-layer-2"
                                                             data-x="60" data-y="bottom" data-voffset="70"
                                                             data-width="['none','none','none','none']"
                                                             data-height="['none','none','none','none']"
                                                             data-type="image" data-responsive_offset="on"
                                                             data-frames='[{"from":"y:50px;opacity:0;","speed":600,"to":"o:1;","delay":1400,"ease":"Power4.easeOut"},{"delay":7700,"speed":300,"to":"y:50px;opacity:0;","ease":"Power4.easeIn"}]'
                                                             data-textAlign="['left','left','left','left']"
                                                             data-paddingtop="[0,0,0,0]" data-paddingright="[0,0,0,0]"
                                                             data-paddingbottom="[0,0,0,0]" data-paddingleft="[0,0,0,0]"
                                                             style="z-index: 27;text-transform:left;z-index:1;">
                                                            <?php
                                                            $filename = getRandomElement($arProjectImages);
                                                            $new_filen = $_SERVER["DOCUMENT_ROOT"].'/wp-content/uploads/' . basename($filename);


                                                            $fileNew = "/wp-content/uploads/" . basename($filename);

                                                            $fileNew = cropImage($filename,
                                                                $_SERVER['DOCUMENT_ROOT'] . $fileNew,
                                                                1846, 321);
                                                            ?>
                                                            <img
                                                                src="<?php echo $fileNew; ?>"
                                                                alt="" data-ww="1846px" data-hh="321px" width="1846"
                                                                height="321" data-no-retina></div>
                                                        <div class="tp-caption   tp-resizeme" id="slide-104-layer-3"
                                                             data-x="860" data-y="500"
                                                             data-width="['none','none','none','none']"
                                                             data-height="['none','none','none','none']"
                                                             data-type="image" data-responsive_offset="on"
                                                             data-frames='[{"from":"y:50px;opacity:0;","speed":600,"to":"o:1;","delay":1600,"ease":"Power4.easeOut"},{"delay":7500,"speed":300,"to":"y:50px;opacity:0;","ease":"Power4.easeIn"}]'
                                                             data-textAlign="['left','left','left','left']"
                                                             data-paddingtop="[0,0,0,0]" data-paddingright="[0,0,0,0]"
                                                             data-paddingbottom="[0,0,0,0]" data-paddingleft="[0,0,0,0]"
                                                             style="z-index: 28;text-transform:left;z-index:27;">
                                                            <?php
                                                            $filename = getRandomElement($arProjectImages);
                                                            $new_filen = $_SERVER["DOCUMENT_ROOT"].'/wp-content/uploads/' . basename($filename);


                                                            $fileNew = "/wp-content/uploads/" . basename($filename);

                                                            $fileNew = cropImage($filename,
                                                                $_SERVER['DOCUMENT_ROOT'] . $fileNew,
                                                                184, 235);
                                                            ?>
                                                            <img
                                                                src="<?php echo $fileNew; ?>"
                                                                alt="" data-ww="184px" data-hh="235px" width="184"
                                                                height="235" data-no-retina></div>
                                                        <div class="tp-caption   tp-resizeme" id="slide-104-layer-4"
                                                             data-x="1200" data-y="570"
                                                             data-width="['none','none','none','none']"
                                                             data-height="['none','none','none','none']"
                                                             data-type="image" data-responsive_offset="on"
                                                             data-frames='[{"from":"y:50px;opacity:0;","speed":600,"to":"o:1;","delay":1800,"ease":"Power4.easeOut"},{"delay":7300,"speed":300,"to":"y:50px;opacity:0;","ease":"Power4.easeIn"}]'
                                                             data-textAlign="['left','left','left','left']"
                                                             data-paddingtop="[0,0,0,0]" data-paddingright="[0,0,0,0]"
                                                             data-paddingbottom="[0,0,0,0]" data-paddingleft="[0,0,0,0]"
                                                             style="z-index: 29;text-transform:left;z-index:27;">
                                                            <?php
                                                            $filename = getRandomElement($arProjectImages);
                                                            $new_filen = $_SERVER["DOCUMENT_ROOT"].'/wp-content/uploads/' . basename($filename);


                                                            $fileNew = "/wp-content/uploads/" . basename($filename);

                                                            $fileNew = cropImage($filename,
                                                                $_SERVER['DOCUMENT_ROOT'] . $fileNew,
                                                                31, 102);
                                                            ?>
                                                            <img
                                                                src="<?php echo $fileNew; ?>"
                                                                alt="" data-ww="31px" data-hh="102px" width="31"
                                                                height="102" data-no-retina></div>
                                                        <div class="tp-caption   tp-resizeme" id="slide-104-layer-5"
                                                             data-x="1175" data-y="490"
                                                             data-width="['none','none','none','none']"
                                                             data-height="['none','none','none','none']"
                                                             data-type="image" data-responsive_offset="on"
                                                             data-frames='[{"from":"y:50px;opacity:0;","speed":600,"to":"o:1;","delay":2000,"ease":"Power4.easeOut"},{"delay":7100,"speed":300,"to":"y:50px;opacity:0;","ease":"Power4.easeIn"}]'
                                                             data-textAlign="['left','left','left','left']"
                                                             data-paddingtop="[0,0,0,0]" data-paddingright="[0,0,0,0]"
                                                             data-paddingbottom="[0,0,0,0]" data-paddingleft="[0,0,0,0]"
                                                             style="z-index: 30;text-transform:left;z-index:26;">
                                                            <?php
                                                            $filename = getRandomElement($arProjectImages);
                                                            $new_filen = $_SERVER["DOCUMENT_ROOT"].'/wp-content/uploads/' . basename($filename);


                                                            $fileNew = "/wp-content/uploads/" . basename($filename);

                                                            $fileNew = cropImage($filename,
                                                                $_SERVER['DOCUMENT_ROOT'] . $fileNew,
                                                                50, 172);
                                                            ?>
                                                            <img
                                                                src="<?php echo $fileNew; ?>"
                                                                alt="" data-ww="50px" data-hh="172px" width="50"
                                                                height="172" data-no-retina></div>
                                                        <div class="tp-caption   tp-resizeme" id="slide-104-layer-6"
                                                             data-x="390" data-y="504"
                                                             data-width="['none','none','none','none']"
                                                             data-height="['none','none','none','none']"
                                                             data-type="image" data-responsive_offset="on"
                                                             data-frames='[{"from":"y:50px;opacity:0;","speed":300,"to":"o:1;","delay":2000,"ease":"Power4.easeOut"},{"delay":7400,"speed":300,"to":"y:50px;opacity:0;","ease":"Power4.easeIn"}]'
                                                             data-textAlign="['left','left','left','left']"
                                                             data-paddingtop="[0,0,0,0]" data-paddingright="[0,0,0,0]"
                                                             data-paddingbottom="[0,0,0,0]" data-paddingleft="[0,0,0,0]"
                                                             style="z-index: 31;text-transform:left;z-index:26;">
                                                            <?php
                                                            $filename = getRandomElement($arProjectImages);
                                                            $new_filen = $_SERVER["DOCUMENT_ROOT"].'/wp-content/uploads/' . basename($filename);


                                                            $fileNew = "/wp-content/uploads/" . basename($filename);

                                                            $fileNew = cropImage($filename,
                                                                $_SERVER['DOCUMENT_ROOT'] . $fileNew,
                                                                170, 216);
                                                            ?>
                                                            <img
                                                                src="<?php echo $fileNew; ?>"
                                                                alt="" data-ww="170px" data-hh="216px" width="170"
                                                                height="216" data-no-retina></div>
                                                        <div class="tp-caption   tp-resizeme" id="slide-104-layer-7"
                                                             data-x="630" data-y="510"
                                                             data-width="['none','none','none','none']"
                                                             data-height="['none','none','none','none']"
                                                             data-type="image" data-responsive_offset="on"
                                                             data-frames='[{"from":"y:50px;opacity:0;","speed":600,"to":"o:1;","delay":2400,"ease":"Power4.easeOut"},{"delay":6700,"speed":300,"to":"y:50px;opacity:0;","ease":"Power4.easeIn"}]'
                                                             data-textAlign="['left','left','left','left']"
                                                             data-paddingtop="[0,0,0,0]" data-paddingright="[0,0,0,0]"
                                                             data-paddingbottom="[0,0,0,0]" data-paddingleft="[0,0,0,0]"
                                                             style="z-index: 32;text-transform:left;z-index:26;">
                                                            <?php
                                                            $filename = getRandomElement($arProjectImages);
                                                            $new_filen = $_SERVER["DOCUMENT_ROOT"].'/wp-content/uploads/' . basename($filename);


                                                            $fileNew = "/wp-content/uploads/" . basename($filename);

                                                            $fileNew = cropImage($filename,
                                                                $_SERVER['DOCUMENT_ROOT'] . $fileNew,
                                                                51, 172);
                                                            ?>
                                                            <img
                                                                src="<?php echo $fileNew; ?>"
                                                                alt="" data-ww="51px" data-hh="172px" width="51"
                                                                height="172" data-no-retina></div>
                                                        <div class="tp-caption   tp-resizeme" id="slide-104-layer-8"
                                                             data-x="1130" data-y="470"
                                                             data-width="['none','none','none','none']"
                                                             data-height="['none','none','none','none']"
                                                             data-type="image" data-responsive_offset="on"
                                                             data-frames='[{"from":"y:50px;opacity:0;","speed":600,"to":"o:1;","delay":2600,"ease":"Power4.easeOut"},{"delay":6500,"speed":300,"to":"y:50px;opacity:0;","ease":"Power4.easeIn"}]'
                                                             data-textAlign="['left','left','left','left']"
                                                             data-paddingtop="[0,0,0,0]" data-paddingright="[0,0,0,0]"
                                                             data-paddingbottom="[0,0,0,0]" data-paddingleft="[0,0,0,0]"
                                                             style="z-index: 33;text-transform:left;z-index:26;">
                                                            <?php
                                                            $filename = getRandomElement($arProjectImages);
                                                            $new_filen = $_SERVER["DOCUMENT_ROOT"].'/wp-content/uploads/' . basename($filename);


                                                            $fileNew = "/wp-content/uploads/" . basename($filename);

                                                            $fileNew = cropImage($filename,
                                                                $_SERVER['DOCUMENT_ROOT'] . $fileNew,
                                                                142, 182);
                                                            ?>
                                                            <img
                                                                src="<?php echo $fileNew; ?>"
                                                                alt="" data-ww="142px" data-hh="182px" width="142"
                                                                height="182" data-no-retina></div>
                                                        <div class="tp-caption   tp-resizeme" id="slide-104-layer-9"
                                                             data-x="540" data-y="560"
                                                             data-width="['none','none','none','none']"
                                                             data-height="['none','none','none','none']"
                                                             data-type="image" data-responsive_offset="on"
                                                             data-frames='[{"from":"y:50px;opacity:0;","speed":600,"to":"o:1;","delay":2800,"ease":"Power4.easeOut"},{"delay":6300,"speed":300,"to":"y:50px;opacity:0;","ease":"Power4.easeIn"}]'
                                                             data-textAlign="['left','left','left','left']"
                                                             data-paddingtop="[0,0,0,0]" data-paddingright="[0,0,0,0]"
                                                             data-paddingbottom="[0,0,0,0]" data-paddingleft="[0,0,0,0]"
                                                             style="z-index: 34;text-transform:left;z-index:25;">
                                                            <?php
                                                            $filename = getRandomElement($arProjectImages);
                                                            $new_filen = $_SERVER["DOCUMENT_ROOT"].'/wp-content/uploads/' . basename($filename);


                                                            $fileNew = "/wp-content/uploads/" . basename($filename);

                                                            $fileNew = cropImage($filename,
                                                                $_SERVER['DOCUMENT_ROOT'] . $fileNew,
                                                                30, 102);
                                                            ?>
                                                            <img
                                                                src="<?php echo $fileNew; ?>"
                                                                alt="" data-ww="30px" data-hh="102px" width="30"
                                                                height="102" data-no-retina></div>
                                                        <div class="tp-caption   tp-resizeme" id="slide-104-layer-10"
                                                             data-x="400" data-y="550"
                                                             data-width="['none','none','none','none']"
                                                             data-height="['none','none','none','none']"
                                                             data-type="image" data-responsive_offset="on"
                                                             data-frames='[{"from":"y:50px;opacity:0;","speed":600,"to":"o:1;","delay":3000,"ease":"Power4.easeOut"},{"delay":6100,"speed":300,"to":"y:50px;opacity:0;","ease":"Power4.easeIn"}]'
                                                             data-textAlign="['left','left','left','left']"
                                                             data-paddingtop="[0,0,0,0]" data-paddingright="[0,0,0,0]"
                                                             data-paddingbottom="[0,0,0,0]" data-paddingleft="[0,0,0,0]"
                                                             style="z-index: 35;text-transform:left;z-index:20;">
                                                            <?php
                                                            $filename = getRandomElement($arProjectImages);
                                                            $new_filen = $_SERVER["DOCUMENT_ROOT"].'/wp-content/uploads/' . basename($filename);


                                                            $fileNew = "/wp-content/uploads/" . basename($filename);

                                                            $fileNew = cropImage($filename,
                                                                $_SERVER['DOCUMENT_ROOT'] . $fileNew,
                                                                222, 84);
                                                            ?>
                                                            <img
                                                                src="<?php echo $fileNew; ?>"
                                                                alt="" data-ww="222px" data-hh="84px" width="222"
                                                                height="84" data-no-retina></div>
                                                        <div class="tp-caption   tp-resizeme" id="slide-104-layer-11"
                                                             data-x="550" data-y="500"
                                                             data-width="['none','none','none','none']"
                                                             data-height="['none','none','none','none']"
                                                             data-type="image" data-responsive_offset="on"
                                                             data-frames='[{"from":"y:50px;opacity:0;","speed":600,"to":"o:1;","delay":3200,"ease":"Power4.easeOut"},{"delay":5900,"speed":300,"to":"y:50px;opacity:0;","ease":"Power4.easeIn"}]'
                                                             data-textAlign="['left','left','left','left']"
                                                             data-paddingtop="[0,0,0,0]" data-paddingright="[0,0,0,0]"
                                                             data-paddingbottom="[0,0,0,0]" data-paddingleft="[0,0,0,0]"
                                                             style="z-index: 36;text-transform:left;z-index:21;">
                                                            <?php
                                                            $filename = getRandomElement($arProjectImages);
                                                            $new_filen = $_SERVER["DOCUMENT_ROOT"].'/wp-content/uploads/' . basename($filename);


                                                            $fileNew = "/wp-content/uploads/" . basename($filename);

                                                            $fileNew = cropImage($filename,
                                                                $_SERVER['DOCUMENT_ROOT'] . $fileNew,
                                                                237, 145);
                                                            ?>
                                                            <img
                                                                src="<?php echo $fileNew; ?>"
                                                                alt="" data-ww="237px" data-hh="145px" width="237"
                                                                height="145" data-no-retina></div>
                                                        <div class="tp-caption   tp-resizeme" id="slide-104-layer-12"
                                                             data-x="720" data-y="550"
                                                             data-width="['none','none','none','none']"
                                                             data-height="['none','none','none','none']"
                                                             data-type="image" data-responsive_offset="on"
                                                             data-frames='[{"from":"y:50px;opacity:0;","speed":600,"to":"o:1;","delay":3400,"ease":"Power4.easeOut"},{"delay":5700,"speed":300,"to":"y:50px;opacity:0;","ease":"Power4.easeIn"}]'
                                                             data-textAlign="['left','left','left','left']"
                                                             data-paddingtop="[0,0,0,0]" data-paddingright="[0,0,0,0]"
                                                             data-paddingbottom="[0,0,0,0]" data-paddingleft="[0,0,0,0]"
                                                             style="z-index: 37;text-transform:left;">
                                                            <?php
                                                            $filename = getRandomElement($arProjectImages);
                                                            $new_filen = $_SERVER["DOCUMENT_ROOT"].'/wp-content/uploads/' . basename($filename);


                                                            $fileNew = "/wp-content/uploads/" . basename($filename);

                                                            $fileNew = cropImage($filename,
                                                                $_SERVER['DOCUMENT_ROOT'] . $fileNew,
                                                                221, 83);
                                                            ?>
                                                            <img
                                                                src="<?php echo $fileNew; ?>"
                                                                alt="" data-ww="221px" data-hh="83px" width="221"
                                                                height="83" data-no-retina></div>
                                                        <div class="tp-caption   tp-resizeme" id="slide-104-layer-13"
                                                             data-x="820" data-y="550"
                                                             data-width="['none','none','none','none']"
                                                             data-height="['none','none','none','none']"
                                                             data-type="image" data-responsive_offset="on"
                                                             data-frames='[{"from":"y:50px;opacity:0;","speed":600,"to":"o:1;","delay":3600,"ease":"Power4.easeOut"},{"delay":5500,"speed":300,"to":"y:50px;opacity:0;","ease":"Power4.easeIn"}]'
                                                             data-textAlign="['left','left','left','left']"
                                                             data-paddingtop="[0,0,0,0]" data-paddingright="[0,0,0,0]"
                                                             data-paddingbottom="[0,0,0,0]" data-paddingleft="[0,0,0,0]"
                                                             style="z-index: 38;text-transform:left;z-index:20;">
                                                            <?php
                                                            $filename = getRandomElement($arProjectImages);
                                                            $new_filen = $_SERVER["DOCUMENT_ROOT"].'/wp-content/uploads/' . basename($filename);


                                                            $fileNew = "/wp-content/uploads/" . basename($filename);

                                                            $fileNew = cropImage($filename,
                                                                $_SERVER['DOCUMENT_ROOT'] . $fileNew,
                                                                130, 81);
                                                            ?>
                                                            <img
                                                                src="<?php echo $fileNew; ?>"
                                                                alt="" data-ww="130px" data-hh="81px" width="130"
                                                                height="81" data-no-retina></div>
                                                        <div class="tp-caption   tp-resizeme" id="slide-104-layer-14"
                                                             data-x="900" data-y="550"
                                                             data-width="['none','none','none','none']"
                                                             data-height="['none','none','none','none']"
                                                             data-type="image" data-responsive_offset="on"
                                                             data-frames='[{"from":"y:50px;opacity:0;","speed":600,"to":"o:1;","delay":3800,"ease":"Power4.easeOut"},{"delay":5300,"speed":300,"to":"y:50px;opacity:0;","ease":"Power4.easeIn"}]'
                                                             data-textAlign="['left','left','left','left']"
                                                             data-paddingtop="[0,0,0,0]" data-paddingright="[0,0,0,0]"
                                                             data-paddingbottom="[0,0,0,0]" data-paddingleft="[0,0,0,0]"
                                                             style="z-index: 39;text-transform:left;z-index:20;">
                                                            <?php
                                                            $filename = getRandomElement($arProjectImages);
                                                            $new_filen = $_SERVER["DOCUMENT_ROOT"].'/wp-content/uploads/' . basename($filename);


                                                            $fileNew = "/wp-content/uploads/" . basename($filename);

                                                            $fileNew = cropImage($filename,
                                                                $_SERVER['DOCUMENT_ROOT'] . $fileNew,
                                                                130, 81);
                                                            ?>
                                                            <img
                                                                src="<?php echo $fileNew; ?>"
                                                                alt="" data-ww="130px" data-hh="81px" width="130"
                                                                height="81" data-no-retina></div>
                                                        <div class="tp-caption   tp-resizeme" id="slide-104-layer-15"
                                                             data-x="1000" data-y="550"
                                                             data-width="['none','none','none','none']"
                                                             data-height="['none','none','none','none']"
                                                             data-type="image" data-responsive_offset="on"
                                                             data-frames='[{"from":"y:50px;opacity:0;","speed":600,"to":"o:1;","delay":4000,"ease":"Power4.easeOut"},{"delay":5100,"speed":300,"to":"y:50px;opacity:0;","ease":"Power4.easeIn"}]'
                                                             data-textAlign="['left','left','left','left']"
                                                             data-paddingtop="[0,0,0,0]" data-paddingright="[0,0,0,0]"
                                                             data-paddingbottom="[0,0,0,0]" data-paddingleft="[0,0,0,0]"
                                                             style="z-index: 40;text-transform:left;z-index:20;">
                                                            <?php
                                                            $filename = getRandomElement($arProjectImages);
                                                            $new_filen = $_SERVER["DOCUMENT_ROOT"].'/wp-content/uploads/' . basename($filename);


                                                            $fileNew = "/wp-content/uploads/" . basename($filename);

                                                            $fileNew = cropImage($filename,
                                                                $_SERVER['DOCUMENT_ROOT'] . $fileNew,
                                                                222, 83);
                                                            ?>
                                                            <img
                                                                src="<?php echo $fileNew; ?>"
                                                                alt="" data-ww="222px" data-hh="83px" width="222"
                                                                height="83" data-no-retina></div>
                                                        <div class="tp-caption   tp-resizeme" id="slide-104-layer-16"
                                                             data-x="1180" data-y="470"
                                                             data-width="['none','none','none','none']"
                                                             data-height="['none','none','none','none']"
                                                             data-type="image" data-responsive_offset="on"
                                                             data-frames='[{"from":"y:50px;opacity:0;","speed":600,"to":"o:1;","delay":4200,"ease":"Power4.easeOut"},{"delay":4900,"speed":300,"to":"y:50px;opacity:0;","ease":"Power4.easeIn"}]'
                                                             data-textAlign="['left','left','left','left']"
                                                             data-paddingtop="[0,0,0,0]" data-paddingright="[0,0,0,0]"
                                                             data-paddingbottom="[0,0,0,0]" data-paddingleft="[0,0,0,0]"
                                                             style="z-index: 41;text-transform:left;z-index:20;">
                                                            <?php
                                                            $filename = getRandomElement($arProjectImages);
                                                            $new_filen = $_SERVER["DOCUMENT_ROOT"].'/wp-content/uploads/' . basename($filename);


                                                            $fileNew = "/wp-content/uploads/" . basename($filename);

                                                            $fileNew = cropImage($filename,
                                                                $_SERVER['DOCUMENT_ROOT'] . $fileNew,
                                                                251, 166);
                                                            ?>
                                                            <img
                                                                src="<?php echo $fileNew; ?>"
                                                                alt="" data-ww="251px" data-hh="166px" width="251"
                                                                height="166" data-no-retina></div>
                                                        <div class="tp-caption   tp-resizeme" id="slide-104-layer-17"
                                                             data-x="680" data-y="510"
                                                             data-width="['none','none','none','none']"
                                                             data-height="['none','none','none','none']"
                                                             data-type="image" data-responsive_offset="on"
                                                             data-frames='[{"from":"y:50px;opacity:0;","speed":600,"to":"o:1;","delay":4400,"ease":"Power4.easeOut"},{"delay":4700,"speed":300,"to":"y:50px;opacity:0;","ease":"Power4.easeIn"}]'
                                                             data-textAlign="['left','left','left','left']"
                                                             data-paddingtop="[0,0,0,0]" data-paddingright="[0,0,0,0]"
                                                             data-paddingbottom="[0,0,0,0]" data-paddingleft="[0,0,0,0]"
                                                             style="z-index: 42;text-transform:left;z-index:22;">
                                                            <?php
                                                            $filename = getRandomElement($arProjectImages);
                                                            $new_filen = $_SERVER["DOCUMENT_ROOT"].'/wp-content/uploads/' . basename($filename);


                                                            $fileNew = "/wp-content/uploads/" . basename($filename);

                                                            $fileNew = cropImage($filename,
                                                                $_SERVER['DOCUMENT_ROOT'] . $fileNew,
                                                                123, 157);
                                                            ?>
                                                            <img
                                                                src="<?php echo $fileNew; ?>"
                                                                alt="" data-ww="123px" data-hh="157px" width="123"
                                                                height="157" data-no-retina></div>
                                                        <div class="tp-caption   tp-resizeme" id="slide-104-layer-18"
                                                             data-x="575" data-y="430"
                                                             data-width="['none','none','none','none']"
                                                             data-height="['none','none','none','none']"
                                                             data-type="image" data-responsive_offset="on"
                                                             data-frames='[{"from":"y:50px;opacity:0;","speed":600,"to":"o:1;","delay":4600,"ease":"Power4.easeOut"},{"delay":4500,"speed":300,"to":"y:50px;opacity:0;","ease":"Power4.easeIn"}]'
                                                             data-textAlign="['left','left','left','left']"
                                                             data-paddingtop="[0,0,0,0]" data-paddingright="[0,0,0,0]"
                                                             data-paddingbottom="[0,0,0,0]" data-paddingleft="[0,0,0,0]"
                                                             style="z-index: 43;text-transform:left;z-index:22;">
                                                            <?php
                                                            $filename = getRandomElement($arProjectImages);
                                                            $new_filen = $_SERVER["DOCUMENT_ROOT"].'/wp-content/uploads/' . basename($filename);


                                                            $fileNew = "/wp-content/uploads/" . basename($filename);

                                                            $fileNew = cropImage($filename,
                                                                $_SERVER['DOCUMENT_ROOT'] . $fileNew,
                                                                78, 218);
                                                            ?>
                                                            <img
                                                                src="<?php echo $fileNew; ?>"
                                                                alt="" data-ww="78px" data-hh="218px" width="78"
                                                                height="218" data-no-retina></div>
                                                        <div class="tp-caption   tp-resizeme" id="slide-104-layer-19"
                                                             data-x="1260" data-y="410"
                                                             data-width="['none','none','none','none']"
                                                             data-height="['none','none','none','none']"
                                                             data-type="image" data-responsive_offset="on"
                                                             data-frames='[{"from":"y:50px;opacity:0;","speed":600,"to":"o:1;","delay":4800,"ease":"Power4.easeOut"},{"delay":4300,"speed":300,"to":"y:50px;opacity:0;","ease":"Power4.easeIn"}]'
                                                             data-textAlign="['left','left','left','left']"
                                                             data-paddingtop="[0,0,0,0]" data-paddingright="[0,0,0,0]"
                                                             data-paddingbottom="[0,0,0,0]" data-paddingleft="[0,0,0,0]"
                                                             style="z-index: 44;text-transform:left;z-index:20;">
                                                            <?php
                                                            $filename = getRandomElement($arProjectImages);
                                                            $new_filen = $_SERVER["DOCUMENT_ROOT"].'/wp-content/uploads/' . basename($filename);


                                                            $fileNew = "/wp-content/uploads/" . basename($filename);

                                                            $fileNew = cropImage($filename,
                                                                $_SERVER['DOCUMENT_ROOT'] . $fileNew,
                                                                78, 218);
                                                            ?>
                                                            <img
                                                                src="<?php echo $fileNew; ?>"
                                                                alt="" data-ww="78px" data-hh="218px" width="78"
                                                                height="218" data-no-retina></div>
                                                        <div class="tp-caption   tp-resizeme" id="slide-104-layer-20"
                                                             data-x="800" data-y="480"
                                                             data-width="['none','none','none','none']"
                                                             data-height="['none','none','none','none']"
                                                             data-type="image" data-responsive_offset="on"
                                                             data-frames='[{"from":"y:50px;opacity:0;","speed":600,"to":"o:1;","delay":5000,"ease":"Power4.easeOut"},{"delay":4100,"speed":300,"to":"y:50px;opacity:0;","ease":"Power4.easeIn"}]'
                                                             data-textAlign="['left','left','left','left']"
                                                             data-paddingtop="[0,0,0,0]" data-paddingright="[0,0,0,0]"
                                                             data-paddingbottom="[0,0,0,0]" data-paddingleft="[0,0,0,0]"
                                                             style="z-index: 45;text-transform:left;z-index:20;">
                                                            <?php
                                                            $filename = getRandomElement($arProjectImages);
                                                            $new_filen = $_SERVER["DOCUMENT_ROOT"].'/wp-content/uploads/' . basename($filename);


                                                            $fileNew = "/wp-content/uploads/" . basename($filename);

                                                            $fileNew = cropImage($filename,
                                                                $_SERVER['DOCUMENT_ROOT'] . $fileNew,
                                                                58, 167);
                                                            ?>
                                                            <img
                                                                src="<?php echo $fileNew; ?>"
                                                                alt="" data-ww="58px" data-hh="167px" width="58"
                                                                height="167" data-no-retina></div>
                                                        <div class="tp-caption   tp-resizeme" id="slide-104-layer-21"
                                                             data-x="1100" data-y="500"
                                                             data-width="['none','none','none','none']"
                                                             data-height="['none','none','none','none']"
                                                             data-type="image" data-responsive_offset="on"
                                                             data-frames='[{"from":"y:50px;opacity:0;","speed":600,"to":"o:1;","delay":5200,"ease":"Power4.easeOut"},{"delay":3900,"speed":300,"to":"y:50px;opacity:0;","ease":"Power4.easeIn"}]'
                                                             data-textAlign="['left','left','left','left']"
                                                             data-paddingtop="[0,0,0,0]" data-paddingright="[0,0,0,0]"
                                                             data-paddingbottom="[0,0,0,0]" data-paddingleft="[0,0,0,0]"
                                                             style="z-index: 46;text-transform:left;z-index:20;">
                                                            <?php
                                                            $filename = getRandomElement($arProjectImages);
                                                            $new_filen = $_SERVER["DOCUMENT_ROOT"].'/wp-content/uploads/' . basename($filename);


                                                            $fileNew = "/wp-content/uploads/" . basename($filename);

                                                            $fileNew = cropImage($filename,
                                                                $_SERVER['DOCUMENT_ROOT'] . $fileNew,
                                                                48, 137);
                                                            ?>
                                                            <img
                                                                src="<?php echo $fileNew; ?>"
                                                                alt="" data-ww="48px" data-hh="137px" width="48"
                                                                height="137" data-no-retina></div>
                                                        <div class="tp-caption   tp-resizeme" id="slide-104-layer-22"
                                                             data-x="430" data-y="200"
                                                             data-width="['none','none','none','none']"
                                                             data-height="['none','none','none','none']"
                                                             data-type="image" data-responsive_offset="on"
                                                             data-frames='[{"from":"y:50px;opacity:0;","speed":600,"to":"o:1;","delay":5400,"ease":"Power4.easeOut"},{"delay":3700,"speed":300,"to":"y:50px;opacity:0;","ease":"Power4.easeIn"}]'
                                                             data-textAlign="['left','left','left','left']"
                                                             data-paddingtop="[0,0,0,0]" data-paddingright="[0,0,0,0]"
                                                             data-paddingbottom="[0,0,0,0]" data-paddingleft="[0,0,0,0]"
                                                             style="z-index: 47;text-transform:left;z-index:13;">
                                                            <?php
                                                            $filename = getRandomElement($arProjectImages);
                                                            $new_filen = $_SERVER["DOCUMENT_ROOT"].'/wp-content/uploads/' . basename($filename);


                                                            $fileNew = "/wp-content/uploads/" . basename($filename);

                                                            $fileNew = cropImage($filename,
                                                                $_SERVER['DOCUMENT_ROOT'] . $fileNew,
                                                                331, 413);
                                                            ?>
                                                            <img
                                                                src="<?php echo $fileNew; ?>"
                                                                alt="" data-ww="331px" data-hh="413px" width="331"
                                                                height="413" data-no-retina></div>
                                                        <div class="tp-caption   tp-resizeme" id="slide-104-layer-23"
                                                             data-x="1320" data-y="230"
                                                             data-width="['none','none','none','none']"
                                                             data-height="['none','none','none','none']"
                                                             data-type="image" data-responsive_offset="on"
                                                             data-frames='[{"from":"y:50px;opacity:0;","speed":600,"to":"o:1;","delay":5600,"ease":"Power4.easeOut"},{"delay":3500,"speed":300,"to":"y:50px;opacity:0;","ease":"Power4.easeIn"}]'
                                                             data-textAlign="['left','left','left','left']"
                                                             data-paddingtop="[0,0,0,0]" data-paddingright="[0,0,0,0]"
                                                             data-paddingbottom="[0,0,0,0]" data-paddingleft="[0,0,0,0]"
                                                             style="z-index: 48;text-transform:left;z-index:18;">
                                                            <?php
                                                            $filename = getRandomElement($arProjectImages);
                                                            $new_filen = $_SERVER["DOCUMENT_ROOT"].'/wp-content/uploads/' . basename($filename);


                                                            $fileNew = "/wp-content/uploads/" . basename($filename);

                                                            $fileNew = cropImage($filename,
                                                                $_SERVER['DOCUMENT_ROOT'] . $fileNew,
                                                                150, 325);
                                                            ?>
                                                            <img
                                                                src="<?php echo $fileNew; ?>"
                                                                alt="" data-ww="150px" data-hh="325px" width="150"
                                                                height="325" data-no-retina></div>
                                                        <div class="tp-caption   tp-resizeme" id="slide-104-layer-24"
                                                             data-x="800" data-y="180"
                                                             data-width="['none','none','none','none']"
                                                             data-height="['none','none','none','none']"
                                                             data-type="image" data-responsive_offset="on"
                                                             data-frames='[{"from":"y:50px;opacity:0;","speed":600,"to":"o:1;","delay":5800,"ease":"Power4.easeOut"},{"delay":3300,"speed":300,"to":"y:50px;opacity:0;","ease":"Power4.easeIn"}]'
                                                             data-textAlign="['left','left','left','left']"
                                                             data-paddingtop="[0,0,0,0]" data-paddingright="[0,0,0,0]"
                                                             data-paddingbottom="[0,0,0,0]" data-paddingleft="[0,0,0,0]"
                                                             style="z-index: 49;text-transform:left;z-index:10;">
                                                            <?php
                                                            $filename = getRandomElement($arProjectImages);
                                                            $new_filen = $_SERVER["DOCUMENT_ROOT"].'/wp-content/uploads/' . basename($filename);


                                                            $fileNew = "/wp-content/uploads/" . basename($filename);

                                                            $fileNew = cropImage($filename,
                                                                $_SERVER['DOCUMENT_ROOT'] . $fileNew,
                                                                171, 422);
                                                            ?>
                                                            <img
                                                                src="<?php echo $fileNew; ?>"
                                                                alt="" data-ww="171px" data-hh="422px" width="171"
                                                                height="422" data-no-retina></div>
                                                        <div class="tp-caption   tp-resizeme" id="slide-104-layer-25"
                                                             data-x="740" data-y="350"
                                                             data-width="['none','none','none','none']"
                                                             data-height="['none','none','none','none']"
                                                             data-type="image" data-responsive_offset="on"
                                                             data-frames='[{"from":"y:50px;opacity:0;","speed":600,"to":"o:1;","delay":6000,"ease":"Power4.easeOut"},{"delay":3100,"speed":300,"to":"y:50px;opacity:0;","ease":"Power4.easeIn"}]'
                                                             data-textAlign="['left','left','left','left']"
                                                             data-paddingtop="[0,0,0,0]" data-paddingright="[0,0,0,0]"
                                                             data-paddingbottom="[0,0,0,0]" data-paddingleft="[0,0,0,0]"
                                                             style="z-index: 50;text-transform:left;z-index:10;">
                                                            <?php
                                                            $filename = getRandomElement($arProjectImages);
                                                            $new_filen = $_SERVER["DOCUMENT_ROOT"].'/wp-content/uploads/' . basename($filename);


                                                            $fileNew = "/wp-content/uploads/" . basename($filename);

                                                            $fileNew = cropImage($filename,
                                                                $_SERVER['DOCUMENT_ROOT'] . $fileNew,
                                                                79, 246);
                                                            ?>
                                                            <img
                                                                src="<?php echo $fileNew; ?>"
                                                                alt="" data-ww="79px" data-hh="246px" width="79"
                                                                height="246" data-no-retina></div>
                                                        <div class="tp-caption   tp-resizeme" id="slide-104-layer-26"
                                                             data-x="950" data-y="350"
                                                             data-width="['none','none','none','none']"
                                                             data-height="['none','none','none','none']"
                                                             data-type="image" data-responsive_offset="on"
                                                             data-frames='[{"from":"y:50px;opacity:0;","speed":600,"to":"o:1;","delay":6200,"ease":"Power4.easeOut"},{"delay":2900,"speed":300,"to":"y:50px;opacity:0;","ease":"Power4.easeIn"}]'
                                                             data-textAlign="['left','left','left','left']"
                                                             data-paddingtop="[0,0,0,0]" data-paddingright="[0,0,0,0]"
                                                             data-paddingbottom="[0,0,0,0]" data-paddingleft="[0,0,0,0]"
                                                             style="z-index: 51;text-transform:left;z-index:9;">
                                                            <?php
                                                            $filename = getRandomElement($arProjectImages);
                                                            $new_filen = $_SERVER["DOCUMENT_ROOT"].'/wp-content/uploads/' . basename($filename);


                                                            $fileNew = "/wp-content/uploads/" . basename($filename);

                                                            $fileNew = cropImage($filename,
                                                                $_SERVER['DOCUMENT_ROOT'] . $fileNew,
                                                                109, 249);
                                                            ?>
                                                            <img
                                                                src="<?php echo $fileNew; ?>"
                                                                alt="" data-ww="109px" data-hh="249px" width="109"
                                                                height="249" data-no-retina></div>
                                                        <div class="tp-caption   tp-resizeme" id="slide-104-layer-27"
                                                             data-x="1050" data-y="380"
                                                             data-width="['none','none','none','none']"
                                                             data-height="['none','none','none','none']"
                                                             data-type="image" data-responsive_offset="on"
                                                             data-frames='[{"from":"y:50px;opacity:0;","speed":600,"to":"o:1;","delay":6400,"ease":"Power4.easeOut"},{"delay":2700,"speed":300,"to":"y:50px;opacity:0;","ease":"Power4.easeIn"}]'
                                                             data-textAlign="['left','left','left','left']"
                                                             data-paddingtop="[0,0,0,0]" data-paddingright="[0,0,0,0]"
                                                             data-paddingbottom="[0,0,0,0]" data-paddingleft="[0,0,0,0]"
                                                             style="z-index: 52;text-transform:left;z-index:9;">
                                                            <?php
                                                            $filename = getRandomElement($arProjectImages);
                                                            $new_filen = $_SERVER["DOCUMENT_ROOT"].'/wp-content/uploads/' . basename($filename);


                                                            $fileNew = "/wp-content/uploads/" . basename($filename);

                                                            $fileNew = cropImage($filename,
                                                                $_SERVER['DOCUMENT_ROOT'] . $fileNew,
                                                                105, 183);
                                                            ?>
                                                            <img
                                                                src="<?php echo $fileNew; ?>"
                                                                alt="" data-ww="105px" data-hh="183px" width="105"
                                                                height="183" data-no-retina></div>
                                                        <div class="tp-caption   tp-resizeme" id="slide-104-layer-28"
                                                             data-x="990" data-y="420"
                                                             data-width="['none','none','none','none']"
                                                             data-height="['none','none','none','none']"
                                                             data-type="image" data-responsive_offset="on"
                                                             data-frames='[{"from":"y:50px;opacity:0;","speed":600,"to":"o:1;","delay":6800,"ease":"Power4.easeOut"},{"delay":2300,"speed":300,"to":"y:50px;opacity:0;","ease":"Power4.easeIn"}]'
                                                             data-textAlign="['left','left','left','left']"
                                                             data-paddingtop="[0,0,0,0]" data-paddingright="[0,0,0,0]"
                                                             data-paddingbottom="[0,0,0,0]" data-paddingleft="[0,0,0,0]"
                                                             style="z-index: 53;text-transform:left;z-index:17;">
                                                            <?php
                                                            $filename = getRandomElement($arProjectImages);
                                                            $new_filen = $_SERVER["DOCUMENT_ROOT"].'/wp-content/uploads/' . basename($filename);


                                                            $fileNew = "/wp-content/uploads/" . basename($filename);

                                                            $fileNew = cropImage($filename,
                                                                $_SERVER['DOCUMENT_ROOT'] . $fileNew,
                                                                68, 170);
                                                            ?>
                                                            <img
                                                                src="<?php echo $fileNew; ?>"
                                                                alt="" data-ww="68px" data-hh="170px" width="68"
                                                                height="170" data-no-retina></div>
                                                        <div class="tp-caption   tp-resizeme" id="slide-104-layer-29"
                                                             data-x="660" data-y="300"
                                                             data-width="['none','none','none','none']"
                                                             data-height="['none','none','none','none']"
                                                             data-type="image" data-responsive_offset="on"
                                                             data-frames='[{"from":"y:50px;opacity:0;","speed":600,"to":"o:1;","delay":7000,"ease":"Power4.easeOut"},{"delay":2100,"speed":300,"to":"y:50px;opacity:0;","ease":"Power4.easeIn"}]'
                                                             data-textAlign="['left','left','left','left']"
                                                             data-paddingtop="[0,0,0,0]" data-paddingright="[0,0,0,0]"
                                                             data-paddingbottom="[0,0,0,0]" data-paddingleft="[0,0,0,0]"
                                                             style="z-index: 54;text-transform:left;z-index:16;">
                                                            <?php
                                                            $filename = getRandomElement($arProjectImages);
                                                            $new_filen = $_SERVER["DOCUMENT_ROOT"].'/wp-content/uploads/' . basename($filename);


                                                            $fileNew = "/wp-content/uploads/" . basename($filename);

                                                            $fileNew = cropImage($filename,
                                                                $_SERVER['DOCUMENT_ROOT'] . $fileNew,
                                                                689, 312);
                                                            ?>
                                                            <img
                                                                src="<?php echo $fileNew; ?>"
                                                                alt="" data-ww="689px" data-hh="312px" width="689"
                                                                height="312" data-no-retina></div>
                                                    </li>
                                                    <?php
                                                    $filename = getRandomElement($arProjectImages);
                                                    $new_filen = $_SERVER["DOCUMENT_ROOT"].'/wp-content/uploads/' . basename($filename);


                                                    $fileNew = "/wp-content/uploads/" . basename($filename);

                                                    $fileNew = cropImage($filename,
                                                        $_SERVER['DOCUMENT_ROOT'] . $fileNew,
                                                        100, 50);
                                                    ?>
                                                    <li data-index="rs-105" data-transition="random-premium"
                                                        data-slotamount="1" data-hideafterloop="0"
                                                        data-hideslideonmobile="off" data-easein="default"
                                                        data-easeout="default" data-masterspeed="500"
                                                        data-thumb="<?php echo $fileNew; ?>"
                                                        data-delay="10000" data-rotate="0" data-saveperformance="off"
                                                        class="no-transition" data-title="БЛОК 5" data-param1=""
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
                                                            src="<?php echo $fileNew; ?>"
                                                            alt="" title="intro-travel2-05-img-bg" width="1920"
                                                            height="1080" data-bgposition="center bottom"
                                                            data-bgfit="cover" data-bgrepeat="no-repeat"
                                                            class="rev-slidebg" data-no-retina>
                                                        <div class="tp-caption   tp-resizeme" id="slide-105-layer-2"
                                                             data-x="center" data-hoffset="-383" data-y="center"
                                                             data-voffset="258"
                                                             data-width="['none','none','none','none']"
                                                             data-height="['none','none','none','none']"
                                                             data-type="image" data-responsive_offset="on"
                                                             data-frames='[{"from":"y:50px;opacity:0;","speed":600,"to":"o:1;","delay":1400,"ease":"Power4.easeOut"},{"delay":7700,"speed":300,"to":"y:50px;opacity:0;","ease":"Power4.easeIn"}]'
                                                             data-textAlign="['left','left','left','left']"
                                                             data-paddingtop="[0,0,0,0]" data-paddingright="[0,0,0,0]"
                                                             data-paddingbottom="[0,0,0,0]" data-paddingleft="[0,0,0,0]"
                                                             style="z-index: 55;text-transform:left;z-index:2;">
                                                            <?php
                                                            $filename = getRandomElement($arProjectImages);
                                                            $new_filen = $_SERVER["DOCUMENT_ROOT"].'/wp-content/uploads/' . basename($filename);


                                                            $fileNew = "/wp-content/uploads/" . basename($filename);

                                                            $fileNew = cropImage($filename,
                                                                $_SERVER['DOCUMENT_ROOT'] . $fileNew,
                                                                860, 159);
                                                            ?>
                                                            <img
                                                                src="<?php echo $fileNew; ?>"
                                                                alt="" data-ww="860px" data-hh="159px" width="860"
                                                                height="159" data-no-retina></div>
                                                        <div class="tp-caption   tp-resizeme" id="slide-105-layer-3"
                                                             data-x="150" data-y="center" data-voffset="50"
                                                             data-width="['none','none','none','none']"
                                                             data-height="['none','none','none','none']"
                                                             data-type="image" data-responsive_offset="on"
                                                             data-frames='[{"from":"y:50px;opacity:0;","speed":600,"to":"o:1;","delay":1800,"ease":"Power4.easeOut"},{"delay":7300,"speed":300,"to":"y:50px;opacity:0;","ease":"Power4.easeIn"}]'
                                                             data-textAlign="['left','left','left','left']"
                                                             data-paddingtop="[0,0,0,0]" data-paddingright="[0,0,0,0]"
                                                             data-paddingbottom="[0,0,0,0]" data-paddingleft="[0,0,0,0]"
                                                             style="z-index: 56;text-transform:left;z-index:1;">
                                                            <?php
                                                            $filename = getRandomElement($arProjectImages);
                                                            $new_filen = $_SERVER["DOCUMENT_ROOT"].'/wp-content/uploads/' . basename($filename);


                                                            $fileNew = "/wp-content/uploads/" . basename($filename);

                                                            $fileNew = cropImage($filename,
                                                                $_SERVER['DOCUMENT_ROOT'] . $fileNew,
                                                                860, 551);
                                                            ?>
                                                            <img
                                                                src="<?php echo $fileNew; ?>"
                                                                alt="" data-ww="860px" data-hh="551px" width="860"
                                                                height="551" data-no-retina></div>
                                                        <div class="tp-caption   tp-resizeme" id="slide-105-layer-4"
                                                             data-x="448" data-y="bottom" data-voffset="195"
                                                             data-width="['none','none','none','none']"
                                                             data-height="['none','none','none','none']"
                                                             data-type="image" data-responsive_offset="on"
                                                             data-frames='[{"from":"x:-50px;opacity:0;","speed":600,"to":"o:1;","delay":2200,"ease":"Power4.easeOut"},{"delay":6900,"speed":300,"to":"x:-50px;opacity:0;","ease":"Power4.easeIn"}]'
                                                             data-textAlign="['left','left','left','left']"
                                                             data-paddingtop="[0,0,0,0]" data-paddingright="[0,0,0,0]"
                                                             data-paddingbottom="[0,0,0,0]" data-paddingleft="[0,0,0,0]"
                                                             style="z-index: 57;text-transform:left;z-index:11;">
                                                            <?php
                                                            $filename = getRandomElement($arProjectImages);
                                                            $new_filen = $_SERVER["DOCUMENT_ROOT"].'/wp-content/uploads/' . basename($filename);


                                                            $fileNew = "/wp-content/uploads/" . basename($filename);

                                                            $fileNew = cropImage($filename,
                                                                $_SERVER['DOCUMENT_ROOT'] . $fileNew,
                                                                330, 420);
                                                            ?>
                                                            <img
                                                                src="<?php echo $fileNew; ?>"
                                                                alt="" data-ww="330px" data-hh="420px" width="330"
                                                                height="420" data-no-retina></div>
                                                        <div class="tp-caption   tp-resizeme" id="slide-105-layer-5"
                                                             data-x="center" data-hoffset="-545" data-y="center"
                                                             data-voffset="193"
                                                             data-width="['none','none','none','none']"
                                                             data-height="['none','none','none','none']"
                                                             data-type="image" data-responsive_offset="on"
                                                             data-frames='[{"from":"x:-50px;opacity:0;","speed":600,"to":"o:1;","delay":2600,"ease":"Power4.easeOut"},{"delay":6500,"speed":300,"to":"x:-50px;opacity:0;","ease":"Power4.easeIn"}]'
                                                             data-textAlign="['left','left','left','left']"
                                                             data-paddingtop="[0,0,0,0]" data-paddingright="[0,0,0,0]"
                                                             data-paddingbottom="[0,0,0,0]" data-paddingleft="[0,0,0,0]"
                                                             style="z-index: 58;text-transform:left;z-index:10;">
                                                            <?php
                                                            $filename = getRandomElement($arProjectImages);
                                                            $new_filen = $_SERVER["DOCUMENT_ROOT"].'/wp-content/uploads/' . basename($filename);


                                                            $fileNew = "/wp-content/uploads/" . basename($filename);

                                                            $fileNew = cropImage($filename,
                                                                $_SERVER['DOCUMENT_ROOT'] . $fileNew,
                                                                188, 185);
                                                            ?>
                                                            <img
                                                                src="<?php echo $fileNew; ?>"
                                                                alt="" data-ww="188px" data-hh="185px" width="188"
                                                                height="185" data-no-retina></div>
                                                        <div class="tp-caption   tp-resizeme" id="slide-105-layer-6"
                                                             data-x="center" data-hoffset="-514" data-y="center"
                                                             data-voffset="272"
                                                             data-width="['none','none','none','none']"
                                                             data-height="['none','none','none','none']"
                                                             data-type="image" data-responsive_offset="on"
                                                             data-frames='[{"from":"x:-50px;opacity:0;","speed":600,"to":"o:1;","delay":3000,"ease":"Power4.easeOut"},{"delay":6100,"speed":300,"to":"x:-50px;opacity:0;","ease":"Power4.easeIn"}]'
                                                             data-textAlign="['left','left','left','left']"
                                                             data-paddingtop="[0,0,0,0]" data-paddingright="[0,0,0,0]"
                                                             data-paddingbottom="[0,0,0,0]" data-paddingleft="[0,0,0,0]"
                                                             style="z-index: 59;text-transform:left;z-index:12;">
                                                            <?php
                                                            $filename = getRandomElement($arProjectImages);
                                                            $new_filen = $_SERVER["DOCUMENT_ROOT"].'/wp-content/uploads/' . basename($filename);


                                                            $fileNew = "/wp-content/uploads/" . basename($filename);

                                                            $fileNew = cropImage($filename,
                                                                $_SERVER['DOCUMENT_ROOT'] . $fileNew,
                                                                91, 66);
                                                            ?>
                                                            <img
                                                                src="<?php echo $fileNew; ?>"
                                                                alt="" data-ww="91px" data-hh="66px" width="91"
                                                                height="66" data-no-retina></div>
                                                        <div class="tp-caption   tp-resizeme" id="slide-105-layer-7"
                                                             data-x="center" data-hoffset="-120" data-y="center"
                                                             data-voffset="285"
                                                             data-width="['none','none','none','none']"
                                                             data-height="['none','none','none','none']"
                                                             data-type="image" data-responsive_offset="on"
                                                             data-frames='[{"from":"x:-50px;opacity:0;","speed":600,"to":"o:1;","delay":3400,"ease":"Power4.easeOut"},{"delay":5700,"speed":300,"to":"x:-50px;opacity:0;","ease":"Power4.easeIn"}]'
                                                             data-textAlign="['left','left','left','left']"
                                                             data-paddingtop="[0,0,0,0]" data-paddingright="[0,0,0,0]"
                                                             data-paddingbottom="[0,0,0,0]" data-paddingleft="[0,0,0,0]"
                                                             style="z-index: 60;text-transform:left;z-index:12;">
                                                            <?php
                                                            $filename = getRandomElement($arProjectImages);
                                                            $new_filen = $_SERVER["DOCUMENT_ROOT"].'/wp-content/uploads/' . basename($filename);


                                                            $fileNew = "/wp-content/uploads/" . basename($filename);

                                                            $fileNew = cropImage($filename,
                                                                $_SERVER['DOCUMENT_ROOT'] . $fileNew,
                                                                83, 39);
                                                            ?>
                                                            <img
                                                                src="<?php echo $fileNew; ?>"
                                                                alt="" data-ww="83px" data-hh="39px" width="83"
                                                                height="39" data-no-retina></div>
                                                        <div class="tp-caption   tp-resizeme" id="slide-105-layer-8"
                                                             data-x="1100" data-y=""
                                                             data-width="['none','none','none','none']"
                                                             data-height="['none','none','none','none']"
                                                             data-type="image" data-responsive_offset="on"
                                                             data-frames='[{"from":"x:-50px;opacity:0;","speed":600,"to":"o:1;","delay":3800,"ease":"Power4.easeOut"},{"delay":5300,"speed":300,"to":"x:-50px;opacity:0;","ease":"Power4.easeIn"}]'
                                                             data-textAlign="['left','left','left','left']"
                                                             data-paddingtop="[0,0,0,0]" data-paddingright="[0,0,0,0]"
                                                             data-paddingbottom="[0,0,0,0]" data-paddingleft="[0,0,0,0]"
                                                             style="z-index: 61;text-transform:left;z-index:1;">
                                                            <?php
                                                            $filename = getRandomElement($arProjectImages);
                                                            $new_filen = $_SERVER["DOCUMENT_ROOT"].'/wp-content/uploads/' . basename($filename);


                                                            $fileNew = "/wp-content/uploads/" . basename($filename);

                                                            $fileNew = cropImage($filename,
                                                                $_SERVER['DOCUMENT_ROOT'] . $fileNew,
                                                                675, 1080);
                                                            ?>
                                                            <img
                                                                src="<?php echo $fileNew; ?>"
                                                                alt="" data-ww="675px" data-hh="1080px" width="675"
                                                                height="1080" data-no-retina></div>
                                                        <div class="tp-caption Fashion-BigDisplay   tp-resizeme"
                                                             id="slide-105-layer-9" data-x="1180" data-y="150"
                                                             data-width="['auto']" data-height="['auto']"
                                                             data-type="text" data-responsive_offset="on"
                                                             data-frames='[{"from":"y:50px;opacity:0;","speed":1000,"to":"o:1;","delay":4200,"ease":"Power4.easeOut"},{"delay":3800,"speed":1000,"to":"y:-50px;opacity:0;","ease":"Power4.easeIn"}]'
                                                             data-textAlign="['left','left','left','left']"
                                                             data-paddingtop="[0,0,0,0]" data-paddingright="[0,0,0,0]"
                                                             data-paddingbottom="[0,0,0,0]" data-paddingleft="[0,0,0,0]"
                                                             style="z-index: 62; white-space: nowrap; font-size: 100px; line-height: 120px; font-weight: 400; color: rgba(255,255,255,1);font-family:Oswald;text-transform:uppercase;text-decoration:none;z-index:10;letter-spacing:normal;text-shadow:5px 5px rgba(52, 184, 215, 1);">
                                                            <?php echo $ProjectTYPE; ?>
                                                        </div>
                                                        <div class="tp-caption Fashion-BigDisplay   tp-resizeme"
                                                             id="slide-105-layer-10" data-x="1180" data-y="450"
                                                             data-width="['auto']" data-height="['auto']"
                                                             data-type="text" data-responsive_offset="on"
                                                             data-frames='[{"from":"y:50px;opacity:0;","speed":1000,"to":"o:1;","delay":4600,"ease":"Power4.easeOut"},{"delay":3400,"speed":1000,"to":"y:-50px;opacity:0;","ease":"Power4.easeIn"}]'
                                                             data-textAlign="['left','left','left','left']"
                                                             data-paddingtop="[0,0,0,0]" data-paddingright="[0,0,0,0]"
                                                             data-paddingbottom="[0,0,0,0]" data-paddingleft="[0,0,0,0]"
                                                             style="z-index: 63; white-space: nowrap; font-size: 40px; line-height: 44px; font-weight: 600; color: rgba(255,255,255,1);font-family:Open Sans;text-transform:uppercase;text-decoration:none;z-index:10;letter-spacing:5px;">
                                                            <?php echo $YEAR; ?>
                                                        </div>
                                                        <div class="tp-caption   tp-resizeme" id="slide-105-layer-11"
                                                             data-x="1185" data-y="center" data-voffset="160"
                                                             data-width="['none','none','none','none']"
                                                             data-height="['none','none','none','none']"
                                                             data-type="image" data-responsive_offset="on"
                                                             data-frames='[{"from":"y:50px;opacity:0;","speed":1000,"to":"o:1;","delay":5500,"ease":"Power4.easeOut"},{"delay":2500,"speed":1000,"to":"y:-50px;opacity:0;","ease":"Power4.easeIn"}]'
                                                             data-textAlign="['left','left','left','left']"
                                                             data-paddingtop="[0,0,0,0]" data-paddingright="[0,0,0,0]"
                                                             data-paddingbottom="[0,0,0,0]" data-paddingleft="[0,0,0,0]"
                                                             style="z-index: 64;text-transform:left;z-index:10;">
                                                            <?php
                                                            $filename = getRandomElement($arProjectImages);
                                                            $new_filen = $_SERVER["DOCUMENT_ROOT"].'/wp-content/uploads/' . basename($filename);


                                                            $fileNew = "/wp-content/uploads/" . basename($filename);

                                                            $fileNew = cropImage($filename,
                                                                $_SERVER['DOCUMENT_ROOT'] . $fileNew,
                                                                68, 68);
                                                            ?>
                                                            <img
                                                                src="<?php echo $fileNew; ?>"
                                                                alt="" data-ww="68px" data-hh="68px" width="68"
                                                                height="68" data-no-retina></div>
                                                        <div class="tp-caption   tp-resizeme" id="slide-105-layer-12"
                                                             data-x="1290" data-y="center" data-voffset="160"
                                                             data-width="['none','none','none','none']"
                                                             data-height="['none','none','none','none']"
                                                             data-type="image" data-responsive_offset="on"
                                                             data-frames='[{"from":"y:50px;opacity:0;","speed":1000,"to":"o:1;","delay":5700,"ease":"Power4.easeOut"},{"delay":2300,"speed":1000,"to":"y:-50px;opacity:0;","ease":"Power4.easeIn"}]'
                                                             data-textAlign="['left','left','left','left']"
                                                             data-paddingtop="[0,0,0,0]" data-paddingright="[0,0,0,0]"
                                                             data-paddingbottom="[0,0,0,0]" data-paddingleft="[0,0,0,0]"
                                                             style="z-index: 65;text-transform:left;z-index:10;">
                                                            <?php
                                                            $filename = getRandomElement($arProjectImages);
                                                            $new_filen = $_SERVER["DOCUMENT_ROOT"].'/wp-content/uploads/' . basename($filename);


                                                            $fileNew = "/wp-content/uploads/" . basename($filename);

                                                            $fileNew = cropImage($filename,
                                                                $_SERVER['DOCUMENT_ROOT'] . $fileNew,
                                                                68, 68);
                                                            ?>
                                                            <img
                                                                src="<?php echo $fileNew; ?>"
                                                                alt="" data-ww="68px" data-hh="68px" width="68"
                                                                height="68" data-no-retina></div>
                                                        <div class="tp-caption   tp-resizeme" id="slide-105-layer-13"
                                                             data-x="1395" data-y="center" data-voffset="160"
                                                             data-width="['none','none','none','none']"
                                                             data-height="['none','none','none','none']"
                                                             data-type="image" data-responsive_offset="on"
                                                             data-frames='[{"from":"y:50px;opacity:0;","speed":1000,"to":"o:1;","delay":5900,"ease":"Power4.easeOut"},{"delay":2100,"speed":1000,"to":"y:-50px;opacity:0;","ease":"Power4.easeIn"}]'
                                                             data-textAlign="['left','left','left','left']"
                                                             data-paddingtop="[0,0,0,0]" data-paddingright="[0,0,0,0]"
                                                             data-paddingbottom="[0,0,0,0]" data-paddingleft="[0,0,0,0]"
                                                             style="z-index: 66;text-transform:left;z-index:10;">
                                                            <?php
                                                            $filename = getRandomElement($arProjectImages);
                                                            $new_filen = $_SERVER["DOCUMENT_ROOT"].'/wp-content/uploads/' . basename($filename);


                                                            $fileNew = "/wp-content/uploads/" . basename($filename);

                                                            $fileNew = cropImage($filename,
                                                                $_SERVER['DOCUMENT_ROOT'] . $fileNew,
                                                                68, 68);
                                                            ?>
                                                            <img
                                                                src="<?php echo $fileNew; ?>"
                                                                alt="" data-ww="68px" data-hh="68px" width="68"
                                                                height="68" data-no-retina></div>
                                                        <div class="tp-caption   tp-resizeme" id="slide-105-layer-14"
                                                             data-x="1500" data-y="center" data-voffset="160"
                                                             data-width="['none','none','none','none']"
                                                             data-height="['none','none','none','none']"
                                                             data-type="image" data-responsive_offset="on"
                                                             data-frames='[{"from":"y:50px;opacity:0;","speed":1000,"to":"o:1;","delay":6100,"ease":"Power4.easeOut"},{"delay":1900,"speed":1000,"to":"y:-50px;opacity:0;","ease":"Power4.easeIn"}]'
                                                             data-textAlign="['left','left','left','left']"
                                                             data-paddingtop="[0,0,0,0]" data-paddingright="[0,0,0,0]"
                                                             data-paddingbottom="[0,0,0,0]" data-paddingleft="[0,0,0,0]"
                                                             style="z-index: 67;text-transform:left;z-index:10;">
                                                            <?php
                                                            $filename = getRandomElement($arProjectImages);
                                                            $new_filen = $_SERVER["DOCUMENT_ROOT"].'/wp-content/uploads/' . basename($filename);


                                                            $fileNew = "/wp-content/uploads/" . basename($filename);

                                                            $fileNew = cropImage($filename,
                                                                $_SERVER['DOCUMENT_ROOT'] . $fileNew,
                                                                68, 68);
                                                            ?>
                                                            <img
                                                                src="<?php echo $fileNew; ?>"
                                                                alt="" data-ww="68px" data-hh="68px" width="68"
                                                                height="68" data-no-retina></div>
                                                        <div class="tp-caption   tp-resizeme" id="slide-105-layer-15"
                                                             data-x="1605" data-y="center" data-voffset="160"
                                                             data-width="['none','none','none','none']"
                                                             data-height="['none','none','none','none']"
                                                             data-type="image" data-responsive_offset="on"
                                                             data-frames='[{"from":"y:50px;opacity:0;","speed":1000,"to":"o:1;","delay":6200,"ease":"Power4.easeOut"},{"delay":1800,"speed":1000,"to":"y:-50px;opacity:0;","ease":"Power4.easeIn"}]'
                                                             data-textAlign="['left','left','left','left']"
                                                             data-paddingtop="[0,0,0,0]" data-paddingright="[0,0,0,0]"
                                                             data-paddingbottom="[0,0,0,0]" data-paddingleft="[0,0,0,0]"
                                                             style="z-index: 68;text-transform:left;z-index:10;">
                                                            <?php
                                                            $filename = getRandomElement($arProjectImages);
                                                            $new_filen = $_SERVER["DOCUMENT_ROOT"].'/wp-content/uploads/' . basename($filename);


                                                            $fileNew = "/wp-content/uploads/" . basename($filename);

                                                            $fileNew = cropImage($filename,
                                                                $_SERVER['DOCUMENT_ROOT'] . $fileNew,
                                                                68, 68);
                                                            ?>
                                                            <img
                                                                src="<?php echo $fileNew; ?>"
                                                                alt="" data-ww="68px" data-hh="68px" width="68"
                                                                height="68" data-no-retina></div>
                                                        <div class="tp-caption Fashion-BigDisplay   tp-resizeme"
                                                             id="slide-105-layer-16" data-x="1190" data-y="center"
                                                             data-voffset="220" data-width="['auto']"
                                                             data-height="['auto']" data-type="text"
                                                             data-responsive_offset="on"
                                                             data-frames='[{"from":"y:50px;opacity:0;","speed":1000,"to":"o:1;","delay":7200,"ease":"Power4.easeOut"},{"delay":800,"speed":1000,"to":"y:-50px;opacity:0;","ease":"Power4.easeIn"}]'
                                                             data-textAlign="['left','left','left','left']"
                                                             data-paddingtop="[0,0,0,0]" data-paddingright="[0,0,0,0]"
                                                             data-paddingbottom="[0,0,0,0]" data-paddingleft="[0,0,0,0]"
                                                             style="z-index: 69; white-space: nowrap; font-size: 17px; line-height: 22px; font-weight: 600; color: rgba(255,255,255,1);font-family:Open Sans;text-transform:uppercase;text-decoration:none;z-index:10;letter-spacing:normal;">
                                                            <?php displayRandomElement($arPostTagsNames); ?>
                                                        </div>
                                                        <div class="tp-caption Fashion-BigDisplay   tp-resizeme"
                                                             id="slide-105-layer-17" data-x="1298" data-y="center"
                                                             data-voffset="220" data-width="['auto']"
                                                             data-height="['auto']" data-type="text"
                                                             data-responsive_offset="on"
                                                             data-frames='[{"from":"y:50px;opacity:0;","speed":1000,"to":"o:1;","delay":7000,"ease":"Power4.easeOut"},{"delay":1000,"speed":1000,"to":"y:-50px;opacity:0;","ease":"Power4.easeIn"}]'
                                                             data-textAlign="['left','left','left','left']"
                                                             data-paddingtop="[0,0,0,0]" data-paddingright="[0,0,0,0]"
                                                             data-paddingbottom="[0,0,0,0]" data-paddingleft="[0,0,0,0]"
                                                             style="z-index: 70; white-space: nowrap; font-size: 17px; line-height: 22px; font-weight: 600; color: rgba(255,255,255,1);font-family:Open Sans;text-transform:uppercase;text-decoration:none;z-index:10;letter-spacing:normal;">
                                                            <?php displayRandomElement($arPostTagsNames); ?>
                                                        </div>
                                                        <div class="tp-caption Fashion-BigDisplay   tp-resizeme"
                                                             id="slide-105-layer-18" data-x="1412" data-y="center"
                                                             data-voffset="220" data-width="['auto']"
                                                             data-height="['auto']" data-type="text"
                                                             data-responsive_offset="on"
                                                             data-frames='[{"from":"opacity:0;","speed":1000,"to":"o:1;","delay":6800,"ease":"Power2.easeInOut"},{"delay":1200,"speed":1000,"to":"opacity:0;","ease":"Power4.easeIn"}]'
                                                             data-textAlign="['left','left','left','left']"
                                                             data-paddingtop="[0,0,0,0]" data-paddingright="[0,0,0,0]"
                                                             data-paddingbottom="[0,0,0,0]" data-paddingleft="[0,0,0,0]"
                                                             style="z-index: 71; white-space: nowrap; font-size: 17px; line-height: 22px; font-weight: 600; color: rgba(255,255,255,1);font-family:Open Sans;text-transform:uppercase;text-decoration:none;z-index:10;letter-spacing:normal;">
                                                            <?php displayRandomElement($arPostTagsNames); ?>
                                                        </div>
                                                        <div class="tp-caption Fashion-BigDisplay   tp-resizeme"
                                                             id="slide-105-layer-19" data-x="1505" data-y="center"
                                                             data-voffset="220" data-width="['auto']"
                                                             data-height="['auto']" data-type="text"
                                                             data-responsive_offset="on"
                                                             data-frames='[{"from":"y:50px;opacity:0;","speed":1000,"to":"o:1;","delay":6600,"ease":"Power4.easeOut"},{"delay":1400,"speed":1000,"to":"y:-50px;opacity:0;","ease":"Power4.easeIn"}]'
                                                             data-textAlign="['left','left','left','left']"
                                                             data-paddingtop="[0,0,0,0]" data-paddingright="[0,0,0,0]"
                                                             data-paddingbottom="[0,0,0,0]" data-paddingleft="[0,0,0,0]"
                                                             style="z-index: 72; white-space: nowrap; font-size: 17px; line-height: 22px; font-weight: 600; color: rgba(255,255,255,1);font-family:Open Sans;text-transform:uppercase;text-decoration:none;z-index:10;letter-spacing:normal;">
                                                            <?php displayRandomElement($arPostTagsNames); ?>
                                                        </div>
                                                        <div class="tp-caption Fashion-BigDisplay   tp-resizeme"
                                                             id="slide-105-layer-20" data-x="1615" data-y="center"
                                                             data-voffset="220" data-width="['auto']"
                                                             data-height="['auto']" data-type="text"
                                                             data-responsive_offset="on"
                                                             data-frames='[{"from":"y:50px;opacity:0;","speed":1000,"to":"o:1;","delay":6400,"ease":"Power4.easeOut"},{"delay":1600,"speed":1000,"to":"y:-50px;opacity:0;","ease":"Power4.easeIn"}]'
                                                             data-textAlign="['left','left','left','left']"
                                                             data-paddingtop="[0,0,0,0]" data-paddingright="[0,0,0,0]"
                                                             data-paddingbottom="[0,0,0,0]" data-paddingleft="[0,0,0,0]"
                                                             style="z-index: 73; white-space: nowrap; font-size: 17px; line-height: 22px; font-weight: 600; color: rgba(255,255,255,1);font-family:Open Sans;text-transform:left;">
                                                            <?php displayRandomElement($arPostTagsNames); ?>
                                                        </div>
                                                        <div class="tp-caption Fashion-BigDisplay   tp-resizeme"
                                                             id="slide-105-layer-21" data-x="1185" data-y="770"
                                                             data-width="['auto']" data-height="['auto']"
                                                             data-type="text" data-responsive_offset="on"
                                                             data-frames='[{"from":"y:50px;opacity:0;","speed":1000,"to":"o:1;","delay":7600,"ease":"Power4.easeOut"},{"delay":400,"speed":1000,"to":"y:-50px;opacity:0;","ease":"Power4.easeIn"}]'
                                                             data-textAlign="['left','left','left','left']"
                                                             data-paddingtop="[0,0,0,0]" data-paddingright="[0,0,0,0]"
                                                             data-paddingbottom="[0,0,0,0]" data-paddingleft="[0,0,0,0]"
                                                             style="z-index: 74; white-space: nowrap; font-size: 17px; line-height: 22px; font-weight: 600; color: rgba(255,255,255,1);font-family:Open Sans;text-transform:uppercase;text-decoration:none;z-index:10;letter-spacing:normal;">
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
                                                    <li data-index="rs-106" data-transition="random-premium"
                                                        data-slotamount="1" data-hideafterloop="0"
                                                        data-hideslideonmobile="off" data-easein="default"
                                                        data-easeout="default" data-masterspeed="500"
                                                        data-thumb="<?php echo $fileNew; ?>"
                                                        data-delay="6000" data-rotate="0" data-saveperformance="off"
                                                        class="no-transition" data-title="БЛОК 6" data-param1=""
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
                                                            src="<?php echo $fileNew; ?>"
                                                            alt="" title="intro-travel2-06-img-02" width="1920"
                                                            height="1080" data-bgposition="center bottom"
                                                            data-bgfit="cover" data-bgrepeat="no-repeat"
                                                            class="rev-slidebg" data-no-retina>
                                                        <div class="tp-caption   tp-resizeme" id="slide-106-layer-2"
                                                             data-x="970" data-y="70"
                                                             data-width="['none','none','none','none']"
                                                             data-height="['none','none','none','none']"
                                                             data-type="image" data-responsive_offset="on"
                                                             data-frames='[{"from":"y:50px;opacity:0;","speed":600,"to":"o:1;","delay":1400,"ease":"Power4.easeOut"},{"delay":3700,"speed":300,"to":"y:50px;opacity:0;","ease":"Power4.easeIn"}]'
                                                             data-textAlign="['left','left','left','left']"
                                                             data-paddingtop="[0,0,0,0]" data-paddingright="[0,0,0,0]"
                                                             data-paddingbottom="[0,0,0,0]" data-paddingleft="[0,0,0,0]"
                                                             style="z-index: 75;text-transform:left;z-index:2;">
                                                            <?php
                                                            $filename = getRandomElement($arProjectImages);
                                                            $new_filen = $_SERVER["DOCUMENT_ROOT"].'/wp-content/uploads/' . basename($filename);


                                                            $fileNew = "/wp-content/uploads/" . basename($filename);

                                                            $fileNew = cropImage($filename,
                                                                $_SERVER['DOCUMENT_ROOT'] . $fileNew,
                                                                883, 860);
                                                            ?>
                                                            <img
                                                                src="<?php echo $fileNew; ?>"
                                                                alt="" data-ww="883px" data-hh="860px" width="883"
                                                                height="860" data-no-retina></div>
                                                        <div class="tp-caption Fashion-BigDisplay   tp-resizeme"
                                                             id="slide-106-layer-3" data-x="200" data-y="300"
                                                             data-width="['auto']" data-height="['auto']"
                                                             data-type="text" data-responsive_offset="on"
                                                             data-frames='[{"from":"y:50px;opacity:0;","speed":600,"to":"o:1;","delay":2000,"ease":"Power4.easeOut"},{"delay":3100,"speed":300,"to":"y:50px;opacity:0;","ease":"Power4.easeIn"}]'
                                                             data-textAlign="['left','left','left','left']"
                                                             data-paddingtop="[0,0,0,0]" data-paddingright="[0,0,0,0]"
                                                             data-paddingbottom="[0,0,0,0]" data-paddingleft="[0,0,0,0]"
                                                             style="z-index: 76; white-space: nowrap; font-size: 100px; line-height: 120px; font-weight: 400;font-family:Oswald;text-transform:uppercase;z-index:1;line-height:120px;">
                                                            <?php displayRandomElement($arPostTagsNames); ?>
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
                                                        e.c = jQuery('#rev_slider_17_1');
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
                                                var revapi17;
                                                tpj(document).ready(function () {
                                                    if (tpj("#rev_slider_17_1").revolution == undefined) {
                                                        revslider_showDoubleJqueryError("#rev_slider_17_1");
                                                    } else {
                                                        revapi17 = tpj("#rev_slider_17_1").show().revolution({
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
                                                                    hide_under: 850,
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