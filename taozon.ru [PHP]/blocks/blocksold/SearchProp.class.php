<?php

class SearchProp extends GenerateBlock
{
    protected $_cache = false;
    protected $_life_time = 3600;
    protected $_template = 'searchprop';
    protected $_template_path = '/main/';
    protected $_hash = '';

    public function __construct()
    {
        $this->_hash = @$_GET['cid'].@$_GET['search'];
        parent::__construct(true);
    }

    protected function setVars()
    {
        $this->tpl->assign('searchprops', $GLOBALS['searchprop']);
    }
}

?>