<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetPageProperty("keywords", "Фотокаталог8");
$APPLICATION->SetPageProperty("description", "Фотокаталог8");
$APPLICATION->SetTitle("фотокаталог8");
?><?$APPLICATION->IncludeComponent("bitrix:asd.slider.pics", ".default", array(
	"IBLOCK_TYPE" => "products",
	"IBLOCK_ID" => "2",
	"PIC_FROM" => "PREVIEW_PICTURE",
	"SORT" => "RAND",
	"LINK" => "",
	"COUNT" => "",
	"TIME" => "",
	"CACHE_TYPE" => "A",
	"CACHE_TIME" => "8640000"
	),
	false
);?><?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>