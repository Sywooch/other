
<ul class="breadcrumb">
    <li><a href="."><i class="icon-home"></i></a> <span class="divider">›</span></li>
    <li><a href="pricing/currency">Ценообразование</a> <span class="divider">›</span></li>
    <li><a href="pricing/discount">Скидки</a> <span class="divider">›</span></li>
    <li class="active">«Средний уровень»</li>
</ul>

<? include('inc/sub_nav_pricing.php'); ?>


<h1>
    Скидка «Средний уровень»
    <a href="pricing/discount/update" class="btn btn_preloader btn-primary btn-tiny weight-normal offset-left2" data-loading-text="Редактировать" autocomplete="off" title="Редактировать скидку">Редактировать</a>
</h1>

<div class="row-fluid">
    <div class="span6">
<!--        <h3>Пользователи в группе скидок «Название скидки»</h3>-->

        <!-- possible system feedbacks -->
<!--        <div class="alert alert-success">
            <i class="icon-ok"></i> Пользователь <a href="#" class="bold">VasiaPupkin</a> успешно добавлен в группу скидок!
        </div>

        <div class="alert alert-error">
            <i class="icon-exclamation-sign"></i> Не удалось добавить пользователя <a href="#" class="bold">Edward Murphy</a> в группу скидок, так как произошла неприятность, вероятность которой существует всегда.</strong>
        </div>

        <div class="alert alert-success">
            <i class="icon-ok"></i> Пользователь <a href="#" class="bold">NikitaGigurda</a> успешно удален из группы скидок!
        </div>

        <div class="alert alert-error">
            <i class="icon-exclamation-sign"></i> Не удалось удалить пользователя <a href="#" class="bold">Chuck Norris</a> из группы скидок, потому что <strong>нельзя просто так взять и удалить Чака Норриса <i class="icon-smile"></i></strong>
        </div>-->
        <!-- /possible system feedbacks -->


        <!-- add new user -->
        <p class="offset-bottom2">
            <span data-type="typeahead" data-pk="1" data-url="/post" data-placement="bottom"  class="ot-typehead-users editable-no-brd">
                <i class="icon-plus font-14 color-blue"></i>
                <span class="blink" title="Добавить пользователя в скидку">
                    Добавить пользователя
                </span>
            </span>
        </p>

        <!-- list of users in discount group -->

            <div class="row-fluid">

                <div class="pull-right">
                    <select class="input-mini" title="Количество элементов на странице">
                        <option value="10" selected="selected">10</option>
                        <option value="25">25</option>
                        <option value="50">50</option>
                        <option value="100">100</option>
                    </select>
                </div>

            </div>

            <table class="table table-bordered data_table_sorting">

            <thead>
            <tr>
                <th class="span7">Пользователь</th>
                <th class="span1">Действия</th>
            </tr>
            </thead>

            <tbody>

            <tr class="success">
                <td><a href="users/customers/user-profile" title="Перейти в профиль пользователя">Успешно добавленный только что пользователь</a></td>
                <td>
                    <div class="btn-group">
                        <button class="btn btn-tiny info-discount-user" data-placement="top" title="Информация о пользователе"><i class="icon-info"></i></button>
                        <button class="btn btn-tiny ot_show_deletion_dialog_modal" title="Удалить пользователя"><i class="icon-remove"></i></button>
                    </div>
                    <div class="user-discount-info">
                        <dl class="dl-horizontal">
                            <dt>Логин:</dt>
                            <dd><a href="#">VasiaPupkin</a></dd>
                            <dt>Имя:</dt>
                            <dd>Василий</dd>
                            <dt>Фамилия:</dt>
                            <dd>Пупкин</dd>
                            <dt>Отчество:</dt>
                            <dd>Елизарович</dd>
                            <dt>Счет:</dt>
                            <dd>USR-0000000046</dd>
                        </dl>
                    </div>
                </td>
            </tr>

            <tr>
                <td><a href="users/customers/user-profile" title="Перейти в профиль пользователя">NikitaGigurda</a></td>
                <td>
                    <div class="btn-group">
                        <button class="btn btn-tiny info-discount-user" data-placement="top" title="Информация о пользователе"><i class="icon-info"></i></button>
                        <button class="btn btn-tiny ot_show_deletion_dialog_modal" title="Удалить пользователя"><i class="icon-remove"></i></button>
                    </div>
                    <div class="user-discount-info">
                        <dl class="dl-horizontal">
                            <dt>Логин:</dt>
                            <dd><a href="#">NikitaGigurda</a></dd>
                            <dt>Имя:</dt>
                            <dd>Никита</dd>
                            <dt>Фамилия:</dt>
                            <dd>Джигурда</dd>
                            <dt>Отчество:</dt>
                            <dd>Борисович</dd>
                            <dt>Счет:</dt>
                            <dd>USR-0000000056</dd>
                        </dl>
                    </div>
                </td>
            </tr>

            <tr>
                <td><a href="users/customers/user-profile" title="Перейти в профиль пользователя">qwe-qwe835-fdds-sdfsdfsdf</a></td>
                <td>
                    <div class="btn-group">
                        <button class="btn btn-tiny info-discount-user" data-placement="top" title="Информация о пользователе"><i class="icon-info"></i></button>
                        <button class="btn btn-tiny ot_show_deletion_dialog_modal" title="Удалить пользователя"><i class="icon-remove"></i></button>
                    </div>
                    <div class="user-discount-info">
                        <dl class="dl-horizontal">
                            <dt>Логин:</dt>
                            <dd><a href="#">qwe-qwe835-fdds-sdfsdfsdf</a></dd>
                            <dt>Фамилия:</dt>
                            <dd class="muted">—</dd>
                            <dt>Имя:</dt>
                            <dd class="muted">—</dd>
                            <dt>Отчество:</dt>
                            <dd class="muted">—</dd>
                            <dt>Счет:</dt>
                            <dd>USR-0000000056</dd>
                        </dl>
                    </div>
                </td>
            </tr>


            </tbody>

        </table>


    </div><!-- /.span6 -->

</div><!-- /.row-fluid -->


<? include('inc/pager.php'); ?>

<p><a href="pricing/discount"><i class="icon-reply icon-linked"></i>К списку скидок</a></p>


