
<ul class="breadcrumb">
    <li><a href="."><i class="icon-home"></i></a> <span class="divider">›</span></li>
    <li><a href="users/customers">Пользователи</a> <span class="divider">›</span></li>
    <li><a href="users/customers">Покупатели</a> <span class="divider">›</span></li>
    <li class="active">Дмитрий Грачиков</li>
</ul>
<!--/.breadcrumb-->

<? include('inc/sub_nav_users.php'); ?>


<h1>Дмитрий Грачиков</h1>


<div class="tabbable offset-bottom1">

    <ul class="nav nav-tabs">
        <li class="active"><a href="#customer-info-tab" data-toggle="tab">О покупателе</a></li>
        <li><a href="#customer-account-tab" data-toggle="tab">Счет</a></li>
        <li><a href="#customer-orders-tab" data-toggle="tab">Заказы</a></li>
    </ul>

    <!--
    TODO: tabs must be accessible through the anchors to redirect user after a submit action to
    -->

    <div class="tab-content">

        <div class="tab-pane active" id="customer-info-tab">
            <? include('pages/users/customers/user-profile-about.php'); ?>
        </div><!-- /#customer-info-tab -->

        <div class="tab-pane" id="customer-account-tab">
            <? include('pages/users/customers/user-profile-account.php'); ?>
        </div><!-- /#customer-account-tab -->

        <div class="tab-pane" id="customer-orders-tab">
            <? include('pages/users/customers/user-profile-orders.php'); ?>
        </div><!-- /#customer-orders-tab -->

    </div><!-- /.tab-content-->

</div><!-- /.tabbable -->


<p><a href="users/customers"><i class="icon-linked icon-reply"></i>К списку покупателей</a></p>


