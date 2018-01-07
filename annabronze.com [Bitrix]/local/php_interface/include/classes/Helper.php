<?php
use Bitrix\Main\Application;
use Bitrix\Main\Web\Uri;
/**
 * Class Helper
 */
class Helper {
    const RU_VERSION = 'ru';
    const EN_VERSION = 'en';
    const DEFAULT_STORE_RU_XML_ID = 'KUNGUR';
    const DEFAULT_STORE_EN_XML_ID = 'NY';

    public static function getSiteVersionByIp() {
        $version = '';

        if(!self::isBot()) {
            //массив ISO кодов стран СНГ
            $CIS_Countries = ['RU', 'AZ', 'AM', 'BY', 'KZ', 'KG', 'MD', 'TJ', 'TM', 'UZ', 'UA'];
            $userInfo = self::getUserInfoByIp($_SERVER["REMOTE_ADDR"]);
            $isoCountry = $userInfo['country']['iso'];

            if($isoCountry) {
                if(in_array($isoCountry, $CIS_Countries)) {
                    $version = self::RU_VERSION;
                    self::setValueCustomerInCIS(true);
                } else {
                    $version = self::EN_VERSION;
                    self::setValueCustomerInCIS(false);
                }
            }
        }

        return $version;
    }

    public static function changeVersion($version) {
        //до лучших времён
        /*$request = Application::getInstance()->getContext()->getRequest();
        $uriString = $request->getRequestUri();
        $uri = new Uri($uriString);
        $uri->deleteParams(array("lang"));
        $redirect = $uri->getUri();
        */
        global $APPLICATION;
        $redirect = $APPLICATION->GetCurPageParam('', array("lang"));
        if($version != LANGUAGE_ID) {
            if($version == self::RU_VERSION) {
                $redirect = str_replace('en/', '', $redirect);
            } else if($version == self::EN_VERSION) {
                $redirect = '/en'.$redirect;
            }

            LocalRedirect($redirect);
        }
    }

    public static function getUserInfoByIp($ip) {
        $result = [];
        if($ip) {
            $ch = curl_init('http://api.sypexgeo.net/json/'.$ip);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
            curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 2);
            curl_setopt($ch, CURLOPT_TIMEOUT, 5);
            $data = curl_exec($ch);

            if (!curl_errno($ch)) {
                $result = json_decode($data, true);
            }
            curl_close($ch);
        }

        return $result;
    }

    public static function isBot() {
        $is_bot = preg_match(
            "~(Google|Yahoo|Rambler|Bot|Yandex|Spider|Snoopy|Crawler|Finder|Mail|curl)~i",
            $_SERVER['HTTP_USER_AGENT']
        );

        return $is_bot ? true: false;
    }

    public static function getCookieSiteVersion() {
        global $APPLICATION;
        return $APPLICATION->get_cookie("SITE_VERSION");
    }

    public static function getSiteVersion() {
        $siteVersion = self::getCookieSiteVersion();
        if($siteVersion != self::RU_VERSION && $siteVersion != self::EN_VERSION) {
            $siteVersion = LANGUAGE_ID;
        }
        return $siteVersion;
    }

    public static function setSiteVersion($version) {
        global $APPLICATION;
        if($version) {
            $APPLICATION->set_cookie("SITE_VERSION", $version);
        }
    }

    public static function getStore() {
        global $APPLICATION;
        $storeID = $_REQUEST['store'] ?: $APPLICATION->get_cookie("STORE_ID");
        return intval($storeID);
    }

    public static function getStoreDefault() {
        $siteLang = Helper::getSiteVersion();
        if($siteLang == self::RU_VERSION){
            $storeID = 0;
        } else {
            $storeID = self::getStore();
            if($storeID) {
                $obStore = CCatalogStore::GetList(array(), array("ID" => $storeID, 'ACTIVE'=>'Y'), false, false, array('ID'));
                if(!$arStore = $obStore->Fetch()){
                    $storeID = 0;
                }
            }
        }

        if(!$storeID){
            //достать склад по умолчанию

            $storeXMLid = ($siteLang == self::RU_VERSION) ? self::DEFAULT_STORE_RU_XML_ID : self::DEFAULT_STORE_EN_XML_ID;

            $obStore = CCatalogStore::GetList(array(), array("XML_ID" => $storeXMLid, 'ACTIVE'=>'Y'), false, false, array('ID'));
            if($arStore = $obStore->Fetch()){
                $storeID = $arStore["ID"];
            }
        }

        return intval($storeID);
    }

    public static function setStore($storeID) {
        global $APPLICATION;
        if(intval($storeID)) {
            $APPLICATION->set_cookie("STORE_ID", intval($storeID));
        }
    }

    public static function isCustomerInCIS() {
        global $APPLICATION;
        $value = $APPLICATION->get_cookie("IN_CIS");
        return (isset($value) && $value == true) ? true: false;
    }

    public static function setValueCustomerInCIS($value) {
        global $APPLICATION;
        if(isset($value)) {
            $APPLICATION->set_cookie("IN_CIS", $value);
        }
    }


    var $arBasketDiscountsRu=array();
    var $sum;
    var $discount;

    public static function getDiscountsDescription()
    {
        $arBasketDiscounts = [];

        CModule::IncludeModule("sale");


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

        global $USER;
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

                //echo "<pre style='text-align:left;'>";
                //print_r($discount);
                //echo "</pre>";

                $summ = $discount["CONDITIONS_LIST"]["CHILDREN"][0]["DATA"]["Value"];
                $discountSale = $discount["ACTIONS_LIST"]["CHILDREN"][0]["DATA"]["Value"];

                $arBasketDiscounts[$summ] = $discountSale."%";


            }


            ksort($arBasketDiscounts);

            unset($discount, $discountIterator);



        }

        
        return $arBasketDiscounts;

    }


    public static function getCatalogColors()
    {
        $arCatalogColors = [];

        CModule::IncludeModule('iblock');
        CModule::IncludeModule("catalog");

        if(SITE_ID == "s1"){
            $IBLOCK_ID = CATALOG_IBLOCK_OFFERS_ID_RU; // русскоязычная версия сайта
        }else{
            $IBLOCK_ID = CATALOG_IBLOCK_OFFERS_ID_EN; // англоязычная версия сайта
        }


        $res = CIBlock::GetProperties($IBLOCK_ID);
        while($res_arr = $res->Fetch()){
            

            if(LANGUAGE_ID==='en'){
                $color = BX_IBLOCK_OFFERS_PROPERTY_COLOR_EN;
            }else{
                $color = BX_IBLOCK_OFFERS_PROPERTY_COLOR_RU;
            }


            if($res_arr['CODE'] == $color){
                $property_enums = CIBlockPropertyEnum::GetList(Array("SORT"=>"ASC"),
                    Array("IBLOCK_ID"=>$IBLOCK_ID, "CODE"=>$color, "!SORT"=>"999" ));
                $i=1;
                while($enum_fields = $property_enums->GetNext())
                {

                    $arCatalogColors[$enum_fields["ID"]] = $i;

                    $i++;
                }
                break;
            }
        }

        return $arCatalogColors;
    }


    //есть ли товар в корзине ?
    public static function isProductBasket($productId)
    {

        CModule::IncludeModule('iblock');
        CModule::IncludeModule('main');
        CModule::IncludeModule("sale");
        CModule::IncludeModule("catalog");


        $arID = array();
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
            array("ID", "CALLBACK_FUNC", "MODULE", "PRODUCT_ID", "QUANTITY", "PRODUCT_PROVIDER_CLASS")
        );
        while ($arItems = $dbBasketItems->Fetch())
        {
            if ('' != $arItems['PRODUCT_PROVIDER_CLASS'] || '' != $arItems["CALLBACK_FUNC"])
            {
                CSaleBasket::UpdatePrice($arItems["ID"],
                    $arItems["CALLBACK_FUNC"],
                    $arItems["MODULE"],
                    $arItems["PRODUCT_ID"],
                    $arItems["QUANTITY"],
                    "N",
                    $arItems["PRODUCT_PROVIDER_CLASS"]
                );
                $arID[] = $arItems["ID"];
            }
        }

        $dbBasketItems = CSaleBasket::GetList(
            array(
                "NAME" => "ASC",
                "ID" => "ASC"
            ),
            array(
                "ID" => $arID,
                "ORDER_ID" => "NULL"
            ),
            false,
            false,
            array("ID", "CALLBACK_FUNC", "MODULE",
                "PRODUCT_ID", "QUANTITY", "DELAY",
                "CAN_BUY", "PRICE", "WEIGHT", "PRODUCT_PROVIDER_CLASS", "NAME")
        );
        $isBasket = "N";
        while ($arItems = $dbBasketItems->Fetch())
        {
            if($arItems["PRODUCT_ID"] == $productId){
                $isBasket = "Y";
            };

        }

        return $isBasket;

    }

    //количество товара в корзине
    public static function productQuantityBasket($productId)
    {

        CModule::IncludeModule('iblock');
        CModule::IncludeModule('main');
        CModule::IncludeModule("sale");
        CModule::IncludeModule("catalog");


        $arID = array();
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
            array("ID", "CALLBACK_FUNC", "MODULE", "PRODUCT_ID", "QUANTITY", "PRODUCT_PROVIDER_CLASS")
        );
        while ($arItems = $dbBasketItems->Fetch())
        {
            if ('' != $arItems['PRODUCT_PROVIDER_CLASS'] || '' != $arItems["CALLBACK_FUNC"])
            {
                CSaleBasket::UpdatePrice($arItems["ID"],
                    $arItems["CALLBACK_FUNC"],
                    $arItems["MODULE"],
                    $arItems["PRODUCT_ID"],
                    $arItems["QUANTITY"],
                    "N",
                    $arItems["PRODUCT_PROVIDER_CLASS"]
                );
                $arID[] = $arItems["ID"];
            }
        }

        $dbBasketItems = CSaleBasket::GetList(
            array(
                "NAME" => "ASC",
                "ID" => "ASC"
            ),
            array(
                "ID" => $arID,
                "ORDER_ID" => "NULL"
            ),
            false,
            false,
            array("ID", "CALLBACK_FUNC", "MODULE",
                "PRODUCT_ID", "QUANTITY", "DELAY",
                "CAN_BUY", "PRICE", "WEIGHT", "PRODUCT_PROVIDER_CLASS", "NAME")
        );
        $quantityInBasket = 0;
        while ($arItems = $dbBasketItems->Fetch())
        {
            if($arItems["PRODUCT_ID"] == $productId){
                $quantityInBasket = $arItems["QUANTITY"];
            };

        }

        return $quantityInBasket;

    }


    //вспомогательные функции для работы со скидками в корзине
    public static function getDiscountHandlers($discountList)
    {
        $result = array();
        if (!empty($discountList) && is_array($discountList))
        {
            $moduleList = \Bitrix\Sale\Internals\DiscountModuleTable::getByDiscount($discountList);
            if (!empty($moduleList))
            {
                foreach ($moduleList as $discount => $discountModule)
                {
                    $result[$discount] = array(
                        'MODULES' => $discountModule,
                        'EXT_FILES' => array()
                    );
                }
                unset($discount, $discountModule, $moduleList);
            }
        }
        return $result;
    }

    public static function __Unpack($arOrder, $strUnpack)
    {
        $checkOrder = null;
        if (empty($strUnpack))
            return false;
        eval('$checkOrder='.$strUnpack.';');
        if (!is_callable($checkOrder))
            return false;
        $boolRes = $checkOrder($arOrder);
        unset($checkOrder);
        return $boolRes;
    }


    public static function __ApplyActions(&$arOrder, $strActions)
    {
        $applyOrder = null;
        if (!empty($strActions))
        {
            eval('$applyOrder='.$strActions.';');
            if (is_callable($applyOrder))
                $applyOrder($arOrder);
        }
    }


    public static function getDiscountResult(&$oldOrder, &$currentOrder, $extMode = false)
    {
        $extMode = ($extMode === true);
        $result = array();
        if (isset($oldOrder['PRICE_DELIVERY']) && isset($currentOrder['PRICE_DELIVERY']))
        {
            if ($oldOrder['PRICE_DELIVERY'] != $currentOrder['PRICE_DELIVERY'])
            {
                $absValue = $oldOrder['PRICE_DELIVERY'] - $currentOrder['PRICE_DELIVERY'];
                $fullValue = ($extMode && isset($currentOrder['PRICE_DELIVERY_ORIG']) ? $currentOrder['PRICE_DELIVERY_ORIG'] : $oldOrder['PRICE_DELIVERY']);
                $percValue = ($fullValue != 0 ? $absValue*100/$fullValue : 0);
                $result['DELIVERY'] = array(
                    'TYPE' => 'D',
                    'DISCOUNT_TYPE' => ($currentOrder['PRICE_DELIVERY'] < $oldOrder['PRICE_DELIVERY'] ? 'D' : 'M'),
                    'VALUE' => $absValue,
                    'VALUE_PERCENT' => $percValue,
                    'DELIVERY_ID' => (isset($currentOrder['DELIVERY_ID']) ? $currentOrder['DELIVERY_ID'] : false)
                );
                unset($percValue, $fullValue, $absValue);
            }
        }
        if (!empty($oldOrder['BASKET_ITEMS']) && !empty($currentOrder['BASKET_ITEMS']))
        {
            foreach ($oldOrder['BASKET_ITEMS'] as $key => $item)
            {
                if (!isset($currentOrder['BASKET_ITEMS'][$key]))
                    continue;
                if ($item['PRICE'] != $currentOrder['BASKET_ITEMS'][$key]['PRICE'])
                {
                    $newItem = &$currentOrder['BASKET_ITEMS'][$key];
                    $absValue = $item['PRICE'] - $newItem['PRICE'];
                    $fullValue = ($extMode && isset($newItem['PRICE_ORIG']) ? $newItem['PRICE_ORIG'] : $item['PRICE']);
                    $percValue = ($fullValue != 0 ? $absValue*100/$fullValue : 0);
                    if (!isset($result['BASKET']))
                        $result['BASKET'] = array();
                    $result['BASKET'][] = array(
                        'TYPE' => 'B',
                        'DISCOUNT_TYPE' => ($newItem['PRICE'] < $item['PRICE'] ? 'D' : 'M'),
                        'VALUE' => $absValue,
                        'VALUE_PERCENT' => $percValue,
                        'BASKET_NUM' => $key,
                        'BASKET_ID' => (isset($newItem['ID']) ? $newItem['ID'] : '0'),
                        'BASKET_PRODUCT_XML_ID' => (isset($newItem['PRODUCT_XML_ID']) && $newItem['PRODUCT_XML_ID'] != '' ? $newItem['PRODUCT_XML_ID'] : false),
                        'PRODUCT_ID' => $newItem['PRODUCT_ID'],
                        'MODULE' => $newItem['MODULE']
                    );
                    unset($percValue, $fullValue, $absValue, $newItem);
                }
            }
        }
        return $result;
    }

    public static function sectionHasItems($sectionID, $iblockID = 0) {

        CModule::IncludeModule('iblock');

        $hasItems = false;

        $arFilter = array("SECTION_ID"=>$sectionID, '>PROPERTY_MINIMUM_PRICE' => 0, 'ACTIVE' => 'Y');
        if($iblockID) {
            $arFilter["IBLOCK_ID"] = $iblockID;
        }
        $rsElements = CIBlockElement::GetList(array(), $arFilter, false, false, ['ID', 'PROPERTY_MINIMUM_PRICE']);

        if($arItem = $rsElements->Fetch()) {
            $hasItems = true;
        }

        return $hasItems;
    }
}