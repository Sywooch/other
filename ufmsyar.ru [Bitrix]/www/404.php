<?
include_once($_SERVER['DOCUMENT_ROOT'].'/bitrix/modules/main/include/urlrewrite.php');

CHTTP::SetStatus("404 Not Found");
@define("ERROR_404","Y");

require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");

$APPLICATION->SetTitle("Страница не найдена");

$APPLICATION->IncludeComponent("stream:page404", ".default", array(
	"TITLE" => "404",
	"CLEAR_PAGE" => "N",
	"IMAGE" => "/images/404.png",
	"REDIRECT_ONOFF" => "N",
	"REDIRECT_URL" => "/index.php",
	"REDIRECT_MSEC" => "1000",
	"PHRASE_COUNT" => "2",
	"PHRASE_1" => "Ошибка!",
	"PHRASE_2" => "Заданной страницы не существует."
	),
	false
);

require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>