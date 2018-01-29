
<ul class="breadcrumb">
    <li><a href="."><i class="icon-home"></i></a> <span class="divider">›</span></li>
    <li><a href="promo/seo">Продвижение</a> <span class="divider">›</span></li>
    <li class="active">Реферальные программы</li>
</ul>
<!--/.breadcrumb-->

<? include('inc/sub_nav_promo.php'); ?>

<h1>
    Реферальные программы
    <a href="promo/referals/create" class="btn btn-tiny btn-primary btn_preloader weight-normal offset-left2" data-loading-text="Добавить категорию" autocomplete="off" title="Добавить категорию реферальной программы">Добавить категорию</a>
</h1>



<div class="row-fluid offset-bottom1">
    <div class="span6">
        <table class="table table-hover">

            <thead>
                <tr>
                    <th class="span4">Название</th>
                    <th class="span2">Действия</th>
                </tr>
            </thead>

            <tbody>

                <tr>
                    <td><a href="promo/referals/category" title="Просмотреть список пользователей в категории">Начальный уровень</a></td>
                    <td>
                        <div class="btn-group">
                            <!-- add new user -->
                            <button href="#" data-type="typeahead" data-pk="1" data-url="/post" data-placement="bottom" data-placeholder="Начните печатать" class="btn btn-tiny ot-typehead-users editable-buttoned" title="Добавить пользователя в категорию" data-original-title="Добавить пользователя в категорию">+ <i class="icon-user"></i></button>
                            <!-- discount actions -->
                            <a class="btn btn-tiny" href="promo/referals/update" title="Редактировать категорию"><i class="icon-pencil"></i></a><!-- link is user only for prototype dinamics. In real application use button instead -->
                            <button class="btn btn-tiny ot_show_deletion_dialog_modal" title="Удалить категорию"><i class="icon-remove-sign"></i></button>
                        </div>
                    </td>
                </tr>

                <tr>
                    <td><a href="promo/referals/category" title="Просмотреть список пользователей в категории">Средний уровень</a></td>
                    <td>
                        <div class="btn-group">
                            <!-- add new user -->
                            <button href="#" data-type="typeahead" data-pk="1" data-url="/post" data-placement="bottom" data-placeholder="Start typing an user login" class="btn btn-tiny ot-typehead-users editable-buttoned" title="Добавить пользователя в категорию" data-original-title="Добавить пользователя в категорию">+ <i class="icon-user"></i></button>
                            <!-- discount actions -->
                            <a class="btn btn-tiny" href="promo/referals/update" title="Редактировать категорию"><i class="icon-pencil"></i></a><!-- link is user only for prototype dinamics. In real application use button instead -->
                            <button class="btn btn-tiny ot_show_deletion_dialog_modal" title="Удалить категорию"><i class="icon-remove-sign"></i></button>
                        </div>
                    </td>
                </tr>

                <tr>
                    <td><a href="promo/referals/category" title="Просмотреть список пользователей в скидке">Вип-накуп</a></td>
                    <td>
                        <div class="btn-group">
                            <!-- add new user -->
                            <button href="#" data-type="typeahead" data-pk="1" data-url="/post" data-placement="bottom" data-placeholder="Start typing an user login" class="btn btn-tiny ot-typehead-users editable-buttoned" title="Добавить пользователя в категорию" data-original-title="Добавить пользователя в категорию">+ <i class="icon-user"></i></button>
                            <!-- discount actions -->
                            <a class="btn btn-tiny" href="promo/referals/update" title="Редактировать категорию"><i class="icon-pencil"></i></a><!-- link is user only for prototype dinamics. In real application use button instead -->
                            <button class="btn btn-tiny ot_show_deletion_dialog_modal" title="Удалить категорию"><i class="icon-remove-sign"></i></button>
                        </div>
                    </td>
                </tr>

            </tbody>

        </table>
    </div>
</div>

