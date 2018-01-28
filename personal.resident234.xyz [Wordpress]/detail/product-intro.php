<?php
/**
 * Created by PhpStorm.
 * User: GSU
 * Date: 29.07.2017
 * Time: 15:23
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
<body class="page-template-default page page-id-42 wpb-js-composer js-comp-ver-5.1 vc_responsive">
<section class="parent-section no-padding post-42 page type-page status-publish hentry">
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
                                            href="http://fonts.googleapis.com/css?family=Roboto+Condensed:400%2C700%2C300|Roboto:300%2C400"
                                            rel="stylesheet" property="stylesheet" type="text/css" media="all">
                                        <div id="rev_slider_10_1_wrapper"
                                             class="rev_slider_wrapper fullscreen-container" data-source="gallery"
                                             style="background:transparent;padding:0px;">
                                            <div id="rev_slider_10_1" class="rev_slider fullscreenbanner"
                                                 style="display:none;" data-version="5.4.1">
                                                <ul>
                                                    <li data-index="rs-41" data-transition="cube" data-slotamount="1"
                                                        data-hideafterloop="0" data-hideslideonmobile="off"
                                                        data-easein="default" data-easeout="default"
                                                        data-masterspeed="100" data-delay="6500" data-rotate="0"
                                                        data-saveperformance="off" class="no-transition"
                                                        data-title="Slide" data-param1="" data-param2="" data-param3=""
                                                        data-param4="" data-param5="" data-param6="" data-param7=""
                                                        data-param8="" data-param9="" data-param10=""
                                                        data-description="">
                                                        <?php
                                                        $filename = getRandomElement($arProjectImages);
                                                        $new_filen = $_SERVER["DOCUMENT_ROOT"].'/wp-content/uploads/' . basename($filename);


                                                        $fileNew = "/wp-content/uploads/" . basename($filename);

                                                        $fileNew = cropImage($filename,
                                                            $_SERVER['DOCUMENT_ROOT'] . $fileNew,
                                                            1024, 536);
                                                        ?>
                                                        <img
                                                            src="http://wpdemos.themezaa.com/h-code/wp-content/plugins/revslider/admin/assets/images/dummy.png"
                                                            alt="" title="intro-product-bg"
                                                            width="1024" height="536"
                                                            data-lazyload="<?php echo $fileNew; ?>"
                                                            data-bgposition="center bottom" data-bgfit="cover"
                                                            data-bgrepeat="no-repeat" class="rev-slidebg"
                                                            data-no-retina>


                                                        <div class="tp-caption   tp-resizeme  tp-caption lfl ltl"
                                                             id="slide-41-layer-1" data-x="center" data-hoffset="-270"
                                                             data-y="center" data-voffset=""
                                                             data-width="['none','none','none','none']"
                                                             data-height="['none','none','none','none']"
                                                             data-type="image" data-responsive_offset="on"
                                                             data-frames='[{"delay":1500,"speed":1000,"frame":"0","from":"x:left;","to":"o:1;","ease":"Power4.easeOut"},{"delay":"+3000","speed":1000,"frame":"999","to":"x:left;","ease":"Power4.easeIn"}]'
                                                             data-textAlign="['left','left','left','left']"
                                                             data-paddingtop="[0,0,0,0]" data-paddingright="[0,0,0,0]"
                                                             data-paddingbottom="[0,0,0,0]" data-paddingleft="[0,0,0,0]"
                                                             style="z-index: 5;z-index:10;">

                                                            <?php
                                                            $filename = getRandomElement($arProjectImages);
                                                            $new_filen = $_SERVER["DOCUMENT_ROOT"].'/wp-content/uploads/' . basename($filename);


                                                            $fileNew = "/wp-content/uploads/" . basename($filename);

                                                            $fileNew = cropImage($filename,
                                                                $_SERVER['DOCUMENT_ROOT'] . $fileNew,
                                                                1047, 700);
                                                            ?>
                                                            <img
                                                                src="http://wpdemos.themezaa.com/h-code/wp-content/plugins/revslider/admin/assets/images/dummy.png"
                                                                alt="" data-ww="1047px" data-hh="700px"
                                                                width="1047"
                                                                height="700"
                                                                data-lazyload="<?php echo $fileNew; ?>"
                                                                data-no-retina></div>
                                                        <div class="tp-caption   tp-resizeme  tp-caption lfr ltr"
                                                             id="slide-41-layer-2" data-x="center" data-hoffset="530"
                                                             data-y="center" data-voffset=""
                                                             data-width="['none','none','none','none']"
                                                             data-height="['none','none','none','none']"
                                                             data-type="image" data-responsive_offset="on"
                                                             data-frames='[{"delay":2000,"speed":1000,"frame":"0","from":"x:right;","to":"o:1;","ease":"Power4.easeOut"},{"delay":"+2500","speed":1000,"frame":"999","to":"x:right;","ease":"Power4.easeIn"}]'
                                                             data-textAlign="['left','left','left','left']"
                                                             data-paddingtop="[0,0,0,0]" data-paddingright="[0,0,0,0]"
                                                             data-paddingbottom="[0,0,0,0]" data-paddingleft="[0,0,0,0]"
                                                             style="z-index: 6;z-index:8;">
                                                            <?php
                                                            $filename = getRandomElement($arProjectImages);
                                                            $new_filen = $_SERVER["DOCUMENT_ROOT"].'/wp-content/uploads/' . basename($filename);


                                                            $fileNew = "/wp-content/uploads/" . basename($filename);

                                                            $fileNew = cropImage($filename,
                                                                $_SERVER['DOCUMENT_ROOT'] . $fileNew,
                                                                553, 700);
                                                            ?>
                                                            <img
                                                                src="http://wpdemos.themezaa.com/h-code/wp-content/plugins/revslider/admin/assets/images/dummy.png"
                                                                alt="" data-ww="553px" data-hh="700px"
                                                                width="553"
                                                                height="700"
                                                                data-lazyload="<?php echo $fileNew; ?>"
                                                                data-no-retina></div>
                                                        <div class="tp-caption   tp-resizeme  tp-caption fade ltr"
                                                             id="slide-41-layer-3" data-x="center" data-hoffset="530"
                                                             data-y="center" data-voffset=""
                                                             data-width="['none','none','none','none']"
                                                             data-height="['none','none','none','none']"
                                                             data-type="image" data-responsive_offset="on"
                                                             data-frames='[{"delay":2500,"speed":1000,"frame":"0","from":"opacity:0;","to":"o:1;","ease":"Power4.easeOut"},{"delay":"+2000","speed":1000,"frame":"999","to":"x:right;","ease":"Power4.easeIn"}]'
                                                             data-textAlign="['left','left','left','left']"
                                                             data-paddingtop="[0,0,0,0]" data-paddingright="[0,0,0,0]"
                                                             data-paddingbottom="[0,0,0,0]" data-paddingleft="[0,0,0,0]"
                                                             style="z-index: 7;z-index:8;">
                                                            <?php
                                                            $randomImage = getRandomElement($arProjectImages);
                                                            $imageSizes = getimagesize ( $randomImage );

                                                            $imgHeight = $imageSizes[1];
                                                            $imgWidth = $imageSizes[0];
                                                            $hh = round((239 * $imgHeight) / $imgWidth);
                                                            ?>
                                                            <img
                                                                src="http://wpdemos.themezaa.com/h-code/wp-content/plugins/revslider/admin/assets/images/dummy.png"
                                                                alt="" data-ww="239px" data-hh="<?php echo $hh; ?>px" width="239"
                                                                height="<?php echo $hh; ?>"
                                                                data-lazyload="<?php echo $randomImage; ?>"
                                                                data-no-retina></div>
                                                        <div
                                                            class="tp-caption Fashion-BigDisplay   tp-resizeme  tp-caption roboto_condensed_regular_20 fade ltr"
                                                            id="slide-41-layer-4" data-x="center" data-hoffset="530"
                                                            data-y="center" data-voffset="280" data-width="['auto']"
                                                            data-height="['auto']" data-type="text"
                                                            data-responsive_offset="on"
                                                            data-frames='[{"delay":3000,"speed":1000,"frame":"0","from":"opacity:0;","to":"o:1;","ease":"Power4.easeOut"},{"delay":"+1500","speed":1000,"frame":"999","to":"x:right;","ease":"Power4.easeIn"}]'
                                                            data-textAlign="['center','center','center','center']"
                                                            data-paddingtop="[0,0,0,0]" data-paddingright="[0,0,0,0]"
                                                            data-paddingbottom="[0,0,0,0]" data-paddingleft="[0,0,0,0]"
                                                            style="z-index: 8; white-space: nowrap; font-size: 20px; line-height: 26px; font-weight: 400; color: rgba(255,255,255,1); letter-spacing: px;font-family:Roboto Condensed;z-index:10;text-align:center;position:absolute;margin:0px;white-space:nowrap;letter-spacing:normal;">
                                                            <?php echo $arProject["post_title"];?>
                                                        </div>
                                                    </li>
                                                    <li data-index="rs-42" data-transition="cube" data-slotamount="2"
                                                        data-hideafterloop="0" data-hideslideonmobile="off"
                                                        data-easein="default" data-easeout="default"
                                                        data-masterspeed="100" data-delay="8500" data-rotate="0"
                                                        data-saveperformance="off" class="no-transition"
                                                        data-title="Slide" data-param1="" data-param2="" data-param3=""
                                                        data-param4="" data-param5="" data-param6="" data-param7=""
                                                        data-param8="" data-param9="" data-param10=""
                                                        data-description="">
                                                        <?php
                                                        $filename = getRandomElement($arProjectImages);
                                                        $new_filen = $_SERVER["DOCUMENT_ROOT"].'/wp-content/uploads/' . basename($filename);


                                                        $fileNew = "/wp-content/uploads/" . basename($filename);

                                                        $fileNew = cropImage($filename,
                                                            $_SERVER['DOCUMENT_ROOT'] . $fileNew,
                                                            2100, 1100);
                                                        ?>
                                                        <img
                                                            src="http://wpdemos.themezaa.com/h-code/wp-content/plugins/revslider/admin/assets/images/dummy.png"
                                                            alt="" title="intro-product-bg" width="2100"
                                                            height="1100"
                                                            data-lazyload="<?php echo $fileNew; ?>"
                                                            data-bgposition="center bottom" data-bgfit="cover"
                                                            data-bgrepeat="no-repeat" class="rev-slidebg"
                                                            data-no-retina>
                                                        <div class="tp-caption   tp-resizeme  tp-caption lfl ltl"
                                                             id="slide-42-layer-1" data-x="center" data-hoffset="-270"
                                                             data-y="center" data-voffset=""
                                                             data-width="['none','none','none','none']"
                                                             data-height="['none','none','none','none']"
                                                             data-type="image" data-responsive_offset="on"
                                                             data-frames='[{"delay":1500,"speed":600,"frame":"0","from":"x:left;","to":"o:1;","ease":"Power4.easeOut"},{"delay":"+5400","speed":1000,"frame":"999","to":"x:left;","ease":"Power4.easeIn"}]'
                                                             data-textAlign="['left','left','left','left']"
                                                             data-paddingtop="[0,0,0,0]" data-paddingright="[0,0,0,0]"
                                                             data-paddingbottom="[0,0,0,0]" data-paddingleft="[0,0,0,0]"
                                                             style="z-index: 5;z-index:10;">
                                                            <?php
                                                            $filename = getRandomElement($arProjectImages);
                                                            $new_filen = $_SERVER["DOCUMENT_ROOT"].'/wp-content/uploads/' . basename($filename);


                                                            $fileNew = "/wp-content/uploads/" . basename($filename);

                                                            $fileNew = cropImage($filename,
                                                                $_SERVER['DOCUMENT_ROOT'] . $fileNew,
                                                                1047, 700);
                                                            ?>
                                                            <img
                                                                src="http://wpdemos.themezaa.com/h-code/wp-content/plugins/revslider/admin/assets/images/dummy.png"
                                                                alt="" data-ww="1047px" data-hh="700px"
                                                                width="1047"
                                                                height="700"
                                                                data-lazyload="<?php echo $fileNew; ?>"
                                                                data-no-retina></div>
                                                        <div class="tp-caption   tp-resizeme  tp-caption lfr ltr"
                                                             id="slide-42-layer-2" data-x="center" data-hoffset="530"
                                                             data-y="center" data-voffset="-196"
                                                             data-width="['none','none','none','none']"
                                                             data-height="['none','none','none','none']"
                                                             data-type="image" data-responsive_offset="on"
                                                             data-frames='[{"delay":2000,"speed":600,"frame":"0","from":"x:right;","to":"o:1;","ease":"Power4.easeOut"},{"delay":"+4900","speed":1000,"frame":"999","to":"x:right;","ease":"Power4.easeIn"}]'
                                                             data-textAlign="['left','left','left','left']"
                                                             data-paddingtop="[0,0,0,0]" data-paddingright="[0,0,0,0]"
                                                             data-paddingbottom="[0,0,0,0]" data-paddingleft="[0,0,0,0]"
                                                             style="z-index: 6;z-index:8;">
                                                            <?php
                                                            $filename = getRandomElement($arProjectImages);
                                                            $new_filen = $_SERVER["DOCUMENT_ROOT"].'/wp-content/uploads/' . basename($filename);


                                                            $fileNew = "/wp-content/uploads/" . basename($filename);

                                                            $fileNew = cropImage($filename,
                                                                $_SERVER['DOCUMENT_ROOT'] . $fileNew,
                                                                553, 308);
                                                            ?>
                                                            <img
                                                                src="http://wpdemos.themezaa.com/h-code/wp-content/plugins/revslider/admin/assets/images/dummy.png"
                                                                alt="" data-ww="553px" data-hh="308px"
                                                                width="553"
                                                                height="308"
                                                                data-lazyload="<?php echo $fileNew; ?>"
                                                                data-no-retina></div>
                                                        <div
                                                            class="tp-caption Fashion-BigDisplay   tp-resizeme  tp-caption roboto_condensed_blod_40 fade ltr"
                                                            id="slide-42-layer-3" data-x="center" data-hoffset="420"
                                                            data-y="center" data-voffset="-196" data-width="['auto']"
                                                            data-height="['auto']" data-type="text"
                                                            data-responsive_offset="on"
                                                            data-frames='[{"delay":2500,"speed":600,"frame":"0","from":"opacity:0;","to":"o:1;","ease":"Power4.easeOut"},{"delay":"+4400","speed":1000,"frame":"999","to":"x:right;","ease":"Power4.easeIn"}]'
                                                            data-textAlign="['center','center','center','center']"
                                                            data-paddingtop="[0,0,0,0]" data-paddingright="[0,0,0,0]"
                                                            data-paddingbottom="[0,0,0,0]" data-paddingleft="[0,0,0,0]"
                                                            style="z-index: 7; white-space: nowrap; font-size: 40px; line-height: 48px; font-weight: 700; color: rgba(255,255,255,1); letter-spacing: px;font-family:Roboto Condensed;text-transform:uppercase;z-index:10;position:absolute;margin:0px;white-space:nowrap;letter-spacing:-2px;">
                                                            <?php echo implode("  ", $arPostTagsNames); ?>
                                                        </div>
                                                        <div
                                                            class="tp-caption Fashion-BigDisplay   tp-resizeme  tp-caption roboto_condensed_regular_16 fade ltr"
                                                            id="slide-42-layer-4" data-x="center" data-hoffset="670"
                                                            data-y="center" data-voffset="-196" data-width="['auto']"
                                                            data-height="['auto']" data-type="text"
                                                            data-responsive_offset="on"
                                                            data-frames='[{"delay":3500,"speed":600,"frame":"0","from":"opacity:0;","to":"o:1;","ease":"Power4.easeOut"},{"delay":"+3400","speed":1000,"frame":"999","to":"x:right;","ease":"Power4.easeIn"}]'
                                                            data-textAlign="['center','center','center','center']"
                                                            data-paddingtop="[0,0,0,0]" data-paddingright="[0,0,0,0]"
                                                            data-paddingbottom="[0,0,0,0]" data-paddingleft="[0,0,0,0]"
                                                            style="z-index: 8; white-space: nowrap; font-size: 16px; line-height: 22px; font-weight: 400; color: rgba(255,255,255,1); letter-spacing: px;font-family:Roboto Condensed;text-transform:uppercase;z-index:10;position:absolute;margin:0px;white-space:nowrap;letter-spacing:normal;">
                                                            <?php echo $arProject["post_content_formatted"];?>
                                                        </div>
                                                        <div class="tp-caption   tp-resizeme  tp-caption lfr ltr"
                                                             id="slide-42-layer-5" data-x="center" data-hoffset="530"
                                                             data-y="center" data-voffset="154"
                                                             data-width="['none','none','none','none']"
                                                             data-height="['none','none','none','none']"
                                                             data-type="image" data-responsive_offset="on"
                                                             data-frames='[{"delay":3500,"speed":600,"frame":"0","from":"x:right;","to":"o:1;","ease":"Power4.easeOut"},{"delay":"+3800","speed":600,"frame":"999","to":"x:right;","ease":"Power4.easeIn"}]'
                                                             data-textAlign="['left','left','left','left']"
                                                             data-paddingtop="[0,0,0,0]" data-paddingright="[0,0,0,0]"
                                                             data-paddingbottom="[0,0,0,0]" data-paddingleft="[0,0,0,0]"
                                                             style="z-index: 9;">

                                                            <?php
                                                            $filename = getRandomElement($arProjectImages);
                                                            $new_filen = $_SERVER["DOCUMENT_ROOT"].'/wp-content/uploads/' . basename($filename);


                                                            $fileNew = "/wp-content/uploads/" . basename($filename);

                                                            $fileNew = cropImage($filename,
                                                                $_SERVER['DOCUMENT_ROOT'] . $fileNew,
                                                                553, 392);
                                                            ?>
                                                            <img
                                                                src="http://wpdemos.themezaa.com/h-code/wp-content/plugins/revslider/admin/assets/images/dummy.png"
                                                                alt="" data-ww="553px" data-hh="392px" width="553"
                                                                height="392"
                                                                data-lazyload="<?php echo $fileNew; ?>"
                                                                data-no-retina></div>
                                                        <div class="tp-caption   tp-resizeme  tp-caption sfl ltr"
                                                             id="slide-42-layer-6" data-x="center" data-hoffset="354"
                                                             data-y="center" data-voffset="154"
                                                             data-width="['none','none','none','none']"
                                                             data-height="['none','none','none','none']"
                                                             data-type="image" data-responsive_offset="on"
                                                             data-frames='[{"delay":4000,"speed":600,"frame":"0","from":"x:-50px;opacity:0;","to":"o:1;","ease":"Power4.easeOut"},{"delay":"+3300","speed":600,"frame":"999","to":"x:right;","ease":"Power4.easeIn"}]'
                                                             data-textAlign="['left','left','left','left']"
                                                             data-paddingtop="[0,0,0,0]" data-paddingright="[0,0,0,0]"
                                                             data-paddingbottom="[0,0,0,0]" data-paddingleft="[0,0,0,0]"
                                                             style="z-index: 10;z-index:14;">

                                                            <?php
                                                            $randomImage = getRandomElement($arProjectImages);
                                                            $imageSizes = getimagesize ( $randomImage );

                                                            $imgHeight = $imageSizes[1];
                                                            $imgWidth = $imageSizes[0];
                                                            $hh = round((201 * $imgHeight) / $imgWidth);
                                                            ?>
                                                            <img
                                                                src="http://wpdemos.themezaa.com/h-code/wp-content/plugins/revslider/admin/assets/images/dummy.png"
                                                                alt="" data-ww="201px" data-hh="<?php echo $hh; ?>px" width="201"
                                                                height="<?php echo $hh; ?>"
                                                                data-lazyload="<?php echo $fileNew; ?>"
                                                                data-no-retina></div>
                                                        <div class="tp-caption   tp-resizeme  tp-caption sfl ltr"
                                                             id="slide-42-layer-7" data-x="center" data-hoffset="528"
                                                             data-y="center" data-voffset="154"
                                                             data-width="['none','none','none','none']"
                                                             data-height="['none','none','none','none']"
                                                             data-type="image" data-responsive_offset="on"
                                                             data-frames='[{"delay":4500,"speed":600,"frame":"0","from":"x:-50px;opacity:0;","to":"o:1;","ease":"Power4.easeOut"},{"delay":"+2800","speed":600,"frame":"999","to":"x:right;","ease":"Power4.easeIn"}]'
                                                             data-textAlign="['left','left','left','left']"
                                                             data-paddingtop="[0,0,0,0]" data-paddingright="[0,0,0,0]"
                                                             data-paddingbottom="[0,0,0,0]" data-paddingleft="[0,0,0,0]"
                                                             style="z-index: 11;z-index:15;">
                                                            <?php
                                                            $randomImage = getRandomElement($arProjectImages);
                                                            $imageSizes = getimagesize ( $randomImage );

                                                            $imgHeight = $imageSizes[1];
                                                            $imgWidth = $imageSizes[0];
                                                            $hh = round((198 * $imgHeight) / $imgWidth);
                                                            ?>
                                                            <img
                                                                src="http://wpdemos.themezaa.com/h-code/wp-content/plugins/revslider/admin/assets/images/dummy.png"
                                                                alt="" data-ww="198px" data-hh="<?php echo $hh; ?>px" width="198"
                                                                height="<?php echo $hh; ?>"
                                                                data-lazyload="<?php echo $fileNew; ?>"
                                                                data-no-retina></div>
                                                        <div class="tp-caption   tp-resizeme  tp-caption sfl ltr"
                                                             id="slide-42-layer-8" data-x="center" data-hoffset="715"
                                                             data-y="center" data-voffset="154"
                                                             data-width="['none','none','none','none']"
                                                             data-height="['none','none','none','none']"
                                                             data-type="image" data-responsive_offset="on"
                                                             data-frames='[{"delay":5000,"speed":600,"frame":"0","from":"x:-50px;opacity:0;","to":"o:1;","ease":"Power4.easeOut"},{"delay":"+2300","speed":600,"frame":"999","to":"x:right;","ease":"Power4.easeIn"}]'
                                                             data-textAlign="['left','left','left','left']"
                                                             data-paddingtop="[0,0,0,0]" data-paddingright="[0,0,0,0]"
                                                             data-paddingbottom="[0,0,0,0]" data-paddingleft="[0,0,0,0]"
                                                             style="z-index: 12;z-index:11;">
                                                            <?php
                                                            $randomImage = getRandomElement($arProjectImages);
                                                            $imageSizes = getimagesize ( $randomImage );

                                                            $imgHeight = $imageSizes[1];
                                                            $imgWidth = $imageSizes[0];
                                                            $hh = round((177 * $imgHeight) / $imgWidth);
                                                            ?>
                                                            <img
                                                                src="http://wpdemos.themezaa.com/h-code/wp-content/plugins/revslider/admin/assets/images/dummy.png"
                                                                alt="" data-ww="177px" data-hh="<?php echo $hh; ?>px" width="177"
                                                                height="<?php echo $hh; ?>"
                                                                data-lazyload="<?php echo $fileNew; ?>"
                                                                data-no-retina></div>
                                                    </li>
                                                    <li data-index="rs-43" data-transition="cube" data-slotamount="3"
                                                        data-hideafterloop="0" data-hideslideonmobile="off"
                                                        data-easein="default" data-easeout="default"
                                                        data-masterspeed="500" data-delay="8500" data-rotate="0"
                                                        data-saveperformance="off" class="no-transition"
                                                        data-title="Slide" data-param1="" data-param2="" data-param3=""
                                                        data-param4="" data-param5="" data-param6="" data-param7=""
                                                        data-param8="" data-param9="" data-param10=""
                                                        data-description="">

                                                        <?php
                                                        $filename = getRandomElement($arProjectImages);
                                                        $new_filen = $_SERVER["DOCUMENT_ROOT"].'/wp-content/uploads/' . basename($filename);


                                                        $fileNew = "/wp-content/uploads/" . basename($filename);

                                                        $fileNew = cropImage($filename,
                                                            $_SERVER['DOCUMENT_ROOT'] . $fileNew,
                                                            2100, 1100);
                                                        ?>
                                                        <img
                                                            src="http://wpdemos.themezaa.com/h-code/wp-content/plugins/revslider/admin/assets/images/dummy.png"
                                                            alt="" title="intro-product-bg"
                                                            width="2100" height="1100"
                                                            data-lazyload="<?php echo $fileNew; ?>"
                                                            data-bgposition="center bottom" data-bgfit="cover"
                                                            data-bgrepeat="no-repeat" class="rev-slidebg"
                                                            data-no-retina>
                                                        <div class="tp-caption   tp-resizeme  tp-caption lfl ltl"
                                                             id="slide-43-layer-1" data-x="center" data-hoffset="-535"
                                                             data-y="center" data-voffset=""
                                                             data-width="['none','none','none','none']"
                                                             data-height="['none','none','none','none']"
                                                             data-type="image" data-responsive_offset="on"
                                                             data-frames='[{"from":"x:left;","speed":600,"to":"o:1;","delay":1500,"ease":"Power4.easeOut"},{"delay":5400,"speed":1000,"to":"x:left;","ease":"Power4.easeIn"}]'
                                                             data-textAlign="['left','left','left','left']"
                                                             data-paddingtop="[0,0,0,0]" data-paddingright="[0,0,0,0]"
                                                             data-paddingbottom="[0,0,0,0]" data-paddingleft="[0,0,0,0]"
                                                             style="z-index: 17;text-transform:left;z-index:10;">
                                                            <?php
                                                            $filename = getRandomElement($arProjectImages);
                                                            $new_filen = $_SERVER["DOCUMENT_ROOT"].'/wp-content/uploads/' . basename($filename);


                                                            $fileNew = "/wp-content/uploads/" . basename($filename);

                                                            $fileNew = cropImage($filename,
                                                                $_SERVER['DOCUMENT_ROOT'] . $fileNew,
                                                                520, 700);
                                                            ?>
                                                            <img
                                                                src="http://wpdemos.themezaa.com/h-code/wp-content/plugins/revslider/admin/assets/images/dummy.png"
                                                                alt="" data-ww="520px" data-hh="700px"
                                                                width="520"
                                                                height="700"
                                                                data-lazyload="<?php echo $fileNew; ?>"
                                                                data-no-retina></div>
                                                        <div class="tp-caption   tp-resizeme  tp-caption lfr ltr"
                                                             id="slide-43-layer-2" data-x="center" data-hoffset="546"
                                                             data-y="center" data-voffset=""
                                                             data-width="['none','none','none','none']"
                                                             data-height="['none','none','none','none']"
                                                             data-type="image" data-responsive_offset="on"
                                                             data-frames='[{"from":"x:right;","speed":600,"to":"o:1;","delay":2000,"ease":"Power4.easeOut"},{"delay":4900,"speed":1000,"to":"x:right;","ease":"Power4.easeIn"}]'
                                                             data-textAlign="['left','left','left','left']"
                                                             data-paddingtop="[0,0,0,0]" data-paddingright="[0,0,0,0]"
                                                             data-paddingbottom="[0,0,0,0]" data-paddingleft="[0,0,0,0]"
                                                             style="z-index: 18;text-transform:left;z-index:8;">
                                                            <?php
                                                            $filename = getRandomElement($arProjectImages);
                                                            $new_filen = $_SERVER["DOCUMENT_ROOT"].'/wp-content/uploads/' . basename($filename);


                                                            $fileNew = "/wp-content/uploads/" . basename($filename);

                                                            $fileNew = cropImage($filename,
                                                                $_SERVER['DOCUMENT_ROOT'] . $fileNew,
                                                                520, 700);
                                                            ?>
                                                            <img
                                                                src="http://wpdemos.themezaa.com/h-code/wp-content/plugins/revslider/admin/assets/images/dummy.png"
                                                                alt="" data-ww="520px" data-hh="700px"
                                                                width="520"
                                                                height="700"
                                                                data-lazyload="<?php echo $fileNew; ?>"
                                                                data-no-retina></div>
                                                        <div class="tp-caption   tp-resizeme  tp-caption sft stt"
                                                             id="slide-43-layer-3" data-x="center" data-hoffset="6"
                                                             data-y="center" data-voffset="154"
                                                             data-width="['none','none','none','none']"
                                                             data-height="['none','none','none','none']"
                                                             data-type="image" data-responsive_offset="on"
                                                             data-frames='[{"from":"y:-50px;opacity:0;","speed":600,"to":"o:1;","delay":3000,"ease":"Power4.easeOut"},{"delay":4200,"speed":1000,"to":"y:-50px;opacity:0;","ease":"Power4.easeIn"}]'
                                                             data-textAlign="['left','left','left','left']"
                                                             data-paddingtop="[0,0,0,0]" data-paddingright="[0,0,0,0]"
                                                             data-paddingbottom="[0,0,0,0]" data-paddingleft="[0,0,0,0]"
                                                             style="z-index: 19;text-transform:left;z-index:8;">
                                                            <?php
                                                            $filename = getRandomElement($arProjectImages);
                                                            $new_filen = $_SERVER["DOCUMENT_ROOT"].'/wp-content/uploads/' . basename($filename);


                                                            $fileNew = "/wp-content/uploads/" . basename($filename);

                                                            $fileNew = cropImage($filename,
                                                                $_SERVER['DOCUMENT_ROOT'] . $fileNew,
                                                                545, 392);
                                                            ?>
                                                            <img
                                                                src="http://wpdemos.themezaa.com/h-code/wp-content/plugins/revslider/admin/assets/images/dummy.png"
                                                                alt="" data-ww="545px" data-hh="392px" 
                                                                width="545"
                                                                height="392"
                                                                data-lazyload="<?php echo $fileNew; ?>"
                                                                data-no-retina></div>
                                                        <div class="tp-caption   tp-resizeme  tp-caption sfb stb"
                                                             id="slide-43-layer-4" data-x="center" data-hoffset="6"
                                                             data-y="center" data-voffset="-200"
                                                             data-width="['none','none','none','none']"
                                                             data-height="['none','none','none','none']"
                                                             data-type="image" data-responsive_offset="on"
                                                             data-frames='[{"from":"y:50px;opacity:0;","speed":600,"to":"o:1;","delay":3000,"ease":"Power4.easeOut"},{"delay":3900,"speed":1000,"to":"y:50px;opacity:0;","ease":"Power4.easeIn"}]'
                                                             data-textAlign="['left','left','left','left']"
                                                             data-paddingtop="[0,0,0,0]" data-paddingright="[0,0,0,0]"
                                                             data-paddingbottom="[0,0,0,0]" data-paddingleft="[0,0,0,0]"
                                                             style="z-index: 20;text-transform:left;z-index:8;">
                                                            <?php
                                                            $filename = getRandomElement($arProjectImages);
                                                            $new_filen = $_SERVER["DOCUMENT_ROOT"].'/wp-content/uploads/' . basename($filename);


                                                            $fileNew = "/wp-content/uploads/" . basename($filename);

                                                            $fileNew = cropImage($filename,
                                                                $_SERVER['DOCUMENT_ROOT'] . $fileNew,
                                                                545, 300);
                                                            ?>
                                                            <img
                                                                src="http://wpdemos.themezaa.com/h-code/wp-content/plugins/revslider/admin/assets/images/dummy.png"
                                                                alt="" data-ww="545px" data-hh="300px"
                                                                width="545"
                                                                height="300"
                                                                data-lazyload="<?php echo $fileNew; ?>"
                                                                data-no-retina></div>
                                                        <div class="tp-caption   tp-resizeme  tp-caption fade stb"
                                                             id="slide-43-layer-5" data-x="center" data-hoffset="6"
                                                             data-y="center" data-voffset="-200"
                                                             data-width="['none','none','none','none']"
                                                             data-height="['none','none','none','none']"
                                                             data-type="image" data-responsive_offset="on"
                                                             data-frames='[{"from":"opacity:0;","speed":600,"to":"o:1;","delay":4000,"ease":"Power4.easeOut"},{"delay":2900,"speed":1000,"to":"y:50px;opacity:0;","ease":"Power4.easeIn"}]'
                                                             data-textAlign="['left','left','left','left']"
                                                             data-paddingtop="[0,0,0,0]" data-paddingright="[0,0,0,0]"
                                                             data-paddingbottom="[0,0,0,0]" data-paddingleft="[0,0,0,0]"
                                                             style="z-index: 21;text-transform:left;z-index:8;">

                                                            <?php
                                                            $filename = getRandomElement($arProjectImages);
                                                            $new_filen = $_SERVER["DOCUMENT_ROOT"].'/wp-content/uploads/' . basename($filename);


                                                            $fileNew = "/wp-content/uploads/" . basename($filename);

                                                            $fileNew = cropImage($filename,
                                                                $_SERVER['DOCUMENT_ROOT'] . $fileNew,
                                                                545, 300);
                                                            ?>
                                                            <img
                                                                src="http://wpdemos.themezaa.com/h-code/wp-content/plugins/revslider/admin/assets/images/dummy.png"
                                                                alt="" data-ww="545px" data-hh="300px" width="545"
                                                                height="300"
                                                                data-lazyload="<?php echo $fileNew; ?>"
                                                                data-no-retina></div>
                                                    </li>
                                                    <li data-index="rs-44" data-transition="cube" data-slotamount="4"
                                                        data-hideafterloop="0" data-hideslideonmobile="off"
                                                        data-easein="default" data-easeout="default"
                                                        data-masterspeed="500" data-delay="14000" data-rotate="0"
                                                        data-saveperformance="off" class="no-transition"
                                                        data-title="Slide" data-param1="" data-param2="" data-param3=""
                                                        data-param4="" data-param5="" data-param6="" data-param7=""
                                                        data-param8="" data-param9="" data-param10=""
                                                        data-description="">

                                                        <?php
                                                        $filename = getRandomElement($arProjectImages);
                                                        $new_filen = $_SERVER["DOCUMENT_ROOT"].'/wp-content/uploads/' . basename($filename);


                                                        $fileNew = "/wp-content/uploads/" . basename($filename);

                                                        $fileNew = cropImage($filename,
                                                            $_SERVER['DOCUMENT_ROOT'] . $fileNew,
                                                            2100, 1100);
                                                        ?>
                                                        <img
                                                            src="http://wpdemos.themezaa.com/h-code/wp-content/plugins/revslider/admin/assets/images/dummy.png"
                                                            alt="" title="intro-product-bg"
                                                            width="2100" height="1100"
                                                            data-lazyload="<?php echo $fileNew; ?>"
                                                            data-bgposition="center bottom" data-bgfit="cover"
                                                            data-bgrepeat="no-repeat" class="rev-slidebg"
                                                            data-no-retina>
                                                        <div class="tp-caption   tp-resizeme  tp-caption lfl ltl"
                                                             id="slide-44-layer-1" data-x="center" data-hoffset="6"
                                                             data-y="center" data-voffset=""
                                                             data-width="['none','none','none','none']"
                                                             data-height="['none','none','none','none']"
                                                             data-type="image" data-responsive_offset="on"
                                                             data-frames='[{"delay":1500,"speed":600,"frame":"0","from":"x:left;","to":"o:1;","ease":"Power4.easeOut"},{"delay":"+10900","speed":1000,"frame":"999","to":"x:left;","ease":"Power4.easeIn"}]'
                                                             data-textAlign="['left','left','left','left']"
                                                             data-paddingtop="[0,0,0,0]" data-paddingright="[0,0,0,0]"
                                                             data-paddingbottom="[0,0,0,0]" data-paddingleft="[0,0,0,0]"
                                                             style="z-index: 5;z-index:1;">
                                                            <?php
                                                            $filename = getRandomElement($arProjectImages);
                                                            $new_filen = $_SERVER["DOCUMENT_ROOT"].'/wp-content/uploads/' . basename($filename);


                                                            $fileNew = "/wp-content/uploads/" . basename($filename);

                                                            $fileNew = cropImage($filename,
                                                                $_SERVER['DOCUMENT_ROOT'] . $fileNew,
                                                                1600, 700);
                                                            ?>
                                                            <img
                                                                src="http://wpdemos.themezaa.com/h-code/wp-content/plugins/revslider/admin/assets/images/dummy.png"
                                                                alt="" data-ww="1600px" data-hh="700px"
                                                                width="1600"
                                                                height="700"
                                                                data-lazyload="<?php echo $fileNew; ?>"
                                                                data-no-retina></div>
                                                        <div class="tp-caption   tp-resizeme  tp-caption lfr ltr"
                                                             id="slide-44-layer-2" data-x="center" data-hoffset="552"
                                                             data-y="center" data-voffset=""
                                                             data-width="['none','none','none','none']"
                                                             data-height="['none','none','none','none']"
                                                             data-type="image" data-responsive_offset="on"
                                                             data-frames='[{"delay":2000,"speed":300,"frame":"0","from":"x:right;","to":"o:1;","ease":"Power4.easeOut"},{"delay":"+11400","speed":300,"frame":"999","to":"x:right;","ease":"Power4.easeIn"}]'
                                                             data-textAlign="['left','left','left','left']"
                                                             data-paddingtop="[0,0,0,0]" data-paddingright="[0,0,0,0]"
                                                             data-paddingbottom="[0,0,0,0]" data-paddingleft="[0,0,0,0]"
                                                             style="z-index: 6;z-index:2;">
                                                            <?php
                                                            $filename = getRandomElement($arProjectImages);
                                                            $new_filen = $_SERVER["DOCUMENT_ROOT"].'/wp-content/uploads/' . basename($filename);


                                                            $fileNew = "/wp-content/uploads/" . basename($filename);

                                                            $fileNew = cropImage($filename,
                                                                $_SERVER['DOCUMENT_ROOT'] . $fileNew,
                                                                447, 640);
                                                            ?>
                                                            <img
                                                                src="http://wpdemos.themezaa.com/h-code/wp-content/plugins/revslider/admin/assets/images/dummy.png"
                                                                alt="" data-ww="447px" data-hh="640px"
                                                                width="447"
                                                                height="640"
                                                                data-lazyload="<?php echo $fileNew; ?>"
                                                                data-no-retina></div>
                                                        <div
                                                            class="tp-caption Fashion-BigDisplay   tp-resizeme  tp-caption roboto_condensed_blod_60 fade ltr"
                                                            id="slide-44-layer-3" data-x="center" data-hoffset="487"
                                                            data-y="center" data-voffset="-219" data-width="['auto']"
                                                            data-height="['auto']" data-type="text"
                                                            data-responsive_offset="on"
                                                            data-frames='[{"delay":2500,"speed":600,"frame":"0","from":"opacity:0;","to":"o:1;","ease":"Power4.easeOut"},{"delay":"+9900","speed":1000,"frame":"999","to":"x:right;","ease":"Power4.easeIn"}]'
                                                            data-textAlign="['left','left','left','left']"
                                                            data-paddingtop="[0,0,0,0]" data-paddingright="[0,0,0,0]"
                                                            data-paddingbottom="[0,0,0,0]" data-paddingleft="[0,0,0,0]"
                                                            style="z-index: 7; white-space: nowrap; font-weight: 700; color: rgba(255,255,255,1); letter-spacing: ;font-family:Roboto Condensed;text-transform:uppercase;z-index:10;position:absolute;margin:0px;white-space:nowrap;letter-spacing:-3px;">
                                                            <?php echo $ProjectCLIENT; ?>
                                                        </div>
                                                        <div
                                                            class="tp-caption Fashion-BigDisplay   tp-resizeme  tp-caption roboto_condensed_Light_22 sfb stb"
                                                            id="slide-44-layer-4" data-x="center" data-hoffset="555"
                                                            data-y="center" data-voffset="-125" data-width="['auto']"
                                                            data-height="['auto']" data-type="text"
                                                            data-responsive_offset="on"
                                                            data-frames='[{"delay":3000,"speed":600,"frame":"0","from":"y:50px;opacity:0;","to":"o:1;","ease":"Power4.easeOut"},{"delay":"+9400","speed":1000,"frame":"999","to":"y:50px;opacity:0;","ease":"Power4.easeIn"}]'
                                                            data-textAlign="['left','left','left','left']"
                                                            data-paddingtop="[0,0,0,0]" data-paddingright="[0,0,0,0]"
                                                            data-paddingbottom="[0,0,0,0]" data-paddingleft="[0,0,0,0]"
                                                            style="z-index: 8; white-space: nowrap; font-size: 22px; font-weight: 300; color: rgba(255,255,255,1); letter-spacing: ;font-family:Roboto Condensed;z-index:10;position:absolute;margin:0px;white-space:nowrap;letter-spacing:normal;font-weight:100;">
                                                            <?php echo $ProjectTYPE; ?>
                                                        </div>
                                                        <div class="tp-caption   tp-resizeme  tp-caption sfb stb"
                                                             id="slide-44-layer-5" data-x="center" data-hoffset="540"
                                                             data-y="center" data-voffset=""
                                                             data-width="['none','none','none','none']"
                                                             data-height="['none','none','none','none']"
                                                             data-type="image" data-responsive_offset="on"
                                                             data-frames='[{"delay":3500,"speed":600,"frame":"0","from":"y:50px;opacity:0;","to":"o:1;","ease":"Power4.easeOut"},{"delay":"+1900","speed":500,"frame":"999","to":"y:50px;opacity:0;","ease":"Power4.easeIn"}]'
                                                             data-textAlign="['left','left','left','left']"
                                                             data-paddingtop="[0,0,0,0]" data-paddingright="[0,0,0,0]"
                                                             data-paddingbottom="[0,0,0,0]" data-paddingleft="[0,0,0,0]"
                                                             style="z-index: 9;z-index:2;">
                                                            <?php
                                                            $filename = getRandomElement($arProjectImages);
                                                            $new_filen = $_SERVER["DOCUMENT_ROOT"].'/wp-content/uploads/' . basename($filename);


                                                            $fileNew = "/wp-content/uploads/" . basename($filename);

                                                            $fileNew = cropImage($filename,
                                                                $_SERVER['DOCUMENT_ROOT'] . $fileNew,
                                                                361, 165);
                                                            ?>
                                                            <img
                                                                src="http://wpdemos.themezaa.com/h-code/wp-content/plugins/revslider/admin/assets/images/dummy.png"
                                                                alt="" data-ww="361px" data-hh="165px"
                                                                width="361"
                                                                height="165"
                                                                data-lazyload="<?php echo $fileNew; ?>"
                                                                data-no-retina></div>
                                                        <div
                                                            class="tp-caption Fashion-BigDisplay   tp-resizeme  tp-caption roboto_regular_15 sfb stb"
                                                            id="slide-44-layer-6" data-x="center" data-hoffset="530"
                                                            data-y="center" data-voffset="130" data-width="['auto']"
                                                            data-height="['auto']" data-type="text"
                                                            data-responsive_offset="on"
                                                            data-frames='[{"delay":4000,"speed":600,"frame":"0","from":"y:50px;opacity:0;","to":"o:1;","ease":"Power4.easeOut"},{"delay":"+1400","speed":500,"frame":"999","to":"y:50px;opacity:0;","ease":"Power4.easeIn"}]'
                                                            data-textAlign="['left','left','left','left']"
                                                            data-paddingtop="[0,0,0,0]" data-paddingright="[0,0,0,0]"
                                                            data-paddingbottom="[0,0,0,0]" data-paddingleft="[0,0,0,0]"
                                                            style="z-index: 10; white-space: nowrap; font-size: 15px; line-height: 20px; font-weight: 300; color: rgba(255,255,255,1); letter-spacing: ;font-family:Roboto;z-index:10;position:absolute;margin:0px;white-space:nowrap;letter-spacing:normal;">
                                                            <strong><?php echo $YEAR; ?></strong>
                                                        </div>
                                                        <div class="tp-caption   tp-resizeme  tp-caption sfb stb"
                                                             id="slide-44-layer-7" data-x="center" data-hoffset="541"
                                                             data-y="center" data-voffset=""
                                                             data-width="['none','none','none','none']"
                                                             data-height="['none','none','none','none']"
                                                             data-type="image" data-responsive_offset="on"
                                                             data-frames='[{"delay":7000,"speed":600,"frame":"0","from":"y:50px;opacity:0;","to":"o:1;","ease":"Power4.easeOut"},{"delay":"+1400","speed":1000,"frame":"999","to":"y:50px;opacity:0;","ease":"Power4.easeIn"}]'
                                                             data-textAlign="['left','left','left','left']"
                                                             data-paddingtop="[0,0,0,0]" data-paddingright="[0,0,0,0]"
                                                             data-paddingbottom="[0,0,0,0]" data-paddingleft="[0,0,0,0]"
                                                             style="z-index: 11;">
                                                            <?php
                                                            $filename = getRandomElement($arProjectImages);
                                                            $new_filen = $_SERVER["DOCUMENT_ROOT"].'/wp-content/uploads/' . basename($filename);


                                                            $fileNew = "/wp-content/uploads/" . basename($filename);

                                                            $fileNew = cropImage($filename,
                                                                $_SERVER['DOCUMENT_ROOT'] . $fileNew,
                                                                361, 165);
                                                            ?>
                                                            <img
                                                                src="http://wpdemos.themezaa.com/h-code/wp-content/plugins/revslider/admin/assets/images/dummy.png"
                                                                alt="" data-ww="361px" data-hh="165px" width="361"
                                                                height="165"
                                                                data-lazyload="<?php echo $fileNew; ?>"
                                                                data-no-retina></div>
                                                        <div
                                                            class="tp-caption Fashion-BigDisplay   tp-resizeme  tp-caption roboto_regular_15 sfb stb"
                                                            id="slide-44-layer-8" data-x="center" data-hoffset="535"
                                                            data-y="center" data-voffset="140" data-width="['auto']"
                                                            data-height="['auto']" data-type="text"
                                                            data-responsive_offset="on"
                                                            data-frames='[{"delay":7500,"speed":600,"frame":"0","from":"y:50px;opacity:0;","to":"o:1;","ease":"Power4.easeOut"},{"delay":"+900","speed":1000,"frame":"999","to":"y:50px;opacity:0;","ease":"Power4.easeIn"}]'
                                                            data-textAlign="['left','left','left','left']"
                                                            data-paddingtop="[0,0,0,0]" data-paddingright="[0,0,0,0]"
                                                            data-paddingbottom="[0,0,0,0]" data-paddingleft="[0,0,0,0]"
                                                            style="z-index: 12; white-space: nowrap; font-size: 15px; line-height: 20px; font-weight: 300; color: rgba(255,255,255,1); letter-spacing: px;font-family:Roboto;z-index:10;position:absolute;margin:0px;white-space:nowrap;letter-spacing:normal;">
                                                            <strong><?php displayRandomElement($arPostTagsNames); ?></strong>
                                                        </div>
                                                        <div class="tp-caption   tp-resizeme  tp-caption sfb stb"
                                                             id="slide-44-layer-9" data-x="center" data-hoffset="540"
                                                             data-y="center" data-voffset=""
                                                             data-width="['none','none','none','none']"
                                                             data-height="['none','none','none','none']"
                                                             data-type="image" data-responsive_offset="on"
                                                             data-frames='[{"delay":11000,"speed":600,"frame":"0","from":"y:50px;opacity:0;","to":"o:1;","ease":"Power4.easeOut"},{"delay":"+1400","speed":1000,"frame":"999","to":"y:50px;opacity:0;","ease":"Power4.easeIn"}]'
                                                             data-textAlign="['left','left','left','left']"
                                                             data-paddingtop="[0,0,0,0]" data-paddingright="[0,0,0,0]"
                                                             data-paddingbottom="[0,0,0,0]" data-paddingleft="[0,0,0,0]"
                                                             style="z-index: 13;z-index:2;">
                                                            <?php
                                                            $filename = getRandomElement($arProjectImages);
                                                            $new_filen = $_SERVER["DOCUMENT_ROOT"].'/wp-content/uploads/' . basename($filename);


                                                            $fileNew = "/wp-content/uploads/" . basename($filename);

                                                            $fileNew = cropImage($filename,
                                                                $_SERVER['DOCUMENT_ROOT'] . $fileNew,
                                                                361, 165);
                                                            ?>
                                                            <img
                                                                src="http://wpdemos.themezaa.com/h-code/wp-content/plugins/revslider/admin/assets/images/dummy.png"
                                                                alt="" data-ww="361px" data-hh="165px" width="361"
                                                                height="165"
                                                                data-lazyload="<?php echo $fileNew; ?>"
                                                                data-no-retina></div>
                                                        <div
                                                            class="tp-caption Fashion-BigDisplay   tp-resizeme  tp-caption roboto_regular_15 sfb stb"
                                                            id="slide-44-layer-10" data-x="center" data-hoffset="519"
                                                            data-y="center" data-voffset="140" data-width="['auto']"
                                                            data-height="['auto']" data-type="text"
                                                            data-responsive_offset="on"
                                                            data-frames='[{"delay":11500,"speed":600,"frame":"0","from":"y:50px;opacity:0;","to":"o:1;","ease":"Power4.easeOut"},{"delay":"+900","speed":1000,"frame":"999","to":"y:50px;opacity:0;","ease":"Power4.easeIn"}]'
                                                            data-textAlign="['left','left','left','left']"
                                                            data-paddingtop="[0,0,0,0]" data-paddingright="[0,0,0,0]"
                                                            data-paddingbottom="[0,0,0,0]" data-paddingleft="[0,0,0,0]"
                                                            style="z-index: 14; white-space: nowrap; font-size: 15px; line-height: 20px; font-weight: 300; color: rgba(255,255,255,1); letter-spacing: px;font-family:Roboto;z-index:10;position:absolute;margin:0px;white-space:nowrap;letter-spacing:normal;">
                                                            <strong><?php displayRandomElement($arPostTagsNames); ?></strong>
                                                        </div>
                                                        <div
                                                            class="tp-caption Fashion-BigDisplay   tp-resizeme  tp-caption roboto_regular_15 sfb stb"
                                                            id="slide-44-layer-11" data-x="center" data-hoffset="530"
                                                            data-y="center" data-voffset="235" data-width="['auto']"
                                                            data-height="['auto']" data-type="text"
                                                            data-responsive_offset="on"
                                                            data-frames='[{"delay":4500,"speed":600,"frame":"0","from":"y:50px;opacity:0;","to":"o:1;","ease":"Power4.easeOut"},{"delay":"+7900","speed":1000,"frame":"999","to":"y:50px;opacity:0;","ease":"Power4.easeIn"}]'
                                                            data-textAlign="['left','left','left','left']"
                                                            data-paddingtop="[0,0,0,0]" data-paddingright="[0,0,0,0]"
                                                            data-paddingbottom="[0,0,0,0]" data-paddingleft="[0,0,0,0]"
                                                            style="z-index: 15; white-space: nowrap; font-size: 15px; line-height: 20px; font-weight: 300; color: rgba(255,255,255,1); letter-spacing: px;font-family:Roboto;z-index:10;position:absolute;margin:0px;white-space:nowrap;letter-spacing:normal;">
                                                            <?php displayRandomElement($arPostTagsNames); ?>
                                                        </div>
                                                    </li>
                                                    <li data-index="rs-45" data-transition="cube" data-slotamount="5"
                                                        data-hideafterloop="0" data-hideslideonmobile="off"
                                                        data-easein="default" data-easeout="default"
                                                        data-masterspeed="500" data-delay="6000" data-rotate="0"
                                                        data-saveperformance="off" class="no-transition"
                                                        data-title="Slide" data-param1="" data-param2="" data-param3=""
                                                        data-param4="" data-param5="" data-param6="" data-param7=""
                                                        data-param8="" data-param9="" data-param10=""
                                                        data-description="">
                                                        <?php
                                                        $filename = getRandomElement($arProjectImages);
                                                        $new_filen = $_SERVER["DOCUMENT_ROOT"].'/wp-content/uploads/' . basename($filename);


                                                        $fileNew = "/wp-content/uploads/" . basename($filename);

                                                        $fileNew = cropImage($filename,
                                                            $_SERVER['DOCUMENT_ROOT'] . $fileNew,
                                                            2100, 1100);
                                                        ?>
                                                        <img
                                                            src="http://wpdemos.themezaa.com/h-code/wp-content/plugins/revslider/admin/assets/images/dummy.png"
                                                            alt="" title="intro-product-bg"
                                                            width="2100" height="1100"
                                                            data-lazyload="<?php echo $fileNew; ?>"
                                                            data-bgposition="center bottom" data-bgfit="cover"
                                                            data-bgrepeat="no-repeat" class="rev-slidebg"
                                                            data-no-retina>
                                                        <div class="tp-caption   tp-resizeme  tp-caption fade fadeout"
                                                             id="slide-45-layer-1" data-x="center" data-hoffset="6"
                                                             data-y="center" data-voffset=""
                                                             data-width="['none','none','none','none']"
                                                             data-height="['none','none','none','none']"
                                                             data-type="image" data-responsive_offset="on"
                                                             data-frames='[{"from":"opacity:0;","speed":600,"to":"o:1;","delay":1500,"ease":"Power4.easeOut"},{"delay":2900,"speed":1000,"to":"opacity:0;","ease":"Power4.easeIn"}]'
                                                             data-textAlign="['left','left','left','left']"
                                                             data-paddingtop="[0,0,0,0]" data-paddingright="[0,0,0,0]"
                                                             data-paddingbottom="[0,0,0,0]" data-paddingleft="[0,0,0,0]"
                                                             style="z-index: 33;text-transform:left;z-index:1;">
                                                            <?php
                                                            $filename = getRandomElement($arProjectImages);
                                                            $new_filen = $_SERVER["DOCUMENT_ROOT"].'/wp-content/uploads/' . basename($filename);


                                                            $fileNew = "/wp-content/uploads/" . basename($filename);

                                                            $fileNew = cropImage($filename,
                                                                $_SERVER['DOCUMENT_ROOT'] . $fileNew,
                                                                1600, 700);
                                                            ?>
                                                            <img
                                                                src="http://wpdemos.themezaa.com/h-code/wp-content/plugins/revslider/admin/assets/images/dummy.png"
                                                                alt="" data-ww="1600px" data-hh="700px"
                                                                width="1600"
                                                                height="700"
                                                                data-lazyload="<?php echo $fileNew; ?>"
                                                                data-no-retina></div>
                                                        <div class="tp-caption   tp-resizeme  tp-caption fade fadeout"
                                                             id="slide-45-layer-2" data-x="center" data-hoffset="230"
                                                             data-y="center" data-voffset="70"
                                                             data-width="['none','none','none','none']"
                                                             data-height="['none','none','none','none']"
                                                             data-type="image" data-responsive_offset="on"
                                                             data-frames='[{"from":"opacity:0;","speed":1000,"to":"o:1;","delay":2000,"ease":"Power4.easeOut"},{"delay":2000,"speed":1000,"to":"opacity:0;","ease":"Power4.easeIn"}]'
                                                             data-textAlign="['left','left','left','left']"
                                                             data-paddingtop="[0,0,0,0]" data-paddingright="[0,0,0,0]"
                                                             data-paddingbottom="[0,0,0,0]" data-paddingleft="[0,0,0,0]"
                                                             style="z-index: 34;text-transform:left;z-index:2;">
                                                            <?php
                                                            $filename = getRandomElement($arProjectImages);
                                                            $new_filen = $_SERVER["DOCUMENT_ROOT"].'/wp-content/uploads/' . basename($filename);


                                                            $fileNew = "/wp-content/uploads/" . basename($filename);

                                                            $fileNew = cropImage($filename,
                                                                $_SERVER['DOCUMENT_ROOT'] . $fileNew,
                                                                1040, 434);
                                                            ?>
                                                            <img
                                                                src="http://wpdemos.themezaa.com/h-code/wp-content/plugins/revslider/admin/assets/images/dummy.png"
                                                                alt="" data-ww="1040px" data-hh="434px"
                                                                width="1040"
                                                                height="434"
                                                                data-lazyload="<?php echo $fileNew; ?>"
                                                                data-no-retina></div>
                                                        <div
                                                            class="tp-caption Fashion-BigDisplay   tp-resizeme  tp-caption roboto_condensed_blod_60 sfr str"
                                                            id="slide-45-layer-3" data-x="center" data-hoffset="-500"
                                                            data-y="center" data-voffset="-220" data-width="['auto']"
                                                            data-height="['auto']" data-type="text"
                                                            data-responsive_offset="on"
                                                            data-frames='[{"from":"x:50px;opacity:0;","speed":600,"to":"o:1;","delay":2500,"ease":"Power2.easeInOut"},{"delay":1900,"speed":1000,"to":"x:50px;opacity:0;","ease":"Power4.easeIn"}]'
                                                            data-textAlign="['left','left','left','left']"
                                                            data-paddingtop="[0,0,0,0]" data-paddingright="[0,0,0,0]"
                                                            data-paddingbottom="[0,0,0,0]" data-paddingleft="[0,0,0,0]"
                                                            style="z-index: 35; white-space: nowrap; font-weight: 700; color: rgba(255,255,255,1);font-family:Roboto Condensed;text-transform:uppercase;z-index:10;position:absolute;margin:0px;white-space:nowrap;letter-spacing:normal;">
                                                            <?php displayRandomElement($arPostTagsNames); ?>
                                                        </div>
                                                        <div
                                                            class="tp-caption Fashion-BigDisplay   tp-resizeme  tp-caption roboto_condensed_blod_60 orange_bold_bg_20 sfr str"
                                                            id="slide-45-layer-4" data-x="center" data-hoffset="-100"
                                                            data-y="center" data-voffset="-220" data-width="['auto']"
                                                            data-height="['auto']" data-type="text"
                                                            data-responsive_offset="on"
                                                            data-frames='[{"from":"x:50px;opacity:0;","speed":600,"to":"o:1;","delay":3000,"ease":"Power4.easeOut"},{"delay":1400,"speed":1000,"to":"x:50px;opacity:0;","ease":"Power4.easeIn"}]'
                                                            data-textAlign="['left','left','left','left']"
                                                            data-paddingtop="[0,0,0,0]" data-paddingright="[0,0,0,0]"
                                                            data-paddingbottom="[0,0,0,0]" data-paddingleft="[0,0,0,0]"
                                                            style="z-index: 36; white-space: nowrap; font-weight: 300; color: rgba(255,255,255,1);font-family:Roboto Condensed;text-transform:uppercase;text-decoration:none;background-color:rgb(236, 131, 0);z-index:10;position:absolute;white-space:nowrap;padding:2px 8px;text-shadow:none;">
                                                            <?php displayRandomElement($arPostTagsNames); ?>
                                                        </div>
                                                        <div
                                                            class="tp-caption Fashion-BigDisplay   tp-resizeme  tp-caption roboto_condensed_regular_16 sfr str"
                                                            id="slide-45-layer-5" data-x="center" data-hoffset="-308"
                                                            data-y="center" data-voffset="-171" data-width="['auto']"
                                                            data-height="['auto']" data-type="text"
                                                            data-responsive_offset="on"
                                                            data-frames='[{"from":"x:50px;opacity:0;","speed":600,"to":"o:1;","delay":3500,"ease":"Power4.easeOut"},{"delay":900,"speed":1000,"to":"x:50px;opacity:0;","ease":"Power4.easeIn"}]'
                                                            data-textAlign="['left','left','left','left']"
                                                            data-paddingtop="[0,0,0,0]" data-paddingright="[0,0,0,0]"
                                                            data-paddingbottom="[0,0,0,0]" data-paddingleft="[0,0,0,0]"
                                                            style="z-index: 37; white-space: nowrap; font-size: 16px; line-height: 22px; font-weight: 400; color: rgba(255,255,255,1);font-family:Roboto Condensed;text-transform:left;z-index:10;letter-spacing:9px;position:absolute;margin:0px;white-space:nowrap;">
                                                            <?php displayRandomElement($arPostTagsNames); ?>
                                                        </div>
                                                    </li>
                                                    <li data-index="rs-46" data-transition="cube" data-slotamount="6"
                                                        data-hideafterloop="0" data-hideslideonmobile="off"
                                                        data-easein="default" data-easeout="default"
                                                        data-masterspeed="500" data-delay="8000" data-rotate="0"
                                                        data-saveperformance="off" class="no-transition"
                                                        data-title="Slide" data-param1="" data-param2="" data-param3=""
                                                        data-param4="" data-param5="" data-param6="" data-param7=""
                                                        data-param8="" data-param9="" data-param10=""
                                                        data-description="">
                                                        <?php
                                                        $filename = getRandomElement($arProjectImages);
                                                        $new_filen = $_SERVER["DOCUMENT_ROOT"].'/wp-content/uploads/' . basename($filename);


                                                        $fileNew = "/wp-content/uploads/" . basename($filename);

                                                        $fileNew = cropImage($filename,
                                                            $_SERVER['DOCUMENT_ROOT'] . $fileNew,
                                                            2100, 1100);
                                                        ?>
                                                        <img
                                                            src="http://wpdemos.themezaa.com/h-code/wp-content/plugins/revslider/admin/assets/images/dummy.png"
                                                            alt="" title="intro-product-bg"
                                                            width="2100" height="1100"
                                                            data-lazyload="<?php echo $fileNew; ?>"
                                                            data-bgposition="center bottom" data-bgfit="cover"
                                                            data-bgrepeat="no-repeat" class="rev-slidebg"
                                                            data-no-retina>
                                                        <div class="tp-caption   tp-resizeme  tp-caption fade fadeout"
                                                             id="slide-46-layer-1" data-x="center" data-hoffset="6"
                                                             data-y="center" data-voffset=""
                                                             data-width="['none','none','none','none']"
                                                             data-height="['none','none','none','none']"
                                                             data-type="image" data-responsive_offset="on"
                                                             data-frames='[{"from":"opacity:0;","speed":600,"to":"o:1;","delay":1500,"ease":"Power4.easeOut"},{"delay":4900,"speed":1000,"to":"opacity:0;","ease":"Power4.easeIn"}]'
                                                             data-textAlign="['left','left','left','left']"
                                                             data-paddingtop="[0,0,0,0]" data-paddingright="[0,0,0,0]"
                                                             data-paddingbottom="[0,0,0,0]" data-paddingleft="[0,0,0,0]"
                                                             style="z-index: 38;text-transform:left;z-index:1;">
                                                            <?php
                                                            $filename = getRandomElement($arProjectImages);
                                                            $new_filen = $_SERVER["DOCUMENT_ROOT"].'/wp-content/uploads/' . basename($filename);


                                                            $fileNew = "/wp-content/uploads/" . basename($filename);

                                                            $fileNew = cropImage($filename,
                                                                $_SERVER['DOCUMENT_ROOT'] . $fileNew,
                                                                1600, 702);
                                                            ?>
                                                            <img
                                                                src="http://wpdemos.themezaa.com/h-code/wp-content/plugins/revslider/admin/assets/images/dummy.png"
                                                                alt="" data-ww="1600px" data-hh="702px"
                                                                width="1600"
                                                                height="702"
                                                                data-lazyload="<?php echo $fileNew; ?>"
                                                                data-no-retina></div>
                                                        <div
                                                            class="tp-caption Fashion-BigDisplay   tp-resizeme  tp-caption roboto_condensed_blod_60 sfr str"
                                                            id="slide-46-layer-2" data-x="250" data-y="center"
                                                            data-voffset="-130" data-width="['auto']"
                                                            data-height="['auto']" data-type="text"
                                                            data-responsive_offset="on"
                                                            data-frames='[{"from":"x:50px;opacity:0;","speed":600,"to":"o:1;","delay":2500,"ease":"Power2.easeInOut"},{"delay":3900,"speed":1000,"to":"x:50px;opacity:0;","ease":"Power4.easeIn"}]'
                                                            data-textAlign="['left','left','left','left']"
                                                            data-paddingtop="[0,0,0,0]" data-paddingright="[0,0,0,0]"
                                                            data-paddingbottom="[0,0,0,0]" data-paddingleft="[0,0,0,0]"
                                                            style="z-index: 39; white-space: nowrap; font-weight: 700; color: rgba(255,255,255,1);font-family:Roboto Condensed;text-transform:uppercase;z-index:10;position:absolute;margin:0px;white-space:nowrap;letter-spacing:normal;">
                                                            <?php displayRandomElement($arPostTagsNames); ?>
                                                        </div>
                                                        <div
                                                            class="tp-caption Fashion-BigDisplay   tp-resizeme  tp-caption roboto_condensed_regular_16 sfr str"
                                                            id="slide-46-layer-3" data-x="250" data-y="center"
                                                            data-voffset="-70" data-width="['auto']"
                                                            data-height="['auto']" data-type="text"
                                                            data-responsive_offset="on"
                                                            data-frames='[{"from":"x:50px;opacity:0;","speed":1000,"to":"o:1;","delay":3500,"ease":"Power4.easeOut"},{"delay":2500,"speed":1000,"to":"x:50px;opacity:0;","ease":"Power4.easeIn"}]'
                                                            data-textAlign="['left','left','left','left']"
                                                            data-paddingtop="[0,0,0,0]" data-paddingright="[0,0,0,0]"
                                                            data-paddingbottom="[0,0,0,0]" data-paddingleft="[0,0,0,0]"
                                                            style="z-index: 40; white-space: nowrap; font-size: 16px; line-height: 22px; font-weight: 400; color: rgba(255,255,255,1);font-family:Roboto Condensed;text-transform:left;z-index:10;position:absolute;margin:0px;white-space:nowrap;letter-spacing:normal;">
                                                            <?php displayRandomElement($arPostTagsNames); ?>
                                                        </div>
                                                        <div
                                                            class="tp-caption Fashion-BigDisplay   tp-resizeme  tp-caption roboto_regular_12 sfr str"
                                                            id="slide-46-layer-4" data-x="250" data-y="center"
                                                            data-voffset="4" data-width="['auto']"
                                                            data-height="['auto']" data-type="text"
                                                            data-responsive_offset="on"
                                                            data-frames='[{"from":"x:50px;opacity:0;","speed":1000,"to":"o:1;","delay":4500,"ease":"Power2.easeInOut"},{"delay":1500,"speed":1000,"to":"x:50px;opacity:0;","ease":"Power4.easeIn"}]'
                                                            data-textAlign="['left','left','left','left']"
                                                            data-paddingtop="[0,0,0,0]" data-paddingright="[0,0,0,0]"
                                                            data-paddingbottom="[0,0,0,0]" data-paddingleft="[0,0,0,0]"
                                                            style="z-index: 41; white-space: nowrap; font-size: 12px; line-height: 18px; font-weight: 400; color: rgba(255,255,255,1);font-family:Roboto;text-transform:left;z-index:10;position:absolute;margin:0px;white-space:nowrap;letter-spacing:2px;">
                                                            <?php displayRandomElement($arPostTagsNames); ?>
                                                        </div>
                                                    </li>
                                                    <li data-index="rs-47" data-transition="cube" data-slotamount="7"
                                                        data-hideafterloop="0" data-hideslideonmobile="off"
                                                        data-easein="default" data-easeout="default"
                                                        data-masterspeed="500" data-delay="8000" data-rotate="0"
                                                        data-saveperformance="off" class="no-transition"
                                                        data-title="Slide" data-param1="" data-param2="" data-param3=""
                                                        data-param4="" data-param5="" data-param6="" data-param7=""
                                                        data-param8="" data-param9="" data-param10=""
                                                        data-description="">
                                                        <?php
                                                        $filename = getRandomElement($arProjectImages);
                                                        $new_filen = $_SERVER["DOCUMENT_ROOT"].'/wp-content/uploads/' . basename($filename);


                                                        $fileNew = "/wp-content/uploads/" . basename($filename);

                                                        $fileNew = cropImage($filename,
                                                            $_SERVER['DOCUMENT_ROOT'] . $fileNew,
                                                            2100, 1100);
                                                        ?>
                                                        <img
                                                            src="http://wpdemos.themezaa.com/h-code/wp-content/plugins/revslider/admin/assets/images/dummy.png"
                                                            alt="" title="intro-product-bg"
                                                            width="2100" height="1100"
                                                            data-lazyload="<?php echo $fileNew; ?>"
                                                            data-bgposition="center center" data-bgfit="cover"
                                                            data-bgrepeat="no-repeat" class="rev-slidebg"
                                                            data-no-retina>
                                                        <div class="tp-caption   tp-resizeme  tp-caption fade fadeout"
                                                             id="slide-47-layer-1" data-x="center" data-hoffset="6"
                                                             data-y="center" data-voffset=""
                                                             data-width="['none','none','none','none']"
                                                             data-height="['none','none','none','none']"
                                                             data-type="image" data-responsive_offset="on"
                                                             data-frames='[{"from":"opacity:0;","speed":600,"to":"o:1;","delay":1500,"ease":"Power4.easeOut"},{"delay":4900,"speed":1000,"to":"opacity:0;","ease":"Power4.easeIn"}]'
                                                             data-textAlign="['left','left','left','left']"
                                                             data-paddingtop="[0,0,0,0]" data-paddingright="[0,0,0,0]"
                                                             data-paddingbottom="[0,0,0,0]" data-paddingleft="[0,0,0,0]"
                                                             style="z-index: 42;text-transform:left;z-index:1;">
                                                            <?php
                                                            $filename = getRandomElement($arProjectImages);
                                                            $new_filen = $_SERVER["DOCUMENT_ROOT"].'/wp-content/uploads/' . basename($filename);


                                                            $fileNew = "/wp-content/uploads/" . basename($filename);

                                                            $fileNew = cropImage($filename,
                                                                $_SERVER['DOCUMENT_ROOT'] . $fileNew,
                                                                1600, 702);
                                                            ?>
                                                            <img
                                                                src="http://wpdemos.themezaa.com/h-code/wp-content/plugins/revslider/admin/assets/images/dummy.png"
                                                                alt="" data-ww="1600px" data-hh="702px"
                                                                width="1600"
                                                                height="702"
                                                                data-lazyload="<?php echo $fileNew; ?>"
                                                                data-no-retina></div>
                                                        <div
                                                            class="tp-caption Fashion-BigDisplay   tp-resizeme  tp-caption roboto_condensed_blod_60 sfr str"
                                                            id="slide-47-layer-2" data-x="1330" data-y="center"
                                                            data-voffset="" data-width="['auto']" data-height="['auto']"
                                                            data-type="text" data-responsive_offset="on"
                                                            data-frames='[{"from":"x:50px;opacity:0;","speed":600,"to":"o:1;","delay":2500,"ease":"Power4.easeOut"},{"delay":3900,"speed":1000,"to":"x:50px;opacity:0;","ease":"Power4.easeIn"}]'
                                                            data-textAlign="['left','left','left','left']"
                                                            data-paddingtop="[0,0,0,0]" data-paddingright="[0,0,0,0]"
                                                            data-paddingbottom="[0,0,0,0]" data-paddingleft="[0,0,0,0]"
                                                            style="z-index: 43; white-space: nowrap; font-weight: 700; color: rgba(255,255,255,1);font-family:Roboto Condensed;text-transform:uppercase;z-index:10;position:absolute;margin:0px;white-space:nowrap;">
                                                            <?php displayRandomElement($arPostTagsNames); ?>
                                                        </div>
                                                        <div
                                                            class="tp-caption Fashion-BigDisplay   tp-resizeme  tp-caption roboto_condensed_regular_16 sfr str"
                                                            id="slide-47-layer-3" data-x="1330" data-y="center"
                                                            data-voffset="90" data-width="['auto']"
                                                            data-height="['auto']" data-type="text"
                                                            data-responsive_offset="on"
                                                            data-frames='[{"from":"x:50px;opacity:0;","speed":1000,"to":"o:1;","delay":3500,"ease":"Power4.easeOut"},{"delay":2500,"speed":1000,"to":"x:50px;opacity:0;","ease":"Power4.easeIn"}]'
                                                            data-textAlign="['left','left','left','left']"
                                                            data-paddingtop="[0,0,0,0]" data-paddingright="[0,0,0,0]"
                                                            data-paddingbottom="[0,0,0,0]" data-paddingleft="[0,0,0,0]"
                                                            style="z-index: 44; white-space: nowrap; font-size: 16px; line-height: 22px; font-weight: 400; color: rgba(255,255,255,1);font-family:Roboto Condensed;text-transform:left;z-index:10;position:absolute;margin:0px;white-space:nowrap;letter-spacing:normal;">
                                                            <?php displayRandomElement($arPostTagsNames); ?>
                                                        </div>
                                                        <div
                                                            class="tp-caption Fashion-BigDisplay   tp-resizeme  tp-caption roboto_regular_12 sfr str"
                                                            id="slide-47-layer-4" data-x="1330" data-y="center"
                                                            data-voffset="160" data-width="['auto']"
                                                            data-height="['auto']" data-type="text"
                                                            data-responsive_offset="on"
                                                            data-frames='[{"from":"x:50px;opacity:0;","speed":1000,"to":"o:1;","delay":4500,"ease":"Power4.easeOut"},{"delay":1500,"speed":1000,"to":"x:50px;opacity:0;","ease":"Power4.easeIn"}]'
                                                            data-textAlign="['left','left','left','left']"
                                                            data-paddingtop="[0,0,0,0]" data-paddingright="[0,0,0,0]"
                                                            data-paddingbottom="[0,0,0,0]" data-paddingleft="[0,0,0,0]"
                                                            style="z-index: 45; white-space: nowrap; font-size: 12px; line-height: 18px; font-weight: 300; color: rgba(255,255,255,1);font-family:Roboto;text-transform:left;z-index:10;position:absolute;margin:0px;white-space:nowrap;letter-spacing:normal;">
                                                            <?php displayRandomElement($arPostTagsNames); ?>
                                                        </div>
                                                    </li>
                                                    <li data-index="rs-48" data-transition="cube" data-slotamount="8"
                                                        data-hideafterloop="0" data-hideslideonmobile="off"
                                                        data-easein="default" data-easeout="default"
                                                        data-masterspeed="500" data-delay="8000" data-rotate="0"
                                                        data-saveperformance="off" class="no-transition"
                                                        data-title="Slide" data-param1="" data-param2="" data-param3=""
                                                        data-param4="" data-param5="" data-param6="" data-param7=""
                                                        data-param8="" data-param9="" data-param10=""
                                                        data-description="">
                                                        <?php
                                                        $filename = getRandomElement($arProjectImages);
                                                        $new_filen = $_SERVER["DOCUMENT_ROOT"].'/wp-content/uploads/' . basename($filename);


                                                        $fileNew = "/wp-content/uploads/" . basename($filename);

                                                        $fileNew = cropImage($filename,
                                                            $_SERVER['DOCUMENT_ROOT'] . $fileNew,
                                                            2100, 1100);
                                                        ?>
                                                        <img
                                                            src="http://wpdemos.themezaa.com/h-code/wp-content/plugins/revslider/admin/assets/images/dummy.png"
                                                            alt="" title="intro-product-bg"
                                                            width="2100" height="1100"
                                                            data-lazyload="<?php echo $fileNew; ?>"
                                                            data-bgposition="center center" data-bgfit="cover"
                                                            data-bgrepeat="no-repeat" class="rev-slidebg"
                                                            data-no-retina>
                                                        <div class="tp-caption   tp-resizeme  tp-caption fade fadeout"
                                                             id="slide-48-layer-1" data-x="center" data-hoffset="6"
                                                             data-y="center" data-voffset=""
                                                             data-width="['none','none','none','none']"
                                                             data-height="['none','none','none','none']"
                                                             data-type="image" data-responsive_offset="on"
                                                             data-frames='[{"from":"opacity:0;","speed":600,"to":"o:1;","delay":1500,"ease":"Power4.easeOut"},{"delay":4900,"speed":1000,"to":"opacity:0;","ease":"Power4.easeIn"}]'
                                                             data-textAlign="['left','left','left','left']"
                                                             data-paddingtop="[0,0,0,0]" data-paddingright="[0,0,0,0]"
                                                             data-paddingbottom="[0,0,0,0]" data-paddingleft="[0,0,0,0]"
                                                             style="z-index: 46;text-transform:left;z-index:1;">
                                                            <?php
                                                            $filename = getRandomElement($arProjectImages);
                                                            $new_filen = $_SERVER["DOCUMENT_ROOT"].'/wp-content/uploads/' . basename($filename);


                                                            $fileNew = "/wp-content/uploads/" . basename($filename);

                                                            $fileNew = cropImage($filename,
                                                                $_SERVER['DOCUMENT_ROOT'] . $fileNew,
                                                                1600, 702);
                                                            ?>
                                                            <img
                                                                src="http://wpdemos.themezaa.com/h-code/wp-content/plugins/revslider/admin/assets/images/dummy.png"
                                                                alt="" data-ww="1600px" data-hh="702px"
                                                                width="1600"
                                                                height="702"
                                                                data-lazyload="<?php echo $fileNew; ?>"
                                                                data-no-retina></div>
                                                        <div
                                                            class="tp-caption Fashion-BigDisplay   tp-resizeme  tp-caption roboto_condensed_blod_60 sfr str"
                                                            id="slide-48-layer-2" data-x="212" data-y="center"
                                                            data-voffset="-40" data-width="['auto']"
                                                            data-height="['auto']" data-type="text"
                                                            data-responsive_offset="on"
                                                            data-frames='[{"from":"x:50px;opacity:0;","speed":600,"to":"o:1;","delay":2500,"ease":"Power4.easeOut"},{"delay":3900,"speed":1000,"to":"x:50px;opacity:0;","ease":"Power4.easeIn"}]'
                                                            data-textAlign="['left','left','left','left']"
                                                            data-paddingtop="[0,0,0,0]" data-paddingright="[0,0,0,0]"
                                                            data-paddingbottom="[0,0,0,0]" data-paddingleft="[0,0,0,0]"
                                                            style="z-index: 47; white-space: nowrap; font-weight: 700; color: rgba(255,255,255,1);font-family:Roboto Condensed;text-transform:uppercase;z-index:10;position:absolute;margin:0px;white-space:nowrap;">
                                                            <?php displayRandomElement($arPostTagsNames); ?>
                                                        </div>
                                                        <div
                                                            class="tp-caption Fashion-BigDisplay   tp-resizeme  tp-caption roboto_condensed_regular_16 sfr str"
                                                            id="slide-48-layer-3" data-x="212" data-y="center"
                                                            data-voffset="55" data-width="['auto']"
                                                            data-height="['auto']" data-type="text"
                                                            data-responsive_offset="on"
                                                            data-frames='[{"from":"x:50px;opacity:0;","speed":1000,"to":"o:1;","delay":3500,"ease":"Power4.easeOut"},{"delay":2500,"speed":1000,"to":"x:50px;opacity:0;","ease":"Power4.easeIn"}]'
                                                            data-textAlign="['left','left','left','left']"
                                                            data-paddingtop="[0,0,0,0]" data-paddingright="[0,0,0,0]"
                                                            data-paddingbottom="[0,0,0,0]" data-paddingleft="[0,0,0,0]"
                                                            style="z-index: 48; white-space: nowrap; font-size: 16px; line-height: 22px; font-weight: 400; color: rgba(255,255,255,1);font-family:Roboto Condensed;text-transform:left;z-index:10;position:absolute;margin:0px;white-space:nowrap;letter-spacing:normal;">
                                                            <?php displayRandomElement($arPostTagsNames); ?>
                                                        </div>
                                                        <div
                                                            class="tp-caption Fashion-BigDisplay   tp-resizeme  tp-caption roboto_regular_12 sfr str"
                                                            id="slide-48-layer-4" data-x="212" data-y="center"
                                                            data-voffset="130" data-width="['auto']"
                                                            data-height="['auto']" data-type="text"
                                                            data-responsive_offset="on"
                                                            data-frames='[{"from":"x:50px;opacity:0;","speed":1000,"to":"o:1;","delay":4500,"ease":"Power4.easeOut"},{"delay":1500,"speed":1000,"to":"x:50px;opacity:0;","ease":"Power4.easeIn"}]'
                                                            data-textAlign="['left','left','left','left']"
                                                            data-paddingtop="[0,0,0,0]" data-paddingright="[0,0,0,0]"
                                                            data-paddingbottom="[0,0,0,0]" data-paddingleft="[0,0,0,0]"
                                                            style="z-index: 49; white-space: nowrap; font-size: 12px; line-height: 18px; font-weight: 400; color: rgba(255,255,255,1);font-family:Roboto;text-transform:left;z-index:10;position:absolute;margin:0px;white-space:nowrap;letter-spacing:normal;">
                                                            <?php displayRandomElement($arPostTagsNames); ?>
                                                        </div>
                                                    </li>
                                                    <li data-index="rs-49" data-transition="cube" data-slotamount="9"
                                                        data-hideafterloop="0" data-hideslideonmobile="off"
                                                        data-easein="default" data-easeout="default"
                                                        data-masterspeed="500" data-delay="10000" data-rotate="0"
                                                        data-saveperformance="off" class="no-transition"
                                                        data-title="Slide" data-param1="" data-param2="" data-param3=""
                                                        data-param4="" data-param5="" data-param6="" data-param7=""
                                                        data-param8="" data-param9="" data-param10=""
                                                        data-description="">
                                                        <?php
                                                        $filename = getRandomElement($arProjectImages);
                                                        $new_filen = $_SERVER["DOCUMENT_ROOT"].'/wp-content/uploads/' . basename($filename);


                                                        $fileNew = "/wp-content/uploads/" . basename($filename);

                                                        $fileNew = cropImage($filename,
                                                            $_SERVER['DOCUMENT_ROOT'] . $fileNew,
                                                            2100, 1100);
                                                        ?>
                                                        <img
                                                            src="http://wpdemos.themezaa.com/h-code/wp-content/plugins/revslider/admin/assets/images/dummy.png"
                                                            alt="" title="intro-product-bg"
                                                            width="2100" height="1100"
                                                            data-lazyload="<?php echo $fileNew; ?>"
                                                            data-bgposition="center bottom" data-bgfit="cover"
                                                            data-bgrepeat="no-repeat" class="rev-slidebg"
                                                            data-no-retina>
                                                        <div class="tp-caption   tp-resizeme  tp-caption fade fadeout"
                                                             id="slide-49-layer-1" data-x="center" data-hoffset="6"
                                                             data-y="center" data-voffset=""
                                                             data-width="['none','none','none','none']"
                                                             data-height="['none','none','none','none']"
                                                             data-type="image" data-responsive_offset="on"
                                                             data-frames='[{"delay":1500,"speed":600,"frame":"0","from":"opacity:0;","to":"o:1;","ease":"Power4.easeOut"},{"delay":"+6900","speed":1000,"frame":"999","to":"opacity:0;","ease":"Power4.easeIn"}]'
                                                             data-textAlign="['left','left','left','left']"
                                                             data-paddingtop="[0,0,0,0]" data-paddingright="[0,0,0,0]"
                                                             data-paddingbottom="[0,0,0,0]" data-paddingleft="[0,0,0,0]"
                                                             style="z-index: 5;z-index:1;">
                                                            <?php
                                                            $filename = getRandomElement($arProjectImages);
                                                            $new_filen = $_SERVER["DOCUMENT_ROOT"].'/wp-content/uploads/' . basename($filename);


                                                            $fileNew = "/wp-content/uploads/" . basename($filename);

                                                            $fileNew = cropImage($filename,
                                                                $_SERVER['DOCUMENT_ROOT'] . $fileNew,
                                                                1600, 700);
                                                            ?>
                                                            <img
                                                                src="http://wpdemos.themezaa.com/h-code/wp-content/plugins/revslider/admin/assets/images/dummy.png"
                                                                alt="" data-ww="1600px" data-hh="700px"
                                                                width="1600"
                                                                height="700"
                                                                data-lazyload="<?php echo $fileNew; ?>"
                                                                data-no-retina></div>
                                                        <div
                                                            class="tp-caption Fashion-BigDisplay   tp-resizeme  tp-caption roboto_condensed_blod_26 sfb stb"
                                                            id="slide-49-layer-2" data-x="center" data-hoffset=""
                                                            data-y="center" data-voffset="-280" data-width="['auto']"
                                                            data-height="['auto']" data-type="text"
                                                            data-responsive_offset="on"
                                                            data-frames='[{"delay":2500,"speed":600,"frame":"0","from":"y:50px;opacity:0;","to":"o:1;","ease":"Power2.easeInOut"},{"delay":"+5900","speed":1000,"frame":"999","to":"y:50px;opacity:0;","ease":"Power4.easeIn"}]'
                                                            data-textAlign="['left','left','left','left']"
                                                            data-paddingtop="[0,0,0,0]" data-paddingright="[0,0,0,0]"
                                                            data-paddingbottom="[0,0,0,0]" data-paddingleft="[0,0,0,0]"
                                                            style="z-index: 6; white-space: nowrap; font-size: 26px; font-weight: 700; letter-spacing: ;font-family:Roboto Condensed;text-transform:uppercase;z-index:10;position:absolute;margin:0px;white-space:nowrap;">
                                                            <?php displayRandomElement($arPostTagsNames); ?>
                                                        </div>
                                                        <div class="tp-caption   tp-resizeme  tp-caption sfb stb"
                                                             id="slide-49-layer-4" data-x="center" data-hoffset="-350"
                                                             data-y="center" data-voffset=""
                                                             data-width="['none','none','none','none']"
                                                             data-height="['none','none','none','none']"
                                                             data-type="image" data-responsive_offset="on"
                                                             data-frames='[{"delay":3500,"speed":600,"frame":"0","from":"y:50px;opacity:0;","to":"o:1;","ease":"Power4.easeOut"},{"delay":"+4900","speed":1000,"frame":"999","to":"y:50px;opacity:0;","ease":"Power4.easeIn"}]'
                                                             data-textAlign="['left','left','left','left']"
                                                             data-paddingtop="[0,0,0,0]" data-paddingright="[0,0,0,0]"
                                                             data-paddingbottom="[0,0,0,0]" data-paddingleft="[0,0,0,0]"
                                                             style="z-index: 7;z-index:1;">
                                                            <div class="rs-looped rs-slideloop"
                                                                 data-easing="Linear.easeNone" data-speed="2"
                                                                 data-xs="0" data-xe="0" data-ys="-10" data-ye="10">
                                                                <?php
                                                                $randomImage = getRandomElement($arProjectImages);
                                                                $imageSizes = getimagesize ( $randomImage );

                                                                $imgHeight = $imageSizes[1];
                                                                $imgWidth = $imageSizes[0];
                                                                $hh = round((204 * $imgHeight) / $imgWidth);
                                                                ?>
                                                                <img
                                                                    src="http://wpdemos.themezaa.com/h-code/wp-content/plugins/revslider/admin/assets/images/dummy.png"
                                                                    alt="" data-ww="204px" data-hh="<?php echo $hh; ?>px" width="204"
                                                                    height="<?php echo $hh; ?>"
                                                                    data-lazyload="<?php echo $randomImage; ?>"
                                                                    data-no-retina></div>
                                                        </div>
                                                        <div class="tp-caption   tp-resizeme  tp-caption fade fadeout"
                                                             id="slide-49-layer-5" data-x="center" data-hoffset="-350"
                                                             data-y="center" data-voffset="230"
                                                             data-width="['none','none','none','none']"
                                                             data-height="['none','none','none','none']"
                                                             data-type="image" data-responsive_offset="on"
                                                             data-frames='[{"delay":3500,"speed":1000,"frame":"0","from":"opacity:0;","to":"o:1;","ease":"Power4.easeOut"},{"delay":"+4500","speed":1000,"frame":"999","to":"opacity:0;","ease":"Power4.easeIn"}]'
                                                             data-textAlign="['left','left','left','left']"
                                                             data-paddingtop="[0,0,0,0]" data-paddingright="[0,0,0,0]"
                                                             data-paddingbottom="[0,0,0,0]" data-paddingleft="[0,0,0,0]"
                                                             style="z-index: 8;z-index:1;">
                                                            <div class="rs-looped rs-slideloop"
                                                                 data-easing="linearEaseNone" data-speed="2" data-xs="0"
                                                                 data-xe="0" data-ys="0" data-ye="0">
                                                                <?php
                                                                $randomImage = getRandomElement($arProjectImages);
                                                                $imageSizes = getimagesize ( $randomImage );

                                                                $imgHeight = $imageSizes[1];
                                                                $imgWidth = $imageSizes[0];
                                                                $hh = round((273 * $imgHeight) / $imgWidth);
                                                                ?>
                                                                <img
                                                                    src="http://wpdemos.themezaa.com/h-code/wp-content/plugins/revslider/admin/assets/images/dummy.png"
                                                                    alt="" data-ww="273px" data-hh="<?php echo $hh; ?>px" width="273"
                                                                    height="<?php echo $hh; ?>"
                                                                    data-lazyload="<?php echo $randomImage; ?>"
                                                                    data-no-retina></div>
                                                        </div>
                                                        <div class="tp-caption   tp-resizeme  tp-caption sfb stb"
                                                             id="slide-49-layer-6" data-x="center" data-hoffset="6"
                                                             data-y="center" data-voffset=""
                                                             data-width="['none','none','none','none']"
                                                             data-height="['none','none','none','none']"
                                                             data-type="image" data-responsive_offset="on"
                                                             data-frames='[{"delay":4500,"speed":600,"frame":"0","from":"y:50px;opacity:0;","to":"o:1;","ease":"Power4.easeOut"},{"delay":"+3900","speed":1000,"frame":"999","to":"y:50px;opacity:0;","ease":"Power4.easeIn"}]'
                                                             data-textAlign="['left','left','left','left']"
                                                             data-paddingtop="[0,0,0,0]" data-paddingright="[0,0,0,0]"
                                                             data-paddingbottom="[0,0,0,0]" data-paddingleft="[0,0,0,0]"
                                                             style="z-index: 9;z-index:1;">
                                                            <div class="rs-looped rs-slideloop"
                                                                 data-easing="linearEaseNone" data-speed="2" data-xs="0"
                                                                 data-xe="0" data-ys="-10" data-ye="10">
                                                                <?php
                                                                $randomImage = getRandomElement($arProjectImages);
                                                                $imageSizes = getimagesize ( $randomImage );

                                                                $imgHeight = $imageSizes[1];
                                                                $imgWidth = $imageSizes[0];
                                                                $hh = round((155 * $imgHeight) / $imgWidth);
                                                                ?>
                                                                <img
                                                                    src="http://wpdemos.themezaa.com/h-code/wp-content/plugins/revslider/admin/assets/images/dummy.png"
                                                                    alt="" data-ww="155px" data-hh="<?php echo $hh; ?>px" width="155"
                                                                    height="<?php echo $hh; ?>"
                                                                    data-lazyload="<?php echo $randomImage; ?>"
                                                                    data-no-retina></div>
                                                        </div>
                                                        <div class="tp-caption   tp-resizeme  tp-caption fade fadeout"
                                                             id="slide-49-layer-7" data-x="center" data-hoffset="6"
                                                             data-y="center" data-voffset="230"
                                                             data-width="['none','none','none','none']"
                                                             data-height="['none','none','none','none']"
                                                             data-type="image" data-responsive_offset="on"
                                                             data-frames='[{"delay":4500,"speed":1000,"frame":"0","from":"opacity:0;","to":"o:1;","ease":"Power4.easeOut"},{"delay":"+3500","speed":1000,"frame":"999","to":"opacity:0;","ease":"Power4.easeIn"}]'
                                                             data-textAlign="['left','left','left','left']"
                                                             data-paddingtop="[0,0,0,0]" data-paddingright="[0,0,0,0]"
                                                             data-paddingbottom="[0,0,0,0]" data-paddingleft="[0,0,0,0]"
                                                             style="z-index: 10;z-index:1;">
                                                            <div class="rs-looped rs-slideloop"
                                                                 data-easing="linearEaseNone" data-speed="2" data-xs="0"
                                                                 data-xe="0" data-ys="0" data-ye="0">

                                                                <?php
                                                                $randomImage = getRandomElement($arProjectImages);
                                                                $imageSizes = getimagesize ( $randomImage );

                                                                $imgHeight = $imageSizes[1];
                                                                $imgWidth = $imageSizes[0];
                                                                $hh = round((273 * $imgHeight) / $imgWidth);
                                                                ?>
                                                                <img
                                                                    src="http://wpdemos.themezaa.com/h-code/wp-content/plugins/revslider/admin/assets/images/dummy.png"
                                                                    alt="" data-ww="273px" data-hh="<?php echo $hh; ?>px" width="273"
                                                                    height="<?php echo $hh; ?>"
                                                                    data-lazyload="<?php echo $randomImage; ?>"
                                                                    data-no-retina></div>
                                                        </div>
                                                        <div class="tp-caption   tp-resizeme  tp-caption sfb stb"
                                                             id="slide-49-layer-8" data-x="center" data-hoffset="356"
                                                             data-y="center" data-voffset=""
                                                             data-width="['none','none','none','none']"
                                                             data-height="['none','none','none','none']"
                                                             data-type="image" data-responsive_offset="on"
                                                             data-frames='[{"delay":5500,"speed":600,"frame":"0","from":"y:50px;opacity:0;","to":"o:1;","ease":"Power4.easeOut"},{"delay":"+2900","speed":1000,"frame":"999","to":"y:50px;opacity:0;","ease":"Power4.easeIn"}]'
                                                             data-textAlign="['left','left','left','left']"
                                                             data-paddingtop="[0,0,0,0]" data-paddingright="[0,0,0,0]"
                                                             data-paddingbottom="[0,0,0,0]" data-paddingleft="[0,0,0,0]"
                                                             style="z-index: 11;z-index:1;">
                                                            <div class="rs-looped rs-slideloop"
                                                                 data-easing="linearEaseNone" data-speed="2" data-xs="0"
                                                                 data-xe="0" data-ys="-10" data-ye="10">
                                                                <?php
                                                                $randomImage = getRandomElement($arProjectImages);
                                                                $imageSizes = getimagesize ( $randomImage );

                                                                $imgHeight = $imageSizes[1];
                                                                $imgWidth = $imageSizes[0];
                                                                $hh = round((195 * $imgHeight) / $imgWidth);
                                                                ?>
                                                                <img
                                                                    src="http://wpdemos.themezaa.com/h-code/wp-content/plugins/revslider/admin/assets/images/dummy.png"
                                                                    alt="" data-ww="195px" data-hh="<?php echo $hh; ?>px" width="195"
                                                                    height="<?php echo $hh; ?>"
                                                                    data-lazyload="<?php echo $randomImage; ?>"
                                                                    data-no-retina></div>
                                                        </div>
                                                        <div class="tp-caption   tp-resizeme  tp-caption fade fadeout"
                                                             id="slide-49-layer-9" data-x="center" data-hoffset="356"
                                                             data-y="center" data-voffset="230"
                                                             data-width="['none','none','none','none']"
                                                             data-height="['none','none','none','none']"
                                                             data-type="image" data-responsive_offset="on"
                                                             data-frames='[{"delay":5500,"speed":1000,"frame":"0","from":"opacity:0;","to":"o:1;","ease":"Power4.easeOut"},{"delay":"+2500","speed":1000,"frame":"999","to":"opacity:0;","ease":"Power4.easeIn"}]'
                                                             data-textAlign="['left','left','left','left']"
                                                             data-paddingtop="[0,0,0,0]" data-paddingright="[0,0,0,0]"
                                                             data-paddingbottom="[0,0,0,0]" data-paddingleft="[0,0,0,0]"
                                                             style="z-index: 12;z-index:1;">
                                                            <div class="rs-looped rs-slideloop"
                                                                 data-easing="linearEaseNone" data-speed="2" data-xs="0"
                                                                 data-xe="0" data-ys="0" data-ye="0">
                                                                <?php
                                                                $randomImage = getRandomElement($arProjectImages);
                                                                $imageSizes = getimagesize ( $randomImage );

                                                                $imgHeight = $imageSizes[1];
                                                                $imgWidth = $imageSizes[0];
                                                                $hh = round((273 * $imgHeight) / $imgWidth);
                                                                ?>
                                                                <img
                                                                    src="http://wpdemos.themezaa.com/h-code/wp-content/plugins/revslider/admin/assets/images/dummy.png"
                                                                    alt="" data-ww="273px" data-hh="<?php echo $hh; ?>px" width="273"
                                                                    height="<?php echo $hh; ?>"
                                                                    data-lazyload="<?php echo $randomImage; ?>"
                                                                    data-no-retina></div>
                                                        </div>
                                                        <div
                                                            class="tp-caption Fashion-BigDisplay   tp-resizeme  tp-caption roboto_condensed_regular_16 sfb stb"
                                                            id="slide-49-layer-10" data-x="center" data-hoffset="356"
                                                            data-y="center" data-voffset="270" data-width="['auto']"
                                                            data-height="['auto']" data-type="text"
                                                            data-responsive_offset="on"
                                                            data-frames='[{"delay":5500,"speed":600,"frame":"0","from":"y:50px;opacity:0;","to":"o:1;","ease":"Power2.easeInOut"},{"delay":"+2900","speed":1000,"frame":"999","to":"y:50px;opacity:0;","ease":"Power4.easeIn"}]'
                                                            data-textAlign="['left','left','left','left']"
                                                            data-paddingtop="[0,0,0,0]" data-paddingright="[0,0,0,0]"
                                                            data-paddingbottom="[0,0,0,0]" data-paddingleft="[0,0,0,0]"
                                                            style="z-index: 13; white-space: nowrap; font-size: 16px; line-height: 22px; font-weight: 400; letter-spacing: ;font-family:Roboto Condensed;text-transform:uppercase;z-index:10;position:absolute;margin:0px;white-space:nowrap;">
                                                            <div class="rs-looped rs-slideloop"
                                                                 data-easing="linearEaseNone" data-speed="2" data-xs="0"
                                                                 data-xe="0" data-ys="0" data-ye="0">
                                                                <?php displayRandomElement($arPostTagsNames); ?>
                                                            </div>
                                                        </div>
                                                        <div
                                                            class="tp-caption Fashion-BigDisplay   tp-resizeme  tp-caption roboto_condensed_regular_16 sfb stb"
                                                            id="slide-49-layer-11" data-x="center" data-hoffset="6"
                                                            data-y="center" data-voffset="270" data-width="['auto']"
                                                            data-height="['auto']" data-type="text"
                                                            data-responsive_offset="on"
                                                            data-frames='[{"delay":6500,"speed":600,"frame":"0","from":"y:50px;opacity:0;","to":"o:1;","ease":"Power2.easeInOut"},{"delay":"+1900","speed":1000,"frame":"999","to":"y:50px;opacity:0;","ease":"Power4.easeIn"}]'
                                                            data-textAlign="['left','left','left','left']"
                                                            data-paddingtop="[0,0,0,0]" data-paddingright="[0,0,0,0]"
                                                            data-paddingbottom="[0,0,0,0]" data-paddingleft="[0,0,0,0]"
                                                            style="z-index: 14; white-space: nowrap; font-size: 16px; line-height: 22px; font-weight: 400; letter-spacing: ;font-family:Roboto Condensed;text-transform:uppercase;z-index:10;position:absolute;margin:0px;white-space:nowrap;">
                                                            <div class="rs-looped rs-slideloop"
                                                                 data-easing="linearEaseNone" data-speed="2" data-xs="0"
                                                                 data-xe="0" data-ys="0" data-ye="0">
                                                                <?php displayRandomElement($arPostTagsNames); ?>
                                                            </div>
                                                        </div>
                                                        <div
                                                            class="tp-caption Fashion-BigDisplay   tp-resizeme  tp-caption roboto_condensed_regular_16 sfb stb"
                                                            id="slide-49-layer-12" data-x="center" data-hoffset="-350"
                                                            data-y="center" data-voffset="270" data-width="['auto']"
                                                            data-height="['auto']" data-type="text"
                                                            data-responsive_offset="on"
                                                            data-frames='[{"delay":7000,"speed":600,"frame":"0","from":"y:50px;opacity:0;","to":"o:1;","ease":"Power4.easeOut"},{"delay":"+1400","speed":1000,"frame":"999","to":"y:50px;opacity:0;","ease":"Power4.easeIn"}]'
                                                            data-textAlign="['center','center','center','center']"
                                                            data-paddingtop="[0,0,0,0]" data-paddingright="[0,0,0,0]"
                                                            data-paddingbottom="[0,0,0,0]" data-paddingleft="[0,0,0,0]"
                                                            style="z-index: 15; white-space: nowrap; font-size: 16px; line-height: 22px; font-weight: 400; letter-spacing: px;font-family:Roboto Condensed;text-transform:uppercase;z-index:10;position:absolute;margin:0px;white-space:nowrap;">
                                                            <div class="rs-looped rs-slideloop" data-easing=""
                                                                 data-speed="2" data-xs="0" data-xe="0" data-ys="0"
                                                                 data-ye="0"><?php displayRandomElement($arPostTagsNames); ?>
                                                            </div>
                                                        </div>
                                                    </li>
                                                    <li data-index="rs-50" data-transition="cube" data-slotamount="10"
                                                        data-hideafterloop="0" data-hideslideonmobile="off"
                                                        data-easein="default" data-easeout="default"
                                                        data-masterspeed="500" data-delay="5000" data-rotate="0"
                                                        data-saveperformance="off" class="no-transition"
                                                        data-title="Slide" data-param1="" data-param2="" data-param3=""
                                                        data-param4="" data-param5="" data-param6="" data-param7=""
                                                        data-param8="" data-param9="" data-param10=""
                                                        data-description="">
                                                        <?php
                                                        $filename = getRandomElement($arProjectImages);
                                                        $new_filen = $_SERVER["DOCUMENT_ROOT"].'/wp-content/uploads/' . basename($filename);


                                                        $fileNew = "/wp-content/uploads/" . basename($filename);

                                                        $fileNew = cropImage($filename,
                                                            $_SERVER['DOCUMENT_ROOT'] . $fileNew,
                                                            2100, 1100);
                                                        ?>
                                                        <img
                                                            src="http://wpdemos.themezaa.com/h-code/wp-content/plugins/revslider/admin/assets/images/dummy.png"
                                                            alt="" title="intro-product-bg" width="2100" height="1100"
                                                            data-lazyload="<?php echo $fileNew; ?>"
                                                            data-bgposition="center bottom" data-bgfit="cover"
                                                            data-bgrepeat="no-repeat" class="rev-slidebg"
                                                            data-no-retina>
                                                        <div class="tp-caption   tp-resizeme  tp-caption fade fadeout"
                                                             id="slide-50-layer-1" data-x="center" data-hoffset="6"
                                                             data-y="center" data-voffset=""
                                                             data-width="['none','none','none','none']"
                                                             data-height="['none','none','none','none']"
                                                             data-type="image" data-responsive_offset="on"
                                                             data-frames='[{"from":"opacity:0;","speed":600,"to":"o:1;","delay":1500,"ease":"Power4.easeOut"},{"delay":1900,"speed":1000,"to":"opacity:0;","ease":"Power4.easeIn"}]'
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
                                                                1600, 700);
                                                            ?>
                                                            <img
                                                                src="http://wpdemos.themezaa.com/h-code/wp-content/plugins/revslider/admin/assets/images/dummy.png"
                                                                alt="" data-ww="1600px" data-hh="700px" width="1600"
                                                                height="700"
                                                                data-lazyload="<?php echo $fileNew; ?>"
                                                                data-no-retina></div>
                                                        <div
                                                            class="tp-caption Fashion-BigDisplay   tp-resizeme  tp-caption roboto_condensed_blod_60 sfb stb"
                                                            id="slide-50-layer-2" data-x="center" data-hoffset="29"
                                                            data-y="center" data-voffset="278" data-width="['auto']"
                                                            data-height="['auto']" data-type="text"
                                                            data-responsive_offset="on"
                                                            data-frames='[{"from":"opacity:0;","speed":600,"to":"o:1;","delay":2500,"ease":"Power2.easeInOut"},{"delay":900,"speed":1000,"to":"opacity:0;","ease":"Power4.easeIn"}]'
                                                            data-textAlign="['left','left','left','left']"
                                                            data-paddingtop="[0,0,0,0]" data-paddingright="[0,0,0,0]"
                                                            data-paddingbottom="[0,0,0,0]" data-paddingleft="[0,0,0,0]"
                                                            style="z-index: 62; white-space: nowrap; font-size: 210px; font-weight: 400; color: rgba(255,255,255,1);font-family:Roboto Condensed;text-transform:left;z-index:10;position:absolute;margin:0px;white-space:nowrap;">
                                                            <?php displayRandomElement($arPostTagsNames); ?>
                                                        </div>
                                                    </li>
                                                    <li data-index="rs-51" data-transition="cube" data-slotamount="11"
                                                        data-hideafterloop="0" data-hideslideonmobile="off"
                                                        data-easein="default" data-easeout="default"
                                                        data-masterspeed="500" data-delay="13000" data-rotate="0"
                                                        data-saveperformance="off" class="no-transition"
                                                        data-title="Slide" data-param1="" data-param2="" data-param3=""
                                                        data-param4="" data-param5="" data-param6="" data-param7=""
                                                        data-param8="" data-param9="" data-param10=""
                                                        data-description="">
                                                        <?php
                                                        $filename = getRandomElement($arProjectImages);
                                                        $new_filen = $_SERVER["DOCUMENT_ROOT"].'/wp-content/uploads/' . basename($filename);


                                                        $fileNew = "/wp-content/uploads/" . basename($filename);

                                                        $fileNew = cropImage($filename,
                                                            $_SERVER['DOCUMENT_ROOT'] . $fileNew,
                                                            2100, 1100);
                                                        ?>
                                                        <img
                                                            src="http://wpdemos.themezaa.com/h-code/wp-content/plugins/revslider/admin/assets/images/dummy.png"
                                                            alt="" title="intro-product-bg" width="2100" height="1100"
                                                            data-lazyload="<?php echo $fileNew; ?>"
                                                            data-bgposition="center bottom" data-bgfit="cover"
                                                            data-bgrepeat="no-repeat" class="rev-slidebg"
                                                            data-no-retina>
                                                        <div class="tp-caption   tp-resizeme  tp-caption sfl str"
                                                             id="slide-51-layer-1" data-x="center" data-hoffset="-564"
                                                             data-y="center" data-voffset=""
                                                             data-width="['none','none','none','none']"
                                                             data-height="['none','none','none','none']"
                                                             data-type="image" data-responsive_offset="on"
                                                             data-frames='[{"delay":1500,"speed":600,"frame":"0","from":"x:-50px;opacity:0;","to":"o:1;","ease":"Power4.easeOut"},{"delay":"+9900","speed":1000,"frame":"999","to":"x:-50px;opacity:0;","ease":"Power4.easeIn"}]'
                                                             data-textAlign="['left','left','left','left']"
                                                             data-paddingtop="[0,0,0,0]" data-paddingright="[0,0,0,0]"
                                                             data-paddingbottom="[0,0,0,0]" data-paddingleft="[0,0,0,0]"
                                                             style="z-index: 5;z-index:1;">
                                                            <?php
                                                            $filename = getRandomElement($arProjectImages);
                                                            $new_filen = $_SERVER["DOCUMENT_ROOT"].'/wp-content/uploads/' . basename($filename);


                                                            $fileNew = "/wp-content/uploads/" . basename($filename);

                                                            $fileNew = cropImage($filename,
                                                                $_SERVER['DOCUMENT_ROOT'] . $fileNew,
                                                                460, 700);
                                                            ?>
                                                            <img
                                                                src="http://wpdemos.themezaa.com/h-code/wp-content/plugins/revslider/admin/assets/images/dummy.png"
                                                                alt="" data-ww="460px" data-hh="700px" width="460"
                                                                height="700"
                                                                data-lazyload="<?php echo $fileNew; ?>"
                                                                data-no-retina></div>
                                                        <div class="tp-caption   tp-resizeme  tp-caption sfl str"
                                                             id="slide-51-layer-2" data-x="center" data-hoffset="-219"
                                                             data-y="center" data-voffset=""
                                                             data-width="['none','none','none','none']"
                                                             data-height="['none','none','none','none']"
                                                             data-type="image" data-responsive_offset="on"
                                                             data-frames='[{"delay":2000,"speed":600,"frame":"0","from":"x:-50px;opacity:0;","to":"o:1;","ease":"Power4.easeOut"},{"delay":"+9400","speed":1000,"frame":"999","to":"x:50px;opacity:0;","ease":"Power4.easeIn"}]'
                                                             data-textAlign="['left','left','left','left']"
                                                             data-paddingtop="[0,0,0,0]" data-paddingright="[0,0,0,0]"
                                                             data-paddingbottom="[0,0,0,0]" data-paddingleft="[0,0,0,0]"
                                                             style="z-index: 6;z-index:1;">
                                                            <?php
                                                            $filename = getRandomElement($arProjectImages);
                                                            $new_filen = $_SERVER["DOCUMENT_ROOT"].'/wp-content/uploads/' . basename($filename);


                                                            $fileNew = "/wp-content/uploads/" . basename($filename);

                                                            $fileNew = cropImage($filename,
                                                                $_SERVER['DOCUMENT_ROOT'] . $fileNew,
                                                                721, 700);
                                                            ?>
                                                            <img
                                                                src="http://wpdemos.themezaa.com/h-code/wp-content/plugins/revslider/admin/assets/images/dummy.png"
                                                                alt="" data-ww="721px" data-hh="700px" width="721"
                                                                height="700"
                                                                data-lazyload="<?php echo $fileNew; ?>"
                                                                data-no-retina></div>
                                                        <div class="tp-caption   tp-resizeme  tp-caption sfl str"
                                                             id="slide-51-layer-3" data-x="center" data-hoffset="254"
                                                             data-y="center" data-voffset=""
                                                             data-width="['none','none','none','none']"
                                                             data-height="['none','none','none','none']"
                                                             data-type="image" data-responsive_offset="on"
                                                             data-frames='[{"delay":2500,"speed":600,"frame":"0","from":"x:-50px;opacity:0;","to":"o:1;","ease":"Power4.easeOut"},{"delay":"+8900","speed":1000,"frame":"999","to":"x:50px;opacity:0;","ease":"Power4.easeIn"}]'
                                                             data-textAlign="['left','left','left','left']"
                                                             data-paddingtop="[0,0,0,0]" data-paddingright="[0,0,0,0]"
                                                             data-paddingbottom="[0,0,0,0]" data-paddingleft="[0,0,0,0]"
                                                             style="z-index: 7;z-index:1;">
                                                            <?php
                                                            $filename = getRandomElement($arProjectImages);
                                                            $new_filen = $_SERVER["DOCUMENT_ROOT"].'/wp-content/uploads/' . basename($filename);


                                                            $fileNew = "/wp-content/uploads/" . basename($filename);

                                                            $fileNew = cropImage($filename,
                                                                $_SERVER['DOCUMENT_ROOT'] . $fileNew,
                                                                721, 700);
                                                            ?>
                                                            <img
                                                                src="http://wpdemos.themezaa.com/h-code/wp-content/plugins/revslider/admin/assets/images/dummy.png"
                                                                alt="" data-ww="721px" data-hh="700px" width="721"
                                                                height="700"
                                                                data-lazyload="<?php echo $fileNew; ?>"
                                                                data-no-retina></div>
                                                        <div class="tp-caption   tp-resizeme  tp-caption sfl str"
                                                             id="slide-51-layer-4" data-x="center" data-hoffset="584"
                                                             data-y="center" data-voffset=""
                                                             data-width="['none','none','none','none']"
                                                             data-height="['none','none','none','none']"
                                                             data-type="image" data-responsive_offset="on"
                                                             data-frames='[{"delay":3000,"speed":600,"frame":"0","from":"x:-50px;opacity:0;","to":"o:1;","ease":"Power4.easeOut"},{"delay":"+8400","speed":1000,"frame":"999","to":"x:50px;opacity:0;","ease":"Power4.easeIn"}]'
                                                             data-textAlign="['left','left','left','left']"
                                                             data-paddingtop="[0,0,0,0]" data-paddingright="[0,0,0,0]"
                                                             data-paddingbottom="[0,0,0,0]" data-paddingleft="[0,0,0,0]"
                                                             style="z-index: 8;z-index:1;">
                                                            <?php
                                                            $filename = getRandomElement($arProjectImages);
                                                            $new_filen = $_SERVER["DOCUMENT_ROOT"].'/wp-content/uploads/' . basename($filename);


                                                            $fileNew = "/wp-content/uploads/" . basename($filename);

                                                            $fileNew = cropImage($filename,
                                                                $_SERVER['DOCUMENT_ROOT'] . $fileNew,
                                                                444, 700);
                                                            ?>
                                                            <img
                                                                src="http://wpdemos.themezaa.com/h-code/wp-content/plugins/revslider/admin/assets/images/dummy.png"
                                                                alt="" data-ww="444px" data-hh="700px" width="444"
                                                                height="700"
                                                                data-lazyload="http://wpdemos.themezaa.com/h-code/wp-content/uploads/2015/10/intro-product-11-04.png"
                                                                data-no-retina></div>
                                                        <div class="tp-caption   tp-resizeme  tp-caption fade fadeout"
                                                             id="slide-51-layer-5" data-x="center" data-hoffset="6"
                                                             data-y="center" data-voffset=""
                                                             data-width="['none','none','none','none']"
                                                             data-height="['none','none','none','none']"
                                                             data-type="image" data-responsive_offset="on"
                                                             data-frames='[{"delay":3500,"speed":600,"frame":"0","from":"opacity:0;","to":"o:1;","ease":"Power4.easeOut"},{"delay":"+7900","speed":1000,"frame":"999","to":"opacity:0;","ease":"Power4.easeIn"}]'
                                                             data-textAlign="['left','left','left','left']"
                                                             data-paddingtop="[0,0,0,0]" data-paddingright="[0,0,0,0]"
                                                             data-paddingbottom="[0,0,0,0]" data-paddingleft="[0,0,0,0]"
                                                             style="z-index: 9;z-index:1;">
                                                            <?php
                                                            $filename = getRandomElement($arProjectImages);
                                                            $new_filen = $_SERVER["DOCUMENT_ROOT"].'/wp-content/uploads/' . basename($filename);


                                                            $fileNew = "/wp-content/uploads/" . basename($filename);

                                                            $fileNew = cropImage($filename,
                                                                $_SERVER['DOCUMENT_ROOT'] . $fileNew,
                                                                1600, 700);
                                                            ?>
                                                            <img
                                                                src="http://wpdemos.themezaa.com/h-code/wp-content/plugins/revslider/admin/assets/images/dummy.png"
                                                                alt="" data-ww="1600px" data-hh="700px" width="1600"
                                                                height="700"
                                                                data-lazyload="<?php echo $fileNew; ?>"
                                                                data-no-retina></div>
                                                        <div
                                                            class="tp-caption Fashion-BigDisplay   tp-resizeme  tp-caption roboto_condensed_regular_16 sfb stb"
                                                            id="slide-51-layer-6" data-x="center" data-hoffset=""
                                                            data-y="center" data-voffset="160" data-width="['auto']"
                                                            data-height="['auto']" data-type="text"
                                                            data-responsive_offset="on"
                                                            data-frames='[{"delay":4000,"speed":300,"frame":"0","from":"y:50px;opacity:0;","to":"o:1;","ease":"Power4.easeOut"},{"delay":"wait","speed":300,"frame":"999","to":"y:50px;opacity:0;","ease":"Power4.easeIn"}]'
                                                            data-textAlign="['center','center','center','center']"
                                                            data-paddingtop="[0,0,0,0]" data-paddingright="[0,0,0,0]"
                                                            data-paddingbottom="[0,0,0,0]" data-paddingleft="[0,0,0,0]"
                                                            style="z-index: 10; white-space: nowrap; font-size: 16px; line-height: 22px; font-weight: 400; color: rgba(255,255,255,1); letter-spacing: px;font-family:Roboto Condensed;text-transform:uppercase;z-index:10;position:absolute;margin:0px;white-space:nowrap;">
                                                            <?php displayRandomElement($arPostTagsNames); ?>
                                                        </div>
                                                        <div
                                                            class="tp-caption Fashion-BigDisplay   tp-resizeme  tp-caption roboto_condensed_blod_26 sfb stb"
                                                            id="slide-51-layer-7" data-x="center" data-hoffset=""
                                                            data-y="center" data-voffset="222" data-width="['auto']"
                                                            data-height="['auto']" data-type="text"
                                                            data-responsive_offset="on"
                                                            data-frames='[{"delay":4500,"speed":600,"frame":"0","from":"y:50px;opacity:0;","to":"o:1;","ease":"Power4.easeOut"},{"delay":"+1900","speed":1000,"frame":"999","to":"y:50px;opacity:0;","ease":"Power4.easeIn"}]'
                                                            data-textAlign="['center','center','center','center']"
                                                            data-paddingtop="[0,0,0,0]" data-paddingright="[0,0,0,0]"
                                                            data-paddingbottom="[0,0,0,0]" data-paddingleft="[0,0,0,0]"
                                                            style="z-index: 11; white-space: nowrap; font-size: 26px; line-height: 30px; font-weight: 300; color: rgba(255,255,255,1); letter-spacing: px;font-family:Roboto Condensed;text-transform:uppercase;z-index:11;position:absolute;text-align:center;margin:0px;white-space:nowrap;letter-spacing:normal;">
                                                            <?php displayRandomElement($arPostTagsNames); ?>
                                                        </div>
                                                        <div
                                                            class="tp-caption Fashion-BigDisplay   tp-resizeme  tp-caption roboto_condensed_regular_16 sfb stb"
                                                            id="slide-51-layer-8" data-x="center" data-hoffset=""
                                                            data-y="center" data-voffset="280" data-width="['auto']"
                                                            data-height="['auto']" data-type="text"
                                                            data-responsive_offset="on"
                                                            data-frames='[{"delay":5000,"speed":600,"frame":"0","from":"y:50px;opacity:0;","to":"o:1;","ease":"Power4.easeOut"},{"delay":"+1400","speed":1000,"frame":"999","to":"y:50px;opacity:0;","ease":"Power4.easeIn"}]'
                                                            data-textAlign="['center','center','center','center']"
                                                            data-paddingtop="[0,0,0,0]" data-paddingright="[0,0,0,0]"
                                                            data-paddingbottom="[0,0,0,0]" data-paddingleft="[0,0,0,0]"
                                                            style="z-index: 12; white-space: nowrap; font-size: 16px; line-height: 22px; font-weight: 400; color: rgba(255,255,255,1); letter-spacing: px;font-family:Roboto Condensed;text-transform:uppercase;z-index:10;position:absolute;margin:0px;white-space:nowrap;letter-spacing:normal;">
                                                            <?php displayRandomElement($arPostTagsNames); ?>
                                                        </div>
                                                        <div
                                                            class="tp-caption Fashion-BigDisplay   tp-resizeme  tp-caption roboto_condensed_blod_60 sfb stb"
                                                            id="slide-51-layer-9" data-x="center" data-hoffset=""
                                                            data-y="center" data-voffset="250" data-width="['auto']"
                                                            data-height="['auto']" data-type="text"
                                                            data-responsive_offset="on"
                                                            data-frames='[{"delay":8500,"speed":600,"frame":"0","from":"y:50px;opacity:0;","to":"o:1;","ease":"Power4.easeOut"},{"delay":"+2900","speed":1000,"frame":"999","to":"y:50px;opacity:0;","ease":"Power4.easeIn"}]'
                                                            data-textAlign="['center','center','center','center']"
                                                            data-paddingtop="[0,0,0,0]" data-paddingright="[0,0,0,0]"
                                                            data-paddingbottom="[0,0,0,0]" data-paddingleft="[0,0,0,0]"
                                                            style="z-index: 13; white-space: nowrap; font-weight: 700; color: rgba(255,255,255,1); letter-spacing: px;font-family:Roboto Condensed;text-transform:uppercase;z-index:10;text-align:center;position:absolute;margin:0px;white-space:nowrap;">
                                                            <?php displayRandomElement($arPostTagsNames); ?>
                                                        </div>
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
                                                        e.c = jQuery('#rev_slider_10_1');
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
                                                var revapi10;
                                                tpj(document).ready(function () {
                                                    if (tpj("#rev_slider_10_1").revolution == undefined) {
                                                        revslider_showDoubleJqueryError("#rev_slider_10_1");
                                                    } else {
                                                        revapi10 = tpj("#rev_slider_10_1").show().revolution({
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
                                                            lazyType: "all",
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
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="wpb_column hcode-column-container  col-xs-mobile-fullwidth">
                                <div class="vc-column-innner-wrapper">
                                    <div class="logo-product"
                                         style="position: absolute; bottom: 0; padding: 0 0 2.9% 8.8%; z-index: 20;">
                                        <img class=""
                                             src="<?php echo PERSONAL_WP_HCODE_URL; ?>/h-code/wp-content/themes/h-code/assets/images/intro-product-logo.png"
                                             alt=""/>
                                        <?php if($ProjectURL){ ?>
                                            <a href="<?php echo $ProjectURL; ?>" target="_blank">
                                                    <?php echo $ProjectURL; ?>
                                                </a>
                                        <?php } ?>
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
