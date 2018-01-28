<?php
/**
 * Created by PhpStorm.
 * User: GSU
 * Date: 29.07.2017
 * Time: 13:56
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
    class="portfolio-template-default single single-portfolio postid-14573 single-format-standard wpb-js-composer js-comp-ver-5.1 vc_responsive">
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
<section class="content-top-margin page-title-section page-title page-title-small bg-gray">
    <div class="container">
        <div class="row">
            <div class="col-lg-8 col-md-7 col-sm-12 animated fadeInUp"><h1 class="black-text">
                    <?php echo $arProject["post_title"]; ?>
                </h1></div>
            <div class="col-lg-4 col-md-5 col-sm-12 breadcrumb text-uppercase wow fadeInUp xs-display-none"
                 data-wow-duration="600ms">
                <ul class="breadcrumb-gray-text">
                    <li><a href="/" title="Browse to: Home">Главная</a></li>
                    <li>Портфолио</li>
                    <li><?php echo $arProject["post_title"]; ?></li>
                </ul>
            </div>
        </div>
    </div>
</section>
<section
    class=" post-14573 portfolio type-portfolio status-publish format-standard has-post-thumbnail hentry portfolio-category-sample portfolio-tags-left">
    <div class="container col2-layout">
        <div class="row">
            <div class="col-md-8 col-sm-8 col-xs-12 col-md-offset-1 xs-margin-bottom-seven pull-right xs-pull-none">
                <section class="no-padding">
                    <div class="container">
                        <div class="row">
                            <div class="gallery-img margin-bottom-30px"><img
                                    src="" data-image="<?php echo $thimbnailProjectImage; ?>"
                                    width="1240"
                                    class="js-img" alt=""></div>
                        </div>
                    </div>
                </section>
                <div class="blog-details-text portfolio-single-content">
                    <div class="entry-content">
                        <section class="  no-padding">
                            <div class="wpb_column hcode-column-container  col-xs-mobile-fullwidth">
                                <div class="vc-column-innner-wrapper">
                                    <?php foreach($arProjectAllImages as $image){ ?>
                                    <img
                                        src="" data-image="<?php echo $image; ?>"
                                        width="1240"  class="js-img margin-bottom-45px" alt="">
                                    <?php } ?>
                                </div>
                            </div>
                            <div class="wpb_column hcode-column-container  col-xs-mobile-fullwidth">
                                <div class="vc-column-innner-wrapper">
                                    <p class="text-large">
                                        <?php echo $arProject["post_title"]; ?>
                                    </p>
                                    <p>
                                        <?php echo $arProject["post_content_formatted"]; ?>
                                    </p>
                                    <blockquote class=" blog-image"
                                                style=" background: none repeat scroll 0 0 #f6f6f6;"><p></p>
                                        <p>
                                            <?php echo randomText()[0]; ?>
                                        </p>
                                        <p></p>
                                        <?php if($ProjectURL){ ?>
                                            <footer><a href="<?php echo $ProjectURL; ?>" target="_blank">
                                                    <?php echo $ProjectURL; ?>
                                                </a></footer>
                                        <?php } ?>
                                    </blockquote>

                                    <div class="hcode-divider margin-five-top"
                                         style="border-bottom: 1px solid #e5e5e5;"></div>
                                </div>
                            </div>
                        </section>
                    </div>
                    <section class="padding-top-40px no-padding-bottom clear-both">
                        <div class="container">
                            <div class="row">
                                <div class="col-md-12 col-sm-12 text-center no-padding">
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
                                class="text-center padding-four-top padding-four-bottom col-md-12
                                col-sm-12 col-xs-12 no-padding-lr">

                            </div>
                        </div>
                    </div>
                </section>
            </div>
            <div class="col-md-3 col-sm-4 col-xs-12 sidebar pull-left">
                <?php
                include $_SERVER['DOCUMENT_ROOT'] . '/includes/detail_widget_categories.php';
                ?>
                <?php
                include $_SERVER['DOCUMENT_ROOT'] . '/includes/detail_widget_hcode_recent_widget.php';
                ?>
                <?php
                include $_SERVER['DOCUMENT_ROOT'] . '/includes/detail_widget_text.php';
                ?>
            </div>
        </div>
    </div>
</section>
<div class="wpb_column hcode-column-container col-md-12 no-padding">
    <div class="hcode-divider border-top sm-padding-five-top xs-padding-five-top padding-five-bottom"></div>
</div>


<?php
include $_SERVER['DOCUMENT_ROOT'] . '/includes/detail_grid-gallery_3-elements.php';
?>

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
