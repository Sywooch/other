<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("Опросы");
?><?$APPLICATION->IncludeComponent("bitrix:voting.current", "with_description", array(
	"CHANNEL_SID" => "NEW",
	"VOTE_ID" => "",
	"VOTE_ALL_RESULTS" => "N",
	"AJAX_MODE" => "N",
	"AJAX_OPTION_JUMP" => "N",
	"AJAX_OPTION_STYLE" => "Y",
	"AJAX_OPTION_HISTORY" => "N",
	"CACHE_TYPE" => "A",
	"CACHE_TIME" => "3600",
	"AJAX_OPTION_ADDITIONAL" => ""
	),
	false
);?><?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>