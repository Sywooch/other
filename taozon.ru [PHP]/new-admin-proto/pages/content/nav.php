
<ul class="breadcrumb">
    <li><a href="."><i class="icon-home"></i></a> <span class="divider">›</span></li>
    <li><a href="content/pages">Содержание</a> <span class="divider">›</span></li>
    <li class="active">Навигация</li>
</ul>
<!--/.breadcrumb-->

<? include('inc/sub_nav_content.php'); ?>



<div class="row-fluid">

    <div class="span10">
        <h1>Навигация</h1>
    </div>

    <div class="span2 offset-top1">
        <!-- site language -->
        <div class="btn-group pull-right">
            <a class="btn dropdown-toggle offset-top05" data-toggle="dropdown" href="#" title="Выбрать языковую версию сайта для редактирования">
                Ru
                <span class="caret"></span>
            </a>
            <ul class="dropdown-menu">
                <li><a data-value="Eng" href="#">Eng</a></li>
                <li><a data-value="Ch" href="#">Ch</a></li>
            </ul>
        </div>
        <!-- /site language -->
    </div>

</div>


<div class="tabbable offset-bottom1">

    <ul class="nav nav-tabs">
        <li class="active"><a href="#ot-top-nav-tab" data-toggle="tab">Верхняя</a></li>
        <li><a href="#ot-aside-nav-tab" data-toggle="tab">В колонке</a></li>
        <li><a href="#ot-bottom-nav-tab" data-toggle="tab">Нижняя</a></li>
    </ul>

    <div class="tab-content">


        <div class="tab-pane active" id="ot-top-nav-tab">

            <div class="well">

                <form class="form-horizontal ot_form" action="#">

                    <div class="row-fluid offset-bottom1">

                        <div class="span3">

                            <p><strong>Используется в меню</strong> <i class="icon-question-sign ot_inline_help" data-toggle="popover" data-placement="top" data-content="Локальная подсказка"></i></p>

                            <ol class="unstyled ot_sortable_list ot_sortable">
                                <li><span class="badge" title="О магазине"><i class="icon-move" title="Изменить порядок"></i> О магазине <i class="icon-remove" title="Удалить"></i></span></li>
                                <li><span class="badge" title="Доставка"> <i class="icon-move" title="Изменить порядок"></i> Доставка <i class="icon-remove" title="Удалить"></i></span></li>
                                <li><span class="badge" title="Спецпредложения"> <i class="icon-move" title="Изменить порядок"></i> Спецпредложения <i class="icon-remove" title="Удалить"></i></span></li>
                                <li><span class="badge" title="Как сделать заказ"><i class="icon-move" title="Изменить порядок"></i> Как сделать заказ<i class="icon-remove" title="Удалить"></i></span></li>
                                <li><span class="badge badge-success" title="Контактная информация"><i class="icon-move" title="Изменить порядок"></i> Контактная информация<i class="icon-remove" title="Удалить"></i></span></li>
                            </ol>
                        </div>

                        <div class="span4">
                            <p><strong>Список страниц</strong> <i class="icon-question-sign ot_inline_help" data-toggle="popover" data-placement="top" data-content="Отображаются только страницы первого уровня."></i></p>
                            <div class="row-fluid">

                                <select class="input-large select_searched_list span9">
                                    <option value="disclaimer">Пользовательское соглашение</option>
                                    <option value="delivery">Статьи</option>
                                    <option value="help">Помощь</option>
                                    <option value="sitemap">Карта сайта</option>
                                </select>

                                <button class="btn btn-small btn-primary offset-left1" title="Добавить страницу в меню"><i class="icon-plus"></i></button>
                            </div>
                        </div>

                    </div>


                    <button type="submit" class="btn btn_preloader btn-primary" data-loading-text="Сохраняется" autocomplete="off">Сохранить</button>

                </form>

            </div>

        </div><!-- /#ot-top-nav-tab -->


        <div class="tab-pane" id="ot-aside-nav-tab">

            <div class="well">

                <form class="form-horizontal ot_form" action="#">

                    <div class="row-fluid offset-bottom1">

                        <div class="span3">

                            <p><strong>Используется в меню</strong> <i class="icon-question-sign ot_inline_help" data-toggle="popover" data-placement="top" data-content="Локальная подсказка"></i></p>

                            <ol class="unstyled ot_sortable_list ot_sortable">
                                <li><span class="badge" title="О магазине"><i class="icon-move" title="Изменить порядок"></i> О магазине <i class="icon-remove" title="Удалить"></i></span></li>
                                <li>
                                    <span class="badge ot_sortable_sublist_spoiler" data-toggle="collapse" data-target=".ot_show_page_subpages" title="Статьи"> <i class="icon-move" title="Изменить порядок"></i> <i class="icon-caret-right"></i> Статьи <i class="icon-remove" title="Удалить"></i></span>

                                    <ol class="ot_show_page_subpages collapse">
                                        <li><span class="badge" title="Что такое taobao"><i class="icon-move" title="Изменить порядок"></i> Что такое taobao <i class="icon-remove" title="Удалить"></i></span></li>
                                        <li><span class="badge" title="Как правильно искать товар в каталоге"><i class="icon-move" title="Изменить порядок"></i> Как правильно искать товар в каталоге <i class="icon-remove" title="Удалить"></i></span></li>
                                    </ol>

                                </li>
                                <li><span class="badge badge-success" title="Как сделать заказ"><i class="icon-move" title="Изменить порядок"></i> Как сделать заказ<i class="icon-remove" title="Удалить"></i></span></li>
                            </ol>
                        </div>

                        <div class="span4">
                            <p><strong>Список страниц</strong> <i class="icon-question-sign ot_inline_help" data-toggle="popover" data-placement="top" data-content="Отображаются только страницы первого уровня."></i></p>
                            <div class="row-fluid">

                                <select class="input-large select_searched_list span9">
                                    <option value="special">Спецпредложения</option>
                                    <option value="delivery">Доставка</option>
                                    <option value="disclaimer">Пользовательское соглашение</option>
                                    <option value="help">Помощь</option>
                                    <option value="contacts">Контактная информация</option>
                                    <option value="sitemap">Карта сайта</option>
                                </select>

                                <button class="btn btn-small btn-primary offset-left1" title="Добавить страницу в меню"><i class="icon-plus"></i></button>
                            </div>
                        </div>

                    </div>


                    <button type="submit" class="btn btn_preloader btn-primary" data-loading-text="Сохраняется" autocomplete="off">Сохранить</button>

                </form>

            </div>

        </div><!-- /#ot-aside-nav-tab -->


        <div class="tab-pane" id="ot-bottom-nav-tab">

            <div class="well">

                <form class="form-horizontal ot_form" action="#">

                    <div class="row-fluid offset-bottom1">

                        <div class="span3">

                            <p><strong>Используется в меню</strong> <i class="icon-question-sign ot_inline_help" data-toggle="popover" data-placement="top" data-content="Локальная подсказка"></i></p>

                            <ol class="unstyled ot_sortable_list ot_sortable">
                                <li><span class="badge" title="О магазине"><i class="icon-move" title="Изменить порядок"></i> О магазине <i class="icon-remove" title="Удалить"></i></span></li>
                                <li><span class="badge" title="Доставка"> <i class="icon-move" title="Изменить порядок"></i> Доставка <i class="icon-remove" title="Удалить"></i></span></li>
                                <li><span class="badge" title="Как сделать заказ"><i class="icon-move" title="Изменить порядок"></i> Как сделать заказ<i class="icon-remove" title="Удалить"></i></span></li>
                                <li><span class="badge" title="Помощь"><i class="icon-move" title="Изменить порядок"></i> Помощь<i class="icon-remove" title="Удалить"></i></span></li>
                                <li><span class="badge" title="Контактная информация"><i class="icon-move" title="Изменить порядок"></i> Контактная информация<i class="icon-remove" title="Удалить"></i></span></li>
                                <li><span class="badge badge-success" title="Карта сайта"><i class="icon-move" title="Изменить порядок"></i> Карта сайта<i class="icon-remove" title="Удалить"></i></span></li>
                            </ol>
                        </div>

                        <div class="span4">
                            <p><strong>Список страниц</strong> <i class="icon-question-sign ot_inline_help" data-toggle="popover" data-placement="top" data-content="Отображаются только страницы первого уровня."></i></p>
                            <div class="row-fluid">

                                <select class="input-large select_searched_list span9">
                                    <option value="disclaimer">Пользовательское соглашение</option>
                                    <option value="special">Спецпредложения</option>
                                    <option value="delivery">Статьи</option>
                                </select>

                                <button class="btn btn-small btn-primary offset-left1" title="Добавить страницу в меню"><i class="icon-plus"></i></button>
                            </div>
                        </div>

                    </div>


                    <button type="submit" class="btn btn_preloader btn-primary" data-loading-text="Сохраняется" autocomplete="off">Сохранить</button>

                </form>

            </div>

        </div><!-- /#ot-bottom-nav-tab -->

    </div><!-- /.tab-content-->

</div><!-- /.tabbable -->