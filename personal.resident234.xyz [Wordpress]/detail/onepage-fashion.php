<?php
/**
 * Created by PhpStorm.
 * User: GSU
 * Date: 29.07.2017
 * Time: 15:26
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
<body class="page-template-default page page-id-44 wpb-js-composer js-comp-ver-5.1 vc_responsive">
<nav class="navbar navbar-default navbar-fixed-top nav-transparent overlay-nav sticky-nav nav-dark  nav-white "
     data-menu-hover-delay="100">
    <div class="container">
        <div class="row">


            <?php
            include $_SERVER['DOCUMENT_ROOT'] . '/includes/head_logo_fashion.php';
            ?>


            <div class="navbar-header col-sm-8 sm-width-auto col-xs-2 pull-right">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse"><span
                        class="sr-only">Toggle navigation</span> <span class="icon-bar"></span> <span
                        class="icon-bar"></span> <span class="icon-bar"></span></button>
            </div>
            <div class="col-md-8 no-padding-right accordion-menu text-right pull-right menu-position-right">
                <div id="mega-menu" class="navbar-collapse collapse navbar-right">
                    <ul id="menu-onepage-fashion" class="mega-menu-ul nav navbar-nav navbar-right panel-group">
                        <?php
                        include $_SERVER['DOCUMENT_ROOT'] . '/includes/main_menu.php';
                        ?>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</nav>
<section class="parent-section no-padding post-44 page type-page status-publish hentry">
    <div class="container-fluid">
        <div class="row">
            <div class="entry-content">
                <section id="slider" class="  no-padding">
                    <div class="container-fluid">
                        <div class="row">
                            <div class="wpb_column hcode-column-container  col-xs-mobile-fullwidth">
                                <div class="vc-column-innner-wrapper">
                                    <div class="no-padding bg-white fashion-slider position-relative overflow-hidden">
                                        <div class="background-slider-text">
                                            <div class="container full-screen position-relative">
                                                <div class="slider-typography">
                                                    <div class="slider-text-middle-main pull-right padding-six-lr"
                                                         style="background:rgba(195,52,96,0.8) !important ">
                                                        <div
                                                            class="slider-text-bottom slider-text-middle5 text-left no-padding">
                                                            <span
                                                                class="slider-title-big5 alt-font white-text
                                                                margin-twentytwo">
                                                            <?php echo $arProject["post_title"];?>
                                                            </span>
                                                            <div
                                                                class="separator-line bg-white no-margin-lr no-margin-top margin-twentytwo"></div>
                                                        </div>
                                                    </div>
                                                    <div class="pull-right xs-display-none"><img
                                                            src="" class="js-img"
                                                            data-image="<?php echo $thimbnailProjectImage;?>"
                                                            width="90" alt=""></div>
                                                </div>
                                            </div>
                                        </div>
                                        <div id="fashion-slider"
                                             class="owl-carousel owl-theme  dot-pagination dark-pagination dark-navigation no-cursor  hcode-owl-slider10 ">

                                            <?php
                                            foreach($arProjectAllImages as $keyProjectImage => $projectImage) {
                                            ?>

                                            <div class="item owl-bg-img full-screen js-background"
                                                 data-image="<?php echo $projectImage; ?>"
                                                 style="background-image:url()"></div>

                                                <?php
                                            }
                                            ?>

                                        </div>
                                    </div>
                                    <script type="text/javascript">/*<![CDATA[*/
                                        jQuery(document).ready(function () {
                                            jQuery("#fashion-slider").owlCarousel({
                                                navigation: false,
                                                pagination: false,
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
                <section id="features" class=" " style=" background-color:#000000; ">
                    <div class="container">
                        <div class="row">
                            <div
                                class="wpb_column hcode-column-container  col-md-12 col-xs-mobile-fullwidth text-center">
                                <div class="vc-column-innner-wrapper"><h3 class="section-title  no-padding"
                                                                          style=" color:#c2345f; ">Описание</h3></div>
                            </div>
                            <div
                                class="wpb_column hcode-column-container  col-md-5 col-xs-mobile-fullwidth text-center center-col margin-five-top">
                                <div class="vc-column-innner-wrapper">
                                    <h4 class="gray-text">
                                        <?php echo $arProject["post_content_formatted"]; ?>
                                    </h4>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
                <section class="  parallax-fix parallax1 js-background"
                         data-image="<?php displayRandomElement($currentBackgroundImage); ?>"
                         style=" background-image: url(); ">
                    <div class="selection-overlay" style=" opacity:0.8; background-color:#c2345f;"></div>
                    <div class="container">
                        <div class="row">
                            <div
                                class="wpb_column hcode-column-container  col-md-6 col-xs-mobile-fullwidth col-sm-6 text-center center-col no-padding-bottom">
                                <div class="vc-column-innner-wrapper"><i class=" large-icon margin-ten-bottom"
                                                                         style="color:#ffffff !important"></i><span
                                        class="parallax-title alt-font" style="color:#ffffff !important">
                                        Галерея</span>
                                    <p class="parallax-sub-title white-text">
                                        проекта
                                    </p>
                                    <div class="separator-line bg-white"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
                <section class=" " style=" background-color:#000000; ">
                    <div class="container">
                        <div class="row">
                            <div
                                class="wpb_column hcode-column-container  col-md-12 col-xs-mobile-fullwidth text-center margin-ten-bottom">
                                <div class="vc-column-innner-wrapper"><h1 class="section-title  no-padding"
                                                                          style=" color:#c2345f; ">
                                        <?php echo randomText()[0]; ?>
                                    </h1>
                                    <p class="title-small gray-text text-uppercase">
                                        <?php echo randomText()[1]; ?>
                                    </p></div>
                            </div>

                            <?php
                            $filename = getRandomElement($arProjectImages);

                            $new_filen = $_SERVER["DOCUMENT_ROOT"].'/wp-content/uploads/' . basename($filename);


                            $fileNew = "/wp-content/uploads/" . basename($filename);
                            $fileNew = cropImage($filename,
                                $_SERVER['DOCUMENT_ROOT'] . $fileNew,
                                500, 500);
                            ?>
                            <div
                                class="wpb_column hcode-column-container  col-md-6 col-xs-mobile-fullwidth col-sm-12 text-center sm-margin-four-bottom">
                                <div class="vc-column-innner-wrapper"><img
                                        src="<?php echo $fileNew; ?>"
                                        width="500" height="500" alt=""></div>
                            </div>

                            <?php
                            $filename = getRandomElement($arProjectImages);

                            $new_filen = $_SERVER["DOCUMENT_ROOT"].'/wp-content/uploads/' . basename($filename);


                            $fileNew = "/wp-content/uploads/" . basename($filename);
                            $fileNew = cropImage($filename,
                                $_SERVER['DOCUMENT_ROOT'] . $fileNew,
                                500, 500);
                            ?>
                            <div
                                class="wpb_column hcode-column-container  col-md-6 col-xs-mobile-fullwidth col-sm-12 text-center">
                                <div class="vc-column-innner-wrapper"><img
                                        src="<?php echo $fileNew; ?>"
                                        width="500" height="500" alt=""></div>
                            </div>
                        </div>
                    </div>
                </section>
                <section id="model">
                    <div class="container-fluid">
                        <div class="row">
                            <div
                                class="wpb_column hcode-column-container  col-md-12 col-xs-mobile-fullwidth text-center">
                                <div class="vc-column-innner-wrapper">
                                    <h3 class="section-title  black-text no-padding">
                                        Другие проекты</h3></div>
                            </div>
                            <div
                                class="wpb_column hcode-column-container  col-lg-3 col-md-5 col-xs-mobile-fullwidth col-sm-11 text-center center-col margin-three">
                                <div class="vc-column-innner-wrapper">
                                    <h4 class="gray-text">
                                        <?php displayRandomElement($currentDetailTitle); ?>
                                    </h4>
                                </div>
                            </div>


                            <div
                                class="wpb_column hcode-column-container  col-md-12 col-xs-12 col-sm-12 no-padding margin-five-bottom sm-margin-ten-bottom">
                                <div class="vc-column-innner-wrapper">
                                    <div class="work-4col masonry wide ">
                                        <div
                                            class="col-md-12  margin-top-20px grid-gallery overflow-hidden no-padding content-section">
                                            <div class="tab-content">
                                                <ul class="grid masonry-items ">



                                                    <?php
                                                    include $_SERVER['DOCUMENT_ROOT'] . '/includes/portfolio_grid_gallery_new_first.php';
                                                    ?>


                                                    <?php
                                                    $i = 1;
                                                    foreach ($arNewProjects as $post) {

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



                                                        $height = 600;
                                                    if($i == 1 || $i == 4){
                                                        $height = 1200;
                                                    }

                                                    $width = 800;
                                                    $fileNew = "/wp-content/uploads/" . basename($filename);
                                                    $fileNew = cropImage($filename,
                                                        $_SERVER['DOCUMENT_ROOT'] . $fileNew,
                                                        $width, $height);

                                                    $arPostTags = wp_get_post_tags($post->ID);
                                                    unset($arCurrentPostTagsNames);
                                                    foreach ($arPostTags as $tag){
                                                        $arCurrentPostTagsNames[] = $tag->name;
                                                    }
                                                    ?>


                                                    <li class="portfolio-filter-162 ">
                                                        <figure>
                                                            <div class="gallery-img"><a
                                                                    href="/detail/<?php echo basename(__FILE__); ?>?ID=<?php echo $post->ID; ?>"><img alt=""
                                                                                                             src="<?php echo $fileNew; ?>"
                                                                                                             width="<?php echo $width; ?>"
                                                                                                             height="<?php echo $height; ?>"/></a>
                                                            </div>
                                                            <figcaption><h3><a
                                                                        href="/detail/<?php echo basename(__FILE__); ?>?ID=<?php echo $post->ID; ?>"
                                                                        ><?php echo $post->post_title; ?></a></h3>
                                                                <p><?php echo implode(" | ", $arCurrentPostTagsNames); ?></p></figcaption>
                                                        </figure>
                                                    </li>

                                                        <?php

                                                        if($i == 6) break;
                                                        $i++;
                                                    }
                                                    ?>



                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div
                                class="wpb_column hcode-column-container  col-lg-3 col-md-5 col-xs-mobile-fullwidth col-sm-8 text-center center-col">
                                <div class="vc-column-innner-wrapper"><i class=" large-icon margin-ten-bottom"
                                                                         style="color:#000000 !important"></i>
                                    <p></p>
                                    <h1 class="section-title  black-text no-padding">
                                        <?php displayRandomElement($currentDetailTitle); ?>
                                    </h1></div>
                            </div>
                        </div>
                    </div>
                </section>
                <section id="key-person" class="  parallax-fix parallax2 js-background"
                         data-image="<?php displayRandomElement($currentBackgroundImage); ?>"
                         style=" background-image: url(); ">
                    <div class="container">
                        <div class="row">
                            <div
                                class="wpb_column hcode-column-container  col-md-12 col-xs-mobile-fullwidth text-center">
                                <div class="vc-column-innner-wrapper"><h3 class="section-title  no-padding"
                                                                          style=" color:#c2345f; ">
                                        Другие проекты
                                    </h3>
                                </div>
                            </div>
                            <div
                                class="wpb_column hcode-column-container  col-md-5 col-xs-mobile-fullwidth col-sm-8 text-center center-col margin-five-top">
                                <div class="vc-column-innner-wrapper">
                                    <h4 class="gray-text">
                                        <?php displayRandomElement($currentDetailTitle); ?>
                                    </h4></div>
                            </div>



                            <?php
                            include $_SERVER['DOCUMENT_ROOT'] . '/includes/portfolio_grid_gallery_new_first.php';
                            ?>


                            <?php
                            $i = 1;
                            foreach ($arNewProjects as $post) {

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




                            $height = 1100;
                            $width = 800;
                            $fileNew = "/wp-content/uploads/" . basename($filename);
                            $fileNew = cropImage($filename,
                                $_SERVER['DOCUMENT_ROOT'] . $fileNew,
                                $width, $height);

                            $arPostTags = wp_get_post_tags($post->ID);
                            unset($arCurrentPostTagsNames);
                            foreach ($arPostTags as $tag){
                                $arCurrentPostTagsNames[] = $tag->name;
                            }
                            ?>
                            <div
                                class="wpb_column hcode-column-container  col-md-4
                                col-xs-mobile-fullwidth col-sm-4 text-center margin-ten-top">
                                <div class="vc-column-innner-wrapper">
                                    <div class="fashion-team key-person-fashion ">
                                        <div class="key-person">
                                            <div class="key-person-img"><img alt=""
                                                                             src="<?php echo $fileNew; ?>"
                                                                             width="800" height="1100"></div>
                                            <div class="key-person-details bg-white"><span
                                                    class="person-name black-text">
                                                    <?php echo $post->post_title; ?>
                                                </span><span
                                                    class="person-post black-text">
                                                    <?php echo implode("   ", $arCurrentPostTagsNames); ?>
                                                </span>
                                                <div class="separator-line"
                                                     style="background: #c2345f !important;"></div>
                                                <div class="person-social"></div>
                                                <p class="margin-three black-text"></p>
                                                <p class="margin-three black-text">
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
                                                <p></p></div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                                <?php

                                if($i == 3) break;
                                $i++;
                            }
                            ?>





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

                            $diffDateRemote =  current_time('timestamp') - strtotime("01-12-2012");
                            $humanYearsRemote = floor($diffDateRemote / 31536000);

                            include $_SERVER['DOCUMENT_ROOT'] . '/includes/GitHub.php';

                            ?>




                            <div
                                class="wpb_column hcode-column-container  col-md-3 col-xs-mobile-fullwidth col-sm-6 text-center sm-margin-ten-bottom">
                                <div class="vc-column-innner-wrapper">
                                    <div class="counter-section"><i class="icon-tools medium-icon"
                                                                    style="color: #c2345f"></i>
                                        <span id="counter_1"


                                              data-to="<?php echo $countPosts;?>"

                                              class="counter-number black-text"><?php echo $countPosts;?></span><span
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
                                    <div class="counter-section"><i class="icon-scissors medium-icon"
                                                                    style="color: #c2345f"></i><span id="counter_2"

                                                                                                     data-to="<?php echo $countSertificates;?>"
                                                                                                     class="counter-number
                                                                                                     black-text"><?php echo $countSertificates;?></span><span
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
                                    <div class="counter-section"><i class="icon-camera medium-icon"
                                                                    style="color: #c2345f"></i><span id="counter_3"
                                                                                                     data-to="<?php echo $countFilesInRepo; ?>"
                                                                                                     class="counter-number black-text"><?php echo $countFilesInRepo; ?></span><span
                                            class="counter-title">Файлов с кодом в репозитории</span></div>
                                </div>
                            </div>
                            <div
                                class="wpb_column hcode-column-container  col-md-3 col-xs-mobile-fullwidth col-sm-6 text-center">
                                <div class="vc-column-innner-wrapper">
                                    <div class="counter-section"><i class="icon-briefcase medium-icon"
                                                                    style="color: #c2345f"></i><span id="counter_4"
                                                                                                     data-to="<?php echo $humanYearsRemote; ?>"
                                                                                                     class="counter-number black-text"><?php echo $humanYearsRemote; ?></span><span
                                            class="counter-title"><?php
                                            echo numberof($humanYearsRemote, '', array('год', 'года', 'лет'));
                                            ?> опыта работы</span></div>
                                </div>
                            </div>




                        </div>
                    </div>
                </section>
                <section class="  no-padding">
                    <div class="container-fluid">
                        <div class="row">

                            <?php
                            $filename = getRandomElement($arProjectImages);

                                                        $width = 898;
                                                        $height = 840;
                                                        $fileNew = "/wp-content/uploads/" . basename($filename);
                                                        $fileNew = cropImage($filename,
                                                            $_SERVER['DOCUMENT_ROOT'] . $fileNew,
                                                            $width, $height);
                            ?>
                            <div class="wpb_column hcode-column-container  col-md-4 col-xs-12 col-sm-12 no-padding">
                                <div class="vc-column-innner-wrapper"><img
                                        src="<?php echo $fileNew; ?>"
                                        width="898" height="840" alt=""></div>
                            </div>

                            <?php
                            $filename = getRandomElement($arProjectImages);

                            $width = 898;
                            $height = 840;
                            $fileNew = "/wp-content/uploads/" . basename($filename);
                            $fileNew = cropImage($filename,
                                $_SERVER['DOCUMENT_ROOT'] . $fileNew,
                                $width, $height);
                            ?>
                            <div class="wpb_column hcode-column-container  col-md-4 col-xs-12 col-sm-12 no-padding">
                                <div class="vc-column-innner-wrapper"><img
                                        src="<?php echo $fileNew; ?>"
                                        width="898" height="840" alt=""></div>
                            </div>
                            <div class="wpb_column hcode-column-container  col-md-4 col-xs-12 col-sm-12 no-padding">
                                <div class="vc-column-innner-wrapper">
                                    <div class="fashion-person fashion-right">

                                        <?php
                                        $filename = getRandomElement($arProjectImages);

                                        $width = 899;
                                        $height = 841;
                                        $fileNew = "/wp-content/uploads/" . basename($filename);
                                        $fileNew = cropImage($filename,
                                            $_SERVER['DOCUMENT_ROOT'] . $fileNew,
                                            $width, $height);
                                        ?>
                                        <img alt=""

                                             src="<?php echo $fileNew; ?>"

                                             width="899" height="841">
                                        <div class="right-content" style="background:rgba(195,52,96,0.8);"><span
                                                class="title-large text-uppercase letter-spacing-2 display-block"
                                                style="color:#ffffff !important">Год разработки</span><span
                                                class="owl-subtitle sm-margin-top-five
                                                sm-margin-bottom-five"
                                                style="color:#ffffff !important"><?php echo $YEAR; ?></span>
                                            <div class="separator-line bg-white"></div>
                                            <h4 class="white-text no-padding-lr xs-display-none">
                                                <?php echo implode("  ", $arPostTagsNames); ?>
                                            </h4>

                                            <?php
                                            if($ProjectURL) {
                                                ?>
                                                <a
                                                        class="btn btn-small-white-background margin-seven
                                                margin-four-bottom"
                                                        href="<?php echo $ProjectURL; ?>"
                                                        target="_self">Ссылка на проект</a>

                                                <?php
                                            }
                                            ?>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
                <section id="portfolio" class="  no-padding-bottom">
                    <div class="container-fluid">
                        <div class="row">
                            <div
                                class="wpb_column hcode-column-container  col-md-12 col-xs-mobile-fullwidth text-center">
                                <div class="vc-column-innner-wrapper"><h3 class="section-title  black-text no-padding">
                                        Галерея проекта</h3></div>
                            </div>
                            <div
                                class="wpb_column hcode-column-container  col-lg-3 col-md-8 col-xs-mobile-fullwidth col-sm-11 text-center center-col margin-three">
                                <div class="vc-column-innner-wrapper"><h4 class="gray-text">
                                        <?php displayRandomElement($currentDetailTitle); ?>
                                    </h4></div>
                            </div>
                            <div class="wpb_column hcode-column-container  col-xs-mobile-fullwidth no-padding">
                                <div class="vc-column-innner-wrapper">
                                    <div class="work-4col  ">
                                        <div
                                            class="col-md-12  no-padding margin-top-20px grid-gallery overflow-hidden  content-section">
                                            <div class="tab-content">
                                                <ul class="grid masonry-items lightbox-gallery">

                                                    <?php
                                                    foreach($arProjectImages as $keyProjectImage => $projectImage) {

                                                        $filename = $projectImage;

                                                        $width = 800;
                                                        $height = 600;
                                                        $fileNew = "/wp-content/uploads/" . basename($filename);
                                                        $fileNew = cropImage($filename,
                                                            $_SERVER['DOCUMENT_ROOT'] . $fileNew,
                                                            $width, $height);
                                                        ?>
                                                        <li class="portfolio-filter-163 ">
                                                            <figure>
                                                                <div class="gallery-img"><a
                                                                            href="<?php echo $projectImage; ?>"
                                                                            class="lightboxgalleryitem"
                                                                            data-group="general"><img
                                                                                src="<?php echo $fileNew; ?>"
                                                                                width="800" height="600" alt=""></a>
                                                                </div>
                                                                <figcaption><h3><?php displayRandomElement($arPostTagsNames); ?></h3>
                                                                    <p><?php displayRandomElement($arPostTagsNames); ?></p></figcaption>
                                                            </figure>
                                                        </li>
                                                        <?php
                                                        if($keyProjectImage == 7) break;
                                                    }
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
                <section id="blog" class="  position-relative">
                    <div class="container-fluid">
                        <div class="row">
                            <div
                                class="wpb_column hcode-column-container  col-md-12 col-xs-mobile-fullwidth text-center">
                                <div class="vc-column-innner-wrapper">
                                    <h3 class="section-title  black-text">
                                        Другие проекты
                                    </h3></div>
                            </div>
                            <div
                                class="wpb_column hcode-column-container  col-xs-mobile-fullwidth col-sm-12 no-padding">
                                <div class="vc-column-innner-wrapper">
                                    <div class="blog-slider blog-slider-padding position-relative">
                                        <div class="container">
                                            <div class="row">
                                                <div id="blog-post-slider-1449837297"
                                                     class="owl-carousel owl-theme  light-navigation dot-pagination dark-pagination black-cursor">


                                                    <?php
                                                    include $_SERVER['DOCUMENT_ROOT'] . '/includes/portfolio_grid_gallery_new_first.php';
                                                    ?>


                                                    <?php
                                                    $i = 1;
                                                    foreach ($arNewProjects as $post) {

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




                                                    $height = 564;
                                                    $width = 900;
                                                    $fileNew = "/wp-content/uploads/" . basename($filename);
                                                    $fileNew = cropImage($filename,
                                                        $_SERVER['DOCUMENT_ROOT'] . $fileNew,
                                                        $width, $height);



                                                    $height = 188;
                                                    $width = 300;
                                                    $fileNew300w = "/wp-content/uploads/" . basename($filename);
                                                    $fileNew300w = cropImage($filename,
                                                        $_SERVER['DOCUMENT_ROOT'] . $fileNew150,
                                                        $width, $height);


                                                    $height = 481;
                                                    $width = 768;
                                                    $fileNew768w = "/wp-content/uploads/" . basename($filename);
                                                    $fileNew768w = cropImage($filename,
                                                        $_SERVER['DOCUMENT_ROOT'] . $fileNew300,
                                                        $width, $height);


                                                        $height = 83;
                                                        $width = 133;
                                                        $fileNew133w = "/wp-content/uploads/" . basename($filename);
                                                        $fileNew133w = cropImage($filename,
                                                            $_SERVER['DOCUMENT_ROOT'] . $fileNew150,
                                                            $width, $height);


                                                        $height = 234;
                                                        $width = 374;
                                                        $fileNew374w = "/wp-content/uploads/" . basename($filename);
                                                        $fileNew374w = cropImage($filename,
                                                            $_SERVER['DOCUMENT_ROOT'] . $fileNew300,
                                                            $width, $height);



                                                    $arPostTags = wp_get_post_tags($post->ID);
                                                        unset($arCurrentPostTagsNames);
                                                        foreach ($arPostTags as $tag){
                                                            $arCurrentPostTagsNames[] = $tag->name;
                                                        }
                                                        ?>



                                                    <div
                                                        class="post-8172 post type-post status-publish format-standard has-post-thumbnail hentry category-onepage-fashion">
                                                        <div class="blog-post">
                                                            <div class="blog-image"><a
                                                                    href="/detail/<?php echo basename(__FILE__); ?>?ID=<?php echo $post->ID; ?>"><img
                                                                        width="900" height="564"
                                                                        src="<?php echo $fileNew; ?>"
                                                                        class="attachment-full size-full wp-post-image"
                                                                        alt="" title=""
                                                                        srcset="<?php echo $fileNew; ?> 900w,
                                                                        <?php echo $fileNew300w; ?> 300w,
                                                                        <?php echo $fileNew768w; ?> 768w,
                                                                        <?php echo $fileNew133w; ?> 133w,
                                                                        <?php echo $fileNew374w; ?> 374w"
                                                                        sizes="(max-width: 900px) 100vw, 900px"/></a>
                                                            </div>
                                                            <div class="post-details"><a
                                                                    href="/detail/<?php echo basename(__FILE__); ?>?ID=<?php echo $post->ID; ?>"
                                                                    class="post-title sm-margin-top-ten xs-no-margin-top entry-title">
                                                                    <?php echo $post->post_title; ?>
                                                                </a><span
                                                                    class="post-author light-gray-text2 author vcard published">
                                                                    <?php echo implode(" | ", $arCurrentPostTagsNames); ?>
                                                                </span>
                                                                <div class="entry-content"><p>
                                                                        <?php
                                                                        $post_content = preg_replace("/\\[.+\\]/m","",
                                                                            $post->post_content);
                                                                        //$post_content = str_replace("\n","<br>",
                                                                        //    $post_content);

                                                                        echo kama_excerpt( array('text'=>$post_content,
                                                                            'maxchar'=>500,
                                                                            'autop' => false) );

                                                                        ?>
                                                                    </p></div>
                                                            </div>
                                                        </div>
                                                    </div>

                                                        <?php

                                                        $i++;
                                                    }
                                                    ?>





                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="feature_nav"><a class="prev left carousel-control"><img alt=""
                                                                                                        src="http://wpdemos.themezaa.com/h-code/wp-content/themes/h-code/assets/images/arrow-pre.png"
                                                                                                        width="96"
                                                                                                        height="96"></a><a
                                            class="next right carousel-control"><img alt=""
                                                                                     src="http://wpdemos.themezaa.com/h-code/wp-content/themes/h-code/assets/images/arrow-next.png"
                                                                                     width="96" height="96"></a></div>
                                    <script type="text/javascript">/*<![CDATA[*/
                                        jQuery(document).ready(function () {
                                            jQuery("#blog-post-slider-1449837297").owlCarousel({
                                                pagination: false,
                                                items: 3,
                                                itemsDesktop: [1200, 3],
                                                itemsTablet: [991, 2],
                                                itemsMobile: [700, 1],
                                                navigationText: ["<i class='fa fa-angle-left'></i>", "<i class='fa fa-angle-right'></i>"]
                                            });
                                        });
                                        /*]]>*/</script>
                                </div>
                            </div>
                            <div class="wpb_column hcode-column-container  col-xs-mobile-fullwidth">
                                <div class="vc-column-innner-wrapper">
                                    <div class="hcode-space margin-four-bottom"></div>
                                </div>
                            </div>
                            <div
                                class="wpb_column hcode-column-container  col-md-12 col-xs-mobile-fullwidth col-sm-12 text-center">
                                <div class="vc-column-innner-wrapper"><a
                                        href="/projects/" target="_self"
                                        class="inner-link highlight-button-dark btn-small  wow fadeInUp button btn">
                                        Все проекты
                                    </a></div>
                            </div>
                        </div>
                    </div>
                </section>



                <section class=" " style=" background-color:#000000; ">
                    <div class="container">
                        <div class="row">
                            <div
                                class="wpb_column hcode-column-container  col-md-12 col-xs-mobile-fullwidth text-center">
                                <div class="vc-column-innner-wrapper"><h3
                                        class="section-title  white-text no-padding-bottom">
                                        Другие проекты
                                    </h3></div>
                            </div>
                            <div
                                class="wpb_column hcode-column-container  col-md-6 col-xs-mobile-fullwidth col-sm-10 text-center center-col">
                                <div class="vc-column-innner-wrapper">
                                    <div class="testimonial-slider position-relative no-transition">
                                        <div id="hcode-testimonial"
                                             class="owl-pagination-bottom position-relative  round-pagination light-pagination white-cursor">

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
                                            $new_filen = $_SERVER["DOCUMENT_ROOT"] . '/wp-content/uploads/' . basename($filename);

                                            $height = 300;
                                            $width = 300;

                                            $fileNew = "/wp-content/uploads/" . basename($filename);


                                            $fileNew = cropImage($filename,
                                                $_SERVER['DOCUMENT_ROOT'] . $fileNew,
                                                $width, $height);


                                            $arPostTags = wp_get_post_tags($post->ID);
                                            ?>

                                            <div
                                                class="col-md-12 col-sm-12 col-xs-12 testimonial-style2 center-col text-center margin-three no-margin-top">
                                                <p>
                                                    <?php
                                                    $post_content = preg_replace("/\\[.+\\]/m","",
                                                        $post->post_content);
                                                    //$post_content = str_replace("\n","<br>",
                                                    //    $post_content);

                                                    echo kama_excerpt( array('text'=>$post_content, 'maxchar'=>1500,
                                                        'autop' => false) );

                                                    ?>
                                                </p> <span class="name light-gray-text2"
                                                                                      style="color:#737373">
                                                    <?php echo $post->post_title; ?></span>
                                            </div>

                                                <?php
                                            }
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


                <?php
                include $_SERVER['DOCUMENT_ROOT'] . '/includes/detail_contact-us.php';
                ?>


                <section class="  parallax-fix parallax10 js-background"
                         data-image="<?php displayRandomElement($currentBackgroundImage); ?>"
                         style=" background-image: url(); ">
                    <div class="selection-overlay" style=" opacity:0.8; background-color:#000000;"></div>
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

                            $diffDateRemote =  current_time('timestamp') - strtotime("01-12-2012");
                            $humanYearsRemote = floor($diffDateRemote / 31536000);

                            include $_SERVER['DOCUMENT_ROOT'] . '/includes/GitHub.php';

                            ?>


                            <div
                                class="wpb_column hcode-column-container  col-md-3
                                col-xs-mobile-fullwidth col-sm-6 text-center sm-margin-ten-bottom">
                                <div class="vc-column-innner-wrapper">
                                    <div class="counter-section"><i class="icon-heart medium-icon"
                                                                    style="color: #c2345f"></i><span id="counter_5"

                                                                                                     data-to="<?php echo $countPosts;?>"
                                                                                                     class="counter-number white-text">
                                            <?php echo $countPosts;?>
                                        </span><span
                                            class="counter-title" style="color: #ababab">
                                            <?php
                                            echo numberof($countPosts, '',
                                                array('Проект', 'Проекта', 'Проектов'));
                                            ?>
                                        </span></div>
                                </div>
                            </div>
                            <div
                                class="wpb_column hcode-column-container  col-md-3 col-xs-mobile-fullwidth col-sm-6
                                text-center sm-margin-ten-bottom">
                                <div class="vc-column-innner-wrapper">
                                    <div class="counter-section"><i class="icon-happy medium-icon"
                                                                    style="color: #c2345f"></i><span id="counter_6"
                                                                                                     data-to="<?php echo $countSertificates;?>"
                                                                                                     class="counter-number white-text">
                                            <?php echo $countSertificates;?>
                                        </span><span
                                            class="counter-title" style="color: #ababab">
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
                                    <div class="counter-section"><i class="icon-anchor medium-icon"
                                                                    style="color: #c2345f"></i><span id="counter_7"
                                                                                                     data-to="<?php echo $countFilesInRepo; ?>"
                                                                                                     class="counter-number white-text">
                                            <?php echo $countFilesInRepo; ?>
                                        </span><span
                                            class="counter-title" style="color: #ababab">Файлов с кодом в репозитории</span></div>
                                </div>
                            </div>
                            <div
                                class="wpb_column hcode-column-container  col-md-3 col-xs-mobile-fullwidth col-sm-6 text-center">
                                <div class="vc-column-innner-wrapper">
                                    <div class="counter-section"><i class="icon-chat medium-icon"
                                                                    style="color: #c2345f"></i><span id="counter_8"
                                                                                                     data-to="<?php echo $humanYearsRemote; ?>"
                                                                                                     class="counter-number white-text">
                                            <?php echo $humanYearsRemote; ?>
                                        </span><span
                                            class="counter-title" style="color: #ababab">
                                            <?php
                                            echo numberof($humanYearsRemote, '', array('год', 'года', 'лет'));
                                            ?> опыта работы
                                        </span></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>



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


</body>
</html>