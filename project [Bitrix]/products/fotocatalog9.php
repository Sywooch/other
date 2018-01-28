<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetPageProperty("keywords", "Фотокаталог9");
$APPLICATION->SetPageProperty("description", "Фотокаталог9");
$APPLICATION->SetTitle("фотокаталог 9");
?><?$APPLICATION->IncludeComponent("g-tech:catalog.sliding", ".default", array(
	"IBLOCK_TYPE" => "products",
	"IBLOCK_ID" => "2",
	"SECTION_ID" => $_REQUEST["SECTION_ID"],
	"SECTION_CODE" => "",
	"ELEMENT_SORT_FIELD" => "timestamp_x",
	"ELEMENT_SORT_ORDER" => "asc",
	"FILTER_NAME" => "arrFilter",
	"INCLUDE_SUBSECTIONS" => "Y",
	"SHOW_ALL_WO_SECTION" => "Y",
	"SLIDE_SPEED" => "7",
	"SLIDE_FADE" => "5",
	"SLIDE_WIDTH" => "500",
	"SLIDE_HEIGHT" => "350",
	"SLIDER_COUNT" => "5",
	"AJAX_MODE" => "N",
	"AJAX_OPTION_JUMP" => "Y",
	"AJAX_OPTION_STYLE" => "Y",
	"AJAX_OPTION_HISTORY" => "N",
	"CACHE_TYPE" => "A",
	"CACHE_TIME" => "3600",
	"CACHE_GROUPS" => "Y",
	"PAGER_TEMPLATE" => ".default",
	"DISPLAY_TOP_PAGER" => "N",
	"DISPLAY_BOTTOM_PAGER" => "Y",
	"PAGER_TITLE" => "Товары",
	"PAGER_SHOW_ALWAYS" => "Y",
	"PAGER_DESC_NUMBERING" => "N",
	"PAGER_DESC_NUMBERING_CACHE_TIME" => "36000",
	"PAGER_SHOW_ALL" => "Y",
	"AJAX_OPTION_ADDITIONAL" => ""
	),
	false
);?><?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>