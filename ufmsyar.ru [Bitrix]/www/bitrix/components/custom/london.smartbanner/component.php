<?
if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true) die();
if(!CModule::IncludeModule("iblock")) {
	ShowError(GetMessage("IBLOCK_MODULE_NOT_INSTALLED"));
	return;
}

$arParams = array(
	"IBLOCK_ID" => intval($arParams["IBLOCK_ID"]),
	"SECTION" => intval($arParams["IBLOCK_SECTION"]),
);


$arrFilter = array(
	"IBLOCK_ID"=>$arParams ["IBLOCK_ID"],
	"ACTIVE"=>"Y"
);
if ($arParams["SECTION"]>0) $arrFilter["SECTION_ID"]=$arParams["SECTION"];
global $APPLICATION;
		$path = $APPLICATION->GetCurPage();
		$arrFilter["!PROPERTY_PAGE_EXCLUSION"] = $path;
		$pathArr = explode("/", $path);
		$allPathArr = array("/");
		$pathToDir="/";
		foreach($pathArr as $dir){
			if ($dir){
				$pathToDir .= $dir."/";
				$allPathArr[] = $pathToDir;
			}
		}
		$arrFilterPart["LOGIC"]="OR";
		$arrFilterPart[] = array("PROPERTY_PAGE"=>$path);
		foreach($allPathArr as $dir){
			$arrFilterPart[] = array(
				"PROPERTY_PAGE"=>$dir,
				"PROPERTY_SUBSECTION_VALUE"=>"Y"
			);
		}
		$arrFilter[] = $arrFilterPart;
		$ibRes = CIBlockElement::GetList(array("sort","desc"), $arrFilter, false,false, array("ID","NAME","PREVIEW_TEXT","PREVIEW_PICTURE","PROPERTY_REF"));
		$result = array();
		while ($banner = $ibRes->GetNext()){
			//print_r($banner);
			$arResult["BANNERS"][] = array(
				"NAME"=>$banner["NAME"],
				"PICTURE"=>CFile::GetFileArray($banner["PREVIEW_PICTURE"]),
				"URL"=>$banner["PROPERTY_REF_VALUE"],
				"TEXT"=>$banner["PREVIEW_TEXT"]
			);
		}	
$this->IncludeComponentTemplate();



?>
