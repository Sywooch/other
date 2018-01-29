
<ul class="breadcrumb">
    <li><a href="."><i class="icon-home"></i></a> <span class="divider">›</span></li>
    <li><a href="promo/seo">Продвижение</a> <span class="divider">›</span></li>
    <li><a href="promo/mailing/list">Рассылки</a> <span class="divider">›</span></li>
    <li><a href="promo/mailing/list">Список рассылок</a> <span class="divider">›</span></li>
    <li class="active">Создание / редактирование рассылки «Название рассылки»</li>
</ul>
<!--/.breadcrumb-->

<? include('inc/sub_nav_promo.php'); ?>

<div class="ot_sub_sub_nav">
    <ul class="nav nav-pills">
        <li class="active"><a href="promo/mailing/list">Список рассылок</a></li>
        <li><a href="promo/mailing/subscribers">Подписчики</a></li>
        <li><a href="promo/mailing/config">Настройки</a></li>
    </ul>
</div>

<h1>Создание / редактирование рассылки «Название рассылки»</h1>

<div class="well">

    <form method="post" action="" class="form-horizontal ot_form">

        <div class="control-group">
            <label class="control-label">Тема</label>
            <div class="controls">
                <input class="input-xxlarge" type="text" required="required" title="Обязательное поле">
            </div>
        </div>

        <div class="control-group">
            <label class="control-label">Текст письма</label>
            <div class="controls">
                <textarea cols="30" rows="10" class="input-xxlarge"></textarea>
            </div>
        </div>

        <div class="control-group">
            <label class="control-label">Эл. адрес для тестового письма <i class="icon-question-sign ot_inline_help" data-toggle="popover" data-placement="bottom" data-content="Локальная подсказка"></i></label>
            <div class="controls">
                <input class="input-large" type="text" placeholder="admin-mail@domain.ltd">
                <button type="submit" class="btn btn_preloader" data-loading-text="<i class='icon-share-alt'></i> Протестировать" title="Отправить рассылку на тестовый адрес"><i class="icon-share-alt"></i> Протестировать</button>
            </div>
        </div>


        <div class="form-actions">
                <a href="promo/mailing/list" class="btn btn-primary btn_preloader" data-loading-text="Сохранить">Сохранить</a>
                <a href="promo/mailing/list" class="btn btn-primary btn_preloader offset-left05 " data-loading-text="<i class='icon-envelope-alt font-14'></i> Разослать"> <i class="icon-envelope-alt font-14"></i> Разослать</a>
                <a href="promo/mailing/list" type="button" class="btn offset-left3 btn_preloader" data-loading-text="Отменить">Отменить</a>
        </div>
    </form>

</div>