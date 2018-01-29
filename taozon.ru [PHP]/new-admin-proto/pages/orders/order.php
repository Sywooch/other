
<ul class="breadcrumb">
    <li><a href="."><i class="icon-home"></i></a> <span class="divider">›</span></li>
    <li><a href="orders/list">Заказы</a> <span class="divider">›</span></li>
    <li class="active">№ ORD-0000001356</li>
</ul>
<!--/.breadcrumb-->

<div class="ot_order_page">

    <div class="row-fluid">

        <h1 class="offset-vertical-none span6">№ ORD-0000001356</h1>

        <div class="span2">
            <div class="btn-group pull-right">
                <button data-toggle="dropdown" class="btn btn-small dropdown-toggle offset-top05"><i class="icon-cog"></i> Действия c заказом <span class="caret"></span></button>
                <ul class="dropdown-menu">
                    <li><a href="#" title="Экспортировать заказ"><i class="icon-share"></i> Экспортировать</a></li>
                    <li><a href="#" title="Восстановить заказ"><i class="icon-undo"></i> Восстановить</a></li>
                    <li><a href="#" title="Отменить заказ"><i class="icon-ban-circle"></i> Отменить</a></li>
                    <li><a href="#" title="Закрыть заказ"><i class="icon-check"></i> Закрыть</a></li>
                </ul>
            </div>
        </div>

        <div class="span4 offset-top05 ot_order_filtered_nav">

            <!-- filtered orders nav -->
            <div class="pull-left">
                <div class="btn-group">
                    <a href="orders/order" class="btn" title="К предыдущему отфильтрованному заказу"><i class="icon-circle-arrow-left font-14"></i></a>
                    <a href="orders/list" class="btn" title="К списку заказов"><i class="icon-list-ul font-14"></i></a>
                    <a href="orders/order" class="btn" title="К следующему отфильтрованному заказу"><i class="icon-circle-arrow-right font-14"></i></a>
                </div>
            </div>

            <!-- order search field -->
            <div class="pull-right">
                <div class="input-prepend input-append">
                    <span class="add-on">ORD-</span>
                    <input type="text" class="input-small" placeholder="Номер заказа" />
                    <button class="btn" type="button" title="Найти"><i class="icon-search"></i></button>
                </div>
            </div>

        </div><!-- /.span4 .ot_order_filtered_nav -->
    </div><!-- /.row-fluid -->


    <div class="row-fluid">

        <div class="span8">

            <div class="well ot_order_summary">
                <div class="row-fluid">

                    <div class="span6">
                        <h4 class="offset-top0">Заказ</h4>
                        <dl class="dl-horizontal dl-ot-horizontal dl-horizontal-large offset-vertical-none">
                            <dt>Статус</dt>
                            <dd><span class="label weight-normal">Оплачен</span></dd>
                            <dt>Дата создания</dt>
                            <dd>03.07.13 <span class="muted font-11">(5:41:12)</span></dd>
                            <dt>Стоимость</dt>
                            <dd>13.47 $</dd>
                            <dt>Оплачено / осталось</dt>
                            <dd>0 $ / 6.15 $</dd>
                        </dl>
                    </div>

                    <div class="span5 offset1">
                        <h4 class="offset-top0">Товары (15)</h4>
                        <dl class="dl-horizontal dl-horizontal-large dl-ot-horizontal offset-vertical-none">
                            <dt>Ожидает оплаты</dt>
                            <dd><span class="badge weight-normal">8</span></dd>
                            <dt>Подтверждение цены</dt>
                            <dd><span class="badge weight-normal">2</span></dd>
                            <dt>Заказан</dt>
                            <dd><span class="badge weight-normal">4</span></dd>
                            <dt>Отправлен</dt>
                            <dd><span class="badge weight-normal">1</span></dd>
                        </dl>
                    </div>


                </div><!-- /.row-fluid -->
            </div>

            <div class="tabbable">

                <ul class="nav nav-tabs">
                    <li class="active"><a href="#ot_order_info_tab" data-toggle="tab">Информация</a></li>
                    <li><a href="#ot_order_goods_tab" data-toggle="tab">Товары</a></li>
                    <li><a href="#ot_order_purchase_tab" data-toggle="tab">Закупка</a></li>
                    <li><a href="#ot_order_packages_tab" data-toggle="tab">Посылки</a></li>
                    <li><a href="#ot_order_history_tab" data-toggle="tab">История</a></li>
                </ul>

                <div class="tab-content">

                    <div class="tab-pane active" id="ot_order_info_tab">
                        <? include('pages/orders/order/order-info-tab.php'); ?>
                    </div><!-- /#ot_order_info_tab -->

                    <div class="tab-pane" id="ot_order_goods_tab">
                        <? include('pages/orders/order/order-goods-tab.php'); ?>
                    </div><!-- /#ot_order_goods_tab -->

                    <div class="tab-pane" id="ot_order_purchase_tab">
                        <? include('pages/orders/order/order-purchase-tab.php'); ?>
                    </div><!-- /#ot_order_purchase_tab -->

                    <div class="tab-pane" id="ot_order_packages_tab">
                        <? include('pages/orders/order/order-packages-tab.php'); ?>
                    </div><!-- /#ot_order_packages_tab -->

                    <div class="tab-pane" id="ot_order_history_tab">
                        <? include('pages/orders/order/order-history-tab.php'); ?>
                    </div><!-- /#ot_order_packages_tab -->

                </div>

            </div><!-- /.tabbable -->

        </div><!-- /.span8-->


        <div class="span4">

            <div class="well ot_order_sidebar">

                <div class="tabbable">

                    <ul class="nav nav-pills">

                        <li class="active"><a href="#ot_order_user_panel" data-toggle="tab"><em>Покупатель</em></a></li>

                        <li>
                            <a href="#ot_order_support_panel" data-toggle="tab">
                                <em>Переписка</em>
<!--                                (<span class="weight-normal">2</span> /
                                <span class="text-success weight-normal">1</span>)-->
                                <span class="badge">2</span>
                                <span class="badge badge-success">1</span>
                            </a>
                        </li>

                        <!--                        <li><a href="#ot_order_history_panel" data-toggle="tab">История</a></li>-->
                    </ul>

                    <div class="tab-content">

                        <div class="tab-pane active" id="ot_order_user_panel">
                            <? include('pages/orders/order/order-user-panel.php'); ?>
                        </div><!-- /#ot_order_user_panel -->

<!--                        <div class="tab-pane" id="ot_order_history_panel">
                            <?/* include('pages/orders/order/order-history-panel.php'); */?>
                        </div>-->
                        <!-- /#ot_order_history_panel -->

                        <div class="tab-pane" id="ot_order_support_panel">
                            <? include('pages/orders/order/order-support-panel.php'); ?>
                        </div><!-- /#ot_order_support_panel -->

                    </div><!-- /.tab-content-->

                </div><!-- /.tabbable-->

            </div><!-- /.well -->

        </div><!-- /.span4 -->

    </div><!-- /.row-fluid -->

</div><!-- /.ot_order_page -->


