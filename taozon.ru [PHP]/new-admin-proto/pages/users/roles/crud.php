
<ul class="breadcrumb">
    <li><a href="."><i class="icon-home"></i></a> <span class="divider">›</span></li>
    <li><a href="users/customers">Пользователи</a> <span class="divider">›</span></li>
    <li><a href="users/roles">Роли</a> <span class="divider">›</span></li>
    <li class="active">Добавление / редактирование роли</li>
</ul>
<!--/.breadcrumb-->

<? include('inc/sub_nav_users.php'); ?>


<h1>Добавление / редактирование роли</h1>


<div class="well">

        <form method="post" action="users/roles" class="form-horizontal ot_form">

            <fieldset>

                <div class="control-group">
                    <label class="control-label"><strong>Название роли</strong></label>
                    <div class="controls">
                        <input class="input-medium" type="text" required="required">
                    </div>
                </div>

            </fieldset>



            <h3>Права</h3>
            <fieldset>

                <div class="control-group">
                    <label class="control-label">По образу <i class="icon-question-sign ot_inline_help" data-toggle="popover" data-placement="top" data-content="Для упрощения создания новой роли можно воспользоваться шаблоном наборов прав для стандартных ролей"></i></label>
                    <div class="controls">
                        <select id="selectbasic" name="selectbasic" class="input-large" required="required">
                            <option>Выберите роль</option>
                            <option>Оператор</option>
                            <option>Финансовый оператор</option>
                            <option>Редактор</option>
                            <option>Суперпользователь</option>
                        </select>
                    </div>
                </div>


                <h4><input type="checkbox" value="option"> <span class="blink" data-toggle="collapse" data-target=".catalogue-user-rights">Каталог</span></h4>
                <div class="collapse in catalogue-user-rights">
                    <ul class="unstyled">
                        <li>
                            <label class="checkbox">
                                <input type="checkbox" id="" value=""> Просмотр каталога, и настроек, с ним связанных (выбор режима каталога).
                            </label>
                        </li>
                        <li>
                            <label class="checkbox">
                                <input type="checkbox" id="" value=""> 	Редактирование каталога и его настроек.
                            </label>
                        </li>
                    </ul>
                    <hr>
                </div>


                <h4 class="offset-top01"><input type="checkbox" value="option"> <span class="blink" data-toggle="collapse" data-target=".pricing-user-rights">Ценообразование</span></h4>
                <div class="collapse in pricing-user-rights">
                    <ul class="unstyled">
                        <li>
                            <label class="checkbox">
                                <input type="checkbox" id="" value=""> 	Просмотр настроек ЦО: наценка, курсы валют, запреты на доставку, округление, использование скидок таобао, и т.д.
                            </label>
                        </li>
                        <li>
                            <label class="checkbox">
                                <input type="checkbox" id="" value=""> Изменение настроек ЦО
                            </label>
                        </li>
                    </ul>
                    <hr>
                </div>


                <h4 class="offset-top01"><input type="checkbox" valгue="option"> <span class="blink" data-toggle="collapse" data-target=".customers-user-rights">Покупатели</span></h4>
                <div class="collapse in customers-user-rights">
                    <ul class="unstyled">
                        <li>
                            <label class="checkbox">
                                <input type="checkbox" id="" value="">Просмотр покупателей
                            </label>
                        </li>
                        <li>
                            <label class="checkbox">
                                <input type="checkbox" id="" value=""> Редактирование покупателей.
                            </label>
                        </li>
                    </ul>
                    <hr>
                </div>


                <h4 class="offset-top01"><input type="checkbox" valгue="option"> <span class="blink" data-toggle="collapse" data-target=".discounts-user-rights">Скидки</span></h4>
                <div class="collapse in discounts-user-rights">
                    <ul class="unstyled">
                        <li>
                            <label class="checkbox">
                                <input type="checkbox" id="" value=""> 	Просмотр скидок.
                            </label>
                        </li>
                        <li>
                            <label class="checkbox">
                                <input type="checkbox" id="" value=""> Редактирование скидок.
                            </label>
                        </li>
                    </ul>
                    <hr>
                </div>


                <h4 class="offset-top01"><input type="checkbox" valгue="option"> <span class="blink" data-toggle="collapse" data-target=".selection-user-rights">Подборки</span></h4>
                <div class="collapse in selection-user-rights">
                    <ul class="unstyled">
                        <li>
                            <label class="checkbox">
                                <input type="checkbox" id="" value=""> 	Просмотр подборок.
                            </label>
                        </li>
                        <li>
                            <label class="checkbox">
                                <input type="checkbox" id="" value=""> Редактирование подборок.
                            </label>
                        </li>
                        <li>
                            <label class="checkbox">
                                <input type="checkbox" id="" value=""> Просмотр черного списка для «популярной» и «последней» подборок.
                            </label>
                        </li>
                        <li>
                            <label class="checkbox">
                                <input type="checkbox" id="" value=""> 	Редактирование черного списка для «популярной» и «последней» подборок.
                            </label>
                        </li>

                    </ul>
                    <hr>
                </div>


                <h4 class="offset-top01"><input type="checkbox" valгue="option"> <span class="blink" data-toggle="collapse" data-target=".brands-user-rights">Бренды</span></h4>
                <div class="collapse in brands-user-rights">
                    <ul class="unstyled">
                        <li>
                            <label class="checkbox">
                                <input type="checkbox" id="" value=""> 	Просмотр брендов.
                            </label>
                        </li>
                        <li>
                            <label class="checkbox">
                                <input type="checkbox" id="" value=""> Редактирование брендов.
                            </label>
                        </li>
                    </ul>
                    <hr>
                </div>


                <h4 class="offset-top01"><input type="checkbox" valгue="option"> <span class="blink" data-toggle="collapse" data-target=".calс-user-rights">Калькулятор доставки</span></h4>
                <div class="collapse in calс-user-rights">
                    <ul class="unstyled">
                        <li>
                            <label class="checkbox">
                                <input type="checkbox" id="" value=""> 	Просмотр настроек калькулятора доставки.
                            </label>
                        </li>
                        <li>
                            <label class="checkbox">
                                <input type="checkbox" id="" value=""> 	Редактирование настроек калькулятора доставки.
                            </label>
                        </li>
                    </ul>
                    <hr>
                </div>


                <h4 class="offset-top01"><input type="checkbox" valгue="option"> <span class="blink" data-toggle="collapse" data-target=".stat-user-rights">Статистика</span></h4>
                <div class="collapse in stat-user-rights">
                    <ul class="unstyled">
                        <li>
                            <label class="checkbox">
                                <input type="checkbox" id="" value=""> Просмотр статистики работы сервисов.
                            </label>
                        </li>
                    </ul>
                    <hr>
                </div>


                <h4 class="offset-top01"><input type="checkbox" valгue="option"> <span class="blink" data-toggle="collapse" data-target=".orders-user-rights">Заказы</span></h4>
                <div class="collapse in orders-user-rights">
                    <ul class="unstyled">
                        <li>
                            <label class="checkbox">
                                <input type="checkbox" id="" value=""> 	Просмотр заказов и всего что с ними связано.
                            </label>
                        </li>
                        <li>
                            <label class="checkbox">
                                <input type="checkbox" id="" value=""> Редактирование всего, что связано с заказами.
                            </label>
                        </li>
                        <li>
                            <label class="checkbox">
                                <input type="checkbox" id="" value=""> Просмотр заказов с указанным статусом.
                            </label>
                        </li>
                        <li>
                            <label class="checkbox">
                                <input type="checkbox" id="" value=""> Просмотр строк заказа с указанным статусом.
                            </label>
                        </li>
                        <li>
                            <label class="checkbox">
                                <input type="checkbox" id="" value=""> Изменение статуса строки заказа на выбранный.
                            </label>
                        </li>

                    </ul>
                    <hr>
                </div>


                <h4 class="offset-top01"><input type="checkbox" valгue="option"> <span class="blink" data-toggle="collapse" data-target=".users-user-rights">Пользователи</span></h4>
                <div class="collapse in users-user-rights">
                    <ul class="unstyled">
                        <li>
                            <label class="checkbox">
                                <input type="checkbox" id="" value=""> 	Просмотр пользователей инстанса и их ролей и прав.
                            </label>
                        </li>
                        <li>
                            <label class="checkbox">
                                <input type="checkbox" id="" value=""> Редактирование пользователей инстанса и их ролей и прав.
                            </label>
                        </li>
                    </ul>
                    <hr>
                </div>


                <h4 class="offset-top01"><input type="checkbox" valгue="option"> <span class="blink" data-toggle="collapse" data-target=".update-user-rights">Обновление</span></h4>
                <div class="collapse in update-user-rights">
                    <ul class="unstyled">
                        <li>
                            <label class="checkbox">
                                <input type="checkbox" id="" value=""> 	Обновление сайта с админки.
                            </label>
                        </li>
                    </ul>
                    <hr>
                </div>


            </fieldset>

            <div class="offset-top1">
                <a href="users/roles" type="submit" class="btn btn-primary btn_preloader" data-loading-text="Сохраняется">Сохранить</a>
                <a href="users/roles" type="button" class="btn btn_preloader offset-left1" data-loading-text="Отменяется" name="cancel">Отменить</a>
            </div>


        </form>

</div><!-- /.well -->




