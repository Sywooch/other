
<ul class="breadcrumb">
    <li><a href="."><i class="icon-home"></i></a> <span class="divider">›</span></li>
    <li><a href="cat/categories">Каталог</a> <span class="divider">›</span></li>
    <li><a href="cat/restrictions/goods">Ограничения</a> <span class="divider">›</span></li>
    <li class="active">Бренды</li>
</ul>
<!--/.breadcrumb-->

<? include('inc/sub_nav_cat.php'); ?>

<div class="ot_sub_sub_nav">
    <ul class="nav nav-pills">
        <li><a href="cat/restrictions/goods">Товары</a></li>
        <li><a href="cat/restrictions/categories">Категории</a></li>
        <li><a href="cat/restrictions/sellers">Продавцы</a></li>
        <li><a href="cat/restrictions/searches">Поисковые запросы</a></li>
        <li class="active"><a href="cat/restrictions/brands">Бренды</a></li>
    </ul>
</div>

<h1>
    Бренды
    <span class="offset-left1"><span class="blink blink-iconed font-14 weight-normal" data-toggle="collapse" data-target=".ot_add_restriction_from_link"><i class="icon-plus"></i>Добавить</span></span>
</h1>


<div class="row-fluid">
    <div class="span7">


        <div class="ot_add_restriction_from_link collapse">

            <form class="form-inline well" action="">

                По ссылке <i class="icon-question-sign ot_inline_help" data-toggle="popover" data-placement="right" data-content="Добавление ограничения происходит по ссылке на бренд на сайте."></i>

                <input class="span6" type="text" placeholder="Вставьте ссылку на бренд">

                <button type="button" class="btn btn-primary btn_preloader" data-loading-text="Добавить">Добавить</button>
                <button type="button" class="btn offset-left05" data-target=".ot_add_restriction_from_link" data-toggle="collapse" title="Отменить / Скрыть форму">Отменить</button>

            </form>

        </div>


        <div class="row-fluid">

            <div class="span6">

                <!-- button inactive state — when no item is selected -->
                <button class="btn btn-tiny disabled">Удалить</button>

                <!-- button active state — when any item is selected -->
<!--                <button class="btn btn-tiny ot_show_deletion_dialog_modal" title="Удалить выбранные товары">Удалить</button>-->

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
                <th class="span12">Название</th>
                <th>ID</th>
            </tr>
            </thead>

            <tbody>

            <tr>
                <td><input type="checkbox"/></td>
                <td><a href="/search?search=&brand=ot:2" title="На страницу бренда">ARMANI</a></td>
                <td>ot:2</td>
            </tr>

            <tr>
                <td><input type="checkbox"/></td>
                <td><a href="/search?search=&brand=ot:5" title="На страницу бренда">Abibas</a></td>
                <td>ot:327</td>
            </tr>

            </tbody>

        </table>

    </div>
</div>


<? include('inc/pager.php'); ?>