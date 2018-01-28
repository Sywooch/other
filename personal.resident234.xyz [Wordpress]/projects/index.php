<?php
/**
 * Created by PhpStorm.
 * User: GSU
 * Date: 25.06.2017
 * Time: 0:42
 */


require $_SERVER['DOCUMENT_ROOT'] . '/wp-load.php';

include $_SERVER['DOCUMENT_ROOT'] . '/includes/head.php';


?>


<!DOCTYPE html>
<html lang="en-US" class="no-js">
<head>

    <?php
    include $_SERVER['DOCUMENT_ROOT'] . '/includes/head_css.php';
    include $_SERVER['DOCUMENT_ROOT'] . '/includes/head_custom_css.php';
    include $_SERVER['DOCUMENT_ROOT'] . '/includes/head_main.php';
    ?>
<!-- CSS_ADSBLOCK_START -->
    <link rel="stylesheet" href="http://adblockers.opera-mini.net/css_block/default-domainless.css" type="text/css"/>
    <!-- CSS_ADSBLOCK_END -->
</head>
<body class="page-template-default page page-id-71 wpb-js-composer js-comp-ver-5.1 vc_responsive">
<nav
    class="navbar navbar-default navbar-fixed-top nav-transparent overlay-nav sticky-nav
    transparent-header nav-border-bottom  nav-white "
    data-menu-hover-delay="100">
    <div class="container">
        <div class="row">


            <?php
            include $_SERVER['DOCUMENT_ROOT'] . "/includes/head_logo.php";
            ?>

            <div class="navbar-header col-sm-8 sm-width-auto col-xs-2 pull-right">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse"><span
                        class="sr-only">Toggle navigation</span> <span class="icon-bar"></span> <span
                        class="icon-bar"></span> <span class="icon-bar"></span></button>
            </div>
            <div class="col-md-8 no-padding-right accordion-menu text-right">
                <div id="mega-menu" class="navbar-collapse collapse navbar-right">
                    <?php
                    include $_SERVER['DOCUMENT_ROOT'] . '/includes/main_menu.php';
                    ?>
                </div>
            </div>
        </div>
    </div>
</nav>
<?php
global $wpdb;
$wpdb->set_prefix('portfolio_');

$categoryId = PORTFOLIO_WP_STOCK_FOTOS_ID;

$args = array(
    'numberposts' => 1,
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

//unset($arSkills);
foreach ($posts as $post) {
    setup_postdata($post);

    $currentBackgroundImage[] = $post->post_title;

}

//js-backgroud
wp_reset_postdata();
?>
<section class="page-title parallax3 parallax-fix page-title-large">
    <img class="parallax-background-img "

         src="<?php echo $currentBackgroundImage[0]; ?>"
         data-image="<?php echo $currentBackgroundImage[0]; ?>"

         alt="Portfolio"/>
    <div class="opacity-medium bg-black"></div>
    <div class="container">
        <div class="row">
            <div class="col-md-12 col-sm-12 text-center animated fadeInUp">
                <div class="separator-line bg-yellow no-margin-top margin-four"></div>
                <h1 class="white-text">Портфолио</h1>
                <span class="white-text">Список проектов</span>
            </div>
        </div>
    </div>
</section>
<section class="parent-section no-padding post-71 page type-page status-publish hentry">
    <div class="container">
        <div class="row"><h2 class="entry-title display-none">Портфолио</h2>
            <div class="entry-content">
                <section>
                    <div class="container">
                        <div class="row">
                            <div class="wpb_column hcode-column-container  col-xs-mobile-fullwidth">
                                <div class="vc-column-innner-wrapper">
                                    <div class="col-md-12 text-center">
                                        <div class="text-center">
                                            <ul class="portfolio-filter nav nav-tabs nav-tabs-gray wow fadeInUp">

                                                <?php
                                                include $_SERVER['DOCUMENT_ROOT'] . '/includes/portfolio_filter.php';
                                                ?>

                                            </ul>
                                        </div>
                                    </div>
                                    <div class="work-4col  ">
                                        <div class="col-md-12  grid-gallery overflow-hidden  content-section">
                                            <div class="tab-content">
                                                <ul class="grid masonry-items ">


                                                    <?php
                                                    include $_SERVER['DOCUMENT_ROOT'] . '/includes/portfolio_grid_gallery.php';
                                                    ?>

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
                                                            <div class="gallery-img"><a
                                                                    href="/detail/<?php echo $arDetailTemplates[wp_rand(0, count($arDetailTemplates) - 1)]; ?>?ID=<?php echo $post->ID; ?>"
                                                                    class="" target=""><img alt=""
                                                                                            data-image="<?php echo $thumb_url[0]; ?>"
                                                                                            src="<?php echo $thumb_url_medium[0]; ?>"
                                                                                            width="800"
                                                                                            height="500"
                                                                    class="js-img"/></a></div>
                                                            <figcaption><h3><a
                                                                        href="/detail/<?php echo $arDetailTemplates[wp_rand(0, count($arDetailTemplates) - 1)]; ?>?ID=<?php echo $post->ID; ?>"
                                                                        class="" target=""><?php echo $post->post_title; ?></a></h3>
                                                                <p></p></figcaption>
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


                <?php
                include $_SERVER['DOCUMENT_ROOT'] . "/includes/feedback_project.php";
                ?>

            </div>
        </div>
    </div>
</section>
<footer class="bg-light-gray2">


    <?php
    include $_SERVER['DOCUMENT_ROOT'] . "/includes/footer_menu_bg-white.php";
    ?>



    <a class="scrollToTop" href="javascript:void(0);"> <i class="fa fa-angle-up"></i> </a>
</footer>


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

