<?php
/**
 * Created by PhpStorm.
 * User: GSU
 * Date: 23.07.2017
 * Time: 23:34
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
<body class="page-template-default page page-id-31 wpb-js-composer js-comp-ver-5.1 vc_responsive">
<nav
    class="navbar navbar-default navbar-fixed-top nav-transparent overlay-nav sticky-nav transparent-header nav-border-bottom  nav-black "
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
<section class="parent-section no-padding post-31 page type-page status-publish hentry">
    <div class="container-fluid">
        <div class="row">
            <div class="entry-content">
                <section class="  no-padding">
                    <div class="container-fluid">
                        <div class="row">
                            <div class="wpb_column hcode-column-container  col-xs-mobile-fullwidth">
                                <div class="vc-column-innner-wrapper">
                                    <div id="bootstrap-slider-full-screen"
                                         class="carousel no-padding slide carousel-slide round-pagination light-pagination dark-navigation cursor-black bootstrap-slider-full-screen hcode-bootstrap-slider1 ">
                                        <ol class="carousel-indicators">

                                            <?php
                                            $i = 0;
                                            foreach($arProjectAllImages as $projectImage){
                                                ?>
                                            <li data-target="#bootstrap-slider-full-screen"
                                                data-slide-to="<?php echo $i; ?>"></li>
                                            <?
                                                $i++;
                                            }
                                            ?>

                                        </ol>
                                        <div class="carousel-inner">



                                            <?php
                                            $i = 0;
                                            foreach($arProjectAllImages as $projectImage){
                                            ?>

                                            <div class="item full-screen">
                                                <div class="fill js-background"
                                                     style="background-image:url()"
                                                data-image="<?php echo $projectImage; ?>"></div>
                                                <div class="opacity-full bg-white display-none xs-display-block"></div>
                                                <div class="container">
                                                    <div class="row">
                                                        <div class="container full-screen position-relative">
                                                            <div class="slider-typography">
                                                                <div class="slider-text-middle-main">
                                                                    <div
                                                                        class="slider-text-middle slider-text-middle6 padding-left-right-px wow
                                                                        fadeInUp slider-text">
                                                                        <div
                                                                            class="col-md-3 col-sm-5 col-xs-6 text-left animated fadeInUp no-padding">
                                                                            <h1 class="alt-font">
                                                                                <?php postTagName($arPostTagsNames , $i); ?>
                                                                            </h1>
                                                                            <div
                                                                                class="separator-line bg-yellow no-margin-lr"></div>
                                                                            <p>
                                                                                <span class="no-margin">
                                                                                    <?php displayElement($currentDetailTitle , $i); ?>
                                                                                </span>
                                                                            </p>


                                                                            <?php if($projectURL){ ?>
                                                                            <a
                                                                                class="highlight-button btn inner-link no-margin-lr no-margin-bottom"
                                                                                href="<?php echo $projectURL;?>
                                                                                target="_self">Перейти на сайт</a>
                                                                            <?php } ?>

                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                                <?
                                                $i++;
                                            }
                                            ?>





                                        </div>
                                        <a class="left carousel-control" href="#bootstrap-slider-full-screen"
                                           data-slide="prev"><img
                                                src="http://wpdemos.themezaa.com/h-code/wp-content/themes/h-code/assets/images/arrow-pre.png"
                                                alt=""/></a><a class="right carousel-control"
                                                               href="#bootstrap-slider-full-screen"
                                                               data-slide="next"><img
                                                src="http://wpdemos.themezaa.com/h-code/wp-content/themes/h-code/assets/images/arrow-next.png"
                                                alt=""/></a></div>
                                    <script type="text/javascript">jQuery(document).ready(function () {
                                            jQuery("#bootstrap-slider-full-screen").carousel({
                                                interval: false,
                                                pause: false,
                                            });
                                        });</script>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
                <section class="  wow fadeIn no-padding-bottom">
                    <div class="container">
                        <div class="row">
                            <div
                                class="wpb_column hcode-column-container  col-md-6 col-xs-mobile-fullwidth col-sm-10 text-center center-col">
                                <div class="vc-column-innner-wrapper"><span
                                        class="margin-five no-margin-top display-block
                                        letter-spacing-2">
                                        <?php echo get_post_meta($arProject["ID"], 'YEAR')[0]; ?></span>
                                    <h1><?php echo $arProject["post_title"];?></h1>
                                    <p class="text-med width-90 center-col margin-seven no-margin-bottom">
                                        <?php echo $arProject["post_content_formatted"]; ?></p></div>
                            </div>
                        </div>
                    </div>
                </section>
                <section class="  wow fadeIn no-padding">
                    <div class="container-fluid">
                        <div class="row">
                            <div
                                class="wpb_column hcode-column-container  col-md-12 col-xs-12 text-center padding-three-tb margin-five-top"
                                style=" background:#fdd947;">
                                <div class="vc-column-innner-wrapper">
                                    <div class="text-small text-uppercase font-weight-600 black-text letter-spacing-2">
                                        <?php echo implode(" / ", $arPostTagsNames); ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
                <section id="features" class=" features wow fadeIn">
                    <div class="container">
                        <div class="row">
                            <div class="wpb_column hcode-column-container  col-xs-mobile-fullwidth text-center">
                                <div class="vc-column-innner-wrapper"><h3 class="section-title  black-text">
                                        Другие проекты</h3></div>
                            </div>

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

                                ?>


                                <div
                                        class="wpb_column hcode-column-container  col-md-4 col-xs-mobile-fullwidth col-sm-6 margin-bottom-80px xs-margin-six-bottom wow fadeInUp">
                                    <div class="vc-column-innner-wrapper">
                                        <div class="col-md-12 no-padding">
                                            <div class="col-md-3 col-sm-2 col-xs-2 no-padding"><i
                                                        class="icon-desktop medium-icon"></i></div>
                                            <div class="col-md-9 col-sm-9 col-xs-9 no-padding text-left f-right">
                                                <h5
                                                        style="height:50px;"><?php echo $post->post_title; ?></h5>
                                                <div class="separator-line bg-yellow no-margin-lr"></div>
                                                <p class="text" style="display: block; height: 100px;">
                                                    <?php
                                                    $post_content = preg_replace("/\\[.+\\]/m","",
                                                        $post->post_content);
                                                    //$post_content = str_replace("\n","<br>",
                                                    //    $post_content);

                                                    echo kama_excerpt( array('text'=>$post_content, 'maxchar'=>500,
                                                        'autop' => false) );

                                                    ?>
                                                </p>
                                            </div>
                                        </div>
                                    </div>
                                </div>


                                <?php
                                if ($i == 5) {
                                    break;
                                }
                                $i++;
                            }
                            ?>


                        </div>
                    </div>
                </section>
                <section class="  fix-background"
                         style=" background-image: url(http://wpdemos.themezaa.com/h-code/wp-content/uploads/2015/08/slider-img45.jpg); ">
                    <div class="selection-overlay" style=" opacity:0.8; background-color:#252525;"></div>
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
                                class="wpb_column hcode-column-container  counter-section col-md-3 col-xs-mobile-fullwidth col-sm-6 text-center sm-margin-ten-bottom wow fadeInUp"
                                data-wow-duration=300ms>
                                <div class="vc-column-innner-wrapper">
                                    <div class="counter-section"><i class="icon-heart medium-icon"></i><span
                                            id="counter_1" data-to="<?php echo $countPosts;?>"
                                            class="counter-number white-text"><?php echo $countPosts;?></span>
                                        <span class="counter-title"
                                                                                              style="color: #ababab">
                                            <?php
                                            echo numberof($countPosts, '',
                                                array('Проект', 'Проекта', 'Проектов'));
                                            ?></span>
                                    </div>
                                </div>
                            </div>
                            <div
                                class="wpb_column hcode-column-container  counter-section col-md-3 col-xs-mobile-fullwidth col-sm-6 text-center sm-margin-ten-bottom wow fadeInUp"
                                data-wow-duration=600ms>
                                <div class="vc-column-innner-wrapper">
                                    <div class="counter-section"><i class="icon-happy medium-icon"></i><span
                                            id="counter_2" data-to="<?php echo $countSertificates;?>"
                                            class="counter-number white-text"><?php echo $countSertificates;?></span>
                                        <span class="counter-title"
                                                                                              style="color: #ababab">
                                            <?php
                                            echo numberof($countPosts, '',
                                                array('Сертификат', 'Сертификата', 'Сертификатов'));
                                            ?>
                                        </span>
                                    </div>
                                </div>
                            </div>
                            <div
                                class="wpb_column hcode-column-container  counter-section col-md-3 col-xs-mobile-fullwidth col-sm-6 text-center xs-margin-ten-bottom wow fadeInUp"
                                data-wow-duration=900ms>
                                <div class="vc-column-innner-wrapper">
                                    <div class="counter-section"><i class="icon-anchor medium-icon"></i><span
                                            id="counter_3" data-to="<?php echo $countFilesInRepo; ?>"
                                            class="counter-number white-text"><?php echo $countFilesInRepo; ?></span>
                                        <span class="counter-title"
                                                                                              style="color: #ababab">
                                            Файлов с кодом в репозитории
                                        </span>
                                    </div>
                                </div>
                            </div>
                            <div
                                class="wpb_column hcode-column-container  col-md-3 col-xs-mobile-fullwidth col-sm-6 text-center wow fadeInUp"
                                data-wow-duration=1200ms>
                                <div class="vc-column-innner-wrapper">
                                    <div class="counter-section"><i class="icon-chat medium-icon"></i><span
                                            id="counter_4" data-to="<?php echo $humanYearsRemote; ?>"
                                            class="counter-number white-text"><?php echo $humanYearsRemote; ?></span><span class="counter-title"
                                                                                              style="color: #ababab">
                                            <?php
                                            echo numberof($humanYearsRemote, '', array('год', 'года', 'лет'));
                                            ?> опыта работы
                                        </span>
                                    </div>
                                </div>
                            </div>




                        </div>
                    </div>
                </section>
                <section id="portfolio" class="  no-padding-bottom">
                    <div class="container-fluid">
                        <div class="row">
                            <div class="wpb_column hcode-column-container  col-xs-mobile-fullwidth text-center">
                                <div class="vc-column-innner-wrapper"><h3 class="section-title  black-text no-padding">
                                        Последние проекты</h3></div>
                            </div>
                            <div
                                class="wpb_column hcode-column-container  col-lg-3 col-md-5 col-xs-mobile-fullwidth col-sm-10 text-center center-col margin-three">
                                <div class="vc-column-innner-wrapper">
                                    <h4 class="gray-text"><?php echo $currentDetailTitle[0]; ?></h4></div>
                            </div>
                            <div class="wpb_column hcode-column-container  col-xs-mobile-fullwidth">
                                <div class="vc-column-innner-wrapper">
                                    <div class="col-md-12 text-center">
                                        <div class="text-center">
                                            <ul class="portfolio-filter nav nav-tabs nav-tabs-black wow fadeInUp"
                                                style="height:auto; padding-bottom:20px;">
                                                <?php
                                                include $_SERVER['DOCUMENT_ROOT'] . '/includes/portfolio_filter.php';
                                                ?>
                                            </ul>
                                        </div>
                                    </div>
                                    <div class="work-4col masonry wide ">
                                        <div class="col-md-12  grid-gallery overflow-hidden no-padding content-section">
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
                <section class="  wow fadeIn">
                    <div class="container">
                        <div class="row">
                            <div
                                class="wpb_column hcode-column-container  col-md-3 col-xs-12 col-sm-6 text-center sm-margin-eight-bottom">
                                <div class="vc-column-innner-wrapper">
                                    <div class="work-process-sub position-relative overflow-hidden">
                                        <div class="work-process-text"><span
                                                class="work-process-number font-weight-100 display-block yellow-text2">01</span><span
                                                class="text-uppercase letter-spacing-2 font-weight-600 "
                                                style="color:#000000;">Идея</span>
                                            <div class="separator-line-thick bg-mid-gray margin-three"></div>
                                        </div>
                                        <div class="work-process-details position-absolute display-block"><i
                                                class="icon-laptop medium-icon display-block"
                                                style="color:#f7d23d;"></i><span class="text-small text-uppercase"></span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div
                                class="wpb_column hcode-column-container  col-md-3 col-xs-12 col-sm-6 text-center sm-margin-eight-bottom">
                                <div class="vc-column-innner-wrapper">
                                    <div class="work-process-sub position-relative overflow-hidden">
                                        <div class="work-process-text"><span
                                                class="work-process-number font-weight-100 display-block yellow-text2">02</span><span
                                                class="text-uppercase letter-spacing-2 font-weight-600 "
                                                style="color:#000000;">Планирование</span>
                                            <div class="separator-line-thick bg-mid-gray margin-three"></div>
                                        </div>
                                        <div class="work-process-details position-absolute display-block"><i
                                                class="icon-toolbox medium-icon display-block"
                                                style="color:#f7d23d;"></i><span class="text-small text-uppercase"></span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div
                                class="wpb_column hcode-column-container  col-md-3 col-xs-12 col-sm-6 text-center xs-margin-eight-bottom">
                                <div class="vc-column-innner-wrapper">
                                    <div class="work-process-sub position-relative overflow-hidden">
                                        <div class="work-process-text"><span
                                                class="work-process-number font-weight-100 display-block yellow-text2">03</span><span
                                                class="text-uppercase letter-spacing-2 font-weight-600 "
                                                style="color:#000000;">Разработка</span>
                                            <div class="separator-line-thick bg-mid-gray margin-three"></div>
                                        </div>
                                        <div class="work-process-details position-absolute display-block"><i
                                                class="icon-desktop medium-icon display-block"
                                                style="color:#f7d23d;"></i><span class="text-small text-uppercase"></span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div
                                class="wpb_column hcode-column-container  col-md-3 col-xs-12 col-sm-6 text-center wow fadeIn">
                                <div class="vc-column-innner-wrapper">
                                    <div class="work-process-sub position-relative overflow-hidden">
                                        <div class="work-process-text"><span
                                                class="work-process-number font-weight-100 display-block yellow-text2">04</span><span
                                                class="text-uppercase letter-spacing-2 font-weight-600 "
                                                style="color:#000000;">Запуск</span>
                                            <div class="separator-line-thick bg-mid-gray margin-three"></div>
                                        </div>
                                        <div class="work-process-details position-absolute display-block"><i
                                                class="icon-hotairballoon medium-icon display-block"
                                                style="color:#f7d23d;"></i><span class="text-small text-uppercase"></span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
                <section class="  wow fadeInUp padding-three-tb" style=" background-color:#fdd947; ">
                    <div class="container">
                        <div class="row">
                            <div
                                class="wpb_column hcode-column-container  col-md-1 col-xs-mobile-fullwidth sm-text-center">
                                <div class="vc-column-innner-wrapper"><p class="no-margin"><i
                                            class="medium-icon black-text no-margin icon-toolbox"><span
                                                class="display-none">bag</span></i></p></div>
                            </div>
                            <div
                                class="wpb_column hcode-column-container  col-md-5 col-xs-mobile-fullwidth sm-text-center no-padding">
                                <div class="vc-column-innner-wrapper">
                                    <div
                                        class="text-med text-uppercase letter-spacing-2 margin-two black-text font-weight-600 xs-margin-top-six xs-margin-bottom-six display-block">
                                        Хотите посмотреть другие проекты ?
                                    </div>
                                </div>
                            </div>
                            <div
                                class="wpb_column hcode-column-container  col-md-6 col-xs-mobile-fullwidth
                                sm-text-center no-padding">
                                <div class="vc-column-innner-wrapper"><a
                                        href="/projects/"
                                        target="_self"
                                        class="inner-link highlight-button-dark btn-medium  margin-lr-10px xs-margin-five-bottom button btn">
                                        Посмотреть портфолио</a><a href="/feedback/simple/" target="_self"
                                                             class="inner-link highlight-button btn-medium  margin-lr-10px
                                                             button btn">Обратная связь</a></div>
                            </div>
                        </div>
                    </div>
                </section>
                <section class="  no-padding-bottom">
                    <div class="container-fluid">
                        <div class="row">
                            <div class="wpb_column hcode-column-container  col-xs-mobile-fullwidth text-center">
                                <div class="vc-column-innner-wrapper"><h3
                                        class="section-title  black-text no-padding-bottom">Мои услуги</h3></div>
                            </div>
                            <div
                                class="wpb_column hcode-column-container  col-md-12 col-xs-mobile-fullwidth col-sm-12 text-center center-col no-padding margin-five">
                                <div class="vc-column-innner-wrapper">
                                    <div id="animated-tab2" class="hcode-animated-tabs animated-tab2">
                                        <ul class="nav nav-tabs margin-five no-margin-top">

                                            <?php

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

                                            $i = 0;
                                            foreach ($posts as $post) {
                                                setup_postdata($post);


                                                ?>

                                                <li class="nav <?php if($i == 0){ ?>active<?php } ?>">
                                                    <a href="#hcode-1500813643-2112791938-<?php echo $i; ?>"
                                                                          class="xs-min-height-inherit xs-no-padding"
                                                                          data-toggle="tab"><span><i
                                                                    class="icon-<?php echo $post->post_content;?>"></i></span></a><br><a
                                                            href="#hcode-1500813643-2112791938-<?php echo $i; ?>"
                                                            class="xs-min-height-inherit xs-no-padding body-text"
                                                            data-toggle="tab"><span
                                                                class="text-small text-uppercase letter-spacing-3 margin-bottom-5px margin-top-5px font-weight-600 xs-letter-spacing-none xs-display-none"><?php echo $post->post_title;?></span></a>
                                                </li>

                                                <?php
                                                $i++;
                                            }

                                            wp_reset_postdata();
                                            ?>





                                        </ul>



                                        <div class="tab-content">
                                            
<?php
                                            $i = 0;
                                            foreach ($posts as $post) {
                                                setup_postdata($post);

                                                ?>
                                                <div class="text-center center-col tab-pane fade in <?php if($i == 0){ ?>active<?php } ?>"
                                                     id="hcode-1500813643-2112791938-<?php echo $i; ?>">
                                                    <div
                                                            class="col-lg-6 col-md-6 no-padding corporate-standards-img position-relative cover-background js-background"
                                                            style="background-image:url();" data-image="<?php displayRandomElement($currentBackgroundImage); ?>"> 

                                                        <div class="opacity-medium bg-dark-gray"></div>
                                                        <p class="title-small text-uppercase corporate-standards-title white-text letter-spacing-7">
                                                        <span
                                                                class="title-extra-large no-letter-spacing yellow-text">0<?php echo $i + 1; ?></span><br><?php echo $post->post_title;?>
                                                        </p></div>
                                                    <div
                                                            class="col-lg-6 col-md-6 corporate-standards-text sm-margin-lr-four sm-margin-top-four xs-padding-tb-ten">
                                                        <div class="img-border-small-fix border-gray"></div>
                                                        <i class="icon-<?php echo $post->post_content;?> large-icon yellow-text"></i>
                                                        <h1 class="margin-ten no-margin-bottom"><?php echo $post->post_title;?></h1>
                                                        <p class="text-med margin-ten width-80 center-col xs-width-100"></p>
                                                        <p class="text-med margin-ten width-80 center-col xs-width-100">
                                                            </p>
                                                        <p></p><a
                                                                class="text-small highlight-link text-uppercase bg-black white-text"
                                                                href="/projects/"
                                                                target="_self">Посмотреть проекты <i
                                                                    class="fa fa-long-arrow-right extra-small-icon white-text"></i></a>
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
                        </div>
                    </div>
                </section>
                <section>
                    <div class="container">
                        <div class="row">
                            <div class="wpb_column hcode-column-container  col-xs-mobile-fullwidth text-center">
                                <div class="vc-column-innner-wrapper"><h3
                                        class="section-title  black-text no-padding-bottom">Прочие проекты</h3></div>
                            </div>
                            <div
                                class="wpb_column hcode-column-container  col-md-5 col-xs-mobile-fullwidth col-sm-10 text-center center-col margin-five">
                                <div class="vc-column-innner-wrapper"><h4 class="gray-text"></h4></div>
                            </div>


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

                                                            $arPostTags = wp_get_post_tags($post->ID);

                                                            unset($arCurrentPostTagsNames);
                                                            foreach ($arPostTags as $tag){
                                                                $arCurrentPostTagsNames[] = $tag->name;
                                                            }
                                                            ?>

<div
                                class="wpb_column hcode-column-container  col-md-4 col-xs-mobile-fullwidth
                                col-sm-4 text-center wow fadeInUp"
                                data-wow-duration=300ms>
                                <div class="vc-column-innner-wrapper">
                                    <div class="key-person ">
                                        <div class="key-person-img"><img alt=""
                                                                         data-image="<?php echo $thumb_url[0]; ?>"
                                                                         src="<?php //echo $thumb_url_medium[0]; ?>"
                                                                         width="500" height="730"
                                            class="js-img"></div>
                                        <div class="key-person-details bg-white">
                                            <span class="person-name black-text"><?php echo $post->post_title; ?></span><span
                                                class="person-post"><?php echo implode("  ", $arCurrentPostTagsNames); ?></span>
                                            <div class="separator-line bg-yellow"></div>
                                            <div class="person-social"></div>
                                            <p>
                                                <?php
                                                $post_content = preg_replace("/\\[.+\\]/m","",
                                                    $post->post_content);
                                                //$post_content = str_replace("\n","<br>",
                                                //    $post_content);

                                                echo kama_excerpt( array('text'=>$post_content, 'maxchar'=>300,
                                                    'autop' => false) );

                                                ?>
                                            </p>
                                        </div>
                                    </div>
                                </div>
                            </div>




                                                            <?php
if($i == 2) break;
                                                            $i++;

                                                        }
                                                        ?>



                                                        <?php

                                                        wp_reset_postdata(); // сброс
                                                        ?>




                            

                        </div>
                    </div>
                </section>
                <section class="  no-padding" style=" background-color:#f6f6f6; ">
                    <div class="container-fluid">
                        <div class="row">
                            <div class="wpb_column hcode-column-container  col-xs-mobile-fullwidth">
                                <div class="vc-column-innner-wrapper">
                                    <div id="hcode-owl-content-slider1"
                                         class="owl-carousel owl-theme  cursor-black round-pagination dark-pagination dark-navigation main-slider ">


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
                                        ?>
                                        <div class="item">
                                            <div class="col-lg-6 col-md-6 case-study-img cover-background js-background"
                                                 style="background-image:url();" data-image="<?php echo $thumb_url[0]; ?>"></div>
                                            <div class="col-lg-6 col-md-6 case-study-details">
                                                <div class="col-lg-3 col-md-3 col-sm-3 col-xs-12"><span
                                                        class="about-number alt-font black-text font-weight-400
                                                        letter-spacing-2 xs-no-border xs-no-padding-left
                                                        xs-display-none"><?php echo $i; ?></span>
                                                </div>
                                                <div
                                                    class="col-lg-8 col-md-9 col-sm-9 col-xs-12 about-text
                                                     position-relative xs-text-center">
                                                    <p class="title-small text-uppercase letter-spacing-3
                                                    black-text font-weight-600 no-margin-bottom">
                                                        <?php echo $post->post_title; ?></p><span
                                                        class="case-study-work letter-spacing-3">
                                                        <?php echo implode(" | ", $arCurrentPostTagsNames); ?>
                                                    </span>
                                                    <p class="width-90 xs-width-100"><?php
                                                        $post_content = preg_replace("/\\[.+\\]/m","",
                                                            $post->post_content);
                                                        //$post_content = str_replace("\n","<br>",
                                                        //    $post_content);

                                                        echo kama_excerpt( array('text'=>$post_content,
                                                            'maxchar'=>500,
                                                            'autop' => false) );

                                                        ?></p> <a
                                                        class="highlight-button-black-border btn btn-small no-margin-bottom sm-no-margin"
                                                        href="/detail/bootstrap-slider-full-screen.php?ID=<?php echo $post->ID; ?>"
                                                        target="_self">Посмотреть проект</a></div>
                                            </div>
                                        </div>
                                        <?php
                                        $i++;

                                        }
                                        ?>



                                        <?php

                                        wp_reset_postdata(); // сброс
                                        ?>



                                    </div>
                                    <script type="text/javascript">/*<![CDATA[*/
                                        jQuery(document).ready(function () {
                                            jQuery("#hcode-owl-content-slider1").owlCarousel({
                                                autoPlay: false,
                                                stopOnHover: false,
                                                addClassActive: false,
                                                navigation: false,
                                                pagination: true,
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
                <section style="border-bottom: 1px solid #e5e5e5;">
                    <div class="container">
                        <div class="row">

                            <?php
                            //$categoryId = PORTFOLIO_WP_CATEGORY_SKILLS_ID;

                            $args = array(
                                'numberposts' => 1000,
                                'category' => $arSkillsCategoriesIDs,
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

                            $postsSkills = get_posts($args);


                            $i = 0;
                            foreach ($postsSkills as $postSkill) {
                                setup_postdata($postSkill);

                                $description = get_post_meta($postSkill->ID, 'DESCRIPTION');
                                $image = get_post_meta($postSkill->ID, 'PREVIEW_IMAGE', true);

                                if(!in_array($postSkill->post_title, $arPostTagsNames)) continue;
                                if(!$image) continue;

                                ?>


                                <div
                                        class="wpb_column hcode-column-container  col-md-4
                                        col-xs-mobile-fullwidth col-sm-4 text-center xs-margin-ten-bottom
                                        wow zoomInUp">
                                    <div class="vc-column-innner-wrapper">
                                        <div class="testimonial-style2"><img
                                                    src="" class="js-img"
                                                    data-image="<?php echo $image; ?>"
                                                    alt="" width="300" height="300"/>
                                            <p class="center-col width-90"><?php echo $description[0]; ?></p>
                                            <span class="name light-gray-text2" style="color:#000000;">
                                                <?php echo $postSkill->post_title; ?>
                                            </span><i
                                                    class="fa fa-quote-left small-icon display-block
                                                    margin-five no-margin-bottom"
                                                    style="color:#e6af2a;"></i></div>
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
                <section id="blog">
                    <div class="container">
                        <div class="row">
                            <div class="wpb_column hcode-column-container  col-xs-mobile-fullwidth text-center">
                                <div class="vc-column-innner-wrapper"><h3 class="section-title  black-text">
                                        Проекты</h3></div>
                            </div>



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
                            ?>
                            <div
                                class="wpb_column hcode-column-container  col-md-4 col-xs-mobile-fullwidth col-sm-4 xs-margin-three-bottom wow fadeInUp"
                                data-wow-duration=300ms>
                                <div class="vc-column-innner-wrapper">
                                    <div
                                        class="post-2871 post type-post status-publish format-image has-post-thumbnail hentry category-feature post_format-post-format-image">
                                        <div class="blog-post">
                                            <div class="blog-image"><a
                                                    href="/detail/bootstrap-slider-full-screen.php?ID=<?php echo $post->ID; ?>">
                                                    <img
                                                        width="800" height="500"
                                                        src=""
                                                        data-image="<?php echo $thumb_url[0]; ?>"
                                                        class="attachment-full size-full wp-post-image js-img" alt="" title=""
                                                        srcset="<?php echo $thumb_url[0]; ?> 800w,
                                                        <?php echo $thumb_url[0]; ?> 300w,
                                                        <?php echo $thumb_url[0]; ?> 768w,
                                                        <?php echo $thumb_url[0]; ?> 133w,
                                                        <?php echo $thumb_url[0]; ?> 374w"
                                                        sizes="(max-width: 800px) 100vw, 800px"/></a></div>
                                            <div class="post-details"><a
                                                    href="/detail/bootstrap-slider-full-screen.php?ID=<?php echo $post->ID; ?>"
                                                    class="post-title sm-margin-top-ten xs-no-margin-top entry-title">
                                                    <?php echo $post->post_title; ?>
                                                </a><span
                                                    class="post-author light-gray-text2 author vcard">
                                                    <?php echo implode(" | ", $arCurrentPostTagsNames); ?>
                                                </span>
                                                <p class="entry-content">
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
                                        Посмотреть все проекты
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
                <section class="  wow fadeIn" style=" background-color:#000000; ">
                    <div class="container-fluid">
                        <div class="row">
                            <div class="wpb_column hcode-column-container  col-xs-mobile-fullwidth">
                                <div class="vc-column-innner-wrapper">
                                    <div class="feature-owl position-relative">
                                        <div class="container">
                                            <div class="row">
                                                <div id="approach-slider"
                                                     class="owl-carousel owl-theme bottom-pagination white-cursor round-pagination dark-navigation light-pagination">


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

                                                        $arPostTags = wp_get_post_tags($post->ID);
                                                        unset($arCurrentPostTagsNames);
                                                        foreach ($arPostTags as $tag){
                                                            $arCurrentPostTagsNames[] = $tag->name;
                                                        }
                                                    ?>

                                                    <div class="item margin-ten no-margin-top">
                                                        <div class="text-center margin-four wow fadeIn "><i
                                                                class="icon-laptop medium-icon no-margin-bottom
                                                                white-text"></i>
                                                            <h5 class="white-text margin-ten no-margin-bottom
                                                            xs-margin-top-five">
                                                                <?php echo $post->post_title; ?></h5><span
                                                                class="approach-details feature-owlslide-content
                                                                light-gray-text2">
                                                            <?php echo implode("  ", $arCurrentPostTagsNames);?>
                                                            </span>
                                                        </div>
                                                    </div>

                                                        <?php

                                                    }

                                                    wp_reset_postdata(); // сброс
                                                    ?>


                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <script type="text/javascript">jQuery(document).ready(function () {
                                            jQuery("#approach-slider").owlCarousel({
                                                pagination: true,
                                                autoPlay: false,
                                                stopOnHover: true,
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
                <section>
                    <div class="container">
                        <div class="row">
                            <div
                                class="wpb_column hcode-column-container  col-md-12 col-xs-mobile-fullwidth text-center">
                                <div class="vc-column-innner-wrapper"><h5
                                        class="section-title  margin-four-bottom black-text no-padding">
                                        Вы можете посмотреть другие проекты
                                    </h5><a
                                        href="/projects/" target="_self"
                                        class="inner-link highlight-button-black-border btn-large
                                        btn-extra-large wow fadeInUp button btn">
                                        Портфолио
                                    </a></div>
                            </div>
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