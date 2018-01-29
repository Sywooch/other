
<ul class="breadcrumb">
    <li><a href="."><i class="icon-home"></i></a> <span class="divider">›</span></li>
    <li><a href="config/build">Конфигурация</a> <span class="divider">›</span></li>
    <li><a href="config/lang/multi">Языки</a> <span class="divider">›</span></li>
    <li class="active">Переводы</li>
</ul>
<!--/.breadcrumb-->

<? include('inc/sub_nav_config.php'); ?>

<!-- ot-sub-sub-nav -->
<div class="tabbable ot_sub_sub_nav">
    <ul class="nav nav-pills">
        <li><a href="config/lang/multi">Мультиязычность</a></li>
        <li class="active"><a href="config/lang/translate">Переводы</a></li>
    </ul>
</div><!-- /ot-sub-sub-nav -->

<div class="row-fluid">
    <h1 class="pull-left">Переводы</h1>
    <a href="config/lang/translate/crud" autocomplete="off" data-loading-text="Добавление" class="btn btn_preloader pull-right offset-top1" type="button" title="Добавить новый перевод"><i class="icon-plus"></i> Добавить перевод</a>
</div>


<div class="well offset-bottom2">

        <form class="form-inline offset-vertical-none">

            <input type="text" data-provide="typeahead" placeholder="Все переводы" class="input-large">

            <select class="span3">
                <option value="all_languages" selected="selected">Все языки</option>
                <option value="ru">Русский (Russian)</option>
                <option value="en">English (English)</option>
                <option value="mn">Монгол хэл (Mongolian)</option>
                <option value="cn">中国的 (Chinese)</option>
                <option value="es">Español (Spanish)</option>
                <option value="de">Deutsch (German)</option>
                <option value="pt">Português (Portuguese)</option>
                <option value="bg">Български (Bulgarian)</option>
                <option value="il">ברית (Hebrew)</option>
                <option value="am">հայերէն (Armenian)</option>
                <option value="saha">Саха тыла (Yakut)</option>
                <option value="pl">Jezyk polski, polszczyzna (Polish)</option>
                <option value="ge">ქართული ენა (Georgian)</option>
            </select>
            <select class="span3">
                <option value="all_translations">Все варианты</option>
                <option value="translated">Переведенные</option>
                <option value="">Непереведенные</option>
            </select>

            <button type="button" class="btn btn_preloader btn-primary" data-loading-text="Найти" autocomplete="off">Найти</button>

        </form>



    </div>


<div class="row-fluid sortable">

    <table class="table table-bordered bootstrap-datatable datatable" id="data_table">
        <thead>
        <tr>
            <th class="span4">Ключ</th>
            <th class="span4">Текст</th>
            <th class="span2">Язык</th>
            <th class="span2">Действия</th>
        </tr>
        </thead>

        <tbody>
        <tr>
            <td>about_us</td>
            <td>О нас</td>
            <td>
                <span class="label" title="Есть перевод">ru</span>
                <span class="label" title="Есть перевод">en</span>
                <span class="label label-warning" title="Перевод отсутствует">de</span>
            </td>
            <td>
                <a class="btn btn-mini" href="config/lang/translate/crud" title="Редактировать"><i class="icon-pencil"></i></a>
            </td>
        </tr>
        <tr>
            <td>about_vendor</td>
            <td>О продавце</td>
            <td>
                <span class="label" title="Есть перевод">ru</span>
                <span class="label" title="Есть перевод">en</span>
                <span class="label label-warning" title="Перевод отсутствует">de</span>
            </td>
            <td class="center">
                <a class="btn btn-mini" href="config/lang/translate/crud" title="Редактировать"><i class="icon-pencil"></i></a>
            </td>
        </tr>
        <tr>
            <td>accept_subscribe</td>
            <td>Подписаться</td>
            <td>
                <span class="label" title="Есть перевод">ru</span>
                <span class="label" title="Есть перевод">en</span>
                <span class="label" title="Есть перевод">de</span>
            </td>
            <td class="center">
                <a class="btn btn-mini" href="config/lang/translate/crud" title="Редактировать"><i class="icon-pencil"></i></a>
                <a class="btn btn-mini ot_show_deletion_dialog_modal" href="#" title="Удалить"><i class="icon-remove"></i></a>
            </td>
        </tr>
        </tbody>
    </table>

</div><!--/row-->