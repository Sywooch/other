<? include('inc/app_conf.php'); ?>

<!DOCTYPE html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7"> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8"> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9"> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js"> <!--<![endif]-->
<head>
    <base href="http://<?=$_SERVER['HTTP_HOST'].$diff?>/"/>
    <title>☼ Административный интерфейс платформы Opentao</title>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta name="description" content="Административный интерфейс платформы Opentao">
    <meta name="viewport" content="width=device-width">

<!-- Fremaworks -->
    <link rel="stylesheet" href="css/vendor/bootstrap.css">
    <link rel="stylesheet" href="css/vendor/bootstrap-responsive.css">

<!-- Themes -->
    <link rel="stylesheet" href="css/vendor/vendor-themes.css">

<!-- Plugins -->
    <link rel="stylesheet" href="css/vendor/dataTables-bootstrap.css">
    <link rel="stylesheet" href="css/vendor/tabdrop.css">
    <link rel="stylesheet" href="css/vendor/font-awesome.css">
    <link rel="stylesheet" href="css/vendor/bootstrap-editable.css">
    <link rel="stylesheet" href="css/vendor/select2.css">
    <link rel="stylesheet" href="css/vendor/jquery.pnotify.css">
    <link rel="stylesheet" href="css/vendor/bootstrap-lightbox.css">
    <link rel="stylesheet" href="css/vendor/bootstrap-fileupload.css">
    <link rel="stylesheet" href="css/vendor/bootstrap-select.css">
    <link rel="stylesheet" href="css/vendor/bootstrap-image-gallery.css">
    <link rel="stylesheet" href="css/vendor/bootstrap-dropdown-ext.css">
    <link rel="stylesheet" href="css/vendor/ladda.min.css">

<!-- OT application -->
    <link rel="stylesheet" href="css/ot/ot-app.css">
    <link rel="stylesheet" href="css/ot/ot-pages.css">
    <link rel="stylesheet" href="css/ot/ot-responsive.css">

<!-- improve button-preloading plugin -->
    <script src="js/vendor/spin.min.js"></script>
    <script src="js/vendor/ladda.min.js"></script>

</head>
<body>

<?
    if($uri == 'login' ) :
        include("inc/login.php"); //show authorisation page
    else:
        include("inc/content.php"); //show admin interface pages
    endif;
?>



<!-- Placed at the end of the document so the pages load faster -->
<script src="//ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
<script>window.jQuery || document.write('<script src="js/vendor/jquery-1.9.1.min.js"><\/script>')</script>

<!-- bootstrap -->
<script src="js/vendor/bootstrap.min.js"></script>

<!-- Polifills -->
<script src="js/vendor/modernizr-2.6.2-respond-1.1.0.min.js"></script>

<!-- fixing elements to the top when scroling content -->
<script src="js/vendor/portamento.js"></script>


<!-- datatables plugin — powerfull extention for tables -->
<script src="js/vendor/jquery.dataTables.min.js"></script>
<script src="js/vendor/dataTables-bootstrap.js"></script>
<script src="js/vendor/FixedHeader.js"></script>

<!-- Making long tabs into dropdown one -->
<script src="js/vendor/bootstrap-tabdrop.js"></script>

<!-- inline-editable fields -->
<script src="js/vendor/bootstrap-editable.min.js"></script>
<script src="js/vendor/moment.min.js"></script>

<!-- clickable tooltips -->
<script src="js/vendor/bootstrapx-clickover.js"></script>

<!-- drug'n drop sortable  plugin -->
<script src="js/vendor/jquery-sortable-min.js"></script>

<!--  replacement for selects -->
<script src="js/vendor/select2.min.js"></script>
<script src="js/vendor/select2_locale_ru.js"></script>

<!-- datepicker -->
<script src="js/vendor/bootstrap-datepicker.js"></script>
<script src="js/vendor/bootstrap-datepicker.ru.js"></script>

<!-- js system notifications -->
<script src="js/vendor/jquery.pnotify.min.js"></script>

<!-- lightbox -->
<script src="js/vendor/bootstrap-lightbox.js"></script>

<!--  files uploads -->
<script src="js/vendor/bootstrap-fileupload.js"></script>

<!-- new look of default selects -->
<script src="js/vendor/bootstrap-select.min.js"></script>

<!-- bootstrap-image-gallery -->
<script src="js/vendor/load-image.js"></script>
<script src="js/vendor/bootstrap-image-gallery.min.js"></script>

<!-- bootstrap-dropdown plugin -->
<script src="js/vendor/bootstrap-dropdown-ext.js"></script>

<!-- hotkeys plugin -->
<script src="js/vendor/jquery.hotkeys.js"></script>

<!-- tree plugin -->
<script src="js/vendor/jquery.jstree.js"></script>

<!-- selects autoresize -->
<script src="js/vendor/jquery.autosize.js"></script>

<!-- OT custom -->
<script src="js/plugins.js"></script>
<script src="js/ot-app.js"></script>

<? //include("inc/yandex_metrika.php"); ?>

</body>
</html>


<?php

