<?
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true) die();

$arTemplateParameters = array(
	"IBLOCK_CATALOG_TYPE" => Array(
		"NAME" => GetMessage("IBLOCK_CATALOG_TYPE"),
		"TYPE" => "STRING",
		"DEFAULT" => "",
	),
	"IBLOCK_CATALOG_ID" => Array(
		"NAME" => GetMessage("IBLOCK_CATALOG_ID"),
		"TYPE" => "STRING",
		"DEFAULT" => "",
	),
	"IBLOCK_CATALOG_DIR" => Array(
		"NAME" => GetMessage("IBLOCK_CATALOG_DIR"),
		"TYPE" => "STRING",
		"DEFAULT" => SITE_DIR."catalog/",
	),
	"MAX_CATALOG_GROUPS_COUNT" => Array(
		"NAME" => GetMessage("MAX_CATALOG_GROUPS_COUNT"),
		"TYPE" => "STRING",
		"DEFAULT" => "5",
	),
	
);

?>
