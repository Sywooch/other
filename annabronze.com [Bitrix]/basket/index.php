<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("Корзина");
?>

<?CAjax::Init();?>
<?$APPLICATION->IncludeComponent("aspro:eshop.sale.basket.basket", "shop", array(//
    "COUNT_DISCOUNT_4_ALL_QUANTITY" => "N",
    "COLUMNS_LIST" => array(
        0 => "NAME",
        1 => "PROPS",
        2 => "PRICE",
        3 => "QUANTITY",
        4 => "DELETE",
        5 => "DELAY",
        6 => "DISCOUNT",
    ),
    "AJAX_MODE" => "Y",
    "AJAX_OPTION_JUMP" => "N",
    "AJAX_OPTION_STYLE" => "Y",
    "AJAX_OPTION_HISTORY" => "N",
    "PATH_TO_ORDER" => "/order/",
    "HIDE_COUPON" => "N",
    "QUANTITY_FLOAT" => "N",
    "PRICE_VAT_SHOW_VALUE" => "Y",
    "SET_TITLE" => "Y",
    "AJAX_OPTION_ADDITIONAL" => "",
    "SEF_URL_TEMPLATES" => array(
        "sections" => "",
        "section" => "#SECTION_CODE_PATH#/",
        "element" => "#SECTION_CODE_PATH#/#ELEMENT_CODE#/",
        "compare" => "compare.php?action=#ACTION_CODE#",
    ),
    "DETAIL_URL" => "#SECTION_CODE_PATH#/#ELEMENT_CODE#/" 
),
    false
);?>
<?/*$APPLICATION->IncludeComponent(
    "bitrix:sale.basket.basket",
    "",
    Array(
        "OFFERS_PROPS" => array(),
        "PATH_TO_ORDER" => "/order/",
        "HIDE_COUPON" => "N",
        "COLUMNS_LIST" => array("NAME", "DISCOUNT", "WEIGHT", "DELETE", "DELAY", "TYPE", "PRICE", "QUANTITY"),
        "PRICE_VAT_SHOW_VALUE" => "N",
        "COUNT_DISCOUNT_4_ALL_QUANTITY" => "N",
        "USE_PREPAYMENT" => "N",
        "QUANTITY_FLOAT" => "N",
        "SET_TITLE" => "Y",
        "ACTION_VARIABLE" => "action"
    ),
    false
);*/?>



<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>