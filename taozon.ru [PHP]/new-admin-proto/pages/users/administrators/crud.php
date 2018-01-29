
<ul class="breadcrumb">
    <li><a href="."><i class="icon-home"></i></a> <span class="divider">›</span></li>
    <li><a href="users/customers">Пользователи</a> <span class="divider">›</span></li>
    <li><a href="users/administrators">Администраторы</a> <span class="divider">›</span></li>
    <li class="active">Редактирование администратора</li>
</ul>
<!--/.breadcrumb-->

<? include('inc/sub_nav_users.php'); ?>


<h1>Добавление администратора / Редактирование администратора</h1>


<div class="well">


        <form method="post" action="users/administrators" class="form-horizontal ot_form">

            <fieldset>

                <div class="row-fluid">

                    <div class="span6">

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

                        <div class="control-group">
                            <label class="control-label">Роль <i class="icon-question-sign ot_inline_help" data-toggle="popover" data-placement="top" data-content="Локальная подсказка"></i></label>
                            <div class="controls">
                                <select id="selectbasic" name="selectbasic" class="input-large" required="required">
                                    <option>Оператор</option>
                                    <option>Финансовый оператор</option>
                                    <option>Редактор</option>
                                    <option>Суперпользователь</option>
                                </select>
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

                    </div><!-- /.span6 -->
                </div><!-- /.row-fluid -->
            </fieldset>


            <div class="control-group offset-top1">
                <div class="controls">
                    <a href="users/administrators" type="submit" class="btn btn-primary btn_preloader" data-loading-text="Сохраняется">Сохранить</a>
                    <a href="users/administrators" type="button" class="btn btn_preloader offset-left1" data-loading-text="Отменяется">Отменить</a>
                </div>
            </div>


        </form>

</div><!-- /.well -->




