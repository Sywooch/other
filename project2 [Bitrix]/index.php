<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetPageProperty("tags", "ФГБУ СПб НИПНИ им. В.М.Бехтерева");
$APPLICATION->SetPageProperty("keywords_inner", "ФГБУ СПб НИПНИ им. В.М.Бехтерева");
$APPLICATION->SetPageProperty("title", "ФГБУ СПб НИПНИ им. В.М.Бехтерева");
$APPLICATION->SetPageProperty("keywords", "ФГБУ СПб НИПНИ им. В.М.Бехтерева");
$APPLICATION->SetPageProperty("description", "Cайт Санкт-Петербургского научно-исследовательскогопсихоневрологического института им. В.М. Бехтерева");
$APPLICATION->SetTitle(" ");
?><?$APPLICATION->IncludeComponent("altasib:photoplayer1mod", "template1", array(
	"SOURCE" => "1",
	"COLLECTION_ID_0" => "1",
	"DETAIL_PICT_RESIZE" => "Y",
	"PREVIEW_PICT_RESIZE" => "Y",
	"WRAP" => "WRAP_BOTH",
	"COUNT_EL" => "100",
	"SHOW_RANDOM" => "N",
	"ANIMATION_TYPE" => "fade",
	"SPEED" => "600",
	"SHOW_BUTTONS" => "Y",
	"SHOW_AUTO" => "Y",
	"TIMEOUT" => "10",
	"AUTOSTART" => "Y",
	"CLEAR_RESIZE_IMG" => "N",
	"ALLX" => "0",
	"ALLY" => "0",
	"BIGPICY" => "300",
	"PREVPICX" => "112",
	"PREVPICY" => "90",
	"INTERVAL" => "15",
	"PREVPIC_NUM" => "5",
	"DISCR_HEIGHT" => "50",
	"DISCR_TITLE_SIZE" => "12",
	"DISCR_TEXT_SIZE" => "10",
	"SHOW_FANCYBOX" => "N",
	"CACHE_TYPE" => "A",
	"CACHE_TIME" => "3600"
	),
	false
);?> 
<div style="width: 100%;"> <?$APPLICATION->IncludeComponent("bitrix:news", "web21", array(
	"IBLOCK_TYPE" => "news",
	"IBLOCK_ID" => "1",
	"NEWS_COUNT" => "2",
	"USE_SEARCH" => "N",
	"TAGS_CLOUD_ELEMENTS" => "150",
	"PERIOD_NEW_TAGS" => "",
	"USE_RSS" => "N",
	"USE_RATING" => "N",
	"USE_CATEGORIES" => "N",
	"USE_FILTER" => "N",
	"SORT_BY1" => "ACTIVE_FROM",
	"SORT_ORDER1" => "DESC",
	"SORT_BY2" => "SORT",
	"SORT_ORDER2" => "ASC",
	"CHECK_DATES" => "Y",
	"SEF_MODE" => "Y",
	"SEF_FOLDER" => "/vse-novosti/",
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
	"DISPLAY_BOTTOM_PAGER" => "N",
	"PAGER_TITLE" => "Новости",
	"PAGER_SHOW_ALWAYS" => "N",
	"PAGER_DESC_NUMBERING" => "N",
	"PAGER_DESC_NUMBERING_CACHE_TIME" => "36000",
	"PAGER_SHOW_ALL" => "Y",
	"DISPLAY_DATE" => "Y",
	"DISPLAY_PICTURE" => "N",
	"DISPLAY_PREVIEW_TEXT" => "Y",
	"DISPLAY_AS_RATING" => "rating",
	"FONT_MAX" => "50",
	"FONT_MIN" => "10",
	"COLOR_NEW" => "3E74E6",
	"COLOR_OLD" => "C0C0C0",
	"TAGS_CLOUD_WIDTH" => "100%",
	"USE_SHARE" => "N",
	"AJAX_OPTION_ADDITIONAL" => "",
	"SEF_URL_TEMPLATES" => array(
		"news" => "",
		"section" => "",
		"detail" => "#ELEMENT_ID#/",
	)
	),
	false,
	array(
	"ACTIVE_COMPONENT" => "Y"
	)
);?> 
  <div align="right" style="width: 100%; height: 20px; float: left; background-color: transparent;"> <span style="font-size: 7pt; color: rgb(82, 137, 32); margin-right: 3px;"><em> <a href="/vse-novosti/" style="font-size: 7pt; color: rgb(82, 137, 32); " >все новости...</a> </em></span> </div>
 </div>
<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>