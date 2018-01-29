<ul class="breadcrumb">
    <li><a href="."><i class="icon-home"></i></a> <span class="divider">›</span></li>
    <li><a href="support/orders">Тех. поддержка</a> <span class="divider">›</span></li>
    <li class="active">Общие вопросы</li>
</ul>
<!--/.breadcrumb-->

<? include('inc/sub_nav_support.php'); ?>

<div class="row-fluid">

    <h1 class="span5">Общие вопросы</h1>

    <div class="span3 offset-top2 text-right">
        <span class="text-success">Новых нет</span>, <!--<span class="badge badge-success">20</span>-->
        <span class="text-error">Неотвеченных нет</span> <!--<span class="badge badge-important">25</span>-->
    </div>

</div>

<div class="row-fluid">

    <div class="span8">

        <div class="well well-small offset-bottom1">

            <form class="ot_form">

                <div class="row-fluid">

                    <div class="span3">
                        <div class="control-group">
                            <label class="control-label bold" for="">Номер обращения</label>
                            <div class="controls">
                                <input type="text" class="input-block-level">
                            </div>
                        </div>
                    </div>

                    <div class="span3 offset1">
                        <div class="control-group">

                            <label class="control-label bold" for="ot_order_number">Пользователь</label>
                            <div class="controls">
                                <input type="text" class="input-block-level" data-provide="typeahead" id="ot_order_number" title="Введите первые символы логина">
                            </div>

                        </div>
                    </div>

                    <div class="span4 offset1">

                        <div class="control-group">
                            <label class="control-label bold">Состояние</label>
                            <div class="controls">
                                <label class="checkbox inline"><input type="checkbox" checked="checked">Новые</label>
                                <label class="checkbox inline"><input type="checkbox" checked="checked">Без ответа</label>
                            </div>
                        </div>

                    </div>

                </div>

                <div class="row-fluid">

                    <div class="span10">

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

                    <div class="span2 offset-top-lebel-1">

                        <button type="button" class="btn btn_preloader btn-primary pull-right" data-loading-text="Применить" autocomplete="off">Применить</button>

                    </div>

                </div>

                <!--<div class="controls">
                    <button type="button" class="btn pull-right">Сбросить фильтры</button>
                </div>-->

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

        <table class="table ot_support_general_themes">

            <thead>
                <tr>
                    <th colspan="2">Тема</th>
                    <th>Cообщения<br><span class="font-11"><span class="weight-normal">Всего</span> / <span class="text-success">Новых</span></span></th>
                    <th>Дата</th>
                    <th>Категория</th>
                    <th>Покупатель</th>
                    <th>Номер</th>
                </tr>
            </thead>

            <tbody>

                <tr>
                    <td><i class="icon-flag" title="Требует ответа"></i></td>
                    <td><strong class="blink" title="Открыть переписку">не изменился статус посылки!!!</strong></td>
                    <td class="text-center"><strong>4</strong> / <strong class="text-success">1</strong></td>
                    <td>24.06.2013, <span class="muted">21:53</span></td>
                    <td>Выбор товара</td>
                    <td><a href="users/customers/user-profile" title="Профиль покупателя">ievgenyi2013</a></td>
                    <td>Ticket-28</td>
                </tr>

                <tr>
                    <td><i class="icon-flag" title="Требует ответа"></i></td>
                    <td><span class="blink" title="Открыть переписку">не дошли деньги</span></td>
                    <td class="text-center">2</td>
                    <td>24.06.2013, <span class="muted">21:53</span></td>
                    <td>Выбор товара</td>
                    <td><a href="users/customers/user-profile" title="Профиль покупателя">ievgenyi2013</a></td>
                    <td>Ticket-28</td>
                </tr>

                <tr>
                    <td></td>
                    <td><span class="blink" title="Открыть переписку">Какие новости?</span></td>
                    <td class="text-center">5</td>
                    <td>24.06.2013, <span class="muted">21:53</span></td>
                    <td>Выбор товара</td>
                    <td><a href="users/customers/user-profile" title="Профиль покупателя">ievgenyi2013</a></td>
                    <td>Ticket-28</td>
                </tr>

            </tbody>
        </table>

    </div>


    <div class="span4">
        <div class="ot_support_view_topic">
            <aside class="well">

                <!--<h4><i class="icon-long-arrow-left muted"></i> Выберите тему из списка для отображения здесь обращений</h4>-->

            <h4>Переписка по теме «Какие новости?»</h4>
            <i class="ot-preloader-medium preloader-centered"></i>


        </aside>
        </div>
    </div>

</div>


<? include 'inc/pager.php'; ?>