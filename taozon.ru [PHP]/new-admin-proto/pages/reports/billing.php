<ul class="breadcrumb">
    <li><a href="."><i class="icon-home"></i></a> <span class="divider">›</span></li>
    <li><a href="reports/service-stat">Отчеты</a> <span class="divider">›</span></li>
    <li class="active">Биллинг</li>
</ul>
<!--/.breadcrumb-->

<? include('inc/sub_nav_reports.php'); ?>

<h1>Биллинг</h1>

<h2>Счета к оплате</h2>

<table class="table table-bordered data_table_sorting">

    <thead>
    <tr>
        <th>Счет</th>
        <th>Сумма, $</th>
        <th>Сумма, руб.</th>
        <th>Дата с:</th>
        <th>Дата по:</th>
        <th>Описание счета</th>
        <th>Детализация</th>
        <th>Состояние</th>
    </tr>
    </thead>

    <tbody>

        <tr>
            <td><a href="http://billing.opentao.net/?bill_id=16005056">http://billing.opentao.net/?bill_id=16005056</a></td>
            <td>86.00</td>
            <td>2869.76</td>
            <td>01.08.2013</td>
            <td>31.08.2013</td>
            <td>Сервисный платеж за сентябрь</td>
            <td>
                <div class="btn-group">
                    <button data-toggle="dropdown" class="btn btn-mini dropdown-toggle" title="Действия"><i class="icon-cog"></i> <span class="caret"></span></button>
                    <ul class="dropdown-menu">
                        <li><a href="#" title="Откроется в отдельном окне"><i class="icon-file-alt"></i> Просмотреть</a></li>
                        <li><a href="#"><i class="icon-print"></i> Распечатать</a></li>
                        <li><a href="#"><i class="icon-upload-alt"></i> Экспортировать (.xls)</a></li>
                    </ul>
                </div>
            </td>
            <td><strong class="text-error">Не оплачен</strong></td>
        </tr>

        <tr>
            <td><a href="http://billing.opentao.net/?bill_id=16005056">http://billing.opentao.net/?bill_id=16005056</a></td>
            <td>86.00</td>
            <td>2869.76</td>
            <td>01.08.2013</td>
            <td>31.08.2013</td>
            <td>Сервисный платеж за август</td>
            <td>
                <div class="btn-group">
                    <button data-toggle="dropdown" class="btn btn-mini dropdown-toggle" title="Действия"><i class="icon-cog"></i> <span class="caret"></span></button>
                    <ul class="dropdown-menu">
                        <li><a href="#" title="Откроется в отдельном окне"><i class="icon-file-alt"></i> Просмотреть</a></li>
                        <li><a href="#"><i class="icon-print"></i> Распечатать</a></li>
                        <li><a href="#"><i class="icon-upload-alt"></i> Экспортировать (.xls)</a></li>
                    </ul>
                </div>
            </td>
            <td><strong class="text-error">Не оплачен</strong></td>
        </tr>

    </tbody>

</table>

<p class="offset-bottom1"><span class="blink" data-target=".ot_show_all_bills" data-toggle="collapse">Показать все</span></p>

<div class="ot_show_all_bills collapse">
    <table class="table table-bordered data_table_sorting">

        <thead>
            <tr>
                <th>Счет</th>
                <th>Сумма, $</th>
                <th>Сумма, руб.</th>
                <th>Дата с:</th>
                <th>Дата по:</th>
                <th>Описание счета</th>
                <th>Детализация</th>
                <th>Состояние</th>
            </tr>
        </thead>

        <tbody>

        <tr>
            <td><a href="http://billing.opentao.net/?bill_id=16005056">http://billing.opentao.net/?bill_id=16005056</a></td>
            <td>86.00</td>
            <td>2869.76</td>
            <td>01.08.2013</td>
            <td>31.08.2013</td>
            <td>Сервисный платеж за август</td>
            <td>
                <div class="btn-group">
                    <button data-toggle="dropdown" class="btn btn-mini dropdown-toggle" title="Действия"><i class="icon-cog"></i> <span class="caret"></span></button>
                    <ul class="dropdown-menu">
                        <li><a href="#" title="Откроется в отдельном окне"><i class="icon-file-alt"></i> Просмотреть</a></li>
                        <li><a href="#"><i class="icon-print"></i> Распечатать</a></li>
                        <li><a href="#"><i class="icon-upload-alt"></i> Экспортировать (.xls)</a></li>
                    </ul>
                </div>
            </td>
            <td><strong class="text-success">Оплачен</strong></td>
        </tr>

        <tr>
            <td><a href="http://billing.opentao.net/?bill_id=16005023">http://billing.opentao.net/?bill_id=16005023</a></td>
            <td>39.00</td>
            <td>1301.40</td>
            <td>01.09.2013</td>
            <td>30.11.2013</td>
            <td>Оплата хостинга</td>
            <td>—</td>
            <td><strong class="text-success">Оплачен</strong></td>
        </tr>

        </tbody>
    </table>
</div>



<h2>Тарификация</h2>

<div class="well inline-block offset-bottom0">
    <dl class="dl-horizontal dl-ot-horizontal dl-horizontal-large offset-vertical-none">
        <dt>Ваш тариф:</dt>
        <dd><span class="label weight-normal">Оборот</span></dd>
        <dt>Число вызовов сервисов:</dt>
        <dd>884117</dd>
        <dt>Оборот за текущий месяц:</dt>
        <dd>496.22 USD</dd>
        <dt>Сервисный платеж:</dt>
        <dd>284.1 USD</dd>
    </dl>
</div>

<h3>История изменения тарифа</h3>

<table class="table table-bordered data_table_sorting">

    <thead>
        <tr>
            <th>Период</th>
            <th>Тариф</th>
            <th>Кол-во вызовов</th>
            <th>Оборот</th>
            <th>Сервисный платеж</th>
            <th>Окончание действия тарифа</th>
        </tr>
    </thead>

    <tbody>

        <tr>
            <td>01.01.2013 — 16.04.2013</td>
            <td>Turnover. % 2.0000</td>
            <td>0</td>
            <td>496 $</td>
            <td>9.92 $</td>
            <td>—</td>
        </tr>

        <tr>
            <td>17.04.2013 — 01.07.2013</td>
            <td>Startup. % 0.000100</td>
            <td>516472</td>
            <td>—</td>
            <td>51.65 $</td>
            <td>17.06.2013</td>
        </tr>

    </tbody>

</table>

<h2 class="offset-top1">Хостинг</h2>

<div class="well inline-block">
    <dl class="dl-horizontal dl-ot-horizontal dl-horizontal-large offset-vertical-none">
        <dt>Название:</dt>
        <dd>Ответственный хостинг Опентао</dd>
        <dt>Дата установки сайта:</dt>
        <dd>25.07.2013</dd>
        <dt>Оплачено до:</dt>
        <dd>24.10.2013</dd>
    </dl>
</div>


