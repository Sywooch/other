
<ul class="breadcrumb">
    <li><a href="."><i class="icon-home"></i></a> <span class="divider">›</span></li>
    <li><a href="cat/categories">Каталог</a> <span class="divider">›</span></li>
    <li class="active">Ограничения</li>
</ul>
<!--/.breadcrumb-->

<? include('inc/sub_nav_cat.php'); ?>

<div class="ot_sub_sub_nav">
    <ul class="nav nav-pills">
        <li><a href="cat/restrictions/goods">Товары</a></li>
        <li><a href="cat/restrictions/categories">Категории</a></li>
        <li><a href="cat/restrictions/sellers">Продавцы</a></li>
        <li><a href="cat/restrictions/searches">Поисковые строки</a></li>
        <li><a href="cat/restrictions/brands">Бренды</a></li>
    </ul>
</div>

<h1>Ограничения</h1>

<!--<p>
    <strong class="offset-right05">Добавить</strong>

    по <span class="ot-spoiler_ blink blink-iconed" data-toggle="collapse" data-target=".ot_add_restriction_from_link"><i class="icon-link"></i>ссылке</span>
</p>-->

<p><span class="ot-spoiler ot-spoiler-iconed blink" data-toggle="collapse" data-target=".ot_add_restriction_from_link"><i class="icon-caret-right"></i>Добавить</span></p>

<div class="ot_add_restriction_from_link collapse">

    <form class="form-inline well" action="">

        По ссылке <i class="icon-question-sign ot_inline_help" data-toggle="popover" data-placement="right" data-content="Добавление ограничения происходит по ссылке на товар на сайте"></i>

        <input class="input" type="text">

        <button type="button" class="btn btn-primary btn_preloader" data-loading-text="Добавить">Добавить</button>
        <button type="button" class="btn offset-left05" data-target=".ot_add_restriction_from_link" data-toggle="collapse" title="Отменить / Скрыть форму">Отменить</button>

    </form>

</div>