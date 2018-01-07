<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("Завершено");
?><?$APPLICATION->IncludeComponent(
	"bitrix:sale.order.payment.receive",
	"",
	Array(
		"PAY_SYSTEM_ID" => "19",
		"PERSON_TYPE_ID" => "1"
	),
false
);?> <?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>