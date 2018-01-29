
<!-- global header -->
<header id="header" class="header">

    <!-- topbar starts -->
    <div class="navbar ot_utility_nav">

        <div class="row-fluid">

            <div class="brand_wrap">
                <a class="brand" href="/" title="Перейти на сайт">agent-domain.ltd</a>
            </div><!-- .brand_wrap -->

            <div class="pull-right">

                <!-- admin interface language -->
                <div class="btn-group">
                    <a class="btn dropdown-toggle btn-mini" data-toggle="dropdown" href="#" title="Выбор языка административного интерфейса">
                        Ru
                        <span class="caret"></span>
                    </a>
                    <ul class="dropdown-menu">
                        <li><a data-value="Eng" href="#">Eng</a></li>
                        <li><a data-value="Ch" href="#">Ch</a></li>
                    </ul>
                </div>
                <!-- /admin interface language -->

            </div>

        </div><!-- /row-fluid -->

    </div><!--/.navbar .ot_utility_nav -->

</header><!-- /.header -->


<section id="wrapper">

    <div class="row-fluid">

        <noscript>
            <div class="alert alert-block span10">
                <h4 class="alert-heading">Warning!</h4>
                <p>You need to have <a href="http://en.wikipedia.org/wiki/JavaScript" target="_blank">JavaScript</a> enabled to use this site.</p>
            </div>
        </noscript>

        <div class="ot_content">

            <div class="row-fluid">

                <!-- auth form-->
                <div class="span6 offset3 offset-top2 well">

                    <h1>Авторизация</h1>

                    <!--<div class="alert alert-error">
                        <button type="button" class="close" data-dismiss="alert">×</button>
                        Неверные логин или пароль!
                    </div>-->

                    <form class="form-horizontal ot_form ot_auth_form" method="" action="">
                        <div class="control-group">
                            <label class="control-label" for="ot_auth_login">Логин</label>
                            <div class="controls">
                                <div class="input-prepend">
                                    <span class="add-on"><i class="icon-user"></i></span>
                                    <input class="input-medium" id="ot_auth_login" type="text" required="" autofocus="autofocus" />
                                </div>
                            </div>
                        </div>
                        <div class="control-group">
                            <label class="control-label" for="ot_auth_password">Пароль</label>
                            <div class="controls">
                                <div class="input-prepend">
                                    <span class="add-on"><i class="icon-lock"></i></span>
                                    <input class="input-medium" id="ot_auth_password" type="password" required="" />
                                </div>
                            </div>
                        </div>

                        <div class="control-group" style="margin-top: -15px">
                            <div class="controls">
                                <label class="checkbox inline">
                                    <input type="checkbox" /> Отобразить символы пароля
                                </label>
                                <!-- TODO: change text to the appropriate acoording to condition -->
                                <!--<label class="checkbox inline">
                                    <input type="checkbox" /> Скрыть символы пароля
                                </label>-->
                            </div>
                        </div>

                        <div class="control-group">
                            <label class="control-label" for="ot_auth_capcha">Введите код с изображения:</label>

                            <div class="controls controls-row captcha_row">
                                <img align="left" alt="CAPTCHA Image" src="http://demo.opentao.net/lib/securimage/securimage_show.php?sid=5c40796fc0c6a8d3ad711702686782f5" class="img-polaroid span8" id="siimage">

                                <a class="btn" href="#"><i class="icon-refresh" title="Обновить изображение"></i></a><br>
                                <a class="btn" href="#"><i class="icon-headphones" title="Прослушать"></i></a>
                            </div>

                            <div class="controls controls-row">
                                <input id="ot_auth_capcha" type="text" name="" class="captchainp input-mini" required="" />
                            </div>
                        </div>

                        <div class="control-group">
                            <div class="controls">
                                <label class="checkbox">
                                    <input type="checkbox" name="ot_auth_remember_me" value="1"> Запомнить меня
                                </label>
                            </div>
                        </div>
                        <div class="control-group">
                            <div class="controls">
                                <button type="submit" name="submit" class="btn btn-primary btn-large" data-loading-text="Загрузка...">Войти</button>
                            </div>
                        </div>

                    </form>
                </div>

            </div>

        </div><!--/.content-->

    </div><!--/fluid-row-->

    <div id="underground"></div>

</section><!-- /#wrapper -->


<!-- global footer -->
<footer id="footer">

    <div class="row-fluid">

        <a href="http://box.opentao.net/" class="ot_copyright" title="Коробка разработана компанией Opentao"><i class="ot_logo offset-left1"></i>Opentao.net</a>

    </div>

</footer>


