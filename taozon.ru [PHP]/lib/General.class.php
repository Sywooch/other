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
                       $subject = '(No subject)', $message = '',$convertNewLines = false)
    {
        if(defined('CFG_DENY_MAIL_SENDING')) {
            return true;
        }
        if ($convertNewLines) {
            $message = nl2br($message);
        }        
        $sender = new MailSender($from_user, $from_email, $subject, $message);
        if (self::checkPHPVersion('5.3.0')) {
            if (self::getConfigValue('email_smtp_adress')) { 
                $sender->setSMTP(
                    self::getConfigValue('email_smtp_security'),
                    self::getConfigValue('email_smtp_adress'),
                    self::getConfigValue('email_smtp_port'),
                    self::getConfigValue('email_smtp_user'),
                    self::getConfigValue('email_smtp_pass')
                );
            }
        }        
        $sender->addAddress($to);
        $sender->sendMail();
    }
    
    public static function checkPHPVersion($min_version)
    {
        if (version_compare(phpversion(), $min_version, '>=')) {
            return true;
        } else {
            return false;
        }
    }

    public static function mail_utf8_txt($to, $from_user, $from_email,
                       $subject = '(No subject)', $message = '')
    {
        //Пишем в файл
        $fp = fopen("notyfy_tests.dat", "w+");
        fwrite($fp, $to."<br>".$subject."<br>".$message."<br><br><br>");
        fclose($fp);
    }

    public static function sessionExpiredHandle($show = true)
    {
        global $otapilib;
        if ($otapilib->error_message == 'SessionExpired' || !Session::isAuthenticated()) {
            header('Location: index.php?p=login');
            die();
        } elseif ($show) {
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
        self::$siteConf['price_round_decimals'] = self::getNumConfigValue('price_rounding', 2);
        self::$siteConf['friendly_urls'] = defined('CFG_FRIENDLY_URLS') ? CFG_FRIENDLY_URLS : false;
        self::$siteConf['base_href'] = defined('CFG_BASE_HREF') ? CFG_BASE_HREF : '';
        self::$showVendorSalesVolume = defined('CFG_SHOW_VENDOR_SALES') ? CFG_SHOW_VENDOR_SALES : false;

        if (self::getConfigValue('CFG_PREFIX_REPLACE_USR')) {
            @define('CFG_PREFIX_REPLACE_USR', self::getConfigValue('CFG_PREFIX_REPLACE_USR'));
        }
        if (self::getConfigValue('CFG_PREFIX_REPLACE_ORD')) {
            @define('CFG_PREFIX_REPLACE_ORD', self::getConfigValue('CFG_PREFIX_REPLACE_ORD'));
        }
    }

    public static function init(){
        self::setConf();
        $langs = self::getLangs();
        self::validateLangs($langs);
        self::loadEnabledFeatures();
        $GLOBALS['pagetitle'] = '';
    }

    public static function generateUrl($p, $params){
        $method = "generate".ucfirst($p)."Url";
        return UrlGenerator::$method($params);
    }

    public static function getCurrencyPrice($item){
        if(Session::get('currency')){
            return self::priceFormatForCurrency($item);
        }
        else{
            return self::roundAndFormatPrice($item);
        }
    }

    public static function priceFormatForCurrency($item){
        foreach($item['Price']['ConvertedPriceList'] as $k=>$v){
            if($v['Code'] == $_SESSION['currency'])
                break;
        }
        return self::priceFormat($item['Price']['ConvertedPriceList'][$k]['Val'], (int)self::$siteConf['price_round_decimals'])." ".$item['Price']['ConvertedPriceList'][$k]['Sign'];
    }

    public static function roundAndFormatPrice($item){
        $price = str_replace(',','.',$item['Price']['ConvertedPriceList'][0]['Val']);
        if (defined('CFG_GLOBAL_DELIVERY_PRICE'))
            $price += round(CFG_GLOBAL_DELIVERY_PRICE * $item['ApproxWeight']);
        $sign = $item['Price']['ConvertedPriceList'][0]['Sign'];
        $roundDecimals = self::getNumConfigValue('price_rounding', 2);
        return self::priceFormat($price, $roundDecimals)." ". $sign;
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
            elseif(self::getNumConfigValue('price_rounding'))
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
        return is_numeric($price) ? number_format($price, $decimals, '.', ' ') : '';
    }

    // Парсинг логов.
    public static function GetArrayLogs($traceLogs)
    {
        // Обработка.
        $logArray = array();
        // Учет вложености  - был массив теперь проще 2 переменные.
        $firstLevelLog = 0; // Первая.
        $secondLevelLog = 0;  // Вторая.

        krsort($traceLogs);
        foreach ($traceLogs as $time => $serviceLog) {
            $serviceLog = preg_replace('#[\r\n]+#si', "\n", $serviceLog);
            $lines = array_filter(explode("\n", $serviceLog));
            foreach ($lines as $line) {
                switch (substr_count($line, "|")) {
                    case "0":
                        if (strpos($line, date('Y-m-d')) !== false) {
                            $firstLevelLog++;
                            $secondLevelLog = 0; // Очищаем вложенность у текущего.
                            preg_match('/OTAPIlib\-\>(?P<method>[a-zA-Z0-9]+).*<!--time-->(?P<time>.*)<!--\/time-->/', trim($line), $match);
                            $logArray[$firstLevelLog]['time'] = isset($match['time']) ? $match['time'] : 0;
                            $logArray[$firstLevelLog]['method'] = isset($match['method']) ? $match['method'] : '';
                        }
                        break;
                    case "1":
                        if (preg_match('/\|[^0-9]*(?P<time>[0-9,]+).*overhead: (?P<overhead>[0-9,]+)/is', $line, $match)) {
                            $secondLevelLog++;
                            $logArray[$firstLevelLog][$secondLevelLog]['time']     = isset($match['time']) ? $match['time'] : 0;
                            $logArray[$firstLevelLog][$secondLevelLog]['method']   = $logArray[$firstLevelLog]['method'];
                            $logArray[$firstLevelLog][$secondLevelLog]['overtime'] = isset($match['overhead']) ? $match['overhead'] : 0;
                        }
                    break;
                }
            }
        }
        return $logArray;
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

    public static function getSiteNumConfig($name) {
        $cms = new CMS();
        if(!$cms->Check())
            return;
        if(!$cms->checkTable('site_config'))
            return;

        $res = $cms->getSiteConfigMultipleLanguages($name);
        if ($res===false)
            return false;

        if ($res)
            return $res;

        if ($res==0)
            return '00';
    }

    public static function getConfigValue($name, $default = null, $allowEmpty = true)
    {
        // если есть переменная для текущего языка, иначе ищем переменную для всех языков
        $name_lang = $name . '_' . Session::getActiveLang();
        $key = array_key_exists($name_lang, self::$siteConf) ? $name_lang : $name;

        $result = array_key_exists($key, self::$siteConf) ? self::$siteConf[$key] : $default;
        if ($allowEmpty) {
            return $result;
        } else {
            return !empty($result) ? $result : $default;
        }
    }

    public static function getNumConfigValue($name, $default = null, $allowEmpty = true)
    {
        $number = self::getConfigValue($name, $default, $allowEmpty);
        if ($number) {
            return $number;
        } elseif (! is_null($number) && ($number === 0 || $number === "0")) {
            return '00';
        } else {
            return $default;
        }
    }
    
    public static function getAllConfigValues()
    {
        return self::$siteConf;
    }
}
