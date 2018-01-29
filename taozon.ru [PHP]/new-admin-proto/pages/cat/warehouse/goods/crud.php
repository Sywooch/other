<ul class="breadcrumb">
    <li><a href="."><i class="icon-home"></i></a> <span class="divider">›</span></li>
    <li><a href="cat/categories">Каталог</a> <span class="divider">›</span></li>
    <li><a href="cat/warehouse/categories">Товары на складе</a> <span class="divider">›</span></li>
    <li><a href="cat/warehouse/goods">Товары</a> <span class="divider">›</span></li>
    <li class="active">Редактирование товара</li>
</ul>
<!--/.breadcrumb-->

<? include('inc/sub_nav_cat.php'); ?>

<div class="ot_sub_sub_nav">
    <ul class="nav nav-pills">
        <li><a href="cat/warehouse/categories">Категории</a></li>
        <li class="active"><a href="cat/warehouse/goods">Товары</a></li>
    </ul>
</div>


<h1>Добавление/Редактирование товара</h1>





<div class="well">

    <p class="offset-bottom2"><strong class="blink ot_chose_product_editable">Выбрать существующий товар</strong></p>

    <form class="form-horizontal ot_form" action="">

        <div class="control-group">
            <label class="control-label bold">Название</label>
            <div class="controls">
                <input class="input-xlarge input-text-clipped" type="text" required="required">
            </div>
        </div>

        <div class="control-group">
            <label class="control-label bold">Продавец</label>
            <div class="controls">
                <input class="input-medium" type="text" required="required">
            </div>
        </div>

        <div class="control-group">
            <label class="control-label bold">Категория</label>
            <div class="controls">
                <input class="input-medium" type="text" required="required">
                <button type="button" data-toggle="button" class="btn" title="Указать раздел каталога"><i class="icon-list-alt font-14"></i></button>
            </div>
        </div>


        <div class="control-group offset-bottom0">
            <label class="control-label bold">Фотографии</label>

            <div class="controls">

                <ul class="thumbnails ot_sortable_cols offset-bottom0" data-toggle="modal-gallery" data-target="#modal-gallery">

                    <li>

                        <div class="fileupload fileupload-new" data-provides="fileupload">

                            <a href="img/pic/goods/goods1.jpg" class="fileupload-new thumbnail thumbnail-medium" data-gallery="gallery" title="Увеличить фотографию"><img src="img/pic/goods/goods1.jpg" alt=""></a>

                            <a href="img/pic/goods/goods1.jpg" class="fileupload-preview fileupload-exists thumbnail thumbnail-medium" data-gallery="gallery" title="Увеличить фотографию"><img src="img/pic/goods/goods1.jpg" alt=""></a>

                            <div class="offset-top05 text-center">

                                <span class="btn btn-tiny btn-file">
                                    <span class="fileupload-new"><i class="icon-pencil"></i></span>
                                    <span class="fileupload-exists"><i class="icon-pencil"></i></span>
                                    <input type="file" />
                                </span>
                                <button class="btn btn-tiny ot_show_deletion_dialog_modal" title="Удалить фотографию"><i class="icon-remove"></i></button>
                            </div>

                        </div>

                    </li>

                    <li>
                        <div class="fileupload fileupload-new" data-provides="fileupload">

                            <a href="img/pic/goods/goods2.jpg" class="fileupload-new thumbnail thumbnail-medium" data-gallery="gallery" title="Увеличить фотографию"><img src="img/pic/goods/goods2.jpg" alt=""></a>

                            <a href="img/pic/goods/goods2.jpg" class="fileupload-preview fileupload-exists thumbnail thumbnail-medium" data-gallery="gallery" title="Увеличить фотографию"><img src="img/pic/goods/goods2.jpg" alt=""></a>

                            <div class="offset-top05 text-center">

                                <span class="btn btn-tiny btn-file">
                                    <span class="fileupload-new"><i class="icon-pencil"></i></span>
                                    <span class="fileupload-exists"><i class="icon-pencil"></i></span>
                                    <input type="file" />
                                </span>
                                <button class="btn btn-tiny ot_show_deletion_dialog_modal" title="Удалить фотографию"><i class="icon-remove"></i></button>
                            </div>

                        </div>
                    </li>

                    <li>
                        <div class="fileupload fileupload-new" data-provides="fileupload">

                            <a href="img/pic/goods/goods3.jpg" class="fileupload-new thumbnail thumbnail-medium" data-gallery="gallery" title="Увеличить фотографию"><img src="img/pic/goods/goods3.jpg" alt=""></a>

                            <a href="img/pic/goods/goods3.jpg" class="fileupload-preview fileupload-exists thumbnail thumbnail-medium" data-gallery="gallery" title="Увеличить фотографию"><img src="img/pic/goods/goods3.jpg" alt=""></a>

                            <div class="offset-top05 text-center">

                                <span class="btn btn-tiny btn-file">
                                    <span class="fileupload-new"><i class="icon-pencil"></i></span>
                                    <span class="fileupload-exists"><i class="icon-pencil"></i></span>
                                    <input type="file" />
                                </span>
                                <button class="btn btn-tiny ot_show_deletion_dialog_modal" title="Удалить фотографию"><i class="icon-remove"></i></button>
                            </div>

                        </div>
                    </li>

                    <li>
                        <div class="fileupload fileupload-new" data-provides="fileupload">

                            <a href="img/pic/goods/goods7.jpg" class="fileupload-new thumbnail thumbnail-medium" data-gallery="gallery" title="Увеличить фотографию"><img src="img/pic/goods/goods7.jpg" alt=""></a>

                            <a href="img/pic/goods/goods7.jpg" class="fileupload-preview fileupload-exists thumbnail thumbnail-medium" data-gallery="gallery" title="Увеличить фотографию"><img src="img/pic/goods/goods7.jpg" alt=""></a>

                            <div class="offset-top05 text-center">

                                <span class="btn btn-tiny btn-file">
                                    <span class="fileupload-new"><i class="icon-pencil"></i></span>
                                    <span class="fileupload-exists"><i class="icon-pencil"></i></span>
                                    <input type="file" />
                                </span>
                                <button class="btn btn-tiny ot_show_deletion_dialog_modal" title="Удалить фотографию"><i class="icon-remove"></i></button>
                            </div>

                        </div>
                    </li>

                    <li>
                        <div class="fileupload fileupload-new" data-provides="fileupload">

                            <a href="img/pic/goods/goods4.jpg" class="fileupload-new thumbnail thumbnail-medium" data-gallery="gallery" title="Увеличить фотографию"><img src="img/pic/goods/goods4.jpg" alt=""></a>

                            <a href="img/pic/goods/goods4.jpg" class="fileupload-preview fileupload-exists thumbnail thumbnail-medium" data-gallery="gallery" title="Увеличить фотографию"><img src="img/pic/goods/goods4.jpg" alt=""></a>

                            <div class="offset-top05 text-center">

                                <span class="btn btn-tiny btn-file">
                                    <span class="fileupload-new"><i class="icon-pencil"></i></span>
                                    <span class="fileupload-exists"><i class="icon-pencil"></i></span>
                                    <input type="file" />
                                </span>
                                <button class="btn btn-tiny ot_show_deletion_dialog_modal" title="Удалить фотографию"><i class="icon-remove"></i></button>
                            </div>

                        </div>
                    </li>

 <!--                   <li>
                        <div class="fileupload fileupload-new" data-provides="fileupload">

                            <a href="img/pic/goods/goods6.jpg" class="fileupload-new thumbnail thumbnail-medium" data-gallery="gallery" title="Увеличить фотографию"><img src="img/pic/goods/goods6.jpg" alt=""></a>

                            <a href="img/pic/goods/goods6.jpg" class="fileupload-preview fileupload-exists thumbnail thumbnail-medium" data-gallery="gallery" title="Увеличить фотографию"><img src="img/pic/goods/goods6.jpg" alt=""></a>

                            <div class="offset-top05 text-center">

                                <span class="btn btn-tiny btn-file">
                                    <span class="fileupload-new"><i class="icon-pencil"></i></span>
                                    <span class="fileupload-exists"><i class="icon-pencil"></i></span>
                                    <input type="file" />
                                </span>
                                <button class="btn btn-tiny ot_show_deletion_dialog_modal" title="Удалить фотографию"><i class="icon-remove"></i></button>
                            </div>

                        </div>
                    </li>-->

                </ul>

                <span class="btn btn-tiny btn-inverse"><i class="icon-plus"></i> Добавить</span>

            </div>

        </div>

        <div class="control-group">
            <label class="control-label bold">Цена</label>
            <div class="controls">
                <div class="input-append">
                    <input class="input-mini" type="text" required="required" title="Обязательное поле" value="120">
                    <span class="add-on">$</span>
                </div>

            </div>
        </div>

        <div class="control-group">
            <label class="control-label bold">Количество</label>
            <div class="controls">
                <input class="input-mini" type="text" required="required" title="Обязательное поле"  value="2">
            </div>
        </div>

        <div class="control-group">
            <label class="control-label bold">Описание <i class="icon-question-sign ot_inline_help" data-toggle="popover" data-placement="top" data-content="Локальная помощь"></i></label>
            <div class="controls">
                <textarea rows="10" class="input-xxlarge">Описание товара с таобоао, возможно измененное пользователем. Выполнено с применением визуального редактора.</textarea>
            </div>
        </div>

        <div class="controls">
            <a href="cat/warehouse/goods" class="btn btn-primary btn_preloader" data-loading-text="Сохранить">Сохранить</a>
            <a href="cat/warehouse/goods" type="button" class="btn offset-left2 btn_preloader" data-loading-text="Отменить">Отменить</a>
        </div>

    </form>

</div>


<!-- modal-gallery is the modal dialog used for the image gallery -->
<div id="modal-gallery" class="modal modal-gallery hide fade" tabindex="-1">

    <div class="modal-header">
        <button data-dismiss="modal" class="close" type="button">×</button>
        <h3 class="modal-title"></h3>
    </div>

    <div class="modal-body"><div class="modal-image"></div></div>

    <div class="modal-footer">

        <div class="row-fluid">

            <div class="span6 text-left">
                <div class="btn-group">
                    <button class="btn btn-primary modal-prev" title="Предыдущее"><i class="icon-arrow-left icon-white"></i></button>
                    <button class="btn btn-primary modal-next" title="Следующее"><i class="icon-arrow-right icon-white"></i></button>
                </div>
            </div>

            <div class="span6 text-right">
                <button href="#" class="btn" data-dismiss="modal">Закрыть</button>
            </div>

        </div>

    </div>

</div><!-- /modal-gallery-->




<!--<div class="ot_add_product_info_from_link collapse">

    <form class="form-horizontal ot_form well well-transp" action="">

        <div class="control-group offset-bottom0">
            <label class="control-label bold">Cсылка на товар <i class="icon-question-sign ot_inline_help" data-toggle="popover" data-placement="right" data-content="Добавление информации происходит по ссылке на товар на сайте"></i></label>
            <div class="controls">
                <input class="input" type="text">

                <button type="button" class="btn btn-primary btn_preloader" data-loading-text="Добавить">Добавить</button>
                <button type="button" class="btn offset-left05" data-target=".ot_add_product_info_from_link" data-toggle="collapse" title="Отменить / Скрыть форму">Отменить</button>
            </div>
        </div>

    </form>
</div>-->