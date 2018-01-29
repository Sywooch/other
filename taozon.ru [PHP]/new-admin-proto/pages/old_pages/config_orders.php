<? include('inc/sub_nav_config.php'); ?>


<div class="row-fluid">
    <div class="span12">

        <div class="span10">
            <h1><a href="config/build" class="muted">Конфигурация</a> / <a href="config/orders" class="muted">заказы</a> / общие</h1>
        </div>

        <div class="span2">
            <!-- site language -->
            <div class="btn-group pull-right">
                <a class="btn dropdown-toggle" data-toggle="dropdown" href="#" title="Выбор языковой версии сайта для редактирования">
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
</div>

<!-- ot-sub-sub-nav -->
<div class="tabbable ot_sub_sub_nav">

    <ul class="nav nav-pills">
        <li class="active"><a href="config/product"><i class="icon-sitemap"></i> <span>Общие</span></a></li>
        <li><a href="config/orders/shipment"><i class="icon-truck"></i> <span>Доставка</span></a></li>
        <li><a href="config/orders/bank"><i class="icon-file-alt"></i> <span>Квитанция в банк</span></a></li>
    </ul>

</div>


<!-- configuration -->
<div class="box corner-top">

    <div class="box-body">

        <form class="form-horizontal inline_editable_form ot_form">

            <fieldset>

                <div class="control-group control-group-medium">
                    <label class="control-label">Оплата наличными <i class="icon-question-sign ot_inline_help" data-toggle="popover" data-placement="top" data-content="Это локальная подсказка, призванная пояснять пользователям назначение элементов." title="" data-original-title="Локальная помощь"></i></label>
                    <div class="controls">
                        <a class="ot_inline_select_editable" href="#" data-type="select" data-pk="1" data-url="/post" data-original-title="Enter something">Включить</a>
                        <!--<select name="" id="">
                            <option value="">Включить</option>
                            <option value="">Выключить</option>
                        </select>-->
                    </div>
                </div>

                <div class="control-group control-group-medium">
                    <label class="control-label">Эл. ящик для уведомлений <i class="icon-question-sign ot_inline_help" data-toggle="popover" data-placement="bottom" data-content="Это локальная подсказка, призванная пояснять пользователям назначение элементов." title="" data-original-title="Локальная помощь"></i></label>
                    <div class="controls">
                        <a class="ot_inline_text_editable" href="#" data-type="text" data-pk="2" data-url="/post" data-original-title="Enter something" data-placeholder="example@domain.tld"></a>
                    </div>
                </div>

                <div class="control-group control-group-medium">
                    <label class="control-label">Эл. ящик отправителя <i class="icon-question-sign ot_inline_help" data-toggle="popover" data-placement="bottom" data-content="Это локальная подсказка, призванная пояснять пользователям назначение элементов." title="" data-original-title="Локальная помощь"></i></label>
                    <div class="controls">
                        <a class="ot_inline_text_editable" href="#" data-type="text" data-pk="2" data-url="/post" data-original-title="Enter something" data-placeholder="example@domain.tld"></a>
                    </div>
                </div>

                <div class="control-group control-group-medium">
                    <label class="control-label">Префикс пользователя <i class="icon-question-sign ot_inline_help" data-toggle="popover" data-placement="bottom" data-content="Это локальная подсказка, призванная пояснять пользователям назначение элементов." title="" data-original-title="Локальная помощь"></i></label>
                    <div class="controls">
                        <a class="ot_inline_text_editable" href="#" data-type="text" data-pk="2" data-url="/post" data-original-title="Enter something" data-placeholder="Например, Ivanov"></a>
                    </div>
                </div>

                <div class="control-group control-group-medium">
                    <label class="control-label">Префикс заказа <i class="icon-question-sign ot_inline_help" data-toggle="popover" data-placement="bottom" data-content="Это локальная подсказка, призванная пояснять пользователям назначение элементов." title="" data-original-title="Локальная помощь"></i></label>
                    <div class="controls">
                        <a class="ot_inline_text_editable" href="#" data-type="text" data-pk="2" data-url="/post" data-original-title="Enter something" data-placeholder="Например, ABC"></a>
                    </div>
                </div>

                <div class="control-group control-group-medium">
                    <label class="control-label">Оригинальная упаковка <i class="icon-question-sign ot_inline_help" data-toggle="popover" data-placement="bottom" data-content="Это локальная подсказка, призванная пояснять пользователям назначение элементов." title="" data-original-title=""></i></label>
                    <div class="controls">
                        <a class="ot_inline_select_editable" href="#" data-type="select" data-pk="3" data-url="/post" data-original-title="Enter something">Не оставлять</a>
                        <!--<select name="" id="">
                            <option value="">Не оставлять</option>
                            <option value="">Оставить</option>
                        </select>-->
                    </div>
                </div>

                <div class="control-group control-group-medium">
                    <label class="control-label">Страхование заказа <span class="muted">(%)</span> <i class="icon-question-sign ot_inline_help" data-toggle="popover" data-placement="bottom" data-content="Процент на общую сумму заказа, прибавляется к стоимости доставки заказа" title="" data-original-title=""></i></label>
                    <div class="controls">
                        <a class="ot_inline_text_editable" href="#" data-type="text" data-pk="3" data-url="/post" data-original-title="Enter something" data-placeholder="Введите процент числом"></a>
                    </div>
                </div>

                <div class="control-group control-group-medium">
                    <label class="control-label">Минимальная сумма заказа <i class="icon-question-sign ot_inline_help" data-toggle="popover" data-placement="bottom" data-content="Устанавливается во внутренней валюте вашего сайта" title="" data-original-title=""></i></label>
                    <div class="controls">
                        <a class="ot_inline_text_editable" href="#" data-type="text" data-pk="3" data-url="/post" data-original-title="Enter something" data-placeholder="Например, 10 000"></a>
                    </div>
                </div>

                <div class="control-group control-group-medium">
                    <label class="control-label">Максимальное количество товаров в избранном <i class="icon-question-sign ot_inline_help" data-toggle="popover" data-placement="bottom" data-content="Это локальная подсказка, призванная пояснять пользователям назначение элементов." title="" data-original-title=""></i></label>
                    <div class="controls">
                        <a class="ot_inline_text_editable" href="#" data-type="text" data-pk="3" data-url="/post" data-original-title="Enter something" data-placeholder="10 000">1000</a>
                    </div>
                </div>

                <div class="control-group control-group-medium">
                    <label class="control-label">Максимальное количество товаров в корзине <i class="icon-question-sign ot_inline_help" data-toggle="popover" data-placement="bottom" data-content="Это локальная подсказка, призванная пояснять пользователям назначение элементов." title="" data-original-title=""></i></label>
                    <div class="controls">
                        <a class="ot_inline_text_editable" href="#" data-type="text" data-pk="3" data-url="/post" data-original-title="Enter something" data-placeholder="10 000">1000</a>
                    </div>
                </div>


            </fieldset>
        </form>

    </div>
</div>


