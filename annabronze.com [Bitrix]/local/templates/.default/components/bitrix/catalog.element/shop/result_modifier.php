<?if(is_array($arResult["OFFERS"]) && !empty($arResult["OFFERS"]))
{
	$basePriceType = CCatalogGroup::GetBaseGroup();
	$basePriceTypeName = $basePriceType["NAME"];

	$arOffersIblock = CIBlockPriceTools::GetOffersIBlock($arResult["IBLOCK_ID"]);
	$OFFERS_IBLOCK_ID = is_array($arOffersIblock)? $arOffersIblock["OFFERS_IBLOCK_ID"]: 0;
	$dbOfferProperties = CIBlock::GetProperties($OFFERS_IBLOCK_ID, Array(), Array("!XML_ID" => "CML2_LINK"));
	$arIblockOfferProps = array();
	$offerPropsExists = false;
	while($arOfferProperties = $dbOfferProperties->Fetch())
	{
		if (!in_array($arOfferProperties["CODE"],$arParams["OFFERS_PROPERTY_CODE"]))
			continue;
		$arIblockOfferProps[] = array("CODE" => $arOfferProperties["CODE"], "NAME" => $arOfferProperties["NAME"]);
		$offerPropsExists = true;
	}
	
	$arOfferIDs = array();
	foreach($arResult["OFFERS"] as $arOffer) { $arOfferIDs[] = $arOffer["ID"]; }
	$dbRes = CIBlockElement::GetList(Array("SORT"=>"ASC"),Array("ID"=>$arOfferIDs),false,false, Array("ID", "NAME"));
	while ($res=$dbRes->GetNext())
	{	
		foreach($arResult["OFFERS"] as $key=>$arOffer) 
		{ 
			if ($res["ID"]==$arOffer["ID"]) 
			{ 
				$arResult["OFFERS"][$key]["NAME"] = $res["NAME"]; 
			}
		}
	}
	

	$notifyOption = COption::GetOptionString("sale", "subscribe_prod", "");
	$arNotify = unserialize($notifyOption);

	$arSku = array();
	$arResult["OFFERS_CATALOG_QUANTITY"] = 0;
	foreach($arResult["OFFERS"] as $arOffer)
	{		
		$arResult["OFFERS_CATALOG_QUANTITY"]  += $arOffer["CATALOG_QUANTITY"];
        foreach($arOffer["PRICES"] as $code=>$arPrice)
        {
            if($arPrice["CAN_ACCESS"])
            {
                if ($arPrice["DISCOUNT_VALUE"] < $arPrice["VALUE"])
                {
                    $minOfferPrice = $arPrice["DISCOUNT_VALUE"];
                    $minOfferPriceFormat = $arPrice["PRINT_DISCOUNT_VALUE"];
                }
                else
                {
                    $minOfferPrice = $arPrice["VALUE"];
                    $minOfferPriceFormat = $arPrice["PRINT_VALUE"];
                }

                if ($minItemPrice > 0 && $minOfferPrice < $minItemPrice)
                {
                    $minItemPrice = $minOfferPrice;
                    $minItemPriceFormat = $minOfferPriceFormat;
                }
                elseif ($minItemPrice == 0)
                {
                    $minItemPrice = $minOfferPrice;
                    $minItemPriceFormat = $minOfferPriceFormat;
                }
            }
        }
		$arSkuTmp = array();
		
		if ($arParams["SKU_SHOW_PICTURES"]=="Y")
		{
			if ($arOffer["PREVIEW_PICTURE"])
			{
				$arSkuTmp["PREVIEW_PICTURE"] = CFile::GetFileArray($arOffer["PREVIEW_PICTURE"]);
			}
			elseif ($arOffer["DETAIL_PICTURE"])
			{
				$arSkuTmp["DETAIL_PICTURE"] = CFile::GetFileArray($arOffer["DETAIL_PICTURE"]);
			}	
		}
		
		$arSkuTmp["NAME"] = $arOffer["NAME"];
		$arSkuTmp["CATALOG_MEASURE"] = $arOffer["CATALOG_MEASURE"];
		$arSkuTmp["CATALOG_QUANTITY"] = $arOffer["CATALOG_QUANTITY"];
		if ($offerPropsExists)
		{
			foreach($arIblockOfferProps as $key => $arCode)
			{
				if (!array_key_exists($arCode["CODE"], $arOffer["PROPERTIES"]))
				{
					$arSkuTmp[] = GetMessage("EMPTY_VALUE_SKU");
					continue;
				}
				if (empty($arOffer["PROPERTIES"][$arCode["CODE"]]["VALUE"]))
					$arSkuTmp[] = GetMessage("EMPTY_VALUE_SKU");
				elseif (is_array($arOffer["PROPERTIES"][$arCode["CODE"]]["VALUE"]))
					$arSkuTmp[] = implode("/", $arOffer["PROPERTIES"][$arCode["CODE"]]["VALUE"]);
				else
					$arSkuTmp[] = $arOffer["PROPERTIES"][$arCode["CODE"]]["VALUE"];
			}
		}
		else
		{
			if (in_array("NAME", $arParams["OFFERS_FIELD_CODE"]))
				$arSkuTmp[] = $arOffer["NAME"];
			else
				break;
		}
		$arSkuTmp["ID"] = $arOffer["ID"];
		if (is_array($arOffer["PRICES"][$basePriceTypeName]))
		{
			if ($arOffer["PRICES"][$basePriceTypeName]["DISCOUNT_VALUE"] < $arOffer["PRICES"][$basePriceTypeName]["VALUE"])
			{
				$arSkuTmp["PRICE"] = $arOffer["PRICES"][$basePriceTypeName]["PRINT_VALUE"];
				$arSkuTmp["DISCOUNT_PRICE"] = $arOffer["PRICES"][$basePriceTypeName]["PRINT_DISCOUNT_VALUE"];
			}
			else
			{
				$arSkuTmp["PRICE"] = $arOffer["PRICES"][$basePriceTypeName]["PRINT_VALUE"];
				$arSkuTmp["DISCOUNT_PRICE"] = "";
			}
		}
		if (CModule::IncludeModule('sale'))
		{
			$dbBasketItems = CSaleBasket::GetList(
				array(
					"ID" => "ASC"
				),
				array(
					"PRODUCT_ID" => $arOffer['ID'],
					"FUSER_ID" => CSaleBasket::GetBasketUserID(),
					"LID" => SITE_ID,
					"ORDER_ID" => "NULL",
				),
				false,
				false,
				array()
			);
			$arSkuTmp["CART"] = "";
			if ($arBasket = $dbBasketItems->Fetch())
			{
				if($arBasket["DELAY"] == "Y")
					$arSkuTmp["CART"] = "delay";
				elseif ($arBasket["SUBSCRIBE"] == "Y" &&  $arNotify[SITE_ID]['use'] == 'Y')
					$arSkuTmp["CART"] = "inSubscribe";
				else
					$arSkuTmp["CART"] = "inCart";
			}
		}
		$arSkuTmp["CAN_BUY"] = $arOffer["CAN_BUY"];
		$arSkuTmp["ADD_URL"] = htmlspecialcharsback($arOffer["ADD_URL"]);
		$arSkuTmp["SUBSCRIBE_URL"] = htmlspecialcharsback($arOffer["SUBSCRIBE_URL"]);
		$arSkuTmp["COMPARE"] = "";
		if (isset($_SESSION[$arParams["COMPARE_NAME"]][$arParams["IBLOCK_ID"]]["ITEMS"][$arOffer["ID"]]))
			$arSkuTmp["COMPARE"] = "inCompare";
		$arSkuTmp["COMPARE_URL"] = htmlspecialcharsback($arOffer["COMPARE_URL"]);
		$arSku[] = $arSkuTmp;
	}
	
    $arResult["MIN_PRODUCT_OFFER_PRICE"] = $minItemPrice;
    $arResult["MIN_PRODUCT_OFFER_PRICE_PRINT"] = $minItemPriceFormat;


	if ((!is_array($arIblockOfferProps) || empty($arIblockOfferProps)) && is_array($arSku) && !empty($arSku))
		$arIblockOfferProps[] = array("CODE" => "TITLE", "NAME" => GetMessage("CATALOG_OFFER_NAME"));
	$arResult["SKU_ELEMENTS"] = $arSku;
	$arResult["SKU_PROPERTIES"] = $arIblockOfferProps;
}

if ($arParams['USE_COMPARE'])
{
	$delimiter = strpos($arParams['COMPARE_URL'], '?') ? '&' : '?';

	//$arResult['COMPARE_URL'] = str_replace("#ACTION_CODE#", "ADD_TO_COMPARE_LIST",$arParams['COMPARE_URL']).$delimiter."id=".$arResult['ID'];

	$arResult['COMPARE_URL'] = htmlspecialcharsbx($APPLICATION->GetCurPageParam("action=ADD_TO_COMPARE_LIST&id=".$arResult['ID'], array("action", "id")));
}

if ($arParams["SHOW_KIT_PARTS"]=="Y")
{
	//const TYPE_SET = 1;
	//const TYPE_GROUP = 2;
	$arSetItems = array();
	$arResult["SET_ITEMS_IDS"] = array();
	foreach(CCatalogProductSet::getAllSetsByProduct($arResult["ID"], 1) as $key => $set) { foreach($set["ITEMS"] as $i=>$val) { $arSetItems[] = $val["ITEM_ID"]; } }
	
	$arResultPrices = CIBlockPriceTools::GetCatalogPrices($arParams["IBLOCK_ID"], $arParams["PRICE_CODE"]);
	
	$arSelect = Array("ID", "IBLOCK_ID", "NAME", "DETAIL_PAGE_URL", "PREVIEW_PICTURE", "DETAIL_PICTURE");
	foreach($arResultPrices as &$value)
	{
		if ($value['CAN_VIEW'] && $value['CAN_BUY']) { $arSelect[] = $value["SELECT"]; }
	}
	if (!empty($arSetItems))
	{
		$db_res = CIBlockElement::GetList(Array("SORT"=>"ASC"), Array("ID"=>$arSetItems), false, false, $arSelect);
		while ($res = $db_res->GetNext()) { $arResult["SET_ITEMS"][] = $res; }
		
	}
		
	$arConvertParams = array();
	if ('Y' == $arParams['CONVERT_CURRENCY'])
	{
		if (!CModule::IncludeModule('currency'))
		{
			$arParams['CONVERT_CURRENCY'] = 'N';
			$arParams['CURRENCY_ID'] = '';
		}
		else
		{
			$arResultModules['currency'] = true;
			$arCurrencyInfo = CCurrency::GetByID($arParams['CURRENCY_ID']);
			if (!(is_array($arCurrencyInfo) && !empty($arCurrencyInfo)))
			{
				$arParams['CONVERT_CURRENCY'] = 'N';
				$arParams['CURRENCY_ID'] = '';
			}
			else
			{
				$arParams['CURRENCY_ID'] = $arCurrencyInfo['CURRENCY'];
				$arConvertParams['CURRENCY_ID'] = $arCurrencyInfo['CURRENCY'];
			}
		}
	}
	
	$bCatalog = CModule::IncludeModule('catalog');
	
	foreach($arResult["SET_ITEMS"] as $key => $setItem)
	{
		if($arParams["USE_PRICE_COUNT"])
		{
			if($bCatalog)
			{
				$arResult["SET_ITEMS"][$key]["PRICE_MATRIX"] = CatalogGetPriceTableEx($arResult["SET_ITEMS"][$key]["ID"], 0, $arPriceTypeID, 'Y', $arConvertParams);
				foreach($arResult["SET_ITEMS"][$key]["PRICE_MATRIX"]["COLS"] as $keyColumn=>$arColumn)
					$arResult["SET_ITEMS"][$key]["PRICE_MATRIX"]["COLS"][$keyColumn]["NAME_LANG"] = htmlspecialcharsbx($arColumn["NAME_LANG"]);
			}
		}
		else
		{
			$arResult["SET_ITEMS"][$key]["PRICES"] = CIBlockPriceTools::GetItemPrices($arParams["IBLOCK_ID"], $arResultPrices, $arResult["SET_ITEMS"][$key], $arParams['PRICE_VAT_INCLUDE'], $arConvertParams);
			if (!empty($arResult["SET_ITEMS"][$key]["PRICES"]))
			{
				foreach ($arResult["SET_ITEMS"][$key]['PRICES'] as &$arOnePrice)
				{ if ('Y' == $arOnePrice['MIN_PRICE']) { $arResult["SET_ITEMS"][$key]['MIN_PRICE'] = $arOnePrice; break;} }
				unset($arOnePrice);
			}

		}

		if (($arParams["SHOW_MEASURE"]=="Y")&&($setItem["CATALOG_MEASURE"]))
		{ 
			$arResult["SET_ITEMS"][$key]["MEASURE"] = CCatalogMeasure::getList(array(), array("ID"=>$setItem["CATALOG_MEASURE"]), false, false, array())->GetNext(); 			
		}

	}
	
	
}
$iblock_id;
if(SITE_DIR == "/")
    $iblock_id = LIST_CITIES_IBLOCK_ID;
else $iblock_id = LIST_CITIES_IBLOCK_ID_EN;
if(!CModule::IncludeModule("iblock"))
    return;

$res = CIBlockElement::GetList(
    Array(),
    Array("IBLOCK_ID"=>$iblock_id, "ACTIVE"=>"Y"),
    false,
    false,
    Array("ID", "IBLOCK_ID", "PROPERTY_STOREHOUSES", "NAME")
);

while($ob = $res->GetNextElement())
{
    $arFields = $ob->GetFields();
    if($arFields["NAME"] == $_SESSION["CITY_ID"])
    {
        $arResult["DEFAULT_STOREHOUSE"][$arFields["PROPERTY_STOREHOUSES_VALUE"]]["ID"] = $arFields["PROPERTY_STOREHOUSES_VALUE"];
    }
    else
    {
        $arResult["OTHER_STOREHOUSE"][$arFields["PROPERTY_STOREHOUSES_VALUE"]]["ID"] = $arFields["PROPERTY_STOREHOUSES_VALUE"];
    }
}
if (!CModule::IncludeModule("catalog"))
    return;

$db_store = CCatalogStoreProduct::GetList(
    Array(),
    Array("PRODUCT_ID"=>$arResult["ID"], "ACTIVE"=>"Y", ">AMOUNT" => 0),
    false,
    false,
    Array("ID", "AMOUNT", "STORE_ID", "STORE_NAME", "STORE_ADDR")
);
while($arStore = $db_store->Fetch())
{
    if(is_array($arResult["DEFAULT_STOREHOUSE"][$arStore["STORE_ID"]]))
    {
        if(!is_array($arResult["ENABLE_PRODUCTS"]))
            $arResult["ENABLE_PRODUCTS"] = "Y";
        $arResult["DEFAULT_STOREHOUSE"][$arStore["STORE_ID"]]["ADDR"] = $arStore["STORE_ADDR"];
        $arResult["DEFAULT_STOREHOUSE"][$arStore["STORE_ID"]]["COUNT"] = $arStore["AMOUNT"];
    }
    else if(is_array($arResult["OTHER_STOREHOUSE"][$arStore["STORE_ID"]]))
    {
        $arResult["OTHER_STOREHOUSE"][$arStore["STORE_ID"]]["ADDR"] = $arStore["STORE_ADDR"];
        $arResult["OTHER_STOREHOUSE"][$arStore["STORE_ID"]]["COUNT"] = $arStore["AMOUNT"];
    }
}


/*echo '<pre>'; print_r($arResult["OTHER_STOREHOUSE"]); echo '</pre>';
echo '<pre>'; print_r($arResult["DEFAULT_STOREHOUSE"]); echo '</pre>';*/
$cp = $this->__component;
if (is_object($cp))
{
	$cp->arResult["SECTION_FULL"] =$db_res;
	$cp->SetResultCacheKeys("SECTION_FULL");
}

if(LANGUAGE_ID==='en'){
	$colorProperty = BX_IBLOCK_OFFERS_PROPERTY_COLOR_EN;
}else{
	$colorProperty = BX_IBLOCK_OFFERS_PROPERTY_COLOR_RU;
}

unset($arrOffersTmp);

foreach($arResult["OFFERS"] as $k => $v){

	$ar_price = GetCatalogProductPrice($v["ID"], 1);

	if(empty($ar_price["PRICE"])){ continue; }

	if($v["ID"] == $_GET["offer"]){
		$arResult["ACTIVE_OFFER_NUMBER"] = $k;

	}



	$db_props = CIBlockElement::GetProperty($v["IBLOCK_ID"], $v["ID"], array("sort" => "asc"), Array("CODE"=>$colorProperty));
	if($ar_props = $db_props->Fetch())
		$COLOR = $ar_props["VALUE"];

	$arCatalogColors = Helper::getCatalogColors();


	$arResult["OFFERS"][$k]["COLOR"]=$COLOR;
	$arResult["OFFERS"][$k]["COLOR_INDEX"]=$arCatalogColors[$COLOR];



	$res = CIBlock::GetProperties($v["IBLOCK_ID"]);
	while($res_arr = $res->Fetch()) {

		if ($res_arr['CODE'] == $colorProperty) {//"ID" => $arOffer["ID"],
			$property_enums = CIBlockPropertyEnum::GetList(Array("DEF" => "DESC", "SORT" => "ASC"), Array("IBLOCK_ID" => $v["IBLOCK_ID"], "CODE" => $colorProperty));

			while ($enum_fields = $property_enums->GetNext()) {

				if($enum_fields["ID"]==$COLOR){
					$arResult["OFFERS"][$k]["COLOR_NAME"]=$enum_fields["VALUE"];
					break;
				}

			}
			break;
		}

	}

	/*
	$arOffer["COLOR"]=$COLOR;
	$arOffer["COLOR_INDEX"]=$GLOBALS['CATALOG_COLORS'][$arOffer["COLOR"]];

	if($arOffer["COLOR_INDEX"]==$arParams["COLOR_FILTER_COLOR_NUMBER"]){
		$log=1;
	}
	*/


	$db_props = CIBlockElement::GetProperty($v["IBLOCK_ID"], $v["ID"], array("sort" => "asc"), Array("CODE"=> "MORE_PHOTO"));
	while ($ar_props = $db_props->Fetch()){

		$arResult["OFFERS"][$k]["PROPERTIES"]["MORE_PHOTO"]["VALUE"][] = $ar_props["VALUE"];
	}



	$db_props = CIBlockElement::GetProperty($v["IBLOCK_ID"], $v["ID"], array("sort" => "asc"), Array("CODE"=> "CML2_ATTRIBUTES"));
	while ($ar_props = $db_props->Fetch()){
        //Тут немного кастыльно и надо бы решать это со стороны 1С, но времени нет)

        if($ar_props["DESCRIPTION"] == "Color" && LANG != 'en'
            || $ar_props["DESCRIPTION"] == "Цвет" && LANG == 'en'){

        }else{
            $ar_props["DESCRIPTION"] = HackTranslater::getWord($ar_props["DESCRIPTION"]);
            $arResult["OFFERS"][$k]["PROPERTIES"]["CML2_ATTRIBUTES"][] = $ar_props;
        }


		//$arResult["OFFERS"][$k]["PROPERTIES"]["MORE_PHOTO"]["VALUE"][] = $ar_props["VALUE"];
	}

	$arResult["OFFERS"][$k]["DETAIL_PAGE_URL"] = $arResult["DETAIL_PAGE_URL"]."?offer=".$v["ID"];

	if (!empty($arResult["DETAIL_TEXT"])):
		$previewTextSocial = $arResult["DETAIL_TEXT"];
	else:
		$previewTextSocial = $arResult["PREVIEW_TEXT"];
	endif;

	$arResult["OFFERS"][$k]["PREVIEW_TEXT_SOCIAL"] = $previewTextSocial;




	$QUANTITY = 0;


	//узнать активный склад
	//$activeStoreId = Helper::getStore();

	$activeStoreId = Helper::getStoreDefault();

	//if($activeStoreId != 0){
		$obStoreOffer = CCatalogStoreProduct::GetList(array(), array('STORE_ID' => $activeStoreId, 'PRODUCT_ID' => $v['ID']), false,false,array());
	//}else{
	//	$obStoreOffer = CCatalogStoreProduct::GetList(array(), array('PRODUCT_ID' =>$v['ID']), false,false,array());
	//}

	if($arStore = $obStoreOffer->Fetch()){
		$QUANTITY = $arStore['AMOUNT'];
	}

	$arResult["OFFERS"][$k]["CATALOG_QUANTITY"] = $QUANTITY;


	//зануление доступного количества, если оно <0
	if($arResult["OFFERS"][$k]["CATALOG_QUANTITY"] < 0){
		$arResult["OFFERS"][$k]["CATALOG_QUANTITY"] = 0;
	}

	if(LANGUAGE_ID==='en') {
		$weightDescription = BX_CATALOG_DETAIL_ATTRIBUTE_WEIGHT_DESCRIPTION_EN;
	}else{
		$weightDescription = BX_CATALOG_DETAIL_ATTRIBUTE_WEIGHT_DESCRIPTION_RU;
	}

	unset($arAttributesTmp);
	foreach($arResult["OFFERS"][$k]["PROPERTIES"]["CML2_ATTRIBUTES"] as $keyAttr => $itemAttr){
	
		if($itemAttr["DESCRIPTION"] != $weightDescription){
			$arAttributesTmp[] = $arResult["OFFERS"][$k]["PROPERTIES"]["CML2_ATTRIBUTES"][$keyAttr];
		}
	}

	$arResult["OFFERS"][$k]["PROPERTIES"]["CML2_ATTRIBUTES"] = $arAttributesTmp;


	$arrOffersTmp[$k] = $arResult["OFFERS"][$k];

}


//echo "<pre>";
//print_r($arResult["OFFERS"]);
//echo "</pre>";

//$arrOffersTmp = array_msort($arResult["OFFERS"], array('COLOR_INDEX'=>SORT_ASC));//'COLOR'=>SORT_ASC
$arrOffersTmp = array_msort($arrOffersTmp, array('COLOR_INDEX'=>SORT_ASC));//'COLOR'=>SORT_ASC

$arResult["OFFERS"] = $arrOffersTmp;



?>