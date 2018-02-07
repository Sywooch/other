<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("Все новости");
?><?$APPLICATION->IncludeComponent("bitrix:news.index", ".default", array(
	"IBLOCK_TYPE" => "news",
	"IBLOCKS" => array(
		0 => "1",
	),
	"NEWS_COUNT" => "5",
	"IBLOCK_SORT_BY" => "SORT",
	"IBLOCK_SORT_ORDER" => "ASC",
	"SORT_BY1" => "ACTIVE_FROM",
	"SORT_ORDER1" => "DESC",
	"SORT_BY2" => "SORT",
	"SORT_ORDER2" => "ASC",
	"FIELD_CODE" => array(
		0 => "",
		1 => "",
	),
	"PROPERTY_CODE" => array(
		0 => "",
		1 => "",
	),
	"FILTER_NAME" => "arrFilter",
	"IBLOCK_URL" => "",
	"DETAIL_URL" => "",
	"CACHE_TYPE" => "A",
	"CACHE_TIME" => "36000000",
	"CACHE_GROUPS" => "Y",
	"ACTIVE_DATE_FORMAT" => "d.m.Y"
	),
	false
);?><?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>