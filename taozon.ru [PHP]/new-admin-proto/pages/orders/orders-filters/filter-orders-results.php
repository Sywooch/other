
<div class="row-fluid">

    <div class="pull-left">
        <div class="btn-group">

            <!--<button class="btn btn-tiny btn-primary title="Экспортировать заказы"><i class="icon-upload-alt"></i> Экспортировать</button>
            <button class="btn btn-tiny btn-primary" title="Восстановить заказы"><i class="icon-undo"></i> Восстановить</button>
            <button class="btn btn-tiny btn-primary" title="Отменить заказы"><i class="icon-ban-circle"></i> Отменить</button>-->

            <button class="btn btn-tiny btn-primary" title="Экспортировать выбранные заказы"><i class="icon-upload-alt"></i> Экспортировать</button>
            <button data-toggle="dropdown" class="btn btn-tiny btn-primary dropdown-toggle" title="Остальные действия с выбранными"><span class="caret"></span></button>
            <ul class="dropdown-menu">
                <li><a href="#" title="Восстановить заказы"><i class="icon-undo"></i> Восстановить</a></li>
                <li><a href="#" title="Отменить заказы"><i class="icon-ban-circle"></i> Отменить</a></li>
            </ul>

        </div>

        <div class="btn-group">
            <button class="btn btn-tiny btn-primary disabled" title="Экспортировать выбранные заказы"><i class="icon-upload-alt"></i> Экспортировать</button>
            <button data-toggle="dropdown" class="btn btn-tiny btn-primary dropdown-toggle disabled" title="Остальные действия с выбранными"><span class="caret"></span></button>
        </div>
        <i class="ot-preloader-mini offset-left05"></i>

    </div>

    <div class="pull-right">
        <label>Показывать
            <select class="input-mini">
                <option value="10" selected="selected">10</option>
                <option value="25">25</option>
                <option value="50">50</option>
                <option value="100">100</option>
            </select>
        </label>
    </div>

</div>



<table class="table table-not-hover">
    <thead>
    <tr>
        <th><!-- TODO: remove sorting from this column (datatables docs) -->
            <label class="checkbox inline">
                <input type="checkbox" id="inlineCheckbox1" value="option1">
            </label>
        </th>
        <th>Номер<br> заказа</th>
        <th>Время<br> создания</th>
        <th>Статус<br> заказа</th>
        <th>Товары</th>
        <th>Сумма<br> <span class="font-11">(Оплачено)</span></th>
        <th>Покупатель/ <br><span class="font-11">Баланс</span></th>
        <th>Оператор</th>
        <th class="td-2btn-width">Действия</th><!-- TODO: remove sorting from this column (datatables docs) -->
    </tr>
    </thead>

    <tbody>

        <!-- order line -->
        <tr class="selected_item">
            <td><input type="checkbox" checked="checked"></td>
            <td>
                <a href="orders/order" title="Страница заказа">ORD-0000001356</a>
            </td>
            <td>03.07.13<br> <span class="muted font-11">(5:41:12)</span></td>
            <td>Ожидает доплаты</td>
            <td>
                <span title="Отобразить список товаров" class="blink" data-toggle="collapse" data-target=".ORD-0000001356-goods"> Оплачен:&nbsp;79, Заказан:&nbsp;4, В&nbsp;обработке&nbsp;на&nbsp;складе:&nbsp;80, Отменен:&nbsp;20</span>
            </td>
            <td>13.47 $ <br>(6.15 $)            </td>
            <td><a href="users/customers/user-profile" title="Профиль пользователя">Виктор Гусев</a> <br> 320 $</td>
            <td>Тугаринов Кирилл</td>
            <td>
                <div class="btn-group pull-right">
                    <button data-toggle="dropdown" class="btn btn-mini dropdown-toggle disabled"><i class="ot-preloader-micro"></i> <span class="caret"></span></button>
                    <ul class="dropdown-menu">
                        <li><a href="#" title="Экспортировать заказ"><i class="icon-upload-alt"></i> Экспортировать</a></li>
                        <li><a href="#" title="Восстановить заказ"><i class="icon-undo"></i> Восстановить</a></li>
                        <li><a href="#" title="Отменить заказ"><i class="icon-ban-circle"></i> Отменить</a></li>
                    </ul>
                </div>
            </td>

        </tr><!-- order line ends -->

        <!-- sliding goods list of ORD-0000001356 order -->
        <!--
            TODO:
            1) when ckick on ORD-0000001357 show preloader
            2) get goods <tr> via ajax
        -->
        <tr class="no-top-border selected_item">
            <td colspan="10">
                <div class="collapse on ORD-0000001356-goods">
                    <div class="well well-transp">
                        <div class="text-center"><div class="ot-preloader-small"></div></div>
                        <button type="button" class="close close-well" data-toggle="collapse" data-target=".ORD-0000001356-goods" title="Скрыть">&times;</button>
                    </div><!-- /.well -->
                </div><!-- /.collapse ORD-0000001356-goods -->
            </td><!-- colspan=10-->
        </tr><!-- /.no-top-border-->



    <tr>
        <td><input type="checkbox"></td>
        <td><a href="orders/order" title="Страница заказа" style="display: block; margin-bottom: 10px">ORD-0000001357</a>
</td>
        <td>03.07.13<br> <span class="muted font-11">(5:41:12)</span></td>
        <td>Ожидает доплаты</td>
        <td><span title="Отобразить список товаров" class="blink" data-toggle="collapse" data-target=".ORD-0000001357-goods">Оплачен:&nbsp;2, Заказан:&nbsp;6</td>
        <td>13.47 $ <br>(6.15 $)</td>
        <td><a href="users/customers/user-profile" title="Профиль пользователя">Френсис Коппола</a> <br> 7.78 $</td>
        <td>Тугаринов Кирилл</td>
        <td>
            <div class="btn-group pull-right">
                <button data-toggle="dropdown" class="btn btn-mini dropdown-toggle"><i class="icon-cog"></i> <span class="caret"></span></button>
                <ul class="dropdown-menu">
                    <li><a href="#" title="Экспортировать заказ"><i class="icon-upload-alt"></i> Экспортировать</a></li>
                    <li><a href="#" title="Восстановить заказ"><i class="icon-undo"></i> Восстановить</a></li>
                    <li><a href="#" title="Отменить заказ" class="ot_show_deletion_dialog_modal"><i class="icon-ban-circle"></i> Отменить</a></li>
                </ul>
            </div>
        </td>
    </tr>

    <!-- sliding goods list of ORD-0000001357 order -->
    <tr class="no-top-border">
        <td colspan="10">
            <div class="collapse ORD-0000001357-goods">
                <div class="well">
                    <div class="row-fluid">

                        <div class="span6">
                            <ul class="unstyled">
                                <li class="offset-bottom1">
                                    <div class="media">
                                        <a href="#1356-2-img" class="thumbnail thumbnail-micro pull-left" data-toggle="lightbox" title="Увеличить изображение"><img src="img/pic/product-7.jpg" alt=""></a>
                                        <div id="1356-2-img" class="lightbox hide fade"  tabindex="-1" role="dialog" aria-hidden="true">
                                            <div class="lightbox-header">
                                                <button type="button" class="close" data-dismiss="lightbox" aria-hidden="true"  title="Закрыть"><i class="icon-remove-sign"></i></button>
                                            </div>
                                            <div class="lightbox-content">
                                                <img src="img/pic/product-7.jpg">
                                                <div class="lightbox-caption"><p class="text-clipped-general">Инкремент устанавливает пакет 25 венгерского MECSEK органически для посылки под чаем с молоком чая с молоком для того чтобы принудить, что чай с молоком увеличил грудь эффективно</p></div>
                                            </div>
                                        </div>

                                        <div class="media-body">

                                            <a href="#" title="Страница товара на сайте">№ 1356 - 1</a>: 34 $, заказан

                                        </div>
                                    </div>
                                </li>
                                <li class="offset-bottom1">
                                    <div class="media">
                                        <a href="#1356-1-img" class="thumbnail thumbnail-micro pull-left" data-toggle="lightbox" title="Увеличить изображение"><img src="img/pic/product-1.jpg" alt=""></a>
                                        <div id="1356-1-img" class="lightbox hide fade"  tabindex="-1" role="dialog" aria-hidden="true">
                                            <div class="lightbox-header">
                                                <button type="button" class="close" data-dismiss="lightbox" aria-hidden="true"  title="Закрыть"><i class="icon-remove-sign"></i></button>
                                            </div>
                                            <div class="lightbox-content">
                                                <img src="img/pic/product-1.jpg">
                                                <div class="lightbox-caption"><p class="text-clipped-general">Инкремент устанавливает пакет 25 венгерского MECSEK органически для посылки под чаем с молоком чая с молоком для того чтобы принудить, что чай с молоком увеличил грудь эффективно</p></div>
                                            </div>
                                        </div>

                                        <div class="media-body">

                                            <a href="#" title="Страница товара на сайте">№ 1356 - 2</a>: 68 $, подтверждение цены

                                        </div>
                                    </div>
                                </li>
                                <li class="offset-bottom1">
                                    <div class="media">
                                        <a href="#1356-3-img" class="thumbnail thumbnail-micro pull-left" data-toggle="lightbox" title="Увеличить изображение"><img src="img/pic/product-3.jpg" alt=""></a>
                                        <div id="1356-3-img" class="lightbox hide fade" tabindex="-1" role="dialog" aria-hidden="true">
                                            <div class="lightbox-header">
                                                <button type="button" class="close" data-dismiss="lightbox" aria-hidden="true"  title="Закрыть"><i class="icon-remove-sign"></i></button>
                                            </div>
                                            <div class="lightbox-content">
                                                <img src="img/pic/product-3.jpg">
                                                <div class="lightbox-caption"><p class="text-clipped-general">Инкремент устанавливает пакет 25 венгерского MECSEK органически для посылки под чаем с молоком чая с молоком для того чтобы принудить, что чай с молоком увеличил грудь эффективно</p></div>
                                            </div>
                                        </div>

                                        <div class="media-body">

                                            <a href="#" title="Страница товара на сайте">№ 1356 - 3</a>: 68 $, подтверждение цены

                                        </div>
                                    </div>
                                </li>
                                <li class="offset-bottom1">
                                    <div class="media">
                                        <a href="#1356-4-img" class="thumbnail thumbnail-micro pull-left" data-toggle="lightbox" title="Увеличить изображение"><img src="img/pic/product-4.jpg" alt=""></a>
                                        <div id="1356-4-img" class="lightbox hide fade"  tabindex="-1" role="dialog" aria-hidden="true">
                                            <div class="lightbox-header">
                                                <button type="button" class="close" data-dismiss="lightbox" aria-hidden="true"  title="Закрыть"><i class="icon-remove-sign"></i></button>
                                            </div>
                                            <div class="lightbox-content">
                                                <img src="img/pic/product-4.jpg">
                                                <div class="lightbox-caption"><p class="text-clipped-general">Инкремент устанавливает пакет 25 венгерского MECSEK органически для посылки под чаем с молоком чая с молоком для того чтобы принудить, что чай с молоком увеличил грудь эффективно</p></div>
                                            </div>
                                        </div>

                                        <div class="media-body">

                                            <a href="#" title="Страница товара на сайте">№ 1356 - 4</a>: 34 $, заказан

                                        </div>
                                    </div>
                                </li>
                            </ul>
                        </div>

                        <div class="span6">
                            <ul class="unstyled">
                                <li class="offset-bottom1">
                                    <div class="media">
                                        <a href="#1356-3-img" class="thumbnail thumbnail-micro pull-left" data-toggle="lightbox" title="Увеличить изображение"><img src="img/pic/product-3.jpg" alt=""></a>
                                        <div id="1356-3-img" class="lightbox hide fade"  tabindex="-1" role="dialog" aria-hidden="true">
                                            <div class="lightbox-header">
                                                <button type="button" class="close" data-dismiss="lightbox" aria-hidden="true"  title="Закрыть"><i class="icon-remove-sign"></i></button>
                                            </div>
                                            <div class="lightbox-content">
                                                <img src="img/pic/product-3.jpg">
                                                <div class="lightbox-caption"><p class="text-clipped-general">Инкремент устанавливает пакет 25 венгерского MECSEK органически для посылки под чаем с молоком чая с молоком для того чтобы принудить, что чай с молоком увеличил грудь эффективно</p></div>
                                            </div>
                                        </div>

                                        <div class="media-body">

                                            <a href="#" title="Страница товара на сайте">№ 1356 - 3</a>: 68 $, подтверждение цены

                                        </div>
                                    </div>
                                </li>
                                <li class="offset-bottom1">
                                    <div class="media">
                                        <a href="#1356-4-img" class="thumbnail thumbnail-micro pull-left" data-toggle="lightbox" title="Увеличить изображение"><img src="img/pic/product-4.jpg" alt=""></a>
                                        <div id="1356-4-img" class="lightbox hide fade"  tabindex="-1" role="dialog" aria-hidden="true">
                                            <div class="lightbox-header">
                                                <button type="button" class="close" data-dismiss="lightbox" aria-hidden="true"  title="Закрыть"><i class="icon-remove-sign"></i></button>
                                            </div>
                                            <div class="lightbox-content">
                                                <img src="img/pic/product-4.jpg">
                                                <div class="lightbox-caption"><p class="text-clipped-general">Инкремент устанавливает пакет 25 венгерского MECSEK органически для посылки под чаем с молоком чая с молоком для того чтобы принудить, что чай с молоком увеличил грудь эффективно</p></div>
                                            </div>
                                        </div>

                                        <div class="media-body">

                                            <a href="#" title="Страница товара на сайте">№ 1356 - 4</a>: 34 $, заказан

                                        </div>
                                    </div>
                                </li>
                                <li class="offset-bottom1">
                                    <div class="media">
                                        <a href="#1356-2-img" class="thumbnail thumbnail-micro pull-left" data-toggle="lightbox" title="Увеличить изображение"><img src="img/pic/product-2.jpg" alt=""></a>
                                        <div id="1356-2-img" class="lightbox hide fade"  tabindex="-1" role="dialog" aria-hidden="true">
                                            <div class="lightbox-header">
                                                <button type="button" class="close" data-dismiss="lightbox" aria-hidden="true"  title="Закрыть"><i class="icon-remove-sign"></i></button>
                                            </div>
                                            <div class="lightbox-content">
                                                <img src="img/pic/product-2.jpg">
                                                <div class="lightbox-caption"><p class="text-clipped-general">Инкремент устанавливает пакет 25 венгерского MECSEK органически для посылки под чаем с молоком чая с молоком для того чтобы принудить, что чай с молоком увеличил грудь эффективно</p></div>
                                            </div>
                                        </div>

                                        <div class="media-body">

                                            <a href="#" title="Страница товара на сайте">№ 1356 - 1</a>: 34 $, заказан

                                        </div>
                                    </div>
                                </li>
                                <li class="offset-bottom1">
                                    <div class="media">
                                        <a href="#1356-1-img" class="thumbnail thumbnail-micro pull-left" data-toggle="lightbox" title="Увеличить изображение"><img src="img/pic/product-1.jpg" alt=""></a>
                                        <div id="1356-1-img" class="lightbox hide fade"  tabindex="-1" role="dialog" aria-hidden="true">
                                            <div class="lightbox-header">
                                                <button type="button" class="close" data-dismiss="lightbox" aria-hidden="true"  title="Закрыть"><i class="icon-remove-sign"></i></button>
                                            </div>
                                            <div class="lightbox-content">
                                                <img src="img/pic/product-1.jpg">
                                                <div class="lightbox-caption"><p class="text-clipped-general">Инкремент устанавливает пакет 25 венгерского MECSEK органически для посылки под чаем с молоком чая с молоком для того чтобы принудить, что чай с молоком увеличил грудь эффективно</p></div>
                                            </div>
                                        </div>

                                        <div class="media-body">

                                            <a href="#" title="Страница товара на сайте">№ 1356 - 2</a>: 68 $, подтверждение цены

                                        </div>
                                    </div>
                                </li>
                            </ul>

                            <button type="button" class="close close-well" data-toggle="collapse" data-target=".ORD-0000001357-goods" title="Скрыть">&times;</button>
                        </div>


                    </div><!-- /.row-fluid-->
                </div>
            </div>
        </td>
    </tr>


    </tbody>
</table>

<? include('inc/pager.php'); ?>