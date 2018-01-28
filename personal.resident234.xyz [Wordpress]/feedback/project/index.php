<?php
/**
 * Created by PhpStorm.
 * User: GSU
 * Date: 15.07.2017
 * Time: 23:08
 */

require $_SERVER['DOCUMENT_ROOT'] . '/wp-load.php';
include $_SERVER['DOCUMENT_ROOT'] . '/includes/head.php';

global $wpdb;
$wpdb->set_prefix('portfolio_');




if($_POST["_wpcf7_is_ajax_call"]){


    /**************************/
    ob_start();


    echo "<pre>";
    print_r($_POST);
    echo "</pre>";


    $dump = ob_get_clean();


    $filename = $_SERVER['DOCUMENT_ROOT'] . '/dump.txt';
    if (!file_exists($filename)) {
        $f = fopen($filename, 'w+');
        fclose($f);
    }
    file_put_contents($filename, $dump );//FILE_APPEND
    /**************************/



$attachments = array();
$headers = 'From: Персональный сайт <null@'.$_SERVER["SERVER_NAME"].'>' . "\r\n";
$body = "<b>Имя:</b> ".$_POST["your-name"]."\r\n";
$body = $body."<b>E-mail:</b> ".$_POST["email-771"]."\r\n";

    $body = $body."<b>Название организации:</b> ".$_POST["your-name1"]."\r\n";
    $body = $body."<b>Телефон:</b> ".$_POST["your-name3"]."\r\n";
    $body = $body."<b>Skype:</b> ".$_POST["your-skype"]."\r\n";
    $body = $body."<b>Тип сайта:</b> ".$_POST["menu-272"]."\r\n";
    $body = $body."<b>Существующий сайт:</b> ".$_POST["your-name5"]."\r\n";
    $body = $body."<b>Планируемый адрес сайта:</b> ".$_POST["your-name6"]."\r\n";
    $body = $body."<b>Желаемая дата сдачи проекта:</b> ".$_POST["your-name712"]."\r\n";
    $body = $body."<b>Целевая аудитория:</b> ".$_POST["your-name7"]."\r\n";
    $body = $body."<b>Цели создания сайта:</b> ".$_POST["your-message8"]."\r\n";
    $body = $body."<b>Сайты конкурентов:</b> ".$_POST["your-name92"]."\r\n";
    $body = $body."<b>Обязательные функции сайта:</b> ".$_POST["your-message103"]."\r\n";
    $body = $body."<b>Требуется ли интеграция с другими системами:</b> ".$_POST["your-name52"]."\r\n";
    $body = $body."<b>Есть ли наработки или корпоративный стиль, который нужно применить:</b> ".$_POST["menu-838"]."\r\n";
    $body = $body."<b>Cсылки на сайты, которые понравились:</b> ".$_POST["your-name9"]."\r\n";
    $body = $body."<b>Цветовая гамма:</b> ".$_POST["your-name11"]."\r\n";


$body = $body."Комментарий: ".$_POST["your-message"]."\r\n";



wp_mail('gsu1234@mail.ru', 'Сообщение с формы заказа проекта', $body, $headers, $attachments);

die();

}

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
<body class="page-template-default page page-id-157 wpb-js-composer js-comp-ver-5.1 vc_responsive">
<nav class="navbar navbar-default navbar-fixed-top nav-transparent overlay-nav sticky-nav transparent-header nav-border-bottom  nav-white "
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

<?php

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

<section class="page-title parallax3 parallax-fix page-title-large"><img class="parallax-background-img"
                                                                         src="<?php echo $currentBackgroundImage[0]; ?>"
         data-image="<?php echo $currentBackgroundImage[0]; ?>"
                                                                         alt=""/>
    <div class="opacity-medium bg-black"></div>
    <div class="container">
        <div class="row">
            <div class="col-md-12 col-sm-12 text-center animated fadeInUp">
                <div class="separator-line bg-yellow no-margin-top margin-four"></div>
                <h1 class="white-text">
Форма заказа проекта
</h1><span class="white-text">
Заполните форму, чтобы я мог сделать наиболее точное предложение по вашим требованиям. Поля не отмеченные меткой (обязательно), не являются обязательными, но всё же для лучшего взаимопонимания стоит их заполнить. 
</span>
            </div>
        </div>
    </div>
</section>




<section class="parent-section no-padding post-157 page type-page status-publish hentry">
    <div class="container-fluid">
        <div class="row"><h2 class="entry-title display-none">Forms &#038; Controls</h2>
            <div class="entry-content">
                <section>
                    <div class="container">
                        <div class="row">
                            <div class="wpb_column hcode-column-container  col-md-7 col-xs-mobile-fullwidth col-sm-10 text-center center-col margin-ten-bottom xs-margin-seven-bottom">
                                <div class="vc-column-innner-wrapper"><h6
                                            class="section-title  margin-ten-bottom xs-margin-0auto black-text no-padding">
                                        Заказать разработку</h6></div>
                            </div>
                            <div class="wpb_column hcode-column-container  col-md-7 col-xs-mobile-fullwidth col-sm-10 text-center center-col">
                                <div class="vc-column-innner-wrapper">
                                    <div role="form" class="wpcf7" id="wpcf7-f2638-p115-o1"
                                         lang="en-US" dir="ltr">
                                        <div class="screen-reader-response"></div>
                                        <p class="text-med js-success-message display-none">
                                            Ваше сообщение отправлено успешно
                                        </p>
                                        <p class="text-med js-error-message
                                        error-message display-none">

                                        </p>

                                        <form action="<?php echo $_SERVER["REQUEST_URI"]; ?>"
                                              method="post"
                                              class="wpcf7-form" novalidate="novalidate">
                                            <div style="display: none;">
                                                <input type="hidden" name="_wpcf7"
                                                       value="2638"/>
                                                <input type="hidden"
                                                       name="_wpcf7_version"
                                                       value="4.7"/>
                                                <input type="hidden" name="_wpcf7_locale"
                                                       value="en_US"/> <input
                                                        type="hidden" name="_wpcf7_unit_tag"
                                                        value="wpcf7-f2638-p115-o1"/>
                                                <input type="hidden" name="_wpnonce"
                                                       value="6f656aad08"/></div>
                                            <div class="no-margin">






                                                <span
                                                        class="wpcf7-form-control-wrap
                                                    your-name">




                                                    <input type="text"
                                                           name="your-name"
                                                           value="" size="40"
                                                           class="wpcf7-form-control wpcf7-text wpcf7-validates-as-required"
                                                           aria-required="true"
                                                           aria-invalid="false"
                                                           placeholder="Ваше имя"/></span><br/>





                                                <span
                                                        class="wpcf7-form-control-wrap
                                                    your-name">

                                                    <input type="text"
                                                           name="your-name1"
                                                           value="" size="40"
                                                           class="wpcf7-form-control wpcf7-text wpcf7-validates-as-required"
                                                           aria-required="true"
                                                           aria-invalid="false"
                                                           placeholder="Название организации"/></span><br/>






                                                <span class="wpcf7-form-control-wrap
                                                email-771"><input type="email"

                                                                  name="email-771"
                                                                  value=""
                                                                  size="40"
                                                                  class="wpcf7-form-control wpcf7-text wpcf7-email wpcf7-validates-as-required wpcf7-validates-as-email"
                                                                  aria-required="true"
                                                                  aria-invalid="false"
                                                                  placeholder="Ваш e-mail"/></span><br/>







                                                <span
                                                        class="wpcf7-form-control-wrap
                                                    your-name">

                                                    <input type="text"
                                                           name="your-name3"
                                                           value="" size="40"
                                                           class="wpcf7-form-control wpcf7-text wpcf7-validates-as-required"
                                                           aria-required="true"
                                                           aria-invalid="false"
                                                           placeholder="Телефон"/></span><br/>












                                                <span
                                                        class="wpcf7-form-control-wrap
                                                    your-name">

                                                    <input type="text"
                                                           name="your-skype"
                                                           value="" size="40"
                                                           class="wpcf7-form-control wpcf7-text wpcf7-validates-as-required"
                                                           aria-required="true"
                                                           aria-invalid="false"
                                                           placeholder="Skype"/></span><br/>


                                                <p>Тип будущего сайта<br><span
                                                            class="wpcf7-form-control-wrap menu-272"><select
                                                                name="menu-272"
                                                                class="wpcf7-form-control wpcf7-select wpcf7-validates-as-required"
                                                                aria-required="true" aria-invalid="false">
                                                <?php

                                                $categoryId = PORTFOLIO_WP_CATEGORY_SITES_ID;

                                                $args = array(
                                                    'numberposts' => 999,
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

                                                    <option
                                                            value="<?php echo $post->post_title;?>">
                                                        <?php echo $post->post_title;?>
                                                    </option>


                                                    <?php
                                                }

                                                wp_reset_postdata();
                                                ?>





                                                        </select></span>

                                                </p>







<!--++++++++-->
                                                <span
                                                        class="wpcf7-form-control-wrap
                                                    your-name">

                                                    <input type="text"
                                                           name="your-name5"
                                                           value="" size="40"
                                                           class="wpcf7-form-control wpcf7-text wpcf7-validates-as-required"
                                                           aria-required="true"
                                                           aria-invalid="false"
                                                           placeholder="Существующий сайт (если есть)"/></span><br/>



                                                <!--++++++++-->


                                                <!--++++++++-->
                                                <span
                                                        class="wpcf7-form-control-wrap
                                                    your-name">

                                                    <input type="text"
                                                           name="your-name6"
                                                           value="" size="40"
                                                           class="wpcf7-form-control wpcf7-text wpcf7-validates-as-required"
                                                           aria-required="true"
                                                           aria-invalid="false"
                                                           placeholder="Планируемый адрес сайта"/></span><br/>



                                                <!--++++++++-->
                                                <!--++++++++-->
                                                <span
                                                        class="wpcf7-form-control-wrap
                                                    your-name">

                                                    <input type="text"
                                                           name="your-name712"
                                                           value="" size="40"
                                                           class="wpcf7-form-control wpcf7-text wpcf7-validates-as-required"
                                                           aria-required="true"
                                                           aria-invalid="false"
                                                           placeholder="Желаемая дата сдачи проекта"/></span><br/>



                                                <!--++++++++-->


                                                <!--++++++++-->
                                                <span
                                                        class="wpcf7-form-control-wrap
                                                    your-name">

                                                    <input type="text"
                                                           name="your-name7"
                                                           value="" size="40"
                                                           class="wpcf7-form-control wpcf7-text wpcf7-validates-as-required"
                                                           aria-required="true"
                                                           aria-invalid="false"
                                                           placeholder="Целевая аудитория"/></span><br/>



                                                <!--++++++++-->

                                                <!--++++++++-->
                                                <span
                                                        class="wpcf7-form-control-wrap
                                                    your-name">

                                                  <textarea
                                                          name="your-message8" cols="40" rows="10"
                                                          class="wpcf7-form-control wpcf7-textarea"
                                                          aria-invalid="false"
                                                  placeholder="Цели создания сайта"></textarea></span><br/>



                                                <!--++++++++-->

                                                <!--++++++++-->
                                                <span
                                                        class="wpcf7-form-control-wrap
                                                    your-name">

                                                    <input type="text"
                                                           name="your-name92"
                                                           value="" size="40"
                                                           class="wpcf7-form-control wpcf7-text wpcf7-validates-as-required"
                                                           aria-required="true"
                                                           aria-invalid="false"
                                                           placeholder="Сайты конкурентов"/></span><br/>



                                                <!--++++++++-->


                                                <!--++++++++-->
                                                <span
                                                        class="wpcf7-form-control-wrap
                                                    your-name">

                                                  <textarea
                                                          name="your-message103" cols="40" rows="10"
                                                          class="wpcf7-form-control wpcf7-textarea"
                                                          aria-invalid="false"
                                                  placeholder="Обязательные функции сайта"></textarea></span><br/>



                                                <!--++++++++-->


                                                <!--++++++++-->
                                                <span
                                                        class="wpcf7-form-control-wrap
                                                    your-name">

                                                    <input type="text"
                                                           name="your-name52"
                                                           value="" size="40"
                                                           class="wpcf7-form-control wpcf7-text wpcf7-validates-as-required"
                                                           aria-required="true"
                                                           aria-invalid="false"
                                                           placeholder="Требуется интеграция с другими системами ?"/></span><br/>



                                                <!--++++++++-->




                                                <p>Есть ли наработки или корпоративный стиль, который нужно применить<br><span
                                                            class="wpcf7-form-control-wrap menu-838"><select
                                                                name="menu-838"
                                                                class="wpcf7-form-control wpcf7-select wpcf7-validates-as-required"
                                                                aria-required="true" aria-invalid="false">


                                              <option
                                                      value="Да">Да</option><option
                                                                    value="Нет">Нет</option></select></span>

                                                </p>


                                                <!--++++++++-->



                                                <!--++++++++-->
                                                <span
                                                        class="wpcf7-form-control-wrap
                                                    your-name">

                                                    <input type="text"
                                                           name="your-name9"
                                                           value="" size="40"
                                                           class="wpcf7-form-control wpcf7-text wpcf7-validates-as-required"
                                                           aria-required="true"
                                                           aria-invalid="false"
                                                           placeholder="Ссылки на сайты, которые Вам понравились"/></span><br/>



                                                <!--++++++++-->

                                                <!--++++++++-->
                                                <span
                                                        class="wpcf7-form-control-wrap
                                                    your-name">

                                                    <input type="text"
                                                           name="your-name11"
                                                           value="" size="40"
                                                           class="wpcf7-form-control wpcf7-text wpcf7-validates-as-required"
                                                           aria-required="true"
                                                           aria-invalid="false"
                                                           placeholder="Цветовая гамма"/></span><br/>



                                                <!--++++++++-->

                                                <span class="wpcf7-form-control-wrap
                                                your-message"><textarea
                                                            name="your-message" cols="40" rows="10"
                                                            class="wpcf7-form-control wpcf7-textarea"
                                                            aria-invalid="false"
                                                            placeholder="Комментарий"></textarea>
                                                </span><br/>





                                                <input
                                                        type="submit" value="Отправить"
                                                        class="wpcf7-form-control
                                                    wpcf7-submit highlight-button-dark
                                                    btn btn-small button xs-margin-bottom-five"/>
                                            </div>
                                            <div class="wpcf7-response-output
                                             wpcf7-display-none"></div>
                                        </form>
                                    </div>



                                </div>
                            </div>
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




<script type="text/javascript"
        src="/includes/js/images.js"></script>
<script type="text/javascript"
        src="/includes/js/form.js"></script>


</body>
</html>