<?php

class Crumbs extends GenerateBlock
{
    protected $_cache = CFG_CACHED; //- кэшируем или нет.
    protected $_life_time = 3600; //- время на которое будем кешировать
    protected $_template = 'crumbs'; //- шаблон, на основе которого будем собирать блок
    protected $_template_path = '/main/';
    protected $_hash = '';

    public function __construct()
    {
        if (SCRIPT_NAME == 'item')
        {
            $this->_hash = $_GET['id'];
        }
        if (SCRIPT_NAME == 'category' || SCRIPT_NAME == 'subcategory')
        {
            $this->_hash = $_GET['cid'];
        }
        if (SCRIPT_NAME == 'search')
        {
            if($_GET['cid'])
                $this->_hash = $_GET['cid'];
            if($_GET['bid'])
                $this->_hash = $_GET['bid'];
        }
        parent::__construct(true);
    }

    protected function setVars()
    {
        global $otapilib;
        $c = SCRIPT_NAME;
        $cid = isset($_GET['cid']) ? $_GET['cid'] : false;
        if (SCRIPT_NAME == 'item')
        {
            $id = $_GET['id'];
            $itempath = $otapilib->GetItemRootPath($id, $GLOBALS['taoBaoCategoryId']);
            $itempath[] = array('name' => $id, 'last' => true);
            $this->tpl->assign('crumbs', $itempath);
        }
        if (SCRIPT_NAME == 'category' || SCRIPT_NAME == 'subcategory')
        {
            $catpath = $otapilib->GetCategoryRootPath($cid);
            $catpath[count($catpath)-1]['last'] = true;
            $this->tpl->assign('crumbs', $catpath);
            $GLOBALS['catpath'] = $catpath;
        }
        if (SCRIPT_NAME == 'search')
        {
            $bid = isset($_GET['brand']) ? $_GET['brand'] : false;
            $catpath = array();
            if($cid)
                $catpath = $otapilib->GetCategoryRootPath($cid);
            if($bid){
                $this->tpl->assign('isbrand', '1');
                $GLOBALS['brand'] = $otapilib->GetBrandInfo($bid);
                $this->tpl->assign('brandcrumb', $GLOBALS['brand']);
            }
            $catpath[] = array('name' => 'Результаты поиска', 'last' => true);
            $this->tpl->assign('crumbs', $catpath);
            $GLOBALS['catpath'] = $catpath;
        }
    }
}

?>