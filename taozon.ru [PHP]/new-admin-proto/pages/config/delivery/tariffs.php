
<ul class="breadcrumb">
    <li><a href="."><i class="icon-home"></i></a> <span class="divider">›</span></li>
    <li><a href="config/build">Конфигурация</a> <span class="divider">›</span></li>
    <li><a href="config/delivery/internal">Доставка</a> <span class="divider">›</span></li>
    <li class="active">Тарифы по странам</li>
</ul>
<!--/.breadcrumb-->

<? include('inc/sub_nav_config.php'); ?>

<!-- ot-sub-sub-nav -->
<div class="tabbable ot_sub_sub_nav">

    <ul class="nav nav-pills">
        <li><a href="config/delivery/internal">Внутренняя</a></li>
        <li><a href="config/delivery/kinds">Внешняя</a></li>
        <li class="active"><a href="config/delivery/tariffs">Тарифы по странам</a></li>
    </ul>

    <!--<ul class="nav nav-pills">
        <li><a href="config/delivery/internal"><i class="icon-suitcase"></i> <span>Внутренняя</span></a></li>
        <li><a href="config/delivery/kinds"><i class="icon-truck"></i> <span>Внешняя</span></a></li>
        <li class="active"><a href="config/delivery/tariffs"><i class="icon-list-ul"></i> <span>Тарифы по странам</span></a></li>
    </ul>-->

</div><!-- /ot-sub-sub-nav -->


<h1>Тарифы по странам</h1>

<form method="get" action="config/delivery/tariffs/crud" class="form-inline offset-top1 offset-bottom3">
    <select name="" id="" class="input-xxlarge">
        <option value="1">China Post Airmail. Сервис доставки посылок весом до 2 кг</option>
        <option value="2">Международная служба доставки China Post</option>
        <option value="3">Международная служба доставки EMS</option>
    </select>
    <a href="config/delivery/tariffs/crud" class="btn btn-primary" title="Добавить тариф">Добавить</a>
</form>


<div class="box corner-all">
    <div class="box-header corner-top">
        <div class="header-control">
            <a data-box="collapse"><i class="icon-caret-up"></i></a>
        </div>
        <span>China Post Airmail. Сервис доставки посылок весом до 2 кг</span>
    </div>

    <div class="box-body box-body-tabled">

        <table class="table table-bordered">
            <thead>
            <tr>
                <th class="span5">Страна доставки</th>
                <th class="span3">Начальная стоимость</th>
                <th class="span3">Стоимость шага</th>
                <th class="span1">Действия</th>
            </tr>
            </thead>

            <tbody>
            <tr>
                <td>Россия (RU)</td>
                <td>18 CNY </td>
                <td>15 CNY</td>
                <td>
                    <a class="btn btn-mini" href="config/delivery/tariffs/crud" title="Редактировать"><i class="icon-pencil"></i></a>
                    <a class="btn btn-mini ot_show_deletion_dialog_modal" href="#" title="Удалить"><i class="icon-remove"></i></a>
                </td>
            </tr>
            </tbody>
        </table>

    </div>
</div>

<div class="box corner-all">
    <div class="box-header corner-top">
        <div class="header-control">
            <a data-box="collapse"><i class="icon-caret-up"></i></a>
        </div>
        <span>Международная служба доставки China Post</span>
    </div>

    <div class="box-body box-body-tabled">

        <table class="table table-bordered">
            <thead>
            <tr>
                <th class="span5">Страна доставки</th>
                <th class="span3">Начальная стоимость</th>
                <th class="span3">Стоимость шага</th>
                <th class="span1">Действия</th>
            </tr>
            </thead>

            <tbody>
            <tr>
                <td>Россия (RU)</td>
                <td>18 CNY </td>
                <td>15 CNY</td>
                <td>
                    <a class="btn btn-mini" href="config/delivery/tariffs/crud" title="Редактировать"><i class="icon-pencil"></i></a>
                    <a class="btn btn-mini ot_show_deletion_dialog_modal" href="#" title="Удалить"><i class="icon-remove"></i></a>
                </td>
            </tr>
            <tr>
                <td>Польша (POL)</td>
                <td>18 CNY </td>
                <td>15 CNY</td>
                <td>
                    <a class="btn btn-mini" href="config/delivery/tariffs/crud" title="Редактировать"><i class="icon-pencil"></i></a>
                    <a class="btn btn-mini ot_show_deletion_dialog_modal" href="#" title="Удалить"><i class="icon-remove"></i></a>
                </td>
            </tr>
            <tr>
                <td>Беларусь (BY)</td>
                <td>18 CNY </td>
                <td>15 CNY</td>
                <td>
                    <a class="btn btn-mini" href="config/delivery/tariffs/crud" title="Редактировать"><i class="icon-pencil"></i></a>
                    <a class="btn btn-mini ot_show_deletion_dialog_modal" href="#" title="Удалить"><i class="icon-remove"></i></a>
                </td>
            </tr>
            </tbody>
        </table>

    </div>
</div>

<div class="box corner-all">
    <div class="box-header corner-top">
        <div class="header-control">
            <a data-box="collapse"><i class="icon-caret-up"></i></a>
        </div>
        <span>Международная служба доставки EMS</span>
    </div>

    <div class="box-body box-body-tabled">

        <table class="table table-bordered">
            <thead>
            <tr>
                <th class="span5">Страна доставки</th>
                <th class="span3">Начальная стоимость</th>
                <th class="span3">Стоимость шага</th>
                <th class="span1">Действия</th>
            </tr>
            </thead>

            <tbody>
            <tr>
                <td>Россия (RU)</td>
                <td>18 CNY </td>
                <td>15 CNY</td>
                <td>
                    <a class="btn btn-mini" href="config/delivery/tariffs/crud" title="Редактировать"><i class="icon-pencil"></i></a>
                    <a class="btn btn-mini ot_show_deletion_dialog_modal" href="#" title="Удалить"><i class="icon-remove"></i></a>
                </td>
            </tr>
            </tbody>
        </table>

    </div>
</div>