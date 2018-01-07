<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>


<ul class="b-main-top__sections" data-moretext="<? echo GetMessage('SB_TOP_SEE_MORE') ?>">

	<?if(LANGUAGE_ID==='en'):?>
		<?$APPLICATION->IncludeComponent("bitrix:catalog.smart.filter", "top", array(
			"IBLOCK_TYPE" => "catalog",
			"IBLOCK_ID" => CATALOG_IBLOCK_ID_EN,
			"SECTION_ID" => "",
			"FILTER_NAME" => "arrFilter",
			"PRICE_CODE" => "",
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
	<?else:?>

		<?$APPLICATION->IncludeComponent("bitrix:catalog.smart.filter", "top", array(
			"IBLOCK_TYPE" => "aspro_ishop_catalog",
			"IBLOCK_ID" => CATALOG_IBLOCK_ID,
			"SECTION_ID" => "",
			"FILTER_NAME" => "arrFilter",
			"PRICE_CODE" => "",
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
	<?endif?>
</ul>
	<? ob_start(); ?>
	<?$APPLICATION->IncludeComponent(
		"bitrix:catalog.section.list",
		"shop_groups",
		Array(
			"IBLOCK_TYPE" => $arParams["IBLOCK_TYPE"],
			"IBLOCK_ID" => $arParams["IBLOCK_ID"],
			"DISPLAY_PANEL" => $arParams["DISPLAY_PANEL"],
			"CACHE_TYPE" => $arParams["CACHE_TYPE"],
			"CACHE_TIME" => $arParams["CACHE_TIME"],
			"CACHE_GROUPS" => $arParams["CACHE_GROUPS"],
			"COUNT_ELEMENTS" => $arParams["SECTION_COUNT_ELEMENTS"],
			"SECTION_URL" => $arResult["FOLDER"].$arResult["URL_TEMPLATES"]["section"],
			"ADD_SECTIONS_CHAIN" => "N",
			"TOP_DEPTH" => "1"
		),
		$component
	);
	?>
