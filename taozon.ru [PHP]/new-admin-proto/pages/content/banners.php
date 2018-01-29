
<ul class="breadcrumb">
    <li><a href="."><i class="icon-home"></i></a> <span class="divider">›</span></li>
    <li><a href="content/pages">Содержание</a> <span class="divider">›</span></li>
    <li class="active">Баннеры</li>
</ul>
<!--/.breadcrumb-->

<? include('inc/sub_nav_content.php'); ?>


<div class="row-fluid">

    <div class="span8">
        <h1>
            Баннеры
            <a href="content/banners/crud" autocomplete="off" data-loading-text="Добавить" class="btn btn-tiny btn-primary btn_preloader weight-normal offset-left1" title="Добавить баннер">Добавить</a>
            <button class="btn btn-tiny disabled btn_preloader" data-loading-text="<i class='icon-reorder'></i> Сохранить порядок" title="Сохранить порядок"><i class="icon-reorder"></i> Сохранить порядок</button>
        </h1>
    </div>

    <div class="span4 offset-top1">

        <!-- site language -->
        <div class="btn-group pull-right">
            <a class="btn dropdown-toggle offset-top05" data-toggle="dropdown" href="#" title="Выбрать языковую версию сайта для редактирования">
                Ru
                <span class="caret"></span>
            </a>
            <ul class="dropdown-menu">
                <li><a data-value="Eng" href="#">Eng</a></li>
                <li><a data-value="Ch" href="#">Ch</a></li>
            </ul>
        </div>
        <!-- /site language -->
    </div>

</div>


<ol class="unstyled ot_sortable ot_sortable_rows">

    <li>
        <article class="well">

            <aside class="sortable_handler"><i class="icon-move" title="Изменить порядок баннеров"></i></aside>

            <section class="row-fluid">
                <div class="span2">
                    <img class="img-polaroid" src="img/pic/banners/banner1.jpg">
                </div>
                <div class="span10">
                    <h4 class="offset-vertical-none"><a href="/" title="Ссылка на раздел">Распродажа виннипухов</a></h4>
                    <p>Язык: ru</p>
                    <a class="btn btn-tiny" href="content/banners/crud" title="Редактировать баннер"><i class="icon-pencil"></i></a>
                    <button class="btn btn-tiny ot_show_deletion_dialog_modal offset-left1" title="Удалить баннер"><i class="icon-remove"></i></button>
                </div>
            </section>

        </article>
    </li>

    <li>
        <article class="well">

            <aside class="sortable_handler"><i class="icon-move" title="Изменить порядок баннеров"></i></aside>

            <section class="row-fluid">
                <div class="span2">
                    <img class="img-polaroid" src="img/pic/banners/banner2.jpg">
                </div>
                <div class="span10">
                    <h4 class="offset-vertical-none"><a href="/" title="Ссылка на раздел">Разыгрываются путевки в Гималаи!</a></h4>
                    <p>Язык: ru</p>
                    <a class="btn btn-tiny" href="content/banners/crud" title="Редактировать баннер"><i class="icon-pencil"></i></a>
                    <button class="btn btn-tiny ot_show_deletion_dialog_modal offset-left1" title="Удалить баннер"><i class="icon-remove"></i></button>
                </div>
            </section>

        </article>
    </li>

    <li>
        <article class="well">

            <aside class="sortable_handler"><i class="icon-move" title="Изменить порядок баннеров"></i></aside>

            <section class="row-fluid">
                <div class="span2">
                    <img class="img-polaroid" src="img/pic/banners/banner3.jpg">
                </div>
                <div class="span10">
                    <h4 class="offset-vertical-none"><a href="/" title="Ссылка на раздел">Покупайте наши йогурты, а то нам не продать</a></h4>
                    <p>Язык: ru</p>
                    <a class="btn btn-tiny" href="content/banners/crud" title="Редактировать баннер"><i class="icon-pencil"></i></a>
                    <button class="btn btn-tiny ot_show_deletion_dialog_modal offset-left1" title="Удалить баннер"><i class="icon-remove"></i></button>
                </div>
            </section>

        </article>
    </li>

</ol>







