<?php

class SubCategory extends GenerateBlock
{
    protected $_cache = CFG_CACHED; //- кэшируем или нет.
    protected $_life_time = 3600; //- время на которое будем кешировать
    protected $_template = 'subcategorylist'; //- шаблон, на основе которого будем собирать блок
    protected $_template_path = '/main/';
    protected $_hash = '';

    public function __construct()
    {
        $this->_hash = $_GET['cid'];
        parent::__construct(true);
    }

    protected function setVars()
    {
        // Получаем субкатегории
        $cid = $_GET['cid'];
        global $otapilib;
        $subcats = $otapilib->GetCategorySubcategoryInfoList($cid);
        //if ($subcats === false) show_error(__FILE__.'  (line='.__LINE__.')');
        if ($subcats === false) show_error($otapilib->error_message);
        $this->tpl->assign('subcats', $subcats);
        if (count($subcats)>0) $GLOBALS['no_search_props'] = true;
        
        if (isset($GLOBALS['catpath']))
        {
            $catpath = array_reverse($GLOBALS['catpath']);
            $catpath = array_slice($catpath, 1, 1);
            //print_r($catpath);
            if (isset($catpath[0]))
            {
                $subcats_prev = $otapilib->GetCategorySubcategoryInfoList($catpath[0]['id']);
                $this->tpl->assign('subcats_prev', $subcats_prev);
                //
                $catpath = array_reverse($GLOBALS['catpath']);
                $catpath = array_slice($catpath, 0, 1);
                $this->tpl->assign('cid', $catpath[0]['id']);
            }
        }
    }
}

?>