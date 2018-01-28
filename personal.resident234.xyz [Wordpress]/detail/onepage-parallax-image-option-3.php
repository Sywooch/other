<?php
/**
 * Created by PhpStorm.
 * User: GSU
 * Date: 29.07.2017
 * Time: 13:38
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
<body class="page-template-default page page-id-56 wpb-js-composer js-comp-ver-5.1 vc_responsive">
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
                    <ul id="menu-onepage" class="mega-menu-ul nav navbar-nav navbar-right panel-group">
                        <?php
                        include $_SERVER['DOCUMENT_ROOT'] . '/includes/main_menu.php';
                        ?>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</nav>
<section class="parent-section no-padding post-56 page type-page status-publish hentry">
    <div class="container-fluid">
        <div class="row">
            <div class="entry-content">
                <section id="slider" class="  parallax-fix parallax2 full-screen position-relative
                js-background no-padding"
                         style=" background-image: url(); "
                         data-image="<?php displayRandomElement($arProjectAllImages); ?>">
                    <div class="container">
                        <div class="row">
                            <div class="wpb_column hcode-column-container  col-xs-mobile-fullwidth">
                                <div class="vc-column-innner-wrapper">
                                    <div class=" full-screen">
                                        <div class="slider-typography">
                                            <div class="slider-text-middle-main">
                                                <div class="slider-text-middle slider-text-middle3 animated fadeInUp">
                                                    <span class="slider-subtitle3 white-text"
                                                          style="color:#ffffff;border-color:#ffffff">
                                                        <?php echo implode(" ", $arPostTagsNames); ?>
                                                    </span><br>
                                                    <div class="slider-title-big3 black-text bg-fast-yellow">
                                                        <?php echo $arProject["post_title"]; ?>
                                                    </div>
                                                    <br><a class="btn-small-white btn margin-lr-10px margin-five-top no-margin-bottom inner-link"
                                                           href="#features">Далее</a><a
                                                            class="btn-small-white btn margin-lr-10px margin-five-top no-margin-bottom inner-link"
                                                            href="<?php echo $ProjectURL; ?>">Подробнее</a></div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="scroll-down"><a href="#features" class="inner-link"><i
                                                class="fa fa-angle-down bg-white black-text"></i></a></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
                <section id="features">
                    <div class="container">
                        <div class="row">
                            <?php
                            include $_SERVER['DOCUMENT_ROOT'] . '/includes/detail_iterations__title.php';
                            ?>
                            <div class="wpb_column hcode-column-container  col-md-12 col-xs-mobile-fullwidth col-sm-12">
                                <div class="vc-column-innner-wrapper">
                                    <div class="wide-separator-line margin-eight no-margin-lr"
                                         style=" background:#e5e5e5;"></div>
                                </div>
                            </div>
                            <?php
                            include $_SERVER['DOCUMENT_ROOT'] . '/includes/detail_other_projects__key-person.php';
                            ?>
                        </div>
                    </div>
                </section>
                <?php
                include $_SERVER['DOCUMENT_ROOT'] . '/includes/detail_button_portfolio__btn-extra-large.php';
                ?>


                <?php
                include $_SERVER['DOCUMENT_ROOT'] . '/includes/detail_projects__approach-slider__pagination-false__items-4__stopOnHover-true.php';
                ?>


                <?php
                include $_SERVER['DOCUMENT_ROOT'] . '/includes/detail_animated-tab.php';
                ?>



                <?php
                include $_SERVER['DOCUMENT_ROOT'] . '/includes/detail_chart-percent.php';
                ?>
                <?php
                include $_SERVER['DOCUMENT_ROOT'] . '/includes/detail_portfolio__title__random-text__800-600__big_1-3.php';
                ?>
                <?php
                include $_SERVER['DOCUMENT_ROOT'] . '/includes/portfolio_development-stage.php';
                ?>

                <?php
                include $_SERVER['DOCUMENT_ROOT'] . '/includes/detail_testimonial_projects.php';
                ?>

                <?php
                include $_SERVER['DOCUMENT_ROOT'] . '/includes/detail_section_projects.php';
                ?>

                <?php
                include $_SERVER['DOCUMENT_ROOT'] . '/includes/detail_section_projects-thimb.php';
                ?>

                <?php
                include $_SERVER['DOCUMENT_ROOT'] . '/includes/detail_contact-us.php';
                ?>
                <?php
                include $_SERVER['DOCUMENT_ROOT'] . '/includes/detail_parallax-fix_parallax3.php';
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
