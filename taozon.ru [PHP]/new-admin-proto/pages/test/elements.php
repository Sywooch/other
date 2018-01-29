
<h1>Элементы</h1>

<div class="alert alert-success" style="color: #000; background: #F5F5F5">
    <button type="button" class="close" data-dismiss="alert">&times;</button>
    Собираю здесь все насущные элементы которые требуются для реализации непосредственно на бою.
</div>
<!-- Конец вступительного блока с инструкциями -->

<h2>Спойлер</h2>

<div class="row-fluid">
    <div class="span6">
        <strong class="ot-spoiler ot-spoiler-iconed blink" data-toggle="collapse" data-target=".ot-spoiler">
            <i class="icon-caret-right"></i>Спойлер</strong>
        <span class="ot-spoiler ot-spoiler-iconed" data-toggle="collapse" data-target=".ot-spoiler">
            <i class="icon-caret-right"></i>Спойлер не блинк с картинкой</span>
        <span class="ot-spoiler blink" data-toggle="collapse" data-target=".ot-spoiler">
            Спойлер блинк без картинки
        </span>

    </div>
    <div class="span6">
        <span class="ot-spoiler blink blink-iconed" data-toggle="collapse" data-target=".ot-spoiler"><i class="icon-link"></i>Спойлер блинк с другой пиктограммой</span>
        <span class="blink blink-iconed"><i class="icon-male"></i>Блинк с иконкой не спойлер</span>
    </div>
</div>

<div class="ot-spoiler collapse">
    <strong>Содержание спойлера</strong>
</div>


<h2>Ladda</h2>
<button class="btn ladda-button" data-style="expand-right"><span class="ladda-label">Submit</span></button>
<button class="btn ladda-button ladda-progress-button" data-style="expand-right"><span class="ladda-label">Submit</span></button>
<button class="btn ladda-button ladda-progress-button" data-style="contract-overlay" style="z-index: 10;"><span class="ladda-label">Submit</span></button>


<h2>Примеры работы плагина bootstrap-dropdown-ext.js расширяющего применение дропдаунов</h2>

<div class="row-fluid">

    <div class="span6">
        <input type="button" value="Dropdown" data-dropdown="#dropdown-1" />

        <div id="dropdown-1" class="dropdown dropdown-tip">
            <ul class="dropdown-menu">
                <li><a href="#1">Item 1</a></li>
                <li><a href="#2">Item 2</a></li>
                <li><a href="#3">Item 3</a></li>
                <li class="dropdown-divider"></li>
                <li><a href="#4">Item 4</a></li>
                <li><a href="#5">Item 5</a></li>
                <li><a href="#5">Item 6</a></li>
            </ul>
        </div>

        <div class="btn-group">
            <button data-dropdown="#dropdown-anything-test" data-toggle="dropdown" class="btn btn-tiny btn-primary dropdown-toggle"><i class="icon-star-empty"></i> Новый дропдаун <span class="caret"></span></button>
        </div>

        <div id="dropdown-anything-test" class="dropdown dropdown-tip dropdown-anchor-right">
            <div class="dropdown-panel">
                div class="dropdown-panel"
            </div>
        </div>
    </div>

    <div class="span6">

        <div class="btn-group">
            <button data-toggle="dropdown" class="btn btn-tiny btn-success dropdown-toggle"><i class="icon-star-empty"></i> Изменить статус <span class="caret"></span></button>
            <ul class="dropdown-menu dropdown-menu-large">
                <li><a href="#">Ожидает оплаты</a></li>
                <li><a href="#">Оплачен</a></li>
                <li><a href="#">Подтверждение цены</a></li>
                <li><a href="#">Заказан</a></li>
                <li><a href="#">Проверка качества</a></li>
                <li><a href="#">Получен на склад</a></li>
                <li><a href="#">Упаковка</a></li>
                <li><a href="#">Готов к отправке</a></li>
                <li><a href="#">Отправлен</a></li>
                <li><a href="#">Получен</a></li>
                <li><a href="#">Возвращен продавцу</a></li>
                <li><a href="#">Невозможно поставить</a></li>
                <li><a href="#">Отменен</a></li>
            </ul>
        </div>
        <br/>
        А это дропдаун из коробки бутстрапа. Новый дропдаун и из коробки имеют негармоничное поведение с точки зрения скрытия дропдауна :( Было бы круто, если бы они в будущем договорились скрывать их одинаково.

    </div>

</div>

<!-- **************************************************** -->


<h2>Системные сообщения в контентной части</h2>

<div class="alert alert-error">
    <button type="button" class="close" data-dismiss="alert">&times;</button>
    <h4>Что-то пошло не так</h4>
    Лучше, конечно, чтобы причина была ясна, чтобы юзер мог бодро скопировать текст причинны суппорту. Если причину определить нельзя — успокоить пользователя, рассказать о возвожных причинах и возможных действиях.
</div>

<div class="alert alert-block">
    <button type="button" class="close" data-dismiss="alert">&times;</button>
    <h4>Предупреждение!</h4>
    Использовать в ситуациях, когда нам есть о чем предупредить пользователя. Если мы что-то сохраняли при этом, то в тексте нужно явно расписать, что вот это сохранилось, но тем не менее учтите вот это и вот это.
</div>

<div class="alert alert-success">
    <button type="button" class="close" data-dismiss="alert">&times;</button>
    Данный месадж мы выводим для успешной обратной связи системы на действия пользователя при серверной реализации логики.
</div>

<div class="alert alert-info">
    <button type="button" class="close" data-dismiss="alert">&times;</button>
    Это информационный блок, аналогичный автомобильному знаку «Рекомендуемые» :)
</div>


