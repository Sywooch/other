<!-- list of goods
---------------------------- -->

<!-- goods status filter -->
<div class="well well-small">

    <div class="row-fluid">
        <div class="span4"><label class="checkbox inline"><input type="checkbox">Ожидает оплаты</label></div>
        <div class="span4"><label class="checkbox inline"><input type="checkbox">Подтверждение цены</label></div>
        <div class="span4"><label class="checkbox inline"><input type="checkbox">Проверка качества</label></div>
    </div>

    <div class="row-fluid">
        <div class="span4"><label class="checkbox inline"><input type="checkbox">Упаковка</label></div>
        <div class="span4"><label class="checkbox inline"><input type="checkbox">Отправлен</label></div>
        <div class="span4"><label class="checkbox inline"><input type="checkbox">Возвращен продавцу</label></div>
    </div>

    <div class="row-fluid">
        <div class="span4"><label class="checkbox inline"><input type="checkbox">Отменен</label></div>
        <div class="span4"><label class="checkbox inline"><input type="checkbox">Оплачен</label></div>
        <div class="span4"><label class="checkbox inline"><input type="checkbox">Заказан</label></div>
    </div>

    <div class="row-fluid">
        <div class="span4"><label class="checkbox inline"><input type="checkbox">Получен на склад</label></div>
        <div class="span4"><label class="checkbox inline"><input type="checkbox">Готов к отправке</label></div>
        <div class="span4"><label class="checkbox inline"><input type="checkbox">Получен</label></div>
    </div>

    <div class="row-fluid">
        <div class="span4"><label class="checkbox inline"><input type="checkbox">Невозможно поставить</label></div>
    </div>

    <div class="text-right">
        <button class="btn btn-tiny" title="Отфильтровать товары по статусам"><i class="icon-filter"></i> Применить фильтр</button>
    </div>

</div>
<!-- /goods status filter -->

<!-- group operations -->
<div class="row-fluid offset-bottom1">

    <div class="pull-left">

        <!-- check all the checkboxes -->
        <label class="checkbox inline offset-left1">
            <input type="checkbox" value="">
        </label>

        <!-- group actions with selected elements -->
        <div class="btn-group">
            <button data-toggle="dropdown" class="btn btn-tiny btn-primary dropdown-toggle"><i class="icon-cog"></i> С выбранными <span class="caret"></span></button>
            <ul class="dropdown-menu">
                <li><a href="#" title="Экспортировать товары"><i class="icon-share"></i> Экспортировать</a></li>
                <li><a href="#" title="Распечатать этикетки для каждого товара"><i class="icon-print"></i> Распечатать этикетки</a></li>
                <li class="divider"></li>
                <li><a href="#" title="Создать посылку с выбранными товарами"><i class="icon-gift"></i> Создать посылку</a></li>
                <li><a href="#" title="Добавить товары в существующую посылку"><i class="icon-plus"></i> Добавить в посылку</a></li>
                <li class="divider"></li>
                <li><a href="#" class="ot_show_deletion_dialog_modal" title="Удалить товары"><i class="icon-remove"></i> Удалить</a></li>
            </ul>
        </div>

        <!-- change selected goods status -->
        <div class="btn-group">

            <button data-toggle="dropdown" class="btn btn-tiny btn-primary dropdown-toggle"><i class="icon-star-empty"></i> Изменить статус <span class="caret"></span></button>

            <ul class="dropdown-menu dropdown-menu-large">
                <li><a href="#">Ожидает оплаты</a></li>
                <li><a href="#">Оплачен</a></li>
                <li><a href="#">Подтверждение цены</a></li>
                <li><a href="#">Заказан</a></li>
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

</div>
<!-- /group operations -->


<!-- show the quantity of items -->
<?
include("pages/orders/order/ot-order-product-item.php");
include("pages/orders/order/ot-order-product-item.php");
include("pages/orders/order/ot-order-product-selected-item.php");
include("pages/orders/order/ot-order-product-selected-item.php");
include("pages/orders/order/ot-order-product-selected-item.php");
include("pages/orders/order/ot-order-product-selected-item.php");
include("pages/orders/order/ot-order-product-selected-item.php");
include("pages/orders/order/ot-order-product-selected-item.php");
?>


<!-- order item photos addition window -->
<? include('pages/orders/order/add-order-item-photos-window.php'); ?>

<!-- modal-gallery is the modal dialog used for the image gallery -->
<div id="modal-gallery" class="modal modal-gallery hide fade" tabindex="-1">
    <div class="modal-header">
        <button data-dismiss="modal" class="close" type="button">×</button>
        <h3 class="modal-title"></h3>
    </div>
    <div class="modal-body"><div class="modal-image"></div></div>
    <div class="modal-footer">

        <div class="row-fluid">

            <div class="span3 text-left">
                <button class="btn btn-danger ot_show_deletion_dialog_modal" title="Удалить изображение"><i class="icon-remove-sign"></i> Удалить</button>
            </div>

            <div class="span5 offset1 text-center">
                <div class="btn-group">
                    <button class="btn btn-primary modal-prev" title="Предыдущее"><i class="icon-arrow-left icon-white"></i></button>
                    <button class="btn btn-primary modal-play modal-slideshow" data-slideshow="5000" title="Слайдшоу"><i class="icon-play icon-white"></i></button>
                    <button class="btn btn-primary modal-next" title="Следующее"><i class="icon-arrow-right icon-white"></i></button>
                </div>
            </div>

            <div class="span3 text-right">
                <button href="#" class="btn" data-dismiss="modal">Закрыть</button>
            </div>

        </div>

    </div>
</div>