<?php
/**
 * Created by PhpStorm.
 * User: GSU
 * Date: 29.07.2017
 * Time: 14:58
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
    class="portfolio-template-default single single-portfolio postid-9817 single-format-image wpb-js-composer js-comp-ver-5.1 vc_responsive">
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
<section class="content-top-margin page-title-section page-title bg-black border-bottom-light border-top-light">
    <div class="container">
        <div class="row">
            <div class="col-md-12 col-sm-12 animated text-center fadeInUp"><h1 class="white-text">
                    <?php echo $arProject["post_title"];?>
                </h1><span class="white-text xs-display-none"><?php echo implode("  ", $arPostTagsNames); ?></span>
                <div
                    class="separator-line margin-three bg-white sm-margin-top-three sm-margin-bottom-three no-margin-bottom xs-display-none"></div>
            </div>
        </div>
    </div>
</section>
<section
    class="no-padding post-9817 portfolio type-portfolio status-publish format-image hentry portfolio-category-portfolio-related">
    <div class="container-fluid">
        <div class="row">
            <div class="blog-details-text portfolio-single-content">
                <div class="entry-content">
                    <section>
                        <div class="container">
                            <div class="row">
                                <div
                                    class="wpb_column hcode-column-container  col-md-3 col-xs-mobile-fullwidth col-sm-6 xs-margin-ten-bottom">
                                    <div class="vc-column-innner-wrapper">
                                        <div class="margin-bottom-30px"><h6
                                                class="black-text no-margin-top margin-one-bottom no-letter-spacing">
                                                <strong>Случайный текст</strong></h6>
                                            <p class="text">
                                                <?php echo randomText()[0]; ?>
                                            </p></div>
                                        <div class="margin-bottom-30px"><h6
                                                class="black-text no-margin-top margin-one-bottom no-letter-spacing">
                                                <strong>Год</strong></h6>
                                            <p class="text"><?php echo $YEAR; ?></p></div>
                                        <div class="margin-bottom-30px"><h6
                                                class="black-text no-margin-top margin-one-bottom no-letter-spacing">
                                                <strong>Категория</strong></h6>
                                            <p class="text"><?php echo $ProjectTYPE; ?></p></div>
                                        <div class=""><h6
                                                class="black-text no-margin-top margin-one-bottom no-letter-spacing">
                                                <strong>Клиент</strong></h6>
                                            <p class="text"><?php echo $ProjectCLIENT; ?></p></div>

                                        <?php
                                        $arContent = preg_split('/[\n.]/u', $arProject["post_content"], -1, PREG_SPLIT_NO_EMPTY);
                                        $arContentBlock = array_chunk($arContent, round(count($arContent) / 2));

                                        ?>


                                        <div class="thin-separator-line bg-mid-gray margin-ten no-margin-lr"></div>
                                        <p><?php if ($arContentBlock[0]) {
                                                echo implode("\n", $arContentBlock[0]);
                                            } ?></p>
                                        <div class="thin-separator-line bg-mid-gray margin-ten no-margin-lr"></div>
                                        <p><?php if ($arContentBlock[1]) {
                                                echo implode("\n", $arContentBlock[1]);
                                            } ?></p>
                                        <div class="thin-separator-line bg-mid-gray margin-ten no-margin-lr"></div>




                                        <div class="testimonial-style2"><i
                                                class="fa fa-quote-left small-icon margin-five no-margin-top"
                                                style="color:#000000 !important"></i>
                                            <p><?php echo randomText()[0]; ?></p>
                                            <?php if($ProjectURL){ ?>
                                            <span class="name light-gray-text2"><a href="<?php echo $ProjectURL; ?>"
                                                                                   target="_blank">
                                                        <?php echo $ProjectURL; ?>
                                                    </a></span>
                                            <?php } ?>

                                        </div>



                                    </div>
                                </div>
                                <div
                                    class="wpb_column hcode-column-container  col-md-offset-1 col-md-8 col-xs-mobile-fullwidth col-sm-6">
                                    <div class="vc-column-innner-wrapper">
                                        <?php foreach($arProjectAllImages as $image){ ?>
                                            <?php
                                            $filename = $image;
                                            $new_filen = $_SERVER["DOCUMENT_ROOT"].'/wp-content/uploads/' . basename($filename);


                                            $fileNew = "/wp-content/uploads/" . basename($filename);

                                            $fileNew = cropImage($filename,
                                                $_SERVER['DOCUMENT_ROOT'] . $fileNew,
                                                1200, 800);
                                            ?>


                                            <img
                                                    data-image="<?php echo $image; ?>"
                                                    src=""
                                                    width="800"  class="js-img padding-bottom-15px" alt="">
                                        <?php } ?>


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
