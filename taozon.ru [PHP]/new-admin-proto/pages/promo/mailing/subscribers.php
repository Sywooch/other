
<ul class="breadcrumb">
    <li><a href="."><i class="icon-home"></i></a> <span class="divider">›</span></li>
    <li><a href="promo/seo">Продвижение</a> <span class="divider">›</span></li>
    <li><a href="promo/mailing/list">Рассылки</a> <span class="divider">›</span></li>
    <li class="active">Подписчики</li>
</ul>
<!--/.breadcrumb-->

<? include('inc/sub_nav_promo.php'); ?>

<div class="ot_sub_sub_nav">
    <ul class="nav nav-pills">
        <li><a href="promo/mailing/list">Список рассылок</a></li>
        <li class="active"><a href="promo/mailing/subscribers">Подписчики</a></li>
        <li><a href="promo/mailing/config">Настройки</a></li>
    </ul>
</div>


<h1>Подписчики</h1>


<div class="row-fluid">

    <div class="span7">

        <div class="well well-small offset-bottom2">

            <form class="offset-vertical-none" action="users/customers/update">

                <div class="row-fluid offset-bottom05">

                    <div class="span4">
                        <label class="control-label" for="ot_user_login_filter">Логин</label>
                        <input type="text" class="input-block-level" id="ot_user_login_filter" title="">

                    </div>

                    <div class="span4">
                        <label class="control-label" for="ot_user_email_filter">Эл. почта</label>
                        <input type="text" class="input-block-level" id="ot_user_email_filter" title="Введите первые символы">
                    </div>

                    <div class="span4 offset-top-lebel-1">
                        <button type="button" class="btn btn-primary btn_preloader pull-right" data-loading-text="Применить фильтр" autocomplete="off">Применить фильтр</button>
                    </div>

                </div>


            </form>

        </div>


        <div class="row-fluid">

            <div class="pull-left">

                <!-- add new user -->
                <span data-type="typeahead" data-pk="1" data-url="/post" data-placement="bottom"  class="ot-typehead-users editable-no-brd pull-right offset-top05" title="Добавить пользователя в подписку">
                    <i class="icon-plus font-14 color-blue"></i>
                    <span class="blink" title="Добавить пользователя в подписку">
                        Добавить пользователя
                    </span>
                </span>


            </div>

            <div class="pull-right">

                <button class="btn offset-bottom06" title="Экспорт подписчиков (.xml)"><i class="icon-upload-alt"></i> Экспортировать</button>
                <button class="btn offset-bottom06 dropdown-toggle" data-dropdown="#ot_import_subscribers" data-toggle="dropdown" title="Импорт подписчиков (.xml)"><i class="icon-download-alt"></i> Импортировать</button>

                <select class="input-mini offset-left1" title="Выводить записей на страницу">
                    <option value="10">10</option>
                    <option value="50">50</option>
                    <option value="100">100</option>
                    <option value="all">Все</option>
                </select>


                <div id="ot_import_subscribers" class="dropdown dropdown-tip dropdown-anchor-right">
                    <div class="dropdown-panel text-right">

                        <button class="btn btn-primary ladda-button ladda-progress-button"><span class="ladda-label">Загрузить .xml</span></button>

                    </div>
                </div>



            </div>

        </div>


        <table class="table table-hover table-bordered">
            <thead>
                <tr>
                    <th class="span4">Пользователь</th>
                    <th class="span4">Эл. адрес</th>
                    <th class="span1">Действия</th>
                </tr>
            </thead>

            <tbody>

                <tr>
                    <td><a href="users/customers/user-profile" title="Профиль пользователя">qweqwe</a></td>
                    <td><a href="mailto:qwe@asd.com" title="Написать письмо пользователю">qwe@asd.com</a></td>
                    <td class="text-center">
                        <button class="btn btn-mini ot_show_deletion_dialog_modal" title="Удалить пользователя из подписки"><i class="icon-remove"></i></button>
                    </td>
                </tr>

                <tr>
                    <td><a href="users/customers/user-profile" title="Профиль пользователя">asdfjk</a></td>
                    <td><a href="mailto:asdfjk@yahoo.com" title="Написать письмо пользователю">asdfjk@yahoo.com</a></td>
                    <td class="text-center">
                        <button class="btn btn-mini ot_show_deletion_dialog_modal" title="Удалить пользователя из подписки"><i class="icon-remove"></i></button>
                    </td>
                </tr>


            </tbody>
    </table>


    </div>
</div>


<? include('inc/pager.php'); ?>
