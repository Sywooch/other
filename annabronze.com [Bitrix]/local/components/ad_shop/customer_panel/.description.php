<?
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true) die();
use Bitrix\Main\Localization\Loc;
Loc::loadMessages(__FILE__);

$arComponentDescription = array(
	"NAME" => Loc::getMessage("CUSTOMER_PANEL_TITLE"),
	"DESCRIPTION" => Loc::getMessage("CUSTOMER_PANEL_DESCRIPTION"),
	"PATH" => array(
		"ID" => "amado",
		"NAME" => Loc::getMessage("GROUP_NAME")
	),
);