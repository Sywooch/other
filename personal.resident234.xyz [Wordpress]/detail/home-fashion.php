<?php
/**
 * Created by PhpStorm.
 * User: GSU
 * Date: 29.07.2017
 * Time: 15:49
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
<body class="page-template-default page page-id-5 wpb-js-composer js-comp-ver-5.1 vc_responsive">
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
<section class="parent-section no-padding post-5 page type-page status-publish hentry">
    <div class="container-fluid">
        <div class="row">
            <div class="entry-content">
                <section class="  parallax-fix parallax2 full-screen no-padding js-background"
                data-image="<?php displayRandomElement($currentBackgroundImage);?>"
                style="background-image:url();">
                    <div class="selection-overlay" style=" opacity:0.7; background-color:#ffffff;"></div>
                    <div class="wpb_column hcode-column-container  col-xs-mobile-fullwidth">
                        <div class="vc-column-innner-wrapper">
                            <div class=" container position-relative full-screen">
                                <div class="slider-typography">
                                    <div class="slider-text-middle-main">
                                        <div
                                            class="slider-text-middle text-center slider-text-middle1 center-col wow fadeIn">
                                            <span class="fashion-subtitle text-uppercase font-weight-700 text-center "
                                                  style="color:#000000;border-color:#000000;
width:700px;">
                                                <?php echo $arProject["post_title"];?>
                                            </span></div>
                                    </div>
                                </div>
                            </div>
                            <div class="scroll-down"><a href="#about" class="inner-link"><i
                                        class="fa fa-angle-down bg-black white-text"></i></a></div>
                        </div>
                    </div>
                </section>
                <section id="about" class="  fix-background  js-background"
                         data-image="<?php displayRandomElement($currentBackgroundImage);?>"
                         style="background-image:url();">
                    <div class="selection-overlay" style=" opacity:0.7; background-color:#252525;"></div>
                    <div class="container">
                        <div class="row">
                            <div class="wpb_column hcode-column-container  col-xs-mobile-fullwidth">
                                <div class="vc-column-innner-wrapper">
                                    <div class="slider-typography container position-relative ">
                                        <div class="slider-text-middle-main">
                                            <div
                                                class="slider-text-middle text-center slider-text-middle1 center-col wow fadeIn">
                                                <span
                                                    class="fashion-subtitle text-uppercase font-weight-700 border-color-white text-center "
                                                    style="color:#ffffff !important">
                                                    <?php echo get_post_meta($arProject["ID"], 'YEAR')[0]; ?>
                                                </span></div>
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
                            <div class="wpb_column hcode-column-container  col-xs-mobile-fullwidth text-center">
                                <div class="vc-column-innner-wrapper">
                                    <h3 class="section-title  black-text no-padding">
                                        Последние проекты</h3>
                                </div>
                            </div>
                            <div
                                class="wpb_column hcode-column-container  col-md-5 col-xs-mobile-fullwidth col-sm-8 text-center center-col margin-three">
                                <div class="vc-column-innner-wrapper">
                                    <h4 class="gray-text">
                                        <?php displayRandomElement($currentDetailTitle);?>
                                    </h4>
                                </div>
                            </div>
                            <div class="wpb_column hcode-column-container  col-xs-mobile-fullwidth">
                                <div class="vc-column-innner-wrapper">
                                    <div class="hcode-space margin-five-bottom"></div>
                                </div>
                            </div>




                            <?php
                            include $_SERVER['DOCUMENT_ROOT'] . '/includes/portfolio_grid_gallery_new_first.php';
                            ?>


                            <?php
                            $i = 0;
                            foreach ($arNewProjects as $post) {

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

                                cropImage($thumb_url[0],
                                    $_SERVER['DOCUMENT_ROOT'] . $fileNew,
                                    700, 853);

                                $arPostTags = wp_get_post_tags($post->ID);

                                unset($arCurrentPostTagsNames);
                                foreach ($arPostTags as $tag){
                                    $arCurrentPostTagsNames[] = $tag->name;
                                }
                                ?>


                                <div
                                        class="wpb_column hcode-column-container  col-md-6 col-xs-mobile-fullwidth
                                        col-sm-6 margin-bottom-40px xs-margin-ten-bottom">
                                    <div class="vc-column-innner-wrapper">
                                        <div class="clearfix ">
                                            <div class="col-md-6 col-sm-12 col-xs-12 no-padding pull-left sm-pull-right">
                                                <img alt=""
                                                     data-image="<?php echo $fileNew; ?>"
                                                     src=""
                                                     width="700" height="853" class="js-img"></div>
                                            <div class="col-md-6 col-sm-12 col-xs-12 no-padding  pull-right sm-pull-left">
                                                <div class="model-details-text">
                                                    <div class="separator-line bg-black no-margin-lr margin-ten"></div>
                                                    <span
                                                            class="margin-ten display-block clearfix xs-margin-0auto sm-display-none"></span>
                                                    <span
                                                            class="text-uppercase font-weight-600 black-text letter-spacing-2">
                                                        <?php echo $post->post_title; ?>
                                                    </span><span
                                                            class="text-uppercase text-small letter-spacing-2 margin-three display-block">
                                                        <?php echo implode(" / ", $arCurrentPostTagsNames); ?></span>
                                                    <p class="margin-ten">
                                                        <?php
                                                        $post_content = preg_replace("/\\[.+\\]/m","",
                                                            $post->post_content);
                                                        //$post_content = str_replace("\n","<br>",
                                                        //    $post_content);

                                                        echo kama_excerpt( array('text'=>$post_content,
                                                            'maxchar'=>300,
                                                            'autop' => false) );
                                                        ?>
                                                    </p> <span
                                                            class="margin-ten display-block clearfix xs-margin-0auto"></span><a
                                                            class="highlight-button-dark btn btn-very-small no-margin"
                                                            href="/detail/<?php echo basename(__FILE__); ?>?ID=<?php echo $post->ID; ?>"
                                                            target="_self">Подробнее</a></div>
                                            </div>
                                        </div>
                                    </div>
                                </div>



                                <?php
                                if($i == 3) break;
                                $i++;

                            }
                            ?>






                        </div>
                    </div>
                </section>
                <section class="  fix-background js-background"
                    data-image="<?php displayRandomElement($currentBackgroundImage);?>"
                         style=" background-image: url(); ">
                    <div class="selection-overlay" style=" opacity:0.7; background-color:#252525;"></div>
                    <div class="container">
                        <div class="row">
                            <div class="wpb_column hcode-column-container  col-xs-mobile-fullwidth">
                                <div class="vc-column-innner-wrapper">
                                    <div class="slider-typography container position-relative ">
                                        <div class="slider-text-middle-main">
                                            <div
                                                class="slider-text-middle text-center slider-text-middle1 center-col wow fadeIn">
                                                <span
                                                    class="fashion-subtitle text-uppercase font-weight-700
                                                    border-color-white text-center "
                                                    style="color:#ffffff !important; width:500px;">
                                                    <?php displayRandomElement($arPostTagsNames);?>
                                                </span></div>
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
                            <div class="wpb_column hcode-column-container  col-xs-mobile-fullwidth text-center">
                                <div class="vc-column-innner-wrapper">
                                    <h3
                                        class="section-title  black-text no-padding-bottom">Галерея</h3>
                                </div>
                            </div>
                            <div
                                class="wpb_column hcode-column-container  col-md-5 col-xs-mobile-fullwidth col-sm-8 text-center center-col margin-three">
                                <div class="vc-column-innner-wrapper">
                                    <h4 class="gray-text">
                                    </h4>
                                </div>
                            </div>
                            <div class="wpb_column hcode-column-container  col-xs-mobile-fullwidth">
                                <div class="vc-column-innner-wrapper">
                                    <div class="hcode-space margin-five-bottom"></div>
                                </div>
                            </div>
                            <div class="wpb_column hcode-column-container  col-xs-mobile-fullwidth">
                                <div class="vc-column-innner-wrapper">
                                    <div class="work-3col gutter ">
                                        <div class="col-md-12  grid-gallery overflow-hidden  content-section">
                                            <div class="tab-content">
                                                <ul class="grid masonry-items lightbox-gallery">


                                                    <?php

                                                    foreach($arProjectImages as $projectImage){

                                                        $filename = $projectImage;
                                                        $new_filen = $_SERVER["DOCUMENT_ROOT"].'/wp-content/uploads/' . basename($filename);


                                                        $fileNew = "/wp-content/uploads/" . basename($filename);

                                                        cropImage($projectImage,
                                                            $_SERVER['DOCUMENT_ROOT'] . $fileNew,
                                                            800, 600);
                                                    ?>

                                                    <li class="portfolio-filter-73 ">
                                                        <figure>
                                                            <div class="gallery-img"><a
                                                                    href="<?php echo $projectImage; ?>"
                                                                    class="lightboxgalleryitem"
                                                                    data-group="general">
                                                                    <img
                                                                            class="js-img"
                                                                        src="<?php echo $fileNew; ?>"
                                                                            data-image="<?php echo $fileNew; ?>"
                                                                        width="800" height="600" alt=""></a></div>
                                                            <figcaption>
                                                                <h3>Изображение проекта</h3>
                                                                <p></p>
                                                            </figcaption>
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
                <section>
                    <div class="container">
                        <div class="row">
                            <div class="wpb_column hcode-column-container  col-xs-mobile-fullwidth text-center">
                                <div class="vc-column-innner-wrapper"><h3
                                        class="section-title  black-text no-padding-bottom">Проекты</h3></div>
                            </div>
                            <div
                                class="wpb_column hcode-column-container  col-md-5 col-xs-mobile-fullwidth col-sm-8 text-center center-col margin-three">
                                <div class="vc-column-innner-wrapper">
                                    <h4 class="gray-text">
                                    </h4>
                                </div>
                            </div>
                            <div class="wpb_column hcode-column-container  col-xs-mobile-fullwidth">
                                <div class="vc-column-innner-wrapper">
                                    <div class="hcode-space margin-five-bottom"></div>
                                </div>
                            </div>



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
                                ?>




                                <div
                                        class="wpb_column hcode-column-container  col-md-4 col-xs-mobile-fullwidth
                                col-sm-4 xs-margin-three-bottom wow fadeInUp"
                                        data-wow-duration=300ms>
                                    <div class="vc-column-innner-wrapper">
                                        <div
                                                class="post-3258 post type-post status-publish format-image
                                        has-post-thumbnail hentry category-feature post_format-post-format-image">
                                            <div class="blog-post">
                                                <div class="blog-image"><a
                                                            href="/detail/<?php echo $arDetailTemplates[wp_rand(0, count($arDetailTemplates) - 1)]; ?>?ID=<?php echo $post->ID; ?>"><img
                                                                width="900" height="564"
                                                                src=""
                                                                data-image="<?php echo $thumb_url[0]; ?>"
                                                                class="attachment-full size-full wp-post-image js-img" alt="" title=""
                                                                srcset="<?php echo $thumb_url[0]; ?> 800w,
                                                        <?php echo $thumb_url[0]; ?> 300w,
                                                        <?php echo $thumb_url[0]; ?> 768w,
                                                        <?php echo $thumb_url[0]; ?> 133w,
                                                        <?php echo $thumb_url[0]; ?> 374w"
                                                                sizes="(max-width: 900px) 100vw, 900px"/></a></div>
                                                <div class="post-details"><a
                                                            href="/detail/<?php echo $arDetailTemplates[wp_rand(0, count($arDetailTemplates) - 1)]; ?>?ID=<?php echo $post->ID; ?>"
                                                            class="post-title sm-margin-top-ten xs-no-margin-top entry-title">
                                                        <?php echo $post->post_title; ?>
                                                    </a><span
                                                            class="post-author light-gray-text2 author vcard">
                                                        <?php echo implode(" | ", $arCurrentPostTagsNames); ?>
                                                    </span>
                                                    <p class="entry-content">
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
                                </div>



                                <?php
                                if($i == 3) break;
                                $i++;
                            }

                            wp_reset_postdata(); // сброс
                            ?>




                            <div class="wpb_column hcode-column-container  col-xs-mobile-fullwidth">
                                <div class="vc-column-innner-wrapper">
                                    <div class="hcode-space margin-four-bottom"></div>
                                </div>
                            </div>
                            <div
                                class="wpb_column hcode-column-container  col-md-12 col-xs-mobile-fullwidth col-sm-12 text-center wow fadeInUp"
                                data-wow-duration=1200ms>
                                <div class="vc-column-innner-wrapper"><a
                                        href="/projects/" target="_self"
                                        class="inner-link highlight-button-dark btn-small  button btn">Все проекты</a>
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