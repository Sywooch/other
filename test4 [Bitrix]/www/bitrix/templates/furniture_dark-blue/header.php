<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>
<?
IncludeTemplateLangFile(__FILE__);
?> 
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="ru" lang="ru">
<head>
<meta http-equiv="X-UA-Compatible" content="IE=edge" />
<?$APPLICATION->ShowHead();?>
<link href="<?=SITE_TEMPLATE_PATH?>/common.css" type="text/css" rel="stylesheet" />
<link href="<?=SITE_TEMPLATE_PATH?>/colors.css" type="text/css" rel="stylesheet" />

	<!--[if lte IE 6]>
	<style type="text/css">
		
		#banner-overlay { 
			background-image: none;
			filter: progid:DXImageTransform.Microsoft.AlphaImageLoader(src='<?=SITE_TEMPLATE_PATH?>images/overlay.png', sizingMethod = 'crop'); 
		}
		
		div.product-overlay {
			background-image: none;
			filter: progid:DXImageTransform.Microsoft.AlphaImageLoader(src='<?=SITE_TEMPLATE_PATH?>images/product-overlay.png', sizingMethod = 'crop');
		}
		
	</style>
	<![endif]-->



<!--<script src="//ajax.googleapis.com/ajax/libs/jquery/1.8.2/jquery.min.js"></script>

<script src="/js/jquery.bxslider.min.js"></script>
<script src="/js/script.js"></script>
<script src="/js/jquery.fitvids.js"></script>
<script src="/js/jquery.easing.1.3.js"></script>
<link href="/css_slider/jquery.bxslider.css" type="text/css"  rel="stylesheet" />-->


	<title><?$APPLICATION->ShowTitle()?></title>
</head>
<body style="background-color:#d5d5d5;">
	<div id="panel"><?$APPLICATION->ShowPanel();?></div>
<div align="center" style="margin:0; padding:0; width:100%;" class="div_100_100">

	<div id="page-wrapper">

		<div id="header" class="transparent_line" >
	
<div align="center" style="width:1100px; height:100%; background-color:transparent;" >
<!--left-->
<div style="height:100%; width:650px; float:left;" class="logo_header"></div>
<!--left-->

<!--right-->
<div style="height:100%; width:300px; float:right;">
<div style="height:30px; width:300px; background-color:transparent;" >
<div style="height:100%; width:130px; float:left;"></div><div  style="height:100%; width:130px; float:left; background-color:transparent;" 
class="rus_eng">

<div style="width:40px; height:100%; float:left;"></div>
<div style="width:70px; height:100%; float:left; border-left:0px black solid; border-right:0px black solid;">
<div style="width:70px; height:5px; "></div>
<span style="font-size:8pt; font-weight:bold;">

<a href="index.php" style="<? $CurrPage = $APPLICATION->GetCurPage(true);
    $Page = explode("/", $CurrPage );
    $ThisArrSiz = sizeof($Page);
    $CurrPage=$Page[$ThisArrSiz-1];
     $HomePage = 'index.php'; 
     if ($CurrPage==$HomePage) echo' color:#6eaa39; ';
     else echo' color:#4c4c4c; '; ?> text-decoration:none;">Рус</a><span style="color:#4c4c4c;"> /</span>
<a href="index_en.php" style=" <? $CurrPage = $APPLICATION->GetCurPage(true);
$Page = explode("/", $CurrPage );
    $ThisArrSiz = sizeof($Page);
    $CurrPage=$Page[$ThisArrSiz-1];
     
 $HomePage = 'index_en.php';
     if ($CurrPage==$HomePage) echo' color:#6eaa39; ';
     else echo' color:#4c4c4c; '; ?>  text-decoration:none;">Eng</a>

</span>
</div> 



</div></div>

<div align="left" style="height:80px; width:300px;  background-color:transparent;">
<span style="font-size:9pt; color:#5a5959; font-weight:bold;">192019, Санкт-Петербург, ул.Бехтерева 3.</br>
тел. +7 812 3652222, +7 812 3652323</br>
<a href="" style="font-size:9pt; color:#5a5959; text-decoration:none; cursor:pointer;  font-weight:bold;">
<span>Запись на диагностику on-line</span></a></span>
</div>


</div>
<!--right-->

</div>




		
		<!--	<table id="logo">
				<tr>
					<td><a href="<?=SITE_DIR?>" title="<?=GetMessage('CFT_MAIN')?>"><?
$APPLICATION->IncludeFile(
	SITE_DIR."include/company_name.php",
	Array(),
	Array("MODE"=>"html")
);
?></a></td>
				</tr>
			</table>-->
			

	<!--		<div id="top-icons">
				<a href="<?=SITE_DIR?>" class="home-icon" title="<?=GetMessage('CFT_MAIN')?>"></a>
				<a href="<?=SITE_DIR?>search/" class="search-icon" title="<?=GetMessage('CFT_SEARCH')?>"></a>
				<a href="<?=SITE_DIR?>contacts/" class="feedback-icon" title="<?=GetMessage('CFT_FEEDBACK')?>"></a>
			</div>-->
		
		</div>
		
	<!--	<div id="banner">		
			<table id="banner-layout" cellspacing="0">
				<tr>
					<td id="banner-image"><div><img src="<?=SITE_TEMPLATE_PATH?>/images/head.jpg" /></div></td>
					<td id="banner-slogan">
<?
$APPLICATION->IncludeFile(
	SITE_DIR."include/motto.php",
	Array(),
	Array("MODE"=>"html")
);
?>
					</td>
				</tr>
			</table>
			<div id="banner-overlay"></div>	
		</div>-->
	



	
		<div id="content" style="background-color:transparent; width:1100px; ">
		
<!--block1-->
<div align="center" style="width:100%; background-color:transparent; float:left;" class="block1">


<!--block2-->
<div style="float:left; width:800px; background-color:transparent;">


<!--gorizontal menu-->
<div align="right" style="width:100%; height:103px; background-color:transparent;">
			<div id="top-menu">
				<div id="top-menu-inner"  style="padding-right:0px;">
<?$APPLICATION->IncludeComponent("bitrix:menu", "horizontal_multilevel5", array(
	"ROOT_MENU_TYPE" => "top",
	"MENU_CACHE_TYPE" => "A",
	"MENU_CACHE_TIME" => "36000000",
	"MENU_CACHE_USE_GROUPS" => "N",
	"MENU_CACHE_GET_VARS" => array(
	),
	"MAX_LEVEL" => "3",
	"CHILD_MENU_TYPE" => "left",
	"USE_EXT" => "Y",
	"DELAY" => "N",
	"ALLOW_MULTI_SELECT" => "N"
	),
	false,
	array(
	"ACTIVE_COMPONENT" => "Y"
	)
);?>
				</div>
			</div>
			

</div>
<!--gorizontal menu-->


<!--block3-->
<div style="width:100%; ">



<!--left menu-->
<div style="width:235px; float:left;">
<div style="width:235px; height:450px;">


<!--search-->
<div style="width:235px; height:30px; background-color:transparent; ">
<div style="width:30px; height:30px; float:left;"></div>

<div style="height:30px; float:left; width:150px;">

<?
$APPLICATION->IncludeComponent("bitrix:search.form", "flat1", Array(
	"PAGE" => "#SITE_DIR#search/",	// Страница выдачи результатов поиска (доступен макрос #SITE_DIR#)
	),
	false
);
?>

</div>




</div>
<!--search-->



<?$APPLICATION->IncludeComponent("bitrix:main.include", "template1", array(
	"AREA_FILE_SHOW" => "sect",
	"AREA_FILE_SUFFIX" => "inc_left_menu2",
	"AREA_FILE_RECURSIVE" => "N",
	"EDIT_TEMPLATE" => "standard.php"
	),
	false
);?>







<div style="width:100%; height:30px; float:left;"></div>



</div>
</div>
<!--left menu-->



<!--main content-->
<div align="center" style="width:560px; float:left; background-color:transparent;">

<div id="workarea" style="width:100%;">
				<!--<h1 id="pagetitle"><?$APPLICATION->ShowTitle(false);?></h1>-->