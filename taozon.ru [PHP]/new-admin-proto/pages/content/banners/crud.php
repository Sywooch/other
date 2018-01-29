
<ul class="breadcrumb">
    <li><a href="."><i class="icon-home"></i></a> <span class="divider">›</span></li>
    <li><a href="content/pages">Содержание</a> <span class="divider">›</span></li>
    <li><a href="content/banners">Баннеры</a> <span class="divider">›</span></li>
    <li class="active">Добавление / редактирование баннера</li>
</ul>
<!--/.breadcrumb-->

<? include('inc/sub_nav_content.php'); ?>


<h1>Добавление / редактирование баннера</h1>

<div class="well">

    <form method="post" action="" class="form-horizontal ot_form">

        <div class="control-group">
            <label class="control-label bold">Название <i class="icon-question-sign ot_inline_help" data-toggle="popover" data-placement="top" data-content="Локальная помощь"></i></label>
            <div class="controls">
                <input class="input-xlarge" type="text" required="required" title="Обязательное поле">
            </div>
        </div>

        <div class="control-group">
            <label class="control-label bold">Изображение <i class="icon-question-sign ot_inline_help" data-toggle="popover" data-placement="top" data-content="Локальная помощь"></i></label>
            <div class="controls">
                <div class="fileupload fileupload-new" data-provides="fileupload">
                    <div class="fileupload-new thumbnail thumbnail-mini">
                        <div class="thumbnail-placeholder"><i class="icon-picture"></i></div>
                    </div>
                    <div class="fileupload-preview fileupload-exists thumbnail thumbnail-mini"></div>
                    <span class="btn btn-primary btn-tiny btn-file">
                        <span class="fileupload-new">Выбрать</span>
                        <span class="fileupload-exists">Изменить</span>
                        <input type="file" />
                    </span>
                    <span class="btn btn-danger btn-tiny fileupload-exists" data-dismiss="fileupload">Удалить</span>
                </div>
            </div>
        </div>

        <div class="control-group">
            <label class="control-label bold">Ссылка <i class="icon-question-sign ot_inline_help" data-toggle="popover" data-placement="top" data-content="Локальная помощь"></i></label>
            <div class="controls">
                <input class="input-xlarge" type="text">
                <div class="btn-group">
                    <span type="button" data-toggle="button" class="btn" title="Указать страницу каталога"><i class="icon-list-alt font-14"></i></span>
                    <span type="button" data-toggle="button" class="btn" title="Указать раздел сайта"><i class="icon-file-alt font-14"></i></span>
                </div>
            </div>
        </div>

        <div class="control-group">
            <label class="control-label bold">Язык <i class="icon-question-sign ot_inline_help" data-toggle="popover" data-placement="top" data-content="Локальная помощь"></i></label>
            <div class="controls">

                <select class="input-medium">
                    <option value="lang_ru">Русский</option>
                    <option value="lang_eng">English</option>
                    <option value="lang_ch">桔色 尺码</option>
                </select>

            </div>
        </div>

        <div class="controls">
            <a href="content/banners" class="btn btn-primary btn_preloader" data-loading-text="Сохранить">Сохранить</a>
            <a href="content/banners" type="button" class="btn offset-left2 btn_preloader" data-loading-text="Отменить">Отменить</a>
        </div>

    </form>

</div>