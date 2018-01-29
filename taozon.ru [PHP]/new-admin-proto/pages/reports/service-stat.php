<ul class="breadcrumb">
    <li><a href="."><i class="icon-home"></i></a> <span class="divider">›</span></li>
    <li><a href="reports/service-stat">Отчеты</a> <span class="divider">›</span></li>
    <li class="active">Сервисная статистика</li>
</ul>
<!--/.breadcrumb-->

<? include('inc/sub_nav_reports.php'); ?>

<h1>Сервисная статистика</h1>

<div class="well inline-block">
    <dl class="dl-horizontal dl-horizontal-large dl-ot-horizontal offset-vertical-none">
        <dt>Тариф:</dt>
        <dd>Call</dd>
        <dt>Лимит вызовов:</dt>
        <dd>—</dd>
        <dt>Процент оборота:</dt>
        <dd>0 %</dd>
        <dt>Стоимость 1 вызова в $:</dt>
        <dd>0</dd>
    </dl>
</div>

<table class="table table-bordered data_table_sorting">

    <thead>
        <tr>
            <th class="span8">Параметр статистики</th>
            <th>За день</th>
            <th>За месяц</th>
            <th>Итого</th>
        </tr>
    </thead>

    <tbody>
        <tr>
            <td>Количество обращений к сервисам (вызовы)</td>
            <td id="DailyCallCount">27</td>
            <td id="MonthlyCallCount">31 227</td>
            <td id="CallCount">2 477 265</td>
        </tr>
        <tr>
            <td>Общий объем переведенных текстов (в символах)</td>
            <td id="TotalLengthTranslatedTextsDailyCallCount">120 648</td>
            <td id="TotalLengthTranslatedTextsMonthlyCallCount">8 272 211</td>
            <td id="TotalLengthTranslatedTextsTotalCallCount">610 257 386</td>
        </tr>
        <tr>
            <td>Объем текстов, переведенных автоматическим внешним транслятором (в символах)</td>
            <td id="LengthExternalTranslatedTextsDailyCallCount">3 335</td>
            <td id="LengthExternalTranslatedTextsMonthlyCallCount">2 280 534</td>
            <td id="LengthExternalTranslatedTextsTotalCallCount">201 548 936</td>
        </tr>
        <tr>
            <td>Эффективность кэширования источника товаров (обращений к Таобао)</td>
            <td id="CachedDailyCallCount">99.99%</td>
            <td id="CachedMonthlyCallCount">99.99%</td>
            <td id="CachedTotalCallCount">99.89%</td>
        </tr>
    </tbody>
</table>
