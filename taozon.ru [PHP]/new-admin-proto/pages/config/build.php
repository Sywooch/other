
<ul class="breadcrumb">
    <li><a href="."><i class="icon-home"></i></a> <span class="divider">›</span></li>
    <li><a href="config/build">Конфигурация</a> <span class="divider">›</span></li>
    <li class="active">Конструкция сайта</li>
</ul>
<!--/.breadcrumb-->

<? include('inc/sub_nav_config.php'); ?>


<div class="row-fluid">

    <div class="span10">
        <h1>Конструкция сайта</h1>
    </div>

    <div class="span2 offset-top1">
        <!-- site language -->
        <div class="btn-group pull-right">
            <a class="btn dropdown-toggle offset-top05" data-toggle="dropdown" href="#" title="Выбрать языковую версию сайта для редактирования">
                Все языковые версии
                <span class="caret"></span>
            </a>
            <ul class="dropdown-menu">
                <li><a data-value="Ru" href="#">Ru</a></li>
                <li><a data-value="Eng" href="#">Eng</a></li>
                <li><a data-value="Ch" href="#">Ch</a></li>
            </ul>
        </div>
        <!-- /site language -->
    </div>

</div>


<!-- global template configuration -->
<div class="box corner-all">
    <div class="box-header corner-top">
        <div class="header-control">
            <a data-box="collapse"><i class="icon-caret-up"></i></a>
        </div>
        <i class="icon-columns font-14"></i> Глобальный шаблон сайта
    </div>

    <div class="box-body">

        <form class="form-horizontal inline_editable_form ot_form">

            <div class="row-fluid">

                <div class="span6">

                    <fieldset class="clearfix">

                <legend class="legend-small">Шапка сайта</legend>


                <!-- В это поле будет добавлен плагин для загрузки изображений -->
                <div class="control-group control-group-medium">
                    <label class="control-label">Логотип <i class="icon-question-sign ot_inline_help" data-toggle="popover" data-placement="top" data-content="Это локальная подсказка, призванная пояснять пользователям назначение элементов." title="" data-original-title="Локальная помощь"></i></label>
                    <div class="controls">
                        <a class="ot_inline_text_editable" href="#" data-type="text" data-pk="1" data-url="/post" data-original-title="Enter something">Логотип Опентао</a>
                        <!--
                         Пробуем прикрутить сюда внятную закрузку файлов с предпросмотром загружаемого изображения как здесь — http://jasny.github.io/bootstrap/javascript.html#fileupload -->
                    </div>
                </div>

                <div class="control-group control-group-medium">
                    <label class="control-label">Заголовок сайта <i class="icon-question-sign ot_inline_help" data-toggle="popover" data-placement="top" data-content="Это локальная подсказка, призванная пояснять пользователям назначение элементов."></i></label>
                    <div class="controls width-12">
                        <a class="ot_inline_textarea_editable text-clipped-general" href="#" data-type="textarea" data-pk="3" data-url="/post">Демонстрационная платформа платформа Опентао Опентао</a>
                    </div>
                </div>

                <div class="control-group control-group-medium">
                    <label class="control-label">Телефон <i class="icon-question-sign ot_inline_help" data-toggle="popover" data-placement="top" data-content="Это локальная подсказка, призванная пояснять пользователям назначение элементов." title="" data-original-title="Локальная помощь"></i></label>
                    <div class="controls">
                        <a class="ot_inline_select_editable" href="#" data-type="select" data-pk="2" data-url="/post" data-original-title="Enter something"></a>
                        <!--
                        TODO: Поступим здесь проще.
                        Делаем два отдельных поля по Витальцу, но для отображения на морде нужно делать проверку, что если ни одно из полей не заполенно, то сам блок не выводить. В смысле Телефон и График работы.
                         -->
                    </div>
                </div>

                <div class="control-group control-group-medium">
                    <label class="control-label">График работы <i class="icon-question-sign ot_inline_help" data-toggle="popover" data-placement="top" data-content="Это локальная подсказка, призванная пояснять пользователям назначение элементов." title="" data-original-title="Локальная помощь"></i></label>
                    <div class="controls">
                        <a class="ot_inline_select_editable" href="#" data-type="select" data-pk="2" data-url="/post" data-original-title="Enter something"></a>
                        <!--
                        TODO: Поступим здесь проще.
                        Делаем два отдельных поля по Витальцу, но для отображения на морде нужно делать проверку, что если ни одно из полей не заполенно, то сам блок не выводить. В смысле Телефон и График работы.
                        Значение по умолчанию, когда информация не заполненно — не заполненно.
                         -->
                    </div>
                </div>

                <div class="control-group control-group-medium">
                    <label class="control-label">Онлайн поддержка <i class="icon-question-sign ot_inline_help" data-toggle="popover" data-placement="bottom" data-content="Это локальная подсказка, призванная пояснять пользователям назначение элементов." title="" data-original-title=""></i></label>
                    <div class="controls">
                        <a class="ot_inline_textarea_editable text-clipped" href="#" data-type="textarea" data-pk="3" data-url="/post" data-original-title="Вставьте сюда код чата"></a>
                        <!--
                         * TODO:
                         1) Я лоханулся и никакой slide-toggle здесь не нужен, а нужно делать проверку, если поле заполненно, то выводить блок с онлайн чатом в шапке, если нет, то соответственно не выводить.
                         2) Вставляться-то ведь туда будет жабракадабра, значит нам нельзя в этом же виде выводить значение поля. Таким образом нужно как-то попытаться допилить до следующего состояния: Не заполнено — подключено, то есть при сохранении вставленной инфы нужно писать «Подключено». Я там обрезание сделал на всякий случай, но желательно все-таки по-людски допилить.
                         Значение по умолчанию, когда информация не заполненно — не заполненно.
                         -->
                    </div>
                </div>

            </fieldset>

                </div>

                <div class="span6">

                    <fieldset class="clearfix">

                        <legend class="legend-small">Настройка текстовых страниц</legend>

                        <div class="control-group control-group-medium">
                            <label class="control-label" for="ot_sidebar_nav_display">Навигация в колонке <i class="icon-question-sign ot_inline_help" data-toggle="popover" data-placement="right" data-content="Это локальная подсказка, призванная пояснять пользователям назначение элементов." title="" data-original-title="Локальная помощь"></i></label>
                            <div class="controls">
                                <a class="ot_inline_select_editable" href="#" data-type="select" data-pk="3" data-url="/post">Меню второго уровня</a>
                                <!--<select id="ot_sidebar_nav_display" name="ot_sidebar_nav_display" class="input-large">
                                    <option>Меню второго уровня</option>
                                    <option>Все страницы сайта</option>
                                    <option>Скрыть</option>
                                </select>-->
                            </div>
                        </div>

                        <div class="control-group control-group-medium">
                            <label class="control-label" for="ot_text_direction">Направление текста <i class="icon-question-sign ot_inline_help" data-toggle="popover" data-placement="top" data-content="Это локальная подсказка, призванная пояснять пользователям назначение элементов." title="" data-original-title="Локальная помощь"></i></label>
                            <div class="controls">
                                <a class="ot_inline_select_editable" href="#" data-type="select" data-pk="3" data-url="/post">Слева направо</a>
                                <!--<select id="ot_text_direction" name="ot_text_direction" class="input-medium">
                                    <option>→ Слева направо</option>
                                    <option>← Справа налево</option>
                                </select>-->
                            </div>
                        </div>

                        <div class="control-group control-group-medium">
                            <label class="control-label" for="ot_add_meta_text">Свой код в секции head <i class="icon-question-sign ot_inline_help" data-toggle="popover" data-placement="top" data-content="Это локальная подсказка, призванная пояснять пользователям назначение элементов."></i></label>
                            <div class="controls">
                                <a class="ot_inline_textarea_editable text-clipped" href="#" data-type="textarea" data-pk="5" data-url="/post" data-original-title="" data-placeholder="Скопируйте в поле необходимый код"></a>
        <!--                        <textarea id="ot_add_meta_text" name="ot_add_meta_text" class="input-large" placeholder="Например: подтверждение прав для поисковых систем."></textarea>-->
                            </div>
                        </div>

                    </fieldset>



                </div>

            </div>

            <fieldset class="clearfix" data-toggle="modal-gallery" data-target="#modal-gallery">

                <legend class="legend-small">Темы дизайна</legend>


                <ul class="thumbnails ot_sortable_cols offset-top2">

                    <li>
                        <div class="thumbnail">
                            <header><h3 title="Тема «Стандартная»">Стандартная</h3></header>
                            <a href="img/pic/themes/theme_standart.png" title="Тема «Стандартная»" class="img_preview" data-gallery="gallery"><img src="img/pic/themes/theme_standart_preview.png" alt=""></a>
                            <p class="offset-top03"><button class="btn btn-mini btn_preloader" data-loading-text="Установить" autocomplete="off" title="Установить тему"><i class="icon-ok"></i> <span class="hidden-phone">Установить</span></button></p>
                        </div>
                    </li>

                    <li>
                        <div class="thumbnail">
                            <header><h3 title="Тема «Облака»">Облака</h3></header>
                            <a href="img/pic/themes/theme_cloud.png" title="Тема «Облака»" class="img_preview" data-gallery="gallery"><img src="img/pic/themes/theme_cloud_preview.png" alt=""></a>
                            <p class="offset-top03"><button class="btn btn-mini btn_preloader" data-loading-text="Установить" autocomplete="off" title="Установить тему"><i class="icon-ok"></i> <span class="hidden-phone">Установить</span></button></p>
                        </div>
                    </li>

                    <li>
                        <div class="thumbnail selected_item">
                            <header><h3 title="Тема «Серая»"><strong>Серая</strong></h3></header>
                            <a href="img/pic/themes/theme_grey.png" title="Тема «Серая»" class="img_preview" data-gallery="gallery"><img src="img/pic/themes/theme_grey_preview.png" alt=""></a>
                            <div class="offset-top04"><span class="badge badge-success weight-normal offset-bottom09">Текущая тема</span></div>
                        </div>
                    </li>

                    <li>
                        <div class="thumbnail">
                            <header><h3 title="Тема «Облака»">Облака</h3></header>
                            <a href="img/pic/themes/theme_cloud.png" title="Тема «Облака»" class="img_preview" data-gallery="gallery"><img src="img/pic/themes/theme_cloud_preview.png" alt=""></a>
                            <p class="offset-top03"><button class="btn btn-mini btn_preloader" data-loading-text="Установить" autocomplete="off" title="Установить тему"><i class="icon-ok"></i> <span class="hidden-phone">Установить</span></button></p>
                        </div>
                    </li>

                    <li>
                        <div class="thumbnail">
                            <header><h3 title="Тема «Облака»">Облака</h3></header>
                            <a href="img/pic/themes/theme_cloud.png" title="Тема «Облака»" class="img_preview" data-gallery="gallery"><img src="img/pic/themes/theme_cloud_preview.png" alt=""></a>
                            <p class="offset-top03"><button class="btn btn-mini btn_preloader" data-loading-text="Установить" autocomplete="off" title="Установить тему"><i class="icon-ok"></i> <span class="hidden-phone">Установить</span></button></p>
                        </div>
                    </li>

                </ul>

                <ul class="thumbnails ot_sortable_cols">

                    <li>
                        <div class="thumbnail">
                            <header><h3 title="Тема «Облака»">Облака</h3></header>
                            <a href="img/pic/themes/theme_cloud.png" title="Тема «Облака»" class="img_preview" data-gallery="gallery"><img src="img/pic/themes/theme_cloud_preview.png" alt=""></a>
                            <p class="offset-top03"><button class="btn btn-mini btn_preloader" data-loading-text="Установить" autocomplete="off" title="Установить тему"><i class="icon-ok"></i> <span class="hidden-phone">Установить</span></button></p>
                        </div>
                    </li>

                    <li>
                        <div class="thumbnail">
                            <header><h3 title="Тема «Облака»">Облака</h3></header>
                            <a href="img/pic/themes/theme_cloud.png" title="Тема «Облака»" class="img_preview" data-gallery="gallery"><img src="img/pic/themes/theme_cloud_preview.png" alt=""></a>
                            <p class="offset-top03"><button class="btn btn-mini btn_preloader" data-loading-text="Установить" autocomplete="off" title="Установить тему"><i class="icon-ok"></i> <span class="hidden-phone">Установить</span></button></p>
                        </div>
                    </li>

                    <li>
                        <div class="thumbnail">
                            <header><h3 title="Тема «Облака»">Облака</h3></header>
                            <a href="img/pic/themes/theme_cloud.png" title="Тема «Облака»" class="img_preview" data-gallery="gallery"><img src="img/pic/themes/theme_cloud_preview.png" alt=""></a>
                            <p class="offset-top03"><button class="btn btn-mini btn_preloader" data-loading-text="Установить" autocomplete="off" title="Установить тему"><i class="icon-ok"></i> <span class="hidden-phone">Установить</span></button></p>
                        </div>
                    </li>

                    <li>
                        <div class="thumbnail">
                            <header><h3 title="Тема «Облака»">Облака</h3></header>
                            <a href="img/pic/themes/theme_cloud.png" title="Тема «Облака»" class="img_preview" data-gallery="gallery"><img src="img/pic/themes/theme_cloud_preview.png" alt=""></a>
                            <p class="offset-top03"><button class="btn btn-mini btn_preloader" data-loading-text="Установить" autocomplete="off" title="Установить тему"><i class="icon-ok"></i> <span class="hidden-phone">Установить</span></button></p>
                        </div>
                    </li>

                    <li>
                        <div class="thumbnail">
                            <header><h3 title="Тема «Облака»">Облака</h3></header>
                            <a href="img/pic/themes/theme_cloud.png" title="Тема «Облака»" class="img_preview" data-gallery="gallery"><img src="img/pic/themes/theme_cloud_preview.png" alt=""></a>
                            <p class="offset-top03"><button class="btn btn-mini btn_preloader" data-loading-text="Установить" autocomplete="off" title="Установить тему"><i class="icon-ok"></i> <span class="hidden-phone">Установить</span></button></p>
                        </div>
                    </li>

                </ul>

            </fieldset>

        </form>

    </div>
</div>



<!-- main page configuration -->
<div class="box corner-all">

    <div class="box-header corner-top">
        <div class="header-control">
            <a data-box="collapse"><i class="icon-caret-up"></i></a>
        </div>
        <i class="icon-home font-14"></i> Главная страница
    </div>

    <div class="box-body">

        <form class="form-horizontal inline_editable_form ot_form">

            <fieldset class="clearfix">

                <legend class="legend-small">Отображение</legend>

                <div class="control-group control-group-medium">
                    <label class="control-label">Выводить товары <i class="icon-question-sign ot_inline_help" data-toggle="popover" data-placement="top" data-content="Это локальная подсказка, призванная пояснять пользователям назначение элементов." title="" data-original-title="Локальная помощь"></i></label>
                    <div class="controls">
                        <a class="ot_inline_select_editable" href="#" data-type="select" data-pk="3" data-url="/post" data-original-title="Enter something">Списком</a>
                        <!--<select id="ot_mainpage_items_view" name="selectbasic" class="input-medium">
                            <option>Списком</option>
                            <option>Каруселью</option>
                        </select>-->
                    </div>
                </div>
            </fieldset>


            <fieldset class="clearfix">

                <legend class="legend-small">
                    Количество выводимых элементов в блоках
                    <i class="icon-question-sign ot_inline_help" data-toggle="popover" data-placement="top" data-content="Это локальная подсказка, призванная пояснять пользователям назначение элементов." title="" data-original-title="Локальная помощь"></i>
                </legend>

                <div class="row-fluid offset-top1">

                    <div class="span6">

            <div class="control-group control-group-medium">
                <label class="control-label">Новости</label>
                <div class="controls">
                    <a class="ot_inline_text_editable" href="#" data-type="text" data-pk="1" data-url="/post" data-original-title="Enter something">12</a>
                    <!--<input name="" type="text" placeholder="5" class="input-mini center">-->
                </div>
            </div>

            <div class="control-group control-group-medium">
                <label class="control-label">Товары с отзывами</label>
                <div class="controls">
                    <a class="ot_inline_text_editable" href="#" data-type="text" data-pk="1" data-url="/post" data-original-title="Enter something">12</a>
                    <!--<input name="" type="text" placeholder="5" class="input-mini center">-->
                </div>
            </div>

            <div class="control-group control-group-medium">
                <label class="control-label">Рекомендованные продавцы</label>
                <div class="controls">
                    <a class="ot_inline_text_editable" href="#" data-type="text" data-pk="1" data-url="/post" data-original-title="Enter something">12</a>
<!--                    <input name="" type="text" placeholder="5" class="input-mini">-->
                </div>
            </div>

        </div>

                    <div class="span6">

            <div class="control-group control-group-medium">
                <label class="control-label">Популярные бренды</label>
                <div class="controls">
                    <a class="ot_inline_text_editable" href="#" data-type="text" data-pk="1" data-url="/post" data-original-title="Enter something">12</a>
<!--                    <input name="" type="text" placeholder="5" class="input-mini">-->
                </div>
            </div>

            <div class="control-group control-group-medium">
                <label class="control-label">Рекомендуемые товары</label>
                <div class="controls">
                    <a class="ot_inline_text_editable" href="#" data-type="text" data-pk="1" data-url="/post" data-original-title="Enter something">12</a>
<!--                    <input name="" type="text" placeholder="5" class="input-mini">-->
                </div>
            </div>

            <div class="control-group control-group-medium">
                <label class="control-label">Последние просмотренные товары</label>
                <div class="controls">
                    <a class="ot_inline_text_editable" href="#" data-type="text" data-pk="1" data-url="/post" data-original-title="Enter something">12</a>
<!--                    <input name="" type="text" placeholder="5" class="input-mini">-->
                </div>
            </div>

        </div>

                </div>

            </fieldset>

        </form>

    </div>

</div>

<!-- item configuration -->
<div class="box corner-all">

    <div class="box-header corner-top">
        <div class="header-control">
            <a data-box="collapse"><i class="icon-caret-up"></i></a>
        </div>
        <i class="icon-gift font-14"></i> Cтраница о товаре
    </div>

    <div class="box-body">

        <form class="form-horizontal inline_editable_form ot_form">

            <fieldset class="clearfix">

                <legend class="legend-small">Вывод элементов</legend>

                <div class="row-fluid offset-top1">
                    <div class="span6">

                        <div class="control-group control-group-medium">
                            <label class="control-label">Отзывы с таобао</label>
                            <div class="controls">
                                <a class="ot_inline_select_editable" href="#" data-type="select" data-pk="2" data-url="/post" data-original-title="Enter something">Отображать</a>
                                <!--<select id="" name="" class="input-medium">
                                    <option>Отображать</option>
                                    <option>Скрывать</option>
                                </select>-->
                            </div>
                        </div>

                        <div class="control-group control-group-medium">
                            <label class="control-label">Статус товара</label>
                            <div class="controls">
                                <a class="ot_inline_select_editable" href="#" data-type="select" data-pk="2" data-url="/post" data-original-title="Enter something">Отображать</a>
                                <!--<select id="" name="" class="input-medium">
                                    <option>Отображать</option>
                                    <option>Скрывать</option>
                                </select>-->
                            </div>
                        </div>

                        <div class="control-group control-group-medium">
                            <label class="control-label">Вес товара</label>
                            <div class="controls">
                                <a class="ot_inline_select_editable" href="#" data-type="select" data-pk="2" data-url="/post" data-original-title="Enter something">Отображать</a>
                                <!--<select id="" name="" class="input-medium">
                                    <option>Отображать</option>
                                    <option>Скрывать</option>
                                </select>-->
                            </div>
                        </div>

                        <div class="control-group control-group-medium">
                            <label class="control-label">Ссылка на Taobao</label>
                            <div class="controls">
                                <a class="ot_inline_select_editable" href="#" data-type="select" data-pk="2" data-url="/post" data-original-title="Enter something">Отображать</a>
                                <!--<select id="" name="" class="input-medium">
                                    <option>Отображать</option>
                                    <option>Скрывать</option>
                                </select>-->
                            </div>
                        </div>

                        <div class="control-group control-group-medium">
                            <label class="control-label">Цена за 1 шт.</label>
                            <div class="controls">
                                <a class="ot_inline_select_editable" href="#" data-type="select" data-pk="2" data-url="/post" data-original-title="Enter something">Отображать</a>
                                <!--<select id="" name="" class="input-medium">
                                    <option>Отображать</option>
                                    <option>Скрывать</option>
                                </select>-->
                            </div>
                        </div>

                        <div class="control-group control-group-medium">
                            <label class="control-label">Местная доставка</label>
                            <div class="controls">
                                <a class="ot_inline_select_editable" href="#" data-type="select" data-pk="2" data-url="/post" data-original-title="Enter something">Отображать</a>
                                <!--<select id="" name="" class="input-medium">
                                    <option>Отображать</option>
                                    <option>Скрывать</option>
                                </select>-->
                            </div>
                        </div>

                        <div class="control-group control-group-medium">
                            <label class="control-label">История просмотра товаров</label>
                            <div class="controls">
                                <a class="ot_inline_select_editable" href="#" data-type="select" data-pk="2" data-url="/post" data-original-title="Enter something">Скрывать</a>
                                <!--<select id="ot_ot_user_history_pages" name="ot_ot_user_history_pages" class="input-medium">
                                    <option>Отображать</option>
                                    <option selected="selected">Скрывать</option>
                                </select>-->

                            </div>
                        </div>

                    </div>
                    <div class="span6">

                        <div class="control-group control-group-medium">
                            <label class="control-label">Особенности</label>
                            <div class="controls">
                                <a class="ot_inline_select_editable" href="#" data-type="select" data-pk="2" data-url="/post" data-original-title="Enter something">Отображать</a>
                                <!--<select id="" name="" class="input-medium">
                                    <option>Отображать</option>
                                    <option>Скрывать</option>
                                </select>-->
                            </div>
                        </div>

                        <div class="control-group control-group-medium">
                            <label class="control-label">Ценовой диапазон</label>
                            <div class="controls">
                                <a class="ot_inline_select_editable" href="#" data-type="select" data-pk="2" data-url="/post" data-original-title="Enter something">Отображать</a>
                                <!--<select id="" name="" class="input-medium">
                                    <option>Отображать</option>
                                    <option>Скрывать</option>
                                </select>-->
                            </div>
                        </div>

                        <div class="control-group control-group-medium">
                            <label class="control-label">Отзыв от пользователей сайта</label>
                            <div class="controls">
                                <a class="ot_inline_select_editable" href="#" data-type="select" data-pk="2" data-url="/post" data-original-title="Enter something">Отображать</a>
                                <!--<select id="" name="" class="input-medium">
                                    <option>Отображать</option>
                                    <option>Скрывать</option>
                                </select>-->
                            </div>
                        </div>

                        <div class="control-group control-group-medium">
                            <label class="control-label">В наличии</label>
                            <div class="controls">
                                <a class="ot_inline_select_editable" href="#" data-type="select" data-pk="2" data-url="/post" data-original-title="Enter something">Отображать</a>
                                <!--<select id="" name="" class="input-medium">
                                    <option>Отображать</option>
                                    <option>Скрывать</option>
                                </select>-->
                            </div>
                        </div>

                        <div class="control-group control-group-medium">
                            <label class="control-label">Объем продаж за 30 дней</label>
                            <div class="controls">
                                <a class="ot_inline_select_editable" href="#" data-type="select" data-pk="2" data-url="/post" data-original-title="Enter something">Отображать</a>
                                <!--<select id="" name="" class="input-medium">
                                    <option>Отображать</option>
                                    <option>Скрывать</option>
                                </select>-->
                            </div>
                        </div>

                        <div class="control-group control-group-medium">
                            <label class="control-label">Вкладка по умолчанию</label>
                            <div class="controls">
                                <a class="ot_inline_select_editable" href="#" data-type="select" data-pk="2" data-url="/post" data-original-title="Enter something">Характеристика товара</a>
                                <!--<select id="" name="" class="input-medium">
                                    <option>Характеристика товара</option>
                                    <option>Фото и описание</option>
                                    <option>Отзывы</option>
                                    <option>Отзывы с Таобао</option>
                                </select>-->
                            </div>
                        </div>

                    </div>
                </div>

            </fieldset>

        </form>

    </div>
</div>

<!-- catalogue configuration -->
<div class="box corner-all">
    <div class="box-header corner-top">
        <div class="header-control">
            <a data-box="collapse"><i class="icon-caret-up"></i></a>
        </div>
        <i class="icon-list-alt font-14"></i> Каталог
    </div>

    <div class="box-body">

        <form class="form-horizontal inline_editable_form ot_form">
            <div class="row-fluid">
                <div class="span6">
                    <fieldset class="clearfix">
                        <legend class="legend-small">Навигация</legend>

                        <div class="control-group control-group-medium">
                            <label class="control-label">Вид навигации <i class="icon-question-sign ot_inline_help" data-toggle="popover" data-placement="top" data-content="Задает поведение меню категорий каталога"></i></label>
                            <div class="controls">
                                <a class="ot_cat_nav_style_editable" href="#" data-type="select" data-pk="3" data-url="/post" data-original-title="Enter something">Статическая (список категорий)</a>
                                <!--<select class="input-medium">
                                    <option>Статическая (список категорий)</option>
                                    <option>Выпадающее меню (два уровня вложенности)</option>
                                    <option>Выпадающее меню (три уровня вложенности)</option>
                                </select>-->
                            </div>
                        </div>

                        <div class="control-group control-group-medium">
                            <label class="control-label">Количество категорий <i class="icon-question-sign ot_inline_help" data-toggle="popover" data-placement="top" data-content="Задает количество корневых категорий и (если выбрано выпадающее меню) подкатегорий. Пустое значение поля означает вывод всех категорий. " ></i></label>
                            <div class="controls">
                                <a class="ot_cat_nav_elements_editable" href="#" data-type="text" data-pk="1" data-url="/post" data-original-title="Enter something"></a>
                            </div>
                        </div>

                    </fieldset>
                </div><!-- /.span6-->

                <div class="span6">
                    <fieldset class="clearfix">

                        <legend class="legend-small">Список товаров</legend>

                        <div class="control-group control-group-medium">
                            <label class="control-label">Режим работы категорий <i class="icon-question-sign ot_inline_help" data-toggle="popover" data-placement="top" data-content="Это локальная подсказка, призванная пояснять пользователям назначение элементов." title=""></i></label>
                            <div class="controls">
                                <a class="ot_inline_select_editable text-clipped" href="#" data-type="select" data-pk="1" data-url="/post">Внешние категории отображаются в исходном виде</a>
                                <!--<select name="" id="">
                                    <option value="">Внешние категории отображаются в исходном виде</option>
                                    <option value="">Отображаются только внутренние категории</option>
                                    <option value="">Категории не отображаются</option>
                                </select>-->
                            </div>
                        </div>

                        <div class="control-group control-group-medium">
                            <label class="control-label">Количество отображаемых товаров по умолчанию <i class="icon-question-sign ot_inline_help" data-toggle="popover" data-placement="top" data-content="Это локальная подсказка, призванная пояснять пользователям назначение элементов." title="" data-original-title="Локальная помощь"></i></label>
                            <div class="controls">
                                <a class="ot_inline_select_editable" href="#" data-type="select" data-pk="1" data-url="/post" data-original-title="Enter something">16</a>
                                <!--<select name="" id="">
                                    <option value="">16</option>
                                    <option value="">32</option>
                                    <option value="">64</option>
                                </select>-->
                            </div>
                        </div>

                        <div class="control-group control-group-medium">
                            <label class="control-label">Интервал отображаемых страниц в постраничном разбиении <i class="icon-question-sign ot_inline_help" data-toggle="popover" data-placement="top" data-content="Это локальная подсказка, призванная пояснять пользователям назначение элементов." title="" data-original-title="Локальная помощь"></i></label>
                            <div class="controls">
                                <a class="ot_inline_select_editable" href="#" data-type="select" data-pk="1" data-url="/post" data-original-title="Enter something">3</a>
                                <!--<select name="" id="">
                                    <option value="">1</option>
                                    <option value="">2</option>
                                    <option value="">3</option>
                                    <option value="">4</option>
                                    <option value="">5</option>
                                </select>-->
                            </div>
                        </div>

                    </fieldset>
                </div><!-- /.span6-->

            </div><!-- /.row-fluid -->
        </form>

    </div>
</div>


<!-- content configuration -->
<div class="box corner-all">
    <div class="box-header corner-top">
        <div class="header-control">
            <a data-box="collapse"><i class="icon-caret-up"></i></a>
        </div>
        <i class="icon-file font-14"></i> Содержание
    </div>

    <div class="box-body">

        <form class="form-horizontal inline_editable_form ot_form">
            <fieldset class="clearfix">

                <div class="control-group control-group-medium">
                    <label class="control-label">Количество статей на страницу в блоге <i class="icon-question-sign ot_inline_help" data-toggle="popover" data-placement="top" data-content="Это локальная подсказка, призванная пояснять пользователям назначение элементов." title=""></i></label>
                    <div class="controls">
                        <a class="ot_inline_text_editable" href="#" data-type="text" data-pk="1" data-url="/post" data-original-title="Enter something">10</a>
                    </div>
                </div>

            </fieldset>
        </form>

    </div>
</div>


<!-- search configuration -->
<div class="box corner-all">
    <div class="box-header corner-top">
        <div class="header-control">
            <a data-box="collapse"><i class="icon-caret-up"></i></a>
        </div>
        <i class="icon-search font-14"></i> Поиск
    </div>

    <div class="box-body">

                <form action="" method="post" class="form-horizontal ot_form">

                    <div class="row-fluid">

                        <div class="span4">

                            <p><strong>Используемые типы поиска</strong> <i class="icon-question-sign ot_inline_help" data-toggle="popover" data-placement="top" data-content="Здесь можно выбрать типы поиска, по которым будет осуществляться поиск товаров (в категориях включительно). Выбор типа поиска осуществляется из выпадающего списка справа, а редактирование порядка и использования — слева."></i></p>

                            <ol class="unstyled ot_sortable_list ot_sortable ot_editable_name">

                                <li>
                                    <span class="badge">
                                        <i class="icon-move" title="Перетащить"></i>
                                        <span class="ot_sortable_list_editable">Рекомендации Таобао</span>
                                        <i class="icon-pencil" title="Переименовать"></i>
                                        <i class="icon-remove" title="Удалить"></i>
                                    </span>
                                </li>
                                <li>
                                    <span class="badge">
                                        <i class="icon-move" title="Перетащить"></i>
                                        <span class="ot_sortable_list_editable">Пристрой / Склад</span>
                                        <i class="icon-pencil" title="Переименовать"></i>
                                        <i class="icon-remove" title="Удалить"></i>
                                    </span>
                                </li>
                                <li>
                                    <span class="badge">
                                        <i class="icon-move" title="Перетащить"></i>
                                        <span class="ot_sortable_list_editable">Фирменные товары (Tmall)</span>
                                        <i class="icon-pencil" title="Переименовать"></i>
                                        <i class="icon-remove" title="Удалить"></i>
                                    </span>
                                </li>
                            </ol>

                        </div>

                        <div class="span8">

                            <p class="offset-bottom05"><strong>Добавить поиск</strong></p>
                            <div class="row-fluid">

                                <select class="input-large select_searched_list span4">
                                    <option value="all-china">Все товары из Китая</option>
                                </select>

                                <p class="span2">
                                    <button class="btn btn-small btn-primary" title="Добавить дополнительную валюту"><i class="icon-plus"></i></button>
                                </p>

                            </div>
                        </div>

                    </div>

                    <button class="btn btn_preloader btn-primary" data-loading-text="Сохраняется" autocomplete="off">Сохранить</button>

            </form>

    </div>
</div>


<div id="modal-gallery" class="modal modal-gallery hide fade" tabindex="-1">

    <div class="modal-header">
        <button data-dismiss="modal" class="close" type="button">×</button>
        <h3 class="modal-title"></h3>
    </div>

    <div class="modal-body"><div class="modal-image"></div></div>

    <div class="modal-footer">

        <div class="row-fluid">

            <div class="span3 text-left">
                <div class="btn-group">
                    <button class="btn modal-prev" title="Предыдущее"><i class="icon-arrow-left icon-white"></i></button>
                    <button class="btn modal-next" title="Следующее"><i class="icon-arrow-right icon-white"></i></button>
                </div>
            </div>

            <div class="span6 text-center">

                <button class="btn btn_preloader btn-primary" data-loading-text="Установить" autocomplete="off">Установить</button>

                <!-- show instead button when this is already selected theme -->
                <!-- <span class="label label-success weight-normal">Текущая тема</span>-->
            </div>

            <div class="span3 text-right">
                <button href="#" class="btn" data-dismiss="modal">Закрыть</button>
            </div>

        </div>

    </div>

</div>