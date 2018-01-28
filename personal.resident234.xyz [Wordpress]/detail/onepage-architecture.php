<?php
/**
 * Created by PhpStorm.
 * User: GSU
 * Date: 29.07.2017
 * Time: 15:28
 */


require $_SERVER['DOCUMENT_ROOT'] . '/wp-load.php';
include $_SERVER['DOCUMENT_ROOT'] . '/includes/head.php';

global $wpdb;
$wpdb->set_prefix('portfolio_');


include $_SERVER['DOCUMENT_ROOT'] . '/includes/feedback_send.php';

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
<body class="page-template-default page page-id-45 wpb-js-composer js-comp-ver-5.1 vc_responsive">
<nav
    class="navbar navbar-default navbar-fixed-top nav-transparent overlay-nav sticky-nav white-header nav-border-bottom  nav-black "
    data-menu-hover-delay="100">
    <div class="container">
        <div class="row">
            <?php
            include $_SERVER['DOCUMENT_ROOT'] . '/includes/head_logo_white.php';
            ?>
            <div class="navbar-header col-sm-8 sm-width-auto col-xs-2 pull-right">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse"><span
                        class="sr-only">Toggle navigation</span> <span class="icon-bar"></span> <span
                        class="icon-bar"></span> <span class="icon-bar"></span></button>
            </div>
            <div class="col-md-8 no-padding-right accordion-menu text-right pull-right menu-position-right">
                <div id="mega-menu" class="navbar-collapse collapse navbar-right">
                    <ul id="menu-onepage-architecture" class="mega-menu-ul nav navbar-nav navbar-right panel-group">
                        <?php
                        include $_SERVER['DOCUMENT_ROOT'] . '/includes/main_menu.php';
                        ?>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</nav>
<section class="parent-section no-padding post-45 page type-page status-publish hentry">
    <div class="container-fluid">
        <div class="row">
            <div class="entry-content">
                <section id="slider" class="  no-padding">
                    <div class="container-fluid">
                        <div class="row">
                            <div class="wpb_column hcode-column-container  col-xs-mobile-fullwidth">
                                <div class="vc-column-innner-wrapper">
                                    <div class="architecture-slider">



                                        <div id="onepage-home-architecture"
                                             class="owl-carousel owl-theme  dot-pagination dark-pagination dark-navigation cursor-black onepage-home-architecture hcode-owl-slider11 ">

                                            <?php
                                            $arContent = preg_split('/[\n.]/u', $arProject["post_content"], -1, PREG_SPLIT_NO_EMPTY);

                                            $arContentBlock = array_chunk($arContent, round(count($arContent)/count($arProjectAllImages)));

                                            ?>

                                            <?php
                                            foreach($arProjectAllImages as $keyProjectImage => $projectImage) {

                                                ?>
                                                <div class="item owl-bg-img js-background"
                                                     style="background-image:url()"
                                                     data-image="<?php echo $projectImage; ?>">
                                                    <div class="bg-slider"></div>
                                                    <div class="slider-headline">
                                                        <div class="slider-text-middle-main">
                                                            <div class="slider-text-middle">
                                                                <h1 class="yellow-text">
                                                                    <?php echo $arProject["post_title"];?>
                                                                </h1>
                                                                <h2 class="white-text alt-font">
                                                                    <?php displayRandomElement($arPostTagsNames); ?>
                                                                </h2></div>
                                                        </div>
                                                    </div>
                                                    <div class="full-screen architecture-full-screen position-relative">
                                                        <div class="slider-typography bg-light-gray3">
                                                            <div class="slider-text-middle-main">
                                                                <div class="slider-text-middle">
                                                                    <div
                                                                            class="separator-line bg-yellow
                                                                            margin-three sm-margin-bottom-five"></div>
                                                                    <span
                                                                            class="owl-title black-text col-xs-12
                                                                            lg-margin-bottom-five">
                                                                        <?php
                                                                        if($arContentBlock[$keyProjectImage])
                                                                            echo implode("\n", $arContentBlock[$keyProjectImage]);

                                                                        ?>
                                                                    </span>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>

                                                <?php
                                            }
                                            ?>



                                        </div>
                                    </div>
                                    <script type="text/javascript">/*<![CDATA[*/
                                        jQuery(document).ready(function () {
                                            jQuery("#onepage-home-architecture").owlCarousel({
                                                navigation: false,
                                                pagination: true,
                                                transitionStyle: "fade",
                                                autoPlay: false,
                                                stopOnHover: false,
                                                addClassActive: false,
                                                singleItem: true,
                                                paginationSpeed: 400,
                                                navigationText: ["<i class='fa fa-angle-left'></i>", "<i class='fa fa-angle-right'></i>"]
                                            });
                                        });
                                        /*]]>*/</script>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
                <section id="tabs">
                    <div class="container">
                        <div class="row">
                            <div
                                class="wpb_column hcode-column-container  col-md-12 col-xs-mobile-fullwidth text-center">
                                <div class="vc-column-innner-wrapper">
                                    <h3 class="section-title  black-text"
                                                                          style="font-weight:600 !important;;">
                                        Тэги проекта</h3></div>
                            </div>
                            <div
                                class="wpb_column hcode-column-container  col-md-12 col-xs-mobile-fullwidth text-center">
                                <div class="vc-column-innner-wrapper">
                                    <div id="animated-tab4"
                                         class="architecture-company hcode-animated-tabs animated-tab4">
                                        <ul class="nav nav-tabs no-margin-bottom">


                                            <?php
                                            foreach($arPostTagsNames as $keyTagName => $tagName) {
                                                ?>

                                                <li class="nav active">
                                                    <a href="#hcode-1501308158-2029551456-<?php echo $keyTagName; ?>"
                                                                          class="xs-min-height-inherit xs-no-padding"
                                                                          data-toggle="tab"><span><i
                                                                    class="icon-desktop"></i></span></a><br><a
                                                            href="#hcode-1501308158-2029551456-<?php echo $keyTagName; ?>"
                                                            class="xs-min-height-inherit xs-no-padding body-text"
                                                            data-toggle="tab"><span
                                                                class="text-small text-uppercase letter-spacing-3
                                                                margin-five font-weight-600 xs-letter-spacing-none
                                                                xs-display-none"><?php echo $tagName; ?></span></a>
                                                </li>
                                                <?
                                            }
                                            ?>


                                        </ul>
                                        <div class="separator-line bg-yellow"></div>
                                        <div class="tab-content">

                                            <?php
                                            foreach($arPostTagsNames as $keyTagName => $tagName) {
                                            ?>
                                            <div
                                                class="col-md-9 col-sm-12 text-center center-col tab-pane
                                                fade <?php if($keyTagName == 0){ ?>in active<?php } ?>"
                                                id="hcode-1501308158-2029551456-<?php echo $keyTagName; ?>">
                                                <div class="row margin-four-bottom">
                                                    <div class="col-md-12 col-sm-12 text-center gray-text"><p
                                                            class="text-large margin-five">Полное описание проекта</p>
                                                        <p>
                                                             <?php echo $arProject["post_content_formatted"]; ?>
                                                        </p>
                                                    </div>
                                                </div>

                                                <?php
                                                $categoryId = PORTFOLIO_WP_CATEGORY_PROJECTS_ID;

                                                $args = array(
                                                    'numberposts' => 1000,
                                                    'category' => $categoryId,
                                                    'orderby' => 'ID',
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

                                                $countPosts = count($posts);


                                                $categoryId = PORTFOLIO_WP_CATEGORY_SERTIFICATES_ID;

                                                $args = array(
                                                    'numberposts' => 1000,
                                                    'category' => $categoryId,
                                                    'orderby' => 'ID',
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

                                                $countSertificates = count($posts);

                                                $diffDateRemote =  current_time('timestamp') - strtotime("01-12-2012");
                                                $humanYearsRemote = floor($diffDateRemote / 31536000);

                                                include $_SERVER['DOCUMENT_ROOT'] . '/includes/GitHub.php';

                                                ?>


                                                <div class="row border-top padding-four no-padding-bottom">
                                                    <div
                                                        class="col-md-4 col-sm-4 bottom-margin text-center counter-section xs-margin-ten-bottom">
                                                        <span class="counter-number black-text"
                                                              data-to="<?php echo $countPosts;?>">
                                                            <?php echo $countPosts;?>
                                                        </span>
                                                        <span class="counter-title">
                                                            <?php
                                                            echo numberof($countPosts, '',
                                                                array('Проект', 'Проекта', 'Проектов'));
                                                            ?>
                                                        </span>
                                                    </div>
                                                    <div
                                                        class="col-md-4 col-sm-4 bottom-margin text-center
                                                        counter-section xs-margin-ten-bottom">
                                                        <span class="counter-number black-text"
                                                              data-to="<?php echo $countSertificates;?>">
                                                            <?php echo $countSertificates;?>
                                                        </span><span
                                                            class="counter-title">
                                                             <?php
                                                             echo numberof($countPosts, '',
                                                                 array('Сертификат', 'Сертификата', 'Сертификатов'));
                                                             ?>
                                                        </span></div>
                                                    <div
                                                        class="col-md-4 col-sm-4 bottom-margin text-center counter-section xs-no-margin-bottom">
                                                        <span class="counter-number black-text"
                                                              data-to="<?php echo $countFilesInRepo; ?>">
                                                            <?php echo $countFilesInRepo; ?>
                                                        </span><span class="counter-title">Файлов с кодом в репозитории</span>
                                                    </div>
                                                </div>
                                            </div>
                                                <?
                                            }
                                            ?>



                                        </div>


                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
                <section id="approach" class="  parallax-fix parallax1"
                         style=" background-image: url(http://wpdemos.themezaa.com/h-code/wp-content/uploads/2015/08/architecture-featured-projects.jpg); ">
                    <div class="container-fluid">
                        <div class="row">
                            <div
                                class="wpb_column hcode-column-container  col-md-12 col-xs-mobile-fullwidth text-center">
                                <div class="vc-column-innner-wrapper"><h3 class="section-title  white-text"
                                                                          style="font-weight:600 !important;;">
                                        Другие проекты
                                    </h3></div>
                            </div>
                            <div
                                class="wpb_column hcode-column-container  col-md-12 col-xs-mobile-fullwidth text-center no-padding">
                                <div class="vc-column-innner-wrapper">
                                    <div class="architecture-feature-slider feature-project-slider position-relative">
                                        <div class="container">
                                            <div class="row">
                                                <div id="architecture-feature-project-slider"
                                                     class="owl-pagination-bottom owl-carousel owl-theme dot-pagination dark-navigation dark-pagination dark-navigation white-cursor">

                                                    <?php
                                                    include $_SERVER['DOCUMENT_ROOT'] . '/includes/portfolio_grid_gallery.php';
                                                    ?>


                                                    <?php
                                                    $i = 1;
                                                    foreach ($posts as $keyPost => $post) {

                                                    $private = get_post_meta($post->ID, 'PRIVATE');

                                                    //?mode=private
                                                    if ((!isset($_SESSION["mode"]) || ($_SESSION["mode"] != "private")) &&
                                                        ($private[0] == "1")
                                                    ) {
                                                        continue;
                                                    }

                                                    setup_postdata($post);

                                                    //$arPostTags = wp_get_post_tags($post->ID);

                                                    $arPostTagsWidget = wp_get_post_tags($post->ID);
                                                    unset($arPostTagsNamesWidget);
                                                    foreach ($arPostTagsWidget as $keyTag => $tag) {
                                                        //$postTagId = $tag->term_id;
                                                        $arPostTagsNamesWidget[] = $tag->name;

                                                    }


                                                    $thumb_id = get_post_thumbnail_id($post->ID);
                                                    $thumb_url = wp_get_attachment_image_src($thumb_id, 'thumbnail',
                                                        false);

                                                    $thumb_url[0] = str_replace(get_site_url(),
                                                        PORTFOLIO_WP_URL,
                                                        $thumb_url[0]);


                                                    $thumb_url_medium = wp_get_attachment_image_src($thumb_id, 'medium',
                                                        false);

                                                    $thumb_url_medium[0] = str_replace(get_site_url(),
                                                        PORTFOLIO_WP_URL,
                                                        $thumb_url_medium[0]);


                                                    $thumb_url_full = wp_get_attachment_image_src($thumb_id, 'full',
                                                        false);

                                                    $thumb_url_full[0] = str_replace(get_site_url(),
                                                        PORTFOLIO_WP_URL,
                                                        $thumb_url_full[0]);



                                                    $filename = $thumb_url_full[0];
                                                    $new_filen = $_SERVER["DOCUMENT_ROOT"].'/wp-content/uploads/' . basename($filename);

                                                    $height = 290;

                                                    $width = 265;

                                                    $fileNew = "/wp-content/uploads/" . basename($filename);


                                                    $fileNew = cropImage($filename,
                                                        $_SERVER['DOCUMENT_ROOT'] . $fileNew,
                                                        $width, $height);


                                                    $arPostTags = wp_get_post_tags($post->ID);
                                                    ?>



                                                    <div class="item">
                                                        <a href="/detail/<?php echo basename(__FILE__); ?>?ID=<?php echo $post->ID; ?>">
                                                            <img class="js-img"
                                                                src="" data-image="<?php echo $fileNew; ?>"
                                                                alt="" width="265" height="290">
                                                        </a>
                                                        <h5
                                                            class="margin-ten no-margin-bottom xs-margin-top-five"
                                                            style="color:#ffffff;"><?php echo $post->post_title; ?></h5></div>


                                                        <?php

                                                    }
                                                    ?>





                                                </div>
                                            </div>
                                        </div>
                                        <div class="feature_nav"><a class="prev left carousel-control"><img alt=""
                                                                                                            src="http://wpdemos.themezaa.com/h-code/wp-content/themes/h-code/assets/images/arrow-pre-white-bg.png"
                                                                                                            width="96"
                                                                                                            height="96"></a><a
                                                class="next right carousel-control"><img alt=""
                                                                                         src="http://wpdemos.themezaa.com/h-code/wp-content/themes/h-code/assets/images/arrow-next-white-bg.png"
                                                                                         width="96" height="96"></a>
                                        </div>
                                    </div>
                                    <script type="text/javascript">jQuery(document).ready(function () {
                                            jQuery("#architecture-feature-project-slider").owlCarousel({
                                                pagination: false,
                                                autoPlay: false,
                                                stopOnHover: false,
                                                items: 4,
                                                itemsDesktop: [1200, 4],
                                                itemsTablet: [991, 3],
                                                itemsMobile: [700, 1],
                                            });
                                        });</script>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
                <section id="projects" class="  no-padding-bottom">
                    <div class="container-fluid">
                        <div class="row">
                            <div
                                class="wpb_column hcode-column-container  col-md-12 col-xs-mobile-fullwidth text-center">
                                <div class="vc-column-innner-wrapper"><h3
                                        class="section-title  black-text no-padding-bottom"
                                        style="font-weight:600 !important;;">Последние проекты</h3></div>
                            </div>
                            <div
                                class="wpb_column hcode-column-container  col-lg-3 col-md-5 col-xs-mobile-fullwidth col-sm-11 text-center center-col margin-three">
                                <div class="vc-column-innner-wrapper"><h4 class="gray-text"><?php echo $currentDetailTitle[0]; ?></h4></div>
                            </div>
                            <div class="wpb_column hcode-column-container  col-xs-mobile-fullwidth">
                                <div class="vc-column-innner-wrapper">
                                    <div class="col-md-12 text-center">
                                        <div class="text-center">
                                            <ul class="portfolio-filter nav nav-tabs " style="height:auto; padding-bottom:20px;">
                                                <?php
                                                include $_SERVER['DOCUMENT_ROOT'] . '/includes/portfolio_filter.php';
                                                ?>
                                            </ul>
                                        </div>
                                    </div>
                                    <div class="work-4col masonry wide ">
                                        <div
                                            class="col-md-12  margin-top-20px grid-gallery overflow-hidden no-padding content-section">
                                            <div class="tab-content">
                                                <ul class="grid masonry-items "
                                                >


                                                    <?php
                                                    include $_SERVER['DOCUMENT_ROOT'] . '/includes/portfolio_grid_gallery_new_first.php';
                                                    ?>


                                                    <?php


                                                    $thumb_id = get_post_thumbnail_id($arNewProjects[0]->ID);
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

                                                    $arPostTags = wp_get_post_tags($arNewProjects[0]->ID);



                                                    $filename = $thumb_url[0];
                                                    $new_filen = $_SERVER["DOCUMENT_ROOT"].'/wp-content/uploads/' . basename($filename);


                                                    $fileNew = "/wp-content/uploads/" . basename($filename);

                                                    cropImage($thumb_url[0],
                                                        $_SERVER['DOCUMENT_ROOT'] . $fileNew,
                                                        337, 253);

                                                    ?>


                                                    <li class="
                                                      <?php
                                                    foreach ($arPostTags as $keyTag => $tag) {
                                                        echo " portfolio-filter-".$tag->term_id;

                                                    }
                                                    ?>">
                                                        <figure>
                                                            <div class="gallery-img js-gallery-img">
                                                                <a
                                                                        href="/detail/<?php echo $arDetailTemplates[wp_rand(0, count($arDetailTemplates) - 1)]; ?>?ID=<?php echo $arNewProjects[0]->ID; ?>"
                                                                        class="" target="">
                                                                    <img alt=""
                                                                         data-image="<?php echo $fileNew; ?>"
                                                                         src="<?php echo $fileNew; ?>"
                                                                         width="800"
                                                                         height="600"/></a></div>
                                                            <figcaption><h3><a
                                                                            href="/detail/<?php echo $arDetailTemplates[wp_rand(0, count($arDetailTemplates) - 1)]; ?>?ID=<?php echo $arNewProjects[0]->ID; ?>"
                                                                            class="" target=""><?php echo $arNewProjects[0]->post_title; ?></a></h3>
                                                                <p><?php displayRandomElement($arPostTagsNames); ?></p></figcaption>
                                                        </figure>
                                                    </li>


                                                    <?php


                                                    $thumb_id = get_post_thumbnail_id($arNewProjects[4]->ID);
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

                                                    $arPostTags = wp_get_post_tags($arNewProjects[4]->ID);



                                                    $filename = $thumb_url[0];
                                                    $new_filen = $_SERVER["DOCUMENT_ROOT"].'/wp-content/uploads/' . basename($filename);


                                                    $fileNew = "/wp-content/uploads/" . basename($filename);

                                                    cropImage($thumb_url[0],
                                                        $_SERVER['DOCUMENT_ROOT'] . $fileNew,
                                                        337, 506);

                                                    ?>


                                                    <li class="<?php
                                                    foreach ($arPostTags as $keyTag => $tag) {
                                                        echo " portfolio-filter-".$tag->term_id;

                                                    }
                                                    ?>">
                                                        <figure>
                                                            <div class="gallery-img"><a
                                                                        href="/detail/<?php echo $arDetailTemplates[wp_rand(0, count($arDetailTemplates) - 1)]; ?>?ID=<?php echo $arNewProjects[4]->ID; ?>"
                                                                        class="" target=""><img alt=""
                                                                                                data-image="<?php echo $fileNew; ?>"
                                                                                                src="<?php echo $fileNew; ?>"
                                                                                                width="800" height="1200"/></a>
                                                            </div>
                                                            <figcaption><h3><a
                                                                            href="/detail/<?php echo $arDetailTemplates[wp_rand(0, count($arDetailTemplates) - 1)]; ?>?ID=<?php echo $arNewProjects[4]->ID; ?>"
                                                                            class="" target=""><?php echo $arNewProjects[4]->post_title; ?></a></h3>
                                                                <p><?php displayRandomElement($arPostTagsNames); ?></p></figcaption>
                                                        </figure>
                                                    </li>

                                                    <?php


                                                    $thumb_id = get_post_thumbnail_id($arNewProjects[5]->ID);
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

                                                    $arPostTags = wp_get_post_tags($arNewProjects[5]->ID);



                                                    $filename = $thumb_url[0];
                                                    $new_filen = $_SERVER["DOCUMENT_ROOT"].'/wp-content/uploads/' . basename($filename);


                                                    $fileNew = "/wp-content/uploads/" . basename($filename);

                                                    cropImage($thumb_url[0],
                                                        $_SERVER['DOCUMENT_ROOT'] . $fileNew,
                                                        337, 253);

                                                    ?>

                                                    <li class="<?php
                                                    foreach ($arPostTags as $keyTag => $tag) {
                                                        echo " portfolio-filter-".$tag->term_id;

                                                    }
                                                    ?>">
                                                        <figure>
                                                            <div class="gallery-img"><a
                                                                        href="/detail/<?php echo $arDetailTemplates[wp_rand(0, count($arDetailTemplates) - 1)]; ?>?ID=<?php echo $arNewProjects[5]->ID; ?>"
                                                                        class="" target=""><img alt=""
                                                                                                data-image="<?php echo $fileNew; ?>"
                                                                                                src="<?php echo $fileNew; ?>"
                                                                                                width="800"
                                                                                                height="600"/></a></div>
                                                            <figcaption><h3><a
                                                                            href="/detail/<?php echo $arDetailTemplates[wp_rand(0, count($arDetailTemplates) - 1)]; ?>?ID=<?php echo $arNewProjects[5]->ID; ?>"
                                                                            class="" target=""><?php echo $arNewProjects[5]->post_title; ?></a></h3>
                                                                <p><?php displayRandomElement($arPostTagsNames); ?></p></figcaption>
                                                        </figure>
                                                    </li>

                                                    <?php


                                                    $thumb_id = get_post_thumbnail_id($arNewProjects[1]->ID);
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

                                                    $arPostTags = wp_get_post_tags($arNewProjects[1]->ID);



                                                    $filename = $thumb_url[0];
                                                    $new_filen = $_SERVER["DOCUMENT_ROOT"].'/wp-content/uploads/' . basename($filename);


                                                    $fileNew = "/wp-content/uploads/" . basename($filename);

                                                    cropImage($thumb_url[0],
                                                        $_SERVER['DOCUMENT_ROOT'] . $fileNew,
                                                        337, 506);

                                                    ?>

                                                    <li class="<?php
                                                    foreach ($arPostTags as $keyTag => $tag) {
                                                        echo " portfolio-filter-".$tag->term_id;

                                                    }
                                                    ?>">
                                                        <figure>
                                                            <div class="gallery-img"><a
                                                                        href="/detail/<?php echo $arDetailTemplates[wp_rand(0, count($arDetailTemplates) - 1)]; ?>?ID=<?php echo $arNewProjects[1]->ID; ?>"
                                                                        class="" target=""><img alt=""
                                                                                                data-image="<?php echo $fileNew; ?>"
                                                                                                src="<?php echo $fileNew; ?>"
                                                                                                width="800" height="1200"/></a>
                                                            </div>
                                                            <figcaption><h3><a
                                                                            href="/detail/<?php echo $arDetailTemplates[wp_rand(0, count($arDetailTemplates) - 1)]; ?>?ID=<?php echo $arNewProjects[1]->ID; ?>"
                                                                            class="" target=""><?php echo $arNewProjects[1]->post_title; ?></a></h3>
                                                                <p><?php displayRandomElement($arPostTagsNames); ?></p></figcaption>
                                                        </figure>
                                                    </li>

                                                    <?php


                                                    $thumb_id = get_post_thumbnail_id($arNewProjects[2]->ID);
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

                                                    $arPostTags = wp_get_post_tags($arNewProjects[2]->ID);



                                                    $filename = $thumb_url[0];
                                                    $new_filen = $_SERVER["DOCUMENT_ROOT"].'/wp-content/uploads/' . basename($filename);


                                                    $fileNew = "/wp-content/uploads/" . basename($filename);

                                                    cropImage($thumb_url[0],
                                                        $_SERVER['DOCUMENT_ROOT'] . $fileNew,
                                                        337, 253);

                                                    ?>

                                                    <li class="<?php
                                                    foreach ($arPostTags as $keyTag => $tag) {
                                                        echo " portfolio-filter-".$tag->term_id;

                                                    }
                                                    ?>">
                                                        <figure>
                                                            <div class="gallery-img"><a
                                                                        href="/detail/<?php echo $arDetailTemplates[wp_rand(0, count($arDetailTemplates) - 1)]; ?>?ID=<?php echo $arNewProjects[2]->ID; ?>"
                                                                        class="" target=""><img alt=""
                                                                                                data-image="<?php echo $fileNew; ?>"
                                                                                                src="<?php echo $fileNew; ?>"
                                                                                                width="800"
                                                                                                height="600"/></a></div>
                                                            <figcaption><h3><a
                                                                            href="/detail/<?php echo $arDetailTemplates[wp_rand(0, count($arDetailTemplates) - 1)]; ?>?ID=<?php echo $arNewProjects[2]->ID; ?>"
                                                                            class="" target=""><?php echo $arNewProjects[2]->post_title; ?></a></h3>
                                                                <p><?php displayRandomElement($arPostTagsNames); ?></p></figcaption>
                                                        </figure>
                                                    </li>

                                                    <?php


                                                    $thumb_id = get_post_thumbnail_id($arNewProjects[3]->ID);
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

                                                    $arPostTags = wp_get_post_tags($arNewProjects[3]->ID);



                                                    $filename = $thumb_url[0];
                                                    $new_filen = $_SERVER["DOCUMENT_ROOT"].'/wp-content/uploads/' . basename($filename);


                                                    $fileNew = "/wp-content/uploads/" . basename($filename);

                                                    cropImage($thumb_url[0],
                                                        $_SERVER['DOCUMENT_ROOT'] . $fileNew,
                                                        337, 253);

                                                    ?>

                                                    <li class="<?php
                                                    foreach ($arPostTags as $keyTag => $tag) {
                                                        echo " portfolio-filter-".$tag->term_id;

                                                    }
                                                    ?>">
                                                        <figure>
                                                            <div class="gallery-img"><a
                                                                        href="/detail/<?php echo $arDetailTemplates[wp_rand(0, count($arDetailTemplates) - 1)]; ?>?ID=<?php echo $arNewProjects[3]->ID; ?>"
                                                                        class="" target=""><img alt=""
                                                                                                data-image="<?php echo $fileNew; ?>"
                                                                                                src="<?php echo $fileNew; ?>"
                                                                                                width="800"
                                                                                                height="600"/></a></div>
                                                            <figcaption><h3><a
                                                                            href="/detail/<?php echo $arDetailTemplates[wp_rand(0, count($arDetailTemplates) - 1)]; ?>?ID=<?php echo $arNewProjects[3]->ID; ?>"
                                                                            class="" target=""><?php echo $arNewProjects[3]->post_title; ?></a></h3>
                                                                <p><?php displayRandomElement($arPostTagsNames); ?></p></figcaption>
                                                        </figure>
                                                    </li>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
                <section id="our-service">
                    <div class="container">
                        <div class="row">
                            <div
                                class="wpb_column hcode-column-container  col-md-12 col-xs-mobile-fullwidth text-center">
                                <div class="vc-column-innner-wrapper"><h3 class="section-title  black-text"
                                                                          style="font-weight:600 !important;;">
                                        Статистика тегов
                                    </h3></div>
                            </div>



                            <?php
                            $arProjectsTypes = array();

                            $categoryId = WP_CATEGORY_PROJECTS_ID;

                            $args = array(
                                'numberposts' => 1000,
                                'category' => $categoryId,
                                'orderby' => 'meta_value_num',//meta_value_ORDER
                                'order' => 'ASC',
                                'include' => array(),
                                'exclude' => array(),
                                'meta_key' => 'ORDER',
                                'meta_value' => '',
                                'post_type' => 'post',
                                'suppress_filters' => true, // подавление работы фильтров изменения SQL запроса
                                /*'meta_query'	=> array(
                                    array(
                                        'key'	  	=> 'PRIVATE ',
                                        'value'	  	=> '1',
                                        'compare' 	=> 'NOT IN',
                                    ),
                                ), */
                            );

                            $posts = get_posts($args);
                            $i = 1;

                            ?>

                            <?php
                            foreach ($posts as $post){

                                $private = get_post_meta($post->ID, 'PRIVATE');

                                //?mode=private
                                if((!isset($_SESSION["mode"]) || ($_SESSION["mode"] != "private")) &&
                                    ($private[0] == "1")) continue;

                                setup_postdata($post);

                                ?>

                                <?php

                                $arPostTags = wp_get_post_tags($post->ID);
                                //print_r($arPostTags);
                                foreach ($arPostTags as $keyTag => $tag) {
                                    $postTagId = $tag->term_id;
                                    $postTagName = $tag->name;

                                    //echo $postTagName;


                                    if($arProjectsTypes[$postTagName]){
                                        $arProjectsTypes[$postTagName]++;
                                    }else{
                                        $arProjectsTypes[$postTagName] = 1;
                                    }


                                }

                                $i++;

                            }

                            wp_reset_postdata(); // сброс
                            ?>


                            <?php


                            $categoryId = PORTFOLIO_WP_CATEGORY_SITES_ID;

                            $args = array(
                                'numberposts' => 6,
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


                            if(!$arProjectsTypes[$post->post_title]){
                                $arProjectsTypes[$post->post_title] = 1;
                            }

                            ?>


                            <div
                                class="wpb_column hcode-column-container  col-md-4 col-xs-mobile-fullwidth col-sm-6 text-center">
                                <div class="vc-column-innner-wrapper">
                                    <div class="services-box "><i class=" small-icon"
                                                                  style="color:#7f7f7f !important"></i><h6
                                            class="margin-five font-weight-600 letter-spacing-2"
                                            style="color:#000000 !important"><?php echo $post->post_title;?></h6>
                                        <p style="display:block; height:80px;">


                                        </p>
                                        <figure class="text-uppercase bg-black" style="color:#ffffff"><span>
                                                <?php
                                                echo $arProjectsTypes[$post->post_title];
                                                ?>
                                            </span>
                                            <?php
                                            echo numberof($arProjectsTypes[$post->post_title],
                                                '', array('проект', 'проекта', 'проектов'));
                                            ?>
                                        </figure>
                                    </div>
                                </div>
                            </div>




                                <?php
                            }

                            wp_reset_postdata();
                            ?>


                        </div>
                    </div>
                </section>

                <?php
                include $_SERVER['DOCUMENT_ROOT'] . '/includes/portfolio_grid_gallery.php';
                ?>




                <section id="case-study" class="  no-padding">
                    <div class="container-fluid">
                        <div class="row">
                            <div class="wpb_column hcode-column-container  col-xs-mobile-fullwidth">
                                <div class="vc-column-innner-wrapper">
                                    <div id="hcode-bootstrap-content-slider1"
                                         class="carousel slide no-padding  round-pagination light-pagination light-navigation carousel-slide ">
                                        <ol class="carousel-indicators">
                                            <?php
                                            foreach ($posts as $keyPost => $post) {
                                                ?>
                                                <li data-target="#hcode-bootstrap-content-slider1"
                                                    data-slide-to="<?php echo $keyPost; ?>"></li>
                                                <?php
                                            }
                                            ?>

                                        </ol>
                                        <div class="carousel-inner">

                                            <?php
                                            $i = 1;
                                            foreach ($posts as $keyPost => $post) {

                                            $private = get_post_meta($post->ID, 'PRIVATE');

                                            //?mode=private
                                            if ((!isset($_SESSION["mode"]) || ($_SESSION["mode"] != "private")) &&
                                                ($private[0] == "1")
                                            ) {
                                                continue;
                                            }

                                            setup_postdata($post);

                                            //$arPostTags = wp_get_post_tags($post->ID);

                                            $arPostTagsWidget = wp_get_post_tags($post->ID);
                                            unset($arPostTagsNamesWidget);
                                            foreach ($arPostTagsWidget as $keyTag => $tag) {
                                                //$postTagId = $tag->term_id;
                                                $arPostTagsNamesWidget[] = $tag->name;

                                            }


                                            $thumb_id = get_post_thumbnail_id($post->ID);
                                            $thumb_url = wp_get_attachment_image_src($thumb_id, 'thumbnail',
                                                false);

                                            $thumb_url[0] = str_replace(get_site_url(),
                                                PORTFOLIO_WP_URL,
                                                $thumb_url[0]);


                                            $thumb_url_medium = wp_get_attachment_image_src($thumb_id, 'medium',
                                                false);

                                            $thumb_url_medium[0] = str_replace(get_site_url(),
                                                PORTFOLIO_WP_URL,
                                                $thumb_url_medium[0]);


                                            $thumb_url_full = wp_get_attachment_image_src($thumb_id, 'full',
                                                false);

                                            $thumb_url_full[0] = str_replace(get_site_url(),
                                                PORTFOLIO_WP_URL,
                                                $thumb_url_full[0]);


                                            $arPostTags = wp_get_post_tags($post->ID);
                                            ?>
                                            <div class="item bg-black">
                                                <div data-image="<?php echo $thumb_url_full[0]; ?>"
                                                    style="background-image:url(); width:50% !important;"
                                                    class="fill sm-background-image-right js-background"></div>
                                                <div class="case-study-slider clearfix">
                                                    <div
                                                        class="col-md-6 col-sm-10 col-sm-offset-1 pull-right sm-pull-none">
                                                        <div class="col-md-3 col-sm-12 col-xs-12 xs-no-padding"><span
                                                                class="case-study-number alt-font yellow-text font-weight-400
                                                                letter-spacing-2 sm-pull-left sm-no-border-right
                                                                sm-no-padding-left"><?php echo $keyPost + 1; ?></span>
                                                        </div>
                                                        <div
                                                            class="col-md-7 col-sm-12 col-xs-12 case-study-text
                                                            position-relative sm-no-margin-left xs-no-padding">
                                                            <p class="title-small text-uppercase letter-spacing-3
                                                            white-text no-margin-bottom">
                                                                <a href="/detail/<?php echo basename(__FILE__); ?>?ID=<?php echo $post->ID; ?>"
                                                                   class="white-text-link">
                                                                    <?php echo $post->post_title;?>
                                                                </a></p>
                                                            <span
                                                                class="case-study-work light-gray-text letter-spacing-2">
                                                                <?php echo implode(" | ", $arPostTagsNames); ?>
                                                            </span>
                                                            <p class="text-med light-gray-text">
                                                                <?php
                                                                echo kama_excerpt( array('text'=>$arProject["post_content"], 'maxchar'=>500) );?>
                                                            </p> <a
                                                                class="btn btn-small-white-background margin-four no-margin-bottom"
                                                                href="/detail/<?php echo basename(__FILE__); ?>?ID=<?php echo $post->ID; ?>"
                                                                target="_self">Детали</a></div>
                                                    </div>
                                                </div>
                                            </div>

                                                <?php

                                            }
                                            ?>
                                        </div>
                                        <a class="left carousel-control" href="#hcode-bootstrap-content-slider1"
                                           data-slide="prev"><img
                                                src="http://wpdemos.themezaa.com/h-code/wp-content/themes/h-code/assets/images/arrow-pre-white-bg.png"
                                                alt="" width="96" height="96"/></a><a class="right carousel-control"
                                                                                      href="#hcode-bootstrap-content-slider1"
                                                                                      data-slide="next"><img
                                                src="http://wpdemos.themezaa.com/h-code/wp-content/themes/h-code/assets/images/arrow-next-white-bg.png"
                                                alt="" width="96" height="96"/></a></div>
                                    <script type="text/javascript">jQuery(document).ready(function () {
                                            jQuery("#hcode-bootstrap-content-slider1").carousel({
                                                interval: false,
                                                pause: false,
                                            });
                                        });</script>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
                <section id="people">
                    <div class="container">
                        <div class="row">
                            <div
                                class="wpb_column hcode-column-container  col-md-12 col-xs-mobile-fullwidth text-center margin-four-bottom">
                                <div class="vc-column-innner-wrapper"><h3 class="section-title  black-text no-padding"
                                                                          style="font-weight:600 !important;;">
                                        Проекты</h3></div>
                            </div>
                            <div
                                class="wpb_column hcode-column-container  col-lg-5 col-md-5 col-xs-mobile-fullwidth text-center center-col margin-ten-bottom">
                                <div class="vc-column-innner-wrapper">
                                    <h4 class="gray-text">
                                        <?php echo randomText()[0]; ?>
                                    </h4>
                                </div>
                            </div>




                            <?php
                            $i = 1;
                            foreach ($posts as $keyPost => $post) {

                            $private = get_post_meta($post->ID, 'PRIVATE');

                            //?mode=private
                            if ((!isset($_SESSION["mode"]) || ($_SESSION["mode"] != "private")) &&
                                ($private[0] == "1")
                            ) {
                                continue;
                            }

                            setup_postdata($post);

                            //$arPostTags = wp_get_post_tags($post->ID);

                            $arPostTagsWidget = wp_get_post_tags($post->ID);
                            unset($arPostTagsNamesWidget);
                            foreach ($arPostTagsWidget as $keyTag => $tag) {
                                //$postTagId = $tag->term_id;
                                $arPostTagsNamesWidget[] = $tag->name;

                            }


                            $thumb_id = get_post_thumbnail_id($post->ID);
                            $thumb_url = wp_get_attachment_image_src($thumb_id, 'thumbnail',
                                false);

                            $thumb_url[0] = str_replace(get_site_url(),
                                PORTFOLIO_WP_URL,
                                $thumb_url[0]);


                            $thumb_url_medium = wp_get_attachment_image_src($thumb_id, 'medium',
                                false);

                            $thumb_url_medium[0] = str_replace(get_site_url(),
                                PORTFOLIO_WP_URL,
                                $thumb_url_medium[0]);


                            $thumb_url_full = wp_get_attachment_image_src($thumb_id, 'full',
                                false);

                            $thumb_url_full[0] = str_replace(get_site_url(),
                                PORTFOLIO_WP_URL,
                                $thumb_url_full[0]);


                                $filename = $thumb_url_full[0];
                                $new_filen = $_SERVER["DOCUMENT_ROOT"].'/wp-content/uploads/' . basename($filename);


                                $width = 900;
                                $height = 990;

                                $fileNew = "/wp-content/uploads/" . basename($filename);


                                $fileNew = cropImage($filename,
                                    $_SERVER['DOCUMENT_ROOT'] . $fileNew,
                                    $width, $height);

                            $arPostTags = wp_get_post_tags($post->ID);
                            ?>
                            <div
                                class="wpb_column hcode-column-container  col-md-4 col-xs-mobile-fullwidth col-sm-6 text-center">
                                <div class="vc-column-innner-wrapper">
                                    <div class="team-member">
                                        <img alt=""
                                             class="js-img" data-image="<?php echo $fileNew; ?>"
                                                                  src=""
                                                                  width="900" height="990">
                                        <figure class="position-relative bg-white"><span
                                                class="team-name text-uppercase black-text letter-spacing-2
                                                display-block font-weight-600" style="height:70px;">
                                                <?php echo $post->post_title;?>
                                            </span>
                                            <span
                                                class="team-post text-uppercase letter-spacing-2
                                                display-block" style="height:150px;">
                                                <?php echo implode(" / ", $arPostTagsNamesWidget); ?>
                                            </span>
                                            <div class="person-social margin-five no-margin-bottom">

                                            </div>
                                        </figure>
                                        <div class="team-details bg-blck-overlay position-left-right-zero"
                                             style="background: rgba(0,0,0,0.85) !important;"><h5
                                                class="team-headline white-text text-uppercase font-weight-600">
                                                <?php echo $post->post_title;?>
                                            </h5>
                                            <p class="width-70 sm-width-90 center-col light-gray-text margin-five"></p>
                                            <p class="width-70 center-col light-gray-text margin-five">
                                                <?php
                                                echo kama_excerpt( array('text'=>$post->post_content, 'maxchar'=>100) );?>

                                            </p>
                                            <p></p>
                                            <div class="separator-line-thick bg-white"></div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                                <?php
                                if($i == 6) break;

                                $i++;
                            }
                            ?>




                        </div>
                    </div>
                </section>
                <section class="  parallax-fix parallax10 no-padding"
                         style=" background-image: url(http://wpdemos.themezaa.com/h-code/wp-content/uploads/2015/08/parallax-img48.jpg); ">
                    <div class="container">
                        <div class="row">
                            <div
                                class="wpb_column hcode-column-container  col-md-7 col-xs-mobile-fullwidth col-sm-8 center-col padding-six"
                                style=" background:#e6af2a;">
                                <div class="vc-column-innner-wrapper"><h1 class="section-title  white-text no-padding">
                                        <?php echo randomText()[0]; ?></h1>
                                    <p class="text-med margin-five black-text"><?php echo randomText()[1]; ?></p>
                                    <div class="hcode-space margin-five-bottom"></div>
                                    <a href="/projects/" target="_self"
                                       class="inner-link highlight-button btn-small  margin-right-20px
                                       xs-margin-five-bottom button btn">Проекты</a>
                                    <a href="/feedback/simple/" target="_self"
                                                       class="inner-link highlight-button btn-small  button btn">
                                        Обратная связь
                                    </a></div>
                            </div>
                        </div>
                    </div>
                </section>
                <section id="blog">
                    <div class="container">
                        <div class="row">
                            <div class="wpb_column hcode-column-container  col-xs-mobile-fullwidth text-center">
                                <div class="vc-column-innner-wrapper"><h3 class="section-title  black-text"
                                                                          style="font-weight:600 !important;;">Проекты</h3>
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


                                $width = 800;
                                $height = 502;
                                $fileNew = "/wp-content/uploads/" . basename($filename);
                                $fileNew = cropImage($filename,
                                    $_SERVER['DOCUMENT_ROOT'] . $fileNew,
                                    $width, $height);




                                $width = 800;
                                $height = 502;
                                $fileNew300w = "/wp-content/uploads/" . basename($filename);
                                $fileNew300w = cropImage($filename,
                                    $_SERVER['DOCUMENT_ROOT'] . $fileNew300w,
                                    $width, $height);

                                $width = 800;
                                $height = 502;
                                $fileNew768w = "/wp-content/uploads/" . basename($filename);
                                $fileNew768w = cropImage($filename,
                                    $_SERVER['DOCUMENT_ROOT'] . $fileNew768w,
                                    $width, $height);

                                $width = 800;
                                $height = 502;
                                $fileNew133w = "/wp-content/uploads/" . basename($filename);
                                $fileNew133w = cropImage($filename,
                                    $_SERVER['DOCUMENT_ROOT'] . $fileNew133w,
                                    $width, $height);

                                $width = 800;
                                $height = 502;
                                $fileNew374w = "/wp-content/uploads/" . basename($filename);
                                $fileNew374w = cropImage($filename,
                                    $_SERVER['DOCUMENT_ROOT'] . $fileNew374w,
                                    $width, $height);


                                ?>

                            <div
                                class="wpb_column hcode-column-container  col-md-4 col-xs-mobile-fullwidth col-sm-4
                                xs-margin-three-bottom wow fadeInUp"
                                data-wow-duration=300ms>
                                <div class="vc-column-innner-wrapper">
                                    <div
                                        class="post-8152 post type-post status-publish format-standard has-post-thumbnail
                                        hentry category-sample">
                                        <div class="blog-post">
                                            <div class="blog-image"><a
                                                    href="/detail/<?php echo basename(__FILE__); ?>?ID=<?php echo $post->ID; ?>">
                                                    <img
                                                        width="800" height="502"
                                                        src="<?php echo $fileNew; ?>"
                                                        class="attachment-full size-full wp-post-image" alt="" title=""
                                                        srcset="<?php echo $fileNew; ?> 800w,
                                                        <?php echo $fileNew300w; ?> 300w,
                                                        <?php echo $fileNew768w; ?> 768w,
                                                        <?php echo $fileNew133w; ?> 133w,
                                                        <?php echo $fileNew374w; ?> 374w"
                                                        sizes="(max-width: 800px) 100vw, 800px"/></a></div>
                                            <div class="post-details"><a
                                                    href="/detail/<?php echo basename(__FILE__); ?>?ID=<?php echo $post->ID; ?>"
                                                    class="post-title sm-margin-top-ten xs-no-margin-top entry-title">
                                                    <?php echo $post->post_title;?>
                                                </a><span
                                                    class="post-author light-gray-text2 author vcard">
                                                    <?php echo implode(" / ", $arCurrentPostTagsNames); ?>
                                                </span>
                                                <p class="entry-content">
                                                    <?php
                                                    echo kama_excerpt( array('text'=>$post->post_content, 'maxchar'=>200) );?>
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
                <section id="testimonial" class=" " style=" background-color:#000000; ">
                    <div class="container">
                        <div class="row">
                            <div
                                class="wpb_column hcode-column-container  col-md-12 col-xs-mobile-fullwidth text-center">
                                <div class="vc-column-innner-wrapper"><h3 class="section-title  white-text no-padding"
                                                                          style="font-weight:600 !important;;">
                                        Проекты</h3></div>
                            </div>
                            <div
                                class="wpb_column hcode-column-container  col-md-6 col-xs-mobile-fullwidth col-sm-10 text-center center-col">
                                <div class="vc-column-innner-wrapper">
                                    <div class="testimonial-slider position-relative no-transition">
                                        <div id="hcode-testimonial"
                                             class="owl-pagination-bottom position-relative  round-pagination light-pagination white-cursor">
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

                                            <div
                                                class="col-md-12 col-sm-12 col-xs-12 testimonial-style2 center-col
                                                text-center margin-three no-margin-top">
                                                <p>
                                                    <?php
                                                    echo kama_excerpt( array('text'=>$post->post_content, 'maxchar'=>200) );?>
                                                </p>
                                                <span class="name light-gray-text2">
                                                    <?php echo $post->post_title; ?>
                                                </span>
                                            </div>

                                                <?php

                                                $i++;
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
                <section id="counter" style="border-bottom: 1px solid #e5e5e5;">
                    <div class="container">


                        <?php
                        $categoryId = PORTFOLIO_WP_CATEGORY_PROJECTS_ID;

                        $args = array(
                            'numberposts' => 1000,
                            'category' => $categoryId,
                            'orderby' => 'ID',
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

                        $countPosts = count($posts);


                        $categoryId = PORTFOLIO_WP_CATEGORY_SERTIFICATES_ID;

                        $args = array(
                            'numberposts' => 1000,
                            'category' => $categoryId,
                            'orderby' => 'ID',
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

                        $countSertificates = count($posts);

                        $diffDateRemote =  current_time('timestamp') - strtotime("01-12-2013");
                        $humanYearsRemote = floor($diffDateRemote / 31536000);

                        include $_SERVER['DOCUMENT_ROOT'] . '/includes/GitHub.php';





                        ?>

                        <div class="row">
                            <div
                                class="wpb_column hcode-column-container  col-md-3 col-xs-mobile-fullwidth col-sm-6 text-center sm-margin-ten-bottom">
                                <div class="vc-column-innner-wrapper">
                                    <div class="counter-section"><i class="icon-heart medium-icon"></i><span
                                            id="counter_1" data-to="<?php echo $countPosts;?>"
                                            class="counter-number"><?php echo $countPosts;?></span><span
                                            class="counter-title">
                                            <?php
                                            echo numberof($countPosts, '',
                                                array('Проект', 'Проекта', 'Проектов'));
                                            ?>
                                        </span></div>
                                </div>
                            </div>
                            <div
                                class="wpb_column hcode-column-container  col-md-3 col-xs-mobile-fullwidth col-sm-6 text-center sm-margin-ten-bottom">
                                <div class="vc-column-innner-wrapper">
                                    <div class="counter-section"><i class="icon-happy medium-icon"></i><span
                                            id="counter_2" data-to="<?php echo $countSertificates;?>"
                                            class="counter-number"><?php echo $countSertificates;?></span><span
                                            class="counter-title">
                                            <?php
                                            echo numberof($countPosts, '',
                                                array('Сертификат', 'Сертификата', 'Сертификатов'));
                                            ?>
                                        </span></div>
                                </div>
                            </div>
                            <div
                                class="wpb_column hcode-column-container  col-md-3 col-xs-mobile-fullwidth col-sm-6 text-center xs-margin-ten-bottom">
                                <div class="vc-column-innner-wrapper">
                                    <div class="counter-section"><i class="icon-anchor medium-icon"></i><span
                                            id="counter_3" data-to="<?php echo $countFilesInRepo; ?>"
                                            class="counter-number"><?php echo $countFilesInRepo; ?></span><span
                                            class="counter-title">Файлов с кодом в репозитории</span></div>
                                </div>
                            </div>
                            <div
                                class="wpb_column hcode-column-container  col-md-3 col-xs-mobile-fullwidth col-sm-6 text-center">
                                <div class="vc-column-innner-wrapper">
                                    <div class="counter-section"><i class="icon-chat medium-icon"></i><span
                                            id="counter_4" data-to="<?php echo $humanYearsRemote; ?>"
                                            class="counter-number"><?php echo $humanYearsRemote; ?></span><span
                                            class="counter-title">
                                            <?php
                                            echo numberof($humanYearsRemote, '', array('год', 'года', 'лет'));
                                            ?> опыта удалённой работы
                                        </span></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
                <section id="contact-us">
                    <div class="container">
                        <div class="row">
                            <div class="wpb_column hcode-column-container  col-xs-mobile-fullwidth text-center">
                                <div class="vc-column-innner-wrapper"><h3 class="section-title  black-text">
                                        Контакты
                                    </h3></div>
                            </div>
                            <div
                                class="wpb_column hcode-column-container  col-md-4 col-xs-mobile-fullwidth col-sm-4 text-center xs-margin-ten-bottom wow fadeInUp"
                                data-wow-duration=300ms>
                                <div class="vc-column-innner-wrapper">
                                    <div class="features-box-style1"><i class="icon-tablet medium-icon"></i><h5
                                            class="">gsu_resident234</h5></div>
                                </div>
                            </div>
                            <div
                                class="wpb_column hcode-column-container  col-md-4 col-xs-mobile-fullwidth col-sm-4 text-center xs-margin-ten-bottom">
                                <div class="vc-column-innner-wrapper">
                                    <div class="features-box-style1"><i class="icon-envelope medium-icon"></i><h5
                                            class="">gsu1234@mail.ru</h5>
                                        <div class="no-margin"><p></p></div>
                                    </div>
                                </div>
                            </div>
                            <div
                                class="wpb_column hcode-column-container  col-md-4 col-xs-mobile-fullwidth col-sm-4 text-center wow fadeInUp"
                                data-wow-duration=600ms>
                                <div class="vc-column-innner-wrapper">
                                    <div class="features-box-style1"><i class="icon-map-pin medium-icon"></i><h5
                                            class="">РФ, Амурская область, г.Благовещенск</h5>
                                        <div class="no-margin"><p></p></div>
                                    </div>
                                </div>
                            </div>
                            <div class="wpb_column hcode-column-container  col-xs-mobile-fullwidth">
                                <div class="vc-column-innner-wrapper">
                                    <div role="form" class="wpcf7" id="wpcf7-f4333-p45-o1" lang="en-US" dir="ltr">
                                        <div class="screen-reader-response"></div>
                                        <form action="<?php echo $_SERVER["REQUEST_URI"]; ?>" method="post"
                                              class="wpcf7-form" novalidate="novalidate">
                                            <div style="display: none;"><input type="hidden" name="_wpcf7"
                                                                               value="4333"/> <input type="hidden"
                                                                                                     name="_wpcf7_version"
                                                                                                     value="4.7"/>
                                                <input type="hidden" name="_wpcf7_locale" value="en_US"/> <input
                                                    type="hidden" name="_wpcf7_unit_tag" value="wpcf7-f4333-p45-o1"/>
                                                <input type="hidden" name="_wpnonce" value="ecbf1b8a3d"/></div>
                                            <div class="col-md-12 col-sm-12">
                                                <div class="wide-separator-line margin-ten no-margin-lr"></div>
                                            </div>
                                            <div class="col-md-6 col-sm-12"><span
                                                    class="wpcf7-form-control-wrap your-name"><input type="text"
                                                                                                     name="your-name"
                                                                                                     value="" size="40"
                                                                                                     class="wpcf7-form-control wpcf7-text wpcf7-validates-as-required"
                                                                                                     aria-required="true"
                                                                                                     aria-invalid="false"
                                                                                                     placeholder="ВАШЕ ИМЯ"/></span><span
                                                    class="wpcf7-form-control-wrap email-852"><input type="email"
                                                                                                     name="email-852"
                                                                                                     value="" size="40"
                                                                                                     class="wpcf7-form-control wpcf7-text wpcf7-email wpcf7-validates-as-required wpcf7-validates-as-email"
                                                                                                     aria-required="true"
                                                                                                     aria-invalid="false"
                                                                                                     placeholder="ВАШ EMAIL"/></span>
                                            </div>
                                            <div class="col-md-6 col-sm-12"><span
                                                    class="wpcf7-form-control-wrap your-message"><textarea
                                                        name="your-message" cols="40" rows="2"
                                                        class="wpcf7-form-control wpcf7-textarea" aria-invalid="false"
                                                        placeholder="ВАШЕ СООБЩЕНИЕ"></textarea></span></div>
                                            <div class="col-md-12 col-sm-12">
                                                <div class="col-md-6 col-sm-6 no-padding-left xs-margin-three-bottom">
                                                    <span class="required">*Пожалуйста, заполните все поля корректно</span>
                                                </div>
                                                <div
                                                    class="col-md-6 col-sm-6 no-padding-right text-right contact-form-right-button">
                                                    <input type="submit" value="Отправить сообщение"
                                                           class="wpcf7-form-control wpcf7-submit btn btn-black button pull-right xs-margin-bottom-five"/>
                                                </div>
                                            </div>
                                            <div class="wpcf7-response-output wpcf7-display-none"></div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
                <section class=" " style=" background-color:#252525; ">
                    <div class="container">
                        <div class="row">

                            <?php

                            $categoryId = PORTFOLIO_WP_CATEGORY_PROJECTS_ID;

                            $args = array(
                                'numberposts' => 1000,
                                'category' => $categoryId,
                                'orderby' => 'ID',
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

                            $countPosts = count($posts);


                            $categoryId = PORTFOLIO_WP_CATEGORY_SITES_ID;

                            $args = array(
                                'numberposts' => 4,
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


                            if(!$arProjectsTypes[$post->post_title]){
                                $arProjectsTypes[$post->post_title] = 1;
                            }

                            //$countPosts
                            //$arProjectsTypes[$post->post_title]
                            $percentProjects = ceil(($arProjectsTypes[$post->post_title] * 100) / $countPosts);

                            ?>




                            <div
                                class="wpb_column hcode-column-container  col-md-3 col-xs-mobile-fullwidth col-sm-3 text-center">
                                <div class="vc-column-innner-wrapper">
                                    <div class="chart-style2">
                                        <div class="chart-percent"><span data-percent="<?php echo $percentProjects; ?>"
                                                                         class="chart chart-<?php echo $post->ID;?> white-text"><span
                                                    class="percent alt-font"><?php echo $percentProjects; ?></span></span></div>
                                        <div class="chart-text"><h5 class=" white-text"><?php echo $post->post_title;?></h5>
                                            <p></p></div>
                                    </div>
                                    <script type="text/javascript">jQuery(function () {
                                            jQuery('.chart-<?php echo $post->ID;?>').easyPieChart({
                                                barColor: '#FFF',
                                                trackColor: '#535353',
                                                scaleColor: false,
                                                easing: 'easeOutBounce',
                                                scaleLength: 1,
                                                lineCap: 'round',
                                                lineWidth: 1,
                                                size: 120,
                                                animate: {duration: 2000, enabled: true},
                                                onStep: function (from, to, percent) {
                                                    $(this.el).find('.percent').text(Math.round(percent));
                                                }
                                            });
                                        });</script>
                                </div>
                            </div>

                                <?php
                            }

                            wp_reset_postdata();
                            ?>





                        </div>
                    </div>
                </section>
            </div>
        </div>
    </div>
</section>
<footer class="bg-light-gray2">
    <div class=" bg-white footer-top">
        <div class="container">
            <div class="row margin-four">
                <div class="col-md-4 col-sm-4 text-center"><i class="icon-phone small-icon black-text"></i><h6
                        class="black-text margin-two no-margin-bottom">gsu_resident234</h6></div>
                <div class="col-md-4 col-sm-4 text-center"><i class="icon-map-pin small-icon black-text"></i><h6
                        class="black-text margin-two no-margin-bottom">РФ, Амурская область, г.Благовещенск</h6></div>
                <div class="col-md-4 col-sm-4 text-center"><i class="icon-envelope small-icon black-text"></i><h6
                        class="margin-two no-margin-bottom"><a href="mailto:gsu1234@mail.ru">gsu1234@mail.ru</a>
                    </h6></div>
            </div>
        </div>
    </div>
    <?php /* ?>
    <div class="container">
        <div class="row margin-four ">
            <div class="col-md-6 col-sm-12 footer-social text-right sm-text-center footer-position">
                <div id="text-14" class="custom-widget widget_text">
                    <div class="textwidget"><a href="https://www.facebook.com/" target="_blank" class="black-text-link"><i
                                class="fa fa-facebook"></i></a><a href="https://twitter.com/" target="_blank"
                                                                  class="black-text-link"><i class="fa fa-twitter"></i></a><a
                            href="https://plus.google.com" target="_blank" class="black-text-link"><i
                                class="fa fa-google-plus"></i></a><a href="https://dribbble.com/" target="_blank"
                                                                     class="black-text-link"><i
                                class="fa fa-dribbble"></i></a> <a href="https://www.youtube.com/" target="_blank"
                                                                   class="black-text-link"><i class="fa fa-youtube"></i></a><a
                            href="https://www.linkedin.com/" target="_blank" class="black-text-link"><i
                                class="fa fa-linkedin"></i></a></div>
                </div>
            </div>
        </div>
    </div>
 <?php */ ?>

    <div class="container-fluid bg-dark-gray footer-bottom">
        <div class="container">
            <div class="row margin-three">
                <div
                    class="col-md-9 col-sm-9 col-xs-12 copyright text-left letter-spacing-1 xs-text-center xs-margin-bottom-one light-gray-text2">
                    © 2017 Персональный сайт</div>
                <div class="col-md-3 col-sm-3 col-xs-12 footer-logo text-right xs-text-center"><a
                        href="/"><img alt="H-Code"

                                      src="<?php echo PERSONAL_WP_HCODE_URL; ?>/h-code/wp-content/uploads/2015/08/logo-light-gray.png"
                                                                       width="210" height="39"></a></div>
            </div>
        </div>
    </div>
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
