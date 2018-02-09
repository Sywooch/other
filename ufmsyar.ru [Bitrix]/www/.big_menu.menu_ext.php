<? 

//$res = CIBlockSection::GetByID($arElement["IBLOCK_SECTION_ID"]);
//if($ar_res = $res->GetNext())
//echo $ar_res['NAME'];

//$arResult["SECTION_ID"] = CIBlockFindTools::GetSectionID(
//    $arResult["VARIABLES"]["SECTION_ID"],
//    $arResult["VARIABLES"]["SECTION_CODE"],
//    array("IBLOCK_ID" => $arParams["IBLOCK_ID"])
//);

//$sResult = CIBlockSection::GetByID($arResult["SECTION_ID"]);
//if($sArResult = $sResult->GetNext()){ echo $sArResult['NAME'];}
////

//$gid="#SECTION_CODE#";
//$res = CIBlockSection::GetByID($gid);//
//if($ar_res = $res->GetNext())
//  $parent=$ar_res['IBLOCK_SECTION_ID'];



  if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die(); 
  global $APPLICATION; 
  $aMenuLinksExt=$APPLICATION->IncludeComponent("bitrix:menu.sections", "", array( 
  "IS_SEF" => "Y", 
  "SEF_BASE_URL" => "/", 
	  "SECTION_PAGE_URL" => "#SECTION_CODE_PATH#/", 
  "DETAIL_PAGE_URL" => "#SECTION_ID#/#ELEMENT_ID#", 
  "IBLOCK_TYPE" => "home", 
  "IBLOCK_ID" => "7", 
  "DEPTH_LEVEL" => "4", 
  "CACHE_TYPE" => "A", 
  "CACHE_TIME" => "36000000" 
  ), 
false 
); 
  $aMenuLinks = array_merge($aMenuLinksExt, $aMenuLinks); 
?>