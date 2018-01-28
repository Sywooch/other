<?php
/**
 * Created by PhpStorm.
 * User: GSU
 * Date: 23.07.2017
 * Time: 22:27
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
<body
    class="portfolio-template-default single single-portfolio postid-9446 single-format-standard wpb-js-composer js-comp-ver-5.1 vc_responsive">
<nav
    class="navbar navbar-default navbar-fixed-top nav-transparent overlay-nav sticky-nav white-header nav-border-bottom  nav-black "
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
<section class="content-top-margin page-title-section page-title page-title-small bg-gray">
    <div class="container">
        <div class="row">
            <div class="col-lg-8 col-md-7 col-sm-12 animated fadeInUp">
                <h1 class="black-text"><?php echo $arProject["post_title"];?></h1>
                <div
                    class="separator-line margin-three bg-black no-margin-lr sm-margin-top-three sm-margin-bottom-three no-margin-bottom xs-display-none"></div>
            </div>
            <div class="col-lg-4 col-md-5 col-sm-12 breadcrumb text-uppercase wow fadeInUp xs-display-none"
                 data-wow-duration="600ms">
                <ul class="breadcrumb-gray-text">
                    <li><a href="/" title="Browse to: Home">Главная</a></li>
                    <li>Портфолио</li>
                </ul>
            </div>
        </div>
    </div>
</section>
<section
        class=" post-2737 portfolio type-portfolio status-publish format-standard has-post-thumbnail
    hentry portfolio-category-wordpress portfolio-tags-portfolio-abstract">
    <div class="container col2-layout">
        <div class="row">
            <div class="col-md-8 col-sm-8 col-xs-12">
                <section class="no-padding">
                    <div class="container">
                        <div class="row">

                            <?php
                            $gal = get_post_gallery( $arProject["ID"], false );
                            $arIDs = explode(',', $gal['ids']);

                            unset($arProjectMockups);
                            foreach($arIDs as $keyImageID => $itemImageID) {

                                $arMetaImage = wp_get_attachment_metadata($itemImageID);

                                $thumb_img = get_post($itemImageID);

                                if($thumb_img->post_excerpt == "PERSONAL_MOCKUP"){

                                    $arProjectMockups[] = PORTFOLIO_WP_UPLOAD_DIR_URL."".$arMetaImage["file"];

                                }

                            }

                            if(!$arProjectMockups){
                                $thumb_id = get_post_thumbnail_id($arProject["ID"]);
                                $thumb_url = wp_get_attachment_image_src($thumb_id, 'full',
                                    false);

                                $thumb_url[0] = str_replace(get_site_url(),
                                    PORTFOLIO_WP_URL,
                                    $thumb_url[0]);
                                $arProjectMockups[] = $thumb_url[0];
                            }
                            ?>

                            <div class="gallery-img margin-bottom-30px">

                                <?php
                                foreach($arProjectMockups as $arProjectMockup){

                                    ?>

                                    <img
                                            data-image="<?php echo $arProjectMockup; ?>"
                                            src="" class="js-img"
                                            width="800" height="500" alt="">

                                    <?php
                                }
                                ?>
                            </div>
                        </div>
                    </div>
                </section>
                <div class="blog-details-text portfolio-single-content">
                    <div class="entry-content">
                        <section class="  no-padding">
                            <div
                                    class="wpb_column hcode-column-container  col-md-12 col-xs-mobile-fullwidth no-padding">
                                <div class="vc-column-innner-wrapper">
                                    <p class="text-large">
                                        <?php echo $arProject["post_title"]; ?>
                                    </p>
                                    <p>
                                        <?php
                                        $arProject["post_content"] =  preg_replace("/\\[.+\\]/m","", $arProject["post_content"]);
                                        echo str_replace("\n","<br>", $arProject["post_content"]);
                                        ?>
                                    </p>
                                    <!--<blockquote class=" blog-image"
                                                style=" background: none repeat scroll 0 0 #f6f6f6;"><p></p>
                                        <p>Reading is not only informed by what’s going on with us at that moment, but
                                            also governed by how our eyes and brains work to process information. What
                                            you see and what you’re experiencing as you read these words is quite
                                            different.</p>
                                        <p></p>
                                        <footer>Jason Santa Maria</footer>
                                    </blockquote>-->


                                </div>
                            </div>
                        </section>
                    </div>
                    <section class="padding-top-40px no-padding-bottom clear-both">
                        <div class="container">
                            <div class="row">
                                <div class="col-md-12 col-sm-12 text-center no-padding">
                                    <div class="blog-date no-padding-top">
                                        <?php
                                        $arPostTags = wp_get_post_tags($arProject["ID"]);
                                        unset($arPostTagsNames);
                                        foreach ($arPostTags as $keyTag => $tag) {
                                            $postTagId = $tag->term_id;
                                            $arPostTagsNames[] = $tag->name;

                                        }

                                        echo implode(" | ", $arPostTagsNames);
                                        ?>

                                    </div>
                                </div>
                            </div>
                        </div>
                    </section>
                </div>
                <section class="no-padding">
                    <div class="container">
                        <div class="row">
                            <div
                                    class="text-center padding-four-top padding-four-bottom col-md-12
                                col-sm-12 col-xs-12 no-padding-lr">



                            </div>
                        </div>
                    </div>
                </section>
            </div>
            <div class="col-md-3 col-sm-4 col-xs-12 col-md-offset-1 xs-margin-top-seven sidebar pull-right">

                <div id="categories-6" class="widget widget_categories">
                    <h5 class="widget-title font-alt">
                        Разделы
                    </h5>
                    <div class="thin-separator-line bg-dark-gray no-margin-lr"></div>
                    <ul>

                        <?php
                        include $_SERVER['DOCUMENT_ROOT'] . '/includes/portfolio_grid_gallery.php';
                        ?>

                        <?php
                        $bestProjectsCount = 0;
                        $firstProjectsCount = 0;
                        $episodicProjectsCount = 0;

                        foreach ($posts as $post) {

                            $private = get_post_meta($post->ID, 'PRIVATE');

                            //?mode=private
                            if ((!isset($_SESSION["mode"]) || ($_SESSION["mode"] != "private")) &&
                                ($private[0] == "1")
                            ) {
                                continue;
                            }

                            setup_postdata($post);

                            $arPostTags = wp_get_post_tags($post->ID);


                            if (in_array_field(PORTFOLIO_WP_BEST_PROJECTS_LABEL_ID, 'term_id', $arPostTags)) {
                                $bestProjectsCount++;
                            }

                            if (in_array_field(PORTFOLIO_WP_FIRST_PROJECT_LABEL_ID, 'term_id', $arPostTags)) {
                                $firstProjectsCount++;
                            }

                            if (in_array_field(PORTFOLIO_WP_EPISODIC_PARTICIPATION_LABEL_ID, 'term_id', $arPostTags)) {
                                $episodicProjectsCount++;
                            }

                        }
                        ?>


                        <li class="cat-item widget-category-list light-gray-text cat-item-16"><a
                                    href="/projects/best/">
                                Лучшие проекты
                            </a> <span class="light-gray-text">/ <?php echo $bestProjectsCount; ?></span></li>

                        <li class="cat-item widget-category-list light-gray-text cat-item-16"><a
                                    href="/projects/first/">
                                Одни из первых проектов
                            </a> <span class="light-gray-text">/ <?php echo $firstProjectsCount; ?></span></li>

                        <li class="cat-item widget-category-list light-gray-text cat-item-16"><a
                                    href="/projects/episodic/">
                                Эпизодическое участие
                            </a> <span class="light-gray-text">/ <?php echo $episodicProjectsCount; ?></span></li>



                    </ul>
                </div>



                <div id="hcode_recent_widget-14" class="widget widget_hcode_recent_widget"><h5
                            class="widget-title font-alt">Другие проекты</h5>
                    <div class="thin-separator-line bg-dark-gray no-margin-lr"></div>
                    <div class="widget-body">
                        <ul class="widget-posts">


                            <?php
                            foreach ($posts as $keyPost => $post) {

                                $private = get_post_meta($post->ID, 'PRIVATE');

                                //?mode=private
                                if ((!isset($_SESSION["mode"]) || ($_SESSION["mode"] != "private")) &&
                                    ($private[0] == "1")
                                ) {
                                    continue;
                                }

                                setup_postdata($post);

                                //$arPostTags = wp_get_post_tags($post->ID);

                                $arPostTagsWidget = wp_get_post_tags($post->ID);
                                unset($arPostTagsNamesWidget);
                                foreach ($arPostTagsWidget as $keyTag => $tag) {
                                    //$postTagId = $tag->term_id;
                                    $arPostTagsNamesWidget[] = $tag->name;

                                }


                                $thumb_id = get_post_thumbnail_id($post->ID);
                                $thumb_url = wp_get_attachment_image_src($thumb_id, 'thumbnail',
                                    false);

                                $thumb_url[0] = str_replace(get_site_url(),
                                    PORTFOLIO_WP_URL,
                                    $thumb_url[0]);


                                $thumb_url_medium = wp_get_attachment_image_src($thumb_id, 'medium',
                                    false);

                                $thumb_url_medium[0] = str_replace(get_site_url(),
                                    PORTFOLIO_WP_URL,
                                    $thumb_url_medium[0]);


                                $thumb_url_full = wp_get_attachment_image_src($thumb_id, 'full',
                                    false);

                                $thumb_url_full[0] = str_replace(get_site_url(),
                                    PORTFOLIO_WP_URL,
                                    $thumb_url_full[0]);

                                ?>




                                <li class="clearfix">
                                    <a
                                            href="<?php echo $_SERVER["SCRIPT_NAME"]. "?ID=" . $post->ID; ?>">
                                        <img
                                                width="767" height="767"
                                                src="<?php echo $thumb_url[0]; ?>"
                                                class="attachment-full size-full wp-post-image" alt=""
                                                srcset="<?php echo $thumb_url_full[0]; ?> 767w, <?php echo $thumb_url[0]; ?> 150w, <?php echo $thumb_url_medium[0]; ?> 300w"
                                                sizes="(max-width: 767px) 100vw, 767px"/></a>
                                    <div class="widget-posts-details"><a
                                                href="<?php echo $_SERVER["SCRIPT_NAME"]. "?ID=" . $post->ID; ?>">
                                            <?php echo $post->post_title; ?>
                                        </a>
                                        <?php echo implode(" , ", $arPostTagsNamesWidget); ?>

                                    </div>
                                </li>


                                <?php
                                if($keyPost == 5) break;

                            }
                            ?>




                        </ul>
                    </div>
                </div>
                <div id="tag_cloud-4" class="widget widget_tag_cloud">
                    <h5 class="widget-title font-alt">
                        Тэги
                    </h5>
                    <div class="thin-separator-line bg-dark-gray no-margin-lr"></div>
                    <div class="tagcloud">
                        <div class="tags_cloud tags">


                            <?php
                            foreach($arPostTagsNames as $tagName) {
                                ?>

                                <a href='#'

                                   class='tag-link-84 tag-link-position-1'
                                   title=''

                                   style='font-size: 22pt;'>
                                    <?php echo $tagName; ?>
                                </a>

                                <?php
                            }
                            ?>


                        </div>
                    </div>
                </div>
                <div id="hcode_recent_comment_widget-9" class="widget widget_hcode_recent_comment_widget">
                    <div class="widget">
                        <h5 class="widget-title font-alt">Новые проекты</h5>

                        <div class="thin-separator-line bg-dark-gray no-margin-lr"></div>
                        <div class="widget-body">
                            <ul class="widget-posts">

                                <?php
                                foreach($arNewProjects as $newProjectID) {
                                    $private = get_post_meta($newProjectID, 'PRIVATE');

                                    //?mode=private
                                    if ((!isset($_SESSION["mode"]) || ($_SESSION["mode"] != "private")) &&
                                        ($private[0] == "1")
                                    ) {
                                        continue;
                                    }

                                    if($newProjectID == $_GET["ID"]) continue;

                                    $arNewProject = get_post( $newProjectID, ARRAY_A);

                                    ?>

                                    <li class="clearfix">
                                        <div class="widget-posts-details">
                                            <a class="author"

                                               href="<?php echo $_SERVER["SCRIPT_NAME"]. "?ID=" . $newProjectID; ?>">
                                                <?php echo $arNewProject["post_title"]; ?>
                                            </a>
                                        </div>
                                    </li>

                                    <?php
                                }
                                ?>




                            </ul>
                        </div>
                    </div>
                </div>
                <div id="text-8" class="widget widget_text">
                    <h5 class="widget-title font-alt">Случайный текст</h5>

                    <div class="thin-separator-line bg-dark-gray no-margin-lr"></div>
                    <div class="textwidget">
                        <?php echo $currentDetailTitle[0]; ?>
                    </div>
                </div>

            </div>
        </div>
    </div>
</section>
<div class="wpb_column hcode-column-container col-md-12 no-padding">
    <div class="hcode-divider border-top sm-padding-five-top xs-padding-five-top padding-five-bottom"></div>
</div>
<section class="clear-both no-padding-top">
    <div class="container">
        <div class="row">
            <div class="col-md-12 col-sm-12 text-center">
                <h3 class="section-title">Реализованные проекты</h3>
            </div>
            <div class="work-3col gutter work-with-title ipad-3col">
                <div class="col-md-12 grid-gallery overflow-hidden content-section">
                    <div class="tab-content">
                        <ul class="grid masonry-items">

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

                                ?>


                                <li class="portfolio-id-<?php echo $post->ID;?>
                                post-<?php echo $post->ID;?> portfolio type-portfolio status-publish
                            format-image has-post-thumbnail hentry portfolio-category-jquery
                            portfolio-category-wordpress portfolio-tags-portfolio-abstract">
                                    <figure>
                                        <div class="gallery-img">
                                            <a
                                                    href="<?php echo $_SERVER["SCRIPT_NAME"]. "?ID=" . $post->ID; ?>">
                                                <img
                                                        src="" class="js-img"
                                                        data-image="<?php echo $thumb_url_full[0]; ?>"
                                                        width="374" height="234" alt=""/></a></div>
                                        <figcaption>
                                            <h3 class="entry-title">
                                                <a
                                                        href="<?php echo $_SERVER["SCRIPT_NAME"]. "?ID=" . $post->ID; ?>">
                                                    <?php echo $post->post_title; ?>
                                                </a>
                                            </h3>
                                            <p><?php echo implode(" , ", $arPostTagsNamesWidget); ?></p>
                                        </figcaption>
                                    </figure>
                                </li>


                                <?php
                                if($i == 2) break;
                                $i++;
                            }
                            ?>





                        </ul>
                    </div>
                </div>
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
