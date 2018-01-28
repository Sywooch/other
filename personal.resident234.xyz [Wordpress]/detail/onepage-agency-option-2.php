<?php
/**
 * Created by PhpStorm.
 * User: GSU
 * Date: 29.07.2017
 * Time: 15:34
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
<body class="page-template-default page page-id-16514 wpb-js-composer js-comp-ver-5.1 vc_responsive">
<nav
        class="navbar navbar-default nav-dark navbar-fixed-top nav-transparent overlay-nav sticky-nav full-width-pull-menu full-width-pull-menu-dark  hamburger-menu3  nav-black">
    <div class="container">
        <div class="row">

            <?php
            include $_SERVER['DOCUMENT_ROOT'] . '/includes/head_logo_orange.php';
            ?>


            <div class="col-md-10 col-sm-10 no-padding-right no-transition">
                <div class="menu-wrap full-screen no-padding">
                    <?php
                    $thumb_id = get_post_thumbnail_id($arProject["ID"]);
                    $thumb_url = wp_get_attachment_image_src($thumb_id, 'full',
                        false);

                    $thumb_url[0] = str_replace(get_site_url(),
                        PORTFOLIO_WP_URL,
                        $thumb_url[0]);
                    ?>

                    <div class="col-md-6 col-sm-6 full-screen no-padding cover-background xs-display-none
js-background" data-image="<?php echo $thumb_url[0];?>"
                         style="background-image:url();"></div>
                    <div class="col-md-6 col-sm-6 full-screen bg-white bg-hamburger-menu3">
                        <div class="pull-menu full-screen ">
                            <div class="pull-menu-open">
                                <div class="pull-menu-open-sub">
                                    <?php
                                    include $_SERVER['DOCUMENT_ROOT'] . '/includes/main_menu-accordion.php';
                                    ?>

                                    <div class="separator-line-thick bg-black margin-three pull-left margin-five"></div>
                                    <div class="col-md-12 col-sm-12 col-xs-12 no-padding">
                                        <div id="text-15" class="custom-widget widget_text">
                                            <?php /* ?><div class="textwidget"><a href="#" class="btn social-icon button"><i
                                                        class="fa fa-facebook"></i></a><a href="#"
                                                                                          class="btn social-icon button"><i
                                                        class="fa fa-twitter"></i></a><a href="#"
                                                                                         class="btn social-icon button"><i
                                                        class="fa fa-google-plus"></i></a><a href="#"
                                                                                             class="btn social-icon button"><i
                                                        class="fa fa-tumblr"></i></a></div><?php */ ?>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <button class="close-button" id="close-button">Close Menu</button>
                        </div>
                    </div>
                </div>
                <button type="button" class="menu-button-orange position-absolute position-right navbar-toggle"
                        id="open-button" data-toggle="collapse" data-target=".navbar-collapse"><span class="sr-only">Open Menu</span>
                    <span class="icon-bar"></span> <span class="icon-bar"></span> <span class="icon-bar"></span>
                </button>
            </div>
        </div>
    </div>
</nav>
<section class="parent-section no-padding post-16514 page type-page status-publish hentry">
    <div class="container-fluid">
        <div class="row">
            <div class="entry-content">
                <section id="home" class=" slider no-padding">
                    <div class="container-fluid">
                        <div class="row">
                            <div class="wpb_column hcode-column-container  col-xs-mobile-fullwidth">
                                <div class="vc-column-innner-wrapper">
                                    <div id="hcode-owl-slider23"
                                         class="owl-carousel owl-theme  hcode-owl-slider23  square-pagination light-pagination dark-navigation white-cursor main-slider  hcode-owl-slider23 ">
                                        <div class="item owl-bg-img js-background"
                                             style="background-image:url()"
                                             data-image="<?php displayRandomElement($currentBackgroundImage); ?>">
                                            <div class="container full-screen position-relative">
                                                <div class="slider-typography">
                                                    <div class="slider-text-middle-main">
                                                        <div
                                                                class="slider-text-middle slider-text-middle6 padding-left-right-px wow fadeInUp animated">
                                                            <div
                                                                    class="col-md-12 text-left animated fadeInUp no-padding">
                                                                <span
                                                                        class="slider-title-big6 sm-slider-title-big6 xs-width-100 xs-slider-title-big6 xs-text-center orange-light-text font-weight-700 text-decoration-underline display-inline-block margin-five no-margin-lr no-margin-top"
                                                                        style="color:#ef824c !important ">
                                                                    <?php echo $arProject["post_title"];?>
                                                                </span>
                                                                <p><span
                                                                            class="slider-title-big7 sm-slider-title-big7 xs-width-100
                                                                        xs-slider-title-big7 xs-text-center">
                                                                        <?php echo get_post_meta($arProject["ID"], 'YEAR')[0]; ?>
                                                                    </span>
                                                                </p></div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="item owl-bg-img js-background"
                                             style="background-image:url()"
                                             data-image="<?php displayRandomElement($currentBackgroundImage); ?>">
                                            <div class="container full-screen position-relative">
                                                <div class="slider-typography">
                                                    <div class="slider-text-middle-main">
                                                        <div
                                                                class="slider-text-middle slider-text-middle6 padding-left-right-px wow fadeInUp animated">
                                                            <div
                                                                    class="col-md-12 text-left animated fadeInUp no-padding">
                                                                <span
                                                                        class="slider-title-big6 sm-slider-title-big6 xs-width-100 xs-slider-title-big6 xs-text-center orange-light-text font-weight-700 text-decoration-underline display-inline-block margin-five no-margin-lr no-margin-top"
                                                                        style="color:#ef824c !important ">
                                                                    <?php displayRandomElement($arPostTagsNames); ?>
                                                                </span>
                                                                <p>
                                                                    <span
                                                                            class="slider-title-big7
                                                                        sm-slider-title-big7 xs-width-100 xs-slider-title-big7
                                                                        xs-text-center">
                                                                        <?php
                                                                        $URL = get_post_meta($arProject["ID"], 'URL');

                                                                        if (!empty($URL)) {
                                                                            ?>
                                                                            <a href="<?php echo $URL[0]; ?>"
                                                                               target="_blank">

                                                                                <?php echo $URL[0]; ?>

                                                                            </a>
                                                                            <?php
                                                                        }
                                                                        ?>
                                                                    </span>
                                                                </p>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="item owl-bg-img js-background"
                                             style="background-image:url()"
                                             data-image="<?php displayRandomElement($currentBackgroundImage); ?>">
                                            <div class="container full-screen position-relative">
                                                <div class="slider-typography">
                                                    <div class="slider-text-middle-main">
                                                        <div
                                                                class="slider-text-middle slider-text-middle6 padding-left-right-px wow fadeInUp animated">
                                                            <div
                                                                    class="col-md-12 text-left animated fadeInUp no-padding">
                                                                <span
                                                                        class="slider-title-big6 sm-slider-title-big6 xs-width-100 xs-slider-title-big6 xs-text-center orange-light-text font-weight-700 text-decoration-underline display-inline-block margin-five no-margin-lr no-margin-top"
                                                                        style="color:#ef824c !important ">
                                                                    <?php displayRandomElement($arPostTagsNames); ?>
                                                                </span>
                                                                <p><span
                                                                            class="slider-title-big7 sm-slider-title-big7
                                                                        xs-width-100 xs-slider-title-big7
                                                                        xs-text-center">
                                                                        <?php displayRandomElement($arPostTagsNames); ?>
                                                                    </span>
                                                                </p></div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <script type="text/javascript">/*<![CDATA[*/
                                        jQuery(document).ready(function () {
                                            jQuery("#hcode-owl-slider23").owlCarousel({
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
                <section id="about-us" class="  fix-background xs-no-background js-background"
                         style="background-image:url()"
                         data-image="<?php displayRandomElement($currentBackgroundImage); ?>">
                    <div class="container">
                        <div class="row">
                            <div
                                    class="wpb_column hcode-column-container  pull-right col-md-6 col-xs-mobile-fullwidth col-sm-12 xs-text-center">
                                <div class="vc-column-innner-wrapper">
                                    <div class="heading-style-nine  margin-ten-bottom"><h1
                                                class="text-transform-none title orange-light-text">
                                            <span>Описание</span></h1></div>
                                    <div class="title-large font-weight-700 margin-four no-margin-lr no-margin-top">
                                        <?php echo $arProject["post_title"];?>
                                    </div>
                                    <p class="text-extra-large xs-margin-bottom-four">
                                        <?php echo $arProject["post_content_formatted"]; ?>
                                    </p>
                                    <div class="sub-headline">
                                        <?php echo implode("  ", $arPostTagsNames); ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
                <section id="portfolio" class=" grid-wrap no-padding-bottom" style="border-top: 1px solid #e5e5e5;">
                    <div class="container-fluid">
                        <div class="row">
                            <div
                                    class="wpb_column hcode-column-container  col-md-5 col-xs-mobile-fullwidth
                                col-sm-12 text-center">
                                <div class="vc-column-innner-wrapper">
                                    <div class="heading-style-nine  margin-ten-bottom"><h1
                                                class="text-transform-none title orange-light-text"><span>
                                                Портфолио
                                            </span>
                                        </h1></div>
                                </div>
                            </div>
                            <div
                                    class="wpb_column hcode-column-container  col-md-7
                                col-xs-mobile-fullwidth col-sm-12 text-center">
                                <div class="vc-column-innner-wrapper">
                                    <ul class="portfolio-filter nav nav-tabs nav-tabs-style2" style="height:auto; margin-bottom:20px;">
                                        <?php
                                        include $_SERVER['DOCUMENT_ROOT'] . '/includes/portfolio_filter.php';
                                        ?>
                                    </ul>
                                </div>
                            </div>
                            <div
                                    class="wpb_column hcode-column-container  col-xs-mobile-fullwidth col-sm-12 no-padding">
                                <div class="vc-column-innner-wrapper">
                                    <div class="work-4col masonry wide ">
                                        <div class="col-md-12  grid-gallery overflow-hidden no-padding content-section">
                                            <div class="tab-content">
                                                <ul class="grid masonry-items ">


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

                                                        $height = 600;
                                                        if($i == 2) $height = 1200;

                                                        $width = 800;

                                                        $fileNew = "/wp-content/uploads/" . basename($filename);


                                                        $fileNew = cropImage($filename,
                                                            $_SERVER['DOCUMENT_ROOT'] . $fileNew,
                                                            $width, $height);


                                                        $arPostTags = wp_get_post_tags($post->ID);
                                                        ?>



                                                        <li class="<?php
                                                        foreach ($arPostTags as $keyTag => $tag) {
                                                            echo " portfolio-filter-".$tag->term_id;

                                                        }
                                                        ?>">
                                                            <figure>
                                                                <div class="gallery-img">
                                                                    <a
                                                                            href="/detail/<?php echo basename(__FILE__); ?>?ID=<?php echo $post->ID; ?>"
                                                                            class="simple-ajax-popup-align-top">
                                                                        <img alt=""
                                                                             data-image="<?php echo $fileNew; ?>"
                                                                             src="<?php echo $fileNew; ?>"
                                                                             width="800"
                                                                             height="<?php echo $height; ?>"/>
                                                                    <!--class="js-img" -->
                                                                    </a>
                                                                </div>
                                                                <figcaption><h3><a
                                                                                href="/detail/<?php echo basename(__FILE__); ?>?ID=<?php echo $post->ID; ?>"
                                                                                class="simple-ajax-popup-align-top"><?php echo $post->post_title; ?></a></h3>
                                                                    <p><?php echo implode(" - ", $arPostTagsNamesWidget) ?></p></figcaption>
                                                            </figure>
                                                        </li>




                                                        <?php
                                                        if($i == 7) $i = 1;
                                                        else $i++;

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
                <section id="counter">
                    <div class="container">
                        <div class="row">
                            <div
                                    class="wpb_column hcode-column-container  md-text-center col-lg-2
                                    col-md-12 col-xs-mobile-fullwidth">
                                <div class="vc-column-innner-wrapper">
                                    <div
                                            class="text-extra-large text-transform-uppercase dark-gray-text
                                            font-weight-600 counter-subheadline md-margin-four-bottom
                                            xs-margin-bottom-three">
                                        Статистика <span class="orange-light-text md-display-none">/</span>
                                    </div>
                                </div>
                            </div>
                            <div
                                    class="wpb_column hcode-column-container  col-lg-10 col-md-12
                                    col-xs-mobile-fullwidth sm-no-padding-lr">
                                <div class="vc-column-innner-wrapper">
                                    <div class="  hcode-inner-row">


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
                                                class="wpb_column hcode-column-container  col-xs-mobile-fullwidth
                                                col-sm-3 xs-text-center xs-margin-three-bottom">
                                            <div class="vc-column-innner-wrapper">
                                                <div class="counter-style2"><span id="counter_1" data-to="<?php echo $countPosts;?>"
                                                                                  class="timer counter-number light-gray-text main-font font-weight-700 text-extra-large"
                                                                                  style="color: #ababab"><?php echo $countPosts;?></span><span
                                                            class="counter-title light-gray-text font-weight-300 text-extra-large "
                                                            style="color: #ababab"><?php
                                                        echo numberof($countPosts, '',
                                                            array('Проект', 'Проекта', 'Проектов'));
                                                        ?></span><i
                                                            class="orange-light-text xs-display-none display-none fa fa-plus"
                                                            style="color: #ef824c"></i></div>
                                            </div>
                                        </div>
                                        <div
                                                class="wpb_column hcode-column-container  col-xs-mobile-fullwidth col-sm-3 xs-text-center xs-margin-three-bottom">
                                            <div class="vc-column-innner-wrapper">
                                                <div class="counter-style2"><span id="counter_2" data-to="<?php echo $countSertificates;?>"
                                                                                  class="timer counter-number light-gray-text main-font font-weight-700 text-extra-large"
                                                                                  style="color: #ababab"><?php echo $countSertificates;?></span><span
                                                            class="counter-title light-gray-text font-weight-300 text-extra-large "
                                                            style="color: #ababab"><?php
                                                        echo numberof($countPosts, '',
                                                            array('Сертификат', 'Сертификата', 'Сертификатов'));
                                                        ?></span><i
                                                            class="orange-light-text xs-display-none display-none fa fa-plus"
                                                            style="color: #ef824c"></i></div>
                                            </div>
                                        </div>
                                        <div
                                                class="wpb_column hcode-column-container  col-xs-mobile-fullwidth col-sm-3 xs-text-center xs-margin-three-bottom">
                                            <div class="vc-column-innner-wrapper">
                                                <div class="counter-style2"><span id="counter_3" data-to="<?php echo $countFilesInRepo; ?>"
                                                                                  class="timer counter-number light-gray-text main-font font-weight-700 text-extra-large"
                                                                                  style="color: #ababab"><?php echo $countFilesInRepo; ?></span><span
                                                            class="counter-title light-gray-text font-weight-300 text-extra-large "
                                                            style="color: #ababab">Файлов с кодом в репозитории</span><i
                                                            class="orange-light-text xs-display-none display-none fa fa-plus"
                                                            style="color: #ef824c"></i></div>
                                            </div>
                                        </div>
                                        <div
                                                class="wpb_column hcode-column-container  col-xs-mobile-fullwidth col-sm-3 xs-text-center">
                                            <div class="vc-column-innner-wrapper">
                                                <div class="counter-style2"><span id="counter_4" data-to="<?php echo $humanYearsRemote; ?>"
                                                                                  class="timer counter-number light-gray-text main-font font-weight-700 text-extra-large"
                                                                                  style="color: #ababab"><?php echo $humanYearsRemote; ?></span><span
                                                            class="counter-title light-gray-text font-weight-300 text-extra-large "
                                                            style="color: #ababab"><?php
                                                        echo numberof($humanYearsRemote, '', array('год', 'года', 'лет'));
                                                        ?> опыта удалённой работы</span></div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
                <section id="service" class="  no-padding">
                    <div class="container-fluid">
                        <div class="row">
                            <div
                                    class="wpb_column hcode-column-container vc_custom_1491483216530  bg-light-gray box-min-height
                                    sm-display-table xs-display-inherit xs-text-center xs-onepage-section col-md-6
                                    col-xs-mobile-fullwidth col-sm-12 padding-five-tb">
                                <div class="vc-column-innner-wrapper">
                                    <div class="  hcode-inner-row">
                                        <div
                                                class="wpb_column hcode-column-container  pull-right col-lg-9 col-md-12
                                                col-xs-mobile-fullwidth">
                                            <div class="vc-column-innner-wrapper">
                                                <div class="heading-style-nine  margin-ten-bottom"><h1
                                                            class="text-transform-none title orange-light-text">
                                                        <span>Услуги</span>
                                                    </h1></div>
                                                <div class=" title-large font-weight-300  margin-ten-bottom"><p>
                                                        Список услуг по разработке и сопровождению сайта</p></div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div
                                    class="wpb_column hcode-column-container  sm-padding-bottom-six box-min-height
                                    sm-display-table col-md-6 col-xs-mobile-fullwidth col-sm-12 padding-five-tb"
                                    style=" background:#fcfcfc;">
                                <div class="vc-column-innner-wrapper">
                                    <div class="  hcode-inner-row">
                                        <div
                                                class="wpb_column hcode-column-container  our-services col-lg-11 col-md-12 col-xs-mobile-fullwidth xs-no-padding">
                                            <div class="vc-column-innner-wrapper">
                                                <ul>
                                                    <li class="position-relative font-weight-300 text-extra-large margin-seven-bottom">
                                                        <div class="number orange-light-text">01.</div>
                                                        <div><span
                                                                    class="black-text font-weight-700 text-transform-uppercase
                                                                    display-table margin-two-bottom">Подготовительные работы</span><br/>
                                                            - Обсуждение проекта, постановка целей и задач<br>
                                                            - Составление сметы, календарного плана, заключение
                                                            договора на создание сайта<br>
                                                            - Составление технического задания и прототипов
                                                        </div>
                                                    </li>
                                                    <li class="position-relative font-weight-300 text-extra-large margin-seven-bottom">
                                                        <div class="number orange-light-text">02.</div>
                                                        <div><span
                                                                    class="black-text font-weight-700 text-transform-uppercase
                                                                    display-table margin-two-bottom">Разработка сайта</span><br/>
                                                            - Работы по проектированию и разработке на основании утверждённого
                                                            технического задания и брифа<br>
                                                            - Проработка структуры будущего сайта<br>
                                                            - Выбор платформы и инструментария<br>
                                                            - Собственно разработка<br>
                                                            - Тестирование<br>
                                                            - Запуск
                                                        </div>
                                                    </li>
                                                    <li class="position-relative font-weight-300 text-extra-large margin-seven-bottom">
                                                        <div class="number orange-light-text">03.</div>
                                                        <div><span
                                                                    class="black-text font-weight-700 text-transform-uppercase
                                                                    display-table margin-two-bottom">Сопровождение сайта</span><br/>
                                                            - Наполнение ресурса оптимизированным SEO-контентом<br>
                                                            - Наполнение страниц информационными материалами клиента<br>
                                                            - Редизайн элементов по желанию заказчика<br>
                                                            - Переконфигурирование сайта<br>
                                                            - Техническая поддержка
                                                        </div>
                                                    </li>
                                                    <li class="position-relative font-weight-300 text-extra-large">
                                                        <div class="number orange-light-text">04.</div>
                                                        <div><span
                                                                    class="black-text font-weight-700 text-transform-uppercase
                                                                    display-table margin-two-bottom">Доработка сайта</span><br/>
                                                            - Доработка модулей или их создание<br>
                                                            - Доработка верстки<br>
                                                            - Адаптация под браузеры и разрешения дисплеев<br>
                                                            - Редизайн/доработка дизайна<br>
                                                            - Создание элементов сайта<br>
                                                            - Работа с юзабилити<br>
                                                            - Отладка ошибок в программном коде ресурса<br>
                                                            - Коррекция работы сайта согласно интересам и потребностям
                                                            посетителей<br>
                                                            - Изменение бизнес-логики проекта<br>
                                                            - Повышение производительности, ускорение работы, рефакторинг<br>
                                                            - Интеграция с внешними системами<br>
                                                        </div>
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
                <section style="border-bottom: 1px solid #e5e5e5;">
                    <div class="container">
                        <div class="row">
                            <div
                                    class="wpb_column hcode-column-container  col-xs-mobile-fullwidth col-sm-12 xs-text-center">
                                <div class="vc-column-innner-wrapper">
                                    <div class="heading-style-nine  margin-ten-bottom"><h1
                                                class="text-transform-none title orange-light-text">
                                            <span>Другие проекты</span>
                                        </h1></div>
                                </div>
                            </div>


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

                            $height = 80;
                            $width = 80;

                            $fileNew = "/wp-content/uploads/" . basename($filename);


                            $fileNew = cropImage($filename,
                                $_SERVER['DOCUMENT_ROOT'] . $fileNew,
                                $width, $height);


                            $arPostTags = wp_get_post_tags($post->ID);
                            ?>

                            <div
                                    class="wpb_column hcode-column-container  col-md-6 col-xs-mobile-fullwidth col-sm-12
                                    xs-text-center margin-five-bottom">
                                <div class="vc-column-innner-wrapper">
                                    <div
                                            class="heading-style-ten icon position-relative xs-no-margin-lr-auto  black-text">
                                        <img
                                                src="" data-image="<?php echo $fileNew; ?>"
                                                alt="" class="icon-image js-img"/>
                                        <div
                                                class="title title-large font-weight-700 display-inline-block
                                                vertical-align-middle width-70">
                                            <?php echo $post->post_title; ?>
                                        </div>
                                    </div>
                                    <p class="text-extra-large width-90">
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

                                <?php
                            }
                            ?>


                        </div>
                    </div>
                </section>
                <section id="team" class="  sm-no-padding-bottom">
                    <div class="container">
                        <div class="row">
                            <div
                                    class="wpb_column hcode-column-container  col-md-6 col-xs-mobile-fullwidth col-sm-12 xs-text-center sm-margin-ten-bottom">
                                <div class="vc-column-innner-wrapper">
                                    <div class="heading-style-nine "><h1
                                                class="text-transform-none title orange-light-text">
                                            <span>Случайный текст</span>
                                        </h1></div>
                                </div>
                            </div>
                            <div
                                    class="wpb_column hcode-column-container  col-md-6 col-xs-mobile-fullwidth col-sm-12 xs-text-center sm-margin-five-bottom">
                                <div class="vc-column-innner-wrapper">
                                    <div class=" font-weight-300 title-large  ">
                                        <p><?php displayRandomElement($currentDetailTitle); ?></p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
                <section class="  no-padding" style=" background-color:#f6f6f6; ">
                    <div class="container-fluid">
                        <div class="row">
                            <div class="wpb_column hcode-column-container  col-xs-mobile-fullwidth">
                                <div class="vc-column-innner-wrapper">
                                    <div id="team-member-slider-1"
                                         class="owl-carousel owl-theme dark-pagination bottom-arrow-pagination black-cursor main-slider ">


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
                                            

                                        $arPostTags = wp_get_post_tags($post->ID);
                                        ?>


                                        <div class="item">
                                            <div class="col-lg-6 col-md-6 case-study-details bg-gray">
                                                <div
                                                        class="col-lg-7 col-md-12 pull-right about-text position-relative
                                                        xs-text-center">
                                                    <p class="title-small text-uppercase letter-spacing-3 black-text
                                                    font-weight-600">
                                                        <?php echo $post->post_title; ?></p>
                                                    <p class="width-100 xs-width-100">
                                                    <p><?php
                                                        $post_content = preg_replace("/\\[.+\\]/m","",
                                                            $post->post_content);
                                                        //$post_content = str_replace("\n","<br>",
                                                        //    $post_content);

                                                        echo kama_excerpt( array('text'=>$post_content, 'maxchar'=>1500,
                                                            'autop' => false) );

                                                        ?></p></p>
                                                    <div class="our-team-agency-social">
                                                        <?php echo implode(" / ", $arPostTagsNamesWidget); ?>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-lg-6 col-md-6 case-study-img cover-background js-background"
                                                 data-image="<?php echo $thumb_url_full[0]; ?>"
                                                 style="background-image:url();"></div>
                                        </div>

                                            <?php
                                        }
                                        ?>



                                    </div>
                                    <script type="text/javascript">/*<![CDATA[*/
                                        jQuery(document).ready(function () {
                                            jQuery("#team-member-slider-1").owlCarousel({
                                                navigation: true,
                                                slideSpeed: 300,
                                                paginationSpeed: 400,
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
                <section id="blog">
                    <div class="container">
                        <div class="row">
                            <div class="wpb_column hcode-column-container  col-xs-mobile-fullwidth col-sm-12">
                                <div class="vc-column-innner-wrapper">
                                    <div class="heading-style-nine  margin-ten-bottom text-center"><h1
                                                class="text-transform-none title orange-light-text">
                                            <span>Последние проекты</span></h1></div>
                                </div>
                            </div>
                            <div class="wpb_column hcode-column-container  col-xs-mobile-fullwidth">
                                <div class="vc-column-innner-wrapper">
                                    <div class="blog-3col product-3">



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




                                            $height = 767;
                                            $width = 767;
                                            $fileNew = "/wp-content/uploads/" . basename($filename);
                                            $fileNew = cropImage($filename,
                                                $_SERVER['DOCUMENT_ROOT'] . $fileNew,
                                                $width, $height);


                                            $height = 150;
                                            $width = 150;
                                            $fileNew150 = "/wp-content/uploads/" . basename($filename);
                                            $fileNew150 = cropImage($filename,
                                                $_SERVER['DOCUMENT_ROOT'] . $fileNew150,
                                                $width, $height);


                                            $height = 300;
                                            $width = 300;
                                            $fileNew300 = "/wp-content/uploads/" . basename($filename);
                                            $fileNew300 = cropImage($filename,
                                                $_SERVER['DOCUMENT_ROOT'] . $fileNew300,
                                                $width, $height);




                                        $arPostTags = wp_get_post_tags($post->ID);
                                        ?>


                                        <div
                                                class="post-<?php echo $post->ID; ?> post type-post status-publish
                                                format-standard has-post-thumbnail hentry category-onepage-agency">
                                            <div
                                                    class="col-md-4 col-sm-6 col-xs-12 latest-blogs margin-three-bottom
                                                    sm-margin-bottom-four">
                                                <div class="blog-listing no-margin">
                                                    <div class="blog-image"><img width="767" height="767"
                                                                                 src="<?php echo $fileNew; ?>"
                                                                                 class="attachment-full size-full wp-post-image"
                                                                                 alt="" title=""
                                                                                 srcset="<?php echo $fileNew; ?> 767w, <?php echo $fileNew150; ?> 150w, <?php echo $fileNew300; ?> 300w"
                                                                                 sizes="(max-width: 767px) 100vw, 767px"/>
                                                        <div class="blog-content xs-text-center">
                                                            <div class="slider-text-middle-main">
                                                                <div class="slider-text-middle">
                                                                    <span
                                                                            class="post-author">
                                                                        <?php echo implode(" | ", $arPostTagsNamesWidget); ?>
                                                                    </span>
                                                                    <a
                                                                            class="post-title entry-title"
                                                                            href="/detail/<?php echo basename(__FILE__); ?>?ID=<?php echo $post->ID; ?>">
                                                                        <?php echo $post->post_title; ?></a>
                                                                    <div class="entry-content">
                                                                        <p>
                                                                            <?php
                                                                            $post_content = preg_replace("/\\[.+\\]/m","",
                                                                                $post->post_content);
                                                                            //$post_content = str_replace("\n","<br>",
                                                                            //    $post_content);

                                                                            echo kama_excerpt( array('text'=>$post_content, 'maxchar'=>1500,
                                                                                'autop' => false) );

                                                                            ?>
                                                                        </p>
                                                                    </div>
                                                                    <div class="like-share">
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
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
                            </div>
                            <div
                                    class="wpb_column hcode-column-container  col-xs-mobile-fullwidth col-sm-12 text-center margin-top-30px sm-margin-top-20px">
                                <div class="vc-column-innner-wrapper"><a
                                            href="/projects/" target="_self"
                                            class="inner-link highlight-button-orange-border highlight-button-black-border btn-medium  button btn"
                                            style=" padding: 10px 30px;">Все проекты</a></div>
                            </div>
                        </div>
                    </div>
                </section>
                <section id="testimonial" class="  fix-background wow fadeIn js-background"
                         style=" background-image: url(); "
                data-image="<?php displayRandomElement($currentBackgroundImage); ?>">
                    <div class="selection-overlay" style=" opacity:0.8; background-color:#252525;"></div>
                    <div class="container">
                        <div class="row">
                            <div
                                    class="wpb_column hcode-column-container  col-md-6 col-xs-mobile-fullwidth col-sm-10 center-col">
                                <div class="vc-column-innner-wrapper">
                                    <div class="testimonial-slider position-relative no-transition">
                                        <div id="hcode-testimonial"
                                             class="owl-pagination-bottom position-relative  round-pagination light-pagination no-cursor">


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
                                                    <p class="text-med light-gray-text2">
                                                        <?php
                                                        $post_content = preg_replace("/\\[.+\\]/m","",
                                                            $post->post_content);
                                                        //$post_content = str_replace("\n","<br>",
                                                        //    $post_content);

                                                        echo kama_excerpt( array('text'=>$post_content, 'maxchar'=>1500,
                                                            'autop' => false) );

                                                        ?>
                                                    </p>
                                                    <span class="name light-gray-text2"
                                                                                      style="color:#828282">
                                                        <?php echo $post->post_title; ?>
                                                    </span>
                                                    <i
                                                            class="fa fa-quote-left small-icon display-block margin-five no-margin-bottom"
                                                            style="color:#ef824c"></i></div>
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
                <section id="contact" class="  no-padding-bottom">
                    <div class="container">
                        <div class="row">
                            <div
                                    class="wpb_column hcode-column-container  col-md-12 col-xs-mobile-fullwidth text-center">
                                <div class="vc-column-innner-wrapper">
                                    <div class="heading-style-nine  margin-ten-bottom"><h1
                                                class="text-transform-none title orange-light-text"><span>Контакты</span>
                                        </h1>
                                        <h4
                                                class="margin-two-top no-margin-lr no-margin-top font-weight-300 gray-text">
                                            Заказать разработку проекта или связаться со мной по другим вопросам
                                        </h4>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
                <section class="  row-equal-height row-content-middle no-padding-top">
                    <div class="container">
                        <div class="row">
                            <div class="wpb_column hcode-column-container  col-md-6 col-xs-mobile-fullwidth col-sm-6"
                                 style=" background:#f6f6f6;">
                                <div class="vc-column-innner-wrapper">
                                    <div class="agency-contact-form">
                                        <div role="form" class="wpcf7" id="wpcf7-f17848-p16514-o1" lang="en-US"
                                             dir="ltr">
                                            <div class="screen-reader-response"></div>
                                            <form action="<?php echo $_SERVER["REQUEST_URI"]; ?>"
                                                  method="post" class="wpcf7-form" novalidate="novalidate">
                                                <div style="display: none;"><input type="hidden" name="_wpcf7"
                                                                                   value="17848"/> <input type="hidden"
                                                                                                          name="_wpcf7_version"
                                                                                                          value="4.7"/>
                                                    <input type="hidden" name="_wpcf7_locale" value="en_US"/> <input
                                                            type="hidden" name="_wpcf7_unit_tag"
                                                            value="wpcf7-f17848-p16514-o1"/> <input type="hidden"
                                                                                                    name="_wpnonce"
                                                                                                    value="41e3f7268e"/>
                                                </div>
                                                <div class="no-margin"><span
                                                            class="wpcf7-form-control-wrap your-name"><input type="text"
                                                                                                             name="your-name"
                                                                                                             value=""
                                                                                                             size="40"
                                                                                                             class="wpcf7-form-control wpcf7-text wpcf7-validates-as-required"
                                                                                                             aria-required="true"
                                                                                                             aria-invalid="false"
                                                                                                             placeholder="ВАШЕ ИМЯ*"/></span><span
                                                            class="wpcf7-form-control-wrap email-771"><input type="email"
                                                                                                             name="email-771"
                                                                                                             value=""
                                                                                                             size="40"
                                                                                                             class="wpcf7-form-control wpcf7-text wpcf7-email wpcf7-validates-as-required wpcf7-validates-as-email"
                                                                                                             aria-required="true"
                                                                                                             aria-invalid="false"
                                                                                                             placeholder="ВАШ EMAIL*"/></span><span
                                                            class="wpcf7-form-control-wrap your-message"><textarea
                                                                name="your-message" cols="40" rows="2"
                                                                class="wpcf7-form-control wpcf7-textarea"
                                                                aria-invalid="false" placeholder="ВАШЕ СООБЩЕНИЕ"></textarea></span><span
                                                            class="required">*Пожалуйста, заполните все поля корректно</span><input
                                                            type="submit" value="Отправить сообщение"
                                                            class="wpcf7-form-control wpcf7-submit btn btn-black no-margin-bottom no-margin-lr"/>
                                                </div>
                                                <div class="wpcf7-response-output wpcf7-display-none"></div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div
                                    class="wpb_column hcode-column-container  col-xs-mobile-fullwidth col-sm-6 padding-ten-lr xs-padding-ten"
                                    style=" background:#ef824c;">
                                <div class="vc-column-innner-wrapper">
                                    <div class="agency2-onepage "><span><i class="fa fa-map-marker"></i></span><strong>
                                            Моё местоположение
                                        </strong>
                                        <div><p>РФ, Амурская область, г.Благовещенск.</p></div>
                                    </div>
                                    <div class="agency2-onepage "><span><i class="fa fa-envelope"></i></span>
                                        <strong>Контактные данные</strong>
                                        <div><p><a href="mailto:gsu1234@mail.ru">gsu1234@mail.ru</a></p></div>
                                    </div>
                                    <div class="agency2-onepage "><span><i class="fa fa-phone"></i></span><strong>Skype</strong>
                                        <div><p>gsu_resident234</p></div>
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
