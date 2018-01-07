<? if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>

<div class="tabs_section">
	<ul class="tabs">
		<?foreach( $arResult["ITEMS"] as $key => $arItem ){?>
			<li <?=$key == 0 ? 'class="current"' : ''?>>
				<span><i><?=$arItem["NAME"]?></i></span>
			</li>
		<?}?>
	</ul>
	<?foreach( $arResult["ITEMS"] as $key => $arItem ){?>
		<div class="box" <?=$key == 0 ? 'style="display: block;"' : ''?>>
			<div class="items">
				<?$GLOBALS['arrFilter'] = array("=PROPERTY_".$arItem["CODE"]."_VALUE" => "yes");?>
				
				<?if( $arParams["ALTERNATIVE_CACHE"] == "Y" ){
					if( isset($_GET["clear_cache"]) && $_GET["clear_cache"] == "Y" ){
						$files = glob('rand_cache/*');
						if( count( $files ) ){
							foreach( $files as $file ){
								if( file_exists($file) ){
									unlink($file);
								}
							}
						}
					}
					$rand_n = rand(0, $arParams["ALTERNATIVE_CACHE_COUNT"]);
					if( file_exists( 'rand_cache/'.$arItem["CODE"].'_'.$rand_n.'.php' ) ){
						include_once('rand_cache/'.$arItem["CODE"].'_'.$rand_n.'.php');
					}else{
						$r = fopen('rand_cache/'.$arItem["CODE"].'_'.$rand_n.'.php', 'a');
						ob_start();
						$APPLICATION->IncludeComponent(
							"bitrix:catalog.section",
							"shop_table_preview", 
							Array(
								"IBLOCK_TYPE" => $arParams["IBLOCK_TYPE"],
								"IBLOCK_ID" => $arParams["IBLOCK_ID"],
								"SECTION_ID" => $arResult["VARIABLES"]["SECTION_ID"],
								"SECTION_CODE" => $arResult["VARIABLES"]["SECTION_CODE"],
								"ELEMENT_SORT_FIELD" => $arParams["SORT_BY1"],
								"ELEMENT_SORT_ORDER" => $arParams["SORT_BY2"],
								"FILTER_NAME" => "arrFilter",
								"INCLUDE_SUBSECTIONS" => "Y",
								"SHOW_ALL_WO_SECTION" => "Y",
								"PAGE_ELEMENT_COUNT" => $arParams["COUNT_VIEW"],
								"LINE_ELEMENT_COUNT" => 5,
								"PROPERTY_CODE" => $arParams["LIST_PROPERTY_CODE"],
								"OFFERS_FIELD_CODE" => array("ID"),
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
								"DISPLAY_COMPARE" => "Y",
								"SET_TITLE" => $arParams["SET_TITLE"],
								"SET_STATUS_404" => $arParams["SET_STATUS_404"],
								"CACHE_FILTER" => $arParams["CACHE_FILTER"],
								"PRICE_CODE" => array(0 => "BASE"),
								"USE_PRICE_COUNT" => $arParams["USE_PRICE_COUNT"],
								"SHOW_PRICE_COUNT" => $arParams["SHOW_PRICE_COUNT"],
								"PRICE_VAT_INCLUDE" => $arParams["PRICE_VAT_INCLUDE"],
								"USE_PRODUCT_QUANTITY" => $arParams["SET_STATUS_404"],
								"OFFERS_CART_PROPERTIES" => array(),
								"DISPLAY_TOP_PAGER" => "N",
								"DISPLAY_BOTTOM_PAGER" => "N",
								"PAGER_TITLE" => $arParams["PAGER_TITLE"],
								"PAGER_SHOW_ALWAYS" => "N",
								"PAGER_TEMPLATE" => $arParams["PAGER_TEMPLATE"],
								"PAGER_DESC_NUMBERING" => $arParams["PAGER_DESC_NUMBERING"],
								"PAGER_DESC_NUMBERING_CACHE_TIME" => $arParams["PAGER_DESC_NUMBERING_CACHE_TIME"],
								"PAGER_SHOW_ALL" => "N",
								"AJAX_OPTION_ADDITIONAL" => "",
								"ADD_CHAIN_ITEM" => "N"
							),
							$component
						);
						$data = ob_get_contents();
						ob_end_flush();
						fwrite($r, $data);
						fclose($r);
					}
				}else{
					$APPLICATION->IncludeComponent(
							"bitrix:catalog.section",
							"shop_table_preview", 
							Array(
								"IBLOCK_TYPE" => $arParams["IBLOCK_TYPE"],
								"IBLOCK_ID" => $arParams["IBLOCK_ID"],
								"SECTION_ID" => $arResult["VARIABLES"]["SECTION_ID"],
								"SECTION_CODE" => $arResult["VARIABLES"]["SECTION_CODE"],
								"ELEMENT_SORT_FIELD" => $arParams["SORT_BY1"],
								"ELEMENT_SORT_ORDER" => $arParams["SORT_BY2"],
								"FILTER_NAME" => "arrFilter",
								"INCLUDE_SUBSECTIONS" => "Y",
								"SHOW_ALL_WO_SECTION" => "Y",
								"PAGE_ELEMENT_COUNT" => $arParams["COUNT_VIEW"],
								"LINE_ELEMENT_COUNT" => 5,
								"PROPERTY_CODE" => $arParams["LIST_PROPERTY_CODE"],
								"OFFERS_FIELD_CODE" => array("ID"),
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
								"DISPLAY_COMPARE" => "Y",
								"SET_TITLE" => $arParams["SET_TITLE"],
								"SET_STATUS_404" => $arParams["SET_STATUS_404"],
								"CACHE_FILTER" => $arParams["CACHE_FILTER"],
								"PRICE_CODE" => array(0 => "BASE"),
								"USE_PRICE_COUNT" => $arParams["USE_PRICE_COUNT"],
								"SHOW_PRICE_COUNT" => $arParams["SHOW_PRICE_COUNT"],
								"PRICE_VAT_INCLUDE" => $arParams["PRICE_VAT_INCLUDE"],
								"USE_PRODUCT_QUANTITY" => $arParams["SET_STATUS_404"],
								"OFFERS_CART_PROPERTIES" => array(),
								"DISPLAY_TOP_PAGER" => "N",
								"DISPLAY_BOTTOM_PAGER" => "N",
								"PAGER_TITLE" => $arParams["PAGER_TITLE"],
								"PAGER_SHOW_ALWAYS" => "N",
								"PAGER_TEMPLATE" => $arParams["PAGER_TEMPLATE"],
								"PAGER_DESC_NUMBERING" => $arParams["PAGER_DESC_NUMBERING"],
								"PAGER_DESC_NUMBERING_CACHE_TIME" => $arParams["PAGER_DESC_NUMBERING_CACHE_TIME"],
								"PAGER_SHOW_ALL" => "N",
								"AJAX_OPTION_ADDITIONAL" => "",
								"ADD_CHAIN_ITEM" => "N"
							),
							$component
						);
				}
			?>
			</div>
		</div>
	<?}?>
</div>