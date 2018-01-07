<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("Success");
?><?$APPLICATION->IncludeComponent("bitrix:sale.order.payment.receive", "", array(
	"PAY_SYSTEM_ID" => "19",
	"PERSON_TYPE_ID" => "5"
	),
	false
);?> <?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>