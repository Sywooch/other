
<ul class="breadcrumb">
    <li><a href="."><i class="icon-home"></i></a> <span class="divider">›</span></li>
    <li><a href="config/build">Конфигурация</a> <span class="divider">›</span></li>
    <li><a href="config/delivery/internal">Доставка</a> <span class="divider">›</span></li>
    <li><a href="config/delivery/kinds">Внешняя</a> <span class="divider">›</span></li>
    <li class="active">Редактирование «China Post Airmail. Сервис доставки посылок весом до 2 кг»</li>
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

</div><!-- /ot-sub-sub-nav -->


<h1>Добавление вида доставки / Редактирование «China Post Airmail. Сервис доставки посылок весом до 2 кг»</h1>

<!-- global template configuration -->
<div class="well">

        <form method="post" action="config/delivery/kinds" class="form-horizontal ot_form">
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

                <div class="control-group control-group-medium">
                    <label class="control-label">Минимальный вес посылки <i class="icon-question-sign ot_inline_help" data-toggle="popover" data-placement="bottom" data-content="Если оставите пустым то автоматически приравнивается к 0, при условии что задан максимальный вес."></i></label>
                    <div class="controls">
                        <div class="input-append">
                            <input id="textinput" name="textinput" class="input-mini" type="text" placeholder="0">
                            <span class="add-on">кг</span>
                        </div>
                    </div>
                </div>

                <div class="control-group control-group-medium">
                    <label class="control-label">Максимальный вес посылки <i class="icon-question-sign ot_inline_help" data-toggle="popover" data-placement="bottom" data-content="Если оставите пустым то автоматически приравнивается к 999, при условии что задан минимальный вес. Если оба поля (мин. и макс. вес) оставите пустыми в итоговой формуле не будет ограничений по весу."></i></label>
                    <div class="controls">
                        <div class="input-append">
                            <input id="textinput" name="textinput" class="input-mini" type="text" placeholder="999">
                            <span class="add-on">кг</span>
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
                        <label class="checkbox">
                            <input name="checkboxes" value="Option one" type="checkbox">
                            Учитывать минимальную стоимость доставки
                            <i class="icon-question-sign ot_inline_help" data-toggle="popover" data-placement="top" data-content="В валюте доставки"></i>
                        </label>
                    </div>
                </div>

                <div class="control-group control-group-medium">
                    <div class="controls">
                        <label class="checkbox">
                            <input name="checkboxes" value="Option one" type="checkbox">
                            Учитывать стоимость шага по весу
                            <i class="icon-question-sign ot_inline_help" data-toggle="popover" data-placement="top" data-content="В валюте доставки. Если не установить флажок стоимость не будет зависеть от веса товара, а будет фиксированной по параметру «Начальная стоимость»."></i>
                        </label>
                    </div>
                </div>

                <div class="control-group control-group-medium">
                    <div class="controls">
                        <label class="checkbox">
                            <input name="checkboxes" value="Option one" type="checkbox">
                        Округлять вес до большего целого
                            <i class="icon-question-sign ot_inline_help" data-toggle="popover" data-placement="bottom" data-content="Округление веса посылки до ближайшего целого в большую сторону."></i>
                        </label>
                    </div>
                </div>

            </fieldset>

            <div class="control-group control-group-medium">
                <div class="controls">
                    <button id="save" name="save" class="btn btn-primary btn_preloader" data-loading-text="Сохраняется">Сохранить</button>
                    <button id="cancel" name="cancel" class="btn offset-left1 btn_preloader" data-loading-text="Отменяется">Отменить</button>
                </div>
            </div>

        </form>

</div>

