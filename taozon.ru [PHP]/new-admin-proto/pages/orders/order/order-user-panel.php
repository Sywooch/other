<!-- User's info -->

<dl class="dl-horizontal dl-ot-horizontal offset-top01 offset-bottom05">
    <p><strong><i class="icon-user"></i> <a href="users/customers/user-profile" title="Профиль пользователя">Николай Гоголь</a></strong></p>
    <dt>Номер счета</dt>
    <dd>USR-0000000030</dd>

    <dt>Баланс</dt>
    <dd>

        <span class="inline-block label weight-normal font-12">33.78 $</span>

        <div class="btn-group">
            <div class="btn-group pull-right">
                <button data-toggle="dropdown" class="btn btn-mini dropdown-toggle" title="Действия с покупателем"><i class="icon-cog"></i> <span class="caret"></span></button>
                <ul class="dropdown-menu">
                    <!-- Не пойму как сделать так, чтобы на ссылках отрабатывался тоглинг форм добавления—снятия средств :( На продакшн обязательно добавить атрибут href и решить проблемы отработки расскладухи на ссылках -->
                    <li><a _href="#" data-toggle="collapse" data-target=".credit-user-account-form" title="Зачислить средства на счет пользователя"><i class="icon-plus-sign"></i> <span class="font-12">Пополнить счет</span></a></li>
                    <li><a _href="#" data-toggle="collapse" data-target=".debit-user-account-form" title="Снять средства со счета пользователя"><i class="icon-minus-sign"></i> <span class="font-12">Списать средства</span></a></li>
                    <li class="divider"></li>
                    <li><a _href="#" title="Оплатить заказ пользователя"><i class="icon-ok"></i> <span class="font-12">Оплатить заказ</span></a></li>
                </ul>
            </div>
        </div>

    </dd>

    <!--credit-user-account-form-->
    <div class="collapse credit-user-account-form font-12">
        <form class="form-horizontal">
            <h4 class="font-13">Пополнение счета</h4>
            <dl>
                <dt class="text-success">Сумма</dt>
                <dd><input type="text" class="input-mini"></dd>
                <dt class="text-success">Примечание</dt>
                <dd><textarea class="input-medium" rows="2"></textarea></dd>
                <dd>
                    <div class="offset-top05">
                        <button autocomplete="off" data-loading-text="Зачислить" class="btn btn-mini btn-primary btn_preloader" type="button">Зачислить</button>
                        <button class="btn btn-mini" type="button" data-toggle="collapse" data-target=".credit-user-account-form">Отменить</button>
                    </div>
                </dd>
            </dl>
        </form>
    </div>

    <!--debit-user-account-form-->
    <div class="collapse debit-user-account-form font-12">
        <form class="form-horizontal offset-top1 offset-bottom2">
            <h4 class="font-13">Списание средств</h4>
            <dl>
            <dt class="text-error">Сумма</dt>
            <dd><input type="text" class="input-mini"></dd>
            <dt class="text-error">Примечание</dt>
            <dd><textarea class="input-medium" rows="2"></textarea></dd>
            <dd>
                <div class="offset-top05">
                    <button autocomplete="off" data-loading-text="Списать" class="btn btn-mini btn-primary btn_preloader" type="button">Списать</button>
                    <button class="btn btn-mini" type="button" data-toggle="collapse" data-target=".debit-user-account-form">Отменить</button>
                </div>
            </dd>
            </dl>
        </form>
    </div>

    <dt>Телефон</dt>
    <dd>910-218-95-94</dd>
    <dt>Эл. почта</dt>
    <dd><a href="mailto:user-mail@yandex.ru">user-mail@yandex.ru</a></dd>

</dl>

<div class="well well-small well-transp offset-vertical-none inset-bottom0">

    <h4 class="offset-top0">Адрес доставки</h4>
    <ul class="unstyled">
        <li>Дмитрий Грачиков</li>
        <li>Российская Федерация</li>
        <li>г. Воронеж,  Воронежская область, 394031</li>
        <li>ул. Ворошилова, д. 305, кв. 119</li>
    </ul>

    <h4 class="offset-top0">Адреса доставки <span class="muted">по посылкам</span></h4>

    <p><span class="ot-spoiler ot-spoiler-iconed blink" data-toggle="collapse" data-target=".ot-package-№123"><i class="icon-caret-right"></i>№ 123</span></p>

    <div class="collapse ot-package-№123">
        <div class="well well-small well-white inset-bottom0 offset-bottom1">
            <ul class="unstyled">
                <li><strong>Юлия Грачикова</strong></li>
                <li>Российская Федерация</li>
                <li>г. Воронеж,  Воронежская область, 394031</li>
                <li>ул. Ворошилова, д. 305, кв. 119</li>
            </ul>
        </div>
    </div>

    <p><span class="ot-spoiler ot-spoiler-iconed blink" data-toggle="collapse" data-target=".ot-package-№5890"><i class="icon-caret-right"></i>№ 58, № 90</span></p>

    <div class="collapse ot-package-№5890">
        <div class="well well-small well-white inset-bottom0 offset-bottom1">
            <ul class="unstyled">
                <li><strong>Артемий Лебедев</strong></li>
                <li>Российская Федерация</li>
                <li>г. Москва,  Московская область, 396466</li>
                <li>ул. Какой-то там переулок, д. 35609, кв. 97</li>
            </ul>
        </div>
    </div>

</div>

<!-- other  user's active orders-->
<h5 class="offset-bottom05">Другие активные заказы</h5>

<p><span class="ot-spoiler ot-spoiler-iconed blink" data-toggle="collapse" data-target=".ot-ORD-0000001081"><i class="icon-caret-right"></i>ORD-0000001081</span></p>


<div class="collapse ot-ORD-0000001081 inset-horizontal-none">
    <div class="well well-white">
        <dl class="dl-horizontal dl-ot-horizontal offset-vertical-none">
            <dt>Номер заказа</dt>
            <dd><a href="#">ORD-0000001081</a></dd>
            <dt>Статус заказа</dt>
            <dd>Ожидает оплаты</dd>
            <dt>Дата создания</dt>
            <dd>03.07.13 <span class="muted font-11">(5:41:12)</span></dd>
            <dt>Стоимость заказа</dt>
            <dd>13.47 $</dd>
            <dt>Оплачено / осталось</dt>
            <dd>0 $ / 6.15 $</dd>
        </dl>
    </div>
</div>

<!--
TODO: when user has no active orders
<p><i class="icon-info-sign></i> Других текущих заказов у пользователя нет.</p>
 -->

