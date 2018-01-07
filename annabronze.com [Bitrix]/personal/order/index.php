<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("История покупок");
?><div class="inside_page_content">
<?$APPLICATION->IncludeComponent("bitrix:sale.personal.order", "list", array(
	"PROP_1" => array(
		0 => "5",
	),
	"PROP_5" => array(
	),
	"PROP_2" => array(
	),
	"PROP_6" => array(
	),
	"ACTIVE_DATE_FORMAT" => "d.m.Y",
	"SEF_MODE" => "Y",
	"SEF_FOLDER" => "/personal/order/",
	"CACHE_TYPE" => "A",
	"CACHE_TIME" => "3600",
	"CACHE_GROUPS" => "Y",
	"ORDERS_PER_PAGE" => "10",
	"PATH_TO_PAYMENT" => "/order/payment.php",
	"PATH_TO_BASKET" => "/basket/",
	"SET_TITLE" => "N",
	"SAVE_IN_SESSION" => "N",
	"NAV_TEMPLATE" => "shop",
	"CUSTOM_SELECT_PROPS" => array(
	),
	"HISTORIC_STATUSES" => array(
		0 => "F",
	),
	"STATUS_COLOR_N" => "green",
	"STATUS_COLOR_P" => "yellow",
	"STATUS_COLOR_F" => "gray",
	"STATUS_COLOR_PSEUDO_CANCELLED" => "red",
	"SEF_URL_TEMPLATES" => array(
		"list" => "index.php",
		"detail" => "order_detail.php?ID=#ID#",
		"cancel" => "order_cancel.php?ID=#ID#",
	),
	"VARIABLE_ALIASES" => array(
		"detail" => array(
			"ID" => "ID",
		),
		"cancel" => array(
			"ID" => "ID",
		),
	)
	),
	false
);?>
</div><?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>