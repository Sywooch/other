<?php
/**
 * Created by PhpStorm.
 * User: GSU
 * Date: 29.07.2017
 * Time: 13:47
 */


require $_SERVER['DOCUMENT_ROOT'] . '/wp-load.php';
include $_SERVER['DOCUMENT_ROOT'] . '/includes/head.php';

global $wpdb;
$wpdb->set_prefix('portfolio_');


include $_SERVER['DOCUMENT_ROOT'] . '/includes/feedback_send.php';

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
<body class="page-template-default page page-id-64 wpb-js-composer js-comp-ver-5.1 vc_responsive">
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
            <div class="col-md-8 no-padding-right accordion-menu text-right pull-right menu-position-right">
                <div id="mega-menu" class="navbar-collapse collapse navbar-right">
                    <ul id="menu-onepage" class="mega-menu-ul nav navbar-nav navbar-right panel-group">
                        <?php
                        include $_SERVER['DOCUMENT_ROOT'] . '/includes/main_menu.php';
                        ?>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</nav>
<section class="parent-section no-padding post-64 page type-page status-publish hentry">
    <div class="container-fluid">
        <div class="row">
            <div class="entry-content">
                <section id="slider" class="  no-padding">
                    <div class="container-fluid">
                        <div class="row">
                            <div class="wpb_column hcode-column-container  col-xs-mobile-fullwidth">
                                <div class="vc-column-innner-wrapper">
                                    <div id="hcode-bootstrap-slider1"
                                         class="carousel no-padding slide carousel-slide round-pagination light-pagination dark-navigation cursor-black  hcode-bootstrap-slider1 ">
                                        <ol class="carousel-indicators">
                                            <li data-target="#hcode-bootstrap-slider1" data-slide-to="0"></li>
                                            <li data-target="#hcode-bootstrap-slider1" data-slide-to="1"></li>
                                            <li data-target="#hcode-bootstrap-slider1" data-slide-to="2"></li>
                                        </ol>
                                        <div class="carousel-inner">


                                            <div class="item full-screen">
                                                <div class="fill js-background"
                                                     data-image="<? displayRandomElement($currentBackgroundImage);?>"
                                                     style="background-image:url()"></div>
                                                <div class="opacity-full bg-white display-none xs-display-block"></div>
                                                <div class="container">
                                                    <div class="row">
                                                        <div class="container full-screen position-relative">
                                                            <div class="slider-typography">
                                                                <div class="slider-text-middle-main">
                                                                    <div
                                                                            class="slider-text-middle slider-text-middle6 padding-left-right-px wow fadeInUp slider-text">
                                                                        <div
                                                                                class="col-md-3 col-sm-5 col-xs-6 text-left animated fadeInUp no-padding">
                                                                            <h1 class="alt-font"><?php echo $arProject["post_title"];?></h1>
                                                                            <div
                                                                                    class="separator-line bg-yellow no-margin-lr"></div>
                                                                            <p><span class="no-margin"><?php displayRandomElement($arPostTagsNames); ?></span>
                                                                            </p> <a
                                                                                    class="highlight-button btn inner-link no-margin-lr no-margin-bottom"
                                                                                    href="/projects/" target="_self">Проекты</a></div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="item full-screen">
                                                <div class="fill js-background"
                                                     data-image="<? displayRandomElement($currentBackgroundImage);?>"
                                                     style="background-image:url()"></div>
                                                <div class="opacity-full bg-white display-none xs-display-block"></div>
                                                <div class="container">
                                                    <div class="row">
                                                        <div class="container full-screen position-relative">
                                                            <div class="slider-typography">
                                                                <div class="slider-text-middle-main">
                                                                    <div
                                                                        class="slider-text-middle slider-text-middle6 padding-left-right-px wow fadeInUp slider-text">
                                                                        <div
                                                                            class="col-md-3 col-sm-5 col-xs-6 text-left animated fadeInUp no-padding">
                                                                            <h1 class="alt-font"><?php echo get_post_meta($arProject["ID"], 'YEAR')[0]; ?></h1>
                                                                            <div
                                                                                class="separator-line bg-yellow no-margin-lr"></div>
                                                                            <p><span class="no-margin"><?php displayRandomElement($arPostTagsNames); ?></span>
                                                                            </p> <a
                                                                                class="highlight-button btn inner-link no-margin-lr no-margin-bottom"
                                                                                href="/sertificates/" target="_self">Сертификаты</a></div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="item full-screen">
                                                <div class="fill js-background"
                                                     data-image="<? displayRandomElement($currentBackgroundImage);?>"
                                                     style="background-image:url()"></div>
                                                <div class="opacity-full bg-white display-none xs-display-block"></div>
                                                <div class="container">
                                                    <div class="row">
                                                        <div class="container full-screen position-relative">
                                                            <div class="slider-typography">
                                                                <div class="slider-text-middle-main">
                                                                    <div
                                                                        class="slider-text-middle slider-text-middle6 padding-left-right-px wow fadeInUp slider-text">
                                                                        <div
                                                                            class="col-md-3 col-sm-5 col-xs-6 text-left animated fadeInUp no-padding">
                                                                            <h1 class="alt-font"><?php displayRandomElement($arPostTagsNames); ?></h1>
                                                                            <div
                                                                                class="separator-line bg-yellow no-margin-lr"></div>
                                                                            <p><span class="no-margin"><?php displayRandomElement($arPostTagsNames); ?></span>
                                                                            </p> <a
                                                                                class="highlight-button btn inner-link no-margin-lr no-margin-bottom"
                                                                                href="/skills/" target="_self">Навыки</a></div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                        </div>
                                        <a class="left carousel-control" href="#hcode-bootstrap-slider1"
                                           data-slide="prev"><img
                                                src="http://wpdemos.themezaa.com/h-code/wp-content/themes/h-code/assets/images/arrow-pre.png"
                                                alt=""/></a><a class="right carousel-control"
                                                               href="#hcode-bootstrap-slider1" data-slide="next"><img
                                                src="http://wpdemos.themezaa.com/h-code/wp-content/themes/h-code/assets/images/arrow-next.png"
                                                alt=""/></a></div>
                                    <script type="text/javascript">jQuery(document).ready(function () {
                                            jQuery("#hcode-bootstrap-slider1").carousel({
                                                interval: false,
                                                pause: false,
                                            });
                                        });</script>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>


                <section id="features">
                    <div class="container">
                        <div class="row">
                            <div
                                class="wpb_column hcode-column-container  col-md-12 col-xs-mobile-fullwidth text-center">
                                <div class="vc-column-innner-wrapper"><h3 class="section-title  black-text">
                                        Основные этапы
                                    </h3></div>
                            </div>



                            <?php
                            include $_SERVER['DOCUMENT_ROOT'] . '/includes/detail_iterations.php';
                            ?>





                            <div class="wpb_column hcode-column-container  col-md-12 col-xs-mobile-fullwidth col-sm-12">
                                <div class="vc-column-innner-wrapper">
                                    <div class="wide-separator-line margin-eight no-margin-lr"
                                         style=" background:#e5e5e5;"></div>
                                </div>
                            </div>



                            <div
                                class="wpb_column hcode-column-container  col-md-5 col-xs-mobile-fullwidth
                                text-center center-col margin-five-bottom">
                                <div class="vc-column-innner-wrapper"><h4 class="gray-text">
                                        <?php echo $currentDetailTitle[0]; ?>
                                    </h4></div>
                            </div>


                            <?php
                            include $_SERVER['DOCUMENT_ROOT'] . '/includes/detail_key_person_projects.php';
                            ?>




                        </div>
                    </div>
                </section>



                <section class="  no-padding-top">
                    <div class="container">
                        <div class="row">
                            <div
                                class="wpb_column hcode-column-container  col-xs-mobile-fullwidth text-center center-col">
                                <div class="vc-column-innner-wrapper">
                                    <h5 class="section-title  black-text no-padding">
                                       Вы можете заказать разработку аналогичного проекта
                                    </h5><a href="/feedback/project/" target="_self"

                                            class="inner-link highlight-button-black-border btn-large margin-four-top
                                            btn-extra-large button btn">
                                        Обратная связь
                                    </a></div>
                            </div>
                        </div>
                    </div>
                </section>

                <?php
                include $_SERVER['DOCUMENT_ROOT'] . '/includes/detail_section_slider_projects-3.php';
                ?>



                <section id="animated-tab">
                    <div class="container">
                        <div class="row">
                            <div
                                class="wpb_column hcode-column-container  col-md-12 col-xs-mobile-fullwidth text-center">
                                <div class="vc-column-innner-wrapper"><h3 class="section-title  black-text">
                                        Специализации</h3></div>
                            </div>
                            <div
                                class="wpb_column hcode-column-container  col-md-12 col-xs-mobile-fullwidth text-center center-col no-margin">
                                <div class="vc-column-innner-wrapper">





                                    <div id="animated-tab1" class="hcode-animated-tabs animated-tab1">
                                        <ul class="nav nav-tabs margin-five no-margin-top xs-margin-bottom-seven text-center">


                                            <li class="nav active">
                                                <a href="#hcode-1501303620-1103046314-0"
                                                   data-toggle="tab"><span>
                                                        <i class="icon-tools-2"></i></span></a>
                                            </li>
                                            <li class="nav"><a href="#hcode-1501303620-1103046314-1"
                                                               data-toggle="tab"><span><i
                                                                class="icon-desktop"></i></span></a></li>
                                            <li class="nav"><a href="#hcode-1501303620-1103046314-2"
                                                               data-toggle="tab"><span><i
                                                                class="icon-cloud"></i></span></a></li>




                                        </ul>
                                        <div class="tab-content">
                                            <div
                                                class="col-md-9 col-sm-12 text-center center-col tab-pane fade in active"
                                                id="hcode-1501303620-1103046314-0">
                                                <div class="row">
                                                    <div class="col-md-6 col-sm-12 text-left gray-text"><h5>
                                                            Back-End
                                                        </h5>
                                                        <div
                                                            class="separator-line bg-yellow no-margin-lr sm-margin-five"></div>
                                                        <p class="text-large margin-five margin-right-ten">
                                                            Пишу убойный код на многих языках
                                                        </p>
                                                    </div>
                                                    <div class="col-md-6 col-sm-12 text-left text-med gray-text"><p
                                                            class="text-uppercase">Обладаю большим набором инструментария</p>
                                                        <p class="no-margin">Перфекционист</p></div>
                                                </div>
                                                <div class="row">
                                                    <div class="wide-separator-line"></div>
                                                </div>
                                                <div class="row">
                                                    <div
                                                        class="col-md-12 col-sm-12 text-center service-year black-text">
                                                        <strong>Yii, Symfony, Zend Framework, Drupal, Bitrix,
                                                            Wordpress</strong>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="wide-separator-line"></div>
                                                </div>
                                                <div class="row">

                                                    <?php
                                                    $arProjectsTypesCountsProjectsReturn = getKeyValueRandomElement($arProjectsTypesCountsProjects);
                                                    ?>
                                                    <div
                                                        class="col-md-4 col-sm-4 bottom-margin text-center counter-section xs-margin-ten-bottom">
                                                        <span class="counter-number black-text"
                                                              data-to="<?php echo $arProjectsTypesCountsProjectsReturn[1];?>">
                                                            <?php echo $arProjectsTypesCountsProjectsReturn[1];?>
                                                        </span><span
                                                            class="counter-title">
                                                            <?php echo $arProjectsTypesCountsProjectsReturn[0];?> </span></div>

                                                    <?php
                                                    $arProjectsTypesCountsProjectsReturn = getKeyValueRandomElement($arProjectsTypesCountsProjects);
                                                    ?>
                                                    <div
                                                        class="col-md-4 col-sm-4 bottom-margin text-center counter-section xs-margin-ten-bottom">
                                                        <span class="counter-number black-text"
                                                              data-to="<?php echo $arProjectsTypesCountsProjectsReturn[1];?>">
                                                            <?php echo $arProjectsTypesCountsProjectsReturn[1];?>
                                                        </span><span
                                                                class="counter-title">
                                                            <?php echo $arProjectsTypesCountsProjectsReturn[0];?> </span></div>

                                                    <?php
                                                    $arProjectsTypesCountsProjectsReturn = getKeyValueRandomElement($arProjectsTypesCountsProjects);
                                                    ?>
                                                    <div
                                                        class="col-md-4 col-sm-4 bottom-margin text-center counter-section">
                                                        <span class="counter-number black-text"
                                                              data-to="<?php echo $arProjectsTypesCountsProjectsReturn[1];?>">
                                                            <?php echo $arProjectsTypesCountsProjectsReturn[1];?>
                                                        </span><span
                                                                class="counter-title">
                                                            <?php echo $arProjectsTypesCountsProjectsReturn[0];?></span>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-9 col-sm-12 text-center center-col tab-pane fade"
                                                 id="hcode-1501303620-1103046314-1">
                                                <div class="row">
                                                    <div class="col-md-6 col-sm-12 text-left gray-text"><h5>
                                                            Front-End
                                                        </h5>
                                                        <div
                                                            class="separator-line bg-yellow no-margin-lr sm-margin-five"></div>
                                                        <p class="text-large margin-five margin-right-ten">
                                                            Эксперт HTML, CSS и JavaScript
                                                        </p>
                                                    </div>
                                                    <div class="col-md-6 col-sm-12 text-left text-med gray-text"><p
                                                            class="text-uppercase">
                                                            Совершенствуюсь и адаптируюсь к
                                                            постоянно развивающимся технологиям
                                                        </p>
                                                        <p class="no-margin">
                                                            Имею опыт работы с React и Redux
                                                        </p></div>
                                                </div>
                                                <div class="row">
                                                    <div class="wide-separator-line"></div>
                                                </div>
                                                <div class="row">
                                                    <div
                                                        class="col-md-12 col-sm-12 text-center service-year black-text">
                                                        <strong>AngularJS, Bootstrap, React</strong>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="wide-separator-line"></div>
                                                </div>
                                                <div class="row">

                                                    <?php
                                                    $arProjectsTypesCountsProjectsReturn = getKeyValueRandomElement($arProjectsTypesCountsProjects);
                                                    ?>
                                                    <div
                                                            class="col-md-4 col-sm-4 bottom-margin text-center counter-section xs-margin-ten-bottom">
                                                        <span class="counter-number black-text"
                                                              data-to="<?php echo $arProjectsTypesCountsProjectsReturn[1];?>">
                                                            <?php echo $arProjectsTypesCountsProjectsReturn[1];?>
                                                        </span><span
                                                                class="counter-title">
                                                            <?php echo $arProjectsTypesCountsProjectsReturn[0];?> </span></div>

                                                    <?php
                                                    $arProjectsTypesCountsProjectsReturn = getKeyValueRandomElement($arProjectsTypesCountsProjects);
                                                    ?>
                                                    <div
                                                            class="col-md-4 col-sm-4 bottom-margin text-center counter-section xs-margin-ten-bottom">
                                                        <span class="counter-number black-text"
                                                              data-to="<?php echo $arProjectsTypesCountsProjectsReturn[1];?>">
                                                            <?php echo $arProjectsTypesCountsProjectsReturn[1];?>
                                                        </span><span
                                                                class="counter-title">
                                                            <?php echo $arProjectsTypesCountsProjectsReturn[0];?> </span></div>

                                                    <?php
                                                    $arProjectsTypesCountsProjectsReturn = getKeyValueRandomElement($arProjectsTypesCountsProjects);
                                                    ?>
                                                    <div
                                                            class="col-md-4 col-sm-4 bottom-margin text-center counter-section">
                                                        <span class="counter-number black-text"
                                                              data-to="<?php echo $arProjectsTypesCountsProjectsReturn[1];?>">
                                                            <?php echo $arProjectsTypesCountsProjectsReturn[1];?>
                                                        </span><span
                                                                class="counter-title">
                                                            <?php echo $arProjectsTypesCountsProjectsReturn[0];?></span>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-9 col-sm-12 text-center center-col tab-pane fade"
                                                 id="hcode-1501303620-1103046314-2">
                                                <div class="row">
                                                    <div class="col-md-6 col-sm-12 text-left gray-text"><h5>
                                                            DB</h5>
                                                        <div
                                                            class="separator-line bg-yellow no-margin-lr sm-margin-five"></div>
                                                        <p class="text-large margin-five margin-right-ten">
                                                            Страсть к программированию, изучениию, исследованию
                                                            и переработке новых технологий</p></div>
                                                    <div class="col-md-6 col-sm-12 text-left text-med gray-text"><p
                                                            class="text-uppercase">Принимаю концепцию итеративного развития</p>
                                                        <p class="no-margin">Прилагаю все усилия для выполнения работы</p></div>
                                                </div>
                                                <div class="row">
                                                    <div class="wide-separator-line"></div>
                                                </div>
                                                <div class="row">
                                                    <div
                                                        class="col-md-12 col-sm-12 text-center service-year black-text">
                                                        <strong>MySQL</strong>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="wide-separator-line"></div>
                                                </div>
                                                <div class="row">

                                                    <?php
                                                    $arProjectsTypesCountsProjectsReturn = getKeyValueRandomElement($arProjectsTypesCountsProjects);
                                                    ?>
                                                    <div
                                                            class="col-md-4 col-sm-4 bottom-margin text-center counter-section xs-margin-ten-bottom">
                                                        <span class="counter-number black-text"
                                                              data-to="<?php echo $arProjectsTypesCountsProjectsReturn[1];?>">
                                                            <?php echo $arProjectsTypesCountsProjectsReturn[1];?>
                                                        </span><span
                                                                class="counter-title">
                                                            <?php echo $arProjectsTypesCountsProjectsReturn[0];?> </span></div>

                                                    <?php
                                                    $arProjectsTypesCountsProjectsReturn = getKeyValueRandomElement($arProjectsTypesCountsProjects);
                                                    ?>
                                                    <div
                                                            class="col-md-4 col-sm-4 bottom-margin text-center counter-section xs-margin-ten-bottom">
                                                        <span class="counter-number black-text"
                                                              data-to="<?php echo $arProjectsTypesCountsProjectsReturn[1];?>">
                                                            <?php echo $arProjectsTypesCountsProjectsReturn[1];?>
                                                        </span><span
                                                                class="counter-title">
                                                            <?php echo $arProjectsTypesCountsProjectsReturn[0];?> </span></div>

                                                    <?php
                                                    $arProjectsTypesCountsProjectsReturn = getKeyValueRandomElement($arProjectsTypesCountsProjects);
                                                    ?>
                                                    <div
                                                            class="col-md-4 col-sm-4 bottom-margin text-center counter-section">
                                                        <span class="counter-number black-text"
                                                              data-to="<?php echo $arProjectsTypesCountsProjectsReturn[1];?>">
                                                            <?php echo $arProjectsTypesCountsProjectsReturn[1];?>
                                                        </span><span
                                                                class="counter-title">
                                                            <?php echo $arProjectsTypesCountsProjectsReturn[0];?></span>
                                                    </div>
                                                </div>
                                            </div>

                                        </div>
                                    </div>







                                </div>
                            </div>
                        </div>
                    </div>
                </section>



                <?php
                include $_SERVER['DOCUMENT_ROOT'] . '/includes/detail_chart-percent.php';
                ?>


                <?php
                include $_SERVER['DOCUMENT_ROOT'] . '/includes/detail_portfolio.php';
                ?>

                <?php
                include $_SERVER['DOCUMENT_ROOT'] . '/includes/detail_section_development_process.php';
                ?>

                <?php
                include $_SERVER['DOCUMENT_ROOT'] . '/includes/detail_blog_projects.php';
                ?>




                <section class=" " style=" background-color:#000000; ">
                    <div class="container">
                        <div class="row">



                            <?php
                            include $_SERVER['DOCUMENT_ROOT'] . '/includes/portfolio_grid_gallery.php';
                            ?>


                            <?php
                            $i = 1;
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



                                $filename = $thumb_url_full[0];
                                $new_filen = $_SERVER["DOCUMENT_ROOT"].'/wp-content/uploads/' . basename($filename);

                                $height = 89;

                                $width = 350;

                                $fileNew = "/wp-content/uploads/" . basename($filename);


                                $fileNew = cropImage($filename,
                                    $_SERVER['DOCUMENT_ROOT'] . $fileNew,
                                    $width, $height);


                                $arPostTags = wp_get_post_tags($post->ID);
                                ?>



                                <div class="wpb_column hcode-column-container  col-md-3 col-xs-6 col-sm-3 padding-five-lr">
                                    <div class="vc-column-innner-wrapper"><img
                                                src="" class="js-img"
                                                data-image="<?php echo $fileNew; ?>"
                                                width="350" height="89" alt=""></div>
                                </div>


                                <?php

                                if($i == 4) break;
                                $i++;
                            }
                            ?>



                        
                        </div>
                    </div>
                </section>

                <?php
                include $_SERVER['DOCUMENT_ROOT'] . '/includes/detail_contact-us.php';
                ?>

                <?php
                include $_SERVER['DOCUMENT_ROOT'] . '/includes/detail_parallax-fix_parallax3.php';
                ?>


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


</body>
</html>