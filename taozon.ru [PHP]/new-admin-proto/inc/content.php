
<!-- global header -->
<header id="header" class="header fixed">

    <!-- topbar starts -->
    <div class="navbar ot_utility_nav">

        <div class="row-fluid">

            <div class="brand_wrap">
                <a class="brand" href="/" title="Перейти на сайт">agent-domain.ltd</a>
            </div><!-- .brand_wrap -->

            <ul class="nav">

                <li>
                    <!-- reports -->
                    <div class="btn-group">
                        <a class="btn dropdown-toggle btn-small" data-toggle="dropdown" href="support">
                            <i class="icon-envelope-alt"></i><span class="hidden-phone"> Тех. поддержка</span>
                            <strong>
                                (<span class="text-success">136</span> /
                                <span class="text-error">156</span>)
                            </strong>
                            <span class="caret"></span>
                        </a>
                        <ul class="dropdown-menu">
                            <li>
                                <a href="support/orders">Обращения по заказам
                                    (<span class="text-success">8</span> /
                                    <span class="text-error">12</span>)
                                </a>
                            </li>
                            <li>
                                <a href="support/general">Общие вопросы
                                    (<span class="text-success">128</span> /
                                    <span class="text-error">144</span>)
                                </a>
                            </li>
                        </ul>
                    </div>
                    <!-- /reports -->
                </li>

            </ul><!-- /.nav -->

            <ul class="nav pull-right">

                <li>
                    <!-- help -->
                    <div class="btn-group">
                        <a class="btn dropdown-toggle btn-small" data-toggle="dropdown" href="#">
                            <i class="icon-question-sign"></i><span class="hidden-phone"> Помощь</span>
                            <span class="caret"></span>
                        </a>
                        <ul class="dropdown-menu">
                            <li><a href="#">Часто задаваемые вопросы</a></li>
                            <li><a href="#">Справка</a></li>
<!--                            <li><a href="#">Гид по разделу</a></li>-->
                            <li class="divider"></li>
                            <li><a href="#">Обратиться в службу поддержки <i class="icon-external-link"></i></a></li>
                        </ul>
                    </div>
                    <!-- /help -->
                </li>

                <li>
                    <!-- settings dropdown -->
                    <div class="btn-group ot_globall_settings">
                        <a class="btn dropdown-toggle btn-small" data-toggle="dropdown" href="#"><i class="icon-cogs"></i> <span class="hidden-phone">Настройки</span> <span class="caret"></span></a>
                        <ul class="dropdown-menu">
<!--                            <li><a href="#">Добавить в избранные разделы</a></li>-->
<!--                            <li><a href="#">Выводить на панели инструментов</a></li>-->

                            <li class="dropdown-submenu pull-left">
                                <!-- admin interface language -->
                                <a tabindex="-1" href="#">Язык админки</a>
                                <ul class="dropdown-menu">
                                    <li><a href="#">Eng</a></li>
                                    <li><a href="#">Ch</a></li>
                                </ul>
                            </li>
                            <li class="dropdown-submenu pull-left">
                                <!-- pages for developers -->
                                <a tabindex="-1" href="#">Разработчикам</a>
                                <ul class="dropdown-menu">
                                    <li><a href="test/elements">Элементы</a></li>
                                    <li><a href="login">Авторизация</a></li>
                                </ul>
                            </li>

                            <li class="divider"></li>
                            <li><a href="#">Сбросить кеш</a></li>
                        </ul>
                    </div>
                    <!-- settings dropdown ends -->
                </li>

                <li>
                    <!-- user dropdown -->
                    <div class="btn-group">
                        <a class="btn btn-small dropdown-toggle" data-toggle="dropdown" href="#">
                            <i class="icon-user icon-white"></i><span class="hidden-phone"> Суперадмин</span>
                            <span class="caret"></span>
                        </a>
                        <ul class="dropdown-menu">
<!--                            <li><a href=".">Панель инструментов</a></li>-->
                            <li><a href="#">Личный кабинет</a></li>
<!--                            <li><a href="#">Избранные разделы</a></li>-->
                            <li><a href="#">Админка 1.0</a></li>
                            <li class="divider"></li>
                            <li><a href="login">Выйти</a></li>
                        </ul>
                    </div>
                    <!-- user dropdown ends -->
                </li>

            </ul>

        </div><!-- /row-fluid -->

    </div><!--/.navbar .ot_utility_nav -->

</header><!-- /.header -->

<!-- global content -->
<section id="wrapper">

    <div class="row-fluid">

        <!-- span side-left -->
        <div class="span2">

            <!--sidebar-->
            <aside class="side-left fixed">

                <!-- main navigation -->
                <nav>
                    <ul class="ot_main_nav">
                        <? include("inc/main_nav.php"); ?>
                    </ul>
                </nav><!-- /main navigation -->

            </aside><!--/sidebar -->

        </div><!-- span side-left -->

        <!-- span content -->
        <div class="span10">

            <!-- content -->
            <div class="ot_content">

                <noscript>
                    <div class="alert alert-block">
                        <h4 class="alert-heading">Warning!</h4>
                        <p>You need to have <a href="http://en.wikipedia.org/wiki/JavaScript" target="_blank">JavaScript</a> enabled to use this site.</p>
                    </div>
                </noscript><!-- no script message -->

                <!--[if lt IE 7]>
                <div class="alert alert-block">
                    <p class="chromeframe">You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade your browser</a> or <a href="http://www.google.com/chromeframe/?redirect=true">activate Google Chrome Frame</a> to improve your experience.</p>
                </div>
                <![endif]-->

                <? if
                    (file_exists("pages/$uri.php")):
                        include("pages/$uri.php"); //content pages
                    else:
                        include("pages/404.php"); //404 page
                    endif;
                ?>

                    <!-- page sys log -->
                    <?  include("inc/sys_log.php"); ?>

            </div><!-- /.ot_content -->
        </div><!-- /.span10-->

    </div><!-- /.row-fluid -->

    <? include("inc/global_modals.php"); ?> <!-- all global modals -->

    <div id="underground"></div><!-- extra element for pushing footer -->

</section><!-- /#wrapper-->

<!-- global footer -->
<footer id="footer">

    <div class="row-fluid">

        <div class="span10 offset2">

            <a href="http://box.opentao.net/" class="ot_copyright" title="Коробка разработана компанией Opentao"><i class="ot_logo"></i>Opentao.net</a>

        </div>

    </div>

</footer>


<a href="#top" rel="go_to_top" title="Наверх"><i class="icon-long-arrow-up"></i></a>