
<div class="tabbable offset-bottom1">

    <ul class="nav nav-tabs">
        <li class="active"><a href="#ot_orders_filter_tab" data-toggle="tab">По заказам</a></li>
        <li><a href="#ot_goods_filter_tab" data-toggle="tab">По товарам</a></li>
    </ul>

    <!--
    TODO: system should remember the user choice last time to open it when it comes back
    -->

    <div class="tab-content">

        <div class="tab-pane active" id="ot_orders_filter_tab">
            <? include('pages/orders/orders-filters/filter-orders-results.php'); ?>
        </div><!-- /#orders-filter-tab -->

        <div class="tab-pane" id="ot_goods_filter_tab">
            <? include('pages/orders/orders-filters/filter-goods-results.php'); ?>
        </div><!-- /#goods-filter-tab -->


    </div><!-- /.tab-content-->

</div><!-- /.tabbable -->

