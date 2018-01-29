
<!-- ot-sub-nav -->
<div class="ot_sub_nav">

    <ul class="nav nav-tabs">
        <li class="active"><a href="config/build">Конструкция сайта</a></li>
        <li><a href="config/orders">Заказы</a></li>
        <li><a href="config/cat">Каталог</a></li>
        <li><a href="config/lang">Языки</a></li>
        <li><a href="config/system">Система</a></li>
    </ul>

</div>


<!--<h1>Конструкция сайта</h1>-->

<!-- ot-sub-sub-nav -->
<!--<div class="tabbable ot_sub_sub_nav">

    <ul class="nav nav-pills">
        <li><a href="/config/main-page"><i class="icon-home"></i> <span>Главная страница</span></a></li>
        <li class="active"><a href="/config/product"><i class="icon-gift"></i> <span>Страница товара</span></a></li>
        <li><a href="/config/content"><i class="icon-file"></i> <span>Содержание</span></a></li>
        <li><a href="/config/header"><i class="icon-eject"></i> <span>Шапка сайта</span></a></li>
    </ul>

</div>-->

<h1><span class="muted">Конструкция</span> сайта</h1>
<!---->
<!-- item page configuration -->
<div class="box corner-all">
    <div class="box-header corner-top">
        <div class="header-control">
            <a data-box="collapse"><i class="icon-caret-up"></i></a>
        </div>
        <span>Глобальный шаблон сайта</span>
    </div>

    <div class="box-body">

        <form class="form-horizontal ot_form editableform">

            <fieldset>
                <legend>Шапка сайта</legend>

                <div class="control-group control-group-large">
                    <label class="control-label">Логотип</label>
                    <div class="controls">
                        <input id="ot_header_logo" name="ot_header_logo" class="input-file" type="file">
                        <i class="icon-question-sign ot_inline_help" data-toggle="popover" data-placement="top" data-content="Это локальная подсказка, призванная пояснять пользователям назначение элементов." title="" data-original-title="Локальная помощь"></i>
                    </div>
                </div>

                <div class="control-group control-group-large">
                    <label class="control-label">Телефон</label>
                    <div class="controls">
                        <input id="ot_tell_header" name="ot_tell_header" placeholder="222-222-222" class="input-medium" type="text">
                        <i class="icon-question-sign ot_inline_help" data-toggle="popover" data-placement="top" data-content="Это локальная подсказка, призванная пояснять пользователям назначение элементов." title="" data-original-title="Локальная помощь"></i>
                    </div>
                </div>

                <div class="control-group control-group-large">
                    <label class="control-label" for="ot_online_help_block">Он-лайн поддержка</label>
                    <div class="controls">
                        <select id="ot_online_help_block" name="ot_online_help_block" class="input-medium">
                            <option>Отображать</option>
                            <option>Скрывать</option>
                        </select>
                        <i class="icon-question-sign ot_inline_help" data-toggle="popover" data-placement="right" data-content="Это локальная подсказка, призванная пояснять пользователям назначение элементов." title="" data-original-title="Локальная помощь"></i>
                    </div>
                </div>

                <div class="control-group control-group-large">
                    <p class="control-label"><i class="icon-question-sign ot_inline_help" data-toggle="popover" data-placement="top" data-content="Это локальная подсказка, призванная пояснять пользователям назначение элементов." title="" data-original-title="Локальная помощь"></i>
                    <label class="help-inline" for="ot_work_schedule_block">График работы</label>
                    </p>
                    <div class="controls">
                        <select id="ot_work_schedule_block" name="ot_work_schedule_block" class="input-medium">
                            <option>Отображать</option>
                            <option>Скрывать</option>
                        </select>

                    </div>
                </div>

                <div class="control-group control-group-large">
                    <p class="control-label"><i class="icon-question-sign ot_inline_help" data-toggle="popover" data-placement="top" data-content="Это локальная подсказка, призванная пояснять пользователям назначение элементов." title="" data-original-title="Локальная помощь"></i>
                    <label class="help-inline" for="ot_add_chat_code">Онлайн-чат</label>
                    </p>
                    <div class="controls">
                        <textarea id="ot_add_chat_code" name="ot_add_chat_code" class="input-xlarge" placeholder=""></textarea>
                    </div>
                </div

            </fieldset>

            <fieldset>
                <legend>Настройка текстовых страниц</legend>

                <div class="control-group control-group-large">
                    <label class="control-label" for="ot_sidebar_nav_display">Навигация в колонке</label>
                    <div class="controls">
                        <select id="ot_sidebar_nav_display" name="ot_sidebar_nav_display" class="input-large">
                            <option>Меню второго уровня</option>
                            <option>Все страницы сайта</option>
                            <option>Скрыть</option>
                        </select>
                        <i class="icon-question-sign ot_inline_help" data-toggle="popover" data-placement="right" data-content="Это локальная подсказка, призванная пояснять пользователям назначение элементов." title="" data-original-title="Локальная помощь"></i>
                    </div>
                </div>

                <div class="control-group control-group-large">
                    <label class="control-label" for="ot_text_direction">Направление текста</label>
                    <div class="controls">
                        <select id="ot_text_direction" name="ot_text_direction" class="input-medium">
                            <option>→ Слева направо</option>
                            <option style="direction: rtl; text-align: right; unicode-bidi: bidi-override;">← Справа налево</option>
                        </select>
                        <i class="icon-question-sign ot_inline_help" data-toggle="popover" data-placement="top" data-content="Это локальная подсказка, призванная пояснять пользователям назначение элементов." title="" data-original-title="Локальная помощь"></i>
                    </div>
                </div>

                <div class="control-group control-group-large">
                    <label class="control-label" for="ot_add_meta_text">Область мета-информации</label>
                    <div class="controls">
                        <textarea id="ot_add_meta_text" name="ot_add_meta_text" class="input-xlarge" placeholder="Например: подтверждение прав для поисковых систем."></textarea>
                    </div>
                </div>



            </fieldset>
        </form>

    </div>
</div>

<!-- main page configuration -->
<div _style="display: none" class="box corner-all">
    <div class="box-header corner-top">
        <div class="header-control">
            <a data-box="collapse"><i class="icon-caret-up"></i></a>
        </div>
        <span>Главная страница</span>
    </div>

    <div class="box-body">

        <form class="form-horizontal ot_form">

        <fieldset>
            <legend>Отображение</legend>

            <div class="control-group control-group-large">
                <label class="control-label" for="ot_mainpage_items_view">Выводить товары <i class="icon-question-sign ot_inline_help" data-toggle="popover" data-placement="top" data-content="Это локальная подсказка, призванная пояснять пользователям назначение элементов." title="" data-original-title="Локальная помощь"></i></label>
                <div class="controls">
                    <select id="ot_mainpage_items_view" name="selectbasic" class="input-medium">
                        <option>Списком</option>
                        <option>Каруселью</option>
                    </select>
                </div>
            </div>
    </fieldset>


    <fieldset>
        <legend>
            Количество выводимых элементов в блоках
            <i class="icon-question-sign ot_inline_help" data-toggle="popover" data-placement="top" data-content="Это локальная подсказка, призванная пояснять пользователям назначение элементов." title="" data-original-title="Локальная помощь"></i>
        </legend>

    <div class="row-fluid">
        <div class="span6">

            <div class="control-group control-group-large">
                <label class="control-label" for="ot_mainpage_news_amount">Новости</label>
                <div class="controls">
                    <input  id="ot_mainpage_news_amount" name="ot_mainpage_news_amount" type="text" placeholder="5" class="input-mini center">
                </div>
            </div>

            <div class="control-group control-group-large">
                <label class="control-label" for="ot_mainpage_reviews_amount">Товары с отзывами</label>
                <div class="controls">
                    <input  id="ot_mainpage_reviews_amount" name="ot_mainpage_reviews_amount" type="text" placeholder="5" class="input-mini center">
                </div>
            </div>

            <div class="control-group control-group-large">
                <label class="control-label" for="ot_mainpage_sellers_amount">Рекомендованные продавцы</label>
                <div class="controls">
                    <input id="ot_mainpage_sellers_amount" name="ot_mainpage_sellers_amount" type="text" placeholder="5" class="input-mini">
                </div>
            </div>

        </div>

        <div class="span6">

            <div class="control-group control-group-large">
                <label class="control-label" for="ot_mainpage_brands_amount">Популярные бренды</label>
                <div class="controls">
                    <input id="ot_mainpage_brands_amount" name="ot_mainpage_brands_amount" type="text" placeholder="5" class="input-mini">
                </div>
            </div>

            <div class="control-group control-group-large">
                <label class="control-label" for="ot_mainpage_recommended_items_amount">Рекомендуемые товары</label>
                <div class="controls">
                    <input id="ot_mainpage_recommended_items_amount" name="ot_mainpage_recommended_items_amount" type="text" placeholder="5" class="input-mini">
                </div>
            </div>

            <div class="control-group control-group-large">
                <label class="control-label" for="ot_mainpage_last_viewed_items_amount">Последние просмотренные товары</label>
                <div class="controls">
                    <input id="ot_mainpage_last_viewed_items_amount" name="ot_mainpage_last_viewed_items_amount" type="text" placeholder="5" class="input-mini">
                </div>
            </div>

        </div>

    </div>
    </fieldset>

</form>

    </div>
</div>

<!-- item page configuration -->
<div _style="display: none" class="box corner-all">
    <div class="box-header corner-top">
        <div class="header-control">
            <a data-box="collapse"><i class="icon-caret-up"></i></a>
        </div>
        <span>Информация на странице о товаре</span>
    </div>

    <div class="box-body">

        <form class="form-horizontal ot_form">

            <fieldset>
                <legend>Вывод элементов</legend>
                <div class="row-fluid">
                    <div class="span6">

                        <div class="control-group control-group-large">
                            <label class="control-label" for="ot_">Отзывы с таобао</label>
                            <div class="controls">
                                <select id="ot_" name="ot_" class="input-medium">
                                    <option>Отображать</option>
                                    <option>Скрывать</option>
                                </select>
                            </div>
                        </div>

                        <div class="control-group control-group-large">
                            <label class="control-label" for="ot_">Статус товара</label>
                            <div class="controls">
                                <select id="ot_" name="ot_" class="input-medium">
                                    <option>Отображать</option>
                                    <option>Скрывать</option>
                                </select>
                            </div>
                        </div>

                        <div class="control-group control-group-large">
                            <label class="control-label" for="ot_">Вес товара</label>
                            <div class="controls">
                                <select id="ot_" name="ot_" class="input-medium">
                                    <option>Отображать</option>
                                    <option>Скрывать</option>
                                </select>
                            </div>
                        </div>

                        <div class="control-group control-group-large">
                            <label class="control-label" for="ot_">Ссылка на Taobao</label>
                            <div class="controls">
                                <select id="ot_" name="ot_" class="input-medium">
                                    <option>Отображать</option>
                                    <option>Скрывать</option>
                                </select>
                            </div>
                        </div>

                        <div class="control-group control-group-large">
                            <label class="control-label" for="ot_">Цена за 1 шт.</label>
                            <div class="controls">
                                <select id="ot_" name="ot_" class="input-medium">
                                    <option>Отображать</option>
                                    <option>Скрывать</option>
                                </select>
                            </div>
                        </div>

                        <div class="control-group control-group-large">
                            <label class="control-label" for="ot_">Местная доставка</label>
                            <div class="controls">
                                <select id="ot_" name="ot_" class="input-medium">
                                    <option>Отображать</option>
                                    <option>Скрывать</option>
                                </select>
                            </div>
                        </div>

                        <div class="control-group control-group-large">
                            <label class="control-label" for="ot_user_history_pages">История просмотра товаров</label>
                            <div class="controls">
                                <select id="ot_ot_user_history_pages" name="ot_ot_user_history_pages" class="input-medium">
                                    <option>Отображать</option>
                                    <option selected="selected">Скрывать</option>
                                </select>
                            </div>
                        </div>

                    </div>
                    <div class="span6">

                        <div class="control-group control-group-large">
                            <label class="control-label" for="ot_">Особенности</label>
                            <div class="controls">
                                <select id="ot_" name="ot_" class="input-medium">
                                    <option>Отображать</option>
                                    <option>Скрывать</option>
                                </select>
                            </div>
                        </div>

                        <div class="control-group control-group-large">
                            <label class="control-label" for="ot_">Ценовой диапазон</label>
                            <div class="controls">
                                <select id="ot_" name="ot_" class="input-medium">
                                    <option>Отображать</option>
                                    <option>Скрывать</option>
                                </select>
                            </div>
                        </div>

                        <div class="control-group control-group-large">
                            <label class="control-label" for="ot_">Вес товара</label>
                            <div class="controls">
                                <select id="ot_" name="ot_" class="input-medium">
                                    <option>Отображать</option>
                                    <option>Скрывать</option>Имя продавца
                                </select>
                            </div>
                        </div>

                        <div class="control-group control-group-large">
                            <label class="control-label" for="ot_">Отзыв от пользователей сайта</label>
                            <div class="controls">
                                <select id="ot_" name="ot_" class="input-medium">
                                    <option>Отображать</option>
                                    <option>Скрывать</option>
                                </select>
                            </div>
                        </div>

                        <div class="control-group control-group-large">
                            <label class="control-label" for="ot_">В наличии</label>
                            <div class="controls">
                                <select id="ot_" name="ot_" class="input-medium">
                                    <option>Отображать</option>
                                    <option>Скрывать</option>
                                </select>
                            </div>
                        </div>

                        <div class="control-group control-group-large">
                            <label class="control-label" for="ot_">Объем продаж за 30 дней</label>
                            <div class="controls">
                                <select id="ot_" name="ot_" class="input-medium">
                                    <option>Отображать</option>
                                    <option>Скрывать</option>
                                </select>
                            </div>
                        </div>

                        <div class="control-group control-group-large">
                            <label class="control-label" for="ot_">Вкладка по умолчанию</label>
                            <div class="controls">
                                <select id="ot_" name="ot_" class="input-medium">
                                    <option>Характеристика товара</option>
                                    <option>Фото и описание</option>
                                    <option>Отзывы</option>
                                    <option>Отзывы с Таобао</option>
                                </select>
                            </div>
                        </div>

                    </div>
                </div>

            </fieldset>
        </form>


    </div>
</div>


<!-- item page configuration -->
<div style="display: none" class="box corner-all">
    <div class="box-header corner-top">
        <div class="header-control">
            <a data-box="collapse"><i class="icon-caret-up"></i></a>
        </div>
        <span>Информация на странице о товаре</span>
    </div>

    <div class="box-body">

        <form class="form-horizontal ot_form">

            <fieldset>
                <legend>Отображение элементов</legend>
                <div class="row-fluid">
                    <div class="span6">
                        <label class="checkbox">
                            <input value="" type="checkbox">
                            Отзыв с Taobao
                        </label>
                        <label class="checkbox">
                            <input value="" type="checkbox">
                            Статус
                        </label>
                        <label class="checkbox">
                            <input value="" type="checkbox">
                            Вес товара
                        </label>
                        <label class="checkbox">
                            <input value="" type="checkbox">
                            Ссылка на Taobao
                        </label>
                        <label class="checkbox">
                            <input value="" type="checkbox">
                            Цена за 1 шт.
                        </label>
                        <label class="checkbox">
                            <input value="" type="checkbox">
                            Местная доставка
                        </label>
                    </div>

                    <div class="span6">

                        <label class="checkbox">
                            <input value="" type="checkbox">
                            Особенности
                        </label>
                        <label class="checkbox">
                            <input value="" type="checkbox">
                            Ценовой диапазон
                        </label>
                        <label class="checkbox">
                            <input value="" type="checkbox">
                            Имя продавца
                        </label>
                        <label class="checkbox">
                            <input value="" type="checkbox">
                            Отзыв от пользователей сайта
                        </label>
                        <label class="checkbox">
                            <input value="" type="checkbox">
                            В наличии
                        </label>
                        <label class="checkbox">
                            <input value="" type="checkbox">
                            Объем продаж за 30 дней
                        </label>
                    </div>
                </div>

            </fieldset>

        </form>

    </div>
</div>

<form class="form-horizontal">
    <fieldset>

        <!-- submin button -->
        <div class="control-group">
            <label class="control-label"></label>
            <div class="controls">
                <button id="singlebutton" name="singlebutton" class="btn btn-primary">Сохранить</button>
            </div>
        </div>

    </fieldset>
</form>