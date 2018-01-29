<?php
OTBase::import('SeoCategoryRepository');

class CategoriesProvider extends Repository
{
    private $currentActiveLang;

    /**
     * @var OTAPIlib
     */
    private $otapilib;
    private $seoRepository;

    public function __construct($cms, $otapilib)
    {
        parent::__construct($cms);
        $this->otapilib = $otapilib;
        $this->seoRepository = new SeoCategoryRepository($this->cms);
    }

    public function RemoveCategory($sessionId, $categoryId) 
    {
        $this->beforeCategoriesOtapiRequest();

        $response = $this->otapilib->RemoveCategory($sessionId, $categoryId);
        $this->seoRepository->removeCategoryByCategoryId($categoryId);

        $this->afterCategoriesOtapiRequest();
        return $response;
    }

    public function EditCategoryExternalId($categoryId, $externalCategoryId, $sessionId, $predefinedData = "")
    {
        $this->beforeCategoriesOtapiRequest();

        $response = $this->otapilib->EditCategoryExternalId($categoryId, $externalCategoryId, $sessionId);

        $this->afterCategoriesOtapiRequest();
        return $response;
    }
    
    public function EditOrderOfCategory($index, $categoryId, $sessionId, $predefinedData = "")
    {
        $this->beforeCategoriesOtapiRequest();

        $response = $this->otapilib->EditOrderOfCategory($index, $categoryId, $sessionId, $predefinedData);

        $this->afterCategoriesOtapiRequest();
        return $response;
    }
    
    public function EditCategoriesVisible($categoriesVisibleSettings, $sessionId, $predefinedData = "")
    {
        $this->beforeCategoriesOtapiRequest();

        $response = $this->otapilib->EditCategoriesVisible($categoriesVisibleSettings, $sessionId, $predefinedData);

        $this->afterCategoriesOtapiRequest();
        return $response;
    }
    
    public function EditCategoryParent($sessionId, $categoryId, $parentCategoryId, $predefinedData = "")
    {
        $this->beforeCategoriesOtapiRequest();

        $response = $this->otapilib->EditCategoryParent($sessionId, $categoryId, $parentCategoryId);

        $this->afterCategoriesOtapiRequest();
        return $response;
    }
    
    public function EditCategoryNameByLanguage($sessionId, $categoryId, $categoryName)
    {
        $this->beforeCategoriesOtapiRequest();

        $response = $this->otapilib->EditCategoryNameByLanguage($sessionId, $categoryId, $categoryName);

        $this->afterCategoriesOtapiRequest();
        return $response;
    }
    
    public function GetEditableCategorySubcategories($sessionId, $parentCategoryId, $needHighlightParentsOfDeletedCategories, $predefinedData = "")
    {
        $this->beforeCategoriesOtapiRequest();

        $response = $this->otapilib->GetEditableCategorySubcategories($sessionId, $parentCategoryId, $needHighlightParentsOfDeletedCategories, $predefinedData);

        $this->afterCategoriesOtapiRequest();
        return $response;
    }
    
    public function GetCategorySubcategoryInfoList($parentCategoryId, $predefinedData = "")
    {
        $this->beforeCategoriesOtapiRequest();

        $response = $this->otapilib->GetCategorySubcategoryInfoList($parentCategoryId, $predefinedData);

        $this->afterCategoriesOtapiRequest();
        return $response;
    }
    
    public function GetProviderCategorySubcategories($parentCategoryId, $predefinedData = "")
    {
        $this->beforeCategoriesOtapiRequest();

        $response = $this->otapilib->GetProviderCategorySubcategories($parentCategoryId, $predefinedData);

        $this->afterCategoriesOtapiRequest();
        return $response;
    }
    
    public function GetProviderCategory($externalId, $predefinedData = "")
    {
        $this->beforeCategoriesOtapiRequest();

        $response = $this->otapilib->GetProviderCategory($externalId, $predefinedData = "");

        $this->afterCategoriesOtapiRequest();
        return $response;
    }
    
    public function GetCategoryInfo($externalId, $predefinedData = "")
    {
        $this->beforeCategoriesOtapiRequest();

        $response = $this->otapilib->GetCategoryInfo($externalId, $predefinedData = "");

        $this->afterCategoriesOtapiRequest();
        return $response;
    }
    
    public function GetRegionName($regionId)
    {
        $regionName = LangAdmin::get('Undefined');
        $regions = $this->otapilib->GetAllAreaList(Session::getActiveLang());
        foreach ($regions as $region) {
            if ($region['Id'] == $regionId) {
                $regionName = $region['Name'];
                break;
            }
        }
        return $regionName;
    }
     
    
    public function AddCategoryByLanguage($sessionId, $categoryName, $parentCategoryId, $categoryId, $predefinedData = "")
    {
        $this->beforeCategoriesOtapiRequest();

        $response = $this->otapilib->AddCategoryByLanguage($sessionId, $categoryName, $parentCategoryId, $categoryId, $predefinedData);

        $this->afterCategoriesOtapiRequest();
        return $response;
    }

    public function SearchDeletedCategoriesIds($sessionId, $predefinedData = "")
    {
        $this->beforeCategoriesOtapiRequest();

        $response = $this->otapilib->SearchDeletedCategoriesIds($sessionId, $predefinedData);

        $this->afterCategoriesOtapiRequest();
        return $response;
    }
    
    public function ExportStructureByLanguage($sessionId, $predefinedData = "")
    {
        $this->beforeCategoriesOtapiRequest();

        $response = $this->otapilib->ExportStructureByLanguage($sessionId, $predefinedData);

        $this->afterCategoriesOtapiRequest();
        return $response;
    }    

    public function ImportStructureByLanguage($sessionId, $source, $predefinedData = "")
    {
        $this->beforeCategoriesOtapiRequest();

        $response = $this->otapilib->ImportStructureByLanguage($sessionId, $source, $predefinedData);

        $this->afterCategoriesOtapiRequest();
        return $response;
    }
    
    public function ImportCatalog($sessionId, $source, $predefinedData = "")
    {
        $this->beforeCategoriesOtapiRequest();

        $response = $this->otapilib->ImportCatalog($sessionId, $source, $predefinedData);

        $this->afterCategoriesOtapiRequest();
        return $response;
    }

    public function ExportCatalog($sessionId, $predefinedData = "")
    {
        $this->beforeCategoriesOtapiRequest();

        $response = $this->otapilib->ExportCatalog($sessionId, $predefinedData);

        $this->afterCategoriesOtapiRequest();
        return $response;
    }
    
    public function EditCategoryInfo($sessionId, $categoryId, $xmlCategoryInfo, $predefinedData = "")
    {
        $this->beforeCategoriesOtapiRequest();

        $response = $this->otapilib->EditCategoryInfo($sessionId, $categoryId, $xmlCategoryInfo, $predefinedData);

        $this->afterCategoriesOtapiRequest();
        return $response;
    }
    
    public function getCategoryAlias($cid, $forceCreate = false, $cname = '')
    {
        return $this->seoRepository->getCategoryAlias($cid, $forceCreate, $cname);
    }
    
    public function getCategoryAliases($cid) 
    {
        $q = 'SELECT `id`, `alias`, `category_id` FROM `site_categories` WHERE `category_id`="' . mysql_real_escape_string($cid) . '"';
        $aliases = $this->cms->queryMakeArray($q, array('site_categories')); 
        return $aliases ? $aliases : array();
    }
    
    public function getCategorySEO($cid)
    {
        return $this->seoRepository->getCategorySEO($cid);
    }
    
    public function setCategoryAliasEx($cid, $alias, $aliasId = 'new') {
        $this->cms->checkTable('site_categories');
        if (is_numeric($aliasId)) {
            $this->cms->query('UPDATE `site_categories` SET `alias`="' . mysql_real_escape_string($alias) . '" WHERE `category_id`="' . mysql_real_escape_string($cid) . '" and id="' . mysql_real_escape_string($aliasId) . '"');
            return $aliasId;
        } else {
            $this->cms->query('INSERT INTO `site_categories` SET `category_id`="' . mysql_real_escape_string($cid) . '", `alias`="' . mysql_real_escape_string($alias) . '"');
            return mysql_insert_id();
        }
    }
    
    public function setCategoryAlias($cid, $alias)
    {
        return $this->seoRepository->setCategoryAlias($cid, $alias);
    }
    
    public function setCategorySEO($data)
    {
        return $this->seoRepository->setCategorySEO($data);
    }

    public function getSeoText($id)
    {
        $this->cms->Check();
        $this->cms->checkTable('site_categories_seo_texts');
        $id = mysql_real_escape_string($id);
        $q = mysql_query('SELECT text FROM `site_categories_seo_texts` WHERE `category_id`="'.$id.'"');
        return @mysql_result($q, 0);
    }
    
    public function setSeoText($id, $text)
    {
        $this->cms->Check();
        $id = mysql_real_escape_string($id);
        $this->cms->query('DELETE FROM `site_categories_seo_texts` WHERE `category_id`="'.$id.'"');
        $this->cms->query('INSERT INTO `site_categories_seo_texts` SET `category_id`="'.$id.'", `text`="'.
                mysql_real_escape_string(stripslashes($text)).'"');
        return;
    }
    
    public function GetCategorySearchProperties($categoryId)
    {
        $this->beforeCategoriesOtapiRequest();

        $response = $this->otapilib->GetCategorySearchProperties($categoryId);

        $this->afterCategoriesOtapiRequest();
        return $response;
    }
    
    public function updateSearchFilter($categoryId, $filterId, $type, $text, $sessionId, $langId)
    {
        $this->beforeCategoriesOtapiRequest();

        if (!General::getConfigValue('not_use_cat_cache')) {
            $DBCacheList = new DBCache();
            if ($DBCacheList->CheckCacheEl('searchprop:' . $filterId)) {
                $SProp = array();
                $SProp[$filterId] = unserialize($DBCacheList->GetCacheEl('searchprop:' . $filterId));
                foreach ($SProp as $pid => &$pvalue) {
                    if ($pid == $categoryId) {
                        $pvalue['name'] = $text;
                    }
                    foreach ($pvalue['values'] as &$value) {
                        if ($value['id'] == $categoryId) {
                            $value['name'] = $text;
                        }
                    }
                }
                foreach ($SProp as $pid => $pvalue) {
                    $DBCacheList->AddCacheEl('searchprop:' . $pid, 21600, serialize($pvalue));
                }
            }
        }
    
            	
        switch ($type) {
            case 'ItemPropertyName': {
                $key = (string)(CFG_SERVICE_INSTANCEKEY . ':taobao:ItemProperty:Name');
                $this->otapilib->EditTranslateByKey($sessionId, $langId, $text, $key, $categoryId);
            } break;
            case 'ItemPropertyValueName': {
                $key = (string)(CFG_SERVICE_INSTANCEKEY . ':taobao:ItemPropertyValue:Name');
                $this->otapilib->EditTranslateByKey($sessionId, $langId, $text, $key, $categoryId);
            } break;
            default:
                break;
        }

        $this->afterCategoriesOtapiRequest();
    }
    
    public function FindHintCategoryInfoList($hintTitle, $predefinedData = "")
    {
        $this->beforeCategoriesOtapiRequest();

        $response = $this->otapilib->FindHintCategoryInfoList($hintTitle, $predefinedData);

        $this->afterCategoriesOtapiRequest();
        return $response;
    }
    
    public function GetRootCategoryInfoList()
    {
        $this->beforeCategoriesOtapiRequest();

        $response = $this->otapilib->GetRootCategoryInfoList();

        $this->afterCategoriesOtapiRequest();
        return $response;
    }
    
    public function GetProviderInfoList()
    {
        $this->beforeCategoriesOtapiRequest();

        $response = $this->otapilib->GetProviderInfoList();

        $this->afterCategoriesOtapiRequest();
        return $response;
    }

    /*
     * запросы делаются согластно активному языку страницы "Категории"
     */
    private function beforeCategoriesOtapiRequest()
    {
        $this->currentActiveLang = Session::getActiveLang();
        $this->otapilib->setUseAdminLangOff();
        $language = Session::get('active_lang_categories') ? Session::get('active_lang_categories') : Session::getActiveAdminLang();
        Session::setActiveLang($language);
    }

    /*
     * возвращаем язык витрины и включаем запросы отапи по языку админки
     */
    private function afterCategoriesOtapiRequest()
    {
        Session::setActiveLang($this->currentActiveLang);
        $this->otapilib->setUseAdminLangOn();
    }
}

