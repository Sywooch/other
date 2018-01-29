
<div class="well">
    <form class="form ot_form ot_form_orders_filters offset-vertical-none" action="orders/filtered-list">

        <div class="row-fluid">
            <div class="span4">
                <div class="row-fluid">

                    Вывести
                    <select class="input-large offset-left2">
                        <option value="за произвольный период">за произвольный период</option>
                        <option value="за текущие сутки">за сегодня</option>
                        <option value="за прошедшие сутки">за вчера</option>
                        <option value="за текущую неделю">за текущую неделю</option>
                        <option value="за прошлую неделю">за прошлую неделю</option>
                        <option value="за последний месяц">за последний месяц</option>
                        <option value="за последние 3 месяца">за последние 3 месяца</option>
                        <option value="с начала года">с начала года</option>
                    </select>
<br>
                    с
                    <div class="input-append">
                        <input id="date-start-display" class="input-small" type="text" data-date-format="dd.mm.yyyy" data-date="05.02.2013" value="04.01.2013">
                        <span class="btn add-on" id="date-start"><i class="icon-calendar"></i></span>
                    </div>

                    по
                    <div class="input-append">
                        <input  id="date-end-display" class="input-small" type="text" data-date-format="dd.mm.yyyy" data-date="12.02.2013" value="05.01.2013">
                        <span class="btn add-on" id="date-end"><i class="icon-calendar"></i></span>
                    </div>

                </div>

                <div class="row-fluid">

                    <fieldset>
                    <!-- user params -->
                    <legend class="legend-small">Покупатель</legend>
                    <div class="row-fluid inset-top1">

                        <div class="span6">

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
                        </div>

                    </div>
                </fieldset>

                </div>

            </div>

            <div class="span8">

                <div class="span5 offset1">
                    <fieldset>
                        <div class="well inset-top0">
                            <!-- orders params -->
                            <legend class="legend-small"><i class="icon-shopping-cart font-14"></i> Заказы</legend>

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
                                <input type="checkbox" checked="checked" value="">
                                Оплачен
                            </label>

                            <label class="checkbox">
                                <input type="checkbox" checked="checked" value="">
                                В обработке
                            </label>

                            <label class="checkbox">
                                <input type="checkbox" checked="checked" value="">
                                Дозаказан
                            </label>

                            <label class="checkbox">
                                <input type="checkbox" checked="checked" value="">
                                В обработке на складе
                            </label>

                            <label class="checkbox">
                                <input type="checkbox" checked="checked" value="">
                                Готов к упаковке
                            </label>

                            <label class="checkbox">
                                <input type="checkbox" checked="checked" value="">
                                Готов к отправке
                            </label>

                            <label class="checkbox">
                                <input type="checkbox" checked="checked" value="">
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

                <div class="span5 offset1">
                    <fieldset>
                        <div class="well inset-top0">
                            <!-- orders params -->
                            <div class="offset-bottom1_2"><legend class="legend-small"><i class="icon-th font-14"></i> Товары</legend></div>

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
        </div>

        <!-- Achtung! Diese button made as link only for prototype to gain interaction ;) Insert right one in the application:
         <input type="submit" class="btn btn-primary btn_preloader" value="Применить">
         -->
        <div class="row-fluid">

            <div class="span4">
                <a href="orders/filtered-list" class="btn btn-primary btn_preloader" data-loading-text="Применить">Применить</a>
            </div>

            <div class="span3">
                <button title="Сбросить фильтры" href="#" class="btn offset3">Сбросить фильтры</button>
            </div>

            <div class="span5">

                <div class="pull-right offset-top1">

                    <!-- statuses language -->
                    <div class="btn-group">
                        <a class="btn btn-mini dropdown-toggle" data-toggle="dropdown" href="#" title="Перевести статусы на язык требуемой версии сайта">
                            Перевести статусы
                            <span class="caret"></span>
                        </a>
                        <ul class="dropdown-menu">
                            <li><a data-value="Ru" href="#">Ru</a></li>
                            <li><a data-value="Eng" href="#">Eng</a></li>
                            <li><a data-value="Ch" href="#">Ch</a></li>
                        </ul>
                    </div>
                    <!-- /statuses language -->

                    <!-- filters preferences-->
                    <button class="btn btn-mini offset-left05 disabled" title="Настроить фильтры"><i class="icon-cogs"></i></button>

                </div><!-- /.pull-right -->

            </div><!-- /.span5-->

        </div><!-- /.row-fluid-->
    </form>
</div>
