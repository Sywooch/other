<?php
/**
 * Created by PhpStorm.
 * User: GSU
 * Date: 23.07.2017
 * Time: 23:56
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
<body class="page-template-default page page-id-36 wpb-js-composer js-comp-ver-5.1 vc_responsive">
<section class="parent-section no-padding post-36 page type-page status-publish hentry">
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
                                            href="http://fonts.googleapis.com/css?family=Playfair+Display+SC:400%2C700|Great+Vibes:400|Open+Sans+Condensed:300|Playfair+Display:400|Open+Sans:400%2C300"
                                            rel="stylesheet" property="stylesheet" type="text/css" media="all">
                                        <div id="rev_slider_14_1_wrapper"
                                             class="rev_slider_wrapper fullscreen-container" data-source="gallery"
                                             style="background:transparent;padding:0px;">
                                            <div id="rev_slider_14_1" class="rev_slider fullscreenbanner"
                                                 style="display:none;" data-version="5.4.1">
                                                <ul>
                                                    <?php
                                                    $randomImage = $arProjectImages[rand(0, count($arProjectImages) - 1)];
                                                    /*$imageSizes = getimagesize ( $randomImage );

                                                    $imgHeight = $imageSizes[1];
                                                    $imgWidth = $imageSizes[0];
                                                    $hh = round((1920 * $imgHeight) / $imgWidth);*/

                                                    $filename = $randomImage;
                                                    $new_filen = $_SERVER["DOCUMENT_ROOT"].'/wp-content/uploads/' . basename($filename);


                                                    $fileNew = "/wp-content/uploads/" . basename($filename);

                                                    cropImage($randomImage,
                                                        $_SERVER['DOCUMENT_ROOT'] . $fileNew,
                                                        180, 110);
                                                    ?>

                                                    <li data-index="rs-74" data-transition="fade" data-slotamount="1"
                                                        data-hideafterloop="0" data-hideslideonmobile="off"
                                                        data-easein="default" data-easeout="default"
                                                        data-masterspeed="500"
                                                        data-thumb="<?php echo $fileNew; ?>"
                                                        data-delay="11000" data-rotate="0" data-saveperformance="off"
                                                        class="no-transition" data-title="Страница 1" data-param1=""
                                                        data-param2="" data-param3="" data-param4="" data-param5=""
                                                        data-param6="" data-param7="" data-param8="" data-param9=""
                                                        data-param10="" data-description=""><img
                                                            src="http://wpdemos.themezaa.com/h-code/wp-content/plugins/revslider/admin/assets/images/dummy.png"
                                                            alt="" title="dummy.png" width="10" height="10"
                                                            data-lazyload="http://wpdemos.themezaa.com/h-code/wp-content/uploads/revslider/fashion_intro/dummy.png"
                                                            data-bgposition="center center" data-bgfit="cover"
                                                            data-bgrepeat="no-repeat" class="rev-slidebg"
                                                            data-no-retina>
                                                        <div class="tp-caption   tp-resizeme  tp-caption fade"
                                                             id="slide-74-layer-3" data-x="300" data-y="center"
                                                             data-voffset="" data-width="['none','none','none','none']"
                                                             data-height="['none','none','none','none']"
                                                             data-type="image" data-responsive_offset="on"
                                                             data-frames='[{"from":"opacity:0;","speed":1000,"to":"o:1;","delay":1300,"ease":"Power4.easeOut"},{"delay":7700,"speed":1000,"to":"opacity:0;","ease":"Power4.easeIn"}]'
                                                             data-textAlign="['left','left','left','left']"
                                                             data-paddingtop="[0,0,0,0]" data-paddingright="[0,0,0,0]"
                                                             data-paddingbottom="[0,0,0,0]" data-paddingleft="[0,0,0,0]"
                                                             style="z-index: 5;text-transform:left;z-index:1;">
                                                            <?php
                                                            $randomImage = $arProjectAllImages[rand(0, count($arProjectAllImages) - 1)];
                                                            $imageSizes = getimagesize ( $randomImage );

                                                            $imgHeight = $imageSizes[1];
                                                            $imgWidth = $imageSizes[0];
                                                            $hh = round((1017 * $imgHeight) / $imgWidth);
                                                            ?>
                                                            <img
                                                                src="http://wpdemos.themezaa.com/h-code/wp-content/plugins/revslider/admin/assets/images/dummy.png"
                                                                alt="" data-ww="1017px" data-hh="<?php echo $hh;?>px" width="1017"
                                                                height="<?php echo $hh;?>"
                                                                data-lazyload="<?php echo $randomImage;?>"
                                                                data-no-retina></div>
                                                        <div class="tp-caption   tp-resizeme" id="slide-74-layer-4"
                                                             data-x="-50" data-y="center" data-voffset=""
                                                             data-width="['none','none','none','none']"
                                                             data-height="['none','none','none','none']"
                                                             data-type="image" data-responsive_offset="on"
                                                             data-frames='[{"from":"x:left;","speed":1000,"to":"o:1;","delay":1800,"ease":"Power4.easeOut"},{"delay":7200,"speed":1000,"to":"x:-50px;opacity:0;","ease":"Power4.easeIn"}]'
                                                             data-textAlign="['left','left','left','left']"
                                                             data-paddingtop="[0,0,0,0]" data-paddingright="[0,0,0,0]"
                                                             data-paddingbottom="[0,0,0,0]" data-paddingleft="[0,0,0,0]"
                                                             style="z-index: 6;text-transform:left;z-index:2;"><img
                                                                src="http://wpdemos.themezaa.com/h-code/wp-content/plugins/revslider/admin/assets/images/dummy.png"
                                                                alt="" data-ww="320px" data-hh="99px" width="320"
                                                                height="99"
                                                                data-lazyload="http://wpdemos.themezaa.com/h-code/wp-content/uploads/revslider/fashion_intro/intro-fashion-01-img-small-black.jpg"
                                                                data-no-retina></div>
                                                        <div class="tp-caption   tp-resizeme" id="slide-74-layer-5"
                                                             data-x="970" data-y="center" data-voffset=""
                                                             data-width="['none','none','none','none']"
                                                             data-height="['none','none','none','none']"
                                                             data-type="image" data-responsive_offset="on"
                                                             data-frames='[{"from":"x:right;","speed":1000,"to":"o:1;","delay":2000,"ease":"Power4.easeOut"},{"delay":7000,"speed":1000,"to":"x:50px;opacity:0;","ease":"Power4.easeIn"}]'
                                                             data-textAlign="['left','left','left','left']"
                                                             data-paddingtop="[0,0,0,0]" data-paddingright="[0,0,0,0]"
                                                             data-paddingbottom="[0,0,0,0]" data-paddingleft="[0,0,0,0]"
                                                             style="z-index: 7;text-transform:left;z-index:2;"><img
                                                                src="http://wpdemos.themezaa.com/h-code/wp-content/plugins/revslider/admin/assets/images/dummy.png"
                                                                alt="" data-ww="1000px" data-hh="99px" width="1000"
                                                                height="99"
                                                                data-lazyload="http://wpdemos.themezaa.com/h-code/wp-content/uploads/revslider/fashion_intro/intro-fashion-01-img-big-black.jpg"
                                                                data-no-retina></div>
                                                        <div class="tp-caption   tp-resizeme" id="slide-74-layer-6"
                                                             data-x="30" data-y="center" data-voffset=""
                                                             data-width="['none','none','none','none']"
                                                             data-height="['none','none','none','none']"
                                                             data-type="image" data-responsive_offset="on"
                                                             data-frames='[{"from":"x:left;","speed":1000,"to":"o:1;","delay":2400,"ease":"Power4.easeOut"},{"delay":6600,"speed":1000,"to":"x:-50px;opacity:0;","ease":"Power4.easeIn"}]'
                                                             data-textAlign="['left','left','left','left']"
                                                             data-paddingtop="[0,0,0,0]" data-paddingright="[0,0,0,0]"
                                                             data-paddingbottom="[0,0,0,0]" data-paddingleft="[0,0,0,0]"
                                                             style="z-index: 8;text-transform:left;z-index:3;"><img
                                                                src="http://wpdemos.themezaa.com/h-code/wp-content/plugins/revslider/admin/assets/images/dummy.png"
                                                                alt="" data-ww="49px" data-hh="33px" width="49"
                                                                height="33"
                                                                data-lazyload="<?php echo PERSONAL_WP_HCODE_URL; ?>/h-code/wp-content/uploads/revslider/fashion_intro/intro-fashion-01-img-logo.png"
                                                                data-no-retina></div>
                                                        <div class="tp-caption   tp-resizeme" id="slide-74-layer-7"
                                                             data-x="center" data-hoffset="403" data-y="center"
                                                             data-voffset="18"
                                                             data-width="['none','none','none','none']"
                                                             data-height="['none','none','none','none']"
                                                             data-type="image" data-responsive_offset="on"
                                                             data-frames='[{"from":"y:50px;opacity:0;","speed":1000,"to":"o:1;","delay":3000,"ease":"Power4.easeOut"},{"delay":6000,"speed":1000,"to":"y:50px;opacity:0;","ease":"Power4.easeIn"}]'
                                                             data-textAlign="['left','left','left','left']"
                                                             data-paddingtop="[0,0,0,0]" data-paddingright="[0,0,0,0]"
                                                             data-paddingbottom="[0,0,0,0]" data-paddingleft="[0,0,0,0]"
                                                             style="z-index: 9;text-transform:left;z-index:2;text-align:center;">
                                                            <?php
                                                            $randomImage = $arProjectMockups[rand(0, count($arProjectMockups) - 1)];
                                                            $imageSizes = getimagesize ( $randomImage );

                                                            $imgHeight = $imageSizes[1];
                                                            $imgWidth = $imageSizes[0];
                                                            $hh = round((1119 * $imgHeight) / $imgWidth);
                                                            ?>
                                                            <img

                                                                src="http://wpdemos.themezaa.com/h-code/wp-content/plugins/revslider/admin/assets/images/dummy.png"
                                                                alt="" data-ww="1119px" data-hh="<?php echo $hh;?>px"
                                                                width="1119"
                                                                height="<?php echo $hh;?>"
                                                                data-lazyload="<?php echo $randomImage;?>"
                                                                data-no-retina></div>
                                                        <div class="tp-caption Fashion-BigDisplay   tp-resizeme"
                                                             id="slide-74-layer-8" data-x="290" data-y="center"
                                                             data-voffset="-20" data-width="['auto']"
                                                             data-height="['auto']" data-type="text"
                                                             data-responsive_offset="on"
                                                             data-frames='[{"from":"y:50px;opacity:0;","speed":1000,"to":"o:1;","delay":3500,"ease":"Power4.easeOut"},{"delay":1500,"speed":1000,"to":"y:-50px;opacity:0;","ease":"Power4.easeIn"}]'
                                                             data-textAlign="['left','left','left','left']"
                                                             data-paddingtop="[0,0,0,0]" data-paddingright="[0,0,0,0]"
                                                             data-paddingbottom="[0,0,0,0]" data-paddingleft="[0,0,0,0]"
                                                             style="z-index: 10; white-space: nowrap; font-size: 40px; font-weight: 400;font-family:Playfair Display SC;text-transform:uppercase;z-index:2;text-align:center;position:absolute;margin:0px;white-space:nowrap;letter-spacing:2px;">
                                                            <?php echo $arProject["post_title"]; ?>
                                                        </div>
                                                        <div class="tp-caption Fashion-BigDisplay   tp-resizeme"
                                                             id="slide-74-layer-9" data-x="290" data-y="center"
                                                             data-voffset="20" data-width="['auto']"
                                                             data-height="['auto']" data-type="text"
                                                             data-responsive_offset="on"
                                                             data-frames='[{"from":"y:50px;opacity:0;","speed":1000,"to":"o:1;","delay":3500,"ease":"Power4.easeOut"},{"delay":1500,"speed":1000,"to":"y:-50px;opacity:0;","ease":"Power4.easeIn"}]'
                                                             data-textAlign="['left','left','left','left']"
                                                             data-paddingtop="[0,0,0,0]" data-paddingright="[0,0,0,0]"
                                                             data-paddingbottom="[0,0,0,0]" data-paddingleft="[0,0,0,0]"
                                                             style="z-index: 11; white-space: nowrap; font-size: 20px; font-weight: 400;font-family:Playfair Display SC;text-transform:uppercase;z-index:2;text-align:center;position:absolute;margin:0px;white-space:nowrap;letter-spacing:2px;">
                                                            <?php echo $arPostTagsNames[rand(0, count($arPostTagsNames) - 1)]; ?>
                                                        </div>
                                                        <div class="tp-caption Fashion-BigDisplay   tp-resizeme"
                                                             id="slide-74-layer-10" data-x="290" data-y="center"
                                                             data-voffset="-20" data-width="['auto']"
                                                             data-height="['auto']" data-type="text"
                                                             data-responsive_offset="on"
                                                             data-frames='[{"from":"y:50px;opacity:0;","speed":1000,"to":"o:1;","delay":7500,"ease":"Power4.easeOut"},{"delay":1500,"speed":1000,"to":"y:-50px;opacity:0;","ease":"Power4.easeIn"}]'
                                                             data-textAlign="['left','left','left','left']"
                                                             data-paddingtop="[0,0,0,0]" data-paddingright="[0,0,0,0]"
                                                             data-paddingbottom="[0,0,0,0]" data-paddingleft="[0,0,0,0]"
                                                             style="z-index: 12; white-space: nowrap; font-size: 40px; font-weight: 400;font-family:Playfair Display SC;text-transform:uppercase;z-index:2;text-align:center;position:absolute;margin:0px;white-space:nowrap;letter-spacing:2px;">
                                                            <?php echo $arPostTagsNames[rand(0, count($arPostTagsNames) - 1)]; ?>
                                                        </div>
                                                        <div class="tp-caption Fashion-BigDisplay   tp-resizeme"
                                                             id="slide-74-layer-11" data-x="290" data-y="center"
                                                             data-voffset="20" data-width="['auto']"
                                                             data-height="['auto']" data-type="text"
                                                             data-responsive_offset="on"
                                                             data-frames='[{"from":"y:50px;opacity:0;","speed":1000,"to":"o:1;","delay":7500,"ease":"Power4.easeOut"},{"delay":1500,"speed":1000,"to":"y:-50px;opacity:0;","ease":"Power4.easeIn"}]'
                                                             data-textAlign="['left','left','left','left']"
                                                             data-paddingtop="[0,0,0,0]" data-paddingright="[0,0,0,0]"
                                                             data-paddingbottom="[0,0,0,0]" data-paddingleft="[0,0,0,0]"
                                                             style="z-index: 13; white-space: nowrap; font-size: 20px; font-weight: 400;font-family:Playfair Display SC;text-transform:uppercase;z-index:2;text-align:center;position:absolute;margin:0px;white-space:nowrap;letter-spacing:2px;">
                                                            <?php echo $arPostTagsNames[rand(0, count($arPostTagsNames) - 1)]; ?>
                                                        </div>
                                                    </li>
                                                    <?php
                                                    $randomImage = $arProjectImages[rand(0, count($arProjectImages) - 1)];
                                                    /*$imageSizes = getimagesize ( $randomImage );

                                                    $imgHeight = $imageSizes[1];
                                                    $imgWidth = $imageSizes[0];
                                                    $hh = round((1920 * $imgHeight) / $imgWidth);*/

                                                    $filename = $randomImage;
                                                    $new_filen = $_SERVER["DOCUMENT_ROOT"].'/wp-content/uploads/' . basename($filename);


                                                    $fileNew = "/wp-content/uploads/" . basename($filename);

                                                    cropImage($randomImage,
                                                        $_SERVER['DOCUMENT_ROOT'] . $fileNew,
                                                        180, 110);
                                                    ?>

                                                    <li data-index="rs-75" data-transition="fade" data-slotamount="1"
                                                        data-hideafterloop="0" data-hideslideonmobile="off"
                                                        data-easein="default" data-easeout="default"
                                                        data-masterspeed="500"
                                                        data-thumb="<?php echo $fileNew; ?>"
                                                        data-delay="10000" data-rotate="0" data-saveperformance="off"
                                                        class="no-transition" data-title="Страница 2" data-param1=""
                                                        data-param2="" data-param3="" data-param4="" data-param5=""
                                                        data-param6="" data-param7="" data-param8="" data-param9=""
                                                        data-param10="" data-description=""><img
                                                            src="http://wpdemos.themezaa.com/h-code/wp-content/plugins/revslider/admin/assets/images/dummy.png"
                                                            alt="" title="dummy.png" width="10" height="10"
                                                            data-lazyload="http://wpdemos.themezaa.com/h-code/wp-content/uploads/revslider/fashion_intro/dummy.png"
                                                            data-bgposition="center center" data-bgfit="cover"
                                                            data-bgrepeat="no-repeat" class="rev-slidebg"
                                                            data-no-retina>
                                                        <div class="tp-caption   tp-resizeme" id="slide-75-layer-10"
                                                             data-x="center" data-hoffset="" data-y="center"
                                                             data-voffset="" data-width="['none','none','none','none']"
                                                             data-height="['none','none','none','none']"
                                                             data-type="image" data-responsive_offset="on"
                                                             data-frames='[{"from":"opacity:0;","speed":1,"to":"o:1;","delay":1.00006103516,"ease":"Power2.easeInOut"},{"delay":"wait","speed":1,"to":"opacity:0;","ease":"nothing"}]'
                                                             data-textAlign="['left','left','left','left']"
                                                             data-paddingtop="[0,0,0,0]" data-paddingright="[0,0,0,0]"
                                                             data-paddingbottom="[0,0,0,0]" data-paddingleft="[0,0,0,0]"
                                                             style="z-index: 14;text-transform:left;"><img
                                                                src="http://wpdemos.themezaa.com/h-code/wp-content/plugins/revslider/admin/assets/images/dummy.png"
                                                                alt="" data-ww="5760px" data-hh="3240px" width="5760"
                                                                height="3240"
                                                                data-lazyload="http://wpdemos.themezaa.com/h-code/wp-content/uploads/revslider/fashion_intro/white-up.png"
                                                                data-no-retina></div>
                                                        <div class="tp-caption   tp-resizeme" id="slide-75-layer-2"
                                                             data-x="600" data-y="bottom" data-voffset=""
                                                             data-width="['none','none','none','none']"
                                                             data-height="['none','none','none','none']"
                                                             data-type="image" data-responsive_offset="on"
                                                             data-frames='[{"from":"opacity:0;","speed":1000,"to":"o:1;","delay":1300,"ease":"Power4.easeOut"},{"delay":6700,"speed":1000,"to":"opacity:0;","ease":"Power4.easeIn"}]'
                                                             data-textAlign="['left','left','left','left']"
                                                             data-paddingtop="[0,0,0,0]" data-paddingright="[0,0,0,0]"
                                                             data-paddingbottom="[0,0,0,0]" data-paddingleft="[0,0,0,0]"
                                                             style="z-index: 15;text-transform:left;z-index:1;">

                                                            <?php
                                                            $randomImage = $arProjectAllImages[rand(0, count($arProjectAllImages) - 1)];
                                                            $imageSizes = getimagesize ( $randomImage );

                                                            $imgHeight = $imageSizes[1];
                                                            $imgWidth = $imageSizes[0];
                                                            $hh = round((725 * $imgHeight) / $imgWidth);
                                                            ?>

                                                            <img
                                                                src="http://wpdemos.themezaa.com/h-code/wp-content/plugins/revslider/admin/assets/images/dummy.png"
                                                                alt="" data-ww="725px" data-hh="<?php echo $hh;?>px" width="725"
                                                                height="<?php echo $hh;?>"
                                                                data-lazyload="<?php echo $randomImage;?>"
                                                                data-no-retina></div>
                                                        <div class="tp-caption   tp-resizeme" id="slide-75-layer-3"
                                                             data-x="" data-y=""
                                                             data-width="['none','none','none','none']"
                                                             data-height="['none','none','none','none']"
                                                             data-type="image" data-responsive_offset="on"
                                                             data-frames='[{"from":"y:50px;opacity:0;","speed":1000,"to":"o:1;","delay":2000,"ease":"Power4.easeOut"},{"delay":6000,"speed":1000,"to":"y:50px;opacity:0;","ease":"Power4.easeIn"}]'
                                                             data-textAlign="['left','left','left','left']"
                                                             data-paddingtop="[0,0,0,0]" data-paddingright="[0,0,0,0]"
                                                             data-paddingbottom="[0,0,0,0]" data-paddingleft="[0,0,0,0]"
                                                             style="z-index: 16;text-transform:left;z-index:2;text-align:center;">
                                                            <?php
                                                            $randomImage = $arProjectAllImages[rand(0, count($arProjectAllImages) - 1)];
                                                            $imageSizes = getimagesize ( $randomImage );

                                                            $imgHeight = $imageSizes[1];
                                                            $imgWidth = $imageSizes[0];
                                                            $hh = round((1012 * $imgHeight) / $imgWidth);
                                                            ?>
                                                            <img
                                                                src="http://wpdemos.themezaa.com/h-code/wp-content/plugins/revslider/admin/assets/images/dummy.png"
                                                                alt="" data-ww="1012px" data-hh="<?php echo $hh;?>px" width="1012"
                                                                height="<?php echo $hh;?>"
                                                                data-lazyload="<?php echo $randomImage;?>"
                                                                data-no-retina></div>
                                                        <div class="tp-caption Fashion-BigDisplay   tp-resizeme"
                                                             id="slide-75-layer-4" data-x="1300" data-y="center"
                                                             data-voffset="-140" data-width="['auto']"
                                                             data-height="['auto']" data-type="text"
                                                             data-responsive_offset="on"
                                                             data-frames='[{"from":"x:50px;opacity:0;","speed":1000,"to":"o:1;","delay":2500,"ease":"Power4.easeOut"},{"delay":500,"speed":1000,"to":"x:-50px;opacity:0;","ease":"Power4.easeIn"}]'
                                                             data-textAlign="['left','left','left','left']"
                                                             data-paddingtop="[0,0,0,0]" data-paddingright="[0,0,0,0]"
                                                             data-paddingbottom="[0,0,0,0]" data-paddingleft="[0,0,0,0]"
                                                             style="z-index: 17; white-space: nowrap; font-size: 100px; line-height: 90px; font-weight: 400;font-family:Playfair Display SC;text-transform:uppercase;z-index:2;position:absolute;margin:0px;white-space:nowrap;letter-spacing:2px;">
                                                            <?php echo $arPostTagsNames[rand(0, count($arPostTagsNames) - 1)]; ?>
                                                        </div>
                                                        <div class="tp-caption Fashion-BigDisplay   tp-resizeme"
                                                             id="slide-75-layer-5" data-x="1300" data-y="center"
                                                             data-voffset="-140" data-width="['auto']"
                                                             data-height="['auto']" data-type="text"
                                                             data-responsive_offset="on"
                                                             data-frames='[{"from":"x:50px;opacity:0;","speed":1000,"to":"o:1;","delay":5500,"ease":"Power4.easeOut"},{"delay":-500,"speed":1000,"to":"x:-50px;opacity:0;","ease":"Power4.easeIn"}]'
                                                             data-textAlign="['left','left','left','left']"
                                                             data-paddingtop="[0,0,0,0]" data-paddingright="[0,0,0,0]"
                                                             data-paddingbottom="[0,0,0,0]" data-paddingleft="[0,0,0,0]"
                                                             style="z-index: 18; white-space: nowrap; font-size: 100px; line-height: 90px; font-weight: 400;font-family:Playfair Display SC;text-transform:uppercase;z-index:2;position:absolute;margin:0px;white-space:nowrap;letter-spacing:2px;">
                                                            <?php echo $arPostTagsNames[rand(0, count($arPostTagsNames) - 1)]; ?>
                                                        </div>
                                                        <div class="tp-caption Fashion-BigDisplay   tp-resizeme"
                                                             id="slide-75-layer-6" data-x="1300" data-y="center"
                                                             data-voffset="-140" data-width="['auto']"
                                                             data-height="['auto']" data-type="text"
                                                             data-responsive_offset="on"
                                                             data-frames='[{"from":"x:50px;opacity:0;","speed":1000,"to":"o:1;","delay":7500,"ease":"Power4.easeOut"},{"delay":500,"speed":1000,"to":"x:-50px;opacity:0;","ease":"Power4.easeIn"}]'
                                                             data-textAlign="['left','left','left','left']"
                                                             data-paddingtop="[0,0,0,0]" data-paddingright="[0,0,0,0]"
                                                             data-paddingbottom="[0,0,0,0]" data-paddingleft="[0,0,0,0]"
                                                             style="z-index: 19; white-space: nowrap; font-size: 100px; line-height: 90px; font-weight: 400;font-family:Playfair Display SC;text-transform:uppercase;z-index:2;position:absolute;margin:0px;white-space:nowrap;letter-spacing:2px;">
                                                            <?php echo $arPostTagsNames[rand(0, count($arPostTagsNames) - 1)]; ?>
                                                        </div>
                                                        <div class="tp-caption Fashion-BigDisplay   tp-resizeme"
                                                             id="slide-75-layer-7" data-x="1300" data-y="center"
                                                             data-voffset="-60" data-width="['auto']"
                                                             data-height="['auto']" data-type="text"
                                                             data-responsive_offset="on"
                                                             data-frames='[{"from":"y:50px;opacity:0;","speed":1000,"to":"o:1;","delay":3500,"ease":"Power4.easeOut"},{"delay":4500,"speed":1000,"to":"y:-50px;opacity:0;","ease":"Power4.easeIn"}]'
                                                             data-textAlign="['left','left','left','left']"
                                                             data-paddingtop="[0,0,0,0]" data-paddingright="[0,0,0,0]"
                                                             data-paddingbottom="[0,0,0,0]" data-paddingleft="[0,0,0,0]"
                                                             style="z-index: 20; white-space: nowrap; font-size: 70px; font-weight: 400;font-family:Great Vibes;text-transform:left;z-index:2;padding-left:10px;padding-right:10px;position:absolute;margin:0px;white-space:nowrap;letter-spacing:2px;">
                                                            <?php echo $arPostTagsNames[rand(0, count($arPostTagsNames) - 1)]; ?>
                                                        </div>
                                                        <div class="tp-caption Fashion-BigDisplay   tp-resizeme"
                                                             id="slide-75-layer-8" data-x="1300" data-y="center"
                                                             data-voffset="120" data-width="['auto']"
                                                             data-height="['auto']" data-type="text"
                                                             data-responsive_offset="on"
                                                             data-frames='[{"from":"y:50px;opacity:0;","speed":1000,"to":"o:1;","delay":3000,"ease":"Power4.easeOut"},{"delay":5000,"speed":1000,"to":"y:-50px;opacity:0;","ease":"Power4.easeIn"}]'
                                                             data-textAlign="['left','left','left','left']"
                                                             data-paddingtop="[0,0,0,0]" data-paddingright="[0,0,0,0]"
                                                             data-paddingbottom="[0,0,0,0]" data-paddingleft="[0,0,0,0]"
                                                             style="z-index: 21; white-space: nowrap; font-size: 40px; font-weight: 400;font-family:Playfair Display SC;text-transform:uppercase;z-index:2;position:absolute;margin:0px;white-space:nowrap;letter-spacing:2px;">
                                                            <?php echo $arPostTagsNames[rand(0, count($arPostTagsNames) - 1)]; ?>
                                                        </div>
                                                        <div class="tp-caption Fashion-BigDisplay   tp-resizeme"
                                                             id="slide-75-layer-9" data-x="1300" data-y="center"
                                                             data-voffset="190" data-width="['auto']"
                                                             data-height="['auto']" data-type="text"
                                                             data-responsive_offset="on"
                                                             data-frames='[{"from":"y:50px;opacity:0;","speed":1000,"to":"o:1;","delay":3200,"ease":"Power4.easeOut"},{"delay":4800,"speed":1000,"to":"y:-50px;opacity:0;","ease":"Power4.easeIn"}]'
                                                             data-textAlign="['left','left','left','left']"
                                                             data-paddingtop="[0,0,0,0]" data-paddingright="[0,0,0,0]"
                                                             data-paddingbottom="[0,0,0,0]" data-paddingleft="[0,0,0,0]"
                                                             style="z-index: 22; white-space: nowrap; font-size: 20px; line-height: 30px; font-weight: 300;font-family:Open Sans Condensed;text-transform:uppercase;text-decoration:none;z-index:2;letter-spacing:normal;">
                                                            <?php  $arPostTagsNames3Elements =array_slice($arPostTagsNames,0,3);
                                                            echo implode(" & ", $arPostTagsNames3Elements ); ?>
                                                        </div>
                                                    </li>
                                                    <?php
                                                    $randomImage = $arProjectImages[rand(0, count($arProjectImages) - 1)];
                                                    /*$imageSizes = getimagesize ( $randomImage );

                                                    $imgHeight = $imageSizes[1];
                                                    $imgWidth = $imageSizes[0];
                                                    $hh = round((1920 * $imgHeight) / $imgWidth);*/

                                                    $filename = $randomImage;
                                                    $new_filen = $_SERVER["DOCUMENT_ROOT"].'/wp-content/uploads/' . basename($filename);


                                                    $fileNew = "/wp-content/uploads/" . basename($filename);

                                                    cropImage($randomImage,
                                                        $_SERVER['DOCUMENT_ROOT'] . $fileNew,
                                                        180, 110);
                                                    ?>
                                                    <li data-index="rs-76" data-transition="fade" data-slotamount="1"
                                                        data-hideafterloop="0" data-hideslideonmobile="off"
                                                        data-easein="default" data-easeout="default"
                                                        data-masterspeed="500"
                                                        data-thumb="<?php echo $fileNew; ?>"
                                                        data-delay="11000" data-rotate="0" data-saveperformance="off"
                                                        class="no-transition" data-title="Страница 3" data-param1=""
                                                        data-param2="" data-param3="" data-param4="" data-param5=""
                                                        data-param6="" data-param7="" data-param8="" data-param9=""
                                                        data-param10="" data-description=""><img
                                                            src="http://wpdemos.themezaa.com/h-code/wp-content/plugins/revslider/admin/assets/images/dummy.png"
                                                            alt="" title="dummy.png" width="10" height="10"
                                                            data-lazyload="http://wpdemos.themezaa.com/h-code/wp-content/uploads/revslider/fashion_intro/dummy.png"
                                                            data-bgposition="center center" data-bgfit="cover"
                                                            data-bgrepeat="no-repeat" class="rev-slidebg"
                                                            data-no-retina>
                                                        <div class="tp-caption   tp-resizeme" id="slide-76-layer-1"
                                                             data-x="center" data-hoffset="" data-y="center"
                                                             data-voffset="" data-width="['none','none','none','none']"
                                                             data-height="['none','none','none','none']"
                                                             data-type="image" data-responsive_offset="on"
                                                             data-frames='[{"from":"y:50px;opacity:0;","speed":1,"to":"o:1;","delay":1,"ease":"Power4.easeOut"},{"delay":"wait","speed":1,"to":"y:50px;opacity:0;","ease":"Power4.easeIn"}]'
                                                             data-textAlign="['left','left','left','left']"
                                                             data-paddingtop="[0,0,0,0]" data-paddingright="[0,0,0,0]"
                                                             data-paddingbottom="[0,0,0,0]" data-paddingleft="[0,0,0,0]"
                                                             style="z-index: 23;text-transform:left;z-index:100;"><img
                                                                src="http://wpdemos.themezaa.com/h-code/wp-content/plugins/revslider/admin/assets/images/dummy.png"
                                                                alt="" data-ww="5760px" data-hh="3240px" width="5760"
                                                                height="3240"
                                                                data-lazyload="http://wpdemos.themezaa.com/h-code/wp-content/uploads/revslider/fashion_intro/white-up.png"
                                                                data-no-retina></div>
                                                        <div class="tp-caption   tp-resizeme" id="slide-76-layer-2"
                                                             data-x="200" data-y="bottom" data-voffset=""
                                                             data-width="['none','none','none','none']"
                                                             data-height="['none','none','none','none']"
                                                             data-type="image" data-responsive_offset="on"
                                                             data-frames='[{"from":"opacity:0;","speed":1000,"to":"o:1;","delay":1300,"ease":"Power4.easeOut"},{"delay":7700,"speed":1000,"to":"opacity:0;","ease":"Power4.easeIn"}]'
                                                             data-textAlign="['left','left','left','left']"
                                                             data-paddingtop="[0,0,0,0]" data-paddingright="[0,0,0,0]"
                                                             data-paddingbottom="[0,0,0,0]" data-paddingleft="[0,0,0,0]"
                                                             style="z-index: 24;text-transform:left;z-index:1;">
                                                            <?php
                                                            $randomImage = $arProjectAllImages[rand(0, count($arProjectAllImages) - 1)];
                                                            $imageSizes = getimagesize ( $randomImage );

                                                            $imgHeight = $imageSizes[1];
                                                            $imgWidth = $imageSizes[0];
                                                            $hh = round((1114 * $imgHeight) / $imgWidth);
                                                            ?>

                                                            <img
                                                                src="http://wpdemos.themezaa.com/h-code/wp-content/plugins/revslider/admin/assets/images/dummy.png"
                                                                alt="" data-ww="1114px" data-hh="<?php echo $hh;?>px" width="1114"
                                                                height="<?php echo $hh;?>"
                                                                data-lazyload="<?php echo $randomImage;?>"
                                                                data-no-retina></div>
                                                        <div class="tp-caption   tp-resizeme" id="slide-76-layer-3"
                                                             data-x="900" data-y=""
                                                             data-width="['none','none','none','none']"
                                                             data-height="['none','none','none','none']"
                                                             data-type="image" data-responsive_offset="on"
                                                             data-frames='[{"from":"y:50px;opacity:0;","speed":1000,"to":"o:1;","delay":2000,"ease":"Power4.easeOut"},{"delay":7000,"speed":1000,"to":"y:50px;opacity:0;","ease":"Power4.easeIn"}]'
                                                             data-textAlign="['left','left','left','left']"
                                                             data-paddingtop="[0,0,0,0]" data-paddingright="[0,0,0,0]"
                                                             data-paddingbottom="[0,0,0,0]" data-paddingleft="[0,0,0,0]"
                                                             style="z-index: 25;text-transform:left;z-index:2;text-align:center;">
                                                            <?php
                                                            $randomImage = $arProjectAllImages[rand(0, count($arProjectAllImages) - 1)];
                                                            $imageSizes = getimagesize ( $randomImage );

                                                            $imgHeight = $imageSizes[1];
                                                            $imgWidth = $imageSizes[0];
                                                            $hh = round((764 * $imgHeight) / $imgWidth);
                                                            ?>
                                                            <img
                                                                src="http://wpdemos.themezaa.com/h-code/wp-content/plugins/revslider/admin/assets/images/dummy.png"
                                                                alt="" data-ww="764px" data-hh="<?php echo $hh;?>px" width="764"
                                                                height="<?php echo $hh;?>"
                                                                data-lazyload="<?php echo $randomImage;?>"
                                                                data-no-retina></div>
                                                        <div class="tp-caption Fashion-BigDisplay   tp-resizeme"
                                                             id="slide-76-layer-4" data-x="300" data-y="center"
                                                             data-voffset="-230" data-width="['auto']"
                                                             data-height="['auto']" data-type="text"
                                                             data-responsive_offset="on"
                                                             data-frames='[{"from":"x:50px;opacity:0;","speed":1000,"to":"o:1;","delay":2500,"ease":"Power4.easeOut"},{"delay":2500,"speed":1000,"to":"x:-50px;opacity:0;","ease":"Power4.easeIn"}]'
                                                             data-textAlign="['left','left','left','left']"
                                                             data-paddingtop="[0,0,0,0]" data-paddingright="[0,0,0,0]"
                                                             data-paddingbottom="[0,0,0,0]" data-paddingleft="[0,0,0,0]"
                                                             style="z-index: 26; white-space: nowrap; font-size: 100px; line-height: 90px; font-weight: 400;font-family:Playfair Display;text-transform:uppercase;z-index:2;text-align:right;position:absolute;margin:0px;white-space:nowrap;letter-spacing:2px;">
                                                            <?php echo $arPostTagsNames[rand(0, count($arPostTagsNames) - 1)]; ?>
                                                        </div>
                                                        <div class="tp-caption Fashion-BigDisplay   tp-resizeme"
                                                             id="slide-76-layer-5" data-x="500" data-y="center"
                                                             data-voffset="-230" data-width="['auto']"
                                                             data-height="['auto']" data-type="text"
                                                             data-responsive_offset="on"
                                                             data-frames='[{"from":"x:50px;opacity:0;","speed":1000,"to":"o:1;","delay":7500,"ease":"Power2.easeInOut"},{"delay":1500,"speed":1000,"to":"x:-50px;opacity:0;","ease":"Power4.easeIn"}]'
                                                             data-textAlign="['left','left','left','left']"
                                                             data-paddingtop="[0,0,0,0]" data-paddingright="[0,0,0,0]"
                                                             data-paddingbottom="[0,0,0,0]" data-paddingleft="[0,0,0,0]"
                                                             style="z-index: 27; white-space: nowrap; font-size: 100px; line-height: 90px; font-weight: 400;font-family:Playfair Display SC;text-transform:uppercase;z-index:2;text-align:right;position:absolute;margin:0px;white-space:nowrap;letter-spacing:2px;">
                                                            <?php echo $arPostTagsNames[rand(0, count($arPostTagsNames) - 1)]; ?>
                                                        </div>
                                                        <div class="tp-caption Fashion-BigDisplay   tp-resizeme"
                                                             id="slide-76-layer-6" data-x="650" data-y="center"
                                                             data-voffset="-130" data-width="['auto']"
                                                             data-height="['auto']" data-type="text"
                                                             data-responsive_offset="on"
                                                             data-frames='[{"from":"y:50px;opacity:0;","speed":1000,"to":"o:1;","delay":3500,"ease":"Power4.easeOut"},{"delay":5500,"speed":1000,"to":"y:-50px;opacity:0;","ease":"Power4.easeIn"}]'
                                                             data-textAlign="['left','left','left','left']"
                                                             data-paddingtop="[0,0,0,0]" data-paddingright="[0,0,0,0]"
                                                             data-paddingbottom="[0,0,0,0]" data-paddingleft="[0,0,0,0]"
                                                             style="z-index: 28; white-space: nowrap; font-size: 120px; font-weight: 400;font-family:Great Vibes;text-transform:left;z-index:2;text-align:right;padding-left:14px;position:absolute;margin:0px;white-space:nowrap;letter-spacing:2px;">
                                                            <?php echo $arPostTagsNames[rand(0, count($arPostTagsNames) - 1)]; ?>
                                                        </div>
                                                        <div class="tp-caption   tp-resizeme" id="slide-76-layer-7"
                                                             data-x="300" data-y="center" data-voffset="150"
                                                             data-width="['none','none','none','none']"
                                                             data-height="['none','none','none','none']"
                                                             data-type="image" data-responsive_offset="on"
                                                             data-frames='[{"from":"y:50px;opacity:0;","speed":1000,"to":"o:1;","delay":4000,"ease":"Power4.easeOut"},{"delay":5000,"speed":1000,"to":"y:-50px;opacity:0;","ease":"Power4.easeIn"}]'
                                                             data-textAlign="['left','left','left','left']"
                                                             data-paddingtop="[0,0,0,0]" data-paddingright="[0,0,0,0]"
                                                             data-paddingbottom="[0,0,0,0]" data-paddingleft="[0,0,0,0]"
                                                             style="z-index: 29;text-transform:left;z-index:2;">
                                                            <?php
                                                            $randomImage = $arProjectAllImages[rand(0, count($arProjectAllImages) - 1)];
                                                            $imageSizes = getimagesize ( $randomImage );

                                                            $imgHeight = $imageSizes[1];
                                                            $imgWidth = $imageSizes[0];
                                                            $hh = round((183 * $imgHeight) / $imgWidth);
                                                            ?>

                                                            <img
                                                                src="http://wpdemos.themezaa.com/h-code/wp-content/plugins/revslider/admin/assets/images/dummy.png"
                                                                alt="" data-ww="183px" data-hh="<?php echo $hh;?>px" width="183"
                                                                height="<?php echo $hh;?>"
                                                                data-lazyload="<?php echo $randomImage;?>"
                                                                data-no-retina></div>
                                                        <div class="tp-caption   tp-resizeme" id="slide-76-layer-8"
                                                             data-x="500" data-y="center" data-voffset="150"
                                                             data-width="['none','none','none','none']"
                                                             data-height="['none','none','none','none']"
                                                             data-type="image" data-responsive_offset="on"
                                                             data-frames='[{"from":"y:50px;opacity:0;","speed":1000,"to":"o:1;","delay":4200,"ease":"Power4.easeOut"},{"delay":4800,"speed":1000,"to":"y:-50px;opacity:0;","ease":"Power4.easeIn"}]'
                                                             data-textAlign="['left','left','left','left']"
                                                             data-paddingtop="[0,0,0,0]" data-paddingright="[0,0,0,0]"
                                                             data-paddingbottom="[0,0,0,0]" data-paddingleft="[0,0,0,0]"
                                                             style="z-index: 30;text-transform:left;z-index:2;">
                                                            <?php
                                                            $randomImage = $arProjectAllImages[rand(0, count($arProjectAllImages) - 1)];
                                                            $imageSizes = getimagesize ( $randomImage );

                                                            $imgHeight = $imageSizes[1];
                                                            $imgWidth = $imageSizes[0];
                                                            $hh = round((183 * $imgHeight) / $imgWidth);
                                                            ?>
                                                            <img
                                                                src="http://wpdemos.themezaa.com/h-code/wp-content/plugins/revslider/admin/assets/images/dummy.png"
                                                                alt="" data-ww="183px" data-hh="<?php echo $hh;?>px" width="183"
                                                                height="<?php echo $hh;?>"
                                                                data-lazyload="<?php echo $randomImage;?>"
                                                                data-no-retina></div>
                                                        <div class="tp-caption   tp-resizeme" id="slide-76-layer-9"
                                                             data-x="700" data-y="center" data-voffset="150"
                                                             data-width="['none','none','none','none']"
                                                             data-height="['none','none','none','none']"
                                                             data-type="image" data-responsive_offset="on"
                                                             data-frames='[{"from":"y:50px;opacity:0;","speed":1000,"to":"o:1;","delay":4400,"ease":"Power4.easeOut"},{"delay":4600,"speed":1000,"to":"y:-50px;opacity:0;","ease":"Power4.easeIn"}]'
                                                             data-textAlign="['left','left','left','left']"
                                                             data-paddingtop="[0,0,0,0]" data-paddingright="[0,0,0,0]"
                                                             data-paddingbottom="[0,0,0,0]" data-paddingleft="[0,0,0,0]"
                                                             style="z-index: 31;text-transform:left;z-index:2;">

                                                            <?php
                                                            $randomImage = $arProjectAllImages[rand(0, count($arProjectAllImages) - 1)];
                                                            $imageSizes = getimagesize ( $randomImage );

                                                            $imgHeight = $imageSizes[1];
                                                            $imgWidth = $imageSizes[0];
                                                            $hh = round((183 * $imgHeight) / $imgWidth);
                                                            ?>
                                                            <img
                                                                src="http://wpdemos.themezaa.com/h-code/wp-content/plugins/revslider/admin/assets/images/dummy.png"
                                                                alt="" data-ww="183px" data-hh="<?php echo $hh;?>px" width="183"
                                                                height="<?php echo $hh;?>"
                                                                data-lazyload="<?php echo $randomImage;?>"
                                                                data-no-retina></div>
                                                    </li>
                                                    <?php
                                                    $randomImage = $arProjectImages[rand(0, count($arProjectImages) - 1)];
                                                    /*$imageSizes = getimagesize ( $randomImage );

                                                    $imgHeight = $imageSizes[1];
                                                    $imgWidth = $imageSizes[0];
                                                    $hh = round((1920 * $imgHeight) / $imgWidth);*/

                                                    $filename = $randomImage;
                                                    $new_filen = $_SERVER["DOCUMENT_ROOT"].'/wp-content/uploads/' . basename($filename);


                                                    $fileNew = "/wp-content/uploads/" . basename($filename);

                                                    cropImage($randomImage,
                                                        $_SERVER['DOCUMENT_ROOT'] . $fileNew,
                                                        180, 110);
                                                    ?>
                                                    <li data-index="rs-77" data-transition="fade" data-slotamount="1"
                                                        data-hideafterloop="0" data-hideslideonmobile="off"
                                                        data-easein="default" data-easeout="default"
                                                        data-masterspeed="500"
                                                        data-thumb="<?php echo $fileNew; ?>"
                                                        data-delay="8000" data-rotate="0" data-saveperformance="off"
                                                        class="no-transition" data-title="Страница 4" data-param1=""
                                                        data-param2="" data-param3="" data-param4="" data-param5=""
                                                        data-param6="" data-param7="" data-param8="" data-param9=""
                                                        data-param10="" data-description="">
                                                        <?php
                                                        $randomImage = $arProjectAllImages[rand(0, count($arProjectAllImages) - 1)];
                                                        $imageSizes = getimagesize ( $randomImage );

                                                        $imgHeight = $imageSizes[1];
                                                        $imgWidth = $imageSizes[0];
                                                        $hh = round((1920 * $imgHeight) / $imgWidth);
                                                        ?>
                                                        <img
                                                            src="http://wpdemos.themezaa.com/h-code/wp-content/plugins/revslider/admin/assets/images/dummy.png"
                                                            alt="" title="intro-fashion-04-img-bg.jpg" width="1920"
                                                            height="<?php echo $hh;?>"
                                                            data-lazyload="<?php echo $randomImage;?>"
                                                            data-bgposition="center center" data-bgfit="cover"
                                                            data-bgrepeat="no-repeat" class="rev-slidebg"
                                                            data-no-retina>
                                                        <div class="tp-caption   tp-resizeme" id="slide-77-layer-7"
                                                             data-x="center" data-hoffset="" data-y="center"
                                                             data-voffset="" data-width="['none','none','none','none']"
                                                             data-height="['none','none','none','none']"
                                                             data-type="image" data-responsive_offset="on"
                                                             data-frames='[{"from":"opacity:0;","speed":1.875,"to":"o:1;","delay":0,"ease":"Power2.easeInOut"},{"delay":"wait","speed":1.875,"to":"opacity:0;","ease":"Power4.easeIn"}]'
                                                             data-textAlign="['left','left','left','left']"
                                                             data-paddingtop="[0,0,0,0]" data-paddingright="[0,0,0,0]"
                                                             data-paddingbottom="[0,0,0,0]" data-paddingleft="[0,0,0,0]"
                                                             style="z-index: 32;text-transform:left;z-index:1;">
                                                            <?php
                                                            $randomImage = $arProjectAllImages[rand(0, count($arProjectAllImages) - 1)];
                                                            $imageSizes = getimagesize ( $randomImage );

                                                            $imgHeight = $imageSizes[1];
                                                            $imgWidth = $imageSizes[0];
                                                            $hh = round((1920 * $imgHeight) / $imgWidth);
                                                            ?>
                                                            <img
                                                                src="http://wpdemos.themezaa.com/h-code/wp-content/plugins/revslider/admin/assets/images/dummy.png"
                                                                alt="" data-ww="1920px" data-hh="<?php echo $hh;?>px" width="1920"
                                                                height="<?php echo $hh;?>"
                                                                data-lazyload="<?php echo $randomImage;?>"
                                                                data-no-retina></div>
                                                        <div class="tp-caption   tp-resizeme" id="slide-77-layer-1"
                                                             data-x="center" data-hoffset="" data-y="center"
                                                             data-voffset="" data-width="['none','none','none','none']"
                                                             data-height="['none','none','none','none']"
                                                             data-type="image" data-responsive_offset="on"
                                                             data-frames='[{"from":"y:50px;opacity:0;","speed":1,"to":"o:1;","delay":1,"ease":"Power4.easeOut"},{"delay":"wait","speed":1,"to":"y:50px;opacity:0;","ease":"Power4.easeIn"}]'
                                                             data-textAlign="['left','left','left','left']"
                                                             data-paddingtop="[0,0,0,0]" data-paddingright="[0,0,0,0]"
                                                             data-paddingbottom="[0,0,0,0]" data-paddingleft="[0,0,0,0]"
                                                             style="z-index: 33;text-transform:left;z-index:100;"><img
                                                                src="http://wpdemos.themezaa.com/h-code/wp-content/plugins/revslider/admin/assets/images/dummy.png"
                                                                alt="" data-ww="5760px" data-hh="3240px" width="5760"
                                                                height="3240"
                                                                data-lazyload="http://wpdemos.themezaa.com/h-code/wp-content/uploads/revslider/fashion_intro/white-up.png"
                                                                data-no-retina></div>
                                                        <div class="tp-caption   tp-resizeme" id="slide-77-layer-2"
                                                             data-x="15" data-y="100"
                                                             data-width="['none','none','none','none']"
                                                             data-height="['none','none','none','none']"
                                                             data-type="image" data-responsive_offset="on"
                                                             data-frames='[{"from":"y:-50px;opacity:0;","speed":1000,"to":"o:1;","delay":1300,"ease":"Power4.easeOut"},{"delay":4700,"speed":1000,"to":"y:-50px;opacity:0;","ease":"Power4.easeIn"}]'
                                                             data-textAlign="['left','left','left','left']"
                                                             data-paddingtop="[0,0,0,0]" data-paddingright="[0,0,0,0]"
                                                             data-paddingbottom="[0,0,0,0]" data-paddingleft="[0,0,0,0]"
                                                             style="z-index: 34;text-transform:left;z-index:2;text-align:center;">
                                                            <?php
                                                            $randomImage = $arProjectAllImages[rand(0, count($arProjectAllImages) - 1)];
                                                            $imageSizes = getimagesize ( $randomImage );

                                                            $imgHeight = $imageSizes[1];
                                                            $imgWidth = $imageSizes[0];
                                                            $hh = round((1905 * $imgHeight) / $imgWidth);
                                                            ?>
                                                            <img
                                                                src="http://wpdemos.themezaa.com/h-code/wp-content/plugins/revslider/admin/assets/images/dummy.png"
                                                                alt="" data-ww="1905px" data-hh="<?php echo $hh;?>px" width="1905"
                                                                height="<?php echo $hh;?>"
                                                                data-lazyload="<?php echo $randomImage;?>"
                                                                data-no-retina></div>
                                                        <div class="tp-caption   tp-resizeme" id="slide-77-layer-3"
                                                             data-x="1400" data-y="bottom" data-voffset="-30"
                                                             data-width="['none','none','none','none']"
                                                             data-height="['none','none','none','none']"
                                                             data-type="image" data-responsive_offset="on"
                                                             data-frames='[{"from":"x:right;skX:-85px;","speed":1000,"to":"o:1;","delay":2000,"ease":"Power4.easeOut"},{"delay":4000,"speed":1000,"to":"x:right;skX:-85px;","ease":"Power4.easeIn"}]'
                                                             data-textAlign="['left','left','left','left']"
                                                             data-paddingtop="[0,0,0,0]" data-paddingright="[0,0,0,0]"
                                                             data-paddingbottom="[0,0,0,0]" data-paddingleft="[0,0,0,0]"
                                                             style="z-index: 35;text-transform:left;z-index:2;text-align:center;">

                                                            <?php
                                                            $randomImage = $arProjectAllImages[rand(0, count($arProjectAllImages) - 1)];
                                                            $imageSizes = getimagesize ( $randomImage );

                                                            $imgHeight = $imageSizes[1];
                                                            $imgWidth = $imageSizes[0];
                                                            $hh = round((458 * $imgHeight) / $imgWidth);
                                                            ?>
                                                            <img
                                                                src="http://wpdemos.themezaa.com/h-code/wp-content/plugins/revslider/admin/assets/images/dummy.png"
                                                                alt="" data-ww="458px" data-hh="<?php echo $hh;?>px" width="458"
                                                                height="<?php echo $hh;?>"
                                                                data-lazyload="<?php echo $randomImage;?>"
                                                                data-no-retina></div>
                                                        <div class="tp-caption   tp-resizeme" id="slide-77-layer-4"
                                                             data-x="660" data-y="200"
                                                             data-width="['none','none','none','none']"
                                                             data-height="['none','none','none','none']"
                                                             data-type="image" data-responsive_offset="on"
                                                             data-frames='[{"from":"x:left;","speed":1000,"to":"o:1;","delay":3000,"ease":"Power4.easeOut"},{"delay":3000,"speed":1000,"to":"x:left;skX:45px;","ease":"Power4.easeIn"}]'
                                                             data-textAlign="['left','left','left','left']"
                                                             data-paddingtop="[0,0,0,0]" data-paddingright="[0,0,0,0]"
                                                             data-paddingbottom="[0,0,0,0]" data-paddingleft="[0,0,0,0]"
                                                             style="z-index: 36;text-transform:left;z-index:2;">
                                                            <?php
                                                            $randomImage = $arProjectAllImages[rand(0, count($arProjectAllImages) - 1)];
                                                            $imageSizes = getimagesize ( $randomImage );

                                                            $imgHeight = $imageSizes[1];
                                                            $imgWidth = $imageSizes[0];
                                                            $hh = round((519 * $imgHeight) / $imgWidth);
                                                            ?>
                                                            <img
                                                                src="http://wpdemos.themezaa.com/h-code/wp-content/plugins/revslider/admin/assets/images/dummy.png"
                                                                alt="" data-ww="519px" data-hh="<?php echo $hh;?>px" width="519"
                                                                height="<?php echo $hh;?>"
                                                                data-lazyload="<?php echo $randomImage;?>"
                                                                data-no-retina></div>
                                                        <div class="tp-caption Fashion-BigDisplay   tp-resizeme"
                                                             id="slide-77-layer-5" data-x="100" data-y="bottom"
                                                             data-voffset="120" data-width="['auto']"
                                                             data-height="['auto']" data-type="text"
                                                             data-responsive_offset="on"
                                                             data-frames='[{"from":"y:50px;opacity:0;","speed":1000,"to":"o:1;","delay":3200,"ease":"Power4.easeOut"},{"delay":2800,"speed":1000,"to":"y:-50px;opacity:0;","ease":"Power4.easeIn"}]'
                                                             data-textAlign="['left','left','left','left']"
                                                             data-paddingtop="[0,0,0,0]" data-paddingright="[0,0,0,0]"
                                                             data-paddingbottom="[0,0,0,0]" data-paddingleft="[0,0,0,0]"
                                                             style="z-index: 37; white-space: nowrap; font-size: 40px; font-weight: 400;font-family:Playfair Display SC;text-transform:uppercase;z-index:2;position:absolute;margin:0px;white-space:nowrap;letter-spacing:2px;">
                                                            <?php
                                                            $URL = get_post_meta($arProject["ID"], 'URL');

                                                            if(!empty($URL)) {
                                                                ?>
                                                                <a href="<?php echo $URL[0]; ?>" target="_blank">
                                                                    <?php echo $URL[0]; ?>
                                                                </a>
                                                                <?php
                                                            }
                                                            ?>
                                                        </div>
                                                        <div class="tp-caption Fashion-BigDisplay   tp-resizeme"
                                                             id="slide-77-layer-6" data-x="100" data-y="bottom"
                                                             data-voffset="50" data-width="['auto']"
                                                             data-height="['auto']" data-type="text"
                                                             data-responsive_offset="on"
                                                             data-frames='[{"from":"y:50px;opacity:0;","speed":1000,"to":"o:1;","delay":3400,"ease":"Power4.easeOut"},{"delay":2600,"speed":1000,"to":"y:-50px;opacity:0;","ease":"Power4.easeIn"}]'
                                                             data-textAlign="['left','left','left','left']"
                                                             data-paddingtop="[0,0,0,0]" data-paddingright="[0,0,0,0]"
                                                             data-paddingbottom="[0,0,0,0]" data-paddingleft="[0,0,0,0]"
                                                             style="z-index: 38; white-space: nowrap; font-size: 20px; line-height: 30px; font-weight: 400;font-family:Open Sans;text-transform:uppercase;text-decoration:none;z-index:2;letter-spacing:normal;">
                                                            <?php
                                                            echo kama_excerpt( array('text'=>$arProject["post_content"], 'maxchar'=>500) );?>
                                                        </div>
                                                    </li>
                                                    <?php
                                                    $randomImage = $arProjectImages[rand(0, count($arProjectImages) - 1)];
                                                    /*$imageSizes = getimagesize ( $randomImage );

                                                    $imgHeight = $imageSizes[1];
                                                    $imgWidth = $imageSizes[0];
                                                    $hh = round((1920 * $imgHeight) / $imgWidth);*/

                                                    $filename = $randomImage;
                                                    $new_filen = $_SERVER["DOCUMENT_ROOT"].'/wp-content/uploads/' . basename($filename);


                                                    $fileNew = "/wp-content/uploads/" . basename($filename);

                                                    cropImage($randomImage,
                                                        $_SERVER['DOCUMENT_ROOT'] . $fileNew,
                                                        180, 110);
                                                    ?>


                                                    <li data-index="rs-78" data-transition="fade" data-slotamount="1"
                                                        data-hideafterloop="0" data-hideslideonmobile="off"
                                                        data-easein="default" data-easeout="default"
                                                        data-masterspeed="500"
                                                        data-thumb="<?php echo $fileNew; ?>"
                                                        data-delay="7000" data-rotate="0" data-saveperformance="off"
                                                        class="no-transition" data-title="Страница 5" data-param1=""
                                                        data-param2="" data-param3="" data-param4="" data-param5=""
                                                        data-param6="" data-param7="" data-param8="" data-param9=""
                                                        data-param10="" data-description=""><img
                                                            src="http://wpdemos.themezaa.com/h-code/wp-content/plugins/revslider/admin/assets/images/dummy.png"
                                                            alt="" title="dummy.png" width="10" height="10"
                                                            data-lazyload="http://wpdemos.themezaa.com/h-code/wp-content/uploads/revslider/fashion_intro/dummy.png"
                                                            data-bgposition="center center" data-bgfit="cover"
                                                            data-bgrepeat="no-repeat" class="rev-slidebg"
                                                            data-no-retina>
                                                        <div class="tp-caption   tp-resizeme" id="slide-78-layer-1"
                                                             data-x="center" data-hoffset="" data-y="center"
                                                             data-voffset="" data-width="['none','none','none','none']"
                                                             data-height="['none','none','none','none']"
                                                             data-type="image" data-responsive_offset="on"
                                                             data-frames='[{"from":"y:50px;opacity:0;","speed":1,"to":"o:1;","delay":1,"ease":"Power4.easeOut"},{"delay":"wait","speed":1,"to":"y:50px;opacity:0;","ease":"Power4.easeIn"}]'
                                                             data-textAlign="['left','left','left','left']"
                                                             data-paddingtop="[0,0,0,0]" data-paddingright="[0,0,0,0]"
                                                             data-paddingbottom="[0,0,0,0]" data-paddingleft="[0,0,0,0]"
                                                             style="z-index: 39;text-transform:left;z-index:100;"><img
                                                                src="http://wpdemos.themezaa.com/h-code/wp-content/plugins/revslider/admin/assets/images/dummy.png"
                                                                alt="" data-ww="5760px" data-hh="3240px" width="5760"
                                                                height="3240"
                                                                data-lazyload="http://wpdemos.themezaa.com/h-code/wp-content/uploads/revslider/fashion_intro/white-up.png"
                                                                data-no-retina></div>
                                                        <div class="tp-caption   tp-resizeme" id="slide-78-layer-7"
                                                             data-x="center" data-hoffset="" data-y="-97"
                                                             data-width="['none','none','none','none']"
                                                             data-height="['none','none','none','none']"
                                                             data-type="image" data-responsive_offset="on"
                                                             data-frames='[{"from":"y:-50px;opacity:0;","speed":1000,"to":"o:1;","delay":1300,"ease":"Power2.easeInOut"},{"delay":3700,"speed":1000,"to":"y:-50px;opacity:0;","ease":"Power4.easeIn"}]'
                                                             data-textAlign="['left','left','left','left']"
                                                             data-paddingtop="[0,0,0,0]" data-paddingright="[0,0,0,0]"
                                                             data-paddingbottom="[0,0,0,0]" data-paddingleft="[0,0,0,0]"
                                                             style="z-index: 40;text-transform:left;z-index:2;text-align:center;">
                                                            <?php
                                                            $randomImage = $arProjectAllImages[rand(0, count($arProjectAllImages) - 1)];
                                                            $imageSizes = getimagesize ( $randomImage );

                                                            $imgHeight = $imageSizes[1];
                                                            $imgWidth = $imageSizes[0];
                                                            $hh = round((1920 * $imgHeight) / $imgWidth);
                                                            ?>
                                                            <img
                                                                src="http://wpdemos.themezaa.com/h-code/wp-content/plugins/revslider/admin/assets/images/dummy.png"
                                                                alt="" data-ww="1920px" data-hh="<?php echo $hh;?>px" width="1920"
                                                                height="<?php echo $hh;?>"
                                                                data-lazyload="<?php echo $randomImage;?>"
                                                                data-no-retina></div>
                                                        <div class="tp-caption   tp-resizeme" id="slide-78-layer-2"
                                                             data-x="center" data-hoffset="" data-y="bottom"
                                                             data-voffset="" data-width="['none','none','none','none']"
                                                             data-height="['none','none','none','none']"
                                                             data-type="image" data-responsive_offset="on"
                                                             data-frames='[{"from":"y:50px;opacity:0;","speed":1000,"to":"o:1;","delay":1500,"ease":"Power4.easeOut"},{"delay":3500,"speed":1000,"to":"y:50px;opacity:0;","ease":"Power4.easeIn"}]'
                                                             data-textAlign="['left','left','left','left']"
                                                             data-paddingtop="[0,0,0,0]" data-paddingright="[0,0,0,0]"
                                                             data-paddingbottom="[0,0,0,0]" data-paddingleft="[0,0,0,0]"
                                                             style="z-index: 41;text-transform:left;z-index:2;text-align:center;">
                                                            <?php
                                                            $randomImage = $arProjectAllImages[rand(0, count($arProjectAllImages) - 1)];
                                                            $imageSizes = getimagesize ( $randomImage );

                                                            $imgHeight = $imageSizes[1];
                                                            $imgWidth = $imageSizes[0];
                                                            $hh = round((1920 * $imgHeight) / $imgWidth);
                                                            ?>
                                                            <img
                                                                src="http://wpdemos.themezaa.com/h-code/wp-content/plugins/revslider/admin/assets/images/dummy.png"
                                                                alt="" data-ww="1920px" data-hh="<?php echo $hh;?>px" width="1920"
                                                                height="<?php echo $hh;?>"
                                                                data-lazyload="<?php echo $randomImage;?>"
                                                                data-no-retina></div>
                                                        <div class="tp-caption   tp-resizeme" id="slide-78-layer-3"
                                                             data-x="10" data-y="-330"
                                                             data-width="['none','none','none','none']"
                                                             data-height="['none','none','none','none']"
                                                             data-type="image" data-responsive_offset="on"
                                                             data-frames='[{"from":"y:-50px;opacity:0;","speed":1000,"to":"o:1;","delay":2000,"ease":"Power4.easeOut"},{"delay":3000,"speed":1000,"to":"y:-50px;opacity:0;","ease":"Power4.easeIn"}]'
                                                             data-textAlign="['left','left','left','left']"
                                                             data-paddingtop="[0,0,0,0]" data-paddingright="[0,0,0,0]"
                                                             data-paddingbottom="[0,0,0,0]" data-paddingleft="[0,0,0,0]"
                                                             style="z-index: 42;text-transform:left;z-index:2;text-align:center;">
                                                            <?php
                                                            $randomImage = $arProjectAllImages[rand(0, count($arProjectAllImages) - 1)];
                                                            $imageSizes = getimagesize ( $randomImage );

                                                            $imgHeight = $imageSizes[1];
                                                            $imgWidth = $imageSizes[0];
                                                            $hh = round((2029 * $imgHeight) / $imgWidth);
                                                            ?>
                                                            <img
                                                                src="http://wpdemos.themezaa.com/h-code/wp-content/plugins/revslider/admin/assets/images/dummy.png"
                                                                alt="" data-ww="2029px" data-hh="<?php echo $hh;?>px" width="2029"
                                                                height="<?php echo $hh;?>"
                                                                data-lazyload="<?php echo $randomImage;?>"
                                                                data-no-retina></div>
                                                        <div class="tp-caption   tp-resizeme" id="slide-78-layer-4"
                                                             data-x="1100" data-y=""
                                                             data-width="['none','none','none','none']"
                                                             data-height="['none','none','none','none']"
                                                             data-type="image" data-responsive_offset="on"
                                                             data-frames='[{"from":"x:200px;skX:-85px;opacity:0;","speed":1000,"to":"o:1;","delay":2600,"ease":"Power4.easeOut"},{"delay":2400,"speed":1000,"to":"x:200px;skX:-85px;opacity:0;","ease":"Power4.easeIn"}]'
                                                             data-textAlign="['left','left','left','left']"
                                                             data-paddingtop="[0,0,0,0]" data-paddingright="[0,0,0,0]"
                                                             data-paddingbottom="[0,0,0,0]" data-paddingleft="[0,0,0,0]"
                                                             style="z-index: 43;text-transform:left;z-index:2;text-align:center;">

                                                            <?php
                                                            $randomImage = $arProjectAllImages[rand(0, count($arProjectAllImages) - 1)];
                                                            $imageSizes = getimagesize ( $randomImage );

                                                            $imgHeight = $imageSizes[1];
                                                            $imgWidth = $imageSizes[0];
                                                            $hh = round((623 * $imgHeight) / $imgWidth);
                                                            ?>
                                                            <img
                                                                src="http://wpdemos.themezaa.com/h-code/wp-content/plugins/revslider/admin/assets/images/dummy.png"
                                                                alt="" data-ww="623px" data-hh="<?php echo $hh;?>px" width="623"
                                                                height="<?php echo $hh;?>"
                                                                data-lazyload="<?php echo $randomImage;?>"
                                                                data-no-retina></div>
                                                        <div class="tp-caption Fashion-BigDisplay   tp-resizeme"
                                                             id="slide-78-layer-5" data-x="300" data-y="center"
                                                             data-voffset="-125" data-width="['auto']"
                                                             data-height="['auto']" data-type="text"
                                                             data-responsive_offset="on"
                                                             data-frames='[{"from":"x:50px;opacity:0;","speed":1000,"to":"o:1;","delay":3000,"ease":"Power4.easeOut"},{"delay":2000,"speed":1000,"to":"x:-50px;opacity:0;","ease":"Power4.easeIn"}]'
                                                             data-textAlign="['left','left','left','left']"
                                                             data-paddingtop="[0,0,0,0]" data-paddingright="[0,0,0,0]"
                                                             data-paddingbottom="[0,0,0,0]" data-paddingleft="[0,0,0,0]"
                                                             style="z-index: 44; white-space: nowrap; font-size: 100px; line-height: 90px; font-weight: 400;font-family:Playfair Display SC;text-transform:capitalize !important;z-index:2;text-align:left;position:absolute;margin:0px;white-space:nowrap;letter-spacing:2px;">
                                                            <?php echo $arPostTagsNames[rand(0, count($arPostTagsNames) - 1)]; ?>
                                                        </div>
                                                        <div class="tp-caption Fashion-BigDisplay   tp-resizeme"
                                                             id="slide-78-layer-6" data-x="300" data-y="center"
                                                             data-voffset="-50" data-width="['auto']"
                                                             data-height="['auto']" data-type="text"
                                                             data-responsive_offset="on"
                                                             data-frames='[{"from":"x:50px;opacity:0;","speed":1000,"to":"o:1;","delay":3500,"ease":"Power4.easeOut"},{"delay":1500,"speed":1000,"to":"x:-50px;opacity:0;","ease":"Power4.easeIn"}]'
                                                             data-textAlign="['left','left','left','left']"
                                                             data-paddingtop="[0,0,0,0]" data-paddingright="[0,0,0,0]"
                                                             data-paddingbottom="[0,0,0,0]" data-paddingleft="[0,0,0,0]"
                                                             style="z-index: 45; white-space: nowrap; font-size: 30px; line-height: 36px; font-weight: 300;font-family:Open Sans;text-transform:left;z-index:2;text-align:left;position:absolute;margin:0px;white-space:nowrap;letter-spacing:normal;">
                                                            <?php echo $arPostTagsNames[rand(0, count($arPostTagsNames) - 1)]; ?>
                                                        </div>
                                                    </li>
                                                    <?php
                                                    $randomImage = $arProjectImages[rand(0, count($arProjectImages) - 1)];
                                                    /*$imageSizes = getimagesize ( $randomImage );

                                                    $imgHeight = $imageSizes[1];
                                                    $imgWidth = $imageSizes[0];
                                                    $hh = round((1920 * $imgHeight) / $imgWidth);*/

                                                    $filename = $randomImage;
                                                    $new_filen = $_SERVER["DOCUMENT_ROOT"].'/wp-content/uploads/' . basename($filename);


                                                    $fileNew = "/wp-content/uploads/" . basename($filename);

                                                    cropImage($randomImage,
                                                        $_SERVER['DOCUMENT_ROOT'] . $fileNew,
                                                        180, 110);
                                                    ?>
                                                    <li data-index="rs-79" data-transition="fade" data-slotamount="1"
                                                        data-hideafterloop="0" data-hideslideonmobile="off"
                                                        data-easein="default" data-easeout="default"
                                                        data-masterspeed="500"
                                                        data-thumb="<?php echo $fileNew; ?>"
                                                        data-delay="8000" data-rotate="0" data-saveperformance="off"
                                                        class="no-transition" data-title="Страница 6"
                                                        data-param1="" data-param2="" data-param3="" data-param4=""
                                                        data-param5="" data-param6="" data-param7="" data-param8=""
                                                        data-param9="" data-param10="" data-description=""><img
                                                            src="http://wpdemos.themezaa.com/h-code/wp-content/plugins/revslider/admin/assets/images/dummy.png"
                                                            alt="" title="dummy.png" width="10" height="10"
                                                            data-lazyload="http://wpdemos.themezaa.com/h-code/wp-content/uploads/revslider/fashion_intro/dummy.png"
                                                            data-bgposition="center center" data-bgfit="cover"
                                                            data-bgrepeat="no-repeat" class="rev-slidebg"
                                                            data-no-retina>
                                                        <div class="tp-caption   tp-resizeme" id="slide-79-layer-2"
                                                             data-x="10" data-y="-330"
                                                             data-width="['none','none','none','none']"
                                                             data-height="['none','none','none','none']"
                                                             data-type="image" data-responsive_offset="on"
                                                             data-frames='[{"from":"y:-50px;opacity:0;","speed":1000,"to":"o:1;","delay":2000,"ease":"Power4.easeOut"},{"delay":4000,"speed":1000,"to":"y:-50px;opacity:0;","ease":"Power4.easeIn"}]'
                                                             data-textAlign="['left','left','left','left']"
                                                             data-paddingtop="[0,0,0,0]" data-paddingright="[0,0,0,0]"
                                                             data-paddingbottom="[0,0,0,0]" data-paddingleft="[0,0,0,0]"
                                                             style="z-index: 46;text-transform:left;z-index:2;text-align:center;">
                                                            <?php
                                                            $randomImage = $currentBackgroundImage[rand(0, count($currentBackgroundImage) - 1)];
                                                            $imageSizes = getimagesize ( $randomImage );

                                                            $imgHeight = $imageSizes[1];
                                                            $imgWidth = $imageSizes[0];
                                                            $hh = round((2278 * $imgHeight) / $imgWidth);
                                                            ?>
                                                            <img
                                                                src="http://wpdemos.themezaa.com/h-code/wp-content/plugins/revslider/admin/assets/images/dummy.png"
                                                                alt="" data-ww="2278px" data-hh="<?php echo $hh;?>px" width="2278"
                                                                height="<?php echo $hh;?>"
                                                                data-lazyload="<?php echo $randomImage;?>"
                                                                data-no-retina></div>
                                                        <div class="tp-caption   tp-resizeme" id="slide-79-layer-3"
                                                             data-x="900" data-y=""
                                                             data-width="['none','none','none','none']"
                                                             data-height="['none','none','none','none']"
                                                             data-type="image" data-responsive_offset="on"
                                                             data-frames='[{"from":"x:right;","speed":1000,"to":"o:1;","delay":2600,"ease":"Power4.easeOut"},{"delay":3400,"speed":1000,"to":"x:right;","ease":"Power4.easeIn"}]'
                                                             data-textAlign="['left','left','left','left']"
                                                             data-paddingtop="[0,0,0,0]" data-paddingright="[0,0,0,0]"
                                                             data-paddingbottom="[0,0,0,0]" data-paddingleft="[0,0,0,0]"
                                                             style="z-index: 47;text-transform:left;z-index:2;text-align:center;">
                                                            <?php
                                                            $randomImage = $arProjectAllImages[rand(0, count($arProjectAllImages) - 1)];
                                                            $imageSizes = getimagesize ( $randomImage );

                                                            $imgHeight = $imageSizes[1];
                                                            $imgWidth = $imageSizes[0];
                                                            $hh = round((1078 * $imgHeight) / $imgWidth);
                                                            ?>
                                                            <img
                                                                src="http://wpdemos.themezaa.com/h-code/wp-content/plugins/revslider/admin/assets/images/dummy.png"
                                                                alt="" data-ww="1078px" data-hh="<?php echo $hh;?>px" width="1078"
                                                                height="<?php echo $hh;?>"
                                                                data-lazyload="<?php echo $randomImage;?>"
                                                                data-no-retina></div>
                                                        <div class="tp-caption Fashion-BigDisplay   tp-resizeme"
                                                             id="slide-79-layer-4" data-x="300" data-y="center"
                                                             data-voffset="-125" data-width="['auto']"
                                                             data-height="['auto']" data-type="text"
                                                             data-responsive_offset="on"
                                                             data-frames='[{"from":"x:50px;opacity:0;","speed":1000,"to":"o:1;","delay":3000,"ease":"Power4.easeOut"},{"delay":3000,"speed":1000,"to":"x:-50px;opacity:0;","ease":"Power4.easeIn"}]'
                                                             data-textAlign="['left','left','left','left']"
                                                             data-paddingtop="[0,0,0,0]" data-paddingright="[0,0,0,0]"
                                                             data-paddingbottom="[0,0,0,0]" data-paddingleft="[0,0,0,0]"
                                                             style="z-index: 48; white-space: nowrap; font-size: 100px; line-height: 90px; font-weight: 400;font-family:Playfair Display SC;text-transform:uppercase;z-index:2;text-align:left;position:absolute;margin:0px;white-space:nowrap;letter-spacing:2px;">
                                                            <?php echo $arPostTagsNames[rand(0, count($arPostTagsNames) - 1)]; ?>
                                                        </div>
                                                        <div class="tp-caption Fashion-BigDisplay   tp-resizeme"
                                                             id="slide-79-layer-5" data-x="310" data-y="center"
                                                             data-voffset="" data-width="['auto']"
                                                             data-height="['auto']" data-type="text"
                                                             data-responsive_offset="on"
                                                             data-frames='[{"from":"x:50px;opacity:0;","speed":1000,"to":"o:1;","delay":3500,"ease":"Power4.easeOut"},{"delay":2500,"speed":1000,"to":"x:-50px;opacity:0;","ease":"Power4.easeIn"}]'
                                                             data-textAlign="['left','left','left','left']"
                                                             data-paddingtop="[0,0,0,0]" data-paddingright="[0,0,0,0]"
                                                             data-paddingbottom="[0,0,0,0]" data-paddingleft="[0,0,0,0]"
                                                             style="z-index: 49; white-space: nowrap; font-size: 30px; font-weight: 400;font-family:Playfair Display SC;text-transform:uppercase;z-index:2;text-align:left;position:absolute;margin:0px;white-space:nowrap;letter-spacing:2px;">
                                                            <?php  $arPostTagsNames3Elements =array_slice($arPostTagsNames,0,3);
                                                            echo implode(" & ", $arPostTagsNames3Elements ); ?>
                                                        </div>
                                                    </li>

                                                    <?php
                                                    $randomImage = $arProjectImages[rand(0, count($arProjectImages) - 1)];
                                                    /*$imageSizes = getimagesize ( $randomImage );

                                                    $imgHeight = $imageSizes[1];
                                                    $imgWidth = $imageSizes[0];
                                                    $hh = round((1920 * $imgHeight) / $imgWidth);*/

                                                    $filename = $randomImage;
                                                    $new_filen = $_SERVER["DOCUMENT_ROOT"].'/wp-content/uploads/' . basename($filename);


                                                    $fileNew = "/wp-content/uploads/" . basename($filename);

                                                    cropImage($randomImage,
                                                        $_SERVER['DOCUMENT_ROOT'] . $fileNew,
                                                        180, 110);
                                                    ?>
                                                    <li data-index="rs-80" data-transition="fade" data-slotamount="1"
                                                        data-hideafterloop="0" data-hideslideonmobile="off"
                                                        data-easein="default" data-easeout="default"
                                                        data-masterspeed="500"
                                                        data-thumb="<?php echo $fileNew; ?>"
                                                        data-delay="8000" data-rotate="0" data-saveperformance="off"
                                                        class="no-transition" data-title="Страница 7"
                                                        data-param1="" data-param2="" data-param3="" data-param4=""
                                                        data-param5="" data-param6="" data-param7="" data-param8=""
                                                        data-param9="" data-param10="" data-description=""><img
                                                            src="http://wpdemos.themezaa.com/h-code/wp-content/plugins/revslider/admin/assets/images/dummy.png"
                                                            alt="" title="dummy.png" width="10" height="10"
                                                            data-lazyload="http://wpdemos.themezaa.com/h-code/wp-content/uploads/revslider/fashion_intro/dummy.png"
                                                            data-bgposition="center center" data-bgfit="cover"
                                                            data-bgrepeat="no-repeat" class="rev-slidebg"
                                                            data-no-retina>
                                                        <div class="tp-caption   tp-resizeme" id="slide-80-layer-2"
                                                             data-x="-300" data-y="-150"
                                                             data-width="['none','none','none','none']"
                                                             data-height="['none','none','none','none']"
                                                             data-type="image" data-responsive_offset="on"
                                                             data-frames='[{"from":"y:-50px;opacity:0;","speed":1000,"to":"o:1;","delay":2000,"ease":"Power4.easeOut"},{"delay":4000,"speed":1000,"to":"y:-50px;opacity:0;","ease":"Power4.easeIn"}]'
                                                             data-textAlign="['left','left','left','left']"
                                                             data-paddingtop="[0,0,0,0]" data-paddingright="[0,0,0,0]"
                                                             data-paddingbottom="[0,0,0,0]" data-paddingleft="[0,0,0,0]"
                                                             style="z-index: 50;text-transform:left;z-index:2;text-align:center;">
                                                            <?php
                                                            $randomImage = $currentBackgroundImage[rand(0, count($currentBackgroundImage) - 1)];
                                                            $imageSizes = getimagesize ( $randomImage );

                                                            $imgHeight = $imageSizes[1];
                                                            $imgWidth = $imageSizes[0];
                                                            $hh = round((2500 * $imgHeight) / $imgWidth);
                                                            ?>
                                                            <img
                                                                src="http://wpdemos.themezaa.com/h-code/wp-content/plugins/revslider/admin/assets/images/dummy.png"
                                                                alt="" data-ww="2500px" data-hh="<?php echo $hh;?>px" width="2500"
                                                                height="<?php echo $hh;?>"
                                                                data-lazyload="<?php echo $randomImage;?>"
                                                                data-no-retina></div>
                                                        <div class="tp-caption   tp-resizeme" id="slide-80-layer-3"
                                                             data-x="-100" data-y=""
                                                             data-width="['none','none','none','none']"
                                                             data-height="['none','none','none','none']"
                                                             data-type="image" data-responsive_offset="on"
                                                             data-frames='[{"from":"x:-50px;opacity:0;","speed":1000,"to":"o:1;","delay":2600,"ease":"Power4.easeOut"},{"delay":3400,"speed":1000,"to":"x:-50px;opacity:0;","ease":"Power4.easeIn"}]'
                                                             data-textAlign="['left','left','left','left']"
                                                             data-paddingtop="[0,0,0,0]" data-paddingright="[0,0,0,0]"
                                                             data-paddingbottom="[0,0,0,0]" data-paddingleft="[0,0,0,0]"
                                                             style="z-index: 51;text-transform:left;z-index:2;text-align:center;">
                                                            <?php
                                                            $randomImage = $arProjectAllImages[rand(0, count($arProjectAllImages) - 1)];
                                                            $imageSizes = getimagesize ( $randomImage );

                                                            $imgHeight = $imageSizes[1];
                                                            $imgWidth = $imageSizes[0];
                                                            $hh = round((843 * $imgHeight) / $imgWidth);
                                                            ?>
                                                            <img
                                                                src="http://wpdemos.themezaa.com/h-code/wp-content/plugins/revslider/admin/assets/images/dummy.png"
                                                                alt="" data-ww="843px" data-hh="<?php echo $hh;?>px" width="843"
                                                                height="<?php echo $hh;?>"
                                                                data-lazyload="<?php echo $randomImage;?>"
                                                                data-no-retina></div>
                                                        <div class="tp-caption Fashion-BigDisplay   tp-resizeme"
                                                             id="slide-80-layer-4" data-x="900" data-y="center"
                                                             data-voffset="-75" data-width="['auto']"
                                                             data-height="['auto']" data-type="text"
                                                             data-responsive_offset="on"
                                                             data-frames='[{"from":"x:50px;opacity:0;","speed":1000,"to":"o:1;","delay":3000,"ease":"Power4.easeOut"},{"delay":3000,"speed":1000,"to":"x:-50px;opacity:0;","ease":"Power4.easeIn"}]'
                                                             data-textAlign="['left','left','left','left']"
                                                             data-paddingtop="[0,0,0,0]" data-paddingright="[0,0,0,0]"
                                                             data-paddingbottom="[0,0,0,0]" data-paddingleft="[0,0,0,0]"
                                                             style="z-index: 52; white-space: nowrap; font-size: 100px; line-height: 90px; font-weight: 700;font-family:Playfair Display SC;text-transform:uppercase;z-index:2;text-align:left;position:absolute;margin:0px;white-space:nowrap;letter-spacing:2px;">
                                                            <?php echo $arPostTagsNames[rand(0, count($arPostTagsNames) - 1)]; ?>
                                                        </div>
                                                        <div class="tp-caption Fashion-BigDisplay   tp-resizeme"
                                                             id="slide-80-layer-5" data-x="900" data-y="center"
                                                             data-voffset="50" data-width="['auto']"
                                                             data-height="['auto']" data-type="text"
                                                             data-responsive_offset="on"
                                                             data-frames='[{"from":"x:50px;opacity:0;","speed":1000,"to":"o:1;","delay":3500,"ease":"Power4.easeOut"},{"delay":2500,"speed":1000,"to":"x:-50px;opacity:0;","ease":"Power4.easeIn"}]'
                                                             data-textAlign="['left','left','left','left']"
                                                             data-paddingtop="[0,0,0,0]" data-paddingright="[0,0,0,0]"
                                                             data-paddingbottom="[0,0,0,0]" data-paddingleft="[0,0,0,0]"
                                                             style="z-index: 53; white-space: nowrap; font-size: 30px; font-weight: 400;font-family:Playfair Display SC;text-transform:uppercase;z-index:2;text-align:left;position:absolute;margin:0px;white-space:nowrap;letter-spacing:2px;">
                                                            <?php echo $arPostTagsNames[rand(0, count($arPostTagsNames) - 1)]; ?>
                                                        </div>
                                                    </li>
                                                    <?php
                                                    $randomImage = $arProjectImages[rand(0, count($arProjectImages) - 1)];
                                                    /*$imageSizes = getimagesize ( $randomImage );

                                                    $imgHeight = $imageSizes[1];
                                                    $imgWidth = $imageSizes[0];
                                                    $hh = round((1920 * $imgHeight) / $imgWidth);*/

                                                    $filename = $randomImage;
                                                    $new_filen = $_SERVER["DOCUMENT_ROOT"].'/wp-content/uploads/' . basename($filename);


                                                    $fileNew = "/wp-content/uploads/" . basename($filename);

                                                    cropImage($randomImage,
                                                        $_SERVER['DOCUMENT_ROOT'] . $fileNew,
                                                        180, 110);
                                                    ?>
                                                    <li data-index="rs-81" data-transition="fade" data-slotamount="1"
                                                        data-hideafterloop="0" data-hideslideonmobile="off"
                                                        data-easein="default" data-easeout="default"
                                                        data-masterspeed="500"
                                                        data-thumb="<?php echo $fileNew; ?>"
                                                        data-delay="8000" data-rotate="0" data-saveperformance="off"
                                                        class="no-transition" data-title="Страница 8" data-param1=""
                                                        data-param2="" data-param3="" data-param4="" data-param5=""
                                                        data-param6="" data-param7="" data-param8="" data-param9=""
                                                        data-param10="" data-description=""><img
                                                            src="http://wpdemos.themezaa.com/h-code/wp-content/plugins/revslider/admin/assets/images/dummy.png"
                                                            alt="" title="dummy.png" width="10" height="10"
                                                            data-lazyload="http://wpdemos.themezaa.com/h-code/wp-content/uploads/revslider/fashion_intro/dummy.png"
                                                            data-bgposition="center center" data-bgfit="cover"
                                                            data-bgrepeat="no-repeat" class="rev-slidebg"
                                                            data-no-retina>
                                                        <div class="tp-caption   tp-resizeme" id="slide-81-layer-2"
                                                             data-x="-20" data-y=""
                                                             data-width="['none','none','none','none']"
                                                             data-height="['none','none','none','none']"
                                                             data-type="image" data-responsive_offset="on"
                                                             data-frames='[{"from":"x:left;","speed":1000,"to":"o:1;","delay":2000,"ease":"Power4.easeOut"},{"delay":4000,"speed":1000,"to":"x:left;","ease":"Power4.easeIn"}]'
                                                             data-textAlign="['left','left','left','left']"
                                                             data-paddingtop="[0,0,0,0]" data-paddingright="[0,0,0,0]"
                                                             data-paddingbottom="[0,0,0,0]" data-paddingleft="[0,0,0,0]"
                                                             style="z-index: 54;text-transform:left;z-index:2;text-align:center;">
                                                            <?php
                                                            $randomImage = $arProjectAllImages[rand(0, count($arProjectAllImages) - 1)];
                                                            $imageSizes = getimagesize ( $randomImage );

                                                            $imgHeight = $imageSizes[1];
                                                            $imgWidth = $imageSizes[0];
                                                            $hh = round((963 * $imgHeight) / $imgWidth);
                                                            ?>
                                                            <img
                                                                src="http://wpdemos.themezaa.com/h-code/wp-content/plugins/revslider/admin/assets/images/dummy.png"
                                                                alt="" data-ww="963px" data-hh="<?php echo $hh;?>px" width="963"
                                                                height="<?php echo $hh;?>"
                                                                data-lazyload="<?php echo $randomImage;?>"
                                                                data-no-retina></div>
                                                        <div class="tp-caption   tp-resizeme" id="slide-81-layer-3"
                                                             data-x="943" data-y=""
                                                             data-width="['none','none','none','none']"
                                                             data-height="['none','none','none','none']"
                                                             data-type="image" data-responsive_offset="on"
                                                             data-frames='[{"from":"x:right;","speed":1000,"to":"o:1;","delay":2600,"ease":"Power4.easeOut"},{"delay":3400,"speed":1000,"to":"x:right;","ease":"Power4.easeIn"}]'
                                                             data-textAlign="['left','left','left','left']"
                                                             data-paddingtop="[0,0,0,0]" data-paddingright="[0,0,0,0]"
                                                             data-paddingbottom="[0,0,0,0]" data-paddingleft="[0,0,0,0]"
                                                             style="z-index: 55;text-transform:left;z-index:2;text-align:center;">
                                                            <?php
                                                            $randomImage = $arProjectAllImages[rand(0, count($arProjectAllImages) - 1)];
                                                            $imageSizes = getimagesize ( $randomImage );

                                                            $imgHeight = $imageSizes[1];
                                                            $imgWidth = $imageSizes[0];
                                                            $hh = round((957 * $imgHeight) / $imgWidth);
                                                            ?>
                                                            <img
                                                                src="http://wpdemos.themezaa.com/h-code/wp-content/plugins/revslider/admin/assets/images/dummy.png"
                                                                alt="" data-ww="957px" data-hh="<?php echo $hh;?>px" width="957"
                                                                height="<?php echo $hh;?>"
                                                                data-lazyload="<?php echo $randomImage;?>"
                                                                data-no-retina></div>
                                                        <div class="tp-caption Fashion-BigDisplay   tp-resizeme"
                                                             id="slide-81-layer-4" data-x="1100" data-y="center"
                                                             data-voffset="-75" data-width="['auto']"
                                                             data-height="['auto']" data-type="text"
                                                             data-responsive_offset="on"
                                                             data-frames='[{"from":"x:right;","speed":1000,"to":"o:1;","delay":3000,"ease":"Power4.easeOut"},{"delay":3000,"speed":1000,"to":"x:right;","ease":"Power4.easeIn"}]'
                                                             data-textAlign="['left','left','left','left']"
                                                             data-paddingtop="[0,0,0,0]" data-paddingright="[0,0,0,0]"
                                                             data-paddingbottom="[0,0,0,0]" data-paddingleft="[0,0,0,0]"
                                                             style="z-index: 56; white-space: nowrap; font-size: 100px; line-height: 90px; font-weight: 400;font-family:Playfair Display SC;text-transform:capitalize;z-index:2;text-align:left;position:absolute;margin:0px;white-space:nowrap;letter-spacing:2px;">
                                                            Описание
                                                        </div>
                                                        <div class="tp-caption Fashion-BigDisplay   tp-resizeme"
                                                             id="slide-81-layer-5" data-x="1100" data-y="center"
                                                             data-voffset="150" data-width="['auto']"
                                                             data-height="['auto']" data-type="text"
                                                             data-responsive_offset="on"
                                                             data-frames='[{"from":"x:right;","speed":1000,"to":"o:1;","delay":3500,"ease":"Power4.easeOut"},{"delay":2500,"speed":1000,"to":"x:right;","ease":"Power4.easeIn"}]'
                                                             data-textAlign="['left','left','left','left']"
                                                             data-paddingtop="[0,0,0,0]" data-paddingright="[0,0,0,0]"
                                                             data-paddingbottom="[0,0,0,0]" data-paddingleft="[0,0,0,0]"
                                                             style="z-index: 57; white-space: nowrap; font-size: 16px; line-height: 22px; font-weight: 300;font-family:Open Sans;text-transform:left;text-decoration:none;z-index:2;text-align:left;letter-spacing:normal;">
                                                            <?php
                                                            echo kama_excerpt( array('text'=>$arProject["post_content"], 'maxchar'=>500) );?>
                                                        </div>
                                                    </li>
                                                    <?php
                                                    $randomImage = $arProjectImages[rand(0, count($arProjectImages) - 1)];
                                                    /*$imageSizes = getimagesize ( $randomImage );

                                                    $imgHeight = $imageSizes[1];
                                                    $imgWidth = $imageSizes[0];
                                                    $hh = round((1920 * $imgHeight) / $imgWidth);*/

                                                    $filename = $randomImage;
                                                    $new_filen = $_SERVER["DOCUMENT_ROOT"].'/wp-content/uploads/' . basename($filename);


                                                    $fileNew = "/wp-content/uploads/" . basename($filename);

                                                    cropImage($randomImage,
                                                        $_SERVER['DOCUMENT_ROOT'] . $fileNew,
                                                        180, 110);
                                                    ?>
                                                    <li data-index="rs-82" data-transition="fade" data-slotamount="1"
                                                        data-hideafterloop="0" data-hideslideonmobile="off"
                                                        data-easein="default" data-easeout="default"
                                                        data-masterspeed="500"
                                                        data-thumb="<?php echo $fileNew; ?>"
                                                        data-delay="8000" data-rotate="0" data-saveperformance="off"
                                                        class="no-transition" data-title="Страница 9" data-param1=""
                                                        data-param2="" data-param3="" data-param4="" data-param5=""
                                                        data-param6="" data-param7="" data-param8="" data-param9=""
                                                        data-param10="" data-description="">
                                                        <?php
                                                        $randomImage = $arProjectAllImages[rand(0, count($arProjectAllImages) - 1)];
                                                        $imageSizes = getimagesize ( $randomImage );

                                                        $imgHeight = $imageSizes[1];
                                                        $imgWidth = $imageSizes[0];
                                                        $hh = round((1024 * $imgHeight) / $imgWidth);
                                                        ?>
                                                        <img
                                                            src="http://wpdemos.themezaa.com/h-code/wp-content/plugins/revslider/admin/assets/images/dummy.png"
                                                            alt="" title="intro-fashion-09-img-01" width="1024"
                                                            height="<?php echo $hh;?>"
                                                            data-lazyload="<?php echo $randomImage;?>"
                                                            data-bgposition="center center" data-bgfit="cover"
                                                            data-bgrepeat="no-repeat" class="rev-slidebg"
                                                            data-no-retina>
                                                        <div class="tp-caption   tp-resizeme" id="slide-82-layer-2"
                                                             data-x="410" data-y="center" data-voffset="-102"
                                                             data-width="['none','none','none','none']"
                                                             data-height="['none','none','none','none']"
                                                             data-type="image" data-responsive_offset="on"
                                                             data-frames='[{"from":"x:left;","speed":1000,"to":"o:1;","delay":1300,"ease":"Power4.easeOut"},{"delay":4700,"speed":1000,"to":"y:top;","ease":"Power4.easeIn"}]'
                                                             data-textAlign="['left','left','left','left']"
                                                             data-paddingtop="[0,0,0,0]" data-paddingright="[0,0,0,0]"
                                                             data-paddingbottom="[0,0,0,0]" data-paddingleft="[0,0,0,0]"
                                                             style="z-index: 58;text-transform:left;z-index:2;text-align:center;">
                                                            <?php
                                                            $randomImage = $arProjectAllImages[rand(0, count($arProjectAllImages) - 1)];
                                                            $imageSizes = getimagesize ( $randomImage );

                                                            $imgHeight = $imageSizes[1];
                                                            $imgWidth = $imageSizes[0];
                                                            $hh = round((360 * $imgHeight) / $imgWidth);
                                                            ?>
                                                            <img
                                                                src="http://wpdemos.themezaa.com/h-code/wp-content/plugins/revslider/admin/assets/images/dummy.png"
                                                                alt="" data-ww="360px" data-hh="<?php echo $hh;?>px" width="360"
                                                                height="<?php echo $hh;?>"
                                                                data-lazyload="<?php echo $randomImage;?>"
                                                                data-no-retina></div>
                                                        <div class="tp-caption   tp-resizeme" id="slide-82-layer-3"
                                                             data-x="410" data-y="center" data-voffset="170"
                                                             data-width="['none','none','none','none']"
                                                             data-height="['none','none','none','none']"
                                                             data-type="image" data-responsive_offset="on"
                                                             data-frames='[{"from":"x:left;","speed":1000,"to":"o:1;","delay":2000,"ease":"Power4.easeOut"},{"delay":4000,"speed":1000,"to":"y:bottom;","ease":"Power4.easeIn"}]'
                                                             data-textAlign="['left','left','left','left']"
                                                             data-paddingtop="[0,0,0,0]" data-paddingright="[0,0,0,0]"
                                                             data-paddingbottom="[0,0,0,0]" data-paddingleft="[0,0,0,0]"
                                                             style="z-index: 59;text-transform:left;z-index:2;text-align:center;">

                                                            <?php
                                                            $randomImage = $arProjectAllImages[rand(0, count($arProjectAllImages) - 1)];
                                                            $imageSizes = getimagesize ( $randomImage );

                                                            $imgHeight = $imageSizes[1];
                                                            $imgWidth = $imageSizes[0];
                                                            $hh = round((361 * $imgHeight) / $imgWidth);
                                                            ?>
                                                            <img
                                                                src="http://wpdemos.themezaa.com/h-code/wp-content/plugins/revslider/admin/assets/images/dummy.png"
                                                                alt="" data-ww="361px" data-hh="<?php echo $hh;?>px" width="361"
                                                                height="<?php echo $hh;?>"
                                                                data-lazyload="<?php echo $randomImage;?>"
                                                                data-no-retina></div>
                                                        <div class="tp-caption   tp-resizeme" id="slide-82-layer-4"
                                                             data-x="800" data-y="center" data-voffset=""
                                                             data-width="['none','none','none','none']"
                                                             data-height="['none','none','none','none']"
                                                             data-type="image" data-responsive_offset="on"
                                                             data-frames='[{"from":"y:top;","speed":1000,"to":"o:1;","delay":2700,"ease":"Power4.easeOut"},{"delay":3300,"speed":1000,"to":"y:bottom;","ease":"Power4.easeIn"}]'
                                                             data-textAlign="['left','left','left','left']"
                                                             data-paddingtop="[0,0,0,0]" data-paddingright="[0,0,0,0]"
                                                             data-paddingbottom="[0,0,0,0]" data-paddingleft="[0,0,0,0]"
                                                             style="z-index: 60;text-transform:left;z-index:2;text-align:center;">
                                                            <?php
                                                            $randomImage = $arProjectAllImages[rand(0, count($arProjectAllImages) - 1)];
                                                            $imageSizes = getimagesize ( $randomImage );

                                                            $imgHeight = $imageSizes[1];
                                                            $imgWidth = $imageSizes[0];
                                                            $hh = round((360 * $imgHeight) / $imgWidth);
                                                            ?>
                                                            <img
                                                                src="http://wpdemos.themezaa.com/h-code/wp-content/plugins/revslider/admin/assets/images/dummy.png"
                                                                alt="" data-ww="360px" data-hh="<?php echo $hh;?>px" width="360"
                                                                height="<?php echo $hh;?>"
                                                                data-lazyload="<?php echo $randomImage;?>"
                                                                data-no-retina></div>
                                                        <div class="tp-caption   tp-resizeme" id="slide-82-layer-5"
                                                             data-x="1190" data-y="center" data-voffset="-102"
                                                             data-width="['none','none','none','none']"
                                                             data-height="['none','none','none','none']"
                                                             data-type="image" data-responsive_offset="on"
                                                             data-frames='[{"from":"x:right;","speed":1000,"to":"o:1;","delay":3500,"ease":"Power4.easeOut"},{"delay":2500,"speed":1000,"to":"y:top;","ease":"Power4.easeIn"}]'
                                                             data-textAlign="['left','left','left','left']"
                                                             data-paddingtop="[0,0,0,0]" data-paddingright="[0,0,0,0]"
                                                             data-paddingbottom="[0,0,0,0]" data-paddingleft="[0,0,0,0]"
                                                             style="z-index: 61;text-transform:left;z-index:2;text-align:center;">
                                                            <?php
                                                            $randomImage = $arProjectAllImages[rand(0, count($arProjectAllImages) - 1)];
                                                            $imageSizes = getimagesize ( $randomImage );

                                                            $imgHeight = $imageSizes[1];
                                                            $imgWidth = $imageSizes[0];
                                                            $hh = round((361 * $imgHeight) / $imgWidth);
                                                            ?>
                                                            <img
                                                                src="http://wpdemos.themezaa.com/h-code/wp-content/plugins/revslider/admin/assets/images/dummy.png"
                                                                alt="" data-ww="361px" data-hh="<?php echo $hh;?>px" width="361"
                                                                height="<?php echo $hh;?>"
                                                                data-lazyload="<?php echo $randomImage;?>"
                                                                data-no-retina></div>
                                                        <div class="tp-caption   tp-resizeme" id="slide-82-layer-6"
                                                             data-x="1190" data-y="center" data-voffset="170"
                                                             data-width="['none','none','none','none']"
                                                             data-height="['none','none','none','none']"
                                                             data-type="image" data-responsive_offset="on"
                                                             data-frames='[{"from":"x:right;","speed":1000,"to":"o:1;","delay":4200,"ease":"Power4.easeOut"},{"delay":1800,"speed":1000,"to":"y:bottom;","ease":"Power4.easeIn"}]'
                                                             data-textAlign="['left','left','left','left']"
                                                             data-paddingtop="[0,0,0,0]" data-paddingright="[0,0,0,0]"
                                                             data-paddingbottom="[0,0,0,0]" data-paddingleft="[0,0,0,0]"
                                                             style="z-index: 62;text-transform:left;z-index:2;text-align:center;">
                                                            <?php
                                                            $randomImage = $arProjectAllImages[rand(0, count($arProjectAllImages) - 1)];
                                                            $imageSizes = getimagesize ( $randomImage );

                                                            $imgHeight = $imageSizes[1];
                                                            $imgWidth = $imageSizes[0];
                                                            $hh = round((361 * $imgHeight) / $imgWidth);
                                                            ?>
                                                            <img
                                                                src="http://wpdemos.themezaa.com/h-code/wp-content/plugins/revslider/admin/assets/images/dummy.png"
                                                                alt="" data-ww="361px" data-hh="<?php echo $hh;?>px" width="361"
                                                                height="<?php echo $hh;?>"
                                                                data-lazyload="<?php echo $randomImage;?>"
                                                                data-no-retina></div>
                                                    </li>
                                                    <?php
                                                    $randomImage = $arProjectImages[rand(0, count($arProjectImages) - 1)];
                                                    /*$imageSizes = getimagesize ( $randomImage );

                                                    $imgHeight = $imageSizes[1];
                                                    $imgWidth = $imageSizes[0];
                                                    $hh = round((1920 * $imgHeight) / $imgWidth);*/

                                                    $filename = $randomImage;
                                                    $new_filen = $_SERVER["DOCUMENT_ROOT"].'/wp-content/uploads/' . basename($filename);


                                                    $fileNew = "/wp-content/uploads/" . basename($filename);

                                                    cropImage($randomImage,
                                                        $_SERVER['DOCUMENT_ROOT'] . $fileNew,
                                                        180, 110);
                                                    ?>
                                                    <li data-index="rs-83" data-transition="fade" data-slotamount="1"
                                                        data-hideafterloop="0" data-hideslideonmobile="off"
                                                        data-easein="default" data-easeout="default"
                                                        data-masterspeed="500"
                                                        data-thumb="<?php echo $fileNew; ?>"
                                                        data-delay="6000" data-rotate="0" data-saveperformance="off"
                                                        class="no-transition" data-title="Страница 10" data-param1=""
                                                        data-param2="" data-param3="" data-param4="" data-param5=""
                                                        data-param6="" data-param7="" data-param8="" data-param9=""
                                                        data-param10="" data-description=""><img
                                                            src="http://wpdemos.themezaa.com/h-code/wp-content/plugins/revslider/admin/assets/images/dummy.png"
                                                            alt="" title="dummy" width="10" height="10"
                                                            data-lazyload="http://wpdemos.themezaa.com/h-code/wp-content/uploads/2016/02/dummy.png"
                                                            data-bgposition="center center" data-bgfit="cover"
                                                            data-bgrepeat="no-repeat" class="rev-slidebg"
                                                            data-no-retina>
                                                        <div class="tp-caption Fashion-BigDisplay   tp-resizeme"
                                                             id="slide-83-layer-2" data-x="410" data-y="center"
                                                             data-voffset="" data-width="['auto']"
                                                             data-height="['auto']" data-type="text"
                                                             data-responsive_offset="on"
                                                             data-frames='[{"from":"x:left;","speed":1000,"to":"o:1;","delay":1300,"ease":"Power4.easeOut"},{"delay":2700,"speed":1000,"to":"y:top;","ease":"Power4.easeIn"}]'
                                                             data-textAlign="['left','left','left','left']"
                                                             data-paddingtop="[0,0,0,0]" data-paddingright="[0,0,0,0]"
                                                             data-paddingbottom="[0,0,0,0]" data-paddingleft="[0,0,0,0]"
                                                             style="z-index: 63; white-space: nowrap; font-size: 100px; line-height: 70px; font-weight: 400;font-family:Great Vibes;text-transform:left;z-index:2;text-align:center;position:absolute;margin:0px;white-space:nowrap;letter-spacing:2px;">
                                                            <?php echo get_post_meta($arProject["ID"], 'YEAR')[0]; ?>
                                                        </div>
                                                        <div class="tp-caption   tp-resizeme" id="slide-83-layer-3"
                                                             data-x="1050" data-y="center" data-voffset=""
                                                             data-width="['none','none','none','none']"
                                                             data-height="['none','none','none','none']"
                                                             data-type="image" data-responsive_offset="on"
                                                             data-frames='[{"from":"x:right;","speed":1000,"to":"o:1;","delay":2000,"ease":"Power4.easeOut"},{"delay":2000,"speed":1000,"to":"y:bottom;","ease":"Power4.easeIn"}]'
                                                             data-textAlign="['left','left','left','left']"
                                                             data-paddingtop="[0,0,0,0]" data-paddingright="[0,0,0,0]"
                                                             data-paddingbottom="[0,0,0,0]" data-paddingleft="[0,0,0,0]"
                                                             style="z-index: 64;text-transform:left;z-index:2;text-align:center;">
                                                            <?php
                                                            $randomImage = $arProjectAllImages[rand(0, count($arProjectAllImages) - 1)];
                                                            $imageSizes = getimagesize ( $randomImage );

                                                            $imgHeight = $imageSizes[1];
                                                            $imgWidth = $imageSizes[0];
                                                            $hh = round((648 * $imgHeight) / $imgWidth);
                                                            ?>
                                                            <img
                                                                src="http://wpdemos.themezaa.com/h-code/wp-content/plugins/revslider/admin/assets/images/dummy.png"
                                                                alt="" data-ww="648px" data-hh="<?php echo $hh;?>px" width="648"
                                                                height="<?php echo $hh;?>"
                                                                data-lazyload="<?php echo $randomImage;?>"
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
                                                        e.c = jQuery('#rev_slider_14_1');
                                                        e.gridwidth = [1920];
                                                        e.gridheight = [977];
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
                                                var revapi14;
                                                tpj(document).ready(function () {
                                                    if (tpj("#rev_slider_14_1").revolution == undefined) {
                                                        revslider_showDoubleJqueryError("#rev_slider_14_1");
                                                    } else {
                                                        revapi14 = tpj("#rev_slider_14_1").show().revolution({
                                                            sliderType: "standard",
                                                            jsFileLocation: "//wpdemos.themezaa.com/h-code/wp-content/plugins/revslider/public/assets/js/",
                                                            sliderLayout: "fullscreen",
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
                                                                    style: "hermes",
                                                                    enable: true,
                                                                    hide_onmobile: true,
                                                                    hide_under: 600,
                                                                    hide_onleave: false,
                                                                    tmp: '<div class="tp-arr-allwrapper"> <div class="tp-arr-imgholder"></div> <div class="tp-arr-titleholder">{{title}}</div> </div>',
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
                                                            gridwidth: 1920,
                                                            gridheight: 977,
                                                            lazyType: "single",
                                                            shadow: 0,
                                                            spinner: "spinner0",
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
                                                var htmlDivCss = unescape(".hermes.tparrows%20%7B%0A%09cursor%3Apointer%3B%0A%09background%3Argba%280%2C0%2C0%2C0.5%29%3B%0A%09width%3A30px%3B%0A%09height%3A110px%3B%0A%09position%3Aabsolute%3B%0A%09display%3Ablock%3B%0A%09z-index%3A100%3B%0A%7D%0A%0A.hermes.tparrows%3Abefore%20%7B%0A%09font-family%3A%20%22revicons%22%3B%0A%09font-size%3A15px%3B%0A%09color%3Argb%28255%2C%20255%2C%20255%29%3B%0A%09display%3Ablock%3B%0A%09line-height%3A%20110px%3B%0A%09text-align%3A%20center%3B%0A%20%20%20%20transform%3Atranslatex%280px%29%3B%0A%20%20%20%20-webkit-transform%3Atranslatex%280px%29%3B%0A%20%20%20%20transition%3Aall%200.3s%3B%0A%20%20%20%20-webkit-transition%3Aall%200.3s%3B%0A%7D%0A.hermes.tparrows.tp-leftarrow%3Abefore%20%7B%0A%09content%3A%20%22%5Ce824%22%3B%0A%7D%0A.hermes.tparrows.tp-rightarrow%3Abefore%20%7B%0A%09content%3A%20%22%5Ce825%22%3B%0A%7D%0A.hermes.tparrows.tp-leftarrow%3Ahover%3Abefore%20%7B%0A%20%20%20%20transform%3Atranslatex%28-20px%29%3B%0A%20%20%20%20-webkit-transform%3Atranslatex%28-20px%29%3B%0A%20%20%20%20%20opacity%3A0%3B%0A%7D%0A.hermes.tparrows.tp-rightarrow%3Ahover%3Abefore%20%7B%0A%20%20%20%20transform%3Atranslatex%2820px%29%3B%0A%20%20%20%20-webkit-transform%3Atranslatex%2820px%29%3B%0A%20%20%20%20%20opacity%3A0%3B%0A%7D%0A%0A.hermes%20.tp-arr-allwrapper%20%7B%0A%20%20%20%20overflow%3Ahidden%3B%0A%20%20%20%20position%3Aabsolute%3B%0A%09width%3A180px%3B%0A%20%20%20%20height%3A140px%3B%0A%20%20%20%20top%3A0px%3B%0A%20%20%20%20left%3A0px%3B%0A%20%20%20%20visibility%3Ahidden%3B%0A%20%20%20%20%20%20-webkit-transition%3A%20-webkit-transform%200.3s%200.3s%3B%0A%20%20transition%3A%20transform%200.3s%200.3s%3B%0A%20%20-webkit-perspective%3A%201000px%3B%0A%20%20perspective%3A%201000px%3B%0A%20%20%20%20%7D%0A.hermes.tp-rightarrow%20.tp-arr-allwrapper%20%7B%0A%20%20%20right%3A0px%3Bleft%3Aauto%3B%0A%20%20%20%20%20%20%7D%0A.hermes.tparrows%3Ahover%20.tp-arr-allwrapper%20%7B%0A%20%20%20visibility%3Avisible%3B%0A%20%20%20%20%20%20%20%20%20%20%7D%0A.hermes%20.tp-arr-imgholder%20%7B%0A%20%20width%3A180px%3Bposition%3Aabsolute%3B%0A%20%20left%3A0px%3Btop%3A0px%3Bheight%3A110px%3B%0A%20%20transform%3Atranslatex%28-180px%29%3B%0A%20%20-webkit-transform%3Atranslatex%28-180px%29%3B%0A%20%20transition%3Aall%200.3s%3B%0A%20%20transition-delay%3A0.3s%3B%0A%7D%0A.hermes.tp-rightarrow%20.tp-arr-imgholder%7B%0A%20%20%20%20transform%3Atranslatex%28180px%29%3B%0A%20%20-webkit-transform%3Atranslatex%28180px%29%3B%0A%20%20%20%20%20%20%7D%0A%20%20%0A.hermes.tparrows%3Ahover%20.tp-arr-imgholder%20%7B%0A%20%20%20transform%3Atranslatex%280px%29%3B%0A%20%20%20-webkit-transform%3Atranslatex%280px%29%3B%20%20%20%20%20%20%20%20%20%20%20%20%0A%7D%0A.hermes%20.tp-arr-titleholder%20%7B%0A%20%20top%3A110px%3B%0A%20%20width%3A180px%3B%0A%20%20text-align%3Aleft%3B%20%0A%20%20display%3Ablock%3B%0A%20%20padding%3A0px%2010px%3B%0A%20%20line-height%3A30px%3B%20background%3A%23000%3B%0A%20%20background%3Argba%280%2C0%2C0%2C0.75%29%3B%0A%20%20color%3Argb%28255%2C%20255%2C%20255%29%3B%0A%20%20font-weight%3A600%3B%20position%3Aabsolute%3B%0A%20%20font-size%3A12px%3B%0A%20%20white-space%3Anowrap%3B%0A%20%20letter-spacing%3A1px%3B%0A%20%20-webkit-transition%3A%20all%200.3s%3B%0A%20%20transition%3A%20all%200.3s%3B%0A%20%20-webkit-transform%3A%20rotatex%28-90deg%29%3B%0A%20%20transform%3A%20rotatex%28-90deg%29%3B%0A%20%20-webkit-transform-origin%3A%2050%25%200%3B%0A%20%20transform-origin%3A%2050%25%200%3B%0A%20%20box-sizing%3Aborder-box%3B%0A%0A%7D%0A.hermes.tparrows%3Ahover%20.tp-arr-titleholder%20%7B%0A%20%20%20%20-webkit-transition-delay%3A%200.6s%3B%0A%20%20transition-delay%3A%200.6s%3B%0A%20%20-webkit-transform%3A%20rotatex%280deg%29%3B%0A%20%20transform%3A%20rotatex%280deg%29%3B%0A%7D%0A%0A");
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
include $_SERVER['DOCUMENT_ROOT'] . '/includes/footer_scripts_detail_fashion_intro-v2.php';

include $_SERVER['DOCUMENT_ROOT'] . '/includes/detail_pagination_fashion_intro.php';
?>

</body>
</html>