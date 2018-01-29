
<ul class="breadcrumb">
    <li><a href="."><i class="icon-home"></i></a> <span class="divider">›</span></li>
    <li><a href="orders/list">Заказы</a> <span class="divider">›</span></li>
    <li><a href="orders/order">№ ORD-0000001356</a> <span class="divider">›</span></li>
    <li class="active">Редактирование—создание посылки № 123</li>
</ul>
<!--/.breadcrumb-->

<h1>Редактирование—создание посылки № 123</h1>


<div class="well">

    <form method="post" action="users/customers" class="form-horizontal ot_form">

    <fieldset>

     <div class="row-fluid">

        <div class="span6">

            <legend>Посылка</legend>

            <div class="control-group">
                <label class="control-label">Трекинг-номер <i class="icon-question-sign ot_inline_help" data-toggle="popover" data-placement="top" data-content="Локальная подсказка"></i></label>
                <div class="controls">
                    <input class="input-medium" type="text">
                </div>
            </div>

            <div class="control-group">
                <label class="control-label">Статус <i class="icon-question-sign ot_inline_help" data-toggle="popover" data-placement="top" data-content="Локальная подсказка"></i></label>
                <div class="controls">
                    <select name="" id="" class="input-medium">
                        <option value="">Создана</option>
                        <option value="">Упакована</option>
                        <option value="">Подготовлена</option>
                        <option value="">Отправлена</option>
                    </select>
                </div>
            </div>

            <div class="control-group">
                <label class="control-label">Способ доставки <i class="icon-question-sign ot_inline_help" data-toggle="popover" data-placement="top" data-content="Локальная подсказка"></i></label>
                <div class="controls">
                    <select name="" id="" class="input-xlarge">
                        <option value="">China Post Airmail. Сервис доставки посылок весом до 2 кг.</option>
                        <option value="">Международная служба доставки China Post</option>
                        <option value="">Международная служба доставки EMS</option>
                    </select>
                </div>
            </div>

            <div class="control-group">
                <label class="control-label">Вес <i class="icon-question-sign ot_inline_help" data-toggle="popover" data-placement="top" data-content="Локальная подсказка"></i></label>
                <div class="controls">
                    <div class="input-append">
                        <input class="input-mini" type="text">
                        <span class="add-on">кг</span>
                    </div>
                </div>
            </div>

            <div class="control-group">
                <label class="control-label">Стоимость <i class="icon-question-sign ot_inline_help" data-toggle="popover" data-placement="top" data-content="Локальная подсказка"></i></label>
                <div class="controls">
                    <div class="input-append">
                        <input class="input-mini" type="text">
                        <span class="add-on">$</span>
                    </div>
                </div>
            </div>


            <div class="control-group">
                <label class="control-label">Дополнительная информация <i class="icon-question-sign ot_inline_help" data-toggle="popover" data-placement="top" data-content="Локальная подсказка"></i></label>
                <div class="controls">
                    <textarea rows="4" class="input-xlarge"></textarea>
                </div>
            </div>

        </div>

        <div class="span6">

            <legend>
                Профиль покупателя <i class="icon-question-sign ot_inline_help" data-toggle="popover" data-placement="top" data-content="Локальная подсказка"></i>
                <select class="input-large pull-right">
                    <option value="user-profile-1">Профиль 1</option>
                    <option value="user-profile-2">Профиль 2</option>
                    <option value="user-profile-3">Профиль 3</option>
                </select>
            </legend>

            <legend class="legend-mini">Адрес</legend>

            <div class="control-group">
                <label class="control-label">Страна</label>
                <div class="controls">
                    <input class="input-medium" type="text">
                </div>
            </div>

            <div class="control-group">
                <label class="control-label">Регион</label>
                <div class="controls">
                    <input class="input-medium" type="text">
                </div>
            </div>

            <div class="control-group">
                <label class="control-label">Город</label>
                <div class="controls">
                    <input class="input-medium" type="text">
                </div>
            </div>

            <div class="control-group">
                <label class="control-label">Адрес</label>
                <div class="controls">
                    <input class="input-xlarge" type="text">
                </div>
            </div>

            <div class="control-group">
                <label class="control-label">Почтовый индекс</label>
                <div class="controls">
                    <input class="input-mini" type="text">
                </div>
            </div>

            <legend class="legend-mini">Личные данные</legend>

            <div class="control-group">
                <label class="control-label">Имя</label>
                <div class="controls">
                    <input class="input-medium" type="text">
                </div>
            </div>

            <div class="control-group">
                <label class="control-label">Фамилия</label>
                <div class="controls">
                    <input class="input-medium" type="text">
                </div>
            </div>

            <div class="control-group">
                <label class="control-label">Отчество</label>
                <div class="controls">
                    <input class="input-medium" type="text">
                </div>
            </div>

            <div class="control-group">
                <label class="control-label">Телефон</label>
                <div class="controls">
                    <div class="input-prepend">
                        <span class="add-on"><i class="icon-phone"></i></span>
                        <input class="input-medium" type="text">
                    </div>
                </div>
            </div>


        </div><!-- /.span6 -->

    </div><!-- /.row-fluid -->

    </fieldset>


    <div class="control-group offset-top2">
        <div class="controls">
            <a href="orders/order" type="button" class="btn btn-primary btn_preloader" data-loading-text="Сохраняется">Сохранить</a><!-- never use link for buttons. It's done only for prototype to gain interactivity. On production use <input type="button" class="btn btn-primary btn_preloader" data-loading-text="Сохраняется"> or <button type="button" class="btn btn-primary btn_preloader" data-loading-text="Сохраняется">Сохранить</button> -->
            <a href="orders/order" class="btn offset-left1 btn_preloader" data-loading-text="Отменяется">Отменить</a><!-- never use link for buttons. It's done only for prototype to gain interactivity. On production use <input type="button" type="button" class="btn offset1 btn_preloader" data-loading-text="Отменяется"> or <button type="button" class="btn offset1 btn_preloader" data-loading-text="Отменяется">Отменить</button> -->
        </div>
    </div>


</form>

</div>
