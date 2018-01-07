<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetPageProperty("keywords", "фурнитура, фурнитура для украшений, фурнитура для бижутерии, подвеска, тоггл, замок, колпачки для бусин, шапочки для бусин, бусины");
$APPLICATION->SetPageProperty("description", "Авторская фурнитура Anna Bronze");

$APPLICATION->SetTitle("Виды фурнитуры");

?>



<?
CModule::IncludeModule("iblock");
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

    $color_number="";
    if(isset($_GET["color"])){ $color_number=$_GET["color"]; }
    ?>

    <div class="b-catalog-section">

    <?$APPLICATION->IncludeComponent("bitrix:catalog.smart.filter", "shop", array(
        "IBLOCK_TYPE" => "catalog",
        "IBLOCK_ID" => "40",
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



    <? $APPLICATION->IncludeComponent(
        "ad_shop:catalog.section",
        "shop_list",
        Array(
            "SEF_URL_TEMPLATES" => Array
            ("sections" => "",
             "section" => "#SECTION_CODE_PATH#/",
             "element" => "#SECTION_CODE_PATH#/#ELEMENT_CODE#/",
            "compare" => "compare.php?action=#ACTION_CODE#"
        ),
            "IBLOCK_TYPE" => "catalog",
            "IBLOCK_ID" => "40",
            "HIDE_NOT_AVAILABLE" => "N",
            "SECTION_ID" => "",
            "SECTION_CODE" => "",
            "ELEMENT_SORT_FIELD" => $sort,
            "ELEMENT_SORT_ORDER" => $sort_order,
            "FILTER_NAME" => "arrFilter",
            "INCLUDE_SUBSECTIONS" => "Y",
            "PAGE_ELEMENT_COUNT" => "20",
            "SHOW_ALL_WO_SECTION" => "Y",
            "LINE_ELEMENT_COUNT" => "3",
            "PROPERTY_CODE" => array(
                0 => "PROP_2033",
                1 => "CML2_ARTICLE",
                2 => "PROP_2055",
                3 => "",
                4 => "PROP_2086",
                5 => "PROP_2083",
                6 => "PROP_2065",
                7 => "PROP_2071",
                8 => "PROP_157",
                9 => "PROP_158",
                10 => "PROP_159",
                11 => "PROP_248",
                12 => "PROP_244",
                13 => "PROP_181",
                14 => "PROP_206",
                15 => "PROP_162",
                16 => "PROP_209",
                17 => "PROP_198",
                18 => "PROP_2085",
                19 => "PROP_2052",
                20 => "PROP_2069",
                21 => "PROP_2057",
                22 => "PROP_2004",
                23 => "PROP_2082",
                24 => "PROP_2027",
                25 => "PROP_2053",
                26 => "PROP_2051",
                27 => "PROP_2077",
                28 => "PROP_2049",
                29 => "PROP_2028",
                30 => "PROP_2035",
                31 => "PROP_2029",
                32 => "PROP_2064",
                33 => "PROP_2013",
                34 => "PROP_2008",
                35 => "PROP_2015",
                36 => "PROP_2014",
                37 => "PROP_2026",
                38 => "PROP_2044",
                39 => "PROP_2081",
                40 => "PROP_2006",
                41 => "PROP_2073",
                42 => "PROP_2011",
                43 => "PROP_2002",
                44 => "PROP_2062",
                45 => "PROP_2003",
                46 => "PROP_2054",
                47 => "PROP_2047",
                48 => "PROP_2043",
                49 => "PROP_2058",
                50 => "PROP_2045",
                51 => "PROP_2048",
                52 => "PROP_2072",
                53 => "PROP_2010",
                54 => "PROP_2009",
                55 => "PROP_2017",
                56 => "PROP_2061",
                57 => "PROP_2059",
                58 => "PROP_2007",
                59 => "PROP_2056",
                60 => "PROP_2046",
                61 => "PROP_2005",
                62 => "PROP_2060",
                63 => "PROP_2001",
                64 => "PROP_163",
                65 => "PROP_246",
                66 => "PROP_2075",
                67 => "PROP_2070",
                68 => "PROP_2078",
                69 => "PROP_2079",
                70 => "PROP_2000",
                71 => "PROP_2050",
                72 => "PROP_2080",
                73 => "PROP_2034",
                74 => "PROP_2084",
                75 => "PROP_2012",
                76 => "PROP_2066",
                77 => "PROP_2063",
                78 => "PROP_2074",
                79 => "PROP_2016",
                80 => "PROP_2076",
                81 => "",
            ),
            "OFFERS_FIELD_CODE" => array(),
            "OFFERS_PROPERTY_CODE" => array(),
            "OFFERS_SORT_FIELD" => "",
            "OFFERS_SORT_ORDER" => "",
            "SECTION_URL" => "",
            "DETAIL_URL" => "",
            "BASKET_URL" => "",
            "ACTION_VARIABLE" => "action",
            "PRODUCT_ID_VARIABLE" => "id",
            "PRODUCT_QUANTITY_VARIABLE" => "quantity",
            "PRODUCT_PROPS_VARIABLE" => "prop",
            "SECTION_ID_VARIABLE" => "SECTION_ID",
            "AJAX_MODE" => "N",
            "AJAX_OPTION_JUMP" => "N",
            "AJAX_OPTION_STYLE" => "Y",
            "AJAX_OPTION_HISTORY" => "N",
            "CACHE_TYPE" => "A",
            "CACHE_TIME" => "36000",
            "CACHE_GROUPS" => "N",
            "META_KEYWORDS" => "",
            "META_DESCRIPTION" => "",
            "BROWSER_TITLE" => "",
            "ADD_SECTIONS_CHAIN" => "N",
            "DISPLAY_COMPARE" => "N",
            "SET_TITLE" => "N",
            "SET_STATUS_404" => "N",
            "CACHE_FILTER" => "N",
            "PRICE_CODE" => "",
            "USE_PRICE_COUNT" => "N",
            "SHOW_PRICE_COUNT" => "1",
            "PRICE_VAT_INCLUDE" => "Y",
            "USE_PRODUCT_QUANTITY" => "Y",
            "OFFERS_CART_PROPERTIES" => array(),
            "DISPLAY_TOP_PAGER" => "N",
            "DISPLAY_BOTTOM_PAGER" => "Y",
            "PAGER_TITLE" => "Товары",
            "PAGER_SHOW_ALWAYS" => "N",
            "PAGER_TEMPLATE" => "shop",
            "PAGER_DESC_NUMBERING" => "N",
            "PAGER_DESC_NUMBERING_CACHE_TIME" => "36000",
            "PAGER_SHOW_ALL" => "N",
            "AJAX_OPTION_ADDITIONAL" => "",
            "ADD_CHAIN_ITEM" => "Y",
            "SHOW_QUANTITY" => "Y",
            "CONVERT_CURRENCY" => "N",
            "CURRENCY_ID" => "",
            "SHOW_MEASURE" => "N",
            "SHOW_QUANTITY_COUNT" => "Y",
            "COLOR_FILTER_COLOR_NUMBER" => $color_number
        ),
        $component
    ); ?>



<?=$APPLICATION->AddChainItem("Виды фурнитуры");
    $APPLICATION->SetTitle("Виды фурнитуры");
?>



 <?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>