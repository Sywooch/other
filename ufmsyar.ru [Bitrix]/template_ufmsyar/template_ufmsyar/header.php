<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
IncludeTemplateLangFile(__FILE__);
?>
 <?
      CJSCore::Init(array("jquery"));
 ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="<?=LANGUAGE_ID?>" lang="<?=LANGUAGE_ID?>">


<head>



<meta http-equiv="X-UA-Compatible" content="IE=edge" />
<link rel="shortcut icon" type="image/x-icon" href="<?=SITE_TEMPLATE_PATH?>/favicon.ico" />
<link rel="stylesheet" type="text/css" href="<?=SITE_TEMPLATE_PATH?>/common.css" />
<?$APPLICATION->ShowHead();?>
<link rel="stylesheet" type="text/css" href="<?=SITE_TEMPLATE_PATH?>/colors.css" />
<title><?$APPLICATION->ShowTitle()?></title>






<!--shtraf-->

<script type="text/javascript">
			var fee = [];
			var okato = [];
			var kbk = [];
			var type = [];

			fee[6] = {kbk : '19211640000016022140', type : 'Средства от поступлений денежных взысканий (штрафов) за незаконное осуществление иностранным гражданином или лицом без гражданства трудовой деялельности в Российской Федерации', name : 'Ст. 18.10', };fee[7] = {kbk : '19211640000016023140', type : 'Средства от поступлений денежных взысканий (штрафов) за нарушение иммиграционных правил', name : 'Ст. 18.11', };fee[8] = {kbk : '19211640000016024140', type : 'Средства от поступлений денежных взысканий (штрафов) за нарушение беженцем или вынужденным переселенцем правил пребывания (проживания) в Российской Федерации', name : 'Ст. 18.12', };fee[9] = {kbk : '19211640000016025140', type : 'Средства от поступлений денежных взысканий (штрафов) за незаконное привлечение к трудовой деятельности в Российской Федерации иностранного гражданина или лица без гражданства', name : 'Ст. 18.15', };fee[10] = {kbk : '19211640000016026140', type : 'Средства от поступлений денежных взысканий (штрафов) за нарушение правил привлечения иностранных граждан и лиц без гражданства к трудовой деятельности, осуществляемой на торговых объектах', name : 'Ст. 18.16', };fee[11] = {kbk : '19211640000016027140', type : 'Средства от поступлений денежных взысканий (штрафов) за несоблюдение установленных в соответствие с федеральным законом в отношении иностранных граждан, лиц без гражданства на осуществление отдельных видов деятельности ', name : 'Ст. 18.17', };fee[4] = {kbk : '19211640000016020140', type : 'Средства от поступлений денежных взысканий (штрафов) за нарушение иностранным гражданином или лицом без гражданства правил въезда в Российскую Федерацию либо режима пребывания (проживания) в Российской Федерации', name : 'Ст. 18.8', };fee[5] = {kbk : '19211640000016021140', type : 'Средства от поступлений денежных взысканий (штрафов) за нарушение правил пребывания в Российской Федерации иностранных граждан и лиц без гражданства', name : 'Ст. 18.9', };fee[12] = {kbk : '19211640000016028140', type : 'Средства от поступлений денежных взысканий (штрафов) за предоставление ложных сведений при осуществлении миграционного учета', name : 'Ст. 19.27', };fee[2] = {kbk : '19211607000016000140', type : 'Поступления от денежных взысканий (штрафов)', name : 'Ст. 19.3, 19.4, 19.5, 19.6, 19.7, п. 15 ст. 28.3', };fee[1] = {kbk : '19211643000016000140', type : 'Поступление от денежных взысканий (штрафы) за нарушение законодательства Российской Федерации об административных правонарушениях', name : 'Ст. 20.25, ст. 28.3', };fee[3] = {kbk : '19211690010016000140', type : 'Поступления от денежных взысканий (штрафов), подлежащих зачислению в соответствии с законодательством Российской Федерации в доход федерального бюджета, для учета которых не предусмотрены отдельные коды классификации доходов бюджетов', name : 'ч. 1 ст. 19.15, ч. 2 ст. 19.15, ст. 19.16', };okato[1] = {id : '1', okato : '78603000', name : 'Большесельский м.р.', };okato[2] = {id : '2', okato : '78606000', name : 'Борисоглебский м.р.', };okato[3] = {id : '3', okato : '78609000', name : 'Брейтовский м. р.', };okato[4] = {id : '4', okato : '78612000', name : 'Гаврилов-Ямский м.р.', };okato[5] = {id : '5', okato : '78615000', name : 'Даниловский м.р.', };okato[6] = {id : '6', okato : '78618000', name : 'Любимский м.р.', };okato[7] = {id : '7', okato : '78621000', name : 'Мышкинский м.р.', };okato[8] = {id : '8', okato : '78623000', name : 'Некоузский м.р.', };okato[9] = {id : '9', okato : '78626000', name : 'Некрасовский м.р.', };okato[10] = {id : '10', okato : '78629000', name : 'Первомайский м.р.', };okato[11] = {id : '11', okato : '78634000', name : 'Пошехонский м.р.', };okato[12] = {id : '12', okato : '78637000', name : 'Ростовский м.р.', };okato[13] = {id : '13', okato : '78643000', name : 'Тутаевский м.р.', };okato[14] = {id : '14', okato : '78646000', name : 'Угличский м.р.', };okato[15] = {id : '15', okato : '78650000', name : 'Ярославский м.р.', };okato[16] = {id : '16', okato : '78701000', name : 'г. Ярославль', };okato[17] = {id : '17', okato : '78705000', name : 'г. Переславль-Залесский', };okato[18] = {id : '18', okato : '78715000', name : 'г. Рыбинск', };
				$(function()
				{
					var today = new Date();
					var dd = today.getDate();

					if (dd < 10)
						dd = '0' + dd;

					var month = new Array
					(
							'января',
							'февраля',
							'марта',
							'апреля',
							'мая',
							'июня',
							'июля',
							'августа',
							'сентября',
							'октября',
							'ноября',
							'декабря'
					);

					$('#day').text(dd);
					$('#month').text(month[today.getMonth()]);
					$('#year').text(today.getYear() - 100);

					$('#kbk').text(fee[1].kbk);

					$('#fine').change(function()
					{
						var currentFee = fee[$(this).val()];
						$('#type').text(currentFee.type);
						$('#kbk').text(currentFee.kbk);
					})

					$('#receipt').submit(function()
					{
						if($('#name').val().length < 3)
						{
							alert('Введите, пожалуйста, ваше имя');
							return false;
						}

						var amount = parseInt($('#amount').val(), 10);

						if(isNaN(amount) || amount < 1)
						{
							alert('Введите, пожалуйста, корректную сумму');
							return false;
						}

						var currentFee = fee[$('#fine option:selected').val()];

						$('#receipt input[name="amount"]').val(amount);
						$('#receipt input[name="fine"]').val(currentFee.name);
						$('#receipt input[name="kbk"]').val(currentFee.kbk);
						$('#receipt input[name="type"]').val(currentFee.type);
						$('#receipt input[name="address"]').val($('#address').val());
						$('#receipt input[name="name"]').val($('#name').val());
						$('#receipt input[name="okato"]').val($('#okato option:selected').val());

						return true;
					});
				});
			</script>

<!--shtraf-->

<script src="//ajax.googleapis.com/ajax/libs/jquery/1.8.2/jquery.min.js"></script>

<script src="/js/jquery.bxslider.min.js"></script>
<script src="/js/script.js"></script>
<script src="/js/jquery.fitvids.js"></script>
<script src="/js/jquery.easing.1.3.js"></script>
<link href="/css_slider/jquery.bxslider.css" type="text/css"  rel="stylesheet" />

<!--map js-->

<!--<script src="/js_map/swfobject.js"></script>
<script src="/js_map/map.js"></script>-->

<!--map js-->


<!--


<script src="/js/jquery-1.11.0.min.js"></script>-->
<!--<script src="/js/jquery-1.11.1.js"></script>-->


<!--js images-->
<script type="text/javascript" src="/js_images/highslide.js"></script>
<link rel="stylesheet" type="text/css" href="/js_images/highslide.css" />
<script type="text/javascript">
hs.graphicsDir = '/js_images/graphics/';
hs.wrapperClassName = 'wide-border';
</script>
<!--js images-->


<link rel="stylesheet" href="/css/payment.css" type="text/css" media="screen, projection">
<link rel="stylesheet" href="/css/dropkick.css" type="text/css" media="screen, projection">
<script src="/js/jquery.dropkick-1.0.0.js" type="text/javascript"></script>

<!--shtraf-->
<link rel="stylesheet" href="/css/fee.css" type="text/css" media="screen, projection">


<!--shtraf-->

<!--oprosi-->
<style type="text/css">
.voting-form-box{
font-size:10pt !important; font-style:italic !important; color:#800d0d !important;
border:0px !important;
}
.vote-answer-name{
font-size:10pt !important; font-style:italic !important; color:#800d0d !important;
}
</style>
<!--oprosi-->

</head>
<body>

<!--map-->
<div id="map_div" align="center" 
style="width:100%; height:100%; position:absolute; z-index:999999; margin:0; padding:0; border:0; display:none;
 background-color:transparent; " class="map_div_100">

<div style="width:780px; height:760px; background-color:#fff; margin-top:40px; ">
<div align="right" style="width:780px; height:30px; ">
<div style="width:100px; height:330px; padding-right:20px; cursor:pointer; " class="close" 
onclick="map_close();"><span style="font-size:10pt;">Закрыть</span></div>
</div>

<div align="center" style="width:780px; height:700px; ">
  
  <object type="application/x-shockwave-flash" data="/data_map/swf/main.swf" width="760" height="700" 
  id="map-holder" style="visibility: visible;"><param name="flashvars" value="initXML_path=/data_map/xml/init.xml"></object>
  
</div>


</div>


</div>
<!--map-->

<!--oformlenie documentov-->
<div id="oformlenie_div" align="center" 
style="width:100%; height:100%; position:absolute; z-index:900; margin:0; padding:0; border:0; display:none;
 background-color:transparent; " class="oformlenie_div_100">

<div style="width:780px; height:560px; background-color:#fff; margin-top:420px; ">
<div align="right" style="width:780px; height:30px; ">
<div style="width:100px; height:330px; padding-right:20px; cursor:pointer; " class="close" 
onclick="oformlenie_close();"><span style="font-size:10pt;">Закрыть</span></div>
</div>

<div align="center" style="width:780px; height:500px; background-color:transparent;">
 
<table cellpadding="3" cellspacing="0" style="width:100%;">
<tr>
<td style="width:50%; vertical-align:top;">
<?$APPLICATION->IncludeComponent("bitrix:menu", "vertical_multilevel3", Array(
	"ROOT_MENU_TYPE" => "oformlenie1",	// Тип меню для первого уровня
	"MENU_CACHE_TYPE" => "A",	// Тип кеширования
	"MENU_CACHE_TIME" => "3600",	// Время кеширования (сек.)
	"MENU_CACHE_USE_GROUPS" => "N",	// Учитывать права доступа
	"MENU_CACHE_GET_VARS" => "",	// Значимые переменные запроса
	"MAX_LEVEL" => "1",	// Уровень вложенности меню
	"CHILD_MENU_TYPE" => "oformlenie1",	// Тип меню для остальных уровней
	"USE_EXT" => "Y",	// Подключать файлы с именами вида .тип_меню.menu_ext.php
	"DELAY" => "N",	// Откладывать выполнение шаблона меню
	"ALLOW_MULTI_SELECT" => "N",	// Разрешить несколько активных пунктов одновременно
	),
	false
);?> 
</td>
<td style="width:50%; vertical-align:top;">
<?$APPLICATION->IncludeComponent("bitrix:menu", "vertical_multilevel4", array(
	"ROOT_MENU_TYPE" => "oformlenie2",
	"MENU_CACHE_TYPE" => "A",
	"MENU_CACHE_TIME" => "3600",
	"MENU_CACHE_USE_GROUPS" => "N",
	"MENU_CACHE_GET_VARS" => array(
	),
	"MAX_LEVEL" => "1",
	"CHILD_MENU_TYPE" => "oformlenie2",
	"USE_EXT" => "Y",
	"DELAY" => "N",
	"ALLOW_MULTI_SELECT" => "N"
	),
	false
);?> 
</td>

</tr>
</table>


</div>


</div>


</div>
<!--oformlenie documentov-->


<!--trud migr-->
<div id="trud_div" align="center" 
style="width:100%; height:100%; position:absolute; z-index:900; margin:0; padding:0; border:0; display:none;
 background-color:transparent; " class="trud_div_100">

<div style="width:780px; height:360px; background-color:#fff; margin-top:420px; ">
<div align="right" style="width:780px; height:30px; ">
<div style="width:100px; height:30px; padding-right:20px; cursor:pointer; " class="close" 
onclick="trud_close();"><span style="font-size:10pt;">Закрыть</span></div>
</div>

<div align="center" style="width:780px; height:300px; background-color:transparent;">

<div align="left" style="width:400px; height:300px; ">
<?$APPLICATION->IncludeComponent("bitrix:menu", "vertical_multilevel5", Array(
	"ROOT_MENU_TYPE" => "trud_migr1",	// Тип меню для первого уровня
	"MENU_CACHE_TYPE" => "A",	// Тип кеширования
	"MENU_CACHE_TIME" => "3600",	// Время кеширования (сек.)
	"MENU_CACHE_USE_GROUPS" => "N",	// Учитывать права доступа
	"MENU_CACHE_GET_VARS" => "",	// Значимые переменные запроса
	"MAX_LEVEL" => "1",	// Уровень вложенности меню
	"CHILD_MENU_TYPE" => "trud_migr1",	// Тип меню для остальных уровней
	"USE_EXT" => "Y",	// Подключать файлы с именами вида .тип_меню.menu_ext.php
	"DELAY" => "N",	// Откладывать выполнение шаблона меню
	"ALLOW_MULTI_SELECT" => "N",	// Разрешить несколько активных пунктов одновременно
	),
	false
);?> 
</div>

</div>


</div>


</div>
<!--trud mugr-->





<div id="panel" ><?$APPLICATION->ShowPanel();?></div>
<div align="center" style="width:100%; height:274px; background-color:#ffffff; " class="header_100">

	

<div align="center" style="width:1122px; height:274px; background-color:transparent;" class="header_1122">
<div style="width:1122px; height:10px;"></div>
<div style="width:1122px; height:15px; margin-top:0px; " class="top_header_line"> </div>

<!--top menu and search-->
<div style="width:1122px; height:35px; background-color:transparent;">

	<div id="main-menu2" style="float:left !important;">

<?$APPLICATION->IncludeComponent("bitrix:menu", "horizontal_multilevel1", array(
	"ROOT_MENU_TYPE" => "top_main2",
	"MENU_CACHE_TYPE" => "A",
	"MENU_CACHE_TIME" => "3600",
	"MENU_CACHE_USE_GROUPS" => "N",
	"MENU_CACHE_GET_VARS" => array(
	),
	"MAX_LEVEL" => "1",
	"CHILD_MENU_TYPE" => "top_main2",
	"USE_EXT" => "Y",
	"DELAY" => "N",
	"ALLOW_MULTI_SELECT" => "N"
	),
	false
);?> 

<!--
	<?$APPLICATION->IncludeComponent("bitrix:menu", "horizontal_multilevel", array(
	"ROOT_MENU_TYPE" => "top_main",
	"MENU_CACHE_TYPE" => "A",
	"MENU_CACHE_TIME" => "36000000",
	"MENU_CACHE_USE_GROUPS" => "N",
	"MENU_CACHE_GET_VARS" => array(
	),
	"MAX_LEVEL" => "1",
	"CHILD_MENU_TYPE" => "top_main",
	"USE_EXT" => "Y",
	"DELAY" => "N",
	"ALLOW_MULTI_SELECT" => "N"
	),
	false
);?>
-->

	</div>

 <div style="width:300px; height:35px; background-color:transparent; float:right;">
<div style="width:300px; height:4px; "></div>
<div id="left-search" style="float:right !important; margin-top:0px !important; background-image:url(/images/search.png);
background-position:center center; background-repeat:no-repeat; padding-top:0px; margin-bottom:0px; border-bottom:0px transparent solid;">
<div style="width:100%; height:2px;"></div>
		<?$APPLICATION->IncludeComponent("bitrix:search.title", "template1", Array(
	"NUM_CATEGORIES" => "3",	// Количество категорий поиска
	"TOP_COUNT" => "5",	// Количество результатов в каждой категории
	"CHECK_DATES" => "N",	// Искать только в активных по дате документах
	"SHOW_OTHERS" => "Y",	// Показывать категорию "прочее"
	"PAGE" => "#SITE_DIR#search/",	// Страница выдачи результатов поиска (доступен макрос #SITE_DIR#)
	"CATEGORY_0_TITLE" => GetMessage("NEWS_TITLE"),	// Название категории
	"CATEGORY_0" => array(	// Ограничение области поиска
		0 => "iblock_news",
	),
	"CATEGORY_0_iblock_news" => array(	// Искать в информационных блоках типа "iblock_news"
		0 => "2",
		1 => "3",
	),
	"CATEGORY_1_TITLE" => GetMessage("BLOG_TITLE"),	// Название категории
	"CATEGORY_1" => array(	// Ограничение области поиска
		0 => "blog",
	),
	"CATEGORY_1_blog" => array(	// Блоги
		0 => "all",
	),
	"CATEGORY_2_TITLE" => GetMessage("JOB_TITLE"),	// Название категории
	"CATEGORY_2" => array(	// Ограничение области поиска
		0 => "iblock_job",
	),
	"CATEGORY_2_iblock_job" => array(	// Искать в информационных блоках типа "iblock_job"
		0 => "all",
	),
	"CATEGORY_OTHERS_TITLE" => GetMessage("OTHER_TITLE"),	// Название категории
	"SHOW_INPUT" => "Y",	// Показывать форму ввода поискового запроса
	"INPUT_ID" => "title-search-input",	// ID строки ввода поискового запроса
	"CONTAINER_ID" => "title-search",	// ID контейнера, по ширине которого будут выводиться результаты
	),
	false
);?>
			</div>
</div>



</div>
<!--top menu and search-->



<div style="width:1122px; height:215px; background-color:transparent;">

<div style="width:140px; height:215px; background-color:transparent; float:left;" class="gerb"></div>

<div style="width:740px; border-left:0px transparent solid; border-right:0px transparent solid; height:215px; float:left;">
<div align="right" style="width:740px; height:190px; background-color:transparent;"> 
<a href="/"><div style="width:600px; height:190px; border-left:0px transparent solid; border-right:0px transparent solid;"></div></a>
</div>
<div align="right" style="width:740px; height:30px; background-color:transparent; color:white;"> 
<span style="font-size:12pt; ">Телефоны доверия: <i>(4852)30-52-39, 8-906-525-74-87, 8-930-104-58-8, 8-915-967-98-28</i></span> </div>

</div>

<!--map-->
<div align="right" style="width:240px; height:215px; background-color:transparent; float:left;">
<div style="width:240px; height:40px;"></div>
<div style="width:134px; height:139px; background-color:transparent; cursor:pointer;"  onclick="button_map();">
<div style="width:134px; height:139px; background-color:transparent;">
<div style="width:134px; height:109px;" class="map"></div>
<div  align="center" style="width:134px; height:30px; font-size:10pt; color:white; background-color:transparent; 
overflow:hidden;"><span>Интерактивная карта</span></div>
</div>
</div>
</div>
<!--map-->

<script type="text/javascript">
function button_map(){

$("#map_div").fadeIn(1000);

$h=document.body.scrollHeight

$("#map_div").height($h);
}

function map_close(){
$("#map_div").fadeOut(1000);

}

</script>


<script type="text/javascript">
function button_oformlenie(){

$("#oformlenie_div").fadeIn(1000);

$h=document.body.scrollHeight

$("#oformlenie_div").height($h);
}

function oformlenie_close(){
$("#oformlenie_div").fadeOut(1000);

}

</script>

</div>


<script type="text/javascript">
function button_trud(){

$("#trud_div").fadeIn(1000);

$h=document.body.scrollHeight

$("#trud_div").height($h);
}

function trud_close(){
$("#trud_div").fadeOut(1000);

}

</script>

</div>




<!--<div style="width:1122px; height:15px; margin-top:0px; " class="bottom_header_line"> </div>
-->


</div>






</div>
<!--header_100-->




<!--subheader and 3x-menu-->
<div align="center" style="width:100%; height:120px; background-color:#ffffff; border-bottom:0px black solid;" class="subheader" >
<div align="left" style="width:1122px; height:100%; background-color:transparent;" class="subheader">
<div align="left" style="width:1122px; height:100%; background-color:transparent;">
<div style="width:1120px; height:15px;  "></div>
<div align="left" style="width:1118px; height:70px; background-color:transparent; padding-left:2px; ">
<div style="width:1112px; height:70px; background-color:transparent;" class="subheader_menu_fon1" >
<?$APPLICATION->IncludeComponent("bitrix:menu", "horizontal_multilevel2", array(
	"ROOT_MENU_TYPE" => "big_menu",
	"MENU_CACHE_TYPE" => "A",
	"MENU_CACHE_TIME" => "36000000",
	"MENU_CACHE_USE_GROUPS" => "N",
	"MENU_CACHE_GET_VARS" => array(
	),
	"MAX_LEVEL" => "3",
	"CHILD_MENU_TYPE" => "top",
	"USE_EXT" => "Y",
	"DELAY" => "N",
	"ALLOW_MULTI_SELECT" => "N"
	),
	false
);?>
</div>
</div>

</div>


	
</div>	
</div>
<!--subheader and 3x-menu-->

<!---++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->
<div align="center" id="page-wrapper" style="max-width:1122px !important; width:1122px !important; background-color:transparent;" >

<!--
	<?if(CModule::IncludeModule('advertising')):?>
	<?$APPLICATION->IncludeComponent("bitrix:advertising.banner", "top", Array(
	"TYPE" => "TOP",
	"NOINDEX" => "N",
	"CACHE_TYPE" => "A",
	"CACHE_TIME" => "0",
	),
	false
	);?>
	<?endif;?>
-->


<!--
	<div id="header" style="margin:0 !important;">
	<div id="header-title"><a href="<?=SITE_DIR?>"><?$APPLICATION->IncludeComponent("bitrix:main.include", "", array("AREA_FILE_SHOW" => "file", "PATH" => SITE_DIR."include/infoportal_name.php"), false);?></a></div>
	<!--<div id="header-auth">
		<?$APPLICATION->IncludeComponent("bitrix:system.auth.form", "info", array(
			"REGISTER_URL" => SITE_DIR."login/",
			"PROFILE_URL" => SITE_DIR."personal/profile/",
			"SHOW_ERRORS" => "N"
			),
			false,
			Array()
		);?>
	</div>-->
<!--
	<div id="main-menu">
	<?$APPLICATION->IncludeComponent("bitrix:menu", "horizontal_multilevel", array(
	"ROOT_MENU_TYPE" => "top",
	"MENU_CACHE_TYPE" => "A",
	"MENU_CACHE_TIME" => "36000000",
	"MENU_CACHE_USE_GROUPS" => "N",
	"MENU_CACHE_GET_VARS" => array(
	),
	"MAX_LEVEL" => "1",
	"CHILD_MENU_TYPE" => "top",
	"USE_EXT" => "Y",
	"DELAY" => "N",
	"ALLOW_MULTI_SELECT" => "N"
	),
	false
);?>
<!--	</div>

<!--	<div id="main-menu">
	<?$APPLICATION->IncludeComponent("bitrix:menu", "horizontal_multilevel", array(
	"ROOT_MENU_TYPE" => "top",
	"MENU_CACHE_TYPE" => "A",
	"MENU_CACHE_TIME" => "36000000",
	"MENU_CACHE_USE_GROUPS" => "N",
	"MENU_CACHE_GET_VARS" => array(
	),
	"MAX_LEVEL" => "1",
	"CHILD_MENU_TYPE" => "top",
	"USE_EXT" => "Y",
	"DELAY" => "N",
	"ALLOW_MULTI_SELECT" => "N"
	),
	false
	);?>
	</div>
-->
<!--
	</div>
-->



	<div id="page-body" style="background-color:transparent; width:1122px; margin:0 !important; margin:0 !important; ">

<!---------------------------------table------------------------------------------------------------------------------------------------------------------------------------------------------------>

	<table width="1122px" cellspacing="0" cellpadding="0" style="background-color:transparent; border-color:transparent;">
		<tr>
		
		<td <?if(!array_search('forum', $arCurDir)):?>width="244" <?endif;?> class="page-left" style="background-color:transparent; 
vertical-align:top; padding-top:0px !important;">

<?$APPLICATION->IncludeComponent("bitrix:main.include", "template6", array(
	"AREA_FILE_SHOW" => "sect",
	"AREA_FILE_SUFFIX" => "inc_button001",
	"AREA_FILE_RECURSIVE" => "Y",
	"EDIT_TEMPLATE" => "standard.php"
	),
	false
);?>

<?$APPLICATION->IncludeComponent("bitrix:main.include", "template28", Array(
	"AREA_FILE_SHOW" => "sect",	// Показывать включаемую область
	"AREA_FILE_SUFFIX" => "inc_button3_2",	// Суффикс имени файла включаемой области
	"AREA_FILE_RECURSIVE" => "Y",	// Рекурсивное подключение включаемых областей разделов
	"EDIT_TEMPLATE" => "standard.php",	// Шаблон области по умолчанию
	),
	false
);?>

                 
<?$APPLICATION->IncludeComponent("bitrix:main.include", "template6", array(
	"AREA_FILE_SHOW" => "sect",
	"AREA_FILE_SUFFIX" => "inc_button3",
	"AREA_FILE_RECURSIVE" => "Y",
	"EDIT_TEMPLATE" => "standard.php"
	),
	false
);?>


                
<?$APPLICATION->IncludeComponent("bitrix:main.include", "template6", array(
	"AREA_FILE_SHOW" => "sect",
	"AREA_FILE_SUFFIX" => "inc",
	"AREA_FILE_RECURSIVE" => "Y",
	"EDIT_TEMPLATE" => "standard.php"
	),
	false
);?>

<div onclick="button_oformlenie();" style="cursor:pointer;">
<?$APPLICATION->IncludeComponent("bitrix:main.include", "template10", Array(
	"AREA_FILE_SHOW" => "sect",	// Показывать включаемую область
	"AREA_FILE_SUFFIX" => "inc3",	// Суффикс имени файла включаемой области
	"AREA_FILE_RECURSIVE" => "Y",	// Рекурсивное подключение включаемых областей разделов
	"EDIT_TEMPLATE" => "standard.php",	// Шаблон области по умолчанию
	),
	false
);?>
</div>

<div onclick="button_trud();" style="cursor:pointer;">
<?$APPLICATION->IncludeComponent("bitrix:main.include", "template13", array(
	"AREA_FILE_SHOW" => "sect",
	"AREA_FILE_SUFFIX" => "inc39",
	"AREA_FILE_RECURSIVE" => "Y",
	"EDIT_TEMPLATE" => "standard.php"
	),
	false
);?>
</div>


<?$APPLICATION->IncludeComponent("bitrix:main.include", "template14", Array(
	"AREA_FILE_SHOW" => "sect",	// Показывать включаемую область
	"AREA_FILE_SUFFIX" => "inc687",	// Суффикс имени файла включаемой области
	"AREA_FILE_RECURSIVE" => "Y",	// Рекурсивное подключение включаемых областей разделов
	"EDIT_TEMPLATE" => "standard.php",	// Шаблон области по умолчанию
	),
	false
);?>

<?$APPLICATION->IncludeComponent("bitrix:main.include", "template15", Array(
	"AREA_FILE_SHOW" => "sect",	// Показывать включаемую область
	"AREA_FILE_SUFFIX" => "inc356",	// Суффикс имени файла включаемой области
	"AREA_FILE_RECURSIVE" => "Y",	// Рекурсивное подключение включаемых областей разделов
	"EDIT_TEMPLATE" => "standard.php",	// Шаблон области по умолчанию
	),
	false
);?>


<!-- spare include for banners-->
<?$APPLICATION->IncludeComponent("bitrix:main.include", "template29", Array(
	"AREA_FILE_SHOW" => "sect",	// Показывать включаемую область
	"AREA_FILE_SUFFIX" => "inc35641_2",	// Суффикс имени файла включаемой области
	"AREA_FILE_RECURSIVE" => "Y",	// Рекурсивное подключение включаемых областей разделов
	"EDIT_TEMPLATE" => "standard.php",	// Шаблон области по умолчанию
	),
	false
);?>

<?$APPLICATION->IncludeComponent("bitrix:main.include", "template15", Array(
	"AREA_FILE_SHOW" => "sect",	// Показывать включаемую область
	"AREA_FILE_SUFFIX" => "inc35642",	// Суффикс имени файла включаемой области
	"AREA_FILE_RECURSIVE" => "Y",	// Рекурсивное подключение включаемых областей разделов
	"EDIT_TEMPLATE" => "standard.php",	// Шаблон области по умолчанию
	),
	false
);?>


<?$APPLICATION->IncludeComponent("bitrix:main.include", "template15", Array(
	"AREA_FILE_SHOW" => "sect",	// Показывать включаемую область
	"AREA_FILE_SUFFIX" => "inc35643",	// Суффикс имени файла включаемой области
	"AREA_FILE_RECURSIVE" => "Y",	// Рекурсивное подключение включаемых областей разделов
	"EDIT_TEMPLATE" => "standard.php",	// Шаблон области по умолчанию
	),
	false
);?>


<?$APPLICATION->IncludeComponent("bitrix:main.include", "template15", Array(
	"AREA_FILE_SHOW" => "sect",	// Показывать включаемую область
	"AREA_FILE_SUFFIX" => "inc35656",	// Суффикс имени файла включаемой области
	"AREA_FILE_RECURSIVE" => "Y",	// Рекурсивное подключение включаемых областей разделов
	"EDIT_TEMPLATE" => "standard.php",	// Шаблон области по умолчанию
	),
	false
);?>


<!-- spare include for banners-->


<div style="width:100%; height:30px; "></div>


<!--golosovanie-->
<div align="center" style="width:100%; height:620px; ">
<div align="center" style="width:223px; height:620px; " class="golosovanie">
<?$APPLICATION->IncludeComponent("bitrix:main.include", "template2", array(
	"AREA_FILE_SHOW" => "sect",
	"AREA_FILE_SUFFIX" => "rbottom",
	"AREA_FILE_RECURSIVE" => "Y",
	"EDIT_TEMPLATE" => "standard.php"
	),
	false
);?>
</div>
</div>
<!--golosovanie-->



		</td>
		
		
	

<!--===========================================================================-->
	<td align="left" id="page_c" width="584"  class="page-right" style="background-color:transparent; padding-left:15px; padding-right:15px;  padding-top:0px !important;">


<!--slider-->
<!--
<?$APPLICATION->IncludeComponent("bitrix:main.include", "template4", array(
	"AREA_FILE_SHOW" => "page",
	"AREA_FILE_SUFFIX" => "inc",
	"EDIT_TEMPLATE" => ""
	),
	false,
	array(
	"ACTIVE_COMPONENT" => "N"
	)
); ?>
<!--slider-->



