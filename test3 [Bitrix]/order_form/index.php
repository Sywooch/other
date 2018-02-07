<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("Форма заказа");
?><?$APPLICATION->IncludeComponent(
	"order:standard.elements.list", 
	".default", 
	array(
		"CACHE_TIME" => "3600",
		"CACHE_TYPE" => "A",
		"COUNT" => "10",
		"IBLOCK_ID" => "2",
		"IBLOCK_TYPE" => "catalog",
		"SHOW_NAV" => "N",
		"SORT_DIRECTION1" => "ASC",
		"SORT_DIRECTION2" => "ASC",
		"SORT_FIELD1" => "ID",
		"SORT_FIELD2" => "ID",
		"COMPONENT_TEMPLATE" => ".default",
		"EVENT_TYPE" => "SEND_ORDER"
	),
	false
);?><br><?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>