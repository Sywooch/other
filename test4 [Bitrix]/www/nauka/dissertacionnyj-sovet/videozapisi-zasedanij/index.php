<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("Видеозаписи заседаний");
?>Видеозаписи заседаний<?$APPLICATION->IncludeComponent("bitrix:iblock.tv", "template1", array(
	"IBLOCK_TYPE" => "video",
	"IBLOCK_ID" => "15",
	"ALLOW_SWF" => "N",
	"PATH_TO_FILE" => "13",
	"DURATION" => "14",
	"WIDTH" => "300",
	"HEIGHT" => "200",
	"LOGO" => "/bitrix/components/bitrix/iblock.tv/templates/.default/images/logo.png",
	"SECTION_ID" => "",
	"SHOW_COUNTER_EVENT" => "N",
	"DEFAULT_SMALL_IMAGE" => "/bitrix/components/bitrix/iblock.tv/templates/.default/images/default_small.png",
	"DEFAULT_BIG_IMAGE" => "/bitrix/components/bitrix/iblock.tv/templates/.default/images/default_big.png",
	"SORT_BY1" => "ACTIVE_FROM",
	"SORT_ORDER1" => "DESC",
	"CACHE_TYPE" => "A",
	"CACHE_TIME" => "3600",
	"CACHE_GROUPS" => "Y"
	),
	false
);?><?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>