<?
if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
global $APPLICATION;

   $aMenuLinksExt=$APPLICATION->IncludeComponent("bitrix:menu.sections", "", array(
   "IS_SEF" => "Y",
   "SEF_BASE_URL" => "/top_main/",
   "SECTION_PAGE_URL" => "#SECTION_CODE#/",
   "DETAIL_PAGE_URL" => "#SECTION_CODE#/#ELEMENT_CODE#",
   "IBLOCK_TYPE" => "top_main",
   "IBLOCK_ID" => "9", // ID - id вашего инфоблока
   "DEPTH_LEVEL" => "4",
   "CACHE_TYPE" => "A",
   "CACHE_TIME" => "0",
   "CACHE_TYPE" => "A",
   "CACHE_TIME" => "3600"
   ),
false
);
$aMenuLinks = array_merge($aMenuLinks, $aMenuLinksExt);
?>
