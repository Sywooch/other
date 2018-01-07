<?
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true) die();
use Bitrix\Main\Localization\Loc;
Loc::loadMessages(__FILE__);

$arComponentDescription = array(
	"NAME" => Loc::getMessage("STORE_LIST_TITLE"),
	"DESCRIPTION" => Loc::getMessage("STORE_LIST_DESCRIPTION"),
	"PATH" => array(
		"ID" => "amado",
		"NAME" => Loc::getMessage("GROUP_NAME")
	),
);