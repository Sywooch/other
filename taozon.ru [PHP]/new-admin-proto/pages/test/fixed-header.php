<!-- ot-sub-nav -->
<div class="ot_sub_nav">

    <ul class="nav nav-tabs">
        <li class="active"><a href="/config/build">Конструкция сайта</a></li>
        <li><a href="/config/orders">Заказы</a></li>
        <li><a href="/config/cat">Каталог</a></li>
        <li><a href="/config/lang">Языки</a></li>
        <li><a href="/config/system">Система</a></li>
    </ul>

</div>


<h1>ТЗ на выявление багов в FixedHeader.js</h1>

<div class="alert alert-success" style="color: #000; background: #F5F5F5">
    <button type="button" class="close" data-dismiss="alert">&times;</button>

    <h3>Исходник</h3>
    <p>Реализация была позаимствована отсюда — <a href="http://datatables.net/extras/fixedheader/">http://datatables.net/extras/fixedheader/</a>, как дополнение к используемому табличному плагину
        <a href="http://datatables.net/index">DataTables</a>.</p>

    <h3>Что делает плагин</h3>
    <p>Фиксирует заголовки таблицы к верху экрана при прокрутке, тем самым решая проблему доступности заголовков при просмотре табличных данных.</p>

    <h3>Что не так</h3>
    <!--<p>Судя по всему — не так используемая нами версия jquery, то есть 1.9.1., которая конфликтует с последней версией плагина. В рамках традиции использования последней версии фреймворка, мне все-таки кажится, что допиливать нужно именно сам плагин, а не версию под него искать.</p>-->
    <p><!--К слову сказать, я уже гуглил на этот счет и подумал что проблему решил самостоятельно, ковырнув код плагина, однако, как выяснилось позднее, это оказалось не так, потому что--> На страницах где табличные данные не выводятся, возникает ошибка в консоли: <code>TypeError: oDtSettings is null
            http://admin.opentao.srv/js/vendor/FixedHeader.js
            Line 155</code></p>
    <p>Активация плагина находится в соответствующем файле js/plugins.js</p>

    <h3>Зачем это все</h3>
    <p>Потому что ошибка жабоскрипта реально сказывается на работоспособности остальных модулей<!--, в частности <a
            href="/test/portlets">вот этой реализации</a>-->.</p>
</div>
<!-- Конец вступительного блока с инструкциями -->


<!--
Табличные данные чтобы посмотреть на работу плагина
Чтобы начало работать, нужно раскоменнтировать соответствующий код «fix tables header» в plugins.js
-->

<div class="row-fluid">

<table class="table table-bordered bootstrap-datatable datatable" id="data_table">
<thead>
<tr>
    <th>Username</th>
    <th>Date registered</th>
    <th>Role</th>
    <th>Status</th>
    <th>Actions</th>
</tr>
</thead>
<tbody>
<tr>
    <td>David R</td>
    <td class="center">2012/01/01</td>
    <td class="center">Member</td>
    <td class="center">
        <span class="label label-success">Active</span>
    </td>
    <td class="center">
        <a class="btn" href="#">
            <i class="icon-zoom-in"></i>

        </a>
        <a class="btn" href="#">
            <i class="icon-edit"></i>

        </a>
        <a class="btn" href="#">
            <i class="icon-remove"></i>

        </a>
    </td>
</tr>
<tr>
    <td>Chris Jack</td>
    <td class="center">2012/01/01</td>
    <td class="center">Member</td>
    <td class="center">
        <span class="label label-success">Active</span>
    </td>
    <td class="center">
        <a class="btn" href="#">
            <i class="icon-zoom-in"></i>

        </a>
        <a class="btn" href="#">
            <i class="icon-edit"></i>

        </a>
        <a class="btn" href="#">
            <i class="icon-remove"></i>

        </a>
    </td>
</tr>
<tr>
    <td>Jack Chris</td>
    <td class="center">2012/01/01</td>
    <td class="center">Member</td>
    <td class="center">
        <span class="label label-success">Active</span>
    </td>
    <td class="center">
        <a class="btn" href="#">
            <i class="icon-zoom-in"></i>

        </a>
        <a class="btn" href="#">
            <i class="icon-edit"></i>

        </a>
        <a class="btn" href="#">
            <i class="icon-remove"></i>

        </a>
    </td>
</tr>
<tr>
    <td>Muhammad Usman</td>
    <td class="center">2012/01/01</td>
    <td class="center">Member</td>
    <td class="center">
        <span class="label label-success">Active</span>
    </td>
    <td class="center">
        <a class="btn" href="#">
            <i class="icon-zoom-in"></i>

        </a>
        <a class="btn" href="#">
            <i class="icon-edit"></i>

        </a>
        <a class="btn" href="#">
            <i class="icon-remove"></i>

        </a>
    </td>
</tr>
<tr>
    <td>Sheikh Heera</td>
    <td class="center">2012/02/01</td>
    <td class="center">Staff</td>
    <td class="center">
        <span class="label label-important">Banned</span>
    </td>
    <td class="center">
        <a class="btn" href="#">
            <i class="icon-zoom-in"></i>

        </a>
        <a class="btn" href="#">
            <i class="icon-edit"></i>

        </a>
        <a class="btn" href="#">
            <i class="icon-remove"></i>

        </a>
    </td>
</tr>
<tr>
    <td>Helen Garner</td>
    <td class="center">2012/02/01</td>
    <td class="center">Staff</td>
    <td class="center">
        <span class="label label-important">Banned</span>
    </td>
    <td class="center">
        <a class="btn" href="#">
            <i class="icon-zoom-in"></i>

        </a>
        <a class="btn" href="#">
            <i class="icon-edit"></i>

        </a>
        <a class="btn" href="#">
            <i class="icon-remove"></i>

        </a>
    </td>
</tr>
<tr>
    <td>Saruar Ahmed</td>
    <td class="center">2012/03/01</td>
    <td class="center">Member</td>
    <td class="center">
        <span class="label label-warning">Pending</span>
    </td>
    <td class="center">
        <a class="btn" href="#">
            <i class="icon-zoom-in"></i>

        </a>
        <a class="btn" href="#">
            <i class="icon-edit"></i>

        </a>
        <a class="btn" href="#">
            <i class="icon-remove"></i>

        </a>
    </td>
</tr>
<tr>
    <td>Ahemd Saruar</td>
    <td class="center">2012/03/01</td>
    <td class="center">Member</td>
    <td class="center">
        <span class="label label-warning">Pending</span>
    </td>
    <td class="center">
        <a class="btn" href="#">
            <i class="icon-zoom-in"></i>

        </a>
        <a class="btn" href="#">
            <i class="icon-edit"></i>

        </a>
        <a class="btn" href="#">
            <i class="icon-remove"></i>

        </a>
    </td>
</tr>
<tr>
    <td>Habib Rizwan</td>
    <td class="center">2012/01/21</td>
    <td class="center">Staff</td>
    <td class="center">
        <span class="label label-success">Active</span>
    </td>
    <td class="center">
        <a class="btn" href="#">
            <i class="icon-zoom-in"></i>

        </a>
        <a class="btn" href="#">
            <i class="icon-edit"></i>

        </a>
        <a class="btn" href="#">
            <i class="icon-remove"></i>

        </a>
    </td>
</tr>
<tr>
    <td>Rizwan Habib</td>
    <td class="center">2012/01/21</td>
    <td class="center">Staff</td>
    <td class="center">
        <span class="label label-success">Active</span>
    </td>
    <td class="center">
        <a class="btn" href="#">
            <i class="icon-zoom-in"></i>

        </a>
        <a class="btn" href="#">
            <i class="icon-edit"></i>

        </a>
        <a class="btn" href="#">
            <i class="icon-remove"></i>

        </a>
    </td>
</tr>
<tr>
    <td>Amrin Sana</td>
    <td class="center">2012/08/23</td>
    <td class="center">Staff</td>
    <td class="center">
        <span class="label label-important">Banned</span>
    </td>
    <td class="center">
        <a class="btn" href="#">
            <i class="icon-zoom-in"></i>

        </a>
        <a class="btn" href="#">
            <i class="icon-edit"></i>

        </a>
        <a class="btn" href="#">
            <i class="icon-remove"></i>

        </a>
    </td>
</tr>
<tr>
    <td>Sana Amrin</td>
    <td class="center">2012/08/23</td>
    <td class="center">Staff</td>
    <td class="center">
        <span class="label label-important">Banned</span>
    </td>
    <td class="center">
        <a class="btn" href="#">
            <i class="icon-zoom-in"></i>

        </a>
        <a class="btn" href="#">
            <i class="icon-edit"></i>

        </a>
        <a class="btn" href="#">
            <i class="icon-remove"></i>

        </a>
    </td>
</tr>
<tr>
    <td>Ifrah Jannat</td>
    <td class="center">2012/06/01</td>
    <td class="center">Admin</td>
    <td class="center">
        <span class="label">Inactive</span>
    </td>
    <td class="center">
        <a class="btn" href="#">
            <i class="icon-zoom-in"></i>

        </a>
        <a class="btn" href="#">
            <i class="icon-edit"></i>

        </a>
        <a class="btn" href="#">
            <i class="icon-remove"></i>

        </a>
    </td>
</tr>
<tr>
    <td>Jannat Ifrah</td>
    <td class="center">2012/06/01</td>
    <td class="center">Admin</td>
    <td class="center">
        <span class="label">Inactive</span>
    </td>
    <td class="center">
        <a class="btn" href="#">
            <i class="icon-zoom-in"></i>

        </a>
        <a class="btn" href="#">
            <i class="icon-edit"></i>

        </a>
        <a class="btn" href="#">
            <i class="icon-remove"></i>

        </a>
    </td>
</tr>
<tr>
    <td>Robert</td>
    <td class="center">2012/03/01</td>
    <td class="center">Member</td>
    <td class="center">
        <span class="label label-warning">Pending</span>
    </td>
    <td class="center">
        <a class="btn" href="#">
            <i class="icon-zoom-in"></i>

        </a>
        <a class="btn" href="#">
            <i class="icon-edit"></i>

        </a>
        <a class="btn" href="#">
            <i class="icon-remove"></i>

        </a>
    </td>
</tr>
<tr>
    <td>Dave Robert</td>
    <td class="center">2012/03/01</td>
    <td class="center">Member</td>
    <td class="center">
        <span class="label label-warning">Pending</span>
    </td>
    <td class="center">
        <a class="btn" href="#">
            <i class="icon-zoom-in"></i>

        </a>
        <a class="btn" href="#">
            <i class="icon-edit"></i>

        </a>
        <a class="btn" href="#">
            <i class="icon-remove"></i>

        </a>
    </td>
</tr>
<tr>
    <td>Brown Robert</td>
    <td class="center">2012/03/01</td>
    <td class="center">Member</td>
    <td class="center">
        <span class="label label-warning">Pending</span>
    </td>
    <td class="center">
        <a class="btn" href="#">
            <i class="icon-zoom-in"></i>

        </a>
        <a class="btn" href="#">
            <i class="icon-edit"></i>

        </a>
        <a class="btn" href="#">
            <i class="icon-remove"></i>

        </a>
    </td>
</tr>
<tr>
    <td>Usman Muhammad</td>
    <td class="center">2012/01/01</td>
    <td class="center">Member</td>
    <td class="center">
        <span class="label label-success">Active</span>
    </td>
    <td class="center">
        <a class="btn" href="#">
            <i class="icon-zoom-in"></i>

        </a>
        <a class="btn" href="#">
            <i class="icon-edit"></i>

        </a>
        <a class="btn" href="#">
            <i class="icon-remove"></i>

        </a>
    </td>
</tr>
<tr>
    <td>Abdullah</td>
    <td class="center">2012/02/01</td>
    <td class="center">Staff</td>
    <td class="center">
        <span class="label label-important">Banned</span>
    </td>
    <td class="center">
        <a class="btn" href="#">
            <i class="icon-zoom-in"></i>

        </a>
        <a class="btn" href="#">
            <i class="icon-edit"></i>

        </a>
        <a class="btn" href="#">
            <i class="icon-remove"></i>

        </a>
    </td>
</tr>
<tr>
    <td>Dow John</td>
    <td class="center">2012/02/01</td>
    <td class="center">Admin</td>
    <td class="center">
        <span class="label">Inactive</span>
    </td>
    <td class="center">
        <a class="btn" href="#">
            <i class="icon-zoom-in"></i>

        </a>
        <a class="btn" href="#">
            <i class="icon-edit"></i>

        </a>
        <a class="btn" href="#">
            <i class="icon-remove"></i>

        </a>
    </td>
</tr>
<tr>
    <td>John R</td>
    <td class="center">2012/02/01</td>
    <td class="center">Admin</td>
    <td class="center">
        <span class="label">Inactive</span>
    </td>
    <td class="center">
        <a class="btn" href="#">
            <i class="icon-zoom-in"></i>

        </a>
        <a class="btn" href="#">
            <i class="icon-edit"></i>

        </a>
        <a class="btn" href="#">
            <i class="icon-remove"></i>

        </a>
    </td>
</tr>
<tr>
    <td>Paul Wilson</td>
    <td class="center">2012/03/01</td>
    <td class="center">Member</td>
    <td class="center">
        <span class="label label-warning">Pending</span>
    </td>
    <td class="center">
        <a class="btn" href="#">
            <i class="icon-zoom-in"></i>

        </a>
        <a class="btn" href="#">
            <i class="icon-edit"></i>

        </a>
        <a class="btn" href="#">
            <i class="icon-remove"></i>

        </a>
    </td>
</tr>
<tr>
    <td>Wilson Paul</td>
    <td class="center">2012/03/01</td>
    <td class="center">Member</td>
    <td class="center">
        <span class="label label-warning">Pending</span>
    </td>
    <td class="center">
        <a class="btn" href="#">
            <i class="icon-zoom-in"></i>

        </a>
        <a class="btn" href="#">
            <i class="icon-edit"></i>

        </a>
        <a class="btn" href="#">
            <i class="icon-remove"></i>

        </a>
    </td>
</tr>
<tr>
    <td>Heera Sheikh</td>
    <td class="center">2012/01/21</td>
    <td class="center">Staff</td>
    <td class="center">
        <span class="label label-success">Active</span>
    </td>
    <td class="center">
        <a class="btn" href="#">
            <i class="icon-zoom-in"></i>

        </a>
        <a class="btn" href="#">
            <i class="icon-edit"></i>

        </a>
        <a class="btn" href="#">
            <i class="icon-remove"></i>

        </a>
    </td>
</tr>
<tr>
    <td>Sheikh Heera</td>
    <td class="center">2012/01/21</td>
    <td class="center">Staff</td>
    <td class="center">
        <span class="label label-success">Active</span>
    </td>
    <td class="center">
        <a class="btn" href="#">
            <i class="icon-zoom-in"></i>

        </a>
        <a class="btn" href="#">
            <i class="icon-edit"></i>

        </a>
        <a class="btn" href="#">
            <i class="icon-remove"></i>

        </a>
    </td>
</tr>
<tr>
    <td>Christopher</td>
    <td class="center">2012/08/23</td>
    <td class="center">Staff</td>
    <td class="center">
        <span class="label label-important">Banned</span>
    </td>
    <td class="center">
        <a class="btn" href="#">
            <i class="icon-zoom-in"></i>

        </a>
        <a class="btn" href="#">
            <i class="icon-edit"></i>

        </a>
        <a class="btn" href="#">
            <i class="icon-remove"></i>

        </a>
    </td>
</tr>
<tr>
    <td>Andro Christopher</td>
    <td class="center">2012/08/23</td>
    <td class="center">Staff</td>
    <td class="center">
        <span class="label label-important">Banned</span>
    </td>
    <td class="center">
        <a class="btn" href="#">
            <i class="icon-zoom-in"></i>

        </a>
        <a class="btn" href="#">
            <i class="icon-edit"></i>

        </a>
        <a class="btn" href="#">
            <i class="icon-remove"></i>

        </a>
    </td>
</tr>
<tr>
    <td>Jhon Doe</td>
    <td class="center">2012/06/01</td>
    <td class="center">Admin</td>
    <td class="center">
        <span class="label">Inactive</span>
    </td>
    <td class="center">
        <a class="btn" href="#">
            <i class="icon-zoom-in"></i>

        </a>
        <a class="btn" href="#">
            <i class="icon-edit"></i>

        </a>
        <a class="btn" href="#">
            <i class="icon-remove"></i>

        </a>
    </td>
</tr>
<tr>
    <td>Lorem Ipsum</td>
    <td class="center">2012/03/01</td>
    <td class="center">Member</td>
    <td class="center">
        <span class="label label-warning">Pending</span>
    </td>
    <td class="center">
        <a class="btn" href="#">
            <i class="icon-zoom-in"></i>

        </a>
        <a class="btn" href="#">
            <i class="icon-edit"></i>

        </a>
        <a class="btn" href="#">
            <i class="icon-remove"></i>

        </a>
    </td>
</tr>
<tr>
    <td>Abraham</td>
    <td class="center">2012/03/01</td>
    <td class="center">Member</td>
    <td class="center">
        <span class="label label-warning">Pending</span>
    </td>
    <td class="center">
        <a class="btn" href="#">
            <i class="icon-zoom-in"></i>

        </a>
        <a class="btn" href="#">
            <i class="icon-edit"></i>

        </a>
        <a class="btn" href="#">
            <i class="icon-remove"></i>

        </a>
    </td>
</tr>
<tr>
    <td>Brown Blue</td>
    <td class="center">2012/03/01</td>
    <td class="center">Member</td>
    <td class="center">
        <span class="label label-warning">Pending</span>
    </td>
    <td class="center">
        <a class="btn" href="#">
            <i class="icon-zoom-in"></i>

        </a>
        <a class="btn" href="#">
            <i class="icon-edit"></i>

        </a>
        <a class="btn" href="#">
            <i class="icon-remove"></i>

        </a>
    </td>
</tr>
<tr>
    <td>Worth Name</td>
    <td class="center">2012/03/01</td>
    <td class="center">Member</td>
    <td class="center">
        <span class="label label-warning">Pending</span>
    </td>
    <td class="center">
        <a class="btn" href="#">
            <i class="icon-zoom-in"></i>

        </a>
        <a class="btn" href="#">
            <i class="icon-edit"></i>

        </a>
        <a class="btn" href="#">
            <i class="icon-remove"></i>

        </a>
    </td>
</tr>
</tbody>
</table>


</div><!--/row-->
