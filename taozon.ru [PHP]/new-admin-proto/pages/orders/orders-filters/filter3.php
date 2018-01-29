


<div class="well well-small ot_orders_filters">
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



    <div class="box box-blinked box-closed corner-all offset-top1 offset-vertical-none">
        <div class="box-header corner-top">
<!--            <i class="icon-plus-sign color-blue font-14"></i>-->
<!--            <i class="icon-plus color-blue font-14"></i>-->
                <i class="icon-caret-right color-blue font-14"></i>
            <a href="#" data-box="collapse" class="font-14">Покупатель</a>
        </div>

        <div class="box-body">
            <form class="form-inline">
                <fieldset>
                    <!-- family name-->
                    <input name="textinput" placeholder="Фамилия" class="input-medium" type="text">

                    <!-- telephone -->
                    <input name="textinput" placeholder="Телефон" class="input-medium" type="text">

                    <!-- e-mail -->
                    <input name="textinput" placeholder="Эл. почта" class="input-medium" type="text">
                </fieldset>
            </form>
        </div>
    </div>

    <div class="box box-blinked box-closed corner-all offset-top1 offset-bottom1">
        <div class="box-header corner-top">
            <i class="icon-caret-right color-blue font-14"></i>
            <a href="#" data-box="collapse" class="font-14">Заказы</a>
        </div>

        <div class="box-body">
            <form class="ot_form">
                <fieldset>

                    <div class="row-fluid">
                        <div class="span4">

                            <!-- order ID -->

                            <div class="input-prepend">
                                <span class="add-on">ORD-</span>
                                <input name="textinput" placeholder="Номер заказа" class="input-medium" type="text">
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
            <hr>
        </div>
    </div>

    <div class="box box-blinked box-closed corner-all offset-top1 offset-bottom1">
        <div class="box-header corner-top">
            <i class="icon-caret-right color-blue font-14"></i>
            <a href="#" data-box="collapse" class="font-14">Товары</a>
        </div>

        <div class="box-body">
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


    <form method="post" action="orders/orders-list">
        <div class="row">
            <div class="span10 offset-top05">
                <div class="pull-right">
                    <button class="btn btn-primary">Показать</button>
                </div>
            </div>
        </div>
    </form>

</div>
