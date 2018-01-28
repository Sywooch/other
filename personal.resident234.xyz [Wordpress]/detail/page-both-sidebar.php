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
<body class="page-template-default page page-id-128 wpb-js-composer js-comp-ver-5.1 vc_responsive">
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
<section class="page-title parallax3 parallax-fix page-title-large">
    <img class="parallax-background-img"
        data-image="<?php displayRandomElement($arProjectAllImages); ?>"
         src="<?php displayRandomElement($arProjectAllImages); ?>"

         alt=""/>
    <div class="opacity-medium bg-black"></div>
    <div class="container">
        <div class="row">
            <div class="col-md-12 col-sm-12 text-center animated fadeInUp">
                <div class="separator-line bg-yellow no-margin-top margin-four"></div>
                <h1 class="white-text">
                    <?php echo $arProject["post_title"]; ?>
                </h1><span class="white-text">
                    <?php echo implode(" ", $arPostTagsNames); ?>
                </span>
            </div>
        </div>
    </div>
</section>


<section class="parent-section  post-128 page type-page status-publish hentry">
    <div class="container col3-layout">
        <div class="row">
            <div class="col-sm-12 both-content-center sm-margin-bottom-seven">
                <h2 class="entry-title display-none">Page
                    &#8211; Both Sidebar</h2>
                <div class="entry-content">
                    <section class="  no-padding">
                        <div class="container">
                            <div class="row">
                                <div
                                    class="wpb_column hcode-column-container  col-xs-mobile-fullwidth col-sm-12 no-padding">
                                    <div class="vc-column-innner-wrapper"><p
                                            class="text-large text-black margin-five no-margin-top">
                                            <?php echo $arProject["post_title"]; ?>
                                        </p>
                                        <div class="wide-separator-line no-margin-lr"></div>
                                        <p class="text-med margin-five no-margin-top">
                                            <?php echo $arProject["post_content_formatted"]; ?>
                                        </p>

                                        <?php foreach($arProjectAllImages as $image){ ?>
                                        <img
                                            src="" data-image="<?php echo $image; ?>"
                                            width="800" class="js-img padding-tb-15px" alt="">

                                            <?php } ?>


                                    </div>
                                </div>
                            </div>
                        </div>
                    </section>
                </div>
            </div>
            <div class="col-sm-6 both-sidebar-left sidebar xs-margin-bottom-seven">

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
            <div class="col-sm-6 both-sidebar-right sidebar">
                <div id="text-6" class="widget widget_text">
                    <h5 class="widget-title font-alt">Обратная связь</h5>
                    <div class="thin-separator-line bg-dark-gray no-margin-lr"></div>
                    <div class="textwidget">
                        <div role="form" class="wpcf7" id="wpcf7-f4139-p128-o1" lang="en-US" dir="ltr">
                            <div class="screen-reader-response"></div>
                            <form action="<?php echo $_SERVER["REQUEST_URI"]; ?>" method="post"
                                  class="wpcf7-form" novalidate="novalidate">
                                <div style="display: none;"><input type="hidden" name="_wpcf7" value="4139"/> <input
                                        type="hidden" name="_wpcf7_version" value="4.7"/> <input type="hidden"
                                                                                                 name="_wpcf7_locale"
                                                                                                 value="en_US"/> <input
                                        type="hidden" name="_wpcf7_unit_tag" value="wpcf7-f4139-p128-o1"/> <input
                                        type="hidden" name="_wpnonce" value="1a307c2485"/></div>
                                <div class="quick-contact"><span class="wpcf7-form-control-wrap your-name"><input
                                            type="text" name="your-name" value="" size="40"
                                            class="wpcf7-form-control wpcf7-text wpcf7-validates-as-required"
                                            aria-required="true" aria-invalid="false"
                                            placeholder="ВАШЕ ИМЯ"/></span><span
                                        class="wpcf7-form-control-wrap email-529"><input type="email" name="email-529"
                                                                                         value="" size="40"
                                                                                         class="wpcf7-form-control wpcf7-text wpcf7-email wpcf7-validates-as-required wpcf7-validates-as-email"
                                                                                         aria-required="true"
                                                                                         aria-invalid="false"
                                                                                         placeholder="ВАШ EMAIL"/></span><span
                                        class="wpcf7-form-control-wrap your-message"><textarea name="your-message"
                                                                                               cols="40" rows="2"
                                                                                               class="wpcf7-form-control wpcf7-textarea"
                                                                                               aria-invalid="false"
                                                                                               placeholder="ВАШЕ СООБЩЕНИЕ"></textarea></span><input
                                        type="submit" value="Отправить сообщение"
                                        class="wpcf7-form-control wpcf7-submit highlight-button-dark btn btn-small no-margin-bottom"/>
                                </div>
                                <div class="wpcf7-response-output wpcf7-display-none"></div>
                            </form>
                        </div>
                    </div>
                </div>
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
