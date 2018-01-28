<?php
/**
 * Created by PhpStorm.
 * User: GSU
 * Date: 01.07.2017
 * Time: 15:09
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
<body class="page-template-default page page-id-110 wpb-js-composer js-comp-ver-5.1 vc_responsive">
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
                <h1 class="black-text">Основные сведения</h1>
            </div>
            <div class="col-lg-4 col-md-5 col-sm-12 breadcrumb text-uppercase wow fadeInUp xs-display-none"
                 data-wow-duration="600ms">
                <ul class="breadcrumb-gray-text">
                    <li><a href="/" title="Browse to: Home">Главная</a></li>
                    <li>Основные сведения</li>
                </ul>
            </div>
        </div>
    </div>
</section>
<section class="parent-section no-padding post-110 page type-page status-publish hentry">
    <div class="container-fluid">
        <div class="row"><h2 class="entry-title display-none">Основные сведения</h2>
            <div class="entry-content">
                <section class=" " style=" background-color:#000000; ">
                    <div class="container">
                        <div class="row">
                            <div
                                class="wpb_column hcode-column-container
                                col-md-6 col-xs-mobile-fullwidth col-sm-8 text-center center-col">
                                <div class="vc-column-innner-wrapper">
                                    <div class="about-year text-uppercase white-text"><span class="clearfix">
                                            <?php


                                            $diffDate =  current_time('timestamp') - strtotime("01-12-2012");
                                            $humanYears = floor($diffDate / 31536000);
                                            echo $humanYears;

                                            ?>
                                        </span>
                                        <div class="about-year-text">
                                            <?php
                                            echo numberof($humanYears, '', array('год', 'года', 'лет'));
                                            ?>
                                        </div>
                                    </div>
                                    <p class="title-small text-uppercase letter-spacing-1 white-text
                                    font-weight-100">
                                    Опыта работы в сфере web-разработки
                                    </p></div>
                            </div>
                        </div>
                    </div>
                </section>
                <section>
                    <div class="container">
                        <div class="row">
                            <div
                                class="wpb_column hcode-column-container  col-md-8 col-xs-mobile-fullwidth col-sm-12 center-col">
                                <div class="vc-column-innner-wrapper">
                                    <div id="animated-tab3" class=" animated-tab3">
                                        <div class="row">
                                            <div class="col-md-12 col-sm-12">
                                                <ul class="nav nav-tabs nav-tabs-light height-auto
                                                text-center">
                                                    <li class=" active">
                                                        <a href="#hcode-1498890217-1370441712-0"
                                                                           data-toggle="tab">
                                                            Back-End
                                                        </a>
                                                    </li>
                                                    <li class="">
                                                        <a href="#hcode-1498890217-1370441712-1"
                                                                    data-toggle="tab">
                                                            Front-End
                                                        </a>
                                                    </li>
                                                    <li class="">
                                                        <a href="#hcode-1498890217-1370441712-2"
                                                                    data-toggle="tab">
                                                            DB
                                                        </a>
                                                    </li>
                                                </ul>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-12 col-sm-12">
                                                <div class="wide-separator-line no-margin-lr"></div>
                                            </div>
                                        </div>
                                        <div class="tab-content">



                                            <div class="text-center center-col tab-pane fade in active"
                                                 id="hcode-1498890217-1370441712-0">
                                                <div class="row">
                                                    <div class="col-md-6 col-sm-12 text-left gray-text">
                                                        <p
                                                            class="text-large margin-right-ten">
                                                            Пишу убойный код на многих языках
                                                        </p></div>
                                                    <div class="col-md-6 col-sm-12 text-left text-med
                                                    gray-text">
                                                        <p
                                                            class="text-uppercase">
                                                            Обладаю большим набором инструментария
                                                        </p>
                                                        <p>
                                                            Перфекционист
                                                        </p></div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-md-12 col-sm-12">
                                                        <div class="wide-separator-line no-margin-lr"></div>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div
                                                        class="col-md-12 col-sm-12 text-center service-year black-text">
                                                        <strong>
                                                            Yii, Symfony, Zend Framework, Drupal, Bitrix,
                                                            Wordpress
                                                        </strong></div>
                                                </div>
                                            </div>


                                            <div class="text-center center-col tab-pane fade"
                                                 id="hcode-1498890217-1370441712-1">
                                                <div class="row">
                                                    <div class="col-md-6 col-sm-12 text-left gray-text"><p
                                                            class="text-large margin-right-ten">
                                                            Эксперт HTML, CSS и JavaScript
                                                        </p></div>
                                                    <div class="col-md-6 col-sm-12 text-left text-med gray-text"><p
                                                            class="text-uppercase">
                                                            Совершенствуюсь и адаптируюсь к
                                                            постоянно развивающимся технологиям
                                                        </p>
                                                        <p>
                                                            Имею опыт работы с React и Redux
                                                        </p></div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-md-12 col-sm-12">
                                                        <div class="wide-separator-line no-margin-lr"></div>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div
                                                        class="col-md-12 col-sm-12 text-center service-year black-text">
                                                        <strong>
                                                            AngularJS, Bootstrap, React
                                                        </strong></div>
                                                </div>
                                            </div>




                                            <div class="text-center center-col tab-pane fade"
                                                 id="hcode-1498890217-1370441712-2">
                                                <div class="row">
                                                    <div class="col-md-6 col-sm-12 text-left gray-text"><p
                                                            class="text-large margin-right-ten">
                                                            Страсть к программированию, изучениию, исследованию
                                                            и переработке новых технологий
                                                        </p></div>
                                                    <div class="col-md-6 col-sm-12 text-left text-med gray-text"><p
                                                            class="text-uppercase">
                                                            Принимаю концепцию итеративного развития
                                                        </p>
                                                        <p>Прилагаю все усилия для выполнения работы</p></div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-md-12 col-sm-12">
                                                        <div class="wide-separator-line no-margin-lr"></div>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div
                                                        class="col-md-12 col-sm-12 text-center service-year black-text">
                                                        <strong>
                                                            MySQL
                                                        </strong></div>
                                                </div>
                                            </div>



                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
                <section class=" " style=" background-color:#f6f6f6; ">
                    <div class="container">
                        <div class="row">

<?php

                            $categoryId = PORTFOLIO_WP_TEXT_1_ID;

                            $args = array(
                            'numberposts' => 3,
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


                            $currentTitle[] = $post->post_title;
                            $currentDescription[] = $post->post_content;

                            }


                            wp_reset_postdata();



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
                            $currentProjectImage[] = $arProjects[mt_rand(0, count($arProjects) - 1)];
                            $currentProjectImage[] = $arProjects[mt_rand(0, count($arProjects) - 1)];


?>

                            <div
                                class="wpb_column hcode-column-container
                                col-md-4 col-xs-mobile-fullwidth col-sm-4 text-center">
                                <div class="vc-column-innner-wrapper">
                                    <div class="key-person ">
                                        <div class="key-person-img">
                                            <img alt=""
                                                 class="js-img"
                                                 data-image="<?php echo $currentProjectImage[0]; ?>"
                                                                         src=""
                                                                         width="800" height="1000"></div>
                                        <div class="key-person-details bg-gray no-border no-padding-bottom">
                                            <h5><?php echo $currentTitle[0]; ?></h5>
                                            <div class="separator-line bg-black"></div>
                                            <p><?php echo $currentDescription[0]; ?></p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div
                                class="wpb_column hcode-column-container  col-md-4 col-xs-mobile-fullwidth
                                col-sm-4 text-center">
                                <div class="vc-column-innner-wrapper">
                                    <div class="key-person ">
                                        <div class="key-person-img">
                                            <img alt=""
                                                 class="js-img"
                                            data-image="<?php echo $currentProjectImage[1]; ?>"
                                                                         src=""
                                                                         width="800" height="1000"></div>
                                        <div class="key-person-details bg-gray no-border no-padding-bottom">
                                            <h5><?php echo $currentTitle[1]; ?></h5>
                                            <div class="separator-line bg-black"></div>
                                            <p><?php echo $currentDescription[1]; ?></p></div>
                                    </div>
                                </div>
                            </div>
                            <div
                                class="wpb_column hcode-column-container  col-md-4 col-xs-mobile-fullwidth col-sm-4 text-center">
                                <div class="vc-column-innner-wrapper">
                                    <div class="key-person ">
                                        <div class="key-person-img"
                                        ><img alt=""
                                              class="js-img"
                                              data-image="<?php echo $currentProjectImage[2]; ?>"
                                                                         src=""
                                                                         width="800" height="1000"></div>
                                        <div class="key-person-details bg-gray no-border no-padding-bottom">
                                            <h5><?php echo $currentTitle[2]; ?></h5>
                                            <div class="separator-line bg-black"></div>
                                            <p><?php echo $currentDescription[2]; ?></p></div>
                                    </div>
                                </div>
                            </div>





                        </div>
                    </div>
                </section>
                <section class="  wow fadeIn">
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


                            $categoryId = PORTFOLIO_WP_CATEGORY_SERTIFICATES_ID;

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

                            $countSertificates = count($posts);

                            $diffDateRemote =  current_time('timestamp') - strtotime("01-12-2013");
                            $humanYearsRemote = floor($diffDateRemote / 31536000);

                            include $_SERVER['DOCUMENT_ROOT'] . '/includes/GitHub.php';





                            ?>


                            <div
                                class="wpb_column hcode-column-container
                                col-md-3 col-xs-mobile-fullwidth col-sm-6 text-center
                                sm-margin-ten-bottom xs-margin-ten-bottom">
                                <div class="vc-column-innner-wrapper">
                                    <div class="counter-section">
                                        <span id="counter_1" data-to="<?php echo $countPosts;?>"
                                                                       class="counter-number
                                                                       black-text">
                                            <?php echo $countPosts;?>
                                        </span>
                                        <span
                                            class="counter-title black-text">
                                            <?php
                                            echo numberof($countPosts, '',
                                                array('Проект', 'Проекта', 'Проектов'));
                                            ?>
                                        </span>
                                    </div>
                                </div>
                            </div>
                            <div
                                class="wpb_column hcode-column-container  col-md-3
                                col-xs-mobile-fullwidth col-sm-6 text-center sm-margin-ten-bottom
                                xs-margin-ten-bottom">
                                <div class="vc-column-innner-wrapper">
                                    <div class="counter-section"><span id="counter_2"
                                                                       data-to="<?php echo $countSertificates;?>"
                                                                       class="counter-number black-text">
                                            <?php echo $countSertificates;?>
                                        </span>
                                        <span
                                            class="counter-title black-text">
                                            <?php
                                            echo numberof($countPosts, '',
                                                array('Сертификат', 'Сертификата', 'Сертификатов'));
                                            ?>
                                        </span></div>
                                </div>
                            </div>
                            <div
                                class="wpb_column hcode-column-container  col-md-3 col-xs-mobile-fullwidth col-sm-6 text-center xs-margin-ten-bottom">
                                <div class="vc-column-innner-wrapper">
                                    <div class="counter-section"><span id="counter_3"
                                                                       data-to="<?php echo $countFilesInRepo; ?>"
                                                                       class="counter-number black-text">
                                            <?php echo $countFilesInRepo; ?>
                                        </span>
                                        <span
                                            class="counter-title black-text">Файлов с кодом в репозитории</span></div>
                                </div>
                            </div>
                            <div
                                class="wpb_column hcode-column-container  col-md-3 col-xs-mobile-fullwidth
                                col-sm-6 text-center">
                                <div class="vc-column-innner-wrapper">
                                    <div class="counter-section">
                                        <span id="counter_4"
                                                                       data-to="<?php echo $humanYearsRemote; ?>"
                                                                       class="counter-number black-text">
                                            <?php echo $humanYearsRemote; ?>
                                        </span>
                                        <span
                                            class="counter-title black-text">
                                            <?php
                                            echo numberof($humanYearsRemote, '', array('год', 'года', 'лет'));
                                            ?> опыта удалённой работы
                                        </span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
                <section class="  cover-background"
                         style=" background-image: url(https://image.prntscr.com/image/P8_HVJjzSSCDK0WP21Cwtw.png); ">
                    <div class="selection-overlay" style=" opacity:0.8; background-color:#252525;"></div>
                    <div class="container">
                        <div class="row">
                            <div
                                class="wpb_column hcode-column-container  col-md-6 col-xs-mobile-fullwidth
                                col-sm-11 text-center center-col">
                                <div class="vc-column-innner-wrapper"><p
                                        class="title-large white-text text-uppercase letter-spacing-2">
                                        <strong>Текущее географическое местоположение</strong></p>
                                    <p class="text-large white-text text-uppercase margin-five no-margin-bottom">
                                        РФ, Амурская область, город Благовещенск
                                    </p></div>
                            </div>
                        </div>
                    </div>
                </section>
                <section>
                    <div class="container">
                        <div class="row">
                            <div
                                class="wpb_column hcode-column-container  col-md-12
                                col-xs-mobile-fullwidth text-center">
                                <div class="vc-column-innner-wrapper">
                                    <h3 class="section-title  black-text">
                                        Основные сведения
                                    </h3>
                                </div>
                            </div>




                            <div
                                class="wpb_column hcode-column-container  col-md-2
                                col-xs-mobile-fullwidth col-sm-6 text-center sm-margin-six-bottom
                                xs-margin-ten-bottom wow fadeIn">
                                <div class="vc-column-innner-wrapper">
                                    <div class="features-box-style1">
                                        <i class="icon-calendar medium-icon"></i><h5
                                            class=" margin-bottom-15px xs-margin-bottom-10px">
                                            Дата рождения
                                        </h5>
                                        <div class="no-margin"><p>9 июня 1992 г.
                                            </p></div>
                                    </div>
                                </div>
                            </div>
                            <div
                                class="wpb_column hcode-column-container  col-md-2 col-xs-mobile-fullwidth
                                col-sm-6 text-center sm-margin-six-bottom xs-margin-ten-bottom">
                                <div class="vc-column-innner-wrapper">
                                    <div class="features-box-style1">
                                        <i class="icon-flag medium-icon"></i>
                                        <h5
                                            class=" margin-bottom-15px xs-margin-bottom-10px">
                                            Гражданство
                                        </h5>
                                        <div class="no-margin"><p>Россия</p></div>
                                    </div>
                                </div>
                            </div>
                            <div
                                class="wpb_column hcode-column-container  col-md-2 col-xs-mobile-fullwidth
                                col-sm-6 text-center xs-margin-ten-bottom">
                                <div class="vc-column-innner-wrapper">
                                    <div class="features-box-style1">
                                        <i class="icon-profile-male medium-icon"></i><h5
                                            class=" margin-bottom-15px xs-margin-bottom-10px">
                                            Семейное положение
                                        </h5>
                                        <div class="no-margin"><p>холост</p></div>
                                    </div>
                                </div>
                            </div>
                            <div
                                class="wpb_column hcode-column-container  col-md-2
                                col-xs-mobile-fullwidth col-sm-6 text-center">
                                <div class="vc-column-innner-wrapper">
                                    <div class="features-box-style1">
                                        <i class="icon-book-open medium-icon"></i><h5
                                            class=" margin-bottom-15px xs-margin-bottom-10px">
                                            Образование</h5>
                                        <div class="no-margin"><p style="line-height: 14px;">
                                                Благовещенский Государственный
                                                Педагогический Университет, Физико-математический факультет,
                                                инженер информационных систем, 2009 - 2014
                                            </p></div>
                                    </div>
                                </div>
                            </div>

                            <div
                                class="wpb_column hcode-column-container  col-md-2
                                col-xs-mobile-fullwidth col-sm-6 text-center">
                                <div class="vc-column-innner-wrapper">
                                    <div class="features-box-style1"><i class="icon-map medium-icon"></i><h5
                                            class=" margin-bottom-15px xs-margin-bottom-10px">
                                            Текущее местоположение</h5>
                                        <div class="no-margin"><p>РФ, Амурская область, г.Благовещенск
                                            </p></div>
                                    </div>
                                </div>
                            </div>



                            <div
                                class="wpb_column hcode-column-container  col-md-2
                                col-xs-mobile-fullwidth col-sm-6 text-center">
                                <div class="vc-column-innner-wrapper">
                                    <div class="features-box-style1">
                                        <i class="icon-chat medium-icon"></i>
                                        <h5
                                            class=" margin-bottom-15px xs-margin-bottom-10px">
                                            SKYPE</h5>
                                        <div class="no-margin"><p>
                                                gsu_resident234
                                            </p></div>
                                    </div>
                                </div>
                            </div>


                        </div>
                    </div>
                </section>
                <section class=" " style=" background-color:#000000; ">
                    <div class="container-fluid">
                        <div class="row">
                            <div class="wpb_column hcode-column-container  col-xs-mobile-fullwidth">
                                <div class="vc-column-innner-wrapper">
                                    <div class="blog-slider position-relative">
                                        <div id="blog-post-slider-1449837989"
                                             class="owl-carousel owl-theme  dark-navigation round-pagination light-pagination white-cursor">



<?php

                                            $categoryId = PORTFOLIO_WP_CATEGORY_PROJECTS_ID;

                                            $args = array(
                                            'numberposts' => 10,
                                            'category' => $categoryId,
                                            'orderby' => 'date',
                                            'order' => 'DESC',
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
                                                // формат вывода
                                                //echo "<pre>";
                                                //print_r($post);
                                                //echo "</pre>";

                                                ?>

                                                <div
                                                        class="post-<?php echo $post->ID; ?>
                                                        post type-post status-publish
                                                format-standard has-post-thumbnail hentry category-blog
                                                category-sample">



                                                    <div class="item">

                                                        <?php

                                                        $arDate = explode("-", $post->post_date);
                                                        $day = explode(" ", $arDate[2]);


                                                        $monthNum  = intval($arDate[1]);
                                                        $monthName = date('F', mktime(0, 0, 0, $monthNum, 10));

                                                        ?>

                                                        <div class="col-md-2 col-sm-3 col-xs-3
                                                        col-md-offset-1 text-center">
                                                        <span
                                                                class="timeline-number alt-font bg-white black-text
                                                                display-inline-block"><?php echo $day[0]; ?></span><span
                                                                    class="text-large white-text
                                                                    display-block margin-ten-top">
                                                                <?php echo $monthName; ?>
                                                            </span>
                                                            <span
                                                                    class="text-large white-text display-block margin-ten-bottom">
                                                                <?php echo $arDate[0]; ?>
                                                            </span>
                                                            <div class="thin-separator-line bg-yellow"></div>
                                                        </div>
                                                        <div
                                                                class="col-md-9 col-sm-8 col-xs-9 border-right border-transperent-light xs-no-border">
                                                            <h5 class="title-small text-uppercase font-weight-700 letter-spacing-1 white-text entry-title">
                                                                <a href="/detail/<?php echo $arDetailTemplates[wp_rand(0, count($arDetailTemplates) - 1)]; ?>?ID=<?php echo $post->ID; ?>">
                                                                    <?php echo $post->post_title; ?>
                                                                </a></h5>
                                                            <div
                                                                    class="text-med margin-three width-80 gray-text xs-width-100
                                                                    float-left post-slider-no-margin entry-content">
                                                                <p>
                                                                    <?php

                                                                    //$content = wp_filter_nohtml_kses($content);
                                                                    $content = preg_replace("/\\[.+\\]/m","",get_the_content());

                                                                    echo kama_excerpt(array(
                                                                        'maxchar' => 100,
                                                                        'text' => $content
                                                                    ));
                                                                    ?>
                                                                </p></div>
                                                        </div>
                                                    </div>

                                                </div>
                                            <?php

                                            }

                                            wp_reset_postdata(); // сброс
                                            ?>


                                        </div>
                                    </div>
                                    <script type="text/javascript">/*<![CDATA[*/
                                        jQuery(document).ready(function () {
                                            jQuery("#blog-post-slider-1449837989").owlCarousel({
                                                pagination: true,
                                                items: 3,
                                                itemsDesktop: [1200, 3],
                                                itemsTablet: [991, 2],
                                                itemsMobile: [700, 1],
                                                navigationText: ["<i class='fa fa-angle-left'></i>", "<i class='fa fa-angle-right'></i>"]
                                            });
                                        });
                                        /*]]>*/</script>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
                <section class="  no-padding" style="height:300px; overflow:hidden;">
                    <div class="container-fluid">
                        <div class="row">
                            <div
                                class="wpb_column hcode-column-container  col-xs-mobile-fullwidth no-padding wow fadeIn">
                                <div class="vc-column-innner-wrapper">
                                    <div class="work-4col">
                                        <div class="col-md-12 grid-gallery overflow-hidden  no-padding">
                                            <ul class="grid masonry-items lightbox-gallery">

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
                                                unset($arProjectsMain);

                                                foreach ($posts as $post) {

                                                    $private = get_post_meta($post->ID, 'PRIVATE');

                                                    //?mode=private
                                                    if ((!isset($_SESSION["mode"]) || ($_SESSION["mode"] != "private")) &&
                                                        ($private[0] == "1")
                                                    ) {
                                                        continue;
                                                    }

                                                    setup_postdata($post);


                                                    $gal = get_post_gallery($post->ID, false);
                                                    $arIDs = explode(',', $gal['ids']);

                                                    foreach ($arIDs as $keyImageID => $itemImageID) {

                                                        $arMetaImage = wp_get_attachment_metadata($itemImageID);

                                                        $thumb_img = get_post($itemImageID);

                                                        if ($thumb_img->post_excerpt == "PERSONAL_MOCKUP") {

                                                            $arProjects[] = PORTFOLIO_WP_UPLOAD_DIR_URL . "/" . $arMetaImage["file"];


                                                            $idImage = get_post_thumbnail_id($post->ID);
                                                            $image_attributes = wp_get_attachment_image_src($idImage, full);

                                                            $arProjectsMain[] = $image_attributes[0];

                                                        } else {
                                                            if ($thumb_img->post_excerpt == "PERSONAL_MOCKUP_2") {

                                                                $arProjectsMockups[] = PORTFOLIO_WP_UPLOAD_DIR_URL . "/" . $arMetaImage["file"];

                                                            }
                                                        }

                                                    }


                                                }


                                                wp_reset_postdata();
                                                ?>




                                                <?php
                                                for($i=0; $i<4; $i++) {

                                                    $arProjectsMain[$i] = str_replace(get_site_url(),
                                                        PORTFOLIO_WP_URL, $arProjectsMain[$i]);
                                                    ?>

                                                    <li class=""><a
                                                                href="<?php echo $arProjectsMain[$i]; ?>"
                                                                class="lightboxgalleryitem" data-group="default">
                                                            <img
                                                                    src=""
                                                                    data-image="<?php echo $arProjectsMain[$i]; ?>"
                                                                    alt="" width="800" height="600" class="js-img"></a></li>
                                                    <?php
                                                }
                                                ?>


                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
                <section>
                    <div class="container">
                        <div class="row">
                            <div
                                class="wpb_column hcode-column-container  col-md-6 col-xs-mobile-fullwidth col-sm-10 text-center center-col">
                                <div class="vc-column-innner-wrapper">
                                    <div class="testimonial-style2">
                                        <i
                                            class="fa fa-quote-left medium-icon margin-five no-margin-top"
                                            style="color:#000000 !important"></i>
                                        <h6 class="black-text">
                                            Комплексный подход к разработке и созданию сайтов
                                            для бизнеса, ориентированных на продвижение
                                            и высокую конверсию.
                                        </h6>
                                        <span
                                            class="name light-gray-text2" style="color:#000000 !important">

                                        </span>
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
