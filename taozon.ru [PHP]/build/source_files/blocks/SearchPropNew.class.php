<?php

class SearchPropNew extends GenerateBlock
{
    protected $_cache = false;
    protected $_life_time = 3600;
    protected $_template = 'searchpropnew';
    protected $_template_path = '/main/';

    public function __construct()
    {
        parent::__construct(true);
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
        $this->tpl->assign('currency', $currency);
        $this->tpl->assign('searchprops', $GLOBALS['searchprop']);
    }
}

?>