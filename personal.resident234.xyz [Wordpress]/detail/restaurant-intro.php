<?php
/**
 * Created by PhpStorm.
 * User: GSU
 * Date: 29.07.2017
 * Time: 15:13
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
<body class="page-template-default page page-id-37 wpb-js-composer js-comp-ver-5.1 vc_responsive">
<section class="parent-section no-padding post-37 page type-page status-publish hentry">
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
                                            href="http://fonts.googleapis.com/css?family=Great+Vibes:400|Open+Sans:800%2C400%2C700%2C600|Playfair+Display:700"
                                            rel="stylesheet" property="stylesheet" type="text/css" media="all">
                                        <div id="rev_slider_16_1_wrapper"
                                             class="rev_slider_wrapper fullscreen-container" data-source="gallery"
                                             style="background:transparent;padding:0px;">
                                            <div id="rev_slider_16_1" class="rev_slider fullscreenbanner"
                                                 style="display:none;" data-version="5.4.1">
                                                <ul>
                                                    <li data-index="rs-91" data-transition="fade" data-slotamount="1"
                                                        data-hideafterloop="0" data-hideslideonmobile="off"
                                                        data-easein="default" data-easeout="default"
                                                        data-masterspeed="500" data-delay="20000" data-rotate="0"
                                                        data-saveperformance="off" class="no-transition"
                                                        data-title="<?php echo $arProject["post_title"];?>"
                                                        data-param1="" data-param2=""
                                                        data-param3="" data-param4="" data-param5="" data-param6=""
                                                        data-param7="" data-param8="" data-param9="" data-param10=""
                                                        data-description="">

                                                        <?php
                                                        $filename = getRandomElement($arProjectImages);
                                                        $new_filen = $_SERVER["DOCUMENT_ROOT"].'/wp-content/uploads/' . basename($filename);


                                                        $fileNew = "/wp-content/uploads/" . basename($filename);

                                                        $fileNew = cropImage($filename,
                                                            $_SERVER['DOCUMENT_ROOT'] . $fileNew,
                                                            2100, 1200);
                                                        ?>
                                                        <img
                                                            src="http://wpdemos.themezaa.com/h-code/wp-content/plugins/revslider/admin/assets/images/dummy.png"
                                                            alt="" title="intro-restaurant-01-bg.png" width="2100"
                                                            height="1200"
                                                            data-lazyload="<?php echo $fileNew; ?>"
                                                            data-bgposition="center center" data-bgfit="cover"
                                                            data-bgrepeat="no-repeat" class="rev-slidebg"
                                                            data-no-retina>
                                                        <div class="tp-caption   tp-resizeme" id="slide-91-layer-1"
                                                             data-x="center" data-hoffset="" data-y="center"
                                                             data-voffset="" data-width="['none','none','none','none']"
                                                             data-height="['none','none','none','none']"
                                                             data-type="image" data-responsive_offset="on"
                                                             data-frames='[{"from":"y:50px;opacity:0;","speed":1,"to":"o:1;","delay":1,"ease":"Power4.easeOut"},{"delay":19997,"speed":1,"to":"y:50px;opacity:0;","ease":"Power4.easeIn"}]'
                                                             data-textAlign="['left','left','left','left']"
                                                             data-paddingtop="[0,0,0,0]" data-paddingright="[0,0,0,0]"
                                                             data-paddingbottom="[0,0,0,0]" data-paddingleft="[0,0,0,0]"
                                                             style="z-index: 5;text-transform:left;z-index:100;">
                                                            <?php
                                                            $filename = getRandomElement($arProjectImages);
                                                            /*$new_filen = $_SERVER["DOCUMENT_ROOT"].'/wp-content/uploads/' . basename($filename);


                                                            $fileNew = "/wp-content/uploads/" . basename($filename);

                                                            $fileNew = cropImage($filename,
                                                                $_SERVER['DOCUMENT_ROOT'] . $fileNew,
                                                                5760, 3240);*/
                                                            ?>
                                                            <img
                                                                src="http://wpdemos.themezaa.com/h-code/wp-content/plugins/revslider/admin/assets/images/dummy.png"
                                                                alt="" data-ww="auto" data-hh="auto" width="5760"
                                                                height="3240"
                                                                data-lazyload="<?php echo $filename; ?>"
                                                                data-no-retina></div>
                                                        <div class="tp-caption   tp-resizeme" id="slide-91-layer-2"
                                                             data-x="center" data-hoffset="" data-y="center"
                                                             data-voffset="" data-width="['none','none','none','none']"
                                                             data-height="['none','none','none','none']"
                                                             data-type="image" data-responsive_offset="on"
                                                             data-frames='[{"from":"opacity:0;","speed":1000,"to":"o:1;","delay":1300,"ease":"Power4.easeOut"},{"delay":16700,"speed":1000,"to":"opacity:0;","ease":"Power4.easeIn"}]'
                                                             data-textAlign="['left','left','left','left']"
                                                             data-paddingtop="[0,0,0,0]" data-paddingright="[0,0,0,0]"
                                                             data-paddingbottom="[0,0,0,0]" data-paddingleft="[0,0,0,0]"
                                                             style="z-index: 6;text-transform:left;z-index:21;">
                                                            <?php
                                                            $filename = getRandomElement($arProjectImages);
                                                            $new_filen = $_SERVER["DOCUMENT_ROOT"].'/wp-content/uploads/' . basename($filename);


                                                            $fileNew = "/wp-content/uploads/" . basename($filename);

                                                            $fileNew = cropImage($filename,
                                                                $_SERVER['DOCUMENT_ROOT'] . $fileNew,
                                                                2200, 1200);
                                                            ?>
                                                            <img
                                                                src="http://wpdemos.themezaa.com/h-code/wp-content/plugins/revslider/admin/assets/images/dummy.png"
                                                                alt="" data-ww="2200px" data-hh="1200px" width="2200"
                                                                height="1200"
                                                                data-lazyload="<?php echo $fileNew; ?>"
                                                                data-no-retina></div>
                                                        <div class="tp-caption   tp-resizeme" id="slide-91-layer-3"
                                                             data-x="center" data-hoffset="" data-y="center"
                                                             data-voffset="-200"
                                                             data-width="['none','none','none','none']"
                                                             data-height="['none','none','none','none']"
                                                             data-type="image" data-responsive_offset="on"
                                                             data-frames='[{"from":"y:-50px;opacity:0;","speed":1000,"to":"o:1;","delay":2000,"ease":"Power4.easeOut"},{"delay":16000,"speed":1000,"to":"y:50px;opacity:0;","ease":"Power4.easeIn"}]'
                                                             data-textAlign="['left','left','left','left']"
                                                             data-paddingtop="[0,0,0,0]" data-paddingright="[0,0,0,0]"
                                                             data-paddingbottom="[0,0,0,0]" data-paddingleft="[0,0,0,0]"
                                                             style="z-index: 7;text-transform:left;z-index:22;">
                                                            <?php
                                                            $filename = getRandomElement($arProjectImages);
                                                            $new_filen = $_SERVER["DOCUMENT_ROOT"].'/wp-content/uploads/' . basename($filename);


                                                            $fileNew = "/wp-content/uploads/" . basename($filename);

                                                            $fileNew = cropImage($filename,
                                                                $_SERVER['DOCUMENT_ROOT'] . $fileNew,
                                                                646, 345);
                                                            ?>
                                                            <img
                                                                src="http://wpdemos.themezaa.com/h-code/wp-content/plugins/revslider/admin/assets/images/dummy.png"
                                                                alt="" data-ww="646px" data-hh="345px" width="646"
                                                                height="345"
                                                                data-lazyload="<?php echo $fileNew; ?>"
                                                                data-no-retina></div>
                                                        <div class="tp-caption   tp-resizeme" id="slide-91-layer-4"
                                                             data-x="center" data-hoffset="" data-y="center"
                                                             data-voffset="-230"
                                                             data-width="['none','none','none','none']"
                                                             data-height="['none','none','none','none']"
                                                             data-type="image" data-responsive_offset="on"
                                                             data-frames='[{"from":"y:50px;opacity:0;","speed":1000,"to":"o:1;","delay":2200,"ease":"Power4.easeOut"},{"delay":15800,"speed":1000,"to":"y:50px;opacity:0;","ease":"Power4.easeIn"}]'
                                                             data-textAlign="['left','left','left','left']"
                                                             data-paddingtop="[0,0,0,0]" data-paddingright="[0,0,0,0]"
                                                             data-paddingbottom="[0,0,0,0]" data-paddingleft="[0,0,0,0]"
                                                             style="z-index: 8;text-transform:left;z-index:23;">
                                                            <?php
                                                            $filename = getRandomElement($arProjectImages);
                                                            $new_filen = $_SERVER["DOCUMENT_ROOT"].'/wp-content/uploads/' . basename($filename);


                                                            $fileNew = "/wp-content/uploads/" . basename($filename);

                                                            $fileNew = cropImage($filename,
                                                                $_SERVER['DOCUMENT_ROOT'] . $fileNew,
                                                                24, 53);
                                                            ?>
                                                            <img
                                                                src="http://wpdemos.themezaa.com/h-code/wp-content/plugins/revslider/admin/assets/images/dummy.png"
                                                                alt="" data-ww="24px" data-hh="53px" width="24"
                                                                height="53"
                                                                data-lazyload="<?php echo $fileNew; ?>"
                                                                data-no-retina></div>
                                                        <div class="tp-caption   tp-resizeme" id="slide-91-layer-5"
                                                             data-x="center" data-hoffset="" data-y="center"
                                                             data-voffset="-178"
                                                             data-width="['none','none','none','none']"
                                                             data-height="['none','none','none','none']"
                                                             data-type="image" data-responsive_offset="on"
                                                             data-frames='[{"from":"y:50px;opacity:0;","speed":1000,"to":"o:1;","delay":2400,"ease":"Power4.easeOut"},{"delay":15600,"speed":1000,"to":"y:50px;opacity:0;","ease":"Power4.easeIn"}]'
                                                             data-textAlign="['left','left','left','left']"
                                                             data-paddingtop="[0,0,0,0]" data-paddingright="[0,0,0,0]"
                                                             data-paddingbottom="[0,0,0,0]" data-paddingleft="[0,0,0,0]"
                                                             style="z-index: 9;text-transform:left;z-index:23;">
                                                            <?php
                                                            $filename = getRandomElement($arProjectImages);
                                                            $new_filen = $_SERVER["DOCUMENT_ROOT"].'/wp-content/uploads/' . basename($filename);


                                                            $fileNew = "/wp-content/uploads/" . basename($filename);

                                                            $fileNew = cropImage($filename,
                                                                $_SERVER['DOCUMENT_ROOT'] . $fileNew,
                                                                203, 29);
                                                            ?>
                                                            <img
                                                                src="http://wpdemos.themezaa.com/h-code/wp-content/plugins/revslider/admin/assets/images/dummy.png"
                                                                alt="" data-ww="203px" data-hh="29px" width="203"
                                                                height="29"
                                                                data-lazyload="<?php echo $fileNew; ?>"
                                                                data-no-retina></div>
                                                        <div class="tp-caption   tp-resizeme" id="slide-91-layer-6"
                                                             data-x="center" data-hoffset="" data-y="center"
                                                             data-voffset="-135"
                                                             data-width="['none','none','none','none']"
                                                             data-height="['none','none','none','none']"
                                                             data-type="image" data-responsive_offset="on"
                                                             data-frames='[{"from":"y:50px;opacity:0;","speed":1000,"to":"o:1;","delay":2600,"ease":"Power4.easeOut"},{"delay":15400,"speed":1000,"to":"y:50px;opacity:0;","ease":"Power4.easeIn"}]'
                                                             data-textAlign="['left','left','left','left']"
                                                             data-paddingtop="[0,0,0,0]" data-paddingright="[0,0,0,0]"
                                                             data-paddingbottom="[0,0,0,0]" data-paddingleft="[0,0,0,0]"
                                                             style="z-index: 10;text-transform:left;z-index:23;">
                                                            <?php
                                                            $filename = getRandomElement($arProjectImages);
                                                            $new_filen = $_SERVER["DOCUMENT_ROOT"].'/wp-content/uploads/' . basename($filename);


                                                            $fileNew = "/wp-content/uploads/" . basename($filename);

                                                            $fileNew = cropImage($filename,
                                                                $_SERVER['DOCUMENT_ROOT'] . $fileNew,
                                                                309, 48);
                                                            ?>
                                                            <img
                                                                src="http://wpdemos.themezaa.com/h-code/wp-content/plugins/revslider/admin/assets/images/dummy.png"
                                                                alt="" data-ww="309px" data-hh="48px" width="309"
                                                                height="48"
                                                                data-lazyload="<?php echo $fileNew; ?>"
                                                                data-no-retina></div>
                                                        <div class="tp-caption   tp-resizeme" id="slide-91-layer-7"
                                                             data-x="center" data-hoffset="" data-y="center"
                                                             data-voffset="-60"
                                                             data-width="['none','none','none','none']"
                                                             data-height="['none','none','none','none']"
                                                             data-type="image" data-responsive_offset="on"
                                                             data-frames='[{"from":"y:50px;opacity:0;","speed":1000,"to":"o:1;","delay":2800,"ease":"Power4.easeOut"},{"delay":15200,"speed":1000,"to":"y:50px;opacity:0;","ease":"Power4.easeIn"}]'
                                                             data-textAlign="['left','left','left','left']"
                                                             data-paddingtop="[0,0,0,0]" data-paddingright="[0,0,0,0]"
                                                             data-paddingbottom="[0,0,0,0]" data-paddingleft="[0,0,0,0]"
                                                             style="z-index: 11;text-transform:left;z-index:23;">
                                                            <?php
                                                            $filename = getRandomElement($arProjectImages);
                                                            $new_filen = $_SERVER["DOCUMENT_ROOT"].'/wp-content/uploads/' . basename($filename);


                                                            $fileNew = "/wp-content/uploads/" . basename($filename);

                                                            $fileNew = cropImage($filename,
                                                                $_SERVER['DOCUMENT_ROOT'] . $fileNew,
                                                                245, 45);
                                                            ?>
                                                            <img
                                                                src="http://wpdemos.themezaa.com/h-code/wp-content/plugins/revslider/admin/assets/images/dummy.png"
                                                                alt="" data-ww="245px" data-hh="45px" width="245"
                                                                height="45"
                                                                data-lazyload="<?php echo $fileNew; ?>"
                                                                data-no-retina></div>
                                                        <div class="tp-caption   tp-resizeme" id="slide-91-layer-8"
                                                             data-x="center" data-hoffset="" data-y="center"
                                                             data-voffset="-5"
                                                             data-width="['none','none','none','none']"
                                                             data-height="['none','none','none','none']"
                                                             data-type="image" data-responsive_offset="on"
                                                             data-frames='[{"from":"y:50px;opacity:0;","speed":1000,"to":"o:1;","delay":3000,"ease":"Power4.easeOut"},{"delay":15000,"speed":1000,"to":"y:50px;opacity:0;","ease":"Power4.easeIn"}]'
                                                             data-textAlign="['left','left','left','left']"
                                                             data-paddingtop="[0,0,0,0]" data-paddingright="[0,0,0,0]"
                                                             data-paddingbottom="[0,0,0,0]" data-paddingleft="[0,0,0,0]"
                                                             style="z-index: 12;text-transform:left;z-index:23;">
                                                            <?php
                                                            $filename = getRandomElement($arProjectImages);
                                                            $new_filen = $_SERVER["DOCUMENT_ROOT"].'/wp-content/uploads/' . basename($filename);


                                                            $fileNew = "/wp-content/uploads/" . basename($filename);

                                                            $fileNew = cropImage($filename,
                                                                $_SERVER['DOCUMENT_ROOT'] . $fileNew,
                                                                336, 4);
                                                            ?>
                                                            <img
                                                                src="http://wpdemos.themezaa.com/h-code/wp-content/plugins/revslider/admin/assets/images/dummy.png"
                                                                alt="" data-ww="336px" data-hh="4px" width="336"
                                                                height="4"
                                                                data-lazyload="<?php echo $fileNew; ?>"
                                                                data-no-retina></div>
                                                        <div class="tp-caption   tp-resizeme" id="slide-91-layer-9"
                                                             data-x="center" data-hoffset="" data-y="center"
                                                             data-voffset="15"
                                                             data-width="['none','none','none','none']"
                                                             data-height="['none','none','none','none']"
                                                             data-type="image" data-responsive_offset="on"
                                                             data-frames='[{"from":"y:50px;opacity:0;","speed":1000,"to":"o:1;","delay":3200,"ease":"Power4.easeOut"},{"delay":14800,"speed":1000,"to":"y:50px;opacity:0;","ease":"Power4.easeIn"}]'
                                                             data-textAlign="['left','left','left','left']"
                                                             data-paddingtop="[0,0,0,0]" data-paddingright="[0,0,0,0]"
                                                             data-paddingbottom="[0,0,0,0]" data-paddingleft="[0,0,0,0]"
                                                             style="z-index: 13;text-transform:left;z-index:23;">
                                                            <?php
                                                            $filename = getRandomElement($arProjectImages);
                                                            $new_filen = $_SERVER["DOCUMENT_ROOT"].'/wp-content/uploads/' . basename($filename);


                                                            $fileNew = "/wp-content/uploads/" . basename($filename);

                                                            $fileNew = cropImage($filename,
                                                                $_SERVER['DOCUMENT_ROOT'] . $fileNew,
                                                                330, 17);
                                                            ?>
                                                            <img
                                                                src="http://wpdemos.themezaa.com/h-code/wp-content/plugins/revslider/admin/assets/images/dummy.png"
                                                                alt="" data-ww="330px" data-hh="17px" width="330"
                                                                height="17"
                                                                data-lazyload="<?php echo $fileNew; ?>"
                                                                data-no-retina></div>
                                                        <div class="tp-caption   tp-resizeme" id="slide-91-layer-10"
                                                             data-x="center" data-hoffset="" data-y="center"
                                                             data-voffset="35"
                                                             data-width="['none','none','none','none']"
                                                             data-height="['none','none','none','none']"
                                                             data-type="image" data-responsive_offset="on"
                                                             data-frames='[{"from":"y:50px;opacity:0;","speed":1000,"to":"o:1;","delay":3400,"ease":"Power4.easeOut"},{"delay":14600,"speed":1000,"to":"y:50px;opacity:0;","ease":"Power4.easeIn"}]'
                                                             data-textAlign="['left','left','left','left']"
                                                             data-paddingtop="[0,0,0,0]" data-paddingright="[0,0,0,0]"
                                                             data-paddingbottom="[0,0,0,0]" data-paddingleft="[0,0,0,0]"
                                                             style="z-index: 14;text-transform:left;z-index:23;">

                                                            <?php
                                                            $filename = getRandomElement($arProjectImages);
                                                            $new_filen = $_SERVER["DOCUMENT_ROOT"].'/wp-content/uploads/' . basename($filename);


                                                            $fileNew = "/wp-content/uploads/" . basename($filename);

                                                            $fileNew = cropImage($filename,
                                                                $_SERVER['DOCUMENT_ROOT'] . $fileNew,
                                                                336, 4);
                                                            ?>
                                                            <img
                                                                src="http://wpdemos.themezaa.com/h-code/wp-content/plugins/revslider/admin/assets/images/dummy.png"
                                                                alt="" data-ww="336px" data-hh="4px" width="336"
                                                                height="4"
                                                                data-lazyload="<?php echo $fileNew; ?>"
                                                                data-no-retina></div>
                                                        <div class="tp-caption   tp-resizeme" id="slide-91-layer-11"
                                                             data-x="center" data-hoffset="" data-y="center"
                                                             data-voffset="55"
                                                             data-width="['none','none','none','none']"
                                                             data-height="['none','none','none','none']"
                                                             data-type="image" data-responsive_offset="on"
                                                             data-frames='[{"from":"y:50px;opacity:0;","speed":1000,"to":"o:1;","delay":3600,"ease":"Power4.easeOut"},{"delay":14400,"speed":1000,"to":"y:50px;opacity:0;","ease":"Power4.easeIn"}]'
                                                             data-textAlign="['left','left','left','left']"
                                                             data-paddingtop="[0,0,0,0]" data-paddingright="[0,0,0,0]"
                                                             data-paddingbottom="[0,0,0,0]" data-paddingleft="[0,0,0,0]"
                                                             style="z-index: 15;text-transform:left;z-index:23;">
                                                            <?php
                                                            $filename = getRandomElement($arProjectImages);
                                                            $new_filen = $_SERVER["DOCUMENT_ROOT"].'/wp-content/uploads/' . basename($filename);


                                                            $fileNew = "/wp-content/uploads/" . basename($filename);

                                                            $fileNew = cropImage($filename,
                                                                $_SERVER['DOCUMENT_ROOT'] . $fileNew,
                                                                2, 20);
                                                            ?>
                                                            <img
                                                                src="http://wpdemos.themezaa.com/h-code/wp-content/plugins/revslider/admin/assets/images/dummy.png"
                                                                alt="" data-ww="2px" data-hh="20px" width="2"
                                                                height="20"
                                                                data-lazyload="<?php echo $fileNew; ?>"
                                                                data-no-retina></div>
                                                        <div class="tp-caption   tp-resizeme" id="slide-91-layer-12"
                                                             data-x="-100" data-y="-60"
                                                             data-width="['none','none','none','none']"
                                                             data-height="['none','none','none','none']"
                                                             data-type="image" data-responsive_offset="on"
                                                             data-frames='[{"from":"x:-50px;opacity:0;","speed":1000,"to":"o:1;","delay":4500,"ease":"Power4.easeOut"},{"delay":13500,"speed":1000,"to":"x:-50px;opacity:0;","ease":"Power4.easeIn"}]'
                                                             data-textAlign="['left','left','left','left']"
                                                             data-paddingtop="[0,0,0,0]" data-paddingright="[0,0,0,0]"
                                                             data-paddingbottom="[0,0,0,0]" data-paddingleft="[0,0,0,0]"
                                                             style="z-index: 16;text-transform:left;z-index:19;">
                                                            <?php
                                                            $filename = getRandomElement($arProjectImages);
                                                            $new_filen = $_SERVER["DOCUMENT_ROOT"].'/wp-content/uploads/' . basename($filename);


                                                            $fileNew = "/wp-content/uploads/" . basename($filename);

                                                            $fileNew = cropImage($filename,
                                                                $_SERVER['DOCUMENT_ROOT'] . $fileNew,
                                                                384, 464);
                                                            ?>
                                                            <img
                                                                src="http://wpdemos.themezaa.com/h-code/wp-content/plugins/revslider/admin/assets/images/dummy.png"
                                                                alt="" data-ww="384px" data-hh="464px" width="384"
                                                                height="464"
                                                                data-lazyload="<?php echo $fileNew; ?>"
                                                                data-no-retina></div>
                                                        <div class="tp-caption   tp-resizeme" id="slide-91-layer-13"
                                                             data-x="-50" data-y="center" data-voffset=""
                                                             data-width="['none','none','none','none']"
                                                             data-height="['none','none','none','none']"
                                                             data-type="image" data-responsive_offset="on"
                                                             data-frames='[{"from":"x:-50px;opacity:0;","speed":1000,"to":"o:1;","delay":5500,"ease":"Power4.easeOut"},{"delay":12500,"speed":1000,"to":"x:-50px;opacity:0;","ease":"Power4.easeIn"}]'
                                                             data-textAlign="['left','left','left','left']"
                                                             data-paddingtop="[0,0,0,0]" data-paddingright="[0,0,0,0]"
                                                             data-paddingbottom="[0,0,0,0]" data-paddingleft="[0,0,0,0]"
                                                             style="z-index: 17;text-transform:left;z-index:20;">
                                                            <?php
                                                            $filename = getRandomElement($arProjectImages);
                                                            $new_filen = $_SERVER["DOCUMENT_ROOT"].'/wp-content/uploads/' . basename($filename);


                                                            $fileNew = "/wp-content/uploads/" . basename($filename);

                                                            $fileNew = cropImage($filename,
                                                                $_SERVER['DOCUMENT_ROOT'] . $fileNew,
                                                                369, 178);
                                                            ?>
                                                            <img
                                                                src="http://wpdemos.themezaa.com/h-code/wp-content/plugins/revslider/admin/assets/images/dummy.png"
                                                                alt="" data-ww="369px" data-hh="178px" width="369"
                                                                height="178"
                                                                data-lazyload="<?php echo $fileNew; ?>"
                                                                data-no-retina></div>
                                                        <div class="tp-caption   tp-resizeme" id="slide-91-layer-14"
                                                             data-x="-150" data-y="center" data-voffset="280"
                                                             data-width="['none','none','none','none']"
                                                             data-height="['none','none','none','none']"
                                                             data-type="image" data-responsive_offset="on"
                                                             data-frames='[{"from":"x:-50px;opacity:0;","speed":1000,"to":"o:1;","delay":6500,"ease":"Power4.easeOut"},{"delay":11500,"speed":1000,"to":"x:-50px;opacity:0;","ease":"Power4.easeIn"}]'
                                                             data-textAlign="['left','left','left','left']"
                                                             data-paddingtop="[0,0,0,0]" data-paddingright="[0,0,0,0]"
                                                             data-paddingbottom="[0,0,0,0]" data-paddingleft="[0,0,0,0]"
                                                             style="z-index: 18;text-transform:left;z-index:19;">
                                                            <?php
                                                            $filename = getRandomElement($arProjectImages);
                                                            $new_filen = $_SERVER["DOCUMENT_ROOT"].'/wp-content/uploads/' . basename($filename);


                                                            $fileNew = "/wp-content/uploads/" . basename($filename);

                                                            $fileNew = cropImage($filename,
                                                                $_SERVER['DOCUMENT_ROOT'] . $fileNew,
                                                                505, 434);
                                                            ?>
                                                            <img
                                                                src="http://wpdemos.themezaa.com/h-code/wp-content/plugins/revslider/admin/assets/images/dummy.png"
                                                                alt="" data-ww="505px" data-hh="434px" width="505"
                                                                height="434"
                                                                data-lazyload="<?php echo $fileNew; ?>"
                                                                data-no-retina></div>
                                                        <div class="tp-caption   tp-resizeme" id="slide-91-layer-15"
                                                             data-x="15" data-y="bottom" data-voffset="-130"
                                                             data-width="['none','none','none','none']"
                                                             data-height="['none','none','none','none']"
                                                             data-type="image" data-responsive_offset="on"
                                                             data-frames='[{"from":"y:50px;opacity:0;","speed":1000,"to":"o:1;","delay":7500,"ease":"Power4.easeOut"},{"delay":10500,"speed":1000,"to":"y:50px;opacity:0;","ease":"Power4.easeIn"}]'
                                                             data-textAlign="['left','left','left','left']"
                                                             data-paddingtop="[0,0,0,0]" data-paddingright="[0,0,0,0]"
                                                             data-paddingbottom="[0,0,0,0]" data-paddingleft="[0,0,0,0]"
                                                             style="z-index: 19;text-transform:left;z-index:19;">
                                                            <?php
                                                            $filename = getRandomElement($arProjectImages);
                                                            $new_filen = $_SERVER["DOCUMENT_ROOT"].'/wp-content/uploads/' . basename($filename);


                                                            $fileNew = "/wp-content/uploads/" . basename($filename);

                                                            $fileNew = cropImage($filename,
                                                                $_SERVER['DOCUMENT_ROOT'] . $fileNew,
                                                                385, 382);
                                                            ?>
                                                            <img
                                                                src="http://wpdemos.themezaa.com/h-code/wp-content/plugins/revslider/admin/assets/images/dummy.png"
                                                                alt="" data-ww="385px" data-hh="382px" width="385"
                                                                height="382"
                                                                data-lazyload="<?php echo $fileNew; ?>"
                                                                data-no-retina></div>
                                                        <div class="tp-caption   tp-resizeme" id="slide-91-layer-16"
                                                             data-x="center" data-hoffset="-400" data-y="bottom"
                                                             data-voffset="-100"
                                                             data-width="['none','none','none','none']"
                                                             data-height="['none','none','none','none']"
                                                             data-type="image" data-responsive_offset="on"
                                                             data-frames='[{"from":"y:50px;opacity:0;","speed":1000,"to":"o:1;","delay":8500,"ease":"Power4.easeOut"},{"delay":9500,"speed":1000,"to":"y:50px;opacity:0;","ease":"Power4.easeIn"}]'
                                                             data-textAlign="['left','left','left','left']"
                                                             data-paddingtop="[0,0,0,0]" data-paddingright="[0,0,0,0]"
                                                             data-paddingbottom="[0,0,0,0]" data-paddingleft="[0,0,0,0]"
                                                             style="z-index: 20;text-transform:left;z-index:18;">
                                                            <?php
                                                            $filename = getRandomElement($arProjectImages);
                                                            $new_filen = $_SERVER["DOCUMENT_ROOT"].'/wp-content/uploads/' . basename($filename);


                                                            $fileNew = "/wp-content/uploads/" . basename($filename);

                                                            $fileNew = cropImage($filename,
                                                                $_SERVER['DOCUMENT_ROOT'] . $fileNew,
                                                                441, 469);
                                                            ?>
                                                            <img
                                                                src="http://wpdemos.themezaa.com/h-code/wp-content/plugins/revslider/admin/assets/images/dummy.png"
                                                                alt="" data-ww="441px" data-hh="469px" width="441"
                                                                height="469"
                                                                data-lazyload="<?php echo $fileNew; ?>"
                                                                data-no-retina></div>
                                                        <div class="tp-caption   tp-resizeme" id="slide-91-layer-17"
                                                             data-x="170" data-y="-90"
                                                             data-width="['none','none','none','none']"
                                                             data-height="['none','none','none','none']"
                                                             data-type="image" data-responsive_offset="on"
                                                             data-frames='[{"from":"y:-50px;opacity:0;","speed":1000,"to":"o:1;","delay":9500,"ease":"Power4.easeOut"},{"delay":8500,"speed":1000,"to":"y:-50px;opacity:0;","ease":"Power4.easeIn"}]'
                                                             data-textAlign="['left','left','left','left']"
                                                             data-paddingtop="[0,0,0,0]" data-paddingright="[0,0,0,0]"
                                                             data-paddingbottom="[0,0,0,0]" data-paddingleft="[0,0,0,0]"
                                                             style="z-index: 21;text-transform:left;z-index:20;">
                                                            <?php
                                                            $filename = getRandomElement($arProjectImages);
                                                            $new_filen = $_SERVER["DOCUMENT_ROOT"].'/wp-content/uploads/' . basename($filename);


                                                            $fileNew = "/wp-content/uploads/" . basename($filename);

                                                            $fileNew = cropImage($filename,
                                                                $_SERVER['DOCUMENT_ROOT'] . $fileNew,
                                                                328, 205);
                                                            ?>
                                                            <img
                                                                src="http://wpdemos.themezaa.com/h-code/wp-content/plugins/revslider/admin/assets/images/dummy.png"
                                                                alt="" data-ww="328px" data-hh="205px" width="328"
                                                                height="205"
                                                                data-lazyload="<?php echo $fileNew; ?>"
                                                                data-no-retina></div>
                                                        <div class="tp-caption   tp-resizeme" id="slide-91-layer-18"
                                                             data-x="right" data-hoffset="" data-y=""
                                                             data-width="['none','none','none','none']"
                                                             data-height="['none','none','none','none']"
                                                             data-type="image" data-responsive_offset="on"
                                                             data-frames='[{"from":"x:50px;opacity:0;","speed":1000,"to":"o:1;","delay":10500,"ease":"Power4.easeOut"},{"delay":7500,"speed":1000,"to":"x:50px;opacity:0;","ease":"Power4.easeIn"}]'
                                                             data-textAlign="['left','left','left','left']"
                                                             data-paddingtop="[0,0,0,0]" data-paddingright="[0,0,0,0]"
                                                             data-paddingbottom="[0,0,0,0]" data-paddingleft="[0,0,0,0]"
                                                             style="z-index: 22;text-transform:left;z-index:16;">
                                                            <?php
                                                            $filename = getRandomElement($arProjectImages);
                                                            $new_filen = $_SERVER["DOCUMENT_ROOT"].'/wp-content/uploads/' . basename($filename);


                                                            $fileNew = "/wp-content/uploads/" . basename($filename);

                                                            $fileNew = cropImage($filename,
                                                                $_SERVER['DOCUMENT_ROOT'] . $fileNew,
                                                                389, 481);
                                                            ?>
                                                            <img
                                                                src="http://wpdemos.themezaa.com/h-code/wp-content/plugins/revslider/admin/assets/images/dummy.png"
                                                                alt="" data-ww="389px" data-hh="481px" width="389"
                                                                height="481"
                                                                data-lazyload="<?php echo $fileNew; ?>"
                                                                data-no-retina></div>
                                                        <div class="tp-caption   tp-resizeme" id="slide-91-layer-19"
                                                             data-x="center" data-hoffset="-170" data-y="bottom"
                                                             data-voffset="-100"
                                                             data-width="['none','none','none','none']"
                                                             data-height="['none','none','none','none']"
                                                             data-type="image" data-responsive_offset="on"
                                                             data-frames='[{"from":"y:50px;opacity:0;","speed":1000,"to":"o:1;","delay":11500,"ease":"Power4.easeOut"},{"delay":6500,"speed":1000,"to":"y:50px;opacity:0;","ease":"Power4.easeIn"}]'
                                                             data-textAlign="['left','left','left','left']"
                                                             data-paddingtop="[0,0,0,0]" data-paddingright="[0,0,0,0]"
                                                             data-paddingbottom="[0,0,0,0]" data-paddingleft="[0,0,0,0]"
                                                             style="z-index: 23;text-transform:left;z-index:18;">
                                                            <?php
                                                            $filename = getRandomElement($arProjectImages);
                                                            $new_filen = $_SERVER["DOCUMENT_ROOT"].'/wp-content/uploads/' . basename($filename);


                                                            $fileNew = "/wp-content/uploads/" . basename($filename);

                                                            $fileNew = cropImage($filename,
                                                                $_SERVER['DOCUMENT_ROOT'] . $fileNew,
                                                                414, 391);
                                                            ?>
                                                            <img
                                                                src="http://wpdemos.themezaa.com/h-code/wp-content/plugins/revslider/admin/assets/images/dummy.png"
                                                                alt="" data-ww="414px" data-hh="391px" width="414"
                                                                height="391"
                                                                data-lazyload="<?php echo $fileNew; ?>"
                                                                data-no-retina></div>
                                                        <div class="tp-caption   tp-resizeme" id="slide-91-layer-20"
                                                             data-x="right" data-hoffset="-120" data-y="bottom"
                                                             data-voffset="-170"
                                                             data-width="['none','none','none','none']"
                                                             data-height="['none','none','none','none']"
                                                             data-type="image" data-responsive_offset="on"
                                                             data-frames='[{"from":"y:50px;opacity:0;","speed":1000,"to":"o:1;","delay":12500,"ease":"Power4.easeOut"},{"delay":5500,"speed":1000,"to":"y:50px;opacity:0;","ease":"Power4.easeIn"}]'
                                                             data-textAlign="['left','left','left','left']"
                                                             data-paddingtop="[0,0,0,0]" data-paddingright="[0,0,0,0]"
                                                             data-paddingbottom="[0,0,0,0]" data-paddingleft="[0,0,0,0]"
                                                             style="z-index: 24;text-transform:left;z-index:17;">
                                                            <?php
                                                            $filename = getRandomElement($arProjectImages);
                                                            $new_filen = $_SERVER["DOCUMENT_ROOT"].'/wp-content/uploads/' . basename($filename);


                                                            $fileNew = "/wp-content/uploads/" . basename($filename);

                                                            $fileNew = cropImage($filename,
                                                                $_SERVER['DOCUMENT_ROOT'] . $fileNew,
                                                                486, 566);
                                                            ?>
                                                            <img
                                                                src="http://wpdemos.themezaa.com/h-code/wp-content/plugins/revslider/admin/assets/images/dummy.png"
                                                                alt="" data-ww="486px" data-hh="566px" width="486"
                                                                height="566"
                                                                data-lazyload="<?php echo $fileNew; ?>"
                                                                data-no-retina></div>
                                                        <div class="tp-caption   tp-resizeme" id="slide-91-layer-21"
                                                             data-x="center" data-hoffset="150" data-y="bottom"
                                                             data-voffset="-50"
                                                             data-width="['none','none','none','none']"
                                                             data-height="['none','none','none','none']"
                                                             data-type="image" data-responsive_offset="on"
                                                             data-frames='[{"from":"y:50px;opacity:0;","speed":1000,"to":"o:1;","delay":13500,"ease":"Power4.easeOut"},{"delay":4500,"speed":1000,"to":"y:50px;opacity:0;","ease":"Power4.easeIn"}]'
                                                             data-textAlign="['left','left','left','left']"
                                                             data-paddingtop="[0,0,0,0]" data-paddingright="[0,0,0,0]"
                                                             data-paddingbottom="[0,0,0,0]" data-paddingleft="[0,0,0,0]"
                                                             style="z-index: 25;text-transform:left;z-index:18;">
                                                            <?php
                                                            $filename = getRandomElement($arProjectImages);
                                                            $new_filen = $_SERVER["DOCUMENT_ROOT"].'/wp-content/uploads/' . basename($filename);


                                                            $fileNew = "/wp-content/uploads/" . basename($filename);

                                                            $fileNew = cropImage($filename,
                                                                $_SERVER['DOCUMENT_ROOT'] . $fileNew,
                                                                414, 391);
                                                            ?>
                                                            <img
                                                                src="http://wpdemos.themezaa.com/h-code/wp-content/plugins/revslider/admin/assets/images/dummy.png"
                                                                alt="" data-ww="414px" data-hh="391px" width="414"
                                                                height="391"
                                                                data-lazyload="<?php echo $fileNew; ?>"
                                                                data-no-retina></div>
                                                        <div class="tp-caption   tp-resizeme" id="slide-91-layer-22"
                                                             data-x="center" data-hoffset="500" data-y="bottom"
                                                             data-voffset="-150"
                                                             data-width="['none','none','none','none']"
                                                             data-height="['none','none','none','none']"
                                                             data-type="image" data-responsive_offset="on"
                                                             data-frames='[{"from":"y:50px;opacity:0;","speed":1000,"to":"o:1;","delay":14500,"ease":"Power4.easeOut"},{"delay":3500,"speed":1000,"to":"y:50px;opacity:0;","ease":"Power4.easeIn"}]'
                                                             data-textAlign="['left','left','left','left']"
                                                             data-paddingtop="[0,0,0,0]" data-paddingright="[0,0,0,0]"
                                                             data-paddingbottom="[0,0,0,0]" data-paddingleft="[0,0,0,0]"
                                                             style="z-index: 26;text-transform:left;z-index:17;">
                                                            <?php
                                                            $filename = getRandomElement($arProjectImages);
                                                            $new_filen = $_SERVER["DOCUMENT_ROOT"].'/wp-content/uploads/' . basename($filename);


                                                            $fileNew = "/wp-content/uploads/" . basename($filename);

                                                            $fileNew = cropImage($filename,
                                                                $_SERVER['DOCUMENT_ROOT'] . $fileNew,
                                                                349, 358);
                                                            ?>
                                                            <img
                                                                src="http://wpdemos.themezaa.com/h-code/wp-content/plugins/revslider/admin/assets/images/dummy.png"
                                                                alt="" data-ww="349px" data-hh="358px" width="349"
                                                                height="358"
                                                                data-lazyload="<?php echo $fileNew; ?>"
                                                                data-no-retina></div>
                                                        <div class="tp-caption   tp-resizeme" id="slide-91-layer-23"
                                                             data-x="right" data-hoffset="-40" data-y="center"
                                                             data-voffset="-100"
                                                             data-width="['none','none','none','none']"
                                                             data-height="['none','none','none','none']"
                                                             data-type="image" data-responsive_offset="on"
                                                             data-frames='[{"from":"x:50px;opacity:0;","speed":1000,"to":"o:1;","delay":15500,"ease":"Power4.easeOut"},{"delay":2500,"speed":1000,"to":"x:50px;opacity:0;","ease":"Power4.easeIn"}]'
                                                             data-textAlign="['left','left','left','left']"
                                                             data-paddingtop="[0,0,0,0]" data-paddingright="[0,0,0,0]"
                                                             data-paddingbottom="[0,0,0,0]" data-paddingleft="[0,0,0,0]"
                                                             style="z-index: 27;text-transform:left;z-index:17;">
                                                            <?php
                                                            $filename = getRandomElement($arProjectImages);
                                                            $new_filen = $_SERVER["DOCUMENT_ROOT"].'/wp-content/uploads/' . basename($filename);


                                                            $fileNew = "/wp-content/uploads/" . basename($filename);

                                                            $fileNew = cropImage($filename,
                                                                $_SERVER['DOCUMENT_ROOT'] . $fileNew,
                                                                224, 255);
                                                            ?>
                                                            <img
                                                                src="http://wpdemos.themezaa.com/h-code/wp-content/plugins/revslider/admin/assets/images/dummy.png"
                                                                alt="" data-ww="224px" data-hh="255px" width="224"
                                                                height="255"
                                                                data-lazyload="<?php echo $fileNew; ?>"
                                                                data-no-retina></div>
                                                    </li>
                                                    <li data-index="rs-92" data-transition="fade" data-slotamount="1"
                                                        data-hideafterloop="0" data-hideslideonmobile="off"
                                                        data-easein="default" data-easeout="default"
                                                        data-masterspeed="500" data-delay="22000" data-rotate="0"
                                                        data-saveperformance="off" class="no-transition"
                                                        data-title="<?php displayRandomElement($arPostTagsNames); ?>" data-param1="" data-param2=""
                                                        data-param3="" data-param4="" data-param5="" data-param6=""
                                                        data-param7="" data-param8="" data-param9="" data-param10=""
                                                        data-description="">
                                                        <?php
                                                        $filename = getRandomElement($arProjectImages);
                                                        $new_filen = $_SERVER["DOCUMENT_ROOT"].'/wp-content/uploads/' . basename($filename);


                                                        $fileNew = "/wp-content/uploads/" . basename($filename);

                                                        $fileNew = cropImage($filename,
                                                            $_SERVER['DOCUMENT_ROOT'] . $fileNew,
                                                            10, 10);
                                                        ?>
                                                        <img
                                                            src="http://wpdemos.themezaa.com/h-code/wp-content/plugins/revslider/admin/assets/images/dummy.png"
                                                            alt="" title="dummy.png" width="10" height="10"
                                                            data-lazyload="<?php echo $fileNew; ?>"
                                                            data-bgposition="center center" data-bgfit="cover"
                                                            data-bgrepeat="no-repeat" class="rev-slidebg"
                                                            data-no-retina>
                                                        <div class="tp-caption   tp-resizeme" id="slide-92-layer-1"
                                                             data-x="center" data-hoffset="" data-y="bottom"
                                                             data-voffset="-70"
                                                             data-width="['none','none','none','none']"
                                                             data-height="['none','none','none','none']"
                                                             data-type="image" data-responsive_offset="on"
                                                             data-frames='[{"from":"y:bottom;","speed":1000,"to":"o:1;","delay":2000,"ease":"Power4.easeOut"},{"delay":18000,"speed":1000,"to":"y:bottom;","ease":"Power4.easeIn"}]'
                                                             data-textAlign="['left','left','left','left']"
                                                             data-paddingtop="[0,0,0,0]" data-paddingright="[0,0,0,0]"
                                                             data-paddingbottom="[0,0,0,0]" data-paddingleft="[0,0,0,0]"
                                                             style="z-index: 28;text-transform:left;z-index:2;">
                                                            <?php
                                                            $filename = getRandomElement($arProjectImages);
                                                            $new_filen = $_SERVER["DOCUMENT_ROOT"].'/wp-content/uploads/' . basename($filename);


                                                            $fileNew = "/wp-content/uploads/" . basename($filename);

                                                            $fileNew = cropImage($filename,
                                                                $_SERVER['DOCUMENT_ROOT'] . $fileNew,
                                                                1920, 580);
                                                            ?>
                                                            <img
                                                                src="http://wpdemos.themezaa.com/h-code/wp-content/plugins/revslider/admin/assets/images/dummy.png"
                                                                alt="" data-ww="1920px" data-hh="580px" width="1920"
                                                                height="580"
                                                                data-lazyload="<?php echo $fileNew; ?>"
                                                                data-no-retina></div>
                                                        <div class="tp-caption   tp-resizeme" id="slide-92-layer-2"
                                                             data-x="center" data-hoffset="" data-y="bottom"
                                                             data-voffset="-70"
                                                             data-width="['none','none','none','none']"
                                                             data-height="['none','none','none','none']"
                                                             data-type="image" data-responsive_offset="on"
                                                             data-frames='[{"from":"x:right;","speed":1000,"to":"o:1;","delay":2500,"ease":"Power4.easeOut"},{"delay":17500,"speed":1000,"to":"x:left;","ease":"Power4.easeIn"}]'
                                                             data-textAlign="['left','left','left','left']"
                                                             data-paddingtop="[0,0,0,0]" data-paddingright="[0,0,0,0]"
                                                             data-paddingbottom="[0,0,0,0]" data-paddingleft="[0,0,0,0]"
                                                             style="z-index: 29;text-transform:left;z-index:3;">
                                                            <?php
                                                            $filename = getRandomElement($arProjectImages);
                                                            $new_filen = $_SERVER["DOCUMENT_ROOT"].'/wp-content/uploads/' . basename($filename);


                                                            $fileNew = "/wp-content/uploads/" . basename($filename);

                                                            $fileNew = cropImage($filename,
                                                                $_SERVER['DOCUMENT_ROOT'] . $fileNew,
                                                                1920, 1025);
                                                            ?>
                                                            <img
                                                                src="http://wpdemos.themezaa.com/h-code/wp-content/plugins/revslider/admin/assets/images/dummy.png"
                                                                alt="" data-ww="1920px" data-hh="1025px" width="1920"
                                                                height="1025"
                                                                data-lazyload="<?php echo $fileNew; ?>"
                                                                data-no-retina></div>
                                                        <div class="tp-caption Fashion-BigDisplay   tp-resizeme"
                                                             id="slide-92-layer-3" data-x="center" data-hoffset=""
                                                             data-y="center" data-voffset="170" data-width="['auto']"
                                                             data-height="['auto']" data-type="text"
                                                             data-responsive_offset="on"
                                                             data-frames='[{"from":"y:50px;opacity:0;","speed":1000,"to":"o:1;","delay":3000,"ease":"Power4.easeOut"},{"delay":2400,"speed":600,"to":"y:50px;opacity:0;","ease":"Power4.easeIn"}]'
                                                             data-textAlign="['left','left','left','left']"
                                                             data-paddingtop="[0,0,0,0]" data-paddingright="[0,0,0,0]"
                                                             data-paddingbottom="[0,0,0,0]" data-paddingleft="[0,0,0,0]"
                                                             style="z-index: 30; white-space: nowrap; font-size: 120px; font-weight: 400; color: rgba(197,157,95,1);font-family:Great Vibes;text-transform:left;z-index:4;text-align:center;position:absolute;margin:0px;white-space:nowrap;letter-spacing:2px;">
                                                            <?php echo $arProject["post_title"];?>
                                                        </div>
                                                        <div class="tp-caption Fashion-BigDisplay   tp-resizeme"
                                                             id="slide-92-layer-4" data-x="center" data-hoffset=""
                                                             data-y="center" data-voffset="235" data-width="['auto']"
                                                             data-height="['auto']" data-type="text"
                                                             data-responsive_offset="on"
                                                             data-frames='[{"from":"y:50px;opacity:0;","speed":1000,"to":"o:1;","delay":3500,"ease":"Power4.easeOut"},{"delay":1900,"speed":600,"to":"y:50px;opacity:0;","ease":"Power4.easeIn"}]'
                                                             data-textAlign="['left','left','left','left']"
                                                             data-paddingtop="[0,0,0,0]" data-paddingright="[0,0,0,0]"
                                                             data-paddingbottom="[0,0,0,0]" data-paddingleft="[0,0,0,0]"
                                                             style="z-index: 31; white-space: nowrap; font-size: 70px; font-weight: 800;font-family:Open Sans;text-transform:uppercase;text-decoration:none;z-index:4;text-align:center;letter-spacing:10px;">
                                                            <?php echo implode("  ", $arPostTagsNames); ?>
                                                        </div>
                                                        <div class="tp-caption Fashion-BigDisplay   tp-resizeme"
                                                             id="slide-92-layer-5" data-x="center" data-hoffset=""
                                                             data-y="center" data-voffset="300" data-width="['auto']"
                                                             data-height="['auto']" data-type="text"
                                                             data-responsive_offset="on"
                                                             data-frames='[{"from":"y:50px;opacity:0;","speed":600,"to":"o:1;","delay":4000,"ease":"Power4.easeOut"},{"delay":1800,"speed":600,"to":"y:50px;opacity:0;","ease":"Power4.easeIn"}]'
                                                             data-textAlign="['left','left','left','left']"
                                                             data-paddingtop="[0,0,0,0]" data-paddingright="[0,0,0,0]"
                                                             data-paddingbottom="[0,0,0,0]" data-paddingleft="[0,0,0,0]"
                                                             style="z-index: 32; white-space: nowrap; font-size: 70px; font-weight: 800; color: rgba(255,255,255,1);font-family:Open Sans;text-transform:left;background-color:#c59d5f;z-index:4;height:3px;">
                                                            <div class="separator-line"></div>
                                                        </div>
                                                        <div class="tp-caption Fashion-BigDisplay   tp-resizeme"
                                                             id="slide-92-layer-6" data-x="center" data-hoffset=""
                                                             data-y="center" data-voffset="360" data-width="['auto']"
                                                             data-height="['auto']" data-type="text"
                                                             data-responsive_offset="on"
                                                             data-frames='[{"from":"y:50px;opacity:0;","speed":600,"to":"o:1;","delay":4500,"ease":"Power4.easeOut"},{"delay":1300,"speed":600,"to":"y:50px;opacity:0;","ease":"Power4.easeIn"}]'
                                                             data-textAlign="['left','left','left','left']"
                                                             data-paddingtop="[0,0,0,0]" data-paddingright="[0,0,0,0]"
                                                             data-paddingbottom="[0,0,0,0]" data-paddingleft="[0,0,0,0]"
                                                             style="z-index: 33; white-space: nowrap; font-size: 16px; line-height: 22px; font-weight: 400;font-family:Open Sans;text-transform:left;text-decoration:none;z-index:4;text-align:center;letter-spacing:normal;">
                                                            <?php echo $arProject["post_content_formatted"];?>
                                                        </div>
                                                        <div class="tp-caption Fashion-BigDisplay   tp-resizeme"
                                                             id="slide-92-layer-7" data-x="250" data-y="center"
                                                             data-voffset="110" data-width="['auto']"
                                                             data-height="['auto']" data-type="text"
                                                             data-responsive_offset="on"
                                                             data-frames='[{"from":"y:50px;opacity:0;","speed":1000,"to":"o:1;","delay":8000,"ease":"Power4.easeOut"},{"delay":12400,"speed":600,"to":"y:50px;opacity:0;","ease":"Power4.easeIn"}]'
                                                             data-textAlign="['left','left','left','left']"
                                                             data-paddingtop="[0,0,0,0]" data-paddingright="[0,0,0,0]"
                                                             data-paddingbottom="[0,0,0,0]" data-paddingleft="[0,0,0,0]"
                                                             style="z-index: 34; white-space: nowrap; font-size: 70px; font-weight: 400;font-family:Great Vibes;text-transform:left;z-index:4;text-align:center;position:absolute;margin:0px;white-space:nowrap;letter-spacing:2px;">
                                                            <?php echo $ProjectCLIENT; ?>
                                                        </div>
                                                        <div class="tp-caption   tp-resizeme" id="slide-92-layer-8"
                                                             data-x="right" data-hoffset="250" data-y="center"
                                                             data-voffset="260"
                                                             data-width="['none','none','none','none']"
                                                             data-height="['none','none','none','none']"
                                                             data-type="image" data-responsive_offset="on"
                                                             data-frames='[{"from":"y:50px;opacity:0;","speed":1000,"to":"o:1;","delay":9000,"ease":"Power4.easeOut"},{"delay":11400,"speed":600,"to":"y:50px;opacity:0;","ease":"Power4.easeIn"}]'
                                                             data-textAlign="['left','left','left','left']"
                                                             data-paddingtop="[0,0,0,0]" data-paddingright="[0,0,0,0]"
                                                             data-paddingbottom="[0,0,0,0]" data-paddingleft="[0,0,0,0]"
                                                             style="z-index: 35;text-transform:left;z-index:4;">
                                                            <?php
                                                            $filename = getRandomElement($arProjectImages);
                                                            $new_filen = $_SERVER["DOCUMENT_ROOT"].'/wp-content/uploads/' . basename($filename);


                                                            $fileNew = "/wp-content/uploads/" . basename($filename);

                                                            $fileNew = cropImage($filename,
                                                                $_SERVER['DOCUMENT_ROOT'] . $fileNew,
                                                                589, 324);
                                                            ?>
                                                            <img
                                                                src="http://wpdemos.themezaa.com/h-code/wp-content/plugins/revslider/admin/assets/images/dummy.png"
                                                                alt="" data-ww="589px" data-hh="324px" width="589"
                                                                height="324"
                                                                data-lazyload="<?php echo $fileNew; ?>"
                                                                data-no-retina></div>
                                                        <div class="tp-caption Fashion-BigDisplay   tp-resizeme"
                                                             id="slide-92-layer-9" data-x="250" data-y="center"
                                                             data-voffset="240" data-width="['auto']"
                                                             data-height="['auto']" data-type="text"
                                                             data-responsive_offset="on"
                                                             data-frames='[{"from":"y:50px;opacity:0;","speed":1000,"to":"o:1;","delay":10000,"ease":"Power4.easeOut"},{"delay":10400,"speed":600,"to":"y:50px;opacity:0;","ease":"Power4.easeIn"}]'
                                                             data-textAlign="['left','left','left','left']"
                                                             data-paddingtop="[0,0,0,0]" data-paddingright="[0,0,0,0]"
                                                             data-paddingbottom="[0,0,0,0]" data-paddingleft="[0,0,0,0]"
                                                             style="z-index: 36; white-space: nowrap; font-size: 16px; line-height: 22px; font-weight: 400;font-family:Open Sans;text-transform:left;text-decoration:none;z-index:4;letter-spacing:normal;">
                                                            <?php echo $ProjectTYPE; ?>
                                                        </div>
                                                        <div class="tp-caption Fashion-BigDisplay   tp-resizeme"
                                                             id="slide-92-layer-10" data-x="250" data-y="center"
                                                             data-voffset="355" data-width="['auto']"
                                                             data-height="['auto']" data-type="text"
                                                             data-responsive_offset="on"
                                                             data-frames='[{"from":"y:50px;opacity:0;","speed":1000,"to":"o:1;","delay":11000,"ease":"Power4.easeOut"},{"delay":9400,"speed":600,"to":"y:50px;opacity:0;","ease":"Power4.easeIn"}]'
                                                             data-textAlign="['left','left','left','left']"
                                                             data-paddingtop="[0,0,0,0]" data-paddingright="[0,0,0,0]"
                                                             data-paddingbottom="[0,0,0,0]" data-paddingleft="[0,0,0,0]"
                                                             style="z-index: 37; white-space: nowrap; font-size: 18px; font-weight: 700;font-family:Playfair Display;text-transform:left;z-index:4;position:absolute;margin:0px;white-space:nowrap;">
                                                            <?php echo $YEAR; ?>
                                                        </div>
                                                        <div class="tp-caption Fashion-BigDisplay   tp-resizeme"
                                                             id="slide-92-layer-11" data-x="250" data-y="center"
                                                             data-voffset="385" data-width="['auto']"
                                                             data-height="['auto']" data-type="text"
                                                             data-responsive_offset="on"
                                                             data-frames='[{"from":"y:50px;opacity:0;","speed":1000,"to":"o:1;","delay":12000,"ease":"Power4.easeOut"},{"delay":8400,"speed":600,"to":"y:50px;opacity:0;","ease":"Power4.easeIn"}]'
                                                             data-textAlign="['left','left','left','left']"
                                                             data-paddingtop="[0,0,0,0]" data-paddingright="[0,0,0,0]"
                                                             data-paddingbottom="[0,0,0,0]" data-paddingleft="[0,0,0,0]"
                                                             style="z-index: 38; white-space: nowrap; font-size: 18px; line-height: 30px; font-weight: 400; color: rgba(140,97,31,1);font-family:Open Sans;text-transform:left;z-index:4;position:absolute;margin:0px;white-space:nowrap;letter-spacing:normal;">
                                                            <?php displayRandomElement($arPostTagsNames); ?>
                                                        </div>
                                                    </li>
                                                    <li data-index="rs-93" data-transition="fade" data-slotamount="1"
                                                        data-hideafterloop="0" data-hideslideonmobile="off"
                                                        data-easein="default" data-easeout="default"
                                                        data-masterspeed="500" data-delay="12000" data-rotate="0"
                                                        data-saveperformance="off" class="no-transition"
                                                        data-title="<?php displayRandomElement($arPostTagsNames); ?>" data-param1="" data-param2=""
                                                        data-param3="" data-param4="" data-param5="" data-param6=""
                                                        data-param7="" data-param8="" data-param9="" data-param10=""
                                                        data-description="">
                                                        <?php
                                                        $filename = getRandomElement($arProjectImages);
                                                        $new_filen = $_SERVER["DOCUMENT_ROOT"].'/wp-content/uploads/' . basename($filename);


                                                        $fileNew = "/wp-content/uploads/" . basename($filename);

                                                        $fileNew = cropImage($filename,
                                                            $_SERVER['DOCUMENT_ROOT'] . $fileNew,
                                                            10, 10);
                                                        ?>
                                                        <img
                                                            src="http://wpdemos.themezaa.com/h-code/wp-content/plugins/revslider/admin/assets/images/dummy.png"
                                                            alt="" title="dummy.png" width="10" height="10"
                                                            data-lazyload="<?php echo $fileNew; ?>"
                                                            data-bgposition="center center" data-bgfit="cover"
                                                            data-bgrepeat="no-repeat" class="rev-slidebg"
                                                            data-no-retina>
                                                        <div class="tp-caption   tp-resizeme" id="slide-93-layer-1"
                                                             data-x="center" data-hoffset="-628" data-y="center"
                                                             data-voffset="" data-width="['none','none','none','none']"
                                                             data-height="['none','none','none','none']"
                                                             data-type="image" data-responsive_offset="on"
                                                             data-frames='[{"from":"y:top;","speed":1000,"to":"o:1;","delay":2000,"ease":"Power4.easeOut"},{"delay":8000,"speed":1000,"to":"y:bottom;","ease":"Power4.easeIn"}]'
                                                             data-textAlign="['left','left','left','left']"
                                                             data-paddingtop="[0,0,0,0]" data-paddingright="[0,0,0,0]"
                                                             data-paddingbottom="[0,0,0,0]" data-paddingleft="[0,0,0,0]"
                                                             style="z-index: 39;text-transform:left;z-index:3;">
                                                            <?php
                                                            $filename = getRandomElement($arProjectImages);
                                                            $new_filen = $_SERVER["DOCUMENT_ROOT"].'/wp-content/uploads/' . basename($filename);


                                                            $fileNew = "/wp-content/uploads/" . basename($filename);

                                                            $fileNew = cropImage($filename,
                                                                $_SERVER['DOCUMENT_ROOT'] . $fileNew,
                                                                600, 921);
                                                            ?>
                                                            <img
                                                                src="http://wpdemos.themezaa.com/h-code/wp-content/plugins/revslider/admin/assets/images/dummy.png"
                                                                alt="" data-ww="600px" data-hh="921px" width="600"
                                                                height="921"
                                                                data-lazyload="<?php echo $fileNew; ?>"
                                                                data-no-retina></div>
                                                        <div class="tp-caption   tp-resizeme" id="slide-93-layer-2"
                                                             data-x="center" data-hoffset="" data-y="center"
                                                             data-voffset="" data-width="['none','none','none','none']"
                                                             data-height="['none','none','none','none']"
                                                             data-type="image" data-responsive_offset="on"
                                                             data-frames='[{"from":"y:bottom;","speed":1000,"to":"o:1;","delay":3000,"ease":"Power4.easeOut"},{"delay":7000,"speed":1000,"to":"y:top;","ease":"Power4.easeIn"}]'
                                                             data-textAlign="['left','left','left','left']"
                                                             data-paddingtop="[0,0,0,0]" data-paddingright="[0,0,0,0]"
                                                             data-paddingbottom="[0,0,0,0]" data-paddingleft="[0,0,0,0]"
                                                             style="z-index: 40;text-transform:left;z-index:3;">
                                                            <?php
                                                            $filename = getRandomElement($arProjectImages);
                                                            $new_filen = $_SERVER["DOCUMENT_ROOT"].'/wp-content/uploads/' . basename($filename);


                                                            $fileNew = "/wp-content/uploads/" . basename($filename);

                                                            $fileNew = cropImage($filename,
                                                                $_SERVER['DOCUMENT_ROOT'] . $fileNew,
                                                                600, 921);
                                                            ?>
                                                            <img
                                                                src="http://wpdemos.themezaa.com/h-code/wp-content/plugins/revslider/admin/assets/images/dummy.png"
                                                                alt="" data-ww="600px" data-hh="921px" width="600"
                                                                height="921"
                                                                data-lazyload="<?php echo $fileNew; ?>"
                                                                data-no-retina></div>
                                                        <div class="tp-caption   tp-resizeme" id="slide-93-layer-3"
                                                             data-x="center" data-hoffset="628" data-y="center"
                                                             data-voffset="" data-width="['none','none','none','none']"
                                                             data-height="['none','none','none','none']"
                                                             data-type="image" data-responsive_offset="on"
                                                             data-frames='[{"from":"y:top;","speed":1000,"to":"o:1;","delay":4000,"ease":"Power4.easeOut"},{"delay":6000,"speed":1000,"to":"y:bottom;","ease":"Power4.easeIn"}]'
                                                             data-textAlign="['left','left','left','left']"
                                                             data-paddingtop="[0,0,0,0]" data-paddingright="[0,0,0,0]"
                                                             data-paddingbottom="[0,0,0,0]" data-paddingleft="[0,0,0,0]"
                                                             style="z-index: 41;text-transform:left;z-index:3;">
                                                            <?php
                                                            $filename = getRandomElement($arProjectImages);
                                                            $new_filen = $_SERVER["DOCUMENT_ROOT"].'/wp-content/uploads/' . basename($filename);


                                                            $fileNew = "/wp-content/uploads/" . basename($filename);

                                                            $fileNew = cropImage($filename,
                                                                $_SERVER['DOCUMENT_ROOT'] . $fileNew,
                                                                600, 921);
                                                            ?>
                                                            <img
                                                                src="http://wpdemos.themezaa.com/h-code/wp-content/plugins/revslider/admin/assets/images/dummy.png"
                                                                alt="" data-ww="600px" data-hh="921px" width="600"
                                                                height="921"
                                                                data-lazyload="<?php echo $fileNew; ?>"
                                                                data-no-retina></div>
                                                        <div class="tp-caption   tp-resizeme" id="slide-93-layer-4"
                                                             data-x="center" data-hoffset="-628" data-y="center"
                                                             data-voffset="" data-width="['none','none','none','none']"
                                                             data-height="['none','none','none','none']"
                                                             data-type="image" data-responsive_offset="on"
                                                             data-frames='[{"from":"y:bottom;","speed":1000,"to":"o:1;","delay":7000,"ease":"Power4.easeOut"},{"delay":3000,"speed":1000,"to":"y:top;","ease":"Power4.easeIn"}]'
                                                             data-textAlign="['left','left','left','left']"
                                                             data-paddingtop="[0,0,0,0]" data-paddingright="[0,0,0,0]"
                                                             data-paddingbottom="[0,0,0,0]" data-paddingleft="[0,0,0,0]"
                                                             style="z-index: 42;text-transform:left;z-index:3;">
                                                            <?php
                                                            $filename = getRandomElement($arProjectImages);
                                                            $new_filen = $_SERVER["DOCUMENT_ROOT"].'/wp-content/uploads/' . basename($filename);


                                                            $fileNew = "/wp-content/uploads/" . basename($filename);

                                                            $fileNew = cropImage($filename,
                                                                $_SERVER['DOCUMENT_ROOT'] . $fileNew,
                                                                600, 921);
                                                            ?>
                                                            <img
                                                                src="http://wpdemos.themezaa.com/h-code/wp-content/plugins/revslider/admin/assets/images/dummy.png"
                                                                alt="" data-ww="600px" data-hh="921px" width="600"
                                                                height="921"
                                                                data-lazyload="<?php echo $fileNew; ?>"
                                                                data-no-retina></div>
                                                        <div class="tp-caption   tp-resizeme" id="slide-93-layer-5"
                                                             data-x="center" data-hoffset="" data-y="center"
                                                             data-voffset="" data-width="['none','none','none','none']"
                                                             data-height="['none','none','none','none']"
                                                             data-type="image" data-responsive_offset="on"
                                                             data-frames='[{"from":"y:top;","speed":1000,"to":"o:1;","delay":6000,"ease":"Power4.easeOut"},{"delay":4000,"speed":1000,"to":"y:bottom;","ease":"Power4.easeIn"}]'
                                                             data-textAlign="['left','left','left','left']"
                                                             data-paddingtop="[0,0,0,0]" data-paddingright="[0,0,0,0]"
                                                             data-paddingbottom="[0,0,0,0]" data-paddingleft="[0,0,0,0]"
                                                             style="z-index: 43;text-transform:left;z-index:3;">
                                                            <?php
                                                            $filename = getRandomElement($arProjectImages);
                                                            $new_filen = $_SERVER["DOCUMENT_ROOT"].'/wp-content/uploads/' . basename($filename);


                                                            $fileNew = "/wp-content/uploads/" . basename($filename);

                                                            $fileNew = cropImage($filename,
                                                                $_SERVER['DOCUMENT_ROOT'] . $fileNew,
                                                                600, 921);
                                                            ?>
                                                            <img
                                                                src="http://wpdemos.themezaa.com/h-code/wp-content/plugins/revslider/admin/assets/images/dummy.png"
                                                                alt="" data-ww="600px" data-hh="921px" width="600"
                                                                height="921"
                                                                data-lazyload="<?php echo $fileNew; ?>"
                                                                data-no-retina></div>
                                                        <div class="tp-caption   tp-resizeme" id="slide-93-layer-6"
                                                             data-x="center" data-hoffset="628" data-y="center"
                                                             data-voffset="" data-width="['none','none','none','none']"
                                                             data-height="['none','none','none','none']"
                                                             data-type="image" data-responsive_offset="on"
                                                             data-frames='[{"from":"y:bottom;","speed":1000,"to":"o:1;","delay":5000,"ease":"Power4.easeOut"},{"delay":5000,"speed":1000,"to":"y:top;","ease":"Power4.easeIn"}]'
                                                             data-textAlign="['left','left','left','left']"
                                                             data-paddingtop="[0,0,0,0]" data-paddingright="[0,0,0,0]"
                                                             data-paddingbottom="[0,0,0,0]" data-paddingleft="[0,0,0,0]"
                                                             style="z-index: 44;text-transform:left;z-index:3;">
                                                            <?php
                                                            $filename = getRandomElement($arProjectImages);
                                                            $new_filen = $_SERVER["DOCUMENT_ROOT"].'/wp-content/uploads/' . basename($filename);


                                                            $fileNew = "/wp-content/uploads/" . basename($filename);

                                                            $fileNew = cropImage($filename,
                                                                $_SERVER['DOCUMENT_ROOT'] . $fileNew,
                                                                600, 921);
                                                            ?>
                                                            <img
                                                                src="http://wpdemos.themezaa.com/h-code/wp-content/plugins/revslider/admin/assets/images/dummy.png"
                                                                alt="" data-ww="600px" data-hh="921px" width="600"
                                                                height="921"
                                                                data-lazyload="<?php echo $fileNew; ?>"
                                                                data-no-retina></div>
                                                        <div class="tp-caption Fashion-BigDisplay   tp-resizeme"
                                                             id="slide-93-layer-7" data-x="center" data-hoffset="-628"
                                                             data-y="center" data-voffset="400" data-width="['auto']"
                                                             data-height="['auto']" data-type="text"
                                                             data-responsive_offset="on"
                                                             data-frames='[{"from":"y:-50px;opacity:0;","speed":1000,"to":"o:1;","delay":8000,"ease":"Power4.easeOut"},{"delay":2000,"speed":1000,"to":"y:50px;opacity:0;","ease":"Power4.easeIn"}]'
                                                             data-textAlign="['left','left','left','left']"
                                                             data-paddingtop="[0,0,0,0]" data-paddingright="[0,0,0,0]"
                                                             data-paddingbottom="[0,0,0,0]" data-paddingleft="[0,0,0,0]"
                                                             style="z-index: 45; white-space: nowrap; font-size: 40px; line-height: 40px; font-weight: 700; color: rgba(255,255,255,1);font-family:Open Sans;text-transform:uppercase;text-decoration:none;z-index:4;letter-spacing:4px;">
                                                            <?php displayRandomElement($arPostTagsNames); ?>
                                                        </div>
                                                        <div class="tp-caption Fashion-BigDisplay   tp-resizeme"
                                                             id="slide-93-layer-8" data-x="center" data-hoffset=""
                                                             data-y="center" data-voffset="400" data-width="['auto']"
                                                             data-height="['auto']" data-type="text"
                                                             data-responsive_offset="on"
                                                             data-frames='[{"from":"y:-50px;opacity:0;","speed":1000,"to":"o:1;","delay":9000,"ease":"Power4.easeOut"},{"delay":1000,"speed":1000,"to":"y:50px;opacity:0;","ease":"Power4.easeIn"}]'
                                                             data-textAlign="['left','left','left','left']"
                                                             data-paddingtop="[0,0,0,0]" data-paddingright="[0,0,0,0]"
                                                             data-paddingbottom="[0,0,0,0]" data-paddingleft="[0,0,0,0]"
                                                             style="z-index: 46; white-space: nowrap; font-size: 40px; line-height: 40px; font-weight: 700; color: rgba(255,255,255,1);font-family:Open Sans;text-transform:uppercase;text-decoration:none;z-index:4;letter-spacing:4px;">
                                                            <?php displayRandomElement($arPostTagsNames); ?>
                                                        </div>
                                                        <div class="tp-caption Fashion-BigDisplay   tp-resizeme"
                                                             id="slide-93-layer-9" data-x="center" data-hoffset="628"
                                                             data-y="center" data-voffset="400" data-width="['auto']"
                                                             data-height="['auto']" data-type="text"
                                                             data-responsive_offset="on"
                                                             data-frames='[{"from":"y:-50px;opacity:0;","speed":1000,"to":"o:1;","delay":10000,"ease":"Power4.easeOut"},{"speed":1000,"to":"y:50px;opacity:0;","ease":"Power4.easeIn"}]'
                                                             data-textAlign="['left','left','left','left']"
                                                             data-paddingtop="[0,0,0,0]" data-paddingright="[0,0,0,0]"
                                                             data-paddingbottom="[0,0,0,0]" data-paddingleft="[0,0,0,0]"
                                                             style="z-index: 47; white-space: nowrap; font-size: 40px; line-height: 40px; font-weight: 700; color: rgba(255,255,255,1);font-family:Open Sans;text-transform:uppercase;text-decoration:none;z-index:4;letter-spacing:4px;">
                                                            <?php displayRandomElement($arPostTagsNames); ?>
                                                        </div>
                                                    </li>
                                                    <li data-index="rs-94" data-transition="fade" data-slotamount="1"
                                                        data-hideafterloop="0" data-hideslideonmobile="off"
                                                        data-easein="default" data-easeout="default"
                                                        data-masterspeed="500" data-delay="18000" data-rotate="0"
                                                        data-saveperformance="off" class="no-transition"
                                                        data-title="THANK YOU" data-param1="" data-param2=""
                                                        data-param3="" data-param4="" data-param5="" data-param6=""
                                                        data-param7="" data-param8="" data-param9="" data-param10=""
                                                        data-description="">
                                                        <?php
                                                        $filename = getRandomElement($arProjectImages);
                                                        $new_filen = $_SERVER["DOCUMENT_ROOT"].'/wp-content/uploads/' . basename($filename);


                                                        $fileNew = "/wp-content/uploads/" . basename($filename);

                                                        $fileNew = cropImage($filename,
                                                            $_SERVER['DOCUMENT_ROOT'] . $fileNew,
                                                            2100, 1200);
                                                        ?>
                                                        <img
                                                            src="http://wpdemos.themezaa.com/h-code/wp-content/plugins/revslider/admin/assets/images/dummy.png"
                                                            alt="" title="intro-restaurant-04-01.jpg" width="2100"
                                                            height="1200"
                                                            data-lazyload="<?php echo $fileNew; ?>"
                                                            data-bgposition="center center" data-bgfit="cover"
                                                            data-bgrepeat="no-repeat" class="rev-slidebg"
                                                            data-no-retina>
                                                        <div class="tp-caption Fashion-BigDisplay   tp-resizeme"
                                                             id="slide-94-layer-1" data-x="center" data-hoffset=""
                                                             data-y="center" data-voffset="-350" data-width="['auto']"
                                                             data-height="['auto']" data-type="text"
                                                             data-responsive_offset="on"
                                                             data-frames='[{"from":"y:top;","speed":1000,"to":"o:1;","delay":1500,"ease":"Power4.easeOut"},{"delay":14500,"speed":1000,"to":"y:top;","ease":"Power4.easeIn"}]'
                                                             data-textAlign="['left','left','left','left']"
                                                             data-paddingtop="[0,0,0,0]" data-paddingright="[0,0,0,0]"
                                                             data-paddingbottom="[0,0,0,0]" data-paddingleft="[0,0,0,0]"
                                                             style="z-index: 48; white-space: nowrap; font-size: 45px; line-height: 40px; font-weight: 700; color: rgba(197,157,95,1);font-family:Open Sans;text-transform:uppercase;text-decoration:none;z-index:3;letter-spacing:10px;">
                                                            <?php displayRandomElement($arPostTagsNames); ?>
                                                        </div>
                                                        <div class="tp-caption Fashion-BigDisplay   tp-resizeme"
                                                             id="slide-94-layer-2" data-x="center" data-hoffset=""
                                                             data-y="center" data-voffset="-300" data-width="['auto']"
                                                             data-height="['auto']" data-type="text"
                                                             data-responsive_offset="on"
                                                             data-frames='[{"from":"y:50px;opacity:0;","speed":600,"to":"o:1;","delay":2000,"ease":"Power4.easeOut"},{"delay":14400,"speed":1000,"to":"y:50px;opacity:0;","ease":"Power4.easeIn"}]'
                                                             data-textAlign="['left','left','left','left']"
                                                             data-paddingtop="[0,0,0,0]" data-paddingright="[0,0,0,0]"
                                                             data-paddingbottom="[0,0,0,0]" data-paddingleft="[0,0,0,0]"
                                                             style="z-index: 49; white-space: nowrap; font-size: 70px; font-weight: 800; color: rgba(255,255,255,1);font-family:'Open Sans',sans-serif;text-transform:left;background-color:#c59d5f;z-index:4;height:3px;">
                                                            <div class="separator-line"></div>
                                                        </div>
                                                        <div class="tp-caption   tp-resizeme" id="slide-94-layer-3"
                                                             data-x="200" data-y="center" data-voffset="-100"
                                                             data-width="['none','none','none','none']"
                                                             data-height="['none','none','none','none']"
                                                             data-type="image" data-responsive_offset="on"
                                                             data-frames='[{"from":"y:50px;opacity:0;","speed":600,"to":"o:1;","delay":2500,"ease":"Power4.easeOut"},{"delay":13900,"speed":1000,"to":"y:50px;opacity:0;","ease":"Power4.easeIn"}]'
                                                             data-textAlign="['left','left','left','left']"
                                                             data-paddingtop="[0,0,0,0]" data-paddingright="[0,0,0,0]"
                                                             data-paddingbottom="[0,0,0,0]" data-paddingleft="[0,0,0,0]"
                                                             style="z-index: 50;text-transform:left;z-index:4;">
                                                            <?php
                                                            $filename = getRandomElement($arProjectImages);
                                                            $new_filen = $_SERVER["DOCUMENT_ROOT"].'/wp-content/uploads/' . basename($filename);


                                                            $fileNew = "/wp-content/uploads/" . basename($filename);

                                                            $fileNew = cropImage($filename,
                                                                $_SERVER['DOCUMENT_ROOT'] . $fileNew,
                                                                92, 92);
                                                            ?>
                                                            <img
                                                                src="http://wpdemos.themezaa.com/h-code/wp-content/plugins/revslider/admin/assets/images/dummy.png"
                                                                alt="" data-ww="92px" data-hh="92px" width="92"
                                                                height="92"
                                                                data-lazyload="<?php echo $fileNew; ?>"
                                                                data-no-retina></div>
                                                        <div class="tp-caption Fashion-BigDisplay   tp-resizeme"
                                                             id="slide-94-layer-4" data-x="330" data-y="center"
                                                             data-voffset="-135" data-width="['auto']"
                                                             data-height="['auto']" data-type="text"
                                                             data-responsive_offset="on"
                                                             data-frames='[{"from":"y:50px;opacity:0;","speed":1000,"to":"o:1;","delay":3000,"ease":"Power4.easeOut"},{"delay":13000,"speed":1000,"to":"y:50px;opacity:0;","ease":"Power4.easeIn"}]'
                                                             data-textAlign="['left','left','left','left']"
                                                             data-paddingtop="[0,0,0,0]" data-paddingright="[0,0,0,0]"
                                                             data-paddingbottom="[0,0,0,0]" data-paddingleft="[0,0,0,0]"
                                                             style="z-index: 51; white-space: nowrap; font-size: 20px; line-height: 30px; font-weight: 700;font-family:Open Sans;text-transform:uppercase;text-decoration:none;z-index:4;letter-spacing:normal;">
                                                            <?php displayRandomElement($arPostTagsNames); ?>
                                                        </div>
                                                        <div class="tp-caption Fashion-BigDisplay   tp-resizeme"
                                                             id="slide-94-layer-5" data-x="330" data-y="center"
                                                             data-voffset="-80" data-width="['auto']"
                                                             data-height="['auto']" data-type="text"
                                                             data-responsive_offset="on"
                                                             data-frames='[{"from":"y:50px;opacity:0;","speed":1000,"to":"o:1;","delay":3500,"ease":"Power4.easeOut"},{"delay":12500,"speed":1000,"to":"y:50px;opacity:0;","ease":"Power4.easeIn"}]'
                                                             data-textAlign="['left','left','left','left']"
                                                             data-paddingtop="[0,0,0,0]" data-paddingright="[0,0,0,0]"
                                                             data-paddingbottom="[0,0,0,0]" data-paddingleft="[0,0,0,0]"
                                                             style="z-index: 52; white-space: nowrap; font-size: 13px; line-height: 18px; font-weight: 400;font-family:Open Sans;text-transform:left;text-decoration:none;z-index:4;letter-spacing:normal;">
                                                            <?php displayRandomElement($arPostTagsNames); ?>
                                                        </div>
                                                        <div class="tp-caption   tp-resizeme" id="slide-94-layer-6"
                                                             data-x="right" data-hoffset="100" data-y="center"
                                                             data-voffset="70"
                                                             data-width="['none','none','none','none']"
                                                             data-height="['none','none','none','none']"
                                                             data-type="image" data-responsive_offset="on"
                                                             data-frames='[{"from":"y:50px;opacity:0;","speed":1000,"to":"o:1;","delay":4000,"ease":"Power4.easeOut"},{"speed":1000,"to":"y:50px;opacity:0;","ease":"Power4.easeIn"}]'
                                                             data-textAlign="['left','left','left','left']"
                                                             data-paddingtop="[0,0,0,0]" data-paddingright="[0,0,0,0]"
                                                             data-paddingbottom="[0,0,0,0]" data-paddingleft="[0,0,0,0]"
                                                             style="z-index: 53;text-transform:left;z-index:4;">
                                                            <?php
                                                            $filename = getRandomElement($arProjectImages);
                                                            $new_filen = $_SERVER["DOCUMENT_ROOT"].'/wp-content/uploads/' . basename($filename);


                                                            $fileNew = "/wp-content/uploads/" . basename($filename);

                                                            $fileNew = cropImage($filename,
                                                                $_SERVER['DOCUMENT_ROOT'] . $fileNew,
                                                                837, 412);
                                                            ?>
                                                            <img
                                                                src="http://wpdemos.themezaa.com/h-code/wp-content/plugins/revslider/admin/assets/images/dummy.png"
                                                                alt="" data-ww="837px" data-hh="412px" width="837"
                                                                height="412"
                                                                data-lazyload="<?php echo $fileNew; ?>"
                                                                data-no-retina></div>
                                                        <div class="tp-caption   tp-resizeme" id="slide-94-layer-7"
                                                             data-x="200" data-y="center" data-voffset="50"
                                                             data-width="['none','none','none','none']"
                                                             data-height="['none','none','none','none']"
                                                             data-type="image" data-responsive_offset="on"
                                                             data-frames='[{"from":"y:50px;opacity:0;","speed":600,"to":"o:1;","delay":7000,"ease":"Power4.easeOut"},{"delay":9400,"speed":1000,"to":"y:50px;opacity:0;","ease":"Power4.easeIn"}]'
                                                             data-textAlign="['left','left','left','left']"
                                                             data-paddingtop="[0,0,0,0]" data-paddingright="[0,0,0,0]"
                                                             data-paddingbottom="[0,0,0,0]" data-paddingleft="[0,0,0,0]"
                                                             style="z-index: 54;text-transform:left;z-index:4;">
                                                            <?php
                                                            $filename = getRandomElement($arProjectImages);
                                                            $new_filen = $_SERVER["DOCUMENT_ROOT"].'/wp-content/uploads/' . basename($filename);


                                                            $fileNew = "/wp-content/uploads/" . basename($filename);

                                                            $fileNew = cropImage($filename,
                                                                $_SERVER['DOCUMENT_ROOT'] . $fileNew,
                                                                92, 92);
                                                            ?>
                                                            <img
                                                                src="http://wpdemos.themezaa.com/h-code/wp-content/plugins/revslider/admin/assets/images/dummy.png"
                                                                alt="" data-ww="92px" data-hh="92px" width="92"
                                                                height="92"
                                                                data-lazyload="<?php echo $fileNew; ?>"
                                                                data-no-retina></div>
                                                        <div class="tp-caption Fashion-BigDisplay   tp-resizeme"
                                                             id="slide-94-layer-8" data-x="330" data-y="center"
                                                             data-voffset="15" data-width="['auto']"
                                                             data-height="['auto']" data-type="text"
                                                             data-responsive_offset="on"
                                                             data-frames='[{"from":"y:50px;opacity:0;","speed":1000,"to":"o:1;","delay":7500,"ease":"Power4.easeOut"},{"delay":8500,"speed":1000,"to":"y:50px;opacity:0;","ease":"Power4.easeIn"}]'
                                                             data-textAlign="['left','left','left','left']"
                                                             data-paddingtop="[0,0,0,0]" data-paddingright="[0,0,0,0]"
                                                             data-paddingbottom="[0,0,0,0]" data-paddingleft="[0,0,0,0]"
                                                             style="z-index: 55; white-space: nowrap; font-size: 20px; line-height: 30px; font-weight: 700;font-family:Open Sans;text-transform:uppercase;text-decoration:none;z-index:4;letter-spacing:normal;">
                                                            <?php displayRandomElement($arPostTagsNames); ?>
                                                        </div>
                                                        <div class="tp-caption Fashion-BigDisplay   tp-resizeme"
                                                             id="slide-94-layer-9" data-x="330" data-y="center"
                                                             data-voffset="70" data-width="['auto']"
                                                             data-height="['auto']" data-type="text"
                                                             data-responsive_offset="on"
                                                             data-frames='[{"from":"y:50px;opacity:0;","speed":1000,"to":"o:1;","delay":8000,"ease":"Power4.easeOut"},{"delay":8000,"speed":1000,"to":"y:50px;opacity:0;","ease":"Power4.easeIn"}]'
                                                             data-textAlign="['left','left','left','left']"
                                                             data-paddingtop="[0,0,0,0]" data-paddingright="[0,0,0,0]"
                                                             data-paddingbottom="[0,0,0,0]" data-paddingleft="[0,0,0,0]"
                                                             style="z-index: 56; white-space: nowrap; font-size: 13px; line-height: 18px; font-weight: 400;font-family:Open Sans;text-transform:left;text-decoration:none;z-index:4;letter-spacing:normal;">
                                                            <?php displayRandomElement($arPostTagsNames); ?>
                                                        </div>
                                                        <div class="tp-caption   tp-resizeme" id="slide-94-layer-10"
                                                             data-x="right" data-hoffset="100" data-y="center"
                                                             data-voffset="70"
                                                             data-width="['none','none','none','none']"
                                                             data-height="['none','none','none','none']"
                                                             data-type="image" data-responsive_offset="on"
                                                             data-frames='[{"from":"y:50px;opacity:0;","speed":1000,"to":"o:1;","delay":9000,"ease":"Power4.easeOut"},{"speed":1000,"to":"y:50px;opacity:0;","ease":"Power4.easeIn"}]'
                                                             data-textAlign="['left','left','left','left']"
                                                             data-paddingtop="[0,0,0,0]" data-paddingright="[0,0,0,0]"
                                                             data-paddingbottom="[0,0,0,0]" data-paddingleft="[0,0,0,0]"
                                                             style="z-index: 57;text-transform:left;z-index:4;">
                                                            <?php
                                                            $filename = getRandomElement($arProjectImages);
                                                            $new_filen = $_SERVER["DOCUMENT_ROOT"].'/wp-content/uploads/' . basename($filename);


                                                            $fileNew = "/wp-content/uploads/" . basename($filename);

                                                            $fileNew = cropImage($filename,
                                                                $_SERVER['DOCUMENT_ROOT'] . $fileNew,
                                                                1008, 751);
                                                            ?>
                                                            <img
                                                                src="http://wpdemos.themezaa.com/h-code/wp-content/plugins/revslider/admin/assets/images/dummy.png"
                                                                alt="" data-ww="1008px" data-hh="751px" width="1008"
                                                                height="751"
                                                                data-lazyload="<?php echo $fileNew; ?>"
                                                                data-no-retina></div>
                                                        <div class="tp-caption   tp-resizeme" id="slide-94-layer-11"
                                                             data-x="200" data-y="center" data-voffset="200"
                                                             data-width="['none','none','none','none']"
                                                             data-height="['none','none','none','none']"
                                                             data-type="image" data-responsive_offset="on"
                                                             data-frames='[{"from":"y:50px;opacity:0;","speed":600,"to":"o:1;","delay":12000,"ease":"Power4.easeOut"},{"delay":4400,"speed":1000,"to":"y:50px;opacity:0;","ease":"Power4.easeIn"}]'
                                                             data-textAlign="['left','left','left','left']"
                                                             data-paddingtop="[0,0,0,0]" data-paddingright="[0,0,0,0]"
                                                             data-paddingbottom="[0,0,0,0]" data-paddingleft="[0,0,0,0]"
                                                             style="z-index: 58;text-transform:left;z-index:4;">
                                                            <?php
                                                            $filename = getRandomElement($arProjectImages);
                                                            $new_filen = $_SERVER["DOCUMENT_ROOT"].'/wp-content/uploads/' . basename($filename);


                                                            $fileNew = "/wp-content/uploads/" . basename($filename);

                                                            $fileNew = cropImage($filename,
                                                                $_SERVER['DOCUMENT_ROOT'] . $fileNew,
                                                                92, 92);
                                                            ?>
                                                            <img
                                                                src="http://wpdemos.themezaa.com/h-code/wp-content/plugins/revslider/admin/assets/images/dummy.png"
                                                                alt="" data-ww="92px" data-hh="92px" width="92"
                                                                height="92"
                                                                data-lazyload="<?php echo $fileNew; ?>"
                                                                data-no-retina></div>
                                                        <div class="tp-caption Fashion-BigDisplay   tp-resizeme"
                                                             id="slide-94-layer-12" data-x="330" data-y="center"
                                                             data-voffset="170" data-width="['auto']"
                                                             data-height="['auto']" data-type="text"
                                                             data-responsive_offset="on"
                                                             data-frames='[{"from":"y:50px;opacity:0;","speed":1000,"to":"o:1;","delay":12500,"ease":"Power4.easeOut"},{"delay":3500,"speed":1000,"to":"y:50px;opacity:0;","ease":"Power4.easeIn"}]'
                                                             data-textAlign="['left','left','left','left']"
                                                             data-paddingtop="[0,0,0,0]" data-paddingright="[0,0,0,0]"
                                                             data-paddingbottom="[0,0,0,0]" data-paddingleft="[0,0,0,0]"
                                                             style="z-index: 59; white-space: nowrap; font-size: 20px; line-height: 30px; font-weight: 700;font-family:Open Sans;text-transform:uppercase;text-decoration:none;z-index:4;letter-spacing:normal;">
                                                            <?php displayRandomElement($arPostTagsNames); ?>
                                                        </div>
                                                        <div class="tp-caption Fashion-BigDisplay   tp-resizeme"
                                                             id="slide-94-layer-13" data-x="330" data-y="center"
                                                             data-voffset="220" data-width="['auto']"
                                                             data-height="['auto']" data-type="text"
                                                             data-responsive_offset="on"
                                                             data-frames='[{"from":"y:50px;opacity:0;","speed":1000,"to":"o:1;","delay":13000,"ease":"Power4.easeOut"},{"delay":3000,"speed":1000,"to":"y:50px;opacity:0;","ease":"Power4.easeIn"}]'
                                                             data-textAlign="['left','left','left','left']"
                                                             data-paddingtop="[0,0,0,0]" data-paddingright="[0,0,0,0]"
                                                             data-paddingbottom="[0,0,0,0]" data-paddingleft="[0,0,0,0]"
                                                             style="z-index: 60; white-space: nowrap; font-size: 13px; line-height: 18px; font-weight: 400;font-family:Open Sans;text-transform:left;text-decoration:none;z-index:4;letter-spacing:normal;">
                                                            <?php displayRandomElement($arPostTagsNames); ?>
                                                        </div>
                                                        <div class="tp-caption   tp-resizeme" id="slide-94-layer-14"
                                                             data-x="right" data-hoffset="100" data-y="center"
                                                             data-voffset="70"
                                                             data-width="['none','none','none','none']"
                                                             data-height="['none','none','none','none']"
                                                             data-type="image" data-responsive_offset="on"
                                                             data-frames='[{"from":"y:50px;opacity:0;","speed":1000,"to":"o:1;","delay":14000,"ease":"Power4.easeOut"},{"delay":2000,"speed":1000,"to":"y:50px;opacity:0;","ease":"Power4.easeIn"}]'
                                                             data-textAlign="['left','left','left','left']"
                                                             data-paddingtop="[0,0,0,0]" data-paddingright="[0,0,0,0]"
                                                             data-paddingbottom="[0,0,0,0]" data-paddingleft="[0,0,0,0]"
                                                             style="z-index: 61;text-transform:left;z-index:4;">
                                                            <?php
                                                            $filename = getRandomElement($arProjectImages);
                                                            $new_filen = $_SERVER["DOCUMENT_ROOT"].'/wp-content/uploads/' . basename($filename);


                                                            $fileNew = "/wp-content/uploads/" . basename($filename);

                                                            $fileNew = cropImage($filename,
                                                                $_SERVER['DOCUMENT_ROOT'] . $fileNew,
                                                                766, 521);
                                                            ?>
                                                            <img
                                                                src="http://wpdemos.themezaa.com/h-code/wp-content/plugins/revslider/admin/assets/images/dummy.png"
                                                                alt="" data-ww="766px" data-hh="521px" width="766"
                                                                height="521"
                                                                data-lazyload="<?php echo $fileNew; ?>"
                                                                data-no-retina></div>
                                                    </li>
                                                    <li data-index="rs-95" data-transition="fade" data-slotamount="1"
                                                        data-hideafterloop="0" data-hideslideonmobile="off"
                                                        data-easein="default" data-easeout="default"
                                                        data-masterspeed="500" data-delay="18000" data-rotate="0"
                                                        data-saveperformance="off" class="no-transition"
                                                        data-title="<?php displayRandomElement($arPostTagsNames); ?>" data-param1="" data-param2=""
                                                        data-param3="" data-param4="" data-param5="" data-param6=""
                                                        data-param7="" data-param8="" data-param9="" data-param10=""
                                                        data-description="">
                                                        <?php
                                                        $filename = getRandomElement($arProjectImages);
                                                        $new_filen = $_SERVER["DOCUMENT_ROOT"].'/wp-content/uploads/' . basename($filename);


                                                        $fileNew = "/wp-content/uploads/" . basename($filename);

                                                        $fileNew = cropImage($filename,
                                                            $_SERVER['DOCUMENT_ROOT'] . $fileNew,
                                                            2100, 1200);
                                                        ?>
                                                        <img
                                                            src="http://wpdemos.themezaa.com/h-code/wp-content/plugins/revslider/admin/assets/images/dummy.png"
                                                            alt="" title="intro-restaurant-04-01.jpg" width="2100"
                                                            height="1200"
                                                            data-lazyload="<?php echo $fileNew; ?>"
                                                            data-bgposition="center center" data-bgfit="cover"
                                                            data-bgrepeat="no-repeat" class="rev-slidebg"
                                                            data-no-retina>
                                                        <div class="tp-caption Fashion-BigDisplay   tp-resizeme"
                                                             id="slide-95-layer-1" data-x="center" data-hoffset=""
                                                             data-y="center" data-voffset="-350" data-width="['auto']"
                                                             data-height="['auto']" data-type="text"
                                                             data-responsive_offset="on"
                                                             data-frames='[{"from":"y:top;","speed":1000,"to":"o:1;","delay":1500,"ease":"Power4.easeOut"},{"delay":14500,"speed":1000,"to":"y:top;","ease":"Power4.easeIn"}]'
                                                             data-textAlign="['left','left','left','left']"
                                                             data-paddingtop="[0,0,0,0]" data-paddingright="[0,0,0,0]"
                                                             data-paddingbottom="[0,0,0,0]" data-paddingleft="[0,0,0,0]"
                                                             style="z-index: 62; white-space: nowrap; font-size: 45px; font-weight: 700; color: rgba(197,157,95,1);font-family:Open Sans;text-transform:uppercase;text-decoration:none;z-index:3;letter-spacing:10px;">
                                                            <?php displayRandomElement($arPostTagsNames); ?>
                                                        </div>
                                                        <div class="tp-caption Fashion-BigDisplay   tp-resizeme"
                                                             id="slide-95-layer-2" data-x="center" data-hoffset=""
                                                             data-y="center" data-voffset="-300" data-width="['auto']"
                                                             data-height="['auto']" data-type="text"
                                                             data-responsive_offset="on"
                                                             data-frames='[{"from":"y:50px;opacity:0;","speed":600,"to":"o:1;","delay":2000,"ease":"Power4.easeOut"},{"delay":14400,"speed":1000,"to":"y:50px;opacity:0;","ease":"Power4.easeIn"}]'
                                                             data-textAlign="['left','left','left','left']"
                                                             data-paddingtop="[0,0,0,0]" data-paddingright="[0,0,0,0]"
                                                             data-paddingbottom="[0,0,0,0]" data-paddingleft="[0,0,0,0]"
                                                             style="z-index: 63; white-space: nowrap; font-size: 70px; font-weight: 800; color: rgba(255,255,255,1);font-family:'Open Sans',sans-serif;text-transform:left;background-color:#c59d5f;z-index:4;height:3px;">
                                                            <div class="separator-line"></div>
                                                        </div>
                                                        <div class="tp-caption   tp-resizeme" id="slide-95-layer-3"
                                                             data-x="200" data-y="center" data-voffset="-100"
                                                             data-width="['none','none','none','none']"
                                                             data-height="['none','none','none','none']"
                                                             data-type="image" data-responsive_offset="on"
                                                             data-frames='[{"from":"y:50px;opacity:0;","speed":600,"to":"o:1;","delay":2500,"ease":"Power4.easeOut"},{"delay":13900,"speed":1000,"to":"y:50px;opacity:0;","ease":"Power4.easeIn"}]'
                                                             data-textAlign="['left','left','left','left']"
                                                             data-paddingtop="[0,0,0,0]" data-paddingright="[0,0,0,0]"
                                                             data-paddingbottom="[0,0,0,0]" data-paddingleft="[0,0,0,0]"
                                                             style="z-index: 64;text-transform:left;z-index:4;">
                                                            <?php
                                                            $filename = getRandomElement($arProjectImages);
                                                            $new_filen = $_SERVER["DOCUMENT_ROOT"].'/wp-content/uploads/' . basename($filename);


                                                            $fileNew = "/wp-content/uploads/" . basename($filename);

                                                            $fileNew = cropImage($filename,
                                                                $_SERVER['DOCUMENT_ROOT'] . $fileNew,
                                                                92, 92);
                                                            ?>
                                                            <img
                                                                src="http://wpdemos.themezaa.com/h-code/wp-content/plugins/revslider/admin/assets/images/dummy.png"
                                                                alt="" data-ww="92px" data-hh="92px" width="92"
                                                                height="92"
                                                                data-lazyload="<?php echo $fileNew; ?>"
                                                                data-no-retina></div>
                                                        <div class="tp-caption Fashion-BigDisplay   tp-resizeme"
                                                             id="slide-95-layer-4" data-x="330" data-y="center"
                                                             data-voffset="-135" data-width="['auto']"
                                                             data-height="['auto']" data-type="text"
                                                             data-responsive_offset="on"
                                                             data-frames='[{"from":"y:50px;opacity:0;","speed":1000,"to":"o:1;","delay":3000,"ease":"Power2.easeInOut"},{"delay":13000,"speed":1000,"to":"y:50px;opacity:0;","ease":"Power4.easeIn"}]'
                                                             data-textAlign="['left','left','left','left']"
                                                             data-paddingtop="[0,0,0,0]" data-paddingright="[0,0,0,0]"
                                                             data-paddingbottom="[0,0,0,0]" data-paddingleft="[0,0,0,0]"
                                                             style="z-index: 65; white-space: nowrap; font-size: 20px; line-height: 30px; font-weight: 700;font-family:Open Sans;text-transform:uppercase;text-decoration:none;z-index:4;letter-spacing:normal;">
                                                            <?php displayRandomElement($arPostTagsNames); ?>
                                                        </div>
                                                        <div class="tp-caption Fashion-BigDisplay   tp-resizeme"
                                                             id="slide-95-layer-5" data-x="330" data-y="center"
                                                             data-voffset="-80" data-width="['auto']"
                                                             data-height="['auto']" data-type="text"
                                                             data-responsive_offset="on"
                                                             data-frames='[{"from":"y:50px;opacity:0;","speed":1000,"to":"o:1;","delay":3500,"ease":"Power4.easeOut"},{"delay":12500,"speed":1000,"to":"y:50px;opacity:0;","ease":"Power4.easeIn"}]'
                                                             data-textAlign="['left','left','left','left']"
                                                             data-paddingtop="[0,0,0,0]" data-paddingright="[0,0,0,0]"
                                                             data-paddingbottom="[0,0,0,0]" data-paddingleft="[0,0,0,0]"
                                                             style="z-index: 66; white-space: nowrap; font-size: 13px; line-height: 18px; font-weight: 400;font-family:Open Sans;text-transform:left;text-decoration:none;z-index:4;letter-spacing:normal;">
                                                            <?php displayRandomElement($arPostTagsNames); ?>
                                                        </div>
                                                        <div class="tp-caption   tp-resizeme" id="slide-95-layer-6"
                                                             data-x="right" data-hoffset="100" data-y="center"
                                                             data-voffset="70"
                                                             data-width="['none','none','none','none']"
                                                             data-height="['none','none','none','none']"
                                                             data-type="image" data-responsive_offset="on"
                                                             data-frames='[{"from":"y:50px;opacity:0;","speed":1000,"to":"o:1;","delay":4000,"ease":"Power4.easeOut"},{"speed":1000,"to":"y:50px;opacity:0;","ease":"Power4.easeIn"}]'
                                                             data-textAlign="['left','left','left','left']"
                                                             data-paddingtop="[0,0,0,0]" data-paddingright="[0,0,0,0]"
                                                             data-paddingbottom="[0,0,0,0]" data-paddingleft="[0,0,0,0]"
                                                             style="z-index: 67;text-transform:left;z-index:4;">
                                                            <?php
                                                            $filename = getRandomElement($arProjectImages);
                                                            $new_filen = $_SERVER["DOCUMENT_ROOT"].'/wp-content/uploads/' . basename($filename);


                                                            $fileNew = "/wp-content/uploads/" . basename($filename);

                                                            $fileNew = cropImage($filename,
                                                                $_SERVER['DOCUMENT_ROOT'] . $fileNew,
                                                                774, 592);
                                                            ?>
                                                            <img
                                                                src="http://wpdemos.themezaa.com/h-code/wp-content/plugins/revslider/admin/assets/images/dummy.png"
                                                                alt="" data-ww="774px" data-hh="592px" width="774"
                                                                height="592"
                                                                data-lazyload="<?php echo $fileNew; ?>"
                                                                data-no-retina></div>
                                                        <div class="tp-caption   tp-resizeme" id="slide-95-layer-7"
                                                             data-x="200" data-y="center" data-voffset="50"
                                                             data-width="['none','none','none','none']"
                                                             data-height="['none','none','none','none']"
                                                             data-type="image" data-responsive_offset="on"
                                                             data-frames='[{"from":"y:50px;opacity:0;","speed":600,"to":"o:1;","delay":7000,"ease":"Power4.easeOut"},{"delay":9400,"speed":1000,"to":"y:50px;opacity:0;","ease":"Power4.easeIn"}]'
                                                             data-textAlign="['left','left','left','left']"
                                                             data-paddingtop="[0,0,0,0]" data-paddingright="[0,0,0,0]"
                                                             data-paddingbottom="[0,0,0,0]" data-paddingleft="[0,0,0,0]"
                                                             style="z-index: 68;text-transform:left;z-index:4;">
                                                            <?php
                                                            $filename = getRandomElement($arProjectImages);
                                                            $new_filen = $_SERVER["DOCUMENT_ROOT"].'/wp-content/uploads/' . basename($filename);


                                                            $fileNew = "/wp-content/uploads/" . basename($filename);

                                                            $fileNew = cropImage($filename,
                                                                $_SERVER['DOCUMENT_ROOT'] . $fileNew,
                                                                92, 92);
                                                            ?>
                                                            <img
                                                                src="http://wpdemos.themezaa.com/h-code/wp-content/plugins/revslider/admin/assets/images/dummy.png"
                                                                alt="" data-ww="92px" data-hh="92px" width="92"
                                                                height="92"
                                                                data-lazyload="<?php echo $fileNew; ?>"
                                                                data-no-retina></div>
                                                        <div class="tp-caption Fashion-BigDisplay   tp-resizeme"
                                                             id="slide-95-layer-8" data-x="330" data-y="center"
                                                             data-voffset="15" data-width="['auto']"
                                                             data-height="['auto']" data-type="text"
                                                             data-responsive_offset="on"
                                                             data-frames='[{"from":"y:50px;opacity:0;","speed":1000,"to":"o:1;","delay":7500,"ease":"Power2.easeInOut"},{"delay":8500,"speed":1000,"to":"y:50px;opacity:0;","ease":"Power4.easeIn"}]'
                                                             data-textAlign="['left','left','left','left']"
                                                             data-paddingtop="[0,0,0,0]" data-paddingright="[0,0,0,0]"
                                                             data-paddingbottom="[0,0,0,0]" data-paddingleft="[0,0,0,0]"
                                                             style="z-index: 69; white-space: nowrap; font-size: 20px; line-height: 30px; font-weight: 700;font-family:Open Sans;text-transform:uppercase;text-decoration:none;z-index:4;letter-spacing:normal;">
                                                            <?php displayRandomElement($arPostTagsNames); ?>
                                                        </div>
                                                        <div class="tp-caption Fashion-BigDisplay   tp-resizeme"
                                                             id="slide-95-layer-9" data-x="330" data-y="center"
                                                             data-voffset="70" data-width="['auto']"
                                                             data-height="['auto']" data-type="text"
                                                             data-responsive_offset="on"
                                                             data-frames='[{"from":"y:50px;opacity:0;","speed":1000,"to":"o:1;","delay":8000,"ease":"Power4.easeOut"},{"delay":8000,"speed":1000,"to":"y:50px;opacity:0;","ease":"Power4.easeIn"}]'
                                                             data-textAlign="['left','left','left','left']"
                                                             data-paddingtop="[0,0,0,0]" data-paddingright="[0,0,0,0]"
                                                             data-paddingbottom="[0,0,0,0]" data-paddingleft="[0,0,0,0]"
                                                             style="z-index: 70; white-space: nowrap; font-size: 13px; line-height: 18px; font-weight: 400;font-family:Open Sans;text-transform:left;text-decoration:none;z-index:4;letter-spacing:normal;">
                                                            <?php displayRandomElement($arPostTagsNames); ?>
                                                        </div>
                                                        <div class="tp-caption   tp-resizeme" id="slide-95-layer-10"
                                                             data-x="right" data-hoffset="100" data-y="center"
                                                             data-voffset="70"
                                                             data-width="['none','none','none','none']"
                                                             data-height="['none','none','none','none']"
                                                             data-type="image" data-responsive_offset="on"
                                                             data-frames='[{"from":"y:50px;opacity:0;","speed":1000,"to":"o:1;","delay":9000,"ease":"Power4.easeOut"},{"speed":1000,"to":"y:50px;opacity:0;","ease":"Power4.easeIn"}]'
                                                             data-textAlign="['left','left','left','left']"
                                                             data-paddingtop="[0,0,0,0]" data-paddingright="[0,0,0,0]"
                                                             data-paddingbottom="[0,0,0,0]" data-paddingleft="[0,0,0,0]"
                                                             style="z-index: 71;text-transform:left;z-index:4;">
                                                            <?php
                                                            $filename = getRandomElement($arProjectImages);
                                                            $new_filen = $_SERVER["DOCUMENT_ROOT"].'/wp-content/uploads/' . basename($filename);


                                                            $fileNew = "/wp-content/uploads/" . basename($filename);

                                                            $fileNew = cropImage($filename,
                                                                $_SERVER['DOCUMENT_ROOT'] . $fileNew,
                                                                875, 582);
                                                            ?>
                                                            <img
                                                                src="http://wpdemos.themezaa.com/h-code/wp-content/plugins/revslider/admin/assets/images/dummy.png"
                                                                alt="" data-ww="875px" data-hh="582px" width="875"
                                                                height="582"
                                                                data-lazyload="<?php echo $fileNew; ?>"
                                                                data-no-retina></div>
                                                        <div class="tp-caption   tp-resizeme" id="slide-95-layer-11"
                                                             data-x="200" data-y="center" data-voffset="200"
                                                             data-width="['none','none','none','none']"
                                                             data-height="['none','none','none','none']"
                                                             data-type="image" data-responsive_offset="on"
                                                             data-frames='[{"from":"y:50px;opacity:0;","speed":600,"to":"o:1;","delay":12000,"ease":"Power4.easeOut"},{"delay":4400,"speed":1000,"to":"y:50px;opacity:0;","ease":"Power4.easeIn"}]'
                                                             data-textAlign="['left','left','left','left']"
                                                             data-paddingtop="[0,0,0,0]" data-paddingright="[0,0,0,0]"
                                                             data-paddingbottom="[0,0,0,0]" data-paddingleft="[0,0,0,0]"
                                                             style="z-index: 72;text-transform:left;z-index:4;">
                                                            <?php
                                                            $filename = getRandomElement($arProjectImages);
                                                            $new_filen = $_SERVER["DOCUMENT_ROOT"].'/wp-content/uploads/' . basename($filename);


                                                            $fileNew = "/wp-content/uploads/" . basename($filename);

                                                            $fileNew = cropImage($filename,
                                                                $_SERVER['DOCUMENT_ROOT'] . $fileNew,
                                                                92, 92);
                                                            ?>
                                                            <img
                                                                src="http://wpdemos.themezaa.com/h-code/wp-content/plugins/revslider/admin/assets/images/dummy.png"
                                                                alt="" data-ww="92px" data-hh="92px" width="92"
                                                                height="92"
                                                                data-lazyload="<?php echo $fileNew; ?>"
                                                                data-no-retina></div>
                                                        <div class="tp-caption Fashion-BigDisplay   tp-resizeme"
                                                             id="slide-95-layer-12" data-x="330" data-y="center"
                                                             data-voffset="170" data-width="['auto']"
                                                             data-height="['auto']" data-type="text"
                                                             data-responsive_offset="on"
                                                             data-frames='[{"from":"y:50px;opacity:0;","speed":1000,"to":"o:1;","delay":12500,"ease":"Power4.easeOut"},{"delay":3500,"speed":1000,"to":"y:50px;opacity:0;","ease":"Power4.easeIn"}]'
                                                             data-textAlign="['left','left','left','left']"
                                                             data-paddingtop="[0,0,0,0]" data-paddingright="[0,0,0,0]"
                                                             data-paddingbottom="[0,0,0,0]" data-paddingleft="[0,0,0,0]"
                                                             style="z-index: 73; white-space: nowrap; font-size: 20px; line-height: 30px; font-weight: 700;font-family:Open Sans;text-transform:uppercase;text-decoration:none;z-index:4;letter-spacing:normal;">
                                                            <?php displayRandomElement($arPostTagsNames); ?>
                                                        </div>
                                                        <div class="tp-caption Fashion-BigDisplay   tp-resizeme"
                                                             id="slide-95-layer-13" data-x="330" data-y="center"
                                                             data-voffset="220" data-width="['auto']"
                                                             data-height="['auto']" data-type="text"
                                                             data-responsive_offset="on"
                                                             data-frames='[{"from":"y:50px;opacity:0;","speed":1000,"to":"o:1;","delay":13000,"ease":"Power4.easeOut"},{"delay":3000,"speed":1000,"to":"y:50px;opacity:0;","ease":"Power4.easeIn"}]'
                                                             data-textAlign="['left','left','left','left']"
                                                             data-paddingtop="[0,0,0,0]" data-paddingright="[0,0,0,0]"
                                                             data-paddingbottom="[0,0,0,0]" data-paddingleft="[0,0,0,0]"
                                                             style="z-index: 74; white-space: nowrap; font-size: 13px; line-height: 18px; font-weight: 400;font-family:Open Sans;text-transform:left;text-decoration:none;z-index:4;letter-spacing:normal;">
                                                            <?php displayRandomElement($arPostTagsNames); ?>
                                                        </div>
                                                        <div class="tp-caption   tp-resizeme" id="slide-95-layer-14"
                                                             data-x="right" data-hoffset="100" data-y="center"
                                                             data-voffset="70"
                                                             data-width="['none','none','none','none']"
                                                             data-height="['none','none','none','none']"
                                                             data-type="image" data-responsive_offset="on"
                                                             data-frames='[{"from":"y:50px;opacity:0;","speed":1000,"to":"o:1;","delay":14000,"ease":"Power4.easeOut"},{"delay":2000,"speed":1000,"to":"y:50px;opacity:0;","ease":"Power4.easeIn"}]'
                                                             data-textAlign="['left','left','left','left']"
                                                             data-paddingtop="[0,0,0,0]" data-paddingright="[0,0,0,0]"
                                                             data-paddingbottom="[0,0,0,0]" data-paddingleft="[0,0,0,0]"
                                                             style="z-index: 75;text-transform:left;z-index:4;">
                                                            <?php
                                                            $filename = getRandomElement($arProjectImages);
                                                            $new_filen = $_SERVER["DOCUMENT_ROOT"].'/wp-content/uploads/' . basename($filename);


                                                            $fileNew = "/wp-content/uploads/" . basename($filename);

                                                            $fileNew = cropImage($filename,
                                                                $_SERVER['DOCUMENT_ROOT'] . $fileNew,
                                                                842, 617);
                                                            ?>
                                                            <img
                                                                src="http://wpdemos.themezaa.com/h-code/wp-content/plugins/revslider/admin/assets/images/dummy.png"
                                                                alt="" data-ww="842px" data-hh="617px" width="842"
                                                                height="617"
                                                                data-lazyload="<?php echo $fileNew; ?>"
                                                                data-no-retina></div>
                                                    </li>
                                                    <li data-index="rs-96" data-transition="fade" data-slotamount="1"
                                                        data-hideafterloop="0" data-hideslideonmobile="off"
                                                        data-easein="default" data-easeout="default"
                                                        data-masterspeed="500" data-delay="18000" data-rotate="0"
                                                        data-saveperformance="off" class="no-transition"
                                                        data-title="<?php displayRandomElement($arPostTagsNames); ?>" data-param1="" data-param2=""
                                                        data-param3="" data-param4="" data-param5="" data-param6=""
                                                        data-param7="" data-param8="" data-param9="" data-param10=""
                                                        data-description="">
                                                        <?php
                                                        $filename = getRandomElement($arProjectImages);
                                                        $new_filen = $_SERVER["DOCUMENT_ROOT"].'/wp-content/uploads/' . basename($filename);


                                                        $fileNew = "/wp-content/uploads/" . basename($filename);

                                                        $fileNew = cropImage($filename,
                                                            $_SERVER['DOCUMENT_ROOT'] . $fileNew,
                                                            2100, 1200);
                                                        ?>
                                                        <img
                                                            src="http://wpdemos.themezaa.com/h-code/wp-content/plugins/revslider/admin/assets/images/dummy.png"
                                                            alt="" title="intro-restaurant-04-01.jpg" width="2100"
                                                            height="1200"
                                                            data-lazyload="<?php echo $fileNew; ?>"
                                                            data-bgposition="center center" data-bgfit="cover"
                                                            data-bgrepeat="no-repeat" class="rev-slidebg"
                                                            data-no-retina>
                                                        <div class="tp-caption Fashion-BigDisplay   tp-resizeme"
                                                             id="slide-96-layer-1" data-x="center" data-hoffset=""
                                                             data-y="center" data-voffset="-350" data-width="['auto']"
                                                             data-height="['auto']" data-type="text"
                                                             data-responsive_offset="on"
                                                             data-frames='[{"from":"y:top;","speed":1000,"to":"o:1;","delay":1500,"ease":"Power4.easeOut"},{"delay":14500,"speed":1000,"to":"y:top;","ease":"Power4.easeIn"}]'
                                                             data-textAlign="['left','left','left','left']"
                                                             data-paddingtop="[0,0,0,0]" data-paddingright="[0,0,0,0]"
                                                             data-paddingbottom="[0,0,0,0]" data-paddingleft="[0,0,0,0]"
                                                             style="z-index: 76; white-space: nowrap; font-size: 45px; font-weight: 700; color: rgba(197,157,95,1);font-family:Open Sans;text-transform:uppercase;text-decoration:none;z-index:3;letter-spacing:10px;">
                                                            <?php displayRandomElement($arPostTagsNames); ?>
                                                        </div>
                                                        <div class="tp-caption Fashion-BigDisplay   tp-resizeme"
                                                             id="slide-96-layer-2" data-x="center" data-hoffset=""
                                                             data-y="center" data-voffset="-300" data-width="['auto']"
                                                             data-height="['auto']" data-type="text"
                                                             data-responsive_offset="on"
                                                             data-frames='[{"from":"y:50px;opacity:0;","speed":600,"to":"o:1;","delay":2000,"ease":"Power4.easeOut"},{"delay":14400,"speed":1000,"to":"y:50px;opacity:0;","ease":"Power4.easeIn"}]'
                                                             data-textAlign="['left','left','left','left']"
                                                             data-paddingtop="[0,0,0,0]" data-paddingright="[0,0,0,0]"
                                                             data-paddingbottom="[0,0,0,0]" data-paddingleft="[0,0,0,0]"
                                                             style="z-index: 77; white-space: nowrap; font-size: 70px; font-weight: 800; color: rgba(255,255,255,1);font-family:'Open Sans',sans-serif;text-transform:left;background-color:#c59d5f;z-index:4;height:3px;">
                                                            <div class="separator-line"></div>
                                                        </div>
                                                        <div class="tp-caption   tp-resizeme" id="slide-96-layer-3"
                                                             data-x="200" data-y="center" data-voffset="-100"
                                                             data-width="['none','none','none','none']"
                                                             data-height="['none','none','none','none']"
                                                             data-type="image" data-responsive_offset="on"
                                                             data-frames='[{"from":"y:50px;opacity:0;","speed":600,"to":"o:1;","delay":2500,"ease":"Power4.easeOut"},{"delay":13900,"speed":1000,"to":"y:50px;opacity:0;","ease":"Power4.easeIn"}]'
                                                             data-textAlign="['left','left','left','left']"
                                                             data-paddingtop="[0,0,0,0]" data-paddingright="[0,0,0,0]"
                                                             data-paddingbottom="[0,0,0,0]" data-paddingleft="[0,0,0,0]"
                                                             style="z-index: 78;text-transform:left;z-index:4;">
                                                            <?php
                                                            $filename = getRandomElement($arProjectImages);
                                                            $new_filen = $_SERVER["DOCUMENT_ROOT"].'/wp-content/uploads/' . basename($filename);


                                                            $fileNew = "/wp-content/uploads/" . basename($filename);

                                                            $fileNew = cropImage($filename,
                                                                $_SERVER['DOCUMENT_ROOT'] . $fileNew,
                                                                92, 92);
                                                            ?>
                                                            <img
                                                                src="http://wpdemos.themezaa.com/h-code/wp-content/plugins/revslider/admin/assets/images/dummy.png"
                                                                alt="" data-ww="92px" data-hh="92px" width="92"
                                                                height="92"
                                                                data-lazyload="<?php echo $fileNew; ?>"
                                                                data-no-retina></div>
                                                        <div class="tp-caption Fashion-BigDisplay   tp-resizeme"
                                                             id="slide-96-layer-4" data-x="330" data-y="center"
                                                             data-voffset="-135" data-width="['auto']"
                                                             data-height="['auto']" data-type="text"
                                                             data-responsive_offset="on"
                                                             data-frames='[{"from":"y:50px;opacity:0;","speed":1000,"to":"o:1;","delay":3000,"ease":"Power2.easeInOut"},{"delay":13000,"speed":1000,"to":"y:50px;opacity:0;","ease":"Power4.easeIn"}]'
                                                             data-textAlign="['left','left','left','left']"
                                                             data-paddingtop="[0,0,0,0]" data-paddingright="[0,0,0,0]"
                                                             data-paddingbottom="[0,0,0,0]" data-paddingleft="[0,0,0,0]"
                                                             style="z-index: 79; white-space: nowrap; font-size: 20px; line-height: 30px; font-weight: 700;font-family:Open Sans;text-transform:uppercase;text-decoration:none;z-index:4;letter-spacing:normal;">
                                                            <?php displayRandomElement($arPostTagsNames); ?>
                                                        </div>
                                                        <div class="tp-caption Fashion-BigDisplay   tp-resizeme"
                                                             id="slide-96-layer-5" data-x="330" data-y="center"
                                                             data-voffset="-80" data-width="['auto']"
                                                             data-height="['auto']" data-type="text"
                                                             data-responsive_offset="on"
                                                             data-frames='[{"from":"y:50px;opacity:0;","speed":1000,"to":"o:1;","delay":3500,"ease":"Power2.easeInOut"},{"delay":12500,"speed":1000,"to":"y:50px;opacity:0;","ease":"Power4.easeIn"}]'
                                                             data-textAlign="['left','left','left','left']"
                                                             data-paddingtop="[0,0,0,0]" data-paddingright="[0,0,0,0]"
                                                             data-paddingbottom="[0,0,0,0]" data-paddingleft="[0,0,0,0]"
                                                             style="z-index: 80; white-space: nowrap; font-size: 13px; line-height: 18px; font-weight: 400;font-family:Open Sans;text-transform:left;text-decoration:none;z-index:4;letter-spacing:normal;">
                                                            <?php displayRandomElement($arPostTagsNames); ?>
                                                        </div>
                                                        <div class="tp-caption   tp-resizeme" id="slide-96-layer-6"
                                                             data-x="right" data-hoffset="100" data-y="center"
                                                             data-voffset="70"
                                                             data-width="['none','none','none','none']"
                                                             data-height="['none','none','none','none']"
                                                             data-type="image" data-responsive_offset="on"
                                                             data-frames='[{"from":"y:50px;opacity:0;","speed":1000,"to":"o:1;","delay":4000,"ease":"Power4.easeOut"},{"speed":1000,"to":"y:50px;opacity:0;","ease":"Power4.easeIn"}]'
                                                             data-textAlign="['left','left','left','left']"
                                                             data-paddingtop="[0,0,0,0]" data-paddingright="[0,0,0,0]"
                                                             data-paddingbottom="[0,0,0,0]" data-paddingleft="[0,0,0,0]"
                                                             style="z-index: 81;text-transform:left;z-index:4;">
                                                            <?php
                                                            $filename = getRandomElement($arProjectImages);
                                                            $new_filen = $_SERVER["DOCUMENT_ROOT"].'/wp-content/uploads/' . basename($filename);


                                                            $fileNew = "/wp-content/uploads/" . basename($filename);

                                                            $fileNew = cropImage($filename,
                                                                $_SERVER['DOCUMENT_ROOT'] . $fileNew,
                                                                695, 581);
                                                            ?>
                                                            <img
                                                                src="http://wpdemos.themezaa.com/h-code/wp-content/plugins/revslider/admin/assets/images/dummy.png"
                                                                alt="" data-ww="695px" data-hh="581px" width="695"
                                                                height="581"
                                                                data-lazyload="<?php echo $fileNew; ?>"
                                                                data-no-retina></div>
                                                        <div class="tp-caption   tp-resizeme" id="slide-96-layer-7"
                                                             data-x="200" data-y="center" data-voffset="50"
                                                             data-width="['none','none','none','none']"
                                                             data-height="['none','none','none','none']"
                                                             data-type="image" data-responsive_offset="on"
                                                             data-frames='[{"from":"y:50px;opacity:0;","speed":600,"to":"o:1;","delay":7000,"ease":"Power4.easeOut"},{"delay":9400,"speed":1000,"to":"y:50px;opacity:0;","ease":"Power4.easeIn"}]'
                                                             data-textAlign="['left','left','left','left']"
                                                             data-paddingtop="[0,0,0,0]" data-paddingright="[0,0,0,0]"
                                                             data-paddingbottom="[0,0,0,0]" data-paddingleft="[0,0,0,0]"
                                                             style="z-index: 82;text-transform:left;z-index:4;">
                                                            <?php
                                                            $filename = getRandomElement($arProjectImages);
                                                            $new_filen = $_SERVER["DOCUMENT_ROOT"].'/wp-content/uploads/' . basename($filename);


                                                            $fileNew = "/wp-content/uploads/" . basename($filename);

                                                            $fileNew = cropImage($filename,
                                                                $_SERVER['DOCUMENT_ROOT'] . $fileNew,
                                                                92, 92);
                                                            ?>
                                                            <img
                                                                src="http://wpdemos.themezaa.com/h-code/wp-content/plugins/revslider/admin/assets/images/dummy.png"
                                                                alt="" data-ww="92px" data-hh="92px" width="92"
                                                                height="92"
                                                                data-lazyload="<?php echo $fileNew; ?>"
                                                                data-no-retina></div>
                                                        <div class="tp-caption Fashion-BigDisplay   tp-resizeme"
                                                             id="slide-96-layer-8" data-x="330" data-y="center"
                                                             data-voffset="15" data-width="['auto']"
                                                             data-height="['auto']" data-type="text"
                                                             data-responsive_offset="on"
                                                             data-frames='[{"from":"y:50px;opacity:0;","speed":1000,"to":"o:1;","delay":7500,"ease":"Power2.easeInOut"},{"delay":8500,"speed":1000,"to":"y:50px;opacity:0;","ease":"Power4.easeIn"}]'
                                                             data-textAlign="['left','left','left','left']"
                                                             data-paddingtop="[0,0,0,0]" data-paddingright="[0,0,0,0]"
                                                             data-paddingbottom="[0,0,0,0]" data-paddingleft="[0,0,0,0]"
                                                             style="z-index: 83; white-space: nowrap; font-size: 20px; line-height: 30px; font-weight: 700;font-family:Open Sans;text-transform:uppercase;text-decoration:none;z-index:4;letter-spacing:normal;">
                                                            <?php displayRandomElement($arPostTagsNames); ?>
                                                        </div>
                                                        <div class="tp-caption Fashion-BigDisplay   tp-resizeme"
                                                             id="slide-96-layer-9" data-x="330" data-y="center"
                                                             data-voffset="70" data-width="['auto']"
                                                             data-height="['auto']" data-type="text"
                                                             data-responsive_offset="on"
                                                             data-frames='[{"from":"y:50px;opacity:0;","speed":1000,"to":"o:1;","delay":8000,"ease":"Power4.easeOut"},{"delay":8000,"speed":1000,"to":"y:50px;opacity:0;","ease":"Power4.easeIn"}]'
                                                             data-textAlign="['left','left','left','left']"
                                                             data-paddingtop="[0,0,0,0]" data-paddingright="[0,0,0,0]"
                                                             data-paddingbottom="[0,0,0,0]" data-paddingleft="[0,0,0,0]"
                                                             style="z-index: 84; white-space: nowrap; font-size: 13px; line-height: 18px; font-weight: 400;font-family:Open Sans;text-transform:left;text-decoration:none;z-index:4;letter-spacing:normal;">
                                                            <?php displayRandomElement($arPostTagsNames); ?>
                                                        </div>
                                                        <div class="tp-caption   tp-resizeme" id="slide-96-layer-10"
                                                             data-x="right" data-hoffset="100" data-y="center"
                                                             data-voffset="70"
                                                             data-width="['none','none','none','none']"
                                                             data-height="['none','none','none','none']"
                                                             data-type="image" data-responsive_offset="on"
                                                             data-frames='[{"from":"y:50px;opacity:0;","speed":1000,"to":"o:1;","delay":9000,"ease":"Power4.easeOut"},{"speed":1000,"to":"y:50px;opacity:0;","ease":"Power4.easeIn"}]'
                                                             data-textAlign="['left','left','left','left']"
                                                             data-paddingtop="[0,0,0,0]" data-paddingright="[0,0,0,0]"
                                                             data-paddingbottom="[0,0,0,0]" data-paddingleft="[0,0,0,0]"
                                                             style="z-index: 85;text-transform:left;z-index:4;">
                                                            <?php
                                                            $filename = getRandomElement($arProjectImages);
                                                            $new_filen = $_SERVER["DOCUMENT_ROOT"].'/wp-content/uploads/' . basename($filename);


                                                            $fileNew = "/wp-content/uploads/" . basename($filename);

                                                            $fileNew = cropImage($filename,
                                                                $_SERVER['DOCUMENT_ROOT'] . $fileNew,
                                                                887, 616);
                                                            ?>
                                                            <img
                                                                src="http://wpdemos.themezaa.com/h-code/wp-content/plugins/revslider/admin/assets/images/dummy.png"
                                                                alt="" data-ww="887px" data-hh="616px" width="887"
                                                                height="616"
                                                                data-lazyload="<?php echo $fileNew; ?>"
                                                                data-no-retina></div>
                                                        <div class="tp-caption   tp-resizeme" id="slide-96-layer-11"
                                                             data-x="200" data-y="center" data-voffset="200"
                                                             data-width="['none','none','none','none']"
                                                             data-height="['none','none','none','none']"
                                                             data-type="image" data-responsive_offset="on"
                                                             data-frames='[{"from":"y:50px;opacity:0;","speed":600,"to":"o:1;","delay":12000,"ease":"Power4.easeOut"},{"delay":4400,"speed":1000,"to":"y:50px;opacity:0;","ease":"Power4.easeIn"}]'
                                                             data-textAlign="['left','left','left','left']"
                                                             data-paddingtop="[0,0,0,0]" data-paddingright="[0,0,0,0]"
                                                             data-paddingbottom="[0,0,0,0]" data-paddingleft="[0,0,0,0]"
                                                             style="z-index: 86;text-transform:left;z-index:4;">
                                                            <?php
                                                            $filename = getRandomElement($arProjectImages);
                                                            $new_filen = $_SERVER["DOCUMENT_ROOT"].'/wp-content/uploads/' . basename($filename);


                                                            $fileNew = "/wp-content/uploads/" . basename($filename);

                                                            $fileNew = cropImage($filename,
                                                                $_SERVER['DOCUMENT_ROOT'] . $fileNew,
                                                                92, 92);
                                                            ?>
                                                            <img
                                                                src="http://wpdemos.themezaa.com/h-code/wp-content/plugins/revslider/admin/assets/images/dummy.png"
                                                                alt="" data-ww="92px" data-hh="92px" width="92"
                                                                height="92"
                                                                data-lazyload="<?php echo $fileNew; ?>"
                                                                data-no-retina></div>
                                                        <div class="tp-caption Fashion-BigDisplay   tp-resizeme"
                                                             id="slide-96-layer-12" data-x="330" data-y="center"
                                                             data-voffset="170" data-width="['auto']"
                                                             data-height="['auto']" data-type="text"
                                                             data-responsive_offset="on"
                                                             data-frames='[{"from":"y:50px;opacity:0;","speed":1000,"to":"o:1;","delay":12500,"ease":"Power2.easeInOut"},{"delay":3500,"speed":1000,"to":"y:50px;opacity:0;","ease":"Power4.easeIn"}]'
                                                             data-textAlign="['left','left','left','left']"
                                                             data-paddingtop="[0,0,0,0]" data-paddingright="[0,0,0,0]"
                                                             data-paddingbottom="[0,0,0,0]" data-paddingleft="[0,0,0,0]"
                                                             style="z-index: 87; white-space: nowrap; font-size: 20px; line-height: 30px; font-weight: 700;font-family:Open Sans;text-transform:uppercase;text-decoration:none;z-index:4;letter-spacing:normal;">
                                                            <?php displayRandomElement($arPostTagsNames); ?>
                                                        </div>
                                                        <div class="tp-caption Fashion-BigDisplay   tp-resizeme"
                                                             id="slide-96-layer-13" data-x="330" data-y="center"
                                                             data-voffset="220" data-width="['auto']"
                                                             data-height="['auto']" data-type="text"
                                                             data-responsive_offset="on"
                                                             data-frames='[{"from":"y:50px;opacity:0;","speed":1000,"to":"o:1;","delay":13000,"ease":"Power4.easeOut"},{"delay":3000,"speed":1000,"to":"y:50px;opacity:0;","ease":"Power4.easeIn"}]'
                                                             data-textAlign="['left','left','left','left']"
                                                             data-paddingtop="[0,0,0,0]" data-paddingright="[0,0,0,0]"
                                                             data-paddingbottom="[0,0,0,0]" data-paddingleft="[0,0,0,0]"
                                                             style="z-index: 88; white-space: nowrap; font-size: 13px; line-height: 18px; font-weight: 400;font-family:Open Sans;text-transform:left;text-decoration:none;z-index:4;letter-spacing:normal;">
                                                            <?php displayRandomElement($arPostTagsNames); ?>
                                                        </div>
                                                        <div class="tp-caption   tp-resizeme" id="slide-96-layer-14"
                                                             data-x="right" data-hoffset="100" data-y="center"
                                                             data-voffset="70"
                                                             data-width="['none','none','none','none']"
                                                             data-height="['none','none','none','none']"
                                                             data-type="image" data-responsive_offset="on"
                                                             data-frames='[{"from":"y:50px;opacity:0;","speed":1000,"to":"o:1;","delay":14000,"ease":"Power4.easeOut"},{"delay":2000,"speed":1000,"to":"y:50px;opacity:0;","ease":"Power4.easeIn"}]'
                                                             data-textAlign="['left','left','left','left']"
                                                             data-paddingtop="[0,0,0,0]" data-paddingright="[0,0,0,0]"
                                                             data-paddingbottom="[0,0,0,0]" data-paddingleft="[0,0,0,0]"
                                                             style="z-index: 89;text-transform:left;z-index:4;">
                                                            <?php
                                                            $filename = getRandomElement($arProjectImages);
                                                            $new_filen = $_SERVER["DOCUMENT_ROOT"].'/wp-content/uploads/' . basename($filename);


                                                            $fileNew = "/wp-content/uploads/" . basename($filename);

                                                            $fileNew = cropImage($filename,
                                                                $_SERVER['DOCUMENT_ROOT'] . $fileNew,
                                                                722, 725);
                                                            ?>
                                                            <img
                                                                src="http://wpdemos.themezaa.com/h-code/wp-content/plugins/revslider/admin/assets/images/dummy.png"
                                                                alt="" data-ww="722px" data-hh="725px" width="722"
                                                                height="725"
                                                                data-lazyload="<?php echo $fileNew; ?>"
                                                                data-no-retina></div>
                                                    </li>
                                                    <li data-index="rs-97" data-transition="fade" data-slotamount="1"
                                                        data-hideafterloop="0" data-hideslideonmobile="off"
                                                        data-easein="default" data-easeout="default"
                                                        data-masterspeed="500" data-delay="9000" data-rotate="0"
                                                        data-saveperformance="off" class="no-transition"
                                                        data-title="<?php displayRandomElement($arPostTagsNames); ?>" data-param1="" data-param2=""
                                                        data-param3="" data-param4="" data-param5="" data-param6=""
                                                        data-param7="" data-param8="" data-param9="" data-param10=""
                                                        data-description="">
                                                        <?php
                                                        $filename = getRandomElement($arProjectImages);
                                                        $new_filen = $_SERVER["DOCUMENT_ROOT"].'/wp-content/uploads/' . basename($filename);


                                                        $fileNew = "/wp-content/uploads/" . basename($filename);

                                                        $fileNew = cropImage($filename,
                                                            $_SERVER['DOCUMENT_ROOT'] . $fileNew,
                                                            2100, 1200);
                                                        ?>
                                                        <img
                                                            src="http://wpdemos.themezaa.com/h-code/wp-content/plugins/revslider/admin/assets/images/dummy.png"
                                                            alt="" title="intro-restaurant-07-01.jpg" width="2100"
                                                            height="1200"
                                                            data-lazyload="<?php echo $fileNew; ?>"
                                                            data-bgposition="center center" data-bgfit="cover"
                                                            data-bgrepeat="no-repeat" class="rev-slidebg"
                                                            data-no-retina>
                                                        <div class="tp-caption Fashion-BigDisplay   tp-resizeme"
                                                             id="slide-97-layer-1" data-x="center" data-hoffset=""
                                                             data-y="center" data-voffset="-350" data-width="['auto']"
                                                             data-height="['auto']" data-type="text"
                                                             data-responsive_offset="on"
                                                             data-frames='[{"from":"y:50px;opacity:0;","speed":1000,"to":"o:1;","delay":1500,"ease":"Power4.easeOut"},{"delay":5900,"speed":600,"to":"y:50px;opacity:0;","ease":"Power4.easeIn"}]'
                                                             data-textAlign="['left','left','left','left']"
                                                             data-paddingtop="[0,0,0,0]" data-paddingright="[0,0,0,0]"
                                                             data-paddingbottom="[0,0,0,0]" data-paddingleft="[0,0,0,0]"
                                                             style="z-index: 90; white-space: nowrap; font-size: 120px; font-weight: 400; color: rgba(197,157,95,1);font-family:Great Vibes;text-transform:left;z-index:4;text-align:center;position:absolute;margin:0px;white-space:nowrap;letter-spacing:2px;">
                                                            <?php displayRandomElement($arPostTagsNames); ?>
                                                        </div>
                                                        <div class="tp-caption Fashion-BigDisplay   tp-resizeme"
                                                             id="slide-97-layer-2" data-x="center" data-hoffset=""
                                                             data-y="center" data-voffset="-270" data-width="['auto']"
                                                             data-height="['auto']" data-type="text"
                                                             data-responsive_offset="on"
                                                             data-frames='[{"from":"y:50px;opacity:0;","speed":1000,"to":"o:1;","delay":2000,"ease":"Power4.easeOut"},{"delay":5400,"speed":600,"to":"y:50px;opacity:0;","ease":"Power4.easeIn"}]'
                                                             data-textAlign="['left','left','left','left']"
                                                             data-paddingtop="[0,0,0,0]" data-paddingright="[0,0,0,0]"
                                                             data-paddingbottom="[0,0,0,0]" data-paddingleft="[0,0,0,0]"
                                                             style="z-index: 91; white-space: nowrap; font-size: 70px; font-weight: 800; color: rgba(255,255,255,1);font-family:Open Sans;text-transform:uppercase;text-decoration:none;z-index:4;text-align:center;letter-spacing:10px;">
                                                            <?php displayRandomElement($arPostTagsNames); ?>
                                                        </div>
                                                        <div class="tp-caption Fashion-BigDisplay   tp-resizeme"
                                                             id="slide-97-layer-3" data-x="center" data-hoffset=""
                                                             data-y="center" data-voffset="-200" data-width="['auto']"
                                                             data-height="['auto']" data-type="text"
                                                             data-responsive_offset="on"
                                                             data-frames='[{"from":"y:50px;opacity:0;","speed":600,"to":"o:1;","delay":2500,"ease":"Power4.easeOut"},{"delay":5300,"speed":600,"to":"y:50px;opacity:0;","ease":"Power4.easeIn"}]'
                                                             data-textAlign="['left','left','left','left']"
                                                             data-paddingtop="[0,0,0,0]" data-paddingright="[0,0,0,0]"
                                                             data-paddingbottom="[0,0,0,0]" data-paddingleft="[0,0,0,0]"
                                                             style="z-index: 92; white-space: nowrap; font-size: 70px; font-weight: 800; color: rgba(255,255,255,1);font-family:'Open Sans',sans-serif;text-transform:left;background-color:#c59d5f;z-index:4;height:3px;">
                                                            <div class="separator-line"></div>
                                                        </div>
                                                        <div class="tp-caption   tp-resizeme" id="slide-97-layer-4"
                                                             data-x="center" data-hoffset="-500" data-y="center"
                                                             data-voffset="-50"
                                                             data-width="['none','none','none','none']"
                                                             data-height="['none','none','none','none']"
                                                             data-type="image" data-responsive_offset="on"
                                                             data-frames='[{"from":"y:50px;opacity:0;","speed":600,"to":"o:1;","delay":3000,"ease":"Power4.easeOut"},{"delay":4800,"speed":600,"to":"y:50px;opacity:0;","ease":"Power4.easeIn"}]'
                                                             data-textAlign="['left','left','left','left']"
                                                             data-paddingtop="[0,0,0,0]" data-paddingright="[0,0,0,0]"
                                                             data-paddingbottom="[0,0,0,0]" data-paddingleft="[0,0,0,0]"
                                                             style="z-index: 93;text-transform:left;z-index:4;">
                                                            <?php
                                                            $filename = getRandomElement($arProjectImages);
                                                            $new_filen = $_SERVER["DOCUMENT_ROOT"].'/wp-content/uploads/' . basename($filename);


                                                            $fileNew = "/wp-content/uploads/" . basename($filename);

                                                            $fileNew = cropImage($filename,
                                                                $_SERVER['DOCUMENT_ROOT'] . $fileNew,
                                                                90, 90);
                                                            ?>
                                                            <img
                                                                src="http://wpdemos.themezaa.com/h-code/wp-content/plugins/revslider/admin/assets/images/dummy.png"
                                                                alt="" data-ww="90px" data-hh="90px" width="90"
                                                                height="90"
                                                                data-lazyload="<?php echo $fileNew; ?>"
                                                                data-no-retina></div>
                                                        <div class="tp-caption   tp-resizeme" id="slide-97-layer-5"
                                                             data-x="center" data-hoffset="-250" data-y="center"
                                                             data-voffset="-50"
                                                             data-width="['none','none','none','none']"
                                                             data-height="['none','none','none','none']"
                                                             data-type="image" data-responsive_offset="on"
                                                             data-frames='[{"from":"y:50px;opacity:0;","speed":600,"to":"o:1;","delay":3500,"ease":"Power4.easeOut"},{"delay":4300,"speed":600,"to":"y:50px;opacity:0;","ease":"Power4.easeIn"}]'
                                                             data-textAlign="['left','left','left','left']"
                                                             data-paddingtop="[0,0,0,0]" data-paddingright="[0,0,0,0]"
                                                             data-paddingbottom="[0,0,0,0]" data-paddingleft="[0,0,0,0]"
                                                             style="z-index: 94;text-transform:left;z-index:4;">
                                                            <?php
                                                            $filename = getRandomElement($arProjectImages);
                                                            $new_filen = $_SERVER["DOCUMENT_ROOT"].'/wp-content/uploads/' . basename($filename);


                                                            $fileNew = "/wp-content/uploads/" . basename($filename);

                                                            $fileNew = cropImage($filename,
                                                                $_SERVER['DOCUMENT_ROOT'] . $fileNew,
                                                                90, 90);
                                                            ?>
                                                            <img
                                                                src="http://wpdemos.themezaa.com/h-code/wp-content/plugins/revslider/admin/assets/images/dummy.png"
                                                                alt="" data-ww="90px" data-hh="90px" width="90"
                                                                height="90"
                                                                data-lazyload="<?php echo $fileNew; ?>"
                                                                data-no-retina></div>
                                                        <div class="tp-caption   tp-resizeme" id="slide-97-layer-6"
                                                             data-x="center" data-hoffset="" data-y="center"
                                                             data-voffset="-50"
                                                             data-width="['none','none','none','none']"
                                                             data-height="['none','none','none','none']"
                                                             data-type="image" data-responsive_offset="on"
                                                             data-frames='[{"from":"y:50px;opacity:0;","speed":600,"to":"o:1;","delay":4000,"ease":"Power4.easeOut"},{"delay":3800,"speed":600,"to":"y:50px;opacity:0;","ease":"Power4.easeIn"}]'
                                                             data-textAlign="['left','left','left','left']"
                                                             data-paddingtop="[0,0,0,0]" data-paddingright="[0,0,0,0]"
                                                             data-paddingbottom="[0,0,0,0]" data-paddingleft="[0,0,0,0]"
                                                             style="z-index: 95;text-transform:left;z-index:4;">
                                                            <?php
                                                            $filename = getRandomElement($arProjectImages);
                                                            $new_filen = $_SERVER["DOCUMENT_ROOT"].'/wp-content/uploads/' . basename($filename);


                                                            $fileNew = "/wp-content/uploads/" . basename($filename);

                                                            $fileNew = cropImage($filename,
                                                                $_SERVER['DOCUMENT_ROOT'] . $fileNew,
                                                                90, 90);
                                                            ?>
                                                            <img
                                                                src="http://wpdemos.themezaa.com/h-code/wp-content/plugins/revslider/admin/assets/images/dummy.png"
                                                                alt="" data-ww="90px" data-hh="90px" width="90"
                                                                height="90"
                                                                data-lazyload="<?php echo $fileNew; ?>"
                                                                data-no-retina></div>
                                                        <div class="tp-caption   tp-resizeme" id="slide-97-layer-7"
                                                             data-x="center" data-hoffset="250" data-y="center"
                                                             data-voffset="-50"
                                                             data-width="['none','none','none','none']"
                                                             data-height="['none','none','none','none']"
                                                             data-type="image" data-responsive_offset="on"
                                                             data-frames='[{"from":"y:50px;opacity:0;","speed":600,"to":"o:1;","delay":4500,"ease":"Power4.easeOut"},{"delay":3300,"speed":600,"to":"y:50px;opacity:0;","ease":"Power4.easeIn"}]'
                                                             data-textAlign="['left','left','left','left']"
                                                             data-paddingtop="[0,0,0,0]" data-paddingright="[0,0,0,0]"
                                                             data-paddingbottom="[0,0,0,0]" data-paddingleft="[0,0,0,0]"
                                                             style="z-index: 96;text-transform:left;z-index:4;">
                                                            <?php
                                                            $filename = getRandomElement($arProjectImages);
                                                            $new_filen = $_SERVER["DOCUMENT_ROOT"].'/wp-content/uploads/' . basename($filename);


                                                            $fileNew = "/wp-content/uploads/" . basename($filename);

                                                            $fileNew = cropImage($filename,
                                                                $_SERVER['DOCUMENT_ROOT'] . $fileNew,
                                                                90, 90);
                                                            ?>
                                                            <img
                                                                src="http://wpdemos.themezaa.com/h-code/wp-content/plugins/revslider/admin/assets/images/dummy.png"
                                                                alt="" data-ww="90px" data-hh="90px" width="90"
                                                                height="90"
                                                                data-lazyload="<?php echo $fileNew; ?>"
                                                                data-no-retina></div>
                                                        <div class="tp-caption   tp-resizeme" id="slide-97-layer-8"
                                                             data-x="center" data-hoffset="500" data-y="center"
                                                             data-voffset="-50"
                                                             data-width="['none','none','none','none']"
                                                             data-height="['none','none','none','none']"
                                                             data-type="image" data-responsive_offset="on"
                                                             data-frames='[{"from":"y:50px;opacity:0;","speed":600,"to":"o:1;","delay":5000,"ease":"Power4.easeOut"},{"delay":2800,"speed":600,"to":"y:50px;opacity:0;","ease":"Power4.easeIn"}]'
                                                             data-textAlign="['left','left','left','left']"
                                                             data-paddingtop="[0,0,0,0]" data-paddingright="[0,0,0,0]"
                                                             data-paddingbottom="[0,0,0,0]" data-paddingleft="[0,0,0,0]"
                                                             style="z-index: 97;text-transform:left;z-index:4;">
                                                            <?php
                                                            $filename = getRandomElement($arProjectImages);
                                                            $new_filen = $_SERVER["DOCUMENT_ROOT"].'/wp-content/uploads/' . basename($filename);


                                                            $fileNew = "/wp-content/uploads/" . basename($filename);

                                                            $fileNew = cropImage($filename,
                                                                $_SERVER['DOCUMENT_ROOT'] . $fileNew,
                                                                90, 90);
                                                            ?>
                                                            <img
                                                                src="http://wpdemos.themezaa.com/h-code/wp-content/plugins/revslider/admin/assets/images/dummy.png"
                                                                alt="" data-ww="90px" data-hh="90px" width="90"
                                                                height="90"
                                                                data-lazyload="<?php echo $fileNew; ?>"
                                                                data-no-retina></div>
                                                        <div class="tp-caption Fashion-BigDisplay   tp-resizeme"
                                                             id="slide-97-layer-9" data-x="center" data-hoffset="-500"
                                                             data-y="center" data-voffset="20" data-width="['auto']"
                                                             data-height="['auto']" data-type="text"
                                                             data-responsive_offset="on"
                                                             data-frames='[{"from":"y:50px;opacity:0;","speed":600,"to":"o:1;","delay":7500,"ease":"Power4.easeOut"},{"delay":300,"speed":600,"to":"y:50px;opacity:0;","ease":"Power4.easeIn"}]'
                                                             data-textAlign="['left','left','left','left']"
                                                             data-paddingtop="[0,0,0,0]" data-paddingright="[0,0,0,0]"
                                                             data-paddingbottom="[0,0,0,0]" data-paddingleft="[0,0,0,0]"
                                                             style="z-index: 98; white-space: nowrap; font-size: 18px; line-height: 30px; font-weight: 400; color: rgba(255,255,255,1);font-family:Open Sans;text-transform:uppercase;z-index:4;position:absolute;margin:0px;white-space:nowrap;letter-spacing:normal;">
                                                            <?php displayRandomElement($arPostTagsNames); ?>
                                                        </div>
                                                        <div class="tp-caption Fashion-BigDisplay   tp-resizeme"
                                                             id="slide-97-layer-10" data-x="center" data-hoffset="-250"
                                                             data-y="center" data-voffset="20" data-width="['auto']"
                                                             data-height="['auto']" data-type="text"
                                                             data-responsive_offset="on"
                                                             data-frames='[{"from":"y:50px;opacity:0;","speed":600,"to":"o:1;","delay":7000,"ease":"Power4.easeOut"},{"delay":800,"speed":600,"to":"y:50px;opacity:0;","ease":"Power4.easeIn"}]'
                                                             data-textAlign="['left','left','left','left']"
                                                             data-paddingtop="[0,0,0,0]" data-paddingright="[0,0,0,0]"
                                                             data-paddingbottom="[0,0,0,0]" data-paddingleft="[0,0,0,0]"
                                                             style="z-index: 99; white-space: nowrap; font-size: 18px; line-height: 30px; font-weight: 400; color: rgba(255,255,255,1);font-family:Open Sans;text-transform:uppercase;z-index:4;position:absolute;margin:0px;white-space:nowrap;letter-spacing:normal;">
                                                            <?php displayRandomElement($arPostTagsNames); ?>
                                                        </div>
                                                        <div class="tp-caption Fashion-BigDisplay   tp-resizeme"
                                                             id="slide-97-layer-11" data-x="center" data-hoffset=""
                                                             data-y="center" data-voffset="20" data-width="['auto']"
                                                             data-height="['auto']" data-type="text"
                                                             data-responsive_offset="on"
                                                             data-frames='[{"from":"y:50px;opacity:0;","speed":600,"to":"o:1;","delay":6500,"ease":"Power4.easeOut"},{"delay":1300,"speed":600,"to":"y:50px;opacity:0;","ease":"Power4.easeIn"}]'
                                                             data-textAlign="['left','left','left','left']"
                                                             data-paddingtop="[0,0,0,0]" data-paddingright="[0,0,0,0]"
                                                             data-paddingbottom="[0,0,0,0]" data-paddingleft="[0,0,0,0]"
                                                             style="z-index: 100; white-space: nowrap; font-size: 18px; line-height: 30px; font-weight: 400; color: rgba(255,255,255,1);font-family:Open Sans;text-transform:uppercase;z-index:4;position:absolute;margin:0px;white-space:nowrap;letter-spacing:normal;">
                                                            <?php displayRandomElement($arPostTagsNames); ?>
                                                        </div>
                                                        <div class="tp-caption Fashion-BigDisplay   tp-resizeme"
                                                             id="slide-97-layer-12" data-x="center" data-hoffset="250"
                                                             data-y="center" data-voffset="20" data-width="['auto']"
                                                             data-height="['auto']" data-type="text"
                                                             data-responsive_offset="on"
                                                             data-frames='[{"from":"y:50px;opacity:0;","speed":600,"to":"o:1;","delay":6000,"ease":"Power4.easeOut"},{"delay":1800,"speed":600,"to":"y:50px;opacity:0;","ease":"Power4.easeIn"}]'
                                                             data-textAlign="['left','left','left','left']"
                                                             data-paddingtop="[0,0,0,0]" data-paddingright="[0,0,0,0]"
                                                             data-paddingbottom="[0,0,0,0]" data-paddingleft="[0,0,0,0]"
                                                             style="z-index: 101; white-space: nowrap; font-size: 18px; line-height: 30px; font-weight: 400; color: rgba(255,255,255,1);font-family:Open Sans;text-transform:uppercase;z-index:4;position:absolute;margin:0px;white-space:nowrap;letter-spacing:normal;">
                                                            <?php displayRandomElement($arPostTagsNames); ?>
                                                        </div>
                                                        <div class="tp-caption Fashion-BigDisplay   tp-resizeme"
                                                             id="slide-97-layer-13" data-x="center" data-hoffset="500"
                                                             data-y="center" data-voffset="20" data-width="['auto']"
                                                             data-height="['auto']" data-type="text"
                                                             data-responsive_offset="on"
                                                             data-frames='[{"from":"y:50px;opacity:0;","speed":600,"to":"o:1;","delay":5500,"ease":"Power4.easeOut"},{"delay":2300,"speed":600,"to":"y:50px;opacity:0;","ease":"Power4.easeIn"}]'
                                                             data-textAlign="['left','left','left','left']"
                                                             data-paddingtop="[0,0,0,0]" data-paddingright="[0,0,0,0]"
                                                             data-paddingbottom="[0,0,0,0]" data-paddingleft="[0,0,0,0]"
                                                             style="z-index: 102; white-space: nowrap; font-size: 18px; line-height: 30px; font-weight: 400; color: rgba(255,255,255,1);font-family:Open Sans;text-transform:uppercase;z-index:4;position:absolute;margin:0px;white-space:nowrap;letter-spacing:normal;">
                                                            <?php displayRandomElement($arPostTagsNames); ?>
                                                        </div>
                                                    </li>
                                                    <li data-index="rs-98" data-transition="fade" data-slotamount="1"
                                                        data-hideafterloop="0" data-hideslideonmobile="off"
                                                        data-easein="default" data-easeout="default"
                                                        data-masterspeed="500" data-delay="13000" data-rotate="0"
                                                        data-saveperformance="off" class="no-transition"
                                                        data-title="<?php displayRandomElement($arPostTagsNames); ?>" data-param1="" data-param2=""
                                                        data-param3="" data-param4="" data-param5="" data-param6=""
                                                        data-param7="" data-param8="" data-param9="" data-param10=""
                                                        data-description="">
                                                        <?php
                                                        $filename = getRandomElement($arProjectImages);
                                                        $new_filen = $_SERVER["DOCUMENT_ROOT"].'/wp-content/uploads/' . basename($filename);


                                                        $fileNew = "/wp-content/uploads/" . basename($filename);

                                                        $fileNew = cropImage($filename,
                                                            $_SERVER['DOCUMENT_ROOT'] . $fileNew,
                                                            2000, 1150);
                                                        ?>
                                                        <img
                                                            src="http://wpdemos.themezaa.com/h-code/wp-content/plugins/revslider/admin/assets/images/dummy.png"
                                                            alt="" title="intro-restaurant-08-01.jpg" width="2000"
                                                            height="1150"
                                                            data-lazyload="<?php echo $fileNew; ?>"
                                                            data-bgposition="center center" data-bgfit="cover"
                                                            data-bgrepeat="no-repeat" class="rev-slidebg"
                                                            data-no-retina>
                                                        <div class="tp-caption Fashion-BigDisplay   tp-resizeme"
                                                             id="slide-98-layer-1" data-x="center" data-hoffset=""
                                                             data-y="center" data-voffset="-350" data-width="['auto']"
                                                             data-height="['auto']" data-type="text"
                                                             data-responsive_offset="on"
                                                             data-frames='[{"from":"y:50px;opacity:0;","speed":1000,"to":"o:1;","delay":1500,"ease":"Power4.easeOut"},{"delay":9900,"speed":600,"to":"y:50px;opacity:0;","ease":"Power4.easeIn"}]'
                                                             data-textAlign="['left','left','left','left']"
                                                             data-paddingtop="[0,0,0,0]" data-paddingright="[0,0,0,0]"
                                                             data-paddingbottom="[0,0,0,0]" data-paddingleft="[0,0,0,0]"
                                                             style="z-index: 103; white-space: nowrap; font-size: 120px; font-weight: 400; color: rgba(197,157,95,1);font-family:Great Vibes;text-transform:left;z-index:4;text-align:center;position:absolute;margin:0px;white-space:nowrap;letter-spacing:2px;">
                                                            <?php displayRandomElement($arPostTagsNames); ?>
                                                        </div>
                                                        <div class="tp-caption Fashion-BigDisplay   tp-resizeme"
                                                             id="slide-98-layer-2" data-x="center" data-hoffset=""
                                                             data-y="center" data-voffset="-270" data-width="['auto']"
                                                             data-height="['auto']" data-type="text"
                                                             data-responsive_offset="on"
                                                             data-frames='[{"from":"y:50px;opacity:0;","speed":1000,"to":"o:1;","delay":2000,"ease":"Power4.easeOut"},{"delay":9400,"speed":600,"to":"y:-50px;opacity:0;","ease":"Power4.easeIn"}]'
                                                             data-textAlign="['left','left','left','left']"
                                                             data-paddingtop="[0,0,0,0]" data-paddingright="[0,0,0,0]"
                                                             data-paddingbottom="[0,0,0,0]" data-paddingleft="[0,0,0,0]"
                                                             style="z-index: 104; white-space: nowrap; font-size: 70px; font-weight: 800; color: rgba(255,255,255,1);font-family:Open Sans;text-transform:uppercase;text-decoration:none;z-index:4;text-align:center;letter-spacing:10px;">
                                                            <?php displayRandomElement($arPostTagsNames); ?>
                                                        </div>
                                                        <div class="tp-caption Fashion-BigDisplay   tp-resizeme"
                                                             id="slide-98-layer-3" data-x="center" data-hoffset=""
                                                             data-y="center" data-voffset="-200" data-width="['auto']"
                                                             data-height="['auto']" data-type="text"
                                                             data-responsive_offset="on"
                                                             data-frames='[{"from":"y:50px;opacity:0;","speed":600,"to":"o:1;","delay":2500,"ease":"Power4.easeOut"},{"delay":9300,"speed":600,"to":"y:50px;opacity:0;","ease":"Power4.easeIn"}]'
                                                             data-textAlign="['left','left','left','left']"
                                                             data-paddingtop="[0,0,0,0]" data-paddingright="[0,0,0,0]"
                                                             data-paddingbottom="[0,0,0,0]" data-paddingleft="[0,0,0,0]"
                                                             style="z-index: 105; white-space: nowrap; font-size: 70px; font-weight: 800; color: rgba(255,255,255,1);font-family:'Open Sans',sans-serif;text-transform:left;background-color:#c59d5f;z-index:4;height:3px;">
                                                            <div class="separator-line"></div>
                                                        </div>
                                                        <div class="tp-caption   tp-resizeme" id="slide-98-layer-4"
                                                             data-x="center" data-hoffset="-430" data-y="center"
                                                             data-voffset="140"
                                                             data-width="['none','none','none','none']"
                                                             data-height="['none','none','none','none']"
                                                             data-type="image" data-responsive_offset="on"
                                                             data-frames='[{"from":"y:50px;opacity:0;","speed":600,"to":"o:1;","delay":3000,"ease":"Power4.easeOut"},{"delay":8800,"speed":600,"to":"y:50px;opacity:0;","ease":"Power4.easeIn"}]'
                                                             data-textAlign="['left','left','left','left']"
                                                             data-paddingtop="[0,0,0,0]" data-paddingright="[0,0,0,0]"
                                                             data-paddingbottom="[0,0,0,0]" data-paddingleft="[0,0,0,0]"
                                                             style="z-index: 106;text-transform:left;z-index:4;">
                                                            <?php
                                                            $filename = getRandomElement($arProjectImages);
                                                            $new_filen = $_SERVER["DOCUMENT_ROOT"].'/wp-content/uploads/' . basename($filename);


                                                            $fileNew = "/wp-content/uploads/" . basename($filename);

                                                            $fileNew = cropImage($filename,
                                                                $_SERVER['DOCUMENT_ROOT'] . $fileNew,
                                                                358, 576);
                                                            ?>
                                                            <img
                                                                src="http://wpdemos.themezaa.com/h-code/wp-content/plugins/revslider/admin/assets/images/dummy.png"
                                                                alt="" data-ww="358px" data-hh="576px" width="358"
                                                                height="576"
                                                                data-lazyload="<?php echo $fileNew; ?>"
                                                                data-no-retina></div>
                                                        <div class="tp-caption   tp-resizeme" id="slide-98-layer-5"
                                                             data-x="center" data-hoffset="-430" data-y="center"
                                                             data-voffset="34"
                                                             data-width="['none','none','none','none']"
                                                             data-height="['none','none','none','none']"
                                                             data-type="image" data-responsive_offset="on"
                                                             data-frames='[{"from":"y:50px;opacity:0;","speed":600,"to":"o:1;","delay":3500,"ease":"Power4.easeOut"},{"delay":8300,"speed":600,"to":"y:50px;opacity:0;","ease":"Power4.easeIn"}]'
                                                             data-textAlign="['left','left','left','left']"
                                                             data-paddingtop="[0,0,0,0]" data-paddingright="[0,0,0,0]"
                                                             data-paddingbottom="[0,0,0,0]" data-paddingleft="[0,0,0,0]"
                                                             style="z-index: 107;text-transform:left;z-index:4;">
                                                            <?php
                                                            $filename = getRandomElement($arProjectImages);
                                                            $new_filen = $_SERVER["DOCUMENT_ROOT"].'/wp-content/uploads/' . basename($filename);


                                                            $fileNew = "/wp-content/uploads/" . basename($filename);

                                                            $fileNew = cropImage($filename,
                                                                $_SERVER['DOCUMENT_ROOT'] . $fileNew,
                                                                318, 318);
                                                            ?>
                                                            <img
                                                                src="http://wpdemos.themezaa.com/h-code/wp-content/plugins/revslider/admin/assets/images/dummy.png"
                                                                alt="" data-ww="318px" data-hh="318px" width="318"
                                                                height="318"
                                                                data-lazyload="<?php echo $fileNew; ?>"
                                                                data-no-retina></div>
                                                        <div class="tp-caption Fashion-BigDisplay   tp-resizeme"
                                                             id="slide-98-layer-6" data-x="center" data-hoffset="-430"
                                                             data-y="center" data-voffset="230" data-width="['auto']"
                                                             data-height="['auto']" data-type="text"
                                                             data-responsive_offset="on"
                                                             data-frames='[{"from":"y:50px;opacity:0;","speed":1000,"to":"o:1;","delay":4000,"ease":"Power2.easeInOut"},{"delay":7000,"speed":1000,"to":"y:50px;opacity:0;","ease":"Power4.easeIn"}]'
                                                             data-textAlign="['left','left','left','left']"
                                                             data-paddingtop="[0,0,0,0]" data-paddingright="[0,0,0,0]"
                                                             data-paddingbottom="[0,0,0,0]" data-paddingleft="[0,0,0,0]"
                                                             style="z-index: 108; white-space: nowrap; font-size: 20px; line-height: 24px; font-weight: 600; color: rgba(255,255,255,1);font-family:Open Sans;text-transform:uppercase;text-decoration:none;z-index:4;letter-spacing:normal;">
                                                            <?php displayRandomElement($arPostTagsNames); ?>
                                                        </div>
                                                        <div class="tp-caption Fashion-BigDisplay   tp-resizeme"
                                                             id="slide-98-layer-7" data-x="center" data-hoffset="-430"
                                                             data-y="center" data-voffset="255" data-width="['auto']"
                                                             data-height="['auto']" data-type="text"
                                                             data-responsive_offset="on"
                                                             data-frames='[{"from":"y:50px;opacity:0;","speed":1000,"to":"o:1;","delay":4500,"ease":"Power4.easeOut"},{"delay":6500,"speed":1000,"to":"y:50px;opacity:0;","ease":"Power4.easeIn"}]'
                                                             data-textAlign="['left','left','left','left']"
                                                             data-paddingtop="[0,0,0,0]" data-paddingright="[0,0,0,0]"
                                                             data-paddingbottom="[0,0,0,0]" data-paddingleft="[0,0,0,0]"
                                                             style="z-index: 109; white-space: nowrap; font-size: 13px; line-height: 18px; font-weight: 600; color: rgba(255,255,255,1);font-family:Open Sans;text-transform:uppercase;text-decoration:none;z-index:4;letter-spacing:normal;">
                                                            <?php displayRandomElement($arPostTagsNames); ?>
                                                        </div>
                                                        <div class="tp-caption Fashion-BigDisplay   tp-resizeme"
                                                             id="slide-98-layer-8" data-x="center" data-hoffset="-430"
                                                             data-y="center" data-voffset="340" data-width="['auto']"
                                                             data-height="['auto']" data-type="text"
                                                             data-responsive_offset="on"
                                                             data-frames='[{"from":"y:50px;opacity:0;","speed":1000,"to":"o:1;","delay":5000,"ease":"Power4.easeOut"},{"delay":6000,"speed":1000,"to":"y:50px;opacity:0;","ease":"Power4.easeIn"}]'
                                                             data-textAlign="['left','left','left','left']"
                                                             data-paddingtop="[0,0,0,0]" data-paddingright="[0,0,0,0]"
                                                             data-paddingbottom="[0,0,0,0]" data-paddingleft="[0,0,0,0]"
                                                             style="z-index: 110; white-space: nowrap; font-size: 13px; line-height: 18px; font-weight: 400; color: rgba(255,255,255,1);font-family:Open Sans;text-transform:left;text-decoration:none;z-index:4;text-align:center;letter-spacing:2px;">
                                                            <?php displayRandomElement($arPostTagsNames); ?>
                                                        </div>
                                                        <div class="tp-caption   tp-resizeme" id="slide-98-layer-9"
                                                             data-x="center" data-hoffset="" data-y="center"
                                                             data-voffset="140"
                                                             data-width="['none','none','none','none']"
                                                             data-height="['none','none','none','none']"
                                                             data-type="image" data-responsive_offset="on"
                                                             data-frames='[{"from":"y:50px;opacity:0;","speed":1000,"to":"o:1;","delay":5500,"ease":"Power4.easeOut"},{"delay":5900,"speed":600,"to":"y:50px;opacity:0;","ease":"Power4.easeIn"}]'
                                                             data-textAlign="['left','left','left','left']"
                                                             data-paddingtop="[0,0,0,0]" data-paddingright="[0,0,0,0]"
                                                             data-paddingbottom="[0,0,0,0]" data-paddingleft="[0,0,0,0]"
                                                             style="z-index: 111;text-transform:left;z-index:4;">
                                                            <?php
                                                            $filename = getRandomElement($arProjectImages);
                                                            $new_filen = $_SERVER["DOCUMENT_ROOT"].'/wp-content/uploads/' . basename($filename);


                                                            $fileNew = "/wp-content/uploads/" . basename($filename);

                                                            $fileNew = cropImage($filename,
                                                                $_SERVER['DOCUMENT_ROOT'] . $fileNew,
                                                                358, 576);
                                                            ?>
                                                            <img
                                                                src="http://wpdemos.themezaa.com/h-code/wp-content/plugins/revslider/admin/assets/images/dummy.png"
                                                                alt="" data-ww="358px" data-hh="576px" width="358"
                                                                height="576"
                                                                data-lazyload="<?php echo $fileNew; ?>"
                                                                data-no-retina></div>
                                                        <div class="tp-caption   tp-resizeme" id="slide-98-layer-10"
                                                             data-x="center" data-hoffset="" data-y="center"
                                                             data-voffset="34"
                                                             data-width="['none','none','none','none']"
                                                             data-height="['none','none','none','none']"
                                                             data-type="image" data-responsive_offset="on"
                                                             data-frames='[{"from":"y:50px;opacity:0;","speed":1000,"to":"o:1;","delay":6000,"ease":"Power4.easeOut"},{"delay":5400,"speed":600,"to":"y:50px;opacity:0;","ease":"Power4.easeIn"}]'
                                                             data-textAlign="['left','left','left','left']"
                                                             data-paddingtop="[0,0,0,0]" data-paddingright="[0,0,0,0]"
                                                             data-paddingbottom="[0,0,0,0]" data-paddingleft="[0,0,0,0]"
                                                             style="z-index: 112;text-transform:left;z-index:4;">
                                                            <?php
                                                            $filename = getRandomElement($arProjectImages);
                                                            $new_filen = $_SERVER["DOCUMENT_ROOT"].'/wp-content/uploads/' . basename($filename);


                                                            $fileNew = "/wp-content/uploads/" . basename($filename);

                                                            $fileNew = cropImage($filename,
                                                                $_SERVER['DOCUMENT_ROOT'] . $fileNew,
                                                                318, 318);
                                                            ?>
                                                            <img
                                                                src="http://wpdemos.themezaa.com/h-code/wp-content/plugins/revslider/admin/assets/images/dummy.png"
                                                                alt="" data-ww="318px" data-hh="318px" width="318"
                                                                height="318"
                                                                data-lazyload="<?php echo $fileNew; ?>"
                                                                data-no-retina></div>
                                                        <div class="tp-caption Fashion-BigDisplay   tp-resizeme"
                                                             id="slide-98-layer-11" data-x="center" data-hoffset=""
                                                             data-y="center" data-voffset="230" data-width="['auto']"
                                                             data-height="['auto']" data-type="text"
                                                             data-responsive_offset="on"
                                                             data-frames='[{"from":"y:50px;opacity:0;","speed":1000,"to":"o:1;","delay":6500,"ease":"Power4.easeOut"},{"delay":4500,"speed":1000,"to":"y:50px;opacity:0;","ease":"Power4.easeIn"}]'
                                                             data-textAlign="['left','left','left','left']"
                                                             data-paddingtop="[0,0,0,0]" data-paddingright="[0,0,0,0]"
                                                             data-paddingbottom="[0,0,0,0]" data-paddingleft="[0,0,0,0]"
                                                             style="z-index: 113; white-space: nowrap; font-size: 20px; line-height: 24px; font-weight: 600; color: rgba(255,255,255,1);font-family:Open Sans;text-transform:uppercase;text-decoration:none;z-index:4;letter-spacing:normal;">
                                                            <?php displayRandomElement($arPostTagsNames); ?>
                                                        </div>
                                                        <div class="tp-caption Fashion-BigDisplay   tp-resizeme"
                                                             id="slide-98-layer-12" data-x="center" data-hoffset=""
                                                             data-y="center" data-voffset="255" data-width="['auto']"
                                                             data-height="['auto']" data-type="text"
                                                             data-responsive_offset="on"
                                                             data-frames='[{"from":"y:50px;opacity:0;","speed":1000,"to":"o:1;","delay":7000,"ease":"Power4.easeOut"},{"delay":4000,"speed":1000,"to":"y:50px;opacity:0;","ease":"Power4.easeIn"}]'
                                                             data-textAlign="['left','left','left','left']"
                                                             data-paddingtop="[0,0,0,0]" data-paddingright="[0,0,0,0]"
                                                             data-paddingbottom="[0,0,0,0]" data-paddingleft="[0,0,0,0]"
                                                             style="z-index: 114; white-space: nowrap; font-size: 13px; line-height: 18px; font-weight: 600; color: rgba(255,255,255,1);font-family:Open Sans;text-transform:uppercase;text-decoration:none;z-index:4;letter-spacing:normal;">
                                                            <?php displayRandomElement($arPostTagsNames); ?>
                                                        </div>
                                                        <div class="tp-caption Fashion-BigDisplay   tp-resizeme"
                                                             id="slide-98-layer-13" data-x="center" data-hoffset=""
                                                             data-y="center" data-voffset="340" data-width="['auto']"
                                                             data-height="['auto']" data-type="text"
                                                             data-responsive_offset="on"
                                                             data-frames='[{"from":"y:50px;opacity:0;","speed":1000,"to":"o:1;","delay":7500,"ease":"Power2.easeInOut"},{"delay":3500,"speed":1000,"to":"y:50px;opacity:0;","ease":"Power4.easeIn"}]'
                                                             data-textAlign="['left','left','left','left']"
                                                             data-paddingtop="[0,0,0,0]" data-paddingright="[0,0,0,0]"
                                                             data-paddingbottom="[0,0,0,0]" data-paddingleft="[0,0,0,0]"
                                                             style="z-index: 115; white-space: nowrap; font-size: 13px; line-height: 18px; font-weight: 400; color: rgba(255,255,255,1);font-family:Open Sans;text-transform:left;text-decoration:none;z-index:4;text-align:center;letter-spacing:2px;">
                                                            <?php displayRandomElement($arPostTagsNames); ?>
                                                        </div>
                                                        <div class="tp-caption   tp-resizeme" id="slide-98-layer-14"
                                                             data-x="center" data-hoffset="430" data-y="center"
                                                             data-voffset="140"
                                                             data-width="['none','none','none','none']"
                                                             data-height="['none','none','none','none']"
                                                             data-type="image" data-responsive_offset="on"
                                                             data-frames='[{"from":"y:50px;opacity:0;","speed":1000,"to":"o:1;","delay":8000,"ease":"Power4.easeOut"},{"delay":3400,"speed":600,"to":"y:50px;opacity:0;","ease":"Power4.easeIn"}]'
                                                             data-textAlign="['left','left','left','left']"
                                                             data-paddingtop="[0,0,0,0]" data-paddingright="[0,0,0,0]"
                                                             data-paddingbottom="[0,0,0,0]" data-paddingleft="[0,0,0,0]"
                                                             style="z-index: 116;text-transform:left;z-index:4;">
                                                            <?php
                                                            $filename = getRandomElement($arProjectImages);
                                                            $new_filen = $_SERVER["DOCUMENT_ROOT"].'/wp-content/uploads/' . basename($filename);


                                                            $fileNew = "/wp-content/uploads/" . basename($filename);

                                                            $fileNew = cropImage($filename,
                                                                $_SERVER['DOCUMENT_ROOT'] . $fileNew,
                                                                358, 576);
                                                            ?>
                                                            <img
                                                                src="http://wpdemos.themezaa.com/h-code/wp-content/plugins/revslider/admin/assets/images/dummy.png"
                                                                alt="" data-ww="358px" data-hh="576px" width="358"
                                                                height="576"
                                                                data-lazyload="<?php echo $fileNew; ?>"
                                                                data-no-retina></div>
                                                        <div class="tp-caption   tp-resizeme" id="slide-98-layer-15"
                                                             data-x="center" data-hoffset="430" data-y="center"
                                                             data-voffset="34"
                                                             data-width="['none','none','none','none']"
                                                             data-height="['none','none','none','none']"
                                                             data-type="image" data-responsive_offset="on"
                                                             data-frames='[{"from":"y:50px;opacity:0;","speed":1000,"to":"o:1;","delay":8500,"ease":"Power4.easeOut"},{"delay":2900,"speed":600,"to":"y:50px;opacity:0;","ease":"Power4.easeIn"}]'
                                                             data-textAlign="['left','left','left','left']"
                                                             data-paddingtop="[0,0,0,0]" data-paddingright="[0,0,0,0]"
                                                             data-paddingbottom="[0,0,0,0]" data-paddingleft="[0,0,0,0]"
                                                             style="z-index: 117;text-transform:left;z-index:4;">
                                                            <?php
                                                            $filename = getRandomElement($arProjectImages);
                                                            $new_filen = $_SERVER["DOCUMENT_ROOT"].'/wp-content/uploads/' . basename($filename);


                                                            $fileNew = "/wp-content/uploads/" . basename($filename);

                                                            $fileNew = cropImage($filename,
                                                                $_SERVER['DOCUMENT_ROOT'] . $fileNew,
                                                                318, 318);
                                                            ?>
                                                            <img
                                                                src="http://wpdemos.themezaa.com/h-code/wp-content/plugins/revslider/admin/assets/images/dummy.png"
                                                                alt="" data-ww="318px" data-hh="318px" width="318"
                                                                height="318"
                                                                data-lazyload="<?php echo $fileNew; ?>"
                                                                data-no-retina></div>
                                                        <div class="tp-caption Fashion-BigDisplay   tp-resizeme"
                                                             id="slide-98-layer-16" data-x="center" data-hoffset="430"
                                                             data-y="center" data-voffset="230" data-width="['auto']"
                                                             data-height="['auto']" data-type="text"
                                                             data-responsive_offset="on"
                                                             data-frames='[{"from":"y:50px;opacity:0;","speed":1000,"to":"o:1;","delay":9000,"ease":"Power4.easeOut"},{"delay":2000,"speed":1000,"to":"y:50px;opacity:0;","ease":"Power4.easeIn"}]'
                                                             data-textAlign="['left','left','left','left']"
                                                             data-paddingtop="[0,0,0,0]" data-paddingright="[0,0,0,0]"
                                                             data-paddingbottom="[0,0,0,0]" data-paddingleft="[0,0,0,0]"
                                                             style="z-index: 118; white-space: nowrap; font-size: 20px; line-height: 24px; font-weight: 600; color: rgba(255,255,255,1);font-family:Open Sans;text-transform:uppercase;text-decoration:none;z-index:4;">
                                                            <?php displayRandomElement($arPostTagsNames); ?>
                                                        </div>
                                                        <div class="tp-caption Fashion-BigDisplay   tp-resizeme"
                                                             id="slide-98-layer-17" data-x="center" data-hoffset="431"
                                                             data-y="center" data-voffset="255" data-width="['auto']"
                                                             data-height="['auto']" data-type="text"
                                                             data-responsive_offset="on"
                                                             data-frames='[{"from":"y:50px;opacity:0;","speed":1000,"to":"o:1;","delay":9500,"ease":"Power4.easeOut"},{"delay":1500,"speed":1000,"to":"y:50px;opacity:0;","ease":"Power4.easeIn"}]'
                                                             data-textAlign="['left','left','left','left']"
                                                             data-paddingtop="[0,0,0,0]" data-paddingright="[0,0,0,0]"
                                                             data-paddingbottom="[0,0,0,0]" data-paddingleft="[0,0,0,0]"
                                                             style="z-index: 119; white-space: nowrap; font-size: 13px; line-height: 18px; font-weight: 600; color: rgba(255,255,255,1);font-family:Open Sans;text-transform:uppercase;text-decoration:none;z-index:4;letter-spacing:normal;">
                                                            <?php displayRandomElement($arPostTagsNames); ?>
                                                        </div>
                                                        <div class="tp-caption Fashion-BigDisplay   tp-resizeme"
                                                             id="slide-98-layer-18" data-x="center" data-hoffset="430"
                                                             data-y="center" data-voffset="340" data-width="['auto']"
                                                             data-height="['auto']" data-type="text"
                                                             data-responsive_offset="on"
                                                             data-frames='[{"from":"y:50px;opacity:0;","speed":1000,"to":"o:1;","delay":10000,"ease":"Power2.easeInOut"},{"delay":1000,"speed":1000,"to":"y:50px;opacity:0;","ease":"Power4.easeIn"}]'
                                                             data-textAlign="['left','left','left','left']"
                                                             data-paddingtop="[0,0,0,0]" data-paddingright="[0,0,0,0]"
                                                             data-paddingbottom="[0,0,0,0]" data-paddingleft="[0,0,0,0]"
                                                             style="z-index: 120; white-space: nowrap; font-size: 13px; line-height: 18px; font-weight: 400; color: rgba(255,255,255,1);font-family:Open Sans;text-transform:left;text-decoration:none;z-index:4;text-align:center;letter-spacing:2px;">
                                                            <?php displayRandomElement($arPostTagsNames); ?>
                                                        </div>
                                                    </li>
                                                    <li data-index="rs-99" data-transition="fade" data-slotamount="1"
                                                        data-hideafterloop="0" data-hideslideonmobile="off"
                                                        data-easein="default" data-easeout="default"
                                                        data-masterspeed="500" data-delay="5000" data-rotate="0"
                                                        data-saveperformance="off" class="no-transition"
                                                        data-title="<?php displayRandomElement($arPostTagsNames); ?>" data-param1="" data-param2=""
                                                        data-param3="" data-param4="" data-param5="" data-param6=""
                                                        data-param7="" data-param8="" data-param9="" data-param10=""
                                                        data-description="">
                                                        <?php
                                                        $filename = getRandomElement($arProjectImages);
                                                        $new_filen = $_SERVER["DOCUMENT_ROOT"].'/wp-content/uploads/' . basename($filename);


                                                        $fileNew = "/wp-content/uploads/" . basename($filename);

                                                        $fileNew = cropImage($filename,
                                                            $_SERVER['DOCUMENT_ROOT'] . $fileNew,
                                                            2100, 1201);
                                                        ?>
                                                        <img
                                                            src="http://wpdemos.themezaa.com/h-code/wp-content/plugins/revslider/admin/assets/images/dummy.png"
                                                            alt="" title="intro-restaurant-09-01.jpg" width="2100"
                                                            height="1201"
                                                            data-lazyload="<?php echo $fileNew; ?>"
                                                            data-bgposition="center center" data-bgfit="cover"
                                                            data-bgrepeat="no-repeat" class="rev-slidebg"
                                                            data-no-retina>
                                                        <div class="tp-caption   tp-resizeme" id="slide-99-layer-1"
                                                             data-x="right" data-hoffset="30" data-y="center"
                                                             data-voffset="250"
                                                             data-width="['none','none','none','none']"
                                                             data-height="['none','none','none','none']"
                                                             data-type="image" data-responsive_offset="on"
                                                             data-frames='[{"from":"y:50px;opacity:0;","speed":1000,"to":"o:1;","delay":1500,"ease":"Power4.easeOut"},{"delay":1900,"speed":600,"to":"y:50px;opacity:0;","ease":"Power4.easeIn"}]'
                                                             data-textAlign="['left','left','left','left']"
                                                             data-paddingtop="[0,0,0,0]" data-paddingright="[0,0,0,0]"
                                                             data-paddingbottom="[0,0,0,0]" data-paddingleft="[0,0,0,0]"
                                                             style="z-index: 121;text-transform:left;z-index:4;">
                                                            <?php
                                                            $filename = getRandomElement($arProjectImages);
                                                            $new_filen = $_SERVER["DOCUMENT_ROOT"].'/wp-content/uploads/' . basename($filename);


                                                            $fileNew = "/wp-content/uploads/" . basename($filename);

                                                            $fileNew = cropImage($filename,
                                                                $_SERVER['DOCUMENT_ROOT'] . $fileNew,
                                                                1270, 792);
                                                            ?>
                                                            <img
                                                                src="http://wpdemos.themezaa.com/h-code/wp-content/plugins/revslider/admin/assets/images/dummy.png"
                                                                alt="" data-ww="1270px" data-hh="792px" width="1270"
                                                                height="792"
                                                                data-lazyload="<?php echo $fileNew; ?>"
                                                                data-no-retina></div>
                                                        <div class="tp-caption   tp-resizeme" id="slide-99-layer-2"
                                                             data-x="center" data-hoffset="-16" data-y="center"
                                                             data-voffset="-155"
                                                             data-width="['none','none','none','none']"
                                                             data-height="['none','none','none','none']"
                                                             data-type="image" data-responsive_offset="on"
                                                             data-frames='[{"from":"y:50px;opacity:0;","speed":1000,"to":"o:1;","delay":2000,"ease":"Power4.easeOut"},{"delay":1400,"speed":600,"to":"y:50px;opacity:0;","ease":"Power4.easeIn"}]'
                                                             data-textAlign="['left','left','left','left']"
                                                             data-paddingtop="[0,0,0,0]" data-paddingright="[0,0,0,0]"
                                                             data-paddingbottom="[0,0,0,0]" data-paddingleft="[0,0,0,0]"
                                                             style="z-index: 122;text-transform:left;z-index:3;">
                                                            <?php
                                                            $filename = getRandomElement($arProjectImages);
                                                            $new_filen = $_SERVER["DOCUMENT_ROOT"].'/wp-content/uploads/' . basename($filename);


                                                            $fileNew = "/wp-content/uploads/" . basename($filename);

                                                            $fileNew = cropImage($filename,
                                                                $_SERVER['DOCUMENT_ROOT'] . $fileNew,
                                                                386, 247);
                                                            ?>
                                                            <img
                                                                src="http://wpdemos.themezaa.com/h-code/wp-content/plugins/revslider/admin/assets/images/dummy.png"
                                                                alt="" data-ww="386px" data-hh="247px" width="386"
                                                                height="247"
                                                                data-lazyload="<?php echo $fileNew; ?>"
                                                                data-no-retina></div>
                                                        <div class="tp-caption   tp-resizeme" id="slide-99-layer-3"
                                                             data-x="center" data-hoffset="-12" data-y="center"
                                                             data-voffset="-155"
                                                             data-width="['none','none','none','none']"
                                                             data-height="['none','none','none','none']"
                                                             data-type="image" data-responsive_offset="on"
                                                             data-frames='[{"from":"y:50px;opacity:0;","speed":1000,"to":"o:1;","delay":2500,"ease":"Power4.easeOut"},{"delay":900,"speed":600,"to":"y:50px;opacity:0;","ease":"Power4.easeIn"}]'
                                                             data-textAlign="['left','left','left','left']"
                                                             data-paddingtop="[0,0,0,0]" data-paddingright="[0,0,0,0]"
                                                             data-paddingbottom="[0,0,0,0]" data-paddingleft="[0,0,0,0]"
                                                             style="z-index: 123;text-transform:left;z-index:3;">
                                                            <?php
                                                            $filename = getRandomElement($arProjectImages);
                                                            $new_filen = $_SERVER["DOCUMENT_ROOT"].'/wp-content/uploads/' . basename($filename);


                                                            $fileNew = "/wp-content/uploads/" . basename($filename);

                                                            $fileNew = cropImage($filename,
                                                                $_SERVER['DOCUMENT_ROOT'] . $fileNew,
                                                                195, 124);
                                                            ?>
                                                            <img
                                                                src="http://wpdemos.themezaa.com/h-code/wp-content/plugins/revslider/admin/assets/images/dummy.png"
                                                                alt="" data-ww="195px" data-hh="124px" width="195"
                                                                height="124"
                                                                data-lazyload="<?php echo $fileNew; ?>"
                                                                data-no-retina></div>
                                                    </li>
                                                </ul>
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
                                                        e.c = jQuery('#rev_slider_16_1');
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
                                                var revapi16;
                                                tpj(document).ready(function () {
                                                    if (tpj("#rev_slider_16_1").revolution == undefined) {
                                                        revslider_showDoubleJqueryError("#rev_slider_16_1");
                                                    } else {
                                                        revapi16 = tpj("#rev_slider_16_1").show().revolution({
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
                                                                simplifyAll: "on",
                                                                nextSlideOnWindowFocus: "off",
                                                                disableFocusListener: true,
                                                            }
                                                        });
                                                    }
                                                });
                                                /*]]>*/</script>
                                            <script>/*<![CDATA[*/
                                                var htmlDivCss = ' #rev_slider_16_1_wrapper .tp-loader.spinner3 div { background-color: #d1b245 !important; } ';
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