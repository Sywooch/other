<?php
/*
 * <?=LangAdmin::get('the_class_forms_a_collection_of_goods')?>
 * 1 -  Best
 * 2 - Popular
 * 3 - Recommend
 */

include dirname(__FILE__).'/GeneralUtil.class.php';

class Set extends GeneralUtil {
    
    function defaultAction()
    {
        if (Login::auth())
        {
            global $otapilib;
            $sid = $_SESSION['sid'];
            
            $recommend = $otapilib->GetItemRatingList('Best',20,0);
            if ($otapilib->error_message == 'SessionExpired')
            {
                header('Location: index.php?expired');
                die;
            }
            
            $popular = $otapilib->GetItemRatingList('Popular',20,0);
            if ($otapilib->error_message == 'SessionExpired')
            {
                header('Location: index.php?expired');
                die;
            }
            
            $brandsSets = array('Best', );
            $result = $otapilib->GetBrandRatingList('Best', 100, 0);
            if ($otapilib->error_message == 'SessionExpired')
            {
                header('Location: index.php?expired');
                die;
            }
            
            if (isset($_COOKIE['HiddenRecom']))
            {
                $hidden_recom = @(int)$_COOKIE['HiddenRecom'];
            } else {
                $hidden_recom = 1;
            }
            
            if (isset($_COOKIE['HiddenPopular']))
            {
                $hidden_popular = @(int)$_COOKIE['HiddenPopular'];
            } else {
                $hidden_popular = 1;
            }

            $vendors = $this->getVendorsSet();

            include(TPL_DIR.'sets.php');
            if(isset($_SESSION['error'])) unset($_SESSION['error']);
        } else {
            include(TPL_DIR.'login.php');
        } 
    }
    
    function savestatAction()
    {
        setcookie("HiddenRecom", @$_GET['statr'], time()+3600*24*30);
        setcookie("HiddenPopular", @$_GET['statp'], time()+3600*24*30);
        setcookie("HiddenBrandsSets", @$_GET['statbb'], time()+3600*24*30);
    }
    
    function getItemInfoAction(){
        @define('NO_DEBUG', 1);
        global $otapilib;
        $item = $otapilib->GetItemFullInfo($_GET['id']);
        print json_encode( $item );
    }
    
    function getItemDescrAction(){
        @define('NO_DEBUG', 1);
        global $otapilib;
        $item = $otapilib->GetItemDescription($_GET['id']);
        print json_encode( $item );
    }
    
    function saveTitleAction(){
        @define('NO_DEBUG', 1);
        global $otapilib;
        $sid = $_SESSION['sid'];
        $key = "taobao:Item:Title";
        $res = $otapilib->EditTranslateByKey($sid, $_POST['descr'], $key, $_POST['id'], 'ru');
        if(!$res){
            print $otapilib->error_message;
        }
        else{
            print LangAdmin::get('transfer_saved_successfully');
        }
    }
    
    function saveDescrAction(){
        @define('NO_DEBUG', 1);
        global $otapilib;
        $sid = $_SESSION['sid'];
        $key = "taobao:Item:Description";
        $res = $otapilib->EditTranslateByKey($sid, $_POST['descr'], $key, $_POST['id'], 'ru');
        if(!$res){
            print $otapilib->error_message;
        }
        else{
            print LangAdmin::get('transfer_saved_successfully');
        }
    }
    
    function addAction(){
        if (Login::auth())
        {
            global $otapilib;
            
            $sid = $_SESSION['sid'];
            $_SESSION['clear_cache'] = 1;

            $itemid = @$_POST['itemid'];
            $type = @$_POST['type'];
     
            if(preg_match( '/(http)/i', $itemid )) 
            {
                $url = parse_url($itemid);
                $params = $this->_parse_query($url['query']);
                if(isset($params['id']))
                {
                    $itemid = $params['id'];
                }
                elseif(isset($params['brand']))
                {
                    $itemid = $params['brand'];
                }
            }
            
            if(isset($_POST['isBrand'])){
                $result = $otapilib->AddElementsSetToRatingList($sid,$_POST['brandSet'],'Brand',0,$itemid);
                $active_tab = 3;
            }
            else{
                $result = $otapilib->AddElementsSetToRatingList($sid,$type,'Item',0,$itemid);
                $active_tab = 1;
            }
            
            if ($otapilib->error_message == 'SessionExpired')
            {
                header('Location: index.php?expired');
                die;
            }
            header('Location: index.php?cmd=set&sid=&active_tab='.$active_tab);
        } else {
            include(TPL_DIR.'login.php');
        } 
    }
    
    function delAction(){
        if (Login::auth())
        {
            global $otapilib;

            $_SESSION['clear_cache'] = 1;
            $sid = $_SESSION['sid'];
            
            $itemList = @$_GET['id'];
            $itemRatingTypeId = @$_GET['type'];
            $contentType = @$_GET['isBrand'] ? 'Brand' : 'Item';
            $categoryId = 0;

            $result = $otapilib->RemoveElementsSetRatingList($sid, $itemRatingTypeId, $contentType, $categoryId, $itemList);
            $active_tab = ($contentType == 'Brand') ? 3 : 1;
            if ($otapilib->error_message == 'SessionExpired')
            {
                header('Location: index.php?expired');
                die;
            }

            if (isset($_GET['return1'])) {
                header('Location: ' . $_GET['return']);
            } else {
                header('Location: index.php?cmd=set&sid=&active_tab='.$active_tab);
            }

        } else {
            include(TPL_DIR.'login.php');
        } 
    }
    
    function delallAction(){
        if (Login::auth())
        {
            global $otapilib;

            $_SESSION['clear_cache'] = 1;
            $sid = $_SESSION['sid'];
            $type = @$_POST['type'];
            $contentType = @$_POST['isBrand'] ? 'Brand' : 'Item';
            
            $result = $otapilib->RemoveAllElementsRatingList($sid, $type, $contentType, 0);

            if ($otapilib->error_message == 'SessionExpired')
            {
                header('Location: index.php?expired');
                die;
            }
            header('Location: index.php?cmd=set&sid=');
            
        } else {
            include(TPL_DIR.'login.php');
        } 
    }
    
    function saveorderAction(){
        if (Login::auth())
        {
            global $otapilib;

            $_SESSION['clear_cache'] = 1;
            $sid  = $_SESSION['sid'];
            $type = @$_POST['type'];
            $ids  = @$_POST['ids'];
            $contentType = @$_POST['isBrand'] ? 'Brand' : 'Item';
            $contentType = @$_POST['isVendor'] ? 'Vendor' : $contentType;

            $result = $otapilib->RemoveAllElementsRatingList($sid, $type, $contentType,0);

            if($result)
            {
                $result = $otapilib->AddElementsSetToRatingList($sid, $type, $contentType, 0, $ids);
            }
            
            if ($otapilib->error_message == 'SessionExpired')
            {
                header('Location: index.php?expired');
                die;
            }

            header('Location: ' . $_POST['return']);
            
        } else {
            include(TPL_DIR.'login.php');
        } 
    }
    
    private function _parse_query($var)
    {
        $var  = html_entity_decode($var);
        $var  = explode('&', $var);
        $arr  = array();

        foreach($var as $val)
        {
            $x          = explode('=', $val);
            $arr[$x[0]] = $x[1];
        }
        unset($val, $x, $var);
        return $arr;
    }
    
    function getBrandSetAction(){
        @define('NO_DEBUG', 1);
        if (Login::auth())
        {
            global $otapilib;
            
            $type = @$_POST['type'];
            
            setcookie("BrandSet", $type, time()+3600*24*30);
            
            $result = $otapilib->GetBrandRatingList($type, 100, 0);  
            print json_encode($result);
        } else {
            print(json_encode(array()));
        } 
    }

    private function validateVendorAddForm(){
        $res = array(true);
        if(!$_POST['VendorName'])
            $res = array(false, LangAdmin::get('not_entered_vendor_name'));
        if(!$_POST['Name'])
            $res = array(false, LangAdmin::get('not_entered_vendor_id'));
        if(!$res[0]){
            $this->setErrorAndRedirect($res[1], 'index.php?cmd=set&active_tab=4');
            return false;
        }
        return true;
    }

    function getVendorsSet(){
        global $otapilib;

        if(!$this->checkAuth()) return false;
        $vendors = $otapilib->GetVendorRatingList('Best', 200, 0);
        if($vendors === false){
            $_SESSION['error'] = $otapilib->error_message;
            return array();
        }

        $cms = new CMS();
        if(!$cms->Check()){
            $_SESSION['error'] = LangAdmin::get('error_connecting_to_database');
            return array();
        }
        $cms->checkTable('site_vendors_images');

        foreach( $vendors as &$vendor ){
            $q = mysql_query('SELECT * FROM `site_vendors_images`
            WHERE `vendor_id`="'.mysql_real_escape_string($vendor['Id']).'"');

            $row = mysql_fetch_assoc($q);
            $vendor['image_path'] = $row['image_path'];
            $vendor['vendor_name'] = $row['vendor_name'];
        }

        return $vendors;
    }

    function addVendorAction(){
        require 'Upload2.php';
        
        global $otapilib;
        if(!$this->checkAuth()) return false;
        if(!$this->validateVendorAddForm()) return false;
        $_SESSION['clear_cache'] = 1;

        //$vendorExists = $otapilib->GetVendorInfo($_POST['Name']);
        //print_r($vendorExists);
        //if($vendorExists === false)
        //    return $this->setErrorAndRedirect($otapilib->error_message, 'index.php?cmd=set&active_tab=4');

        $addResult = $otapilib->AddElementsSetToRatingList($_SESSION['sid'], 'Best', 'Vendor', 0, $_POST['Name']);
        if($addResult === false)
            return $this->setErrorAndRedirect($otapilib->error_message, 'index.php?cmd=set&active_tab=4');

        $cms = new CMS();
        if(!$cms->Check())
            return $this->setErrorAndRedirect(LangAdmin::get('error_connecting_to_database'), 'index.php?cmd=set&active_tab=tabs-4');
        $cms->checkTable('site_vendors_images');

        $vendorId = mysql_real_escape_string($_POST['Name']);
        $vendorName = mysql_real_escape_string($_POST['VendorName']);
        
        $allowedExtensions = array("jpeg", "jpg", "gif", "png", "bmp", "swf");
        $sizeLimit = 20 * 1024 * 1024;

        $uploader = new qqFileUploader($allowedExtensions, $sizeLimit);
        $result = $uploader->handleUpload(dirname(dirname(dirname(__FILE__))).'/brands_uploads/');

        $result = mysql_query('
            INSERT INTO `site_vendors_images`
            SET `vendor_id`="'.$vendorId.'"
                ,`vendor_name`="'.$vendorName.'"
                ,`image_path`="'.$result['url'].'"
        ');

        header('Location: index.php?cmd=set&active_tab=4');

        return $result;
    }

    /**
     * @param RequestWrapper $request
     * @return bool|resource
     */
    function deleteVendorAction($request){
        global $otapilib;
        if(!$this->checkAuth()) return false;
        $id = $request->getValue('id');
        $removeResult = $otapilib->RemoveElementsSetRatingList(Session::get('sid'), 'Best', 'Vendor', 0, $id);
        if($removeResult === false){
            return $this->setErrorAndRedirect($otapilib->error_message, 'index.php?cmd=set&active_tab=4');
        }
        $_SESSION['clear_cache'] = 1;

        $result = mysql_query('
            DELETE FROM `site_vendors_images`
            WHERE `vendor_id`="'.mysql_real_escape_string($id).'"
        ');

        header('Location: index.php?cmd=set&active_tab=4');
        return $result;
    }
}