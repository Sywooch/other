
<ul class="breadcrumb">
    <li><a href="."><i class="icon-home"></i></a> <span class="divider">›</span></li>
    <li><a href="content/pages">Содержание</a> <span class="divider">›</span></li>
    <li class="active">Новости</li>
</ul>
<!--/.breadcrumb-->

<? include('inc/sub_nav_content.php'); ?>


<div class="row-fluid">

    <div class="span6">

        <div class="row-fluid">

            <div class="span10">
                <h1>
                    Новости
                    <a href="content/news/crud" autocomplete="off" data-loading-text="Добавить" class="btn btn-tiny btn-primary btn_preloader weight-normal offset-left3" title="Добавить новость">Добавить</a>
                </h1>
            </div>

            <div class="span2 offset-top1">
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

        <div class="text-right">
            <select class="input-mini">
                <option value="10" selected="selected">10</option>
                <option value="25">25</option>
                <option value="50">50</option>
                <option value="100">100</option>
                <option value="all">Все</option>
            </select>
        </div>

        <table class="table table-bordered table-hover">
            <thead>
                <tr>
                    <th class="span9">Заголовок</th>
                    <th class="span2">Язык</th>
                    <th class="span1">Действия</th>
                </tr>
            </thead>

            <tbody>

                <tr>
                    <td><a href="#" title="Перейти к новости">Сезонные скидки на плащи из кожи</a></td>
                    <td>Русский</td>
                    <td>
                        <div class="btn-group pull-right">
                            <button data-toggle="dropdown" class="btn btn-mini dropdown-toggle"><i class="icon-cog"></i> <span class="caret"></span></button>
                            <ul class="dropdown-menu">
                                <li><a href="content/news/crud" title="Редактировать новость"><i class="icon-pencil"></i> Редактировать</a></li>
                                <li><a href="#" title="Удалить страницу" class="ot_show_deletion_dialog_modal"><i class="icon-remove"></i> Удалить</a></li>
                            </ul>
                        </div>
                    </td>
                </tr>

                <tr>
                    <td><a href="#" title="Перейти к новости">Коты в мешке за бесценок</a></td>
                    <td>Русский</td>
                    <td>
                        <div class="btn-group pull-right">
                            <button data-toggle="dropdown" class="btn btn-mini dropdown-toggle"><i class="icon-cog"></i> <span class="caret"></span></button>
                            <ul class="dropdown-menu">
                                <li><a href="content/news/crud" title="Редактировать новость"><i class="icon-pencil"></i> Редактировать</a></li>
                                <li><a href="#" title="Удалить страницу" class="ot_show_deletion_dialog_modal"><i class="icon-remove"></i> Удалить</a></li>
                            </ul>
                        </div>
                    </td>
                </tr>

            </tbody>
        </table>

    </div>
</div>

<? include('inc/pager.php'); ?>