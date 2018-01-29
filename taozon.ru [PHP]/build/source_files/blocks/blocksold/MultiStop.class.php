<?php

class MultiStop extends GenerateBlock {

    protected $_cache = false; //- кэшируем или нет.
    protected $_life_time = 3600; //- время на которое будем кешировать
    protected $_template = 'itemlistnew'; //- шаблон, на основе которого будем собирать блок
    protected $_template_path = '/main/';
    protected $_hash = '';

    public function __construct() {
        parent::__construct(true);
    }
    protected function setVars() {
        global $otapilib;
        if(CFG_MULTI_CURL){
            $otapilib->StopMulti();
        }
    }

}

?>