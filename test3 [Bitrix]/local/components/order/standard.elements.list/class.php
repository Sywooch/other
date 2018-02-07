<?
if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();

use \Bitrix\Main;
use \Bitrix\Main\Localization\Loc as Loc;

class StandardElementListComponent extends CBitrixComponent
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
	 * подключает языковые файлы
	 */
	public function onIncludeComponentLang()
	{
		$this -> includeComponentLang(basename(__FILE__));
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
            'EVENT_TYPE' => intval($params['EVENT_TYPE']),
            /*'SHOW_NAV' => ($params['SHOW_NAV'] == 'Y' ? 'Y' : 'N'),
            'COUNT' => intval($params['COUNT']),
            'SORT_FIELD1' => strlen($params['SORT_FIELD1']) ? $params['SORT_FIELD1'] : 'ID',
            'SORT_DIRECTION1' => $params['SORT_DIRECTION1'] == 'ASC' ? 'ASC' : 'DESC',
            'SORT_FIELD2' => strlen($params['SORT_FIELD2']) ? $params['SORT_FIELD2'] : 'ID',
            'SORT_DIRECTION2' => $params['SORT_DIRECTION2'] == 'ASC' ? 'ASC' : 'DESC',
            'CACHE_TIME' => intval($params['CACHE_TIME']) > 0 ? intval($params['CACHE_TIME']) : 3600
        	*/
		);
        return $result;
    }
	
	/**
	 * определяет читать данные из кеша или нет
	 * @return bool
	 */
	protected function readDataFromCache()
	{
		if ($this -> arParams['CACHE_TYPE'] == 'N')
			return false;

		return !($this -> StartResultCache(false, $this -> cacheAddon));
	}

	/**
	 * кеширует ключи массива arResult
	 */
	protected function putDataToCache()
	{
		if (is_array($this -> cacheKeys) && sizeof($this -> cacheKeys) > 0)
		{
			$this -> SetResultCacheKeys($this -> cacheKeys);
		}
	}

	/**
	 * прерывает кеширование
	 */
	protected function abortDataCache()
	{
		$this -> AbortResultCache();
	}
	
	/**
	 * проверяет подключение необходиимых модулей
	 * @throws LoaderException
	 */
	protected function checkModules()
	{
		if (!Main\Loader::includeModule('iblock'))
			throw new Main\LoaderException(Loc::getMessage('STANDARD_ELEMENTS_LIST_CLASS_IBLOCK_MODULE_NOT_INSTALLED'));
	}
	
	/**
	 * проверяет заполнение обязательных параметров
	 * @throws SystemException
	 */
	protected function checkParams()
	{
		if ($this -> arParams['IBLOCK_ID'] <= 0)
			throw new Main\ArgumentNullException('IBLOCK_ID');
	}
	
	/**
	 * выполяет действия перед кешированием 
	 */
	protected function executeProlog()
	{ 
	
		/*
		if ($this -> arParams['COUNT'] > 0)
		{
			if ($this -> arParams['SHOW_NAV'] == 'Y')
			{
				\CPageOption::SetOptionString('main', 'nav_page_in_session', 'N');
				$this -> navParams = array(
					//'nPageSize' => $this -> arParams['COUNT']
					'nPageSize' => 1000
					
				);
	    		$arNavigation = \CDBResult::GetNavParams($this -> navParams);
				$this -> cacheAddon = array($arNavigation);
			}
			else
			{
				$this -> navParams = array(	
					//'nTopCount' => $this -> arParams['COUNT']
					'nTopCount' => 1000
				);
			}
		}
		*/
	}
	
	/**
	 * получение результатов
	 */
	protected function getResult()
	{
		
		//достать список товаров из выбранного инфоблока
		
		
		
		
		
		
		
		$filter = array(
			'IBLOCK_TYPE' => $this -> arParams['IBLOCK_TYPE'],
			'IBLOCK_ID' => $this -> arParams['IBLOCK_ID'],
			'ACTIVE' => 'Y'
		);
		$sort = array(
			//$this -> arParams['SORT_FIELD1'] => $this -> arParams['SORT_DIRECTION1'],
			//$this -> arParams['SORT_FIELD2'] => $this -> arParams['SORT_DIRECTION2']
		);
		$select = array(

		);
		//$rsElement = \CIBlockElement::GetList($sort, $filter, false, $this -> navParams, $select);
		//$rsElement = \CIBlockElement::GetList($sort, $filter, false, false, $select);
		
		
		
	
		$db_res = CCatalogProduct::GetList(
				array("ELEMENT_NAME" => "ASC"),
				array("ELEMENT_IBLOCK_ID" => $this -> arParams['IBLOCK_ID']),
				false,
				false
			);
		if(!is_object($USER)) $USER = new CUser;	
			
		while (($ar_res = $db_res->Fetch()))
		{

			$arPrice = CPrice::GetByID($ar_res["ID"]);
			$price=$arPrice["PRICE"]." ".$arPrice["CURRENCY"];


			$arDiscounts = CCatalogDiscount::GetDiscountByPrice(
					$arPrice["ID"],
					$USER->GetUserGroupArray(),
					"N",
					SITE_ID
				);
			$discountPrice = CCatalogProduct::CountPriceWithDiscount(
					$arPrice["PRICE"],
					$arPrice["CURRENCY"],
					$arDiscounts
				);

			
			//проверить, есть ли у товара торговые предложения
			if(CCatalogSKU::IsExistOffers($ar_res["ID"])){

				$resSKU=CCatalogSKU::getOffersList($ar_res["ID"],0,array(),array(),array());
				$resSKU=current(current($resSKU));

				$arPrice = CPrice::GetBasePrice($resSKU["ID"]);
				$price=$arPrice["PRICE"]." ".$arPrice["CURRENCY"];
				
				$arPriceSKU = CPrice::GetByID($arPrice["ID"]);
				$arDiscounts = CCatalogDiscount::GetDiscountByPrice(
					$arPriceSKU["ID"],
					$USER->GetUserGroupArray(),
					"N",
					SITE_ID
				);
				$discountPrice = CCatalogProduct::CountPriceWithDiscount(
					$arPriceSKU["PRICE"],
					$arPriceSKU["CURRENCY"],
					$arDiscounts
				);
			}
			
			//достать еденицу измерения
				
			$measure_id=$ar_res["MEASURE"];
			if($measure_id==""){
				$filter=array("IS_DEFAULT" => "Y");
			}else{
				$filter=array("ID" => $measure_id);	
			}
				
			$res_measure = CCatalogMeasure::getList(array(),$filter);
			while($measure = $res_measure->Fetch()) {
				$measure_symbol = $measure["SYMBOL_RUS"];
			}
									
						
			$this -> arResult['ITEMS'][] = array(
				'ID' => $ar_res["ID"],
				'NAME' => $ar_res["ELEMENT_NAME"],
				'PRICE' => $price,
				'DISCOUNT_PRICE' => $discountPrice,
				'MEASURE' => $measure_symbol
			);
				
		}			
			
	
		
		//}
		
		
		
		
		
		/*
		if ($this -> arParams['SHOW_NAV'] == 'Y' && $this -> arParams['COUNT'] > 0)
		{
			$this -> arResult['NAV_STRING'] = $rsElement -> GetPageNavString('');
		}
		*/
		
		
		
		
	}
	
	/**
	 * выполняет действия после выполения компонента, например установка заголовков из кеша
	 */
	protected function executeEpilog()
	{
		
	}
	
	/**
	 * выполняет логику работы компонента
	 */
	public function executeComponent()
	{
		try
		{
			$this -> checkModules();
			$this -> checkParams();
			$this -> executeProlog();
			if (!$this -> readDataFromCache())
			{
				$this -> getResult();
				$this -> putDataToCache();
				$this -> includeComponentTemplate();
			}
			$this -> executeEpilog();
		}
		catch (Exception $e)
		{
			$this -> abortDataCache();
			ShowError($e -> getMessage());
		}
	}
}
?>