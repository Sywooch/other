
<ul class="breadcrumb">
    <li><a href="."><i class="icon-home"></i></a> <span class="divider">›</span></li>
    <li><a href="users/customers">Пользователи</a> <span class="divider">›</span></li>
    <li class="active">Администраторы</li>
</ul>
<!--/.breadcrumb-->

<? include('inc/sub_nav_users.php'); ?>

<h1>
    Администраторы
    <a href="users/administrators/crud" class="btn btn-primary btn_preloader weight-normal offset-left3" title="Добавить нового администратора" data-loading-text="Добавить">Добавить</a>
</h1>


<div class="row-fluid offset-bottom1">
    <div class="span8">
        <table class="table table-bordered data_table_sorting">
            <thead>
                <tr>
                    <th>Роль</th>
                    <th>Логин</th>
                    <th>Имя пользователя</th>
                    <th class="td-2btn-width">Действия</th>
                </tr>
            </thead>

            <tbody>

                <tr>
                    <td>Суперадминистратор</td>
                    <td>root</td>
                    <td>Суперадминистратор по умолчанию</td>
                    <td>
                        <a class="btn btn-mini" href="users/administrators/crud" title="Редактировать"><i class="icon-pencil"></i></a>
                    </td>
                </tr>
                <tr>
                    <td>Оператор</td>
                    <td>operator</td>
                    <td>Оператор по умолчанию</td>
                    <td>
                        <a class="btn btn-mini" href="users/administrators/crud" title="Редактировать"><i class="icon-pencil"></i></a>
                    </td>
                </tr>
                <tr>
                    <td>Финансовый оператор</td>
                    <td>finop</td>
                    <td>Финансовый оператор по умолчанию</td>
                    <td>
                        <a class="btn btn-mini" href="users/administrators/crud" title="Редактировать"><i class="icon-pencil"></i></a>
                    </td>
                </tr>
                <tr>
                    <td>Редактор</td>
                    <td>redactor</td>
                    <td>Редактор по умолчанию</td>
                    <td>
                        <a class="btn btn-mini" href="users/administrators/crud" title="Редактировать"><i class="icon-pencil"></i></a>
                    </td>
                </tr>

                <tr>
                    <td>Оператор</td>
                    <td>lead-operator</td>
                    <td>Инокентий Смоктуновский</td>
                    <td>
                        <a class="btn btn-mini" href="users/administrators/crud" title="Редактировать"><i class="icon-pencil"></i></a>
                        <a class="btn btn-mini ot_show_deletion_dialog_modal" href="#" title="Удалить"><i class="icon-remove"></i></a>
                    </td>
                </tr>

                <tr>
                    <td>Финансовый оператор</td>
                    <td>lead-fin-operator</td>
                    <td>Лариса Долина</td>
                    <td>
                        <a class="btn btn-mini" href="users/administrators/crud" title="Редактировать"><i class="icon-pencil"></i></a>
                        <a class="btn btn-mini ot_show_deletion_dialog_modal" href="#" title="Удалить"><i class="icon-remove"></i></a>
                    </td>
                </tr>

            </tbody>
        </table>
    </div>
</div>

