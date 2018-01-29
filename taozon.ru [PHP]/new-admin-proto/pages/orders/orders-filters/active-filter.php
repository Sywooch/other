
<!-- active filters -->
<div class="well ot_form_orders_filters_short">
    <form class="form ot_form" action="orders/filtered-list">

        <div class="row-fluid">
        <div class="span6">
            <div class="row-fluid">
                <div class="span2"><strong>Дата</strong></div>
                <div class="span10">
                    с
                    <div class="input-append">
                        <input id="date-start-display" class="input-small" type="text" data-date-format="dd.mm.yyyy" data-date="05.02.2013" value="04.01.2013">
                        <span class="btn add-on" id="date-start" ><i class="icon-calendar"></i></span>
                    </div>

                    по
                    <div class="input-append">
                        <input  id="date-end-display" class="input-small" type="text" data-date-format="dd.mm.yyyy" data-date="12.02.2013" value="04.01.2013">
                        <span class="btn add-on" id="date-end" ><i class="icon-calendar"></i></span>
                    </div>
                </div>
            </div>
            <div class="row-fluid">
                <div class="span2"><strong>Покупатель</strong></div>
                <div class="span10">
                    <input name="textinput" placeholder="Фамилия" class="input-medium" type="text" value="Ибрагимович">
                    <input name="textinput" placeholder="Телефон" class="input-medium" type="text" value="9103456987">
                </div>
            </div>
        </div>
        <div class="span6">
            <div class="row-fluid">
                <div class="span2"><strong>Заказы</strong></div>
                <div class="span10">
                    <label class="checkbox inline"><input type="checkbox" value="" checked>Ожидает оплаты</label>
                    <label class="checkbox inline"><input type="checkbox" value="" checked>Ожидает доплаты</label>
                    <label class="checkbox inline"><input type="checkbox" value="" checked>Дозаказан</label>
                </div>
            </div>
            <div class="row-fluid">
                <div class="span2"><strong>Товары</strong></div>
                <div class="span10">
                    <label class="checkbox inline">
                        <input type="checkbox" value="" checked>Ожидает оплаты</label>
                    <label class="checkbox inline">
                        <input type="checkbox" value="" checked>Ожидает доплаты</label>
                    <label class="checkbox inline">
                        <input type="checkbox" value="" checked>Дозаказан</label>
                </div>
            </div>
        </div>
    </div>

        <div class="row-fluid offset-top1">
            <button class="btn btn-primary btn_preloader pull-left" data-loading-text="Применить">Применить</button>
            <a href="orders/list" class="pull-right offset-top1 blink">Все параметры</a>
        </div>
    </form>
</div>
<!-- /active filters -->