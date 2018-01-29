
<ul class="breadcrumb">
    <li><a href="."><i class="icon-home"></i></a> <span class="divider">›</span></li>
    <li><a href="config/build">Конфигурация</a> <span class="divider">›</span></li>
    <li><a href="config/orders/general">Заказы</a> <span class="divider">›</span></li>
    <li class="active">Квитанция в банк</li>
</ul>
<!--/.breadcrumb-->

<? include('inc/sub_nav_config.php'); ?>

<!-- ot-sub-sub-nav -->
<div class="tabbable ot_sub_sub_nav">

    <ul class="nav nav-pills">
        <li><a href="config/orders/general">Общие</a></li>
        <li class="active"><a href="config/orders/bank">Квитанция в банк</a></li>
    </ul>

</div>

<div class="row-fluid">
    <div class="span12">

        <div class="span10">
            <h1>Квитанция в банк</h1>
        </div>

        <div class="span2 offset-top1">
            <!-- site language -->
            <div class="btn-group pull-right">
                <a class="btn dropdown-toggle offset-top05" data-toggle="dropdown" href="#" title="Выбор языковой версии сайта для редактирования">
                    Все языковые версии
                    <span class="caret"></span>
                </a>
                <ul class="dropdown-menu">
                    <li><a data-value="Ru" href="#">Ru</a></li>
                    <li><a data-value="Eng" href="#">Eng</a></li>
                    <li><a data-value="Ch" href="#">Ch</a></li>
                </ul>
            </div>
            <!-- /site language -->
        </div>

    </div>
</div>



<!-- configuration -->
<div class="well">


        <form class="form-horizontal ot_form">

            <div class="control-group control-group-large">
                <label class="control-label" for="ot_name_of_payee">Наименование получателя платежа</label>
                <div class="controls">
                    <input id="ot_name_of_payee" name="textinput" placeholder="" class="input-xlarge" required="" type="text">
                </div>
            </div>

            <div class="control-group control-group-large">
                <label class="control-label" for="ot_INN_of_payee">ИНН получателя платежа (10 или 12 цифр)</label>
                <div class="controls">
                    <input id="ot_INN_of_payee" name="textinput" placeholder="" class="input-xlarge" required="" type="text">
                </div>
            </div>

            <div class="control-group control-group-large">
                <label class="control-label" for="ot_account_number_of_payee">Номер счета получателя платежа (20 цифр)</label>
                <div class="controls">
                    <input id="ot_account_number_of_payee" name="textinput" placeholder="" class="input-xlarge" required="" type="text">
                </div>
            </div>

            <div class="control-group control-group-large">
                <label class="control-label" for="ot_bank_name_of_payee">Наименование банка получателя платежа</label>
                <div class="controls">
                    <input id="ot_bank_name_of_payee" name="textinput" placeholder="" class="input-xlarge" required="" type="text">
                </div>
            </div>

            <div class="control-group control-group-large">
                <label class="control-label" for="ot_bank_identification_code">БИК (8 или 9 цифр)</label>
                <div class="controls">
                    <input id="ot_bank_identification_code" name="textinput" placeholder="" class="input-xlarge" required="" type="text">
                </div>
            </div>

            <div class="control-group control-group-large">
                <label class="control-label" for="ot_correspondent_bank_account">Номер кор./сч. банка получателя платежа (20 цифр)</label>
                <div class="controls">
                    <input id="ot_correspondent_bank_account" name="textinput" placeholder="" class="input-xlarge" required="" type="text">
                </div>
            </div>

            <div class="control-group control-group-large">
                <label class="control-label" for="ot_description_of_payment">Наименование платежа</label>
                <div class="controls">
                    <input id="ot_description_of_payment" name="textinput" placeholder="" class="input-xlarge" required="" type="text">
                </div>
            </div>

            <div class="control-group control-group-large">
                <div class="controls">
                    <button type="button" class="btn btn-primary btn_preloader" data-loading-text="Сохраняется" autocomplete="off">Сохранить</button>
                </div>
            </div>

            <!--
            TODO:
            • Validate form, send data via ajax, give feedback to user about completion of the action.
            • If success, give to all filled in fields .control-group of this form class="success" and show <p class="help-inline">Информация успешно сохранена!</p> after submit button.
            • If error, give to all error fields .control-group of this form, class="error" and show <p class="help-inline">Информация не сохранена. «Причина ошбки» </p> after submit button.
            -->

            <!-- successful action -->
            <div class="control-group control-group-large success">
                <div class="controls">
                    <button type="button" class="btn btn-primary btn_preloader" data-loading-text="Сохраняется" autocomplete="off">Сохранить</button>
                    <p class="help-inline">Информация успешно сохранена!</p>
                </div>
            </div>

            <!-- unsuccessful action -->
            <div class="control-group control-group-large error">
                <div class="controls">
                    <button type="button" class="btn btn-primary btn_preloader" data-loading-text="Сохраняется" autocomplete="off">Сохранить</button>
                    <p class="help-inline">Информация не сохранена: «причина ошбки»</p>
                </div>
            </div>

        </form>

</div>


