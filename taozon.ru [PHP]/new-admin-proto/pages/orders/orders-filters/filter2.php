


<div class="well well-small ot_orders_tabbed_filters">
    <div class="row-fluid">

        Вывести
        <select>
            <option value="за произвольный период">за произвольный период</option>
            <option value="за текущие сутки">за сегодня</option>
            <option value="за прошедшие сутки">за вчера</option>
            <option value="за текущую неделю">за текущую неделю</option>
            <option value="за прошлую неделю">за прошлую неделю</option>
            <option value="за последний месяц">за последний месяц</option>
            <option value="за последние 3 месяца">за последние 3 месяца</option>
            <option value="с начала года">с начала года</option>
        </select>

        с
        <div class="input-append">
            <input id="date-start-display" class="textinput" type="text" data-date-format="dd.mm.yyyy" data-date="05.02.2013" value="04.01.2013">
            <span class="btn add-on" id="date-start" ><i class="icon-calendar"></i></span>
        </div>

        по
        <div class="input-append">
            <input  id="date-end-display" class="textinput" type="text" data-date-format="dd.mm.yyyy" data-date="12.02.2013" value="04.01.2013">
            <span class="btn add-on" id="date-end" ><i class="icon-calendar"></i></span>
        </div>

    </div>

    <div class="tabbable tabs-left">

        <ul class="nav nav-tabs">
            <li class="active"><a href="#ot_filter_customer_params" data-toggle="tab">Покупатель</a></li>
            <li><a href="#ot_filter_orders_params" data-toggle="tab">Заказы</a></li>
            <li><a href="#ot_filter_products_params" data-toggle="tab">Товары</a></li>
        </ul>


        <div class="tab-content">

            <!-- user params -->
            <div class="tab-pane active" id="ot_filter_customer_params">
                <form class="ot_form">
                    <fieldset>

                        <div class="row-fluid">
                            <div class="span4">

                                <!-- family name-->
                                <div class="control-group">
                                    <label class="control-label" for="">Фамилия</label>
                                    <div class="controls">
                                        <input name="textinput" class="input-medium" type="text">
                                    </div>
                                </div>

                            </div>
                            <div class="span4">

                                <!-- telephone -->
                                <div class="control-group">
                                    <label class="control-label" for="">Телефон</label>
                                    <div class="controls">
                                        <input name="textinput" class="input-medium" type="text">
                                    </div>
                                </div>

                                <!-- e-mail -->
                                <div class="control-group">
                                    <label class="control-label" for="">Эл. почта</label>
                                    <div class="controls">
                                        <input name="textinput" class="input-medium" type="text">
                                    </div>
                                </div>

                            </div>
                        </div>

                    </fieldset>
                </form>
            </div>

            <!-- orders params -->
            <div class="tab-pane" id="ot_filter_orders_params">
                <form class="ot_form">
                    <fieldset>

                        <div class="row-fluid">
                            <div class="span4">

                                <!-- order ID -->
                                <div class="control-group">
                                    <div class="controls">
                                        <div class="input-prepend">
                                            <span class="add-on">ORD-</span>
                                            <input name="textinput" placeholder="Номер заказа" class="input-medium" type="text">
                                        </div>
                                    </div>
                                </div>

                                <label class="checkbox">
                                    <input type="checkbox" value="">
                                    Ожидает оплаты
                                </label>

                                <label class="checkbox">
                                    <input type="checkbox" value="">
                                    Ожидает доплаты
                                </label>

                                <label class="checkbox">
                                    <input type="checkbox" value="">
                                    Оплачен
                                </label>

                                <label class="checkbox">
                                    <input type="checkbox" value="">
                                    Дозаказан
                                </label>


                            </div>

                            <div class="span4">


                                <label class="checkbox">
                                    <input type="checkbox" value="">
                                    В обработке
                                </label>

                                <label class="checkbox">
                                    <input type="checkbox" value="">
                                    В обработке на складе
                                </label>

                                <label class="checkbox">
                                    <input type="checkbox" value="">
                                    Готов к упаковке
                                </label>

                                <label class="checkbox">
                                    <input type="checkbox" value="">
                                    Готов к отправке
                                </label>

                                <label class="checkbox">
                                    <input type="checkbox" value="">
                                    Отправлено
                                </label>

                            </div>

                            <div class="span4">

                                <label class="checkbox">
                                    <input type="checkbox" value="">
                                    Завершен
                                </label>

                                <label class="checkbox">
                                    <input type="checkbox" value="">
                                    Отменен
                                </label>

                            </div><!-- /.span4-->
                        </div><!-- /.rowf-luid-->
                    </fieldset>
                </form>
            </div>

            <!-- orders params -->
            <div class="tab-pane" id="ot_filter_products_params">
                <form class="ot_form">
                    <fieldset>

                        <div class="row-fluid">
                            <div class="span4">

                                <label class="checkbox">
                                    <input type="checkbox" value="">
                                    Ожидает оплаты
                                </label>

                                <label class="checkbox">
                                    <input type="checkbox" value="">
                                    Оплачен
                                </label>

                                <label class="checkbox">
                                    <input type="checkbox" value="">
                                    Подтверждение цены
                                </label>

                                <label class="checkbox">
                                    <input type="checkbox" value="">
                                    Заказан
                                </label>


                            </div>
                            <div class="span4">

                                <label class="checkbox">
                                    <input type="checkbox" value="">
                                    Получен на склад
                                </label>

                                <label class="checkbox">
                                    <input type="checkbox" value="">
                                    Проверка качества
                                </label>

                                <label class="checkbox">
                                    <input type="checkbox" value="">
                                    Упаковка
                                </label>

                                <label class="checkbox">
                                    <input type="checkbox" value="">
                                    Готов к отправке
                                </label>

                                <label class="checkbox">
                                    <input type="checkbox" value="">
                                    Отправлен
                                </label>

                            </div>
                            <div class="span4">

                                <label class="checkbox">
                                    <input type="checkbox" value="">
                                    Получен
                                </label>

                                <label class="checkbox">
                                    <input type="checkbox" value="">
                                    Возвращен продавцу
                                </label>

                                <label class="checkbox">
                                    <input type="checkbox" value="">
                                    Невозможно поставить
                                </label>

                                <label class="checkbox">
                                    <input type="checkbox" value="">
                                    Отменен
                                </label>

                            </div><!-- /.span4-->
                        </div><!-- /.row-fluid-->

                    </fieldset>
                </form>
            </div>
        </div>

    </div>

    <form method="post" action="orders/orders-list">
        <div class="row">
            <div class=" offset-top05">
                <div class="pull-right">
                    <button class="btn btn-primary">Показать</button>
                </div>
            </div>
        </div>
    </form>

</div>
