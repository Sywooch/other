<?php
/**
 * Created by PhpStorm.
 * User: GSU
 * Date: 29.07.2017
 * Time: 13:35
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
<body class="page-template-default page page-id-53 wpb-js-composer js-comp-ver-5.1 vc_responsive">
<nav
    class="navbar navbar-default navbar-fixed-top nav-transparent overlay-nav sticky-nav nav-border-bottom static-sticky  nav-black "
    data-menu-hover-delay="100">
    <div class="container">
        <div class="row">
            <?php
            include $_SERVER['DOCUMENT_ROOT'] . '/includes/head_logo_white.php';
            ?>
            <div class="col-md-8 no-padding-right accordion-menu text-right pull-right menu-position-right">
                <div id="mega-menu" class="navbar-collapse collapse navbar-right">
                    <ul id="menu-onepage-landing" class="mega-menu-ul nav navbar-nav navbar-right panel-group">
                        <?php
                        include $_SERVER['DOCUMENT_ROOT'] . '/includes/main_menu.php';
                        ?>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</nav>
<section class="parent-section no-padding post-53 page type-page status-publish hentry">
    <div class="container-fluid">
        <div class="row">
            <div class="entry-content">
                <section id="slider" class="  fix-background full-screen no-padding js-background"
                         data-image="<? displayRandomElement($arProjectAllImages); ?>">
                    <div class="selection-overlay" style=" opacity:0.5; background-color:#000000;"></div>
                    <div class="container">
                        <div class="row">
                            <div class="wpb_column hcode-column-container  col-xs-mobile-fullwidth">
                                <div class="vc-column-innner-wrapper">
                                    <div class=" container position-relative full-screen">
                                        <div class="slider-typography">
                                            <div class="slider-text-middle-main">
                                                <div class="slider-text-bottom">

                                                    <h1 class="letter-spacing-2 white-text margin-three
                                                    no-margin-bottom landing-title">
                                                        <?php echo $arProject["post_title"]; ?>
                                                    </h1>
                                                    <div
                                                        class="text-large letter-spacing-2 white-text margin-two display-block xs-display-none">
                                                        <?php echo $arProject["post_content_formatted"]; ?>
                                                    </div>
                                                    <?php /* ?>
                                                    <div class="margin-five margin-ten-bottom">
                                                        <div
                                                            class="col-lg-6 col-md-7 col-sm-10 col-xs-11 clearfix landing-subscribe center-col">
                                                            <form class="" method="POST" name="subscription"
                                                                  action="http://wpdemos.themezaa.com/h-code/index.php?wp_nlm=subscription">
                                                                <div
                                                                    class="col-lg-8 col-md-7 col-sm-8 no-padding-left xs-no-padding xs-margin-bottom-four">
                                                                    <input type="text" id="email" name="xyz_em_email"
                                                                           class="big-input landing-subscribe-input no-margin-bottom xyz_em_email"
                                                                           placeholder="ENTER YOUR EMAIL..."></div>
                                                                <div class="col-lg-4 col-md-5 col-sm-4 no-padding">
                                                                    <input type="submit"
                                                                           class="landing-subscribe-button no-margin-bottom submit_newsletter"
                                                                           value="START YOUR TRIAL" id="notifyme-button"
                                                                           name="notifyme-button"></div>
                                                            </form>
                                                        </div>
                                                    </div><?php */ ?>


                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
                <section class="  no-padding-bottom" style="border-bottom: 1px solid #e5e5e5;">
                    <div class="container">
                        <div class="row">
                            <div
                                class="wpb_column hcode-column-container  col-lg-4 col-md-5 col-xs-mobile-fullwidth col-sm-6">
                                <div class="vc-column-innner-wrapper"><h1 class="section-title  black-text
                                no-padding">
                                        <?php echo $YEAR; ?></h1>
                                    <div class="separator-line no-margin-lr" style=" background:#000000;"></div>
                                    <p class="text-med width-70">
                                        <?php echo implode(" ", $arPostTagsNames); ?>
                                    </p>

                                    <?php if($ProjectURL){ ?>
                                    <a href="<?php echo $ProjectURL; ?>" target="_self"

                                       class="inner-link highlight-button-black-border btn-medium
                                       margin-ten-bottom button btn">
                                        Ссылка на проект</a>
                                    <?php } ?>

                                </div>
                            </div>
                            <div
                                class="wpb_column hcode-column-container  col-lg-7 col-md-offset-1 col-md-6 col-xs-mobile-fullwidth col-sm-6">
                                <div class="vc-column-innner-wrapper"><img
                                        src="" class="js-img"
                                        data-image="<?php displayRandomElement($arProjectMockups); ?>"
                                        width="787" alt=""></div>
                            </div>
                        </div>
                    </div>
                </section>
                <section id="features" class="  wow fadeIn">
                    <div class="container">
                        <div class="row">
                            <div
                                class="wpb_column hcode-column-container  col-md-12 col-xs-mobile-fullwidth text-center margin-three-bottom sm-margin-ten-bottom">
                                <div class="vc-column-innner-wrapper"><h1 class="section-title  black-text
                                no-padding">
                                        Категории проектов</h1>
                                    <div class="separator-line margin-two-top" style=" background:#000000;"></div>
                                </div>
                            </div>

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
                                <div
                                        class="wpb_column hcode-column-container  col-md-4 col-xs-12 col-sm-6 margin-bottom-80px xs-margin-ten-bottom">
                                    <div class="vc-column-innner-wrapper">
                                        <div class="col-md-12 no-padding">
                                            <div class="col-md-3 col-sm-2 col-xs-2 no-padding"><i
                                                        class="icon-<?php echo $post->post_content;?>
                                                        large-icon"></i></div>
                                            <div class="col-md-9 col-sm-9 col-xs-9 no-padding text-left f-right"><h5
                                                        class=""><?php echo $post->post_title;?></h5>
                                                <div class="separator-line bg-yellow no-margin-lr"></div>
                                                <p class="text-med width-90">
                                                    <?php echo $arProjectsTypesCountsProjects[$post->post_title]; ?> <?php
                                                    echo numberof($countPosts, '',
                                                        array('Проект', 'Проекта', 'Проектов'));
                                                    ?>
                                                </p></div>
                                        </div>
                                    </div>
                                </div>

                                <?php
                            }

                            wp_reset_postdata();
                            ?>




                        </div>
                    </div>
                </section>
                <section class="  fix-background"
                         style=" background-image: url(http://wpdemos.themezaa.com/h-code/wp-content/uploads/2015/08/onepage-landing-img3.jpg); ">
                    <div class="selection-overlay" style=" opacity:0.7; background-color:#000000;"></div>
                    <div class="container">
                        <div class="row">
                            <div
                                class="wpb_column hcode-column-container  col-md-12 col-xs-mobile-fullwidth text-center">
                                <div class="vc-column-innner-wrapper"><h1 class="section-title  white-text
                                no-padding">
                                        <?php echo randomText()[0]; ?></h1><a href="/projects/"
                                                                                                target="_self"

                                                                              class="inner-link
                                                                              btn-small-white-background
                                                                              btn-medium  margin-top-35px
                                                                              button btn">Проекты</a></div>
                            </div>
                        </div>
                    </div>
                </section>


                <section id="pricing">
                    <div class="container">
                        <div class="row">
                            <div
                                    class="wpb_column hcode-column-container  col-md-12 col-xs-mobile-fullwidth text-center margin-five-bottom sm-margin-ten-bottom">
                                <div class="vc-column-innner-wrapper"><h1 class="section-title  black-text
                                no-padding">
                                        Тэги проекта</h1>
                                    <div class="separator-line margin-two-top" style=" background:#000000;"></div>
                                </div>
                            </div>
                            <div
                                    class="wpb_column hcode-column-container  col-md-3 col-xs-mobile-fullwidth col-sm-12 text-center no-padding xs-padding-lr-15px sm-margin-ten-bottom">
                                <div class="vc-column-innner-wrapper">
                                    <div class="pricing-box  bg-white">
                                        <div class="pricing-title"><h3 class="black-text ">
                                                <?php displayRandomElement($arPostTagsNames); ?>
                                            </h3></div>
                                        <?php /* ?>
                                        <div class="pricing-price black-text"><span class="price-unit">€</span>7<span
                                                class="price-tenure">/mo</span></div>
                                        <div class="pricing-features">
                                            <ul>
                                                <li><strong>Full</strong> Access</li>
                                                <li><i class="icon-code"></i> Source Files</li>
                                                <li><strong>100</strong> User Accounts</li>
                                                <li><strong>1 Year</strong> License</li>
                                                <li>Phone &amp; Email Support</li>
                                            </ul>
                                        </div>
                                        <div class="pricing-action"><a href="#"
                                                                       class="highlight-button btn btn-small button no-margin ">Sign
                                                Up Now!</a></div>
 <?php */ ?>
                                    </div>
                                </div>
                            </div>
                            <div
                                    class="wpb_column hcode-column-container  col-md-3 col-xs-mobile-fullwidth col-sm-12 text-center no-padding xs-padding-lr-15px sm-margin-ten-bottom">
                                <div class="vc-column-innner-wrapper">
                                    <div class="pricing-box best-price xs-margin-0auto light-gray-text2 bg-black">
                                        <div class="pricing-title"><h3 class="white-text ">
                                                <?php displayRandomElement($arPostTagsNames); ?>
                                            </h3><span
                                                    class="light-gray-text2"></span></div>

                                        <?php /* ?>
                                        <div class="pricing-price"><span class="price-unit">€</span>12<span
                                                class="price-tenure">/mo</span></div>
                                        <div class="pricing-features">
                                            <ul>
                                                <li><strong>Full</strong> Access</li>
                                                <li><i class="icon-code"></i> Source Files</li>
                                                <li><strong>1000</strong> User Accounts</li>
                                                <li><strong>2 Years</strong> License</li>
                                                <li>Phone &amp; Email Support</li>
                                                <li><i class="fa fa-star"></i><i class="fa fa-star"></i><i
                                                        class="fa fa-star"></i><i class="fa fa-star"></i><i
                                                        class="fa fa-star"></i></li>
                                            </ul>
                                        </div>

                                        <div class="pricing-action"><a href="#"
                                                                       class="btn-small-white-background btn btn-small button no-margin ">Sign
                                                Up Now!</a></div>
  <?php */ ?>
                                    </div>
                                </div>
                            </div>
                            <div
                                    class="wpb_column hcode-column-container  col-md-3 col-xs-mobile-fullwidth col-sm-12 text-center no-padding xs-padding-lr-15px sm-margin-ten-bottom">
                                <div class="vc-column-innner-wrapper">
                                    <div class="pricing-box  bg-white">
                                        <div class="pricing-title"><h3 class="black-text ">
                                                <?php displayRandomElement($arPostTagsNames); ?>
                                            </h3></div>

                                        <?php /* ?>
                                        <div class="pricing-price black-text"><span class="price-unit">€</span>19<span
                                                class="price-tenure">/mo</span></div>
                                        <div class="pricing-features">
                                            <ul>
                                                <li><strong>Full</strong> Access</li>
                                                <li><i class="icon-code"></i> Source Files</li>
                                                <li><strong>500</strong> User Accounts</li>
                                                <li><strong>3 Years</strong> License</li>
                                                <li>Phone &amp; Email Support</li>
                                            </ul>
                                        </div>
                                        <div class="pricing-action"><a href="#"
                                                                       class="highlight-button btn btn-small button no-margin ">Sign
                                                Up Now!</a></div>
 <?php */ ?>
                                    </div>
                                </div>
                            </div>
                            <div
                                    class="wpb_column hcode-column-container  no-border-right col-md-3 col-xs-mobile-fullwidth col-sm-12 no-padding xs-padding-lr-15px">
                                <div class="vc-column-innner-wrapper">
                                    <div class="pricing-box  bg-white">
                                        <div class="pricing-title"><h3 class="black-text ">
                                                <?php displayRandomElement($arPostTagsNames); ?>
                                            </h3></div>

                                        <?php /* ?>
                                        <div class="pricing-price black-text"><span class="price-unit">€</span>29<span
                                                class="price-tenure">/mo</span></div>
                                        <div class="pricing-features">
                                            <ul>
                                                <li><strong>Full</strong> Access</li>
                                                <li><i class="icon-code"></i> Source Files</li>
                                                <li><strong>1000</strong> User Accounts</li>
                                                <li><strong>5 Years</strong> License</li>
                                                <li>Phone &amp; Email Support</li>
                                            </ul>
                                        </div>
                                        <div class="pricing-action"><a href="#"
                                                                       class="highlight-button btn btn-small button no-margin ">Sign
                                                Up Now!</a></div>
 <?php */ ?>

                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>



                <section class=" " style=" background-color:#f6f6f6; ">
                    <div class="container">
                        <div class="row">
                            <div
                                class="wpb_column hcode-column-container  col-lg-7 col-md-6 col-xs-mobile-fullwidth col-sm-6 xs-margin-ten-bottom">
                                <div class="vc-column-innner-wrapper"><img
                                            class="js-img"
                                        src="" data-img="<?php displayRandomElement($arProjectMockups); ?>"
                                        width="1119" alt=""></div>
                            </div>
                            <div
                                class="wpb_column hcode-column-container  col-lg-4 col-md-offset-1 col-md-5 col-xs-mobile-fullwidth col-sm-6">
                                <div class="vc-column-innner-wrapper"><h1 class="section-title  black-text
                                 no-padding">
                                        Детальное описание проекта</h1>
                                    <div class="separator-line no-margin-lr" style=" background:#000000;"></div>
                                    <p class="text-med width-90">
                                        <?php echo $arProject["post_content_formatted"]; ?>
                                    </p>

                                    <?php if($ProjectURL){ ?>
                                    <a href="<?php echo $ProjectURL; ?>"

                                       target="_self"

                                       class="inner-link highlight-button-black-border btn-medium
                                        margin-five-top button btn">
                                        Ссылка на проект
                                    </a>
                                    <?php } ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
                <section id="specifications" class="  wow fadeIn">
                    <div class="container">
                        <div class="row">
                            <div
                                class="wpb_column hcode-column-container  col-md-12 col-xs-mobile-fullwidth text-center margin-three-bottom sm-margin-ten-bottom">
                                <div class="vc-column-innner-wrapper"><h1 class="section-title
                                black-text no-padding">
                                        специализации</h1>
                                    <div class="separator-line margin-two-top" style=" background:#000000;"></div>
                                </div>
                            </div>
                            <div
                                class="wpb_column hcode-column-container  col-md-4 col-xs-mobile-fullwidth col-sm-4 text-center margin-ten-bottom">
                                <div class="vc-column-innner-wrapper"><span
                                        class="services-number-landing font-weight-100 gray-text bg-light-yellow">01</span>
                                    <p class="text-med font-weight-600 margin-five no-margin-bottom"
                                       style="color:#000000 !important">Подготовительные работы

                                    </p>
                                    <p class="margin-two text-med width-90 center-col">

                                        <b>-</b> Обсуждение проекта, постановка целей и задач<br>
                                        <b>-</b> Составление сметы, календарного плана, заключение договора на
                                        создание сайта<br>
                                        <b>-</b> Составление технического задания и прототипов<br>

                                    </p></div>
                            </div>
                            <div
                                class="wpb_column hcode-column-container  col-md-4 col-xs-mobile-fullwidth col-sm-4 text-center margin-ten-bottom">
                                <div class="vc-column-innner-wrapper"><span
                                        class="services-number-landing font-weight-100 gray-text bg-light-yellow">02</span>
                                    <p class="text-med font-weight-600 margin-five no-margin-bottom"
                                       style="color:#000000 !important">Разработка сайта

                                    </p>
                                    <p class="margin-two text-med width-90 center-col">

                                        <b>-</b> Работы по проектированию и разработке на основании
                                        утверждённого технического задания и брифа<br>
                                        <b>-</b> Проработка структуры будущего сайта<br>
                                        <b>-</b> Выбор платформы и инструментария<br>
                                        <b>-</b> Собственно разработка<br>
                                        <b>-</b> Тестирование<br>
                                        <b>-</b> Запуск<br>

                                    </p></div>
                            </div>
                            <div
                                class="wpb_column hcode-column-container  col-md-4 col-xs-mobile-fullwidth col-sm-4 text-center margin-ten-bottom">
                                <div class="vc-column-innner-wrapper"><span
                                        class="services-number-landing font-weight-100 gray-text bg-light-yellow">03</span>
                                    <p class="text-med font-weight-600 margin-five no-margin-bottom"
                                       style="color:#000000 !important">Сопровождение сайта</p>
                                    <p class="margin-two text-med width-90 center-col">
                                        <b>-</b> Наполнение ресурса оптимизированным SEO-контентом<br>
                                        <b>-</b> Наполнение страниц информационными материалами клиента<br>
                                        <b>-</b> Редизайн элементов по желанию заказчика<br>
                                        <b>-</b> Переконфигурирование сайта<br>
                                        <b>-</b> Техническая поддержка<br>
                                    </p></div>
                            </div>
                            <div
                                class="wpb_column hcode-column-container  col-md-4 col-xs-mobile-fullwidth col-sm-4 text-center xs-margin-ten-bottom">
                                <div class="vc-column-innner-wrapper"><span
                                        class="services-number-landing font-weight-100 gray-text bg-light-yellow">04</span>
                                    <p class="text-med font-weight-600 margin-five no-margin-bottom"
                                       style="color:#000000 !important">Доработка сайта</p>
                                    <p class="margin-two text-med width-90 center-col">

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
                </section>
                <section id="testimonials" class="  cover-background wow fadeIn"
                         style=" background-image: url(http://wpdemos.themezaa.com/h-code/wp-content/uploads/2015/08/onepage-landing-img51.jpg); ">
                    <div class="selection-overlay" style=" opacity:0.8; background-color:#252525;"></div>
                    <div class="container">
                        <div class="row">
                            <div
                                class="wpb_column hcode-column-container  col-md-6 col-xs-mobile-fullwidth col-sm-10 center-col">
                                <div class="vc-column-innner-wrapper">
                                    <div class="testimonial-slider position-relative no-transition">
                                        <div id="hcode-testimonial"
                                             class="owl-pagination-bottom position-relative  round-pagination light-pagination white-cursor">


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

                                                cropImage($filename,
                                                    $_SERVER['DOCUMENT_ROOT'] . $fileNew,
                                                    300, 300);
                                                ?>




                                                <div
                                                        class="col-md-12 col-sm-12 col-xs-12 testimonial-style2 center-col text-center margin-three no-margin-top">
                                                    <img alt=""
                                                         data-image="<?php echo $fileNew; ?>"
                                                         src="" class="js-img"
                                                         width="300" height="300">
                                                    <p class="white-text text-med"><?php
                                                        $post_content = preg_replace("/\\[.+\\]/m","",
                                                            $post->post_content);
                                                        //$post_content = str_replace("\n","<br>",
                                                        //    $post_content);

                                                        echo kama_excerpt( array('text'=>$post_content,
                                                            'maxchar'=>1000,
                                                            'autop' => false) );

                                                        ?></p> <span class="name light-gray-text2"
                                                                     style="color:#ffffff"><?php echo $post->post_title; ?></span>
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
                                                singleItem: true,
                                                navigationText: ["<i class='fa fa-angle-left'></i>", "<i class='fa fa-angle-right'></i>"]
                                            });
                                        });
                                        /*]]>*/</script>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
                <section id="signup">
                    <div class="container">
                        <div class="row">
                            <div class="wpb_column hcode-column-container  col-md-5 col-xs-mobile-fullwidth col-sm-6">
                                <div class="vc-column-innner-wrapper"><h1 class="section-title
                                black-text no-padding">
                                        Детальное описание проекта</h1>
                                    <p class="text-med width-90 margin-five">
                                        <?php echo $arProject["post_content_formatted"]; ?>
                                    </p></div>
                            </div>
                            <div
                                class="wpb_column hcode-column-container  col-md-offset-2 col-md-5 col-xs-mobile-fullwidth col-sm-6">
                                <div class="vc-column-innner-wrapper">
                                    <div role="form" class="wpcf7" id="wpcf7-f5828-p53-o1" lang="en-US" dir="ltr">
                                        <div class="screen-reader-response"></div>
                                        <form action="<?php echo $_SERVER["REQUEST_URI"]; ?>" method="post"
                                              class="wpcf7-form" novalidate="novalidate">
                                            <div style="display: none;"><input type="hidden" name="_wpcf7"
                                                                               value="5828"/> <input type="hidden"
                                                                                                     name="_wpcf7_version"
                                                                                                     value="4.7"/>
                                                <input type="hidden" name="_wpcf7_locale" value="en_US"/> <input
                                                    type="hidden" name="_wpcf7_unit_tag" value="wpcf7-f5828-p53-o1"/>
                                                <input type="hidden" name="_wpnonce" value="9faee386f1"/></div>
                                            <div class="login-box no-box-shadow no-border-round bg-gray"><p
                                                    class="title-small font-weight-600 margin-five no-margin-top black-text">
                                                    Отправить сообщение</p>
                                                <div class="form-group no-margin-bottom"><span
                                                        class="wpcf7-form-control-wrap your-name">
                                                        <input type="text"

                                                               name="your-name"
                                                                                                         value=""
                                                                                                         size="40"
                                                                                                         class="wpcf7-form-control wpcf7-text wpcf7-validates-as-required"
                                                                                                         aria-required="true"
                                                                                                         aria-invalid="false"


                                                               placeholder="ВАШЕ ИМЯ"/></span>
                                                </div>
                                                <div class="form-group no-margin-bottom"><span
                                                        class="wpcf7-form-control-wrap email-251"><input type="email"
                                                                                                         name="email-251"
                                                                                                         value=""
                                                                                                         size="40"
                                                                                                         class="wpcf7-form-control wpcf7-text wpcf7-email wpcf7-validates-as-required wpcf7-validates-as-email"
                                                                                                         aria-required="true"
                                                                                                         aria-invalid="false"
                                                                                                         placeholder="ВАШ E-MAIL"/></span>
                                                </div>

                                                <div class="form-group no-margin-bottom"><span
                                                            class="wpcf7-form-control-wrap email-251"><textarea
                                                                name="your-message" cols="40" rows="2"
                                                                class="wpcf7-form-control wpcf7-textarea" aria-invalid="false"
                                                                placeholder="ВАШЕ СООБЩЕНИЕ"></textarea></span>
                                                </div>


                                                <p class="no-margin"><input type="submit" value="Отправить сообщение"
                                                                            class="wpcf7-form-control wpcf7-submit btn-success btn
                                                                             btn-medium button button-3d btn-round no-margin"/>
                                                </p></div>
                                            <div class="wpcf7-response-output wpcf7-display-none"></div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>




                <section style="border-top: 1px solid #e5e5e5;">
                    <div class="container">
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
                                    800, 500);
                                ?>

                                <div class="wpb_column hcode-column-container  col-md-3 col-xs-6 col-sm-3">
                                    <div class="vc-column-innner-wrapper"><img
                                                src=""
                                                data-image="<?php echo $fileNew; ?>"
                                                class="js-img" width="800" height="500" alt=""></div>
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
