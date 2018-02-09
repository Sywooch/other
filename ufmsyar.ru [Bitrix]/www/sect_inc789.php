<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("");
?><?$APPLICATION->IncludeComponent(
	"custom:london.smartbanner",
	"template7",
	Array(
		"IBLOCK_TYPE" => "LONDON_SMART_BANNER",
		"IBLOCK_ID" => "15",
		"IBLOCK_SECTION" => "138"
	)
);?><br><?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>