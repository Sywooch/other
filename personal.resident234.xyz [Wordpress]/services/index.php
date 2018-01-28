<?php
/**
 * Created by PhpStorm.
 * User: GSU
 * Date: 15.07.2017
 * Time: 15:45
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
<body class="page-template-default page page-id-117 wpb-js-composer js-comp-ver-5.1 vc_responsive">
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
    class="content-top-margin page-title-section page-title page-title-small border-bottom-light border-top-light bg-white">
    <div class="container">
        <div class="row">
            <div class="col-lg-8 col-md-7 col-sm-12 animated fadeInUp">
                <h1 class="black-text">Услуги</h1></div>
            <div class="col-lg-4 col-md-5 col-sm-12 breadcrumb text-uppercase
            wow fadeInUp xs-display-none"
                 data-wow-duration="600ms">
                <ul class="breadcrumb-gray-text">
                    <li><a href="/" title="Browse to: Home">Главная</a></li>
                    <li>Услуги</li>
                </ul>
            </div>
        </div>
    </div>
</section>
<section class="parent-section no-padding post-117 page type-page status-publish hentry">
    <div class="container-fluid">
        <div class="row">
            <h2 class="entry-title display-none">Услуги</h2>
            <div class="entry-content">
                <section class="  cover-background"
                         style=" background-image: url(<?php echo PERSONAL_WP_HCODE_URL; ?>/h-code/wp-content/uploads/2015/08/parallax-img45.jpg); ">
                    <div class="container">
                        <div class="row">
                            <div
                                class="wpb_column hcode-column-container  col-md-8 col-xs-mobile-fullwidth
                                col-sm-12 text-center center-col margin-five-bottom">
                                <div class="vc-column-innner-wrapper">
                                    <h1
                                        class="section-title  margin-ten-bottom black-text no-padding">
                                        Мои услуги
                                    </h1>
                                    <div class="separator-line margin-0auto" style=" background:#000000;"></div>
                                </div>
                            </div>

                            <?php
                            $arProjectsTypes = array();

                            $categoryId = WP_CATEGORY_PROJECTS_ID;

                            $args = array(
                                'numberposts' => 1000,
                                'category' => $categoryId,
                                'orderby' => 'meta_value_num',//meta_value_ORDER
                                'order' => 'ASC',
                                'include' => array(),
                                'exclude' => array(),
                                'meta_key' => 'ORDER',
                                'meta_value' => '',
                                'post_type' => 'post',
                                'suppress_filters' => true, // подавление работы фильтров изменения SQL запроса
                                /*'meta_query'	=> array(
                                    array(
                                        'key'	  	=> 'PRIVATE ',
                                        'value'	  	=> '1',
                                        'compare' 	=> 'NOT IN',
                                    ),
                                ), */
                            );

                            $posts = get_posts($args);
                            $i = 1;

                            ?>

                            <?php
                            foreach ($posts as $post){

                                $private = get_post_meta($post->ID, 'PRIVATE');

                                //?mode=private
                                if((!isset($_SESSION["mode"]) || ($_SESSION["mode"] != "private")) &&
                                    ($private[0] == "1")) continue;

                                setup_postdata($post);

                                ?>

                                <?php

                                            $arPostTags = wp_get_post_tags($post->ID);
                                            //print_r($arPostTags);
                                            foreach ($arPostTags as $keyTag => $tag) {
                                                $postTagId = $tag->term_id;
                                                $postTagName = $tag->name;

                                                //echo $postTagName;


                                                if($arProjectsTypes[$postTagName]){
                                                    $arProjectsTypes[$postTagName]++;
                                                }else{
                                                    $arProjectsTypes[$postTagName] = 1;
                                                }


                                            }

                                $i++;

                            }

                            wp_reset_postdata(); // сброс
                            ?>


                            <?php


                            $categoryId = PORTFOLIO_WP_CATEGORY_SITES_ID;

                            $args = array(
                                'numberposts' => 6,
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

                            foreach ($posts as $post) {
                                setup_postdata($post);


                                if(!$arProjectsTypes[$post->post_title]){
                                    $arProjectsTypes[$post->post_title] = 1;
                                }

                                ?>


                                <div
                                    class="wpb_column hcode-column-container
                                col-md-4 col-xs-mobile-fullwidth col-sm-6 text-center">
                                    <div class="vc-column-innner-wrapper">
                                        <div class="services-box ">
                                            <i class="icon-<?php echo $post->post_content;?> small-icon"

                                               style="color:#7f7f7f !important"></i><h6
                                                class="margin-five font-weight-600 letter-spacing-2"
                                                style="color:#000000 !important">
                                                <?php echo $post->post_title;?>
                                            </h6>
                                            <p></p>
                                            <figure class="text-uppercase bg-black"
                                                    style="color:#ffffff">
                                                <span>
                                                    <?php
                                                    echo $arProjectsTypes[$post->post_title];
                                                    ?>
                                                </span>
                                                <?php
                                            echo numberof($arProjectsTypes[$post->post_title],
                                                '', array('проект', 'проекта', 'проектов'));
                                                                                            ?>

                                            </figure>
                                        </div>
                                    </div>
                                </div>

                                <?php
                            }

                            wp_reset_postdata();
                            ?>









                        </div>
                    </div>
                </section>


                <?php
                $categoryId = PORTFOLIO_WP_STOCK_FOTOS_ID;

                $args = array(
                    'numberposts' => 4,
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


                wp_reset_postdata();

                ?>
                
                
                <section class="  parallax-fix parallax8 js-background"
                         data-image="<?php echo $currentBackgroundImage[0]; ?>"
                         style=" background-image: url(); ">
                    <div class="selection-overlay"
                         style=" opacity:0.7; background-color:#000000;"></div>
                    <div class="container">
                        <div class="row">
                            <div
                                class="wpb_column hcode-column-container  col-md-7 col-xs-mobile-fullwidth col-sm-12 text-center center-col">
                                <div class="vc-column-innner-wrapper">
                                    <h1 class="section-title  white-text no-padding">
                                    Разрабтка сайтов любой сложности
                                    </h1></div>
                            </div>
                        </div>
                    </div>
                </section>
                <section class="  no-padding-bottom">
                    <div class="container">
                        <div class="row">


                            <div
                                class="wpb_column hcode-column-container  col-md-7 col-xs-mobile-fullwidth col-sm-12 text-center center-col">
                                <div class="vc-column-innner-wrapper">
                                    <h3 class="section-title  black-text">
                                        Категории услуг
                                    </h3></div>
                            </div>


                            <div
                                class="wpb_column hcode-column-container
                                col-md-6 col-xs-mobile-fullwidth col-sm-6
                                text-center margin-five-bottom">
                                <div class="vc-column-innner-wrapper"><span
                                        class="parallax-number alt-font white-text letter-spacing-2 bg-black margin-five no-margin-top">01</span>
                                    <h6 class="margin-two font-weight-600 letter-spacing-2
                                    no-margin-top"
                                        style="color:#000000 !important">
                                        Подготовительные работы

                                    </h6>
                                    <p class="width-90 center-col">
                                       Обсуждение проекта, постановка целей и задач |
                                       Составление сметы, календарного плана, заключение
                                        договора на создание сайта |
                                        Составление технического задания и прототипов
                                    </p></div>
                            </div>


                            <div
                                class="wpb_column hcode-column-container
                                col-md-6 col-xs-mobile-fullwidth col-sm-6
                                text-center margin-five-bottom">
                                <div class="vc-column-innner-wrapper"><span
                                        class="parallax-number alt-font white-text letter-spacing-2 bg-black margin-five no-margin-top">02</span>
                                    <h6 class="margin-two font-weight-600 letter-spacing-2 no-margin-top"
                                        style="color:#000000 !important">
                                        Разработка сайта


                                    </h6>
                                    <p class="width-90 center-col">
                                        Работы по проектированию и разработке на
                                        основании утверждённого технического
                                        задания и брифа |
                                        Проработка структуры будущего сайта |
                                        Выбор платформы и инструментария |
                                        Собственно разработка |
                                        Тестирование |
                                        Запуск
                                    </p></div>
                            </div>


                            <div
                                class="wpb_column hcode-column-container
                                col-md-6 col-xs-mobile-fullwidth col-sm-6
                                text-center margin-five-bottom">
                                <div class="vc-column-innner-wrapper"><span
                                        class="parallax-number alt-font white-text letter-spacing-2 bg-black margin-five no-margin-top">03</span>
                                    <h6 class="margin-two font-weight-600 letter-spacing-2 no-margin-top"
                                        style="color:#000000 !important">
                                        Сопровождение сайта


                                    </h6>
                                    <p class="width-90 center-col">
                                        Наполнение ресурса оптимизированным SEO-контентом |
                                        Наполнение страниц информационными материалами
                                        клиента |
                                        Редизайн элементов по желанию заказчика |
                                        Переконфигурирование сайта |
                                        Техническая поддержка
                                    </p></div>
                            </div>


                            <div
                                class="wpb_column hcode-column-container
                                col-md-6 col-xs-mobile-fullwidth col-sm-6
                                text-center margin-five-bottom">
                                <div class="vc-column-innner-wrapper"><span
                                        class="parallax-number alt-font white-text letter-spacing-2 bg-black margin-five no-margin-top">04</span>
                                    <h6 class="margin-two font-weight-600 letter-spacing-2 no-margin-top"
                                        style="color:#000000 !important">

                                        Доработка сайта


                                    </h6>
                                    <p class="width-90 center-col">
                                        Доработка модулей или их создание |
                                        Доработка верстки |
                                        Адаптация под браузеры и разрешения дисплеев |
                                        Редизайн/доработка дизайна |
                                        Создание элементов сайта |
                                        Работа с юзабилити |
                                        Отладка ошибок в программном коде ресурса |
                                        Коррекция работы сайта согласно интересам и
                                        потребностям посетителей |
                                        Изменение бизнес-логики проекта |
                                        Повышение производительности, ускорение работы,
                                        рефакторинг |
                                        Интеграция с внешними системами

                                    </p></div>
                            </div>




                            <div
                                class="wpb_column hcode-column-container 1
                                col-xs-mobile-fullwidth margin-eight xs-margin-0auto">
                                <div class="vc-column-innner-wrapper">
                                    <div class="wide-separator-line no-margin-lr"
                                         style=" background:#e5e5e5;"></div>
                                </div>
                            </div>







                            <?php
                            $categoryId = PORTFOLIO_WP_CATEGORY_PROJECTS_ID;

                            $args = array(
                                'numberposts' => 1000,
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

                            unset($arProjects);
                            unset($arProjectsMockups);

                            foreach ($posts as $post) {

                                $private = get_post_meta($post->ID, 'PRIVATE');

                                //?mode=private
                                if((!isset($_SESSION["mode"]) || ($_SESSION["mode"] != "private")) &&
                                    ($private[0] == "1")) continue;

                                setup_postdata($post);




                                $gal = get_post_gallery( $post->ID, false );
                                $arIDs = explode(',', $gal['ids']);

                                foreach($arIDs as $keyImageID => $itemImageID) {

                                    $arMetaImage = wp_get_attachment_metadata($itemImageID);

                                    $thumb_img = get_post($itemImageID);

                                    if($thumb_img->post_excerpt == "PERSONAL_MOCKUP"){

                                        $arProjects[] = PORTFOLIO_WP_UPLOAD_DIR_URL."/".$arMetaImage["file"];

                                    }else if($thumb_img->post_excerpt == "PERSONAL_MOCKUP_2"){

                                        $arProjectsMockups[] = PORTFOLIO_WP_UPLOAD_DIR_URL."/".$arMetaImage["file"];

                                    }

                                }




                            }


                            wp_reset_postdata();

                            $currentProjectImage[] = $arProjects[mt_rand(0, count($arProjects) - 1)];
                            ?>



                            <div
                                class="wpb_column hcode-column-container  col-md-12 col-xs-mobile-fullwidth col-sm-10 text-center center-col">
                                <div class="vc-column-innner-wrapper"><h1
                                        class="section-title  margin-five-top black-text no-padding">
                                        <?php
                                        $diffDate =  current_time('timestamp') - strtotime("01-12-2012");
                                        $humanYears = floor($diffDate / 31536000);
                                        echo $humanYears. " ";

                                        echo numberof($humanYears, '', array('год', 'года', 'лет'));


                                        ?> опыта в сфере web-разработок

                                    </h1><a
                                        href="/feedback/project/" target="_self"
                                        class="inner-link highlight-button-dark btn-medium
                                        margin-five button btn">
                                        Заказать разработку
                                    </a><img
                                        data-image="<?php echo $currentProjectImage[0]; ?>"
                                        src=""
                                        width="1600" height="845"
                                        class="js-img no-padding" alt=""></div>
                            </div>
                        </div>
                    </div>
                </section>




                <section class=" " style=" background-color:#000000; ">
                    <div class="container">
                        <div class="row">


                            <?php

                            $categoryId = PORTFOLIO_WP_CATEGORY_PROJECTS_ID;

                            $args = array(
                                'numberposts' => 1000,
                                'category' => $categoryId,
                                'orderby' => 'ID',
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

                            $countPosts = count($posts);


                            $categoryId = PORTFOLIO_WP_CATEGORY_SITES_ID;

                            $args = array(
                                'numberposts' => 4,
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

                            foreach ($posts as $post) {
                                setup_postdata($post);


                                if(!$arProjectsTypes[$post->post_title]){
                                    $arProjectsTypes[$post->post_title] = 1;
                                }

                                //$countPosts
                                //$arProjectsTypes[$post->post_title]
                                $percentProjects = ceil(($arProjectsTypes[$post->post_title] * 100) / $countPosts);

                                ?>



                                <div
                                    class="wpb_column hcode-column-container
                                col-md-3 col-xs-mobile-fullwidth col-sm-3
                                text-center wow bounceIn">
                                    <div class="vc-column-innner-wrapper">
                                        <div class="chart-style2">
                                            <div class="chart-percent">
                                            <span data-percent="<?php echo $percentProjects; ?>"

                                                  class="chart chart-<?php echo $post->ID;?>
                                                  white-text">
                                                <span
                                                    class="percent alt-font">
                                                    <?php echo $percentProjects; ?>
                                                </span>
                                            </span>
                                            </div>
                                            <div class="chart-text">
                                                <h5 class=" white-text">
                                                    <?php echo $post->post_title;?>
                                                </h5>
                                                <p></p></div>
                                        </div>
                                        <script type="text/javascript">jQuery(function () {
                                                jQuery('.chart-<?php echo $post->ID;?>').easyPieChart({
                                                    barColor: '#FFF',
                                                    trackColor: '#535353',
                                                    scaleColor: false,
                                                    easing: 'easeOutBounce',
                                                    scaleLength: 1,
                                                    lineCap: 'round',
                                                    lineWidth: 1,
                                                    size: 120,
                                                    animate: {duration: 2000, enabled: true},
                                                    onStep: function (from, to, percent) {
                                                        $(this.el).find('.percent').text(Math.round(percent));
                                                    }
                                                });
                                            });</script>
                                    </div>
                                </div>

                                <?php
                            }

                            wp_reset_postdata();
                            ?>








                            <!--
                            <div
                                class="wpb_column hcode-column-container  col-md-3 col-xs-mobile-fullwidth col-sm-3 text-center wow bounceIn">
                                <div class="vc-column-innner-wrapper">
                                    <div class="chart-style2">
                                        <div class="chart-percent"><span data-percent="88"
                                                                         class="chart chart-2 white-text"><span
                                                    class="percent alt-font">88</span></span></div>
                                        <div class="chart-text"><h5 class=" white-text">Web Design</h5>
                                            <p>Expert, 9 years</p></div>
                                    </div>
                                    <script type="text/javascript">jQuery(function () {
                                            jQuery('.chart-2').easyPieChart({
                                                barColor: '#FFF',
                                                trackColor: '#535353',
                                                scaleColor: false,
                                                easing: 'easeOutBounce',
                                                scaleLength: 1,
                                                lineCap: 'round',
                                                lineWidth: 1,
                                                size: 120,
                                                animate: {duration: 2000, enabled: true},
                                                onStep: function (from, to, percent) {
                                                    $(this.el).find('.percent').text(Math.round(percent));
                                                }
                                            });
                                        });</script>
                                </div>
                            </div>






                            <div
                                class="wpb_column hcode-column-container  col-md-3 col-xs-mobile-fullwidth col-sm-3 text-center wow bounceIn">
                                <div class="vc-column-innner-wrapper">
                                    <div class="chart-style2">
                                        <div class="chart-percent"><span data-percent="90"
                                                                         class="chart chart-3 white-text"><span
                                                    class="percent alt-font">90</span></span></div>
                                        <div class="chart-text"><h5 class=" white-text">Branding</h5>
                                            <p>Expert, 5 years</p></div>
                                    </div>
                                    <script type="text/javascript">jQuery(function () {
                                            jQuery('.chart-3').easyPieChart({
                                                barColor: '#FFF',
                                                trackColor: '#535353',
                                                scaleColor: false,
                                                easing: 'easeOutBounce',
                                                scaleLength: 1,
                                                lineCap: 'round',
                                                lineWidth: 1,
                                                size: 120,
                                                animate: {duration: 2000, enabled: true},
                                                onStep: function (from, to, percent) {
                                                    $(this.el).find('.percent').text(Math.round(percent));
                                                }
                                            });
                                        });</script>
                                </div>
                            </div>





                            <div
                                class="wpb_column hcode-column-container  col-md-3 col-xs-mobile-fullwidth col-sm-3 text-center wow bounceIn">
                                <div class="vc-column-innner-wrapper">
                                    <div class="chart-style2">
                                        <div class="chart-percent"><span data-percent="96"
                                                                         class="chart chart-4 white-text"><span
                                                    class="percent alt-font">96</span></span></div>
                                        <div class="chart-text"><h5 class=" white-text">Photography</h5>
                                            <p>Expert, 4 years</p></div>
                                    </div>
                                    <script type="text/javascript">jQuery(function () {
                                            jQuery('.chart-4').easyPieChart({
                                                barColor: '#FFF',
                                                trackColor: '#535353',
                                                scaleColor: false,
                                                easing: 'easeOutBounce',
                                                scaleLength: 1,
                                                lineCap: 'round',
                                                lineWidth: 1,
                                                size: 120,
                                                animate: {duration: 2000, enabled: true},
                                                onStep: function (from, to, percent) {
                                                    $(this.el).find('.percent').text(Math.round(percent));
                                                }
                                            });
                                        });</script>
                                </div>
                            </div>
-->





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