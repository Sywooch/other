<!DOCTYPE html>
<html dir="<?php echo $direction; ?>" lang="<?php echo $lang; ?>">
<head>
<meta charset="UTF-8" />
<title><?php echo $title; if (isset($_GET['page'])) { echo " - ". ((int) $_GET['page'])." ".$text_page;} ?></title>
<base href="<?php echo $base; ?>" />
<?php if ($description) { ?>
<meta name="description" content="<?php echo $description; if (isset($_GET['page'])) { echo " - ". ((int) $_GET['page'])." ".$text_page;} ?>" />
<?php } ?>
<?php if ($keywords) { ?>
<meta name="keywords" content="<?php echo $keywords; ?>" />
<?php } ?>


<link href="" rel="icon" />
<?php /*
<?php foreach ($links as $link) { ?>
<link href="<?php echo $link['href']; ?>" rel="<?php echo $link['rel']; ?>" />
<?php } ?>
<link rel="stylesheet" type="text/css" href="catalog/view/theme/default/stylesheet/stylesheet.css" />
<?php foreach ($styles as $style) { ?>
<link rel="<?php echo $style['rel']; ?>" type="text/css" href="<?php echo $style['href']; ?>" media="<?php echo $style['media']; ?>" />
<?php } ?>
<script type="text/javascript" src="catalog/view/javascript/jquery/jquery-1.7.1.min.js"></script>
<script type="text/javascript" src="catalog/view/javascript/jquery/ui/jquery-ui-1.8.16.custom.min.js"></script>
<link rel="stylesheet" type="text/css" href="catalog/view/javascript/jquery/ui/themes/ui-lightness/jquery-ui-1.8.16.custom.css" />
<script type="text/javascript" src="catalog/view/javascript/common.js"></script>
<?php foreach ($scripts as $script) { ?>
<script type="text/javascript" src="<?php echo $script; ?>"></script>
<?php } ?>
*/ ?>
<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
<meta name="apple-mobile-web-app-capable" content="yes">

<script src="catalog/view/theme/default/js/jquery-1.7.2.min.js"></script>
<script src="catalog/view/theme/default/js/excanvas.min.js"></script>
<script src="catalog/view/theme/default/js/chart.min.js" type="text/javascript"></script>
<script src="catalog/view/theme/default/js/bootstrap.js"></script>
<script src="catalog/view/theme/default/js/base.js"></script>


<script src="catalog/view/theme/default/js/faq.js"></script>


<script>

$(function () {
	
	$('.faq-list').goFaq();

});

</script>


<link href="catalog/view/theme/default/css/bootstrap.min.css" rel="stylesheet">
<link href="catalog/view/theme/default/css/bootstrap-responsive.min.css" rel="stylesheet">
<link href="http://fonts.googleapis.com/css?family=Open+Sans:400italic,600italic,400,600"
        rel="stylesheet">
<link href="catalog/view/theme/default/css/font-awesome.css" rel="stylesheet">
<link href="catalog/view/theme/default/css/style.css" rel="stylesheet">
<link href="catalog/view/theme/default/css/pages/dashboard.css" rel="stylesheet">
 <link href="catalog/view/theme/default/css/pages/reports.css" rel="stylesheet">
 <link href="catalog/view/theme/default/css/pages/signin.css" rel="stylesheet" type="text/css">
 <link href="catalog/view/theme/default/css/pages/faq.css" rel="stylesheet"> 
<!-- Le HTML5 shim, for IE6-8 support of HTML5 elements -->
<!--[if lt IE 9]>
      <script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
    <![endif]-->

</head>
<body>
<div id="container">
<div id="notification"></div>