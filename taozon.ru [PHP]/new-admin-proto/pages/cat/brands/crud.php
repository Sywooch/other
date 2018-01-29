
<ul class="breadcrumb">
    <li><a href="."><i class="icon-home"></i></a> <span class="divider">›</span></li>
    <li><a href="cat/categories">Каталог</a> <span class="divider">›</span></li>
    <li><a href="cat/brands">Бренды</a> <span class="divider">›</span></li>
    <li class="active">Добавление / редактирование бренда</li>
</ul>
<!--/.breadcrumb-->

<? include('inc/sub_nav_cat.php'); ?>

<h1>Добавление / редактирование бренда</h1>

<div class="well">

    <form method="post" action="" class="form-horizontal ot_form">

        <div class="row-fluid">

            <div class="span6">

                <div class="control-group">
                    <label class="control-label bold">Название бренда <i class="icon-question-sign ot_inline_help" data-toggle="popover" data-placement="top" data-content="Локальная помощь"></i></label>
                    <div class="controls">
                        <input type="text" class="input-block-level" data-provide="typeahead" id="ot_brands_list" placeholder="Введите первые символы" required="required" title="Обязательное поле">
                    </div>
                </div>

                <div class="control-group">
                    <label class="control-label bold">Отображаемое название <i class="icon-question-sign ot_inline_help" data-toggle="popover" data-placement="top" data-content="Локальная помощь"></i></label>
                    <div class="controls">
                        <input class="input-block-level" type="text">
                    </div>
                </div>

            </div><!-- /. span6 -->

            <div class="span6 relative">

                <!-- show this preloader when searching for remote data -->
                <i class="ot-preloader-medium preloader-centered" style="margin-top: -64px; display: none"></i>


                <div class="control-group">
                    <label class="control-label">ID на Таобао <i class="icon-question-sign ot_inline_help" data-toggle="popover" data-placement="top" data-content="Локальная помощь"></i></label>
                    <div class="controls"><!-- give this div style="visibility: hidden;" when searching for remote data -->
                        <input class="input-mini" type="text">
                    </div>
                </div>

                <div class="control-group">
                    <label class="control-label">Логотип <i class="icon-question-sign ot_inline_help" data-toggle="popover" data-placement="top" data-content="Локальная помощь"></i></label>
                    <div class="controls"><!-- give this div style="visibility: hidden;" when searching for remote data -->
                        <div class="fileupload fileupload-new" data-provides="fileupload">
                            <div class="fileupload-new thumbnail thumbnail-mini">
                                <div class="thumbnail-placeholder"><i class="icon-picture"></i></div>
                            </div>
                            <div class="fileupload-preview fileupload-exists thumbnail thumbnail-mini"></div>
                            <span class="btn btn-inverse btn-tiny btn-file">
                                <span class="fileupload-new">Выбрать</span>
                                <span class="fileupload-exists">Изменить</span>
                                <input type="file" />
                            </span>
                            <span class="btn btn-danger btn-tiny fileupload-exists" data-dismiss="fileupload">Удалить</span>
                        </div>
                    </div>
                </div>



            </div><!-- /. span6 -->

        </div><!-- /.row-fluid -->



        <div class="control-group">
            <label class="control-label bold">Описание <i class="icon-question-sign ot_inline_help" data-toggle="popover" data-placement="top" data-content="Локальная помощь"></i></label>
            <div class="controls">
                <textarea rows="10" class="input-xxlarge"></textarea>
            </div>
        </div>

        <div class="box box-blinked box-closed offset-top0 offset-bottom0">

            <div class="box-header corner-top">
                <i class="icon-caret-right font-13"></i>
                <a href="#" data-box="collapse" class="font-13 bold">
                    Атрибуты поисковой оптимизации
                </a>
            </div>

            <div class="box-body inset-horizontal-none inset-bottom0">

                <div class="control-group offset-top1">
                    <label class="control-label">Заголовок <i class="icon-question-sign ot_inline_help" data-toggle="popover" data-placement="top" data-content="Title"></i></label>
                    <div class="controls">
                        <input class="input-xlarge" type="text">
                    </div>
                </div>

                <div class="control-group">
                    <label class="control-label">Текст до заголовка <i class="icon-question-sign ot_inline_help" data-toggle="popover" data-placement="top" data-content="Текст выводимый на всех страницах до заголовка (до title)"></i></label>
                    <div class="controls">
                        <input class="input-xlarge" type="text">
                    </div>
                </div>

                <div class="control-group">
                    <label class="control-label">Текст после заголовка <i class="icon-question-sign ot_inline_help" data-toggle="popover" data-placement="top" data-content="Текст выводимый на всех страницах после заголовка (после title)"></i></label>
                    <div class="controls">
                        <input class="input-xlarge" type="text">
                    </div>
                </div>

                <div class="control-group">
                    <label class="control-label">Ключевые слова <i class="icon-question-sign ot_inline_help" data-toggle="popover" data-placement="top" data-content="Meta keywords"></i></label>
                    <div class="controls">
                        <textarea cols="20" rows="2" class="input-xxlarge"></textarea>
                    </div>
                </div>

                <div class="control-group">
                    <label class="control-label">Описание <i class="icon-question-sign ot_inline_help" data-toggle="popover" data-placement="top" data-content="Meta discription"></i></label>
                    <div class="controls">
                        <textarea cols="20" rows="2" class="input-xxlarge"></textarea>
                    </div>
                </div>

            </div>

        </div>


        <div class="controls offset-top2">
            <a href="cat/brands" class="btn btn-primary btn_preloader" data-loading-text="Сохранить">Сохранить</a>
            <button class="btn btn-primary btn_preloader" data-loading-text="Сохранить и добавить еще">Сохранить и добавить еще</button>
            <a href="cat/brands" type="button" class="btn offset-left2 btn_preloader" data-loading-text="Отменить">Отменить</a>
        </div>

    </form>

</div>