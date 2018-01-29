
<div class="well">
    <form class="form ot_form ot_form_orders_filters offset-vertical-none" action="orders/filtered-list">

        <div class="row-fluid">

            Вывести
            <select class="input-large">
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
                <input id="date-start-display" class="input-small" type="text" data-date-format="dd.mm.yyyy" data-date="05.02.2013" value="04.01.2013">
                <span class="btn add-on" id="date-start" ><i class="icon-calendar"></i></span>
            </div>

            по
            <div class="input-append">
                <input  id="date-end-display" class="input-small" type="text" data-date-format="dd.mm.yyyy" data-date="12.02.2013" value="05.01.2013">
                <span class="btn add-on" id="date-end" ><i class="icon-calendar"></i></span>
            </div>

        </div>

        <div class="row-fluid">
            <div class="span2">
                <fieldset>

                        <!-- user params -->
                        <legend class="legend-small">Покупатель</legend>

                        <!-- family name-->
                        <div class="control-group">
                            <div class="controls">
                                <input name="textinput" placeholder="Фамилия" class="input-medium" type="text"  title="фамилия">
                            </div>
                        </div>

                        <!-- telephone -->
                        <div class="control-group">
                            <div class="controls">
                                <input name="textinput" placeholder="Телефон" class="input-medium" type="text" title="Телефон">
                            </div>
                        </div>

                        <!-- e-mail -->
                        <div class="control-group">
                            <div class="controls">
                                <input name="textinput" placeholder="Эл. почта" class="input-medium" type="text" title="Эл. почта">
                            </div>
                        </div>

                    </fieldset>
            </div>
            <div class="span3 offset2">
                <fieldset>
                    <div class="well well-white inset-top0">
                        <!-- orders params -->
                        <legend class="legend-small">Заказы</legend>

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
                            В обработке
                        </label>

                        <label class="checkbox">
                            <input type="checkbox" value="">
                            Дозаказан
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

                        <label class="checkbox">
                            <input type="checkbox" value="">
                            Завершен
                        </label>

                        <label class="checkbox">
                            <input type="checkbox" value="">
                            Отменен
                        </label>
                    </div>
                </fieldset>
            </div>
            <div class="span3 offset2">
                <fieldset>
                    <div class="well well-white inset-top0">
                        <!-- orders params -->
                        <div class="offset-bottom1_2"><legend class="legend-small">Товары</legend></div>

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

                        <label class="checkbox">
                            <input type="checkbox" value="">
                            Проверка качества
                        </label>

                        <label class="checkbox">
                            <input type="checkbox" value="">
                            Получен на склад
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
                    </div>
                </fieldset>
            </div>
        </div>

        <button class="btn btn-primary">Показать</button>

    </form>
</div>
