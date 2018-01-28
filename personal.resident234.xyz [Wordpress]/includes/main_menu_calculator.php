<?php
/**
 * Created by PhpStorm.
 * User: GSU
 * Date: 25.06.2017
 * Time: 0:50
 */


?>

<ul id="menu-main-menu" class="mega-menu-ul nav navbar-nav navbar-right panel-group">
    <li id="menu-item-197"
        class="menu-item menu-item-type-custom menu-item-object-custom
        <?php if($_SERVER["REQUEST_URI"] == "/"){ ?>current-menu-item<?php } ?> current_page_item menu-item-home menu-item-has-children menu-item-197 menu-first-level dropdown panel megamenu-column-4 dropdown-toggle collapsed">
        <a href="/" data-redirect-url="/"
           data-default-url="#collapse1" class="dropdown-toggle collapsed "
           data-hover="dropdown" data-toggle="collapse">Главная</a>
        <a href="#collapse1"
           class="dropdown-toggle collapsed megamenu-right-icon aaa"
           data-hover="dropdown"
           data-toggle="collapse"><i
                    class="fa fa-angle-down megamenu-mobile-icon"></i></a>


    </li>

    <li id="menu-item-275"
        class="menu-item menu-item-type-custom
        <?php if( strpos($_SERVER["REQUEST_URI"], "/projects/") !== false ||
            $_SERVER["REQUEST_URI"] == "/sertificates/"){ ?>current-menu-item<?php } ?>
        menu-item-object-custom menu-item-has-children
								menu-item-275 menu-first-level dropdown panel megamenu-column-2
								dropdown-toggle collapsed">
        <a href="/projects/" data-redirect-url="#" data-default-url="#collapse11"
           class="dropdown-toggle collapsed " data-hover="dropdown"
           data-toggle="collapse">Портфолио</a><a
                href="/projects/" class="dropdown-toggle collapsed megamenu-right-icon aaa"
                data-hover="dropdown" data-toggle="collapse"><i
                    class="fa fa-angle-down megamenu-mobile-icon"></i></a><!--mega-menu-full-->
        <ul id="collapse11"
            class="dropdown-menu mega-menu panel-collapse collapse mega-menu-full">
            <li id="menu-item-277"
                class="menu-item menu-item-type-custom menu-item-object-custom
										menu-item-has-children menu-item-277 mega-menu-column col-sm-6 dropdown-toggle collapsed">
                <div class="dropdown-header">
                    <a href="/projects/">Проекты</a>
                </div>
                <ul class="mega-sub-menu">
                    <li id="menu-item-278"
                        class="menu-item menu-item-type-post_type menu-item-object-page menu-item-278 dropdown-toggle collapsed">
                        <a href="/projects/best/">Лучшие проекты</a></li>
                    <li id="menu-item-279"
                        class="menu-item menu-item-type-post_type menu-item-object-page menu-item-279 dropdown-toggle collapsed">
                        <a href="/projects/first/">Одни из первых проектов</a></li>
                    <li id="menu-item-280"
                        class="menu-item menu-item-type-post_type menu-item-object-page menu-item-280 dropdown-toggle collapsed">
                        <a href="/projects/episodic/">Эпизодическое участие</a></li>

                </ul>
            </li>
            <li id="menu-item-287"
                class="menu-item menu-item-type-custom menu-item-object-custom
										menu-item-has-children menu-item-287 mega-menu-column col-sm-6
										dropdown-toggle collapsed">
                <div class="dropdown-header">
                    <a href="/sertificates/">Сертификаты</a>
                </div>
                <!--<ul class="mega-sub-menu">
                    <li id="menu-item-288"
                        class="menu-item menu-item-type-post_type menu-item-object-page menu-item-288 dropdown-toggle collapsed">
                        <a href="<?php echo PERSONAL_WP_HCODE_URL; ?>/h-code/portfolio-wide-2columns/">2
                            columns</a></li>
                    <li id="menu-item-289"
                        class="menu-item menu-item-type-post_type menu-item-object-page menu-item-289 dropdown-toggle collapsed">
                        <a href="<?php echo PERSONAL_WP_HCODE_URL; ?>/h-code/portfolio-wide-3columns/">3
                            columns</a></li>
                    <li id="menu-item-290"
                        class="menu-item menu-item-type-post_type menu-item-object-page menu-item-290 dropdown-toggle collapsed">
                        <a href="<?php echo PERSONAL_WP_HCODE_URL; ?>/h-code/portfolio-wide-4columns/">4
                            columns</a></li>
                    <li id="menu-item-291"
                        class="menu-item menu-item-type-post_type menu-item-object-page menu-item-291 dropdown-toggle collapsed">
                        <a href="<?php echo PERSONAL_WP_HCODE_URL; ?>/h-code/portfolio-wide-5columns/">5
                            columns</a></li>
                </ul>-->
            </li>

        </ul>
    </li>



    <li id="menu-item-363"
        class="menu-item menu-item-type-custom menu-item-object-custom menu-item-has-children
        menu-item-363 menu-first-level dropdown panel megamenu-column-4 dropdown-toggle collapsed
<?php if( strpos($_SERVER["REQUEST_URI"], "/skills/") !== false ){ ?>current-menu-item<?php } ?>
">
        <a href="/skills/" data-redirect-url="/skills/" data-default-url="#collapse28"
           class="dropdown-toggle collapsed " data-hover="dropdown"
           data-toggle="collapse">Навыки</a><a
                href="#collapse28" class="dropdown-toggle collapsed megamenu-right-icon aaa"
                data-hover="dropdown" data-toggle="collapse"><i
                    class="fa fa-angle-down megamenu-mobile-icon"></i></a>

    </li>
    <li id="menu-item-406"
        class="menu-item menu-item-type-custom menu-item-object-custom menu-item-has-children
        menu-item-406 menu-first-level simple-dropdown-right dropdown panel simple-dropdown
        dropdown-toggle collapsed
<?php if( strpos($_SERVER["REQUEST_URI"], "/info/") !== false ){ ?>current-menu-item<?php } ?>">
        <a href="/info/main/" data-redirect-url="#" data-default-url="#collapse33"
           class="dropdown-toggle collapsed " data-hover="dropdown"
           data-toggle="collapse">Инфо</a><a href="#collapse33"
                                             class="dropdown-toggle collapsed megamenu-right-icon aaa"
                                             data-hover="dropdown" data-toggle="collapse"><i
                    class="fa fa-angle-down megamenu-mobile-icon"></i></a>
        <ul id="collapse33" class="dropdown-menu mega-menu panel-collapse collapse">
            <li id="menu-item-407"
                class="menu-item menu-item-type-custom menu-item-object-custom
										menu-item-has-children menu-item-407 dropdown-toggle collapsed">
                <a href="/info/main/">Основные сведения</a>

            </li>
            <li id="menu-item-412"
                class="menu-item menu-item-type-custom menu-item-object-custom menu-item-has-children menu-item-412 dropdown-toggle collapsed">
                <a href="/info/about/">О себе</a>

            </li>
            <li id="menu-item-417"
                class="menu-item menu-item-type-custom menu-item-object-custom menu-item-has-children menu-item-417 dropdown-toggle collapsed">
                <a href="/info/experience/">Опыт работы</a>

            </li>

        </ul>
    </li>

    <li id="menu-item-429"
        class="menu-item menu-item-type-custom menu-item-object-custom menu-item-has-children
        menu-item-427 menu-first-level dropdown  megamenu-column-1 dropdown-toggle collapsed
<?php if( strpos($_SERVER["REQUEST_URI"], "/services/") !== false ){ ?>
current-menu-item
<?php } ?>
">
        <a href="/services/" data-redirect-url="/services/" data-default-url="#collapse40"
           class="dropdown-toggle collapsed " data-hover="dropdown"
           data-toggle="collapse">Услуги</a><a href="#collapse40"
                                               class="dropdown-toggle collapsed megamenu-right-icon aaa"
                                               data-hover="dropdown" data-toggle="collapse"><i
                    class="fa fa-angle-down megamenu-mobile-icon"></i></a>

    </li>

    <li id="menu-item-429"
        class="menu-item menu-item-type-custom menu-item-object-custom
        menu-item-has-children menu-item-427 menu-first-level dropdown panel
        megamenu-column-1 dropdown-toggle collapsed
<?php if( strpos($_SERVER["REQUEST_URI"], "/links/") !== false ){ ?>
current-menu-item
<?php } ?>

">
        <a href="/links/" data-redirect-url="/links/" data-default-url="#collapse40"
           class="dropdown-toggle collapsed " data-hover="dropdown"
           data-toggle="collapse">Ссылки</a><a href="#collapse40"
                                               class="dropdown-toggle collapsed megamenu-right-icon aaa"
                                               data-hover="dropdown" data-toggle="collapse"><i
                    class="fa fa-angle-down megamenu-mobile-icon"></i></a>

    </li>


    <li id="menu-item-406"
        class="menu-item menu-item-type-custom menu-item-object-custom
        menu-item-has-children menu-item-406 menu-first-level simple-dropdown-right
        dropdown panel simple-dropdown dropdown-toggle collapsed
<?php if( strpos($_SERVER["REQUEST_URI"], "/feedback/") !== false ){ ?>
current-menu-item
<?php } ?>">
        <a href="/feedback/simple/" data-redirect-url="#" data-default-url="#collapse33"
           class="dropdown-toggle collapsed " data-hover="dropdown"
           data-toggle="collapse">Обратная связь</a><a href="#collapse33"
                                                       class="dropdown-toggle collapsed megamenu-right-icon aaa"
                                                       data-hover="dropdown" data-toggle="collapse"><i
                    class="fa fa-angle-down megamenu-mobile-icon"></i></a>
        <ul id="collapse33" class="dropdown-menu mega-menu panel-collapse collapse">
            <li id="menu-item-407"
                class="menu-item menu-item-type-custom menu-item-object-custom
										menu-item-has-children menu-item-407 dropdown-toggle collapsed">
                <a href="/feedback/simple/">Простая форма</a>

            </li>
            <li id="menu-item-412"
                class="menu-item menu-item-type-custom menu-item-object-custom menu-item-has-children menu-item-412 dropdown-toggle collapsed">
                <a href="/feedback/project/">Форма заказа проекта</a>

            </li>
            <li id="menu-item-417"
                class="menu-item menu-item-type-custom menu-item-object-custom menu-item-has-children menu-item-417 dropdown-toggle collapsed">
                <a href="/feedback/calculator/">Калькулятор стоимости проекта</a>

            </li>

        </ul>
    </li>


</ul>