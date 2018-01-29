<?php

class SubCategoryNew extends GenerateBlock
{
    protected $_cache = false; //- кэшируем или нет.
    protected $_life_time = 3600; //- время на которое будем кешировать
    protected $_template = 'subcategorylistnew'; //- шаблон, на основе которого будем собирать блок
    protected $_template_path = '/main/';

    public function __construct()
    {
		
        parent::__construct(true);
    }

    protected function setVars()
    {
		
        // Получаем субкатегории
        $cid = RequestWrapper::getValueSafe('cid');
        global $otapilib;
        $subcats = $otapilib->GetCategorySubcategoryInfoList($cid);
        if(in_array('Seo2', General::$enabledFeatures)){
            $cms = new SafedCMS();
            if(is_array($subcats))
            foreach($subcats as &$c){
                $c['alias'] = $cms->getCategoryAlias($c['Id'], true, $c['Name']);
            }
        }
        
        if ($subcats === false) show_error($otapilib->error_message);
        $this->tpl->assign('subcats', $subcats);
        if (count($subcats)>0) $GLOBALS['no_search_props'] = true;
        
        $rootcats = $otapilib->GetRootCategoryInfoList();
        if ($rootcats === false) show_error($otapilib->error_message);
        if(in_array('Seo2', General::$enabledFeatures)){
            if(is_array($rootcats))
            foreach($rootcats as &$c){
                $c['alias'] = $cms->getCategoryAlias($c['Id'], true, $c['Name']);
            }
        }
        
        $this->tpl->assign('rootcats', $rootcats);
        $this->tpl->assign('cid', $cid);
        
        
        if (isset($GLOBALS['catpath']))
        {
            $catpath = array_reverse($GLOBALS['catpath']);
            $catpath = array_slice($catpath, 1, 1);
            //print_r($catpath);
            $ids_path = array();
            if (isset($catpath[0]))
            {
                $subcats_prev = $otapilib->GetCategorySubcategoryInfoList($catpath[0]['id']);
                if(in_array('Seo2', General::$enabledFeatures)){
                    if(is_array($subcats_prev))
                    foreach($subcats_prev as &$c){
                        $c['alias'] = $cms->getCategoryAlias($c['Id'], true, $c['Name']);
                    }
                }
        
                $this->tpl->assign('subcats_prev', $subcats_prev);
                //
                $catpath = array_reverse($GLOBALS['catpath']);
                $catpath = array_slice($catpath, 0, 1);
                
                $ids_path = is_array(@$GLOBALS['catpath']) ? $GLOBALS['catpath'] : array();
                array_walk($ids_path, array(&$this, 'perparePath'));
                
                $this->tpl->assign('cid', $catpath[0]['id']);
            }
            $this->tpl->assign('ids_path', $ids_path);
        }
    }
    
    private function perparePath(&$item, $key){
        $item = $item['id'];
    }
}

?>