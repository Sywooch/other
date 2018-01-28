<?php
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
<body class="page-template-default page page-id-51 wpb-js-composer js-comp-ver-5.1 vc_responsive">
<nav class="navbar navbar-default navbar-fixed-top nav-transparent overlay-nav sticky-nav transparent-header nav-border-bottom  nav-black "
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
            <div class="col-md-8 no-padding-right accordion-menu text-right pull-right menu-position-right">
                <div id="mega-menu" class="navbar-collapse collapse navbar-right">
                    <ul id="menu-onepage-personal" class="mega-menu-ul nav navbar-nav navbar-right panel-group">
                        <li id="menu-item-6211"
                            class="menu-item menu-item-type-custom menu-item-object-custom menu-item-6211 simple-dropdown-right dropdown panel simple-dropdown dropdown-toggle collapsed">
                            <a href="#slider" class="inner-link">Главная</a></li>
                        <li id="menu-item-6212"
                            class="menu-item menu-item-type-custom menu-item-object-custom menu-item-6212 simple-dropdown-right dropdown panel simple-dropdown dropdown-toggle collapsed">
                            <a href="#features" class="inner-link">О себе</a></li>
                        <li id="menu-item-6213"
                            class="menu-item menu-item-type-custom menu-item-object-custom menu-item-6213 simple-dropdown-right dropdown panel simple-dropdown dropdown-toggle collapsed">
                            <a href="#skills" class="inner-link">Навыки</a></li>
                        <li id="menu-item-6214"
                            class="menu-item menu-item-type-custom menu-item-object-custom menu-item-6214 simple-dropdown-right dropdown panel simple-dropdown dropdown-toggle collapsed">
                            <a href="#education" class="inner-link">Опыт работы</a></li>
                        <li id="menu-item-6215"
                            class="menu-item menu-item-type-custom menu-item-object-custom menu-item-6215 simple-dropdown-right dropdown panel simple-dropdown dropdown-toggle collapsed">
                            <a href="#portfolio" class="inner-link">Портфолио</a></li>
                        <li id="menu-item-6216"
                            class="menu-item menu-item-type-custom menu-item-object-custom menu-item-6216 simple-dropdown-right dropdown panel simple-dropdown dropdown-toggle collapsed">
                            <a href="#blog" class="inner-link">Блог</a></li>
                        <li id="menu-item-6217"
                            class="menu-item menu-item-type-custom menu-item-object-custom menu-item-6217 simple-dropdown-right dropdown panel simple-dropdown dropdown-toggle collapsed">
                            <a href="#contact-us" class="inner-link">Контакты</a></li>
                        <li id="menu-item-15151"
                            class="menu-item menu-item-type-post_type menu-item-object-page menu-item-15151
                            menu-first-level simple-dropdown-right dropdown panel simple-dropdown dropdown-toggle collapsed">
                            <a href="#collapse1" data-redirect-url="/"
                               data-default-url="#collapse1" class="dropdown-toggle collapsed " data-hover="dropdown"
                               data-toggle="collapse">Персональный сайт</a></li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</nav>
<section class="parent-section no-padding post-51 page type-page status-publish hentry">
    <div class="container-fluid">
        <div class="row">
            <div class="entry-content">

                <section id="slider"
                         class="  parallax-fix parallax1 full-screen scroll-to-down scrollToDownSection no-padding
js-background"
                         data-image="<?php displayRandomElement($currentBackgroundImage); ?>"
                         style=" background-image: url(); "
                         data-section-id="#features">
                    <div class="selection-overlay" style=" opacity:0.8; background-color:#f4f5f6;"></div>
                    <div class="container">
                        <div class="row">
                            <div class="wpb_column hcode-column-container  col-xs-mobile-fullwidth col-sm-12 full-screen">
                                <div class="vc-column-innner-wrapper">
                                    <div class=" full-screen">
                                        <div class="slider-typography">
                                            <div class="slider-text-middle-main">
                                                <div class="slider-text-middle slider-text-middle2 personal-name animated fadeIn">
                                                    <h1 class="margin-two">Гладышев Сергей Юрьевич</h1><span
                                                            class="cd-headline letters type text-uppercase"><span
                                                                class="cd-words-wrapper waiting"><b
                                                                    class="is-visible main-font
                                                                    text-large font-weight-400">web - программист</b><b
                                                                    class="main-font text-large
                                                                    font-weight-400">full - stack</b><b
                                                                    class="main-font text-large
                                                                    font-weight-400"><?php
                                                                $diffDate =  current_time('timestamp') - strtotime("01-12-2012");
                                                                $humanYears = floor($diffDate / 31536000);
                                                                echo $humanYears." ";
                                            echo numberof($humanYears, '', array('год', 'года', 'лет'));
                                            ?> опыта работы в сфере web-разработки</b></span></span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
                <section id="features" class="  no-padding-bottom" style="border-bottom: 1px solid #e5e5e5;">
                    <div class="container">
                        <div class="row">
                            <div class="wpb_column hcode-column-container  col-md-12 col-xs-mobile-fullwidth text-center margin-ten-bottom">
                                <div class="vc-column-innner-wrapper"><span class="title-number"
                                                                            style="color: #cfcfcf;">01</span>
                                    <h3 class="section-title  black-text no-padding">О себе</h3></div>
                            </div>
                            <div class="wpb_column hcode-column-container  col-md-6 col-xs-mobile-fullwidth col-sm-6 text-center xs-margin-ten-bottom">
                                <div class="vc-column-innner-wrapper">

                                    <img
                                            data-image="<?php displayRandomElement($arAllProjectsMockups); ?>"
                                            src="" class="js-img"
                                            width="630" alt=""></div>
                            </div>
                            <div class="wpb_column hcode-column-container  col-md-6 col-xs-mobile-fullwidth col-sm-6 sm-margin-ten-bottom">
                                <div class="vc-column-innner-wrapper"><p class="text-large">Здравствуйте, я full-stack web-программист.</p>
                                    <ul class="list-line margin-ten text-med">
                                        <li><span class="font-weight-600">Имя:</span> Гладышев Сергей</li>
                                        <li><span class="font-weight-600">Email:</span>gsu1234@mail.ru</li>
                                        <li><span class="font-weight-600">Skype:</span> gsu_resident234</li>
                                        <li><span class="font-weight-600">Дата рождения:</span> 9 июня 1992 г.</li>
                                        <li><span class="font-weight-600">Страна:</span> РФ</li>
                                    </ul>
                                    <!--<a href="#" target="_self"
                                       class="inner-link highlight-button-dark btn-medium  button btn">Download
                                        Resume</a>-->
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
                <section id="skills" style="border-bottom: 1px solid #e5e5e5;">
                    <div class="container">
                        <div class="row">
                            <div class="wpb_column hcode-column-container  col-md-12 col-xs-mobile-fullwidth text-center margin-ten-bottom">
                                <div class="vc-column-innner-wrapper"><span class="title-number"
                                                                            style="color: #cfcfcf;">02</span>
                                    <h3 class="section-title  black-text no-padding">Навыки</h3></div>
                            </div>


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

                            //$arSkills = array_chunk($arSkills, ceil(count($arSkills) / 2));




                            ?>

                            <?php
                            foreach ($arSkills as $keySkillCategory => $itemSkillCategory) {
                            ?>
                            <div class="wpb_column hcode-column-container  col-md-4 col-xs-12 col-sm-6 margin-bottom-80px sm-margin-ten-bottom">
                                <div class="vc-column-innner-wrapper">
                                    <div class="col-md-12 no-padding">
                                        <div class="col-md-3 col-sm-2 col-xs-2 no-padding"><i
                                                    class="icon-<?php echo $itemSkillCategory->category_nicename;?>
                                                     medium-icon"></i></div>
                                        <div class="col-md-9 col-sm-9 col-xs-9 no-padding text-left f-right"><h5
                                                    class=" margin-five-bottom"
                                            style="height: 30px;"><?php echo $itemSkillCategory->cat_name; ?></h5>
                                            <p class="width-90" style="height: 60px;">
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

                                                unset($arSkillsOneCategoryNames);
                                                foreach ($posts as $post) {
                                                setup_postdata($post);

                                                    $arSkillsOneCategoryNames[] = $post->post_title;

                                                }

                                                wp_reset_postdata();

                                                echo implode(", ", $arSkillsOneCategoryNames);
                                                ?>

                                            </p></div>
                                    </div>
                                </div>
                            </div>
                                <?php
                            }
                            ?>

                        </div>
                    </div>
                </section>
                <?php
                include $_SERVER['DOCUMENT_ROOT'] . '/includes/detail_chart-percent__background.php';
                ?>


                <section id="education">
                    <div class="container">
                        <div class="row">
                            <div class="wpb_column hcode-column-container  col-md-12 col-xs-mobile-fullwidth text-center margin-ten-bottom">
                                <div class="vc-column-innner-wrapper"><span class="title-number"
                                                                            style="color: #cfcfcf;">03</span>
                                    <h3 class="section-title  black-text no-padding">Опыт работы</h3></div>
                            </div>
                            <div class="wpb_column hcode-column-container  col-md-12 col-xs-mobile-fullwidth no-padding">
                                <div class="vc-column-innner-wrapper">
                                    <div class="feature-owl position-relative">
                                        <div class="container">
                                            <div class="row">
                                                <div id="education-owl-slider"
                                                     class="owl-pagination-bottom owl-carousel owl-theme cursor-black dot-pagination dark-navigation dark-pagination dark-navigation">




                                                    <div class="education-box-main text-center">
                                                        <div class="education-box"><i class="icon-laptop"
                                                                                      style="color:#000000;"></i><span
                                                                    class="year text-large display-block margin-five"
                                                                    style="color:#7f7f7f;">Декабрь 2012 - Июнь 2015</span><span
                                                                    class="university text-uppercase display-block letter-spacing-2 font-weight-600"
                                                                    style="color:#000000;">
                                                        OOO Retina (Благовещенск)

                                                    </span>
                                                            <div class="separator-line bg-black margin-ten"></div>
                                                        </div>
                                                        <div class="namerol"><span
                                                                    class="text-uppercase display-block letter-spacing-2 margin-five no-margin-top"
                                                                    style="color:#000000;">
                                                    web-программист
                                                    </span>
                                                            <p></p>
                                                            <!--<span class="result text-uppercase white-text
                                                            font-weight-600 letter-spacing-1 bg-black
                                                            text-white">Grade A++</span>-->
                                                        </div>
                                                    </div>
                                                    <div class="education-box-main text-center">
                                                        <div class="education-box"><i class="icon-laptop"
                                                                                      style="color:#000000;"></i><span
                                                                    class="year text-large display-block margin-five"
                                                                    style="color:#7f7f7f;">
                                                        Август 2014 - Январь 2016
                                                        </span><span
                                                                    class="university text-uppercase display-block letter-spacing-2 font-weight-600"
                                                                    style="color:#000000;">
                                                        ФРИЛАНС

                                                    </span>
                                                            <div class="separator-line bg-black margin-ten"></div>
                                                        </div>
                                                        <div class="namerol"><span
                                                                    class="text-uppercase display-block letter-spacing-2 margin-five no-margin-top"
                                                                    style="color:#000000;">
                                                        web-программист
                                                    </span>
                                                            <p></p>
                                                            <!--<span class="result text-uppercase white-text
                                                            font-weight-600 letter-spacing-1 bg-black
                                                            text-white">Grade A++</span>-->
                                                        </div>
                                                    </div>
                                                    <div class="education-box-main text-center">
                                                        <div class="education-box"><i class="icon-laptop"
                                                                                      style="color:#000000;"></i><span
                                                                    class="year text-large display-block margin-five"
                                                                    style="color:#7f7f7f;">
                                                        Сентябрь 2015 - Февраль 2016
                                                        </span><span
                                                                    class="university text-uppercase display-block letter-spacing-2 font-weight-600"
                                                                    style="color:#000000;">
                                                        DANCELIFE (МОСКВА, УДАЛЁННО)


                                                    </span>
                                                            <div class="separator-line bg-black margin-ten"></div>
                                                        </div>
                                                        <div class="namerol"><span
                                                                    class="text-uppercase display-block letter-spacing-2 margin-five no-margin-top"
                                                                    style="color:#000000;">
                                                        PHP-программист
                                                    </span>
                                                            <p></p>
                                                            <!--<span class="result text-uppercase white-text
                                                            font-weight-600 letter-spacing-1
                                                            bg-black text-white">Grade A++</span>-->
                                                        </div>
                                                    </div>
                                                    <div class="education-box-main text-center">
                                                        <div class="education-box"><i class="icon-laptop"
                                                                                      style="color:#000000;"></i><span
                                                                    class="year text-large display-block margin-five"
                                                                    style="color:#7f7f7f;">
                                                        Февраль 2016 - Июль 2016
                                                        </span><span
                                                                    class="university text-uppercase display-block letter-spacing-2 font-weight-600"
                                                                    style="color:#000000;">
                                                        LABLEND (ХАБАРОВСК, УДАЛЁННО)

                                                    </span>
                                                            <div class="separator-line bg-black margin-ten"></div>
                                                        </div>
                                                        <div class="namerol"><span
                                                                    class="text-uppercase display-block letter-spacing-2 margin-five no-margin-top"
                                                                    style="color:#000000;">
                                                        web-программист
                                                    </span>
                                                            <p></p>
                                                            <!--<span class="result text-uppercase white-text
                                                            font-weight-600 letter-spacing-1 bg-black
                                                            text-white">Grade A++</span>-->
                                                        </div>
                                                    </div>
                                                    <div class="education-box-main text-center">
                                                        <div class="education-box"><i class="icon-laptop"
                                                                                      style="color:#000000;"></i><span
                                                                    class="year text-large display-block margin-five"
                                                                    style="color:#7f7f7f;">
                                                        Ноябрь 2016 - наст. время
                                                        </span><span
                                                                    class="university text-uppercase display-block letter-spacing-2 font-weight-600"
                                                                    style="color:#000000;">
                                                        DIGITALSPECTR (ПЕРМЬ, УДАЛЁННО)

                                                    </span>
                                                            <div class="separator-line bg-black margin-ten"></div>
                                                        </div>
                                                        <div class="namerol"><span
                                                                    class="text-uppercase display-block letter-spacing-2 margin-five no-margin-top"
                                                                    style="color:#000000;">
                                                        web-программист
                                                    </span>
                                                            <p></p>
                                                            <!--<span class="result text-uppercase white-text
                                                            font-weight-600 letter-spacing-1 bg-black
                                                            text-white">Grade A++</span>-->
                                                        </div>
                                                    </div>





                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <script type="text/javascript">jQuery(document).ready(function () {
                                            jQuery("#education-owl-slider").owlCarousel({
                                                pagination: false,
                                                autoPlay: false,
                                                stopOnHover: false,
                                                items: 4,
                                                itemsDesktop: [1200, 4],
                                                itemsTablet: [991, 3],
                                                itemsMobile: [700, 1],
                                            });
                                        });</script>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>

                <?php /* ?>
                <!--  награды
                <section class="  fix-background js-background"
                         style=" background-image: url(); "
                data-image="<?php displayRandomElement($currentBackgroundImage); ?>">
                    <div class="selection-overlay" style=" opacity:0.8; background-color:#f4f5f6;"></div>
                    <div class="container">
                        <div class="row">
                            <div class="wpb_column hcode-column-container  col-md-5 col-xs-mobile-fullwidth col-sm-10 text-center center-col margin-five-bottom">
                                <div class="vc-column-innner-wrapper"><p class="title-small black-text">Awards can give
                                        you a tremendous amount of encouragement to keep getting better, no matter how
                                        young or old you are.</p></div>
                            </div>
                            <div class="wpb_column hcode-column-container  col-md-4 col-xs-mobile-fullwidth col-sm-4 sm-text-center xs-margin-ten-bottom">
                                <div class="vc-column-innner-wrapper">
                                    <div class="award-box clearfix bg-white">
                                        <div class="col-md-4 col-sm-12 text-center"><i class="icon-trophy medium-icon"
                                                                                       style="color:#000000 !important"></i>
                                        </div>
                                        <div class="col-md-8 col-sm-12 text-left position-relative text-uppercase letter-spacing-1 top-6 sm-text-center sm-margin-top-five"
                                             style="color:#000000 !important">International Design Awards
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="wpb_column hcode-column-container  col-md-4 col-xs-mobile-fullwidth col-sm-4 sm-text-center xs-margin-ten-bottom">
                                <div class="vc-column-innner-wrapper">
                                    <div class="award-box clearfix bg-white">
                                        <div class="col-md-4 col-sm-12 text-center"><i
                                                    class="icon-circle-compass medium-icon"
                                                    style="color:#000000 !important"></i></div>
                                        <div class="col-md-8 col-sm-12 text-left position-relative text-uppercase letter-spacing-1 top-6 sm-text-center sm-margin-top-five"
                                             style="color:#000000 !important">European Design Awards
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="wpb_column hcode-column-container  col-md-4 col-xs-mobile-fullwidth col-sm-4 sm-text-center">
                                <div class="vc-column-innner-wrapper">
                                    <div class="award-box clearfix bg-white">
                                        <div class="col-md-4 col-sm-12 text-center"><i class="icon-camera medium-icon"
                                                                                       style="color:#000000 !important"></i>
                                        </div>
                                        <div class="col-md-8 col-sm-12 text-left position-relative text-uppercase letter-spacing-1 top-6 sm-text-center sm-margin-top-five"
                                             style="color:#000000 !important">European Design Awards
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>-->
 <?php */ ?>


                <section id="portfolio" class="  no-padding-bottom">
                    <div class="container-fluid">
                        <div class="row">
                            <div class="wpb_column hcode-column-container  col-md-12 col-xs-mobile-fullwidth text-center margin-five-bottom">
                                <div class="vc-column-innner-wrapper"><span class="title-number"
                                                                            style="color: #cfcfcf;">04</span>
                                    <h3 class="section-title  black-text no-padding">Портфолио</h3></div>
                            </div>
                            <div class="wpb_column hcode-column-container  col-xs-mobile-fullwidth no-margin">
                                <div class="vc-column-innner-wrapper">
                                    <div class="col-md-12 text-center">
                                        <div class="text-center">
                                            <ul class="portfolio-filter nav nav-tabs height-auto margin-bottom_20">
                                                <?php
                                                include $_SERVER['DOCUMENT_ROOT'] . '/includes/portfolio_filter.php';
                                                ?>
                                            </ul>
                                        </div>
                                    </div>
                                    <div class="work-4col masonry wide ">
                                        <div class="col-md-12  xs-margin-top-20px grid-gallery overflow-hidden no-padding content-section">
                                            <div class="tab-content">
                                                <ul class="grid masonry-items ">
                                                    <?php
                                                    include $_SERVER['DOCUMENT_ROOT'] . '/includes/portfolio_grid_gallery.php';
                                                    ?>


                                                    <?php
                                                    $i = 1;
                                                    foreach ($posts as $post) {

                                                    $private = get_post_meta($post->ID, 'PRIVATE');

                                                    //?mode=private
                                                    if ((!isset($_SESSION["mode"]) || ($_SESSION["mode"] != "private")) &&
                                                        ($private[0] == "1")
                                                    ) {
                                                        continue;
                                                    }

                                                    setup_postdata($post);

                                                    ?>

                                                    <?php
                                                    $thumb_id = get_post_thumbnail_id($post->ID);
                                                    $thumb_url = wp_get_attachment_image_src($thumb_id, 'full',
                                                        false);

                                                    $thumb_url[0] = str_replace(get_site_url(),
                                                        PORTFOLIO_WP_URL,
                                                        $thumb_url[0]);

                                                    $thumb_url_medium = wp_get_attachment_image_src($thumb_id, 'large',
                                                        false);
                                                    $thumb_url_medium[0] = str_replace(get_site_url(),
                                                        PORTFOLIO_WP_URL,
                                                        $thumb_url_medium[0]);

                                                    $filename = $thumb_url[0];
                                                    $new_filen = $_SERVER["DOCUMENT_ROOT"].'/wp-content/uploads/' . basename($filename);


                                                    $fileNew = "/wp-content/uploads/" . basename($filename);

                                                    $width = 480;
                                                    $height = 358;
                                                    if($i == 2) {
                                                        $height = 716;
                                                    }

                                                        $fileNew = cropImage($filename,
                                                        $_SERVER['DOCUMENT_ROOT'] . $fileNew,
                                                        $width, $height);

                                                    $arPostTags = wp_get_post_tags($post->ID);

                                                    unset($arCurrentPostTagsNames);
                                                    foreach ($arPostTags as $tag){
                                                        $arCurrentPostTagsNames[] = $tag->name;
                                                    }
                                                    ?>


                                                    <li class="<?php
                                                    foreach ($arPostTags as $keyTag => $tag) {
                                                        echo " portfolio-filter-".$tag->term_id;

                                                    }
                                                    ?>">
                                                        <figure>
                                                            <div class="gallery-img"><a
                                                                        href="/detail/<?php echo $arDetailTemplates[wp_rand(0, count($arDetailTemplates) - 1)]; ?>?ID=<?php echo $post->ID; ?>"
                                                                        class="simple-ajax-popup-align-top"><img alt=""
                                                                                                                 src="<?php echo $fileNew; ?>"
                                                                                                                 width="<?php echo $width; ?>"
                                                                                                                 height="<?php echo $height; ?>"/></a>
                                                            </div>
                                                            <figcaption><h3><a
                                                                            href="/detail/<?php echo $arDetailTemplates[wp_rand(0, count($arDetailTemplates) - 1)]; ?>?ID=<?php echo $post->ID; ?>"
                                                                            class="simple-ajax-popup-align-top">
                                                                        <?php echo $post->post_title; ?>
                                                                    </a></h3>
                                                                <p><?php echo implode(" ", $arCurrentPostTagsNames) ?></p>
                                                            </figcaption>
                                                        </figure>
                                                    </li>
                                                        <?php

                                                        if($i == 7) break;
                                                        $i++;
                                                    }
                                                    ?>



                                                    <?php

                                                    wp_reset_postdata(); // сброс
                                                    ?>



                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
                <?php /* ?>
                <section id="blog">
                    <div class="container">
                        <div class="row">
                            <div class="wpb_column hcode-column-container  col-md-12 col-xs-mobile-fullwidth text-center margin-ten-bottom">
                                <div class="vc-column-innner-wrapper"><span class="title-number"
                                                                            style="color: #cfcfcf;">05</span>
                                    <h3 class="section-title  black-text no-padding">Блог</h3></div>
                            </div>
                            <div class="wpb_column hcode-column-container  col-md-4 col-xs-mobile-fullwidth col-sm-4">
                                <div class="vc-column-innner-wrapper">
                                    <div class="post-6176 post type-post status-publish format-standard has-post-thumbnail hentry category-sample">
                                        <div class="blog-post">
                                            <div class="blog-image"><a
                                                        href="http://wpdemos.themezaa.com/h-code/standard-post-with-picture-4/"><img
                                                            width="800" height="500"
                                                            src="http://wpdemos.themezaa.com/h-code/wp-content/uploads/2015/09/portfolio-img51.jpg"
                                                            class="attachment-full size-full wp-post-image" alt=""
                                                            title=""
                                                            srcset="http://wpdemos.themezaa.com/h-code/wp-content/uploads/2015/09/portfolio-img51.jpg 800w, http://wpdemos.themezaa.com/h-code/wp-content/uploads/2015/09/portfolio-img51-300x188.jpg 300w, http://wpdemos.themezaa.com/h-code/wp-content/uploads/2015/09/portfolio-img51-768x480.jpg 768w, http://wpdemos.themezaa.com/h-code/wp-content/uploads/2015/09/portfolio-img51-133x83.jpg 133w, http://wpdemos.themezaa.com/h-code/wp-content/uploads/2015/09/portfolio-img51-374x234.jpg 374w"
                                                            sizes="(max-width: 800px) 100vw, 800px"/></a></div>
                                            <div class="post-details"><a
                                                        href="http://wpdemos.themezaa.com/h-code/standard-post-with-picture-4/"
                                                        class="post-title sm-margin-top-ten xs-no-margin-top entry-title">Standard
                                                    post with picture</a><span
                                                        class="post-author light-gray-text2 author vcard">Posted by <a
                                                            class="url fn n light-gray-text2"
                                                            href="http://wpdemos.themezaa.com/h-code/author/admin/">admin</a> | <span
                                                            class="published">19 October 2015</span><time
                                                            class="updated display-none"
                                                            datetime="2015-12-22T10:57:15+00:00">22 December 2015</time></span>
                                                <p class="entry-content">Lorem Ipsum is simply dummy text of the
                                                    printing and typesetting industry. Lorem Ipsum has been the
                                                    industry's standard dummy text Lorem Ipsum is simply...</p></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="wpb_column hcode-column-container  col-md-4 col-xs-mobile-fullwidth col-sm-4">
                                <div class="vc-column-innner-wrapper">
                                    <div class="post-6179 post type-post status-publish format-image has-post-thumbnail hentry category-sample post_format-post-format-image">
                                        <div class="blog-post">
                                            <div class="blog-image"><a
                                                        href="http://wpdemos.themezaa.com/h-code/post-with-featured-picture-4/"><img
                                                            width="800" height="500"
                                                            src="http://wpdemos.themezaa.com/h-code/wp-content/uploads/2015/09/portfolio-img53.jpg"
                                                            class="attachment-full size-full wp-post-image" alt=""
                                                            title=""
                                                            srcset="http://wpdemos.themezaa.com/h-code/wp-content/uploads/2015/09/portfolio-img53.jpg 800w, http://wpdemos.themezaa.com/h-code/wp-content/uploads/2015/09/portfolio-img53-300x188.jpg 300w, http://wpdemos.themezaa.com/h-code/wp-content/uploads/2015/09/portfolio-img53-768x480.jpg 768w, http://wpdemos.themezaa.com/h-code/wp-content/uploads/2015/09/portfolio-img53-133x83.jpg 133w, http://wpdemos.themezaa.com/h-code/wp-content/uploads/2015/09/portfolio-img53-374x234.jpg 374w"
                                                            sizes="(max-width: 800px) 100vw, 800px"/></a></div>
                                            <div class="post-details"><a
                                                        href="http://wpdemos.themezaa.com/h-code/post-with-featured-picture-4/"
                                                        class="post-title sm-margin-top-ten xs-no-margin-top entry-title">Post
                                                    with featured picture</a><span
                                                        class="post-author light-gray-text2 author vcard">Posted by <a
                                                            class="url fn n light-gray-text2"
                                                            href="http://wpdemos.themezaa.com/h-code/author/admin/">admin</a> | <span
                                                            class="published">19 October 2015</span><time
                                                            class="updated display-none"
                                                            datetime="2015-12-22T10:55:38+00:00">22 December 2015</time></span>
                                                <p class="entry-content">Lorem Ipsum is simply dummy text of the
                                                    printing and typesetting industry. Lorem Ipsum has been the
                                                    industry's standard dummy text Lorem Ipsum is simply...</p></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="wpb_column hcode-column-container  col-md-4 col-xs-mobile-fullwidth col-sm-4">
                                <div class="vc-column-innner-wrapper">
                                    <div class="post-6181 post type-post status-publish format-standard has-post-thumbnail hentry category-sample">
                                        <div class="blog-post">
                                            <div class="blog-image"><a
                                                        href="http://wpdemos.themezaa.com/h-code/standard-post-with-slider-4/"><img
                                                            width="800" height="500"
                                                            src="http://wpdemos.themezaa.com/h-code/wp-content/uploads/2015/09/portfolio-img31.jpg"
                                                            class="attachment-full size-full wp-post-image" alt=""
                                                            title=""
                                                            srcset="http://wpdemos.themezaa.com/h-code/wp-content/uploads/2015/09/portfolio-img31.jpg 800w, http://wpdemos.themezaa.com/h-code/wp-content/uploads/2015/09/portfolio-img31-300x188.jpg 300w, http://wpdemos.themezaa.com/h-code/wp-content/uploads/2015/09/portfolio-img31-768x480.jpg 768w, http://wpdemos.themezaa.com/h-code/wp-content/uploads/2015/09/portfolio-img31-133x83.jpg 133w, http://wpdemos.themezaa.com/h-code/wp-content/uploads/2015/09/portfolio-img31-374x234.jpg 374w"
                                                            sizes="(max-width: 800px) 100vw, 800px"/></a></div>
                                            <div class="post-details"><a
                                                        href="http://wpdemos.themezaa.com/h-code/standard-post-with-slider-4/"
                                                        class="post-title sm-margin-top-ten xs-no-margin-top entry-title">Standard
                                                    post with slider</a><span
                                                        class="post-author light-gray-text2 author vcard">Posted by <a
                                                            class="url fn n light-gray-text2"
                                                            href="http://wpdemos.themezaa.com/h-code/author/admin/">admin</a> | <span
                                                            class="published">19 October 2015</span><time
                                                            class="updated display-none"
                                                            datetime="2015-12-22T10:53:16+00:00">22 December 2015</time></span>
                                                <p class="entry-content">Lorem Ipsum is simply dummy text of the
                                                    printing and typesetting industry. Lorem Ipsum has been the
                                                    industry's standard dummy text Lorem Ipsum is simply...</p></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
 <?php */ ?>
                <section class="  fix-background js-background"
                         data-image="<?php displayRandomElement($currentBackgroundImage) ?>"
                         style=" background-image: url(); ">
                    <div class="selection-overlay" style=" opacity:0.8; background-color:#f4f5f6;"></div>
                    <div class="container">
                        <div class="row">
                            <?php
                            $randomText = randomText();
                            ?>
                            <div class="wpb_column hcode-column-container  col-md-6 col-xs-mobile-fullwidth col-sm-10 text-center center-col wow bounce">
                                <div class="vc-column-innner-wrapper">
                                    <div class="testimonial-style2"><i
                                                class="fa fa-quote-left medium-icon margin-five no-margin-top"
                                                style="color:#000000 !important"></i><h6 class="black-text col-xs-12">
                                        <?php echo $randomText[0]; ?>
                                        </h6> <span class="name light-gray-text2"
                                                               style="color:#000000 !important"><?php echo $randomText[1]; ?></span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>


                <?php
                include $_SERVER['DOCUMENT_ROOT'] . '/includes/detail_contact-us__personal.php';
                ?>

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