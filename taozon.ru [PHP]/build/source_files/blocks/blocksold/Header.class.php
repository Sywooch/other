<?php

class Header extends GenerateBlock
{
    protected $_cache = false; //- кэшируем или нет.
    protected $_life_time = 3600; //- время на которое будем кешировать
    protected $_template = 'header'; //- шаблон, на основе которого будем собирать блок
    protected $_template_path = '/main/';

    public function __construct()
    {
        parent::__construct(true);
    }

    protected function setVars()
    {
        global $otapilib;
        
        $search_templates = array('category','subcategory','item','index',
                'login','register','profile','content','supportlist','basket', 
                'userorder','support', 'privateoffice');
        
        if (in_array(SCRIPT_NAME, $search_templates))
        {
            $this->tpl->assign('script_name', 'index');
            $this->tpl->assign('show_search', true);
        }
        if (SCRIPT_NAME == 'search')
        {
            $this->tpl->assign('script_name', 'index');
            $this->tpl->assign('show_search', true);
            $this->tpl->assign('search', @$_GET['search']);
        }
        
        if (isset($_GET['cid']) && !empty($_GET['cid']))
        {
            global $otapilib;
            $cat_info = $otapilib->getCategoryInfo($_GET['cid']);
            $this->tpl->assign('cid', str_replace(array('ic:', 'CID'),'',$_GET['cid']));
            $this->tpl->assign('cat_name', $cat_info['Name']);
        }
        
        if(SCRIPT_NAME == 'index' || SCRIPT_NAME == 'brands')
        {
            $searchcats = $otapilib->GetSearchCategoryInfoList();
            $this->tpl->assign('searchcats', $searchcats);
        }

        $user = Users::loginUser();
        
        if((bool)$user){
            $accountinfo = $otapilib->GetAccountInfo($_SESSION[CFG_SITE_NAME.'loginUserData']['sid']);
            $this->tpl->assign('deposit', (string)$accountinfo['availableamount'].' '.$accountinfo['currencysign']);
            $_SESSION[CFG_SITE_NAME.'loginUserData']['currencysign'] = (string)$accountinfo['currencysign'];
        }
            
        $this->tpl->assign('IsAuthenticated', (bool)$user);
        $this->tpl->assign('rev', CFG_APP_ROOT.'/'.@file_get_contents('.rev'));
        
    }
}

?>