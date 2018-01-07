<?
if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();

use Bitrix\Main;
use Bitrix\Main\Localization\Loc as Loc;

class SpecialProductComponent extends CBitrixComponent
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
            'CACHE_TIME' => intval($params['CACHE_TIME']) > 0 ? intval($params['CACHE_TIME']) : 3600,
			'AJAX' => $params['AJAX'] == 'N' ? 'N' : $_REQUEST['AJAX'] == 'Y' ? 'Y' : 'N',
			'FILTER' => is_array($params['FILTER']) && sizeof($params['FILTER']) ? $params['FILTER'] : array(),
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
			throw new Main\LoaderException(Loc::getMessage('SPECIAL_PRODUCT_CLASS_IBLOCK_MODULE_NOT_INSTALLED'));
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

		unset($arResult["ITEMS"]);

		$rsProducts = CIBlockElement::GetList(array("PRICE"=>"ASC"), array('IBLOCK_ID' => $this->arParams['IBLOCK_ID'], "PROPERTY_SPECIAL_VALUE" => "yes"), false, Array(), Array());//, Array("nPageSize"=>8)
		while ($rsProduct = $rsProducts->GetNext()){

			$arResult["ITEMS"][] = $rsProduct;

		}



		if(count($arResult["ITEMS"]) == 0){
			$ITEM = $arResult["ITEMS"][0];
		}else{
			//если спецпредложений несколько, то выбираем случайное
			$randNumber = mt_rand(0, count($arResult["ITEMS"])-1);
			$ITEM = $arResult["ITEMS"][$randNumber];
		}



		$res = CIBlockSection::GetByID($ITEM["IBLOCK_SECTION_ID"]);
		if($ar_res = $res->GetNext())
			$ITEM["COLLECTION"] = $ar_res['NAME'];



		CModule::IncludeModule("sale");

		$lastRandomOffer=0;



			$intIBlockID = $ITEM["IBLOCK_ID"];


			$mxResult = CCatalogSKU::GetInfoByProductIBlock(
				$intIBlockID
			);

			$IBLOCK_ID = $intIBlockID;



			if (is_array($mxResult)) {
				$rsOffers = CIBlockElement::GetList(array("PRICE" => "ASC"), array('IBLOCK_ID' => $ITEM['IBLOCK_ID'], 'PROPERTY_' . $mxResult['SKU_PROPERTY_ID'] => $ITEM["ID"]));
			}



			if(CCatalogSKU::IsExistOffers($ITEM["ID"], $intIBlockID))
			{



				$rsOffers = CIBlockElement::GetList(array("PRICE"=>"ASC"),array('IBLOCK_ID' => $mxResult['IBLOCK_ID'], 'PROPERTY_'.$mxResult['SKU_PROPERTY_ID'] => $ITEM["ID"]));

				unset($ITEM["OFFERS"]);
				//список цветов для каждого товара
				$countOffers = 0;
				while ($arOffer = $rsOffers->GetNext()){


					//$offerParameters = CCatalogProduct::GetByID($arOffer["ID"]);




					$db_props = CIBlockElement::GetProperty($arOffer["IBLOCK_ID"], $arOffer["ID"], array("sort" => "asc"), Array("CODE"=>"TSVET"));
					if($ar_props = $db_props->Fetch()){
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




					$ITEM["OFFERS"][]=$arOffer;
					$countOffers++;



				}



				$iTmp=0;
				$randomOffer=mt_rand(0, $countOffers-1);


				$lastRandomOffer=$ITEM["OFFERS"][$randomOffer]["COLOR_INDEX"];


				//$PREVIEW_PICTURE=CFile::GetFileArray($arResult["ITEMS"][$cell]["OFFERS"][$randomOffer]["PREVIEW_PICTURE"]);

				$PICTURE="";
				$MORE_PHOTO="";

				$db_props = CIBlockElement::GetProperty($ITEM["OFFERS"][$randomOffer]["IBLOCK_ID"],
					$ITEM["OFFERS"][$randomOffer]["ID"], array("sort" => "asc"), Array("CODE"=>"MORE_PHOTO"));
				if($ar_props = $db_props->Fetch()){
					$MORE_PHOTO = $ar_props["VALUE"];
				}

				$PREVIEW_PICTURE=CFile::GetFileArray($ITEM["OFFERS"][$randomOffer]["PREVIEW_PICTURE"]);
				$DETAIL_PICTURE=CFile::GetFileArray($ITEM["OFFERS"][$randomOffer]["DETAIL_PICTURE"]);
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
				$ITEM["NAME"]=$ITEM["OFFERS"][$randomOffer]["NAME"];
				$ITEM["PRICE"]=$ITEM["OFFERS"][$randomOffer]["PRICE"];
				$ITEM["PRICE_PRINT"]=$ITEM["OFFERS"][$randomOffer]["PRICE_PRINT"];
				$ITEM["PREVIEW_PICTURE"]=$PICTURE;
				$ITEM["OFFER_ACTIVE_ID"]=$randomOffer;
				$ITEM["OFFER_ACTIVE_INDEX"]=$ITEM["OFFERS"][$randomOffer]["COLOR_INDEX"];
				$ITEM["OFFER_ACTIVE_ID"]=$ITEM["OFFERS"][$randomOffer]["ID"];
				$ITEM["IN_BASKET"]=$ITEM["OFFERS"][$randomOffer]["IN_BASKET"];











			}




		$this->arResult['ITEM'] = $ITEM;



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