<?
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true) die();

if(!CModule::IncludeModule("iblock"))
	return;
$arTypesEx = CIBlockParameters::GetIBlockTypes(Array("-"=>" "));

$arIBlocks=Array();
$db_iblock = CIBlock::GetList(Array("SORT"=>"ASC"), Array("SITE_ID"=>$_REQUEST["site"], "TYPE" => ($arCurrentValues["IBLOCK_TYPE"]!="-"?$arCurrentValues["IBLOCK_TYPE"]:"")));
while($arRes = $db_iblock->Fetch()) {
	$arIBlocks[$arRes["ID"]] = $arRes["NAME"];
}
if ($arCurrentValues["IBLOCK_ID"])
{
$ibRes = CIBlockSection::GetList(array("sort"=>"asc"), array("IBLOCK_ID"=>$arCurrentValues["IBLOCK_ID"],"ACTIVE"=>"Y"), false, array("ID","NAME"));

while ($section = $ibRes->GetNext()){
	$arSections[$section["ID"]] = $section["NAME"];
}
}

$arComponentParameters = array(
	"GROUPS" => array(
	),
	"PARAMETERS" => array(
		"IBLOCK_TYPE" => Array(
			"PARENT" => "BASE",
			"NAME" => GetMessage("IBLOCK_TYPE"),
			"TYPE" => "LIST",
			"VALUES" => $arTypesEx,
			"DEFAULT" => "news",
			"REFRESH" => "Y",
		),
		"IBLOCK_ID" => Array(
			"PARENT" => "BASE",
			"NAME" =>  GetMessage("IBLOCK_ID"),
			"TYPE" => "LIST",
			"VALUES" => $arIBlocks,
			"DEFAULT" => '={$_REQUEST["ID"]}',
			"REFRESH" => "Y",
		),
		"IBLOCK_SECTION" => Array(
			"PARENT" => "BASE",
			"NAME" =>  GetMessage("IBLOCK_SECTION"),
			"TYPE" => "LIST",
			"VALUES" => $arSections,
			"DEFAULT" => '',
			"ADDITIONAL_VALUES" => "Y",
		),
	),
);
?>
