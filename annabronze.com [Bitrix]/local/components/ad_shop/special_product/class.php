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


		$rsProducts = CIBlockElement::GetList(array("PRICE"=>"ASC"), array('ACTIVE' => 'Y', 'IBLOCK_ID' => $this->arParams['IBLOCK_ID']), false, Array(), Array());//, Array("nPageSize"=>8)
		if(intval($rsProducts->SelectedRowsCount()) > 1){
			$this->cacheAddon[] = mt_rand();
		}


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

		$rsProducts = CIBlockElement::GetList(array("PRICE"=>"ASC"), array('ACTIVE' => 'Y', 'IBLOCK_ID' => $this->arParams['IBLOCK_ID']), false, Array(), Array());//, Array("nPageSize"=>8)

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

		if(!empty($ITEM["PREVIEW_PICTURE"])){
			$PREVIEW_PICTURE=CFile::GetFileArray($ITEM["PREVIEW_PICTURE"]);
			$renderImage = CFile::ResizeImageGet($PREVIEW_PICTURE, Array("width" => 200, "height" => 200));
			$ITEM["IMAGE"] = $renderImage["src"];
		}else if(!empty($ITEM["DETAIL_PICTURE"])){
			$DETAIL_PICTURE=CFile::GetFileArray($ITEM["DETAIL_PICTURE"]);
			$renderImage = CFile::ResizeImageGet($DETAIL_PICTURE, Array("width" => 200, "height" => 200));
			$ITEM["IMAGE"] = $renderImage["src"];
		}else{
			$ITEM["IMAGE"] = BX_DEFAULT_NO_PHOTO_IMAGE;
		}


		if(!empty($ITEM["PREVIEW_TEXT"])){
			$ITEM["DESCRIPTION"] = $ITEM["PREVIEW_TEXT"];
		}else if(!empty($ITEM["DETAIL_TEXT"])){
			$ITEM["DESCRIPTION"] = $ITEM["DETAIL_TEXT"];
		}else{
			$ITEM["DESCRIPTION"] = "";
		}


		$db_props = CIBlockElement::GetProperty($ITEM["IBLOCK_ID"], $ITEM["ID"], array("sort" => "asc"),
			Array("CODE"=>"LINK"));
		if($ar_props = $db_props->Fetch()){
			$ITEM["LINK"] = $ar_props["VALUE"];
		}

		$db_props = CIBlockElement::GetProperty($ITEM["IBLOCK_ID"], $ITEM["ID"], array("sort" => "asc"),
			Array("CODE"=>"PRICE"));
		if($ar_props = $db_props->Fetch()){

			$ITEM["PRICE"] = $ar_props["VALUE"];


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