<?
if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true) die();
/** @var CBitrixComponent $this */
/** @var array $arParams */
/** @var array $arResult */
/** @var string $componentPath */
/** @var string $componentName */
/** @var string $componentTemplate */
/** @global CDatabase $DB */
/** @global CUser $USER */
/** @global CMain $APPLICATION */

/** @global CCacheManager $CACHE_MANAGER */
global $CACHE_MANAGER;
/** @global CIntranetToolbar $INTRANET_TOOLBAR */
global $INTRANET_TOOLBAR;



$IBLOCK_ID = CATALOG_IBLOCK_OFFERS_ID_RU;
$codeColor = BX_IBLOCK_OFFERS_PROPERTY_COLOR_RU;

if(LANGUAGE_ID == 'en') {
    $IBLOCK_ID = CATALOG_IBLOCK_OFFERS_ID_EN;
    $codeColor = BX_IBLOCK_OFFERS_PROPERTY_COLOR_EN;
}



//сформировать список всех цветов среди товаров
$intIBlockID = $arParams["IBLOCK_ID"];

$mxResult = CCatalogSKU::GetInfoByProductIBlock(
	$intIBlockID
);

unset($arColors);

CModule::IncludeModule("sale");

$rsElements = CIBlockElement::GetList(array(), array("IBLOCK_ID" => $intIBlockID, "SECTION_ID" => $arParams["IBLOCK_SECTION_ID"]),
	false, false, array());
while($arItem = $rsElements->GetNext()) {


	if (CCatalogSKU::IsExistOffers($arItem["ID"], $intIBlockID)) {

		//'ACTIVE' => "Y", '!PRICE' => "",
		$rsOffers = CIBlockElement::GetList(array("PRICE" => "ASC"),
			array('ACTIVE' => "Y", 'IBLOCK_ID' => $mxResult['IBLOCK_ID'], 'PROPERTY_' . $mxResult['SKU_PROPERTY_ID'] => $arItem["ID"]));


		//список цветов для каждого товара
		while ($arOffer = $rsOffers->GetNext()) {
			//echo "<pre>";
			//print_r($arOffer);
			//echo "</pre>";

			$ar_price = GetCatalogProductPrice($arOffer["ID"], 1);

			if(empty($ar_price["PRICE"])){ continue; }

			$db_props = CIBlockElement::GetProperty($arOffer["IBLOCK_ID"], $arOffer["ID"],
				array("sort" => "asc"), Array("CODE"=>$codeColor));
			if($ar_props = $db_props->Fetch()){
				$COLOR = $ar_props["VALUE"];
				$arColors[] = $COLOR;
			}
		}

	}


}



//получить список цветов для фильтра
//----------------------------------------------------------------
$res = CIBlock::GetProperties($IBLOCK_ID);
while($res_arr = $res->Fetch()){

	if($res_arr['CODE'] == $codeColor){
		$property_enums = CIBlockPropertyEnum::GetList(Array("SORT"=>"ASC"),
			Array("IBLOCK_ID"=>$IBLOCK_ID, "CODE"=>$codeColor, "!SORT"=>"999"));
		$i=0;
		while($enum_fields = $property_enums->GetNext())
		{
			if(in_array($enum_fields["ID"], $arColors)){

				$arResult["FILTER_COLORS"][$i]["ID"]=$enum_fields["ID"];
				$arResult["FILTER_COLORS"][$i]["VALUE"]=$enum_fields["VALUE"];

			}
			
			$i++;
		}
		break;
	}
}
//----------------------------------------------------------------


$this->IncludeComponentTemplate();

return $arResult;
?>