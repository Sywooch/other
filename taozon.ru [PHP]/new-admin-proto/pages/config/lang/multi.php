
<ul class="breadcrumb">
    <li><a href="."><i class="icon-home"></i></a> <span class="divider">›</span></li>
    <li><a href="config/build">Конфигурация</a> <span class="divider">›</span></li>
    <li><a href="config/lang/multi">Языки</a> <span class="divider">›</span></li>
    <li class="active">Мультиязычность</li>
</ul>
<!--/.breadcrumb-->

<? include('inc/sub_nav_config.php'); ?>


<!-- ot-sub-sub-nav -->
<div class="tabbable ot_sub_sub_nav">
    <ul class="nav nav-pills">
        <li class="active"><a href="config/lang/multi">Мультиязычность</a></li>
        <li><a href="config/lang/translate">Переводы</a></li>
    </ul>
</div><!-- /ot-sub-sub-nav -->

<h1>Мультиязычность</h1>

<div class="well">

<div class="row-fluid offset-bottom1">

    <div class="span3">

        <p><strong>Языки витрины</strong> <i class="icon-question-sign ot_inline_help" data-toggle="popover" data-placement="top" data-content="Модуль мультиязычности позволяет создавать версии сайтов на нескольких языках." title="" data-original-title=""></i></p>

            <ol class="unstyled ot_sortable_list ot_sortable">
                <li><span class="badge"><i class="icon-move" title="Перетащить"></i> Русский <i class="icon-remove" title="Удалить"></i></span></li>
                <li><span class="badge badge-success"><i class="icon-move" title="Перетащить"></i> Английский <i class="icon-remove" title="Удалить"></i></span></li>
                <li><span class="badge badge-success"><i class="icon-move" style="cursor: move" title="Перетащить"></i> Jezyk polski, polszczyzna (Polish)<i class="icon-remove" title="Удалить"></i></span></li>
            </ol>
    </div>

    <div class="span9">
        <p><strong>Добавить язык</strong></p>
        <div class="row-fluid">
        <select  class="input-large select_searched_list span4">
<!--            <option value="ru">Русский (Russian)</option>-->
            <option value="en" selected="selected">English (English)</option>
            <option value="mn">Монгол хэл (Mongolian)</option>
            <option value="cn">中国的 (Chinese)</option>
            <option value="es">Español (Spanish)</option>
            <option value="de">Deutsch (German)</option>
            <option value="pt">Português (Portuguese)</option>
            <option value="bg">Български (Bulgarian)</option>
            <option value="il">ברית (Hebrew)</option>
            <option value="am">հայերէն (Armenian)</option>
            <option value="saha">Саха тыла (Yakut)</option>
            <option value="pl">Jezyk polski, polszczyzna (Polish)</option>
            <option value="ge">ქართული ენა (Georgian)</option>
        </select>

        <button class="btn btn-small btn-primary offset-left1" title="Добавить дополнительный язык"  autocomplete="off"><i class="icon-plus"></i></button>
        </div>
    </div>

</div>

        <button type="submit" class="btn btn_preloader btn-primary" data-loading-text="Сохраняется" autocomplete="off">Сохранить</button>


</div>


<div class="alert alert-info">
    <h4>Реализация динамики</h4>
    <ul>
        <li>Плюсег добавляет в реальном времени язык в левую колонку и удаляет его из выпадающего списка;</li>
        <li>Зеленым маркируются только что добавленные языки;</li>
        <li>При хувере на активный язык в левой колонке, появляется крестик, который удаляет язык в реальном времени;</li>
        <li>После удаления элемента из активных языков, он появляется в списке возможных;</li>
        <li>Все изменения сохраняются только после сабмита кнопки <button type="button" class="btn btn-mini btn-primary">Сохранить</button>;</li>
        <li>Соответственно после сабмита должны быть запомнены веса включенных языков, если их меняли драг-н-дропом;</li>
        <li>Последний элемент в списке активных языков удалить нельзя. С точки зрения реализации это означает, что нужно скрыть нах крестик у единственно оставшегося языка-элемента;</li>
    </ul>
</div>



<!-- Страница стенсила откуда был вызят пример — http://bootsnipp.com/snipps/dynamic-form-fields -->
<!--<div class="box corner-all">

    <div class="box-body">


        <input type="hidden" name="count" value="1" />
        <div class="control-group" id="fields">
            <label class="control-label inline" for="field1"></label>
            <p class="text-info"><strong>Языки витрины</strong>: в преднабор для подсказок добавлены "Русский","English","Deutch" языки :)</p>
            <div class="controls" id="profs">
                <div class="input-append">
                    <input autocomplete="off" class="input-large" id="field1" name="prof1" type="text" placeholder="Выберите дополнительный язык" data-provide="typeahead" data-items="8"
                           data-source='["Русский","English","Deutch"]'/><button id="b1" onClick="addFormField()" class="btn btn-primary" type="button">+</button>
                </div>
                <br />
            </div>
        </div>

        <button type="submit" class="btn btn_preloader btn-primary" data-loading-text="Выполняется сохранение" autocomplete="off">Сохранить</button>

        <script type="text/javascript">
            var next = 1;
            function addFormField(){
                var addto = "#field" + next;
                next = next + 1;
                var newIn = '<br /><br />' +
                    '<input autocomplete="off" class="input-large" id="field' + next + '" name="field' + next + '" type="text" data-provide="typeahead" data-items="8">';
                var newInput = $(newIn);
                $(addto).after(newInput);
                $("#field" + next).attr('data-source',$(addto).attr('data-source'));
                $("#count").val(next);
            }
        </script>

    </div>
</div>-->


<!--
<div class="box corner-all">
    <div class="box-body">

        <img src="img/temp/multiple-select1.png" alt=""/>

    </div>
</div>

<div class="box corner-all">
    <div class="box-body">

        <div class="row-fluid">
            <div class="span12">
                <p><strong>Доступные языки витрины</strong> <i class="icon-question-sign ot_inline_help" data-toggle="popover" data-placement="top" data-content="Модуль мультиязычности позволяет создавать версии сайтов на нескольких языках." title="" data-original-title="Локальная помощь"></i></p>

                <form method="get" action="" class="form-horizontal">

                    <div class="control-group">
                        <div class="controls">
                            <input type="hidden" id="showcase_languages" class="span10"><button class="btn btn-info" type="button">+</button>
                        </div>
                    </div>
                    <div class="control-group">
                        <div class="controls">
                            <button type="submit" class="btn btn_preloader btn-primary" data-loading-text="Выполняется сохранение" autocomplete="off">Сохранить</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>

    </div>
</div>

<div class="box corner-all">
    <div class="box-body">

        <div class="alert alert-success">Как здесь — <a href="http://loudev.com/">http://loudev.com/</a></div>

    </div>
</div>

-->
<!--<h2>Рассматриваем альтернативные варианты множественного выбора</h2>

<ul>
    <li><a href="http://mind2soft.com/labs/jquery/multiselect/">http://mind2soft.com/labs/jquery/multiselect/</a></li>
    <li><a href="http://bootsnipp.com/snipps/dynamic-form-fields">http://bootsnipp.com/snipps/dynamic-form-fields</a></li>
    <li><a href="http://quasipartikel.at/multiselect/">http://quasipartikel.at/multiselect/</a></li>
    <li><a href="http://mind2soft.com/labs/jquery/multiselect/">http://mind2soft.com/labs/jquery/multiselect/</a></li>
    <li><a href="http://quasipartikel.at/multiselect_next/">http://quasipartikel.at/multiselect_next/</a></li>
    <li><a href="http://jsfiddle.net/xBB5x/40/">http://jsfiddle.net/xBB5x/40/</a></li>
    <li><a href="http://jsfiddle.net/xBB5x/329/">http://jsfiddle.net/xBB5x/329/</a></li>
    <li><a href="http://silviomoreto.github.io/bootstrap-select/">http://silviomoreto.github.io/bootstrap-select/</a></li>
    <li><a href="http://welldonethings.com/tags/manager">http://welldonethings.com/tags/manager</a></li>
    <li><a href="http://webersoft.ru/lab/multiselect/index.html">http://webersoft.ru/lab/multiselect/index.html</a></li>
</ul>-->

