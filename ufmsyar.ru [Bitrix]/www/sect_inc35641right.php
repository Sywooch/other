<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("");
?></br>
<?$APPLICATION->IncludeComponent(
	"custom:london.smartbanner",
	"",
	Array(
		"IBLOCK_TYPE" => "LONDON_SMART_BANNER",
		"IBLOCK_ID" => "15",
		"IBLOCK_SECTION" => "166"
	)
);?><?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>