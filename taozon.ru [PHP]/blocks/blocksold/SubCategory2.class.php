<?php

class SubCategory2 extends GenerateBlock
{
    protected $_cache = CFG_CACHED; //- кэшируем или нет.
    protected $_life_time = 3600; //- время на которое будем кешировать
    protected $_template = 'subcategorylist2'; //- шаблон, на основе которого будем собирать блок
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
    }
}

?>