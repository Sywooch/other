
<ul class="breadcrumb">
    <li><a href="."><i class="icon-home"></i></a> <span class="divider">›</span></li>
    <li><a href="promo/seo">Продвижение</a> <span class="divider">›</span></li>
    <li><a href="promo/mailing/list">Рассылки</a> <span class="divider">›</span></li>
    <li class="active">Настройки</li>
</ul>
<!--/.breadcrumb-->

<? include('inc/sub_nav_promo.php'); ?>

<div class="ot_sub_sub_nav">
    <ul class="nav nav-pills">
        <li><a href="promo/mailing/list">Список рассылок</a></li>
        <li><a href="promo/mailing/subscribers">Подписчики</a></li>
        <li class="active"><a href="promo/mailing/config">Настройки</a></li>
    </ul>
</div>

<h1>Настройки</h1>

        <div class="well">

            <form class="form-horizontal ot_form">

                <div class="control-group">
                    <label class="control-label">Количество писем <i class="icon-question-sign ot_inline_help" data-toggle="popover" data-placement="top" data-content="Количество писем, которые отправляет сервер за одну часть. Ввиду ограничения на рассылку большого количества писем одновременно, обычно создается очередь, которая рассылается сервером по частям."></i></label>
                    <div class="controls">
                        <input type="text" class="input-mini" placeholder="10">
                    </div>
                </div>

                <div class="control-group">
                    <div class="controls">
                        <label class="checkbox inline" data-toggle="collapse" data-target=".ot-smtp-settings-form">
                            <input type="checkbox">Использовать SMTP-сервер
                        </label>
                        <i class="icon-question-sign ot_inline_help" data-toggle="popover" data-placement="top" data-content="Локальная подсказка"></i>
                    </div>
                </div>

                <div class="ot-smtp-settings-form collapse">

                    <div class="control-group">
                        <label class="control-label" for="ot_smtp_server">Адрес SMTP-сервера</label>
                        <div class="controls">
                            <input type="text" class="input-medium" id="ot_smtp_server">
                        </div>
                    </div>

                    <div class="control-group">
                        <label class="control-label" for="ot_smtp_server_port">Порт SMTP-сервера</label>
                        <div class="controls">
                            <input type="text" class="input-mini" id="ot_smtp_server_port">
                        </div>
                    </div>

                    <div class="control-group">
                        <label class="control-label" for="ot_smtp_server_port">Пользователь</label>
                        <div class="controls">
                            <input type="text" class="input-medium" id="ot_smtp_server_user">
                        </div>
                    </div>

                    <div class="control-group">
                        <label class="control-label" for="ot_smtp_server_port">Пароль</label>
                        <div class="controls">
                            <input type="text" class="input-medium" id="ot_smtp_server_password">
                        </div>
                    </div>

                    <div class="control-group">
                        <div class="controls">
                            <label class="checkbox inline">
                                <input type="checkbox">Использовать ssl
                            </label>
                            <i class="icon-question-sign ot_inline_help" data-toggle="popover" data-placement="top" data-content="Локальная подсказка"></i>
                        </div>
                    </div>

                </div>

                <div class="control-group">
                    <div class="controls">
                        <span class="btn btn-primary btn_preloader" data-loading-text="Сохранить">Сохранить</span>
                    </div>
                </div>



            </form>

        </div>



<? include('inc/pager.php'); ?>
