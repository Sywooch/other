<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>
<html>
<head>
<?$APPLICATION->ShowHead()?>
<title><?$APPLICATION->ShowTitle()?></title>

<!--[if IE 7]>
<style type="text/css">
#menu{

bottom:1px !important;
}

#menu2{

bottom:4px !important;
}

</style>
<![endif]-->

</head>

<body>


<?$APPLICATION->ShowPanel();?>

<div id="container">

<div id="header">


	

	<!--<div id="login">
		<? //$APPLICATION->IncludeComponent("bitrix:system.auth.form", "auth", Array(
			//"REGISTER_URL"	=>	"/auth/",
			//"PROFILE_URL"	=>	"/personal/profile/"
			//)
		//);
               ?>
	</div>-->

	<div id="menu" style="width:400px;" >


<div style="width:70px; height:70px; float:left;  cursor:pointer; ">
<a href="/" style="color:#ffffff;">
<div align="center" style="width:70px; height:70px; float:left; background-image:url(/images/button_insert.png);  cursor:pointer; ">
<table cellpadding="0" cellspacing="0">
<tr>
<td style="vertical-align:middle; height:70px; width:70px; cursor:pointer; " align="center">

<span style="color:#ffffff; font-size:8pt; cursor:pointer; ">Добавить</span>

</td>
</tr>
</table>
</div>
</a>
</div>

<div style="width:4px; height:70px; float:left;"></div>


	<?$APPLICATION->IncludeComponent("bitrix:menu", "tabs1", Array(
	"ROOT_MENU_TYPE" => "top",	// Тип меню для первого уровня
	"MAX_LEVEL" => "1",	// Уровень вложенности меню
	"USE_EXT" => "N",	// Подключать файлы с именами вида .тип_меню.menu_ext.php
	"MENU_CACHE_TYPE" => "A",	// Тип кеширования
	"MENU_CACHE_TIME" => "3600",	// Время кеширования (сек.)
	"MENU_CACHE_USE_GROUPS" => "N",	// Учитывать права доступа
	"MENU_CACHE_GET_VARS" => "",	// Значимые переменные запроса
	),
	false
);?>
	</div>


<div id="menu2" style="width:62px; height:62px; background-image:url(/images/button_login.png); background-repeat:no-repeat; 
background-position:top center; cursor:pointer; " >
<a href="/" style=" text-decoration:none;">
<div align="center" style="width:62px; height:62px;  cursor:pointer; ">
<table cellpadding="0" cellspacing="0">
<tr>
<td style="vertical-align:middle; height:62px; width:62px; cursor:pointer; " align="center">

<span style="color:#ffffff; font-size:8pt; text-decoration:none; cursor:pointer; ">Войти</span>

</td>
</tr>
</table>
</div>
</a>
</div>






</div><!--header-->





<!--====================================================================-->


<table id="content" cellpadding="0" cellspacing="0">

	<tr>


<td style="width:82px; height:100%;">
<div style="width:82px; height:100%;"></div>
</td>



		<td class="main-column">

<div align="left" style="width:100%; height:69px; background-color:transparent;">

<div style="width:68px; height:69px; background-color:#f4f5f4; margin-left:6px; background-image:url(/images/button_all.png);
background-repeat:no-repeat; background-position:bottom center; position:absolute; cursor:pointer; ">
<a href="/" style=" text-decoration:none;">
<div style="width:68px; height:69px;  cursor:pointer; ">
<table cellpadding="0" cellspacing="0">
<tr>
<td style="vertical-align:middle; height:69px; width:68px; cursor:pointer; " align="center">

<span style="color:#ffffff; font-size:8pt; text-decoration:none;  cursor:pointer; ">Общее</span>

</td>
</tr>
</table>
</div>
</a>
</div>

</div> 


<div style="width:100%; background-color:transparent;  margin-top:-45px;">

<div style="width:793px; margin-left:39px; border:1px #f68220 solid; padding-left:5px; padding-right:5px; padding-bottom:5px; 
padding-top:45px; ">
		
			
			<h1 id="pagetitle" style="display:none;"><?$APPLICATION->ShowTitle(false)?></h1>