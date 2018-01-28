<?php
/**
 * Created by PhpStorm.
 * User: GSU
 * Date: 29.07.2017
 * Time: 15:02
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
<body class="page-template-default page page-id-8 wpb-js-composer js-comp-ver-5.1 vc_responsive">
<?php
include $_SERVER['DOCUMENT_ROOT'] . '/includes/head_white_menu_logo.php';
?>
<section class="parent-section no-padding post-8 page type-page status-publish hentry">
    <div class="container-fluid">
        <div class="row">
            <div class="entry-content">
                <section class="  parallax-fix parallax1 full-screen no-padding js-background"
                         data-image="<?php displayRandomElement($currentBackgroundImage); ?>"
                         src=""
                         style=" background-image: url(); ">
                    <div class="wpb_column hcode-column-container  col-xs-mobile-fullwidth">
                        <div class="vc-column-innner-wrapper">
                            <div class=" container position-relative full-screen">
                                <div class="slider-typography">
                                    <div class="slider-text-middle-main">
                                        <div class="slider-text-bottom agency-header"><img
                                                    class="js-img"

                                                    src=""
                                                    data-image="<?php displayRandomElement($arProjectMockups); ?>"
                                                width="442" height="159" alt=""/>
                                            <h1><?php echo $arProject["post_title"];?></h1>
                                            <p><span
                                                    class="black-text text">
                                                    <?php echo implode(" / ", $arPostTagsNames); ?>
                                                </span>
                                            </p></div>
                                    </div>
                                </div>
                            </div>
                            <div class="scroll-down"><a href="#about-studio" class="inner-link"><i
                                        class="fa fa-angle-down bg-black white-text"></i></a></div>
                        </div>
                    </div>
                </section>
                <section id="about-studio" class="  padding-three-tb">
                    <div class="container">
                        <div class="row">
                            <div class="wpb_column hcode-column-container  col-md-6 col-xs-mobile-fullwidth col-sm-6">
                                <div class="vc-column-innner-wrapper"><h3
                                        class="text-large letter-spacing-2 text-uppercase agency-title  xs-margin-four-bottom black-text">
                                        <?php displayRandomElement($arPostTagsNames); ?></h3></div>
                            </div>
                            <div
                                class="wpb_column hcode-column-container  col-md-6 col-xs-mobile-fullwidth col-sm-6 text-right xs-text-left">
                                <div class="vc-column-innner-wrapper">
                                    <div class="text-extra-large font-weight-400">
                                        <?php displayRandomElement($currentDetailTitle); ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
                <section class="  wow fadeIn" style=" background-color:#f6f6f6; ">
                    <div class="container">
                        <div class="row">
                            <div
                                class="wpb_column hcode-column-container  col-md-6 col-xs-mobile-fullwidth col-sm-10 text-center center-col">
                                <div class="vc-column-innner-wrapper"><span
                                        class="margin-five no-margin-top display-block letter-spacing-2">
                                        <?php echo get_post_meta($arProject["ID"], 'YEAR')[0]; ?>
                                    </span>
                                    <h1><?php echo $arProject["post_title"];?></h1>
                                    <p class="text-med width-90 center-col margin-seven no-margin-bottom">
                                        <?php echo $arProject["post_content_formatted"]; ?>
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
                <section class="  wow fadeIn no-padding">
                    <div class="container-fluid">
                        <div class="row">
                            <div
                                class="wpb_column hcode-column-container  bg-fast-yellow col-md-12 col-xs-12 text-center padding-three-tb">
                                <div class="vc-column-innner-wrapper">
                                    <div class="text-small text-uppercase font-weight-600 black-text letter-spacing-2">
                                        <?php echo implode(" / ", $arPostTagsNames); ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
                <section class=" " style=" background-color:#252525; ">
                    <div class="container">


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

                        <div class="row">
                            <div
                                class="wpb_column hcode-column-container  col-md-3 col-xs-mobile-fullwidth
                                col-sm-6 text-center sm-margin-ten-bottom wow fadeInUp">
                                <div class="vc-column-innner-wrapper">
                                    <div class="counter-section"><span id="counter_1"
                                                                       data-to="<?php echo $countPosts;?>"
                                                                       class="counter-number white-text">
                                            <?php echo $countPosts;?>
                                        </span><span
                                            class="counter-title white-text">
                                            <?php
                                            echo numberof($countPosts, '',
                                                array('Проект', 'Проекта', 'Проектов'));
                                            ?>
                                        </span></div>
                                </div>
                            </div>
                            <div
                                class="wpb_column hcode-column-container  col-md-3 col-xs-mobile-fullwidth col-sm-6 text-center sm-margin-ten-bottom wow fadeInUp">
                                <div class="vc-column-innner-wrapper">
                                    <div class="counter-section"><span id="counter_2"
                                                                       data-to="<?php echo $countSertificates;?>"
                                                                       class="counter-number white-text">
                                            <?php echo $countSertificates;?>
                                        </span><span
                                            class="counter-title white-text">
                                            <?php
                                            echo numberof($countPosts, '',
                                                array('Сертификат', 'Сертификата', 'Сертификатов'));
                                            ?>
                                        </span></div>
                                </div>
                            </div>
                            <div
                                class="wpb_column hcode-column-container  col-md-3 col-xs-mobile-fullwidth col-sm-6 text-center xs-margin-ten-bottom wow fadeInUp">
                                <div class="vc-column-innner-wrapper">
                                    <div class="counter-section"><span id="counter_3" data-to="<?php echo $countFilesInRepo; ?>"
                                                                       class="counter-number white-text"><?php echo $countFilesInRepo; ?></span><span
                                            class="counter-title white-text">Файлов с кодом в репозитории</span></div>
                                </div>
                            </div>
                            <div
                                class="wpb_column hcode-column-container  col-md-3 col-xs-mobile-fullwidth col-sm-6 text-center wow fadeInUp">
                                <div class="vc-column-innner-wrapper">
                                    <div class="counter-section"><span id="counter_4" data-to="<?php echo $humanYearsRemote; ?>"
                                                                       class="counter-number white-text"><?php echo $humanYearsRemote; ?></span><span
                                            class="counter-title white-text"><?php
                                            echo numberof($humanYearsRemote, '', array('год', 'года', 'лет'));
                                            ?> опыта работы</span></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
                <section class="  padding-three-tb">
                    <div class="container">
                        <div class="row">
                            <div class="wpb_column hcode-column-container  col-md-6 col-xs-mobile-fullwidth col-sm-6">
                                <div class="vc-column-innner-wrapper"><h3
                                        class="text-large letter-spacing-2 text-uppercase agency-title  xs-margin-four-bottom black-text">
                                        <?php displayRandomElement($arPostTagsNames); ?></h3></div>
                            </div>
                            <div
                                class="wpb_column hcode-column-container  col-md-6 col-xs-mobile-fullwidth col-sm-6 text-right xs-text-left">
                                <div class="vc-column-innner-wrapper">
                                    <div class="text-extra-large font-weight-400">
                                        <?php displayRandomElement($currentDetailTitle); ?>
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

                            $categoryId = PORTFOLIO_WP_CATEGORY_SITES_ID;

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

                            $i = 0;
                            foreach ($posts as $post) {
                                setup_postdata($post);


                                ?>


                                <div
                                        class="wpb_column hcode-column-container
                                        col-md-4 col-xs-mobile-fullwidth col-sm-4 text-center xs-margin-ten-bottom">
                                    <div class="vc-column-innner-wrapper">
                                        <div class="features-box-style1">
                                            <i class="icon-<?php echo $post->post_content;?> medium-icon"></i><h5
                                                    class=" margin-bottom-15px xs-margin-bottom-10px"><?php echo $post->post_title;?></h5>
                                            <div class="no-margin"><p></p></div>
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
                <section class=" " style=" background-color:#fdd947; ">
                    <div class="container">
                        <div class="row">
                            <div
                                class="wpb_column hcode-column-container  col-md-6 col-xs-mobile-fullwidth col-sm-10 text-center center-col">
                                <div class="vc-column-innner-wrapper">
                                    <h1><?php displayRandomElement($currentDetailTitle); ?></h1>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
                <section class="  margin-bottom-40px xs-margin-bottom-20px padding-three-tb"
                         style="border-bottom: 1px solid #e5e5e5;">
                    <div class="container">
                        <div class="row">
                            <div class="wpb_column hcode-column-container  col-md-6 col-xs-mobile-fullwidth col-sm-6">
                                <div class="vc-column-innner-wrapper"><h3
                                        class="text-large letter-spacing-2 text-uppercase agency-title  xs-margin-four-bottom black-text">
                                        <?php displayRandomElement($arPostTagsNames); ?></h3></div>
                            </div>
                            <div
                                class="wpb_column hcode-column-container  col-xs-mobile-fullwidth col-sm-6 text-right xs-text-left">
                                <div class="vc-column-innner-wrapper">
                                    <div class="text-extra-large font-weight-400">
                                        <?php displayRandomElement($currentDetailTitle); ?>
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
                                class="wpb_column hcode-column-container  col-xs-mobile-fullwidth col-sm-12 no-padding">
                                <div class="vc-column-innner-wrapper">


                                    <div class="col-md-12 text-center">
                                        <div class="text-center">
                                            <ul class="portfolio-filter nav nav-tabs nav-tabs-black wow fadeIn"
                                            style="margin-bottom:20px;">
                                                <?php
                                                include $_SERVER['DOCUMENT_ROOT'] . '/includes/portfolio_filter.php';
                                                ?>
                                            </ul>
                                        </div>
                                    </div>


                                    <?php
                                    include $_SERVER['DOCUMENT_ROOT'] . '/includes/portfolio_grid_gallery.php';
                                    ?>




                                    <div class="work-3col masonry wide ">
                                        <div class="col-md-12  grid-gallery overflow-hidden no-padding content-section">
                                            <div class="tab-content">
                                                <ul class="grid masonry-items ">



                                                    <?php
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
                                                                            href="/detail/<?php echo $arDetailTemplates[wp_rand(0, count($arDetailTemplates) - 1)]; ?>?ID=<?php echo $post->ID; ?>"
                                                                            class="" target="">
                                                                        <img alt="" data-image="<?php echo $thumb_url[0]; ?>"
                                                                             class="js-img"
                                                                             src="<?php echo $thumb_url_medium[0]; ?>"
                                                                             width="700"
                                                                        />
                                                                    </a>
                                                                </div>
                                                                <figcaption>
                                                                    <h3>
                                                                        <a
                                                                                href="/detail/<?php echo $arDetailTemplates[wp_rand(0, count($arDetailTemplates) - 1)]; ?>?ID=<?php echo $post->ID; ?>"
                                                                                class=""
                                                                                target="">
                                                                            <?php echo $post->post_title; ?>
                                                                            <?php if(in_array($post->ID, $arNewProjects)){ ?>
                                                                                <span>New</span>
                                                                            <?php } ?>
                                                                        </a>
                                                                    </h3>
                                                                </figcaption>
                                                            </figure>
                                                        </li>


                                                        <?php
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
                <section class="  padding-three-tb">
                    <div class="container">
                        <div class="row">
                            <div class="wpb_column hcode-column-container  col-md-6 col-xs-mobile-fullwidth col-sm-6">
                                <div class="vc-column-innner-wrapper"><h3
                                        class="text-large letter-spacing-2 text-uppercase agency-title  xs-margin-four-bottom black-text">
                                        <?php displayRandomElement($arPostTagsNames); ?></h3></div>
                            </div>
                            <div
                                class="wpb_column hcode-column-container  col-md-6 col-xs-mobile-fullwidth col-sm-6 text-right xs-text-left">
                                <div class="vc-column-innner-wrapper">
                                    <div class="text-extra-large font-weight-400">
                                        <?php displayRandomElement($currentDetailTitle); ?>
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



                            <div class="wpb_column hcode-column-container  col-md-4 col-xs-12 text-center">
                                <div class="vc-column-innner-wrapper">
                                    <div class="key-person ">
                                        <div class="key-person-img">
                                            <img alt=""
                                                                         data-image="<?php echo $thumb_url[0]; ?>"
                                                                         src="<?php //echo $thumb_url_medium[0]; ?>"
                                                                         class="js-img"
                                                                         width="800" height="1000">
                                        </div>
                                        <div class="key-person-details bg-gray no-border no-padding-bottom">
                                            <h5><?php echo $post->post_title; ?></h5>
                                            <div class="separator-line bg-black"></div>
                                            <p><?php
                                                $post_content = preg_replace("/\\[.+\\]/m","",
                                                    $post->post_content);
                                                //$post_content = str_replace("\n","<br>",
                                                //    $post_content);

                                                echo kama_excerpt( array('text'=>$post_content, 'maxchar'=>300,
                                                    'autop' => false) );

                                                ?>
                                            </p></div>
                                    </div>
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
                <section class="  padding-three-tb">
                    <div class="container">
                        <div class="row">
                            <div class="wpb_column hcode-column-container  col-md-6 col-xs-mobile-fullwidth col-sm-6">
                                <div class="vc-column-innner-wrapper"><h3
                                        class="text-large letter-spacing-2 text-uppercase agency-title  xs-margin-four-bottom black-text">
                                        <?php displayRandomElement($arPostTagsNames); ?></h3></div>
                            </div>
                            <div
                                class="wpb_column hcode-column-container  col-md-6 col-xs-mobile-fullwidth col-sm-6 text-right xs-text-left">
                                <div class="vc-column-innner-wrapper">
                                    <div class="text-extra-large font-weight-400">
                                        <?php displayRandomElement($currentDetailTitle); ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
                <section class="  no-padding" style=" background-color:#f6f6f6; ">
                    <div class="container-fluid">
                        <div class="row">


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
                                class="wpb_column hcode-column-container  col-md-3 col-xs-mobile-fullwidth col-sm-6 text-center no-padding">
                                <div class="vc-column-innner-wrapper">
                                    <div class="team-member position-relative agency-team "
                                    style="min-height:300px;">
                                        <div class=""><img alt=""
                                                           data-image="<?php echo $thumb_url[0]; ?>"
                                                           src="<?php //echo $thumb_url_medium[0]; ?>"
                                                           class="js-img">
                                            <div class="team-details bg-blck-overlay"><h5
                                                    class="team-headline white-text text-uppercase
                                                    font-weight-600"><?php echo $post->post_title; ?></h5>
                                                <p class="width-60 center-col light-gray-text margin-five"></p>
                                                <p class="width-60 center-col light-gray-text margin-five">
                                                    <?php
                                                    $post_content = preg_replace("/\\[.+\\]/m","",
                                                        $post->post_content);
                                                    //$post_content = str_replace("\n","<br>",
                                                    //    $post_content);

                                                    echo kama_excerpt( array('text'=>$post_content, 'maxchar'=>300,
                                                        'autop' => false) );

                                                    ?>
                                                </p>
                                                <p></p>
                                                <div class="person-social margin-five">
                                                    </div>
                                                <figure class="position-absolute bg-fast-yellow"><span
                                                        class="team-name text-uppercase black-text letter-spacing-2 display-block font-weight-600"><?php echo implode("  ", $arCurrentPostTagsNames); ?></span><span
                                                        class="team-post text-uppercase black-text letter-spacing-2 display-block">
                                                        <?php if($projectURL){ ?>
                                                            <a href="<?php echo $projectURL;?> target="_self">Перейти на сайт</a>
                                                        <?php } ?>
                                                    </span>
                                                </figure>
                                            </div>
                                        </div>
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
                <section class=" " style=" background-color:#fdd947; ">
                    <div class="container">
                        <div class="row">
                            <div
                                class="wpb_column hcode-column-container  col-md-6 col-xs-mobile-fullwidth col-sm-10 text-center center-col">
                                <div class="vc-column-innner-wrapper"><h1>Вы можете посмотреть другие проекты</h1>
                                    <a href="/projects/"
                                                        target="_self"
                                                        class="inner-link highlight-button-dark btn-medium
                                                        margin-ten-top button btn">
                                        Портфолио
                                    </a></div>
                            </div>
                        </div>
                    </div>
                </section>
                <section class="  padding-three-tb">
                    <div class="container">
                        <div class="row">
                            <div class="wpb_column hcode-column-container  col-md-6 col-xs-mobile-fullwidth col-sm-6">
                                <div class="vc-column-innner-wrapper"><h3
                                        class="text-large letter-spacing-2 text-uppercase agency-title  xs-margin-four-bottom black-text">
                                        <?php displayRandomElement($arPostTagsNames); ?></h3></div>
                            </div>
                            <div
                                class="wpb_column hcode-column-container  col-md-6 col-xs-mobile-fullwidth col-sm-6 text-right xs-text-left">
                                <div class="vc-column-innner-wrapper">
                                    <div class="text-extra-large font-weight-400">
                                        <?php displayRandomElement($currentDetailTitle); ?>
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
                                class="wpb_column hcode-column-container  col-md-4 col-xs-mobile-fullwidth
                                col-sm-4 xs-margin-ten-bottom wow fadeInUp">
                                <div class="vc-column-innner-wrapper">
                                    <div
                                        class="post-2871 post type-post status-publish format-image
                                        has-post-thumbnail hentry
                                        category-feature post_format-post-format-image">
                                        <div class="blog-post">
                                            <div class="blog-image"><a
                                                    href="/detail/<?php echo $arDetailTemplates[wp_rand(0, count($arDetailTemplates) - 1)]; ?>?ID=<?php echo $post->ID; ?>">
                                                    <img
                                                        width="800" height="500"
                                                        data-image="<?php echo $thumb_url[0]; ?>"
                                                        src="http://wpdemos.themezaa.com/h-code/wp-content/uploads/2015/09/blog-post1.jpg"
                                                        class="attachment-full size-full wp-post-image js-img" alt="" title=""
                                                        srcset="<?php echo $thumb_url[0]; ?> 800w,
                                                        <?php echo $thumb_url[0]; ?> 300w,
                                                        <?php echo $thumb_url[0]; ?> 768w,
                                                        <?php echo $thumb_url[0]; ?> 133w,
                                                        <?php echo $thumb_url[0]; ?> 374w"
                                                        sizes="(max-width: 800px) 100vw, 800px"/></a></div>
                                            <div class="post-details"><a
                                                    href="/detail/<?php echo $arDetailTemplates[wp_rand(0, count($arDetailTemplates) - 1)]; ?>?ID=<?php echo $post->ID; ?>"
                                                    class="post-title sm-margin-top-ten xs-no-margin-top entry-title">
                                                    <?php echo $post->post_title; ?></a>
                                                <span
                                                    class="post-author light-gray-text2 author vcard">
                                                    <?php echo implode(" | ", $arCurrentPostTagsNames); ?>
                                                </span>
                                                <p class="entry-content"><?php
                                                    $post_content = preg_replace("/\\[.+\\]/m","",
                                                        $post->post_content);
                                                    //$post_content = str_replace("\n","<br>",
                                                    //    $post_content);

                                                    echo kama_excerpt( array('text'=>$post_content, 'maxchar'=>500,
                                                        'autop' => false) );

                                                    ?></p></div>
                                        </div>
                                    </div>
                                </div>
                            </div>




                                <?php
                                if ($i == 2) {
                                    break;
                                }
                                $i++;
                            }
                            ?>

                            <div class="wpb_column hcode-column-container  col-xs-mobile-fullwidth">
                                <div class="vc-column-innner-wrapper">
                                    <div class="hcode-space margin-four-bottom"></div>
                                </div>
                            </div>
                            <div
                                class="wpb_column hcode-column-container  col-md-12 col-xs-mobile-fullwidth
                                col-sm-12 text-center">
                                <div class="vc-column-innner-wrapper"><a
                                        href="/projects/" target="_self"
                                        class="inner-link highlight-button-dark btn-small  button btn">
                                        Посмотреть все проекты
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
            </div>
        </div>
    </div>
</section>
<?php
include $_SERVER['DOCUMENT_ROOT'] . '/includes/detail_pagination.php';
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