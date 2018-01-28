<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("Клиника");
?><?$APPLICATION->IncludeComponent("altasib:photoplayer1mod", "template1", array(
	"SOURCE" => "1",
	"COLLECTION_ID_0" => "1",
	"DETAIL_PICT_RESIZE" => "Y",
	"PREVIEW_PICT_RESIZE" => "Y",
	"WRAP" => "WRAP_BOTH",
	"COUNT_EL" => "100",
	"SHOW_RANDOM" => "N",
	"ANIMATION_TYPE" => "fade",
	"SPEED" => "600",
	"SHOW_BUTTONS" => "Y",
	"SHOW_AUTO" => "N",
	"CLEAR_RESIZE_IMG" => "N",
	"ALLX" => "0",
	"ALLY" => "0",
	"BIGPICY" => "300",
	"PREVPICX" => "112",
	"PREVPICY" => "90",
	"INTERVAL" => "15",
	"PREVPIC_NUM" => "5",
	"DISCR_HEIGHT" => "50",
	"DISCR_TITLE_SIZE" => "12",
	"DISCR_TEXT_SIZE" => "10",
	"SHOW_FANCYBOX" => "N",
	"CACHE_TYPE" => "A",
	"CACHE_TIME" => "3600"
	),
	false
);?><?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>