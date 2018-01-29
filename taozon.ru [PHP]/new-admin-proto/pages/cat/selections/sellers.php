
<ul class="breadcrumb">
    <li><a href="."><i class="icon-home"></i></a> <span class="divider">›</span></li>
    <li><a href="cat/categories">Каталог</a> <span class="divider">›</span></li>
    <li><a href="cat/selections/brands">Подборки</a> <span class="divider">›</span></li>
    <li class="active">Продавцы</li>
</ul>
<!--/.breadcrumb-->

<? include('inc/sub_nav_cat.php'); ?>

<div class="ot_sub_sub_nav">
    <ul class="nav nav-pills">
        <li><a href="cat/selections/brands">Бренды</a></li>
        <li class="active"><a href="cat/selections/sellers">Продавцы</a></li>
        <li><a href="cat/selections/recommended">Рекомендуемые товары</a></li>
        <li><a href="cat/selections/popular">Популярные товары</a></li>
        <li><a href="cat/selections/last-viewed">Последние открытые товары</a></li>
    </ul>
</div>

<h1>Продавцы</h1>

<div class="row-fluid offset-bottom1">

    <div class="span4">

        <strong data-target=".ot_add_seller_to_selection" data-toggle="collapse" class="blink blink-iconed"><i class="icon-plus"></i>Добавить</strong>

    </div>

    <div class="span8">

        <button class="btn btn-tiny btn_preloader" data-loading-text="<i class='icon-sort-by-attributes-alt icon-rotate-270 font-14'></i> Сохраняется порядок" title="Сохранить порядок"><i class="icon-sort-by-attributes-alt icon-rotate-270 font-14"></i> Сохранить порядок</button>

    </div>

</div>


<div class="ot_add_seller_to_selection collapse">

    <div class="well">

        <form class="form-horizontal ot_form " action="">

            <div class="row-fluid">

                <div class="span6">
                    <div class="control-group">
                        <label class="control-label">Ссылка, id или имя продавца <i class="icon-question-sign ot_inline_help" data-toggle="popover" data-placement="right" data-content="Добавление продавца происходит по его имени, которое можно найти на странице товара, идентификатору (ID) или по ссылке на страницу продавца на сайте"></i></label>
                        <div class="controls">
                            <input class="input-xlarge" type="text" required="required" title="Обязательное поле">
                        </div>
                    </div>

                    <div class="control-group">
                        <label class="control-label">Отображаемое изображение <i class="icon-question-sign ot_inline_help" data-toggle="popover" data-placement="right" data-content="Локальная помощь" data-original-title="" title=""></i></label>
                        <div class="controls">
                            <div class="fileupload fileupload-new" data-provides="fileupload">
                                <div class="fileupload-preview fileupload-exists thumbnail thumbnail-mini"></div>
                                <div class="btn btn-success btn-tiny btn-file">
                                    <span class="fileupload-new">Выбрать</span>
                                    <span class="fileupload-exists">Изменить</span>
                                    <input type="file">
                                </div>
                                <span class="btn btn-danger btn-tiny fileupload-exists" data-dismiss="fileupload">Удалить</span>

                            </div>
                        </div>
                    </div>
                </div>

                <div class="span6">

                    <div class="control-group">
                        <label class="control-label">Отображаемое имя <i class="icon-question-sign ot_inline_help" data-toggle="popover" data-placement="right" data-content="Локальная помощь"></i></label>
                        <div class="controls">
                            <input class="input-large" type="text">
                        </div>
                    </div>


                </div>

            </div>


            <div class="controls">
                <button type="button" class="btn btn-primary btn_preloader" data-loading-text="Добавить">Добавить</button>
                <button type="button" class="btn offset-left05" data-target=".ot_add_seller_to_selection" data-toggle="collapse" title="Отменить / Скрыть форму">Отменить</button>
            </div>

        </form>

    </div><!-- /.well -->

</div><!-- /.ot_add_seller_to_selection .collapse-->

<ul class="thumbnails ot_sortable ot_sortable_cols">

    <li>
        <div class="thumbnail">
            <header>
                <span class="sortable_handler" title="Изменить порядок"><i class="icon-move"></i></span>
                <span class="pull-right">
                    <button class="btn btn-mini ot_show_edit_seller_dialog_modal" title="Редактировать"><i class="icon-pencil"></i></button>
                    <button class="btn btn-mini ot_show_deletion_dialog_modal" title="Удалить"><i class="icon-remove"></i></button>
                </span>
            </header>
            <a href="#" title="На страницу продавца" class="img_preview"><img src="img/pic/sellers/seller1.jpg" alt=""></a>
            <h3 title="Розовые платья">Розовые платья</h3>
        </div>
    </li>

    <li>
        <div class="thumbnail">
            <header>
                <span class="sortable_handler" title="Изменить порядок"><i class="icon-move"></i></span>
                <span class="pull-right">
                    <button class="btn btn-mini ot_show_edit_seller_dialog_modal" title="Редактировать"><i class="icon-pencil"></i></button>
                    <button class="btn btn-mini ot_show_deletion_dialog_modal" title="Удалить"><i class="icon-remove"></i></button>
                </span>
            </header>
            <a href="#" title="На страницу продавца" class="img_preview"><img src="img/pic/sellers/seller2.jpg" alt=""></a>
            <h3 title="Вечерние платья">Вечерние платья</h3>
        </div>
    </li>

    <li>
        <div class="thumbnail">
            <header>
                <span class="sortable_handler" title="Изменить порядок"><i class="icon-move"></i></span>
                <span class="pull-right">
                    <button class="btn btn-mini ot_show_edit_seller_dialog_modal" title="Редактировать"><i class="icon-pencil"></i></button>
                    <button class="btn btn-mini ot_show_deletion_dialog_modal" title="Удалить"><i class="icon-remove"></i></button>
                </span>
            </header>
            <a href="#" title="На страницу продавца" class="img_preview"><img src="img/pic/sellers/seller3.jpg" alt=""></a>
            <h3 title="Толстовки с капюшоном">Толстовки с капюшоном</h3>
        </div>
    </li>

    <li>
        <div class="thumbnail">
            <header>
                <span class="sortable_handler" title="Изменить порядок"><i class="icon-move"></i></span>
                <span class="pull-right">
                    <button class="btn btn-mini ot_show_edit_seller_dialog_modal" title="Редактировать"><i class="icon-pencil"></i></button>
                    <button class="btn btn-mini ot_show_deletion_dialog_modal" title="Удалить"><i class="icon-remove"></i></button>
                </span>
            </header>
            <a href="#" title="На страницу продавца" class="img_preview"><img src="img/pic/sellers/seller4.jpg" alt=""></a>
            <h3 title="Туалетная вода">Туалетная вода</h3>
        </div>
    </li>

    <li>
        <div class="thumbnail">
            <header>
                <span class="sortable_handler" title="Изменить порядок"><i class="icon-move"></i></span>
                <span class="pull-right">
                    <button class="btn btn-mini ot_show_edit_seller_dialog_modal" title="Редактировать"><i class="icon-pencil"></i></button>
                    <button class="btn btn-mini ot_show_deletion_dialog_modal" title="Удалить"><i class="icon-remove"></i></button>
                </span>
            </header>
            <a href="#" title="На страницу продавца" class="img_preview"><img src="img/pic/sellers/seller5.jpg" alt=""></a>
            <h3 title="Дитям">Дитям</h3>
        </div>
    </li>

    <li>
        <div class="thumbnail">
            <header>
                <span class="sortable_handler" title="Изменить порядок"><i class="icon-move"></i></span>
                <span class="pull-right">
                    <button class="btn btn-mini ot_show_edit_seller_dialog_modal" title="Редактировать"><i class="icon-pencil"></i></button>
                    <button class="btn btn-mini ot_show_deletion_dialog_modal" title="Удалить"><i class="icon-remove"></i></button>
                </span>
            </header>
            <a href="#" title="На страницу продавца" class="img_preview"><img src="img/pic/sellers/seller6.jpg" alt=""></a>
            <h3 title="Джинсы">Джинсы</h3>
        </div>
    </li>

    <li>
        <div class="thumbnail">
            <header>
                <span class="sortable_handler" title="Изменить порядок"><i class="icon-move"></i></span>
                <span class="pull-right">
                    <button class="btn btn-mini ot_show_edit_seller_dialog_modal" title="Редактировать"><i class="icon-pencil"></i></button>
                    <button class="btn btn-mini ot_show_deletion_dialog_modal" title="Удалить"><i class="icon-remove"></i></button>
                </span>
            </header>
            <a href="#" title="На страницу продавца" class="img_preview"><img src="img/pic/sellers/seller7.jpg" alt=""></a>
            <h3 title="Крутая шняга">Крутая шняга</h3>
        </div>
    </li>

</ul>


<!-- edit item window -->
<div class="modal hide fade ot_edit_seller_dialog_modal">
    <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">×</button>
        <h3>Редактирование продавца</h3>
    </div>
    <div class="modal-body">
        <form class="form-horizontal ot_form " action="">

            <div class="control-group">
                <label class="control-label">Отображаемое изображение <i class="icon-question-sign ot_inline_help" data-toggle="popover" data-placement="right" data-content="Локальная помощь" data-original-title="" title=""></i></label>
                <div class="controls">
                    <div class="fileupload fileupload-new" data-provides="fileupload">

                        <div class="fileupload-new thumbnail thumbnail-mini">
                            <div class="thumbnail-placeholder"><img src="img/pic/sellers/seller6.jpg" alt=""></div>
                        </div>

                        <div class="fileupload-preview fileupload-exists thumbnail thumbnail-mini"></div>
                        <div class="btn btn-success btn-tiny btn-file">
<!--                            <span class="fileupload-new">Выбрать</span>-->
                            <span class="fileupload-new">Изменить</span>
                            <span class="fileupload-exists">Изменить</span>
                            <input type="file">
                        </div>
                        <span class="btn btn-danger btn-tiny fileupload-exists" data-dismiss="fileupload">Удалить</span>
                        <span class="btn btn-danger btn-tiny fileupload-new" data-dismiss="fileupload">Удалить</span>

                    </div>
                </div>
            </div>

            <div class="control-group">
                <label class="control-label">Отображаемое имя <i class="icon-question-sign ot_inline_help" data-toggle="popover" data-placement="right" data-content="Локальная помощь"></i></label>
                <div class="controls">
                    <input class="input-large" type="text" value="Джинсы">
                </div>
            </div>

        </form>

    </div>
    <div class="modal-footer">
        <button type="button" class="btn btn-primary pull-left btn_preloader" autocomplete="off" data-loading-text="Сохранить">Сохранить</button>
        <button type="button" class="btn pull-right" data-dismiss="modal">Отменить</button>
    </div>

</div><!-- /edit item window -->