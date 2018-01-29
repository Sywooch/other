
<!-- active filters -->
<div class="well">

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
                    <input name="textinput" placeholder="ID" class="input-medium" type="text" value="USR-00000384">
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
        <button class="pull-left btn disabled">Применить</button>
        <a href="orders/list" class="pull-right blink">Все параметры</a>
    </div>

</div>

<div class="tabbable offset-bottom1">

    <ul class="nav nav-tabs">
        <li class="active"><a href="#orders-filter-tab" data-toggle="tab">По заказам</a></li>
        <li><a href="#goods-filter-tab" data-toggle="tab">По товарам</a></li>
    </ul>

    <!--
    TODO: system should remember the user choice last time to open it when it comes back
    -->

    <div class="tab-content">

        <div class="tab-pane active" id="orders-filter-tab">
            <? include('pages/orders/orders-filters/filter-orders-results.php'); ?>
        </div><!-- /#orders-filter-tab -->

        <div class="tab-pane" id="goods-filter-tab">
            <? include('pages/orders/orders-filters/filter-goods-results.php'); ?>
        </div><!-- /#goods-filter-tab -->


    </div><!-- /.tab-content-->

</div><!-- /.tabbable -->

