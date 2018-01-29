<?php

class Banners extends GenerateBlock
{
    protected $_cache = CFG_CACHED; //- кэшируем или нет.
    protected $_life_time = 3600; //- время на которое будем кешировать
    protected $_template = 'bannersnew'; //- шаблон, на основе которого будем собирать блок
    protected $_template_path = '/main/';

    public function __construct()
    {
        parent::__construct(true);
    }

    protected function setVars()
    {
        if(defined('CFG_BANNERS_SETTINGS'))
            $file =  CFG_BANNERS_SETTINGS;
        else 
            $file =  CFG_APP_ROOT.'/userdata/banner.txt';
        
        if(!file_exists($file)) {
            $banners = array();
        } else {
            $banners = $this->_getFromFile($file);
        }

        $this->tpl->assign('banners', $banners);
    }
    
    
    private function _getFromFile($file){
        $fh = fopen($file, "rt") or die("Can't open file!");
        @$data = fread($fh, filesize($file));
        fclose($fh);
        $banners = array();
        $data = explode('\end',$data);

        foreach($data as $banner){
            $banner = explode('||p||',$banner);
            if(count($banner) < 2) continue;

            $b = array();
            $b['id']   = $banner[0];
            $b['ban']  = $banner[1];
            $b['desc'] = $banner[2];
            $b['link'] = $banner[3];
            $b['language'] = isset($banner[4]) ? $banner[4] : '';
            if($b['language'] != $_SESSION['active_lang'] && $b['language']) continue;
            if (strpos(strtolower($banner[1]), '.swf')) {
                $b['type'] = 'swf';
            } else {
                $b['type'] = 'pic';
            }
            $banners[] = $b;
        }

        $newBanners = Plugins::invokeEvent('onRenderSiteBanners', array('data' => $data));
        $banners = $newBanners === false ? $banners : $newBanners;

        return $banners;
    }
}

?>