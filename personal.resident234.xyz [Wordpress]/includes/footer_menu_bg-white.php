<?php
/**
 * Created by PhpStorm.
 * User: GSU
 * Date: 25.06.2017
 * Time: 19:32
 */
?>

<div class=" bg-white footer-top">
    <div class="container">
        <div class="row margin-four">
            <div class="col-md-4 col-sm-4 text-center"><i class="icon-profile-male small-icon black-text"></i><h6
                    class="black-text margin-two no-margin-bottom">gsu_resident234</h6></div>
            <div class="col-md-4 col-sm-4 text-center"><i class="icon-map-pin small-icon black-text"></i><h6
                    class="black-text margin-two no-margin-bottom">г. Благовещенск, Амурская обл., РФ</h6></div>
            <div class="col-md-4 col-sm-4 text-center"><i class="icon-envelope small-icon black-text"></i><h6
                    class="margin-two no-margin-bottom"><a href="mailto:gsu1234@mail.ru">gsu1234@mail.ru</a>
                </h6></div>
        </div>
    </div>
</div>
<div class="container footer-middle">
    <div class="row">
        <div class="col-md-4 col-sm-3 sm-display-none">
            <div id="text-13" class="widget_text"><h5 class="sidebar-title">О себе</h5>
                <div class="textwidget">
                    <?php
                    $randomText = randomText();
                    ?>
                    <p class="footer-text"><?php echo $randomText[0]; ?><br><?php echo $randomText[1]; ?></p>
                </div>
            </div>
        </div>
        <div class="col-md-3 col-sm-3 col-xs-3 footer-links">
            <div id="hcode_custom_menu_widget-8" class="widget_hcode_custom_menu_widget">
                <h5 class="sidebar-title">
                    Проекты</h5>
                <div class="menu-footer-menu1-container">
                    <ul id="menu-footer-menu1" class="menu">
                        <li id="menu-item-9326"
                            class="menu-item menu-item-type-post_type menu-item-object-page menu-item-9326"><a
                                href="/projects/best/">Лучшие проекты</a></li>
                        <li id="menu-item-9327"
                            class="menu-item menu-item-type-post_type menu-item-object-page menu-item-9327"><a
                                href="/projects/first/">Одни из первых проектов</a></li>
                        <li id="menu-item-9328"
                            class="menu-item menu-item-type-post_type menu-item-object-page menu-item-9328"><a
                                href="/projects/episodic/">Эпизодическое участие</a></li>

                    </ul>
                </div>
            </div>
        </div>
        <div class="col-md-2 col-sm-3 col-xs-3 footer-links">
            <div id="hcode_custom_menu_widget-12" class="widget_hcode_custom_menu_widget">
                <h5 class="sidebar-title">
                    Инфо</h5>
                <div class="menu-footer-menu3-container">
                    <ul id="menu-footer-menu3" class="menu">
                        <li id="menu-item-9342"
                            class="menu-item menu-item-type-post_type menu-item-object-page menu-item-9342"><a
                                href="/info/main/">Основные сведения</a></li>
                        <li id="menu-item-9344"
                            class="menu-item menu-item-type-post_type menu-item-object-page menu-item-9344"><a
                                href="/info/about/">О себе</a></li>
                        <li id="menu-item-9345"
                            class="menu-item menu-item-type-post_type menu-item-object-page menu-item-9345"><a
                                href="/info/experience/">Опыт работы</a></li>

                    </ul>
                </div>
            </div>
        </div>
        <div class="col-md-3 col-sm-3 col-xs-3 footer-links">
            <div id="hcode_custom_menu_widget-13" class="widget_hcode_custom_menu_widget">
                <h5 class="sidebar-title">
                    Обратная связь</h5>
                <div class="menu-footer-menu3-container">
                    <ul id="menu-footer-menu3-1" class="menu">
                        <li class="menu-item menu-item-type-post_type menu-item-object-page menu-item-9342"><a
                                href="/feedback/simple/">Простая форма</a></li>
                        <li class="menu-item menu-item-type-post_type menu-item-object-page menu-item-9344"><a
                                href="/feedback/project/">Форма заказа проекта</a></li>
                        <li class="menu-item menu-item-type-post_type menu-item-object-page menu-item-9345"><a
                                href="/feedback/calculator/">Калькулятор стоимости проекта</a></li>

                    </ul>
                </div>
            </div>
        </div>

    </div>
    <div class="wide-separator-line bg-mid-gray no-margin-lr margin-three no-margin-bottom"></div>
    <div class="row margin-four no-margin-bottom">
        <div class="col-md-6 col-sm-12 sm-text-center sm-margin-bottom-four">
            <ul id="menu-footer-menu" class="list-inline footer-link text-uppercase">
                <li id="menu-item-851"
                    class="menu-item menu-item-type-post_type menu-item-object-page menu-item-851"><a
                        href="/">Главная</a></li>
                <li id="menu-item-852"
                    class="menu-item menu-item-type-post_type menu-item-object-page menu-item-852"><a
                        href="/skills/">Навыки</a></li>
                <li id="menu-item-853"
                    class="menu-item menu-item-type-post_type menu-item-object-page menu-item-853"><a
                        href="/links/">Ссылки</a></li>

            </ul>
        </div>

    </div>
</div>
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
