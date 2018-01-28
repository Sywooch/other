<?php
/**
 * Created by PhpStorm.
 * User: GSU
 * Date: 29.07.2017
 * Time: 15:52
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
<body class="page-template-default page page-id-7 wpb-js-composer js-comp-ver-5.1 vc_responsive">
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
<section class="parent-section no-padding post-7 page type-page status-publish hentry">
    <div class="container-fluid">
        <div class="row">
            <div class="entry-content">
                <section class="  parallax-fix parallax2 full-screen no-padding   js-background"
                         style=" background-image: url(); "
                         data-image="<? displayRandomElement($currentBackgroundImage);?>">
                    <div class="selection-overlay" style=" opacity:0.7; background-color:#000000;"></div>
                    <div class="container">
                        <div class="row">
                            <div class="wpb_column hcode-column-container  col-xs-mobile-fullwidth">
                                <div class="vc-column-innner-wrapper">
                                    <div class=" full-screen">
                                        <div class="slider-typography spa-slider">
                                            <div class="slider-text-middle-main">
                                                <div class="slider-text-middle"><img
                                                        src="" class="js-img"
                                                        data-image="<? displayRandomElement($arProjectMockups); ?>"
                                                        width="164" height="169" alt=""/><br><br>
                                                    <p class="text-large font-weight-500 text-uppercase light-gray-text letter-spacing-3 margin-two"
                                                       style="color:#ababab;border-color:#ababab">
                                                        <?php echo $arProject["post_title"];?>
                                                    </p>
                                                    <h1 class="white-text letter-spacing-3"><? displayRandomElement($arPostTagsNames); ?></h1></div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>

                <?php
                $arContent = preg_split('/[\n.]/u', $arProject["post_content"],
                    -1, PREG_SPLIT_NO_EMPTY);
                $arContentBlock = array_chunk($arContent, round(count($arContent)/4));

                ?>

                <section>
                    <div class="container">
                        <div class="row">
                            <div class="wpb_column hcode-column-container  col-md-5 col-xs-mobile-fullwidth">
                                <div class="vc-column-innner-wrapper">
                                    <span class="text-large display-block">Краткое</span><span
                                        class="title-large text-uppercase letter-spacing-1
                                        font-weight-600 black-text">Описание проекта</span>
                                    <div class="separator-line-thick bg-fast-pink no-margin-lr"></div>
                                    <p class="no-margin-bottom">
                                        <?php if($arContentBlock[0]) echo implode("\n", $arContentBlock[0]); ?>
                                    </p> <a
                                        class="highlight-button-black-border btn btn-small no-margin-bottom inner-link sm-margin-bottom-ten"
                                        href="/sertificates/" target="_self">
                                        Посмотреть сертификаты
                                    </a></div>
                            </div>

                            <?php
                            $filename = getRandomElement($arProjectImages);
                            $new_filen = $_SERVER["DOCUMENT_ROOT"].'/wp-content/uploads/' . basename($filename);


                            $fileNew = "/wp-content/uploads/" . basename($filename);

                            cropImage($filename,
                                $_SERVER['DOCUMENT_ROOT'] . $fileNew,
                                500, 600);
                            ?>



                            <div
                                class="wpb_column hcode-column-container  col-md-offset-1 col-md-3
                                col-xs-mobile-fullwidth col-sm-6 text-center xs-margin-ten-bottom">
                                <div class="vc-column-innner-wrapper"><img
                                            src="" class="js-img" data-image="<? echo $fileNew; ?>"
                                            width="500" height="600" class=" xs-img-full" alt=""></div>
                            </div>

                            <?php
                            $filename = getRandomElement($arProjectImages);
                            $new_filen = $_SERVER["DOCUMENT_ROOT"].'/wp-content/uploads/' . basename($filename);


                            $fileNew = "/wp-content/uploads/" . basename($filename);

                            cropImage($filename,
                                $_SERVER['DOCUMENT_ROOT'] . $fileNew,
                                500, 600);
                            ?>

                            <div
                                class="wpb_column hcode-column-container  col-md-3 col-xs-mobile-fullwidth
                                col-sm-6 text-center">
                                <div class="vc-column-innner-wrapper"><img
                                            src="" class="js-img" data-image="<? echo $fileNew; ?>"
                                            width="500" height="600" class=" xs-img-full" alt=""></div>
                            </div>
                        </div>
                    </div>
                </section>
                <section class="  fix-background no-padding js-background"
                         style=" background-image: url(); "
                         data-image="<? displayRandomElement($currentBackgroundImage);?>">
                    <div class="container-fluid">
                        <div class="row">
                            <div
                                class="wpb_column hcode-column-container  pull-right col-md-6 col-xs-mobile-fullwidth no-padding"
                                style=" background:#f15a22;">
                                <div class="vc-column-innner-wrapper">
                                    <div class="spa-treatments xs-no-float ">
                                        <div class="right-content col-lg-6 col-md-12"><span
                                                class="title-large text-uppercase white-text font-weight-600
                                                letter-spacing-1">Основные сведения</span>
                                            <ul class="margin-ten white-text">
                                                <li>Год разработки &#8211; <?php echo get_post_meta($arProject["ID"], 'YEAR')[0]; ?></li>

                                                <?php
                                                $URL = get_post_meta($arProject["ID"], 'URL');

                                                if(!empty($URL)) {
                                                ?>
                                                <li>Ссылка на проект &#8211; <a href="<?php echo $URL[0]; ?>"
                                                                                target="_blank">
                                                        <?php echo $URL[0]; ?>
                                                    </a>
                                                </li>
                                                    <?php
                                                }
                                                ?>


                                            </ul>
                                            <p class="white-text no-margin-bottom">

                                            </p></div>
                                        <div
                                            class="col-lg-6 col-md-12 no-padding md-display-none pull-right text-center">

                                            <?php
                                            $filename = getRandomElement($arProjectImages);
                                            $new_filen = $_SERVER["DOCUMENT_ROOT"].'/wp-content/uploads/' . basename($filename);


                                            $fileNew = "/wp-content/uploads/" . basename($filename);

                                            cropImage($filename,
                                                $_SERVER['DOCUMENT_ROOT'] . $fileNew,
                                                500, 600);
                                            ?>

                                            <img alt=""
                                                 src=""
                                                 class="js-img" data-image="<? echo $fileNew; ?>"
                                                 width="500" height="600"></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
                <section>
                    <div class="container">
                        <div class="row">
                            <div class="wpb_column hcode-column-container  col-md-4
                            col-xs-mobile-fullwidth col-sm-12">
                                <div class="vc-column-innner-wrapper">
                                    <span class="text-large display-block">
                                        <?php displayRandomElement($arPostTagsNames); ?>
                                    </span>
                                    <span
                                        class="title-large text-uppercase letter-spacing-1 font-weight-600
                                        black-text"><?php displayRandomElement($arPostTagsNames); ?></span>
                                    <div class="separator-line-thick bg-fast-pink no-margin-lr"></div>
                                    <p></p></div>
                            </div>







                            <?php

                            $randomProjectTagName = $arPostTagsNames[wp_rand(0, count($arPostTagsNames) - 1)];
                            ?>
                            <div
                                class="wpb_column hcode-column-container  col-md-offset-2 col-md-2 col-xs-mobile-fullwidth col-sm-4 text-center xs-margin-ten-bottom">
                                <div class="vc-column-innner-wrapper"><i
                                        class="icon-desktop medium-icon display-block"></i>
                                    <h1 class="font-weight-600 margin-five no-margin-bottom">
                                        <?php echo $arAllTags[$randomProjectTagName]; ?>
                                    </h1>
                                    <p class="text-uppercase letter-spacing-2 text-small margin-three"
                                       style="color:#000000;"><?php echo $randomProjectTagName; ?></p></div>
                            </div>
                            <?php

                            $randomProjectTagName = $arPostTagsNames[wp_rand(0, count($arPostTagsNames) - 1)];
                            ?>
                            <div
                                class="wpb_column hcode-column-container  col-md-2 col-xs-mobile-fullwidth col-sm-4 text-center xs-margin-ten-bottom">
                                <div class="vc-column-innner-wrapper"><i
                                        class="icon-desktop medium-icon display-block"></i>
                                    <h1 class="font-weight-600 margin-five no-margin-bottom">
                                        <?php echo $arAllTags[$randomProjectTagName]; ?>
                                    </h1>
                                    <p class="text-uppercase letter-spacing-2 text-small margin-three"
                                       style="color:#000000;"><?php echo $randomProjectTagName; ?></p></div>
                            </div>
                            <?php

                            $randomProjectTagName = $arPostTagsNames[wp_rand(0, count($arPostTagsNames) - 1)];
                            ?>
                            <div
                                class="wpb_column hcode-column-container  col-md-2 col-xs-mobile-fullwidth col-sm-4 text-center">
                                <div class="vc-column-innner-wrapper"><i
                                        class="icon-desktop medium-icon display-block"></i>
                                    <h1 class="font-weight-600 margin-five no-margin-bottom">
                                        <?php echo $arAllTags[$randomProjectTagName]; ?>
                                    </h1>
                                    <p class="text-uppercase letter-spacing-2 text-small margin-three"
                                       style="color:#000000;"><?php echo $randomProjectTagName; ?></p></div>
                            </div>





                        </div>
                    </div>
                </section>
                <section class="  fix-background no-padding  js-background"
                         style=" background-image: url(); "
                         data-image="<? displayRandomElement($currentBackgroundImage);?>">
                    <div class="container-fluid">
                        <div class="row">
                            <div class="wpb_column hcode-column-container  col-md-6 col-xs-mobile-fullwidth no-padding"
                                 style=" background:#e53878;">
                                <div class="vc-column-innner-wrapper">
                                    <div class="spa-treatments xs-no-float ">
                                        <div
                                            class="col-lg-6 col-md-12 no-padding md-display-none pull-left text-center">

                                            <?php
                                            $filename = getRandomElement($arProjectImages);
                                            $new_filen = $_SERVER["DOCUMENT_ROOT"].'/wp-content/uploads/' . basename($filename);


                                            $fileNew = "/wp-content/uploads/" . basename($filename);

                                            cropImage($filename,
                                                $_SERVER['DOCUMENT_ROOT'] . $fileNew,
                                                500, 600);
                                            ?>

                                            <img alt=""
                                                 src=""
                                                 class="js-img" data-image="<? echo $fileNew; ?>"
                                                 width="500" height="600"></div>

                                        </div>
                                        <div class="right-content col-lg-6 col-md-12"><span
                                                class="title-large text-uppercase white-text font-weight-600 letter-spacing-1">
                                                Случайный текст
                                            </span>

                                            <?php /* ?>
                                            <ul class="margin-ten white-text">
                                                <li>Coloring &#8211; $80</li>
                                                <li>Extension &#8211; $55</li>
                                                <li>All types of haircut &#8211; $45</li>
                                                <li>Highlights &#8211; $55</li>
                                                <li>Keratin Treatment &#8211; $65</li>
                                            </ul>
                                            <?php */ ?>

                                            <p class="white-text no-margin-bottom">
                                                <?php displayRandomElement($currentDetailTitle); ?>
                                            </p></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
                <section>
                    <div class="container">
                        <div class="row">
                            <div class="wpb_column hcode-column-container  col-md-4 col-xs-mobile-fullwidth">
                                <div class="vc-column-innner-wrapper">
                                    <span class="text-large display-block">
                                        <?php displayRandomElement($arPostTagsNames); ?>
                                    </span><span
                                        class="title-large text-uppercase letter-spacing-1
                                        font-weight-600 black-text">
                                        <?php displayRandomElement($arPostTagsNames); ?>
                                    </span>
                                    <div class="separator-line-thick bg-fast-pink no-margin-lr"></div>
                                    <p></p></div>
                            </div>
                            <div
                                class="wpb_column hcode-column-container  col-md-offset-2 col-md-2
                                col-xs-mobile-fullwidth col-sm-4 text-center xs-margin-ten-bottom">
                                <div class="vc-column-innner-wrapper">
                                    <div class="special-gifts-box ">
                                        <span
                                            class="text-uppercase text-small letter-spacing-1">
                                            <?php displayRandomElement($arPostTagsNames); ?>
                                        </span>
                                        <span
                                            class="text-uppercase font-weight-600 letter-spacing-1
                                            black-text display-block"><a
                                                href="#"><?php displayRandomElement($arPostTagsNames); ?></a></span><span
                                            class="gifts-off bg-fast-pink white-text">
                                            <?php displayRandomElement($arPostTagsNames); ?>
                                        </span></div>
                                </div>
                            </div>
                            <div
                                class="wpb_column hcode-column-container  col-md-2 col-xs-mobile-fullwidth col-sm-4 text-center xs-margin-ten-bottom">
                                <div class="vc-column-innner-wrapper">
                                    <div class="special-gifts-box "><span
                                            class="text-uppercase text-small letter-spacing-1">
                                            <?php displayRandomElement($arPostTagsNames); ?>
                                        </span><span
                                            class="text-uppercase font-weight-600 letter-spacing-1 black-text
                                            display-block">
                                            <?php displayRandomElement($arPostTagsNames); ?>
                                        </span><span
                                            class="gifts-off bg-fast-pink white-text">
                                            <?php displayRandomElement($arPostTagsNames); ?>
                                        </span></div>
                                </div>
                            </div>
                            <div
                                class="wpb_column hcode-column-container  col-md-2 col-xs-mobile-fullwidth col-sm-4 text-center">
                                <div class="vc-column-innner-wrapper">
                                    <div class="special-gifts-box "><span
                                            class="text-uppercase text-small letter-spacing-1">
                                            <?php displayRandomElement($arPostTagsNames); ?>
                                        </span><span
                                            class="text-uppercase font-weight-600 letter-spacing-1 black-text display-block"><a
                                                href="#"><?php displayRandomElement($arPostTagsNames); ?></a></span><span
                                            class="gifts-off bg-fast-pink white-text">
                                            <?php displayRandomElement($arPostTagsNames); ?>
                                        </span></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
                <section class="  fix-background no-padding  js-background"
                         style=" background-image: url(); "
                         data-image="<? displayRandomElement($currentBackgroundImage);?>">
                    <div class="container-fluid">
                        <div class="row">
                            <div
                                class="wpb_column hcode-column-container  pull-right col-md-6 col-xs-mobile-fullwidth no-padding"
                                style=" background:#6c407e;">
                                <div class="vc-column-innner-wrapper">
                                    <div class="spa-treatments xs-no-float ">
                                        <div class="right-content col-lg-6 col-md-12"><span
                                                class="title-large text-uppercase white-text font-weight-600 letter-spacing-1">
                                            Тэги проекта
                                            </span>

                                            <ul class="margin-ten white-text">
                                                <?php
                                                foreach($arPostTagsNames as $projectTag){
                                                ?>
                                                    <li><?php echo $projectTag; ?></li>
                                                <? } ?>
                                            </ul>
                                            <p class="white-text no-margin-bottom"></p></div>
                                        <div
                                            class="col-lg-6 col-md-12 no-padding md-display-none pull-right text-center">

                                            <?php
                                            $filename = getRandomElement($arProjectImages);
                                            $new_filen = $_SERVER["DOCUMENT_ROOT"].'/wp-content/uploads/' . basename($filename);


                                            $fileNew = "/wp-content/uploads/" . basename($filename);

                                            cropImage($filename,
                                                $_SERVER['DOCUMENT_ROOT'] . $fileNew,
                                                500, 600);
                                            ?>

                                            <img alt=""
                                                 src=""
                                                 class="js-img" data-image="<? echo $fileNew; ?>"
                                                 width="500" height="600"></div>

                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
                <section>
                    <div class="container">
                        <div class="row">
                            <div class="wpb_column hcode-column-container  col-md-4 col-xs-mobile-fullwidth">
                                <div class="vc-column-innner-wrapper">
                                    <span class="text-large display-block">Краткое</span><span
                                        class="title-large text-uppercase letter-spacing-1 font-weight-600 black-text">
                                        Описание проекта
                                    </span>
                                    <div class="separator-line-thick bg-fast-pink no-margin-lr"></div>
                                    <p class="no-margin-bottom">
                                        <?php if($arContentBlock[1]) echo implode("\n", $arContentBlock[1]); ?>

                                    </p> <a
                                        class="highlight-button-black-border btn btn-small no-margin-bottom inner-link sm-margin-bottom-ten"
                                        href="/projects/" target="_self">Посмотреть проекты</a></div>
                            </div>
                            <div
                                class="wpb_column hcode-column-container  col-md-offset-1 col-md-7
                                col-xs-mobile-fullwidth">
                                <div class="vc-column-innner-wrapper">
                                    <div class="panel-group toggles-style3">


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

                                        cropImage($filename,
                                            $_SERVER['DOCUMENT_ROOT'] . $fileNew,
                                            500, 500);
                                        ?>



                                        <div class="panel panel-default">
                                            <div class="panel-heading">
                                                <a data-toggle="collapse"
                                                                                           data-parent="#test"

                                                   href="#accordian-panel-<?php echo $i; ?>">
                                                    <h4
                                                        class="panel-title">0<?php echo $i; ?>. <?php echo $post->post_title; ?><span
                                                            class="pull-right"><i class="fa fa-minus"></i></span></h4>
                                                </a></div>
                                            <div id="accordian-panel-<?php echo $i; ?>" class="panel-collapse collapse">
                                                <div class="panel-body">
                                                    <div
                                                        class="col-md-2 col-sm-2 col-xs-6 no-padding
                                                        xs-margin-bottom-five">


                                                        <img
                                                                src=""
                                                                class="js-img" data-image="<?php echo $fileNew; ?>"
                                                                alt="" class="white-round-border no-border spa-packages-img"
                                                            width="500" height="500"/></div>
                                                    <div
                                                        class="col-md-9 col-sm-9 col-xs-12 sm-pull-right col-md-offset-1 no-padding">
                                                        <p class="text">
                                                            <?php
                                                            $post_content = preg_replace("/\\[.+\\]/m","",
                                                                $post->post_content);
                                                            //$post_content = str_replace("\n","<br>",
                                                            //    $post_content);

                                                            echo kama_excerpt( array('text'=>$post_content,
                                                                'maxchar'=>500,
                                                                'autop' => false) );

                                                            ?>
                                                        </p> <a
                                                            class="highlight-button-dark btn btn-very-small button"
                                                            target="_self"
                                                            href="/detail/<?php echo basename(__FILE__); ?>?ID=<?php echo $post->ID; ?>">Детали</a></div>
                                                </div>
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
                            </div>
                        </div>
                    </div>
                </section>
                <section class="  cover-background wow fadeIn js-background"
                         style=" background-image: url(); "
                         data-image="<? displayRandomElement($currentBackgroundImage);?>">
                    <div class="selection-overlay" style=" opacity:0.8; background-color:#000000;"></div>
                    <div class="container">
                        <div class="row">
                            <div
                                class="wpb_column hcode-column-container  col-md-6 col-xs-mobile-fullwidth col-sm-10 center-col">
                                <div class="vc-column-innner-wrapper">
                                    <div class="testimonial-slider position-relative no-transition">
                                        <div id="hcode-testimonial"
                                             class="owl-pagination-bottom position-relative  round-pagination
                                             light-pagination white-cursor">




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

                                            cropImage($filename,
                                                $_SERVER['DOCUMENT_ROOT'] . $fileNew,
                                                300, 300);
                                            ?>

                                            <div
                                                class="col-md-12 col-sm-12 col-xs-12 testimonial-style2
                                                center-col
                                                 text-center margin-three no-margin-top">
                                                <img alt="" data-image="<?php echo $fileNew; ?>"
                                                     src="" class="js-img"
                                                     width="300" height="300">
                                                <p class="white-text text-med">
                                                    <?php
                                                    $post_content = preg_replace("/\\[.+\\]/m","",
                                                        $post->post_content);
                                                    //$post_content = str_replace("\n","<br>",
                                                    //    $post_content);

                                                    echo kama_excerpt( array('text'=>$post_content,
                                                        'maxchar'=>1000,
                                                        'autop' => false) );

                                                    ?>
                                                </p>
                                                <span class="name light-gray-text2" style="color:#ffffff">
                                                    <?php echo $post->post_title; ?>
                                                </span>
                                            </div>

                                                <?php


                                            }

                                            wp_reset_postdata(); // сброс
                                            ?>

                                        </div>
                                    </div>
                                    <script type="text/javascript">/*<![CDATA[*/
                                        jQuery(document).ready(function () {
                                            jQuery("#hcode-testimonial").owlCarousel({
                                                pagination: true,
                                                singleItem: true,
                                                navigationText: ["<i class='fa fa-angle-left'></i>", "<i class='fa fa-angle-right'></i>"]
                                            });
                                        });
                                        /*]]>*/</script>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
                <section>
                    <div class="container">
                        <div class="row">
                            <div class="wpb_column hcode-column-container  col-md-4 col-xs-mobile-fullwidth">
                                <div class="vc-column-innner-wrapper">
                                    <span class="text-large display-block">
                                        <?php displayRandomElement($arPostTagsNames); ?>
                                    </span><span
                                        class="title-large text-uppercase letter-spacing-1 font-weight-600
                                        black-text"><?php displayRandomElement($arPostTagsNames); ?></span>
                                    <div class="separator-line-thick bg-fast-pink no-margin-lr"></div>
                                    <p></p> <a
                                        class="highlight-button-black-border btn btn-small no-margin-bottom inner-link sm-margin-bottom-ten"
                                        href="/projects/best/" target="_self">
                                        Лучшие проекты
                                    </a></div>
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



                            $fileNew800w = "/wp-content/uploads/" . "800w-" . basename($filename);
                            cropImage($filename,
                                $_SERVER['DOCUMENT_ROOT'] . $fileNew800w,
                                800, 502);


                                $fileNew300w = "/wp-content/uploads/" . "300w-" . basename($filename);
                                cropImage($filename,
                                    $_SERVER['DOCUMENT_ROOT'] . $fileNew300w,
                                    300, 188);



                                $fileNew768w = "/wp-content/uploads/" . "768w-" . basename($filename);
                                cropImage($filename,
                                    $_SERVER['DOCUMENT_ROOT'] . $fileNew768w,
                                    768, 482);



                                $fileNew133w = "/wp-content/uploads/" . "133w-" . basename($filename);
                                cropImage($filename,
                                    $_SERVER['DOCUMENT_ROOT'] . $fileNew133w,
                                    133, 83);



                                $fileNew374w = "/wp-content/uploads/" . "374w-" . basename($filename);
                                cropImage($filename,
                                    $_SERVER['DOCUMENT_ROOT'] . $fileNew374w,
                                    374, 234);

                                ?>

                            <div
                                class="wpb_column hcode-column-container  col-md-4
                                col-xs-mobile-fullwidth col-sm-6 xs-margin-ten-bottom">
                                <div class="vc-column-innner-wrapper">
                                    <div
                                        class="post-3935 post type-post status-publish format-image
                                        has-post-thumbnail hentry category-feature
                                        post_format-post-format-image">
                                        <div class="blog-post">
                                            <div class="blog-image"><a
                                                    href="/detail/<?php echo basename(__FILE__); ?>?ID=<?php echo $post->ID; ?>">
                                                    <img
                                                        width="800" height="502"
                                                        src="<?php echo $fileNew800w; ?>"
                                                        class="attachment-full size-full wp-post-image" alt="" title=""
                                                        srcset="<?php echo $fileNew800w; ?> 800w,
                                                        <?php echo $fileNew300w; ?> 300w,
                                                        <?php echo $fileNew768w; ?> 768w,
                                                        <?php echo $fileNew133w; ?> 133w,
                                                        <?php echo $fileNew374w; ?> 374w"
                                                        sizes="(max-width: 800px) 100vw, 800px"/></a></div>
                                            <div class="post-details"><a
                                                    href="/detail/<?php echo basename(__FILE__); ?>?ID=<?php echo $post->ID; ?>"
                                                    class="post-title sm-margin-top-ten xs-no-margin-top entry-title">
                                                    <?php echo $post->post_title; ?>
                                                </a>
                                                <span
                                                    class="post-author light-gray-text2 author vcard">
                                                <?php echo implode("  ", $arPostTagsNames); ?>
                                                </span>
                                                <p class="entry-content">
                                                    <?php
                                                    $post_content = preg_replace("/\\[.+\\]/m","",
                                                        $post->post_content);
                                                    //$post_content = str_replace("\n","<br>",
                                                    //    $post_content);

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

                                if($i == 2) break;
                                $i++;

                            }

                            wp_reset_postdata(); // сброс
                            ?>




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