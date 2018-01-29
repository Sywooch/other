
<ul class="breadcrumb">
    <li><a href="."><i class="icon-home"></i></a> <span class="divider">›</span></li>
    <li><a href="cat/categories">Каталог</a> <span class="divider">›</span></li>
    <li class="active">Отзывы о товарах</li>
</ul>
<!--/.breadcrumb-->

<? include('inc/sub_nav_cat.php'); ?>

<h1>Отзывы о товарах</h1>

<div class="row-fluid">

    <div class="span6">

            <button class="btn btn-tiny" title="Утвердить выбранные отзывы"><span class="text-success"><i class="icon-ok"></i> Утвердить</span></button>
            <!-- button preloading  state -->
            <!--<button class="btn btn-tiny disabled" title="Утвердить выбранные отзывы"><i class="ot-preloader-micro"></i> Утвердить</button>-->

            <button class="btn btn-tiny ot_show_deletion_dialog_modal" title="Удалить выбранные отзывы"><span class="text-error"><i class="icon-remove"></i> Удалить</span></button>

    </div>

    <div class="span6 text-right">

        <select class="input-mini">
            <option value="10" selected="selected">10</option>
            <option value="25">25</option>
            <option value="50">50</option>
            <option value="100">100</option>
            <option value="all">Все</option>
        </select>

    </div>

</div>


<table class="table table-bordered">

    <thead>
        <tr>
            <th>
                <label class="checkbox inline">
                    <input type="checkbox">
                </label>
            </th>
            <th>Отзыв</th>
            <th>Пользователь</th>
            <th>Создан</th>
            <th class="td-3btn-width">Действия</th>
        </tr>
    </thead>

    <tbody>

        <tr>
            <td><input type="checkbox"/></td>
            <td>Хорошая книга, полезна для любого читателя! Очень содержательная книга в ней вы сможете найти много разнообразного, полезного материала, много различной информации.Мне, как начинающему художнику книга Иоханнеса Иттена очень понравилась, помогла понять что такое цветовая гармония, цветовое конструирование, и многое другое.... Хотелось бы отметить разнообразные иллюстрации и в целом оформление книги. Замечательная книга. Рекомендую.)</td>
            <td><a href="users/customers/user-profile">Shaquille O'Neal</a></td>
            <td>24.06.2013, <span class="muted">21:53</span></td>
            <td>
                <span class="btn-group">
                    <button class="btn btn-mini" title="Перейти к отзыву"><i class="icon-external-link"></i></button>
                    <button class="btn btn-mini disabled" title="Утвердить отзыв"><i class="ot-preloader-micro"></i></button>
                    <button class="btn btn-mini ot_show_deletion_dialog_modal" title="Удалить отзыв"><i class="icon-remove"></i></button>
                </span>
            </td>
        </tr>

        <tr class="selected_item">
            <td><input type="checkbox" checked="checked"/></td>
            <td>Эта книга должна быть у каждого творческого человека. Книга "Искусство цвета" Иттена обязательна для прочтения всем, кто хочет научиться понимать и владеть гармонией цвета.Издание не разочаровало - необычный формат книги, отличная бумага и качество печати.</td>
            <td><a href="users/customers/user-profile">Robin Williams</a></td>
            <td>25.06.2013, <span class="muted">17:23</span></td>
            <td>
                <span class="btn-group">
                    <button class="btn btn-mini" title="Перейти к отзыву"><i class="icon-external-link"></i></button>
                    <button class="btn btn-mini" title="Утвердить отзыв"><i class="icon-ok"></i></button>
                    <button class="btn btn-mini ot_show_deletion_dialog_modal" title="Удалить отзыв"><i class="icon-remove"></i></button>
                </span>
            </td>
        </tr>

    </tbody>

</table>


<? include('inc/pager.php'); ?>