<?

if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();

global $APPLICATION;

$aMenuLinksExt=$APPLICATION->IncludeComponent("bitrix:menu.sections", "", array(
"IS_SEF" => "Y",
"SEF_BASE_URL" => "/menu2/", //директория каталога у вас
"SECTION_PAGE_URL" => "#SECTION_ID#/",
"DETAIL_PAGE_URL" => "#SECTION_ID#/#ELEMENT_ID#",
"IBLOCK_TYPE" => "infoportal_news_s1", //название инфоблока
"IBLOCK_ID" => "2", //ID инфоблока
"DEPTH_LEVEL" => "4",
"CACHE_TYPE" => "A",
"CACHE_TIME" => "3600"
),
false
);

$aMenuLinks = array_merge($aMenuLinks, $aMenuLinksExt);

?>