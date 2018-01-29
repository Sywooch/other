
<ul class="breadcrumb">
    <li><a href="."><i class="icon-home"></i></a> <span class="divider">›</span></li>
    <li><a href="config/build">Конфигурация</a> <span class="divider">›</span></li>
    <li><a href="config/delivery/internal">Доставка</a> <span class="divider">›</span></li>
    <li><a href="config/delivery/tariffs">Тарифы по странам</a> <span class="divider">›</span></li>
    <li class="active">Добавление-редактирование тарифа</li>
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

</div><!-- /ot-sub-sub-nav -->


<h1>Добавление тарифа для доставки / Редактирование тарифа «China Post Airmail. Сервис доставки посылок весом до 2 кг»</h1>

<div class="well">

    <form method="post" action="config/delivery/tariffs" class="form-horizontal ot_form">

            <div class="control-group control-group-medium">
                <label class="control-label">Страна <i class="icon-question-sign ot_inline_help" data-toggle="popover" data-placement="top" data-content="Модуль мультиязычности позволяет создавать версии сайтов на нескольких языках." title="" data-original-title="Локальная помощь"></i></label>
                <div class="controls">
                    <select name="countrycode" class="input-large select_searched_list">
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
                    <div class="input-append">
                        <input id="textinput" name="textinput" class="input-mini" type="text" placeholder="18">
                        <span class="add-on">CNY</span>
                    </div>
                </div>
            </div>


            <div class="control-group control-group-medium">
                <label class="control-label">Стомость шага <i class="icon-question-sign ot_inline_help" data-toggle="popover" data-placement="top" data-content="Модуль мультиязычности позволяет создавать версии сайтов на нескольких языках." title="" data-original-title="Локальная помощь"></i></label>
                <div class="controls">
                    <div class="input-append">
                        <input id="textinput" name="textinput" class="input-mini" type="text" placeholder="15">
                        <span class="add-on">CNY</span>
                    </div>
                </div>
            </div>

            <div class="control-group control-group-medium">
                <div class="controls">
                    <label class="checkbox inline">
                        <input name="checkboxes" value="Option one" type="checkbox" checked="checked">
                        Доступность
                    </label> <i class="icon-question-sign ot_inline_help" data-toggle="popover" data-placement="top" data-content="Округление веса посылки до ближайшего целого в большую сторону."></i>
                </div>
            </div>

            <div class="control-group control-group-medium">
                <div class="controls">
                    <button id="save" name="save" class="btn btn-primary btn_preloader" data-loading-text="Сохраняется">Сохранить</button>
                    <button id="cancel" name="cancel" class="btn offset-left1 btn_preloader" data-loading-text="Отменяется">Отменить</button>
                </div>
            </div>

        </form>

</div>