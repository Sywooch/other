
<ul class="breadcrumb">
    <li><a href="."><i class="icon-home"></i></a> <span class="divider">›</span></li>
    <li><a href="cat/categories">Каталог</a> <span class="divider">›</span></li>
    <li><a href="cat/restrictions/goods">Ограничения</a> <span class="divider">›</span></li>
    <li class="active">Продавцы</li>
</ul>
<!--/.breadcrumb-->

<? include('inc/sub_nav_cat.php'); ?>

<div class="ot_sub_sub_nav">
    <ul class="nav nav-pills">
        <li><a href="cat/restrictions/goods">Товары</a></li>
        <li><a href="cat/restrictions/categories">Категории</a></li>
        <li class="active"><a href="cat/restrictions/sellers">Продавцы</a></li>
        <li><a href="cat/restrictions/searches">Поисковые запросы</a></li>
        <li><a href="cat/restrictions/brands">Бренды</a></li>
    </ul>
</div>

<h1>
    Продавцы
    <span class="offset-left1"><span class="blink blink-iconed font-14 weight-normal" data-toggle="collapse" data-target=".ot_add_restriction_from_link"><i class="icon-plus"></i>Добавить</span></span>
</h1>


<div class="row-fluid">
    <div class="span7">


        <div class="ot_add_restriction_from_link collapse">
            <div class="well inset-bottom0">

                <form class="form-horizontal ot_form " action="">

                    <div class="control-group">
                        <label class="control-label">По имени или ссылке <i class="icon-question-sign ot_inline_help" data-toggle="popover" data-placement="right" data-content="Добавление ограничения происходит по имени продавца, которое можно найти на странице товара или по ссылке на страницу продавца на сайте."></i>
                        </label>
                        <div class="controls">
                            <input class="input-block-level" type="text" placeholder="Вставьте имя продавца или ссылку на его страницу">
                        </div>
                    </div>

                    <div class="control-group">
                        <div class="controls">
                            <button type="button" class="btn btn-primary btn_preloader" data-loading-text="Добавить">Добавить</button>
                            <button type="button" class="btn offset-left05" data-target=".ot_add_restriction_from_link" data-toggle="collapse" title="Отменить / Скрыть форму">Отменить</button>
                        </div>
                    </div>


                </form>

            </div>
        </div>



        <div class="row-fluid">

            <div class="span6">

                <!-- button inactive state — when no item is selected -->
                <button class="btn btn-tiny disabled">Удалить</button>

                <!-- button active state — when any item is selected -->
                <!--<button class="btn btn-tiny ot_show_deletion_dialog_modal" title="Удалить выбранные товары">Удалить</button>-->

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
                <th><input type="checkbox"></th>
                <th class="span8">Имя</th>
                <th class="span4">ID</th>
            </tr>
            </thead>

            <tbody>

            <tr>
                <td><input type="checkbox"/></td>
                <td><a href="/vendor?id=达利都服饰专营店" title="На страницу продавца">达利都服饰专营店</a></td>
                <td>达利都服饰专营店</td>
            </tr>

            <tr>
                <td><input type="checkbox" /></td>
                <td><a href="/vendor?id=达利都服饰专营店" title="На страницу продавца">达利都服饰专营店</a></td>
                <td>达利都服饰专营店</td>
            </tr>

            </tbody>

        </table>

    </div>
</div>

<? include('inc/pager.php'); ?>