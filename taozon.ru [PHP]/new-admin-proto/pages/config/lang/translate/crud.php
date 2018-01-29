
<ul class="breadcrumb">
    <li><a href="."><i class="icon-home"></i></a> <span class="divider">›</span></li>
    <li><a href="config/build">Конфигурация</a> <span class="divider">›</span></li>
    <li><a href="config/lang/multi">Языки</a> <span class="divider">›</span></li>
    <li><a href="config/lang/translate">Переводы</a> <span class="divider">›</span></li>
    <li class="active">Добавление/редактирование перевода</li>
</ul>
<!--/.breadcrumb-->

<? include('inc/sub_nav_config.php'); ?>


<!-- ot-sub-sub-nav -->
<div class="tabbable ot_sub_sub_nav">
    <ul class="nav nav-pills">
        <li><a href="config/lang/multi">Мультиязычность</a></li>
        <li class="active"><a href="config/lang/translate">Переводы</a></li>
    </ul>
</div><!-- /ot-sub-sub-nav -->

<h1>Добавление/редактирование перевода</h1>

<div class="well">
    <form method="post" action="config/lang/translate" class="form-horizontal ot_form">
        <fieldset>

        <!-- Form Name -->
<!--        <legend>Редактирование перевода</legend>-->

        <!-- developer's prescription -->
        <div class="alert alert-info">
            <button data-dismiss="alert" class="close" type="button">×</button>
            Редактирование существующего <strong>системного</strong> ключа
        </div><!-- /developer prescription -->

        <!-- changing form part -->
        <div class="control-group">
            <label class="control-label" for="ot_translation_key">Ключ</label>
            <div class="controls">
                <input id="ot_translation_key" name="textinput" placeholder="about_us" disabled="disabled" class="input-xlarge" type="text">
            </div>
        </div><!-- /changing form part -->


        <!-- developer's prescription -->
        <div class="alert alert-info">
            <button data-dismiss="alert" class="close" type="button">×</button>
            Редактирование/создание <strong>пользовательского</strong> ключа
        </div><!-- /developer prescription -->

        <!-- changing form part -->
        <div class="control-group">
            <label class="control-label" for="ot_translation_key">Ключ</label>
            <div class="controls">
                <input id="ot_translation_key" name="textinput" class="input-xlarge" type="text" value="empty/about_us">
            </div>
        </div><!-- /changing form part -->



        <!-- Textarea -->
        <div class="control-group">
            <label class="control-label" for="ot_russian_translation">Русский</label>
            <div class="controls">
                <textarea id="ot_russian_translation" name="textarea" class="input-xlarge">О нас как о разделе сайта</textarea>
            </div>
        </div>

        <!-- Textarea -->
        <div class="control-group">
            <label class="control-label" for="ot_english_translation">Английский</label>
            <div class="controls">
                <textarea id="ot_english_translation" name="textarea" class="input-xlarge">About us</textarea>
            </div>
        </div>

        <!-- Textarea -->
        <div class="control-group">
            <label class="control-label" for="ot_deutsch_translation">Немецкий</label>
            <div class="controls">
                <textarea id="ot_deutsch_translation" name="textarea" class="input-xlarge" placeholder="Перевод отсутствует"></textarea>
            </div>
        </div>

        <!-- Button (Double) -->
        <div class="control-group">
            <div class="controls">
                <button id="save" name="save" class="btn btn-primary">Сохранить</button>
                <button id="cancel" name="cancel" class="btn btn-default offset-left1">Отменить</button>
            </div>
        </div>

    </fieldset>
    </form>
</div>


