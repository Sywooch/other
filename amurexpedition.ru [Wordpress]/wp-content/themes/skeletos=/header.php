<?php
/*
    @package Skeletos
*/
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
    <?php wp_head(); ?>
    <!---- WP HEAD ---> 



    <link href="/resourses/amurexpedition.ru/www.rgo.ru/modules/system/system.base.css" rel="stylesheet" type="text/css" />
    <link href="/resourses/amurexpedition.ru/www.rgo.ru/modules/system/system.messages.css" rel="stylesheet" type="text/css" />
    <link href="/resourses/amurexpedition.ru/www.rgo.ru/modules/system/system.theme.css" rel="stylesheet" type="text/css" />
    <link href="/resourses/amurexpedition.ru/www.rgo.ru/sites/all/libraries/mediaelement/build/mediaelementplayer.min.css" rel="stylesheet" type="text/css" />
    <link href="/resourses/amurexpedition.ru/www.rgo.ru/sites/all/modules/contrib/jquery_update/replace/ui/themes/base/minified/jquery.ui.core.min.css" rel="stylesheet" type="text/css" />
    <link href="/resourses/amurexpedition.ru/www.rgo.ru/sites/all/modules/contrib/jquery_update/replace/ui/themes/base/minified/jquery.ui.theme.min.css" rel="stylesheet" type="text/css" />
    <link href="/resourses/amurexpedition.ru/www.rgo.ru/sites/all/modules/contrib/views_slideshow/views_slideshow.css" rel="stylesheet" type="text/css" />
    <link href="/resourses/amurexpedition.ru/www.rgo.ru/sites/all/modules/contrib/jquery_update/replace/ui/themes/base/minified/jquery.ui.accordion.min.css" rel="stylesheet" type="text/css" />
    <link href="/resourses/amurexpedition.ru/www.rgo.ru/sites/all/modules/contrib/calendar/css/calendar_multiday.css" rel="stylesheet" type="text/css" />
    <link href="/resourses/amurexpedition.ru/www.rgo.ru/sites/all/modules/contrib/date/date_api/date.css" rel="stylesheet" type="text/css" />
    <link href="/resourses/amurexpedition.ru/www.rgo.ru/sites/all/modules/contrib/date/date_popup/themes/datepicker.1.7.css" rel="stylesheet" type="text/css" />
    <link href="/resourses/amurexpedition.ru/www.rgo.ru/sites/all/modules/contrib/date/date_repeat_field/date_repeat_field.css" rel="stylesheet" type="text/css" />
    <link href="/resourses/amurexpedition.ru/www.rgo.ru/modules/field/theme/field.css" rel="stylesheet" type="text/css" />
    <link href="/resourses/amurexpedition.ru/www.rgo.ru/sites/all/modules/contrib/logintoboggan/logintoboggan.css" rel="stylesheet" type="text/css" />
    <link href="/resourses/amurexpedition.ru/www.rgo.ru/modules/node/node.css" rel="stylesheet" type="text/css" />
    <link href="/resourses/amurexpedition.ru/www.rgo.ru/modules/search/search.css" rel="stylesheet" type="text/css" />
    <link href="/resourses/amurexpedition.ru/www.rgo.ru/modules/user/user.css" rel="stylesheet" type="text/css" />
    <link href="/resourses/amurexpedition.ru/www.rgo.ru/sites/all/modules/contrib/webform_confirm_email/webform_confirm_email.css" rel="stylesheet" type="text/css" />
    <link href="/resourses/amurexpedition.ru/www.rgo.ru/sites/all/modules/contrib/views/css/views.css" rel="stylesheet" type="text/css" />
    <link href="/resourses/amurexpedition.ru/www.rgo.ru/sites/all/modules/contrib/colorbox/styles/default/colorbox_style.css" rel="stylesheet" type="text/css" />
    <link href="/resourses/amurexpedition.ru/www.rgo.ru/sites/all/modules/contrib/ctools/css/ctools.css" rel="stylesheet" type="text/css" />
    <link href="/resourses/amurexpedition.ru/www.rgo.ru/sites/all/modules/contrib/genpass/genpass.css" rel="stylesheet" type="text/css" />
    <link href="/resourses/amurexpedition.ru/www.rgo.ru/sites/all/modules/contrib/ctools/css/modal.css" rel="stylesheet" type="text/css" />
    <link href="/resourses/amurexpedition.ru/www.rgo.ru/sites/all/modules/contrib/modal_forms/css/modal_forms_popup.css" rel="stylesheet" type="text/css" />
    <link href="/resourses/amurexpedition.ru/www.rgo.ru/sites/all/modules/contrib/slideshow_creator/slideshow_creator.css" rel="stylesheet" type="text/css" />
    <link href="/resourses/amurexpedition.ru/www.rgo.ru/sites/all/modules/contrib/video/css/video.css" rel="stylesheet" type="text/css" />
    <link href="/resourses/amurexpedition.ru/www.rgo.ru/sites/all/modules/contrib/compact_forms/compact_forms.css" rel="stylesheet" type="text/css" />
    <link href="/resourses/amurexpedition.ru/www.rgo.ru/sites/all/modules/contrib/views_slideshow/contrib/views_slideshow_cycle/views_slideshow_cycle.css" rel="stylesheet" type="text/css" />
    <link href="/resourses/amurexpedition.ru/www.rgo.ru/sites/all/modules/contrib/topbar_msg/topbar_msg.css" rel="stylesheet" type="text/css" />
    <link href="/resourses/amurexpedition.ru/www.rgo.ru/modules/taxonomy/taxonomy.css" rel="stylesheet" type="text/css" />

    <!--[if lt IE 10]>
    <link href="/resourses/amurexpedition.ru/www.rgo.ru/sites/default/files/ctools/css/d41d8cd98f00b204e9800998ecf8427e.css" rel="stylesheet" type="text/css" />
    <![endif]-->

    <link href="/resourses/amurexpedition.ru/www.rgo.ru/sites/all/themes/rgo2013/css/normalize.css" rel="stylesheet" type="text/css" />
    <link href="/resourses/amurexpedition.ru/www.rgo.ru/sites/all/themes/rgo2013/css/wireframes.css" rel="stylesheet" type="text/css" />
    <link href="/resourses/amurexpedition.ru/www.rgo.ru/sites/all/themes/rgo2013/css/layouts/fixed-width.css" rel="stylesheet" type="text/css" />
    <link href="/resourses/amurexpedition.ru/www.rgo.ru/sites/all/themes/rgo2013/css/tabs.css" rel="stylesheet" type="text/css" />
    <link href="/resourses/amurexpedition.ru/www.rgo.ru/sites/all/themes/rgo2013/css/blocks.css" rel="stylesheet" type="text/css" />
    <link href="/resourses/amurexpedition.ru/www.rgo.ru/sites/all/themes/rgo2013/css/navigation.css" rel="stylesheet" type="text/css" />
    <link href="/resourses/amurexpedition.ru/www.rgo.ru/sites/all/themes/rgo2013/css/views-styles.css" rel="stylesheet" type="text/css" />
    <link href="/resourses/amurexpedition.ru/www.rgo.ru/sites/all/themes/rgo2013/css/nodes.css" rel="stylesheet" type="text/css" />
    <link href="/resourses/amurexpedition.ru/www.rgo.ru/sites/all/themes/rgo2013/css/comments.css" rel="stylesheet" type="text/css" />
    <link href="/resourses/amurexpedition.ru/www.rgo.ru/sites/all/themes/rgo2013/css/forms.css" rel="stylesheet" type="text/css" />
    <link href="/resourses/amurexpedition.ru/www.rgo.ru/sites/all/themes/rgo2013/css/fields.css" rel="stylesheet" type="text/css" />
    <link href="/resourses/amurexpedition.ru/www.rgo.ru/sites/all/themes/rgo2013/css/regions.css" rel="stylesheet" type="text/css" />
    <link href="/resourses/amurexpedition.ru/www.rgo.ru/sites/all/themes/rgo2013/css/english.css" rel="stylesheet" type="text/css" />
    <link href="/resourses/amurexpedition.ru/www.rgo.ru/sites/all/themes/rgo2013/css/print.css" rel="stylesheet" type="text/css" />

    <link href="/resourses/amurexpedition.ru/www.rgo.ru/sites/all/themes/rgo2013/css/pages.css" rel="stylesheet" type="text/css" />

    <!--[if lt IE 9]>
    <script src="/sites/all/themes/zen/js/html5-respond.js"></script>
    <![endif]-->


    <link href="<?php echo get_template_directory_uri()."/style.css";?>" rel="stylesheet" type="text/css" />

<?php  ?>


    <!-- Add jQuery library -->
    <script type="text/javascript" src="https://aleksnovikov.ru/demo/popupvideo/fancybox/lib/jquery-1.10.1.min.js"></script>

    <!-- Add fancyBox main JS and CSS files -->
    <script type="text/javascript" src="https://aleksnovikov.ru/demo/popupvideo/fancybox/source/jquery.fancybox.js?v=2.1.5"></script>
    <link rel="stylesheet" type="text/css" href="https://aleksnovikov.ru/demo/popupvideo/fancybox/source/jquery.fancybox.css?v=2.1.5" media="screen" />

    <!-- Add Media helper (this is optional) -->
    <script type="text/javascript" src="https://aleksnovikov.ru/demo/popupvideo/fancybox/source/helpers/jquery.fancybox-media.js?v=1.0.6"></script>
    <script type="text/javascript" src="https://aleksnovikov.ru/demo/popupvideo/fancybox/source/helpers/jquery.video.js"></script>

    <script type="text/javascript" src="/fancybox/jquery.easing.1.3.js"></script>

    
    <script type="text/javascript">
        $(document).ready(function() {

            $(".gallery-icon a").each(function(i,elem) {
                $(this).attr("rel","group");
            });

            $(".gallery-icon a").fancybox();


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
    </script>


    <script type="text/javascript" src="/wp-content/themes/skeletos/js/functionality.js"></script>

<?php ?>

    <script type="text/javascript" src="/wp-content/plugins/ml-slider/assets/sliders/nivoslider/jquery.nivo.slider.pack.js"></script>
    <link href="/wp-content/plugins/ml-slider/assets/sliders/nivoslider/nivo-slider.css" rel="stylesheet" type="text/css" />


</head>



<body <?php body_class(); ?> style="<?php if ( is_user_logged_in() ) { echo 'margin-top:0px;';} else{echo 'margin-top:30px;'; }; ?>">




<div id="topbarmsg-wrapper"><div id="topbarmsg-container" style="background-color: rgb(0, 86, 158); color: rgb(255, 255, 255);">
        <div id="topbarmsg-content">Ответственность за информацию, размещённую на сайте, несёт председатель регионального отделения.<a href="" title="" target="_blank" id="topbarmsg-logo" style="color: rgb(243, 250, 37);"></a></div><a href="#close" id="topbarmsg-close">Закрыть</a><div id="topbarmsg-shadow"></div></div></div>


<div id="page">

    <header id="header" role="banner">

        <a href="/" title="Главная" rel="home" id="logo">
            <img src="/resourses/amurexpedition.ru/www.rgo.ru/sites/default/files/logo-black_1_0.png" alt="Главная" />
        </a>
        <a href="/" title="Амурское областное отделение" rel="region_home" id="reg_site_name">Амурское областное отделение</a>



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



                <p><a href="/%d0%ba%d0%be%d0%bd%d1%82%d0%b0%d0%ba%d1%82%d1%8b/" class="youth"><span class="icon"> </span><span class="link">Контакты</span></a></p>

            </div><!-- /.block -->

            <div id="block-views-menu-top-menu-top-reg" class="block block-views last odd">


                <div class="view view-menu-top view-id-menu_top view-display-id-menu_top_reg view-dom-id-60dc40ee5080510e1f60aa729be2eadd">



                    <?php wp_nav_menu(array('theme_location' => 'main', 'menu_class' => 'ss-list-primary-nav clearfix', 'container' => '')); ?>






                </div>
            </div><!-- /.block -->
        </div>

    </header>

