<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("Корзина");
?><?$APPLICATION->IncludeComponent(
	"bitrix:sale.basket.basket", 
	"template1", 
	array(
		"COUNT_DISCOUNT_4_ALL_QUANTITY" => "N",
		"COLUMNS_LIST" => array(
			0 => "NAME",
			1 => "DISCOUNT",
			2 => "PROPS",
			3 => "DELETE",
			4 => "DELAY",
			5 => "PRICE",
			6 => "QUANTITY",
			7 => "SUM",
		),
		"AJAX_MODE" => "N",
		"AJAX_OPTION_JUMP" => "N",
		"AJAX_OPTION_STYLE" => "Y",
		"AJAX_OPTION_HISTORY" => "N",
		"PATH_TO_ORDER" => "/personal/order/make/",
		"HIDE_COUPON" => "N",
		"QUANTITY_FLOAT" => "N",
		"PRICE_VAT_SHOW_VALUE" => "Y",
		"TEMPLATE_THEME" => "site",
		"SET_TITLE" => "Y",
		"ELEMENT_SORT_FIELD" => "PRICE",
		"ELEMENT_SORT_ORDER" => "ASC",
		"AJAX_OPTION_ADDITIONAL" => "",
		"OFFERS_PROPS" => array(
		),
		"COMPONENT_TEMPLATE" => "template1",
		"USE_PREPAYMENT" => "N",
		"AUTO_CALCULATION" => "Y",
		"ACTION_VARIABLE" => "basketAction",
		"USE_GIFTS" => "N"
	),
	false
);?><?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>