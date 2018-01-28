<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("Видео");
?> 
<div style="text-align: center;"><b><span style="font-size: 16pt; font-family: Tahoma; color: rgb(67, 94, 130);">Видео 4-го созыва</span></b></div>
 
<br />
 
<div style="text-align: center;"><?$APPLICATION->IncludeComponent(
	"bitrix:iblock.tv",
	"template_video1",
	Array(
		"IBLOCK_TYPE" => "video",
		"IBLOCK_ID" => "5",
		"ALLOW_SWF" => "N",
		"PATH_TO_FILE" => "9",
		"DURATION" => "10",
		"WIDTH" => "1000",
		"HEIGHT" => "750",
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
	)
);?></div>
 
<div style="text-align: center;"></div>
 
<div style="text-align: center;"></div>
  <?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>