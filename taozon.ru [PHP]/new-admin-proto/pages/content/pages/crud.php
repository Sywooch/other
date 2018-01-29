
<ul class="breadcrumb">
    <li><a href="."><i class="icon-home"></i></a> <span class="divider">›</span></li>
    <li><a href="content/pages">Содержание</a> <span class="divider">›</span></li>
    <li class="active">Добавление / редактирование страницы</li>

</ul>
<!--/.breadcrumb-->

<? include('inc/sub_nav_content.php'); ?>


<h1>Добавление / редактирование страницы</h1>

<div class="well">

    <form method="post" action="" class="form-horizontal ot_form">

        <div class="control-group">
            <label class="control-label bold">Название <i class="icon-question-sign ot_inline_help" data-toggle="popover" data-placement="top" data-content="Локальная помощь"></i></label>
            <div class="controls">
                <input class="input-xlarge" type="text" required="required" title="Обязательное поле">
            </div>
        </div>

        <div class="control-group">
            <label class="control-label bold">Адрес <i class="icon-question-sign ot_inline_help" data-toggle="popover" data-placement="top" data-content="Локальная помощь"></i></label>
            <div class="controls">
                <input class="input-xlarge" type="text" required="required" title="Обязательное поле">
            </div>
        </div>

        <div class="control-group">

            <label class="control-label bold">Является <i class="icon-question-sign ot_inline_help" data-toggle="popover" data-placement="top" data-content="Локальная помощь"></i></label>

            <div class="controls">

                <select class="input-medium">
                    <option value="page">Разделом</option>
                    <option value="sub_page">Подразделом</option>
                </select>

                в меню
                <select class="input-medium">
                    <option value="top_nav">Верхнее</option>
                    <option value="sidebar_nav">В колонке</option>
                    <option value="bottom_nav">Нижнее</option>
                    <option value="without_nav">Не добавлять</option>
                </select>

            </div>
        </div>

        <div class="control-group">

            <div class="controls">

                <select class="input-medium">
                    <option value="sub_page">Подразделом</option>
                    <option value="page">Разделом</option>
                </select>

                для

                <select class="input-medium">
                    <option value="about">О магазине</option>
                    <option value="articles">Статьи</option>
                    <option value="how_to-order">Как сделать заказ</option>
                </select>

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

        <div class="box box-blinked box-closed offset-top0 offset-bottom1_2">

            <div class="box-header corner-top">
                <i class="icon-caret-right font-13"></i>
                <a href="#" data-box="collapse" class="font-13 bold">
                    Атрибуты поисковой оптимизации
                </a>
            </div>

            <div class="box-body inset-horizontal-none">

                <div class="control-group">
                    <label class="control-label">Заголовок <i class="icon-question-sign ot_inline_help" data-toggle="popover" data-placement="top" data-content="Title"></i></label>
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

        <div class="control-group">
            <label class="control-label bold">Содержание</label>
            <div class="controls">
                <textarea cols="30" rows="10" class="input-xxlarge"></textarea>
            </div>
        </div>





        <div class="controls">
            <a href="content/pages" class="btn btn-primary btn_preloader" data-loading-text="Сохранить">Сохранить</a>
            <a href="content/pages" type="button" class="btn offset-left2 btn_preloader" data-loading-text="Отменить">Отменить</a>
        </div>

    </form>

</div>