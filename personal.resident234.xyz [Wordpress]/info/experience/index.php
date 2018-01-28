<?php
/**
 * Created by PhpStorm.
 * User: GSU
 * Date: 15.07.2017
 * Time: 14:33
 */


require $_SERVER['DOCUMENT_ROOT'] . '/wp-load.php';

include $_SERVER['DOCUMENT_ROOT'] . '/includes/head.php';


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
<body class="page-template-default page page-id-153 wpb-js-composer js-comp-ver-5.1 vc_responsive">
<nav
    class="navbar navbar-default navbar-fixed-top nav-transparent overlay-nav sticky-nav transparent-header nav-border-bottom  nav-white "
    data-menu-hover-delay="100">
    <div class="container">
        <div class="row">

            <?php
            include $_SERVER['DOCUMENT_ROOT'] . "/includes/head_logo.php";
            ?>

            <div class="navbar-header col-sm-8 sm-width-auto col-xs-2 pull-right">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse"><span
                        class="sr-only">Toggle navigation</span> <span class="icon-bar"></span> <span
                        class="icon-bar"></span> <span class="icon-bar"></span></button>
            </div>


            <div class="col-md-8 no-padding-right accordion-menu text-right">
                <div id="mega-menu" class="navbar-collapse collapse navbar-right">
                    <?php
                    include $_SERVER['DOCUMENT_ROOT'] . '/includes/main_menu.php';
                    ?>
                </div>
            </div>
        </div>
    </div>
</nav>
<?php
global $wpdb;
$wpdb->set_prefix('portfolio_');

$categoryId = PORTFOLIO_WP_STOCK_FOTOS_ID;

$args = array(
    'numberposts' => 1,
    'category' => $categoryId,
    'orderby' => 'rand',
    'order' => 'ASC',
    'include' => array(),
    'exclude' => array(),
    'meta_key' => '',
    'meta_value' => '',
    'post_type' => 'post',
    'suppress_filters' => true,
    // подавление работы фильтров изменения SQL запроса
);

$posts = get_posts($args);

//unset($arSkills);
foreach ($posts as $post) {
    setup_postdata($post);

    $currentBackgroundImage[] = $post->post_title;

}

//js-backgroud
wp_reset_postdata();
?><!--js-img-->
<section class="page-title parallax3 parallax-fix page-title-large">
    <img class="parallax-background-img "

         src="<?php echo $currentBackgroundImage[0]; ?>"
         data-image="<?php echo $currentBackgroundImage[0]; ?>"
         alt="Accordions"/>

    <div class="opacity-medium bg-black"></div>
    <div class="container">
        <div class="row">
            <div class="col-md-12 col-sm-12 text-center animated fadeInUp">
                <div class="separator-line bg-yellow no-margin-top margin-four"></div>
                <h1 class="white-text">Опыт работы</h1>
                <span class="white-text"></span>
            </div>
        </div>
    </div>
</section>
<section class="parent-section no-padding post-153 page type-page status-publish hentry">
    <div class="container-fluid">
        <div class="row"><h2 class="entry-title display-none">Опыт работы</h2>
            <div class="entry-content">


                <section class=" " style=" background-color:#f6f6f6; ">
                    <div class="container">
                        <div class="row">
                            <? /* ?>
                            <div
                                class="wpb_column hcode-column-container  col-md-7 col-xs-mobile-fullwidth col-sm-10 text-center center-col margin-ten-bottom">
                                <div class="vc-column-innner-wrapper"><h6
                                        class="section-title  margin-ten-bottom xs-margin-0auto black-text no-padding">
                                        </h6></div>
                            </div>
 <? */ ?>
                        <div class="wpb_column hcode-column-container
                            col-md-8 col-xs-mobile-fullwidth center-col">
                                <div class="vc-column-innner-wrapper">
                                    <div class="panel-group accordion-style2" id="accordion-two">


                                        <div class="panel panel-default">
                                            <div class="panel-heading">
                                                <a data-toggle="collapse"

                                                   data-parent="#accordion-two"

                                                   href="#accordian-panel-41">
                                                    <h4 class="panel-title">
                                                        Декабрь 2012 - Июнь 2015
                                                        <span class="pull-right"><i
                                                                class="fa fa-angle-down"></i>
                                                        </span></h4></a>
                                            </div>
                                            <div id="accordian-panel-41"
                                                 class="panel-collapse collapse">
                                                <div class="panel-body">
                                                    <h6 class="no-margin">
                                                        OOO Retina (Благовещенск)

                                                    </h6>
                                                    <p class="no-margin">
                                                    web-программист
                                                    </p>
                                                </div>
                                            </div>
                                        </div>



                                        <div class="panel panel-default">
                                            <div class="panel-heading">
                                                <a data-toggle="collapse"

                                                   data-parent="#accordion-two"

                                                   href="#accordian-panel-42">
                                                    <h4 class="panel-title">
                                                        Август 2014 - Январь 2016
                                                        <span class="pull-right"><i
                                                                class="fa fa-angle-down"></i>
                                                        </span></h4></a>
                                            </div>
                                            <div id="accordian-panel-42"
                                                 class="panel-collapse collapse">
                                                <div class="panel-body">
                                                    <h6 class="no-margin">
                                                        ФРИЛАНС

                                                    </h6>
                                                    <p class="no-margin">
                                                        web-программист
                                                    </p>
                                                </div>
                                            </div>
                                        </div>


                                        <div class="panel panel-default">
                                            <div class="panel-heading">
                                                <a data-toggle="collapse"

                                                   data-parent="#accordion-two"

                                                   href="#accordian-panel-43">
                                                    <h4 class="panel-title">
                                                        Сентябрь 2015 - Февраль 2016
                                                        <span class="pull-right"><i
                                                                class="fa fa-angle-down"></i>
                                                        </span></h4></a>
                                            </div>
                                            <div id="accordian-panel-43"
                                                 class="panel-collapse collapse">
                                                <div class="panel-body">
                                                    <h6 class="no-margin">
                                                        DANCELIFE (МОСКВА, УДАЛЁННО)


                                                    </h6>
                                                    <p class="no-margin">
                                                        PHP-программист
                                                    </p>
                                                </div>
                                            </div>
                                        </div>



                                        <div class="panel panel-default">
                                            <div class="panel-heading">
                                                <a data-toggle="collapse"

                                                   data-parent="#accordion-two"

                                                   href="#accordian-panel-44">
                                                    <h4 class="panel-title">
                                                        Февраль 2016 - Июль 2016
                                                        <span class="pull-right"><i
                                                                class="fa fa-angle-down"></i>
                                                        </span></h4></a>
                                            </div>
                                            <div id="accordian-panel-44"
                                                 class="panel-collapse collapse">
                                                <div class="panel-body">
                                                    <h6 class="no-margin">
                                                        LABLEND (ХАБАРОВСК, УДАЛЁННО)

                                                    </h6>
                                                    <p class="no-margin">
                                                        web-программист
                                                    </p>
                                                </div>
                                            </div>
                                        </div>


                                        <div class="panel panel-default">
                                            <div class="panel-heading">
                                                <a data-toggle="collapse"

                                                   data-parent="#accordion-two"

                                                   href="#accordian-panel-45">
                                                    <h4 class="panel-title">
                                                        Ноябрь 2016 - наст. время
                                                        <span class="pull-right"><i
                                                                class="fa fa-angle-down"></i>
                                                        </span></h4></a>
                                            </div>
                                            <div id="accordian-panel-45"
                                                 class="panel-collapse collapse">
                                                <div class="panel-body">
                                                    <h6 class="no-margin">
                                                        DIGITALSPECTR (ПЕРМЬ, УДАЛЁННО)

                                                    </h6>
                                                    <p class="no-margin">
                                                        web-программист
                                                    </p>
                                                </div>
                                            </div>
                                        </div>




                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>

            </div>
        </div>
    </div>
</section>
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