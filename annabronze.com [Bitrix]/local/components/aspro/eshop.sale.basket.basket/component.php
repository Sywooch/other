<?
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();

if (!CModule::IncludeModule("sale"))
{
	ShowError(GetMessage("SALE_MODULE_NOT_INSTALL"));
	return;
}




$arParams["PATH_TO_ORDER"] = Trim($arParams["PATH_TO_ORDER"]);
if (strlen($arParams["PATH_TO_ORDER"]) <= 0)
	$arParams["PATH_TO_ORDER"] = "order.php";

if($arParams["SET_TITLE"] == "Y")
	$APPLICATION->SetTitle(GetMessage("SBB_TITLE"));

if (!isset($arParams["COLUMNS_LIST"]) || !is_array($arParams["COLUMNS_LIST"]) || count($arParams["COLUMNS_LIST"]) <= 0)
	$arParams["COLUMNS_LIST"] = array("NAME", "PRICE", "TYPE", "QUANTITY", "DELETE", "DELAY", "WEIGHT");

$arParams["HIDE_COUPON"] = (($arParams["HIDE_COUPON"] == "Y") ? "Y" : "N");
if (!CModule::IncludeModule("catalog"))
	$arParams["HIDE_COUPON"] = "Y";

if (!isset($arParams['QUANTITY_FLOAT']))
	$arParams['QUANTITY_FLOAT'] = 'N';
$arParams["COUNT_DISCOUNT_4_ALL_QUANTITY"] = (($arParams["COUNT_DISCOUNT_4_ALL_QUANTITY"] == "Y") ? "Y" : "N");


//$arParams['PRICE_VAT_INCLUDE'] = $arParams['PRICE_VAT_INCLUDE'] == 'N' ? 'N' : 'Y';
$arParams['PRICE_VAT_SHOW_VALUE'] = $arParams['PRICE_VAT_SHOW_VALUE'] == 'N' ? 'N' : 'Y';
$arParams["USE_PREPAYMENT"] = $arParams["USE_PREPAYMENT"] == 'Y' ? 'Y' : 'N';

$arParams["WEIGHT_UNIT"] = htmlspecialcharsbx(COption::GetOptionString('sale', 'weight_unit', "", SITE_ID));
$arParams["WEIGHT_KOEF"] = htmlspecialcharsbx(COption::GetOptionString('sale', 'weight_koef', 1, SITE_ID));

//basketUpdate();

//$_REQUEST["BasketOrder"]=1;
if (strlen($_REQUEST["BasketRefresh"]) > 0 || strlen($_REQUEST["BasketOrder"]) > 0 || strlen($_REQUEST["action"]) > 0
	|| ($_COOKIE["isBasketRefresh"] == 1))
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
				//$basketItemsParameters = CCatalogProduct::GetByID($arBasketItems["PRODUCT_ID"]);
				//$basketItemsQuantity = $basketItemsParameters["QUANTITY"];


				//$arBasketItems['MAX_QUANTITY'] = $basketItemsQuantity;//доступное количество
				$QUANTITY = 0;


				//узнать активный склад
				//$activeStoreId = Helper::getStore();
				$activeStoreId = Helper::getStoreDefault();


				//if($activeStoreId != 0){
				$obStoreOffer = CCatalogStoreProduct::GetList(array(), array('STORE_ID' => $activeStoreId, 'PRODUCT_ID' => $arBasketItems["PRODUCT_ID"]), false,false,array());
				//}else{
				//	$obStoreOffer = CCatalogStoreProduct::GetList(array(), array('PRODUCT_ID' => $arBasketItems["PRODUCT_ID"]), false,false,array());
				//}

				if($arStore = $obStoreOffer->Fetch()){
					$QUANTITY = $arStore['AMOUNT'];
				}

				$arBasketItems['MAX_QUANTITY'] = $QUANTITY;
				$arItems['MAX_QUANTITY'] = $QUANTITY;



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
$oldSumAll = 0;

while ($arItems = $dbBasketItems->GetNext())
{


	$arItemsIDsForPhoto[] = $arItems["PRODUCT_ID"];
	$arItemsInBasketIDs[$arItems["PRODUCT_ID"]][] =  $arItems["ID"];

	$arItems['QUANTITY'] = $arParams['QUANTITY_FLOAT'] == 'Y' ? number_format(DoubleVal($arItems['QUANTITY']), 2, '.', '') : IntVal($arItems['QUANTITY']);

	//$basketItemsParameters = CCatalogProduct::GetByID($arItems["PRODUCT_ID"]);
	//$basketItemsQuantity = $basketItemsParameters["QUANTITY"];
	//$arItems['MAX_QUANTITY'] = $basketItemsQuantity;//доступное количество

	$QUANTITY = 0;


	//узнать активный склад
	//$activeStoreId = Helper::getStore();

	$activeStoreId = Helper::getStoreDefault();


	//if($activeStoreId != 0){
		$obStoreOffer = CCatalogStoreProduct::GetList(array(), array('STORE_ID' =>$activeStoreId, 'PRODUCT_ID' => $arItems["PRODUCT_ID"]), false,false,array());
	//}else{
	//	$obStoreOffer = CCatalogStoreProduct::GetList(array(), array('PRODUCT_ID' => $arItems["PRODUCT_ID"]), false,false,array());
	//}

	if($arStore = $obStoreOffer->Fetch()){
		$QUANTITY = $arStore['AMOUNT'];
	}


	$arBasketItems['MAX_QUANTITY'] = $QUANTITY;
	$arItems['MAX_QUANTITY'] = $QUANTITY;


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
		//$oldSumAll = $oldSumAll +


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

		CSaleBasket::Delete($arItems["ID"]);



		//$arResult["ITEMS"]["nAnCanBuy"][] = $arItems;
	}


	$allSumOld += ($arItems["FULL_PRICE"] * $arItems["QUANTITY"]);


	$arBasketItems[] = $arItems;
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



//--

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
	'COUNT_DISCOUNT_4_ALL_QUANTITY' => $arParams["COUNT_DISCOUNT_4_ALL_QUANTITY"],
);

$arErrors = array();

///////////////////////////////////////
///////////////////////////////////////

$couponDiscount = 0;
//узнать параметры применённого купона
$couponList = \Bitrix\Sale\DiscountCouponsManager::get(
	true,
	array(),
	false,
	false
);

if(!empty($couponList)){

	$arCouponDiscount = CCatalogDiscount::GetByID(current($couponList)["DISCOUNT_ID"]);
	$couponDiscount = intval($arCouponDiscount["VALUE"]);//скидка по купону

	//достать скидку правила работы с корзиной
	//$arDiscountsSaleTmp = \Bitrix\Sale\Internals\DiscountTable::getList();


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

                                                    if ($isOrderConverted == 'Y') {

                                                        if($discountSale == 0 && $discount["ACTIONS_LIST"]["CHILDREN"][0]["CLASS_ID"] == "ActSaleBsktGrp"
                                                            && $discount["ACTIONS_LIST"]["CHILDREN"][0]["DATA"]["Unit"] == "Perc"){
                                                            $discountSale = $discount["ACTIONS_LIST"]["CHILDREN"][0]["DATA"]["Value"];
                                                        }


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



	/******************************/
	//если скидка купона меньше скидки правила работы с корзиной, то применяем скидку правила
	if($couponDiscount < $discountSale){
		CSaleDiscount::DoProcessOrder($arOrder, $arOptions, $arErrors);
	}



}else{

	CSaleDiscount::DoProcessOrder($arOrder, $arOptions, $arErrors);

}


$allSum = 0;
$allWeight = 0;
$allVATSum = 0;

$DISCOUNT_PRICE_ALL = 0;





foreach ($arOrder['BASKET_ITEMS'] as &$arOneItem)
{

	//определить, какие товары имеют собственную скидку


	$arDiscounts = CCatalogDiscount::GetDiscountByProduct(
		$arOneItem["PRODUCT_ID"],
		$USER->GetUserGroupArray(),
		"N",
		2,
		SITE_ID
	);





		$mxResult = CCatalogSku::GetProductInfo(
			$arOneItem["PRODUCT_ID"]
		);
		if (is_array($mxResult)){
			//торговое предложение
			$PRODUCT_ID = $mxResult['ID'];
		}else{
			//не торговое предложение
			$PRODUCT_ID = $arOneItem["PRODUCT_ID"];
		}

	if(!empty($arDiscounts)){

		$maxTmp = 0;
		foreach($arDiscounts as $key => $value){
			if($value["VALUE"] > $maxTmp){
				$maxTmp = $value["VALUE"];
			}

		}


		CIBlockElement::SetPropertyValueCode($PRODUCT_ID, "IS_SALE", intval($maxTmp));
	}else{
		CIBlockElement::SetPropertyValueCode($PRODUCT_ID, "IS_SALE", "0");
	}






	$oldSumAll += ($arOneItem["BASE_PRICE"] * $arOneItem["QUANTITY"]);

	$allSum += ($arOneItem["PRICE"] * $arOneItem["QUANTITY"]);
	$allWeight += ($arOneItem["WEIGHT"] * $arOneItem["QUANTITY"]);
	if (array_key_exists('VAT_VALUE', $arOneItem))
		$arOneItem["PRICE_VAT_VALUE"] = $arOneItem["VAT_VALUE"];
	$allVATSum += roundEx($arOneItem["PRICE_VAT_VALUE"] * $arOneItem["QUANTITY"], SALE_VALUE_PRECISION);

//========================
	$arCurFormat = CCurrencyLang::GetCurrencyFormat($arOneItem["CURRENCY"]);

	$arCurFormat["FORMAT_STRING"];


	//$arOneItem["PRICE_FORMATED"] = str_replace("#", $arOneItem["PRICE"], $arCurFormat["FORMAT_STRING"]);
	$arOneItem["PRICE_FORMATED"] = SaleFormatCurrency($arOneItem["PRICE"], $arOneItem["CURRENCY"]);

//========================

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




$arResult["allSumOld_FORMATED"] = SaleFormatCurrency($oldSumAll, $allCurrency);

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

if($arParams["USE_PREPAYMENT"] == "Y")
{
	if(doubleval($arResult["allSum"]) > 0)
	{
		$personType = array();
		$dbPersonType = CSalePersonType::GetList(Array("SORT" => "ASC", "NAME" => "ASC"), Array("LID" => SITE_ID, "ACTIVE" => "Y"));
		while($arPersonType = $dbPersonType->GetNext())
		{
			$personType[] = $arPersonType["ID"];
		}

		if(!empty($personType))
		{
			$dbPaySysAction = CSalePaySystemAction::GetList(
				array(),
				array(
					"PS_ACTIVE" => "Y",
					"HAVE_PREPAY" => "Y",
					"PERSON_TYPE_ID" => $personType,
				),
				false,
				false,
				array("ID", "PAY_SYSTEM_ID", "PERSON_TYPE_ID", "NAME", "ACTION_FILE", "RESULT_FILE", "NEW_WINDOW", "PARAMS", "ENCODING", "LOGOTIP")
			);
			if ($arPaySysAction = $dbPaySysAction->Fetch())
			{
				CSalePaySystemAction::InitParamArrays(false, false, $arPaySysAction["PARAMS"]);

				$pathToAction = $_SERVER["DOCUMENT_ROOT"].$arPaySysAction["ACTION_FILE"];

				$pathToAction = str_replace("\\", "/", $pathToAction);
				while (substr($pathToAction, strlen($pathToAction) - 1, 1) == "/")
					$pathToAction = substr($pathToAction, 0, strlen($pathToAction) - 1);

				if (file_exists($pathToAction))
				{
					if (is_dir($pathToAction) && file_exists($pathToAction."/pre_payment.php"))
						$pathToAction .= "/pre_payment.php";

					include_once($pathToAction);
					$psPreAction = new CSalePaySystemPrePayment;
					if($psPreAction->init())
					{
						$orderData = array(
							"PATH_TO_ORDER" => $arParams["PATH_TO_ORDER"],
							"AMOUNT" => $arResult["allSum"],
						);
						if(!$psPreAction->BasketButtonAction($orderData))
						{
							if($e = $APPLICATION->GetException())
								$arResult["WARNING_MESSAGE"][] = $e->GetString();
						}

						$arResult["PREPAY_BUTTON"] = $psPreAction->BasketButtonShow();
					}
				}

			}
		}
	}
}




$this->IncludeComponentTemplate();
?>