<?
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true) die();

use Bitrix\Main\Localization\Loc as Loc;

Loc::loadMessages(__FILE__);

$arComponentDescription = array(
	"NAME" => Loc::getMessage('MAIN_SLIDER_DESCRIPTION_NAME'),
	"DESCRIPTION" => Loc::getMessage('MAIN_SLIDER_DESCRIPTION_DESCRIPTION'),
	"ICON" => '/images/icon.gif',
	"SORT" => 20,
	"PATH" => array(
		"ID" => 'ad_shop',
		"NAME" => Loc::getMessage('MAIN_SLIDER_DESCRIPTION_GROUP'),
		"SORT" => 10
	),
);

?>