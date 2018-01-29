<?php

class FooterNew extends GenerateBlock
{
    protected $_cache = false; //- кэшируем или нет.
    protected $_life_time = 3600; //- время на которое будем кешировать
    protected $_template = 'footernew'; //- шаблон, на основе которого будем собирать блок
    protected $_template_path = '/main/';

    public function __construct()
    {
        if (isset($_GET['print'])&&$_GET['print']=='Y') $this->_template='footerprint';
        parent::__construct(true);
    }

    protected function setVars()
    {
    }
}

?>