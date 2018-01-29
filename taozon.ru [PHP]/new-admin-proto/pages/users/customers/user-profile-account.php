<!--<h2>Счет</h2>-->

<!--
TODO: show system messages after submit redirect
-->

<!-- System feedback messages-->

<!--
    <p class="alert alert-success">
        <button type="button" class="close" data-dismiss="alert" title="Скрыть уведомление">×</button>
        <i class="icon-ok"></i> Средства успешно зачисленны на счет пользователя.
    </p>

    <p class="alert alert-error">
        <button type="button" class="close" data-dismiss="alert" title="Скрыть уведомление">×</button>
        <i class="icon-exclamation-sign"></i> Не удалось зачислить средства на счет пользователя, так как произошла неприятность, вероятность которой существует всегда.
    </p>

    <p class="alert alert-success">
        <button type="button" class="close" data-dismiss="alert" title="Скрыть уведомление">×</button>
        <i class="icon-ok"></i> Средства успешно списаны со счета пользователя.
    </p>

    <p class="alert alert-error">
        <button type="button" class="close" data-dismiss="alert" title="Скрыть уведомление">×</button>
        <i class="icon-exclamation-sign"></i> Не удалось списать средства со счета пользователя, так как произошла неприятность, вероятность которой существует всегда.
    </p>
-->

<!-- /System feedback messages-->


<div class="well">

<!--    <h3>Грачиков Дмитрий Нестерович</h3>-->

    <dl class="dl-horizontal dl-ot-horizontal">

        <dt>Номер счета</dt>
        <dd>USR-0000000030</dd>

        <dt>Средства <i class="icon-question-sign ot_inline_help" data-toggle="popover" data-placement="top" data-content="Введите сумму, которую вы хотите зачислить или снять с личного счета покупателя"></i></dt>
        <dd>
            <span class="badge weight-normal font-13">33.78 $</span>

            <div class="inline-block offset1" data-toggle="buttons-radio">
                <button type="button" class="btn btn-tiny" data-toggle="collapse" data-target=".credit-user-account-form" title="Пополнить счет пользователя"><i class="icon-plus-sign color-green"></i> Зачислить</button>
                <button type="button" class="btn btn-tiny" data-toggle="collapse" data-target=".debit-user-account-form" title="Снять средства со счета пользователя"><i class="icon-minus-sign color-red"></i> Списать</button>
            </div>
        </dd>

        <!--
        TODO:
        1) Show only one form at once when clickin' «credit-debit» buttons
        2) Remove pressing effect at «credit-debit» buttons after pressing cancel button on one of the forms, as well as unpress the same control button
        -->

        <!--credit-user-account-form-->
        <div class="collapse credit-user-account-form">
            <form class="form-horizontal offset-top1 offset-bottom2">
                <h4>Зачисление средств</h4>
                <dt class="text-success">Сумма</dt>
                <dd><input type="text" class="input-mini"></dd>
                <dt class="text-success">Примечание</dt>
                <dd><textarea class="input-xlarge" rows="2"></textarea></dd>
                <dd>
                    <div class="offset-top05">
                        <button autocomplete="off" data-loading-text="Зачислить" class="btn btn-primary btn_preloader" type="button">Зачислить</button>
                        <button class="btn" type="button" data-toggle="collapse" data-target=".credit-user-account-form">Отменить</button>
                    </div>
                </dd>
            </form>
        </div>

        <!--debit-user-account-form-->
        <div class="collapse debit-user-account-form">
            <form class="form-horizontal offset-top1 offset-bottom2">
                <h4>Списание средств</h4>
                <dt class="text-error">Сумма</dt>
                <dd><input type="text" class="input-mini"></dd>
                <dt class="text-error">Примечание</dt>
                <dd><textarea class="input-xlarge" rows="2"></textarea></dd>
                <dd>
                    <div class="offset-top05">
                        <button autocomplete="off" data-loading-text="Списать" class="btn btn-primary btn_preloader" type="button">Списать</button>
                        <button class="btn" type="button" data-toggle="collapse" data-target=".debit-user-account-form">Отменить</button>
                    </div>
                </dd>
            </form>
        </div>

    </dl>

</div><!-- ./well-->


<h4>Операции</h4>

<table class="table table-bordered">
    <thead>
        <tr>
            <th>Дата</th>
            <th>Сумма</th>
            <th>Примечание</th>
            <th>Оператор</th>
        </tr>
    </thead>

    <tbody>

        <tr>
            <td>26.02.2013 <span class="muted">(19:06:06)</span></td>
            <td class="text-error">— 316.22 $</td>
            <td>Оплата заказа № 2049 с лицевого счета ORD-0000000324</td>
            <td>Сергей Шойгу</td>
        </tr>

        <tr>
            <td>26.02.2013 <span class="muted">(19:12:06)</span></td>
            <td class="text-success">&nbsp;&nbsp;&nbsp;&nbsp;316.22 $</td>
            <td>Возврат средств с заказа (<a href="#">№ 2049 — 7</a>)</td>
            <td>Михаил Галустян</td>
    <!--        <td class="text-success" style="text-indent: 15px">316.22 $</td>-->
        </tr>

    </tbody>

</table>
