<? include('inc/sub_nav_config.php'); ?>

<h1><a href="config/build" class="muted">Конфигурация</a> / <a href="config/orders/general" class="muted">заказы</a> / <a href="config/orders/shipment" class="muted">доставка</a> / China Post Airmail. Сервис доставки посылок весом до 2 кг</h1>

<!-- ot-sub-sub-nav -->
<div class="tabbable ot_sub_sub_nav">

    <ul class="nav nav-pills">
        <li><a href="config/orders/general"><i class="icon-sitemap"></i> <span>Общие</span></a></li>
        <li class="active"><a href="config/orders/shipment"><i class="icon-ambulance"></i> <span>Доставка (old)</span></a></li>
        <li><a href="config/orders/bank"><i class="icon-file-alt"></i> <span>Квитанция в банк</span></a></li>
    </ul>

</div>

<!-- global template configuration -->
<div class="box corner-all">
    <div class="box-header grd-orange color-white corner-top">
        <span>Редактирование/создание вида доставки</span>
    </div>

    <div class="box-body">

        <form method="post" action="config/orders/shipment/" class="form-horizontal ot_form">
            <fieldset>

                <div class="control-group control-group-medium">
                    <label class="control-label">Название <i class="icon-question-sign ot_inline_help" data-toggle="popover" data-placement="top" data-content="Модуль мультиязычности позволяет создавать версии сайтов на нескольких языках." title="" data-original-title="Локальная помощь"></i></label>
                    <div class="controls">
                        <input id="textinput" name="textinput" class="input-xlarge" type="text">
                    </div>
                </div>

                <div class="control-group control-group-medium">
                    <label class="control-label">Описание <i class="icon-question-sign ot_inline_help" data-toggle="popover" data-placement="top" data-content="Модуль мультиязычности позволяет создавать версии сайтов на нескольких языках." title="" data-original-title="Локальная помощь"></i></label>
                    <div class="controls">
                        <input id="textinput" name="textinput" class="input-xlarge" type="text">
                    </div>
                </div>

                <div class="control-group control-group-medium">
                    <label class="control-label">Валюта <i class="icon-question-sign ot_inline_help" data-toggle="popover" data-placement="top" data-content="Модуль мультиязычности позволяет создавать версии сайтов на нескольких языках." title="" data-original-title="Локальная помощь"></i></label>
                    <div class="controls">
                        <select id="selectbasic" name="selectbasic" class="input-small select_searched_list">
                            <option value="USD">USD</option>
                            <option value="RUB">RUB</option>
                            <option value="CNY">CNY</option>
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
                    </div>
                </div>

                <div class="control-group control-group-medium">
                    <label class="control-label">Порядок <i class="icon-question-sign ot_inline_help" data-toggle="popover" data-placement="top" data-content="Модуль мультиязычности позволяет создавать версии сайтов на нескольких языках." title="" data-original-title="Локальная помощь"></i></label>
                    <div class="controls">
                        <input id="textinput" name="textinput" class="input-mini" type="text">
                    </div>
                </div>

            </fieldset>
            <fieldset>

                <legend>Расчет стоимости</legend>
                <div class="row-fluid">
                    <div class="control-group control-group-medium span6">
                        <label class="control-label">Минимальный вес посылки <i class="icon-question-sign ot_inline_help" data-toggle="popover" data-placement="bottom" data-content="Если оставите пустым то автоматически приравнивается к 0, при условии что задан максимальный вес."></i></label>
                        <div class="controls">
                            <div class="input-append">
                                <input id="textinput" name="textinput" class="input-mini" type="text" placeholder="0">
                                <span class="add-on">кг</span>
                            </div>
                        </div>
                    </div>

                    <div class="control-group control-group-medium span6">
                        <label class="control-label">Максимальный вес посылки <i class="icon-question-sign ot_inline_help" data-toggle="popover" data-placement="bottom" data-content="Если оставите пустым то автоматически приравнивается к 999, при условии что задан минимальный вес. Если оба поля (мин. и макс. вес) оставите пустыми в итоговой формуле не будет ограничений по весу."></i></label>
                        <div class="controls">
                            <div class="input-append">
                                <input id="textinput" name="textinput" class="input-mini" type="text" placeholder="999">
                                <span class="add-on">кг</span>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="control-group control-group-medium">
                    <label class="control-label">Шаг по весу <i class="icon-question-sign ot_inline_help" data-toggle="popover" data-placement="bottom" data-content="Если оставите пустым то размер шага по весу учитываться не будет."></i></label>
                    <div class="controls">
                        <div class="input-append">
                            <input id="textinput" name="textinput" class="input-small" type="text" placeholder="Отсутствует">
                            <span class="add-on">кг</span>
                        </div>
                    </div>
                </div>

                <div class="control-group control-group-medium">
                    <div class="controls">
                        <label class="checkbox inline">
                            <input name="checkboxes" value="Option one" type="checkbox">
                            Учитывать минимальную стоимость доставки
                        </label>
                        <i class="icon-question-sign ot_inline_help" data-toggle="popover" data-placement="bottom" data-content="В валюте доставки"></i>
                    </div>
                </div>

                <div class="control-group control-group-medium">
                    <div class="controls">
                        <label class="checkbox inline">
                            <input name="checkboxes" value="Option one" type="checkbox">
                            Учитывать стоимость шага по весу
                        </label>
                        <i class="icon-question-sign ot_inline_help" data-toggle="popover" data-placement="bottom" data-content="В валюте доставки. Если не установить флажок стоимость не будет зависеть от веса товара, а будет фиксированной по параметру «Начальная стоимость»."></i>
                    </div>
                </div>

                <div class="control-group control-group-medium">
                    <div class="controls">
                        <label class="checkbox inline">
                            <input name="checkboxes" value="Option one" type="checkbox">
                            Округлять вес до большего целого
                        </label> <i class="icon-question-sign ot_inline_help" data-toggle="popover" data-placement="bottom" data-content="Округление веса посылки до ближайшего целого в большую сторону."></i>
                    </div>
                </div>

            </fieldset>

            <div class="control-group control-group-medium">
                <div class="controls">
                    <button id="save" name="save" class="btn btn-primary btn_preloader" data-loading-text="Сохраняется">Сохранить</button>
                    <button id="cancel" name="cancel" class="btn offset1 btn_preloader" data-loading-text="Отменяется">Отменить</button>
                </div>
            </div>


        </form>

    </div>
</div>




<!--<div class="control-group">
    <div class="controls">
        <a href="#" class="ot_show_delivery_tariff_modal" title="Добавить тариф"><i class="icon-plus"></i> <span class="blink">Добавить тариф</span></a> <i class="icon-question-sign ot_inline_help" data-toggle="popover" data-placement="top" data-content="Для уточнения данных относительно базовой доставки, добавьте специальный тариф для отдельной страны." title="" data-original-title="Тариф вида доставки"></i>
    </div>
</div>-->
