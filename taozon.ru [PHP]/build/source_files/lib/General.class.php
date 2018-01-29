<?php

class General {
    static $siteConf = array();
    static $enabledFeatures = array();
    static $isContent = false;
    static $showVendorSalesVolume = false;

    public static function rrmdir($dir, $removeDir = true){
        if (is_dir($dir)) {
            $objects = scandir($dir);
            foreach ($objects as $object) {
                if ($object != "." && $object != "..") {
                    if (filetype($dir."/".$object) == "dir") self::rrmdir($dir."/".$object); else unlink($dir."/".$object);
                }
            }
            reset($objects);
            if($removeDir)
                rmdir($dir);
        }
    }

    public static function mail_utf8($to, $from_user, $from_email,
                       $subject = '(No subject)', $message = '')
    {
        $from_user = "=?UTF-8?B?".base64_encode($from_user)."?=";
        $subject = "=?UTF-8?B?".base64_encode($subject)."?=";

        $headers = "From: $from_user <$from_email>\r\n".
            "MIME-Version: 1.0" . "\r\n" .
            "Content-type: text/html; charset=UTF-8" . "\r\n";

        return mail($to, $subject, $message, $headers);
    }

    public static function sessionExpiredHandle($show = true){
        global $otapilib;
        if($otapilib->error_message == 'SessionExpired' || !$_SESSION[CFG_SITE_NAME.'loginUserData']['IsAuthenticated']){
            header('Location: index.php?p=login');
            die();
        }
        elseif($show){
            show_error();
        }
    }

    public static function loadEnabledFeatures(){
        global $otapilib;

		if(file_exists(CFG_APP_ROOT.'/cache/GetEnabledFeatures.dat')){
			self::$enabledFeatures = unserialize(file_get_contents(CFG_APP_ROOT.'/cache/GetEnabledFeatures.dat'));
			if (!isset(self::$enabledFeatures['loaded'])||self::$enabledFeatures['loaded']+3600<time())
				unlink (CFG_APP_ROOT.'/cache/GetEnabledFeatures.dat');
		}
		if(!file_exists(CFG_APP_ROOT.'/cache/GetEnabledFeatures.dat')){
			$enabledFeatures = $otapilib->GetEnabledFeatures();
            if($enabledFeatures === false){
                if(function_exists('show_error'))
                    show_error();
                return;
            }

            foreach ($enabledFeatures as $key=>$feature){
				$enabledFeatures[$key] = (string)$feature;
			}
			$enabledFeatures['loaded']=time();

            self::$enabledFeatures = $enabledFeatures;
			if(!empty($enabledFeatures)) {
                file_put_contents(CFG_APP_ROOT.'/cache/GetEnabledFeatures.dat', serialize($enabledFeatures));
			}
        }
    }

    public static function getLangs(){
            global $otapilib;

            if(!file_exists(CFG_APP_ROOT.'/cache/GetLanguageInfoList.dat')){
                    $langs = $otapilib->GetLanguageInfoList();
        if($langs===false and function_exists('show_error'))
            show_error();
                    if($langs)
                            file_put_contents(CFG_APP_ROOT.'/cache/GetLanguageInfoList.dat', serialize($langs));
            }
            else{
                    $langs = unserialize(file_get_contents(CFG_APP_ROOT.'/cache/GetLanguageInfoList.dat'));
            }

            return $langs;
    }

    public static function validateLangs($langs){
        if($langs === false){
            return ;
        }
        $valid = false;
        if( @$_SESSION['active_lang'] ){
            foreach($langs as $l){
                if($l['Name'] == $_SESSION['active_lang']){
                    $valid = true;
                    break;
                }
            }
        }
        if($langs && count($langs) > 0 && (!isset($_SESSION['active_lang']) || empty($_SESSION['active_lang']) || !$valid))
            $_SESSION['active_lang'] = $langs[0]['Name'];
        $GLOBALS['langs'] = $langs;
        Lang::getTranslations();
    }
    
    public static function setConf(){
        $cms = new CMS();
        if(!$cms->Check())
            return ;
        if(!$cms->checkTable('site_config'))
            return ;
        
        $res = $cms->getSiteConfig();
        self::$siteConf = $res[1];
        self::$siteConf['price_round_decimals'] = defined('CFG_ROUND_DECIMALS') ? CFG_ROUND_DECIMALS : 2;
        self::$siteConf['friendly_urls'] = defined('CFG_FRIENDLY_URLS') ? CFG_FRIENDLY_URLS : false;
        self::$siteConf['base_href'] = defined('CFG_BASE_HREF') ? CFG_BASE_HREF : '';
        self::$showVendorSalesVolume = defined('CFG_SHOW_VENDOR_SALES') ? CFG_SHOW_VENDOR_SALES : false;
        
        if (@General::$siteConf['CFG_PREFIX_REPLACE_USR']) @define('CFG_PREFIX_REPLACE_USR', General::$siteConf['CFG_PREFIX_REPLACE_USR']);
        if (@General::$siteConf['CFG_PREFIX_REPLACE_ORD']) @define('CFG_PREFIX_REPLACE_ORD', General::$siteConf['CFG_PREFIX_REPLACE_ORD']);
    }

    public static function init(){
        $langs = self::getLangs();
        self::validateLangs($langs);
        self::loadEnabledFeatures();
        self::setConf();
        $GLOBALS['pagetitle'] = '';
    }
    
    public static function generateUrl($p, $params){
        $method = "generate".ucfirst($p)."Url";
        return UrlGenerator::$method($params);
    }

    public static function getCurrencyPrice($item){
        if(@$_SESSION['currency']){
            foreach($item['Price']['ConvertedPriceList'] as $k=>$v){
                if($v['Code'] == $_SESSION['currency'])
                    break;
            }
            return self::priceFormat($item['Price']['ConvertedPriceList'][$k]['Val'], (int)self::$siteConf['price_round_decimals'])." ".$item['Price']['ConvertedPriceList'][$k]['Sign'];
        }
        else{
            $price = str_replace(',','.',$item['Price']['ConvertedPriceList'][0]['Val']);
            if (defined('CFG_GLOBAL_DELIVERY_PRICE'))
            {
                $price += round(@CFG_GLOBAL_DELIVERY_PRICE * $item['ApproxWeight']);
            }
            $sign = $item['Price']['ConvertedPriceList'][0]['Sign'];
            if(defined('CFG_MONGOL_PRICE'))
                return self::priceFormat($price, (int)self::$siteConf['price_round_decimals'])." ". $sign;
            elseif(defined('CFG_ROUND_DECIMALS'))
                return self::priceFormat($price, (int)self::$siteConf['price_round_decimals'])." ". $sign;
            else
                return self::priceFormat($item['Price']['ConvertedPriceList'][0]['Val'], (int)self::$siteConf['price_round_decimals']) ." ". $sign;
        }
    }
	
	public static function getCurrencyPromoPrice($item){
        if(@$_SESSION['currency']){
            foreach($item['PromotionPrice'] as $k=>$v){				
                if($v['Code'] == $_SESSION['currency'])
                    break;
            }
			
            return self::priceFormat($item['PromotionPrice'][$k]['Val'], (int)self::$siteConf['price_round_decimals'])." ".$item['PromotionPrice'][$k]['Sign'];
        }
        else{
            $price = str_replace(',','.',$item['PromotionPrice'][0]['Val']);
            if (defined('CFG_GLOBAL_DELIVERY_PRICE'))
            {
                $price += round(@CFG_GLOBAL_DELIVERY_PRICE * $item['ApproxWeight']);
            }
            $sign = $item['PromotionPrice'][0]['Sign'];
            if(defined('CFG_MONGOL_PRICE'))
                return self::priceFormat($price, (int)self::$siteConf['price_round_decimals'])." ". $sign;
            elseif(defined('CFG_ROUND_DECIMALS'))
                return self::priceFormat($price, (int)self::$siteConf['price_round_decimals'])." ". $sign;
            else
                return self::priceFormat($item['PromotionPrice'][0]['Val'], (int)self::$siteConf['price_round_decimals']) ." ". $sign;
        }
    }

    public static function getSeoText($id){
        $cms = new CMS();
        $cms->Check();
        $cms->checkTable('site_categories_seo_texts');
        $id = mysql_real_escape_string($id);
        $q = mysql_query('SELECT text FROM `site_categories_seo_texts` WHERE `category_id`="'.$id.'"');
        return @mysql_result($q, 0);
    }

    public static function rus2translit($string) {
        $converter = array(
            'а' => 'a', 'б' => 'b', 'в' => 'v',
            'г' => 'g', 'д' => 'd', 'е' => 'e',
            'ё' => 'e', 'ж' => 'zh', 'з' => 'z',
            'и' => 'i', 'й' => 'y', 'к' => 'k',
            'л' => 'l', 'м' => 'm', 'н' => 'n',
            'о' => 'o', 'п' => 'p', 'р' => 'r',
            'с' => 's', 'т' => 't', 'у' => 'u',
            'ф' => 'f', 'х' => 'h', 'ц' => 'c',
            'ч' => 'ch', 'ш' => 'sh', 'щ' => 'sch',
            'ь' => '', 'ы' => 'y', 'ъ' => '',
            'э' => 'e', 'ю' => 'yu', 'я' => 'ya',
            'А' => 'A', 'Б' => 'B', 'В' => 'V',
            'Г' => 'G', 'Д' => 'D', 'Е' => 'E',
            'Ё' => 'E', 'Ж' => 'Zh', 'З' => 'Z',
            'И' => 'I', 'Й' => 'Y', 'К' => 'K',
            'Л' => 'L', 'М' => 'M', 'Н' => 'N',
            'О' => 'O', 'П' => 'P', 'Р' => 'R',
            'С' => 'S', 'Т' => 'T', 'У' => 'U',
            'Ф' => 'F', 'Х' => 'H', 'Ц' => 'C',
            'Ч' => 'Ch', 'Ш' => 'Sh', 'Щ' => 'Sch',
            'Ь' => '', 'Ы' => 'Y', 'Ъ' => '',
            'Э' => 'E', 'Ю' => 'Yu', 'Я' => 'Ya',
        );
        return strtr($string, $converter);
    }

    public static function log($type, $message){
        $cms = new CMS();
        $cms->Check();

        $cms->checkTable('site_logs');
        $t = time();
        mysql_query("INSERT INTO `site_logs` SET `log_type` = '$type', `added` = '$t', `text` = '$message'");
    }

    // format price
    public static function priceFormat($price, $decimals) {
        return number_format($price, $decimals, '.', ' ');
    }
	
	//Парсинг логов
	public static function GetArreyLogs($traceLogs) {    	
			//Обработка.
	    	$logArrey=array();
			//учет вложености  - был массив теперь проще 2 переменные
			$flog=0; //певая
			$slog=0;  //вторая
		
        	krsort($traceLogs);
        	foreach($traceLogs as $time=>$line) {            				
				////=================================Заполняем массив==============================
				$strs = explode("\r\n", $line);				
				foreach ($strs as $item2) {
					$str = explode("\n", $item2);
					foreach ($str as $item) {
						//print ' FO -  '.$item."<br>";
						if ($item<>"") {
		    				switch(substr_count($item,"|"))   {
							case "0": 							
								if (substr_count($item,date('Y-m-d'))>0) {
									$flog=$flog+1; 						
									$slog=0; //Очищаем вложенсть у текущего	
									list($logArrey[$flog]['method'],$logArrey[$flog]['time']) = explode(" — ", trim($item));	
								}												
								break;		
							case "1":
		    					$slog=$slog+1;								   	
		    					if (substr_count($line,"overhead")>0) {
									preg_match_all("/\|(.*)=(.*)\(overhead:(.*)\)/isU", $item, $matches_over, PREG_PATTERN_ORDER);
									$logArrey[$flog][$slog]['method']=trim($matches_over[2][0]);	 $logArrey[$flog][$slog]['time']=trim($matches_over[1][0]);	$logArrey[$flog][$slog]['overtime']=trim($matches_over[3][0]);		
								} else {
									preg_match_all("/\|(.*)=(.*)/isU", $item, $matches_over, PREG_PATTERN_ORDER);
									$logArrey[$flog][$slog]['method']=trim($matches_over[2][0]);
								}
							break;				
  							}
				    	}
			 		}
				}			
				///==================================================================================
			
        	}    			
        return $logArrey;
    }

    public static function getSiteConfig($name) {
        $cms = new CMS();
        if(!$cms->Check())
            return;
        if(!$cms->checkTable('site_config'))
            return;

        $res = $cms->getSiteConfigMultipleLanguages($name);
        if ($res) {
            return $res;
        } else {
            return '';
        }
    }

}

?>
