<?php
/**
 * Created by PhpStorm.
 * User: GSU
 * Date: 13.07.2017
 * Time: 13:20
 */

require $_SERVER['DOCUMENT_ROOT'] . '/wp-load.php';
include $_SERVER['DOCUMENT_ROOT'] . '/includes/head.php';

global $wpdb;
$wpdb->set_prefix('portfolio_');
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
    class="post-template-default single single-post postid-2666 single-format-image wpb-js-composer js-comp-ver-5.1 vc_responsive">
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
                <h1 class="black-text">О себе</h1></div>
            <div class="col-lg-4 col-md-5 col-sm-12 breadcrumb text-uppercase wow fadeInUp xs-display-none"
                 data-wow-duration="600ms">
                <ul class="breadcrumb-gray-text">
                    <li><a href="/" title="Browse to: Home">
                            Главная
                        </a></li>
                    <li>О себе</li>
                </ul>
            </div>
        </div>
    </div>
</section>
<section
    class="no-padding post-2666 post type-post status-publish format-image has-post-thumbnail hentry category-blog-full-width category-branding category-designing post_format-post-format-image">
    <div class="container">
        <div class="row">
            <section class="no-padding-bottom">
                <div class="container">
                    <div class="row">
                        <div class="col-md-12 col-sm-12 col-xs-12"><h2
                                class="blog-details-headline text-black entry-title">
                                О себе</h2>

                            <? /* ?>
                            <div class="blog-date no-padding-top">Posted by <span class="author vcard"><a
                                        class="url fn n"
                                        href="http://wpdemos.themezaa.com/h-code/author/admin/">admin</a></span> | <span
                                    class="published">September 23, 2015</span>
                                <time class="updated display-none" datetime="2015-12-22T11:41:49+00:00">December 22,
                                    2015
                                </time>
                                | <a class="white-text"
                                     href="http://wpdemos.themezaa.com/h-code/category/blog-full-width/"
                                     rel="category tag">Blog Full width</a>, <a class="white-text"
                                                                                href="http://wpdemos.themezaa.com/h-code/category/branding/"
                                                                                rel="category tag">Branding</a>, <a
                                    class="white-text" href="http://wpdemos.themezaa.com/h-code/category/designing/"
                                    rel="category tag">Designing</a></div>
                            <? */ ?>
                            <?php
                            $categoryId = PORTFOLIO_WP_STOCK_FOTOS_ID;

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

                            //unset($arSkills);
                            foreach ($posts as $post) {
                                setup_postdata($post);

                                $currentBackgroundImage[] = $post->post_title;

                            }


                            wp_reset_postdata();

                            ?>


                            <div class="margin-tb-30px">
                                <div class="blog-image bg-transparent">

                                    <img width="1200" height="800"
                                         data-image="<?php echo $currentBackgroundImage[0]; ?>"
                                         src=""

                                         class="attachment-full size-full wp-post-image
js-img"

                                         alt="" title=""

                                         srcset="<?php echo $currentBackgroundImage[0]; ?> 1200w,
                                         <?php echo $currentBackgroundImage[0]; ?> 300w,
                                         <?php echo $currentBackgroundImage[0]; ?> 768w,
                                         <?php echo $currentBackgroundImage[0]; ?> 1024w"

                                         sizes="(max-width: 1200px) 100vw, 1200px"/>
                                </div>
                            </div>

                            <?php
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
                            ?>



                            <div class="blog-details-text entry-content">
                                <section class="  no-padding">
                                    <div class="wpb_column hcode-column-container
                                    col-xs-mobile-fullwidth">
                                        <div class="vc-column-innner-wrapper">
                                            <p class="text-large">
                                                Как того требуют рамки сайта, я немного расскажу о себе.
                                            </p>

                                            <p>
                                                Я начал работу в сфере web-разработок в декабре 2012.
                                                Тогда я получил первый проект в качестве тестового задания
                                                для поступления в компанию. Компания тогда только-только
                                                образовалась, в ней работало меньше десятка человек.
                                                Это был первый опыт работы в офисе.
                                                В это время я изучил связку HTML, CSS, JavaScript,
                                                PHP, MySQL.
                                                Начал появляться в сети под никами GSU и Resident234.
                                            </p>



                                            <blockquote class=" blog-image"
                                                        style=" background: none repeat scroll 0 0 #f6f6f6;"><p></p>
                                                <p><?php echo $currentTitle[0];?></p>
                                                <p></p>
                                                <!--<footer></footer>-->
                                            </blockquote>


                                            <p class="text">
                                                В офисе я проработал с компанией несколько месяцев и летом 2013
                                                компания перешла в удалённый формат.
                                                Так закончилась моя офисная работа и началась удалённая.
                                                Я ближе познакомился с популярными CMS и Front-End
                                                библиотеками.
                                                В марте 2014 я получиил первый проект на CMS Битрикс.
                                                Так началось знакомство с платформой, с которой я
                                                работаю до сих пор.
                                                Потутно занялся фрилансом. В рамках фриланса у меня завелось несколько
                                                постоянных клиентов из разных регионов России.
                                                Постепенно совершенствовал свои навыки и изучил некоторые
                                                Back-End фреймворки. Некоторое время фриланс был моим основным и единственным
                                                направлением.
                                                В сентябре 2015 я решил перевести фриланс из
                                                основного направления в побочное и
                                                поработал в двух компаниях на удалённой работе.

                                            </p>

                                            <blockquote class=" blog-image"
                                                        style=" background: none repeat scroll 0 0 #f6f6f6;"><p></p>
                                                <p><?php echo $currentTitle[1];?></p>
                                                <p></p>
                                                <!--<footer></footer>-->
                                            </blockquote>

                                            <p class="text">
                                                С ноября 2016 работаю в крупной компании
                                                Битрикс-разработчиком, в основном имею дело с
                                                Back-End - ом.
                                                Постоянно совершенствую навыки.
                                                Основные направления: Angular, ReactJS,
                                                Drupal, Wordpress, Yii, Symfony.

                                            </p>
                                            <p class="text">
                                                На этом пока всё. Продолжение следует....
                                            </p>
                                        </div>
                                    </div>
                                </section>
                            </div>

                            <?php /* ?>
                            <div class="text-center margin-five no-margin-bottom about-author text-left bg-gray">
                                <div class="blog-comment text-left clearfix no-margin"><a
                                        class="comment-avtar no-margin-top"
                                        href="http://wpdemos.themezaa.com/h-code/author/admin/"> <img alt=''
                                                                                                      src='http://2.gravatar.com/avatar/eaef0864c4f9ae5d8664c3609ebd4528?s=300&#038;d=mm&#038;r=g'
                                                                                                      srcset='http://2.gravatar.com/avatar/eaef0864c4f9ae5d8664c3609ebd4528?s=600&amp;d=mm&amp;r=g 2x'
                                                                                                      class='avatar avatar-300 photo'
                                                                                                      height='300'
                                                                                                      width='300'/> </a>
                                    <div class="comment-text overflow-hidden position-relative"><h5
                                            class="widget-title">About The Author</h5>
                                        <p class="blog-date no-padding-top"><span class="author vcard"><a
                                                    class="url fn n"
                                                    href="http://wpdemos.themezaa.com/h-code/author/admin/">admin</a></span>
                                        </p>
                                        <p class="about-author-text no-margin">

                                        </p></div>
                                </div>
                            </div>
                            <div
                                class="text-center padding-four-top padding-four-bottom col-md-12 col-sm-12 col-xs-12 no-padding-lr">
                                <a class="btn social-icon social-icon-large button"
                                   href="http://www.facebook.com/sharer.php?u=http://wpdemos.themezaa.com/h-code/this-is-a-standard-post-with-a-preview-image-2/"
                                   onclick="window.open(this.href,this.title,'width=500,height=500,top=300px,left=300px');  return false;"
                                   rel="nofollow" target="_blank"
                                   title="This%20is%20a%20Standard%20post%20with%20a%20Preview%20Image"><i
                                        class="fa fa-facebook"></i></a> <a
                                    class="btn social-icon social-icon-large button"
                                    href="https://twitter.com/share?url=http://wpdemos.themezaa.com/h-code/this-is-a-standard-post-with-a-preview-image-2/"
                                    onclick="window.open(this.href,this.title,'width=500,height=500,top=300px,left=300px');  return false;"
                                    rel="nofollow" target="_blank"
                                    title="This%20is%20a%20Standard%20post%20with%20a%20Preview%20Image"><i
                                        class="fa fa-twitter"></i></a> <a
                                    class="btn social-icon social-icon-large button"
                                    href="//plus.google.com/share?url=http://wpdemos.themezaa.com/h-code/this-is-a-standard-post-with-a-preview-image-2/"
                                    target="_blank"
                                    onclick="window.open(this.href,this.title,'width=500,height=500,top=300px,left=300px');  return false;"
                                    rel="nofollow" title="This%20is%20a%20Standard%20post%20with%20a%20Preview%20Image"><i
                                        class="fa fa-google-plus"></i></a> <a
                                    class="btn social-icon social-icon-large button"
                                    href="http://linkedin.com/shareArticle?mini=true&amp;url=http://wpdemos.themezaa.com/h-code/this-is-a-standard-post-with-a-preview-image-2/&amp;title=This%20is%20a%20Standard%20post%20with%20a%20Preview%20Image"
                                    target="_blank"
                                    onclick="window.open(this.href,this.title,'width=500,height=500,top=300px,left=300px');  return false;"
                                    rel="nofollow" title="This%20is%20a%20Standard%20post%20with%20a%20Preview%20Image"><i
                                        class="fa fa-linkedin"></i></a> <a
                                    class="btn social-icon social-icon-large button"
                                    href="//pinterest.com/pin/create/button/?url=http://wpdemos.themezaa.com/h-code/this-is-a-standard-post-with-a-preview-image-2/&amp;media=http://wpdemos.themezaa.com/h-code/wp-content/uploads/2015/09/big-portfolio-img14.jpg&amp;description=This%20is%20a%20Standard%20post%20with%20a%20Preview%20Image"
                                    onclick="window.open(this.href,this.title,'width=500,height=500,top=300px,left=300px');  return false;"
                                    rel="nofollow" target="_blank"
                                    title="This%20is%20a%20Standard%20post%20with%20a%20Preview%20Image"><i
                                        class="fa fa-pinterest"></i></a></div>
 <?php */ ?>


                            <div class="next-previous-project xs-display-none">
                                <div class="next-project">
                                    <a rel="next"
                                                             href="/info/main/">
                                        <img
                                            alt="Основные сведения" class="next-project-img"
                                            src="<?php echo PERSONAL_WP_HCODE_URL; ?>/h-code/wp-content/themes/h-code/assets/images/next-project.png"
                                            width="33" height="83"><span>Основные сведения</span>
                                        <img alt="Основные сведения"
                                             data-image="<?php echo $currentBackgroundImage[1]; ?>"
                                             src=""
                                             class="js-img"
                                        ></a>
                                </div>
                                <div class="previous-project">
                                    <a rel="prev"
                                                                 href="/info/experience/">
                                        <img
                                            alt="Опыт работы"
                                            class="js-img"
                                            data-image="<?php echo $currentBackgroundImage[2]; ?>"
                                            src="">

                                        <img
                                            alt="Опыт работы"
                                            class="previous-project-img"
                                            src="<?php echo PERSONAL_WP_HCODE_URL; ?>/h-code/wp-content/themes/h-code/assets/images/previous-project.png"
                                            width="33" height="83">
                                        <span>Опыт работы</span>
                                    </a></div>
                            </div>




                            <?php /* ?>
                            <div id="comments" class="comments-area border-top  padding-ten-top">
                                <div id="respond" class="comment-respond">
                                    <h3 id="reply-title" class="comment-reply-title">Add a comment
                                        <small><a rel="nofollow" id="cancel-comment-reply-link"
                                                  href="/h-code/this-is-a-standard-post-with-a-preview-image-2/#respond"
                                                  style="display:none;">Cancel Reply</a></small>
                                    </h3>
                                    <form action="http://wpdemos.themezaa.com/h-code/wp-comments-post.php" method="post"
                                          id="commentform" class="comment-form" novalidate><input id="author"
                                                                                                  name="author"
                                                                                                  type="text"
                                                                                                  onfocus="return inputfocus(this.id);"
                                                                                                  placeholder="NAME *"
                                                                                                  value="" size="30"/>
                                        <input id="email" name="email" type="text" onfocus="return inputfocus(this.id);"
                                               placeholder="EMAIL *" value="" size="30" required/> <input id="url"
                                                                                                          name="url"
                                                                                                          type="text"
                                                                                                          placeholder="WEBSITE"
                                                                                                          value=""
                                                                                                          size="30"/><textarea
                                            id="comment" name="comment" onfocus="return inputfocus(this.id);"
                                            placeholder="COMMENT *" aria-required="true"></textarea><span
                                            class="required">*Please complete all fields correctly</span>
                                        <p class="form-submit"><input name="submit" type="submit" id="submit"
                                                                      class="highlight-button-dark btn btn-small no-margin-bottom submit comment-button"
                                                                      value="send message"/> <input type='hidden'
                                                                                                    name='comment_post_ID'
                                                                                                    value='2666'
                                                                                                    id='comment_post_ID'/>
                                            <input type='hidden' name='comment_parent' id='comment_parent' value='0'/>
                                        </p></form>
                                </div>
                            </div>
                            <? */ ?>




                        </div>
                    </div>
                </div>
            </section>
            <section class="no-padding clear-both">
                <div class="container">
                    <div class="row">
                        <div class="wpb_column hcode-column-container col-md-12 no-padding">
                            <div
                                class="hcode-divider border-top xs-no-padding-bottom xs-padding-five-top margin-five-top padding-five-bottom"></div>
                        </div>
                        <div
                            class="col-md-12 col-sm-12 center-col text-center margin-eight no-margin-top xs-padding-ten-top">
                            <h3 class="blog-single-full-width-h3">
                                Реализованные проекты
                            </h3></div>
                        <div class="blog-grid-listing padding-ten-bottom col-md-12 col-sm-12 col-xs-12 no-padding">



                            <?php
                            $categoryId = PORTFOLIO_WP_CATEGORY_PROJECTS_ID;

                            $args = array(
                                'numberposts' => 3000,
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
                            unset($arProjectsMain);

                            $count = 1;
                            foreach ($posts as $post) {

                                $private = get_post_meta($post->ID, 'PRIVATE');

                                //?mode=private
                                if ((!isset($_SESSION["mode"]) || ($_SESSION["mode"] != "private")) &&
                                    ($private[0] == "1")
                                ) {
                                    continue;
                                }

                                setup_postdata($post);


                                $gal = get_post_gallery($post->ID, false);
                                $arIDs = explode(',', $gal['ids']);

                                foreach ($arIDs as $keyImageID => $itemImageID) {

                                    $arMetaImage = wp_get_attachment_metadata($itemImageID);

                                    $thumb_img = get_post($itemImageID);

                                    if ($thumb_img->post_excerpt == "PERSONAL_MOCKUP") {

                                        $arProjects[] = PORTFOLIO_WP_UPLOAD_DIR_URL . "/" . $arMetaImage["file"];


                                        $idImage = get_post_thumbnail_id($post->ID);
                                        $image_attributes = wp_get_attachment_image_src($idImage, full);

                                        $image_attributes[0] = str_replace(get_site_url(),
                                            PORTFOLIO_WP_URL, $image_attributes[0]);
                                        ?>
                                        <div
                                                class="post-2666 post type-post status-publish format-image
                                                has-post-thumbnail hentry category-blog-full-width category-branding
                                                category-designing post_format-post-format-image">
                                            <div
                                                    class="col-md-4 col-sm-4 col-xs-12 blog-listing
                                                    no-margin-bottom xs-margin-bottom-ten wow fadeInUp animated"
                                                    data-wow-duration="300ms"
                                                    style="visibility: visible; animation-duration: 300ms; animation-name: fadeInUp;">


                                                <div class="blog-image"><a
                                                            href="/detail/<?php echo $arDetailTemplates[wp_rand(0, count($arDetailTemplates) - 1)]; ?>?ID=<?php echo $post->ID; ?>"><img
                                                                width="374" height="234"
                                                                src=""

                                                                class="attachment-hcode-related-post size-hcode-related-post wp-post-image
js-img"
                                                                data-image="<?php echo $image_attributes[0];?>"
                                                                alt="" title=""
                                                                srcset="<?php echo $image_attributes[0];?> 374w,
                                                                <?php echo $image_attributes[0];?> 300w,
                                                                <?php echo $image_attributes[0];?> 768w,
                                                                <?php echo $image_attributes[0];?> 133w,
                                                                <?php echo $image_attributes[0];?> 800w"
                                                                sizes="(max-width: 374px) 100vw, 374px"/></a></div>
                                                <div class="blog-details no-padding">
                                                    <div class="blog-date">

                                                        <?php
                                                        $arPostTags = wp_get_post_tags($post->ID);
                                                        foreach ($arPostTags as $keyTag => $tag) {

                                                            $postTagId = $tag->term_id;
                                                            $postTagName = $tag->name;
                                                            echo $postTagName;
                                                            if($keyTag < count($arPostTags) - 1){
                                                                echo ", ";
                                                            }
                                                        }
                                                        ?>
                                                    </div>
                                                    <div class="blog-title entry-title"><a
                                                                href="/detail/<?php echo $arDetailTemplates[wp_rand(0, count($arDetailTemplates) - 1)]; ?>?ID=<?php echo $post->ID; ?>">
                                                            <?php echo $post->post_title;?>
                                                        </a></div>
                                                    <div class="blog-short-description entry-content">
                                                        <?php
                                        echo kama_excerpt($post->post_content);
                                        ?>
                                                    </div>
                                                    <div class="separator-line bg-black no-margin-lr"></div>
                                                </div>
                                                <?php /* ?>
                                                <div>
                                                    <a href="http://wpdemos.themezaa.com/h-code/wp-admin/admin-ajax.php?action=process_simple_like&nonce=e23c6882bb&post_id=10472&disabled=true&is_comment=0"
                                                       class="sl-button blog-like sl-button-10472" data-nonce="e23c6882bb"
                                                       data-post-id="10472" data-iscomment="0" title="Like"><i
                                                                class="fa fa-heart-o"></i>53 Likes</a><a
                                                            href="http://wpdemos.themezaa.com/h-code/post-with-featured-picture-6/#respond"
                                                            class="comment"><i class="fa fa-comment-o">

                                                        </i>Leave a comment</a></div>
                                                 <?php */ ?>
                                            </div>
                                        </div>


                                        <?
                                        $arProjectsMain[] = $image_attributes[0];
                                        if($count == 3) break 2;
                                        $count++;
                                    } else {
                                        if ($thumb_img->post_excerpt == "PERSONAL_MOCKUP_2") {

                                            $arProjectsMockups[] = PORTFOLIO_WP_UPLOAD_DIR_URL . "/" . $arMetaImage["file"];

                                        }
                                    }

                                }


                            }


                            wp_reset_postdata();
                            ?>






                        </div>
                    </div>
                </div>
            </section>
        </div>
    </div>
</section>
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
<script type="text/javascript">/*<![CDATA[*/
    $(document).ready(function () {
        //var $buythemediv = '<div class="buy-theme xs-display-none"><a href="http://themeforest.net/item/hcode-responsive-multipurpose-wordpress-theme/14561695?ref=themezaa" target="_blank"><span>Purchase Theme</span></a></div><div class="quick-question xs-display-none"><a href="mailto:info@themezaa.com?subject=H-Code WordPress Theme Quick Question"><span>Quick Question?</span></a></div>';
        //$('body').append($buythemediv);
    });
    /*]]>*/</script>
<script type="text/javascript"
        src="/includes/js/images.js"></script>

</body>
</html>
