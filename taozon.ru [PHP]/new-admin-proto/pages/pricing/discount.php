
<ul class="breadcrumb">
    <li><a href="."><i class="icon-home"></i></a> <span class="divider">›</span></li>
    <li><a href="pricing/currency">Ценообразование</a> <span class="divider">›</span></li>
    <li class="active">Скидки</li>
</ul>

<? include('inc/sub_nav_pricing.php'); ?>


<h1>
    Cкидки
    <a href="pricing/discount/create" class="btn btn-primary weight-normal btn_preloader offset-left3" data-loading-text="Добавление" autocomplete="off">Добавить скидку</a>
    <!--
    <button title="Добавить новую скидку" type="submit" class="btn btn_preloader btn-primary" data-loading-text="Добавление" autocomplete="off">Добавить скидку</button>
-->
</h1>

<!-- possible system feedbacks -->
<!--<div class="row-fluid">
    <div class="span6 offset-bottom1">

        <div class="alert alert-success">
            <i class="icon-ok"></i> Пользователь <a href="#" class="bold">NikitaGigurda</a> успешно добавлен в группу скидок «<a href="pricing/discount/specific-discount" class="bold">Начальный уровень</a>»!
        </div>

        <div class="alert alert-error">
            <i class="icon-exclamation-sign"></i> Не удалось добавить пользователя <a href="#" class="bold">Edward Murphy</a> в группу скидок «<a href="pricing/discount/specific-discount" class="bold">Средний уровень</a>», так как произошла неприятность, вероятность которой существует всегда.</strong>
        </div>

    </div>
</div>-->
<!-- /possible system feedbacks -->


<!-- button variant for use in prototype -->

<!-- this is for real application -->




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
                <td><a href="pricing/discount/specific-discount" title="Просмотреть список пользователей в скидке">Начальный уровень</a></td>
                <td>
                    <div class="btn-group">
                        <!-- add new user -->
                        <button href="#" data-type="typeahead" data-pk="1" data-url="/post" data-placement="bottom" data-placeholder="Начните печатать" class="btn btn-tiny ot-typehead-users editable-buttoned" title="Добавить пользователя в скидку" data-original-title="Добавить пользователя в скидку">+ <i class="icon-user"></i></button>
                        <!-- discount actions -->
                        <a class="btn btn-tiny" href="pricing/discount/update" title="Редактировать скидку"><i class="icon-pencil"></i></a><!-- link is user only for prototype dinamics. In real application use button instead -->
                        <button class="btn btn-tiny ot_show_deletion_dialog_modal" title="Удалить скидку"><i class="icon-remove-sign"></i></button>
                    </div>
                </td>
            </tr>


            <tr>
                <td><a href="pricing/discount/specific-discount" title="Просмотреть список пользователей в скидке">Средний уровень</a></td>
                <td>
                    <div class="btn-group">
                        <!-- add new user -->
                        <button href="#" data-type="typeahead" data-pk="1" data-url="/post" data-placement="bottom" data-placeholder="Start typing an user login" class="btn btn-tiny ot-typehead-users editable-buttoned" title="Добавить пользователя в скидку" data-original-title="Добавить пользователя в скидку">+ <i class="icon-user"></i></button>
                        <!-- discount actions -->
                        <a class="btn btn-tiny" href="pricing/discount/update" title="Редактировать скидку"><i class="icon-pencil"></i></a><!-- link is user only for prototype dinamics. In real application use button instead -->
                        <button class="btn btn-tiny ot_show_deletion_dialog_modal" title="Удалить скидку"><i class="icon-remove-sign"></i></button>
                    </div>
                </td>
            </tr>

            <tr>
                <td><a href="pricing/discount/specific-discount" title="Просмотреть список пользователей в скидке">Вип-накуп</a></td>
                <td>
                    <div class="btn-group">
                        <!-- add new user -->
                        <button href="#" data-type="typeahead" data-pk="1" data-url="/post" data-placement="bottom" data-placeholder="Start typing an user login" class="btn btn-tiny ot-typehead-users editable-buttoned" title="Добавить пользователя в скидку" data-original-title="Добавить пользователя в скидку">+ <i class="icon-user"></i></button>
                        <!-- discount actions -->
                        <a class="btn btn-tiny" href="pricing/discount/update" title="Редактировать скидку"><i class="icon-pencil"></i></a><!-- link is user only for prototype dinamics. In real application use button instead -->
                        <button class="btn btn-tiny ot_show_deletion_dialog_modal" title="Удалить скидку"><i class="icon-remove-sign"></i></button>
                    </div>
                </td>
            </tr>
        </tbody>

    </table>
    </div>
</div>

