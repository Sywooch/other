<?php
/**
 * Created by PhpStorm.
 * User: GSU
 * Date: 29.07.2017
 * Time: 15:17
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
<body class="page-template-default page page-id-40 wpb-js-composer js-comp-ver-5.1 vc_responsive">
<?php
$gal = get_post_gallery( $arProject["ID"], false );
$arIDs = explode(',', $gal['ids']);

foreach($arIDs as $keyImageID => $itemImageID) {

    $arMetaImage = wp_get_attachment_metadata($itemImageID);

    $thumb_img = get_post($itemImageID);

    if($thumb_img->post_excerpt == "PERSONAL_MOCKUP"){

        $arProjectMockups[] = PORTFOLIO_WP_UPLOAD_DIR_URL."".$arMetaImage["file"];

    }

}

if(!$arProjectMockups){
    $thumb_id = get_post_thumbnail_id($arProject["ID"]);
    $thumb_url = wp_get_attachment_image_src($thumb_id, 'full',
        false);

    $thumb_url[0] = str_replace(get_site_url(),
        PORTFOLIO_WP_URL,
        $thumb_url[0]);
    $arProjectMockups[] = $thumb_url[0];
}
?>
<section class="parent-section no-padding post-40 page type-page status-publish hentry">
    <div class="container-fluid">
        <div class="row">
            <div class="entry-content">
                <section class=" no-transition intro-page no-padding">
                    <div class="container">
                        <div class="row">
                            <div class="wpb_column hcode-column-container  col-xs-mobile-fullwidth">
                                <div class="vc-column-innner-wrapper">
                                    <div class="wpb_revslider_element wpb_content_element">
                                        <link
                                            href="http://fonts.googleapis.com/css?family=Open+Sans:300|Raleway:900|Oswald:300"
                                            rel="stylesheet" property="stylesheet" type="text/css" media="all">
                                        <div id="rev_slider_8_1_wrapper" class="rev_slider_wrapper
                                        fullscreen-container"
                                             data-source="gallery" style="background:#000000;padding:0px;">
                                            <div id="rev_slider_8_1" class="rev_slider fullscreenbanner"
                                                 style="display:none;" data-version="5.4.1">
                                                <ul>
                                                    <li data-index="rs-24" data-transition="slideleft"
                                                        data-slotamount="default" data-hideafterloop="0"
                                                        data-hideslideonmobile="off" data-easein="default"
                                                        data-easeout="default" data-masterspeed="500"
                                                        data-thumb="<?php if($currentBackgroundDarkImage[0]) echo $currentBackgroundDarkImage[0]; ?>"
                                                        data-delay="8000" data-rotate="0" data-fstransition="slideleft"
                                                        data-fsmasterspeed="500" data-fsslotamount="4"
                                                        data-saveperformance="off" class="no-transition"
                                                        data-title="главная" data-param1="" data-param2=""
                                                        data-param3="" data-param4="" data-param5="" data-param6=""
                                                        data-param7="" data-param8="" data-param9="" data-param10=""
                                                        data-description="">


                                                        <img
                                                            src="<?php if($currentBackgroundDarkImage[0]) echo $currentBackgroundDarkImage[0]; ?>" 
data-image="<?php if($currentBackgroundDarkImage[0]) echo $currentBackgroundDarkImage[0]; ?>"
                                                            alt="" title="intro-01" width="1024" height="576"
                                                            data-bgposition="center center" data-kenburns="on"
                                                            data-duration="9000" data-ease="Linear.easeNone"
                                                            data-scalestart="100" data-scaleend="130"
                                                            data-rotatestart="0" data-rotateend="0"
                                                            data-blurstart="0"
                                                            data-blurend="0" data-offsetstart="0 0"
                                                            data-offsetend="0 0"
                                                            class="rev-slidebg js-img" data-no-retina>
                                                      

                                                        <div
                                                            class="tp-caption Fashion-BigDisplay   tp-resizeme  tp-caption light_medium_60_white_text sfb stt tp-resizeme"
                                                            id="slide-24-layer-3" data-x="center" data-hoffset=""
                                                            data-y="bottom" data-voffset="80" data-width="['auto']"
                                                            data-height="['auto']" data-type="text"
                                                            data-responsive_offset="on"
                                                            data-frames='[{"delay":1300,"speed":600,"frame":"0","from":"y:50px;opacity:0;","to":"o:1;","ease":"Power4.easeOut"},{"delay":"+1500","speed":600,"frame":"999","to":"y:-50px;opacity:0;","ease":"nothing"}]'
                                                            data-textAlign="['center','center','center','center']"
                                                            data-paddingtop="[0,0,0,0]" data-paddingright="[0,0,0,0]"
                                                            data-paddingbottom="[0,0,0,0]" data-paddingleft="[0,0,0,0]"
                                                            style="z-index: 5; white-space: nowrap; font-size: 32px; line-height: 40px; font-weight: 300; color: rgba(249,249,249,1); letter-spacing: px;font-family:Open Sans;text-transform:uppercase;z-index:2;letter-spacing:4px;text-align:center;">
                                                            <?php echo $arProject["post_title"]; ?>
                                                        </div>
                                                        <div class="tp-caption   tp-resizeme  tp-caption lft ltt"
                                                             id="slide-24-layer-1" data-x="center" data-hoffset=""
                                                             data-y="100" data-width="['none','none','none','none']"
                                                             data-height="['none','none','none','none']"
                                                             data-type="image" data-responsive_offset="on"
                                                             data-frames='[{"delay":800,"speed":600,"frame":"0","from":"y:top;","to":"o:1;","ease":"Power4.easeOut"},{"delay":"+6000","speed":600,"frame":"999","to":"y:top;","ease":"Power4.easeIn"}]'
                                                             data-textAlign="['left','left','left','left']"
                                                             data-paddingtop="[0,0,0,0]" data-paddingright="[0,0,0,0]"
                                                             data-paddingbottom="[0,0,0,0]" data-paddingleft="[0,0,0,0]"
                                                             style="z-index: 6;text-transform:uppercase;z-index:2;">
                                                            
                                                            <img
                                                                src="<?php echo PERSONAL_WP_HCODE_URL; ?>/h-code/wp-content/uploads/2015/10/logo-light-big.png"
                                                                alt="" data-ww="78px" data-hh="78px" width="78"
                                                                height="78" data-no-retina>

                                                        </div>
                                                        <div class="tp-caption Fashion-BigDisplay   tp-resizeme"
                                                             id="slide-24-layer-2" data-x="center" data-hoffset="-1"
                                                             data-y="center" data-voffset="112" data-width="['auto']"
                                                             data-height="['auto']" data-type="text"
                                                             data-responsive_offset="on"
                                                             data-frames='[{"delay":800,"speed":600,"frame":"0","from":"y:bottom;","to":"o:1;","ease":"Power4.easeOut"},{"delay":"+6500","speed":600,"frame":"999","to":"y:bottom;","ease":"Power4.easeOut"}]'
                                                             data-textAlign="['left','left','left','left']"
                                                             data-paddingtop="[0,0,0,0]" data-paddingright="[0,0,0,0]"
                                                             data-paddingbottom="[0,0,0,0]" data-paddingleft="[0,0,0,0]"
                                                             style="z-index: 7; white-space: nowrap; letter-spacing: ;text-transform:uppercase;z-index:2;">
                                                            <div class="separator-line bg-yellow"></div>
                                                        </div>
                                                        <div
                                                            class="tp-caption Fashion-BigDisplay   tp-resizeme  tp-caption
                                                            light_medium_60_white_text sfb ltb tp-resizeme"
                                                            id="slide-24-layer-4" data-x="center" data-hoffset=""
                                                            data-y="center" data-voffset="199" data-width="['465']"
                                                            data-height="['auto']" data-type="text"
                                                            data-responsive_offset="on"
                                                            data-frames='[{"delay":4500,"speed":600,"frame":"0","from":"y:50px;opacity:0;","to":"o:1;","ease":"Power4.easeInOut"},{"delay":"+2300","speed":600,"frame":"999","to":"y:bottom;","ease":"Power4.easeIn"}]'
                                                            data-textAlign="['center','center','center','center']"
                                                            data-paddingtop="[0,0,0,0]" data-paddingright="[0,0,0,0]"
                                                            data-paddingbottom="[0,0,0,0]" data-paddingleft="[0,0,0,0]"
                                                            style="z-index: 8; min-width: 465px; max-width: 465px; white-space: normal; font-size: 32px; line-height: 40px; font-weight: 300; color: rgba(255,255,255,1); letter-spacing: px;font-family:Open Sans;text-transform:uppercase;text-decoration:none;z-index:2;letter-spacing:4px;text-align:center;">
                                                            <?php
                                                            $arPostTags = wp_get_post_tags($arProject["ID"]);
                                                            unset($arPostTagsNames);
                                                            foreach ($arPostTags as $keyTag => $tag) {
                                                                $postTagId = $tag->term_id;
                                                                $arPostTagsNames[] = $tag->name;

                                                            }

$strPostTagNames = implode("   ", $arPostTagsNames);
echo $strPostTagNames;
                                                            ?>
                                                        </div>
                                                    </li>
                                                    <li data-index="rs-25" data-transition="slideleft"
                                                        data-slotamount="default" data-hideafterloop="0"
                                                        data-hideslideonmobile="off" data-easein="default"
                                                        data-easeout="default" data-masterspeed="1000"
                                                        data-thumb="<?php if($currentBackgroundDarkImage[1]) echo $currentBackgroundDarkImage[1]; ?>"
                                                        data-delay="10000" data-rotate="0" data-saveperformance="off"
                                                        data-title="описание проекта" data-param1="" data-param2=""
                                                        data-param3="" data-param4="" data-param5="" data-param6=""
                                                        data-param7="" data-param8="" data-param9="" data-param10=""
                                                        data-description=""><img
                                                            src="<?php if($currentBackgroundDarkImage[1]) echo $currentBackgroundDarkImage[1]; ?>" 
data-image="<?php if($currentBackgroundDarkImage[1]) echo $currentBackgroundDarkImage[1]; ?>"
                                                            alt="" title="intro-03" width="1024" height="576"
                                                            data-bgposition="center center" data-kenburns="on"
                                                            data-duration="10000" data-ease="Linear.easeNone"
                                                            data-scalestart="100" data-scaleend="130"
                                                            data-rotatestart="0" data-rotateend="0" data-blurstart="0"
                                                            data-blurend="0" data-offsetstart="0 0" data-offsetend="0 0"
                                                            class="rev-slidebg js-img" data-no-retina>
                                                        <div class="tp-caption Fashion-BigDisplay   tp-resizeme"
                                                             id="slide-25-layer-2" data-x="center" data-hoffset=""
                                                             data-y="center" data-voffset="32" data-width="['auto']"
                                                             data-height="['auto']" data-type="text"
                                                             data-responsive_offset="on"
                                                             data-frames='[{"delay":800,"speed":600,"frame":"0","from":"y:bottom;","to":"o:1;","ease":"Power4.easeOut"},{"delay":"+8000","speed":600,"frame":"999","to":"y:bottom;","ease":"Power4.easeIn"}]'
                                                             data-textAlign="['center','center','center','center']"
                                                             data-paddingtop="[0,0,0,0]" data-paddingright="[0,0,0,0]"
                                                             data-paddingbottom="[0,0,0,0]" data-paddingleft="[0,0,0,0]"
                                                             style="z-index: 5; white-space: nowrap; color: rgba(226,192,68,1); letter-spacing: px;z-index:2;">
                                                            <div class="separator-line bg-yellow"></div>
                                                        </div>


                                                        <?php
                                                        $arProject["post_content"] =  preg_replace("/\\[.+\\]/m","", $arProject["post_content"]);
                                                        $arContent = preg_split('/[\n.]/u', $arProject["post_content"], -1, PREG_SPLIT_NO_EMPTY);

$arContentBlock = array_chunk($arContent, round(count($arContent)/3));



                                                        ?>

                                     
  <div
                                                            class="tp-caption Fashion-BigDisplay   tp-resizeme  tp-caption light_medium_20_white_text sfl str tp-resizeme"
                                                            id="slide-25-layer-3" data-x="center" data-hoffset=""
                                                            data-y="center" data-voffset="-90" data-width="['auto']"
                                                            data-height="['auto']" data-type="text"
                                                            data-responsive_offset="on"
                                                            data-frames='[{"delay":1300,"speed":600,"frame":"0","from":"x:-50px;opacity:0;","to":"o:1;","ease":"Power4.easeOut"},{"delay":"+1500","speed":600,"frame":"999","to":"x:50px;opacity:0;","ease":"Power4.easeIn"}]'
                                                            data-textAlign="['center','center','center','center']"
                                                            data-paddingtop="[0,0,0,0]" data-paddingright="[0,0,0,0]"
                                                            data-paddingbottom="[0,0,0,0]" data-paddingleft="[0,0,0,0]"
                                                            style="z-index: 6; white-space: nowrap; font-size: 20px; line-height: 30px; font-weight: 300; color: rgba(255,255,255,1); letter-spacing: px;font-family:Open Sans;text-transform:uppercase;text-decoration:none;z-index:2;text-align:center;letter-spacing:4px;">
                                                            <?php
if($arContentBlock[0]){
 echo implode("\n", $arContentBlock[0]); 
}
?>
                                                         </div>

                                                        <div
                                                            class="tp-caption Fashion-BigDisplay   tp-resizeme  tp-caption light_medium_20_white_text sfl str tp-resizeme"
                                                            id="slide-25-layer-4" data-x="center" data-hoffset=""
                                                            data-y="center" data-voffset="-90" data-width="['auto']"
                                                            data-height="['auto']" data-type="text"
                                                            data-responsive_offset="on"
                                                            data-frames='[{"delay":4500,"speed":600,"frame":"0","from":"x:-50px;opacity:0;","to":"o:1;","ease":"Power4.easeOut"},{"delay":"+2300","speed":600,"frame":"999","to":"y:-50px;opacity:0;","ease":"Power4.easeIn"}]'
                                                            data-textAlign="['center','center','center','center']"
                                                            data-paddingtop="[0,0,0,0]" data-paddingright="[0,0,0,0]"
                                                            data-paddingbottom="[0,0,0,0]" data-paddingleft="[0,0,0,0]"
                                                            style="z-index: 7; white-space: nowrap; font-size: 20px; line-height: 30px; font-weight: 300; color: rgba(255,255,255,1); letter-spacing: px;font-family:Open Sans;text-transform:uppercase;text-decoration:none;z-index:2;text-align:center;letter-spacing:4px;">
                                                            <?php 
if($arContentBlock[1]){
echo implode("\n", $arContentBlock[1]); 
}
?>
                                                        </div>
                                                        <div
                                                            class="tp-caption Fashion-BigDisplay   tp-resizeme  tp-caption light_medium_20_white_text sfl stt tp-resizeme"
                                                            id="slide-25-layer-5" data-x="center" data-hoffset=""
                                                            data-y="center" data-voffset="-90" data-width="['auto']"
                                                            data-height="['auto']" data-type="text"
                                                            data-responsive_offset="on"
                                                            data-frames='[{"delay":8500,"speed":600,"frame":"0","from":"x:-50px;opacity:0;","to":"o:1;","ease":"Power4.easeOut"},{"delay":"+600","speed":300,"frame":"999","to":"y:-50px;opacity:0;","ease":"nothing"}]'
                                                            data-textAlign="['center','center','center','center']"
                                                            data-paddingtop="[0,0,0,0]" data-paddingright="[0,0,0,0]"
                                                            data-paddingbottom="[0,0,0,0]" data-paddingleft="[0,0,0,0]"
                                                            style="z-index: 8; white-space: nowrap; font-size: 20px; line-height: 30px; font-weight: 300; color: rgba(255,255,255,1); letter-spacing: px;font-family:Open Sans;text-transform:uppercase;text-decoration:none;z-index:2;text-align:center;letter-spacing:4px;">
                                                            <?php 
if($arContentBlock[2]){
echo implode("\n", $arContentBlock[2]); 
}
?>
                                                        </div>
                                                        



                                                        
                                                        <div
                                                            class="tp-caption Fashion-BigDisplay   tp-resizeme  tp-caption sfb stb tp-resizeme"
                                                            id="slide-25-layer-6" data-x="100" data-y="center"
                                                            data-voffset="150" data-width="['auto']"
                                                            data-height="['auto']" data-type="text"
                                                            data-responsive_offset="on"
                                                            data-frames='[{"delay":1300,"speed":600,"frame":"0","from":"y:50px;opacity:0;","to":"o:1;","ease":"Power4.easeOut"},{"delay":"+2000","speed":600,"frame":"999","to":"y:50px;opacity:0;","ease":"Power4.easeIn"}]'
                                                            data-textAlign="['center','center','center','center']"
                                                            data-paddingtop="[0,0,0,0]" data-paddingright="[0,0,0,0]"
                                                            data-paddingbottom="[0,0,0,0]" data-paddingleft="[0,0,0,0]"
                                                            style="z-index: 9; white-space: nowrap; font-size: 14px; line-height: 20px; font-weight: 300; color: rgba(255,255,255,1); letter-spacing: px;font-family:Open Sans;z-index:2;text-align:center;">
                                                            <div>
                                                                
                                                                <div class="intro-icon-text"><?php if($arPostTagsNames[0]) echo $arPostTagsNames[0]; ?></div>
                                                            </div>
                                                        </div>
                                                        <div class="tp-caption Fashion-BigDisplay   tp-resizeme"
                                                             id="slide-25-layer-7" data-x="center" data-hoffset=""
                                                             data-y="center" data-voffset="150" data-width="['244']"
                                                             data-height="['auto']" data-type="text"
                                                             data-responsive_offset="on"
                                                             data-frames='[{"delay":1500,"speed":600,"frame":"0","from":"y:50px;opacity:0;","to":"o:1;","ease":"Power4.easeOut"},{"delay":"+1800","speed":600,"frame":"999","to":"y:50px;opacity:0;","ease":"Power4.easeIn"}]'
                                                             data-textAlign="['center','center','center','center']"
                                                             data-paddingtop="[0,0,0,0]" data-paddingright="[0,0,0,0]"
                                                             data-paddingbottom="[0,0,0,0]" data-paddingleft="[0,0,0,0]"
                                                             style="z-index: 10; min-width: 244px; max-width: 244px; white-space: normal; font-size: 14px; line-height: 22px; font-weight: 300; color: rgba(255,255,255,1); letter-spacing: px;font-family:Open Sans;z-index:2;text-align:center;">
                                                            <div>
                                                                
                                                                <div class="intro-icon-text"><?php if($arPostTagsNames[1]) echo $arPostTagsNames[1]; ?></div>
                                                            </div>
                                                        </div>
                                                        <div
                                                            class="tp-caption Fashion-BigDisplay   tp-resizeme  tp-caption sfb stb tp-resizeme"
                                                            id="slide-25-layer-9" data-x="right" data-hoffset="100"
                                                            data-y="center" data-voffset="150" data-width="['auto']"
                                                            data-height="['auto']" data-type="text"
                                                            data-responsive_offset="on"
                                                            data-frames='[{"delay":1700,"speed":600,"frame":"0","from":"y:50px;opacity:0;","to":"o:1;","ease":"Power4.easeOut"},{"delay":"+1600","speed":600,"frame":"999","to":"y:50px;opacity:0;","ease":"Power4.easeIn"}]'
                                                            data-textAlign="['center','center','center','center']"
                                                            data-paddingtop="[0,0,0,0]" data-paddingright="[0,0,0,0]"
                                                            data-paddingbottom="[0,0,0,0]" data-paddingleft="[0,0,0,0]"
                                                            style="z-index: 11; white-space: nowrap; font-size: 14px; line-height: 22px; font-weight: 300; color: rgba(255,255,255,1); letter-spacing: px;font-family:Open Sans;z-index:2;text-align:center;">
                                                            <div>
                                                                
                                                                <div class="intro-icon-text"><?php if($arPostTagsNames[2]) echo $arPostTagsNames[2]; ?></div>
                                                            </div>
                                                        </div>
                                                        <div
                                                            class="tp-caption Fashion-BigDisplay   tp-resizeme  tp-caption sfb ltb tp-resizeme"
                                                            id="slide-25-layer-10" data-x="100" data-y="center"
                                                            data-voffset="150" data-width="['auto']"
                                                            data-height="['auto']" data-type="text"
                                                            data-responsive_offset="on"
                                                            data-frames='[{"delay":4900,"speed":600,"frame":"0","from":"y:50px;opacity:0;","to":"o:1;","ease":"Power4.easeOut"},{"delay":"+4200","speed":300,"frame":"999","to":"y:bottom;","ease":"nothing"}]'
                                                            data-textAlign="['center','center','center','center']"
                                                            data-paddingtop="[0,0,0,0]" data-paddingright="[0,0,0,0]"
                                                            data-paddingbottom="[0,0,0,0]" data-paddingleft="[0,0,0,0]"
                                                            style="z-index: 12; white-space: nowrap; font-size: 14px; line-height: 22px; font-weight: 300; color: rgba(255,255,255,1); letter-spacing: px;font-family:Open Sans;z-index:2;text-align:center;">
                                                            <div>
                                                              
                                                                <div class="intro-icon-text"><?php if($arPostTagsNames[3]) echo $arPostTagsNames[3]; ?></div>
                                                            </div>
                                                        </div>
                                                        <div
                                                            class="tp-caption Fashion-BigDisplay   tp-resizeme  tp-caption sfb ltb tp-resizeme"
                                                            id="slide-25-layer-12"
                                                            title="tp-caption sfb ltb tp-resizeme" data-x="right"
                                                            data-hoffset="118" data-y="center" data-voffset="150"
                                                            data-width="['auto']" data-height="['auto']"
                                                            data-type="text" data-responsive_offset="on"
                                                            data-frames='[{"delay":5300,"speed":600,"frame":"0","from":"y:50px;opacity:0;","to":"o:1;","ease":"Power4.easeOut"},{"delay":"+3800","speed":300,"frame":"999","to":"y:bottom;","ease":"nothing"}]'
                                                            data-textAlign="['center','center','center','center']"
                                                            data-paddingtop="[0,0,0,0]" data-paddingright="[0,0,0,0]"
                                                            data-paddingbottom="[0,0,0,0]" data-paddingleft="[0,0,0,0]"
                                                            style="z-index: 13; white-space: nowrap; font-size: 14px; line-height: 22px; font-weight: 300; color: rgba(255,255,255,1); letter-spacing: px;font-family:Open Sans;z-index:2;text-align:center;">
                                                            <div>
                                                                
                                                                <div class="intro-icon-text"><?php if($arPostTagsNames[4]) echo $arPostTagsNames[4]; ?></div>
                                                            </div>
                                                        </div>
                                                        
                                                        <div class="tp-caption Fashion-BigDisplay   tp-resizeme"
                                                             id="slide-25-layer-13" data-x="center" data-hoffset=""
                                                             data-y="165" data-width="['auto']" data-height="['auto']"
                                                             data-type="text" data-responsive_offset="on"
                                                             data-frames='[{"delay":800,"speed":600,"frame":"0","from":"y:top;","to":"o:1;","ease":"Power4.easeOut"},{"delay":"+8000","speed":600,"frame":"999","to":"y:top;","ease":"Power4.easeIn"}]'
                                                             data-textAlign="['left','left','left','left']"
                                                             data-paddingtop="[0,0,0,0]" data-paddingright="[0,0,0,0]"
                                                             data-paddingbottom="[0,0,0,0]" data-paddingleft="[0,0,0,0]"
                                                             style="z-index: 14; white-space: nowrap; font-size: 30px; line-height: 30px; font-weight: 300; color: rgba(255,255,255,1); letter-spacing: ;font-family:Oswald;text-transform:uppercase;text-decoration:none;background-color:transparent;z-index:2;letter-spacing:6px;">
                                                            Описание проекта
                                                        </div>
                                                        <div class="tp-caption Fashion-BigDisplay   tp-resizeme"
                                                             id="slide-25-layer-14" data-x="center" data-hoffset=""
                                                             data-y="center" data-voffset="150" data-width="['auto']"
                                                             data-height="['auto']" data-type="text"
                                                             data-responsive_offset="on"
                                                             data-frames='[{"delay":5100,"speed":600,"frame":"0","from":"y:50px;opacity:0;","to":"o:1;","ease":"Power4.easeOut"},{"delay":"+4000","speed":300,"frame":"999","to":"y:bottom;","ease":"nothing"}]'
                                                             data-textAlign="['center','center','center','center']"
                                                             data-paddingtop="[0,0,0,0]" data-paddingright="[0,0,0,0]"
                                                             data-paddingbottom="[0,0,0,0]" data-paddingleft="[0,0,0,0]"
                                                             style="z-index: 15; white-space: nowrap; font-size: 14px; line-height: 22px; font-weight: 300; color: rgba(255,255,255,1); letter-spacing: px;font-family:Open Sans;z-index:2;text-align:center;">
                                                            
                                                            <div class="intro-icon-text"><?php if($arPostTagsNames[0]) echo $arPostTagsNames[0]; ?></div>
                                                        </div>
                                                    </li>
                                                    <li data-index="rs-26" data-transition="slideleft"
                                                        data-slotamount="1" data-hideafterloop="0"
                                                        data-hideslideonmobile="off" data-easein="default"
                                                        data-easeout="default" data-masterspeed="1000"
                                                        data-thumb="<?php if($currentBackgroundDarkImage[2]) echo $currentBackgroundDarkImage[2]; ?>"
                                                        data-delay="12000" data-rotate="0" data-saveperformance="off"
                                                        data-title="галерея проекта" data-param1="" data-param2=""
                                                        data-param3="" data-param4="" data-param5="" data-param6=""
                                                        data-param7="" data-param8="" data-param9="" data-param10=""
                                                        data-description=""><img
                                                            src="<?php if($currentBackgroundDarkImage[2]) echo $currentBackgroundDarkImage[2]; ?>" 
data-image="<?php if($currentBackgroundDarkImage[2]) echo $currentBackgroundDarkImage[2]; ?>"
                                                            alt="" title="intro-02" width="1024" height="576"
                                                            data-bgposition="center center" data-kenburns="on"
                                                            data-duration="10000" data-ease="Linear.easeNone"
                                                            data-scalestart="100" data-scaleend="130"
                                                            data-rotatestart="0" data-rotateend="0" data-blurstart="0"
                                                            data-blurend="0" data-offsetstart="0 0" data-offsetend="0 0"
                                                            class="rev-slidebg js-img" data-no-retina>
                                                        <div
                                                            class="tp-caption Fashion-BigDisplay   tp-resizeme  tp-caption light_medium_big lft ltt"
                                                            id="slide-26-layer-1" data-x="center" data-hoffset=""
                                                            data-y="165" data-width="['auto']" data-height="['auto']"
                                                            data-type="text" data-responsive_offset="on"
                                                            data-frames='[{"delay":800,"speed":600,"frame":"0","from":"y:top;","to":"o:1;","ease":"Power4.easeOut"},{"delay":"+10000","speed":600,"frame":"999","to":"y:top;","ease":"Power4.easeIn"}]'
                                                            data-textAlign="['center','center','center','center']"
                                                            data-paddingtop="[0,0,0,0]" data-paddingright="[0,0,0,0]"
                                                            data-paddingbottom="[0,0,0,0]" data-paddingleft="[0,0,0,0]"
                                                            style="z-index: 5; white-space: nowrap; font-size: 30px; line-height: 30px; font-weight: 300; color: rgba(255,255,255,1); letter-spacing: px;font-family:Oswald;text-transform:uppercase;text-decoration:none;background-color:transparent;z-index:2;letter-spacing:6px;">
                                                            Галерея проекта
                                                        </div>
                                                        
                                                        <div
                                                            class="tp-caption Fashion-BigDisplay   tp-resizeme  tp-caption light_medium_20_white_text sfl str tp-resizeme"
                                                            id="slide-26-layer-4" data-x="center" data-hoffset=""
                                                            data-y="center" data-voffset="-90" data-width="['auto']"
                                                            data-height="['auto']" data-type="text"
                                                            data-responsive_offset="on"
                                                            data-frames='[{"delay":4500,"speed":600,"frame":"0","from":"x:-50px;opacity:0;","to":"o:1;","ease":"Power4.easeOut"},{"delay":"+2300","speed":600,"frame":"999","to":"x:50px;opacity:0;","ease":"Power4.easeIn"}]'
                                                            data-textAlign="['center','center','center','center']"
                                                            data-paddingtop="[0,0,0,0]" data-paddingright="[0,0,0,0]"
                                                            data-paddingbottom="[0,0,0,0]" data-paddingleft="[0,0,0,0]"
                                                            style="z-index: 6; white-space: nowrap; font-size: 20px; line-height: 30px; font-weight: 300; color: rgba(255,255,255,1); letter-spacing: px;font-family:Open Sans;text-transform:uppercase;text-decoration:none;z-index:2;text-align:center;letter-spacing:4px;">
                                                           <?php if($arPostTagsNames[0]) echo $arPostTagsNames[0]; ?>
                                                        </div>
                                                        <div
                                                            class="tp-caption Fashion-BigDisplay   tp-resizeme  tp-caption light_medium_20_white_text sfl str tp-resizeme"
                                                            id="slide-26-layer-3" data-x="center" data-hoffset=""
                                                            data-y="center" data-voffset="-90" data-width="['auto']"
                                                            data-height="['auto']" data-type="text"
                                                            data-responsive_offset="on"
                                                            data-frames='[{"delay":1300,"speed":600,"frame":"0","from":"x:-50px;opacity:0;","to":"o:1;","ease":"Power4.easeOut"},{"delay":"+1500","speed":600,"frame":"999","to":"x:50px;opacity:0;","ease":"Power4.easeIn"}]'
                                                            data-textAlign="['center','center','center','center']"
                                                            data-paddingtop="[0,0,0,0]" data-paddingright="[0,0,0,0]"
                                                            data-paddingbottom="[0,0,0,0]" data-paddingleft="[0,0,0,0]"
                                                            style="z-index: 7; white-space: nowrap; font-size: 20px; line-height: 30px; font-weight: 300; color: rgba(255,255,255,1); letter-spacing: px;font-family:Open Sans;text-transform:uppercase;text-decoration:none;z-index:2;text-align:center;letter-spacing:4px;">
                                                            <?php if($arPostTagsNames[1]) echo $arPostTagsNames[1]; ?>
                                                        </div>
                                                        

                                                        <div class="tp-caption Fashion-BigDisplay   tp-resizeme"
                                                             id="slide-26-layer-2" data-x="center" data-hoffset=""
                                                             data-y="center" data-voffset="32" data-width="['auto']"
                                                             data-height="['auto']" data-type="text"
                                                             data-responsive_offset="on"
                                                             data-frames='[{"delay":800,"speed":600,"frame":"0","from":"y:bottom;","to":"o:1;","ease":"Power4.easeOut"},{"delay":"+10300","speed":600,"frame":"999","to":"y:bottom;","ease":"Power4.easeIn"}]'
                                                             data-textAlign="['center','center','center','center']"
                                                             data-paddingtop="[0,0,0,0]" data-paddingright="[0,0,0,0]"
                                                             data-paddingbottom="[0,0,0,0]" data-paddingleft="[0,0,0,0]"
                                                             style="z-index: 8; white-space: nowrap; color: rgba(230,175,42,1); letter-spacing: px;text-transform:uppercase;z-index:2;">
                                                            <div class="separator-line bg-yellow"></div>
                                                        </div>

                                                        
                                                        <div
                                                            class="tp-caption Fashion-BigDisplay   tp-resizeme  tp-caption light_medium_20_white_text sfl stt tp-resizeme"
                                                            id="slide-26-layer-5" data-x="center" data-hoffset=""
                                                            data-y="center" data-voffset="-90" data-width="['auto']"
                                                            data-height="['auto']" data-type="text"
                                                            data-responsive_offset="on"
                                                            data-frames='[{"delay":8500,"speed":600,"frame":"0","from":"x:-50px;opacity:0;","to":"o:1;","ease":"Power4.easeOut"},{"delay":"+2600","speed":300,"frame":"999","to":"y:-50px;opacity:0;","ease":"nothing"}]'
                                                            data-textAlign="['center','center','center','center']"
                                                            data-paddingtop="[0,0,0,0]" data-paddingright="[0,0,0,0]"
                                                            data-paddingbottom="[0,0,0,0]" data-paddingleft="[0,0,0,0]"
                                                            style="z-index: 9; white-space: nowrap; font-size: 20px; line-height: 30px; font-weight: 300; color: rgba(255,255,255,1); letter-spacing: px;font-family:Open Sans;text-transform:uppercase;text-decoration:none;z-index:2;text-align:center;letter-spacing:4px;">
                                                            <?php if($arPostTagsNames[2]) echo $arPostTagsNames[2]; ?>
                                                        </div>

                                                        <?php
$gal = get_post_gallery( $arProject["ID"], false );
                            $arIDs = explode(',', $gal['ids']);

                            foreach($arIDs as $keyImageID => $itemImageID) {

                                $arMetaImage = wp_get_attachment_metadata($itemImageID);

                                $thumb_img = get_post($itemImageID);

                                if($thumb_img->post_excerpt == ""){

                                    $arProjectImages[] = PORTFOLIO_WP_UPLOAD_DIR_URL."".$arMetaImage["file"];

                                }

                            }



                                                        ?>
 <? if($arProjectImages[0]){ ?>
  <a class="tp-caption   tp-resizeme  tp-caption
                                                            sfb stb tp-resizeme"
                                                               href="#" target="_blank" id="slide-26-layer-8"
                                                               data-x="center" data-hoffset="345" data-y="center"
                                                               data-voffset="150"
                                                               data-width="['none','none','none','none']"
                                                               data-height="['none','none','none','none']"
                                                               data-type="image"
                                                               data-actions='' data-responsive_offset="on"
                                                               data-frames='[{"delay":1300,"speed":600,"frame":"0","from":"y:50px;opacity:0;","to":"o:1;","ease":"Power4.easeOut"},{"delay":"+3000","speed":600,"frame":"999","to":"y:50px;opacity:0;","ease":"Power4.easeIn"}]'
                                                               data-textAlign="['left','left','left','left']"
                                                               data-paddingtop="[0,0,0,0]" data-paddingright="[0,0,0,0]"
                                                               data-paddingbottom="[0,0,0,0]"
                                                               data-paddingleft="[0,0,0,0]"
                                                               style="z-index: 10;z-index:2;text-align:center;text-decoration: none;">
                                                                <img
                                                                        src="<?php echo $arProjectImages[0]; ?>"
data-image="<?php echo $arProjectImages[0]; ?>" 
                                                                        alt="" data-ww="174px" data-hh="106px"
                                                                        width="174"
                                                                        height="106"
                                                                         data-no-retina>
                                                            </a>
<? } ?>
                                                 <? if($arProjectImages[1]){ ?>
                                                        <a
                                                            class="tp-caption   tp-resizeme  tp-caption sfb stb tp-resizeme"
                                                            href="#" target="_blank" id="slide-26-layer-9"
                                                            data-x="center" data-hoffset="115" data-y="center"
                                                            data-voffset="150"
                                                            data-width="['none','none','none','none']"
                                                            data-height="['none','none','none','none']"
                                                            data-type="image" data-actions=''
                                                            data-responsive_offset="on"
                                                            data-frames='[{"delay":1500,"speed":600,"frame":"0","from":"y:50px;opacity:0;","to":"o:1;","ease":"Power4.easeOut"},{"delay":"+3000","speed":600,"frame":"999","to":"y:50px;opacity:0;","ease":"Power4.easeIn"}]'
                                                            data-textAlign="['left','left','left','left']"
                                                            data-paddingtop="[0,0,0,0]" data-paddingright="[0,0,0,0]"
                                                            data-paddingbottom="[0,0,0,0]" data-paddingleft="[0,0,0,0]"
                                                            style="z-index: 11;z-index:2;text-align:center;text-decoration: none;">
<img
                                                                        src="<?php echo $arProjectImages[1]; ?>"
data-image="<?php echo $arProjectImages[1]; ?>"
                                                                        alt="" data-ww="174px" data-hh="106px"
                                                                        width="174"
                                                                        height="106"
                                                                         data-no-retina></a><? } ?> <? if($arProjectImages[2]){ ?> <a
                                                            class="tp-caption   tp-resizeme  tp-caption sfb stb tp-resizeme"
                                                            href="#" target="_blank" id="slide-26-layer-10"
                                                            data-x="center" data-hoffset="-115" data-y="center"
                                                            data-voffset="150"
                                                            data-width="['none','none','none','none']"
                                                            data-height="['none','none','none','none']"
                                                            data-type="image" data-actions=''
                                                            data-responsive_offset="on"
                                                            data-frames='[{"delay":1700,"speed":600,"frame":"0","from":"y:50px;opacity:0;","to":"o:1;","ease":"Power4.easeOut"},{"delay":"+3000","speed":600,"frame":"999","to":"y:50px;opacity:0;","ease":"Power4.easeIn"}]'
                                                            data-textAlign="['left','left','left','left']"
                                                            data-paddingtop="[0,0,0,0]" data-paddingright="[0,0,0,0]"
                                                            data-paddingbottom="[0,0,0,0]" data-paddingleft="[0,0,0,0]"
                                                            style="z-index: 12;z-index:2;text-align:center;text-decoration: none;"><img
                                                                        src="<?php echo $arProjectImages[2]; ?>"
data-image="<?php echo $arProjectImages[2]; ?>"
                                                                        alt="" data-ww="174px" data-hh="106px"
                                                                        width="174"
                                                                        height="106"
                                                                         data-no-retina> </a><? } ?><? if($arProjectImages[3]){ ?> <a
                                                            class="tp-caption   tp-resizeme  tp-caption sfb stb tp-resizeme"
                                                            href="#" target="_blank" id="slide-26-layer-11"
                                                            data-x="center" data-hoffset="-345" data-y="center"
                                                            data-voffset="150"
                                                            data-width="['none','none','none','none']"
                                                            data-height="['none','none','none','none']"
                                                            data-type="image" data-actions=''
                                                            data-responsive_offset="on"
                                                            data-frames='[{"delay":1900,"speed":600,"frame":"0","from":"y:50px;opacity:0;","to":"o:1;","ease":"Power4.easeOut"},{"delay":"+3000","speed":600,"frame":"999","to":"y:50px;opacity:0;","ease":"Power4.easeIn"}]'
                                                            data-textAlign="['left','left','left','left']"
                                                            data-paddingtop="[0,0,0,0]" data-paddingright="[0,0,0,0]"
                                                            data-paddingbottom="[0,0,0,0]" data-paddingleft="[0,0,0,0]"
                                                            style="z-index: 13;z-index:2;text-align:center;text-decoration: none;"><img
                                                                        src="<?php echo $arProjectImages[3]; ?>"
data-image="<?php echo $arProjectImages[3]; ?>"
                                                                        alt="" data-ww="174px" data-hh="106px"
                                                                        width="174"
                                                                        height="106"
                                                                         data-no-retina> </a><? } ?>


<? if($arProjectImages[4]){ ?>
                                                        <a
                                                            class="tp-caption   tp-resizeme  tp-caption sfb stb tp-resizeme"
                                                            href="#" target="_blank" id="slide-26-layer-12"
                                                            data-x="center" data-hoffset="345" data-y="center"
                                                            data-voffset="150"
                                                            data-width="['none','none','none','none']"
                                                            data-height="['none','none','none','none']"
                                                            data-type="image" data-actions=''
                                                            data-responsive_offset="on"
                                                            data-frames='[{"delay":6600,"speed":600,"frame":"0","from":"y:50px;opacity:0;","to":"o:1;","ease":"Power4.easeOut"},{"delay":"+4500","speed":300,"frame":"999","to":"y:50px;opacity:0;","ease":"nothing"}]'
                                                            data-textAlign="['left','left','left','left']"
                                                            data-paddingtop="[0,0,0,0]" data-paddingright="[0,0,0,0]"
                                                            data-paddingbottom="[0,0,0,0]" data-paddingleft="[0,0,0,0]"
                                                            style="z-index: 14;z-index:2;text-align:center;text-decoration: none;"><img
                                                                        src="<?php echo $arProjectImages[4]; ?>"
data-image="<?php echo $arProjectImages[4]; ?>" 
                                                                        alt="" data-ww="174px" data-hh="106px"
                                                                        width="174"
                                                                        height="106"
                                                                         data-no-retina> </a><? } ?> <? if($arProjectImages[5]){ ?><a
                                                            class="tp-caption   tp-resizeme  tp-caption sfb stb tp-resizeme"
                                                            href="#" target="_blank" id="slide-26-layer-13"
                                                            data-x="center" data-hoffset="115" data-y="center"
                                                            data-voffset="150"
                                                            data-width="['none','none','none','none']"
                                                            data-height="['none','none','none','none']"
                                                            data-type="image" data-actions=''
                                                            data-responsive_offset="on"
                                                            data-frames='[{"delay":6800,"speed":600,"frame":"0","from":"y:50px;opacity:0;","to":"o:1;","ease":"Power4.easeOut"},{"delay":"+4300","speed":300,"frame":"999","to":"y:50px;opacity:0;","ease":"nothing"}]'
                                                            data-textAlign="['left','left','left','left']"
                                                            data-paddingtop="[0,0,0,0]" data-paddingright="[0,0,0,0]"
                                                            data-paddingbottom="[0,0,0,0]" data-paddingleft="[0,0,0,0]"
                                                            style="z-index: 15;z-index:2;text-align:center;text-decoration: none;"><img
                                                                       src="<?php echo $arProjectImages[5]; ?>"
data-image="<?php echo $arProjectImages[5]; ?>" 
                                                                        alt="" data-ww="174px" data-hh="106px"
                                                                        width="174"
                                                                        height="106"
                                                                         data-no-retina> </a><? } ?> <? if($arProjectImages[6]){ ?><a
                                                            class="tp-caption   tp-resizeme  tp-caption sfb stb tp-resizeme"
                                                            href="#" target="_blank" id="slide-26-layer-14"
                                                            data-x="center" data-hoffset="-115" data-y="center"
                                                            data-voffset="150"
                                                            data-width="['none','none','none','none']"
                                                            data-height="['none','none','none','none']"
                                                            data-type="image" data-actions=''
                                                            data-responsive_offset="on"
                                                            data-frames='[{"delay":7000,"speed":600,"frame":"0","from":"y:50px;opacity:0;","to":"o:1;","ease":"Power4.easeOut"},{"delay":"+4100","speed":300,"frame":"999","to":"y:50px;opacity:0;","ease":"nothing"}]'
                                                            data-textAlign="['left','left','left','left']"
                                                            data-paddingtop="[0,0,0,0]" data-paddingright="[0,0,0,0]"
                                                            data-paddingbottom="[0,0,0,0]" data-paddingleft="[0,0,0,0]"
                                                            style="z-index: 16;z-index:2;text-align:center;text-decoration: none;"><img
                                                                        src="<?php echo $arProjectImages[6]; ?>"
data-image="<?php echo $arProjectImages[6]; ?>"
                                                                        alt="" data-ww="174px" data-hh="106px"
                                                                        width="174"
                                                                        height="106"
                                                                         data-no-retina> </a><? } ?> <? if($arProjectImages[7]){ ?><a
                                                            class="tp-caption Fashion-BigDisplay   tp-resizeme  tp-caption sfb stb tp-resizeme"
                                                            href="#" target="_blank" id="slide-26-layer-15"
                                                            data-x="center" data-hoffset="-345" data-y="center"
                                                            data-voffset="150"
                                                            data-width="['none','none','none','none']"
                                                            data-height="['none','none','none','none']"
                                                            data-type="image" data-actions=''
                                                            data-responsive_offset="on"
                                                            data-frames='[{"delay":7200,"speed":600,"frame":"0","from":"y:50px;opacity:0;","to":"o:1;","ease":"Power4.easeOut"},{"delay":"+3900","speed":300,"frame":"999","to":"y:50px;opacity:0;","ease":"nothing"}]'
                                                            data-textAlign="['left','left','left','left']"
                                                            data-paddingtop="[0,0,0,0]" data-paddingright="[0,0,0,0]"
                                                            data-paddingbottom="[0,0,0,0]" data-paddingleft="[0,0,0,0]"
                                                            style="z-index: 17;z-index:2;text-align:center;text-decoration: none;">

                                                           <img
                                                                     src="<?php echo $arProjectImages[7]; ?>"
data-image="<?php echo $arProjectImages[7]; ?>" 
                                                                        alt="" data-ww="174px" data-hh="106px"
                                                                        width="174"
                                                                        height="106"
                                                                         data-no-retina>



                                                        </a><? } ?>

                                                        </li>
                                                    <li data-index="rs-27" data-transition="slideleft"
                                                        data-slotamount="1" data-hideafterloop="0"
                                                        data-hideslideonmobile="off" data-easein="default"
                                                        data-easeout="default" data-masterspeed="1000"
                                                        data-thumb="<?php if($currentBackgroundDarkImage[3]) echo $currentBackgroundDarkImage[3]; ?>"
                                                        data-delay="12000" data-rotate="0" data-saveperformance="off"
                                                        data-title="обратная связь" data-param1="" data-param2=""
                                                        data-param3="" data-param4="" data-param5="" data-param6=""
                                                        data-param7="" data-param8="" data-param9="" data-param10=""
                                                        data-description=""><img
                                                            src="<?php if($currentBackgroundDarkImage[3]) echo $currentBackgroundDarkImage[3]; ?>" data-image="<?php if($currentBackgroundDarkImage[3]) echo $currentBackgroundDarkImage[3]; ?>"
                                                            alt="" title="intro-04" width="1024" height="576"
                                                            data-bgposition="center center" data-kenburns="on"
                                                            data-duration="10000" data-ease="Linear.easeNone"
                                                            data-scalestart="100" data-scaleend="130"
                                                            data-rotatestart="0" data-rotateend="0" data-blurstart="0"
                                                            data-blurend="0" data-offsetstart="0 0" data-offsetend="0 0"
                                                            class="rev-slidebg js-img" data-no-retina>
                                                        <div
                                                            class="tp-caption Fashion-BigDisplay   tp-resizeme  tp-caption light_medium_big lft ltt"
                                                            id="slide-27-layer-1" data-x="center" data-hoffset=""
                                                            data-y="165" data-width="['auto']" data-height="['auto']"
                                                            data-type="text" data-responsive_offset="on"
                                                            data-frames='[{"delay":800,"speed":600,"frame":"0","from":"y:top;","to":"o:1;","ease":"Power4.easeOut"},{"delay":"+10000","speed":600,"frame":"999","to":"y:top;","ease":"Power4.easeIn"}]'
                                                            data-textAlign="['center','center','center','center']"
                                                            data-paddingtop="[0,0,0,0]" data-paddingright="[0,0,0,0]"
                                                            data-paddingbottom="[0,0,0,0]" data-paddingleft="[0,0,0,0]"
                                                            style="z-index: 5; white-space: nowrap; font-size: 30px; line-height: 30px; font-weight: 300; color: rgba(255,255,255,1); letter-spacing: px;font-family:Oswald;text-transform:uppercase;text-decoration:none;background-color:transparent;z-index:2;letter-spacing:6px;">
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
                                                             id="slide-27-layer-2" data-x="center" data-hoffset=""
                                                             data-y="center" data-voffset="32" data-width="['auto']"
                                                             data-height="['auto']" data-type="text"
                                                             data-responsive_offset="on"
                                                             data-frames='[{"delay":800,"speed":600,"frame":"0","from":"y:bottom;","to":"o:1;","ease":"Power4.easeOut"},{"delay":"+10300","speed":300,"frame":"999","to":"y:bottom;","ease":"Power4.easeIn"}]'
                                                             data-textAlign="['center','center','center','center']"
                                                             data-paddingtop="[0,0,0,0]" data-paddingright="[0,0,0,0]"
                                                             data-paddingbottom="[0,0,0,0]" data-paddingleft="[0,0,0,0]"
                                                             style="z-index: 6; white-space: nowrap; color: rgba(255,255,255,1); letter-spacing: px;text-transform:uppercase;z-index:2;">
                                                            <div class="separator-line bg-yellow"></div>
                                                        </div>





                                                        <div class="tp-caption Fashion-BigDisplay   tp-resizeme"
                                                             id="slide-27-layer-3" data-x="center" data-hoffset=""
                                                             data-y="center" data-voffset="-90" data-width="['auto']"
                                                             data-height="['auto']" data-type="text"
                                                             data-responsive_offset="on"
                                                             data-frames='[{"delay":1300,"speed":600,"frame":"0","from":"x:-50px;opacity:0;","to":"o:1;","ease":"Power4.easeOut"},{"delay":"+1500","speed":600,"frame":"999","to":"x:50px;opacity:0;","ease":"Power4.easeIn"}]'
                                                             data-textAlign="['left','left','left','left']"
                                                             data-paddingtop="[0,0,0,0]" data-paddingright="[0,0,0,0]"
                                                             data-paddingbottom="[0,0,0,0]" data-paddingleft="[0,0,0,0]"
                                                             style="z-index: 7; white-space: nowrap; font-size: 20px; line-height: 30px; font-weight: 300; color: rgba(255,255,255,1); letter-spacing: ;font-family:Open Sans;text-transform:uppercase;text-decoration:none;z-index:2;text-align:center;letter-spacing:4px;">
                                                            <?php if($arPostTagsNames[0]) echo $arPostTagsNames[0]; ?>
                                                        </div>


                                                        
                                                        <div
                                                            class="tp-caption Fashion-BigDisplay   tp-resizeme  tp-caption light_medium_20_white_text sfl str tp-resizeme"
                                                            id="slide-27-layer-4" data-x="center" data-hoffset=""
                                                            data-y="center" data-voffset="-90" data-width="['auto']"
                                                            data-height="['auto']" data-type="text"
                                                            data-responsive_offset="on"
                                                            data-frames='[{"delay":4500,"speed":600,"frame":"0","from":"x:-50px;opacity:0;","to":"o:1;","ease":"Power4.easeOut"},{"delay":"+2300","speed":600,"frame":"999","to":"x:50px;opacity:0;","ease":"Power4.easeIn"}]'
                                                            data-textAlign="['center','center','center','center']"
                                                            data-paddingtop="[0,0,0,0]" data-paddingright="[0,0,0,0]"
                                                            data-paddingbottom="[0,0,0,0]" data-paddingleft="[0,0,0,0]"
                                                            style="z-index: 8; white-space: nowrap; font-size: 20px; line-height: 30px; font-weight: 300; color: rgba(255,255,255,1); letter-spacing: px;font-family:Open Sans;text-transform:uppercase;text-decoration:none;z-index:2;text-align:center;letter-spacing:4px;">
                                                           <?php if($arPostTagsNames[1]) echo $arPostTagsNames[1]; ?>
                                                        </div>
                                                        <div
                                                            class="tp-caption Fashion-BigDisplay   tp-resizeme  tp-caption light_medium_20_white_text sfl stt tp-resizeme"
                                                            id="slide-27-layer-5" data-x="center" data-hoffset=""
                                                            data-y="center" data-voffset="-90" data-width="['auto']"
                                                            data-height="['auto']" data-type="text"
                                                            data-responsive_offset="on"
                                                            data-frames='[{"delay":8500,"speed":600,"frame":"0","from":"x:-50px;opacity:0;","to":"o:1;","ease":"Power4.easeOut"},{"delay":"+2600","speed":300,"frame":"999","to":"y:-50px;opacity:0;","ease":"nothing"}]'
                                                            data-textAlign="['center','center','center','center']"
                                                            data-paddingtop="[0,0,0,0]" data-paddingright="[0,0,0,0]"
                                                            data-paddingbottom="[0,0,0,0]" data-paddingleft="[0,0,0,0]"
                                                            style="z-index: 9; white-space: nowrap; font-size: 20px; line-height: 30px; font-weight: 300; color: rgba(255,255,255,1); letter-spacing: px;font-family:Open Sans;text-transform:uppercase;text-decoration:none;z-index:2;text-align:center;letter-spacing:4px;">
                                                           <?php if($arPostTagsNames[2]) echo $arPostTagsNames[2]; ?>
                                                        </div>
                                                        






                                                        <div
                                                            class="tp-caption Fashion-BigDisplay   tp-resizeme  tp-caption light_medium_40_white_text sfb stb tp-resizeme"
                                                            id="slide-27-layer-6" data-x="center" data-hoffset=""
                                                            data-y="center" data-voffset="105" data-width="['auto']"
                                                            data-height="['auto']" data-type="text"
                                                            data-responsive_offset="on"
                                                            data-frames='[{"delay":1500,"speed":600,"frame":"0","from":"y:50px;opacity:0;","to":"o:1;","ease":"Power4.easeOut"},{"delay":"+9600","speed":300,"frame":"999","to":"y:50px;opacity:0;","ease":"nothing"}]'
                                                            data-textAlign="['center','center','center','center']"
                                                            data-paddingtop="[0,0,0,0]" data-paddingright="[0,0,0,0]"
                                                            data-paddingbottom="[0,0,0,0]" data-paddingleft="[0,0,0,0]"
                                                            style="z-index: 10; white-space: nowrap; font-size: 40px; line-height: 44px; font-weight: 300; color: rgba(255,255,255,1); letter-spacing: px;font-family:Open Sans;text-transform:uppercase;text-decoration:none;z-index:2;text-align:center;letter-spacing:5px;">
                                                            Вы можете заказать разработку аналогичного проекта
                                                        </div>
                                                        <a class="tp-caption rev-btn  tp-resizeme" href="/feedback/simple/"
                                                           target="_blank" id="slide-27-layer-7" data-x="center"
                                                           data-hoffset="" data-y="bottom" data-voffset="150"
                                                           data-width="['auto']" data-height="['auto']"
                                                           data-type="button" data-actions=''
                                                           data-responsive_offset="on"
                                                           data-frames='[{"delay":1200,"speed":500,"frame":"0","from":"opacity:0;","to":"o:1;","ease":"Power3.easeInOut"},{"delay":"+9300","speed":1000,"frame":"999","to":"opacity:0;","ease":"Power2.easeIn"},{"frame":"hover","speed":"0","ease":"Linear.easeNone","to":"o:1;rX:0;rY:0;rZ:0;z:0;","style":"c:rgba(0, 0, 0, 1);bg:rgba(255, 255, 255, 1);bs:solid;bw:0 0 0 0;"}]'
                                                           data-textAlign="['left','left','left','left']"
                                                           data-paddingtop="[10,10,10,10]"
                                                           data-paddingright="[30,30,30,30]"
                                                           data-paddingbottom="[10,10,10,10]"
                                                           data-paddingleft="[30,30,30,30]"
                                                           style="z-index: 11; white-space: nowrap; font-size: 11px; line-height: 22px; font-weight: 300; color: rgba(255,255,255,1); letter-spacing: px;font-family:Open Sans;text-transform:uppercase;text-decoration:none;background-color:rgba(0, 0, 0, 0.75);border-color:rgba(0, 0, 0, 1);z-index:4;font-weight:400;font-size:11px;letter-spacing:3px;color:#fff !important;padding:6px 25px;background:transparent;border:2px solid #fff;display:inline-block;cursor:pointer;text-decoration: none;">Заказать</a></li>
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
                                                        e.c = jQuery('#rev_slider_8_1');
                                                        e.gridwidth = [1170];
                                                        e.gridheight = [700];
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
                                                var revapi8;
                                                tpj(document).ready(function () {
                                                    if (tpj("#rev_slider_8_1").revolution == undefined) {
                                                        revslider_showDoubleJqueryError("#rev_slider_8_1");
                                                    } else {
                                                        revapi8 = tpj("#rev_slider_8_1").show().revolution({
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
                                                                    hide_delay: 1200,
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
                                                            viewPort: {
                                                                enable: true,
                                                                outof: "wait",
                                                                visible_area: "80%",
                                                                presize: false
                                                            },
                                                            visibilityLevels: [1240, 1024, 778, 480],
                                                            gridwidth: 1170,
                                                            gridheight: 700,
                                                            lazyType: "none",
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
include $_SERVER['DOCUMENT_ROOT'] . '/includes/footer_scripts_detail_intro.php';

include $_SERVER['DOCUMENT_ROOT'] . '/includes/detail_pagination_intro.php';
?>



<script type="text/javascript"
        src="/includes/js/images.js"></script>


</body>
</html>