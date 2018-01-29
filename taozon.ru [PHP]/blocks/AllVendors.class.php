<?php

class AllVendors extends GenerateBlock {

    protected $_cache = CFG_CACHED; //- кэшируем или нет.
    protected $_life_time = 3600; //- время на которое будем кешировать
    protected $_template = 'vendors'; //- шаблон, на основе которого будем собирать блок
    protected $_template_path = '/vendors/';
    public $_hash = '';
    
    /**
     * @var VendorRepository
     */
    private $vendorRepository;
    
    public function __construct() {
        parent::__construct(true);
        if(@CFG_CACHED){
            $this->tpl->_caching_id = @$_GET['letter'].@$_GET['type'].@$_SESSION['active_lang'];
        }
        $this->vendorRepository = new VendorRepository($this->cms);
    }

    protected function setVars() {
        // Запрашивается список брен
        global $otapilib;

        if(@$_GET['type']){
            $vendor_list = $otapilib->GetVendorRatingList($_GET['type'], 1000, 0);
        }
        else{
            $vendor_list = $otapilib->GetVendorRatingList('Best', 1000, 0);
        }
        if ($vendor_list) foreach($vendor_list as &$vendor ){
            $vendorInfoFromDB = $this->vendorRepository->GetVendorInfo($vendor['Id'], Session::getActiveLang());
            $info = isset($vendorInfoFromDB[0]) ? $vendorInfoFromDB[0] : array('image_path' => '', 'vendor_name' => '');            
            $vendor['image_path'] = $info['image_path'];
            $vendor['vendor_name'] = $info['vendor_name'];            
        }
        if(@$_GET['letter']){
            foreach($vendor_list as $k=>$b){
                $vendorName = (string)$b['vendor_name'];
                if(strtoupper($vendorName[0]) != strtoupper($_GET['letter'])){
                    unset($vendor_list[$k]);
                }
            }
        }
        $this->tpl->assign('vendor_list', $vendor_list);
    }

}

?>