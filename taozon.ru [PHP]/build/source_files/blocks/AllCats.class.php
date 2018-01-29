<?php

class AllCats extends GenerateBlock {

    protected $_cache = CFG_CACHED; //- кэшируем или нет.
    protected $_life_time = 3600; //- время на которое будем кешировать
    protected $_template = 'allcats'; //- шаблон, на основе которого будем собирать блок
    protected $_template_path = '/main/';

    public function __construct() {
        parent::__construct(true);
    }

    protected function setVars() {
        // Запрашивается список брен
        global $otapilib;

        $otapilib->curl_timeout = 600;
        $cats = $otapilib->GetTwoLevelRootCategoryInfoList();
        if(in_array('Seo2', General::$enabledFeatures)){
            $cms = new SafedCMS();
            if(is_array($cats))
            foreach($cats as &$c){
                $c['alias'] = $cms->getCategoryAlias($c['Id'], true, $c['Name']);
            }
        }
        
        $treeCats = array();
        if ($cats) foreach($cats as $c){
            if(!$c['ParentId']){
                $treeCats[$c['Id']] = array_merge($c, array('children' => array()));
            }
            else{
                $treeCats[$c['ParentId']]['children'][] = $c;
            }
        }
        
        $this->tpl->assign('treeCats', $treeCats);
    }

}

?>