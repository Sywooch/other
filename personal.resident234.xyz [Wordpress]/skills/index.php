<?php
/**
 * Created by PhpStorm.
 * User: GSU
 * Date: 25.06.2017
 * Time: 23:45
 */


require $_SERVER['DOCUMENT_ROOT'] . '/wp-load.php';
include $_SERVER['DOCUMENT_ROOT'] . '/includes/head.php';

global $wpdb;
$wpdb->set_prefix('portfolio_');

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
<body class="page-template-default page page-id-118 wpb-js-composer js-comp-ver-5.1 vc_responsive">
<nav
        class="navbar navbar-default navbar-fixed-top nav-transparent overlay-nav sticky-nav white-header nav-border-bottom  nav-black "
        data-menu-hover-delay="100">
    <div class="container">
        <div class="row">
            <div class="col-md-2 pull-left"><a class="logo-light" href="<?php echo PERSONAL_WP_HCODE_URL; ?>/h-code">
                    <img
                            alt="H-Code"
                            src="<?php echo PERSONAL_WP_HCODE_URL; ?>/h-code/wp-content/uploads/2015/08/admin-logo.png"
                            class="logo"/> <img alt="H-Code"
                                                src="<?php echo PERSONAL_WP_HCODE_URL; ?>/h-code/wp-content/uploads/2015/08/logo-light.png"
                                                class="retina-logo" style="width:109px; max-height:34px"/> </a> <a
                        class="logo-dark" href="<?php echo PERSONAL_WP_HCODE_URL; ?>/h-code"> <img alt="H-Code"
                                                                                                   src="<?php echo PERSONAL_WP_HCODE_URL; ?>/h-code/wp-content/uploads/2015/08/admin-logo.png"
                                                                                                   class="logo"/> <img
                            alt="H-Code"
                            src="<?php echo PERSONAL_WP_HCODE_URL; ?>/h-code/wp-content/uploads/2015/08/logo-light.png"
                            class="retina-logo-light"
                            style="width:109px; max-height:34px"/>
                </a></div>

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
        class="content-top-margin page-title-section page-title page-title-small border-bottom-light border-top-light bg-white">
    <div class="container">
        <div class="row">
            <div class="col-lg-8 col-md-7 col-sm-12 animated fadeInUp">
                <h1 class="black-text">Навыки</h1></div>
            <div class="col-lg-4 col-md-5 col-sm-12 breadcrumb text-uppercase wow fadeInUp xs-display-none"
                 data-wow-duration="600ms">
                <ul class="breadcrumb-gray-text">
                    <li><a href="/" title="Browse to: Home">Главная</a></li>
                    <li>Навыки</li>
                </ul>
            </div>
        </div>
    </div>
</section>
<section class="parent-section no-padding post-118 page type-page status-publish hentry">
    <div class="container-fluid">
        <div class="row"><h2 class="entry-title display-none">Навыки</h2>
            <div class="entry-content">
                <section class=" " style=" background-color:#000000; ">
                    <div class="container">
                        <div class="row">
                            <div
                                    class="wpb_column hcode-column-container  col-md-8 col-xs-mobile-fullwidth col-sm-12 text-center center-col">
                                <div class="vc-column-innner-wrapper">
                                    <h1 class="section-title  white-text no-padding">
                                        Список навыков</h1>
                                    <div class="  margin-top-30px">
                                        <h4 class="faq-content white-text">
                                            Здесь представлены направления, с которыми я сталкивался неоднократно
                                            в течении профессиональной деятельности</h4></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
                <section>
                    <?php
                    unset($arLeftSkills);
                    unset($arRightSkills);
                    unset($arSkills);

                    $categories = get_categories(array(
                        'orderby' => 'count ',
                        'order' => 'DESC'
                    ));

                    foreach ($categories as &$itemCategory) {
                        if ($itemCategory->parent == PORTFOLIO_WP_CATEGORY_SKILLS_ID) {

                            $arSkills[] = $itemCategory;

                        }
                    }

                    $arSkills = array_chunk($arSkills, ceil(count($arSkills) / 2));

                    $arLeftSkills = $arSkills[0];
                    $arRightSkills = $arSkills[1];


                    ?>

                    <div class="container">
                        <div class="row">
                            <div
                                    class="wpb_column hcode-column-container  col-md-6 col-xs-mobile-fullwidth
                                col-sm-12 sm-margin-ten-bottom">
                                <div class="vc-column-innner-wrapper">


                                    <?php
                                    foreach ($arLeftSkills as $keySkillCategory => $itemSkillCategory) {
                                        ?>



                                        <div class="heading-style-five
                                         <?php if ($keySkillCategory == 0) { ?>
                                            margin-ten-bottom
                                        <?php } else { ?>
                                            margin-ten
                                        <?php } ?>
                                         sm-margin-seven-bottom">
                                            <h5
                                                    style="font-size:15px !important;
                                                    font-weight:600 !important;">
                                                <i
                                                        class="icon-<?php echo $itemSkillCategory->category_nicename;?>
                                                        small-icon vertical-align-middle"></i>
                                                <?php echo $itemSkillCategory->cat_name; ?></h5></div>



                                        <div class="panel-group toggles-style3 no-border">

                                            <?php


                                            $args = array(
                                                'numberposts' => 1000,
                                                'category' => $itemSkillCategory->cat_ID,
                                                'orderby' => 'meta_value_ORDER',
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

                                            foreach ($posts as $post) {
                                                setup_postdata($post);
                                                //$paddingLeft = get_post_meta($post->ID, 'PADDING_LEFT');
                                                //accordian-panel-1
                                                ?>
                                                <div class="panel panel-default">
                                                    <div class="panel-heading ">
                                                        <a data-toggle="collapse"
                                                           data-parent="#1444395450"
                                                           href="#">
                                                            <h4
                                                                    class="panel-title">
                                                                <?php
                                                                echo $post->post_title;
                                                                ?>
                                                                <span
                                                                        class="pull-right">
                                                                <!--<i class="fa fa-plus"></i>-->
                                                            </span>
                                                            </h4>
                                                        </a>
                                                    </div>
                                                    <!--
                                                    <div id="accordian-panel-1" class="panel-collapse collapse ">
                                                        <div class="panel-body">
                                                            <p class="no-margin">Lorem Ipsum is simply
                                                                dummy
                                                                text of the printing and typesetting industry. Lorem Ipsum
                                                                has
                                                                been the industry&#8217;s standard dummy text ever since the
                                                                1500s, when an unknown printer took a galley of type and
                                                                scrambled it to make a type specimen book.</p>
                                                        </div>
                                                    </div>
                                                    -->
                                                </div>


                                                <?php

                                            }

                                            wp_reset_postdata();

                                            ?>


                                        </div>



                                        <?php
                                    }
                                    ?>


                                </div>
                            </div>


                            <div
                                    class="wpb_column hcode-column-container  col-md-offset-1 col-md-5
                                col-xs-mobile-fullwidth col-sm-12">
                                <div class="vc-column-innner-wrapper">



                                    <?php
                                    foreach ($arRightSkills as $keySkillCategory => $itemSkillCategory) {
                                    ?>

                                    <div class="heading-style-five
                                     <?php if ($keySkillCategory == 0) { ?>
                                            margin-ten-bottom
                                        <?php } else { ?>
                                            margin-ten
                                        <?php } ?>
                                     sm-margin-seven-bottom"><h5
                                                style="font-size:15px !important;font-weight:600 !important;;"><i
                                                    class="icon-<?php echo $itemSkillCategory->category_nicename;?>
                                                     small-icon vertical-align-middle"></i>
                                            <?php echo $itemSkillCategory->cat_name; ?></h5></div>
                                    <div class="panel-group toggles-style3 no-border">




                                            <?php


                                            $args = array(
                                                'numberposts' => 1000,
                                                'category' => $itemSkillCategory->cat_ID,
                                                'orderby' => 'meta_value_ORDER',
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

                                            foreach ($posts as $post) {
                                                setup_postdata($post);
                                                //$paddingLeft = get_post_meta($post->ID, 'PADDING_LEFT');
                                                //accordian-panel-1
                                                ?>
                                                <div class="panel panel-default">
                                                    <div class="panel-heading ">
                                                        <a data-toggle="collapse"
                                                           data-parent="#1444395450"
                                                           href="#">
                                                            <h4
                                                                    class="panel-title">
                                                                <?php
                                                                echo $post->post_title;
                                                                ?>
                                                                <span
                                                                        class="pull-right">
                                                                <!--<i class="fa fa-plus"></i>-->
                                                            </span>
                                                            </h4>
                                                        </a>
                                                    </div>
                                                    <!--
                                                    <div id="accordian-panel-1" class="panel-collapse collapse ">
                                                        <div class="panel-body">
                                                            <p class="no-margin">Lorem Ipsum is simply
                                                                dummy
                                                                text of the printing and typesetting industry. Lorem Ipsum
                                                                has
                                                                been the industry&#8217;s standard dummy text ever since the
                                                                1500s, when an unknown printer took a galley of type and
                                                                scrambled it to make a type specimen book.</p>
                                                        </div>
                                                    </div>
                                                    -->
                                                </div>


                                                <?php

                                            }

                                            wp_reset_postdata();

                                            ?>


                                    </div>

                                    <?php
                                    }
                                    ?>





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


    <a class="scrollToTop" href="javascript:void(0);"> <i class="fa fa-angle-up"></i> </a>
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

