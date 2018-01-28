<?php
/**
 * Created by PhpStorm.
 * User: GSU
 * Date: 29.07.2017
 * Time: 13:55
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
    class="portfolio-template-default single single-portfolio postid-14574 single-format-standard wpb-js-composer js-comp-ver-5.1 vc_responsive">
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
<section class="page-title parallax3 parallax-fix page-title-large">
    <img class="parallax-background-img"

         src="<?php displayRandomElement($arProjectAllImages); ?>"
                                                                         alt="Portfolio Full Width"/>
    <div class="opacity-medium bg-black"></div>
    <div class="container">
        <div class="row">
            <div class="col-md-12 col-sm-12 text-center animated fadeInUp">
                <div class="separator-line bg-yellow no-margin-top margin-four"></div>
                <h1 class="white-text"><?php echo $arProject["post_title"];?></h1>
                <span class="white-text">
                    <?php echo implode(" ", $arPostTagsNames); ?>
                </span>
            </div>
        </div>
    </div>
</section>
<section
    class="no-padding post-14574 portfolio type-portfolio status-publish format-standard
    has-post-thumbnail hentry portfolio-category-sample portfolio-tags-fullwidth">
    <div class="container-fluid">
        <div class="row">
            <section class="no-padding-bottom">
                <div class="container">
                    <div class="row">
                        <div class="col-md-12">

                            <?php foreach($arProjectAllImages as $image){ ?>
                            <div class="gallery-img margin-bottom-30px"><img
                                    src="" data-image="<?php echo $image; ?>" class="js-img"
                                    width="1240" alt=""></div>
                                <?php } ?>

                        </div>
                    </div>
                </div>
            </section>
            <div class="blog-details-text portfolio-single-content">
                <div class="entry-content">
                    <section class="  no-padding">
                        <div class="container">
                            <div class="row">
                                <div class="wpb_column hcode-column-container 1 col-md-12 col-xs-mobile-fullwidth">
                                    <div class="vc-column-innner-wrapper">
                                        <img
                                            src="" class="js-img"
                                            data-image="<?php displayRandomElement($arProjectAllImages);?>"
                                            width="1240" alt="">
                                        <img
                                                src=""
                                                data-image="<?php displayRandomElement($arProjectAllImages);?>"
                                                width="1240" class="js-img margin-tb-30px" alt="">
                                    </div>
                                </div>


                                <?php
                                include $_SERVER['DOCUMENT_ROOT'] . '/includes/detail_project_tags_statistics_3-elements.php';
                                ?>


                            </div>
                        </div>
                    </section>
                    <section id="features" class="  margin-five" style=" background-color:#000000; ">
                        <div class="container">
                            <div class="row">
                                <div
                                    class="wpb_column hcode-column-container  col-md-7 col-xs-mobile-fullwidth col-sm-10 text-center center-col">
                                    <div class="vc-column-innner-wrapper">
                                        <div class="text-large "><h6 class="no-margin-top  wow fadeIn"
                                                                     style="color:#ffffff !important">
                                                <?php echo implode(" + ", $arPostTagsNames); ?>
                                            </h6>
                                            <p class="no-margin-bottom  wow fadeIn" style="color:#7f7f7f !important">
                                                <?php echo randomText()[0]; ?>
                                            </p></div>
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
                                            class="section-title  black-text no-padding">
                                            Информация о проекте
                                        </h6></div>
                                </div>
                                <div
                                    class="wpb_column hcode-column-container  col-md-7 col-xs-mobile-fullwidth col-sm-10 text-center center-col margin-five-top">
                                    <div class="vc-column-innner-wrapper">
                                        <div class="text-med">
                                            <?php echo $arProject["post_content_formatted"];?>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </section>
                    <section class="  no-padding-bottom">
                        <div class="container">
                            <div class="row">
                                <div
                                    class="wpb_column hcode-column-container  col-xs-mobile-fullwidth col-sm-12 no-padding">
                                    <div class="vc-column-innner-wrapper">
                                        <div class="work-3col">
                                            <div class="col-md-12 grid-gallery overflow-hidden ">
                                                <ul class="grid masonry-items lightbox-gallery">

                                                    <?php foreach($arProjectAllImages as $image){ ?>
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
                                                                        src="<?php echo $image; ?>" class="js-img"
                                                                        data-image="<?php echo $fileNew; ?>"
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
                </div>
                <section class="padding-top-40px no-padding-bottom">
                    <div class="container">
                        <div class="row">
                            <div class="col-md-12 col-sm-12 text-center">
                                <div class="blog-date no-padding-top">
                                    <?php echo implode(" | ", $arPostTagsNames); ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
            </div>
            <section class="no-padding">
                <div class="container">
                    <div class="row">
                        <div
                            class="col-md-12 col-sm-12 col-xs-12 margin-five-bottom sm-margin-eight-bottom xs-margin-five-bottom">
                            <div
                                class="text-center padding-four-top padding-four-bottom col-md-12 col-sm-12 col-xs-12 no-padding-lr">
                                </div>
                        </div>
                    </div>
                </div>
            </section>
        </div>
    </div>
</section>
<div class="wpb_column hcode-column-container col-md-12 no-padding">
    <div class="hcode-divider border-top sm-padding-five-top xs-padding-five-top padding-five-bottom"></div>
</div>
<section class="clear-both no-padding-top">
    <div class="container">
        <div class="row">
            <div class="col-md-12 col-sm-12 text-center">
                <h3 class="section-title">Реализованные проекты</h3></div>
            <div class="work-3col gutter work-with-title ipad-3col">
                <div class="col-md-12 grid-gallery overflow-hidden content-section">
                    <div class="tab-content">
                        <ul class="grid masonry-items">


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

                            $fileNew = cropImage($filename,
                                $_SERVER['DOCUMENT_ROOT'] . $fileNew,
                                374, 234);
                            ?>

                            <li class="portfolio-id-14579 post-14579 portfolio type-portfolio status-publish
                            format-standard has-post-thumbnail hentry portfolio-category-sample portfolio-tags-both-sidebar">
                                <figure>
                                    <div class="gallery-img"><a
                                            href="/detail/<?php echo $arDetailTemplates[wp_rand(0, count($arDetailTemplates) - 1)]; ?>?ID=<?php echo $post->ID; ?>"><img
                                                src="" class="js-img" data-image="<?php echo $fileNew; ?>"
                                                width="374" height="234" alt=""/></a></div>
                                    <figcaption><h3 class="entry-title"><a
                                                href="/detail/<?php echo $arDetailTemplates[wp_rand(0, count($arDetailTemplates) - 1)]; ?>?ID=<?php echo $post->ID; ?>">
                                                <?php echo $post->post_title; ?>
                                            </a></h3>
                                        <p><?php echo implode(" ", $arCurrentPostTagsNames); ?></p>
                                    </figcaption>
                                </figure>
                            </li>

                                <?php
                                if($i == 3) break;
                                $i++;

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
