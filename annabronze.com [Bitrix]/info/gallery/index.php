<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetPageProperty("keywords", "фурнитура, фурнитура для украшений, фурнитура для бижутерии, подвеска, тоггл, замок, колпачки для бусин, шапочки для бусин, бусины");
$APPLICATION->SetPageProperty("description", "Anna Bronze. Авторская фурнитура Анны Черных");
$APPLICATION->SetTitle("Галерея украшений с фурнитурой Anna Bronze");
?> 
<!--<div>В этом разделе Вы можете познакомиться с работами мастеров, работающих с нашей фурнитурой. В описании работы можно посмотреть фурнитуру, которая использовалась при сборке. Кликнув на артикул в списке, Вы перейдете на его страницу с подробным описанием.</div>
 
<div> 
  <br />
 </div>
 
<div>Если Вам понравилась работа и Вы хотели бы приобрести её, нужно связаться непосредственно с автором.
    На нашем сайте украшения не продаются и выставлены в качестве примера использования нашей фурнитуры.
    Связаться с автором можно по ссылке, которая есть в описании каждой работы. Приятного просмотра! -->
 <?$APPLICATION->IncludeComponent("bitrix:catalog", "gallery2", array(
	"IBLOCK_TYPE" => "aspro_ishop_content",
	"IBLOCK_ID" => "41",
	"HIDE_NOT_AVAILABLE" => "N",
	"SECTION_ID_VARIABLE" => "SECTION_ID",
	"SEF_MODE" => "Y",
	"SEF_FOLDER" => "/info/gallery/",
	"AJAX_MODE" => "N",
	"AJAX_OPTION_JUMP" => "N",
	"AJAX_OPTION_STYLE" => "Y",
	"AJAX_OPTION_HISTORY" => "N",
	"CACHE_TYPE" => "N",
	"CACHE_TIME" => "36000000",
	"CACHE_FILTER" => "N",
	"CACHE_GROUPS" => "N",
	"SET_STATUS_404" => "N",
	"SET_TITLE" => "Y",
	"ADD_SECTIONS_CHAIN" => "Y",
	"ADD_ELEMENT_CHAIN" => "Y",
	"USE_ELEMENT_COUNTER" => "N",
	"USE_FILTER" => "N",
	"USE_REVIEW" => "N",
	"USE_COMPARE" => "N",
	"PRICE_CODE" => array(
	),
	"USE_PRICE_COUNT" => "N",
	"SHOW_PRICE_COUNT" => "1",
	"PRICE_VAT_INCLUDE" => "Y",
	"PRICE_VAT_SHOW_VALUE" => "N",
	"CONVERT_CURRENCY" => "N",
	"BASKET_URL" => "/personal/basket.php",
	"ACTION_VARIABLE" => "action",
	"PRODUCT_ID_VARIABLE" => "id",
	"USE_PRODUCT_QUANTITY" => "N",
	"ADD_PROPERTIES_TO_BASKET" => "N",
	"SHOW_TOP_ELEMENTS" => "N",
	"SECTION_COUNT_ELEMENTS" => "Y",
	"SECTION_TOP_DEPTH" => "2",
	"PAGE_ELEMENT_COUNT" => "100000",
	"LINE_ELEMENT_COUNT" => "1",
	"ELEMENT_SORT_FIELD" => "sort",
	"ELEMENT_SORT_ORDER" => "asc",
	"ELEMENT_SORT_FIELD2" => "id",
	"ELEMENT_SORT_ORDER2" => "desc",
	"LIST_PROPERTY_CODE" => array(
		0 => "ASSOCIATED",
		1 => "TITLE_ASSOCIATED",
		2 => "MORE_PHOTO",
		3 => "",
	),
	"INCLUDE_SUBSECTIONS" => "Y",
	"LIST_META_KEYWORDS" => "-",
	"LIST_META_DESCRIPTION" => "-",
	"LIST_BROWSER_TITLE" => "-",
	"SHOW_QUANTITY_SORT" => "N",
	"DEFAULT_LIST_TEMPLATE" => "list",
	"DETAIL_PROPERTY_CODE" => array(
		0 => "ASSOCIATED",
		1 => "TITLE_ASSOCIATED",
		2 => "USED_INTO",
		3 => "MORE_PHOTO",
		4 => "",
	),
	"DETAIL_META_KEYWORDS" => "-",
	"DETAIL_META_DESCRIPTION" => "-",
	"DETAIL_BROWSER_TITLE" => "-",
	"SKU_DISPLAY_LOCATION" => "RIGHT",
	"SKU_SHOW_PICTURES" => "N",
	"PROPERTIES_DISPLAY_LOCATION" => "DESCRIPTION",
	"PROPERTIES_DISPLAY_TYPE" => "BLOCK",
	"SHOW_BRAND_PICTURE" => "Y",
	"SHOW_FOUND_CHEAPER" => "Y",
	"SHOW_ASK_BLOCK" => "Y",
	"ASK_FORM_ID" => "",
	"USE_ONE_CLICK_BUY" => "Y",
	"SHOW_KIT_PARTS" => "N",
	"SHOW_KIT_PARTS_PRICES" => "N",
	"LINK_IBLOCK_TYPE" => "aspro_ishop_catalog",
	"LINK_IBLOCK_ID" => "40",
	"LINK_PROPERTY_SID" => "ASSOCIATED",
	"LINK_ELEMENTS_URL" => "link.php?PARENT_ELEMENT_ID=#ELEMENT_ID#",
	"USE_ALSO_BUY" => "N",
	"USE_STORE" => "N",
	"PAGER_TEMPLATE" => ".default",
	"DISPLAY_TOP_PAGER" => "N",
	"DISPLAY_BOTTOM_PAGER" => "N",
	"PAGER_TITLE" => "Товары",
	"PAGER_SHOW_ALWAYS" => "N",
	"PAGER_DESC_NUMBERING" => "N",
	"PAGER_DESC_NUMBERING_CACHE_TIME" => "36000",
	"PAGER_SHOW_ALL" => "N",
	"IBLOCK_STOCK_ID" => "",
	"SEF_MODE_STOCK_SECTIONS" => "",
	"SEF_MODE_STOCK_ELEMENT" => "#ELEMENT_CODE#/",
	"IBLOCK_ADVT_TYPE" => "",
	"IBLOCK_ADVT_ID" => "",
	"IBLOCK_ADVT_SECTION_ID" => "",
	"IBLOCK_ADVT_SECTION_ID_SECT" => "",
	"SEF_MODE_BRAND_SECTIONS" => "",
	"SEF_MODE_BRAND_ELEMENT" => "#ELEMENT_CODE#/",
	"SHOW_QUANTITY" => "Y",
	"SHOW_MEASURE" => "N",
	"SHOW_QUANTITY_COUNT" => "Y",
	"AJAX_OPTION_ADDITIONAL" => "",
	"PRODUCT_QUANTITY_VARIABLE" => "quantity",
	"PRODUCT_PROPS_VARIABLE" => "prop",
	"PARTIAL_PRODUCT_PROPERTIES" => "N",
	"PRODUCT_PROPERTIES" => array(
	),
	"SEF_URL_TEMPLATES" => array(
		"sections" => "",
		"section" => "#SECTION_CODE_PATH#/",
		"element" => "#SECTION_CODE_PATH#/#ELEMENT_CODE#/",
		"compare" => "compare.php?action=#ACTION_CODE#",
	),
	"VARIABLE_ALIASES" => array(
		"compare" => array(
			"ACTION_CODE" => "action",
		),
	)
	),
	false
);?>
<!--</div>
 
<div></div>-->
 <?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>