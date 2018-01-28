<?php
/**
 * Created by PhpStorm.
 * User: GSU
 * Date: 15.07.2017
 * Time: 20:27
 */

require $_SERVER['DOCUMENT_ROOT'] . '/wp-load.php';
include $_SERVER['DOCUMENT_ROOT'] . '/includes/head.php';

global $wpdb;
$wpdb->set_prefix('portfolio_');
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
<body class="page-template-default page page-id-113 wpb-js-composer js-comp-ver-5.1 vc_responsive">
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
<section
    class="content-top-margin page-title-section page-title page-title-small
    border-bottom-light border-top-light bg-white">
    <div class="container">
        <div class="row">
            <div class="col-lg-8 col-md-7 col-sm-12 animated fadeInUp">
                <h1 class="black-text">Ссылки</h1>
            </div>
            <div class="col-lg-4 col-md-5 col-sm-12 breadcrumb text-uppercase wow
            fadeInUp xs-display-none"
                 data-wow-duration="600ms">
                <ul class="breadcrumb-gray-text">
                    <li><a href="/"
                           title="Browse to: Home">Главная</a></li>
                    <li>Ссылки</li>
                </ul>
            </div>
        </div>
    </div>
</section>
<section class="parent-section no-padding post-113 page type-page status-publish hentry">
    <div class="container-fluid">
        <div class="row">
            <h2 class="entry-title display-none">Ссылки</h2>
            <div class="entry-content">






                <section class="  wow fadeIn no-padding">
                    <div class="container-fluid">
                        <div class="row flex-outer">



                            <?php


                            $categoryId = PORTFOLIO_WP_CATEGORY_LINKS_ID;

                            $args = array(
                                'numberposts' => 400,
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
                                $imageMeta = get_post_meta($post->ID, 'PREVIEW_IMAGE_2', true);
                                $URL = get_post_meta($post->ID, 'URL', true);

                                ?>


                                <div
                                    class="wpb_column hcode-column-container
                                    col-lg-3 col-md-4 col-xs-mobile-fullwidth col-sm-6
                                    no-padding flex-inner">
                                    <div class="vc-column-innner-wrapper">
                                        <div class="client-main position-relative
                                        overflow-hidden "><img alt=""

                                                               data-image="<?php echo $imageMeta; ?>"
                                                               class="js-img"
                                                               src=""
                                                                                                         width="800"
                                                                                                         height="450">
                                            <div class="client-text position-absolute display-block bg-white text-center">
                                                <p
                                                    class="margin-five center-col no-margin-top">
                                                    <?php echo $post->post_title; ?>
                                                </p> <a
                                                    class="highlight-button-dark btn btn-very-small margin-three no-margin"
                                                    href="<?php echo $URL; ?>"
                                                    target="_self">перейти</a></div>
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
            </div>
        </div>
    </div>
</section>
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