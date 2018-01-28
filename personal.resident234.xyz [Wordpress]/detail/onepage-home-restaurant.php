<?php
/**
 * Created by PhpStorm.
 * User: GSU
 * Date: 29.07.2017
 * Time: 15:36
 */

require $_SERVER['DOCUMENT_ROOT'] . '/wp-load.php';
include $_SERVER['DOCUMENT_ROOT'] . '/includes/head.php';

global $wpdb;
$wpdb->set_prefix('portfolio_');

include $_SERVER['DOCUMENT_ROOT'] . '/includes/head_detail.php';

if($_POST["_wpcf7"]){

    $attachments = array();
    $headers = 'From: Персональный сайт <null@'.$_SERVER["SERVER_NAME"].'>' . "\r\n";
    $body = "Имя: ".$_POST["your-name"]."\r\n";
    $body = $body."E-mail: ".$_POST["email-771"]."\r\n";
    $body = $body."Тип будущего сайта: ".$_POST["menu-272"]."\r\n";
    $body = $body."Есть ли наработки или корпоративный стиль, который нужно применить: ".$_POST["menu-838"]."\r\n";
    //
    //


    wp_mail('gsu1234@mail.ru', 'Новый заказ на разработку проекта', $body, $headers, $attachments);

    die();

}
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
<body class="page-template-default page page-id-48 wpb-js-composer js-comp-ver-5.1 vc_responsive">
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
                    <ul id="menu-onepage-restaurant" class="mega-menu-ul nav navbar-nav navbar-right panel-group">
                        <?php
                        include $_SERVER['DOCUMENT_ROOT'] . '/includes/main_menu.php';
                        ?>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</nav>
<section class="parent-section no-padding post-48 page type-page status-publish hentry">
    <div class="container-fluid">
        <div class="row">
            <div class="entry-content">
                <section id="myCarousel" class="  no-padding">
                    <div class="container-fluid">
                        <div class="row">
                            <div class="wpb_column hcode-column-container  col-xs-mobile-fullwidth">
                                <div class="vc-column-innner-wrapper">
                                    <div class="wpb_revslider_element wpb_content_element">
                                        <link href="http://fonts.googleapis.com/css?family=Oswald:400|Open+Sans:400"
                                              rel="stylesheet" property="stylesheet" type="text/css" media="all">
                                        <div id="rev_slider_47_1_wrapper"
                                             class="rev_slider_wrapper fullscreen-container" data-source="gallery"
                                             style="background:transparent;padding:0px;">
                                            <div id="rev_slider_47_1" class="rev_slider fullscreenbanner"
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
                                                    <li data-index="rs-233" data-transition="random" data-slotamount="1"
                                                        data-hideafterloop="0" data-hideslideonmobile="off"
                                                        data-easein="default" data-easeout="default"
                                                        data-masterspeed="1000"
                                                        data-thumb="<?php echo $fileNew; ?>"
                                                        data-delay="13000" data-rotate="0" data-fstransition="fade"
                                                        data-fsmasterspeed="300" data-fsslotamount="7"
                                                        data-saveperformance="off" class="no-transition"
                                                        data-title="блок 1" data-param1="" data-param2=""
                                                        data-param3="" data-param4="" data-param5="" data-param6=""
                                                        data-param7="" data-param8="" data-param9="" data-param10=""
                                                        data-description="">


                                                        <?php
                                                        $filename = getRandomElement($arProjectAllImages);

                                                        ?>
                                                        <img
                                                            src="http://wpdemos.themezaa.com/h-code/wp-content/plugins/revslider/admin/assets/images/dummy.png"
                                                            alt="" title="Onepage Home restaurant"
                                                            data-lazyload="<?php echo $filename; ?>"
                                                            data-bgposition="center center" data-bgfit="cover"
                                                            data-bgrepeat="no-repeat" class="rev-slidebg"
                                                            data-no-retina>
                                                        <div class="tp-caption   tp-resizeme  tp-caption sfb stb"
                                                             id="slide-233-layer-1" data-x="center" data-hoffset=""
                                                             data-y="center" data-voffset="343"
                                                             data-width="['none','none','none','none']"
                                                             data-height="['none','none','none','none']"
                                                             data-type="image" data-responsive_offset="on"
                                                             data-frames='[{"from":"y:50px;opacity:0;","speed":500,"to":"o:1;","delay":1500,"ease":"Power3.easeInOut"},{"delay":10500,"speed":500,"to":"y:50px;opacity:0;","ease":"nothing"}]'
                                                             data-textAlign="['left','left','left','left']"
                                                             data-paddingtop="[0,0,0,0]" data-paddingright="[0,0,0,0]"
                                                             data-paddingbottom="[0,0,0,0]" data-paddingleft="[0,0,0,0]"
                                                             style="z-index: 5;text-transform:left;z-index:50;">

                                                            <?php
                                                            $filename = getRandomElement($arProjectImages);
                                                            $new_filen = $_SERVER["DOCUMENT_ROOT"].'/wp-content/uploads/' . basename($filename);


                                                            $fileNew = "/wp-content/uploads/" . basename($filename);

                                                            $fileNew = cropImage($filename,
                                                                $_SERVER['DOCUMENT_ROOT'] . $fileNew,
                                                                197, 206);

                                                            ?>
                                                            <img
                                                                src="http://wpdemos.themezaa.com/h-code/wp-content/plugins/revslider/admin/assets/images/dummy.png"
                                                                alt="" data-ww="197px" data-hh="206px" width="197"
                                                                height="206"
                                                                data-lazyload="<?php echo $fileNew; ?>"
                                                                data-no-retina></div>
                                                        <div
                                                            class="tp-caption   tp-resizeme  tp-caption  tp-resizeme sfb stb"
                                                            id="slide-233-layer-2" data-x="center" data-hoffset="-80"
                                                            data-y="center" data-voffset="445"
                                                            data-width="['none','none','none','none']"
                                                            data-height="['none','none','none','none']"
                                                            data-type="image" data-responsive_offset="on"
                                                            data-frames='[{"from":"y:50px;opacity:0;","speed":500,"to":"o:1;","delay":1800,"ease":"Power3.easeInOut"},{"delay":10200,"speed":500,"to":"y:50px;opacity:0;","ease":"nothing"}]'
                                                            data-textAlign="['left','left','left','left']"
                                                            data-paddingtop="[0,0,0,0]" data-paddingright="[0,0,0,0]"
                                                            data-paddingbottom="[0,0,0,0]" data-paddingleft="[0,0,0,0]"
                                                            style="z-index: 6;text-transform:left;z-index:49;">
                                                            <?php
                                                            $filename = getRandomElement($arProjectImages);
                                                            $new_filen = $_SERVER["DOCUMENT_ROOT"].'/wp-content/uploads/' . basename($filename);


                                                            $fileNew = "/wp-content/uploads/" . basename($filename);

                                                            $fileNew = cropImage($filename,
                                                                $_SERVER['DOCUMENT_ROOT'] . $fileNew,
                                                                89, 91);

                                                            ?>
                                                            <img
                                                                src="http://wpdemos.themezaa.com/h-code/wp-content/plugins/revslider/admin/assets/images/dummy.png"
                                                                alt="" data-ww="89px" data-hh="91px" width="89"
                                                                height="91"
                                                                data-lazyload="<?php echo $fileNew; ?>"
                                                                data-no-retina></div>
                                                        <div
                                                            class="tp-caption   tp-resizeme  tp-caption tp-resizeme sfb stb"
                                                            id="slide-233-layer-3" data-x="center" data-hoffset="50"
                                                            data-y="center" data-voffset="445"
                                                            data-width="['none','none','none','none']"
                                                            data-height="['none','none','none','none']"
                                                            data-type="image" data-responsive_offset="on"
                                                            data-frames='[{"from":"y:50px;opacity:0;","speed":500,"to":"o:1;","delay":2100,"ease":"Power3.easeInOut"},{"delay":9900,"speed":500,"to":"y:50px;opacity:0;","ease":"nothing"}]'
                                                            data-textAlign="['left','left','left','left']"
                                                            data-paddingtop="[0,0,0,0]" data-paddingright="[0,0,0,0]"
                                                            data-paddingbottom="[0,0,0,0]" data-paddingleft="[0,0,0,0]"
                                                            style="z-index: 7;text-transform:left;z-index:48;">
                                                            <?php
                                                            $filename = getRandomElement($arProjectImages);
                                                            $new_filen = $_SERVER["DOCUMENT_ROOT"].'/wp-content/uploads/' . basename($filename);


                                                            $fileNew = "/wp-content/uploads/" . basename($filename);

                                                            $fileNew = cropImage($filename,
                                                                $_SERVER['DOCUMENT_ROOT'] . $fileNew,
                                                                111, 137);

                                                            ?>
                                                            <img
                                                                src="http://wpdemos.themezaa.com/h-code/wp-content/plugins/revslider/admin/assets/images/dummy.png"
                                                                alt="" data-ww="111px" data-hh="137px" width="111"
                                                                height="137"
                                                                data-lazyload="<?php echo $fileNew; ?>"
                                                                data-no-retina></div>
                                                        <div
                                                            class="tp-caption   tp-resizeme  tp-caption tp-resizeme sfr str"
                                                            id="slide-233-layer-4" data-x="center" data-hoffset="136"
                                                            data-y="center" data-voffset="333"
                                                            data-width="['none','none','none','none']"
                                                            data-height="['none','none','none','none']"
                                                            data-type="image" data-responsive_offset="on"
                                                            data-frames='[{"from":"x:50px;opacity:0;","speed":500,"to":"o:1;","delay":2300,"ease":"Power3.easeInOut"},{"delay":9700,"speed":500,"to":"x:50px;opacity:0;","ease":"nothing"}]'
                                                            data-textAlign="['left','left','left','left']"
                                                            data-paddingtop="[0,0,0,0]" data-paddingright="[0,0,0,0]"
                                                            data-paddingbottom="[0,0,0,0]" data-paddingleft="[0,0,0,0]"
                                                            style="z-index: 8;text-transform:left;z-index:47;">
                                                            <?php
                                                            $filename = getRandomElement($arProjectImages);
                                                            $new_filen = $_SERVER["DOCUMENT_ROOT"].'/wp-content/uploads/' . basename($filename);


                                                            $fileNew = "/wp-content/uploads/" . basename($filename);

                                                            $fileNew = cropImage($filename,
                                                                $_SERVER['DOCUMENT_ROOT'] . $fileNew,
                                                                106, 104);

                                                            ?>
                                                            <img
                                                                src="http://wpdemos.themezaa.com/h-code/wp-content/plugins/revslider/admin/assets/images/dummy.png"
                                                                alt="" data-ww="106px" data-hh="104px" width="106"
                                                                height="104"
                                                                data-lazyload="<?php echo $fileNew; ?>"
                                                                data-no-retina></div>
                                                        <div
                                                            class="tp-caption   tp-resizeme  tp-caption tp-resizeme sfr str"
                                                            id="slide-233-layer-5" data-x="center" data-hoffset="217"
                                                            data-y="center" data-voffset="230"
                                                            data-width="['none','none','none','none']"
                                                            data-height="['none','none','none','none']"
                                                            data-type="image" data-responsive_offset="on"
                                                            data-frames='[{"from":"opacity:0;","speed":500,"to":"o:1;","delay":2600,"ease":"Power3.easeInOut"},{"delay":9400,"speed":500,"to":"opacity:0;","ease":"nothing"}]'
                                                            data-textAlign="['left','left','left','left']"
                                                            data-paddingtop="[0,0,0,0]" data-paddingright="[0,0,0,0]"
                                                            data-paddingbottom="[0,0,0,0]" data-paddingleft="[0,0,0,0]"
                                                            style="z-index: 9;text-transform:left;z-index:46;">
                                                            <?php
                                                            $filename = getRandomElement($arProjectImages);
                                                            $new_filen = $_SERVER["DOCUMENT_ROOT"].'/wp-content/uploads/' . basename($filename);


                                                            $fileNew = "/wp-content/uploads/" . basename($filename);

                                                            $fileNew = cropImage($filename,
                                                                $_SERVER['DOCUMENT_ROOT'] . $fileNew,
                                                                117, 106);

                                                            ?>
                                                            <img
                                                                src="http://wpdemos.themezaa.com/h-code/wp-content/plugins/revslider/admin/assets/images/dummy.png"
                                                                alt="" data-ww="117px" data-hh="106px" width="117"
                                                                height="106"
                                                                data-lazyload="<?php echo $fileNew; ?>"
                                                                data-no-retina></div>
                                                        <div class="tp-caption   tp-resizeme" id="slide-233-layer-6"
                                                             data-x="center" data-hoffset="271" data-y="center"
                                                             data-voffset="135"
                                                             data-width="['none','none','none','none']"
                                                             data-height="['none','none','none','none']"
                                                             data-type="image" data-responsive_offset="on"
                                                             data-frames='[{"from":"x:50px;opacity:0;","speed":500,"to":"o:1;","delay":2900,"ease":"Power3.easeInOut"},{"delay":9100,"speed":500,"to":"x:50px;opacity:0;","ease":"nothing"}]'
                                                             data-textAlign="['left','left','left','left']"
                                                             data-paddingtop="[0,0,0,0]" data-paddingright="[0,0,0,0]"
                                                             data-paddingbottom="[0,0,0,0]" data-paddingleft="[0,0,0,0]"
                                                             style="z-index: 10;text-transform:left;z-index:46;">
                                                            <?php
                                                            $filename = getRandomElement($arProjectImages);
                                                            $new_filen = $_SERVER["DOCUMENT_ROOT"].'/wp-content/uploads/' . basename($filename);


                                                            $fileNew = "/wp-content/uploads/" . basename($filename);

                                                            $fileNew = cropImage($filename,
                                                                $_SERVER['DOCUMENT_ROOT'] . $fileNew,
                                                                110, 112);

                                                            ?>
                                                            <img
                                                                src="http://wpdemos.themezaa.com/h-code/wp-content/plugins/revslider/admin/assets/images/dummy.png"
                                                                alt="" data-ww="110px" data-hh="112px" width="110"
                                                                height="112"
                                                                data-lazyload="<?php echo $fileNew; ?>"
                                                                data-no-retina></div>
                                                        <div
                                                            class="tp-caption   tp-resizeme  tp-caption tp-resizeme sfr str"
                                                            id="slide-233-layer-7" data-x="center" data-hoffset="394"
                                                            data-y="center" data-voffset="148"
                                                            data-width="['none','none','none','none']"
                                                            data-height="['none','none','none','none']"
                                                            data-type="image" data-responsive_offset="on"
                                                            data-frames='[{"from":"x:50px;opacity:0;","speed":500,"to":"o:1;","delay":3200,"ease":"Power3.easeInOut"},{"delay":8800,"speed":500,"to":"x:50px;opacity:0;","ease":"nothing"}]'
                                                            data-textAlign="['left','left','left','left']"
                                                            data-paddingtop="[0,0,0,0]" data-paddingright="[0,0,0,0]"
                                                            data-paddingbottom="[0,0,0,0]" data-paddingleft="[0,0,0,0]"
                                                            style="z-index: 11;text-transform:left;z-index:46;">
                                                            <?php
                                                            $filename = getRandomElement($arProjectImages);
                                                            $new_filen = $_SERVER["DOCUMENT_ROOT"].'/wp-content/uploads/' . basename($filename);


                                                            $fileNew = "/wp-content/uploads/" . basename($filename);

                                                            $fileNew = cropImage($filename,
                                                                $_SERVER['DOCUMENT_ROOT'] . $fileNew,
                                                                112, 106);

                                                            ?>
                                                            <img
                                                                src="http://wpdemos.themezaa.com/h-code/wp-content/plugins/revslider/admin/assets/images/dummy.png"
                                                                alt="" data-ww="112px" data-hh="106px" width="112"
                                                                height="106"
                                                                data-lazyload="<?php echo $fileNew; ?>"
                                                                data-no-retina></div>
                                                        <div
                                                            class="tp-caption   tp-resizeme  tp-caption tp-resizeme sfr str"
                                                            id="slide-233-layer-8" data-x="center" data-hoffset="331"
                                                            data-y="center" data-voffset="238"
                                                            data-width="['none','none','none','none']"
                                                            data-height="['none','none','none','none']"
                                                            data-type="image" data-responsive_offset="on"
                                                            data-frames='[{"from":"x:50px;opacity:0;","speed":500,"to":"o:1;","delay":3500,"ease":"Power3.easeInOut"},{"delay":8500,"speed":500,"to":"x:50px;opacity:0;","ease":"nothing"}]'
                                                            data-textAlign="['left','left','left','left']"
                                                            data-paddingtop="[0,0,0,0]" data-paddingright="[0,0,0,0]"
                                                            data-paddingbottom="[0,0,0,0]" data-paddingleft="[0,0,0,0]"
                                                            style="z-index: 12;text-transform:left;z-index:46;">
                                                            <?php
                                                            $filename = getRandomElement($arProjectImages);
                                                            $new_filen = $_SERVER["DOCUMENT_ROOT"].'/wp-content/uploads/' . basename($filename);


                                                            $fileNew = "/wp-content/uploads/" . basename($filename);

                                                            $fileNew = cropImage($filename,
                                                                $_SERVER['DOCUMENT_ROOT'] . $fileNew,
                                                                113, 106);

                                                            ?>
                                                            <img
                                                                src="http://wpdemos.themezaa.com/h-code/wp-content/plugins/revslider/admin/assets/images/dummy.png"
                                                                alt="" data-ww="113px" data-hh="106px" width="113"
                                                                height="106"
                                                                data-lazyload="<?php echo $fileNew; ?>"
                                                                data-no-retina></div>
                                                        <div
                                                            class="tp-caption   tp-resizeme  tp-caption tp-resizeme sfr str"
                                                            id="slide-233-layer-9" data-x="center" data-hoffset="256"
                                                            data-y="center" data-voffset="325"
                                                            data-width="['none','none','none','none']"
                                                            data-height="['none','none','none','none']"
                                                            data-type="image" data-responsive_offset="on"
                                                            data-frames='[{"from":"x:50px;opacity:0;","speed":500,"to":"o:1;","delay":3800,"ease":"Power3.easeInOut"},{"delay":8200,"speed":500,"to":"x:50px;opacity:0;","ease":"nothing"}]'
                                                            data-textAlign="['left','left','left','left']"
                                                            data-paddingtop="[0,0,0,0]" data-paddingright="[0,0,0,0]"
                                                            data-paddingbottom="[0,0,0,0]" data-paddingleft="[0,0,0,0]"
                                                            style="z-index: 13;text-transform:left;z-index:46;">
                                                            <?php
                                                            $filename = getRandomElement($arProjectImages);
                                                            $new_filen = $_SERVER["DOCUMENT_ROOT"].'/wp-content/uploads/' . basename($filename);


                                                            $fileNew = "/wp-content/uploads/" . basename($filename);

                                                            $fileNew = cropImage($filename,
                                                                $_SERVER['DOCUMENT_ROOT'] . $fileNew,
                                                                108, 103);

                                                            ?>
                                                            <img
                                                                src="http://wpdemos.themezaa.com/h-code/wp-content/plugins/revslider/admin/assets/images/dummy.png"
                                                                alt="" data-ww="108px" data-hh="103px" width="108"
                                                                height="103"
                                                                data-lazyload="<?php echo $fileNew; ?>"
                                                                data-no-retina></div>
                                                        <div
                                                            class="tp-caption   tp-resizeme  tp-caption tp-resizeme sfr str"
                                                            id="slide-233-layer-10" data-x="center" data-hoffset="200"
                                                            data-y="center" data-voffset="419"
                                                            data-width="['none','none','none','none']"
                                                            data-height="['none','none','none','none']"
                                                            data-type="image" data-responsive_offset="on"
                                                            data-frames='[{"from":"opacity:0;","speed":500,"to":"o:1;","delay":4100,"ease":"Power3.easeInOut"},{"delay":7900,"speed":500,"to":"opacity:0;","ease":"nothing"}]'
                                                            data-textAlign="['left','left','left','left']"
                                                            data-paddingtop="[0,0,0,0]" data-paddingright="[0,0,0,0]"
                                                            data-paddingbottom="[0,0,0,0]" data-paddingleft="[0,0,0,0]"
                                                            style="z-index: 14;text-transform:left;z-index:46;">
                                                            <?php
                                                            $filename = getRandomElement($arProjectImages);
                                                            $new_filen = $_SERVER["DOCUMENT_ROOT"].'/wp-content/uploads/' . basename($filename);


                                                            $fileNew = "/wp-content/uploads/" . basename($filename);

                                                            $fileNew = cropImage($filename,
                                                                $_SERVER['DOCUMENT_ROOT'] . $fileNew,
                                                                105, 102);

                                                            ?>
                                                            <img
                                                                src="http://wpdemos.themezaa.com/h-code/wp-content/plugins/revslider/admin/assets/images/dummy.png"
                                                                alt="" data-ww="105px" data-hh="102px" width="105"
                                                                height="102"
                                                                data-lazyload="<?php echo $fileNew; ?>"
                                                                data-no-retina></div>
                                                        <div class="tp-caption   tp-resizeme  tp-caption tp-resizeme"
                                                             id="slide-233-layer-11" data-x="center" data-hoffset="280"
                                                             data-y="center" data-voffset="270"
                                                             data-width="['none','none','none','none']"
                                                             data-height="['none','none','none','none']"
                                                             data-type="image" data-responsive_offset="on"
                                                             data-frames='[{"from":"y:50px;opacity:0;","speed":500,"to":"o:1;","delay":4300,"ease":"Power3.easeInOut"},{"delay":7700,"speed":500,"to":"y:50px;opacity:0;","ease":"nothing"}]'
                                                             data-textAlign="['left','left','left','left']"
                                                             data-paddingtop="[0,0,0,0]" data-paddingright="[0,0,0,0]"
                                                             data-paddingbottom="[0,0,0,0]" data-paddingleft="[0,0,0,0]"
                                                             style="z-index: 15;text-transform:left;z-index:45;">
                                                            <?php
                                                            $filename = getRandomElement($arProjectImages);
                                                            $new_filen = $_SERVER["DOCUMENT_ROOT"].'/wp-content/uploads/' . basename($filename);


                                                            $fileNew = "/wp-content/uploads/" . basename($filename);

                                                            $fileNew = cropImage($filename,
                                                                $_SERVER['DOCUMENT_ROOT'] . $fileNew,
                                                                454, 444);

                                                            ?>
                                                            <img
                                                                src="http://wpdemos.themezaa.com/h-code/wp-content/plugins/revslider/admin/assets/images/dummy.png"
                                                                alt="" data-ww="454px" data-hh="444px" width="454"
                                                                height="444"
                                                                data-lazyload="<?php echo $fileNew; ?>"
                                                                data-no-retina></div>
                                                        <div class="tp-caption   tp-resizeme  tp-caption tp-resizeme"
                                                             id="slide-233-layer-12" data-x="center" data-hoffset="314"
                                                             data-y="center" data-voffset="306"
                                                             data-width="['none','none','none','none']"
                                                             data-height="['none','none','none','none']"
                                                             data-type="image" data-responsive_offset="on"
                                                             data-frames='[{"from":"opacity:0;","speed":500,"to":"o:1;","delay":4600,"ease":"Power3.easeInOut"},{"delay":7400,"speed":500,"to":"opacity:0;","ease":"nothing"}]'
                                                             data-textAlign="['left','left','left','left']"
                                                             data-paddingtop="[0,0,0,0]" data-paddingright="[0,0,0,0]"
                                                             data-paddingbottom="[0,0,0,0]" data-paddingleft="[0,0,0,0]"
                                                             style="z-index: 16;text-transform:left;z-index:45;">
                                                            <?php
                                                            $filename = getRandomElement($arProjectImages);
                                                            $new_filen = $_SERVER["DOCUMENT_ROOT"].'/wp-content/uploads/' . basename($filename);


                                                            $fileNew = "/wp-content/uploads/" . basename($filename);

                                                            $fileNew = cropImage($filename,
                                                                $_SERVER['DOCUMENT_ROOT'] . $fileNew,
                                                                367, 304);

                                                            ?>
                                                            <img
                                                                src="http://wpdemos.themezaa.com/h-code/wp-content/plugins/revslider/admin/assets/images/dummy.png"
                                                                alt="" data-ww="367px" data-hh="304px" width="367"
                                                                height="304"
                                                                data-lazyload="<?php echo $fileNew; ?>"
                                                                data-no-retina></div>
                                                        <div
                                                            class="tp-caption   tp-resizeme  tp-caption tp-resizeme sfr str"
                                                            id="slide-233-layer-13" data-x="center" data-hoffset="477"
                                                            data-y="center" data-voffset="57"
                                                            data-width="['none','none','none','none']"
                                                            data-height="['none','none','none','none']"
                                                            data-type="image" data-responsive_offset="on"
                                                            data-frames='[{"from":"x:50px;opacity:0;","speed":500,"to":"o:1;","delay":4900,"ease":"Power3.easeInOut"},{"delay":7100,"speed":500,"to":"x:50px;opacity:0;","ease":"nothing"}]'
                                                            data-textAlign="['left','left','left','left']"
                                                            data-paddingtop="[0,0,0,0]" data-paddingright="[0,0,0,0]"
                                                            data-paddingbottom="[0,0,0,0]" data-paddingleft="[0,0,0,0]"
                                                            style="z-index: 17;text-transform:left;z-index:45;">
                                                            <?php
                                                            $filename = getRandomElement($arProjectImages);
                                                            $new_filen = $_SERVER["DOCUMENT_ROOT"].'/wp-content/uploads/' . basename($filename);


                                                            $fileNew = "/wp-content/uploads/" . basename($filename);

                                                            $fileNew = cropImage($filename,
                                                                $_SERVER['DOCUMENT_ROOT'] . $fileNew,
                                                                169, 136);

                                                            ?>
                                                            <img
                                                                src="http://wpdemos.themezaa.com/h-code/wp-content/plugins/revslider/admin/assets/images/dummy.png"
                                                                alt="" data-ww="169px" data-hh="136px" width="169"
                                                                height="136"
                                                                data-lazyload="<?php echo $fileNew; ?>"
                                                                data-no-retina></div>
                                                        <div
                                                            class="tp-caption   tp-resizeme  tp-caption tp-resizeme sfr str"
                                                            id="slide-233-layer-14" data-x="center" data-hoffset="426"
                                                            data-y="center" data-voffset="-25"
                                                            data-width="['none','none','none','none']"
                                                            data-height="['none','none','none','none']"
                                                            data-type="image" data-responsive_offset="on"
                                                            data-frames='[{"from":"opacity:0;","speed":500,"to":"o:1;","delay":5200,"ease":"Power3.easeInOut"},{"delay":6800,"speed":500,"to":"opacity:0;","ease":"nothing"}]'
                                                            data-textAlign="['left','left','left','left']"
                                                            data-paddingtop="[0,0,0,0]" data-paddingright="[0,0,0,0]"
                                                            data-paddingbottom="[0,0,0,0]" data-paddingleft="[0,0,0,0]"
                                                            style="z-index: 18;text-transform:left;z-index:44;">
                                                            <?php
                                                            $filename = getRandomElement($arProjectImages);
                                                            $new_filen = $_SERVER["DOCUMENT_ROOT"].'/wp-content/uploads/' . basename($filename);


                                                            $fileNew = "/wp-content/uploads/" . basename($filename);

                                                            $fileNew = cropImage($filename,
                                                                $_SERVER['DOCUMENT_ROOT'] . $fileNew,
                                                                318, 242);

                                                            ?>
                                                            <img
                                                                src="http://wpdemos.themezaa.com/h-code/wp-content/plugins/revslider/admin/assets/images/dummy.png"
                                                                alt="" data-ww="318px" data-hh="242px" width="318"
                                                                height="242"
                                                                data-lazyload="<?php echo $fileNew; ?>"
                                                                data-no-retina></div>
                                                        <div
                                                            class="tp-caption   tp-resizeme  tp-caption tp-resizeme sfr str"
                                                            id="slide-233-layer-15" data-x="center" data-hoffset="329"
                                                            data-y="center" data-voffset="-134"
                                                            data-width="['none','none','none','none']"
                                                            data-height="['none','none','none','none']"
                                                            data-type="image" data-responsive_offset="on"
                                                            data-frames='[{"from":"x:50px;opacity:0;","speed":500,"to":"o:1;","delay":5500,"ease":"Power3.easeInOut"},{"delay":6500,"speed":500,"to":"x:50px;opacity:0;","ease":"nothing"}]'
                                                            data-textAlign="['left','left','left','left']"
                                                            data-paddingtop="[0,0,0,0]" data-paddingright="[0,0,0,0]"
                                                            data-paddingbottom="[0,0,0,0]" data-paddingleft="[0,0,0,0]"
                                                            style="z-index: 19;text-transform:left;z-index:44;">
                                                            <?php
                                                            $filename = getRandomElement($arProjectImages);
                                                            $new_filen = $_SERVER["DOCUMENT_ROOT"].'/wp-content/uploads/' . basename($filename);


                                                            $fileNew = "/wp-content/uploads/" . basename($filename);

                                                            $fileNew = cropImage($filename,
                                                                $_SERVER['DOCUMENT_ROOT'] . $fileNew,
                                                                133, 118);

                                                            ?>
                                                            <img
                                                                src="http://wpdemos.themezaa.com/h-code/wp-content/plugins/revslider/admin/assets/images/dummy.png"
                                                                alt="" data-ww="133px" data-hh="118px" width="133"
                                                                height="118"
                                                                data-lazyload="<?php echo $fileNew; ?>"
                                                                data-no-retina></div>
                                                        <div
                                                            class="tp-caption   tp-resizeme  tp-caption tp-resizeme sfr str"
                                                            id="slide-233-layer-16" data-x="center" data-hoffset="497"
                                                            data-y="center" data-voffset="-160"
                                                            data-width="['none','none','none','none']"
                                                            data-height="['none','none','none','none']"
                                                            data-type="image" data-responsive_offset="on"
                                                            data-frames='[{"from":"opacity:0;","speed":500,"to":"o:1;","delay":5800,"ease":"Power3.easeInOut"},{"delay":6200,"speed":500,"to":"opacity:0;","ease":"nothing"}]'
                                                            data-textAlign="['left','left','left','left']"
                                                            data-paddingtop="[0,0,0,0]" data-paddingright="[0,0,0,0]"
                                                            data-paddingbottom="[0,0,0,0]" data-paddingleft="[0,0,0,0]"
                                                            style="z-index: 20;text-transform:left;z-index:44;">
                                                            <?php
                                                            $filename = getRandomElement($arProjectImages);
                                                            $new_filen = $_SERVER["DOCUMENT_ROOT"].'/wp-content/uploads/' . basename($filename);


                                                            $fileNew = "/wp-content/uploads/" . basename($filename);

                                                            $fileNew = cropImage($filename,
                                                                $_SERVER['DOCUMENT_ROOT'] . $fileNew,
                                                                153, 88);

                                                            ?>
                                                            <img
                                                                src="http://wpdemos.themezaa.com/h-code/wp-content/plugins/revslider/admin/assets/images/dummy.png"
                                                                alt="" data-ww="153px" data-hh="88px" width="153"
                                                                height="88"
                                                                data-lazyload="<?php echo $fileNew; ?>"
                                                                data-no-retina></div>
                                                        <div
                                                            class="tp-caption   tp-resizeme  tp-caption tp-resizeme sft stt"
                                                            id="slide-233-layer-17" data-x="center" data-hoffset="239"
                                                            data-y="center" data-voffset="-386"
                                                            data-width="['none','none','none','none']"
                                                            data-height="['none','none','none','none']"
                                                            data-type="image" data-responsive_offset="on"
                                                            data-frames='[{"from":"y:-50px;opacity:0;","speed":500,"to":"o:1;","delay":6100,"ease":"Power3.easeInOut"},{"delay":5900,"speed":500,"to":"y:-50px;opacity:0;","ease":"nothing"}]'
                                                            data-textAlign="['left','left','left','left']"
                                                            data-paddingtop="[0,0,0,0]" data-paddingright="[0,0,0,0]"
                                                            data-paddingbottom="[0,0,0,0]" data-paddingleft="[0,0,0,0]"
                                                            style="z-index: 21;text-transform:left;z-index:44;">
                                                            <?php
                                                            $filename = getRandomElement($arProjectImages);
                                                            $new_filen = $_SERVER["DOCUMENT_ROOT"].'/wp-content/uploads/' . basename($filename);


                                                            $fileNew = "/wp-content/uploads/" . basename($filename);

                                                            $fileNew = cropImage($filename,
                                                                $_SERVER['DOCUMENT_ROOT'] . $fileNew,
                                                                276, 354);

                                                            ?>
                                                            <img
                                                                src="http://wpdemos.themezaa.com/h-code/wp-content/plugins/revslider/admin/assets/images/dummy.png"
                                                                alt="" data-ww="276px" data-hh="354px" width="276"
                                                                height="354"
                                                                data-lazyload="<?php echo $fileNew; ?>"
                                                                data-no-retina></div>
                                                        <div
                                                            class="tp-caption   tp-resizeme  tp-caption tp-resizeme sft stt"
                                                            id="slide-233-layer-18" data-x="center" data-hoffset="320"
                                                            data-y="center" data-voffset="-260"
                                                            data-width="['none','none','none','none']"
                                                            data-height="['none','none','none','none']"
                                                            data-type="image" data-responsive_offset="on"
                                                            data-frames='[{"from":"y:-50px;opacity:0;","speed":500,"to":"o:1;","delay":6300,"ease":"Power3.easeInOut"},{"delay":5700,"speed":500,"to":"y:-50px;opacity:0;","ease":"nothing"}]'
                                                            data-textAlign="['left','left','left','left']"
                                                            data-paddingtop="[0,0,0,0]" data-paddingright="[0,0,0,0]"
                                                            data-paddingbottom="[0,0,0,0]" data-paddingleft="[0,0,0,0]"
                                                            style="z-index: 22;text-transform:left;z-index:44;">
                                                            <?php
                                                            $filename = getRandomElement($arProjectImages);
                                                            $new_filen = $_SERVER["DOCUMENT_ROOT"].'/wp-content/uploads/' . basename($filename);


                                                            $fileNew = "/wp-content/uploads/" . basename($filename);

                                                            $fileNew = cropImage($filename,
                                                                $_SERVER['DOCUMENT_ROOT'] . $fileNew,
                                                                201, 149);

                                                            ?>
                                                            <img
                                                                src="http://wpdemos.themezaa.com/h-code/wp-content/plugins/revslider/admin/assets/images/dummy.png"
                                                                alt="" data-ww="201px" data-hh="149px" width="201"
                                                                height="149"
                                                                data-lazyload="<?php echo $fileNew; ?>"
                                                                data-no-retina></div>
                                                        <div
                                                            class="tp-caption   tp-resizeme  tp-caption tp-resizeme  sft stt"
                                                            id="slide-233-layer-19" data-x="center" data-hoffset="360"
                                                            data-y="center" data-voffset="-380"
                                                            data-width="['none','none','none','none']"
                                                            data-height="['none','none','none','none']"
                                                            data-type="image" data-responsive_offset="on"
                                                            data-frames='[{"from":"y:-50px;opacity:0;","speed":500,"to":"o:1;","delay":6600,"ease":"Power3.easeInOut"},{"delay":5400,"speed":500,"to":"y:-50px;opacity:0;","ease":"nothing"}]'
                                                            data-textAlign="['left','left','left','left']"
                                                            data-paddingtop="[0,0,0,0]" data-paddingright="[0,0,0,0]"
                                                            data-paddingbottom="[0,0,0,0]" data-paddingleft="[0,0,0,0]"
                                                            style="z-index: 23;text-transform:left;z-index:42;">
                                                            <?php
                                                            $filename = getRandomElement($arProjectImages);
                                                            $new_filen = $_SERVER["DOCUMENT_ROOT"].'/wp-content/uploads/' . basename($filename);


                                                            $fileNew = "/wp-content/uploads/" . basename($filename);

                                                            $fileNew = cropImage($filename,
                                                                $_SERVER['DOCUMENT_ROOT'] . $fileNew,
                                                                196, 194);

                                                            ?>
                                                            <img
                                                                src="http://wpdemos.themezaa.com/h-code/wp-content/plugins/revslider/admin/assets/images/dummy.png"
                                                                alt="" data-ww="196px" data-hh="194px" width="196"
                                                                height="194"
                                                                data-lazyload="<?php echo $fileNew; ?>"
                                                                data-no-retina></div>
                                                        <div
                                                            class="tp-caption   tp-resizeme  tp-caption tp-resizeme sft stt"
                                                            id="slide-233-layer-20" data-x="center" data-hoffset="83"
                                                            data-y="center" data-voffset="-458"
                                                            data-width="['none','none','none','none']"
                                                            data-height="['none','none','none','none']"
                                                            data-type="image" data-responsive_offset="on"
                                                            data-frames='[{"from":"y:-50px;opacity:0;","speed":500,"to":"o:1;","delay":6900,"ease":"Power3.easeInOut"},{"delay":5100,"speed":500,"to":"y:-50px;opacity:0;","ease":"nothing"}]'
                                                            data-textAlign="['left','left','left','left']"
                                                            data-paddingtop="[0,0,0,0]" data-paddingright="[0,0,0,0]"
                                                            data-paddingbottom="[0,0,0,0]" data-paddingleft="[0,0,0,0]"
                                                            style="z-index: 24;text-transform:left;z-index:42;">
                                                            <?php
                                                            $filename = getRandomElement($arProjectImages);
                                                            $new_filen = $_SERVER["DOCUMENT_ROOT"].'/wp-content/uploads/' . basename($filename);


                                                            $fileNew = "/wp-content/uploads/" . basename($filename);

                                                            $fileNew = cropImage($filename,
                                                                $_SERVER['DOCUMENT_ROOT'] . $fileNew,
                                                                161, 203);

                                                            ?>
                                                            <img
                                                                src="http://wpdemos.themezaa.com/h-code/wp-content/plugins/revslider/admin/assets/images/dummy.png"
                                                                alt="" data-ww="161px" data-hh="203px" width="161"
                                                                height="203"
                                                                data-lazyload="<?php echo $fileNew; ?>"
                                                                data-no-retina></div>
                                                        <div
                                                            class="tp-caption   tp-resizeme  tp-caption tp-resizeme sft stt"
                                                            id="slide-233-layer-21" data-x="center" data-hoffset="-75"
                                                            data-y="center" data-voffset="-430"
                                                            data-width="['none','none','none','none']"
                                                            data-height="['none','none','none','none']"
                                                            data-type="image" data-responsive_offset="on"
                                                            data-frames='[{"from":"y:-50px;opacity:0;","speed":500,"to":"o:1;","delay":7200,"ease":"Power3.easeInOut"},{"delay":4800,"speed":500,"to":"y:-50px;opacity:0;","ease":"nothing"}]'
                                                            data-textAlign="['left','left','left','left']"
                                                            data-paddingtop="[0,0,0,0]" data-paddingright="[0,0,0,0]"
                                                            data-paddingbottom="[0,0,0,0]" data-paddingleft="[0,0,0,0]"
                                                            style="z-index: 25;text-transform:left;z-index:41;">
                                                            <?php
                                                            $filename = getRandomElement($arProjectImages);
                                                            $new_filen = $_SERVER["DOCUMENT_ROOT"].'/wp-content/uploads/' . basename($filename);


                                                            $fileNew = "/wp-content/uploads/" . basename($filename);

                                                            $fileNew = cropImage($filename,
                                                                $_SERVER['DOCUMENT_ROOT'] . $fileNew,
                                                                374, 419);

                                                            ?>
                                                            <img
                                                                src="http://wpdemos.themezaa.com/h-code/wp-content/plugins/revslider/admin/assets/images/dummy.png"
                                                                alt="" data-ww="374px" data-hh="419px" width="374"
                                                                height="419"
                                                                data-lazyload="<?php echo $fileNew; ?>"
                                                                data-no-retina></div>
                                                        <div
                                                            class="tp-caption   tp-resizeme  tp-caption tp-resizeme sft stt"
                                                            id="slide-233-layer-22" data-x="center" data-hoffset="-280"
                                                            data-y="center" data-voffset="-420"
                                                            data-width="['none','none','none','none']"
                                                            data-height="['none','none','none','none']"
                                                            data-type="image" data-responsive_offset="on"
                                                            data-frames='[{"from":"y:-50px;opacity:0;","speed":500,"to":"o:1;","delay":7500,"ease":"Power3.easeInOut"},{"delay":4500,"speed":500,"to":"y:-50px;opacity:0;","ease":"nothing"}]'
                                                            data-textAlign="['left','left','left','left']"
                                                            data-paddingtop="[0,0,0,0]" data-paddingright="[0,0,0,0]"
                                                            data-paddingbottom="[0,0,0,0]" data-paddingleft="[0,0,0,0]"
                                                            style="z-index: 26;text-transform:left;z-index:40;">
                                                            <?php
                                                            $filename = getRandomElement($arProjectImages);
                                                            $new_filen = $_SERVER["DOCUMENT_ROOT"].'/wp-content/uploads/' . basename($filename);


                                                            $fileNew = "/wp-content/uploads/" . basename($filename);

                                                            $fileNew = cropImage($filename,
                                                                $_SERVER['DOCUMENT_ROOT'] . $fileNew,
                                                                298, 295);

                                                            ?>
                                                            <img
                                                                src="http://wpdemos.themezaa.com/h-code/wp-content/plugins/revslider/admin/assets/images/dummy.png"
                                                                alt="" data-ww="298px" data-hh="295px" width="298"
                                                                height="295"
                                                                data-lazyload="<?php echo $fileNew; ?>"
                                                                data-no-retina></div>
                                                        <div
                                                            class="tp-caption   tp-resizeme  tp-caption tp-resizeme sft stt"
                                                            id="slide-233-layer-23" data-x="center" data-hoffset="-200"
                                                            data-y="center" data-voffset="-556"
                                                            data-width="['none','none','none','none']"
                                                            data-height="['none','none','none','none']"
                                                            data-type="image" data-responsive_offset="on"
                                                            data-frames='[{"from":"y:-50px;opacity:0;","speed":500,"to":"o:1;","delay":7800,"ease":"Power3.easeInOut"},{"delay":4200,"speed":500,"to":"y:-50px;opacity:0;","ease":"nothing"}]'
                                                            data-textAlign="['left','left','left','left']"
                                                            data-paddingtop="[0,0,0,0]" data-paddingright="[0,0,0,0]"
                                                            data-paddingbottom="[0,0,0,0]" data-paddingleft="[0,0,0,0]"
                                                            style="z-index: 27;text-transform:left;z-index:40;">
                                                            <?php
                                                            $filename = getRandomElement($arProjectImages);
                                                            $new_filen = $_SERVER["DOCUMENT_ROOT"].'/wp-content/uploads/' . basename($filename);


                                                            $fileNew = "/wp-content/uploads/" . basename($filename);

                                                            $fileNew = cropImage($filename,
                                                                $_SERVER['DOCUMENT_ROOT'] . $fileNew,
                                                                156, 157);

                                                            ?>
                                                            <img
                                                                src="http://wpdemos.themezaa.com/h-code/wp-content/plugins/revslider/admin/assets/images/dummy.png"
                                                                alt="" data-ww="156px" data-hh="157px" width="156"
                                                                height="157"
                                                                data-lazyload="<?php echo $fileNew; ?>"
                                                                data-no-retina></div>
                                                        <div
                                                            class="tp-caption   tp-resizeme  tp-caption tp-resizeme sft stt"
                                                            id="slide-233-layer-24" data-x="center" data-hoffset="-468"
                                                            data-y="center" data-voffset="-425"
                                                            data-width="['none','none','none','none']"
                                                            data-height="['none','none','none','none']"
                                                            data-type="image" data-responsive_offset="on"
                                                            data-frames='[{"from":"opacity:0;","speed":500,"to":"o:1;","delay":8100,"ease":"Power3.easeInOut"},{"delay":3900,"speed":500,"to":"opacity:0;","ease":"nothing"}]'
                                                            data-textAlign="['left','left','left','left']"
                                                            data-paddingtop="[0,0,0,0]" data-paddingright="[0,0,0,0]"
                                                            data-paddingbottom="[0,0,0,0]" data-paddingleft="[0,0,0,0]"
                                                            style="z-index: 28;text-transform:left;z-index:39;">
                                                            <?php
                                                            $filename = getRandomElement($arProjectImages);
                                                            $new_filen = $_SERVER["DOCUMENT_ROOT"].'/wp-content/uploads/' . basename($filename);


                                                            $fileNew = "/wp-content/uploads/" . basename($filename);

                                                            $fileNew = cropImage($filename,
                                                                $_SERVER['DOCUMENT_ROOT'] . $fileNew,
                                                                227, 208);

                                                            ?>
                                                            <img
                                                                src="http://wpdemos.themezaa.com/h-code/wp-content/plugins/revslider/admin/assets/images/dummy.png"
                                                                alt="" data-ww="227px" data-hh="208px" width="227"
                                                                height="208"
                                                                data-lazyload="<?php echo $fileNew; ?>"
                                                                data-no-retina></div>
                                                        <div
                                                            class="tp-caption   tp-resizeme  tp-caption tp-resizeme  sft stt"
                                                            id="slide-233-layer-25" data-x="center" data-hoffset="-378"
                                                            data-y="center" data-voffset="-205"
                                                            data-width="['none','none','none','none']"
                                                            data-height="['none','none','none','none']"
                                                            data-type="image" data-responsive_offset="on"
                                                            data-frames='[{"from":"y:-50px;opacity:0;","speed":500,"to":"o:1;","delay":8400,"ease":"Power3.easeInOut"},{"delay":3600,"speed":500,"to":"y:-50px;opacity:0;","ease":"nothing"}]'
                                                            data-textAlign="['left','left','left','left']"
                                                            data-paddingtop="[0,0,0,0]" data-paddingright="[0,0,0,0]"
                                                            data-paddingbottom="[0,0,0,0]" data-paddingleft="[0,0,0,0]"
                                                            style="z-index: 29;text-transform:left;z-index:39;">
                                                            <?php
                                                            $filename = getRandomElement($arProjectImages);
                                                            $new_filen = $_SERVER["DOCUMENT_ROOT"].'/wp-content/uploads/' . basename($filename);


                                                            $fileNew = "/wp-content/uploads/" . basename($filename);

                                                            $fileNew = cropImage($filename,
                                                                $_SERVER['DOCUMENT_ROOT'] . $fileNew,
                                                                237, 239);

                                                            ?>
                                                            <img
                                                                src="http://wpdemos.themezaa.com/h-code/wp-content/plugins/revslider/admin/assets/images/dummy.png"
                                                                alt="" data-ww="237px" data-hh="239px" width="237"
                                                                height="239"
                                                                data-lazyload="<?php echo $fileNew; ?>"
                                                                data-no-retina></div>
                                                        <div
                                                            class="tp-caption   tp-resizeme  tp-caption tp-resizeme sfl stl"
                                                            id="slide-233-layer-26" data-x="center" data-hoffset="-506"
                                                            data-y="center" data-voffset="-190"
                                                            data-width="['none','none','none','none']"
                                                            data-height="['none','none','none','none']"
                                                            data-type="image" data-responsive_offset="on"
                                                            data-frames='[{"from":"x:-50px;opacity:0;","speed":500,"to":"o:1;","delay":8700,"ease":"Power3.easeInOut"},{"delay":3300,"speed":500,"to":"x:-50px;opacity:0;","ease":"nothing"}]'
                                                            data-textAlign="['left','left','left','left']"
                                                            data-paddingtop="[0,0,0,0]" data-paddingright="[0,0,0,0]"
                                                            data-paddingbottom="[0,0,0,0]" data-paddingleft="[0,0,0,0]"
                                                            style="z-index: 30;text-transform:left;z-index:38;">
                                                            <?php
                                                            $filename = getRandomElement($arProjectImages);
                                                            $new_filen = $_SERVER["DOCUMENT_ROOT"].'/wp-content/uploads/' . basename($filename);


                                                            $fileNew = "/wp-content/uploads/" . basename($filename);

                                                            $fileNew = cropImage($filename,
                                                                $_SERVER['DOCUMENT_ROOT'] . $fileNew,
                                                                217, 198);

                                                            ?>
                                                            <img
                                                                src="http://wpdemos.themezaa.com/h-code/wp-content/plugins/revslider/admin/assets/images/dummy.png"
                                                                alt="" data-ww="217px" data-hh="198px" width="217"
                                                                height="198"
                                                                data-lazyload="<?php echo $fileNew; ?>"
                                                                data-no-retina></div>
                                                        <div
                                                            class="tp-caption   tp-resizeme  tp-caption tp-resizeme sfl stl"
                                                            id="slide-233-layer-27" data-x="center" data-hoffset="-506"
                                                            data-y="center" data-voffset="-60"
                                                            data-width="['none','none','none','none']"
                                                            data-height="['none','none','none','none']"
                                                            data-type="image" data-responsive_offset="on"
                                                            data-frames='[{"from":"x:-50px;opacity:0;","speed":500,"to":"o:1;","delay":9000,"ease":"Power3.easeInOut"},{"delay":3000,"speed":500,"to":"x:-50px;opacity:0;","ease":"nothing"}]'
                                                            data-textAlign="['left','left','left','left']"
                                                            data-paddingtop="[0,0,0,0]" data-paddingright="[0,0,0,0]"
                                                            data-paddingbottom="[0,0,0,0]" data-paddingleft="[0,0,0,0]"
                                                            style="z-index: 31;text-transform:left;z-index:38;">
                                                            <?php
                                                            $filename = getRandomElement($arProjectImages);
                                                            $new_filen = $_SERVER["DOCUMENT_ROOT"].'/wp-content/uploads/' . basename($filename);


                                                            $fileNew = "/wp-content/uploads/" . basename($filename);

                                                            $fileNew = cropImage($filename,
                                                                $_SERVER['DOCUMENT_ROOT'] . $fileNew,
                                                                146, 142);

                                                            ?>
                                                            <img
                                                                src="http://wpdemos.themezaa.com/h-code/wp-content/plugins/revslider/admin/assets/images/dummy.png"
                                                                alt="" data-ww="146px" data-hh="142px" width="146"
                                                                height="142"
                                                                data-lazyload="<?php echo $fileNew; ?>"
                                                                data-no-retina></div>
                                                        <div
                                                            class="tp-caption   tp-resizeme  tp-caption tp-resizeme sfl stl"
                                                            id="slide-233-layer-28" data-x="center" data-hoffset="-389"
                                                            data-y="center" data-voffset="164"
                                                            data-width="['none','none','none','none']"
                                                            data-height="['none','none','none','none']"
                                                            data-type="image" data-responsive_offset="on"
                                                            data-frames='[{"from":"x:-50px;opacity:0;","speed":500,"to":"o:1;","delay":9300,"ease":"Power3.easeInOut"},{"delay":2700,"speed":500,"to":"x:-50px;opacity:0;","ease":"nothing"}]'
                                                            data-textAlign="['left','left','left','left']"
                                                            data-paddingtop="[0,0,0,0]" data-paddingright="[0,0,0,0]"
                                                            data-paddingbottom="[0,0,0,0]" data-paddingleft="[0,0,0,0]"
                                                            style="z-index: 32;text-transform:left;z-index:38;">
                                                            <?php
                                                            $filename = getRandomElement($arProjectImages);
                                                            $new_filen = $_SERVER["DOCUMENT_ROOT"].'/wp-content/uploads/' . basename($filename);


                                                            $fileNew = "/wp-content/uploads/" . basename($filename);

                                                            $fileNew = cropImage($filename,
                                                                $_SERVER['DOCUMENT_ROOT'] . $fileNew,
                                                                644, 543);

                                                            ?>
                                                            <img
                                                                src="http://wpdemos.themezaa.com/h-code/wp-content/plugins/revslider/admin/assets/images/dummy.png"
                                                                alt="" data-ww="644px" data-hh="543px" width="644"
                                                                height="543"
                                                                data-lazyload="<?php echo $fileNew; ?>"
                                                                data-no-retina></div>
                                                        <div
                                                            class="tp-caption   tp-resizeme  tp-caption tp-resizeme sfl stl"
                                                            id="slide-233-layer-29" data-x="center" data-hoffset="-260"
                                                            data-y="center" data-voffset="275"
                                                            data-width="['none','none','none','none']"
                                                            data-height="['none','none','none','none']"
                                                            data-type="image" data-responsive_offset="on"
                                                            data-frames='[{"from":"x:-50px;opacity:0;","speed":500,"to":"o:1;","delay":9600,"ease":"Power3.easeInOut"},{"delay":2400,"speed":500,"to":"x:-50px;opacity:0;","ease":"nothing"}]'
                                                            data-textAlign="['left','left','left','left']"
                                                            data-paddingtop="[0,0,0,0]" data-paddingright="[0,0,0,0]"
                                                            data-paddingbottom="[0,0,0,0]" data-paddingleft="[0,0,0,0]"
                                                            style="z-index: 33;text-transform:left;z-index:37;">
                                                            <?php
                                                            $filename = getRandomElement($arProjectImages);
                                                            $new_filen = $_SERVER["DOCUMENT_ROOT"].'/wp-content/uploads/' . basename($filename);


                                                            $fileNew = "/wp-content/uploads/" . basename($filename);

                                                            $fileNew = cropImage($filename,
                                                                $_SERVER['DOCUMENT_ROOT'] . $fileNew,
                                                                516, 441);

                                                            ?>
                                                            <img
                                                                src="http://wpdemos.themezaa.com/h-code/wp-content/plugins/revslider/admin/assets/images/dummy.png"
                                                                alt="" data-ww="516px" data-hh="441px" width="516"
                                                                height="441"
                                                                data-lazyload="<?php echo $fileNew; ?>"
                                                                data-no-retina></div>
                                                        <div
                                                            class="tp-caption   tp-resizeme  tp-caption tp-resizeme sfl stl"
                                                            id="slide-233-layer-30" data-x="center" data-hoffset="-350"
                                                            data-y="center" data-voffset="330"
                                                            data-width="['none','none','none','none']"
                                                            data-height="['none','none','none','none']"
                                                            data-type="image" data-responsive_offset="on"
                                                            data-frames='[{"from":"x:-50px;opacity:0;","speed":500,"to":"o:1;","delay":9900,"ease":"Power3.easeInOut"},{"delay":2100,"speed":500,"to":"x:-50px;opacity:0;","ease":"nothing"}]'
                                                            data-textAlign="['left','left','left','left']"
                                                            data-paddingtop="[0,0,0,0]" data-paddingright="[0,0,0,0]"
                                                            data-paddingbottom="[0,0,0,0]" data-paddingleft="[0,0,0,0]"
                                                            style="z-index: 34;text-transform:left;z-index:37;">
                                                            <?php
                                                            $filename = getRandomElement($arProjectImages);
                                                            $new_filen = $_SERVER["DOCUMENT_ROOT"].'/wp-content/uploads/' . basename($filename);


                                                            $fileNew = "/wp-content/uploads/" . basename($filename);

                                                            $fileNew = cropImage($filename,
                                                                $_SERVER['DOCUMENT_ROOT'] . $fileNew,
                                                                158, 215);

                                                            ?>
                                                            <img
                                                                src="http://wpdemos.themezaa.com/h-code/wp-content/plugins/revslider/admin/assets/images/dummy.png"
                                                                alt="" data-ww="158px" data-hh="215px" width="158"
                                                                height="215"
                                                                data-lazyload="<?php echo $fileNew; ?>"
                                                                data-no-retina></div>
                                                        <div class="tp-caption   tp-resizeme  tp-caption tp-resizeme"
                                                             id="slide-233-layer-31" data-x="center" data-hoffset="-23"
                                                             data-y="center" data-voffset="-97"
                                                             data-width="['none','none','none','none']"
                                                             data-height="['none','none','none','none']"
                                                             data-type="image" data-responsive_offset="on"
                                                             data-frames='[{"from":"opacity:0;","speed":500,"to":"o:1;","delay":10200,"ease":"Power3.easeInOut"},{"delay":1800,"speed":500,"to":"opacity:0;","ease":"nothing"}]'
                                                             data-textAlign="['left','left','left','left']"
                                                             data-paddingtop="[0,0,0,0]" data-paddingright="[0,0,0,0]"
                                                             data-paddingbottom="[0,0,0,0]" data-paddingleft="[0,0,0,0]"
                                                             style="z-index: 35;text-transform:left;z-index:37;">
                                                            <?php
                                                            $filename = getRandomElement($arProjectImages);
                                                            $new_filen = $_SERVER["DOCUMENT_ROOT"].'/wp-content/uploads/' . basename($filename);


                                                            $fileNew = "/wp-content/uploads/" . basename($filename);

                                                            $fileNew = cropImage($filename,
                                                                $_SERVER['DOCUMENT_ROOT'] . $fileNew,
                                                                256, 270);

                                                            ?>
                                                            <img
                                                                src="http://wpdemos.themezaa.com/h-code/wp-content/plugins/revslider/admin/assets/images/dummy.png"
                                                                alt="" data-ww="256px" data-hh="270px" width="256"
                                                                height="270"
                                                                data-lazyload="<?php echo $fileNew; ?>"
                                                                data-no-retina></div>
                                                        <div
                                                            class="tp-caption Fashion-BigDisplay   tp-resizeme  tp-caption light_medium_28_shadowed tp-resizeme"
                                                            id="slide-233-layer-32" data-x="center" data-hoffset="-23"
                                                            data-y="center" data-voffset="120" data-width="['auto']"
                                                            data-height="['auto']" data-type="text"
                                                            data-responsive_offset="on"
                                                            data-frames='[{"from":"opacity:0;","speed":500,"to":"o:1;","delay":10500,"ease":"Power4.easeOut"},{"delay":1500,"speed":500,"to":"opacity:0;","ease":"Power4.easeIn"}]'
                                                            data-textAlign="['left','left','left','left']"
                                                            data-paddingtop="[0,0,0,0]" data-paddingright="[0,0,0,0]"
                                                            data-paddingbottom="[0,0,0,0]" data-paddingleft="[0,0,0,0]"
                                                            style="z-index: 36; white-space: nowrap; font-size: 28px; line-height: 50px; font-weight: 400; color: rgba(255,255,255,1);font-family:Oswald;text-transform:uppercase;text-decoration:none;background-color:transparent;z-index:47;text-align:center;letter-spacing:4px;">
                                                            <?php displayRandomElement($arPostTagsNames); ?>
                                                        </div>
                                                    </li>
                                                    <?php
                                                    $filename = getRandomElement($arProjectAllImages);

                                                    ?>
                                                    <li data-index="rs-234" data-transition="random-premium"
                                                        data-slotamount="1" data-hideafterloop="0"
                                                        data-hideslideonmobile="off" data-easein="default"
                                                        data-easeout="default" data-masterspeed="1000"
                                                        data-thumb="<?php echo $filename; ?>"
                                                        data-delay="10000" data-rotate="0" data-saveperformance="off"
                                                        class="no-transition" data-title="блок 2" data-param1=""
                                                        data-param2="" data-param3="" data-param4="" data-param5=""
                                                        data-param6="" data-param7="" data-param8="" data-param9=""
                                                        data-param10="" data-description="">
                                                        <?php
                                                        $filename = getRandomElement($arProjectAllImages);

                                                        ?>
                                                        <img
                                                            src="http://wpdemos.themezaa.com/h-code/wp-content/plugins/revslider/admin/assets/images/dummy.png"
                                                            alt="" title="Onepage Home restaurant"
                                                            data-lazyload="<?php echo $filename; ?>"
                                                            data-bgposition="center center" data-bgfit="cover"
                                                            data-bgrepeat="no-repeat" class="rev-slidebg"
                                                            data-no-retina>
                                                        <div class="tp-caption   tp-resizeme  tp-caption sfr str"
                                                             id="slide-234-layer-1" data-x="center" data-hoffset="472"
                                                             data-y="center" data-voffset="-44"
                                                             data-width="['none','none','none','none']"
                                                             data-height="['none','none','none','none']"
                                                             data-type="image" data-responsive_offset="on"
                                                             data-frames='[{"from":"x:50px;opacity:0;","speed":500,"to":"o:1;","delay":1500,"ease":"Power3.easeInOut"},{"delay":7700,"speed":300,"to":"x:50px;opacity:0;","ease":"nothing"}]'
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
                                                                626, 603);

                                                            ?>
                                                            <img
                                                                src="http://wpdemos.themezaa.com/h-code/wp-content/plugins/revslider/admin/assets/images/dummy.png"
                                                                alt="" data-ww="626px" data-hh="603px" width="626"
                                                                height="603"
                                                                data-lazyload="<?php echo $fileNew; ?>"
                                                                data-no-retina></div>
                                                        <div class="tp-caption   tp-resizeme  tp-caption sfr str"
                                                             id="slide-234-layer-2" data-x="center" data-hoffset="600"
                                                             data-y="center" data-voffset="80"
                                                             data-width="['none','none','none','none']"
                                                             data-height="['none','none','none','none']"
                                                             data-type="image" data-responsive_offset="on"
                                                             data-frames='[{"from":"x:50px;opacity:0;","speed":500,"to":"o:1;","delay":1800,"ease":"Power3.easeInOut"},{"delay":7400,"speed":300,"to":"x:50px;opacity:0;","ease":"nothing"}]'
                                                             data-textAlign="['left','left','left','left']"
                                                             data-paddingtop="[0,0,0,0]" data-paddingright="[0,0,0,0]"
                                                             data-paddingbottom="[0,0,0,0]" data-paddingleft="[0,0,0,0]"
                                                             style="z-index: 38;text-transform:left;">
                                                            <?php
                                                            $filename = getRandomElement($arProjectImages);
                                                            $new_filen = $_SERVER["DOCUMENT_ROOT"].'/wp-content/uploads/' . basename($filename);


                                                            $fileNew = "/wp-content/uploads/" . basename($filename);

                                                            $fileNew = cropImage($filename,
                                                                $_SERVER['DOCUMENT_ROOT'] . $fileNew,
                                                                748, 921);

                                                            ?>
                                                            <img
                                                                src="http://wpdemos.themezaa.com/h-code/wp-content/plugins/revslider/admin/assets/images/dummy.png"
                                                                alt="" data-ww="748px" data-hh="921px" width="748"
                                                                height="921"
                                                                data-lazyload="<?php echo $fileNew; ?>"
                                                                data-no-retina></div>
                                                        <div class="tp-caption   tp-resizeme  tp-caption sfr str"
                                                             id="slide-234-layer-3" data-x="center" data-hoffset="800"
                                                             data-y="center" data-voffset="380"
                                                             data-width="['none','none','none','none']"
                                                             data-height="['none','none','none','none']"
                                                             data-type="image" data-responsive_offset="on"
                                                             data-frames='[{"from":"x:50px;opacity:0;","speed":500,"to":"o:1;","delay":2100,"ease":"Power3.easeInOut"},{"delay":7100,"speed":300,"to":"x:50px;opacity:0;","ease":"nothing"}]'
                                                             data-textAlign="['left','left','left','left']"
                                                             data-paddingtop="[0,0,0,0]" data-paddingright="[0,0,0,0]"
                                                             data-paddingbottom="[0,0,0,0]" data-paddingleft="[0,0,0,0]"
                                                             style="z-index: 39;text-transform:left;">
                                                            <?php
                                                            $filename = getRandomElement($arProjectImages);
                                                            $new_filen = $_SERVER["DOCUMENT_ROOT"].'/wp-content/uploads/' . basename($filename);


                                                            $fileNew = "/wp-content/uploads/" . basename($filename);

                                                            $fileNew = cropImage($filename,
                                                                $_SERVER['DOCUMENT_ROOT'] . $fileNew,
                                                                437, 213);

                                                            ?>
                                                            <img
                                                                src="http://wpdemos.themezaa.com/h-code/wp-content/plugins/revslider/admin/assets/images/dummy.png"
                                                                alt="" data-ww="437px" data-hh="213px" width="437"
                                                                height="213"
                                                                data-lazyload="<?php echo $fileNew; ?>"
                                                                data-no-retina></div>
                                                        <div class="tp-caption   tp-resizeme  tp-caption sfr str"
                                                             id="slide-234-layer-4" data-x="center" data-hoffset="150"
                                                             data-y="center" data-voffset="-280"
                                                             data-width="['none','none','none','none']"
                                                             data-height="['none','none','none','none']"
                                                             data-type="image" data-responsive_offset="on"
                                                             data-frames='[{"from":"x:50px;opacity:0;","speed":500,"to":"o:1;","delay":2400,"ease":"Power3.easeInOut"},{"delay":6800,"speed":300,"to":"x:50px;opacity:0;","ease":"nothing"}]'
                                                             data-textAlign="['left','left','left','left']"
                                                             data-paddingtop="[0,0,0,0]" data-paddingright="[0,0,0,0]"
                                                             data-paddingbottom="[0,0,0,0]" data-paddingleft="[0,0,0,0]"
                                                             style="z-index: 40;text-transform:left;">
                                                            <?php
                                                            $filename = getRandomElement($arProjectImages);
                                                            $new_filen = $_SERVER["DOCUMENT_ROOT"].'/wp-content/uploads/' . basename($filename);


                                                            $fileNew = "/wp-content/uploads/" . basename($filename);

                                                            $fileNew = cropImage($filename,
                                                                $_SERVER['DOCUMENT_ROOT'] . $fileNew,
                                                                130, 235);

                                                            ?>
                                                            <img
                                                                src="http://wpdemos.themezaa.com/h-code/wp-content/plugins/revslider/admin/assets/images/dummy.png"
                                                                alt="" data-ww="130px" data-hh="235px" width="130"
                                                                height="235"
                                                                data-lazyload="<?php echo $fileNew; ?>"
                                                                data-no-retina></div>
                                                        <div class="tp-caption   tp-resizeme  tp-caption sfr str"
                                                             id="slide-234-layer-5" data-x="center" data-hoffset="280"
                                                             data-y="center" data-voffset="-330"
                                                             data-width="['none','none','none','none']"
                                                             data-height="['none','none','none','none']"
                                                             data-type="image" data-responsive_offset="on"
                                                             data-frames='[{"from":"x:50px;opacity:0;","speed":500,"to":"o:1;","delay":2700,"ease":"Power3.easeInOut"},{"delay":6500,"speed":300,"to":"x:50px;opacity:0;","ease":"nothing"}]'
                                                             data-textAlign="['left','left','left','left']"
                                                             data-paddingtop="[0,0,0,0]" data-paddingright="[0,0,0,0]"
                                                             data-paddingbottom="[0,0,0,0]" data-paddingleft="[0,0,0,0]"
                                                             style="z-index: 41;text-transform:left;">
                                                            <?php
                                                            $filename = getRandomElement($arProjectImages);
                                                            $new_filen = $_SERVER["DOCUMENT_ROOT"].'/wp-content/uploads/' . basename($filename);


                                                            $fileNew = "/wp-content/uploads/" . basename($filename);

                                                            $fileNew = cropImage($filename,
                                                                $_SERVER['DOCUMENT_ROOT'] . $fileNew,
                                                                265, 241);

                                                            ?>
                                                            <img
                                                                src="http://wpdemos.themezaa.com/h-code/wp-content/plugins/revslider/admin/assets/images/dummy.png"
                                                                alt="" data-ww="265px" data-hh="241px" width="265"
                                                                height="241"
                                                                data-lazyload="<?php echo $fileNew; ?>"
                                                                data-no-retina></div>
                                                        <div class="tp-caption   tp-resizeme  tp-caption sfr str"
                                                             id="slide-234-layer-6" data-x="center" data-hoffset="520"
                                                             data-y="center" data-voffset="-70"
                                                             data-width="['none','none','none','none']"
                                                             data-height="['none','none','none','none']"
                                                             data-type="image" data-responsive_offset="on"
                                                             data-frames='[{"from":"x:50px;opacity:0;","speed":500,"to":"o:1;","delay":3000,"ease":"Power3.easeInOut"},{"delay":6200,"speed":300,"to":"x:50px;opacity:0;","ease":"nothing"}]'
                                                             data-textAlign="['left','left','left','left']"
                                                             data-paddingtop="[0,0,0,0]" data-paddingright="[0,0,0,0]"
                                                             data-paddingbottom="[0,0,0,0]" data-paddingleft="[0,0,0,0]"
                                                             style="z-index: 42;text-transform:left;z-index:21;">
                                                            <?php
                                                            $filename = getRandomElement($arProjectImages);
                                                            $new_filen = $_SERVER["DOCUMENT_ROOT"].'/wp-content/uploads/' . basename($filename);


                                                            $fileNew = "/wp-content/uploads/" . basename($filename);

                                                            $fileNew = cropImage($filename,
                                                                $_SERVER['DOCUMENT_ROOT'] . $fileNew,
                                                                833, 771);

                                                            ?>
                                                            <img
                                                                src="http://wpdemos.themezaa.com/h-code/wp-content/plugins/revslider/admin/assets/images/dummy.png"
                                                                alt="" data-ww="833px" data-hh="771px" width="833"
                                                                height="771"
                                                                data-lazyload="<?php echo $fileNew; ?>"
                                                                data-no-retina></div>
                                                        <div class="tp-caption   tp-resizeme  tp-caption sfl stl"
                                                             id="slide-234-layer-7" data-x="center" data-hoffset="-280"
                                                             data-y="center" data-voffset="130"
                                                             data-width="['none','none','none','none']"
                                                             data-height="['none','none','none','none']"
                                                             data-type="image" data-responsive_offset="on"
                                                             data-frames='[{"from":"opacity:0;","speed":500,"to":"o:1;","delay":3300,"ease":"Power3.easeInOut"},{"delay":5900,"speed":300,"to":"opacity:0;","ease":"nothing"}]'
                                                             data-textAlign="['left','left','left','left']"
                                                             data-paddingtop="[0,0,0,0]" data-paddingright="[0,0,0,0]"
                                                             data-paddingbottom="[0,0,0,0]" data-paddingleft="[0,0,0,0]"
                                                             style="z-index: 43;text-transform:left;z-index:21;">
                                                            <?php
                                                            $filename = getRandomElement($arProjectImages);
                                                            $new_filen = $_SERVER["DOCUMENT_ROOT"].'/wp-content/uploads/' . basename($filename);


                                                            $fileNew = "/wp-content/uploads/" . basename($filename);

                                                            $fileNew = cropImage($filename,
                                                                $_SERVER['DOCUMENT_ROOT'] . $fileNew,
                                                                833, 771);

                                                            ?>
                                                            <img
                                                                src="http://wpdemos.themezaa.com/h-code/wp-content/plugins/revslider/admin/assets/images/dummy.png"
                                                                alt="" data-ww="833px" data-hh="771px" width="833"
                                                                height="771"
                                                                data-lazyload="<?php echo $fileNew; ?>"
                                                                data-no-retina></div>
                                                        <div
                                                            class="tp-caption Fashion-BigDisplay   tp-resizeme  tp-caption light_medium_40_shadowed tp-resizeme"
                                                            id="slide-234-layer-8" data-x="30" data-y="center"
                                                            data-voffset="-100" data-width="['auto']"
                                                            data-height="['auto']" data-type="text"
                                                            data-responsive_offset="on"
                                                            data-frames='[{"from":"opacity:0;","speed":500,"to":"o:1;","delay":3600,"ease":"Power4.easeOut"},{"delay":5400,"speed":500,"to":"opacity:0;","ease":"Power4.easeIn"}]'
                                                            data-textAlign="['left','left','left','left']"
                                                            data-paddingtop="[0,0,0,0]" data-paddingright="[0,0,0,0]"
                                                            data-paddingbottom="[0,0,0,0]" data-paddingleft="[0,0,0,0]"
                                                            style="z-index: 44; white-space: nowrap; font-size: 40px; line-height: 50px; font-weight: 400; color: rgba(255,255,255,1);font-family:Oswald;text-transform:uppercase;text-decoration:none;background-color:transparent;z-index:47;letter-spacing:4px;">
                                                            <?php echo $arProject["post_title"];?>
                                                        </div>
                                                        <div
                                                            class="tp-caption Fashion-BigDisplay   tp-resizeme  tp-caption regular_small_text_18 tp-resizeme"
                                                            id="slide-234-layer-9" data-x="30" data-y="center"
                                                            data-voffset="-30" data-width="['auto']"
                                                            data-height="['auto']" data-type="text"
                                                            data-responsive_offset="on"
                                                            data-frames='[{"from":"opacity:0;","speed":500,"to":"o:1;","delay":3900,"ease":"Power4.easeOut"},{"delay":5100,"speed":500,"to":"opacity:0;","ease":"Power4.easeIn"}]'
                                                            data-textAlign="['left','left','left','left']"
                                                            data-paddingtop="[0,0,0,0]" data-paddingright="[0,0,0,0]"
                                                            data-paddingbottom="[0,0,0,0]" data-paddingleft="[0,0,0,0]"
                                                            style="z-index: 45; white-space: nowrap; font-size: 18px; line-height: 30px; font-weight: 400; color: rgba(255,255,255,1);font-family:Open Sans;text-transform:left;z-index:47;position:absolute;margin:0px;white-space:nowrap;letter-spacing:normal;">
                                                            <?php echo get_post_meta($arProject["ID"], 'YEAR')[0]; ?>
                                                        </div>
                                                        <a class="tp-caption rev-btn  tp-resizeme" href="/sertificates/"
                                                           target="_self" id="slide-234-layer-11" data-x="30"
                                                           data-y="center" data-voffset="30" data-width="['auto']"
                                                           data-height="['auto']" data-type="button" data-actions=''
                                                           data-responsive_offset="on"
                                                           data-frames='[{"from":"opacity:0;","speed":500,"to":"o:1;","delay":4200,"ease":"Power2.easeInOut"},{"delay":5000,"speed":300,"to":"opacity:0;","ease":"nothing"},{"frame":"hover","speed":"0","ease":"Linear.easeNone","to":"o:1;rX:0;rY:0;rZ:0;z:0;","style":"c:rgba(0,0,0,1);bg:rgba(255,255,255,1);"}]'
                                                           data-textAlign="['left','left','left','left']"
                                                           data-paddingtop="[10,10,10,10]"
                                                           data-paddingright="[30,30,30,30]"
                                                           data-paddingbottom="[10,10,10,10]"
                                                           data-paddingleft="[30,30,30,30]"
                                                           style="z-index: 46; white-space: nowrap; font-size: 11px; line-height: 23px; font-weight: 400; color: rgba(255,255,255,1);font-family:Open Sans;text-transform:uppercase;text-decoration:none;background-color:rgba(0,0,0,0.75);outline:none;box-shadow:none;box-sizing:border-box;-moz-box-sizing:border-box;-webkit-box-sizing:border-box;z-index:22;letter-spacing:3px;color:#fff !important;padding:6px 25px;background:transparent;border:2px solid #fff;display:inline-block;cursor:pointer;text-decoration: none;"><?php displayRandomElement($arPostTagsNames); ?></a></li>
                                                    <?php
                                                    $filename = getRandomElement($arProjectImages);
                                                    $new_filen = $_SERVER["DOCUMENT_ROOT"].'/wp-content/uploads/' . basename($filename);


                                                    $fileNew = "/wp-content/uploads/" . basename($filename);

                                                    $fileNew = cropImage($filename,
                                                        $_SERVER['DOCUMENT_ROOT'] . $fileNew,
                                                        100, 50);

                                                    ?>
                                                    <li data-index="rs-235" data-transition="random" data-slotamount="1"
                                                        data-hideafterloop="0" data-hideslideonmobile="off"
                                                        data-easein="default" data-easeout="default"
                                                        data-masterspeed="1000"
                                                        data-thumb="<?php echo $fileNew; ?>"
                                                        data-delay="10000" data-rotate="0" data-saveperformance="off"
                                                        class="no-transition" data-title="блок 3" data-param1=""
                                                        data-param2="" data-param3="" data-param4="" data-param5=""
                                                        data-param6="" data-param7="" data-param8="" data-param9=""
                                                        data-param10="" data-description="">
                                                        <?php
                                                        $filename = getRandomElement($arProjectAllImages);

                                                        ?>
                                                        <img
                                                            src="http://wpdemos.themezaa.com/h-code/wp-content/plugins/revslider/admin/assets/images/dummy.png"
                                                            alt="" title="Onepage Home restaurant"
                                                            data-lazyload="<?php echo $filename; ?>"
                                                            data-bgposition="center center" data-bgfit="cover"
                                                            data-bgrepeat="no-repeat" class="rev-slidebg"
                                                            data-no-retina>
                                                        <div class="tp-caption   tp-resizeme  tp-caption sfr str"
                                                             id="slide-235-layer-1" data-x="center" data-hoffset="472"
                                                             data-y="center" data-voffset="50"
                                                             data-width="['none','none','none','none']"
                                                             data-height="['none','none','none','none']"
                                                             data-type="image" data-responsive_offset="on"
                                                             data-frames='[{"from":"x:50px;opacity:0;","speed":500,"to":"o:1;","delay":1500,"ease":"Power3.easeInOut"},{"delay":7700,"speed":300,"to":"x:50px;opacity:0;","ease":"nothing"}]'
                                                             data-textAlign="['left','left','left','left']"
                                                             data-paddingtop="[0,0,0,0]" data-paddingright="[0,0,0,0]"
                                                             data-paddingbottom="[0,0,0,0]" data-paddingleft="[0,0,0,0]"
                                                             style="z-index: 47;text-transform:left;z-index:20;">
                                                            <?php
                                                            $filename = getRandomElement($arProjectImages);
                                                            $new_filen = $_SERVER["DOCUMENT_ROOT"].'/wp-content/uploads/' . basename($filename);


                                                            $fileNew = "/wp-content/uploads/" . basename($filename);

                                                            $fileNew = cropImage($filename,
                                                                $_SERVER['DOCUMENT_ROOT'] . $fileNew,
                                                                807, 1021);

                                                            ?>
                                                            <img
                                                                src="http://wpdemos.themezaa.com/h-code/wp-content/plugins/revslider/admin/assets/images/dummy.png"
                                                                alt="" data-ww="807px" data-hh="1021px" width="807"
                                                                height="1021"
                                                                data-lazyload="<?php echo $fileNew; ?>"
                                                                data-no-retina></div>
                                                        <div class="tp-caption   tp-resizeme  tp-caption sfl stl"
                                                             id="slide-235-layer-2" data-x="center" data-hoffset="-690"
                                                             data-y="center" data-voffset="330"
                                                             data-width="['none','none','none','none']"
                                                             data-height="['none','none','none','none']"
                                                             data-type="image" data-responsive_offset="on"
                                                             data-frames='[{"from":"x:-50px;opacity:0;","speed":500,"to":"o:1;","delay":2000,"ease":"Power3.easeInOut"},{"delay":7200,"speed":300,"to":"x:-50px;opacity:0;","ease":"nothing"}]'
                                                             data-textAlign="['left','left','left','left']"
                                                             data-paddingtop="[0,0,0,0]" data-paddingright="[0,0,0,0]"
                                                             data-paddingbottom="[0,0,0,0]" data-paddingleft="[0,0,0,0]"
                                                             style="z-index: 48;text-transform:left;z-index:20;">
                                                            <?php
                                                            $filename = getRandomElement($arProjectImages);
                                                            $new_filen = $_SERVER["DOCUMENT_ROOT"].'/wp-content/uploads/' . basename($filename);


                                                            $fileNew = "/wp-content/uploads/" . basename($filename);

                                                            $fileNew = cropImage($filename,
                                                                $_SERVER['DOCUMENT_ROOT'] . $fileNew,
                                                                716, 485);

                                                            ?>
                                                            <img
                                                                src="http://wpdemos.themezaa.com/h-code/wp-content/plugins/revslider/admin/assets/images/dummy.png"
                                                                alt="" data-ww="716px" data-hh="485px" width="716"
                                                                height="485"
                                                                data-lazyload="<?php echo $fileNew; ?>"
                                                                data-no-retina></div>
                                                        <div
                                                            class="tp-caption Fashion-BigDisplay   tp-resizeme  tp-caption light_medium_40_shadowed tp-resizeme"
                                                            id="slide-235-layer-3" data-x="30" data-y="center"
                                                            data-voffset="-100" data-width="['auto']"
                                                            data-height="['auto']" data-type="text"
                                                            data-responsive_offset="on"
                                                            data-frames='[{"from":"opacity:0;","speed":500,"to":"o:1;","delay":2500,"ease":"Power4.easeOut"},{"delay":6500,"speed":500,"to":"opacity:0;","ease":"Power4.easeIn"}]'
                                                            data-textAlign="['left','left','left','left']"
                                                            data-paddingtop="[0,0,0,0]" data-paddingright="[0,0,0,0]"
                                                            data-paddingbottom="[0,0,0,0]" data-paddingleft="[0,0,0,0]"
                                                            style="z-index: 49; white-space: nowrap; font-size: 40px; line-height: 50px; font-weight: 400; color: rgba(255,255,255,1);font-family:Oswald;text-transform:uppercase;text-decoration:none;background-color:transparent;z-index:47;letter-spacing:4px;">
                                                            <?php displayRandomElement($arPostTagsNames); ?>
                                                        </div>
                                                        <div
                                                            class="tp-caption Fashion-BigDisplay   tp-resizeme  tp-caption regular_small_text_18 tp-resizeme"
                                                            id="slide-235-layer-4" data-x="30" data-y="center"
                                                            data-voffset="-55" data-width="['auto']"
                                                            data-height="['auto']" data-type="text"
                                                            data-responsive_offset="on"
                                                            data-frames='[{"from":"opacity:0;","speed":500,"to":"o:1;","delay":3000,"ease":"Power4.easeOut"},{"delay":6000,"speed":500,"to":"opacity:0;","ease":"Power4.easeIn"}]'
                                                            data-textAlign="['left','left','left','left']"
                                                            data-paddingtop="[0,0,0,0]" data-paddingright="[0,0,0,0]"
                                                            data-paddingbottom="[0,0,0,0]" data-paddingleft="[0,0,0,0]"
                                                            style="z-index: 50; white-space: nowrap; font-size: 18px; line-height: 30px; font-weight: 400; color: rgba(255,255,255,1);font-family:Open Sans;text-transform:left;z-index:47;position:absolute;margin:0px;white-space:nowrap;letter-spacing:normal;">
                                                            <?php displayRandomElement($arPostTagsNames); ?>
                                                        </div>
                                                        <a class="tp-caption rev-btn  tp-resizeme" href="/skills/"
                                                           target="_self" id="slide-235-layer-6" data-x="30"
                                                           data-y="center" data-voffset="10" data-width="['auto']"
                                                           data-height="['auto']" data-type="button" data-actions=''
                                                           data-responsive_offset="on"
                                                           data-frames='[{"from":"opacity:0;","speed":500,"to":"o:1;","delay":3500,"ease":"Power2.easeInOut"},{"delay":5700,"speed":300,"to":"opacity:0;","ease":"nothing"},{"frame":"hover","speed":"0","ease":"Linear.easeNone","to":"o:1;rX:0;rY:0;rZ:0;z:0;","style":"c:rgba(0,0,0,1);bg:rgba(255,255,255,1);"}]'
                                                           data-textAlign="['left','left','left','left']"
                                                           data-paddingtop="[10,10,10,10]"
                                                           data-paddingright="[30,30,30,30]"
                                                           data-paddingbottom="[10,10,10,10]"
                                                           data-paddingleft="[30,30,30,30]"
                                                           style="z-index: 51; white-space: nowrap; font-size: 11px; line-height: 23px; font-weight: 400; color: rgba(255,255,255,1);font-family:Open Sans;text-transform:uppercase;text-decoration:none;background-color:rgba(0,0,0,0.75);outline:none;box-shadow:none;box-sizing:border-box;-moz-box-sizing:border-box;-webkit-box-sizing:border-box;z-index:22;letter-spacing:3px;color:#fff !important;padding:6px 25px;background:transparent;border:2px solid #fff;display:inline-block;cursor:pointer;text-decoration: none;"><?php displayRandomElement($arPostTagsNames); ?></a></li>
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
                                                <div class="tp-bannertimer"
                                                     style="height: 1px; background: rgba(112,91,66,0.05);"></div>
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
                                                        e.c = jQuery('#rev_slider_47_1');
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
                                                var revapi47;
                                                tpj(document).ready(function () {
                                                    if (tpj("#rev_slider_47_1").revolution == undefined) {
                                                        revslider_showDoubleJqueryError("#rev_slider_47_1");
                                                    } else {
                                                        revapi47 = tpj("#rev_slider_47_1").show().revolution({
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
                                                                    hide_onleave: true,
                                                                    hide_delay: 200,
                                                                    hide_delay_mobile: 1200,
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
                                                            visibilityLevels: [1240, 1024, 778, 480],
                                                            gridwidth: 1170,
                                                            gridheight: 700,
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
                                                            fullScreenOffsetContainer: ".header",
                                                            fullScreenOffset: "",
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
                                                var htmlDivCss = ' #rev_slider_47_1_wrapper .tp-loader.spinner3 div { background-color: #050505 !important; } ';
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
                <section id="features" class="  no-padding-bottom">
                    <div class="container">
                        <div class="row">
                            <div
                                class="wpb_column hcode-column-container  col-md-4 col-xs-mobile-fullwidth col-sm-8 text-center center-col margin-ten-bottom">
                                <div class="vc-column-innner-wrapper">
                                    <div class="dividers-header double-line">
                                        <div class="subheader" style="background-color: #fff;"><h2
                                                class="section-title  no-padding">Описание проекта</h2></div>
                                    </div>
                                </div>
                            </div>

                            <?php
                            $arContent = preg_split('/[\n.]/u', $arProject["post_content"], -1, PREG_SPLIT_NO_EMPTY);
                            $arContentBlock = array_chunk($arContent, round(count($arContent)/3));

                            ?>
                            <div
                                class="wpb_column hcode-column-container  col-md-4 col-xs-mobile-fullwidth col-sm-12 sm-margin-ten-bottom">
                                <div class="vc-column-innner-wrapper"><p class="text-large no-margin-bottom">
                                        <?php displayRandomElement($arPostTagsNames); ?>
                                    </p>
                                    <h1 class="margin-five no-margin-top">
                                        <?php echo $YEAR; ?>
                                    </h1>
                                    <p class="margin-five text-med width-90 no-margin-bottom">
                                        <?php if($arContentBlock[0]) echo implode("\n", $arContentBlock[0]); ?>
                                    </p>
                                    <?php if($ProjectURL){ ?>
                                    <a href="<?php echo $ProjectURL; ?>" target="_self"
                                                         class="inner-link highlight-button-black-border btn-small
                                                         margin-top-30px button btn">
                                        Ссылка на проект
                                    </a>
                                    <?php } ?>
                                
                                </div>
                            </div>
                            <div
                                class="wpb_column hcode-column-container  col-md-4 col-xs-mobile-fullwidth col-sm-6 xs-margin-ten-bottom">
                                <div class="vc-column-innner-wrapper">
                                    <div class="position-relative"><a href="#" target="_self">
                                            <?php
                                            $filename = getRandomElement($arProjectImages);
                                            $new_filen = $_SERVER["DOCUMENT_ROOT"].'/wp-content/uploads/' . basename($filename);


                                            $fileNew = "/wp-content/uploads/" . basename($filename);

                                            $fileNew = cropImage($filename,
                                                $_SERVER['DOCUMENT_ROOT'] . $fileNew,
                                                800, 533);
                                            ?>
                                            <img alt=""

                                                 src="<? echo $fileNew; ?>"
                                                                                                   width="800"
                                                                                                   height="533"></a>
                                    </div>
                                    <p class="text-med black-text letter-spacing-1 margin-ten no-margin-bottom text-uppercase font-weight-600
                                    xs-margin-top-five">
                                        <?php displayRandomElement($arPostTagsNames); ?></p>
                                    <p class="margin-two text-med width-90">
                                        <?php if($arContentBlock[1]) echo implode("\n", $arContentBlock[1]); ?>
                                    </p>
                                    <div class="separator-line no-margin-lr"
                                         style=" background:#252525;height:1px;"></div>
                                </div>
                            </div>
                            <div class="wpb_column hcode-column-container  col-md-4 col-xs-mobile-fullwidth col-sm-6">
                                <div class="vc-column-innner-wrapper">
                                    <div class="position-relative"><a href="#" target="_self">
                                            <?php
                                            $filename = getRandomElement($arProjectImages);
                                            $new_filen = $_SERVER["DOCUMENT_ROOT"].'/wp-content/uploads/' . basename($filename);


                                            $fileNew = "/wp-content/uploads/" . basename($filename);

                                            $fileNew = cropImage($filename,
                                                $_SERVER['DOCUMENT_ROOT'] . $fileNew,
                                                800, 533);
                                            ?>
                                            <img alt=""

                                                 src="<? echo $fileNew; ?>"
                                                                                                   width="800"
                                                                                                   height="533"></a>
                                    </div>
                                    <p class="text-med black-text letter-spacing-1 margin-ten no-margin-bottom text-uppercase font-weight-600
                                    xs-margin-top-five">
                                        <?php displayRandomElement($arPostTagsNames); ?></p>
                                    <p class="margin-two text-med width-90">
                                        <?php if($arContentBlock[2]) echo implode("\n", $arContentBlock[2]); ?>
                                    </p>
                                    <div class="separator-line no-margin-lr"
                                         style=" background:#252525;height:1px;"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>




                <section class="  no-padding-bottom">
                    <div class="container-fluid">
                        <div class="row">
                            <div
                                class="wpb_column hcode-column-container  col-lg-4 col-md-4 col-xs-mobile-fullwidth col-sm-4 no-padding">
                                <div class="vc-column-innner-wrapper">

                                    <?php
                                    $filename = getRandomElement($arProjectImages);
                                    $new_filen = $_SERVER["DOCUMENT_ROOT"].'/wp-content/uploads/' . basename($filename);


                                    $fileNew = "/wp-content/uploads/" . basename($filename);

                                    $fileNew = cropImage($filename,
                                        $_SERVER['DOCUMENT_ROOT'] . $fileNew,
                                        900, 843);
                                    ?>
                                    <img
                                        src="<? echo $fileNew; ?>"
                                        width="900" height="843" alt=""></div>
                            </div>
                            <div
                                class="wpb_column hcode-column-container  col-lg-4 col-md-4 col-xs-mobile-fullwidth col-sm-4 no-padding">
                                <div class="vc-column-innner-wrapper">
                                    <div class="person-grid ">
                                        <div class="grid bg-black">
                                            <div class="gallery-img"><a href="#contact-us" class="inner-link">
                                                    <?php
                                                    $filename = getRandomElement($arProjectImages);
                                                    $new_filen = $_SERVER["DOCUMENT_ROOT"].'/wp-content/uploads/' . basename($filename);


                                                    $fileNew = "/wp-content/uploads/" . basename($filename);

                                                    $fileNew = cropImage($filename,
                                                        $_SERVER['DOCUMENT_ROOT'] . $fileNew,
                                                        900, 843);
                                                    ?>
                                                    <img
                                                        src="<? echo $fileNew; ?>"
                                                        width="900" height="843" alt=""></a></div>
                                            <figure>
                                                <figcaption class="md-bottom-10"><span
                                                        class="owl-title white-text position-relative margin-five"
                                                        style="color:#ffffff !important">
                                                        <?php echo randomText()[0]; ?>
                                                    </span>
                                                    <p class="margin-five white-text text-med width-70 center-col position-relative no-margin-bottom sm-display-none xs-display-block">
                                                        <?php echo randomText()[1]; ?>
                                                    </p> <a
                                                        class="btn-small-white btn btn-medium position-relative no-margin-right margin-five inner-link"
                                                        href="#contact-us" target=_self>Мои контакты</a><span
                                                        class="margin-ten display-block"></span></figcaption>
                                            </figure>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div
                                class="wpb_column hcode-column-container  col-lg-4 col-md-4 col-xs-mobile-fullwidth col-sm-4 no-padding">
                                <div class="vc-column-innner-wrapper">
                                    <?php
                                    $filename = getRandomElement($arProjectImages);
                                    $new_filen = $_SERVER["DOCUMENT_ROOT"].'/wp-content/uploads/' . basename($filename);


                                    $fileNew = "/wp-content/uploads/" . basename($filename);

                                    $fileNew = cropImage($filename,
                                        $_SERVER['DOCUMENT_ROOT'] . $fileNew,
                                        900, 843);
                                    ?>
                                    <img
                                        src="<? echo $fileNew; ?>"
                                        width="900" height="843" alt=""></div>
                            </div>
                        </div>
                    </div>
                </section>
                <section class="  cover-background js-background"
                         data-image="<? displayRandomElement($currentBackgroundImage); ?>"
                         style="background-image:url();min-height:753px;">
                    <div class="container">
                        <div class="row">
                            <div
                                class="wpb_column hcode-column-container  col-md-4 col-xs-mobile-fullwidth col-sm-8 text-center center-col margin-ten-bottom">
                                <div class="vc-column-innner-wrapper">
                                    <div class="dividers-header double-line">
                                        <div class="subheader" style="background-color: #fff;"><h2
                                                class="section-title  no-padding">Другие проекты</h2></div>
                                    </div>
                                </div>
                            </div>

                            <?php
                            include $_SERVER['DOCUMENT_ROOT'] . '/includes/portfolio_grid_gallery.php';
                            ?>

                            <?php
                            $i = 1;
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
                            unset($arCurrentPostTagsNames);
                            foreach ($arPostTags as $tag){
                                $arCurrentPostTagsNames[] = $tag->name;
                            }


                            $filename = $thumb_url[0];
                            $new_filen = $_SERVER["DOCUMENT_ROOT"].'/wp-content/uploads/' . basename($filename);


                            $fileNew = "/wp-content/uploads/" . basename($filename);

                                $fileNew = cropImage($filename,
                                $_SERVER['DOCUMENT_ROOT'] . $fileNew,
                                    900, 600);
                            ?>

                            <div
                                class="wpb_column hcode-column-container  col-md-4 col-xs-mobile-fullwidth col-sm-4 xs-margin-ten-bottom">
                                <div class="vc-column-innner-wrapper">
                                    <div class="position-relative "><img
                                                src="" class="js-img"
                                                data-image="<?php echo $fileNew; ?>"
                                                alt="" width="900" height="600"><span
                                            class="special-dishes-price bg-white red-text alt-font">

                                        </span></div>
                                    <p class="text-uppercase letter-spacing-2 font-weight-600 margin-ten no-margin-bottom"
                                       style="color:#000000 !important"><?php echo $post->post_title; ?></p>
                                    <p class="margin-two text-med width-90">
                                        <?php
                                        $post_content = preg_replace("/\\[.+\\]/m","",
                                            $post->post_content);
                                        //$post_content = str_replace("\n","<br>",
                                        //    $post_content);

                                        echo kama_excerpt( array('text'=>$post_content,
                                            'maxchar'=>500,
                                            'autop' => false) );

                                        ?>
                                    </p>
                                    <div class="thin-separator-line bg-dark-gray no-margin-lr"></div>
                                </div>
                            </div>
                                <?php
                                if($i == 3) break;
                                $i++;
                            }

                            wp_reset_postdata(); // сброс
                            ?>

                        </div>
                    </div>
                </section>
                <section id="menu" class="  no-padding-bottom" style="border-top: 1px solid #e5e5e5;">
                    <div class="container-fluid">
                        <div class="row">
                            <div
                                class="wpb_column hcode-column-container  col-lg-3 col-md-4 col-xs-mobile-fullwidth col-sm-8 text-center center-col margin-two-bottom">
                                <div class="vc-column-innner-wrapper">
                                    <div class="dividers-header double-line">
                                        <div class="subheader" style="background-color: #fff;"><h2
                                                class="section-title  no-padding">Другие проекты</h2></div>
                                    </div>
                                </div>
                            </div>
                            <div
                                class="wpb_column hcode-column-container  col-lg-3 col-md-5 col-xs-mobile-fullwidth col-sm-7 text-center center-col margin-five-bottom">
                                <div class="vc-column-innner-wrapper">
                                    <h4 class="gray-text">
                                        <?php echo randomText()[0]; ?>
                                    </h4></div>
                            </div>
                            <div class="wpb_column hcode-column-container  col-xs-mobile-fullwidth">
                                <div class="vc-column-innner-wrapper">
                                    <div class="col-md-12 text-center">
                                        <div class="text-center">
                                            <ul class="portfolio-filter nav nav-tabs nav-tabs-black " 
                                            style="margin-bottom:20px; height:auto;">
                                                <?php
                                                include $_SERVER['DOCUMENT_ROOT'] . '/includes/portfolio_filter.php';
                                                ?>
                                            </ul>
                                        </div>
                                    </div>
                                    <div class="work-4col  ">
                                        <div
                                            class="col-md-12  no-padding grid-gallery overflow-hidden  content-section">
                                            <div class="tab-content">
                                                <ul class="grid masonry-items lightbox-gallery">



                                                    <?php
                                                    include $_SERVER['DOCUMENT_ROOT'] . '/includes/portfolio_grid_gallery.php';
                                                    ?>

                                                    <?php
                                                    $i = 1;
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

                                                    $filename = $thumb_url[0];
                                                    $new_filen = $_SERVER["DOCUMENT_ROOT"].'/wp-content/uploads/' . basename($filename);


                                                    $fileNew = "/wp-content/uploads/" . basename($filename);

                                                        $fileNew = cropImage($filename,
                                                        $_SERVER['DOCUMENT_ROOT'] . $fileNew,
                                                        1200, 800);

                                                    $arPostTags = wp_get_post_tags($post->ID);

                                                    unset($arCurrentPostTagsNames);
                                                    foreach ($arPostTags as $tag){
                                                        $arCurrentPostTagsNames[] = $tag->name;
                                                    }
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
                                                                        src="<?php echo $fileNew; ?>"
                                                                        width="1200" height="800" alt=""></a></div>
                                                            <figcaption>
                                                                <h3><?php echo $post->post_title;?></h3>
                                                                <p><?php echo implode(" / ", $arCurrentPostTagsNames); ?></p></figcaption>
                                                        </figure>
                                                    </li>




                                                        <?php

                                                        if($i == 8) break;
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
                <section class="  no-padding-bottom" style="border-bottom: 1px solid #e5e5e5;">
                    <div class="container">
                        <div class="row">
                            <div
                                class="wpb_column hcode-column-container  col-md-4 col-xs-mobile-fullwidth col-sm-8 text-center center-col margin-four-bottom">
                                <div class="vc-column-innner-wrapper">
                                    <div class="dividers-header double-line">
                                        <div class="subheader" style="background-color: #fff;"><h2
                                                class="section-title  no-padding">
                                                Заказать разработку проекта
                                            </h2></div>
                                    </div>
                                </div>
                            </div>
                            <div
                                class="wpb_column hcode-column-container  col-md-5 col-xs-mobile-fullwidth col-sm-7 text-center center-col margin-five-bottom">
                                <div class="vc-column-innner-wrapper">
                                    <h4 class="gray-text">
                                        <?php echo randomText()[0]; ?>
                                    </h4></div>
                            </div>
                            <div
                                class="wpb_column hcode-column-container  col-md-10 col-xs-mobile-fullwidth center-col">
                                <div class="vc-column-innner-wrapper">
                                    <div role="form" class="wpcf7" id="wpcf7-f7179-p48-o1" lang="en-US" dir="ltr">
                                        <div class="screen-reader-response"></div>
                                        <form action="<?php echo $_SERVER["REQUEST_URI"]; ?>" method="post"
                                              class="wpcf7-form" novalidate="novalidate">
                                            <div style="display: none;"><input type="hidden" name="_wpcf7"
                                                                               value="7179"/> <input type="hidden"
                                                                                                     name="_wpcf7_version"
                                                                                                     value="4.7"/>
                                                <input type="hidden" name="_wpcf7_locale" value="en_US"/> <input
                                                    type="hidden" name="_wpcf7_unit_tag" value="wpcf7-f7179-p48-o1"/>
                                                <input type="hidden" name="_wpnonce" value="31a2dadf45"/></div>
                                            <div class="col-md-6 col-sm-12 reservation-name"><span
                                                    class="wpcf7-form-control-wrap your-name">
                                                    <input type="text"
                                                                                                     name="your-name"
                                                                                                     value="" size="40"
                                                                                                     class="wpcf7-form-control wpcf7-text wpcf7-validates-as-required input-round big-input"
                                                                                                     aria-required="true"
                                                                                                     aria-invalid="false"
                                                                                                     placeholder="ВАШЕ ИМЯ"/></span>
                                            </div>
                                            <div class="col-md-6 col-sm-12 reservation-date"><span
                                                    class="wpcf7-form-control-wrap text-reservation"><input type="email"
                                                                                                            name="email-771"
                                                                                                            value=""
                                                                                                            size="40"
                                                                                                            class="wpcf7-form-control wpcf7-text input-round big-input"
                                                                                                            aria-invalid="false"
                                                                                                            placeholder="ВАШ E-MAIL"/></span>
                                            </div>
                                            <div class="col-md-6 col-sm-12">
                                                <div
                                                    class="select-style big-input margin-five no-margin-top input-round">


                                                    <span class="wpcf7-form-control-wrap menu-438">

                                                    <select name="menu-272" class="wpcf7-form-control wpcf7-select
                                                    wpcf7-validates-as-required" aria-required="true" aria-invalid="false">

                                                        <option>Тип будущего сайта</option>

                                                    <?php

                                                    $categoryId = PORTFOLIO_WP_CATEGORY_SITES_ID;

                                                    $args = array(
                                                        'numberposts' => 999,
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

                                                    foreach ($posts as $post) {
                                                        setup_postdata($post);


                                                        ?>

                                                        <option
                                                                value="<?php echo $post->post_title;?>">
                                                        <?php echo $post->post_title;?>
                                                    </option>


                                                        <?php
                                                    }

                                                    wp_reset_postdata();
                                                    ?>




                                                        </select>

                                                    </span></div>
                                            </div>
                                            <div class="col-md-6 col-sm-12">
                                                <div
                                                    class="select-style big-input margin-five no-margin-top input-round">

                                                    <span class="wpcf7-form-control-wrap menu-633">
                                                        <select name="menu-838"
                                                                class="wpcf7-form-control wpcf7-select wpcf7-validates-as-required"
                                                                aria-required="true" aria-invalid="false">

                                                            <option>Есть ли наработки или корпоративный стиль, который нужно применить</option>
                                                            <option value="Да">Да</option>
                                                            <option value="Нет">Нет</option>
                                                        </select>
                                                    </span>


                                                </div>
                                            </div>
                                            <div class="col-md-12 col-sm-12 text-center">
                                                <div class="col-sm-12 no-padding-lr padding-two-tb
                                                input-round"><input
                                                        type="submit" value="Отправить"
                                                        class="wpcf7-form-control wpcf7-submit
                                                        btn btn-black btn-medium btn-round
                                                        no-margin-bottom no-margin-top"/>
                                                </div>
                                            </div>
                                            <div class="wpcf7-response-output wpcf7-display-none"></div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                            <div
                                class="wpb_column hcode-column-container  col-md-12
                                col-xs-mobile-fullwidth col-sm-12 text-center">
                                <div class="vc-column-innner-wrapper"><img
                                        src="" class="js-img" 
                                        data-image="<?php echo getRandomElement($arProjectMockups); ?>"
                                        width="800" alt=""></div>
                            </div>
                        </div>
                    </div>
                </section>
                <section id="our-service">
                    <div class="container">
                        <div class="row">
                            <div
                                class="wpb_column hcode-column-container  col-md-4 col-xs-mobile-fullwidth col-sm-8 text-center center-col margin-four-bottom">
                                <div class="vc-column-innner-wrapper">
                                    <div class="dividers-header double-line">
                                        <div class="subheader" style="background-color: #fff;"><h2
                                                class="section-title  no-padding">
                                                Тэги проекта
                                            </h2></div>
                                    </div>
                                </div>
                            </div>
                            <div
                                class="wpb_column hcode-column-container  col-md-5
                                col-xs-mobile-fullwidth col-sm-7 text-center center-col margin-ten-bottom">
                                <div class="vc-column-innner-wrapper">
                                    <h4 class="gray-text"><?php echo randomText()[0]; ?></h4></div>
                            </div>



                            <?php
                            $i = 1;
                            foreach($arProjectSkills as $projectSkill) {

                                ?>

                                <div
                                        class="wpb_column hcode-column-container
                                col-md-3 col-xs-12 col-sm-6 text-center sm-margin-ten-bottom">
                                    <div class="vc-column-innner-wrapper">
                                        <div class="icon-bg"><img alt=""
                                                                  src=""
                                                                  class="js-img"
                                                                  data-image="<?php echo $projectSkill->image; ?>"
                                                                  width="140"></div>
                                        <span class="display-block margin-ten work-process-title no-margin-bottom gray-text"
                                              style="color:#000000 !important"><?php echo $projectSkill->post_title; ?></span>
                                        <p class="margin-two width-90 center-col">
                                            <?php echo $arProjectsTypesCountsProjects[$projectSkill->post_title]; ?> <?php
                                            echo numberof($arProjectsTypesCountsProjects[$projectSkill->post_title], '',
                                                array('Проект', 'Проекта', 'Проектов'));
                                            ?>
                                        </p>
                                        <div class="thin-separator-line bg-dark-gray"></div>
                                    </div>
                                </div>

                                <?php
                                if($i == 4) break;
                                $i++;
                            }
                            ?>



                        </div>
                    </div>
                </section>
                <section class=" " style=" background-color:#f8f7f5; ">
                    <div class="container-fluid">
                        <div class="row">
                            <div
                                class="wpb_column hcode-column-container  col-lg-3 col-md-4 col-xs-mobile-fullwidth col-sm-8 text-center center-col margin-seven-bottom">
                                <div class="vc-column-innner-wrapper">
                                    <div class="dividers-header double-line">
                                        <div class="subheader" style="background-color: #f8f7f5;"><h2
                                                class="section-title  no-padding">Другие проекты</h2></div>
                                    </div>
                                </div>
                            </div>
                            <div class="wpb_column hcode-column-container  col-xs-mobile-fullwidth">
                                <div class="vc-column-innner-wrapper">
                                    <div class="restaurant-popular-dish-owl position-relative">
                                        <div class="container">
                                            <div class="row">
                                                <div id="restaurant-popular-dish"
                                                     class="owl-pagination-bottom owl-carousel owl-theme dot-pagination light-navigation dark-pagination light-navigation">





                                                    <?php
                                                    include $_SERVER['DOCUMENT_ROOT'] . '/includes/portfolio_grid_gallery.php';
                                                    ?>

                                                    <?php
                                                    $i = 1;
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

                                                        $filename = $thumb_url[0];
                                                        $new_filen = $_SERVER["DOCUMENT_ROOT"].'/wp-content/uploads/' . basename($filename);


                                                        $fileNew = "/wp-content/uploads/" . basename($filename);

                                                        $fileNew = cropImage($filename,
                                                            $_SERVER['DOCUMENT_ROOT'] . $fileNew,
                                                            900, 600);

                                                        $arPostTags = wp_get_post_tags($post->ID);

                                                        unset($arCurrentPostTagsNames);
                                                        foreach ($arPostTags as $tag){
                                                            $arCurrentPostTagsNames[] = $tag->name;
                                                        }
                                                        ?>

                                                    <div
                                                        class="col-md-12 col-sm-12 special-dishes xs-margin-bottom-ten">
                                                        <div class="position-relative"><img
                                                                src="" data-image="<?php echo $fileNew; ?>"
                                                                class="js-img"
                                                                width="900" height="600" alt=""><span
                                                                class="special-dishes-price bg-light-yellow red-text alt-font">
                                                                <?php displayRandomElement($arCurrentPostTagsNames); ?>
                                                            </span>
                                                        </div>
                                                        <p class="text-uppercase letter-spacing-2 font-weight-600 margin-ten no-margin-bottom"
                                                           style="color:#000000;"><?php echo $post->post_title;?></p>
                                                        <p class="margin-two text-med width-90"></p>
                                                        <p class="margin-two text-med width-90">
                                                            <?php
                                                            $post_content = preg_replace("/\\[.+\\]/m","",
                                                                $post->post_content);
                                                            //$post_content = str_replace("\n","<br>",
                                                            //    $post_content);

                                                            echo kama_excerpt( array('text'=>$post_content,
                                                                'maxchar'=>500,
                                                                'autop' => false) );

                                                            ?>
                                                        </p>
                                                        <p></p>
                                                        <div
                                                            class="thin-separator-line bg-dark-gray no-margin-lr"></div>
                                                    </div>

                                                        <?php

                                                        $i++;
                                                    }
                                                    ?>



                                                    <?php

                                                    wp_reset_postdata(); // сброс
                                                    ?>

                                                </div>
                                            </div>
                                        </div>
                                        <div class="feature_nav"><a class="prev left carousel-control"><img alt=""
                                                                                                            src="http://wpdemos.themezaa.com/h-code/wp-content/themes/h-code/assets/images/arrow-pre.png"
                                                                                                            width="96"
                                                                                                            height="96"></a><a
                                                class="next right carousel-control"><img alt=""
                                                                                         src="http://wpdemos.themezaa.com/h-code/wp-content/themes/h-code/assets/images/arrow-next.png"
                                                                                         width="96" height="96"></a>
                                        </div>
                                    </div>
                                    <script type="text/javascript">jQuery(document).ready(function () {
                                            jQuery("#restaurant-popular-dish").owlCarousel({
                                                pagination: false,
                                                autoPlay: false,
                                                stopOnHover: false,
                                                items: 3,
                                                itemsDesktop: [1200, 3],
                                                itemsTablet: [991, 3],
                                                itemsMobile: [700, 1],
                                            });
                                        });</script>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>


                <section id="blog">
                    <div class="container">
                        <div class="row">
                            <div
                                class="wpb_column hcode-column-container  col-md-4 col-xs-mobile-fullwidth col-sm-8 text-center center-col margin-ten-bottom">
                                <div class="vc-column-innner-wrapper">
                                    <div class="dividers-header double-line">
                                        <div class="subheader" style="background-color: #fff;"><h2
                                                class="section-title  no-padding">
                                                Другие проекты
                                            </h2></div>
                                    </div>
                                </div>
                            </div>



                            <?php
                            include $_SERVER['DOCUMENT_ROOT'] . '/includes/portfolio_grid_gallery.php';
                            ?>

                            <?php
                            $i = 1;
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
                                unset($arCurrentPostTagsNames);
                                foreach ($arPostTags as $tag){
                                    $arCurrentPostTagsNames[] = $tag->name;
                                }


                                $filename = $thumb_url[0];
                                $new_filen = $_SERVER["DOCUMENT_ROOT"].'/wp-content/uploads/' . basename($filename);



                                $fileNew900w = "/wp-content/uploads/" . "900w-" . basename($filename);
                                $fileNew900w = cropImage($filename,
                                    $_SERVER['DOCUMENT_ROOT'] . $fileNew800w,
                                    800, 599);


                                $fileNew300w = "/wp-content/uploads/" . "300w-" . basename($filename);
                                $fileNew300w = cropImage($filename,
                                    $_SERVER['DOCUMENT_ROOT'] . $fileNew300w,
                                    300, 200);


                                $fileNew768w = "/wp-content/uploads/" . "768w-" . basename($filename);
                                $fileNew768w = cropImage($filename,
                                    $_SERVER['DOCUMENT_ROOT'] . $fileNew768w,
                                    768, 511);


                                ?>

                                <div
                                        class="wpb_column hcode-column-container  col-md-4 col-xs-mobile-fullwidth col-sm-4 xs-margin-three-bottom wow fadeInUp"
                                        data-wow-duration=300ms>
                                    <div class="vc-column-innner-wrapper">
                                        <div
                                                class="post-8491 post type-post status-publish format-standard has-post-thumbnail hentry category-sample">
                                            <div class="blog-post">
                                                <div class="blog-image"><a
                                                            href="/detail/<?php echo basename(__FILE__); ?>?ID=<?php echo $post->ID; ?>"><img
                                                                width="900" height="599"
                                                                src="<?php echo $fileNew900w; ?>"
                                                                class="attachment-full size-full wp-post-image" alt="" title=""
                                                                srcset="<?php echo $fileNew900w; ?> 900w,
                                                                <?php echo $fileNew300w; ?>300x200.jpg 300w,
                                                                <?php echo $fileNew768w; ?>768x511.jpg 768w"
                                                                sizes="(max-width: 900px) 100vw, 900px"/></a></div>
                                                <div class="post-details"><a
                                                            href="/detail/<?php echo basename(__FILE__); ?>?ID=<?php echo $post->ID; ?>"
                                                            class="post-title sm-margin-top-ten xs-no-margin-top entry-title">
                                                        <?php echo $post->post_title; ?>
                                                    </a><span
                                                            class="post-author light-gray-text2 author vcard">
                                                        <?php echo implode("  ", $arPostTagsNames); ?>
                                                    </span>
                                                    <p class="entry-content">
                                                        <?php
                                                        $post_content = preg_replace("/\\[.+\\]/m","",
                                                            $post->post_content);

                                                        echo kama_excerpt( array('text'=>$post_content,
                                                            'maxchar'=>1000,
                                                            'autop' => false) );

                                                        ?>
                                                    </p></div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <?php

                                if($i == 3) break;
                                $i++;

                            }

                            wp_reset_postdata(); // сброс
                            ?>







                            <div class="wpb_column hcode-column-container  col-xs-mobile-fullwidth">
                                <div class="vc-column-innner-wrapper">
                                    <div class="hcode-space margin-four-bottom"></div>
                                </div>
                            </div>
                            <div
                                class="wpb_column hcode-column-container  col-md-12 col-xs-mobile-fullwidth col-sm-12 text-center wow fadeInUp"
                                data-wow-duration=1200ms>
                                <div class="vc-column-innner-wrapper"><a
                                        href="/projects/" target="_self"
                                        class="inner-link highlight-button-dark btn-small  button btn">
                                        Все проекты
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
                <section class="  cover-background no-padding  js-background"
                         data-image="<? displayRandomElement($currentBackgroundImage); ?>"
                         style=" background-image: url(); ">
                    <div class="container-fluid">
                        <div class="row">
                            <div
                                class="wpb_column hcode-column-container  pull-right col-md-6 col-xs-mobile-fullwidth col-sm-12 padding-seven"
                                style=" background:rgba(0,0,0,0.8);">
                                <div class="vc-column-innner-wrapper"><h1 class="section-title  white-text no-padding">
                                        Детальное описание проекта</h1>
                                    <p class="text-med width-90 margin-five white-text no-margin-bottom">
                                        <?php echo $arProject["post_content_formatted"]; ?>
                                    </p>
                                    <div class="hcode-space margin-four-bottom"></div>
                                    <a href="#contact-us" target="_self"
                                       class="inner-link btn-small-white btn-small  margin-right-20px
                                       button btn">Контакты</a>
                                    <a href="#menu" target="_self"
                                                  class="inner-link btn-small-white btn-small
                                                  button btn">Другие проекты</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
                <?php
                include $_SERVER['DOCUMENT_ROOT'] . '/includes/detail_projects__border-top-1__testimonial-style2__3.php';
                ?>


                <?php
                include $_SERVER['DOCUMENT_ROOT'] . '/includes/detail_contact-us__cover-background-2.php';
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
