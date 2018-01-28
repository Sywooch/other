<?php
/**
 * Created by PhpStorm.
 * User: GSU
 * Date: 19.07.2017
 * Time: 1:49
 */

require $_SERVER['DOCUMENT_ROOT'] . '/wp-load.php';
include $_SERVER['DOCUMENT_ROOT'] . '/includes/head.php';

global $wpdb;
$wpdb->set_prefix('portfolio_');



?>


<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>

    <title>Рассчитать стоимость сайта</title>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    <meta name="keywords" content="стоимость сайта на Битрикс" />
    <meta name="description" content="Наш калькулятор поможет ответить на вопрос как рассчитать стоимость сайта на Битрикс" />
    <link href="/includes/calculator/kernel_main.css?149993246131472" type="text/css"  rel="stylesheet" />
    <link href="/includes/calculator/page_8f12dcb8df7b0ca7a5a373a36837eea5.css?14999323177585" type="text/css"  rel="stylesheet" />
    <link href="/includes/calculator/template_ae08aa683e385b071d0fefbe15739e05.css?1499956262115192" type="text/css"
          data-template-style="true"  rel="stylesheet" />
    <script type="text/javascript">if(!window.BX)window.BX={};if(!window.BX.message)window.BX.message=function(mess){if(typeof mess=='object') for(var i in mess) BX.message[i]=mess[i]; return true;};</script>
    <script type="text/javascript">(window.BX||top.BX).message({'JS_CORE_LOADING':'Загрузка...','JS_CORE_NO_DATA':'- Нет данных -','JS_CORE_WINDOW_CLOSE':'Закрыть','JS_CORE_WINDOW_EXPAND':'Развернуть','JS_CORE_WINDOW_NARROW':'Свернуть в окно','JS_CORE_WINDOW_SAVE':'Сохранить','JS_CORE_WINDOW_CANCEL':'Отменить','JS_CORE_WINDOW_CONTINUE':'Продолжить','JS_CORE_H':'ч','JS_CORE_M':'м','JS_CORE_S':'с','JSADM_AI_HIDE_EXTRA':'Скрыть лишние','JSADM_AI_ALL_NOTIF':'Показать все','JSADM_AUTH_REQ':'Требуется авторизация!','JS_CORE_WINDOW_AUTH':'Войти','JS_CORE_IMAGE_FULL':'Полный размер'});</script>
    <script type="text/javascript">(window.BX||top.BX).message({'LANGUAGE_ID':'ru','FORMAT_DATE':'DD.MM.YYYY','FORMAT_DATETIME':'DD.MM.YYYY HH:MI:SS','COOKIE_PREFIX':'BITRIX_SM','SERVER_TZ_OFFSET':'10800','SITE_ID':'s1','SITE_DIR':'/','USER_ID':'','SERVER_TIME':'1500396519','USER_TZ_OFFSET':'0','USER_TZ_AUTO':'Y','bitrix_sessid':'ec0bfe2d33d866b3e921e731e9fb2974'});</script>


    <script type="text/javascript" src="/includes/calculator/kernel_main.js?1499932461281311"></script><!---->
 
   <script type="text/javascript"
    src="/includes/calculator/template_11580d626b1382ba94fd67cca0bf8117.js?1499949460276805"></script> <!---->
    <script type="text/javascript" src="/includes/calculator/page_8e5124adc632e0858eb79c810f5c51c5.js?14999323176508"></script>


    <?php
    include $_SERVER['DOCUMENT_ROOT'] . '/includes/head_css.php';
    include $_SERVER['DOCUMENT_ROOT'] . '/includes/head_custom_css.php';
    include $_SERVER['DOCUMENT_ROOT'] . '/includes/head_main.php';
    ?>
</head>
<body  class="page-template-default page page-id-115 wpb-js-composer js-comp-ver-5.1 vc_responsive">



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
                        include $_SERVER['DOCUMENT_ROOT'] . '/includes/main_menu_calculator.php';
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
                <h1 class="black-text">Калькулятор стоимости проекта</h1>
            </div>
            <div class="col-lg-4 col-md-5 col-sm-12 breadcrumb text-uppercase wow
            fadeInUp xs-display-none"
                 data-wow-duration="600ms">
                <ul class="breadcrumb-gray-text">
                    <li><a href="/" title="Browse to: Home">Главная</a></li>
                    <li>Калькулятор стоимости проекта</li>
                </ul>
            </div>
        </div>
    </div>
</section>



<section class="parent-section no-padding post-114 page type-page status-publish hentry">
    <div class="container-fluid">
        <div class="row"><h2 class="entry-title display-none">Калькулятор</h2>
            <div class="entry-content">
                <section class="  parallax-fix parallax8 no-padding"
                         style=" background-image: url(https://static.pexels.com/photos/53621/calculator-calculation-insurance-finance-53621.jpeg); ">
                    <div class="container">
                        <div class="row">
                            <div class="wpb_column hcode-column-container  pull-right col-md-7 col-xs-mobile-fullwidth col-sm-7 padding-six"
                                 style=" background:#e6af2a;">
                                <div class="vc-column-innner-wrapper">
                                    <h1 class="white-text sm-small-text">
                                        Калькулятор

                                    </h1>
                                    <p class="text-large black-text margin-five">
                                        Используя калькулятор, Вы можете рассчитать ориентировочную стоимость сайта.

                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
                






<div id="wrap">

    <div class="container container_calc">
        <div class="aside">





        </div>
        <div class="content">




            <div id="config"> 		<div class="title">
                    <!-- <p class="headline">Конфигуратор сайта</p>-->
                </div>


                <div class="conf-container">
                    <div class="left-conf">
                        <div class="sect">
                            <ul class="tbs">
                                <li class="current first_tab">
                                    <div class="pricing-title">
                                        <h3 class="black-text ">Сайт-визитка</h3>
                                    </div>
                                </li>
                                <li>
                                    <div class="pricing-title">
                                        <h3 class="black-text ">Интернет-магазин</h3>
                                    </div>
                                </li>
                                <li>
                                    <div class="pricing-title">
                                        <h3 class="black-text ">Корпоративный сайт</h3>
                                    </div>
                                </li>



                            </ul>


                            <div class="bx visible">

                                <div class="column">






                                    <p class='click_toggle inner-link btn-small-black-border-light btn-small  margin-right-20px sm-margin-right-20px xs-margin-five-bottom button btn'><span>Основной функционал</span></p>									<ul class="toggle">



                                        <li><label><input type="checkbox"  checked="checked"  name="Основной функционал*Установка и настройка Битрикс" value="2200"/><span>Установка и настройка Битрикс</span></label></li>





                                        <li><label><input type="checkbox"  checked="checked"  name="Основной функционал*Разработка структуры и карты сайта" value="2200"/><span>Разработка структуры и карты сайта</span></label></li>





                                        <li><label><input type="checkbox"  checked="checked"  name="Основной функционал*Размещение контента до 5 стр. («О Компании», «Контакты»)" value="2900"/><span>Размещение контента до 5 стр. («О Компании», «Контакты»)</span></label></li>





                                        <li><label><input type="checkbox"  name="Основной функционал*Каталог услуг с описанием" value="4200"/><span>Каталог услуг с описанием</span></label></li>





                                        <li><label><input type="checkbox"  name="Основной функционал*Детальное описание услуги" value="1900"/><span>Детальное описание услуги</span></label></li>





                                        <li><label><input type="checkbox"  name="Основной функционал*Форма обратной связи" value="1100"/><span>Форма обратной связи</span></label></li>





                                        <li><label><input type="checkbox"  name="Основной функционал*Фотогалерея + лайтбокс" value="4100"/><span>Фотогалерея + лайтбокс</span></label></li>





                                        <li><label><input type="checkbox"  name="Основной функционал*Поиск по сайту" value="1900"/><span>Поиск по сайту</span></label></li>





                                        <li><label><input type="checkbox"  name="Основной функционал*Баннерокрутилка (слайдер)" value="2100"/><span>Баннерокрутилка (слайдер)</span></label></li>





                                        <li><label><input type="checkbox"  name="Основной функционал*Навигация по сайту" value="1900"/><span>Навигация по сайту</span></label></li>





                                        <li><label><input type="checkbox"  name="Основной функционал*Интеграция с Google Maps или Яндекс.Картами" value="1100"/><span>Интеграция с Google Maps или Яндекс.Картами</span></label></li>





                                        <li><label><input type="checkbox"  name="Основной функционал*Новости сайта" value="1900"/><span>Новости сайта</span></label></li>





                                        <li><label><input type="checkbox"  name="Основной функционал*Вопрос-ответ" value="2500"/><span>Вопрос-ответ</span></label></li>





                                        <li><label><input type="checkbox"  name="Основной функционал*Информеры" value="1900"/><span>Информеры</span></label></li>





                                        <li><label><input type="checkbox"  checked="checked"  name="Основной функционал*Статьи" value="1900"/><span>Статьи</span></label></li>





                                        <li><label><input type="checkbox"  name="Основной функционал*Размещение, воспроизведение видеороликов" value="1500"/><span>Размещение, воспроизведение видеороликов</span></label></li>





                                        <li><label><input type="checkbox"  name="Основной функционал*Авторизация / регистрация через социальные сети" value="2500"/><span>Авторизация / регистрация через социальные сети</span></label></li>





                                        <li><label><input type="checkbox"  name="Основной функционал*Личный кабинет" value="20000"/><span>Личный кабинет</span></label></li>





                                        <li><label><input type="checkbox"  name="Основной функционал*Загрузка из CSV, XLS" value="6000"/><span>Загрузка из CSV, XLS</span></label></li>




                                    </ul>




                                    <p class='click_toggle inner-link btn-small-black-border-light btn-small  margin-right-20px sm-margin-right-20px xs-margin-five-bottom button btn'><span>Дополнительный функционал</span></p>									<ul class="toggle">



                                        <li><label><input type="checkbox"  name="Дополнительный функционал*Сортировка" value="5040"/><span>Сортировка</span></label></li>





                                        <li><label><input type="checkbox"  name="Дополнительный функционал*Облако тегов" value="5040"/><span>Облако тегов</span></label></li>





                                        <li><label><input type="checkbox"  name="Дополнительный функционал*Фильтр" value="6720"/><span>Фильтр</span></label></li>





                                        <li><label><input type="checkbox"  name="Дополнительный функционал*ЧПУ (человеко-понятный УРЛ)" value="1680"/><span>ЧПУ (человеко-понятный УРЛ)</span></label></li>





                                        <li><label><input type="checkbox"  name="Дополнительный функционал*Подписка/рассылка" value="1680"/><span>Подписка/рассылка</span></label></li>





                                        <li><label><input type="checkbox"  name="Дополнительный функционал*Google Analytics, Яндекс.Метрика" value="1680"/><span>Google Analytics, Яндекс.Метрика</span></label></li>





                                        <li><label><input type="checkbox"  name="Дополнительный функционал*Интеграция виджетов социальных сетей (Like)" value="1680"/><span>Интеграция виджетов социальных сетей (Like)</span></label></li>





                                        <li><label><input type="checkbox"  name="Дополнительный функционал*Интеграция виджетов социальных сетей группы" value="1680"/><span>Интеграция виджетов социальных сетей группы</span></label></li>





                                        <li><label><input type="checkbox"  name="Дополнительный функционал*Автопубликация контента в социальных сетях" value="1680"/><span>Автопубликация контента в социальных сетях</span></label></li>





                                        <li><label><input type="checkbox"  name="Дополнительный функционал*Опросы" value="1680"/><span>Опросы</span></label></li>





                                        <li><label><input type="checkbox"  name="Дополнительный функционал*Блок" value="3360"/><span>Блок</span></label></li>





                                        <li><label><input type="checkbox"  name="Дополнительный функционал*Форум" value="1680"/><span>Форум</span></label></li>





                                        <li><label><input type="checkbox"  name="Дополнительный функционал*Архив новостей, статей" value="1680"/><span>Архив новостей, статей</span></label></li>





                                        <li><label><input type="checkbox"  name="Дополнительный функционал*Интерактивный календарь" value="3360"/><span>Интерактивный календарь</span></label></li>





                                        <li><label><input type="checkbox"  name="Дополнительный функционал*Гостевая книга" value="1680"/><span>Гостевая книга</span></label></li>





                                        <li><label><input type="checkbox"  name="Дополнительный функционал*Настройка многосайтовости" value="5040"/><span>Настройка многосайтовости</span></label></li>





                                        <li><label><input type="checkbox"  name="Дополнительный функционал*Подписка на новости RSS" value="1900"/><span>Подписка на новости RSS</span></label></li>





                                        <li><label><input type="checkbox"  name="Дополнительный функционал*Размещение и управление рекламными баннерами" value="5000"/><span>Размещение и управление рекламными баннерами</span></label></li>





                                        <li><label><input type="checkbox"  name="Дополнительный функционал*Информеры" value="1900"/><span>Информеры</span></label></li>





                                        <li><label><input type="checkbox"  name="Дополнительный функционал*Версия для печати" value="5000"/><span>Версия для печати</span></label></li>





                                        <li><label><input type="checkbox"  name="Дополнительный функционал*Отзывы" value="2100"/><span>Отзывы</span></label></li>





                                        <li><label><input type="checkbox"  name="Дополнительный функционал*Рейтинг / голосование" value="1900"/><span>Рейтинг / голосование</span></label></li>





                                        <li><label><input type="checkbox"  name="Дополнительный функционал*Функция «Добавить в избранное»" value="1200"/><span>Функция «Добавить в избранное»</span></label></li>





                                        <li><label><input type="checkbox"  name="Дополнительный функционал*Капча" value="500"/><span>Капча</span></label></li>




                                    </ul>







                                    <p class='click_toggle click_toggle_active inner-link btn-small-black-border-light btn-small  margin-right-20px sm-margin-right-20px xs-margin-five-bottom button btn'><span>Дизайн</span></p>									<ul class='toggle ul_active' style="display: block;">



                                        <li class="chk"><label>	<input type="radio"	 checked="checked"  name="rd76" value="Дизайн*Разработка дизайна сайта*25000*"/><span>Разработка дизайна сайта</span></label>





                                        <li class="chk"><label>	<input type="radio"	 name="rd76" value="Дизайн*Шаблон - Сайт юридической компании*15000*"/><span>Шаблон - Сайт юридической компании</span></label>





                                        <li class="chk"><label>	<input type="radio"	 name="rd76" value="Дизайн*Шаблон - Сайт юридического центра*17000*"/><span>Шаблон - Сайт юридического центра</span></label>





                                        <li class="chk"><label>	<input type="radio"	 name="rd76" value="Дизайн*Дизайн предоставлен клиентом, наша верстка макетов*12000*"/><span>Дизайн предоставлен клиентом, наша верстка макетов</span></label>




                                    </ul>




                                    <p class='click_toggle inner-link btn-small-black-border-light btn-small  margin-right-20px sm-margin-right-20px xs-margin-five-bottom button btn'><span>Техническая поддержка сайта</span></p>									<ul class="toggle">



                                        <li class="chk"><label>	<input type="radio"	 name="rd77" value="Техническая поддержка сайта*План Минимальный*2500*"/><span>План Минимальный</span></label>





                                        <li class="chk"><label>	<input type="radio"	 name="rd77" value="Техническая поддержка сайта*План Расширенный*6000*"/><span>План Расширенный</span></label>





                                        <li class="chk"><label>	<input type="radio"	 name="rd77" value="Техническая поддержка сайта*План Экстра*10000*"/><span>План Экстра</span></label>





                                        <li class="chk"><label>	<input type="radio"	 name="rd77" value="Техническая поддержка сайта*План Ультра*20000*"/><span>План Ультра</span></label>




                                    </ul>



                                    <p class='click_toggle inner-link btn-small-black-border-light btn-small  margin-right-20px sm-margin-right-20px xs-margin-five-bottom button btn'><span>Оптимизация</span></p>									<ul class="toggle">



                                        <li><label><input type="checkbox"  name="Оптимизация*Подготовка сайта к оптимизации" value="5000"/><span>Подготовка сайта к оптимизации</span></label></li>




                                    </ul>



                                </div><div class="column">
                                    <p class='click_toggle inner-link btn-small-black-border-light btn-small  margin-right-20px sm-margin-right-20px xs-margin-five-bottom button btn'><span>Языковые версии</span></p>									<ul class="toggle">



                                        <li><label><input type="checkbox"  name="Языковые версии*Дополнительный язык (каждый)" value="28000"/><span>Дополнительный язык (каждый)</span></label></li>




                                    </ul>




                                    <p class='click_toggle click_toggle_active inner-link btn-small-black-border-light btn-small  margin-right-20px sm-margin-right-20px xs-margin-five-bottom button btn'><span>Лицензия 1С-Битрикс</span></p>									<ul class='toggle ul_active' style="display: block;">



                                        <li class="chk"><label>	<input type="radio"	 name="rd105" value="Лицензия 1С-Битрикс*Старт*4900*"/><span>Старт</span></label>





                                        <li class="chk"><label>	<input type="radio"	 checked="checked"  name="rd105" value="Лицензия 1С-Битрикс*Стандарт*13900*"/><span>Стандарт</span></label>





                                        <li class="chk"><label>	<input type="radio"	 name="rd105" value="Лицензия 1С-Битрикс*Эксперт*40900*"/><span>Эксперт</span></label>





                                        <li class="chk"><label>	<input type="radio"	 name="rd105" value="Лицензия 1С-Битрикс*Малый бизнес*27900*"/><span>Малый бизнес</span></label>





                                        <li class="chk"><label>	<input type="radio"	 name="rd105" value="Лицензия 1С-Битрикс*Бизнес*56900*"/><span>Бизнес</span></label>





                                        <li class="chk"><label>	<input type="radio"	 name="rd105" value="Лицензия 1С-Битрикс*Веб-кластер*129900*"/><span>Веб-кластер</span></label>





                                        <li class="chk"><label>	<input type="radio"	 name="rd105" value="Лицензия 1С-Битрикс*Бизнес - веб-кластер*329900*"/><span>Бизнес - веб-кластер</span></label>





                                        <li class="chk"><label>	<input type="radio"	 name="rd105" value="Лицензия 1С-Битрикс*Есть у клиента*0*"/><span>Есть у клиента</span></label>




                                    </ul>





                                    <p class='click_toggle inner-link btn-small-black-border-light btn-small  margin-right-20px sm-margin-right-20px xs-margin-five-bottom button btn'><span>Техническое задание</span></p>									<ul class="toggle">



                                        <li><label><input type="checkbox"  name="Техническое задание*Разработка ТЗ" value="10000"/><span>Разработка ТЗ</span></label></li>




                                    </ul>





                                    <p class='click_toggle click_toggle_active inner-link btn-small-black-border-light btn-small  margin-right-20px sm-margin-right-20px xs-margin-five-bottom button btn'><span>Новости</span></p>									<ul class='toggle ul_active' style="display: block;">



                                        <li class="li_sect toggle-active"><label><input class="section"  checked="checked"  type="checkbox" name="Новости*Новость детально" value="2000"/><span>Новость детально</span></label></li>


                                        <ul class='sect13123 ul_active'>



                                            <li><label>	<input type="checkbox"  name="Новости*Галерея" value="500"/>Галерея</label></li>



                                            <li><label>	<input type="checkbox"  name="Новости*Расшаривание в соц. сети" value="1000"/>Расшаривание в соц. сети</label></li>



                                            <li><label>	<input type="checkbox"  checked="checked"  name="Новости*Комментарии" value="1000"/>Комментарии</label></li>

                                        </ul>



                                        <li class="li_sect toggle-active"><label><input class="section"  checked="checked"  type="checkbox" name="Новости*Список новостей" value="2000"/><span>Список новостей</span></label></li>


                                        <ul class='sect13123 ul_active'>



                                            <li class="chk"><label>	<input type="radio"	 name="rd170" value="Новости*Фильтр*500*"/>Фильтр</label>



                                            <li class="chk"><label>	<input type="radio"	 checked="checked"  name="rd170" value="Новости*Сортировка*500*"/>Сортировка</label>

                                        </ul>


                                    </ul>





                                    <p class='click_toggle inner-link btn-small-black-border-light btn-small  margin-right-20px sm-margin-right-20px xs-margin-five-bottom button btn'><span>Каталог товаров</span></p>									<ul class="toggle">



                                        <li><label><input type="checkbox"  name="Каталог товаров*Каталог услуг с описанием" value="3400"/><span>Каталог услуг с описанием</span></label></li>



                                        <li><label><input type="checkbox"  name="Каталог товаров*Детальное описание услуги" value="1680"/><span>Детальное описание услуги</span></label></li>


                                        <li><label><input type="checkbox"  name="Каталог товаров*Загрузка из CSV, XLS" value="5000"/><span>Загрузка из CSV, XLS</span></label></li>



                                    </ul>



                                </div>
                            </div>




                            <div class="bx">

                                <div class="column">



                                    <p class='click_toggle click_toggle_active inner-link btn-small-black-border-light btn-small  margin-right-20px sm-margin-right-20px xs-margin-five-bottom button btn'><span>Основной функционал</span></p>									<ul class='toggle ul_active' style="display: block;">



                                        <li><label><input type="checkbox"  checked="checked"  name="Основной функционал*Установка и настройка Битрикса" value="3360"/><span>Установка и настройка Битрикса</span></label></li>





                                        <li><label><input type="checkbox"  checked="checked"  name="Основной функционал*Разработка структуры и карты сайта" value="1700"/><span>Разработка структуры и карты сайта</span></label></li>





                                        <li><label><input type="checkbox"  checked="checked"  name="Основной функционал*Размещение контента до 5 стр. (&quot;О Компании&quot;, &quot;Контакты&quot;)" value="2500"/><span>Размещение контента до 5 стр. (&quot;О Компании&quot;, &quot;Контакты&quot;)</span></label></li>





                                        <li><label><input type="checkbox"  checked="checked"  name="Основной функционал*Каталог услуг с описанием" value="3360"/><span>Каталог услуг с описанием</span></label></li>





                                        <li><label><input type="checkbox"  checked="checked"  name="Основной функционал*Детальное описание услуги" value="1700"/><span>Детальное описание услуги</span></label></li>





                                        <li><label><input type="checkbox"  name="Основной функционал*Форма обратной связи" value="1000"/><span>Форма обратной связи</span></label></li>





                                        <li><label><input type="checkbox"  checked="checked"  name="Основной функционал*Фотогалерея + лайтбокс" value="3360"/><span>Фотогалерея + лайтбокс</span></label></li>





                                        <li><label><input type="checkbox"  name="Основной функционал*Поиск по сайту" value="1800"/><span>Поиск по сайту</span></label></li>





                                        <li><label><input type="checkbox"  name="Основной функционал*Баннерокрутилка (слайдер)" value="2000"/><span>Баннерокрутилка (слайдер)</span></label></li>





                                        <li><label><input type="checkbox"  name="Основной функционал*Навигация по сайту" value="1800"/><span>Навигация по сайту</span></label></li>





                                        <li><label><input type="checkbox"  name="Основной функционал*Интерация с Google Mars или Яндекс.Картами" value="1700"/><span>Интерация с Google Mars или Яндекс.Картами</span></label></li>





                                        <li><label><input type="checkbox"  checked="checked"  name="Основной функционал*Новости сайта" value="1700"/><span>Новости сайта</span></label></li>





                                        <li><label><input type="checkbox"  name="Основной функционал*Вопрос-ответ" value="2000"/><span>Вопрос-ответ</span></label></li>





                                        <li><label><input type="checkbox"  name="Основной функционал*Информеры" value="2000"/><span>Информеры</span></label></li>





                                        <li><label><input type="checkbox"  checked="checked"  name="Основной функционал*Статьи" value="1500"/><span>Статьи</span></label></li>





                                        <li><label><input type="checkbox"  name="Основной функционал*Размещение, воспроизведение видеороликов" value="1700"/><span>Размещение, воспроизведение видеороликов</span></label></li>





                                        <li><label><input type="checkbox"  name="Основной функционал*Авторизация/ регистрация через социальные сети" value="1800"/><span>Авторизация/ регистрация через социальные сети</span></label></li>





                                        <li><label><input type="checkbox"  name="Основной функционал*Личный кабинет" value="20000"/><span>Личный кабинет</span></label></li>





                                        <li><label><input type="checkbox"  name="Основной функционал*Загрузка из CSV, XLS" value="6000"/><span>Загрузка из CSV, XLS</span></label></li>




                                    </ul>







                                    <p class='click_toggle inner-link btn-small-black-border-light btn-small  margin-right-20px sm-margin-right-20px xs-margin-five-bottom button btn'><span>Дополнительный функционал</span></p>									<ul class="toggle">



                                        <li><label><input type="checkbox"  name="Дополнительный функционал*Сортировка" value="6000"/><span>Сортировка</span></label></li>





                                        <li><label><input type="checkbox"  name="Дополнительный функционал*Облако тегов" value="6000"/><span>Облако тегов</span></label></li>





                                        <li><label><input type="checkbox"  name="Дополнительный функционал*Фильтр" value="9000"/><span>Фильтр</span></label></li>





                                        <li><label><input type="checkbox"  name="Дополнительный функционал*ЧПУ (Человеко-понятный УРЛ)" value="3000"/><span>ЧПУ (Человеко-понятный УРЛ)</span></label></li>





                                        <li><label><input type="checkbox"  name="Дополнительный функционал*Подписка / рассылка" value="2000"/><span>Подписка / рассылка</span></label></li>





                                        <li><label><input type="checkbox"  name="Дополнительный функционал*Google Analytics, Яндекс.Метрика" value="500"/><span>Google Analytics, Яндекс.Метрика</span></label></li>





                                        <li><label><input type="checkbox"  name="Дополнительный функционал*Интеграция виджетов социальных сетей (Like)" value="2000"/><span>Интеграция виджетов социальных сетей (Like)</span></label></li>





                                        <li><label><input type="checkbox"  name="Дополнительный функционал*Интеграция виджетов социальных сетей группы" value="3000"/><span>Интеграция виджетов социальных сетей группы</span></label></li>





                                        <li><label><input type="checkbox"  name="Дополнительный функционал*Автопубликация контента в социальных сетях" value="3600"/><span>Автопубликация контента в социальных сетях</span></label></li>





                                        <li><label><input type="checkbox"  name="Дополнительный функционал*Опросы" value="3000"/><span>Опросы</span></label></li>





                                        <li><label><input type="checkbox"  name="Дополнительный функционал*Блог" value="4500"/><span>Блог</span></label></li>





                                        <li><label><input type="checkbox"  name="Дополнительный функционал*Форум" value="10000"/><span>Форум</span></label></li>




                                        <li><label><input type="checkbox"  name="Дополнительный функционал*Архив новостей, статей" value="3000"/><span>Архив новостей, статей</span></label></li>





                                        <li><label><input type="checkbox"  name="Дополнительный функционал*Интерактивный календарь" value="4000"/><span>Интерактивный календарь</span></label></li>





                                        <li><label><input type="checkbox"  name="Дополнительный функционал*Гостевая книга" value="3500"/><span>Гостевая книга</span></label></li>





                                        <li><label><input type="checkbox"  name="Дополнительный функционал*Настройка многосайтовости" value="15000"/><span>Настройка многосайтовости</span></label></li>





                                        <li><label><input type="checkbox"  name="Дополнительный функционал*Подписка на новости RSS" value="1500"/><span>Подписка на новости RSS</span></label></li>





                                        <li><label><input type="checkbox"  name="Дополнительный функционал*Функция &quot;Заказать обратный звонок&quot;" value="3000"/><span>Функция &quot;Заказать обратный звонок&quot;</span></label></li>





                                        <li><label><input type="checkbox"  name="Дополнительный функционал*Подключение Онлайн-консультанта" value="1000"/><span>Подключение Онлайн-консультанта</span></label></li>





                                        <li><label><input type="checkbox"  name="Дополнительный функционал*Размещение и управление рекламными баннерами" value="6000"/><span>Размещение и управление рекламными баннерами</span></label></li>





                                        <li><label><input type="checkbox"  name="Дополнительный функционал*Информеры" value="7000"/><span>Информеры</span></label></li>





                                        <li><label><input type="checkbox"  name="Дополнительный функционал*Версия для печати" value="5000"/><span>Версия для печати</span></label></li>





                                        <li><label><input type="checkbox"  name="Дополнительный функционал*Отзывы" value="6000"/><span>Отзывы</span></label></li>





                                        <li><label><input type="checkbox"  name="Дополнительный функционал*Рейтинг / голосование" value="6500"/><span>Рейтинг / голосование</span></label></li>





                                        <li><label><input type="checkbox"  name="Дополнительный функционал*Функция &quot;Добавить в избранное&quot;" value="2500"/><span>Функция &quot;Добавить в избранное&quot;</span></label></li>





                                        <li><label><input type="checkbox"  name="Дополнительный функционал*Капча" value="550"/><span>Капча</span></label></li>




                                    </ul>




                                    <p class='click_toggle inner-link btn-small-black-border-light btn-small  margin-right-20px sm-margin-right-20px xs-margin-five-bottom button btn'><span>Дизайн</span></p>									<ul class="toggle">



                                        <li class="li_sect "><label><input class="section"  type="checkbox" name="Дизайн*Шаблонный дизайн" value=""/><span>Шаблонный дизайн</span></label></li>


                                        <ul class='sect13123'>



                                            <li><label>	<input type="checkbox"  name="Дизайн*Шаблон - Интернет-магазин сантехники" value="15000"/>Шаблон - Интернет-магазин сантехники</label></li>



                                            <li><label>	<input type="checkbox"  name="Дизайн*Шаблон - интернет-магазин автопринадлежности" value="15000"/>Шаблон - интернет-магазин автопринадлежности</label></li>

                                        </ul>



                                        <li class="li_sect "><label><input class="section"  type="checkbox" name="Дизайн*Уникальный дизайн" value="0"/><span>Уникальный дизайн</span></label></li>


                                        <ul class='sect13123'>

                                        </ul>


                                    </ul>








                                    <p class='click_toggle inner-link btn-small-black-border-light btn-small  margin-right-20px sm-margin-right-20px xs-margin-five-bottom button btn'><span>Техническое задание</span></p>									<ul class="toggle">



                                        <li><label><input type="checkbox"  name="Техническое задание*Разработка ТЗ" value="25000"/><span>Разработка ТЗ</span></label></li>




                                    </ul>



                                </div><div class="column">
                                    <p class='click_toggle inner-link btn-small-black-border-light btn-small  margin-right-20px sm-margin-right-20px xs-margin-five-bottom button btn'><span>Языковые версии</span></p>									<ul class="toggle">



                                        <li><label><input type="checkbox"  name="Языковые версии*Дополнительный язык (каждый)" value="50000"/><span>Дополнительный язык (каждый)</span></label></li>




                                    </ul>






                                    <p class='click_toggle click_toggle_active inner-link btn-small-black-border-light btn-small  margin-right-20px sm-margin-right-20px xs-margin-five-bottom button btn'><span>Лицензия Битрикс</span></p>									<ul class='toggle ul_active' style="display: block;">



                                        <li><label><input type="checkbox"  name="Лицензия Битрикс*Малый бизнес" value="27900"/><span>Малый бизнес</span></label></li>





                                        <li><label><input type="checkbox"  name="Лицензия Битрикс*Бизнес" value="56900"/><span>Бизнес</span></label></li>




                                    </ul>








                                    <p class='click_toggle inner-link btn-small-black-border-light btn-small  margin-right-20px sm-margin-right-20px xs-margin-five-bottom button btn'><span>Оптимизация</span></p>									<ul class="toggle">



                                        <li><label><input type="checkbox"  name="Оптимизация*Подготовка сайта к оптимизации" value="15000"/><span>Подготовка сайта к оптимизации</span></label></li>




                                    </ul>




                                    <p class='click_toggle click_toggle_active inner-link btn-small-black-border-light btn-small  margin-right-20px sm-margin-right-20px xs-margin-five-bottom button btn'><span>Техническая поддержка</span></p>									<ul class='toggle ul_active' style="display: block;">



                                        <li><label><input type="checkbox"  name="Техническая поддержка*План Расширенный" value="6000"/><span>План Расширенный</span></label></li>





                                        <li><label><input type="checkbox"  name="Техническая поддержка*План Экстра" value="10000"/><span>План Экстра</span></label></li>





                                        <li><label><input type="checkbox"  name="Техническая поддержка*План Ультра" value="20000"/><span>План Ультра</span></label></li>




                                    </ul>



                                </div>
                            </div>




                            <div class="bx">

                                <div class="column">




                                    <p class='click_toggle inner-link btn-small-black-border-light btn-small  margin-right-20px sm-margin-right-20px xs-margin-five-bottom button btn'><span>Основной функционал</span></p>									<ul class="toggle">



                                        <li><label><input type="checkbox"  checked="checked"  name="Основной функционал*Установка и настройка Битрикса" value="3360"/><span>Установка и настройка Битрикса</span></label></li>





                                        <li><label><input type="checkbox"  checked="checked"  name="Основной функционал*Разработка структуры и карты сайта" value="1680"/><span>Разработка структуры и карты сайта</span></label></li>





                                        <li><label><input type="checkbox"  checked="checked"  name="Основной функционал*Размещение контента до 5 стр. (&quot;О Компании&quot;, &quot;Контакты&quot;)" value="1680"/><span>Размещение контента до 5 стр. (&quot;О Компании&quot;, &quot;Контакты&quot;)</span></label></li>





                                        <li><label><input type="checkbox"  checked="checked"  name="Основной функционал*Каталог услуг с описанием" value="3360"/><span>Каталог услуг с описанием</span></label></li>





                                        <li><label><input type="checkbox"  checked="checked"  name="Основной функционал*Детальное описание услуги" value="1680"/><span>Детальное описание услуги</span></label></li>





                                        <li><label><input type="checkbox"  name="Основной функционал*Форма обратной связи" value="840"/><span>Форма обратной связи</span></label></li>





                                        <li><label><input type="checkbox"  name="Основной функционал*Фотогалерея + лайтбокс" value="3360"/><span>Фотогалерея + лайтбокс</span></label></li>





                                        <li><label><input type="checkbox"  name="Основной функционал*Поиск по сайту" value="1680"/><span>Поиск по сайту</span></label></li>





                                        <li><label><input type="checkbox"  name="Основной функционал*Баннерокрутилка (слайдер)" value="1680"/><span>Баннерокрутилка (слайдер)</span></label></li>





                                        <li><label><input type="checkbox"  name="Основной функционал*Навигация по сайту" value="1680"/><span>Навигация по сайту</span></label></li>





                                        <li><label><input type="checkbox"  name="Основной функционал*Интеграция с Google Mars или Яндекс.Картами" value="1680"/><span>Интеграция с Google Mars или Яндекс.Картами</span></label></li>





                                        <li><label><input type="checkbox"  checked="checked"  name="Основной функционал*Новости сайта" value="1680"/><span>Новости сайта</span></label></li>





                                        <li><label><input type="checkbox"  name="Основной функционал*Вопрос-ответ" value="1680"/><span>Вопрос-ответ</span></label></li>





                                        <li><label><input type="checkbox"  name="Основной функционал*Информеры" value="1680"/><span>Информеры</span></label></li>





                                        <li><label><input type="checkbox"  checked="checked"  name="Основной функционал*Статьи" value="1680"/><span>Статьи</span></label></li>





                                        <li><label><input type="checkbox"  name="Основной функционал*Размещение, воспроизведение видеороликов" value="1680"/><span>Размещение, воспроизведение видеороликов</span></label></li>





                                        <li><label><input type="checkbox"  name="Основной функционал*Авторизация / регистрация через социальные сети" value="5000"/><span>Авторизация / регистрация через социальные сети</span></label></li>





                                        <li><label><input type="checkbox"  name="Основной функционал*Личный кабинет" value="20000"/><span>Личный кабинет</span></label></li>





                                        <li><label><input type="checkbox"  name="Основной функционал*Загрузка на CSV, XLS" value="15000"/><span>Загрузка на CSV, XLS</span></label></li>




                                    </ul>




                                    <p class='click_toggle inner-link btn-small-black-border-light btn-small  margin-right-20px sm-margin-right-20px xs-margin-five-bottom button btn'><span>Дополнительный функционал</span></p>									<ul class="toggle">



                                        <li><label><input type="checkbox"  name="Дополнительный функционал*Сортировка" value="5040"/><span>Сортировка</span></label></li>





                                        <li><label><input type="checkbox"  name="Дополнительный функционал*Облако тегов" value="5040"/><span>Облако тегов</span></label></li>





                                        <li><label><input type="checkbox"  name="Дополнительный функционал*Фильтр" value="6720"/><span>Фильтр</span></label></li>





                                        <li><label><input type="checkbox"  name="Дополнительный функционал*ЧПУ (Человеко-понятный УРЛ)" value="1680"/><span>ЧПУ (Человеко-понятный УРЛ)</span></label></li>





                                        <li><label><input type="checkbox"  name="Дополнительный функционал*Подписка/ расылка" value="1680"/><span>Подписка/ расылка</span></label></li>





                                        <li><label><input type="checkbox"  name="Дополнительный функционал*Google Analytics, Яндекс.Метрика" value="1680"/><span>Google Analytics, Яндекс.Метрика</span></label></li>





                                        <li><label><input type="checkbox"  name="Дополнительный функционал*Интеграция виджетов социальных сетей (Like)" value="1680"/><span>Интеграция виджетов социальных сетей (Like)</span></label></li>





                                        <li><label><input type="checkbox"  name="Дополнительный функционал*Интеграция виджетов социальных сетей группы" value="1680"/><span>Интеграция виджетов социальных сетей группы</span></label></li>





                                        <li><label><input type="checkbox"  name="Дополнительный функционал*Автопубликация контента в социальных сетях" value="1680"/><span>Автопубликация контента в социальных сетях</span></label></li>





                                        <li><label><input type="checkbox"  name="Дополнительный функционал*Опросы" value="1680"/><span>Опросы</span></label></li>





                                        <li><label><input type="checkbox"  name="Дополнительный функционал*Блок" value="3360"/><span>Блок</span></label></li>





                                        <li><label><input type="checkbox"  name="Дополнительный функционал*Форум" value="1680"/><span>Форум</span></label></li>





                                        <li><label><input type="checkbox"  name="Дополнительный функционал*Архив новостей, статей" value="1680"/><span>Архив новостей, статей</span></label></li>





                                        <li><label><input type="checkbox"  name="Дополнительный функционал*Интерактивный календарь" value="3360"/><span>Интерактивный календарь</span></label></li>





                                        <li><label><input type="checkbox"  name="Дополнительный функционал*Гостевая книга" value="1680"/><span>Гостевая книга</span></label></li>





                                        <li><label><input type="checkbox"  name="Дополнительный функционал*Настройка многосайтовости" value="5040"/><span>Настройка многосайтовости</span></label></li>





                                        <li><label><input type="checkbox"  name="Дополнительный функционал*Подписка на новости RSS" value="3000"/><span>Подписка на новости RSS</span></label></li>





                                        <li><label><input type="checkbox"  name="Дополнительный функционал*Функция &quot;Заказать обратный звонок&quot;" value="3500"/><span>Функция &quot;Заказать обратный звонок&quot;</span></label></li>





                                        <li><label><input type="checkbox"  name="Дополнительный функционал*Подключение Онлайн консультанта" value="1500"/><span>Подключение Онлайн консультанта</span></label></li>





                                        <li><label><input type="checkbox"  name="Дополнительный функционал*Размещение и управление рекламными баннерами" value="4500"/><span>Размещение и управление рекламными баннерами</span></label></li>





                                        <li><label><input type="checkbox"  name="Дополнительный функционал*Информеры" value="5000"/><span>Информеры</span></label></li>





                                        <li><label><input type="checkbox"  name="Дополнительный функционал*Версия для печати" value="8000"/><span>Версия для печати</span></label></li>





                                        <li><label><input type="checkbox"  name="Дополнительный функционал*Отзывы" value="3500"/><span>Отзывы</span></label></li>





                                        <li><label><input type="checkbox"  name="Дополнительный функционал*Рейтинг / голосование" value="3500"/><span>Рейтинг / голосование</span></label></li>





                                        <li><label><input type="checkbox"  name="Дополнительный функционал*Функция &quot;Добавить в избранное&quot;" value="1500"/><span>Функция &quot;Добавить в избранное&quot;</span></label></li>





                                        <li><label><input type="checkbox"  name="Дополнительный функционал*Капча" value="2000"/><span>Капча</span></label></li>




                                    </ul>







                                    <p class='click_toggle inner-link btn-small-black-border-light btn-small  margin-right-20px sm-margin-right-20px xs-margin-five-bottom button btninner-link btn-small-black-border-light btn-small  margin-right-20px sm-margin-right-20px xs-margin-five-bottom button btn'><span>Дизайн</span></p>									<ul class="toggle">



                                        <li class="li_sect "><label><input class="section"  type="checkbox" name="Дизайн*Шаблонный дизайн" value=""/><span>Шаблонный дизайн</span></label></li>


                                        <ul class='sect13123'>



                                            <li><label>	<input type="checkbox"  name="Дизайн*Шаблон - городской портал" value="25000"/>Шаблон - городской портал</label></li>



                                            <li><label>	<input type="checkbox"  name="Дизайн*Шаблон - гипермаркет товаров" value="25000"/>Шаблон - гипермаркет товаров</label></li>

                                        </ul>



                                        <li class="li_sect "><label><input class="section"  type="checkbox" name="Дизайн*Уникальный дизайн" value=""/><span>Уникальный дизайн</span></label></li>


                                        <ul class='sect13123'>



                                            <li><label>	<input type="checkbox"  name="Дизайн* главной страницы" value="7000"/> главной страницы</label></li>



                                            <li><label>	<input type="checkbox"  name="Дизайн*одной внутренней страницы" value="4000"/>одной внутренней страницы</label></li>



                                            <li><label>	<input type="checkbox"  name="Дизайн*каталога" value="8000"/>каталога</label></li>



                                            <li><label>	<input type="checkbox"  name="Дизайн*карточки" value="1000"/>карточки</label></li>



                                            <li><label>	<input type="checkbox"  name="Дизайн*процесса оформления заказа" value="3000"/>процесса оформления заказа</label></li>



                                            <li><label>	<input type="checkbox"  name="Дизайн*корзины" value="3000"/>корзины</label></li>



                                            <li><label>	<input type="checkbox"  name="Дизайн*личного кабинета" value="15000"/>личного кабинета</label></li>



                                            <li><label>	<input type="checkbox"  name="Дизайн*форума" value="4000"/>форума</label></li>



                                            <li><label>	<input type="checkbox"  name="Дизайн*блога" value="4000"/>блога</label></li>

                                        </ul>


                                    </ul>






                                    <p class='click_toggle inner-link btn-small-black-border-light btn-small  margin-right-20px sm-margin-right-20px xs-margin-five-bottom button btn'><span>Языковые версии</span></p>									<ul class="toggle">



                                        <li><label><input type="checkbox"  name="Языковые версии*Дополнительный язык (каждый)" value="40000"/><span>Дополнительный язык (каждый)</span></label></li>




                                    </ul>






                                </div><div class="column">
                                    <p class='click_toggle inner-link btn-small-black-border-light btn-small  margin-right-20px sm-margin-right-20px xs-margin-five-bottom button btn'><span>Техническое задание</span></p>									<ul class="toggle">



                                        <li><label><input type="checkbox"  name="Техническое задание*Разработка ТЗ" value="20000"/><span>Разработка ТЗ</span></label></li>




                                    </ul>






                                    <p class='click_toggle inner-link btn-small-black-border-light btn-small  margin-right-20px sm-margin-right-20px xs-margin-five-bottom button btn'><span>Оптимизация</span></p>									<ul class="toggle">



                                        <li><label><input type="checkbox"  name="Оптимизация*Подготовка сайта к оптимизации" value="15000"/><span>Подготовка сайта к оптимизации</span></label></li>




                                    </ul>





                                    <p class='click_toggle inner-link btn-small-black-border-light btn-small  margin-right-20px sm-margin-right-20px xs-margin-five-bottom button btn'><span>Лицензия Битрикс</span></p>									<ul class="toggle">



                                        <li><label><input type="checkbox"  name="Лицензия Битрикс*Стандарт" value="13900"/><span>Стандарт</span></label></li>





                                        <li><label><input type="checkbox"  name="Лицензия Битрикс*Эксперт" value="40900"/><span>Эксперт</span></label></li>





                                        <li><label><input type="checkbox"  name="Лицензия Битрикс*Малый бизнес" value="27900"/><span>Малый бизнес</span></label></li>





                                        <li><label><input type="checkbox"  name="Лицензия Битрикс*Бизнес" value="56900"/><span>Бизнес</span></label></li>




                                    </ul>






                                    <p class='click_toggle inner-link btn-small-black-border-light btn-small  margin-right-20px sm-margin-right-20px xs-margin-five-bottom button btn'><span>Техническая поддержка</span></p>									<ul class="toggle">



                                        <li><label><input type="checkbox"  name="Техническая поддержка*План Расширенный" value="6000"/><span>План Расширенный</span></label></li>





                                        <li><label><input type="checkbox"  name="Техническая поддержка*План Экстра" value="10000"/><span>План Экстра</span></label></li>





                                        <li><label><input type="checkbox"  name="Техническая поддержка*План Ультра " value="20000"/><span>План Ультра </span></label></li>


                                    </ul>


                            <!-- </div> -->
                        </div>
                    </div>


                    <div class="right-conf">
                        <h6 class="black-text margin-two">Расчет стоимости услуг</h6>


                        <div class="scroll-pane summary">
                            <div class="table-summ">
                                <span>Основной функционал</span>

                            </div>
                        </div>

                        <div class="done-summ">
                            <span>Итого:</span>
                            <p>0 руб.</p>
                        </div>

                     
                    </div>

                </div> 	</div>

              </div>
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
//include $_SERVER['DOCUMENT_ROOT'] . '/includes/footer_scripts_calculator.php';
?>


<script type="text/javascript">

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
   </script>


<script type="text/javascript"
        src="/includes/js/images.js"></script>
<script type="text/javascript"
        src="/includes/js/form.js"></script>


</body>
</html>







