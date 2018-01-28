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
                file_put_contents($filename, $dump, FILE_APPEND);//
                /**************************/

if($_POST["_wpcf7_is_ajax_call"]){

$attachments = array();
$headers = 'From: Персональный сайт <null@'.$_SERVER["SERVER_NAME"].'>' . "\r\n";
$body = "Имя: ".$_POST["your-name"]."\r\n";
$body = $body."E-mail: ".$_POST["email-771"]."\r\n";
$body = $body."Сообщение: ".$_POST["your-message"]."\r\n";


wp_mail('gsu1234@mail.ru', 'Сообщение с формы обратной связи', $body, $headers, $attachments);

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

    <script type='text/javascript'
            src='/libs/jquery-validation/dist/jquery.validate.js'></script>



</head>
<body class="page-template-default page page-id-115 wpb-js-composer js-comp-ver-5.1 vc_responsive">
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
<section
    class="content-top-margin page-title-section page-title page-title-small border-bottom-light border-top-light bg-white">
    <div class="container">
        <div class="row">
            <div class="col-lg-8 col-md-7 col-sm-12 animated fadeInUp">
                <h1 class="black-text">Обратная связь</h1>
            </div>
            <div class="col-lg-4 col-md-5 col-sm-12 breadcrumb text-uppercase wow
            fadeInUp xs-display-none"
                 data-wow-duration="600ms">
                <ul class="breadcrumb-gray-text">
                    <li><a href="/" title="Browse to: Home">Главная</a></li>
                    <li>Обратная связь</li>
                </ul>
            </div>
        </div>
    </div>
</section>
<section class="parent-section no-padding post-115 page type-page status-publish hentry">
    <div class="container-fluid">
        <div class="row"><h2 class="entry-title display-none">Обратная связь</h2>
            <div class="entry-content">
                <section class="  no-padding">
                    <div class="container-fluid">
                        <div class="row">
                            <div class="wpb_column hcode-column-container  col-xs-mobile-fullwidth no-padding">
                                <div class="vc-column-innner-wrapper">
                                    <div id="canvas1" class="contact-map map">
                                        <!--src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3151.843821917424!2d144.956054!3d-37.817127!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x6ad65d4c2b349649%3A0xb6899234e561db11!2sEnvato!5e0!3m2!1sen!2sin!4v1427947693651"-->

                                        <iframe id="map_canvas1"

                                        src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d41961826.997137904!2d92.56205828413495!3d50.06481483671859!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x5e89410b323173ef%3A0x7a0166a4885065b0!2z0JHQu9Cw0LPQvtCy0LXRidC10L3RgdC6LCDQkNC80YPRgNGB0LrQsNGPINC-0LHQuy4sIDY3NTAwOQ!5e0!3m2!1sru!2sru!4v1500129745569"

                                        width="300" height="150"></iframe>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
                <section>
                    <div class="container">
                        <div class="row">



                            <div
                                class="wpb_column hcode-column-container  col-md-12
                                col-xs-mobile-fullwidth col-sm-12 xs-margin-three-bottom">
                                <div class="vc-column-innner-wrapper">
                                    <div class="" id="a">
                                        <div class="position-relative">
                                            <a href="https://www.google.ru/maps/place/%D0%91%D0%BB%D0%B0%D0%B3%D0%BE%D0%B2%D0%B5%D1%89%D0%B5%D0%BD%D1%81%D0%BA,+%D0%90%D0%BC%D1%83%D1%80%D1%81%D0%BA%D0%B0%D1%8F+%D0%BE%D0%B1%D0%BB.,+675009/@50.6256888,114.3589333,3z/data=!4m18!1m12!4m11!1m6!1m2!1s0x5e89410b323173ef:0x7a0166a4885065b0!2s675009!2m2!1d127.5453844!2d50.2633927!1m3!2m2!1d131.5622746!2d50.4994591!3m4!1s0x5e89410b323173ef:0x7a0166a4885065b0!8m2!3d50.2633927!4d127.5453844?hl=ru"
                                                                          target="_blank">
                                                <img alt=""

                                                     class="js-img"
                                                     data-image="http://unpictures.ru/images/1407795_nochnoi-blagoveschensk.jpg"
                                                     src=""

                                                     ></a><a
                                                class="highlight-button-dark btn btn-very-small
                                                view-map no-margin bg-black white-text"
                                                href="https://www.google.ru/maps/place/%D0%91%D0%BB%D0%B0%D0%B3%D0%BE%D0%B2%D0%B5%D1%89%D0%B5%D0%BD%D1%81%D0%BA,+%D0%90%D0%BC%D1%83%D1%80%D1%81%D0%BA%D0%B0%D1%8F+%D0%BE%D0%B1%D0%BB.,+675009/@50.6256888,114.3589333,3z/data=!4m18!1m12!4m11!1m6!1m2!1s0x5e89410b323173ef:0x7a0166a4885065b0!2s675009!2m2!1d127.5453844!2d50.2633927!1m3!2m2!1d131.5622746!2d50.4994591!3m4!1s0x5e89410b323173ef:0x7a0166a4885065b0!8m2!3d50.2633927!4d127.5453844?hl=ru"
                                                target="_blank">Открыть карту</a>
                                        </div>
                                        <p class="text-med black-text letter-spacing-1
                                        margin-ten no-margin-bottom text-uppercase
                                        font-weight-600 xs-margin-top-five">
                                        Благовещенск
                                        </p>
                                        <p class="no-margin">
                                        РФ, Амурская обл.
                                        </p>
                                        <div class="wide-separator-line bg-mid-gray no-margin-lr"></div>
                                        <p class="black-text no-margin-bottom"><strong>Skype</strong>
                                            <a
                                                href="skype:gsu_residet234">gsu_residet234</a></p>
                                        <p class="black-text"><strong>E.</strong>
                                            <a href="mailto:gsu1234@mail.ru">gsu1234@mail.ru</a>
                                        </p></div>
                                </div>
                            </div>






                        </div>
                    </div>
                </section>

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

                <section class="  cover-background wow fadeIn js-background"
                         style=" background-image: url(); "
                data-image="<?php echo $currentBackgroundImage[0]; ?>">
                    <div class="selection-overlay" style=" opacity:0.7; background-color:#252525;">

                    </div>
                    <div class="container">
                        <div class="row">
                            <div
                                class="wpb_column hcode-column-container  col-md-5
                                col-xs-mobile-fullwidth col-sm-6 text-center center-col">
                                <div class="vc-column-innner-wrapper">
                                    <p
                                        class="title-large text-uppercase letter-spacing-1
                                        white-text font-weight-600">
                                        Вы можете заказать разработку по ссылке ниже
                                        </p>
                                    <a href="/feedback/project/"

                                       target="_self"

                                       class="inner-link btn-small-white btn-medium
                                       margin-six-top sm-margin-eight-top xs-margin-five-top
                                       button btn">Форма заказа проекта</a></div>
                            </div>
                        </div>
                    </div>
                </section>
                <section id="contact-us">
                    <div class="container">
                        <div class="row">
                            <div class="wpb_column hcode-column-container  col-md-4 col-xs-mobile-fullwidth col-sm-6">
                                <div class="vc-column-innner-wrapper"><p
                                        class="text-med text-uppercase letter-spacing-1
                                        black-text font-weight-600">
                                        Контактная форма</p>
                                    <p class="text-med">
                                        Вы можете мне написать и я вам обязательно что-нибудь отвечу
                                    </p>
                                    <p class="text-med">

                                    </p>
                                </div>
                            </div>
                            <div
                                class="wpb_column hcode-column-container
                                col-md-offset-2 col-md-6 col-xs-mobile-fullwidth col-sm-6">
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
                                            <div class="no-margin"><span
                                                    class="wpcf7-form-control-wrap
                                                    your-name">
                                                    <input type="text"
                                                                                                     name="your-name"
                                                                                                     value="" size="40"
                                                                                                     class="wpcf7-form-control wpcf7-text wpcf7-validates-as-required"
                                                                                                     aria-required="true"
                                                                                                     aria-invalid="false"
                                                                                                     placeholder="ВАШЕ ИМЯ"/></span><br/>
                                                <span class="wpcf7-form-control-wrap
                                                email-771"><input type="email"

                                                                                                       name="email-771"
                                                                                                       value=""
                                                                                                       size="40"
                                                                                                       class="wpcf7-form-control wpcf7-text wpcf7-email wpcf7-validates-as-required wpcf7-validates-as-email"
                                                                                                       aria-required="true"
                                                                                                       aria-invalid="false"
                                                                                                       placeholder="ВАШ EMAIL"/></span><br/>
                                                <span class="wpcf7-form-control-wrap
                                                your-message"><textarea
                                                        name="your-message" cols="40" rows="2"
                                                        class="wpcf7-form-control wpcf7-textarea"
                                                        aria-invalid="false"
                                                        placeholder="ВАШЕ СООБЩЕНИЕ"></textarea>
                                                </span><br/> <input
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

        /*
        $(".wpcf7-form").validate({
            rules: {
                // simple rule, converted to {required:true}
                your-name: "required",
                // compound rule
                email-771: {
                    required: true,
                        email: true
                }
            }
        });*/


    });
    /*]]>*/</script>


<script type="text/javascript"
        src="/includes/js/images.js"></script>
<script type="text/javascript"
        src="/includes/js/form.js"></script>

</body>
</html>