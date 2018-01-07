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

//CSaleDiscount::DoProcessOrder($arOrder, $arOptions, $arErrors);


$allSum = 0;

foreach ($arOrder['BASKET_ITEMS'] as &$arOneItem)
{
    $allSum += ($arOneItem["PRICE"] * $arOneItem["QUANTITY"]);

}

$arResult["allSum"] = $allSum;

$sum = $arResult["allSum"];



///////////////////////////////////////
//достаём скидку активного правила работы с корзиной


/******************************/
$isOrderConverted = \Bitrix\Main\Config\Option::get("main", "~sale_converted_15", 'N');
$oldDelivery = '';

$checkIds = true;
$arIDS = array();
if ($isOrderConverted == 'Y')
{
    if (isset($arOrder['DELIVERY_ID']) && $arOrder['DELIVERY_ID'] != '')
    {
        $oldDelivery = $arOrder['DELIVERY_ID'];
        $arOrder['DELIVERY_ID'] = \CSaleDelivery::getIdByCode($arOrder['DELIVERY_ID']);
    }
    $adminSection = (defined('ADMIN_SECTION') && ADMIN_SECTION === true);
    if ($adminSection)
    {
        $mode = Sale\Compatible\DiscountCompatibility::MODE_MANAGER;
        $modeParams = array();
        if (isset($arOrder['CURRENCY']))
            $modeParams['CURRENCY'] = $arOrder['CURRENCY'];
        if (isset($arOrder['SITE_ID']))
        {
            $modeParams['SITE_ID'] = $arOrder['SITE_ID'];
            if (!isset($modeParams['CURRENCY']))
                $modeParams['CURRENCY'] = Sale\Internals\SiteCurrencyTable::getSiteCurrency($modeParams['SITE_ID']);
        }
    }
    else
    {
        $mode = \Bitrix\Sale\Compatible\DiscountCompatibility::MODE_CLIENT;
        $modeParams = array(
            'SITE_ID' => SITE_ID,
            'CURRENCY' => \Bitrix\Sale\Internals\SiteCurrencyTable::getSiteCurrency(SITE_ID)
        );

        $basketIdList = array();
        foreach ($arOrder['BASKET_ITEMS'] as $basketId => $basketItem)
        {
            if (!isset($basketItem['PRODUCT_PRICE_ID']) && isset($basketItem['ID']))
            {
                $basketIdList[$basketItem['ID']] = $basketId;
            }
        }
        unset($basketId, $basketItem);
        if (!empty($basketIdList))
        {
            $iterator = \Bitrix\Sale\Internals\BasketTable::getList(array(
                'select' => array('ID', 'PRODUCT_PRICE_ID'),
                'filter' => array('@ID' => array_keys($basketIdList))
            ));
            while ($row = $iterator->fetch())
            {
                if (!isset($basketIdList[$row['ID']]))
                    continue;
                $index = $basketIdList[$row['ID']];
                $arOrder['BASKET_ITEMS'][$index]['PRODUCT_PRICE_ID'] = $row['PRODUCT_PRICE_ID'];
                unset($index);
            }
            unset($row, $iterator);
        }
    }
    unset($adminSection);
    if (!empty($modeParams))
    {
        \Bitrix\Sale\Discount\Actions::setUseMode(
            \Bitrix\Sale\Discount\Actions::MODE_CALCULATE,
            array(
                'USE_BASE_PRICE' => \Bitrix\Main\Config\Option::get('sale', 'get_discount_percent_from_base_price'),
                'SITE_ID' => $modeParams['SITE_ID'],
                'CURRENCY' => $modeParams['CURRENCY']
            )
        );
    }
    if (!\Bitrix\Sale\Compatible\DiscountCompatibility::isInited())
    {
        if (!empty($modeParams))
            \Bitrix\Sale\Compatible\DiscountCompatibility::init($mode, $modeParams);
    }
    unset($modeParams, $mode);
    \Bitrix\Sale\Compatible\DiscountCompatibility::clearDiscountResult();
    \Bitrix\Sale\Compatible\DiscountCompatibility::fillBasketData($arOrder['BASKET_ITEMS']);
    \Bitrix\Sale\Compatible\DiscountCompatibility::calculateBasketDiscounts($arOrder['BASKET_ITEMS']);
    \Bitrix\Sale\Compatible\DiscountCompatibility::roundPrices($arOrder['BASKET_ITEMS']);
    \Bitrix\Sale\Compatible\DiscountCompatibility::setApplyMode($arOrder['BASKET_ITEMS']);

    $applyMode = \Bitrix\Sale\Discount::getApplyMode();
    if ($applyMode == \Bitrix\Sale\Discount::APPLY_MODE_FULL_LAST || $applyMode == \Bitrix\Sale\Discount::APPLY_MODE_FULL_DISABLE)
    {
        foreach ($arOrder['BASKET_ITEMS'] as &$basketItem)
        {
            if (isset($basketItem['LAST_DISCOUNT']) && $basketItem['LAST_DISCOUNT'] == 'Y')
            {
                $checkIds = false;
                break;
            }
        }
        unset($basketItem);
    }
}

if ($checkIds)
{
    $groupDiscountIterator = \Bitrix\Sale\Internals\DiscountGroupTable::getList(array(
        'select' => array('DISCOUNT_ID'),
        'filter' => array('@GROUP_ID' => CUser::GetUserGroup($arOrder['USER_ID']), '=ACTIVE' => 'Y')
    ));
    while ($groupDiscount = $groupDiscountIterator->fetch())
    {
        $groupDiscount['DISCOUNT_ID'] = (int)$groupDiscount['DISCOUNT_ID'];
        if ($groupDiscount['DISCOUNT_ID'] > 0)
            $arIDS[$groupDiscount['DISCOUNT_ID']] = true;
    }
}
if (!empty($arIDS))
{
    $arIDS = array_keys($arIDS);
    $couponList = \Bitrix\Sale\DiscountCouponsManager::getForApply(array('MODULE_ID' => 'sale', 'DISCOUNT_ID' => $arIDS), array(), true);

    //TODO: fix this condition
    $useProps = true;
    $iblockPropList = array();
    $entityList = \Bitrix\Sale\Internals\DiscountEntitiesTable::getByDiscount(
        $arIDS,
        array(
            '=MODULE_ID' => 'catalog',
            '=ENTITY' => 'ELEMENT_PROPERTY'
        )
    );
    if (empty($entityList))
    {
        $useProps = false;
    }
    else
    {
        if (empty($entityList['catalog']['ELEMENT_PROPERTY']))
        {
            $useProps = false;
        }
        else
        {
            foreach ($entityList['catalog']['ELEMENT_PROPERTY'] as $entity)
            {
                $entityField = explode(':', $entity['FIELD_TABLE']);
                if (isset($entityField[1]))
                {
                    $propId = (int)$entityField[1];
                    if ($propId > 0)
                        $iblockPropList[$propId] = $propId;
                    unset($propId);
                }
                unset($entityField);
            }
            unset($entity);
            if (empty($iblockPropList))
                $useProps = false;
        }
    }

    $arExtend = array(
        'catalog' => array(
            'fields' => true,
            'props' => $useProps,
        ),
    );
    if ($useProps)
        $arExtend['iblock']['props'] = $iblockPropList;
    unset($iblockPropList, $useProps);
    foreach (GetModuleEvents('sale', 'OnExtendBasketItems', true) as $arEvent)
        ExecuteModuleEventEx($arEvent, array(&$arOrder['BASKET_ITEMS'], $arExtend));

    foreach ($arOrder['BASKET_ITEMS'] as &$arOneItem)
    {
        if (
            array_key_exists('PRODUCT_PROVIDER_CLASS', $arOneItem) && empty($arOneItem['PRODUCT_PROVIDER_CLASS'])
            && array_key_exists('CALLBACK_FUNC', $arOneItem) && empty($arOneItem['CALLBACK_FUNC'])
            && (!isset($arOneItem['CUSTOM_PRICE']) || $arOneItem['CUSTOM_PRICE'] != 'Y')
        )
        {
            if (isset($arOneItem['DISCOUNT_PRICE']))
            {
                $arOneItem['PRICE'] += $arOneItem['DISCOUNT_PRICE'];
                $arOneItem['DISCOUNT_PRICE'] = 0;
                $arOneItem['BASE_PRICE'] = $arOneItem['PRICE'];
            }
        }
    }
    if (isset($arOneItem))
        unset($arOneItem);
    $cacheDiscountHandlers = array();
    $usedModules = array();

    if (empty($cacheDiscountHandlers))
    {
        $cacheDiscountHandlers = Helper::getDiscountHandlers($arIDS);
    }
    else
    {
        $needDiscountHandlers = array();
        foreach ($arIDS as &$discountID)
        {
            if (!isset($cacheDiscountHandlers[$discountID]))
                $needDiscountHandlers[] = $discountID;
        }
        unset($discountID);
        if (!empty($needDiscountHandlers))
        {
            $discountHandlersList = CSaleDiscount::getDiscountHandlers($needDiscountHandlers);
            if (!empty($discountHandlersList))
            {
                foreach ($discountHandlersList as $discountID => $discountHandlers)
                {
                    $cacheDiscountHandlers[$discountID] = $discountHandlers;
                }
                unset($discountHandlers, $discountID);
            }
            unset($discountHandlersList);
        }
        unset($needDiscountHandlers);
    }

    $currentDatetime = new Bitrix\Main\Type\DateTime();
    $discountSelect = array(
        'ID', 'PRIORITY', 'SORT', 'LAST_DISCOUNT', 'UNPACK', 'APPLICATION', 'USE_COUPONS', 'EXECUTE_MODULE',
        'NAME', 'CONDITIONS_LIST', 'ACTIONS_LIST'
    );
    $discountOrder = array('PRIORITY' => 'DESC', 'SORT' => 'ASC', 'ID' => 'ASC');
    $discountFilter = array(
        '@ID' => $arIDS,
        '=LID' => $arOrder['SITE_ID'],
        array(
            'LOGIC' => 'OR',
            'ACTIVE_FROM' => '',
            '<=ACTIVE_FROM' => $currentDatetime
        ),
        array(
            'LOGIC' => 'OR',
            'ACTIVE_TO' => '',
            '>=ACTIVE_TO' => $currentDatetime
        )
    );
    if (empty($couponList))
    {
        $discountFilter['=USE_COUPONS'] = 'N';
    }
    else
    {
        $discountFilter[] = array(
            'LOGIC' => 'OR',
            '=USE_COUPONS' => 'N',
            array(
                '=USE_COUPONS' => 'Y',
                '=COUPON.COUPON' => array_keys($couponList)
            )
        );
        $discountSelect['DISCOUNT_COUPON'] = 'COUPON.COUPON';
    }

    $discountIterator = \Bitrix\Sale\Internals\DiscountTable::getList(array(
        'select' => $discountSelect,
        'filter' => $discountFilter,
        'order' => $discountOrder
    ));
    $discountApply = array();
    $resultDiscountFullList = array();
    $resultDiscountList = array();
    $resultDiscountKeys = array();
    $resultDiscountIndex = 0;



    $discountSale = 0; //скидка правила работы с корзиной

    while ($discount = $discountIterator->fetch())
    {
        $discount['ID'] = (int)$discount['ID'];
        if (isset($discountApply[$discount['ID']]))
            continue;
        $discount['MODULE'] = 'sale';
        $discount['MODULE_ID'] = 'sale';
        if ($discount['USE_COUPONS'] == 'Y')
            $discount['COUPON'] = $couponList[$discount['DISCOUNT_COUPON']];
        $discountApply[$discount['ID']] = true;
        $applyFlag = true;
        if (isset($cacheDiscountHandlers[$discount['ID']]))
        {
            $moduleList = $cacheDiscountHandlers[$discount['ID']]['MODULES'];
            if (!empty($moduleList))
            {
                foreach ($moduleList as &$moduleID)
                {
                    if (!isset($usedModules[$moduleID]))
                    {
                        $usedModules[$moduleID] = Bitrix\Main\Loader::includeModule($moduleID);
                    }
                    if (!$usedModules[$moduleID])
                    {
                        $applyFlag = false;
                        break;
                    }
                }
                unset($moduleID);
                if ($applyFlag)
                    $discount['MODULES'] = $moduleList;
            }
            unset($moduleList);
        }
        if ($isOrderConverted == 'Y')
            Bitrix\Sale\Compatible\DiscountCompatibility::setOrderData($arOrder);
        if ($applyFlag && Helper::__Unpack($arOrder, $discount['UNPACK']))
        {
            $oldOrder = $arOrder;
            if ($isOrderConverted == 'Y')
                Bitrix\Sale\Discount\Actions::clearAction();

            Helper::__ApplyActions($arOrder, $discount['APPLICATION']);

            if ($isOrderConverted == 'Y') {

                if($discountSale == 0 && $discount["ACTIONS_LIST"]["CHILDREN"][0]["CLASS_ID"] == "ActSaleBsktGrp"
                    && $discount["ACTIONS_LIST"]["CHILDREN"][0]["DATA"]["Unit"] == "Perc"){
                    $discountSale = $discount["ACTIONS_LIST"]["CHILDREN"][0]["DATA"]["Value"];
                }


            }

        }
    }





    unset($discount, $discountIterator);



}


/******************************/



///////////////////////////////////////


//$current_discount = $DISCOUNT_PRICE_PERCENT_FORMATED;

$current_discount = $discountSale;


$last_discount = 0;

$arDiscounts = Helper::getDiscountsDescription();


foreach($arDiscounts as $k => $v){

    if($last_discount == $current_discount){
        $next_discount = $v;
        $next_sum = $k;
    }
    $last_discount = $v;
}

$sum = $next_sum - $sum;
$sum = SaleFormatCurrency($sum, $allCurrency);



$M["current_discount"]=$current_discount."%";
$M["next_discount"]=$next_discount;
$M["sum"]=$sum;

echo json_encode($M);




include($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/epilog_after.php");