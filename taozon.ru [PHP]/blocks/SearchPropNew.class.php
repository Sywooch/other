<?php

class SearchPropNew extends GenerateBlock
{
    protected $_cache = false;
    protected $_life_time = 3600;
    protected $_template = 'searchpropnew';
    protected $_template_path = '/main/';

    private $searchProperties;
    private $searchPropertiesLogic;

    public function setSearchProperties($searchProperties, $logic){
        $this->searchProperties = $searchProperties;
        $this->searchPropertiesLogic = $logic;
    }

    protected function setVars()
    {
        global $otapilib;

        if(!file_exists(CFG_APP_ROOT.'/cache/GetCurrency.dat') ||
            filemtime(CFG_APP_ROOT.'/cache/GetCurrency.dat')+600<time()){
            $currency = $otapilib->GetCurrency();
            file_put_contents(CFG_APP_ROOT.'/cache/GetCurrency.dat', serialize($currency));
        }
        else{
            $currency = unserialize(file_get_contents(CFG_APP_ROOT.'/cache/GetCurrency.dat'));
        }
        if (isset($_GET['filters'][20000])) {
            $activeBrandFilters = $_GET['filters'][20000];
        } else {
            $activeBrandFilters = false;
        }
        $this->tpl->assign('currency', $currency);
        $this->tpl->assign('searchprops', $this->searchProperties);
        $this->tpl->assign('logic', $this->searchPropertiesLogic);
        $this->tpl->assign('activeBrandFilters', $activeBrandFilters);
        
    }

    public function isSearchPropertiesCached(){
        $cacheId = SearchPropNew::getCacheId();
        if(!$cacheId || General::getConfigValue('not_use_cat_cache'))
            return false;

        return $this->dbCache->CheckCacheEl('catsearchprop:'.$cacheId);
    }

    public function saveSearchPropertiesToCache($searchProperties){
        if(!$searchProperties)
            return false;
        $cacheId = SearchPropNew::getCacheId();
        if(!$cacheId || General::getConfigValue('not_use_cat_cache'))
            return false;
        $this->dbCache->AddCacheEl('catsearchprop:'.$cacheId,21600,serialize($searchProperties));
    }

    public function setBaseUrl($url){
        $this->tpl->assign('clearUrl', $url);
    }

    public function getSearchPropertiesFromCache(){
        $cacheId = SearchPropNew::getCacheId();
        if(!$cacheId)
            return false;

        return unserialize($this->dbCache->GetCacheEl('catsearchprop:'.$cacheId));
    }

    public static function getCacheId(){
        $categoryId = RequestWrapper::getValueSafe('cid');
        $provider = RequestWrapper::getValueSafe('Provider');
        $searchMethod = RequestWrapper::getValueSafe('SearchMethod');

        $cacheId = $categoryId;
        if($provider){
            $cacheId .= '_'.$provider;
        }
        if($searchMethod){
            $cacheId .= '_'.$searchMethod;
        }

        return $cacheId;
    }
}

?>