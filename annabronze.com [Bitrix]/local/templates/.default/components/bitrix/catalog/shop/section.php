<?

	if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?><?
	CModule::IncludeModule("iblock");
?>



	<?
	CModule::IncludeModule("catalog");
	$basePrice = CCatalogGroup::GetBaseGroup();
	$priceSort = "CATALOG_PRICE_".$basePrice["ID"];
	$arAvailableSort = array(
	"POPULARITY" => array("SHOW_COUNTER", "desc"),
	"NAME" => array("NAME", "asc"),
	"PRICE" => array($priceSort, "asc")
	);
	if ($arParams["SHOW_QUANTITY_SORT"]=="Y") { $arAvailableSort["QUANTITY"] = array("CATALOG_QUANTITY", "desc"); }
	$sort="POPULARITY";
	if ((array_key_exists("sort", $_REQUEST) && array_key_exists(ToUpper($_REQUEST["sort"]), $arAvailableSort)) || (array_key_exists("sort", $_SESSION) && array_key_exists(ToUpper($_SESSION["sort"]), $arAvailableSort)) || $arParams["ELEMENT_SORT_FIELD"])
	{
	if ($_REQUEST["sort"]) {$sort=ToUpper($_REQUEST["sort"]);  $_SESSION["sort"]=ToUpper($_REQUEST["sort"]);}
	elseif ($_SESSION["sort"]) {$sort=ToUpper($_SESSION["sort"]);}
	else {$sort=ToUpper($arParams["ELEMENT_SORT_FIELD"]);}
	}
	$sort_order=$arAvailableSort[$sort][1];
	if ((array_key_exists("order", $_REQUEST) && in_array(ToLower($_REQUEST["order"]), Array("asc", "desc")) ) || (array_key_exists("order", $_REQUEST) && in_array(ToLower($_REQUEST["order"]), Array("asc", "desc")) ) || $arParams["ELEMENT_SORT_ORDER"])
	{
	if ($_REQUEST["order"]) {$sort_order=$_REQUEST["order"]; $_SESSION["order"]=$_REQUEST["order"];}
	elseif ($_SESSION["order"]) {$sort_order=$_SESSION["order"];}
	else {$sort_order=ToLower($arParams["ELEMENT_SORT_ORDER"]);}
	}
	?>





<?


if($sort=="SORT" || $sort=="ARTICLE"){
	$sort="PROPERTY_CML2_ARTICLE2";
}

if($sort=="PRICE"){
	$sort="PROPERTY_MINIMUM_PRICE";
}

if( !isset($_GET["sort"]) && !isset($_GET["order"]) ){
	$sort="PROPERTY_CML2_ARTICLE2";
	$sort_order="asc";
}


//$arParams["ELEMENT_SORT_FIELD"]=="PROPERTY_MINIMUM_PRICE" && $arParams["ELEMENT_SORT_ORDER"]=="asc"

?>

<?

$count_sections = CIBlockSection::GetCount(array("SECTION_ID" => $arResult["VARIABLES"]["SECTION_ID"]));
if( $count_sections > 0 ){?>


	<?$APPLICATION->IncludeComponent(
		"bitrix:catalog.section.list",
		"shop_groups",
		Array(
			"IBLOCK_TYPE" => $arParams["IBLOCK_TYPE"],
			"IBLOCK_ID" => $arParams["IBLOCK_ID"],
			"SECTION_ID" => $arResult["VARIABLES"]["SECTION_ID"],
			"SECTION_CODE" => $arResult["VARIABLES"]["SECTION_CODE"],
			"DISPLAY_PANEL" => $arParams["DISPLAY_PANEL"],
			"CACHE_TYPE" => $arParams["CACHE_TYPE"],
			"CACHE_TIME" => $arParams["CACHE_TIME"],
			"CACHE_GROUPS" => $arParams["CACHE_GROUPS"],
			"COUNT_ELEMENTS" => $arParams["SECTION_COUNT_ELEMENTS"],
			"SECTION_URL" => $arResult["FOLDER"].$arResult["URL_TEMPLATES"]["section"],
			"ADD_SECTIONS_CHAIN" => "Y",
			"TOP_DEPTH" => "1"
		),
		$component
	);
	?>






<?
}else{

	$color_number="";
	if(isset($_GET["color"])){ $color_number=$_GET["color"]; }
	?>



<div class="b-catalog-section">



	<?$APPLICATION->IncludeComponent("bitrix:catalog.smart.filter", "shop", array(
			"IBLOCK_TYPE" => $arParams["IBLOCK_TYPE"],
				"IBLOCK_ID" => $arParams["IBLOCK_ID"],
				"SECTION_ID" => $arResult["VARIABLES"]["SECTION_ID"],
				"FILTER_NAME" => $arParams["FILTER_NAME"],
				"PRICE_CODE" => $arParams["PRICE_CODE"],
				"CACHE_TYPE" => "A",
				"CACHE_TIME" => "36000000",
				"CACHE_NOTES" => "",
				"CACHE_GROUPS" => "Y",
				"SAVE_IN_SESSION" => "N",
				"XML_EXPORT" => "Y",
				"SECTION_TITLE" => "NAME",
				"SECTION_DESCRIPTION" => "DESCRIPTION",
				//"SHOW_HINTS" => $arParams["SHOW_HINTS"],
				//"HIDE_NOT_AVAILABLE" => $arParams["HIDE_NOT_AVAILABLE"],
			),
			false
		);?>

	<?/* if(LANGUAGE_ID==='en'){
		$arResult["URL_TEMPLATES"]["element"] = "#SECTION_CODE_PATH#/#ELEMENT_CODE#/";
	} */?>

	<? $APPLICATION->IncludeComponent(
		"ad_shop:catalog.section",
		"shop_list",
		Array(
			"SEF_URL_TEMPLATES" => $arParams["SEF_URL_TEMPLATES"],
			"IBLOCK_TYPE" => $arParams["IBLOCK_TYPE"],
			"IBLOCK_ID" => $arParams["IBLOCK_ID"],
			"HIDE_NOT_AVAILABLE" => $arParams["HIDE_NOT_AVAILABLE"],
			"SECTION_ID" => $arResult["VARIABLES"]["SECTION_ID"],
			"SECTION_CODE" => $arResult["VARIABLES"]["SECTION_CODE"],
			"ELEMENT_SORT_FIELD" => $sort,
			"ELEMENT_SORT_ORDER" => $sort_order,
			"FILTER_NAME" => $arParams["FILTER_NAME"],
			"INCLUDE_SUBSECTIONS" => $arParams["INCLUDE_SUBSECTIONS"],
			"PAGE_ELEMENT_COUNT" => $show,
			"LINE_ELEMENT_COUNT" => $arParams["LINE_ELEMENT_COUNT"],
			"PROPERTY_CODE" => $arParams["LIST_PROPERTY_CODE"],
			"OFFERS_FIELD_CODE" => $arParams["LIST_OFFERS_FIELD_CODE"],
			"OFFERS_PROPERTY_CODE" => $arParams["LIST_OFFERS_PROPERTY_CODE"],
			"OFFERS_SORT_FIELD" => $arParams["OFFERS_SORT_FIELD"],
			"OFFERS_SORT_ORDER" => $arParams["OFFERS_SORT_ORDER"],
			"SECTION_URL" => $arResult["FOLDER"] . $arResult["URL_TEMPLATES"]["section"],
			"DETAIL_URL" => $arResult["FOLDER"] . $arResult["URL_TEMPLATES"]["element"],
			"BASKET_URL" => $arParams["BASKET_URL"],
			"ACTION_VARIABLE" => $arParams["ACTION_VARIABLE"],
			"PRODUCT_ID_VARIABLE" => $arParams["PRODUCT_ID_VARIABLE"],
			"PRODUCT_QUANTITY_VARIABLE" => "quantity",
			"PRODUCT_PROPS_VARIABLE" => "prop",
			"SECTION_ID_VARIABLE" => $arParams["SECTION_ID_VARIABLE"],
			"AJAX_MODE" => $arParams["AJAX_MODE"],
			"AJAX_OPTION_JUMP" => $arParams["AJAX_OPTION_JUMP"],
			"AJAX_OPTION_STYLE" => $arParams["AJAX_OPTION_STYLE"],
			"AJAX_OPTION_HISTORY" => $arParams["AJAX_OPTION_HISTORY"],
			"CACHE_TYPE" => $arParams["CACHE_TYPE"],
			"CACHE_TIME" => $arParams["CACHE_TIME"],
			"CACHE_GROUPS" => $arParams["CACHE_GROUPS"],
			"META_KEYWORDS" => $arParams["LIST_META_KEYWORDS"],
			"META_DESCRIPTION" => $arParams["LIST_META_DESCRIPTION"],
			"BROWSER_TITLE" => $arParams["LIST_BROWSER_TITLE"],
			"ADD_SECTIONS_CHAIN" => "Y",
			"DISPLAY_COMPARE" => $arParams["USE_COMPARE"],
			"SET_TITLE" => $arParams["SET_TITLE"],
			"SET_STATUS_404" => $arParams["SET_STATUS_404"],
			"CACHE_FILTER" => $arParams["CACHE_FILTER"],
			"PRICE_CODE" => $arParams["PRICE_CODE"],
			"USE_PRICE_COUNT" => $arParams["USE_PRICE_COUNT"],
			"SHOW_PRICE_COUNT" => $arParams["SHOW_PRICE_COUNT"],
			"PRICE_VAT_INCLUDE" => $arParams["PRICE_VAT_INCLUDE"],
			"USE_PRODUCT_QUANTITY" => $arParams["SET_STATUS_404"],
			"OFFERS_CART_PROPERTIES" => array(),
			"DISPLAY_TOP_PAGER" => $arParams["DISPLAY_TOP_PAGER"],
			"DISPLAY_BOTTOM_PAGER" => $arParams["DISPLAY_BOTTOM_PAGER"],
			"PAGER_TITLE" => $arParams["PAGER_TITLE"],
			"PAGER_SHOW_ALWAYS" => $arParams["PAGER_SHOW_ALWAYS"],
			"PAGER_TEMPLATE" => $arParams["PAGER_TEMPLATE"],
			"PAGER_DESC_NUMBERING" => $arParams["PAGER_DESC_NUMBERING"],
			"PAGER_DESC_NUMBERING_CACHE_TIME" => $arParams["PAGER_DESC_NUMBERING_CACHE_TIME"],
			"PAGER_SHOW_ALL" => $arParams["PAGER_SHOW_ALL"],
			"AJAX_OPTION_ADDITIONAL" => "",
			"ADD_CHAIN_ITEM" => "Y",
			"SHOW_QUANTITY" => $arParams["SHOW_QUANTITY"],
			"CONVERT_CURRENCY" => $arParams["CONVERT_CURRENCY"],
			"CURRENCY_ID" => $arParams["CURRENCY_ID"],
			"SHOW_MEASURE" => $arParams["SHOW_MEASURE"],
			"SHOW_QUANTITY_COUNT" => $arParams["SHOW_QUANTITY_COUNT"],
			"USE_PRODUCT_QUANTITY" => $arParams["USE_PRODUCT_QUANTITY"],
			"COLOR_FILTER_COLOR_NUMBER" => $color_number
		),
		$component
	); ?>

	<?
}
?>
