<?php
/*
    @package Skeletos
*/

$protocol = (!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off' || $_SERVER['SERVER_PORT'] == 443) ? "https://" : "http://";
$serverName = $_SERVER['SERVER_NAME'];    

?>



<!DOCTYPE html>
<!--[if IEMobile 7]><html class="iem7"  lang="ru" dir="ltr"><![endif]-->
<!--[if lte IE 6]><html class="lt-ie9 lt-ie8 lt-ie7"  lang="ru" dir="ltr"><![endif]-->
<!--[if (IE 7)&(!IEMobile)]><html class="lt-ie9 lt-ie8"  lang="ru" dir="ltr"><![endif]-->
<!--[if IE 8]><html class="lt-ie9"  lang="ru" dir="ltr"><![endif]-->
<!--[if (gte IE 9)|(gt IEMobile 7)]><!--><html  lang="ru" dir="ltr" prefix="content: http://purl.org/rss/1.0/modules/content/ dc: http://purl.org/dc/terms/ foaf: http://xmlns.com/foaf/0.1/ og: http://ogp.me/ns# rdfs: http://www.w3.org/2000/01/rdf-schema# sioc: http://rdfs.org/sioc/ns# sioct: http://rdfs.org/sioc/types# skos: http://www.w3.org/2004/02/skos/core# xsd: http://www.w3.org/2001/XMLSchema#"><!--<![endif]-->

<head>
    <meta charset="utf-8" />
    <link rel="shortcut icon" href="/resourses/amurexpedition.ru/www.rgo.ru/sites/default/files/favicon.ico"
          type="image/vnd.microsoft.icon" />
    <meta about="/" typeof="skos:Concept" property="rdfs:label skos:prefLabel" content="<?php wp_title('|', true, 'right'); ?>" />
    <link rel="alternate" type="application/rss+xml" title="RSS - <?php wp_title('|', true, 'right'); ?>"
          href="/resourses/amurexpedition.ru/www.rgo.ru/ru/taxonomy/term/997/feed" />

    <title><?php echo wp_get_document_title(); ?></title>

    <meta name="MobileOptimized" content="width">
    <meta name="HandheldFriendly" content="true">
    <meta name="viewport" content="width=device-width">
    <!--[if IEMobile]><meta http-equiv="cleartype" content="on"><![endif]-->

    <!---- WP HEAD --->

    <?php
ob_start();
 wp_head();

$dump = ob_get_clean(); 

$dump = str_replace("http://".$serverName, $protocol.$serverName, $dump);

echo $dump;

?>
    <!---- WP HEAD --->


    <!--[if lt IE 10]>
    <link href="/resourses/amurexpedition.ru/www.rgo.ru/sites/default/files/ctools/css/d41d8cd98f00b204e9800998ecf8427e.css" rel="stylesheet" type="text/css" />
    <![endif]-->







    <!--[if lt IE 9]>
    <script src="/sites/all/themes/zen/js/html5-respond.js"></script>
    <![endif]-->

    <link href=" https://www.rgo.ru/sites/all/themes/rgo2013/css/normalize.css" rel="stylesheet" type="text/css" />
    <link href="<?php echo get_template_directory_uri()."/css/add_style.css";?>" rel="stylesheet" type="text/css" />
    <link href="<?php echo get_template_directory_uri()."/style.css";?>" rel="stylesheet" type="text/css" />

    <!-- Add jQuery library -->
    <script type="text/javascript" src="<?=$protocol.$serverName;?>/wp-content/themes/skeletos/js/jquery-1.10.1.min.js"></script>

<?php if(get_the_ID() == "101"){  ?>



    <!-- Add fancyBox main JS and CSS files -->
    <script type="text/javascript" src="<?=$protocol.$serverName;?>/wp-content/themes/skeletos/js/jquery.fancybox.js?v=2.1.5"></script>
    <link rel="stylesheet" type="text/css" href="<?=$protocol.$serverName;?>/wp-content/themes/skeletos/js/jquery.fancybox.css?v=2.1.5" media="screen" />

    <!-- Add Media helper (this is optional) -->
    <script type="text/javascript" src="<?=$protocol.$serverName;?>/wp-content/themes/skeletos/js/jquery.fancybox-media.js?v=1.0.6"></script>
    <script type="text/javascript" src="<?=$protocol.$serverName;?>/wp-content/themes/skeletos/js/jquery.video.js"></script>

    <script type="text/javascript" src="<?=$protocol.$serverName;?>/fancybox/jquery.easing.1.3.js"></script>

    
    <script type="text/javascript">
        $(document).ready(function() {

            //$(".gallery-icon a").each(function(i,elem) {
            //    $(this).attr("rel","group");
            ///});

            //$(".gallery-icon a").fancybox();

            $(".huge_it_videogallery_item").each(function(i,elem) {
                $(this).removeClass("vyoutube");
                $(this).removeClass("group1");
                $(this).removeClass("vcboxElement");
            });

            $('.huge_it_videogallery_item').fancybox({
                openEffect  : 'none',
                closeEffect : 'none',
                width       : 1280,
                height      : 720,
                maxWidth    : '90%',
                maxHeight   : '90%',
                padding     : 0,
                margin      : 0,
                helpers : {
                    media : {
                        youtube : {
                            params : {
                                theme : 'light',
                                vq    : 'hd720',
                                css   : {
                                    'body' : 'color: #fff'
                                }
                            }
                        }
                    }
                }
            });

            var hash = location.hash;

            if(hash == '#autoplay'){
                $('body').find('.huge_it_videogallery_item').trigger('click');
            }
        });

        $(window).load(function () {

            $(".gallery-video-content .video-element").css("position", "static");
            $(".gallery-video-content .video-element").css("transform", "none");
            $("#huge_it_videogallery_container_moving_1").css("height", "auto");

        });

    </script>


    <script type="text/javascript" src="<?=$protocol.$serverName;?>/wp-content/themes/skeletos/js/functionality.js"></script>


<?php } ?>

    <script type="text/javascript" src="<?=$protocol.$serverName;?>/wp-content/themes/skeletos/js/script.js"></script>



    <script type="text/javascript" src="<?=$protocol.$serverName;?>/wp-content/plugins/ml-slider/assets/sliders/nivoslider/jquery.nivo.slider.pack.js"></script>
    <link href="<?=$protocol.$serverName;?>/wp-content/plugins/ml-slider/assets/sliders/nivoslider/nivo-slider.css" rel="stylesheet" type="text/css" />


    <style type="text/css">
        html{
            margin-top:0px !important;
        }
    </style>

    <script type="text/javascript" src="<?=$protocol.$serverName;?>/wp-content/themes/skeletos/js/jquery.cookie.js"></script>



    <!-- Yandex.Metrika counter -->
    <script type="text/javascript" >
        (function (d, w, c) {
            (w[c] = w[c] || []).push(function() {
                try {
                    w.yaCounter45761841 = new Ya.Metrika({
                        id:45761841,
                        clickmap:true,
                        trackLinks:true,
                        accurateTrackBounce:true
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
    <noscript><div><img src="https://mc.yandex.ru/watch/45761841" style="position:absolute; left:-9999px;" alt="" /></div></noscript>
    <!-- /Yandex.Metrika counter -->

    <script>
        (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
            (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
            m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
        })(window,document,'script','https://www.google-analytics.com/analytics.js','ga');

        ga('create', 'UA-105593092-1', 'auto');
        ga('send', 'pageview');

    </script>


</head>



<body <?php body_class(); ?> style="<?php if ( is_user_logged_in() ) { echo 'margin-top:0px;';} else{echo 'margin-top:0px;'; }; ?>" >




<!--
<div id="topbarmsg-wrapper"><div id="topbarmsg-container" style="background-color: rgb(0, 86, 158); color: rgb(255, 255, 255);">
        <div id="topbarmsg-content">Ответственность за информацию, размещённую на сайте, несёт председатель регионального отделения.<a href="" title="" target="_blank" id="topbarmsg-logo" style="color: rgb(243, 250, 37);"></a></div><a href="#close" id="topbarmsg-close">Закрыть</a><div id="topbarmsg-shadow"></div></div></div>
-->

<div id="page">

    <header id="header" role="banner">

        <a href="/" title="Главная" rel="home" id="logo">
            <img src="<?=$protocol.$serverName;?>/wp-content/uploads/small.png" alt="Главная" />
        </a>
        <a href="/" title="Амурская бассейновая комплексная экспедиция РГО" rel="region_home" id="reg_site_name">
            Амурская бассейновая комплексная экспедиция Русского географического общества
        </a>



        <div class="header__region region region-header">
            <div id="block-block-9" class="block block-block first odd">


                <!-- FB JS API -->
                <div id="fb-root"></div>
                <script>(function(d, s, id) {
                        var js, fjs = d.getElementsByTagName(s)[0];
                        if (d.getElementById(id)) return;
                        js = d.createElement(s); js.id = id;
                        js.src = "//connect.facebook.net/ru_RU/all.js#xfbml=1";
                        fjs.parentNode.insertBefore(js, fjs);
                    }(document, 'script', 'facebook-jssdk'));</script>

                <!-- VK JS API -->
                <script type="text/javascript" src="//vk.com/js/api/openapi.js?96"></script>
                <script type="text/javascript">VK.init({apiId: 3683488, onlyWidgets: true});</script>

            </div><!-- /.block -->
            <div id="block-block-7" class="block block-block even">


                <p><a href="http://ok.ru/group/52676880105689" target="_blank" class="ok">Одноклассники</a></p>
                <p><a href="https://instagram.com/rgo_1845/" target="_blank" class="inst">Instagram</a></p>
                <p><a href="https://twitter.com/rgo_ru/" target="_blank" class="twitter">Twitter</a></p>
                <p><a href="http://vk.com/rgoclub" target="_blank" class="vk">вКонтакте</a></p>
                <p><a href="http://www.facebook.com/rgoclub/" target="_blank" class="fb">Facebook</a></p>

            </div><!-- /.block -->
            <div id="block-block-3" class="block block-block odd">

                <p>
                    <a href="https://www.rgo.ru/ru/modal_forms/nojs/webform/5058" class="join">
                        <span class="icon">&nbsp;</span><span class="link">Вступить в общество</span>
                    </a>
                </p>

                <p>
                    <a href="/kontakty/" class="youth">
                        <span class="icon"> </span><span class="link">Контакты</span>
                    </a>
                </p>

            </div><!-- /.block -->

            <div id="block-views-menu-top-menu-top-reg" class="block block-views last odd">


                <div class="view view-menu-top view-id-menu_top view-display-id-menu_top_reg view-dom-id-60dc40ee5080510e1f60aa729be2eadd">



                    <?php wp_nav_menu(array('theme_location' => 'main', 'menu_class' => 'ss-list-primary-nav clearfix', 'container' => '')); ?>






                </div>
            </div><!-- /.block -->
        </div>

    </header>

