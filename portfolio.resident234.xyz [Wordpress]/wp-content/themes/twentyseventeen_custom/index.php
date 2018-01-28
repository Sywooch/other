<?php
/**
 * The main template file
 *
 * This is the most generic template file in a WordPress theme
 * and one of the two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query.
 * E.g., it puts together the home page when no home.php file exists.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package WordPress
 * @subpackage Twenty_Seventeen
 * @since 1.0
 * @version 1.0
 */

//get_header();
/*?>

<div class="wrap">
	<?php if ( is_home() && ! is_front_page() ) : ?>
		<header class="page-header">
			<h1 class="page-title"><?php single_post_title(); ?></h1>
		</header>
	<?php else : ?>
	<header class="page-header">
		<h2 class="page-title"><?php _e( 'Posts', 'twentyseventeen' ); ?></h2>
	</header>
	<?php endif; ?>

	<div id="primary" class="content-area">
		<main id="main" class="site-main" role="main">

			<?php
			if ( have_posts() ) :


				while ( have_posts() ) : the_post();


					get_template_part( 'template-parts/post/content', get_post_format() );

				endwhile;

				the_posts_pagination( array(
					'prev_text' => twentyseventeen_get_svg( array( 'icon' => 'arrow-left' ) ) . '<span class="screen-reader-text">' . __( 'Previous page', 'twentyseventeen' ) . '</span>',
					'next_text' => '<span class="screen-reader-text">' . __( 'Next page', 'twentyseventeen' ) . '</span>' . twentyseventeen_get_svg( array( 'icon' => 'arrow-right' ) ),
					'before_page_number' => '<span class="meta-nav screen-reader-text">' . __( 'Page', 'twentyseventeen' ) . ' </span>',
				) );

			else :

				get_template_part( 'template-parts/post/content', 'none' );

			endif;
			?>

		</main><!-- #main -->
	</div><!-- #primary -->
	<?php get_sidebar(); ?>
</div><!-- .wrap -->

<?php get_footer();*/
require $_SERVER['DOCUMENT_ROOT'] . '/wp-load.php';


if($_GET["mode"] == "private"){
    //if(!isset($_SESSION["mode"])){
        $_SESSION["mode"] = "private";
        header('Location: /');
    //}
}else{
    if(!isset($_SESSION["mode"])) {
        $_SESSION["mode"] = "public";
    }
}

?>

<!DOCTYPE HTML>
<html lang="en-US">
<head>
    <meta charset="UTF-8">
    <title>Гладышев Сергей Юрьевич, web-программист. Персональный сайт-портфолио</title>
    <script type="text/javascript">
        //<![CDATA[
        try {
            if (!window.CloudFlare) {
                var CloudFlare = [{
                    verbose: 0,
                    p: 0,
                    byc: 0,
                    owlid: "cf",
                    bag2: 1,
                    mirage2: 0,
                    oracle: 0,
                    paths: {cloudflare: "/cdn-cgi/nexp/dok3v=1613a3a185/"},
                    atok: "f918541e18e22df0711d6671c6a0db8f",
                    petok: "86a9f8cd8c695a96745a321593878709b72b61c2-1488972814-1800",
                    zone: "template-help.com",
                    rocket: "0",
                    apps: {"abetterbrowser": {"ie": "7"}}
                }];
                !function (a, b) {
                    a = document.createElement("script"), b = document.getElementsByTagName("script")[0], a.async = !0, a.src = "//ajax.cloudflare.com/cdn-cgi/nexp/dok3v=f2befc48d1/cloudflare.min.js", b.parentNode.insertBefore(a, b)
                }()
            }
        } catch (e) {
        }
        ;
        //]]>
    </script>
    <link rel="icon" href="img/favicon.ico" type="image/x-icon">
    <link rel="shortcut icon" href="img/favicon.ico" type="image/x-icon"/>
    <meta name="description" content="Гладышев Сергей Юрьевич, web-программист, персональный сайт-портфолио">
    <meta name="keywords" content="Гладышев Сергей Юрьевич, web-программист, персональный сайт-портфолио">
    <meta name="author" content="Гладышев Сергей Юрьевич">
    <link rel="stylesheet" href="css/bootstrap.css">
    <link rel="stylesheet" href="css/style.css">
    <script type="text/javascript" src="js/jquery.js"></script>
    <script type="text/javascript" src="js/device.js"></script>
    <script type="text/javascript" src="js/bootstrap.js"></script>
    <script type="text/javascript" src="js/core.js"></script>
    <script type="text/javascript" src="js/script.js"></script>
    <!--[if lt IE 9]>
    <div style='text-align:center'><a
        href="https://windows.microsoft.com/en-US/internet-explorer/products/ie/home?ocid=ie6_countdown_bannercode"><img
        src="https://storage.ie6countdown.com/assets/100/images/banners/warning_bar_0000_us.jpg" border="0" height="42"
        width="820"
        alt="You are using an outdated browser. For a faster, safer browsing experience, upgrade for free today."/></a>
    </div>
    <![endif]-->



    <!----DETAIL----https://livedemo00.template-help.com---->
    <?php  ?>
    <link href='https://fonts.googleapis.com/css?family=Oswald:300,400' rel='stylesheet' type='text/css'>
    <link href='https://fonts.googleapis.com/css?family=Dorsa' rel='stylesheet' type='text/css'>
    <!--[if IE 8]>
    <link rel="stylesheet" href="/detail/css/ie.css" />
    <![endif]-->

    <link rel="stylesheet" href="/detail/css/bootstrap.css" type="text/css"/>
    <link rel="stylesheet" href="/detail/css/default.css" type="text/css"/>
    <link rel="stylesheet" href="/detail/css/template.css" type="text/css"/>
    <link rel="stylesheet" href="/detail/css/touch.gallery.css" type="text/css"/>
    <link rel="stylesheet" href="/detail/css/responsive.css" type="text/css"/>
    <link rel="stylesheet" href="/detail/css/superfish.css" type="text/css"/>
    <link rel="stylesheet" href="/detail/css/superfish-navbar.css" type="text/css"/>
    <link rel="stylesheet" href="/detail/css/superfish-vertical.css" type="text/css"/>
    <link rel="stylesheet" href="/detail/css/camera.css" type="text/css"/>

    <?php /* ?>
    <script src="/detail/js/mootools-core.js" type="text/javascript"></script>
    <script src="/detail/js/core.js" type="text/javascript"></script>
    <script src="/detail/js/caption.js" type="text/javascript"></script>
    <!--<script src="/detail/js/jquery.min.js" type="text/javascript"></script>-->
    <!--<script src="/detail/js/bootstrap.js" type="text/javascript"></script>-->
    <script src="/detail/js/jquery.easing.1.3.js" type="text/javascript"></script>
    <script src="/detail/js/jquery.isotope.min.js" type="text/javascript"></script>
    <script src="/detail/js/touch.gallery.js" type="text/javascript"></script>
    <script src="/detail/js/scripts.js" type="text/javascript"></script>
    <script src="/detail/js/superfish.js" type="text/javascript"></script>
    <script src="/detail/js/jquery.mobilemenu.js" type="text/javascript"></script>
    <script src="/detail/js/jquery.hoverIntent.js" type="text/javascript"></script>
    <script src="/detail/js/supersubs.js" type="text/javascript"></script>
    <script src="/detail/js/sftouchscreen.js" type="text/javascript"></script>
    <script src="/detail/js/camera.js" type="text/javascript"></script>
    <script src="/detail/js/jquery.easing.1.3.js" type="text/javascript"></script>
    <script src="/detail/js/jquery.mobile.customized.min.js" type="text/javascript"></script>
    <!--
       <script type="text/javascript">
           window.addEvent('load', function() {
               new JCaption('img.caption');
           });
           jQuery.noConflict()
       </script>-->
    <?php  ?>
 <?php */ ?>

    <!----DETAIL-------->


    <!-- Yandex.Metrika counter -->
    <script type="text/javascript">
        (function (d, w, c) {
            (w[c] = w[c] || []).push(function() {
                try {
                    w.yaCounter44711110 = new Ya.Metrika({
                        id:44711110,
                        clickmap:true,
                        trackLinks:true,
                        accurateTrackBounce:true,
                        webvisor:true,
                        trackHash:true
                    });
                } catch(e) { }
            });

            var n = d.getElementsByTagName("script")[0],
                s = d.createElement("script"),
                f = function () { n.parentNode.insertBefore(s, n); };
            s.type = "text/javascript";
            s.async = true;
            s.src = "https://mc.yandex.ru/metrika/watch.js";

            if (w.opera == "[object Opera]") {
                d.addEventListener("DOMContentLoaded", f, false);
            } else { f(); }
        })(document, window, "yandex_metrika_callbacks");
    </script>
    <noscript><div><img src="https://mc.yandex.ru/watch/44711110" style="position:absolute; left:-9999px;" alt="" /></div></noscript>
    <!-- /Yandex.Metrika counter -->


</head>
<body>
<div id="webSiteLoader"></div>
<div id="glob-wrap">
    <header>
        <div class="container">
            <div class="row">
                <div class="col-lg-12 tac">

                    <nav id="mainNav" class="mainNav hideMenu" data-follow="location" data-type="navigation">
                        <ul>
                            <li><a href="./"></a>главная</li>
                            <li><a href="./projects">проекты</a></li>
                            <li><a href="./sertificates">сертификаты</a>
                                <?php /* ?>
                                <div class="sf-mega">
                                    <ul>
                                        <li><a href="./readmore.html">history</a></li>
                                        <li><a href="./readmore.html">news</a></li>
                                        <li class="last"><a href="./readmore.html">awards</a></li>
                                    </ul>
                                </div>
                                <?php */ ?>
                            </li>
                            <li><a href="./skills">навыки</a></li>
                            <li><a href="./experience">опыт работы</a></li>
                            <!--<li><a href="./links">ссылки</a></li>
                            <li><a href="./resume">основные сведения</a></li>-->
                            <li><a href="./contacts">контакты</a></li>
                        </ul>
                    </nav>

                    <?php /* ?>
                    <ul class="follow-links">
                        <li><a href="#"><i class="fa-facebook"></i></a></li>
                        <li><a href="#"><i class="fa-google-plus"></i></a></li>
                        <li><a href="#"><i class="fa-twitter-square"></i></a></li>
                    </ul>
                    <?php */ ?>

                    <div class="clear"></div>
                </div>
            </div>
        </div>
    </header>
    <article id="content" data-follow="location" data-type="switcher" data-behavior="scroll" class=''>
        <div data-id="" id="page1" class=''><!--img/pexels-photo-177598.jpeg-->
            <img src="img/48964.88456-programacao.jpg" alt="" class='p1_pic1'>
            <div class="bgHolder">
                <div class="bg1"></div>
                <div class="container">
                    <div class="row">
                        <div class="col-lg-12 col-lg-offset-0 col-md-12 col-md-offset-0 col-sm-12 col-xs-12 ">
                            <div class="slogans">
                                <p class="p1">Персональный сайт-портфолио</p>
                                <p class="p2">Гладышев</p>
                                <div class="extra-wrap">
                                    <div class="slogan_block_1">
                                        <p class="s_p">
                                            <span class="s_p1">web - программист</span>
                                            <br>
                                            <span class="s_p2">full - stack</span>
                                        </p>
                                    </div>
                                    <p class="p3">Сергей</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>





        <div data-id="projects" id="page2" class=''>
            <div class="bgHolder">
                <div class="bg2"></div>
            </div>
            <div class="container">
                <div class="row mar_t_117">
                    <div class="col-lg-12 col-lg-offset-0 col-md-12 col-md-offset-0 col-sm-12 col-xs-12 ">
                        <h2>Список проектов</h2>


                        <?php
                        //собрать случайные цвета
                        $categoryId = WP_CATEGORY_SKILLS_RANDOM_COLORS_ID;
                        unset($arRandomColors);


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
                            'suppress_filters' => true, // подавление работы фильтров изменения SQL запроса
                        );



                        $posts = get_posts($args);
                        foreach ($posts as $post) {
                            setup_postdata($post);
                            $arRandomColors[] = $post->post_title;

                        }

                        wp_reset_postdata();
                        ?>

                        <?php
                        //собрать список навыков.
                        //имя, картинка, цвет категории
                        $categoryId = WP_CATEGORY_SKILLS_ID;

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
                            'suppress_filters' => true, // подавление работы фильтров изменения SQL запроса
                        );

                        $posts = get_posts($args);

                        unset($arSkills);
                        foreach ($posts as $post) {
                            setup_postdata($post);
                            $idImage = get_post_thumbnail_id($post->ID);
                            $image_attributes = wp_get_attachment_image_src($idImage);
                            //echo $image_attributes[0];
                            $arSkills[$post->post_title]["image"] = $image_attributes[0];
                            $cat = get_the_category($post->ID);
                            $categoryDescription = $cat[0]->description;
                            $arCategoryDescription = explode(":", $categoryDescription);
                            $categoryColor = $arCategoryDescription[0];
                            $arSkills[$post->post_title]["color"] = $categoryColor;

                        }



                        wp_reset_postdata();
                        ?>

                        <div class="car_div mar_t_2 desktop-only">
                            <div id="owl1" class="owl1">


                                <?php
                                $categoryId = WP_CATEGORY_PROJECTS_ID;




                                $args = array(
                                    'numberposts' => 1000,
                                    'category' => $categoryId,
                                    'orderby' => 'meta_value_num',//meta_value_ORDER
                                    'order' => 'ASC',
                                    'include' => array(),
                                    'exclude' => array(),
                                    'meta_key' => 'ORDER',
                                    'meta_value' => '',
                                    'post_type' => 'post',
                                    'suppress_filters' => true, // подавление работы фильтров изменения SQL запроса
                                    /*'meta_query'	=> array(
                                        array(
                                            'key'	  	=> 'PRIVATE ',
                                            'value'	  	=> '1',
                                            'compare' 	=> 'NOT IN',
                                        ),
                                    ), */
                                ); 

                                $posts = get_posts($args);
                                $i = 1;

                                ?>

                                <?php
                                //echo "<pre>";
                                //print_r($posts);
                                //echo "</pre>";
                                ?>

                                <div class="item active">

                                    <?php
                                    foreach ($posts as $post){

                                    $private = get_post_meta($post->ID, 'PRIVATE');

                                    //?mode=private
                                    if((!isset($_SESSION["mode"]) || ($_SESSION["mode"] != "private")) &&
                                        ($private[0] == "1")) continue;

                                    setup_postdata($post);

                                    ?>

                                    <?php
                                    $thumb_id = get_post_thumbnail_id($post->ID);
                                    $thumb_url = wp_get_attachment_image_src($thumb_id, 'full', false);


                                    $arRandomColorNumber = mt_rand(0, count($arRandomColors) - 1);
                                    $randomColor = $arRandomColors[$arRandomColorNumber];

                                    ?>


                                    <div class="box <?php if ($i % 2 == 0) { ?>mar_t_01<? } ?>"
                                         style="background-color:<?php echo $randomColor; ?>">
                                        <div class="circ">
                                            <span><?php echo $post->post_title; ?></span>
                                            <!--<div class="pic_icone"></div>-->
                                            <div class="project_skills skills">

                                                <?php

                                                $arPostTags = wp_get_post_tags($post->ID);
                                                //print_r($arPostTags);
                                                foreach ($arPostTags as $keyTag => $tag) {
                                                    $postTagId = $tag->term_id;
                                                    $postTagName = $tag->name;

                                                    //echo $postTagName;



                                                    ?>

                                                    <span class="color_base
								label_php" style="background-color:<?php echo $arSkills[$postTagName]["color"]; ?>;
								color:#fff;
								background-image:url(<?php echo $arSkills[$postTagName]["image"]; ?>);"
                                                    title="<?php echo $postTagName; ?>">
								</span>

                                                    <?php
                                                }
                                                ?>





                                            </div>



                                        </div>
                                        <a href="./detail.php?id=<?php echo $post->ID; ?>" data-image="1" class="">
                                            <img src="<?php echo $thumb_url[0]; ?>" alt="">
                                        </a>
                                    </div>


                                    <?php
                                    if ($i % 2 == 0){
                                    ?>

                                </div>
                                <div class="item">

                                    <?php
                                    }

                                    $i++;


                                    ?>


                                    <?php
                                    }
                                    ?>
                                </div>


                                <?php

                                wp_reset_postdata(); // сброс
                                ?>


                            </div>
                        </div>


                        <div class="car_div mar_t_2 mobile-only">
                            <div id="owl2" class="owl2">


                                <?php
                                $categoryId = WP_CATEGORY_PROJECTS_ID;

                                $args = array(
                                    'numberposts' => 1000,
                                    'category' => $categoryId,
                                    'orderby' => 'meta_value_num',//meta_value_ORDER
                                    'order' => 'ASC',
                                    'include' => array(),
                                    'exclude' => array(),
                                    'meta_key' => 'ORDER',
                                    'meta_value' => '',
                                    'post_type' => 'post',
                                    'suppress_filters' => true, // подавление работы фильтров изменения SQL запроса
                                    /*'meta_query'	=> array(
                                        array(
                                            'key'	  	=> 'PRIVATE ',
                                            'value'	  	=> '1',
                                            'compare' 	=> 'NOT IN',
                                        ),
                                    ), */
                                );

                                $posts = get_posts($args);
                                $i = 1;

                                ?>

                                    <?php
                                    foreach ($posts as $post){

                                    $private = get_post_meta($post->ID, 'PRIVATE');

                                    //?mode=private
                                    if((!isset($_SESSION["mode"]) || ($_SESSION["mode"] != "private")) &&
                                        ($private[0] == "1")) continue;

                                    setup_postdata($post);

                                    ?>

                                    <?php
                                    $thumb_id = get_post_thumbnail_id($post->ID);
                                    $thumb_url = wp_get_attachment_image_src($thumb_id, 'full', false);


                                    $arRandomColorNumber = mt_rand(0, count($arRandomColors) - 1);
                                    $randomColor = $arRandomColors[$arRandomColorNumber];

                                    ?>

                                        <div class="item">
                                            <div class="box"
                                                 style="background-color:<?php echo $randomColor; ?>">
                                                <div class="circ">
                                                    <span><?php echo $post->post_title; ?></span>
                                                    
                                                </div>

                                                <div class="project_skills skills">

                                                    <?php

                                                    $arPostTags = wp_get_post_tags($post->ID);
                                                    //print_r($arPostTags);
                                                    foreach ($arPostTags as $keyTag => $tag) {
                                                        $postTagId = $tag->term_id;
                                                        $postTagName = $tag->name;

                                                        //echo $postTagName;



                                                        ?>

                                                        <span class="color_base
								label_php" style="background-color:<?php echo $arSkills[$postTagName]["color"]; ?>;
                                                            color:#fff;
                                                            background-image:url(<?php echo $arSkills[$postTagName]["image"]; ?>);"
                                                              title="<?php echo $postTagName; ?>">
								</span>

                                                        <?php
                                                    }
                                                    ?>


                                                </div>

<!--  -->
                                                <a href="./detail-mobile.php?id=<?php echo $post->ID; ?>"
                                                   data-image="2" class="">
                                                    <?
                                                    $imageSizes = getimagesize ( $thumb_url[0] );

                                                    ?>
                                                    <img
                                                        src="<?php echo $thumb_url[0]; ?>"
                                                        alt=""
                                                        data-img-height="<?php echo $imageSizes[1]; ?>"
                                                        data-img-width="<?php echo $imageSizes[0]; ?>">
                                                </a>
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
            </div>
        </div>





        <div data-id="sertificates" id="page2_1" class=''>
            <div class="bgHolder">
                <div class="bg1"></div>
            </div>
            <div class="container">
                <div class="row mar_t_117">
                    <div class="col-lg-12 col-lg-offset-0 col-md-12 col-md-offset-0 col-sm-12 col-xs-12 ">
                        <h2>Список сертификатов</h2>


                        <div class="car_div mar_t_2 desktop-only">
                            <div id="owl_1" class="owl1 owl1_sertificates"> 


                                <?php
                                $categoryId = WP_CATEGORY_SERTIFICATES_ID;




                                $args = array(
                                    'numberposts' => 1000,
                                    'category' => $categoryId,
                                    'orderby' => 'meta_value_num',//meta_value_ORDER
                                    'order' => 'ASC',
                                    'include' => array(),
                                    'exclude' => array(),
                                    'meta_key' => 'ORDER',
                                    'meta_value' => '',
                                    'post_type' => 'post',
                                    'suppress_filters' => true, // подавление работы фильтров изменения SQL запроса
                                );

                                $posts = get_posts($args);
                                $i = 1;

                                ?>

                                <div class="item active">

                                    <?php
                                    foreach ($posts as $post){
                                    setup_postdata($post);

                                    ?>

                                    <?php
                                    $thumb_id = get_post_thumbnail_id($post->ID);
                                    $thumb_url = wp_get_attachment_image_src($thumb_id, 'full', false);


                                    $arRandomColorNumber = mt_rand(0, count($arRandomColors) - 1);
                                    $randomColor = $arRandomColors[$arRandomColorNumber];

                                    ?>


                                    <div class="box <?php if ($i % 2 == 0) { ?>mar_t_01<? } ?>"
                                         style="background-color:<?php echo $randomColor; ?>">
                                        <div class="circ">
                                            <span><?php echo $post->post_title; ?></span>
                                            <!--<div class="pic_icone"></div>-->
                                            <div class="project_skills skills">

                                                <?php

                                                $arPostTags = wp_get_post_tags($post->ID);
                                                //print_r($arPostTags);
                                                foreach ($arPostTags as $keyTag => $tag) {
                                                    $postTagId = $tag->term_id;
                                                    $postTagName = $tag->name;

                                                    //echo $postTagName;



                                                    ?>

                                                    <span class="color_base
								label_php" style="background-color:<?php echo $arSkills[$postTagName]["color"]; ?>;
                                                        color:#fff;
                                                        background-image:url(<?php echo $arSkills[$postTagName]["image"]; ?>);"
                                                          title="<?php echo $postTagName; ?>">
								</span>

                                                    <?php
                                                }
                                                ?>

                                            </div>

                                            <? if($thumb_url[0]){ ?>
                                            <img src="<?php echo $thumb_url[0]; ?>" alt=""
                                                 class="image_sertificate">
                                            <? } ?>

                                        </div>
                                        <?
                                        $arPostCustom = get_post_custom($post->ID);
                                        preg_match_all('/href="([^"]+)"/', $post->post_content, $links);
                                        $linkToPdf = str_replace(get_site_url(), "", $links[1][0]);

                                        ?>
                                        <a href="http://docs.google.com/viewer?url=<?php echo get_site_url().$linkToPdf; ?>"
                                           data-image="1" class="" target="_blank">
                                            <img src="<?php echo $arPostCustom["PREVIEW_IMAGE"][0]; ?>" alt="">
                                        </a>
                                    </div>


                                    <?php
                                    if ($i % 2 == 0){
                                    ?>

                                </div>
                                <div class="item">

                                    <?php
                                    }

                                    $i++;


                                    ?>


                                    <?php
                                    }
                                    ?>
                                </div>


                                <?php

                                wp_reset_postdata(); // сброс
                                ?>


                            </div>
                        </div>






                        <div class="car_div mar_t_2 mobile-only sertificates">


                            <div id="owl2_1" class="owl2">


                                <?php
                                $categoryId = WP_CATEGORY_SERTIFICATES_ID;




                                $args = array(
                                    'numberposts' => 1000,
                                    'category' => $categoryId,
                                    'orderby' => 'meta_value_num',//meta_value_ORDER
                                    'order' => 'ASC',
                                    'include' => array(),
                                    'exclude' => array(),
                                    'meta_key' => 'ORDER',
                                    'meta_value' => '',
                                    'post_type' => 'post',
                                    'suppress_filters' => true, // подавление работы фильтров изменения SQL запроса
                                );

                                $posts = get_posts($args);
                                $i = 1;

                                ?>



                                    <?php
                                    foreach ($posts as $post){
                                    setup_postdata($post);

                                    ?>
                                    <div class="item active">
                                    <?php
                                    $thumb_id = get_post_thumbnail_id($post->ID);
                                    $thumb_url = wp_get_attachment_image_src($thumb_id, 'full', false);


                                    $arRandomColorNumber = mt_rand(0, count($arRandomColors) - 1);
                                    $randomColor = $arRandomColors[$arRandomColorNumber];

                                    ?>


                                    <div class="box <?php if ($i % 2 == 0) { ?>mar_t_01<? } ?>"
                                         style="background-color:<?php echo $randomColor; ?>">
                                        <div class="circ">
                                            <span><?php echo $post->post_title; ?></span>
                                            <!--<div class="pic_icone"></div>-->
                                            <div class="project_skills skills">

                                                <?php

                                                $arPostTags = wp_get_post_tags($post->ID);
                                                //print_r($arPostTags);
                                                foreach ($arPostTags as $keyTag => $tag) {
                                                    $postTagId = $tag->term_id;
                                                    $postTagName = $tag->name;

                                                    //echo $postTagName;



                                                    ?>

                                                    <span class="color_base
								label_php" style="background-color:<?php echo $arSkills[$postTagName]["color"]; ?>;
                                                        color:#fff;
                                                        background-image:url(<?php echo $arSkills[$postTagName]["image"]; ?>);"
                                                          title="<?php echo $postTagName; ?>">
								</span>

                                                    <?php
                                                }
                                                ?>

                                            </div>

                                            <? if($thumb_url[0]){ ?>
                                                <img src="<?php echo $thumb_url[0]; ?>" alt=""
                                                     class="image_sertificate">
                                            <? } ?>

                                        </div>
                                        <?
                                        $arPostCustom = get_post_custom($post->ID);
                                        preg_match_all('/href="([^"]+)"/', $post->post_content, $links);
                                        $linkToPdf = str_replace(get_site_url(), "", $links[1][0]);

                                        ?>
                                        <a href="http://docs.google.com/viewer?url=<?php echo get_site_url().$linkToPdf; ?>"
                                           data-image="1" class="" target="_blank">
                                            <img src="<?php echo $arPostCustom["PREVIEW_IMAGE"][0]; ?>" alt="">
                                        </a>
                                    </div>




                                    </div>
                                    <?php
                                    }
                                    ?>



                                <?php

                                wp_reset_postdata(); // сброс
                                ?>






                            </div>







                        </div>


                    </div>
                </div>
            </div>
        </div>









        <div data-id="skills" id="page3" class=''>
            <div class="bgHolder">
                <div class="bg3"></div>
            </div>
            <div class="container bg3_color">
                <div class="row mar_t_117">


                    <div class="col-lg-12 col-lg-offset-0 col-md-12 col-md-offset-0 col-sm-12 col-xs-12
					skills">
                        <h2>Навыки</h2>


                        <!--базовые технологии-->
                        <?php
                        $categoryId = WP_CATEGORY_SKILLS_base_ID;

                        $category = get_category($categoryId);
                        $category_description = ($category->category_description);
                        $arCategoryDescription = explode(":", $category_description);

                        ?>
                        <p class="mar_t_3">
                            <?php
                            $args = array(
                                'numberposts' => 1000,
                                'category' => $categoryId,
                                'orderby' => 'meta_value_ORDER',
                                'order' => 'ASC',
                                'include' => array(),
                                'exclude' => array(),
                                'meta_key' => '',
                                'meta_value' => '',
                                'post_type' => 'post',
                                'suppress_filters' => true, // подавление работы фильтров изменения SQL запроса
                            );

                            $posts = get_posts($args);

                            foreach ($posts as $post) {
                                setup_postdata($post);
                                $paddingLeft = get_post_meta($post->ID, 'PADDING_LEFT');

                                ?>

                                <span class="<?php echo $arCategoryDescription[1]; ?>
								<?php echo $post->post_content; ?>"
                                      style="background-color:<?php echo $arCategoryDescription[0]; ?>;
                                          color:<?php echo $arCategoryDescription[2]; ?>;
                                          background-image:url(<?php

                                      $idImage = get_post_thumbnail_id($post->ID);
                                      $image_attributes = wp_get_attachment_image_src($idImage);
                                      echo $image_attributes[0];

                                      ?>); padding-left:<?php echo $paddingLeft[0]; ?>px;">

									<?php

                                    echo $post->post_title;
                                    ?>
								</span>
                                <?php

                            }

                            wp_reset_postdata(); // сброс
                            ?>


                        </p>

                        <?php
                        $categoryId = WP_CATEGORY_SKILLS_backendframework_ID;
                        $category = get_category($categoryId);
                        $category_description = ($category->category_description);
                        $arCategoryDescription = explode(":", $category_description);

                        ?>
                        <p class="mar_t_3">
                            <?php
                            $args = array(
                                'numberposts' => 1000,
                                'category' => $categoryId,
                                'orderby' => 'meta_value_ORDER',
                                'order' => 'ASC',
                                'include' => array(),
                                'exclude' => array(),
                                'meta_key' => '',
                                'meta_value' => '',
                                'post_type' => 'post',
                                'suppress_filters' => true, // подавление работы фильтров изменения SQL запроса
                            );

                            $posts = get_posts($args);

                            foreach ($posts as $post) {
                                setup_postdata($post);
                                $paddingLeft = get_post_meta($post->ID, 'PADDING_LEFT');

                                ?>

                                <span class="<?php echo $arCategoryDescription[1]; ?>
								<?php echo $post->post_content; ?>"
                                      style="background-color:<?php echo $arCategoryDescription[0]; ?>;
                                          color:<?php echo $arCategoryDescription[2]; ?>;
                                          background-image:url(<?php

                                      $idImage = get_post_thumbnail_id($post->ID);
                                      $image_attributes = wp_get_attachment_image_src($idImage);
                                      echo $image_attributes[0];

                                      ?>); padding-left:<?php echo $paddingLeft[0]; ?>px;">

									<?php

                                    echo $post->post_title;
                                    ?>
								</span>
                                <?php

                            }

                            wp_reset_postdata(); // сброс
                            ?>


                        </p>

                        <?php
                        $categoryId = WP_CATEGORY_SKILLS_frontend_ID;
                        $category = get_category($categoryId);
                        $category_description = ($category->category_description);
                        $arCategoryDescription = explode(":", $category_description);

                        ?>
                        <p class="mar_t_3">

                            <?php
                            $args = array(
                                'numberposts' => 1000,
                                'category' => $categoryId,
                                'orderby' => 'meta_value_ORDER',
                                'order' => 'ASC',
                                'include' => array(),
                                'exclude' => array(),
                                'meta_key' => '',
                                'meta_value' => '',
                                'post_type' => 'post',
                                'suppress_filters' => true, // подавление работы фильтров изменения SQL запроса
                            );

                            $posts = get_posts($args);

                            foreach ($posts as $post) {
                                setup_postdata($post);
                                $paddingLeft = get_post_meta($post->ID, 'PADDING_LEFT');

                                ?>

                                <span class="<?php echo $arCategoryDescription[1]; ?>
								<?php echo $post->post_content; ?>"
                                      style="background-color:<?php echo $arCategoryDescription[0]; ?>;
                                          color:<?php echo $arCategoryDescription[2]; ?>;
                                          background-image:url(<?php

                                      $idImage = get_post_thumbnail_id($post->ID);
                                      $image_attributes = wp_get_attachment_image_src($idImage);
                                      echo $image_attributes[0];

                                      ?>); padding-left:<?php echo $paddingLeft[0]; ?>px;">

									<?php

                                    echo $post->post_title;
                                    ?>
								</span>
                                <?php

                            }

                            wp_reset_postdata(); // сброс
                            ?>


                        </p>

                        <?php
                        $categoryId = WP_CATEGORY_SKILLS_cms_ID;
                        $category = get_category($categoryId);
                        $category_description = ($category->category_description);
                        $arCategoryDescription = explode(":", $category_description);

                        ?>
                        <p class="mar_t_3">
                            <?php
                            $args = array(
                                'numberposts' => 1000,
                                'category' => $categoryId,
                                'orderby' => 'meta_value_ORDER',
                                'order' => 'ASC',
                                'include' => array(),
                                'exclude' => array(),
                                'meta_key' => '',
                                'meta_value' => '',
                                'post_type' => 'post',
                                'suppress_filters' => true, // подавление работы фильтров изменения SQL запроса
                            );

                            $posts = get_posts($args);

                            foreach ($posts as $post) {
                                setup_postdata($post);
                                $paddingLeft = get_post_meta($post->ID, 'PADDING_LEFT');

                                ?>

                                <span class="<?php echo $arCategoryDescription[1]; ?>
								<?php echo $post->post_content; ?>"
                                      style="background-color:<?php echo $arCategoryDescription[0]; ?>;
                                          color:<?php echo $arCategoryDescription[2]; ?>;
                                          background-image:url(<?php

                                      $idImage = get_post_thumbnail_id($post->ID);
                                      $image_attributes = wp_get_attachment_image_src($idImage);
                                      echo $image_attributes[0];

                                      ?>); padding-left:<?php echo $paddingLeft[0]; ?>px;">

									<?php

                                    echo $post->post_title;
                                    ?>
								</span>
                                <?php

                            }

                            wp_reset_postdata(); // сброс
                            ?>


                        </p>

                        <?php
                        $categoryId = WP_CATEGORY_SKILLS_tools_ID;
                        $category = get_category($categoryId);
                        $category_description = ($category->category_description);
                        $arCategoryDescription = explode(":", $category_description);

                        ?>
                        <p class="mar_t_3">
                            <?php
                            $args = array(
                                'numberposts' => 1000,
                                'category' => $categoryId,
                                'orderby' => 'meta_value_ORDER',
                                'order' => 'ASC',
                                'include' => array(),
                                'exclude' => array(),
                                'meta_key' => '',
                                'meta_value' => '',
                                'post_type' => 'post',
                                'suppress_filters' => true, // подавление работы фильтров изменения SQL запроса
                            );

                            $posts = get_posts($args);

                            foreach ($posts as $post) {
                                setup_postdata($post);
                                $paddingLeft = get_post_meta($post->ID, 'PADDING_LEFT');

                                ?>

                                <span class="<?php echo $arCategoryDescription[1]; ?>
								<?php echo $post->post_content; ?>"
                                      style="background-color:<?php echo $arCategoryDescription[0]; ?>;
                                          color:<?php echo $arCategoryDescription[2]; ?>;
                                          background-image:url(<?php

                                      $idImage = get_post_thumbnail_id($post->ID);
                                      $image_attributes = wp_get_attachment_image_src($idImage);
                                      echo $image_attributes[0];

                                      ?>); padding-left:<?php echo $paddingLeft[0]; ?>px;">

									<?php

                                    echo $post->post_title;
                                    ?>
								</span>
                                <?php

                            }

                            wp_reset_postdata(); // сброс
                            ?>


                        </p>

                        <?php
                        $categoryId = WP_CATEGORY_SKILLS_environment_ID;
                        $category = get_category($categoryId);
                        $category_description = ($category->category_description);
                        $arCategoryDescription = explode(":", $category_description);

                        ?>
                        <p class="mar_t_3">
                            <?php
                            $args = array(
                                'numberposts' => 1000,
                                'category' => $categoryId,
                                'orderby' => 'meta_value_ORDER',
                                'order' => 'ASC',
                                'include' => array(),
                                'exclude' => array(),
                                'meta_key' => '',
                                'meta_value' => '',
                                'post_type' => 'post',
                                'suppress_filters' => true, // подавление работы фильтров изменения SQL запроса
                            );

                            $posts = get_posts($args);

                            foreach ($posts as $post) {
                                setup_postdata($post);
                                $paddingLeft = get_post_meta($post->ID, 'PADDING_LEFT');

                                ?>

                                <span class="<?php echo $arCategoryDescription[1]; ?>
								<?php echo $post->post_content; ?>"
                                      style="background-color:<?php echo $arCategoryDescription[0]; ?>;
                                          color:<?php echo $arCategoryDescription[2]; ?>;
                                          background-image:url(<?php

                                      $idImage = get_post_thumbnail_id($post->ID);
                                      $image_attributes = wp_get_attachment_image_src($idImage);
                                      echo $image_attributes[0];

                                      ?>); padding-left:<?php echo $paddingLeft[0]; ?>px;">

									<?php

                                    echo $post->post_title;
                                    ?>
								</span>
                                <?php

                            }

                            wp_reset_postdata(); // сброс
                            ?>


                        </p>

                        <p style="margin-bottom:50px;"></p>


                        <!--<div class="poz_rel mar_b_20">
                            <img src="img/p3_pic1.png" alt="" class='p3_pic1 mar_t_3 mob_resize'>
                            <img src="img/p3_pic2.png" alt="" class='p3_pic2 poz_rel_mob mob_resize'>
                        </div>-->


                        <!--<h2>2007-2014</h2>
                        <p class="">Praesent justo dolor, lobortis quis, <a href="./readmore.html" class="">lobortis dignissim</a>, pulvinar aclorem.
                            Koleacene anes hasesera dyule seumaser kertyas edasocis natoqu kyrease visdratasaser stricies phaledatyfena nec sit ams easer erment. Utdolores dapegetel ementumes</p>
                        <p class="mar_t_3">
                            Cerelursus eleifend <a href="./readmore.html" class="">elias neanctor wisiet
                            </a> urliquam erat vpatis. Miastas kertyase fertasbertas Integrum anteulacus uisque nulla.
                        </p>
                        <p class="mar_t_3">
                            <a href="./readmore.html" class="">Fusce euismod</a> consequat ante. Lorem ipsum amet, consectetuer adipiscing elit. Pellentesque sed doloriquam congue fermentum nisl. Mauris accumsan nulla vel diam. Sed in acus ut enim adipiscing aliquet. Nulla venenatin pede mliquet sit amet, euismod in, auctor ut, ligula. Aliquam dapibus tincidunt metus.
                        </p>-->

                    </div>

                    <!--
                    <div class="col-lg-6 col-lg-offset-0 col-md-6 col-md-offset-0 col-sm-12 col-xs-12">
                        <div class="poz_rel mar_b_20">
                            <img src="img/p3_pic3.png" alt="" class='mar_t_3 mar_l_10 p3_pic3 mob_resize'>
                            <img src="img/p3_pic4.png" alt="" class='p3_pic4 poz_rel_mob mob_resize'>
                            <img src="img/p3_pic5.png" alt="" class='p3_pic5 poz_rel_mob mob_resize'>
                        </div>
                        <h2>2000-2007</h2>
                        <p><a href="./readmore.html" class="">Fusce euismod</a> consequat ante. Lorem ipsum amet, consectetuer adipiscing elit. Pellentesque sed doloriquam congue fermentum nisl. Mauris accumsan nulla vel diam. Sed in acus ut enim adipiscing aliquet. Nulla venenatin pede mliquet sit amet, euismod in, auctor ut, ligula. Aliquam dapibus tincidunt metus.
                        </p>
                        <p class="mar_t_3">
                            Praesent justo dolor, <a href="./readmore.html" class="">lobortis quis</a>, lobortis dignissim, pulvinar ac, lorem.
                            Koleacene anes hasesera dyule seumaser kertyas edasocis natoqu kyrease visdratasaser stricies phaledatyfena nec sit ams easer erment. Utdolores dapegetel ementumes.
                        </p>
                        <p class="mar_t_3">
                            Cerelursus eleifend <a href="./readmore.html" class="">elias neanctor wisiet
                            </a> urliquam erat vpatis. Miastas kertyase fertasbertas Integrum anteulacus uisque nulla.
                        </p>
                        <div class="poz_rel mar_b_20">
                            <img src="img/p3_pic6.png" alt="" class='mar_t_3 mar_l_10 p3_pic6 mob_resize '>
                            <img src="img/p3_pic7.png" alt="" class='p3_pic7 poz_rel_mob mob_resize'>
                        </div>
                    </div>
                    -->

                </div>
            </div>
        </div>
        <div data-id="experience" id="page4" class=''>
            <div class="bgHolder">
                <div class="bg4"></div>
            </div>
            <div class="container">


                <div class="row mar_t_117">
                    <div class="col-lg-12">
                        <h2 class="">Опыт работы</h2>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-12 col-lg-offset-0 col-md-12 col-md-offset-0 col-sm-12  col-xs-12 ">
                        <ul class="list_1">
                            <li>
                                <time datetime="">Декабрь 2012 - Июнь 2015</time>
                                <div><a href="#">OOO Retina (Благовещенск)<br>
                                        <span>web-программист</span></a>
                                </div>

                            </li>

                            <li>
                                <time datetime="">Август 2014 - Январь 2016</time>
                                <div><a href="#">Фриланс<br>
                                        <span>web-программист</span></a>
                                </div>

                            </li>

                            <li>
                                <time datetime="">Сентябрь 2015 - Февраль 2016</time>
                                <div><a href="#">DanceLife (Москва, удалённо)<br>
                                        <span>PHP-программист</span></a>
                                </div>

                            </li>

                            <li>
                                <time datetime="">Февраль 2016 - Июль 2016</time>
                                <div><a href="#">LabLend (Хабаровск, удалённо)<br>
                                        <span>web-программист</span></a>
                                </div>

                            </li>

                            <li>
                                <time datetime="">Ноябрь 2016 - наст. время</time>
                                <div><a href="#">DigitalSpectr (Пермь, удалённо)<br>
                                        <span>web-программист</span></a>
                                </div>

                            </li>


                        </ul>

                        <p style="margin-bottom:50px;"></p>


                    </div>

                </div>


            </div>
        </div>


        <div data-id="links" id="page4_1" class=''>
            <div class="bgHolder">
                <div class="bg2"></div>
            </div>
            <div class="container">
                <div class="row mar_t_117">


                    <div class="col-lg-12 col-lg-offset-0 col-md-12 col-md-offset-0 col-sm-12 col-xs-12
					links">
                        <h2 style="opacity: 1; right: 0%;">Ссылки</h2>



                        <!---->
                        <?php
                        $categoryId = WP_CATEGORY_LINKS_ID;

                        $category = get_category($categoryId);
                        $category_description = ($category->category_description);
                        $arCategoryDescription = explode(":", $category_description);

                        ?>

                            <?php
                            $args = array(
                                'numberposts' => 1000,
                                'category' => $categoryId,
                                'orderby' => 'meta_value_ORDER',
                                'order' => 'ASC',
                                'include' => array(),
                                'exclude' => array(),
                                'meta_key' => '',
                                'meta_value' => '',
                                'post_type' => 'post',
                                'suppress_filters' => true, // подавление работы фильтров изменения SQL запроса
                            );

                            $posts = get_posts($args);

                            foreach ($posts as $post) {
                                setup_postdata($post);
                                $paddingLeft = get_post_meta($post->ID, 'PADDING_LEFT');
                                $textColor = get_post_meta($post->ID, 'TEXT_COLOR');
                                $backgroundColor = get_post_meta($post->ID, 'BACKGROUND_COLOR');
                                $url = get_post_meta($post->ID, 'URL');

                            ?>
                        <p class="mar_t_3">
                                <a href="<?php echo $url[0]; ?>" target="_blank"
                                      style="background-color:<?php echo $backgroundColor[0]; ?>;
                                          color:<?php echo $textColor[0]; ?>;
                                          background-image:url(<?php

                                      $idImage = get_post_thumbnail_id($post->ID);
                                      $image_attributes = wp_get_attachment_image_src($idImage);
                                      echo $image_attributes[0];

                                      ?>); padding-left:<?php echo $paddingLeft[0]; ?>px;">

									<?php

                                    echo $post->post_title;
                                    ?>
								</a>
                        </p>
                                <?php

                            }

                            wp_reset_postdata(); // сброс
                            ?>



                        <p style="margin-bottom:50px;"></p>

                    </div>


                </div>
            </div>
        </div>


        <div data-id="resume" id="page5" class=''>
            <div class="bgHolder">
                <div class="bg5"></div>
            </div>
            <div class="container">
                <div class="row mar_t_117">

                    <div class="col-lg-12 col-lg-offset-0 col-md-12 col-md-offset-0 col-sm-12 col-xs-12">
                        <h2 class="mar_t_3">Основные сведения</h2>
                        <div class="row mar_t_5">
                            <div class="col-lg-12 col-lg-offset-0 col-md-12 col-md-offset-0 col-sm-12 col-xs-12">
                                <ul class="list_2">
                                    <li><span class="">Дата рождения</span><em> 9 июня 1992 г.</em></li>
                                    <li><span class="">Гражданство</span><em> Россия</em></li>
                                    <li><span class="">Семейное положение</span><em> холост</em></li>
                                    <li><span class="">Образование</span><em> Благовещенский Государственный
                                            Педагогический Университет, Физико-математический факультет,
                                            инженер информационных систем, 2009 - 2014</em></li>
                                    <li><span class="">Текущее местоположение</span>
                                        <em> РФ, Амурская область, г.Благовещенск</em></li>

                                </ul>

                                <p style="margin-bottom:50px;"></p>
                            </div>
                        </div>
                    </div>
                </div>


            </div>
        </div>
        <div data-id="contacts" id="page6">
            <div class="bgHolder">
                <div class="bg6"></div>
            </div>
            <div class="container">
                <div class="row mar_t_30">
                    <div class="col-lg-6 col-lg-offset-3 col-md-6 col-md-offset-3 col-sm-12 col-xs-12 tac mar_b_20">
                        <h2 class="">контакты</h2>

                        <p class="p5 mar_t_3">
                            Эл. почта: gsu1234@mail.ru<br>
                            Skype: gsu_resident234
                        </p>
                        <img src="img/mail_icone.png" alt="" class='mar_t_3'>
                        <p class=' pad_t_3'><a href="#" class="link_1"> gsu1234@mail.ru </a>
                    </div>
                </div>
            </div>
        </div>
    </article>
    <div id="other_pages" data-follow="location" data-type="switcher" data-flags="ajax">
    </div>
    <footer>
        <div class="container">
            <div class="col-lg-12 col-lg-offset-0 col-md-12 col-md-offset-0 col-sm-12 col-xs-12 tac">
                <p class="copyright"> &copy; <span id="year1"></span></p>
            </div>
        </div>
    </footer>
</div>





<script type="text/javascript">
    var _gaq = _gaq || [];
    _gaq.push(['_setAccount', 'UA-7078796-5']);
    _gaq.push(['_trackPageview']);
    (function () {
        var ga = document.createElement('script');
        ga.type = 'text/javascript';
        ga.async = true;
        ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'https://www') + '.google-analytics.com/ga.js';
        var s = document.getElementsByTagName('script')[0];
        s.parentNode.insertBefore(ga, s);
    })();</script>
</body>
<noscript>
    <iframe src="//www.googletagmanager.com/ns.html?id=GTM-P9FT69" height="0" width="0"
            style="display:none;visibility:hidden"></iframe>
</noscript>
<script>(function (w, d, s, l, i) {
        w[l] = w[l] || [];
        w[l].push({'gtm.start': new Date().getTime(), event: 'gtm.js'});
        var f = d.getElementsByTagName(s)[0], j = d.createElement(s), dl = l != 'dataLayer' ? '&l=' + l : '';
        j.async = true;
        j.src = '//www.googletagmanager.com/gtm.js?id=' + i + dl;
        f.parentNode.insertBefore(j, f);
    })(window, document, 'script', 'dataLayer', 'GTM-P9FT69');</script><!-- End Google Tag Manager -->
</html>
