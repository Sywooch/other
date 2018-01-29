<?php

class Banners { 
    
    function defaultAction()
    {
        global $otapilib;
        if (Login::auth())
        {
            if(defined('CFG_BANNERS_SETTINGS'))
                $file =  CFG_BANNERS_SETTINGS;
            else 
                $file =  CFG_APP_ROOT.'/userdata/banner.txt';
            
            $banners = array();
            
            if(!file_exists($file)) {
                $this->_createFile($file);
            } else {
                $banners = $this->_getFromFile($file);
            }
            $sid = $_SESSION['sid'];
            $data = $otapilib->GetWebUISettings($sid);
            include(TPL_DIR.'banners.php');
        } else {
            include(TPL_DIR.'login.php');
        } 
    }
    
    //
    function addAction(){
        require 'Upload2.php';

        if (Login::auth())
        {
            if(defined('CFG_BANNERS_SETTINGS'))
                $file =  CFG_BANNERS_SETTINGS;
            else 
                $file =  CFG_APP_ROOT.'/userdata/banner.txt';

            if(!file_exists($file)) {
                $this->_createFile($file);
            }
            
            $allowedExtensions = array("jpeg", "jpg", "gif", "png", "bmp", "swf");
            $sizeLimit = 20 * 1024 * 1024;

            $uploader = new qqFileUploader($allowedExtensions, $sizeLimit);
            $result = $uploader->handleUpload(dirname(dirname(dirname(__FILE__))).'/brands_uploads/');

            $msg = '';
            if (isset($result['success'])) {
                $banners = $this->_getFromFile($file);
            
                $new_banner = array();
                $new_banner['id']   = count($banners) + 1;
                $new_banner['link'] = @$_POST['link'];
                $new_banner['desc'] = @$_POST['desc'];
                $new_banner['ban']  = @$result['url'];
                $new_banner['language']  = @$_POST['language'];
                $banners[] = $new_banner;

                $this->_saveToFile($file, $banners);
            } else {
                $msg = '&error='.LangAdmin::get('failed_load_file');
            }
            
            header('Location: ?cmd=banners'.$msg);
            //include(TPL_DIR.'banners.php');
        } else {
            include(TPL_DIR.'login.php');
        } 
    }
    
    //
    function delAction(){
        if (Login::auth())
        {
            $id = @$_GET['id'];
            
            if(defined('CFG_BANNERS_SETTINGS'))
                $file =  CFG_BANNERS_SETTINGS;
            else 
                $file =  CFG_APP_ROOT.'/userdata/banner.txt';
            
            $banners = array();
            
            if(!file_exists($file)) {
                $this->_createFile($file);
            } else {
                
                $banners = $this->_getFromFile($file);
                
                $i = 0;
                foreach($banners as $banner){
                    if($banner['id'] == $id) {
                        unset($banners[$i]);
                        break;
                    }
                    $i++;
                }
            }
            $banners = $this->_updateBanners($banners);
            $this->_saveToFile($file, $banners);

            header('Location: ' . $_GET['return']);

            include(TPL_DIR.'banners.php');
        } else {
            include(TPL_DIR.'login.php');
        } 
    }
    
    function saveorderAction(){
        if (Login::auth())
        {
            $ids = @$_POST['ids'];
            $ids = explode(';', $ids);

            $banners = array();
            
            if(defined('CFG_BANNERS_SETTINGS'))
                $file =  CFG_BANNERS_SETTINGS;
            else 
                $file =  CFG_APP_ROOT.'/userdata/banner.txt';
            
            if(!file_exists($file)) {
                $this->_createFile($file);
            }
            
            $banners = $this->_getFromFile($file);
            $sort = array();
            foreach($ids as $id)
                foreach($banners as $banner){
                    if($banner['id'] == $id){
                        $sort[] = $banner;
                        break;
                    }
                }
            $banners = $this->_updateBanners($sort);
            $this->_saveToFile($file, $sort);

            header('Location: ' . $_POST['return']);

            include(TPL_DIR.'banners.php');
        } else {
            include(TPL_DIR.'login.php');
        } 
    }
    
    //
    private function _createFile($file){
        @$fh = fopen($file, "w+");
        @fclose($fh);
    }
    
    //
    private function _getFromFile($file){
        
        $banners = array();
        
        try{
            @$fh = fopen($file, "rt");
            @$data = fread($fh, filesize($file));
            @fclose($fh);

            $data = explode('\end',$data);

            foreach($data as $banner){
                $banner = explode('||p||',$banner);
                if(count($banner) < 4) continue;
                $b = array();
                $b['id']   = $banner[0];
                $b['ban']  = $banner[1];
                $b['desc'] = $banner[2];
                $b['link'] = $banner[3];
                $b['language'] = $banner[4];
                $banners[] = $b;
            }
        } catch (Exception $e) {
            //
        }
        
        return $banners;
    }
    
    //
    private function _saveToFile($file, $banners){
        try {
            $str = '';
            foreach($banners as $banner){
                $str .= $banner['id'].'||p||'.$banner['ban'].'||p||'.$banner['desc'].'||p||'.$banner['link'].'||p||'.$banner['language'].'\end';
            }
        
            @$fh = fopen($file, "w+");
            @$s = fwrite($fh, $str);
            fclose($fh);
        } catch(Exception $e){
            //
        }
    }
    
    private function _updateBanners($banners){
        $i = 1;
        $update = array();
        foreach($banners as $banner){
            $banner['id'] = $i;
            $update[] = $banner;
            $i++;
        }
        return $update;
    }
    
}