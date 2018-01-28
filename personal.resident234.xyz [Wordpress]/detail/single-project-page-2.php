<?php
/**
 * Created by PhpStorm.
 * User: GSU
 * Date: 29.07.2017
 * Time: 14:49
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
<body
    class="portfolio-template-default single single-portfolio postid-9811 single-format-image wpb-js-composer js-comp-ver-5.1 vc_responsive">
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
<section class="page-title parallax6 parallax-fix page-title-large">
    <img class="parallax-background-img js-background"

         data-image="<?php displayRandomElement($arProjectAllImages); ?>"
         src="<?php displayRandomElement($arProjectAllImages); ?>"
                                                                         alt=""/>
    <div class="container">
        <div class="row">
            <div class="col-md-12 col-sm-12 text-center animated fadeInUp">
                <div class="separator-line bg-yellow no-margin-top margin-four"></div>
                <h1 class="black-text"><?php echo $arProject["post_title"];?></h1>
                <span class="text-uppercase gray-text"><?php echo implode(" / ", $arPostTagsNames); ?></span>
            </div>
        </div>
    </div>
</section>
<section
    class="no-padding post-9811 portfolio type-portfolio status-publish format-image hentry portfolio-category-portfolio-related">
    <div class="container-fluid">
        <div class="row">
            <div class="blog-details-text portfolio-single-content">
                <div class="entry-content">
                    <section>
                        <div class="container">
                            <div class="row">
                                <div
                                    class="wpb_column hcode-column-container  col-md-6 col-xs-mobile-fullwidth col-sm-10 text-center center-col">
                                    <div class="vc-column-innner-wrapper">
                                        <div class="text-large "><h6 class="no-margin-top  wow fadeIn">
                                                <?php echo implode(" + ", $arPostTagsNames); ?>
                                            </h6>
                                            <p class="no-margin-bottom  wow fadeIn">
                                                <?php echo randomText()[0]; ?>
                                            </p></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </section>
                    <section class="  no-padding-top">
                        <div class="container">
                            <div class="row">
                                <div class="wpb_column hcode-column-container  col-md-12 col-xs-mobile-fullwidth">
                                    <div class="vc-column-innner-wrapper">
                                        <?php foreach($arProjectAllImages as $image){ ?>
                                            <?php
                                            $filename = $image;
                                            $new_filen = $_SERVER["DOCUMENT_ROOT"].'/wp-content/uploads/' . basename($filename);


                                            $fileNew = "/wp-content/uploads/" . basename($filename);

                                            $fileNew = cropImage($filename,
                                                $_SERVER['DOCUMENT_ROOT'] . $fileNew,
                                                1200, 800);
                                            ?>

                                                <img alt="" class="js-img"
                                                     data-image="<?php echo $fileNew; ?>"


                                                     src=""
                                                     width="1200"
                                                     height="800">
                                            <?php

                                        }
                                        ?>


                                    </div>
                                </div>
                            </div>
                        </div>
                    </section>
                    <section class="  no-padding">
                        <div class="container">
                            <div class="row">
                                <div
                                    class="wpb_column hcode-column-container  col-md-12 col-xs-mobile-fullwidth col-sm-12 text-center">
                                    <div class="vc-column-innner-wrapper"><h6
                                            class="section-title  black-text no-padding">Информация о проекте</h6></div>
                                </div>
                                <div
                                    class="wpb_column hcode-column-container  col-md-7 col-xs-mobile-fullwidth col-sm-10 text-center center-col margin-five-top">
                                    <div class="vc-column-innner-wrapper">
                                        <div class="text-med">
                                            <?php echo $arProject["post_content_formatted"]; ?>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </section>
                    <section>
                        <div class="container">
                            <div class="row">
                                <div
                                    class="wpb_column hcode-column-container  col-xs-mobile-fullwidth col-sm-12 no-padding">
                                    <div class="vc-column-innner-wrapper">
                                        <div class="work-3col">
                                            <div class="col-md-12 grid-gallery overflow-hidden ">




                                                <ul class="grid masonry-items lightbox-gallery">

                                                    <?php foreach ($arProjectImages as $image) { ?>
                                                        <?php
                                                        $filename = $image;
                                                        $new_filen = $_SERVER["DOCUMENT_ROOT"].'/wp-content/uploads/' . basename($filename);


                                                        $fileNew = "/wp-content/uploads/" . basename($filename);

                                                        $fileNew = cropImage($filename,
                                                            $_SERVER['DOCUMENT_ROOT'] . $fileNew,
                                                            800, 500);
                                                        ?>
                                                        <li class=""><a
                                                                    href="<?php echo $image; ?>"
                                                                    class="lightboxgalleryitem" data-group="default"><img
                                                                        src="<?php echo $fileNew; ?>"
                                                                        alt="" width="800" height="500"></a></li>
                                                    <?php } ?>


                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </section>
                    <section class="  no-padding-top">
                        <div class="container">
                            <div class="row">
                                <div
                                    class="wpb_column hcode-column-container  col-md-6 col-xs-mobile-fullwidth col-sm-6 center-col">
                                    <div class="vc-column-innner-wrapper">
                                        <div class="spend-year"><span class="year">Год</span><?php echo $YEAR; ?></div>
                                        <div class="spend-time no-border"><span class="hours">Клиент</span>
                                            <?php echo $ProjectCLIENT; ?></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </section>
                </div>
            </div>
            <section class="no-padding">
                <div class="container">
                    <div class="row"></div>
                </div>
            </section>
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
