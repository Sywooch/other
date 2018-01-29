<?php

class ItemSets extends GenerateBlock
{
    protected $_cache = CFG_CACHED; //- кэшируем или нет.
    protected $_life_time = 3600; //- время на которое будем кешировать
    protected $_template = 'itemsets'; //- шаблон, на основе которого будем собирать блок
    protected $_template_path = '/main/';

    public function __construct()
    {
        parent::__construct(true);
    }

    protected function setVars()
    {
        global $otapilib;
        
        $recommend = $otapilib->GetItemRatingList('Best',8,0);
        $this->tpl->assign('itemlist1', $recommend);
        
        $popular = $otapilib->GetItemRatingList('Popular',8,0);
        $this->tpl->assign('itemlist2', $popular);

        $popular = $otapilib->GetItemRatingList('Last',8,0);
        $this->tpl->assign('itemlist3', $popular);

        $brand_list = $otapilib->GetBrandRatingList('Best',10,0);
        $brands = $brand_list;
        
        $this->tpl->assign('brandlist', $brands);
    }
}

?>