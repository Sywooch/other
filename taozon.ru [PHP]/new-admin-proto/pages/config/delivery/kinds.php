
<ul class="breadcrumb">
    <li><a href="."><i class="icon-home"></i></a> <span class="divider">›</span></li>
    <li><a href="config/build">Конфигурация</a> <span class="divider">›</span></li>
    <li><a href="config/delivery/internal">Доставка</a> <span class="divider">›</span></li>
    <li class="active">Внешняя</li>
</ul>
<!--/.breadcrumb-->

<? include('inc/sub_nav_config.php'); ?>

<!-- ot-sub-sub-nav -->
<div class="tabbable ot_sub_sub_nav">

    <ul class="nav nav-pills">
        <li><a href="config/delivery/internal">Внутренняя</a></li>
        <li class="active"><a href="config/delivery/kinds">Внешняя</a></li>
        <li><a href="config/delivery/tariffs">Тарифы по странам</a></li>
    </ul>

<!--    <ul class="nav nav-pills">
        <li><a href="config/delivery/internal"><i class="icon-suitcase"></i> <span>Внутренняя</span></a></li>
        <li class="active"><a href="config/delivery/kinds"><i class="icon-truck"></i> <span>Внешняя</span></a></li>
        <li><a href="config/delivery/tariffs"><i class="icon-list-ul"></i> <span>Тарифы по странам</span></a></li>
    </ul>-->

</div><!-- /ot-sub-sub-nav -->


<h1>Внешняя</h1>

<div class="row-fluid offset-bottom1">
    <div class="span7">
        <table class="table table-bordered">
        <thead>
        <tr>
            <th class="span6">Название</th>
            <th class="span1">Действия</th>
        </tr>
        </thead>

        <tbody>
        <tr>
            <td>China Post Airmail. Сервис доставки посылок весом до 2 кг</td>
            <td>
                <a class="btn btn-mini" href="config/delivery/kinds/crud" title="Редактировать"><i class="icon-pencil"></i></a>
                <a class="btn btn-mini ot_show_deletion_dialog_modal" href="#" title="Удалить"><i class="icon-remove"></i></a>
            </td>
        </tr>
        <tr>
            <td>Международная служба доставки China Post</td>
            <td>
                <a class="btn btn-mini" href="config/delivery/kinds/crud" title="Редактировать"><i class="icon-pencil"></i></a>
                <a class="btn btn-mini ot_show_deletion_dialog_modal" href="#" title="Удалить"><i class="icon-remove"></i></a>
            </td>
        </tr>
        <tr>
            <td>Международная служба доставки EMS</td>
            <td>
                <a class="btn btn-mini" href="config/delivery/kinds/crud" title="Редактировать"><i class="icon-pencil"></i></a>
                <a class="btn btn-mini ot_show_deletion_dialog_modal" href="#" title="Удалить"><i class="icon-remove"></i></a>
            </td>
        </tr>
        </tbody>
    </table>
    </div>
</div>

<!-- add new delivery kind -->
<form method="post" action="config/delivery/kinds/crud" class="form-horizontal">
    <button name="" class="btn btn-primary btn_preloader" title="Добавить новый вид доставки" data-loading-text="Загружается">Добавить</button>
</form>