
<!-- group operations -->
<div class="row-fluid">
    <div class="pull-left">
        <div class="btn-group">
            <button data-toggle="dropdown" class="btn btn-tiny btn-primary dropdown-toggle"><i class="icon-cog"></i> С выбранными <span class="caret"></span></button>
            <ul class="dropdown-menu">
                <li><a href="#" title="Экспортировать товары"><i class="icon-upload-alt"></i> Экспортировать</a></li>
                <li><a href="#" title="Распечатать этикетки для каждого товара"><i class="icon-print"></i> Распечатать этикетки</a></li>
                <li class="divider"></li>
                <li><a href="#" class="ot_show_deletion_dialog_modal" title="Удалить товары"><i class="icon-remove"></i> Удалить</a></li>
            </ul>
        </div>
        <div class="btn-group">
            <button data-toggle="dropdown" class="btn btn-tiny btn-primary dropdown-toggle"><i class="icon-star-empty"></i> Изменить статус <span class="caret"></span></button>
            <ul class="dropdown-menu dropdown-menu-large">
                <li><a href="#">Ожидает оплаты</a></li>
                <li><a href="#">Оплачен</a></li>
                <li><a href="#">Подтверждение цены</a></li>
                <li><a href="#">Заказн</a></li>
                <li><a href="#">Проверка качества</a></li>
                <li><a href="#">Получен на склад</a></li>
                <li><a href="#">Упаковка</a></li>
                <li><a href="#">Готов к отправке</a></li>
                <li><a href="#">Отправлен</a></li>
                <li><a href="#">Получен</a></li>
                <li><a href="#">Возвращен продавцу</a></li>
                <li><a href="#">Невозможно поставить</a></li>
                <li><a href="#">Отменен</a></li>
            </ul>
        </div>
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
<!-- /group operations -->



<!-- filter results -->
<table class="table table-not-hover">
    <thead>
    <tr>
        <th><!-- TODO: remove sorting from this column (datatables docs) -->
            <label class="checkbox inline">
                <input type="checkbox" id="inlineCheckbox1" value="option1">
            </label>
        </th>
        <th>Номер<br> товара</th>
        <th>Информация</th>
        <th>Статус<br> товара</th>
        <th>Сумма</th>
        <th>Покупатель/ <br><span class="font-11">Баланс</span></th>
        <th>Оператор</th>
        <th>Заказ</th>
        <th class="width-6">Действия</th><!-- TODO: remove sorting from this column (datatables docs) -->
    </tr>
    </thead>

    <tbody>

    <!-- order line -->
    <tr>
        <td><input type="checkbox"></td>
        <td><a href="#" title="Страница товара на сайте">№ 1356 - 1</a></td>
        <td>
            <div class="width-12">
                <span title="Отобразить полную информацию о товаре" class="blink text-clipped-general" data-toggle="collapse" data-target=".1356-10-more-info">Стойки 2013 Европ новая коллекция Главный костюм гуляет Xiu фасон унисекс приталенный Висит плечо росы шеи трехмерно для того чтобы вышить светотеневым ударам платье цвета цельное</span>
            </div>
        </td>
        <td>Ожидает оплаты</td>
        <td>6.31 $</td>
        <td><a href="users/customers/user-profile" title="Профиль пользователя">Лив Тайлер</a> <br>320 $</td>
        <td>Михаил Пришвин</td>
        <td><a href="orders/order" title="Страница заказа">ORD-0000001356</a></td>
        <td>
                <div class="btn-group pull-right">
                    <button data-toggle="dropdown" class="btn btn-mini dropdown-toggle" title="Изменить статус"><i class="icon-star-empty"></i> <span class="caret"></span></button>
                    <ul class="dropdown-menu dropdown-menu-large">
                        <li><a href="#">Ожидает оплаты</a></li>
                        <li><a href="#">Оплачен</a></li>
                        <li><a href="#">Подтверждение цены</a></li>
                        <li><a href="#">Заказн</a></li>
                        <li><a href="#">Проверка качества</a></li>
                        <li><a href="#">Получен на склад</a></li>
                        <li><a href="#">Упаковка</a></li>
                        <li><a href="#">Готов к отправке</a></li>
                        <li><a href="#">Отправлен</a></li>
                        <li><a href="#">Получен</a></li>
                        <li><a href="#">Возвращен продавцу</a></li>
                        <li><a href="#">Невозможно поставить</a></li>
                        <li><a href="#">Отменен</a></li>
                    </ul>
                </div>
                <div class="btn-group pull-right">
                    <button data-toggle="dropdown" class="btn btn-mini dropdown-toggle"><i class="icon-cog"></i> <span class="caret"></span></button>
                    <ul class="dropdown-menu">
                        <li><a href="#" title="Экспортировать товар"><i class="icon-upload-alt"></i> Экспортировать</a></li>
                        <li><a href="#" title="Распечатать этикетку для товара"><i class="icon-print"></i> Распечатать этикетку</a></li>
                        <li><a href="#" title="Разделить количество товара"><i class="icon-resize-full"></i> Разделить</a></li>
                        <li><a href="#" class="ot_show_deletion_dialog_modal" title="Удалить товар"><i class="icon-remove"></i> Удалить</a></li>
                        <!--                    <li><a href="#" title="Оставить комментарий к товару"><i class="icon-comment-alt"></i> Оставить комментарий</a></li>-->
                    </ul>
                </div>
        </td>

    </tr><!-- order line ends -->

    <!-- sliding goods list of ORD-0000001356 order -->
    <!--
    TODO:
    1) when ckick on more-info show preloader
    2) get goods description <tr> via ajax
    -->
    <tr class="no-top-border">
        <td colspan="9">
            <div class="collapse on 1356-10-more-info">
                <div class="well">
                    <div class="text-center"><div class="ot-preloader-small"></div></div>
                    <button type="button" class="close close-well" data-toggle="collapse" data-target=".1356-10-more-info" title="Скрыть">&times;</button>
                </div>
            </div><!-- /.collapse ORD-0000001356-goods -->
        </td><!-- colspan=9-->
    </tr><!-- /.no-top-border-->

        <!-- order line -->
        <tr class="selected_item">
            <td><input type="checkbox" checked="checked"></td>
            <td>
                <a href="#" title="Страница товара на сайте">№ 1356 - 1</a>
            </td>
            <td>
                <div class="width-12">
                    <span title="Отобразить полную информацию о товаре" class="blink text-clipped-general" data-toggle="collapse" data-target=".1356-1-more-info">Инкремент устанавливает пакет 25 венгерского MECSEK органически для посылки под чаем с молоком чая с молоком для того чтобы принудить, что чай с молоком увеличил грудь эффективно </span>
                </div>
            </td>
            <td>Ожидает оплаты</td>
            <td>6.31 $</td>
            <td><a href="users/customers/user-profile" title="Профиль пользователя">Фрэнки Эдгар</a> <br>320 $</td>
            <td>Михаил Пришвин</td>
            <td><a href="orders/order" title="Страница заказа">ORD-0000001356</a></td>
            <td>
                <div class="btn-group pull-right">
                    <button data-toggle="dropdown" class="btn btn-mini dropdown-toggle" title="Изменить статус"><i class="icon-star-empty"></i> <span class="caret"></span></button>
                    <ul class="dropdown-menu dropdown-menu-large">
                        <li><a href="#">Ожидает оплаты</a></li>
                        <li><a href="#">Оплачен</a></li>
                        <li><a href="#">Подтверждение цены</a></li>
                        <li><a href="#">Заказн</a></li>
                        <li><a href="#">Проверка качества</a></li>
                        <li><a href="#">Получен на склад</a></li>
                        <li><a href="#">Упаковка</a></li>
                        <li><a href="#">Готов к отправке</a></li>
                        <li><a href="#">Отправлен</a></li>
                        <li><a href="#">Получен</a></li>
                        <li><a href="#">Возвращен продавцу</a></li>
                        <li><a href="#">Невозможно поставить</a></li>
                        <li><a href="#">Отменен</a></li>
                    </ul>
                </div>
                <div class="btn-group pull-right">
                    <button data-toggle="dropdown" class="btn btn-mini dropdown-toggle"><i class="icon-cog"></i> <span class="caret"></span></button>
                    <ul class="dropdown-menu">
                        <li><a href="#" title="Экспортировать товар"><i class="icon-upload-alt"></i> Экспортировать</a></li>
                        <li><a href="#" title="Распечатать этикетку для товара"><i class="icon-print"></i> Распечатать этикетку</a></li>
                        <li><a href="#" title="Разделить количество товара"><i class="icon-resize-full"></i> Разделить</a></li>
                        <li><a href="#" class="ot_show_deletion_dialog_modal" title="Удалить товар"><i class="icon-remove"></i> Удалить</a></li>
<!--                        <li><a href="#" title="Оставить комментарий к товару"><i class="icon-comment-alt"></i> Оставить комментарий</a></li>-->
                    </ul>
                </div>
            </td>

        </tr><!-- order line ends -->

        <!-- sliding goods list of ORD-0000001356 order -->
        <!--
        TODO:
        1) when ckick on more-info show preloader
        2) get goods description <tr> via ajax
        -->
        <tr class="no-top-border selected_item">
            <td colspan="9">
                <div class="collapse on 1356-1-more-info">
                    <div class="well well-transp">
                        <div class="row-fluid">

                            <div class="span1">

                                <a href="#1356-6-img" class="thumbnail" data-toggle="lightbox" title="Увеличить изображение"><img src="img/pic/product-6.jpg" alt=""></a>
                                <div id="1356-6-img" class="lightbox hide fade"  tabindex="-1" role="dialog" aria-hidden="true">
                                    <div class="lightbox-header">
                                        <button type="button" class="close" data-dismiss="lightbox" aria-hidden="true"  title="Закрыть"><i class="icon-remove-sign"></i></button>
                                    </div>
                                    <div class="lightbox-content">
                                        <img src="img/pic/product-6.jpg">
                                        <div class="lightbox-caption"><p class="text-clipped-general">Инкремент устанавливает пакет 25 венгерского MECSEK органически для посылки под чаем с молоком чая с молоком для того чтобы принудить, что чай с молоком увеличил грудь эффективно</p></div>
                                    </div>
                                </div>

                            </div>

                            <div class="span4">
                                <dl class="dl-horizontal dl-ot-horizontal offset-vertical-none">
                                    <dt>Оригинал:</dt>
                                    <dd><a href="#" title="Страница товара на Таобао">16130137025</a></dd>
                                    <dt>Продавец:</dt>
                                    <dd><a href="#" title="Страница продавца на Таобао">cherubzhang</a></dd>
                                </dl>
                                <dl>
                                    <p><strong>Полное описание:</strong> Инкремент устанавливает пакет 25 венгерского MECSEK органически для посылки под чаем с молоком чая с молоком для того чтобы принудить, что чай с молоком увеличил грудь эффективно</p>
                                </dl>
                            </div>

                            <div class="span7">

                                <div class="row-fluid">

                                    <div class="span5">
                                        <dl class="dl-horizontal dl-ot-horizontal offset-vertical-none">
                                            <dt>Конфигурация:</dt>
                                            <dd>Цвет:1189 мандариновый</dd>
                                            <dd>Размер:35</dd>
                                            <dd>颜色分类:1189</dd>
                                            <dd>桔色 尺码:35</dd>
                                        </dl>
                                    </div>

                                    <div class="span5 offset2">
                                        <dl class="dl-horizontal dl-ot-horizontal offset-vertical-none">
                                            <dt>Вес:</dt>
                                            <dd>0.8 кг.</dd>
                                            <dt>Цена:</dt>
                                            <dd><a href="#" data-type="typeahead" data-pk="1" data-url="/post" data-placement="bottom" class="ot_change_product_price blink" title="Изменить цену товара">6.31</a> $</dd>
                                            <dt>Количество:</dt>
                                            <dd>1</dd>
                                            <dt>Сумма:</dt>
                                            <dd><span class="label weight-normal font-12">6.31 $</span></dd>
                                        </dl>
                                    </div>

                                </div>

                                <hr>

                                <p><i class="icon-comments-alt"></i> <strong>Комментарии</strong></p>

                                <div class="row-fluid">

                                    <div class="span6">
                                        <blockquote>
                                            <p class="font-13">Такой же, только с перламутровыми пуговицами, если можно.</p>
                                            <small>Покупатель</small>
                                        </blockquote>
                                    </div>

                                    <div class="span6">
                                        <blockquote>
                                            <p class="font-13">Такие есть только по 5 рублей уже, а не по 3 как указано <a href="#">на сайте</a>.</p>
                                            <small>Оператор</small>
                                        </blockquote>
                                    </div>

                                </div>

                            </div>



                        </div>

                        <button type="button" class="close close-well" data-toggle="collapse" data-target=".1356-1-more-info" title="Скрыть">&times;</button>
                    </div><!-- /.well-->

                </div><!-- /.collapse ORD-0000001356-goods -->
            </td><!-- colspan=10-->
        </tr><!-- /.no-top-border-->



        <!-- product line -->
        <tr>
            <td><input type="checkbox"></td>
            <td>
                <a href="#" title="Страница товара на сайте">№ 1356 - 2</a>
            </td>
            <td>
                <div class="width-12">
                    <span title="Отобразить полную информацию о товаре" class="blink text-clipped-general" data-toggle="collapse" data-target=".1356-2-more-info">2013 новая коллекция Престижность нации Tess США для отдыха Мало европейский покрой мужской корейская версия приталенный куртка Западн-тип одевает зерно с застежкой Прилив бесплатная доставка по китаю</span>
                </div>
            </td>
            <td>Ожидает оплаты</td>
            <td>34 $</td>
            <td><a href="users/customers/user-profile" title="Профиль пользователя">Виктор Гусев</a><br>320 $</td>
            <td>Василий Уткин</td>
            <td><a href="orders/order" title="Страница заказа">ORD-0000001356</a></td>
            <td>
                <div class="btn-group pull-right">
                    <button data-toggle="dropdown" class="btn btn-mini dropdown-toggle" title="Изменить статус"><i class="icon-star-empty"></i> <span class="caret"></span></button>
                    <ul class="dropdown-menu dropdown-menu-large">
                        <li><a href="#">Ожидает оплаты</a></li>
                        <li><a href="#">Оплачен</a></li>
                        <li><a href="#">Подтверждение цены</a></li>
                        <li><a href="#">Заказн</a></li>
                        <li><a href="#">Проверка качества</a></li>
                        <li><a href="#">Получен на склад</a></li>
                        <li><a href="#">Упаковка</a></li>
                        <li><a href="#">Готов к отправке</a></li>
                        <li><a href="#">Отправлен</a></li>
                        <li><a href="#">Получен</a></li>
                        <li><a href="#">Возвращен продавцу</a></li>
                        <li><a href="#">Невозможно поставить</a></li>
                        <li><a href="#">Отменен</a></li>
                    </ul>

                </div>
                <div class="btn-group pull-right">
                    <button data-toggle="dropdown" class="btn btn-mini dropdown-toggle"><i class="icon-cog"></i> <span class="caret"></span></button>
                    <ul class="dropdown-menu">
                        <li><a href="#" title="Экспортировать товар"><i class="icon-upload-alt"></i> Экспортировать</a></li>
                        <li><a href="#" title="Распечатать этикетку для товара"><i class="icon-print"></i> Распечатать этикетку</a></li>
                        <li><a href="#" title="Разделить количество товара"><i class="icon-resize-full"></i> Разделить</a></li>
                        <li><a href="#" class="ot_show_deletion_dialog_modal" title="Удалить товар"><i class="icon-remove"></i> Удалить</a></li>
<!--                        <li><a href="#" title="Оставить комментарий к товару"><i class="icon-comment-alt"></i> Оставить комментарий</a></li>-->
                    </ul>
                </div>
            </td>

        </tr><!-- product line ends -->

        <!-- sliding goods list of ORD-0000001356 order -->
        <!--
        TODO:
        1) when ckick on ORD-0000001357 show preloader
        2) get goods <tr> via ajax
        -->
        <tr class="no-top-border">
            <td colspan="9">
                <div class="collapse on 1356-2-more-info">
                    <div class="well">
                        <div class="row-fluid">

                            <div class="span1">

                                <a href="#1356-7-img" class="thumbnail" data-toggle="lightbox" title="Увеличить изображение"><img src="img/pic/product-7.jpg" alt=""></a>
                                <div id="1356-7-img" class="lightbox hide fade"  tabindex="-1" role="dialog" aria-hidden="true">
                                    <div class="lightbox-header">
                                        <button type="button" class="close" data-dismiss="lightbox" aria-hidden="true"  title="Закрыть"><i class="icon-remove-sign"></i></button>
                                    </div>
                                    <div class="lightbox-content">
                                        <img src="img/pic/product-7.jpg">
                                        <div class="lightbox-caption"><p class="text-clipped-general">2013 новая коллекция Престижность нации Tess США для отдыха Мало европейский покрой мужской корейская версия приталенный куртка Западн-тип одевает зерно с застежкой Прилив бесплатная доставка по китаю</p></div>
                                    </div>
                                </div>

                            </div>

                            <div class="span4">
                                <dl class="dl-horizontal dl-ot-horizontal offset-vertical-none">
                                    <dt>Оригинал:</dt>
                                    <dd><a href="#" title="Страница товара на Таобао">16130137025</a></dd>
                                    <dt>Продавец:</dt>
                                    <dd><a href="#" title="Страница продавца на Таобао">cherubzhang</a></dd>
                                </dl>

                                <p><strong>Полное описание:</strong> 2013 новая коллекция Престижность нации Tess США для отдыха Мало европейский покрой мужской корейская версия приталенный куртка Западн-тип одевает зерно с застежкой Прилив бесплатная доставка по китаю</p>
                            </div>

                            <div class="span7">

                                <div class="row-fluid">

                                    <div class="span5">
                                        <dl class="dl-horizontal dl-ot-horizontal offset-vertical-none">
                                            <dt>Конфигурация:</dt>
                                            <dd>Цвет:1189 мандариновый</dd>
                                            <dd>Размер:35</dd>
                                            <dd>颜色分类:1189</dd>
                                            <dd>桔色 尺码:35</dd>
                                        </dl>
                                    </div>

                                    <div class="span5 offset2">
                                        <dl class="dl-horizontal dl-ot-horizontal offset-vertical-none">
                                            <dt>Вес:</dt>
                                            <dd>0.8 кг.</dd>
                                            <dt>Цена:</dt>
                                            <dd><a href="#" data-type="typeahead" data-pk="1" data-url="/post" data-placement="bottom" class="ot_change_product_price blink" title="Изменить цену товара">17</a> $</dd>
                                            <dt>Количество:</dt>
                                            <dd>2</dd>
                                            <dt>Сумма:</dt>
                                            <dd><span class="label weight-normal font-12">34 $</span></dd>
                                        </dl>
                                    </div>

                                </div>

                                <hr>

                                <p><i class="icon-comments-alt"></i> <strong>Комментарии</strong></p>

                                <div class="row-fluid">

                                    <div class="span6">
                                        <blockquote>
                                            <p class="font-13">Знатный грамофон, а дадите скидку на него? ;)</p>
                                            <small>Покупатель</small>
                                        </blockquote>
                                    </div>
                                    <div class="span6">
                                        <blockquote>
                                            <p class="font-13">У нас и так самые дешевые цены, мы не даем скидок. Вот когда вы станете постоянным клиентом, мы, возможно, дадим вам карту золото-платинового пользователя, вот тогда и поговорим.</p>
                                            <small>Оператор</small>
                                        </blockquote>
                                    </div>

                                </div>
                            </div>

                            <button type="button" class="close close-well" data-toggle="collapse" data-target=".1356-2-more-info" title="Скрыть">&times;</button>
                        </div>
                    </div>
                </div><!-- /.collapse ORD-0000001356-goods -->
            </td><!-- colspan=9-->
        </tr><!-- /.no-top-border-->


    </tbody>
</table>
<!-- /filter results -->

<? include('inc/pager.php'); ?>
