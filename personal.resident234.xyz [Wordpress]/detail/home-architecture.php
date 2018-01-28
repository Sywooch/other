<?php
/**
 * Created by PhpStorm.
 * User: GSU
 * Date: 29.07.2017
 * Time: 15:50
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
<body class="page-template-default page page-id-6 wpb-js-composer js-comp-ver-5.1 vc_responsive">
<?php
include $_SERVER['DOCUMENT_ROOT'] . '/includes/head_white_menu_logo.php';
?>
<section class="parent-section no-padding post-6 page type-page status-publish hentry">
    <div class="container-fluid">
        <div class="row">
            <div class="entry-content">
                <section class="  no-padding">
                    <div class="container-fluid">
                        <div class="row">
                            <div class="wpb_column hcode-column-container  col-xs-mobile-fullwidth">
                                <div class="vc-column-innner-wrapper">
                                    <div id="home-architecture"
                                         class="owl-carousel owl-theme home-architecture hcode-owl-slider2  round-pagination light-pagination dark-navigation white-cursor home-architecture hcode-owl-slider2 ">




                                        <div class="item owl-bg-img js-background"
                                             data-image="<?php displayRandomElement($currentBackgroundImage) ?>"
                                             style="background-image:url(">
                                            <div class="opacity-light bg-black"></div>
                                            <div class="container full-screen position-relative">
                                                <div class="slider-typography margin-five no-margin-bottom">
                                                    <div class="slider-text-middle-main">
                                                        <div class="slider-text-middle"><p><span
                                                                    class="text-uppercase white-text letter-spacing-3">
                                                                    <?php echo get_post_meta($arProject["ID"], 'YEAR')[0]; ?></span>
                                                            </p>
                                                            <h1 class="letter-spacing-2 white-text margin-three no-margin-bottom">
                                                                <?php echo $arProject["post_title"];?></h1>
                                                            <a class="btn-small-white btn btn-medium margin-four no-margin-bottom no-margin-right inner-link"
                                                               href="/projects/" target="_self">Портфолио</a></div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="item owl-bg-img js-background"
                                             data-image="<?php displayRandomElement($currentBackgroundImage) ?>"
                                             style="background-image:url()">
                                            <div class="opacity-light bg-black"></div>
                                            <div class="container full-screen position-relative">
                                                <div class="slider-typography margin-five no-margin-bottom">
                                                    <div class="slider-text-middle-main">
                                                        <div class="slider-text-middle"><p><span
                                                                    class="text-uppercase white-text letter-spacing-3">
                                                                    <?php echo get_post_meta($arProject["ID"], 'YEAR')[0]; ?>
                                                                </span>
                                                            </p>
                                                            <h1 class="letter-spacing-2 white-text margin-three no-margin-bottom">
                                                                <?php displayRandomElement($arPostTagsNames); ?>
                                                            </h1><a
                                                                class="btn-small-white btn btn-medium margin-four
                                                                no-margin-bottom no-margin-right inner-link"
                                                                href="/projects/" target="_self">Портфолио</a></div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="item owl-bg-img js-background"
                                             data-image="<?php displayRandomElement($currentBackgroundImage) ?>"
                                             style="background-image:url()">
                                            <div class="opacity-light bg-black"></div>
                                            <div class="container full-screen position-relative">
                                                <div class="slider-typography margin-five no-margin-bottom">
                                                    <div class="slider-text-middle-main">
                                                        <div class="slider-text-middle"><p><span
                                                                    class="text-uppercase white-text letter-spacing-3">
                                                                    <?php echo get_post_meta($arProject["ID"], 'YEAR')[0]; ?>
                                                                </span>
                                                            </p>
                                                            <h1 class="letter-spacing-2 white-text margin-three no-margin-bottom">
                                                                <?php displayRandomElement($arPostTagsNames); ?></h1><a
                                                                class="btn-small-white btn btn-medium margin-four
                                                                no-margin-bottom no-margin-right inner-link"
                                                                href="/projects/" target="_self">Портфолио</a></div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>






                                    </div>
                                    <script type="text/javascript">/*<![CDATA[*/
                                        jQuery(document).ready(function () {
                                            jQuery("#home-architecture").owlCarousel({
                                                navigation: false,
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
                                class="wpb_column hcode-column-container  col-md-5 col-xs-mobile-fullwidth col-sm-8 text-center center-col margin-ten-bottom">
                                <div class="vc-column-innner-wrapper">
                                    <div class="dividers-header double-line">
                                        <div class="subheader" style="background-color: #fff;"><h2
                                                class="section-title  no-padding">Прочие проекты</h2></div>
                                    </div>
                                </div>
                            </div>




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



                                <div
                                        class="wpb_column hcode-column-container  col-md-4
                                        col-xs-mobile-fullwidth col-sm-4 xs-margin-ten-bottom">
                                    <div class="vc-column-innner-wrapper">
                                        <img alt=""
                                             data-image="<?php echo $thumb_url[0]; ?>"
                                             src="<?php //echo $thumb_url_medium[0]; ?>"
                                             class="js-img"
                                             width="800" height="502">
                                        <p class="text-uppercase letter-spacing-2 black-text font-weight-600
                                        margin-ten no-margin-bottom">
                                            <?php echo $post->post_title; ?></p>
                                        <p class="margin-two text-med width-90">
                                            <?php
                                            $post_content = preg_replace("/\\[.+\\]/m","",
                                                $post->post_content);
                                            //$post_content = str_replace("\n","<br>",
                                            //    $post_content);

                                            echo kama_excerpt( array('text'=>$post_content, 'maxchar'=>300,
                                                'autop' => false) );

                                            ?>
                                        </p></div>
                                </div>





                                <?php
                                if($i == 2) break;
                                $i++;

                            }
                            ?>



                            <?php

                            wp_reset_postdata(); // сброс
                            ?>










                            <div
                                class="wpb_column hcode-column-container  col-md-12 col-xs-mobile-fullwidth xs-no-padding">
                                <div class="vc-column-innner-wrapper">
                                    <div class="hcode-divider margin-five-top padding-five-bottom"
                                         style="border-top: 1px solid #e5e5e5;"></div>
                                </div>
                            </div>


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
                                class="wpb_column hcode-column-container  col-md-3 col-xs-mobile-fullwidth col-sm-6 text-center sm-margin-ten-bottom wow fadeInUp"
                                data-wow-duration=300ms>
                                <div class="vc-column-innner-wrapper">
                                    <div class="counter-section"><span id="counter_1" data-to="<?php echo $countPosts;?>"
                                                                       class="counter-number black-text">
                                            <?php echo $countPosts;?></span><span
                                            class="counter-title"><?php
                                            echo numberof($countPosts, '',
                                                array('Проект', 'Проекта', 'Проектов'));
                                            ?></span></div>
                                </div>
                            </div>
                            <div
                                class="wpb_column hcode-column-container  col-md-3 col-xs-mobile-fullwidth col-sm-6 text-center sm-margin-ten-bottom wow fadeInUp"
                                data-wow-duration=600ms>
                                <div class="vc-column-innner-wrapper">
                                    <div class="counter-section"><span id="counter_2" data-to="<?php echo $countSertificates;?>"
                                                                       class="counter-number black-text"><?php echo $countSertificates;?></span><span
                                            class="counter-title"><?php
                                            echo numberof($countPosts, '',
                                                array('Сертификат', 'Сертификата', 'Сертификатов'));
                                            ?></span></div>
                                </div>
                            </div>
                            <div
                                class="wpb_column hcode-column-container  col-md-3 col-xs-mobile-fullwidth col-sm-6 text-center xs-margin-ten-bottom wow fadeInUp"
                                data-wow-duration=900ms>
                                <div class="vc-column-innner-wrapper">
                                    <div class="counter-section"><span id="counter_3" data-to="<?php echo $countFilesInRepo; ?>"
                                                                       class="counter-number black-text"><?php echo $countFilesInRepo; ?></span><span
                                            class="counter-title">Файлов с кодом в репозитории</span></div>
                                </div>
                            </div>
                            <div
                                class="wpb_column hcode-column-container  col-md-3 col-xs-mobile-fullwidth col-sm-6 text-center wow fadeInUp"
                                data-wow-duration=1200ms>
                                <div class="vc-column-innner-wrapper">
                                    <div class="counter-section"><span id="counter_4" data-to="<?php echo $humanYearsRemote; ?>"
                                                                       class="counter-number black-text"><?php echo $humanYearsRemote; ?></span><span
                                            class="counter-title"><?php
                                            echo numberof($humanYearsRemote, '', array('год', 'года', 'лет'));
                                            ?> опыта работы</span></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
                <section class="  fix-background js-background"
                         data-image="<?php displayRandomElement($currentBackgroundImage) ?>"
                         style="background-image:url()">
                    <div class="selection-overlay" style=" opacity:0.8; background-color:#ffffff;"></div>
                    <div class="container">
                        <div class="row">
                            <div
                                class="wpb_column hcode-column-container  col-md-4 col-xs-mobile-fullwidth col-sm-12
                                sm-text-center sm-margin-ten-bottom">
                                <div class="vc-column-innner-wrapper"><h3
                                        class="title-med no-padding-bottom letter-spacing-2">
                                        <?php
                                        $randomNumber = wp_rand(0, count($currentDetailTitle));
                                        echo $currentDetailTitle[$randomNumber]; ?>
                                    </h3>
                                    <p class="text-med margin-five">
                                        <?php echo $currentDetailDescription[$randomNumber]; ?>
                                    </p> <a
                                        class="highlight-button-dark btn btn-small button" href="/projects/best/"
                                        target="_self">
                                        Лучшие проекты
                                    </a></div>
                            </div>



                            <?php

                            $randomProjectTagName = $arPostTagsNames[wp_rand(0, count($arPostTagsNames) - 1)];
                            ?>

                            <div
                                class="wpb_column hcode-column-container  col-md-offset-2 col-md-2 col-xs-mobile-fullwidth col-sm-4 text-center margin-three xs-margin-ten-bottom">
                                <div class="vc-column-innner-wrapper"><i
                                        class="icon-desktop medium-icon display-block" style="color:#000000;"></i>
                                    <h1 class="font-weight-600 margin-five no-margin-bottom">
                                        <?php echo $arAllTags[$randomProjectTagName]; ?>
                                    </h1>
                                    <p class="text-uppercase letter-spacing-2 text-small margin-three"
                                       style="color:#000000;"><?php echo $randomProjectTagName; ?></p></div>
                            </div>


                            <?php

                            $randomProjectTagName = $arPostTagsNames[wp_rand(0, count($arPostTagsNames) - 1)];
                            ?>
                            <div
                                class="wpb_column hcode-column-container  col-md-2 col-xs-mobile-fullwidth col-sm-4 text-center margin-three xs-margin-ten-bottom">
                                <div class="vc-column-innner-wrapper"><i class="icon-desktop medium-icon display-block"
                                                                         style="color:#000000;"></i>
                                    <h1 class="font-weight-600 margin-five no-margin-bottom">
                                        <?php echo $arAllTags[$randomProjectTagName]; ?>
                                    </h1>
                                    <p class="text-uppercase letter-spacing-2 text-small margin-three"
                                       style="color:#000000;"><?php echo $randomProjectTagName; ?></p></div>
                            </div>

                            <?php

                            $randomProjectTagName = $arPostTagsNames[wp_rand(0, count($arPostTagsNames) - 1)];
                            ?>
                            <div
                                class="wpb_column hcode-column-container  col-md-2 col-xs-mobile-fullwidth col-sm-4 text-center margin-three">
                                <div class="vc-column-innner-wrapper"><i class="icon-desktop medium-icon display-block"
                                                                         style="color:#000000;"></i>
                                    <h1 class="font-weight-600 margin-five no-margin-bottom">
                                        <?php echo $arAllTags[$randomProjectTagName]; ?>
                                    </h1>
                                    <p class="text-uppercase letter-spacing-2 text-small margin-three"
                                       style="color:#000000;"><?php echo $randomProjectTagName; ?></p></div>
                            </div>
                        </div>
                    </div>
                </section>
                <section>
                    <div class="container">
                        <div class="row">
                            <div
                                class="wpb_column hcode-column-container  col-md-5 col-xs-mobile-fullwidth col-sm-8 text-center center-col margin-ten-bottom">
                                <div class="vc-column-innner-wrapper">
                                    <div class="dividers-header double-line">
                                        <div class="subheader" style="background-color: #fff;"><h3
                                                class="section-title  no-padding">Реализованные проекты</h3></div>
                                    </div>
                                </div>
                            </div>

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

                                cropImage($thumb_url_full[0],
                                    $_SERVER['DOCUMENT_ROOT'] . $fileNew,
                                    265, 290);

                                ?>

                                <div
                                        class="wpb_column hcode-column-container  col-md-3 col-xs-mobile-fullwidth col-sm-6 text-center sm-margin-ten-bottom">
                                    <div class="vc-column-innner-wrapper"><img alt=""
                                                                               src=""
                                                                               data-image="<?php echo $fileNew; ?>"
                                                                               width="265" height="290"
                                        class="js-img">
                                        <h5
                                                class="margin-ten no-margin-bottom xs-margin-top-five">
                                            <?php echo $post->post_title; ?></h5>
                                    </div>
                                </div>



                                <?php
                                if ($i == 3) {
                                    break;
                                }
                                $i++;
                            }
                            ?>









                        </div>
                    </div>
                </section>
                <section id="portfolio" class="  no-padding-bottom">
                    <div class="container-fluid">
                        <div class="row">
                            <div class="wpb_column hcode-column-container  col-xs-mobile-fullwidth text-center">
                                <div class="vc-column-innner-wrapper"><h3 class="section-title  black-text no-padding">
                                        Последние проекты</h3></div>
                            </div>
                            <div
                                    class="wpb_column hcode-column-container  col-lg-3 col-md-5 col-xs-mobile-fullwidth col-sm-10 text-center center-col margin-three">
                                <div class="vc-column-innner-wrapper">
                                    <h4 class="gray-text"><?php echo $currentDetailTitle[0]; ?></h4></div>
                            </div>
                            <div class="wpb_column hcode-column-container  col-xs-mobile-fullwidth">
                                <div class="vc-column-innner-wrapper">
                                    <div class="col-md-12 text-center">
                                        <div class="text-center">
                                            <ul class="portfolio-filter nav nav-tabs nav-tabs-black wow fadeInUp"
                                                style="height:auto; padding-bottom:20px;">
                                                <?php
                                                include $_SERVER['DOCUMENT_ROOT'] . '/includes/portfolio_filter.php';
                                                ?>
                                            </ul>
                                        </div>
                                    </div>
                                    <div class="work-4col masonry wide ">
                                        <div class="col-md-12  grid-gallery overflow-hidden no-padding content-section">
                                            <div class="tab-content">
                                                <ul class="grid masonry-items "
                                                >


                                                    <?php
                                                    include $_SERVER['DOCUMENT_ROOT'] . '/includes/portfolio_grid_gallery_new_first.php';
                                                    ?>


                                                    <?php


                                                    $thumb_id = get_post_thumbnail_id($arNewProjects[0]->ID);
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

                                                    $arPostTags = wp_get_post_tags($arNewProjects[0]->ID);



                                                    $filename = $thumb_url[0];
                                                    $new_filen = $_SERVER["DOCUMENT_ROOT"].'/wp-content/uploads/' . basename($filename);


                                                    $fileNew = "/wp-content/uploads/" . basename($filename);

                                                    cropImage($thumb_url[0],
                                                        $_SERVER['DOCUMENT_ROOT'] . $fileNew,
                                                        337, 253);

                                                    ?>


                                                    <li class="
                                                      <?php
                                                    foreach ($arPostTags as $keyTag => $tag) {
                                                        echo " portfolio-filter-".$tag->term_id;

                                                    }
                                                    ?>">
                                                        <figure>
                                                            <div class="gallery-img js-gallery-img">
                                                                <a
                                                                        href="/detail/<?php echo $arDetailTemplates[wp_rand(0, count($arDetailTemplates) - 1)]; ?>?ID=<?php echo $arNewProjects[0]->ID; ?>"
                                                                        class="" target="">
                                                                    <img alt=""
                                                                         data-image="<?php echo $fileNew; ?>"
                                                                         src="<?php echo $fileNew; ?>"
                                                                         width="800"
                                                                         height="600"/></a></div>
                                                            <figcaption><h3><a
                                                                            href="/detail/<?php echo $arDetailTemplates[wp_rand(0, count($arDetailTemplates) - 1)]; ?>?ID=<?php echo $arNewProjects[0]->ID; ?>"
                                                                            class="" target=""><?php echo $arNewProjects[0]->post_title; ?></a></h3>
                                                                <p><?php displayRandomElement($arPostTagsNames); ?></p></figcaption>
                                                        </figure>
                                                    </li>


                                                    <?php


                                                    $thumb_id = get_post_thumbnail_id($arNewProjects[4]->ID);
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

                                                    $arPostTags = wp_get_post_tags($arNewProjects[4]->ID);



                                                    $filename = $thumb_url[0];
                                                    $new_filen = $_SERVER["DOCUMENT_ROOT"].'/wp-content/uploads/' . basename($filename);


                                                    $fileNew = "/wp-content/uploads/" . basename($filename);

                                                    cropImage($thumb_url[0],
                                                        $_SERVER['DOCUMENT_ROOT'] . $fileNew,
                                                        337, 506);

                                                    ?>


                                                    <li class="<?php
                                                    foreach ($arPostTags as $keyTag => $tag) {
                                                        echo " portfolio-filter-".$tag->term_id;

                                                    }
                                                    ?>">
                                                        <figure>
                                                            <div class="gallery-img"><a
                                                                        href="/detail/<?php echo $arDetailTemplates[wp_rand(0, count($arDetailTemplates) - 1)]; ?>?ID=<?php echo $arNewProjects[4]->ID; ?>"
                                                                        class="" target=""><img alt=""
                                                                                                data-image="<?php echo $fileNew; ?>"
                                                                                                src="<?php echo $fileNew; ?>"
                                                                                                width="800" height="1200"/></a>
                                                            </div>
                                                            <figcaption><h3><a
                                                                            href="/detail/<?php echo $arDetailTemplates[wp_rand(0, count($arDetailTemplates) - 1)]; ?>?ID=<?php echo $arNewProjects[4]->ID; ?>"
                                                                            class="" target=""><?php echo $arNewProjects[4]->post_title; ?></a></h3>
                                                                <p><?php displayRandomElement($arPostTagsNames); ?></p></figcaption>
                                                        </figure>
                                                    </li>

                                                    <?php


                                                    $thumb_id = get_post_thumbnail_id($arNewProjects[5]->ID);
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

                                                    $arPostTags = wp_get_post_tags($arNewProjects[5]->ID);



                                                    $filename = $thumb_url[0];
                                                    $new_filen = $_SERVER["DOCUMENT_ROOT"].'/wp-content/uploads/' . basename($filename);


                                                    $fileNew = "/wp-content/uploads/" . basename($filename);

                                                    cropImage($thumb_url[0],
                                                        $_SERVER['DOCUMENT_ROOT'] . $fileNew,
                                                        337, 253);

                                                    ?>

                                                    <li class="<?php
                                                    foreach ($arPostTags as $keyTag => $tag) {
                                                        echo " portfolio-filter-".$tag->term_id;

                                                    }
                                                    ?>">
                                                        <figure>
                                                            <div class="gallery-img"><a
                                                                        href="/detail/<?php echo $arDetailTemplates[wp_rand(0, count($arDetailTemplates) - 1)]; ?>?ID=<?php echo $arNewProjects[5]->ID; ?>"
                                                                        class="" target=""><img alt=""
                                                                                                data-image="<?php echo $fileNew; ?>"
                                                                                                src="<?php echo $fileNew; ?>"
                                                                                                width="800"
                                                                                                height="600"/></a></div>
                                                            <figcaption><h3><a
                                                                            href="/detail/<?php echo $arDetailTemplates[wp_rand(0, count($arDetailTemplates) - 1)]; ?>?ID=<?php echo $arNewProjects[5]->ID; ?>"
                                                                            class="" target=""><?php echo $arNewProjects[5]->post_title; ?></a></h3>
                                                                <p><?php displayRandomElement($arPostTagsNames); ?></p></figcaption>
                                                        </figure>
                                                    </li>

                                                    <?php


                                                    $thumb_id = get_post_thumbnail_id($arNewProjects[1]->ID);
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

                                                    $arPostTags = wp_get_post_tags($arNewProjects[1]->ID);



                                                    $filename = $thumb_url[0];
                                                    $new_filen = $_SERVER["DOCUMENT_ROOT"].'/wp-content/uploads/' . basename($filename);


                                                    $fileNew = "/wp-content/uploads/" . basename($filename);

                                                    cropImage($thumb_url[0],
                                                        $_SERVER['DOCUMENT_ROOT'] . $fileNew,
                                                        337, 506);

                                                    ?>

                                                    <li class="<?php
                                                    foreach ($arPostTags as $keyTag => $tag) {
                                                        echo " portfolio-filter-".$tag->term_id;

                                                    }
                                                    ?>">
                                                        <figure>
                                                            <div class="gallery-img"><a
                                                                        href="/detail/<?php echo $arDetailTemplates[wp_rand(0, count($arDetailTemplates) - 1)]; ?>?ID=<?php echo $arNewProjects[1]->ID; ?>"
                                                                        class="" target=""><img alt=""
                                                                                                data-image="<?php echo $fileNew; ?>"
                                                                                                src="<?php echo $fileNew; ?>"
                                                                                                width="800" height="1200"/></a>
                                                            </div>
                                                            <figcaption><h3><a
                                                                            href="/detail/<?php echo $arDetailTemplates[wp_rand(0, count($arDetailTemplates) - 1)]; ?>?ID=<?php echo $arNewProjects[1]->ID; ?>"
                                                                            class="" target=""><?php echo $arNewProjects[1]->post_title; ?></a></h3>
                                                                <p><?php displayRandomElement($arPostTagsNames); ?></p></figcaption>
                                                        </figure>
                                                    </li>

                                                    <?php


                                                    $thumb_id = get_post_thumbnail_id($arNewProjects[2]->ID);
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

                                                    $arPostTags = wp_get_post_tags($arNewProjects[2]->ID);



                                                    $filename = $thumb_url[0];
                                                    $new_filen = $_SERVER["DOCUMENT_ROOT"].'/wp-content/uploads/' . basename($filename);


                                                    $fileNew = "/wp-content/uploads/" . basename($filename);

                                                    cropImage($thumb_url[0],
                                                        $_SERVER['DOCUMENT_ROOT'] . $fileNew,
                                                        337, 253);

                                                    ?>

                                                    <li class="<?php
                                                    foreach ($arPostTags as $keyTag => $tag) {
                                                        echo " portfolio-filter-".$tag->term_id;

                                                    }
                                                    ?>">
                                                        <figure>
                                                            <div class="gallery-img"><a
                                                                        href="/detail/<?php echo $arDetailTemplates[wp_rand(0, count($arDetailTemplates) - 1)]; ?>?ID=<?php echo $arNewProjects[2]->ID; ?>"
                                                                        class="" target=""><img alt=""
                                                                                                data-image="<?php echo $fileNew; ?>"
                                                                                                src="<?php echo $fileNew; ?>"
                                                                                                width="800"
                                                                                                height="600"/></a></div>
                                                            <figcaption><h3><a
                                                                            href="/detail/<?php echo $arDetailTemplates[wp_rand(0, count($arDetailTemplates) - 1)]; ?>?ID=<?php echo $arNewProjects[2]->ID; ?>"
                                                                            class="" target=""><?php echo $arNewProjects[2]->post_title; ?></a></h3>
                                                                <p><?php displayRandomElement($arPostTagsNames); ?></p></figcaption>
                                                        </figure>
                                                    </li>

                                                    <?php


                                                    $thumb_id = get_post_thumbnail_id($arNewProjects[3]->ID);
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

                                                    $arPostTags = wp_get_post_tags($arNewProjects[3]->ID);



                                                    $filename = $thumb_url[0];
                                                    $new_filen = $_SERVER["DOCUMENT_ROOT"].'/wp-content/uploads/' . basename($filename);


                                                    $fileNew = "/wp-content/uploads/" . basename($filename);

                                                    cropImage($thumb_url[0],
                                                        $_SERVER['DOCUMENT_ROOT'] . $fileNew,
                                                        337, 253);

                                                    ?>

                                                    <li class="<?php
                                                    foreach ($arPostTags as $keyTag => $tag) {
                                                        echo " portfolio-filter-".$tag->term_id;

                                                    }
                                                    ?>">
                                                        <figure>
                                                            <div class="gallery-img"><a
                                                                        href="/detail/<?php echo $arDetailTemplates[wp_rand(0, count($arDetailTemplates) - 1)]; ?>?ID=<?php echo $arNewProjects[3]->ID; ?>"
                                                                        class="" target=""><img alt=""
                                                                                                data-image="<?php echo $fileNew; ?>"
                                                                                                src="<?php echo $fileNew; ?>"
                                                                                                width="800"
                                                                                                height="600"/></a></div>
                                                            <figcaption><h3><a
                                                                            href="/detail/<?php echo $arDetailTemplates[wp_rand(0, count($arDetailTemplates) - 1)]; ?>?ID=<?php echo $arNewProjects[3]->ID; ?>"
                                                                            class="" target=""><?php echo $arNewProjects[3]->post_title; ?></a></h3>
                                                                <p><?php displayRandomElement($arPostTagsNames); ?></p></figcaption>
                                                        </figure>
                                                    </li>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>


                <section class=" team-section-padding xs-no-padding-bottom">
                    <div class="container">
                        <div class="row">
                            <div
                                class="wpb_column hcode-column-container  col-md-5 col-xs-mobile-fullwidth col-sm-8 text-center center-col margin-ten-bottom">
                                <div class="vc-column-innner-wrapper">
                                    <div class="dividers-header double-line">
                                        <div class="subheader" style="background-color: #fff;"><h3
                                                class="section-title  no-padding">Прочие проекты</h3></div>
                                    </div>
                                </div>
                            </div>



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

                                cropImage($thumb_url[0],
                                    $_SERVER['DOCUMENT_ROOT'] . $fileNew,
                                    500, 550);

                                ?>




                            <div
                                class="wpb_column hcode-column-container  col-md-6 col-xs-mobile-fullwidth col-sm-12 sm-margin-ten-bottom">
                                <div class="vc-column-innner-wrapper">
                                    <div class="col-lg-6 col-md-7 col-sm-6 no-padding">
                                        <div class="architecture-team team-member xs-no-padding"><span
                                                class="team-name text-uppercase black-text letter-spacing-2 display-block font-weight-600">
                                                <?php echo $post->post_title; ?>
                                            </span><span
                                                class="team-post text-uppercase letter-spacing-2 display-block">
                                                <?php echo implode(" / ", array_slice($arCurrentPostTagsNames,0,2)); ?>
                                            </span>
                                            <div class="separator-line bg-black no-margin-lr margin-ten"></div>
                                            <span class="margin-ten display-block clearfix xs-margin-0auto"></span>
                                            <p class="margin-ten xs-no-margin-top"></p>
                                            <p class="margin-ten xs-no-margin-top">
                                                <?php
                                                $post_content = preg_replace("/\\[.+\\]/m","",
                                                    $post->post_content);
                                                //$post_content = str_replace("\n","<br>",
                                                //    $post_content);

                                                echo kama_excerpt( array('text'=>$post_content, 'maxchar'=>300,
                                                    'autop' => false) );

                                                ?>
                                            </p>
                                            <p></p><span
                                                class="margin-ten display-block clearfix xs-margin-0auto"></span>
                                            <div class="person-social margin-ten xs-margin-0auto">

                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-6 col-md-5 col-sm-6 no-padding ">
                                        <img class="xs-img-full js-img" alt=""
                                             data-image="<?php echo $fileNew; ?>"
                                             src=""
                                             width="500" height="550">
                                    </div>
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
                </section>
                <section style="border-top: 1px solid #e5e5e5;">
                    <div class="container">
                        <div class="row">



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

                            cropImage($thumb_url[0],
                                $_SERVER['DOCUMENT_ROOT'] . $fileNew,
                                300, 300);

                            ?>


                            <div
                                class="wpb_column hcode-column-container  col-md-4 col-xs-mobile-fullwidth
                                col-sm-4 text-center xs-margin-ten-bottom">
                                <div class="vc-column-innner-wrapper">
                                    <div class="testimonial-style2"><img class="js-img" alt=""
                                        data-image="<?php echo $fileNew; ?>"
                                        src="" width="300" height="300"/>
                                        <p class="center-col width-90">
                                            <?php
                                            $post_content = preg_replace("/\\[.+\\]/m","",
                                                $post->post_content);
                                            //$post_content = str_replace("\n","<br>",
                                            //    $post_content);

                                            echo kama_excerpt( array('text'=>$post_content, 'maxchar'=>300,
                                                'autop' => false) );

                                            ?>
                                        </p>
                                        <div class="margin-two">
                                            <i class="fa fa-star" style="color:#e6af2a;"></i><i
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
                                if($i == 2) break;
                                $i++;

                            }
                            ?>



                            <?php

                            wp_reset_postdata(); // сброс
                            ?>




                        </div>
                    </div>
                </section>
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