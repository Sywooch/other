<?
	$arSections = array();

	foreach( $arResult["SECTIONS"] as $arItem ):
		if( $arItem["DEPTH_LEVEL"] == 1 ):
			$arSections[$arItem["ID"]] = $arItem;
		elseif( $arItem["DEPTH_LEVEL"] == 2 ):
			$arSections[$arItem["IBLOCK_SECTION_ID"]]["SECTIONS"][$arItem["ID"]] = $arItem;
		endif;
	endforeach;
	
	$arResult["SECTIONS"] = $arSections;

CModule::IncludeModule("sale");

$arSelect = array(
	"ID",
	"IBLOCK_ID",
	"IBLOCK_SECTION_ID",
	"CODE",
	"XML_ID",
	"NAME",
	"PROPERTY_*"
);

unset($arSections);


foreach($arResult["SECTIONS"] as $key => $value){

    $countElements = 0;

    $arFilter = array("SECTION_ID"=>$value['ID'], "IBLOCK_ID"=>$value["IBLOCK_ID"], '>PROPERTY_MINIMUM_PRICE' => 0, 'ACTIVE' => 'Y');
    $rsElements = CIBlockElement::GetList(array(), $arFilter, false, false, ['ID', 'PROPERTY_MINIMUM_PRICE']);
    $countElements = $rsElements->SelectedRowsCount();

	$value["COUNT_ELEMENTS"] = $countElements;

	if($countElements > 0){
		$arSections[] = $value;
	}
}

unset($arResult["SECTIONS"]);
$arResult["SECTIONS"] = $arSections;


$cp = $this->__component;
$cp->SetResultCacheKeys(array(
	"SECTIONS"
));

