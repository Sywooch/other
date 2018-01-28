<?php
/**
 * Created by PhpStorm.
 * User: GSU
 * Date: 23.07.2017
 * Time: 22:29
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
    class="portfolio-template-default single single-portfolio postid-15439 single-format-standard
    wpb-js-composer js-comp-ver-5.1 vc_responsive">
<?php
include $_SERVER['DOCUMENT_ROOT'] . '/includes/head_white_menu_logo.php';
?>


<section class="content-top-margin page-title-section page-title border-bottom-light border-top-light bg-white">
    <div class="container">
        <div class="row">
            <div class="col-lg-8 col-md-7 col-sm-12 slideInUp wow fadeInUp" data-wow-duration="300ms"><h1
                    class="black-text"><?php echo $arProject["post_title"];?></h1>
                <div
                    class="separator-line margin-three bg-black no-margin-lr sm-margin-top-three sm-margin-bottom-three no-margin-bottom xs-display-none"></div>
            </div>
            <div
                class="col-lg-4 col-md-5 col-sm-12 breadcrumb text-uppercase sm-no-margin-top wow fadeInUp xs-display-none"
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
    class=" post-15439 portfolio type-portfolio status-publish format-standard has-post-thumbnail hentry portfolio-category-masonry2">
    <div class="container col2-layout">
        <div class="row">
            <div class="col-md-8 col-sm-8 col-xs-12">
                <section class="no-padding">
                    <div class="container">
                        <div class="row">
                            <div class="gallery-img margin-bottom-30px"><img
                                    src="http://wpdemos.themezaa.com/h-code/wp-content/uploads/2015/08/portfolio-img44.jpg"
                                    width="800" height="500" alt=""></div>
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
                    <?php
                    include $_SERVER['DOCUMENT_ROOT'] . '/includes/head_post_tags.php';
                    ?>

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

            <?php
            include $_SERVER['DOCUMENT_ROOT'] . '/includes/detail_sidebar_pull-right.php';
            ?>

        </div>
    </div>
</section>
<div class="wpb_column hcode-column-container col-md-12 no-padding">
    <div class="hcode-divider border-top sm-padding-five-top xs-padding-five-top padding-five-bottom"></div>
</div>
<section class="clear-both no-padding-top">
    <div class="container">
        <div class="row">
            <div class="col-md-12 col-sm-12 text-center"><h3 class="section-title">Реализованные проекты</h3></div>
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


                            <li class="portfolio-id-<?php echo $post->ID;?> post-<?php echo $post->ID;?>
                            portfolio type-portfolio status-publish format-standard has-post-thumbnail
                            hentry portfolio-category-masonry2">
                                <figure>
                                    <div class="gallery-img">
                                        <a
                                            href="<?php echo $_SERVER["SCRIPT_NAME"]. "?ID=" . $post->ID; ?>">
                                            <img
                                                    src="" class="js-img"
                                                    data-image="<?php echo $thumb_url_full[0]; ?>"
                                                    width="374" height="234" alt=""/>
                                        </a>
                                    </div>
                                    <figcaption><h3 class="entry-title"><a
                                                href="<?php echo $_SERVER["SCRIPT_NAME"]. "?ID=" . $post->ID; ?>">
                                                <?php echo $post->post_title; ?></a></h3>
                                        <p><?php echo implode(" , ", $arPostTagsNamesWidget); ?></p></figcaption>
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
