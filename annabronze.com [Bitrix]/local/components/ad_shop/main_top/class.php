<?
if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();

use Bitrix\Main;
use Bitrix\Main\Localization\Loc as Loc;

class MainTopComponent extends CBitrixComponent
{
	/**
	 * кешируемые ключи arResult
	 * @var array()
	 */
	protected $cacheKeys = array();
	
	/**
	 * дополнительные параметры, от которых должен зависеть кеш
	 * @var array
	 */
	protected $cacheAddon = array();
	
	/**
	 * парамтеры постраничной навигации
	 * @var array
	 */
	protected $navParams = array();

    /**
     * вохвращаемые значения
     * @var mixed
     */
	protected $returned;

    /**
     * тегированный кеш
     * @var mixed
     */
    protected $tagCache;
	
	/**
	 * подключает языковые файлы
	 */
	public function onIncludeComponentLang()
	{
		$this->includeComponentLang(basename(__FILE__));
		Loc::loadMessages(__FILE__);
	}
	
    /**
     * подготавливает входные параметры
     * @param array $arParams
     * @return array
     */
    public function onPrepareComponentParams($params)
    {
        $result = array(
            'IBLOCK_TYPE' => trim($params['IBLOCK_TYPE']),
            'IBLOCK_ID' => intval($params['IBLOCK_ID']),
            'COUNT' => intval($params['COUNT']),
            'CACHE_TIME' => intval($params['CACHE_TIME']) > 0 ? intval($params['CACHE_TIME']) : 3600,
			'CACHE_TAG_OFF' => $params['CACHE_TAG_OFF'] == 'Y'
        );
        return $result;
    }
	
	/**
	 * определяет читать данные из кеша или нет
	 * @return bool
	 */
	protected function readDataFromCache()
	{
		global $USER;
		if ($this->arParams['CACHE_TYPE'] == 'N')
			return false;

		if (is_array($this->cacheAddon))
			$this->cacheAddon[] = $USER->GetUserGroupArray();
		else
			$this->cacheAddon = array($USER->GetUserGroupArray());


		$this->cacheAddon[] = mt_rand();


		return !($this->startResultCache(false, $this->cacheAddon, md5(serialize($this->arParams))));
	}

	/**
	 * кеширует ключи массива arResult
	 */
	protected function putDataToCache()
	{
		if (is_array($this->cacheKeys) && sizeof($this->cacheKeys) > 0)
		{
			$this->SetResultCacheKeys($this->cacheKeys);
		}
	}

	/**
	 * прерывает кеширование
	 */
	protected function abortDataCache()
	{
		$this->AbortResultCache();
	}

    /**
     * завершает кеширование
     * @return bool
     */
    protected function endCache()
    {
        if ($this->arParams['CACHE_TYPE'] == 'N')
            return false;

        $this->endResultCache();
    }
	
	/**
	 * проверяет подключение необходиимых модулей
	 * @throws LoaderException
	 */
	protected function checkModules()
	{
		if (!Main\Loader::includeModule('iblock'))
			throw new Main\LoaderException(Loc::getMessage('MAIN_TOP_CLASS_IBLOCK_MODULE_NOT_INSTALLED'));
	}
	
	/**
	 * проверяет заполнение обязательных параметров
	 * @throws SystemException
	 */
	protected function checkParams()
	{
		if ($this->arParams['IBLOCK_ID'] <= 0 && strlen($this->arParams['IBLOCK_CODE']) <= 0)
			throw new Main\ArgumentNullException('IBLOCK_ID');
	}
	
	/**
	 * выполяет действия перед кешированием 
	 */

	protected function executeProlog()
	{
/*
		if ($this->arParams['COUNT'] > 0)
		{

				$this->navParams = array(	
					'nTopCount' => $this->arParams['COUNT']
				);
			
		}
		else
			$this->navParams = false;
*/
	}

    /**
     * Определяет ID инфоблока по коду, если не был задан
     */
	protected function getIblockId()
    {
        if ($this->arParams['IBLOCK_ID'] <= 0)
        {
            if (class_exists('Settings'))
            {
                $this->arParams['IBLOCK_ID'] = \SiteSettings::getInstance()->getIblockId($this->arParams['IBLOCK_CODE']);
                if ($this->arParams['IBLOCK_ID'] && $this->arParams['CACHE_TAG_OFF'])
                    \CIBlock::disableTagCache($this->arParams['IBLOCK_ID']);
            }
        }

        if ($this->arParams['IBLOCK_ID'] <= 0)
        {
            $sort = array(
                'id' => 'asc'
            );
            $filter = array(
                'TYPE' => $this->arParams['IBLOCK_TYPE'],
                'CODE' => $this->arParams['IBLOCK_CODE']
            );
            $iterator = \CIBlock::GetList($sort, $filter);
            if ($iblock = $iterator->GetNext())
                $this->arParams['IBLOCK_ID'] = $iblock['ID'];
            else
            {
                $this->abortDataCache();
                throw new Main\ArgumentNullException('IBLOCK_ID');
            }
        }
        $this->arResult['IBLOCK_ID'] = $this->arParams['IBLOCK_ID'];
        $this->cacheKeys[] = 'IBLOCK_ID';
    }

	/**
	 * получение результатов
	 */
	protected function getResult()
	{


		$CATALOG_COLORS=Helper::getCatalogColors();


		unset($arResult["ITEMS"]);

		$rsProducts = CIBlockElement::GetList(array("RAND"=>"ASC"),
			array('IBLOCK_ID' => $this->arParams['IBLOCK_ID'], "PROPERTY_HOME_VALUE" => "yes"), false,
			Array("nPageSize"=> $this->arParams['COUNT']), Array());//, Array("nPageSize"=>8)
		while ($rsProduct = $rsProducts->GetNext()){

			$arResult["ITEMS"][] = $rsProduct;

		}


		CModule::IncludeModule("sale");

		$lastRandomOffer=0;

		if(LANG == "en"){
			$arColorsTop = unserialize(BX_IBLOCK_CATALOG_COLORS_TOP_ARRAY_EN);
		}else{
			$arColorsTop = unserialize(BX_IBLOCK_CATALOG_COLORS_TOP_ARRAY_RU);
		}

		foreach($arResult["ITEMS"] as $cell=>$arElement)
		{


			$intIBlockID = $arElement["IBLOCK_ID"];


			$mxResult = CCatalogSKU::GetInfoByProductIBlock(
				$intIBlockID
			);

			$IBLOCK_ID = $intIBlockID;


			if (is_array($mxResult)) {
				$rsOffers = CIBlockElement::GetList(array("PRICE" => "ASC"), array('IBLOCK_ID' => $mxResult['IBLOCK_ID'], 'PROPERTY_' . $mxResult['SKU_PROPERTY_ID'] => $arElement["ID"]));
			}


			if(CCatalogSKU::IsExistOffers($arElement["ID"], $intIBlockID))
			{



				$rsOffers = CIBlockElement::GetList(array("PRICE"=>"ASC"),array('IBLOCK_ID' => $mxResult['IBLOCK_ID'], 'PROPERTY_'.$mxResult['SKU_PROPERTY_ID'] => $arElement["ID"]));

				unset($arResult["ITEMS"][$cell]["OFFERS"]);
				//список цветов для каждого товара
				$countOffers = 0;
				while ($arOffer = $rsOffers->GetNext()){

					$arOffer["QUANTITY"] = 0;
					$activeStoreId = Helper::getStoreDefault();

					$obStoreOffer = CCatalogStoreProduct::GetList(array(), array('STORE_ID' =>$activeStoreId, 'PRODUCT_ID' =>$arOffer['ID']), false,false,array());

					if($arStore = $obStoreOffer->Fetch()){
						$arOffer["QUANTITY"] = $arStore['AMOUNT'];
					}


					//зануляем доступное количество, если оно <0
					if($arOffer["QUANTITY"] < 0){ $arOffer["QUANTITY"] = 0; }



                    $propCode = "TSVET";
                    if(LANG == "en")
                        $propCode = "COLOR";

					$db_props = CIBlockElement::GetProperty($arOffer["IBLOCK_ID"], $arOffer["ID"], array("sort" => "asc"), Array("CODE"=>$propCode));
					if($ar_props = $db_props->Fetch()){
                        //print_r($arOffer);
                        //print_r($ar_props);
						$COLOR = $ar_props["VALUE"];

					}

					$arOffer["COLOR"]=$COLOR;



					$arOffer["COLOR_INDEX"]=$CATALOG_COLORS[$arOffer["COLOR"]];


					$res = CIBlock::GetProperties($IBLOCK_ID);
					while($res_arr = $res->Fetch()) {

						if ($res_arr['CODE'] == "TSVET") {//"ID" => $arOffer["ID"],
							$property_enums = CIBlockPropertyEnum::GetList(Array("DEF" => "DESC", "SORT" => "ASC"), Array("IBLOCK_ID" => $IBLOCK_ID, "CODE" => "TSVET"));

							while ($enum_fields = $property_enums->GetNext()) {

								if($enum_fields["ID"]==$arOffer["COLOR"]){
									$arOffer["COLOR_NAME"]=$enum_fields["VALUE"];
									break;
								}

							}
							break;
						}

					}



					//цена торгового предложения
					$ar_price = GetCatalogProductPrice($arOffer["ID"], 1);



					$arOffer["PRICE"] = $ar_price["PRICE"];

					$arOffer["PRICE_PRINT"] = SaleFormatCurrency($ar_price["PRICE"], $ar_price["CURRENCY"]);

					$MORE_PHOTO="";
					$db_props = CIBlockElement::GetProperty($arOffer["IBLOCK_ID"], $arOffer["ID"], array("sort" => "asc"), Array("CODE"=>"MORE_PHOTO"));
					if($ar_props = $db_props->Fetch()){
						$MORE_PHOTO = $ar_props["VALUE"];
					}

					$PREVIEW_PICTURE=CFile::GetFileArray($arOffer["PREVIEW_PICTURE"]);
					$DETAIL_PICTURE=CFile::GetFileArray($arOffer["DETAIL_PICTURE"]);
					$MORE_PHOTO=CFile::GetFileArray($MORE_PHOTO);



					if(!empty($PREVIEW_PICTURE)){
						$renderImage = CFile::ResizeImageGet($PREVIEW_PICTURE, Array("width" => 250, "height" => 250));
						$arOffer["PICTURE"] = $renderImage['src'];

						$renderImagePopup = CFile::ResizeImageGet($PREVIEW_PICTURE, Array("width" => 298, "height" => 286), BX_RESIZE_IMAGE_EXACT);
						$arOffer["PICTURE_POPUP"] = $renderImagePopup['src'];

					}else if(!empty($DETAIL_PICTURE)){
						$renderImage = CFile::ResizeImageGet($DETAIL_PICTURE, Array("width" => 250, "height" => 250));
						$arOffer["PICTURE"] = $renderImage['src'];

						$renderImagePopup = CFile::ResizeImageGet($DETAIL_PICTURE, Array("width" => 298, "height" => 286), BX_RESIZE_IMAGE_EXACT);
						$arOffer["PICTURE_POPUP"] = $renderImagePopup['src'];

					}else if(!empty($MORE_PHOTO)){
						$renderImage = CFile::ResizeImageGet($MORE_PHOTO, Array("width" => 250, "height" => 250));
						$arOffer["PICTURE"] = $renderImage['src'];

						$renderImagePopup = CFile::ResizeImageGet($MORE_PHOTO, Array("width" => 298, "height" => 286), BX_RESIZE_IMAGE_EXACT);
						$arOffer["PICTURE_POPUP"] = $renderImagePopup['src'];

					}else{
						$arOffer["PICTURE"] = BX_DEFAULT_NO_PHOTO_IMAGE;
						$arOffer["PICTURE_POPUP"] = BX_DEFAULT_NO_PHOTO_IMAGE;
					}


					$arOffer["IN_BASKET"]="N";
					$arOffer["QUANTITY_IN_BASKET"]="0";


					//проверка, есть ли торговое предложение в корзине
					$dbBasketItems = CSaleBasket::GetList(
						array("NAME" => "ASC","ID" => "ASC"),
						array("FUSER_ID" => CSaleBasket::GetBasketUserID(), "LID" => SITE_ID, "ORDER_ID" => "NULL"),
						false,
						false,
						array("ID","MODULE","PRODUCT_ID","QUANTITY","CAN_BUY","PRICE"));
					while ($arItemsBasket=$dbBasketItems->Fetch())
					{


						if($arItemsBasket["PRODUCT_ID"] == $arOffer["ID"]){
							$arOffer["IN_BASKET"]="Y";
							$arOffer["QUANTITY_IN_BASKET"]=$arItemsBasket["QUANTITY"];
							break;
						}

					}


					$arResult["ITEMS"][$cell]["OFFERS"][]=$arOffer;
					$countOffers++;

				}


				$iTmp=0;
				while(1){

					$randomOffer=mt_rand(0, $countOffers-1);
					
					if(in_array($arResult["ITEMS"][$cell]["OFFERS"][$randomOffer]["COLOR"], $arColorsTop)){
						break;
					}

					if($iTmp > 15) break;
					$iTmp++;
				}



				$lastRandomOffer=$arResult["ITEMS"][$cell]["OFFERS"][$randomOffer]["COLOR_INDEX"];


				//$PREVIEW_PICTURE=CFile::GetFileArray($arResult["ITEMS"][$cell]["OFFERS"][$randomOffer]["PREVIEW_PICTURE"]);

				$PICTURE="";
				$MORE_PHOTO="";

				$db_props = CIBlockElement::GetProperty($arResult["ITEMS"][$cell]["OFFERS"][$randomOffer]["IBLOCK_ID"],
					$arResult["ITEMS"][$cell]["OFFERS"][$randomOffer]["ID"], array("sort" => "asc"), Array("CODE"=>"MORE_PHOTO"));
				if($ar_props = $db_props->Fetch()){
					$MORE_PHOTO = $ar_props["VALUE"];
				}

				$PREVIEW_PICTURE=CFile::GetFileArray($arResult["ITEMS"][$cell]["OFFERS"][$randomOffer]["PREVIEW_PICTURE"]);
				$DETAIL_PICTURE=CFile::GetFileArray($arResult["ITEMS"][$cell]["OFFERS"][$randomOffer]["DETAIL_PICTURE"]);
				$MORE_PHOTO=CFile::GetFileArray($MORE_PHOTO);


				if(!empty($PREVIEW_PICTURE)){
					$renderImage = CFile::ResizeImageGet($PREVIEW_PICTURE, Array("width" => 250, "height" => 250));
					$PICTURE["SRC"] = $renderImage['src'];
				}else if(!empty($DETAIL_PICTURE)){
					$renderImage = CFile::ResizeImageGet($DETAIL_PICTURE, Array("width" => 250, "height" => 250));
					$PICTURE["SRC"] = $renderImage['src'];
				}else if(!empty($MORE_PHOTO)){
					$renderImage = CFile::ResizeImageGet($MORE_PHOTO, Array("width" => 250, "height" => 250));
					$PICTURE["SRC"] = $renderImage['src'];
				}else{
					$PICTURE["SRC"] = BX_DEFAULT_NO_PHOTO_IMAGE;
				}


				//подмена значений в товаре значениями из торгового предложения
				$arResult["ITEMS"][$cell]["NAME"]=$arResult["ITEMS"][$cell]["OFFERS"][$randomOffer]["NAME"];
				$arResult["ITEMS"][$cell]["PRICE"]=$arResult["ITEMS"][$cell]["OFFERS"][$randomOffer]["PRICE"];
				$arResult["ITEMS"][$cell]["PRICE_PRINT"]=$arResult["ITEMS"][$cell]["OFFERS"][$randomOffer]["PRICE_PRINT"];
				$arResult["ITEMS"][$cell]["PREVIEW_PICTURE"]=$PICTURE;
				$arResult["ITEMS"][$cell]["OFFER_ACTIVE_ID"]=$randomOffer;
				$arResult["ITEMS"][$cell]["OFFER_ACTIVE_INDEX"]=$arResult["ITEMS"][$cell]["OFFERS"][$randomOffer]["COLOR_INDEX"];
				$arResult["ITEMS"][$cell]["OFFER_ACTIVE_ID"]=$arResult["ITEMS"][$cell]["OFFERS"][$randomOffer]["ID"];
				$arResult["ITEMS"][$cell]["IN_BASKET"]=$arResult["ITEMS"][$cell]["OFFERS"][$randomOffer]["IN_BASKET"];



			}


		}




		$this->arResult['ITEMS'] = $arResult["ITEMS"];

	}
	
	/**
	 * выполняет действия после выполения компонента, например установка заголовков из кеша
	 */
	protected function executeEpilog()
	{
		if ($this->arResult['IBLOCK_ID'] && $this->arParams['CACHE_TAG_OFF'])
            \CIBlock::enableTagCache($this->arResult['IBLOCK_ID']);
	}
	
	/**
	 * выполняет логику работы компонента
	 */
	public function executeComponent()
	{
		global $APPLICATION;
		try
		{
			$this->checkModules();
			$this->checkParams();
			$this->executeProlog();
			if ($this->arParams['AJAX'] == 'Y')
				$APPLICATION->RestartBuffer();
			if (!$this->readDataFromCache())
			{
			    //$this->getIblockId();
				$this->getResult();
				$this->putDataToCache();
				$this->includeComponentTemplate();
			}
			$this->executeEpilog();

			if ($this->arParams['AJAX'] == 'Y')
				die();

			return $this->returned;
		}
		catch (Exception $e)
		{
			$this->abortDataCache();
			ShowError($e->getMessage());
		}
	}
}
?>