
<ul class="breadcrumb">
    <li><a href="."><i class="icon-home"></i></a> <span class="divider">›</span></li>
    <li><a href="users/customers">Пользователи</a> <span class="divider">›</span></li>
    <li class="active">Роли</li>
</ul>
<!--/.breadcrumb-->

<? include('inc/sub_nav_users.php'); ?>

<h1>
    Роли
    <a href="users/roles/crud" class="btn btn-primary btn_preloader weight-normal offset-left3" title="Добавить новую роль" data-loading-text="Добавить">Добавить</a>
</h1>

<div class="row-fluid offset-bottom1">
    <div class="span5">
        <table class="table table-bordered data_table_sorting">
            <thead>
            <tr>
                <th>Роль</th>
                <th class="td-2btn-width">Действия</th>
            </tr>
            </thead>

            <tbody>

            <tr>
                <td class="bold">Суперадминистратор</td>
                <td><a class="btn btn-mini" href="users/roles/crud" title="Просмотреть права роли"><i class="icon-pencil"></i></a></td>
            </tr>
            <tr>
                <td class="bold">Оператор</td>
                <td><a class="btn btn-mini" href="users/roles/crud" title="Просмотреть права роли"><i class="icon-pencil"></i></a></td>
            </tr>
            <tr>
                <td class="bold">Финансовый оператор</td>
                <td><a class="btn btn-mini" href="users/roles/crud" title="Просмотреть права роли"><i class="icon-pencil"></i></a></td>
            </tr>
            <tr>
                <td class="bold">Редактор</td>
                <td><a class="btn btn-mini" href="users/roles/crud" title="Просмотреть права роли"><i class="icon-pencil"></i></a></td>
            </tr>

            <tr>
                <td>Бухгалтер</td>
                <td>
                    <a class="btn btn-mini" href="users/roles/crud" title="Редактировать"><i class="icon-pencil"></i></a>
                    <a class="btn btn-mini ot_show_deletion_dialog_modal" href="#" title="Удалить"><i class="icon-remove"></i></a>
                </td>
            </tr>
            <tr>
                <td>Сеошник</td>
                <td>
                    <a class="btn btn-mini" href="users/roles/crud" title="Редактировать"><i class="icon-pencil"></i></a>
                    <a class="btn btn-mini ot_show_deletion_dialog_modal" href="#" title="Удалить"><i class="icon-remove"></i></a>
                </td>
            </tr>

            </tbody>
        </table>
    </div>
</div>


