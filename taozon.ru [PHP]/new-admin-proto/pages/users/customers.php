
<ul class="breadcrumb">
    <li><a href="."><i class="icon-home"></i></a> <span class="divider">›</span></li>
    <li><a href="users/customers">Пользователи</a> <span class="divider">›</span></li>
    <li class="active">Покупатели</li>
</ul>
<!--/.breadcrumb-->

<? include('inc/sub_nav_users.php'); ?>

<div class="row-fluid">
    <h1 class="pull-left">Покупатели</h1>
    <a href="users/customers/create" autocomplete="off" data-loading-text="Добавить пользователя" class="btn btn-tiny btn_preloader pull-right offset-top2" type="submit" title="Добавить нового пользователя"><i class="icon-plus"></i> Добавить пользователя</a>
</div>

<div class="well well-small offset-bottom2">

        <form class="offset-vertical-none" action="users/customers/update">

            <div class="row-fluid offset-bottom05">

                <div class="span2">
                    <label for="ot_user_login_filter">Логин</label>
                    <input type="text" class="input-block-level" data-provide="typeahead" id="ot_user_login_filter" title="Введите первые символы">
                </div>
                <div class="span2">
                    <label for="ot_user_account_filter">Номер счета</label>
                    <input type="text" class="input-block-level" data-provide="typeahead" id="ot_user_account_filter" title="Введите первые символы">
                </div>
                <div class="span2">
                    <label for="ot_user_second_name_filter">Фамилия</label>
                    <input type="text" class="input-block-level" data-provide="typeahead" id="ot_user_second_name_filter"  title="Введите первые символы">
                </div>
                <div class="span2">
                    <label for="ot_user_email_filter">Эл. почта</label>
                    <input type="text" class="input-block-level" data-provide="typeahead" id="ot_user_email_filter" title="Введите первые символы">
                </div>
                <div class="span2">
                    <label for="ot_user_phone_filter">Телефон</label>
                    <input type="text" class="input-block-level" data-provide="typeahead" id="ot_user_phone_filter" title="Введите первые символы">
                </div>
                <div class="span2">
                    <label for="ot_user_city_filter">Город</label>
                    <input type="text" class="input-block-level" data-provide="typeahead" id="ot_user_city_filter" title="Введите первые символы">
                </div>
                <!--<div class="span2">
                    <label for="ot_user_country_filter">Город</label>
                    <input type="text" class="input-medium" id="ot_user_country_filter" title="Введите первые символы">
                </div>-->

            </div>

            <button type="button" class="btn btn_preloader btn-primary" data-loading-text="Применить фильтр" autocomplete="off">Применить фильтр</button>

        </form>

    </div>


<div class="row-fluid inset-bottom05">

    <div class="span6">

        <!-- group actions -->
        <div class="btn-group">
            <button data-toggle="dropdown" class="btn btn-tiny dropdown-toggle"><i class="icon-cog"></i> С выбранными <span class="caret"></span></button>
            <ul class="dropdown-menu">
                <li><a href="#" title="Активировать пользователя"><i class="icon-play-circle"></i> Активировать</a></li>
                <li><a href="#" title="Забанить пользователя"><i class="icon-ban-circle"></i> Забанить</a></li>
                <li><a href="#" title="Удалить пользователя" class="ot_show_deletion_dialog_modal"><i class="icon-remove"></i> Удалить</a></li>
                <li class="divider"></li>
                <li><a href="#" title="Разбанить пользователя"><i class="icon-ok"></i> Разбанить</a></li>
            </ul>
        </div><!-- /group actions -->

    </div>

    <div class="span6 text-right">

        <!-- export users -->
        <div class="btn-group">
            <button data-toggle="dropdown" class="btn btn-tiny dropdown-toggle" title="Экспортировать всех пользователей"><i class="icon-upload-alt"></i> Экспортировать <span class="caret"></span></button>
            <ul class="dropdown-menu">
                <li><a href="#" title="В формате .xml">.xml</a></li>
                <li><a href="#" title="В формате .xls">.xls</a></li>
                <li><a href="#" title="В формате .txt">.txt</a></li>
            </ul>
        </div>

        <!-- export users button active state
        use ladda preloader and progress bar during the export
         -->
        <div class="btn-group">
            <button data-toggle="dropdown" class="btn btn-tiny disabled  ladda-button ladda-progress-button" title="Экспортировать всех пользователей"><i class="ot-preloader-micro"></i> Экспортировать <span class="caret"></span></button>
        </div><!-- /export users -->



        <select class="input-mini offset-left1 offset-bottom0">
            <option value="10" selected="selected">10</option>
            <option value="25">25</option>
            <option value="50">50</option>
            <option value="100">100</option>
            <option value="all">Все</option>
        </select>
    </div>

</div>


<table class="table table-bordered data_table_sorting">
    <thead>
        <tr>
            <th><!-- TODO: remove sorting from this column (datatables docs) -->


                <label class="checkbox inline">
                    <input type="checkbox" id="inlineCheckbox1" value="option1">
                </label>
                <!--
                <div class="btn-group">
                    <button data-toggle="dropdown" class="btn btn-mini dropdown-toggle"><i class="icon-cog"></i>
                        <span class="caret"></span>
                    </button>
                    <ul class="dropdown-menu">
                        <li><a href="#" title="Активировать пользователя"><i class="icon-play-circle"></i> Активировать</a></li>
                        <li><a href="#" title="Забанить пользователя"><i class="icon-ban-circle"></i> Забанить</a></li>
                        <li><a href="#" title="Удалить пользователя" class="ot_show_deletion_dialog_modal"><i class="icon-remove"></i> Удалить</a></li>
                        <li class="divider"></li>
                        <li><a href="#" title="Разбанить пользователя"><i class="icon-ok"></i> Разбанить</a></li>
                    </ul>
                </div>
                -->

            </th>
            <th>Логин</th>
            <th>Номер счета</th>
            <th>Фамилия</th>
            <th>Эл. почта</th>
            <th>Телефон</th>
            <th>Статус</th>
            <th class="td-2btn-width">Действия</th><!-- TODO: remove sorting from this column (datatables docs) -->
        </tr>
    </thead>

    <tbody>

        <tr>
            <td><input type="checkbox"/></td>
            <td><a href="users/customers/user-profile">dmitry.grachikoff</a></td>
            <td>USR-0000000030</td>
            <td>Грачикофф</td>
            <td>dmitry.grachikoff@yandex.ru</td>
            <td>904-214-54-83</td>
            <td><span class="text-error">Забанен</span></td>
            <td>
                <div class="btn-group pull-right">
                    <button data-toggle="dropdown" class="btn btn-mini dropdown-toggle"><i class="icon-cog"></i> <span class="caret"></span></button>
                    <ul class="dropdown-menu">
                        <li><a href="users/customers/update" title="Редактировать пользователя"><i class="icon-pencil"></i> Редактировать</a></li>
                        <li><a href="#" title="Активировать пользователя"><i class="icon-play-circle"></i> Активировать</a></li>
                        <li><a href="#" title="Забанить пользователя"><i class="icon-ban-circle"></i> Забанить</a></li>
                        <li><a href="#" title="Разбанить пользователя"><i class="icon-ok"></i> Разбанить</a></li>
                        <li><a href="#" title="Удалить пользователя" class="ot_show_deletion_dialog_modal"><i class="icon-remove"></i> Удалить</a></li>
                        <li class="divider"></li>
                        <li><a href="." target="_blank" title="Авторизоваться под логином пользователя (откроется в другом окне)"><i class="icon-user"></i> Войти под пользователем <i class="icon-external-link"></i></a> </li>
                    </ul>
                </div>
            </td>
        </tr>

        <tr>
            <td><input type="checkbox"/></td>
            <td><a href="users/customers/user-profile">zakaz-po4ta</a></td>
            <td>USR-0000000054</td>
            <td>Николаев</td>
            <td>zakaz-po4ta@hz.com</td>
            <td>904-213-45-23</td>
            <td><span class="text-success">Активен</span></td>
            <td>
                <div class="btn-group pull-right">
                    <button data-toggle="dropdown" class="btn btn-mini dropdown-toggle disabled"><i class="ot-preloader-micro"></i> <span class="caret"></span></button>
                    <ul class="dropdown-menu">
                        <li><a href="users/customers/update" title="Редактировать пользователя"><i class="icon-pencil"></i> Редактировать</a></li>
                        <li><a href="#" title="Активировать пользователя"><i class="icon-play-circle"></i> Активировать</a></li>
                        <li><a href="#" title="Забанить пользователя"><i class="icon-ban-circle"></i> Забанить</a></li>
                        <li><a href="#" title="Разбанить пользователя"><i class="icon-ok"></i> Разбанить</a></li>
                        <li><a href="#" title="Удалить пользователя" class="ot_show_deletion_dialog_modal"><i class="icon-remove"></i> Удалить</a></li>
                        <li class="divider"></li>
                        <li><a href="." target="_blank" title="Авторизоваться под логином пользователя (откроется в другом окне)"><i class="icon-user"></i> Войти под пользователем <i class="icon-external-link"></i></a> </li>
                    </ul>
                </div>
            </td>
        </tr>

        <tr>
            <td><input type="checkbox"/></td>
            <td><a href="users/customers/user-profile">marinast</a></td>
            <td>USR-0000000076</td>
            <td>Стоянова</td>
            <td>marinastoy@gmail.com</td>
            <td>904-210-33-76</td>
            <td><span class="text-warning">Неактивен</span></td>
            <td>
                <div class="btn-group pull-right">
                    <button data-toggle="dropdown" class="btn btn-mini dropdown-toggle"><i class="icon-cog"></i> <span class="caret"></span></button>
                    <ul class="dropdown-menu">
                        <li><a href="users/customers/update" title="Редактировать пользователя"><i class="icon-pencil"></i> Редактировать</a></li>
                        <li><a href="#" title="Активировать пользователя"><i class="icon-play-circle"></i> Активировать</a></li>
                        <li><a href="#" title="Забанить пользователя"><i class="icon-ban-circle"></i> Забанить</a></li>
                        <li><a href="#" title="Разбанить пользователя"><i class="icon-reply"></i> Разбанить</a></li>
                        <li><a href="#" title="Удалить пользователя" class="ot_show_deletion_dialog_modal"><i class="icon-remove"></i> Удалить</a></li>
                        <li class="divider"></li>
                        <li><a href="." target="_blank" title="Авторизоваться под логином пользователя (откроется в другом окне)"><i class="icon-user"></i> Войти под пользователем <i class="icon-external-link"></i></a> </li>
                    </ul>
                </div>
            </td>
        </tr>

        <tr>
            <td><input type="checkbox"/></td>
            <td><a href="users/customers/user-profile">vitos92</a></td>
            <td>USR-0000000075</td>
            <td>Кругликов</td>
            <td>berdnikovyy@gmail.com</td>
            <td>904-210-33-34</td>
            <td><span class="text-success">Активен</span></td>
            <td>
                <div class="btn-group pull-right">
                    <button data-toggle="dropdown" class="btn btn-mini dropdown-toggle"><i class="icon-cog"></i> <span class="caret"></span></button>
                    <ul class="dropdown-menu">
                        <li><a href="users/customers/update" title="Редактировать пользователя"><i class="icon-pencil"></i> Редактировать</a></li>
                        <li><a href="#" title="Активировать пользователя"><i class="icon-play-circle"></i> Активировать</a></li>
                        <li><a href="#" title="Забанить пользователя"><i class="icon-ban-circle"></i> Забанить</a></li>
                        <li><a href="#" title="Разбанить пользователя"><i class="icon-ok"></i> Разбанить</a></li>
                        <li><a href="#" title="Удалить пользователя" class="ot_show_deletion_dialog_modal"><i class="icon-remove"></i> Удалить</a></li>
                        <li class="divider"></li>
                        <li><a href="." target="_blank" title="Авторизоваться под логином пользователя (откроется в другом окне)"><i class="icon-user"></i> Войти под пользователем <i class="icon-external-link"></i></a> </li>
                    </ul>
                </div>
            </td>
        </tr>

    </tbody>
</table>

<div class="row-fluid">
    <div class="span6">
        <? include('inc/pager.php'); ?>
    </div>
    <div class="span6 text-right inset-top1">
        <strong>Найдено</strong> пользователей: 222; <strong>Показаны:</strong> с 1 по 10
    </div>
</div>
