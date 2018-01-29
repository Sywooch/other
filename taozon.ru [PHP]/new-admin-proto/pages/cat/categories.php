
<ul class="breadcrumb">
    <li><a href="."><i class="icon-home"></i></a> <span class="divider">›</span></li>
    <li><a href="cat/categories">Каталог</a> <span class="divider">›</span></li>
    <li class="active">Категории</li>
</ul>
<!--/.breadcrumb-->

<? include('inc/sub_nav_cat.php'); ?>



<div class="row-fluid">

    <div class="span6">
        <h1>Категории</h1>
    </div>

    <div class="span6 offset-top2 text-right">

        <div class="btn-group">
            <button data-toggle="dropdown" class="btn btn-tiny dropdown-toggle" title="Экспортировать категории"><i class="icon-upload-alt"></i> Экспортировать <span class="caret"></span></button>
            <ul class="dropdown-menu">
                <li><a href="#" title="В формате .xml">.xml</a></li>
                <li><a href="#" title="В формате .txt">.txt</a></li>
            </ul>
        </div>

        <button class="btn btn-tiny offset-right05 dropdown-toggle" data-dropdown="#ot_import_cat" data-toggle="dropdown" title="Импорт подписчиков в форматах .xml или .txt"><i class="icon-download-alt"></i> Импортировать</button>

        <div id="ot_import_cat" class="dropdown dropdown-tip dropdown-anchor-right">
            <div class="dropdown-panel">
                <button class="btn btn-primary ladda-button ladda-progress-button"><span class="ladda-label">Загрузить</span><span class="ladda-spinner"></span><div class="ladda-progress"></div></button>
            </div>
        </div>


        <!-- site language -->
        <div class="btn-group pull-right">
            <a class="btn btn-tiny dropdown-toggle" data-toggle="dropdown" href="#" title="Выбрать языковую версию сайта для редактирования">
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


<div class="row-fluid offset-top1">

    <div class="span3">
        <i class="icon-eye-close"></i> Скрытые:
        <a class="blink ot_inline_select_editable_pure" href="#" data-type="select" data-pk="2" data-url="/post">Отображать</a>
    </div>

    <div class="span3">
        <i class="icon-exclamation-sign"></i> Пустые:
        <a class="blink ot_inline_select_editable_pure" href="#" data-type="select" data-pk="2" data-url="/post">Отображать</a>
    </div>

    <div class="span6">
        <i class="icon-sitemap"></i> Пустые без подкатегорий:
        <a class="blink ot_inline_select_editable_pure" href="#" data-type="select" data-pk="2" data-url="/post">Отображать</a>
    </div>

</div>


<div class="well">

<!--   <p class="offset-bottom1"><button class="btn btn-tiny">-->
<!--           <i class="icon-code-fork icon-rotate-180"></i>-->

           <span class="blink blink-iconed ot_show_crud_cat_item_window" title="Добавить корневую категорию"><i class="icon-plus-sign"></i> Добавить корневую категорию</span>
<!--       </button>-->
   </p>

    <div class="ot_tree ot_cat_tree">
        <ul>
            <li class="jstree-open">

                <a href="#">Категории</a>

                <ul>
                    <li>
                        <a href="#">Обувь</a>

                        <!-- cat functions -->
                        <span class="ot_cat_actions">

                            <button class="btn btn-tiny offset-right1" title="Переместить категорию"><i class="icon-move"></i></button>

                            <span class="btn-group">
                                <button class="btn btn-tiny" title="Редактировать категорию"><i class="icon-pencil"></i></button>
                                <button class="btn btn-tiny ot_show_add_cat_item_window" title="Добавить категорию"><i class="icon-plus"></i></button>
                                <button class="btn btn-tiny" title="Скрыть категорию"><i class="icon-eye-close"></i></button>
<!--                                <button class="btn btn-tiny" title="Показать категорию"><i class="icon-eye-open"></i></button>-->
                                <button class="btn btn-tiny" title="Просмотреть категорию на сайте"><i class="icon-search"></i></button>
                                <button class="btn btn-tiny ot_show_deletion_dialog_modal" title="Удалить категорию"><i class="icon-remove"></i></button>
                            </span>

                            <span class="offset-left1"><span class="btn-group">
                                <button class="btn btn-tiny" title="Переместить вверх"><i class="icon-level-up"></i></button>
                                <button class="btn btn-tiny" title="Переместить вниз"><i class="icon-level-down"></i></button>
                                <button class="btn btn-tiny" title="Копировать"><i class="icon-copy"></i></button>
                                <button class="btn btn-tiny" title="Вырезать"><i class="icon-cut"></i></button>
                                <button class="btn btn-tiny" title="Вставить"><i class="icon-paste"></i></button>
                            </span></span>

                        </span><!-- /.ot_cat_actions -->

                        <ul>
                            <li><a href="#">Туфли</a></li>
                            <li><a href="#">Сапоги</a></li>
                            <li><a href="#">Ботинки</a></li>
                        </ul>
                    </li>
                    <li>
                        <a href="#">Детская одежда</a>

                        <!-- cat functions -->
                        <span class="ot_cat_actions">

                            <button class="btn btn-tiny offset-right1" title="Переместить категорию"><i class="icon-move"></i></button>

                            <span class="btn-group">
                                <button class="btn btn-tiny" title="Редактировать категорию"><i class="icon-pencil"></i></button>
                                <button class="btn btn-tiny" title="Добавить категорию"><i class="icon-plus"></i></button>
<!--                                <button class="btn btn-tiny" title="Скрыть категорию"><i class="icon-eye-close"></i></button>-->
                                <button class="btn btn-tiny disabled" title="Показать категорию"><i class="ot-preloader-micro"></i></button>
                                <button class="btn btn-tiny" title="Просмотреть категорию на сайте"><i class="icon-search"></i></button>
                                <button class="btn btn-tiny ot_show_deletion_dialog_modal" title="Удалить категорию"><i class="icon-remove"></i></button>
                            </span>

                            <span class="offset-left1"><span class="btn-group">
                                <button class="btn btn-tiny" title="Переместить вверх"><i class="icon-level-up"></i></button>
                                <button class="btn btn-tiny" title="Переместить вниз"><i class="icon-level-down"></i></button>
                                <button class="btn btn-tiny" title="Копировать"><i class="icon-copy"></i></button>
                                <button class="btn btn-tiny" title="Вырезать"><i class="icon-cut"></i></button>
                                <button class="btn btn-tiny" title="Вставить"><i class="icon-paste"></i></button>
                            </span></span>

                        </span><!-- /.ot_cat_actions -->


                    </li>
                    <li>
                        <a href="#">Спортивная одежда</a>

                        <!-- cat functions -->
                        <span class="ot_cat_actions">

                            <button class="btn btn-tiny offset-right1" title="Переместить категорию"><i class="icon-move"></i></button>

                            <span class="btn-group">
                                <button class="btn btn-tiny" title="Редактировать категорию"><i class="icon-pencil"></i></button>
                                <button class="btn btn-tiny" title="Добавить категорию"><i class="icon-plus"></i></button>
<!--                                <button class="btn btn-tiny" title="Скрыть категорию"><i class="icon-eye-close"></i></button>-->
                                <button class="btn btn-tiny" title="Показать категорию"><i class="icon-eye-open"></i></button>
                                <button class="btn btn-tiny" title="Просмотреть категорию на сайте"><i class="icon-search"></i></button>
                                <button class="btn btn-tiny ot_show_deletion_dialog_modal" title="Удалить категорию"><i class="icon-remove"></i></button>
                            </span>

                            <span class="offset-left1"><span class="btn-group">
                                <button class="btn btn-tiny" title="Переместить вверх"><i class="icon-level-up"></i></button>
                                <button class="btn btn-tiny" title="Переместить вниз"><i class="icon-level-down"></i></button>
                                <button class="btn btn-tiny" title="Копировать"><i class="icon-copy"></i></button>
                                <button class="btn btn-tiny" title="Вырезать"><i class="icon-cut"></i></button>
                                <button class="btn btn-tiny" title="Вставить"><i class="icon-paste"></i></button>
                            </span></span>

                        </span><!-- /.ot_cat_actions -->
                    </li>
                </ul>
            </li>
        </ul>
    </div>
</div>




<!-- upload photos window -->
<div class="modal hide fade ot_crud_cat_item_window" tabindex="-1">

    <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <h3>Добавить/редактировать категорию</h3>
    </div>

    <div class="modal-body">

        <ul class="nav nav-tabs">
            <li class="active"><a href="#ot_cat_data" data-toggle="tab">Данные</a></li>
            <li><a href="#ot_cat_meta" data-toggle="tab">Мета</a></li>
            <li><a href="#ot_cat_content" data-toggle="tab">Содержание</a></li>
            <li><a href="#ot_cat_filters" data-toggle="tab">Фильтры</a></li>
        </ul>

        <div class="tab-content">

            <!-- cat data tab -->
            <div class="tab-pane active" id="ot_cat_data">

                <form method="post" action="" class="form-horizontal ot_form">

                    <div class="control-group">
                        <label class="control-label bold">Название <i class="icon-question-sign ot_inline_help" data-toggle="popover" data-placement="top" data-content="Локальная помощь"></i></label>
                        <div class="controls">
                            <input class="input-large" type="text" required="required" title="Обязательное поле">
                        </div>
                    </div>

                    <div class="control-group">
                        <label class="control-label bold">ID категории <i class="icon-question-sign ot_inline_help" data-toggle="popover" data-placement="top" data-content="Локальная помощь"></i></label>
                        <div class="controls">
                            <input class="input-mini" type="text">
                        </div>
                    </div>

                    <div class="control-group">
                        <label class="control-label bold">Примерный вес <i class="icon-question-sign ot_inline_help" data-toggle="popover" data-placement="top" data-content="Локальная помощь"></i></label>
                        <div class="controls">
                            <input class="input-mini" type="text">
                        </div>
                    </div>

                    <div class="control-group">
                        <label class="control-label bold">Адрес раздела <i class="icon-question-sign ot_inline_help" data-toggle="popover" data-placement="top" data-content="Локальная помощь"></i></label>
                        <div class="controls">
                            <input class="input-large" type="text">
                        </div>
                    </div>

                </form>

            </div>

            <!-- cat meta tab -->
            <div class="tab-pane" id="ot_cat_meta">

                <form method="post" action="" class="form-horizontal ot_form">

                    <div class="control-group">
                        <label class="control-label">Заголовок <i class="icon-question-sign ot_inline_help" data-toggle="popover" data-placement="top" data-content="Title"></i></label>
                        <div class="controls">
                            <input class="input-large" type="text">
                        </div>
                    </div>

                    <div class="control-group">
                        <label class="control-label">Текст до заголовка <i class="icon-question-sign ot_inline_help" data-toggle="popover" data-placement="top" data-content="Текст выводимый на всех страницах до заголовка (до title)"></i></label>
                        <div class="controls">
                            <input class="input-medium" type="text">
                        </div>
                    </div>

                    <div class="control-group">
                        <label class="control-label">Текст после заголовка <i class="icon-question-sign ot_inline_help" data-toggle="popover" data-placement="top" data-content="Текст выводимый на всех страницах после заголовка (после title)"></i></label>
                        <div class="controls">
                            <input class="input-medium" type="text">
                        </div>
                    </div>

                    <div class="control-group">
                        <label class="control-label">Ключевые слова <i class="icon-question-sign ot_inline_help" data-toggle="popover" data-placement="top" data-content="Meta keywords"></i></label>
                        <div class="controls">
                            <textarea cols="20" rows="2" class="input-block-level"></textarea>
                        </div>
                    </div>

                    <div class="control-group">
                        <label class="control-label">Описание <i class="icon-question-sign ot_inline_help" data-toggle="popover" data-placement="top" data-content="Meta discription"></i></label>
                        <div class="controls">
                            <textarea cols="20" rows="2" class="input-block-level"></textarea>
                        </div>
                    </div>

                </form>

            </div>

            <!-- cat content tab-->
            <div class="tab-pane" id="ot_cat_content">

                <textarea cols="30" rows="10" class="input-block-level"></textarea>

            </div>

            <!-- cat filters tab -->
            <div class="tab-pane" id="ot_cat_filters">

                <h3>Редактирование фильтров категорий</h3>

                <div class="accordion" id="ot_filters_rename_accordion">

                    <div class="accordion-group">

                        <div class="accordion-heading">
                            <a class="accordion-toggle" data-toggle="collapse" data-parent="#ot_filters_rename_accordion" href="#collapseOne">
                                <span class="ot_cat_filters_editable" title="Редактировать название">Цвет</span>
                            </a>
                        </div>

                        <div id="collapseOne" class="accordion-body collapse">
                            <div class="accordion-inner">
                                <ul class="unstyled">
                                    <li class="offset-bottom04"><span class="blink ot_cat_filters_editable" title="Редактировать название">Белый</span></li>
                                    <li class="offset-bottom04"><span class="blink ot_cat_filters_editable" title="Редактировать название">Желтый</a></li>
                                    <li class="offset-bottom04"><span class="blink ot_cat_filters_editable" title="Редактировать название">Красный</a></li>
                                    <li class="offset-bottom04"><span class="blink ot_cat_filters_editable" title="Редактировать название">Зеленый</a></li>
                                </ul>
                            </div>
                        </div>

                    </div>

                    <div class="accordion-group">
                        <div class="accordion-heading">
                            <a class="accordion-toggle" data-toggle="collapse" data-parent="#ot_filters_rename_accordion" href="#collapse2">
                                <span class="ot_cat_filters_editable" title="Редактировать название">Бренд</span>
                            </a>
                        </div>
                        <div id="collapse2" class="accordion-body collapse">
                            <div class="accordion-inner">
                                <ul class="unstyled">
                                    <li class="offset-bottom04"><span class="blink ot_cat_filters_editable" title="Редактировать название">HOME JOY/合室家</span></li>
                                    <li class="offset-bottom04"><span class="blink ot_cat_filters_editable" title="Редактировать название">Dorlink/多灵</span></li>
                                    <li class="offset-bottom04"><span class="blink ot_cat_filters_editable" title="Редактировать название">WEISI/威士</span></li>
                                    <li class="offset-bottom04"><span class="blink ot_cat_filters_editable" title="Редактировать название">Beman/百乐门</span></li>
                                </ul>
                            </div>
                        </div>
                    </div>

                </div>


            </div>

        </div>

    </div>

    <div class="modal-footer">
        <button type="submit" class="btn btn_preloader btn-primary pull-left" data-loading-text="Сохраняется" autocomplete="off">Сохранить</button>
        <a href="#" class="btn pull-right" data-dismiss="modal">Отменить</a>
    </div>

</div>

