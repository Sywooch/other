<?php
/**
 * Created by PhpStorm.
 * User: GSU
 * Date: 23.07.2017
 * Time: 22:27
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
<body class="page-template-default page page-id-124 wpb-js-composer js-comp-ver-5.1 vc_responsive">
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
            <div class="col-lg-8 col-md-7 col-sm-12 animated fadeInUp">
                <h1 class="black-text"><?php echo $arProject["post_title"];?></h1>
            </div>
            <div class="col-lg-4 col-md-5 col-sm-12 breadcrumb text-uppercase wow fadeInUp xs-display-none"
                 data-wow-duration="600ms">
                <?php
                include $_SERVER['DOCUMENT_ROOT'] . '/includes/detail_craft_navigation.php';
                ?>
            </div>
        </div>
    </div>
</section>
<?php
$arContent = preg_split('/[\n.]/u', $arProject["post_content"], -1, PREG_SPLIT_NO_EMPTY);

$arContentBlock = array_chunk($arContent, round(count($arContent)/7));


?>
<section class="parent-section no-padding post-124 page type-page status-publish hentry">
    <div class="container">
        <div class="row"><h2 class="entry-title display-none"><?php echo $arProject["post_title"];?></h2>
            <div class="entry-content">
                <section>
                    <div class="container">
                        <div class="row">
                            <div
                                class="wpb_column hcode-column-container  col-md-6 col-xs-mobile-fullwidth
                                col-sm-12 sm-margin-four-bottom">
                                <div class="vc-column-innner-wrapper">
                                    <img class="js-img"
                                         data-image="<?php displayRandomElement($arProjectMockups); ?>"
                                        src=""
                                        width="1920" height="1200" alt=""></div>
                            </div>
                            <div class="wpb_column hcode-column-container  col-md-6 col-xs-mobile-fullwidth col-sm-12">
                                <div class="vc-column-innner-wrapper"><p
                                        class="text-large font-weight-600 text-black margin-three no-margin-top">
                                        <?php echo displayRandomElement($arPostTagsNames); ?></p>
                                    <p class="text-large text-black margin-three no-margin-top">
                                        <?php if($projectURL){ ?>
                                            <a href="<?php echo $projectURL;?>"
                                               target="_self"><?php echo $projectURL;?></a>
                                        <?php } ?>
                                    </p>
                                    <p class="text-med">

                                        <?php if($arContentBlock[0]) echo implode("\n", $arContentBlock[0]); ?>
                                    </p>
                                </div>
                            </div>
                            <div class="wpb_column hcode-column-container  col-md-12 col-xs-mobile-fullwidth col-sm-12">
                                <div class="vc-column-innner-wrapper">
                                    <div class="wide-separator-line no-margin-lr" style=" background:#e5e5e5;"></div>
                                </div>
                            </div>
                            <div
                                class="wpb_column hcode-column-container  col-md-6 col-xs-mobile-fullwidth col-sm-6 xs-margin-five-bottom">
                                <div class="vc-column-innner-wrapper"><p
                                        class="text-large font-weight-600 text-black margin-three no-margin-top">
                                        <?php echo displayRandomElement($arPostTagsNames); ?></p>
                                    <p class="text-med no-margin">
                                        <?php if($arContentBlock[1]) echo implode("\n", $arContentBlock[1]); ?>
                                    </p>
                                </div>
                            </div>
                            <div class="wpb_column hcode-column-container  col-md-6 col-xs-mobile-fullwidth col-sm-6">
                                <div class="vc-column-innner-wrapper"><p
                                        class="text-large font-weight-600 text-black margin-three no-margin-top">
                                        <?php echo displayRandomElement($arPostTagsNames); ?></p>
                                    <p class="text-med no-margin">
                                        <?php if($arContentBlock[2]) echo implode("\n", $arContentBlock[2]); ?>
                                    </p></div>
                            </div>
                            <div class="wpb_column hcode-column-container  col-md-12 col-xs-mobile-fullwidth col-sm-12">
                                <div class="vc-column-innner-wrapper">
                                    <div class="wide-separator-line no-margin-lr" style=" background:#e5e5e5;"></div>
                                </div>
                            </div>
                            <div class="wpb_column hcode-column-container  col-md-6 col-xs-mobile-fullwidth col-sm-12">
                                <div class="vc-column-innner-wrapper"><p
                                        class="text-large font-weight-600 text-black margin-three no-margin-top">
                                        <?php echo displayRandomElement($arPostTagsNames); ?></p>
                                    <p class="text-large text-black margin-three no-margin-top">
                                        <?php if($projectURL){ ?>
                                            <a href="<?php echo $projectURL;?>"
                                               target="_self"><?php echo $projectURL;?></a>
                                        <?php } ?>
                                    </p>
                                    <p class="text-med">
                                        <?php if($arContentBlock[3]) echo implode("\n", $arContentBlock[3]); ?>
                                    </p>
                                </div>
                            </div>
                            <div
                                class="wpb_column hcode-column-container  col-md-6 col-xs-mobile-fullwidth col-sm-12 sm-margin-four-bottom">


                                <?php
                                foreach ($arProjectImages as $itemProjectImage) {
                                    ?>
                                    <div class="vc-column-innner-wrapper margin-four-bottom">
                                        <img class="js-img"
                                             src=""
                                             data-image="<?php echo $itemProjectImage; ?>"
                                             width="1920" height="1200" alt="">
                                    </div>
                                    <?php
                                }
                                ?>



                            </div>
                            <div
                                class="wpb_column hcode-column-container  col-md-12 hidden-sm hidden-xs col-xs-mobile-fullwidth col-sm-12">
                                <div class="vc-column-innner-wrapper">
                                    <div class="wide-separator-line no-margin-lr" style=" background:#e5e5e5;"></div>
                                </div>
                            </div>
                            <div class="wpb_column hcode-column-container  col-md-4 col-xs-mobile-fullwidth col-sm-4">
                                <div class="vc-column-innner-wrapper"><p class="text-med">
                                        <?php if($arContentBlock[4]) echo implode("\n", $arContentBlock[4]); ?>
                                    </p></div>
                            </div>
                            <div class="wpb_column hcode-column-container  col-md-4 col-xs-mobile-fullwidth col-sm-4">
                                <div class="vc-column-innner-wrapper"><p class="text-med">
                                        <?php if($arContentBlock[5]) echo implode("\n", $arContentBlock[5]); ?>
                                    </p></div>
                            </div>
                            <div class="wpb_column hcode-column-container  col-md-4 col-xs-mobile-fullwidth col-sm-4">
                                <div class="vc-column-innner-wrapper"><p class="text-med">
                                        <?php if($arContentBlock[6]) echo implode("\n", $arContentBlock[6]); ?>
                                    </p></div>
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