<!--<h2>Информация о покупателе</h2>-->

<div class="well">
    <div class="row-fluid">

        <div class="span6">
            <h3>
                Дмитрий Нестерович Грачиков
                <button class="btn btn-mini offset-left05" type="button" title="Авторизоваться под пользователем (откроется  в отдельном окне)">Авторизоваться <i class="icon-external-link"></i></button>
            </h3>

            <dl class="dl-horizontal dl-ot-horizontal">
                <dt>Логин</dt>
                <dd>test <span class="blink offset-left2 font-12" data-toggle="collapse" data-target=".user-pass-recover-form" title="Восстановить пароль пользователя">Восстановить пароль</span></dd>

                <div class="collapse user-pass-recover-form">
                    <form class="form-horizontal offset-top1 offset-bottom2">
                        <dt class="text-success">Новый пароль</dt>
                        <dd>
                            <div class="input-append">
                                <input type="text" class="input-large" placeholder="Введите или сгенерируйте">
                                <span class="add-on blink"><i class="icon-cog" title="Сгенерировать пароль"></i></span>
                            </div>
                            <div class="offset-top05">
                                <button autocomplete="off" data-loading-text="Сохранить" class="btn btn-tiny btn-primary btn_preloader" type="button" data-toggle="collapse" data-target=".user-pass-recover-feedback-message">Сохранить</button>
                                <button class="btn btn-tiny" type="button" data-toggle="collapse" data-target=".user-pass-recover-form">Отменить</button>
                            </div>
                        </dd>
                    </form>
                </div>

                <dd class="collapse user-pass-recover-feedback-message">
                    <p class="alert alert-success">
                        <button type="button" class="close" data-dismiss="alert" title="Скрыть уведомление">×</button>
                        <i class="icon-ok"></i> Новый пароль создан и выслан на контактный адрес пользователя.
                    </p>
                </dd>
                <!--
                TODO: after submit hide form and show system feedback message
                -->

                <!-- feedback messages -->
                <!-- success -->
                <!--                       <dt></dt>
                                       <dd>
                                           <p class="alert alert-success">
                                               <button type="button" class="close" data-dismiss="alert" title="Скрыть уведомление">×</button>
                                               <i class="icon-ok"></i> Новый пароль создан и выслан на контактный адрес пользователя.
                                           </p>
                                       </dd>
                -->                       <!-- error -->
                <!--                   <dt></dt>
                                   <dd>
                                       <p class="alert alert-error">
                                           <button type="button" class="close" data-dismiss="alert" title="Скрыть уведомление">×</button>
                                           <i class="icon-exclamation-sign"></i> Не удалось создать пароль, так как произошла неприятность, вероятность которой существует всегда.
                                       </p>
                                   </dd>
                -->               <!-- /feedback messages -->

                <dt>Эл. почта</dt>
                <dd>dmitry.grachikoff@yandex.ru</dd>
                <dt>Телефон</dt>
                <dd>904-214-54-83</dd>
                <dt>Скайп</dt>
                <dd>dmitry.grachikoff</dd>

                <dt>Реф. программа</dt>
                <dd><a href="new-admin-proto/promo/referals/category">Начальный уровень</a></dd>
            </dl>

        </div>

        <div class="span6">
            <div class="well well-transp offset-bottom05">
                <h4>Адрес</h4>
                <ul class="unstyled">
                    <li>Дмитрий Грачиков</li>
                    <li>Российская Федерация</li>
                    <li>г. Воронеж,  Воронежская область, 394031</li>
                    <li>ул. Ворошилова, д. 101, кв. 65</li>
                </ul>

                <p><span class="blink" data-toggle="collapse" data-target=".other-user-delivery-addresses">Показать дополнительные адреса</span></p><!-- TODO: Show when there is any -->
                <div class="collapse other-user-delivery-addresses">
                    <ol>
                        <li>
                            <ul class="unstyled">
                                <li><strong>Юлия Грачикова</strong></li>
                                <li>Российская Федерация</li>
                                <li>г. Воронеж,  Воронежская область, 394031</li>
                                <li>ул. Ворошилова, д. 101, кв. 65</li>
                            </ul>
                        </li>
                        <li>
                            <ul class="unstyled">
                                <li><strong>Артемий Лебедев</strong></li>
                                <li>Российская Федерация</li>
                                <li>г. Москва,  Московская область, 396466</li>
                                <li>ул. Какой-то там переулок, д. 35609, кв. 101</li>
                            </ul>
                        </li>
                    </ol>

                </div>
            </div>
        </div>

    </div>

    <a href="users/customers/update" autocomplete="off" data-loading-text="Редактирование" class="btn btn-primary btn_preloader" type="submit" title="Редактировать пользователя">Редактировать</a>

</div>