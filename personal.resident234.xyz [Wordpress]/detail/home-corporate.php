<?php
/**
 * Created by PhpStorm.
 * User: GSU
 * Date: 29.07.2017
 * Time: 15:11
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
<body class="page-template-default page page-id-11 wpb-js-composer js-comp-ver-5.1 vc_responsive">
<nav
    class="navbar navbar-default navbar-fixed-top nav-transparent overlay-nav sticky-nav transparent-header nav-border-bottom  nav-white "
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
<section class="parent-section no-padding post-11 page type-page status-publish hentry">
    <div class="container-fluid">
        <div class="row">
            <div class="entry-content">
                <section class="  no-padding">
                    <div class="container-fluid">
                        <div class="row">
                            <div class="wpb_column hcode-column-container  col-xs-mobile-fullwidth">
                                <div class="vc-column-innner-wrapper">
                                    <div id="home-corporate"
                                         class="owl-carousel owl-theme owl-half-slider  square-pagination light-pagination dark-navigation white-cursor corporate-slider home-corporate hcode-owl-slider5 ">
                                        <div class="item owl-bg-img js-background"
                                             data-image="<?php displayRandomElement($currentBackgroundImage);?>"
                                             style="background-image:url();">
                                            <div class="opacity-medium bg-dark-gray"></div>
                                            <div class="container position-relative">
                                                <div class="slider-typography text-center">
                                                    <div class="slider-text-middle-main">
                                                        <div
                                                            class="slider-text-middle padding-left-right-px wow fadeIn">
                                                            <p class="text-small font-weight-600 text-uppercase white-text letter-spacing-7 margin-three no-margin-top bg-deep-red highlight-link-text xs-line-height-18">
                                                                <?php echo get_post_meta($arProject["ID"], 'YEAR')[0]; ?></p>
                                                            <h1 class="white-text font-weight-100 letter-spacing-2">
                                                                <?php echo $arProject["post_title"];?></h1></div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="item owl-bg-img js-background"
                                             data-image="<?php displayRandomElement($currentBackgroundImage);?>"
                                             style="background-image:url()">
                                            <div class="opacity-medium bg-dark-gray"></div>
                                            <div class="container position-relative">
                                                <div class="slider-typography text-center">
                                                    <div class="slider-text-middle-main">
                                                        <div
                                                            class="slider-text-middle padding-left-right-px wow fadeIn">
                                                            <p class="text-small font-weight-600 text-uppercase white-text letter-spacing-7 margin-three no-margin-top bg-deep-red highlight-link-text xs-line-height-18">
                                                                <?php echo get_post_meta($arProject["ID"], 'YEAR')[0]; ?></p>
                                                            <h1 class="white-text font-weight-100 letter-spacing-2">
                                                                <?php displayRandomElement($arPostTagsNames);?>
                                                            </h1></div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="item owl-bg-img js-background"
                                             data-image="<?php displayRandomElement($currentBackgroundImage);?>"
                                             style="background-image:url()">
                                            <div class="opacity-medium bg-dark-gray"></div>
                                            <div class="container position-relative">
                                                <div class="slider-typography text-center">
                                                    <div class="slider-text-middle-main">
                                                        <div
                                                            class="slider-text-middle padding-left-right-px wow fadeIn">
                                                            <p class="text-small font-weight-600 text-uppercase white-text letter-spacing-7 margin-three no-margin-top bg-deep-red highlight-link-text xs-line-height-18">
                                                                <?php echo get_post_meta($arProject["ID"], 'YEAR')[0]; ?></p>
                                                            <h1 class="white-text font-weight-100 letter-spacing-2">
                                                                <?php displayRandomElement($arPostTagsNames);?></h1>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <script type="text/javascript">/*<![CDATA[*/
                                        jQuery(document).ready(function () {
                                            jQuery("#home-corporate").owlCarousel({
                                                navigation: false,
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
                                class="wpb_column hcode-column-container  col-md-3 col-xs-mobile-fullwidth col-sm-6
                                xs-text-center sm-margin-ten-bottom">
                                <div class="vc-column-innner-wrapper"><span
                                        class="title-small text-uppercase font-weight-700 letter-spacing-1
                                        margin-seven-top margin-five-bottom display-block"
                                        style="color:#000000 !important"><?php echo $post->post_title; ?></span>
                                    <p class="margin-ten no-margin-top width-90 xs-center-col xs-display-block">
                                        <?php
                                        $post_content = preg_replace("/\\[.+\\]/m","",
                                            $post->post_content);
                                        //$post_content = str_replace("\n","<br>",
                                        //    $post_content);

                                        echo kama_excerpt( array('text'=>$post_content, 'maxchar'=>500,
                                            'autop' => false) );

                                        ?>
                                    </p>
                                    <a href="/detail/<?php echo basename(__FILE__); ?>?ID=<?php echo $post->ID; ?>"
                                                                  class="highlight-link text-uppercase white-text"
                                                                  target="_self">Детали <i
                                            class="fa fa-long-arrow-right extra-small-icon white-text"></i></a></div>
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
                <section class="  no-padding-bottom" style="border-top: 1px solid #e5e5e5;">
                    <div class="container-fluid">
                        <div class="row">
                            <div
                                class="wpb_column hcode-column-container  col-md-12 col-xs-mobile-fullwidth text-center">
                                <div class="vc-column-innner-wrapper"><p
                                        class="sub-title deep-red-text letter-spacing-4 no-margin-top xs-letter-spacing-2">
                                        <?php displayRandomElement($currentDetailTitle);?></p>
                                    <h3 class="section-title  black-text no-padding-bottom"
                                        style="font-size:28px !important;font-weight:700 !important;;line-height:32px !important;">
                                        Мои услуги</h3></div>
                            </div>
                            <div
                                class="wpb_column hcode-column-container  col-md-12 col-xs-mobile-fullwidth
                                text-center no-padding margin-five-top sm-margin-ten-top xs-margin-ten-top">
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




                                <div
                                        class="wpb_column hcode-column-container  col-md-3 col-xs-mobile-fullwidth
                                        col-sm-6 text-center sm-margin-ten-bottom">
                                    <div class="vc-column-innner-wrapper">
                                        <div class="features-box-style1">
                                            <i class="icon-laptop medium-icon"
                                                                            style="color:#e75e50;"></i>
                                            <h5 class=""

                                                style="color:#000000;">
                                                <?php echo $post->post_title; ?></h5>
                                            <div class="no-margin">
                                                <p
                                                        class="width-90 center-col margin-three no-margin-bottom
                                                        display-block">
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
                                            </div>
                                        </div>
                                    </div>
                                </div>


                                <?php
                                if($i == 4) break;
                                $i++;
                            }

                            wp_reset_postdata(); // сброс
                            ?>





                        </div>
                    </div>
                </section>
                <section class="  fix-background js-background"
                         data-image="<?php displayRandomElement($currentBackgroundImage) ?>"
                         style="background-image:url()">
                    <div class="selection-overlay" style=" opacity:0.8; background-color:#ffffff;"></div>
                    <div class="container">
                        <div class="row">
                            <div
                                    class="wpb_column hcode-column-container  col-md-4 col-xs-mobile-fullwidth col-sm-12
                                sm-text-center sm-margin-ten-bottom">
                                <div class="vc-column-innner-wrapper"><h3
                                            class="title-med no-padding-bottom letter-spacing-2">
                                        <?php displayRandomElement($currentDetailTitle); ?>
                                    </h3>
                                    <p class="text-med margin-five">
                                        <?php displayRandomElement($currentDetailDescription); ?>
                                    </p> <a
                                            class="highlight-button-dark btn btn-small button" href="/projects/best/"
                                            target="_self">
                                        Лучшие проекты
                                    </a></div>
                            </div>



                            <?php

                            $randomProjectTagName = $arPostTagsNames[wp_rand(0, count($arPostTagsNames) - 1)];
                            ?>

                            <div
                                    class="wpb_column hcode-column-container  col-md-offset-2 col-md-2 col-xs-mobile-fullwidth col-sm-4 text-center margin-three xs-margin-ten-bottom">
                                <div class="vc-column-innner-wrapper"><i
                                            class="icon-desktop medium-icon display-block" style="color:#000000;"></i>
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
                                    class="wpb_column hcode-column-container  col-md-2 col-xs-mobile-fullwidth col-sm-4 text-center margin-three xs-margin-ten-bottom">
                                <div class="vc-column-innner-wrapper"><i class="icon-desktop medium-icon display-block"
                                                                         style="color:#000000;"></i>
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
                                    class="wpb_column hcode-column-container  col-md-2 col-xs-mobile-fullwidth col-sm-4 text-center margin-three">
                                <div class="vc-column-innner-wrapper"><i class="icon-desktop medium-icon display-block"
                                                                         style="color:#000000;"></i>
                                    <h1 class="font-weight-600 margin-five no-margin-bottom">
                                        <?php echo $arAllTags[$randomProjectTagName]; ?>
                                    </h1>
                                    <p class="text-uppercase letter-spacing-2 text-small margin-three"
                                       style="color:#000000;"><?php echo $randomProjectTagName; ?></p></div>
                            </div>
                        </div>
                    </div>
                </section>
                <section>
                    <div class="container-fluid">
                        <div class="row">
                            <div
                                class="wpb_column hcode-column-container  col-md-12 col-xs-mobile-fullwidth text-center">
                                <div class="vc-column-innner-wrapper"><p
                                        class="sub-title deep-red-text letter-spacing-4 no-margin-top xs-letter-spacing-2">
                                        <?php displayRandomElement($currentDetailTitle);?></p>
                                    <h3 class="section-title  black-text no-padding-bottom"
                                        style="font-size:28px !important;font-weight:700 !important;;line-height:32px !important;">
                                         Последние проекты</h3></div>
                            </div>
                            <div
                                class="wpb_column hcode-column-container  col-md-12 col-xs-mobile-fullwidth text-center no-padding margin-five-top sm-margin-ten-top xs-margin-ten-top">
                                <div class="vc-column-innner-wrapper">
                                    <div class="work-4col gutter work-with-title ">
                                        <div
                                            class="col-md-12  no-padding grid-gallery overflow-hidden  content-section">
                                            <div class="tab-content">
                                                <ul class="grid masonry-items ">



                                                    <?php
                                                    include $_SERVER['DOCUMENT_ROOT'] . '/includes/portfolio_grid_gallery_new_first.php';
                                                    ?>


                                                    <?php
                                                    $i = 0;
                                                    foreach ($arNewProjects as $post) {

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


                                                    <li class="portfolio-filter-57 portfolio-filter-55 ">
                                                        <figure>
                                                            <div class="gallery-img">
                                                                <a
                                                                    href="/detail/<?php echo basename(__FILE__); ?>?ID=<?php echo $post->ID; ?>"
                                                                    class="" target="">
                                                                    <img alt=""
                                                                         data-image="<?php echo $thumb_url[0]; ?>"
                                                                                            src="<?php echo $thumb_url_medium[0]; ?>"
                                                                                            width="800"
                                                                                            height="500"
                                                                         class="js-img"/></a></div>
                                                            <figcaption><h3><a
                                                                        href="/detail/<?php echo basename(__FILE__); ?>?ID=<?php echo $post->ID; ?>"
                                                                        class="" target="">
                                                                        <?php echo $post->post_title; ?>
                                                                    </a></h3>
                                                                <p><?php echo implode("  ", $arCurrentPostTagsNames); ?></p></figcaption>
                                                        </figure>
                                                    </li>


                                                        <?php
                                                        if($i == 7) break;
                                                        $i++;

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


                <section class=" " style=" background-color:#e75e50; ">
                    <div class="container-fluid">
                        <div class="row">
                            <div
                                class="wpb_column hcode-column-container  col-xs-mobile-fullwidth col-sm-12 no-padding">
                                <div class="vc-column-innner-wrapper">
                                    <div class="blog-slider position-relative">
                                        <div id="blog-post-slider-1449837701"
                                             class="owl-carousel owl-theme  dark-navigation round-pagination
                                             light-pagination white-cursor">

                                            <?php

                                            $categoryId = PORTFOLIO_WP_CATEGORY_PROJECTS_ID;

                                            $args = array(
                                                'numberposts' => 10000,
                                                'category' => $categoryId,
                                                'orderby' => 'date',
                                                'order' => 'DESC',
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

                                            <div
                                                class="post-<?php echo $post->ID; ?> post type-post status-publish format-image
                                                has-post-thumbnail hentry category-feature post_format-post-format-image">
                                                <div class="item">

                                                    <?php

                                                    $arDate = explode("-", $post->post_date);
                                                    $day = explode(" ", $arDate[2]);


                                                    $monthNum  = intval($arDate[1]);
                                                    $monthName = date('F', mktime(0, 0, 0, $monthNum, 10));

                                                    ?>

                                                    <div class="col-md-2 col-sm-3 col-xs-3 col-md-offset-1 text-center">
                                                        <span
                                                            class="timeline-number alt-font bg-white black-text display-inline-block"
                                                            style="color:#e75e50 !important">
                                                            <?php echo $day[0]; ?>
                                                        </span><span
                                                            class="text-large white-text display-block margin-ten-top">
                                                            <?php echo $monthName; ?>
                                                        </span><span
                                                            class="text-large white-text display-block
                                                            margin-ten-bottom">
                                                            <?php echo $arDate[0]; ?>
                                                        </span>
                                                        <div class="thin-separator-line bg-yellow"
                                                             style="background:#000000 !important;height:4px;"></div>
                                                    </div>
                                                    <div
                                                        class="col-md-9 col-sm-8 col-xs-9 border-right
                                                        border-transperent-light xs-no-border">
                                                        <h5 class="title-small text-uppercase font-weight-700
                                                        letter-spacing-1 white-text entry-title">
                                                            <a href="/detail/<?php echo basename(__FILE__); ?>?ID=<?php echo $post->ID; ?>">
                                                                <?php echo $post->post_title; ?>
                                                            </a>
                                                        </h5>
                                                        <div
                                                            class="text-med margin-three width-80 gray-text xs-width-100 float-left
                                                            post-slider-no-margin entry-content"
                                                            style="color:#ffffff !important">
                                                            <p>
                                                                <?php

                                                                //$content = wp_filter_nohtml_kses($content);
                                                                $content = preg_replace("/\\[.+\\]/m","",get_the_content());

                                                                echo kama_excerpt(array(
                                                                    'maxchar' => 100,
                                                                    'text' => $content
                                                                ));
                                                                ?>
                                                            </p>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                                <?php

                                            }

                                            wp_reset_postdata(); // сброс
                                            ?>


                                        </div>
                                    </div>
                                    <script type="text/javascript">/*<![CDATA[*/
                                        jQuery(document).ready(function () {
                                            jQuery("#blog-post-slider-1449837701").owlCarousel({
                                                pagination: true,
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
                        </div>
                    </div>
                </section>
                <?php
                $arContent = preg_split('/[\n.]/u', $arProject["post_content"], -1, PREG_SPLIT_NO_EMPTY);

                $arContentBlock = array_chunk($arContent, round(count($arContent)/2));

                ?>

                <section class="  no-padding">
                    <div class="container-fluid">
                        <div class="row">
                            <div
                                class="wpb_column hcode-column-container  col-md-7 col-xs-mobile-fullwidth
                                col-sm-12 no-padding">
                                <div class="vc-column-innner-wrapper">
                                    <img
                                            data-image="<?php displayRandomElement($arProjectAllImages); ?>"
                                        src="" class="js-img"
                                        width="1200" height="756" alt="">
                                </div>
                            </div>
                            <div
                                class="wpb_column hcode-column-container  corporate-about-text col-md-3
                                col-xs-mobile-fullwidth col-sm-6">
                                <div class="vc-column-innner-wrapper"><p>
                                        <span class="title-extra-large black-text">
                                            <?php echo $arProject["post_title"];?>
                                        </span>
                                    </p></div>
                            </div>
                            <div
                                class="wpb_column hcode-column-container  corporate-about-text-right
                                col-md-2 col-xs-mobile-fullwidth col-sm-6">
                                <div class="vc-column-innner-wrapper">
                                    <div class="separator-line no-margin-lr xs-margin-four-top"
                                         style=" background:#e75e50;height:4px;"></div>
                                    <span class="title-large text-uppercase letter-spacing-1 font-weight-600 black-text"
                                          style=" font-size:15px !important; color:#000000 !important;"><?php displayRandomElement($arPostTagsNames); ?></span>
                                    <p class="text-med">
                                        <?php if($arContentBlock[0]) echo implode("\n", $arContentBlock[0]); ?>
                                    </p></div>
                            </div>
                            <div
                                class="wpb_column hcode-column-container  pull-right col-md-5 col-xs-mobile-fullwidth col-sm-12 no-padding">
                                <div class="vc-column-innner-wrapper"><img
                                            data-image="<?php displayRandomElement($arProjectAllImages); ?>"
                                            src="" class="js-img"
                                            width="850" height="756" alt=""></div>
                            </div>
                            <div
                                class="wpb_column hcode-column-container  corporate-about-text-bottom col-md-3 col-xs-mobile-fullwidth col-sm-6">
                                <div class="vc-column-innner-wrapper"><span
                                        class="title-large text-uppercase letter-spacing-1 font-weight-600 black-text"
                                        style=" font-size:15px !important; color:#000000 !important;">
                                        <a href="<?php echo $projectURL; ?>">
                                            <?php echo $projectURL; ?>
                                        </a>
                                    </span>
                                    <p class="text-med">
                                        <?php if($arContentBlock[1]) echo implode("\n", $arContentBlock[1]);  ?>
                                    </p>
                                    <div class="separator-line no-margin-lr xs-margin-four-top"
                                         style=" background:#e75e50;height:4px;"></div>
                                </div>
                            </div>
                            <div
                                class="wpb_column hcode-column-container  corporate-about-text-bottom col-md-4 col-xs-mobile-fullwidth col-sm-6">
                                <div class="vc-column-innner-wrapper">
                                    <div class="progress-bar-main  ">

                                        <?php

                                        foreach($arPostTagsNames as $postTagsName) {

                                            $currentTagProjectPercent = ($arAllTags[$postTagsName] * 100) / $countAllProjects;
                                            $currentTagProjectPercent = round($currentTagProjectPercent);
                                            ?>

                                            <div class="progress-bar-sub">
                                                <div class="progress">
                                                    <div class="progress-bar " role="progressbar" aria-valuenow="60"
                                                         aria-valuemin="0" aria-valuemax="100"
                                                         style="width: <?php echo $currentTagProjectPercent; ?>%;
                                                                 background-color:#000000">
                                                        <span><?php echo $currentTagProjectPercent; ?>%</span>
                                                    </div>
                                                </div>
                                                <div class="progress-name">
                                                    <strong class="black-text">
                                                        <?php echo $postTagsName; ?>
                                                    </strong>
                                                    <?php echo $arAllTags[$postTagsName]; ?> проектов
                                                </div>
                                            </div>
                                            <?php
                                        }
                                        ?>





                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
                <section class=" " style=" background-color:#e75e50; ">
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
                                class="wpb_column hcode-column-container  counter-section col-md-3
                                col-xs-mobile-fullwidth col-sm-6 text-center sm-margin-ten-bottom wow fadeInUp"
                                data-wow-duration=300ms>
                                <div class="vc-column-innner-wrapper">
                                    <div class="counter-section"><i class="icon-global medium-icon"
                                                                    style="color: #ffffff"></i><span id="counter_1"
                                                                                                     data-to="<?php echo $countPosts;?>"
                                                                                                     class="counter-number white-text">
                                            <?php echo $countPosts;?>
                                        </span><span
                                            class="counter-title white-text">
                                            <?php
                                            echo numberof($countPosts, '',
                                                array('Проект', 'Проекта', 'Проектов'));
                                            ?>
                                        </span></div>
                                </div>
                            </div>
                            <div
                                class="wpb_column hcode-column-container  counter-section col-md-3 col-xs-mobile-fullwidth col-sm-6 text-center sm-margin-ten-bottom wow fadeInUp"
                                data-wow-duration=600ms>
                                <div class="vc-column-innner-wrapper">
                                    <div class="counter-section"><i class="icon-download medium-icon"
                                                                    style="color: #ffffff"></i><span id="counter_2"
                                                                                                     data-to="<?php echo $countSertificates;?>"
                                                                                                     class="counter-number white-text">
                                            <?php echo $countSertificates;?>
                                        </span><span
                                            class="counter-title white-text">
                                            <?php
                                            echo numberof($countPosts, '',
                                                array('Сертификат', 'Сертификата', 'Сертификатов'));
                                            ?>
                                        </span></div>
                                </div>
                            </div>
                            <div
                                class="wpb_column hcode-column-container  counter-section col-md-3 col-xs-mobile-fullwidth col-sm-6 text-center xs-margin-ten-bottom wow fadeInUp"
                                data-wow-duration=900ms>
                                <div class="vc-column-innner-wrapper">
                                    <div class="counter-section"><i class="icon-quote medium-icon"
                                                                    style="color: #ffffff"></i><span id="counter_3"
                                                                                                     data-to="<?php echo $countFilesInRepo; ?>"
                                                                                                     class="counter-number white-text">
                                            <?php echo $countFilesInRepo; ?>
                                        </span><span
                                            class="counter-title white-text">
                                            Файлов с кодом в репозитории
                                        </span></div>
                                </div>
                            </div>
                            <div
                                class="wpb_column hcode-column-container  col-md-3 col-xs-mobile-fullwidth col-sm-6 text-center wow fadeInUp"
                                data-wow-duration=1200ms>
                                <div class="vc-column-innner-wrapper">
                                    <div class="counter-section"><i class="icon-wine medium-icon"
                                                                    style="color: #ffffff"></i><span id="counter_4"
                                                                                                     data-to="<?php echo $humanYearsRemote; ?>"
                                                                                                     class="counter-number white-text">
                                            <?php echo $humanYearsRemote; ?>
                                        </span><span
                                            class="counter-title white-text">
                                            <?php
                                            echo numberof($humanYearsRemote, '', array('год', 'года', 'лет'));
                                            ?> опыта работы
                                        </span></div>
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
                                <div class="vc-column-innner-wrapper"><p
                                            class="sub-title deep-red-text letter-spacing-4 no-margin-top
                                            xs-letter-spacing-2">
                                        <?php displayRandomElement($currentDetailTitle);?></p>
                                    <h3 class="section-title  black-text no-padding-bottom"
                                        style="font-size:28px !important;font-weight:700 !important;;line-height:32px !important;">
                                        Комплексный подход к разработке и созданию сайтов
                                        для бизнеса, ориентированных на продвижение
                                        и высокую конверсию.
                                    </h3></div>
                            </div>






                            <?php

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
                                        class="wpb_column hcode-column-container  col-md-4 col-xs-mobile-fullwidth col-sm-4 text-center margin-ten-top xs-margin-ten-bottom wow zoomInUp">
                                    <div class="vc-column-innner-wrapper">
                                        <div class="testimonial-style2"><img
                                                    class="js-img"
                                                    data-image="<?php echo $image; ?>"
                                                    src=""  width="300" height="300"/>
                                            <p class="center-col width-90">
                                                <?php echo $description[0]; ?>
                                            </p>
                                            <span class="name light-gray-text2" style="color:#000000;">
                                                <?php echo $postSkill->post_title; ?>
                                            </span><i
                                                    class="fa fa-quote-left small-icon display-block margin-five
                                                    no-margin-bottom"
                                                    style="color:#e6af2a;"></i></div>
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
                <section class="  no-padding-top">
                    <div class="container">
                        <div class="row">

                            <?php
                            include $_SERVER['DOCUMENT_ROOT'] . '/includes/portfolio_grid_gallery.php';
                            $i = 0;


                            foreach($arAllMainImages as $arProjectMainImage) {

                                $filename = $arProjectMainImage;
                                $new_filen = $_SERVER["DOCUMENT_ROOT"].'/wp-content/uploads/' . basename($filename);


                                $fileNew = "/wp-content/uploads/" . basename($filename);

                                cropImage($arProjectMainImage,
                                    $_SERVER['DOCUMENT_ROOT'] . $fileNew,
                                    800, 500);


                                ?>

                                <div
                                        class="wpb_column hcode-column-container
                                        col-md-3 col-xs-mobile-fullwidth col-sm-6
                                sm-padding-bottom-30px xs-padding-bottom-15px">
                                    <div class="vc-column-innner-wrapper">
                                        <div class="client-logo-outer corporate-border">
                                            <div class="client-logo-inner">
                                                <img alt="" class="js-img"
                                                                                data-image="<?php echo $fileNew; ?>"
                                                                                src=""
                                                                                width="800" height="500"></div>
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