<?
	if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?><?
	CModule::IncludeModule("iblock");
	if ($arResult["VARIABLES"]["SECTION_ID"]>0)
	{
		$arFilter = Array('IBLOCK_ID'=>$arParams["IBLOCK_ID"], 'GLOBAL_ACTIVE'=>'Y', "ID" => $arResult["VARIABLES"]["SECTION_ID"]);
		$db_list = CIBlockSection::GetList(array(), $arFilter, true, array());

		while($section = $db_list->GetNext())
		{
			$res["NAME"] = $section["NAME"];
			$res["ID"] = $section["ID"];
			$res["PAGE"]["title"] = $section[$arParams["LIST_BROWSER_TITLE"]];
			$res["PAGE"]["keywords"] = $section[$arParams["LIST_META_KEYWORDS"]];
			$res["PAGE"]["description"] = $section[$arParams["LIST_META_DESCRIPTION"]];
		}
	}
	elseif(strlen(trim($arResult["VARIABLES"]["SECTION_CODE"]))>0)
	{
		$arFilter = Array('IBLOCK_ID'=>$arParams["IBLOCK_ID"], 'GLOBAL_ACTIVE'=>'Y', "=CODE" => $arResult["VARIABLES"]["SECTION_CODE"]);
		$db_list = CIBlockSection::GetList(array(), $arFilter, true, array());

		while($section = $db_list->GetNext())
		{

			$res["NAME"] = $section["NAME"];
			$res["ID"] = $section["ID"];
			$res["PAGE"]["title"] = $section[$arParams["LIST_BROWSER_TITLE"]];
			$res["PAGE"]["keywords"] = $section[$arParams["LIST_META_KEYWORDS"]];
			$res["PAGE"]["description"] = $section[$arParams["LIST_META_DESCRIPTION"]];
		}

	} 
	foreach($res["PAGE"] as $code => $value ) { if ($value) { $APPLICATION->SetPageProperty($code, $value); } else {unset($res["PAGE"][$code]);}}
	if($res["PAGE"]) 
	{
		global $SectionPageProperties;
		$SectionPageProperties = $res["PAGE"];
	}
	$ipropValues = new \Bitrix\Iblock\InheritedProperty\SectionValues($arParams["IBLOCK_ID"], IntVal($arResult["VARIABLES"]["SECTION_ID"]));
	$values=$ipropValues->getValues();
	$ishop_page_title=$values['SECTION_META_TITLE']?$values['SECTION_META_TITLE']:$res["NAME"];
	$ishop_page_h1=$values['SECTION_PAGE_TITLE']?$values['SECTION_PAGE_TITLE']:$res["NAME"];
	$APPLICATION->SetTitle($ishop_page_title);
?>

<? $APPLICATION->AddChainItem($ishop_page_h1, "", true);?>

			<?$APPLICATION->IncludeComponent(
				"ad_shop:catalog.section",
				"gallery_shop_list2",
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
					"PAGE_ELEMENT_COUNT" => "10",
					"LINE_ELEMENT_COUNT" => $arParams["LINE_ELEMENT_COUNT"],
					"PROPERTY_CODE" => $arParams["LIST_PROPERTY_CODE"],
					"OFFERS_FIELD_CODE" => $arParams["LIST_OFFERS_FIELD_CODE"],
					"OFFERS_PROPERTY_CODE" => $arParams["LIST_OFFERS_PROPERTY_CODE"],
					"OFFERS_SORT_FIELD" => $arParams["OFFERS_SORT_FIELD"],
					"OFFERS_SORT_ORDER" => $arParams["OFFERS_SORT_ORDER"],
					"SECTION_URL" => $arResult["FOLDER"].$arResult["URL_TEMPLATES"]["section"],
					"DETAIL_URL" => $arResult["FOLDER"].$arResult["URL_TEMPLATES"]["element"],
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
					"CACHE_TYPE" =>$arParams["CACHE_TYPE"],
					"CACHE_TIME" => $arParams["CACHE_TIME"],
					"CACHE_GROUPS" => $arParams["CACHE_GROUPS"],
					"META_KEYWORDS" => $arParams["LIST_META_KEYWORDS"],
					"META_DESCRIPTION" => $arParams["LIST_META_DESCRIPTION"],
					"BROWSER_TITLE" => $arParams["LIST_BROWSER_TITLE"],
					"ADD_SECTIONS_CHAIN" => "N",
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
					"DISPLAY_BOTTOM_PAGER" => "Y",
					"PAGER_TITLE" => $arParams["PAGER_TITLE"],
					"PAGER_SHOW_ALWAYS" => $arParams["PAGER_SHOW_ALWAYS"],
					"PAGER_TEMPLATE" => "shop",
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
					"USE_PRODUCT_QUANTITY" => $arParams["USE_PRODUCT_QUANTITY"]
				),
			$component
			);?>