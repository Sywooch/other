<? include('inc/sub_nav_config.php'); ?>

<h1><a href="config/build" class="muted">Конфигурация</a> / <a href="config/orders/general" class="muted">заказы</a> / доставка</h1>

<!-- ot-sub-sub-nav -->
<div class="tabbable ot_sub_sub_nav">

    <ul class="nav nav-pills">
        <li><a href="config/orders/general"><i class="icon-sitemap"></i> <span>Общие</span></a></li>
        <li class="active"><a href="config/orders/shipment"><i class="icon-ambulance"></i> <span>Доставка (old)</span></a></li>
        <li><a href="config/orders/bank"><i class="icon-file-alt"></i> <span>Квитанция в банк</span></a></li>
    </ul>

</div>

<h2>Виды доставки</h2>

<div class="accordion" id="accordion2">
    <div class="accordion-group">
        <div class="accordion-heading corner-top">
            <div class="row-fluid">
                <div class="span6">
                    <a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion2" href="#collapseOne">
                        <span>China Post Airmail. Сервис доставки посылок весом до 2 кг</span>
                    </a>
                </div>
                <div class="span2">
                    <a class="btn btn-mini" href="config/orders/shipment/crud" title="Редактировать"><i class="icon-pencil"></i></a>
                    <a class="btn btn-mini" href="#" title="Удалить"><i class="icon-remove"></i></a>
                </div>
            </div>
        </div>
        <div id="collapseOne" class="accordion-body collapse in">
            <div class="accordion-inner">
                <h4 class="help-inline">Тарифы</h4>

                <!-- add new country tariff -->
                <p class="help-inline"> <i class="icon-question-sign ot_inline_help" data-toggle="popover" data-placement="right" data-content="Для уточнения данных относительно базовой доставки, вы можете добавить специальный тариф для отдельной страны."></i></p>


                <div class="row-fluid">

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
                                <a class="btn btn-mini" href="config/lang/translate/crud" title="Редактировать"><i class="icon-pencil"></i></a>
                                <a class="btn btn-mini" href="#" title="Удалить"><i class="icon-remove"></i></a>
                            </td>
                        </tr>
                        </tbody>
                    </table>

                <!-- add new country tariff -->
<!--                <a href="#" class="ot_show_delivery_tariff_modal" title="Добавить тариф"><i class="icon-plus-sign"></i> <span class="blink">Добавить тариф</span></a>-->
                <!-- add new country tariff -->
                <form method="get" action="" class="form-horizontal">
                    <button name="" class="btn btn-mini" title="Добавить тариф">Добавить тариф</button>
                </form>
            </div>
        </div>
    </div>
    <div class="accordion-group">
        <div class="accordion-heading corner-top">
            <div class="row-fluid">
                <div class="span6">
                    <a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion2" href="#collapseTwo">
                        <span>Международная служба доставки EMS</span>
                    </a>
                </div>
                <div class="span6">
                    <a class="btn btn-mini" href="config/orders/shipment/crud" title="Редактировать"><i class="icon-pencil"></i></a>
                    <a class="btn btn-mini" href="#" title="Удалить"><i class="icon-remove"></i></a>
                </div>
            </div>
        </div>
        <div id="collapseTwo" class="accordion-body collapse in">
            <div class="accordion-inner">

                <h4 class="help-inline">Тарифы</h4>

                <!-- add new country tariff -->
                <p class="help-inline"> <i class="icon-question-sign ot_inline_help" data-toggle="popover" data-placement="right" data-content="Для уточнения данных относительно базовой доставки, вы можете добавить специальный тариф для отдельной страны."></i></p>


                <div class="row-fluid">

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
                                <a class="btn btn-mini" href="config/lang/translate/crud" title="Редактировать"><i class="icon-pencil"></i></a>
                                <a class="btn btn-mini" href="#" title="Удалить"><i class="icon-remove"></i></a>
                            </td>
                        </tr>
                        </tbody>
                    </table>

                    <a href="#" class="ot_show_delivery_tariff_modal" title="Добавить тариф"><i class="icon-plus"></i> <span class="blink">Добавить тариф</span></a>


                </div><!--/row-->
            </div>
        </div>
    </div>
</div>

<!-- add new shipment type -->
<form method="post" action="config/orders/shipment/crud" class="form-horizontal">
    <button name="" class="btn btn-primary btn_preloader" title="Добавить новый вид доставки" data-loading-text="Загружается">Добавить доставку</button>
</form>


<!-- add/edit dlivery tariff modal window -->
<div class="modal hide fade ot_delivery_tariff_modal">
    <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">×</button>
        <h3>Добавить/Редактировать тариф</h3>
    </div>
    <div class="modal-body">


    <form method="post" action="config/orders/shipment/" class="form-horizontal ot_form">

        <div class="control-group control-group-medium">
            <label class="control-label">Страна <i class="icon-question-sign ot_inline_help" data-toggle="popover" data-placement="top" data-content="Модуль мультиязычности позволяет создавать версии сайтов на нескольких языках." title="" data-original-title="Локальная помощь"></i></label>
            <div class="controls">
                <select name="countrycode" class="input-medium select_searched_list">
                        <option value="AU"> Австралия (AU)</option>
                        <option value="AZ"> Азербайджан (AZ)</option>
                        <option value="AL"> Албания (AL)</option>
                        <option value="AO"> Ангола (AO)</option>
                        <option value="AR"> Аргентина (AR)</option>
                        <option value="AM"> Армения (AM)</option>
                        <option value="BY"> Беларусь (BY)</option>
                        <option value="BE"> Бельгия (BE)</option>
                        <option value="BG"> Болгария (BG)</option>
                        <option value="BW"> Ботсвана (BW)</option>
                        <option value="BR"> Бразилия (BR)</option>
                        <option value="BN"> Бруней (BN)</option>
                        <option value="GB"> Великобритания (GB)</option>
                        <option value="HU"> Венгрия (HU)</option>
                        <option value="VN"> Вьетнам (VN)</option>
                        <option value="DE"> Германия (DE)</option>
                        <option value="HK"> Гонконг (HK)</option>
                        <option value="GR"> Греция (GR)</option>
                        <option value="GE"> Грузия (GE)</option>
                        <option value="DK"> Дания (DK)</option>
                        <option value="IL"> Израиль (IL)</option>
                        <option value="IN"> Индия (IN)</option>
                        <option value="IE"> Ирландия (IE)</option>
                        <option value="ES"> Испания (ES)</option>
                        <option value="IT"> Италия (IT)</option>
                        <option value="KZ"> Казахстан (KZ)</option>
                        <option value="CA"> Канада (CA)</option>
                        <option value="KE"> Кения (KE)</option>
                        <option value="CY"> Кипр (CY)</option>
                        <option value="KG"> Киргизия (KG)</option>
                        <option value="LV"> Латвия (LV)</option>
                        <option value="LT"> Литва (LT)</option>
                        <option value="MZ"> Мозамбик (MZ)</option>
                        <option value="MD"> Молдова (MD)</option>
                        <option value="MN"> Монголия (MN)</option>
                        <option value="NA"> Намибия (NA)</option>
                        <option value="NG"> Нигерия (NG)</option>
                        <option value="NO"> Норвегия (NO)</option>
                        <option value="AE"> Объединенные Арабские Эмираты (AE)</option>
                        <option value="PL"> Польша (PL)</option>
                        <option value="PT"> Португалия (PT)</option>
                        <option selected="selected" value="RU"> Россия (RU)</option>
                        <option value="RO"> Румыния (RO)</option>
                        <option value="RS"> Сербия (RS)</option>
                        <option value="SK"> Словакия (SK)</option>
                        <option value="SI"> Словения (SI)</option>
                        <option value="US"> США (US)</option>
                        <option value="TJ"> Таджикистан (TJ)</option>
                        <option value="TH"> Таиланд (TH)</option>
                        <option value="TZ"> Танзания (TZ)</option>
                        <option value="TM"> Туркмения (TM)</option>
                        <option value="TR"> Турция (TR)</option>
                        <option value="UZ"> Узбекистан (UZ)</option>
                        <option value="UA"> Украина (UA)</option>
                        <option value="FI"> Финляндия (FI)</option>
                        <option value="FR"> Франция (FR)</option>
                        <option value="ME"> Черногория (ME)</option>
                        <option value="CZ"> Чехия (CZ)</option>
                        <option value="CH"> Швейцария (CH)</option>
                        <option value="SE"> Швеция (SE)</option>
                        <option value="EE"> Эстония (EE)</option>
                        <option value="ZA"> ЮАР (ZA)</option>
                        <option value="JP"> Япония (JP)</option>
                    </select>
            </div>
        </div>

        <div class="control-group control-group-medium">
            <label class="control-label">Начальная стоимость <i class="icon-question-sign ot_inline_help" data-toggle="popover" data-placement="top" data-content="Модуль мультиязычности позволяет создавать версии сайтов на нескольких языках." title="" data-original-title="Локальная помощь"></i></label>
            <div class="controls">
                <input id="textinput" name="textinput" class="input-mini" type="text">
            </div>
        </div>


        <div class="control-group control-group-medium">
            <label class="control-label">Стомость шага <i class="icon-question-sign ot_inline_help" data-toggle="popover" data-placement="top" data-content="Модуль мультиязычности позволяет создавать версии сайтов на нескольких языках." title="" data-original-title="Локальная помощь"></i></label>
            <div class="controls">
                <input id="textinput" name="textinput" class="input-mini" type="text">
            </div>
        </div>

        <div class="control-group control-group-medium">
            <div class="controls">
                <label class="checkbox inline">
                    <input name="checkboxes" value="Option one" type="checkbox">
                    Доступность
                </label> <i class="icon-question-sign ot_inline_help" data-toggle="popover" data-placement="bottom" data-content="Округление веса посылки до ближайшего целого в большую сторону."></i>
            </div>
        </div>

    </form>

    </div>
    <div class="modal-footer">
        <a href="#" class="btn btn-primary pull-left" data-dismiss="modal">Сохранить</a>
        <a href="#" class="btn pull-right" data-dismiss="modal">Отменить</a>
    </div>
</div>



<!--<div class="row-fluid">

    <table class="table">
        <thead>
        <tr>
            <th class="span6">Название</th>
            <th class="span6">Действие</th>
        </tr>
        </thead>

        <tbody>
        <tr>
            <td>China Post Airmail. Сервис доставки посылок весом до 2 кг.</td>
            <td>
                <a class="btn" href="config/orders/shipment/crud" title="Редактировать"><i class="icon-pencil"></i></a>
                <a class="btn" href="#" title="Удалить"><i class="icon-remove"></i></a>
            </td>
        </tr>
        <tr>
            <td>Международная служба доставки China Post</td>
            <td>
                <a class="btn" href="config/orders/shipment/crud" title="Редактировать"><i class="icon-pencil"></i></a>
                <a class="btn" href="#" title="Удалить"><i class="icon-remove"></i></a>
            </td>
        </tr>
        <tr>
            <td>Международная служба доставки EMS</td>
            <td>
                <a class="btn" href="config/orders/shipment/crud" title="Редактировать"><i class="icon-pencil"></i></a>
                <a class="btn" href="#" title="Удалить"><i class="icon-remove"></i></a>
            </td>
        </tr>
        </tbody>
    </table>

    <form>
        <button type="submit" class="btn btn_preloader btn-primary" data-loading-text="Добавляется" autocomplete="off" title="Добавить вид доставки">Добавить</button>
    </form>
</div>--><!--/row-->


<!--<dl class="dl-horizontal">
    <dt>• Польша (PL)</dt>
    <dd>
        <a class="ot_show_delivery_tariff_modal" href="config/orders/shipment/crud" title="Редактировать"><i class="icon-pencil"></i></a>
        <a class="ot_show_modal_dialog" href="#" title="Удалить"><i class="icon-remove-sign"></i></a>
    </dd>
    <dt>• Таджикистан (TJ)</dt>
    <dd>
        <a class="ot_show_delivery_tariff_modal" href="config/orders/shipment/crud" title="Редактировать"><i class="icon-pencil"></i></a>
        <a class="ot_show_modal_dialog" href="#" title="Удалить"><i class="icon-remove-sign"></i></a>
    </dd>
    <dt>• Россия (RU)</dt>
    <dd>
        <a class="ot_show_delivery_tariff_modal" href="config/orders/shipment/crud" title="Редактировать"><i class="icon-pencil"></i></a>
        <a class="ot_show_modal_dialog" href="#" title="Удалить"><i class="icon-remove-sign"></i></a>
    </dd>
</dl>
<ul>
    <li>Польша (PL)
        <a class="ot_show_delivery_tariff_modal" href="config/orders/shipment/crud" title="Редактировать"><i class="icon-pencil"></i></a>
        <a class="ot_show_modal_dialog" href="#" title="Удалить"><i class="icon-remove-sign"></i></a>
    </li>
    <li>Таджикистан (TJ)
        <a class="ot_show_delivery_tariff_modal" href="config/orders/shipment/crud" title="Редактировать"><i class="icon-pencil"></i></a>
        <a class="ot_show_modal_dialog" href="#" title="Удалить"><i class="icon-remove-sign"></i></a>
    </li>
    <li>Россия (RU)
        <a class="ot_show_delivery_tariff_modal" href="config/orders/shipment/crud" title="Редактировать"><i class="icon-pencil"></i></a>
        <a class="ot_show_modal_dialog" href="#" title="Удалить"><i class="icon-remove-sign"></i></a>
    </li>
</ul>
-->





