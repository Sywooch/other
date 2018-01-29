<?php

class Brands extends GenerateBlock {

    protected $_cache = CFG_CACHED; //- кэшируем или нет.
    protected $_life_time = 3600; //- время на которое будем кешировать
    protected $_template = 'brandlist'; //- шаблон, на основе которого будем собирать блок
    protected $_template_path = '/brands/';

    public function __construct() {
        parent::__construct(true);
    }

    protected function setVars() {
        // Запрашивается список брен
        global $otapilib;
        
        $brand_list = $otapilib->GetBrandInfoListFrame(0, 100);
        
        $brands = array();
        foreach($brand_list['Content'] as $brand){
            $letter = strtoupper($brand['Name'][0]);
            if(!isset($brands[$letter]))
                $brands[$letter] = array();
            $brands[$letter][] = $brand;
        }
        $this->tpl->assign('brandlists', $brands);
    }

}

?>