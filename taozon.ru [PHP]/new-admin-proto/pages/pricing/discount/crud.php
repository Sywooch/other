
<? include('inc/sub_nav_pricing.php'); ?>

<h1><a href="pricing/currency" class="muted">Ценообразование</a>  / <a href="pricing/discount" class="muted">скидки</a> / создание-редактирование скидки</h1>

<!-- global template configuration -->
<div class="box corner-all">
    <div class="box-header grd-orange color-white corner-top">
        <span>Редактирование/создание вида скидки</span>
    </div>

    <div class="box-body">

        <form method="post" action="pricing/discount" class="form-horizontal ot_form">
            <fieldset>

                <div class="control-group control-group-medium">
                    <label class="control-label">Название <i class="icon-question-sign ot_inline_help" data-toggle="popover" data-placement="top" data-content="Модуль мультиязычности позволяет создавать версии сайтов на нескольких языках." title="" data-original-title="Локальная помощь"></i></label>
                    <div class="controls">
                        <input id="textinput" name="textinput" class="input-xlarge" type="text" required="required">
                    </div>
                </div>

                <div class="control-group control-group-medium">
                    <label class="control-label">Описание <i class="icon-question-sign ot_inline_help" data-toggle="popover" data-placement="top" data-content="Модуль мультиязычности позволяет создавать версии сайтов на нескольких языках." title="" data-original-title="Локальная помощь"></i></label>
                    <div class="controls">
                        <input id="textinput" name="textinput" class="input-xlarge" type="text">
                    </div>
                </div>

                <div class="control-group control-group-medium">
                    <label class="control-label" for="ot_CB_currency_extra">Процент скидки  <i class="icon-question-sign ot_inline_help" data-toggle="popover" data-placement="top" data-content="Cкидка начисляется на общую сумму заказа"></i></label>
                    <div class="controls">
                        <div class="input-append">
                            <input id="ot_CB_currency_extra" name="textinput" placeholder="0" class="input-mini" type="text">
                            <span class="add-on">%</span>
                        </div>
                    </div>
                </div>


                <div class="control-group control-group-medium">
                    <label class="control-label">Общая сумма заказов <i class="icon-question-sign ot_inline_help" data-toggle="popover" data-placement="top" data-content="Модуль мультиязычности позволяет создавать версии сайтов на нескольких языках." title="" data-original-title="Локальная помощь"></i></label>
                    <div class="controls">
                        <input id="textinput" name="textinput" class="input-small" type="text">
                    </div>
                </div>

            </fieldset>


            <div class="control-group control-group-medium">
                <div class="controls">
                    <button type="submit" class="btn btn-primary btn_preloader" data-loading-text="Сохраняется">Сохранить</button>
                    <button type="button" class="btn offset1 btn_preloader" data-loading-text="Отменяется">Отменить</button>
                </div>
            </div>


        </form>

    </div>
</div>




