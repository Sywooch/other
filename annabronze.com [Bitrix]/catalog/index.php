<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetPageProperty("keywords", "фурнитура, фурнитура для украшений, фурнитура для бижутерии, подвеска, тоггл, замок, колпачки для бусин, шапочки для бусин, бусины");
$APPLICATION->SetPageProperty("description", "Авторская фурнитура Anna Bronze");
$APPLICATION->SetTitle("Каталог фурнитуры Anna Bronze");
?>
<?$APPLICATION->IncludeComponent("bitrix:catalog", "shop", array(
    "IBLOCK_TYPE" => "catalog",
    "IBLOCK_ID" => "40",
    "HIDE_NOT_AVAILABLE" => "N",
    "SECTION_ID_VARIABLE" => "SECTION_ID",
    "SEF_MODE" => "Y",
    "SEF_FOLDER" => "/catalog/",
    "AJAX_MODE" => "N",
    "AJAX_OPTION_JUMP" => "N",
    "AJAX_OPTION_STYLE" => "Y",
    "AJAX_OPTION_HISTORY" => "N",
    "CACHE_TYPE" => "A",
    "CACHE_TIME" => "250000",
    "CACHE_FILTER" => "N",
    "CACHE_GROUPS" => "N",
    "SET_STATUS_404" => "Y",
    "SET_TITLE" => "N",
    "ADD_SECTIONS_CHAIN" => "Y",
    "ADD_ELEMENT_CHAIN" => "N",
    "USE_ELEMENT_COUNTER" => "Y",
    "USE_FILTER" => "Y",
    "FILTER_NAME" => "arrFilter",
    "FILTER_FIELD_CODE" => array(
        0 => "",
        1 => "",
    ),
    "FILTER_PROPERTY_CODE" => array(
        0 => "HIT",
        1 => "RECOMMEND",
        2 => "NEW",
        3 => "",
        4 => "PROP_163",
        5 => "PROP_246",
        6 => "PROP_2075",
        7 => "PROP_2070",
        8 => "PROP_2078",
        9 => "PROP_2079",
        10 => "PROP_2000",
        11 => "PROP_2050",
        12 => "PROP_2080",
        13 => "PROP_2034",
        14 => "PROP_2084",
        15 => "PROP_2012",
        16 => "PROP_2066",
        17 => "PROP_2063",
        18 => "PROP_2074",
        19 => "PROP_2016",
        20 => "PROP_2076",
        21 => "",
    ),
    "FILTER_PRICE_CODE" => array(
        0 => "BASE",
    ),
    "USE_REVIEW" => "Y",
    "USE_COMPARE" => "N",
    "PRICE_CODE" => array(
        0 => "BASE",
    ),
    "MESSAGES_PER_PAGE" => "100",
    "USE_CAPTCHA" => "N",
    "REVIEW_AJAX_POST" => "Y",
    "PATH_TO_SMILE" => "/bitrix/images/forum/smile/",
    "FORUM_ID" => "1",
    "URL_TEMPLATES_READ" => "",
    "SHOW_LINK_TO_FORUM" => "Y",
    "POST_FIRST_MESSAGE" => "N",
    
    "USE_PRICE_COUNT" => "N",
    "SHOW_PRICE_COUNT" => "1",
    "PRICE_VAT_INCLUDE" => "Y",
    "PRICE_VAT_SHOW_VALUE" => "N",
    "CONVERT_CURRENCY" => "N",
    "BASKET_URL" => "/basket/",
    "ACTION_VARIABLE" => "action",
    "PRODUCT_ID_VARIABLE" => "id",
    "USE_PRODUCT_QUANTITY" => "Y",
    "PRODUCT_QUANTITY_VARIABLE" => "quantity",
    "ADD_PROPERTIES_TO_BASKET" => "Y",
    "PRODUCT_PROPS_VARIABLE" => "prop",
    "PARTIAL_PRODUCT_PROPERTIES" => "N",
    "PRODUCT_PROPERTIES" => array(
    ),
    "SHOW_TOP_ELEMENTS" => "N",
    "SECTION_COUNT_ELEMENTS" => "N",
    "SECTION_TOP_DEPTH" => "2",
    "PAGE_ELEMENT_COUNT" => "40",
    "LINE_ELEMENT_COUNT" => "3",
    "ELEMENT_SORT_FIELD" => "sort",
    "ELEMENT_SORT_ORDER" => "asc",
    "ELEMENT_SORT_FIELD2" => "id",
    "ELEMENT_SORT_ORDER2" => "desc",
    "LIST_PROPERTY_CODE" => array(
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
    "INCLUDE_SUBSECTIONS" => "Y",
    "LIST_META_KEYWORDS" => "-",
    "LIST_META_DESCRIPTION" => "-",
    "LIST_BROWSER_TITLE" => "-",
    "SHOW_QUANTITY_SORT" => "N",
    "DEFAULT_LIST_TEMPLATE" => "list",
    "DETAIL_PROPERTY_CODE" => array(
        0 => "PROP_2033",
        1 => "CML2_ARTICLE",
        2 => "PROP_2055",
        3 => "HIT",
        4 => "RECOMMEND",
        5 => "NEW",
        6 => "STOCK",
        7 => "",
        8 => "PROP_2086",
        9 => "PROP_2083",
        10 => "PROP_2065",
        11 => "PROP_2071",
        12 => "PROP_157",
        13 => "PROP_158",
        14 => "PROP_159",
        15 => "PROP_248",
        16 => "PROP_244",
        17 => "PROP_181",
        18 => "PROP_206",
        19 => "PROP_162",
        20 => "PROP_209",
        21 => "PROP_198",
        22 => "PROP_2085",
        23 => "PROP_2052",
        24 => "PROP_2069",
        25 => "PROP_2057",
        26 => "PROP_2004",
        27 => "PROP_2082",
        28 => "PROP_2027",
        29 => "PROP_2053",
        30 => "PROP_2051",
        31 => "PROP_2077",
        32 => "PROP_2049",
        33 => "PROP_2028",
        34 => "PROP_2035",
        35 => "PROP_2029",
        36 => "PROP_2064",
        37 => "PROP_2013",
        38 => "PROP_2008",
        39 => "PROP_2015",
        40 => "PROP_2014",
        41 => "PROP_2026",
        42 => "PROP_2044",
        43 => "PROP_2081",
        44 => "PROP_2006",
        45 => "PROP_2073",
        46 => "PROP_2011",
        47 => "PROP_2002",
        48 => "PROP_2062",
        49 => "PROP_2003",
        50 => "PROP_2054",
        51 => "PROP_2047",
        52 => "PROP_2043",
        53 => "PROP_2058",
        54 => "PROP_2045",
        55 => "PROP_2048",
        56 => "PROP_2072",
        57 => "PROP_2010",
        58 => "PROP_2009",
        59 => "PROP_2017",
        60 => "PROP_2061",
        61 => "PROP_2059",
        62 => "PROP_2007",
        63 => "PROP_2056",
        64 => "PROP_2046",
        65 => "PROP_2005",
        66 => "PROP_2060",
        67 => "PROP_2001",
        68 => "PROP_163",
        69 => "PROP_246",
        70 => "PROP_2075",
        71 => "PROP_2070",
        72 => "PROP_2078",
        73 => "PROP_2079",
        74 => "PROP_2000",
        75 => "PROP_2050",
        76 => "PROP_2080",
        77 => "PROP_2034",
        78 => "PROP_2084",
        79 => "PROP_2012",
        80 => "PROP_2066",
        81 => "PROP_2063",
        82 => "PROP_2074",
        83 => "PROP_2016",
        84 => "PROP_2076",
        85 => "",
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
    //"LINK_IBLOCK_TYPE" => "",
    //"LINK_IBLOCK_ID" => "",
    //"LINK_PROPERTY_SID" => "",
    //"LINK_ELEMENTS_URL" => "link.php?PARENT_ELEMENT_ID=#ELEMENT_ID#",

    //"LINK_IBLOCK_TYPE" => "aspro_ishop_catalog",
    //"LINK_IBLOCK_ID" => "40",
    //"LINK_PROPERTY_SID" => "ASSOCIATED",
    //"LINK_ELEMENTS_URL" => "link.php?PARENT_ELEMENT_ID=#ELEMENT_ID#",

    "LINK_IBLOCK_TYPE" => "aspro_ishop_content",
    "LINK_IBLOCK_ID" => "41",
    "LINK_PROPERTY_SID" => "ASSOCIATED",
    "LINK_ELEMENTS_URL" => "link.php?PARENT_ELEMENT_ID=#ELEMENT_ID#",


    "USE_ALSO_BUY" => "N",
    "USE_STORE" => "N",
    "PAGER_TEMPLATE" => "shop",
    "DISPLAY_TOP_PAGER" => "N",
    "DISPLAY_BOTTOM_PAGER" => "Y",
    "PAGER_TITLE" => "Товары",
    "PAGER_SHOW_ALWAYS" => "N",
    "PAGER_DESC_NUMBERING" => "N",
    "PAGER_DESC_NUMBERING_CACHE_TIME" => "36000",
    "PAGER_SHOW_ALL" => "N",
    "IBLOCK_STOCK_ID" => "23",
    "SEF_MODE_STOCK_SECTIONS" => "/sale/",
    "SEF_MODE_STOCK_ELEMENT" => "#ELEMENT_CODE#/",
    "IBLOCK_ADVT_TYPE" => "content",
    "IBLOCK_ADVT_ID" => "37",
    "IBLOCK_ADVT_SECTION_ID" => "205",
    "IBLOCK_ADVT_SECTION_ID_SECT" => "205",
    "SEF_MODE_BRAND_SECTIONS" => "/info/brand/",
    "SEF_MODE_BRAND_ELEMENT" => "#ELEMENT_CODE#/",
    "SHOW_QUANTITY" => "Y",
    "SHOW_MEASURE" => "N",
    "SHOW_QUANTITY_COUNT" => "Y",
    "AJAX_OPTION_ADDITIONAL" => "",
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
<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>