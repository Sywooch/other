<div class="alert alert-success" style="color: #000; background: #F5F5F5">
    <button type="button" class="close" data-dismiss="alert">×</button>
    <h3>Отображаем когда посылок еще не создано</h3>

    <!-- info starts -->
    <p>У вас не создано ни единой посылки по заказу.</p>
    <p>Если вы хотите добавить все товары в одну посылку нажмите кнопку <strong>«Создать»</strong>. Если вы хотите добавить часть товаров, то пройдите во вкладку <a href="#" class="bold">со списком товаров</a>, выберите необходимые для добавления товары и воспользуйтесь групповой функцией <strong>«Создать посылку»</strong>.</p>
    <p><a href="orders/order/package-crud" class="btn btn-primary btn_preloader" data-loading-text="Создать" title="Создать посылку для всех товаров в заказе">Создать</a></p>
    <!-- info ends -->

</div>




<div class="row-fluid">
    <h3 class="pull-left offset-top0 offset-bottom1">Посылка № 123 <span class="muted">(2 товара)</span></h3>
    <div class="btn-group pull-right">
        <a href="orders/order/package-crud" class="btn btn-small" title="Редактировать данные"><i class="icon-edit font-14"></i> Редактировать</a><!-- don't use element a on production, use input or button instead -->
        <button class="btn btn-small" title="Распечатать инвойс"><i class="icon-print font-14"></i> Распечатать инвойс</button>
        <button class="btn btn-small ot_show_deletion_dialog_modal" title="Удалить посылку"><i class="icon-remove font-14"></i> Удалить</button>
    </div>
</div>

<!-- package item -->
<div class="well">
    <div class="row-fluid">

        <div class="span6">

            <div class="well well-white inset-top05 inset-bottom0">

                <dl class="dl-horizontal dl-ot-horizontal">
                    <dt>Трекинг-номер</dt>
                    <dd>22232323232</dd>
                    <dt>Статус</dt>
                    <dd><span class="label weight-normal">Cоздана</span></dd>
                    <dt>Дата создания</dt>
                    <dd>10.07.2013</dd>
                </dl>

                <dl class="dl-horizontal dl-ot-horizontal">
                    <dt>Способ доставки</dt>
                    <dd>Международная служба доставки EMS</dd>
                    <dt>Вес</dt>
                    <dd>3.4 кг</dd>
                    <dt>Стоимость</dt>
                    <dd>56.63 $</dd>
                    <dt>Дата отправки</dt>
                    <dd>17.07.2013</dd>
                </dl>

                <p><strong>Адрес:</strong> Арнольд Шварценеггер, США, г. Воронеж, Воронежская область, 394031, ул. Ворошилова, д. 101, кв. 65</p>
                <p><strong>Доп. информация:</strong> покупатель уехал на Канары, поэтому попросил выслать эту посылку на адрес своего брата, брата 2 :)</p><!-- show if exists -->

            </div>

        </div>

        <div class="span5 offset1">

            <div class="row-fluid">
                <div class="span6"><h4>Товары</h4></div>
                <div class="span6">

                    <!-- /goods actions -->
                    <div class="btn-group pull-right">
                        <button data-toggle="dropdown" class="btn btn-tiny offset-top05 dropdown-toggle"><i class="icon-cog"></i> <span class="caret"></span></button>
                        <ul class="dropdown-menu">
                            <li><a href="#" title="Переместить выбранные товары в другую посылку"><i class="icon-exchange"></i> Переместить в другую</a></li>
                            <li><a href="#" title="Переместить выбранные товары в новую посылку"><i class="icon-gift"></i> Переместить в новую</a></li>
                            <li class="divider"></li>
                            <li><a href="#" title="Удалить товар из посылки" class="ot_show_deletion_dialog_modal"><i class="icon-remove"></i> Удалить</a></li>

                        </ul>
                    </div><!-- /goods actions -->

                    <!--<button class="btn btn-mini pull-right offset-top1 ot_show_packages_election_window" title="Переместить выбранные товары в другую посылку">Переместить</button>-->
                </div>
            </div>

            <ul class="unstyled ot_parsel_goods_list">
                <li class="selected_item">
                    <label class="checkbox inline">
                        <input type="checkbox" value="" checked="checked">
                    </label>
                    <a href="#" title="Страница товара на сайте">№ 1356 - 1</a> (1.5 кг, 1 шт.)

                    <!-- img -->
                    <a href="#1356-7-img" class="thumbnail" data-toggle="lightbox" title="Увеличить изображение"><img src="img/pic/product-7.jpg" alt=""></a>
                    <div id="1356-7-img" class="lightbox hide fade"  tabindex="-1" role="dialog" aria-hidden="true">
                        <div class="lightbox-header">
                            <button type="button" class="close" data-dismiss="lightbox" aria-hidden="true"  title="Закрыть"><i class="icon-remove-sign"></i></button>
                        </div>
                        <div class="lightbox-content">
                            <img src="img/pic/product-7.jpg">
                            <div class="lightbox-caption"><p class="text-clipped-general">Инкремент устанавливает пакет 25 венгерского MECSEK органически для посылки под чаем с молоком чая с молоком для того чтобы принудить, что чай с молоком увеличил грудь эффективно</p></div>
                        </div>
                    </div>
                    <!-- /img -->
                </li>
                <li>

                    <label class="checkbox inline">
                        <input type="checkbox" value="">
                    </label>
                    <a href="#" title="Страница товара на сайте">№ 1356 - 2</a> (2.3 кг, 1 шт.)
                    <!-- img -->
                    <a href="#1356-2-img" class="thumbnail" data-toggle="lightbox" title="Увеличить изображение"><img src="img/pic/product-2.jpg" alt=""></a>
                    <div id="1356-2-img" class="lightbox hide fade"  tabindex="-1" role="dialog" aria-hidden="true">
                        <div class="lightbox-header">
                            <button type="button" class="close" data-dismiss="lightbox" aria-hidden="true"  title="Закрыть"><i class="icon-remove-sign"></i></button>
                        </div>
                        <div class="lightbox-content">
                            <img src="img/pic/product-2.jpg">
                            <div class="lightbox-caption"><p class="text-clipped-general">Инкремент устанавливает пакет 25 венгерского MECSEK органически для посылки под чаем с молоком чая с молоком для того чтобы принудить, что чай с молоком увеличил грудь эффективно</p></div>
                        </div>
                    </div>
                    <!-- /img -->
                </li>

            </ul>

        </div>

    </div>

</div>


<!-- package item -->
<div class="row-fluid">
    <h3 class="pull-left offset-top0 offset-bottom1">Посылка № 232 <span class="muted">(24 товара)</span></h3>
    <div class="btn-group pull-right">
        <a href="orders/order/package-crud" class="btn btn-small" title="Редактировать данные"><i class="icon-edit font-14"></i> Редактировать</a><!-- don't use element a on production, use input or button instead -->
        <button class="btn btn-small" title="Распечатать инвойс"><i class="icon-print font-14"></i> Распечатать инвойс</button>
        <button class="btn btn-small ot_show_deletion_dialog_modal" title="Удалить посылку"><i class="icon-remove font-14"></i> Удалить</button>
    </div>
</div>


<div class="well">
    <div class="row-fluid">

        <div class="span6 ot_parcel_info_area">

            <div class="well well-white inset-top05 inset-bottom0">

                <dl class="dl-horizontal dl-ot-horizontal ">
                    <dt>Трекинг-номер</dt>
                    <dd>22232323232</dd>
                    <dt>Статус</dt>
                    <dd><span class="label weight-normal">Cоздана</span></dd>
                    <dt>Дата создания</dt>
                    <dd>10.07.2013</dd>
                </dl>

                <dl class="dl-horizontal dl-ot-horizontal">
                    <dt>Способ доставки</dt>
                    <dd>Международная служба доставки China Post</dd>
                    <dt>Вес</dt>
                    <dd>3.4 кг</dd>
                    <dt>Стоимость</dt>
                    <dd>56.63 $</dd>
                    <dt>Дата отправки</dt>
                    <dd>17.07.2013</dd>
                </dl>

                <p><strong>Адрес:</strong> Арнольд Шварценеггер, США, г. Воронеж, Воронежская область, 394031, ул. Ворошилова, д. 101, кв. 65</p>
                <p><strong>Доп. информация:</strong> покупатель уехал на Канары, поэтому попросил выслать эту посылку на адрес своего брата, брата 2 :)</p><!-- show if exists -->

            </div>

        </div>

        <div class="span5 offset1">

            <div class="row-fluid">
                <div class="span6"><h4>Товары</h4></div>
                <div class="span6">
                    <!-- /goods actions -->
                    <div class="btn-group pull-right">
                        <button data-toggle="dropdown" class="btn btn-tiny offset-top05 disabled dropdown-toggle"><i class="icon-cog"></i> <span class="caret"></span></button>
                        <ul class="dropdown-menu">
                            <li><a href="#" title="Переместить выбранные товары в другую посылку"><i class="icon-exchange"></i> Переместить в другую</a></li>
                            <li><a href="#" title="Переместить выбранные товары в новую посылку"><i class="icon-gift"></i> Переместить в новую</a></li>
                            <li class="divider"></li>
                            <li><a href="#" title="Удалить товар из посылки" class="ot_show_deletion_dialog_modal"><i class="icon-remove"></i> Удалить</a></li>
                        </ul>
                    </div><!-- /goods actions -->
                </div>
            </div>

            <ul class="unstyled ot_parsel_goods_list">
                <li>
                    <label class="checkbox inline">
                        <input type="checkbox" value="">
                    </label>
                    <a href="#" title="Страница товара на сайте">№ 1356 - 1</a> (1.5 кг, 1 шт.)
                    <!-- img -->
                    <a href="#1356-2-img" class="thumbnail" data-toggle="lightbox" title="Увеличить изображение"><img src="img/pic/product-2.jpg" alt=""></a>
                </li>
                <li>
                    <label class="checkbox inline">
                        <input type="checkbox" value="">
                    </label>
                    <a href="#" title="Страница товара на сайте">№ 1356 - 2</a> (2.3 кг, 1 шт.)
                    <!-- img -->
                    <a href="#1356-2-img" class="thumbnail" data-toggle="lightbox" title="Увеличить изображение"><img src="img/pic/product-2.jpg" alt=""></a>
                </li>
                <li>
                    <label class="checkbox inline">
                        <input type="checkbox" value="">
                    </label>
                    <a href="#" title="Страница товара на сайте">№ 1356 - 1</a> (1.5 кг, 1 шт.)
                    <!-- img -->
                    <a href="#1356-2-img" class="thumbnail" data-toggle="lightbox" title="Увеличить изображение"><img src="img/pic/product-2.jpg" alt=""></a>
                </li>
                <li>
                    <label class="checkbox inline">
                        <input type="checkbox" value="">
                    </label>
                    <a href="#" title="Страница товара на сайте">№ 1356 - 2</a> (2.3 кг, 1 шт.)
                    <!-- img -->
                    <a href="#1356-2-img" class="thumbnail" data-toggle="lightbox" title="Увеличить изображение"><img src="img/pic/product-2.jpg" alt=""></a>
                </li>
                <li>
                    <label class="checkbox inline">
                        <input type="checkbox" value="">
                    </label>
                    <a href="#" title="Страница товара на сайте">№ 1356 - 1</a> (1.5 кг, 1 шт.)
                    <!-- img -->
                    <a href="#1356-2-img" class="thumbnail" data-toggle="lightbox" title="Увеличить изображение"><img src="img/pic/product-2.jpg" alt=""></a>
                </li>
                <li>
                    <label class="checkbox inline">
                        <input type="checkbox" value="">
                    </label>
                    <a href="#" title="Страница товара на сайте">№ 1356 - 2</a> (2.3 кг, 1 шт.)
                    <!-- img -->
                    <a href="#1356-2-img" class="thumbnail" data-toggle="lightbox" title="Увеличить изображение"><img src="img/pic/product-2.jpg" alt=""></a>
                </li>
                <li>
                    <label class="checkbox inline">
                        <input type="checkbox" value="">
                    </label>
                    <a href="#" title="Страница товара на сайте">№ 1356 - 1</a> (1.5 кг, 1 шт.)
                    <!-- img -->
                    <a href="#1356-2-img" class="thumbnail" data-toggle="lightbox" title="Увеличить изображение"><img src="img/pic/product-2.jpg" alt=""></a>
                </li>
                <li>
                    <label class="checkbox inline">
                        <input type="checkbox" value="">
                    </label>
                    <a href="#" title="Страница товара на сайте">№ 1356 - 2</a> (2.3 кг, 1 шт.)
                    <!-- img -->
                    <a href="#1356-2-img" class="thumbnail" data-toggle="lightbox" title="Увеличить изображение"><img src="img/pic/product-2.jpg" alt=""></a>
                </li>
                <li>
                    <label class="checkbox inline">
                        <input type="checkbox" value="">
                    </label>
                    <a href="#" title="Страница товара на сайте">№ 1356 - 1</a> (1.5 кг, 1 шт.)
                    <!-- img -->
                    <a href="#1356-2-img" class="thumbnail" data-toggle="lightbox" title="Увеличить изображение"><img src="img/pic/product-2.jpg" alt=""></a>
                </li>
                <li>
                    <label class="checkbox inline">
                        <input type="checkbox" value="">
                    </label>
                    <a href="#" title="Страница товара на сайте">№ 1356 - 2</a> (2.3 кг, 1 шт.)
                    <!-- img -->
                    <a href="#1356-2-img" class="thumbnail" data-toggle="lightbox" title="Увеличить изображение"><img src="img/pic/product-2.jpg" alt=""></a>
                </li>
                <li>
                    <label class="checkbox inline">
                        <input type="checkbox" value="">
                    </label>
                    <a href="#" title="Страница товара на сайте">№ 1356 - 1</a> (1.5 кг, 1 шт.)
                    <!-- img -->
                    <a href="#1356-2-img" class="thumbnail" data-toggle="lightbox" title="Увеличить изображение"><img src="img/pic/product-2.jpg" alt=""></a>
                </li>
                <li>
                    <label class="checkbox inline">
                        <input type="checkbox" value="">
                    </label>
                    <a href="#" title="Страница товара на сайте">№ 1356 - 2</a> (2.3 кг, 1 шт.)
                    <!-- img -->
                    <a href="#1356-2-img" class="thumbnail" data-toggle="lightbox" title="Увеличить изображение"><img src="img/pic/product-2.jpg" alt=""></a>
                </li>
                <li>
                    <label class="checkbox inline">
                        <input type="checkbox" value="">
                    </label>
                    <a href="#" title="Страница товара на сайте">№ 1356 - 1</a> (1.5 кг, 1 шт.)<!-- img -->
                    <a href="#1356-2-img" class="thumbnail" data-toggle="lightbox" title="Увеличить изображение"><img src="img/pic/product-2.jpg" alt=""></a>

                </li>
                <li>
                    <label class="checkbox inline">
                        <input type="checkbox" value="">
                    </label>
                    <a href="#" title="Страница товара на сайте">№ 1356 - 2</a> (2.3 кг, 1 шт.)
                    <!-- img -->
                    <a href="#1356-2-img" class="thumbnail" data-toggle="lightbox" title="Увеличить изображение"><img src="img/pic/product-2.jpg" alt=""></a>
                </li>
                <li>
                    <label class="checkbox inline">
                        <input type="checkbox" value="">
                    </label>
                    <a href="#" title="Страница товара на сайте">№ 1356 - 1</a> (1.5 кг, 1 шт.)
                    <!-- img -->
                    <a href="#1356-2-img" class="thumbnail" data-toggle="lightbox" title="Увеличить изображение"><img src="img/pic/product-2.jpg" alt=""></a>
                </li>
                <li>
                    <label class="checkbox inline">
                        <input type="checkbox" value="">
                    </label>
                    <a href="#" title="Страница товара на сайте">№ 1356 - 2</a> (2.3 кг, 1 шт.)
                    <!-- img -->
                    <a href="#1356-2-img" class="thumbnail" data-toggle="lightbox" title="Увеличить изображение"><img src="img/pic/product-2.jpg" alt=""></a>
                </li>

            </ul>


        </div>

    </div>

</div>



<!-- packegae election modal window -->
<div class="modal hide fade ot_packages_election_window">
    <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">×</button>
        <h3>Выбор посылки</h3>
    </div>
    <div class="modal-body">
        <label class="radio inset1 inset-left2 selected_item">
            <input type="radio" name="optionsRadios" value="option1" checked="checked">
            <p><strong>Посылка № 123 (2 товара)</strong> <span class="badge">Отправлена</span> 3.4 кг, 56.63 $. Дата создания 10.07.2013.</p>
            Международная служба доставки China Post. Трекинг: 22232323232,  Отправлена 17.07.2013 <br>
            Адрес: Россия, г. Воронеж, Воронежская область, 394031, ул. Ворошилова, д. 101, кв. 65., Арнольду Шварценеггеру.
            <em>Доп. информация:</em> покупатель уехал на Канары, поэтому попросил выслать эту посылку на адрес своего брата :)
        </label>
        <label class="radio inset1 inset-left2">
            <input type="radio" name="optionsRadios" id="optionsRadios2" value="option2">
            <p><strong>Посылка № 232 (24 товара)</strong> <span class="badge">Создана</span> 3.4 кг, 56.63 $. Дата создания 10.07.2013.</p>
            Международная служба доставки China Post. <br>
            Адрес: Россия, г. Воронеж, Воронежская область, 394031, ул. Ворошилова, д. 101, кв. 65., Арнольду Шварценеггеру.
        </label>
        <label class="radio inset1 inset-left2">
            <input type="radio" name="optionsRadios" value="option1">
            <p><strong>Посылка № 123 (2 товара)</strong> <span class="badge">Отправлена</span> 3.4 кг, 56.63 $. Дата создания 10.07.2013.</p>
            Международная служба доставки China Post. Трекинг: 22232323232,  Отправлена 17.07.2013 <br>
            Адрес: Россия, г. Воронеж, Воронежская область, 394031, ул. Ворошилова, д. 101, кв. 65., Арнольду Шварценеггеру.
            <em>Доп. информация:</em> покупатель уехал на Канары, поэтому попросил выслать эту посылку на адрес своего брата :)
        </label>
    </div>
    <div class="modal-footer">
        <a href="#" class="btn btn-primary pull-left">Переместить</a>
        <a href="#" class="btn pull-right" data-dismiss="modal">Отменить</a>
    </div>
</div>





<!-- alternative presentation -->

<!--
<div class="row-fluid">
    <h3 class="pull-left">Посылка № 311 <span class="muted">(26 товаров)</span></h3>
    <div class="btn-group pull-right">
        <button class="btn btn-small" title="Редактировать данные">Редактировать</button>
        <button class="btn btn-small" title="Удалить посылку">Удалить</button>
    </div>
</div>


<div class="well">
    <div class="row-fluid">

        <div class="span6">
            <div class="well well-white">
            <dl class="dl-horizontal dl-ot-horizontal ">
                <dt>Трекинг-номер</dt>
                <dd>22232323232</dd>
                <dt>Статус</dt>
                <dd>создана</dd>
                <dt>Дата создания</dt>
                <dd>10.07.2013</dd>
                <dt>Дата отправки</dt>
                <dd>17.07.2013</dd>
            </dl>
            </div>
        </div>

        <div class="span6">
            <div class="well well-white">
            <dl class="dl-horizontal dl-ot-horizontal">
                <dt>Способ доставки</dt>
                <dd>Международная служба доставки China Post</dd>
                <dt>Вес</dt>
                <dd>3.4 кг</dd>
                <dt>Стоимость</dt>
                <dd>56.63 $</dd>
            </dl>
            </div>
        </div>

    </div>

    <h4>Товары</h4>

    <p><button class="btn btn-small disabled" title="Переместить выбранные товары в другую посылку">Переместить товары</button></p>

    <ul class="unstyled ot_parsel_goods_list_horizontal">
        <li>
            <label class="checkbox inline">
                <input type="checkbox" value="">
            </label>
            <a href="#" title="Страница товара на сайте">№ 1356 - 1</a> (1.5 кг, 1 шт.)
        </li>
        <li>
            <label class="checkbox inline">
                <input type="checkbox" value="">
            </label>
            <a href="#" title="Страница товара на сайте">№ 1356 - 2</a> (2.3 кг, 1 шт.)
        </li>
        <li>
            <label class="checkbox inline">
                <input type="checkbox" value="">
            </label>
            <a href="#" title="Страница товара на сайте">№ 1356 - 1</a> (1.5 кг, 1 шт.)
        </li>

    </ul>

</div>-->