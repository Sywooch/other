<?php
/**
 * Created by PhpStorm.
 * User: GSU
 * Date: 23.07.2017
 * Time: 23:53
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
<body class="page-template-default page page-id-30 wpb-js-composer js-comp-ver-5.1 vc_responsive">
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
<?php

?>
<section class="parent-section no-padding post-30 page type-page status-publish hentry">
    <div class="container-fluid">
        <div class="row">
            <div class="entry-content">

                <section class="  parallax-fix parallax1 full-screen no-padding js-background"
                         style=" background-image: url(); " data-image="<?php displayRandomElement($arProjectMockups); ?>">
                    <div class="container">
                        <div class="row">
                            <div class="wpb_column hcode-column-container  col-xs-mobile-fullwidth full-screen">
                                <div class="vc-column-innner-wrapper">
                                    <div class=" container position-relative full-screen">
                                        <div class="slider-typography">
                                            <div class="slider-text-middle-main">
                                                <div
                                                        class="slider-text-bottom slider-text-middle4 text-left animated fadeInUp">
                                                    <span class="slider-title-big4 alt-font"
                                                          style="color:#000000;border-color:#000000"><?php echo $arProject["post_title"];?></span>
                                                    <div class="slider-subtitle4 black-text">
                                                        <?php if($projectURL){ ?>
                                                            <a href="<?php echo $projectURL;?>"
                                                                                target="_self"><?php echo $projectURL;?></a>
                                                        <?php } ?>
                                                    </div>
                                                    <p class="no-margin text"><br class="no-margin text"></p>
                                                    <div
                                                            class="separator-line no-margin-lr no-margin-top
                                                            xs-margin-bottom-ten"
                                                            style="background-color:#000000;"></div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>


                <?php

                $arContent = preg_split('/[\n.]/u', $arProject["post_content"], -1, PREG_SPLIT_NO_EMPTY);

                $arContentBlock = array_chunk($arContent, round(count($arContent)/count($arProjectAllImages)));

                $i = 1;
                foreach($arProjectAllImages as $projectImage){
                ?>

                    <section class=" parallax-section-main parallax-fix parallax1 js-background"
                             style=" background-image: url(); " data-image="<?php echo $projectImage; ?>">
                        <div class="container">
                            <div class="row">
                                <div
                                        class="wpb_column hcode-column-container

                                        <?php if($i % 2 == 0) { ?>pull-right<? } ?> col-md-4
                                        col-xs-mobile-fullwidth col-sm-6">
                                    <div class="vc-column-innner-wrapper"><span class="parallax-number alt-font
                                    black-text"><?php echo $i; ?></span><span
                                                class="parallax-title alt-font black-text"
                                                style="color:#000000;border-color:#000000"><?php displayRandomElement($arPostTagsNames); ?></span>
                                        <div class="parallax-sub-title black-text">
                                            <?php if($projectURL){ ?>
                                                <a href="<?php echo $projectURL;?>"
                                                   target="_self"><?php echo $projectURL;?></a>
                                            <?php } ?>
                                        </div>
                                        <div class="separator-line bg-black no-margin-lr"
                                             style="background-color:#000000;"></div>
                                        <p class="black-text text-uppercase no-margin-bottom">
                                            <?php if($arContentBlock[$i - 1]) echo $arContentBlock[$i - 1][0]; ?>
                                        </p></div>
                                </div>
                            </div>
                        </div>
                    </section>

                    <?
                    $i++;
                }
                ?>


                <?php
                include $_SERVER['DOCUMENT_ROOT'] . '/includes/detail_section_latest_work.php';
                ?>

                <?php
                include $_SERVER['DOCUMENT_ROOT'] . '/includes/detail_section_development_process.php';
                ?>

                <?php
                include $_SERVER['DOCUMENT_ROOT'] . '/includes/detail_section_other_projects_buttons.php';
                ?>


                <?php
                include $_SERVER['DOCUMENT_ROOT'] . '/includes/detail_section_my_services.php';
                ?>

                <?php
                include $_SERVER['DOCUMENT_ROOT'] . '/includes/detail_section_other_projects.php';
                ?>

                <?php
                include $_SERVER['DOCUMENT_ROOT'] . '/includes/detail_section_slider_projects.php';
                ?>

                <?php
                include $_SERVER['DOCUMENT_ROOT'] . '/includes/detail_section_labels.php';
                ?>

                <?php
                include $_SERVER['DOCUMENT_ROOT'] . '/includes/detail_section_projects.php';
                ?>


                <?php
                include $_SERVER['DOCUMENT_ROOT'] . '/includes/detail_section_slider_projects-2.php';
                ?>

                <?php
                include $_SERVER['DOCUMENT_ROOT'] . '/includes/detail_section_other_projects_button.php';
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


</body>
</html>