
<ul class="breadcrumb">
    <li><a href="."><i class="icon-home"></i></a> <span class="divider">›</span></li>
    <li><a href="config/build">Конфигурация</a> <span class="divider">›</span></li>
    <li><a href="config/system/general">Cистема</a> <span class="divider">›</span></li>
    <li class="active">Общие</li>
</ul>
<!--/.breadcrumb-->

<? include('inc/sub_nav_config.php'); ?>



<!-- ot-sub-sub-nav -->
<div class="tabbable ot_sub_sub_nav">
    <ul class="nav nav-pills">
        <li class="active"><a href="config/system/general">Общие</a></li>
        <li><a href="config/system/cache">Кеширование</a></li>
        <li><a href="config/system/update">Обновление</a></li>
    </ul>
</div><!-- /ot-sub-sub-nav -->

<h1>Общие</h1>

<!-- caching configuration -->
<div class="well">

    <form class="form-horizontal inline_editable_form ot_form">
            <div class="row-fluid">


                <fieldset class="span6">

                    <div class="control-group control-group-medium">
                        <label class="control-label">Отладочная информация <i class="icon-question-sign ot_inline_help" data-toggle="popover" data-placement="top" data-content="Это локальная подсказка, призванная пояснять пользователям назначение элементов." title="" data-original-title="Локальная помощь"></i></label>
                        <div class="controls">
                            <a class="ot_inline_select_editable" href="#" data-type="select" data-pk="2" data-url="/post" data-original-title="Enter something">Скрывать</a>
                            <!--<select id="" name="" class="input-medium">
                                <option>Отображать</option>
                                <option>Скрывать</option>
                            </select>-->
                        </div>
                    </div>

                    <div class="control-group control-group-medium">
                        <label class="control-label">Сайт на обслуживании <i class="icon-question-sign ot_inline_help" data-toggle="popover" data-placement="top" data-content="Это локальная подсказка, призванная пояснять пользователям назначение элементов." title="" data-original-title="Локальная помощь"></i></label>
                        <div class="controls">
                            <a class="ot_inline_select_editable" href="#" data-type="select" data-pk="2" data-url="/post" data-original-title="Enter something">Выключить</a>
                            <!--<select id="" name="" class="input-medium">
                                <option>Выключить</option>
                                <option>Включить</option>
                            </select>-->
                        </div>
                    </div>


                    <div class="control-group control-group-medium">
                        <label class="control-label">Переадресация после авторизации <i class="icon-question-sign ot_inline_help" data-toggle="popover" data-placement="top" data-content="Это локальная подсказка, призванная пояснять пользователям назначение элементов." title="" data-original-title="Локальная помощь"></i></label>
                        <div class="controls">
                            <a class="ot_inline_select_editable" href="#" data-type="select" data-pk="2" data-url="/post" data-original-title="Enter something">В личный кабинет</a>
                            <!--<select id="" name="" class="input-medium">
                                <option>В личный кабинет</option>
                                <option>На главную</option>
                            </select>-->
                        </div>
                    </div>

                </fieldset>


                <fieldset class="span6">

                    <legend class="legend-mini">Комментарии для товаров</legend>
                    <div class="control-group control-group-medium">
                        <label class="control-label">Эл. адрес администратора <i class="icon-question-sign ot_inline_help" data-toggle="popover" data-placement="top" data-content="Это локальная подсказка, призванная пояснять пользователям назначение элементов." title="" data-original-title="Локальная помощь"></i></label>
                        <div class="controls">
                            <a class="ot_inline_text_editable" href="#" data-type="text" data-pk="2" data-url="/post" data-original-title="Enter something" data-placeholder="example@domain.tld"></a>
                        </div>
                    </div>

                    <div class="control-group control-group-medium">
                        <label class="control-label">Эл. адрес откуда будут приходить комментарии <i class="icon-question-sign ot_inline_help" data-toggle="popover" data-placement="top" data-content="Это локальная подсказка, призванная пояснять пользователям назначение элементов." title="" data-original-title="Локальная помощь"></i></label>
                        <div class="controls">
                            <a class="ot_inline_text_editable" href="#" data-type="text" data-pk="2" data-url="/post" data-original-title="Enter something" data-placeholder="example@domain.tld"></a>
                        </div>
                    </div>
                </fieldset>

            </div>

        </form>

</div>

