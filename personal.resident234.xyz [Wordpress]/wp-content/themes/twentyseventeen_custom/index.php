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
		<link rel="stylesheet" href="http://adblockers.opera-mini.net/css_block/default-domainless.css"
			  type="text/css"/>
		<!-- CSS_ADSBLOCK_END -->
	</head>
	<body class="home page-template-default page page-id-16267 wpb-js-composer js-comp-ver-5.1 vc_responsive">
	<nav class="navbar navbar-default navbar-fixed-top nav-transparent overlay-nav sticky-nav nav-dark  nav-white "
		 data-menu-hover-delay="100">
		<div class="container">
			<div class="row">
				<div class="col-md-2 pull-left">
                    <a class="logo-light" href="<?php echo PERSONAL_WP_HCODE_URL; ?>/h-code"> <img
							alt="H-Code"
							src="<?php echo PERSONAL_WP_HCODE_URL; ?>/h-code/wp-content/uploads/2016/05/wp-logo-white.png"
							class="logo"/> <img alt="H-Code"
												src="<?php echo PERSONAL_WP_HCODE_URL; ?>/h-code/wp-content/uploads/2016/05/wp-logo-white.png"
												class="retina-logo" style="width:109px; max-height:34px"/> </a> <a
						class="logo-dark" href="<?php echo PERSONAL_WP_HCODE_URL; ?>/h-code"> <img alt="H-Code"
																							  src="<?php echo PERSONAL_WP_HCODE_URL; ?>/h-code/wp-content/uploads/2016/05/wp-logo-white.png"
																						  class="logo"/> <img
							alt="H-Code"
							src="<?php echo PERSONAL_WP_HCODE_URL; ?>/h-code/wp-content/uploads/2016/05/wp-logo-white.png"
							class="retina-logo-light" style="width:109px; max-height:34px"/> </a></div>


                <div class="navbar-header col-sm-8 sm-width-auto col-xs-2 pull-right">
					<button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
						<span class="sr-only">Toggle navigation</span> <span class="icon-bar"></span> <span
							class="icon-bar"></span> <span class="icon-bar"></span></button>
				</div>
				<div class="col-md-8 no-padding-right accordion-menu text-right top-6">
					<div id="mega-menu" class="navbar-collapse collapse navbar-right">

                        <?php
                        include $_SERVER['DOCUMENT_ROOT'] . '/includes/main_menu.php';
                        ?>

					</div>
				</div>
			</div>
		</div>
	</nav>
	<section class="parent-section no-padding post-16267 page type-page status-publish hentry">
		<div class="container-fluid">
			<div class="row">
				<div class="entry-content">
					<section class=" main-demo-slider no-padding"
							 style=" background-image: url(<?php echo PERSONAL_WP_HCODE_URL; ?>/h-code/wp-content/uploads/2016/05/slider-bg-demo-page.png); ">
						<div class="container-fluid">
							<div class="row">
								<div class="wpb_column hcode-column-container  col-xs-mobile-fullwidth">
									<div class="vc-column-innner-wrapper"> 
										<div id="hcode-owl-slider22"
											 class="owl-carousel owl-theme  hcode-owl-slider22
											 dot-pagination dark-pagination dark-navigation cursor-black">

                                            <?php

                                            $categoryId = PORTFOLIO_WP_CATEGORY_PROJECTS_ID;
                                            global $wpdb;
                                            $wpdb->set_prefix('portfolio_');


                                            unset($arSkillsCategoriesIDs);
                                            $categories=  get_categories();//'child_of=2'
                                            foreach ($categories as $category) {
                                                if($category->category_parent == PORTFOLIO_WP_CATEGORY_SKILLS_ID)  {
                                                    $arSkillsCategoriesIDs[] = $category->cat_ID;
                                                }

                                            }
                                            ///Debug($arSkillsCategoriesIDs);



                                            $args = array(
                                                'numberposts' => 1000,
                                                'category' => $categoryId,
                                                'orderby' => 'rand',
                                                'order'    => 'ASC',
                                                'include' => array(),
                                                'exclude' => array(),
                                                'meta_key' => 'ORDER',
                                                'meta_value' => '',
                                                'post_type' => 'post',
                                                'suppress_filters' => true
                                            );

                                            $posts = get_posts($args);

                                            foreach ($posts as $post) {

                                                $private = get_post_meta($post->ID, 'PRIVATE');

                                                //?mode=private
                                                if((!isset($_SESSION["mode"]) || ($_SESSION["mode"] != "private")) &&
                                                    ($private[0] == "1")) continue;

                                                setup_postdata($post);


                                                $gal = get_post_gallery( $post->ID, false );
                                                $arIDs = explode(',', $gal['ids']);
                                                //echo "<pre>";
                                                //print_r($gal);
                                                //echo "</pre>";

                                                foreach($arIDs as $keyImageID => $itemImageID) {

                                                    $arMetaImage = wp_get_attachment_metadata($itemImageID);

                                                    $thumb_img = get_post($itemImageID);

                                                    if($thumb_img->post_excerpt == "PERSONAL_MAIN_SLIDER"){

                                                        //$upload_dir = (object) wp_upload_dir();


                                                            ?>
                                                        <div class="item owl-bg-img full-screen js-owl-bg-img"
                                                             data-image="<?php echo PORTFOLIO_WP_UPLOAD_DIR_URL; ?>/<?php echo $arMetaImage["file"]; ?>"
                                                             style=""></div>
                                                        <?

                                                    }

                                                }
                                                ?>
 

                                                <?
                                            }

                                            wp_reset_postdata();


                                            ?>

										</div>
										<div class="work-background-slider-text">
											<div class="slider-text-bottom slider-text-middle5 text-left no-padding"><h1
													class="margin-two-bottom"
                                                    style="color:#fdd947 !important ">Персональный сайт-портфолио</h1>
                                                <span class="slider-subtitle5 black-text"
																				   style="color:#ffffff !important ">
                                                    Гладышев Сергей Юрьевич
                                                </span>
												<div
													class="separator-line bg-yellow no-margin-lr sm-margin-bottom-eight"></div>
												<div class="col-md-8 no-padding">
                                                    <p class="text-large text-uppercase">web - программист<br>full - stack</p>
                                                </div>
											</div>
											<div
												class="col-md-8 col-sm-12 text-med no-padding margin-five no-margin-bottom xs-no-margin-top">
												<div class="col-md-4 col-sm-4 col-xs-4 text-med no-padding">
													<div class="spend-year no-border text-left black-text width-auto">
														<span></span></div>
												</div>
												<div class="col-md-4 col-sm-4 col-xs-4 text-med no-padding">
													<div class="spend-year no-border text-left black-text width-auto">
														<span></span></div>
												</div>
												<div class="col-md-4 col-sm-4 col-xs-4 text-med no-padding">
													<div class="spend-year no-border text-left black-text width-auto">
														<span></span></div>
												</div>
											</div>
										</div>
										<script type="text/javascript">/*<![CDATA[*/
											jQuery(document).ready(function () {
												jQuery("#hcode-owl-slider22").owlCarousel({
													touchDrag: false,
													mouseDrag: false,
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
					<section id="features" class=" main-demo-features no-padding-bottom"
							 style="border-top: 1px solid #e5e5e5;">
						<div class="container">
							<div class="row">
								<div
									class="wpb_column hcode-column-container  col-md-12 col-xs-mobile-fullwidth text-center">
									<div class="vc-column-innner-wrapper">
                                        <h1 class="section-title-text-block">
                                            Занимаюсь web-разработкой
                                        </h1>
                                    </div>
								</div>
								<div
									class="wpb_column hcode-column-container  col-lg-6 col-md-8 col-xs-12 col-sm-10 text-center center-col">
									<div class="vc-column-innner-wrapper">
										<div class="block-text">
                                            с декабря 2012 года.
										</div>
									</div>
								</div>
							</div>
						</div>
					</section>
					<section id="main-demo">
						<div class="container-fluid">
							<div class="row">
								<div
									class="wpb_column hcode-column-container  portfolio-nav-tabs col-xs-mobile-fullwidth col-sm-12 no-padding xs-no-padding"
									style=" background:#1c1d21;">
									<div class="vc-column-innner-wrapper">
										<div class="col-md-12 text-center">
											<div class="text-center">


                                                <ul class="portfolio-filter nav nav-tabs nav-tabs-black">

                                                    <?php
                                                    include $_SERVER['DOCUMENT_ROOT'] . '/includes/portfolio_filter.php';
                                                    ?>

                                                </ul>

											</div>
										</div>
										<div class="work-4col gutter work-with-title wide wide-title ">
											<div
												class="col-md-12  grid-gallery overflow-hidden no-padding content-section">
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
                                                                    <div class="gallery-img js-gallery-img">
                                                                        <a
                                                                                href="/detail/<?php echo $arDetailTemplates[wp_rand(0, count($arDetailTemplates) - 1)]; ?>?ID=<?php echo $post->ID; ?>"
                                                                                class="" target="">
                                                                            <img alt="" data-image="<?php echo $thumb_url[0]; ?>"
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
					<section class=" features-box-four">
						<div class="container-fluid">
							<div class="row">
                                <div
                                        class="wpb_column hcode-column-container  col-md-3 col-xs-12 col-sm-6 sm-margin-five-bottom">
                                    <div class="vc-column-innner-wrapper">
                                        <div class="features-box-style2"><h5 class="">
                                                Подготовительные работы
                                            </h5>
                                            <div class="no-margin"><p>
                                                    <b>-</b> Обсуждение проекта, постановка целей и задач<br>
                                                    <b>-</b> Составление сметы, календарного плана, заключение договора на
                                                    создание сайта<br>
                                                    <b>-</b> Составление технического задания и прототипов<br>

                                                </p></div>
                                        </div>
                                    </div>
                                </div>
                                <div
                                        class="wpb_column hcode-column-container  col-md-3 col-xs-12 col-sm-6 sm-margin-five-bottom">
                                    <div class="vc-column-innner-wrapper">
                                        <div class="features-box-style2"><h5 class="">
                                                Разработка сайта
                                            </h5>
                                            <div class="no-margin"><p>
                                                    <b>-</b> Работы по проектированию и разработке на основании
                                                    утверждённого технического задания и брифа<br>
                                                    <b>-</b> Проработка структуры будущего сайта<br>
                                                    <b>-</b> Выбор платформы и инструментария<br>
                                                    <b>-</b> Собственно разработка<br>
                                                    <b>-</b> Тестирование<br>
                                                    <b>-</b> Запуск<br>
                                                </p></div>
                                        </div>
                                    </div>
                                </div>
                                <div
                                        class="wpb_column hcode-column-container  col-md-3 col-xs-12 col-sm-6 xs-margin-five-bottom">
                                    <div class="vc-column-innner-wrapper">
                                        <div class="features-box-style2"><h5 class="">
                                                Сопровождение сайта
                                            </h5>
                                            <div class="no-margin"><p>
                                                    <b>-</b> Наполнение ресурса оптимизированным SEO-контентом<br>
                                                    <b>-</b> Наполнение страниц информационными материалами клиента<br>
                                                    <b>-</b> Редизайн элементов по желанию заказчика<br>
                                                    <b>-</b> Переконфигурирование сайта<br>
                                                    <b>-</b> Техническая поддержка<br>
                                                </p></div>
                                        </div>
                                    </div>
                                </div>
                                <div class="wpb_column hcode-column-container  col-md-3 col-xs-12 col-sm-6">
                                    <div class="vc-column-innner-wrapper">
                                        <div class="features-box-style2"><h5 class="">
                                                Доработка сайта
                                            </h5>
                                            <div class="no-margin"><p>
                                                    <b>-</b> Доработка модулей или их создание<br>
                                                    <b>-</b> Доработка верстки<br>
                                                    <b>-</b> Адаптация под браузеры и разрешения дисплеев<br>
                                                    <b>-</b> Редизайн/доработка дизайна<br>
                                                    <b>-</b> Создание элементов сайта<br>
                                                    <b>-</b> Работа с юзабилити<br>
                                                    <b>-</b> Отладка ошибок в программном коде ресурса<br>
                                                    <b>-</b> Коррекция работы сайта согласно интересам и
                                                    потребностям посетителей<br>
                                                    <b>-</b> Изменение бизнес-логики проекта<br>
                                                    <b>-</b> Повышение производительности, ускорение работы,
                                                    рефакторинг<br>
                                                    <b>-</b> Интеграция с внешними системами<br>

                                                </p></div>
                                        </div>
                                    </div>
                                </div>
							</div>
						</div>
					</section>

                    <?
                    $categoryId = PORTFOLIO_WP_STOCK_FOTOS_ID;

                    $args = array(
                    'numberposts' => 2,
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


                    wp_reset_postdata();



                    //$categoryId = PORTFOLIO_WP_CATEGORY_SKILLS_ID;

                    $args = array(
                        'numberposts' => 3,
                        'category' => $arSkillsCategoriesIDs,
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

                        $thumb_id = get_post_thumbnail_id($post->ID);
                        $thumb_url = wp_get_attachment_image_src($thumb_id, 'full',
                            false);

                        $thumb_url[0] = str_replace(get_site_url(),
                            PORTFOLIO_WP_URL,
                            $thumb_url[0]);

                        $currentSkillLogo[] = $thumb_url[0];

                    }


                    wp_reset_postdata();




                    $categoryId = PORTFOLIO_WP_TEXT_1_ID;

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

                    //unset($arSkills);
                    foreach ($posts as $post) {
                        setup_postdata($post);


                        $currentTitle[] = $post->post_title;
                        $currentDescription[] = $post->post_content;

                    }


                    wp_reset_postdata();



                    $categoryId = PORTFOLIO_WP_CATEGORY_PROJECTS_ID;

                    $args = array(
                        'numberposts' => 1000,
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

                    unset($arProjects);
                    unset($arProjectsMockups);

                    foreach ($posts as $post) {

                        $private = get_post_meta($post->ID, 'PRIVATE');

                        //?mode=private
                        if((!isset($_SESSION["mode"]) || ($_SESSION["mode"] != "private")) &&
                            ($private[0] == "1")) continue;

                        setup_postdata($post);




                        $gal = get_post_gallery( $post->ID, false );
                        $arIDs = explode(',', $gal['ids']);

                        foreach($arIDs as $keyImageID => $itemImageID) {

                            $arMetaImage = wp_get_attachment_metadata($itemImageID);

                            $thumb_img = get_post($itemImageID);

                            if($thumb_img->post_excerpt == "PERSONAL_MOCKUP"){

                                $arProjects[] = PORTFOLIO_WP_UPLOAD_DIR_URL."/".$arMetaImage["file"];

                            }else if($thumb_img->post_excerpt == "PERSONAL_MOCKUP_2"){

                                $arProjectsMockups[] = PORTFOLIO_WP_UPLOAD_DIR_URL."/".$arMetaImage["file"];

                            }

                        }




                    }


                    wp_reset_postdata();



                    $currentProjectImage[] = $arProjects[mt_rand(0, count($arProjects) - 1)];
                    $currentProjectImage[] = $arProjects[mt_rand(0, count($arProjects) - 1)];
                    $currentProjectImage[] = $arProjects[mt_rand(0, count($arProjects) - 1)];

                    $projectImageLeft = $arProjectsMockups[mt_rand(0, count($arProjectsMockups) - 1)];


                    ?>

                    <section class=" woocommerce-box cover-background js-cover-background overflow-hidden"
                             data-image="<?php echo $currentBackgroundImage[0]; ?>"
							 style="">

						<div class="selection-overlay" style=" opacity:0.9; background-color:#1c1d21;"></div>
						<div class="container">
							<div class="row">




								<div
									class="wpb_column hcode-column-container  col-xs-mobile-fullwidth
									col-sm-12 text-center margin-four-bottom xs-margin-eight">
									<div class="vc-column-innner-wrapper"><img
											src="<?php echo $currentSkillLogo[0]; ?>"
											style="max-height:80px;" alt=""></div>
								</div>





								<div
									class="wpb_column hcode-column-container  col-md-12 col-xs-mobile-fullwidth text-center">
									<div class="vc-column-innner-wrapper">
                                        <h1 class="section-title-text-block">
                                            <?php echo $currentTitle[0]; ?>
                                        </h1>
									</div>
								</div>
								<div
									class="wpb_column hcode-column-container  col-lg-6 col-md-8 col-xs-12 col-sm-10 text-center center-col margin-eight-bottom xs-margin-twelve-bottom">
									<div class="vc-column-innner-wrapper">
										<div class="block-text">
                                            <?php echo $currentDescription[0]; ?>
										</div>
									</div>
								</div>
								<div
									class="wpb_column hcode-column-container  col-md-12 col-xs-mobile-fullwidth text-center center-col">
									<div class="vc-column-innner-wrapper">
                                        <img class="js-current-project-image"
                                             data-image="<?php echo $currentProjectImage[0]; ?>"
											src="<?php /*echo PERSONAL_WP_HCODE_DEFAULT_IMAGE_URL;*/ ?>"
											width="1086" height="450" alt="">



                                    </div>
								</div>
							</div>
						</div>
					</section>

					<section class="  cover-background no-padding js-cover-background"
                             data-image="<?php echo $projectImageLeft; ?>"
							 style="">
						<div class="container-fluid">
							<div class="row">
								<div
									class="wpb_column hcode-column-container  pull-right col-md-6 col-xs-12 col-sm-12 no-padding">
									<div class="vc-column-innner-wrapper">

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

                                        foreach ($posts as $post) {
                                            setup_postdata($post);


                                            ?>

                                            <div class="grid-border">
                                                <div
                                                        class="col-lg-4 col-md-6 col-sm-6 col-xs-12 no-padding
												grid-border-box bg-gray text-center">
                                                    <i class="icon-<?php echo $post->post_content;?>
                                                    extra-large-icon"></i><span
                                                            class="text-uppercase letter-spacing-2 black-text
													font-weight-600 display-block margin-ten no-margin-bottom
													xs-margin-top-five">
                                                        <?php echo $post->post_title;?>
                                                    </span>
                                                </div>
                                            </div>

                                            <?php
                                        }

                                        wp_reset_postdata();
                                        ?>


										
									</div>
								</div>
							</div>
						</div>
					</section>




                    <section class=" wp-plugin-logo">
						<div class="container-fluid">
							<div class="row">

                                <?php



                                //$categoryId = PORTFOLIO_WP_CATEGORY_SKILLS_ID;

                                $args = array(
                                    'numberposts' => 4,
                                    'category' => $arSkillsCategoriesIDs,
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

                                    $thumb_id = get_post_thumbnail_id($post->ID);
                                    $thumb_url = wp_get_attachment_image_src($thumb_id, 'full',
                                        false);

                                    $thumb_url[0] = str_replace(get_site_url(),
                                        PORTFOLIO_WP_URL,
                                        $thumb_url[0]);
                                    ?>
                                    <div class="wpb_column hcode-column-container  col-xs-12
                                    col-sm-3 xs-margin-ten-bottom">
                                        <div class="vc-column-innner-wrapper align-center
                                        vc-skill-image-container">
                                            <img class="vc-skill-image js-vc-skill-image"
                                                    src=""
                                                 data-image="<?php echo $thumb_url[0]; ?>"
                                                     class=" aligncenter" alt=""><!---->
                                        </div>
                                    </div>

                                    <?php
                                }


                                wp_reset_postdata();

                                ?>



							</div>
						</div>
					</section>
					<section class=" visual-composer-box no-padding-bottom" style=" background-color:#1c1d21; ">
						<div class="container">
							<div class="row">
								<div
									class="wpb_column hcode-column-container  col-xs-mobile-fullwidth col-sm-12 text-center margin-five-bottom xs-margin-ten-bottom">
									<div class="vc-column-innner-wrapper"><img
											src="<?php echo $currentSkillLogo[1]; ?>"
                                            style="max-height:80px;" alt=""></div>
								</div>
								<div
									class="wpb_column hcode-column-container  col-md-12 col-xs-mobile-fullwidth text-center margin-one-bottom">
									<div class="vc-column-innner-wrapper">
                                        <h1 class="section-title-text-block">
                                            <?php echo $currentTitle[1]; ?>
                                        </h1></div>
								</div>
								<div
									class="wpb_column hcode-column-container  col-lg-7 col-md-9 col-xs-12 col-sm-11 text-center center-col margin-nine-bottom xs-margin-thirteen-bottom">
									<div class="vc-column-innner-wrapper">
										<div class="block-text">
                                            <?php echo $currentDescription[1]; ?>
										</div>
									</div>
								</div>
								<div
									class="wpb_column hcode-column-container  col-md-12 col-xs-mobile-fullwidth text-center center-col no-padding xs-padding-lr-15px">
									<div class="vc-column-innner-wrapper"><img
                                                class="js-current-project-image"
                                                data-image="<?php echo $currentProjectImage[1]; ?>"
                                                src="<?php /*echo PERSONAL_WP_HCODE_DEFAULT_IMAGE_URL;*/ ?>"
                                                width="1384" height="479" alt=""></div>
								</div>
							</div>
						</div>
					</section>
					<section>
						<div class="container container-feedback">
							<div class="row">
								<div
									class="wpb_column hcode-column-container  col-md-12 col-xs-mobile-fullwidth text-center margin-seven-bottom sm-margin-seven-bottom xs-margin-two-bottom">
									<div class="vc-column-innner-wrapper">
                                        <h1 class="section-title-text-block">
                                            Заказать разработку
                                        </h1></div>
								</div>
								<div
									class="wpb_column hcode-column-container  col-md-6 col-xs-12 col-sm-6 text-center xs-margin-seven-bottom">
									<div class="vc-column-innner-wrapper">
                                        <a class="js-background" data-image="https://static.pexels.com/photos/326424/pexels-photo-326424.jpeg"
											href="<?php echo PERSONAL_WP_HCODE_URL; ?>/h-code/documentation/">
                                            <span>Форма заказа проекта</span>
                                            <!--<img
												src="<?php echo PERSONAL_WP_HCODE_URL; ?>/h-code/wp-content/uploads/2016/05/always-happy-1.png"
												width="562" height="281" alt="">--></a></div>
								</div>
								<div class="wpb_column hcode-column-container  col-md-6 col-xs-12 col-sm-6 text-center">
									<div class="vc-column-innner-wrapper">
                                        <a class="js-background"
                                           data-image="https://static.pexels.com/photos/53621/calculator-calculation-insurance-finance-53621.jpeg"
											href="<?php echo PERSONAL_WP_HCODE_URL; ?>/h-code/documentation/general-information/video-tutorials/">
                                            <span>Калькулятор стоимости проекта</span>
                                            <!--<img
												src="<?php echo PERSONAL_WP_HCODE_URL; ?>/h-code/wp-content/uploads/2016/05/always-happy-2.png"
												width="562" height="281" alt="">--></a></div>
								</div>
							</div>
						</div>
					</section>
					<section class=" " style=" background-color:#f7f7f7; ">
						<div class="container">
							<div class="row">
								<div
									class="wpb_column hcode-column-container  col-xs-mobile-fullwidth col-sm-12 text-center margin-one-bottom xs-margin-two-bottom">
									<div class="vc-column-innner-wrapper"><h1 class="section-title-text-block">Сертификаты</h1></div>
								</div>
								<div
									class="wpb_column hcode-column-container  col-lg-7 col-md-9 col-xs-12 col-sm-11 text-center center-col margin-eight-bottom xs-margin-thirteen-bottom">
									<div class="vc-column-innner-wrapper">
										<div class="block-text">
                                            Документальное подтверждение компетенции
										</div>
									</div>
								</div>
								<div class="wpb_column hcode-column-container  col-xs-mobile-fullwidth">
									<div class="vc-column-innner-wrapper">
										<div class="testimonial-slider position-relative no-transition">
											<div id="hcode-testimonial"
												 class="owl-pagination-bottom position-relative  testimonial-slider-style round-pagination dark-pagination cursor-black">





                                                <?php
                                                $categoryId = PORTFOLIO_WP_CATEGORY_SERTIFICATES_ID;




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

                                                    <?php
                                                    $arPostCustom = get_post_custom($post->ID);
                                                    preg_match_all('/href="([^"]+)"/', $post->post_content, $links);
                                                    $linkToPdf = str_replace(get_site_url(), "", $links[1][0]);

                                                    //



                                                    ?>


                                                        <div
                                                                class="col-md-12 col-sm-12 col-xs-12 testimonial-style2 center-col text-center margin-three no-margin-top">
                                                            <img alt=""
                                                                 data-image="<?php echo PORTFOLIO_WP_URL.$arPostCustom["PREVIEW_IMAGE"][0]; ?>"
                                                                 src="" class="js-img img-sertificate"
                                                                 >
                                                            <p class="center-col width-90">
                                                                <a href="http://docs.google.com/viewer?url=<?php echo $linkToPdf; //PORTFOLIO_WP_URL. ?>" target="_blank">
                                                                    <?php echo $post->post_title; ?>
                                                                </a>
                                                            </p>
                                                            <div class="testimonial-name">
                                                                <?php
                                                                $arPostTags = wp_get_post_tags($post->ID);
                                                                //print_r($arPostTags);
                                                                foreach ($arPostTags as $keyTag => $tag) {
                                                                    $postTagId = $tag->term_id;
                                                                    $postTagName = $tag->name;
                                                                    break;
                                                                }
                                                                echo $postTagName;

                                                                ?>
                                                            </div>

                                                        </div>




                                                    <?php
                                                    }

                                                wp_reset_postdata(); // сброс
                                                ?>





											</div>
										</div>
										<script type="text/javascript">/*<![CDATA[*/
											jQuery(document).ready(function () {
												jQuery("#hcode-testimonial").owlCarousel({
													pagination: true,
													items: 3,
													itemsDesktop: [1200, 3],
													itemsTablet: [991, 3],
													itemsMobile: [767, 1],
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
						<div class="container-fluid">
							<div class="row">
								<div
									class="wpb_column hcode-column-container  col-md-12 col-xs-mobile-fullwidth text-center margin-five-bottom sm-margin-seven-bottom xs-margin-two-bottom">
									<div class="vc-column-innner-wrapper">
                                        <h1 class="section-title-text-block">Используемый в работе инструментарий</h1></div>
								</div>
								<div
									class="wpb_column hcode-column-container  col-layout-logo col-xs-mobile-fullwidth col-sm-12 text-center">
									<div class="vc-column-innner-wrapper">

                                        <?php


                                        $categoryId = PORTFOLIO_WP_CATEGORY_IDE_ID;

                                        $args = array(
                                            'numberposts' => 7,
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


                                        foreach ($posts as $post) {


                                            $imageMeta = get_post_meta($post->ID, 'PREVIEW_IMAGE', true);

                                            setup_postdata($post);

                                            ?>

                                            <img
                                                    src="" data-image="<?php echo $imageMeta; ?>"
                                                    class="js-img"
                                                    width="309" height="134" alt="">

                                            <?php

                                        }


                                        wp_reset_postdata();
                                        ?>

       

                                    </div>
								</div>
							</div>
						</div>
					</section>
					<section class=" " style=" background-color:#f6f6f6; ">
						<div class="container">
							<div class="row">
								<div
									class="wpb_column hcode-column-container  col-md-12 col-xs-mobile-fullwidth text-center margin-five-bottom sm-margin-seven-bottom xs-margin-two-bottom">
									<div class="vc-column-innner-wrapper">
                                        <h1 class="section-title-text-block">
                                            Ссылки
                                        </h1>
                                    </div>
								</div>
								<div
									class="wpb_column hcode-column-container  col-layout col-xs-mobile-fullwidth col-sm-12 text-center">
									<div class="vc-column-innner-wrapper">


                                        <?php


                                        $categoryId = PORTFOLIO_WP_CATEGORY_LINKS_ID;

                                        $args = array(
                                            'numberposts' => 4,
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


                                        foreach ($posts as $post) {

                                            setup_postdata($post);
                                            $imageMeta = get_post_meta($post->ID, 'PREVIEW_IMAGE', true);
                                            $URL = get_post_meta($post->ID, 'URL', true);


                                            ?>
                                            <a href="<?php echo $URL; ?>" target="_blank">
                                            <img
                                                    src="" data-image="<?php echo $imageMeta; ?>"
                                                    class="js-img"
                                                    width="173" height="215" alt="">
                                            </a>
                                            <?php

                                        }


                                        wp_reset_postdata();
                                        ?>



                                    </div>
								</div>
							</div>
						</div>
					</section>
					<section class="  no-padding-bottom">
						<div class="container">
							<div class="row">
								<div
									class="wpb_column hcode-column-container  col-md-12
									col-xs-mobile-fullwidth text-center margin-one-bottom">
									<div class="vc-column-innner-wrapper">
                                        <h1 class="section-title-text-block">
                                            <?php echo $currentTitle[2]; ?>
                                        </h1>
                                    </div>
								</div>
								<div
									class="wpb_column hcode-column-container  col-lg-8 col-md-10
									col-xs-12 col-sm-12 text-center center-col margin-nine-bottom
									xs-margin-thirteen-bottom">
									<div class="vc-column-innner-wrapper">
										<div class="block-text">
                                            <?php echo $currentDescription[2]; ?>
										</div>
									</div>
								</div>
								<div
									class="wpb_column hcode-column-container  col-md-12 col-xs-mobile-fullwidth
									text-center center-col">
									<div class="vc-column-innner-wrapper">
                                        <p class="no-margin">
                                            <a
												href="/projects/best/">
                                                <img
                                                        class="js-current-project-image"
                                                        data-image="<?php echo $currentProjectImage[0]; ?>"
                                                        alt=""/>
                                            </a>
                                        </p>
                                    </div>
								</div>
							</div>
						</div>
					</section>
					<section class=" core-features" style="border-top: 1px solid #e5e5e5;">
						<div class="container">
							<div class="row">
								<div
									class="wpb_column hcode-column-container  col-md-12 col-xs-mobile-fullwidth text-center margin-one-bottom">
									<div class="vc-column-innner-wrapper">
                                        <h1 class="section-title-text-block">
                                            Навыки
                                        </h1></div>
								</div>
								<div
									class="wpb_column hcode-column-container  col-lg-8 col-md-10 col-xs-12 col-sm-12 text-center center-col margin-nine-bottom xs-margin-thirteen-bottom">
									<div class="vc-column-innner-wrapper">
										<div class="block-text">Front-End и Back-End</div>
									</div>
								</div>


                                <?php
                                //$categoryId = PORTFOLIO_WP_CATEGORY_SKILLS_ID;

                                    $args = array(
                                        'numberposts' => 1000,
                                        'category' => $arSkillsCategoriesIDs,
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


                                    foreach ($posts as $post) {
                                        setup_postdata($post);

                                        $description = get_post_meta($post->ID, 'DESCRIPTION');
                                        $image = get_post_meta($post->ID, 'PREVIEW_IMAGE', true);

                                        if(!$image) continue;

                                    ?>

                                        <div
                                                class="wpb_column hcode-column-container skills-column-container
                                                col-md-6 col-xs-12
									col-sm-12 no-padding margin-seven-bottom sm-margin-ten-bottom wow fadeInUp">
                                            <div class="vc-column-innner-wrapper">
                                                <div class="col-md-5 col-sm-5 xs-margin-bottom-20px
                                                skill-image-container"
                                                style="">
                                                    <img alt=""
                                                         src=""
                                                         width="266"
                                                         height="155" class="js-img" 
                                                    data-image="<?php echo $image; ?>"></div>
                                                <div class="col-md-7 col-sm-7">
                                                    <h3
                                                            class="margin-bottom-15px font-weight-600 
                                                            line-height-20">
                                                        <?php echo $post->post_title; ?>
                                                    </h3>
                                                    <p class="no-margin">
                                                        <?php echo $description[0] ?>
                                                    </p></div>
                                            </div>
                                        </div>

                                    <?php
                                    }

                                    wp_reset_postdata(); // сброс
                                    ?>




							</div>
						</div>
					</section>
					<section class=" woocommerce-box cover-background overflow-hidden js-background"
							 style=""
                             data-image="<?php echo $currentBackgroundImage[1]; ?>">
						<div class="selection-overlay" style=" opacity:0.9; background-color:#1c1d21;"></div>
						<div class="container">
							<div class="row">
								<div
									class="wpb_column hcode-column-container  col-md-12 col-xs-mobile-fullwidth text-center">
									<div class="vc-column-innner-wrapper">
                                        <h1 class="section-title-text-block">
                                            Контакты
                                            <br/>
                                            <span class="font-weight-700">
                                                Способы связи со мной
                                            </span>
										</h1></div>
								</div>
								<div
									class="wpb_column hcode-column-container  col-lg-12 col-md-12 col-xs-12 col-sm-12 text-center center-col margin-four-bottom xs-margin-ten-bottom">
									<div class="vc-column-innner-wrapper">
										<div class="block-text">E-mail: gsu1234@mail.ru • Skype: gsu_resident234
										</div>
									</div>
								</div>
								<div
									class="wpb_column hcode-column-container  col-md-12 col-xs-mobile-fullwidth text-center center-col">
									<div class="vc-column-innner-wrapper"><a
											href="/feedback/simple/"
											target="_self"
											class="inner-link btn-small-white-background btn-large button btn">
                                        Обратная связь
                                        </a></div>
								</div>
							</div>
						</div>
					</section>
				</div>
			</div>
		</div>
	</section>
	<footer class="bg-light-gray2">
		<div class="container-fluid bg-dark-gray footer-bottom">
			<div class="container">
				<div class="row margin-three">
					<div
						class="col-md-9 col-sm-9 col-xs-12 copyright text-left letter-spacing-1 xs-text-center xs-margin-bottom-one light-gray-text2">
						© 2017</div>
					<div class="col-md-3 col-sm-3 col-xs-12 footer-logo text-right xs-text-center"><a
							href="/"><img alt="H-Code"
																		   src="<?php echo PERSONAL_WP_HCODE_URL; ?>/h-code/wp-content/uploads/2015/08/logo-light-gray.png"
																		   width="210" height="39"></a></div>
				</div>
			</div>
		</div>




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
			$(".main-demo-slider").find("div.slider-text-bottom").append("<div class='demo-slider-right-button'>" +
                "<a href='/projects/' class='inner-link highlight-button-white-border btn-medium button btn'>Проекты</a>" +
                "<a href='/sertificates/' " +
                "class='inner-link highlight-button-white-border btn-medium button btn'>Сертификаты</a></div>" +
                "<div class='home-slider-bottom-image'></div>");
			$(".main-demo-slider").find("div.work-background-slider-text").children().next().addClass("display-none");
		}
		$(document).ready(function () {
			if ($('body').hasClass("error404")) {
				$('nav').removeClass('nav-black').addClass('nav-white');
			}
		});
        $(window).load(function () {
            $(".js-current-project-image").each(function(){
                $(this).attr("src", $(this).attr("data-image"));
            });

            $(".js-cover-background").each(function(){
                $(this).css("backgroundImage", "url("+$(this).attr("data-image")+")");
            });
            $(".js-owl-bg-img").each(function(){
                $(this).css("backgroundImage", "url("+$(this).attr("data-image")+")");
            });

            $(".js-gallery-img img").each(function(){
                $(this).attr("src", $(this).attr("data-image"));
            });
            $(".js-cover-background").each(function(){
                $(this).css("backgroundImage", "url("+$(this).attr("data-image")+")");
            });
            $(".js-vc-skill-image").each(function(){
                $(this).attr("src", $(this).attr("data-image"));
            });
            $(".js-background").each(function(){
                $(this).css("backgroundImage", "url("+$(this).attr("data-image")+")");
            });

            $(".js-img").each(function(){
                $(this).attr("src", $(this).attr("data-image"));
            });






        });

		/*]]>*/</script>
	<script type="text/javascript">/*<![CDATA[*/
		/*$(document).ready(function () {
			var $buythemediv = '<div class="buy-theme xs-display-none"><a href="http://themeforest.net/item/hcode-responsive-multipurpose-wordpress-theme/14561695?ref=themezaa" target="_blank"><span>Purchase Theme</span></a></div><div class="quick-question xs-display-none"><a href="mailto:info@themezaa.com?subject=H-Code WordPress Theme Quick Question"><span>Quick Question?</span></a></div>';
			$('body').append($buythemediv);
		});*/
		/*]]>*/</script>
	</body>
	</html>





<?php
/*
?>
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
