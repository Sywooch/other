<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("");
?><?$APPLICATION->IncludeComponent("custom:london.smartbanner", "template17", Array(
	"IBLOCK_TYPE" => "LONDON_SMART_BANNER",	// Тип инфо-блока
	"IBLOCK_ID" => "15",	// Инфо-блок
	"IBLOCK_SECTION" => "152",	// тип баннера
	),
	false
);?><br><?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>