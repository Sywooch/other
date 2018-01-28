<?php
/**
 * Created by PhpStorm.
 * User: GSU
 * Date: 29.07.2017
 * Time: 15:39
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
<body class="page-template-default page page-id-50 wpb-js-composer js-comp-ver-5.1 vc_responsive">
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
                    <ul id="menu-onepage-corporate" class="mega-menu-ul nav navbar-nav navbar-right panel-group">
                        <?php
                        include $_SERVER['DOCUMENT_ROOT'] . '/includes/main_menu.php';
                        ?>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</nav>
<section class="parent-section no-padding post-50 page type-page status-publish has-post-thumbnail hentry">
    <div class="container-fluid">
        <div class="row">
            <div class="entry-content">
                <section id="slider" class="  no-padding">
                    <div class="container-fluid">
                        <div class="row">
                            <div class="wpb_column hcode-column-container  col-xs-mobile-fullwidth">
                                <div class="vc-column-innner-wrapper">
                                    <div class="onepage-corporate-slider">
                                        <div id="hcode-owl-slider13"
                                             class="owl-carousel owl-theme light-pagination  hcode-owl-slider13  white-cursor">

                                            <?php
                                            $arContent = preg_split('/[\n.]/u', $arProject["post_content"], -1, PREG_SPLIT_NO_EMPTY);

                                            $arContentBlock = array_chunk($arContent, round(count($arContent)/count($arProjectAllImages)));

                                            ?>

                                            <?php
                                            foreach($arProjectAllImages as $keyProjectImage => $projectImage) {
                                                ?>

                                                <div class="item owl-bg-img js-background"
                                                     data-image="<?php echo $projectImage; ?>"
                                                     style="background-image:url()">
                                                    <div class="slider-overlay bg-slider"></div>
                                                    <div class="container full-screen position-relative">
                                                        <div class="slider-typography">
                                                            <div class="slider-text-middle-main">
                                                                <div class="slider-text-middle">
                                                                    <h1 class="white-text">
                                                                        <?php echo $arProject["post_title"];?>
                                                                    </h1>
                                                                    <p class="text-large light-gray-text letter-spacing-3 margin-three"></p>
                                                                    <p class="text-large light-gray-text letter-spacing-3 margin-three">
                                                                        <?php
                                                                        if($arContentBlock[$keyProjectImage])
                                                                            echo implode("\n", $arContentBlock[$keyProjectImage]);

                                                                        ?>
                                                                    </p>
                                                                    <p></p><a
                                                                            class="btn-small-white-background btn btn-small no-margin inner-link"
                                                                            href="/projects/" target="_self">
                                                                        проекты</a>
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
                                            jQuery("#hcode-owl-slider13").owlCarousel({
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
                <section id="about" class="  no-padding-bottom" style="border-bottom: 1px solid #e5e5e5;">
                    <div class="container">
                        <div class="row">
                            <div
                                class="wpb_column hcode-column-container  col-md-12 col-xs-mobile-fullwidth text-center">
                                <div class="vc-column-innner-wrapper"><h3
                                        class="section-title  margin-one-bottom no-padding" style=" color:#7f7f7f; ">
                                        Типы проектов</h3>
                                    <h1 class="section-title  black-text no-padding"></h1></div>
                            </div>

                            <?php

                            $categoryId = PORTFOLIO_WP_CATEGORY_SITES_ID;

                            $args = array(
                                'numberposts' => 3,
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
                            <div
                                class="wpb_column hcode-column-container  col-md-4 col-xs-mobile-fullwidth col-sm-4 text-center margin-ten xs-margin-ten-bottom">
                                <div class="vc-column-innner-wrapper">
                                    <div class="features-box-style1"><i class="icon-<?php echo $post->post_content;?>
                                     extra-large-icon"></i><h5
                                            class=" margin-ten-top" style="color:#000000;"><?php echo $post->post_title;?></h5>
                                        <div class="no-margin"><p class="width-80 center-col margin-three">

                                            </p></div>
                                    </div>
                                </div>
                            </div>

                                <?php
                            }

                            wp_reset_postdata();
                            ?>




                            <div
                                class="wpb_column hcode-column-container  col-md-9 col-xs-mobile-fullwidth
                                text-center center-col margin-ten-top">
                                <div class="vc-column-innner-wrapper"><img
                                        src="" class="js-img"
                                        data-image="<?php displayRandomElement($arProjectMockups); ?>"
                                        width="1195" alt=""></div>
                            </div>
                        </div>
                    </div>
                </section>
                <section id="services" class="  padding-five-bottom sm-padding-ten-bottom">
                    <div class="container">
                        <div class="row">
                            <div
                                class="wpb_column hcode-column-container  col-md-12 col-xs-mobile-fullwidth text-center">
                                <div class="vc-column-innner-wrapper"><h3
                                        class="section-title  margin-one-bottom no-padding" style=" color:#7f7f7f; ">
                                        Тэги проекта
                                    </h3>
                                    <h1 class="section-title  black-text">
                                        Технологии, фреймворки, библиотеки, инструментарий
                                    </h1></div>
                            </div>
                            <div
                                class="wpb_column hcode-column-container  col-md-4 col-xs-mobile-fullwidth col-sm-4 text-center xs-margin-ten-bottom">
                                <div class="vc-column-innner-wrapper"><span
                                        class="services-number font-weight-100 gray-text">01</span>
                                    <p class="text-uppercase letter-spacing-2 font-weight-600 margin-five no-margin-bottom"
                                       style="color:#000000 !important"><?php displayRandomElement($arPostTagsNames); ?></p>
                                    <p class="margin-two text-med width-90 center-col">
                                        <?php displayRandomElement($arPostTagsNames); ?>
                                    </p></div>
                            </div>
                            <div
                                class="wpb_column hcode-column-container  col-md-4 col-xs-mobile-fullwidth col-sm-4 text-center xs-margin-ten-bottom">
                                <div class="vc-column-innner-wrapper"><span
                                        class="services-number font-weight-100 gray-text">02</span>
                                    <p class="text-uppercase letter-spacing-2 font-weight-600 margin-five no-margin-bottom"
                                       style="color:#000000 !important"><?php displayRandomElement($arPostTagsNames); ?></p>
                                    <p class="margin-two text-med width-90 center-col">
                                        <?php displayRandomElement($arPostTagsNames); ?>
                                    </p></div>
                            </div>
                            <div
                                class="wpb_column hcode-column-container  col-md-4 col-xs-mobile-fullwidth col-sm-4 text-center">
                                <div class="vc-column-innner-wrapper"><span
                                        class="services-number font-weight-100 gray-text">03</span>
                                    <p class="text-uppercase letter-spacing-2 font-weight-600 margin-five no-margin-bottom"
                                       style="color:#000000 !important"><?php displayRandomElement($arPostTagsNames); ?></p>
                                    <p class="margin-two text-med width-90 center-col">
                                        <?php displayRandomElement($arPostTagsNames); ?>
                                    </p></div>
                            </div>
                        </div>
                    </div>
                </section>
                <section class="  parallax-fix parallax9 no-padding js-background"
                         data-image="<?php echo $thimbnailProjectImage; ?>"
                         style=" background-image: url();">
                    <div class="container-fluid">
                        <div class="row">
                            <div
                                class="wpb_column hcode-column-container  pull-right col-md-6 col-xs-12 col-sm-12 no-padding">
                                <div class="vc-column-innner-wrapper">


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


                                    ?>


                                    <div class="grid-border">
                                        <div
                                            class="col-lg-4 col-md-6 col-sm-6 col-xs-12 no-padding grid-border-box
                                            bg-gray text-center">
                                            <i class="icon-<?php echo $post->post_content;?> extra-large-icon"></i><span
                                                class="text-uppercase letter-spacing-2 black-text
                                                font-weight-600 display-block margin-ten no-margin-bottom
                                                xs-margin-top-five"><?php echo $post->post_title;?></span>
                                        </div>
                                    </div>

                                        <?php
                                    }

                                    wp_reset_postdata();
                                    ?>

                                </div>
                            </div>
                        </div>
                    </div>
                </section>
                <section id="pricing">
                    <div class="container">
                        <div class="row">
                            <div
                                class="wpb_column hcode-column-container  col-md-12 col-xs-mobile-fullwidth text-center">
                                <div class="vc-column-innner-wrapper"><h3
                                        class="section-title  margin-one-bottom no-padding" style=" color:#7f7f7f; ">
                                        Теги проекта</h3>
                                    <h1 class="section-title  black-text">
                                        Технологии, фреймворки, библиотеки, инструментарий

                                    </h1></div>
                            </div>
                            <div
                                class="wpb_column hcode-column-container  col-md-3 col-xs-mobile-fullwidth col-sm-12 text-center no-padding xs-padding-lr-15px sm-margin-ten-bottom">
                                <div class="vc-column-innner-wrapper">
                                    <div class="pricing-box  bg-white">
                                        <div class="pricing-title"><h3 class="black-text ">
                                                <?php displayRandomElement($arPostTagsNames); ?>
                                            </h3></div>
                                        <?php /* ?>
                                        <div class="pricing-price black-text"><span class="price-unit">€</span>7<span
                                                class="price-tenure">/mo</span></div>
                                        <div class="pricing-features">
                                            <ul>
                                                <li><strong>Full</strong> Access</li>
                                                <li><i class="icon-code"></i> Source Files</li>
                                                <li><strong>100</strong> User Accounts</li>
                                                <li><strong>1 Year</strong> License</li>
                                                <li>Phone &amp; Email Support</li>
                                            </ul>
                                        </div>
                                        <div class="pricing-action"><a href="#"
                                                                       class="highlight-button btn btn-small button no-margin ">Sign
                                                Up Now!</a></div>
 <?php */ ?>
                                    </div>
                                </div>
                            </div>
                            <div
                                class="wpb_column hcode-column-container  col-md-3 col-xs-mobile-fullwidth col-sm-12 text-center no-padding xs-padding-lr-15px sm-margin-ten-bottom">
                                <div class="vc-column-innner-wrapper">
                                    <div class="pricing-box best-price xs-margin-0auto light-gray-text2 bg-black">
                                        <div class="pricing-title"><h3 class="white-text ">
                                                <?php displayRandomElement($arPostTagsNames); ?>
                                            </h3><span
                                                class="light-gray-text2"></span></div>

                                        <?php /* ?>
                                        <div class="pricing-price"><span class="price-unit">€</span>12<span
                                                class="price-tenure">/mo</span></div>
                                        <div class="pricing-features">
                                            <ul>
                                                <li><strong>Full</strong> Access</li>
                                                <li><i class="icon-code"></i> Source Files</li>
                                                <li><strong>1000</strong> User Accounts</li>
                                                <li><strong>2 Years</strong> License</li>
                                                <li>Phone &amp; Email Support</li>
                                                <li><i class="fa fa-star"></i><i class="fa fa-star"></i><i
                                                        class="fa fa-star"></i><i class="fa fa-star"></i><i
                                                        class="fa fa-star"></i></li>
                                            </ul>
                                        </div>

                                        <div class="pricing-action"><a href="#"
                                                                       class="btn-small-white-background btn btn-small button no-margin ">Sign
                                                Up Now!</a></div>
  <?php */ ?>
                                    </div>
                                </div>
                            </div>
                            <div
                                class="wpb_column hcode-column-container  col-md-3 col-xs-mobile-fullwidth col-sm-12 text-center no-padding xs-padding-lr-15px sm-margin-ten-bottom">
                                <div class="vc-column-innner-wrapper">
                                    <div class="pricing-box  bg-white">
                                        <div class="pricing-title"><h3 class="black-text ">
                                                <?php displayRandomElement($arPostTagsNames); ?>
                                            </h3></div>

                                        <?php /* ?>
                                        <div class="pricing-price black-text"><span class="price-unit">€</span>19<span
                                                class="price-tenure">/mo</span></div>
                                        <div class="pricing-features">
                                            <ul>
                                                <li><strong>Full</strong> Access</li>
                                                <li><i class="icon-code"></i> Source Files</li>
                                                <li><strong>500</strong> User Accounts</li>
                                                <li><strong>3 Years</strong> License</li>
                                                <li>Phone &amp; Email Support</li>
                                            </ul>
                                        </div>
                                        <div class="pricing-action"><a href="#"
                                                                       class="highlight-button btn btn-small button no-margin ">Sign
                                                Up Now!</a></div>
 <?php */ ?>
                                    </div>
                                </div>
                            </div>
                            <div
                                class="wpb_column hcode-column-container  no-border-right col-md-3 col-xs-mobile-fullwidth col-sm-12 no-padding xs-padding-lr-15px">
                                <div class="vc-column-innner-wrapper">
                                    <div class="pricing-box  bg-white">
                                        <div class="pricing-title"><h3 class="black-text ">
                                                <?php displayRandomElement($arPostTagsNames); ?>
                                            </h3></div>

                                        <?php /* ?>
                                        <div class="pricing-price black-text"><span class="price-unit">€</span>29<span
                                                class="price-tenure">/mo</span></div>
                                        <div class="pricing-features">
                                            <ul>
                                                <li><strong>Full</strong> Access</li>
                                                <li><i class="icon-code"></i> Source Files</li>
                                                <li><strong>1000</strong> User Accounts</li>
                                                <li><strong>5 Years</strong> License</li>
                                                <li>Phone &amp; Email Support</li>
                                            </ul>
                                        </div>
                                        <div class="pricing-action"><a href="#"
                                                                       class="highlight-button btn btn-small button no-margin ">Sign
                                                Up Now!</a></div>
 <?php */ ?>

                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
                <section id="clients" style="border-top: 1px solid #e5e5e5;">
                    <div class="container">
                        <div class="row">


                            <div
                                    class="wpb_column hcode-column-container  col-md-12 col-xs-mobile-fullwidth text-center">
                                <div class="vc-column-innner-wrapper">
                                    <h3
                                            class="section-title  margin-one-bottom no-padding" style=" color:#7f7f7f; ">
                                        Проекты</h3>
                                    <h1 class="section-title  black-text">
                                        Прочие реализованные проекты
                                    </h1></div>
                            </div>


                            <?php
                            include $_SERVER['DOCUMENT_ROOT'] . '/includes/portfolio_grid_gallery.php';
                            $i = 1;


                            foreach($arAllMainImages as $arProjectMainImage) {

                                $filename = $arProjectMainImage;
                                $new_filen = $_SERVER["DOCUMENT_ROOT"].'/wp-content/uploads/' . basename($filename);


                                $fileNew = "/wp-content/uploads/" . basename($filename);

                                cropImage($arProjectMainImage,
                                    $_SERVER['DOCUMENT_ROOT'] . $fileNew,
                                    800, 500);


                                ?>



                                <div
                                        class="wpb_column hcode-column-container  col-md-3 col-xs-mobile-fullwidth col-sm-6 padding-bottom-30px xs-padding-bottom-15px">
                                    <div class="vc-column-innner-wrapper">
                                        <div class="client-logo-outer corporate-border">
                                            <div class="client-logo-inner">
                                                <img alt=""
                                                                                class="js-img"
                                                                                data-image="<?php echo $fileNew; ?>"
                                                                                src=""
                                                                                width="800" height="500"></div>
                                        </div>
                                    </div>
                                </div>

                                <?php
                                if($i == 8) break;
                                $i++;
                            }
                            ?>





                        </div>
                    </div>
                </section>




                <section class="  fix-background  js-background"
                         style=" background-image: url(); "
                         data-image="<?php displayRandomElement($currentBackgroundImage); ?>">
                    <div class="selection-overlay" style=" opacity:0.8; background-color:#252525;"></div>
                    <div class="container">
                        <div class="row">
                            <div class="wpb_column hcode-column-container  col-xs-mobile-fullwidth">
                                <div class="vc-column-innner-wrapper">
                                    <div class="testimonial-slider position-relative no-transition">
                                        <div id="hcode-testimonial"
                                             class="owl-pagination-bottom position-relative  dot-pagination dark-pagination white-cursor">


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
                                                <img alt=""
                                                     src="<?php echo $fileNew; ?>"
                                                     width="300" height="300">
                                                <p class="center-col width-90 light-gray-text2">
                                                    <?php
                                                    $post_content = preg_replace("/\\[.+\\]/m","",
                                                        $post->post_content);
                                                    //$post_content = str_replace("\n","<br>",
                                                    //    $post_content);

                                                    echo kama_excerpt( array('text'=>$post_content, 'maxchar'=>1500,
                                                        'autop' => false) );

                                                    ?>
                                                </p> <span
                                                    class="name light-gray-text2" style="color:#ffffff">
                                                    <?php echo $post->post_title; ?>
                                                </span><i
                                                    class="fa fa-quote-left small-icon display-block margin-five no-margin-bottom"
                                                    style="color:#e6af2a"></i></div>
                                                <?php
                                            }
                                            ?>


                                        </div>
                                    </div>
                                    <script type="text/javascript">/*<![CDATA[*/
                                        jQuery(document).ready(function () {
                                            jQuery("#hcode-testimonial").owlCarousel({
                                                pagination: false,
                                                items: 3,
                                                itemsDesktop: [1200, 3],
                                                itemsTablet: [991, 3],
                                                itemsMobile: [767, 1],
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
                                class="wpb_column hcode-column-container  col-md-3 col-xs-mobile-fullwidth col-sm-6 text-center no-padding sm-margin-ten-bottom">
                                <div class="vc-column-innner-wrapper">
                                    <div class="counter-section"><i class="icon-global medium-icon"></i><span
                                            id="counter_1" data-to="<?php echo $countPosts;?>"
                                            class="counter-number black-text"><?php echo $countPosts;?></span><span class="counter-title"
                                                                                              style="color: #7f7f7f">
                                            <?php
                                            echo numberof($countPosts, '',
                                                array('Проект', 'Проекта', 'Проектов'));
                                            ?>
                                        </span>
                                    </div>
                                </div>
                            </div>
                            <div
                                class="wpb_column hcode-column-container  col-md-3 col-xs-mobile-fullwidth col-sm-6 text-center no-padding sm-margin-ten-bottom">
                                <div class="vc-column-innner-wrapper">
                                    <div class="counter-section"><i class="icon-download medium-icon"></i><span
                                            id="counter_2" data-to="<?php echo $countSertificates;?>"
                                            class="counter-number black-text"><?php echo $countSertificates;?></span><span class="counter-title"
                                                                                              style="color: #7f7f7f">
                                            <?php
                                            echo numberof($countPosts, '',
                                                array('Сертификат', 'Сертификата', 'Сертификатов'));
                                            ?>
                                        </span>
                                    </div>
                                </div>
                            </div>
                            <div
                                class="wpb_column hcode-column-container  col-md-3 col-xs-mobile-fullwidth col-sm-6 text-center no-padding xs-margin-ten-bottom">
                                <div class="vc-column-innner-wrapper">
                                    <div class="counter-section"><i class="icon-quote medium-icon"></i><span
                                            id="counter_3" data-to="<?php echo $countFilesInRepo; ?>"
                                            class="counter-number black-text"><?php echo $countFilesInRepo; ?></span><span class="counter-title"
                                                                                              style="color: #7f7f7f">
                                            Файлов с кодом в репозитории
                                        </span>
                                    </div>
                                </div>
                            </div>
                            <div
                                class="wpb_column hcode-column-container  col-md-3 col-xs-mobile-fullwidth col-sm-6 text-center no-padding">
                                <div class="vc-column-innner-wrapper">
                                    <div class="counter-section"><i class="icon-wine medium-icon"></i><span
                                            id="counter_4" data-to="<?php echo $humanYearsRemote; ?>"
                                            class="counter-number black-text"><?php echo $humanYearsRemote; ?></span><span class="counter-title"
                                                                                              style="color: #7f7f7f">
                                            <?php
                                            echo numberof($humanYearsRemote, '', array('год', 'года', 'лет'));
                                            ?> опыта удалённой работы
                                        </span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>

                <?php
                include $_SERVER['DOCUMENT_ROOT'] . '/includes/detail_blog_projects-2.php';
                ?>


                <?php
                include $_SERVER['DOCUMENT_ROOT'] . '/includes/detail_contact-us-2.php';
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


</body>
</html>