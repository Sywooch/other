<?php
/**
 * Created by PhpStorm.
 * User: GSU
 * Date: 29.07.2017
 * Time: 15:37
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
<body class="page-template-default page page-id-49 wpb-js-composer js-comp-ver-5.1 vc_responsive">
<nav class="navbar navbar-default navbar-fixed-top nav-transparent overlay-nav sticky-nav nav-dark  nav-white "
     data-menu-hover-delay="100">
    <div class="container">
        <div class="row">
            <?php
            include $_SERVER['DOCUMENT_ROOT'] . '/includes/head_logo_white-3.php';
            ?>
            <div class="navbar-header col-sm-8 sm-width-auto col-xs-2 pull-right">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse"><span
                        class="sr-only">Toggle navigation</span> <span class="icon-bar"></span> <span
                        class="icon-bar"></span> <span class="icon-bar"></span></button>
            </div>
            <div class="col-md-8 no-padding-right accordion-menu text-right pull-right menu-position-right">
                <div id="mega-menu" class="navbar-collapse collapse navbar-right">
                    <ul id="menu-onepage-travelagency" class="mega-menu-ul nav navbar-nav navbar-right panel-group">
                        <?php
                        include $_SERVER['DOCUMENT_ROOT'] . '/includes/main_menu.php';
                        ?>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</nav>
<section class="parent-section no-padding post-49 page type-page status-publish hentry">
    <div class="container-fluid">
        <div class="row">
            <div class="entry-content">
                <section id="slider" class="  no-padding">
                    <div class="container-fluid">
                        <div class="row">
                            <div class="wpb_column hcode-column-container  col-xs-mobile-fullwidth">
                                <div class="vc-column-innner-wrapper">
                                    <div class="travel-agency-slider">
                                        <div id="onepage-home-travel-agency"
                                             class="owl-carousel owl-theme  round-pagination light-pagination light-navigation white-cursor onepage-home-travel-agency hcode-owl-slider12 ">




                                            <?php
                                            $i = 1;
                                            foreach($arProjectAllImages as $image) {
                                                ?>

                                                <div class="item owl-bg-img js-background"
                                                     style="background-image:url()"
                                                data-image="<?php echo $image; ?>">
                                                    <div class="slider-overlay bg-black"></div>
                                                    <div class="container full-screen position-relative">
                                                        <div class="col-md-12 slider-typography">
                                                            <div class="slider-text-middle-main pull-left text-left">
                                                                <div class="slider-text-middle"><h1
                                                                            class="white-text margin-five">
                                                                    <?php if($i == 1)  echo $arProject["post_title"];
                                                                    else displayRandomElement($arPostTagsNames); ?>
                                                                    </h1><span
                                                                            class="text-large white-text text-uppercase starting-from">
                                                                        <?php echo get_post_meta($arProject["ID"], 'YEAR')[0]; ?>

                                                                        <?php if($ProjectURL){ ?>
                                                                        <a
                                                                                class="black-text font-weight-600 bg-yellow inner-link"
                                                                                href="<?php echo $ProjectURL; ?>" target="_self"><span
                                                                                    class="black-text font-weight-600"><?php echo $ProjectURL; ?></span></a>
                                                                        <?php } ?>
                                                                    </span>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>

                                                <?php


                                                $i++;
                                            }
                                            ?>







                                        </div>
                                    </div>
                                    <script type="text/javascript">/*<![CDATA[*/
                                        jQuery(document).ready(function () {
                                            jQuery("#onepage-home-travel-agency").owlCarousel({
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
                <section>
                    <div class="container">
                        <div class="row">
                            <div
                                class="wpb_column hcode-column-container  col-md-12 col-xs-mobile-fullwidth text-center no-padding margin-five-bottom xs-margin-ten-bottom">
                                <div class="vc-column-innner-wrapper">
                                    <h1 class="section-title  black-text no-padding">
                                        Другие проекты</h1>
                                    <h6 class="section-title  margin-one no-padding">
                                        <?php echo randomText()[0]; ?>
                                    </h6>
                                </div>
                            </div>



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

                            $fileNew = cropImage($filename,
                                $_SERVER['DOCUMENT_ROOT'] . $fileNew,
                                750, 1000);

                            $arPostTags = wp_get_post_tags($post->ID);

                            unset($arCurrentPostTagsNames);
                            foreach ($arPostTags as $tag){
                                $arCurrentPostTagsNames[] = $tag->name;
                            }

                                $currentProjectYear = get_post_meta($post->ID, 'YEAR')[0];
                            ?>

                            <div
                                class="wpb_column hcode-column-container  col-md-3
                                col-xs-mobile-fullwidth col-sm-6 text-center sm-margin-ten-bottom">
                                <div class="vc-column-innner-wrapper">
                                    <div class="popular-destinations position-relative ">
                                        <img alt=""
                                             src="" data-image="<?php echo $fileNew; ?>"
                                             class="js-img"
                                             width="750" height="1000">
                                        <div class="popular-destinations-text"><span
                                                class="destinations-name text-med text-uppercase font-weight-600 letter-spacing-3 display-block"
                                                style="color:#000000 !important"><?php echo $post->post_title;?></span><span
                                                class="destinations-place text-uppercase font-weight-400 letter-spacing-3 display-block"
                                                style="color:#000000 !important"<?php displayRandomElement($arCurrentPostTagsNames); ?></span><a
                                                class="highlight-button btn btn-small no-margin-right no-margin-bottom"
                                                href="/detail/<?php echo basename(__FILE__); ?>?ID=<?php echo $post->ID; ?>"
                                                target="_self">Детали</a></div>
                                        <div class="popular-destinations-highlight bg-white">
                                            <div class="popular-destinations-highlight-sub"><i
                                                    class="icon-tablet medium-icon"></i><span
                                                    class="display-block text-med font-weight-600 black-text
                                                    text-uppercase letter-spacing-2"><?php echo $arAllYears[$currentProjectYear]; ?> <?php
                                                    echo numberof($arAllYears[$currentProjectYear],
                                                        '', array('проект', 'проекта', 'проектов'));
                                                    ?></span><span
                                                    class="text-uppercase font-weight-400 letter-spacing-2 black-text">
                                                    <?php echo $currentProjectYear; ?></span>
                                            </div>
                                            <?php $randomTagName = getRandomElement($arCurrentPostTagsNames); ?>
                                            <div class="popular-destinations-highlight-sub"><i
                                                    class="icon-laptop medium-icon"></i><span
                                                    class="display-block text-med font-weight-600 black-text
                                                    text-uppercase letter-spacing-2">
                                                    <?php echo $arAllTags[$randomTagName]; ?> <?php
                                            echo numberof($arAllTags[$randomTagName],
                                                '', array('проект', 'проекта', 'проектов'));
                                                                                            ?>
                                                </span><span
                                                    class="text-uppercase font-weight-400 letter-spacing-2 black-text">
                                                    <?php echo $randomTagName; ?></span>
                                            </div>
                                            <div class="popular-destinations-highlight-sub">
                                                <p class="no-margin-bottom">
                                                    <?php
                                                    $post_content = preg_replace("/\\[.+\\]/m","",
                                                        $post->post_content);
                                                    //$post_content = str_replace("\n","<br>",
                                                    //    $post_content);

                                                    echo kama_excerpt( array('text'=>$post_content,
                                                        'maxchar'=>500,
                                                        'autop' => false) );

                                                    ?>
                                                </p><a
                                                    class="highlight-button-dark btn btn-small
                                                    no-margin-right no-margin-bottom inner-link"
                                                    href="/detail/<?php echo basename(__FILE__); ?>?ID=<?php echo $post->ID; ?>"
                                                    target="_self">Детали</a></div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                                <?php

                                if($i == 4) break;
                                $i++;
                            }
                            ?>



                            <?php

                            wp_reset_postdata(); // сброс
                            ?>

                        </div>
                    </div>
                </section>
                <section id="about" style="border-top: 1px solid #e5e5e5;">
                    <div class="container">
                        <div class="row">
                            <div
                                class="wpb_column hcode-column-container  col-md-12 col-xs-mobile-fullwidth text-center no-padding margin-ten-bottom xs-margin-ten-bottom">
                                <div class="vc-column-innner-wrapper"><h1 class="section-title
                                black-text no-padding">
                                        Другие проекты</h1><h6 class="section-title  margin-one
                                        no-padding"><?php echo randomText()[0]; ?></h6></div>
                            </div>


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
                            <div
                                class="wpb_column hcode-column-container  col-md-3
                                 col-xs-12 col-sm-6 text-center sm-margin-ten-bottom">
                                <div class="vc-column-innner-wrapper">
                                    <div class="features-box-style1"><i class="icon-laptop medium-icon"
                                                                        style="color:#7f7f7f;"></i>
                                        <h5
                                            class=" margin-ten-bottom xs-margin-five-bottom">
                                            <?php echo $post->post_title; ?>
                                        </h5>
                                        <div class="no-margin"><p>
                                                <?php
                                                $post_content = preg_replace("/\\[.+\\]/m","",
                                                    $post->post_content);
                                                //$post_content = str_replace("\n","<br>",
                                                //    $post_content);

                                                echo kama_excerpt( array('text'=>$post_content,
                                                    'maxchar'=>500,
                                                    'autop' => false) );

                                                ?>
                                            </p></div>
                                    </div>
                                </div>
                            </div>

                                <?php
                                if($i == 4) break;
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

                <section class="  parallax-fix parallax2 no-padding js-background"
                         data-image="<? displayRandomElement($currentBackgroundImage); ?>">
                    <div class="wpb_column hcode-column-container  pull-right col-md-6 col-xs-12
                    no-padding"
                         style=" background:rgba(0,0,0,0.8);">
                        <div class="vc-column-innner-wrapper">
                            <div class="panel-group accordion-style4 about-tab-right" id="1445319542">



                                <div class="panel panel-default">
                                    <div class="panel-heading active-accordion"><a data-toggle="collapse"
                                                                                   data-parent="#1445319542"
                                                                                   href="#accordian-panel-1"><h4
                                                class="panel-title"><i
                                                    class="icon-desktop extra-small-icon vertical-align-middle"></i>
                                                <?php displayRandomElement($arPostTagsNames); ?><span class="pull-right"><i class="fa fa-minus"></i></span>
                                            </h4></a></div>
                                    <div id="accordian-panel-1" class="panel-collapse collapse in">
                                        <div class="panel-body">
                                            <div class="col-md-2 col-sm-2 col-xs-6 no-padding xs-margin-bottom-five">

                                                <?php
                                                $filename = getRandomElement($arProjectImages);
                                                $new_filen = $_SERVER["DOCUMENT_ROOT"].'/wp-content/uploads/' . basename($filename);


                                                $fileNew = "/wp-content/uploads/" . basename($filename);

                                                $fileNew = cropImage($filename,
                                                    $_SERVER['DOCUMENT_ROOT'] . $fileNew,
                                                    500, 500);

                                                ?>
                                                <img
                                                        src="" data-image="<?php echo $fileNew; ?>"
                                                        alt="" class="js-img white-round-border no-border spa-packages-img"
                                                    width="500" height="500"/></div>
                                            <div
                                                class="col-md-9 col-sm-9 col-xs-12 sm-pull-right col-md-offset-1 no-padding">
                                                <p class="text-med light-gray-text">
                                                    <?php if($arContentBlock[0]) echo implode("\n", $arContentBlock[0]); ?>
                                                </p></div>
                                        </div>
                                    </div>
                                </div>


                                <div class="panel panel-default">
                                    <div class="panel-heading "><a data-toggle="collapse" data-parent="#1445319542"
                                                                   href="#accordian-panel-2"><h4 class="panel-title"><i
                                                    class="icon-desktop extra-small-icon vertical-align-middle"></i>
                                                <?php displayRandomElement($arPostTagsNames); ?><span class="pull-right"><i class="fa fa-plus"></i></span>
                                            </h4></a></div>
                                    <div id="accordian-panel-2" class="panel-collapse collapse ">
                                        <div class="panel-body">
                                            <div class="col-md-2 col-sm-2 col-xs-6 no-padding xs-margin-bottom-five">
                                                <?php
                                                $filename = getRandomElement($arProjectImages);
                                                $new_filen = $_SERVER["DOCUMENT_ROOT"].'/wp-content/uploads/' . basename($filename);


                                                $fileNew = "/wp-content/uploads/" . basename($filename);

                                                $fileNew = cropImage($filename,
                                                    $_SERVER['DOCUMENT_ROOT'] . $fileNew,
                                                    500, 500);

                                                ?>
                                                <img
                                                        src="" data-image="<?php echo $fileNew; ?>"
                                                        alt="" class="js-img white-round-border no-border spa-packages-img"
                                                    width="500" height="500"/></div>
                                            <div
                                                class="col-md-9 col-sm-9 col-xs-12 sm-pull-right col-md-offset-1 no-padding">
                                                <p class="text-med light-gray-text">
                                                    <?php if($arContentBlock[1]) echo implode("\n", $arContentBlock[1]); ?>
                                                </p></div>
                                        </div>
                                    </div>
                                </div>


                                <div class="panel panel-default">
                                    <div class="panel-heading "><a data-toggle="collapse" data-parent="#1445319542"
                                                                   href="#accordian-panel-3"><h4 class="panel-title"><i
                                                    class="icon-desktop extra-small-icon vertical-align-middle"></i>
                                                <?php displayRandomElement($arPostTagsNames); ?><span class="pull-right"><i
                                                        class="fa fa-plus"></i></span></h4></a></div>
                                    <div id="accordian-panel-3" class="panel-collapse collapse ">
                                        <div class="panel-body">
                                            <div class="col-md-2 col-sm-2 col-xs-6 no-padding xs-margin-bottom-five">
                                                <?php
                                                $filename = getRandomElement($arProjectImages);
                                                $new_filen = $_SERVER["DOCUMENT_ROOT"].'/wp-content/uploads/' . basename($filename);


                                                $fileNew = "/wp-content/uploads/" . basename($filename);

                                                $fileNew = cropImage($filename,
                                                    $_SERVER['DOCUMENT_ROOT'] . $fileNew,
                                                    500, 500);

                                                ?>
                                                <img
                                                        src="" data-image="<?php echo $fileNew; ?>"
                                                        alt="" class="js-img white-round-border no-border spa-packages-img"
                                                    width="500" height="500"/></div>
                                            <div
                                                class="col-md-9 col-sm-9 col-xs-12 sm-pull-right col-md-offset-1 no-padding">
                                                <p class="text-med light-gray-text">
                                                    <?php if($arContentBlock[2]) echo implode("\n", $arContentBlock[2]); ?>
                                                </p></div>
                                        </div>
                                    </div>
                                </div>



                                <div class="panel panel-default">
                                    <div class="panel-heading "><a data-toggle="collapse" data-parent="#1445319542"
                                                                   href="#accordian-panel-4"><h4 class="panel-title"><i
                                                    class="icon-desktop extra-small-icon vertical-align-middle"></i>
                                                <?php displayRandomElement($arPostTagsNames); ?><span class="pull-right"><i class="fa fa-plus"></i></span>
                                            </h4></a></div>
                                    <div id="accordian-panel-4" class="panel-collapse collapse ">
                                        <div class="panel-body">
                                            <div class="col-md-2 col-sm-2 col-xs-6 no-padding xs-margin-bottom-five">
                                                <?php
                                                $filename = getRandomElement($arProjectImages);
                                                $new_filen = $_SERVER["DOCUMENT_ROOT"].'/wp-content/uploads/' . basename($filename);


                                                $fileNew = "/wp-content/uploads/" . basename($filename);

                                                $fileNew = cropImage($filename,
                                                    $_SERVER['DOCUMENT_ROOT'] . $fileNew,
                                                    500, 500);

                                                ?>
                                                <img
                                                    src="" data-image="<?php echo $fileNew; ?>"
                                                    alt="" class="js-img white-round-border no-border spa-packages-img"
                                                    width="500" height="500"/></div>
                                            <div
                                                class="col-md-9 col-sm-9 col-xs-12 sm-pull-right col-md-offset-1 no-padding">
                                                <p class="text-med light-gray-text">
                                                    <?php if($arContentBlock[3]) echo implode("\n", $arContentBlock[3]); ?>
                                                </p></div>
                                        </div>
                                    </div>
                                </div>




                            </div>
                        </div>
                    </div>
                </section>
                <section id="packages" class="  no-padding-bottom" style="border-top: 1px solid #e5e5e5;">
                    <div class="container-fluid">
                        <div class="row">
                            <div
                                class="wpb_column hcode-column-container  col-md-12 col-xs-mobile-fullwidth text-center no-padding margin-five-bottom xs-margin-ten-bottom">
                                <div class="vc-column-innner-wrapper"><h1 class="section-title
                                black-text no-padding">
                                        Другие проекты</h1><h6 class="section-title  margin-one
                                         no-padding"><?php echo randomText()[0]; ?></h6></div>
                            </div>
                            <div class="wpb_column hcode-column-container  col-xs-mobile-fullwidth text-center">
                                <div class="vc-column-innner-wrapper">
                                    <div class="col-md-12 text-center">
                                        <div class="text-center">
                                            <ul class="portfolio-filter nav nav-tabs nav-tabs-gray
 height-auto__bottom-20"
                                            style="height:auto; margin-bottom:20px;">
                                                <?php
                                                include $_SERVER['DOCUMENT_ROOT'] . '/includes/portfolio_filter.php';
                                                ?>
                                            </ul>
                                        </div>
                                    </div>
                                    <div class="work-4col gutter work-with-title wide wide-title ">
                                        <div
                                            class="col-md-12  no-padding grid-gallery overflow-hidden no-padding content-section">
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

                                                        $arPostTags = wp_get_post_tags($post->ID);
                                                        unset($arCurrentPostTagsNames);
                                                        foreach ($arPostTags as $tag){
                                                            $arCurrentPostTagsNames[] = $tag->name;
                                                        }

                                                        $filename = $thumb_url[0];
                                                        $new_filen = $_SERVER["DOCUMENT_ROOT"].'/wp-content/uploads/' . basename($filename);


                                                        $fileNew = "/wp-content/uploads/" . basename($filename);

                                                        $fileNew = cropImage($filename,
                                                            $_SERVER['DOCUMENT_ROOT'] . $fileNew,
                                                            800, 500);
                                                        ?>


                                                        <li class="<?php
                                                        foreach ($arPostTags as $keyTag => $tag) {
                                                            echo " portfolio-filter-".$tag->term_id;

                                                        }
                                                        ?>">
                                                            <figure>
                                                                <div class="gallery-img"><a
                                                                            href="<?php echo $thumb_url[0]; ?>"
                                                                            class="" target=""><img alt=""
                                                                                                    src=""
                                                                                                    class="js-img"
                                                                                                    data-image="<?php echo $fileNew; ?>"
                                                                                                    width="800"
                                                                                                    height="500"/></a></div>
                                                                <figcaption><h3><a
                                                                                href="http://wpdemos.themezaa.com/h-code/portfolio/single-project-page-1/"
                                                                                class="" target="">
                                                                            <?php echo $post->post_title; ?>
                                                                        </a></h3>
                                                                    <p><?php echo implode(" / ", $arCurrentPostTagsNames); ?></p><a
                                                                            class=" btn inner-link btn-black btn-small"
                                                                            href="/detail/<?php echo basename(__FILE__); ?>?ID=<?php echo $post->ID; ?>"
                                                                            target="">Детали</a></figcaption>
                                                            </figure>
                                                        </li>
                                                        <?php
                                                        if($i == 8) break;
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
                <section class="  parallax-fix parallax1 no-padding js-background"
                         data-image="<? displayRandomElement($currentBackgroundImage); ?>">
                    <div
                        class="wpb_column hcode-column-container  pull-right col-md-6 col-xs-mobile-fullwidth no-padding"
                        style=" background:#cd314f;">
                        <div class="vc-column-innner-wrapper">
                            <div class="agency-enjoy-right">
                                <div class="center-img sm-display-none"><img alt=""
                                                                             src=""
                                                                             class="js-img"
                                                                             data-image="<?php displayRandomElement($arProjectMockups); ?>"
                                                                             width="225" ></div>
                                <div class="title-top sm-no-margin-left yellow-text alt-font"><?php displayRandomElement($arPostTagsNames); ?><span
                                        class="white-text"><?php displayRandomElement($arPostTagsNames); ?> <br/>
                                        <?php displayRandomElement($arPostTagsNames); ?></span></div>
                                <div class="separator-line bg-yellow no-margin-lr sm-margin-bottom-five"></div>
                                <h3 class="title-small white-text no-padding-bottom margin-five-bottom font-weight-400 letter-spacing-3 xs-margin-bottom-ten">
                                    <?php displayRandomElement($arPostTagsNames); ?>
                                </h3>
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

                                        $fileNew = cropImage($filename,
                                            $_SERVER['DOCUMENT_ROOT'] . $fileNew,
                                            800, 800);
                                        ?>



                                        <div class="col-md-4 col-sm-4 text-center
                                        xs-margin-ten-bottom"><a href="/detail/<?php echo basename(__FILE__); ?>?ID=<?php echo $post->ID; ?>"><img
                                                        alt=""
                                                        src=""
                                                        class="js-img"
                                                        data-image="<?php echo $fileNew; ?>"
                                                        width="800" height="800"></a>
                                            <div class="white-box bg-white"><span
                                                        class="destinations-name text-uppercase font-weight-600 letter-spacing-1 black-text display-block"><a
                                                            href="/detail/<?php echo basename(__FILE__); ?>?ID=<?php echo $post->ID; ?>">
                                                        <?php echo $post->post_title; ?>
                                                    </a></span><span
                                                        class="destinations-place text-uppercase font-weight-400 letter-spacing-1
                                                        display-block">
                                                    <?php displayRandomElement($arCurrentPostTagsNames); ?>
                                                </span>
                                            </div>
                                        </div>

                                        <?php
                                        if($i == 3) break;
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
                </section>

                <section>
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
                                                                       class="counter-number black-text">
                                            <?php echo $countPosts;?>
                                        </span><span
                                                class="counter-title" style="color: #626262">
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
                                                                       class="counter-number black-text">
                                            <?php echo $countSertificates;?>
                                        </span><span
                                                class="counter-title" style="color: #626262">
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
                                                                       class="counter-number black-text">
                                            <?php echo $countFilesInRepo; ?>
                                        </span><span
                                                class="counter-title" style="color: #626262">Файлов с кодом в репозитории</span></div>
                                </div>
                            </div>
                            <div
                                    class="wpb_column hcode-column-container  col-md-3 col-xs-mobile-fullwidth col-sm-6 text-center wow fadeInUp"
                                    data-wow-duration=1200ms>
                                <div class="vc-column-innner-wrapper">
                                    <div class="counter-section"><span id="counter_4" data-to="<?php echo $humanYearsRemote; ?>"
                                                                       class="counter-number black-text"><?php echo $humanYearsRemote; ?></span><span
                                                class="counter-title" style="color: #626262"><?php
                                            echo numberof($humanYearsRemote, '', array('год', 'года', 'лет'));
                                            ?> опыта удалённой работы </span></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>


                <section id="special-offers" class="  parallax-fix parallax9 js-background"
                         data-image="<? displayRandomElement($currentBackgroundImage); ?>"
                         style=" background-image: url(); ">
                    <div class="selection-overlay" style=" opacity:0.7; background-color:#000000;"></div>
                    <div class="container-fluid">
                        <div class="row">
                            <div
                                class="wpb_column hcode-column-container  col-md-12 col-xs-mobile-fullwidth text-center margin-five-bottom sm-margin-ten-bottom">
                                <div class="vc-column-innner-wrapper"><h1 class="section-title
                                white-text no-padding">
                                        Другие проекты</h1>
                                    <h6 class="section-title  margin-one no-padding"
                                                               style=" color:#ababab; ">
                                        <?php echo randomText()[0]; ?></h6></div>
                            </div>
                            <div
                                class="wpb_column hcode-column-container  col-md-12 col-xs-mobile-fullwidth text-center no-padding">
                                <div class="vc-column-innner-wrapper">
                                    <div class="travel-special-offers-slider position-relative">
                                        <div class="container">
                                            <div class="row">



                                                <div id="travel-agency-special-offers-slider"
                                                     class="owl-pagination-bottom owl-carousel owl-theme cursor-black dot-pagination light-navigation dark-pagination light-navigation">


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

                                                        $fileNew = cropImage($filename,
                                                            $_SERVER['DOCUMENT_ROOT'] . $fileNew,
                                                            800, 800);
                                                        ?>


                                                        <div class="item col-md-12 col-sm-12">
                                                            <a href="/detail/<?php echo basename(__FILE__); ?>?ID=<?php echo $post->ID; ?>"><img
                                                                        src=""
                                                                        class="js-img"
                                                                        data-image="<?php echo $fileNew; ?>"
                                                                        alt="" width="800" height="800"></a>
                                                            <div class="popular-destinations-text bg-white"><span
                                                                        class="destinations-name text-uppercase font-weight-600
                                                                        letter-spacing-2 black-text display-block"><?php echo $post->post_title; ?></span><span
                                                                        class="destinations-place text-uppercase font-weight-400
                                                                        letter-spacing-2 display-block margin-two no-margin-bottom">
                                                                    <?php echo implode(" / ", $arCurrentPostTagsNames); ?>
                                                                </span><a
                                                                        class="highlight-button btn btn-small no-margin-right"
                                                                        href="/detail/<?php echo basename(__FILE__); ?>?ID=<?php echo $post->ID; ?>"
                                                                        target="_self">Детали</a></div>
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
                                        <div class="feature_nav"><a class="prev left carousel-control"><img alt=""
                                                                                                            src="http://wpdemos.themezaa.com/h-code/wp-content/themes/h-code/assets/images/arrow-pre.png"
                                                                                                            width="96"
                                                                                                            height="96"></a><a
                                                class="next right carousel-control"><img alt=""
                                                                                         src="http://wpdemos.themezaa.com/h-code/wp-content/themes/h-code/assets/images/arrow-next.png"
                                                                                         width="96" height="96"></a>
                                        </div>
                                    </div>
                                    <script type="text/javascript">jQuery(document).ready(function () {
                                            jQuery("#travel-agency-special-offers-slider").owlCarousel({
                                                pagination: false,
                                                autoPlay: false,
                                                stopOnHover: false,
                                                items: 4,
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
                <section id="blog" style="border-top: 1px solid #e5e5e5;">
                    <div class="container">
                        <div class="row">
                            <div
                                class="wpb_column hcode-column-container  col-md-12 col-xs-mobile-fullwidth text-center no-padding margin-five-bottom xs-margin-ten-bottom">
                                <div class="vc-column-innner-wrapper"><h1 class="section-title
                                black-text no-padding">
                                        Проекты</h1>
                                    <h6 class="section-title  margin-one no-padding">
                                        <?php echo randomText()[0]; ?></h6></div>
                            </div>


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


                                $width = 767;
                                $height = 481;
                                $fileNew = "/wp-content/uploads/" . basename($filename);
                                $fileNew = cropImage($filename,
                                    $_SERVER['DOCUMENT_ROOT'] . $fileNew,
                                    $width, $height);




                                $width = 300;
                                $height = 188;
                                $fileNew300w = "/wp-content/uploads/" . basename($filename);
                                $fileNew300w = cropImage($filename,
                                    $_SERVER['DOCUMENT_ROOT'] . $fileNew300w,
                                    $width, $height);

                                $width = 133;
                                $height = 83;
                                $fileNew133w = "/wp-content/uploads/" . basename($filename);
                                $fileNew133w = cropImage($filename,
                                    $_SERVER['DOCUMENT_ROOT'] . $fileNew768w,
                                    $width, $height);



                                $width = 374;
                                $height = 234;
                                $fileNew374w = "/wp-content/uploads/" . basename($filename);
                                $fileNew374w = cropImage($filename,
                                    $_SERVER['DOCUMENT_ROOT'] . $fileNew374w,
                                    $width, $height);


                                ?>

                            <div
                                class="wpb_column hcode-column-container  col-md-4 col-xs-mobile-fullwidth col-sm-4 wow fadeInUp">
                                <div class="vc-column-innner-wrapper">
                                    <div
                                        class="post-6491 post type-post status-publish format-standard has-post-thumbnail hentry category-sample">
                                        <div class="blog-post">
                                            <div class="blog-image"><a
                                                    href="/detail/<?php echo basename(__FILE__); ?>?ID=<?php echo $post->ID; ?>"><img
                                                        width="767" height="481"
                                                        src="<?php echo $fileNew; ?>"
                                                        class="attachment-full size-full wp-post-image" alt="" title=""
                                                        srcset="<?php echo $fileNew; ?> 767w,
                                                        <?php echo $fileNew300w; ?>-300x188.jpg 300w,
                                                        <?php echo $fileNew133w; ?>-133x83.jpg 133w,
                                                        <?php echo $fileNew374w; ?>-374x234.jpg 374w"
                                                        sizes="(max-width: 767px) 100vw, 767px"/></a></div>
                                            <div class="post-details"><a
                                                    href="/detail/<?php echo basename(__FILE__); ?>?ID=<?php echo $post->ID; ?>"
                                                    class="post-title sm-margin-top-ten xs-no-margin-top entry-title">
                                                    <?php echo $post->post_title;?>
                                                </a><span
                                                    class="post-author light-gray-text2 author vcard">
                                                    <?php echo implode(" / ", $arCurrentPostTagsNames); ?></span>
                                                <p class="entry-content"><?php
                                                    echo kama_excerpt( array('text'=>$post->post_content, 'maxchar'=>200) );?></p></div>
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


                            <div
                                class="wpb_column hcode-column-container  col-md-12 col-xs-12 col-sm-12 text-center wow fadeInUp">
                                <div class="vc-column-innner-wrapper"><a
                                        href="/projects/" target="_self"
                                        class="inner-link highlight-button-dark btn-small  margin-four-top button btn">
                                        Все проекты
                                    </a></div>
                            </div>
                        </div>
                    </div>
                </section>

                <?php
                include $_SERVER['DOCUMENT_ROOT'] . '/includes/detail_projects__background-color_f6f6f6__testimonial-style2__name_light-gray-text2__margin-two__3.php';
                ?>

                <?php
                include $_SERVER['DOCUMENT_ROOT'] . '/includes/detail_contact-us.php';
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
