<?php
/**
 * Created by PhpStorm.
 * User: GSU
 * Date: 29.07.2017
 * Time: 13:33
 */

require $_SERVER['DOCUMENT_ROOT'] . '/wp-load.php';
include $_SERVER['DOCUMENT_ROOT'] . '/includes/head.php';

global $wpdb;
$wpdb->set_prefix('portfolio_');

include $_SERVER['DOCUMENT_ROOT'] . '/includes/head_detail.php';
include $_SERVER['DOCUMENT_ROOT'] . '/includes/feedback_send.php';

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
<body class="page-template-default page page-id-52 wpb-js-composer js-comp-ver-5.1 vc_responsive">
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
            <div class="col-md-8 no-padding-right accordion-menu text-right pull-right menu-position-right">
                <div id="mega-menu" class="navbar-collapse collapse navbar-right">
                    <ul id="menu-onepage-wedding" class="mega-menu-ul nav navbar-nav navbar-right panel-group">
                        <?php
                        include $_SERVER['DOCUMENT_ROOT'] . '/includes/main_menu.php';
                        ?>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</nav>
<section class="parent-section no-padding post-52 page type-page status-publish hentry">
    <div class="container-fluid">
        <div class="row">
            <div class="entry-content">
                <section id="slider" class="  no-padding">
                    <div class="container-fluid">
                        <div class="row">
                            <div class="wpb_column hcode-column-container  col-xs-mobile-fullwidth">
                                <div class="vc-column-innner-wrapper">
                                    <div class="background-slider-text">
                                        <div class="container full-screen  position-relative">
                                            <div class="slider-typography">
                                                <div class="slider-text-middle-main">
                                                    <div
                                                        class="slider-text-middle slider-text-middle2 personal-name animated fadeIn">
                                                        <div
                                                            class="col-md-5 col-sm-8 col-xs-11 wedding-header
                                                            center-col">
                                                            <div class="wedding-header-sub bg-white"><span
                                                                    class="title-large text-uppercase
                                                                    letter-spacing-3 font-weight-700 pink-text
                                                                     display-block">
                                                                    <?php echo $arProject["post_title"]; ?>
                                                                </span><span
                                                                    class="margin-five display-block"><i
                                                                        class="fa fa-heart yellow-text"></i><i
                                                                        class="fa fa-heart yellow-text"></i><i
                                                                        class="fa fa-heart yellow-text"></i>
                                                                </span><span
                                                                    class="text-large text-uppercase
                                                                    letter-spacing-3 display-block">
                                                                <?php echo $arProject["post_content_formatted"]; ?>
                                                                </span><span
                                                                    class="text-large text-uppercase
                                                                    letter-spacing-3 font-weight-600">
                                                                    <?php echo implode($arPostTagsNames, " "); ?>
                                                                </span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div id="hcode-owl-slider14"
                                         class="owl-carousel owl-theme  dot-pagination dark-pagination dark-navigation cursor-black  hcode-owl-slider14 ">

                                        <?php foreach($arProjectAllImages as $image){ ?>
                                        <div class="item owl-bg-img full-screen js-background"
                                             data-image="<?php echo $image; ?>"
                                             style="background-image:url()"></div>
                                        <?php } ?>

                                    </div>
                                    <script type="text/javascript">/*<![CDATA[*/
                                        jQuery(document).ready(function () {
                                            jQuery("#hcode-owl-slider14").owlCarousel({
                                                navigation: false,
                                                pagination: false,
                                                transitionStyle: "fade",
                                                autoPlay: 3000,
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
                                class="wpb_column hcode-column-container  col-md-1 col-xs-mobile-fullwidth sm-text-center sm-margin-three-bottom">
                                <div class="vc-column-innner-wrapper">
                                    <div class="heading-style-five  padding-top-18px wedding-heart"><h1><i
                                                class="icon-heart large-icon vertical-align-middle"
                                                style="color: #e6af2a;"></i></h1></div>
                                </div>
                            </div>
                            <div
                                class="wpb_column hcode-column-container  col-md-4 col-xs-mobile-fullwidth sm-text-center sm-margin-seven-bottom">
                                <div class="vc-column-innner-wrapper"><p class="no-margin"><span
                                            class="title-large text-uppercase letter-spacing-3 font-weight-600 pink-text
                                            display-block">
                                            <?php echo $YEAR; ?>
                                        </span>
                                    </p></div>
                            </div>
                            <div class="wpb_column hcode-column-container  col-md-7 col-xs-mobile-fullwidth">
                                <div class="vc-column-innner-wrapper">
                                    <div id="hcode-time-counter" class="hcode-time-counter" data-days-text="Day"
                                         data-hours-text="Hours" data-minutes-text="Minutes" data-seconds-text="Seconds"
                                         style="color:#000000"></div>
                                    <span class="hide hcode-time-counter-date counter-hidden">01/20/2002</span></div>
                            </div>
                        </div>
                    </div>
                </section>
                <section id="couple" class="  fix-background js-background"
                         data-image="<? displayRandomElement($currentBackgroundImage); ?>">
                    <div class="selection-overlay" style=" opacity:0.5; background-color:#252525;"></div>
                    <div class="container">
                        <div class="row">

                            <?php
                            $arContent = preg_split('/[\n.]/u', $arProject["post_content"], -1, PREG_SPLIT_NO_EMPTY);
                            $arContentBlock = array_chunk($arContent, round(count($arContent)/4));

                            ?>
                            <div
                                class="wpb_column hcode-column-container  col-md-6 col-xs-mobile-fullwidth col-sm-6
                                text-center xs-margin-ten-bottom">
                                <div class="vc-column-innner-wrapper">
                                    <div class="about-couple ">
                                        <div class="about-couple-sub bg-white">
                                            <div class="margin-five no-margin-top">
                                                <?php
                                                $filename = getRandomElement($arProjectImages);
                                                $new_filen = $_SERVER["DOCUMENT_ROOT"].'/wp-content/uploads/' . basename($filename);


                                                $fileNew = "/wp-content/uploads/" . basename($filename);

                                                $fileNew = cropImage($filename,
                                                    $_SERVER['DOCUMENT_ROOT'] . $fileNew,
                                                    600, 600);

                                                ?>
                                                <img
                                                        data-image="<?php echo $fileNew; ?>"
                                                    class="white-round-border no-border js-img" alt=""
                                                    src=""
                                                    width="600" height="600"></div>
                                            <span
                                                class="title-small text-uppercase letter-spacing-3 font-weight-600 display-block"
                                                style="color:#d9378e !important"><?php displayRandomElement($arPostTagsNames); ?></span><span
                                                class="text-uppercase margin-one display-block letter-spacing-2">
                                                <?php displayRandomElement($arPostTagsNames); ?>
                                            </span>
                                            <div class="wide-separator-line bg-mid-gray margin-five no-margin-lr"></div>
                                            <p class="width-80 center-col text-med xs-width-100">
                                                <?php if($arContentBlock[0]) echo implode("\n", $arContentBlock[0]); ?>
                                            </p>
                                            <div class="wide-separator-line bg-mid-gray margin-five no-margin-lr"></div>


                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div
                                class="wpb_column hcode-column-container  col-md-6 col-xs-mobile-fullwidth col-sm-6 text-center">
                                <div class="vc-column-innner-wrapper">
                                    <div class="about-couple ">
                                        <div class="about-couple-sub bg-white">
                                            <div class="margin-five no-margin-top">
                                                <?php
                                                $filename = getRandomElement($arProjectImages);
                                                $new_filen = $_SERVER["DOCUMENT_ROOT"].'/wp-content/uploads/' . basename($filename);


                                                $fileNew = "/wp-content/uploads/" . basename($filename);

                                                $fileNew = cropImage($filename,
                                                    $_SERVER['DOCUMENT_ROOT'] . $fileNew,
                                                    600, 600);

                                                ?>
                                                <img
                                                        data-image="<?php echo $fileNew; ?>"
                                                        class="white-round-border no-border js-img" alt=""
                                                        src=""
                                                        width="600" height="600"></div>
                                            <span
                                                class="title-small text-uppercase letter-spacing-3 font-weight-600 display-block"
                                                style="color:#d9378e !important"><?php displayRandomElement($arPostTagsNames); ?></span><span
                                                class="text-uppercase margin-one display-block
                                                letter-spacing-2">
                                                <?php displayRandomElement($arPostTagsNames); ?>
                                            </span>
                                            <div class="wide-separator-line bg-mid-gray margin-five no-margin-lr"></div>
                                            <p class="width-80 center-col text-med xs-width-100">
                                                <?php if($arContentBlock[1]) echo implode("\n", $arContentBlock[1]); ?>
                                            </p>
                                            <div class="wide-separator-line bg-mid-gray margin-five no-margin-lr"></div>

                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
                <section id="event">
                    <div class="container">
                        <div class="row">
                            <div
                                class="wpb_column hcode-column-container  col-md-12 col-xs-mobile-fullwidth text-center">
                                <div class="vc-column-innner-wrapper"><h3 class="section-title "
                                                                          style=" color:#d9378e; font-weight:600 !important;;">
                                    Другие проекты</h3></div>
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
                                $currentProjectYear = get_post_meta($post->ID, 'YEAR')[0];
                                $arPostTags = wp_get_post_tags($post->ID);
                                unset($arCurrentPostTagsNames);
                                foreach ($arPostTags as $tag){
                                    $arCurrentPostTagsNames[] = $tag->name;
                                }
                            ?>
                            <div
                                class="wpb_column hcode-column-container  col-md-4 col-xs-mobile-fullwidth col-sm-4 text-center xs-margin-ten-bottom">
                                <div class="vc-column-innner-wrapper">
                                    <div class="event-box "><i class=" medium-icon margin-five"
                                                               style="color:#e6af2a !important"></i><span
                                            class="text-med text-uppercase letter-spacing-2 font-weight-600
                                            display-block"
                                            style="color:#000000 !important"><?php echo $post->post_title; ?></span>
                                        <div class="wide-separator-line bg-mid-gray margin-ten no-margin-lr"></div>
                                        <span class="text-uppercase letter-spacing-2 display-block
                                        black-text"><?php echo $currentProjectYear; ?></span><span
                                            class="event-time">
                                            <?php echo implode(" / ", $arCurrentPostTagsNames); ?>
                                        </span>
                                        <div class="wide-separator-line bg-mid-gray margin-ten no-margin-lr"></div>
                                        <p class="width-90 center-col text-med margin-ten no-margin-top">
                                            <?php
                                            $post_content = preg_replace("/\\[.+\\]/m","",
                                                $post->post_content);
                                            //$post_content = str_replace("\n","<br>",
                                            //    $post_content);

                                            echo kama_excerpt( array('text'=>$post_content,
                                                'maxchar'=>500,
                                                'autop' => false) );

                                            ?>
                                        </p> <a
                                            class="highlight-button-dark btn btn-small button no-margin-right inner-link"
                                            href="/detail/<?php echo basename(__FILE__); ?>?ID=<?php echo $post->ID; ?>"
                                            target="_self">Детали</a></div>
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
                <section class=" " style=" background-color:#dc378e; ">
                    <div class="container">
                        <div class="row">
                            <div
                                class="wpb_column hcode-column-container  col-md-6 col-xs-mobile-fullwidth text-center center-col">
                                <div class="vc-column-innner-wrapper">

                                    <img
                                            data-image="<?php displayRandomElement($arProjectMockups); ?>"
                                            class="js-img"
                                        src=""
                                        width="123" alt=""></div>
                            </div>
                            <div
                                class="wpb_column hcode-column-container  col-md-4 col-xs-mobile-fullwidth col-sm-6 text-center center-col margin-three-top">
                                <div class="vc-column-innner-wrapper"><p><span class="white-text text-large">
                                            <?php echo randomText()[0]; ?>
                                        </span>
                                    </p></div>
                            </div>
                        </div>
                    </div>
                </section>
                <section id="gallery">
                    <div class="container">
                        <div class="row">
                            <div
                                class="wpb_column hcode-column-container  col-md-12 col-xs-mobile-fullwidth text-center">
                                <div class="vc-column-innner-wrapper"><h3 class="section-title "
                                                                          style=" color:#d9378e; ">Галерея</h3>
                                    <div class="work-3col gutter ">
                                        <div
                                            class="col-md-12  no-padding grid-gallery overflow-hidden  content-section">
                                            <div class="tab-content">
                                                <ul class="grid masonry-items lightbox-gallery">

                                                    <?php
                                                    foreach($arProjectImages as $image) {

                                                        $filename = $image;
                                                        $new_filen = $_SERVER["DOCUMENT_ROOT"].'/wp-content/uploads/' . basename($filename);


                                                        $fileNew = "/wp-content/uploads/" . basename($filename);

                                                        $fileNew = cropImage($filename,
                                                            $_SERVER['DOCUMENT_ROOT'] . $fileNew,
                                                            1000, 667);
                                                        ?>
                                                        <li class="portfolio-filter-123 ">
                                                            <figure>
                                                                <div class="gallery-img"><a
                                                                            href="<?php echo $image; ?>"
                                                                            class="lightboxgalleryitem"
                                                                            data-group="general"><img
                                                                                src="<?php echo $fileNew; ?>"
                                                                                data-image="<?php echo $fileNew; ?>"
                                                                                class="js-img"
                                                                                width="1000" height="667" alt=""></a>
                                                                </div>
                                                                <figcaption><h3><?php displayRandomElement($arPostTagsNames); ?></h3>
                                                                    <p><?php displayRandomElement($arPostTagsNames); ?></p></figcaption>
                                                            </figure>
                                                        </li>
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
                    </div>
                </section>
                <section id="rsvp" class="  fix-background js-background"
                         data-image="<? displayRandomElement($currentBackgroundImage); ?>">
                    <div class="selection-overlay" style=" opacity:0.5; background-color:#252525;"></div>
                    <div class="container">
                        <div class="row">
                            <div
                                class="wpb_column hcode-column-container  col-md-12 col-xs-mobile-fullwidth col-sm-12 text-center">
                                <div class="vc-column-innner-wrapper"><h3 class="section-title "
                                                                          style=" color:#d9378e; ">Есть вопросы ?</h3></div>
                            </div>
                            <div
                                class="wpb_column hcode-column-container  col-md-6 col-xs-mobile-fullwidth
                                text-center center-col no-padding">
                                <div class="vc-column-innner-wrapper">
                                    <div role="form" class="wpcf7" id="wpcf7-f5922-p52-o1" lang="en-US" dir="ltr">
                                        <div class="screen-reader-response"></div>
                                        <form action="<?php echo $_SERVER["REQUEST_URI"]; ?>" method="post"
                                              class="wpcf7-form" novalidate="novalidate">
                                            <div style="display: none;"><input type="hidden" name="_wpcf7"
                                                                               value="5922"/> <input type="hidden"
                                                                                                     name="_wpcf7_version"
                                                                                                     value="4.7"/>
                                                <input type="hidden" name="_wpcf7_locale" value="en_US"/> <input
                                                    type="hidden" name="_wpcf7_unit_tag" value="wpcf7-f5922-p52-o1"/>
                                                <input type="hidden" name="_wpnonce" value="4026e24bf0"/></div>
                                            <div class="about-couple">
                                                <div class="about-couple-sub bg-white clearfix">
                                                    <div
                                                        class="col-md-10 col-sm-12 margin-ten no-margin-top center-col xs-no-padding-lr">
                                                        <span
                                                            class="letter-spacing-2 font-weight-600 text-large
                                                            black-text">
                                                            Заполните форму обратной связи
                                                        </span>
                                                    </div>
                                                    <div class="col-md-12 col-sm-12 reservation-name xs-no-padding-lr">
                                                        <span class="wpcf7-form-control-wrap your-name"><input
                                                                type="text" name="your-name" value="" size="40"
                                                                class="wpcf7-form-control wpcf7-text wpcf7-validates-as-required"
                                                                aria-required="true" aria-invalid="false"
                                                                placeholder="ВАШЕ ИМЯ"/></span></div>
                                                    <div class="col-md-12 col-sm-12 xs-no-padding-lr">
                                                            <span class="wpcf7-form-control-wrap menu-438">
                                                                <input type="email"
                                                                                                                  name="email-852"
                                                                                                                  value="" size="40"
                                                                                                                  class="wpcf7-form-control wpcf7-text wpcf7-email wpcf7-validates-as-required wpcf7-validates-as-email"
                                                                                                                  aria-required="true"
                                                                                                                  aria-invalid="false"
                                                                                                                  placeholder="ВАШ EMAIL"/></span>
                                                    </div>
                                                    <div class="col-md-12 col-sm-12 xs-no-padding-lr">
                                                            <span class="wpcf7-form-control-wrap menu-794">
                                                                <textarea
                                                                        name="your-message" cols="40" rows="2"
                                                                        class="wpcf7-form-control wpcf7-textarea" aria-invalid="false"
                                                                        placeholder="ВАШЕ СООБЩЕНИЕ"></textarea>
                                                            </span>
                                                    </div>
                                                    <div class="col-md-12 col-sm-12 text-center xs-no-padding-lr">
                                                        <div class="col-sm-12 no-padding-lr padding-two-tb"><input
                                                                type="submit" value="Отправить сообщение"
                                                                class="wpcf7-form-control wpcf7-submit btn btn-black btn-medium no-margin-bottom no-margin-top"/>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="wpcf7-response-output wpcf7-display-none"></div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
                <section id="blog">
                    <div class="container">
                        <div class="row">
                            <div
                                class="wpb_column hcode-column-container  col-md-12 col-xs-mobile-fullwidth col-sm-12 text-center">
                                <div class="vc-column-innner-wrapper"><h3 class="section-title "
                                                                          style=" color:#d9378e; ">
                                        Другие проекты
                                    </h3></div>
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


                            $width = 1000;
                            $height = 667;
                            $fileNew = "/wp-content/uploads/" . basename($filename);
                            $fileNew = cropImage($filename,
                                $_SERVER['DOCUMENT_ROOT'] . $fileNew,
                                $width, $height);




                            $width = 300;
                            $height = 200;
                            $fileNew300w = "/wp-content/uploads/" . basename($filename);
                            $fileNew300w = cropImage($filename,
                                $_SERVER['DOCUMENT_ROOT'] . $fileNew300w,
                                $width, $height);

                            $width = 768;
                            $height = 512;
                            $fileNew768w = "/wp-content/uploads/" . basename($filename);
                            $fileNew768w = cropImage($filename,
                                $_SERVER['DOCUMENT_ROOT'] . $fileNew768w,
                                $width, $height);




                            ?>

                            <div class="wpb_column hcode-column-container  col-md-4 col-xs-mobile-fullwidth col-sm-4">
                                <div class="vc-column-innner-wrapper">
                                    <div
                                        class="post-6065 post type-post status-publish format-standard has-post-thumbnail hentry category-wedding-photo-gallery">
                                        <div class="blog-post">
                                            <div class="blog-image"><a
                                                    href="/detail/<?php echo basename(__FILE__); ?>?ID=<?php echo $post->ID; ?>"><img
                                                        width="1000" height="667"
                                                        src="<?php echo $fileNew; ?>"
                                                        class="attachment-full size-full wp-post-image" alt="" title=""
                                                        srcset="<?php echo $fileNew; ?> 1000w,
                                                        <?php echo $fileNew300w; ?> 300w,
                                                        <?php echo $fileNew768w; ?> 768w"
                                                        sizes="(max-width: 1000px) 100vw, 1000px"/></a></div>
                                            <div class="post-details"><a
                                                    href="/detail/<?php echo basename(__FILE__); ?>?ID=<?php echo $post->ID; ?>"
                                                    class="post-title sm-margin-top-ten xs-no-margin-top entry-title">
                                                    <?php echo $post->post_title;?>
                                                </a><span
                                                    class="post-author light-gray-text2 author vcard">
                                                    <?php echo implode(" / ", $arCurrentPostTagsNames); ?>
                                                </span>
                                                <p class="entry-content">
                                                    <?php
                                                        echo kama_excerpt( array('text'=>$post->post_content, 'maxchar'=>200) );
                                                    ?>
                                                </p></div>
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
                <section id="location" class="  no-padding">
                    <div class="container-fluid">
                        <div class="row">
                            <div
                                class="wpb_column hcode-column-container  col-xs-mobile-fullwidth col-sm-12 no-padding">
                                <div class="vc-column-innner-wrapper">
                                    <div id="canvas1" class="contact-map map">
                                        <iframe id="map_canvas1"

                                                src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d41961826.997137904!2d92.56205828413495!3d50.06481483671859!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x5e89410b323173ef%3A0x7a0166a4885065b0!2z0JHQu9Cw0LPQvtCy0LXRidC10L3RgdC6LCDQkNC80YPRgNGB0LrQsNGPINC-0LHQuy4sIDY3NTAwOQ!5e0!3m2!1sru!2sru!4v1500129745569"

                                                width="300" height="150"></iframe>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
                <section class="  fix-background js-background"
                         data-image="<? displayRandomElement($currentBackgroundImage); ?>">
                    <div class="selection-overlay" style=" opacity:0.5; background-color:#252525;"></div>
                    <div class="container">
                        <div class="row">
                            <div
                                class="wpb_column hcode-column-container  col-md-5 col-xs-mobile-fullwidth col-sm-10 text-center center-col">
                                <div class="vc-column-innner-wrapper"><a
                                                                         href="<?php if($ProjectURL) echo $ProjectURL;
                                                                         else echo "#"; ?>"
                                                                         target="_self"><i
                                            class="icon-laptop white-text large-icon margin-ten no-margin-top"></i></a>
                                    <?php $randomText = randomText(); ?>
                                    <h1 class="white-text video-title"><?php echo $randomText[0]; ?></h1>
                                    <h6 class="white-text">
                                        <?php echo $randomText[1]; ?>
                                    </h6></div>
                            </div>
                        </div>
                    </div>
                </section>
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
