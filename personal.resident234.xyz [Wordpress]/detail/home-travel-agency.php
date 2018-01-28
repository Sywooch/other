<?php
/**
 * Created by PhpStorm.
 * User: GSU
 * Date: 29.07.2017
 * Time: 15:08
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
<body class="page-template-default page page-id-10 wpb-js-composer js-comp-ver-5.1 vc_responsive">
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
<section class="parent-section no-padding post-10 page type-page status-publish hentry">
    <div class="container-fluid">
        <div class="row">
            <div class="entry-content">
                <section class="  no-padding">
                    <div class="container-fluid">
                        <div class="row">
                            <div class="wpb_column hcode-column-container  col-xs-mobile-fullwidth">
                                <div class="vc-column-innner-wrapper">
                                    <div id="slider"
                                         class="no-padding bg-black travel-slider overflow-hidden
                                         square-pagination light-pagination light-navigation white-cursor
                                         home-travel-agency hcode-owl-slider4 ">
                                        <div id="home-travel-agency" class="owl-carousel owl-theme">
                                            <?php foreach($arProjectAllImages as $projectImage){ ?>
                                            <div class="item owl-bg-img full-screen js-background"
                                                 data-image="<?php echo $projectImage; ?>"
                                                 style="background-image:url()"></div>
                                            <?php } ?>
                                        </div>
                                    </div>
                                    <script type="text/javascript">/*<![CDATA[*/
                                        jQuery(document).ready(function () {
                                            jQuery("#home-travel-agency").owlCarousel({
                                                touchDrag: false,
                                                mouseDrag: false,
                                                navigation: true,
                                                pagination: true,
                                                transitionStyle: "fade",
                                                autoPlay: 3000,
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
                <section>
                    <div class="container">
                        <div class="row">
                            <div
                                class="wpb_column hcode-column-container  col-md-12 col-xs-mobile-fullwidth col-sm-12 text-center">
                                <div class="vc-column-innner-wrapper"><h1 class="section-title  no-padding"
                                                                          style="font-size:24px !important;font-weight:600 !important;;">
                                        <?php echo $arProject["post_title"];?></h1>
                                    <p><span class="text-med text-uppercase letter-spacing-2
                                    display-block"><?php echo implode("  ", $arPostTagsNames); ?></span>
                                    </p> <a href="/projects/" target="_self"
                                            class="inner-link highlight-button-black-border btn-small
                                            margin-top-30px button btn">
                                        Проекты
                                    </a></div>
                            </div>
                        </div>
                    </div>
                </section>
                <section class="  no-padding">
                    <div class="container-fluid">
                        <div class="row">


                            <?php
                            foreach($arProjectImages as $projectImage){

                                $filename = $projectImage;
                                $new_filen = $_SERVER["DOCUMENT_ROOT"].'/wp-content/uploads/' . basename($filename);


                                $fileNew = "/wp-content/uploads/" . basename($filename);

                                cropImage($projectImage,
                                    $_SERVER['DOCUMENT_ROOT'] . $fileNew,
                                    900, 700);

                                ?>
                            <div
                                class="wpb_column hcode-column-container  col-md-3 col-xs-mobile-fullwidth
                                col-sm-6 text-center no-padding"
                                style=" background:#000000;">
                                <div class="vc-column-innner-wrapper">
                                    <div class="travel-adventure overflow-hidden position-relative ">
                                        <a href="#">
                                            <img
                                                    data-image="<?php echo $fileNew;?>"
                                                    class="js-img"
                                                src=""
                                                alt="" width="900" height="700"/>
                                        </a>
                                        <figure class="text-large letter-spacing-3" style="color:#ffffff !important">
                                            <? displayRandomElement($arPostTagsNames);?>
                                        </figure>
                                    </div>
                                </div>
                            </div>
                            <?php } ?>





                        </div>
                    </div>
                </section>
                <section>
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

                            <div
                                class="wpb_column hcode-column-container  col-md-3 col-xs-mobile-fullwidth col-sm-6 text-center sm-margin-ten-bottom wow fadeInUp"
                                data-wow-duration=300ms>
                                <div class="vc-column-innner-wrapper">
                                    <div class="counter-section"><span id="counter_1" data-to="<?php echo $countPosts;?>"
                                                                       class="counter-number black-text">
                                            <?php echo $countPosts;?>
                                        </span><span
                                            class="counter-title" style="color: #626262">
                                            <?php
                                            echo numberof($countPosts, '',
                                                array('Проект', 'Проекта', 'Проектов'));
                                            ?>
                                        </span></div>
                                </div>
                            </div>
                            <div
                                class="wpb_column hcode-column-container  col-md-3 col-xs-mobile-fullwidth col-sm-6 text-center sm-margin-ten-bottom wow fadeInUp"
                                data-wow-duration=600ms>
                                <div class="vc-column-innner-wrapper">
                                    <div class="counter-section"><span id="counter_2" data-to="<?php echo $countSertificates;?>"
                                                                       class="counter-number black-text">
                                            <?php echo $countSertificates;?>
                                        </span><span
                                            class="counter-title" style="color: #626262">
                                            <?php
                                            echo numberof($countPosts, '',
                                                array('Сертификат', 'Сертификата', 'Сертификатов'));
                                            ?>
                                        </span></div>
                                </div>
                            </div>
                            <div
                                class="wpb_column hcode-column-container  col-md-3 col-xs-mobile-fullwidth col-sm-6 text-center xs-margin-ten-bottom wow fadeInUp"
                                data-wow-duration=900ms>
                                <div class="vc-column-innner-wrapper">
                                    <div class="counter-section"><span id="counter_3" data-to="<?php echo $countFilesInRepo; ?>"
                                                                       class="counter-number black-text">
                                            <?php echo $countFilesInRepo; ?>
                                        </span><span
                                            class="counter-title" style="color: #626262">Файлов с кодом в репозитории</span></div>
                                </div>
                            </div>
                            <div
                                class="wpb_column hcode-column-container  col-md-3 col-xs-mobile-fullwidth col-sm-6 text-center wow fadeInUp"
                                data-wow-duration=1200ms>
                                <div class="vc-column-innner-wrapper">
                                    <div class="counter-section"><span id="counter_4" data-to="<?php echo $humanYearsRemote; ?>"
                                                                       class="counter-number black-text"><?php echo $humanYearsRemote; ?></span><span
                                            class="counter-title" style="color: #626262"><?php
                                            echo numberof($humanYearsRemote, '', array('год', 'года', 'лет'));
                                            ?> опыта удалённой работы </span></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
                <section class=" " style=" background-color:#f6f6f6; ">
                    <div class="container">
                        <div class="row">
                            <div
                                class="wpb_column hcode-column-container  col-md-3 col-xs-mobile-fullwidth col-sm-6 text-center sm-margin-ten-bottom">
                                <div class="vc-column-innner-wrapper">
                                    <div class="special-offers ">
                                        <div class="img-border-full border-color-black"></div>
                                        <div class="special-offers-sub"><img
                                                src="" data-image="<? displayRandomElement($arProjectMockups);?>"
                                                alt="" class="margin-ten no-margin-top js-img"
                                                width="76" style="width:76px;"/><span
                                                class="title-small text-uppercase font-weight-600 letter-spacing-3 display-block margin-ten no-margin-top"
                                                style="color:#000000 !important">Другие<br/>проекты</span></div>
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

                            $arPostTagsWidget = wp_get_post_tags($post->ID);
                            unset($arPostTagsNamesWidget);
                            foreach ($arPostTagsWidget as $keyTag => $tag) {
                                //$postTagId = $tag->term_id;
                                $arPostTagsNamesWidget[] = $tag->name;

                            }
                            $thumb_id = get_post_thumbnail_id($post->ID);
                            $thumb_url_full = wp_get_attachment_image_src($thumb_id, 'full',
                                false);

                            $thumb_url_full[0] = str_replace(get_site_url(),
                                PORTFOLIO_WP_URL,
                                $thumb_url_full[0]);

                                $filename = $thumb_url_full[0];
                                $new_filen = $_SERVER["DOCUMENT_ROOT"].'/wp-content/uploads/' . basename($filename);


                                $fileNew = "/wp-content/uploads/" . basename($filename);

                                cropImage($filename,
                                    $_SERVER['DOCUMENT_ROOT'] . $fileNew,
                                    500, 600);
                            ?>



                            <div
                                class="wpb_column hcode-column-container  col-md-3 col-xs-mobile-fullwidth
                                col-sm-6 text-center sm-margin-ten-bottom">
                                <div class="vc-column-innner-wrapper">
                                    <a href="/detail/<?php echo basename(__FILE__); ?>?ID=<?php echo $post->ID; ?>"><img
                                            src="" data-image="<?php echo $fileNew; ?>"
                                            class="js-img"
                                            alt="" width="780" height="800"/></a>
                                    <div class="white-box bg-white "><span
                                            class="destinations-name text-uppercase font-weight-600 letter-spacing-3 display-block"><a
                                                href="/detail/<?php echo basename(__FILE__); ?>?ID=<?php echo $post->ID; ?>">
                                                <?php echo $post->post_title; ?>
                                            </a>
                                        </span>
                                        <span
                                            class="destinations-place text-uppercase font-weight-400
                                            letter-spacing-2 display-block">
                                            <?php echo implode(" / ", $arPostTagsNamesWidget); ?>
                                        </span>
                                    </div>
                                </div>
                            </div>


                                <?php
                                if ($i == 3) {
                                    break;
                                }
                                $i++;
                            }
                            ?>



                        </div>
                    </div>
                </section>
                <section class=" sm-padding-nine-tb padding-two-tb">
                    <div class="container-fluid">

                        <?php
                        include $_SERVER['DOCUMENT_ROOT'] . '/includes/portfolio_grid_gallery.php';
                        ?>
                        <?php
                        $i = 0;
                        foreach ($posts as $post) {

                        $private = get_post_meta($post->ID, 'PRIVATE');

                        //?mode=private
                        if ((!isset($_SESSION["mode"]) || ($_SESSION["mode"] != "private")) &&
                            ($private[0] == "1")
                        ) {
                            continue;
                        }

                        setup_postdata($post);

                        $arPostTagsWidget = wp_get_post_tags($post->ID);
                        unset($arPostTagsNamesWidget);
                        foreach ($arPostTagsWidget as $keyTag => $tag) {
                            //$postTagId = $tag->term_id;
                            $arPostTagsNamesWidget[] = $tag->name;

                        }
                        $thumb_id = get_post_thumbnail_id($post->ID);
                        $thumb_url_full = wp_get_attachment_image_src($thumb_id, 'full',
                            false);

                        $thumb_url_full[0] = str_replace(get_site_url(),
                            PORTFOLIO_WP_URL,
                            $thumb_url_full[0]);

                            $filename = $thumb_url_full[0];
                            $new_filen = $_SERVER["DOCUMENT_ROOT"].'/wp-content/uploads/' . basename($filename);


                            $fileNew = "/wp-content/uploads/" . basename($filename);

                            cropImage($filename,
                                $_SERVER['DOCUMENT_ROOT'] . $fileNew,
                                963, 662);

                        ?>
                        <div
                            class="wpb_column hcode-column-container  col-md-4 col-xs-mobile-fullwidth
                            col-sm-6 xs-no-padding margin-two-bottom sm-margin-four-bottom">
                            <div class="vc-column-innner-wrapper">
                                <div class="cover-background best-hotels-img js-background"
                                     data-image="<?php echo $fileNew; ?>"
                                     style="background-image:url();" >
                                    <div class="col-md-6 col-sm-9 text-center best-hotels-text bg-white pull-right ">
                                        <div><i class="fa fa-star-o small-icon" style="color:#e6af2a !important"></i><i
                                                class="fa fa-star-o small-icon" style="color:#e6af2a !important"></i><i
                                                class="fa fa-star-o small-icon" style="color:#e6af2a !important"></i><i
                                                class="fa fa-star-o small-icon" style="color:#e6af2a !important"></i><i
                                                class="fa fa-star-o small-icon" style="color:#e6af2a !important"></i></div>
                                        <span
                                            class="text-uppercase font-weight-600 display-block margin-ten
                                            no-margin-bottom letter-spacing-2"
                                            style="color:#000000 !important; height:100px;">
                                            <?php echo $post->post_title; ?></span><span
                                            class="text-uppercase letter-spacing-2 margin-ten display-block
                                            no-margin-top"
                                        style="height:110px;"><?php echo implode(" / ", $arPostTagsNamesWidget); ?></span><a
                                            href="/detail/<?php echo basename(__FILE__); ?>?ID=<?php echo $post->ID; ?>"
                                            class="highlight-button-dark btn btn-small button no-margin-lr"
                                            target="_self">Детали</a></div>
                                    <div
                                        class="destinations-offer bg-fast-yellow text-center font-weight-600
                                        text-uppercase black-text text-large no-letter-spacing">
                                        <?php echo get_post_meta($arProject["ID"], 'YEAR')[0]; ?>
                                        <span class="display-block text-small"></span></div>
                                </div>
                            </div>
                        </div>

                            <?php
                            $i++;
                        }
                        ?>


                    </div>
                </section>
                <section class=" " style=" background-color:#f6f6f6; ">
                    <div class="container">
                        <div class="row">
                            <div
                                class="wpb_column hcode-column-container  col-md-3 col-xs-mobile-fullwidth
                                col-sm-6 text-center sm-margin-ten-bottom">
                                <div class="vc-column-innner-wrapper">
                                    <div class="features-box-style1"><i class="icon-desktop medium-icon"></i><h5
                                            class="">Идея</h5></div>
                                    <div class="separator-line" style=" background:#d94378;height:4px;"></div>
                                </div>
                            </div>
                            <div
                                class="wpb_column hcode-column-container  col-md-3 col-xs-mobile-fullwidth col-sm-6 text-center sm-margin-ten-bottom">
                                <div class="vc-column-innner-wrapper">
                                    <div class="features-box-style1"><i class="icon-desktop medium-icon"></i><h5
                                            class="">Планирование</h5></div>
                                    <div class="separator-line" style=" background:#d94378;height:4px;"></div>
                                </div>
                            </div>
                            <div
                                class="wpb_column hcode-column-container  col-md-3 col-xs-mobile-fullwidth col-sm-6 text-center xs-margin-ten-bottom">
                                <div class="vc-column-innner-wrapper">
                                    <div class="features-box-style1"><i class="icon-desktop medium-icon"></i><h5 class="">
                                            Разработка</h5></div>
                                    <div class="separator-line" style=" background:#d94378;height:4px;"></div>
                                </div>
                            </div>
                            <div
                                class="wpb_column hcode-column-container  col-md-3 col-xs-mobile-fullwidth col-sm-6 text-center">
                                <div class="vc-column-innner-wrapper">
                                    <div class="features-box-style1"><i class="icon-desktop medium-icon"></i><h5
                                            class="">Запуск</h5></div>
                                    <div class="separator-line" style=" background:#d94378;height:4px;"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
                <section id="about" class="  no-padding-top xs-no-padding-bottom">
                    <div class="container-fluid">
                        <div class="row">
                            <div
                                class="wpb_column hcode-column-container  col-xs-mobile-fullwidth text-center padding-three-top sm-padding-five-top">
                                <div class="vc-column-innner-wrapper">
                                    <div class="col-md-12 text-center">
                                        <div class="text-center">
                                            <ul class="portfolio-filter nav nav-tabs nav-tabs-gray wow fadeInUp"
                                            style="height:auto; margin-bottom:20px;">
                                                <?php
                                                include $_SERVER['DOCUMENT_ROOT'] . '/includes/portfolio_filter.php';
                                                ?>
                                            </ul>
                                        </div>
                                    </div>
                                    <div class="work-4col gutter work-with-title wide wide-title ">
                                        <div
                                            class="col-md-12  no-padding grid-gallery overflow-hidden no-padding content-section">
                                            <div class="tab-content">
                                                <ul class="grid masonry-items ">


                                                    <?php
                                                    include $_SERVER['DOCUMENT_ROOT'] . '/includes/portfolio_grid_gallery.php';
                                                    ?>

                                                    <?php
                                                    $i = 0;
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

                                                        cropImage($filename,
                                                            $_SERVER['DOCUMENT_ROOT'] . $fileNew,
                                                            800, 500);

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
                                                                    href="/detail/<?php echo basename(__FILE__); ?>?ID=<?php echo $post->ID; ?>"
                                                                    class="" target="">
                                                                    <img alt=""
                                                                         data-image="<?php echo $fileNew;?>"
                                                                                            src="<?php echo $fileNew;?>"
                                                                         class="js-img"
                                                                                            width="800"
                                                                                            height="500"/></a></div>
                                                            <figcaption><h3><a
                                                                        href="/detail/<?php echo basename(__FILE__); ?>?ID=<?php echo $post->ID; ?>"
                                                                        class="" target=""><?php echo $post->post_title;?></a></h3>
                                                                <p><?php echo implode(" / ", $arCurrentPostTagsNames); ?></p><a
                                                                    class=" btn inner-link btn-black btn-small"
                                                                    href="/detail/<?php echo basename(__FILE__); ?>?ID=<?php echo $post->ID; ?>"
                                                                    target="">Детали</a></figcaption>
                                                        </figure>
                                                    </li>



                                                        <?php

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
                <section class=" " style=" background-color:#f6f6f6; ">
                    <div class="container">
                        <div class="row">
                            <div
                                    class="wpb_column hcode-column-container  col-md-3 col-xs-mobile-fullwidth col-sm-6 text-center sm-margin-ten-bottom">
                                <div class="vc-column-innner-wrapper">
                                    <div class="special-offers ">
                                        <div class="img-border-full border-color-black"></div>
                                        <div class="special-offers-sub"><img
                                                    src="" data-image="<? displayRandomElement($arProjectMockups);?>"
                                                    alt="" class="margin-ten no-margin-top js-img"
                                                    width="76" style="width:76px;"/><span
                                                    class="title-small text-uppercase font-weight-600 letter-spacing-3 display-block margin-ten no-margin-top"
                                                    style="color:#000000 !important">Другие<br/>проекты</span></div>
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

                                $arPostTagsWidget = wp_get_post_tags($post->ID);
                                unset($arPostTagsNamesWidget);
                                foreach ($arPostTagsWidget as $keyTag => $tag) {
                                    //$postTagId = $tag->term_id;
                                    $arPostTagsNamesWidget[] = $tag->name;

                                }
                                $thumb_id = get_post_thumbnail_id($post->ID);
                                $thumb_url_full = wp_get_attachment_image_src($thumb_id, 'full',
                                    false);

                                $thumb_url_full[0] = str_replace(get_site_url(),
                                    PORTFOLIO_WP_URL,
                                    $thumb_url_full[0]);

                                $filename = $thumb_url_full[0];
                                $new_filen = $_SERVER["DOCUMENT_ROOT"].'/wp-content/uploads/' . basename($filename);


                                $fileNew = "/wp-content/uploads/" . basename($filename);

                                cropImage($filename,
                                    $_SERVER['DOCUMENT_ROOT'] . $fileNew,
                                    500, 600);
                                ?>



                                <div
                                        class="wpb_column hcode-column-container  col-md-3 col-xs-mobile-fullwidth
                                col-sm-6 text-center sm-margin-ten-bottom">
                                    <div class="vc-column-innner-wrapper">
                                        <a href="/detail/<?php echo basename(__FILE__); ?>?ID=<?php echo $post->ID; ?>"><img
                                                    src="" data-image="<?php echo $fileNew; ?>"
                                                    class="js-img"
                                                    alt="" width="780" height="800"/></a>
                                        <div class="white-box bg-white "><span
                                                    class="destinations-name text-uppercase font-weight-600 letter-spacing-3 display-block"><a
                                                        href="/detail/<?php echo basename(__FILE__); ?>?ID=<?php echo $post->ID; ?>">
                                                <?php echo $post->post_title; ?>
                                            </a>
                                        </span>
                                            <span
                                                    class="destinations-place text-uppercase font-weight-400
                                            letter-spacing-2 display-block">
                                            <?php echo implode(" / ", $arPostTagsNamesWidget); ?>
                                        </span>
                                        </div>
                                    </div>
                                </div>


                                <?php
                                if ($i == 3) {
                                    break;
                                }
                                $i++;
                            }
                            ?>



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