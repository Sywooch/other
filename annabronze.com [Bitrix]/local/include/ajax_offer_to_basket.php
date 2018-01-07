<?php
/**
 * Created by PhpStorm.
 * User: GSU
 * Date: 01.12.2016
 * Time: 14:18
 */

$DOCUMENT_ROOT = $_SERVER["DOCUMENT_ROOT"];
define("NO_KEEP_STATISTIC", true);
define("NOT_CHECK_PERMISSIONS", true);
set_time_limit(0);
//define("LANG", "ru");
include($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/prolog_before.php");

global $APPLICATION;
CModule::IncludeModule('iblock');
CModule::IncludeModule('main');
CModule::IncludeModule("sale");
CModule::IncludeModule("catalog");

$offerId=$_POST["offerId"];
$offerCount=$_POST["offerCount"];


//кидаем торговое предложение в корзину
Add2BasketByProductID(
    $offerId,
    $offerCount,
    array(),
    array()
);

$result["mess"]="Добавлено";


CSaleBasket::UpdateBasketPrices(CSaleBasket::GetBasketUserID(), SITE_ID);

$bShowReady = False;
$bShowDelay = False;
$bShowSubscribe = False;
$bShowNotAvail = False;
$allSum = 0;
$allWeight = 0;
$allCurrency = CSaleLang::GetLangCurrency(SITE_ID);
$allVATSum = 0;

$arResult["ITEMS"]["AnDelCanBuy"] = Array();
$arResult["ITEMS"]["DelDelCanBuy"] = Array();
$arResult["ITEMS"]["nAnCanBuy"] = Array();
$arResult["ITEMS"]["ProdSubscribe"] = Array();
$DISCOUNT_PRICE_ALL = 0;

$arBasketItems = array();
$dbBasketItems = CSaleBasket::GetList(
    array(
        "NAME" => "ASC",
        "ID" => "ASC"
    ),
    array(
        "FUSER_ID" => CSaleBasket::GetBasketUserID(),
        "LID" => SITE_ID,
        "ORDER_ID" => "NULL"
    ),
    false,
    false,
    array("ID", "NAME", "CALLBACK_FUNC", "MODULE", "PRODUCT_ID", "QUANTITY", "DELAY", "CAN_BUY", "PRICE", "WEIGHT", "DETAIL_PAGE_URL", "NOTES", "CURRENCY", "VAT_RATE", "CATALOG_XML_ID", "PRODUCT_XML_ID", "SUBSCRIBE", "DISCOUNT_PRICE", "PRODUCT_PROVIDER_CLASS")
);

$arItemsIDsForPhoto = array();
$arItemsInBasketIDs = array();



while ($arItems = $dbBasketItems->GetNext())
{
    $arItemsIDsForPhoto[] = $arItems["PRODUCT_ID"];
    $arItemsInBasketIDs[$arItems["PRODUCT_ID"]][] =  $arItems["ID"];

    $arItems['QUANTITY'] = $arParams['QUANTITY_FLOAT'] == 'Y' ? number_format(DoubleVal($arItems['QUANTITY']), 2, '.', '') : IntVal($arItems['QUANTITY']);



    $arItems["PRICE_VAT_VALUE"] = (($arItems["PRICE"] / ($arItems["VAT_RATE"] +1)) * $arItems["VAT_RATE"]);
    $arItems["PRICE_FORMATED"] = SaleFormatCurrency($arItems["PRICE"], $arItems["CURRENCY"]);

    if ($arItems["DELAY"] == "N" && $arItems["CAN_BUY"] == "Y")
    {
        $allSum += ($arItems["PRICE"] * $arItems["QUANTITY"]);
        $allWeight += ($arItems["WEIGHT"] * $arItems["QUANTITY"]);
        $allVATSum += roundEx($arItems["PRICE_VAT_VALUE"] * $arItems["QUANTITY"], SALE_VALUE_PRECISION);
    }

    if ($arItems["DELAY"] == "N" && $arItems["CAN_BUY"] == "Y")
    {
        $bShowReady = True;
        if(DoubleVal($arItems["DISCOUNT_PRICE"]) > 0)
        {
            $arItems["DISCOUNT_PRICE_PERCENT"] = $arItems["DISCOUNT_PRICE"]*100 / ($arItems["DISCOUNT_PRICE"] + $arItems["PRICE"]);
            $arItems["DISCOUNT_PRICE_PERCENT_FORMATED"] = roundEx($arItems["DISCOUNT_PRICE_PERCENT"], SALE_VALUE_PRECISION)."%";
            $DISCOUNT_PRICE_ALL += $arItems["DISCOUNT_PRICE"] * $arItems["QUANTITY"];
            $arItems["FULL_PRICE"] = $arItems["DISCOUNT_PRICE"] + $arItems["PRICE"];
            $arItems["FULL_PRICE_FORMATED"] = SaleFormatCurrency($arItems["FULL_PRICE"], $arItems["CURRENCY"]);

        }
        $arResult["ITEMS"]["AnDelCanBuy"][] = $arItems;
    }
    elseif ($arItems["DELAY"] == "Y" && $arItems["CAN_BUY"] == "Y")
    {
        $bShowDelay = True;
        if(DoubleVal($arItems["DISCOUNT_PRICE"]) > 0)
        {
            $arItems["DISCOUNT_PRICE_PERCENT"] = $arItems["DISCOUNT_PRICE"]*100 / ($arItems["DISCOUNT_PRICE"] + $arItems["PRICE"]);
            $arItems["DISCOUNT_PRICE_PERCENT_FORMATED"] = roundEx($arItems["DISCOUNT_PRICE_PERCENT"], SALE_VALUE_PRECISION)."%";
            $DISCOUNT_PRICE_ALL += $arItems["DISCOUNT_PRICE"] * $arItems["QUANTITY"];
            $arItems["FULL_PRICE"] = $arItems["DISCOUNT_PRICE"] + $arItems["PRICE"];
            $arItems["FULL_PRICE_FORMATED"] = SaleFormatCurrency($arItems["FULL_PRICE"], $arItems["CURRENCY"]);
        }
        $arResult["ITEMS"]["DelDelCanBuy"][] = $arItems;
    }
    elseif ($arItems["CAN_BUY"] == "N" && $arItems["SUBSCRIBE"] == "Y")
    {
        $bShowSubscribe = True;
        if(DoubleVal($arItems["DISCOUNT_PRICE"]) > 0)
        {
            $arItems["DISCOUNT_PRICE_PERCENT"] = $arItems["DISCOUNT_PRICE"]*100 / ($arItems["DISCOUNT_PRICE"] + $arItems["PRICE"]);
            $arItems["DISCOUNT_PRICE_PERCENT_FORMATED"] = roundEx($arItems["DISCOUNT_PRICE_PERCENT"], SALE_VALUE_PRECISION)."%";
            $DISCOUNT_PRICE_ALL += $arItems["DISCOUNT_PRICE"] * $arItems["QUANTITY"];
            $arItems["FULL_PRICE"] = $arItems["DISCOUNT_PRICE"] + $arItems["PRICE"];
            $arItems["FULL_PRICE_FORMATED"] = SaleFormatCurrency($arItems["FULL_PRICE"], $arItems["CURRENCY"]);
        }
        $arResult["ITEMS"]["ProdSubscribe"][] = $arItems;
    }
    else
    {
        $bShowNotAvail = True;
        if(DoubleVal($arItems["DISCOUNT_PRICE"]) > 0)
        {
            $arItems["DISCOUNT_PRICE_PERCENT"] = $arItems["DISCOUNT_PRICE"]*100 / ($arItems["DISCOUNT_PRICE"] + $arItems["PRICE"]);
            $arItems["DISCOUNT_PRICE_PERCENT_FORMATED"] = roundEx($arItems["DISCOUNT_PRICE_PERCENT"], SALE_VALUE_PRECISION)."%";
            $DISCOUNT_PRICE_ALL += $arItems["DISCOUNT_PRICE"] * $arItems["QUANTITY"];
            $arItems["FULL_PRICE"] = $arItems["DISCOUNT_PRICE"] + $arItems["PRICE"];
            $arItems["FULL_PRICE_FORMATED"] = SaleFormatCurrency($arItems["FULL_PRICE"], $arItems["CURRENCY"]);
        }
        $arResult["ITEMS"]["nAnCanBuy"][] = $arItems;
    }

    $arBasketItems[] = $arItems;
}


$arResult["ShowReady"] = (($bShowReady)?"Y":"N");
$arResult["ShowDelay"] = (($bShowDelay)?"Y":"N");
$arResult["ShowNotAvail"] = (($bShowNotAvail)?"Y":"N");
$arResult["ShowSubscribe"] = (($bShowSubscribe)?"Y":"N");

$arOrder = array(
    'SITE_ID' => SITE_ID,
    'USER_ID' => $USER->GetID(),
    'ORDER_PRICE' => $allSum,
    'ORDER_WEIGHT' => $allWeight,
    'BASKET_ITEMS' => $arResult["ITEMS"]["AnDelCanBuy"]
);

$arOptions = array(
    'COUNT_DISCOUNT_4_ALL_QUANTITY' => "N",
);

$arErrors = array();

CSaleDiscount::DoProcessOrder($arOrder, $arOptions, $arErrors);


$allSum = 0;
$allWeight = 0;
$allVATSum = 0;

$DISCOUNT_PRICE_ALL = 0;
$productsQuantity = 0;

foreach ($arOrder['BASKET_ITEMS'] as &$arOneItem)
{
    $allSum += ($arOneItem["PRICE"] * $arOneItem["QUANTITY"]);
    $allWeight += ($arOneItem["WEIGHT"] * $arOneItem["QUANTITY"]);
    if (array_key_exists('VAT_VALUE', $arOneItem))
        $arOneItem["PRICE_VAT_VALUE"] = $arOneItem["VAT_VALUE"];
    $allVATSum += roundEx($arOneItem["PRICE_VAT_VALUE"] * $arOneItem["QUANTITY"], SALE_VALUE_PRECISION);
    $arOneItem["PRICE_FORMATED"] = SaleFormatCurrency($arOneItem["PRICE"], $arOneItem["CURRENCY"]);
    $arOneItem["DISCOUNT_PRICE_PERCENT"] = $arOneItem["DISCOUNT_PRICE"]*100 / ($arOneItem["DISCOUNT_PRICE"] + $arOneItem["PRICE"]);
    $arOneItem["DISCOUNT_PRICE_PERCENT_FORMATED"] = roundEx($arOneItem["DISCOUNT_PRICE_PERCENT"], SALE_VALUE_PRECISION)."%";
    $arOneItem["FULL_PRICE"] = $arOneItem["DISCOUNT_PRICE"] + $arOneItem["PRICE"];
    $arOneItem["FULL_PRICE_FORMATED"] = SaleFormatCurrency($arOneItem["FULL_PRICE"], $arOneItem["CURRENCY"]);
    $DISCOUNT_PRICE_ALL += $arOneItem["DISCOUNT_PRICE"] * $arOneItem["QUANTITY"];
    $productsQuantity += $arOneItem["QUANTITY"];

}
if (isset($arOneItem))
    unset($arOneItem);

$arResult["ITEMS"]["AnDelCanBuy"] = $arOrder['BASKET_ITEMS'];

$arResult["allSum"] = $allSum;
$arResult["allWeight"] = $allWeight;
$arResult["allWeight_FORMATED"] = roundEx(DoubleVal($allWeight/$arParams["WEIGHT_KOEF"]), SALE_VALUE_PRECISION)." ".$arParams["WEIGHT_UNIT"];
$arResult["allSum_FORMATED"] = SaleFormatCurrency($allSum, $allCurrency);
$arResult["DISCOUNT_PRICE_FORMATED"] = SaleFormatCurrency($arResult["DISCOUNT_PRICE"], $allCurrency);


    $arResult["allVATSum"] = $allVATSum;
    $arResult["allVATSum_FORMATED"] = SaleFormatCurrency($allVATSum, $allCurrency);
    $arResult["allNOVATSum_FORMATED"] = SaleFormatCurrency(DoubleVal($arResult["allSum"]-$allVATSum), $allCurrency);


$arResult["DISCOUNT_PRICE_ALL"] = $DISCOUNT_PRICE_ALL;
$arResult["DISCOUNT_PRICE_ALL_FORMATED"] = SaleFormatCurrency($DISCOUNT_PRICE_ALL, $allCurrency);


$result["cart_sum"]=$arResult["allSum_FORMATED"];

$result["cart_num"]=$productsQuantity;


echo json_encode($result);













include($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/epilog_after.php");