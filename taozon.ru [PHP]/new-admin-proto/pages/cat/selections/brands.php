
<ul class="breadcrumb">
    <li><a href="."><i class="icon-home"></i></a> <span class="divider">›</span></li>
    <li><a href="cat/categories">Каталог</a> <span class="divider">›</span></li>
    <li><a href="cat/selections/brands">Подборки</a> <span class="divider">›</span></li>
    <li class="active">Бренды</li>
</ul>
<!--/.breadcrumb-->

<? include('inc/sub_nav_cat.php'); ?>

<div class="ot_sub_sub_nav">
    <ul class="nav nav-pills">
        <li class="active"><a href="cat/selections/brands">Бренды</a></li>
        <li><a href="cat/selections/sellers">Продавцы</a></li>
        <li><a href="cat/selections/recommended">Рекомендуемые товары</a></li>
        <li><a href="cat/selections/popular">Популярные товары</a></li>
        <li><a href="cat/selections/last-viewed">Последние открытые товары</a></li>
    </ul>
</div>

<h1>Бренды</h1>


<div class="row-fluid offset-bottom1">

    <div class="span4">

        <strong class="offset-right05">Добавить</strong>

        <strong data-target=".ot_add_brand_from_list" data-toggle="collapse" class="blink blink-iconed"><i class="icon-list"></i>из списка</strong> или
        <span class="offset-left05"><strong data-target=".ot_add_brand_from_link" data-toggle="collapse" class="blink blink-iconed"><i class="icon-link"></i>по ссылке</strong></span>

    </div>

    <div class="span8">
        <button class="btn btn-tiny disabled" title="Сохранить порядок"><i class="icon-sort-by-attributes-alt icon-rotate-270"></i> Сохранить порядок</button>

        <button class="btn btn-tiny btn_preloader" data-loading-text="<i class='icon-sort-by-attributes-alt icon-rotate-270 font-14'></i> Сохраняется порядок" title="Сохранить порядок"><i class="icon-sort-by-attributes-alt icon-rotate-270 font-14"></i> Сохранить порядок</button>
    </div>

</div>


<div class="ot_add_brand_from_list collapse">

    <div class="well well-small">

        <div class="row-fluid">
            <div class="span3"><label class="checkbox selected_item"><input type="checkbox" checked="checked"><span class="thumbnail thumbnail-micro"><img src="img/pic/brands/adidas.jpg" alt="Adidas"></span> ARMANI</label></div>
            <div class="span3"><label class="checkbox"><input type="checkbox"><span class="thumbnail thumbnail-micro"><img src="img/pic/brands/gap.jpg" alt="Gap"></span> Bally</label></div>
            <div class="span3"><label class="checkbox"><span class="thumbnail thumbnail-micro"><img src="img/pic/brands/ecco.jpg" alt="Ecco"></span> <input type="checkbox">Chanel</label></div>
            <div class="span3"><label class="checkbox"><span class="thumbnail thumbnail-micro"><img src="img/pic/brands/benetton.jpg" alt="benetton"></span> <input type="checkbox">Chloe</label></div>
        </div>

        <div class="row-fluid">
            <div class="span3"><label class="checkbox"><input type="checkbox"><span class="thumbnail thumbnail-micro"><img src="img/pic/brands/benetton.jpg" alt="Cop Copine"></span> Cop Copine</label></div>
            <div class="span3"><label class="checkbox"><input type="checkbox"><span class="thumbnail thumbnail-micro"><img src="img/pic/brands/puma.jpg" alt="Lancel"></span> Lancel</label></div>
            <div class="span3"><label class="checkbox selected_item"><input type="checkbox" checked="checked"><span class="thumbnail thumbnail-micro"><img src="img/pic/brands/dunhill.jpg" alt="Mango"></span> Mango</label></div>
            <div class="span3"><label class="checkbox"><input type="checkbox"><span class="thumbnail thumbnail-micro"><img src="img/pic/brands/adidas.jpg" alt="Prada"></span> Prada</label></div>
        </div>

        <div class="row-fluid">
            <div class="span3"><label class="checkbox"><input type="checkbox"><span class="thumbnail thumbnail-micro"><img src="img/pic/brands/gap.jpg" alt="Reebok"></span> Reebok</label></div>
            <div class="span3"><label class="checkbox"><input type="checkbox"><span class="thumbnail thumbnail-micro"><span class="thumbnail-placeholder"><i class="icon-picture"></i></span></span> Zara</label></div>
        </div>

        <div class="offset-top1">
            <button class="btn btn-tiny btn-primary btn_preloader" autocomplete="off" data-loading-text="Добавить">Добавить</button>
            <button type="button" class="btn btn-tiny offset-left1" data-target=".ot_add_brand_from_list" data-toggle="collapse">Отменить</button>
        </div>

    </div><!-- /.well -->

</div><!-- /.ot_add_brand_from_list -->


<div class="ot_add_brand_from_link collapse">

    <form class="form-inline well" action="">

        По ссылке или id <i class="icon-question-sign ot_inline_help" data-toggle="popover" data-placement="right" data-content="Добавление бренда происходит по ссылке на бренд на сайте или по его идентификатору (ID)"></i>

        <input class="input" type="text">

        <button type="button" class="btn btn-primary btn_preloader" data-loading-text="Добавить">Добавить</button>
        <button type="button" class="btn offset-left05" data-target=".ot_add_brand_from_link" data-toggle="collapse" title="Отменить / Скрыть форму">Отменить</button>

    </form>

</div>


<ul class="thumbnails ot_sortable ot_sortable_cols">

    <li>
        <div class="thumbnail">
            <header>
                <span class="sortable_handler" title="Изменить порядок"><i class="icon-move"></i></span>
                <button class="btn btn-mini pull-right ot_show_deletion_dialog_modal" title="Удалить"><i class="icon-remove"></i></button>
            </header>
            <a href="#" title="На страницу бренда" class="img_preview"><img src="img/pic/brands/adidas.jpg" alt="Adidas"></a>
            <h3>Adidas</h3>
        </div>
    </li>

    <li>
        <div class="thumbnail">
            <header>
                <span class="sortable_handler" title="Изменить порядок"><i class="icon-move"></i></span>
                <button class="btn btn-mini pull-right ot_show_deletion_dialog_modal" title="Удалить"><i class="icon-remove"></i></button>
            </header>
            <a href="#" title="На страницу бренда" class="img_preview"><img src="img/pic/brands/gap.jpg" alt="Gap"></a>
            <h3>Gap</h3>
        </div>
    </li>

    <li>
        <div class="thumbnail">
            <header>
                <span class="sortable_handler" title="Изменить порядок"><i class="icon-move"></i></span>
                <button class="btn btn-mini pull-right ot_show_deletion_dialog_modal" title="Удалить"><i class="icon-remove"></i></button>
            </header>
            <a href="#" title="На страницу бренда" class="img_preview"><img src="img/pic/brands/ecco.jpg" alt="Ecco"></a>
            <h3>Ecco</h3>
        </div>
    </li>

    <li>
        <div class="thumbnail">
            <header>
                <span class="sortable_handler" title="Изменить порядок"><i class="icon-move"></i></span>
                <button class="btn btn-mini pull-right ot_show_deletion_dialog_modal" title="Удалить"><i class="icon-remove"></i></button>
            </header>
            <a href="#" title="На страницу бренда" class="img_preview"><img src="img/pic/brands/benetton.jpg" alt="Benetton"></a>
            <h3>Benetton</h3>
        </div>
    </li>

    <li>
        <div class="thumbnail">
            <header>
                <span class="sortable_handler" title="Изменить порядок"><i class="icon-move"></i></span>
                <button class="btn btn-mini pull-right ot_show_deletion_dialog_modal" title="Удалить"><i class="icon-remove"></i></button>
            </header>
            <a href="#" title="На страницу бренда" class="img_preview"><img src="img/pic/brands/dunhill.jpg" alt="Dunhill"></a>
            <h3>Dunhill</h3>
        </div>
    </li>

    <li>
        <div class="thumbnail">
            <header>
                <span class="sortable_handler" title="Изменить порядок"><i class="icon-move"></i></span>
                <button class="btn btn-mini pull-right ot_show_deletion_dialog_modal" title="Удалить"><i class="icon-remove"></i></button>
            </header>
            <a href="#" title="На страницу бренда" class="img_preview"><img src="img/pic/brands/puma.jpg" alt="Puma"></a>
            <h3>Puma</h3>
        </div>
    </li>

</ul>