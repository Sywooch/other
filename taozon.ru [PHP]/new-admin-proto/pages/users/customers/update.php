
<ul class="breadcrumb">
    <li><a href="."><i class="icon-home"></i></a> <span class="divider">›</span></li>
    <li><a href="users/customers">Пользователи</a> <span class="divider">›</span></li>
    <li><a href="users/customers">Покупатели</a> <span class="divider">›</span></li>
    <li><a href="users/customers/user-profile">Дмитрий Грачиков</a> <span class="divider">›</span></li>
    <li class="active">Редактирование</li>
</ul>
<!--/.breadcrumb-->

<? include('inc/sub_nav_users.php'); ?>


<h1>Редактирование пользователя Дмитрий Грачиков</h1>


<div class="well">

        <form method="post" action="users/customers" class="form-horizontal ot_form">

            <fieldset>

                <legend>Учетная запись</legend>

                <div class="row-fluid">

                    <div class="span6">

                        <legend class="legend-mini">Авторизация</legend>

                        <div class="control-group">
                            <label class="control-label">Логин <i class="icon-question-sign ot_inline_help" data-toggle="popover" data-placement="top" data-content="Локальная подсказка"></i></label>
                            <div class="controls">
                                <div class="input-prepend">
                                    <span class="add-on"><i class="icon-user"></i></span>
                                    <input id="textinput" name="textinput" class="input-medium" type="text" required="required" title="Обязательное поле">
                                </div>
                            </div>
                        </div>

                        <div class="control-group">
                            <label class="control-label">Пароль <i class="icon-question-sign ot_inline_help" data-toggle="popover" data-placement="top" data-content="Локальная подсказка"></i></label>
                            <div class="controls">
                                <div class="input-prepend">
                                    <span class="add-on"><i class="icon-lock"></i></span>
                                    <input id="textinput" name="textinput" class="input-medium" type="text" required="required">
                                </div>

                            </div>
                        </div>

                        <div class="control-group">
                            <label class="control-label">Эл. почта <i class="icon-question-sign ot_inline_help" data-toggle="popover" data-placement="top" data-content="Локальная подсказка"></i></label>
                            <div class="controls">
                                <div class="input-prepend">
                                    <span class="add-on">@</span>
                                    <input id="textinput" name="textinput" class="input-medium" type="text" required="required" title="Обязательное поле">
                                </div>
                            </div>
                        </div>

                        <legend class="legend-mini">Контактные данные</legend>
                        <div class="control-group">
                            <label class="control-label">Телефон</label>
                            <div class="controls">
                                <div class="input-prepend">
                                    <span class="add-on"><i class="icon-phone"></i></span>
                                    <input id="textinput" name="textinput" class="input-medium" type="text">
                                </div>
                            </div>
                        </div>
                        <div class="control-group">
                            <label class="control-label">Скайп</label>
                            <div class="controls">
                                <div class="input-prepend">
                                    <span class="add-on"><i class="icon-skype"></i></span>
                                    <input id="textinput" name="textinput" class="input-medium" type="text">
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="span6">
                        <legend class="legend-mini">Личные данные</legend>

                        <div class="control-group">
                            <label class="control-label">Имя</label>
                            <div class="controls">
                                <input id="textinput" name="textinput" class="input-medium" type="text" required="required">
                            </div>
                        </div>

                        <div class="control-group">
                            <label class="control-label">Фамилия</label>
                            <div class="controls">
                                <input id="textinput" name="textinput" class="input-medium" type="text" required="required">
                            </div>
                        </div>

                        <div class="control-group">
                            <label class="control-label">Отчество</label>
                            <div class="controls">
                                <input id="textinput" name="textinput" class="input-medium" type="text">
                            </div>
                        </div>

                        <div class="control-group">
                            <label class="control-label">Пол</label>
                            <div class="controls">
                                <select name="" id="" class="input-medium">
                                    <option value="male">Мужской</option>
                                    <option value="female">Женский</option>
                                </select>
                            </div>
                        </div>

                    </div><!-- /.span6 -->

                </div><!-- /.row-fluid -->

            </fieldset>


            <fieldset>

                <legend>Доставка</legend>

                <div class="control-group">
                    <label class="control-label">Страна</label>
                    <div class="controls">
                        <select class="input-medium">
                            <option value="AZ">Азербайджан</option>
                            <option value="AM">Армения</option>
                            <option value="BY">Беларусь</option>
                            <option value="KZ">Казахстан</option>
                            <option value="KG">Киргизия</option>
                            <option value="MD">Молдова</option>
                            <option value="PL">Польша</option>
                            <option value="RU">Россия</option>
                            <option value="TJ">Таджикистан</option>
                            <option value="TM">Туркмения</option>
                            <option value="UZ">Узбекистан</option>
                            <option value="UA">Украина</option>
                        </select>
                    </div>
                </div>

                <div class="control-group">
                    <label class="control-label">Регион</label>
                    <div class="controls">
                        <input id="textinput" name="textinput" class="input-small" type="text">
                    </div>
                </div>

                <div class="control-group">
                    <label class="control-label">Город</label>
                    <div class="controls">
                        <input id="textinput" name="textinput" class="input-small" type="text">
                    </div>
                </div>

                <div class="control-group">
                    <label class="control-label">Адрес</label>
                    <div class="controls">
                        <input id="textinput" name="textinput" class="input-xlarge" type="text">
                    </div>
                </div>

                <div class="control-group">
                    <label class="control-label">Почтовый индекс</label>
                    <div class="controls">
                        <input id="textinput" name="textinput" class="input-mini" type="text">
                    </div>
                </div>


                <!-- add a new recipient -->

                <!--<p><i class="icon-plus color-blue"></i> <span class="blink" data-toggle="collapse" data-target=".new-user-delivery-form" title="Добавить нового получателя">Добавить получателя</span></p>

                <div class="collapse new-user-delivery-form">
                    <div class="well well-white">
                        <legend class="legend-mini">Новый получатель</legend>

                        <div class="row-fluid">
                            <div class="span6">
                                <div class="control-group">
                                    <label class="control-label">Имя</label>
                                    <div class="controls">
                                        <input id="textinput" name="textinput" class="input-medium" type="text" required="required">
                                    </div>
                                </div>

                                <div class="control-group">
                                    <label class="control-label">Фамилия</label>
                                    <div class="controls">
                                        <input id="textinput" name="textinput" class="input-medium" type="text" required="required">
                                    </div>
                                </div>

                                <div class="control-group">
                                    <label class="control-label">Отчество</label>
                                    <div class="controls">
                                        <input id="textinput" name="textinput" class="input-medium" type="text">
                                    </div>
                                </div>

                                <div class="control-group">
                                    <label class="control-label">Телефон</label>
                                    <div class="controls">
                                        <div class="input-prepend">
                                            <span class="add-on"><i class="icon-phone"></i></span>
                                            <input id="textinput" name="textinput" class="input-medium" type="text">
                                        </div>
                                    </div>
                                </div>

                            </div>
                            <div class="span6">
                                <div class="control-group">
                                    <label class="control-label">Страна</label>
                                    <div class="controls">
                                        <select class="input-medium">
                                            <option value="AZ">Азербайджан</option>
                                            <option value="AM">Армения</option>
                                            <option value="BY">Беларусь</option>
                                            <option value="KZ">Казахстан</option>
                                            <option value="KG">Киргизия</option>
                                            <option value="MD">Молдова</option>
                                            <option value="PL">Польша</option>
                                            <option value="RU">Россия</option>
                                            <option value="TJ">Таджикистан</option>
                                            <option value="TM">Туркмения</option>
                                            <option value="UZ">Узбекистан</option>
                                            <option value="UA">Украина</option>
                                        </select>
                                    </div>
                                </div>

                                <div class="control-group">
                                    <label class="control-label">Регион</label>
                                    <div class="controls">
                                        <input id="textinput" name="textinput" class="input-small" type="text">
                                    </div>
                                </div>

                                <div class="control-group">
                                    <label class="control-label">Город</label>
                                    <div class="controls">
                                        <input id="textinput" name="textinput" class="input-small" type="text">
                                    </div>
                                </div>

                                <div class="control-group">
                                    <label class="control-label">Адрес</label>
                                    <div class="controls">
                                        <input id="textinput" name="textinput" class="input-xlarge" type="text">
                                    </div>
                                </div>

                                <div class="control-group">
                                    <label class="control-label">Почтовый индекс</label>
                                    <div class="controls">
                                        <input id="textinput" name="textinput" class="input-mini" type="text">
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>-->

            </fieldset>




            <div class="control-group offset-top2">
                <div class="controls">
                    <button type="submit" class="btn btn-primary btn_preloader" data-loading-text="Сохраняется">Сохранить</button>
                    <button type="button" class="btn offset-left1 btn_preloader" data-loading-text="Отменяется">Отменить</button>
                </div>
            </div>


        </form>

</div>




