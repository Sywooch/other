
<ul class="breadcrumb">
    <li><a href="."><i class="icon-home"></i></a> <span class="divider">›</span></li>
    <li><a href="content/pages">Содержание</a> <span class="divider">›</span></li>
    <li class="active">Редактирование страницы</li>

</ul>
<!--/.breadcrumb-->

<? include('inc/sub_nav_content.php'); ?>


<h1>Редактирование страницы</h1>

<div class="well">

    <form method="post" action="" class="form-horizontal ot_form">

        <div class="control-group">
            <label class="control-label bold">Заголовок <i class="icon-question-sign ot_inline_help" data-toggle="popover" data-placement="top" data-content="Локальная помощь"></i></label>
            <div class="controls">
                <input class="input-xlarge" type="text" required="required" value="Оплата успешно произведена">
            </div>
        </div>

        <div class="control-group">
            <label class="control-label bold">Адрес <i class="icon-question-sign ot_inline_help" data-toggle="popover" data-placement="top" data-content="Локальная помощь"></i></label>
            <div class="controls">
                <input class="input-xlarge" type="text" required="required" value="paymentfail" disabled="disabled">
            </div>
        </div>

        <div class="control-group">
            <label class="control-label bold">Язык <i class="icon-question-sign ot_inline_help" data-toggle="popover" data-placement="top" data-content="Локальная помощь"></i></label>
            <div class="controls">

                <select class="input-medium" disabled="disabled">
                    <option value="lang_ru">Русский</option>
                    <option value="lang_eng">English</option>
                    <option value="lang_ch">桔色 尺码</option>
                </select>

            </div>
        </div>

        <div class="control-group">
            <label class="control-label bold">Содержание</label>
            <div class="controls">
                <textarea cols="30" rows="10" class="input-xxlarge">Ваш счет уcпешно пополнен!</textarea>
            </div>
        </div>





        <div class="controls">
            <a href="content/pages" class="btn btn-primary btn_preloader" data-loading-text="Сохранить">Сохранить</a>
            <a href="content/pages" type="button" class="btn offset-left2 btn_preloader" data-loading-text="Отменить">Отменить</a>
        </div>

    </form>

</div>