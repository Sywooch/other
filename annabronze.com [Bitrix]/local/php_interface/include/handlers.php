<?
AddEventHandler("sale", "OnSaleComponentOrderOneStepProcess", "CashOnDelivery");

function CashOnDelivery(&$arResult, &$arUserResult)
{
    global $USER;
    //if ($USER->IsAdmin()) {
    if ($arResult["PAY_SYSTEM"][NALOZH_PAYSYSTEM_ID]["CHECKED"]) {
        $orderTotalSum = $arResult["ORDER_PRICE"] + $arResult["DELIVERY_PRICE"] + $arResult["TAX_PRICE"] - $arResult["DISCOUNT_PRICE"];
        $arResult["DELIVERY_PRICE"] += $arResult["PAY_SYSTEM"][NALOZH_PAYSYSTEM_ID]["PRICE"];
        $arResult["ORDER_TOTAL_PRICE"] = $orderTotalSum + $arResult["PAY_SYSTEM"][NALOZH_PAYSYSTEM_ID]["PRICE"];
        // $arResult["DISCOUNT_PRICE"] += $arResult["PAY_SYSTEM"][NALOZH_PAYSYSTEM_ID]["PRICE"];
        $arResult["DELIVERY_PRICE_FORMATED"] = SaleFormatCurrency($arResult["DELIVERY_PRICE"], $arResult["BASE_LANG_CURRENCY"]);
        $arResult["ORDER_TOTAL_PRICE_FORMATED"] = SaleFormatCurrency($arResult["ORDER_TOTAL_PRICE"], $arResult["BASE_LANG_CURRENCY"]);
    }
    // echo "<pre>";print_r($arResult); echo "</pre>";
    //}
}


AddEventHandler("iblock", "OnAfterIBlockElementUpdate", "DoIBlockAfterSave");
AddEventHandler("iblock", "OnAfterIBlockElementAdd", "DoIBlockAfterSave");
AddEventHandler("catalog", "OnPriceAdd", "DoIBlockAfterSave");
AddEventHandler("catalog", "OnPriceUpdate", "DoIBlockAfterSave");
AddEventHandler("main", "OnProlog", "OnPrologHandler");

function DoIBlockAfterSave($arg1, $arg2 = false)
{
    $ELEMENT_ID = false;
    $IBLOCK_ID = false;
    $OFFERS_IBLOCK_ID = false;
    $OFFERS_PROPERTY_ID = false;
    if (CModule::IncludeModule('currency'))
        $strDefaultCurrency = CCurrency::GetBaseCurrency();

    //Check for catalog event
    if (is_array($arg2) && $arg2["PRODUCT_ID"] > 0) {
        //Get iblock element
        $rsPriceElement = CIBlockElement::GetList(
            array(),
            array(
                "ID" => $arg2["PRODUCT_ID"],
            ),
            false,
            false,
            array("ID", "IBLOCK_ID")
        );
        if ($arPriceElement = $rsPriceElement->Fetch()) {
            $arCatalog = CCatalog::GetByID($arPriceElement["IBLOCK_ID"]);
            if (is_array($arCatalog)) {
                //Check if it is offers iblock
                if ($arCatalog["OFFERS"] == "Y") {
                    //Find product element
                    $rsElement = CIBlockElement::GetProperty(
                        $arPriceElement["IBLOCK_ID"],
                        $arPriceElement["ID"],
                        "sort",
                        "asc",
                        array("ID" => $arCatalog["SKU_PROPERTY_ID"])
                    );
                    $arElement = $rsElement->Fetch();
                    if ($arElement && $arElement["VALUE"] > 0) {
                        $ELEMENT_ID = $arElement["VALUE"];
                        $IBLOCK_ID = $arCatalog["PRODUCT_IBLOCK_ID"];
                        $OFFERS_IBLOCK_ID = $arCatalog["IBLOCK_ID"];
                        $OFFERS_PROPERTY_ID = $arCatalog["SKU_PROPERTY_ID"];
                    }
                } //or iblock which has offers
                elseif ($arCatalog["OFFERS_IBLOCK_ID"] > 0) {
                    $ELEMENT_ID = $arPriceElement["ID"];
                    $IBLOCK_ID = $arPriceElement["IBLOCK_ID"];
                    $OFFERS_IBLOCK_ID = $arCatalog["OFFERS_IBLOCK_ID"];
                    $OFFERS_PROPERTY_ID = $arCatalog["OFFERS_PROPERTY_ID"];
                } //or it's regular catalog
                else {
                    $ELEMENT_ID = $arPriceElement["ID"];
                    $IBLOCK_ID = $arPriceElement["IBLOCK_ID"];
                    $OFFERS_IBLOCK_ID = false;
                    $OFFERS_PROPERTY_ID = false;
                }
            }
        }
    } //Check for iblock event
    elseif (is_array($arg1) && $arg1["ID"] > 0 && $arg1["IBLOCK_ID"] > 0) {
        //Check if iblock has offers
        $arOffers = CIBlockPriceTools::GetOffersIBlock($arg1["IBLOCK_ID"]);
        if (is_array($arOffers)) {
            $ELEMENT_ID = $arg1["ID"];
            $IBLOCK_ID = $arg1["IBLOCK_ID"];
            $OFFERS_IBLOCK_ID = $arOffers["OFFERS_IBLOCK_ID"];
            $OFFERS_PROPERTY_ID = $arOffers["OFFERS_PROPERTY_ID"];
        }
    }

    if ($ELEMENT_ID) {
        static $arPropCache = array();
        if (!array_key_exists($IBLOCK_ID, $arPropCache)) {
            //Check for MINIMAL_PRICE property
            $rsProperty = CIBlockProperty::GetByID("MINIMUM_PRICE", $IBLOCK_ID);
            $arProperty = $rsProperty->Fetch();
            if ($arProperty)
                $arPropCache[$IBLOCK_ID] = $arProperty["ID"];
            else
                $arPropCache[$IBLOCK_ID] = false;
        }

        if ($arPropCache[$IBLOCK_ID]) {
            //Compose elements filter
            if ($OFFERS_IBLOCK_ID) {
                $rsOffers = CIBlockElement::GetList(
                    array(),
                    array(
                        "IBLOCK_ID" => $OFFERS_IBLOCK_ID,
                        "PROPERTY_" . $OFFERS_PROPERTY_ID => $ELEMENT_ID,
                    ),
                    false,
                    false,
                    array("ID")
                );
                while ($arOffer = $rsOffers->Fetch())
                    $arProductID[] = $arOffer["ID"];

                if (!is_array($arProductID))
                    $arProductID = array($ELEMENT_ID);
            } else
                $arProductID = array($ELEMENT_ID);

            $minPrice = false;
            $maxPrice = false;
            //Get prices
            $rsPrices = CPrice::GetList(
                array(),
                array(
                    "PRODUCT_ID" => $arProductID,
                )
            );
            while ($arPrice = $rsPrices->Fetch()) {
                if (CModule::IncludeModule('currency') && $strDefaultCurrency != $arPrice['CURRENCY'])
                    $arPrice["PRICE"] = CCurrencyRates::ConvertCurrency($arPrice["PRICE"], $arPrice["CURRENCY"], $strDefaultCurrency);

                $PRICE = $arPrice["PRICE"];

                if ($minPrice === false || $minPrice > $PRICE)
                    $minPrice = $PRICE;

                if ($maxPrice === false || $maxPrice < $PRICE)
                    $maxPrice = $PRICE;
            }

            //Save found minimal price into property
            if ($minPrice !== false) {
                CIBlockElement::SetPropertyValuesEx(
                    $ELEMENT_ID,
                    $IBLOCK_ID,
                    array(
                        "MINIMUM_PRICE" => $minPrice,
                        "MAXIMUM_PRICE" => $maxPrice,
                    )
                );
            }
        }
    }
}

function OnPrologHandler()
{
    if($_REQUEST['lang'] &&
        ($_REQUEST['lang'] == Helper::RU_VERSION || $_REQUEST['lang'] == Helper::EN_VERSION)
    ) {
        $siteVersion = $_REQUEST['lang'];
        Helper::setSiteVersion($siteVersion);
    } else {
        $siteVersion = Helper::getCookieSiteVersion();

        if(!$siteVersion) {
            $siteVersion = Helper::getSiteVersionByIp();
            Helper::setSiteVersion($siteVersion);
        }
    }

    if($siteVersion && $siteVersion != LANGUAGE_ID &&
        strripos($_SERVER['REQUEST_URI'], '/bitrix/') === false
    ) {
        Helper::changeVersion($siteVersion);
    }
}

AddEventHandler("forum", "onAfterMessageAdd", "notifyNewItemFeedback");

function notifyNewItemFeedback($ID, $arFields)
{
    if(SITE_ID == "s1"){
        $IBLOCK_ID = CATALOG_IBLOCK_ID;
        $ID_MAIL_EVENT = BX_CATALOG_DETAIL_COMMENT_ID_MAIL_EVENT_RU;
        $ID_MAIL_EVENT_TO_AUTHOR = BX_CATALOG_DETAIL_COMMENT_ID_MAIL_EVENT_TO_AUTHOR_RU;
    }else{
        $IBLOCK_ID = CATALOG_IBLOCK_ID_EN;
        $ID_MAIL_EVENT = BX_CATALOG_DETAIL_COMMENT_ID_MAIL_EVENT_EN;
        $ID_MAIL_EVENT_TO_AUTHOR = BX_CATALOG_DETAIL_COMMENT_ID_MAIL_EVENT_TO_AUTHOR_EN;
    }
    ob_start();
    $res = CIBlockElement::GetList(
        array(),
        array(
            'IBLOCK_ID' => $IBLOCK_ID,
            'PROPERTY_FORUM_TOPIC_ID' => $arFields["TOPIC_ID"]
        ),
        false,
        false,
        array('*', 'IBLOCK_ID', 'ID', 'NAME', 'PROPERTY_FORUM_TOPIC_ID', 'SECTION_ID', 'SECTION', 'SECTIONS')
    );
    if ($ar_res = $res->GetNext()) {
        var_dump(date('d.m.Y H:i:s'));
        echo 'найден товар ' . $ar_res['NAME'];
        $TYPE_MAIL_EVENT = 'NEW_ITEM_REVIEW';
        $TYPE_MAIL_EVENT_TO_AUTHOR = 'NEW_ITEM_REVIEW_TO_AUTHOR';
        var_dump($ar_res);
        $arMail = array(
            'ITEM_NAME' => $ar_res['NAME'],
            'AUTHOR_NAME' => $arFields['AUTHOR_NAME'],
            'AUTHOR_MAIL' => $arFields['AUTHOR_EMAIL'],
            'POST_DATE' => date('d.m.Y H:i:s'),
            'POST_MESSAGE' => $arFields['POST_MESSAGE'],
            //'PATH2ITEM' => '/catalog/' . $ar_res['IBLOCK_SECTION_ID'] . '/' . $ar_res['ID'],
            'PATH2ITEM' => "http://".$_SERVER['SERVER_NAME'].$_SERVER['REQUEST_URI']."#message".$arFields['ID'],
        );


        $arMailToAuthor = array(
            'ITEM_NAME' => $ar_res['NAME'],
            'AUTHOR_NAME' => $arFields['AUTHOR_NAME'],
            'AUTHOR_MAIL' => $arFields['AUTHOR_EMAIL'],
            'POST_DATE' => date('d.m.Y H:i:s'),
            'POST_MESSAGE' => $arFields['POST_MESSAGE'],
            //'PATH2ITEM' => '/catalog/' . $ar_res['IBLOCK_SECTION_ID'] . '/' . $ar_res['ID'],
            'PATH2ITEM' => "http://".$_SERVER['SERVER_NAME'].$_SERVER['REQUEST_URI']."#message".$arFields['ID'],
        );
        var_dump($arMail);

        $ok = CEvent::Send($TYPE_MAIL_EVENT, SITE_ID, $arMail, $ID_MAIL_EVENT);
        if ($ok) {
            echo 'Сообщение отправлено';
        } else {
            'Сообщение не отправлено ' . $ok;
        }
        //письмо автору комментария
        $ok = CEvent::Send($TYPE_MAIL_EVENT_TO_AUTHOR, SITE_ID, $arMailToAuthor, $ID_MAIL_EVENT_TO_AUTHOR);
        if ($ok) {
            echo 'Сообщение отправлено';
        } else {
            'Сообщение не отправлено ' . $ok;
        }
    } else
        echo 'Элемент не найден.';
    $dump = ob_get_clean();
    if (!empty($ok)) {
        return true;
    } else {
        $filename = dirname(__FILE__) . '/dump.txt';
        if (!file_exists($filename)) {
            $f = fopen($filename, 'w+');
            fclose($f);
        }
        file_put_contents($filename, $dump);
    }
}

AddEventHandler("forum", "onMessageModerate", "notifyModerateItemFeedback");

function notifyModerateItemFeedback($ID, $TYPE, $arMessage)//($ID, $arFields)
{
    if(SITE_ID == "s1"){
        $ID_MAIL_EVENT_SHOW = BX_CATALOG_DETAIL_COMMENT_ID_MAIL_EVENT_SHOW_RU;
        $ID_MAIL_EVENT_HIDE = BX_CATALOG_DETAIL_COMMENT_ID_MAIL_EVENT_HIDE_RU;


    }else{
        $ID_MAIL_EVENT_SHOW = BX_CATALOG_DETAIL_COMMENT_ID_MAIL_EVENT_SHOW_EN;
        $ID_MAIL_EVENT_HIDE = BX_CATALOG_DETAIL_COMMENT_ID_MAIL_EVENT_HIDE_EN;
    }
    $TYPE_MAIL_EVENT_SHOW = 'ITEM_REVIEW_SHOW';
    $TYPE_MAIL_EVENT_HIDE = 'ITEM_REVIEW_HIDE';


    if($TYPE == "SHOW"){

        $arMailToAuthor = array(
            //'AUTHOR_NAME' => $arMessage['AUTHOR_NAME'],
            'AUTHOR_MAIL' => $arMessage['AUTHOR_EMAIL'],
            //'POST_DATE' => date('d.m.Y H:i:s'),
            'POST_MESSAGE' => $arMessage['POST_MESSAGE'],

        );
        CEvent::Send($TYPE_MAIL_EVENT_SHOW, SITE_ID, $arMailToAuthor, $ID_MAIL_EVENT_SHOW);

    }else if($TYPE == "HIDE"){

        $arMailToAuthor = array(
            //'AUTHOR_NAME' => $arMessage['AUTHOR_NAME'],
            'AUTHOR_MAIL' => $arMessage['AUTHOR_EMAIL'],
            //'POST_DATE' => date('d.m.Y H:i:s'),
            'POST_MESSAGE' => $arMessage['POST_MESSAGE'],

        );
        CEvent::Send($TYPE_MAIL_EVENT_HIDE, SITE_ID, $arMailToAuthor, $ID_MAIL_EVENT_HIDE);

    }
}



AddEventHandler("forum", "onAfterMessageDelete", "notifyDeleteItemFeedback");

function notifyDeleteItemFeedback($ID, $arMessage)//($ID, $arFields)
{
    if(SITE_ID == "s1"){
        $ID_MAIL_EVENT = BX_CATALOG_DETAIL_COMMENT_ID_MAIL_EVENT_DELETE_RU;

    }else{
        $ID_MAIL_EVENT = BX_CATALOG_DETAIL_COMMENT_ID_MAIL_EVENT_DELETE_EN;
    }
    $TYPE_MAIL_EVENT = 'ITEM_REVIEW_DELETE';

    $arMailToAuthor = array(
        //'AUTHOR_NAME' => $arMessage['AUTHOR_NAME'],
        'AUTHOR_MAIL' => $arMessage['AUTHOR_EMAIL'],
        //'POST_DATE' => date('d.m.Y H:i:s'),
        'POST_MESSAGE' => $arMessage['POST_MESSAGE'],

    );
    CEvent::Send($TYPE_MAIL_EVENT, SITE_ID, $arMailToAuthor, $ID_MAIL_EVENT);
}

//оформление заказа

AddEventHandler("sale", "OnSaleComponentOrderCreated", "myOnSaleComponentOrderCreated");

function myOnSaleComponentOrderCreated($order, &$arUserResult, $request, &$arParams, &$arResult, &$arDeliveryServiceAll, &$arPaySystemServiceAll)//($ID, $arFields)
{
    ob_start();




    $dump = ob_get_clean();

        $filename = dirname(__FILE__) . '/dump_myOnSaleComponentOrderCreated.txt';
        if (!file_exists($filename)) {
            $f = fopen($filename, 'w+');
            fclose($f);
        }
        file_put_contents($filename, $dump);

}

AddEventHandler("sale", "OnSaleComponentOrderResultPrepared", "myOnSaleComponentOrderResultPrepared");

function myOnSaleComponentOrderResultPrepared($order, &$arUserResult, $request, &$arParams, &$arResult)//($ID, $arFields)
{


    if(LANGUAGE_ID==='en') {
        $otherCity = 59;
        $otherIndex = 61;
    }else{
        $otherCity = 58;
        $otherIndex = 60;
    }

    $otherAddress = "";

    if(!empty($arUserResult["ORDER_PROP"][$otherCity])){
        $otherAddress = $otherAddress . $arUserResult["ORDER_PROP"][$otherCity];
    }

    if(!empty($arUserResult["ORDER_PROP"][$otherIndex])){
        $otherAddress = $otherAddress . ", " . $arUserResult["ORDER_PROP"][$otherIndex];
    }

    $GLOBALS["OTHER_ADDRESS"] = $otherAddress;

    if(LANGUAGE_ID==='en') {
        $GLOBALS["LOCATION"] = $request->getPost("ORDER_PROP_44");
    }else{
        $GLOBALS["LOCATION"] = $request->getPost("ORDER_PROP_6");
    }




    ob_start();

    $dump = ob_get_clean();

    $filename = dirname(__FILE__) . '/dump_myOnSaleComponentOrderResultPrepared.txt';
    if (!file_exists($filename)) {
        $f = fopen($filename, 'w+');
        fclose($f);
    }
    file_put_contents($filename, $dump);








///////////////////////////////////////////////



    if (!CModule::IncludeModule("sale"))
    {
        ShowError(GetMessage("SALE_MODULE_NOT_INSTALL"));
        return;
    }

    if (strlen($_REQUEST["BasketRefresh"]) > 0 || strlen($_REQUEST["BasketOrder"]) > 0 || strlen($_REQUEST["action"]) > 0)
    {
        if(strlen($_REQUEST["action"]) > 0)
        {
            $id = IntVal($_REQUEST["id"]);
            if($id > 0)
            {
                $dbBasketItems = CSaleBasket::GetList(
                    array(),
                    array(
                        "FUSER_ID" => CSaleBasket::GetBasketUserID(),
                        "LID" => SITE_ID,
                        "ORDER_ID" => "NULL",
                        "ID" => $id,
                    ),
                    false,
                    false,
                    array("ID", "CALLBACK_FUNC", "MODULE", "PRODUCT_ID", "QUANTITY", "DELAY", "CAN_BUY", "CURRENCY")
                );

                if($arBasket = $dbBasketItems->Fetch())
                {
                    if($_REQUEST["action"] == "delete" && in_array("DELETE", $arParams["COLUMNS_LIST"]))
                    {
                        CSaleBasket::Delete($arBasket["ID"]);
                    }
                    elseif($_REQUEST["action"] == "shelve" && in_array("DELAY", $arParams["COLUMNS_LIST"]))
                    {
                        if ($arBasket["DELAY"] == "N" && $arBasket["CAN_BUY"] == "Y")
                            CSaleBasket::Update($arBasket["ID"], Array("DELAY" => "Y"));
                    }
                    elseif($_REQUEST["action"] == "add" && in_array("DELAY", $arParams["COLUMNS_LIST"]))
                    {
                        if ($arBasket["DELAY"] == "Y" && $arBasket["CAN_BUY"] == "Y")
                            CSaleBasket::Update($arBasket["ID"], Array("DELAY" => "N"));
                    }
                    unset($_SESSION["SALE_BASKET_NUM_PRODUCTS"][SITE_ID]);
                }
            }
        }
        else
        {
            if ($arParams["HIDE_COUPON"] != "Y")
            {
                $COUPON = Trim($_REQUEST["COUPON"]);
                if (strlen($COUPON) > 0)
                    CCatalogDiscountCoupon::SetCoupon($COUPON);
                else
                    CCatalogDiscountCoupon::ClearCoupon();
            }
            $dbBasketItems = CSaleBasket::GetList(
                array("NAME" => "ASC"),
                array(
                    "FUSER_ID" => CSaleBasket::GetBasketUserID(),
                    "LID" => SITE_ID,
                    "ORDER_ID" => "NULL"
                ),
                false,
                false,
                array("ID", "CALLBACK_FUNC", "MODULE", "PRODUCT_ID", "QUANTITY", "DELAY", "CAN_BUY", "PRICE", "QUANTITY", "CURRENCY", "SUBSCRIBE", "PRODUCT_PROVIDER_CLASS")
            );
            while ($arBasketItems = $dbBasketItems->Fetch())
            {
                $arBasketItems['QUANTITY'] = $arParams['QUANTITY_FLOAT'] == 'Y' ? DoubleVal($arBasketItems['QUANTITY']) : IntVal($arBasketItems['QUANTITY']);
                $basketItemsParameters = CCatalogProduct::GetByID($arBasketItems["PRODUCT_ID"]);
                $basketItemsQuantity = $basketItemsParameters["QUANTITY"];
                $arBasketItems['MAX_QUANTITY'] = $basketItemsQuantity;//доступное количество
                $quantityTmp = $arParams['QUANTITY_FLOAT'] == 'Y' ? DoubleVal($_REQUEST["QUANTITY_".$arBasketItems["ID"]]) : IntVal($_REQUEST["QUANTITY_".$arBasketItems["ID"]]);

                if ( ($arBasketItems["DELAY"] == "N" && $arBasketItems["CAN_BUY"] == "Y" && $quantityTmp > 0)
                    || ($arBasketItems["DELAY"] == "Y" && $arBasketItems["CAN_BUY"] == "Y" && $quantityTmp > 0) )
                {
                    $arFields = array();
                    if (in_array("QUANTITY", $arParams["COLUMNS_LIST"]))
                        $arFields["QUANTITY"] = $quantityTmp;

                    if (count($arFields) > 0 &&	($arBasketItems["QUANTITY"] != $arFields["QUANTITY"] && in_array("QUANTITY", $arParams["COLUMNS_LIST"])))
                        CSaleBasket::Update($arBasketItems["ID"], $arFields);
                }
            }
        }

        if (strlen($_REQUEST["BasketOrder"]) > 0)
        {
            LocalRedirect($arParams["PATH_TO_ORDER"]);
        }
        else
        {
            unset($_REQUEST["BasketRefresh"]);
            unset($_REQUEST["BasketOrder"]);
            LocalRedirect($APPLICATION->GetCurPage());
        }
    }

    CSaleBasket::UpdateBasketPrices(CSaleBasket::GetBasketUserID(), SITE_ID);

    $bShowReady = False;
    $bShowDelay = False;
    $bShowSubscribe = False;
    $bShowNotAvail = False;
    $allSum = 0;
    $allSumOld = 0;
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

        $basketItemsParameters = CCatalogProduct::GetByID($arItems["PRODUCT_ID"]);
        $basketItemsQuantity = $basketItemsParameters["QUANTITY"];
        $arItems['MAX_QUANTITY'] = $basketItemsQuantity;//доступное количество

        $arItems["PROPS"] = Array();
        if(in_array("PROPS", $arParams["COLUMNS_LIST"]))
        {
            $dbProp = CSaleBasket::GetPropsList(Array("SORT" => "ASC", "ID" => "ASC"), Array("BASKET_ID" => $arItems["ID"], "!CODE" => array("CATALOG.XML_ID", "PRODUCT.XML_ID")));
            while($arProp = $dbProp -> GetNext())
                $arItems["PROPS"][] = $arProp;
        }

        $arItems["PRICE_VAT_VALUE"] = (($arItems["PRICE"] / ($arItems["VAT_RATE"] +1)) * $arItems["VAT_RATE"]);
        $arItems["PRICE_FORMATED"] = SaleFormatCurrency($arItems["PRICE"], $arItems["CURRENCY"]);
        $arItems["WEIGHT"] = DoubleVal($arItems["WEIGHT"]);
        $arItems["WEIGHT_FORMATED"] = roundEx(DoubleVal($arItems["WEIGHT"]/$arParams["WEIGHT_KOEF"]), SALE_VALUE_PRECISION)." ".$arParams["WEIGHT_UNIT"];

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

        $allSumOld += ($arItems["FULL_PRICE"] * $arItems["QUANTITY"]);

        $arBasketItems[] = $arItems;
    }

    if($allSumOld != 0){

        $arResult["allSumOld_FORMATED"] = SaleFormatCurrency($allSumOld, $allCurrency);
    }else{
        $arResult["allSumOld_FORMATED"] = SaleFormatCurrency($allSum, $allCurrency);

    }

//--DETAIL_PHOTOS
    $arBasketItemImgs = array();
    if (is_array($arItemsIDsForPhoto) && !empty($arItemsIDsForPhoto) && CModule::IncludeModule("iblock"))
    {
        $arSkuItemsIDsForPhoto = array();
        $arBind = array();
        $dbAddProps = CIBlockElement::GetList(array(), array("ID"=>$arItemsIDsForPhoto), false, false,
            array("ID", "DETAIL_PICTURE", "PREVIEW_PICTURE", "PROPERTY_CML2_LINK", "PROPERTY_MORE_PHOTO"));
        while ($arAddProps = $dbAddProps->GetNext())
        {

            $photo = "";
            if(!empty($arAddProps["PREVIEW_PICTURE"])){
                $photo = CFile::GetFileArray($arAddProps["PREVIEW_PICTURE"]);
            }else if(!empty($arAddProps["DETAIL_PICTURE"])){
                $photo = CFile::GetFileArray($arAddProps["DETAIL_PICTURE"]);
            }else if(!empty($arAddProps["PROPERTY_MORE_PHOTO_VALUE"])){
                $photo = CFile::GetFileArray($arAddProps["PROPERTY_MORE_PHOTO_VALUE"]);
            }else{
                //$photo["src"] = $componentPath."/images/no_photo.png";

            }

            if (!$photo  && $arAddProps["PROPERTY_CML2_LINK_VALUE"])
            {
                $arSkuItemsIDsForPhoto[] = $arAddProps["PROPERTY_CML2_LINK_VALUE"];
                $arBind[$arAddProps["PROPERTY_CML2_LINK_VALUE"]][] = $arItemsInBasketIDs[$arAddProps["ID"]];
            }
            if ($photo)
            {
                $arFileTmp = CFile::ResizeImageGet(
                    $photo,
                    array("width" => "68", "height" =>"68"),
                    BX_RESIZE_IMAGE_PROPORTIONAL,
                    true
                );

                foreach($arItemsInBasketIDs[$arAddProps["ID"]] as $key => $itemID) {
                    $arBasketItemImgs[$itemID]  = array(
                        "SRC" => $arFileTmp["src"],
                        'WIDTH' => $arFileTmp["width"],
                        'HEIGHT' => $arFileTmp["height"],
                    );
                }
            }
        }
        if (is_array($arSkuItemsIDsForPhoto) && !empty($arSkuItemsIDsForPhoto))
        {
            $arSkuItemsIDsForPhoto = array_unique($arSkuItemsIDsForPhoto);
            $dbAddProps = CIBlockElement::GetList(array(), array("ID"=>$arSkuItemsIDsForPhoto), false, false,
                array("ID", "DETAIL_PICTURE", "PREVIEW_PICTURE", "PROPERTY_CML2_LINK", "PROPERTY_MORE_PHOTO"));
            while ($arAddProps = $dbAddProps->GetNext())
            {
                $photo = "";
                //$photo = CFile::GetFileArray($arAddProps["DETAIL_PICTURE"]);

                if(!empty($arAddProps["PREVIEW_PICTURE"])){
                    $photo = CFile::GetFileArray($arAddProps["PREVIEW_PICTURE"]);
                }else if(!empty($arAddProps["DETAIL_PICTURE"])){
                    $photo = CFile::GetFileArray($arAddProps["DETAIL_PICTURE"]);
                }else if(!empty($arAddProps["PROPERTY_MORE_PHOTO_VALUE"])){
                    $photo = CFile::GetFileArray($arAddProps["PROPERTY_MORE_PHOTO_VALUE"]);
                }else{
                    //$photo["src"] = $componentPath."/images/no_photo.png";
                }
                if ($photo)
                {
                    $arFileTmp = CFile::ResizeImageGet(
                        $photo,
                        array("width" => "68", "height" =>"68"),
                        BX_RESIZE_IMAGE_PROPORTIONAL,
                        true
                    );
                    foreach ($arBind[$arAddProps["ID"]] as $val)
                        foreach ($val as $val2)
                            $arBasketItemImgs[$val2]  = array(
                                "SRC" => $arFileTmp["src"],
                                'WIDTH' => $arFileTmp["width"],
                                'HEIGHT' => $arFileTmp["height"],
                            );
                }
            }
        }
    }
    $arResult["ITEMS_IMG"] = $arBasketItemImgs;

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
        'COUNT_DISCOUNT_4_ALL_QUANTITY' => $arParams["COUNT_DISCOUNT_4_ALL_QUANTITY"],
    );

    $arErrors = array();

    CSaleDiscount::DoProcessOrder($arOrder, $arOptions, $arErrors);

    $allSum = 0;
    $allWeight = 0;
    $allVATSum = 0;

    $DISCOUNT_PRICE_ALL = 0;
    foreach ($arOrder['BASKET_ITEMS'] as &$arOneItem)
    {
        $allSum += ($arOneItem["PRICE"] * $arOneItem["QUANTITY"]);
        $allWeight += ($arOneItem["WEIGHT"] * $arOneItem["QUANTITY"]);
        if (array_key_exists('VAT_VALUE', $arOneItem))
            $arOneItem["PRICE_VAT_VALUE"] = $arOneItem["VAT_VALUE"];
        $allVATSum += roundEx($arOneItem["PRICE_VAT_VALUE"] * $arOneItem["QUANTITY"], SALE_VALUE_PRECISION);

        $arCurFormat = CCurrencyLang::GetCurrencyFormat($arOneItem["CURRENCY"]);

        $arCurFormat["FORMAT_STRING"];

        //$arOneItem["PRICE_FORMATED"] = str_replace("#", $arOneItem["PRICE"], $arCurFormat["FORMAT_STRING"]);
        $arOneItem["PRICE_FORMATED"] = SaleFormatCurrency($arOneItem["PRICE"], $arOneItem["CURRENCY"]);

        $arOneItem["DISCOUNT_PRICE_PERCENT"] = $arOneItem["DISCOUNT_PRICE"]*100 / ($arOneItem["DISCOUNT_PRICE"] + $arOneItem["PRICE"]);
        $arOneItem["DISCOUNT_PRICE_PERCENT_FORMATED"] = roundEx($arOneItem["DISCOUNT_PRICE_PERCENT"], SALE_VALUE_PRECISION)."%";
        $arOneItem["FULL_PRICE"] = $arOneItem["DISCOUNT_PRICE"] + $arOneItem["PRICE"];
        $arOneItem["FULL_PRICE_FORMATED"] = SaleFormatCurrency($arOneItem["FULL_PRICE"], $arOneItem["CURRENCY"]);
        $DISCOUNT_PRICE_ALL += $arOneItem["DISCOUNT_PRICE"] * $arOneItem["QUANTITY"];

        $productId = $arOneItem["PRODUCT_ID"];

        //ссылка на детальную страницу
        $arOneItem["DETAIL_PAGE_URL"] = $arOneItem["DETAIL_PAGE_URL"]."?offer=".$productId;
        $arOneItem["~DETAIL_PAGE_URL"] = $arOneItem["DETAIL_PAGE_URL"];
    }
    if (isset($arOneItem))
        unset($arOneItem);

    $arResult["ITEMS"]["AnDelCanBuy"] = $arOrder['BASKET_ITEMS'];

//$DISCOUNT_PRICE_ALL += $arResult["DISCOUNT_PRICE"];
    $arResult["allSum"] = $allSum;
    $arResult["allWeight"] = $allWeight;
    $arResult["allWeight_FORMATED"] = roundEx(DoubleVal($allWeight/$arParams["WEIGHT_KOEF"]), SALE_VALUE_PRECISION)." ".$arParams["WEIGHT_UNIT"];
    $arResult["allSum_FORMATED"] = SaleFormatCurrency($allSum, $allCurrency);

    $arResult["DISCOUNT_PRICE_FORMATED"] = SaleFormatCurrency($arResult["DISCOUNT_PRICE"], $allCurrency);

    if ($arParams['PRICE_VAT_SHOW_VALUE'] == 'Y')
    {
        $arResult["allVATSum"] = $allVATSum;
        $arResult["allVATSum_FORMATED"] = SaleFormatCurrency($allVATSum, $allCurrency);
        $arResult["allNOVATSum_FORMATED"] = SaleFormatCurrency(DoubleVal($arResult["allSum"]-$allVATSum), $allCurrency);
    }

    if ($arParams["HIDE_COUPON"] != "Y")
        $arCoupons = CCatalogDiscountCoupon::GetCoupons();

    if (count($arCoupons) > 0)
        $arResult["COUPON"] = htmlspecialcharsbx($arCoupons[0]);
    if(count($arBasketItems)<=0)
        $arResult["ERROR_MESSAGE"] = GetMessage("SALE_EMPTY_BASKET");

    $arResult["DISCOUNT_PRICE_ALL"] = $DISCOUNT_PRICE_ALL;
    $arResult["DISCOUNT_PRICE_ALL_FORMATED"] = SaleFormatCurrency($DISCOUNT_PRICE_ALL, $allCurrency);

    $arResult["BASKET_ITEMS"] = $arResult["ITEMS"]["AnDelCanBuy"];

    foreach($arResult["BASKET_ITEMS"] as $k => $v){
        $arResult["BASKET_ITEMS"][$k]["DETAIL_PICTURE_SRC"] = $arResult["ITEMS_IMG"][$arResult["BASKET_ITEMS"][$k]["ID"]]["SRC"];
        $arResult["BASKET_ITEMS"][$k]["SUM_BASE_FORMATED"] = SaleFormatCurrency($arResult["ITEMS"]["AnDelCanBuy"][$k]["PRICE"] * $arResult["ITEMS"]["AnDelCanBuy"][$k]["QUANTITY"], $allCurrency);
    }

    $arResult["ORDER_PRICE"] = $arResult["allSum"];

    $arResult["ORDER_PRICE_FORMATED"] = $arResult["allSum_FORMATED"];
    $arResult["ORDER_TOTAL_PRICE"] = $arResult["DELIVERY_PRICE"] + $arResult["ORDER_PRICE"];
    $GLOBALS['ORDER_TOTAL_PRICE'] = $arResult['ORDER_TOTAL_PRICE'];
    $arResult["ORDER_TOTAL_PRICE_FORMATED"] = SaleFormatCurrency($arResult["ORDER_TOTAL_PRICE"], $allCurrency);

    $arResult["JS_DATA"]["TOTAL"]["ORDER_TOTAL_PRICE"] = $arResult["ORDER_TOTAL_PRICE"];
    $arResult["JS_DATA"]["TOTAL"]["ORDER_TOTAL_PRICE_FORMATED"] = $arResult["ORDER_TOTAL_PRICE_FORMATED"];
    $arResult["JS_DATA"]["TOTAL"]["ORDER_PRICE"] = $arResult["ORDER_PRICE"];
    $arResult["JS_DATA"]["TOTAL"]["ORDER_PRICE_FORMATED"] = $arResult["ORDER_PRICE_FORMATED"];

}

use Bitrix\Main;



Main\EventManager::getInstance()->addEventHandler(
    'sale',
    'OnSaleOrderBeforeSaved',
    'myOnSaleOrderBeforeSaved'
);


function myOnSaleOrderBeforeSaved(Main\Event $event)
{


    /** @var Order $order */
    $order = $event->getParameter("ENTITY");
    $oldValues = $event->getParameter("VALUES");
    $isNew = $event->getParameter("IS_NEW");

    //$order->setField('DELIVERY_LOCATION', 'Комментарий к заказу');
    $DELIVERY_LOCATION = $order->getField('DELIVERY_LOCATION');



    ob_start();


    //$basket = $order->getBasket();
    //$price = $basket->getPrice();




        $dump = ob_get_clean();

        $filename = dirname(__FILE__) . '/dump_myOnSaleOrderBeforeSaved.txt';
        if (!file_exists($filename)) {
            $f = fopen($filename, 'w+');
            fclose($f);
        }
        file_put_contents($filename, $dump);





}




Main\EventManager::getInstance()->addEventHandler(
    'sale',
    'OnSaleOrderSaved',
    'myOnSaleOrderSaved'
);


function myOnSaleOrderSaved(Main\Event $event)
{
    /** @var Order $order */
    $order = $event->getParameter("ENTITY");
    $oldValues = $event->getParameter("VALUES");
    $isNew = $event->getParameter("IS_NEW");

    if ($isNew)
    {
        $order->setField('PRICE', $GLOBALS['ORDER_TOTAL_PRICE']);

        $order->setField('TAX_PRICE', $GLOBALS['ORDER_TOTAL_PRICE']);
        $order->setField('VAT_SUM', $GLOBALS['ORDER_TOTAL_PRICE']);

        //$order->setField('DISCOUNT_VALUE', '50');
        //$order->setField('DISCOUNT_PRICE', '100');
        $order->save();

        ob_start();

        $DELIVERY_LOCATION = $order->getField('DELIVERY_LOCATION');




        $propertyCollection = $order->getPropertyCollection();
        $addrPropValue  = $propertyCollection->getAddress();
        $locPropValue   = $propertyCollection->getDeliveryLocation();
        $zipPropValue   = $propertyCollection->getDeliveryLocationZip();



        $address = "";
        $ORDER_PROPS_ID = "";


        $dbOrderProps = CSaleOrderPropsValue::GetList(
            array("SORT" => "ASC"),
            array("ORDER_ID" => $order->getId(), "CODE"=>array("ADDRESS","LOCATION"))
        );
        while ($arOrderProps = $dbOrderProps->GetNext()):
            if($arOrderProps["CODE"] == "ADDRESS"){
                $address = $arOrderProps["VALUE"];
                $ORDER_PROPS_ID = $arOrderProps["ORDER_PROPS_ID"];
                $ID = $arOrderProps["ID"];
            }else{
                $ID_LOCATION = $arOrderProps["ID"];
            }
        endwhile;



        if(!empty($GLOBALS["OTHER_ADDRESS"]) && empty($address)){
            $address = $GLOBALS["OTHER_ADDRESS"].$address;
        }else if(!empty($GLOBALS["OTHER_ADDRESS"]) && !empty($address)){
            $address = $GLOBALS["OTHER_ADDRESS"].", ".$address;
        }




        $res = CSaleOrderPropsValue::Update($ID, array("VALUE" => $address, "VALUE_ORIG" => $address)); // адрес доставки
        $res = CSaleOrderPropsValue::Update($ID_LOCATION, array("VALUE" => $GLOBALS["LOCATION"], "VALUE_ORIG" => $GLOBALS["LOCATION"])); // местоположение





        $dump = ob_get_clean();

        $filename = dirname(__FILE__) . '/dump_myOnSaleOrderSaved.txt';
        if (!file_exists($filename)) {
            $f = fopen($filename, 'w+');
            fclose($f);
        }
        file_put_contents($filename, $dump);
    }
}

AddEventHandler("subscribe", "BeforePostingSendMail", array("SubscribeHandlers", "BeforePostingSendMailHandler"));

class SubscribeHandlers
{
    public function BeforePostingSendMailHandler($arFields)
    {
        $rsSub = CSubscription::GetByEmail($arFields["EMAIL"]);
        $arSub = $rsSub->Fetch();

        $arFields["BODY"] = str_replace("#MAIL_ID#", $arSub["ID"], $arFields["BODY"]);
        $arFields["BODY"] = str_replace("#MAIL_MD5#", SubscribeHandlers::GetMailHash($arFields["EMAIL"]), $arFields["BODY"]);

        return $arFields;
    }

    public function GetMailHash($email)
    {
        return md5(md5($email) . MAIL_SALT);
    }
}
AddEventHandler("main", "OnBeforeUserRegister", "OnBeforeUserUpdateHandler");
AddEventHandler("main", "OnAfterUserRegister", "OnAfterUserRegisterHandler");
AddEventHandler("main", "OnBeforeUserUpdate", "OnBeforeUserUpdateHandler");
function OnAfterUserRegisterHandler(&$arFields){
    $email=$arFields['EMAIL'];
    $arrFieldsEmail = array(
        'NAME'=>$arFields['NAME'],
        'EMAIL' => $email,
        'LOGIN'=>$arFields['LOGIN'],
    );
    $userName = $arFields['NAME'];

    if($arFields["USER_ID"]>0) {
        CEvent::SendImmediate('NEW_USER_CONFIRM_'.LANGUAGE_ID, SITE_ID, $arrFieldsEmail);
        if(count($_REQUEST)!==0){
            if($_REQUEST['subscribe']==='on'){
                CModule::IncludeModule('subscribe');
                CModule::IncludeModule('main');

                $rsUser = CUser::GetByLogin($email);
                $arUser = $rsUser->Fetch();
                $USER_ID=$arUser['ID'];
                $subscr=new CSubscription;
                GLOBAL $DB;

                $rub = CRubric::GetList(array(), array("ACTIVE" => "Y"));
                while ($res = $rub->Fetch()) {
                    $RUB_ID[] = $res['ID'];
                }
                // поиск подписчика по mail
                $subscription = CSubscription::GetByEmail($email);
                if ($arSub = $subscription->Fetch()) {
                    $arrFieldsEmail = array(
                        'EMAIL' => $email,
                        'MAIL_ID' => $arSub['ID'],
                        'MAIL_MD5' => SubscribeHandlers::GetMailHash($email)

                    );
                    CEvent::SendImmediate('SUBSCRIBE_ALREADY_'.LANGUAGE_ID, SITE_ID, $arrFieldsEmail);
                }
                else{
                    // создадим массив на подписку
                    $arFields = Array(
                        "USER_ID" => $USER_ID,
                        "FORMAT" => "html/text",
                        "EMAIL" =>$email,
                        "ACTIVE" => "Y",
                        "RUB_ID" => $RUB_ID,
                        "SEND_CONFIRM" => "N",
                        "CONFIRMED" => 'Y'
                    );
                    $idsubrscr = $subscr->Add($arFields);
                    if ($idsubrscr) {
                        $arrFieldsEmail = array(
                            'EMAIL' => $email,
                            'DATE_SUBSCR' => date($DB->DateFormatToPHP(CSite::GetDateFormat("SHORT"))),
                            'MAIL_ID' => $idsubrscr,
                            'MAIL_MD5' => SubscribeHandlers::GetMailHash($email),
                            'NAME' => $userName
                        );



                        CEvent::SendImmediate('SUBSCRIBE_CONFIRM_'.LANGUAGE_ID, SITE_ID, $arrFieldsEmail);
                    }
                }
            }
        }
    }
    return $arFields;
}
function OnBeforeUserUpdateHandler(&$arFields)
{
    if(empty($arFields["EMAIL"]))
        $arFields["EMAIL"] = $arFields["LOGIN"];
    return $arFields;
}



Main\EventManager::getInstance()->addEventHandler(
    'catalog',
    'OnGetDiscountResult',
    'myOnGetDiscountResult'
);



function myOnGetDiscountResult(&$arFields)
{


    ob_start();
    //========================


////////////////////////////////////////////////////////////
////////////////////////////////////////////////////////////
    $bShowReady = False;
    $bShowDelay = False;
    $bShowSubscribe = False;
    $bShowNotAvail = False;
    $allSum = 0;
    $allSumOld = 0;
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
    $oldSumAll = 0;

    while ($arItems = $dbBasketItems->GetNext()) {
        $arItemsIDsForPhoto[] = $arItems["PRODUCT_ID"];
        $arItemsInBasketIDs[$arItems["PRODUCT_ID"]][] = $arItems["ID"];


        $QUANTITY = 0;

        $arBasketItems['MAX_QUANTITY'] = $QUANTITY;
        $arItems['MAX_QUANTITY'] = $QUANTITY;


        $arItems["PROPS"] = Array();
        if (in_array("PROPS", $arParams["COLUMNS_LIST"])) {
            $dbProp = CSaleBasket::GetPropsList(Array("SORT" => "ASC", "ID" => "ASC"), Array("BASKET_ID" => $arItems["ID"], "!CODE" => array("CATALOG.XML_ID", "PRODUCT.XML_ID")));
            while ($arProp = $dbProp->GetNext())
                $arItems["PROPS"][] = $arProp;
        }

        $arItems["PRICE_VAT_VALUE"] = (($arItems["PRICE"] / ($arItems["VAT_RATE"] + 1)) * $arItems["VAT_RATE"]);
        $arItems["PRICE_FORMATED"] = SaleFormatCurrency($arItems["PRICE"], $arItems["CURRENCY"]);
        $arItems["WEIGHT"] = DoubleVal($arItems["WEIGHT"]);
        $arItems["WEIGHT_FORMATED"] = roundEx(DoubleVal($arItems["WEIGHT"] / $arParams["WEIGHT_KOEF"]), SALE_VALUE_PRECISION) . " " . $arParams["WEIGHT_UNIT"];


        if ($arItems["DELAY"] == "N" && $arItems["CAN_BUY"] == "Y") {
            $allSum += ($arItems["PRICE"] * $arItems["QUANTITY"]);
            $allWeight += ($arItems["WEIGHT"] * $arItems["QUANTITY"]);
            $allVATSum += roundEx($arItems["PRICE_VAT_VALUE"] * $arItems["QUANTITY"], SALE_VALUE_PRECISION);
        }

        if ($arItems["DELAY"] == "N" && $arItems["CAN_BUY"] == "Y") {
            //$oldSumAll = $oldSumAll +


            $bShowReady = True;
            if (DoubleVal($arItems["DISCOUNT_PRICE"]) > 0) {
                $arItems["DISCOUNT_PRICE_PERCENT"] = $arItems["DISCOUNT_PRICE"] * 100 / ($arItems["DISCOUNT_PRICE"] + $arItems["PRICE"]);
                $arItems["DISCOUNT_PRICE_PERCENT_FORMATED"] = roundEx($arItems["DISCOUNT_PRICE_PERCENT"], SALE_VALUE_PRECISION) . "%";
                $DISCOUNT_PRICE_ALL += $arItems["DISCOUNT_PRICE"] * $arItems["QUANTITY"];
                $arItems["FULL_PRICE"] = $arItems["DISCOUNT_PRICE"] + $arItems["PRICE"];
                $arItems["FULL_PRICE_FORMATED"] = SaleFormatCurrency($arItems["FULL_PRICE"], $arItems["CURRENCY"]);

            }
            $arResult["ITEMS"]["AnDelCanBuy"][] = $arItems;
        } elseif ($arItems["DELAY"] == "Y" && $arItems["CAN_BUY"] == "Y") {

            $bShowDelay = True;
            if (DoubleVal($arItems["DISCOUNT_PRICE"]) > 0) {
                $arItems["DISCOUNT_PRICE_PERCENT"] = $arItems["DISCOUNT_PRICE"] * 100 / ($arItems["DISCOUNT_PRICE"] + $arItems["PRICE"]);
                $arItems["DISCOUNT_PRICE_PERCENT_FORMATED"] = roundEx($arItems["DISCOUNT_PRICE_PERCENT"], SALE_VALUE_PRECISION) . "%";
                $DISCOUNT_PRICE_ALL += $arItems["DISCOUNT_PRICE"] * $arItems["QUANTITY"];
                $arItems["FULL_PRICE"] = $arItems["DISCOUNT_PRICE"] + $arItems["PRICE"];
                $arItems["FULL_PRICE_FORMATED"] = SaleFormatCurrency($arItems["FULL_PRICE"], $arItems["CURRENCY"]);
            }
            $arResult["ITEMS"]["DelDelCanBuy"][] = $arItems;
        } elseif ($arItems["CAN_BUY"] == "N" && $arItems["SUBSCRIBE"] == "Y") {

            $bShowSubscribe = True;
            if (DoubleVal($arItems["DISCOUNT_PRICE"]) > 0) {
                $arItems["DISCOUNT_PRICE_PERCENT"] = $arItems["DISCOUNT_PRICE"] * 100 / ($arItems["DISCOUNT_PRICE"] + $arItems["PRICE"]);
                $arItems["DISCOUNT_PRICE_PERCENT_FORMATED"] = roundEx($arItems["DISCOUNT_PRICE_PERCENT"], SALE_VALUE_PRECISION) . "%";
                $DISCOUNT_PRICE_ALL += $arItems["DISCOUNT_PRICE"] * $arItems["QUANTITY"];
                $arItems["FULL_PRICE"] = $arItems["DISCOUNT_PRICE"] + $arItems["PRICE"];
                $arItems["FULL_PRICE_FORMATED"] = SaleFormatCurrency($arItems["FULL_PRICE"], $arItems["CURRENCY"]);
            }
            $arResult["ITEMS"]["ProdSubscribe"][] = $arItems;
        } else {
            $bShowNotAvail = True;
            if (DoubleVal($arItems["DISCOUNT_PRICE"]) > 0) {
                $arItems["DISCOUNT_PRICE_PERCENT"] = $arItems["DISCOUNT_PRICE"] * 100 / ($arItems["DISCOUNT_PRICE"] + $arItems["PRICE"]);
                $arItems["DISCOUNT_PRICE_PERCENT_FORMATED"] = roundEx($arItems["DISCOUNT_PRICE_PERCENT"], SALE_VALUE_PRECISION) . "%";
                $DISCOUNT_PRICE_ALL += $arItems["DISCOUNT_PRICE"] * $arItems["QUANTITY"];
                $arItems["FULL_PRICE"] = $arItems["DISCOUNT_PRICE"] + $arItems["PRICE"];
                $arItems["FULL_PRICE_FORMATED"] = SaleFormatCurrency($arItems["FULL_PRICE"], $arItems["CURRENCY"]);
            }
            $arResult["ITEMS"]["nAnCanBuy"][] = $arItems;
        }


        $allSumOld += ($arItems["FULL_PRICE"] * $arItems["QUANTITY"]);


        $arBasketItems[] = $arItems;
    }


    global $USER;
    $arOrder = array(
        'SITE_ID' => SITE_ID,
        'USER_ID' => $USER->GetID(),
        'ORDER_PRICE' => $allSum,
        'ORDER_WEIGHT' => $allWeight,
        'BASKET_ITEMS' => $arResult["ITEMS"]["AnDelCanBuy"]
    );

    $arOptions = array();

    $arErrors = array();


    //CSaleDiscount::DoProcessOrder($arOrder, $arOptions, $arErrors);

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
            $mode = \Bitrix\Sale\Compatible\DiscountCompatibility::MODE_MANAGER;
            $modeParams = array();
            if (isset($arOrder['CURRENCY']))
                $modeParams['CURRENCY'] = $arOrder['CURRENCY'];
            if (isset($arOrder['SITE_ID']))
            {
                $modeParams['SITE_ID'] = $arOrder['SITE_ID'];
                if (!isset($modeParams['CURRENCY']))
                    $modeParams['CURRENCY'] = \Bitrix\Sale\Internals\SiteCurrencyTable::getSiteCurrency($modeParams['SITE_ID']);
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

        $currentDatetime = new Main\Type\DateTime();
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


                    ////////////////////////////
                    $resultDiscountFullList[] = $discount;
                    if (Bitrix\Sale\Compatible\DiscountCompatibility::calculateSaleDiscount($arOrder, $discount)) {
                        $resultDiscountList[$resultDiscountIndex] = array(
                            'MODULE_ID' => $discount['MODULE_ID'],
                            'ID' => $discount['ID'],
                            'NAME' => $discount['NAME'],
                            'PRIORITY' => $discount['PRIORITY'],
                            'SORT' => $discount['SORT'],
                            'LAST_DISCOUNT' => $discount['LAST_DISCOUNT'],
                            'CONDITIONS' => serialize($discount['CONDITIONS_LIST']),
                            'UNPACK' => $discount['UNPACK'],
                            'ACTIONS' => serialize($discount['ACTIONS_LIST']),
                            'APPLICATION' => $discount['APPLICATION'],
                            'RESULT' => Helper::getDiscountResult($oldOrder, $arOrder, false),
                            'HANDLERS' => $cacheDiscountHandlers[$discount['ID']],
                            'USE_COUPONS' => $discount['USE_COUPONS'],
                            'COUPON' => ($discount['USE_COUPONS'] == 'Y' ? $couponList[$discount['DISCOUNT_COUPON']] : false)
                        );
                        $resultDiscountKeys[$discount['ID']] = $resultDiscountIndex;
                        $resultDiscountIndex++;
                        if ($discount['LAST_DISCOUNT'] == 'Y')
                            break;
                    }
                    Bitrix\Sale\Discount\Actions::clearAction();
                    ////////////////////////////
                }
                else
                {
                    $discountResult = Helper::getDiscountResult($oldOrder, $arOrder, false);
                    if (!empty($discountResult['DELIVERY']) || !empty($discountResult['BASKET']))
                    {
                        if ($discount['USE_COUPONS'] == 'Y' && !empty($discount['DISCOUNT_COUPON']))
                        {
                            if ($couponList[$discount['DISCOUNT_COUPON']]['TYPE'] == Sale\Internals\DiscountCouponTable::TYPE_BASKET_ROW)
                                self::changeDiscountResult($oldOrder, $arOrder, $discountResult);
                            $couponApply = Sale\DiscountCouponsManager::setApply($discount['DISCOUNT_COUPON'], $discountResult);
                            unset($couponApply);
                        }
                        $resultDiscountList[$resultDiscountIndex] = array(
                            'MODULE_ID' => $discount['MODULE_ID'],
                            'ID' => $discount['ID'],
                            'NAME' => $discount['NAME'],
                            'PRIORITY' => $discount['PRIORITY'],
                            'SORT' => $discount['SORT'],
                            'LAST_DISCOUNT' => $discount['LAST_DISCOUNT'],
                            'CONDITIONS' => serialize($discount['CONDITIONS_LIST']),
                            'UNPACK' => $discount['UNPACK'],
                            'ACTIONS' => serialize($discount['ACTIONS_LIST']),
                            'APPLICATION' => $discount['APPLICATION'],
                            'RESULT' => $discountResult,
                            'HANDLERS' => self::$cacheDiscountHandlers[$discount['ID']],
                            'USE_COUPONS' => $discount['USE_COUPONS'],
                            'COUPON' => ($discount['USE_COUPONS'] == 'Y' ? $couponList[$discount['DISCOUNT_COUPON']] : false)
                        );
                        $resultDiscountKeys[$discount['ID']] = $resultDiscountIndex;
                        $resultDiscountIndex++;
                        if ($discount['LAST_DISCOUNT'] == 'Y')
                            break;
                    }
                    unset($discountResult);
                }
            }
        }





        unset($discount, $discountIterator);





        $arOrder['DISCOUNT_LIST'] = $resultDiscountList;
        $arOrder['FULL_DISCOUNT_LIST'] = $resultDiscountFullList;
        if ($isOrderConverted == 'Y')
            \Bitrix\Sale\Compatible\DiscountCompatibility::setOldDiscountResult($resultDiscountList);
    }

    $arOrder["ORDER_PRICE"] = 0;
    $arOrder["ORDER_WEIGHT"] = 0;
    $arOrder["USE_VAT"] = false;
    $arOrder["VAT_RATE"] = 0;
    $arOrder["VAT_SUM"] = 0;
    $arOrder["DISCOUNT_PRICE"] = 0.0;
    $arOrder["DISCOUNT_VALUE"] = $arOrder["DISCOUNT_PRICE"];
    $arOrder["PRICE_DELIVERY"] = roundEx($arOrder["PRICE_DELIVERY"], SALE_VALUE_PRECISION);
    $arOrder["DELIVERY_PRICE"] = $arOrder["PRICE_DELIVERY"];




    foreach ($arOrder['BASKET_ITEMS'] as &$arShoppingCartItem)
    {
        if (isset($arShoppingCartItem['CATALOG']))
            unset($arShoppingCartItem['CATALOG']);
        if (!CSaleBasketHelper::isSetItem($arShoppingCartItem))
        {
            $customPrice = isset($arShoppingCartItem['CUSTOM_PRICE']) && $arShoppingCartItem['CUSTOM_PRICE'] = 'Y';
            if (!$customPrice)
            {
                $arShoppingCartItem['DISCOUNT_PRICE'] = roundEx($arShoppingCartItem['DISCOUNT_PRICE'], SALE_VALUE_PRECISION);
                if ($arShoppingCartItem['DISCOUNT_PRICE'] > 0)
                    $arShoppingCartItem['PRICE'] = $arShoppingCartItem['BASE_PRICE'] - $arShoppingCartItem['DISCOUNT_PRICE'];
                else
                    $arShoppingCartItem['PRICE'] = roundEx($arShoppingCartItem['PRICE'], SALE_VALUE_PRECISION);
            }
            else
            {
                $arShoppingCartItem['DISCOUNT_PRICE'] = 0;
            }
            if (isset($arShoppingCartItem['VAT_RATE']))
            {
                $vatRate = (float)$arShoppingCartItem['VAT_RATE'];
                if ($vatRate > 0)
                    $arShoppingCartItem['VAT_VALUE'] = (($arShoppingCartItem['PRICE'] / ($vatRate + 1)) * $vatRate);
                unset($vatRate);
            }

            $arOrder["ORDER_PRICE"] += $arShoppingCartItem["PRICE"] * $arShoppingCartItem["QUANTITY"];
            $arOrder["ORDER_WEIGHT"] += $arShoppingCartItem["WEIGHT"] * $arShoppingCartItem["QUANTITY"];

            $arShoppingCartItem["PRICE_FORMATED"] = CCurrencyLang::CurrencyFormat($arShoppingCartItem["PRICE"], $arShoppingCartItem["CURRENCY"], true);
            $arShoppingCartItem["DISCOUNT_PRICE_PERCENT"] = 0;


            if ($arShoppingCartItem["DISCOUNT_PRICE"] + $arShoppingCartItem["PRICE"] > 0)
                $arShoppingCartItem["DISCOUNT_PRICE_PERCENT"] = $arShoppingCartItem["DISCOUNT_PRICE"]*100 / ($arShoppingCartItem["DISCOUNT_PRICE"] + $arShoppingCartItem["PRICE"]);

            $arShoppingCartItem["DISCOUNT_PRICE_PERCENT_FORMATED"] = roundEx($arShoppingCartItem["DISCOUNT_PRICE_PERCENT"], SALE_VALUE_PRECISION)."%";


            if ($arShoppingCartItem["VAT_RATE"] > 0)
            {
                $arOrder["USE_VAT"] = true;
                if ($arShoppingCartItem["VAT_RATE"] > $arOrder["VAT_RATE"])
                    $arOrder["VAT_RATE"] = $arShoppingCartItem["VAT_RATE"];

                $arOrder["VAT_SUM"] += $arShoppingCartItem["VAT_VALUE"] * $arShoppingCartItem["QUANTITY"];
            }
        }
    }
    unset($arShoppingCartItem);

    if ($isOrderConverted == 'Y' && $oldDelivery != '')
        $arOrder['DELIVERY_ID'] = $oldDelivery;

    $arOrder["ORDER_PRICE"] = roundEx($arOrder["ORDER_PRICE"], SALE_VALUE_PRECISION);


    /******************************/



    //узнать сумму товаров в корзине с учётом собственных скидок товаров


    CModule::IncludeModule("sale");


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


    $sumAll = 0;
    $discountOne = 0;

    while ($arItems = $dbBasketItems->GetNext()) {
        $sumAll += ($arItems["PRICE"] * $arItems["QUANTITY"]);
    }




    if (!empty($arFields)) {
        $maxTmp = 0;
        foreach ($arFields as $key => $value) {
            if ($value["VALUE"] > $maxTmp) {
                $maxTmp = $value["VALUE"];
            }

        }

        //собственная скидка товара
        $currentDiscount = intval($maxTmp);

        if($discountSale > $currentDiscount){
            $arFields=array(); // если скидка правила работы с корзиной больше
            //собственной скидки товара, то убиваем собственную скидку товара
        }




    }




    //========================
    $dump = ob_get_clean();

    $filename = dirname(__FILE__) . '/dump_myOnGetDiscountResult.txt';
    if (!file_exists($filename)) {
        $f = fopen($filename, 'w+');
        fclose($f);
    }
    file_put_contents($filename, $dump);

}



/**
 * модифицировать #ORDER_LIST# и #SERVER_NAME# для письма, которое отправляется пользователю после
 * оформления заказа
 */
AddEventHandler("main", "OnBeforeEventAdd", "OnSaleDeliveryOrderSendEmail");

function OnSaleDeliveryOrderSendEmail(&$event, &$lid, &$arFields, &$message_id){



    if ($event=="SALE_NEW_ORDER") {
        //новый заказ


        $strOrderList = "";
        $dbBasketItems = CSaleBasket::GetList(
            array("NAME" => "ASC"),
            array("ORDER_ID" => $arFields["ORDER_REAL_ID"]),
            false,
            false,
            array("ID", "NAME", "QUANTITY", "PRICE", "CURRENCY")
        );
        $log = 1;
        $deliveryCurrency = "";
        while ($arBasketItems = $dbBasketItems->Fetch())
        {


            if(($log % 2) == 0){
                $color = "color-gray";
                $style = "background-color: #ebecec;";
            }else{
                $color = "";
                $style = "";
            }

            $strOrderList .= '<tr class="b-basket-table__item grid-container"
                    style="border: 0; font: inherit; font-family: \'Open Sans\', sans-serif; font-size: 100%; margin: 0; padding: 0; vertical-align: baseline;">
                    <td class="b-basket-table__item-title grid-row col-5 '.$color.' font-size__13"
                        style="'.$style.' border: 0; font: inherit; font-family: \'Open Sans\', sans-serif; font-size: 13px; letter-spacing: 0; line-height: 17px; margin: 0; margin-left: 2.475%; padding: 0; padding-bottom: 15px; padding-left: 10px; padding-right: 10px; padding-top: 15px; vertical-align: baseline; width: 38.15%;">
                        '.$arBasketItems["NAME"].'
                    </td>
                    <td class="b-basket-table__item-row grid-row col-3 '.$color.' font-size__13"
                        style="'.$style.' border: 0; font: inherit; font-family: \'Open Sans\', sans-serif; font-size: 13px; line-height: 17px; margin: 0; margin-left: 2.475%; padding: 0; padding-bottom: 15px; padding-left: 10px; padding-right: 10px; padding-top: 15px; vertical-align: baseline; width: 21.9%;">
                        '.$arBasketItems["QUANTITY"].'
                    </td>
                    <td class="b-basket-table__item-row grid-row col-2 '.$color.' font-size__13"
                        style="'.$style.' border: 0; font: inherit; font-family: \'Open Sans\', sans-serif; font-size: 13px; line-height: 17px; margin: 0; margin-left: 2.475%; padding: 0; padding-bottom: 15px; padding-left: 10px; padding-right: 10px; padding-top: 15px; vertical-align: baseline; width: 13.775%;">
                        '.SaleFormatCurrency($arBasketItems["PRICE"], $arBasketItems["CURRENCY"]).'
                    </td>
                    <td class="b-basket-table__item-row grid-row col-2 '.$color.' font-size__13"
                        style="'.$style.' border: 0; font: inherit; font-family: \'Open Sans\', sans-serif; font-size: 13px; line-height: 17px; margin: 0; margin-left: 2.475%; padding: 0; padding-bottom: 15px; padding-left: 10px; padding-right: 10px; padding-top: 15px; vertical-align: baseline; width: 13.775%;">
                        '.SaleFormatCurrency($arBasketItems["PRICE"] * $arBasketItems["QUANTITY"], $arBasketItems["CURRENCY"]).'
                    </td>
                </tr>';
            $log++;

            $deliveryCurrency = $arBasketItems["CURRENCY"];

        }



        $arFields['ORDER_LIST'] = $strOrderList;
        $arFields['ORDER_LINK'] = "/personal/order/order_detail.php?ID=".str_replace("/","%2B%252F%2B",$arFields["ORDER_ID"]);
        $arFields['ORDER_LINK'] = str_replace(" ", "", $arFields['ORDER_LINK']);
        $arFields['DELIVERY_PRICE'] = SaleFormatCurrency($arFields['DELIVERY_PRICE'], $deliveryCurrency);


        ob_start();
        //========================

        echo "<pre>";
        print_r($arFields);
        echo "</pre>";

        echo "<pre>";
        print_r($lid);
        echo "</pre>";

        echo "<pre>";
        print_r($event);
        echo "</pre>";

        //========================
        $dump = ob_get_clean();

        $filename = dirname(__FILE__) . '/dump_OnSaleDeliveryOrderSendEmail_SALE_NEW_ORDER.txt';
        if (!file_exists($filename)) {
            $f = fopen($filename, 'w+');
            fclose($f);
        }
        file_put_contents($filename, $dump);






    }

    $arSaleStatusChanged = array(
        "SALE_STATUS_CHANGED_P",
        "SALE_STATUS_CHANGED_N",
        "SALE_STATUS_CHANGED_F"
    );

    if (in_array($event,$arSaleStatusChanged)) {
        //смена статуса заказа
        $arFields['ORDER_LINK'] = "/personal/order/order_detail.php?ID=".str_replace("/","%2B%252F%2B",$arFields["ORDER_ID"]);
        $arFields['ORDER_LINK'] = str_replace(" ", "", $arFields['ORDER_LINK']);




    }





    //
    /*$arItemReview = array(
        "ITEM_REVIEW_DELETE",
        "ITEM_REVIEW_HIDE",
        "ITEM_REVIEW_SHOW",
        "NEW_ITEM_REVIEW",
        "NEW_ITEM_REVIEW_TO_AUTHOR",
        "USER_PASS_REQUEST",
        "USER_PASS_REQUEST_en"
    );

    if (in_array($event,$arItemReview)) {*/
        //уведомления о комментариях к товару

        //
        $saleEmail = COption::GetOptionString("sale", "order_email");

        $arFields['SALE_EMAIL'] = $saleEmail;


    //}






    $arFields['SERVER_NAME'] = $_SERVER['SERVER_NAME'];
    $arFields['SERVER_NAME_RU'] = $_SERVER['SERVER_NAME'];






}


/**
 *  смена статуса заказа после оплаты
 */
/*
AddEventHandler("sale", "OnSalePayOrder", "ChangeStatus");

function ChangeStatus($id,$val) {



    CSaleOrder::StatusOrder($id, 'P');
}
*/


