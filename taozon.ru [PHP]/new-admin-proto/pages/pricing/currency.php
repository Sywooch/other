
<ul class="breadcrumb">
    <li><a href="."><i class="icon-home"></i></a> <span class="divider">›</span></li>
    <li><a href="pricing/currency">Ценообразование</a> <span class="divider">›</span></li>
    <li class="active">Валюта</li>
</ul>
<!--/.breadcrumb-->

<? include('inc/sub_nav_pricing.php'); ?>


<h1>Валюта</h1>

<p>Валюта внутренних расчетов: <span class="label">USD</span></p>


<h2>Валюты витрины</h2>

<div class="well">

    <form class="form-horizontal ot_form" action="#">

        <fieldset>

            <div class="row-fluid offset-bottom1">

                <div class="span3">

                    <p><strong>Используемые валюты</strong> <i class="icon-question-sign ot_inline_help" data-toggle="popover" data-placement="top" data-content="Модуль мультиязычности позволяет создавать версии сайтов на нескольких языках." title="" data-original-title=""></i></p>

                    <ol class="unstyled ot_sortable_list ot_sortable">
                        <li><span class="badge"><i class="icon-move" title="Изменить порядок"></i> USD <i class="icon-remove" title="Удалить"></i></span></li>
                        <li><span class="badge badge-success"><i class="icon-move" title="Изменить порядок"></i> RUB <i class="icon-remove" title="Удалить"></i></span></li>
                        <li><span class="badge badge-success"><i class="icon-move" title="Изменить порядок"></i> CNY<i class="icon-remove" title="Удалить"></i></span></li>
                    </ol>
                </div>

                <div class="span3">
                    <p><strong>Добавить валюту</strong></p>
                    <div class="row-fluid">
                        <select class="input-large select_searched_list span9">
                            <option value="EUR">EUR</option>
                            <option value="JPY">JPY</option>
                            <option value="PHP">PHP</option>
                            <option value="UAH">UAH</option>
                            <option value="KZT">KZT</option>
                            <option value="AOA">AOA</option>
                            <option value="ILS">ILS</option>
                            <option value="MNT">MNT</option>
                            <option value="AMD">AMD</option>
                            <option value="BYR">BYR</option>
                            <option value="KGS">KGS</option>
                            <option value="AZN">AZN</option>
                            <option value="TST">TST</option>
                            <option value="PLN">PLN</option>
                            <option value="ZAR">ZAR</option>
                            <option value="GEL">GEL</option>
                            <option value="IDR">IDR</option>
                            <option value="MDL">MDL</option>
                        </select>

                        <button class="btn btn-small btn-primary offset-left1" title="Добавить дополнительную валюту"><i class="icon-plus"></i></button>
                    </div>
                </div>

            </div>

        </fieldset>

        <button type="submit" class="btn btn_preloader btn-primary" data-loading-text="Сохраняется" autocomplete="off">Сохранить</button>

    </form>

</div>


<h2>Курсы валют</h2>

<h3 class="offset-bottom1">
    <i class="icon-question-sign ot_inline_help" data-toggle="popover" data-placement="top" data-content="Подсказка про синхронизации"></i> Режим синхронизации:
    <span class="offset-left2"><a class="ot_currency_rate_sync" href="#" data-type="select" data-pk="2" data-url="/post" data-placement="top" title="Изменить режим синхронизации"></a></span>
</h3>

<div class="well">

    <h3 class="offset-top0">Курсы задаются вручную</h3>

    <p class="offset-bottom1"><i class="icon-plus color-blue"></i> <strong data-target=".ot_add_currency_rate" data-toggle="collapse" class="blink">Добавить курс</strong></p>

    <div class="ot_add_currency_rate collapse">
        <form class="form-inline" action="">

            <strong>1</strong>
            <select class="input-small">
                <option value="USD">USD</option>
                <option value="EUR">EUR</option>
                <option value="ZAR">ZAR</option>
                <option value="RUR">RUR</option>
            </select>
            =
            <input class="input-mini" type="text"/>
            <select class="input-small">
                <option value="RUR">RUR</option>
                <option value="EUR">EUR</option>
                <option value="USD">USD</option>
                <option value="ZAR">ZAR</option>
            </select>

            <button type="button" class="btn btn-primary btn_preloader" data-loading-text="Добавить">Добавить</button>
            <button type="button" class="btn" data-target=".ot_add_currency_rate" data-toggle="collapse">Отменить</button>

        </form>
    </div>

    <ul class="ot_currency_list">
        <li>1 USD = <a class="ot_inline_popup_text_editable" href="#" data-type="text" data-pk="1" data-url="/post" title="Редактировать курс">31,393100</a> RUB
            <button class="btn btn-mini ot_delete_rate ot_show_deletion_dialog_modal" title="Удалить курс валюты"><i class="icon-remove"></i></button>
        </li>
        <li>1 EUR = <a class="ot_inline_popup_text_editable" href="#" data-type="text" data-pk="1" data-url="/post"title="Редактировать курс">40.374700</a> RUB
            <button class="btn btn-mini ot_delete_rate ot_show_deletion_dialog_modal" title="Удалить курс валюты"><i class="icon-remove"></i></button>
        </li>
        <li>1 ZAR = <a class="ot_inline_popup_text_editable" href="#" data-type="text" data-pk="1" data-url="/post"title="Редактировать курс">3.332710</a> RUB
            <button class="btn btn-mini ot_delete_rate ot_show_deletion_dialog_modal" title="Удалить курс валюты"><i class="icon-remove"></i></button>
        </li>
    </ul>

</div>


<div class="well">

    <h3 class="offset-top0">Курсы синхронизируются с ЦБ РФ / Google</h3>

    <form class="form-horizontal ot_form offset-bottom3" action="">
        <div class="control-group">
            <label class="control-label" for="ot_CB_currency_extra">Наценка на курс <i class="icon-question-sign ot_inline_help" data-toggle="popover" data-placement="top" data-content="Подсказка про наценку"></i></label>
            <div class="controls">
                <div class="input-append">
                    <input id="ot_CB_currency_extra" name="textinput" placeholder="0" class="input-mini" type="text">
                    <span class="add-on">%</span>
                </div>
                <button type="button" class="btn btn-primary btn_preloader" data-loading-text="Сохранить">Сохранить</button>
            </div>
        </div>
    </form>

    <h4>Курсы валют ЦБ на 21.05.2013 <span class="text-warning">/</span> с наценкой</h4>
    <ul>
        <li>1 USD = 31,393100 <span class="text-warning">/</span> <strong>32.24911</strong> RUB</li>
        <li>1 EUR = 40.374700 <span class="text-warning">/</span> <strong>41.8949</strong> RUB</li>
        <li>1 ZAR = 3.332710 <span class="text-warning">/</span> <strong>4.111627</strong> RUB</li>
    </ul>

</div>

<div class="well">

    <h3 class="offset-top0">Курсы синхронизируются с Хабом</h3>

    <ul>
        <li>1 USD = 31,393100 RUB </li>
        <li>1 EUR = 40.374700 RUB </li>
        <li>1 ZAR = 3.332710 RUB </li>
    </ul>

</div>

