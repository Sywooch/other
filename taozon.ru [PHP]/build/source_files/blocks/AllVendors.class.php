<?php

class AllVendors extends GenerateBlock {

    protected $_cache = CFG_CACHED; //- кэшируем или нет.
    protected $_life_time = 3600; //- время на которое будем кешировать
    protected $_template = 'vendors'; //- шаблон, на основе которого будем собирать блок
    protected $_template_path = '/vendors/';
    public $_hash = '';
    
    public function __construct() {
        parent::__construct(true);
        if(@CFG_CACHED){
            $this->tpl->_caching_id = @$_GET['letter'].@$_GET['type'].@$_SESSION['active_lang'];
        }
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
        $cms = new CMS();
        if($cms->Check()){
            if ($vendor_list) foreach( $vendor_list as &$vendor ){
                $q = mysql_query('SELECT * FROM `site_vendors_images`
                WHERE `vendor_id`="'.mysql_real_escape_string($vendor['Id']).'"');
                $row = mysql_fetch_assoc($q);
                $vendor['image_path'] = $row['image_path'];
                $vendor['vendor_name'] = $row['vendor_name'];
            }
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