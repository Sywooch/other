<ul class="breadcrumb">
    <li><a href="."><i class="icon-home"></i></a> <span class="divider">›</span></li>
    <li><a href="support/orders">Тех. поддержка</a> <span class="divider">›</span></li>
    <li class="active">По заказам</li>
</ul>
<!--/.breadcrumb-->

<? include('inc/sub_nav_support.php'); ?>

<div class="row-fluid">

    <h1 class="span5">Обращения по заказам</h1>

    <div class="span3 offset-top2 text-right">
        <span class="text-success">Новых</span> <span class="badge badge-success">20</span>
        <span class="text-error">Без ответа</span> <span class="badge badge-important">25</span>
    </div>

</div>


<div class="row-fluid">

    <div class="span8">

        <div class="well well-small offset-bottom1">

            <form class="ot_form">

                <div class="row-fluid">

                    <div class="span6">
                        <div class="control-group">
                            <label class="control-label bold" for="">Номер обращения</label>
                            <div class="controls">
                                <input type="text" class="input-medium">
                            </div>
                        </div>
                    </div>

                    <div class="span6">
                        <div class="control-group">

                            <label class="control-label bold" for="ot_order_number">Пользователь</label>
                            <div class="controls">
                                <input type="text" class="input-medium" data-provide="typeahead" id="ot_order_number" title="Введите первые символы логина">
                            </div>

                        </div>
                    </div>

                </div>

                <div class="row-fluid">

                    <div class="span6">

                        <div class="control-group">

                            <label class="control-label bold" for="ot_order_number">Номер заказа</label>
                            <div class="controls">
                                <div class="input-prepend">
                                    <span class="add-on">ORD-</span>
                                    <input type="text" class="input-medium" data-provide="typeahead" id="ot_order_number" title="Введите первые символы">
                                </div>
                            </div>

                        </div>

                    </div>

                    <div class="span6">

                        <div class="control-group">
                            <label class="control-label bold">Дата</label>
                            <div class="controls">
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
                        </div>

                    </div>

                </div>

                <div class="row-fluid">

                    <div class="span6">
                        <div class="control-group">
                            <label class="control-label bold text-right">Состояние</label>
                            <div class="controls">
                                <label class="checkbox inline"><input type="checkbox" checked="checked">Новые</label>
                                <label class="checkbox inline"><input type="checkbox" checked="checked">Без ответа</label>
                            </div>
                        </div>
                    </div>

                    <div class="span6">
                        <div class="controls offset-top-lebel-1">
                            <button type="button" class="btn btn_preloader btn-primary pull-right" data-loading-text="Применить" autocomplete="off">Применить</button>
<!--                            <button type="button" class="btn">Сбросить фильтры</button>-->
                        </div>
                    </div>
                </div>

            </form>

        </div><!-- /.well -->

        <div class="text-right">
            <select class="input-mini">
                <option value="10" selected="selected">10</option>
                <option value="25">25</option>
                <option value="50">50</option>
                <option value="100">100</option>
                <option value="all">Все</option>
            </select>
        </div>

        <table class="table ot_support_orders_themes">

            <thead>
                <tr>
                    <th>Тема</th>
                    <th>Cообщения<br><span class="font-11 weight-normal">Всего / <span class="text-success">Новых</span></span></th>
                    <th>Дата</th>
                    <th>Категория</th>
                    <th>Покупатель</th>
                    <th>Номер</th>
                </tr>
            </thead>

            <tbody>

                <tr class="order_row order_expanded">
                    <td colspan="6"><i class="icon-collapse-alt"></i> <strong class="blink" title="Свернуть список тем">ORD-0000001494</strong>
                        <span class="order_summary">
                            (<i class="icon-flag" title="Есть темы требующие ответа"></i>,
                            <span title="Всего тем по заказу">1</span>)
                            <a href="orders/order" title="К заказу" class="goto_order"><i class="icon-external-link-sign"></i></a>
                        </span>
                    </td>
                </tr>

                <tr class="no-top-border">
                    <td><i class="icon-flag" title="Требует ответа"></i> <span class="blink" title="Прочитать переписку">не дошли деньги</span></td>
                    <td class="text-center">2</td>
                    <td>24.06.2013, <span class="muted">21:53</span></td>
                    <td>Выбор товара</td>
                    <td><a href="users/customers/user-profile" title="Профиль покупателя">ievgenyi2013</a></td>
                    <td>Ticket-28</td>
                </tr>


                <tr class="order_row order_expanded">
                    <td colspan="6"><i class="icon-collapse-alt"></i> <strong class="blink" title="Свернуть список тем">ORD-0000001499</strong>
                        <span class="order_summary">
                            (<i class="icon-flag" title="Есть темы требующие ответа"></i>,
                            <strong title="Всего тем по заказу">3</strong> / <strong class="text-success" title="Новых">1</strong>)
                            <a href="orders/order" title="К заказу" class="goto_order"><i class="icon-external-link-sign"></i></a>
                        </span>
                    </td>
                </tr>

                <tr class="no-top-border">
                    <td><i class="icon-flag" title="Требует ответа"></i> <strong class="blink" title="Прочитать переписку">Не изменился статус посылки!!!</strong></td>
                    <td class="text-center"><strong>4</strong> / <strong class="text-success">1</strong></td>
                    <td>24.06.2013, <span class="muted">21:53</span></td>
                    <td>Выбор товара</td>
                    <td><a href="users/customers/user-profile" title="Профиль покупателя">ievgenyi2013</a></td>
                    <td>Ticket-28</td>
                </tr>

                <tr class="no-top-border">
                    <td><i class="icon-flag" title="Требует ответа"></i> <span class="blink" title="Прочитать переписку">не дошли деньги</span></td>
                    <td class="text-center">2</td>
                    <td>24.06.2013, <span class="muted">21:53</span></td>
                    <td>Выбор товара</td>
                    <td><a href="users/customers/user-profile" title="Профиль покупателя">ievgenyi2013</a></td>
                    <td>Ticket-28</td>
                </tr>

                <tr class="no-top-border">
                    <td><span class="blink" title="Прочитать переписку">Какие новости?</span></td>
                    <td class="text-center">5</td>
                    <td>24.06.2013, <span class="muted">21:53</span></td>
                    <td>Выбор товара</td>
                    <td><a href="users/customers/user-profile" title="Профиль покупателя">ievgenyi2013</a></td>
                    <td>Ticket-28</td>
                </tr>


                <tr class="order_row">
                    <td colspan="6">
                        <i class="icon-expand-alt"></i>
                        <strong class="blink" title="Отобразить список тем">ORD-0000001362</strong>
                        <span class="order_summary">
                            (<span title="Всего тем">4</span>)
                            <a href="orders/order" title="К заказу" class="goto_order"><i class="icon-external-link-sign"></i></a>
                        </span>
                    </td>
                </tr>
                <tr class="order_row">
                    <td colspan="6">
                        <i class="icon-expand-alt"></i>
                        <strong class="blink" title="Отобразить список тем">ORD-0000001362</strong>
                        <span class="order_summary">
                            (<span title="Всего тем">2</span>)
                            <a href="orders/order" title="К заказу" class="goto_order"><i class="icon-external-link-sign"></i></a>
                        </span>
                    </td>
                </tr>
                <tr class="order_row">
                    <td colspan="5">
                        <i class="icon-expand-alt"></i>
                        <strong class="blink" title="Отобразить список тем">ORD-0000001362</strong>
                        <span class="order_summary">
                            (<span title="Всего тем">2</span>)
                            <a href="orders/order" title="К заказу" class="goto_order"><i class="icon-external-link-sign"></i></a>
                        </span>
                    </td>
                </tr>                <tr class="order_row">
                    <td colspan="5">
                        <i class="icon-expand-alt"></i>
                        <strong class="blink" title="Отобразить список тем">ORD-0000001362</strong>
                        <span class="order_summary">
                            (<span title="Всего тем">2</span>)
                            <a href="orders/order" title="К заказу" class="goto_order"><i class="icon-external-link-sign"></i></a>
                        </span>
                    </td>
                </tr>                <tr class="order_row">
                    <td colspan="5">
                        <i class="icon-expand-alt"></i>
                        <strong class="blink" title="Отобразить список тем">ORD-0000001362</strong>
                        <span class="order_summary">
                            (<span title="Всего тем">2</span>)
                            <a href="orders/order" title="К заказу" class="goto_order"><i class="icon-external-link-sign"></i></a>
                        </span>
                    </td>
                </tr>
                <tr class="order_row">
                    <td colspan="5">
                        <i class="icon-expand-alt"></i>
                        <strong class="blink" title="Отобразить список тем">ORD-0000001362</strong>
                        <span class="order_summary">
                            (<span title="Всего тем">5</span>)
                            <a href="orders/order" title="К заказу" class="goto_order"><i class="icon-external-link-sign"></i></a>
                        </span>
                    </td>
                </tr>
                <tr class="order_row">
                    <td colspan="5">
                        <i class="icon-expand-alt"></i>
                        <strong class="blink" title="Отобразить список тем">ORD-0000001362</strong>
                        <span class="order_summary">
                            (<span title="Всего тем">2</span>)
                            <a href="orders/order" title="К заказу" class="goto_order"><i class="icon-external-link-sign"></i></a>
                        </span>
                    </td>
                </tr>
                <tr class="order_row">
                    <td colspan="5">
                        <i class="icon-expand-alt"></i>
                        <strong class="blink" title="Отобразить список тем">ORD-0000001362</strong>
                        <span class="order_summary">
                            (<span title="Всего тем">2</span>)
                            <a href="orders/order" title="К заказу" class="goto_order"><i class="icon-external-link-sign"></i></a>
                        </span>
                    </td>
                </tr>
                <tr class="order_row">
                    <td colspan="5">
                        <i class="icon-expand-alt"></i>
                        <strong class="blink" title="Отобразить список тем">ORD-0000001362</strong>
                        <span class="order_summary">
                            (<span title="Всего тем">2</span>)
                            <a href="orders/order" title="К заказу" class="goto_order"><i class="icon-external-link-sign"></i></a>
                        </span>
                    </td>
                </tr>
                <tr class="order_row">
                    <td colspan="5">
                        <i class="icon-expand-alt"></i>
                        <strong class="blink" title="Отобразить список тем">ORD-0000001362</strong>
                        <span class="order_summary">
                            (<span title="Всего тем">2</span>)
                            <a href="orders/order" title="К заказу" class="goto_order"><i class="icon-external-link-sign"></i></a>
                        </span>
                    </td>
                </tr>
                <tr class="order_row">
                    <td colspan="5">
                        <i class="icon-expand-alt"></i>
                        <strong class="blink" title="Отобразить список тем">ORD-0000001362</strong>
                        <span class="order_summary">
                            (<span title="Всего тем">2</span>)
                            <a href="orders/order" title="К заказу" class="goto_order"><i class="icon-external-link-sign"></i></a>
                        </span>
                    </td>
                </tr>
                <tr class="order_row">
                    <td colspan="5">
                        <i class="icon-expand-alt"></i>
                        <strong class="blink" title="Отобразить список тем">ORD-0000001362</strong>
                        <span class="order_summary">
                            (<span title="Всего тем">1</span>)
                            <a href="orders/order" title="К заказу" class="goto_order"><i class="icon-external-link-sign"></i></a>
                        </span>
                    </td>
                </tr>
                <tr class="order_row">
                    <td colspan="5">
                        <i class="icon-expand-alt"></i>
                        <strong class="blink" title="Отобразить список тем">ORD-0000001362</strong>
                        <span class="order_summary">
                            (<span title="Всего тем">2</span>)
                            <a href="orders/order" title="К заказу" class="goto_order"><i class="icon-external-link-sign"></i></a>
                        </span>
                    </td>
                </tr>
                <tr class="order_row">
                    <td colspan="5">
                        <i class="icon-expand-alt"></i>
                        <strong class="blink" title="Отобразить список тем">ORD-0000001362</strong>
                        <span class="order_summary">
                            (<span title="Всего тем">4</span>)
                            <a href="orders/order" title="К заказу" class="goto_order"><i class="icon-external-link-sign"></i></a>
                        </span>
                    </td>
                </tr>



            </tbody>
        </table>

    </div>


    <div class="span4">
        <div class="ot_support_view_topic">
            <aside class="well">

                <p>Заказ: <a href="orders/order" title="К заказу">ORD-0000001499</a></p>
                <h4>Переписка по теме «Какие новости?»</h4>


                <div class="row-fluid offset-bottom05">

                    <div class="pull-left"><i class="icon-plus color-blue"></i> <span class="blink font-12" data-toggle="collapse" data-target=".support-message-reply-form" title="Добавить сообщение">Добавить сообщение</span></div>

                    <div class="btn-group pull-right">
                        <button data-toggle="dropdown" class="btn btn-mini dropdown-toggle"><i class="icon-cog"></i> <span class="caret"></span></button>
                        <ul class="dropdown-menu">
                            <li><a href="support/orders" title="Закрыть переписку"><i class="icon-lock"></i> Закрыть переписку</a></li>
                        </ul>
                    </div>
                </div>



                <div class="collapse support-message-reply-form">
                    <form class="form-horizontal offset-top1 offset-bottom2">

                        <textarea rows="6" class="input-block-level" placeholder="Текст сообщения"></textarea>

                        <div class="offset-top05">
                            <button autocomplete="off" data-loading-text="Добавить" class="btn btn-tiny btn-primary btn_preloader" type="button">Добавить</button>
                            <button class="btn btn-tiny offset-left1" type="button" data-toggle="collapse" data-target=".support-message-reply-form">Отменить</button>
                        </div>
                    </form>
                </div>


                <div class="chat-messages">

                    <p class="message-box new">
                        <span class="message">
                            <strong><i class="icon-envelope"></i> Николай Гоголь</strong>
                            <span class="message-time">8.01.2013, 10:03</span>
                            <span class="message-text">Ну и само собой чтобы размеры и прочие хар-ки оставались</span>
                        </span>
                    </p>

                    <p class="message-box operator">
                    <span class="message">
                        <strong><i class="icon-reply  muted"></i> Максим Перепилица</strong>
                        <span class="message-time">7.01.2013, 12:45</span>
                        <span class="message-text">Такие есть только по 5 рублей уже, а не по 3 как указано на сайте.</span>
                    </span>
                    </p>

                    <p class="message-box">
                    <span class="message">
                        <strong><i class="icon-envelope-alt muted"></i> Николай Гоголь</strong>
                        <span class="message-time">4.01.2013, 14:23</span>
                        <span class="message-text">Хочу вот такие же, но с перламутровыми пуговицами, есть у вас? </span>
                    </span>
                    </p>

                </div>

            </aside>
        </div>
    </div>

</div>


<? include 'inc/pager.php'; ?>


