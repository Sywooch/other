<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
IncludeTemplateLangFile(__FILE__);
?>
			</div>

</div>
<!--main content-->

</div>
<!--block3-->



<!--
	<div id="sidebar">
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
				<div class="content-block" align="left" style="margin-bottom:0px;">
					<div class="content-block-inner">
						<h3><?=GetMessage('CFT_NEWS')?></h3>
<?
$APPLICATION->IncludeFile(
	SITE_DIR."include/news.php",
	Array(),
	Array("MODE"=>"html")
);
?>
					</div>
				</div>
				
				<div class="content-block">
					<div class="content-block-inner">
						
<?
$APPLICATION->IncludeComponent("bitrix:search.form", "flat", Array(
	"PAGE" => "#SITE_DIR#search/",
),
	false
);
?>
					</div>
				</div>

				<div class="information-block">
					<div class="top"></div>
					<div class="information-block-inner">
						<h3><?=GetMessage('CFT_FEATURED')?></h3>
<?
$APPLICATION->IncludeFile(
	SITE_DIR."include/random.php",
	Array(),
	Array("MODE"=>"html")
);
?>						
					</div>
					<div class="bottom"></div>
				</div>
			</div>
		-->



</div>
<!--block2-->


<!--block3-->
<div align="center" style="width:290px; background-color:transparent; float:left;">


<!--banners-->
<div style="width:250px; background-color:transparent; float:left;">
<div style="width:100%; height:30px;"></div>

<?$APPLICATION->IncludeComponent("bitrix:main.include", "template3", array(
	"AREA_FILE_SHOW" => "sect",
	"AREA_FILE_SUFFIX" => "inc_right_banners",
	"AREA_FILE_RECURSIVE" => "Y",
	"EDIT_TEMPLATE" => "standard.php"
	),
	false
);?>

</div>
<!--banners-->




<div style="width:40px; height:150px; background-color:transparent; float:left;">
<div style="width:40px; height:40px; "></div>

<div style="width:40px; height:40px; " class="blog_1"></div>
<div style="width:40px; height:1px;"></div>

<div style="width:40px; height:40px; " class="mail_1"></div>


</div>




</div>
<!--block3-->



</div>
<!--block1-->




		
			
		</div>

		<div id="space-for-footer"></div>
	</div>
	


<!--footer-->
<div id="footer" style="background-color:transparent; height:300px;  width:1100px;">


<div style="float:left; width:10px; background-color:transparent; height:300px; "></div>




<div style="float:left; width:1040px;  background-color:transparent; height:300px; ">


<?$APPLICATION->IncludeComponent("bitrix:main.include", "template4", Array(
	"AREA_FILE_SHOW" => "sect",	// Показывать включаемую область
	"AREA_FILE_SUFFIX" => "inc_footer_bottom_news",	// Суффикс имени файла включаемой области
	"AREA_FILE_RECURSIVE" => "Y",	// Рекурсивное подключение включаемых областей разделов
	"EDIT_TEMPLATE" => "standard.php",	// Шаблон области по умолчанию
	),
	false
);?>




</div>



<!--	
<?$APPLICATION->IncludeComponent("bitrix:news", ".default", array(
	"IBLOCK_TYPE" => "news",
	"IBLOCK_ID" => "1",
	"NEWS_COUNT" => "3",
	"USE_SEARCH" => "N",
	"USE_RSS" => "N",
	"USE_RATING" => "N",
	"USE_CATEGORIES" => "N",
	"USE_FILTER" => "N",
	"SORT_BY1" => "ACTIVE_FROM",
	"SORT_ORDER1" => "DESC",
	"SORT_BY2" => "SORT",
	"SORT_ORDER2" => "ASC",
	"CHECK_DATES" => "Y",
	"SEF_MODE" => "N",
	"SEF_FOLDER" => "/",
	"AJAX_MODE" => "N",
	"AJAX_OPTION_JUMP" => "N",
	"AJAX_OPTION_STYLE" => "Y",
	"AJAX_OPTION_HISTORY" => "N",
	"CACHE_TYPE" => "A",
	"CACHE_TIME" => "36000000",
	"CACHE_FILTER" => "N",
	"CACHE_GROUPS" => "Y",
	"SET_TITLE" => "N",
	"SET_STATUS_404" => "N",
	"INCLUDE_IBLOCK_INTO_CHAIN" => "N",
	"ADD_SECTIONS_CHAIN" => "N",
	"USE_PERMISSIONS" => "N",
	"PREVIEW_TRUNCATE_LEN" => "",
	"LIST_ACTIVE_DATE_FORMAT" => "d.m.Y",
	"LIST_FIELD_CODE" => array(
		0 => "",
		1 => "",
	),
	"LIST_PROPERTY_CODE" => array(
		0 => "",
		1 => "",
	),
	"HIDE_LINK_WHEN_NO_DETAIL" => "N",
	"DISPLAY_NAME" => "Y",
	"META_KEYWORDS" => "-",
	"META_DESCRIPTION" => "-",
	"BROWSER_TITLE" => "-",
	"DETAIL_ACTIVE_DATE_FORMAT" => "d.m.Y",
	"DETAIL_FIELD_CODE" => array(
		0 => "",
		1 => "",
	),
	"DETAIL_PROPERTY_CODE" => array(
		0 => "",
		1 => "",
	),
	"DETAIL_DISPLAY_TOP_PAGER" => "N",
	"DETAIL_DISPLAY_BOTTOM_PAGER" => "N",
	"DETAIL_PAGER_TITLE" => "Страница",
	"DETAIL_PAGER_TEMPLATE" => "",
	"DETAIL_PAGER_SHOW_ALL" => "Y",
	"PAGER_TEMPLATE" => ".default",
	"DISPLAY_TOP_PAGER" => "N",
	"DISPLAY_BOTTOM_PAGER" => "Y",
	"PAGER_TITLE" => "Новости",
	"PAGER_SHOW_ALWAYS" => "N",
	"PAGER_DESC_NUMBERING" => "N",
	"PAGER_DESC_NUMBERING_CACHE_TIME" => "36000",
	"PAGER_SHOW_ALL" => "Y",
	"AJAX_OPTION_ADDITIONAL" => "",
	"VARIABLE_ALIASES" => array(
		"SECTION_ID" => "SECTION_ID",
		"ELEMENT_ID" => "ELEMENT_ID",
	)
	),
	false
);?>
-->




	<!--	<div id="copyright">
<?
$APPLICATION->IncludeFile(
	SITE_DIR."include/copyright.php",
	Array(),
	Array("MODE"=>"html")
);
?>
		</div>
		<div class="footer-links">	
<?
$APPLICATION->IncludeComponent("bitrix:menu", "bottom", array(
	"ROOT_MENU_TYPE" => "bottom",
	"MENU_CACHE_TYPE" => "N",
	"MENU_CACHE_TIME" => "36000000",
	"MENU_CACHE_USE_GROUPS" => "Y",
	"MENU_CACHE_GET_VARS" => array(
	),
	"MAX_LEVEL" => "1",
	"CHILD_MENU_TYPE" => "left",
	"USE_EXT" => "N",
	"ALLOW_MULTI_SELECT" => "N"
	),
	false
);
?>
		</div>-->
		<!--<div id="footer-design"><?=GetMessage("FOOTER_DISIGN")?></div>-->
	</div>

</div>

<div style="width:100%; height:100px; background-color:transparent;"></div>


</body>
</html>