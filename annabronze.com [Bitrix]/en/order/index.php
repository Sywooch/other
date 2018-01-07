<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("Checkout");
?>

<?$APPLICATION->IncludeComponent("bitrix:sale.order.ajax", "shop_visual", array(// .default
    "PAY_FROM_ACCOUNT" => "N",
    "ONLY_FULL_PAY_FROM_ACCOUNT" => "N",
    "COUNT_DELIVERY_TAX" => "Y",
    "ALLOW_AUTO_REGISTER" => "N",
    "SEND_NEW_USER_NOTIFY" => "N",
    "DELIVERY_NO_AJAX" => "Y",
    "DELIVERY_NO_SESSION" => "N",
    "TEMPLATE_LOCATION" => "shop",
    "DELIVERY_TO_PAYSYSTEM" => "d2p",
    "USE_PREPAYMENT" => "N",
    "PROP_1" => array(
    ),
    "PROP_5" => array(
    ),
    "PROP_2" => array(
    ),
    "PROP_6" => array(
    ),
    "ALLOW_NEW_PROFILE" => "Y",
    "SHOW_PAYMENT_SERVICES_NAMES" => "Y",
    "SHOW_STORES_IMAGES" => "N",
    "PATH_TO_BASKET" => "/basket/",
    "PATH_TO_PERSONAL" => "/personal/",
    "PATH_TO_PAYMENT" => "payment.php",
    "PATH_TO_AUTH" => "/auth/",
    "SET_TITLE" => "Y",
    "PRODUCT_COLUMNS" => array(
    ),
    "DISABLE_BASKET_REDIRECT" => "N"
),
    false
);?>

<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>