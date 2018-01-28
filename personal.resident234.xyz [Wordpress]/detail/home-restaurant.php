<?php
/**
 * Created by PhpStorm.
 * User: GSU
 * Date: 29.07.2017
 * Time: 15:07
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
<body class="page-template-default page page-id-9 wpb-js-composer js-comp-ver-5.1 vc_responsive">
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
<section class="parent-section no-padding post-9 page type-page status-publish hentry">
    <div class="container-fluid">
        <div class="row">
            <div class="entry-content">
                <section class="  no-padding">
                    <div class="container-fluid">
                        <div class="row">
                            <div class="wpb_column hcode-column-container  col-xs-mobile-fullwidth">
                                <div class="vc-column-innner-wrapper">
                                    <div id="hcode-owl-slider3"
                                         class="owl-carousel owl-theme  round-pagination light-pagination light-navigation white-cursor restaurant-header  hcode-owl-slider3 ">
                                        <div class="item owl-bg-img  js-background"
                                             style=" background-image: url(); "
                                             data-image="<? displayRandomElement($currentBackgroundImage);?>">
                                            <div class="opacity-medium bg-black"></div>
                                            <div class="container full-screen position-relative">
                                                <div class="slider-typography">
                                                    <div class="slider-text-middle-main">
                                                        <div class="slider-text-middle"><h1
                                                                class="white-text font-weight-400 margin-five no-margin-bottom">
                                                                <span class="font-weight-600 letter-spacing-2">
                                                                    <?php echo $arProject["post_title"];?>
                                                                </span>
                                                            </h1>
                                                            <p class="resturant-slider-text white-text"> <?php displayRandomElement($arPostTagsNames); ?></p> <a
                                                                class="starting text-med text-uppercase font-weight-600 letter-spacing-2 black-text margin-two bg-golden-yellow display-inline-block inner-link"
                                                                href="/projects/" target="_self">Все проекты</a></div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="item owl-bg-img js-background"
                                             style=" background-image: url(); "
                                             data-image="<? displayRandomElement($currentBackgroundImage);?>">
                                            <div class="opacity-medium bg-black"></div>
                                            <div class="container full-screen position-relative">
                                                <div class="slider-typography">
                                                    <div class="slider-text-middle-main">
                                                        <div class="slider-text-middle"><h1
                                                                class="white-text font-weight-400 margin-five no-margin-bottom">
                                                                <span
                                                                    class="font-weight-600 letter-spacing-2"><?php echo get_post_meta($arProject["ID"], 'YEAR')[0]; ?></span>
                                                            </h1>
                                                            <p class="resturant-slider-text white-text"><?php displayRandomElement($arPostTagsNames); ?></p> <a
                                                                class="starting text-med text-uppercase font-weight-600 letter-spacing-2 black-text margin-two bg-golden-yellow display-inline-block inner-link"
                                                                href="/skills/" target="_self">Навыки</a></div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="item owl-bg-img js-background"
                                             style=" background-image: url(); "
                                             data-image="<? displayRandomElement($currentBackgroundImage);?>">
                                            <div class="opacity-medium bg-black"></div>
                                            <div class="container full-screen position-relative">
                                                <div class="slider-typography">
                                                    <div class="slider-text-middle-main">
                                                        <div class="slider-text-middle"><h1
                                                                class="white-text font-weight-400 margin-five no-margin-bottom">
                                                                <span class="font-weight-600 letter-spacing-2"><?php displayRandomElement($arPostTagsNames); ?></span>
                                                            </h1>
                                                            <p class="resturant-slider-text white-text"><?php displayRandomElement($arPostTagsNames); ?></p> <a
                                                                class="starting text-med text-uppercase font-weight-600 letter-spacing-2 black-text margin-two bg-golden-yellow display-inline-block inner-link"
                                                                href="/sertificates/" target="_self">Сертификаты</a></div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <script type="text/javascript">/*<![CDATA[*/
                                        jQuery(document).ready(function () {
                                            jQuery("#hcode-owl-slider3").owlCarousel({
                                                navigation: true,
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
                <section class=" " style=" background-color:#f7f5e7; ">
                    <div class="container">
                        <div class="row">



                            <?php
                            //$categoryId = PORTFOLIO_WP_CATEGORY_SKILLS_ID;

                            $args = array(
                                'numberposts' => 1000,
                                'category' => $arSkillsCategoriesIDs,
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

                            $postsSkills = get_posts($args);


                            $i = 0;
                            foreach ($postsSkills as $postSkill) {
                                setup_postdata($postSkill);

                                $description = get_post_meta($postSkill->ID, 'DESCRIPTION');
                                $image = get_post_meta($postSkill->ID, 'PREVIEW_IMAGE', true);

                                if(!in_array($postSkill->post_title, $arPostTagsNames)) continue;
                                if(!$image) continue;

                                ?>




                                <div
                                        class="wpb_column hcode-column-container  col-md-3 col-xs-mobile-fullwidth
                                        col-sm-6 sm-margin-four-bottom">
                                    <div class="vc-column-innner-wrapper">
                                        <div class="restaurant-features-main bg-white ">
                                            <div class="restaurant-features text-center">
                                                <img
                                                        src="" class="js-img"
                                                        data-image="<?php echo $image; ?>"
                                                        alt="" width="60" height="75"/>
                                                <span
                                                        class="text-uppercase font-weight-600 letter-spacing-1 black-text
                                                        margin-ten display-block no-margin-bottom">
                                                    <?php echo $postSkill->post_title; ?>
                                                </span><span
                                                        class="text-small letter-spacing-1 text-uppercase">
                                                    <?php echo $description[0]; ?>
                                                </span>
                                            </div>
                                        </div>
                                    </div>
                                </div>


                                <?php
                                if($i == 3) break;
                                $i++;
                            }

                            wp_reset_postdata(); // сброс
                            ?>






                        </div>
                    </div>
                </section>


                <?php
                $arContent = preg_split('/[\n.]/u', $arProject["post_content"], -1, PREG_SPLIT_NO_EMPTY);

                $arContentBlock = array_chunk($arContent, round(count($arContent)/4));

                
                ?>



                <section class="  no-padding">
                    <div class="container-fluid">
                        <div class="row">
                            <div
                                class="wpb_column hcode-column-container  col-lg-5 col-md-6 col-xs-mobile-fullwidth text-center padding-tb7-lr11 xs-padding-lr-15px">
                                <div class="vc-column-innner-wrapper">
                                    <!--
                                    <img
                                        src="http://wpdemos.themezaa.com/h-code/wp-content/uploads/2015/08/restaurant-img17.png"
                                        alt="" width="92" height="100"/>
                                    -->
                                    <h1 class="margin-ten no-margin-bottom">
                                        <? displayRandomElement($arPostTagsNames); ?>
                                    </h1>
                                    <div class="text-med margin-ten width-90 center-col">
                                        <?php if($arContentBlock[0]) echo implode("\n", $arContentBlock[0]); ?>
                                    </div>
                                    <a href="/projects/" target="_self"
                                       class="inner-link highlight-button-black-border btn-small  no-margin-lr button btn">
                                        Все проекты
                                    </a></div>
                            </div>
                            <div
                                class="wpb_column hcode-column-container  col-lg-7 col-md-6 col-xs-mobile-fullwidth no-padding">
                                <div class="vc-column-innner-wrapper">
                                    <div class="cover-background  min-height-450 js-background"
                                         data-image="<? displayRandomElement($arProjectMockups); ?>"
                                         style="background-image:url();min-height:753px;">
                                        <div class="img-border"></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>


                <?php
                $blockNumber = wp_rand(1, 3);

                ?>
                <!---1--->
                <?php if($blockNumber == 1){ ?>
                <section class=" " style=" background-color:#f7f5e7; ">
                    <div class="container">
                        <div class="row">
                            <div
                                class="wpb_column hcode-column-container  col-md-12 col-xs-mobile-fullwidth text-center margin-ten-bottom">
                                <div class="vc-column-innner-wrapper"><h2
                                        class="section-title  margin-one-bottom xs-margin-five-bottom black-text no-padding"
                                        style="font-size:20px !important;font-weight:600 !important;;">Галерея</h2>
                                    <div class="separator-line margin-0auto"
                                         style=" background:#000000;height:4px;"></div>
                                </div>
                            </div>
                            <div class="wpb_column hcode-column-container  col-xs-mobile-fullwidth col-sm-12">
                                <div class="vc-column-innner-wrapper">
                                    <div class="work-4col gutter masonry grid-gallery ">
                                        <div class="tab-content">
                                            <ul class="grid masonry-items">

                                                <?php
                                                $filename = getRandomElement($arProjectImages);
                                                $new_filen = $_SERVER["DOCUMENT_ROOT"].'/wp-content/uploads/' . basename($filename);


                                                $fileNew = "/wp-content/uploads/" . basename($filename);

                                                cropImage($filename,
                                                    $_SERVER['DOCUMENT_ROOT'] . $fileNew,
                                                    800, 800);
                                                ?>

                                                <li class=" xs-no-padding xs-margin-ten-bottom"><a href="#"><img
                                                            src="<? echo $fileNew; ?>" class="js-img" data-image="<? echo $fileNew; ?>"
                                                            alt="" width="800" height="800"></a></li>


                                                <?php
                                                $filename = getRandomElement($arProjectImages);
                                                $new_filen = $_SERVER["DOCUMENT_ROOT"].'/wp-content/uploads/' . basename($filename);


                                                $fileNew = "/wp-content/uploads/" . basename($filename);

                                                cropImage($filename,
                                                    $_SERVER['DOCUMENT_ROOT'] . $fileNew,
                                                    800, 1630);
                                                ?>

                                                <li class=" xs-no-padding xs-margin-ten-bottom"><a href="#"><img
                                                                src="<? echo $fileNew; ?>" class="js-img" data-image="<? echo $fileNew; ?>"
                                                                alt="" width="800" height="1630"></a></li>


                                                <?php
                                                $filename = getRandomElement($arProjectImages);
                                                $new_filen = $_SERVER["DOCUMENT_ROOT"].'/wp-content/uploads/' . basename($filename);


                                                $fileNew = "/wp-content/uploads/" . basename($filename);

                                                cropImage($filename,
                                                    $_SERVER['DOCUMENT_ROOT'] . $fileNew,
                                                    800, 800);
                                                ?>

                                                <li class=" xs-no-padding xs-margin-ten-bottom"><a href="#"><img
                                                                src="" class="js-img" data-image="<? echo $fileNew; ?>"
                                                                alt="" width="800" height="800"></a>
                                                    <div class="popular-dishes-border"></div>
                                                    <div class="popular-dishes"><img
                                                                src="" class="js-img"
                                                                data-image="<?php displayRandomElement($postsSkillsImages); ?>" alt=""
                                                                width="69" height="70"
                                                        style="width:69px;"/><span
                                                            class="text-uppercase letter-spacing-2 font-weight-600 display-block"><a
                                                                href="#"><? displayRandomElement($arPostTagsNames); ?></a>
                                                        </span><span
                                                            class="text-small text-uppercase"><span
                                                                class="text-small text-uppercase"></span></span>
                                                    </div>
                                                </li>


                                                <?php
                                                $filename = getRandomElement($arProjectImages);
                                                $new_filen = $_SERVER["DOCUMENT_ROOT"].'/wp-content/uploads/' . basename($filename);


                                                $fileNew = "/wp-content/uploads/" . basename($filename);

                                                cropImage($filename,
                                                    $_SERVER['DOCUMENT_ROOT'] . $fileNew,
                                                    800, 800);
                                                ?>

                                                <li class=" xs-no-padding xs-margin-ten-bottom"><a href="#"><img
                                                                src="<? echo $fileNew; ?>" class="js-img" data-image="<? echo $fileNew; ?>"
                                                                alt="" width="800" height="800"></a></li>


                                                <?php
                                                $filename = getRandomElement($arProjectImages);
                                                $new_filen = $_SERVER["DOCUMENT_ROOT"].'/wp-content/uploads/' . basename($filename);


                                                $fileNew = "/wp-content/uploads/" . basename($filename);

                                                cropImage($filename,
                                                    $_SERVER['DOCUMENT_ROOT'] . $fileNew,
                                                    800, 800);
                                                ?>

                                                <li class=" xs-no-padding xs-margin-ten-bottom"><a href="#"><img
                                                                src="" class="js-img" data-image="<? echo $fileNew; ?>"
                                                                alt="" width="800" height="800"></a>
                                                    <div class="popular-dishes-border"></div>
                                                    <div class="popular-dishes"><img
                                                                src="" class="js-img"
                                                                data-image="<?php displayRandomElement($postsSkillsImages); ?>" alt=""
                                                                width="56" height="70"
                                                                style="width:69px;"/><span
                                                            class="text-uppercase letter-spacing-2 font-weight-600 display-block"><a
                                                                href="#"><? displayRandomElement($arPostTagsNames); ?></a></span><span
                                                            class="text-small text-uppercase"><span
                                                                class="text-small text-uppercase">

                                                            </span></span>
                                                    </div>
                                                </li>


                                                <?php
                                                $filename = getRandomElement($arProjectImages);
                                                $new_filen = $_SERVER["DOCUMENT_ROOT"].'/wp-content/uploads/' . basename($filename);


                                                $fileNew = "/wp-content/uploads/" . basename($filename);

                                                cropImage($filename,
                                                    $_SERVER['DOCUMENT_ROOT'] . $fileNew,
                                                    800, 800);
                                                ?>

                                                <li class=" xs-no-padding xs-margin-ten-bottom"><a href="#"><img
                                                                src="<? echo $fileNew; ?>" class="js-img" data-image="<? echo $fileNew; ?>"
                                                                alt="" width="800" height="800"></a></li>


                                                <?php
                                                $filename = getRandomElement($arProjectImages);
                                                $new_filen = $_SERVER["DOCUMENT_ROOT"].'/wp-content/uploads/' . basename($filename);


                                                $fileNew = "/wp-content/uploads/" . basename($filename);

                                                cropImage($filename,
                                                    $_SERVER['DOCUMENT_ROOT'] . $fileNew,
                                                    800, 800);
                                                ?>

                                                <li class=" xs-no-padding xs-margin-ten-bottom"><a href="#"><img
                                                                src="<? echo $fileNew; ?>" class="js-img" data-image="<? echo $fileNew; ?>"
                                                                alt="" width="800" height="800"></a>
                                                    <div class="popular-dishes-border"></div>
                                                    <div class="popular-dishes"><img
                                                                src="" class="js-img"
                                                                data-image="<?php displayRandomElement($postsSkillsImages); ?>" alt=""
                                                                width="45" height="70" style="width:69px;"/><span
                                                            class="text-uppercase letter-spacing-2 font-weight-600 display-block"><a
                                                                href="#"><? displayRandomElement($arPostTagsNames); ?></a></span><span
                                                            class="text-small text-uppercase"><span
                                                                class="text-small text-uppercase"></span></span>
                                                    </div>
                                                </li>



                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
                <section class="  no-padding">
                    <div class="container-fluid">
                        <div class="row">
                            <div
                                class="wpb_column hcode-column-container  col-lg-7 col-md-6 col-xs-mobile-fullwidth no-padding">
                                <div class="vc-column-innner-wrapper">
                                    <div class="cover-background  min-height-450  js-background"
                                         data-image="<? displayRandomElement($arProjectAllImages); ?>"
                                         style="background-image:url();min-height:753px;">
                                        <div class="img-border"></div>
                                    </div>
                                </div>
                            </div>
                            <div
                                class="wpb_column hcode-column-container  col-lg-5 col-md-6 col-xs-mobile-fullwidth text-center padding-tb7-lr11 xs-padding-lr-15px">
                                <div class="vc-column-innner-wrapper"><img
                                            src="" class="js-img"
                                            data-image="<?php displayRandomElement($postsSkillsImages); ?>" alt=""
                                            alt="" width="92" height="100"/>
                                    <h1 class="margin-ten no-margin-bottom">
                                        <?php displayRandomElement($arPostTagsNames); ?>
                                    </h1>
                                    <div class="text-med margin-ten width-90 center-col">
                                        <?php if($arContentBlock[1]) echo implode("\n", $arContentBlock[1]); ?>
                                    </div>
                                    <a href="/skills/" target="_self"
                                       class="inner-link highlight-button-black-border btn-small  no-margin-lr
                                       button btn">
                                        Навыки
                                    </a></div>
                            </div>
                        </div>
                    </div>
                </section>
                <section class=" " style=" background-color:#f7f5e7; ">
                    <div class="container">
                        <div class="row">
                            <div
                                class="wpb_column hcode-column-container  col-md-12 col-xs-mobile-fullwidth text-center margin-ten-bottom">
                                <div class="vc-column-innner-wrapper"><h2
                                        class="section-title  margin-one-bottom xs-margin-five-bottom black-text no-padding"
                                        style="font-size:20px !important;font-weight:600 !important;;">Сведения</h2>
                                    <div class="separator-line margin-0auto"
                                         style=" background:#000000;height:4px;"></div>
                                </div>
                            </div>
                            <div
                                class="wpb_column hcode-column-container  col-xs-mobile-fullwidth col-sm-12 text-center">
                                <div class="vc-column-innner-wrapper">
                                    <div id="hcode-restaurent-menu"
                                         class="col-xs-12 no-padding bottom-pagination position-relative  round-pagination dark-pagination dark-navigation">
                                        <div class="item">
                                            <div class="col-md-6 restaurant-menu-img cover-background  js-background"
                                                 data-image="<? displayRandomElement($arProjectAllImages); ?>"
                                                 style="background-image:url();">
                                                <div class="img-border"></div>
                                                <div class="opacity-full bg-dark-gray"></div>
                                                <div class="popular-dishes"><img
                                                            src="" class="js-img"
                                                            data-image="<?php displayRandomElement($postsSkillsImages); ?>"
                                                            width="71" height="75" alt="" style="width: 70px;"/><br><span
                                                        class="title-small white-text text-uppercase
                                                        letter-spacing-3"><?php displayRandomElement($arPostTagsNames); ?></span><br><span
                                                        class="food-time text-small white-text display-inline-block
                                                        text-uppercase letter-spacing-2"></span>
                                                </div>
                                            </div>
                                            <div
                                                class="col-md-6 bg-white restaurant-menu-text-main margin-three no-margin-top">
                                                <div class="restaurant-menu-text">
                                                    <div class="menu-item first"><p><span
                                                                class="text-uppercase font-weight-600 black-text
                                                                letter-spacing-2">Название проекта</span><span
                                                                class="text-med text-uppercase font-weight-600
                                                                black-text letter-spacing-2"></span>
                                                        </p>
                                                        <p class="letter-spacing-1"><?php echo $arProject["post_title"];?></p></div>
                                                    <div class="menu-item"><p><span
                                                                class="text-uppercase font-weight-600 black-text
                                                                letter-spacing-2">Описание проекта</span>
                                                            <span
                                                                class="text-med text-uppercase font-weight-600
                                                                black-text letter-spacing-2"></span>
                                                        </p>
                                                        <p class="letter-spacing-1">
                                                            <?php echo $arProject["post_content_formatted"]; ?>
                                                        </p></div>

                                                    <div class="menu-item"><p><span
                                                                class="text-uppercase font-weight-600 black-text
                                                                letter-spacing-2"> </span><span
                                                                class="text-med text-uppercase font-weight-600
                                                                black-text letter-spacing-2"> </span>
                                                        </p>
                                                        <p class="letter-spacing-1">

                                                        </p></div>
                                                    <div class="menu-item"><p><span
                                                                class="text-uppercase font-weight-600 black-text
                                                                letter-spacing-2"> </span><span
                                                                class="text-med text-uppercase font-weight-600
                                                                black-text letter-spacing-2"> </span>
                                                        </p>
                                                        <p class="letter-spacing-1">

                                                        </p></div>
                                                    <div class="menu-item"><p><span
                                                                class="text-uppercase font-weight-600 black-text
                                                                letter-spacing-2"> </span><span
                                                                class="text-med text-uppercase font-weight-600
                                                                black-text letter-spacing-2"> </span>
                                                        </p>
                                                        <p class="letter-spacing-1">

                                                        </p></div>
                                                    <div class="menu-item"><p><span
                                                                class="text-uppercase font-weight-600 black-text
                                                                letter-spacing-2"> </span><span
                                                                class="text-med text-uppercase font-weight-600
                                                                black-text letter-spacing-2"> </span>
                                                        </p>
                                                        <p class="letter-spacing-1">

                                                        </p></div>



                                                </div>
                                            </div>
                                        </div>
                                        <div class="item">
                                            <div class="col-md-6 restaurant-menu-img cover-background  js-background"
                                                 data-image="<? displayRandomElement($arProjectAllImages); ?>"
                                                 style="background-image:url();">
                                                <div class="img-border"></div>
                                                <div class="opacity-full bg-dark-gray"></div>
                                                <div class="popular-dishes"><img
                                                            src="" class="js-img"
                                                            data-image="<?php displayRandomElement($postsSkillsImages); ?>"
                                                            width="60" height="75" alt=""  style="width: 60px;"/><br><span
                                                        class="title-small white-text text-uppercase
                                                        letter-spacing-3"><?php displayRandomElement($arPostTagsNames); ?></span><br><span
                                                        class="food-time text-small white-text display-inline-block
                                                        text-uppercase letter-spacing-2"></span>
                                                </div>
                                            </div>
                                            <div
                                                class="col-md-6 bg-white restaurant-menu-text-main margin-three no-margin-top">
                                                <div class="restaurant-menu-text"><p></p>
                                                    <div class="menu-item first"><p><span
                                                                class="text-uppercase font-weight-600 black-text
                                                                letter-spacing-2">Год разработки</span><span
                                                                class="text-med text-uppercase font-weight-600
                                                                black-text letter-spacing-2"></span>
                                                        </p>
                                                        <p class="letter-spacing-1">
                                                            <?php echo get_post_meta($arProject["ID"], 'YEAR')[0]; ?>
                                                        </p></div>
                                                    <p></p>

                                                    <?php
                                                    $URL = get_post_meta($arProject["ID"], 'URL');

                                                    if(!empty($URL)) {
                                                        ?>



                                                        <div class="menu-item"><p><span
                                                                        class="text-uppercase font-weight-600 black-text
                                                                letter-spacing-2">Ссылка на проект</span><span
                                                                        class="text-med text-uppercase font-weight-600 black-text
                                                                letter-spacing-2"></span>
                                                            </p>
                                                            <p class="letter-spacing-1"><a href="<?php echo $URL[0]; ?>"
                                                                                           target="_blank">
                                                                    <?php echo $URL[0]; ?>
                                                                </a></p></div>


                                                        <p></p>
                                                        <?php
                                                    }
                                                    ?>



                                                    <div class="menu-item"><p><span
                                                                class="text-uppercase font-weight-600 black-text
                                                                 letter-spacing-2"> </span><span
                                                                class="text-med text-uppercase font-weight-600
                                                                black-text letter-spacing-2"> </span>
                                                        </p>
                                                        <p class="letter-spacing-1">

                                                        </p></div>
                                                    <p></p>
                                                    <div class="menu-item"><p><span
                                                                class="text-uppercase font-weight-600 black-text
                                                                letter-spacing-2"> </span><span
                                                                class="text-med text-uppercase font-weight-600
                                                                black-text letter-spacing-2"> </span>
                                                        </p>
                                                        <p class="letter-spacing-1">

                                                        </p></div>
                                                    <p></p>
                                                    <div class="menu-item"><p><span
                                                                class="text-uppercase font-weight-600 black-text
                                                                letter-spacing-2"> </span><span
                                                                class="text-med text-uppercase font-weight-600
                                                                black-text letter-spacing-2"> </span>
                                                        </p>
                                                        <p class="letter-spacing-1">

                                                        </p></div>
                                                    <p></p>
                                                    <div class="menu-item"><p><span
                                                                class="text-uppercase font-weight-600 black-text
                                                                letter-spacing-2"> </span><span
                                                                class="text-med text-uppercase font-weight-600
                                                                black-text letter-spacing-2"> </span>
                                                        </p>
                                                        <p class="letter-spacing-1">

                                                        </p></div>
                                                    <p></p></div>

                                            </div>
                                        </div>
                                        <div class="item">
                                            <div class="col-md-6 restaurant-menu-img cover-background  js-background"
                                                 data-image="<? displayRandomElement($arProjectAllImages); ?>"
                                                 style="background-image:url();">
                                                <div class="img-border"></div>
                                                <div class="opacity-full bg-dark-gray"></div>
                                                <div class="popular-dishes"><img
                                                            src="" class="js-img"
                                                            data-image="<?php displayRandomElement($postsSkillsImages); ?>"
                                                            width="63" height="75" alt=""  style="width: 63px;"/><br><span
                                                        class="title-small white-text text-uppercase
                                                        letter-spacing-3"><?php displayRandomElement($arPostTagsNames); ?></span><br><span
                                                        class="food-time text-small white-text display-inline-block
                                                        text-uppercase letter-spacing-2"></span>
                                                </div>
                                            </div>
                                            <div
                                                class="col-md-6 bg-white restaurant-menu-text-main margin-three no-margin-top">
                                                <div class="restaurant-menu-text"><p></p>
                                                    <div class="menu-item first"><p><span
                                                                class="text-uppercase font-weight-600 black-text
                                                                letter-spacing-2">Тэги проекта</span><span
                                                                class="text-med text-uppercase font-weight-600
                                                                black-text letter-spacing-2"></span>
                                                        </p>
                                                        <p class="letter-spacing-1">

                                                        </p></div>
                                                    <p></p>




                                                    <?php 
                                                    foreach($arPostTagsNames as $projectTag){
                                                    ?>
                                                    <div class="menu-item"><p><span
                                                                class="text-uppercase font-weight-600 black-text 
                                                                letter-spacing-2">
                                                                
                                                            </span><span
                                                                class="text-med text-uppercase font-weight-600 
                                                                black-text letter-spacing-2">
                                                                
                                                            </span>
                                                        </p>
                                                        <p class="letter-spacing-1">
                                                            <?php echo $projectTag; ?>
                                                        </p></div>
                                                    <p></p>
                                                    <? } ?>



                                                    
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <script type="text/javascript">
                                        jQuery(document).ready(function () {
                                            jQuery("#hcode-restaurent-menu").owlCarousel({
                                                navigation: false,
                                                pagination: true,
                                                autoPlay: false,
                                                stopOnHover: false,
                                                addClassActive: false,
                                                singleItem: true,
                                                paginationSpeed: 400,
                                                navigationText: ["<i class='fa fa-angle-left'></i>", "<i class='fa fa-angle-right'></i>"]
                                            });
                                        });


                                    </script>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
                <?php } ?>



                <!---2--->
                <?php if($blockNumber == 2){ ?>
                <section class="  no-padding" style=" background-color:#f7f5e7; ">
                    <div class="container-fluid">
                        <div class="row">


                            <?php
                            $filename = getRandomElement($arProjectImages);
                            $new_filen = $_SERVER["DOCUMENT_ROOT"].'/wp-content/uploads/' . basename($filename);


                            $fileNew = "/wp-content/uploads/" . basename($filename);

                            cropImage($filename,
                                $_SERVER['DOCUMENT_ROOT'] . $fileNew,
                                800, 500);
                            ?>
                            <div
                                class="wpb_column hcode-column-container  col-md-3 col-xs-mobile-fullwidth col-sm-6 no-padding">
                                <div class="vc-column-innner-wrapper">
                                    <div class="cover-background js-background" data-image="<?php echo $fileNew; ?>"
                                         style="background-image:url();">
                                        <div class="food-services-inner">
                                            <div class="food-services-border text-center"><span
                                                    class="text-extra-large text-uppercase letter-spacing-2
                                                    white-text display-block font-weight-600 margin-one
                                                    no-margin-top"> <?php displayRandomElement($arPostTagsNames); ?></span><span
                                                    class="food-time text-small white-text display-inline-block
                                                    text-uppercase letter-spacing-2"></span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <?php
                            $filename = getRandomElement($arProjectImages);
                            $new_filen = $_SERVER["DOCUMENT_ROOT"].'/wp-content/uploads/' . basename($filename);


                            $fileNew = "/wp-content/uploads/" . basename($filename);

                            cropImage($filename,
                                $_SERVER['DOCUMENT_ROOT'] . $fileNew,
                                800, 500);
                            ?>
                            <div
                                class="wpb_column hcode-column-container  col-md-3 col-xs-mobile-fullwidth col-sm-6 no-padding">
                                <div class="vc-column-innner-wrapper">
                                    <div class="cover-background js-background" data-image="<?php echo $fileNew; ?>"
                                         style="background-image:url();">
                                        <div class="food-services-inner">
                                            <div class="food-services-border text-center"><span
                                                    class="text-extra-large text-uppercase letter-spacing-2
                                                    white-text display-block font-weight-600 margin-one
                                                    no-margin-top"> <?php displayRandomElement($arPostTagsNames); ?></span><span
                                                    class="food-time text-small white-text display-inline-block
                                                    text-uppercase letter-spacing-2"></span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <?php
                            $filename = getRandomElement($arProjectImages);
                            $new_filen = $_SERVER["DOCUMENT_ROOT"].'/wp-content/uploads/' . basename($filename);


                            $fileNew = "/wp-content/uploads/" . basename($filename);

                            cropImage($filename,
                                $_SERVER['DOCUMENT_ROOT'] . $fileNew,
                                800, 500);
                            ?>
                            <div
                                class="wpb_column hcode-column-container  col-md-3 col-xs-mobile-fullwidth col-sm-6 no-padding">
                                <div class="vc-column-innner-wrapper">
                                    <div class="cover-background js-background" data-image="<?php echo $fileNew; ?>"
                                         style="background-image:url();">
                                        <div class="food-services-inner">
                                            <div class="food-services-border text-center"><span
                                                    class="text-extra-large text-uppercase letter-spacing-2
                                                    white-text display-block font-weight-600 margin-one
                                                    no-margin-top"> <?php displayRandomElement($arPostTagsNames); ?></span><span
                                                    class="food-time text-small white-text display-inline-block
                                                    text-uppercase letter-spacing-2"></span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <?php
                            $filename = getRandomElement($arProjectImages);
                            $new_filen = $_SERVER["DOCUMENT_ROOT"].'/wp-content/uploads/' . basename($filename);


                            $fileNew = "/wp-content/uploads/" . basename($filename);

                            cropImage($filename,
                                $_SERVER['DOCUMENT_ROOT'] . $fileNew,
                                800, 500);
                            ?>
                            <div
                                class="wpb_column hcode-column-container  col-md-3 col-xs-mobile-fullwidth col-sm-6 no-padding">
                                <div class="vc-column-innner-wrapper">
                                    <div class="cover-background js-background" data-image="<?php echo $fileNew; ?>"
                                         style="background-image:url();">
                                        <div class="food-services-inner">
                                            <div class="food-services-border text-center"><span
                                                    class="text-extra-large text-uppercase letter-spacing-2
                                                    white-text display-block font-weight-600 margin-one
                                                    no-margin-top"> <?php displayRandomElement($arPostTagsNames); ?> </span><span
                                                    class="food-time text-small white-text display-inline-block
                                                    text-uppercase letter-spacing-2"></span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>





                        </div>
                    </div>
                </section>

                
                <section class=" " style=" background-color:#f7f5e7; ">
                    <div class="container">
                        <div
                            class="wpb_column hcode-column-container  col-md-12 col-xs-mobile-fullwidth text-center margin-ten-bottom">
                            <div class="vc-column-innner-wrapper"><h2
                                    class="section-title  margin-one-bottom xs-margin-five-bottom black-text no-padding"
                                    style="font-size:20px !important;font-weight:600 !important;;">Тэги</h2>
                                <div class="separator-line margin-0auto" style=" background:#000000;height:4px;"></div>
                            </div>
                        </div>
                        <div class="wpb_column hcode-column-container  col-md-6 col-xs-mobile-fullwidth no-padding">
                            <div class="vc-column-innner-wrapper">
                                <div class="cover-background  min-height-450  js-background"
                                     data-image="<? displayRandomElement($arProjectAllImages); ?>"
                                     style="background-image:url();min-height:625px;">
                                    <div class="img-border"></div>
                                </div>
                            </div>
                        </div>
                        <div
                            class="wpb_column hcode-column-container  column-min-height col-md-6 col-xs-mobile-fullwidth
                            text-center padding-ten xs-padding-lr-15px sm-margin-ten-bottom"
                            style=" min-height:625px; background:#ffffff;">
                            <div class="vc-column-innner-wrapper"><img
                                        src="" class="js-img"
                                        data-image="<?php displayRandomElement($postsSkillsImages); ?>"
                                        alt="" width="109" height="100" style="width:109px;"/>
                                <h1 class="margin-ten no-margin-bottom"
                                    style=" font-size:15px !important; line-height:24px; color: !important;"><?php displayRandomElement($arPostTagsNames); ?></h1><span
                                    class="text-small text-uppercase letter-spacing-3"><?php displayRandomElement($arPostTagsNames); ?></span>
                                <p class="text-med margin-ten width-90 center-col">
                                    <?php if($arContentBlock[2]) echo implode("\n", $arContentBlock[2]); ?>
                                </p> <a href="/info/experience/" target="_self"

                                        class="inner-link highlight-button-black-border btn-small
                                        no-margin-lr button btn">
                                    Опыт работы
                                </a></div>
                        </div>
                        <div
                            class="wpb_column hcode-column-container  column-min-height col-md-6 col-xs-mobile-fullwidth text-center padding-ten xs-padding-lr-15px"
                            style=" min-height:625px; background:#ffffff;">
                            <div class="vc-column-innner-wrapper"><img
                                        src="" class="js-img"
                                        data-image="<?php displayRandomElement($postsSkillsImages); ?>"
                                        alt="" width="92" height="100" style="width:92px;"/>
                                <h1 class="margin-ten no-margin-bottom"
                                    style=" font-size:15px !important; line-height:24px; color: !important;"><?php displayRandomElement($arPostTagsNames); ?></h1>
                                <span class="text-small text-uppercase letter-spacing-3"><?php displayRandomElement($arPostTagsNames); ?></span>
                                <p class="text-med margin-ten width-90 center-col">
                                    <?php if($arContentBlock[3]) echo implode("\n", $arContentBlock[3]); ?>
                                </p> <a href="/services/" target="_self"
                                                                                     class="inner-link highlight-button-black-border btn-small  no-margin-lr button btn">
                                    Услуги
                                </a></div>
                        </div>
                        <div class="wpb_column hcode-column-container  col-md-6 col-xs-mobile-fullwidth no-padding">
                            <div class="vc-column-innner-wrapper">
                                <div class="cover-background  min-height-450 js-background"
                                     data-image="<? displayRandomElement($arProjectAllImages); ?>"
                                     style="background-image:url();min-height:625px;">
                                    <div class="img-border"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>

                <section>
                    <div class="container">
                        <div class="row">
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

                                $arPostTags = wp_get_post_tags($post->ID);
                                unset($arCurrentPostTagsNames);
                                foreach ($arPostTags as $tag){
                                    $arCurrentPostTagsNames[] = $tag->name;
                                }


                                $filename = $thumb_url[0];
                                $new_filen = $_SERVER["DOCUMENT_ROOT"].'/wp-content/uploads/' . basename($filename);


                                $fileNew = "/wp-content/uploads/" . basename($filename);

                                cropImage($filename,
                                    $_SERVER['DOCUMENT_ROOT'] . $fileNew,
                                    300, 300);
                                ?>



                                <div
                                        class="wpb_column hcode-column-container  col-md-4 col-xs-mobile-fullwidth col-sm-4
                                        text-center xs-margin-ten-bottom">
                                    <div class="vc-column-innner-wrapper">
                                        <div class="testimonial-style2"><img
                                                    src="" class="js-img"
                                                    data-image="<?php echo $fileNew; ?>"
                                                    alt="" width="300" height="300"/>
                                            <p class="center-col width-90">
                                                <?php
                                                $post_content = preg_replace("/\\[.+\\]/m","",
                                                    $post->post_content);
                                                //$post_content = str_replace("\n","<br>",
                                                //    $post_content);

                                                echo kama_excerpt( array('text'=>$post_content,
                                                    'maxchar'=>500,
                                                    'autop' => false) );

                                                ?>
                                            </p>
                                            <div class="margin-two"><i class="fa fa-star" style="color:#e6af2a;"></i><i
                                                        class="fa fa-star" style="color:#e6af2a;"></i><i class="fa fa-star"
                                                                                                         style="color:#e6af2a;"></i><i
                                                        class="fa fa-star" style="color:#e6af2a;"></i><i class="fa fa-star"
                                                                                                         style="color:#e6af2a;"></i>
                                            </div>
                                            <span class="name light-gray-text2"
                                                  style="color:#0a0a0a;"><?php echo $post->post_title; ?></span></div>
                                    </div>
                                </div>
                                <?php
                                if($i == 3) break;
                                $i++;
                            }

                            wp_reset_postdata(); // сброс
                            ?>





                        </div>
                    </div>
                </section>

                <?php } ?>


                <!---3--->
                <?php if($blockNumber == 3){ ?>
                <section class="  fix-background js-background"
                         style=" background-image: url(); "
                         data-image="<? displayRandomElement($currentBackgroundImage);?>">
                    <div class="selection-overlay" style=" opacity:0.8; background-color:#1b161c;"></div>
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
                                class="wpb_column hcode-column-container  col-md-3 col-xs-mobile-fullwidth col-sm-6 text-center sm-margin-ten-bottom wow fadeInUp"
                                data-wow-duration=300ms>
                                <div class="vc-column-innner-wrapper">
                                    <div class="counter-section"><span id="counter_1" data-to="<?php echo $countPosts;?>"
                                                                       class="counter-number white-text"><?php echo $countPosts;?></span><span
                                            class="counter-title white-text">
                                            <?php
                                            echo numberof($countPosts, '',
                                                array('Проект', 'Проекта', 'Проектов'));
                                            ?>
                                        </span></div>
                                </div>
                            </div>
                            <div
                                class="wpb_column hcode-column-container  col-md-3 col-xs-mobile-fullwidth col-sm-6 text-center sm-margin-ten-bottom wow fadeInUp"
                                data-wow-duration=600ms>
                                <div class="vc-column-innner-wrapper">
                                    <div class="counter-section"><span id="counter_2" data-to="<?php echo $countSertificates;?>"
                                                                       class="counter-number white-text"><?php echo $countSertificates;?></span><span
                                            class="counter-title white-text">
                                            <?php
                                            echo numberof($countPosts, '',
                                                array('Сертификат', 'Сертификата', 'Сертификатов'));
                                            ?>

                                        </span></div>
                                </div>
                            </div>
                            <div
                                class="wpb_column hcode-column-container  col-md-3 col-xs-mobile-fullwidth col-sm-6 text-center xs-margin-ten-bottom wow fadeInUp"
                                data-wow-duration=900ms>
                                <div class="vc-column-innner-wrapper">
                                    <div class="counter-section"><span id="counter_3" data-to="<?php echo $countFilesInRepo; ?>"
                                                                       class="counter-number white-text"><?php echo $countFilesInRepo; ?></span><span
                                            class="counter-title white-text">Файлов с кодом в репозитории</span></div>
                                </div>
                            </div>
                            <div
                                class="wpb_column hcode-column-container  col-md-3 col-xs-mobile-fullwidth col-sm-6 text-center wow fadeInUp"
                                data-wow-duration=1200ms>
                                <div class="vc-column-innner-wrapper">
                                    <div class="counter-section"><span id="counter_4" data-to="<?php echo $humanYearsRemote; ?>"
                                                                       class="counter-number white-text"><?php echo $humanYearsRemote; ?></span><span
                                            class="counter-title white-text"><?php
                                            echo numberof($humanYearsRemote, '', array('год', 'года', 'лет'));
                                            ?> опыта удалённой работы </span></div>
                                </div>
                            </div>



                        </div>
                    </div>
                </section>
                <?php } ?>
            </div>
        </div>
    </div>
</section>
<?php
include $_SERVER['DOCUMENT_ROOT'] . '/includes/detail_pagination_margin-top.php';
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