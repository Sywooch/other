
<ul class="breadcrumb">
    <li><a href="."><i class="icon-home"></i></a> <span class="divider">›</span></li>
    <li><a href="cat/categories">Каталог</a> <span class="divider">›</span></li>
    <li><a href="cat/warehouse/categories">Товары на складе</a> <span class="divider">›</span></li>
    <li class="active">Товары</li>
</ul>
<!--/.breadcrumb-->

<? include('inc/sub_nav_cat.php'); ?>

<div class="ot_sub_sub_nav">
    <ul class="nav nav-pills">
        <li><a href="cat/warehouse/categories">Категории</a></li>
        <li class="active"><a href="cat/warehouse/goods">Товары</a></li>
    </ul>
</div>


<h1>
    Товары
    <a href="cat/warehouse/goods/crud" autocomplete="off" class="btn btn-tiny btn-primary btn_preloader weight-normal offset-left3" title="Добавить товар" data-loading-text="Добавить">Добавить</a>
</h1>


<!-- filters-->
<div class="row-fluid">

    <div class="span7">

        <div class="well well-small offset-bottom3">

            <form class="form-horizontal ot_form">

                <div class="control-group">
                    <label class="control-label bold">Категория <i class="icon-question-sign ot_inline_help" data-toggle="popover" data-placement="top" data-content="Введите название категории или выберите из ее из каталога"></i></label>
                    <div class="controls">
                        <input type="text" placeholder="Введите название">
                        <span type="button" data-toggle="button" class="btn" title="Выбрать в дереве категорий"><i class="icon-list-alt font-14"></i></span>
                    </div>
                </div>

                <div class="control-group">
                    <label class="control-label bold">Товар <i class="icon-question-sign ot_inline_help" data-toggle="popover" data-placement="top" data-content="Введите ссылку на товар на сайте"></i></label>
                    <div class="controls">
                        <input type="text" class="" placeholder="Введите ссылку на товар">
                    </div>
                </div>

                <div class="controls">
                    <button type="button" class="btn btn-tiny btn_preloader" data-loading-text="Применить фильтр" autocomplete="off">Применить фильтр</button>
                </div>

            </form>

        </div>

    </div>

</div><!-- /filters-->


<div class="row-fluid">

    <div class="span6">

        <!-- button inactive state — when no item is selected -->
        <button class="btn btn-tiny disabled">Удалить</button>

        <!-- button active state — when any item is selected -->
        <!--<button class="btn btn-tiny ot_show_deletion_dialog_modal" title="Удалить выбранные товары"><span class="text-error">Удалить</span></button>-->

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
            <th>Изображение</th>
            <th>Название</th>
            <th>Стоимость, $</th>
            <th>Количество</th>
            <th>Действия</th>
        </tr>
    </thead>

    <tbody>

    <tr>
        <td><input type="checkbox"/></td>
        <td class="text-center" data-toggle="modal-gallery" data-target="#modal-gallery"><a href="img/pic/goods/goods1.jpg" class="thumbnail thumbnail-mini" title="Увеличить изображение" data-gallery="gallery"><img src="img/pic/goods/goods1.jpg" alt=""></a></td>
        <td><a href="#" title="Страница товара на сайте">Кофта 1</a></td>
        <td><span class="blink">234</span></td>
        <td><span class="blink">18</span></td>
        <td>
            <a href="cat/warehouse/goods/crud" class="btn btn-mini" title="Редактировать"><i class="icon-pencil"></i></a>
            <button class="btn btn-mini ot_show_deletion_dialog_modal" title="Удалить"><i class="icon-remove"></i></button>
        </td>
    </tr>

    <tr>
        <td><input type="checkbox" /></td>
        <td class="text-center" data-toggle="modal-gallery" data-target="#modal-gallery"><a href="img/pic/goods/goods2.jpg" class="thumbnail thumbnail-mini" title="Увеличить изображение" data-gallery="gallery"><img src="img/pic/goods/goods2.jpg" alt=""></a></td>
        <td><a href="#" title="Страница товара на сайте">Тип китайца passes* Beina красный пакет счастливый конверт [封★花开彼岸] счастливый конверт Запечатывание</a></td>
        <td><span class="blink">234</span></td>
        <td><span class="blink">18</span></td>
        <td>
            <a href="cat/warehouse/goods/crud" class="btn btn-mini" title="Редактировать"><i class="icon-pencil"></i></a>
            <button class="btn btn-mini ot_show_deletion_dialog_modal" title="Удалить"><i class="icon-remove"></i></button>
        </td>
    </tr>

    </tbody>

</table>


<? include('inc/pager.php'); ?>

<div id="modal-gallery" class="modal modal-gallery hide fade" tabindex="-1">

    <div class="modal-header">
        <button data-dismiss="modal" class="close" type="button">×</button>
        <h3 class="modal-title"></h3>
    </div>

    <div class="modal-body"><div class="modal-image"></div></div>

    <div class="modal-footer">

        <div class="row-fluid">

            <div class="span6 text-left">
                <div class="btn-group">
                    <button class="btn btn-primary modal-prev" title="Предыдущее"><i class="icon-arrow-left icon-white"></i></button>
                    <button class="btn btn-primary modal-next" title="Следующее"><i class="icon-arrow-right icon-white"></i></button>
                </div>
            </div>

            <div class="span6 text-right">
                <button href="#" class="btn" data-dismiss="modal">Закрыть</button>
            </div>

        </div>

    </div>

</div>