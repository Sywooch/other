<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetPageProperty("keywords", "Фотокаталог10");
$APPLICATION->SetPageProperty("description", "Фотокаталог10");
$APPLICATION->SetTitle("Фотокаталог10");
?><?$APPLICATION->IncludeComponent(
	"altasib:photoplayer",
	"",
Array(),
false
);?><?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>