<?php
/**
 * Created by PhpStorm.
 * User: GSU
 * Date: 23.07.2017
 * Time: 23:21
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
<body class="page-template-default page page-id-21 wpb-js-composer js-comp-ver-5.1 vc_responsive">
<section class="parent-section no-padding post-21 page type-page status-publish hentry">
    <div class="container-fluid">
        <div class="row">
            <div class="entry-content">
                <section class="  fill full-screen xs-no-background no-padding js-background"
                         data-image="<?php displayRandomElement($currentBackgroundImage);?>"
                         style=" background-image: url()">
                    <div class="wpb_column hcode-column-container  col-xs-mobile-fullwidth">
                        <div class="vc-column-innner-wrapper">
                            <div class="slider-typography xs-position-inherit">
                                <div class="slider-text-middle-main">
                                    <div class="slider-text-top slider-text-middle2">
                                        <div class="coming-soon-logo"><img class="logo-style-2" style="max-width:80px"
                                                                           src="<?php echo PERSONAL_WP_HCODE_URL; ?>/h-code/wp-content/uploads/2015/08/logo-big.png"
                                                                           width="177" height="56" alt=""/></div>
                                        <span class="coming-soon-title text-uppercase "
                                              style="color:#000000 !important;">
                                            <?php echo $arProject["post_title"];?>
                                        </span>
                                        <!--
                                        <div id="counter-underconstruction" data-days-text="Day" data-hours-text="Hours"
                                             data-minutes-text="Minutes" data-seconds-text="Seconds"
                                             class="hcode-date-style1" style="color:#000000 !important;"></div>
                                        <span
                                            class="hide counter-underconstruction-date counter-hidden">2020/10/27</span>
                                            -->
                                    </div>
                                </div>
                            </div>
                            <div class="notify-me-main" style="background:rgba(255,255,255,0.9)">
                                <div class="container">
                                    <div class="row">
                                        <div class="col-md-12 col-sm-12 text-center"><span
                                                class="notify-me-text text-uppercase"><strong
                                                    style="color:#000000 !important;"><?php echo implode("   ", $arPostTagsNames); ?></strong>
                                                <br><?php echo $arProject["post_content_formatted"]; ?></span>
                                        </div>
                                    </div>

                                    <?php /* ?>
                                    <div class="row">
                                        <div class="col-md-6 col-sm-12 text-center center-col">
                                            <form method="POST" name="subscription"
                                                  action="http://wpdemos.themezaa.com/h-code/index.php?wp_nlm=subscription">
                                                <input class="form-control xyz_em_email"
                                                       placeholder="ENTER YOUR EMAIL ADDRESS" name="xyz_em_email"
                                                       type="text"/>
                                                <button name="submit" id="submit_newsletter"
                                                        class="btn btn-black btn-small no-margin submit_newsletter">
                                                    <span>Get Notified</span></button>
                                            </form>
                                        </div>
                                    </div>
                                    <div class="row coming-soon-footer">
                                        <div class="col-md-12 text-center margin-five no-margin-bottom  footer-social ">
                                            <a href="https://www.facebook.com/" target="_blank" class="black-text-link"><i
                                                    class="fa fa-facebook"></i></a><a href="https://twitter.com/"
                                                                                      target="_blank"
                                                                                      class="black-text-link"><i
                                                    class="fa fa-twitter"></i></a><a href="https://plus.google.com"
                                                                                     target="_blank"
                                                                                     class="black-text-link"><i
                                                    class="fa fa-google-plus"></i></a><a href="https://dribbble.com/"
                                                                                         target="_blank"
                                                                                         class="black-text-link"><i
                                                    class="fa fa-dribbble"></i></a><a href="https://www.youtube.com/"
                                                                                      target="_blank"
                                                                                      class="black-text-link"><i
                                                    class="fa fa-youtube"></i></a><a href="https://www.linkedin.com/"
                                                                                     target="_blank"
                                                                                     class="black-text-link"><i
                                                    class="fa fa-linkedin"></i></a></div>
                                    </div>
                                    <?php */ ?>
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


<footer class="bg-light-gray2"><a class="scrollToTop" href="javascript:void(0);"> <i class="fa fa-angle-up"></i> </a>
</footer>

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