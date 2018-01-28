<?php
/**
 * Created by PhpStorm.
 * User: GSU
 * Date: 23.07.2017
 * Time: 23:42
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
<body class="page-template-default page page-id-35 wpb-js-composer js-comp-ver-5.1 vc_responsive">
<nav
    class="navbar navbar-default navbar-fixed-top nav-transparent overlay-nav sticky-nav transparent-header nav-border-bottom  nav-black "
    data-menu-hover-delay="100">
    <div class="container">
        <div class="row">
            <?php
            include $_SERVER['DOCUMENT_ROOT'] . '/includes/head_logo_dark.php';
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
<section class="parent-section no-padding post-35 page type-page status-publish hentry">
    <div class="container-fluid">
        <div class="row">
            <div class="entry-content">
                <section class="  no-padding">
                    <div class="container-fluid">
                        <div class="row">
                            <div class="wpb_column hcode-column-container  col-xs-mobile-fullwidth">
                                <div class="vc-column-innner-wrapper">
                                    <div id="owl-slider-half-screen"
                                         class="owl-carousel owl-theme owl-half-slider  round-pagination dark-pagination light-navigation cursor-black owl-slider-half-screen hcode-owl-slider9 ">

                                        <?php $i = 1; ?>
                                        <?php foreach($arProjectAllImages as $image){ ?>

                                        <div class="item owl-bg-img js-background"
                                             style="background-image:url()"
                                             data-image="<?php echo $image; ?>">
                                            <div class="container position-relative">
                                                <div class="slider-typography text-left">
                                                    <div class="slider-text-middle-main">
                                                        <div
                                                            class="slider-text-middle
                                                             padding-left-right-px animated
                                                             fadeInUp">
                                                            <p><span class="owl-subtitle
                                                            black-text ">
                                                                    <?php echo get_post_meta($arProject["ID"], 'YEAR')[0]; ?>
                                                                </span>
                                                            </p> <span class="owl-title
                                                            black-text">
                                                                <?php if($i == 1)  echo $arProject["post_title"];
                                                                else displayRandomElement($arPostTagsNames); ?>
                                                            </span><a
                                                                class="highlight-button-black-border btn btn-small inner-link"
                                                                href="/projects/"
                                                                target="_self">Все проекты</a></div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                            <?php $i++; } ?>

                                    </div>
                                    <script type="text/javascript">/*<![CDATA[*/
                                        jQuery(document).ready(function () {
                                            jQuery("#owl-slider-half-screen").owlCarousel({
                                                navigation: true,
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
                <?php
                include $_SERVER['DOCUMENT_ROOT'] . '/includes/detail-home-big-content-block.php';
                ?>
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
