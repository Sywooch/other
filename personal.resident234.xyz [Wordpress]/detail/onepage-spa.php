<?php
/**
 * Created by PhpStorm.
 * User: GSU
 * Date: 29.07.2017
 * Time: 15:30
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
<body class="page-template-default page page-id-46 wpb-js-composer js-comp-ver-5.1 vc_responsive">
<nav
    class="navbar navbar-default navbar-fixed-top nav-transparent overlay-nav sticky-nav white-header nav-border-bottom  nav-black "
    data-menu-hover-delay="100">
    <div class="container">
        <div class="row">

            <?php
            include $_SERVER['DOCUMENT_ROOT'] . '/includes/head_logo_spa.php';
            ?>
            <div class="navbar-header col-sm-8 sm-width-auto col-xs-2 pull-right">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse"><span
                        class="sr-only">Toggle navigation</span> <span class="icon-bar"></span> <span
                        class="icon-bar"></span> <span class="icon-bar"></span></button>
            </div>
            <div class="col-md-8 no-padding-right accordion-menu text-right pull-right menu-position-right">
                <div id="mega-menu" class="navbar-collapse collapse navbar-right">
                    <ul id="menu-onepage-spa" class="mega-menu-ul nav navbar-nav navbar-right panel-group">
                        <?php
                        include $_SERVER['DOCUMENT_ROOT'] . '/includes/main_menu.php';
                        ?>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</nav>
<section class="parent-section no-padding post-46 page type-page status-publish hentry">
    <div class="container-fluid">
        <div class="row">
            <div class="entry-content">
                <section id="slider" class="  parallax-fix parallax6 full-screen no-padding
js-background" data-image="<?php displayRandomElement($arProjectAllImages); ?>"
                         style=" background-image: url(); ">
                    <div
                        class="wpb_column hcode-column-container  pull-right col-md-6 col-xs-12 col-sm-6 no-padding-right xs-no-padding-left">
                        <div class="vc-column-innner-wrapper">
                            <div class="spa-sider">
                                <div class="slider-content position-relative full-screen">
                                    <img class="spa-slider-bg"

                                         src="http://wpdemos.themezaa.com/h-code/wp-content/uploads/2015/08/onepage-spa-slider-bg.jpg"
                                                                                               alt="">
                                    <div class="slider-typography padding-seven">
                                        <div class="slider-text-middle-main padding-six-lr sm-no-padding">
                                            <div class="slider-text-middle slider-text-middle2 text-left xs-no-padding">
                                                <img alt="" class="get-bg xs-display-none js-img"
                                                     data-image="<?php displayRandomElement($arProjectAllImages); ?>"
                                                     src=""
                                                     width="323"/>
                                                <div
                                                    class="separator-line no-margin-lr no-margin-top sm-margin-bottom-ten"
                                                    style="background-color:#e6af2a;"></div>
                                                <span
                                                    class="owl-title single-image-title-box white-text margin-four-bottom sm-margin-bottom-ten">
                                                    <?php echo $arProject["post_title"]; ?></span>
                                                <div
                                                    class="slider-title-big5 alt-font white-text no-margin-top xs-margin-bottom-ten">
                                                    <?php echo implode(" ", $arPostTagsNames); ?>
                                                </div>
                                                <a class="btn-small-white btn inner-link no-margin-top"
                                                   href="#treatments">Далее</a></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
                <section id="animated-tab">
                    <div class="container">
                        <div class="row">
                            <div
                                class="wpb_column hcode-column-container  col-md-12 col-xs-mobile-fullwidth text-center">
                                <div class="vc-column-innner-wrapper"><h3 class="section-title
                                black-text">
                                        Сведения
                                    </h3></div>
                            </div>
                            <div
                                class="wpb_column hcode-column-container  col-md-6 col-xs-mobile-fullwidth col-sm-6 xs-margin-ten-bottom">
                                <div class="vc-column-innner-wrapper">
                                    <div class="progress-bar-main  ">

                                        <?php foreach($arPostTagsNames as $postTagName) { ?>
                                            <?php
                                            $percentProjects = ceil(($arProjectsTypesCountsProjects[$postTagName] * 100) / $countProjects);

                                            ?>
                                            <div class="progress-bar-sub">
                                                <div class="progress">
                                                    <div class="progress-bar " role="progressbar"
                                                         aria-valuenow="<?php echo $percentProjects; ?>"
                                                         aria-valuemin="0" aria-valuemax="100"
                                                         style="width: <?php echo $percentProjects; ?>%;background-color:#000000">
                                                        <span><?php echo $percentProjects; ?>%</span>
                                                    </div>
                                                </div>
                                                <div class="progress-name"><strong class="black-text"></strong>
                                                    <?php echo $postTagName; ?>
                                                </div>
                                            </div>
                                            <?php
                                        }
                                        ?>




                                    </div>
                                </div>
                            </div>
                            <div class="wpb_column hcode-column-container  col-md-6 col-xs-mobile-fullwidth col-sm-6">
                                <div class="vc-column-innner-wrapper"><p class="text-large
                                no-margin-bottom">
                                        Детальное описание
                                    </p>
                                    <p class="text-uppercase gray-text margin-one">
                                        <?php echo $arProject["post_content_formatted"]; ?>
                                    </p>
                                </div>
                            </div>
                            <div class="wpb_column hcode-column-container  col-xs-mobile-fullwidth">
                                <div class="vc-column-innner-wrapper">
                                    <div class="hcode-space margin-five-top"></div>
                                </div>
                            </div>



                            <?php
                            foreach($arProjectSkills as $keyProjectSkill => $projectSkill) {

                                ?>
                                <div
                                        class="wpb_column hcode-column-container 1 col-md-3 col-xs-6 col-sm-3 text-center xs-margin-ten-bottom">
                                    <div class="vc-column-innner-wrapper">
                                        <div class="icon-bg"><img alt="" class="js-img"
                                                                  data-image="<?php echo $projectSkill->image; ?>"
                                                                  src=""
                                                                   height="124" style="max-height:124px;"></div>
                                        <span
                                                class="display-block margin-ten work-process-title
                                                 no-margin-bottom gray-text">
                                            <?php echo $projectSkill->post_title; ?>
                                        </span>
                                    </div>
                                </div>
                                <?php
                                if($keyProjectSkill == 3) break;
                            }
                            ?>



                        </div>
                    </div>
                </section>
                <section id="treatments" class=" " style=" background-color:#f8f7f5; ">
                    <div class="container">
                        <div class="row">
                            <div
                                class="wpb_column hcode-column-container  col-md-12 col-xs-mobile-fullwidth text-center">
                                <div class="vc-column-innner-wrapper"><h3 class="section-title
                                 black-text no-padding">
                                        Прочие проекты</h3></div>
                            </div>
                            <div
                                class="wpb_column hcode-column-container  col-md-5 col-xs-mobile-fullwidth text-center center-col margin-five">
                                <div class="vc-column-innner-wrapper"><h4 class="gray-text">
                                        <?php echo randomText()[0]; ?>
                                    </h4></div>
                            </div>
                            <div
                                class="wpb_column hcode-column-container  col-md-12 col-xs-mobile-fullwidth text-center">
                                <div class="vc-column-innner-wrapper">
                                    <div class="tab-style1">
                                        <div class="row">
                                            <div class="col-md-12 col-sm-12">
                                                <ul class="nav nav-tabs nav-tabs-light">
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

                                                        $arPostTagsWidget = wp_get_post_tags($post->ID);
                                                        unset($arPostTagsNamesWidget);
                                                        foreach ($arPostTagsWidget as $keyTag => $tag) {
                                                            //$postTagId = $tag->term_id;
                                                            $arPostTagsNamesWidget[] = $tag->name;

                                                        }
                                                        $thumb_id = get_post_thumbnail_id($post->ID);
                                                        $thumb_url_full = wp_get_attachment_image_src($thumb_id, 'full',
                                                            false);

                                                        $thumb_url_full[0] = str_replace(get_site_url(),
                                                            PORTFOLIO_WP_URL,
                                                            $thumb_url_full[0]);

                                                        ?>
                                                        <li <?php if($i == 1){ ?>class="active"<?php } ?>>
                                                            <a href="#hcode-1501298931-2082702610-<?php echo $i; ?>"
                                                                              data-toggle="tab">
                                                                <?php echo $post->post_title; ?>
                                                            </a></li>




                                                        <?php
                                                        if ($i == 5) {
                                                            break;
                                                        }
                                                        $i++;
                                                    }
                                                    ?>



                                                </ul>
                                            </div>
                                        </div>
                                        <div class="tab-content">



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

                                            $arPostTagsWidget = wp_get_post_tags($post->ID);
                                            unset($arPostTagsNamesWidget);
                                            foreach ($arPostTagsWidget as $keyTag => $tag) {
                                                //$postTagId = $tag->term_id;
                                                $arPostTagsNamesWidget[] = $tag->name;

                                            }
                                            $thumb_id = get_post_thumbnail_id($post->ID);
                                            $thumb_url_full = wp_get_attachment_image_src($thumb_id, 'full',
                                                false);

                                            $thumb_url_full[0] = str_replace(get_site_url(),
                                                PORTFOLIO_WP_URL,
                                                $thumb_url_full[0]);

                                            ?>

                                            <div class="tab-pane fade
                                            <?php if($i == 1){ ?>in active<?php } ?>"
                                                 id="hcode-1501298931-2082702610-<?php echo $i; ?>">
                                                <div class="text-left spa-treatments position-relative cover-background
js-background" data-image="<?php echo $thumb_url_full[0]; ?>"
                                                     style="background-image:url( );">
                                                    <div class="col-md-6 col-sm-6 bg-white pull-right no-padding">
                                                        <div class="pull-right right-content"><span
                                                                class="text-extra-large font-weight-600 letter-spacing-2 
                                                                text-uppercase black-text margin-three no-margin-top 
                                                                display-block"><?php echo $post->post_title; ?></span>
                                                            <p class="sample-text">
                                                                <?php
                                                                echo kama_excerpt( array('text'=>$post->post_content, 'maxchar'=>200) );
                                                                ?>
                                                            </p>
                                                            <ul class="margin-ten">

                                                                <?php foreach($arPostTagsNamesWidget as $tagName){ ?>
                                                                    <li>
                                                                        <span class="text width-auto"><?php echo $tagName; ?></span>&#8211; <?php
                                                                        echo $arProjectsTypesCountsProjects[$tagName] ?> <?php
                                                                        echo numberof($arProjectsTypesCountsProjects[$tagName], '',
                                                                            array('Проект', 'Проекта', 'Проектов'));
                                                                        ?>
                                                                    </li>
                                                                <?php } ?>

                                                            </ul>
                                                            <a class="btn inner-link btn-black btn-small no-margin"
                                                               href="/detail/<?php echo basename(__FILE__); ?>?ID=<?php echo $post->ID; ?>"
                                                               target="_self">Детали</a></div>
                                                    </div>
                                                </div>
                                            </div>
                                                <?php
                                                if ($i == 5) {
                                                    break;
                                                }
                                                $i++;
                                            }
                                            ?>



                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
                <?php
                include $_SERVER['DOCUMENT_ROOT'] . '/includes/detail_key_person_projects__section__no-title.php';
                ?>
                <section id="packages" class="  parallax-fix parallax1 js-background"
                         style=" background-image: url(); "
                data-image="<?php displayRandomElement($currentBackgroundImage); ?>">
                    <div class="selection-overlay" style=" opacity:0.8; background-color:#252525;"></div>
                    <div class="container">
                        <div class="row">
                            <div
                                class="wpb_column hcode-column-container  col-md-12 col-xs-mobile-fullwidth text-center">
                                <div class="vc-column-innner-wrapper"><h3 class="section-title
                                white-text no-padding">
                                        Проекты</h3></div>
                            </div>
                            <div
                                class="wpb_column hcode-column-container  col-md-12 col-xs-mobile-fullwidth no-padding margin-seven-top">
                                <div class="vc-column-innner-wrapper">
                                    <div class="spa-our-packages-owl position-relative">
                                        <div class="container">
                                            <div class="row">
                                                <div id="spa-package-owl-slider"
                                                     class="owl-pagination-bottom owl-carousel spa-our-packages owl-theme cursor-black dot-pagination dark-navigation dark-pagination dark-navigation">



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

                                                        $arPostTagsWidget = wp_get_post_tags($post->ID);
                                                        unset($arPostTagsNamesWidget);
                                                        foreach ($arPostTagsWidget as $keyTag => $tag) {
                                                            //$postTagId = $tag->term_id;
                                                            $arPostTagsNamesWidget[] = $tag->name;

                                                        }
                                                        $thumb_id = get_post_thumbnail_id($post->ID);
                                                        $thumb_url_full = wp_get_attachment_image_src($thumb_id, 'full',
                                                            false);

                                                        $thumb_url_full[0] = str_replace(get_site_url(),
                                                            PORTFOLIO_WP_URL,
                                                            $thumb_url_full[0]);

                                                        $filename = $thumb_url_full[0];
                                                        $new_filen = $_SERVER["DOCUMENT_ROOT"].'/wp-content/uploads/' . basename($filename);


                                                        $fileNew = "/wp-content/uploads/" . basename($filename);

                                                        $fileNew = cropImage($filename,
                                                            $_SERVER['DOCUMENT_ROOT'] . $fileNew,
                                                            750, 650);

                                                        ?>

                                                        <div class="item">
                                                            <div class="col-md-12 sm-margin-bottom-ten "><img
                                                                        src="" class="js-img" data-image="<?php echo $fileNew; ?>"
                                                                        alt="" width="750" height="650">
                                                                <div class="content-box bg-white"><p
                                                                            class="black-text margin-ten no-margin text-med text-uppercase letter-spacing-2 font-weight-600 no-margin"
                                                                            style="color:#000000 !important;"><?php echo $post->post_title; ?></p>
                                                                    <p class="text-med text-uppercase letter-spacing-1 no-margin">
                                                                        <?php echo implode(" ", $arPostTagsNamesWidget); ?></p>
                                                                    <div
                                                                            class="thin-separator-line bg-black no-margin-lr"></div>
                                                                    <p></p>
                                                                    <p><?php
                                                                        echo kama_excerpt( array('text'=>$post->post_content, 'maxchar'=>200) );
                                                                        ?></p>
                                                                    <p></p><a
                                                                            class="btn inner-link btn-black btn-small no-margin"
                                                                            href="/detail/<?php echo basename(__FILE__); ?>?ID=<?php echo $post->ID; ?>"
                                                                            target="_self">
                                                                        Детали
                                                                    </a>
                                                                </div>
                                                            </div>
                                                        </div>

                                                        <?php
                                                    }
                                                    ?>



                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <script type="text/javascript">jQuery(document).ready(function () {
                                            jQuery("#spa-package-owl-slider").owlCarousel({
                                                pagination: false,
                                                autoPlay: false,
                                                stopOnHover: false,
                                                items: 3,
                                                itemsDesktop: [1200, 3],
                                                itemsTablet: [991, 3],
                                                itemsMobile: [700, 1],
                                            });
                                        });</script>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
                <section id="gallery" class="  no-padding-bottom">
                    <div class="container-fluid">
                        <div class="row">
                            <div
                                class="wpb_column hcode-column-container  col-md-12 col-xs-mobile-fullwidth text-center">
                                <div class="vc-column-innner-wrapper"><h3 class="section-title
                                black-text no-padding">
                                        Галерея</h3></div>
                            </div>
                            <div
                                class="wpb_column hcode-column-container  col-lg-3 col-md-8 col-xs-mobile-fullwidth col-sm-11 text-center center-col margin-three">
                                <div class="vc-column-innner-wrapper"><h4 class="gray-text">
                                        <?php echo randomText()[0]; ?>
                                    </h4></div>
                            </div>
                            <div
                                class="wpb_column hcode-column-container  lightbox-gallery-hover col-xs-mobile-fullwidth">
                                <div class="vc-column-innner-wrapper">
                                    <div class="work-4col">
                                        <div class="col-md-12 grid-gallery overflow-hidden  no-padding margin-top-20px">
                                            <ul class="grid masonry-items lightbox-gallery">


                                                <?php foreach($arProjectImages as $projectImage){
                                                    $filename = $projectImage;
                                                    $new_filen = $_SERVER["DOCUMENT_ROOT"].'/wp-content/uploads/' . basename($filename);


                                                    $fileNew = "/wp-content/uploads/" . basename($filename);

                                                    $fileNew = cropImage($filename,
                                                        $_SERVER['DOCUMENT_ROOT'] . $fileNew,
                                                        800, 1000);
                                                    ?>
                                                <li class=" wow fadeIn">
                                                    <a
                                                        href="<?php echo $projectImage; ?>"
                                                        class="lightboxgalleryitem" data-group="default">
                                                        <img
                                                            src="<?php echo $fileNew; ?>" class="js-img"
                                                            data-image="<?php echo $fileNew; ?>"
                                                            alt="" width="800" height="1000">
                                                    </a>
                                                </li>
                                                <?php } ?>





                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
                <section class="  no-padding-bottom" style="border-bottom: 1px solid #e5e5e5;">
                    <div class="container">
                        <div class="row">
                            <div
                                class="wpb_column hcode-column-container  col-md-5 col-xs-mobile-fullwidth col-sm-7 text-center center-col margin-five-bottom">
                                <div class="vc-column-innner-wrapper"><p class="title-med
                                black-text font-weight-100">
                                        <?php echo randomText()[0]; ?>
                                    </p><a
                                        href="/feedback/simple/" target="_self"
                                        class="inner-link highlight-button-black-border btn-large
                                        margin-six btn-extra-large button btn">
                                        Обратная связь
                                    </a></div>
                            </div>
                            <div
                                class="wpb_column hcode-column-container  col-md-12 col-xs-mobile-fullwidth text-center">
                                <div class="vc-column-innner-wrapper"><img
                                        src="" class="js-img"
                                        data-image="<?php displayRandomElement($arProjectMockups); ?>"
                                        width="1000" alt=""></div>
                            </div>
                        </div>
                    </div>
                </section>

                <?php
                include $_SERVER['DOCUMENT_ROOT'] . '/includes/detail_section_projects.php';
                ?>
                <section class="  no-padding">
                    <div class="container-fluid">
                        <div class="row">
                            <div class="wpb_column hcode-column-container  col-xs-mobile-fullwidth">
                                <div class="vc-column-innner-wrapper">
                                    <div id="hcode-bootstrap-content-slider2"
                                         class="carousel slide spa-case-study carousel- round-pagination light-pagination light-navigation ">
                                        <ol class="carousel-indicators">


                                            <?php
                                            $i = 1;
                                            foreach ($posts as $keyPost => $post) {

                                                $private = get_post_meta($post->ID, 'PRIVATE');

                                                //?mode=private
                                                if ((!isset($_SESSION["mode"]) || ($_SESSION["mode"] != "private")) &&
                                                    ($private[0] == "1")
                                                ) {
                                                    continue;
                                                }

                                                setup_postdata($post);

                                                $arPostTagsWidget = wp_get_post_tags($post->ID);
                                                unset($arPostTagsNamesWidget);
                                                foreach ($arPostTagsWidget as $keyTag => $tag) {
                                                    //$postTagId = $tag->term_id;
                                                    $arPostTagsNamesWidget[] = $tag->name;

                                                }
                                                $thumb_id = get_post_thumbnail_id($post->ID);
                                                $thumb_url_full = wp_get_attachment_image_src($thumb_id, 'full',
                                                    false);

                                                $thumb_url_full[0] = str_replace(get_site_url(),
                                                    PORTFOLIO_WP_URL,
                                                    $thumb_url_full[0]);

                                                $filename = $thumb_url_full[0];
                                                $new_filen = $_SERVER["DOCUMENT_ROOT"] . '/wp-content/uploads/' . basename($filename);


                                                $fileNew = "/wp-content/uploads/" . basename($filename);

                                                $fileNew = cropImage($filename,
                                                    $_SERVER['DOCUMENT_ROOT'] . $fileNew,
                                                    750, 650);

                                                ?>
                                                <li data-target="#hcode-bootstrap-content-slider2"
                                                    data-slide-to="<?php echo $keyPost; ?>"></li>

                                                <?php
                                            }
                                            ?>


                                        </ol>
                                        <div class="carousel-inner">


                                            <?php
                                            $i = 1;
                                            foreach ($posts as $keyPost => $post) {

                                            $private = get_post_meta($post->ID, 'PRIVATE');

                                            //?mode=private
                                            if ((!isset($_SESSION["mode"]) || ($_SESSION["mode"] != "private")) &&
                                                ($private[0] == "1")
                                            ) {
                                                continue;
                                            }

                                            setup_postdata($post);

                                            $arPostTagsWidget = wp_get_post_tags($post->ID);
                                            unset($arPostTagsNamesWidget);
                                            foreach ($arPostTagsWidget as $keyTag => $tag) {
                                                //$postTagId = $tag->term_id;
                                                $arPostTagsNamesWidget[] = $tag->name;

                                            }
                                            $thumb_id = get_post_thumbnail_id($post->ID);
                                            $thumb_url_full = wp_get_attachment_image_src($thumb_id, 'full',
                                                false);

                                            $thumb_url_full[0] = str_replace(get_site_url(),
                                                PORTFOLIO_WP_URL,
                                                $thumb_url_full[0]);

                                            $filename = $thumb_url_full[0];
                                            $new_filen = $_SERVER["DOCUMENT_ROOT"] . '/wp-content/uploads/' . basename($filename);


                                            $fileNew = "/wp-content/uploads/" . basename($filename);

                                            $fileNew = cropImage($filename,
                                                $_SERVER['DOCUMENT_ROOT'] . $fileNew,
                                                750, 650);




                                            unset($arCurrentProjectMockups);
                                            unset($arCurrentProjectImages);
                                                $gal = get_post_gallery($post->ID, false);
                                                $arIDs = explode(',', $gal['ids']);

                                                foreach ($arIDs as $keyImageID => $itemImageID) {

                                                    $arMetaImage = wp_get_attachment_metadata($itemImageID);

                                                    $thumb_img = get_post($itemImageID);

                                                    if ($thumb_img->post_excerpt == "PERSONAL_MOCKUP_2") {
                                                        $thumb_url_full[0] = PORTFOLIO_WP_UPLOAD_DIR_URL . "" . $arMetaImage["file"];
                                                    }

                                                    if ($thumb_img->post_excerpt == "PERSONAL_MOCKUP") {

                                                        $arCurrentProjectMockups[] = PORTFOLIO_WP_UPLOAD_DIR_URL . "" . $arMetaImage["file"];

                                                    }

                                                    if($thumb_img->post_excerpt == "" && empty($arCurrentProjectImages)){

                                                        $arCurrentProjectImages[] = PORTFOLIO_WP_UPLOAD_DIR_URL."".$arMetaImage["file"];

                                                    }




                                                    }

                                                $thumb_id = get_post_thumbnail_id($post->ID);
                                                $thumb_url = wp_get_attachment_image_src($thumb_id, 'full',
                                                    false);

                                                $thumb_url[0] = str_replace(get_site_url(),
                                                    PORTFOLIO_WP_URL,
                                                    $thumb_url[0]);
                                                $thimbnailProjectImage = $thumb_url[0];

                                                if (!$arCurrentProjectMockups) {
                                                    $arCurrentProjectMockups[] = $thumb_url[0];
                                                }



                                                ?>
                                            <div class="item">
                                                <div
                                                        data-image="<?php echo $thumb_url_full[0]; ?>"
                                                    style="background-image:url();"
                                                    class="fill js-background"></div>
                                                <div class="container case-study-slider">
                                                    <div class="row position-relative">
                                                        <div
                                                            class="col-md-5 col-sm-6 col-xs-12 text-left no-margin-right animated fadeInUp f-right xs-padding-lr-30px">
                                                            <span class="case-study-title white-text"><?php echo $post->post_title; ?></span><span
                                                                class="case-study-work alt-font white-text">
                                                                <?php echo implode(" ", $arPostTagsNamesWidget); ?>
                                                            </span>
                                                            <div class="separator-line bg-yellow no-margin-lr"></div>
                                                            <p><span class="case-study-detials white-text">
                                                                <?php
                                                                echo kama_excerpt( array('text'=>$post->post_content, 'maxchar'=>200) );
                                                                ?>
                                                                </span>
                                                            </p> <a
                                                                class="btn inner-link btn-small-white-background margin-four no-margin-bottom"
                                                                href="/detail/<?php echo basename(__FILE__); ?>?ID=<?php echo $post->ID; ?>"
                                                                target="_self">Детали</a></div>

                                                        <img alt="" class="js-img"
                                                             src=""
                                                             data-image="<?php displayRandomElement($arCurrentProjectMockups); ?>"
                                                             width="225"></div>
                                                </div>
                                            </div>
                                                <?php
                                            }
                                            ?>



                                        </div>
                                        <a class="left carousel-control" href="#hcode-bootstrap-content-slider2"
                                           data-slide="prev"><img
                                                src="http://wpdemos.themezaa.com/h-code/wp-content/themes/h-code/assets/images/arrow-pre-white-bg.png"
                                                alt="" width="96" height="96"/></a><a class="right carousel-control"
                                                                                      href="#hcode-bootstrap-content-slider2"
                                                                                      data-slide="next"><img
                                                src="http://wpdemos.themezaa.com/h-code/wp-content/themes/h-code/assets/images/arrow-next-white-bg.png"
                                                alt="" width="96" height="96"/></a></div>
                                    <script type="text/javascript">jQuery(document).ready(function () {
                                            jQuery("#hcode-bootstrap-content-slider2").carousel({
                                                interval: false,
                                                pause: false,
                                            });
                                        });</script>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
                <?php
                include $_SERVER['DOCUMENT_ROOT'] . '/includes/detail_contact-us.php';
                ?>

                <?php
                include $_SERVER['DOCUMENT_ROOT'] . '/includes/detail_parallax-fix_parallax3__background.php';
                ?>

            </div>
        </div>
    </div>
</section>
<?php
include $_SERVER['DOCUMENT_ROOT'] . '/includes/detail_footer_onepage.php';
?>
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
