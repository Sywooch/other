<?
if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true) die();

CPageOption::SetOptionString("main", "nav_page_in_session", "N");

if(!isset($arParams["CACHE_TIME"]))
	$arParams["CACHE_TIME"] = 36000000;

$arParams["IBLOCK_TYPE"] = trim($arParams["IBLOCK_TYPE"]);
if(strlen($arParams["IBLOCK_TYPE"])<=0)
	$arParams["IBLOCK_TYPE"] = "news";
$arParams["IBLOCK_ID"] = trim($arParams["IBLOCK_ID"]);
$arParams["PARENT_SECTION"] = intval($arParams["PARENT_SECTION"]);
$arParams["INCLUDE_SUBSECTIONS"] = $arParams["INCLUDE_SUBSECTIONS"]!="N";

$arParams["SORT_BY1"] = trim($arParams["SORT_BY1"]);
if(strlen($arParams["SORT_BY1"])<=0)
	$arParams["SORT_BY1"] = "ACTIVE_FROM";
if(!preg_match('/^(asc|desc|nulls)(,asc|,desc|,nulls){0,1}$/i', $arParams["SORT_ORDER1"]))
	$arParams["SORT_ORDER1"]="DESC";

if(strlen($arParams["SORT_BY2"])<=0)
	$arParams["SORT_BY2"] = "SORT";
if(!preg_match('/^(asc|desc|nulls)(,asc|,desc|,nulls){0,1}$/i', $arParams["SORT_ORDER2"]))
	$arParams["SORT_ORDER2"]="ASC";
	
$bUSER_HAVE_ACCESS = !$arParams["USE_PERMISSIONS"];
if($arParams["USE_PERMISSIONS"] && isset($GLOBALS["USER"]) && is_object($GLOBALS["USER"]))
{
	$arUserGroupArray = $GLOBALS["USER"]->GetUserGroupArray();
	foreach($arParams["GROUP_PERMISSIONS"] as $PERM)
	{
		if(in_array($PERM, $arUserGroupArray))
		{
			$bUSER_HAVE_ACCESS = true;
			break;
		}
	}
}
	
if($this->StartResultCache(false, array(($arParams["CACHE_GROUPS"]==="N"? false: $USER->GetGroups()), $bUSER_HAVE_ACCESS, $arNavigation, $arrFilter)))
{
	if(!CModule::IncludeModule("iblock"))
	{
		$this->AbortResultCache();
		ShowError(GetMessage("IBLOCK_MODULE_NOT_INSTALLED"));
		return;
	}
	
	$arResult = array();
	
	if( $arParams["VIEW_HIT"] == "Y" ){
		$arResult["ITEMS"][] = array( "NAME" => GetMessage("HIT"), "CODE" => "HIT" );
	}
	
	if( $arParams["VIEW_RECOMMEND"] == "Y" ){
		$arResult["ITEMS"][] = array( "NAME" => GetMessage("RECOMMEND"), "CODE" => "RECOMMEND" );
	}
	
	if( $arParams["VIEW_STOCK"] == "Y" ){
		$arResult["ITEMS"][] = array( "NAME" => GetMessage("STOCK"), "CODE" => "STOCK" );
	}
	
	if( $arParams["VIEW_NEW"] == "Y" ){
		$arResult["ITEMS"][] = array( "NAME" => GetMessage("NEW"), "CODE" => "NEW" );
	}
	
	if( count($arResult["ITEMS"]) ){
		$this->SetResultCacheKeys(array(
			"ID",
			"IBLOCK_TYPE_ID",
			"LIST_PAGE_URL",
			"NAV_CACHED_DATA",
			"NAME",
			"SECTION",
			"ELEMENTS",
		));
		$this->IncludeComponentTemplate();
	}else{
		$this->AbortResultCache();
		ShowError("Не указаны фильтры");
	}
}



