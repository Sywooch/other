<?php
/**
 * Created by PhpStorm.
 * User: GSU
 * Date: 29.07.2017
 * Time: 14:56
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
    class="portfolio-template-default single single-portfolio postid-9815 single-format-image wpb-js-composer js-comp-ver-5.1 vc_responsive">
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
        class="no-padding post-9815 portfolio type-portfolio status-publish format-image hentry portfolio-category-portfolio-related">
    <div class="container-fluid">
        <div class="row">
            <div class="blog-details-text portfolio-single-content">
                <div class="entry-content">
                    <section class="  no-padding content-top-margin cover-background wow fadeInDown
js-background"
                             data-image="<?php displayRandomElement($arProjectAllImages); ?>"
                             style=" background-image: url(); ">
                        <div class="selection-overlay" style=" opacity:0.7; background-color:#252525;"></div>
                        <div class="container-fluid">
                            <div class="row">
                                <div
                                        class="wpb_column hcode-column-container  half-project-img col-xs-mobile-fullwidth col-sm-12">
                                    <div class="vc-column-innner-wrapper">
                                        <div class="project-header-text"><span
                                                    class="project-subtitle white-text alt-font">
                                                <?php echo implode("  ", $arPostTagsNames); ?>
                                            </span><span
                                                    class="project-title white-text">
                                                <?php echo $arProject["post_title"];?>
                                            </span></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </section>
                    <section>
                        <div class="container">
                            <div class="row">
                                <div
                                        class="wpb_column hcode-column-container  col-md-4 col-xs-mobile-fullwidth col-sm-4 text-center xs-margin-eight-bottom">
                                    <div class="vc-column-innner-wrapper">
                                        <div class="project-highlight">
                                            <span class="black-text">Клиент</span>
                                            <?php echo $ProjectCLIENT; ?>
                                        </div>
                                    </div>
                                </div>
                                <div
                                        class="wpb_column hcode-column-container  col-md-4 col-xs-mobile-fullwidth col-sm-4 text-center xs-margin-eight-bottom">
                                    <div class="vc-column-innner-wrapper">
                                        <div class="project-highlight">
                                            <span class="black-text">Категория</span>
                                            <?php echo $ProjectTYPE; ?>
                                        </div>
                                    </div>
                                </div>
                                <div
                                        class="wpb_column hcode-column-container  col-md-4 col-xs-mobile-fullwidth col-sm-4 text-center">
                                    <div class="vc-column-innner-wrapper">
                                        <div class="project-highlight">
                                            <span class="black-text">Год</span>
                                            <?php echo $YEAR; ?></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </section>
                    <section class="  no-padding">
                        <div class="container-fluid">
                            <div class="row">

                                <?php foreach($arProjectAllImages as $image){ ?>
                                    <?php
                                    $filename = $image;
                                    $new_filen = $_SERVER["DOCUMENT_ROOT"].'/wp-content/uploads/' . basename($filename);


                                    $fileNew = "/wp-content/uploads/" . basename($filename);

                                    $fileNew = cropImage($filename,
                                        $_SERVER['DOCUMENT_ROOT'] . $fileNew,
                                        800, 600);
                                    ?>
                                    <div
                                            class="wpb_column hcode-column-container  col-md-4 col-xs-mobile-fullwidth col-sm-4 text-center no-padding">
                                        <div class="vc-column-innner-wrapper"><img
                                                    src="" data-image="<?php echo $fileNew; ?>"
                                                    width="800" class="js-img"  alt=""></div>
                                    </div>

                                <?php } ?>


                            </div>
                        </div>
                    </section>
                    <section>
                        <div class="container">
                            <div class="row">
                                <div class="wpb_column hcode-column-container  col-xs-mobile-fullwidth col-sm-12">
                                    <div class="vc-column-innner-wrapper">
                                        <div id="hcode-owl-slider19"
                                             class="owl-carousel owl-theme  round-pagination dark-pagination dark-navigation cursor-black  hcode-owl-slider19 ">

                                            <?php foreach($arProjectAllImages as $image){ ?>
                                                <?php
                                                $filename = $image;
                                                $new_filen = $_SERVER["DOCUMENT_ROOT"].'/wp-content/uploads/' . basename($filename);


                                                $fileNew = "/wp-content/uploads/" . basename($filename);

                                                $fileNew = cropImage($filename,
                                                    $_SERVER['DOCUMENT_ROOT'] . $fileNew,
                                                    1200, 800);
                                                ?>
                                                <div style="background: #f1f1f1" class="item text-center">
                                                    <img alt=""

                                                         data-image="<?php echo $fileNew; ?>"
                                                         src="<?php echo $fileNew; ?>"
                                                         width="1200"
                                                         height="800">
                                                </div>
                                            <?php } ?>

                                        </div>
                                        <script type="text/javascript">/*<![CDATA[*/
                                            jQuery(document).ready(function () {
                                                jQuery("#hcode-owl-slider19").owlCarousel({
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
                    <section class="  no-padding" style=" background-color:#000000; ">
                        <div class="container">
                            <div class="row">
                                <div
                                        class="wpb_column hcode-column-container  white-text col-md-5 col-xs-mobile-fullwidth col-sm-10 text-center center-col margin-ten">
                                    <div class="vc-column-innner-wrapper"><i
                                                class="icon-desktop white-text large-icon
                                                margin-ten no-margin-top"></i>
                                        <h1 class="white-text video-title">Информация о проекте</h1>
                                        <h6
                                                class="margin-three-bottom">
                                            <?php echo $arProject["post_content_formatted"]; ?>
                                        </h6></div>
                                </div>
                            </div>
                        </div>
                    </section>
                    <?php
                    include $_SERVER['DOCUMENT_ROOT'] . '/includes/detail_button_portfolio__btn-extra-large.php';
                    ?>
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