<?php
/**
 * Created by PhpStorm.
 * User: GSU
 * Date: 29.07.2017
 * Time: 12:51
 */
require $_SERVER['DOCUMENT_ROOT'] . '/wp-load.php';
include $_SERVER['DOCUMENT_ROOT'] . '/includes/head.php';

global $wpdb;
$wpdb->set_prefix('portfolio_');

include $_SERVER['DOCUMENT_ROOT'] . '/includes/head_detail.php';
include $_SERVER['DOCUMENT_ROOT'] . '/includes/feedback_send.php';
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
<body class="page-template-default page page-id-126 wpb-js-composer js-comp-ver-5.1 vc_responsive">
<nav class="navbar navbar-default navbar-fixed-top nav-transparent overlay-nav sticky-nav transparent-header nav-border-bottom  nav-white "
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
<section class="page-title parallax3 parallax-fix page-title-large"><img
            class="parallax-background-img js-img"

            src="<?php displayRandomElement($arProjectAllImages); ?>"
            data-image="<?php displayRandomElement($arProjectAllImages); ?>"

            alt=""/>
    <div class="opacity-medium bg-black"></div>
    <div class="container">
        <div class="row">
            <div class="col-md-12 col-sm-12 text-center animated fadeInUp">
                <div class="separator-line bg-yellow no-margin-top margin-four"></div>
                <h1 class="white-text"><?php echo $arProject["post_title"]; ?></h1>
                <span class="white-text"><?php echo implode(" ", $arPostTagsNames); ?></span>
            </div>
        </div>
    </div>
</section>

<?php
$arContent = preg_split('/[\n.]/u', $arProject["post_content"], -1, PREG_SPLIT_NO_EMPTY);
$arContentBlock = array_chunk($arContent, round(count($arContent)/3));
?>
<section class="parent-section  post-126 page type-page status-publish hentry">
    <div class="container col2-layout">
        <div class="row">
            <div class="col-md-8 col-sm-8 col-xs-12 col-md-offset-1 xs-margin-bottom-seven pull-right xs-pull-none"><h2
                        class="entry-title display-none">Page &#8211; Left Sidebar</h2>
                <div class="entry-content">
                    <section class="  no-padding">
                        <div class="container">
                            <div class="row">
                                <div class="wpb_column hcode-column-container  col-md-6 col-xs-mobile-fullwidth col-sm-12 no-padding-left sm-no-padding xs-no-padding">
                                    <div class="vc-column-innner-wrapper">
                                        <img alt=""
                                             src=""
                                             data-image="<?php displayRandomElement($arProjectAllImages); ?>"
                                             class="js-img"
                                             width="800"><br><br>
                                        <p class="text-large">
                                            <?php displayRandomElement($arPostTagsNames); ?>
                                        </p>
                                        <div class="wide-separator-line no-margin-lr"></div>
                                        <p class="text-med no-margin-bottom
                                        sm-margin-bottom-seven">

                                            <?php if($arContentBlock[0]) echo implode("\n", $arContentBlock[0]); ?>
                                        </p></div>
                                </div>
                                <div class="wpb_column hcode-column-container  col-md-6 col-xs-mobile-fullwidth col-sm-12 no-padding-right sm-no-padding xs-no-padding">
                                    <div class="vc-column-innner-wrapper">
                                        <img alt=""
                                             src=""
                                             data-image="<?php displayRandomElement($arProjectAllImages); ?>"
                                             class="js-img"
                                             width="800"><br><br>
                                        <p class="text-large">
                                            <?php displayRandomElement($arPostTagsNames); ?>
                                        </p>
                                        <div class="wide-separator-line no-margin-lr"></div>
                                        <p class="text-med no-margin-bottom sm-margin-bottom-seven">

                                            <?php if($arContentBlock[1]) echo implode("\n", $arContentBlock[1]); ?>
                                        </p></div>
                                </div>
                                <div class="wpb_column hcode-column-container  col-xs-mobile-fullwidth col-sm-12 no-padding margin-ten sm-no-margin-top">
                                    <div class="vc-column-innner-wrapper">
                                        <blockquote class=" blog-image"
                                                    style=" background: none repeat scroll 0 0 #f6f6f6;"><p>
                                                <?php echo randomText()[0]; ?>
                                            </p>
                                            <p></p>
                                            <?php if($ProjectURL){ ?>
                                            <footer><a href="<?php echo $ProjectURL; ?>" target="_blank">
                                                    <?php echo $ProjectURL; ?>
                                                </a></footer>
                                            <?php } ?>
                                        </blockquote>
                                    </div>
                                </div>
                                <div class="wpb_column hcode-column-container  col-md-12 col-xs-mobile-fullwidth col-sm-12 no-padding">
                                    <div class="vc-column-innner-wrapper">


                                        <?php foreach($arProjectAllImages as $image){ ?>
                                        <img alt=""
                                             data-image="<?php echo $image; ?>"
                                             src=""
                                             class="js-img"
                                             width="1200"><br><br>
                                        <?php } ?>


                                        <p class="text-large">
                                            <?php echo $YEAR; ?>
                                        </p>
                                        <div class="wide-separator-line no-margin-lr"></div>
                                        <p class="text-med no-margin-bottom">

                                            <?php if($arContentBlock[2]) echo implode("\n", $arContentBlock[2]); ?>
                                        </p></div>
                                </div>
                            </div>
                        </div>
                    </section>
                </div>
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
