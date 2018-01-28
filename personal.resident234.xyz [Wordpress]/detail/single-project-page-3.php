<?php
/**
 * Created by PhpStorm.
 * User: GSU
 * Date: 29.07.2017
 * Time: 14:50
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
        class="portfolio-template-default single single-portfolio postid-9814 single-format-image wpb-js-composer js-comp-ver-5.1 vc_responsive">
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
<section
        class="no-padding post-9814 portfolio type-portfolio status-publish format-image hentry portfolio-category-portfolio-related">
    <div class="container-fluid">
        <div class="row">
            <div class="blog-details-text portfolio-single-content">
                <div class="entry-content">
                    <section class="  no-padding">
                        <div class="container-fluid">
                            <div class="row">
                                <div class="wpb_column hcode-column-container  col-xs-mobile-fullwidth">
                                    <div class="vc-column-innner-wrapper">
                                        <div id="hcode-owl-slider17"
                                             class="owl-carousel owl-theme  round-pagination dark-pagination dark-navigation cursor-black  hcode-owl-slider17 ">

                                            <?php foreach ($arProjectAllImages as $image) { ?>

                                                <div class="item owl-bg-img full-screen js-background"
                                                     data-image="<?php echo $image; ?>"
                                                     style="background-image:url()"></div>
                                            <?php } ?>
                                        </div>
                                        <script type="text/javascript">/*<![CDATA[*/
                                            jQuery(document).ready(function () {
                                                jQuery("#hcode-owl-slider17").owlCarousel({
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
                    <?php
                    $arContent = preg_split('/[\n.]/u', $arProject["post_content"], -1, PREG_SPLIT_NO_EMPTY);
                    $arContentBlock = array_chunk($arContent, round(count($arContent) / 3));

                    ?>
                    <section>
                        <div class="container">
                            <div class="row">
                                <div
                                        class="wpb_column hcode-column-container  col-md-6 col-xs-mobile-fullwidth col-sm-12 sm-margin-eight-bottom">
                                    <div class="vc-column-innner-wrapper"><h6
                                                class="section-title  margin-three-bottom black-text no-padding">
                                            Информация о проекте
                                        </h6>
                                        <p><?php if ($arContentBlock[0]) {
                                                echo implode("\n", $arContentBlock[0]);
                                            } ?></p></div>
                                </div>
                                <div
                                        class="wpb_column hcode-column-container  col-md-6 col-xs-mobile-fullwidth col-sm-12">
                                    <div class="vc-column-innner-wrapper"><h6
                                                class="section-title  margin-three-bottom black-text no-padding">
                                            Информация о проекте
                                        </h6>
                                        <p><?php if ($arContentBlock[1]) {
                                                echo implode("\n", $arContentBlock[1]);
                                            } ?></p></div>
                                </div>
                            </div>
                        </div>
                    </section>
                    <section class="  cover-background js-background"
                             style=" background-image: url(); "
                             data-image="<?php displayRandomElement($currentBackgroundImage); ?>">
                        <div class="selection-overlay" style=" opacity:0.7; background-color:#252525;"></div>
                        <div class="container">
                            <div class="row">
                                <div
                                        class="wpb_column hcode-column-container  col-md-7 col-xs-mobile-fullwidth col-sm-10 text-center center-col">
                                    <div class="vc-column-innner-wrapper">
                                        <div class="text-large "><h6 class="no-margin-top "
                                                                     style="color:#ffffff !important">
                                                <?php echo implode(" + ", $arPostTagsNames); ?></h6>
                                            <p class="no-margin-bottom " style="color:#ffffff !important">
                                                <?php echo randomText()[0]; ?>
                                            </p></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </section>
                    <section class="  no-padding-bottom">
                        <div class="container">
                            <div class="row">
                                <div
                                        class="wpb_column hcode-column-container  col-md-7 col-xs-mobile-fullwidth text-center center-col margin-ten-bottom">
                                    <div class="vc-column-innner-wrapper"><h6
                                                class="section-title  margin-three-bottom black-text no-padding">
                                            Информация о проекте
                                        </h6>
                                        <div class="text-med">
                                            <?php if ($arContentBlock[2]) {
                                                echo implode("\n", $arContentBlock[2]);
                                            } ?>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </section>
                    <section class="  cover-background js-background"
                             style=" background-image: url(); "
                             data-image="<?php displayRandomElement($currentBackgroundImage); ?>">
                        <div class="selection-overlay" style=" opacity:0.7; background-color:#252525;"></div>
                        <div class="container">
                            <div class="row">
                                <div class="wpb_column hcode-column-container  col-xs-mobile-fullwidth">
                                    <div class="vc-column-innner-wrapper">
                                        <div id="hcode-owl-slider20"
                                             class="owl-carousel owl-theme  round-pagination dark-pagination dark-navigation cursor-black  hcode-owl-slider20 ">


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


                                                ?>
                                                <div
                                                        class="item col-md-6 col-xs-10 bg-white padding-seven great-result center-col text-center">
                                                    <h6 class="margin-five no-margin-top text-uppercase black-text">
                                                        <strong>
                                                            <?php echo $post->post_title; ?>
                                                        </strong></h6>
                                                    <div class="separator-line bg-yellow margin-ten"></div>
                                                    <p class="margin-ten text-large no-margin-top">
                                                        <?php echo implode(" ", $arCurrentPostTagsNames); ?>
                                                    </p>
                                                    <p class="margin-ten">
                                                        <?php
                                                        $post_content = preg_replace("/\\[.+\\]/m","",
                                                            $post->post_content);
                                                        //$post_content = str_replace("\n","<br>",
                                                        //    $post_content);

                                                        echo kama_excerpt( array('text'=>$post_content, 'maxchar'=>300,
                                                            'autop' => false) );

                                                        ?>
                                                    </p></div>
                                                <?php

                                            }
                                            wp_reset_postdata(); // сброс
                                            ?>

                                        </div>
                                        <script type="text/javascript">/*<![CDATA[*/
                                            jQuery(document).ready(function () {
                                                jQuery("#hcode-owl-slider20").owlCarousel({
                                                    navigation: false,
                                                    pagination: true,
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
<section>
    <div class="container">
        <div class="row">

            <?php foreach ($arProjectAllImages as $image) { ?>

                <div
                        class="wpb_column hcode-column-container  col-md-12
                                            col-xs-mobile-fullwidth col-sm-12">
                    <div class="vc-column-innner-wrapper">
                        <img
                                data-image="<?php echo $image; ?>"
                                src=""
                                width="1200" class="js-img padding-bottom-15px" alt="">
                    </div>
                </div>
            <?php } ?>


        </div>
    </div>
</section>
<section class="  fix-background js-background"
         style=" background-image: url(); "
         data-image="<?php displayRandomElement($currentBackgroundImage); ?>">
    <div class="selection-overlay" style=" opacity:0.8; background-color:#252525;"></div>
    <div class="container">
        <div class="row">
            <div
                    class="wpb_column hcode-column-container  col-md-5 col-xs-11 col-sm-10 text-center center-col no-padding">
                <div class="vc-column-innner-wrapper">
                    <div class="testimonial-style2"><i
                                class="fa fa-quote-left medium-icon margin-five no-margin-top"
                                style="color:#ffffff !important"></i><h6 class="white-text">
                            <?php echo randomText()[0]; ?>
                        </h6> <span class="name light-gray-text2"
                                    style="color:#ffffff !important">
                                                <?php if ($ProjectURL) { ?>
                                                    <a href="<?php echo $ProjectURL; ?>"
                                                       target="_blank">
                                                    <?php echo $ProjectURL; ?>
                                                </a>
                                                <?php } ?>
                                            </span>
                    </div>
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
