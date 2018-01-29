
<ul class="breadcrumb">
    <li><a href="."><i class="icon-home"></i></a> <span class="divider">›</span></li>
    <li><a href="content/pages">Содержание</a> <span class="divider">›</span></li>
    <li class="active">Страницы</li>
</ul>
<!--/.breadcrumb-->

<? include('inc/sub_nav_content.php'); ?>


<div class="row-fluid">

    <div class="span10">
        <h1>Страницы</h1>
    </div>

    <div class="span2 offset-top1">
        <!-- site language -->
        <div class="btn-group pull-right">
            <a class="btn dropdown-toggle offset-top05" data-toggle="dropdown" href="#" title="Выбрать языковую версию сайта для редактирования">
                Ru
                <span class="caret"></span>
            </a>
            <ul class="dropdown-menu">
                <li><a data-value="Eng" href="#">Eng</a></li>
                <li><a data-value="Ch" href="#">Ch</a></li>
            </ul>
        </div>
        <!-- /site language -->
    </div>

</div>


<div class="tabbable offset-bottom1">

    <ul class="nav nav-tabs">
        <li class="active"><a href="#ot-content-pages-tab" data-toggle="tab">Разделы</a></li>
        <li><a href="#ot-content-service-pages-tab" data-toggle="tab">Служебные</a></li>
    </ul>

    <!--
    TODO: tabs must be accessible through the anchors to redirect user after a submit action to
    -->

    <div class="tab-content">

        <div class="tab-pane active" id="ot-content-pages-tab">
            <? include('pages/content/pages/content-pages.php'); ?>
        </div><!-- /#ot-content-pages-tab -->

        <div class="tab-pane" id="ot-content-service-pages-tab">
            <? include('pages/content/pages/service-pages.php'); ?>
        </div><!-- /#ot-content-service-pages-tab -->

    </div><!-- /.tab-content-->

</div><!-- /.tabbable -->