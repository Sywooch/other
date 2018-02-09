<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>
<?
IncludeTemplateLangFile(__FILE__);
?>






<!DOCTYPE html>
<html dir="ltr" lang="ru">
<head>
<meta charset="UTF-8" />
<meta name="viewport" content="width=device-width, initial-scale=1">
<title><?$APPLICATION->ShowTitle()?></title>
<meta name="description" content="Vstarcam – лучший выбор среди ip  камер:  простые настройки, Wifi, Apple и Android клиенты
&#9742;: (495) 778-55-28, &#9742;: (812) 970-79-97
" />
<meta name="keywords" content="vstarcam, камера vstarcam, p2p камера, ip камера, ip камеры видеонаблюдения, ip камера уличная, ip камера wifi, ip камера купить, p2p ip камера, p2p wifi камера" />
<link href="/favicon.ico" rel="icon" />
<link href='http://fonts.googleapis.com/css?family=PT+Sans:400,700italic,700,400italic&subset=latin,cyrillic-ext,latin-ext,cyrillic' rel='stylesheet' type='text/css'>

<!-- bitrix -->
<?$APPLICATION->ShowHead();?>
<!-- bitrix -->

<!--
	<link href="/bitrix/js/main/core/css/core_admin.css" type="text/css" rel="stylesheet" />
	<link href="/bitrix/js/main/core/css/core_panel.css" type="text/css" rel="stylesheet" />
-->
<!--
<link href="<?=SITE_TEMPLATE_PATH?>/common.css" type="text/css" rel="stylesheet" />
<link href="<?=SITE_TEMPLATE_PATH?>/colors.css" type="text/css" rel="stylesheet" />
-->
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


<link rel="stylesheet" type="text/css" href="catalog/view/theme/default/stylesheet/nojs.css" media="screen" />
<link rel="stylesheet" type="text/css" href="catalog/view/theme/default/stylesheet/demo.css" media="screen" />
<link rel="stylesheet" type="text/css" href="catalog/view/theme/default/stylesheet/style.css" media="screen" />
<link rel="stylesheet" type="text/css" href="catalog/view/theme/default/stylesheet/carousel.css" media="screen" />
<link rel="stylesheet" type="text/css" href="catalog/view/theme/default/stylesheet/style_fonts.css" />
<link rel="stylesheet" type="text/css" href="catalog/view/theme/default/stylesheet/animate.css" />
<link rel="stylesheet" type="text/css" href="catalog/view/theme/default/stylesheet/stylesheet.css" />
<link rel="stylesheet" type="text/css" href="catalog/view/theme/default/stylesheet/media.css" />
<script type="text/javascript" src="catalog/view/javascript/jquery/jquery-1.7.1.min.js"></script>


<script type="text/javascript" src="catalog/view/javascript/jquery/ui/jquery-ui-1.8.16.custom.min.js"></script>
<link rel="stylesheet" type="text/css" href="catalog/view/javascript/jquery/ui/themes/ui-lightness/jquery-ui-1.8.16.custom.css" />
<script type="text/javascript" src="catalog/view/javascript/jquery/ui/external/jquery.cookie.js"></script>
<script type="text/javascript" src="catalog/view/javascript/jquery/colorbox/jquery.colorbox.js"></script>
<link rel="stylesheet" type="text/css" href="catalog/view/javascript/jquery/colorbox/colorbox.css" media="screen" />
<script type="text/javascript" src="catalog/view/javascript/jquery/tabs.js"></script>
<script type="text/javascript" src="catalog/view/javascript/common2.js"></script>

<script type="text/javascript" src="catalog/view/javascript/jquery/slider/modernizr.custom.28468.js"></script>
<script type="text/javascript" src="catalog/view/javascript/jquery/jquery.jcarousel.min.js"></script>
<!--[if IE 7]>
<link rel="stylesheet" type="text/css" href="catalog/view/theme/default/stylesheet/ie7.css" />
<![endif]-->
<!--[if lt IE 7]>
<link rel="stylesheet" type="text/css" href="catalog/view/theme/default/stylesheet/ie6.css" />
<script type="text/javascript" src="catalog/view/javascript/DD_belatedPNG_0.0.8a-min.js"></script>
<script type="text/javascript">
DD_belatedPNG.fix('#logo img');
</script>
<![endif]-->





<link rel="stylesheet" type="text/css" href="catalog/view/theme/default/stylesheet/stylesheet2.css" />


<script type="text/javascript">
$(document).ready(function() {
   $('a[href^="#"]').click(function () { 
     elementClick = $(this).attr("href");
     destination = $(elementClick).offset().top;
     if($.browser.safari){
       $('body').animate( { scrollTop: destination }, 1100 );
     }else{
       $('html').animate( { scrollTop: destination }, 1100 );
     }
     return false;
   });
 });
 
 
 
</script>
<script>
$(document).ready(function(){
	// прячем кнопку #back-top
	$("#back-top").hide();
	
	// появление/затухание кнопки #back-top
	$(function (){
		$(window).scroll(function (){
			if ($(this).scrollTop() > 100){
				$('#back-top').fadeIn();
			} else{
				$('#back-top').fadeOut();
			}
		});

		// при клике на ссылку плавно поднимаемся вверх
		$('#back-top a').click(function (){
			$('body,html').animate({
				scrollTop:80
			}, 800);
			
			return false;
		});
	});
});
</script>





<script type="text/javascript">
	jQuery(document).ready(function(){
	    /* функция кроссбраузерного определения отступа от верха документа к текущей позиции скроллера прокрутки */
	    function getScrollTop() {
	               var scrOfY = 0;
	               if( typeof( window.pageYOffset ) == "number" ) {
	                       //Netscape compliant
	                       scrOfY = window.pageYOffset;
	               } else if( document.body
	               && ( document.body.scrollLeft
	               || document.body.scrollTop ) ) {
	                       //DOM compliant
	                       scrOfY = document.body.scrollTop;
	               } else if( document.documentElement
	               && ( document.documentElement.scrollLeft
	                || document.documentElement.scrollTop ) ) {
	                       //IE6 Strict
	                       scrOfY = document.documentElement.scrollTop;
	               }
	               return scrOfY;
	    }
	    /* пересчитываем отступ при прокрутке экрана */
		jQuery(window).ready(function() { 
           fixPaneRefresh(); 
        });
		
	    jQuery(window).scroll(function() {
	        fixPaneRefresh();
	    });
		
	     
	    function fixPaneRefresh(){
	        if (jQuery("#fixed_block").length) {
	            var top  = getScrollTop();
				if ($(window).width() < 960) {
			          if (top < 120) jQuery("#fixed_block").css("margin-top",120-top+"px");				
				      else jQuery("#fixed_block").css("margin-top","0");
				} else {
					  if (top < 73) jQuery("#fixed_block").css("margin-top",73-top+"px");				
				      else jQuery("#fixed_block").css("margin-top","0");
				
				}
	        }
			
	    }
	 
	});
</script>





</head>
<body>  


<!--<div id="page-wrapper">-->
	<div id="panel" style="position:fixed; bottom:0px; left:0px; width:100%; display:block; z-index:999;"><?$APPLICATION->ShowPanel();?></div>
<!--</div>-->






<div id="frame_block"></div>
<div id="fixed_block"><div id="container2"><div id="cart">
  <div class="heading">
    
    <a><span id="cart-total">Товаров: 0 (0 руб.)</span></a></div>
  <div class="content">
        <div class="empty">Ничего не куплено!</div>
      </div>
</div>  <div class="links">
   <!--link1--> 
<div id="menu">
<div class="navbar-header">
      <button type="button" class="navbar-toggle icon-bar" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
      
      </button>
  
  <div id="search2">
     <div class="button-search-view icon-search74"></div>
     <div class="search-form">
    <div class="button-search icon-search74"></div>
    
    <input type="text" name="filter_name" placeholder="Поиск" value="" />
     <i class="close icon-cancel-circle"> </i>
  </div>
   </div>
      
    </div>





<!--menu-->
<?$APPLICATION->IncludeComponent("bitrix:menu", "horizontal_multilevel2", Array(
	"ROOT_MENU_TYPE" => "top",	// Тип меню для первого уровня
		"MAX_LEVEL" => "2",	// Уровень вложенности меню
		"CHILD_MENU_TYPE" => "left",	// Тип меню для остальных уровней
		"USE_EXT" => "Y",	// Подключать файлы с именами вида .тип_меню.menu_ext.php
		"MENU_CACHE_TYPE" => "A",	// Тип кеширования
		"MENU_CACHE_TIME" => "36000000",	// Время кеширования (сек.)
		"MENU_CACHE_USE_GROUPS" => "Y",	// Учитывать права доступа
		"MENU_CACHE_GET_VARS" => "",	// Значимые переменные запроса
	),
	false,
	array(
	"ACTIVE_COMPONENT" => "Y"
	)
);?>


<!--menu-->

	<div style="display:none;">
<?$APPLICATION->IncludeComponent("bitrix:menu", "left", array(
	"ROOT_MENU_TYPE" => "left",
	"MENU_CACHE_TYPE" => "A",
	"MENU_CACHE_TIME" => "36000000",
	"MENU_CACHE_USE_GROUPS" => "Y",
	"MENU_CACHE_GET_VARS" => array(
	),
	"MAX_LEVEL" => "1",
	"CHILD_MENU_TYPE" => "left",
	"USE_EXT" => "Y",
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
   
     
                   <div id="search">
                                         <input type="text" name="filter_name" value="Поиск" onClick="this.value = '';" onKeyDown="this.style.color = '#000000';" />
                                         <div class="button-search"><img src="/catalog/view/theme/default/image/search_icon.png" alt="" /></div>
                  </div>
                  
     </div>
                  
     </div>


<div id="opaclayer" onClick="closeCart();"></div>
<div class="container">
<div id="cart-success"></div>
<div id="header">
	<div id="logo"><a href="/"><img src="/image/data/logo.png" title="Vstarcam " alt="Vstarcam " /></a></div>
  
   <div id="telefon">
	<a href="tel:+74952301757"><span class="city">Москва</span> <span>(495)</span> 230-17-57;</a>
	<a href="tel:+78129707997"><span class="city">Санкт-Петербург</span> <span>(812)</span> 970-79-97;  </a>
    <span id="callback-click" ><a id="callback-click" class="button" href="#">Обратный звонок</a>
     </span>
	<!--<a href="tel:+74942712746"><span class="city">Липецк</span> <span>(494)</span> 271-27-46;</a>
	<a class="xs-hidden" href="tel:+78612901615"><span class="city ">Краснодар</span> <span>(861)</span> 290-16-15; </a><br>-->
	<p style="font-size:14px; color:#000; text-align: right;"><strong>Эксклюзивный дистрибьютор по РФ. Гарантийное обслуживание и поддержка.</strong></p>
	
   </div>



</div>





<div id="notification"></div>
</div></div><style type="text/css">
#callback-form {display:none;}#simplemodal-overlay {background-color:#000; cursor:wait;}#simplemodal-container {height:250px; width:560px; color:#bbb; background-color:#333; border:4px solid #444; padding:12px;}#simplemodal-container .simplemodal-data{padding:8px}#simplemodal-container code{background:#141414;border-left:3px solid #65B43D;color:#bbb;display:block;font-size:12px;margin-bottom:12px;padding:4px 6px 6px}#simplemodal-container a{color:#ddd}#simplemodal-container a.modalCloseImg{background:url(catalog/view/javascript/jquery/simplemodal/x.png) no-repeat;width:25px;height:29px;display:inline;z-index:3200;position:absolute;top:-15px;right:-16px;cursor:pointer}.dialogContentText h2{color:#BBBBBB}.callbackForm{text-align: left;}.time-arrow{text-align:center;width:45px;margin-bottom:0}.time-arrow img{cursor:pointer}.time{color:#fff;font:14px "Franklin Gothic Book", "helvetica";height:18px;line-height:18px;text-align:center;width:45px;margin-bottom:0}.time-label{float:left;padding-right:17px;clear:both}.time-label label{line-height:50px}.time-dash{color:#fff;float:left;font:14px "Franklin Gothic Book", "helvetica";line-height:50px;padding:0 4px}p{font-size:14px}.rc5{border-radius:5px 5px 5px 5px}.cb-txt,.cb-txt-290,.cb-area{background:#fff;border:1px solid #b2b5b7;border-radius:5px;-moz-border-radius:5px;-webkit-border-radius:5px;-khtml-border-radius:5px;color:#000;font-size:14px;height:24px;line-height:24px;padding:0 4px;width:180px}.fb-send{margin:0}.cb-txt-290{margin:0 14px 0 0;width:290px}.cb-area{margin:0 14px 0 0;width:480px;height:70px}.cb-send{background:#18a6e5;border:0;border-radius:5px;-moz-border-radius:5px;-webkit-border-radius:5px;-khtml-border-radius:5px;color:#000;cursor:pointer;font-size:14px;height:24px;padding-bottom:3px;text-align:center;width:125px}.cb-send:hover{background:#0e6389}
#callback-click{padding: 7px 14px  !important  ;}
#callback-form input{width: 93%;}
</style>
<div class="box" style="display: none">
  <div class="box-heading">Обратный звонок</div>
  <div class="box-content">
    <div class="box-product">
     <div id="callback-click"><a href="#">Обратный звонок</a>
     </div>
     <div id="callback-form">
     	<div class="dialogContentText">
     		<h2>Оставьте свои контактные данные, и мы Вам перезвоним:</h2>
     		<form method="post" action="http://vstarcam.ru/index.php?route=module/callback/send" class="callbackForm">
     		 <input type="hidden" value="10" class="time-min">
     		 <input type="hidden" value="19" class="time-max">
     		 <input type="hidden" value="10" class="time-start" name="OrderCallTimeStart">
     		 <input type="hidden" value="18" class="time-end" name="OrderCallTimeEnd">
     		 <input type="hidden" value="/index.php?route=common/home" name="uri">
     		 <p class="cb-schedule"></p>
     		 <table>
     		  <tbody>
     		       		   <tr>
     		    <td>
     		     <p><label>Имя:</label></p>
     		     <p><input type="text" id="OrderFirstName" class="cb-txt-290 rc5" maxlength="200" name="OrderFirstName" value=""></p>
     		    </td>
     		    <td>
     		     <p><label>Телефон:</label></p><p><input id="OrderPhoneMobile" type="text" class="cb-txt rc5" maxlength="200" name="OrderPhoneMobile"></p>
     		    </td>
     		   </tr>
     		       		   <tr>
     		    <td>
     		     <div class="time-label"><label>В какое время Вам перезвонить?</label></div>
     		     <div style="float:left">
     		      <p class="time-arrow time-arrow-up"><img width="8" height="7" alt="&#923;" src="catalog/view/javascript/jquery/simplemodal/arrow_up.png"></p>
     		      <p class="time"><span class="time-start">10</span>:00</p>
     		      <p class="time-arrow time-arrow-down"><img width="8" height="7" alt="V" src="catalog/view/javascript/jquery/simplemodal/arrow_down.png"></p>
     		     </div>
     		     <div class="time-dash">-</div>
     		     <div style="float:left">
     		      <p class="time-arrow time-arrow-up"><img width="8" height="7" alt="&#923;" src="catalog/view/javascript/jquery/simplemodal/arrow_up.png"></p>
     		      <p class="time"><span class="time-end">18</span>:00</p>
     		      <p class="time-arrow time-arrow-down"><img width="8" height="7" alt="V" src="catalog/view/javascript/jquery/simplemodal/arrow_down.png"></p>
     		     </div>
     		    </td>
     		    <td style="text-align:right; vertical-align:middle">
     		     <p class="fb-send"><input type="submit" value="отправить" class="cb-send rc5"></p>
     		    </td>
     		   </tr>
     		  </tbody>
     		 </table>
     		</form>
        </div>
  </div>
  <!-- preload the images -->
  <div style='display:none'>
    <img src='catalog/view/javascript/jquery/simplemodal/x.png' alt='' />
    <img width="20" height="14" alt="&#923;" src="catalog/view/javascript/jquery/simplemodal/arrow_up.png">
    <img width="20" height="14" alt="V" src="catalog/view/javascript/jquery/simplemodal/arrow_down.png">
  </div>

</div>
  <script type='text/javascript' src='catalog/view/javascript/jquery/simplemodal/simplemodal.js'></script>
  <script type='text/javascript'>
$('.time-arrow-down img').click(function(){var $inputLink=$(this).closest('div').find('p.time span');if($inputLink){var inputLinkNumber=parseInt($inputLink.html())-1;if($inputLink.hasClass('time-start')){var inputLinkNumberMin=parseInt($(this).closest('form').find('input.time-min').val());if(inputLinkNumber<inputLinkNumberMin){inputLinkNumber=inputLinkNumberMin}$(this).closest('form').find('input.time-start').val(inputLinkNumber)}else if($inputLink.hasClass('time-end')){var inputLinkNumberMin=parseInt($(this).closest('form').find('span.time-start').html());if(inputLinkNumber<=inputLinkNumberMin){inputLinkNumber=inputLinkNumberMin+1}$(this).closest('form').find('input.time-end').val(inputLinkNumber)}$inputLink.html(inputLinkNumber)}});$('.time-arrow-up img').click(function(){var $inputLink=$(this).closest('div').find('p.time span');if($inputLink){var inputLinkNumber=parseInt($inputLink.html())+1;if($inputLink.hasClass('time-end')){var inputLinkNumberMax=parseInt($(this).closest('form').find('input.time-max').val());if(inputLinkNumber>inputLinkNumberMax){inputLinkNumber=inputLinkNumberMax}$(this).closest('form').find('input.time-end').val(inputLinkNumber)}else if($inputLink.hasClass('time-start')){var inputLinkNumberMax=parseInt($(this).closest('form').find('span.time-end').html());if(inputLinkNumber>=inputLinkNumberMax){inputLinkNumber=inputLinkNumberMax-1}$(this).closest('form').find('input.time-start').val(inputLinkNumber)}$inputLink.html(inputLinkNumber)}});$('span.time-start').each(function(){$(this).closest('form').find('input.time-start').val($(this).html())});$('span.time-end').each(function(){$(this).closest('form').find('input.time-end').val($(this).html())});
$("#OrderPhoneMobile").inputmask("mask", {"mask": "+9(999) 999-9999", clearIncomplete: true });
$.extend($.inputmask.defaults.definitions, {'a': {"validator": "[A-Za-zА-Яа-я ]","cardinality": 1,"prevalidator": null}});
$("#OrderFirstName").inputmask({"mask": "a", "repeat": 40, "greedy": false});
 </script>
  </div>
</div>




<!---->



	<div style="width:100%; height:20px; background-color:red;display:none; "></div>



<? if ($APPLICATION->GetCurPage(false) !== '/'): ?> 





<div class="breadcrumb_curier"><div class="breadcrumb">
        <a href="http://vstarcam.ru/index.php?route=common/home">Главная</a>
         - <a href="http://vstarcam.ru/p2p-pnp-service.html">Уникальные сервисы P2P и PNP</a>
      </div>  </div>





<div id="container">
<div id="content">
<h1><?$APPLICATION->ShowTitle(false)?></h1>
<? endif; ?> 



