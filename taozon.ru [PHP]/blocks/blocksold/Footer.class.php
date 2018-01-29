<?php

class Footer extends GenerateBlock
{
    protected $_cache = CFG_CACHED; //- кэшируем или нет.
    protected $_life_time = 3600; //- время на которое будем кешировать
    protected $_template = 'footer'; //- шаблон, на основе которого будем собирать блок
    protected $_template_path = '/main/';

    public function __construct()
    {
        parent::__construct(true);
    }

    protected function setVars()
    {
    }
}

?>