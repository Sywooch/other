<?php
/**
 * Created by PhpStorm.
 * User: GSU
 * Date: 29.07.2017
 * Time: 15:32
 */


require $_SERVER['DOCUMENT_ROOT'] . '/wp-load.php';
include $_SERVER['DOCUMENT_ROOT'] . '/includes/head.php';

global $wpdb;
$wpdb->set_prefix('portfolio_');


include $_SERVER['DOCUMENT_ROOT'] . '/includes/feedback_send.php';

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
<body class="page-template-default page page-id-47 wpb-js-composer js-comp-ver-5.1 vc_responsive">
<nav
    class="navbar navbar-default navbar-fixed-top nav-transparent overlay-nav sticky-nav transparent-header nav-border-bottom  nav-black "
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
                    <ul id="menu-onepage-agency" class="mega-menu-ul nav navbar-nav navbar-right panel-group">
                        <?php
                        include $_SERVER['DOCUMENT_ROOT'] . '/includes/main_menu.php';
                        ?>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</nav>
<section class="parent-section no-padding post-47 page type-page status-publish hentry">
    <div class="container-fluid">
        <div class="row">
            <div class="entry-content">

                <?php
                $arContent = preg_split('/[\n.]/u', $arProject["post_content"], -1, PREG_SPLIT_NO_EMPTY);
                $arContentBlock = array_chunk($arContent, round(count($arContent)/4));
                ?>


                <section id="home" class="  parallax-fix parallax4 full-screen no-padding
                 js-background"
                         data-image="<?php displayRandomElement($arProjectAllImages); ?>"
                         style=" background-image: url(); ">
                    <div class="container">
                        <div class="row">
                            <div
                                class="wpb_column hcode-column-container  col-xs-mobile-fullwidth col-sm-12 full-screen">
                                <div class="vc-column-innner-wrapper">
                                    <div class="slider-typography text-left ">
                                        <div class="slider-text-middle-main">
                                            <div
                                                class="col-md-6 col-sm-8 col-xs-10 contant-box position-absolute no-padding position-right-15px xs-position-right"
                                                style="background:#c24742;">
                                                <div
                                                    class="position-relative overflow-hidden padding-ten no-padding-bottom">
                                                    <h5 class="text-big alt-font position-absolute"
                                                        style="color:#ffffff !important"><?php echo $arProject["post_title"];?></h5>
                                                    <div
                                                        class="separator-line bg-white margin-bottom-eleven no-margin-top no-margin-lr xs-margin-bottom-ten"></div>
                                                    <h4 class="white-text slider-subtitle6
                                                    margin-bottom-eleven alt-font">
                                                        <?php if($arContentBlock[0]) echo implode("\n", $arContentBlock[0]); ?>
                                                    </h4><h5
                                                        class="text-big-title alt-font word-wrap-normal"
                                                        style="color:#ffffff !important"><?php echo $arProject["post_title"];?></h5></div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
                <section class="  parallax-fix parallax3 full-screen no-padding
                 js-background"
                         data-image="<?php displayRandomElement($arProjectAllImages); ?>"
                         style=" background-image: url(); ">
                    <div class="container">
                        <div class="row">
                            <div class="wpb_column hcode-column-container  col-xs-mobile-fullwidth full-screen">
                                <div class="vc-column-innner-wrapper">
                                    <div class="slider-typography text-left ">
                                        <div class="slider-text-middle-main">
                                            <div
                                                class="col-md-6 col-sm-8 col-xs-10 contant-box position-absolute no-padding position-left-15px xs-position-left"
                                                style="background:#997546;">
                                                <div
                                                    class="position-relative overflow-hidden padding-ten no-padding-bottom">
                                                    <h5 class="text-big alt-font position-absolute"
                                                        style="color:#ffffff !important"><?php displayRandomElement($arPostTagsNames); ?></h5>
                                                    <div
                                                        class="separator-line bg-white margin-bottom-eleven no-margin-top no-margin-lr xs-margin-bottom-ten"></div>
                                                    <h4 class="white-text slider-subtitle6 margin-bottom-eleven alt-font">
                                                        <?php if($arContentBlock[1]) echo implode("\n", $arContentBlock[1]); ?>
                                                    </h4><h5
                                                        class="text-big-title alt-font word-wrap-normal"
                                                        style="color:#ffffff !important"><?php displayRandomElement($arPostTagsNames); ?></h5></div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
                <section class="  parallax-fix parallax1 full-screen no-padding
                 js-background"
                         data-image="<?php displayRandomElement($arProjectAllImages); ?>"
                         style=" background-image: url(); ">
                    <div class="container">
                        <div class="row">
                            <div
                                class="wpb_column hcode-column-container  col-xs-mobile-fullwidth col-sm-12 full-screen">
                                <div class="vc-column-innner-wrapper">
                                    <div class="slider-typography text-left ">
                                        <div class="slider-text-middle-main">
                                            <div
                                                class="col-md-6 col-sm-8 col-xs-10 contant-box position-absolute no-padding position-right-15px xs-position-right"
                                                style="background:#544441;">
                                                <div
                                                    class="position-relative overflow-hidden padding-ten no-padding-bottom">
                                                    <h5 class="text-big alt-font position-absolute"
                                                        style="color:#ffffff !important"><?php displayRandomElement($arPostTagsNames); ?></h5>
                                                    <div
                                                        class="separator-line bg-white margin-bottom-eleven no-margin-top no-margin-lr xs-margin-bottom-ten"></div>
                                                    <h4 class="white-text slider-subtitle6 margin-bottom-eleven alt-font">
                                                        <?php if($arContentBlock[2]) echo implode("\n", $arContentBlock[2]); ?>
                                                    </h4><h5
                                                        class="text-big-title alt-font word-wrap-normal"
                                                        style="color:#ffffff !important"><?php displayRandomElement($arPostTagsNames); ?></h5></div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>

                <?php
                include $_SERVER['DOCUMENT_ROOT'] . '/includes/detail_projects_hcode-bootstrap-content-slider.php';
                ?>

                <section id="portfolio" class="  no-padding-bottom">
                    <div class="container-fluid">
                        <div class="row">
                            <div
                                class="wpb_column hcode-column-container  col-md-12 col-xs-mobile-fullwidth text-center">
                                <div class="vc-column-innner-wrapper"><h3 class="section-title  no-padding"
                                                                          style=" color:#464646; ">Проекты</h3></div>
                            </div>
                            <div
                                class="wpb_column hcode-column-container  col-lg-3 col-md-5 col-xs-mobile-fullwidth col-sm-7 text-center center-col margin-three">
                                <div class="vc-column-innner-wrapper"><h4 class="gray-text"><?php echo $currentDetailTitle[0]; ?></h4></div>
                            </div>
                            <div class="wpb_column hcode-column-container  col-xs-mobile-fullwidth">
                                <div class="vc-column-innner-wrapper">
                                    <div class="col-md-12 text-center">
                                        <div class="text-center">
                                            <ul class="portfolio-filter nav nav-tabs nav-tabs-black" style="height:auto; padding-bottom:20px;">
                                                <?php
                                                include $_SERVER['DOCUMENT_ROOT'] . '/includes/portfolio_filter.php';
                                                ?>
                                            </ul>
                                        </div>
                                    </div>
                                    <div class="work-4col  ">
                                        <div
                                            class="col-md-12  no-padding grid-gallery overflow-hidden  content-section">
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

                                                    cropImage($filename,
                                                        $_SERVER['DOCUMENT_ROOT'] . $fileNew,
                                                        800, 500);

                                                    $arPostTags = wp_get_post_tags($post->ID);

                                                    unset($arCurrentPostTagsNames);
                                                    foreach ($arPostTags as $tag){
                                                        $arCurrentPostTagsNames[] = $tag->name;
                                                    }
                                                    ?>

                                                        <?
                                                        if($i == 2) {



                                                            $gal = get_post_gallery($post->ID, false);
                                                            $arIDs = explode(',', $gal['ids']);

                                                            foreach ($arIDs as $keyImageID => $itemImageID) {

                                                                $arMetaImage = wp_get_attachment_metadata($itemImageID);

                                                                $thumb_img = get_post($itemImageID);

                                                                if($thumb_img->post_excerpt == ""){

                                                                    $arCurrentProjectImages[] = PORTFOLIO_WP_UPLOAD_DIR_URL."".$arMetaImage["file"];

                                                                }


                                                            }

                                                            $filename = $arCurrentProjectImages[0];


                                                            $fileNew = "/wp-content/uploads/" . basename($filename);
                                                            $fileNew = cropImage($filename,
                                                                $_SERVER['DOCUMENT_ROOT'] . $fileNew,
                                                                480, 716);


                                                            ?>

                                                            <li class="<?php
                                                            foreach ($arPostTags as $keyTag => $tag) {
                                                                echo " portfolio-filter-".$tag->term_id;

                                                            }
                                                            ?>">
                                                                <figure>
                                                                    <div class="gallery-img lightbox-gallery"><a
                                                                                href="<?php echo $arCurrentProjectImages[0]; ?>"
                                                                                class="lightboxgalleryitem"
                                                                                data-group="portfolio-8325"><img
                                                                                    src="<?php echo $fileNew; ?>"
                                                                                    alt="" width="480" height="716"></a>
                                                                    
                                                                        <?php foreach($arCurrentProjectImages as $keyCurrentProjectImage => $currentProjectImage){ ?>
                                                                        <?php if($keyCurrentProjectImage == 1) continue; ?>
                                                                            <a
                                                                                href="<?php echo $currentProjectImage; ?>"
                                                                                class="lightboxgalleryitem"
                                                                                data-group="portfolio-8325"></a>
                                                                        <?php } ?>
                                                                       
                                                                    
                                                                    </div>
                                                                    <figcaption><h3><a class="parent-gallery-popup"
                                                                                       href="javascript:void(0);">
                                                                                <?php echo $post->post_title; ?>
                                                                            </a></h3>
                                                                        <p><?php echo implode(" ", $arCurrentPostTagsNames) ?></p></figcaption>
                                                                </figure>
                                                            </li>
                                                            <?
                                                        }else {


                                                            $filename = $thumb_url[0];


                                                            $fileNew = "/wp-content/uploads/" . basename($filename);
                                                            $fileNew = cropImage($filename,
                                                                $_SERVER['DOCUMENT_ROOT'] . $fileNew,
                                                                480, 358);


                                                            ?>


                                                            <li class="<?php
                                                            foreach ($arPostTags as $keyTag => $tag) {
                                                                echo " portfolio-filter-".$tag->term_id;

                                                            }
                                                            ?>">
                                                                <figure>
                                                                    <div class="gallery-img"><a
                                                                                href="/detail/<?php echo basename(__FILE__); ?>?ID=<?php echo $post->ID; ?>"
                                                                                ><img
                                                                                    alt=""
                                                                                    src="<?php echo $fileNew; ?>"
                                                                                    width="480"
                                                                                    height="358"/></a>
                                                                    </div>
                                                                    <figcaption><h3><a
                                                                                    href="/detail/<?php echo basename(__FILE__); ?>?ID=<?php echo $post->ID; ?>"
                                                                                    ><?php echo $post->post_title; ?></a></h3>
                                                                        <p><?php echo implode(" ", $arCurrentPostTagsNames) ?></p></figcaption>
                                                                </figure>
                                                            </li>

                                                            <?php
                                                        }
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
                <section id="counter">
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

                            $diffDateRemote =  current_time('timestamp') - strtotime("01-12-2012");
                            $humanYearsRemote = floor($diffDateRemote / 31536000);

                            include $_SERVER['DOCUMENT_ROOT'] . '/includes/GitHub.php';

                            ?>






                            <div
                                class="wpb_column hcode-column-container  col-md-3 col-xs-mobile-fullwidth col-sm-6 text-center sm-margin-ten-bottom wow fadeInUp">
                                <div class="vc-column-innner-wrapper">
                                    <div class="counter-section"><i class="icon-heart"></i><span id="counter_1"
                                                                                                 data-to="<?php echo $countPosts;?>"
                                                                                                 class="counter-number
                                                                                                 black-text"><?php echo $countPosts;?></span><span
                                            class="counter-title"><?php
                                            echo numberof($countPosts, '',
                                                array('Проект', 'Проекта', 'Проектов'));
                                            ?></span></div>
                                </div>
                            </div>
                            <div
                                class="wpb_column hcode-column-container  col-md-3 col-xs-mobile-fullwidth col-sm-6 text-center sm-margin-ten-bottom wow fadeInUp">
                                <div class="vc-column-innner-wrapper">
                                    <div class="counter-section"><i class="icon-happy"></i><span id="counter_2"
                                                                                                 data-to="<?php echo $countSertificates;?>"
                                                                                                 class="counter-number black-text"><?php echo $countSertificates;?></span><span
                                            class="counter-title"><?php
                                            echo numberof($countPosts, '',
                                                array('Сертификат', 'Сертификата', 'Сертификатов'));
                                            ?></span></div>
                                </div>
                            </div>
                            <div
                                class="wpb_column hcode-column-container  col-md-3 col-xs-mobile-fullwidth col-sm-6 text-center xs-margin-ten-bottom wow fadeInUp">
                                <div class="vc-column-innner-wrapper">
                                    <div class="counter-section"><i class="icon-anchor"></i><span id="counter_3"
                                                                                                  data-to="<?php echo $countFilesInRepo; ?>"
                                                                                                  class="counter-number black-text"><?php echo $countFilesInRepo; ?></span><span
                                            class="counter-title">Файлов с кодом в репозитории</span></div>
                                </div>
                            </div>
                            <div
                                class="wpb_column hcode-column-container  col-md-3 col-xs-mobile-fullwidth col-sm-6 text-center wow fadeInUp">
                                <div class="vc-column-innner-wrapper">
                                    <div class="counter-section"><i class="icon-chat"></i><span id="counter_4"
                                                                                                data-to="<?php echo $humanYearsRemote; ?>"
                                                                                                class="counter-number black-text"><?php echo $humanYearsRemote; ?></span><span
                                            class="counter-title"><?php
                                            echo numberof($humanYearsRemote, '', array('год', 'года', 'лет'));
                                            ?> опыта удалённой работы</span></div>
                                </div>
                            </div>



                        </div>
                    </div>
                </section>
                <section id="service" class="  parallax-fix parallax9"
                         style=" background-image: url(http://wpdemos.themezaa.com/h-code/wp-content/uploads/2015/08/parallax-img38.jpg); ">
                    <div class="container">
                        <div class="row">
                            <div
                                class="wpb_column hcode-column-container  col-md-12 col-xs-mobile-fullwidth text-center">
                                <div class="vc-column-innner-wrapper"><h3 class="section-title "
                                                                          style=" color:#464646; ">
                                        Категории проектов
                                    </h3>
                                </div>
                            </div>



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

                            $i = 0;
                            foreach ($posts as $post) {
                            setup_postdata($post);


                            ?>

                            <div
                                class="wpb_column hcode-column-container  col-md-4 col-xs-12 col-sm-6 margin-bottom-80px sm-margin-ten-bottom wow fadeInUp">
                                <div class="vc-column-innner-wrapper">
                                    <div class="col-md-12 no-padding">
                                        <div class="col-md-3 col-sm-2 col-xs-2 no-padding"><i
                                                class="icon-<?php echo $post->post_content;?> medium-icon"></i></div>
                                        <div class="col-md-9 col-sm-9 col-xs-9 no-padding text-left f-right"><h5
                                                class="" style="color:#464646;"><?php echo $post->post_title;?></h5>
                                            <div class="separator-line bg-yellow no-margin-lr"></div>
                                            <p class="text"></p></div>
                                    </div>
                                </div>
                            </div>


                                <?php
                                $i++;
                            }

                            wp_reset_postdata();
                            ?>


                        </div>
                    </div>
                </section>






                <section id="team">
                    <div class="container-fluid">
                        <div class="row">
                            <div
                                class="wpb_column hcode-column-container  col-md-12 col-xs-mobile-fullwidth text-center">
                                <div class="vc-column-innner-wrapper"><h3 class="section-title  no-padding"
                                                                          style=" color:#464646; ">
                                        Другие проекты
                                    </h3></div>
                            </div>
                            <div
                                class="wpb_column hcode-column-container  col-lg-3 col-md-5 col-xs-mobile-fullwidth col-sm-7 text-center center-col margin-five">
                                <div class="vc-column-innner-wrapper"><h4 class="gray-text">
                                        <?php displayRandomElement($currentDetailTitle); ?>
                                    </h4></div>
                            </div>
                            <div class="wpb_column hcode-column-container  col-xs-mobile-fullwidth margin-five-top">
                                <div class="vc-column-innner-wrapper">
                                    <div class="team-agency-owl position-relative">
                                        <div class="container">

                                            

                                            
                                            <div class="row">
                                                <div id="default"
                                                     class="owl-carousel owl-theme team-agency  black-cursor dot-pagination dark-navigation dark-pagination dark-navigation">

                                                    <?php
                                                    include $_SERVER['DOCUMENT_ROOT'] . '/includes/portfolio_grid_gallery.php';
                                                    ?>


                                                    <?php
                                                    $i = 0;
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


                                                        $filename = $thumb_url[0];
                                                        $new_filen = $_SERVER["DOCUMENT_ROOT"] . '/wp-content/uploads/' . basename($filename);

                                                  
                                                        $fileNew = "/wp-content/uploads/" . basename($filename);


                                                        $fileNew = cropImage($filename,
                                                            $_SERVER['DOCUMENT_ROOT'] . $fileNew,
                                                            900, 990);


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
                                                    ?>

                                                    <div class="text-center team-member wow fadeInUp"
                                                         data-wow-duration=300ms><img alt=""
                                                                                      src="<?php echo $fileNew; ?>"
                                                                                      width="900" height="990">
                                                        <figure class="position-relative bg-white"><span
                                                                class="team-name text-uppercase black-text letter-spacing-2
                                                                display-block font-weight-600"><?php echo $post->post_title; ?></span><span
                                                                class="team-post text-uppercase letter-spacing-2 display-block">
                                                                <?php echo implode(" / ", $arCurrentPostTagsNames); ?></span>
                                                            <div class="person-social margin-five no-margin-bottom"></div>
                                                        </figure>
                                                        <div class="team-details bg-blck-overlay"><h5
                                                                class="team-headline white-text text-uppercase font-weight-600">
                                                                <?php echo $post->post_title; ?></h5>
                                                            <p class="width-70 center-col light-gray-text margin-five">

                                                                <?php
                                                                $post_content = preg_replace("/\\[.+\\]/m","",
                                                                    $post->post_content);
                                                                //$post_content = str_replace("\n","<br>",
                                                                //    $post_content);

                                                                echo kama_excerpt( array('text'=>$post_content, 'maxchar'=>300,
                                                                    'autop' => false) );

                                                                ?>
                                                            </p>
                                                            <div class="separator-line-thick bg-white"></div>
                                                        </div>
                                                    </div>




                                                        <?php
                                                        $i++;

                                                    }
                                                    ?>



                                                    <?php

                                                    wp_reset_postdata(); // сброс
                                                    ?>

                                                </div>
                                            </div>
                                            
                                            
                                            


                                            
                                        </div>
                                    </div>
                                    <script type="text/javascript">jQuery(document).ready(function () {
                                            jQuery("#default").owlCarousel({
                                                pagination: false,
                                                autoPlay: false,
                                                stopOnHover: false,
                                                items: 3,
                                                itemsDesktop: [1200, 3],
                                                itemsTablet: [991, 2],
                                                itemsMobile: [700, 1],
                                            });
                                        });</script>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>





                <section class="  no-padding">
                    <div class="container-fluid">
                        <div class="row">
                            <div
                                class="wpb_column hcode-column-container  col-md-4 col-xs-12 col-sm-12 sm-text-center no-padding wow fadeInUp"
                                style=" background:#997546;" data-wow-duration=300ms>
                                <div class="vc-column-innner-wrapper">
                                    <div class="no-padding-bottom reasons "><span class="slider-title-big2"
                                                                                  style="color:#ffffff !important">01,<span
                                                style="color:#ffffff !important">Идея</span></span>
                                        <p class="white-text"></p> <img alt=""
                                                                               src="http://wpdemos.themezaa.com/h-code/wp-content/uploads/2015/08/reasons-img01.jpg"
                                                                               width="308" height="264"></div>
                                </div>
                            </div>
                            <div
                                class="wpb_column hcode-column-container  col-md-4 col-xs-12 col-sm-12 sm-text-center no-padding wow fadeInUp"
                                style=" background:#c24742;" data-wow-duration=600ms>
                                <div class="vc-column-innner-wrapper">
                                    <div class="no-padding-bottom reasons "><span class="slider-title-big2"
                                                                                  style="color:#ffffff !important">02,<span
                                                style="color:#ffffff !important">Стратегия</span></span>
                                        <p class="white-text"></p> <img alt=""
                                                                               src="http://wpdemos.themezaa.com/h-code/wp-content/uploads/2015/08/reasons-img02.jpg"
                                                                               width="308" height="264"></div>
                                </div>
                            </div>
                            <div
                                class="wpb_column hcode-column-container  col-md-4 col-xs-12 col-sm-12 sm-text-center no-padding wow fadeInUp"
                                style=" background:#544441;" data-wow-duration=900ms>
                                <div class="vc-column-innner-wrapper">
                                    <div class="no-padding-bottom reasons "><span class="slider-title-big2"
                                                                                  style="color:#ffffff !important">03,<span
                                                style="color:#ffffff !important">Реализация</span></span>
                                        <p class="white-text"></p> <img alt=""
                                                                               src="http://wpdemos.themezaa.com/h-code/wp-content/uploads/2015/08/reasons-img03.jpg"
                                                                               width="308" height="264"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>

                <?php
                include $_SERVER['DOCUMENT_ROOT'] . '/includes/detail_section_projects.php';
                ?>


                <?php
                include $_SERVER['DOCUMENT_ROOT'] . '/includes/detail_testimonial_projects-2.php';
                ?>


                <?php
                include $_SERVER['DOCUMENT_ROOT'] . '/includes/detail_contact-us.php';
                ?>


                <?php
                include $_SERVER['DOCUMENT_ROOT'] . '/includes/detail_chart-percent.php';
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


</body>
</html>