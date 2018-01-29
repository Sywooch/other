<?php

class OTAPIlib
{
    // SERVICE settings
    static $version = "dev 4129";

    public $_server = '';
    //public $_server = 'http://otapi.business.dev.opentao.net/OtapiWebService.asmx/';
    //private $appKey = CFG_SERVICE_APPKEY;
    //private $appPassword = CFG_SERVICE_APPPASSWORD;
    private $instanceKey = CFG_SERVICE_INSTANCEKEY;

    // PROXY settings
    protected $_proxy = ''; // address:port
    protected $_proxyauth = ''; // login:pass

    public $error_message = '';
    public $error_code = '';
    public $call_method = '';

    public $_multi = false;

    public $_threads = array();
    public $_threads_timers = array();
    public $_threads_methods = array();

    public $muth = null;
    public $_mcount = 0;
    public $_mstatus = false;
    public $curl_timeout = 60;

    /* кеширование */
    private $_cache = false; //- кэшируем или нет.
    private $_life_time = 21600; // - 6 часов время на которое будем кешировать
    /* *** */

    //Выкидывать ли при возникновении ошибки Exception
    private $_error_as_exception = false;

    public function setErrorsAsExceptionsOn(){
        $this->_error_as_exception = true;
    }

    public function setErrorsAsExceptionsOff(){
        $this->_error_as_exception = false;
    }

    // установить кэширование
    public function CacheSetTrue()
    {
        $this->_cache = true;
        return true;
    }

    // отключить кэширование
    public function CacheSetFalse()
    {
        $this->_cache = false;
        return true;
    }

    static public function getInstance(){
        static $obj_server;
        if (!isset($obj_server)){
            $obj_server = new self();
        }
        return $obj_server;
    }

    public function __construct()
    {
        if(defined('CFG_SERVICE_URL')){
            $this->_server = CFG_SERVICE_URL;
        }
        else{

            $this->_server =  'http://otapi.business.demo.services.opentao.net/OtapiWebService2.asmx/';
        }
        //
    }

    // ВСПОМОГАТЕЛЬНЫЕ ФУНКЦИИ

    public function InitMulti()
    {
        $this->_multi = true;
        $this->_mstatus = false;
        $this->_mcount = 0;
        $this->muth = curl_multi_init();
        $this->_threads = array();
    }

    public function StopMulti()
    {
        $this->_multi = false;
        $this->_mstatus = false;
        $this->_mcount = 0;
        $this->_threads = array();
        $this->_threads_timers = array();
        curl_multi_close($this->muth);
    }

    public function MultiDo()
    {
        $count = timer::getInstance();
        $count->start('OTAPIlib->MultiRequest (count: '.count($this->_threads).')');
        for($i = 0; $i < count($this->_threads); $i++){
            $this->_threads_timers[$i] = new timer();
            $count_thread = &$this->_threads_timers[$i];
            $count_thread->start('OTAPIlib->'.$this->_threads_methods[$i]);
        }
        do {
            $mrc = curl_multi_exec($this->muth, $active);
        }
        while ($mrc == CURLM_CALL_MULTI_PERFORM);

        // выполняем, пока есть активные потоки
        while ($active && ($mrc == CURLM_OK)) {
            // если какой-либо поток готов к действиям
            if (curl_multi_select($this->muth, 0.0005) != -1) {
                // ждем, пока что-нибудь изменится
                do {
                    $mrc = curl_multi_exec($this->muth, $active);
                    // получаем информацию о потоке
                    $info = curl_multi_info_read($this->muth);
                    // если поток завершился
                    if ($info['msg'] == CURLMSG_DONE) {
                        $ch = $info['handle'];
                        // ищем урл страницы по дескриптору потока в массиве заданий
                        $num = array_search($ch, $this->_threads);
                        // забираем содержимое
                        $this->_threads[$num] = curl_multi_getcontent($ch);
                        // удаляем поток из мультикурла
                        curl_multi_remove_handle($this->muth, $ch);
                        // закрываем отдельное соединение (поток)
                        curl_close($ch);

                        $str = strstr($this->_threads[$num], '<?xml');
                        $count_thread = &$this->_threads_timers[$num];
                        $simplexml = simplexml_load_string($str);
                        $stat = (string)$simplexml->RequestTimeStatistic . "\n";
                        $count_thread->end($stat);
                    }
                }
                while ($mrc == CURLM_CALL_MULTI_PERFORM);
            }
        }

        $this->_mstatus = true;
        $this->_mcount = 0;
        $count->end('<br>');
    }


    /**
     * Обработка POST данных сервера
     * @param string $metod Метод для удаленного сервера
     * @param array $params Входные параметры
     * @return simplexml В случае успеха XML класс
     */
    protected function _getData($metod, $params = array())
    {
        $this->call_method = $metod;
        $count = timer::getInstance();
        $start = microtime(1);
        $count->start('OTAPIlib->' . $metod, $params);

        $simplexml = false;
        $this->error_message = '';
        $stat = '';
        $curdir = getcwd();
        chdir(dirname(__FILE__));

        /* кеширование xml овтета от сервера */
        $curl_request = true;
        if ($this->_cache) {
            $cache = New Cache_my($params['sessionId'], $metod);
            $data = $cache->GetData();
            // если есть кэш
            if ($data) {
                // если кэш не устарел
                if (($data) && ($data['time'] + $this->_life_time > time())) {
//                echo 'файл взят из кеша<br>';
                    $simplexml = @simplexml_load_string($data['data']);
                    if (!$simplexml) {
                        chdir($curdir);
                        return false;
                    }
                    $token_from_cache = true;
                    $curl_request = false;
                } else {
//                echo 'кэш устарел и был удален<br>';
                    $cache->DelData();
                }
            } else {
//            echo 'файл кэша не найден<br>';
            }
        }
        if ($curl_request) {
            /* */
            $curl = new Curl($this->_server . $metod, $this->curl_timeout, true, 10, false, true, false);

            $referrer = isset($_SERVER['HTTP_HOST']) ? 'http://' . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'] : 'localhost';
            $curl->setReferer($referrer);
            $curl->setPost(http_build_query($params));
            if ($this->_proxy) $curl->setProxy($this->_proxy, $this->_proxyauth);

            if ($this->_multi) {
                if (!$this->_mstatus) {
                    $curl->init();
                    curl_multi_add_handle($this->muth, $curl->_resource);
                    $this->_threads[$this->_mcount] = $curl->_resource;
                    $this->_threads_methods[$this->_mcount] = $metod;
                    $this->_mcount++;
                    chdir($curdir);
                    return false;
                }
                $cres = true;
            } else {
                $cres = $curl->connect();
            }
            if ($cres) {
                if ($this->_multi) {
                    $str = $this->_threads[$this->_mcount];
                    $str2 = $this->_threads[$this->_mcount];
                    $this->_mcount++;
                } else {
                    $str = $curl->__tostring();
                    $str2 = $curl->__tostring();
                }
                /* Warning: strpos() expects parameter 1 to be string при отключенном мульти вызове */
                $str = (string)$str;
                /* */
                $headers = trim(substr($str, 0, strpos($str, '<?xml')));
                $str = strstr($str, '<?xml');
                $headers = str_replace(chr(10), '', $headers);
                $headers_ = explode(chr(13), $headers);
                foreach ($headers_ as &$header) {
                    $header = explode(': ', $header);
                }
                $headers = array();
                foreach ($headers_ as $header) {
                    $headers[@$header[0]] = @$header[1];
                }
                $curlinfo = $curl->getInfo();
                foreach ($curlinfo as $param => $value) {
                    if (strpos($param, '_time') === false) unset($curlinfo[$param]);
                }
                if (file_exists('logs/writelog.php')) {
                    require_once('logs/writelog.php');
                    $logdata = array(
                        'servicename' => 'OTAPI',
                        'methodname' => $metod,
                        'request' => $params,
                        'response' => $str,
                        'time' => microtime(1) - $start,
                        'instancekey' => $params['instanceKey'],
                        'srv_url' => $this->_server,
                    );
                    @writeservicelog($logdata);
                }
                $simplexml = @simplexml_load_string($str);
                if (!$simplexml) {
                    $this->error_message = $str2;
                    $count->end('<font color="Red"><b>' . $str2 . '</b></font>');
                    chdir($curdir);
                    return false;
                }
                /* кеширование файла */
                if ($this->_cache) {
                    $cache->AddData($str);
//                echo 'Данные записаны в кеш<br>';
                }
                /* */
            } else {

                if (file_exists('logs/writelog.php')) {
                    require_once('logs/writelog.php');
                    $logdata = array(
                        'servicename' => 'OTAPI',
                        'methodname' => $metod,
                        'request' => $params,
                        'response' => 'No Response - ' . @curl_error($curl->_resource),
                        'time' => microtime(1) - $start,
                        'instancekey' => $params['instanceKey'],
                        'srv_url' => $this->_server,
                    );
                    @writeservicelog($logdata);
                }

                $this->error_code = 'No response';
                $this->error_message = 'Curl library does not work. Please contact a support of you hosting';

                $curlinfo = $curl->getInfo();
                foreach ($curlinfo as $param => $value) {
                    if (strpos($param, '_time') === false) unset($curlinfo[$param]);
                }
                //$stat .= print_r($curlinfo, 1);
                if (empty($str)) $str = 'Empty request or timeout';
                $count->end('<font color="Red"><b>' . $str . '</b></font>');
                chdir($curdir);
                return false;
            }
            /* кеширование файла */
        }
// отключаем кеширование для следующего вызова
        $this->CacheSetFalse();
        /* */

        chdir($curdir);
        if (isset($simplexml->ErrorCode) && (string)$simplexml->ErrorCode != 'Ok' && (string)$simplexml->ErrorCode != 'BatchError') {

            if($this->_error_as_exception){
                throw new ServiceException((string)$simplexml->ErrorDescription, (string)$simplexml->SubErrorCode);
            }

            if ((string)$simplexml->ErrorCode == 'SessionExpired') {
                $this->error_message = 'SessionExpired';
                unset($_SESSION['sid']);
                return false;
                //header('Location: index.php?expired');
                //die;
            }
            $this->error_message = $simplexml->ErrorDescription;
            $this->error_code = $simplexml->ErrorCode;
            $count->end($stat . '<font color="Red"><b>' . $this->error_message . '</b></font>');
            return false;
        }
        if (isset($headers) && isset($headers['X-Opentao-RequestHandleTime'])) {
            $stat .= 'X-Opentao-RequestHandleTime: ' . $headers['X-Opentao-RequestHandleTime'] . "\n";
        }
        timer::logXML($metod, $params, $simplexml->DebugInfo);
        $stat .= (string)$simplexml->RequestTimeStatistic . "\n";
        if(!$this->_multi && !isset($token_from_cache))
            $count->end($stat);
        return $simplexml;
    }

    private function _parseItemInfo($data)
    {
        $ItemFullInfo = array();
        $ItemFullInfo['id'] = (string)$data->Id;
        $ItemFullInfo['Id'] = (string)$data->Id;
        $ItemFullInfo['ApproxWeight'] = (string)@$data->ApproxWeight;
        $ItemFullInfo['IsValidPromotions'] = @(string)$data->IsValidPromotions;

        if (!trim($ItemFullInfo['id'])) return false;

        $ItemFullInfo['title'] = (string)$data->Title;
        $ItemFullInfo['Title'] = (string)$data->Title;
        $ItemFullInfo['masterprice'] = (string)$data->Price->OriginalPrice;
        $ItemFullInfo['MasterPrice'] = (string)$data->Price->OriginalPrice;
        $ItemFullInfo['marginprice'] = (string)$data->Price->MarginPrice;
        $ItemFullInfo['MarginPrice'] = (string)$data->Price->MarginPrice;
        $ItemFullInfo['convertedprice'] = (string)$data->Price->ConvertedPrice;
        $ItemFullInfo['ConvertedPrice'] = (string)$data->Price->ConvertedPrice;
        $ItemFullInfo['convertedpricewithoutsign'] = (string)$data->Price->ConvertedPriceWithoutSign;
        $ItemFullInfo['ConvertedPriceWithoutSign'] = (string)$data->Price->ConvertedPriceWithoutSign;
        $ItemFullInfo['currencysign'] = (string)$data->Price->CurrencySign;
        $ItemFullInfo['currencyname'] = (string)$data->Price->CurrencyName;

        $ItemFullInfo['IsSellAllowed'] = (string)$data->IsSellAllowed;

        $ItemFullInfo['Price']['ConvertedPriceList'] = array();
        if(isset($data->Price->ConvertedPriceList->DisplayedMoneys)){
            $prices = $data->Price->ConvertedPriceList->DisplayedMoneys->children();
            foreach($prices as $p){
                $ItemFullInfo['Price']['ConvertedPriceList'][] = array(
                    'Sign' => (string)$p['Sign'],
                    'Code' => (string)$p['Code'],
                    'Val'  => (string)$p[0]
                );
            }
        }
        $ItemFullInfo['Price']['DeliveryPrice'] = array();
        if(isset($data->Price->DeliveryPrice->ConvertedPriceList->DisplayedMoneys)){
            $prices = $data->Price->DeliveryPrice->ConvertedPriceList->DisplayedMoneys->children();
            foreach($prices as $p){
                $ItemFullInfo['Price']['DeliveryPrice'][(string)$p['Sign']] = array(
                    'Sign' => (string)$p['Sign'],
                    'Code' => (string)$p['Code'],
                    'Val'  => (string)$p[0]
                );
            }
        }
        $ItemFullInfo['Price']['PriceWithoutDelivery'] = array();
        if(isset($data->Price->PriceWithoutDelivery->ConvertedPriceList->DisplayedMoneys)){
            $prices = $data->Price->PriceWithoutDelivery->ConvertedPriceList->DisplayedMoneys->children();
            foreach($prices as $p){
                $ItemFullInfo['Price']['PriceWithoutDelivery'][(string)$p['Sign']] = array(
                    'Sign' => (string)$p['Sign'],
                    'Code' => (string)$p['Code'],
                    'Val'  => (string)$p[0]
                );
            }
        }
		
		$ItemFullInfo['PromotionPrice'] = array();
        if(isset($data->PromotionPrice->ConvertedPriceList->DisplayedMoneys)){
            $prices = $data->PromotionPrice->ConvertedPriceList->DisplayedMoneys->children();
            foreach($prices as $p){
                $ItemFullInfo['PromotionPrice'][] = array(
                    'Sign' => (string)$p['Sign'],
                    'Code' => (string)$p['Code'],
                    'Val'  => (string)$p[0]
                );
            }
        }
		

        $ItemFullInfo['masterquantity'] = (string)$data->MasterQuantity;
        $ItemFullInfo['mainpictureurl'] = (string) $data->MainPictureUrl;
        $ItemFullInfo['MainPictureUrl'] = (string)$data->MainPictureUrl;
        $ItemFullInfo['taobaoitemurl'] = (string) $data->TaobaoItemUrl;
        $ItemFullInfo['categoryid'] = (string)$data->CategoryId;
        $ItemFullInfo['CategoryId'] = (string)$data->CategoryId;
        $ItemFullInfo['stuffstatus'] = (string)$data->StuffStatus;
        $ItemFullInfo['StuffStatus'] = (string)$data->StuffStatus;

        $ItemFullInfo['vendorname'] = (string)$data->VendorName;
        $ItemFullInfo['VendorName'] = (string)$data->VendorName;
        $ItemFullInfo['vendorid'] = (string)$data->VendorId;
        $ItemFullInfo['VendorId'] = (string)$data->VendorId;
        $ItemFullInfo['vendorscore'] = (string)$data->VendorScore;
        $ItemFullInfo['VendorScore'] = (string)$data->VendorScore;
        $ItemFullInfo['volume'] = (string)$data->Volume;
        $ItemFullInfo['Volume'] = (string)$data->Volume;
        $ItemFullInfo['location'] = array();
        $ItemFullInfo['location']['city'] = (string)$data->Location->City;
        $ItemFullInfo['Location']['City'] = (string)$data->Location->City;
        $ItemFullInfo['location']['state'] = (string)$data->Location->State;
        $ItemFullInfo['Location']['State'] = (string)$data->Location->State;
        $ItemFullInfo['originaltitle'] = (string)$data->OriginalTitle;
        $ItemFullInfo['OriginalTitle'] = (string)$data->OriginalTitle;
        $ItemFullInfo['Features'] = array();
        foreach($data->Features->Feature as $feature){
            $ItemFullInfo['Features'][] = (string)$feature;
        }

        $ItemFullInfo['FeaturedValues'] = array();
        if(@$data->FeaturedValues->Value)
            foreach($data->FeaturedValues->Value as $feature){
                $ItemFullInfo['FeaturedValues'][ (string)$feature['Name'] ] = (string)$feature[0];
            }
        //информация о доставке
        if(isset($data->DeliveryCosts)){

            $ItemFullInfo['deliveryinfo'] = array();
            foreach($data->DeliveryCosts->OtapiDeliveryCost as $value){
                $ItemCost = array();
                $ItemCost['areacode'] = (string) $value->AreaCode;
                $ItemCost['mode'] = (string) $value->Mode;
                $ItemCost['cost'] = (string) $value->Price->ConvertedPrice;
                $ItemCost['costwithoutsing'] = (float) $value->Price->ConvertedPriceWithoutSign;

                $ItemCost['DisplayedMoneys'] = array();
                if(isset($value->Price->ConvertedPriceList->DisplayedMoneys)){
                    $prices = $value->Price->ConvertedPriceList->DisplayedMoneys->children();
                    foreach($prices as $p){
                        $ItemCost['DisplayedMoneys'][] = array(
                            'Sign' => (string)$p['Sign'],
                            'Code' => (string)$p['Code'],
                            'Val'  => (string)$p[0]
                        );
                    }
                }


                $ItemFullInfo['deliveryinfo'][] = $ItemCost;
            }
        }

        $ItemFullInfo['pictures'] = array();
        if($data->Pictures->ItemPicture){
            foreach($data->Pictures->ItemPicture as $value)
            {
                $ItemPicture = array();
                $ItemPicture['url'] = (string) $value->Url;
                $ItemPicture['ismain'] = (string) $value->IsMain;
                $ItemFullInfo['pictures'][] = $ItemPicture;
            }
        }

        $ItemFullInfo['description'] = (string) $data->Description;

        // Характеристики
        $properties = array();
        if (isset($data->Attributes->ItemAttribute)) foreach (@$data->Attributes->ItemAttribute as $value) {
            if ($value->IsConfigurator == 'false')
            {
                $arr['id'] = (string)$value->attributes()->Pid;
                $arr['name'] = (string)$value->PropertyName;
                $arr['value'] = (string)$value->Value;
                $arr['ValueAlias'] = (string)$value->ValueAlias;
                $properties[$arr['id']][] = $arr;
            }
        }

        $ItemFullInfo['properties'] = $properties;

        $properties2 = array();
        $item = array();
        // Конфигураторы
        if (isset($data->ConfiguredItems->OtapiConfiguredItem)) foreach (@$data->ConfiguredItems->OtapiConfiguredItem as $k => $v)
        {
            //print_r($v);
            $conf_id = (string) $v->Id;
            $item[$conf_id]['quantity'] = (string) $v->Quantity;
            $item[$conf_id]['price'] = (string) $v->Price->OriginalPrice;
            $item[$conf_id]['marginprice'] = (string) $v->Price->MarginPrice;
            $item[$conf_id]['convertedprice'] = (string) $v->Price->ConvertedPrice;
            $item[$conf_id]['ConvertedPriceWithoutSign'] = floatval($v->Price->ConvertedPriceWithoutSign);
            $item[$conf_id]['CurrencySign'] = (string) $v->Price->CurrencySign;

            $item[$conf_id]['ConvertedPriceList'] = array();
            if(isset($v->Price->ConvertedPriceList->DisplayedMoneys)){
                $prices = $v->Price->ConvertedPriceList->DisplayedMoneys->children();
                foreach($prices as $p){
                    $item[$conf_id]['ConvertedPriceList'][] = array(
                        'Sign' => (string)$p['Sign'],
                        'Code' => (string)$p['Code'],
                        'Val'  => (string)$p[0]
                    );
                }
            }

            $item[$conf_id]['PriceWithoutDelivery'] = array();
            if(isset($v->Price->PriceWithoutDelivery->ConvertedPriceList->DisplayedMoneys)){
                $prices = $v->Price->PriceWithoutDelivery->ConvertedPriceList->DisplayedMoneys->children();
                foreach($prices as $p){
                    $item[$conf_id]['PriceWithoutDelivery'][] = array(
                        'Sign' => (string)$p['Sign'],
                        'Code' => (string)$p['Code'],
                        'Val'  => (string)$p[0]
                    );
                }
            }

            if ($v->PictureUrl) {
                $item[$conf_id]['picture_url'] = (string) $v->PictureUrl;
            }

            $configurators = $v->Configurators;
            foreach ($configurators->ValuedConfigurator as $key => $param) {
                $prop_id = (string) $param->attributes()->Pid;
                $value_id = (string) $param->attributes()->Vid;
                $properties2[$prop_id][$value_id] = $value_id;
                $item[$conf_id]['config'][$prop_id] = $value_id;
            }
        }
        //pred($properties2);

        // Конфигурации
        $configurations = array();
        $arr = array();
        if (isset($data->Attributes->ItemAttribute)) foreach (@$data->Attributes->ItemAttribute as $value) {
            if ($value->IsConfigurator == 'true')
            {
                $id = (string)$value->attributes()->Pid;
                $configurations[$id]['id'] = $id;
                $configurations[$id]['name'] = (string)$value->PropertyName;
                $configurations[$id]['values'][] = array(
                    'id' => (string)$value->attributes()->Vid,
                    'name' => (string)$value->Value,
                    'alias' => (string)$value->ValueAlias,
                    'name_cny' => (string)$value->OriginalValue,
                    'alias_cny' => (string)$value->OriginalValueAlias,
                    'imageurl' => (string)$value->ImageUrl,
                    'miniimageurl' => (string)$value->MiniImageUrl,
                );
            }
        }

        $ItemFullInfo['configurations'] = $configurations;
        $ItemFullInfo['item_with_config'] = $item;
        $ItemFullInfo['properties2'] = $properties2;

        $promo = array();
        // Промо
        if (isset($data->Promotions->OtapiItemPromotion)){
            $p = $data->Promotions->OtapiItemPromotion;
            $promo['Id'] = (string)$p->Id;
            $promo['Name'] = (string)$p->Name;
            $promo['Desciption'] = (string)$p->Desciption;
            $promo['StartTime'] = (string)$p->StartTime;
            $promo['EndTime'] = (string)$p->EndTime;
            $promo['Price']['OriginalPrice'] = (string) $p->Price->OriginalPrice;
            $promo['Price']['MarginPrice'] = (string) $p->Price->MarginPrice;
            $promo['Price']['ConvertedPrice'] = (string) $p->Price->ConvertedPrice;
            $promo['Price']['ConvertedPriceWithoutSign'] = (string) $p->Price->ConvertedPriceWithoutSign;
            $promo['Price']['CurrencySign'] = (string) $p->Price->CurrencySign;
            $promo['Price']['CurrencyName'] = (string) $p->Price->CurrencyName;
			
			$promo['Price']['PriceWithoutDelivery'] = array();
			$promoPrices = array();			
			$prices = $p->Price->PriceWithoutDelivery->ConvertedPriceList->DisplayedMoneys->children();
            foreach($prices as $k){
               $promoPrices[] = array(
                  'Sign' => (string)$k['Sign'],
                  'Code' => (string)$k['Code'],
                  'Val'  => (string)$k[0]
                );
            }
			$promo['Price']['PriceWithoutDelivery'] = $promoPrices;
			
			
            $promo['ConfiguredItems'] = array();
            $citems = $p->ConfiguredItems;
            foreach ($citems->Item as $i) {
                $promoPrices = array();				
                if(isset($i->Price->ConvertedPriceList->DisplayedMoneys)){
                    $prices = $i->Price->ConvertedPriceList->DisplayedMoneys->children();
                    foreach($prices as $p){
                        $promoPrices[] = array(
                            'Sign' => (string)$p['Sign'],
                            'Code' => (string)$p['Code'],
                            'Val'  => (string)$p[0]
                        );
                    }
                }

                $promo['ConfiguredItems'][] = array(
                    'Id' => (string)$i->Id,
                    'Price' => array(
                        'OriginalPrice' => (string)$i->Price->OriginalPrice,
                        'MarginPrice' => (string)$i->Price->MarginPrice,
                        'ConvertedPrice' => (string)$i->Price->ConvertedPrice,
                        'ConvertedPriceWithoutSign' => (string)$i->Price->ConvertedPriceWithoutSign,
                        'CurrencySign' => (string)$i->Price->CurrencySign,
                        'CurrencyName' => (string)$i->Price->CurrencyName,
                        'ConvertedPriceList' => $promoPrices
                    )
                );
            }
        }

        $ItemFullInfo['Promotions'] = $promo;

        return $ItemFullInfo;
    }
    
    private function _parseItemsInfo($data)
    {
        $ItemsInfo = array();
        if (!empty($data)) foreach($data as $value)
        {
            $ItemInfo = $this->_parseItemInfo($value);
            if(!$ItemInfo) return false;
            $ItemsInfo[] = $ItemInfo;
        }
        return $ItemsInfo;
    }
    /**
     * Обработка информации о категориях
     * @param object $data Информация о категориях в объекте
     * @return array Информация о категориях в массиве
     */
    private function _parseCategotyInfo($data)
    {
        $CategoryInfoList = array();
        foreach ($data as $value)
        {
            $Category = array();
            $Category['id'] = (string)$value->Id;
            $Category['name'] = (string)$value->Name;
            $Category['isparent'] = (string)$value->IsParent;
            $Category['parentid'] = (string)$value->ParentId;
            $Category['ishidden'] = (string)$value->IsHidden;
            $Category['isvirtual'] = (string)$value->IsVirtual;
            $Category['internalid'] = (string)$value->InternalId;
            $Category['externalid'] = (string)$value->ExternalId;
            $CategoryInfoList[] = $Category;
        }
        return $CategoryInfoList;
    }
    
    /**
     * Данные по умолчанию для подключения к сервису
     * @return array $params
     */
    protected function defaultLogin($instanceKey = '') {
        $params = array(
            'instanceKey' => $instanceKey ? $instanceKey : $this->instanceKey,
            'language'    => @$_SESSION['active_lang'] ? @$_SESSION['active_lang'] : 'en'
        );
        return $params;
    }
    
    public function UpdateInstanceOptions($sessionId, $xmlInstanceOptionsData){
        $params = array(
            'sessionId' => $sessionId,
	    'xmlInstanceOptionsData' => $xmlInstanceOptionsData
        );
        $params += $this->defaultLogin();
        $simplexml = $this->_getData('UpdateInstanceOptions', $params);
        if (!$simplexml) return false;
        
        $data0 = array();
        
if(!isset($data0)){$data0 = array();}
	$data0_obj = @$simplexml;
	$data0 = @$data0_obj;
	return $data0;
    }
    public function GetLanguageInfoList(){
        $params = array(
            
        );
        $params += $this->defaultLogin();
        $simplexml = $this->_getData('GetLanguageInfoList', $params);
        if (!$simplexml) return false;
        
        $data0 = array();
        
if(!isset($data0)){$data0 = array();}

	if(!isset($simplexml->Result->Content) || is_null($simplexml->Result->Content) || !$simplexml->Result->Content)	$data0_obj = @array();

	else
	$data0_obj = @$simplexml->Result->Content->children();
	$data0 = @array();
	foreach($data0_obj as $value0){
		$data0_tmp = @array();
		$data0_tmp['Name'] = @(string)$value0->Name;
		$data0_tmp['name'] = @(string)$value0->Name;
		$data0_tmp['Description'] = @(string)$value0->Description;
		$data0_tmp['description'] = @(string)$value0->Description;
		$data0[] = @$data0_tmp;
	}
	return $data0;
    }
    public function GetCountryInfoList(){
        $params = array(
            
        );
        $params += $this->defaultLogin();
        $simplexml = $this->_getData('GetCountryInfoList', $params);
        if (!$simplexml) return false;
        
        $data0 = array();
        
if(!isset($data0)){$data0 = array();}

	if(!isset($simplexml->Result->Content) || is_null($simplexml->Result->Content) || !$simplexml->Result->Content)	$data0_obj = @array();

	else
	$data0_obj = @$simplexml->Result->Content->children();
	$data0 = @array();
	foreach($data0_obj as $value0){
		$data0_tmp = @array();
		$data0_tmp['Id'] = @(string)$value0->Id;
		$data0_tmp['id'] = @(string)$value0->Id;
		$data0_tmp['Name'] = @(string)$value0->Name;
		$data0_tmp['name'] = @(string)$value0->Name;
		$data0[] = @$data0_tmp;
	}
	return $data0;
    }
    public function GetOrderSettingsInfo($sessionId){
        $params = array(
            'sessionId' => $sessionId
        );
        $params += $this->defaultLogin();
        $simplexml = $this->_getData('GetOrderSettingsInfo', $params);
        if (!$simplexml) return false;
        
        $data0 = array();
        
if(!isset($data0)){$data0 = array();}
	$data0_obj = @$simplexml->Result;
if(!isset($data0['MinOrderCost'])){$data0['MinOrderCost'] = array();}
		$data1_obj = @$simplexml->Result->MinOrderCost;
		$data0['MinOrderCost'] = @$data1_obj;
	$data0['minordercost'] = @$data0['MinOrderCost'];
if(!isset($data0['MaxNoteItemsCount'])){$data0['MaxNoteItemsCount'] = array();}
		$data1_obj = @$simplexml->Result->MaxNoteItemsCount;
		$data0['MaxNoteItemsCount'] = @$data1_obj;
	$data0['maxnoteitemscount'] = @$data0['MaxNoteItemsCount'];
if(!isset($data0['MaxCartItemsCount'])){$data0['MaxCartItemsCount'] = array();}
		$data1_obj = @$simplexml->Result->MaxCartItemsCount;
		$data0['MaxCartItemsCount'] = @$data1_obj;
	$data0['maxcartitemscount'] = @$data0['MaxCartItemsCount'];
	return $data0;
    }
    public function UpdateOrderSettings($sessionId, $xmlUpdateData){
        $params = array(
            'sessionId' => $sessionId,
	    'xmlUpdateData' => $xmlUpdateData
        );
        $params += $this->defaultLogin();
        $simplexml = $this->_getData('UpdateOrderSettings', $params);
        if (!$simplexml) return false;
        
        $data0 = array();
        
if(!isset($data0)){$data0 = array();}
	$data0_obj = @$simplexml;
	$data0 = @$data0_obj;
	return $data0;
    }
    public function GetAllAreaList(){
        $params = array(
            
        );
        $params += $this->defaultLogin();
        $simplexml = $this->_getData('GetAllAreaList', $params);
        if (!$simplexml) return false;
        
        $data0 = array();
        
if(!isset($data0)){$data0 = array();}

	if(!isset($simplexml->Result->Content) || is_null($simplexml->Result->Content) || !$simplexml->Result->Content)	$data0_obj = @array();

	else
	$data0_obj = @$simplexml->Result->Content->children();
	$data0 = @array();
	foreach($data0_obj as $value0){
		$data0_tmp = @array();
		$data0_tmp['Id'] = @(string)$value0->Id;
		$data0_tmp['id'] = @(string)$value0->Id;
		$data0_tmp['Name'] = @(string)$value0->Name;
		$data0_tmp['name'] = @(string)$value0->Name;
		$data0_tmp['ParentId'] = @(string)$value0->ParentId;
		$data0_tmp['parentid'] = @(string)$value0->ParentId;
		$data0_tmp['Type'] = @(string)$value0->Type;
		$data0_tmp['type'] = @(string)$value0->Type;
		$data0_tmp['Zip'] = @(string)$value0->Zip;
		$data0_tmp['zip'] = @(string)$value0->Zip;
		$data0[] = @$data0_tmp;
	}
	return $data0;
    }
    public function GetRootAreaList(){
        $params = array(
            
        );
        $params += $this->defaultLogin();
        $simplexml = $this->_getData('GetRootAreaList', $params);
        if (!$simplexml) return false;
        
        $data0 = array();
        
if(!isset($data0)){$data0 = array();}

	if(!isset($simplexml->Result->Content) || is_null($simplexml->Result->Content) || !$simplexml->Result->Content)	$data0_obj = @array();

	else
	$data0_obj = @$simplexml->Result->Content->children();
	$data0 = @array();
	foreach($data0_obj as $value0){
		$data0_tmp = @array();
		$data0_tmp['Id'] = @(string)$value0->Id;
		$data0_tmp['id'] = @(string)$value0->Id;
		$data0_tmp['Name'] = @(string)$value0->Name;
		$data0_tmp['name'] = @(string)$value0->Name;
		$data0_tmp['ParentId'] = @(string)$value0->ParentId;
		$data0_tmp['parentid'] = @(string)$value0->ParentId;
		$data0_tmp['Type'] = @(string)$value0->Type;
		$data0_tmp['type'] = @(string)$value0->Type;
		$data0_tmp['Zip'] = @(string)$value0->Zip;
		$data0_tmp['zip'] = @(string)$value0->Zip;
		$data0[] = @$data0_tmp;
	}
	return $data0;
    }
    public function GetSubAreaList($parentId, $depthLevel){
        $params = array(
            'parentId' => $parentId,
	    'depthLevel' => $depthLevel
        );
        $params += $this->defaultLogin();
        $simplexml = $this->_getData('GetSubAreaList', $params);
        if (!$simplexml) return false;
        
        $data0 = array();
        
if(!isset($data0)){$data0 = array();}

	if(!isset($simplexml->Result->Content) || is_null($simplexml->Result->Content) || !$simplexml->Result->Content)	$data0_obj = @array();

	else
	$data0_obj = @$simplexml->Result->Content->children();
	$data0 = @array();
	foreach($data0_obj as $value0){
		$data0_tmp = @array();
		$data0_tmp['Id'] = @(string)$value0->Id;
		$data0_tmp['id'] = @(string)$value0->Id;
		$data0_tmp['Name'] = @(string)$value0->Name;
		$data0_tmp['name'] = @(string)$value0->Name;
		$data0_tmp['ParentId'] = @(string)$value0->ParentId;
		$data0_tmp['parentid'] = @(string)$value0->ParentId;
		$data0_tmp['Type'] = @(string)$value0->Type;
		$data0_tmp['type'] = @(string)$value0->Type;
		$data0_tmp['Zip'] = @(string)$value0->Zip;
		$data0_tmp['zip'] = @(string)$value0->Zip;
		$data0[] = @$data0_tmp;
	}
	return $data0;
    }
    public function GetCurrency(){
        $params = array(
            
        );
        $params += $this->defaultLogin();
        $simplexml = $this->_getData('GetCurrency', $params);
        if (!$simplexml) return false;
        
        $data0 = array();
        
if(!isset($data0)){$data0 = array();}
	$data0_obj = @$simplexml->Result;
if(!isset($data0['Code'])){$data0['Code'] = array();}
		$data1_obj = @$simplexml->Result->Code;
		$data0['Code'] = @(string)$data1_obj;
	$data0['code'] = @$data0['Code'];
if(!isset($data0['Description'])){$data0['Description'] = array();}
		$data1_obj = @$simplexml->Result->Description;
		$data0['Description'] = @(string)$data1_obj;
	$data0['description'] = @$data0['Description'];
if(!isset($data0['Sign'])){$data0['Sign'] = array();}
		$data1_obj = @$simplexml->Result->Sign;
		$data0['Sign'] = @(string)$data1_obj;
	$data0['sign'] = @$data0['Sign'];
	return $data0;
    }
    public function GetInstanceCurrencyInfoList(){
        $params = array(
            
        );
        $params += $this->defaultLogin();
        $simplexml = $this->_getData('GetInstanceCurrencyInfoList', $params);
        if (!$simplexml) return false;
        
        $data0 = array();
        
if(!isset($data0)){$data0 = array();}

	if(!isset($simplexml->Result->Content) || is_null($simplexml->Result->Content) || !$simplexml->Result->Content)	$data0_obj = @array();

	else
	$data0_obj = @$simplexml->Result->Content->children();
	$data0 = @array();
	foreach($data0_obj as $value0){
		$data0_tmp = @array();
		$data0_tmp['Code'] = @(string)$value0->Code;
		$data0_tmp['code'] = @(string)$value0->Code;
		$data0_tmp['Description'] = @(string)$value0->Description;
		$data0_tmp['description'] = @(string)$value0->Description;
		$data0_tmp['Sign'] = @(string)$value0->Sign;
		$data0_tmp['sign'] = @(string)$value0->Sign;
		$data0[] = @$data0_tmp;
	}
	return $data0;
    }
    public function AddBlackListContents($sessionId, $xmlContentList){
        $params = array(
            'sessionId' => $sessionId,
	    'xmlContentList' => $xmlContentList
        );
        $params += $this->defaultLogin();
        $simplexml = $this->_getData('AddBlackListContents', $params);
        if (!$simplexml) return false;
        
        $data0 = array();
        
if(!isset($data0)){$data0 = array();}
	$data0_obj = @$simplexml;
	$data0 = @$data0_obj;
	return $data0;
    }
    public function EditBlackListContents($sessionId, $xmlContentsList){
        $params = array(
            'sessionId' => $sessionId,
	    'xmlContentsList' => $xmlContentsList
        );
        $params += $this->defaultLogin();
        $simplexml = $this->_getData('EditBlackListContents', $params);
        if (!$simplexml) return false;
        
        $data0 = array();
        
if(!isset($data0)){$data0 = array();}
	$data0_obj = @$simplexml;
	$data0 = @$data0_obj;
	return $data0;
    }
public function GetBlackListContents($sessionId) {
        $params = array(
            'sessionId' => $sessionId
        );
        $params += $this->defaultLogin();
        $simplexml = $this->_getData('GetBlackListContents', $params);
        if (!$simplexml) return false;
        //var_dump($simplexml);
        $data0 = array();
        
        if(!isset($data0)){$data0 = array();}

	if(!isset($simplexml->Result) || is_null($simplexml->Result) || !$simplexml->Result)	$data0_obj = @array();

	else
	$data0_obj = @$simplexml->Result->children();
	$data0 = @array();
	foreach($data0_obj as $value0) {
		$data0_tmp = @array();
		$data0_tmp['ContentType'] = @(string)$value0['ContentType'];
                foreach ($value0->Content as $content) {
                    $data0_tmp['Content'][] = (string)$content;
                    $data0_tmp['content'][] = (string)$content;
                }
		$data0[] = @$data0_tmp;
	}
	return $data0;
    }    public function GetContentTypes($sessionId){
        $params = array(
            'sessionId' => $sessionId
        );
        $params += $this->defaultLogin();
        $simplexml = $this->_getData('GetContentTypes', $params);
        if (!$simplexml) return false;
        
        $data0 = array();
        
if(!isset($data0)){$data0 = array();}

	if(!isset($simplexml->Result) || is_null($simplexml->Result) || !$simplexml->Result)	$data0_obj = @array();

	else
	$data0_obj = @$simplexml->Result->children();
	$data0 = @array();
	foreach($data0_obj as $value0){
		$data0[] = @$value0;
	}
	return $data0;
    }
    public function UpdateStatisticsSettings($sessionId, $xmlUpdateData){
        $params = array(
            'sessionId' => $sessionId,
	    'xmlUpdateData' => $xmlUpdateData
        );
        $params += $this->defaultLogin();
        $simplexml = $this->_getData('UpdateStatisticsSettings', $params);
        if (!$simplexml) return false;
        
        $data0 = array();
        
if(!isset($data0)){$data0 = array();}
	$data0_obj = @$simplexml;
	$data0 = @$data0_obj;
	return $data0;
    }
    public function GetStatisticsSettings($sessionId){
        $params = array(
            'sessionId' => $sessionId
        );
        $params += $this->defaultLogin();
        $simplexml = $this->_getData('GetStatisticsSettings', $params);
        if (!$simplexml) return false;
        
        $data0 = array();
        
if(!isset($data0)){$data0 = array();}
	$data0_obj = @$simplexml->Result;
	$data0['isneedcollect'] = @$data0['IsNeedCollect'];
	return $data0;
    }
    public function GetGlobalCallStatistics(){
        $params = array(
            
        );
        $params += $this->defaultLogin();
        $simplexml = $this->_getData('GetGlobalCallStatistics', $params);
        if (!$simplexml) return false;
        
        $data0 = array();
        
if(!isset($data0)){$data0 = array();}
	$data0_obj = @$simplexml->Result;
if(!isset($data0['CallCount'])){$data0['CallCount'] = array();}
		$data1_obj = @$simplexml->Result->CallCount;
		$data0['CallCount'] = @$data1_obj;
	$data0['callcount'] = @$data0['CallCount'];
if(!isset($data0['DailyCallCount'])){$data0['DailyCallCount'] = array();}
		$data1_obj = @$simplexml->Result->DailyCallCount;
		$data0['DailyCallCount'] = @$data1_obj;
	$data0['dailycallcount'] = @$data0['DailyCallCount'];
if(!isset($data0['WeeklyCallCount'])){$data0['WeeklyCallCount'] = array();}
		$data1_obj = @$simplexml->Result->WeeklyCallCount;
		$data0['WeeklyCallCount'] = @$data1_obj;
	$data0['weeklycallcount'] = @$data0['WeeklyCallCount'];
if(!isset($data0['MonthlyCallCount'])){$data0['MonthlyCallCount'] = array();}
		$data1_obj = @$simplexml->Result->MonthlyCallCount;
		$data0['MonthlyCallCount'] = @$data1_obj;
	$data0['monthlycallcount'] = @$data0['MonthlyCallCount'];
if(!isset($data0['LastMinuteCallCounts'])){$data0['LastMinuteCallCounts'] = array();}

	if(!isset($simplexml->Result->LastMinuteCallCounts) || is_null($simplexml->Result->LastMinuteCallCounts) || !$simplexml->Result->LastMinuteCallCounts)		$data1_obj = @array();

	else
		$data1_obj = @$simplexml->Result->LastMinuteCallCounts->children();
		$data0['LastMinuteCallCounts'] = @array();
		foreach($data1_obj as $value1){
			$data0['LastMinuteCallCounts'][] = @$value1;
		}
	$data0['lastminutecallcounts'] = @$data0['LastMinuteCallCounts'];
if(!isset($data0['ActiveInstances'])){$data0['ActiveInstances'] = array();}
		$data1_obj = @$simplexml->Result->ActiveInstances;
		$data0['ActiveInstances'] = @$data1_obj;
	$data0['activeinstances'] = @$data0['ActiveInstances'];
if(!isset($data0['ActiveTestInstances'])){$data0['ActiveTestInstances'] = array();}
		$data1_obj = @$simplexml->Result->ActiveTestInstances;
		$data0['ActiveTestInstances'] = @$data1_obj;
	$data0['activetestinstances'] = @$data0['ActiveTestInstances'];
if(!isset($data0['OtapiCallStatistics'])){$data0['OtapiCallStatistics'] = array();}
		$data1_obj = @$simplexml->Result->OtapiCallStatistics;
if(!isset($data0['OtapiCallStatistics']['Name'])){$data0['OtapiCallStatistics']['Name'] = array();}
			$data2_obj = @$simplexml->Result->OtapiCallStatistics->Name;
			$data0['OtapiCallStatistics']['Name'] = @(string)$data2_obj;
		$data0['OtapiCallStatistics']['name'] = @$data0['OtapiCallStatistics']['Name'];
if(!isset($data0['OtapiCallStatistics']['StatisticsByTimePeriod'])){$data0['OtapiCallStatistics']['StatisticsByTimePeriod'] = array();}
			$data2_obj = @$simplexml->Result->OtapiCallStatistics->StatisticsByTimePeriod;
if(!isset($data0['OtapiCallStatistics']['StatisticsByTimePeriod']['DailyCallCount'])){$data0['OtapiCallStatistics']['StatisticsByTimePeriod']['DailyCallCount'] = array();}
				$data3_obj = @$simplexml->Result->OtapiCallStatistics->StatisticsByTimePeriod->DailyCallCount;
				$data0['OtapiCallStatistics']['StatisticsByTimePeriod']['DailyCallCount'] = @$data3_obj;
			$data0['OtapiCallStatistics']['StatisticsByTimePeriod']['dailycallcount'] = @$data0['OtapiCallStatistics']['StatisticsByTimePeriod']['DailyCallCount'];
if(!isset($data0['OtapiCallStatistics']['StatisticsByTimePeriod']['WeeklyCallCount'])){$data0['OtapiCallStatistics']['StatisticsByTimePeriod']['WeeklyCallCount'] = array();}
				$data3_obj = @$simplexml->Result->OtapiCallStatistics->StatisticsByTimePeriod->WeeklyCallCount;
				$data0['OtapiCallStatistics']['StatisticsByTimePeriod']['WeeklyCallCount'] = @$data3_obj;
			$data0['OtapiCallStatistics']['StatisticsByTimePeriod']['weeklycallcount'] = @$data0['OtapiCallStatistics']['StatisticsByTimePeriod']['WeeklyCallCount'];
if(!isset($data0['OtapiCallStatistics']['StatisticsByTimePeriod']['MonthlyCallCount'])){$data0['OtapiCallStatistics']['StatisticsByTimePeriod']['MonthlyCallCount'] = array();}
				$data3_obj = @$simplexml->Result->OtapiCallStatistics->StatisticsByTimePeriod->MonthlyCallCount;
				$data0['OtapiCallStatistics']['StatisticsByTimePeriod']['MonthlyCallCount'] = @$data3_obj;
			$data0['OtapiCallStatistics']['StatisticsByTimePeriod']['monthlycallcount'] = @$data0['OtapiCallStatistics']['StatisticsByTimePeriod']['MonthlyCallCount'];
		$data0['OtapiCallStatistics']['statisticsbytimeperiod'] = @$data0['OtapiCallStatistics']['StatisticsByTimePeriod'];
if(!isset($data0['OtapiCallStatistics']['TotalCount'])){$data0['OtapiCallStatistics']['TotalCount'] = array();}
			$data2_obj = @$simplexml->Result->OtapiCallStatistics->TotalCount;
			$data0['OtapiCallStatistics']['TotalCount'] = @$data2_obj;
		$data0['OtapiCallStatistics']['totalcount'] = @$data0['OtapiCallStatistics']['TotalCount'];
	$data0['otapicallstatistics'] = @$data0['OtapiCallStatistics'];
if(!isset($data0['TotalLengthTranslatedTexts'])){$data0['TotalLengthTranslatedTexts'] = array();}
		$data1_obj = @$simplexml->Result->TotalLengthTranslatedTexts;
if(!isset($data0['TotalLengthTranslatedTexts']['Name'])){$data0['TotalLengthTranslatedTexts']['Name'] = array();}
			$data2_obj = @$simplexml->Result->TotalLengthTranslatedTexts->Name;
			$data0['TotalLengthTranslatedTexts']['Name'] = @(string)$data2_obj;
		$data0['TotalLengthTranslatedTexts']['name'] = @$data0['TotalLengthTranslatedTexts']['Name'];
if(!isset($data0['TotalLengthTranslatedTexts']['StatisticsByTimePeriod'])){$data0['TotalLengthTranslatedTexts']['StatisticsByTimePeriod'] = array();}
			$data2_obj = @$simplexml->Result->TotalLengthTranslatedTexts->StatisticsByTimePeriod;
if(!isset($data0['TotalLengthTranslatedTexts']['StatisticsByTimePeriod']['DailyCallCount'])){$data0['TotalLengthTranslatedTexts']['StatisticsByTimePeriod']['DailyCallCount'] = array();}
				$data3_obj = @$simplexml->Result->TotalLengthTranslatedTexts->StatisticsByTimePeriod->DailyCallCount;
				$data0['TotalLengthTranslatedTexts']['StatisticsByTimePeriod']['DailyCallCount'] = @$data3_obj;
			$data0['TotalLengthTranslatedTexts']['StatisticsByTimePeriod']['dailycallcount'] = @$data0['TotalLengthTranslatedTexts']['StatisticsByTimePeriod']['DailyCallCount'];
if(!isset($data0['TotalLengthTranslatedTexts']['StatisticsByTimePeriod']['WeeklyCallCount'])){$data0['TotalLengthTranslatedTexts']['StatisticsByTimePeriod']['WeeklyCallCount'] = array();}
				$data3_obj = @$simplexml->Result->TotalLengthTranslatedTexts->StatisticsByTimePeriod->WeeklyCallCount;
				$data0['TotalLengthTranslatedTexts']['StatisticsByTimePeriod']['WeeklyCallCount'] = @$data3_obj;
			$data0['TotalLengthTranslatedTexts']['StatisticsByTimePeriod']['weeklycallcount'] = @$data0['TotalLengthTranslatedTexts']['StatisticsByTimePeriod']['WeeklyCallCount'];
if(!isset($data0['TotalLengthTranslatedTexts']['StatisticsByTimePeriod']['MonthlyCallCount'])){$data0['TotalLengthTranslatedTexts']['StatisticsByTimePeriod']['MonthlyCallCount'] = array();}
				$data3_obj = @$simplexml->Result->TotalLengthTranslatedTexts->StatisticsByTimePeriod->MonthlyCallCount;
				$data0['TotalLengthTranslatedTexts']['StatisticsByTimePeriod']['MonthlyCallCount'] = @$data3_obj;
			$data0['TotalLengthTranslatedTexts']['StatisticsByTimePeriod']['monthlycallcount'] = @$data0['TotalLengthTranslatedTexts']['StatisticsByTimePeriod']['MonthlyCallCount'];
		$data0['TotalLengthTranslatedTexts']['statisticsbytimeperiod'] = @$data0['TotalLengthTranslatedTexts']['StatisticsByTimePeriod'];
if(!isset($data0['TotalLengthTranslatedTexts']['TotalCount'])){$data0['TotalLengthTranslatedTexts']['TotalCount'] = array();}
			$data2_obj = @$simplexml->Result->TotalLengthTranslatedTexts->TotalCount;
			$data0['TotalLengthTranslatedTexts']['TotalCount'] = @$data2_obj;
		$data0['TotalLengthTranslatedTexts']['totalcount'] = @$data0['TotalLengthTranslatedTexts']['TotalCount'];
	$data0['totallengthtranslatedtexts'] = @$data0['TotalLengthTranslatedTexts'];
if(!isset($data0['LengthExternalTranslatedTexts'])){$data0['LengthExternalTranslatedTexts'] = array();}
		$data1_obj = @$simplexml->Result->LengthExternalTranslatedTexts;
if(!isset($data0['LengthExternalTranslatedTexts']['Name'])){$data0['LengthExternalTranslatedTexts']['Name'] = array();}
			$data2_obj = @$simplexml->Result->LengthExternalTranslatedTexts->Name;
			$data0['LengthExternalTranslatedTexts']['Name'] = @(string)$data2_obj;
		$data0['LengthExternalTranslatedTexts']['name'] = @$data0['LengthExternalTranslatedTexts']['Name'];
if(!isset($data0['LengthExternalTranslatedTexts']['StatisticsByTimePeriod'])){$data0['LengthExternalTranslatedTexts']['StatisticsByTimePeriod'] = array();}
			$data2_obj = @$simplexml->Result->LengthExternalTranslatedTexts->StatisticsByTimePeriod;
if(!isset($data0['LengthExternalTranslatedTexts']['StatisticsByTimePeriod']['DailyCallCount'])){$data0['LengthExternalTranslatedTexts']['StatisticsByTimePeriod']['DailyCallCount'] = array();}
				$data3_obj = @$simplexml->Result->LengthExternalTranslatedTexts->StatisticsByTimePeriod->DailyCallCount;
				$data0['LengthExternalTranslatedTexts']['StatisticsByTimePeriod']['DailyCallCount'] = @$data3_obj;
			$data0['LengthExternalTranslatedTexts']['StatisticsByTimePeriod']['dailycallcount'] = @$data0['LengthExternalTranslatedTexts']['StatisticsByTimePeriod']['DailyCallCount'];
if(!isset($data0['LengthExternalTranslatedTexts']['StatisticsByTimePeriod']['WeeklyCallCount'])){$data0['LengthExternalTranslatedTexts']['StatisticsByTimePeriod']['WeeklyCallCount'] = array();}
				$data3_obj = @$simplexml->Result->LengthExternalTranslatedTexts->StatisticsByTimePeriod->WeeklyCallCount;
				$data0['LengthExternalTranslatedTexts']['StatisticsByTimePeriod']['WeeklyCallCount'] = @$data3_obj;
			$data0['LengthExternalTranslatedTexts']['StatisticsByTimePeriod']['weeklycallcount'] = @$data0['LengthExternalTranslatedTexts']['StatisticsByTimePeriod']['WeeklyCallCount'];
if(!isset($data0['LengthExternalTranslatedTexts']['StatisticsByTimePeriod']['MonthlyCallCount'])){$data0['LengthExternalTranslatedTexts']['StatisticsByTimePeriod']['MonthlyCallCount'] = array();}
				$data3_obj = @$simplexml->Result->LengthExternalTranslatedTexts->StatisticsByTimePeriod->MonthlyCallCount;
				$data0['LengthExternalTranslatedTexts']['StatisticsByTimePeriod']['MonthlyCallCount'] = @$data3_obj;
			$data0['LengthExternalTranslatedTexts']['StatisticsByTimePeriod']['monthlycallcount'] = @$data0['LengthExternalTranslatedTexts']['StatisticsByTimePeriod']['MonthlyCallCount'];
		$data0['LengthExternalTranslatedTexts']['statisticsbytimeperiod'] = @$data0['LengthExternalTranslatedTexts']['StatisticsByTimePeriod'];
if(!isset($data0['LengthExternalTranslatedTexts']['TotalCount'])){$data0['LengthExternalTranslatedTexts']['TotalCount'] = array();}
			$data2_obj = @$simplexml->Result->LengthExternalTranslatedTexts->TotalCount;
			$data0['LengthExternalTranslatedTexts']['TotalCount'] = @$data2_obj;
		$data0['LengthExternalTranslatedTexts']['totalcount'] = @$data0['LengthExternalTranslatedTexts']['TotalCount'];
	$data0['lengthexternaltranslatedtexts'] = @$data0['LengthExternalTranslatedTexts'];
if(!isset($data0['CachedAdapterCalltatistics'])){$data0['CachedAdapterCalltatistics'] = array();}
		$data1_obj = @$simplexml->Result->CachedAdapterCalltatistics;
if(!isset($data0['CachedAdapterCalltatistics']['Name'])){$data0['CachedAdapterCalltatistics']['Name'] = array();}
			$data2_obj = @$simplexml->Result->CachedAdapterCalltatistics->Name;
			$data0['CachedAdapterCalltatistics']['Name'] = @(string)$data2_obj;
		$data0['CachedAdapterCalltatistics']['name'] = @$data0['CachedAdapterCalltatistics']['Name'];
if(!isset($data0['CachedAdapterCalltatistics']['StatisticsByTimePeriod'])){$data0['CachedAdapterCalltatistics']['StatisticsByTimePeriod'] = array();}
			$data2_obj = @$simplexml->Result->CachedAdapterCalltatistics->StatisticsByTimePeriod;
if(!isset($data0['CachedAdapterCalltatistics']['StatisticsByTimePeriod']['DailyCallCount'])){$data0['CachedAdapterCalltatistics']['StatisticsByTimePeriod']['DailyCallCount'] = array();}
				$data3_obj = @$simplexml->Result->CachedAdapterCalltatistics->StatisticsByTimePeriod->DailyCallCount;
				$data0['CachedAdapterCalltatistics']['StatisticsByTimePeriod']['DailyCallCount'] = @$data3_obj;
			$data0['CachedAdapterCalltatistics']['StatisticsByTimePeriod']['dailycallcount'] = @$data0['CachedAdapterCalltatistics']['StatisticsByTimePeriod']['DailyCallCount'];
if(!isset($data0['CachedAdapterCalltatistics']['StatisticsByTimePeriod']['WeeklyCallCount'])){$data0['CachedAdapterCalltatistics']['StatisticsByTimePeriod']['WeeklyCallCount'] = array();}
				$data3_obj = @$simplexml->Result->CachedAdapterCalltatistics->StatisticsByTimePeriod->WeeklyCallCount;
				$data0['CachedAdapterCalltatistics']['StatisticsByTimePeriod']['WeeklyCallCount'] = @$data3_obj;
			$data0['CachedAdapterCalltatistics']['StatisticsByTimePeriod']['weeklycallcount'] = @$data0['CachedAdapterCalltatistics']['StatisticsByTimePeriod']['WeeklyCallCount'];
if(!isset($data0['CachedAdapterCalltatistics']['StatisticsByTimePeriod']['MonthlyCallCount'])){$data0['CachedAdapterCalltatistics']['StatisticsByTimePeriod']['MonthlyCallCount'] = array();}
				$data3_obj = @$simplexml->Result->CachedAdapterCalltatistics->StatisticsByTimePeriod->MonthlyCallCount;
				$data0['CachedAdapterCalltatistics']['StatisticsByTimePeriod']['MonthlyCallCount'] = @$data3_obj;
			$data0['CachedAdapterCalltatistics']['StatisticsByTimePeriod']['monthlycallcount'] = @$data0['CachedAdapterCalltatistics']['StatisticsByTimePeriod']['MonthlyCallCount'];
		$data0['CachedAdapterCalltatistics']['statisticsbytimeperiod'] = @$data0['CachedAdapterCalltatistics']['StatisticsByTimePeriod'];
if(!isset($data0['CachedAdapterCalltatistics']['TotalCount'])){$data0['CachedAdapterCalltatistics']['TotalCount'] = array();}
			$data2_obj = @$simplexml->Result->CachedAdapterCalltatistics->TotalCount;
			$data0['CachedAdapterCalltatistics']['TotalCount'] = @$data2_obj;
		$data0['CachedAdapterCalltatistics']['totalcount'] = @$data0['CachedAdapterCalltatistics']['TotalCount'];
	$data0['cachedadaptercalltatistics'] = @$data0['CachedAdapterCalltatistics'];
if(!isset($data0['AdapterCalltatistics'])){$data0['AdapterCalltatistics'] = array();}
		$data1_obj = @$simplexml->Result->AdapterCalltatistics;
if(!isset($data0['AdapterCalltatistics']['Name'])){$data0['AdapterCalltatistics']['Name'] = array();}
			$data2_obj = @$simplexml->Result->AdapterCalltatistics->Name;
			$data0['AdapterCalltatistics']['Name'] = @(string)$data2_obj;
		$data0['AdapterCalltatistics']['name'] = @$data0['AdapterCalltatistics']['Name'];
if(!isset($data0['AdapterCalltatistics']['StatisticsByTimePeriod'])){$data0['AdapterCalltatistics']['StatisticsByTimePeriod'] = array();}
			$data2_obj = @$simplexml->Result->AdapterCalltatistics->StatisticsByTimePeriod;
if(!isset($data0['AdapterCalltatistics']['StatisticsByTimePeriod']['DailyCallCount'])){$data0['AdapterCalltatistics']['StatisticsByTimePeriod']['DailyCallCount'] = array();}
				$data3_obj = @$simplexml->Result->AdapterCalltatistics->StatisticsByTimePeriod->DailyCallCount;
				$data0['AdapterCalltatistics']['StatisticsByTimePeriod']['DailyCallCount'] = @$data3_obj;
			$data0['AdapterCalltatistics']['StatisticsByTimePeriod']['dailycallcount'] = @$data0['AdapterCalltatistics']['StatisticsByTimePeriod']['DailyCallCount'];
if(!isset($data0['AdapterCalltatistics']['StatisticsByTimePeriod']['WeeklyCallCount'])){$data0['AdapterCalltatistics']['StatisticsByTimePeriod']['WeeklyCallCount'] = array();}
				$data3_obj = @$simplexml->Result->AdapterCalltatistics->StatisticsByTimePeriod->WeeklyCallCount;
				$data0['AdapterCalltatistics']['StatisticsByTimePeriod']['WeeklyCallCount'] = @$data3_obj;
			$data0['AdapterCalltatistics']['StatisticsByTimePeriod']['weeklycallcount'] = @$data0['AdapterCalltatistics']['StatisticsByTimePeriod']['WeeklyCallCount'];
if(!isset($data0['AdapterCalltatistics']['StatisticsByTimePeriod']['MonthlyCallCount'])){$data0['AdapterCalltatistics']['StatisticsByTimePeriod']['MonthlyCallCount'] = array();}
				$data3_obj = @$simplexml->Result->AdapterCalltatistics->StatisticsByTimePeriod->MonthlyCallCount;
				$data0['AdapterCalltatistics']['StatisticsByTimePeriod']['MonthlyCallCount'] = @$data3_obj;
			$data0['AdapterCalltatistics']['StatisticsByTimePeriod']['monthlycallcount'] = @$data0['AdapterCalltatistics']['StatisticsByTimePeriod']['MonthlyCallCount'];
		$data0['AdapterCalltatistics']['statisticsbytimeperiod'] = @$data0['AdapterCalltatistics']['StatisticsByTimePeriod'];
if(!isset($data0['AdapterCalltatistics']['TotalCount'])){$data0['AdapterCalltatistics']['TotalCount'] = array();}
			$data2_obj = @$simplexml->Result->AdapterCalltatistics->TotalCount;
			$data0['AdapterCalltatistics']['TotalCount'] = @$data2_obj;
		$data0['AdapterCalltatistics']['totalcount'] = @$data0['AdapterCalltatistics']['TotalCount'];
	$data0['adaptercalltatistics'] = @$data0['AdapterCalltatistics'];
	return $data0;
    }
    public function GetCallStatistics(){
        $params = array(
            
        );
        $params += $this->defaultLogin();
        $simplexml = $this->_getData('GetCallStatistics', $params);
        if (!$simplexml) return false;
        
        $data0 = array();
        
if(!isset($data0)){$data0 = array();}
	$data0_obj = @$simplexml->Result;
if(!isset($data0['CallCount'])){$data0['CallCount'] = array();}
		$data1_obj = @$simplexml->Result->CallCount;
		$data0['CallCount'] = @$data1_obj;
	$data0['callcount'] = @$data0['CallCount'];
if(!isset($data0['DailyCallCount'])){$data0['DailyCallCount'] = array();}
		$data1_obj = @$simplexml->Result->DailyCallCount;
		$data0['DailyCallCount'] = @$data1_obj;
	$data0['dailycallcount'] = @$data0['DailyCallCount'];
if(!isset($data0['WeeklyCallCount'])){$data0['WeeklyCallCount'] = array();}
		$data1_obj = @$simplexml->Result->WeeklyCallCount;
		$data0['WeeklyCallCount'] = @$data1_obj;
	$data0['weeklycallcount'] = @$data0['WeeklyCallCount'];
if(!isset($data0['MonthlyCallCount'])){$data0['MonthlyCallCount'] = array();}
		$data1_obj = @$simplexml->Result->MonthlyCallCount;
		$data0['MonthlyCallCount'] = @$data1_obj;
	$data0['monthlycallcount'] = @$data0['MonthlyCallCount'];
if(!isset($data0['LastMinuteCallCounts'])){$data0['LastMinuteCallCounts'] = array();}

	if(!isset($simplexml->Result->LastMinuteCallCounts) || is_null($simplexml->Result->LastMinuteCallCounts) || !$simplexml->Result->LastMinuteCallCounts)		$data1_obj = @array();

	else
		$data1_obj = @$simplexml->Result->LastMinuteCallCounts->children();
		$data0['LastMinuteCallCounts'] = @array();
		foreach($data1_obj as $value1){
			$data0['LastMinuteCallCounts'][] = @$value1;
		}
	$data0['lastminutecallcounts'] = @$data0['LastMinuteCallCounts'];
if(!isset($data0['ActiveInstances'])){$data0['ActiveInstances'] = array();}
		$data1_obj = @$simplexml->Result->ActiveInstances;
		$data0['ActiveInstances'] = @$data1_obj;
	$data0['activeinstances'] = @$data0['ActiveInstances'];
if(!isset($data0['ActiveTestInstances'])){$data0['ActiveTestInstances'] = array();}
		$data1_obj = @$simplexml->Result->ActiveTestInstances;
		$data0['ActiveTestInstances'] = @$data1_obj;
	$data0['activetestinstances'] = @$data0['ActiveTestInstances'];
if(!isset($data0['OtapiCallStatistics'])){$data0['OtapiCallStatistics'] = array();}
		$data1_obj = @$simplexml->Result->OtapiCallStatistics;
if(!isset($data0['OtapiCallStatistics']['Name'])){$data0['OtapiCallStatistics']['Name'] = array();}
			$data2_obj = @$simplexml->Result->OtapiCallStatistics->Name;
			$data0['OtapiCallStatistics']['Name'] = @(string)$data2_obj;
		$data0['OtapiCallStatistics']['name'] = @$data0['OtapiCallStatistics']['Name'];
if(!isset($data0['OtapiCallStatistics']['StatisticsByTimePeriod'])){$data0['OtapiCallStatistics']['StatisticsByTimePeriod'] = array();}
			$data2_obj = @$simplexml->Result->OtapiCallStatistics->StatisticsByTimePeriod;
if(!isset($data0['OtapiCallStatistics']['StatisticsByTimePeriod']['DailyCallCount'])){$data0['OtapiCallStatistics']['StatisticsByTimePeriod']['DailyCallCount'] = array();}
				$data3_obj = @$simplexml->Result->OtapiCallStatistics->StatisticsByTimePeriod->DailyCallCount;
				$data0['OtapiCallStatistics']['StatisticsByTimePeriod']['DailyCallCount'] = @$data3_obj;
			$data0['OtapiCallStatistics']['StatisticsByTimePeriod']['dailycallcount'] = @$data0['OtapiCallStatistics']['StatisticsByTimePeriod']['DailyCallCount'];
if(!isset($data0['OtapiCallStatistics']['StatisticsByTimePeriod']['WeeklyCallCount'])){$data0['OtapiCallStatistics']['StatisticsByTimePeriod']['WeeklyCallCount'] = array();}
				$data3_obj = @$simplexml->Result->OtapiCallStatistics->StatisticsByTimePeriod->WeeklyCallCount;
				$data0['OtapiCallStatistics']['StatisticsByTimePeriod']['WeeklyCallCount'] = @$data3_obj;
			$data0['OtapiCallStatistics']['StatisticsByTimePeriod']['weeklycallcount'] = @$data0['OtapiCallStatistics']['StatisticsByTimePeriod']['WeeklyCallCount'];
if(!isset($data0['OtapiCallStatistics']['StatisticsByTimePeriod']['MonthlyCallCount'])){$data0['OtapiCallStatistics']['StatisticsByTimePeriod']['MonthlyCallCount'] = array();}
				$data3_obj = @$simplexml->Result->OtapiCallStatistics->StatisticsByTimePeriod->MonthlyCallCount;
				$data0['OtapiCallStatistics']['StatisticsByTimePeriod']['MonthlyCallCount'] = @$data3_obj;
			$data0['OtapiCallStatistics']['StatisticsByTimePeriod']['monthlycallcount'] = @$data0['OtapiCallStatistics']['StatisticsByTimePeriod']['MonthlyCallCount'];
		$data0['OtapiCallStatistics']['statisticsbytimeperiod'] = @$data0['OtapiCallStatistics']['StatisticsByTimePeriod'];
if(!isset($data0['OtapiCallStatistics']['TotalCount'])){$data0['OtapiCallStatistics']['TotalCount'] = array();}
			$data2_obj = @$simplexml->Result->OtapiCallStatistics->TotalCount;
			$data0['OtapiCallStatistics']['TotalCount'] = @$data2_obj;
		$data0['OtapiCallStatistics']['totalcount'] = @$data0['OtapiCallStatistics']['TotalCount'];
	$data0['otapicallstatistics'] = @$data0['OtapiCallStatistics'];
if(!isset($data0['TotalLengthTranslatedTexts'])){$data0['TotalLengthTranslatedTexts'] = array();}
		$data1_obj = @$simplexml->Result->TotalLengthTranslatedTexts;
if(!isset($data0['TotalLengthTranslatedTexts']['Name'])){$data0['TotalLengthTranslatedTexts']['Name'] = array();}
			$data2_obj = @$simplexml->Result->TotalLengthTranslatedTexts->Name;
			$data0['TotalLengthTranslatedTexts']['Name'] = @(string)$data2_obj;
		$data0['TotalLengthTranslatedTexts']['name'] = @$data0['TotalLengthTranslatedTexts']['Name'];
if(!isset($data0['TotalLengthTranslatedTexts']['StatisticsByTimePeriod'])){$data0['TotalLengthTranslatedTexts']['StatisticsByTimePeriod'] = array();}
			$data2_obj = @$simplexml->Result->TotalLengthTranslatedTexts->StatisticsByTimePeriod;
if(!isset($data0['TotalLengthTranslatedTexts']['StatisticsByTimePeriod']['DailyCallCount'])){$data0['TotalLengthTranslatedTexts']['StatisticsByTimePeriod']['DailyCallCount'] = array();}
				$data3_obj = @$simplexml->Result->TotalLengthTranslatedTexts->StatisticsByTimePeriod->DailyCallCount;
				$data0['TotalLengthTranslatedTexts']['StatisticsByTimePeriod']['DailyCallCount'] = @$data3_obj;
			$data0['TotalLengthTranslatedTexts']['StatisticsByTimePeriod']['dailycallcount'] = @$data0['TotalLengthTranslatedTexts']['StatisticsByTimePeriod']['DailyCallCount'];
if(!isset($data0['TotalLengthTranslatedTexts']['StatisticsByTimePeriod']['WeeklyCallCount'])){$data0['TotalLengthTranslatedTexts']['StatisticsByTimePeriod']['WeeklyCallCount'] = array();}
				$data3_obj = @$simplexml->Result->TotalLengthTranslatedTexts->StatisticsByTimePeriod->WeeklyCallCount;
				$data0['TotalLengthTranslatedTexts']['StatisticsByTimePeriod']['WeeklyCallCount'] = @$data3_obj;
			$data0['TotalLengthTranslatedTexts']['StatisticsByTimePeriod']['weeklycallcount'] = @$data0['TotalLengthTranslatedTexts']['StatisticsByTimePeriod']['WeeklyCallCount'];
if(!isset($data0['TotalLengthTranslatedTexts']['StatisticsByTimePeriod']['MonthlyCallCount'])){$data0['TotalLengthTranslatedTexts']['StatisticsByTimePeriod']['MonthlyCallCount'] = array();}
				$data3_obj = @$simplexml->Result->TotalLengthTranslatedTexts->StatisticsByTimePeriod->MonthlyCallCount;
				$data0['TotalLengthTranslatedTexts']['StatisticsByTimePeriod']['MonthlyCallCount'] = @$data3_obj;
			$data0['TotalLengthTranslatedTexts']['StatisticsByTimePeriod']['monthlycallcount'] = @$data0['TotalLengthTranslatedTexts']['StatisticsByTimePeriod']['MonthlyCallCount'];
		$data0['TotalLengthTranslatedTexts']['statisticsbytimeperiod'] = @$data0['TotalLengthTranslatedTexts']['StatisticsByTimePeriod'];
if(!isset($data0['TotalLengthTranslatedTexts']['TotalCount'])){$data0['TotalLengthTranslatedTexts']['TotalCount'] = array();}
			$data2_obj = @$simplexml->Result->TotalLengthTranslatedTexts->TotalCount;
			$data0['TotalLengthTranslatedTexts']['TotalCount'] = @$data2_obj;
		$data0['TotalLengthTranslatedTexts']['totalcount'] = @$data0['TotalLengthTranslatedTexts']['TotalCount'];
	$data0['totallengthtranslatedtexts'] = @$data0['TotalLengthTranslatedTexts'];
if(!isset($data0['LengthExternalTranslatedTexts'])){$data0['LengthExternalTranslatedTexts'] = array();}
		$data1_obj = @$simplexml->Result->LengthExternalTranslatedTexts;
if(!isset($data0['LengthExternalTranslatedTexts']['Name'])){$data0['LengthExternalTranslatedTexts']['Name'] = array();}
			$data2_obj = @$simplexml->Result->LengthExternalTranslatedTexts->Name;
			$data0['LengthExternalTranslatedTexts']['Name'] = @(string)$data2_obj;
		$data0['LengthExternalTranslatedTexts']['name'] = @$data0['LengthExternalTranslatedTexts']['Name'];
if(!isset($data0['LengthExternalTranslatedTexts']['StatisticsByTimePeriod'])){$data0['LengthExternalTranslatedTexts']['StatisticsByTimePeriod'] = array();}
			$data2_obj = @$simplexml->Result->LengthExternalTranslatedTexts->StatisticsByTimePeriod;
if(!isset($data0['LengthExternalTranslatedTexts']['StatisticsByTimePeriod']['DailyCallCount'])){$data0['LengthExternalTranslatedTexts']['StatisticsByTimePeriod']['DailyCallCount'] = array();}
				$data3_obj = @$simplexml->Result->LengthExternalTranslatedTexts->StatisticsByTimePeriod->DailyCallCount;
				$data0['LengthExternalTranslatedTexts']['StatisticsByTimePeriod']['DailyCallCount'] = @$data3_obj;
			$data0['LengthExternalTranslatedTexts']['StatisticsByTimePeriod']['dailycallcount'] = @$data0['LengthExternalTranslatedTexts']['StatisticsByTimePeriod']['DailyCallCount'];
if(!isset($data0['LengthExternalTranslatedTexts']['StatisticsByTimePeriod']['WeeklyCallCount'])){$data0['LengthExternalTranslatedTexts']['StatisticsByTimePeriod']['WeeklyCallCount'] = array();}
				$data3_obj = @$simplexml->Result->LengthExternalTranslatedTexts->StatisticsByTimePeriod->WeeklyCallCount;
				$data0['LengthExternalTranslatedTexts']['StatisticsByTimePeriod']['WeeklyCallCount'] = @$data3_obj;
			$data0['LengthExternalTranslatedTexts']['StatisticsByTimePeriod']['weeklycallcount'] = @$data0['LengthExternalTranslatedTexts']['StatisticsByTimePeriod']['WeeklyCallCount'];
if(!isset($data0['LengthExternalTranslatedTexts']['StatisticsByTimePeriod']['MonthlyCallCount'])){$data0['LengthExternalTranslatedTexts']['StatisticsByTimePeriod']['MonthlyCallCount'] = array();}
				$data3_obj = @$simplexml->Result->LengthExternalTranslatedTexts->StatisticsByTimePeriod->MonthlyCallCount;
				$data0['LengthExternalTranslatedTexts']['StatisticsByTimePeriod']['MonthlyCallCount'] = @$data3_obj;
			$data0['LengthExternalTranslatedTexts']['StatisticsByTimePeriod']['monthlycallcount'] = @$data0['LengthExternalTranslatedTexts']['StatisticsByTimePeriod']['MonthlyCallCount'];
		$data0['LengthExternalTranslatedTexts']['statisticsbytimeperiod'] = @$data0['LengthExternalTranslatedTexts']['StatisticsByTimePeriod'];
if(!isset($data0['LengthExternalTranslatedTexts']['TotalCount'])){$data0['LengthExternalTranslatedTexts']['TotalCount'] = array();}
			$data2_obj = @$simplexml->Result->LengthExternalTranslatedTexts->TotalCount;
			$data0['LengthExternalTranslatedTexts']['TotalCount'] = @$data2_obj;
		$data0['LengthExternalTranslatedTexts']['totalcount'] = @$data0['LengthExternalTranslatedTexts']['TotalCount'];
	$data0['lengthexternaltranslatedtexts'] = @$data0['LengthExternalTranslatedTexts'];
if(!isset($data0['CachedAdapterCalltatistics'])){$data0['CachedAdapterCalltatistics'] = array();}
		$data1_obj = @$simplexml->Result->CachedAdapterCalltatistics;
if(!isset($data0['CachedAdapterCalltatistics']['Name'])){$data0['CachedAdapterCalltatistics']['Name'] = array();}
			$data2_obj = @$simplexml->Result->CachedAdapterCalltatistics->Name;
			$data0['CachedAdapterCalltatistics']['Name'] = @(string)$data2_obj;
		$data0['CachedAdapterCalltatistics']['name'] = @$data0['CachedAdapterCalltatistics']['Name'];
if(!isset($data0['CachedAdapterCalltatistics']['StatisticsByTimePeriod'])){$data0['CachedAdapterCalltatistics']['StatisticsByTimePeriod'] = array();}
			$data2_obj = @$simplexml->Result->CachedAdapterCalltatistics->StatisticsByTimePeriod;
if(!isset($data0['CachedAdapterCalltatistics']['StatisticsByTimePeriod']['DailyCallCount'])){$data0['CachedAdapterCalltatistics']['StatisticsByTimePeriod']['DailyCallCount'] = array();}
				$data3_obj = @$simplexml->Result->CachedAdapterCalltatistics->StatisticsByTimePeriod->DailyCallCount;
				$data0['CachedAdapterCalltatistics']['StatisticsByTimePeriod']['DailyCallCount'] = @$data3_obj;
			$data0['CachedAdapterCalltatistics']['StatisticsByTimePeriod']['dailycallcount'] = @$data0['CachedAdapterCalltatistics']['StatisticsByTimePeriod']['DailyCallCount'];
if(!isset($data0['CachedAdapterCalltatistics']['StatisticsByTimePeriod']['WeeklyCallCount'])){$data0['CachedAdapterCalltatistics']['StatisticsByTimePeriod']['WeeklyCallCount'] = array();}
				$data3_obj = @$simplexml->Result->CachedAdapterCalltatistics->StatisticsByTimePeriod->WeeklyCallCount;
				$data0['CachedAdapterCalltatistics']['StatisticsByTimePeriod']['WeeklyCallCount'] = @$data3_obj;
			$data0['CachedAdapterCalltatistics']['StatisticsByTimePeriod']['weeklycallcount'] = @$data0['CachedAdapterCalltatistics']['StatisticsByTimePeriod']['WeeklyCallCount'];
if(!isset($data0['CachedAdapterCalltatistics']['StatisticsByTimePeriod']['MonthlyCallCount'])){$data0['CachedAdapterCalltatistics']['StatisticsByTimePeriod']['MonthlyCallCount'] = array();}
				$data3_obj = @$simplexml->Result->CachedAdapterCalltatistics->StatisticsByTimePeriod->MonthlyCallCount;
				$data0['CachedAdapterCalltatistics']['StatisticsByTimePeriod']['MonthlyCallCount'] = @$data3_obj;
			$data0['CachedAdapterCalltatistics']['StatisticsByTimePeriod']['monthlycallcount'] = @$data0['CachedAdapterCalltatistics']['StatisticsByTimePeriod']['MonthlyCallCount'];
		$data0['CachedAdapterCalltatistics']['statisticsbytimeperiod'] = @$data0['CachedAdapterCalltatistics']['StatisticsByTimePeriod'];
if(!isset($data0['CachedAdapterCalltatistics']['TotalCount'])){$data0['CachedAdapterCalltatistics']['TotalCount'] = array();}
			$data2_obj = @$simplexml->Result->CachedAdapterCalltatistics->TotalCount;
			$data0['CachedAdapterCalltatistics']['TotalCount'] = @$data2_obj;
		$data0['CachedAdapterCalltatistics']['totalcount'] = @$data0['CachedAdapterCalltatistics']['TotalCount'];
	$data0['cachedadaptercalltatistics'] = @$data0['CachedAdapterCalltatistics'];
if(!isset($data0['AdapterCalltatistics'])){$data0['AdapterCalltatistics'] = array();}
		$data1_obj = @$simplexml->Result->AdapterCalltatistics;
if(!isset($data0['AdapterCalltatistics']['Name'])){$data0['AdapterCalltatistics']['Name'] = array();}
			$data2_obj = @$simplexml->Result->AdapterCalltatistics->Name;
			$data0['AdapterCalltatistics']['Name'] = @(string)$data2_obj;
		$data0['AdapterCalltatistics']['name'] = @$data0['AdapterCalltatistics']['Name'];
if(!isset($data0['AdapterCalltatistics']['StatisticsByTimePeriod'])){$data0['AdapterCalltatistics']['StatisticsByTimePeriod'] = array();}
			$data2_obj = @$simplexml->Result->AdapterCalltatistics->StatisticsByTimePeriod;
if(!isset($data0['AdapterCalltatistics']['StatisticsByTimePeriod']['DailyCallCount'])){$data0['AdapterCalltatistics']['StatisticsByTimePeriod']['DailyCallCount'] = array();}
				$data3_obj = @$simplexml->Result->AdapterCalltatistics->StatisticsByTimePeriod->DailyCallCount;
				$data0['AdapterCalltatistics']['StatisticsByTimePeriod']['DailyCallCount'] = @$data3_obj;
			$data0['AdapterCalltatistics']['StatisticsByTimePeriod']['dailycallcount'] = @$data0['AdapterCalltatistics']['StatisticsByTimePeriod']['DailyCallCount'];
if(!isset($data0['AdapterCalltatistics']['StatisticsByTimePeriod']['WeeklyCallCount'])){$data0['AdapterCalltatistics']['StatisticsByTimePeriod']['WeeklyCallCount'] = array();}
				$data3_obj = @$simplexml->Result->AdapterCalltatistics->StatisticsByTimePeriod->WeeklyCallCount;
				$data0['AdapterCalltatistics']['StatisticsByTimePeriod']['WeeklyCallCount'] = @$data3_obj;
			$data0['AdapterCalltatistics']['StatisticsByTimePeriod']['weeklycallcount'] = @$data0['AdapterCalltatistics']['StatisticsByTimePeriod']['WeeklyCallCount'];
if(!isset($data0['AdapterCalltatistics']['StatisticsByTimePeriod']['MonthlyCallCount'])){$data0['AdapterCalltatistics']['StatisticsByTimePeriod']['MonthlyCallCount'] = array();}
				$data3_obj = @$simplexml->Result->AdapterCalltatistics->StatisticsByTimePeriod->MonthlyCallCount;
				$data0['AdapterCalltatistics']['StatisticsByTimePeriod']['MonthlyCallCount'] = @$data3_obj;
			$data0['AdapterCalltatistics']['StatisticsByTimePeriod']['monthlycallcount'] = @$data0['AdapterCalltatistics']['StatisticsByTimePeriod']['MonthlyCallCount'];
		$data0['AdapterCalltatistics']['statisticsbytimeperiod'] = @$data0['AdapterCalltatistics']['StatisticsByTimePeriod'];
if(!isset($data0['AdapterCalltatistics']['TotalCount'])){$data0['AdapterCalltatistics']['TotalCount'] = array();}
			$data2_obj = @$simplexml->Result->AdapterCalltatistics->TotalCount;
			$data0['AdapterCalltatistics']['TotalCount'] = @$data2_obj;
		$data0['AdapterCalltatistics']['totalcount'] = @$data0['AdapterCalltatistics']['TotalCount'];
	$data0['adaptercalltatistics'] = @$data0['AdapterCalltatistics'];
	return $data0;
    }
    public function CheckIfStatefullMethodsAllowed(){
        $params = array(
            
        );
        $params += $this->defaultLogin();
        $simplexml = $this->_getData('CheckIfStatefullMethodsAllowed', $params);
        if (!$simplexml) return false;
        
        $data0 = array();
        
if(!isset($data0)){$data0 = array();}
	$data0_obj = @$simplexml;
	$data0 = @$data0_obj;
	return $data0;
    }
    public function Test(){
        $params = array(
            
        );
        $params += $this->defaultLogin();
        $simplexml = $this->_getData('Test', $params);
        if (!$simplexml) return false;
        
        $data0 = array();
        
if(!isset($data0)){$data0 = array();}
	$data0_obj = @$simplexml;
	$data0 = @$data0_obj;
	return $data0;
    }
    public function GetVendorInfo($vendorId){
        $params = array(
            'vendorId' => $vendorId
        );
        $params += $this->defaultLogin();
        $simplexml = $this->_getData('GetVendorInfo', $params);
        if (!$simplexml) return false;
        
        $data0 = array();
        
if(!isset($data0)){$data0 = array();}
	$data0_obj = @$simplexml->VendorInfo;
if(!isset($data0['Id'])){$data0['Id'] = array();}
		$data1_obj = @$simplexml->VendorInfo->Id;
		$data0['Id'] = @(string)$data1_obj;
	$data0['id'] = @$data0['Id'];
if(!isset($data0['Name'])){$data0['Name'] = array();}
		$data1_obj = @$simplexml->VendorInfo->Name;
		$data0['Name'] = @(string)$data1_obj;
	$data0['name'] = @$data0['Name'];
if(!isset($data0['Sex'])){$data0['Sex'] = array();}
		$data1_obj = @$simplexml->VendorInfo->Sex;
		$data0['Sex'] = @$data1_obj;
	$data0['sex'] = @$data0['Sex'];
if(!isset($data0['Email'])){$data0['Email'] = array();}
		$data1_obj = @$simplexml->VendorInfo->Email;
		$data0['Email'] = @(string)$data1_obj;
	$data0['email'] = @$data0['Email'];
if(!isset($data0['PictureUrl'])){$data0['PictureUrl'] = array();}
		$data1_obj = @$simplexml->VendorInfo->PictureUrl;
		$data0['PictureUrl'] = @(string)$data1_obj;
	$data0['pictureurl'] = @$data0['PictureUrl'];
if(!isset($data0['Location'])){$data0['Location'] = array();}
		$data1_obj = @$simplexml->VendorInfo->Location;
if(!isset($data0['Location']['City'])){$data0['Location']['City'] = array();}
			$data2_obj = @$simplexml->VendorInfo->Location->City;
			$data0['Location']['City'] = @(string)$data2_obj;
		$data0['Location']['city'] = @$data0['Location']['City'];
if(!isset($data0['Location']['State'])){$data0['Location']['State'] = array();}
			$data2_obj = @$simplexml->VendorInfo->Location->State;
			$data0['Location']['State'] = @(string)$data2_obj;
		$data0['Location']['state'] = @$data0['Location']['State'];
if(!isset($data0['Location']['Country'])){$data0['Location']['Country'] = array();}
			$data2_obj = @$simplexml->VendorInfo->Location->Country;
			$data0['Location']['Country'] = @(string)$data2_obj;
		$data0['Location']['country'] = @$data0['Location']['Country'];
if(!isset($data0['Location']['District'])){$data0['Location']['District'] = array();}
			$data2_obj = @$simplexml->VendorInfo->Location->District;
			$data0['Location']['District'] = @(string)$data2_obj;
		$data0['Location']['district'] = @$data0['Location']['District'];
if(!isset($data0['Location']['Zip'])){$data0['Location']['Zip'] = array();}
			$data2_obj = @$simplexml->VendorInfo->Location->Zip;
			$data0['Location']['Zip'] = @(string)$data2_obj;
		$data0['Location']['zip'] = @$data0['Location']['Zip'];
if(!isset($data0['Location']['Address'])){$data0['Location']['Address'] = array();}
			$data2_obj = @$simplexml->VendorInfo->Location->Address;
			$data0['Location']['Address'] = @(string)$data2_obj;
		$data0['Location']['address'] = @$data0['Location']['Address'];
if(!isset($data0['Location']['AreaId'])){$data0['Location']['AreaId'] = array();}
			$data2_obj = @$simplexml->VendorInfo->Location->AreaId;
			$data0['Location']['AreaId'] = @(string)$data2_obj;
		$data0['Location']['areaid'] = @$data0['Location']['AreaId'];
	$data0['location'] = @$data0['Location'];
if(!isset($data0['Credit'])){$data0['Credit'] = array();}
		$data1_obj = @$simplexml->VendorInfo->Credit;
if(!isset($data0['Credit']['Level'])){$data0['Credit']['Level'] = array();}
			$data2_obj = @$simplexml->VendorInfo->Credit->Level;
			$data0['Credit']['Level'] = @$data2_obj;
		$data0['Credit']['level'] = @$data0['Credit']['Level'];
if(!isset($data0['Credit']['Score'])){$data0['Credit']['Score'] = array();}
			$data2_obj = @$simplexml->VendorInfo->Credit->Score;
			$data0['Credit']['Score'] = @$data2_obj;
		$data0['Credit']['score'] = @$data0['Credit']['Score'];
if(!isset($data0['Credit']['TotalFeedbacks'])){$data0['Credit']['TotalFeedbacks'] = array();}
			$data2_obj = @$simplexml->VendorInfo->Credit->TotalFeedbacks;
			$data0['Credit']['TotalFeedbacks'] = @$data2_obj;
		$data0['Credit']['totalfeedbacks'] = @$data0['Credit']['TotalFeedbacks'];
if(!isset($data0['Credit']['PositiveFeedbacks'])){$data0['Credit']['PositiveFeedbacks'] = array();}
			$data2_obj = @$simplexml->VendorInfo->Credit->PositiveFeedbacks;
			$data0['Credit']['PositiveFeedbacks'] = @$data2_obj;
		$data0['Credit']['positivefeedbacks'] = @$data0['Credit']['PositiveFeedbacks'];
	$data0['credit'] = @$data0['Credit'];
if(!isset($data0['Features'])){$data0['Features'] = array();}

	if(!isset($simplexml->VendorInfo->Features) || is_null($simplexml->VendorInfo->Features) || !$simplexml->VendorInfo->Features)		$data1_obj = @array();

	else
		$data1_obj = @$simplexml->VendorInfo->Features->children();
		$data0['Features'] = @array();
		foreach($data1_obj as $value1){
			$data0['Features'][] = @$value1;
		}
	$data0['features'] = @$data0['Features'];
	return $data0;
    }
    public function GetAccountInfoForOperator($sessionId, $customerId){
        $params = array(
            'sessionId' => $sessionId,
	    'customerId' => $customerId
        );
        $params += $this->defaultLogin();
        $simplexml = $this->_getData('GetAccountInfoForOperator', $params);
        if (!$simplexml) return false;
        
        $data0 = array();
        
if(!isset($data0)){$data0 = array();}
	$data0_obj = @$simplexml->Result;
if(!isset($data0['Id'])){$data0['Id'] = array();}
		$data1_obj = @$simplexml->Result->Id;
		$data0['Id'] = @(string)$data1_obj;
	$data0['id'] = @$data0['Id'];
if(!isset($data0['Num'])){$data0['Num'] = array();}
		$data1_obj = @$simplexml->Result->Num;
		$data0['Num'] = @(string)$data1_obj;
	$data0['num'] = @$data0['Num'];
if(!isset($data0['CurrencyCodeInternal'])){$data0['CurrencyCodeInternal'] = array();}
		$data1_obj = @$simplexml->Result->CurrencyCodeInternal;
		$data0['CurrencyCodeInternal'] = @(string)$data1_obj;
	$data0['currencycodeinternal'] = @$data0['CurrencyCodeInternal'];
if(!isset($data0['CurrencySignInternal'])){$data0['CurrencySignInternal'] = array();}
		$data1_obj = @$simplexml->Result->CurrencySignInternal;
		$data0['CurrencySignInternal'] = @(string)$data1_obj;
	$data0['currencysigninternal'] = @$data0['CurrencySignInternal'];
if(!isset($data0['BalanceInternal'])){$data0['BalanceInternal'] = array();}
		$data1_obj = @$simplexml->Result->BalanceInternal;
		$data0['BalanceInternal'] = @$data1_obj;
	$data0['balanceinternal'] = @$data0['BalanceInternal'];
if(!isset($data0['ReservedInternal'])){$data0['ReservedInternal'] = array();}
		$data1_obj = @$simplexml->Result->ReservedInternal;
		$data0['ReservedInternal'] = @$data1_obj;
	$data0['reservedinternal'] = @$data0['ReservedInternal'];
if(!isset($data0['AvailableInternal'])){$data0['AvailableInternal'] = array();}
		$data1_obj = @$simplexml->Result->AvailableInternal;
		$data0['AvailableInternal'] = @$data1_obj;
	$data0['availableinternal'] = @$data0['AvailableInternal'];
if(!isset($data0['CurrencyCodeCust'])){$data0['CurrencyCodeCust'] = array();}
		$data1_obj = @$simplexml->Result->CurrencyCodeCust;
		$data0['CurrencyCodeCust'] = @(string)$data1_obj;
	$data0['currencycodecust'] = @$data0['CurrencyCodeCust'];
if(!isset($data0['CurrencySignCust'])){$data0['CurrencySignCust'] = array();}
		$data1_obj = @$simplexml->Result->CurrencySignCust;
		$data0['CurrencySignCust'] = @(string)$data1_obj;
	$data0['currencysigncust'] = @$data0['CurrencySignCust'];
if(!isset($data0['BalanceCust'])){$data0['BalanceCust'] = array();}
		$data1_obj = @$simplexml->Result->BalanceCust;
		$data0['BalanceCust'] = @$data1_obj;
	$data0['balancecust'] = @$data0['BalanceCust'];
if(!isset($data0['ReservedCust'])){$data0['ReservedCust'] = array();}
		$data1_obj = @$simplexml->Result->ReservedCust;
		$data0['ReservedCust'] = @$data1_obj;
	$data0['reservedcust'] = @$data0['ReservedCust'];
if(!isset($data0['AvailableCust'])){$data0['AvailableCust'] = array();}
		$data1_obj = @$simplexml->Result->AvailableCust;
		$data0['AvailableCust'] = @$data1_obj;
	$data0['availablecust'] = @$data0['AvailableCust'];
if(!isset($data0['PaymWaitInternal'])){$data0['PaymWaitInternal'] = array();}
		$data1_obj = @$simplexml->Result->PaymWaitInternal;
		$data0['PaymWaitInternal'] = @$data1_obj;
	$data0['paymwaitinternal'] = @$data0['PaymWaitInternal'];
if(!isset($data0['PaymWaitCust'])){$data0['PaymWaitCust'] = array();}
		$data1_obj = @$simplexml->Result->PaymWaitCust;
		$data0['PaymWaitCust'] = @$data1_obj;
	$data0['paymwaitcust'] = @$data0['PaymWaitCust'];
	return $data0;
    }
    public function GetStatementForOperator($sessionId, $customerId, $fromDate, $toDate){
        $params = array(
            'sessionId' => $sessionId,
	    'customerId' => $customerId,
	    'fromDate' => $fromDate,
	    'toDate' => $toDate
        );
        $params += $this->defaultLogin();
        $simplexml = $this->_getData('GetStatementForOperator', $params);
        if (!$simplexml) return false;
        
        $data0 = array();
        
if(!isset($data0)){$data0 = array();}
	$data0_obj = @$simplexml->Result;
if(!isset($data0['Header'])){$data0['Header'] = array();}
		$data1_obj = @$simplexml->Result->Header;
if(!isset($data0['Header']['StartBalanceInternal'])){$data0['Header']['StartBalanceInternal'] = array();}
			$data2_obj = @$simplexml->Result->Header->StartBalanceInternal;
			$data0['Header']['StartBalanceInternal'] = @$data2_obj;
		$data0['Header']['startbalanceinternal'] = @$data0['Header']['StartBalanceInternal'];
if(!isset($data0['Header']['DebitInternal'])){$data0['Header']['DebitInternal'] = array();}
			$data2_obj = @$simplexml->Result->Header->DebitInternal;
			$data0['Header']['DebitInternal'] = @$data2_obj;
		$data0['Header']['debitinternal'] = @$data0['Header']['DebitInternal'];
if(!isset($data0['Header']['CreditInternal'])){$data0['Header']['CreditInternal'] = array();}
			$data2_obj = @$simplexml->Result->Header->CreditInternal;
			$data0['Header']['CreditInternal'] = @$data2_obj;
		$data0['Header']['creditinternal'] = @$data0['Header']['CreditInternal'];
if(!isset($data0['Header']['EndBalanceInternal'])){$data0['Header']['EndBalanceInternal'] = array();}
			$data2_obj = @$simplexml->Result->Header->EndBalanceInternal;
			$data0['Header']['EndBalanceInternal'] = @$data2_obj;
		$data0['Header']['endbalanceinternal'] = @$data0['Header']['EndBalanceInternal'];
if(!isset($data0['Header']['CurrencyCodeInternal'])){$data0['Header']['CurrencyCodeInternal'] = array();}
			$data2_obj = @$simplexml->Result->Header->CurrencyCodeInternal;
			$data0['Header']['CurrencyCodeInternal'] = @(string)$data2_obj;
		$data0['Header']['currencycodeinternal'] = @$data0['Header']['CurrencyCodeInternal'];
if(!isset($data0['Header']['CurrencySignInternal'])){$data0['Header']['CurrencySignInternal'] = array();}
			$data2_obj = @$simplexml->Result->Header->CurrencySignInternal;
			$data0['Header']['CurrencySignInternal'] = @(string)$data2_obj;
		$data0['Header']['currencysigninternal'] = @$data0['Header']['CurrencySignInternal'];
if(!isset($data0['Header']['StartBalanceCust'])){$data0['Header']['StartBalanceCust'] = array();}
			$data2_obj = @$simplexml->Result->Header->StartBalanceCust;
			$data0['Header']['StartBalanceCust'] = @$data2_obj;
		$data0['Header']['startbalancecust'] = @$data0['Header']['StartBalanceCust'];
if(!isset($data0['Header']['DebitCust'])){$data0['Header']['DebitCust'] = array();}
			$data2_obj = @$simplexml->Result->Header->DebitCust;
			$data0['Header']['DebitCust'] = @$data2_obj;
		$data0['Header']['debitcust'] = @$data0['Header']['DebitCust'];
if(!isset($data0['Header']['CreditCust'])){$data0['Header']['CreditCust'] = array();}
			$data2_obj = @$simplexml->Result->Header->CreditCust;
			$data0['Header']['CreditCust'] = @$data2_obj;
		$data0['Header']['creditcust'] = @$data0['Header']['CreditCust'];
if(!isset($data0['Header']['EndBalanceCust'])){$data0['Header']['EndBalanceCust'] = array();}
			$data2_obj = @$simplexml->Result->Header->EndBalanceCust;
			$data0['Header']['EndBalanceCust'] = @$data2_obj;
		$data0['Header']['endbalancecust'] = @$data0['Header']['EndBalanceCust'];
if(!isset($data0['Header']['CurrencyCodeCust'])){$data0['Header']['CurrencyCodeCust'] = array();}
			$data2_obj = @$simplexml->Result->Header->CurrencyCodeCust;
			$data0['Header']['CurrencyCodeCust'] = @(string)$data2_obj;
		$data0['Header']['currencycodecust'] = @$data0['Header']['CurrencyCodeCust'];
if(!isset($data0['Header']['CurrencySignCust'])){$data0['Header']['CurrencySignCust'] = array();}
			$data2_obj = @$simplexml->Result->Header->CurrencySignCust;
			$data0['Header']['CurrencySignCust'] = @(string)$data2_obj;
		$data0['Header']['currencysigncust'] = @$data0['Header']['CurrencySignCust'];
if(!isset($data0['Header']['TransCount'])){$data0['Header']['TransCount'] = array();}
			$data2_obj = @$simplexml->Result->Header->TransCount;
			$data0['Header']['TransCount'] = @$data2_obj;
		$data0['Header']['transcount'] = @$data0['Header']['TransCount'];
	$data0['header'] = @$data0['Header'];
if(!isset($data0['TransList'])){$data0['TransList'] = array();}

	if(!isset($simplexml->Result->TransList) || is_null($simplexml->Result->TransList) || !$simplexml->Result->TransList)		$data1_obj = @array();

	else
		$data1_obj = @$simplexml->Result->TransList->children();
		$data0['TransList'] = @array();
		foreach($data1_obj as $value1){
			$data1_tmp = @array();
			$data1_tmp['TransDate'] = @(string)$value1->TransDate;
			$data1_tmp['transdate'] = @(string)$value1->TransDate;
			$data1_tmp['TransId'] = @(string)$value1->TransId;
			$data1_tmp['transid'] = @(string)$value1->TransId;
			$data1_tmp['Comment'] = @(string)$value1->Comment;
			$data1_tmp['comment'] = @(string)$value1->Comment;
			$data1_tmp['AmountCust'] = @$value1->AmountCust;
			$data1_tmp['amountcust'] = @$value1->AmountCust;
			$data1_tmp['CurrencyCodeCust'] = @(string)$value1->CurrencyCodeCust;
			$data1_tmp['currencycodecust'] = @(string)$value1->CurrencyCodeCust;
			$data1_tmp['CurrencySignCust'] = @(string)$value1->CurrencySignCust;
			$data1_tmp['currencysigncust'] = @(string)$value1->CurrencySignCust;
			$data1_tmp['AmountInternal'] = @$value1->AmountInternal;
			$data1_tmp['amountinternal'] = @$value1->AmountInternal;
			$data1_tmp['CurrencyCodeInternal'] = @(string)$value1->CurrencyCodeInternal;
			$data1_tmp['currencycodeinternal'] = @(string)$value1->CurrencyCodeInternal;
			$data1_tmp['CurrencySignInternal'] = @(string)$value1->CurrencySignInternal;
			$data1_tmp['currencysigninternal'] = @(string)$value1->CurrencySignInternal;
			$data0['TransList'][] = @$data1_tmp;
		}
	$data0['translist'] = @$data0['TransList'];
	return $data0;
    }
    public function PostTransaction($sessionId, $customerId, $amount, $comment, $isDebit, $transactionDate){
        $params = array(
            'sessionId' => $sessionId,
	    'customerId' => $customerId,
	    'amount' => $amount,
	    'comment' => $comment,
	    'isDebit' => $isDebit,
	    'transactionDate' => $transactionDate
        );
        $params += $this->defaultLogin();
        $simplexml = $this->_getData('PostTransaction', $params);
        if (!$simplexml) return false;
        
        $data0 = array();
        
if(!isset($data0)){$data0 = array();}
	$data0_obj = @$simplexml;
	$data0 = @$data0_obj;
	return $data0;
    }
    public function GetTicketInfoList($sessionId, $direction){
        $params = array(
            'sessionId' => $sessionId,
	    'direction' => $direction
        );
        $params += $this->defaultLogin();
        $simplexml = $this->_getData('GetTicketInfoList', $params);
        if (!$simplexml) return false;
        
        $data0 = array();
        
if(!isset($data0)){$data0 = array();}

	if(!isset($simplexml->Result) || is_null($simplexml->Result) || !$simplexml->Result)	$data0_obj = @array();

	else
	$data0_obj = @$simplexml->Result->children();
	$data0 = @array();
	foreach($data0_obj as $value0){
		$data0_tmp = @array();
		$data0_tmp['TicketId'] = @(string)$value0->TicketId;
		$data0_tmp['ticketid'] = @(string)$value0->TicketId;
		$data0_tmp['CreatedDate'] = @(string)$value0->CreatedDate;
		$data0_tmp['createddate'] = @(string)$value0->CreatedDate;
		$data0_tmp['CreatedTime'] = @(string)$value0->CreatedTime;
		$data0_tmp['createdtime'] = @(string)$value0->CreatedTime;
		$data0_tmp['Subject'] = @(string)$value0->Subject;
		$data0_tmp['subject'] = @(string)$value0->Subject;
		$data0_tmp['Status'] = @(string)$value0->Status;
		$data0_tmp['status'] = @(string)$value0->Status;
		$data0_tmp['Category'] = @(string)$value0->Category;
		$data0_tmp['category'] = @(string)$value0->Category;
		$data0_tmp['MsgCount'] = @(int)$value0->MsgCount;
		$data0_tmp['msgcount'] = @(int)$value0->MsgCount;
		$data0_tmp['NewMsgCount'] = @(int)$value0->NewMsgCount;
		$data0_tmp['newmsgcount'] = @(int)$value0->NewMsgCount;
		$data0[] = @$data0_tmp;
	}
	return $data0;
    }
    public function GetTicketDetails($sessionId, $ticketId, $markAsRead){
        $params = array(
            'sessionId' => $sessionId,
	    'ticketId' => $ticketId,
	    'markAsRead' => $markAsRead
        );
        $params += $this->defaultLogin();
        $simplexml = $this->_getData('GetTicketDetails', $params);
        if (!$simplexml) return false;
        
        $data0 = array();
        
if(!isset($data0)){$data0 = array();}
	$data0_obj = @$simplexml->Result;
if(!isset($data0['TicketInfo'])){$data0['TicketInfo'] = array();}
		$data1_obj = @$simplexml->Result->TicketInfo;
if(!isset($data0['TicketInfo']['TicketId'])){$data0['TicketInfo']['TicketId'] = array();}
			$data2_obj = @$simplexml->Result->TicketInfo->TicketId;
			$data0['TicketInfo']['TicketId'] = @(string)$data2_obj;
		$data0['TicketInfo']['ticketid'] = @$data0['TicketInfo']['TicketId'];
if(!isset($data0['TicketInfo']['CreatedDate'])){$data0['TicketInfo']['CreatedDate'] = array();}
			$data2_obj = @$simplexml->Result->TicketInfo->CreatedDate;
			$data0['TicketInfo']['CreatedDate'] = @(string)$data2_obj;
		$data0['TicketInfo']['createddate'] = @$data0['TicketInfo']['CreatedDate'];
if(!isset($data0['TicketInfo']['CreatedTime'])){$data0['TicketInfo']['CreatedTime'] = array();}
			$data2_obj = @$simplexml->Result->TicketInfo->CreatedTime;
			$data0['TicketInfo']['CreatedTime'] = @(string)$data2_obj;
		$data0['TicketInfo']['createdtime'] = @$data0['TicketInfo']['CreatedTime'];
if(!isset($data0['TicketInfo']['Subject'])){$data0['TicketInfo']['Subject'] = array();}
			$data2_obj = @$simplexml->Result->TicketInfo->Subject;
			$data0['TicketInfo']['Subject'] = @(string)$data2_obj;
		$data0['TicketInfo']['subject'] = @$data0['TicketInfo']['Subject'];
if(!isset($data0['TicketInfo']['Status'])){$data0['TicketInfo']['Status'] = array();}
			$data2_obj = @$simplexml->Result->TicketInfo->Status;
			$data0['TicketInfo']['Status'] = @(string)$data2_obj;
		$data0['TicketInfo']['status'] = @$data0['TicketInfo']['Status'];
if(!isset($data0['TicketInfo']['Category'])){$data0['TicketInfo']['Category'] = array();}
			$data2_obj = @$simplexml->Result->TicketInfo->Category;
			$data0['TicketInfo']['Category'] = @(string)$data2_obj;
		$data0['TicketInfo']['category'] = @$data0['TicketInfo']['Category'];
if(!isset($data0['TicketInfo']['MsgCount'])){$data0['TicketInfo']['MsgCount'] = array();}
			$data2_obj = @$simplexml->Result->TicketInfo->MsgCount;
			$data0['TicketInfo']['MsgCount'] = @$data2_obj;
		$data0['TicketInfo']['msgcount'] = @$data0['TicketInfo']['MsgCount'];
if(!isset($data0['TicketInfo']['NewMsgCount'])){$data0['TicketInfo']['NewMsgCount'] = array();}
			$data2_obj = @$simplexml->Result->TicketInfo->NewMsgCount;
			$data0['TicketInfo']['NewMsgCount'] = @$data2_obj;
		$data0['TicketInfo']['newmsgcount'] = @$data0['TicketInfo']['NewMsgCount'];
	$data0['ticketinfo'] = @$data0['TicketInfo'];
if(!isset($data0['TicketMessageList'])){$data0['TicketMessageList'] = array();}

	if(!isset($simplexml->Result->TicketMessageList) || is_null($simplexml->Result->TicketMessageList) || !$simplexml->Result->TicketMessageList)		$data1_obj = @array();

	else
		$data1_obj = @$simplexml->Result->TicketMessageList->children();
		$data0['TicketMessageList'] = @array();
		foreach($data1_obj as $value1){
			$data1_tmp = @array();
			$data1_tmp['MessageId'] = @(string)$value1->MessageId;
			$data1_tmp['messageid'] = @(string)$value1->MessageId;
			$data1_tmp['CreatedDate'] = @(string)$value1->CreatedDate;
			$data1_tmp['createddate'] = @(string)$value1->CreatedDate;
			$data1_tmp['CreatedTime'] = @(string)$value1->CreatedTime;
			$data1_tmp['createdtime'] = @(string)$value1->CreatedTime;
			$data1_tmp['Text'] = @(string)$value1->Text;
			$data1_tmp['text'] = @(string)$value1->Text;
			$data1_tmp['Direction'] = @$value1->Direction;
			$data1_tmp['direction'] = @$value1->Direction;
			$data0['TicketMessageList'][] = @$data1_tmp;
		}
	$data0['ticketmessagelist'] = @$data0['TicketMessageList'];
	return $data0;
    }
    public function CreateTicket($sessionId, $salesId, $categoryId, $subject, $text){
        $params = array(
            'sessionId' => $sessionId,
	    'salesId' => $salesId,
	    'categoryId' => $categoryId,
	    'subject' => $subject,
	    'text' => $text
        );
        $params += $this->defaultLogin();
        $simplexml = $this->_getData('CreateTicket', $params);
        if (!$simplexml) return false;
        
        $data0 = array();
        
if(!isset($data0)){$data0 = array();}
	$data0_obj = @$simplexml->Result;
	$data0 = @(string)$data0_obj;
	return $data0;
    }
    public function CreateTicketMessage($sessionId, $ticketId, $text){
        $params = array(
            'sessionId' => $sessionId,
	    'ticketId' => $ticketId,
	    'text' => $text
        );
        $params += $this->defaultLogin();
        $simplexml = $this->_getData('CreateTicketMessage', $params);
        if (!$simplexml) return false;
        
        $data0 = array();
        
if(!isset($data0)){$data0 = array();}
	$data0_obj = @$simplexml->Result;
	$data0 = @(string)$data0_obj;
	return $data0;
    }
    public function GetTicketCatogories(){
        $params = array(
            
        );
        $params += $this->defaultLogin();
        $simplexml = $this->_getData('GetTicketCatogories', $params);
        if (!$simplexml) return false;
        
        $data0 = array();
        
if(!isset($data0)){$data0 = array();}

	if(!isset($simplexml->Result) || is_null($simplexml->Result) || !$simplexml->Result)	$data0_obj = @array();

	else
	$data0_obj = @$simplexml->Result->children();
	$data0 = @array();
	foreach($data0_obj as $value0){
		$data0_tmp = @array();
		$data0_tmp['CategoryId'] = @(string)$value0->CategoryId;
		$data0_tmp['categoryid'] = @(string)$value0->CategoryId;
		$data0_tmp['Name'] = @(string)$value0->Name;
		$data0_tmp['name'] = @(string)$value0->Name;
		$data0[] = @$data0_tmp;
	}
	return $data0;
    }
    public function GetAccountInfo($sessionId){
        $params = array(
            'sessionId' => $sessionId
        );
        $params += $this->defaultLogin();
        $simplexml = $this->_getData('GetAccountInfo', $params);
        if (!$simplexml) return false;
        
        $data0 = array();
        
if(!isset($data0)){$data0 = array();}
	$data0_obj = @$simplexml->Result;
if(!isset($data0['Id'])){$data0['Id'] = array();}
		$data1_obj = @$simplexml->Result->Id;
		$data0['Id'] = @(string)$data1_obj;
	$data0['id'] = @$data0['Id'];
if(!isset($data0['Num'])){$data0['Num'] = array();}
		$data1_obj = @$simplexml->Result->Num;
		$data0['Num'] = @(string)$data1_obj;
	$data0['num'] = @$data0['Num'];
if(!isset($data0['CurrencyCode'])){$data0['CurrencyCode'] = array();}
		$data1_obj = @$simplexml->Result->CurrencyCode;
		$data0['CurrencyCode'] = @(string)$data1_obj;
	$data0['currencycode'] = @$data0['CurrencyCode'];
if(!isset($data0['CurrencySign'])){$data0['CurrencySign'] = array();}
		$data1_obj = @$simplexml->Result->CurrencySign;
		$data0['CurrencySign'] = @(string)$data1_obj;
	$data0['currencysign'] = @$data0['CurrencySign'];
if(!isset($data0['Balance'])){$data0['Balance'] = array();}
		$data1_obj = @$simplexml->Result->Balance;
		$data0['Balance'] = @$data1_obj;
	$data0['balance'] = @$data0['Balance'];
if(!isset($data0['ReservedAmount'])){$data0['ReservedAmount'] = array();}
		$data1_obj = @$simplexml->Result->ReservedAmount;
		$data0['ReservedAmount'] = @$data1_obj;
	$data0['reservedamount'] = @$data0['ReservedAmount'];
if(!isset($data0['AvailableAmount'])){$data0['AvailableAmount'] = array();}
		$data1_obj = @$simplexml->Result->AvailableAmount;
		$data0['AvailableAmount'] = @$data1_obj;
	$data0['availableamount'] = @$data0['AvailableAmount'];
if(!isset($data0['PaymWaitAmount'])){$data0['PaymWaitAmount'] = array();}
		$data1_obj = @$simplexml->Result->PaymWaitAmount;
		$data0['PaymWaitAmount'] = @$data1_obj;
	$data0['paymwaitamount'] = @$data0['PaymWaitAmount'];
	return $data0;
    }
    public function GetStatement($sessionId, $fromDate, $toDate){
        $params = array(
            'sessionId' => $sessionId,
	    'fromDate' => $fromDate,
	    'toDate' => $toDate
        );
        $params += $this->defaultLogin();
        $simplexml = $this->_getData('GetStatement', $params);
        if (!$simplexml) return false;
        
        $data0 = array();
        
if(!isset($data0)){$data0 = array();}
	$data0_obj = @$simplexml->Result;
if(!isset($data0['Header'])){$data0['Header'] = array();}
		$data1_obj = @$simplexml->Result->Header;
if(!isset($data0['Header']['StartBalance'])){$data0['Header']['StartBalance'] = array();}
			$data2_obj = @$simplexml->Result->Header->StartBalance;
			$data0['Header']['StartBalance'] = @$data2_obj;
		$data0['Header']['startbalance'] = @$data0['Header']['StartBalance'];
if(!isset($data0['Header']['Debit'])){$data0['Header']['Debit'] = array();}
			$data2_obj = @$simplexml->Result->Header->Debit;
			$data0['Header']['Debit'] = @$data2_obj;
		$data0['Header']['debit'] = @$data0['Header']['Debit'];
if(!isset($data0['Header']['Credit'])){$data0['Header']['Credit'] = array();}
			$data2_obj = @$simplexml->Result->Header->Credit;
			$data0['Header']['Credit'] = @$data2_obj;
		$data0['Header']['credit'] = @$data0['Header']['Credit'];
if(!isset($data0['Header']['EndBalance'])){$data0['Header']['EndBalance'] = array();}
			$data2_obj = @$simplexml->Result->Header->EndBalance;
			$data0['Header']['EndBalance'] = @$data2_obj;
		$data0['Header']['endbalance'] = @$data0['Header']['EndBalance'];
if(!isset($data0['Header']['TransCount'])){$data0['Header']['TransCount'] = array();}
			$data2_obj = @$simplexml->Result->Header->TransCount;
			$data0['Header']['TransCount'] = @$data2_obj;
		$data0['Header']['transcount'] = @$data0['Header']['TransCount'];
if(!isset($data0['Header']['CurrencyCode'])){$data0['Header']['CurrencyCode'] = array();}
			$data2_obj = @$simplexml->Result->Header->CurrencyCode;
			$data0['Header']['CurrencyCode'] = @(string)$data2_obj;
		$data0['Header']['currencycode'] = @$data0['Header']['CurrencyCode'];
if(!isset($data0['Header']['CurrencySign'])){$data0['Header']['CurrencySign'] = array();}
			$data2_obj = @$simplexml->Result->Header->CurrencySign;
			$data0['Header']['CurrencySign'] = @(string)$data2_obj;
		$data0['Header']['currencysign'] = @$data0['Header']['CurrencySign'];
	$data0['header'] = @$data0['Header'];
if(!isset($data0['TransList'])){$data0['TransList'] = array();}

	if(!isset($simplexml->Result->TransList) || is_null($simplexml->Result->TransList) || !$simplexml->Result->TransList)		$data1_obj = @array();

	else
		$data1_obj = @$simplexml->Result->TransList->children();
		$data0['TransList'] = @array();
		foreach($data1_obj as $value1){
			$data1_tmp = @array();
if(!isset($data1_tmp['TransactionType'])){$data1_tmp['TransactionType'] = array();}
			$data2_obj = @$value1->TransactionType;
if(!isset($data1_tmp['TransactionType']['Id'])){$data1_tmp['TransactionType']['Id'] = array();}
				$data3_obj = @$value1->TransactionType->Id;
				$data1_tmp['TransactionType']['Id'] = @$data3_obj;
			$data1_tmp['TransactionType']['id'] = @$data1_tmp['TransactionType']['Id'];
if(!isset($data1_tmp['TransactionType']['Name'])){$data1_tmp['TransactionType']['Name'] = array();}
				$data3_obj = @$value1->TransactionType->Name;
				$data1_tmp['TransactionType']['Name'] = @(string)$data3_obj;
			$data1_tmp['TransactionType']['name'] = @$data1_tmp['TransactionType']['Name'];
			$data1_tmp['TransDate'] = @(string)$value1->TransDate;
			$data1_tmp['transdate'] = @(string)$value1->TransDate;
			$data1_tmp['Amount'] = @$value1->Amount;
			$data1_tmp['amount'] = @$value1->Amount;
			$data1_tmp['SalesId'] = @(string)$value1->SalesId;
			$data1_tmp['salesid'] = @(string)$value1->SalesId;
			$data1_tmp['Comment'] = @(string)$value1->Comment;
			$data1_tmp['comment'] = @(string)$value1->Comment;
			$data1_tmp['Direction'] = @(string)$value1->Direction;
			$data1_tmp['direction'] = @(string)$value1->Direction;
			$data0['TransList'][] = @$data1_tmp;
		}
	$data0['translist'] = @$data0['TransList'];
	return $data0;
    }
    public function GetPaymentParameters($sessionId, $paymentRequestXml){
        $params = array(
            'sessionId' => $sessionId,
	    'paymentRequestXml' => $paymentRequestXml
        );
        $params += $this->defaultLogin();
        $simplexml = $this->_getData('GetPaymentParameters', $params);
        if (!$simplexml) return false;
        
        $data0 = array();
        
if(!isset($data0)){$data0 = array();}
	$data0_obj = @$simplexml->Result;
if(!isset($data0['IsImmmediate'])){$data0['IsImmmediate'] = array();}
		$data1_obj = @$simplexml->Result->IsImmmediate;
		$data0['IsImmmediate'] = @$data1_obj;
	$data0['isimmmediate'] = @$data0['IsImmmediate'];
if(!isset($data0['RequestMethod'])){$data0['RequestMethod'] = array();}
		$data1_obj = @$simplexml->Result->RequestMethod;
		$data0['RequestMethod'] = @(string)$data1_obj;
	$data0['requestmethod'] = @$data0['RequestMethod'];
if(!isset($data0['RequestUrl'])){$data0['RequestUrl'] = array();}
		$data1_obj = @$simplexml->Result->RequestUrl;
		$data0['RequestUrl'] = @(string)$data1_obj;
	$data0['requesturl'] = @$data0['RequestUrl'];
if(!isset($data0['IsIFrame'])){$data0['IsIFrame'] = array();}
		$data1_obj = @$simplexml->Result->IsIFrame;
		$data0['IsIFrame'] = @$data1_obj;
	$data0['isiframe'] = @$data0['IsIFrame'];
if(!isset($data0['Parameters'])){$data0['Parameters'] = array();}

	if(!isset($simplexml->Result->Parameters) || is_null($simplexml->Result->Parameters) || !$simplexml->Result->Parameters)		$data1_obj = @array();

	else
		$data1_obj = @$simplexml->Result->Parameters->children();
		$data0['Parameters'] = @array();
		foreach($data1_obj as $value1){
			$data1_tmp = @array();
			$data1_tmp['Name'] = @(string)$value1->Name;
			$data1_tmp['name'] = @(string)$value1->Name;
			$data1_tmp['Value'] = @(string)$value1->Value;
			$data1_tmp['value'] = @(string)$value1->Value;
			$data1_tmp['IsUserData'] = @$value1->IsUserData;
			$data1_tmp['isuserdata'] = @$value1->IsUserData;
			$data0['Parameters'][] = @$data1_tmp;
		}
	$data0['parameters'] = @$data0['Parameters'];
	return $data0;
    }
    public function PaymentPersonalAccount($sessionId, $salesId, $amount){
        $params = array(
            'sessionId' => $sessionId,
	    'salesId' => $salesId,
	    'amount' => $amount
        );
        $params += $this->defaultLogin();
        $simplexml = $this->_getData('PaymentPersonalAccount', $params);
        if (!$simplexml) return false;
        
        $data0 = array();
        
if(!isset($data0)){$data0 = array();}
	$data0_obj = @$simplexml;
	$data0 = @$data0_obj;
	return $data0;
    }
    public function GetSalesPackageList($sessionId, $salesId){
        $params = array(
            'sessionId' => $sessionId,
	    'salesId' => $salesId
        );
        $params += $this->defaultLogin();
        $simplexml = $this->_getData('GetSalesPackageList', $params);
        if (!$simplexml) return false;
        
        $data0 = array();
        
if(!isset($data0)){$data0 = array();}

	if(!isset($simplexml->Result->Content) || is_null($simplexml->Result->Content) || !$simplexml->Result->Content)	$data0_obj = @array();

	else
	$data0_obj = @$simplexml->Result->Content->children();
	$data0 = @array();
	foreach($data0_obj as $value0){
		$data0_tmp = @array();
		$data0_tmp['DeliveryTrackingNum'] = @(string)$value0->DeliveryTrackingNum;
		$data0_tmp['deliverytrackingnum'] = @(string)$value0->DeliveryTrackingNum;
		$data0_tmp['Weight'] = @$value0->Weight;
		$data0_tmp['weight'] = @$value0->Weight;
		$data0_tmp['ManualPrice'] = @(int)$value0->ManualPrice;
		$data0_tmp['manualprice'] = @(int)$value0->ManualPrice;
		$data0_tmp['PriceInternal'] = @$value0->PriceInternal;
		$data0_tmp['priceinternal'] = @$value0->PriceInternal;
		$data0_tmp['AdditionalPriceInternal'] = @$value0->AdditionalPriceInternal;
		$data0_tmp['additionalpriceinternal'] = @$value0->AdditionalPriceInternal;
		$data0_tmp['AdditionalPrice'] = @$value0->AdditionalPrice;
		$data0_tmp['additionalprice'] = @$value0->AdditionalPrice;
		$data0_tmp['Price'] = @$value0->Price;
		$data0_tmp['price'] = @$value0->Price;
		$data0_tmp['PriceCurrencyCode'] = @(string)$value0->PriceCurrencyCode;
		$data0_tmp['pricecurrencycode'] = @(string)$value0->PriceCurrencyCode;
		$data0_tmp['PriceUpdateDate'] = @$value0->PriceUpdateDate;
		$data0_tmp['priceupdatedate'] = @$value0->PriceUpdateDate;
		$data0_tmp['DeliveryModeId'] = @(string)$value0->DeliveryModeId;
		$data0_tmp['deliverymodeid'] = @(string)$value0->DeliveryModeId;
		$data0_tmp['DeliveryContactLastname'] = @(string)$value0->DeliveryContactLastname;
		$data0_tmp['deliverycontactlastname'] = @(string)$value0->DeliveryContactLastname;
		$data0_tmp['DeliveryContactFirstname'] = @(string)$value0->DeliveryContactFirstname;
		$data0_tmp['deliverycontactfirstname'] = @(string)$value0->DeliveryContactFirstname;
		$data0_tmp['DeliveryContactMiddlename'] = @(string)$value0->DeliveryContactMiddlename;
		$data0_tmp['deliverycontactmiddlename'] = @(string)$value0->DeliveryContactMiddlename;
		$data0_tmp['DeliveryContactPhone'] = @(string)$value0->DeliveryContactPhone;
		$data0_tmp['deliverycontactphone'] = @(string)$value0->DeliveryContactPhone;
		$data0_tmp['DeliveryCountry'] = @(string)$value0->DeliveryCountry;
		$data0_tmp['deliverycountry'] = @(string)$value0->DeliveryCountry;
		$data0_tmp['DeliveryPostalCode'] = @(string)$value0->DeliveryPostalCode;
		$data0_tmp['deliverypostalcode'] = @(string)$value0->DeliveryPostalCode;
		$data0_tmp['DeliveryRegionName'] = @(string)$value0->DeliveryRegionName;
		$data0_tmp['deliveryregionname'] = @(string)$value0->DeliveryRegionName;
		$data0_tmp['DeliveryCity'] = @(string)$value0->DeliveryCity;
		$data0_tmp['deliverycity'] = @(string)$value0->DeliveryCity;
		$data0_tmp['DeliveryAddress'] = @(string)$value0->DeliveryAddress;
		$data0_tmp['deliveryaddress'] = @(string)$value0->DeliveryAddress;
		$data0_tmp['Id'] = @(string)$value0->Id;
		$data0_tmp['id'] = @(string)$value0->Id;
		$data0_tmp['StatusId'] = @(string)$value0->StatusId;
		$data0_tmp['statusid'] = @(string)$value0->StatusId;
		$data0_tmp['StatusCode'] = @(string)$value0->StatusCode;
		$data0_tmp['statuscode'] = @(string)$value0->StatusCode;
		$data0_tmp['StatusName'] = @(string)$value0->StatusName;
		$data0_tmp['statusname'] = @(string)$value0->StatusName;
		$data0_tmp['CurrencyCodeInternal'] = @(string)$value0->CurrencyCodeInternal;
		$data0_tmp['currencycodeinternal'] = @(string)$value0->CurrencyCodeInternal;
		$data0_tmp['CurrencySignInternal'] = @(string)$value0->CurrencySignInternal;
		$data0_tmp['currencysigninternal'] = @(string)$value0->CurrencySignInternal;
		$data0_tmp['PriceCust'] = @$value0->PriceCust;
		$data0_tmp['pricecust'] = @$value0->PriceCust;
		$data0_tmp['CurrencyCodeCust'] = @(string)$value0->CurrencyCodeCust;
		$data0_tmp['currencycodecust'] = @(string)$value0->CurrencyCodeCust;
		$data0_tmp['CurrencySignCust'] = @(string)$value0->CurrencySignCust;
		$data0_tmp['currencysigncust'] = @(string)$value0->CurrencySignCust;
		$data0_tmp['DeliveryModeName'] = @(string)$value0->DeliveryModeName;
		$data0_tmp['deliverymodename'] = @(string)$value0->DeliveryModeName;
		$data0_tmp['CanDelete'] = @(int)$value0->CanDelete;
		$data0_tmp['candelete'] = @(int)$value0->CanDelete;
		$data0_tmp['CanUpdate'] = @(int)$value0->CanUpdate;
		$data0_tmp['canupdate'] = @(int)$value0->CanUpdate;
		$data0_tmp['ShipmentDate'] = @$value0->ShipmentDate;
		$data0_tmp['shipmentdate'] = @$value0->ShipmentDate;
		$data0_tmp['CreationDate'] = @$value0->CreationDate;
		$data0_tmp['creationdate'] = @$value0->CreationDate;
		$data0[] = @$data0_tmp;
	}
	return $data0;
    }
    public function CreatePackage($sessionId, $salesId){
        $params = array(
            'sessionId' => $sessionId,
	    'salesId' => $salesId
        );
        $params += $this->defaultLogin();
        $simplexml = $this->_getData('CreatePackage', $params);
        if (!$simplexml) return false;
        
        $data0 = array();
        
if(!isset($data0)){$data0 = array();}
	$data0_obj = @$simplexml->Result;
if(!isset($data0['DeliveryTrackingNum'])){$data0['DeliveryTrackingNum'] = array();}
		$data1_obj = @$simplexml->Result->DeliveryTrackingNum;
		$data0['DeliveryTrackingNum'] = @(string)$data1_obj;
	$data0['deliverytrackingnum'] = @$data0['DeliveryTrackingNum'];
if(!isset($data0['Weight'])){$data0['Weight'] = array();}
		$data1_obj = @$simplexml->Result->Weight;
		$data0['Weight'] = @$data1_obj;
	$data0['weight'] = @$data0['Weight'];
if(!isset($data0['ManualPrice'])){$data0['ManualPrice'] = array();}
		$data1_obj = @$simplexml->Result->ManualPrice;
		$data0['ManualPrice'] = @$data1_obj;
	$data0['manualprice'] = @$data0['ManualPrice'];
if(!isset($data0['PriceInternal'])){$data0['PriceInternal'] = array();}
		$data1_obj = @$simplexml->Result->PriceInternal;
		$data0['PriceInternal'] = @$data1_obj;
	$data0['priceinternal'] = @$data0['PriceInternal'];
if(!isset($data0['AdditionalPriceInternal'])){$data0['AdditionalPriceInternal'] = array();}
		$data1_obj = @$simplexml->Result->AdditionalPriceInternal;
		$data0['AdditionalPriceInternal'] = @$data1_obj;
	$data0['additionalpriceinternal'] = @$data0['AdditionalPriceInternal'];
if(!isset($data0['AdditionalPrice'])){$data0['AdditionalPrice'] = array();}
		$data1_obj = @$simplexml->Result->AdditionalPrice;
		$data0['AdditionalPrice'] = @$data1_obj;
	$data0['additionalprice'] = @$data0['AdditionalPrice'];
if(!isset($data0['Price'])){$data0['Price'] = array();}
		$data1_obj = @$simplexml->Result->Price;
		$data0['Price'] = @$data1_obj;
	$data0['price'] = @$data0['Price'];
if(!isset($data0['PriceCurrencyCode'])){$data0['PriceCurrencyCode'] = array();}
		$data1_obj = @$simplexml->Result->PriceCurrencyCode;
		$data0['PriceCurrencyCode'] = @(string)$data1_obj;
	$data0['pricecurrencycode'] = @$data0['PriceCurrencyCode'];
if(!isset($data0['PriceUpdateDate'])){$data0['PriceUpdateDate'] = array();}
		$data1_obj = @$simplexml->Result->PriceUpdateDate;
		$data0['PriceUpdateDate'] = @$data1_obj;
	$data0['priceupdatedate'] = @$data0['PriceUpdateDate'];
if(!isset($data0['DeliveryModeId'])){$data0['DeliveryModeId'] = array();}
		$data1_obj = @$simplexml->Result->DeliveryModeId;
		$data0['DeliveryModeId'] = @(string)$data1_obj;
	$data0['deliverymodeid'] = @$data0['DeliveryModeId'];
if(!isset($data0['DeliveryContactLastname'])){$data0['DeliveryContactLastname'] = array();}
		$data1_obj = @$simplexml->Result->DeliveryContactLastname;
		$data0['DeliveryContactLastname'] = @(string)$data1_obj;
	$data0['deliverycontactlastname'] = @$data0['DeliveryContactLastname'];
if(!isset($data0['DeliveryContactFirstname'])){$data0['DeliveryContactFirstname'] = array();}
		$data1_obj = @$simplexml->Result->DeliveryContactFirstname;
		$data0['DeliveryContactFirstname'] = @(string)$data1_obj;
	$data0['deliverycontactfirstname'] = @$data0['DeliveryContactFirstname'];
if(!isset($data0['DeliveryContactMiddlename'])){$data0['DeliveryContactMiddlename'] = array();}
		$data1_obj = @$simplexml->Result->DeliveryContactMiddlename;
		$data0['DeliveryContactMiddlename'] = @(string)$data1_obj;
	$data0['deliverycontactmiddlename'] = @$data0['DeliveryContactMiddlename'];
if(!isset($data0['DeliveryContactPhone'])){$data0['DeliveryContactPhone'] = array();}
		$data1_obj = @$simplexml->Result->DeliveryContactPhone;
		$data0['DeliveryContactPhone'] = @(string)$data1_obj;
	$data0['deliverycontactphone'] = @$data0['DeliveryContactPhone'];
if(!isset($data0['DeliveryCountry'])){$data0['DeliveryCountry'] = array();}
		$data1_obj = @$simplexml->Result->DeliveryCountry;
		$data0['DeliveryCountry'] = @(string)$data1_obj;
	$data0['deliverycountry'] = @$data0['DeliveryCountry'];
if(!isset($data0['DeliveryPostalCode'])){$data0['DeliveryPostalCode'] = array();}
		$data1_obj = @$simplexml->Result->DeliveryPostalCode;
		$data0['DeliveryPostalCode'] = @(string)$data1_obj;
	$data0['deliverypostalcode'] = @$data0['DeliveryPostalCode'];
if(!isset($data0['DeliveryRegionName'])){$data0['DeliveryRegionName'] = array();}
		$data1_obj = @$simplexml->Result->DeliveryRegionName;
		$data0['DeliveryRegionName'] = @(string)$data1_obj;
	$data0['deliveryregionname'] = @$data0['DeliveryRegionName'];
if(!isset($data0['DeliveryCity'])){$data0['DeliveryCity'] = array();}
		$data1_obj = @$simplexml->Result->DeliveryCity;
		$data0['DeliveryCity'] = @(string)$data1_obj;
	$data0['deliverycity'] = @$data0['DeliveryCity'];
if(!isset($data0['DeliveryAddress'])){$data0['DeliveryAddress'] = array();}
		$data1_obj = @$simplexml->Result->DeliveryAddress;
		$data0['DeliveryAddress'] = @(string)$data1_obj;
	$data0['deliveryaddress'] = @$data0['DeliveryAddress'];
if(!isset($data0['Id'])){$data0['Id'] = array();}
		$data1_obj = @$simplexml->Result->Id;
		$data0['Id'] = @(string)$data1_obj;
	$data0['id'] = @$data0['Id'];
if(!isset($data0['StatusId'])){$data0['StatusId'] = array();}
		$data1_obj = @$simplexml->Result->StatusId;
		$data0['StatusId'] = @(string)$data1_obj;
	$data0['statusid'] = @$data0['StatusId'];
if(!isset($data0['StatusCode'])){$data0['StatusCode'] = array();}
		$data1_obj = @$simplexml->Result->StatusCode;
		$data0['StatusCode'] = @(string)$data1_obj;
	$data0['statuscode'] = @$data0['StatusCode'];
if(!isset($data0['StatusName'])){$data0['StatusName'] = array();}
		$data1_obj = @$simplexml->Result->StatusName;
		$data0['StatusName'] = @(string)$data1_obj;
	$data0['statusname'] = @$data0['StatusName'];
if(!isset($data0['CurrencyCodeInternal'])){$data0['CurrencyCodeInternal'] = array();}
		$data1_obj = @$simplexml->Result->CurrencyCodeInternal;
		$data0['CurrencyCodeInternal'] = @(string)$data1_obj;
	$data0['currencycodeinternal'] = @$data0['CurrencyCodeInternal'];
if(!isset($data0['CurrencySignInternal'])){$data0['CurrencySignInternal'] = array();}
		$data1_obj = @$simplexml->Result->CurrencySignInternal;
		$data0['CurrencySignInternal'] = @(string)$data1_obj;
	$data0['currencysigninternal'] = @$data0['CurrencySignInternal'];
if(!isset($data0['PriceCust'])){$data0['PriceCust'] = array();}
		$data1_obj = @$simplexml->Result->PriceCust;
		$data0['PriceCust'] = @$data1_obj;
	$data0['pricecust'] = @$data0['PriceCust'];
if(!isset($data0['CurrencyCodeCust'])){$data0['CurrencyCodeCust'] = array();}
		$data1_obj = @$simplexml->Result->CurrencyCodeCust;
		$data0['CurrencyCodeCust'] = @(string)$data1_obj;
	$data0['currencycodecust'] = @$data0['CurrencyCodeCust'];
if(!isset($data0['CurrencySignCust'])){$data0['CurrencySignCust'] = array();}
		$data1_obj = @$simplexml->Result->CurrencySignCust;
		$data0['CurrencySignCust'] = @(string)$data1_obj;
	$data0['currencysigncust'] = @$data0['CurrencySignCust'];
if(!isset($data0['DeliveryModeName'])){$data0['DeliveryModeName'] = array();}
		$data1_obj = @$simplexml->Result->DeliveryModeName;
		$data0['DeliveryModeName'] = @(string)$data1_obj;
	$data0['deliverymodename'] = @$data0['DeliveryModeName'];
if(!isset($data0['CanDelete'])){$data0['CanDelete'] = array();}
		$data1_obj = @$simplexml->Result->CanDelete;
		$data0['CanDelete'] = @$data1_obj;
	$data0['candelete'] = @$data0['CanDelete'];
if(!isset($data0['CanUpdate'])){$data0['CanUpdate'] = array();}
		$data1_obj = @$simplexml->Result->CanUpdate;
		$data0['CanUpdate'] = @$data1_obj;
	$data0['canupdate'] = @$data0['CanUpdate'];
if(!isset($data0['ShipmentDate'])){$data0['ShipmentDate'] = array();}
		$data1_obj = @$simplexml->Result->ShipmentDate;
		$data0['ShipmentDate'] = @$data1_obj;
	$data0['shipmentdate'] = @$data0['ShipmentDate'];
if(!isset($data0['CreationDate'])){$data0['CreationDate'] = array();}
		$data1_obj = @$simplexml->Result->CreationDate;
		$data0['CreationDate'] = @$data1_obj;
	$data0['creationdate'] = @$data0['CreationDate'];
	return $data0;
    }
    public function DeletePackage($sessionId, $packageId){
        $params = array(
            'sessionId' => $sessionId,
	    'packageId' => $packageId
        );
        $params += $this->defaultLogin();
        $simplexml = $this->_getData('DeletePackage', $params);
        if (!$simplexml) return false;
        
        $data0 = array();
        
if(!isset($data0)){$data0 = array();}
	$data0_obj = @$simplexml;
	$data0 = @$data0_obj;
	return $data0;
    }
    public function UpdatePackage($sessionId, $packageId, $packageAdminUpdateInfo){
        $params = array(
            'sessionId' => $sessionId,
	    'packageId' => $packageId,
	    'packageAdminUpdateInfo' => $packageAdminUpdateInfo
        );
        $params += $this->defaultLogin();
        $simplexml = $this->_getData('UpdatePackage', $params);
        if (!$simplexml) return false;
        
        $data0 = array();
        
if(!isset($data0)){$data0 = array();}
	$data0_obj = @$simplexml->Result;
if(!isset($data0['DeliveryTrackingNum'])){$data0['DeliveryTrackingNum'] = array();}
		$data1_obj = @$simplexml->Result->DeliveryTrackingNum;
		$data0['DeliveryTrackingNum'] = @(string)$data1_obj;
	$data0['deliverytrackingnum'] = @$data0['DeliveryTrackingNum'];
if(!isset($data0['Weight'])){$data0['Weight'] = array();}
		$data1_obj = @$simplexml->Result->Weight;
		$data0['Weight'] = @$data1_obj;
	$data0['weight'] = @$data0['Weight'];
if(!isset($data0['ManualPrice'])){$data0['ManualPrice'] = array();}
		$data1_obj = @$simplexml->Result->ManualPrice;
		$data0['ManualPrice'] = @$data1_obj;
	$data0['manualprice'] = @$data0['ManualPrice'];
if(!isset($data0['PriceInternal'])){$data0['PriceInternal'] = array();}
		$data1_obj = @$simplexml->Result->PriceInternal;
		$data0['PriceInternal'] = @$data1_obj;
	$data0['priceinternal'] = @$data0['PriceInternal'];
if(!isset($data0['AdditionalPriceInternal'])){$data0['AdditionalPriceInternal'] = array();}
		$data1_obj = @$simplexml->Result->AdditionalPriceInternal;
		$data0['AdditionalPriceInternal'] = @$data1_obj;
	$data0['additionalpriceinternal'] = @$data0['AdditionalPriceInternal'];
if(!isset($data0['AdditionalPrice'])){$data0['AdditionalPrice'] = array();}
		$data1_obj = @$simplexml->Result->AdditionalPrice;
		$data0['AdditionalPrice'] = @$data1_obj;
	$data0['additionalprice'] = @$data0['AdditionalPrice'];
if(!isset($data0['Price'])){$data0['Price'] = array();}
		$data1_obj = @$simplexml->Result->Price;
		$data0['Price'] = @$data1_obj;
	$data0['price'] = @$data0['Price'];
if(!isset($data0['PriceCurrencyCode'])){$data0['PriceCurrencyCode'] = array();}
		$data1_obj = @$simplexml->Result->PriceCurrencyCode;
		$data0['PriceCurrencyCode'] = @(string)$data1_obj;
	$data0['pricecurrencycode'] = @$data0['PriceCurrencyCode'];
if(!isset($data0['PriceUpdateDate'])){$data0['PriceUpdateDate'] = array();}
		$data1_obj = @$simplexml->Result->PriceUpdateDate;
		$data0['PriceUpdateDate'] = @$data1_obj;
	$data0['priceupdatedate'] = @$data0['PriceUpdateDate'];
if(!isset($data0['DeliveryModeId'])){$data0['DeliveryModeId'] = array();}
		$data1_obj = @$simplexml->Result->DeliveryModeId;
		$data0['DeliveryModeId'] = @(string)$data1_obj;
	$data0['deliverymodeid'] = @$data0['DeliveryModeId'];
if(!isset($data0['DeliveryContactLastname'])){$data0['DeliveryContactLastname'] = array();}
		$data1_obj = @$simplexml->Result->DeliveryContactLastname;
		$data0['DeliveryContactLastname'] = @(string)$data1_obj;
	$data0['deliverycontactlastname'] = @$data0['DeliveryContactLastname'];
if(!isset($data0['DeliveryContactFirstname'])){$data0['DeliveryContactFirstname'] = array();}
		$data1_obj = @$simplexml->Result->DeliveryContactFirstname;
		$data0['DeliveryContactFirstname'] = @(string)$data1_obj;
	$data0['deliverycontactfirstname'] = @$data0['DeliveryContactFirstname'];
if(!isset($data0['DeliveryContactMiddlename'])){$data0['DeliveryContactMiddlename'] = array();}
		$data1_obj = @$simplexml->Result->DeliveryContactMiddlename;
		$data0['DeliveryContactMiddlename'] = @(string)$data1_obj;
	$data0['deliverycontactmiddlename'] = @$data0['DeliveryContactMiddlename'];
if(!isset($data0['DeliveryContactPhone'])){$data0['DeliveryContactPhone'] = array();}
		$data1_obj = @$simplexml->Result->DeliveryContactPhone;
		$data0['DeliveryContactPhone'] = @(string)$data1_obj;
	$data0['deliverycontactphone'] = @$data0['DeliveryContactPhone'];
if(!isset($data0['DeliveryCountry'])){$data0['DeliveryCountry'] = array();}
		$data1_obj = @$simplexml->Result->DeliveryCountry;
		$data0['DeliveryCountry'] = @(string)$data1_obj;
	$data0['deliverycountry'] = @$data0['DeliveryCountry'];
if(!isset($data0['DeliveryPostalCode'])){$data0['DeliveryPostalCode'] = array();}
		$data1_obj = @$simplexml->Result->DeliveryPostalCode;
		$data0['DeliveryPostalCode'] = @(string)$data1_obj;
	$data0['deliverypostalcode'] = @$data0['DeliveryPostalCode'];
if(!isset($data0['DeliveryRegionName'])){$data0['DeliveryRegionName'] = array();}
		$data1_obj = @$simplexml->Result->DeliveryRegionName;
		$data0['DeliveryRegionName'] = @(string)$data1_obj;
	$data0['deliveryregionname'] = @$data0['DeliveryRegionName'];
if(!isset($data0['DeliveryCity'])){$data0['DeliveryCity'] = array();}
		$data1_obj = @$simplexml->Result->DeliveryCity;
		$data0['DeliveryCity'] = @(string)$data1_obj;
	$data0['deliverycity'] = @$data0['DeliveryCity'];
if(!isset($data0['DeliveryAddress'])){$data0['DeliveryAddress'] = array();}
		$data1_obj = @$simplexml->Result->DeliveryAddress;
		$data0['DeliveryAddress'] = @(string)$data1_obj;
	$data0['deliveryaddress'] = @$data0['DeliveryAddress'];
if(!isset($data0['Id'])){$data0['Id'] = array();}
		$data1_obj = @$simplexml->Result->Id;
		$data0['Id'] = @(string)$data1_obj;
	$data0['id'] = @$data0['Id'];
if(!isset($data0['StatusId'])){$data0['StatusId'] = array();}
		$data1_obj = @$simplexml->Result->StatusId;
		$data0['StatusId'] = @(string)$data1_obj;
	$data0['statusid'] = @$data0['StatusId'];
if(!isset($data0['StatusCode'])){$data0['StatusCode'] = array();}
		$data1_obj = @$simplexml->Result->StatusCode;
		$data0['StatusCode'] = @(string)$data1_obj;
	$data0['statuscode'] = @$data0['StatusCode'];
if(!isset($data0['StatusName'])){$data0['StatusName'] = array();}
		$data1_obj = @$simplexml->Result->StatusName;
		$data0['StatusName'] = @(string)$data1_obj;
	$data0['statusname'] = @$data0['StatusName'];
if(!isset($data0['CurrencyCodeInternal'])){$data0['CurrencyCodeInternal'] = array();}
		$data1_obj = @$simplexml->Result->CurrencyCodeInternal;
		$data0['CurrencyCodeInternal'] = @(string)$data1_obj;
	$data0['currencycodeinternal'] = @$data0['CurrencyCodeInternal'];
if(!isset($data0['CurrencySignInternal'])){$data0['CurrencySignInternal'] = array();}
		$data1_obj = @$simplexml->Result->CurrencySignInternal;
		$data0['CurrencySignInternal'] = @(string)$data1_obj;
	$data0['currencysigninternal'] = @$data0['CurrencySignInternal'];
if(!isset($data0['PriceCust'])){$data0['PriceCust'] = array();}
		$data1_obj = @$simplexml->Result->PriceCust;
		$data0['PriceCust'] = @$data1_obj;
	$data0['pricecust'] = @$data0['PriceCust'];
if(!isset($data0['CurrencyCodeCust'])){$data0['CurrencyCodeCust'] = array();}
		$data1_obj = @$simplexml->Result->CurrencyCodeCust;
		$data0['CurrencyCodeCust'] = @(string)$data1_obj;
	$data0['currencycodecust'] = @$data0['CurrencyCodeCust'];
if(!isset($data0['CurrencySignCust'])){$data0['CurrencySignCust'] = array();}
		$data1_obj = @$simplexml->Result->CurrencySignCust;
		$data0['CurrencySignCust'] = @(string)$data1_obj;
	$data0['currencysigncust'] = @$data0['CurrencySignCust'];
if(!isset($data0['DeliveryModeName'])){$data0['DeliveryModeName'] = array();}
		$data1_obj = @$simplexml->Result->DeliveryModeName;
		$data0['DeliveryModeName'] = @(string)$data1_obj;
	$data0['deliverymodename'] = @$data0['DeliveryModeName'];
if(!isset($data0['CanDelete'])){$data0['CanDelete'] = array();}
		$data1_obj = @$simplexml->Result->CanDelete;
		$data0['CanDelete'] = @$data1_obj;
	$data0['candelete'] = @$data0['CanDelete'];
if(!isset($data0['CanUpdate'])){$data0['CanUpdate'] = array();}
		$data1_obj = @$simplexml->Result->CanUpdate;
		$data0['CanUpdate'] = @$data1_obj;
	$data0['canupdate'] = @$data0['CanUpdate'];
if(!isset($data0['ShipmentDate'])){$data0['ShipmentDate'] = array();}
		$data1_obj = @$simplexml->Result->ShipmentDate;
		$data0['ShipmentDate'] = @$data1_obj;
	$data0['shipmentdate'] = @$data0['ShipmentDate'];
if(!isset($data0['CreationDate'])){$data0['CreationDate'] = array();}
		$data1_obj = @$simplexml->Result->CreationDate;
		$data0['CreationDate'] = @$data1_obj;
	$data0['creationdate'] = @$data0['CreationDate'];
	return $data0;
    }
    public function GetPackage($sessionId, $packageId){
        $params = array(
            'sessionId' => $sessionId,
	    'packageId' => $packageId
        );
        $params += $this->defaultLogin();
        $simplexml = $this->_getData('GetPackage', $params);
        if (!$simplexml) return false;
        
        $data0 = array();
        
if(!isset($data0)){$data0 = array();}
	$data0_obj = @$simplexml->Result;
if(!isset($data0['DeliveryTrackingNum'])){$data0['DeliveryTrackingNum'] = array();}
		$data1_obj = @$simplexml->Result->DeliveryTrackingNum;
		$data0['DeliveryTrackingNum'] = @(string)$data1_obj;
	$data0['deliverytrackingnum'] = @$data0['DeliveryTrackingNum'];
if(!isset($data0['Weight'])){$data0['Weight'] = array();}
		$data1_obj = @$simplexml->Result->Weight;
		$data0['Weight'] = @$data1_obj;
	$data0['weight'] = @$data0['Weight'];
if(!isset($data0['ManualPrice'])){$data0['ManualPrice'] = array();}
		$data1_obj = @$simplexml->Result->ManualPrice;
		$data0['ManualPrice'] = @$data1_obj;
	$data0['manualprice'] = @$data0['ManualPrice'];
if(!isset($data0['PriceInternal'])){$data0['PriceInternal'] = array();}
		$data1_obj = @$simplexml->Result->PriceInternal;
		$data0['PriceInternal'] = @$data1_obj;
	$data0['priceinternal'] = @$data0['PriceInternal'];
if(!isset($data0['AdditionalPriceInternal'])){$data0['AdditionalPriceInternal'] = array();}
		$data1_obj = @$simplexml->Result->AdditionalPriceInternal;
		$data0['AdditionalPriceInternal'] = @$data1_obj;
	$data0['additionalpriceinternal'] = @$data0['AdditionalPriceInternal'];
if(!isset($data0['AdditionalPrice'])){$data0['AdditionalPrice'] = array();}
		$data1_obj = @$simplexml->Result->AdditionalPrice;
		$data0['AdditionalPrice'] = @$data1_obj;
	$data0['additionalprice'] = @$data0['AdditionalPrice'];
if(!isset($data0['Price'])){$data0['Price'] = array();}
		$data1_obj = @$simplexml->Result->Price;
		$data0['Price'] = @$data1_obj;
	$data0['price'] = @$data0['Price'];
if(!isset($data0['PriceCurrencyCode'])){$data0['PriceCurrencyCode'] = array();}
		$data1_obj = @$simplexml->Result->PriceCurrencyCode;
		$data0['PriceCurrencyCode'] = @(string)$data1_obj;
	$data0['pricecurrencycode'] = @$data0['PriceCurrencyCode'];
if(!isset($data0['PriceUpdateDate'])){$data0['PriceUpdateDate'] = array();}
		$data1_obj = @$simplexml->Result->PriceUpdateDate;
		$data0['PriceUpdateDate'] = @$data1_obj;
	$data0['priceupdatedate'] = @$data0['PriceUpdateDate'];
if(!isset($data0['DeliveryModeId'])){$data0['DeliveryModeId'] = array();}
		$data1_obj = @$simplexml->Result->DeliveryModeId;
		$data0['DeliveryModeId'] = @(string)$data1_obj;
	$data0['deliverymodeid'] = @$data0['DeliveryModeId'];
if(!isset($data0['DeliveryContactLastname'])){$data0['DeliveryContactLastname'] = array();}
		$data1_obj = @$simplexml->Result->DeliveryContactLastname;
		$data0['DeliveryContactLastname'] = @(string)$data1_obj;
	$data0['deliverycontactlastname'] = @$data0['DeliveryContactLastname'];
if(!isset($data0['DeliveryContactFirstname'])){$data0['DeliveryContactFirstname'] = array();}
		$data1_obj = @$simplexml->Result->DeliveryContactFirstname;
		$data0['DeliveryContactFirstname'] = @(string)$data1_obj;
	$data0['deliverycontactfirstname'] = @$data0['DeliveryContactFirstname'];
if(!isset($data0['DeliveryContactMiddlename'])){$data0['DeliveryContactMiddlename'] = array();}
		$data1_obj = @$simplexml->Result->DeliveryContactMiddlename;
		$data0['DeliveryContactMiddlename'] = @(string)$data1_obj;
	$data0['deliverycontactmiddlename'] = @$data0['DeliveryContactMiddlename'];
if(!isset($data0['DeliveryContactPhone'])){$data0['DeliveryContactPhone'] = array();}
		$data1_obj = @$simplexml->Result->DeliveryContactPhone;
		$data0['DeliveryContactPhone'] = @(string)$data1_obj;
	$data0['deliverycontactphone'] = @$data0['DeliveryContactPhone'];
if(!isset($data0['DeliveryCountry'])){$data0['DeliveryCountry'] = array();}
		$data1_obj = @$simplexml->Result->DeliveryCountry;
		$data0['DeliveryCountry'] = @(string)$data1_obj;
	$data0['deliverycountry'] = @$data0['DeliveryCountry'];
if(!isset($data0['DeliveryPostalCode'])){$data0['DeliveryPostalCode'] = array();}
		$data1_obj = @$simplexml->Result->DeliveryPostalCode;
		$data0['DeliveryPostalCode'] = @(string)$data1_obj;
	$data0['deliverypostalcode'] = @$data0['DeliveryPostalCode'];
if(!isset($data0['DeliveryRegionName'])){$data0['DeliveryRegionName'] = array();}
		$data1_obj = @$simplexml->Result->DeliveryRegionName;
		$data0['DeliveryRegionName'] = @(string)$data1_obj;
	$data0['deliveryregionname'] = @$data0['DeliveryRegionName'];
if(!isset($data0['DeliveryCity'])){$data0['DeliveryCity'] = array();}
		$data1_obj = @$simplexml->Result->DeliveryCity;
		$data0['DeliveryCity'] = @(string)$data1_obj;
	$data0['deliverycity'] = @$data0['DeliveryCity'];
if(!isset($data0['DeliveryAddress'])){$data0['DeliveryAddress'] = array();}
		$data1_obj = @$simplexml->Result->DeliveryAddress;
		$data0['DeliveryAddress'] = @(string)$data1_obj;
	$data0['deliveryaddress'] = @$data0['DeliveryAddress'];
if(!isset($data0['Id'])){$data0['Id'] = array();}
		$data1_obj = @$simplexml->Result->Id;
		$data0['Id'] = @(string)$data1_obj;
	$data0['id'] = @$data0['Id'];
if(!isset($data0['StatusId'])){$data0['StatusId'] = array();}
		$data1_obj = @$simplexml->Result->StatusId;
		$data0['StatusId'] = @(string)$data1_obj;
	$data0['statusid'] = @$data0['StatusId'];
if(!isset($data0['StatusCode'])){$data0['StatusCode'] = array();}
		$data1_obj = @$simplexml->Result->StatusCode;
		$data0['StatusCode'] = @(string)$data1_obj;
	$data0['statuscode'] = @$data0['StatusCode'];
if(!isset($data0['StatusName'])){$data0['StatusName'] = array();}
		$data1_obj = @$simplexml->Result->StatusName;
		$data0['StatusName'] = @(string)$data1_obj;
	$data0['statusname'] = @$data0['StatusName'];
if(!isset($data0['CurrencyCodeInternal'])){$data0['CurrencyCodeInternal'] = array();}
		$data1_obj = @$simplexml->Result->CurrencyCodeInternal;
		$data0['CurrencyCodeInternal'] = @(string)$data1_obj;
	$data0['currencycodeinternal'] = @$data0['CurrencyCodeInternal'];
if(!isset($data0['CurrencySignInternal'])){$data0['CurrencySignInternal'] = array();}
		$data1_obj = @$simplexml->Result->CurrencySignInternal;
		$data0['CurrencySignInternal'] = @(string)$data1_obj;
	$data0['currencysigninternal'] = @$data0['CurrencySignInternal'];
if(!isset($data0['PriceCust'])){$data0['PriceCust'] = array();}
		$data1_obj = @$simplexml->Result->PriceCust;
		$data0['PriceCust'] = @$data1_obj;
	$data0['pricecust'] = @$data0['PriceCust'];
if(!isset($data0['CurrencyCodeCust'])){$data0['CurrencyCodeCust'] = array();}
		$data1_obj = @$simplexml->Result->CurrencyCodeCust;
		$data0['CurrencyCodeCust'] = @(string)$data1_obj;
	$data0['currencycodecust'] = @$data0['CurrencyCodeCust'];
if(!isset($data0['CurrencySignCust'])){$data0['CurrencySignCust'] = array();}
		$data1_obj = @$simplexml->Result->CurrencySignCust;
		$data0['CurrencySignCust'] = @(string)$data1_obj;
	$data0['currencysigncust'] = @$data0['CurrencySignCust'];
if(!isset($data0['DeliveryModeName'])){$data0['DeliveryModeName'] = array();}
		$data1_obj = @$simplexml->Result->DeliveryModeName;
		$data0['DeliveryModeName'] = @(string)$data1_obj;
	$data0['deliverymodename'] = @$data0['DeliveryModeName'];
if(!isset($data0['CanDelete'])){$data0['CanDelete'] = array();}
		$data1_obj = @$simplexml->Result->CanDelete;
		$data0['CanDelete'] = @$data1_obj;
	$data0['candelete'] = @$data0['CanDelete'];
if(!isset($data0['CanUpdate'])){$data0['CanUpdate'] = array();}
		$data1_obj = @$simplexml->Result->CanUpdate;
		$data0['CanUpdate'] = @$data1_obj;
	$data0['canupdate'] = @$data0['CanUpdate'];
if(!isset($data0['ShipmentDate'])){$data0['ShipmentDate'] = array();}
		$data1_obj = @$simplexml->Result->ShipmentDate;
		$data0['ShipmentDate'] = @$data1_obj;
	$data0['shipmentdate'] = @$data0['ShipmentDate'];
if(!isset($data0['CreationDate'])){$data0['CreationDate'] = array();}
		$data1_obj = @$simplexml->Result->CreationDate;
		$data0['CreationDate'] = @$data1_obj;
	$data0['creationdate'] = @$data0['CreationDate'];
	return $data0;
    }
    public function ChangePackageStatus($sessionId, $packageId, $statusId, $statusDate, $comment){
        $params = array(
            'sessionId' => $sessionId,
	    'packageId' => $packageId,
	    'statusId' => $statusId,
	    'statusDate' => $statusDate,
	    'comment' => $comment
        );
        $params += $this->defaultLogin();
        $simplexml = $this->_getData('ChangePackageStatus', $params);
        if (!$simplexml) return false;
        
        $data0 = array();
        
if(!isset($data0)){$data0 = array();}
	$data0_obj = @$simplexml;
	$data0 = @$data0_obj;
	return $data0;
    }
    public function GetPackageAvailableStatusList($sessionId, $packageId){
        $params = array(
            'sessionId' => $sessionId,
	    'packageId' => $packageId
        );
        $params += $this->defaultLogin();
        $simplexml = $this->_getData('GetPackageAvailableStatusList', $params);
        if (!$simplexml) return false;
        
        $data0 = array();
        
if(!isset($data0)){$data0 = array();}

	if(!isset($simplexml->Result->Content) || is_null($simplexml->Result->Content) || !$simplexml->Result->Content)	$data0_obj = @array();

	else
	$data0_obj = @$simplexml->Result->Content->children();
	$data0 = @array();
	foreach($data0_obj as $value0){
		$data0_tmp = @array();
		$data0_tmp['Id'] = @(string)$value0->Id;
		$data0_tmp['id'] = @(string)$value0->Id;
		$data0_tmp['Name'] = @(string)$value0->Name;
		$data0_tmp['name'] = @(string)$value0->Name;
		$data0[] = @$data0_tmp;
	}
	return $data0;
    }
public function BatchGetItemFullInfo($sessionId, $itemId, $blockList){
$params = array(
'sessionId' => $sessionId,
'itemId' => $itemId,
'blockList' => $blockList
);
$params += $this->defaultLogin();
$simplexml = $this->_getData('BatchGetItemFullInfo', $params);
if (!$simplexml) return false;

$data0 = array();

if(!isset($data0)){$data0 = array();}
$data0_obj = @$simplexml->Result;
$data0['Item'] = $this->_parseItemInfo($data0_obj->Item);
if(!isset($data0['Vendor'])){$data0['Vendor'] = array();}
$data1_obj = @$simplexml->Result->Vendor;
if(!isset($data0['Vendor']['Id'])){$data0['Vendor']['Id'] = array();}
$data2_obj = @$simplexml->Result->Vendor->Id;
$data0['Vendor']['Id'] = @(string)$data2_obj;
$data0['Vendor']['id'] = @$data0['Vendor']['Id'];
if(!isset($data0['Vendor']['Name'])){$data0['Vendor']['Name'] = array();}
$data2_obj = @$simplexml->Result->Vendor->Name;
$data0['Vendor']['Name'] = @(string)$data2_obj;
$data0['Vendor']['name'] = @$data0['Vendor']['Name'];
if(!isset($data0['Vendor']['Sex'])){$data0['Vendor']['Sex'] = array();}
$data2_obj = @$simplexml->Result->Vendor->Sex;
$data0['Vendor']['Sex'] = @$data2_obj;
$data0['Vendor']['sex'] = @$data0['Vendor']['Sex'];
if(!isset($data0['Vendor']['Email'])){$data0['Vendor']['Email'] = array();}
$data2_obj = @$simplexml->Result->Vendor->Email;
$data0['Vendor']['Email'] = @(string)$data2_obj;
$data0['Vendor']['email'] = @$data0['Vendor']['Email'];
if(!isset($data0['Vendor']['PictureUrl'])){$data0['Vendor']['PictureUrl'] = array();}
$data2_obj = @$simplexml->Result->Vendor->PictureUrl;
$data0['Vendor']['PictureUrl'] = @(string)$data2_obj;
$data0['Vendor']['pictureurl'] = @$data0['Vendor']['PictureUrl'];
if(!isset($data0['Vendor']['Location'])){$data0['Vendor']['Location'] = array();}
$data2_obj = @$simplexml->Result->Vendor->Location;
if(!isset($data0['Vendor']['Location']['City'])){$data0['Vendor']['Location']['City'] = array();}
$data3_obj = @$simplexml->Result->Vendor->Location->City;
$data0['Vendor']['Location']['City'] = @(string)$data3_obj;
$data0['Vendor']['Location']['city'] = @$data0['Vendor']['Location']['City'];
if(!isset($data0['Vendor']['Location']['State'])){$data0['Vendor']['Location']['State'] = array();}
$data3_obj = @$simplexml->Result->Vendor->Location->State;
$data0['Vendor']['Location']['State'] = @(string)$data3_obj;
$data0['Vendor']['Location']['state'] = @$data0['Vendor']['Location']['State'];
if(!isset($data0['Vendor']['Location']['Country'])){$data0['Vendor']['Location']['Country'] = array();}
$data3_obj = @$simplexml->Result->Vendor->Location->Country;
$data0['Vendor']['Location']['Country'] = @(string)$data3_obj;
$data0['Vendor']['Location']['country'] = @$data0['Vendor']['Location']['Country'];
if(!isset($data0['Vendor']['Location']['District'])){$data0['Vendor']['Location']['District'] = array();}
$data3_obj = @$simplexml->Result->Vendor->Location->District;
$data0['Vendor']['Location']['District'] = @(string)$data3_obj;
$data0['Vendor']['Location']['district'] = @$data0['Vendor']['Location']['District'];
if(!isset($data0['Vendor']['Location']['Zip'])){$data0['Vendor']['Location']['Zip'] = array();}
$data3_obj = @$simplexml->Result->Vendor->Location->Zip;
$data0['Vendor']['Location']['Zip'] = @(string)$data3_obj;
$data0['Vendor']['Location']['zip'] = @$data0['Vendor']['Location']['Zip'];
if(!isset($data0['Vendor']['Location']['Address'])){$data0['Vendor']['Location']['Address'] = array();}
$data3_obj = @$simplexml->Result->Vendor->Location->Address;
$data0['Vendor']['Location']['Address'] = @(string)$data3_obj;
$data0['Vendor']['Location']['address'] = @$data0['Vendor']['Location']['Address'];
if(!isset($data0['Vendor']['Location']['AreaId'])){$data0['Vendor']['Location']['AreaId'] = array();}
$data3_obj = @$simplexml->Result->Vendor->Location->AreaId;
$data0['Vendor']['Location']['AreaId'] = @(string)$data3_obj;
$data0['Vendor']['Location']['areaid'] = @$data0['Vendor']['Location']['AreaId'];
$data0['Vendor']['location'] = @$data0['Vendor']['Location'];
if(!isset($data0['Vendor']['Credit'])){$data0['Vendor']['Credit'] = array();}
$data2_obj = @$simplexml->Result->Vendor->Credit;
if(!isset($data0['Vendor']['Credit']['Level'])){$data0['Vendor']['Credit']['Level'] = array();}
$data3_obj = @$simplexml->Result->Vendor->Credit->Level;
$data0['Vendor']['Credit']['Level'] = @$data3_obj;
$data0['Vendor']['Credit']['level'] = @$data0['Vendor']['Credit']['Level'];
if(!isset($data0['Vendor']['Credit']['Score'])){$data0['Vendor']['Credit']['Score'] = array();}
$data3_obj = @$simplexml->Result->Vendor->Credit->Score;
$data0['Vendor']['Credit']['Score'] = @$data3_obj;
$data0['Vendor']['Credit']['score'] = @$data0['Vendor']['Credit']['Score'];
if(!isset($data0['Vendor']['Credit']['TotalFeedbacks'])){$data0['Vendor']['Credit']['TotalFeedbacks'] = array();}
$data3_obj = @$simplexml->Result->Vendor->Credit->TotalFeedbacks;
$data0['Vendor']['Credit']['TotalFeedbacks'] = @$data3_obj;
$data0['Vendor']['Credit']['totalfeedbacks'] = @$data0['Vendor']['Credit']['TotalFeedbacks'];
if(!isset($data0['Vendor']['Credit']['PositiveFeedbacks'])){$data0['Vendor']['Credit']['PositiveFeedbacks'] = array();}
$data3_obj = @$simplexml->Result->Vendor->Credit->PositiveFeedbacks;
$data0['Vendor']['Credit']['PositiveFeedbacks'] = @$data3_obj;
$data0['Vendor']['Credit']['positivefeedbacks'] = @$data0['Vendor']['Credit']['PositiveFeedbacks'];
$data0['Vendor']['credit'] = @$data0['Vendor']['Credit'];
if(!isset($data0['Vendor']['Features'])){$data0['Vendor']['Features'] = array();}

if(!isset($simplexml->Result->Vendor->Features) || is_null($simplexml->Result->Vendor->Features) || !$simplexml->Result->Vendor->Features)			$data2_obj = @array();

else
$data2_obj = @$simplexml->Result->Vendor->Features->children();
$data0['Vendor']['Features'] = @array();
foreach($data2_obj as $value2){
$data0['Vendor']['Features'][] = @$value2;
}
$data0['Vendor']['features'] = @$data0['Vendor']['Features'];
$data0['vendor'] = @$data0['Vendor'];
if(!isset($data0['RootPath'])){$data0['RootPath'] = array();}

if(!isset($simplexml->Result->RootPath->Content) || is_null($simplexml->Result->RootPath->Content) || !$simplexml->Result->RootPath->Content)		$data1_obj = @array();

else
$data1_obj = @$simplexml->Result->RootPath->Content->children();
$data0['RootPath'] = @array();
foreach($data1_obj as $value1){
$data1_tmp = @array();
$data1_tmp['IsHidden'] = @$value1->IsHidden;
$data1_tmp['ishidden'] = @$value1->IsHidden;
$data1_tmp['IsVirtual'] = @$value1->IsVirtual;
$data1_tmp['isvirtual'] = @$value1->IsVirtual;
$data1_tmp['Id'] = @(string)$value1->Id;
$data1_tmp['id'] = @(string)$value1->Id;
$data1_tmp['ExternalId'] = @(string)$value1->ExternalId;
$data1_tmp['externalid'] = @(string)$value1->ExternalId;
$data1_tmp['Name'] = @(string)$value1->Name;
$data1_tmp['name'] = @(string)$value1->Name;
$data1_tmp['IsParent'] = @$value1->IsParent;
$data1_tmp['isparent'] = @$value1->IsParent;
$data1_tmp['ParentId'] = @(string)$value1->ParentId;
$data1_tmp['parentid'] = @(string)$value1->ParentId;
$data1_tmp['ApproxWeight'] = @$value1->ApproxWeight;
$data1_tmp['approxweight'] = @$value1->ApproxWeight;
if (isset($value1->RootPath)){ $data1_tmp['path'] = $this->_parseCategotyInfo($value1->RootPath->Content->children()); }			$data0['RootPath'][] = @$data1_tmp;
}
$data0['rootpath'] = @$data0['RootPath'];
if(!isset($simplexml->Result->VendorItems->Content) || is_null($simplexml->Result->VendorItems->Content) || !$simplexml->Result->VendorItems->Content)		$tmp_obj_1 = @array();

else
$tmp_obj_1 = $simplexml->Result->VendorItems->Content->children();
$data0['VendorItems'] = array('data' => array());
foreach ($tmp_obj_1 as $value)
{
$data0['VendorItems']['data'][] = $this->_parseItemInfo($value);
}
$data0['VendorItems']['totalcount'] = (string)$simplexml->Result->VendorItems->TotalCount;	return $data0;

}
    public function BatchSearchItemsFrame($sessionId, $xmlParameters, $framePosition = 0, $frameSize = 18, $blockList){
        $params = array(
            'sessionId' => $sessionId,
	    'xmlParameters' => $xmlParameters,
	    'framePosition' => $framePosition,
	    'frameSize' => $frameSize,
	    'blockList' => $blockList
        );
        $params += $this->defaultLogin();
        $simplexml = $this->_getData('BatchSearchItemsFrame', $params);
        if (!$simplexml) return false;
        
        $data0 = array();
        
if(!isset($data0)){$data0 = array();}
	$data0_obj = @$simplexml->Result;
if(!isset($data0['Items'])){$data0['Items'] = array();}
		$data1_obj = @$simplexml->Result->Items;
if(!isset($data0['Items']['Categories'])){$data0['Items']['Categories'] = array();}

	if(!isset($simplexml->Result->Items->Categories->Content) || is_null($simplexml->Result->Items->Categories->Content) || !$simplexml->Result->Items->Categories->Content)			$data2_obj = @array();

	else
			$data2_obj = @$simplexml->Result->Items->Categories->Content->children();
			$data0['Items']['Categories'] = @array();
			foreach($data2_obj as $value2){
				$data2_tmp = @array();
				$data2_tmp['Id'] = @(string)$value2->Id;
				$data2_tmp['id'] = @(string)$value2->Id;
				$data2_tmp['ExternalId'] = @(string)$value2->ExternalId;
				$data2_tmp['externalid'] = @(string)$value2->ExternalId;
				$data2_tmp['Name'] = @(string)$value2->Name;
				$data2_tmp['name'] = @(string)$value2->Name;
				$data2_tmp['ItemCount'] = @$value2->ItemCount;
				$data2_tmp['itemcount'] = @$value2->ItemCount;
				$data0['Items']['Categories'][] = @$data2_tmp;
			}
		$data0['Items']['categories'] = @$data0['Items']['Categories'];

        $tmp_obj_1 = $simplexml->Result->Items->Items->Content->children();
        $data0['Items']['Items'] = array('data' => array());
        foreach ($tmp_obj_1 as $value)
        {
            $data0['Items']['Items']['data'][] = $this->_parseItemInfo($value);
        }
        $data0['Items']['Items']['totalcount'] = (string)$simplexml->Result->Items->Items->TotalCount;	$data0['items'] = @$data0['Items'];
if(!isset($data0['SubCategories'])){$data0['SubCategories'] = array();}

	if(!isset($simplexml->Result->SubCategories->Content) || is_null($simplexml->Result->SubCategories->Content) || !$simplexml->Result->SubCategories->Content)		$data1_obj = @array();

	else
		$data1_obj = @$simplexml->Result->SubCategories->Content->children();
		$data0['SubCategories'] = @array();
		foreach($data1_obj as $value1){
			$data1_tmp = @array();
			$data1_tmp['IsHidden'] = @$value1->IsHidden;
			$data1_tmp['ishidden'] = @$value1->IsHidden;
			$data1_tmp['IsVirtual'] = @$value1->IsVirtual;
			$data1_tmp['isvirtual'] = @$value1->IsVirtual;
			$data1_tmp['Id'] = @(string)$value1->Id;
			$data1_tmp['id'] = @(string)$value1->Id;
			$data1_tmp['ExternalId'] = @(string)$value1->ExternalId;
			$data1_tmp['externalid'] = @(string)$value1->ExternalId;
			$data1_tmp['Name'] = @(string)$value1->Name;
			$data1_tmp['name'] = @(string)$value1->Name;
			$data1_tmp['IsParent'] = @$value1->IsParent;
			$data1_tmp['isparent'] = @$value1->IsParent;
			$data1_tmp['ParentId'] = @(string)$value1->ParentId;
			$data1_tmp['parentid'] = @(string)$value1->ParentId;
			$data1_tmp['ApproxWeight'] = @$value1->ApproxWeight;
			$data1_tmp['approxweight'] = @$value1->ApproxWeight;
if (isset($value1->RootPath)){ $data1_tmp['path'] = $this->_parseCategotyInfo($value1->RootPath->Content->children()); }			$data0['SubCategories'][] = @$data1_tmp;
		}
	$data0['subcategories'] = @$data0['SubCategories'];
if(!isset($data0['RootPath'])){$data0['RootPath'] = array();}

	if(!isset($simplexml->Result->RootPath->Content) || is_null($simplexml->Result->RootPath->Content) || !$simplexml->Result->RootPath->Content)		$data1_obj = @array();

	else
		$data1_obj = @$simplexml->Result->RootPath->Content->children();
		$data0['RootPath'] = @array();
		foreach($data1_obj as $value1){
			$data1_tmp = @array();
			$data1_tmp['IsHidden'] = @$value1->IsHidden;
			$data1_tmp['ishidden'] = @$value1->IsHidden;
			$data1_tmp['IsVirtual'] = @$value1->IsVirtual;
			$data1_tmp['isvirtual'] = @$value1->IsVirtual;
			$data1_tmp['Id'] = @(string)$value1->Id;
			$data1_tmp['id'] = @(string)$value1->Id;
			$data1_tmp['ExternalId'] = @(string)$value1->ExternalId;
			$data1_tmp['externalid'] = @(string)$value1->ExternalId;
			$data1_tmp['Name'] = @(string)$value1->Name;
			$data1_tmp['name'] = @(string)$value1->Name;
			$data1_tmp['IsParent'] = @$value1->IsParent;
			$data1_tmp['isparent'] = @$value1->IsParent;
			$data1_tmp['ParentId'] = @(string)$value1->ParentId;
			$data1_tmp['parentid'] = @(string)$value1->ParentId;
			$data1_tmp['ApproxWeight'] = @$value1->ApproxWeight;
			$data1_tmp['approxweight'] = @$value1->ApproxWeight;
if (isset($value1->RootPath)){ $data1_tmp['path'] = $this->_parseCategotyInfo($value1->RootPath->Content->children()); }			$data0['RootPath'][] = @$data1_tmp;
		}
	$data0['rootpath'] = @$data0['RootPath'];
if(!isset($data0['SearchProperties'])){$data0['SearchProperties'] = array();}

	if(!isset($simplexml->Result->SearchProperties->Content) || is_null($simplexml->Result->SearchProperties->Content) || !$simplexml->Result->SearchProperties->Content)		$data1_obj = @array();

	else
		$data1_obj = @$simplexml->Result->SearchProperties->Content->children();
		$data0['SearchProperties'] = @array();
		foreach($data1_obj as $value1){
			$data1_tmp = @array();
			$data1_tmp['Id'] = @(string)$value1->Id;
			$data1_tmp['id'] = @(string)$value1->Id;
			$data1_tmp['Name'] = @(string)$value1->Name;
			$data1_tmp['name'] = @(string)$value1->Name;
if(!isset($data1_tmp['Values'])){$data1_tmp['Values'] = array();}

	if(!isset($value1->Values) || is_null($value1->Values) || !$value1->Values)			$data2_obj = @array();

	else
			$data2_obj = @$value1->Values->children();
			$data1_tmp['Values'] = @array();
			foreach($data2_obj as $value2){
				$data2_tmp = @array();
				$data2_tmp['Id'] = @(string)$value2->Id;
				$data2_tmp['id'] = @(string)$value2->Id;
				$data2_tmp['Name'] = @(string)$value2->Name;
				$data2_tmp['name'] = @(string)$value2->Name;
				$data2_tmp['Alias'] = @(string)$value2->Alias;
				$data2_tmp['alias'] = @(string)$value2->Alias;
				$data1_tmp['Values'][] = @$data2_tmp;
			}
			$data0['SearchProperties'][] = @$data1_tmp;
		}
	$data0['searchproperties'] = @$data0['SearchProperties'];
if(!isset($data0['Vendor'])){$data0['Vendor'] = array();}
		$data1_obj = @$simplexml->Result->Vendor;
if(!isset($data0['Vendor']['Id'])){$data0['Vendor']['Id'] = array();}
			$data2_obj = @$simplexml->Result->Vendor->Id;
			$data0['Vendor']['Id'] = @(string)$data2_obj;
		$data0['Vendor']['id'] = @$data0['Vendor']['Id'];
if(!isset($data0['Vendor']['Name'])){$data0['Vendor']['Name'] = array();}
			$data2_obj = @$simplexml->Result->Vendor->Name;
			$data0['Vendor']['Name'] = @(string)$data2_obj;
		$data0['Vendor']['name'] = @$data0['Vendor']['Name'];
if(!isset($data0['Vendor']['Sex'])){$data0['Vendor']['Sex'] = array();}
			$data2_obj = @$simplexml->Result->Vendor->Sex;
			$data0['Vendor']['Sex'] = @$data2_obj;
		$data0['Vendor']['sex'] = @$data0['Vendor']['Sex'];
if(!isset($data0['Vendor']['Email'])){$data0['Vendor']['Email'] = array();}
			$data2_obj = @$simplexml->Result->Vendor->Email;
			$data0['Vendor']['Email'] = @(string)$data2_obj;
		$data0['Vendor']['email'] = @$data0['Vendor']['Email'];
if(!isset($data0['Vendor']['PictureUrl'])){$data0['Vendor']['PictureUrl'] = array();}
			$data2_obj = @$simplexml->Result->Vendor->PictureUrl;
			$data0['Vendor']['PictureUrl'] = @(string)$data2_obj;
		$data0['Vendor']['pictureurl'] = @$data0['Vendor']['PictureUrl'];
if(!isset($data0['Vendor']['Location'])){$data0['Vendor']['Location'] = array();}
			$data2_obj = @$simplexml->Result->Vendor->Location;
if(!isset($data0['Vendor']['Location']['City'])){$data0['Vendor']['Location']['City'] = array();}
				$data3_obj = @$simplexml->Result->Vendor->Location->City;
				$data0['Vendor']['Location']['City'] = @(string)$data3_obj;
			$data0['Vendor']['Location']['city'] = @$data0['Vendor']['Location']['City'];
if(!isset($data0['Vendor']['Location']['State'])){$data0['Vendor']['Location']['State'] = array();}
				$data3_obj = @$simplexml->Result->Vendor->Location->State;
				$data0['Vendor']['Location']['State'] = @(string)$data3_obj;
			$data0['Vendor']['Location']['state'] = @$data0['Vendor']['Location']['State'];
if(!isset($data0['Vendor']['Location']['Country'])){$data0['Vendor']['Location']['Country'] = array();}
				$data3_obj = @$simplexml->Result->Vendor->Location->Country;
				$data0['Vendor']['Location']['Country'] = @(string)$data3_obj;
			$data0['Vendor']['Location']['country'] = @$data0['Vendor']['Location']['Country'];
if(!isset($data0['Vendor']['Location']['District'])){$data0['Vendor']['Location']['District'] = array();}
				$data3_obj = @$simplexml->Result->Vendor->Location->District;
				$data0['Vendor']['Location']['District'] = @(string)$data3_obj;
			$data0['Vendor']['Location']['district'] = @$data0['Vendor']['Location']['District'];
if(!isset($data0['Vendor']['Location']['Zip'])){$data0['Vendor']['Location']['Zip'] = array();}
				$data3_obj = @$simplexml->Result->Vendor->Location->Zip;
				$data0['Vendor']['Location']['Zip'] = @(string)$data3_obj;
			$data0['Vendor']['Location']['zip'] = @$data0['Vendor']['Location']['Zip'];
if(!isset($data0['Vendor']['Location']['Address'])){$data0['Vendor']['Location']['Address'] = array();}
				$data3_obj = @$simplexml->Result->Vendor->Location->Address;
				$data0['Vendor']['Location']['Address'] = @(string)$data3_obj;
			$data0['Vendor']['Location']['address'] = @$data0['Vendor']['Location']['Address'];
if(!isset($data0['Vendor']['Location']['AreaId'])){$data0['Vendor']['Location']['AreaId'] = array();}
				$data3_obj = @$simplexml->Result->Vendor->Location->AreaId;
				$data0['Vendor']['Location']['AreaId'] = @(string)$data3_obj;
			$data0['Vendor']['Location']['areaid'] = @$data0['Vendor']['Location']['AreaId'];
		$data0['Vendor']['location'] = @$data0['Vendor']['Location'];
if(!isset($data0['Vendor']['Credit'])){$data0['Vendor']['Credit'] = array();}
			$data2_obj = @$simplexml->Result->Vendor->Credit;
if(!isset($data0['Vendor']['Credit']['Level'])){$data0['Vendor']['Credit']['Level'] = array();}
				$data3_obj = @$simplexml->Result->Vendor->Credit->Level;
				$data0['Vendor']['Credit']['Level'] = @$data3_obj;
			$data0['Vendor']['Credit']['level'] = @$data0['Vendor']['Credit']['Level'];
if(!isset($data0['Vendor']['Credit']['Score'])){$data0['Vendor']['Credit']['Score'] = array();}
				$data3_obj = @$simplexml->Result->Vendor->Credit->Score;
				$data0['Vendor']['Credit']['Score'] = @$data3_obj;
			$data0['Vendor']['Credit']['score'] = @$data0['Vendor']['Credit']['Score'];
if(!isset($data0['Vendor']['Credit']['TotalFeedbacks'])){$data0['Vendor']['Credit']['TotalFeedbacks'] = array();}
				$data3_obj = @$simplexml->Result->Vendor->Credit->TotalFeedbacks;
				$data0['Vendor']['Credit']['TotalFeedbacks'] = @$data3_obj;
			$data0['Vendor']['Credit']['totalfeedbacks'] = @$data0['Vendor']['Credit']['TotalFeedbacks'];
if(!isset($data0['Vendor']['Credit']['PositiveFeedbacks'])){$data0['Vendor']['Credit']['PositiveFeedbacks'] = array();}
				$data3_obj = @$simplexml->Result->Vendor->Credit->PositiveFeedbacks;
				$data0['Vendor']['Credit']['PositiveFeedbacks'] = @$data3_obj;
			$data0['Vendor']['Credit']['positivefeedbacks'] = @$data0['Vendor']['Credit']['PositiveFeedbacks'];
		$data0['Vendor']['credit'] = @$data0['Vendor']['Credit'];
if(!isset($data0['Vendor']['Features'])){$data0['Vendor']['Features'] = array();}

	if(!isset($simplexml->Result->Vendor->Features) || is_null($simplexml->Result->Vendor->Features) || !$simplexml->Result->Vendor->Features)			$data2_obj = @array();

	else
			$data2_obj = @$simplexml->Result->Vendor->Features->children();
			$data0['Vendor']['Features'] = @array();
			foreach($data2_obj as $value2){
				$data0['Vendor']['Features'][] = @$value2;
			}
		$data0['Vendor']['features'] = @$data0['Vendor']['Features'];
	$data0['vendor'] = @$data0['Vendor'];
if(!isset($data0['Brand'])){$data0['Brand'] = array();}
		$data1_obj = @$simplexml->Result->Brand;
if(!isset($data0['Brand']['Id'])){$data0['Brand']['Id'] = array();}
			$data2_obj = @$simplexml->Result->Brand->Id;
			$data0['Brand']['Id'] = @(string)$data2_obj;
		$data0['Brand']['id'] = @$data0['Brand']['Id'];
if(!isset($data0['Brand']['ExternalId'])){$data0['Brand']['ExternalId'] = array();}
			$data2_obj = @$simplexml->Result->Brand->ExternalId;
			$data0['Brand']['ExternalId'] = @(string)$data2_obj;
		$data0['Brand']['externalid'] = @$data0['Brand']['ExternalId'];
if(!isset($data0['Brand']['Name'])){$data0['Brand']['Name'] = array();}
			$data2_obj = @$simplexml->Result->Brand->Name;
			$data0['Brand']['Name'] = @(string)$data2_obj;
		$data0['Brand']['name'] = @$data0['Brand']['Name'];
if(!isset($data0['Brand']['Description'])){$data0['Brand']['Description'] = array();}
			$data2_obj = @$simplexml->Result->Brand->Description;
			$data0['Brand']['Description'] = @(string)$data2_obj;
		$data0['Brand']['description'] = @$data0['Brand']['Description'];
if(!isset($data0['Brand']['PictureUrl'])){$data0['Brand']['PictureUrl'] = array();}
			$data2_obj = @$simplexml->Result->Brand->PictureUrl;
			$data0['Brand']['PictureUrl'] = @(string)$data2_obj;
		$data0['Brand']['pictureurl'] = @$data0['Brand']['PictureUrl'];
if(!isset($data0['Brand']['IsHidden'])){$data0['Brand']['IsHidden'] = array();}
			$data2_obj = @$simplexml->Result->Brand->IsHidden;
			$data0['Brand']['IsHidden'] = @$data2_obj;
		$data0['Brand']['ishidden'] = @$data0['Brand']['IsHidden'];
if(!isset($data0['Brand']['IsNameSearch'])){$data0['Brand']['IsNameSearch'] = array();}
			$data2_obj = @$simplexml->Result->Brand->IsNameSearch;
			$data0['Brand']['IsNameSearch'] = @$data2_obj;
		$data0['Brand']['isnamesearch'] = @$data0['Brand']['IsNameSearch'];
	$data0['brand'] = @$data0['Brand'];
	return $data0;
    }
    public function BatchGetUserData($sessionId, $blockList){
        $params = array(
            'sessionId' => $sessionId,
	    'blockList' => $blockList
        );
        $params += $this->defaultLogin();
        $simplexml = $this->_getData('BatchGetUserData', $params);
        if (!$simplexml) return false;
        
        $data0 = array();
        
if(!isset($data0)){$data0 = array();}
	$data0_obj = @$simplexml->Result;
if(!isset($data0['Status'])){$data0['Status'] = array();}
		$data1_obj = @$simplexml->Result->Status;
if(!isset($data0['Status']['IsSessionExpired'])){$data0['Status']['IsSessionExpired'] = array();}
			$data2_obj = @$simplexml->Result->Status->IsSessionExpired;
			$data0['Status']['IsSessionExpired'] = @$data2_obj;
		$data0['Status']['issessionexpired'] = @$data0['Status']['IsSessionExpired'];
if(!isset($data0['Status']['Info'])){$data0['Status']['Info'] = array();}
			$data2_obj = @$simplexml->Result->Status->Info->Login;
			$data0['Status']['Info'] = @$data2_obj;
		$data0['Status']['info'] = @$data0['Status']['Info'];
	$data0['status'] = @$data0['Status'];
if(!isset($data0['Note'])){$data0['Note'] = array();}
		$data1_obj = @$simplexml->Result->Note;
if(!isset($data0['Note']['Elements'])){$data0['Note']['Elements'] = array();}

	if(!isset($simplexml->Result->Note->Elements) || is_null($simplexml->Result->Note->Elements) || !$simplexml->Result->Note->Elements)			$data2_obj = @array();

	else
			$data2_obj = @$simplexml->Result->Note->Elements->children();
			$data0['Note']['Elements'] = @array();
			foreach($data2_obj as $value2){
				$data2_tmp = @array();
				$data2_tmp['Id'] = @(int)$value2->Id;
				$data2_tmp['id'] = @(int)$value2->Id;
				$data2_tmp['ItemId'] = @(string)$value2->ItemId;
				$data2_tmp['itemid'] = @(string)$value2->ItemId;
				$data2_tmp['ConfigurationId'] = @(string)$value2->ConfigurationId;
				$data2_tmp['configurationid'] = @(string)$value2->ConfigurationId;
				$data2_tmp['Price'] = @$value2->Price;
				$data2_tmp['price'] = @$value2->Price;
				$data2_tmp['Quantity'] = @(int)$value2->Quantity;
				$data2_tmp['quantity'] = @(int)$value2->Quantity;
				$data2_tmp['TotalCost'] = @$value2->TotalCost;
				$data2_tmp['totalcost'] = @$value2->TotalCost;
if(!isset($data2_tmp['FullTotalCost'])){$data2_tmp['FullTotalCost'] = array();}
				$data3_obj = @$value2->FullTotalCost;
if(!isset($data2_tmp['FullTotalCost']['OriginalPrice'])){$data2_tmp['FullTotalCost']['OriginalPrice'] = array();}
					$data4_obj = @$value2->FullTotalCost->OriginalPrice;
					$data2_tmp['FullTotalCost']['OriginalPrice'] = @$data4_obj;
				$data2_tmp['FullTotalCost']['originalprice'] = @$data2_tmp['FullTotalCost']['OriginalPrice'];
if(!isset($data2_tmp['FullTotalCost']['MarginPrice'])){$data2_tmp['FullTotalCost']['MarginPrice'] = array();}
					$data4_obj = @$value2->FullTotalCost->MarginPrice;
					$data2_tmp['FullTotalCost']['MarginPrice'] = @$data4_obj;
				$data2_tmp['FullTotalCost']['marginprice'] = @$data2_tmp['FullTotalCost']['MarginPrice'];
if(!isset($data2_tmp['FullTotalCost']['OriginalCurrencyCode'])){$data2_tmp['FullTotalCost']['OriginalCurrencyCode'] = array();}
					$data4_obj = @$value2->FullTotalCost->OriginalCurrencyCode;
					$data2_tmp['FullTotalCost']['OriginalCurrencyCode'] = @(string)$data4_obj;
				$data2_tmp['FullTotalCost']['originalcurrencycode'] = @$data2_tmp['FullTotalCost']['OriginalCurrencyCode'];
if(!isset($data2_tmp['FullTotalCost']['ConvertedPriceList'])){$data2_tmp['FullTotalCost']['ConvertedPriceList'] = array();}
					$data4_obj = @$value2->FullTotalCost->ConvertedPriceList;
if(!isset($data2_tmp['FullTotalCost']['ConvertedPriceList']['Internal'])){$data2_tmp['FullTotalCost']['ConvertedPriceList']['Internal'] = array();}
						$data5_obj = @$value2->FullTotalCost->ConvertedPriceList->Internal;
						$data2_tmp['FullTotalCost']['ConvertedPriceList']['Internal'] = @$data5_obj;
					$data2_tmp['FullTotalCost']['ConvertedPriceList']['internal'] = @$data2_tmp['FullTotalCost']['ConvertedPriceList']['Internal'];
if(!isset($data2_tmp['FullTotalCost']['ConvertedPriceList']['DisplayedMoneys'])){$data2_tmp['FullTotalCost']['ConvertedPriceList']['DisplayedMoneys'] = array();}

	if(!isset($value2->FullTotalCost->ConvertedPriceList->DisplayedMoneys) || is_null($value2->FullTotalCost->ConvertedPriceList->DisplayedMoneys) || !$value2->FullTotalCost->ConvertedPriceList->DisplayedMoneys)						$data5_obj = @array();

	else
						$data5_obj = @$value2->FullTotalCost->ConvertedPriceList->DisplayedMoneys->children();
						$data2_tmp['FullTotalCost']['ConvertedPriceList']['DisplayedMoneys'] = @array();
						foreach($data5_obj as $value5){
							$data2_tmp['FullTotalCost']['ConvertedPriceList']['DisplayedMoneys'][] = @$value5;
						}
					$data2_tmp['FullTotalCost']['ConvertedPriceList']['displayedmoneys'] = @$data2_tmp['FullTotalCost']['ConvertedPriceList']['DisplayedMoneys'];
				$data2_tmp['FullTotalCost']['convertedpricelist'] = @$data2_tmp['FullTotalCost']['ConvertedPriceList'];
if(!isset($data2_tmp['FullPrice'])){$data2_tmp['FullPrice'] = array();}
				$data3_obj = @$value2->FullPrice;
if(!isset($data2_tmp['FullPrice']['OriginalPrice'])){$data2_tmp['FullPrice']['OriginalPrice'] = array();}
					$data4_obj = @$value2->FullPrice->OriginalPrice;
					$data2_tmp['FullPrice']['OriginalPrice'] = @$data4_obj;
				$data2_tmp['FullPrice']['originalprice'] = @$data2_tmp['FullPrice']['OriginalPrice'];
if(!isset($data2_tmp['FullPrice']['MarginPrice'])){$data2_tmp['FullPrice']['MarginPrice'] = array();}
					$data4_obj = @$value2->FullPrice->MarginPrice;
					$data2_tmp['FullPrice']['MarginPrice'] = @$data4_obj;
				$data2_tmp['FullPrice']['marginprice'] = @$data2_tmp['FullPrice']['MarginPrice'];
if(!isset($data2_tmp['FullPrice']['OriginalCurrencyCode'])){$data2_tmp['FullPrice']['OriginalCurrencyCode'] = array();}
					$data4_obj = @$value2->FullPrice->OriginalCurrencyCode;
					$data2_tmp['FullPrice']['OriginalCurrencyCode'] = @(string)$data4_obj;
				$data2_tmp['FullPrice']['originalcurrencycode'] = @$data2_tmp['FullPrice']['OriginalCurrencyCode'];
if(!isset($data2_tmp['FullPrice']['ConvertedPriceList'])){$data2_tmp['FullPrice']['ConvertedPriceList'] = array();}
					$data4_obj = @$value2->FullPrice->ConvertedPriceList;
if(!isset($data2_tmp['FullPrice']['ConvertedPriceList']['Internal'])){$data2_tmp['FullPrice']['ConvertedPriceList']['Internal'] = array();}
						$data5_obj = @$value2->FullPrice->ConvertedPriceList->Internal;
						$data2_tmp['FullPrice']['ConvertedPriceList']['Internal'] = @$data5_obj;
					$data2_tmp['FullPrice']['ConvertedPriceList']['internal'] = @$data2_tmp['FullPrice']['ConvertedPriceList']['Internal'];
if(!isset($data2_tmp['FullPrice']['ConvertedPriceList']['DisplayedMoneys'])){$data2_tmp['FullPrice']['ConvertedPriceList']['DisplayedMoneys'] = array();}

	if(!isset($value2->FullPrice->ConvertedPriceList->DisplayedMoneys) || is_null($value2->FullPrice->ConvertedPriceList->DisplayedMoneys) || !$value2->FullPrice->ConvertedPriceList->DisplayedMoneys)						$data5_obj = @array();

	else
						$data5_obj = @$value2->FullPrice->ConvertedPriceList->DisplayedMoneys->children();
						$data2_tmp['FullPrice']['ConvertedPriceList']['DisplayedMoneys'] = @array();
						foreach($data5_obj as $value5){
							$data2_tmp['FullPrice']['ConvertedPriceList']['DisplayedMoneys'][] = @$value5;
						}
					$data2_tmp['FullPrice']['ConvertedPriceList']['displayedmoneys'] = @$data2_tmp['FullPrice']['ConvertedPriceList']['DisplayedMoneys'];
				$data2_tmp['FullPrice']['convertedpricelist'] = @$data2_tmp['FullPrice']['ConvertedPriceList'];
if(!isset($data2_tmp['Fields'])){$data2_tmp['Fields'] = array();}

	if(!isset($value2->Fields) || is_null($value2->Fields) || !$value2->Fields)				$data3_obj = @array();

	else
				$data3_obj = @$value2->Fields->children();
				$data2_tmp['Fields'] = @array();
				foreach($data3_obj as $value3){
					$data3_tmp = @array();
					$data3_tmp['Name'] = @$value3['Name'];
					$data3_tmp['Value'] = @$value3['Value'];
					$data2_tmp['Fields'][] = @$data3_tmp;
				}
				$data2_tmp['CurrencySign'] = @(string)$value2->CurrencySign;
				$data2_tmp['currencysign'] = @(string)$value2->CurrencySign;
				$data2_tmp['CurrencyCode'] = @(string)$value2->CurrencyCode;
				$data2_tmp['currencycode'] = @(string)$value2->CurrencyCode;
				$data2_tmp['CategoryId'] = @(string)$value2->CategoryId;
				$data2_tmp['categoryid'] = @(string)$value2->CategoryId;
				$data2_tmp['VendorId'] = @(string)$value2->VendorId;
				$data2_tmp['vendorid'] = @(string)$value2->VendorId;
				$data2_tmp['CategoryName'] = @(string)$value2->CategoryName;
				$data2_tmp['categoryname'] = @(string)$value2->CategoryName;
				$data0['Note']['Elements'][] = @$data2_tmp;
			}
		$data0['Note']['elements'] = @$data0['Note']['Elements'];
if(!isset($data0['Note']['TotalCost'])){$data0['Note']['TotalCost'] = array();}
			$data2_obj = @$simplexml->Result->Note->TotalCost;
if(!isset($data0['Note']['TotalCost']['OriginalPrice'])){$data0['Note']['TotalCost']['OriginalPrice'] = array();}
				$data3_obj = @$simplexml->Result->Note->TotalCost->OriginalPrice;
				$data0['Note']['TotalCost']['OriginalPrice'] = @$data3_obj;
			$data0['Note']['TotalCost']['originalprice'] = @$data0['Note']['TotalCost']['OriginalPrice'];
if(!isset($data0['Note']['TotalCost']['MarginPrice'])){$data0['Note']['TotalCost']['MarginPrice'] = array();}
				$data3_obj = @$simplexml->Result->Note->TotalCost->MarginPrice;
				$data0['Note']['TotalCost']['MarginPrice'] = @$data3_obj;
			$data0['Note']['TotalCost']['marginprice'] = @$data0['Note']['TotalCost']['MarginPrice'];
if(!isset($data0['Note']['TotalCost']['OriginalCurrencyCode'])){$data0['Note']['TotalCost']['OriginalCurrencyCode'] = array();}
				$data3_obj = @$simplexml->Result->Note->TotalCost->OriginalCurrencyCode;
				$data0['Note']['TotalCost']['OriginalCurrencyCode'] = @(string)$data3_obj;
			$data0['Note']['TotalCost']['originalcurrencycode'] = @$data0['Note']['TotalCost']['OriginalCurrencyCode'];
if(!isset($data0['Note']['TotalCost']['ConvertedPriceList'])){$data0['Note']['TotalCost']['ConvertedPriceList'] = array();}
				$data3_obj = @$simplexml->Result->Note->TotalCost->ConvertedPriceList;
if(!isset($data0['Note']['TotalCost']['ConvertedPriceList']['Internal'])){$data0['Note']['TotalCost']['ConvertedPriceList']['Internal'] = array();}
					$data4_obj = @$simplexml->Result->Note->TotalCost->ConvertedPriceList->Internal;
					$data0['Note']['TotalCost']['ConvertedPriceList']['Internal'] = @$data4_obj;
				$data0['Note']['TotalCost']['ConvertedPriceList']['internal'] = @$data0['Note']['TotalCost']['ConvertedPriceList']['Internal'];
if(!isset($data0['Note']['TotalCost']['ConvertedPriceList']['DisplayedMoneys'])){$data0['Note']['TotalCost']['ConvertedPriceList']['DisplayedMoneys'] = array();}

	if(!isset($simplexml->Result->Note->TotalCost->ConvertedPriceList->DisplayedMoneys) || is_null($simplexml->Result->Note->TotalCost->ConvertedPriceList->DisplayedMoneys) || !$simplexml->Result->Note->TotalCost->ConvertedPriceList->DisplayedMoneys)					$data4_obj = @array();

	else
					$data4_obj = @$simplexml->Result->Note->TotalCost->ConvertedPriceList->DisplayedMoneys->children();
					$data0['Note']['TotalCost']['ConvertedPriceList']['DisplayedMoneys'] = @array();
					foreach($data4_obj as $value4){
						$data0['Note']['TotalCost']['ConvertedPriceList']['DisplayedMoneys'][] = @$value4;
					}
				$data0['Note']['TotalCost']['ConvertedPriceList']['displayedmoneys'] = @$data0['Note']['TotalCost']['ConvertedPriceList']['DisplayedMoneys'];
			$data0['Note']['TotalCost']['convertedpricelist'] = @$data0['Note']['TotalCost']['ConvertedPriceList'];
		$data0['Note']['totalcost'] = @$data0['Note']['TotalCost'];
if(!isset($data0['Note']['AdditionalPriceInfoList'])){$data0['Note']['AdditionalPriceInfoList'] = array();}

	if(!isset($simplexml->Result->Note->AdditionalPriceInfoList->Elements) || is_null($simplexml->Result->Note->AdditionalPriceInfoList->Elements) || !$simplexml->Result->Note->AdditionalPriceInfoList->Elements)			$data2_obj = @array();

	else
			$data2_obj = @$simplexml->Result->Note->AdditionalPriceInfoList->Elements->children();
			$data0['Note']['AdditionalPriceInfoList'] = @array();
			foreach($data2_obj as $value2){
				$data2_tmp = @array();
				$data2_tmp['Type'] = @$value2->Type;
				$data2_tmp['type'] = @$value2->Type;
				$data2_tmp['Name'] = @(string)$value2->Name;
				$data2_tmp['name'] = @(string)$value2->Name;
if(!isset($data2_tmp['Price'])){$data2_tmp['Price'] = array();}
				$data3_obj = @$value2->Price;
if(!isset($data2_tmp['Price']['OriginalPrice'])){$data2_tmp['Price']['OriginalPrice'] = array();}
					$data4_obj = @$value2->Price->OriginalPrice;
					$data2_tmp['Price']['OriginalPrice'] = @$data4_obj;
				$data2_tmp['Price']['originalprice'] = @$data2_tmp['Price']['OriginalPrice'];
if(!isset($data2_tmp['Price']['MarginPrice'])){$data2_tmp['Price']['MarginPrice'] = array();}
					$data4_obj = @$value2->Price->MarginPrice;
					$data2_tmp['Price']['MarginPrice'] = @$data4_obj;
				$data2_tmp['Price']['marginprice'] = @$data2_tmp['Price']['MarginPrice'];
if(!isset($data2_tmp['Price']['OriginalCurrencyCode'])){$data2_tmp['Price']['OriginalCurrencyCode'] = array();}
					$data4_obj = @$value2->Price->OriginalCurrencyCode;
					$data2_tmp['Price']['OriginalCurrencyCode'] = @(string)$data4_obj;
				$data2_tmp['Price']['originalcurrencycode'] = @$data2_tmp['Price']['OriginalCurrencyCode'];
if(!isset($data2_tmp['Price']['ConvertedPriceList'])){$data2_tmp['Price']['ConvertedPriceList'] = array();}
					$data4_obj = @$value2->Price->ConvertedPriceList;
if(!isset($data2_tmp['Price']['ConvertedPriceList']['Internal'])){$data2_tmp['Price']['ConvertedPriceList']['Internal'] = array();}
						$data5_obj = @$value2->Price->ConvertedPriceList->Internal;
						$data2_tmp['Price']['ConvertedPriceList']['Internal'] = @$data5_obj;
					$data2_tmp['Price']['ConvertedPriceList']['internal'] = @$data2_tmp['Price']['ConvertedPriceList']['Internal'];
if(!isset($data2_tmp['Price']['ConvertedPriceList']['DisplayedMoneys'])){$data2_tmp['Price']['ConvertedPriceList']['DisplayedMoneys'] = array();}

	if(!isset($value2->Price->ConvertedPriceList->DisplayedMoneys) || is_null($value2->Price->ConvertedPriceList->DisplayedMoneys) || !$value2->Price->ConvertedPriceList->DisplayedMoneys)						$data5_obj = @array();

	else
						$data5_obj = @$value2->Price->ConvertedPriceList->DisplayedMoneys->children();
						$data2_tmp['Price']['ConvertedPriceList']['DisplayedMoneys'] = @array();
						foreach($data5_obj as $value5){
							$data2_tmp['Price']['ConvertedPriceList']['DisplayedMoneys'][] = @$value5;
						}
					$data2_tmp['Price']['ConvertedPriceList']['displayedmoneys'] = @$data2_tmp['Price']['ConvertedPriceList']['DisplayedMoneys'];
				$data2_tmp['Price']['convertedpricelist'] = @$data2_tmp['Price']['ConvertedPriceList'];
				$data0['Note']['AdditionalPriceInfoList'][] = @$data2_tmp;
			}
		$data0['Note']['additionalpriceinfolist'] = @$data0['Note']['AdditionalPriceInfoList'];
	$data0['note'] = @$data0['Note'];
if(!isset($data0['NoteSummary'])){$data0['NoteSummary'] = array();}
		$data1_obj = @$simplexml->Result->NoteSummary;
if(!isset($data0['NoteSummary']['TotalCount'])){$data0['NoteSummary']['TotalCount'] = array();}
			$data2_obj = @$simplexml->Result->NoteSummary->TotalCount;
			$data0['NoteSummary']['TotalCount'] = @$data2_obj;
		$data0['NoteSummary']['totalcount'] = @$data0['NoteSummary']['TotalCount'];
if(!isset($data0['NoteSummary']['TotalPrice'])){$data0['NoteSummary']['TotalPrice'] = array();}
			$data2_obj = @$simplexml->Result->NoteSummary->TotalPrice;
if(!isset($data0['NoteSummary']['TotalPrice']['OriginalPrice'])){$data0['NoteSummary']['TotalPrice']['OriginalPrice'] = array();}
				$data3_obj = @$simplexml->Result->NoteSummary->TotalPrice->OriginalPrice;
				$data0['NoteSummary']['TotalPrice']['OriginalPrice'] = @$data3_obj;
			$data0['NoteSummary']['TotalPrice']['originalprice'] = @$data0['NoteSummary']['TotalPrice']['OriginalPrice'];
if(!isset($data0['NoteSummary']['TotalPrice']['MarginPrice'])){$data0['NoteSummary']['TotalPrice']['MarginPrice'] = array();}
				$data3_obj = @$simplexml->Result->NoteSummary->TotalPrice->MarginPrice;
				$data0['NoteSummary']['TotalPrice']['MarginPrice'] = @$data3_obj;
			$data0['NoteSummary']['TotalPrice']['marginprice'] = @$data0['NoteSummary']['TotalPrice']['MarginPrice'];
if(!isset($data0['NoteSummary']['TotalPrice']['OriginalCurrencyCode'])){$data0['NoteSummary']['TotalPrice']['OriginalCurrencyCode'] = array();}
				$data3_obj = @$simplexml->Result->NoteSummary->TotalPrice->OriginalCurrencyCode;
				$data0['NoteSummary']['TotalPrice']['OriginalCurrencyCode'] = @(string)$data3_obj;
			$data0['NoteSummary']['TotalPrice']['originalcurrencycode'] = @$data0['NoteSummary']['TotalPrice']['OriginalCurrencyCode'];
if(!isset($data0['NoteSummary']['TotalPrice']['ConvertedPriceList'])){$data0['NoteSummary']['TotalPrice']['ConvertedPriceList'] = array();}
				$data3_obj = @$simplexml->Result->NoteSummary->TotalPrice->ConvertedPriceList;
if(!isset($data0['NoteSummary']['TotalPrice']['ConvertedPriceList']['Internal'])){$data0['NoteSummary']['TotalPrice']['ConvertedPriceList']['Internal'] = array();}
					$data4_obj = @$simplexml->Result->NoteSummary->TotalPrice->ConvertedPriceList->Internal;
					$data0['NoteSummary']['TotalPrice']['ConvertedPriceList']['Internal'] = @$data4_obj;
				$data0['NoteSummary']['TotalPrice']['ConvertedPriceList']['internal'] = @$data0['NoteSummary']['TotalPrice']['ConvertedPriceList']['Internal'];
if(!isset($data0['NoteSummary']['TotalPrice']['ConvertedPriceList']['DisplayedMoneys'])){$data0['NoteSummary']['TotalPrice']['ConvertedPriceList']['DisplayedMoneys'] = array();}

	if(!isset($simplexml->Result->NoteSummary->TotalPrice->ConvertedPriceList->DisplayedMoneys) || is_null($simplexml->Result->NoteSummary->TotalPrice->ConvertedPriceList->DisplayedMoneys) || !$simplexml->Result->NoteSummary->TotalPrice->ConvertedPriceList->DisplayedMoneys)					$data4_obj = @array();

	else
					$data4_obj = @$simplexml->Result->NoteSummary->TotalPrice->ConvertedPriceList->DisplayedMoneys->children();
					$data0['NoteSummary']['TotalPrice']['ConvertedPriceList']['DisplayedMoneys'] = @array();
					foreach($data4_obj as $value4){
						$data0['NoteSummary']['TotalPrice']['ConvertedPriceList']['DisplayedMoneys'][] = @$value4;
					}
				$data0['NoteSummary']['TotalPrice']['ConvertedPriceList']['displayedmoneys'] = @$data0['NoteSummary']['TotalPrice']['ConvertedPriceList']['DisplayedMoneys'];
			$data0['NoteSummary']['TotalPrice']['convertedpricelist'] = @$data0['NoteSummary']['TotalPrice']['ConvertedPriceList'];
		$data0['NoteSummary']['totalprice'] = @$data0['NoteSummary']['TotalPrice'];
	$data0['notesummary'] = @$data0['NoteSummary'];
if(!isset($data0['Basket'])){$data0['Basket'] = array();}
		$data1_obj = @$simplexml->Result->Basket;
if(!isset($data0['Basket']['Elements'])){$data0['Basket']['Elements'] = array();}

	if(!isset($simplexml->Result->Basket->Elements) || is_null($simplexml->Result->Basket->Elements) || !$simplexml->Result->Basket->Elements)			$data2_obj = @array();

	else
			$data2_obj = @$simplexml->Result->Basket->Elements->children();
			$data0['Basket']['Elements'] = @array();
			foreach($data2_obj as $value2){
				$data2_tmp = @array();
				$data2_tmp['Id'] = @(int)$value2->Id;
				$data2_tmp['id'] = @(int)$value2->Id;
				$data2_tmp['ItemId'] = @(string)$value2->ItemId;
				$data2_tmp['itemid'] = @(string)$value2->ItemId;
				$data2_tmp['ConfigurationId'] = @(string)$value2->ConfigurationId;
				$data2_tmp['configurationid'] = @(string)$value2->ConfigurationId;
				$data2_tmp['Price'] = @$value2->Price;
				$data2_tmp['price'] = @$value2->Price;
				$data2_tmp['Quantity'] = @(int)$value2->Quantity;
				$data2_tmp['quantity'] = @(int)$value2->Quantity;
				$data2_tmp['TotalCost'] = @$value2->TotalCost;
				$data2_tmp['totalcost'] = @$value2->TotalCost;
if(!isset($data2_tmp['FullTotalCost'])){$data2_tmp['FullTotalCost'] = array();}
				$data3_obj = @$value2->FullTotalCost;
if(!isset($data2_tmp['FullTotalCost']['OriginalPrice'])){$data2_tmp['FullTotalCost']['OriginalPrice'] = array();}
					$data4_obj = @$value2->FullTotalCost->OriginalPrice;
					$data2_tmp['FullTotalCost']['OriginalPrice'] = @$data4_obj;
				$data2_tmp['FullTotalCost']['originalprice'] = @$data2_tmp['FullTotalCost']['OriginalPrice'];
if(!isset($data2_tmp['FullTotalCost']['MarginPrice'])){$data2_tmp['FullTotalCost']['MarginPrice'] = array();}
					$data4_obj = @$value2->FullTotalCost->MarginPrice;
					$data2_tmp['FullTotalCost']['MarginPrice'] = @$data4_obj;
				$data2_tmp['FullTotalCost']['marginprice'] = @$data2_tmp['FullTotalCost']['MarginPrice'];
if(!isset($data2_tmp['FullTotalCost']['OriginalCurrencyCode'])){$data2_tmp['FullTotalCost']['OriginalCurrencyCode'] = array();}
					$data4_obj = @$value2->FullTotalCost->OriginalCurrencyCode;
					$data2_tmp['FullTotalCost']['OriginalCurrencyCode'] = @(string)$data4_obj;
				$data2_tmp['FullTotalCost']['originalcurrencycode'] = @$data2_tmp['FullTotalCost']['OriginalCurrencyCode'];
if(!isset($data2_tmp['FullTotalCost']['ConvertedPriceList'])){$data2_tmp['FullTotalCost']['ConvertedPriceList'] = array();}
					$data4_obj = @$value2->FullTotalCost->ConvertedPriceList;
if(!isset($data2_tmp['FullTotalCost']['ConvertedPriceList']['Internal'])){$data2_tmp['FullTotalCost']['ConvertedPriceList']['Internal'] = array();}
						$data5_obj = @$value2->FullTotalCost->ConvertedPriceList->Internal;
						$data2_tmp['FullTotalCost']['ConvertedPriceList']['Internal'] = @$data5_obj;
					$data2_tmp['FullTotalCost']['ConvertedPriceList']['internal'] = @$data2_tmp['FullTotalCost']['ConvertedPriceList']['Internal'];
if(!isset($data2_tmp['FullTotalCost']['ConvertedPriceList']['DisplayedMoneys'])){$data2_tmp['FullTotalCost']['ConvertedPriceList']['DisplayedMoneys'] = array();}

	if(!isset($value2->FullTotalCost->ConvertedPriceList->DisplayedMoneys) || is_null($value2->FullTotalCost->ConvertedPriceList->DisplayedMoneys) || !$value2->FullTotalCost->ConvertedPriceList->DisplayedMoneys)						$data5_obj = @array();

	else
						$data5_obj = @$value2->FullTotalCost->ConvertedPriceList->DisplayedMoneys->children();
						$data2_tmp['FullTotalCost']['ConvertedPriceList']['DisplayedMoneys'] = @array();
						foreach($data5_obj as $value5){
							$data2_tmp['FullTotalCost']['ConvertedPriceList']['DisplayedMoneys'][] = @$value5;
						}
					$data2_tmp['FullTotalCost']['ConvertedPriceList']['displayedmoneys'] = @$data2_tmp['FullTotalCost']['ConvertedPriceList']['DisplayedMoneys'];
				$data2_tmp['FullTotalCost']['convertedpricelist'] = @$data2_tmp['FullTotalCost']['ConvertedPriceList'];
if(!isset($data2_tmp['FullPrice'])){$data2_tmp['FullPrice'] = array();}
				$data3_obj = @$value2->FullPrice;
if(!isset($data2_tmp['FullPrice']['OriginalPrice'])){$data2_tmp['FullPrice']['OriginalPrice'] = array();}
					$data4_obj = @$value2->FullPrice->OriginalPrice;
					$data2_tmp['FullPrice']['OriginalPrice'] = @$data4_obj;
				$data2_tmp['FullPrice']['originalprice'] = @$data2_tmp['FullPrice']['OriginalPrice'];
if(!isset($data2_tmp['FullPrice']['MarginPrice'])){$data2_tmp['FullPrice']['MarginPrice'] = array();}
					$data4_obj = @$value2->FullPrice->MarginPrice;
					$data2_tmp['FullPrice']['MarginPrice'] = @$data4_obj;
				$data2_tmp['FullPrice']['marginprice'] = @$data2_tmp['FullPrice']['MarginPrice'];
if(!isset($data2_tmp['FullPrice']['OriginalCurrencyCode'])){$data2_tmp['FullPrice']['OriginalCurrencyCode'] = array();}
					$data4_obj = @$value2->FullPrice->OriginalCurrencyCode;
					$data2_tmp['FullPrice']['OriginalCurrencyCode'] = @(string)$data4_obj;
				$data2_tmp['FullPrice']['originalcurrencycode'] = @$data2_tmp['FullPrice']['OriginalCurrencyCode'];
if(!isset($data2_tmp['FullPrice']['ConvertedPriceList'])){$data2_tmp['FullPrice']['ConvertedPriceList'] = array();}
					$data4_obj = @$value2->FullPrice->ConvertedPriceList;
if(!isset($data2_tmp['FullPrice']['ConvertedPriceList']['Internal'])){$data2_tmp['FullPrice']['ConvertedPriceList']['Internal'] = array();}
						$data5_obj = @$value2->FullPrice->ConvertedPriceList->Internal;
						$data2_tmp['FullPrice']['ConvertedPriceList']['Internal'] = @$data5_obj;
					$data2_tmp['FullPrice']['ConvertedPriceList']['internal'] = @$data2_tmp['FullPrice']['ConvertedPriceList']['Internal'];
if(!isset($data2_tmp['FullPrice']['ConvertedPriceList']['DisplayedMoneys'])){$data2_tmp['FullPrice']['ConvertedPriceList']['DisplayedMoneys'] = array();}

	if(!isset($value2->FullPrice->ConvertedPriceList->DisplayedMoneys) || is_null($value2->FullPrice->ConvertedPriceList->DisplayedMoneys) || !$value2->FullPrice->ConvertedPriceList->DisplayedMoneys)						$data5_obj = @array();

	else
						$data5_obj = @$value2->FullPrice->ConvertedPriceList->DisplayedMoneys->children();
						$data2_tmp['FullPrice']['ConvertedPriceList']['DisplayedMoneys'] = @array();
						foreach($data5_obj as $value5){
							$data2_tmp['FullPrice']['ConvertedPriceList']['DisplayedMoneys'][] = @$value5;
						}
					$data2_tmp['FullPrice']['ConvertedPriceList']['displayedmoneys'] = @$data2_tmp['FullPrice']['ConvertedPriceList']['DisplayedMoneys'];
				$data2_tmp['FullPrice']['convertedpricelist'] = @$data2_tmp['FullPrice']['ConvertedPriceList'];
if(!isset($data2_tmp['Fields'])){$data2_tmp['Fields'] = array();}

	if(!isset($value2->Fields) || is_null($value2->Fields) || !$value2->Fields)				$data3_obj = @array();

	else
				$data3_obj = @$value2->Fields->children();
				$data2_tmp['Fields'] = @array();
				foreach($data3_obj as $value3){
					$data3_tmp = @array();
					$data3_tmp['Name'] = @$value3['Name'];
					$data3_tmp['Value'] = @$value3['Value'];
					$data2_tmp['Fields'][] = @$data3_tmp;
				}
				$data2_tmp['CurrencySign'] = @(string)$value2->CurrencySign;
				$data2_tmp['currencysign'] = @(string)$value2->CurrencySign;
				$data2_tmp['CurrencyCode'] = @(string)$value2->CurrencyCode;
				$data2_tmp['currencycode'] = @(string)$value2->CurrencyCode;
				$data2_tmp['CategoryId'] = @(string)$value2->CategoryId;
				$data2_tmp['categoryid'] = @(string)$value2->CategoryId;
				$data2_tmp['VendorId'] = @(string)$value2->VendorId;
				$data2_tmp['vendorid'] = @(string)$value2->VendorId;
				$data2_tmp['CategoryName'] = @(string)$value2->CategoryName;
				$data2_tmp['categoryname'] = @(string)$value2->CategoryName;
				$data0['Basket']['Elements'][] = @$data2_tmp;
			}
		$data0['Basket']['elements'] = @$data0['Basket']['Elements'];
if(!isset($data0['Basket']['TotalCost'])){$data0['Basket']['TotalCost'] = array();}
			$data2_obj = @$simplexml->Result->Basket->TotalCost;
if(!isset($data0['Basket']['TotalCost']['OriginalPrice'])){$data0['Basket']['TotalCost']['OriginalPrice'] = array();}
				$data3_obj = @$simplexml->Result->Basket->TotalCost->OriginalPrice;
				$data0['Basket']['TotalCost']['OriginalPrice'] = @$data3_obj;
			$data0['Basket']['TotalCost']['originalprice'] = @$data0['Basket']['TotalCost']['OriginalPrice'];
if(!isset($data0['Basket']['TotalCost']['MarginPrice'])){$data0['Basket']['TotalCost']['MarginPrice'] = array();}
				$data3_obj = @$simplexml->Result->Basket->TotalCost->MarginPrice;
				$data0['Basket']['TotalCost']['MarginPrice'] = @$data3_obj;
			$data0['Basket']['TotalCost']['marginprice'] = @$data0['Basket']['TotalCost']['MarginPrice'];
if(!isset($data0['Basket']['TotalCost']['OriginalCurrencyCode'])){$data0['Basket']['TotalCost']['OriginalCurrencyCode'] = array();}
				$data3_obj = @$simplexml->Result->Basket->TotalCost->OriginalCurrencyCode;
				$data0['Basket']['TotalCost']['OriginalCurrencyCode'] = @(string)$data3_obj;
			$data0['Basket']['TotalCost']['originalcurrencycode'] = @$data0['Basket']['TotalCost']['OriginalCurrencyCode'];
if(!isset($data0['Basket']['TotalCost']['ConvertedPriceList'])){$data0['Basket']['TotalCost']['ConvertedPriceList'] = array();}
				$data3_obj = @$simplexml->Result->Basket->TotalCost->ConvertedPriceList;
if(!isset($data0['Basket']['TotalCost']['ConvertedPriceList']['Internal'])){$data0['Basket']['TotalCost']['ConvertedPriceList']['Internal'] = array();}
					$data4_obj = @$simplexml->Result->Basket->TotalCost->ConvertedPriceList->Internal;
					$data0['Basket']['TotalCost']['ConvertedPriceList']['Internal'] = @$data4_obj;
				$data0['Basket']['TotalCost']['ConvertedPriceList']['internal'] = @$data0['Basket']['TotalCost']['ConvertedPriceList']['Internal'];
if(!isset($data0['Basket']['TotalCost']['ConvertedPriceList']['DisplayedMoneys'])){$data0['Basket']['TotalCost']['ConvertedPriceList']['DisplayedMoneys'] = array();}

	if(!isset($simplexml->Result->Basket->TotalCost->ConvertedPriceList->DisplayedMoneys) || is_null($simplexml->Result->Basket->TotalCost->ConvertedPriceList->DisplayedMoneys) || !$simplexml->Result->Basket->TotalCost->ConvertedPriceList->DisplayedMoneys)					$data4_obj = @array();

	else
					$data4_obj = @$simplexml->Result->Basket->TotalCost->ConvertedPriceList->DisplayedMoneys->children();
					$data0['Basket']['TotalCost']['ConvertedPriceList']['DisplayedMoneys'] = @array();
					foreach($data4_obj as $value4){
						$data0['Basket']['TotalCost']['ConvertedPriceList']['DisplayedMoneys'][] = @$value4;
					}
				$data0['Basket']['TotalCost']['ConvertedPriceList']['displayedmoneys'] = @$data0['Basket']['TotalCost']['ConvertedPriceList']['DisplayedMoneys'];
			$data0['Basket']['TotalCost']['convertedpricelist'] = @$data0['Basket']['TotalCost']['ConvertedPriceList'];
		$data0['Basket']['totalcost'] = @$data0['Basket']['TotalCost'];
if(!isset($data0['Basket']['AdditionalPriceInfoList'])){$data0['Basket']['AdditionalPriceInfoList'] = array();}

	if(!isset($simplexml->Result->Basket->AdditionalPriceInfoList->Elements) || is_null($simplexml->Result->Basket->AdditionalPriceInfoList->Elements) || !$simplexml->Result->Basket->AdditionalPriceInfoList->Elements)			$data2_obj = @array();

	else
			$data2_obj = @$simplexml->Result->Basket->AdditionalPriceInfoList->Elements->children();
			$data0['Basket']['AdditionalPriceInfoList'] = @array();
			foreach($data2_obj as $value2){
				$data2_tmp = @array();
				$data2_tmp['Type'] = @$value2->Type;
				$data2_tmp['type'] = @$value2->Type;
				$data2_tmp['Name'] = @(string)$value2->Name;
				$data2_tmp['name'] = @(string)$value2->Name;
if(!isset($data2_tmp['Price'])){$data2_tmp['Price'] = array();}
				$data3_obj = @$value2->Price;
if(!isset($data2_tmp['Price']['OriginalPrice'])){$data2_tmp['Price']['OriginalPrice'] = array();}
					$data4_obj = @$value2->Price->OriginalPrice;
					$data2_tmp['Price']['OriginalPrice'] = @$data4_obj;
				$data2_tmp['Price']['originalprice'] = @$data2_tmp['Price']['OriginalPrice'];
if(!isset($data2_tmp['Price']['MarginPrice'])){$data2_tmp['Price']['MarginPrice'] = array();}
					$data4_obj = @$value2->Price->MarginPrice;
					$data2_tmp['Price']['MarginPrice'] = @$data4_obj;
				$data2_tmp['Price']['marginprice'] = @$data2_tmp['Price']['MarginPrice'];
if(!isset($data2_tmp['Price']['OriginalCurrencyCode'])){$data2_tmp['Price']['OriginalCurrencyCode'] = array();}
					$data4_obj = @$value2->Price->OriginalCurrencyCode;
					$data2_tmp['Price']['OriginalCurrencyCode'] = @(string)$data4_obj;
				$data2_tmp['Price']['originalcurrencycode'] = @$data2_tmp['Price']['OriginalCurrencyCode'];
if(!isset($data2_tmp['Price']['ConvertedPriceList'])){$data2_tmp['Price']['ConvertedPriceList'] = array();}
					$data4_obj = @$value2->Price->ConvertedPriceList;
if(!isset($data2_tmp['Price']['ConvertedPriceList']['Internal'])){$data2_tmp['Price']['ConvertedPriceList']['Internal'] = array();}
						$data5_obj = @$value2->Price->ConvertedPriceList->Internal;
						$data2_tmp['Price']['ConvertedPriceList']['Internal'] = @$data5_obj;
					$data2_tmp['Price']['ConvertedPriceList']['internal'] = @$data2_tmp['Price']['ConvertedPriceList']['Internal'];
if(!isset($data2_tmp['Price']['ConvertedPriceList']['DisplayedMoneys'])){$data2_tmp['Price']['ConvertedPriceList']['DisplayedMoneys'] = array();}

	if(!isset($value2->Price->ConvertedPriceList->DisplayedMoneys) || is_null($value2->Price->ConvertedPriceList->DisplayedMoneys) || !$value2->Price->ConvertedPriceList->DisplayedMoneys)						$data5_obj = @array();

	else
						$data5_obj = @$value2->Price->ConvertedPriceList->DisplayedMoneys->children();
						$data2_tmp['Price']['ConvertedPriceList']['DisplayedMoneys'] = @array();
						foreach($data5_obj as $value5){
							$data2_tmp['Price']['ConvertedPriceList']['DisplayedMoneys'][] = @$value5;
						}
					$data2_tmp['Price']['ConvertedPriceList']['displayedmoneys'] = @$data2_tmp['Price']['ConvertedPriceList']['DisplayedMoneys'];
				$data2_tmp['Price']['convertedpricelist'] = @$data2_tmp['Price']['ConvertedPriceList'];
				$data0['Basket']['AdditionalPriceInfoList'][] = @$data2_tmp;
			}
		$data0['Basket']['additionalpriceinfolist'] = @$data0['Basket']['AdditionalPriceInfoList'];
	$data0['basket'] = @$data0['Basket'];
if(!isset($data0['BasketSummary'])){$data0['BasketSummary'] = array();}
		$data1_obj = @$simplexml->Result->BasketSummary;
if(!isset($data0['BasketSummary']['TotalCount'])){$data0['BasketSummary']['TotalCount'] = array();}
			$data2_obj = @$simplexml->Result->BasketSummary->TotalCount;
			$data0['BasketSummary']['TotalCount'] = @$data2_obj;
		$data0['BasketSummary']['totalcount'] = @$data0['BasketSummary']['TotalCount'];
if(!isset($data0['BasketSummary']['TotalPrice'])){$data0['BasketSummary']['TotalPrice'] = array();}
			$data2_obj = @$simplexml->Result->BasketSummary->TotalPrice;
if(!isset($data0['BasketSummary']['TotalPrice']['OriginalPrice'])){$data0['BasketSummary']['TotalPrice']['OriginalPrice'] = array();}
				$data3_obj = @$simplexml->Result->BasketSummary->TotalPrice->OriginalPrice;
				$data0['BasketSummary']['TotalPrice']['OriginalPrice'] = @$data3_obj;
			$data0['BasketSummary']['TotalPrice']['originalprice'] = @$data0['BasketSummary']['TotalPrice']['OriginalPrice'];
if(!isset($data0['BasketSummary']['TotalPrice']['MarginPrice'])){$data0['BasketSummary']['TotalPrice']['MarginPrice'] = array();}
				$data3_obj = @$simplexml->Result->BasketSummary->TotalPrice->MarginPrice;
				$data0['BasketSummary']['TotalPrice']['MarginPrice'] = @$data3_obj;
			$data0['BasketSummary']['TotalPrice']['marginprice'] = @$data0['BasketSummary']['TotalPrice']['MarginPrice'];
if(!isset($data0['BasketSummary']['TotalPrice']['OriginalCurrencyCode'])){$data0['BasketSummary']['TotalPrice']['OriginalCurrencyCode'] = array();}
				$data3_obj = @$simplexml->Result->BasketSummary->TotalPrice->OriginalCurrencyCode;
				$data0['BasketSummary']['TotalPrice']['OriginalCurrencyCode'] = @(string)$data3_obj;
			$data0['BasketSummary']['TotalPrice']['originalcurrencycode'] = @$data0['BasketSummary']['TotalPrice']['OriginalCurrencyCode'];
if(!isset($data0['BasketSummary']['TotalPrice']['ConvertedPriceList'])){$data0['BasketSummary']['TotalPrice']['ConvertedPriceList'] = array();}
				$data3_obj = @$simplexml->Result->BasketSummary->TotalPrice->ConvertedPriceList;
if(!isset($data0['BasketSummary']['TotalPrice']['ConvertedPriceList']['Internal'])){$data0['BasketSummary']['TotalPrice']['ConvertedPriceList']['Internal'] = array();}
					$data4_obj = @$simplexml->Result->BasketSummary->TotalPrice->ConvertedPriceList->Internal;
					$data0['BasketSummary']['TotalPrice']['ConvertedPriceList']['Internal'] = @$data4_obj;
				$data0['BasketSummary']['TotalPrice']['ConvertedPriceList']['internal'] = @$data0['BasketSummary']['TotalPrice']['ConvertedPriceList']['Internal'];
if(!isset($data0['BasketSummary']['TotalPrice']['ConvertedPriceList']['DisplayedMoneys'])){$data0['BasketSummary']['TotalPrice']['ConvertedPriceList']['DisplayedMoneys'] = array();}

	if(!isset($simplexml->Result->BasketSummary->TotalPrice->ConvertedPriceList->DisplayedMoneys) || is_null($simplexml->Result->BasketSummary->TotalPrice->ConvertedPriceList->DisplayedMoneys) || !$simplexml->Result->BasketSummary->TotalPrice->ConvertedPriceList->DisplayedMoneys)					$data4_obj = @array();

	else
					$data4_obj = @$simplexml->Result->BasketSummary->TotalPrice->ConvertedPriceList->DisplayedMoneys->children();
					$data0['BasketSummary']['TotalPrice']['ConvertedPriceList']['DisplayedMoneys'] = @array();
					foreach($data4_obj as $value4){
						$data0['BasketSummary']['TotalPrice']['ConvertedPriceList']['DisplayedMoneys'][] = @$value4;
					}
				$data0['BasketSummary']['TotalPrice']['ConvertedPriceList']['displayedmoneys'] = @$data0['BasketSummary']['TotalPrice']['ConvertedPriceList']['DisplayedMoneys'];
			$data0['BasketSummary']['TotalPrice']['convertedpricelist'] = @$data0['BasketSummary']['TotalPrice']['ConvertedPriceList'];
		$data0['BasketSummary']['totalprice'] = @$data0['BasketSummary']['TotalPrice'];
	$data0['basketsummary'] = @$data0['BasketSummary'];
if(!isset($data0['SearchCategories'])){$data0['SearchCategories'] = array();}

	if(!isset($simplexml->Result->SearchCategories->Content) || is_null($simplexml->Result->SearchCategories->Content) || !$simplexml->Result->SearchCategories->Content)		$data1_obj = @array();

	else
		$data1_obj = @$simplexml->Result->SearchCategories->Content->children();
		$data0['SearchCategories'] = @array();
		foreach($data1_obj as $value1){
			$data1_tmp = @array();
			$data1_tmp['IsHidden'] = @$value1->IsHidden;
			$data1_tmp['ishidden'] = @$value1->IsHidden;
			$data1_tmp['IsVirtual'] = @$value1->IsVirtual;
			$data1_tmp['isvirtual'] = @$value1->IsVirtual;
			$data1_tmp['Id'] = @(string)$value1->Id;
			$data1_tmp['id'] = @(string)$value1->Id;
			$data1_tmp['ExternalId'] = @(string)$value1->ExternalId;
			$data1_tmp['externalid'] = @(string)$value1->ExternalId;
			$data1_tmp['Name'] = @(string)$value1->Name;
			$data1_tmp['name'] = @(string)$value1->Name;
			$data1_tmp['IsParent'] = @$value1->IsParent;
			$data1_tmp['isparent'] = @$value1->IsParent;
			$data1_tmp['ParentId'] = @(string)$value1->ParentId;
			$data1_tmp['parentid'] = @(string)$value1->ParentId;
			$data1_tmp['ApproxWeight'] = @$value1->ApproxWeight;
			$data1_tmp['approxweight'] = @$value1->ApproxWeight;
if (isset($value1->RootPath)){ $data1_tmp['path'] = $this->_parseCategotyInfo($value1->RootPath->Content->children()); }			$data0['SearchCategories'][] = @$data1_tmp;
		}
	$data0['searchcategories'] = @$data0['SearchCategories'];
if(!isset($data0['FavoriteVendors'])){$data0['FavoriteVendors'] = array();}
		$data1_obj = @$simplexml->Result->FavoriteVendors;
if(!isset($data0['FavoriteVendors']['Elements'])){$data0['FavoriteVendors']['Elements'] = array();}

	if(!isset($simplexml->Result->FavoriteVendors->Elements) || is_null($simplexml->Result->FavoriteVendors->Elements) || !$simplexml->Result->FavoriteVendors->Elements)			$data2_obj = @array();

	else
			$data2_obj = @$simplexml->Result->FavoriteVendors->Elements->children();
			$data0['FavoriteVendors']['Elements'] = @array();
			foreach($data2_obj as $value2){
				$data2_tmp = @array();
				$data2_tmp['Id'] = @(int)$value2->Id;
				$data2_tmp['id'] = @(int)$value2->Id;
				$data2_tmp['ItemId'] = @(string)$value2->ItemId;
				$data2_tmp['itemid'] = @(string)$value2->ItemId;
				$data2_tmp['ConfigurationId'] = @(string)$value2->ConfigurationId;
				$data2_tmp['configurationid'] = @(string)$value2->ConfigurationId;
				$data2_tmp['Price'] = @$value2->Price;
				$data2_tmp['price'] = @$value2->Price;
				$data2_tmp['Quantity'] = @(int)$value2->Quantity;
				$data2_tmp['quantity'] = @(int)$value2->Quantity;
				$data2_tmp['TotalCost'] = @$value2->TotalCost;
				$data2_tmp['totalcost'] = @$value2->TotalCost;
if(!isset($data2_tmp['FullTotalCost'])){$data2_tmp['FullTotalCost'] = array();}
				$data3_obj = @$value2->FullTotalCost;
if(!isset($data2_tmp['FullTotalCost']['OriginalPrice'])){$data2_tmp['FullTotalCost']['OriginalPrice'] = array();}
					$data4_obj = @$value2->FullTotalCost->OriginalPrice;
					$data2_tmp['FullTotalCost']['OriginalPrice'] = @$data4_obj;
				$data2_tmp['FullTotalCost']['originalprice'] = @$data2_tmp['FullTotalCost']['OriginalPrice'];
if(!isset($data2_tmp['FullTotalCost']['MarginPrice'])){$data2_tmp['FullTotalCost']['MarginPrice'] = array();}
					$data4_obj = @$value2->FullTotalCost->MarginPrice;
					$data2_tmp['FullTotalCost']['MarginPrice'] = @$data4_obj;
				$data2_tmp['FullTotalCost']['marginprice'] = @$data2_tmp['FullTotalCost']['MarginPrice'];
if(!isset($data2_tmp['FullTotalCost']['OriginalCurrencyCode'])){$data2_tmp['FullTotalCost']['OriginalCurrencyCode'] = array();}
					$data4_obj = @$value2->FullTotalCost->OriginalCurrencyCode;
					$data2_tmp['FullTotalCost']['OriginalCurrencyCode'] = @(string)$data4_obj;
				$data2_tmp['FullTotalCost']['originalcurrencycode'] = @$data2_tmp['FullTotalCost']['OriginalCurrencyCode'];
if(!isset($data2_tmp['FullTotalCost']['ConvertedPriceList'])){$data2_tmp['FullTotalCost']['ConvertedPriceList'] = array();}
					$data4_obj = @$value2->FullTotalCost->ConvertedPriceList;
if(!isset($data2_tmp['FullTotalCost']['ConvertedPriceList']['Internal'])){$data2_tmp['FullTotalCost']['ConvertedPriceList']['Internal'] = array();}
						$data5_obj = @$value2->FullTotalCost->ConvertedPriceList->Internal;
						$data2_tmp['FullTotalCost']['ConvertedPriceList']['Internal'] = @$data5_obj;
					$data2_tmp['FullTotalCost']['ConvertedPriceList']['internal'] = @$data2_tmp['FullTotalCost']['ConvertedPriceList']['Internal'];
if(!isset($data2_tmp['FullTotalCost']['ConvertedPriceList']['DisplayedMoneys'])){$data2_tmp['FullTotalCost']['ConvertedPriceList']['DisplayedMoneys'] = array();}

	if(!isset($value2->FullTotalCost->ConvertedPriceList->DisplayedMoneys) || is_null($value2->FullTotalCost->ConvertedPriceList->DisplayedMoneys) || !$value2->FullTotalCost->ConvertedPriceList->DisplayedMoneys)						$data5_obj = @array();

	else
						$data5_obj = @$value2->FullTotalCost->ConvertedPriceList->DisplayedMoneys->children();
						$data2_tmp['FullTotalCost']['ConvertedPriceList']['DisplayedMoneys'] = @array();
						foreach($data5_obj as $value5){
							$data2_tmp['FullTotalCost']['ConvertedPriceList']['DisplayedMoneys'][] = @$value5;
						}
					$data2_tmp['FullTotalCost']['ConvertedPriceList']['displayedmoneys'] = @$data2_tmp['FullTotalCost']['ConvertedPriceList']['DisplayedMoneys'];
				$data2_tmp['FullTotalCost']['convertedpricelist'] = @$data2_tmp['FullTotalCost']['ConvertedPriceList'];
if(!isset($data2_tmp['FullPrice'])){$data2_tmp['FullPrice'] = array();}
				$data3_obj = @$value2->FullPrice;
if(!isset($data2_tmp['FullPrice']['OriginalPrice'])){$data2_tmp['FullPrice']['OriginalPrice'] = array();}
					$data4_obj = @$value2->FullPrice->OriginalPrice;
					$data2_tmp['FullPrice']['OriginalPrice'] = @$data4_obj;
				$data2_tmp['FullPrice']['originalprice'] = @$data2_tmp['FullPrice']['OriginalPrice'];
if(!isset($data2_tmp['FullPrice']['MarginPrice'])){$data2_tmp['FullPrice']['MarginPrice'] = array();}
					$data4_obj = @$value2->FullPrice->MarginPrice;
					$data2_tmp['FullPrice']['MarginPrice'] = @$data4_obj;
				$data2_tmp['FullPrice']['marginprice'] = @$data2_tmp['FullPrice']['MarginPrice'];
if(!isset($data2_tmp['FullPrice']['OriginalCurrencyCode'])){$data2_tmp['FullPrice']['OriginalCurrencyCode'] = array();}
					$data4_obj = @$value2->FullPrice->OriginalCurrencyCode;
					$data2_tmp['FullPrice']['OriginalCurrencyCode'] = @(string)$data4_obj;
				$data2_tmp['FullPrice']['originalcurrencycode'] = @$data2_tmp['FullPrice']['OriginalCurrencyCode'];
if(!isset($data2_tmp['FullPrice']['ConvertedPriceList'])){$data2_tmp['FullPrice']['ConvertedPriceList'] = array();}
					$data4_obj = @$value2->FullPrice->ConvertedPriceList;
if(!isset($data2_tmp['FullPrice']['ConvertedPriceList']['Internal'])){$data2_tmp['FullPrice']['ConvertedPriceList']['Internal'] = array();}
						$data5_obj = @$value2->FullPrice->ConvertedPriceList->Internal;
						$data2_tmp['FullPrice']['ConvertedPriceList']['Internal'] = @$data5_obj;
					$data2_tmp['FullPrice']['ConvertedPriceList']['internal'] = @$data2_tmp['FullPrice']['ConvertedPriceList']['Internal'];
if(!isset($data2_tmp['FullPrice']['ConvertedPriceList']['DisplayedMoneys'])){$data2_tmp['FullPrice']['ConvertedPriceList']['DisplayedMoneys'] = array();}

	if(!isset($value2->FullPrice->ConvertedPriceList->DisplayedMoneys) || is_null($value2->FullPrice->ConvertedPriceList->DisplayedMoneys) || !$value2->FullPrice->ConvertedPriceList->DisplayedMoneys)						$data5_obj = @array();

	else
						$data5_obj = @$value2->FullPrice->ConvertedPriceList->DisplayedMoneys->children();
						$data2_tmp['FullPrice']['ConvertedPriceList']['DisplayedMoneys'] = @array();
						foreach($data5_obj as $value5){
							$data2_tmp['FullPrice']['ConvertedPriceList']['DisplayedMoneys'][] = @$value5;
						}
					$data2_tmp['FullPrice']['ConvertedPriceList']['displayedmoneys'] = @$data2_tmp['FullPrice']['ConvertedPriceList']['DisplayedMoneys'];
				$data2_tmp['FullPrice']['convertedpricelist'] = @$data2_tmp['FullPrice']['ConvertedPriceList'];
if(!isset($data2_tmp['Fields'])){$data2_tmp['Fields'] = array();}

	if(!isset($value2->Fields) || is_null($value2->Fields) || !$value2->Fields)				$data3_obj = @array();

	else
				$data3_obj = @$value2->Fields->children();
				$data2_tmp['Fields'] = @array();
				foreach($data3_obj as $value3){
					$data3_tmp = @array();
					$data3_tmp['Name'] = @$value3['Name'];
					$data3_tmp['Value'] = @$value3['Value'];
					$data2_tmp['Fields'][] = @$data3_tmp;
				}
				$data2_tmp['CurrencySign'] = @(string)$value2->CurrencySign;
				$data2_tmp['currencysign'] = @(string)$value2->CurrencySign;
				$data2_tmp['CurrencyCode'] = @(string)$value2->CurrencyCode;
				$data2_tmp['currencycode'] = @(string)$value2->CurrencyCode;
				$data2_tmp['CategoryId'] = @(string)$value2->CategoryId;
				$data2_tmp['categoryid'] = @(string)$value2->CategoryId;
				$data2_tmp['VendorId'] = @(string)$value2->VendorId;
				$data2_tmp['vendorid'] = @(string)$value2->VendorId;
				$data2_tmp['CategoryName'] = @(string)$value2->CategoryName;
				$data2_tmp['categoryname'] = @(string)$value2->CategoryName;
				$data0['FavoriteVendors']['Elements'][] = @$data2_tmp;
			}
		$data0['FavoriteVendors']['elements'] = @$data0['FavoriteVendors']['Elements'];
if(!isset($data0['FavoriteVendors']['TotalCost'])){$data0['FavoriteVendors']['TotalCost'] = array();}
			$data2_obj = @$simplexml->Result->FavoriteVendors->TotalCost;
if(!isset($data0['FavoriteVendors']['TotalCost']['OriginalPrice'])){$data0['FavoriteVendors']['TotalCost']['OriginalPrice'] = array();}
				$data3_obj = @$simplexml->Result->FavoriteVendors->TotalCost->OriginalPrice;
				$data0['FavoriteVendors']['TotalCost']['OriginalPrice'] = @$data3_obj;
			$data0['FavoriteVendors']['TotalCost']['originalprice'] = @$data0['FavoriteVendors']['TotalCost']['OriginalPrice'];
if(!isset($data0['FavoriteVendors']['TotalCost']['MarginPrice'])){$data0['FavoriteVendors']['TotalCost']['MarginPrice'] = array();}
				$data3_obj = @$simplexml->Result->FavoriteVendors->TotalCost->MarginPrice;
				$data0['FavoriteVendors']['TotalCost']['MarginPrice'] = @$data3_obj;
			$data0['FavoriteVendors']['TotalCost']['marginprice'] = @$data0['FavoriteVendors']['TotalCost']['MarginPrice'];
if(!isset($data0['FavoriteVendors']['TotalCost']['OriginalCurrencyCode'])){$data0['FavoriteVendors']['TotalCost']['OriginalCurrencyCode'] = array();}
				$data3_obj = @$simplexml->Result->FavoriteVendors->TotalCost->OriginalCurrencyCode;
				$data0['FavoriteVendors']['TotalCost']['OriginalCurrencyCode'] = @(string)$data3_obj;
			$data0['FavoriteVendors']['TotalCost']['originalcurrencycode'] = @$data0['FavoriteVendors']['TotalCost']['OriginalCurrencyCode'];
if(!isset($data0['FavoriteVendors']['TotalCost']['ConvertedPriceList'])){$data0['FavoriteVendors']['TotalCost']['ConvertedPriceList'] = array();}
				$data3_obj = @$simplexml->Result->FavoriteVendors->TotalCost->ConvertedPriceList;
if(!isset($data0['FavoriteVendors']['TotalCost']['ConvertedPriceList']['Internal'])){$data0['FavoriteVendors']['TotalCost']['ConvertedPriceList']['Internal'] = array();}
					$data4_obj = @$simplexml->Result->FavoriteVendors->TotalCost->ConvertedPriceList->Internal;
					$data0['FavoriteVendors']['TotalCost']['ConvertedPriceList']['Internal'] = @$data4_obj;
				$data0['FavoriteVendors']['TotalCost']['ConvertedPriceList']['internal'] = @$data0['FavoriteVendors']['TotalCost']['ConvertedPriceList']['Internal'];
if(!isset($data0['FavoriteVendors']['TotalCost']['ConvertedPriceList']['DisplayedMoneys'])){$data0['FavoriteVendors']['TotalCost']['ConvertedPriceList']['DisplayedMoneys'] = array();}

	if(!isset($simplexml->Result->FavoriteVendors->TotalCost->ConvertedPriceList->DisplayedMoneys) || is_null($simplexml->Result->FavoriteVendors->TotalCost->ConvertedPriceList->DisplayedMoneys) || !$simplexml->Result->FavoriteVendors->TotalCost->ConvertedPriceList->DisplayedMoneys)					$data4_obj = @array();

	else
					$data4_obj = @$simplexml->Result->FavoriteVendors->TotalCost->ConvertedPriceList->DisplayedMoneys->children();
					$data0['FavoriteVendors']['TotalCost']['ConvertedPriceList']['DisplayedMoneys'] = @array();
					foreach($data4_obj as $value4){
						$data0['FavoriteVendors']['TotalCost']['ConvertedPriceList']['DisplayedMoneys'][] = @$value4;
					}
				$data0['FavoriteVendors']['TotalCost']['ConvertedPriceList']['displayedmoneys'] = @$data0['FavoriteVendors']['TotalCost']['ConvertedPriceList']['DisplayedMoneys'];
			$data0['FavoriteVendors']['TotalCost']['convertedpricelist'] = @$data0['FavoriteVendors']['TotalCost']['ConvertedPriceList'];
		$data0['FavoriteVendors']['totalcost'] = @$data0['FavoriteVendors']['TotalCost'];
if(!isset($data0['FavoriteVendors']['AdditionalPriceInfoList'])){$data0['FavoriteVendors']['AdditionalPriceInfoList'] = array();}

	if(!isset($simplexml->Result->FavoriteVendors->AdditionalPriceInfoList->Elements) || is_null($simplexml->Result->FavoriteVendors->AdditionalPriceInfoList->Elements) || !$simplexml->Result->FavoriteVendors->AdditionalPriceInfoList->Elements)			$data2_obj = @array();

	else
			$data2_obj = @$simplexml->Result->FavoriteVendors->AdditionalPriceInfoList->Elements->children();
			$data0['FavoriteVendors']['AdditionalPriceInfoList'] = @array();
			foreach($data2_obj as $value2){
				$data2_tmp = @array();
				$data2_tmp['Type'] = @$value2->Type;
				$data2_tmp['type'] = @$value2->Type;
				$data2_tmp['Name'] = @(string)$value2->Name;
				$data2_tmp['name'] = @(string)$value2->Name;
if(!isset($data2_tmp['Price'])){$data2_tmp['Price'] = array();}
				$data3_obj = @$value2->Price;
if(!isset($data2_tmp['Price']['OriginalPrice'])){$data2_tmp['Price']['OriginalPrice'] = array();}
					$data4_obj = @$value2->Price->OriginalPrice;
					$data2_tmp['Price']['OriginalPrice'] = @$data4_obj;
				$data2_tmp['Price']['originalprice'] = @$data2_tmp['Price']['OriginalPrice'];
if(!isset($data2_tmp['Price']['MarginPrice'])){$data2_tmp['Price']['MarginPrice'] = array();}
					$data4_obj = @$value2->Price->MarginPrice;
					$data2_tmp['Price']['MarginPrice'] = @$data4_obj;
				$data2_tmp['Price']['marginprice'] = @$data2_tmp['Price']['MarginPrice'];
if(!isset($data2_tmp['Price']['OriginalCurrencyCode'])){$data2_tmp['Price']['OriginalCurrencyCode'] = array();}
					$data4_obj = @$value2->Price->OriginalCurrencyCode;
					$data2_tmp['Price']['OriginalCurrencyCode'] = @(string)$data4_obj;
				$data2_tmp['Price']['originalcurrencycode'] = @$data2_tmp['Price']['OriginalCurrencyCode'];
if(!isset($data2_tmp['Price']['ConvertedPriceList'])){$data2_tmp['Price']['ConvertedPriceList'] = array();}
					$data4_obj = @$value2->Price->ConvertedPriceList;
if(!isset($data2_tmp['Price']['ConvertedPriceList']['Internal'])){$data2_tmp['Price']['ConvertedPriceList']['Internal'] = array();}
						$data5_obj = @$value2->Price->ConvertedPriceList->Internal;
						$data2_tmp['Price']['ConvertedPriceList']['Internal'] = @$data5_obj;
					$data2_tmp['Price']['ConvertedPriceList']['internal'] = @$data2_tmp['Price']['ConvertedPriceList']['Internal'];
if(!isset($data2_tmp['Price']['ConvertedPriceList']['DisplayedMoneys'])){$data2_tmp['Price']['ConvertedPriceList']['DisplayedMoneys'] = array();}

	if(!isset($value2->Price->ConvertedPriceList->DisplayedMoneys) || is_null($value2->Price->ConvertedPriceList->DisplayedMoneys) || !$value2->Price->ConvertedPriceList->DisplayedMoneys)						$data5_obj = @array();

	else
						$data5_obj = @$value2->Price->ConvertedPriceList->DisplayedMoneys->children();
						$data2_tmp['Price']['ConvertedPriceList']['DisplayedMoneys'] = @array();
						foreach($data5_obj as $value5){
							$data2_tmp['Price']['ConvertedPriceList']['DisplayedMoneys'][] = @$value5;
						}
					$data2_tmp['Price']['ConvertedPriceList']['displayedmoneys'] = @$data2_tmp['Price']['ConvertedPriceList']['DisplayedMoneys'];
				$data2_tmp['Price']['convertedpricelist'] = @$data2_tmp['Price']['ConvertedPriceList'];
				$data0['FavoriteVendors']['AdditionalPriceInfoList'][] = @$data2_tmp;
			}
		$data0['FavoriteVendors']['additionalpriceinfolist'] = @$data0['FavoriteVendors']['AdditionalPriceInfoList'];
	$data0['favoritevendors'] = @$data0['FavoriteVendors'];
if(!isset($data0['FavoriteVendorsSummary'])){$data0['FavoriteVendorsSummary'] = array();}
		$data1_obj = @$simplexml->Result->FavoriteVendorsSummary;
if(!isset($data0['FavoriteVendorsSummary']['TotalCount'])){$data0['FavoriteVendorsSummary']['TotalCount'] = array();}
			$data2_obj = @$simplexml->Result->FavoriteVendorsSummary->TotalCount;
			$data0['FavoriteVendorsSummary']['TotalCount'] = @$data2_obj;
		$data0['FavoriteVendorsSummary']['totalcount'] = @$data0['FavoriteVendorsSummary']['TotalCount'];
if(!isset($data0['FavoriteVendorsSummary']['TotalPrice'])){$data0['FavoriteVendorsSummary']['TotalPrice'] = array();}
			$data2_obj = @$simplexml->Result->FavoriteVendorsSummary->TotalPrice;
if(!isset($data0['FavoriteVendorsSummary']['TotalPrice']['OriginalPrice'])){$data0['FavoriteVendorsSummary']['TotalPrice']['OriginalPrice'] = array();}
				$data3_obj = @$simplexml->Result->FavoriteVendorsSummary->TotalPrice->OriginalPrice;
				$data0['FavoriteVendorsSummary']['TotalPrice']['OriginalPrice'] = @$data3_obj;
			$data0['FavoriteVendorsSummary']['TotalPrice']['originalprice'] = @$data0['FavoriteVendorsSummary']['TotalPrice']['OriginalPrice'];
if(!isset($data0['FavoriteVendorsSummary']['TotalPrice']['MarginPrice'])){$data0['FavoriteVendorsSummary']['TotalPrice']['MarginPrice'] = array();}
				$data3_obj = @$simplexml->Result->FavoriteVendorsSummary->TotalPrice->MarginPrice;
				$data0['FavoriteVendorsSummary']['TotalPrice']['MarginPrice'] = @$data3_obj;
			$data0['FavoriteVendorsSummary']['TotalPrice']['marginprice'] = @$data0['FavoriteVendorsSummary']['TotalPrice']['MarginPrice'];
if(!isset($data0['FavoriteVendorsSummary']['TotalPrice']['OriginalCurrencyCode'])){$data0['FavoriteVendorsSummary']['TotalPrice']['OriginalCurrencyCode'] = array();}
				$data3_obj = @$simplexml->Result->FavoriteVendorsSummary->TotalPrice->OriginalCurrencyCode;
				$data0['FavoriteVendorsSummary']['TotalPrice']['OriginalCurrencyCode'] = @(string)$data3_obj;
			$data0['FavoriteVendorsSummary']['TotalPrice']['originalcurrencycode'] = @$data0['FavoriteVendorsSummary']['TotalPrice']['OriginalCurrencyCode'];
if(!isset($data0['FavoriteVendorsSummary']['TotalPrice']['ConvertedPriceList'])){$data0['FavoriteVendorsSummary']['TotalPrice']['ConvertedPriceList'] = array();}
				$data3_obj = @$simplexml->Result->FavoriteVendorsSummary->TotalPrice->ConvertedPriceList;
if(!isset($data0['FavoriteVendorsSummary']['TotalPrice']['ConvertedPriceList']['Internal'])){$data0['FavoriteVendorsSummary']['TotalPrice']['ConvertedPriceList']['Internal'] = array();}
					$data4_obj = @$simplexml->Result->FavoriteVendorsSummary->TotalPrice->ConvertedPriceList->Internal;
					$data0['FavoriteVendorsSummary']['TotalPrice']['ConvertedPriceList']['Internal'] = @$data4_obj;
				$data0['FavoriteVendorsSummary']['TotalPrice']['ConvertedPriceList']['internal'] = @$data0['FavoriteVendorsSummary']['TotalPrice']['ConvertedPriceList']['Internal'];
if(!isset($data0['FavoriteVendorsSummary']['TotalPrice']['ConvertedPriceList']['DisplayedMoneys'])){$data0['FavoriteVendorsSummary']['TotalPrice']['ConvertedPriceList']['DisplayedMoneys'] = array();}

	if(!isset($simplexml->Result->FavoriteVendorsSummary->TotalPrice->ConvertedPriceList->DisplayedMoneys) || is_null($simplexml->Result->FavoriteVendorsSummary->TotalPrice->ConvertedPriceList->DisplayedMoneys) || !$simplexml->Result->FavoriteVendorsSummary->TotalPrice->ConvertedPriceList->DisplayedMoneys)					$data4_obj = @array();

	else
					$data4_obj = @$simplexml->Result->FavoriteVendorsSummary->TotalPrice->ConvertedPriceList->DisplayedMoneys->children();
					$data0['FavoriteVendorsSummary']['TotalPrice']['ConvertedPriceList']['DisplayedMoneys'] = @array();
					foreach($data4_obj as $value4){
						$data0['FavoriteVendorsSummary']['TotalPrice']['ConvertedPriceList']['DisplayedMoneys'][] = @$value4;
					}
				$data0['FavoriteVendorsSummary']['TotalPrice']['ConvertedPriceList']['displayedmoneys'] = @$data0['FavoriteVendorsSummary']['TotalPrice']['ConvertedPriceList']['DisplayedMoneys'];
			$data0['FavoriteVendorsSummary']['TotalPrice']['convertedpricelist'] = @$data0['FavoriteVendorsSummary']['TotalPrice']['ConvertedPriceList'];
		$data0['FavoriteVendorsSummary']['totalprice'] = @$data0['FavoriteVendorsSummary']['TotalPrice'];
	$data0['favoritevendorssummary'] = @$data0['FavoriteVendorsSummary'];
	return $data0;
    }
    public function GetBrandInfoList(){
        $params = array(
            
        );
        $params += $this->defaultLogin();
        $simplexml = $this->_getData('GetBrandInfoList', $params);
        if (!$simplexml) return false;
        
        $data0 = array();
        
if(!isset($data0)){$data0 = array();}

	if(!isset($simplexml->BrandInfoList->Content) || is_null($simplexml->BrandInfoList->Content) || !$simplexml->BrandInfoList->Content)	$data0_obj = @array();

	else
	$data0_obj = @$simplexml->BrandInfoList->Content->children();
	$data0 = @array();
	foreach($data0_obj as $value0){
		$data0_tmp = @array();
		$data0_tmp['Id'] = @(string)$value0->Id;
		$data0_tmp['id'] = @(string)$value0->Id;
		$data0_tmp['ExternalId'] = @(string)$value0->ExternalId;
		$data0_tmp['externalid'] = @(string)$value0->ExternalId;
		$data0_tmp['Name'] = @(string)$value0->Name;
		$data0_tmp['name'] = @(string)$value0->Name;
		$data0_tmp['Description'] = @(string)$value0->Description;
		$data0_tmp['description'] = @(string)$value0->Description;
		$data0_tmp['PictureUrl'] = @(string)$value0->PictureUrl;
		$data0_tmp['pictureurl'] = @(string)$value0->PictureUrl;
		$data0_tmp['IsHidden'] = @$value0->IsHidden;
		$data0_tmp['ishidden'] = @$value0->IsHidden;
		$data0_tmp['IsNameSearch'] = @$value0->IsNameSearch;
		$data0_tmp['isnamesearch'] = @$value0->IsNameSearch;
                $data0_tmp['IsGlobal'] = @$value0->IsGlobal;
		$data0_tmp['isglobal'] = @$value0->IsGlobal;
		$data0[] = @$data0_tmp;
	}
	return $data0;
    }
    public function GetBrandInfoListFrame($framePosition = 0, $frameSize = 18){
        $params = array(
            'framePosition' => $framePosition,
	    'frameSize' => $frameSize
        );
        $params += $this->defaultLogin();
        $simplexml = $this->_getData('GetBrandInfoListFrame', $params);
        if (!$simplexml) return false;
        
        $data0 = array();
        
if(!isset($data0)){$data0 = array();}
	$data0_obj = @$simplexml->BrandInfoList;
if(!isset($data0['Content'])){$data0['Content'] = array();}

	if(!isset($simplexml->BrandInfoList->Content) || is_null($simplexml->BrandInfoList->Content) || !$simplexml->BrandInfoList->Content)		$data1_obj = @array();

	else
		$data1_obj = @$simplexml->BrandInfoList->Content->children();
		$data0['Content'] = @array();
		foreach($data1_obj as $value1){
			$data1_tmp = @array();
			$data1_tmp['Id'] = @(string)$value1->Id;
			$data1_tmp['id'] = @(string)$value1->Id;
			$data1_tmp['ExternalId'] = @(string)$value1->ExternalId;
			$data1_tmp['externalid'] = @(string)$value1->ExternalId;
			$data1_tmp['Name'] = @(string)$value1->Name;
			$data1_tmp['name'] = @(string)$value1->Name;
			$data1_tmp['Description'] = @(string)$value1->Description;
			$data1_tmp['description'] = @(string)$value1->Description;
			$data1_tmp['PictureUrl'] = @(string)$value1->PictureUrl;
			$data1_tmp['pictureurl'] = @(string)$value1->PictureUrl;
			$data1_tmp['IsHidden'] = @$value1->IsHidden;
			$data1_tmp['ishidden'] = @$value1->IsHidden;
			$data1_tmp['IsNameSearch'] = @$value1->IsNameSearch;
			$data1_tmp['isnamesearch'] = @$value1->IsNameSearch;
                        $data1_tmp['IsGlobal'] = @$value1->IsGlobal;
                        $data1_tmp['isglobal'] = @$value1->IsGlobal;
			$data0['Content'][] = @$data1_tmp;
		}
	$data0['content'] = @$data0['Content'];
if(!isset($data0['TotalCount'])){$data0['TotalCount'] = array();}
		$data1_obj = @$simplexml->BrandInfoList->TotalCount;
		$data0['TotalCount'] = @$data1_obj;
	$data0['totalcount'] = @$data0['TotalCount'];
	return $data0;
    }
    public function GetBrandInfo($brandId){
        $params = array(
            'brandId' => $brandId
        );
        $params += $this->defaultLogin();
        $simplexml = $this->_getData('GetBrandInfo', $params);
        if (!$simplexml) return false;
        
        $data0 = array();
        
if(!isset($data0)){$data0 = array();}
	$data0_obj = @$simplexml->BrandInfo;
if(!isset($data0['Id'])){$data0['Id'] = array();}
		$data1_obj = @$simplexml->BrandInfo->Id;
		$data0['Id'] = @(string)$data1_obj;
	$data0['id'] = @$data0['Id'];
if(!isset($data0['ExternalId'])){$data0['ExternalId'] = array();}
		$data1_obj = @$simplexml->BrandInfo->ExternalId;
		$data0['ExternalId'] = @(string)$data1_obj;
	$data0['externalid'] = @$data0['ExternalId'];
if(!isset($data0['Name'])){$data0['Name'] = array();}
		$data1_obj = @$simplexml->BrandInfo->Name;
		$data0['Name'] = @(string)$data1_obj;
	$data0['name'] = @$data0['Name'];
if(!isset($data0['Description'])){$data0['Description'] = array();}
		$data1_obj = @$simplexml->BrandInfo->Description;
		$data0['Description'] = @(string)$data1_obj;
	$data0['description'] = @$data0['Description'];
if(!isset($data0['PictureUrl'])){$data0['PictureUrl'] = array();}
		$data1_obj = @$simplexml->BrandInfo->PictureUrl;
		$data0['PictureUrl'] = @(string)$data1_obj;
	$data0['pictureurl'] = @$data0['PictureUrl'];
if(!isset($data0['IsHidden'])){$data0['IsHidden'] = array();}
		$data1_obj = @$simplexml->BrandInfo->IsHidden;
		$data0['IsHidden'] = @$data1_obj;
	$data0['ishidden'] = @$data0['IsHidden'];
if(!isset($data0['IsNameSearch'])){$data0['IsNameSearch'] = array();}
		$data1_obj = @$simplexml->BrandInfo->IsNameSearch;
		$data0['IsNameSearch'] = @$data1_obj;
	$data0['isnamesearch'] = @$data0['IsNameSearch'];
	return $data0;
    }
    public function FindBrandInfoList($name){
        $params = array(
            'name' => $name
        );
        $params += $this->defaultLogin();
        $simplexml = $this->_getData('FindBrandInfoList', $params);
        if (!$simplexml) return false;
        
        $data0 = array();
        
if(!isset($data0)){$data0 = array();}

	if(!isset($simplexml->BrandInfoList->Content) || is_null($simplexml->BrandInfoList->Content) || !$simplexml->BrandInfoList->Content)	$data0_obj = @array();

	else
	$data0_obj = @$simplexml->BrandInfoList->Content->children();
	$data0 = @array();
	foreach($data0_obj as $value0){
		$data0_tmp = @array();
		$data0_tmp['Id'] = @(string)$value0->Id;
		$data0_tmp['id'] = @(string)$value0->Id;
		$data0_tmp['ExternalId'] = @(string)$value0->ExternalId;
		$data0_tmp['externalid'] = @(string)$value0->ExternalId;
		$data0_tmp['Name'] = @(string)$value0->Name;
		$data0_tmp['name'] = @(string)$value0->Name;
		$data0_tmp['Description'] = @(string)$value0->Description;
		$data0_tmp['description'] = @(string)$value0->Description;
		$data0_tmp['PictureUrl'] = @(string)$value0->PictureUrl;
		$data0_tmp['pictureurl'] = @(string)$value0->PictureUrl;
		$data0_tmp['IsHidden'] = @$value0->IsHidden;
		$data0_tmp['ishidden'] = @$value0->IsHidden;
		$data0_tmp['IsNameSearch'] = @$value0->IsNameSearch;
		$data0_tmp['isnamesearch'] = @$value0->IsNameSearch;
                $data0_tmp['IsGlobal'] = @$value0->IsGlobal;
                $data0_tmp['isglobal'] = @$value0->IsGlobal;
		$data0[] = @$data0_tmp;
	}
	return $data0;
    }
    public function GetBrandInfoFullList($sessionId){
        $params = array(
            'sessionId' => $sessionId
        );
        $params += $this->defaultLogin();
        $simplexml = $this->_getData('GetBrandInfoFullList', $params);
        if (!$simplexml) return false;
        
        $data0 = array();
        
if(!isset($data0)){$data0 = array();}

	if(!isset($simplexml->BrandInfoList->Content) || is_null($simplexml->BrandInfoList->Content) || !$simplexml->BrandInfoList->Content)	$data0_obj = @array();

	else
	$data0_obj = @$simplexml->BrandInfoList->Content->children();
	$data0 = @array();
	foreach($data0_obj as $value0){
		$data0_tmp = @array();
		$data0_tmp['Id'] = @(string)$value0->Id;
		$data0_tmp['id'] = @(string)$value0->Id;
		$data0_tmp['ExternalId'] = @(string)$value0->ExternalId;
		$data0_tmp['externalid'] = @(string)$value0->ExternalId;
		$data0_tmp['Name'] = @(string)$value0->Name;
		$data0_tmp['name'] = @(string)$value0->Name;
		$data0_tmp['Description'] = @(string)$value0->Description;
		$data0_tmp['description'] = @(string)$value0->Description;
		$data0_tmp['PictureUrl'] = @(string)$value0->PictureUrl;
		$data0_tmp['pictureurl'] = @(string)$value0->PictureUrl;
		$data0_tmp['IsHidden'] = @$value0->IsHidden;
		$data0_tmp['ishidden'] = @$value0->IsHidden;
		$data0_tmp['IsNameSearch'] = @$value0->IsNameSearch;
		$data0_tmp['isnamesearch'] = @$value0->IsNameSearch;
                $data0_tmp['IsGlobal'] = @$value0->IsGlobal;
                $data0_tmp['isglobal'] = @$value0->IsGlobal;
		$data0[] = @$data0_tmp;
	}
	return $data0;
    }
    public function AddBrandInfo($sessionId, $xmlBrandInfo){
        $params = array(
            'sessionId' => $sessionId,
	    'xmlBrandInfo' => $xmlBrandInfo
        );
        $params += $this->defaultLogin();
        $simplexml = $this->_getData('AddBrandInfo', $params);
        if (!$simplexml) return false;
        
        $data0 = array();
        
if(!isset($data0)){$data0 = array();}
	$data0_obj = @$simplexml->BrandId;
	$data0 = @(string)$data0_obj;
	return $data0;
    }
    public function RemoveBrandInfo($sessionId, $brandId){
        $params = array(
            'sessionId' => $sessionId,
	    'brandId' => $brandId
        );
        $params += $this->defaultLogin();
        $simplexml = $this->_getData('RemoveBrandInfo', $params);
        if (!$simplexml) return false;
        
        $data0 = array();
        
if(!isset($data0)){$data0 = array();}
	$data0_obj = @$simplexml;
	$data0 = @$data0_obj;
	return $data0;
    }
    public function EditBrandInfo($sessionId, $brandId, $xmlBrandInfo){
        $params = array(
            'sessionId' => $sessionId,
	    'brandId' => $brandId,
	    'xmlBrandInfo' => $xmlBrandInfo
        );
        $params += $this->defaultLogin();
        $simplexml = $this->_getData('EditBrandInfo', $params);
        if (!$simplexml) return false;
        
        $data0 = array();
        
if(!isset($data0)){$data0 = array();}
	$data0_obj = @$simplexml->BrandId;
	$data0 = @(string)$data0_obj;
	return $data0;
    }
    public function SearchOriginalBrandsFrame($sessionId, $name, $framePosition = 0, $frameSize = 18){
        $params = array(
            'sessionId' => $sessionId,
	    'name' => $name,
	    'framePosition' => $framePosition,
	    'frameSize' => $frameSize
        );
        $params += $this->defaultLogin();
        $simplexml = $this->_getData('SearchOriginalBrandsFrame', $params);
        if (!$simplexml) return false;
        
        $data0 = array();
        
if(!isset($data0)){$data0 = array();}
	$data0_obj = @$simplexml->BrandInfoList;
if(!isset($data0['Content'])){$data0['Content'] = array();}

	if(!isset($simplexml->BrandInfoList->Content) || is_null($simplexml->BrandInfoList->Content) || !$simplexml->BrandInfoList->Content)		$data1_obj = @array();

	else
		$data1_obj = @$simplexml->BrandInfoList->Content->children();
		$data0['Content'] = @array();
		foreach($data1_obj as $value1){
			$data1_tmp = @array();
			$data1_tmp['Id'] = @(string)$value1->Id;
			$data1_tmp['id'] = @(string)$value1->Id;
			$data1_tmp['ExternalId'] = @(string)$value1->ExternalId;
			$data1_tmp['externalid'] = @(string)$value1->ExternalId;
			$data1_tmp['Name'] = @(string)$value1->Name;
			$data1_tmp['name'] = @(string)$value1->Name;
			$data1_tmp['Description'] = @(string)$value1->Description;
			$data1_tmp['description'] = @(string)$value1->Description;
			$data1_tmp['PictureUrl'] = @(string)$value1->PictureUrl;
			$data1_tmp['pictureurl'] = @(string)$value1->PictureUrl;
			$data1_tmp['IsHidden'] = @$value1->IsHidden;
			$data1_tmp['ishidden'] = @$value1->IsHidden;
			$data1_tmp['IsNameSearch'] = @$value1->IsNameSearch;
			$data1_tmp['isnamesearch'] = @$value1->IsNameSearch;
			$data0['Content'][] = @$data1_tmp;
		}
	$data0['content'] = @$data0['Content'];
if(!isset($data0['TotalCount'])){$data0['TotalCount'] = array();}
		$data1_obj = @$simplexml->BrandInfoList->TotalCount;
		$data0['TotalCount'] = @$data1_obj;
	$data0['totalcount'] = @$data0['TotalCount'];
	return $data0;
    }
    public function GetCategoryInfo($categoryId){
        $params = array(
            'categoryId' => $categoryId
        );
        $params += $this->defaultLogin();
        $simplexml = $this->_getData('GetCategoryInfo', $params);
        if (!$simplexml) return false;
        
        $data0 = array();
        
if(!isset($data0)){$data0 = array();}
	$data0_obj = @$simplexml->OtapiCategory;
if(!isset($data0['IsHidden'])){$data0['IsHidden'] = array();}
		$data1_obj = @$simplexml->OtapiCategory->IsHidden;
		$data0['IsHidden'] = @$data1_obj;
	$data0['ishidden'] = @$data0['IsHidden'];
if(!isset($data0['IsVirtual'])){$data0['IsVirtual'] = array();}
		$data1_obj = @$simplexml->OtapiCategory->IsVirtual;
		$data0['IsVirtual'] = @$data1_obj;
	$data0['isvirtual'] = @$data0['IsVirtual'];
if(!isset($data0['Id'])){$data0['Id'] = array();}
		$data1_obj = @$simplexml->OtapiCategory->Id;
		$data0['Id'] = @(string)$data1_obj;
	$data0['id'] = @$data0['Id'];
if(!isset($data0['ExternalId'])){$data0['ExternalId'] = array();}
		$data1_obj = @$simplexml->OtapiCategory->ExternalId;
		$data0['ExternalId'] = @(string)$data1_obj;
	$data0['externalid'] = @$data0['ExternalId'];
if(!isset($data0['Name'])){$data0['Name'] = array();}
		$data1_obj = @$simplexml->OtapiCategory->Name;
		$data0['Name'] = @(string)$data1_obj;
	$data0['name'] = @$data0['Name'];
if(!isset($data0['IsParent'])){$data0['IsParent'] = array();}
		$data1_obj = @$simplexml->OtapiCategory->IsParent;
		$data0['IsParent'] = @$data1_obj;
	$data0['isparent'] = @$data0['IsParent'];
if(!isset($data0['ParentId'])){$data0['ParentId'] = array();}
		$data1_obj = @$simplexml->OtapiCategory->ParentId;
		$data0['ParentId'] = @(string)$data1_obj;
	$data0['parentid'] = @$data0['ParentId'];
if(!isset($data0['ApproxWeight'])){$data0['ApproxWeight'] = array();}
		$data1_obj = @$simplexml->OtapiCategory->ApproxWeight;
		$data0['ApproxWeight'] = @$data1_obj;
	$data0['approxweight'] = @$data0['ApproxWeight'];
if(!isset($data0['RootPath'])){$data0['RootPath'] = array();}

	if(!isset($simplexml->OtapiCategory->RootPath->Content) || is_null($simplexml->OtapiCategory->RootPath->Content) || !$simplexml->OtapiCategory->RootPath->Content)		$data1_obj = @array();

	else
		$data1_obj = @$simplexml->OtapiCategory->RootPath->Content->children();
		$data0['RootPath'] = @array();
		foreach($data1_obj as $value1){
			$data0['RootPath'][] = @$value1;
		}
	$data0['rootpath'] = @$data0['RootPath'];
	return $data0;
    }
    public function GetCategoryInfoList($categoryIds){
        $params = array(
            'categoryIds' => $categoryIds
        );
        $params += $this->defaultLogin();
        $simplexml = $this->_getData('GetCategoryInfoList', $params);
        if (!$simplexml) return false;
        
        $data0 = array();
        
if(!isset($data0)){$data0 = array();}

	if(!isset($simplexml->CategoryInfoList->Content) || is_null($simplexml->CategoryInfoList->Content) || !$simplexml->CategoryInfoList->Content)	$data0_obj = @array();

	else
	$data0_obj = @$simplexml->CategoryInfoList->Content->children();
	$data0 = @array();
	foreach($data0_obj as $value0){
		$data0_tmp = @array();
		$data0_tmp['IsHidden'] = @$value0->IsHidden;
		$data0_tmp['ishidden'] = @$value0->IsHidden;
		$data0_tmp['IsVirtual'] = @$value0->IsVirtual;
		$data0_tmp['isvirtual'] = @$value0->IsVirtual;
		$data0_tmp['Id'] = @(string)$value0->Id;
		$data0_tmp['id'] = @(string)$value0->Id;
		$data0_tmp['ExternalId'] = @(string)$value0->ExternalId;
		$data0_tmp['externalid'] = @(string)$value0->ExternalId;
		$data0_tmp['Name'] = @(string)$value0->Name;
		$data0_tmp['name'] = @(string)$value0->Name;
		$data0_tmp['IsParent'] = @$value0->IsParent;
		$data0_tmp['isparent'] = @$value0->IsParent;
		$data0_tmp['ParentId'] = @(string)$value0->ParentId;
		$data0_tmp['parentid'] = @(string)$value0->ParentId;
		$data0_tmp['ApproxWeight'] = @$value0->ApproxWeight;
		$data0_tmp['approxweight'] = @$value0->ApproxWeight;
if (isset($value0->RootPath)){ $data0_tmp['path'] = $this->_parseCategotyInfo($value0->RootPath->Content->children()); }		$data0[] = @$data0_tmp;
	}
	return $data0;
    }
    public function GetCategorySubcategoryInfoList($parentCategoryId){
        $params = array(
            'parentCategoryId' => $parentCategoryId
        );
        $params += $this->defaultLogin();
        $simplexml = $this->_getData('GetCategorySubcategoryInfoList', $params);
        if (!$simplexml) return false;
        
        $data0 = array();
        
if(!isset($data0)){$data0 = array();}

	if(!isset($simplexml->CategoryInfoList->Content) || is_null($simplexml->CategoryInfoList->Content) || !$simplexml->CategoryInfoList->Content)	$data0_obj = @array();

	else
	$data0_obj = @$simplexml->CategoryInfoList->Content->children();
	$data0 = @array();
	foreach($data0_obj as $value0){
		$data0_tmp = @array();
		$data0_tmp['IsHidden'] = @$value0->IsHidden;
		$data0_tmp['ishidden'] = @$value0->IsHidden;
		$data0_tmp['IsVirtual'] = @$value0->IsVirtual;
		$data0_tmp['isvirtual'] = @$value0->IsVirtual;
		$data0_tmp['Id'] = @(string)$value0->Id;
		$data0_tmp['id'] = @(string)$value0->Id;
		$data0_tmp['ExternalId'] = @(string)$value0->ExternalId;
		$data0_tmp['externalid'] = @(string)$value0->ExternalId;
		$data0_tmp['Name'] = @(string)$value0->Name;
		$data0_tmp['name'] = @(string)$value0->Name;
		$data0_tmp['IsParent'] = @$value0->IsParent;
		$data0_tmp['isparent'] = @$value0->IsParent;
		$data0_tmp['ParentId'] = @(string)$value0->ParentId;
		$data0_tmp['parentid'] = @(string)$value0->ParentId;
		$data0_tmp['ApproxWeight'] = @$value0->ApproxWeight;
		$data0_tmp['approxweight'] = @$value0->ApproxWeight;
if (isset($value0->RootPath)){ $data0_tmp['path'] = $this->_parseCategotyInfo($value0->RootPath->Content->children()); }		$data0[] = @$data0_tmp;
	}
	return $data0;
    }
    public function GetRootCategoryInfoList(){
        $params = array(
            
        );
        $params += $this->defaultLogin();
        $simplexml = $this->_getData('GetRootCategoryInfoList', $params);
        if (!$simplexml) return false;
        
        $data0 = array();
        
if(!isset($data0)){$data0 = array();}

	if(!isset($simplexml->CategoryInfoList->Content) || is_null($simplexml->CategoryInfoList->Content) || !$simplexml->CategoryInfoList->Content)	$data0_obj = @array();

	else
	$data0_obj = @$simplexml->CategoryInfoList->Content->children();
	$data0 = @array();
	foreach($data0_obj as $value0){
		$data0_tmp = @array();
		$data0_tmp['IsHidden'] = @$value0->IsHidden;
		$data0_tmp['ishidden'] = @$value0->IsHidden;
		$data0_tmp['IsVirtual'] = @$value0->IsVirtual;
		$data0_tmp['isvirtual'] = @$value0->IsVirtual;
		$data0_tmp['Id'] = @(string)$value0->Id;
		$data0_tmp['id'] = @(string)$value0->Id;
		$data0_tmp['ExternalId'] = @(string)$value0->ExternalId;
		$data0_tmp['externalid'] = @(string)$value0->ExternalId;
		$data0_tmp['Name'] = @(string)$value0->Name;
		$data0_tmp['name'] = @(string)$value0->Name;
		$data0_tmp['IsParent'] = @$value0->IsParent;
		$data0_tmp['isparent'] = @$value0->IsParent;
		$data0_tmp['ParentId'] = @(string)$value0->ParentId;
		$data0_tmp['parentid'] = @(string)$value0->ParentId;
		$data0_tmp['ApproxWeight'] = @$value0->ApproxWeight;
		$data0_tmp['approxweight'] = @$value0->ApproxWeight;
if (isset($value0->RootPath)){ $data0_tmp['path'] = $this->_parseCategotyInfo($value0->RootPath->Content->children()); }		$data0[] = @$data0_tmp;
	}
	return $data0;
    }
    public function GetTwoLevelRootCategoryInfoList(){
        $params = array(
            
        );
        $params += $this->defaultLogin();
        $simplexml = $this->_getData('GetTwoLevelRootCategoryInfoList', $params);
        if (!$simplexml) return false;
        
        $data0 = array();
        
if(!isset($data0)){$data0 = array();}

	if(!isset($simplexml->CategoryInfoList->Content) || is_null($simplexml->CategoryInfoList->Content) || !$simplexml->CategoryInfoList->Content)	$data0_obj = @array();

	else
	$data0_obj = @$simplexml->CategoryInfoList->Content->children();
	$data0 = @array();
	foreach($data0_obj as $value0){
		$data0_tmp = @array();
		$data0_tmp['IsHidden'] = @$value0->IsHidden;
		$data0_tmp['ishidden'] = @$value0->IsHidden;
		$data0_tmp['IsVirtual'] = @$value0->IsVirtual;
		$data0_tmp['isvirtual'] = @$value0->IsVirtual;
		$data0_tmp['Id'] = @(string)$value0->Id;
		$data0_tmp['id'] = @(string)$value0->Id;
		$data0_tmp['ExternalId'] = @(string)$value0->ExternalId;
		$data0_tmp['externalid'] = @(string)$value0->ExternalId;
		$data0_tmp['Name'] = @(string)$value0->Name;
		$data0_tmp['name'] = @(string)$value0->Name;
		$data0_tmp['IsParent'] = @$value0->IsParent;
		$data0_tmp['isparent'] = @$value0->IsParent;
		$data0_tmp['ParentId'] = @(string)$value0->ParentId;
		$data0_tmp['parentid'] = @(string)$value0->ParentId;
		$data0_tmp['ApproxWeight'] = @$value0->ApproxWeight;
		$data0_tmp['approxweight'] = @$value0->ApproxWeight;
if (isset($value0->RootPath)){ $data0_tmp['path'] = $this->_parseCategotyInfo($value0->RootPath->Content->children()); }		$data0[] = @$data0_tmp;
	}
	return $data0;
    }
    public function GetThreeLevelRootCategoryInfoList(){
        $params = array(
            
        );
        $params += $this->defaultLogin();
        $simplexml = $this->_getData('GetThreeLevelRootCategoryInfoList', $params);
        if (!$simplexml) return false;
        
        $data0 = array();
        
if(!isset($data0)){$data0 = array();}

	if(!isset($simplexml->CategoryInfoList->Content) || is_null($simplexml->CategoryInfoList->Content) || !$simplexml->CategoryInfoList->Content)	$data0_obj = @array();

	else
	$data0_obj = @$simplexml->CategoryInfoList->Content->children();
	$data0 = @array();
	foreach($data0_obj as $value0){
		$data0_tmp = @array();
		$data0_tmp['IsHidden'] = @$value0->IsHidden;
		$data0_tmp['ishidden'] = @$value0->IsHidden;
		$data0_tmp['IsVirtual'] = @$value0->IsVirtual;
		$data0_tmp['isvirtual'] = @$value0->IsVirtual;
		$data0_tmp['Id'] = @(string)$value0->Id;
		$data0_tmp['id'] = @(string)$value0->Id;
		$data0_tmp['ExternalId'] = @(string)$value0->ExternalId;
		$data0_tmp['externalid'] = @(string)$value0->ExternalId;
		$data0_tmp['Name'] = @(string)$value0->Name;
		$data0_tmp['name'] = @(string)$value0->Name;
		$data0_tmp['IsParent'] = @$value0->IsParent;
		$data0_tmp['isparent'] = @$value0->IsParent;
		$data0_tmp['ParentId'] = @(string)$value0->ParentId;
		$data0_tmp['parentid'] = @(string)$value0->ParentId;
		$data0_tmp['ApproxWeight'] = @$value0->ApproxWeight;
		$data0_tmp['approxweight'] = @$value0->ApproxWeight;
if (isset($value0->RootPath)){ $data0_tmp['path'] = $this->_parseCategotyInfo($value0->RootPath->Content->children()); }		$data0[] = @$data0_tmp;
	}
	return $data0;
    }
    public function GetSearchCategoryInfoList(){
        $params = array(
            
        );
        $params += $this->defaultLogin();
        $simplexml = $this->_getData('GetSearchCategoryInfoList', $params);
        if (!$simplexml) return false;
        
        $data0 = array();
        
if(!isset($data0)){$data0 = array();}

	if(!isset($simplexml->CategoryInfoList->Content) || is_null($simplexml->CategoryInfoList->Content) || !$simplexml->CategoryInfoList->Content)	$data0_obj = @array();

	else
	$data0_obj = @$simplexml->CategoryInfoList->Content->children();
	$data0 = @array();
	foreach($data0_obj as $value0){
		$data0_tmp = @array();
		$data0_tmp['IsHidden'] = @$value0->IsHidden;
		$data0_tmp['ishidden'] = @$value0->IsHidden;
		$data0_tmp['IsVirtual'] = @$value0->IsVirtual;
		$data0_tmp['isvirtual'] = @$value0->IsVirtual;
		$data0_tmp['Id'] = @(string)$value0->Id;
		$data0_tmp['id'] = @(string)$value0->Id;
		$data0_tmp['ExternalId'] = @(string)$value0->ExternalId;
		$data0_tmp['externalid'] = @(string)$value0->ExternalId;
		$data0_tmp['Name'] = @(string)$value0->Name;
		$data0_tmp['name'] = @(string)$value0->Name;
		$data0_tmp['IsParent'] = @$value0->IsParent;
		$data0_tmp['isparent'] = @$value0->IsParent;
		$data0_tmp['ParentId'] = @(string)$value0->ParentId;
		$data0_tmp['parentid'] = @(string)$value0->ParentId;
		$data0_tmp['ApproxWeight'] = @$value0->ApproxWeight;
		$data0_tmp['approxweight'] = @$value0->ApproxWeight;
if (isset($value0->RootPath)){ $data0_tmp['path'] = $this->_parseCategotyInfo($value0->RootPath->Content->children()); }		$data0[] = @$data0_tmp;
	}
	return $data0;
    }
    public function GetCategoryRootPath($categoryId){
        $params = array(
            'categoryId' => $categoryId
        );
        $params += $this->defaultLogin();
        $simplexml = $this->_getData('GetCategoryRootPath', $params);
        if (!$simplexml) return false;
        
        $data0 = array();
        
if(!isset($data0)){$data0 = array();}

	if(!isset($simplexml->CategoryInfoList->Content) || is_null($simplexml->CategoryInfoList->Content) || !$simplexml->CategoryInfoList->Content)	$data0_obj = @array();

	else
	$data0_obj = @$simplexml->CategoryInfoList->Content->children();
	$data0 = @array();
	foreach($data0_obj as $value0){
		$data0_tmp = @array();
		$data0_tmp['IsHidden'] = @$value0->IsHidden;
		$data0_tmp['ishidden'] = @$value0->IsHidden;
		$data0_tmp['IsVirtual'] = @$value0->IsVirtual;
		$data0_tmp['isvirtual'] = @$value0->IsVirtual;
		$data0_tmp['Id'] = @(string)$value0->Id;
		$data0_tmp['id'] = @(string)$value0->Id;
		$data0_tmp['ExternalId'] = @(string)$value0->ExternalId;
		$data0_tmp['externalid'] = @(string)$value0->ExternalId;
		$data0_tmp['Name'] = @(string)$value0->Name;
		$data0_tmp['name'] = @(string)$value0->Name;
		$data0_tmp['IsParent'] = @$value0->IsParent;
		$data0_tmp['isparent'] = @$value0->IsParent;
		$data0_tmp['ParentId'] = @(string)$value0->ParentId;
		$data0_tmp['parentid'] = @(string)$value0->ParentId;
		$data0_tmp['ApproxWeight'] = @$value0->ApproxWeight;
		$data0_tmp['approxweight'] = @$value0->ApproxWeight;
if (isset($value0->RootPath)){ $data0_tmp['path'] = $this->_parseCategotyInfo($value0->RootPath->Content->children()); }		$data0[] = @$data0_tmp;
	}

	$data0 = array_reverse($data0);
	return $data0;
    }
    public function GetItemRootPath($itemId, $taoBaoCategoryId){
        $params = array(
            'itemId' => $itemId,
	    'taoBaoCategoryId' => $taoBaoCategoryId
        );
        $params += $this->defaultLogin();
        $simplexml = $this->_getData('GetItemRootPath', $params);
        if (!$simplexml) return false;
        
        $data0 = array();
        
if(!isset($data0)){$data0 = array();}

	if(!isset($simplexml->CategoryInfoList->Content) || is_null($simplexml->CategoryInfoList->Content) || !$simplexml->CategoryInfoList->Content)	$data0_obj = @array();

	else
	$data0_obj = @$simplexml->CategoryInfoList->Content->children();
	$data0 = @array();
	foreach($data0_obj as $value0){
		$data0_tmp = @array();
		$data0_tmp['IsHidden'] = @$value0->IsHidden;
		$data0_tmp['ishidden'] = @$value0->IsHidden;
		$data0_tmp['IsVirtual'] = @$value0->IsVirtual;
		$data0_tmp['isvirtual'] = @$value0->IsVirtual;
		$data0_tmp['Id'] = @(string)$value0->Id;
		$data0_tmp['id'] = @(string)$value0->Id;
		$data0_tmp['ExternalId'] = @(string)$value0->ExternalId;
		$data0_tmp['externalid'] = @(string)$value0->ExternalId;
		$data0_tmp['Name'] = @(string)$value0->Name;
		$data0_tmp['name'] = @(string)$value0->Name;
		$data0_tmp['IsParent'] = @$value0->IsParent;
		$data0_tmp['isparent'] = @$value0->IsParent;
		$data0_tmp['ParentId'] = @(string)$value0->ParentId;
		$data0_tmp['parentid'] = @(string)$value0->ParentId;
		$data0_tmp['ApproxWeight'] = @$value0->ApproxWeight;
		$data0_tmp['approxweight'] = @$value0->ApproxWeight;
if (isset($value0->RootPath)){ $data0_tmp['path'] = $this->_parseCategotyInfo($value0->RootPath->Content->children()); }		$data0[] = @$data0_tmp;
	}

	$data0 = array_reverse($data0);
	return $data0;
    }
    public function FindHintCategoryInfoList($hintTitle){
        $params = array(
            'hintTitle' => $hintTitle
        );
        $params += $this->defaultLogin();
        $simplexml = $this->_getData('FindHintCategoryInfoList', $params);
        if (!$simplexml) return false;
        
        $data0 = array();
        
if(!isset($data0)){$data0 = array();}

	if(!isset($simplexml->CategoryInfoList->Content) || is_null($simplexml->CategoryInfoList->Content) || !$simplexml->CategoryInfoList->Content)	$data0_obj = @array();

	else
	$data0_obj = @$simplexml->CategoryInfoList->Content->children();
	$data0 = @array();
	foreach($data0_obj as $value0){
		$data0_tmp = @array();
		$data0_tmp['IsHidden'] = @$value0->IsHidden;
		$data0_tmp['ishidden'] = @$value0->IsHidden;
		$data0_tmp['IsVirtual'] = @$value0->IsVirtual;
		$data0_tmp['isvirtual'] = @$value0->IsVirtual;
		$data0_tmp['Id'] = @(string)$value0->Id;
		$data0_tmp['id'] = @(string)$value0->Id;
		$data0_tmp['ExternalId'] = @(string)$value0->ExternalId;
		$data0_tmp['externalid'] = @(string)$value0->ExternalId;
		$data0_tmp['Name'] = @(string)$value0->Name;
		$data0_tmp['name'] = @(string)$value0->Name;
		$data0_tmp['IsParent'] = @$value0->IsParent;
		$data0_tmp['isparent'] = @$value0->IsParent;
		$data0_tmp['ParentId'] = @(string)$value0->ParentId;
		$data0_tmp['parentid'] = @(string)$value0->ParentId;
		$data0_tmp['ApproxWeight'] = @$value0->ApproxWeight;
		$data0_tmp['approxweight'] = @$value0->ApproxWeight;
if (isset($value0->RootPath)){ $data0_tmp['path'] = $this->_parseCategotyInfo($value0->RootPath->Content->children()); }		$data0[] = @$data0_tmp;
	}
	return $data0;
    }
public function GetCategorySearchProperties($categoryId)
{
$params = array(
'categoryId' => $categoryId
);
$params += $this->defaultLogin();
$simplexml = $this->_getData('GetCategorySearchProperties', $params);
if (!$simplexml) return false;

$data0 = array();

if (!isset($data0)) {
$data0 = array();
}

if (!isset($simplexml->SearchPropertyInfoList->Content) || is_null($simplexml->SearchPropertyInfoList->Content) || !$simplexml->SearchPropertyInfoList->Content) $data0_obj = @array();

else
$data0_obj = @$simplexml->SearchPropertyInfoList->Content->children();
$data = $data0_obj;

$prop = array();
foreach ($data as $value) {
$arr['id'] = (string)$value->Id;
$arr['name'] = (string)$value->Name;

$prop[$arr['id']] = array(
'name' => $arr['name'],
'values' => array(),
);
$properties = $value->Values;
foreach ($properties->PropertyValue as $key => $param) {
$prop_id = (string)$param->Id;
$value_id = (string)$param->Name;
if (!empty($prop_id)) $prop[$arr['id']]['values'][$prop_id] = array(
'id' => $prop_id,
'name' => $value_id,
);
}
}
$data0 = $prop;
return $data0;
}
    public function EditCategoryInfo($sessionId, $categoryId, $xmlCategoryInfo){
        $params = array(
            'sessionId' => $sessionId,
	    'categoryId' => $categoryId,
	    'xmlCategoryInfo' => $xmlCategoryInfo
        );
        $params += $this->defaultLogin();
        $simplexml = $this->_getData('EditCategoryInfo', $params);
        if (!$simplexml) return false;
        
        $data0 = array();
        
if(!isset($data0)){$data0 = array();}
	$data0_obj = @$simplexml->OtapiCategory;
if(!isset($data0['IsHidden'])){$data0['IsHidden'] = array();}
		$data1_obj = @$simplexml->OtapiCategory->IsHidden;
		$data0['IsHidden'] = @$data1_obj;
	$data0['ishidden'] = @$data0['IsHidden'];
if(!isset($data0['IsVirtual'])){$data0['IsVirtual'] = array();}
		$data1_obj = @$simplexml->OtapiCategory->IsVirtual;
		$data0['IsVirtual'] = @$data1_obj;
	$data0['isvirtual'] = @$data0['IsVirtual'];
if(!isset($data0['Id'])){$data0['Id'] = array();}
		$data1_obj = @$simplexml->OtapiCategory->Id;
		$data0['Id'] = @(string)$data1_obj;
	$data0['id'] = @$data0['Id'];
if(!isset($data0['ExternalId'])){$data0['ExternalId'] = array();}
		$data1_obj = @$simplexml->OtapiCategory->ExternalId;
		$data0['ExternalId'] = @(string)$data1_obj;
	$data0['externalid'] = @$data0['ExternalId'];
if(!isset($data0['Name'])){$data0['Name'] = array();}
		$data1_obj = @$simplexml->OtapiCategory->Name;
		$data0['Name'] = @(string)$data1_obj;
	$data0['name'] = @$data0['Name'];
if(!isset($data0['IsParent'])){$data0['IsParent'] = array();}
		$data1_obj = @$simplexml->OtapiCategory->IsParent;
		$data0['IsParent'] = @$data1_obj;
	$data0['isparent'] = @$data0['IsParent'];
if(!isset($data0['ParentId'])){$data0['ParentId'] = array();}
		$data1_obj = @$simplexml->OtapiCategory->ParentId;
		$data0['ParentId'] = @(string)$data1_obj;
	$data0['parentid'] = @$data0['ParentId'];
if(!isset($data0['ApproxWeight'])){$data0['ApproxWeight'] = array();}
		$data1_obj = @$simplexml->OtapiCategory->ApproxWeight;
		$data0['ApproxWeight'] = @$data1_obj;
	$data0['approxweight'] = @$data0['ApproxWeight'];
if(!isset($data0['RootPath'])){$data0['RootPath'] = array();}

	if(!isset($simplexml->OtapiCategory->RootPath->Content) || is_null($simplexml->OtapiCategory->RootPath->Content) || !$simplexml->OtapiCategory->RootPath->Content)		$data1_obj = @array();

	else
		$data1_obj = @$simplexml->OtapiCategory->RootPath->Content->children();
		$data0['RootPath'] = @array();
		foreach($data1_obj as $value1){
			$data0['RootPath'][] = @$value1;
		}
	$data0['rootpath'] = @$data0['RootPath'];
	return $data0;
    }
    public function EditCategoryName($categoryId, $categoryName, $sessionId){
        $params = array(
            'categoryId' => $categoryId,
	    'categoryName' => $categoryName,
	    'sessionId' => $sessionId
        );
        $params += $this->defaultLogin();
        $simplexml = $this->_getData('EditCategoryName', $params);
        if (!$simplexml) return false;
        
        $data0 = array();
        
if(!isset($data0)){$data0 = array();}
	$data0_obj = @$simplexml;
	$data0 = @$data0_obj;
	return $data0;
    }
    public function EditCategoryNameByLanguage($sessionId, $categoryId, $categoryName){
        $params = array(
            'sessionId' => $sessionId,
	    'categoryId' => $categoryId,
	    'categoryName' => $categoryName
        );
        $params += $this->defaultLogin();
        $simplexml = $this->_getData('EditCategoryNameByLanguage', $params);
        if (!$simplexml) return false;
        
        $data0 = array();
        
if(!isset($data0)){$data0 = array();}
	$data0_obj = @$simplexml;
	$data0 = @$data0_obj;
	return $data0;
    }
    public function EditCategoryParent($sessionId, $categoryId, $parentCategoryId){
        $params = array(
            'sessionId' => $sessionId,
	    'categoryId' => $categoryId,
	    'parentCategoryId' => $parentCategoryId
        );
        $params += $this->defaultLogin();
        $simplexml = $this->_getData('EditCategoryParent', $params);
        if (!$simplexml) return false;
        
        $data0 = array();
        
if(!isset($data0)){$data0 = array();}
	$data0_obj = @$simplexml;
	$data0 = @$data0_obj;
	return $data0;
    }
    public function EditCategoryExternalId($categoryId, $externalCategoryId, $sessionId){
        $params = array(
            'categoryId' => $categoryId,
	    'externalCategoryId' => $externalCategoryId,
	    'sessionId' => $sessionId
        );
        $params += $this->defaultLogin();
        $simplexml = $this->_getData('EditCategoryExternalId', $params);
        if (!$simplexml) return false;
        
        $data0 = array();
        
if(!isset($data0)){$data0 = array();}
	$data0_obj = @$simplexml;
	$data0 = @$data0_obj;
	return $data0;
    }
    public function EditCategoriesVisible($categoriesVisibleSettings, $sessionId){
        $params = array(
            'categoriesVisibleSettings' => $categoriesVisibleSettings,
	    'sessionId' => $sessionId
        );
        $params += $this->defaultLogin();
        $simplexml = $this->_getData('EditCategoriesVisible', $params);
        if (!$simplexml) return false;
        
        $data0 = array();
        
if(!isset($data0)){$data0 = array();}
	$data0_obj = @$simplexml;
	$data0 = @$data0_obj;
	return $data0;
    }
    public function EditOrderOfCategory($index, $categoryId, $sessionId){
        $params = array(
            'index' => $index,
	    'categoryId' => $categoryId,
	    'sessionId' => $sessionId
        );
        $params += $this->defaultLogin();
        $simplexml = $this->_getData('EditOrderOfCategory', $params);
        if (!$simplexml) return false;
        
        $data0 = array();
        
if(!isset($data0)){$data0 = array();}
	$data0_obj = @$simplexml;
	$data0 = @$data0_obj;
	return $data0;
    }
    public function AddCategory($categoryName, $parentCategoryId, $sessionId, $categoryId){
        $params = array(
            'categoryName' => $categoryName,
	    'parentCategoryId' => $parentCategoryId,
	    'sessionId' => $sessionId,
	    'categoryId' => $categoryId
        );
        $params += $this->defaultLogin();
        $simplexml = $this->_getData('AddCategory', $params);
        if (!$simplexml) return false;
        
        $data0 = array();
        
if(!isset($data0)){$data0 = array();}
	$data0_obj = @$simplexml->CategoryId->Value;
	$data0 = @$data0_obj;
	return $data0;
    }
    public function AddCategoryByLanguage($sessionId, $categoryName, $parentCategoryId, $categoryId){
        $params = array(
            'sessionId' => $sessionId,
	    'categoryName' => $categoryName,
	    'parentCategoryId' => $parentCategoryId,
	    'categoryId' => $categoryId
        );
        $params += $this->defaultLogin();
        $simplexml = $this->_getData('AddCategoryByLanguage', $params);
        if (!$simplexml) return false;
        
        $data0 = array();
        
if(!isset($data0)){$data0 = array();}
	$data0_obj = @$simplexml->CategoryId->Value;
	$data0 = @$data0_obj;
	return $data0;
    }
    public function RemoveCategory($sessionId, $categoryId){
        $params = array(
            'sessionId' => $sessionId,
	    'categoryId' => $categoryId
        );
        $params += $this->defaultLogin();
        $simplexml = $this->_getData('RemoveCategory', $params);
        if (!$simplexml) return false;
        
        $data0 = array();
        
if(!isset($data0)){$data0 = array();}
	$data0_obj = @$simplexml;
	$data0 = @$data0_obj;
	return $data0;
    }
    public function ImportStructure($sessionId, $source){
        $params = array(
            'sessionId' => $sessionId,
	    'source' => $source
        );
        $params += $this->defaultLogin();
        $simplexml = $this->_getData('ImportStructure', $params);
        if (!$simplexml) return false;
        
        $data0 = array();
        
if(!isset($data0)){$data0 = array();}
	$data0_obj = @$simplexml;
	$data0 = @$data0_obj;
	return $data0;
    }
    public function ImportStructureByLanguage($sessionId, $source){
        $params = array(
            'sessionId' => $sessionId,
	    'source' => $source
        );
        $params += $this->defaultLogin();
        $simplexml = $this->_getData('ImportStructureByLanguage', $params);
        if (!$simplexml) return false;
        
        $data0 = array();
        
if(!isset($data0)){$data0 = array();}
	$data0_obj = @$simplexml;
	$data0 = @$data0_obj;
	return $data0;
    }
    public function ExportStructure($sessionId){
        $params = array(
            'sessionId' => $sessionId
        );
        $params += $this->defaultLogin();
        $simplexml = $this->_getData('ExportStructure', $params);
        if (!$simplexml) return false;
        
        $data0 = array();
        
if(!isset($data0)){$data0 = array();}
	$data0_obj = @$simplexml->Content;
	$data0 = @(string)$data0_obj;
	return $data0;
    }
    public function ExportStructureByLanguage($sessionId){
        $params = array(
            'sessionId' => $sessionId
        );
        $params += $this->defaultLogin();
        $simplexml = $this->_getData('ExportStructureByLanguage', $params);
        if (!$simplexml) return false;
        
        $data0 = array();
        
if(!isset($data0)){$data0 = array();}
	$data0_obj = @$simplexml->Content;
	$data0 = @(string)$data0_obj;
	return $data0;
    }
    public function SearchDeletedCategoriesIds($sessionId){
        $params = array(
            'sessionId' => $sessionId
        );
        $params += $this->defaultLogin();
        $simplexml = $this->_getData('SearchDeletedCategoriesIds', $params);
        if (!$simplexml) return false;
        
        $data0 = array();
        
if(!isset($data0)){$data0 = array();}

	if(!isset($simplexml->CategoryInfoList->Content) || is_null($simplexml->CategoryInfoList->Content) || !$simplexml->CategoryInfoList->Content)	$data0_obj = @array();

	else
	$data0_obj = @$simplexml->CategoryInfoList->Content->children();
	$data0 = @array();
	foreach($data0_obj as $value0){
		$data0_tmp = @array();
		$data0_tmp['IsHidden'] = @$value0->IsHidden;
		$data0_tmp['ishidden'] = @$value0->IsHidden;
		$data0_tmp['IsVirtual'] = @$value0->IsVirtual;
		$data0_tmp['isvirtual'] = @$value0->IsVirtual;
		$data0_tmp['Id'] = @(string)$value0->Id;
		$data0_tmp['id'] = @(string)$value0->Id;
		$data0_tmp['ExternalId'] = @(string)$value0->ExternalId;
		$data0_tmp['externalid'] = @(string)$value0->ExternalId;
		$data0_tmp['Name'] = @(string)$value0->Name;
		$data0_tmp['name'] = @(string)$value0->Name;
		$data0_tmp['IsParent'] = @$value0->IsParent;
		$data0_tmp['isparent'] = @$value0->IsParent;
		$data0_tmp['ParentId'] = @(string)$value0->ParentId;
		$data0_tmp['parentid'] = @(string)$value0->ParentId;
		$data0_tmp['ApproxWeight'] = @$value0->ApproxWeight;
		$data0_tmp['approxweight'] = @$value0->ApproxWeight;
if (isset($value0->RootPath)){ $data0_tmp['path'] = $this->_parseCategotyInfo($value0->RootPath->Content->children()); }		$data0[] = @$data0_tmp;
	}
	return $data0;
    }
    public function HideDeletedCategoriesWithoutChildren($sessionId){
        $params = array(
            'sessionId' => $sessionId
        );
        $params += $this->defaultLogin();
        $simplexml = $this->_getData('HideDeletedCategoriesWithoutChildren', $params);
        if (!$simplexml) return false;
        
        $data0 = array();
        
if(!isset($data0)){$data0 = array();}
	$data0_obj = @$simplexml;
	$data0 = @$data0_obj;
	return $data0;
    }
    public function GetEditableCategorySubcategories($sessionId, $parentCategoryId, $needHighlightParentsOfDeletedCategories){
        $params = array(
            'sessionId' => $sessionId,
	    'parentCategoryId' => $parentCategoryId,
	    'needHighlightParentsOfDeletedCategories' => $needHighlightParentsOfDeletedCategories
        );
        $params += $this->defaultLogin();
        $simplexml = $this->_getData('GetEditableCategorySubcategories', $params);
        if (!$simplexml) return false;
        
        $data0 = array();
        
if(!isset($data0)){$data0 = array();}

	if(!isset($simplexml->Result->Content) || is_null($simplexml->Result->Content) || !$simplexml->Result->Content)	$data0_obj = @array();

	else
	$data0_obj = @$simplexml->Result->Content->children();
	$data0 = @array();
	foreach($data0_obj as $value0){
		$data0_tmp = @array();
		$data0_tmp['IsHidden'] = @$value0->IsHidden;
		$data0_tmp['ishidden'] = @$value0->IsHidden;
		$data0_tmp['IsVirtual'] = @$value0->IsVirtual;
		$data0_tmp['isvirtual'] = @$value0->IsVirtual;
		$data0_tmp['Id'] = @(string)$value0->Id;
		$data0_tmp['id'] = @(string)$value0->Id;
		$data0_tmp['ExternalId'] = @(string)$value0->ExternalId;
		$data0_tmp['externalid'] = @(string)$value0->ExternalId;
		$data0_tmp['Name'] = @(string)$value0->Name;
		$data0_tmp['name'] = @(string)$value0->Name;
		$data0_tmp['IsParent'] = @$value0->IsParent;
		$data0_tmp['isparent'] = @$value0->IsParent;
		$data0_tmp['ParentId'] = @(string)$value0->ParentId;
		$data0_tmp['parentid'] = @(string)$value0->ParentId;
		$data0_tmp['ApproxWeight'] = @$value0->ApproxWeight;
		$data0_tmp['approxweight'] = @$value0->ApproxWeight;
if (isset($value0->RootPath)){ $data0_tmp['path'] = $this->_parseCategotyInfo($value0->RootPath->Content->children()); }if(!isset($data0_tmp['SearchParameters'])){$data0_tmp['SearchParameters'] = array();}
		$data1_obj = @$value0->SearchParameters;
if(!isset($data0_tmp['SearchParameters']['CategoryId'])){$data0_tmp['SearchParameters']['CategoryId'] = array();}
			$data2_obj = @$value0->SearchParameters->CategoryId;
			$data0_tmp['SearchParameters']['CategoryId'] = @(string)$data2_obj;
		$data0_tmp['SearchParameters']['categoryid'] = @$data0_tmp['SearchParameters']['CategoryId'];
		$data0_tmp['SearchParameters'] = @array();
		foreach($data1_obj as $value1){
			$data0_tmp['SearchParameters'][] = @$value1;
		}
if(!isset($data0_tmp['SearchParameters']['VendorAreaId'])){$data0_tmp['SearchParameters']['VendorAreaId'] = array();}
			$data2_obj = @$value0->SearchParameters->VendorAreaId;
			$data0_tmp['SearchParameters']['VendorAreaId'] = @(string)$data2_obj;
		$data0_tmp['SearchParameters']['vendorareaid'] = @$data0_tmp['SearchParameters']['VendorAreaId'];
if(!isset($data0_tmp['SearchParameters']['ItemTitle'])){$data0_tmp['SearchParameters']['ItemTitle'] = array();}
			$data2_obj = @$value0->SearchParameters->ItemTitle;
			$data0_tmp['SearchParameters']['ItemTitle'] = @(string)$data2_obj;
		$data0_tmp['SearchParameters']['itemtitle'] = @$data0_tmp['SearchParameters']['ItemTitle'];
if(!isset($data0_tmp['SearchParameters']['LanguageOfQuery'])){$data0_tmp['SearchParameters']['LanguageOfQuery'] = array();}
			$data2_obj = @$value0->SearchParameters->LanguageOfQuery;
			$data0_tmp['SearchParameters']['LanguageOfQuery'] = @(string)$data2_obj;
		$data0_tmp['SearchParameters']['languageofquery'] = @$data0_tmp['SearchParameters']['LanguageOfQuery'];
if(!isset($data0_tmp['SearchParameters']['MinPrice'])){$data0_tmp['SearchParameters']['MinPrice'] = array();}
			$data2_obj = @$value0->SearchParameters->MinPrice;
			$data0_tmp['SearchParameters']['MinPrice'] = @$data2_obj;
		$data0_tmp['SearchParameters']['minprice'] = @$data0_tmp['SearchParameters']['MinPrice'];
if(!isset($data0_tmp['SearchParameters']['MaxPrice'])){$data0_tmp['SearchParameters']['MaxPrice'] = array();}
			$data2_obj = @$value0->SearchParameters->MaxPrice;
			$data0_tmp['SearchParameters']['MaxPrice'] = @$data2_obj;
		$data0_tmp['SearchParameters']['maxprice'] = @$data0_tmp['SearchParameters']['MaxPrice'];
if(!isset($data0_tmp['SearchParameters']['MinQuantity'])){$data0_tmp['SearchParameters']['MinQuantity'] = array();}
			$data2_obj = @$value0->SearchParameters->MinQuantity;
			$data0_tmp['SearchParameters']['MinQuantity'] = @$data2_obj;
		$data0_tmp['SearchParameters']['minquantity'] = @$data0_tmp['SearchParameters']['MinQuantity'];
if(!isset($data0_tmp['SearchParameters']['MaxQuantity'])){$data0_tmp['SearchParameters']['MaxQuantity'] = array();}
			$data2_obj = @$value0->SearchParameters->MaxQuantity;
			$data0_tmp['SearchParameters']['MaxQuantity'] = @$data2_obj;
		$data0_tmp['SearchParameters']['maxquantity'] = @$data0_tmp['SearchParameters']['MaxQuantity'];
if(!isset($data0_tmp['SearchParameters']['MinVendorRating'])){$data0_tmp['SearchParameters']['MinVendorRating'] = array();}
			$data2_obj = @$value0->SearchParameters->MinVendorRating;
			$data0_tmp['SearchParameters']['MinVendorRating'] = @$data2_obj;
		$data0_tmp['SearchParameters']['minvendorrating'] = @$data0_tmp['SearchParameters']['MinVendorRating'];
if(!isset($data0_tmp['SearchParameters']['MaxVendorRating'])){$data0_tmp['SearchParameters']['MaxVendorRating'] = array();}
			$data2_obj = @$value0->SearchParameters->MaxVendorRating;
			$data0_tmp['SearchParameters']['MaxVendorRating'] = @$data2_obj;
		$data0_tmp['SearchParameters']['maxvendorrating'] = @$data0_tmp['SearchParameters']['MaxVendorRating'];
if(!isset($data0_tmp['SearchParameters']['BrandPropertyValueId'])){$data0_tmp['SearchParameters']['BrandPropertyValueId'] = array();}
			$data2_obj = @$value0->SearchParameters->BrandPropertyValueId;
			$data0_tmp['SearchParameters']['BrandPropertyValueId'] = @(string)$data2_obj;
		$data0_tmp['SearchParameters']['brandpropertyvalueid'] = @$data0_tmp['SearchParameters']['BrandPropertyValueId'];
if(!isset($data0_tmp['SearchParameters']['Configurators'])){$data0_tmp['SearchParameters']['Configurators'] = array();}

	if(!isset($value0->SearchParameters->Configurators) || is_null($value0->SearchParameters->Configurators) || !$value0->SearchParameters->Configurators)			$data2_obj = @array();

	else
			$data2_obj = @$value0->SearchParameters->Configurators->children();
			$data0_tmp['SearchParameters']['Configurators'] = @array();
			foreach($data2_obj as $value2){
				$data2_tmp = @array();
				$data2_tmp['Pid'] = @$value2['Pid'];
				$data2_tmp['Vid'] = @$value2['Vid'];
				$data0_tmp['SearchParameters']['Configurators'][] = @$data2_tmp;
			}
		$data0_tmp['SearchParameters']['configurators'] = @$data0_tmp['SearchParameters']['Configurators'];
if(!isset($data0_tmp['SearchParameters']['OrderBy'])){$data0_tmp['SearchParameters']['OrderBy'] = array();}
			$data2_obj = @$value0->SearchParameters->OrderBy;
			$data0_tmp['SearchParameters']['OrderBy'] = @(string)$data2_obj;
		$data0_tmp['SearchParameters']['orderby'] = @$data0_tmp['SearchParameters']['OrderBy'];
if(!isset($data0_tmp['SearchParameters']['CategoryMode'])){$data0_tmp['SearchParameters']['CategoryMode'] = array();}
			$data2_obj = @$value0->SearchParameters->CategoryMode;
			$data0_tmp['SearchParameters']['CategoryMode'] = @$data2_obj;
		$data0_tmp['SearchParameters']['categorymode'] = @$data0_tmp['SearchParameters']['CategoryMode'];
if(!isset($data0_tmp['SearchParameters']['IsOriginal'])){$data0_tmp['SearchParameters']['IsOriginal'] = array();}
			$data2_obj = @$value0->SearchParameters->IsOriginal;
			$data0_tmp['SearchParameters']['IsOriginal'] = @$data2_obj;
		$data0_tmp['SearchParameters']['isoriginal'] = @$data0_tmp['SearchParameters']['IsOriginal'];
if(!isset($data0_tmp['SearchParameters']['IsTmall'])){$data0_tmp['SearchParameters']['IsTmall'] = array();}
			$data2_obj = @$value0->SearchParameters->IsTmall;
			$data0_tmp['SearchParameters']['IsTmall'] = @$data2_obj;
		$data0_tmp['SearchParameters']['istmall'] = @$data0_tmp['SearchParameters']['IsTmall'];
if(!isset($data0_tmp['SearchParameters']['StuffStatus'])){$data0_tmp['SearchParameters']['StuffStatus'] = array();}
			$data2_obj = @$value0->SearchParameters->StuffStatus;
			$data0_tmp['SearchParameters']['StuffStatus'] = @$data2_obj;
		$data0_tmp['SearchParameters']['stuffstatus'] = @$data0_tmp['SearchParameters']['StuffStatus'];
if(!isset($data0_tmp['SearchParameters']['Features'])){$data0_tmp['SearchParameters']['Features'] = array();}

	if(!isset($value0->SearchParameters->Features) || is_null($value0->SearchParameters->Features) || !$value0->SearchParameters->Features)			$data2_obj = @array();

	else
			$data2_obj = @$value0->SearchParameters->Features->children();
			$data0_tmp['SearchParameters']['Features'] = @array();
			foreach($data2_obj as $value2){
				$data0_tmp['SearchParameters']['Features'][] = @$value2;
			}
		$data0_tmp['SearchParameters']['features'] = @$data0_tmp['SearchParameters']['Features'];
if(!isset($data0_tmp['SearchParameters']['IsClearItemTitles'])){$data0_tmp['SearchParameters']['IsClearItemTitles'] = array();}
			$data2_obj = @$value0->SearchParameters->IsClearItemTitles;
			$data0_tmp['SearchParameters']['IsClearItemTitles'] = @$data2_obj;
		$data0_tmp['SearchParameters']['isclearitemtitles'] = @$data0_tmp['SearchParameters']['IsClearItemTitles'];
		$data0_tmp['DeleteStatus'] = @$value0->DeleteStatus;
		$data0_tmp['deletestatus'] = @$value0->DeleteStatus;
		$data0[] = @$data0_tmp;
	}
	return $data0;
    }
    public function GetInstanceCurrenciesSettings($sessionId){
        $params = array(
            'sessionId' => $sessionId
        );
        $params += $this->defaultLogin();
        $simplexml = $this->_getData('GetInstanceCurrenciesSettings', $params);
        if (!$simplexml) return false;

        $data0_obj = $simplexml->Result;
        
        $data0 = array();

        $data0['SyncMode'] = (string)$simplexml->Result->SyncMode;
	$data0['syncmode'] = $data0['SyncMode'];
        $data0['InternalCurrencyCode'] = (string)$simplexml->Result->InternalCurrencyCode;
	$data0['internalcurrencycode'] = $data0['InternalCurrencyCode'];

    $data0['MarginRate'] = (string)$simplexml->Result->MarginRate;

    if(is_null($simplexml->Result->CurrencyRateList) || !$simplexml->Result->CurrencyRateList) {
            $data1_obj = array();
        } else {
            $data1_obj = $simplexml->Result->CurrencyRateList->children();
        }
        
        $data0['CurrencyRateList'] = array();
        foreach($data1_obj as $value1){
            $data1_tmp = array();
            $data1_tmp['FirstCode'] = (string)$value1['FirstCode'];
            $data1_tmp['firstcode'] = (string)$value1['FirstCode'];
            $data1_tmp['SecondCode'] = (string)$value1['SecondCode'];
            $data1_tmp['secondcode'] = (string)$value1['SecondCode'];
            $data1_tmp['Rate'] = (string)$value1[0];
            $data1_tmp['rate'] = (string)$value1[0];
            $data0['CurrencyRateList'][] = $data1_tmp;
        }
        
	$data0['currencyratelist'] = $data0['CurrencyRateList'];

	if(is_null($simplexml->Result->CurrenciesDisplayingOrder) || 
                !$simplexml->Result->CurrenciesDisplayingOrder)	{	
            $data1_obj = array();
        } else {
            $data1_obj = $simplexml->Result->CurrenciesDisplayingOrder->children();
        }
       
        $data0['CurrenciesDisplayingOrder'] = array();
        foreach($data1_obj as $value1){
            $data1_tmp = array();
            $data1_tmp['Code'] = (string)$value1['Code'];
            $data1_tmp['code'] = (string)$value1['Code'];
            $data1_tmp['Order'] = (string)$value1['Order'];
            $data1_tmp['order'] = (string)$value1['Order'];
            $data0['CurrenciesDisplayingOrder'][] = $data1_tmp;
        }
        
	$data0['currenciesdisplayingorder'] = $data0['CurrenciesDisplayingOrder'];
	return $data0;
    }
    public function UpdateInstanceCurrenciesSettings($sessionId, $xmlSettings){
        $params = array(
            'sessionId' => $sessionId,
	    'xmlSettings' => $xmlSettings
        );
        $params += $this->defaultLogin();
        $simplexml = $this->_getData('UpdateInstanceCurrenciesSettings', $params);
        if (!$simplexml) return false;
        
        $data0 = array();
        
if(!isset($data0)){$data0 = array();}
	$data0_obj = @$simplexml;
	$data0 = @$data0_obj;
	return $data0;
    }
    public function GetCurrencyList($sessionId){
        $params = array(
            'sessionId' => $sessionId
        );
        $params += $this->defaultLogin();
        $simplexml = $this->_getData('GetCurrencyList', $params);
        if (!$simplexml) return false;
        
        $data0 = array();
        
if(!isset($data0)){$data0 = array();}

	if(!isset($simplexml->Result->Content) || is_null($simplexml->Result->Content) || !$simplexml->Result->Content)	$data0_obj = @array();

	else
	$data0_obj = @$simplexml->Result->Content->children();
	$data0 = @array();
	foreach($data0_obj as $value0){
		$data0_tmp = @array();
		$data0_tmp['Code'] = @(string)$value0->Code;
		$data0_tmp['code'] = @(string)$value0->Code;
		$data0_tmp['Description'] = @(string)$value0->Description;
		$data0_tmp['description'] = @(string)$value0->Description;
		$data0_tmp['Sign'] = @(string)$value0->Sign;
		$data0_tmp['sign'] = @(string)$value0->Sign;
		$data0[] = @$data0_tmp;
	}
	return $data0;
    }
    public function GetCurrencySynchronizationModeList($sessionId){
        $params = array(
            'sessionId' => $sessionId
        );
        $params += $this->defaultLogin();
        $simplexml = $this->_getData('GetCurrencySynchronizationModeList', $params);
        if (!$simplexml) return false;
        
        $data0 = array();
        
if(!isset($data0)){$data0 = array();}

	if(!isset($simplexml->Result->Content) || is_null($simplexml->Result->Content) || !$simplexml->Result->Content)	$data0_obj = @array();

	else
	$data0_obj = @$simplexml->Result->Content->children();
	$data0 = @array();
	foreach($data0_obj as $value0){
		$data0_tmp = @array();
		$data0_tmp['Name'] = @$value0->Name;
		$data0_tmp['name'] = @$value0->Name;
		$data0_tmp['Description'] = @(string)$value0->Description;
		$data0_tmp['description'] = @(string)$value0->Description;
		$data0[] = @$data0_tmp;
	}
	return $data0;
    }
    public function AddCurrencyRate($sessionId, $firstCurrencyCode, $secondCurrencyCode, $rate){
        $params = array(
            'sessionId' => $sessionId,
	    'firstCurrencyCode' => $firstCurrencyCode,
	    'secondCurrencyCode' => $secondCurrencyCode,
	    'rate' => $rate
        );
        $params += $this->defaultLogin();
        $simplexml = $this->_getData('AddCurrencyRate', $params);
        if (!$simplexml) return false;
        
        $data0 = array();
        
if(!isset($data0)){$data0 = array();}
	$data0_obj = @$simplexml;
	$data0 = @$data0_obj;
	return $data0;
    }
    public function RemoveCurrencyRate($sessionId, $firstCurrencyCode, $secondCurrencyCode){
        $params = array(
            'sessionId' => $sessionId,
	    'firstCurrencyCode' => $firstCurrencyCode,
	    'secondCurrencyCode' => $secondCurrencyCode
        );
        $params += $this->defaultLogin();
        $simplexml = $this->_getData('RemoveCurrencyRate', $params);
        if (!$simplexml) return false;
        
        $data0 = array();
        
if(!isset($data0)){$data0 = array();}
	$data0_obj = @$simplexml;
	$data0 = @$data0_obj;
	return $data0;
    }
    public function GetDeliveryCountryInfoList(){
        $params = array(
            
        );
        $params += $this->defaultLogin();
        $simplexml = $this->_getData('GetDeliveryCountryInfoList', $params);
        if (!$simplexml) return false;
        
        $data0 = array();
        
if(!isset($data0)){$data0 = array();}

	if(!isset($simplexml->Result->Content) || is_null($simplexml->Result->Content) || !$simplexml->Result->Content)	$data0_obj = @array();

	else
	$data0_obj = @$simplexml->Result->Content->children();
	$data0 = @array();
	foreach($data0_obj as $value0){
		$data0_tmp = @array();
		$data0_tmp['Id'] = @(string)$value0->Id;
		$data0_tmp['id'] = @(string)$value0->Id;
		$data0_tmp['Name'] = @(string)$value0->Name;
		$data0_tmp['name'] = @(string)$value0->Name;
		$data0[] = @$data0_tmp;
	}
	return $data0;
    }
    public function GetExternalDeliveryTypeList($sessionId){
        $params = array(
            'sessionId' => $sessionId
        );
        $params += $this->defaultLogin();
        $simplexml = $this->_getData('GetExternalDeliveryTypeList', $params);
        if (!$simplexml) return false;
        
        $data0 = array();
        
if(!isset($data0)){$data0 = array();}

	if(!isset($simplexml->Result->Content) || is_null($simplexml->Result->Content) || !$simplexml->Result->Content)	$data0_obj = @array();

	else
	$data0_obj = @$simplexml->Result->Content->children();
	$data0 = @array();
	foreach($data0_obj as $value0){
		$data0_tmp = @array();
		$data0_tmp['Id'] = @(string)$value0->Id;
		$data0_tmp['id'] = @(string)$value0->Id;
		$data0_tmp['Name'] = @(string)$value0->Name;
		$data0_tmp['name'] = @(string)$value0->Name;
		$data0_tmp['Description'] = @(string)$value0->Description;
		$data0_tmp['description'] = @(string)$value0->Description;
		$data0_tmp['Formula'] = @(string)$value0->Formula;
		$data0_tmp['formula'] = @(string)$value0->Formula;
		$data0_tmp['CurrencyCode'] = @(string)$value0->CurrencyCode;
		$data0_tmp['currencycode'] = @(string)$value0->CurrencyCode;
		$data0_tmp['Order'] = @(int)$value0->Order;
		$data0_tmp['order'] = @(int)$value0->Order;
		$data0[] = @$data0_tmp;
	}
	return $data0;
    }
    public function RemoveExternalDeliveryType($sessionId, $externalDeliveryTypeId){
        $params = array(
            'sessionId' => $sessionId,
	    'externalDeliveryTypeId' => $externalDeliveryTypeId
        );
        $params += $this->defaultLogin();
        $simplexml = $this->_getData('RemoveExternalDeliveryType', $params);
        if (!$simplexml) return false;
        
        $data0 = array();
        
if(!isset($data0)){$data0 = array();}
	$data0_obj = @$simplexml;
	$data0 = @$data0_obj;
	return $data0;
    }
    public function EditExternalDeliveryType($sessionId, $xmlExternalDeliveryType){
        $params = array(
            'sessionId' => $sessionId,
	    'xmlExternalDeliveryType' => $xmlExternalDeliveryType
        );
        $params += $this->defaultLogin();
        $simplexml = $this->_getData('EditExternalDeliveryType', $params);
        if (!$simplexml) return false;
        
        $data0 = array();
        
if(!isset($data0)){$data0 = array();}
	$data0_obj = @$simplexml;
	$data0 = @$data0_obj;
	return $data0;
    }
    public function CreateExternalDeliveryType($sessionId, $xmlExternalDeliveryType){
        $params = array(
            'sessionId' => $sessionId,
	    'xmlExternalDeliveryType' => $xmlExternalDeliveryType
        );
        $params += $this->defaultLogin();
        $simplexml = $this->_getData('CreateExternalDeliveryType', $params);
        if (!$simplexml) return false;
        
        $data0 = array();
        
if(!isset($data0)){$data0 = array();}
	$data0_obj = @$simplexml->Result;
	$data0 = @(string)$data0_obj;
	return $data0;
    }
    public function GetExternalDeliveryRateList($sessionId){
        $params = array(
            'sessionId' => $sessionId
        );
        $params += $this->defaultLogin();
        $simplexml = $this->_getData('GetExternalDeliveryRateList', $params);
        if (!$simplexml) return false;
        
        $data0 = array();
        
if(!isset($data0)){$data0 = array();}

	if(!isset($simplexml->Result->Content) || is_null($simplexml->Result->Content) || !$simplexml->Result->Content)	$data0_obj = @array();

	else
	$data0_obj = @$simplexml->Result->Content->children();
	$data0 = @array();
	foreach($data0_obj as $value0){
		$data0_tmp = @array();
		$data0_tmp['Id'] = @(int)$value0->Id;
		$data0_tmp['id'] = @(int)$value0->Id;
		$data0_tmp['ExternalDeliveryTypeId'] = @(string)$value0->ExternalDeliveryTypeId;
		$data0_tmp['externaldeliverytypeid'] = @(string)$value0->ExternalDeliveryTypeId;
		$data0_tmp['CountryCode'] = @(string)$value0->CountryCode;
		$data0_tmp['countrycode'] = @(string)$value0->CountryCode;
		$data0_tmp['Start'] = @$value0->Start;
		$data0_tmp['start'] = @$value0->Start;
		$data0_tmp['Step'] = @$value0->Step;
		$data0_tmp['step'] = @$value0->Step;
		$data0_tmp['IsEnabled'] = @(int)$value0->IsEnabled;
		$data0_tmp['isenabled'] = @(int)$value0->IsEnabled;
		$data0[] = @$data0_tmp;
	}
	return $data0;
    }
    public function RemoveExternalDeliveryRate($sessionId, $externalDeliveryRateId){
        $params = array(
            'sessionId' => $sessionId,
	    'externalDeliveryRateId' => $externalDeliveryRateId
        );
        $params += $this->defaultLogin();
        $simplexml = $this->_getData('RemoveExternalDeliveryRate', $params);
        if (!$simplexml) return false;
        
        $data0 = array();
        
if(!isset($data0)){$data0 = array();}
	$data0_obj = @$simplexml;
	$data0 = @$data0_obj;
	return $data0;
    }
    public function EditExternalDeliveryRate($sessionId, $xmlExternalDeliveryRate){
        $params = array(
            'sessionId' => $sessionId,
	    'xmlExternalDeliveryRate' => $xmlExternalDeliveryRate
        );
        $params += $this->defaultLogin();
        $simplexml = $this->_getData('EditExternalDeliveryRate', $params);
        if (!$simplexml) return false;
        
        $data0 = array();
        
if(!isset($data0)){$data0 = array();}
	$data0_obj = @$simplexml;
	$data0 = @$data0_obj;
	return $data0;
    }
    public function CreateExternalDeliveryRate($sessionId, $xmlExternalDeliveryRate){
        $params = array(
            'sessionId' => $sessionId,
	    'xmlExternalDeliveryRate' => $xmlExternalDeliveryRate
        );
        $params += $this->defaultLogin();
        $simplexml = $this->_getData('CreateExternalDeliveryRate', $params);
        if (!$simplexml) return false;
        
        $data0 = array();
        
if(!isset($data0)){$data0 = array();}
	$data0_obj = @$simplexml->Result;
	$data0 = @$data0_obj;
	return $data0;
    }
    public function GetExternalDeliveryType($sessionId, $externalDeliveryTypeId){
        $params = array(
            'sessionId' => $sessionId,
	    'externalDeliveryTypeId' => $externalDeliveryTypeId
        );
        $params += $this->defaultLogin();
        $simplexml = $this->_getData('GetExternalDeliveryType', $params);
        if (!$simplexml) return false;
        
        $data0 = array();
        
if(!isset($data0)){$data0 = array();}
	$data0_obj = @$simplexml->Result;
if(!isset($data0['Id'])){$data0['Id'] = array();}
		$data1_obj = @$simplexml->Result->Id;
		$data0['Id'] = @(string)$data1_obj;
	$data0['id'] = @$data0['Id'];
if(!isset($data0['Name'])){$data0['Name'] = array();}
		$data1_obj = @$simplexml->Result->Name;
		$data0['Name'] = @(string)$data1_obj;
	$data0['name'] = @$data0['Name'];
if(!isset($data0['Description'])){$data0['Description'] = array();}
		$data1_obj = @$simplexml->Result->Description;
		$data0['Description'] = @(string)$data1_obj;
	$data0['description'] = @$data0['Description'];
if(!isset($data0['Formula'])){$data0['Formula'] = array();}
		$data1_obj = @$simplexml->Result->Formula;
		$data0['Formula'] = @(string)$data1_obj;
	$data0['formula'] = @$data0['Formula'];
if(!isset($data0['CurrencyCode'])){$data0['CurrencyCode'] = array();}
		$data1_obj = @$simplexml->Result->CurrencyCode;
		$data0['CurrencyCode'] = @(string)$data1_obj;
	$data0['currencycode'] = @$data0['CurrencyCode'];
if(!isset($data0['Order'])){$data0['Order'] = array();}
		$data1_obj = @$simplexml->Result->Order;
		$data0['Order'] = @$data1_obj;
	$data0['order'] = @$data0['Order'];
	return $data0;
    }
    public function GetExternalDeliveryRate($sessionId, $externalDeliveryRateId){
        $params = array(
            'sessionId' => $sessionId,
	    'externalDeliveryRateId' => $externalDeliveryRateId
        );
        $params += $this->defaultLogin();
        $simplexml = $this->_getData('GetExternalDeliveryRate', $params);
        if (!$simplexml) return false;
        
        $data0 = array();
        
if(!isset($data0)){$data0 = array();}
	$data0_obj = @$simplexml->Result;
if(!isset($data0['Id'])){$data0['Id'] = array();}
		$data1_obj = @$simplexml->Result->Id;
		$data0['Id'] = @$data1_obj;
	$data0['id'] = @$data0['Id'];
if(!isset($data0['ExternalDeliveryTypeId'])){$data0['ExternalDeliveryTypeId'] = array();}
		$data1_obj = @$simplexml->Result->ExternalDeliveryTypeId;
		$data0['ExternalDeliveryTypeId'] = @(string)$data1_obj;
	$data0['externaldeliverytypeid'] = @$data0['ExternalDeliveryTypeId'];
if(!isset($data0['CountryCode'])){$data0['CountryCode'] = array();}
		$data1_obj = @$simplexml->Result->CountryCode;
		$data0['CountryCode'] = @(string)$data1_obj;
	$data0['countrycode'] = @$data0['CountryCode'];
if(!isset($data0['Start'])){$data0['Start'] = array();}
		$data1_obj = @$simplexml->Result->Start;
		$data0['Start'] = @$data1_obj;
	$data0['start'] = @$data0['Start'];
if(!isset($data0['Step'])){$data0['Step'] = array();}
		$data1_obj = @$simplexml->Result->Step;
		$data0['Step'] = @$data1_obj;
	$data0['step'] = @$data0['Step'];
if(!isset($data0['IsEnabled'])){$data0['IsEnabled'] = array();}
		$data1_obj = @$simplexml->Result->IsEnabled;
		$data0['IsEnabled'] = @$data1_obj;
	$data0['isenabled'] = @$data0['IsEnabled'];
	return $data0;
    }
    public function GetDiscountGroupList($sessionId){
        $params = array(
            'sessionId' => $sessionId
        );
        $params += $this->defaultLogin();
        $simplexml = $this->_getData('GetDiscountGroupList', $params);
        if (!$simplexml) return false;
        
        $data0 = array();
        
if(!isset($data0)){$data0 = array();}

	if(!isset($simplexml->Result->Content) || is_null($simplexml->Result->Content) || !$simplexml->Result->Content)	$data0_obj = @array();

	else
	$data0_obj = @$simplexml->Result->Content->children();
	$data0 = @array();
	foreach($data0_obj as $value0){
		$data0_tmp = @array();
		$data0_tmp['Id'] = @$value0->Id;
		$data0_tmp['id'] = @$value0->Id;
		$data0_tmp['Name'] = @(string)$value0->Name;
		$data0_tmp['name'] = @(string)$value0->Name;
		$data0_tmp['Description'] = @(string)$value0->Description;
		$data0_tmp['description'] = @(string)$value0->Description;
if(!isset($data0_tmp['Discount'])){$data0_tmp['Discount'] = array();}
		$data1_obj = @$value0->Discount->Percent;
		$data0_tmp['Discount'] = @$data1_obj;
if(!isset($data0_tmp['DiscountIdentificationParametr'])){$data0_tmp['DiscountIdentificationParametr'] = array();}
		$data1_obj = @$value0->DiscountIdentificationParametr->PurchaseVolume;
		$data0_tmp['DiscountIdentificationParametr'] = @$data1_obj;
		$data0[] = @$data0_tmp;
	}
	return $data0;
    }
    public function FindDiscountGroup($sessionId, $xmlFindParameters){
        $params = array(
            'sessionId' => $sessionId,
	    'xmlFindParameters' => $xmlFindParameters
        );
        $params += $this->defaultLogin();
        $simplexml = $this->_getData('FindDiscountGroup', $params);
        if (!$simplexml) return false;
        
        $data0 = array();
        
if(!isset($data0)){$data0 = array();}
	$data0_obj = @$simplexml->Result;
if(!isset($data0['Id'])){$data0['Id'] = array();}
		$data1_obj = @$simplexml->Result->Id;
		$data0['Id'] = @$data1_obj;
	$data0['id'] = @$data0['Id'];
if(!isset($data0['Name'])){$data0['Name'] = array();}
		$data1_obj = @$simplexml->Result->Name;
		$data0['Name'] = @(string)$data1_obj;
	$data0['name'] = @$data0['Name'];
if(!isset($data0['Description'])){$data0['Description'] = array();}
		$data1_obj = @$simplexml->Result->Description;
		$data0['Description'] = @(string)$data1_obj;
	$data0['description'] = @$data0['Description'];
if(!isset($data0['Discount'])){$data0['Discount'] = array();}
		$data1_obj = @$simplexml->Result->Discount->Percent;
		$data0['Discount'] = @$data1_obj;
	$data0['discount'] = @$data0['Discount'];
if(!isset($data0['DiscountIdentificationParametr'])){$data0['DiscountIdentificationParametr'] = array();}
		$data1_obj = @$simplexml->Result->DiscountIdentificationParametr->PurchaseVolume;
		$data0['DiscountIdentificationParametr'] = @$data1_obj;
	$data0['discountidentificationparametr'] = @$data0['DiscountIdentificationParametr'];
	return $data0;
    }
    public function AddDiscountGroupToInstance($sessionId, $xmlAddData){
        $params = array(
            'sessionId' => $sessionId,
	    'xmlAddData' => $xmlAddData
        );
        $params += $this->defaultLogin();
        $simplexml = $this->_getData('AddDiscountGroupToInstance', $params);
        if (!$simplexml) return false;
        
        $data0 = array();
        
if(!isset($data0)){$data0 = array();}
	$data0_obj = @$simplexml->Result;
	$data0 = @$data0_obj;
	return $data0;
    }
    public function AddUserToDiscountGroup($sessionId, $discountGroupId, $userId){
        $params = array(
            'sessionId' => $sessionId,
	    'discountGroupId' => $discountGroupId,
	    'userId' => $userId
        );
        $params += $this->defaultLogin();
        $simplexml = $this->_getData('AddUserToDiscountGroup', $params);
        if (!$simplexml) return false;
        
        $data0 = array();
        
if(!isset($data0)){$data0 = array();}
	$data0_obj = @$simplexml;
	$data0 = @$data0_obj;
	return $data0;
    }
    public function RemoveDiscountGroupFromInstance($sessionId, $discountGroupId){
        $params = array(
            'sessionId' => $sessionId,
	    'discountGroupId' => $discountGroupId
        );
        $params += $this->defaultLogin();
        $simplexml = $this->_getData('RemoveDiscountGroupFromInstance', $params);
        if (!$simplexml) return false;
        
        $data0 = array();
        
if(!isset($data0)){$data0 = array();}
	$data0_obj = @$simplexml;
	$data0 = @$data0_obj;
	return $data0;
    }
    public function RemoveUserFromDiscountGroup($sessionId, $discountGroupId, $userId){
        $params = array(
            'sessionId' => $sessionId,
	    'discountGroupId' => $discountGroupId,
	    'userId' => $userId
        );
        $params += $this->defaultLogin();
        $simplexml = $this->_getData('RemoveUserFromDiscountGroup', $params);
        if (!$simplexml) return false;
        
        $data0 = array();
        
if(!isset($data0)){$data0 = array();}
	$data0_obj = @$simplexml;
	$data0 = @$data0_obj;
	return $data0;
    }
    public function UpdateDiscountGroup($sessionId, $discountGroupId, $xmlUpdateData){
        $params = array(
            'sessionId' => $sessionId,
	    'discountGroupId' => $discountGroupId,
	    'xmlUpdateData' => $xmlUpdateData
        );
        $params += $this->defaultLogin();
        $simplexml = $this->_getData('UpdateDiscountGroup', $params);
        if (!$simplexml) return false;
        
        $data0 = array();
        
if(!isset($data0)){$data0 = array();}
	$data0_obj = @$simplexml;
	$data0 = @$data0_obj;
	return $data0;
    }
    public function GetDiscountGroup($sessionId){
        $params = array(
            'sessionId' => $sessionId
        );
        $params += $this->defaultLogin();
        $simplexml = $this->_getData('GetDiscountGroup', $params);
        if (!$simplexml) return false;
        
        $data0 = array();
        
if(!isset($data0)){$data0 = array();}
	$data0_obj = @$simplexml->Result;
if(!isset($data0['Id'])){$data0['Id'] = array();}
		$data1_obj = @$simplexml->Result->Id;
		$data0['Id'] = @$data1_obj;
	$data0['id'] = @$data0['Id'];
if(!isset($data0['Name'])){$data0['Name'] = array();}
		$data1_obj = @$simplexml->Result->Name;
		$data0['Name'] = @(string)$data1_obj;
	$data0['name'] = @$data0['Name'];
if(!isset($data0['Description'])){$data0['Description'] = array();}
		$data1_obj = @$simplexml->Result->Description;
		$data0['Description'] = @(string)$data1_obj;
	$data0['description'] = @$data0['Description'];
if(!isset($data0['Discount'])){$data0['Discount'] = array();}
		$data1_obj = @$simplexml->Result->Discount->Percent;
		$data0['Discount'] = @$data1_obj;
	$data0['discount'] = @$data0['Discount'];
if(!isset($data0['DiscountIdentificationParametr'])){$data0['DiscountIdentificationParametr'] = array();}
		$data1_obj = @$simplexml->Result->DiscountIdentificationParametr->PurchaseVolume;
		$data0['DiscountIdentificationParametr'] = @$data1_obj;
	$data0['discountidentificationparametr'] = @$data0['DiscountIdentificationParametr'];
	return $data0;
    }
    public function GetUsersOfDiscountGroup($sessionId, $discountGroupId, $framePosition = 0, $frameSize = 18){
        $params = array(
            'sessionId' => $sessionId,
	    'discountGroupId' => $discountGroupId,
	    'framePosition' => $framePosition,
	    'frameSize' => $frameSize
        );
        $params += $this->defaultLogin();
        $simplexml = $this->_getData('GetUsersOfDiscountGroup', $params);
        if (!$simplexml) return false;
        
        $data0 = array();
        
if(!isset($data0)){$data0 = array();}
	$data0_obj = @$simplexml->Result;
if(!isset($data0['Content'])){$data0['Content'] = array();}

	if(!isset($simplexml->Result->Content) || is_null($simplexml->Result->Content) || !$simplexml->Result->Content)		$data1_obj = @array();

	else
		$data1_obj = @$simplexml->Result->Content->children();
		$data0['Content'] = @array();
		foreach($data1_obj as $value1){
			$data1_tmp = @array();
			$data1_tmp['Id'] = @$value1->Id;
			$data1_tmp['id'] = @$value1->Id;
			$data1_tmp['Login'] = @(string)$value1->Login;
			$data1_tmp['login'] = @(string)$value1->Login;
			$data1_tmp['Email'] = @(string)$value1->Email;
			$data1_tmp['email'] = @(string)$value1->Email;
			$data1_tmp['IsActive'] = @$value1->IsActive;
			$data1_tmp['isactive'] = @$value1->IsActive;
			$data1_tmp['FirstName'] = @(string)$value1->FirstName;
			$data1_tmp['firstname'] = @(string)$value1->FirstName;
			$data1_tmp['LastName'] = @(string)$value1->LastName;
			$data1_tmp['lastname'] = @(string)$value1->LastName;
			$data1_tmp['MiddleName'] = @(string)$value1->MiddleName;
			$data1_tmp['middlename'] = @(string)$value1->MiddleName;
			$data1_tmp['PersonalAccountId'] = @(string)$value1->PersonalAccountId;
			$data1_tmp['personalaccountid'] = @(string)$value1->PersonalAccountId;
			$data0['Content'][] = @$data1_tmp;
		}
	$data0['content'] = @$data0['Content'];
if(!isset($data0['TotalCount'])){$data0['TotalCount'] = array();}
		$data1_obj = @$simplexml->Result->TotalCount;
		$data0['TotalCount'] = @$data1_obj;
	$data0['totalcount'] = @$data0['TotalCount'];
	return $data0;
    }
    public function EditTranslateByKey($sessionId, $text, $key, $idInContext, $lang){
        $params = array(
            'sessionId' => $sessionId,
	    'text' => $text,
	    'key' => $key,
	    'idInContext' => $idInContext,
	    'lang' => $lang
        );
        $params += $this->defaultLogin();
        $simplexml = $this->_getData('EditTranslateByKey', $params);
        if (!$simplexml) return false;
        
        $data0 = array();
        
if(!isset($data0)){$data0 = array();}
	$data0_obj = @$simplexml;
	$data0 = @$data0_obj;
	return $data0;
    }
    public function GetTranslatedListByKey($sessionId, $key, $idInContext){
        $params = array(
            'sessionId' => $sessionId,
	    'key' => $key,
	    'idInContext' => $idInContext
        );
        $params += $this->defaultLogin();
        $simplexml = $this->_getData('GetTranslatedListByKey', $params);
        if (!$simplexml) return false;
        
        $data0 = array();
        
if(!isset($data0)){$data0 = array();}

	if(!isset($simplexml->Result->Content) || is_null($simplexml->Result->Content) || !$simplexml->Result->Content)	$data0_obj = @array();

	else
	$data0_obj = @$simplexml->Result->Content->children();
	$data0 = @array();
	foreach($data0_obj as $value0){
		$data0_tmp = @array();
		$data0_tmp['Text'] = @(string)$value0->Text;
		$data0_tmp['text'] = @(string)$value0->Text;
		$data0_tmp['Lang'] = @(string)$value0->Lang;
		$data0_tmp['lang'] = @(string)$value0->Lang;
		$data0[] = @$data0_tmp;
	}
	return $data0;
    }
    public function GetEnabledFeatures(){
        $params = array(
            
        );
        $params += $this->defaultLogin();
        $simplexml = $this->_getData('GetEnabledFeatures', $params);
        if (!$simplexml) return false;
        
        $data0 = array();
        
if(!isset($data0)){$data0 = array();}

	if(!isset($simplexml->Result->Content) || is_null($simplexml->Result->Content) || !$simplexml->Result->Content)	$data0_obj = @array();

	else
	$data0_obj = @$simplexml->Result->Content->children();
	$data0 = @array();
	foreach($data0_obj as $value0){
		$data0[] = @$value0;
	}
	return $data0;
    }
    public function GetOtapiCallStatistic(){
        $params = array(
            
        );
        $params += $this->defaultLogin();
        $simplexml = $this->_getData('GetOtapiCallStatistic', $params);
        if (!$simplexml) return false;
        
        $data0 = array();
        
if(!isset($data0)){$data0 = array();}
	$data0_obj = @$simplexml->Result;
if(!isset($data0['CallCount'])){$data0['CallCount'] = array();}
		$data1_obj = @$simplexml->Result->CallCount;
		$data0['CallCount'] = @$data1_obj;
	$data0['callcount'] = @$data0['CallCount'];
if(!isset($data0['CallLimit'])){$data0['CallLimit'] = array();}
		$data1_obj = @$simplexml->Result->CallLimit;
		$data0['CallLimit'] = @$data1_obj;
	$data0['calllimit'] = @$data0['CallLimit'];
if(!isset($data0['Period'])){$data0['Period'] = array();}
		$data1_obj = @$simplexml->Result->Period;
		$data0['Period'] = @$data1_obj;
	$data0['period'] = @$data0['Period'];
	return $data0;
    }
    public function ResetInstanceCaches(){
        $params = array(
            
        );
        $params += $this->defaultLogin();
        $simplexml = $this->_getData('ResetInstanceCaches', $params);
        if (!$simplexml) return false;
        
        $data0 = array();
        
if(!isset($data0)){$data0 = array();}
	$data0_obj = @$simplexml;
	$data0 = @$data0_obj;
	return $data0;
    }
    public function GetItemRatingList($itemRatingTypeId, $numberItem, $categoryId){
        $params = array(
            'itemRatingTypeId' => $itemRatingTypeId,
	    'numberItem' => $numberItem,
	    'categoryId' => $categoryId
        );
        $params += $this->defaultLogin();
        $simplexml = $this->_getData('GetItemRatingList', $params);
        if (!$simplexml) return false;
        
        $data0 = array();
        
if(!isset($data0)){$data0 = array();}

	if(!isset($simplexml->Content->Content) || is_null($simplexml->Content->Content) || !$simplexml->Content->Content)	$data0_obj = @array();

	else
	$data0_obj = @$simplexml->Content->Content->children();
	$data0 = $this->_parseItemsInfo($data0_obj);
	return $data0;
    }
    public function GetVendorRatingList($itemRatingTypeId, $numberItem, $categoryId){
        $params = array(
            'itemRatingTypeId' => $itemRatingTypeId,
	    'numberItem' => $numberItem,
	    'categoryId' => $categoryId
        );
        $params += $this->defaultLogin();
        $simplexml = $this->_getData('GetVendorRatingList', $params);
        if (!$simplexml) return false;
        
        $data0 = array();
        
if(!isset($data0)){$data0 = array();}

	if(!isset($simplexml->Result->Content) || is_null($simplexml->Result->Content) || !$simplexml->Result->Content)	$data0_obj = @array();

	else
	$data0_obj = @$simplexml->Result->Content->children();
	$data0 = @array();
	foreach($data0_obj as $value0){
		$data0_tmp = @array();
		$data0_tmp['Id'] = @(string)$value0->Id;
		$data0_tmp['id'] = @(string)$value0->Id;
		$data0_tmp['Name'] = @(string)$value0->Name;
		$data0_tmp['name'] = @(string)$value0->Name;
		$data0_tmp['Sex'] = @$value0->Sex;
		$data0_tmp['sex'] = @$value0->Sex;
		$data0_tmp['Email'] = @(string)$value0->Email;
		$data0_tmp['email'] = @(string)$value0->Email;
		$data0_tmp['PictureUrl'] = @(string)$value0->PictureUrl;
		$data0_tmp['pictureurl'] = @(string)$value0->PictureUrl;
if(!isset($data0_tmp['Location'])){$data0_tmp['Location'] = array();}
		$data1_obj = @$value0->Location;
if(!isset($data0_tmp['Location']['City'])){$data0_tmp['Location']['City'] = array();}
			$data2_obj = @$value0->Location->City;
			$data0_tmp['Location']['City'] = @(string)$data2_obj;
		$data0_tmp['Location']['city'] = @$data0_tmp['Location']['City'];
if(!isset($data0_tmp['Location']['State'])){$data0_tmp['Location']['State'] = array();}
			$data2_obj = @$value0->Location->State;
			$data0_tmp['Location']['State'] = @(string)$data2_obj;
		$data0_tmp['Location']['state'] = @$data0_tmp['Location']['State'];
if(!isset($data0_tmp['Location']['Country'])){$data0_tmp['Location']['Country'] = array();}
			$data2_obj = @$value0->Location->Country;
			$data0_tmp['Location']['Country'] = @(string)$data2_obj;
		$data0_tmp['Location']['country'] = @$data0_tmp['Location']['Country'];
if(!isset($data0_tmp['Location']['District'])){$data0_tmp['Location']['District'] = array();}
			$data2_obj = @$value0->Location->District;
			$data0_tmp['Location']['District'] = @(string)$data2_obj;
		$data0_tmp['Location']['district'] = @$data0_tmp['Location']['District'];
if(!isset($data0_tmp['Location']['Zip'])){$data0_tmp['Location']['Zip'] = array();}
			$data2_obj = @$value0->Location->Zip;
			$data0_tmp['Location']['Zip'] = @(string)$data2_obj;
		$data0_tmp['Location']['zip'] = @$data0_tmp['Location']['Zip'];
if(!isset($data0_tmp['Location']['Address'])){$data0_tmp['Location']['Address'] = array();}
			$data2_obj = @$value0->Location->Address;
			$data0_tmp['Location']['Address'] = @(string)$data2_obj;
		$data0_tmp['Location']['address'] = @$data0_tmp['Location']['Address'];
if(!isset($data0_tmp['Location']['AreaId'])){$data0_tmp['Location']['AreaId'] = array();}
			$data2_obj = @$value0->Location->AreaId;
			$data0_tmp['Location']['AreaId'] = @(string)$data2_obj;
		$data0_tmp['Location']['areaid'] = @$data0_tmp['Location']['AreaId'];
if(!isset($data0_tmp['Credit'])){$data0_tmp['Credit'] = array();}
		$data1_obj = @$value0->Credit;
if(!isset($data0_tmp['Credit']['Level'])){$data0_tmp['Credit']['Level'] = array();}
			$data2_obj = @$value0->Credit->Level;
			$data0_tmp['Credit']['Level'] = @$data2_obj;
		$data0_tmp['Credit']['level'] = @$data0_tmp['Credit']['Level'];
if(!isset($data0_tmp['Credit']['Score'])){$data0_tmp['Credit']['Score'] = array();}
			$data2_obj = @$value0->Credit->Score;
			$data0_tmp['Credit']['Score'] = @$data2_obj;
		$data0_tmp['Credit']['score'] = @$data0_tmp['Credit']['Score'];
if(!isset($data0_tmp['Credit']['TotalFeedbacks'])){$data0_tmp['Credit']['TotalFeedbacks'] = array();}
			$data2_obj = @$value0->Credit->TotalFeedbacks;
			$data0_tmp['Credit']['TotalFeedbacks'] = @$data2_obj;
		$data0_tmp['Credit']['totalfeedbacks'] = @$data0_tmp['Credit']['TotalFeedbacks'];
if(!isset($data0_tmp['Credit']['PositiveFeedbacks'])){$data0_tmp['Credit']['PositiveFeedbacks'] = array();}
			$data2_obj = @$value0->Credit->PositiveFeedbacks;
			$data0_tmp['Credit']['PositiveFeedbacks'] = @$data2_obj;
		$data0_tmp['Credit']['positivefeedbacks'] = @$data0_tmp['Credit']['PositiveFeedbacks'];
if(!isset($data0_tmp['Features'])){$data0_tmp['Features'] = array();}

	if(!isset($value0->Features) || is_null($value0->Features) || !$value0->Features)		$data1_obj = @array();

	else
		$data1_obj = @$value0->Features->children();
		$data0_tmp['Features'] = @array();
		foreach($data1_obj as $value1){
			$data0_tmp['Features'][] = @$value1;
		}
		$data0[] = @$data0_tmp;
	}
	return $data0;
    }
    public function GetSearchStringRatingList($itemRatingTypeId, $numberItem, $categoryId){
        $params = array(
            'itemRatingTypeId' => $itemRatingTypeId,
	    'numberItem' => $numberItem,
	    'categoryId' => $categoryId
        );
        $params += $this->defaultLogin();
        $simplexml = $this->_getData('GetSearchStringRatingList', $params);
        if (!$simplexml) return false;
        
        $data0 = array();
        
if(!isset($data0)){$data0 = array();}

	if(!isset($simplexml->Result->Content) || is_null($simplexml->Result->Content) || !$simplexml->Result->Content)	$data0_obj = @array();

	else
	$data0_obj = @$simplexml->Result->Content->children();
	$data0 = @array();
	foreach($data0_obj as $value0){
		$data0[] = @$value0;
	}
	return $data0;
    }
    public function GetCategoryRatingList($itemRatingTypeId, $numberItem, $categoryId){
        $params = array(
            'itemRatingTypeId' => $itemRatingTypeId,
	    'numberItem' => $numberItem,
	    'categoryId' => $categoryId
        );
        $params += $this->defaultLogin();
        $simplexml = $this->_getData('GetCategoryRatingList', $params);
        if (!$simplexml) return false;
        
        $data0 = array();
        
if(!isset($data0)){$data0 = array();}

	if(!isset($simplexml->CategoryInfoList->Content) || is_null($simplexml->CategoryInfoList->Content) || !$simplexml->CategoryInfoList->Content)	$data0_obj = @array();

	else
	$data0_obj = @$simplexml->CategoryInfoList->Content->children();
	$data0 = @array();
	foreach($data0_obj as $value0){
		$data0_tmp = @array();
		$data0_tmp['IsHidden'] = @$value0->IsHidden;
		$data0_tmp['ishidden'] = @$value0->IsHidden;
		$data0_tmp['IsVirtual'] = @$value0->IsVirtual;
		$data0_tmp['isvirtual'] = @$value0->IsVirtual;
		$data0_tmp['Id'] = @(string)$value0->Id;
		$data0_tmp['id'] = @(string)$value0->Id;
		$data0_tmp['ExternalId'] = @(string)$value0->ExternalId;
		$data0_tmp['externalid'] = @(string)$value0->ExternalId;
		$data0_tmp['Name'] = @(string)$value0->Name;
		$data0_tmp['name'] = @(string)$value0->Name;
		$data0_tmp['IsParent'] = @$value0->IsParent;
		$data0_tmp['isparent'] = @$value0->IsParent;
		$data0_tmp['ParentId'] = @(string)$value0->ParentId;
		$data0_tmp['parentid'] = @(string)$value0->ParentId;
		$data0_tmp['ApproxWeight'] = @$value0->ApproxWeight;
		$data0_tmp['approxweight'] = @$value0->ApproxWeight;
if (isset($value0->RootPath)){ $data0_tmp['path'] = $this->_parseCategotyInfo($value0->RootPath->Content->children()); }		$data0[] = @$data0_tmp;
	}
	return $data0;
    }
    public function GetBrandRatingList($itemRatingTypeId, $numberItem, $categoryId){
        $params = array(
            'itemRatingTypeId' => $itemRatingTypeId,
	    'numberItem' => $numberItem,
	    'categoryId' => $categoryId
        );
        $params += $this->defaultLogin();
        $simplexml = $this->_getData('GetBrandRatingList', $params);
        if (!$simplexml) return false;
        
        $data0 = array();
        
if(!isset($data0)){$data0 = array();}

	if(!isset($simplexml->BrandInfoList->Content) || is_null($simplexml->BrandInfoList->Content) || !$simplexml->BrandInfoList->Content)	$data0_obj = @array();

	else
	$data0_obj = @$simplexml->BrandInfoList->Content->children();
	$data0 = @array();
	foreach($data0_obj as $value0){
		$data0_tmp = @array();
		$data0_tmp['Id'] = @(string)$value0->Id;
		$data0_tmp['id'] = @(string)$value0->Id;
		$data0_tmp['ExternalId'] = @(string)$value0->ExternalId;
		$data0_tmp['externalid'] = @(string)$value0->ExternalId;
		$data0_tmp['Name'] = @(string)$value0->Name;
		$data0_tmp['name'] = @(string)$value0->Name;
		$data0_tmp['Description'] = @(string)$value0->Description;
		$data0_tmp['description'] = @(string)$value0->Description;
		$data0_tmp['PictureUrl'] = @(string)$value0->PictureUrl;
		$data0_tmp['pictureurl'] = @(string)$value0->PictureUrl;
		$data0_tmp['IsHidden'] = @$value0->IsHidden;
		$data0_tmp['ishidden'] = @$value0->IsHidden;
		$data0_tmp['IsNameSearch'] = @$value0->IsNameSearch;
		$data0_tmp['isnamesearch'] = @$value0->IsNameSearch;
		$data0[] = @$data0_tmp;
	}
	return $data0;
    }
    public function AddItemRatingList($itemRatingTypeId, $numberItem, $categoryId, $itemList, $sessionId){
        $params = array(
            'itemRatingTypeId' => $itemRatingTypeId,
	    'numberItem' => $numberItem,
	    'categoryId' => $categoryId,
	    'itemList' => $itemList,
	    'sessionId' => $sessionId
        );
        $params += $this->defaultLogin();
        $simplexml = $this->_getData('AddItemRatingList', $params);
        if (!$simplexml) return false;
        
        $data0 = array();
        
if(!isset($data0)){$data0 = array();}
	$data0_obj = @$simplexml;
	$data0 = @$data0_obj;
	return $data0;
    }
    public function AddElementsSetToRatingList($sessionId, $itemRatingTypeId, $contentType, $categoryId, $itemList){
        $params = array(
            'sessionId' => $sessionId,
	    'itemRatingTypeId' => $itemRatingTypeId,
	    'contentType' => $contentType,
	    'categoryId' => $categoryId,
	    'itemList' => $itemList
        );
        $params += $this->defaultLogin();
        $simplexml = $this->_getData('AddElementsSetToRatingList', $params);
        if (!$simplexml) return false;
        
        $data0 = array();
        
if(!isset($data0)){$data0 = array();}
	$data0_obj = @$simplexml;
	$data0 = @$data0_obj;
	return $data0;
    }
    public function RemoveItemRatingList($itemRatingType, $categoryId, $itemList, $sessionId){
        $params = array(
            'itemRatingType' => $itemRatingType,
	    'categoryId' => $categoryId,
	    'itemList' => $itemList,
	    'sessionId' => $sessionId
        );
        $params += $this->defaultLogin();
        $simplexml = $this->_getData('RemoveItemRatingList', $params);
        if (!$simplexml) return false;
        
        $data0 = array();
        
if(!isset($data0)){$data0 = array();}
	$data0_obj = @$simplexml;
	$data0 = @$data0_obj;
	return $data0;
    }
    public function RemoveElementsSetRatingList($sessionId, $itemRatingTypeId, $contentType, $categoryId, $itemList){
        $params = array(
            'sessionId' => $sessionId,
	    'itemRatingTypeId' => $itemRatingTypeId,
	    'contentType' => $contentType,
	    'categoryId' => $categoryId,
	    'itemList' => $itemList
        );
        $params += $this->defaultLogin();
        $simplexml = $this->_getData('RemoveElementsSetRatingList', $params);
        if (!$simplexml) return false;
        
        $data0 = array();
        
if(!isset($data0)){$data0 = array();}
	$data0_obj = @$simplexml;
	$data0 = @$data0_obj;
	return $data0;
    }
	
	public function UpdateItemRatingCategoryId($sessionId, $itemRatingTypeId, $contentType, $categoryId, $NewCategoryId){
        $params = array(
            'sessionId' => $sessionId,
	    'itemRatingTypeId' => $itemRatingTypeId,
	    'contentType' => $contentType,
	    'oldCategoryId' => $categoryId,
	    'newCategoryId' => $NewCategoryId
        );
        $params += $this->defaultLogin();
        $simplexml = $this->_getData('UpdateItemRatingCategoryId', $params);
        if (!$simplexml) return false;
        
        $data0 = array();
        
if(!isset($data0)){$data0 = array();}
	$data0_obj = @$simplexml;
	$data0 = @$data0_obj;
	return $data0;
    }
	
    public function RemoveAllItemRatingList($itemRatingType, $categoryId, $sessionId){
        $params = array(
            'itemRatingType' => $itemRatingType,
	    'categoryId' => $categoryId,
	    'sessionId' => $sessionId
        );
        $params += $this->defaultLogin();
        $simplexml = $this->_getData('RemoveAllItemRatingList', $params);
        if (!$simplexml) return false;
        
        $data0 = array();
        
if(!isset($data0)){$data0 = array();}
	$data0_obj = @$simplexml;
	$data0 = @$data0_obj;
	return $data0;
    }
    public function RemoveAllElementsRatingList($sessionId, $itemRatingTypeId, $contentType, $categoryId){
        $params = array(
            'sessionId' => $sessionId,
	    'itemRatingTypeId' => $itemRatingTypeId,
	    'contentType' => $contentType,
	    'categoryId' => $categoryId
        );
        $params += $this->defaultLogin();
        $simplexml = $this->_getData('RemoveAllElementsRatingList', $params);
        if (!$simplexml) return false;
        
        $data0 = array();
        
if(!isset($data0)){$data0 = array();}
	$data0_obj = @$simplexml;
	$data0 = @$data0_obj;
	return $data0;
    }
    public function GetRatingCollectionsByContent($contentType){
        $params = array(
            'contentType' => $contentType
        );
        $params += $this->defaultLogin();
        $simplexml = $this->_getData('GetRatingCollectionsByContent', $params);
        if (!$simplexml) return false;
        
        $data0 = array();
        
if(!isset($data0)){$data0 = array();}

	if(!isset($simplexml->Result) || is_null($simplexml->Result) || !$simplexml->Result)	$data0_obj = @array();

	else
	$data0_obj = @$simplexml->Result->children();
	$data0 = @array();
	foreach($data0_obj as $value0){
		$data0_tmp = @array();
		$data0_tmp['ContentTypeName'] = @(string)$value0->ContentTypeName;
		$data0_tmp['contenttypename'] = @(string)$value0->ContentTypeName;
		$data0_tmp['ItemRatingTypeName'] = @(string)$value0->ItemRatingTypeName;
		$data0_tmp['itemratingtypename'] = @(string)$value0->ItemRatingTypeName;
		$data0_tmp['CategoryId'] = @(string)$value0->CategoryId;
		$data0_tmp['categoryid'] = @(string)$value0->CategoryId;
		$data0_tmp['Count'] = @(int)$value0->Count;
		$data0_tmp['count'] = @(int)$value0->Count;
		$data0[] = @$data0_tmp;
	}
	return $data0;
    }
    public function GetItemInfo($itemId){
        $params = array(
            'itemId' => $itemId
        );
        $params += $this->defaultLogin();
        $simplexml = $this->_getData('GetItemInfo', $params);
        if (!$simplexml) return false;
        
        $data0 = array();
        
if(!isset($data0)){$data0 = array();}
	$data0_obj = @$simplexml->OtapiItemInfo;
	$data0 = $this->_parseItemInfo($data0_obj);
	return $data0;
    }
    public function GetItemInfoList($idsList){
        $params = array(
            'idsList' => $idsList
        );
        $params += $this->defaultLogin();
        $simplexml = $this->_getData('GetItemInfoList', $params);
        if (!$simplexml) return false;
        
        $data0 = array();
        
if(!isset($data0)){$data0 = array();}

	if(!isset($simplexml->OtapiItemInfoList->Content) || is_null($simplexml->OtapiItemInfoList->Content) || !$simplexml->OtapiItemInfoList->Content)	$data0_obj = @array();

	else
	$data0_obj = @$simplexml->OtapiItemInfoList->Content->children();
	$data0 = $this->_parseItemsInfo($data0_obj);
	return $data0;
    }
    public function GetItemFullInfo($itemId){
        $params = array(
            'itemId' => $itemId
        );
        $params += $this->defaultLogin();
        $simplexml = $this->_getData('GetItemFullInfo', $params);
        if (!$simplexml) return false;
        
        $data0 = array();
        
if(!isset($data0)){$data0 = array();}
	$data0_obj = @$simplexml->OtapiItemFullInfo;
	$data0 = $this->_parseItemInfo($data0_obj);
	return $data0;
    }
    public function GetItemFullInfoWithDeliveryCosts($itemId){
        $params = array(
            'itemId' => $itemId
        );
        $params += $this->defaultLogin();
        $simplexml = $this->_getData('GetItemFullInfoWithDeliveryCosts', $params);
        if (!$simplexml) return false;
        
        $data0 = array();
        
if(!isset($data0)){$data0 = array();}
	$data0_obj = @$simplexml->OtapiItemFullInfo;
	$data0 = $this->_parseItemInfo($data0_obj);
	return $data0;
    }
    public function GetItemFullInfoWithPromotions($itemId){
        $params = array(
            'itemId' => $itemId
        );
        $params += $this->defaultLogin();
        $simplexml = $this->_getData('GetItemFullInfoWithPromotions', $params);
        if (!$simplexml) return false;
        
        $data0 = array();
        
if(!isset($data0)){$data0 = array();}
	$data0_obj = @$simplexml->OtapiItemFullInfo;
	$data0 = $this->_parseItemInfo($data0_obj);
	return $data0;
    }
    public function GetItemDeliveryCosts($itemId){
        $params = array(
            'itemId' => $itemId
        );
        $params += $this->defaultLogin();
        $simplexml = $this->_getData('GetItemDeliveryCosts', $params);
        if (!$simplexml) return false;
        
        $data0 = array();
        
if(!isset($data0)){$data0 = array();}

	if(!isset($simplexml->Result->Content) || is_null($simplexml->Result->Content) || !$simplexml->Result->Content)	$data0_obj = @array();

	else
	$data0_obj = @$simplexml->Result->Content->children();
	$data0 = @array();
	foreach($data0_obj as $value0){
		$data0_tmp = @array();
		$data0_tmp['AreaCode'] = @(string)$value0->AreaCode;
		$data0_tmp['areacode'] = @(string)$value0->AreaCode;
		$data0_tmp['Mode'] = @(string)$value0->Mode;
		$data0_tmp['mode'] = @(string)$value0->Mode;
if(!isset($data0_tmp['Price'])){$data0_tmp['Price'] = array();}
		$data1_obj = @$value0->Price;
if(!isset($data0_tmp['Price']['OriginalPrice'])){$data0_tmp['Price']['OriginalPrice'] = array();}
			$data2_obj = @$value0->Price->OriginalPrice;
			$data0_tmp['Price']['OriginalPrice'] = @$data2_obj;
		$data0_tmp['Price']['originalprice'] = @$data0_tmp['Price']['OriginalPrice'];
if(!isset($data0_tmp['Price']['MarginPrice'])){$data0_tmp['Price']['MarginPrice'] = array();}
			$data2_obj = @$value0->Price->MarginPrice;
			$data0_tmp['Price']['MarginPrice'] = @$data2_obj;
		$data0_tmp['Price']['marginprice'] = @$data0_tmp['Price']['MarginPrice'];
if(!isset($data0_tmp['Price']['OriginalCurrencyCode'])){$data0_tmp['Price']['OriginalCurrencyCode'] = array();}
			$data2_obj = @$value0->Price->OriginalCurrencyCode;
			$data0_tmp['Price']['OriginalCurrencyCode'] = @(string)$data2_obj;
		$data0_tmp['Price']['originalcurrencycode'] = @$data0_tmp['Price']['OriginalCurrencyCode'];
if(!isset($data0_tmp['Price']['ConvertedPriceList'])){$data0_tmp['Price']['ConvertedPriceList'] = array();}
			$data2_obj = @$value0->Price->ConvertedPriceList;
if(!isset($data0_tmp['Price']['ConvertedPriceList']['Internal'])){$data0_tmp['Price']['ConvertedPriceList']['Internal'] = array();}
				$data3_obj = @$value0->Price->ConvertedPriceList->Internal;
				$data0_tmp['Price']['ConvertedPriceList']['Internal'] = @$data3_obj;
			$data0_tmp['Price']['ConvertedPriceList']['internal'] = @$data0_tmp['Price']['ConvertedPriceList']['Internal'];
if(!isset($data0_tmp['Price']['ConvertedPriceList']['DisplayedMoneys'])){$data0_tmp['Price']['ConvertedPriceList']['DisplayedMoneys'] = array();}

	if(!isset($value0->Price->ConvertedPriceList->DisplayedMoneys) || is_null($value0->Price->ConvertedPriceList->DisplayedMoneys) || !$value0->Price->ConvertedPriceList->DisplayedMoneys)				$data3_obj = @array();

	else
				$data3_obj = @$value0->Price->ConvertedPriceList->DisplayedMoneys->children();
				$data0_tmp['Price']['ConvertedPriceList']['DisplayedMoneys'] = @array();
				foreach($data3_obj as $value3){
					$data0_tmp['Price']['ConvertedPriceList']['DisplayedMoneys'][] = @$value3;
				}
			$data0_tmp['Price']['ConvertedPriceList']['displayedmoneys'] = @$data0_tmp['Price']['ConvertedPriceList']['DisplayedMoneys'];
		$data0_tmp['Price']['convertedpricelist'] = @$data0_tmp['Price']['ConvertedPriceList'];
if(!isset($data0_tmp['Price']['ConvertedPrice'])){$data0_tmp['Price']['ConvertedPrice'] = array();}
			$data2_obj = @$value0->Price->ConvertedPrice;
			$data0_tmp['Price']['ConvertedPrice'] = @(string)$data2_obj;
		$data0_tmp['Price']['convertedprice'] = @$data0_tmp['Price']['ConvertedPrice'];
if(!isset($data0_tmp['Price']['ConvertedPriceWithoutSign'])){$data0_tmp['Price']['ConvertedPriceWithoutSign'] = array();}
			$data2_obj = @$value0->Price->ConvertedPriceWithoutSign;
			$data0_tmp['Price']['ConvertedPriceWithoutSign'] = @(string)$data2_obj;
		$data0_tmp['Price']['convertedpricewithoutsign'] = @$data0_tmp['Price']['ConvertedPriceWithoutSign'];
if(!isset($data0_tmp['Price']['CurrencySign'])){$data0_tmp['Price']['CurrencySign'] = array();}
			$data2_obj = @$value0->Price->CurrencySign;
			$data0_tmp['Price']['CurrencySign'] = @(string)$data2_obj;
		$data0_tmp['Price']['currencysign'] = @$data0_tmp['Price']['CurrencySign'];
if(!isset($data0_tmp['Price']['CurrencyName'])){$data0_tmp['Price']['CurrencyName'] = array();}
			$data2_obj = @$value0->Price->CurrencyName;
			$data0_tmp['Price']['CurrencyName'] = @(string)$data2_obj;
		$data0_tmp['Price']['currencyname'] = @$data0_tmp['Price']['CurrencyName'];
if(!isset($data0_tmp['Price']['IsDeliverable'])){$data0_tmp['Price']['IsDeliverable'] = array();}
			$data2_obj = @$value0->Price->IsDeliverable;
			$data0_tmp['Price']['IsDeliverable'] = @$data2_obj;
		$data0_tmp['Price']['isdeliverable'] = @$data0_tmp['Price']['IsDeliverable'];
if(!isset($data0_tmp['Price']['DeliveryPrice'])){$data0_tmp['Price']['DeliveryPrice'] = array();}
			$data2_obj = @$value0->Price->DeliveryPrice;
if(!isset($data0_tmp['Price']['DeliveryPrice']['OriginalPrice'])){$data0_tmp['Price']['DeliveryPrice']['OriginalPrice'] = array();}
				$data3_obj = @$value0->Price->DeliveryPrice->OriginalPrice;
				$data0_tmp['Price']['DeliveryPrice']['OriginalPrice'] = @$data3_obj;
			$data0_tmp['Price']['DeliveryPrice']['originalprice'] = @$data0_tmp['Price']['DeliveryPrice']['OriginalPrice'];
if(!isset($data0_tmp['Price']['DeliveryPrice']['MarginPrice'])){$data0_tmp['Price']['DeliveryPrice']['MarginPrice'] = array();}
				$data3_obj = @$value0->Price->DeliveryPrice->MarginPrice;
				$data0_tmp['Price']['DeliveryPrice']['MarginPrice'] = @$data3_obj;
			$data0_tmp['Price']['DeliveryPrice']['marginprice'] = @$data0_tmp['Price']['DeliveryPrice']['MarginPrice'];
if(!isset($data0_tmp['Price']['DeliveryPrice']['OriginalCurrencyCode'])){$data0_tmp['Price']['DeliveryPrice']['OriginalCurrencyCode'] = array();}
				$data3_obj = @$value0->Price->DeliveryPrice->OriginalCurrencyCode;
				$data0_tmp['Price']['DeliveryPrice']['OriginalCurrencyCode'] = @(string)$data3_obj;
			$data0_tmp['Price']['DeliveryPrice']['originalcurrencycode'] = @$data0_tmp['Price']['DeliveryPrice']['OriginalCurrencyCode'];
if(!isset($data0_tmp['Price']['DeliveryPrice']['ConvertedPriceList'])){$data0_tmp['Price']['DeliveryPrice']['ConvertedPriceList'] = array();}
				$data3_obj = @$value0->Price->DeliveryPrice->ConvertedPriceList;
if(!isset($data0_tmp['Price']['DeliveryPrice']['ConvertedPriceList']['Internal'])){$data0_tmp['Price']['DeliveryPrice']['ConvertedPriceList']['Internal'] = array();}
					$data4_obj = @$value0->Price->DeliveryPrice->ConvertedPriceList->Internal;
					$data0_tmp['Price']['DeliveryPrice']['ConvertedPriceList']['Internal'] = @$data4_obj;
				$data0_tmp['Price']['DeliveryPrice']['ConvertedPriceList']['internal'] = @$data0_tmp['Price']['DeliveryPrice']['ConvertedPriceList']['Internal'];
if(!isset($data0_tmp['Price']['DeliveryPrice']['ConvertedPriceList']['DisplayedMoneys'])){$data0_tmp['Price']['DeliveryPrice']['ConvertedPriceList']['DisplayedMoneys'] = array();}

	if(!isset($value0->Price->DeliveryPrice->ConvertedPriceList->DisplayedMoneys) || is_null($value0->Price->DeliveryPrice->ConvertedPriceList->DisplayedMoneys) || !$value0->Price->DeliveryPrice->ConvertedPriceList->DisplayedMoneys)					$data4_obj = @array();

	else
					$data4_obj = @$value0->Price->DeliveryPrice->ConvertedPriceList->DisplayedMoneys->children();
					$data0_tmp['Price']['DeliveryPrice']['ConvertedPriceList']['DisplayedMoneys'] = @array();
					foreach($data4_obj as $value4){
						$data0_tmp['Price']['DeliveryPrice']['ConvertedPriceList']['DisplayedMoneys'][] = @$value4;
					}
				$data0_tmp['Price']['DeliveryPrice']['ConvertedPriceList']['displayedmoneys'] = @$data0_tmp['Price']['DeliveryPrice']['ConvertedPriceList']['DisplayedMoneys'];
			$data0_tmp['Price']['DeliveryPrice']['convertedpricelist'] = @$data0_tmp['Price']['DeliveryPrice']['ConvertedPriceList'];
		$data0_tmp['Price']['deliveryprice'] = @$data0_tmp['Price']['DeliveryPrice'];
if(!isset($data0_tmp['Price']['OneItemDeliveryPrice'])){$data0_tmp['Price']['OneItemDeliveryPrice'] = array();}
			$data2_obj = @$value0->Price->OneItemDeliveryPrice;
if(!isset($data0_tmp['Price']['OneItemDeliveryPrice']['OriginalPrice'])){$data0_tmp['Price']['OneItemDeliveryPrice']['OriginalPrice'] = array();}
				$data3_obj = @$value0->Price->OneItemDeliveryPrice->OriginalPrice;
				$data0_tmp['Price']['OneItemDeliveryPrice']['OriginalPrice'] = @$data3_obj;
			$data0_tmp['Price']['OneItemDeliveryPrice']['originalprice'] = @$data0_tmp['Price']['OneItemDeliveryPrice']['OriginalPrice'];
if(!isset($data0_tmp['Price']['OneItemDeliveryPrice']['MarginPrice'])){$data0_tmp['Price']['OneItemDeliveryPrice']['MarginPrice'] = array();}
				$data3_obj = @$value0->Price->OneItemDeliveryPrice->MarginPrice;
				$data0_tmp['Price']['OneItemDeliveryPrice']['MarginPrice'] = @$data3_obj;
			$data0_tmp['Price']['OneItemDeliveryPrice']['marginprice'] = @$data0_tmp['Price']['OneItemDeliveryPrice']['MarginPrice'];
if(!isset($data0_tmp['Price']['OneItemDeliveryPrice']['OriginalCurrencyCode'])){$data0_tmp['Price']['OneItemDeliveryPrice']['OriginalCurrencyCode'] = array();}
				$data3_obj = @$value0->Price->OneItemDeliveryPrice->OriginalCurrencyCode;
				$data0_tmp['Price']['OneItemDeliveryPrice']['OriginalCurrencyCode'] = @(string)$data3_obj;
			$data0_tmp['Price']['OneItemDeliveryPrice']['originalcurrencycode'] = @$data0_tmp['Price']['OneItemDeliveryPrice']['OriginalCurrencyCode'];
if(!isset($data0_tmp['Price']['OneItemDeliveryPrice']['ConvertedPriceList'])){$data0_tmp['Price']['OneItemDeliveryPrice']['ConvertedPriceList'] = array();}
				$data3_obj = @$value0->Price->OneItemDeliveryPrice->ConvertedPriceList;
if(!isset($data0_tmp['Price']['OneItemDeliveryPrice']['ConvertedPriceList']['Internal'])){$data0_tmp['Price']['OneItemDeliveryPrice']['ConvertedPriceList']['Internal'] = array();}
					$data4_obj = @$value0->Price->OneItemDeliveryPrice->ConvertedPriceList->Internal;
					$data0_tmp['Price']['OneItemDeliveryPrice']['ConvertedPriceList']['Internal'] = @$data4_obj;
				$data0_tmp['Price']['OneItemDeliveryPrice']['ConvertedPriceList']['internal'] = @$data0_tmp['Price']['OneItemDeliveryPrice']['ConvertedPriceList']['Internal'];
if(!isset($data0_tmp['Price']['OneItemDeliveryPrice']['ConvertedPriceList']['DisplayedMoneys'])){$data0_tmp['Price']['OneItemDeliveryPrice']['ConvertedPriceList']['DisplayedMoneys'] = array();}

	if(!isset($value0->Price->OneItemDeliveryPrice->ConvertedPriceList->DisplayedMoneys) || is_null($value0->Price->OneItemDeliveryPrice->ConvertedPriceList->DisplayedMoneys) || !$value0->Price->OneItemDeliveryPrice->ConvertedPriceList->DisplayedMoneys)					$data4_obj = @array();

	else
					$data4_obj = @$value0->Price->OneItemDeliveryPrice->ConvertedPriceList->DisplayedMoneys->children();
					$data0_tmp['Price']['OneItemDeliveryPrice']['ConvertedPriceList']['DisplayedMoneys'] = @array();
					foreach($data4_obj as $value4){
						$data0_tmp['Price']['OneItemDeliveryPrice']['ConvertedPriceList']['DisplayedMoneys'][] = @$value4;
					}
				$data0_tmp['Price']['OneItemDeliveryPrice']['ConvertedPriceList']['displayedmoneys'] = @$data0_tmp['Price']['OneItemDeliveryPrice']['ConvertedPriceList']['DisplayedMoneys'];
			$data0_tmp['Price']['OneItemDeliveryPrice']['convertedpricelist'] = @$data0_tmp['Price']['OneItemDeliveryPrice']['ConvertedPriceList'];
		$data0_tmp['Price']['oneitemdeliveryprice'] = @$data0_tmp['Price']['OneItemDeliveryPrice'];
if(!isset($data0_tmp['Price']['PriceWithoutDelivery'])){$data0_tmp['Price']['PriceWithoutDelivery'] = array();}
			$data2_obj = @$value0->Price->PriceWithoutDelivery;
if(!isset($data0_tmp['Price']['PriceWithoutDelivery']['OriginalPrice'])){$data0_tmp['Price']['PriceWithoutDelivery']['OriginalPrice'] = array();}
				$data3_obj = @$value0->Price->PriceWithoutDelivery->OriginalPrice;
				$data0_tmp['Price']['PriceWithoutDelivery']['OriginalPrice'] = @$data3_obj;
			$data0_tmp['Price']['PriceWithoutDelivery']['originalprice'] = @$data0_tmp['Price']['PriceWithoutDelivery']['OriginalPrice'];
if(!isset($data0_tmp['Price']['PriceWithoutDelivery']['MarginPrice'])){$data0_tmp['Price']['PriceWithoutDelivery']['MarginPrice'] = array();}
				$data3_obj = @$value0->Price->PriceWithoutDelivery->MarginPrice;
				$data0_tmp['Price']['PriceWithoutDelivery']['MarginPrice'] = @$data3_obj;
			$data0_tmp['Price']['PriceWithoutDelivery']['marginprice'] = @$data0_tmp['Price']['PriceWithoutDelivery']['MarginPrice'];
if(!isset($data0_tmp['Price']['PriceWithoutDelivery']['OriginalCurrencyCode'])){$data0_tmp['Price']['PriceWithoutDelivery']['OriginalCurrencyCode'] = array();}
				$data3_obj = @$value0->Price->PriceWithoutDelivery->OriginalCurrencyCode;
				$data0_tmp['Price']['PriceWithoutDelivery']['OriginalCurrencyCode'] = @(string)$data3_obj;
			$data0_tmp['Price']['PriceWithoutDelivery']['originalcurrencycode'] = @$data0_tmp['Price']['PriceWithoutDelivery']['OriginalCurrencyCode'];
if(!isset($data0_tmp['Price']['PriceWithoutDelivery']['ConvertedPriceList'])){$data0_tmp['Price']['PriceWithoutDelivery']['ConvertedPriceList'] = array();}
				$data3_obj = @$value0->Price->PriceWithoutDelivery->ConvertedPriceList;
if(!isset($data0_tmp['Price']['PriceWithoutDelivery']['ConvertedPriceList']['Internal'])){$data0_tmp['Price']['PriceWithoutDelivery']['ConvertedPriceList']['Internal'] = array();}
					$data4_obj = @$value0->Price->PriceWithoutDelivery->ConvertedPriceList->Internal;
					$data0_tmp['Price']['PriceWithoutDelivery']['ConvertedPriceList']['Internal'] = @$data4_obj;
				$data0_tmp['Price']['PriceWithoutDelivery']['ConvertedPriceList']['internal'] = @$data0_tmp['Price']['PriceWithoutDelivery']['ConvertedPriceList']['Internal'];
if(!isset($data0_tmp['Price']['PriceWithoutDelivery']['ConvertedPriceList']['DisplayedMoneys'])){$data0_tmp['Price']['PriceWithoutDelivery']['ConvertedPriceList']['DisplayedMoneys'] = array();}

	if(!isset($value0->Price->PriceWithoutDelivery->ConvertedPriceList->DisplayedMoneys) || is_null($value0->Price->PriceWithoutDelivery->ConvertedPriceList->DisplayedMoneys) || !$value0->Price->PriceWithoutDelivery->ConvertedPriceList->DisplayedMoneys)					$data4_obj = @array();

	else
					$data4_obj = @$value0->Price->PriceWithoutDelivery->ConvertedPriceList->DisplayedMoneys->children();
					$data0_tmp['Price']['PriceWithoutDelivery']['ConvertedPriceList']['DisplayedMoneys'] = @array();
					foreach($data4_obj as $value4){
						$data0_tmp['Price']['PriceWithoutDelivery']['ConvertedPriceList']['DisplayedMoneys'][] = @$value4;
					}
				$data0_tmp['Price']['PriceWithoutDelivery']['ConvertedPriceList']['displayedmoneys'] = @$data0_tmp['Price']['PriceWithoutDelivery']['ConvertedPriceList']['DisplayedMoneys'];
			$data0_tmp['Price']['PriceWithoutDelivery']['convertedpricelist'] = @$data0_tmp['Price']['PriceWithoutDelivery']['ConvertedPriceList'];
		$data0_tmp['Price']['pricewithoutdelivery'] = @$data0_tmp['Price']['PriceWithoutDelivery'];
		$data0[] = @$data0_tmp;
	}
	return $data0;
    }
    public function GetItemPromotions($itemId){
        $params = array(
            'itemId' => $itemId
        );
        $params += $this->defaultLogin();
        $simplexml = $this->_getData('GetItemPromotions', $params);
        if (!$simplexml) return false;
        
        $data0 = array();
        
if(!isset($data0)){$data0 = array();}

	if(!isset($simplexml->Result->Content) || is_null($simplexml->Result->Content) || !$simplexml->Result->Content)	$data0_obj = @array();

	else
	$data0_obj = @$simplexml->Result->Content->children();
	$data0 = @array();
	foreach($data0_obj as $value0){
		$data0_tmp = @array();
		$data0_tmp['Id'] = @(string)$value0->Id;
		$data0_tmp['id'] = @(string)$value0->Id;
		$data0_tmp['Name'] = @(string)$value0->Name;
		$data0_tmp['name'] = @(string)$value0->Name;
		$data0_tmp['Desciption'] = @(string)$value0->Desciption;
		$data0_tmp['desciption'] = @(string)$value0->Desciption;
		$data0_tmp['StartTime'] = @$value0->StartTime;
		$data0_tmp['starttime'] = @$value0->StartTime;
		$data0_tmp['EndTime'] = @$value0->EndTime;
		$data0_tmp['endtime'] = @$value0->EndTime;
if(!isset($data0_tmp['Price'])){$data0_tmp['Price'] = array();}
		$data1_obj = @$value0->Price;
if(!isset($data0_tmp['Price']['OriginalPrice'])){$data0_tmp['Price']['OriginalPrice'] = array();}
			$data2_obj = @$value0->Price->OriginalPrice;
			$data0_tmp['Price']['OriginalPrice'] = @$data2_obj;
		$data0_tmp['Price']['originalprice'] = @$data0_tmp['Price']['OriginalPrice'];
if(!isset($data0_tmp['Price']['MarginPrice'])){$data0_tmp['Price']['MarginPrice'] = array();}
			$data2_obj = @$value0->Price->MarginPrice;
			$data0_tmp['Price']['MarginPrice'] = @$data2_obj;
		$data0_tmp['Price']['marginprice'] = @$data0_tmp['Price']['MarginPrice'];
if(!isset($data0_tmp['Price']['OriginalCurrencyCode'])){$data0_tmp['Price']['OriginalCurrencyCode'] = array();}
			$data2_obj = @$value0->Price->OriginalCurrencyCode;
			$data0_tmp['Price']['OriginalCurrencyCode'] = @(string)$data2_obj;
		$data0_tmp['Price']['originalcurrencycode'] = @$data0_tmp['Price']['OriginalCurrencyCode'];
if(!isset($data0_tmp['Price']['ConvertedPriceList'])){$data0_tmp['Price']['ConvertedPriceList'] = array();}
			$data2_obj = @$value0->Price->ConvertedPriceList;
if(!isset($data0_tmp['Price']['ConvertedPriceList']['Internal'])){$data0_tmp['Price']['ConvertedPriceList']['Internal'] = array();}
				$data3_obj = @$value0->Price->ConvertedPriceList->Internal;
				$data0_tmp['Price']['ConvertedPriceList']['Internal'] = @$data3_obj;
			$data0_tmp['Price']['ConvertedPriceList']['internal'] = @$data0_tmp['Price']['ConvertedPriceList']['Internal'];
if(!isset($data0_tmp['Price']['ConvertedPriceList']['DisplayedMoneys'])){$data0_tmp['Price']['ConvertedPriceList']['DisplayedMoneys'] = array();}

	if(!isset($value0->Price->ConvertedPriceList->DisplayedMoneys) || is_null($value0->Price->ConvertedPriceList->DisplayedMoneys) || !$value0->Price->ConvertedPriceList->DisplayedMoneys)				$data3_obj = @array();

	else
				$data3_obj = @$value0->Price->ConvertedPriceList->DisplayedMoneys->children();
				$data0_tmp['Price']['ConvertedPriceList']['DisplayedMoneys'] = @array();
				foreach($data3_obj as $value3){
					$data0_tmp['Price']['ConvertedPriceList']['DisplayedMoneys'][] = @$value3;
				}
			$data0_tmp['Price']['ConvertedPriceList']['displayedmoneys'] = @$data0_tmp['Price']['ConvertedPriceList']['DisplayedMoneys'];
		$data0_tmp['Price']['convertedpricelist'] = @$data0_tmp['Price']['ConvertedPriceList'];
if(!isset($data0_tmp['Price']['ConvertedPrice'])){$data0_tmp['Price']['ConvertedPrice'] = array();}
			$data2_obj = @$value0->Price->ConvertedPrice;
			$data0_tmp['Price']['ConvertedPrice'] = @(string)$data2_obj;
		$data0_tmp['Price']['convertedprice'] = @$data0_tmp['Price']['ConvertedPrice'];
if(!isset($data0_tmp['Price']['ConvertedPriceWithoutSign'])){$data0_tmp['Price']['ConvertedPriceWithoutSign'] = array();}
			$data2_obj = @$value0->Price->ConvertedPriceWithoutSign;
			$data0_tmp['Price']['ConvertedPriceWithoutSign'] = @(string)$data2_obj;
		$data0_tmp['Price']['convertedpricewithoutsign'] = @$data0_tmp['Price']['ConvertedPriceWithoutSign'];
if(!isset($data0_tmp['Price']['CurrencySign'])){$data0_tmp['Price']['CurrencySign'] = array();}
			$data2_obj = @$value0->Price->CurrencySign;
			$data0_tmp['Price']['CurrencySign'] = @(string)$data2_obj;
		$data0_tmp['Price']['currencysign'] = @$data0_tmp['Price']['CurrencySign'];
if(!isset($data0_tmp['Price']['CurrencyName'])){$data0_tmp['Price']['CurrencyName'] = array();}
			$data2_obj = @$value0->Price->CurrencyName;
			$data0_tmp['Price']['CurrencyName'] = @(string)$data2_obj;
		$data0_tmp['Price']['currencyname'] = @$data0_tmp['Price']['CurrencyName'];
if(!isset($data0_tmp['Price']['IsDeliverable'])){$data0_tmp['Price']['IsDeliverable'] = array();}
			$data2_obj = @$value0->Price->IsDeliverable;
			$data0_tmp['Price']['IsDeliverable'] = @$data2_obj;
		$data0_tmp['Price']['isdeliverable'] = @$data0_tmp['Price']['IsDeliverable'];
if(!isset($data0_tmp['Price']['DeliveryPrice'])){$data0_tmp['Price']['DeliveryPrice'] = array();}
			$data2_obj = @$value0->Price->DeliveryPrice;
if(!isset($data0_tmp['Price']['DeliveryPrice']['OriginalPrice'])){$data0_tmp['Price']['DeliveryPrice']['OriginalPrice'] = array();}
				$data3_obj = @$value0->Price->DeliveryPrice->OriginalPrice;
				$data0_tmp['Price']['DeliveryPrice']['OriginalPrice'] = @$data3_obj;
			$data0_tmp['Price']['DeliveryPrice']['originalprice'] = @$data0_tmp['Price']['DeliveryPrice']['OriginalPrice'];
if(!isset($data0_tmp['Price']['DeliveryPrice']['MarginPrice'])){$data0_tmp['Price']['DeliveryPrice']['MarginPrice'] = array();}
				$data3_obj = @$value0->Price->DeliveryPrice->MarginPrice;
				$data0_tmp['Price']['DeliveryPrice']['MarginPrice'] = @$data3_obj;
			$data0_tmp['Price']['DeliveryPrice']['marginprice'] = @$data0_tmp['Price']['DeliveryPrice']['MarginPrice'];
if(!isset($data0_tmp['Price']['DeliveryPrice']['OriginalCurrencyCode'])){$data0_tmp['Price']['DeliveryPrice']['OriginalCurrencyCode'] = array();}
				$data3_obj = @$value0->Price->DeliveryPrice->OriginalCurrencyCode;
				$data0_tmp['Price']['DeliveryPrice']['OriginalCurrencyCode'] = @(string)$data3_obj;
			$data0_tmp['Price']['DeliveryPrice']['originalcurrencycode'] = @$data0_tmp['Price']['DeliveryPrice']['OriginalCurrencyCode'];
if(!isset($data0_tmp['Price']['DeliveryPrice']['ConvertedPriceList'])){$data0_tmp['Price']['DeliveryPrice']['ConvertedPriceList'] = array();}
				$data3_obj = @$value0->Price->DeliveryPrice->ConvertedPriceList;
if(!isset($data0_tmp['Price']['DeliveryPrice']['ConvertedPriceList']['Internal'])){$data0_tmp['Price']['DeliveryPrice']['ConvertedPriceList']['Internal'] = array();}
					$data4_obj = @$value0->Price->DeliveryPrice->ConvertedPriceList->Internal;
					$data0_tmp['Price']['DeliveryPrice']['ConvertedPriceList']['Internal'] = @$data4_obj;
				$data0_tmp['Price']['DeliveryPrice']['ConvertedPriceList']['internal'] = @$data0_tmp['Price']['DeliveryPrice']['ConvertedPriceList']['Internal'];
if(!isset($data0_tmp['Price']['DeliveryPrice']['ConvertedPriceList']['DisplayedMoneys'])){$data0_tmp['Price']['DeliveryPrice']['ConvertedPriceList']['DisplayedMoneys'] = array();}

	if(!isset($value0->Price->DeliveryPrice->ConvertedPriceList->DisplayedMoneys) || is_null($value0->Price->DeliveryPrice->ConvertedPriceList->DisplayedMoneys) || !$value0->Price->DeliveryPrice->ConvertedPriceList->DisplayedMoneys)					$data4_obj = @array();

	else
					$data4_obj = @$value0->Price->DeliveryPrice->ConvertedPriceList->DisplayedMoneys->children();
					$data0_tmp['Price']['DeliveryPrice']['ConvertedPriceList']['DisplayedMoneys'] = @array();
					foreach($data4_obj as $value4){
						$data0_tmp['Price']['DeliveryPrice']['ConvertedPriceList']['DisplayedMoneys'][] = @$value4;
					}
				$data0_tmp['Price']['DeliveryPrice']['ConvertedPriceList']['displayedmoneys'] = @$data0_tmp['Price']['DeliveryPrice']['ConvertedPriceList']['DisplayedMoneys'];
			$data0_tmp['Price']['DeliveryPrice']['convertedpricelist'] = @$data0_tmp['Price']['DeliveryPrice']['ConvertedPriceList'];
		$data0_tmp['Price']['deliveryprice'] = @$data0_tmp['Price']['DeliveryPrice'];
if(!isset($data0_tmp['Price']['OneItemDeliveryPrice'])){$data0_tmp['Price']['OneItemDeliveryPrice'] = array();}
			$data2_obj = @$value0->Price->OneItemDeliveryPrice;
if(!isset($data0_tmp['Price']['OneItemDeliveryPrice']['OriginalPrice'])){$data0_tmp['Price']['OneItemDeliveryPrice']['OriginalPrice'] = array();}
				$data3_obj = @$value0->Price->OneItemDeliveryPrice->OriginalPrice;
				$data0_tmp['Price']['OneItemDeliveryPrice']['OriginalPrice'] = @$data3_obj;
			$data0_tmp['Price']['OneItemDeliveryPrice']['originalprice'] = @$data0_tmp['Price']['OneItemDeliveryPrice']['OriginalPrice'];
if(!isset($data0_tmp['Price']['OneItemDeliveryPrice']['MarginPrice'])){$data0_tmp['Price']['OneItemDeliveryPrice']['MarginPrice'] = array();}
				$data3_obj = @$value0->Price->OneItemDeliveryPrice->MarginPrice;
				$data0_tmp['Price']['OneItemDeliveryPrice']['MarginPrice'] = @$data3_obj;
			$data0_tmp['Price']['OneItemDeliveryPrice']['marginprice'] = @$data0_tmp['Price']['OneItemDeliveryPrice']['MarginPrice'];
if(!isset($data0_tmp['Price']['OneItemDeliveryPrice']['OriginalCurrencyCode'])){$data0_tmp['Price']['OneItemDeliveryPrice']['OriginalCurrencyCode'] = array();}
				$data3_obj = @$value0->Price->OneItemDeliveryPrice->OriginalCurrencyCode;
				$data0_tmp['Price']['OneItemDeliveryPrice']['OriginalCurrencyCode'] = @(string)$data3_obj;
			$data0_tmp['Price']['OneItemDeliveryPrice']['originalcurrencycode'] = @$data0_tmp['Price']['OneItemDeliveryPrice']['OriginalCurrencyCode'];
if(!isset($data0_tmp['Price']['OneItemDeliveryPrice']['ConvertedPriceList'])){$data0_tmp['Price']['OneItemDeliveryPrice']['ConvertedPriceList'] = array();}
				$data3_obj = @$value0->Price->OneItemDeliveryPrice->ConvertedPriceList;
if(!isset($data0_tmp['Price']['OneItemDeliveryPrice']['ConvertedPriceList']['Internal'])){$data0_tmp['Price']['OneItemDeliveryPrice']['ConvertedPriceList']['Internal'] = array();}
					$data4_obj = @$value0->Price->OneItemDeliveryPrice->ConvertedPriceList->Internal;
					$data0_tmp['Price']['OneItemDeliveryPrice']['ConvertedPriceList']['Internal'] = @$data4_obj;
				$data0_tmp['Price']['OneItemDeliveryPrice']['ConvertedPriceList']['internal'] = @$data0_tmp['Price']['OneItemDeliveryPrice']['ConvertedPriceList']['Internal'];
if(!isset($data0_tmp['Price']['OneItemDeliveryPrice']['ConvertedPriceList']['DisplayedMoneys'])){$data0_tmp['Price']['OneItemDeliveryPrice']['ConvertedPriceList']['DisplayedMoneys'] = array();}

	if(!isset($value0->Price->OneItemDeliveryPrice->ConvertedPriceList->DisplayedMoneys) || is_null($value0->Price->OneItemDeliveryPrice->ConvertedPriceList->DisplayedMoneys) || !$value0->Price->OneItemDeliveryPrice->ConvertedPriceList->DisplayedMoneys)					$data4_obj = @array();

	else
					$data4_obj = @$value0->Price->OneItemDeliveryPrice->ConvertedPriceList->DisplayedMoneys->children();
					$data0_tmp['Price']['OneItemDeliveryPrice']['ConvertedPriceList']['DisplayedMoneys'] = @array();
					foreach($data4_obj as $value4){
						$data0_tmp['Price']['OneItemDeliveryPrice']['ConvertedPriceList']['DisplayedMoneys'][] = @$value4;
					}
				$data0_tmp['Price']['OneItemDeliveryPrice']['ConvertedPriceList']['displayedmoneys'] = @$data0_tmp['Price']['OneItemDeliveryPrice']['ConvertedPriceList']['DisplayedMoneys'];
			$data0_tmp['Price']['OneItemDeliveryPrice']['convertedpricelist'] = @$data0_tmp['Price']['OneItemDeliveryPrice']['ConvertedPriceList'];
		$data0_tmp['Price']['oneitemdeliveryprice'] = @$data0_tmp['Price']['OneItemDeliveryPrice'];
if(!isset($data0_tmp['Price']['PriceWithoutDelivery'])){$data0_tmp['Price']['PriceWithoutDelivery'] = array();}
			$data2_obj = @$value0->Price->PriceWithoutDelivery;
if(!isset($data0_tmp['Price']['PriceWithoutDelivery']['OriginalPrice'])){$data0_tmp['Price']['PriceWithoutDelivery']['OriginalPrice'] = array();}
				$data3_obj = @$value0->Price->PriceWithoutDelivery->OriginalPrice;
				$data0_tmp['Price']['PriceWithoutDelivery']['OriginalPrice'] = @$data3_obj;
			$data0_tmp['Price']['PriceWithoutDelivery']['originalprice'] = @$data0_tmp['Price']['PriceWithoutDelivery']['OriginalPrice'];
if(!isset($data0_tmp['Price']['PriceWithoutDelivery']['MarginPrice'])){$data0_tmp['Price']['PriceWithoutDelivery']['MarginPrice'] = array();}
				$data3_obj = @$value0->Price->PriceWithoutDelivery->MarginPrice;
				$data0_tmp['Price']['PriceWithoutDelivery']['MarginPrice'] = @$data3_obj;
			$data0_tmp['Price']['PriceWithoutDelivery']['marginprice'] = @$data0_tmp['Price']['PriceWithoutDelivery']['MarginPrice'];
if(!isset($data0_tmp['Price']['PriceWithoutDelivery']['OriginalCurrencyCode'])){$data0_tmp['Price']['PriceWithoutDelivery']['OriginalCurrencyCode'] = array();}
				$data3_obj = @$value0->Price->PriceWithoutDelivery->OriginalCurrencyCode;
				$data0_tmp['Price']['PriceWithoutDelivery']['OriginalCurrencyCode'] = @(string)$data3_obj;
			$data0_tmp['Price']['PriceWithoutDelivery']['originalcurrencycode'] = @$data0_tmp['Price']['PriceWithoutDelivery']['OriginalCurrencyCode'];
if(!isset($data0_tmp['Price']['PriceWithoutDelivery']['ConvertedPriceList'])){$data0_tmp['Price']['PriceWithoutDelivery']['ConvertedPriceList'] = array();}
				$data3_obj = @$value0->Price->PriceWithoutDelivery->ConvertedPriceList;
if(!isset($data0_tmp['Price']['PriceWithoutDelivery']['ConvertedPriceList']['Internal'])){$data0_tmp['Price']['PriceWithoutDelivery']['ConvertedPriceList']['Internal'] = array();}
					$data4_obj = @$value0->Price->PriceWithoutDelivery->ConvertedPriceList->Internal;
					$data0_tmp['Price']['PriceWithoutDelivery']['ConvertedPriceList']['Internal'] = @$data4_obj;
				$data0_tmp['Price']['PriceWithoutDelivery']['ConvertedPriceList']['internal'] = @$data0_tmp['Price']['PriceWithoutDelivery']['ConvertedPriceList']['Internal'];
if(!isset($data0_tmp['Price']['PriceWithoutDelivery']['ConvertedPriceList']['DisplayedMoneys'])){$data0_tmp['Price']['PriceWithoutDelivery']['ConvertedPriceList']['DisplayedMoneys'] = array();}

	if(!isset($value0->Price->PriceWithoutDelivery->ConvertedPriceList->DisplayedMoneys) || is_null($value0->Price->PriceWithoutDelivery->ConvertedPriceList->DisplayedMoneys) || !$value0->Price->PriceWithoutDelivery->ConvertedPriceList->DisplayedMoneys)					$data4_obj = @array();

	else
					$data4_obj = @$value0->Price->PriceWithoutDelivery->ConvertedPriceList->DisplayedMoneys->children();
					$data0_tmp['Price']['PriceWithoutDelivery']['ConvertedPriceList']['DisplayedMoneys'] = @array();
					foreach($data4_obj as $value4){
						$data0_tmp['Price']['PriceWithoutDelivery']['ConvertedPriceList']['DisplayedMoneys'][] = @$value4;
					}
				$data0_tmp['Price']['PriceWithoutDelivery']['ConvertedPriceList']['displayedmoneys'] = @$data0_tmp['Price']['PriceWithoutDelivery']['ConvertedPriceList']['DisplayedMoneys'];
			$data0_tmp['Price']['PriceWithoutDelivery']['convertedpricelist'] = @$data0_tmp['Price']['PriceWithoutDelivery']['ConvertedPriceList'];
		$data0_tmp['Price']['pricewithoutdelivery'] = @$data0_tmp['Price']['PriceWithoutDelivery'];
		$data0_tmp['OtherNeed'] = @(string)$value0->OtherNeed;
		$data0_tmp['otherneed'] = @(string)$value0->OtherNeed;
		$data0_tmp['OtherSend'] = @(string)$value0->OtherSend;
		$data0_tmp['othersend'] = @(string)$value0->OtherSend;
if(!isset($data0_tmp['ConfiguredItems'])){$data0_tmp['ConfiguredItems'] = array();}

	if(!isset($value0->ConfiguredItems) || is_null($value0->ConfiguredItems) || !$value0->ConfiguredItems)		$data1_obj = @array();

	else
		$data1_obj = @$value0->ConfiguredItems->children();
		$data0_tmp['ConfiguredItems'] = @array();
		foreach($data1_obj as $value1){
			$data1_tmp = @array();
			$data1_tmp['Id'] = @(string)$value1->Id;
			$data1_tmp['id'] = @(string)$value1->Id;
if(!isset($data1_tmp['Price'])){$data1_tmp['Price'] = array();}
			$data2_obj = @$value1->Price;
if(!isset($data1_tmp['Price']['OriginalPrice'])){$data1_tmp['Price']['OriginalPrice'] = array();}
				$data3_obj = @$value1->Price->OriginalPrice;
				$data1_tmp['Price']['OriginalPrice'] = @$data3_obj;
			$data1_tmp['Price']['originalprice'] = @$data1_tmp['Price']['OriginalPrice'];
if(!isset($data1_tmp['Price']['MarginPrice'])){$data1_tmp['Price']['MarginPrice'] = array();}
				$data3_obj = @$value1->Price->MarginPrice;
				$data1_tmp['Price']['MarginPrice'] = @$data3_obj;
			$data1_tmp['Price']['marginprice'] = @$data1_tmp['Price']['MarginPrice'];
if(!isset($data1_tmp['Price']['OriginalCurrencyCode'])){$data1_tmp['Price']['OriginalCurrencyCode'] = array();}
				$data3_obj = @$value1->Price->OriginalCurrencyCode;
				$data1_tmp['Price']['OriginalCurrencyCode'] = @(string)$data3_obj;
			$data1_tmp['Price']['originalcurrencycode'] = @$data1_tmp['Price']['OriginalCurrencyCode'];
if(!isset($data1_tmp['Price']['ConvertedPriceList'])){$data1_tmp['Price']['ConvertedPriceList'] = array();}
				$data3_obj = @$value1->Price->ConvertedPriceList;
if(!isset($data1_tmp['Price']['ConvertedPriceList']['Internal'])){$data1_tmp['Price']['ConvertedPriceList']['Internal'] = array();}
					$data4_obj = @$value1->Price->ConvertedPriceList->Internal;
					$data1_tmp['Price']['ConvertedPriceList']['Internal'] = @$data4_obj;
				$data1_tmp['Price']['ConvertedPriceList']['internal'] = @$data1_tmp['Price']['ConvertedPriceList']['Internal'];
if(!isset($data1_tmp['Price']['ConvertedPriceList']['DisplayedMoneys'])){$data1_tmp['Price']['ConvertedPriceList']['DisplayedMoneys'] = array();}

	if(!isset($value1->Price->ConvertedPriceList->DisplayedMoneys) || is_null($value1->Price->ConvertedPriceList->DisplayedMoneys) || !$value1->Price->ConvertedPriceList->DisplayedMoneys)					$data4_obj = @array();

	else
					$data4_obj = @$value1->Price->ConvertedPriceList->DisplayedMoneys->children();
					$data1_tmp['Price']['ConvertedPriceList']['DisplayedMoneys'] = @array();
					foreach($data4_obj as $value4){
						$data1_tmp['Price']['ConvertedPriceList']['DisplayedMoneys'][] = @$value4;
					}
				$data1_tmp['Price']['ConvertedPriceList']['displayedmoneys'] = @$data1_tmp['Price']['ConvertedPriceList']['DisplayedMoneys'];
			$data1_tmp['Price']['convertedpricelist'] = @$data1_tmp['Price']['ConvertedPriceList'];
if(!isset($data1_tmp['Price']['ConvertedPrice'])){$data1_tmp['Price']['ConvertedPrice'] = array();}
				$data3_obj = @$value1->Price->ConvertedPrice;
				$data1_tmp['Price']['ConvertedPrice'] = @(string)$data3_obj;
			$data1_tmp['Price']['convertedprice'] = @$data1_tmp['Price']['ConvertedPrice'];
if(!isset($data1_tmp['Price']['ConvertedPriceWithoutSign'])){$data1_tmp['Price']['ConvertedPriceWithoutSign'] = array();}
				$data3_obj = @$value1->Price->ConvertedPriceWithoutSign;
				$data1_tmp['Price']['ConvertedPriceWithoutSign'] = @(string)$data3_obj;
			$data1_tmp['Price']['convertedpricewithoutsign'] = @$data1_tmp['Price']['ConvertedPriceWithoutSign'];
if(!isset($data1_tmp['Price']['CurrencySign'])){$data1_tmp['Price']['CurrencySign'] = array();}
				$data3_obj = @$value1->Price->CurrencySign;
				$data1_tmp['Price']['CurrencySign'] = @(string)$data3_obj;
			$data1_tmp['Price']['currencysign'] = @$data1_tmp['Price']['CurrencySign'];
if(!isset($data1_tmp['Price']['CurrencyName'])){$data1_tmp['Price']['CurrencyName'] = array();}
				$data3_obj = @$value1->Price->CurrencyName;
				$data1_tmp['Price']['CurrencyName'] = @(string)$data3_obj;
			$data1_tmp['Price']['currencyname'] = @$data1_tmp['Price']['CurrencyName'];
if(!isset($data1_tmp['Price']['IsDeliverable'])){$data1_tmp['Price']['IsDeliverable'] = array();}
				$data3_obj = @$value1->Price->IsDeliverable;
				$data1_tmp['Price']['IsDeliverable'] = @$data3_obj;
			$data1_tmp['Price']['isdeliverable'] = @$data1_tmp['Price']['IsDeliverable'];
if(!isset($data1_tmp['Price']['DeliveryPrice'])){$data1_tmp['Price']['DeliveryPrice'] = array();}
				$data3_obj = @$value1->Price->DeliveryPrice;
if(!isset($data1_tmp['Price']['DeliveryPrice']['OriginalPrice'])){$data1_tmp['Price']['DeliveryPrice']['OriginalPrice'] = array();}
					$data4_obj = @$value1->Price->DeliveryPrice->OriginalPrice;
					$data1_tmp['Price']['DeliveryPrice']['OriginalPrice'] = @$data4_obj;
				$data1_tmp['Price']['DeliveryPrice']['originalprice'] = @$data1_tmp['Price']['DeliveryPrice']['OriginalPrice'];
if(!isset($data1_tmp['Price']['DeliveryPrice']['MarginPrice'])){$data1_tmp['Price']['DeliveryPrice']['MarginPrice'] = array();}
					$data4_obj = @$value1->Price->DeliveryPrice->MarginPrice;
					$data1_tmp['Price']['DeliveryPrice']['MarginPrice'] = @$data4_obj;
				$data1_tmp['Price']['DeliveryPrice']['marginprice'] = @$data1_tmp['Price']['DeliveryPrice']['MarginPrice'];
if(!isset($data1_tmp['Price']['DeliveryPrice']['OriginalCurrencyCode'])){$data1_tmp['Price']['DeliveryPrice']['OriginalCurrencyCode'] = array();}
					$data4_obj = @$value1->Price->DeliveryPrice->OriginalCurrencyCode;
					$data1_tmp['Price']['DeliveryPrice']['OriginalCurrencyCode'] = @(string)$data4_obj;
				$data1_tmp['Price']['DeliveryPrice']['originalcurrencycode'] = @$data1_tmp['Price']['DeliveryPrice']['OriginalCurrencyCode'];
if(!isset($data1_tmp['Price']['DeliveryPrice']['ConvertedPriceList'])){$data1_tmp['Price']['DeliveryPrice']['ConvertedPriceList'] = array();}
					$data4_obj = @$value1->Price->DeliveryPrice->ConvertedPriceList;
if(!isset($data1_tmp['Price']['DeliveryPrice']['ConvertedPriceList']['Internal'])){$data1_tmp['Price']['DeliveryPrice']['ConvertedPriceList']['Internal'] = array();}
						$data5_obj = @$value1->Price->DeliveryPrice->ConvertedPriceList->Internal;
						$data1_tmp['Price']['DeliveryPrice']['ConvertedPriceList']['Internal'] = @$data5_obj;
					$data1_tmp['Price']['DeliveryPrice']['ConvertedPriceList']['internal'] = @$data1_tmp['Price']['DeliveryPrice']['ConvertedPriceList']['Internal'];
if(!isset($data1_tmp['Price']['DeliveryPrice']['ConvertedPriceList']['DisplayedMoneys'])){$data1_tmp['Price']['DeliveryPrice']['ConvertedPriceList']['DisplayedMoneys'] = array();}

	if(!isset($value1->Price->DeliveryPrice->ConvertedPriceList->DisplayedMoneys) || is_null($value1->Price->DeliveryPrice->ConvertedPriceList->DisplayedMoneys) || !$value1->Price->DeliveryPrice->ConvertedPriceList->DisplayedMoneys)						$data5_obj = @array();

	else
						$data5_obj = @$value1->Price->DeliveryPrice->ConvertedPriceList->DisplayedMoneys->children();
						$data1_tmp['Price']['DeliveryPrice']['ConvertedPriceList']['DisplayedMoneys'] = @array();
						foreach($data5_obj as $value5){
							$data1_tmp['Price']['DeliveryPrice']['ConvertedPriceList']['DisplayedMoneys'][] = @$value5;
						}
					$data1_tmp['Price']['DeliveryPrice']['ConvertedPriceList']['displayedmoneys'] = @$data1_tmp['Price']['DeliveryPrice']['ConvertedPriceList']['DisplayedMoneys'];
				$data1_tmp['Price']['DeliveryPrice']['convertedpricelist'] = @$data1_tmp['Price']['DeliveryPrice']['ConvertedPriceList'];
			$data1_tmp['Price']['deliveryprice'] = @$data1_tmp['Price']['DeliveryPrice'];
if(!isset($data1_tmp['Price']['OneItemDeliveryPrice'])){$data1_tmp['Price']['OneItemDeliveryPrice'] = array();}
				$data3_obj = @$value1->Price->OneItemDeliveryPrice;
if(!isset($data1_tmp['Price']['OneItemDeliveryPrice']['OriginalPrice'])){$data1_tmp['Price']['OneItemDeliveryPrice']['OriginalPrice'] = array();}
					$data4_obj = @$value1->Price->OneItemDeliveryPrice->OriginalPrice;
					$data1_tmp['Price']['OneItemDeliveryPrice']['OriginalPrice'] = @$data4_obj;
				$data1_tmp['Price']['OneItemDeliveryPrice']['originalprice'] = @$data1_tmp['Price']['OneItemDeliveryPrice']['OriginalPrice'];
if(!isset($data1_tmp['Price']['OneItemDeliveryPrice']['MarginPrice'])){$data1_tmp['Price']['OneItemDeliveryPrice']['MarginPrice'] = array();}
					$data4_obj = @$value1->Price->OneItemDeliveryPrice->MarginPrice;
					$data1_tmp['Price']['OneItemDeliveryPrice']['MarginPrice'] = @$data4_obj;
				$data1_tmp['Price']['OneItemDeliveryPrice']['marginprice'] = @$data1_tmp['Price']['OneItemDeliveryPrice']['MarginPrice'];
if(!isset($data1_tmp['Price']['OneItemDeliveryPrice']['OriginalCurrencyCode'])){$data1_tmp['Price']['OneItemDeliveryPrice']['OriginalCurrencyCode'] = array();}
					$data4_obj = @$value1->Price->OneItemDeliveryPrice->OriginalCurrencyCode;
					$data1_tmp['Price']['OneItemDeliveryPrice']['OriginalCurrencyCode'] = @(string)$data4_obj;
				$data1_tmp['Price']['OneItemDeliveryPrice']['originalcurrencycode'] = @$data1_tmp['Price']['OneItemDeliveryPrice']['OriginalCurrencyCode'];
if(!isset($data1_tmp['Price']['OneItemDeliveryPrice']['ConvertedPriceList'])){$data1_tmp['Price']['OneItemDeliveryPrice']['ConvertedPriceList'] = array();}
					$data4_obj = @$value1->Price->OneItemDeliveryPrice->ConvertedPriceList;
if(!isset($data1_tmp['Price']['OneItemDeliveryPrice']['ConvertedPriceList']['Internal'])){$data1_tmp['Price']['OneItemDeliveryPrice']['ConvertedPriceList']['Internal'] = array();}
						$data5_obj = @$value1->Price->OneItemDeliveryPrice->ConvertedPriceList->Internal;
						$data1_tmp['Price']['OneItemDeliveryPrice']['ConvertedPriceList']['Internal'] = @$data5_obj;
					$data1_tmp['Price']['OneItemDeliveryPrice']['ConvertedPriceList']['internal'] = @$data1_tmp['Price']['OneItemDeliveryPrice']['ConvertedPriceList']['Internal'];
if(!isset($data1_tmp['Price']['OneItemDeliveryPrice']['ConvertedPriceList']['DisplayedMoneys'])){$data1_tmp['Price']['OneItemDeliveryPrice']['ConvertedPriceList']['DisplayedMoneys'] = array();}

	if(!isset($value1->Price->OneItemDeliveryPrice->ConvertedPriceList->DisplayedMoneys) || is_null($value1->Price->OneItemDeliveryPrice->ConvertedPriceList->DisplayedMoneys) || !$value1->Price->OneItemDeliveryPrice->ConvertedPriceList->DisplayedMoneys)						$data5_obj = @array();

	else
						$data5_obj = @$value1->Price->OneItemDeliveryPrice->ConvertedPriceList->DisplayedMoneys->children();
						$data1_tmp['Price']['OneItemDeliveryPrice']['ConvertedPriceList']['DisplayedMoneys'] = @array();
						foreach($data5_obj as $value5){
							$data1_tmp['Price']['OneItemDeliveryPrice']['ConvertedPriceList']['DisplayedMoneys'][] = @$value5;
						}
					$data1_tmp['Price']['OneItemDeliveryPrice']['ConvertedPriceList']['displayedmoneys'] = @$data1_tmp['Price']['OneItemDeliveryPrice']['ConvertedPriceList']['DisplayedMoneys'];
				$data1_tmp['Price']['OneItemDeliveryPrice']['convertedpricelist'] = @$data1_tmp['Price']['OneItemDeliveryPrice']['ConvertedPriceList'];
			$data1_tmp['Price']['oneitemdeliveryprice'] = @$data1_tmp['Price']['OneItemDeliveryPrice'];
if(!isset($data1_tmp['Price']['PriceWithoutDelivery'])){$data1_tmp['Price']['PriceWithoutDelivery'] = array();}
				$data3_obj = @$value1->Price->PriceWithoutDelivery;
if(!isset($data1_tmp['Price']['PriceWithoutDelivery']['OriginalPrice'])){$data1_tmp['Price']['PriceWithoutDelivery']['OriginalPrice'] = array();}
					$data4_obj = @$value1->Price->PriceWithoutDelivery->OriginalPrice;
					$data1_tmp['Price']['PriceWithoutDelivery']['OriginalPrice'] = @$data4_obj;
				$data1_tmp['Price']['PriceWithoutDelivery']['originalprice'] = @$data1_tmp['Price']['PriceWithoutDelivery']['OriginalPrice'];
if(!isset($data1_tmp['Price']['PriceWithoutDelivery']['MarginPrice'])){$data1_tmp['Price']['PriceWithoutDelivery']['MarginPrice'] = array();}
					$data4_obj = @$value1->Price->PriceWithoutDelivery->MarginPrice;
					$data1_tmp['Price']['PriceWithoutDelivery']['MarginPrice'] = @$data4_obj;
				$data1_tmp['Price']['PriceWithoutDelivery']['marginprice'] = @$data1_tmp['Price']['PriceWithoutDelivery']['MarginPrice'];
if(!isset($data1_tmp['Price']['PriceWithoutDelivery']['OriginalCurrencyCode'])){$data1_tmp['Price']['PriceWithoutDelivery']['OriginalCurrencyCode'] = array();}
					$data4_obj = @$value1->Price->PriceWithoutDelivery->OriginalCurrencyCode;
					$data1_tmp['Price']['PriceWithoutDelivery']['OriginalCurrencyCode'] = @(string)$data4_obj;
				$data1_tmp['Price']['PriceWithoutDelivery']['originalcurrencycode'] = @$data1_tmp['Price']['PriceWithoutDelivery']['OriginalCurrencyCode'];
if(!isset($data1_tmp['Price']['PriceWithoutDelivery']['ConvertedPriceList'])){$data1_tmp['Price']['PriceWithoutDelivery']['ConvertedPriceList'] = array();}
					$data4_obj = @$value1->Price->PriceWithoutDelivery->ConvertedPriceList;
if(!isset($data1_tmp['Price']['PriceWithoutDelivery']['ConvertedPriceList']['Internal'])){$data1_tmp['Price']['PriceWithoutDelivery']['ConvertedPriceList']['Internal'] = array();}
						$data5_obj = @$value1->Price->PriceWithoutDelivery->ConvertedPriceList->Internal;
						$data1_tmp['Price']['PriceWithoutDelivery']['ConvertedPriceList']['Internal'] = @$data5_obj;
					$data1_tmp['Price']['PriceWithoutDelivery']['ConvertedPriceList']['internal'] = @$data1_tmp['Price']['PriceWithoutDelivery']['ConvertedPriceList']['Internal'];
if(!isset($data1_tmp['Price']['PriceWithoutDelivery']['ConvertedPriceList']['DisplayedMoneys'])){$data1_tmp['Price']['PriceWithoutDelivery']['ConvertedPriceList']['DisplayedMoneys'] = array();}

	if(!isset($value1->Price->PriceWithoutDelivery->ConvertedPriceList->DisplayedMoneys) || is_null($value1->Price->PriceWithoutDelivery->ConvertedPriceList->DisplayedMoneys) || !$value1->Price->PriceWithoutDelivery->ConvertedPriceList->DisplayedMoneys)						$data5_obj = @array();

	else
						$data5_obj = @$value1->Price->PriceWithoutDelivery->ConvertedPriceList->DisplayedMoneys->children();
						$data1_tmp['Price']['PriceWithoutDelivery']['ConvertedPriceList']['DisplayedMoneys'] = @array();
						foreach($data5_obj as $value5){
							$data1_tmp['Price']['PriceWithoutDelivery']['ConvertedPriceList']['DisplayedMoneys'][] = @$value5;
						}
					$data1_tmp['Price']['PriceWithoutDelivery']['ConvertedPriceList']['displayedmoneys'] = @$data1_tmp['Price']['PriceWithoutDelivery']['ConvertedPriceList']['DisplayedMoneys'];
				$data1_tmp['Price']['PriceWithoutDelivery']['convertedpricelist'] = @$data1_tmp['Price']['PriceWithoutDelivery']['ConvertedPriceList'];
			$data1_tmp['Price']['pricewithoutdelivery'] = @$data1_tmp['Price']['PriceWithoutDelivery'];
			$data0_tmp['ConfiguredItems'][] = @$data1_tmp;
		}
		$data0[] = @$data0_tmp;
	}
	return $data0;
    }
    public function GetItemPromotionsWithAttempts($itemId, $attemptCount){
        $params = array(
            'itemId' => $itemId,
	    'attemptCount' => $attemptCount
        );
        $params += $this->defaultLogin();
        $simplexml = $this->_getData('GetItemPromotionsWithAttempts', $params);
        if (!$simplexml) return false;
        
        $data0 = array();
        
if(!isset($data0)){$data0 = array();}

	if(!isset($simplexml->Result->Content) || is_null($simplexml->Result->Content) || !$simplexml->Result->Content)	$data0_obj = @array();

	else
	$data0_obj = @$simplexml->Result->Content->children();
	$data0 = @array();
	foreach($data0_obj as $value0){
		$data0_tmp = @array();
		$data0_tmp['Id'] = @(string)$value0->Id;
		$data0_tmp['id'] = @(string)$value0->Id;
		$data0_tmp['Name'] = @(string)$value0->Name;
		$data0_tmp['name'] = @(string)$value0->Name;
		$data0_tmp['Desciption'] = @(string)$value0->Desciption;
		$data0_tmp['desciption'] = @(string)$value0->Desciption;
		$data0_tmp['StartTime'] = @$value0->StartTime;
		$data0_tmp['starttime'] = @$value0->StartTime;
		$data0_tmp['EndTime'] = @$value0->EndTime;
		$data0_tmp['endtime'] = @$value0->EndTime;
if(!isset($data0_tmp['Price'])){$data0_tmp['Price'] = array();}
		$data1_obj = @$value0->Price;
if(!isset($data0_tmp['Price']['OriginalPrice'])){$data0_tmp['Price']['OriginalPrice'] = array();}
			$data2_obj = @$value0->Price->OriginalPrice;
			$data0_tmp['Price']['OriginalPrice'] = @$data2_obj;
		$data0_tmp['Price']['originalprice'] = @$data0_tmp['Price']['OriginalPrice'];
if(!isset($data0_tmp['Price']['MarginPrice'])){$data0_tmp['Price']['MarginPrice'] = array();}
			$data2_obj = @$value0->Price->MarginPrice;
			$data0_tmp['Price']['MarginPrice'] = @$data2_obj;
		$data0_tmp['Price']['marginprice'] = @$data0_tmp['Price']['MarginPrice'];
if(!isset($data0_tmp['Price']['OriginalCurrencyCode'])){$data0_tmp['Price']['OriginalCurrencyCode'] = array();}
			$data2_obj = @$value0->Price->OriginalCurrencyCode;
			$data0_tmp['Price']['OriginalCurrencyCode'] = @(string)$data2_obj;
		$data0_tmp['Price']['originalcurrencycode'] = @$data0_tmp['Price']['OriginalCurrencyCode'];
if(!isset($data0_tmp['Price']['ConvertedPriceList'])){$data0_tmp['Price']['ConvertedPriceList'] = array();}
			$data2_obj = @$value0->Price->ConvertedPriceList;
if(!isset($data0_tmp['Price']['ConvertedPriceList']['Internal'])){$data0_tmp['Price']['ConvertedPriceList']['Internal'] = array();}
				$data3_obj = @$value0->Price->ConvertedPriceList->Internal;
				$data0_tmp['Price']['ConvertedPriceList']['Internal'] = @$data3_obj;
			$data0_tmp['Price']['ConvertedPriceList']['internal'] = @$data0_tmp['Price']['ConvertedPriceList']['Internal'];
if(!isset($data0_tmp['Price']['ConvertedPriceList']['DisplayedMoneys'])){$data0_tmp['Price']['ConvertedPriceList']['DisplayedMoneys'] = array();}

	if(!isset($value0->Price->ConvertedPriceList->DisplayedMoneys) || is_null($value0->Price->ConvertedPriceList->DisplayedMoneys) || !$value0->Price->ConvertedPriceList->DisplayedMoneys)				$data3_obj = @array();

	else
				$data3_obj = @$value0->Price->ConvertedPriceList->DisplayedMoneys->children();
				$data0_tmp['Price']['ConvertedPriceList']['DisplayedMoneys'] = @array();
				foreach($data3_obj as $value3){
					$data0_tmp['Price']['ConvertedPriceList']['DisplayedMoneys'][] = @$value3;
				}
			$data0_tmp['Price']['ConvertedPriceList']['displayedmoneys'] = @$data0_tmp['Price']['ConvertedPriceList']['DisplayedMoneys'];
		$data0_tmp['Price']['convertedpricelist'] = @$data0_tmp['Price']['ConvertedPriceList'];
if(!isset($data0_tmp['Price']['ConvertedPrice'])){$data0_tmp['Price']['ConvertedPrice'] = array();}
			$data2_obj = @$value0->Price->ConvertedPrice;
			$data0_tmp['Price']['ConvertedPrice'] = @(string)$data2_obj;
		$data0_tmp['Price']['convertedprice'] = @$data0_tmp['Price']['ConvertedPrice'];
if(!isset($data0_tmp['Price']['ConvertedPriceWithoutSign'])){$data0_tmp['Price']['ConvertedPriceWithoutSign'] = array();}
			$data2_obj = @$value0->Price->ConvertedPriceWithoutSign;
			$data0_tmp['Price']['ConvertedPriceWithoutSign'] = @(string)$data2_obj;
		$data0_tmp['Price']['convertedpricewithoutsign'] = @$data0_tmp['Price']['ConvertedPriceWithoutSign'];
if(!isset($data0_tmp['Price']['CurrencySign'])){$data0_tmp['Price']['CurrencySign'] = array();}
			$data2_obj = @$value0->Price->CurrencySign;
			$data0_tmp['Price']['CurrencySign'] = @(string)$data2_obj;
		$data0_tmp['Price']['currencysign'] = @$data0_tmp['Price']['CurrencySign'];
if(!isset($data0_tmp['Price']['CurrencyName'])){$data0_tmp['Price']['CurrencyName'] = array();}
			$data2_obj = @$value0->Price->CurrencyName;
			$data0_tmp['Price']['CurrencyName'] = @(string)$data2_obj;
		$data0_tmp['Price']['currencyname'] = @$data0_tmp['Price']['CurrencyName'];
if(!isset($data0_tmp['Price']['IsDeliverable'])){$data0_tmp['Price']['IsDeliverable'] = array();}
			$data2_obj = @$value0->Price->IsDeliverable;
			$data0_tmp['Price']['IsDeliverable'] = @$data2_obj;
		$data0_tmp['Price']['isdeliverable'] = @$data0_tmp['Price']['IsDeliverable'];
if(!isset($data0_tmp['Price']['DeliveryPrice'])){$data0_tmp['Price']['DeliveryPrice'] = array();}
			$data2_obj = @$value0->Price->DeliveryPrice;
if(!isset($data0_tmp['Price']['DeliveryPrice']['OriginalPrice'])){$data0_tmp['Price']['DeliveryPrice']['OriginalPrice'] = array();}
				$data3_obj = @$value0->Price->DeliveryPrice->OriginalPrice;
				$data0_tmp['Price']['DeliveryPrice']['OriginalPrice'] = @$data3_obj;
			$data0_tmp['Price']['DeliveryPrice']['originalprice'] = @$data0_tmp['Price']['DeliveryPrice']['OriginalPrice'];
if(!isset($data0_tmp['Price']['DeliveryPrice']['MarginPrice'])){$data0_tmp['Price']['DeliveryPrice']['MarginPrice'] = array();}
				$data3_obj = @$value0->Price->DeliveryPrice->MarginPrice;
				$data0_tmp['Price']['DeliveryPrice']['MarginPrice'] = @$data3_obj;
			$data0_tmp['Price']['DeliveryPrice']['marginprice'] = @$data0_tmp['Price']['DeliveryPrice']['MarginPrice'];
if(!isset($data0_tmp['Price']['DeliveryPrice']['OriginalCurrencyCode'])){$data0_tmp['Price']['DeliveryPrice']['OriginalCurrencyCode'] = array();}
				$data3_obj = @$value0->Price->DeliveryPrice->OriginalCurrencyCode;
				$data0_tmp['Price']['DeliveryPrice']['OriginalCurrencyCode'] = @(string)$data3_obj;
			$data0_tmp['Price']['DeliveryPrice']['originalcurrencycode'] = @$data0_tmp['Price']['DeliveryPrice']['OriginalCurrencyCode'];
if(!isset($data0_tmp['Price']['DeliveryPrice']['ConvertedPriceList'])){$data0_tmp['Price']['DeliveryPrice']['ConvertedPriceList'] = array();}
				$data3_obj = @$value0->Price->DeliveryPrice->ConvertedPriceList;
if(!isset($data0_tmp['Price']['DeliveryPrice']['ConvertedPriceList']['Internal'])){$data0_tmp['Price']['DeliveryPrice']['ConvertedPriceList']['Internal'] = array();}
					$data4_obj = @$value0->Price->DeliveryPrice->ConvertedPriceList->Internal;
					$data0_tmp['Price']['DeliveryPrice']['ConvertedPriceList']['Internal'] = @$data4_obj;
				$data0_tmp['Price']['DeliveryPrice']['ConvertedPriceList']['internal'] = @$data0_tmp['Price']['DeliveryPrice']['ConvertedPriceList']['Internal'];
if(!isset($data0_tmp['Price']['DeliveryPrice']['ConvertedPriceList']['DisplayedMoneys'])){$data0_tmp['Price']['DeliveryPrice']['ConvertedPriceList']['DisplayedMoneys'] = array();}

	if(!isset($value0->Price->DeliveryPrice->ConvertedPriceList->DisplayedMoneys) || is_null($value0->Price->DeliveryPrice->ConvertedPriceList->DisplayedMoneys) || !$value0->Price->DeliveryPrice->ConvertedPriceList->DisplayedMoneys)					$data4_obj = @array();

	else
					$data4_obj = @$value0->Price->DeliveryPrice->ConvertedPriceList->DisplayedMoneys->children();
					$data0_tmp['Price']['DeliveryPrice']['ConvertedPriceList']['DisplayedMoneys'] = @array();
					foreach($data4_obj as $value4){
						$data0_tmp['Price']['DeliveryPrice']['ConvertedPriceList']['DisplayedMoneys'][] = @$value4;
					}
				$data0_tmp['Price']['DeliveryPrice']['ConvertedPriceList']['displayedmoneys'] = @$data0_tmp['Price']['DeliveryPrice']['ConvertedPriceList']['DisplayedMoneys'];
			$data0_tmp['Price']['DeliveryPrice']['convertedpricelist'] = @$data0_tmp['Price']['DeliveryPrice']['ConvertedPriceList'];
		$data0_tmp['Price']['deliveryprice'] = @$data0_tmp['Price']['DeliveryPrice'];
if(!isset($data0_tmp['Price']['OneItemDeliveryPrice'])){$data0_tmp['Price']['OneItemDeliveryPrice'] = array();}
			$data2_obj = @$value0->Price->OneItemDeliveryPrice;
if(!isset($data0_tmp['Price']['OneItemDeliveryPrice']['OriginalPrice'])){$data0_tmp['Price']['OneItemDeliveryPrice']['OriginalPrice'] = array();}
				$data3_obj = @$value0->Price->OneItemDeliveryPrice->OriginalPrice;
				$data0_tmp['Price']['OneItemDeliveryPrice']['OriginalPrice'] = @$data3_obj;
			$data0_tmp['Price']['OneItemDeliveryPrice']['originalprice'] = @$data0_tmp['Price']['OneItemDeliveryPrice']['OriginalPrice'];
if(!isset($data0_tmp['Price']['OneItemDeliveryPrice']['MarginPrice'])){$data0_tmp['Price']['OneItemDeliveryPrice']['MarginPrice'] = array();}
				$data3_obj = @$value0->Price->OneItemDeliveryPrice->MarginPrice;
				$data0_tmp['Price']['OneItemDeliveryPrice']['MarginPrice'] = @$data3_obj;
			$data0_tmp['Price']['OneItemDeliveryPrice']['marginprice'] = @$data0_tmp['Price']['OneItemDeliveryPrice']['MarginPrice'];
if(!isset($data0_tmp['Price']['OneItemDeliveryPrice']['OriginalCurrencyCode'])){$data0_tmp['Price']['OneItemDeliveryPrice']['OriginalCurrencyCode'] = array();}
				$data3_obj = @$value0->Price->OneItemDeliveryPrice->OriginalCurrencyCode;
				$data0_tmp['Price']['OneItemDeliveryPrice']['OriginalCurrencyCode'] = @(string)$data3_obj;
			$data0_tmp['Price']['OneItemDeliveryPrice']['originalcurrencycode'] = @$data0_tmp['Price']['OneItemDeliveryPrice']['OriginalCurrencyCode'];
if(!isset($data0_tmp['Price']['OneItemDeliveryPrice']['ConvertedPriceList'])){$data0_tmp['Price']['OneItemDeliveryPrice']['ConvertedPriceList'] = array();}
				$data3_obj = @$value0->Price->OneItemDeliveryPrice->ConvertedPriceList;
if(!isset($data0_tmp['Price']['OneItemDeliveryPrice']['ConvertedPriceList']['Internal'])){$data0_tmp['Price']['OneItemDeliveryPrice']['ConvertedPriceList']['Internal'] = array();}
					$data4_obj = @$value0->Price->OneItemDeliveryPrice->ConvertedPriceList->Internal;
					$data0_tmp['Price']['OneItemDeliveryPrice']['ConvertedPriceList']['Internal'] = @$data4_obj;
				$data0_tmp['Price']['OneItemDeliveryPrice']['ConvertedPriceList']['internal'] = @$data0_tmp['Price']['OneItemDeliveryPrice']['ConvertedPriceList']['Internal'];
if(!isset($data0_tmp['Price']['OneItemDeliveryPrice']['ConvertedPriceList']['DisplayedMoneys'])){$data0_tmp['Price']['OneItemDeliveryPrice']['ConvertedPriceList']['DisplayedMoneys'] = array();}

	if(!isset($value0->Price->OneItemDeliveryPrice->ConvertedPriceList->DisplayedMoneys) || is_null($value0->Price->OneItemDeliveryPrice->ConvertedPriceList->DisplayedMoneys) || !$value0->Price->OneItemDeliveryPrice->ConvertedPriceList->DisplayedMoneys)					$data4_obj = @array();

	else
					$data4_obj = @$value0->Price->OneItemDeliveryPrice->ConvertedPriceList->DisplayedMoneys->children();
					$data0_tmp['Price']['OneItemDeliveryPrice']['ConvertedPriceList']['DisplayedMoneys'] = @array();
					foreach($data4_obj as $value4){
						$data0_tmp['Price']['OneItemDeliveryPrice']['ConvertedPriceList']['DisplayedMoneys'][] = @$value4;
					}
				$data0_tmp['Price']['OneItemDeliveryPrice']['ConvertedPriceList']['displayedmoneys'] = @$data0_tmp['Price']['OneItemDeliveryPrice']['ConvertedPriceList']['DisplayedMoneys'];
			$data0_tmp['Price']['OneItemDeliveryPrice']['convertedpricelist'] = @$data0_tmp['Price']['OneItemDeliveryPrice']['ConvertedPriceList'];
		$data0_tmp['Price']['oneitemdeliveryprice'] = @$data0_tmp['Price']['OneItemDeliveryPrice'];
if(!isset($data0_tmp['Price']['PriceWithoutDelivery'])){$data0_tmp['Price']['PriceWithoutDelivery'] = array();}
			$data2_obj = @$value0->Price->PriceWithoutDelivery;
if(!isset($data0_tmp['Price']['PriceWithoutDelivery']['OriginalPrice'])){$data0_tmp['Price']['PriceWithoutDelivery']['OriginalPrice'] = array();}
				$data3_obj = @$value0->Price->PriceWithoutDelivery->OriginalPrice;
				$data0_tmp['Price']['PriceWithoutDelivery']['OriginalPrice'] = @$data3_obj;
			$data0_tmp['Price']['PriceWithoutDelivery']['originalprice'] = @$data0_tmp['Price']['PriceWithoutDelivery']['OriginalPrice'];
if(!isset($data0_tmp['Price']['PriceWithoutDelivery']['MarginPrice'])){$data0_tmp['Price']['PriceWithoutDelivery']['MarginPrice'] = array();}
				$data3_obj = @$value0->Price->PriceWithoutDelivery->MarginPrice;
				$data0_tmp['Price']['PriceWithoutDelivery']['MarginPrice'] = @$data3_obj;
			$data0_tmp['Price']['PriceWithoutDelivery']['marginprice'] = @$data0_tmp['Price']['PriceWithoutDelivery']['MarginPrice'];
if(!isset($data0_tmp['Price']['PriceWithoutDelivery']['OriginalCurrencyCode'])){$data0_tmp['Price']['PriceWithoutDelivery']['OriginalCurrencyCode'] = array();}
				$data3_obj = @$value0->Price->PriceWithoutDelivery->OriginalCurrencyCode;
				$data0_tmp['Price']['PriceWithoutDelivery']['OriginalCurrencyCode'] = @(string)$data3_obj;
			$data0_tmp['Price']['PriceWithoutDelivery']['originalcurrencycode'] = @$data0_tmp['Price']['PriceWithoutDelivery']['OriginalCurrencyCode'];
if(!isset($data0_tmp['Price']['PriceWithoutDelivery']['ConvertedPriceList'])){$data0_tmp['Price']['PriceWithoutDelivery']['ConvertedPriceList'] = array();}
				$data3_obj = @$value0->Price->PriceWithoutDelivery->ConvertedPriceList;
if(!isset($data0_tmp['Price']['PriceWithoutDelivery']['ConvertedPriceList']['Internal'])){$data0_tmp['Price']['PriceWithoutDelivery']['ConvertedPriceList']['Internal'] = array();}
					$data4_obj = @$value0->Price->PriceWithoutDelivery->ConvertedPriceList->Internal;
					$data0_tmp['Price']['PriceWithoutDelivery']['ConvertedPriceList']['Internal'] = @$data4_obj;
				$data0_tmp['Price']['PriceWithoutDelivery']['ConvertedPriceList']['internal'] = @$data0_tmp['Price']['PriceWithoutDelivery']['ConvertedPriceList']['Internal'];
if(!isset($data0_tmp['Price']['PriceWithoutDelivery']['ConvertedPriceList']['DisplayedMoneys'])){$data0_tmp['Price']['PriceWithoutDelivery']['ConvertedPriceList']['DisplayedMoneys'] = array();}

	if(!isset($value0->Price->PriceWithoutDelivery->ConvertedPriceList->DisplayedMoneys) || is_null($value0->Price->PriceWithoutDelivery->ConvertedPriceList->DisplayedMoneys) || !$value0->Price->PriceWithoutDelivery->ConvertedPriceList->DisplayedMoneys)					$data4_obj = @array();

	else
					$data4_obj = @$value0->Price->PriceWithoutDelivery->ConvertedPriceList->DisplayedMoneys->children();
					$data0_tmp['Price']['PriceWithoutDelivery']['ConvertedPriceList']['DisplayedMoneys'] = @array();
					foreach($data4_obj as $value4){
						$data0_tmp['Price']['PriceWithoutDelivery']['ConvertedPriceList']['DisplayedMoneys'][] = @$value4;
					}
				$data0_tmp['Price']['PriceWithoutDelivery']['ConvertedPriceList']['displayedmoneys'] = @$data0_tmp['Price']['PriceWithoutDelivery']['ConvertedPriceList']['DisplayedMoneys'];
			$data0_tmp['Price']['PriceWithoutDelivery']['convertedpricelist'] = @$data0_tmp['Price']['PriceWithoutDelivery']['ConvertedPriceList'];
		$data0_tmp['Price']['pricewithoutdelivery'] = @$data0_tmp['Price']['PriceWithoutDelivery'];
		$data0_tmp['OtherNeed'] = @(string)$value0->OtherNeed;
		$data0_tmp['otherneed'] = @(string)$value0->OtherNeed;
		$data0_tmp['OtherSend'] = @(string)$value0->OtherSend;
		$data0_tmp['othersend'] = @(string)$value0->OtherSend;
if(!isset($data0_tmp['ConfiguredItems'])){$data0_tmp['ConfiguredItems'] = array();}

	if(!isset($value0->ConfiguredItems) || is_null($value0->ConfiguredItems) || !$value0->ConfiguredItems)		$data1_obj = @array();

	else
		$data1_obj = @$value0->ConfiguredItems->children();
		$data0_tmp['ConfiguredItems'] = @array();
		foreach($data1_obj as $value1){
			$data1_tmp = @array();
			$data1_tmp['Id'] = @(string)$value1->Id;
			$data1_tmp['id'] = @(string)$value1->Id;
if(!isset($data1_tmp['Price'])){$data1_tmp['Price'] = array();}
			$data2_obj = @$value1->Price;
if(!isset($data1_tmp['Price']['OriginalPrice'])){$data1_tmp['Price']['OriginalPrice'] = array();}
				$data3_obj = @$value1->Price->OriginalPrice;
				$data1_tmp['Price']['OriginalPrice'] = @$data3_obj;
			$data1_tmp['Price']['originalprice'] = @$data1_tmp['Price']['OriginalPrice'];
if(!isset($data1_tmp['Price']['MarginPrice'])){$data1_tmp['Price']['MarginPrice'] = array();}
				$data3_obj = @$value1->Price->MarginPrice;
				$data1_tmp['Price']['MarginPrice'] = @$data3_obj;
			$data1_tmp['Price']['marginprice'] = @$data1_tmp['Price']['MarginPrice'];
if(!isset($data1_tmp['Price']['OriginalCurrencyCode'])){$data1_tmp['Price']['OriginalCurrencyCode'] = array();}
				$data3_obj = @$value1->Price->OriginalCurrencyCode;
				$data1_tmp['Price']['OriginalCurrencyCode'] = @(string)$data3_obj;
			$data1_tmp['Price']['originalcurrencycode'] = @$data1_tmp['Price']['OriginalCurrencyCode'];
if(!isset($data1_tmp['Price']['ConvertedPriceList'])){$data1_tmp['Price']['ConvertedPriceList'] = array();}
				$data3_obj = @$value1->Price->ConvertedPriceList;
if(!isset($data1_tmp['Price']['ConvertedPriceList']['Internal'])){$data1_tmp['Price']['ConvertedPriceList']['Internal'] = array();}
					$data4_obj = @$value1->Price->ConvertedPriceList->Internal;
					$data1_tmp['Price']['ConvertedPriceList']['Internal'] = @$data4_obj;
				$data1_tmp['Price']['ConvertedPriceList']['internal'] = @$data1_tmp['Price']['ConvertedPriceList']['Internal'];
if(!isset($data1_tmp['Price']['ConvertedPriceList']['DisplayedMoneys'])){$data1_tmp['Price']['ConvertedPriceList']['DisplayedMoneys'] = array();}

	if(!isset($value1->Price->ConvertedPriceList->DisplayedMoneys) || is_null($value1->Price->ConvertedPriceList->DisplayedMoneys) || !$value1->Price->ConvertedPriceList->DisplayedMoneys)					$data4_obj = @array();

	else
					$data4_obj = @$value1->Price->ConvertedPriceList->DisplayedMoneys->children();
					$data1_tmp['Price']['ConvertedPriceList']['DisplayedMoneys'] = @array();
					foreach($data4_obj as $value4){
						$data1_tmp['Price']['ConvertedPriceList']['DisplayedMoneys'][] = @$value4;
					}
				$data1_tmp['Price']['ConvertedPriceList']['displayedmoneys'] = @$data1_tmp['Price']['ConvertedPriceList']['DisplayedMoneys'];
			$data1_tmp['Price']['convertedpricelist'] = @$data1_tmp['Price']['ConvertedPriceList'];
if(!isset($data1_tmp['Price']['ConvertedPrice'])){$data1_tmp['Price']['ConvertedPrice'] = array();}
				$data3_obj = @$value1->Price->ConvertedPrice;
				$data1_tmp['Price']['ConvertedPrice'] = @(string)$data3_obj;
			$data1_tmp['Price']['convertedprice'] = @$data1_tmp['Price']['ConvertedPrice'];
if(!isset($data1_tmp['Price']['ConvertedPriceWithoutSign'])){$data1_tmp['Price']['ConvertedPriceWithoutSign'] = array();}
				$data3_obj = @$value1->Price->ConvertedPriceWithoutSign;
				$data1_tmp['Price']['ConvertedPriceWithoutSign'] = @(string)$data3_obj;
			$data1_tmp['Price']['convertedpricewithoutsign'] = @$data1_tmp['Price']['ConvertedPriceWithoutSign'];
if(!isset($data1_tmp['Price']['CurrencySign'])){$data1_tmp['Price']['CurrencySign'] = array();}
				$data3_obj = @$value1->Price->CurrencySign;
				$data1_tmp['Price']['CurrencySign'] = @(string)$data3_obj;
			$data1_tmp['Price']['currencysign'] = @$data1_tmp['Price']['CurrencySign'];
if(!isset($data1_tmp['Price']['CurrencyName'])){$data1_tmp['Price']['CurrencyName'] = array();}
				$data3_obj = @$value1->Price->CurrencyName;
				$data1_tmp['Price']['CurrencyName'] = @(string)$data3_obj;
			$data1_tmp['Price']['currencyname'] = @$data1_tmp['Price']['CurrencyName'];
if(!isset($data1_tmp['Price']['IsDeliverable'])){$data1_tmp['Price']['IsDeliverable'] = array();}
				$data3_obj = @$value1->Price->IsDeliverable;
				$data1_tmp['Price']['IsDeliverable'] = @$data3_obj;
			$data1_tmp['Price']['isdeliverable'] = @$data1_tmp['Price']['IsDeliverable'];
if(!isset($data1_tmp['Price']['DeliveryPrice'])){$data1_tmp['Price']['DeliveryPrice'] = array();}
				$data3_obj = @$value1->Price->DeliveryPrice;
if(!isset($data1_tmp['Price']['DeliveryPrice']['OriginalPrice'])){$data1_tmp['Price']['DeliveryPrice']['OriginalPrice'] = array();}
					$data4_obj = @$value1->Price->DeliveryPrice->OriginalPrice;
					$data1_tmp['Price']['DeliveryPrice']['OriginalPrice'] = @$data4_obj;
				$data1_tmp['Price']['DeliveryPrice']['originalprice'] = @$data1_tmp['Price']['DeliveryPrice']['OriginalPrice'];
if(!isset($data1_tmp['Price']['DeliveryPrice']['MarginPrice'])){$data1_tmp['Price']['DeliveryPrice']['MarginPrice'] = array();}
					$data4_obj = @$value1->Price->DeliveryPrice->MarginPrice;
					$data1_tmp['Price']['DeliveryPrice']['MarginPrice'] = @$data4_obj;
				$data1_tmp['Price']['DeliveryPrice']['marginprice'] = @$data1_tmp['Price']['DeliveryPrice']['MarginPrice'];
if(!isset($data1_tmp['Price']['DeliveryPrice']['OriginalCurrencyCode'])){$data1_tmp['Price']['DeliveryPrice']['OriginalCurrencyCode'] = array();}
					$data4_obj = @$value1->Price->DeliveryPrice->OriginalCurrencyCode;
					$data1_tmp['Price']['DeliveryPrice']['OriginalCurrencyCode'] = @(string)$data4_obj;
				$data1_tmp['Price']['DeliveryPrice']['originalcurrencycode'] = @$data1_tmp['Price']['DeliveryPrice']['OriginalCurrencyCode'];
if(!isset($data1_tmp['Price']['DeliveryPrice']['ConvertedPriceList'])){$data1_tmp['Price']['DeliveryPrice']['ConvertedPriceList'] = array();}
					$data4_obj = @$value1->Price->DeliveryPrice->ConvertedPriceList;
if(!isset($data1_tmp['Price']['DeliveryPrice']['ConvertedPriceList']['Internal'])){$data1_tmp['Price']['DeliveryPrice']['ConvertedPriceList']['Internal'] = array();}
						$data5_obj = @$value1->Price->DeliveryPrice->ConvertedPriceList->Internal;
						$data1_tmp['Price']['DeliveryPrice']['ConvertedPriceList']['Internal'] = @$data5_obj;
					$data1_tmp['Price']['DeliveryPrice']['ConvertedPriceList']['internal'] = @$data1_tmp['Price']['DeliveryPrice']['ConvertedPriceList']['Internal'];
if(!isset($data1_tmp['Price']['DeliveryPrice']['ConvertedPriceList']['DisplayedMoneys'])){$data1_tmp['Price']['DeliveryPrice']['ConvertedPriceList']['DisplayedMoneys'] = array();}

	if(!isset($value1->Price->DeliveryPrice->ConvertedPriceList->DisplayedMoneys) || is_null($value1->Price->DeliveryPrice->ConvertedPriceList->DisplayedMoneys) || !$value1->Price->DeliveryPrice->ConvertedPriceList->DisplayedMoneys)						$data5_obj = @array();

	else
						$data5_obj = @$value1->Price->DeliveryPrice->ConvertedPriceList->DisplayedMoneys->children();
						$data1_tmp['Price']['DeliveryPrice']['ConvertedPriceList']['DisplayedMoneys'] = @array();
						foreach($data5_obj as $value5){
							$data1_tmp['Price']['DeliveryPrice']['ConvertedPriceList']['DisplayedMoneys'][] = @$value5;
						}
					$data1_tmp['Price']['DeliveryPrice']['ConvertedPriceList']['displayedmoneys'] = @$data1_tmp['Price']['DeliveryPrice']['ConvertedPriceList']['DisplayedMoneys'];
				$data1_tmp['Price']['DeliveryPrice']['convertedpricelist'] = @$data1_tmp['Price']['DeliveryPrice']['ConvertedPriceList'];
			$data1_tmp['Price']['deliveryprice'] = @$data1_tmp['Price']['DeliveryPrice'];
if(!isset($data1_tmp['Price']['OneItemDeliveryPrice'])){$data1_tmp['Price']['OneItemDeliveryPrice'] = array();}
				$data3_obj = @$value1->Price->OneItemDeliveryPrice;
if(!isset($data1_tmp['Price']['OneItemDeliveryPrice']['OriginalPrice'])){$data1_tmp['Price']['OneItemDeliveryPrice']['OriginalPrice'] = array();}
					$data4_obj = @$value1->Price->OneItemDeliveryPrice->OriginalPrice;
					$data1_tmp['Price']['OneItemDeliveryPrice']['OriginalPrice'] = @$data4_obj;
				$data1_tmp['Price']['OneItemDeliveryPrice']['originalprice'] = @$data1_tmp['Price']['OneItemDeliveryPrice']['OriginalPrice'];
if(!isset($data1_tmp['Price']['OneItemDeliveryPrice']['MarginPrice'])){$data1_tmp['Price']['OneItemDeliveryPrice']['MarginPrice'] = array();}
					$data4_obj = @$value1->Price->OneItemDeliveryPrice->MarginPrice;
					$data1_tmp['Price']['OneItemDeliveryPrice']['MarginPrice'] = @$data4_obj;
				$data1_tmp['Price']['OneItemDeliveryPrice']['marginprice'] = @$data1_tmp['Price']['OneItemDeliveryPrice']['MarginPrice'];
if(!isset($data1_tmp['Price']['OneItemDeliveryPrice']['OriginalCurrencyCode'])){$data1_tmp['Price']['OneItemDeliveryPrice']['OriginalCurrencyCode'] = array();}
					$data4_obj = @$value1->Price->OneItemDeliveryPrice->OriginalCurrencyCode;
					$data1_tmp['Price']['OneItemDeliveryPrice']['OriginalCurrencyCode'] = @(string)$data4_obj;
				$data1_tmp['Price']['OneItemDeliveryPrice']['originalcurrencycode'] = @$data1_tmp['Price']['OneItemDeliveryPrice']['OriginalCurrencyCode'];
if(!isset($data1_tmp['Price']['OneItemDeliveryPrice']['ConvertedPriceList'])){$data1_tmp['Price']['OneItemDeliveryPrice']['ConvertedPriceList'] = array();}
					$data4_obj = @$value1->Price->OneItemDeliveryPrice->ConvertedPriceList;
if(!isset($data1_tmp['Price']['OneItemDeliveryPrice']['ConvertedPriceList']['Internal'])){$data1_tmp['Price']['OneItemDeliveryPrice']['ConvertedPriceList']['Internal'] = array();}
						$data5_obj = @$value1->Price->OneItemDeliveryPrice->ConvertedPriceList->Internal;
						$data1_tmp['Price']['OneItemDeliveryPrice']['ConvertedPriceList']['Internal'] = @$data5_obj;
					$data1_tmp['Price']['OneItemDeliveryPrice']['ConvertedPriceList']['internal'] = @$data1_tmp['Price']['OneItemDeliveryPrice']['ConvertedPriceList']['Internal'];
if(!isset($data1_tmp['Price']['OneItemDeliveryPrice']['ConvertedPriceList']['DisplayedMoneys'])){$data1_tmp['Price']['OneItemDeliveryPrice']['ConvertedPriceList']['DisplayedMoneys'] = array();}

	if(!isset($value1->Price->OneItemDeliveryPrice->ConvertedPriceList->DisplayedMoneys) || is_null($value1->Price->OneItemDeliveryPrice->ConvertedPriceList->DisplayedMoneys) || !$value1->Price->OneItemDeliveryPrice->ConvertedPriceList->DisplayedMoneys)						$data5_obj = @array();

	else
						$data5_obj = @$value1->Price->OneItemDeliveryPrice->ConvertedPriceList->DisplayedMoneys->children();
						$data1_tmp['Price']['OneItemDeliveryPrice']['ConvertedPriceList']['DisplayedMoneys'] = @array();
						foreach($data5_obj as $value5){
							$data1_tmp['Price']['OneItemDeliveryPrice']['ConvertedPriceList']['DisplayedMoneys'][] = @$value5;
						}
					$data1_tmp['Price']['OneItemDeliveryPrice']['ConvertedPriceList']['displayedmoneys'] = @$data1_tmp['Price']['OneItemDeliveryPrice']['ConvertedPriceList']['DisplayedMoneys'];
				$data1_tmp['Price']['OneItemDeliveryPrice']['convertedpricelist'] = @$data1_tmp['Price']['OneItemDeliveryPrice']['ConvertedPriceList'];
			$data1_tmp['Price']['oneitemdeliveryprice'] = @$data1_tmp['Price']['OneItemDeliveryPrice'];
if(!isset($data1_tmp['Price']['PriceWithoutDelivery'])){$data1_tmp['Price']['PriceWithoutDelivery'] = array();}
				$data3_obj = @$value1->Price->PriceWithoutDelivery;
if(!isset($data1_tmp['Price']['PriceWithoutDelivery']['OriginalPrice'])){$data1_tmp['Price']['PriceWithoutDelivery']['OriginalPrice'] = array();}
					$data4_obj = @$value1->Price->PriceWithoutDelivery->OriginalPrice;
					$data1_tmp['Price']['PriceWithoutDelivery']['OriginalPrice'] = @$data4_obj;
				$data1_tmp['Price']['PriceWithoutDelivery']['originalprice'] = @$data1_tmp['Price']['PriceWithoutDelivery']['OriginalPrice'];
if(!isset($data1_tmp['Price']['PriceWithoutDelivery']['MarginPrice'])){$data1_tmp['Price']['PriceWithoutDelivery']['MarginPrice'] = array();}
					$data4_obj = @$value1->Price->PriceWithoutDelivery->MarginPrice;
					$data1_tmp['Price']['PriceWithoutDelivery']['MarginPrice'] = @$data4_obj;
				$data1_tmp['Price']['PriceWithoutDelivery']['marginprice'] = @$data1_tmp['Price']['PriceWithoutDelivery']['MarginPrice'];
if(!isset($data1_tmp['Price']['PriceWithoutDelivery']['OriginalCurrencyCode'])){$data1_tmp['Price']['PriceWithoutDelivery']['OriginalCurrencyCode'] = array();}
					$data4_obj = @$value1->Price->PriceWithoutDelivery->OriginalCurrencyCode;
					$data1_tmp['Price']['PriceWithoutDelivery']['OriginalCurrencyCode'] = @(string)$data4_obj;
				$data1_tmp['Price']['PriceWithoutDelivery']['originalcurrencycode'] = @$data1_tmp['Price']['PriceWithoutDelivery']['OriginalCurrencyCode'];
if(!isset($data1_tmp['Price']['PriceWithoutDelivery']['ConvertedPriceList'])){$data1_tmp['Price']['PriceWithoutDelivery']['ConvertedPriceList'] = array();}
					$data4_obj = @$value1->Price->PriceWithoutDelivery->ConvertedPriceList;
if(!isset($data1_tmp['Price']['PriceWithoutDelivery']['ConvertedPriceList']['Internal'])){$data1_tmp['Price']['PriceWithoutDelivery']['ConvertedPriceList']['Internal'] = array();}
						$data5_obj = @$value1->Price->PriceWithoutDelivery->ConvertedPriceList->Internal;
						$data1_tmp['Price']['PriceWithoutDelivery']['ConvertedPriceList']['Internal'] = @$data5_obj;
					$data1_tmp['Price']['PriceWithoutDelivery']['ConvertedPriceList']['internal'] = @$data1_tmp['Price']['PriceWithoutDelivery']['ConvertedPriceList']['Internal'];
if(!isset($data1_tmp['Price']['PriceWithoutDelivery']['ConvertedPriceList']['DisplayedMoneys'])){$data1_tmp['Price']['PriceWithoutDelivery']['ConvertedPriceList']['DisplayedMoneys'] = array();}

	if(!isset($value1->Price->PriceWithoutDelivery->ConvertedPriceList->DisplayedMoneys) || is_null($value1->Price->PriceWithoutDelivery->ConvertedPriceList->DisplayedMoneys) || !$value1->Price->PriceWithoutDelivery->ConvertedPriceList->DisplayedMoneys)						$data5_obj = @array();

	else
						$data5_obj = @$value1->Price->PriceWithoutDelivery->ConvertedPriceList->DisplayedMoneys->children();
						$data1_tmp['Price']['PriceWithoutDelivery']['ConvertedPriceList']['DisplayedMoneys'] = @array();
						foreach($data5_obj as $value5){
							$data1_tmp['Price']['PriceWithoutDelivery']['ConvertedPriceList']['DisplayedMoneys'][] = @$value5;
						}
					$data1_tmp['Price']['PriceWithoutDelivery']['ConvertedPriceList']['displayedmoneys'] = @$data1_tmp['Price']['PriceWithoutDelivery']['ConvertedPriceList']['DisplayedMoneys'];
				$data1_tmp['Price']['PriceWithoutDelivery']['convertedpricelist'] = @$data1_tmp['Price']['PriceWithoutDelivery']['ConvertedPriceList'];
			$data1_tmp['Price']['pricewithoutdelivery'] = @$data1_tmp['Price']['PriceWithoutDelivery'];
			$data0_tmp['ConfiguredItems'][] = @$data1_tmp;
		}
		$data0[] = @$data0_tmp;
	}
	return $data0;
    }
    public function GetItemDescription($itemId){
        $params = array(
            'itemId' => $itemId
        );
        $params += $this->defaultLogin();
        $simplexml = $this->_getData('GetItemDescription', $params);
        if (!$simplexml) return false;
        
        $data0 = array();
        
if(!isset($data0)){$data0 = array();}
	$data0_obj = @$simplexml->OtapiItemDescription->ItemDescription;
	$data0 = @$data0_obj;
	return $data0;
    }
    public function GetItemOriginalDescription($itemId){
        $params = array(
            'itemId' => $itemId
        );
        $params += $this->defaultLogin();
        $simplexml = $this->_getData('GetItemOriginalDescription', $params);
        if (!$simplexml) return false;
        
        $data0 = array();
        
if(!isset($data0)){$data0 = array();}
	$data0_obj = @$simplexml->OtapiItemDescription->ItemDescription;
	$data0 = @$data0_obj;
	return $data0;
    }
    public function GetConfiguredItemInfoList($itemId, $configurators){
        $params = array(
            'itemId' => $itemId,
	    'configurators' => $configurators
        );
        $params += $this->defaultLogin();
        $simplexml = $this->_getData('GetConfiguredItemInfoList', $params);
        if (!$simplexml) return false;
        
        $data0 = array();
        
if(!isset($data0)){$data0 = array();}

	if(!isset($simplexml->ConfiguredItems->Content) || is_null($simplexml->ConfiguredItems->Content) || !$simplexml->ConfiguredItems->Content)	$data0_obj = @array();

	else
	$data0_obj = @$simplexml->ConfiguredItems->Content->children();
	$data0 = @array();
	foreach($data0_obj as $value0){
		$data0[] = @$value0;
	}
	return $data0;
    }
    public function GetTradeRateInfoListFrame($itemId, $framePosition = 0, $frameSize = 18){
        $params = array(
            'itemId' => $itemId,
	    'framePosition' => $framePosition,
	    'frameSize' => $frameSize
        );
        $params += $this->defaultLogin();
        $simplexml = $this->_getData('GetTradeRateInfoListFrame', $params);
        if (!$simplexml) return false;
        
        $data0 = array();
        
if(!isset($data0)){$data0 = array();}
	$data0_obj = @$simplexml->TradeRateInfoList;
if(!isset($data0['Content'])){$data0['Content'] = array();}

	if(!isset($simplexml->TradeRateInfoList->Content) || is_null($simplexml->TradeRateInfoList->Content) || !$simplexml->TradeRateInfoList->Content)		$data1_obj = @array();

	else
		$data1_obj = @$simplexml->TradeRateInfoList->Content->children();
		$data0['Content'] = @array();
		foreach($data1_obj as $value1){
			$data1_tmp = @array();
			$data1_tmp['SubOrderId'] = @(string)$value1->SubOrderId;
			$data1_tmp['suborderid'] = @(string)$value1->SubOrderId;
			$data1_tmp['TransactionId'] = @(string)$value1->TransactionId;
			$data1_tmp['transactionid'] = @(string)$value1->TransactionId;
			$data1_tmp['Content'] = @(string)$value1->Content;
			$data1_tmp['content'] = @(string)$value1->Content;
			$data1_tmp['CreatedDate'] = @$value1->CreatedDate;
			$data1_tmp['createddate'] = @$value1->CreatedDate;
			$data1_tmp['UserNick'] = @(string)$value1->UserNick;
			$data1_tmp['usernick'] = @(string)$value1->UserNick;
			$data1_tmp['Reply'] = @(string)$value1->Reply;
			$data1_tmp['reply'] = @(string)$value1->Reply;
			$data1_tmp['UserRole'] = @(string)$value1->UserRole;
			$data1_tmp['userrole'] = @(string)$value1->UserRole;
			$data1_tmp['Result'] = @(string)$value1->Result;
			$data1_tmp['result'] = @(string)$value1->Result;
			$data0['Content'][] = @$data1_tmp;
		}
	$data0['content'] = @$data0['Content'];
if(!isset($data0['TotalCount'])){$data0['TotalCount'] = array();}
		$data1_obj = @$simplexml->TradeRateInfoList->TotalCount;
		$data0['TotalCount'] = @$data1_obj;
	$data0['totalcount'] = @$data0['TotalCount'];
	return $data0;
    }
    public function GetNote($sessionId)
    {
        $params = $this->defaultLogin();

        if (!$params) return false;
        
        $params += array(
            'sessionId' => $sessionId,
        );

        $simplexml = $this->_getData('GetNote', $params);
        //print_r($simplexml);
        if (!$simplexml) return false; 

        $data = $simplexml->CollectionInfo->Elements->children();
		
        $userNote = array();
        $i = 0;

        foreach($data as $item)
        {
            $userNote[$i]['ItemId'] = (string)$item->ItemId;
            $userNote[$i]['Id'] = (string)$item->Id;
            $userNote[$i]['ItemTitle'] = (string)$item->ItemTitle;
            $userNote[$i]['ConfigurationId'] = (string)$item->ConfigurationId;
            $userNote[$i]['Price'] = (string)$item->Price;
            $userNote[$i]['CurrencySign'] = (string)$item->CurrencySign;
            $userNote[$i]['Quantity'] = (string)$item->Quantity;
            $userNote[$i]['Cost'] = (string)$item->TotalCost;
            foreach ($item->Fields->FieldInfo as $field){
                $userNote[$i][(string)$field['Name']] = (string)$field['Value'];
            }
            //$userNote[$i]['ExternalURL'] = (string)$item->ExternalURL;
            //$userNote[$i]['PictureURL'] = (string)$item->PictureURL;
            $i++;	
        }
        return $userNote;
    } 
public function AddItemToNote($sessionId, $itemId, $quantity, $itemtitle, $confid, $promoId, $catId, $catName,
$price, $currencyName, $externalURL, $pictureURL, $vendorId, $confitem, $weight, $comment='')
{
$params = $this->defaultLogin();

if (!$params) return false;

$fields = '<Fields>';
    $fields.= '<FieldInfo Name="ItemTitle" Value="'.htmlspecialchars($itemtitle). '"/>';
    $fields.= '<FieldInfo Name="VendorId" Value="'.htmlspecialchars($vendorId) .'"/>';
    $fields.= '<FieldInfo Name="ItemConfiguration" Value="'.htmlspecialchars($confitem) .'"/>';
    $fields.= '<FieldInfo Name="ConfigurationId" Value="'.htmlspecialchars($confid) .'"/>';
    $fields.= '<FieldInfo Name="ExternalURL" Value="'.htmlspecialchars($externalURL).'"/>';
    $fields.= '<FieldInfo Name="PictureURL" Value="'.htmlspecialchars($pictureURL).'"/>';
    $fields.= '<FieldInfo Name="Weight" Value="'.htmlspecialchars($weight).'"/>';
    $fields.= '<FieldInfo Name="Comment" Value="'.htmlspecialchars($comment).'"/>';

    if($promoId)
    $fields.= '<FieldInfo Name="PromoId" Value="'.htmlspecialchars($promoId).'"/>';
    $fields.= '<FieldInfo Name="CategoryId" Value="'.htmlspecialchars($catId).'"/>';
    $fields.= '<FieldInfo Name="CategoryName" Value="'.htmlspecialchars($catName).'"/>';
    $fields.= '</Fields>';

$params += array(
'sessionId' => $sessionId,
'itemId'	=> $itemId,
'quantity'  => $quantity,
'configurationId' => $confid,
'price' => $price,
'currencyName'=> $currencyName,
'fieldParameters'=> $fields,
);

$simplexml = $this->_getData('AddItemToNote', $params);

if (!$simplexml) return false;

return (int)$simplexml->Result;
}
    public function RemoveItemFromNote($sessionId, $elementId){
        $params = array(
            'sessionId' => $sessionId,
	    'elementId' => $elementId
        );
        $params += $this->defaultLogin();
        $simplexml = $this->_getData('RemoveItemFromNote', $params);
        if (!$simplexml) return false;
        
        $data0 = array();
        
if(!isset($data0)){$data0 = array();}
	$data0_obj = @$simplexml;
	$data0 = @$data0_obj;
	return $data0;
    }
    public function EditNoteItemQuantity($sessionId, $elementId, $quantity){
        $params = array(
            'sessionId' => $sessionId,
	    'elementId' => $elementId,
	    'quantity' => $quantity
        );
        $params += $this->defaultLogin();
        $simplexml = $this->_getData('EditNoteItemQuantity', $params);
        if (!$simplexml) return false;
        
        $data0 = array();
        
if(!isset($data0)){$data0 = array();}
	$data0_obj = @$simplexml;
	$data0 = @$data0_obj;
	return $data0;
    }
    public function EditNoteItemFields($sessionId, $elementId, $fieldParameters){
        $params = array(
            'sessionId' => $sessionId,
	    'elementId' => $elementId,
	    'fieldParameters' => $fieldParameters
        );
        $params += $this->defaultLogin();
        $simplexml = $this->_getData('EditNoteItemFields', $params);
        if (!$simplexml) return false;
        
        $data0 = array();
        
if(!isset($data0)){$data0 = array();}
	$data0_obj = @$simplexml;
	$data0 = @$data0_obj;
	return $data0;
    }
    public function ClearNote($sessionId){
        $params = array(
            'sessionId' => $sessionId
        );
        $params += $this->defaultLogin();
        $simplexml = $this->_getData('ClearNote', $params);
        if (!$simplexml) return false;
        
        $data0 = array();
        
if(!isset($data0)){$data0 = array();}
	$data0_obj = @$simplexml;
	$data0 = @$data0_obj;
	return $data0;
    }
    public function MoveItemFromNoteToBasket($sessionId, $elementId){
        $params = array(
            'sessionId' => $sessionId,
	    'elementId' => $elementId
        );
        $params += $this->defaultLogin();
        $simplexml = $this->_getData('MoveItemFromNoteToBasket', $params);
        if (!$simplexml) return false;
        
        $data0 = array();
        
if(!isset($data0)){$data0 = array();}
	$data0_obj = @$simplexml;
	$data0 = @$data0_obj;
	return $data0;
    }
    public function MoveAllItemsFromNoteToBasket($sessionId){
        $params = array(
            'sessionId' => $sessionId
        );
        $params += $this->defaultLogin();
        $simplexml = $this->_getData('MoveAllItemsFromNoteToBasket', $params);
        if (!$simplexml) return false;
        
        $data0 = array();
        
if(!isset($data0)){$data0 = array();}
	$data0_obj = @$simplexml;
	$data0 = @$data0_obj;
	return $data0;
    }
    public function GetBasket($sessionId)
    {
        $params = $this->defaultLogin();

        if (!$params) return false;
        
        $params += array(
            'sessionId' => $sessionId,
        );

        $simplexml = $this->_getData('GetBasket', $params);
        //print_r($simplexml);
        if (!$simplexml) return false; 

        $data = $simplexml->CollectionInfo->Elements->children();
		
        $userNote = array();
        $i = 0;

        foreach($data as $item)
        {
            $userNote[$i]['ItemId'] = (string)$item->ItemId;
            $userNote[$i]['Id'] = (string)$item->Id;
            $userNote[$i]['ItemTitle'] = (string)$item->ItemTitle;
            $userNote[$i]['ConfigurationId'] = (string)$item->ConfigurationId;
            $userNote[$i]['Price'] = (string)$item->Price;
            $userNote[$i]['CurrencySign'] = (string)$item->CurrencySign;
            $userNote[$i]['Quantity'] = (string)$item->Quantity;
            $userNote[$i]['Cost'] = (string)$item->TotalCost;
            foreach ($item->Fields->FieldInfo as $field){
                $userNote[$i][(string)$field['Name']] = (string)$field['Value'];
            }
            //$userNote[$i]['ExternalURL'] = (string)$item->ExternalURL;
            //$userNote[$i]['PictureURL'] = (string)$item->PictureURL;
            $i++;	
        }
        return $userNote;
    } 
public function AddItemToBasket($sessionId, $itemId, $quantity, $itemtitle, $confid, $promoid, $catId, $catName,
$price, $currencyName, $externalURL, $pictureURL, $vendorId, $confitem, $confitemchina, $comment='', $weight=0)
{
$params = $this->defaultLogin();

if (!$params) return false;

$xmlParams = new SimpleXMLElement('<Fields></Fields>');
$el = $xmlParams->addChild('FieldInfo');
$el->addAttribute('Name', 'ItemTitle');
$el->addAttribute('Value', $itemtitle);

$el = $xmlParams->addChild('FieldInfo');
$el->addAttribute('Name', 'VendorId');
$el->addAttribute('Value', $vendorId);

$el = $xmlParams->addChild('FieldInfo');
$el->addAttribute('Name', 'ItemConfigurationCNY');
$el->addAttribute('Value', $confitemchina);

$el = $xmlParams->addChild('FieldInfo');
$el->addAttribute('Name', 'ItemConfiguration');
$el->addAttribute('Value', $confitem);

$el = $xmlParams->addChild('FieldInfo');
$el->addAttribute('Name', 'ConfigurationId');
$el->addAttribute('Value', $confid);

$el = $xmlParams->addChild('FieldInfo');
$el->addAttribute('Name', 'PromoId');
$el->addAttribute('Value', $promoid);

$el = $xmlParams->addChild('FieldInfo');
$el->addAttribute('Name', 'CategoryId');
$el->addAttribute('Value', $catId);

$el = $xmlParams->addChild('FieldInfo');
$el->addAttribute('Name', 'CategoryName');
$el->addAttribute('Value', $catName);

$el = $xmlParams->addChild('FieldInfo');
$el->addAttribute('Name', 'ExternalURL');
$el->addAttribute('Value', htmlspecialchars($externalURL));

$el = $xmlParams->addChild('FieldInfo');
$el->addAttribute('Name', 'PictureURL');
$el->addAttribute('Value', htmlspecialchars($pictureURL));
$fields = str_replace('<?xml version="1.0"?>','',$xmlParams->asXML());

$el = $xmlParams->addChild('FieldInfo');
$el->addAttribute('Name', 'Comment');
$el->addAttribute('Value', htmlspecialchars($comment));
$fields = str_replace('<?xml version="1.0"?>','',$xmlParams->asXML());

$el = $xmlParams->addChild('FieldInfo');
$el->addAttribute('Name', 'Weight');
$el->addAttribute('Value', htmlspecialchars($weight));
$fields = str_replace('<?xml version="1.0"?>','',$xmlParams->asXML());

$params += array(
'sessionId' => $sessionId,
'itemId'	=> $itemId,
'quantity'  => $quantity,
'configurationId' => $confid,
'price' => $price,
'currencyName'=> $currencyName,
'fieldParameters'=> $fields,
);

$simplexml = $this->_getData('AddItemToBasket', $params);
if (!$simplexml) return false;

return (int)$simplexml->Result;
}
    public function RemoveItemFromBasket($sessionId, $elementId){
        $params = array(
            'sessionId' => $sessionId,
	    'elementId' => $elementId
        );
        $params += $this->defaultLogin();
        $simplexml = $this->_getData('RemoveItemFromBasket', $params);
        if (!$simplexml) return false;
        
        $data0 = array();
        
if(!isset($data0)){$data0 = array();}
	$data0_obj = @$simplexml;
	$data0 = @$data0_obj;
	return $data0;
    }
    public function EditBasketItemQuantity($sessionId, $elementId, $quantity){
        $params = array(
            'sessionId' => $sessionId,
	    'elementId' => $elementId,
	    'quantity' => $quantity
        );
        $params += $this->defaultLogin();
        $simplexml = $this->_getData('EditBasketItemQuantity', $params);
        if (!$simplexml) return false;
        
        $data0 = array();
        
if(!isset($data0)){$data0 = array();}
	$data0_obj = @$simplexml;
	$data0 = @$data0_obj;
	return $data0;
    }
    public function EditBasketItemFields($sessionId, $elementId, $fieldParameters){
        $params = array(
            'sessionId' => $sessionId,
	    'elementId' => $elementId,
	    'fieldParameters' => $fieldParameters
        );
        $params += $this->defaultLogin();
        $simplexml = $this->_getData('EditBasketItemFields', $params);
        if (!$simplexml) return false;
        
        $data0 = array();
        
if(!isset($data0)){$data0 = array();}
	$data0_obj = @$simplexml;
	$data0 = @$data0_obj;
	return $data0;
    }
    public function ClearBasket($sessionId){
        $params = array(
            'sessionId' => $sessionId
        );
        $params += $this->defaultLogin();
        $simplexml = $this->_getData('ClearBasket', $params);
        if (!$simplexml) return false;
        
        $data0 = array();
        
if(!isset($data0)){$data0 = array();}
	$data0_obj = @$simplexml;
	$data0 = @$data0_obj;
	return $data0;
    }
    public function MoveItemFromCartToNote($sessionId, $elementId){
        $params = array(
            'sessionId' => $sessionId,
	    'elementId' => $elementId
        );
        $params += $this->defaultLogin();
        $simplexml = $this->_getData('MoveItemFromCartToNote', $params);
        if (!$simplexml) return false;
        
        $data0 = array();
        
if(!isset($data0)){$data0 = array();}
	$data0_obj = @$simplexml;
	$data0 = @$data0_obj;
	return $data0;
    }
    public function MoveAllItemsFromCartToNote($sessionId){
        $params = array(
            'sessionId' => $sessionId
        );
        $params += $this->defaultLogin();
        $simplexml = $this->_getData('MoveAllItemsFromCartToNote', $params);
        if (!$simplexml) return false;
        
        $data0 = array();
        
if(!isset($data0)){$data0 = array();}
	$data0_obj = @$simplexml;
	$data0 = @$data0_obj;
	return $data0;
    }
    public function GetFavoriteVendors($sessionId){
        $params = array(
            'sessionId' => $sessionId
        );
        $params += $this->defaultLogin();
        $simplexml = $this->_getData('GetFavoriteVendors', $params);
        if (!$simplexml) return false;
        
        $data0 = array();
        
if(!isset($data0)){$data0 = array();}
	$data0_obj = @$simplexml->CollectionInfo;
if(!isset($data0['Elements'])){$data0['Elements'] = array();}

	if(!isset($simplexml->CollectionInfo->Elements) || is_null($simplexml->CollectionInfo->Elements) || !$simplexml->CollectionInfo->Elements)		$data1_obj = @array();

	else
		$data1_obj = @$simplexml->CollectionInfo->Elements->children();
		$data0['Elements'] = @array();
		foreach($data1_obj as $value1){
			$data1_tmp = @array();
			$data1_tmp['Id'] = @(int)$value1->Id;
			$data1_tmp['id'] = @(int)$value1->Id;
			$data1_tmp['ItemId'] = @(string)$value1->ItemId;
			$data1_tmp['itemid'] = @(string)$value1->ItemId;
			$data1_tmp['ConfigurationId'] = @(string)$value1->ConfigurationId;
			$data1_tmp['configurationid'] = @(string)$value1->ConfigurationId;
			$data1_tmp['Price'] = @$value1->Price;
			$data1_tmp['price'] = @$value1->Price;
			$data1_tmp['Quantity'] = @(int)$value1->Quantity;
			$data1_tmp['quantity'] = @(int)$value1->Quantity;
			$data1_tmp['TotalCost'] = @$value1->TotalCost;
			$data1_tmp['totalcost'] = @$value1->TotalCost;
if(!isset($data1_tmp['FullTotalCost'])){$data1_tmp['FullTotalCost'] = array();}
			$data2_obj = @$value1->FullTotalCost;
if(!isset($data1_tmp['FullTotalCost']['OriginalPrice'])){$data1_tmp['FullTotalCost']['OriginalPrice'] = array();}
				$data3_obj = @$value1->FullTotalCost->OriginalPrice;
				$data1_tmp['FullTotalCost']['OriginalPrice'] = @$data3_obj;
			$data1_tmp['FullTotalCost']['originalprice'] = @$data1_tmp['FullTotalCost']['OriginalPrice'];
if(!isset($data1_tmp['FullTotalCost']['MarginPrice'])){$data1_tmp['FullTotalCost']['MarginPrice'] = array();}
				$data3_obj = @$value1->FullTotalCost->MarginPrice;
				$data1_tmp['FullTotalCost']['MarginPrice'] = @$data3_obj;
			$data1_tmp['FullTotalCost']['marginprice'] = @$data1_tmp['FullTotalCost']['MarginPrice'];
if(!isset($data1_tmp['FullTotalCost']['OriginalCurrencyCode'])){$data1_tmp['FullTotalCost']['OriginalCurrencyCode'] = array();}
				$data3_obj = @$value1->FullTotalCost->OriginalCurrencyCode;
				$data1_tmp['FullTotalCost']['OriginalCurrencyCode'] = @(string)$data3_obj;
			$data1_tmp['FullTotalCost']['originalcurrencycode'] = @$data1_tmp['FullTotalCost']['OriginalCurrencyCode'];
if(!isset($data1_tmp['FullTotalCost']['ConvertedPriceList'])){$data1_tmp['FullTotalCost']['ConvertedPriceList'] = array();}
				$data3_obj = @$value1->FullTotalCost->ConvertedPriceList;
if(!isset($data1_tmp['FullTotalCost']['ConvertedPriceList']['Internal'])){$data1_tmp['FullTotalCost']['ConvertedPriceList']['Internal'] = array();}
					$data4_obj = @$value1->FullTotalCost->ConvertedPriceList->Internal;
					$data1_tmp['FullTotalCost']['ConvertedPriceList']['Internal'] = @$data4_obj;
				$data1_tmp['FullTotalCost']['ConvertedPriceList']['internal'] = @$data1_tmp['FullTotalCost']['ConvertedPriceList']['Internal'];
if(!isset($data1_tmp['FullTotalCost']['ConvertedPriceList']['DisplayedMoneys'])){$data1_tmp['FullTotalCost']['ConvertedPriceList']['DisplayedMoneys'] = array();}

	if(!isset($value1->FullTotalCost->ConvertedPriceList->DisplayedMoneys) || is_null($value1->FullTotalCost->ConvertedPriceList->DisplayedMoneys) || !$value1->FullTotalCost->ConvertedPriceList->DisplayedMoneys)					$data4_obj = @array();

	else
					$data4_obj = @$value1->FullTotalCost->ConvertedPriceList->DisplayedMoneys->children();
					$data1_tmp['FullTotalCost']['ConvertedPriceList']['DisplayedMoneys'] = @array();
					foreach($data4_obj as $value4){
						$data1_tmp['FullTotalCost']['ConvertedPriceList']['DisplayedMoneys'][] = @$value4;
					}
				$data1_tmp['FullTotalCost']['ConvertedPriceList']['displayedmoneys'] = @$data1_tmp['FullTotalCost']['ConvertedPriceList']['DisplayedMoneys'];
			$data1_tmp['FullTotalCost']['convertedpricelist'] = @$data1_tmp['FullTotalCost']['ConvertedPriceList'];
if(!isset($data1_tmp['FullPrice'])){$data1_tmp['FullPrice'] = array();}
			$data2_obj = @$value1->FullPrice;
if(!isset($data1_tmp['FullPrice']['OriginalPrice'])){$data1_tmp['FullPrice']['OriginalPrice'] = array();}
				$data3_obj = @$value1->FullPrice->OriginalPrice;
				$data1_tmp['FullPrice']['OriginalPrice'] = @$data3_obj;
			$data1_tmp['FullPrice']['originalprice'] = @$data1_tmp['FullPrice']['OriginalPrice'];
if(!isset($data1_tmp['FullPrice']['MarginPrice'])){$data1_tmp['FullPrice']['MarginPrice'] = array();}
				$data3_obj = @$value1->FullPrice->MarginPrice;
				$data1_tmp['FullPrice']['MarginPrice'] = @$data3_obj;
			$data1_tmp['FullPrice']['marginprice'] = @$data1_tmp['FullPrice']['MarginPrice'];
if(!isset($data1_tmp['FullPrice']['OriginalCurrencyCode'])){$data1_tmp['FullPrice']['OriginalCurrencyCode'] = array();}
				$data3_obj = @$value1->FullPrice->OriginalCurrencyCode;
				$data1_tmp['FullPrice']['OriginalCurrencyCode'] = @(string)$data3_obj;
			$data1_tmp['FullPrice']['originalcurrencycode'] = @$data1_tmp['FullPrice']['OriginalCurrencyCode'];
if(!isset($data1_tmp['FullPrice']['ConvertedPriceList'])){$data1_tmp['FullPrice']['ConvertedPriceList'] = array();}
				$data3_obj = @$value1->FullPrice->ConvertedPriceList;
if(!isset($data1_tmp['FullPrice']['ConvertedPriceList']['Internal'])){$data1_tmp['FullPrice']['ConvertedPriceList']['Internal'] = array();}
					$data4_obj = @$value1->FullPrice->ConvertedPriceList->Internal;
					$data1_tmp['FullPrice']['ConvertedPriceList']['Internal'] = @$data4_obj;
				$data1_tmp['FullPrice']['ConvertedPriceList']['internal'] = @$data1_tmp['FullPrice']['ConvertedPriceList']['Internal'];
if(!isset($data1_tmp['FullPrice']['ConvertedPriceList']['DisplayedMoneys'])){$data1_tmp['FullPrice']['ConvertedPriceList']['DisplayedMoneys'] = array();}

	if(!isset($value1->FullPrice->ConvertedPriceList->DisplayedMoneys) || is_null($value1->FullPrice->ConvertedPriceList->DisplayedMoneys) || !$value1->FullPrice->ConvertedPriceList->DisplayedMoneys)					$data4_obj = @array();

	else
					$data4_obj = @$value1->FullPrice->ConvertedPriceList->DisplayedMoneys->children();
					$data1_tmp['FullPrice']['ConvertedPriceList']['DisplayedMoneys'] = @array();
					foreach($data4_obj as $value4){
						$data1_tmp['FullPrice']['ConvertedPriceList']['DisplayedMoneys'][] = @$value4;
					}
				$data1_tmp['FullPrice']['ConvertedPriceList']['displayedmoneys'] = @$data1_tmp['FullPrice']['ConvertedPriceList']['DisplayedMoneys'];
			$data1_tmp['FullPrice']['convertedpricelist'] = @$data1_tmp['FullPrice']['ConvertedPriceList'];
if(!isset($data1_tmp['Fields'])){$data1_tmp['Fields'] = array();}

	if(!isset($value1->Fields) || is_null($value1->Fields) || !$value1->Fields)			$data2_obj = @array();

	else
			$data2_obj = @$value1->Fields->children();
			$data1_tmp['Fields'] = @array();
			foreach($data2_obj as $value2){
				$data2_tmp = @array();
				$data2_tmp['Name'] = @$value2['Name'];
				$data2_tmp['Value'] = @$value2['Value'];
				$data1_tmp['Fields'][] = @$data2_tmp;
			}
			$data1_tmp['CurrencySign'] = @(string)$value1->CurrencySign;
			$data1_tmp['currencysign'] = @(string)$value1->CurrencySign;
			$data1_tmp['CurrencyCode'] = @(string)$value1->CurrencyCode;
			$data1_tmp['currencycode'] = @(string)$value1->CurrencyCode;
			$data1_tmp['CategoryId'] = @(string)$value1->CategoryId;
			$data1_tmp['categoryid'] = @(string)$value1->CategoryId;
			$data1_tmp['VendorId'] = @(string)$value1->VendorId;
			$data1_tmp['vendorid'] = @(string)$value1->VendorId;
			$data1_tmp['CategoryName'] = @(string)$value1->CategoryName;
			$data1_tmp['categoryname'] = @(string)$value1->CategoryName;
			$data0['Elements'][] = @$data1_tmp;
		}
	$data0['elements'] = @$data0['Elements'];
if(!isset($data0['TotalCost'])){$data0['TotalCost'] = array();}
		$data1_obj = @$simplexml->CollectionInfo->TotalCost;
if(!isset($data0['TotalCost']['OriginalPrice'])){$data0['TotalCost']['OriginalPrice'] = array();}
			$data2_obj = @$simplexml->CollectionInfo->TotalCost->OriginalPrice;
			$data0['TotalCost']['OriginalPrice'] = @$data2_obj;
		$data0['TotalCost']['originalprice'] = @$data0['TotalCost']['OriginalPrice'];
if(!isset($data0['TotalCost']['MarginPrice'])){$data0['TotalCost']['MarginPrice'] = array();}
			$data2_obj = @$simplexml->CollectionInfo->TotalCost->MarginPrice;
			$data0['TotalCost']['MarginPrice'] = @$data2_obj;
		$data0['TotalCost']['marginprice'] = @$data0['TotalCost']['MarginPrice'];
if(!isset($data0['TotalCost']['OriginalCurrencyCode'])){$data0['TotalCost']['OriginalCurrencyCode'] = array();}
			$data2_obj = @$simplexml->CollectionInfo->TotalCost->OriginalCurrencyCode;
			$data0['TotalCost']['OriginalCurrencyCode'] = @(string)$data2_obj;
		$data0['TotalCost']['originalcurrencycode'] = @$data0['TotalCost']['OriginalCurrencyCode'];
if(!isset($data0['TotalCost']['ConvertedPriceList'])){$data0['TotalCost']['ConvertedPriceList'] = array();}
			$data2_obj = @$simplexml->CollectionInfo->TotalCost->ConvertedPriceList;
if(!isset($data0['TotalCost']['ConvertedPriceList']['Internal'])){$data0['TotalCost']['ConvertedPriceList']['Internal'] = array();}
				$data3_obj = @$simplexml->CollectionInfo->TotalCost->ConvertedPriceList->Internal;
				$data0['TotalCost']['ConvertedPriceList']['Internal'] = @$data3_obj;
			$data0['TotalCost']['ConvertedPriceList']['internal'] = @$data0['TotalCost']['ConvertedPriceList']['Internal'];
if(!isset($data0['TotalCost']['ConvertedPriceList']['DisplayedMoneys'])){$data0['TotalCost']['ConvertedPriceList']['DisplayedMoneys'] = array();}

	if(!isset($simplexml->CollectionInfo->TotalCost->ConvertedPriceList->DisplayedMoneys) || is_null($simplexml->CollectionInfo->TotalCost->ConvertedPriceList->DisplayedMoneys) || !$simplexml->CollectionInfo->TotalCost->ConvertedPriceList->DisplayedMoneys)				$data3_obj = @array();

	else
				$data3_obj = @$simplexml->CollectionInfo->TotalCost->ConvertedPriceList->DisplayedMoneys->children();
				$data0['TotalCost']['ConvertedPriceList']['DisplayedMoneys'] = @array();
				foreach($data3_obj as $value3){
					$data0['TotalCost']['ConvertedPriceList']['DisplayedMoneys'][] = @$value3;
				}
			$data0['TotalCost']['ConvertedPriceList']['displayedmoneys'] = @$data0['TotalCost']['ConvertedPriceList']['DisplayedMoneys'];
		$data0['TotalCost']['convertedpricelist'] = @$data0['TotalCost']['ConvertedPriceList'];
	$data0['totalcost'] = @$data0['TotalCost'];
if(!isset($data0['AdditionalPriceInfoList'])){$data0['AdditionalPriceInfoList'] = array();}

	if(!isset($simplexml->CollectionInfo->AdditionalPriceInfoList->Elements) || is_null($simplexml->CollectionInfo->AdditionalPriceInfoList->Elements) || !$simplexml->CollectionInfo->AdditionalPriceInfoList->Elements)		$data1_obj = @array();

	else
		$data1_obj = @$simplexml->CollectionInfo->AdditionalPriceInfoList->Elements->children();
		$data0['AdditionalPriceInfoList'] = @array();
		foreach($data1_obj as $value1){
			$data1_tmp = @array();
			$data1_tmp['Type'] = @$value1->Type;
			$data1_tmp['type'] = @$value1->Type;
			$data1_tmp['Name'] = @(string)$value1->Name;
			$data1_tmp['name'] = @(string)$value1->Name;
if(!isset($data1_tmp['Price'])){$data1_tmp['Price'] = array();}
			$data2_obj = @$value1->Price;
if(!isset($data1_tmp['Price']['OriginalPrice'])){$data1_tmp['Price']['OriginalPrice'] = array();}
				$data3_obj = @$value1->Price->OriginalPrice;
				$data1_tmp['Price']['OriginalPrice'] = @$data3_obj;
			$data1_tmp['Price']['originalprice'] = @$data1_tmp['Price']['OriginalPrice'];
if(!isset($data1_tmp['Price']['MarginPrice'])){$data1_tmp['Price']['MarginPrice'] = array();}
				$data3_obj = @$value1->Price->MarginPrice;
				$data1_tmp['Price']['MarginPrice'] = @$data3_obj;
			$data1_tmp['Price']['marginprice'] = @$data1_tmp['Price']['MarginPrice'];
if(!isset($data1_tmp['Price']['OriginalCurrencyCode'])){$data1_tmp['Price']['OriginalCurrencyCode'] = array();}
				$data3_obj = @$value1->Price->OriginalCurrencyCode;
				$data1_tmp['Price']['OriginalCurrencyCode'] = @(string)$data3_obj;
			$data1_tmp['Price']['originalcurrencycode'] = @$data1_tmp['Price']['OriginalCurrencyCode'];
if(!isset($data1_tmp['Price']['ConvertedPriceList'])){$data1_tmp['Price']['ConvertedPriceList'] = array();}
				$data3_obj = @$value1->Price->ConvertedPriceList;
if(!isset($data1_tmp['Price']['ConvertedPriceList']['Internal'])){$data1_tmp['Price']['ConvertedPriceList']['Internal'] = array();}
					$data4_obj = @$value1->Price->ConvertedPriceList->Internal;
					$data1_tmp['Price']['ConvertedPriceList']['Internal'] = @$data4_obj;
				$data1_tmp['Price']['ConvertedPriceList']['internal'] = @$data1_tmp['Price']['ConvertedPriceList']['Internal'];
if(!isset($data1_tmp['Price']['ConvertedPriceList']['DisplayedMoneys'])){$data1_tmp['Price']['ConvertedPriceList']['DisplayedMoneys'] = array();}

	if(!isset($value1->Price->ConvertedPriceList->DisplayedMoneys) || is_null($value1->Price->ConvertedPriceList->DisplayedMoneys) || !$value1->Price->ConvertedPriceList->DisplayedMoneys)					$data4_obj = @array();

	else
					$data4_obj = @$value1->Price->ConvertedPriceList->DisplayedMoneys->children();
					$data1_tmp['Price']['ConvertedPriceList']['DisplayedMoneys'] = @array();
					foreach($data4_obj as $value4){
						$data1_tmp['Price']['ConvertedPriceList']['DisplayedMoneys'][] = @$value4;
					}
				$data1_tmp['Price']['ConvertedPriceList']['displayedmoneys'] = @$data1_tmp['Price']['ConvertedPriceList']['DisplayedMoneys'];
			$data1_tmp['Price']['convertedpricelist'] = @$data1_tmp['Price']['ConvertedPriceList'];
			$data0['AdditionalPriceInfoList'][] = @$data1_tmp;
		}
	$data0['additionalpriceinfolist'] = @$data0['AdditionalPriceInfoList'];
	return $data0;
    }
    public function AddVendorToFavorites($sessionId, $vendorId, $fieldParameters){
        $params = array(
            'sessionId' => $sessionId,
	    'vendorId' => $vendorId,
	    'fieldParameters' => $fieldParameters
        );
        $params += $this->defaultLogin();
        $simplexml = $this->_getData('AddVendorToFavorites', $params);
        if (!$simplexml) return false;
        
        $data0 = array();
        
if(!isset($data0)){$data0 = array();}
	$data0_obj = @$simplexml->Result;
	$data0 = @$data0_obj;
	return $data0;
    }
    public function RemoveVendorFromFavorites($sessionId, $elementId){
        $params = array(
            'sessionId' => $sessionId,
	    'elementId' => $elementId
        );
        $params += $this->defaultLogin();
        $simplexml = $this->_getData('RemoveVendorFromFavorites', $params);
        if (!$simplexml) return false;
        
        $data0 = array();
        
if(!isset($data0)){$data0 = array();}
	$data0_obj = @$simplexml;
	$data0 = @$data0_obj;
	return $data0;
    }
    public function EditFavoriteVendorFields($sessionId, $elementId, $fieldParameters){
        $params = array(
            'sessionId' => $sessionId,
	    'elementId' => $elementId,
	    'fieldParameters' => $fieldParameters
        );
        $params += $this->defaultLogin();
        $simplexml = $this->_getData('EditFavoriteVendorFields', $params);
        if (!$simplexml) return false;
        
        $data0 = array();
        
if(!isset($data0)){$data0 = array();}
	$data0_obj = @$simplexml;
	$data0 = @$data0_obj;
	return $data0;
    }
    public function ClearFavoriteVendors($sessionId){
        $params = array(
            'sessionId' => $sessionId
        );
        $params += $this->defaultLogin();
        $simplexml = $this->_getData('ClearFavoriteVendors', $params);
        if (!$simplexml) return false;
        
        $data0 = array();
        
if(!isset($data0)){$data0 = array();}
	$data0_obj = @$simplexml;
	$data0 = @$data0_obj;
	return $data0;
    }
    public function SearchItemsFrame($xmlParameters, $framePosition = 0, $frameSize = 18){
        $params = array(
            'xmlParameters' => $xmlParameters,
	    'framePosition' => $framePosition,
	    'frameSize' => $frameSize
        );
        $params += $this->defaultLogin();
        $simplexml = $this->_getData('SearchItemsFrame', $params);
        if (!$simplexml) return false;
        
        $data0 = array();
        
if(!isset($data0)){$data0 = array();}
	$data0_obj = @$simplexml->Result;
if(!isset($data0['Categories'])){$data0['Categories'] = array();}

	if(!isset($simplexml->Result->Categories->Content) || is_null($simplexml->Result->Categories->Content) || !$simplexml->Result->Categories->Content)		$data1_obj = @array();

	else
		$data1_obj = @$simplexml->Result->Categories->Content->children();
		$data0['Categories'] = @array();
		foreach($data1_obj as $value1){
			$data1_tmp = @array();
			$data1_tmp['Id'] = @(string)$value1->Id;
			$data1_tmp['id'] = @(string)$value1->Id;
			$data1_tmp['ExternalId'] = @(string)$value1->ExternalId;
			$data1_tmp['externalid'] = @(string)$value1->ExternalId;
			$data1_tmp['Name'] = @(string)$value1->Name;
			$data1_tmp['name'] = @(string)$value1->Name;
			$data1_tmp['ItemCount'] = @$value1->ItemCount;
			$data1_tmp['itemcount'] = @$value1->ItemCount;
			$data0['Categories'][] = @$data1_tmp;
		}
	$data0['categories'] = @$data0['Categories'];

        $tmp_obj_2 = $simplexml->Result->Items->Content->children();
        $data0['Items'] = array('data' => array());
        foreach ($tmp_obj_2 as $value)
        {
            $data0['Items']['data'][] = $this->_parseItemInfo($value);
        }
        $data0['Items']['totalcount'] = (string)$simplexml->Result->Items->TotalCount;	return $data0;
    }
    public function SearchPromoteItemsFrame($xmlParameters, $framePosition = 0, $frameSize = 18){
        $params = array(
            'xmlParameters' => $xmlParameters,
	    'framePosition' => $framePosition,
	    'frameSize' => $frameSize
        );
        $params += $this->defaultLogin();
        $simplexml = $this->_getData('SearchPromoteItemsFrame', $params);
        if (!$simplexml) return false;
        
        $data0 = array();
        
if(!isset($data0)){$data0 = array();}
	$data0_obj = @$simplexml->Result;
if(!isset($data0['Content'])){$data0['Content'] = array();}

	if(!isset($simplexml->Result->Content) || is_null($simplexml->Result->Content) || !$simplexml->Result->Content)		$data1_obj = @array();

	else
		$data1_obj = @$simplexml->Result->Content->children();
	$data0['Content'] = $this->_parseItemInfo($data0_obj->Content);
		$data0['content'] = @$data0['Content'];
if(!isset($data0['TotalCount'])){$data0['TotalCount'] = array();}
		$data1_obj = @$simplexml->Result->TotalCount;
		$data0['TotalCount'] = @$data1_obj;
	$data0['totalcount'] = @$data0['TotalCount'];
	return $data0;
    }
    public function GetPromoteItems($promotedId, $itemIds){
        $params = array(
            'promotedId' => $promotedId,
	    'itemIds' => $itemIds
        );
        $params += $this->defaultLogin();
        $simplexml = $this->_getData('GetPromoteItems', $params);
        if (!$simplexml) return false;
        
        $data0 = array();
        
if(!isset($data0)){$data0 = array();}

	if(!isset($simplexml->Result->Content) || is_null($simplexml->Result->Content) || !$simplexml->Result->Content)	$data0_obj = @array();

	else
	$data0_obj = @$simplexml->Result->Content->children();
	$data0 = $this->_parseItemInfo($data0_obj);
	return $data0;
    }
    public function GetCategoryItemInfoListFrame($categoryId, $framePosition = 0, $frameSize = 18){
        $params = array(
            'categoryId' => $categoryId,
	    'framePosition' => $framePosition,
	    'frameSize' => $frameSize
        );
        $params += $this->defaultLogin();
        $simplexml = $this->_getData('GetCategoryItemInfoListFrame', $params);
        if (!$simplexml) return false;
        
        $data0 = array();
        
if(!isset($data0)){$data0 = array();}
	$data0_obj = @$simplexml->OtapiItemInfoSubList;

        $tmp_obj_3 = $data0_obj->Content->children();
        $data0 = array('data' => array());
        foreach ($tmp_obj_3 as $value)
        {
            $data0['data'][] = $this->_parseItemInfo($value);
        }
        $data0['totalcount'] = (string)$data0_obj->TotalCount;	return $data0;
    }
    public function GetCategoryItemSimpleInfoListFrame($categoryId, $framePosition = 0, $frameSize = 18){
        $params = array(
            'categoryId' => $categoryId,
	    'framePosition' => $framePosition,
	    'frameSize' => $frameSize
        );
        $params += $this->defaultLogin();
        $simplexml = $this->_getData('GetCategoryItemSimpleInfoListFrame', $params);
        if (!$simplexml) return false;
        
        $data0 = array();
        
if(!isset($data0)){$data0 = array();}
	$data0_obj = @$simplexml->OtapiItemInfoSubList;

        $tmp_obj_4 = $data0_obj->Content->children();
        $data0 = array('data' => array());
        foreach ($tmp_obj_4 as $value)
        {
            $data0['data'][] = $this->_parseItemInfo($value);
        }
        $data0['totalcount'] = (string)$data0_obj->TotalCount;	return $data0;
    }
    public function FindItemInfoListFrameByTitle($searchParameters, $itemTitle, $framePosition = 0, $frameSize = 18, $languageOfQuery){
        $params = array(
            'searchParameters' => $searchParameters,
	    'itemTitle' => $itemTitle,
	    'framePosition' => $framePosition,
	    'frameSize' => $frameSize,
	    'languageOfQuery' => $languageOfQuery
        );
        $params += $this->defaultLogin();
        $simplexml = $this->_getData('FindItemInfoListFrameByTitle', $params);
        if (!$simplexml) return false;
        
        $data0 = array();
        
if(!isset($data0)){$data0 = array();}
	$data0_obj = @$simplexml->OtapiItemInfoSubList;

        $tmp_obj_5 = $data0_obj->Content->children();
        $data0 = array('data' => array());
        foreach ($tmp_obj_5 as $value)
        {
            $data0['data'][] = $this->_parseItemInfo($value);
        }
        $data0['totalcount'] = (string)$data0_obj->TotalCount;	return $data0;
    }
    public function FindItemSimpleInfoListFrameByTitle($itemTitle, $framePosition = 0, $frameSize = 18, $languageOfQuery, $searchParameters){
        $params = array(
            'itemTitle' => $itemTitle,
	    'framePosition' => $framePosition,
	    'frameSize' => $frameSize,
	    'languageOfQuery' => $languageOfQuery,
	    'searchParameters' => $searchParameters
        );
        $params += $this->defaultLogin();
        $simplexml = $this->_getData('FindItemSimpleInfoListFrameByTitle', $params);
        if (!$simplexml) return false;
        
        $data0 = array();
        
if(!isset($data0)){$data0 = array();}
	$data0_obj = @$simplexml->OtapiItemInfoSubList;

        $tmp_obj_6 = $data0_obj->Content->children();
        $data0 = array('data' => array());
        foreach ($tmp_obj_6 as $value)
        {
            $data0['data'][] = $this->_parseItemInfo($value);
        }
        $data0['totalcount'] = (string)$data0_obj->TotalCount;	return $data0;
    }
    public function FindCategoryItemInfoListFrame($categoryId, $categoryItemFilter = '', $framePosition = 0, $frameSize = 18){
        $params = array(
            'categoryId' => $categoryId,
	    'categoryItemFilter' => $categoryItemFilter,
	    'framePosition' => $framePosition,
	    'frameSize' => $frameSize
        );
        $params += $this->defaultLogin();
        $simplexml = $this->_getData('FindCategoryItemInfoListFrame', $params);
        if (!$simplexml) return false;
        
        $data0 = array();
        
if(!isset($data0)){$data0 = array();}
	$data0_obj = @$simplexml->OtapiItemInfoSubList;

        $tmp_obj_7 = $data0_obj->Content->children();
        $data0 = array('data' => array());
        foreach ($tmp_obj_7 as $value)
        {
            $data0['data'][] = $this->_parseItemInfo($value);
        }
        $data0['totalcount'] = (string)$data0_obj->TotalCount;	return $data0;
    }
    public function FindCategoryItemSimpleInfoListFrame($categoryId, $framePosition = 0, $frameSize = 18, $categoryItemFilter = ''){
        $params = array(
            'categoryId' => $categoryId,
	    'framePosition' => $framePosition,
	    'frameSize' => $frameSize,
	    'categoryItemFilter' => $categoryItemFilter
        );
        $params += $this->defaultLogin();
        $simplexml = $this->_getData('FindCategoryItemSimpleInfoListFrame', $params);
        if (!$simplexml) return false;
        
        $data0 = array();
        
if(!isset($data0)){$data0 = array();}
	$data0_obj = @$simplexml->OtapiItemInfoSubList;

        $tmp_obj_8 = $data0_obj->Content->children();
        $data0 = array('data' => array());
        foreach ($tmp_obj_8 as $value)
        {
            $data0['data'][] = $this->_parseItemInfo($value);
        }
        $data0['totalcount'] = (string)$data0_obj->TotalCount;	return $data0;
    }
    public function GetVendorItemInfoSortedListFrame($vendorId, $framePosition = 0, $frameSize = 18, $sortingParameters){
        $params = array(
            'vendorId' => $vendorId,
	    'framePosition' => $framePosition,
	    'frameSize' => $frameSize,
	    'sortingParameters' => $sortingParameters
        );
        $params += $this->defaultLogin();
        $simplexml = $this->_getData('GetVendorItemInfoSortedListFrame', $params);
        if (!$simplexml) return false;
        
        $data0 = array();
        
if(!isset($data0)){$data0 = array();}
	$data0_obj = @$simplexml->OtapiItemInfoSubList;

        $tmp_obj_9 = $data0_obj->Content->children();
        $data0 = array('data' => array());
        foreach ($tmp_obj_9 as $value)
        {
            $data0['data'][] = $this->_parseItemInfo($value);
        }
        $data0['totalcount'] = (string)$data0_obj->TotalCount;	return $data0;
    }
    public function GetVendorItemSimpleInfoSortedListFrame($vendorId, $framePosition = 0, $frameSize = 18, $sortingParameters){
        $params = array(
            'vendorId' => $vendorId,
	    'framePosition' => $framePosition,
	    'frameSize' => $frameSize,
	    'sortingParameters' => $sortingParameters
        );
        $params += $this->defaultLogin();
        $simplexml = $this->_getData('GetVendorItemSimpleInfoSortedListFrame', $params);
        if (!$simplexml) return false;
        
        $data0 = array();
        
if(!isset($data0)){$data0 = array();}
	$data0_obj = @$simplexml->OtapiItemInfoSubList;

        $tmp_obj_10 = $data0_obj->Content->children();
        $data0 = array('data' => array());
        foreach ($tmp_obj_10 as $value)
        {
            $data0['data'][] = $this->_parseItemInfo($value);
        }
        $data0['totalcount'] = (string)$data0_obj->TotalCount;	return $data0;
    }
    public function GetItemMarketPriceList($categoryId, $xmlVariablesPriceSettings, $currencyName){
        $params = array(
            'categoryId' => $categoryId,
	    'xmlVariablesPriceSettings' => $xmlVariablesPriceSettings,
	    'currencyName' => $currencyName
        );
        $params += $this->defaultLogin();
        $simplexml = $this->_getData('GetItemMarketPriceList', $params);
        if (!$simplexml) return false;
        
        $data0 = array();
        
if(!isset($data0)){$data0 = array();}

	if(!isset($simplexml->Result->Content) || is_null($simplexml->Result->Content) || !$simplexml->Result->Content)	$data0_obj = @array();

	else
	$data0_obj = @$simplexml->Result->Content->children();
	$data0 = @array();
	foreach($data0_obj as $value0){
		$data0_tmp = @array();
		$data0_tmp['Id'] = @(string)$value0->Id;
		$data0_tmp['id'] = @(string)$value0->Id;
if(!isset($data0_tmp['Price'])){$data0_tmp['Price'] = array();}
		$data1_obj = @$value0->Price;
if(!isset($data0_tmp['Price']['OriginalPrice'])){$data0_tmp['Price']['OriginalPrice'] = array();}
			$data2_obj = @$value0->Price->OriginalPrice;
			$data0_tmp['Price']['OriginalPrice'] = @$data2_obj;
		$data0_tmp['Price']['originalprice'] = @$data0_tmp['Price']['OriginalPrice'];
if(!isset($data0_tmp['Price']['MarginPrice'])){$data0_tmp['Price']['MarginPrice'] = array();}
			$data2_obj = @$value0->Price->MarginPrice;
			$data0_tmp['Price']['MarginPrice'] = @$data2_obj;
		$data0_tmp['Price']['marginprice'] = @$data0_tmp['Price']['MarginPrice'];
if(!isset($data0_tmp['Price']['OriginalCurrencyCode'])){$data0_tmp['Price']['OriginalCurrencyCode'] = array();}
			$data2_obj = @$value0->Price->OriginalCurrencyCode;
			$data0_tmp['Price']['OriginalCurrencyCode'] = @(string)$data2_obj;
		$data0_tmp['Price']['originalcurrencycode'] = @$data0_tmp['Price']['OriginalCurrencyCode'];
if(!isset($data0_tmp['Price']['ConvertedPriceList'])){$data0_tmp['Price']['ConvertedPriceList'] = array();}
			$data2_obj = @$value0->Price->ConvertedPriceList;
if(!isset($data0_tmp['Price']['ConvertedPriceList']['Internal'])){$data0_tmp['Price']['ConvertedPriceList']['Internal'] = array();}
				$data3_obj = @$value0->Price->ConvertedPriceList->Internal;
				$data0_tmp['Price']['ConvertedPriceList']['Internal'] = @$data3_obj;
			$data0_tmp['Price']['ConvertedPriceList']['internal'] = @$data0_tmp['Price']['ConvertedPriceList']['Internal'];
if(!isset($data0_tmp['Price']['ConvertedPriceList']['DisplayedMoneys'])){$data0_tmp['Price']['ConvertedPriceList']['DisplayedMoneys'] = array();}

	if(!isset($value0->Price->ConvertedPriceList->DisplayedMoneys) || is_null($value0->Price->ConvertedPriceList->DisplayedMoneys) || !$value0->Price->ConvertedPriceList->DisplayedMoneys)				$data3_obj = @array();

	else
				$data3_obj = @$value0->Price->ConvertedPriceList->DisplayedMoneys->children();
				$data0_tmp['Price']['ConvertedPriceList']['DisplayedMoneys'] = @array();
				foreach($data3_obj as $value3){
					$data0_tmp['Price']['ConvertedPriceList']['DisplayedMoneys'][] = @$value3;
				}
			$data0_tmp['Price']['ConvertedPriceList']['displayedmoneys'] = @$data0_tmp['Price']['ConvertedPriceList']['DisplayedMoneys'];
		$data0_tmp['Price']['convertedpricelist'] = @$data0_tmp['Price']['ConvertedPriceList'];
if(!isset($data0_tmp['Price']['ConvertedPrice'])){$data0_tmp['Price']['ConvertedPrice'] = array();}
			$data2_obj = @$value0->Price->ConvertedPrice;
			$data0_tmp['Price']['ConvertedPrice'] = @(string)$data2_obj;
		$data0_tmp['Price']['convertedprice'] = @$data0_tmp['Price']['ConvertedPrice'];
if(!isset($data0_tmp['Price']['ConvertedPriceWithoutSign'])){$data0_tmp['Price']['ConvertedPriceWithoutSign'] = array();}
			$data2_obj = @$value0->Price->ConvertedPriceWithoutSign;
			$data0_tmp['Price']['ConvertedPriceWithoutSign'] = @(string)$data2_obj;
		$data0_tmp['Price']['convertedpricewithoutsign'] = @$data0_tmp['Price']['ConvertedPriceWithoutSign'];
if(!isset($data0_tmp['Price']['CurrencySign'])){$data0_tmp['Price']['CurrencySign'] = array();}
			$data2_obj = @$value0->Price->CurrencySign;
			$data0_tmp['Price']['CurrencySign'] = @(string)$data2_obj;
		$data0_tmp['Price']['currencysign'] = @$data0_tmp['Price']['CurrencySign'];
if(!isset($data0_tmp['Price']['CurrencyName'])){$data0_tmp['Price']['CurrencyName'] = array();}
			$data2_obj = @$value0->Price->CurrencyName;
			$data0_tmp['Price']['CurrencyName'] = @(string)$data2_obj;
		$data0_tmp['Price']['currencyname'] = @$data0_tmp['Price']['CurrencyName'];
if(!isset($data0_tmp['Price']['IsDeliverable'])){$data0_tmp['Price']['IsDeliverable'] = array();}
			$data2_obj = @$value0->Price->IsDeliverable;
			$data0_tmp['Price']['IsDeliverable'] = @$data2_obj;
		$data0_tmp['Price']['isdeliverable'] = @$data0_tmp['Price']['IsDeliverable'];
if(!isset($data0_tmp['Price']['DeliveryPrice'])){$data0_tmp['Price']['DeliveryPrice'] = array();}
			$data2_obj = @$value0->Price->DeliveryPrice;
if(!isset($data0_tmp['Price']['DeliveryPrice']['OriginalPrice'])){$data0_tmp['Price']['DeliveryPrice']['OriginalPrice'] = array();}
				$data3_obj = @$value0->Price->DeliveryPrice->OriginalPrice;
				$data0_tmp['Price']['DeliveryPrice']['OriginalPrice'] = @$data3_obj;
			$data0_tmp['Price']['DeliveryPrice']['originalprice'] = @$data0_tmp['Price']['DeliveryPrice']['OriginalPrice'];
if(!isset($data0_tmp['Price']['DeliveryPrice']['MarginPrice'])){$data0_tmp['Price']['DeliveryPrice']['MarginPrice'] = array();}
				$data3_obj = @$value0->Price->DeliveryPrice->MarginPrice;
				$data0_tmp['Price']['DeliveryPrice']['MarginPrice'] = @$data3_obj;
			$data0_tmp['Price']['DeliveryPrice']['marginprice'] = @$data0_tmp['Price']['DeliveryPrice']['MarginPrice'];
if(!isset($data0_tmp['Price']['DeliveryPrice']['OriginalCurrencyCode'])){$data0_tmp['Price']['DeliveryPrice']['OriginalCurrencyCode'] = array();}
				$data3_obj = @$value0->Price->DeliveryPrice->OriginalCurrencyCode;
				$data0_tmp['Price']['DeliveryPrice']['OriginalCurrencyCode'] = @(string)$data3_obj;
			$data0_tmp['Price']['DeliveryPrice']['originalcurrencycode'] = @$data0_tmp['Price']['DeliveryPrice']['OriginalCurrencyCode'];
if(!isset($data0_tmp['Price']['DeliveryPrice']['ConvertedPriceList'])){$data0_tmp['Price']['DeliveryPrice']['ConvertedPriceList'] = array();}
				$data3_obj = @$value0->Price->DeliveryPrice->ConvertedPriceList;
if(!isset($data0_tmp['Price']['DeliveryPrice']['ConvertedPriceList']['Internal'])){$data0_tmp['Price']['DeliveryPrice']['ConvertedPriceList']['Internal'] = array();}
					$data4_obj = @$value0->Price->DeliveryPrice->ConvertedPriceList->Internal;
					$data0_tmp['Price']['DeliveryPrice']['ConvertedPriceList']['Internal'] = @$data4_obj;
				$data0_tmp['Price']['DeliveryPrice']['ConvertedPriceList']['internal'] = @$data0_tmp['Price']['DeliveryPrice']['ConvertedPriceList']['Internal'];
if(!isset($data0_tmp['Price']['DeliveryPrice']['ConvertedPriceList']['DisplayedMoneys'])){$data0_tmp['Price']['DeliveryPrice']['ConvertedPriceList']['DisplayedMoneys'] = array();}

	if(!isset($value0->Price->DeliveryPrice->ConvertedPriceList->DisplayedMoneys) || is_null($value0->Price->DeliveryPrice->ConvertedPriceList->DisplayedMoneys) || !$value0->Price->DeliveryPrice->ConvertedPriceList->DisplayedMoneys)					$data4_obj = @array();

	else
					$data4_obj = @$value0->Price->DeliveryPrice->ConvertedPriceList->DisplayedMoneys->children();
					$data0_tmp['Price']['DeliveryPrice']['ConvertedPriceList']['DisplayedMoneys'] = @array();
					foreach($data4_obj as $value4){
						$data0_tmp['Price']['DeliveryPrice']['ConvertedPriceList']['DisplayedMoneys'][] = @$value4;
					}
				$data0_tmp['Price']['DeliveryPrice']['ConvertedPriceList']['displayedmoneys'] = @$data0_tmp['Price']['DeliveryPrice']['ConvertedPriceList']['DisplayedMoneys'];
			$data0_tmp['Price']['DeliveryPrice']['convertedpricelist'] = @$data0_tmp['Price']['DeliveryPrice']['ConvertedPriceList'];
		$data0_tmp['Price']['deliveryprice'] = @$data0_tmp['Price']['DeliveryPrice'];
if(!isset($data0_tmp['Price']['OneItemDeliveryPrice'])){$data0_tmp['Price']['OneItemDeliveryPrice'] = array();}
			$data2_obj = @$value0->Price->OneItemDeliveryPrice;
if(!isset($data0_tmp['Price']['OneItemDeliveryPrice']['OriginalPrice'])){$data0_tmp['Price']['OneItemDeliveryPrice']['OriginalPrice'] = array();}
				$data3_obj = @$value0->Price->OneItemDeliveryPrice->OriginalPrice;
				$data0_tmp['Price']['OneItemDeliveryPrice']['OriginalPrice'] = @$data3_obj;
			$data0_tmp['Price']['OneItemDeliveryPrice']['originalprice'] = @$data0_tmp['Price']['OneItemDeliveryPrice']['OriginalPrice'];
if(!isset($data0_tmp['Price']['OneItemDeliveryPrice']['MarginPrice'])){$data0_tmp['Price']['OneItemDeliveryPrice']['MarginPrice'] = array();}
				$data3_obj = @$value0->Price->OneItemDeliveryPrice->MarginPrice;
				$data0_tmp['Price']['OneItemDeliveryPrice']['MarginPrice'] = @$data3_obj;
			$data0_tmp['Price']['OneItemDeliveryPrice']['marginprice'] = @$data0_tmp['Price']['OneItemDeliveryPrice']['MarginPrice'];
if(!isset($data0_tmp['Price']['OneItemDeliveryPrice']['OriginalCurrencyCode'])){$data0_tmp['Price']['OneItemDeliveryPrice']['OriginalCurrencyCode'] = array();}
				$data3_obj = @$value0->Price->OneItemDeliveryPrice->OriginalCurrencyCode;
				$data0_tmp['Price']['OneItemDeliveryPrice']['OriginalCurrencyCode'] = @(string)$data3_obj;
			$data0_tmp['Price']['OneItemDeliveryPrice']['originalcurrencycode'] = @$data0_tmp['Price']['OneItemDeliveryPrice']['OriginalCurrencyCode'];
if(!isset($data0_tmp['Price']['OneItemDeliveryPrice']['ConvertedPriceList'])){$data0_tmp['Price']['OneItemDeliveryPrice']['ConvertedPriceList'] = array();}
				$data3_obj = @$value0->Price->OneItemDeliveryPrice->ConvertedPriceList;
if(!isset($data0_tmp['Price']['OneItemDeliveryPrice']['ConvertedPriceList']['Internal'])){$data0_tmp['Price']['OneItemDeliveryPrice']['ConvertedPriceList']['Internal'] = array();}
					$data4_obj = @$value0->Price->OneItemDeliveryPrice->ConvertedPriceList->Internal;
					$data0_tmp['Price']['OneItemDeliveryPrice']['ConvertedPriceList']['Internal'] = @$data4_obj;
				$data0_tmp['Price']['OneItemDeliveryPrice']['ConvertedPriceList']['internal'] = @$data0_tmp['Price']['OneItemDeliveryPrice']['ConvertedPriceList']['Internal'];
if(!isset($data0_tmp['Price']['OneItemDeliveryPrice']['ConvertedPriceList']['DisplayedMoneys'])){$data0_tmp['Price']['OneItemDeliveryPrice']['ConvertedPriceList']['DisplayedMoneys'] = array();}

	if(!isset($value0->Price->OneItemDeliveryPrice->ConvertedPriceList->DisplayedMoneys) || is_null($value0->Price->OneItemDeliveryPrice->ConvertedPriceList->DisplayedMoneys) || !$value0->Price->OneItemDeliveryPrice->ConvertedPriceList->DisplayedMoneys)					$data4_obj = @array();

	else
					$data4_obj = @$value0->Price->OneItemDeliveryPrice->ConvertedPriceList->DisplayedMoneys->children();
					$data0_tmp['Price']['OneItemDeliveryPrice']['ConvertedPriceList']['DisplayedMoneys'] = @array();
					foreach($data4_obj as $value4){
						$data0_tmp['Price']['OneItemDeliveryPrice']['ConvertedPriceList']['DisplayedMoneys'][] = @$value4;
					}
				$data0_tmp['Price']['OneItemDeliveryPrice']['ConvertedPriceList']['displayedmoneys'] = @$data0_tmp['Price']['OneItemDeliveryPrice']['ConvertedPriceList']['DisplayedMoneys'];
			$data0_tmp['Price']['OneItemDeliveryPrice']['convertedpricelist'] = @$data0_tmp['Price']['OneItemDeliveryPrice']['ConvertedPriceList'];
		$data0_tmp['Price']['oneitemdeliveryprice'] = @$data0_tmp['Price']['OneItemDeliveryPrice'];
if(!isset($data0_tmp['Price']['PriceWithoutDelivery'])){$data0_tmp['Price']['PriceWithoutDelivery'] = array();}
			$data2_obj = @$value0->Price->PriceWithoutDelivery;
if(!isset($data0_tmp['Price']['PriceWithoutDelivery']['OriginalPrice'])){$data0_tmp['Price']['PriceWithoutDelivery']['OriginalPrice'] = array();}
				$data3_obj = @$value0->Price->PriceWithoutDelivery->OriginalPrice;
				$data0_tmp['Price']['PriceWithoutDelivery']['OriginalPrice'] = @$data3_obj;
			$data0_tmp['Price']['PriceWithoutDelivery']['originalprice'] = @$data0_tmp['Price']['PriceWithoutDelivery']['OriginalPrice'];
if(!isset($data0_tmp['Price']['PriceWithoutDelivery']['MarginPrice'])){$data0_tmp['Price']['PriceWithoutDelivery']['MarginPrice'] = array();}
				$data3_obj = @$value0->Price->PriceWithoutDelivery->MarginPrice;
				$data0_tmp['Price']['PriceWithoutDelivery']['MarginPrice'] = @$data3_obj;
			$data0_tmp['Price']['PriceWithoutDelivery']['marginprice'] = @$data0_tmp['Price']['PriceWithoutDelivery']['MarginPrice'];
if(!isset($data0_tmp['Price']['PriceWithoutDelivery']['OriginalCurrencyCode'])){$data0_tmp['Price']['PriceWithoutDelivery']['OriginalCurrencyCode'] = array();}
				$data3_obj = @$value0->Price->PriceWithoutDelivery->OriginalCurrencyCode;
				$data0_tmp['Price']['PriceWithoutDelivery']['OriginalCurrencyCode'] = @(string)$data3_obj;
			$data0_tmp['Price']['PriceWithoutDelivery']['originalcurrencycode'] = @$data0_tmp['Price']['PriceWithoutDelivery']['OriginalCurrencyCode'];
if(!isset($data0_tmp['Price']['PriceWithoutDelivery']['ConvertedPriceList'])){$data0_tmp['Price']['PriceWithoutDelivery']['ConvertedPriceList'] = array();}
				$data3_obj = @$value0->Price->PriceWithoutDelivery->ConvertedPriceList;
if(!isset($data0_tmp['Price']['PriceWithoutDelivery']['ConvertedPriceList']['Internal'])){$data0_tmp['Price']['PriceWithoutDelivery']['ConvertedPriceList']['Internal'] = array();}
					$data4_obj = @$value0->Price->PriceWithoutDelivery->ConvertedPriceList->Internal;
					$data0_tmp['Price']['PriceWithoutDelivery']['ConvertedPriceList']['Internal'] = @$data4_obj;
				$data0_tmp['Price']['PriceWithoutDelivery']['ConvertedPriceList']['internal'] = @$data0_tmp['Price']['PriceWithoutDelivery']['ConvertedPriceList']['Internal'];
if(!isset($data0_tmp['Price']['PriceWithoutDelivery']['ConvertedPriceList']['DisplayedMoneys'])){$data0_tmp['Price']['PriceWithoutDelivery']['ConvertedPriceList']['DisplayedMoneys'] = array();}

	if(!isset($value0->Price->PriceWithoutDelivery->ConvertedPriceList->DisplayedMoneys) || is_null($value0->Price->PriceWithoutDelivery->ConvertedPriceList->DisplayedMoneys) || !$value0->Price->PriceWithoutDelivery->ConvertedPriceList->DisplayedMoneys)					$data4_obj = @array();

	else
					$data4_obj = @$value0->Price->PriceWithoutDelivery->ConvertedPriceList->DisplayedMoneys->children();
					$data0_tmp['Price']['PriceWithoutDelivery']['ConvertedPriceList']['DisplayedMoneys'] = @array();
					foreach($data4_obj as $value4){
						$data0_tmp['Price']['PriceWithoutDelivery']['ConvertedPriceList']['DisplayedMoneys'][] = @$value4;
					}
				$data0_tmp['Price']['PriceWithoutDelivery']['ConvertedPriceList']['displayedmoneys'] = @$data0_tmp['Price']['PriceWithoutDelivery']['ConvertedPriceList']['DisplayedMoneys'];
			$data0_tmp['Price']['PriceWithoutDelivery']['convertedpricelist'] = @$data0_tmp['Price']['PriceWithoutDelivery']['ConvertedPriceList'];
		$data0_tmp['Price']['pricewithoutdelivery'] = @$data0_tmp['Price']['PriceWithoutDelivery'];
		$data0[] = @$data0_tmp;
	}
	return $data0;
    }
    public function GetMarketsMerchPriceConfigXML($sessionId){
        $params = array(
            'sessionId' => $sessionId
        );
        $params += $this->defaultLogin();
        $simplexml = $this->_getData('GetMarketsMerchPriceConfigXML', $params);
        if (!$simplexml) return false;
        
        $data0 = array();
        
if(!isset($data0)){$data0 = array();}

	if(!isset($simplexml->Result->Content) || is_null($simplexml->Result->Content) || !$simplexml->Result->Content)	$data0_obj = @array();

	else
	$data0_obj = @$simplexml->Result->Content->children();
	$data0 = @array();
	foreach($data0_obj as $value0){
		$data0_tmp = @array();
if(!isset($data0_tmp['PriceFormationGroupInfoList'])){$data0_tmp['PriceFormationGroupInfoList'] = array();}

	if(!isset($value0->PriceFormationGroupInfoList) || is_null($value0->PriceFormationGroupInfoList) || !$value0->PriceFormationGroupInfoList)		$data1_obj = @array();

	else
		$data1_obj = @$value0->PriceFormationGroupInfoList->children();
		$data0_tmp['PriceFormationGroupInfoList'] = @array();
		foreach($data1_obj as $value1){
			$data1_tmp = @array();
			$data1_tmp['Name'] = @$value1['Name'];
			$data1_tmp['Description'] = @$value1['Description'];
			$data1_tmp['IsDefault'] = @$value1['IsDefault'];
			$data1_tmp['StrategyType'] = @$value1['StrategyType'];
			$data1_tmp['Id'] = @$value1->Id;
			$data1_tmp['id'] = @$value1->Id;
if(!isset($data1_tmp['Settings'])){$data1_tmp['Settings'] = array();}
			$data2_obj = @$value1->Settings;
if(!isset($data1_tmp['Settings']['MarginPercent'])){$data1_tmp['Settings']['MarginPercent'] = array();}
				$data3_obj = @$value1->Settings->MarginPercent;
				$data1_tmp['Settings']['MarginPercent'] = @$data3_obj;
			$data1_tmp['Settings']['marginpercent'] = @$data1_tmp['Settings']['MarginPercent'];
if(!isset($data1_tmp['Settings']['MinimumLimit'])){$data1_tmp['Settings']['MinimumLimit'] = array();}
				$data3_obj = @$value1->Settings->MinimumLimit;
				$data1_tmp['Settings']['MinimumLimit'] = @$data3_obj;
			$data1_tmp['Settings']['minimumlimit'] = @$data1_tmp['Settings']['MinimumLimit'];
if(!isset($data1_tmp['Settings']['MaximumLimit'])){$data1_tmp['Settings']['MaximumLimit'] = array();}
				$data3_obj = @$value1->Settings->MaximumLimit;
				$data1_tmp['Settings']['MaximumLimit'] = @$data3_obj;
			$data1_tmp['Settings']['maximumlimit'] = @$data1_tmp['Settings']['MaximumLimit'];
if(!isset($data1_tmp['Settings']['MinimumMargin'])){$data1_tmp['Settings']['MinimumMargin'] = array();}
				$data3_obj = @$value1->Settings->MinimumMargin;
				$data1_tmp['Settings']['MinimumMargin'] = @$data3_obj;
			$data1_tmp['Settings']['minimummargin'] = @$data1_tmp['Settings']['MinimumMargin'];
if(!isset($data1_tmp['Settings']['MaximumMargin'])){$data1_tmp['Settings']['MaximumMargin'] = array();}
				$data3_obj = @$value1->Settings->MaximumMargin;
				$data1_tmp['Settings']['MaximumMargin'] = @$data3_obj;
			$data1_tmp['Settings']['maximummargin'] = @$data1_tmp['Settings']['MaximumMargin'];
if(!isset($data1_tmp['Settings']['InternalDeliveryPrice'])){$data1_tmp['Settings']['InternalDeliveryPrice'] = array();}
				$data3_obj = @$value1->Settings->InternalDeliveryPrice;
				$data1_tmp['Settings']['InternalDeliveryPrice'] = @$data3_obj;
			$data1_tmp['Settings']['internaldeliveryprice'] = @$data1_tmp['Settings']['InternalDeliveryPrice'];
if(!isset($data1_tmp['Settings']['PriceFormationIntervals'])){$data1_tmp['Settings']['PriceFormationIntervals'] = array();}

	if(!isset($value1->Settings->PriceFormationIntervals) || is_null($value1->Settings->PriceFormationIntervals) || !$value1->Settings->PriceFormationIntervals)				$data3_obj = @array();

	else
				$data3_obj = @$value1->Settings->PriceFormationIntervals->children();
				$data1_tmp['Settings']['PriceFormationIntervals'] = @array();
				foreach($data3_obj as $value3){
					$data3_tmp = @array();
					$data3_tmp['Id'] = @$value3['Id'];
					$data3_tmp['MarginPercent'] = @$value3->MarginPercent;
					$data3_tmp['marginpercent'] = @$value3->MarginPercent;
					$data3_tmp['MarginFixed'] = @$value3->MarginFixed;
					$data3_tmp['marginfixed'] = @$value3->MarginFixed;
					$data3_tmp['MinimumLimit'] = @$value3->MinimumLimit;
					$data3_tmp['minimumlimit'] = @$value3->MinimumLimit;
					$data3_tmp['InternalDeliveryPrice'] = @$value3->InternalDeliveryPrice;
					$data3_tmp['internaldeliveryprice'] = @$value3->InternalDeliveryPrice;
					$data1_tmp['Settings']['PriceFormationIntervals'][] = @$data3_tmp;
				}
			$data1_tmp['Settings']['priceformationintervals'] = @$data1_tmp['Settings']['PriceFormationIntervals'];
if(!isset($data1_tmp['Settings']['PriceRoundingFactor'])){$data1_tmp['Settings']['PriceRoundingFactor'] = array();}
				$data3_obj = @$value1->Settings->PriceRoundingFactor;
				$data1_tmp['Settings']['PriceRoundingFactor'] = @$data3_obj;
			$data1_tmp['Settings']['priceroundingfactor'] = @$data1_tmp['Settings']['PriceRoundingFactor'];
			$data0_tmp['PriceFormationGroupInfoList'][] = @$data1_tmp;
		}
if(!isset($data0_tmp['ShowcaseSettings'])){$data0_tmp['ShowcaseSettings'] = array();}
		$data1_obj = @$value0->ShowcaseSettings;
if(!isset($data0_tmp['ShowcaseSettings']['Ruble'])){$data0_tmp['ShowcaseSettings']['Ruble'] = array();}
			$data2_obj = @$value0->ShowcaseSettings->Ruble;
if(!isset($data0_tmp['ShowcaseSettings']['Ruble']['Name'])){$data0_tmp['ShowcaseSettings']['Ruble']['Name'] = array();}
				$data3_obj = @$value0->ShowcaseSettings->Ruble->Name;
				$data0_tmp['ShowcaseSettings']['Ruble']['Name'] = @(string)$data3_obj;
			$data0_tmp['ShowcaseSettings']['Ruble']['name'] = @$data0_tmp['ShowcaseSettings']['Ruble']['Name'];
if(!isset($data0_tmp['ShowcaseSettings']['Ruble']['IsUse'])){$data0_tmp['ShowcaseSettings']['Ruble']['IsUse'] = array();}
				$data3_obj = @$value0->ShowcaseSettings->Ruble->IsUse;
				$data0_tmp['ShowcaseSettings']['Ruble']['IsUse'] = @$data3_obj;
			$data0_tmp['ShowcaseSettings']['Ruble']['isuse'] = @$data0_tmp['ShowcaseSettings']['Ruble']['IsUse'];
if(!isset($data0_tmp['ShowcaseSettings']['Ruble']['Rate'])){$data0_tmp['ShowcaseSettings']['Ruble']['Rate'] = array();}
				$data3_obj = @$value0->ShowcaseSettings->Ruble->Rate;
				$data0_tmp['ShowcaseSettings']['Ruble']['Rate'] = @$data3_obj;
			$data0_tmp['ShowcaseSettings']['Ruble']['rate'] = @$data0_tmp['ShowcaseSettings']['Ruble']['Rate'];
		$data0_tmp['ShowcaseSettings']['ruble'] = @$data0_tmp['ShowcaseSettings']['Ruble'];
if(!isset($data0_tmp['ShowcaseSettings']['Dollar'])){$data0_tmp['ShowcaseSettings']['Dollar'] = array();}
			$data2_obj = @$value0->ShowcaseSettings->Dollar;
if(!isset($data0_tmp['ShowcaseSettings']['Dollar']['Name'])){$data0_tmp['ShowcaseSettings']['Dollar']['Name'] = array();}
				$data3_obj = @$value0->ShowcaseSettings->Dollar->Name;
				$data0_tmp['ShowcaseSettings']['Dollar']['Name'] = @(string)$data3_obj;
			$data0_tmp['ShowcaseSettings']['Dollar']['name'] = @$data0_tmp['ShowcaseSettings']['Dollar']['Name'];
if(!isset($data0_tmp['ShowcaseSettings']['Dollar']['IsUse'])){$data0_tmp['ShowcaseSettings']['Dollar']['IsUse'] = array();}
				$data3_obj = @$value0->ShowcaseSettings->Dollar->IsUse;
				$data0_tmp['ShowcaseSettings']['Dollar']['IsUse'] = @$data3_obj;
			$data0_tmp['ShowcaseSettings']['Dollar']['isuse'] = @$data0_tmp['ShowcaseSettings']['Dollar']['IsUse'];
if(!isset($data0_tmp['ShowcaseSettings']['Dollar']['Rate'])){$data0_tmp['ShowcaseSettings']['Dollar']['Rate'] = array();}
				$data3_obj = @$value0->ShowcaseSettings->Dollar->Rate;
				$data0_tmp['ShowcaseSettings']['Dollar']['Rate'] = @$data3_obj;
			$data0_tmp['ShowcaseSettings']['Dollar']['rate'] = @$data0_tmp['ShowcaseSettings']['Dollar']['Rate'];
		$data0_tmp['ShowcaseSettings']['dollar'] = @$data0_tmp['ShowcaseSettings']['Dollar'];
if(!isset($data0_tmp['ShowcaseSettings']['Yuan'])){$data0_tmp['ShowcaseSettings']['Yuan'] = array();}
			$data2_obj = @$value0->ShowcaseSettings->Yuan;
if(!isset($data0_tmp['ShowcaseSettings']['Yuan']['Name'])){$data0_tmp['ShowcaseSettings']['Yuan']['Name'] = array();}
				$data3_obj = @$value0->ShowcaseSettings->Yuan->Name;
				$data0_tmp['ShowcaseSettings']['Yuan']['Name'] = @(string)$data3_obj;
			$data0_tmp['ShowcaseSettings']['Yuan']['name'] = @$data0_tmp['ShowcaseSettings']['Yuan']['Name'];
if(!isset($data0_tmp['ShowcaseSettings']['Yuan']['IsUse'])){$data0_tmp['ShowcaseSettings']['Yuan']['IsUse'] = array();}
				$data3_obj = @$value0->ShowcaseSettings->Yuan->IsUse;
				$data0_tmp['ShowcaseSettings']['Yuan']['IsUse'] = @$data3_obj;
			$data0_tmp['ShowcaseSettings']['Yuan']['isuse'] = @$data0_tmp['ShowcaseSettings']['Yuan']['IsUse'];
if(!isset($data0_tmp['ShowcaseSettings']['Yuan']['Rate'])){$data0_tmp['ShowcaseSettings']['Yuan']['Rate'] = array();}
				$data3_obj = @$value0->ShowcaseSettings->Yuan->Rate;
				$data0_tmp['ShowcaseSettings']['Yuan']['Rate'] = @$data3_obj;
			$data0_tmp['ShowcaseSettings']['Yuan']['rate'] = @$data0_tmp['ShowcaseSettings']['Yuan']['Rate'];
		$data0_tmp['ShowcaseSettings']['yuan'] = @$data0_tmp['ShowcaseSettings']['Yuan'];
if(!isset($data0_tmp['ShowcaseSettings']['MarginPercentage'])){$data0_tmp['ShowcaseSettings']['MarginPercentage'] = array();}
			$data2_obj = @$value0->ShowcaseSettings->MarginPercentage;
			$data0_tmp['ShowcaseSettings']['MarginPercentage'] = @$data2_obj;
		$data0_tmp['ShowcaseSettings']['marginpercentage'] = @$data0_tmp['ShowcaseSettings']['MarginPercentage'];
if(!isset($data0_tmp['ShowcaseSettings']['MinimumMargin'])){$data0_tmp['ShowcaseSettings']['MinimumMargin'] = array();}
			$data2_obj = @$value0->ShowcaseSettings->MinimumMargin;
			$data0_tmp['ShowcaseSettings']['MinimumMargin'] = @$data2_obj;
		$data0_tmp['ShowcaseSettings']['minimummargin'] = @$data0_tmp['ShowcaseSettings']['MinimumMargin'];
if(!isset($data0_tmp['ShowcaseSettings']['IsSinchroCB'])){$data0_tmp['ShowcaseSettings']['IsSinchroCB'] = array();}
			$data2_obj = @$value0->ShowcaseSettings->IsSinchroCB;
			$data0_tmp['ShowcaseSettings']['IsSinchroCB'] = @$data2_obj;
		$data0_tmp['ShowcaseSettings']['issinchrocb'] = @$data0_tmp['ShowcaseSettings']['IsSinchroCB'];
if(!isset($data0_tmp['ShowcaseSettings']['DeliveryTypes'])){$data0_tmp['ShowcaseSettings']['DeliveryTypes'] = array();}

	if(!isset($value0->ShowcaseSettings->DeliveryTypes) || is_null($value0->ShowcaseSettings->DeliveryTypes) || !$value0->ShowcaseSettings->DeliveryTypes)			$data2_obj = @array();

	else
			$data2_obj = @$value0->ShowcaseSettings->DeliveryTypes->children();
			$data0_tmp['ShowcaseSettings']['DeliveryTypes'] = @array();
			foreach($data2_obj as $value2){
				$data0_tmp['ShowcaseSettings']['DeliveryTypes'][] = @$value2;
			}
		$data0_tmp['ShowcaseSettings']['deliverytypes'] = @$data0_tmp['ShowcaseSettings']['DeliveryTypes'];
if(!isset($data0_tmp['ShowcaseSettings']['AvailableDeliveryTypes'])){$data0_tmp['ShowcaseSettings']['AvailableDeliveryTypes'] = array();}

	if(!isset($value0->ShowcaseSettings->AvailableDeliveryTypes) || is_null($value0->ShowcaseSettings->AvailableDeliveryTypes) || !$value0->ShowcaseSettings->AvailableDeliveryTypes)			$data2_obj = @array();

	else
			$data2_obj = @$value0->ShowcaseSettings->AvailableDeliveryTypes->children();
			$data0_tmp['ShowcaseSettings']['AvailableDeliveryTypes'] = @array();
			foreach($data2_obj as $value2){
				$data2_tmp = @array();
				$data2_tmp['Name'] = @(string)$value2->Name;
				$data2_tmp['name'] = @(string)$value2->Name;
				$data2_tmp['Description'] = @(string)$value2->Description;
				$data2_tmp['description'] = @(string)$value2->Description;
				$data0_tmp['ShowcaseSettings']['AvailableDeliveryTypes'][] = @$data2_tmp;
			}
		$data0_tmp['ShowcaseSettings']['availabledeliverytypes'] = @$data0_tmp['ShowcaseSettings']['AvailableDeliveryTypes'];
if(!isset($data0_tmp['ShowcaseSettings']['ExternalDeliveryRegionId'])){$data0_tmp['ShowcaseSettings']['ExternalDeliveryRegionId'] = array();}
			$data2_obj = @$value0->ShowcaseSettings->ExternalDeliveryRegionId;
			$data0_tmp['ShowcaseSettings']['ExternalDeliveryRegionId'] = @(string)$data2_obj;
		$data0_tmp['ShowcaseSettings']['externaldeliveryregionid'] = @$data0_tmp['ShowcaseSettings']['ExternalDeliveryRegionId'];
if(!isset($data0_tmp['ShowcaseSettings']['ExternalDeliveryRegionName'])){$data0_tmp['ShowcaseSettings']['ExternalDeliveryRegionName'] = array();}
			$data2_obj = @$value0->ShowcaseSettings->ExternalDeliveryRegionName;
			$data0_tmp['ShowcaseSettings']['ExternalDeliveryRegionName'] = @(string)$data2_obj;
		$data0_tmp['ShowcaseSettings']['externaldeliveryregionname'] = @$data0_tmp['ShowcaseSettings']['ExternalDeliveryRegionName'];
if(!isset($data0_tmp['ShowcaseSettings']['IsAuctionTypeItemSellAllowed'])){$data0_tmp['ShowcaseSettings']['IsAuctionTypeItemSellAllowed'] = array();}
			$data2_obj = @$value0->ShowcaseSettings->IsAuctionTypeItemSellAllowed;
			$data0_tmp['ShowcaseSettings']['IsAuctionTypeItemSellAllowed'] = @$data2_obj;
		$data0_tmp['ShowcaseSettings']['isauctiontypeitemsellallowed'] = @$data0_tmp['ShowcaseSettings']['IsAuctionTypeItemSellAllowed'];
if(!isset($data0_tmp['ShowcaseSettings']['IsNotDeliverableItemSellAllowed'])){$data0_tmp['ShowcaseSettings']['IsNotDeliverableItemSellAllowed'] = array();}
			$data2_obj = @$value0->ShowcaseSettings->IsNotDeliverableItemSellAllowed;
			$data0_tmp['ShowcaseSettings']['IsNotDeliverableItemSellAllowed'] = @$data2_obj;
		$data0_tmp['ShowcaseSettings']['isnotdeliverableitemsellallowed'] = @$data0_tmp['ShowcaseSettings']['IsNotDeliverableItemSellAllowed'];
if(!isset($data0_tmp['ShowcaseSettings']['IsSecondhandItemSellAllowed'])){$data0_tmp['ShowcaseSettings']['IsSecondhandItemSellAllowed'] = array();}
			$data2_obj = @$value0->ShowcaseSettings->IsSecondhandItemSellAllowed;
			$data0_tmp['ShowcaseSettings']['IsSecondhandItemSellAllowed'] = @$data2_obj;
		$data0_tmp['ShowcaseSettings']['issecondhanditemsellallowed'] = @$data0_tmp['ShowcaseSettings']['IsSecondhandItemSellAllowed'];
if(!isset($data0_tmp['ShowcaseSettings']['UseDiscount'])){$data0_tmp['ShowcaseSettings']['UseDiscount'] = array();}
			$data2_obj = @$value0->ShowcaseSettings->UseDiscount;
			$data0_tmp['ShowcaseSettings']['UseDiscount'] = @$data2_obj;
		$data0_tmp['ShowcaseSettings']['usediscount'] = @$data0_tmp['ShowcaseSettings']['UseDiscount'];
if(!isset($data0_tmp['ShowcaseSettings']['DateTimeFormat'])){$data0_tmp['ShowcaseSettings']['DateTimeFormat'] = array();}
			$data2_obj = @$value0->ShowcaseSettings->DateTimeFormat;
			$data0_tmp['ShowcaseSettings']['DateTimeFormat'] = @(string)$data2_obj;
		$data0_tmp['ShowcaseSettings']['datetimeformat'] = @$data0_tmp['ShowcaseSettings']['DateTimeFormat'];
		$data0[] = @$data0_tmp;
	}
	return $data0;
    }
    public function SetMarketsMerchPriceConfigXML($sessionId, $xmlMarketMerchPriceConfigList){
        $params = array(
            'sessionId' => $sessionId,
	    'xmlMarketMerchPriceConfigList' => $xmlMarketMerchPriceConfigList
        );
        $params += $this->defaultLogin();
        $simplexml = $this->_getData('SetMarketsMerchPriceConfigXML', $params);
        if (!$simplexml) return false;
        
        $data0 = array();
        
if(!isset($data0)){$data0 = array();}
	$data0_obj = @$simplexml;
	$data0 = @$data0_obj;
	return $data0;
    }
    public function GetMarketMerchInfoList(){
        $params = array(
            
        );
        $params += $this->defaultLogin();
        $simplexml = $this->_getData('GetMarketMerchInfoList', $params);
        if (!$simplexml) return false;
        
        $data0 = array();
        
if(!isset($data0)){$data0 = array();}

	if(!isset($simplexml->Result->Content) || is_null($simplexml->Result->Content) || !$simplexml->Result->Content)	$data0_obj = @array();

	else
	$data0_obj = @$simplexml->Result->Content->children();
	$data0 = @array();
	foreach($data0_obj as $value0){
		$data0_tmp = @array();
		$data0_tmp['Id'] = @(string)$value0->Id;
		$data0_tmp['id'] = @(string)$value0->Id;
		$data0_tmp['Name'] = @(string)$value0->Name;
		$data0_tmp['name'] = @(string)$value0->Name;
		$data0_tmp['UseDicount'] = @$value0->UseDicount;
		$data0_tmp['usedicount'] = @$value0->UseDicount;
		$data0[] = @$data0_tmp;
	}
	return $data0;
    }
    public function AboutOrderLogic(){
        $params = array(
            
        );
        $params += $this->defaultLogin();
        $simplexml = $this->_getData('AboutOrderLogic', $params);
        if (!$simplexml) return false;
        
        $data0 = array();
        
if(!isset($data0)){$data0 = array();}
	$data0_obj = @$simplexml->Result;
	$data0 = @(string)$data0_obj;
	return $data0;
    }
    public function GetSalesOrdersList($sessionId, $filter){
        $params = array(
            'sessionId' => $sessionId,
	    'filter' => $filter
        );
        $params += $this->defaultLogin();
        $simplexml = $this->_getData('GetSalesOrdersList', $params);
        if (!$simplexml) return false;
        
        $data0 = array();
        
if(!isset($data0)){$data0 = array();}

	if(!isset($simplexml->Result) || is_null($simplexml->Result) || !$simplexml->Result)	$data0_obj = @array();

	else
	$data0_obj = @$simplexml->Result->children();
	$data0 = @array();
	foreach($data0_obj as $value0){
		$data0_tmp = @array();
		$data0_tmp['Id'] = @(string)$value0->Id;
		$data0_tmp['id'] = @(string)$value0->Id;
		$data0_tmp['StatusCode'] = @(string)$value0->StatusCode;
		$data0_tmp['statuscode'] = @(string)$value0->StatusCode;
		$data0_tmp['StatusName'] = @(string)$value0->StatusName;
		$data0_tmp['statusname'] = @(string)$value0->StatusName;
		$data0_tmp['SubstatusCode'] = @(string)$value0->SubstatusCode;
		$data0_tmp['substatuscode'] = @(string)$value0->SubstatusCode;
		$data0_tmp['SubstatusName'] = @(string)$value0->SubstatusName;
		$data0_tmp['substatusname'] = @(string)$value0->SubstatusName;
		$data0_tmp['OperatorId'] = @(string)$value0->OperatorId;
		$data0_tmp['operatorid'] = @(string)$value0->OperatorId;
		$data0_tmp['OperatorName'] = @(string)$value0->OperatorName;
		$data0_tmp['operatorname'] = @(string)$value0->OperatorName;
		$data0_tmp['ItemsCount'] = @$value0->ItemsCount;
		$data0_tmp['itemscount'] = @$value0->ItemsCount;
		$data0_tmp['GoodsAmount'] = @$value0->GoodsAmount;
		$data0_tmp['goodsamount'] = @$value0->GoodsAmount;
		$data0_tmp['DeliveryAmount'] = @$value0->DeliveryAmount;
		$data0_tmp['deliveryamount'] = @$value0->DeliveryAmount;
		$data0_tmp['TotalAmount'] = @$value0->TotalAmount;
		$data0_tmp['totalamount'] = @$value0->TotalAmount;
		$data0_tmp['RemainAmount'] = @$value0->RemainAmount;
		$data0_tmp['remainamount'] = @$value0->RemainAmount;
		$data0_tmp['CurrencySign'] = @(string)$value0->CurrencySign;
		$data0_tmp['currencysign'] = @(string)$value0->CurrencySign;
		$data0_tmp['CurrencyCode'] = @(string)$value0->CurrencyCode;
		$data0_tmp['currencycode'] = @(string)$value0->CurrencyCode;
		$data0_tmp['GoodsAmountInternal'] = @$value0->GoodsAmountInternal;
		$data0_tmp['goodsamountinternal'] = @$value0->GoodsAmountInternal;
		$data0_tmp['DeliveryAmountInternal'] = @$value0->DeliveryAmountInternal;
		$data0_tmp['deliveryamountinternal'] = @$value0->DeliveryAmountInternal;
		$data0_tmp['TotalAmountInternal'] = @$value0->TotalAmountInternal;
		$data0_tmp['totalamountinternal'] = @$value0->TotalAmountInternal;
		$data0_tmp['RemainAmountInternal'] = @$value0->RemainAmountInternal;
		$data0_tmp['remainamountinternal'] = @$value0->RemainAmountInternal;
		$data0_tmp['CurrencySignInternal'] = @(string)$value0->CurrencySignInternal;
		$data0_tmp['currencysigninternal'] = @(string)$value0->CurrencySignInternal;
		$data0_tmp['CurrencyCodeInternal'] = @(string)$value0->CurrencyCodeInternal;
		$data0_tmp['currencycodeinternal'] = @(string)$value0->CurrencyCodeInternal;
		$data0_tmp['CustComment'] = @(string)$value0->CustComment;
		$data0_tmp['custcomment'] = @(string)$value0->CustComment;
		$data0_tmp['DeliveryModeId'] = @(string)$value0->DeliveryModeId;
		$data0_tmp['deliverymodeid'] = @(string)$value0->DeliveryModeId;
		$data0_tmp['DeliveryModeName'] = @(string)$value0->DeliveryModeName;
		$data0_tmp['deliverymodename'] = @(string)$value0->DeliveryModeName;
		$data0_tmp['CanCancel'] = @(int)$value0->CanCancel;
		$data0_tmp['cancancel'] = @(int)$value0->CanCancel;
		$data0_tmp['CanConfirmShipment'] = @(int)$value0->CanConfirmShipment;
		$data0_tmp['canconfirmshipment'] = @(int)$value0->CanConfirmShipment;
		$data0_tmp['CanChangeAddress'] = @(int)$value0->CanChangeAddress;
		$data0_tmp['canchangeaddress'] = @(int)$value0->CanChangeAddress;
		$data0_tmp['AdminInfoText'] = @(string)$value0->AdminInfoText;
		$data0_tmp['admininfotext'] = @(string)$value0->AdminInfoText;
		$data0_tmp['AdminAlertText'] = @(string)$value0->AdminAlertText;
		$data0_tmp['adminalerttext'] = @(string)$value0->AdminAlertText;
		$data0_tmp['PaidAmount'] = @$value0->PaidAmount;
		$data0_tmp['paidamount'] = @$value0->PaidAmount;
		$data0_tmp['PaidAmountInternal'] = @$value0->PaidAmountInternal;
		$data0_tmp['paidamountinternal'] = @$value0->PaidAmountInternal;
		$data0_tmp['CanRestore'] = @(int)$value0->CanRestore;
		$data0_tmp['canrestore'] = @(int)$value0->CanRestore;
		$data0_tmp['CanClose'] = @(int)$value0->CanClose;
		$data0_tmp['canclose'] = @(int)$value0->CanClose;
		$data0_tmp['CanCloseCancel'] = @(int)$value0->CanCloseCancel;
		$data0_tmp['canclosecancel'] = @(int)$value0->CanCloseCancel;
		$data0_tmp['CanAccept'] = @(int)$value0->CanAccept;
		$data0_tmp['canaccept'] = @(int)$value0->CanAccept;
		$data0_tmp['CanPurchaseItems'] = @(int)$value0->CanPurchaseItems;
		$data0_tmp['canpurchaseitems'] = @(int)$value0->CanPurchaseItems;
		$data0_tmp['PackagesWeight'] = @(int)$value0->PackagesWeight;
		$data0_tmp['packagesweight'] = @(int)$value0->PackagesWeight;
		$data0_tmp['EstimatedWeight'] = @(int)$value0->EstimatedWeight;
		$data0_tmp['estimatedweight'] = @(int)$value0->EstimatedWeight;
		$data0_tmp['CustId'] = @(string)$value0->CustId;
		$data0_tmp['custid'] = @(string)$value0->CustId;
		$data0_tmp['CustName'] = @(string)$value0->CustName;
		$data0_tmp['custname'] = @(string)$value0->CustName;
		$data0_tmp['StatusId'] = @(int)$value0->StatusId;
		$data0_tmp['statusid'] = @(int)$value0->StatusId;
		$data0_tmp['Weight'] = @$value0->Weight;
		$data0_tmp['weight'] = @$value0->Weight;
if(!isset($data0_tmp['DeliveryAddress'])){$data0_tmp['DeliveryAddress'] = array();}
		$data1_obj = @$value0->DeliveryAddress;
if(!isset($data0_tmp['DeliveryAddress']['Id'])){$data0_tmp['DeliveryAddress']['Id'] = array();}
			$data2_obj = @$value0->DeliveryAddress->Id;
			$data0_tmp['DeliveryAddress']['Id'] = @(string)$data2_obj;
		$data0_tmp['DeliveryAddress']['id'] = @$data0_tmp['DeliveryAddress']['Id'];
if(!isset($data0_tmp['DeliveryAddress']['Familyname'])){$data0_tmp['DeliveryAddress']['Familyname'] = array();}
			$data2_obj = @$value0->DeliveryAddress->Familyname;
			$data0_tmp['DeliveryAddress']['Familyname'] = @(string)$data2_obj;
		$data0_tmp['DeliveryAddress']['familyname'] = @$data0_tmp['DeliveryAddress']['Familyname'];
if(!isset($data0_tmp['DeliveryAddress']['Name'])){$data0_tmp['DeliveryAddress']['Name'] = array();}
			$data2_obj = @$value0->DeliveryAddress->Name;
			$data0_tmp['DeliveryAddress']['Name'] = @(string)$data2_obj;
		$data0_tmp['DeliveryAddress']['name'] = @$data0_tmp['DeliveryAddress']['Name'];
if(!isset($data0_tmp['DeliveryAddress']['Patername'])){$data0_tmp['DeliveryAddress']['Patername'] = array();}
			$data2_obj = @$value0->DeliveryAddress->Patername;
			$data0_tmp['DeliveryAddress']['Patername'] = @(string)$data2_obj;
		$data0_tmp['DeliveryAddress']['patername'] = @$data0_tmp['DeliveryAddress']['Patername'];
if(!isset($data0_tmp['DeliveryAddress']['CountryCode'])){$data0_tmp['DeliveryAddress']['CountryCode'] = array();}
			$data2_obj = @$value0->DeliveryAddress->CountryCode;
			$data0_tmp['DeliveryAddress']['CountryCode'] = @(string)$data2_obj;
		$data0_tmp['DeliveryAddress']['countrycode'] = @$data0_tmp['DeliveryAddress']['CountryCode'];
if(!isset($data0_tmp['DeliveryAddress']['Country'])){$data0_tmp['DeliveryAddress']['Country'] = array();}
			$data2_obj = @$value0->DeliveryAddress->Country;
			$data0_tmp['DeliveryAddress']['Country'] = @(string)$data2_obj;
		$data0_tmp['DeliveryAddress']['country'] = @$data0_tmp['DeliveryAddress']['Country'];
if(!isset($data0_tmp['DeliveryAddress']['City'])){$data0_tmp['DeliveryAddress']['City'] = array();}
			$data2_obj = @$value0->DeliveryAddress->City;
			$data0_tmp['DeliveryAddress']['City'] = @(string)$data2_obj;
		$data0_tmp['DeliveryAddress']['city'] = @$data0_tmp['DeliveryAddress']['City'];
if(!isset($data0_tmp['DeliveryAddress']['Address'])){$data0_tmp['DeliveryAddress']['Address'] = array();}
			$data2_obj = @$value0->DeliveryAddress->Address;
			$data0_tmp['DeliveryAddress']['Address'] = @(string)$data2_obj;
		$data0_tmp['DeliveryAddress']['address'] = @$data0_tmp['DeliveryAddress']['Address'];
if(!isset($data0_tmp['DeliveryAddress']['Phone'])){$data0_tmp['DeliveryAddress']['Phone'] = array();}
			$data2_obj = @$value0->DeliveryAddress->Phone;
			$data0_tmp['DeliveryAddress']['Phone'] = @(string)$data2_obj;
		$data0_tmp['DeliveryAddress']['phone'] = @$data0_tmp['DeliveryAddress']['Phone'];
if(!isset($data0_tmp['DeliveryAddress']['PostalCode'])){$data0_tmp['DeliveryAddress']['PostalCode'] = array();}
			$data2_obj = @$value0->DeliveryAddress->PostalCode;
			$data0_tmp['DeliveryAddress']['PostalCode'] = @(string)$data2_obj;
		$data0_tmp['DeliveryAddress']['postalcode'] = @$data0_tmp['DeliveryAddress']['PostalCode'];
if(!isset($data0_tmp['DeliveryAddress']['RegionName'])){$data0_tmp['DeliveryAddress']['RegionName'] = array();}
			$data2_obj = @$value0->DeliveryAddress->RegionName;
			$data0_tmp['DeliveryAddress']['RegionName'] = @(string)$data2_obj;
		$data0_tmp['DeliveryAddress']['regionname'] = @$data0_tmp['DeliveryAddress']['RegionName'];
		$data0_tmp['TaoBaoPrice'] = @$value0->TaoBaoPrice;
		$data0_tmp['taobaoprice'] = @$value0->TaoBaoPrice;
		$data0_tmp['InternalDeliveryOriginalInExternalCurrency'] = @$value0->InternalDeliveryOriginalInExternalCurrency;
		$data0_tmp['internaldeliveryoriginalinexternalcurrency'] = @$value0->InternalDeliveryOriginalInExternalCurrency;
		$data0_tmp['AdditionalInfo'] = @(string)$value0->AdditionalInfo;
		$data0_tmp['additionalinfo'] = @(string)$value0->AdditionalInfo;
		$data0_tmp['ExternalCurrencyCode'] = @(string)$value0->ExternalCurrencyCode;
		$data0_tmp['externalcurrencycode'] = @(string)$value0->ExternalCurrencyCode;
		$data0_tmp['ShipmentDate'] = @$value0->ShipmentDate;
		$data0_tmp['shipmentdate'] = @$value0->ShipmentDate;
		$data0_tmp['TotalAmountOriginalInExternalCurrency'] = @$value0->TotalAmountOriginalInExternalCurrency;
		$data0_tmp['totalamountoriginalinexternalcurrency'] = @$value0->TotalAmountOriginalInExternalCurrency;
if(!isset($data0_tmp['PackagePrices'])){$data0_tmp['PackagePrices'] = array();}

	if(!isset($value0->PackagePrices) || is_null($value0->PackagePrices) || !$value0->PackagePrices)		$data1_obj = @array();

	else
		$data1_obj = @$value0->PackagePrices->children();
		$data0_tmp['PackagePrices'] = @array();
		foreach($data1_obj as $value1){
			$data1_tmp = @array();
			$data1_tmp['Id'] = @(string)$value1->Id;
			$data1_tmp['id'] = @(string)$value1->Id;
			$data1_tmp['PriceInternal'] = @$value1->PriceInternal;
			$data1_tmp['priceinternal'] = @$value1->PriceInternal;
			$data1_tmp['AdditionalPriceInternal'] = @$value1->AdditionalPriceInternal;
			$data1_tmp['additionalpriceinternal'] = @$value1->AdditionalPriceInternal;
			$data1_tmp['AdditionalPrice'] = @$value1->AdditionalPrice;
			$data1_tmp['additionalprice'] = @$value1->AdditionalPrice;
			$data1_tmp['Price'] = @$value1->Price;
			$data1_tmp['price'] = @$value1->Price;
			$data1_tmp['PriceCurrencyCode'] = @(string)$value1->PriceCurrencyCode;
			$data1_tmp['pricecurrencycode'] = @(string)$value1->PriceCurrencyCode;
			$data1_tmp['PriceUpdateDate'] = @$value1->PriceUpdateDate;
			$data1_tmp['priceupdatedate'] = @$value1->PriceUpdateDate;
			$data0_tmp['PackagePrices'][] = @$data1_tmp;
		}
if(!isset($data0_tmp['LineStatusSummaries'])){$data0_tmp['LineStatusSummaries'] = array();}

	if(!isset($value0->LineStatusSummaries) || is_null($value0->LineStatusSummaries) || !$value0->LineStatusSummaries)		$data1_obj = @array();

	else
		$data1_obj = @$value0->LineStatusSummaries->children();
		$data0_tmp['LineStatusSummaries'] = @array();
		foreach($data1_obj as $value1){
			$data1_tmp = @array();
if(!isset($data1_tmp['Status'])){$data1_tmp['Status'] = array();}
			$data2_obj = @$value1->Status;
if(!isset($data1_tmp['Status']['Id'])){$data1_tmp['Status']['Id'] = array();}
				$data3_obj = @$value1->Status->Id;
				$data1_tmp['Status']['Id'] = @$data3_obj;
			$data1_tmp['Status']['id'] = @$data1_tmp['Status']['Id'];
if(!isset($data1_tmp['Status']['Name'])){$data1_tmp['Status']['Name'] = array();}
				$data3_obj = @$value1->Status->Name;
				$data1_tmp['Status']['Name'] = @(string)$data3_obj;
			$data1_tmp['Status']['name'] = @$data1_tmp['Status']['Name'];
			$data1_tmp['Count'] = @(int)$value1->Count;
			$data1_tmp['count'] = @(int)$value1->Count;
			$data0_tmp['LineStatusSummaries'][] = @$data1_tmp;
		}
		$data0_tmp['UserAccountAvailableAmount'] = @$value0->UserAccountAvailableAmount;
		$data0_tmp['useraccountavailableamount'] = @$value0->UserAccountAvailableAmount;
		$data0_tmp['CreatedDateTime'] = @(string)$value0->CreatedDateTime;
		$data0_tmp['createddatetime'] = @(string)$value0->CreatedDateTime;
		$data0_tmp['UserLogin'] = @(string)$value0->UserLogin;
		$data0_tmp['userlogin'] = @(string)$value0->UserLogin;
if(!isset($data0_tmp['TotalOriginalCostList'])){$data0_tmp['TotalOriginalCostList'] = array();}

	if(!isset($value0->TotalOriginalCostList) || is_null($value0->TotalOriginalCostList) || !$value0->TotalOriginalCostList)		$data1_obj = @array();

	else
		$data1_obj = @$value0->TotalOriginalCostList->children();
		$data0_tmp['TotalOriginalCostList'] = @array();
		foreach($data1_obj as $value1){
			$data1_tmp = @array();
			$data1_tmp['CurrencyCode'] = @(string)$value1->CurrencyCode;
			$data1_tmp['currencycode'] = @(string)$value1->CurrencyCode;
			$data1_tmp['TotalCost'] = @$value1->TotalCost;
			$data1_tmp['totalcost'] = @$value1->TotalCost;
			$data1_tmp['TotalCostInInternalCurrency'] = @$value1->TotalCostInInternalCurrency;
			$data1_tmp['totalcostininternalcurrency'] = @$value1->TotalCostInInternalCurrency;
			$data0_tmp['TotalOriginalCostList'][] = @$data1_tmp;
		}
if(!isset($data0_tmp['PackageTotalCostPerCurrencyList'])){$data0_tmp['PackageTotalCostPerCurrencyList'] = array();}

	if(!isset($value0->PackageTotalCostPerCurrencyList) || is_null($value0->PackageTotalCostPerCurrencyList) || !$value0->PackageTotalCostPerCurrencyList)		$data1_obj = @array();

	else
		$data1_obj = @$value0->PackageTotalCostPerCurrencyList->children();
		$data0_tmp['PackageTotalCostPerCurrencyList'] = @array();
		foreach($data1_obj as $value1){
			$data1_tmp = @array();
			$data1_tmp['CurrencyCode'] = @(string)$value1->CurrencyCode;
			$data1_tmp['currencycode'] = @(string)$value1->CurrencyCode;
			$data1_tmp['TotalPrice'] = @$value1->TotalPrice;
			$data1_tmp['totalprice'] = @$value1->TotalPrice;
			$data1_tmp['TotalAdditionalPrice'] = @$value1->TotalAdditionalPrice;
			$data1_tmp['totaladditionalprice'] = @$value1->TotalAdditionalPrice;
			$data0_tmp['PackageTotalCostPerCurrencyList'][] = @$data1_tmp;
		}
		$data0_tmp['InternalDeliveryOriginalInInternalCurrency'] = @$value0->InternalDeliveryOriginalInInternalCurrency;
		$data0_tmp['internaldeliveryoriginalininternalcurrency'] = @$value0->InternalDeliveryOriginalInInternalCurrency;
		$data0_tmp['InternalOriginalPrice'] = @$value0->InternalOriginalPrice;
		$data0_tmp['internaloriginalprice'] = @$value0->InternalOriginalPrice;
		$data0_tmp['Profit'] = @$value0->Profit;
		$data0_tmp['profit'] = @$value0->Profit;
if(!isset($data0_tmp['RateList'])){$data0_tmp['RateList'] = array();}

	if(!isset($value0->RateList) || is_null($value0->RateList) || !$value0->RateList)		$data1_obj = @array();

	else
		$data1_obj = @$value0->RateList->children();
		$data0_tmp['RateList'] = @array();
		foreach($data1_obj as $value1){
			$data0_tmp['RateList'][] = @$value1;
		}
		$data0[] = @$data0_tmp;
	}
	return $data0;
    }
    public function GetSalesOrderDetails($sessionId, $salesId){
        $params = array(
            'sessionId' => $sessionId,
	    'salesId' => $salesId
        );
        $params += $this->defaultLogin();
        $simplexml = $this->_getData('GetSalesOrderDetails', $params);
        if (!$simplexml) return false;
        
        $data0 = array();
        
if(!isset($data0)){$data0 = array();}
	$data0_obj = @$simplexml->Result;
if(!isset($data0['SalesOrderInfo'])){$data0['SalesOrderInfo'] = array();}
		$data1_obj = @$simplexml->Result->SalesOrderInfo;
if(!isset($data0['SalesOrderInfo']['Id'])){$data0['SalesOrderInfo']['Id'] = array();}
			$data2_obj = @$simplexml->Result->SalesOrderInfo->Id;
			$data0['SalesOrderInfo']['Id'] = @(string)$data2_obj;
		$data0['SalesOrderInfo']['id'] = @$data0['SalesOrderInfo']['Id'];
if(!isset($data0['SalesOrderInfo']['StatusCode'])){$data0['SalesOrderInfo']['StatusCode'] = array();}
			$data2_obj = @$simplexml->Result->SalesOrderInfo->StatusCode;
			$data0['SalesOrderInfo']['StatusCode'] = @(string)$data2_obj;
		$data0['SalesOrderInfo']['statuscode'] = @$data0['SalesOrderInfo']['StatusCode'];
if(!isset($data0['SalesOrderInfo']['StatusName'])){$data0['SalesOrderInfo']['StatusName'] = array();}
			$data2_obj = @$simplexml->Result->SalesOrderInfo->StatusName;
			$data0['SalesOrderInfo']['StatusName'] = @(string)$data2_obj;
		$data0['SalesOrderInfo']['statusname'] = @$data0['SalesOrderInfo']['StatusName'];
if(!isset($data0['SalesOrderInfo']['SubstatusCode'])){$data0['SalesOrderInfo']['SubstatusCode'] = array();}
			$data2_obj = @$simplexml->Result->SalesOrderInfo->SubstatusCode;
			$data0['SalesOrderInfo']['SubstatusCode'] = @(string)$data2_obj;
		$data0['SalesOrderInfo']['substatuscode'] = @$data0['SalesOrderInfo']['SubstatusCode'];
if(!isset($data0['SalesOrderInfo']['SubstatusName'])){$data0['SalesOrderInfo']['SubstatusName'] = array();}
			$data2_obj = @$simplexml->Result->SalesOrderInfo->SubstatusName;
			$data0['SalesOrderInfo']['SubstatusName'] = @(string)$data2_obj;
		$data0['SalesOrderInfo']['substatusname'] = @$data0['SalesOrderInfo']['SubstatusName'];
if(!isset($data0['SalesOrderInfo']['OperatorId'])){$data0['SalesOrderInfo']['OperatorId'] = array();}
			$data2_obj = @$simplexml->Result->SalesOrderInfo->OperatorId;
			$data0['SalesOrderInfo']['OperatorId'] = @(string)$data2_obj;
		$data0['SalesOrderInfo']['operatorid'] = @$data0['SalesOrderInfo']['OperatorId'];
if(!isset($data0['SalesOrderInfo']['OperatorName'])){$data0['SalesOrderInfo']['OperatorName'] = array();}
			$data2_obj = @$simplexml->Result->SalesOrderInfo->OperatorName;
			$data0['SalesOrderInfo']['OperatorName'] = @(string)$data2_obj;
		$data0['SalesOrderInfo']['operatorname'] = @$data0['SalesOrderInfo']['OperatorName'];
if(!isset($data0['SalesOrderInfo']['ItemsCount'])){$data0['SalesOrderInfo']['ItemsCount'] = array();}
			$data2_obj = @$simplexml->Result->SalesOrderInfo->ItemsCount;
			$data0['SalesOrderInfo']['ItemsCount'] = @$data2_obj;
		$data0['SalesOrderInfo']['itemscount'] = @$data0['SalesOrderInfo']['ItemsCount'];
if(!isset($data0['SalesOrderInfo']['GoodsAmount'])){$data0['SalesOrderInfo']['GoodsAmount'] = array();}
			$data2_obj = @$simplexml->Result->SalesOrderInfo->GoodsAmount;
			$data0['SalesOrderInfo']['GoodsAmount'] = @$data2_obj;
		$data0['SalesOrderInfo']['goodsamount'] = @$data0['SalesOrderInfo']['GoodsAmount'];
if(!isset($data0['SalesOrderInfo']['DeliveryAmount'])){$data0['SalesOrderInfo']['DeliveryAmount'] = array();}
			$data2_obj = @$simplexml->Result->SalesOrderInfo->DeliveryAmount;
			$data0['SalesOrderInfo']['DeliveryAmount'] = @$data2_obj;
		$data0['SalesOrderInfo']['deliveryamount'] = @$data0['SalesOrderInfo']['DeliveryAmount'];
if(!isset($data0['SalesOrderInfo']['TotalAmount'])){$data0['SalesOrderInfo']['TotalAmount'] = array();}
			$data2_obj = @$simplexml->Result->SalesOrderInfo->TotalAmount;
			$data0['SalesOrderInfo']['TotalAmount'] = @$data2_obj;
		$data0['SalesOrderInfo']['totalamount'] = @$data0['SalesOrderInfo']['TotalAmount'];
if(!isset($data0['SalesOrderInfo']['RemainAmount'])){$data0['SalesOrderInfo']['RemainAmount'] = array();}
			$data2_obj = @$simplexml->Result->SalesOrderInfo->RemainAmount;
			$data0['SalesOrderInfo']['RemainAmount'] = @$data2_obj;
		$data0['SalesOrderInfo']['remainamount'] = @$data0['SalesOrderInfo']['RemainAmount'];
if(!isset($data0['SalesOrderInfo']['CurrencySign'])){$data0['SalesOrderInfo']['CurrencySign'] = array();}
			$data2_obj = @$simplexml->Result->SalesOrderInfo->CurrencySign;
			$data0['SalesOrderInfo']['CurrencySign'] = @(string)$data2_obj;
		$data0['SalesOrderInfo']['currencysign'] = @$data0['SalesOrderInfo']['CurrencySign'];
if(!isset($data0['SalesOrderInfo']['CurrencyCode'])){$data0['SalesOrderInfo']['CurrencyCode'] = array();}
			$data2_obj = @$simplexml->Result->SalesOrderInfo->CurrencyCode;
			$data0['SalesOrderInfo']['CurrencyCode'] = @(string)$data2_obj;
		$data0['SalesOrderInfo']['currencycode'] = @$data0['SalesOrderInfo']['CurrencyCode'];
if(!isset($data0['SalesOrderInfo']['GoodsAmountInternal'])){$data0['SalesOrderInfo']['GoodsAmountInternal'] = array();}
			$data2_obj = @$simplexml->Result->SalesOrderInfo->GoodsAmountInternal;
			$data0['SalesOrderInfo']['GoodsAmountInternal'] = @$data2_obj;
		$data0['SalesOrderInfo']['goodsamountinternal'] = @$data0['SalesOrderInfo']['GoodsAmountInternal'];
if(!isset($data0['SalesOrderInfo']['DeliveryAmountInternal'])){$data0['SalesOrderInfo']['DeliveryAmountInternal'] = array();}
			$data2_obj = @$simplexml->Result->SalesOrderInfo->DeliveryAmountInternal;
			$data0['SalesOrderInfo']['DeliveryAmountInternal'] = @$data2_obj;
		$data0['SalesOrderInfo']['deliveryamountinternal'] = @$data0['SalesOrderInfo']['DeliveryAmountInternal'];
if(!isset($data0['SalesOrderInfo']['TotalAmountInternal'])){$data0['SalesOrderInfo']['TotalAmountInternal'] = array();}
			$data2_obj = @$simplexml->Result->SalesOrderInfo->TotalAmountInternal;
			$data0['SalesOrderInfo']['TotalAmountInternal'] = @$data2_obj;
		$data0['SalesOrderInfo']['totalamountinternal'] = @$data0['SalesOrderInfo']['TotalAmountInternal'];
if(!isset($data0['SalesOrderInfo']['RemainAmountInternal'])){$data0['SalesOrderInfo']['RemainAmountInternal'] = array();}
			$data2_obj = @$simplexml->Result->SalesOrderInfo->RemainAmountInternal;
			$data0['SalesOrderInfo']['RemainAmountInternal'] = @$data2_obj;
		$data0['SalesOrderInfo']['remainamountinternal'] = @$data0['SalesOrderInfo']['RemainAmountInternal'];
if(!isset($data0['SalesOrderInfo']['CurrencySignInternal'])){$data0['SalesOrderInfo']['CurrencySignInternal'] = array();}
			$data2_obj = @$simplexml->Result->SalesOrderInfo->CurrencySignInternal;
			$data0['SalesOrderInfo']['CurrencySignInternal'] = @(string)$data2_obj;
		$data0['SalesOrderInfo']['currencysigninternal'] = @$data0['SalesOrderInfo']['CurrencySignInternal'];
if(!isset($data0['SalesOrderInfo']['CurrencyCodeInternal'])){$data0['SalesOrderInfo']['CurrencyCodeInternal'] = array();}
			$data2_obj = @$simplexml->Result->SalesOrderInfo->CurrencyCodeInternal;
			$data0['SalesOrderInfo']['CurrencyCodeInternal'] = @(string)$data2_obj;
		$data0['SalesOrderInfo']['currencycodeinternal'] = @$data0['SalesOrderInfo']['CurrencyCodeInternal'];
if(!isset($data0['SalesOrderInfo']['CustComment'])){$data0['SalesOrderInfo']['CustComment'] = array();}
			$data2_obj = @$simplexml->Result->SalesOrderInfo->CustComment;
			$data0['SalesOrderInfo']['CustComment'] = @(string)$data2_obj;
		$data0['SalesOrderInfo']['custcomment'] = @$data0['SalesOrderInfo']['CustComment'];
if(!isset($data0['SalesOrderInfo']['DeliveryModeId'])){$data0['SalesOrderInfo']['DeliveryModeId'] = array();}
			$data2_obj = @$simplexml->Result->SalesOrderInfo->DeliveryModeId;
			$data0['SalesOrderInfo']['DeliveryModeId'] = @(string)$data2_obj;
		$data0['SalesOrderInfo']['deliverymodeid'] = @$data0['SalesOrderInfo']['DeliveryModeId'];
if(!isset($data0['SalesOrderInfo']['DeliveryModeName'])){$data0['SalesOrderInfo']['DeliveryModeName'] = array();}
			$data2_obj = @$simplexml->Result->SalesOrderInfo->DeliveryModeName;
			$data0['SalesOrderInfo']['DeliveryModeName'] = @(string)$data2_obj;
		$data0['SalesOrderInfo']['deliverymodename'] = @$data0['SalesOrderInfo']['DeliveryModeName'];
if(!isset($data0['SalesOrderInfo']['CanCancel'])){$data0['SalesOrderInfo']['CanCancel'] = array();}
			$data2_obj = @$simplexml->Result->SalesOrderInfo->CanCancel;
			$data0['SalesOrderInfo']['CanCancel'] = @$data2_obj;
		$data0['SalesOrderInfo']['cancancel'] = @$data0['SalesOrderInfo']['CanCancel'];
if(!isset($data0['SalesOrderInfo']['CanConfirmShipment'])){$data0['SalesOrderInfo']['CanConfirmShipment'] = array();}
			$data2_obj = @$simplexml->Result->SalesOrderInfo->CanConfirmShipment;
			$data0['SalesOrderInfo']['CanConfirmShipment'] = @$data2_obj;
		$data0['SalesOrderInfo']['canconfirmshipment'] = @$data0['SalesOrderInfo']['CanConfirmShipment'];
if(!isset($data0['SalesOrderInfo']['CanChangeAddress'])){$data0['SalesOrderInfo']['CanChangeAddress'] = array();}
			$data2_obj = @$simplexml->Result->SalesOrderInfo->CanChangeAddress;
			$data0['SalesOrderInfo']['CanChangeAddress'] = @$data2_obj;
		$data0['SalesOrderInfo']['canchangeaddress'] = @$data0['SalesOrderInfo']['CanChangeAddress'];
if(!isset($data0['SalesOrderInfo']['AdminInfoText'])){$data0['SalesOrderInfo']['AdminInfoText'] = array();}
			$data2_obj = @$simplexml->Result->SalesOrderInfo->AdminInfoText;
			$data0['SalesOrderInfo']['AdminInfoText'] = @(string)$data2_obj;
		$data0['SalesOrderInfo']['admininfotext'] = @$data0['SalesOrderInfo']['AdminInfoText'];
if(!isset($data0['SalesOrderInfo']['AdminAlertText'])){$data0['SalesOrderInfo']['AdminAlertText'] = array();}
			$data2_obj = @$simplexml->Result->SalesOrderInfo->AdminAlertText;
			$data0['SalesOrderInfo']['AdminAlertText'] = @(string)$data2_obj;
		$data0['SalesOrderInfo']['adminalerttext'] = @$data0['SalesOrderInfo']['AdminAlertText'];
if(!isset($data0['SalesOrderInfo']['PaidAmount'])){$data0['SalesOrderInfo']['PaidAmount'] = array();}
			$data2_obj = @$simplexml->Result->SalesOrderInfo->PaidAmount;
			$data0['SalesOrderInfo']['PaidAmount'] = @$data2_obj;
		$data0['SalesOrderInfo']['paidamount'] = @$data0['SalesOrderInfo']['PaidAmount'];
if(!isset($data0['SalesOrderInfo']['PaidAmountInternal'])){$data0['SalesOrderInfo']['PaidAmountInternal'] = array();}
			$data2_obj = @$simplexml->Result->SalesOrderInfo->PaidAmountInternal;
			$data0['SalesOrderInfo']['PaidAmountInternal'] = @$data2_obj;
		$data0['SalesOrderInfo']['paidamountinternal'] = @$data0['SalesOrderInfo']['PaidAmountInternal'];
if(!isset($data0['SalesOrderInfo']['CanRestore'])){$data0['SalesOrderInfo']['CanRestore'] = array();}
			$data2_obj = @$simplexml->Result->SalesOrderInfo->CanRestore;
			$data0['SalesOrderInfo']['CanRestore'] = @$data2_obj;
		$data0['SalesOrderInfo']['canrestore'] = @$data0['SalesOrderInfo']['CanRestore'];
if(!isset($data0['SalesOrderInfo']['CanClose'])){$data0['SalesOrderInfo']['CanClose'] = array();}
			$data2_obj = @$simplexml->Result->SalesOrderInfo->CanClose;
			$data0['SalesOrderInfo']['CanClose'] = @$data2_obj;
		$data0['SalesOrderInfo']['canclose'] = @$data0['SalesOrderInfo']['CanClose'];
if(!isset($data0['SalesOrderInfo']['CanCloseCancel'])){$data0['SalesOrderInfo']['CanCloseCancel'] = array();}
			$data2_obj = @$simplexml->Result->SalesOrderInfo->CanCloseCancel;
			$data0['SalesOrderInfo']['CanCloseCancel'] = @$data2_obj;
		$data0['SalesOrderInfo']['canclosecancel'] = @$data0['SalesOrderInfo']['CanCloseCancel'];
if(!isset($data0['SalesOrderInfo']['CanAccept'])){$data0['SalesOrderInfo']['CanAccept'] = array();}
			$data2_obj = @$simplexml->Result->SalesOrderInfo->CanAccept;
			$data0['SalesOrderInfo']['CanAccept'] = @$data2_obj;
		$data0['SalesOrderInfo']['canaccept'] = @$data0['SalesOrderInfo']['CanAccept'];
if(!isset($data0['SalesOrderInfo']['CanPurchaseItems'])){$data0['SalesOrderInfo']['CanPurchaseItems'] = array();}
			$data2_obj = @$simplexml->Result->SalesOrderInfo->CanPurchaseItems;
			$data0['SalesOrderInfo']['CanPurchaseItems'] = @$data2_obj;
		$data0['SalesOrderInfo']['canpurchaseitems'] = @$data0['SalesOrderInfo']['CanPurchaseItems'];
if(!isset($data0['SalesOrderInfo']['PackagesWeight'])){$data0['SalesOrderInfo']['PackagesWeight'] = array();}
			$data2_obj = @$simplexml->Result->SalesOrderInfo->PackagesWeight;
			$data0['SalesOrderInfo']['PackagesWeight'] = @$data2_obj;
		$data0['SalesOrderInfo']['packagesweight'] = @$data0['SalesOrderInfo']['PackagesWeight'];
if(!isset($data0['SalesOrderInfo']['EstimatedWeight'])){$data0['SalesOrderInfo']['EstimatedWeight'] = array();}
			$data2_obj = @$simplexml->Result->SalesOrderInfo->EstimatedWeight;
			$data0['SalesOrderInfo']['EstimatedWeight'] = @$data2_obj;
		$data0['SalesOrderInfo']['estimatedweight'] = @$data0['SalesOrderInfo']['EstimatedWeight'];
if(!isset($data0['SalesOrderInfo']['CustId'])){$data0['SalesOrderInfo']['CustId'] = array();}
			$data2_obj = @$simplexml->Result->SalesOrderInfo->CustId;
			$data0['SalesOrderInfo']['CustId'] = @(string)$data2_obj;
		$data0['SalesOrderInfo']['custid'] = @$data0['SalesOrderInfo']['CustId'];
if(!isset($data0['SalesOrderInfo']['CustName'])){$data0['SalesOrderInfo']['CustName'] = array();}
			$data2_obj = @$simplexml->Result->SalesOrderInfo->CustName;
			$data0['SalesOrderInfo']['CustName'] = @(string)$data2_obj;
		$data0['SalesOrderInfo']['custname'] = @$data0['SalesOrderInfo']['CustName'];
if(!isset($data0['SalesOrderInfo']['StatusId'])){$data0['SalesOrderInfo']['StatusId'] = array();}
			$data2_obj = @$simplexml->Result->SalesOrderInfo->StatusId;
			$data0['SalesOrderInfo']['StatusId'] = @$data2_obj;
		$data0['SalesOrderInfo']['statusid'] = @$data0['SalesOrderInfo']['StatusId'];
if(!isset($data0['SalesOrderInfo']['Weight'])){$data0['SalesOrderInfo']['Weight'] = array();}
			$data2_obj = @$simplexml->Result->SalesOrderInfo->Weight;
			$data0['SalesOrderInfo']['Weight'] = @$data2_obj;
		$data0['SalesOrderInfo']['weight'] = @$data0['SalesOrderInfo']['Weight'];
if(!isset($data0['SalesOrderInfo']['DeliveryAddress'])){$data0['SalesOrderInfo']['DeliveryAddress'] = array();}
			$data2_obj = @$simplexml->Result->SalesOrderInfo->DeliveryAddress;
if(!isset($data0['SalesOrderInfo']['DeliveryAddress']['Id'])){$data0['SalesOrderInfo']['DeliveryAddress']['Id'] = array();}
				$data3_obj = @$simplexml->Result->SalesOrderInfo->DeliveryAddress->Id;
				$data0['SalesOrderInfo']['DeliveryAddress']['Id'] = @(string)$data3_obj;
			$data0['SalesOrderInfo']['DeliveryAddress']['id'] = @$data0['SalesOrderInfo']['DeliveryAddress']['Id'];
if(!isset($data0['SalesOrderInfo']['DeliveryAddress']['Familyname'])){$data0['SalesOrderInfo']['DeliveryAddress']['Familyname'] = array();}
				$data3_obj = @$simplexml->Result->SalesOrderInfo->DeliveryAddress->Familyname;
				$data0['SalesOrderInfo']['DeliveryAddress']['Familyname'] = @(string)$data3_obj;
			$data0['SalesOrderInfo']['DeliveryAddress']['familyname'] = @$data0['SalesOrderInfo']['DeliveryAddress']['Familyname'];
if(!isset($data0['SalesOrderInfo']['DeliveryAddress']['Name'])){$data0['SalesOrderInfo']['DeliveryAddress']['Name'] = array();}
				$data3_obj = @$simplexml->Result->SalesOrderInfo->DeliveryAddress->Name;
				$data0['SalesOrderInfo']['DeliveryAddress']['Name'] = @(string)$data3_obj;
			$data0['SalesOrderInfo']['DeliveryAddress']['name'] = @$data0['SalesOrderInfo']['DeliveryAddress']['Name'];
if(!isset($data0['SalesOrderInfo']['DeliveryAddress']['Patername'])){$data0['SalesOrderInfo']['DeliveryAddress']['Patername'] = array();}
				$data3_obj = @$simplexml->Result->SalesOrderInfo->DeliveryAddress->Patername;
				$data0['SalesOrderInfo']['DeliveryAddress']['Patername'] = @(string)$data3_obj;
			$data0['SalesOrderInfo']['DeliveryAddress']['patername'] = @$data0['SalesOrderInfo']['DeliveryAddress']['Patername'];
if(!isset($data0['SalesOrderInfo']['DeliveryAddress']['CountryCode'])){$data0['SalesOrderInfo']['DeliveryAddress']['CountryCode'] = array();}
				$data3_obj = @$simplexml->Result->SalesOrderInfo->DeliveryAddress->CountryCode;
				$data0['SalesOrderInfo']['DeliveryAddress']['CountryCode'] = @(string)$data3_obj;
			$data0['SalesOrderInfo']['DeliveryAddress']['countrycode'] = @$data0['SalesOrderInfo']['DeliveryAddress']['CountryCode'];
if(!isset($data0['SalesOrderInfo']['DeliveryAddress']['Country'])){$data0['SalesOrderInfo']['DeliveryAddress']['Country'] = array();}
				$data3_obj = @$simplexml->Result->SalesOrderInfo->DeliveryAddress->Country;
				$data0['SalesOrderInfo']['DeliveryAddress']['Country'] = @(string)$data3_obj;
			$data0['SalesOrderInfo']['DeliveryAddress']['country'] = @$data0['SalesOrderInfo']['DeliveryAddress']['Country'];
if(!isset($data0['SalesOrderInfo']['DeliveryAddress']['City'])){$data0['SalesOrderInfo']['DeliveryAddress']['City'] = array();}
				$data3_obj = @$simplexml->Result->SalesOrderInfo->DeliveryAddress->City;
				$data0['SalesOrderInfo']['DeliveryAddress']['City'] = @(string)$data3_obj;
			$data0['SalesOrderInfo']['DeliveryAddress']['city'] = @$data0['SalesOrderInfo']['DeliveryAddress']['City'];
if(!isset($data0['SalesOrderInfo']['DeliveryAddress']['Address'])){$data0['SalesOrderInfo']['DeliveryAddress']['Address'] = array();}
				$data3_obj = @$simplexml->Result->SalesOrderInfo->DeliveryAddress->Address;
				$data0['SalesOrderInfo']['DeliveryAddress']['Address'] = @(string)$data3_obj;
			$data0['SalesOrderInfo']['DeliveryAddress']['address'] = @$data0['SalesOrderInfo']['DeliveryAddress']['Address'];
if(!isset($data0['SalesOrderInfo']['DeliveryAddress']['Phone'])){$data0['SalesOrderInfo']['DeliveryAddress']['Phone'] = array();}
				$data3_obj = @$simplexml->Result->SalesOrderInfo->DeliveryAddress->Phone;
				$data0['SalesOrderInfo']['DeliveryAddress']['Phone'] = @(string)$data3_obj;
			$data0['SalesOrderInfo']['DeliveryAddress']['phone'] = @$data0['SalesOrderInfo']['DeliveryAddress']['Phone'];
if(!isset($data0['SalesOrderInfo']['DeliveryAddress']['PostalCode'])){$data0['SalesOrderInfo']['DeliveryAddress']['PostalCode'] = array();}
				$data3_obj = @$simplexml->Result->SalesOrderInfo->DeliveryAddress->PostalCode;
				$data0['SalesOrderInfo']['DeliveryAddress']['PostalCode'] = @(string)$data3_obj;
			$data0['SalesOrderInfo']['DeliveryAddress']['postalcode'] = @$data0['SalesOrderInfo']['DeliveryAddress']['PostalCode'];
if(!isset($data0['SalesOrderInfo']['DeliveryAddress']['RegionName'])){$data0['SalesOrderInfo']['DeliveryAddress']['RegionName'] = array();}
				$data3_obj = @$simplexml->Result->SalesOrderInfo->DeliveryAddress->RegionName;
				$data0['SalesOrderInfo']['DeliveryAddress']['RegionName'] = @(string)$data3_obj;
			$data0['SalesOrderInfo']['DeliveryAddress']['regionname'] = @$data0['SalesOrderInfo']['DeliveryAddress']['RegionName'];
		$data0['SalesOrderInfo']['deliveryaddress'] = @$data0['SalesOrderInfo']['DeliveryAddress'];
if(!isset($data0['SalesOrderInfo']['TaoBaoPrice'])){$data0['SalesOrderInfo']['TaoBaoPrice'] = array();}
			$data2_obj = @$simplexml->Result->SalesOrderInfo->TaoBaoPrice;
			$data0['SalesOrderInfo']['TaoBaoPrice'] = @$data2_obj;
		$data0['SalesOrderInfo']['taobaoprice'] = @$data0['SalesOrderInfo']['TaoBaoPrice'];
if(!isset($data0['SalesOrderInfo']['InternalDeliveryOriginalInExternalCurrency'])){$data0['SalesOrderInfo']['InternalDeliveryOriginalInExternalCurrency'] = array();}
			$data2_obj = @$simplexml->Result->SalesOrderInfo->InternalDeliveryOriginalInExternalCurrency;
			$data0['SalesOrderInfo']['InternalDeliveryOriginalInExternalCurrency'] = @$data2_obj;
		$data0['SalesOrderInfo']['internaldeliveryoriginalinexternalcurrency'] = @$data0['SalesOrderInfo']['InternalDeliveryOriginalInExternalCurrency'];
if(!isset($data0['SalesOrderInfo']['AdditionalInfo'])){$data0['SalesOrderInfo']['AdditionalInfo'] = array();}
			$data2_obj = @$simplexml->Result->SalesOrderInfo->AdditionalInfo;
			$data0['SalesOrderInfo']['AdditionalInfo'] = @(string)$data2_obj;
		$data0['SalesOrderInfo']['additionalinfo'] = @$data0['SalesOrderInfo']['AdditionalInfo'];
if(!isset($data0['SalesOrderInfo']['ExternalCurrencyCode'])){$data0['SalesOrderInfo']['ExternalCurrencyCode'] = array();}
			$data2_obj = @$simplexml->Result->SalesOrderInfo->ExternalCurrencyCode;
			$data0['SalesOrderInfo']['ExternalCurrencyCode'] = @(string)$data2_obj;
		$data0['SalesOrderInfo']['externalcurrencycode'] = @$data0['SalesOrderInfo']['ExternalCurrencyCode'];
if(!isset($data0['SalesOrderInfo']['ShipmentDate'])){$data0['SalesOrderInfo']['ShipmentDate'] = array();}
			$data2_obj = @$simplexml->Result->SalesOrderInfo->ShipmentDate;
			$data0['SalesOrderInfo']['ShipmentDate'] = @$data2_obj;
		$data0['SalesOrderInfo']['shipmentdate'] = @$data0['SalesOrderInfo']['ShipmentDate'];
if(!isset($data0['SalesOrderInfo']['TotalAmountOriginalInExternalCurrency'])){$data0['SalesOrderInfo']['TotalAmountOriginalInExternalCurrency'] = array();}
			$data2_obj = @$simplexml->Result->SalesOrderInfo->TotalAmountOriginalInExternalCurrency;
			$data0['SalesOrderInfo']['TotalAmountOriginalInExternalCurrency'] = @$data2_obj;
		$data0['SalesOrderInfo']['totalamountoriginalinexternalcurrency'] = @$data0['SalesOrderInfo']['TotalAmountOriginalInExternalCurrency'];
if(!isset($data0['SalesOrderInfo']['PackagePrices'])){$data0['SalesOrderInfo']['PackagePrices'] = array();}

	if(!isset($simplexml->Result->SalesOrderInfo->PackagePrices) || is_null($simplexml->Result->SalesOrderInfo->PackagePrices) || !$simplexml->Result->SalesOrderInfo->PackagePrices)			$data2_obj = @array();

	else
			$data2_obj = @$simplexml->Result->SalesOrderInfo->PackagePrices->children();
			$data0['SalesOrderInfo']['PackagePrices'] = @array();
			foreach($data2_obj as $value2){
				$data2_tmp = @array();
				$data2_tmp['Id'] = @(string)$value2->Id;
				$data2_tmp['id'] = @(string)$value2->Id;
				$data2_tmp['PriceInternal'] = @$value2->PriceInternal;
				$data2_tmp['priceinternal'] = @$value2->PriceInternal;
				$data2_tmp['AdditionalPriceInternal'] = @$value2->AdditionalPriceInternal;
				$data2_tmp['additionalpriceinternal'] = @$value2->AdditionalPriceInternal;
				$data2_tmp['AdditionalPrice'] = @$value2->AdditionalPrice;
				$data2_tmp['additionalprice'] = @$value2->AdditionalPrice;
				$data2_tmp['Price'] = @$value2->Price;
				$data2_tmp['price'] = @$value2->Price;
				$data2_tmp['PriceCurrencyCode'] = @(string)$value2->PriceCurrencyCode;
				$data2_tmp['pricecurrencycode'] = @(string)$value2->PriceCurrencyCode;
				$data2_tmp['PriceUpdateDate'] = @$value2->PriceUpdateDate;
				$data2_tmp['priceupdatedate'] = @$value2->PriceUpdateDate;
				$data0['SalesOrderInfo']['PackagePrices'][] = @$data2_tmp;
			}
		$data0['SalesOrderInfo']['packageprices'] = @$data0['SalesOrderInfo']['PackagePrices'];
if(!isset($data0['SalesOrderInfo']['LineStatusSummaries'])){$data0['SalesOrderInfo']['LineStatusSummaries'] = array();}

	if(!isset($simplexml->Result->SalesOrderInfo->LineStatusSummaries) || is_null($simplexml->Result->SalesOrderInfo->LineStatusSummaries) || !$simplexml->Result->SalesOrderInfo->LineStatusSummaries)			$data2_obj = @array();

	else
			$data2_obj = @$simplexml->Result->SalesOrderInfo->LineStatusSummaries->children();
			$data0['SalesOrderInfo']['LineStatusSummaries'] = @array();
			foreach($data2_obj as $value2){
				$data2_tmp = @array();
if(!isset($data2_tmp['Status'])){$data2_tmp['Status'] = array();}
				$data3_obj = @$value2->Status;
if(!isset($data2_tmp['Status']['Id'])){$data2_tmp['Status']['Id'] = array();}
					$data4_obj = @$value2->Status->Id;
					$data2_tmp['Status']['Id'] = @$data4_obj;
				$data2_tmp['Status']['id'] = @$data2_tmp['Status']['Id'];
if(!isset($data2_tmp['Status']['Name'])){$data2_tmp['Status']['Name'] = array();}
					$data4_obj = @$value2->Status->Name;
					$data2_tmp['Status']['Name'] = @(string)$data4_obj;
				$data2_tmp['Status']['name'] = @$data2_tmp['Status']['Name'];
				$data2_tmp['Count'] = @(int)$value2->Count;
				$data2_tmp['count'] = @(int)$value2->Count;
				$data0['SalesOrderInfo']['LineStatusSummaries'][] = @$data2_tmp;
			}
		$data0['SalesOrderInfo']['linestatussummaries'] = @$data0['SalesOrderInfo']['LineStatusSummaries'];
if(!isset($data0['SalesOrderInfo']['UserAccountAvailableAmount'])){$data0['SalesOrderInfo']['UserAccountAvailableAmount'] = array();}
			$data2_obj = @$simplexml->Result->SalesOrderInfo->UserAccountAvailableAmount;
			$data0['SalesOrderInfo']['UserAccountAvailableAmount'] = @$data2_obj;
		$data0['SalesOrderInfo']['useraccountavailableamount'] = @$data0['SalesOrderInfo']['UserAccountAvailableAmount'];
if(!isset($data0['SalesOrderInfo']['CreatedDateTime'])){$data0['SalesOrderInfo']['CreatedDateTime'] = array();}
			$data2_obj = @$simplexml->Result->SalesOrderInfo->CreatedDateTime;
			$data0['SalesOrderInfo']['CreatedDateTime'] = @(string)$data2_obj;
		$data0['SalesOrderInfo']['createddatetime'] = @$data0['SalesOrderInfo']['CreatedDateTime'];
if(!isset($data0['SalesOrderInfo']['UserLogin'])){$data0['SalesOrderInfo']['UserLogin'] = array();}
			$data2_obj = @$simplexml->Result->SalesOrderInfo->UserLogin;
			$data0['SalesOrderInfo']['UserLogin'] = @(string)$data2_obj;
		$data0['SalesOrderInfo']['userlogin'] = @$data0['SalesOrderInfo']['UserLogin'];
if(!isset($data0['SalesOrderInfo']['TotalOriginalCostList'])){$data0['SalesOrderInfo']['TotalOriginalCostList'] = array();}

	if(!isset($simplexml->Result->SalesOrderInfo->TotalOriginalCostList) || is_null($simplexml->Result->SalesOrderInfo->TotalOriginalCostList) || !$simplexml->Result->SalesOrderInfo->TotalOriginalCostList)			$data2_obj = @array();

	else
			$data2_obj = @$simplexml->Result->SalesOrderInfo->TotalOriginalCostList->children();
			$data0['SalesOrderInfo']['TotalOriginalCostList'] = @array();
			foreach($data2_obj as $value2){
				$data2_tmp = @array();
				$data2_tmp['CurrencyCode'] = @(string)$value2->CurrencyCode;
				$data2_tmp['currencycode'] = @(string)$value2->CurrencyCode;
				$data2_tmp['TotalCost'] = @$value2->TotalCost;
				$data2_tmp['totalcost'] = @$value2->TotalCost;
				$data2_tmp['TotalCostInInternalCurrency'] = @$value2->TotalCostInInternalCurrency;
				$data2_tmp['totalcostininternalcurrency'] = @$value2->TotalCostInInternalCurrency;
				$data0['SalesOrderInfo']['TotalOriginalCostList'][] = @$data2_tmp;
			}
		$data0['SalesOrderInfo']['totaloriginalcostlist'] = @$data0['SalesOrderInfo']['TotalOriginalCostList'];
if(!isset($data0['SalesOrderInfo']['PackageTotalCostPerCurrencyList'])){$data0['SalesOrderInfo']['PackageTotalCostPerCurrencyList'] = array();}

	if(!isset($simplexml->Result->SalesOrderInfo->PackageTotalCostPerCurrencyList) || is_null($simplexml->Result->SalesOrderInfo->PackageTotalCostPerCurrencyList) || !$simplexml->Result->SalesOrderInfo->PackageTotalCostPerCurrencyList)			$data2_obj = @array();

	else
			$data2_obj = @$simplexml->Result->SalesOrderInfo->PackageTotalCostPerCurrencyList->children();
			$data0['SalesOrderInfo']['PackageTotalCostPerCurrencyList'] = @array();
			foreach($data2_obj as $value2){
				$data2_tmp = @array();
				$data2_tmp['CurrencyCode'] = @(string)$value2->CurrencyCode;
				$data2_tmp['currencycode'] = @(string)$value2->CurrencyCode;
				$data2_tmp['TotalPrice'] = @$value2->TotalPrice;
				$data2_tmp['totalprice'] = @$value2->TotalPrice;
				$data2_tmp['TotalAdditionalPrice'] = @$value2->TotalAdditionalPrice;
				$data2_tmp['totaladditionalprice'] = @$value2->TotalAdditionalPrice;
				$data0['SalesOrderInfo']['PackageTotalCostPerCurrencyList'][] = @$data2_tmp;
			}
		$data0['SalesOrderInfo']['packagetotalcostpercurrencylist'] = @$data0['SalesOrderInfo']['PackageTotalCostPerCurrencyList'];
if(!isset($data0['SalesOrderInfo']['InternalDeliveryOriginalInInternalCurrency'])){$data0['SalesOrderInfo']['InternalDeliveryOriginalInInternalCurrency'] = array();}
			$data2_obj = @$simplexml->Result->SalesOrderInfo->InternalDeliveryOriginalInInternalCurrency;
			$data0['SalesOrderInfo']['InternalDeliveryOriginalInInternalCurrency'] = @$data2_obj;
		$data0['SalesOrderInfo']['internaldeliveryoriginalininternalcurrency'] = @$data0['SalesOrderInfo']['InternalDeliveryOriginalInInternalCurrency'];
if(!isset($data0['SalesOrderInfo']['InternalOriginalPrice'])){$data0['SalesOrderInfo']['InternalOriginalPrice'] = array();}
			$data2_obj = @$simplexml->Result->SalesOrderInfo->InternalOriginalPrice;
			$data0['SalesOrderInfo']['InternalOriginalPrice'] = @$data2_obj;
		$data0['SalesOrderInfo']['internaloriginalprice'] = @$data0['SalesOrderInfo']['InternalOriginalPrice'];
if(!isset($data0['SalesOrderInfo']['Profit'])){$data0['SalesOrderInfo']['Profit'] = array();}
			$data2_obj = @$simplexml->Result->SalesOrderInfo->Profit;
			$data0['SalesOrderInfo']['Profit'] = @$data2_obj;
		$data0['SalesOrderInfo']['profit'] = @$data0['SalesOrderInfo']['Profit'];
if(!isset($data0['SalesOrderInfo']['RateList'])){$data0['SalesOrderInfo']['RateList'] = array();}

	if(!isset($simplexml->Result->SalesOrderInfo->RateList) || is_null($simplexml->Result->SalesOrderInfo->RateList) || !$simplexml->Result->SalesOrderInfo->RateList)			$data2_obj = @array();

	else
			$data2_obj = @$simplexml->Result->SalesOrderInfo->RateList->children();
			$data0['SalesOrderInfo']['RateList'] = @array();
			foreach($data2_obj as $value2){
				$data0['SalesOrderInfo']['RateList'][] = @$value2;
			}
		$data0['SalesOrderInfo']['ratelist'] = @$data0['SalesOrderInfo']['RateList'];
	$data0['salesorderinfo'] = @$data0['SalesOrderInfo'];
if(!isset($data0['SalesLinesList'])){$data0['SalesLinesList'] = array();}

	if(!isset($simplexml->Result->SalesLinesList) || is_null($simplexml->Result->SalesLinesList) || !$simplexml->Result->SalesLinesList)		$data1_obj = @array();

	else
		$data1_obj = @$simplexml->Result->SalesLinesList->children();
		$data0['SalesLinesList'] = @array();
		foreach($data1_obj as $value1){
			$data1_tmp = @array();
			$data1_tmp['Id'] = @(string)$value1->Id;
			$data1_tmp['id'] = @(string)$value1->Id;
			$data1_tmp['ItemTaobaoId'] = @(string)$value1->ItemTaobaoId;
			$data1_tmp['itemtaobaoid'] = @(string)$value1->ItemTaobaoId;
			$data1_tmp['ItemId'] = @(string)$value1->ItemId;
			$data1_tmp['itemid'] = @(string)$value1->ItemId;
			$data1_tmp['ConfigText'] = @(string)$value1->ConfigText;
			$data1_tmp['configtext'] = @(string)$value1->ConfigText;
			$data1_tmp['ConfigId'] = @(string)$value1->ConfigId;
			$data1_tmp['configid'] = @(string)$value1->ConfigId;
			$data1_tmp['Qty'] = @(int)$value1->Qty;
			$data1_tmp['qty'] = @(int)$value1->Qty;
			$data1_tmp['NewPriceCust'] = @$value1->NewPriceCust;
			$data1_tmp['newpricecust'] = @$value1->NewPriceCust;
			$data1_tmp['PriceCust'] = @$value1->PriceCust;
			$data1_tmp['pricecust'] = @$value1->PriceCust;
			$data1_tmp['AmountCust'] = @$value1->AmountCust;
			$data1_tmp['amountcust'] = @$value1->AmountCust;
			$data1_tmp['CurrencyCust'] = @(string)$value1->CurrencyCust;
			$data1_tmp['currencycust'] = @(string)$value1->CurrencyCust;
			$data1_tmp['PriceInternal'] = @$value1->PriceInternal;
			$data1_tmp['priceinternal'] = @$value1->PriceInternal;
			$data1_tmp['AmountInternal'] = @$value1->AmountInternal;
			$data1_tmp['amountinternal'] = @$value1->AmountInternal;
			$data1_tmp['CurrencyInternal'] = @(string)$value1->CurrencyInternal;
			$data1_tmp['currencyinternal'] = @(string)$value1->CurrencyInternal;
			$data1_tmp['InternalPriceCurrencyCode'] = @(string)$value1->InternalPriceCurrencyCode;
			$data1_tmp['internalpricecurrencycode'] = @(string)$value1->InternalPriceCurrencyCode;
			$data1_tmp['PurchPriceCust'] = @$value1->PurchPriceCust;
			$data1_tmp['purchpricecust'] = @$value1->PurchPriceCust;
			$data1_tmp['PurchDeliveryCust'] = @$value1->PurchDeliveryCust;
			$data1_tmp['purchdeliverycust'] = @$value1->PurchDeliveryCust;
			$data1_tmp['PurchAmountCust'] = @$value1->PurchAmountCust;
			$data1_tmp['purchamountcust'] = @$value1->PurchAmountCust;
			$data1_tmp['PurchPrice'] = @$value1->PurchPrice;
			$data1_tmp['purchprice'] = @$value1->PurchPrice;
			$data1_tmp['PurchDelivery'] = @$value1->PurchDelivery;
			$data1_tmp['purchdelivery'] = @$value1->PurchDelivery;
			$data1_tmp['PurchAmount'] = @$value1->PurchAmount;
			$data1_tmp['purchamount'] = @$value1->PurchAmount;
			$data1_tmp['PurchCurrency'] = @(string)$value1->PurchCurrency;
			$data1_tmp['purchcurrency'] = @(string)$value1->PurchCurrency;
			$data1_tmp['BriefDescrTrans'] = @(string)$value1->BriefDescrTrans;
			$data1_tmp['briefdescrtrans'] = @(string)$value1->BriefDescrTrans;
			$data1_tmp['ItemImageURL'] = @(string)$value1->ItemImageURL;
			$data1_tmp['itemimageurl'] = @(string)$value1->ItemImageURL;
			$data1_tmp['ItemExternalURL'] = @(string)$value1->ItemExternalURL;
			$data1_tmp['itemexternalurl'] = @(string)$value1->ItemExternalURL;
			$data1_tmp['VendNick'] = @(string)$value1->VendNick;
			$data1_tmp['vendnick'] = @(string)$value1->VendNick;
			$data1_tmp['VendId'] = @(string)$value1->VendId;
			$data1_tmp['vendid'] = @(string)$value1->VendId;
			$data1_tmp['CustComment'] = @(string)$value1->CustComment;
			$data1_tmp['custcomment'] = @(string)$value1->CustComment;
			$data1_tmp['OperatorComment'] = @(string)$value1->OperatorComment;
			$data1_tmp['operatorcomment'] = @(string)$value1->OperatorComment;
			$data1_tmp['StatusCode'] = @$value1->StatusCode;
			$data1_tmp['statuscode'] = @$value1->StatusCode;
			$data1_tmp['StatusId'] = @(int)$value1->StatusId;
			$data1_tmp['statusid'] = @(int)$value1->StatusId;
			$data1_tmp['StatusName'] = @(string)$value1->StatusName;
			$data1_tmp['statusname'] = @(string)$value1->StatusName;
			$data1_tmp['SubSalesNum'] = @(string)$value1->SubSalesNum;
			$data1_tmp['subsalesnum'] = @(string)$value1->SubSalesNum;
			$data1_tmp['SubSalesDate'] = @(string)$value1->SubSalesDate;
			$data1_tmp['subsalesdate'] = @(string)$value1->SubSalesDate;
			$data1_tmp['SubSalesTime'] = @(string)$value1->SubSalesTime;
			$data1_tmp['subsalestime'] = @(string)$value1->SubSalesTime;
			$data1_tmp['VendPurchId'] = @(string)$value1->VendPurchId;
			$data1_tmp['vendpurchid'] = @(string)$value1->VendPurchId;
			$data1_tmp['VendPurchWaybill'] = @(string)$value1->VendPurchWaybill;
			$data1_tmp['vendpurchwaybill'] = @(string)$value1->VendPurchWaybill;
			$data1_tmp['TaoBaoDelivery'] = @$value1->TaoBaoDelivery;
			$data1_tmp['taobaodelivery'] = @$value1->TaoBaoDelivery;
			$data1_tmp['TaoBaoPrice'] = @$value1->TaoBaoPrice;
			$data1_tmp['taobaoprice'] = @$value1->TaoBaoPrice;
			$data1_tmp['InternalOriginalPrice'] = @$value1->InternalOriginalPrice;
			$data1_tmp['internaloriginalprice'] = @$value1->InternalOriginalPrice;
			$data1_tmp['InternalDeliveryPrice'] = @$value1->InternalDeliveryPrice;
			$data1_tmp['internaldeliveryprice'] = @$value1->InternalDeliveryPrice;
			$data1_tmp['PromotionId'] = @(string)$value1->PromotionId;
			$data1_tmp['promotionid'] = @(string)$value1->PromotionId;
			$data1_tmp['PriceWithoutDelivery'] = @(string)$value1->PriceWithoutDelivery;
			$data1_tmp['pricewithoutdelivery'] = @(string)$value1->PriceWithoutDelivery;
			$data1_tmp['CategoryId'] = @(string)$value1->CategoryId;
			$data1_tmp['categoryid'] = @(string)$value1->CategoryId;
			$data1_tmp['VendURL'] = @(string)$value1->VendURL;
			$data1_tmp['vendurl'] = @(string)$value1->VendURL;
			$data1_tmp['QtyOrig'] = @(string)$value1->QtyOrig;
			$data1_tmp['qtyorig'] = @(string)$value1->QtyOrig;
			$data1_tmp['LineNum'] = @(int)$value1->LineNum;
			$data1_tmp['linenum'] = @(int)$value1->LineNum;
if(!isset($data1_tmp['AvailableStatusList'])){$data1_tmp['AvailableStatusList'] = array();}

	if(!isset($value1->AvailableStatusList) || is_null($value1->AvailableStatusList) || !$value1->AvailableStatusList)			$data2_obj = @array();

	else
			$data2_obj = @$value1->AvailableStatusList->children();
			$data1_tmp['AvailableStatusList'] = @array();
			foreach($data2_obj as $value2){
				$data2_tmp = @array();
				$data2_tmp['Id'] = @(int)$value2->Id;
				$data2_tmp['id'] = @(int)$value2->Id;
				$data2_tmp['Name'] = @(string)$value2->Name;
				$data2_tmp['name'] = @(string)$value2->Name;
				$data1_tmp['AvailableStatusList'][] = @$data2_tmp;
			}
			$data1_tmp['NameOrig'] = @(string)$value1->NameOrig;
			$data1_tmp['nameorig'] = @(string)$value1->NameOrig;
			$data1_tmp['ConfigExternalTextOrig'] = @(string)$value1->ConfigExternalTextOrig;
			$data1_tmp['configexternaltextorig'] = @(string)$value1->ConfigExternalTextOrig;
			$data1_tmp['Weight'] = @$value1->Weight;
			$data1_tmp['weight'] = @$value1->Weight;
			$data0['SalesLinesList'][] = @$data1_tmp;
		}
	$data0['saleslineslist'] = @$data0['SalesLinesList'];
	return $data0;
    }
    public function GetPaymentModes(){
        $params = array(
            
        );
        $params += $this->defaultLogin();
        $simplexml = $this->_getData('GetPaymentModes', $params);
        if (!$simplexml) return false;
        
        $data0 = array();
        
if(!isset($data0)){$data0 = array();}

	if(!isset($simplexml->Result) || is_null($simplexml->Result) || !$simplexml->Result)	$data0_obj = @array();

	else
	$data0_obj = @$simplexml->Result->children();
	$data0 = @array();
	foreach($data0_obj as $value0){
		$data0_tmp = @array();
		$data0_tmp['Id'] = @(string)$value0->Id;
		$data0_tmp['id'] = @(string)$value0->Id;
		$data0_tmp['Name'] = @(string)$value0->Name;
		$data0_tmp['name'] = @(string)$value0->Name;
		$data0_tmp['Description'] = @(string)$value0->Description;
		$data0_tmp['description'] = @(string)$value0->Description;
		$data0_tmp['PaymSortCode'] = @(string)$value0->PaymSortCode;
		$data0_tmp['paymsortcode'] = @(string)$value0->PaymSortCode;
		$data0_tmp['PaymSortText'] = @(string)$value0->PaymSortText;
		$data0_tmp['paymsorttext'] = @(string)$value0->PaymSortText;
		$data0_tmp['ImageURL'] = @(string)$value0->ImageURL;
		$data0_tmp['imageurl'] = @(string)$value0->ImageURL;
		$data0_tmp['CustomField'] = @$value0->CustomField;
		$data0_tmp['customfield'] = @$value0->CustomField;
		$data0_tmp['PaymentSystem'] = @(string)$value0->PaymentSystem;
		$data0_tmp['paymentsystem'] = @(string)$value0->PaymentSystem;
		$data0_tmp['SortOrder'] = @(int)$value0->SortOrder;
		$data0_tmp['sortorder'] = @(int)$value0->SortOrder;
		$data0[] = @$data0_tmp;
	}
	return $data0;
    }
    public function GetDeliveryModesWithPrice($countryId, $weight){
        $params = array(
            'countryId' => $countryId,
	    'weight' => $weight
        );
        $params += $this->defaultLogin();
        $simplexml = $this->_getData('GetDeliveryModesWithPrice', $params);
        if (!$simplexml) return false;
        
        $data0 = array();
        
if(!isset($data0)){$data0 = array();}

	if(!isset($simplexml->Result) || is_null($simplexml->Result) || !$simplexml->Result)	$data0_obj = @array();

	else
	$data0_obj = @$simplexml->Result->children();
	$data0 = @array();
	foreach($data0_obj as $value0){
		$data0_tmp = @array();
		$data0_tmp['Id'] = @(string)$value0->Id;
		$data0_tmp['id'] = @(string)$value0->Id;
		$data0_tmp['Name'] = @(string)$value0->Name;
		$data0_tmp['name'] = @(string)$value0->Name;
		$data0_tmp['Description'] = @(string)$value0->Description;
		$data0_tmp['description'] = @(string)$value0->Description;
		$data0_tmp['Price'] = @$value0->Price;
		$data0_tmp['price'] = @$value0->Price;
if(!isset($data0_tmp['FullPrice'])){$data0_tmp['FullPrice'] = array();}
		$data1_obj = @$value0->FullPrice;
if(!isset($data0_tmp['FullPrice']['OriginalPrice'])){$data0_tmp['FullPrice']['OriginalPrice'] = array();}
			$data2_obj = @$value0->FullPrice->OriginalPrice;
			$data0_tmp['FullPrice']['OriginalPrice'] = @$data2_obj;
		$data0_tmp['FullPrice']['originalprice'] = @$data0_tmp['FullPrice']['OriginalPrice'];
if(!isset($data0_tmp['FullPrice']['MarginPrice'])){$data0_tmp['FullPrice']['MarginPrice'] = array();}
			$data2_obj = @$value0->FullPrice->MarginPrice;
			$data0_tmp['FullPrice']['MarginPrice'] = @$data2_obj;
		$data0_tmp['FullPrice']['marginprice'] = @$data0_tmp['FullPrice']['MarginPrice'];
if(!isset($data0_tmp['FullPrice']['OriginalCurrencyCode'])){$data0_tmp['FullPrice']['OriginalCurrencyCode'] = array();}
			$data2_obj = @$value0->FullPrice->OriginalCurrencyCode;
			$data0_tmp['FullPrice']['OriginalCurrencyCode'] = @(string)$data2_obj;
		$data0_tmp['FullPrice']['originalcurrencycode'] = @$data0_tmp['FullPrice']['OriginalCurrencyCode'];
if(!isset($data0_tmp['FullPrice']['ConvertedPriceList'])){$data0_tmp['FullPrice']['ConvertedPriceList'] = array();}
			$data2_obj = @$value0->FullPrice->ConvertedPriceList;
if(!isset($data0_tmp['FullPrice']['ConvertedPriceList']['Internal'])){$data0_tmp['FullPrice']['ConvertedPriceList']['Internal'] = array();}
				$data3_obj = @$value0->FullPrice->ConvertedPriceList->Internal;
				$data0_tmp['FullPrice']['ConvertedPriceList']['Internal'] = @$data3_obj;
			$data0_tmp['FullPrice']['ConvertedPriceList']['internal'] = @$data0_tmp['FullPrice']['ConvertedPriceList']['Internal'];
if(!isset($data0_tmp['FullPrice']['ConvertedPriceList']['DisplayedMoneys'])){$data0_tmp['FullPrice']['ConvertedPriceList']['DisplayedMoneys'] = array();}

	if(!isset($value0->FullPrice->ConvertedPriceList->DisplayedMoneys) || is_null($value0->FullPrice->ConvertedPriceList->DisplayedMoneys) || !$value0->FullPrice->ConvertedPriceList->DisplayedMoneys)				$data3_obj = @array();

	else
				$data3_obj = @$value0->FullPrice->ConvertedPriceList->DisplayedMoneys->children();
				$data0_tmp['FullPrice']['ConvertedPriceList']['DisplayedMoneys'] = @array();
				foreach($data3_obj as $value3){
					$data0_tmp['FullPrice']['ConvertedPriceList']['DisplayedMoneys'][] = @$value3;
				}
			$data0_tmp['FullPrice']['ConvertedPriceList']['displayedmoneys'] = @$data0_tmp['FullPrice']['ConvertedPriceList']['DisplayedMoneys'];
		$data0_tmp['FullPrice']['convertedpricelist'] = @$data0_tmp['FullPrice']['ConvertedPriceList'];
		$data0_tmp['CurrencyCode'] = @(string)$value0->CurrencyCode;
		$data0_tmp['currencycode'] = @(string)$value0->CurrencyCode;
		$data0_tmp['CurrencySign'] = @(string)$value0->CurrencySign;
		$data0_tmp['currencysign'] = @(string)$value0->CurrencySign;
		$data0[] = @$data0_tmp;
	}
	return $data0;
    }
    public function CreateSalesOrder($sessionId, $deliveryModeId, $comment, $weight){
        $params = array(
            'sessionId' => $sessionId,
	    'deliveryModeId' => $deliveryModeId,
	    'comment' => $comment,
	    'weight' => $weight
        );
        $params += $this->defaultLogin();
        $simplexml = $this->_getData('CreateSalesOrder', $params);
        if (!$simplexml) return false;
        
        $data0 = array();
        
if(!isset($data0)){$data0 = array();}
	$data0_obj = @$simplexml->Result;
if(!isset($data0['Id'])){$data0['Id'] = array();}
		$data1_obj = @$simplexml->Result->Id;
		$data0['Id'] = @(string)$data1_obj;
	$data0['id'] = @$data0['Id'];
if(!isset($data0['StatusCode'])){$data0['StatusCode'] = array();}
		$data1_obj = @$simplexml->Result->StatusCode;
		$data0['StatusCode'] = @(string)$data1_obj;
	$data0['statuscode'] = @$data0['StatusCode'];
if(!isset($data0['StatusName'])){$data0['StatusName'] = array();}
		$data1_obj = @$simplexml->Result->StatusName;
		$data0['StatusName'] = @(string)$data1_obj;
	$data0['statusname'] = @$data0['StatusName'];
if(!isset($data0['SubstatusCode'])){$data0['SubstatusCode'] = array();}
		$data1_obj = @$simplexml->Result->SubstatusCode;
		$data0['SubstatusCode'] = @(string)$data1_obj;
	$data0['substatuscode'] = @$data0['SubstatusCode'];
if(!isset($data0['SubstatusName'])){$data0['SubstatusName'] = array();}
		$data1_obj = @$simplexml->Result->SubstatusName;
		$data0['SubstatusName'] = @(string)$data1_obj;
	$data0['substatusname'] = @$data0['SubstatusName'];
if(!isset($data0['OperatorId'])){$data0['OperatorId'] = array();}
		$data1_obj = @$simplexml->Result->OperatorId;
		$data0['OperatorId'] = @(string)$data1_obj;
	$data0['operatorid'] = @$data0['OperatorId'];
if(!isset($data0['OperatorName'])){$data0['OperatorName'] = array();}
		$data1_obj = @$simplexml->Result->OperatorName;
		$data0['OperatorName'] = @(string)$data1_obj;
	$data0['operatorname'] = @$data0['OperatorName'];
if(!isset($data0['ItemsCount'])){$data0['ItemsCount'] = array();}
		$data1_obj = @$simplexml->Result->ItemsCount;
		$data0['ItemsCount'] = @$data1_obj;
	$data0['itemscount'] = @$data0['ItemsCount'];
if(!isset($data0['GoodsAmount'])){$data0['GoodsAmount'] = array();}
		$data1_obj = @$simplexml->Result->GoodsAmount;
		$data0['GoodsAmount'] = @$data1_obj;
	$data0['goodsamount'] = @$data0['GoodsAmount'];
if(!isset($data0['DeliveryAmount'])){$data0['DeliveryAmount'] = array();}
		$data1_obj = @$simplexml->Result->DeliveryAmount;
		$data0['DeliveryAmount'] = @$data1_obj;
	$data0['deliveryamount'] = @$data0['DeliveryAmount'];
if(!isset($data0['TotalAmount'])){$data0['TotalAmount'] = array();}
		$data1_obj = @$simplexml->Result->TotalAmount;
		$data0['TotalAmount'] = @$data1_obj;
	$data0['totalamount'] = @$data0['TotalAmount'];
if(!isset($data0['RemainAmount'])){$data0['RemainAmount'] = array();}
		$data1_obj = @$simplexml->Result->RemainAmount;
		$data0['RemainAmount'] = @$data1_obj;
	$data0['remainamount'] = @$data0['RemainAmount'];
if(!isset($data0['CurrencySign'])){$data0['CurrencySign'] = array();}
		$data1_obj = @$simplexml->Result->CurrencySign;
		$data0['CurrencySign'] = @(string)$data1_obj;
	$data0['currencysign'] = @$data0['CurrencySign'];
if(!isset($data0['CurrencyCode'])){$data0['CurrencyCode'] = array();}
		$data1_obj = @$simplexml->Result->CurrencyCode;
		$data0['CurrencyCode'] = @(string)$data1_obj;
	$data0['currencycode'] = @$data0['CurrencyCode'];
if(!isset($data0['GoodsAmountInternal'])){$data0['GoodsAmountInternal'] = array();}
		$data1_obj = @$simplexml->Result->GoodsAmountInternal;
		$data0['GoodsAmountInternal'] = @$data1_obj;
	$data0['goodsamountinternal'] = @$data0['GoodsAmountInternal'];
if(!isset($data0['DeliveryAmountInternal'])){$data0['DeliveryAmountInternal'] = array();}
		$data1_obj = @$simplexml->Result->DeliveryAmountInternal;
		$data0['DeliveryAmountInternal'] = @$data1_obj;
	$data0['deliveryamountinternal'] = @$data0['DeliveryAmountInternal'];
if(!isset($data0['TotalAmountInternal'])){$data0['TotalAmountInternal'] = array();}
		$data1_obj = @$simplexml->Result->TotalAmountInternal;
		$data0['TotalAmountInternal'] = @$data1_obj;
	$data0['totalamountinternal'] = @$data0['TotalAmountInternal'];
if(!isset($data0['RemainAmountInternal'])){$data0['RemainAmountInternal'] = array();}
		$data1_obj = @$simplexml->Result->RemainAmountInternal;
		$data0['RemainAmountInternal'] = @$data1_obj;
	$data0['remainamountinternal'] = @$data0['RemainAmountInternal'];
if(!isset($data0['CurrencySignInternal'])){$data0['CurrencySignInternal'] = array();}
		$data1_obj = @$simplexml->Result->CurrencySignInternal;
		$data0['CurrencySignInternal'] = @(string)$data1_obj;
	$data0['currencysigninternal'] = @$data0['CurrencySignInternal'];
if(!isset($data0['CurrencyCodeInternal'])){$data0['CurrencyCodeInternal'] = array();}
		$data1_obj = @$simplexml->Result->CurrencyCodeInternal;
		$data0['CurrencyCodeInternal'] = @(string)$data1_obj;
	$data0['currencycodeinternal'] = @$data0['CurrencyCodeInternal'];
if(!isset($data0['CustComment'])){$data0['CustComment'] = array();}
		$data1_obj = @$simplexml->Result->CustComment;
		$data0['CustComment'] = @(string)$data1_obj;
	$data0['custcomment'] = @$data0['CustComment'];
if(!isset($data0['DeliveryModeId'])){$data0['DeliveryModeId'] = array();}
		$data1_obj = @$simplexml->Result->DeliveryModeId;
		$data0['DeliveryModeId'] = @(string)$data1_obj;
	$data0['deliverymodeid'] = @$data0['DeliveryModeId'];
if(!isset($data0['DeliveryModeName'])){$data0['DeliveryModeName'] = array();}
		$data1_obj = @$simplexml->Result->DeliveryModeName;
		$data0['DeliveryModeName'] = @(string)$data1_obj;
	$data0['deliverymodename'] = @$data0['DeliveryModeName'];
if(!isset($data0['CanCancel'])){$data0['CanCancel'] = array();}
		$data1_obj = @$simplexml->Result->CanCancel;
		$data0['CanCancel'] = @$data1_obj;
	$data0['cancancel'] = @$data0['CanCancel'];
if(!isset($data0['CanConfirmShipment'])){$data0['CanConfirmShipment'] = array();}
		$data1_obj = @$simplexml->Result->CanConfirmShipment;
		$data0['CanConfirmShipment'] = @$data1_obj;
	$data0['canconfirmshipment'] = @$data0['CanConfirmShipment'];
if(!isset($data0['CanChangeAddress'])){$data0['CanChangeAddress'] = array();}
		$data1_obj = @$simplexml->Result->CanChangeAddress;
		$data0['CanChangeAddress'] = @$data1_obj;
	$data0['canchangeaddress'] = @$data0['CanChangeAddress'];
if(!isset($data0['AdminInfoText'])){$data0['AdminInfoText'] = array();}
		$data1_obj = @$simplexml->Result->AdminInfoText;
		$data0['AdminInfoText'] = @(string)$data1_obj;
	$data0['admininfotext'] = @$data0['AdminInfoText'];
if(!isset($data0['AdminAlertText'])){$data0['AdminAlertText'] = array();}
		$data1_obj = @$simplexml->Result->AdminAlertText;
		$data0['AdminAlertText'] = @(string)$data1_obj;
	$data0['adminalerttext'] = @$data0['AdminAlertText'];
if(!isset($data0['PaidAmount'])){$data0['PaidAmount'] = array();}
		$data1_obj = @$simplexml->Result->PaidAmount;
		$data0['PaidAmount'] = @$data1_obj;
	$data0['paidamount'] = @$data0['PaidAmount'];
if(!isset($data0['PaidAmountInternal'])){$data0['PaidAmountInternal'] = array();}
		$data1_obj = @$simplexml->Result->PaidAmountInternal;
		$data0['PaidAmountInternal'] = @$data1_obj;
	$data0['paidamountinternal'] = @$data0['PaidAmountInternal'];
if(!isset($data0['CanRestore'])){$data0['CanRestore'] = array();}
		$data1_obj = @$simplexml->Result->CanRestore;
		$data0['CanRestore'] = @$data1_obj;
	$data0['canrestore'] = @$data0['CanRestore'];
if(!isset($data0['CanClose'])){$data0['CanClose'] = array();}
		$data1_obj = @$simplexml->Result->CanClose;
		$data0['CanClose'] = @$data1_obj;
	$data0['canclose'] = @$data0['CanClose'];
if(!isset($data0['CanCloseCancel'])){$data0['CanCloseCancel'] = array();}
		$data1_obj = @$simplexml->Result->CanCloseCancel;
		$data0['CanCloseCancel'] = @$data1_obj;
	$data0['canclosecancel'] = @$data0['CanCloseCancel'];
if(!isset($data0['CanAccept'])){$data0['CanAccept'] = array();}
		$data1_obj = @$simplexml->Result->CanAccept;
		$data0['CanAccept'] = @$data1_obj;
	$data0['canaccept'] = @$data0['CanAccept'];
if(!isset($data0['CanPurchaseItems'])){$data0['CanPurchaseItems'] = array();}
		$data1_obj = @$simplexml->Result->CanPurchaseItems;
		$data0['CanPurchaseItems'] = @$data1_obj;
	$data0['canpurchaseitems'] = @$data0['CanPurchaseItems'];
if(!isset($data0['PackagesWeight'])){$data0['PackagesWeight'] = array();}
		$data1_obj = @$simplexml->Result->PackagesWeight;
		$data0['PackagesWeight'] = @$data1_obj;
	$data0['packagesweight'] = @$data0['PackagesWeight'];
if(!isset($data0['EstimatedWeight'])){$data0['EstimatedWeight'] = array();}
		$data1_obj = @$simplexml->Result->EstimatedWeight;
		$data0['EstimatedWeight'] = @$data1_obj;
	$data0['estimatedweight'] = @$data0['EstimatedWeight'];
if(!isset($data0['CustId'])){$data0['CustId'] = array();}
		$data1_obj = @$simplexml->Result->CustId;
		$data0['CustId'] = @(string)$data1_obj;
	$data0['custid'] = @$data0['CustId'];
if(!isset($data0['CustName'])){$data0['CustName'] = array();}
		$data1_obj = @$simplexml->Result->CustName;
		$data0['CustName'] = @(string)$data1_obj;
	$data0['custname'] = @$data0['CustName'];
if(!isset($data0['StatusId'])){$data0['StatusId'] = array();}
		$data1_obj = @$simplexml->Result->StatusId;
		$data0['StatusId'] = @$data1_obj;
	$data0['statusid'] = @$data0['StatusId'];
if(!isset($data0['Weight'])){$data0['Weight'] = array();}
		$data1_obj = @$simplexml->Result->Weight;
		$data0['Weight'] = @$data1_obj;
	$data0['weight'] = @$data0['Weight'];
if(!isset($data0['DeliveryAddress'])){$data0['DeliveryAddress'] = array();}
		$data1_obj = @$simplexml->Result->DeliveryAddress;
if(!isset($data0['DeliveryAddress']['Id'])){$data0['DeliveryAddress']['Id'] = array();}
			$data2_obj = @$simplexml->Result->DeliveryAddress->Id;
			$data0['DeliveryAddress']['Id'] = @(string)$data2_obj;
		$data0['DeliveryAddress']['id'] = @$data0['DeliveryAddress']['Id'];
if(!isset($data0['DeliveryAddress']['Familyname'])){$data0['DeliveryAddress']['Familyname'] = array();}
			$data2_obj = @$simplexml->Result->DeliveryAddress->Familyname;
			$data0['DeliveryAddress']['Familyname'] = @(string)$data2_obj;
		$data0['DeliveryAddress']['familyname'] = @$data0['DeliveryAddress']['Familyname'];
if(!isset($data0['DeliveryAddress']['Name'])){$data0['DeliveryAddress']['Name'] = array();}
			$data2_obj = @$simplexml->Result->DeliveryAddress->Name;
			$data0['DeliveryAddress']['Name'] = @(string)$data2_obj;
		$data0['DeliveryAddress']['name'] = @$data0['DeliveryAddress']['Name'];
if(!isset($data0['DeliveryAddress']['Patername'])){$data0['DeliveryAddress']['Patername'] = array();}
			$data2_obj = @$simplexml->Result->DeliveryAddress->Patername;
			$data0['DeliveryAddress']['Patername'] = @(string)$data2_obj;
		$data0['DeliveryAddress']['patername'] = @$data0['DeliveryAddress']['Patername'];
if(!isset($data0['DeliveryAddress']['CountryCode'])){$data0['DeliveryAddress']['CountryCode'] = array();}
			$data2_obj = @$simplexml->Result->DeliveryAddress->CountryCode;
			$data0['DeliveryAddress']['CountryCode'] = @(string)$data2_obj;
		$data0['DeliveryAddress']['countrycode'] = @$data0['DeliveryAddress']['CountryCode'];
if(!isset($data0['DeliveryAddress']['Country'])){$data0['DeliveryAddress']['Country'] = array();}
			$data2_obj = @$simplexml->Result->DeliveryAddress->Country;
			$data0['DeliveryAddress']['Country'] = @(string)$data2_obj;
		$data0['DeliveryAddress']['country'] = @$data0['DeliveryAddress']['Country'];
if(!isset($data0['DeliveryAddress']['City'])){$data0['DeliveryAddress']['City'] = array();}
			$data2_obj = @$simplexml->Result->DeliveryAddress->City;
			$data0['DeliveryAddress']['City'] = @(string)$data2_obj;
		$data0['DeliveryAddress']['city'] = @$data0['DeliveryAddress']['City'];
if(!isset($data0['DeliveryAddress']['Address'])){$data0['DeliveryAddress']['Address'] = array();}
			$data2_obj = @$simplexml->Result->DeliveryAddress->Address;
			$data0['DeliveryAddress']['Address'] = @(string)$data2_obj;
		$data0['DeliveryAddress']['address'] = @$data0['DeliveryAddress']['Address'];
if(!isset($data0['DeliveryAddress']['Phone'])){$data0['DeliveryAddress']['Phone'] = array();}
			$data2_obj = @$simplexml->Result->DeliveryAddress->Phone;
			$data0['DeliveryAddress']['Phone'] = @(string)$data2_obj;
		$data0['DeliveryAddress']['phone'] = @$data0['DeliveryAddress']['Phone'];
if(!isset($data0['DeliveryAddress']['PostalCode'])){$data0['DeliveryAddress']['PostalCode'] = array();}
			$data2_obj = @$simplexml->Result->DeliveryAddress->PostalCode;
			$data0['DeliveryAddress']['PostalCode'] = @(string)$data2_obj;
		$data0['DeliveryAddress']['postalcode'] = @$data0['DeliveryAddress']['PostalCode'];
if(!isset($data0['DeliveryAddress']['RegionName'])){$data0['DeliveryAddress']['RegionName'] = array();}
			$data2_obj = @$simplexml->Result->DeliveryAddress->RegionName;
			$data0['DeliveryAddress']['RegionName'] = @(string)$data2_obj;
		$data0['DeliveryAddress']['regionname'] = @$data0['DeliveryAddress']['RegionName'];
	$data0['deliveryaddress'] = @$data0['DeliveryAddress'];
if(!isset($data0['TaoBaoPrice'])){$data0['TaoBaoPrice'] = array();}
		$data1_obj = @$simplexml->Result->TaoBaoPrice;
		$data0['TaoBaoPrice'] = @$data1_obj;
	$data0['taobaoprice'] = @$data0['TaoBaoPrice'];
if(!isset($data0['InternalDeliveryOriginalInExternalCurrency'])){$data0['InternalDeliveryOriginalInExternalCurrency'] = array();}
		$data1_obj = @$simplexml->Result->InternalDeliveryOriginalInExternalCurrency;
		$data0['InternalDeliveryOriginalInExternalCurrency'] = @$data1_obj;
	$data0['internaldeliveryoriginalinexternalcurrency'] = @$data0['InternalDeliveryOriginalInExternalCurrency'];
if(!isset($data0['AdditionalInfo'])){$data0['AdditionalInfo'] = array();}
		$data1_obj = @$simplexml->Result->AdditionalInfo;
		$data0['AdditionalInfo'] = @(string)$data1_obj;
	$data0['additionalinfo'] = @$data0['AdditionalInfo'];
if(!isset($data0['ExternalCurrencyCode'])){$data0['ExternalCurrencyCode'] = array();}
		$data1_obj = @$simplexml->Result->ExternalCurrencyCode;
		$data0['ExternalCurrencyCode'] = @(string)$data1_obj;
	$data0['externalcurrencycode'] = @$data0['ExternalCurrencyCode'];
if(!isset($data0['ShipmentDate'])){$data0['ShipmentDate'] = array();}
		$data1_obj = @$simplexml->Result->ShipmentDate;
		$data0['ShipmentDate'] = @$data1_obj;
	$data0['shipmentdate'] = @$data0['ShipmentDate'];
if(!isset($data0['TotalAmountOriginalInExternalCurrency'])){$data0['TotalAmountOriginalInExternalCurrency'] = array();}
		$data1_obj = @$simplexml->Result->TotalAmountOriginalInExternalCurrency;
		$data0['TotalAmountOriginalInExternalCurrency'] = @$data1_obj;
	$data0['totalamountoriginalinexternalcurrency'] = @$data0['TotalAmountOriginalInExternalCurrency'];
if(!isset($data0['PackagePrices'])){$data0['PackagePrices'] = array();}

	if(!isset($simplexml->Result->PackagePrices) || is_null($simplexml->Result->PackagePrices) || !$simplexml->Result->PackagePrices)		$data1_obj = @array();

	else
		$data1_obj = @$simplexml->Result->PackagePrices->children();
		$data0['PackagePrices'] = @array();
		foreach($data1_obj as $value1){
			$data1_tmp = @array();
			$data1_tmp['Id'] = @(string)$value1->Id;
			$data1_tmp['id'] = @(string)$value1->Id;
			$data1_tmp['PriceInternal'] = @$value1->PriceInternal;
			$data1_tmp['priceinternal'] = @$value1->PriceInternal;
			$data1_tmp['AdditionalPriceInternal'] = @$value1->AdditionalPriceInternal;
			$data1_tmp['additionalpriceinternal'] = @$value1->AdditionalPriceInternal;
			$data1_tmp['AdditionalPrice'] = @$value1->AdditionalPrice;
			$data1_tmp['additionalprice'] = @$value1->AdditionalPrice;
			$data1_tmp['Price'] = @$value1->Price;
			$data1_tmp['price'] = @$value1->Price;
			$data1_tmp['PriceCurrencyCode'] = @(string)$value1->PriceCurrencyCode;
			$data1_tmp['pricecurrencycode'] = @(string)$value1->PriceCurrencyCode;
			$data1_tmp['PriceUpdateDate'] = @$value1->PriceUpdateDate;
			$data1_tmp['priceupdatedate'] = @$value1->PriceUpdateDate;
			$data0['PackagePrices'][] = @$data1_tmp;
		}
	$data0['packageprices'] = @$data0['PackagePrices'];
if(!isset($data0['LineStatusSummaries'])){$data0['LineStatusSummaries'] = array();}

	if(!isset($simplexml->Result->LineStatusSummaries) || is_null($simplexml->Result->LineStatusSummaries) || !$simplexml->Result->LineStatusSummaries)		$data1_obj = @array();

	else
		$data1_obj = @$simplexml->Result->LineStatusSummaries->children();
		$data0['LineStatusSummaries'] = @array();
		foreach($data1_obj as $value1){
			$data1_tmp = @array();
if(!isset($data1_tmp['Status'])){$data1_tmp['Status'] = array();}
			$data2_obj = @$value1->Status;
if(!isset($data1_tmp['Status']['Id'])){$data1_tmp['Status']['Id'] = array();}
				$data3_obj = @$value1->Status->Id;
				$data1_tmp['Status']['Id'] = @$data3_obj;
			$data1_tmp['Status']['id'] = @$data1_tmp['Status']['Id'];
if(!isset($data1_tmp['Status']['Name'])){$data1_tmp['Status']['Name'] = array();}
				$data3_obj = @$value1->Status->Name;
				$data1_tmp['Status']['Name'] = @(string)$data3_obj;
			$data1_tmp['Status']['name'] = @$data1_tmp['Status']['Name'];
			$data1_tmp['Count'] = @(int)$value1->Count;
			$data1_tmp['count'] = @(int)$value1->Count;
			$data0['LineStatusSummaries'][] = @$data1_tmp;
		}
	$data0['linestatussummaries'] = @$data0['LineStatusSummaries'];
if(!isset($data0['UserAccountAvailableAmount'])){$data0['UserAccountAvailableAmount'] = array();}
		$data1_obj = @$simplexml->Result->UserAccountAvailableAmount;
		$data0['UserAccountAvailableAmount'] = @$data1_obj;
	$data0['useraccountavailableamount'] = @$data0['UserAccountAvailableAmount'];
if(!isset($data0['CreatedDateTime'])){$data0['CreatedDateTime'] = array();}
		$data1_obj = @$simplexml->Result->CreatedDateTime;
		$data0['CreatedDateTime'] = @(string)$data1_obj;
	$data0['createddatetime'] = @$data0['CreatedDateTime'];
if(!isset($data0['UserLogin'])){$data0['UserLogin'] = array();}
		$data1_obj = @$simplexml->Result->UserLogin;
		$data0['UserLogin'] = @(string)$data1_obj;
	$data0['userlogin'] = @$data0['UserLogin'];
if(!isset($data0['TotalOriginalCostList'])){$data0['TotalOriginalCostList'] = array();}

	if(!isset($simplexml->Result->TotalOriginalCostList) || is_null($simplexml->Result->TotalOriginalCostList) || !$simplexml->Result->TotalOriginalCostList)		$data1_obj = @array();

	else
		$data1_obj = @$simplexml->Result->TotalOriginalCostList->children();
		$data0['TotalOriginalCostList'] = @array();
		foreach($data1_obj as $value1){
			$data1_tmp = @array();
			$data1_tmp['CurrencyCode'] = @(string)$value1->CurrencyCode;
			$data1_tmp['currencycode'] = @(string)$value1->CurrencyCode;
			$data1_tmp['TotalCost'] = @$value1->TotalCost;
			$data1_tmp['totalcost'] = @$value1->TotalCost;
			$data1_tmp['TotalCostInInternalCurrency'] = @$value1->TotalCostInInternalCurrency;
			$data1_tmp['totalcostininternalcurrency'] = @$value1->TotalCostInInternalCurrency;
			$data0['TotalOriginalCostList'][] = @$data1_tmp;
		}
	$data0['totaloriginalcostlist'] = @$data0['TotalOriginalCostList'];
if(!isset($data0['PackageTotalCostPerCurrencyList'])){$data0['PackageTotalCostPerCurrencyList'] = array();}

	if(!isset($simplexml->Result->PackageTotalCostPerCurrencyList) || is_null($simplexml->Result->PackageTotalCostPerCurrencyList) || !$simplexml->Result->PackageTotalCostPerCurrencyList)		$data1_obj = @array();

	else
		$data1_obj = @$simplexml->Result->PackageTotalCostPerCurrencyList->children();
		$data0['PackageTotalCostPerCurrencyList'] = @array();
		foreach($data1_obj as $value1){
			$data1_tmp = @array();
			$data1_tmp['CurrencyCode'] = @(string)$value1->CurrencyCode;
			$data1_tmp['currencycode'] = @(string)$value1->CurrencyCode;
			$data1_tmp['TotalPrice'] = @$value1->TotalPrice;
			$data1_tmp['totalprice'] = @$value1->TotalPrice;
			$data1_tmp['TotalAdditionalPrice'] = @$value1->TotalAdditionalPrice;
			$data1_tmp['totaladditionalprice'] = @$value1->TotalAdditionalPrice;
			$data0['PackageTotalCostPerCurrencyList'][] = @$data1_tmp;
		}
	$data0['packagetotalcostpercurrencylist'] = @$data0['PackageTotalCostPerCurrencyList'];
if(!isset($data0['InternalDeliveryOriginalInInternalCurrency'])){$data0['InternalDeliveryOriginalInInternalCurrency'] = array();}
		$data1_obj = @$simplexml->Result->InternalDeliveryOriginalInInternalCurrency;
		$data0['InternalDeliveryOriginalInInternalCurrency'] = @$data1_obj;
	$data0['internaldeliveryoriginalininternalcurrency'] = @$data0['InternalDeliveryOriginalInInternalCurrency'];
if(!isset($data0['InternalOriginalPrice'])){$data0['InternalOriginalPrice'] = array();}
		$data1_obj = @$simplexml->Result->InternalOriginalPrice;
		$data0['InternalOriginalPrice'] = @$data1_obj;
	$data0['internaloriginalprice'] = @$data0['InternalOriginalPrice'];
if(!isset($data0['Profit'])){$data0['Profit'] = array();}
		$data1_obj = @$simplexml->Result->Profit;
		$data0['Profit'] = @$data1_obj;
	$data0['profit'] = @$data0['Profit'];
if(!isset($data0['RateList'])){$data0['RateList'] = array();}

	if(!isset($simplexml->Result->RateList) || is_null($simplexml->Result->RateList) || !$simplexml->Result->RateList)		$data1_obj = @array();

	else
		$data1_obj = @$simplexml->Result->RateList->children();
		$data0['RateList'] = @array();
		foreach($data1_obj as $value1){
			$data0['RateList'][] = @$value1;
		}
	$data0['ratelist'] = @$data0['RateList'];
	return $data0;
    }
    public function CreateMultiSalesOrder($sessionId, $deliveryModeId){
        $params = array(
            'sessionId' => $sessionId,
	    'deliveryModeId' => $deliveryModeId
        );
        $params += $this->defaultLogin();
        $simplexml = $this->_getData('CreateMultiSalesOrder', $params);
        if (!$simplexml) return false;
        
        $data0 = array();
        
if(!isset($data0)){$data0 = array();}

	if(!isset($simplexml->Result) || is_null($simplexml->Result) || !$simplexml->Result)	$data0_obj = @array();

	else
	$data0_obj = @$simplexml->Result->children();
	$data0 = @array();
	foreach($data0_obj as $value0){
		$data0_tmp = @array();
		$data0_tmp['Id'] = @(string)$value0->Id;
		$data0_tmp['id'] = @(string)$value0->Id;
		$data0_tmp['StatusCode'] = @(string)$value0->StatusCode;
		$data0_tmp['statuscode'] = @(string)$value0->StatusCode;
		$data0_tmp['StatusName'] = @(string)$value0->StatusName;
		$data0_tmp['statusname'] = @(string)$value0->StatusName;
		$data0_tmp['SubstatusCode'] = @(string)$value0->SubstatusCode;
		$data0_tmp['substatuscode'] = @(string)$value0->SubstatusCode;
		$data0_tmp['SubstatusName'] = @(string)$value0->SubstatusName;
		$data0_tmp['substatusname'] = @(string)$value0->SubstatusName;
		$data0_tmp['OperatorId'] = @(string)$value0->OperatorId;
		$data0_tmp['operatorid'] = @(string)$value0->OperatorId;
		$data0_tmp['OperatorName'] = @(string)$value0->OperatorName;
		$data0_tmp['operatorname'] = @(string)$value0->OperatorName;
		$data0_tmp['ItemsCount'] = @$value0->ItemsCount;
		$data0_tmp['itemscount'] = @$value0->ItemsCount;
		$data0_tmp['GoodsAmount'] = @$value0->GoodsAmount;
		$data0_tmp['goodsamount'] = @$value0->GoodsAmount;
		$data0_tmp['DeliveryAmount'] = @$value0->DeliveryAmount;
		$data0_tmp['deliveryamount'] = @$value0->DeliveryAmount;
		$data0_tmp['TotalAmount'] = @$value0->TotalAmount;
		$data0_tmp['totalamount'] = @$value0->TotalAmount;
		$data0_tmp['RemainAmount'] = @$value0->RemainAmount;
		$data0_tmp['remainamount'] = @$value0->RemainAmount;
		$data0_tmp['CurrencySign'] = @(string)$value0->CurrencySign;
		$data0_tmp['currencysign'] = @(string)$value0->CurrencySign;
		$data0_tmp['CurrencyCode'] = @(string)$value0->CurrencyCode;
		$data0_tmp['currencycode'] = @(string)$value0->CurrencyCode;
		$data0_tmp['GoodsAmountInternal'] = @$value0->GoodsAmountInternal;
		$data0_tmp['goodsamountinternal'] = @$value0->GoodsAmountInternal;
		$data0_tmp['DeliveryAmountInternal'] = @$value0->DeliveryAmountInternal;
		$data0_tmp['deliveryamountinternal'] = @$value0->DeliveryAmountInternal;
		$data0_tmp['TotalAmountInternal'] = @$value0->TotalAmountInternal;
		$data0_tmp['totalamountinternal'] = @$value0->TotalAmountInternal;
		$data0_tmp['RemainAmountInternal'] = @$value0->RemainAmountInternal;
		$data0_tmp['remainamountinternal'] = @$value0->RemainAmountInternal;
		$data0_tmp['CurrencySignInternal'] = @(string)$value0->CurrencySignInternal;
		$data0_tmp['currencysigninternal'] = @(string)$value0->CurrencySignInternal;
		$data0_tmp['CurrencyCodeInternal'] = @(string)$value0->CurrencyCodeInternal;
		$data0_tmp['currencycodeinternal'] = @(string)$value0->CurrencyCodeInternal;
		$data0_tmp['CustComment'] = @(string)$value0->CustComment;
		$data0_tmp['custcomment'] = @(string)$value0->CustComment;
		$data0_tmp['DeliveryModeId'] = @(string)$value0->DeliveryModeId;
		$data0_tmp['deliverymodeid'] = @(string)$value0->DeliveryModeId;
		$data0_tmp['DeliveryModeName'] = @(string)$value0->DeliveryModeName;
		$data0_tmp['deliverymodename'] = @(string)$value0->DeliveryModeName;
		$data0_tmp['CanCancel'] = @(int)$value0->CanCancel;
		$data0_tmp['cancancel'] = @(int)$value0->CanCancel;
		$data0_tmp['CanConfirmShipment'] = @(int)$value0->CanConfirmShipment;
		$data0_tmp['canconfirmshipment'] = @(int)$value0->CanConfirmShipment;
		$data0_tmp['CanChangeAddress'] = @(int)$value0->CanChangeAddress;
		$data0_tmp['canchangeaddress'] = @(int)$value0->CanChangeAddress;
		$data0_tmp['AdminInfoText'] = @(string)$value0->AdminInfoText;
		$data0_tmp['admininfotext'] = @(string)$value0->AdminInfoText;
		$data0_tmp['AdminAlertText'] = @(string)$value0->AdminAlertText;
		$data0_tmp['adminalerttext'] = @(string)$value0->AdminAlertText;
		$data0_tmp['PaidAmount'] = @$value0->PaidAmount;
		$data0_tmp['paidamount'] = @$value0->PaidAmount;
		$data0_tmp['PaidAmountInternal'] = @$value0->PaidAmountInternal;
		$data0_tmp['paidamountinternal'] = @$value0->PaidAmountInternal;
		$data0_tmp['CanRestore'] = @(int)$value0->CanRestore;
		$data0_tmp['canrestore'] = @(int)$value0->CanRestore;
		$data0_tmp['CanClose'] = @(int)$value0->CanClose;
		$data0_tmp['canclose'] = @(int)$value0->CanClose;
		$data0_tmp['CanCloseCancel'] = @(int)$value0->CanCloseCancel;
		$data0_tmp['canclosecancel'] = @(int)$value0->CanCloseCancel;
		$data0_tmp['CanAccept'] = @(int)$value0->CanAccept;
		$data0_tmp['canaccept'] = @(int)$value0->CanAccept;
		$data0_tmp['CanPurchaseItems'] = @(int)$value0->CanPurchaseItems;
		$data0_tmp['canpurchaseitems'] = @(int)$value0->CanPurchaseItems;
		$data0_tmp['PackagesWeight'] = @(int)$value0->PackagesWeight;
		$data0_tmp['packagesweight'] = @(int)$value0->PackagesWeight;
		$data0_tmp['EstimatedWeight'] = @(int)$value0->EstimatedWeight;
		$data0_tmp['estimatedweight'] = @(int)$value0->EstimatedWeight;
		$data0_tmp['CustId'] = @(string)$value0->CustId;
		$data0_tmp['custid'] = @(string)$value0->CustId;
		$data0_tmp['CustName'] = @(string)$value0->CustName;
		$data0_tmp['custname'] = @(string)$value0->CustName;
		$data0_tmp['StatusId'] = @(int)$value0->StatusId;
		$data0_tmp['statusid'] = @(int)$value0->StatusId;
		$data0_tmp['Weight'] = @$value0->Weight;
		$data0_tmp['weight'] = @$value0->Weight;
if(!isset($data0_tmp['DeliveryAddress'])){$data0_tmp['DeliveryAddress'] = array();}
		$data1_obj = @$value0->DeliveryAddress;
if(!isset($data0_tmp['DeliveryAddress']['Id'])){$data0_tmp['DeliveryAddress']['Id'] = array();}
			$data2_obj = @$value0->DeliveryAddress->Id;
			$data0_tmp['DeliveryAddress']['Id'] = @(string)$data2_obj;
		$data0_tmp['DeliveryAddress']['id'] = @$data0_tmp['DeliveryAddress']['Id'];
if(!isset($data0_tmp['DeliveryAddress']['Familyname'])){$data0_tmp['DeliveryAddress']['Familyname'] = array();}
			$data2_obj = @$value0->DeliveryAddress->Familyname;
			$data0_tmp['DeliveryAddress']['Familyname'] = @(string)$data2_obj;
		$data0_tmp['DeliveryAddress']['familyname'] = @$data0_tmp['DeliveryAddress']['Familyname'];
if(!isset($data0_tmp['DeliveryAddress']['Name'])){$data0_tmp['DeliveryAddress']['Name'] = array();}
			$data2_obj = @$value0->DeliveryAddress->Name;
			$data0_tmp['DeliveryAddress']['Name'] = @(string)$data2_obj;
		$data0_tmp['DeliveryAddress']['name'] = @$data0_tmp['DeliveryAddress']['Name'];
if(!isset($data0_tmp['DeliveryAddress']['Patername'])){$data0_tmp['DeliveryAddress']['Patername'] = array();}
			$data2_obj = @$value0->DeliveryAddress->Patername;
			$data0_tmp['DeliveryAddress']['Patername'] = @(string)$data2_obj;
		$data0_tmp['DeliveryAddress']['patername'] = @$data0_tmp['DeliveryAddress']['Patername'];
if(!isset($data0_tmp['DeliveryAddress']['CountryCode'])){$data0_tmp['DeliveryAddress']['CountryCode'] = array();}
			$data2_obj = @$value0->DeliveryAddress->CountryCode;
			$data0_tmp['DeliveryAddress']['CountryCode'] = @(string)$data2_obj;
		$data0_tmp['DeliveryAddress']['countrycode'] = @$data0_tmp['DeliveryAddress']['CountryCode'];
if(!isset($data0_tmp['DeliveryAddress']['Country'])){$data0_tmp['DeliveryAddress']['Country'] = array();}
			$data2_obj = @$value0->DeliveryAddress->Country;
			$data0_tmp['DeliveryAddress']['Country'] = @(string)$data2_obj;
		$data0_tmp['DeliveryAddress']['country'] = @$data0_tmp['DeliveryAddress']['Country'];
if(!isset($data0_tmp['DeliveryAddress']['City'])){$data0_tmp['DeliveryAddress']['City'] = array();}
			$data2_obj = @$value0->DeliveryAddress->City;
			$data0_tmp['DeliveryAddress']['City'] = @(string)$data2_obj;
		$data0_tmp['DeliveryAddress']['city'] = @$data0_tmp['DeliveryAddress']['City'];
if(!isset($data0_tmp['DeliveryAddress']['Address'])){$data0_tmp['DeliveryAddress']['Address'] = array();}
			$data2_obj = @$value0->DeliveryAddress->Address;
			$data0_tmp['DeliveryAddress']['Address'] = @(string)$data2_obj;
		$data0_tmp['DeliveryAddress']['address'] = @$data0_tmp['DeliveryAddress']['Address'];
if(!isset($data0_tmp['DeliveryAddress']['Phone'])){$data0_tmp['DeliveryAddress']['Phone'] = array();}
			$data2_obj = @$value0->DeliveryAddress->Phone;
			$data0_tmp['DeliveryAddress']['Phone'] = @(string)$data2_obj;
		$data0_tmp['DeliveryAddress']['phone'] = @$data0_tmp['DeliveryAddress']['Phone'];
if(!isset($data0_tmp['DeliveryAddress']['PostalCode'])){$data0_tmp['DeliveryAddress']['PostalCode'] = array();}
			$data2_obj = @$value0->DeliveryAddress->PostalCode;
			$data0_tmp['DeliveryAddress']['PostalCode'] = @(string)$data2_obj;
		$data0_tmp['DeliveryAddress']['postalcode'] = @$data0_tmp['DeliveryAddress']['PostalCode'];
if(!isset($data0_tmp['DeliveryAddress']['RegionName'])){$data0_tmp['DeliveryAddress']['RegionName'] = array();}
			$data2_obj = @$value0->DeliveryAddress->RegionName;
			$data0_tmp['DeliveryAddress']['RegionName'] = @(string)$data2_obj;
		$data0_tmp['DeliveryAddress']['regionname'] = @$data0_tmp['DeliveryAddress']['RegionName'];
		$data0_tmp['TaoBaoPrice'] = @$value0->TaoBaoPrice;
		$data0_tmp['taobaoprice'] = @$value0->TaoBaoPrice;
		$data0_tmp['InternalDeliveryOriginalInExternalCurrency'] = @$value0->InternalDeliveryOriginalInExternalCurrency;
		$data0_tmp['internaldeliveryoriginalinexternalcurrency'] = @$value0->InternalDeliveryOriginalInExternalCurrency;
		$data0_tmp['AdditionalInfo'] = @(string)$value0->AdditionalInfo;
		$data0_tmp['additionalinfo'] = @(string)$value0->AdditionalInfo;
		$data0_tmp['ExternalCurrencyCode'] = @(string)$value0->ExternalCurrencyCode;
		$data0_tmp['externalcurrencycode'] = @(string)$value0->ExternalCurrencyCode;
		$data0_tmp['ShipmentDate'] = @$value0->ShipmentDate;
		$data0_tmp['shipmentdate'] = @$value0->ShipmentDate;
		$data0_tmp['TotalAmountOriginalInExternalCurrency'] = @$value0->TotalAmountOriginalInExternalCurrency;
		$data0_tmp['totalamountoriginalinexternalcurrency'] = @$value0->TotalAmountOriginalInExternalCurrency;
if(!isset($data0_tmp['PackagePrices'])){$data0_tmp['PackagePrices'] = array();}

	if(!isset($value0->PackagePrices) || is_null($value0->PackagePrices) || !$value0->PackagePrices)		$data1_obj = @array();

	else
		$data1_obj = @$value0->PackagePrices->children();
		$data0_tmp['PackagePrices'] = @array();
		foreach($data1_obj as $value1){
			$data1_tmp = @array();
			$data1_tmp['Id'] = @(string)$value1->Id;
			$data1_tmp['id'] = @(string)$value1->Id;
			$data1_tmp['PriceInternal'] = @$value1->PriceInternal;
			$data1_tmp['priceinternal'] = @$value1->PriceInternal;
			$data1_tmp['AdditionalPriceInternal'] = @$value1->AdditionalPriceInternal;
			$data1_tmp['additionalpriceinternal'] = @$value1->AdditionalPriceInternal;
			$data1_tmp['AdditionalPrice'] = @$value1->AdditionalPrice;
			$data1_tmp['additionalprice'] = @$value1->AdditionalPrice;
			$data1_tmp['Price'] = @$value1->Price;
			$data1_tmp['price'] = @$value1->Price;
			$data1_tmp['PriceCurrencyCode'] = @(string)$value1->PriceCurrencyCode;
			$data1_tmp['pricecurrencycode'] = @(string)$value1->PriceCurrencyCode;
			$data1_tmp['PriceUpdateDate'] = @$value1->PriceUpdateDate;
			$data1_tmp['priceupdatedate'] = @$value1->PriceUpdateDate;
			$data0_tmp['PackagePrices'][] = @$data1_tmp;
		}
if(!isset($data0_tmp['LineStatusSummaries'])){$data0_tmp['LineStatusSummaries'] = array();}

	if(!isset($value0->LineStatusSummaries) || is_null($value0->LineStatusSummaries) || !$value0->LineStatusSummaries)		$data1_obj = @array();

	else
		$data1_obj = @$value0->LineStatusSummaries->children();
		$data0_tmp['LineStatusSummaries'] = @array();
		foreach($data1_obj as $value1){
			$data1_tmp = @array();
if(!isset($data1_tmp['Status'])){$data1_tmp['Status'] = array();}
			$data2_obj = @$value1->Status;
if(!isset($data1_tmp['Status']['Id'])){$data1_tmp['Status']['Id'] = array();}
				$data3_obj = @$value1->Status->Id;
				$data1_tmp['Status']['Id'] = @$data3_obj;
			$data1_tmp['Status']['id'] = @$data1_tmp['Status']['Id'];
if(!isset($data1_tmp['Status']['Name'])){$data1_tmp['Status']['Name'] = array();}
				$data3_obj = @$value1->Status->Name;
				$data1_tmp['Status']['Name'] = @(string)$data3_obj;
			$data1_tmp['Status']['name'] = @$data1_tmp['Status']['Name'];
			$data1_tmp['Count'] = @(int)$value1->Count;
			$data1_tmp['count'] = @(int)$value1->Count;
			$data0_tmp['LineStatusSummaries'][] = @$data1_tmp;
		}
		$data0_tmp['UserAccountAvailableAmount'] = @$value0->UserAccountAvailableAmount;
		$data0_tmp['useraccountavailableamount'] = @$value0->UserAccountAvailableAmount;
		$data0_tmp['CreatedDateTime'] = @(string)$value0->CreatedDateTime;
		$data0_tmp['createddatetime'] = @(string)$value0->CreatedDateTime;
		$data0_tmp['UserLogin'] = @(string)$value0->UserLogin;
		$data0_tmp['userlogin'] = @(string)$value0->UserLogin;
if(!isset($data0_tmp['TotalOriginalCostList'])){$data0_tmp['TotalOriginalCostList'] = array();}

	if(!isset($value0->TotalOriginalCostList) || is_null($value0->TotalOriginalCostList) || !$value0->TotalOriginalCostList)		$data1_obj = @array();

	else
		$data1_obj = @$value0->TotalOriginalCostList->children();
		$data0_tmp['TotalOriginalCostList'] = @array();
		foreach($data1_obj as $value1){
			$data1_tmp = @array();
			$data1_tmp['CurrencyCode'] = @(string)$value1->CurrencyCode;
			$data1_tmp['currencycode'] = @(string)$value1->CurrencyCode;
			$data1_tmp['TotalCost'] = @$value1->TotalCost;
			$data1_tmp['totalcost'] = @$value1->TotalCost;
			$data1_tmp['TotalCostInInternalCurrency'] = @$value1->TotalCostInInternalCurrency;
			$data1_tmp['totalcostininternalcurrency'] = @$value1->TotalCostInInternalCurrency;
			$data0_tmp['TotalOriginalCostList'][] = @$data1_tmp;
		}
if(!isset($data0_tmp['PackageTotalCostPerCurrencyList'])){$data0_tmp['PackageTotalCostPerCurrencyList'] = array();}

	if(!isset($value0->PackageTotalCostPerCurrencyList) || is_null($value0->PackageTotalCostPerCurrencyList) || !$value0->PackageTotalCostPerCurrencyList)		$data1_obj = @array();

	else
		$data1_obj = @$value0->PackageTotalCostPerCurrencyList->children();
		$data0_tmp['PackageTotalCostPerCurrencyList'] = @array();
		foreach($data1_obj as $value1){
			$data1_tmp = @array();
			$data1_tmp['CurrencyCode'] = @(string)$value1->CurrencyCode;
			$data1_tmp['currencycode'] = @(string)$value1->CurrencyCode;
			$data1_tmp['TotalPrice'] = @$value1->TotalPrice;
			$data1_tmp['totalprice'] = @$value1->TotalPrice;
			$data1_tmp['TotalAdditionalPrice'] = @$value1->TotalAdditionalPrice;
			$data1_tmp['totaladditionalprice'] = @$value1->TotalAdditionalPrice;
			$data0_tmp['PackageTotalCostPerCurrencyList'][] = @$data1_tmp;
		}
		$data0_tmp['InternalDeliveryOriginalInInternalCurrency'] = @$value0->InternalDeliveryOriginalInInternalCurrency;
		$data0_tmp['internaldeliveryoriginalininternalcurrency'] = @$value0->InternalDeliveryOriginalInInternalCurrency;
		$data0_tmp['InternalOriginalPrice'] = @$value0->InternalOriginalPrice;
		$data0_tmp['internaloriginalprice'] = @$value0->InternalOriginalPrice;
		$data0_tmp['Profit'] = @$value0->Profit;
		$data0_tmp['profit'] = @$value0->Profit;
if(!isset($data0_tmp['RateList'])){$data0_tmp['RateList'] = array();}

	if(!isset($value0->RateList) || is_null($value0->RateList) || !$value0->RateList)		$data1_obj = @array();

	else
		$data1_obj = @$value0->RateList->children();
		$data0_tmp['RateList'] = @array();
		foreach($data1_obj as $value1){
			$data0_tmp['RateList'][] = @$value1;
		}
		$data0[] = @$data0_tmp;
	}
	return $data0;
    }
    public function RecreateSalesOrder($sessionId, $salesOrderId, $weight){
        $params = array(
            'sessionId' => $sessionId,
	    'salesOrderId' => $salesOrderId,
	    'weight' => $weight
        );
        $params += $this->defaultLogin();
        $simplexml = $this->_getData('RecreateSalesOrder', $params);
        if (!$simplexml) return false;
        
        $data0 = array();
        
if(!isset($data0)){$data0 = array();}
	$data0_obj = @$simplexml->Result;
if(!isset($data0['Id'])){$data0['Id'] = array();}
		$data1_obj = @$simplexml->Result->Id;
		$data0['Id'] = @(string)$data1_obj;
	$data0['id'] = @$data0['Id'];
if(!isset($data0['StatusCode'])){$data0['StatusCode'] = array();}
		$data1_obj = @$simplexml->Result->StatusCode;
		$data0['StatusCode'] = @(string)$data1_obj;
	$data0['statuscode'] = @$data0['StatusCode'];
if(!isset($data0['StatusName'])){$data0['StatusName'] = array();}
		$data1_obj = @$simplexml->Result->StatusName;
		$data0['StatusName'] = @(string)$data1_obj;
	$data0['statusname'] = @$data0['StatusName'];
if(!isset($data0['SubstatusCode'])){$data0['SubstatusCode'] = array();}
		$data1_obj = @$simplexml->Result->SubstatusCode;
		$data0['SubstatusCode'] = @(string)$data1_obj;
	$data0['substatuscode'] = @$data0['SubstatusCode'];
if(!isset($data0['SubstatusName'])){$data0['SubstatusName'] = array();}
		$data1_obj = @$simplexml->Result->SubstatusName;
		$data0['SubstatusName'] = @(string)$data1_obj;
	$data0['substatusname'] = @$data0['SubstatusName'];
if(!isset($data0['OperatorId'])){$data0['OperatorId'] = array();}
		$data1_obj = @$simplexml->Result->OperatorId;
		$data0['OperatorId'] = @(string)$data1_obj;
	$data0['operatorid'] = @$data0['OperatorId'];
if(!isset($data0['OperatorName'])){$data0['OperatorName'] = array();}
		$data1_obj = @$simplexml->Result->OperatorName;
		$data0['OperatorName'] = @(string)$data1_obj;
	$data0['operatorname'] = @$data0['OperatorName'];
if(!isset($data0['ItemsCount'])){$data0['ItemsCount'] = array();}
		$data1_obj = @$simplexml->Result->ItemsCount;
		$data0['ItemsCount'] = @$data1_obj;
	$data0['itemscount'] = @$data0['ItemsCount'];
if(!isset($data0['GoodsAmount'])){$data0['GoodsAmount'] = array();}
		$data1_obj = @$simplexml->Result->GoodsAmount;
		$data0['GoodsAmount'] = @$data1_obj;
	$data0['goodsamount'] = @$data0['GoodsAmount'];
if(!isset($data0['DeliveryAmount'])){$data0['DeliveryAmount'] = array();}
		$data1_obj = @$simplexml->Result->DeliveryAmount;
		$data0['DeliveryAmount'] = @$data1_obj;
	$data0['deliveryamount'] = @$data0['DeliveryAmount'];
if(!isset($data0['TotalAmount'])){$data0['TotalAmount'] = array();}
		$data1_obj = @$simplexml->Result->TotalAmount;
		$data0['TotalAmount'] = @$data1_obj;
	$data0['totalamount'] = @$data0['TotalAmount'];
if(!isset($data0['RemainAmount'])){$data0['RemainAmount'] = array();}
		$data1_obj = @$simplexml->Result->RemainAmount;
		$data0['RemainAmount'] = @$data1_obj;
	$data0['remainamount'] = @$data0['RemainAmount'];
if(!isset($data0['CurrencySign'])){$data0['CurrencySign'] = array();}
		$data1_obj = @$simplexml->Result->CurrencySign;
		$data0['CurrencySign'] = @(string)$data1_obj;
	$data0['currencysign'] = @$data0['CurrencySign'];
if(!isset($data0['CurrencyCode'])){$data0['CurrencyCode'] = array();}
		$data1_obj = @$simplexml->Result->CurrencyCode;
		$data0['CurrencyCode'] = @(string)$data1_obj;
	$data0['currencycode'] = @$data0['CurrencyCode'];
if(!isset($data0['GoodsAmountInternal'])){$data0['GoodsAmountInternal'] = array();}
		$data1_obj = @$simplexml->Result->GoodsAmountInternal;
		$data0['GoodsAmountInternal'] = @$data1_obj;
	$data0['goodsamountinternal'] = @$data0['GoodsAmountInternal'];
if(!isset($data0['DeliveryAmountInternal'])){$data0['DeliveryAmountInternal'] = array();}
		$data1_obj = @$simplexml->Result->DeliveryAmountInternal;
		$data0['DeliveryAmountInternal'] = @$data1_obj;
	$data0['deliveryamountinternal'] = @$data0['DeliveryAmountInternal'];
if(!isset($data0['TotalAmountInternal'])){$data0['TotalAmountInternal'] = array();}
		$data1_obj = @$simplexml->Result->TotalAmountInternal;
		$data0['TotalAmountInternal'] = @$data1_obj;
	$data0['totalamountinternal'] = @$data0['TotalAmountInternal'];
if(!isset($data0['RemainAmountInternal'])){$data0['RemainAmountInternal'] = array();}
		$data1_obj = @$simplexml->Result->RemainAmountInternal;
		$data0['RemainAmountInternal'] = @$data1_obj;
	$data0['remainamountinternal'] = @$data0['RemainAmountInternal'];
if(!isset($data0['CurrencySignInternal'])){$data0['CurrencySignInternal'] = array();}
		$data1_obj = @$simplexml->Result->CurrencySignInternal;
		$data0['CurrencySignInternal'] = @(string)$data1_obj;
	$data0['currencysigninternal'] = @$data0['CurrencySignInternal'];
if(!isset($data0['CurrencyCodeInternal'])){$data0['CurrencyCodeInternal'] = array();}
		$data1_obj = @$simplexml->Result->CurrencyCodeInternal;
		$data0['CurrencyCodeInternal'] = @(string)$data1_obj;
	$data0['currencycodeinternal'] = @$data0['CurrencyCodeInternal'];
if(!isset($data0['CustComment'])){$data0['CustComment'] = array();}
		$data1_obj = @$simplexml->Result->CustComment;
		$data0['CustComment'] = @(string)$data1_obj;
	$data0['custcomment'] = @$data0['CustComment'];
if(!isset($data0['DeliveryModeId'])){$data0['DeliveryModeId'] = array();}
		$data1_obj = @$simplexml->Result->DeliveryModeId;
		$data0['DeliveryModeId'] = @(string)$data1_obj;
	$data0['deliverymodeid'] = @$data0['DeliveryModeId'];
if(!isset($data0['DeliveryModeName'])){$data0['DeliveryModeName'] = array();}
		$data1_obj = @$simplexml->Result->DeliveryModeName;
		$data0['DeliveryModeName'] = @(string)$data1_obj;
	$data0['deliverymodename'] = @$data0['DeliveryModeName'];
if(!isset($data0['CanCancel'])){$data0['CanCancel'] = array();}
		$data1_obj = @$simplexml->Result->CanCancel;
		$data0['CanCancel'] = @$data1_obj;
	$data0['cancancel'] = @$data0['CanCancel'];
if(!isset($data0['CanConfirmShipment'])){$data0['CanConfirmShipment'] = array();}
		$data1_obj = @$simplexml->Result->CanConfirmShipment;
		$data0['CanConfirmShipment'] = @$data1_obj;
	$data0['canconfirmshipment'] = @$data0['CanConfirmShipment'];
if(!isset($data0['CanChangeAddress'])){$data0['CanChangeAddress'] = array();}
		$data1_obj = @$simplexml->Result->CanChangeAddress;
		$data0['CanChangeAddress'] = @$data1_obj;
	$data0['canchangeaddress'] = @$data0['CanChangeAddress'];
if(!isset($data0['AdminInfoText'])){$data0['AdminInfoText'] = array();}
		$data1_obj = @$simplexml->Result->AdminInfoText;
		$data0['AdminInfoText'] = @(string)$data1_obj;
	$data0['admininfotext'] = @$data0['AdminInfoText'];
if(!isset($data0['AdminAlertText'])){$data0['AdminAlertText'] = array();}
		$data1_obj = @$simplexml->Result->AdminAlertText;
		$data0['AdminAlertText'] = @(string)$data1_obj;
	$data0['adminalerttext'] = @$data0['AdminAlertText'];
if(!isset($data0['PaidAmount'])){$data0['PaidAmount'] = array();}
		$data1_obj = @$simplexml->Result->PaidAmount;
		$data0['PaidAmount'] = @$data1_obj;
	$data0['paidamount'] = @$data0['PaidAmount'];
if(!isset($data0['PaidAmountInternal'])){$data0['PaidAmountInternal'] = array();}
		$data1_obj = @$simplexml->Result->PaidAmountInternal;
		$data0['PaidAmountInternal'] = @$data1_obj;
	$data0['paidamountinternal'] = @$data0['PaidAmountInternal'];
if(!isset($data0['CanRestore'])){$data0['CanRestore'] = array();}
		$data1_obj = @$simplexml->Result->CanRestore;
		$data0['CanRestore'] = @$data1_obj;
	$data0['canrestore'] = @$data0['CanRestore'];
if(!isset($data0['CanClose'])){$data0['CanClose'] = array();}
		$data1_obj = @$simplexml->Result->CanClose;
		$data0['CanClose'] = @$data1_obj;
	$data0['canclose'] = @$data0['CanClose'];
if(!isset($data0['CanCloseCancel'])){$data0['CanCloseCancel'] = array();}
		$data1_obj = @$simplexml->Result->CanCloseCancel;
		$data0['CanCloseCancel'] = @$data1_obj;
	$data0['canclosecancel'] = @$data0['CanCloseCancel'];
if(!isset($data0['CanAccept'])){$data0['CanAccept'] = array();}
		$data1_obj = @$simplexml->Result->CanAccept;
		$data0['CanAccept'] = @$data1_obj;
	$data0['canaccept'] = @$data0['CanAccept'];
if(!isset($data0['CanPurchaseItems'])){$data0['CanPurchaseItems'] = array();}
		$data1_obj = @$simplexml->Result->CanPurchaseItems;
		$data0['CanPurchaseItems'] = @$data1_obj;
	$data0['canpurchaseitems'] = @$data0['CanPurchaseItems'];
if(!isset($data0['PackagesWeight'])){$data0['PackagesWeight'] = array();}
		$data1_obj = @$simplexml->Result->PackagesWeight;
		$data0['PackagesWeight'] = @$data1_obj;
	$data0['packagesweight'] = @$data0['PackagesWeight'];
if(!isset($data0['EstimatedWeight'])){$data0['EstimatedWeight'] = array();}
		$data1_obj = @$simplexml->Result->EstimatedWeight;
		$data0['EstimatedWeight'] = @$data1_obj;
	$data0['estimatedweight'] = @$data0['EstimatedWeight'];
if(!isset($data0['CustId'])){$data0['CustId'] = array();}
		$data1_obj = @$simplexml->Result->CustId;
		$data0['CustId'] = @(string)$data1_obj;
	$data0['custid'] = @$data0['CustId'];
if(!isset($data0['CustName'])){$data0['CustName'] = array();}
		$data1_obj = @$simplexml->Result->CustName;
		$data0['CustName'] = @(string)$data1_obj;
	$data0['custname'] = @$data0['CustName'];
if(!isset($data0['StatusId'])){$data0['StatusId'] = array();}
		$data1_obj = @$simplexml->Result->StatusId;
		$data0['StatusId'] = @$data1_obj;
	$data0['statusid'] = @$data0['StatusId'];
if(!isset($data0['Weight'])){$data0['Weight'] = array();}
		$data1_obj = @$simplexml->Result->Weight;
		$data0['Weight'] = @$data1_obj;
	$data0['weight'] = @$data0['Weight'];
if(!isset($data0['DeliveryAddress'])){$data0['DeliveryAddress'] = array();}
		$data1_obj = @$simplexml->Result->DeliveryAddress;
if(!isset($data0['DeliveryAddress']['Id'])){$data0['DeliveryAddress']['Id'] = array();}
			$data2_obj = @$simplexml->Result->DeliveryAddress->Id;
			$data0['DeliveryAddress']['Id'] = @(string)$data2_obj;
		$data0['DeliveryAddress']['id'] = @$data0['DeliveryAddress']['Id'];
if(!isset($data0['DeliveryAddress']['Familyname'])){$data0['DeliveryAddress']['Familyname'] = array();}
			$data2_obj = @$simplexml->Result->DeliveryAddress->Familyname;
			$data0['DeliveryAddress']['Familyname'] = @(string)$data2_obj;
		$data0['DeliveryAddress']['familyname'] = @$data0['DeliveryAddress']['Familyname'];
if(!isset($data0['DeliveryAddress']['Name'])){$data0['DeliveryAddress']['Name'] = array();}
			$data2_obj = @$simplexml->Result->DeliveryAddress->Name;
			$data0['DeliveryAddress']['Name'] = @(string)$data2_obj;
		$data0['DeliveryAddress']['name'] = @$data0['DeliveryAddress']['Name'];
if(!isset($data0['DeliveryAddress']['Patername'])){$data0['DeliveryAddress']['Patername'] = array();}
			$data2_obj = @$simplexml->Result->DeliveryAddress->Patername;
			$data0['DeliveryAddress']['Patername'] = @(string)$data2_obj;
		$data0['DeliveryAddress']['patername'] = @$data0['DeliveryAddress']['Patername'];
if(!isset($data0['DeliveryAddress']['CountryCode'])){$data0['DeliveryAddress']['CountryCode'] = array();}
			$data2_obj = @$simplexml->Result->DeliveryAddress->CountryCode;
			$data0['DeliveryAddress']['CountryCode'] = @(string)$data2_obj;
		$data0['DeliveryAddress']['countrycode'] = @$data0['DeliveryAddress']['CountryCode'];
if(!isset($data0['DeliveryAddress']['Country'])){$data0['DeliveryAddress']['Country'] = array();}
			$data2_obj = @$simplexml->Result->DeliveryAddress->Country;
			$data0['DeliveryAddress']['Country'] = @(string)$data2_obj;
		$data0['DeliveryAddress']['country'] = @$data0['DeliveryAddress']['Country'];
if(!isset($data0['DeliveryAddress']['City'])){$data0['DeliveryAddress']['City'] = array();}
			$data2_obj = @$simplexml->Result->DeliveryAddress->City;
			$data0['DeliveryAddress']['City'] = @(string)$data2_obj;
		$data0['DeliveryAddress']['city'] = @$data0['DeliveryAddress']['City'];
if(!isset($data0['DeliveryAddress']['Address'])){$data0['DeliveryAddress']['Address'] = array();}
			$data2_obj = @$simplexml->Result->DeliveryAddress->Address;
			$data0['DeliveryAddress']['Address'] = @(string)$data2_obj;
		$data0['DeliveryAddress']['address'] = @$data0['DeliveryAddress']['Address'];
if(!isset($data0['DeliveryAddress']['Phone'])){$data0['DeliveryAddress']['Phone'] = array();}
			$data2_obj = @$simplexml->Result->DeliveryAddress->Phone;
			$data0['DeliveryAddress']['Phone'] = @(string)$data2_obj;
		$data0['DeliveryAddress']['phone'] = @$data0['DeliveryAddress']['Phone'];
if(!isset($data0['DeliveryAddress']['PostalCode'])){$data0['DeliveryAddress']['PostalCode'] = array();}
			$data2_obj = @$simplexml->Result->DeliveryAddress->PostalCode;
			$data0['DeliveryAddress']['PostalCode'] = @(string)$data2_obj;
		$data0['DeliveryAddress']['postalcode'] = @$data0['DeliveryAddress']['PostalCode'];
if(!isset($data0['DeliveryAddress']['RegionName'])){$data0['DeliveryAddress']['RegionName'] = array();}
			$data2_obj = @$simplexml->Result->DeliveryAddress->RegionName;
			$data0['DeliveryAddress']['RegionName'] = @(string)$data2_obj;
		$data0['DeliveryAddress']['regionname'] = @$data0['DeliveryAddress']['RegionName'];
	$data0['deliveryaddress'] = @$data0['DeliveryAddress'];
if(!isset($data0['TaoBaoPrice'])){$data0['TaoBaoPrice'] = array();}
		$data1_obj = @$simplexml->Result->TaoBaoPrice;
		$data0['TaoBaoPrice'] = @$data1_obj;
	$data0['taobaoprice'] = @$data0['TaoBaoPrice'];
if(!isset($data0['InternalDeliveryOriginalInExternalCurrency'])){$data0['InternalDeliveryOriginalInExternalCurrency'] = array();}
		$data1_obj = @$simplexml->Result->InternalDeliveryOriginalInExternalCurrency;
		$data0['InternalDeliveryOriginalInExternalCurrency'] = @$data1_obj;
	$data0['internaldeliveryoriginalinexternalcurrency'] = @$data0['InternalDeliveryOriginalInExternalCurrency'];
if(!isset($data0['AdditionalInfo'])){$data0['AdditionalInfo'] = array();}
		$data1_obj = @$simplexml->Result->AdditionalInfo;
		$data0['AdditionalInfo'] = @(string)$data1_obj;
	$data0['additionalinfo'] = @$data0['AdditionalInfo'];
if(!isset($data0['ExternalCurrencyCode'])){$data0['ExternalCurrencyCode'] = array();}
		$data1_obj = @$simplexml->Result->ExternalCurrencyCode;
		$data0['ExternalCurrencyCode'] = @(string)$data1_obj;
	$data0['externalcurrencycode'] = @$data0['ExternalCurrencyCode'];
if(!isset($data0['ShipmentDate'])){$data0['ShipmentDate'] = array();}
		$data1_obj = @$simplexml->Result->ShipmentDate;
		$data0['ShipmentDate'] = @$data1_obj;
	$data0['shipmentdate'] = @$data0['ShipmentDate'];
if(!isset($data0['TotalAmountOriginalInExternalCurrency'])){$data0['TotalAmountOriginalInExternalCurrency'] = array();}
		$data1_obj = @$simplexml->Result->TotalAmountOriginalInExternalCurrency;
		$data0['TotalAmountOriginalInExternalCurrency'] = @$data1_obj;
	$data0['totalamountoriginalinexternalcurrency'] = @$data0['TotalAmountOriginalInExternalCurrency'];
if(!isset($data0['PackagePrices'])){$data0['PackagePrices'] = array();}

	if(!isset($simplexml->Result->PackagePrices) || is_null($simplexml->Result->PackagePrices) || !$simplexml->Result->PackagePrices)		$data1_obj = @array();

	else
		$data1_obj = @$simplexml->Result->PackagePrices->children();
		$data0['PackagePrices'] = @array();
		foreach($data1_obj as $value1){
			$data1_tmp = @array();
			$data1_tmp['Id'] = @(string)$value1->Id;
			$data1_tmp['id'] = @(string)$value1->Id;
			$data1_tmp['PriceInternal'] = @$value1->PriceInternal;
			$data1_tmp['priceinternal'] = @$value1->PriceInternal;
			$data1_tmp['AdditionalPriceInternal'] = @$value1->AdditionalPriceInternal;
			$data1_tmp['additionalpriceinternal'] = @$value1->AdditionalPriceInternal;
			$data1_tmp['AdditionalPrice'] = @$value1->AdditionalPrice;
			$data1_tmp['additionalprice'] = @$value1->AdditionalPrice;
			$data1_tmp['Price'] = @$value1->Price;
			$data1_tmp['price'] = @$value1->Price;
			$data1_tmp['PriceCurrencyCode'] = @(string)$value1->PriceCurrencyCode;
			$data1_tmp['pricecurrencycode'] = @(string)$value1->PriceCurrencyCode;
			$data1_tmp['PriceUpdateDate'] = @$value1->PriceUpdateDate;
			$data1_tmp['priceupdatedate'] = @$value1->PriceUpdateDate;
			$data0['PackagePrices'][] = @$data1_tmp;
		}
	$data0['packageprices'] = @$data0['PackagePrices'];
if(!isset($data0['LineStatusSummaries'])){$data0['LineStatusSummaries'] = array();}

	if(!isset($simplexml->Result->LineStatusSummaries) || is_null($simplexml->Result->LineStatusSummaries) || !$simplexml->Result->LineStatusSummaries)		$data1_obj = @array();

	else
		$data1_obj = @$simplexml->Result->LineStatusSummaries->children();
		$data0['LineStatusSummaries'] = @array();
		foreach($data1_obj as $value1){
			$data1_tmp = @array();
if(!isset($data1_tmp['Status'])){$data1_tmp['Status'] = array();}
			$data2_obj = @$value1->Status;
if(!isset($data1_tmp['Status']['Id'])){$data1_tmp['Status']['Id'] = array();}
				$data3_obj = @$value1->Status->Id;
				$data1_tmp['Status']['Id'] = @$data3_obj;
			$data1_tmp['Status']['id'] = @$data1_tmp['Status']['Id'];
if(!isset($data1_tmp['Status']['Name'])){$data1_tmp['Status']['Name'] = array();}
				$data3_obj = @$value1->Status->Name;
				$data1_tmp['Status']['Name'] = @(string)$data3_obj;
			$data1_tmp['Status']['name'] = @$data1_tmp['Status']['Name'];
			$data1_tmp['Count'] = @(int)$value1->Count;
			$data1_tmp['count'] = @(int)$value1->Count;
			$data0['LineStatusSummaries'][] = @$data1_tmp;
		}
	$data0['linestatussummaries'] = @$data0['LineStatusSummaries'];
if(!isset($data0['UserAccountAvailableAmount'])){$data0['UserAccountAvailableAmount'] = array();}
		$data1_obj = @$simplexml->Result->UserAccountAvailableAmount;
		$data0['UserAccountAvailableAmount'] = @$data1_obj;
	$data0['useraccountavailableamount'] = @$data0['UserAccountAvailableAmount'];
if(!isset($data0['CreatedDateTime'])){$data0['CreatedDateTime'] = array();}
		$data1_obj = @$simplexml->Result->CreatedDateTime;
		$data0['CreatedDateTime'] = @(string)$data1_obj;
	$data0['createddatetime'] = @$data0['CreatedDateTime'];
if(!isset($data0['UserLogin'])){$data0['UserLogin'] = array();}
		$data1_obj = @$simplexml->Result->UserLogin;
		$data0['UserLogin'] = @(string)$data1_obj;
	$data0['userlogin'] = @$data0['UserLogin'];
if(!isset($data0['TotalOriginalCostList'])){$data0['TotalOriginalCostList'] = array();}

	if(!isset($simplexml->Result->TotalOriginalCostList) || is_null($simplexml->Result->TotalOriginalCostList) || !$simplexml->Result->TotalOriginalCostList)		$data1_obj = @array();

	else
		$data1_obj = @$simplexml->Result->TotalOriginalCostList->children();
		$data0['TotalOriginalCostList'] = @array();
		foreach($data1_obj as $value1){
			$data1_tmp = @array();
			$data1_tmp['CurrencyCode'] = @(string)$value1->CurrencyCode;
			$data1_tmp['currencycode'] = @(string)$value1->CurrencyCode;
			$data1_tmp['TotalCost'] = @$value1->TotalCost;
			$data1_tmp['totalcost'] = @$value1->TotalCost;
			$data1_tmp['TotalCostInInternalCurrency'] = @$value1->TotalCostInInternalCurrency;
			$data1_tmp['totalcostininternalcurrency'] = @$value1->TotalCostInInternalCurrency;
			$data0['TotalOriginalCostList'][] = @$data1_tmp;
		}
	$data0['totaloriginalcostlist'] = @$data0['TotalOriginalCostList'];
if(!isset($data0['PackageTotalCostPerCurrencyList'])){$data0['PackageTotalCostPerCurrencyList'] = array();}

	if(!isset($simplexml->Result->PackageTotalCostPerCurrencyList) || is_null($simplexml->Result->PackageTotalCostPerCurrencyList) || !$simplexml->Result->PackageTotalCostPerCurrencyList)		$data1_obj = @array();

	else
		$data1_obj = @$simplexml->Result->PackageTotalCostPerCurrencyList->children();
		$data0['PackageTotalCostPerCurrencyList'] = @array();
		foreach($data1_obj as $value1){
			$data1_tmp = @array();
			$data1_tmp['CurrencyCode'] = @(string)$value1->CurrencyCode;
			$data1_tmp['currencycode'] = @(string)$value1->CurrencyCode;
			$data1_tmp['TotalPrice'] = @$value1->TotalPrice;
			$data1_tmp['totalprice'] = @$value1->TotalPrice;
			$data1_tmp['TotalAdditionalPrice'] = @$value1->TotalAdditionalPrice;
			$data1_tmp['totaladditionalprice'] = @$value1->TotalAdditionalPrice;
			$data0['PackageTotalCostPerCurrencyList'][] = @$data1_tmp;
		}
	$data0['packagetotalcostpercurrencylist'] = @$data0['PackageTotalCostPerCurrencyList'];
if(!isset($data0['InternalDeliveryOriginalInInternalCurrency'])){$data0['InternalDeliveryOriginalInInternalCurrency'] = array();}
		$data1_obj = @$simplexml->Result->InternalDeliveryOriginalInInternalCurrency;
		$data0['InternalDeliveryOriginalInInternalCurrency'] = @$data1_obj;
	$data0['internaldeliveryoriginalininternalcurrency'] = @$data0['InternalDeliveryOriginalInInternalCurrency'];
if(!isset($data0['InternalOriginalPrice'])){$data0['InternalOriginalPrice'] = array();}
		$data1_obj = @$simplexml->Result->InternalOriginalPrice;
		$data0['InternalOriginalPrice'] = @$data1_obj;
	$data0['internaloriginalprice'] = @$data0['InternalOriginalPrice'];
if(!isset($data0['Profit'])){$data0['Profit'] = array();}
		$data1_obj = @$simplexml->Result->Profit;
		$data0['Profit'] = @$data1_obj;
	$data0['profit'] = @$data0['Profit'];
if(!isset($data0['RateList'])){$data0['RateList'] = array();}

	if(!isset($simplexml->Result->RateList) || is_null($simplexml->Result->RateList) || !$simplexml->Result->RateList)		$data1_obj = @array();

	else
		$data1_obj = @$simplexml->Result->RateList->children();
		$data0['RateList'] = @array();
		foreach($data1_obj as $value1){
			$data0['RateList'][] = @$value1;
		}
	$data0['ratelist'] = @$data0['RateList'];
	return $data0;
    }
    public function CancelSalesOrder($sessionId, $salesId){
        $params = array(
            'sessionId' => $sessionId,
	    'salesId' => $salesId
        );
        $params += $this->defaultLogin();
        $simplexml = $this->_getData('CancelSalesOrder', $params);
        if (!$simplexml) return false;
        
        $data0 = array();
        
if(!isset($data0)){$data0 = array();}
	$data0_obj = @$simplexml;
	$data0 = @$data0_obj;
	return $data0;
    }
    public function ConfirmShipmentSalesOrder($sessionId, $salesId){
        $params = array(
            'sessionId' => $sessionId,
	    'salesId' => $salesId
        );
        $params += $this->defaultLogin();
        $simplexml = $this->_getData('ConfirmShipmentSalesOrder', $params);
        if (!$simplexml) return false;
        
        $data0 = array();
        
if(!isset($data0)){$data0 = array();}
	$data0_obj = @$simplexml;
	$data0 = @$data0_obj;
	return $data0;
    }
    public function ConfirmPriceLineSalesOrder($sessionId, $salesId, $salesLineId){
        $params = array(
            'sessionId' => $sessionId,
	    'salesId' => $salesId,
	    'salesLineId' => $salesLineId
        );
        $params += $this->defaultLogin();
        $simplexml = $this->_getData('ConfirmPriceLineSalesOrder', $params);
        if (!$simplexml) return false;
        
        $data0 = array();
        
if(!isset($data0)){$data0 = array();}
	$data0_obj = @$simplexml;
	$data0 = @$data0_obj;
	return $data0;
    }
    public function DiscardPriceLineSalesOrder($sessionId, $salesId, $salesLineId){
        $params = array(
            'sessionId' => $sessionId,
	    'salesId' => $salesId,
	    'salesLineId' => $salesLineId
        );
        $params += $this->defaultLogin();
        $simplexml = $this->_getData('DiscardPriceLineSalesOrder', $params);
        if (!$simplexml) return false;
        
        $data0 = array();
        
if(!isset($data0)){$data0 = array();}
	$data0_obj = @$simplexml;
	$data0 = @$data0_obj;
	return $data0;
    }
    public function CancelLineSalesOrder($sessionId, $salesId, $salesLineId){
        $params = array(
            'sessionId' => $sessionId,
	    'salesId' => $salesId,
	    'salesLineId' => $salesLineId
        );
        $params += $this->defaultLogin();
        $simplexml = $this->_getData('CancelLineSalesOrder', $params);
        if (!$simplexml) return false;
        
        $data0 = array();
        
if(!isset($data0)){$data0 = array();}
	$data0_obj = @$simplexml;
	$data0 = @$data0_obj;
	return $data0;
    }
    public function GetSalesOrderShippings($sessionId, $salesId){
        $params = array(
            'sessionId' => $sessionId,
	    'salesId' => $salesId
        );
        $params += $this->defaultLogin();
        $simplexml = $this->_getData('GetSalesOrderShippings', $params);
        if (!$simplexml) return false;
        
        $data0 = array();
        
if(!isset($data0)){$data0 = array();}

	if(!isset($simplexml->Result) || is_null($simplexml->Result) || !$simplexml->Result)	$data0_obj = @array();

	else
	$data0_obj = @$simplexml->Result->children();
	$data0 = @array();
	foreach($data0_obj as $value0){
		$data0_tmp = @array();
		$data0_tmp['Id'] = @(string)$value0->Id;
		$data0_tmp['id'] = @(string)$value0->Id;
		$data0_tmp['StatusCode'] = @(string)$value0->StatusCode;
		$data0_tmp['statuscode'] = @(string)$value0->StatusCode;
		$data0_tmp['StatusName'] = @(string)$value0->StatusName;
		$data0_tmp['statusname'] = @(string)$value0->StatusName;
		$data0_tmp['MailTrackingNum'] = @(string)$value0->MailTrackingNum;
		$data0_tmp['mailtrackingnum'] = @(string)$value0->MailTrackingNum;
		$data0_tmp['Weight'] = @$value0->Weight;
		$data0_tmp['weight'] = @$value0->Weight;
		$data0_tmp['Price'] = @$value0->Price;
		$data0_tmp['price'] = @$value0->Price;
		$data0_tmp['CurrencyCode'] = @(string)$value0->CurrencyCode;
		$data0_tmp['currencycode'] = @(string)$value0->CurrencyCode;
		$data0_tmp['CurrencySign'] = @(string)$value0->CurrencySign;
		$data0_tmp['currencysign'] = @(string)$value0->CurrencySign;
		$data0_tmp['DeliveryModeName'] = @(string)$value0->DeliveryModeName;
		$data0_tmp['deliverymodename'] = @(string)$value0->DeliveryModeName;
		$data0_tmp['DeliveryAddress'] = @(string)$value0->DeliveryAddress;
		$data0_tmp['deliveryaddress'] = @(string)$value0->DeliveryAddress;
		$data0_tmp['DeliveryContactName'] = @(string)$value0->DeliveryContactName;
		$data0_tmp['deliverycontactname'] = @(string)$value0->DeliveryContactName;
		$data0_tmp['DeliveryContactPhone'] = @(string)$value0->DeliveryContactPhone;
		$data0_tmp['deliverycontactphone'] = @(string)$value0->DeliveryContactPhone;
		$data0_tmp['CreationDate'] = @$value0->CreationDate;
		$data0_tmp['creationdate'] = @$value0->CreationDate;
		$data0[] = @$data0_tmp;
	}
	return $data0;
    }
    public function GetCustomerSalesProcessLog($sessionId, $salesId){
        $params = array(
            'sessionId' => $sessionId,
	    'salesId' => $salesId
        );
        $params += $this->defaultLogin();
        $simplexml = $this->_getData('GetCustomerSalesProcessLog', $params);
        if (!$simplexml) return false;
        
        $data0 = array();
        
if(!isset($data0)){$data0 = array();}

	if(!isset($simplexml->Result) || is_null($simplexml->Result) || !$simplexml->Result)	$data0_obj = @array();

	else
	$data0_obj = @$simplexml->Result->children();
	$data0 = @array();
	foreach($data0_obj as $value0){
		$data0_tmp = @array();
		$data0_tmp['LogDate'] = @(string)$value0->LogDate;
		$data0_tmp['logdate'] = @(string)$value0->LogDate;
		$data0_tmp['LogTime'] = @(string)$value0->LogTime;
		$data0_tmp['logtime'] = @(string)$value0->LogTime;
		$data0_tmp['OperatorId'] = @(string)$value0->OperatorId;
		$data0_tmp['operatorid'] = @(string)$value0->OperatorId;
		$data0_tmp['CustId'] = @(string)$value0->CustId;
		$data0_tmp['custid'] = @(string)$value0->CustId;
		$data0_tmp['OperatorName'] = @(string)$value0->OperatorName;
		$data0_tmp['operatorname'] = @(string)$value0->OperatorName;
		$data0_tmp['CustName'] = @(string)$value0->CustName;
		$data0_tmp['custname'] = @(string)$value0->CustName;
		$data0_tmp['FieldName'] = @(string)$value0->FieldName;
		$data0_tmp['fieldname'] = @(string)$value0->FieldName;
		$data0_tmp['PrevValue'] = @(string)$value0->PrevValue;
		$data0_tmp['prevvalue'] = @(string)$value0->PrevValue;
		$data0_tmp['NewValue'] = @(string)$value0->NewValue;
		$data0_tmp['newvalue'] = @(string)$value0->NewValue;
		$data0[] = @$data0_tmp;
	}
	return $data0;
    }
    public function UpdateOrderLine($sessionId, $orderId, $orderLineId, $xmlUpdateData){
        $params = array(
            'sessionId' => $sessionId,
	    'orderId' => $orderId,
	    'orderLineId' => $orderLineId,
	    'xmlUpdateData' => $xmlUpdateData
        );
        $params += $this->defaultLogin();
        $simplexml = $this->_getData('UpdateOrderLine', $params);
        if (!$simplexml) return false;
        
        $data0 = array();
        
if(!isset($data0)){$data0 = array();}
	$data0_obj = @$simplexml;
	$data0 = @$data0_obj;
	return $data0;
    }
    public function ChangeSalesOrderLinePurchaseInfo($sessionId, $salesId, $salesLineId, $vendPurchId, $vendPurchWaybill){
        $params = array(
            'sessionId' => $sessionId,
	    'salesId' => $salesId,
	    'salesLineId' => $salesLineId,
	    'vendPurchId' => $vendPurchId,
	    'vendPurchWaybill' => $vendPurchWaybill
        );
        $params += $this->defaultLogin();
        $simplexml = $this->_getData('ChangeSalesOrderLinePurchaseInfo', $params);
        if (!$simplexml) return false;
        
        $data0 = array();
        
if(!isset($data0)){$data0 = array();}
	$data0_obj = @$simplexml;
	$data0 = @$data0_obj;
	return $data0;
    }
    public function UpdateOrder($sessionId, $orderId, $xmlUpdateData){
        $params = array(
            'sessionId' => $sessionId,
	    'orderId' => $orderId,
	    'xmlUpdateData' => $xmlUpdateData
        );
        $params += $this->defaultLogin();
        $simplexml = $this->_getData('UpdateOrder', $params);
        if (!$simplexml) return false;
        
        $data0 = array();
        
if(!isset($data0)){$data0 = array();}
	$data0_obj = @$simplexml;
	$data0 = @$data0_obj;
	return $data0;
    }
    public function CloseOrder($sessionId, $orderId){
        $params = array(
            'sessionId' => $sessionId,
	    'orderId' => $orderId
        );
        $params += $this->defaultLogin();
        $simplexml = $this->_getData('CloseOrder', $params);
        if (!$simplexml) return false;
        
        $data0 = array();
        
if(!isset($data0)){$data0 = array();}
	$data0_obj = @$simplexml;
	$data0 = @$data0_obj;
	return $data0;
    }
    public function GetOrdersHistory($sessionId){
        $params = array(
            'sessionId' => $sessionId
        );
        $params += $this->defaultLogin();
        $simplexml = $this->_getData('GetOrdersHistory', $params);
        if (!$simplexml) return false;
        
        $data0 = array();
        
if(!isset($data0)){$data0 = array();}

	if(!isset($simplexml->Result->Items) || is_null($simplexml->Result->Items) || !$simplexml->Result->Items)	$data0_obj = @array();

	else
	$data0_obj = @$simplexml->Result->Items->children();
	$data0 = @array();
	foreach($data0_obj as $value0){
		$data0_tmp = @array();
		$data0_tmp['Id'] = @(int)$value0->Id;
		$data0_tmp['id'] = @(int)$value0->Id;
		$data0_tmp['OrderId'] = @(int)$value0->OrderId;
		$data0_tmp['orderid'] = @(int)$value0->OrderId;
		$data0_tmp['OrderLineId'] = @(int)$value0->OrderLineId;
		$data0_tmp['orderlineid'] = @(int)$value0->OrderLineId;
if(!isset($data0_tmp['OldStatus'])){$data0_tmp['OldStatus'] = array();}
		$data1_obj = @$value0->OldStatus;
if(!isset($data0_tmp['OldStatus']['Id'])){$data0_tmp['OldStatus']['Id'] = array();}
			$data2_obj = @$value0->OldStatus->Id;
			$data0_tmp['OldStatus']['Id'] = @$data2_obj;
		$data0_tmp['OldStatus']['id'] = @$data0_tmp['OldStatus']['Id'];
if(!isset($data0_tmp['OldStatus']['Name'])){$data0_tmp['OldStatus']['Name'] = array();}
			$data2_obj = @$value0->OldStatus->Name;
			$data0_tmp['OldStatus']['Name'] = @(string)$data2_obj;
		$data0_tmp['OldStatus']['name'] = @$data0_tmp['OldStatus']['Name'];
if(!isset($data0_tmp['NewStatus'])){$data0_tmp['NewStatus'] = array();}
		$data1_obj = @$value0->NewStatus;
if(!isset($data0_tmp['NewStatus']['Id'])){$data0_tmp['NewStatus']['Id'] = array();}
			$data2_obj = @$value0->NewStatus->Id;
			$data0_tmp['NewStatus']['Id'] = @$data2_obj;
		$data0_tmp['NewStatus']['id'] = @$data0_tmp['NewStatus']['Id'];
if(!isset($data0_tmp['NewStatus']['Name'])){$data0_tmp['NewStatus']['Name'] = array();}
			$data2_obj = @$value0->NewStatus->Name;
			$data0_tmp['NewStatus']['Name'] = @(string)$data2_obj;
		$data0_tmp['NewStatus']['name'] = @$data0_tmp['NewStatus']['Name'];
		$data0_tmp['Date'] = @$value0->Date;
		$data0_tmp['date'] = @$value0->Date;
if(!isset($data0_tmp['UserInfo'])){$data0_tmp['UserInfo'] = array();}
		$data1_obj = @$value0->UserInfo;
if(!isset($data0_tmp['UserInfo']['Id'])){$data0_tmp['UserInfo']['Id'] = array();}
			$data2_obj = @$value0->UserInfo->Id;
			$data0_tmp['UserInfo']['Id'] = @$data2_obj;
		$data0_tmp['UserInfo']['id'] = @$data0_tmp['UserInfo']['Id'];
if(!isset($data0_tmp['UserInfo']['Login'])){$data0_tmp['UserInfo']['Login'] = array();}
			$data2_obj = @$value0->UserInfo->Login;
			$data0_tmp['UserInfo']['Login'] = @(string)$data2_obj;
		$data0_tmp['UserInfo']['login'] = @$data0_tmp['UserInfo']['Login'];
if(!isset($data0_tmp['UserInfo']['Email'])){$data0_tmp['UserInfo']['Email'] = array();}
			$data2_obj = @$value0->UserInfo->Email;
			$data0_tmp['UserInfo']['Email'] = @(string)$data2_obj;
		$data0_tmp['UserInfo']['email'] = @$data0_tmp['UserInfo']['Email'];
if(!isset($data0_tmp['UserInfo']['IsActive'])){$data0_tmp['UserInfo']['IsActive'] = array();}
			$data2_obj = @$value0->UserInfo->IsActive;
			$data0_tmp['UserInfo']['IsActive'] = @$data2_obj;
		$data0_tmp['UserInfo']['isactive'] = @$data0_tmp['UserInfo']['IsActive'];
if(!isset($data0_tmp['UserInfo']['FirstName'])){$data0_tmp['UserInfo']['FirstName'] = array();}
			$data2_obj = @$value0->UserInfo->FirstName;
			$data0_tmp['UserInfo']['FirstName'] = @(string)$data2_obj;
		$data0_tmp['UserInfo']['firstname'] = @$data0_tmp['UserInfo']['FirstName'];
if(!isset($data0_tmp['UserInfo']['LastName'])){$data0_tmp['UserInfo']['LastName'] = array();}
			$data2_obj = @$value0->UserInfo->LastName;
			$data0_tmp['UserInfo']['LastName'] = @(string)$data2_obj;
		$data0_tmp['UserInfo']['lastname'] = @$data0_tmp['UserInfo']['LastName'];
if(!isset($data0_tmp['UserInfo']['MiddleName'])){$data0_tmp['UserInfo']['MiddleName'] = array();}
			$data2_obj = @$value0->UserInfo->MiddleName;
			$data0_tmp['UserInfo']['MiddleName'] = @(string)$data2_obj;
		$data0_tmp['UserInfo']['middlename'] = @$data0_tmp['UserInfo']['MiddleName'];
if(!isset($data0_tmp['UserInfo']['PersonalAccountId'])){$data0_tmp['UserInfo']['PersonalAccountId'] = array();}
			$data2_obj = @$value0->UserInfo->PersonalAccountId;
			$data0_tmp['UserInfo']['PersonalAccountId'] = @(string)$data2_obj;
		$data0_tmp['UserInfo']['personalaccountid'] = @$data0_tmp['UserInfo']['PersonalAccountId'];
		$data0[] = @$data0_tmp;
	}
	return $data0;
    }
    public function ClearOrdersHistory($sessionId, $ordersHistoryItemIds){
        $params = array(
            'sessionId' => $sessionId,
	    'ordersHistoryItemIds' => $ordersHistoryItemIds
        );
        $params += $this->defaultLogin();
        $simplexml = $this->_getData('ClearOrdersHistory', $params);
        if (!$simplexml) return false;
        
        $data0 = array();
        
if(!isset($data0)){$data0 = array();}
	$data0_obj = @$simplexml;
	$data0 = @$data0_obj;
	return $data0;
    }
    public function GetSalesOrdersListForOperator($sessionId, $xmlOrderFilter){
        $params = array(
            'sessionId' => $sessionId,
	    'xmlOrderFilter' => $xmlOrderFilter
        );
        $params += $this->defaultLogin();
        $simplexml = $this->_getData('GetSalesOrdersListForOperator', $params);
        if (!$simplexml) return false;
        
        $data0 = array();
        
if(!isset($data0)){$data0 = array();}

	if(!isset($simplexml->Result) || is_null($simplexml->Result) || !$simplexml->Result)	$data0_obj = @array();

	else
	$data0_obj = @$simplexml->Result->children();
	$data0 = @array();
	foreach($data0_obj as $value0){
		$data0_tmp = @array();
		$data0_tmp['Id'] = @(string)$value0->Id;
		$data0_tmp['id'] = @(string)$value0->Id;
		$data0_tmp['StatusCode'] = @(string)$value0->StatusCode;
		$data0_tmp['statuscode'] = @(string)$value0->StatusCode;
		$data0_tmp['StatusName'] = @(string)$value0->StatusName;
		$data0_tmp['statusname'] = @(string)$value0->StatusName;
		$data0_tmp['SubstatusCode'] = @(string)$value0->SubstatusCode;
		$data0_tmp['substatuscode'] = @(string)$value0->SubstatusCode;
		$data0_tmp['SubstatusName'] = @(string)$value0->SubstatusName;
		$data0_tmp['substatusname'] = @(string)$value0->SubstatusName;
		$data0_tmp['OperatorId'] = @(string)$value0->OperatorId;
		$data0_tmp['operatorid'] = @(string)$value0->OperatorId;
		$data0_tmp['OperatorName'] = @(string)$value0->OperatorName;
		$data0_tmp['operatorname'] = @(string)$value0->OperatorName;
		$data0_tmp['ItemsCount'] = @$value0->ItemsCount;
		$data0_tmp['itemscount'] = @$value0->ItemsCount;
		$data0_tmp['GoodsAmount'] = @$value0->GoodsAmount;
		$data0_tmp['goodsamount'] = @$value0->GoodsAmount;
		$data0_tmp['DeliveryAmount'] = @$value0->DeliveryAmount;
		$data0_tmp['deliveryamount'] = @$value0->DeliveryAmount;
		$data0_tmp['TotalAmount'] = @$value0->TotalAmount;
		$data0_tmp['totalamount'] = @$value0->TotalAmount;
		$data0_tmp['RemainAmount'] = @$value0->RemainAmount;
		$data0_tmp['remainamount'] = @$value0->RemainAmount;
		$data0_tmp['CurrencySign'] = @(string)$value0->CurrencySign;
		$data0_tmp['currencysign'] = @(string)$value0->CurrencySign;
		$data0_tmp['CurrencyCode'] = @(string)$value0->CurrencyCode;
		$data0_tmp['currencycode'] = @(string)$value0->CurrencyCode;
		$data0_tmp['GoodsAmountInternal'] = @$value0->GoodsAmountInternal;
		$data0_tmp['goodsamountinternal'] = @$value0->GoodsAmountInternal;
		$data0_tmp['DeliveryAmountInternal'] = @$value0->DeliveryAmountInternal;
		$data0_tmp['deliveryamountinternal'] = @$value0->DeliveryAmountInternal;
		$data0_tmp['TotalAmountInternal'] = @$value0->TotalAmountInternal;
		$data0_tmp['totalamountinternal'] = @$value0->TotalAmountInternal;
		$data0_tmp['RemainAmountInternal'] = @$value0->RemainAmountInternal;
		$data0_tmp['remainamountinternal'] = @$value0->RemainAmountInternal;
		$data0_tmp['CurrencySignInternal'] = @(string)$value0->CurrencySignInternal;
		$data0_tmp['currencysigninternal'] = @(string)$value0->CurrencySignInternal;
		$data0_tmp['CurrencyCodeInternal'] = @(string)$value0->CurrencyCodeInternal;
		$data0_tmp['currencycodeinternal'] = @(string)$value0->CurrencyCodeInternal;
		$data0_tmp['CustComment'] = @(string)$value0->CustComment;
		$data0_tmp['custcomment'] = @(string)$value0->CustComment;
		$data0_tmp['DeliveryModeId'] = @(string)$value0->DeliveryModeId;
		$data0_tmp['deliverymodeid'] = @(string)$value0->DeliveryModeId;
		$data0_tmp['DeliveryModeName'] = @(string)$value0->DeliveryModeName;
		$data0_tmp['deliverymodename'] = @(string)$value0->DeliveryModeName;
		$data0_tmp['CanCancel'] = @(int)$value0->CanCancel;
		$data0_tmp['cancancel'] = @(int)$value0->CanCancel;
		$data0_tmp['CanConfirmShipment'] = @(int)$value0->CanConfirmShipment;
		$data0_tmp['canconfirmshipment'] = @(int)$value0->CanConfirmShipment;
		$data0_tmp['CanChangeAddress'] = @(int)$value0->CanChangeAddress;
		$data0_tmp['canchangeaddress'] = @(int)$value0->CanChangeAddress;
		$data0_tmp['AdminInfoText'] = @(string)$value0->AdminInfoText;
		$data0_tmp['admininfotext'] = @(string)$value0->AdminInfoText;
		$data0_tmp['AdminAlertText'] = @(string)$value0->AdminAlertText;
		$data0_tmp['adminalerttext'] = @(string)$value0->AdminAlertText;
		$data0_tmp['PaidAmount'] = @$value0->PaidAmount;
		$data0_tmp['paidamount'] = @$value0->PaidAmount;
		$data0_tmp['PaidAmountInternal'] = @$value0->PaidAmountInternal;
		$data0_tmp['paidamountinternal'] = @$value0->PaidAmountInternal;
		$data0_tmp['CanRestore'] = @(int)$value0->CanRestore;
		$data0_tmp['canrestore'] = @(int)$value0->CanRestore;
		$data0_tmp['CanClose'] = @(int)$value0->CanClose;
		$data0_tmp['canclose'] = @(int)$value0->CanClose;
		$data0_tmp['CanCloseCancel'] = @(int)$value0->CanCloseCancel;
		$data0_tmp['canclosecancel'] = @(int)$value0->CanCloseCancel;
		$data0_tmp['CanAccept'] = @(int)$value0->CanAccept;
		$data0_tmp['canaccept'] = @(int)$value0->CanAccept;
		$data0_tmp['CanPurchaseItems'] = @(int)$value0->CanPurchaseItems;
		$data0_tmp['canpurchaseitems'] = @(int)$value0->CanPurchaseItems;
		$data0_tmp['PackagesWeight'] = @(int)$value0->PackagesWeight;
		$data0_tmp['packagesweight'] = @(int)$value0->PackagesWeight;
		$data0_tmp['EstimatedWeight'] = @(int)$value0->EstimatedWeight;
		$data0_tmp['estimatedweight'] = @(int)$value0->EstimatedWeight;
		$data0_tmp['CustId'] = @(string)$value0->CustId;
		$data0_tmp['custid'] = @(string)$value0->CustId;
		$data0_tmp['CustName'] = @(string)$value0->CustName;
		$data0_tmp['custname'] = @(string)$value0->CustName;
		$data0_tmp['StatusId'] = @(int)$value0->StatusId;
		$data0_tmp['statusid'] = @(int)$value0->StatusId;
		$data0_tmp['Weight'] = @$value0->Weight;
		$data0_tmp['weight'] = @$value0->Weight;
if(!isset($data0_tmp['DeliveryAddress'])){$data0_tmp['DeliveryAddress'] = array();}
		$data1_obj = @$value0->DeliveryAddress;
if(!isset($data0_tmp['DeliveryAddress']['Id'])){$data0_tmp['DeliveryAddress']['Id'] = array();}
			$data2_obj = @$value0->DeliveryAddress->Id;
			$data0_tmp['DeliveryAddress']['Id'] = @(string)$data2_obj;
		$data0_tmp['DeliveryAddress']['id'] = @$data0_tmp['DeliveryAddress']['Id'];
if(!isset($data0_tmp['DeliveryAddress']['Familyname'])){$data0_tmp['DeliveryAddress']['Familyname'] = array();}
			$data2_obj = @$value0->DeliveryAddress->Familyname;
			$data0_tmp['DeliveryAddress']['Familyname'] = @(string)$data2_obj;
		$data0_tmp['DeliveryAddress']['familyname'] = @$data0_tmp['DeliveryAddress']['Familyname'];
if(!isset($data0_tmp['DeliveryAddress']['Name'])){$data0_tmp['DeliveryAddress']['Name'] = array();}
			$data2_obj = @$value0->DeliveryAddress->Name;
			$data0_tmp['DeliveryAddress']['Name'] = @(string)$data2_obj;
		$data0_tmp['DeliveryAddress']['name'] = @$data0_tmp['DeliveryAddress']['Name'];
if(!isset($data0_tmp['DeliveryAddress']['Patername'])){$data0_tmp['DeliveryAddress']['Patername'] = array();}
			$data2_obj = @$value0->DeliveryAddress->Patername;
			$data0_tmp['DeliveryAddress']['Patername'] = @(string)$data2_obj;
		$data0_tmp['DeliveryAddress']['patername'] = @$data0_tmp['DeliveryAddress']['Patername'];
if(!isset($data0_tmp['DeliveryAddress']['CountryCode'])){$data0_tmp['DeliveryAddress']['CountryCode'] = array();}
			$data2_obj = @$value0->DeliveryAddress->CountryCode;
			$data0_tmp['DeliveryAddress']['CountryCode'] = @(string)$data2_obj;
		$data0_tmp['DeliveryAddress']['countrycode'] = @$data0_tmp['DeliveryAddress']['CountryCode'];
if(!isset($data0_tmp['DeliveryAddress']['Country'])){$data0_tmp['DeliveryAddress']['Country'] = array();}
			$data2_obj = @$value0->DeliveryAddress->Country;
			$data0_tmp['DeliveryAddress']['Country'] = @(string)$data2_obj;
		$data0_tmp['DeliveryAddress']['country'] = @$data0_tmp['DeliveryAddress']['Country'];
if(!isset($data0_tmp['DeliveryAddress']['City'])){$data0_tmp['DeliveryAddress']['City'] = array();}
			$data2_obj = @$value0->DeliveryAddress->City;
			$data0_tmp['DeliveryAddress']['City'] = @(string)$data2_obj;
		$data0_tmp['DeliveryAddress']['city'] = @$data0_tmp['DeliveryAddress']['City'];
if(!isset($data0_tmp['DeliveryAddress']['Address'])){$data0_tmp['DeliveryAddress']['Address'] = array();}
			$data2_obj = @$value0->DeliveryAddress->Address;
			$data0_tmp['DeliveryAddress']['Address'] = @(string)$data2_obj;
		$data0_tmp['DeliveryAddress']['address'] = @$data0_tmp['DeliveryAddress']['Address'];
if(!isset($data0_tmp['DeliveryAddress']['Phone'])){$data0_tmp['DeliveryAddress']['Phone'] = array();}
			$data2_obj = @$value0->DeliveryAddress->Phone;
			$data0_tmp['DeliveryAddress']['Phone'] = @(string)$data2_obj;
		$data0_tmp['DeliveryAddress']['phone'] = @$data0_tmp['DeliveryAddress']['Phone'];
if(!isset($data0_tmp['DeliveryAddress']['PostalCode'])){$data0_tmp['DeliveryAddress']['PostalCode'] = array();}
			$data2_obj = @$value0->DeliveryAddress->PostalCode;
			$data0_tmp['DeliveryAddress']['PostalCode'] = @(string)$data2_obj;
		$data0_tmp['DeliveryAddress']['postalcode'] = @$data0_tmp['DeliveryAddress']['PostalCode'];
if(!isset($data0_tmp['DeliveryAddress']['RegionName'])){$data0_tmp['DeliveryAddress']['RegionName'] = array();}
			$data2_obj = @$value0->DeliveryAddress->RegionName;
			$data0_tmp['DeliveryAddress']['RegionName'] = @(string)$data2_obj;
		$data0_tmp['DeliveryAddress']['regionname'] = @$data0_tmp['DeliveryAddress']['RegionName'];
		$data0_tmp['TaoBaoPrice'] = @$value0->TaoBaoPrice;
		$data0_tmp['taobaoprice'] = @$value0->TaoBaoPrice;
		$data0_tmp['InternalDeliveryOriginalInExternalCurrency'] = @$value0->InternalDeliveryOriginalInExternalCurrency;
		$data0_tmp['internaldeliveryoriginalinexternalcurrency'] = @$value0->InternalDeliveryOriginalInExternalCurrency;
		$data0_tmp['AdditionalInfo'] = @(string)$value0->AdditionalInfo;
		$data0_tmp['additionalinfo'] = @(string)$value0->AdditionalInfo;
		$data0_tmp['ExternalCurrencyCode'] = @(string)$value0->ExternalCurrencyCode;
		$data0_tmp['externalcurrencycode'] = @(string)$value0->ExternalCurrencyCode;
		$data0_tmp['ShipmentDate'] = @$value0->ShipmentDate;
		$data0_tmp['shipmentdate'] = @$value0->ShipmentDate;
		$data0_tmp['TotalAmountOriginalInExternalCurrency'] = @$value0->TotalAmountOriginalInExternalCurrency;
		$data0_tmp['totalamountoriginalinexternalcurrency'] = @$value0->TotalAmountOriginalInExternalCurrency;
if(!isset($data0_tmp['PackagePrices'])){$data0_tmp['PackagePrices'] = array();}

	if(!isset($value0->PackagePrices) || is_null($value0->PackagePrices) || !$value0->PackagePrices)		$data1_obj = @array();

	else
		$data1_obj = @$value0->PackagePrices->children();
		$data0_tmp['PackagePrices'] = @array();
		foreach($data1_obj as $value1){
			$data1_tmp = @array();
			$data1_tmp['Id'] = @(string)$value1->Id;
			$data1_tmp['id'] = @(string)$value1->Id;
			$data1_tmp['PriceInternal'] = @$value1->PriceInternal;
			$data1_tmp['priceinternal'] = @$value1->PriceInternal;
			$data1_tmp['AdditionalPriceInternal'] = @$value1->AdditionalPriceInternal;
			$data1_tmp['additionalpriceinternal'] = @$value1->AdditionalPriceInternal;
			$data1_tmp['AdditionalPrice'] = @$value1->AdditionalPrice;
			$data1_tmp['additionalprice'] = @$value1->AdditionalPrice;
			$data1_tmp['Price'] = @$value1->Price;
			$data1_tmp['price'] = @$value1->Price;
			$data1_tmp['PriceCurrencyCode'] = @(string)$value1->PriceCurrencyCode;
			$data1_tmp['pricecurrencycode'] = @(string)$value1->PriceCurrencyCode;
			$data1_tmp['PriceUpdateDate'] = @$value1->PriceUpdateDate;
			$data1_tmp['priceupdatedate'] = @$value1->PriceUpdateDate;
			$data0_tmp['PackagePrices'][] = @$data1_tmp;
		}
if(!isset($data0_tmp['LineStatusSummaries'])){$data0_tmp['LineStatusSummaries'] = array();}

	if(!isset($value0->LineStatusSummaries) || is_null($value0->LineStatusSummaries) || !$value0->LineStatusSummaries)		$data1_obj = @array();

	else
		$data1_obj = @$value0->LineStatusSummaries->children();
		$data0_tmp['LineStatusSummaries'] = @array();
		foreach($data1_obj as $value1){
			$data1_tmp = @array();
if(!isset($data1_tmp['Status'])){$data1_tmp['Status'] = array();}
			$data2_obj = @$value1->Status;
if(!isset($data1_tmp['Status']['Id'])){$data1_tmp['Status']['Id'] = array();}
				$data3_obj = @$value1->Status->Id;
				$data1_tmp['Status']['Id'] = @$data3_obj;
			$data1_tmp['Status']['id'] = @$data1_tmp['Status']['Id'];
if(!isset($data1_tmp['Status']['Name'])){$data1_tmp['Status']['Name'] = array();}
				$data3_obj = @$value1->Status->Name;
				$data1_tmp['Status']['Name'] = @(string)$data3_obj;
			$data1_tmp['Status']['name'] = @$data1_tmp['Status']['Name'];
			$data1_tmp['Count'] = @(int)$value1->Count;
			$data1_tmp['count'] = @(int)$value1->Count;
			$data0_tmp['LineStatusSummaries'][] = @$data1_tmp;
		}
		$data0_tmp['UserAccountAvailableAmount'] = @$value0->UserAccountAvailableAmount;
		$data0_tmp['useraccountavailableamount'] = @$value0->UserAccountAvailableAmount;
		$data0_tmp['CreatedDateTime'] = @(string)$value0->CreatedDateTime;
		$data0_tmp['createddatetime'] = @(string)$value0->CreatedDateTime;
		$data0_tmp['UserLogin'] = @(string)$value0->UserLogin;
		$data0_tmp['userlogin'] = @(string)$value0->UserLogin;
if(!isset($data0_tmp['TotalOriginalCostList'])){$data0_tmp['TotalOriginalCostList'] = array();}

	if(!isset($value0->TotalOriginalCostList) || is_null($value0->TotalOriginalCostList) || !$value0->TotalOriginalCostList)		$data1_obj = @array();

	else
		$data1_obj = @$value0->TotalOriginalCostList->children();
		$data0_tmp['TotalOriginalCostList'] = @array();
		foreach($data1_obj as $value1){
			$data1_tmp = @array();
			$data1_tmp['CurrencyCode'] = @(string)$value1->CurrencyCode;
			$data1_tmp['currencycode'] = @(string)$value1->CurrencyCode;
			$data1_tmp['TotalCost'] = @$value1->TotalCost;
			$data1_tmp['totalcost'] = @$value1->TotalCost;
			$data1_tmp['TotalCostInInternalCurrency'] = @$value1->TotalCostInInternalCurrency;
			$data1_tmp['totalcostininternalcurrency'] = @$value1->TotalCostInInternalCurrency;
			$data0_tmp['TotalOriginalCostList'][] = @$data1_tmp;
		}
if(!isset($data0_tmp['PackageTotalCostPerCurrencyList'])){$data0_tmp['PackageTotalCostPerCurrencyList'] = array();}

	if(!isset($value0->PackageTotalCostPerCurrencyList) || is_null($value0->PackageTotalCostPerCurrencyList) || !$value0->PackageTotalCostPerCurrencyList)		$data1_obj = @array();

	else
		$data1_obj = @$value0->PackageTotalCostPerCurrencyList->children();
		$data0_tmp['PackageTotalCostPerCurrencyList'] = @array();
		foreach($data1_obj as $value1){
			$data1_tmp = @array();
			$data1_tmp['CurrencyCode'] = @(string)$value1->CurrencyCode;
			$data1_tmp['currencycode'] = @(string)$value1->CurrencyCode;
			$data1_tmp['TotalPrice'] = @$value1->TotalPrice;
			$data1_tmp['totalprice'] = @$value1->TotalPrice;
			$data1_tmp['TotalAdditionalPrice'] = @$value1->TotalAdditionalPrice;
			$data1_tmp['totaladditionalprice'] = @$value1->TotalAdditionalPrice;
			$data0_tmp['PackageTotalCostPerCurrencyList'][] = @$data1_tmp;
		}
		$data0_tmp['InternalDeliveryOriginalInInternalCurrency'] = @$value0->InternalDeliveryOriginalInInternalCurrency;
		$data0_tmp['internaldeliveryoriginalininternalcurrency'] = @$value0->InternalDeliveryOriginalInInternalCurrency;
		$data0_tmp['InternalOriginalPrice'] = @$value0->InternalOriginalPrice;
		$data0_tmp['internaloriginalprice'] = @$value0->InternalOriginalPrice;
		$data0_tmp['Profit'] = @$value0->Profit;
		$data0_tmp['profit'] = @$value0->Profit;
if(!isset($data0_tmp['RateList'])){$data0_tmp['RateList'] = array();}

	if(!isset($value0->RateList) || is_null($value0->RateList) || !$value0->RateList)		$data1_obj = @array();

	else
		$data1_obj = @$value0->RateList->children();
		$data0_tmp['RateList'] = @array();
		foreach($data1_obj as $value1){
			$data0_tmp['RateList'][] = @$value1;
		}
		$data0[] = @$data0_tmp;
	}
	return $data0;
    }
    public function GetSalesOrderDetailsForOperator($sessionId, $salesId, $filter, $queryType){
        $params = array(
            'sessionId' => $sessionId,
	    'salesId' => $salesId,
	    'filter' => $filter,
	    'queryType' => $queryType
        );
        $params += $this->defaultLogin();
        $simplexml = $this->_getData('GetSalesOrderDetailsForOperator', $params);
        if (!$simplexml) return false;
        
        $data0 = array();
        
if(!isset($data0)){$data0 = array();}
	$data0_obj = @$simplexml->Result;
if(!isset($data0['SalesOrderInfo'])){$data0['SalesOrderInfo'] = array();}
		$data1_obj = @$simplexml->Result->SalesOrderInfo;
if(!isset($data0['SalesOrderInfo']['Id'])){$data0['SalesOrderInfo']['Id'] = array();}
			$data2_obj = @$simplexml->Result->SalesOrderInfo->Id;
			$data0['SalesOrderInfo']['Id'] = @(string)$data2_obj;
		$data0['SalesOrderInfo']['id'] = @$data0['SalesOrderInfo']['Id'];
if(!isset($data0['SalesOrderInfo']['StatusCode'])){$data0['SalesOrderInfo']['StatusCode'] = array();}
			$data2_obj = @$simplexml->Result->SalesOrderInfo->StatusCode;
			$data0['SalesOrderInfo']['StatusCode'] = @(string)$data2_obj;
		$data0['SalesOrderInfo']['statuscode'] = @$data0['SalesOrderInfo']['StatusCode'];
if(!isset($data0['SalesOrderInfo']['StatusName'])){$data0['SalesOrderInfo']['StatusName'] = array();}
			$data2_obj = @$simplexml->Result->SalesOrderInfo->StatusName;
			$data0['SalesOrderInfo']['StatusName'] = @(string)$data2_obj;
		$data0['SalesOrderInfo']['statusname'] = @$data0['SalesOrderInfo']['StatusName'];
if(!isset($data0['SalesOrderInfo']['SubstatusCode'])){$data0['SalesOrderInfo']['SubstatusCode'] = array();}
			$data2_obj = @$simplexml->Result->SalesOrderInfo->SubstatusCode;
			$data0['SalesOrderInfo']['SubstatusCode'] = @(string)$data2_obj;
		$data0['SalesOrderInfo']['substatuscode'] = @$data0['SalesOrderInfo']['SubstatusCode'];
if(!isset($data0['SalesOrderInfo']['SubstatusName'])){$data0['SalesOrderInfo']['SubstatusName'] = array();}
			$data2_obj = @$simplexml->Result->SalesOrderInfo->SubstatusName;
			$data0['SalesOrderInfo']['SubstatusName'] = @(string)$data2_obj;
		$data0['SalesOrderInfo']['substatusname'] = @$data0['SalesOrderInfo']['SubstatusName'];
if(!isset($data0['SalesOrderInfo']['OperatorId'])){$data0['SalesOrderInfo']['OperatorId'] = array();}
			$data2_obj = @$simplexml->Result->SalesOrderInfo->OperatorId;
			$data0['SalesOrderInfo']['OperatorId'] = @(string)$data2_obj;
		$data0['SalesOrderInfo']['operatorid'] = @$data0['SalesOrderInfo']['OperatorId'];
if(!isset($data0['SalesOrderInfo']['OperatorName'])){$data0['SalesOrderInfo']['OperatorName'] = array();}
			$data2_obj = @$simplexml->Result->SalesOrderInfo->OperatorName;
			$data0['SalesOrderInfo']['OperatorName'] = @(string)$data2_obj;
		$data0['SalesOrderInfo']['operatorname'] = @$data0['SalesOrderInfo']['OperatorName'];
if(!isset($data0['SalesOrderInfo']['ItemsCount'])){$data0['SalesOrderInfo']['ItemsCount'] = array();}
			$data2_obj = @$simplexml->Result->SalesOrderInfo->ItemsCount;
			$data0['SalesOrderInfo']['ItemsCount'] = @$data2_obj;
		$data0['SalesOrderInfo']['itemscount'] = @$data0['SalesOrderInfo']['ItemsCount'];
if(!isset($data0['SalesOrderInfo']['GoodsAmount'])){$data0['SalesOrderInfo']['GoodsAmount'] = array();}
			$data2_obj = @$simplexml->Result->SalesOrderInfo->GoodsAmount;
			$data0['SalesOrderInfo']['GoodsAmount'] = @$data2_obj;
		$data0['SalesOrderInfo']['goodsamount'] = @$data0['SalesOrderInfo']['GoodsAmount'];
if(!isset($data0['SalesOrderInfo']['DeliveryAmount'])){$data0['SalesOrderInfo']['DeliveryAmount'] = array();}
			$data2_obj = @$simplexml->Result->SalesOrderInfo->DeliveryAmount;
			$data0['SalesOrderInfo']['DeliveryAmount'] = @$data2_obj;
		$data0['SalesOrderInfo']['deliveryamount'] = @$data0['SalesOrderInfo']['DeliveryAmount'];
if(!isset($data0['SalesOrderInfo']['TotalAmount'])){$data0['SalesOrderInfo']['TotalAmount'] = array();}
			$data2_obj = @$simplexml->Result->SalesOrderInfo->TotalAmount;
			$data0['SalesOrderInfo']['TotalAmount'] = @$data2_obj;
		$data0['SalesOrderInfo']['totalamount'] = @$data0['SalesOrderInfo']['TotalAmount'];
if(!isset($data0['SalesOrderInfo']['RemainAmount'])){$data0['SalesOrderInfo']['RemainAmount'] = array();}
			$data2_obj = @$simplexml->Result->SalesOrderInfo->RemainAmount;
			$data0['SalesOrderInfo']['RemainAmount'] = @$data2_obj;
		$data0['SalesOrderInfo']['remainamount'] = @$data0['SalesOrderInfo']['RemainAmount'];
if(!isset($data0['SalesOrderInfo']['CurrencySign'])){$data0['SalesOrderInfo']['CurrencySign'] = array();}
			$data2_obj = @$simplexml->Result->SalesOrderInfo->CurrencySign;
			$data0['SalesOrderInfo']['CurrencySign'] = @(string)$data2_obj;
		$data0['SalesOrderInfo']['currencysign'] = @$data0['SalesOrderInfo']['CurrencySign'];
if(!isset($data0['SalesOrderInfo']['CurrencyCode'])){$data0['SalesOrderInfo']['CurrencyCode'] = array();}
			$data2_obj = @$simplexml->Result->SalesOrderInfo->CurrencyCode;
			$data0['SalesOrderInfo']['CurrencyCode'] = @(string)$data2_obj;
		$data0['SalesOrderInfo']['currencycode'] = @$data0['SalesOrderInfo']['CurrencyCode'];
if(!isset($data0['SalesOrderInfo']['GoodsAmountInternal'])){$data0['SalesOrderInfo']['GoodsAmountInternal'] = array();}
			$data2_obj = @$simplexml->Result->SalesOrderInfo->GoodsAmountInternal;
			$data0['SalesOrderInfo']['GoodsAmountInternal'] = @$data2_obj;
		$data0['SalesOrderInfo']['goodsamountinternal'] = @$data0['SalesOrderInfo']['GoodsAmountInternal'];
if(!isset($data0['SalesOrderInfo']['DeliveryAmountInternal'])){$data0['SalesOrderInfo']['DeliveryAmountInternal'] = array();}
			$data2_obj = @$simplexml->Result->SalesOrderInfo->DeliveryAmountInternal;
			$data0['SalesOrderInfo']['DeliveryAmountInternal'] = @$data2_obj;
		$data0['SalesOrderInfo']['deliveryamountinternal'] = @$data0['SalesOrderInfo']['DeliveryAmountInternal'];
if(!isset($data0['SalesOrderInfo']['TotalAmountInternal'])){$data0['SalesOrderInfo']['TotalAmountInternal'] = array();}
			$data2_obj = @$simplexml->Result->SalesOrderInfo->TotalAmountInternal;
			$data0['SalesOrderInfo']['TotalAmountInternal'] = @$data2_obj;
		$data0['SalesOrderInfo']['totalamountinternal'] = @$data0['SalesOrderInfo']['TotalAmountInternal'];
if(!isset($data0['SalesOrderInfo']['RemainAmountInternal'])){$data0['SalesOrderInfo']['RemainAmountInternal'] = array();}
			$data2_obj = @$simplexml->Result->SalesOrderInfo->RemainAmountInternal;
			$data0['SalesOrderInfo']['RemainAmountInternal'] = @$data2_obj;
		$data0['SalesOrderInfo']['remainamountinternal'] = @$data0['SalesOrderInfo']['RemainAmountInternal'];
if(!isset($data0['SalesOrderInfo']['CurrencySignInternal'])){$data0['SalesOrderInfo']['CurrencySignInternal'] = array();}
			$data2_obj = @$simplexml->Result->SalesOrderInfo->CurrencySignInternal;
			$data0['SalesOrderInfo']['CurrencySignInternal'] = @(string)$data2_obj;
		$data0['SalesOrderInfo']['currencysigninternal'] = @$data0['SalesOrderInfo']['CurrencySignInternal'];
if(!isset($data0['SalesOrderInfo']['CurrencyCodeInternal'])){$data0['SalesOrderInfo']['CurrencyCodeInternal'] = array();}
			$data2_obj = @$simplexml->Result->SalesOrderInfo->CurrencyCodeInternal;
			$data0['SalesOrderInfo']['CurrencyCodeInternal'] = @(string)$data2_obj;
		$data0['SalesOrderInfo']['currencycodeinternal'] = @$data0['SalesOrderInfo']['CurrencyCodeInternal'];
if(!isset($data0['SalesOrderInfo']['CustComment'])){$data0['SalesOrderInfo']['CustComment'] = array();}
			$data2_obj = @$simplexml->Result->SalesOrderInfo->CustComment;
			$data0['SalesOrderInfo']['CustComment'] = @(string)$data2_obj;
		$data0['SalesOrderInfo']['custcomment'] = @$data0['SalesOrderInfo']['CustComment'];
if(!isset($data0['SalesOrderInfo']['DeliveryModeId'])){$data0['SalesOrderInfo']['DeliveryModeId'] = array();}
			$data2_obj = @$simplexml->Result->SalesOrderInfo->DeliveryModeId;
			$data0['SalesOrderInfo']['DeliveryModeId'] = @(string)$data2_obj;
		$data0['SalesOrderInfo']['deliverymodeid'] = @$data0['SalesOrderInfo']['DeliveryModeId'];
if(!isset($data0['SalesOrderInfo']['DeliveryModeName'])){$data0['SalesOrderInfo']['DeliveryModeName'] = array();}
			$data2_obj = @$simplexml->Result->SalesOrderInfo->DeliveryModeName;
			$data0['SalesOrderInfo']['DeliveryModeName'] = @(string)$data2_obj;
		$data0['SalesOrderInfo']['deliverymodename'] = @$data0['SalesOrderInfo']['DeliveryModeName'];
if(!isset($data0['SalesOrderInfo']['CanCancel'])){$data0['SalesOrderInfo']['CanCancel'] = array();}
			$data2_obj = @$simplexml->Result->SalesOrderInfo->CanCancel;
			$data0['SalesOrderInfo']['CanCancel'] = @$data2_obj;
		$data0['SalesOrderInfo']['cancancel'] = @$data0['SalesOrderInfo']['CanCancel'];
if(!isset($data0['SalesOrderInfo']['CanConfirmShipment'])){$data0['SalesOrderInfo']['CanConfirmShipment'] = array();}
			$data2_obj = @$simplexml->Result->SalesOrderInfo->CanConfirmShipment;
			$data0['SalesOrderInfo']['CanConfirmShipment'] = @$data2_obj;
		$data0['SalesOrderInfo']['canconfirmshipment'] = @$data0['SalesOrderInfo']['CanConfirmShipment'];
if(!isset($data0['SalesOrderInfo']['CanChangeAddress'])){$data0['SalesOrderInfo']['CanChangeAddress'] = array();}
			$data2_obj = @$simplexml->Result->SalesOrderInfo->CanChangeAddress;
			$data0['SalesOrderInfo']['CanChangeAddress'] = @$data2_obj;
		$data0['SalesOrderInfo']['canchangeaddress'] = @$data0['SalesOrderInfo']['CanChangeAddress'];
if(!isset($data0['SalesOrderInfo']['AdminInfoText'])){$data0['SalesOrderInfo']['AdminInfoText'] = array();}
			$data2_obj = @$simplexml->Result->SalesOrderInfo->AdminInfoText;
			$data0['SalesOrderInfo']['AdminInfoText'] = @(string)$data2_obj;
		$data0['SalesOrderInfo']['admininfotext'] = @$data0['SalesOrderInfo']['AdminInfoText'];
if(!isset($data0['SalesOrderInfo']['AdminAlertText'])){$data0['SalesOrderInfo']['AdminAlertText'] = array();}
			$data2_obj = @$simplexml->Result->SalesOrderInfo->AdminAlertText;
			$data0['SalesOrderInfo']['AdminAlertText'] = @(string)$data2_obj;
		$data0['SalesOrderInfo']['adminalerttext'] = @$data0['SalesOrderInfo']['AdminAlertText'];
if(!isset($data0['SalesOrderInfo']['PaidAmount'])){$data0['SalesOrderInfo']['PaidAmount'] = array();}
			$data2_obj = @$simplexml->Result->SalesOrderInfo->PaidAmount;
			$data0['SalesOrderInfo']['PaidAmount'] = @$data2_obj;
		$data0['SalesOrderInfo']['paidamount'] = @$data0['SalesOrderInfo']['PaidAmount'];
if(!isset($data0['SalesOrderInfo']['PaidAmountInternal'])){$data0['SalesOrderInfo']['PaidAmountInternal'] = array();}
			$data2_obj = @$simplexml->Result->SalesOrderInfo->PaidAmountInternal;
			$data0['SalesOrderInfo']['PaidAmountInternal'] = @$data2_obj;
		$data0['SalesOrderInfo']['paidamountinternal'] = @$data0['SalesOrderInfo']['PaidAmountInternal'];
if(!isset($data0['SalesOrderInfo']['CanRestore'])){$data0['SalesOrderInfo']['CanRestore'] = array();}
			$data2_obj = @$simplexml->Result->SalesOrderInfo->CanRestore;
			$data0['SalesOrderInfo']['CanRestore'] = @$data2_obj;
		$data0['SalesOrderInfo']['canrestore'] = @$data0['SalesOrderInfo']['CanRestore'];
if(!isset($data0['SalesOrderInfo']['CanClose'])){$data0['SalesOrderInfo']['CanClose'] = array();}
			$data2_obj = @$simplexml->Result->SalesOrderInfo->CanClose;
			$data0['SalesOrderInfo']['CanClose'] = @$data2_obj;
		$data0['SalesOrderInfo']['canclose'] = @$data0['SalesOrderInfo']['CanClose'];
if(!isset($data0['SalesOrderInfo']['CanCloseCancel'])){$data0['SalesOrderInfo']['CanCloseCancel'] = array();}
			$data2_obj = @$simplexml->Result->SalesOrderInfo->CanCloseCancel;
			$data0['SalesOrderInfo']['CanCloseCancel'] = @$data2_obj;
		$data0['SalesOrderInfo']['canclosecancel'] = @$data0['SalesOrderInfo']['CanCloseCancel'];
if(!isset($data0['SalesOrderInfo']['CanAccept'])){$data0['SalesOrderInfo']['CanAccept'] = array();}
			$data2_obj = @$simplexml->Result->SalesOrderInfo->CanAccept;
			$data0['SalesOrderInfo']['CanAccept'] = @$data2_obj;
		$data0['SalesOrderInfo']['canaccept'] = @$data0['SalesOrderInfo']['CanAccept'];
if(!isset($data0['SalesOrderInfo']['CanPurchaseItems'])){$data0['SalesOrderInfo']['CanPurchaseItems'] = array();}
			$data2_obj = @$simplexml->Result->SalesOrderInfo->CanPurchaseItems;
			$data0['SalesOrderInfo']['CanPurchaseItems'] = @$data2_obj;
		$data0['SalesOrderInfo']['canpurchaseitems'] = @$data0['SalesOrderInfo']['CanPurchaseItems'];
if(!isset($data0['SalesOrderInfo']['PackagesWeight'])){$data0['SalesOrderInfo']['PackagesWeight'] = array();}
			$data2_obj = @$simplexml->Result->SalesOrderInfo->PackagesWeight;
			$data0['SalesOrderInfo']['PackagesWeight'] = @$data2_obj;
		$data0['SalesOrderInfo']['packagesweight'] = @$data0['SalesOrderInfo']['PackagesWeight'];
if(!isset($data0['SalesOrderInfo']['EstimatedWeight'])){$data0['SalesOrderInfo']['EstimatedWeight'] = array();}
			$data2_obj = @$simplexml->Result->SalesOrderInfo->EstimatedWeight;
			$data0['SalesOrderInfo']['EstimatedWeight'] = @$data2_obj;
		$data0['SalesOrderInfo']['estimatedweight'] = @$data0['SalesOrderInfo']['EstimatedWeight'];
if(!isset($data0['SalesOrderInfo']['CustId'])){$data0['SalesOrderInfo']['CustId'] = array();}
			$data2_obj = @$simplexml->Result->SalesOrderInfo->CustId;
			$data0['SalesOrderInfo']['CustId'] = @(string)$data2_obj;
		$data0['SalesOrderInfo']['custid'] = @$data0['SalesOrderInfo']['CustId'];
if(!isset($data0['SalesOrderInfo']['CustName'])){$data0['SalesOrderInfo']['CustName'] = array();}
			$data2_obj = @$simplexml->Result->SalesOrderInfo->CustName;
			$data0['SalesOrderInfo']['CustName'] = @(string)$data2_obj;
		$data0['SalesOrderInfo']['custname'] = @$data0['SalesOrderInfo']['CustName'];
if(!isset($data0['SalesOrderInfo']['StatusId'])){$data0['SalesOrderInfo']['StatusId'] = array();}
			$data2_obj = @$simplexml->Result->SalesOrderInfo->StatusId;
			$data0['SalesOrderInfo']['StatusId'] = @$data2_obj;
		$data0['SalesOrderInfo']['statusid'] = @$data0['SalesOrderInfo']['StatusId'];
if(!isset($data0['SalesOrderInfo']['Weight'])){$data0['SalesOrderInfo']['Weight'] = array();}
			$data2_obj = @$simplexml->Result->SalesOrderInfo->Weight;
			$data0['SalesOrderInfo']['Weight'] = @$data2_obj;
		$data0['SalesOrderInfo']['weight'] = @$data0['SalesOrderInfo']['Weight'];
if(!isset($data0['SalesOrderInfo']['DeliveryAddress'])){$data0['SalesOrderInfo']['DeliveryAddress'] = array();}
			$data2_obj = @$simplexml->Result->SalesOrderInfo->DeliveryAddress;
if(!isset($data0['SalesOrderInfo']['DeliveryAddress']['Id'])){$data0['SalesOrderInfo']['DeliveryAddress']['Id'] = array();}
				$data3_obj = @$simplexml->Result->SalesOrderInfo->DeliveryAddress->Id;
				$data0['SalesOrderInfo']['DeliveryAddress']['Id'] = @(string)$data3_obj;
			$data0['SalesOrderInfo']['DeliveryAddress']['id'] = @$data0['SalesOrderInfo']['DeliveryAddress']['Id'];
if(!isset($data0['SalesOrderInfo']['DeliveryAddress']['Familyname'])){$data0['SalesOrderInfo']['DeliveryAddress']['Familyname'] = array();}
				$data3_obj = @$simplexml->Result->SalesOrderInfo->DeliveryAddress->Familyname;
				$data0['SalesOrderInfo']['DeliveryAddress']['Familyname'] = @(string)$data3_obj;
			$data0['SalesOrderInfo']['DeliveryAddress']['familyname'] = @$data0['SalesOrderInfo']['DeliveryAddress']['Familyname'];
if(!isset($data0['SalesOrderInfo']['DeliveryAddress']['Name'])){$data0['SalesOrderInfo']['DeliveryAddress']['Name'] = array();}
				$data3_obj = @$simplexml->Result->SalesOrderInfo->DeliveryAddress->Name;
				$data0['SalesOrderInfo']['DeliveryAddress']['Name'] = @(string)$data3_obj;
			$data0['SalesOrderInfo']['DeliveryAddress']['name'] = @$data0['SalesOrderInfo']['DeliveryAddress']['Name'];
if(!isset($data0['SalesOrderInfo']['DeliveryAddress']['Patername'])){$data0['SalesOrderInfo']['DeliveryAddress']['Patername'] = array();}
				$data3_obj = @$simplexml->Result->SalesOrderInfo->DeliveryAddress->Patername;
				$data0['SalesOrderInfo']['DeliveryAddress']['Patername'] = @(string)$data3_obj;
			$data0['SalesOrderInfo']['DeliveryAddress']['patername'] = @$data0['SalesOrderInfo']['DeliveryAddress']['Patername'];
if(!isset($data0['SalesOrderInfo']['DeliveryAddress']['CountryCode'])){$data0['SalesOrderInfo']['DeliveryAddress']['CountryCode'] = array();}
				$data3_obj = @$simplexml->Result->SalesOrderInfo->DeliveryAddress->CountryCode;
				$data0['SalesOrderInfo']['DeliveryAddress']['CountryCode'] = @(string)$data3_obj;
			$data0['SalesOrderInfo']['DeliveryAddress']['countrycode'] = @$data0['SalesOrderInfo']['DeliveryAddress']['CountryCode'];
if(!isset($data0['SalesOrderInfo']['DeliveryAddress']['Country'])){$data0['SalesOrderInfo']['DeliveryAddress']['Country'] = array();}
				$data3_obj = @$simplexml->Result->SalesOrderInfo->DeliveryAddress->Country;
				$data0['SalesOrderInfo']['DeliveryAddress']['Country'] = @(string)$data3_obj;
			$data0['SalesOrderInfo']['DeliveryAddress']['country'] = @$data0['SalesOrderInfo']['DeliveryAddress']['Country'];
if(!isset($data0['SalesOrderInfo']['DeliveryAddress']['City'])){$data0['SalesOrderInfo']['DeliveryAddress']['City'] = array();}
				$data3_obj = @$simplexml->Result->SalesOrderInfo->DeliveryAddress->City;
				$data0['SalesOrderInfo']['DeliveryAddress']['City'] = @(string)$data3_obj;
			$data0['SalesOrderInfo']['DeliveryAddress']['city'] = @$data0['SalesOrderInfo']['DeliveryAddress']['City'];
if(!isset($data0['SalesOrderInfo']['DeliveryAddress']['Address'])){$data0['SalesOrderInfo']['DeliveryAddress']['Address'] = array();}
				$data3_obj = @$simplexml->Result->SalesOrderInfo->DeliveryAddress->Address;
				$data0['SalesOrderInfo']['DeliveryAddress']['Address'] = @(string)$data3_obj;
			$data0['SalesOrderInfo']['DeliveryAddress']['address'] = @$data0['SalesOrderInfo']['DeliveryAddress']['Address'];
if(!isset($data0['SalesOrderInfo']['DeliveryAddress']['Phone'])){$data0['SalesOrderInfo']['DeliveryAddress']['Phone'] = array();}
				$data3_obj = @$simplexml->Result->SalesOrderInfo->DeliveryAddress->Phone;
				$data0['SalesOrderInfo']['DeliveryAddress']['Phone'] = @(string)$data3_obj;
			$data0['SalesOrderInfo']['DeliveryAddress']['phone'] = @$data0['SalesOrderInfo']['DeliveryAddress']['Phone'];
if(!isset($data0['SalesOrderInfo']['DeliveryAddress']['PostalCode'])){$data0['SalesOrderInfo']['DeliveryAddress']['PostalCode'] = array();}
				$data3_obj = @$simplexml->Result->SalesOrderInfo->DeliveryAddress->PostalCode;
				$data0['SalesOrderInfo']['DeliveryAddress']['PostalCode'] = @(string)$data3_obj;
			$data0['SalesOrderInfo']['DeliveryAddress']['postalcode'] = @$data0['SalesOrderInfo']['DeliveryAddress']['PostalCode'];
if(!isset($data0['SalesOrderInfo']['DeliveryAddress']['RegionName'])){$data0['SalesOrderInfo']['DeliveryAddress']['RegionName'] = array();}
				$data3_obj = @$simplexml->Result->SalesOrderInfo->DeliveryAddress->RegionName;
				$data0['SalesOrderInfo']['DeliveryAddress']['RegionName'] = @(string)$data3_obj;
			$data0['SalesOrderInfo']['DeliveryAddress']['regionname'] = @$data0['SalesOrderInfo']['DeliveryAddress']['RegionName'];
		$data0['SalesOrderInfo']['deliveryaddress'] = @$data0['SalesOrderInfo']['DeliveryAddress'];
if(!isset($data0['SalesOrderInfo']['TaoBaoPrice'])){$data0['SalesOrderInfo']['TaoBaoPrice'] = array();}
			$data2_obj = @$simplexml->Result->SalesOrderInfo->TaoBaoPrice;
			$data0['SalesOrderInfo']['TaoBaoPrice'] = @$data2_obj;
		$data0['SalesOrderInfo']['taobaoprice'] = @$data0['SalesOrderInfo']['TaoBaoPrice'];
if(!isset($data0['SalesOrderInfo']['InternalDeliveryOriginalInExternalCurrency'])){$data0['SalesOrderInfo']['InternalDeliveryOriginalInExternalCurrency'] = array();}
			$data2_obj = @$simplexml->Result->SalesOrderInfo->InternalDeliveryOriginalInExternalCurrency;
			$data0['SalesOrderInfo']['InternalDeliveryOriginalInExternalCurrency'] = @$data2_obj;
		$data0['SalesOrderInfo']['internaldeliveryoriginalinexternalcurrency'] = @$data0['SalesOrderInfo']['InternalDeliveryOriginalInExternalCurrency'];
if(!isset($data0['SalesOrderInfo']['AdditionalInfo'])){$data0['SalesOrderInfo']['AdditionalInfo'] = array();}
			$data2_obj = @$simplexml->Result->SalesOrderInfo->AdditionalInfo;
			$data0['SalesOrderInfo']['AdditionalInfo'] = @(string)$data2_obj;
		$data0['SalesOrderInfo']['additionalinfo'] = @$data0['SalesOrderInfo']['AdditionalInfo'];
if(!isset($data0['SalesOrderInfo']['ExternalCurrencyCode'])){$data0['SalesOrderInfo']['ExternalCurrencyCode'] = array();}
			$data2_obj = @$simplexml->Result->SalesOrderInfo->ExternalCurrencyCode;
			$data0['SalesOrderInfo']['ExternalCurrencyCode'] = @(string)$data2_obj;
		$data0['SalesOrderInfo']['externalcurrencycode'] = @$data0['SalesOrderInfo']['ExternalCurrencyCode'];
if(!isset($data0['SalesOrderInfo']['ShipmentDate'])){$data0['SalesOrderInfo']['ShipmentDate'] = array();}
			$data2_obj = @$simplexml->Result->SalesOrderInfo->ShipmentDate;
			$data0['SalesOrderInfo']['ShipmentDate'] = @$data2_obj;
		$data0['SalesOrderInfo']['shipmentdate'] = @$data0['SalesOrderInfo']['ShipmentDate'];
if(!isset($data0['SalesOrderInfo']['TotalAmountOriginalInExternalCurrency'])){$data0['SalesOrderInfo']['TotalAmountOriginalInExternalCurrency'] = array();}
			$data2_obj = @$simplexml->Result->SalesOrderInfo->TotalAmountOriginalInExternalCurrency;
			$data0['SalesOrderInfo']['TotalAmountOriginalInExternalCurrency'] = @$data2_obj;
		$data0['SalesOrderInfo']['totalamountoriginalinexternalcurrency'] = @$data0['SalesOrderInfo']['TotalAmountOriginalInExternalCurrency'];
if(!isset($data0['SalesOrderInfo']['PackagePrices'])){$data0['SalesOrderInfo']['PackagePrices'] = array();}

	if(!isset($simplexml->Result->SalesOrderInfo->PackagePrices) || is_null($simplexml->Result->SalesOrderInfo->PackagePrices) || !$simplexml->Result->SalesOrderInfo->PackagePrices)			$data2_obj = @array();

	else
			$data2_obj = @$simplexml->Result->SalesOrderInfo->PackagePrices->children();
			$data0['SalesOrderInfo']['PackagePrices'] = @array();
			foreach($data2_obj as $value2){
				$data2_tmp = @array();
				$data2_tmp['Id'] = @(string)$value2->Id;
				$data2_tmp['id'] = @(string)$value2->Id;
				$data2_tmp['PriceInternal'] = @$value2->PriceInternal;
				$data2_tmp['priceinternal'] = @$value2->PriceInternal;
				$data2_tmp['AdditionalPriceInternal'] = @$value2->AdditionalPriceInternal;
				$data2_tmp['additionalpriceinternal'] = @$value2->AdditionalPriceInternal;
				$data2_tmp['AdditionalPrice'] = @$value2->AdditionalPrice;
				$data2_tmp['additionalprice'] = @$value2->AdditionalPrice;
				$data2_tmp['Price'] = @$value2->Price;
				$data2_tmp['price'] = @$value2->Price;
				$data2_tmp['PriceCurrencyCode'] = @(string)$value2->PriceCurrencyCode;
				$data2_tmp['pricecurrencycode'] = @(string)$value2->PriceCurrencyCode;
				$data2_tmp['PriceUpdateDate'] = @$value2->PriceUpdateDate;
				$data2_tmp['priceupdatedate'] = @$value2->PriceUpdateDate;
				$data0['SalesOrderInfo']['PackagePrices'][] = @$data2_tmp;
			}
		$data0['SalesOrderInfo']['packageprices'] = @$data0['SalesOrderInfo']['PackagePrices'];
if(!isset($data0['SalesOrderInfo']['LineStatusSummaries'])){$data0['SalesOrderInfo']['LineStatusSummaries'] = array();}

	if(!isset($simplexml->Result->SalesOrderInfo->LineStatusSummaries) || is_null($simplexml->Result->SalesOrderInfo->LineStatusSummaries) || !$simplexml->Result->SalesOrderInfo->LineStatusSummaries)			$data2_obj = @array();

	else
			$data2_obj = @$simplexml->Result->SalesOrderInfo->LineStatusSummaries->children();
			$data0['SalesOrderInfo']['LineStatusSummaries'] = @array();
			foreach($data2_obj as $value2){
				$data2_tmp = @array();
if(!isset($data2_tmp['Status'])){$data2_tmp['Status'] = array();}
				$data3_obj = @$value2->Status;
if(!isset($data2_tmp['Status']['Id'])){$data2_tmp['Status']['Id'] = array();}
					$data4_obj = @$value2->Status->Id;
					$data2_tmp['Status']['Id'] = @$data4_obj;
				$data2_tmp['Status']['id'] = @$data2_tmp['Status']['Id'];
if(!isset($data2_tmp['Status']['Name'])){$data2_tmp['Status']['Name'] = array();}
					$data4_obj = @$value2->Status->Name;
					$data2_tmp['Status']['Name'] = @(string)$data4_obj;
				$data2_tmp['Status']['name'] = @$data2_tmp['Status']['Name'];
				$data2_tmp['Count'] = @(int)$value2->Count;
				$data2_tmp['count'] = @(int)$value2->Count;
				$data0['SalesOrderInfo']['LineStatusSummaries'][] = @$data2_tmp;
			}
		$data0['SalesOrderInfo']['linestatussummaries'] = @$data0['SalesOrderInfo']['LineStatusSummaries'];
if(!isset($data0['SalesOrderInfo']['UserAccountAvailableAmount'])){$data0['SalesOrderInfo']['UserAccountAvailableAmount'] = array();}
			$data2_obj = @$simplexml->Result->SalesOrderInfo->UserAccountAvailableAmount;
			$data0['SalesOrderInfo']['UserAccountAvailableAmount'] = @$data2_obj;
		$data0['SalesOrderInfo']['useraccountavailableamount'] = @$data0['SalesOrderInfo']['UserAccountAvailableAmount'];
if(!isset($data0['SalesOrderInfo']['CreatedDateTime'])){$data0['SalesOrderInfo']['CreatedDateTime'] = array();}
			$data2_obj = @$simplexml->Result->SalesOrderInfo->CreatedDateTime;
			$data0['SalesOrderInfo']['CreatedDateTime'] = @(string)$data2_obj;
		$data0['SalesOrderInfo']['createddatetime'] = @$data0['SalesOrderInfo']['CreatedDateTime'];
if(!isset($data0['SalesOrderInfo']['UserLogin'])){$data0['SalesOrderInfo']['UserLogin'] = array();}
			$data2_obj = @$simplexml->Result->SalesOrderInfo->UserLogin;
			$data0['SalesOrderInfo']['UserLogin'] = @(string)$data2_obj;
		$data0['SalesOrderInfo']['userlogin'] = @$data0['SalesOrderInfo']['UserLogin'];
if(!isset($data0['SalesOrderInfo']['TotalOriginalCostList'])){$data0['SalesOrderInfo']['TotalOriginalCostList'] = array();}

	if(!isset($simplexml->Result->SalesOrderInfo->TotalOriginalCostList) || is_null($simplexml->Result->SalesOrderInfo->TotalOriginalCostList) || !$simplexml->Result->SalesOrderInfo->TotalOriginalCostList)			$data2_obj = @array();

	else
			$data2_obj = @$simplexml->Result->SalesOrderInfo->TotalOriginalCostList->children();
			$data0['SalesOrderInfo']['TotalOriginalCostList'] = @array();
			foreach($data2_obj as $value2){
				$data2_tmp = @array();
				$data2_tmp['CurrencyCode'] = @(string)$value2->CurrencyCode;
				$data2_tmp['currencycode'] = @(string)$value2->CurrencyCode;
				$data2_tmp['TotalCost'] = @$value2->TotalCost;
				$data2_tmp['totalcost'] = @$value2->TotalCost;
				$data2_tmp['TotalCostInInternalCurrency'] = @$value2->TotalCostInInternalCurrency;
				$data2_tmp['totalcostininternalcurrency'] = @$value2->TotalCostInInternalCurrency;
				$data0['SalesOrderInfo']['TotalOriginalCostList'][] = @$data2_tmp;
			}
		$data0['SalesOrderInfo']['totaloriginalcostlist'] = @$data0['SalesOrderInfo']['TotalOriginalCostList'];
if(!isset($data0['SalesOrderInfo']['PackageTotalCostPerCurrencyList'])){$data0['SalesOrderInfo']['PackageTotalCostPerCurrencyList'] = array();}

	if(!isset($simplexml->Result->SalesOrderInfo->PackageTotalCostPerCurrencyList) || is_null($simplexml->Result->SalesOrderInfo->PackageTotalCostPerCurrencyList) || !$simplexml->Result->SalesOrderInfo->PackageTotalCostPerCurrencyList)			$data2_obj = @array();

	else
			$data2_obj = @$simplexml->Result->SalesOrderInfo->PackageTotalCostPerCurrencyList->children();
			$data0['SalesOrderInfo']['PackageTotalCostPerCurrencyList'] = @array();
			foreach($data2_obj as $value2){
				$data2_tmp = @array();
				$data2_tmp['CurrencyCode'] = @(string)$value2->CurrencyCode;
				$data2_tmp['currencycode'] = @(string)$value2->CurrencyCode;
				$data2_tmp['TotalPrice'] = @$value2->TotalPrice;
				$data2_tmp['totalprice'] = @$value2->TotalPrice;
				$data2_tmp['TotalAdditionalPrice'] = @$value2->TotalAdditionalPrice;
				$data2_tmp['totaladditionalprice'] = @$value2->TotalAdditionalPrice;
				$data0['SalesOrderInfo']['PackageTotalCostPerCurrencyList'][] = @$data2_tmp;
			}
		$data0['SalesOrderInfo']['packagetotalcostpercurrencylist'] = @$data0['SalesOrderInfo']['PackageTotalCostPerCurrencyList'];
if(!isset($data0['SalesOrderInfo']['InternalDeliveryOriginalInInternalCurrency'])){$data0['SalesOrderInfo']['InternalDeliveryOriginalInInternalCurrency'] = array();}
			$data2_obj = @$simplexml->Result->SalesOrderInfo->InternalDeliveryOriginalInInternalCurrency;
			$data0['SalesOrderInfo']['InternalDeliveryOriginalInInternalCurrency'] = @$data2_obj;
		$data0['SalesOrderInfo']['internaldeliveryoriginalininternalcurrency'] = @$data0['SalesOrderInfo']['InternalDeliveryOriginalInInternalCurrency'];
if(!isset($data0['SalesOrderInfo']['InternalOriginalPrice'])){$data0['SalesOrderInfo']['InternalOriginalPrice'] = array();}
			$data2_obj = @$simplexml->Result->SalesOrderInfo->InternalOriginalPrice;
			$data0['SalesOrderInfo']['InternalOriginalPrice'] = @$data2_obj;
		$data0['SalesOrderInfo']['internaloriginalprice'] = @$data0['SalesOrderInfo']['InternalOriginalPrice'];
if(!isset($data0['SalesOrderInfo']['Profit'])){$data0['SalesOrderInfo']['Profit'] = array();}
			$data2_obj = @$simplexml->Result->SalesOrderInfo->Profit;
			$data0['SalesOrderInfo']['Profit'] = @$data2_obj;
		$data0['SalesOrderInfo']['profit'] = @$data0['SalesOrderInfo']['Profit'];
if(!isset($data0['SalesOrderInfo']['RateList'])){$data0['SalesOrderInfo']['RateList'] = array();}

	if(!isset($simplexml->Result->SalesOrderInfo->RateList) || is_null($simplexml->Result->SalesOrderInfo->RateList) || !$simplexml->Result->SalesOrderInfo->RateList)			$data2_obj = @array();

	else
			$data2_obj = @$simplexml->Result->SalesOrderInfo->RateList->children();
			$data0['SalesOrderInfo']['RateList'] = @array();
			foreach($data2_obj as $value2){
				$data0['SalesOrderInfo']['RateList'][] = @$value2;
			}
		$data0['SalesOrderInfo']['ratelist'] = @$data0['SalesOrderInfo']['RateList'];
	$data0['salesorderinfo'] = @$data0['SalesOrderInfo'];
if(!isset($data0['SalesLinesList'])){$data0['SalesLinesList'] = array();}

	if(!isset($simplexml->Result->SalesLinesList) || is_null($simplexml->Result->SalesLinesList) || !$simplexml->Result->SalesLinesList)		$data1_obj = @array();

	else
		$data1_obj = @$simplexml->Result->SalesLinesList->children();
		$data0['SalesLinesList'] = @array();
		foreach($data1_obj as $value1){
			$data1_tmp = @array();
			$data1_tmp['Id'] = @(string)$value1->Id;
			$data1_tmp['id'] = @(string)$value1->Id;
			$data1_tmp['ItemTaobaoId'] = @(string)$value1->ItemTaobaoId;
			$data1_tmp['itemtaobaoid'] = @(string)$value1->ItemTaobaoId;
			$data1_tmp['ItemId'] = @(string)$value1->ItemId;
			$data1_tmp['itemid'] = @(string)$value1->ItemId;
			$data1_tmp['ConfigText'] = @(string)$value1->ConfigText;
			$data1_tmp['configtext'] = @(string)$value1->ConfigText;
			$data1_tmp['ConfigId'] = @(string)$value1->ConfigId;
			$data1_tmp['configid'] = @(string)$value1->ConfigId;
			$data1_tmp['Qty'] = @(int)$value1->Qty;
			$data1_tmp['qty'] = @(int)$value1->Qty;
			$data1_tmp['NewPriceCust'] = @$value1->NewPriceCust;
			$data1_tmp['newpricecust'] = @$value1->NewPriceCust;
			$data1_tmp['PriceCust'] = @$value1->PriceCust;
			$data1_tmp['pricecust'] = @$value1->PriceCust;
			$data1_tmp['AmountCust'] = @$value1->AmountCust;
			$data1_tmp['amountcust'] = @$value1->AmountCust;
			$data1_tmp['CurrencyCust'] = @(string)$value1->CurrencyCust;
			$data1_tmp['currencycust'] = @(string)$value1->CurrencyCust;
			$data1_tmp['PriceInternal'] = @$value1->PriceInternal;
			$data1_tmp['priceinternal'] = @$value1->PriceInternal;
			$data1_tmp['AmountInternal'] = @$value1->AmountInternal;
			$data1_tmp['amountinternal'] = @$value1->AmountInternal;
			$data1_tmp['CurrencyInternal'] = @(string)$value1->CurrencyInternal;
			$data1_tmp['currencyinternal'] = @(string)$value1->CurrencyInternal;
			$data1_tmp['InternalPriceCurrencyCode'] = @(string)$value1->InternalPriceCurrencyCode;
			$data1_tmp['internalpricecurrencycode'] = @(string)$value1->InternalPriceCurrencyCode;
			$data1_tmp['PurchPriceCust'] = @$value1->PurchPriceCust;
			$data1_tmp['purchpricecust'] = @$value1->PurchPriceCust;
			$data1_tmp['PurchDeliveryCust'] = @$value1->PurchDeliveryCust;
			$data1_tmp['purchdeliverycust'] = @$value1->PurchDeliveryCust;
			$data1_tmp['PurchAmountCust'] = @$value1->PurchAmountCust;
			$data1_tmp['purchamountcust'] = @$value1->PurchAmountCust;
			$data1_tmp['PurchPrice'] = @$value1->PurchPrice;
			$data1_tmp['purchprice'] = @$value1->PurchPrice;
			$data1_tmp['PurchDelivery'] = @$value1->PurchDelivery;
			$data1_tmp['purchdelivery'] = @$value1->PurchDelivery;
			$data1_tmp['PurchAmount'] = @$value1->PurchAmount;
			$data1_tmp['purchamount'] = @$value1->PurchAmount;
			$data1_tmp['PurchCurrency'] = @(string)$value1->PurchCurrency;
			$data1_tmp['purchcurrency'] = @(string)$value1->PurchCurrency;
			$data1_tmp['BriefDescrTrans'] = @(string)$value1->BriefDescrTrans;
			$data1_tmp['briefdescrtrans'] = @(string)$value1->BriefDescrTrans;
			$data1_tmp['ItemImageURL'] = @(string)$value1->ItemImageURL;
			$data1_tmp['itemimageurl'] = @(string)$value1->ItemImageURL;
			$data1_tmp['ItemExternalURL'] = @(string)$value1->ItemExternalURL;
			$data1_tmp['itemexternalurl'] = @(string)$value1->ItemExternalURL;
			$data1_tmp['VendNick'] = @(string)$value1->VendNick;
			$data1_tmp['vendnick'] = @(string)$value1->VendNick;
			$data1_tmp['VendId'] = @(string)$value1->VendId;
			$data1_tmp['vendid'] = @(string)$value1->VendId;
			$data1_tmp['CustComment'] = @(string)$value1->CustComment;
			$data1_tmp['custcomment'] = @(string)$value1->CustComment;
			$data1_tmp['OperatorComment'] = @(string)$value1->OperatorComment;
			$data1_tmp['operatorcomment'] = @(string)$value1->OperatorComment;
			$data1_tmp['StatusCode'] = @$value1->StatusCode;
			$data1_tmp['statuscode'] = @$value1->StatusCode;
			$data1_tmp['StatusId'] = @(int)$value1->StatusId;
			$data1_tmp['statusid'] = @(int)$value1->StatusId;
			$data1_tmp['StatusName'] = @(string)$value1->StatusName;
			$data1_tmp['statusname'] = @(string)$value1->StatusName;
			$data1_tmp['SubSalesNum'] = @(string)$value1->SubSalesNum;
			$data1_tmp['subsalesnum'] = @(string)$value1->SubSalesNum;
			$data1_tmp['SubSalesDate'] = @(string)$value1->SubSalesDate;
			$data1_tmp['subsalesdate'] = @(string)$value1->SubSalesDate;
			$data1_tmp['SubSalesTime'] = @(string)$value1->SubSalesTime;
			$data1_tmp['subsalestime'] = @(string)$value1->SubSalesTime;
			$data1_tmp['VendPurchId'] = @(string)$value1->VendPurchId;
			$data1_tmp['vendpurchid'] = @(string)$value1->VendPurchId;
			$data1_tmp['VendPurchWaybill'] = @(string)$value1->VendPurchWaybill;
			$data1_tmp['vendpurchwaybill'] = @(string)$value1->VendPurchWaybill;
			$data1_tmp['TaoBaoDelivery'] = @$value1->TaoBaoDelivery;
			$data1_tmp['taobaodelivery'] = @$value1->TaoBaoDelivery;
			$data1_tmp['TaoBaoPrice'] = @$value1->TaoBaoPrice;
			$data1_tmp['taobaoprice'] = @$value1->TaoBaoPrice;
			$data1_tmp['InternalOriginalPrice'] = @$value1->InternalOriginalPrice;
			$data1_tmp['internaloriginalprice'] = @$value1->InternalOriginalPrice;
			$data1_tmp['InternalDeliveryPrice'] = @$value1->InternalDeliveryPrice;
			$data1_tmp['internaldeliveryprice'] = @$value1->InternalDeliveryPrice;
			$data1_tmp['PromotionId'] = @(string)$value1->PromotionId;
			$data1_tmp['promotionid'] = @(string)$value1->PromotionId;
			$data1_tmp['PriceWithoutDelivery'] = @(string)$value1->PriceWithoutDelivery;
			$data1_tmp['pricewithoutdelivery'] = @(string)$value1->PriceWithoutDelivery;
			$data1_tmp['CategoryId'] = @(string)$value1->CategoryId;
			$data1_tmp['categoryid'] = @(string)$value1->CategoryId;
			$data1_tmp['VendURL'] = @(string)$value1->VendURL;
			$data1_tmp['vendurl'] = @(string)$value1->VendURL;
			$data1_tmp['QtyOrig'] = @(string)$value1->QtyOrig;
			$data1_tmp['qtyorig'] = @(string)$value1->QtyOrig;
			$data1_tmp['LineNum'] = @(int)$value1->LineNum;
			$data1_tmp['linenum'] = @(int)$value1->LineNum;
if(!isset($data1_tmp['AvailableStatusList'])){$data1_tmp['AvailableStatusList'] = array();}

	if(!isset($value1->AvailableStatusList) || is_null($value1->AvailableStatusList) || !$value1->AvailableStatusList)			$data2_obj = @array();

	else
			$data2_obj = @$value1->AvailableStatusList->children();
			$data1_tmp['AvailableStatusList'] = @array();
			foreach($data2_obj as $value2){
				$data2_tmp = @array();
				$data2_tmp['Id'] = @(int)$value2->Id;
				$data2_tmp['id'] = @(int)$value2->Id;
				$data2_tmp['Name'] = @(string)$value2->Name;
				$data2_tmp['name'] = @(string)$value2->Name;
				$data1_tmp['AvailableStatusList'][] = @$data2_tmp;
			}
			$data1_tmp['NameOrig'] = @(string)$value1->NameOrig;
			$data1_tmp['nameorig'] = @(string)$value1->NameOrig;
			$data1_tmp['ConfigExternalTextOrig'] = @(string)$value1->ConfigExternalTextOrig;
			$data1_tmp['configexternaltextorig'] = @(string)$value1->ConfigExternalTextOrig;
			$data1_tmp['Weight'] = @$value1->Weight;
			$data1_tmp['weight'] = @$value1->Weight;
			$data0['SalesLinesList'][] = @$data1_tmp;
		}
	$data0['saleslineslist'] = @$data0['SalesLinesList'];
	return $data0;
    }
    public function CancelSalesOrderForOperator($sessionId, $salesId){
        $params = array(
            'sessionId' => $sessionId,
	    'salesId' => $salesId
        );
        $params += $this->defaultLogin();
        $simplexml = $this->_getData('CancelSalesOrderForOperator', $params);
        if (!$simplexml) return false;
        
        $data0 = array();
        
if(!isset($data0)){$data0 = array();}
	$data0_obj = @$simplexml;
	$data0 = @$data0_obj;
	return $data0;
    }
    public function CloseSalesOrderForOperator($sessionId, $salesId){
        $params = array(
            'sessionId' => $sessionId,
	    'salesId' => $salesId
        );
        $params += $this->defaultLogin();
        $simplexml = $this->_getData('CloseSalesOrderForOperator', $params);
        if (!$simplexml) return false;
        
        $data0 = array();
        
if(!isset($data0)){$data0 = array();}
	$data0_obj = @$simplexml;
	$data0 = @$data0_obj;
	return $data0;
    }
    public function CloseCancelSalesOrderForOperator($sessionId, $salesId){
        $params = array(
            'sessionId' => $sessionId,
	    'salesId' => $salesId
        );
        $params += $this->defaultLogin();
        $simplexml = $this->_getData('CloseCancelSalesOrderForOperator', $params);
        if (!$simplexml) return false;
        
        $data0 = array();
        
if(!isset($data0)){$data0 = array();}
	$data0_obj = @$simplexml;
	$data0 = @$data0_obj;
	return $data0;
    }
    public function RestoreLineSalesOrderForOperator($sessionId, $salesId, $salesLineId){
        $params = array(
            'sessionId' => $sessionId,
	    'salesId' => $salesId,
	    'salesLineId' => $salesLineId
        );
        $params += $this->defaultLogin();
        $simplexml = $this->_getData('RestoreLineSalesOrderForOperator', $params);
        if (!$simplexml) return false;
        
        $data0 = array();
        
if(!isset($data0)){$data0 = array();}
	$data0_obj = @$simplexml;
	$data0 = @$data0_obj;
	return $data0;
    }
    public function CancelLineSalesOrderForOperator($sessionId, $salesId, $salesLineId){
        $params = array(
            'sessionId' => $sessionId,
	    'salesId' => $salesId,
	    'salesLineId' => $salesLineId
        );
        $params += $this->defaultLogin();
        $simplexml = $this->_getData('CancelLineSalesOrderForOperator', $params);
        if (!$simplexml) return false;
        
        $data0 = array();
        
if(!isset($data0)){$data0 = array();}
	$data0_obj = @$simplexml;
	$data0 = @$data0_obj;
	return $data0;
    }
    public function ChangeLineStatus($sessionId, $salesId, $salesLineId, $statusId, $comment, $quantity){
        $params = array(
            'sessionId' => $sessionId,
	    'salesId' => $salesId,
	    'salesLineId' => $salesLineId,
	    'statusId' => $statusId,
	    'comment' => $comment,
	    'quantity' => $quantity
        );
        $params += $this->defaultLogin();
        $simplexml = $this->_getData('ChangeLineStatus', $params);
        if (!$simplexml) return false;
        
        $data0 = array();
        
if(!isset($data0)){$data0 = array();}
	$data0_obj = @$simplexml;
	$data0 = @$data0_obj;
	return $data0;
    }
    public function GetLineAvailableStatusList($sessionId, $salesId, $salesLineId){
        $params = array(
            'sessionId' => $sessionId,
	    'salesId' => $salesId,
	    'salesLineId' => $salesLineId
        );
        $params += $this->defaultLogin();
        $simplexml = $this->_getData('GetLineAvailableStatusList', $params);
        if (!$simplexml) return false;
        
        $data0 = array();
        
if(!isset($data0)){$data0 = array();}

	if(!isset($simplexml->Result) || is_null($simplexml->Result) || !$simplexml->Result)	$data0_obj = @array();

	else
	$data0_obj = @$simplexml->Result->children();
	$data0 = @array();
	foreach($data0_obj as $value0){
		$data0_tmp = @array();
		$data0_tmp['Id'] = @(int)$value0->Id;
		$data0_tmp['id'] = @(int)$value0->Id;
		$data0_tmp['Name'] = @(string)$value0->Name;
		$data0_tmp['name'] = @(string)$value0->Name;
		$data0[] = @$data0_tmp;
	}
	return $data0;
    }
    public function GetSalesProcessLog($sessionId, $salesId){
        $params = array(
            'sessionId' => $sessionId,
	    'salesId' => $salesId
        );
        $params += $this->defaultLogin();
        $simplexml = $this->_getData('GetSalesProcessLog', $params);
        if (!$simplexml) return false;
        
        $data0 = array();
        
if(!isset($data0)){$data0 = array();}

	if(!isset($simplexml->Result) || is_null($simplexml->Result) || !$simplexml->Result)	$data0_obj = @array();

	else
	$data0_obj = @$simplexml->Result->children();
	$data0 = @array();
	foreach($data0_obj as $value0){
		$data0_tmp = @array();
		$data0_tmp['LogDate'] = @(string)$value0->LogDate;
		$data0_tmp['logdate'] = @(string)$value0->LogDate;
		$data0_tmp['LogTime'] = @(string)$value0->LogTime;
		$data0_tmp['logtime'] = @(string)$value0->LogTime;
		$data0_tmp['OperatorId'] = @(string)$value0->OperatorId;
		$data0_tmp['operatorid'] = @(string)$value0->OperatorId;
		$data0_tmp['CustId'] = @(string)$value0->CustId;
		$data0_tmp['custid'] = @(string)$value0->CustId;
		$data0_tmp['OperatorName'] = @(string)$value0->OperatorName;
		$data0_tmp['operatorname'] = @(string)$value0->OperatorName;
		$data0_tmp['CustName'] = @(string)$value0->CustName;
		$data0_tmp['custname'] = @(string)$value0->CustName;
		$data0_tmp['FieldName'] = @(string)$value0->FieldName;
		$data0_tmp['fieldname'] = @(string)$value0->FieldName;
		$data0_tmp['PrevValue'] = @(string)$value0->PrevValue;
		$data0_tmp['prevvalue'] = @(string)$value0->PrevValue;
		$data0_tmp['NewValue'] = @(string)$value0->NewValue;
		$data0_tmp['newvalue'] = @(string)$value0->NewValue;
		$data0[] = @$data0_tmp;
	}
	return $data0;
    }
    public function GetSaleLineProcessLog($sessionId, $salesId, $salesLineId){
        $params = array(
            'sessionId' => $sessionId,
	    'salesId' => $salesId,
	    'salesLineId' => $salesLineId
        );
        $params += $this->defaultLogin();
        $simplexml = $this->_getData('GetSaleLineProcessLog', $params);
        if (!$simplexml) return false;
        
        $data0 = array();
        
if(!isset($data0)){$data0 = array();}

	if(!isset($simplexml->Result) || is_null($simplexml->Result) || !$simplexml->Result)	$data0_obj = @array();

	else
	$data0_obj = @$simplexml->Result->children();
	$data0 = @array();
	foreach($data0_obj as $value0){
		$data0_tmp = @array();
		$data0_tmp['LogDate'] = @(string)$value0->LogDate;
		$data0_tmp['logdate'] = @(string)$value0->LogDate;
		$data0_tmp['LogTime'] = @(string)$value0->LogTime;
		$data0_tmp['logtime'] = @(string)$value0->LogTime;
		$data0_tmp['OperatorId'] = @(string)$value0->OperatorId;
		$data0_tmp['operatorid'] = @(string)$value0->OperatorId;
		$data0_tmp['CustId'] = @(string)$value0->CustId;
		$data0_tmp['custid'] = @(string)$value0->CustId;
		$data0_tmp['OperatorName'] = @(string)$value0->OperatorName;
		$data0_tmp['operatorname'] = @(string)$value0->OperatorName;
		$data0_tmp['CustName'] = @(string)$value0->CustName;
		$data0_tmp['custname'] = @(string)$value0->CustName;
		$data0_tmp['FieldName'] = @(string)$value0->FieldName;
		$data0_tmp['fieldname'] = @(string)$value0->FieldName;
		$data0_tmp['PrevValue'] = @(string)$value0->PrevValue;
		$data0_tmp['prevvalue'] = @(string)$value0->PrevValue;
		$data0_tmp['NewValue'] = @(string)$value0->NewValue;
		$data0_tmp['newvalue'] = @(string)$value0->NewValue;
		$data0[] = @$data0_tmp;
	}
	return $data0;
    }
    public function PurchaseItems($sessionId, $saleLineList){
        $params = array(
            'sessionId' => $sessionId,
	    'saleLineList' => $saleLineList
        );
        $params += $this->defaultLogin();
        $simplexml = $this->_getData('PurchaseItems', $params);
        if (!$simplexml) return false;
        
        $data0 = array();
        
if(!isset($data0)){$data0 = array();}
	$data0_obj = @$simplexml;
	$data0 = @$data0_obj;
	return $data0;
    }
    public function GetSalesPaymentInfo($sessionId, $salesId){
        $params = array(
            'sessionId' => $sessionId,
	    'salesId' => $salesId
        );
        $params += $this->defaultLogin();
        $simplexml = $this->_getData('GetSalesPaymentInfo', $params);
        if (!$simplexml) return false;
        
        $data0 = array();
        
if(!isset($data0)){$data0 = array();}
	$data0_obj = @$simplexml->Result;
if(!isset($data0['SalesId'])){$data0['SalesId'] = array();}
		$data1_obj = @$simplexml->Result->SalesId;
		$data0['SalesId'] = @(string)$data1_obj;
	$data0['salesid'] = @$data0['SalesId'];
if(!isset($data0['CusId'])){$data0['CusId'] = array();}
		$data1_obj = @$simplexml->Result->CusId;
		$data0['CusId'] = @(string)$data1_obj;
	$data0['cusid'] = @$data0['CusId'];
if(!isset($data0['CustBalanceAvail'])){$data0['CustBalanceAvail'] = array();}
		$data1_obj = @$simplexml->Result->CustBalanceAvail;
		$data0['CustBalanceAvail'] = @$data1_obj;
	$data0['custbalanceavail'] = @$data0['CustBalanceAvail'];
if(!isset($data0['SalesAmount'])){$data0['SalesAmount'] = array();}
		$data1_obj = @$simplexml->Result->SalesAmount;
		$data0['SalesAmount'] = @$data1_obj;
	$data0['salesamount'] = @$data0['SalesAmount'];
if(!isset($data0['SalesPaid'])){$data0['SalesPaid'] = array();}
		$data1_obj = @$simplexml->Result->SalesPaid;
		$data0['SalesPaid'] = @$data1_obj;
	$data0['salespaid'] = @$data0['SalesPaid'];
if(!isset($data0['CurrencyCode'])){$data0['CurrencyCode'] = array();}
		$data1_obj = @$simplexml->Result->CurrencyCode;
		$data0['CurrencyCode'] = @(string)$data1_obj;
	$data0['currencycode'] = @$data0['CurrencyCode'];
	return $data0;
    }
    public function SalesPaymentReserve($sessionId, $salesId, $amount){
        $params = array(
            'sessionId' => $sessionId,
	    'salesId' => $salesId,
	    'amount' => $amount
        );
        $params += $this->defaultLogin();
        $simplexml = $this->_getData('SalesPaymentReserve', $params);
        if (!$simplexml) return false;
        
        $data0 = array();
        
if(!isset($data0)){$data0 = array();}
	$data0_obj = @$simplexml->Result;
if(!isset($data0['SalesId'])){$data0['SalesId'] = array();}
		$data1_obj = @$simplexml->Result->SalesId;
		$data0['SalesId'] = @(string)$data1_obj;
	$data0['salesid'] = @$data0['SalesId'];
if(!isset($data0['CusId'])){$data0['CusId'] = array();}
		$data1_obj = @$simplexml->Result->CusId;
		$data0['CusId'] = @(string)$data1_obj;
	$data0['cusid'] = @$data0['CusId'];
if(!isset($data0['CustBalanceAvail'])){$data0['CustBalanceAvail'] = array();}
		$data1_obj = @$simplexml->Result->CustBalanceAvail;
		$data0['CustBalanceAvail'] = @$data1_obj;
	$data0['custbalanceavail'] = @$data0['CustBalanceAvail'];
if(!isset($data0['SalesAmount'])){$data0['SalesAmount'] = array();}
		$data1_obj = @$simplexml->Result->SalesAmount;
		$data0['SalesAmount'] = @$data1_obj;
	$data0['salesamount'] = @$data0['SalesAmount'];
if(!isset($data0['SalesPaid'])){$data0['SalesPaid'] = array();}
		$data1_obj = @$simplexml->Result->SalesPaid;
		$data0['SalesPaid'] = @$data1_obj;
	$data0['salespaid'] = @$data0['SalesPaid'];
if(!isset($data0['CurrencyCode'])){$data0['CurrencyCode'] = array();}
		$data1_obj = @$simplexml->Result->CurrencyCode;
		$data0['CurrencyCode'] = @(string)$data1_obj;
	$data0['currencycode'] = @$data0['CurrencyCode'];
	return $data0;
    }
    public function GetOrderStatusList($sessionId){
        $params = array(
            'sessionId' => $sessionId
        );
        $params += $this->defaultLogin();
        $simplexml = $this->_getData('GetOrderStatusList', $params);
        if (!$simplexml) return false;
        
        $data0 = array();
        
if(!isset($data0)){$data0 = array();}

	if(!isset($simplexml->Result) || is_null($simplexml->Result) || !$simplexml->Result)	$data0_obj = @array();

	else
	$data0_obj = @$simplexml->Result->children();
	$data0 = @array();
	foreach($data0_obj as $value0){
		$data0_tmp = @array();
		$data0_tmp['Id'] = @(int)$value0->Id;
		$data0_tmp['id'] = @(int)$value0->Id;
		$data0_tmp['Name'] = @(string)$value0->Name;
		$data0_tmp['name'] = @(string)$value0->Name;
		$data0[] = @$data0_tmp;
	}
	return $data0;
    }
    public function ChangeSalesOrderLinePurchaseInfoForOperator($sessionId, $salesId, $salesLineId, $vendPurchId, $vendPurchWaybill){
        $params = array(
            'sessionId' => $sessionId,
	    'salesId' => $salesId,
	    'salesLineId' => $salesLineId,
	    'vendPurchId' => $vendPurchId,
	    'vendPurchWaybill' => $vendPurchWaybill
        );
        $params += $this->defaultLogin();
        $simplexml = $this->_getData('ChangeSalesOrderLinePurchaseInfoForOperator', $params);
        if (!$simplexml) return false;
        
        $data0 = array();
        
if(!isset($data0)){$data0 = array();}
	$data0_obj = @$simplexml;
	$data0 = @$data0_obj;
	return $data0;
    }
    public function UpdateOrderLineForOperator($sessionId, $orderId, $orderLineId, $xmlUpdateData){
        $params = array(
            'sessionId' => $sessionId,
	    'orderId' => $orderId,
	    'orderLineId' => $orderLineId,
	    'xmlUpdateData' => $xmlUpdateData
        );
        $params += $this->defaultLogin();
        $simplexml = $this->_getData('UpdateOrderLineForOperator', $params);
        if (!$simplexml) return false;
        
        $data0 = array();
        
if(!isset($data0)){$data0 = array();}
	$data0_obj = @$simplexml;
	$data0 = @$data0_obj;
	return $data0;
    }
    public function UpdateOrderLinesForOperator($sessionId, $orderId, $orderLineIds, $xmlUpdateData){
        $params = array(
            'sessionId' => $sessionId,
	    'orderId' => $orderId,
	    'orderLineIds' => $orderLineIds,
	    'xmlUpdateData' => $xmlUpdateData
        );
        $params += $this->defaultLogin();
        $simplexml = $this->_getData('UpdateOrderLinesForOperator', $params);
        if (!$simplexml) return false;
        
        $data0 = array();
        
if(!isset($data0)){$data0 = array();}
	$data0_obj = @$simplexml;
	$data0 = @$data0_obj;
	return $data0;
    }
    public function SplitOrderLineForOperator($sessionId, $orderId, $orderLineId, $xmlSplitData){
        $params = array(
            'sessionId' => $sessionId,
	    'orderId' => $orderId,
	    'orderLineId' => $orderLineId,
	    'xmlSplitData' => $xmlSplitData
        );
        $params += $this->defaultLogin();
        $simplexml = $this->_getData('SplitOrderLineForOperator', $params);
        if (!$simplexml) return false;
        
        $data0 = array();
        
if(!isset($data0)){$data0 = array();}
	$data0_obj = @$simplexml;
	$data0 = @$data0_obj;
	return $data0;
    }
    public function UpdateOrderForOperator($sessionId, $orderId, $xmlUpdateData){
        $params = array(
            'sessionId' => $sessionId,
	    'orderId' => $orderId,
	    'xmlUpdateData' => $xmlUpdateData
        );
        $params += $this->defaultLogin();
        $simplexml = $this->_getData('UpdateOrderForOperator', $params);
        if (!$simplexml) return false;
        
        $data0 = array();
        
if(!isset($data0)){$data0 = array();}
	$data0_obj = @$simplexml;
	$data0 = @$data0_obj;
	return $data0;
    }
    public function SearchOrders($sessionId, $xmlSearchParameters, $framePosition = 0, $frameSize = 18){
        $params = array(
            'sessionId' => $sessionId,
	    'xmlSearchParameters' => $xmlSearchParameters,
	    'framePosition' => $framePosition,
	    'frameSize' => $frameSize
        );
        $params += $this->defaultLogin();
        $simplexml = $this->_getData('SearchOrders', $params);
        if (!$simplexml) return false;
        
        $data0 = array();
        
if(!isset($data0)){$data0 = array();}
	$data0_obj = @$simplexml->Result;
if(!isset($data0['Content'])){$data0['Content'] = array();}

	if(!isset($simplexml->Result->Content) || is_null($simplexml->Result->Content) || !$simplexml->Result->Content)		$data1_obj = @array();

	else
		$data1_obj = @$simplexml->Result->Content->children();
		$data0['Content'] = @array();
		foreach($data1_obj as $value1){
			$data1_tmp = @array();
			$data1_tmp['Id'] = @(string)$value1->Id;
			$data1_tmp['id'] = @(string)$value1->Id;
			$data1_tmp['StatusCode'] = @(string)$value1->StatusCode;
			$data1_tmp['statuscode'] = @(string)$value1->StatusCode;
			$data1_tmp['StatusName'] = @(string)$value1->StatusName;
			$data1_tmp['statusname'] = @(string)$value1->StatusName;
			$data1_tmp['SubstatusCode'] = @(string)$value1->SubstatusCode;
			$data1_tmp['substatuscode'] = @(string)$value1->SubstatusCode;
			$data1_tmp['SubstatusName'] = @(string)$value1->SubstatusName;
			$data1_tmp['substatusname'] = @(string)$value1->SubstatusName;
			$data1_tmp['OperatorId'] = @(string)$value1->OperatorId;
			$data1_tmp['operatorid'] = @(string)$value1->OperatorId;
			$data1_tmp['OperatorName'] = @(string)$value1->OperatorName;
			$data1_tmp['operatorname'] = @(string)$value1->OperatorName;
			$data1_tmp['ItemsCount'] = @$value1->ItemsCount;
			$data1_tmp['itemscount'] = @$value1->ItemsCount;
			$data1_tmp['GoodsAmount'] = @$value1->GoodsAmount;
			$data1_tmp['goodsamount'] = @$value1->GoodsAmount;
			$data1_tmp['DeliveryAmount'] = @$value1->DeliveryAmount;
			$data1_tmp['deliveryamount'] = @$value1->DeliveryAmount;
			$data1_tmp['TotalAmount'] = @$value1->TotalAmount;
			$data1_tmp['totalamount'] = @$value1->TotalAmount;
			$data1_tmp['RemainAmount'] = @$value1->RemainAmount;
			$data1_tmp['remainamount'] = @$value1->RemainAmount;
			$data1_tmp['CurrencySign'] = @(string)$value1->CurrencySign;
			$data1_tmp['currencysign'] = @(string)$value1->CurrencySign;
			$data1_tmp['CurrencyCode'] = @(string)$value1->CurrencyCode;
			$data1_tmp['currencycode'] = @(string)$value1->CurrencyCode;
			$data1_tmp['GoodsAmountInternal'] = @$value1->GoodsAmountInternal;
			$data1_tmp['goodsamountinternal'] = @$value1->GoodsAmountInternal;
			$data1_tmp['DeliveryAmountInternal'] = @$value1->DeliveryAmountInternal;
			$data1_tmp['deliveryamountinternal'] = @$value1->DeliveryAmountInternal;
			$data1_tmp['TotalAmountInternal'] = @$value1->TotalAmountInternal;
			$data1_tmp['totalamountinternal'] = @$value1->TotalAmountInternal;
			$data1_tmp['RemainAmountInternal'] = @$value1->RemainAmountInternal;
			$data1_tmp['remainamountinternal'] = @$value1->RemainAmountInternal;
			$data1_tmp['CurrencySignInternal'] = @(string)$value1->CurrencySignInternal;
			$data1_tmp['currencysigninternal'] = @(string)$value1->CurrencySignInternal;
			$data1_tmp['CurrencyCodeInternal'] = @(string)$value1->CurrencyCodeInternal;
			$data1_tmp['currencycodeinternal'] = @(string)$value1->CurrencyCodeInternal;
			$data1_tmp['CustComment'] = @(string)$value1->CustComment;
			$data1_tmp['custcomment'] = @(string)$value1->CustComment;
			$data1_tmp['DeliveryModeId'] = @(string)$value1->DeliveryModeId;
			$data1_tmp['deliverymodeid'] = @(string)$value1->DeliveryModeId;
			$data1_tmp['DeliveryModeName'] = @(string)$value1->DeliveryModeName;
			$data1_tmp['deliverymodename'] = @(string)$value1->DeliveryModeName;
			$data1_tmp['CanCancel'] = @(int)$value1->CanCancel;
			$data1_tmp['cancancel'] = @(int)$value1->CanCancel;
			$data1_tmp['CanConfirmShipment'] = @(int)$value1->CanConfirmShipment;
			$data1_tmp['canconfirmshipment'] = @(int)$value1->CanConfirmShipment;
			$data1_tmp['CanChangeAddress'] = @(int)$value1->CanChangeAddress;
			$data1_tmp['canchangeaddress'] = @(int)$value1->CanChangeAddress;
			$data1_tmp['AdminInfoText'] = @(string)$value1->AdminInfoText;
			$data1_tmp['admininfotext'] = @(string)$value1->AdminInfoText;
			$data1_tmp['AdminAlertText'] = @(string)$value1->AdminAlertText;
			$data1_tmp['adminalerttext'] = @(string)$value1->AdminAlertText;
			$data1_tmp['PaidAmount'] = @$value1->PaidAmount;
			$data1_tmp['paidamount'] = @$value1->PaidAmount;
			$data1_tmp['PaidAmountInternal'] = @$value1->PaidAmountInternal;
			$data1_tmp['paidamountinternal'] = @$value1->PaidAmountInternal;
			$data1_tmp['CanRestore'] = @(int)$value1->CanRestore;
			$data1_tmp['canrestore'] = @(int)$value1->CanRestore;
			$data1_tmp['CanClose'] = @(int)$value1->CanClose;
			$data1_tmp['canclose'] = @(int)$value1->CanClose;
			$data1_tmp['CanCloseCancel'] = @(int)$value1->CanCloseCancel;
			$data1_tmp['canclosecancel'] = @(int)$value1->CanCloseCancel;
			$data1_tmp['CanAccept'] = @(int)$value1->CanAccept;
			$data1_tmp['canaccept'] = @(int)$value1->CanAccept;
			$data1_tmp['CanPurchaseItems'] = @(int)$value1->CanPurchaseItems;
			$data1_tmp['canpurchaseitems'] = @(int)$value1->CanPurchaseItems;
			$data1_tmp['PackagesWeight'] = @(int)$value1->PackagesWeight;
			$data1_tmp['packagesweight'] = @(int)$value1->PackagesWeight;
			$data1_tmp['EstimatedWeight'] = @(int)$value1->EstimatedWeight;
			$data1_tmp['estimatedweight'] = @(int)$value1->EstimatedWeight;
			$data1_tmp['CustId'] = @(string)$value1->CustId;
			$data1_tmp['custid'] = @(string)$value1->CustId;
			$data1_tmp['CustName'] = @(string)$value1->CustName;
			$data1_tmp['custname'] = @(string)$value1->CustName;
			$data1_tmp['StatusId'] = @(int)$value1->StatusId;
			$data1_tmp['statusid'] = @(int)$value1->StatusId;
			$data1_tmp['Weight'] = @$value1->Weight;
			$data1_tmp['weight'] = @$value1->Weight;
if(!isset($data1_tmp['DeliveryAddress'])){$data1_tmp['DeliveryAddress'] = array();}
			$data2_obj = @$value1->DeliveryAddress;
if(!isset($data1_tmp['DeliveryAddress']['Id'])){$data1_tmp['DeliveryAddress']['Id'] = array();}
				$data3_obj = @$value1->DeliveryAddress->Id;
				$data1_tmp['DeliveryAddress']['Id'] = @(string)$data3_obj;
			$data1_tmp['DeliveryAddress']['id'] = @$data1_tmp['DeliveryAddress']['Id'];
if(!isset($data1_tmp['DeliveryAddress']['Familyname'])){$data1_tmp['DeliveryAddress']['Familyname'] = array();}
				$data3_obj = @$value1->DeliveryAddress->Familyname;
				$data1_tmp['DeliveryAddress']['Familyname'] = @(string)$data3_obj;
			$data1_tmp['DeliveryAddress']['familyname'] = @$data1_tmp['DeliveryAddress']['Familyname'];
if(!isset($data1_tmp['DeliveryAddress']['Name'])){$data1_tmp['DeliveryAddress']['Name'] = array();}
				$data3_obj = @$value1->DeliveryAddress->Name;
				$data1_tmp['DeliveryAddress']['Name'] = @(string)$data3_obj;
			$data1_tmp['DeliveryAddress']['name'] = @$data1_tmp['DeliveryAddress']['Name'];
if(!isset($data1_tmp['DeliveryAddress']['Patername'])){$data1_tmp['DeliveryAddress']['Patername'] = array();}
				$data3_obj = @$value1->DeliveryAddress->Patername;
				$data1_tmp['DeliveryAddress']['Patername'] = @(string)$data3_obj;
			$data1_tmp['DeliveryAddress']['patername'] = @$data1_tmp['DeliveryAddress']['Patername'];
if(!isset($data1_tmp['DeliveryAddress']['CountryCode'])){$data1_tmp['DeliveryAddress']['CountryCode'] = array();}
				$data3_obj = @$value1->DeliveryAddress->CountryCode;
				$data1_tmp['DeliveryAddress']['CountryCode'] = @(string)$data3_obj;
			$data1_tmp['DeliveryAddress']['countrycode'] = @$data1_tmp['DeliveryAddress']['CountryCode'];
if(!isset($data1_tmp['DeliveryAddress']['Country'])){$data1_tmp['DeliveryAddress']['Country'] = array();}
				$data3_obj = @$value1->DeliveryAddress->Country;
				$data1_tmp['DeliveryAddress']['Country'] = @(string)$data3_obj;
			$data1_tmp['DeliveryAddress']['country'] = @$data1_tmp['DeliveryAddress']['Country'];
if(!isset($data1_tmp['DeliveryAddress']['City'])){$data1_tmp['DeliveryAddress']['City'] = array();}
				$data3_obj = @$value1->DeliveryAddress->City;
				$data1_tmp['DeliveryAddress']['City'] = @(string)$data3_obj;
			$data1_tmp['DeliveryAddress']['city'] = @$data1_tmp['DeliveryAddress']['City'];
if(!isset($data1_tmp['DeliveryAddress']['Address'])){$data1_tmp['DeliveryAddress']['Address'] = array();}
				$data3_obj = @$value1->DeliveryAddress->Address;
				$data1_tmp['DeliveryAddress']['Address'] = @(string)$data3_obj;
			$data1_tmp['DeliveryAddress']['address'] = @$data1_tmp['DeliveryAddress']['Address'];
if(!isset($data1_tmp['DeliveryAddress']['Phone'])){$data1_tmp['DeliveryAddress']['Phone'] = array();}
				$data3_obj = @$value1->DeliveryAddress->Phone;
				$data1_tmp['DeliveryAddress']['Phone'] = @(string)$data3_obj;
			$data1_tmp['DeliveryAddress']['phone'] = @$data1_tmp['DeliveryAddress']['Phone'];
if(!isset($data1_tmp['DeliveryAddress']['PostalCode'])){$data1_tmp['DeliveryAddress']['PostalCode'] = array();}
				$data3_obj = @$value1->DeliveryAddress->PostalCode;
				$data1_tmp['DeliveryAddress']['PostalCode'] = @(string)$data3_obj;
			$data1_tmp['DeliveryAddress']['postalcode'] = @$data1_tmp['DeliveryAddress']['PostalCode'];
if(!isset($data1_tmp['DeliveryAddress']['RegionName'])){$data1_tmp['DeliveryAddress']['RegionName'] = array();}
				$data3_obj = @$value1->DeliveryAddress->RegionName;
				$data1_tmp['DeliveryAddress']['RegionName'] = @(string)$data3_obj;
			$data1_tmp['DeliveryAddress']['regionname'] = @$data1_tmp['DeliveryAddress']['RegionName'];
			$data1_tmp['TaoBaoPrice'] = @$value1->TaoBaoPrice;
			$data1_tmp['taobaoprice'] = @$value1->TaoBaoPrice;
			$data1_tmp['InternalDeliveryOriginalInExternalCurrency'] = @$value1->InternalDeliveryOriginalInExternalCurrency;
			$data1_tmp['internaldeliveryoriginalinexternalcurrency'] = @$value1->InternalDeliveryOriginalInExternalCurrency;
			$data1_tmp['AdditionalInfo'] = @(string)$value1->AdditionalInfo;
			$data1_tmp['additionalinfo'] = @(string)$value1->AdditionalInfo;
			$data1_tmp['ExternalCurrencyCode'] = @(string)$value1->ExternalCurrencyCode;
			$data1_tmp['externalcurrencycode'] = @(string)$value1->ExternalCurrencyCode;
			$data1_tmp['ShipmentDate'] = @$value1->ShipmentDate;
			$data1_tmp['shipmentdate'] = @$value1->ShipmentDate;
			$data1_tmp['TotalAmountOriginalInExternalCurrency'] = @$value1->TotalAmountOriginalInExternalCurrency;
			$data1_tmp['totalamountoriginalinexternalcurrency'] = @$value1->TotalAmountOriginalInExternalCurrency;
if(!isset($data1_tmp['PackagePrices'])){$data1_tmp['PackagePrices'] = array();}

	if(!isset($value1->PackagePrices) || is_null($value1->PackagePrices) || !$value1->PackagePrices)			$data2_obj = @array();

	else
			$data2_obj = @$value1->PackagePrices->children();
			$data1_tmp['PackagePrices'] = @array();
			foreach($data2_obj as $value2){
				$data2_tmp = @array();
				$data2_tmp['Id'] = @(string)$value2->Id;
				$data2_tmp['id'] = @(string)$value2->Id;
				$data2_tmp['PriceInternal'] = @$value2->PriceInternal;
				$data2_tmp['priceinternal'] = @$value2->PriceInternal;
				$data2_tmp['AdditionalPriceInternal'] = @$value2->AdditionalPriceInternal;
				$data2_tmp['additionalpriceinternal'] = @$value2->AdditionalPriceInternal;
				$data2_tmp['AdditionalPrice'] = @$value2->AdditionalPrice;
				$data2_tmp['additionalprice'] = @$value2->AdditionalPrice;
				$data2_tmp['Price'] = @$value2->Price;
				$data2_tmp['price'] = @$value2->Price;
				$data2_tmp['PriceCurrencyCode'] = @(string)$value2->PriceCurrencyCode;
				$data2_tmp['pricecurrencycode'] = @(string)$value2->PriceCurrencyCode;
				$data2_tmp['PriceUpdateDate'] = @$value2->PriceUpdateDate;
				$data2_tmp['priceupdatedate'] = @$value2->PriceUpdateDate;
				$data1_tmp['PackagePrices'][] = @$data2_tmp;
			}
if(!isset($data1_tmp['LineStatusSummaries'])){$data1_tmp['LineStatusSummaries'] = array();}

	if(!isset($value1->LineStatusSummaries) || is_null($value1->LineStatusSummaries) || !$value1->LineStatusSummaries)			$data2_obj = @array();

	else
			$data2_obj = @$value1->LineStatusSummaries->children();
			$data1_tmp['LineStatusSummaries'] = @array();
			foreach($data2_obj as $value2){
				$data2_tmp = @array();
if(!isset($data2_tmp['Status'])){$data2_tmp['Status'] = array();}
				$data3_obj = @$value2->Status;
if(!isset($data2_tmp['Status']['Id'])){$data2_tmp['Status']['Id'] = array();}
					$data4_obj = @$value2->Status->Id;
					$data2_tmp['Status']['Id'] = @$data4_obj;
				$data2_tmp['Status']['id'] = @$data2_tmp['Status']['Id'];
if(!isset($data2_tmp['Status']['Name'])){$data2_tmp['Status']['Name'] = array();}
					$data4_obj = @$value2->Status->Name;
					$data2_tmp['Status']['Name'] = @(string)$data4_obj;
				$data2_tmp['Status']['name'] = @$data2_tmp['Status']['Name'];
				$data2_tmp['Count'] = @(int)$value2->Count;
				$data2_tmp['count'] = @(int)$value2->Count;
				$data1_tmp['LineStatusSummaries'][] = @$data2_tmp;
			}
			$data1_tmp['UserAccountAvailableAmount'] = @$value1->UserAccountAvailableAmount;
			$data1_tmp['useraccountavailableamount'] = @$value1->UserAccountAvailableAmount;
			$data1_tmp['CreatedDateTime'] = @(string)$value1->CreatedDateTime;
			$data1_tmp['createddatetime'] = @(string)$value1->CreatedDateTime;
			$data1_tmp['UserLogin'] = @(string)$value1->UserLogin;
			$data1_tmp['userlogin'] = @(string)$value1->UserLogin;
if(!isset($data1_tmp['TotalOriginalCostList'])){$data1_tmp['TotalOriginalCostList'] = array();}

	if(!isset($value1->TotalOriginalCostList) || is_null($value1->TotalOriginalCostList) || !$value1->TotalOriginalCostList)			$data2_obj = @array();

	else
			$data2_obj = @$value1->TotalOriginalCostList->children();
			$data1_tmp['TotalOriginalCostList'] = @array();
			foreach($data2_obj as $value2){
				$data2_tmp = @array();
				$data2_tmp['CurrencyCode'] = @(string)$value2->CurrencyCode;
				$data2_tmp['currencycode'] = @(string)$value2->CurrencyCode;
				$data2_tmp['TotalCost'] = @$value2->TotalCost;
				$data2_tmp['totalcost'] = @$value2->TotalCost;
				$data2_tmp['TotalCostInInternalCurrency'] = @$value2->TotalCostInInternalCurrency;
				$data2_tmp['totalcostininternalcurrency'] = @$value2->TotalCostInInternalCurrency;
				$data1_tmp['TotalOriginalCostList'][] = @$data2_tmp;
			}
if(!isset($data1_tmp['PackageTotalCostPerCurrencyList'])){$data1_tmp['PackageTotalCostPerCurrencyList'] = array();}

	if(!isset($value1->PackageTotalCostPerCurrencyList) || is_null($value1->PackageTotalCostPerCurrencyList) || !$value1->PackageTotalCostPerCurrencyList)			$data2_obj = @array();

	else
			$data2_obj = @$value1->PackageTotalCostPerCurrencyList->children();
			$data1_tmp['PackageTotalCostPerCurrencyList'] = @array();
			foreach($data2_obj as $value2){
				$data2_tmp = @array();
				$data2_tmp['CurrencyCode'] = @(string)$value2->CurrencyCode;
				$data2_tmp['currencycode'] = @(string)$value2->CurrencyCode;
				$data2_tmp['TotalPrice'] = @$value2->TotalPrice;
				$data2_tmp['totalprice'] = @$value2->TotalPrice;
				$data2_tmp['TotalAdditionalPrice'] = @$value2->TotalAdditionalPrice;
				$data2_tmp['totaladditionalprice'] = @$value2->TotalAdditionalPrice;
				$data1_tmp['PackageTotalCostPerCurrencyList'][] = @$data2_tmp;
			}
			$data1_tmp['InternalDeliveryOriginalInInternalCurrency'] = @$value1->InternalDeliveryOriginalInInternalCurrency;
			$data1_tmp['internaldeliveryoriginalininternalcurrency'] = @$value1->InternalDeliveryOriginalInInternalCurrency;
			$data1_tmp['InternalOriginalPrice'] = @$value1->InternalOriginalPrice;
			$data1_tmp['internaloriginalprice'] = @$value1->InternalOriginalPrice;
			$data1_tmp['Profit'] = @$value1->Profit;
			$data1_tmp['profit'] = @$value1->Profit;
if(!isset($data1_tmp['RateList'])){$data1_tmp['RateList'] = array();}

	if(!isset($value1->RateList) || is_null($value1->RateList) || !$value1->RateList)			$data2_obj = @array();

	else
			$data2_obj = @$value1->RateList->children();
			$data1_tmp['RateList'] = @array();
			foreach($data2_obj as $value2){
				$data1_tmp['RateList'][] = @$value2;
			}
			$data0['Content'][] = @$data1_tmp;
		}
	$data0['content'] = @$data0['Content'];
if(!isset($data0['TotalCount'])){$data0['TotalCount'] = array();}
		$data1_obj = @$simplexml->Result->TotalCount;
		$data0['TotalCount'] = @$data1_obj;
	$data0['totalcount'] = @$data0['TotalCount'];
	return $data0;
    }
    public function SearchOrdersWithSummary($sessionId, $xmlSearchParameters, $framePosition = 0, $frameSize = 18){
        $params = array(
            'sessionId' => $sessionId,
	    'xmlSearchParameters' => $xmlSearchParameters,
	    'framePosition' => $framePosition,
	    'frameSize' => $frameSize
        );
        $params += $this->defaultLogin();
        $simplexml = $this->_getData('SearchOrdersWithSummary', $params);
        if (!$simplexml) return false;
        
        $data0 = array();
        
if(!isset($data0)){$data0 = array();}
	$data0_obj = @$simplexml->Result;
if(!isset($data0['SalesOrdersList'])){$data0['SalesOrdersList'] = array();}

	if(!isset($simplexml->Result->SalesOrdersList) || is_null($simplexml->Result->SalesOrdersList) || !$simplexml->Result->SalesOrdersList)		$data1_obj = @array();

	else
		$data1_obj = @$simplexml->Result->SalesOrdersList->children();
		$data0['SalesOrdersList'] = @array();
		foreach($data1_obj as $value1){
			$data1_tmp = @array();
			$data1_tmp['Id'] = @(string)$value1->Id;
			$data1_tmp['id'] = @(string)$value1->Id;
			$data1_tmp['StatusCode'] = @(string)$value1->StatusCode;
			$data1_tmp['statuscode'] = @(string)$value1->StatusCode;
			$data1_tmp['StatusName'] = @(string)$value1->StatusName;
			$data1_tmp['statusname'] = @(string)$value1->StatusName;
			$data1_tmp['SubstatusCode'] = @(string)$value1->SubstatusCode;
			$data1_tmp['substatuscode'] = @(string)$value1->SubstatusCode;
			$data1_tmp['SubstatusName'] = @(string)$value1->SubstatusName;
			$data1_tmp['substatusname'] = @(string)$value1->SubstatusName;
			$data1_tmp['OperatorId'] = @(string)$value1->OperatorId;
			$data1_tmp['operatorid'] = @(string)$value1->OperatorId;
			$data1_tmp['OperatorName'] = @(string)$value1->OperatorName;
			$data1_tmp['operatorname'] = @(string)$value1->OperatorName;
			$data1_tmp['ItemsCount'] = @$value1->ItemsCount;
			$data1_tmp['itemscount'] = @$value1->ItemsCount;
			$data1_tmp['GoodsAmount'] = @$value1->GoodsAmount;
			$data1_tmp['goodsamount'] = @$value1->GoodsAmount;
			$data1_tmp['DeliveryAmount'] = @$value1->DeliveryAmount;
			$data1_tmp['deliveryamount'] = @$value1->DeliveryAmount;
			$data1_tmp['TotalAmount'] = @$value1->TotalAmount;
			$data1_tmp['totalamount'] = @$value1->TotalAmount;
			$data1_tmp['RemainAmount'] = @$value1->RemainAmount;
			$data1_tmp['remainamount'] = @$value1->RemainAmount;
			$data1_tmp['CurrencySign'] = @(string)$value1->CurrencySign;
			$data1_tmp['currencysign'] = @(string)$value1->CurrencySign;
			$data1_tmp['CurrencyCode'] = @(string)$value1->CurrencyCode;
			$data1_tmp['currencycode'] = @(string)$value1->CurrencyCode;
			$data1_tmp['GoodsAmountInternal'] = @$value1->GoodsAmountInternal;
			$data1_tmp['goodsamountinternal'] = @$value1->GoodsAmountInternal;
			$data1_tmp['DeliveryAmountInternal'] = @$value1->DeliveryAmountInternal;
			$data1_tmp['deliveryamountinternal'] = @$value1->DeliveryAmountInternal;
			$data1_tmp['TotalAmountInternal'] = @$value1->TotalAmountInternal;
			$data1_tmp['totalamountinternal'] = @$value1->TotalAmountInternal;
			$data1_tmp['RemainAmountInternal'] = @$value1->RemainAmountInternal;
			$data1_tmp['remainamountinternal'] = @$value1->RemainAmountInternal;
			$data1_tmp['CurrencySignInternal'] = @(string)$value1->CurrencySignInternal;
			$data1_tmp['currencysigninternal'] = @(string)$value1->CurrencySignInternal;
			$data1_tmp['CurrencyCodeInternal'] = @(string)$value1->CurrencyCodeInternal;
			$data1_tmp['currencycodeinternal'] = @(string)$value1->CurrencyCodeInternal;
			$data1_tmp['CustComment'] = @(string)$value1->CustComment;
			$data1_tmp['custcomment'] = @(string)$value1->CustComment;
			$data1_tmp['DeliveryModeId'] = @(string)$value1->DeliveryModeId;
			$data1_tmp['deliverymodeid'] = @(string)$value1->DeliveryModeId;
			$data1_tmp['DeliveryModeName'] = @(string)$value1->DeliveryModeName;
			$data1_tmp['deliverymodename'] = @(string)$value1->DeliveryModeName;
			$data1_tmp['CanCancel'] = @(int)$value1->CanCancel;
			$data1_tmp['cancancel'] = @(int)$value1->CanCancel;
			$data1_tmp['CanConfirmShipment'] = @(int)$value1->CanConfirmShipment;
			$data1_tmp['canconfirmshipment'] = @(int)$value1->CanConfirmShipment;
			$data1_tmp['CanChangeAddress'] = @(int)$value1->CanChangeAddress;
			$data1_tmp['canchangeaddress'] = @(int)$value1->CanChangeAddress;
			$data1_tmp['AdminInfoText'] = @(string)$value1->AdminInfoText;
			$data1_tmp['admininfotext'] = @(string)$value1->AdminInfoText;
			$data1_tmp['AdminAlertText'] = @(string)$value1->AdminAlertText;
			$data1_tmp['adminalerttext'] = @(string)$value1->AdminAlertText;
			$data1_tmp['PaidAmount'] = @$value1->PaidAmount;
			$data1_tmp['paidamount'] = @$value1->PaidAmount;
			$data1_tmp['PaidAmountInternal'] = @$value1->PaidAmountInternal;
			$data1_tmp['paidamountinternal'] = @$value1->PaidAmountInternal;
			$data1_tmp['CanRestore'] = @(int)$value1->CanRestore;
			$data1_tmp['canrestore'] = @(int)$value1->CanRestore;
			$data1_tmp['CanClose'] = @(int)$value1->CanClose;
			$data1_tmp['canclose'] = @(int)$value1->CanClose;
			$data1_tmp['CanCloseCancel'] = @(int)$value1->CanCloseCancel;
			$data1_tmp['canclosecancel'] = @(int)$value1->CanCloseCancel;
			$data1_tmp['CanAccept'] = @(int)$value1->CanAccept;
			$data1_tmp['canaccept'] = @(int)$value1->CanAccept;
			$data1_tmp['CanPurchaseItems'] = @(int)$value1->CanPurchaseItems;
			$data1_tmp['canpurchaseitems'] = @(int)$value1->CanPurchaseItems;
			$data1_tmp['PackagesWeight'] = @(int)$value1->PackagesWeight;
			$data1_tmp['packagesweight'] = @(int)$value1->PackagesWeight;
			$data1_tmp['EstimatedWeight'] = @(int)$value1->EstimatedWeight;
			$data1_tmp['estimatedweight'] = @(int)$value1->EstimatedWeight;
			$data1_tmp['CustId'] = @(string)$value1->CustId;
			$data1_tmp['custid'] = @(string)$value1->CustId;
			$data1_tmp['CustName'] = @(string)$value1->CustName;
			$data1_tmp['custname'] = @(string)$value1->CustName;
			$data1_tmp['StatusId'] = @(int)$value1->StatusId;
			$data1_tmp['statusid'] = @(int)$value1->StatusId;
			$data1_tmp['Weight'] = @$value1->Weight;
			$data1_tmp['weight'] = @$value1->Weight;
if(!isset($data1_tmp['DeliveryAddress'])){$data1_tmp['DeliveryAddress'] = array();}
			$data2_obj = @$value1->DeliveryAddress;
if(!isset($data1_tmp['DeliveryAddress']['Id'])){$data1_tmp['DeliveryAddress']['Id'] = array();}
				$data3_obj = @$value1->DeliveryAddress->Id;
				$data1_tmp['DeliveryAddress']['Id'] = @(string)$data3_obj;
			$data1_tmp['DeliveryAddress']['id'] = @$data1_tmp['DeliveryAddress']['Id'];
if(!isset($data1_tmp['DeliveryAddress']['Familyname'])){$data1_tmp['DeliveryAddress']['Familyname'] = array();}
				$data3_obj = @$value1->DeliveryAddress->Familyname;
				$data1_tmp['DeliveryAddress']['Familyname'] = @(string)$data3_obj;
			$data1_tmp['DeliveryAddress']['familyname'] = @$data1_tmp['DeliveryAddress']['Familyname'];
if(!isset($data1_tmp['DeliveryAddress']['Name'])){$data1_tmp['DeliveryAddress']['Name'] = array();}
				$data3_obj = @$value1->DeliveryAddress->Name;
				$data1_tmp['DeliveryAddress']['Name'] = @(string)$data3_obj;
			$data1_tmp['DeliveryAddress']['name'] = @$data1_tmp['DeliveryAddress']['Name'];
if(!isset($data1_tmp['DeliveryAddress']['Patername'])){$data1_tmp['DeliveryAddress']['Patername'] = array();}
				$data3_obj = @$value1->DeliveryAddress->Patername;
				$data1_tmp['DeliveryAddress']['Patername'] = @(string)$data3_obj;
			$data1_tmp['DeliveryAddress']['patername'] = @$data1_tmp['DeliveryAddress']['Patername'];
if(!isset($data1_tmp['DeliveryAddress']['CountryCode'])){$data1_tmp['DeliveryAddress']['CountryCode'] = array();}
				$data3_obj = @$value1->DeliveryAddress->CountryCode;
				$data1_tmp['DeliveryAddress']['CountryCode'] = @(string)$data3_obj;
			$data1_tmp['DeliveryAddress']['countrycode'] = @$data1_tmp['DeliveryAddress']['CountryCode'];
if(!isset($data1_tmp['DeliveryAddress']['Country'])){$data1_tmp['DeliveryAddress']['Country'] = array();}
				$data3_obj = @$value1->DeliveryAddress->Country;
				$data1_tmp['DeliveryAddress']['Country'] = @(string)$data3_obj;
			$data1_tmp['DeliveryAddress']['country'] = @$data1_tmp['DeliveryAddress']['Country'];
if(!isset($data1_tmp['DeliveryAddress']['City'])){$data1_tmp['DeliveryAddress']['City'] = array();}
				$data3_obj = @$value1->DeliveryAddress->City;
				$data1_tmp['DeliveryAddress']['City'] = @(string)$data3_obj;
			$data1_tmp['DeliveryAddress']['city'] = @$data1_tmp['DeliveryAddress']['City'];
if(!isset($data1_tmp['DeliveryAddress']['Address'])){$data1_tmp['DeliveryAddress']['Address'] = array();}
				$data3_obj = @$value1->DeliveryAddress->Address;
				$data1_tmp['DeliveryAddress']['Address'] = @(string)$data3_obj;
			$data1_tmp['DeliveryAddress']['address'] = @$data1_tmp['DeliveryAddress']['Address'];
if(!isset($data1_tmp['DeliveryAddress']['Phone'])){$data1_tmp['DeliveryAddress']['Phone'] = array();}
				$data3_obj = @$value1->DeliveryAddress->Phone;
				$data1_tmp['DeliveryAddress']['Phone'] = @(string)$data3_obj;
			$data1_tmp['DeliveryAddress']['phone'] = @$data1_tmp['DeliveryAddress']['Phone'];
if(!isset($data1_tmp['DeliveryAddress']['PostalCode'])){$data1_tmp['DeliveryAddress']['PostalCode'] = array();}
				$data3_obj = @$value1->DeliveryAddress->PostalCode;
				$data1_tmp['DeliveryAddress']['PostalCode'] = @(string)$data3_obj;
			$data1_tmp['DeliveryAddress']['postalcode'] = @$data1_tmp['DeliveryAddress']['PostalCode'];
if(!isset($data1_tmp['DeliveryAddress']['RegionName'])){$data1_tmp['DeliveryAddress']['RegionName'] = array();}
				$data3_obj = @$value1->DeliveryAddress->RegionName;
				$data1_tmp['DeliveryAddress']['RegionName'] = @(string)$data3_obj;
			$data1_tmp['DeliveryAddress']['regionname'] = @$data1_tmp['DeliveryAddress']['RegionName'];
			$data1_tmp['TaoBaoPrice'] = @$value1->TaoBaoPrice;
			$data1_tmp['taobaoprice'] = @$value1->TaoBaoPrice;
			$data1_tmp['InternalDeliveryOriginalInExternalCurrency'] = @$value1->InternalDeliveryOriginalInExternalCurrency;
			$data1_tmp['internaldeliveryoriginalinexternalcurrency'] = @$value1->InternalDeliveryOriginalInExternalCurrency;
			$data1_tmp['AdditionalInfo'] = @(string)$value1->AdditionalInfo;
			$data1_tmp['additionalinfo'] = @(string)$value1->AdditionalInfo;
			$data1_tmp['ExternalCurrencyCode'] = @(string)$value1->ExternalCurrencyCode;
			$data1_tmp['externalcurrencycode'] = @(string)$value1->ExternalCurrencyCode;
			$data1_tmp['ShipmentDate'] = @$value1->ShipmentDate;
			$data1_tmp['shipmentdate'] = @$value1->ShipmentDate;
			$data1_tmp['TotalAmountOriginalInExternalCurrency'] = @$value1->TotalAmountOriginalInExternalCurrency;
			$data1_tmp['totalamountoriginalinexternalcurrency'] = @$value1->TotalAmountOriginalInExternalCurrency;
if(!isset($data1_tmp['PackagePrices'])){$data1_tmp['PackagePrices'] = array();}

	if(!isset($value1->PackagePrices) || is_null($value1->PackagePrices) || !$value1->PackagePrices)			$data2_obj = @array();

	else
			$data2_obj = @$value1->PackagePrices->children();
			$data1_tmp['PackagePrices'] = @array();
			foreach($data2_obj as $value2){
				$data2_tmp = @array();
				$data2_tmp['Id'] = @(string)$value2->Id;
				$data2_tmp['id'] = @(string)$value2->Id;
				$data2_tmp['PriceInternal'] = @$value2->PriceInternal;
				$data2_tmp['priceinternal'] = @$value2->PriceInternal;
				$data2_tmp['AdditionalPriceInternal'] = @$value2->AdditionalPriceInternal;
				$data2_tmp['additionalpriceinternal'] = @$value2->AdditionalPriceInternal;
				$data2_tmp['AdditionalPrice'] = @$value2->AdditionalPrice;
				$data2_tmp['additionalprice'] = @$value2->AdditionalPrice;
				$data2_tmp['Price'] = @$value2->Price;
				$data2_tmp['price'] = @$value2->Price;
				$data2_tmp['PriceCurrencyCode'] = @(string)$value2->PriceCurrencyCode;
				$data2_tmp['pricecurrencycode'] = @(string)$value2->PriceCurrencyCode;
				$data2_tmp['PriceUpdateDate'] = @$value2->PriceUpdateDate;
				$data2_tmp['priceupdatedate'] = @$value2->PriceUpdateDate;
				$data1_tmp['PackagePrices'][] = @$data2_tmp;
			}
if(!isset($data1_tmp['LineStatusSummaries'])){$data1_tmp['LineStatusSummaries'] = array();}

	if(!isset($value1->LineStatusSummaries) || is_null($value1->LineStatusSummaries) || !$value1->LineStatusSummaries)			$data2_obj = @array();

	else
			$data2_obj = @$value1->LineStatusSummaries->children();
			$data1_tmp['LineStatusSummaries'] = @array();
			foreach($data2_obj as $value2){
				$data2_tmp = @array();
if(!isset($data2_tmp['Status'])){$data2_tmp['Status'] = array();}
				$data3_obj = @$value2->Status;
if(!isset($data2_tmp['Status']['Id'])){$data2_tmp['Status']['Id'] = array();}
					$data4_obj = @$value2->Status->Id;
					$data2_tmp['Status']['Id'] = @$data4_obj;
				$data2_tmp['Status']['id'] = @$data2_tmp['Status']['Id'];
if(!isset($data2_tmp['Status']['Name'])){$data2_tmp['Status']['Name'] = array();}
					$data4_obj = @$value2->Status->Name;
					$data2_tmp['Status']['Name'] = @(string)$data4_obj;
				$data2_tmp['Status']['name'] = @$data2_tmp['Status']['Name'];
				$data2_tmp['Count'] = @(int)$value2->Count;
				$data2_tmp['count'] = @(int)$value2->Count;
				$data1_tmp['LineStatusSummaries'][] = @$data2_tmp;
			}
			$data1_tmp['UserAccountAvailableAmount'] = @$value1->UserAccountAvailableAmount;
			$data1_tmp['useraccountavailableamount'] = @$value1->UserAccountAvailableAmount;
			$data1_tmp['CreatedDateTime'] = @(string)$value1->CreatedDateTime;
			$data1_tmp['createddatetime'] = @(string)$value1->CreatedDateTime;
			$data1_tmp['UserLogin'] = @(string)$value1->UserLogin;
			$data1_tmp['userlogin'] = @(string)$value1->UserLogin;
if(!isset($data1_tmp['TotalOriginalCostList'])){$data1_tmp['TotalOriginalCostList'] = array();}

	if(!isset($value1->TotalOriginalCostList) || is_null($value1->TotalOriginalCostList) || !$value1->TotalOriginalCostList)			$data2_obj = @array();

	else
			$data2_obj = @$value1->TotalOriginalCostList->children();
			$data1_tmp['TotalOriginalCostList'] = @array();
			foreach($data2_obj as $value2){
				$data2_tmp = @array();
				$data2_tmp['CurrencyCode'] = @(string)$value2->CurrencyCode;
				$data2_tmp['currencycode'] = @(string)$value2->CurrencyCode;
				$data2_tmp['TotalCost'] = @$value2->TotalCost;
				$data2_tmp['totalcost'] = @$value2->TotalCost;
				$data2_tmp['TotalCostInInternalCurrency'] = @$value2->TotalCostInInternalCurrency;
				$data2_tmp['totalcostininternalcurrency'] = @$value2->TotalCostInInternalCurrency;
				$data1_tmp['TotalOriginalCostList'][] = @$data2_tmp;
			}
if(!isset($data1_tmp['PackageTotalCostPerCurrencyList'])){$data1_tmp['PackageTotalCostPerCurrencyList'] = array();}

	if(!isset($value1->PackageTotalCostPerCurrencyList) || is_null($value1->PackageTotalCostPerCurrencyList) || !$value1->PackageTotalCostPerCurrencyList)			$data2_obj = @array();

	else
			$data2_obj = @$value1->PackageTotalCostPerCurrencyList->children();
			$data1_tmp['PackageTotalCostPerCurrencyList'] = @array();
			foreach($data2_obj as $value2){
				$data2_tmp = @array();
				$data2_tmp['CurrencyCode'] = @(string)$value2->CurrencyCode;
				$data2_tmp['currencycode'] = @(string)$value2->CurrencyCode;
				$data2_tmp['TotalPrice'] = @$value2->TotalPrice;
				$data2_tmp['totalprice'] = @$value2->TotalPrice;
				$data2_tmp['TotalAdditionalPrice'] = @$value2->TotalAdditionalPrice;
				$data2_tmp['totaladditionalprice'] = @$value2->TotalAdditionalPrice;
				$data1_tmp['PackageTotalCostPerCurrencyList'][] = @$data2_tmp;
			}
			$data1_tmp['InternalDeliveryOriginalInInternalCurrency'] = @$value1->InternalDeliveryOriginalInInternalCurrency;
			$data1_tmp['internaldeliveryoriginalininternalcurrency'] = @$value1->InternalDeliveryOriginalInInternalCurrency;
			$data1_tmp['InternalOriginalPrice'] = @$value1->InternalOriginalPrice;
			$data1_tmp['internaloriginalprice'] = @$value1->InternalOriginalPrice;
			$data1_tmp['Profit'] = @$value1->Profit;
			$data1_tmp['profit'] = @$value1->Profit;
if(!isset($data1_tmp['RateList'])){$data1_tmp['RateList'] = array();}

	if(!isset($value1->RateList) || is_null($value1->RateList) || !$value1->RateList)			$data2_obj = @array();

	else
			$data2_obj = @$value1->RateList->children();
			$data1_tmp['RateList'] = @array();
			foreach($data2_obj as $value2){
				$data1_tmp['RateList'][] = @$value2;
			}
			$data0['SalesOrdersList'][] = @$data1_tmp;
		}
	$data0['salesorderslist'] = @$data0['SalesOrdersList'];
if(!isset($data0['TotalCount'])){$data0['TotalCount'] = array();}
		$data1_obj = @$simplexml->Result->TotalCount;
		$data0['TotalCount'] = @$data1_obj;
	$data0['totalcount'] = @$data0['TotalCount'];
if(!isset($data0['TotalCostInInternalCurrency'])){$data0['TotalCostInInternalCurrency'] = array();}
		$data1_obj = @$simplexml->Result->TotalCostInInternalCurrency;
		$data0['TotalCostInInternalCurrency'] = @$data1_obj;
	$data0['totalcostininternalcurrency'] = @$data0['TotalCostInInternalCurrency'];
if(!isset($data0['TotalProfitInInternalCurrency'])){$data0['TotalProfitInInternalCurrency'] = array();}
		$data1_obj = @$simplexml->Result->TotalProfitInInternalCurrency;
		$data0['TotalProfitInInternalCurrency'] = @$data1_obj;
	$data0['totalprofitininternalcurrency'] = @$data0['TotalProfitInInternalCurrency'];
	return $data0;
    }
    public function GetCalculatedPrice($categoryId, $xmlVariablesPriceSettings){
        $params = array(
            'categoryId' => $categoryId,
	    'xmlVariablesPriceSettings' => $xmlVariablesPriceSettings
        );
        $params += $this->defaultLogin();
        $simplexml = $this->_getData('GetCalculatedPrice', $params);
        if (!$simplexml) return false;
        
        $data0 = array();
        
if(!isset($data0)){$data0 = array();}
	$data0_obj = @$simplexml->Result;
if(!isset($data0['OriginalPrice'])){$data0['OriginalPrice'] = array();}
		$data1_obj = @$simplexml->Result->OriginalPrice;
		$data0['OriginalPrice'] = @$data1_obj;
	$data0['originalprice'] = @$data0['OriginalPrice'];
if(!isset($data0['MarginPrice'])){$data0['MarginPrice'] = array();}
		$data1_obj = @$simplexml->Result->MarginPrice;
		$data0['MarginPrice'] = @$data1_obj;
	$data0['marginprice'] = @$data0['MarginPrice'];
if(!isset($data0['OriginalCurrencyCode'])){$data0['OriginalCurrencyCode'] = array();}
		$data1_obj = @$simplexml->Result->OriginalCurrencyCode;
		$data0['OriginalCurrencyCode'] = @(string)$data1_obj;
	$data0['originalcurrencycode'] = @$data0['OriginalCurrencyCode'];
if(!isset($data0['ConvertedPriceList'])){$data0['ConvertedPriceList'] = array();}
		$data1_obj = @$simplexml->Result->ConvertedPriceList;
if(!isset($data0['ConvertedPriceList']['Internal'])){$data0['ConvertedPriceList']['Internal'] = array();}
			$data2_obj = @$simplexml->Result->ConvertedPriceList->Internal;
			$data0['ConvertedPriceList']['Internal'] = @$data2_obj;
		$data0['ConvertedPriceList']['internal'] = @$data0['ConvertedPriceList']['Internal'];
if(!isset($data0['ConvertedPriceList']['DisplayedMoneys'])){$data0['ConvertedPriceList']['DisplayedMoneys'] = array();}

	if(!isset($simplexml->Result->ConvertedPriceList->DisplayedMoneys) || is_null($simplexml->Result->ConvertedPriceList->DisplayedMoneys) || !$simplexml->Result->ConvertedPriceList->DisplayedMoneys)			$data2_obj = @array();

	else
			$data2_obj = @$simplexml->Result->ConvertedPriceList->DisplayedMoneys->children();
			$data0['ConvertedPriceList']['DisplayedMoneys'] = @array();
			foreach($data2_obj as $value2){
				$data0['ConvertedPriceList']['DisplayedMoneys'][] = @$value2;
			}
		$data0['ConvertedPriceList']['displayedmoneys'] = @$data0['ConvertedPriceList']['DisplayedMoneys'];
	$data0['convertedpricelist'] = @$data0['ConvertedPriceList'];
if(!isset($data0['ConvertedPrice'])){$data0['ConvertedPrice'] = array();}
		$data1_obj = @$simplexml->Result->ConvertedPrice;
		$data0['ConvertedPrice'] = @(string)$data1_obj;
	$data0['convertedprice'] = @$data0['ConvertedPrice'];
if(!isset($data0['ConvertedPriceWithoutSign'])){$data0['ConvertedPriceWithoutSign'] = array();}
		$data1_obj = @$simplexml->Result->ConvertedPriceWithoutSign;
		$data0['ConvertedPriceWithoutSign'] = @(string)$data1_obj;
	$data0['convertedpricewithoutsign'] = @$data0['ConvertedPriceWithoutSign'];
if(!isset($data0['CurrencySign'])){$data0['CurrencySign'] = array();}
		$data1_obj = @$simplexml->Result->CurrencySign;
		$data0['CurrencySign'] = @(string)$data1_obj;
	$data0['currencysign'] = @$data0['CurrencySign'];
if(!isset($data0['CurrencyName'])){$data0['CurrencyName'] = array();}
		$data1_obj = @$simplexml->Result->CurrencyName;
		$data0['CurrencyName'] = @(string)$data1_obj;
	$data0['currencyname'] = @$data0['CurrencyName'];
if(!isset($data0['IsDeliverable'])){$data0['IsDeliverable'] = array();}
		$data1_obj = @$simplexml->Result->IsDeliverable;
		$data0['IsDeliverable'] = @$data1_obj;
	$data0['isdeliverable'] = @$data0['IsDeliverable'];
if(!isset($data0['DeliveryPrice'])){$data0['DeliveryPrice'] = array();}
		$data1_obj = @$simplexml->Result->DeliveryPrice;
if(!isset($data0['DeliveryPrice']['OriginalPrice'])){$data0['DeliveryPrice']['OriginalPrice'] = array();}
			$data2_obj = @$simplexml->Result->DeliveryPrice->OriginalPrice;
			$data0['DeliveryPrice']['OriginalPrice'] = @$data2_obj;
		$data0['DeliveryPrice']['originalprice'] = @$data0['DeliveryPrice']['OriginalPrice'];
if(!isset($data0['DeliveryPrice']['MarginPrice'])){$data0['DeliveryPrice']['MarginPrice'] = array();}
			$data2_obj = @$simplexml->Result->DeliveryPrice->MarginPrice;
			$data0['DeliveryPrice']['MarginPrice'] = @$data2_obj;
		$data0['DeliveryPrice']['marginprice'] = @$data0['DeliveryPrice']['MarginPrice'];
if(!isset($data0['DeliveryPrice']['OriginalCurrencyCode'])){$data0['DeliveryPrice']['OriginalCurrencyCode'] = array();}
			$data2_obj = @$simplexml->Result->DeliveryPrice->OriginalCurrencyCode;
			$data0['DeliveryPrice']['OriginalCurrencyCode'] = @(string)$data2_obj;
		$data0['DeliveryPrice']['originalcurrencycode'] = @$data0['DeliveryPrice']['OriginalCurrencyCode'];
if(!isset($data0['DeliveryPrice']['ConvertedPriceList'])){$data0['DeliveryPrice']['ConvertedPriceList'] = array();}
			$data2_obj = @$simplexml->Result->DeliveryPrice->ConvertedPriceList;
if(!isset($data0['DeliveryPrice']['ConvertedPriceList']['Internal'])){$data0['DeliveryPrice']['ConvertedPriceList']['Internal'] = array();}
				$data3_obj = @$simplexml->Result->DeliveryPrice->ConvertedPriceList->Internal;
				$data0['DeliveryPrice']['ConvertedPriceList']['Internal'] = @$data3_obj;
			$data0['DeliveryPrice']['ConvertedPriceList']['internal'] = @$data0['DeliveryPrice']['ConvertedPriceList']['Internal'];
if(!isset($data0['DeliveryPrice']['ConvertedPriceList']['DisplayedMoneys'])){$data0['DeliveryPrice']['ConvertedPriceList']['DisplayedMoneys'] = array();}

	if(!isset($simplexml->Result->DeliveryPrice->ConvertedPriceList->DisplayedMoneys) || is_null($simplexml->Result->DeliveryPrice->ConvertedPriceList->DisplayedMoneys) || !$simplexml->Result->DeliveryPrice->ConvertedPriceList->DisplayedMoneys)				$data3_obj = @array();

	else
				$data3_obj = @$simplexml->Result->DeliveryPrice->ConvertedPriceList->DisplayedMoneys->children();
				$data0['DeliveryPrice']['ConvertedPriceList']['DisplayedMoneys'] = @array();
				foreach($data3_obj as $value3){
					$data0['DeliveryPrice']['ConvertedPriceList']['DisplayedMoneys'][] = @$value3;
				}
			$data0['DeliveryPrice']['ConvertedPriceList']['displayedmoneys'] = @$data0['DeliveryPrice']['ConvertedPriceList']['DisplayedMoneys'];
		$data0['DeliveryPrice']['convertedpricelist'] = @$data0['DeliveryPrice']['ConvertedPriceList'];
	$data0['deliveryprice'] = @$data0['DeliveryPrice'];
if(!isset($data0['OneItemDeliveryPrice'])){$data0['OneItemDeliveryPrice'] = array();}
		$data1_obj = @$simplexml->Result->OneItemDeliveryPrice;
if(!isset($data0['OneItemDeliveryPrice']['OriginalPrice'])){$data0['OneItemDeliveryPrice']['OriginalPrice'] = array();}
			$data2_obj = @$simplexml->Result->OneItemDeliveryPrice->OriginalPrice;
			$data0['OneItemDeliveryPrice']['OriginalPrice'] = @$data2_obj;
		$data0['OneItemDeliveryPrice']['originalprice'] = @$data0['OneItemDeliveryPrice']['OriginalPrice'];
if(!isset($data0['OneItemDeliveryPrice']['MarginPrice'])){$data0['OneItemDeliveryPrice']['MarginPrice'] = array();}
			$data2_obj = @$simplexml->Result->OneItemDeliveryPrice->MarginPrice;
			$data0['OneItemDeliveryPrice']['MarginPrice'] = @$data2_obj;
		$data0['OneItemDeliveryPrice']['marginprice'] = @$data0['OneItemDeliveryPrice']['MarginPrice'];
if(!isset($data0['OneItemDeliveryPrice']['OriginalCurrencyCode'])){$data0['OneItemDeliveryPrice']['OriginalCurrencyCode'] = array();}
			$data2_obj = @$simplexml->Result->OneItemDeliveryPrice->OriginalCurrencyCode;
			$data0['OneItemDeliveryPrice']['OriginalCurrencyCode'] = @(string)$data2_obj;
		$data0['OneItemDeliveryPrice']['originalcurrencycode'] = @$data0['OneItemDeliveryPrice']['OriginalCurrencyCode'];
if(!isset($data0['OneItemDeliveryPrice']['ConvertedPriceList'])){$data0['OneItemDeliveryPrice']['ConvertedPriceList'] = array();}
			$data2_obj = @$simplexml->Result->OneItemDeliveryPrice->ConvertedPriceList;
if(!isset($data0['OneItemDeliveryPrice']['ConvertedPriceList']['Internal'])){$data0['OneItemDeliveryPrice']['ConvertedPriceList']['Internal'] = array();}
				$data3_obj = @$simplexml->Result->OneItemDeliveryPrice->ConvertedPriceList->Internal;
				$data0['OneItemDeliveryPrice']['ConvertedPriceList']['Internal'] = @$data3_obj;
			$data0['OneItemDeliveryPrice']['ConvertedPriceList']['internal'] = @$data0['OneItemDeliveryPrice']['ConvertedPriceList']['Internal'];
if(!isset($data0['OneItemDeliveryPrice']['ConvertedPriceList']['DisplayedMoneys'])){$data0['OneItemDeliveryPrice']['ConvertedPriceList']['DisplayedMoneys'] = array();}

	if(!isset($simplexml->Result->OneItemDeliveryPrice->ConvertedPriceList->DisplayedMoneys) || is_null($simplexml->Result->OneItemDeliveryPrice->ConvertedPriceList->DisplayedMoneys) || !$simplexml->Result->OneItemDeliveryPrice->ConvertedPriceList->DisplayedMoneys)				$data3_obj = @array();

	else
				$data3_obj = @$simplexml->Result->OneItemDeliveryPrice->ConvertedPriceList->DisplayedMoneys->children();
				$data0['OneItemDeliveryPrice']['ConvertedPriceList']['DisplayedMoneys'] = @array();
				foreach($data3_obj as $value3){
					$data0['OneItemDeliveryPrice']['ConvertedPriceList']['DisplayedMoneys'][] = @$value3;
				}
			$data0['OneItemDeliveryPrice']['ConvertedPriceList']['displayedmoneys'] = @$data0['OneItemDeliveryPrice']['ConvertedPriceList']['DisplayedMoneys'];
		$data0['OneItemDeliveryPrice']['convertedpricelist'] = @$data0['OneItemDeliveryPrice']['ConvertedPriceList'];
	$data0['oneitemdeliveryprice'] = @$data0['OneItemDeliveryPrice'];
if(!isset($data0['PriceWithoutDelivery'])){$data0['PriceWithoutDelivery'] = array();}
		$data1_obj = @$simplexml->Result->PriceWithoutDelivery;
if(!isset($data0['PriceWithoutDelivery']['OriginalPrice'])){$data0['PriceWithoutDelivery']['OriginalPrice'] = array();}
			$data2_obj = @$simplexml->Result->PriceWithoutDelivery->OriginalPrice;
			$data0['PriceWithoutDelivery']['OriginalPrice'] = @$data2_obj;
		$data0['PriceWithoutDelivery']['originalprice'] = @$data0['PriceWithoutDelivery']['OriginalPrice'];
if(!isset($data0['PriceWithoutDelivery']['MarginPrice'])){$data0['PriceWithoutDelivery']['MarginPrice'] = array();}
			$data2_obj = @$simplexml->Result->PriceWithoutDelivery->MarginPrice;
			$data0['PriceWithoutDelivery']['MarginPrice'] = @$data2_obj;
		$data0['PriceWithoutDelivery']['marginprice'] = @$data0['PriceWithoutDelivery']['MarginPrice'];
if(!isset($data0['PriceWithoutDelivery']['OriginalCurrencyCode'])){$data0['PriceWithoutDelivery']['OriginalCurrencyCode'] = array();}
			$data2_obj = @$simplexml->Result->PriceWithoutDelivery->OriginalCurrencyCode;
			$data0['PriceWithoutDelivery']['OriginalCurrencyCode'] = @(string)$data2_obj;
		$data0['PriceWithoutDelivery']['originalcurrencycode'] = @$data0['PriceWithoutDelivery']['OriginalCurrencyCode'];
if(!isset($data0['PriceWithoutDelivery']['ConvertedPriceList'])){$data0['PriceWithoutDelivery']['ConvertedPriceList'] = array();}
			$data2_obj = @$simplexml->Result->PriceWithoutDelivery->ConvertedPriceList;
if(!isset($data0['PriceWithoutDelivery']['ConvertedPriceList']['Internal'])){$data0['PriceWithoutDelivery']['ConvertedPriceList']['Internal'] = array();}
				$data3_obj = @$simplexml->Result->PriceWithoutDelivery->ConvertedPriceList->Internal;
				$data0['PriceWithoutDelivery']['ConvertedPriceList']['Internal'] = @$data3_obj;
			$data0['PriceWithoutDelivery']['ConvertedPriceList']['internal'] = @$data0['PriceWithoutDelivery']['ConvertedPriceList']['Internal'];
if(!isset($data0['PriceWithoutDelivery']['ConvertedPriceList']['DisplayedMoneys'])){$data0['PriceWithoutDelivery']['ConvertedPriceList']['DisplayedMoneys'] = array();}

	if(!isset($simplexml->Result->PriceWithoutDelivery->ConvertedPriceList->DisplayedMoneys) || is_null($simplexml->Result->PriceWithoutDelivery->ConvertedPriceList->DisplayedMoneys) || !$simplexml->Result->PriceWithoutDelivery->ConvertedPriceList->DisplayedMoneys)				$data3_obj = @array();

	else
				$data3_obj = @$simplexml->Result->PriceWithoutDelivery->ConvertedPriceList->DisplayedMoneys->children();
				$data0['PriceWithoutDelivery']['ConvertedPriceList']['DisplayedMoneys'] = @array();
				foreach($data3_obj as $value3){
					$data0['PriceWithoutDelivery']['ConvertedPriceList']['DisplayedMoneys'][] = @$value3;
				}
			$data0['PriceWithoutDelivery']['ConvertedPriceList']['displayedmoneys'] = @$data0['PriceWithoutDelivery']['ConvertedPriceList']['DisplayedMoneys'];
		$data0['PriceWithoutDelivery']['convertedpricelist'] = @$data0['PriceWithoutDelivery']['ConvertedPriceList'];
	$data0['pricewithoutdelivery'] = @$data0['PriceWithoutDelivery'];
	return $data0;
    }
    public function GetItemPrice($quantity, $itemId, $promotionId, $configurationId){
        $params = array(
            'quantity' => $quantity,
	    'itemId' => $itemId,
	    'promotionId' => $promotionId,
	    'configurationId' => $configurationId
        );
        $params += $this->defaultLogin();
        $simplexml = $this->_getData('GetItemPrice', $params);
        if (!$simplexml) return false;
        
        $data0 = array();
        
if(!isset($data0)){$data0 = array();}
	$data0_obj = @$simplexml->Result;
if(!isset($data0['OriginalPrice'])){$data0['OriginalPrice'] = array();}
		$data1_obj = @$simplexml->Result->OriginalPrice;
		$data0['OriginalPrice'] = @$data1_obj;
	$data0['originalprice'] = @$data0['OriginalPrice'];
if(!isset($data0['MarginPrice'])){$data0['MarginPrice'] = array();}
		$data1_obj = @$simplexml->Result->MarginPrice;
		$data0['MarginPrice'] = @$data1_obj;
	$data0['marginprice'] = @$data0['MarginPrice'];
if(!isset($data0['OriginalCurrencyCode'])){$data0['OriginalCurrencyCode'] = array();}
		$data1_obj = @$simplexml->Result->OriginalCurrencyCode;
		$data0['OriginalCurrencyCode'] = @(string)$data1_obj;
	$data0['originalcurrencycode'] = @$data0['OriginalCurrencyCode'];
if(!isset($data0['ConvertedPriceList'])){$data0['ConvertedPriceList'] = array();}
		$data1_obj = @$simplexml->Result->ConvertedPriceList;
if(!isset($data0['ConvertedPriceList']['Internal'])){$data0['ConvertedPriceList']['Internal'] = array();}
			$data2_obj = @$simplexml->Result->ConvertedPriceList->Internal;
			$data0['ConvertedPriceList']['Internal'] = @$data2_obj;
		$data0['ConvertedPriceList']['internal'] = @$data0['ConvertedPriceList']['Internal'];
if(!isset($data0['ConvertedPriceList']['DisplayedMoneys'])){$data0['ConvertedPriceList']['DisplayedMoneys'] = array();}

	if(!isset($simplexml->Result->ConvertedPriceList->DisplayedMoneys) || is_null($simplexml->Result->ConvertedPriceList->DisplayedMoneys) || !$simplexml->Result->ConvertedPriceList->DisplayedMoneys)			$data2_obj = @array();

	else
			$data2_obj = @$simplexml->Result->ConvertedPriceList->DisplayedMoneys->children();
			$data0['ConvertedPriceList']['DisplayedMoneys'] = @array();
			foreach($data2_obj as $value2){
				$data0['ConvertedPriceList']['DisplayedMoneys'][] = @$value2;
			}
		$data0['ConvertedPriceList']['displayedmoneys'] = @$data0['ConvertedPriceList']['DisplayedMoneys'];
	$data0['convertedpricelist'] = @$data0['ConvertedPriceList'];
if(!isset($data0['ConvertedPrice'])){$data0['ConvertedPrice'] = array();}
		$data1_obj = @$simplexml->Result->ConvertedPrice;
		$data0['ConvertedPrice'] = @(string)$data1_obj;
	$data0['convertedprice'] = @$data0['ConvertedPrice'];
if(!isset($data0['ConvertedPriceWithoutSign'])){$data0['ConvertedPriceWithoutSign'] = array();}
		$data1_obj = @$simplexml->Result->ConvertedPriceWithoutSign;
		$data0['ConvertedPriceWithoutSign'] = @(string)$data1_obj;
	$data0['convertedpricewithoutsign'] = @$data0['ConvertedPriceWithoutSign'];
if(!isset($data0['CurrencySign'])){$data0['CurrencySign'] = array();}
		$data1_obj = @$simplexml->Result->CurrencySign;
		$data0['CurrencySign'] = @(string)$data1_obj;
	$data0['currencysign'] = @$data0['CurrencySign'];
if(!isset($data0['CurrencyName'])){$data0['CurrencyName'] = array();}
		$data1_obj = @$simplexml->Result->CurrencyName;
		$data0['CurrencyName'] = @(string)$data1_obj;
	$data0['currencyname'] = @$data0['CurrencyName'];
if(!isset($data0['IsDeliverable'])){$data0['IsDeliverable'] = array();}
		$data1_obj = @$simplexml->Result->IsDeliverable;
		$data0['IsDeliverable'] = @$data1_obj;
	$data0['isdeliverable'] = @$data0['IsDeliverable'];
if(!isset($data0['DeliveryPrice'])){$data0['DeliveryPrice'] = array();}
		$data1_obj = @$simplexml->Result->DeliveryPrice;
if(!isset($data0['DeliveryPrice']['OriginalPrice'])){$data0['DeliveryPrice']['OriginalPrice'] = array();}
			$data2_obj = @$simplexml->Result->DeliveryPrice->OriginalPrice;
			$data0['DeliveryPrice']['OriginalPrice'] = @$data2_obj;
		$data0['DeliveryPrice']['originalprice'] = @$data0['DeliveryPrice']['OriginalPrice'];
if(!isset($data0['DeliveryPrice']['MarginPrice'])){$data0['DeliveryPrice']['MarginPrice'] = array();}
			$data2_obj = @$simplexml->Result->DeliveryPrice->MarginPrice;
			$data0['DeliveryPrice']['MarginPrice'] = @$data2_obj;
		$data0['DeliveryPrice']['marginprice'] = @$data0['DeliveryPrice']['MarginPrice'];
if(!isset($data0['DeliveryPrice']['OriginalCurrencyCode'])){$data0['DeliveryPrice']['OriginalCurrencyCode'] = array();}
			$data2_obj = @$simplexml->Result->DeliveryPrice->OriginalCurrencyCode;
			$data0['DeliveryPrice']['OriginalCurrencyCode'] = @(string)$data2_obj;
		$data0['DeliveryPrice']['originalcurrencycode'] = @$data0['DeliveryPrice']['OriginalCurrencyCode'];
if(!isset($data0['DeliveryPrice']['ConvertedPriceList'])){$data0['DeliveryPrice']['ConvertedPriceList'] = array();}
			$data2_obj = @$simplexml->Result->DeliveryPrice->ConvertedPriceList;
if(!isset($data0['DeliveryPrice']['ConvertedPriceList']['Internal'])){$data0['DeliveryPrice']['ConvertedPriceList']['Internal'] = array();}
				$data3_obj = @$simplexml->Result->DeliveryPrice->ConvertedPriceList->Internal;
				$data0['DeliveryPrice']['ConvertedPriceList']['Internal'] = @$data3_obj;
			$data0['DeliveryPrice']['ConvertedPriceList']['internal'] = @$data0['DeliveryPrice']['ConvertedPriceList']['Internal'];
if(!isset($data0['DeliveryPrice']['ConvertedPriceList']['DisplayedMoneys'])){$data0['DeliveryPrice']['ConvertedPriceList']['DisplayedMoneys'] = array();}

	if(!isset($simplexml->Result->DeliveryPrice->ConvertedPriceList->DisplayedMoneys) || is_null($simplexml->Result->DeliveryPrice->ConvertedPriceList->DisplayedMoneys) || !$simplexml->Result->DeliveryPrice->ConvertedPriceList->DisplayedMoneys)				$data3_obj = @array();

	else
				$data3_obj = @$simplexml->Result->DeliveryPrice->ConvertedPriceList->DisplayedMoneys->children();
				$data0['DeliveryPrice']['ConvertedPriceList']['DisplayedMoneys'] = @array();
				foreach($data3_obj as $value3){
					$data0['DeliveryPrice']['ConvertedPriceList']['DisplayedMoneys'][] = @$value3;
				}
			$data0['DeliveryPrice']['ConvertedPriceList']['displayedmoneys'] = @$data0['DeliveryPrice']['ConvertedPriceList']['DisplayedMoneys'];
		$data0['DeliveryPrice']['convertedpricelist'] = @$data0['DeliveryPrice']['ConvertedPriceList'];
	$data0['deliveryprice'] = @$data0['DeliveryPrice'];
if(!isset($data0['OneItemDeliveryPrice'])){$data0['OneItemDeliveryPrice'] = array();}
		$data1_obj = @$simplexml->Result->OneItemDeliveryPrice;
if(!isset($data0['OneItemDeliveryPrice']['OriginalPrice'])){$data0['OneItemDeliveryPrice']['OriginalPrice'] = array();}
			$data2_obj = @$simplexml->Result->OneItemDeliveryPrice->OriginalPrice;
			$data0['OneItemDeliveryPrice']['OriginalPrice'] = @$data2_obj;
		$data0['OneItemDeliveryPrice']['originalprice'] = @$data0['OneItemDeliveryPrice']['OriginalPrice'];
if(!isset($data0['OneItemDeliveryPrice']['MarginPrice'])){$data0['OneItemDeliveryPrice']['MarginPrice'] = array();}
			$data2_obj = @$simplexml->Result->OneItemDeliveryPrice->MarginPrice;
			$data0['OneItemDeliveryPrice']['MarginPrice'] = @$data2_obj;
		$data0['OneItemDeliveryPrice']['marginprice'] = @$data0['OneItemDeliveryPrice']['MarginPrice'];
if(!isset($data0['OneItemDeliveryPrice']['OriginalCurrencyCode'])){$data0['OneItemDeliveryPrice']['OriginalCurrencyCode'] = array();}
			$data2_obj = @$simplexml->Result->OneItemDeliveryPrice->OriginalCurrencyCode;
			$data0['OneItemDeliveryPrice']['OriginalCurrencyCode'] = @(string)$data2_obj;
		$data0['OneItemDeliveryPrice']['originalcurrencycode'] = @$data0['OneItemDeliveryPrice']['OriginalCurrencyCode'];
if(!isset($data0['OneItemDeliveryPrice']['ConvertedPriceList'])){$data0['OneItemDeliveryPrice']['ConvertedPriceList'] = array();}
			$data2_obj = @$simplexml->Result->OneItemDeliveryPrice->ConvertedPriceList;
if(!isset($data0['OneItemDeliveryPrice']['ConvertedPriceList']['Internal'])){$data0['OneItemDeliveryPrice']['ConvertedPriceList']['Internal'] = array();}
				$data3_obj = @$simplexml->Result->OneItemDeliveryPrice->ConvertedPriceList->Internal;
				$data0['OneItemDeliveryPrice']['ConvertedPriceList']['Internal'] = @$data3_obj;
			$data0['OneItemDeliveryPrice']['ConvertedPriceList']['internal'] = @$data0['OneItemDeliveryPrice']['ConvertedPriceList']['Internal'];
if(!isset($data0['OneItemDeliveryPrice']['ConvertedPriceList']['DisplayedMoneys'])){$data0['OneItemDeliveryPrice']['ConvertedPriceList']['DisplayedMoneys'] = array();}

	if(!isset($simplexml->Result->OneItemDeliveryPrice->ConvertedPriceList->DisplayedMoneys) || is_null($simplexml->Result->OneItemDeliveryPrice->ConvertedPriceList->DisplayedMoneys) || !$simplexml->Result->OneItemDeliveryPrice->ConvertedPriceList->DisplayedMoneys)				$data3_obj = @array();

	else
				$data3_obj = @$simplexml->Result->OneItemDeliveryPrice->ConvertedPriceList->DisplayedMoneys->children();
				$data0['OneItemDeliveryPrice']['ConvertedPriceList']['DisplayedMoneys'] = @array();
				foreach($data3_obj as $value3){
					$data0['OneItemDeliveryPrice']['ConvertedPriceList']['DisplayedMoneys'][] = @$value3;
				}
			$data0['OneItemDeliveryPrice']['ConvertedPriceList']['displayedmoneys'] = @$data0['OneItemDeliveryPrice']['ConvertedPriceList']['DisplayedMoneys'];
		$data0['OneItemDeliveryPrice']['convertedpricelist'] = @$data0['OneItemDeliveryPrice']['ConvertedPriceList'];
	$data0['oneitemdeliveryprice'] = @$data0['OneItemDeliveryPrice'];
if(!isset($data0['PriceWithoutDelivery'])){$data0['PriceWithoutDelivery'] = array();}
		$data1_obj = @$simplexml->Result->PriceWithoutDelivery;
if(!isset($data0['PriceWithoutDelivery']['OriginalPrice'])){$data0['PriceWithoutDelivery']['OriginalPrice'] = array();}
			$data2_obj = @$simplexml->Result->PriceWithoutDelivery->OriginalPrice;
			$data0['PriceWithoutDelivery']['OriginalPrice'] = @$data2_obj;
		$data0['PriceWithoutDelivery']['originalprice'] = @$data0['PriceWithoutDelivery']['OriginalPrice'];
if(!isset($data0['PriceWithoutDelivery']['MarginPrice'])){$data0['PriceWithoutDelivery']['MarginPrice'] = array();}
			$data2_obj = @$simplexml->Result->PriceWithoutDelivery->MarginPrice;
			$data0['PriceWithoutDelivery']['MarginPrice'] = @$data2_obj;
		$data0['PriceWithoutDelivery']['marginprice'] = @$data0['PriceWithoutDelivery']['MarginPrice'];
if(!isset($data0['PriceWithoutDelivery']['OriginalCurrencyCode'])){$data0['PriceWithoutDelivery']['OriginalCurrencyCode'] = array();}
			$data2_obj = @$simplexml->Result->PriceWithoutDelivery->OriginalCurrencyCode;
			$data0['PriceWithoutDelivery']['OriginalCurrencyCode'] = @(string)$data2_obj;
		$data0['PriceWithoutDelivery']['originalcurrencycode'] = @$data0['PriceWithoutDelivery']['OriginalCurrencyCode'];
if(!isset($data0['PriceWithoutDelivery']['ConvertedPriceList'])){$data0['PriceWithoutDelivery']['ConvertedPriceList'] = array();}
			$data2_obj = @$simplexml->Result->PriceWithoutDelivery->ConvertedPriceList;
if(!isset($data0['PriceWithoutDelivery']['ConvertedPriceList']['Internal'])){$data0['PriceWithoutDelivery']['ConvertedPriceList']['Internal'] = array();}
				$data3_obj = @$simplexml->Result->PriceWithoutDelivery->ConvertedPriceList->Internal;
				$data0['PriceWithoutDelivery']['ConvertedPriceList']['Internal'] = @$data3_obj;
			$data0['PriceWithoutDelivery']['ConvertedPriceList']['internal'] = @$data0['PriceWithoutDelivery']['ConvertedPriceList']['Internal'];
if(!isset($data0['PriceWithoutDelivery']['ConvertedPriceList']['DisplayedMoneys'])){$data0['PriceWithoutDelivery']['ConvertedPriceList']['DisplayedMoneys'] = array();}

	if(!isset($simplexml->Result->PriceWithoutDelivery->ConvertedPriceList->DisplayedMoneys) || is_null($simplexml->Result->PriceWithoutDelivery->ConvertedPriceList->DisplayedMoneys) || !$simplexml->Result->PriceWithoutDelivery->ConvertedPriceList->DisplayedMoneys)				$data3_obj = @array();

	else
				$data3_obj = @$simplexml->Result->PriceWithoutDelivery->ConvertedPriceList->DisplayedMoneys->children();
				$data0['PriceWithoutDelivery']['ConvertedPriceList']['DisplayedMoneys'] = @array();
				foreach($data3_obj as $value3){
					$data0['PriceWithoutDelivery']['ConvertedPriceList']['DisplayedMoneys'][] = @$value3;
				}
			$data0['PriceWithoutDelivery']['ConvertedPriceList']['displayedmoneys'] = @$data0['PriceWithoutDelivery']['ConvertedPriceList']['DisplayedMoneys'];
		$data0['PriceWithoutDelivery']['convertedpricelist'] = @$data0['PriceWithoutDelivery']['ConvertedPriceList'];
	$data0['pricewithoutdelivery'] = @$data0['PriceWithoutDelivery'];
	return $data0;
    }
    public function GetItemTotalCost($quantity, $itemId, $promotionId, $configurationId){
        $params = array(
            'quantity' => $quantity,
	    'itemId' => $itemId,
	    'promotionId' => $promotionId,
	    'configurationId' => $configurationId
        );
        $params += $this->defaultLogin();
        $simplexml = $this->_getData('GetItemTotalCost', $params);
        if (!$simplexml) return false;
        
        $data0 = array();
        
if(!isset($data0)){$data0 = array();}
	$data0_obj = @$simplexml->Result;
if(!isset($data0['OriginalPrice'])){$data0['OriginalPrice'] = array();}
		$data1_obj = @$simplexml->Result->OriginalPrice;
		$data0['OriginalPrice'] = @$data1_obj;
	$data0['originalprice'] = @$data0['OriginalPrice'];
if(!isset($data0['MarginPrice'])){$data0['MarginPrice'] = array();}
		$data1_obj = @$simplexml->Result->MarginPrice;
		$data0['MarginPrice'] = @$data1_obj;
	$data0['marginprice'] = @$data0['MarginPrice'];
if(!isset($data0['OriginalCurrencyCode'])){$data0['OriginalCurrencyCode'] = array();}
		$data1_obj = @$simplexml->Result->OriginalCurrencyCode;
		$data0['OriginalCurrencyCode'] = @(string)$data1_obj;
	$data0['originalcurrencycode'] = @$data0['OriginalCurrencyCode'];
if(!isset($data0['ConvertedPriceList'])){$data0['ConvertedPriceList'] = array();}
		$data1_obj = @$simplexml->Result->ConvertedPriceList;
if(!isset($data0['ConvertedPriceList']['Internal'])){$data0['ConvertedPriceList']['Internal'] = array();}
			$data2_obj = @$simplexml->Result->ConvertedPriceList->Internal;
			$data0['ConvertedPriceList']['Internal'] = @$data2_obj;
		$data0['ConvertedPriceList']['internal'] = @$data0['ConvertedPriceList']['Internal'];
if(!isset($data0['ConvertedPriceList']['DisplayedMoneys'])){$data0['ConvertedPriceList']['DisplayedMoneys'] = array();}

	if(!isset($simplexml->Result->ConvertedPriceList->DisplayedMoneys) || is_null($simplexml->Result->ConvertedPriceList->DisplayedMoneys) || !$simplexml->Result->ConvertedPriceList->DisplayedMoneys)			$data2_obj = @array();

	else
			$data2_obj = @$simplexml->Result->ConvertedPriceList->DisplayedMoneys->children();
			$data0['ConvertedPriceList']['DisplayedMoneys'] = @array();
			foreach($data2_obj as $value2){
				$data0['ConvertedPriceList']['DisplayedMoneys'][] = @$value2;
			}
		$data0['ConvertedPriceList']['displayedmoneys'] = @$data0['ConvertedPriceList']['DisplayedMoneys'];
	$data0['convertedpricelist'] = @$data0['ConvertedPriceList'];
if(!isset($data0['ConvertedPrice'])){$data0['ConvertedPrice'] = array();}
		$data1_obj = @$simplexml->Result->ConvertedPrice;
		$data0['ConvertedPrice'] = @(string)$data1_obj;
	$data0['convertedprice'] = @$data0['ConvertedPrice'];
if(!isset($data0['ConvertedPriceWithoutSign'])){$data0['ConvertedPriceWithoutSign'] = array();}
		$data1_obj = @$simplexml->Result->ConvertedPriceWithoutSign;
		$data0['ConvertedPriceWithoutSign'] = @(string)$data1_obj;
	$data0['convertedpricewithoutsign'] = @$data0['ConvertedPriceWithoutSign'];
if(!isset($data0['CurrencySign'])){$data0['CurrencySign'] = array();}
		$data1_obj = @$simplexml->Result->CurrencySign;
		$data0['CurrencySign'] = @(string)$data1_obj;
	$data0['currencysign'] = @$data0['CurrencySign'];
if(!isset($data0['CurrencyName'])){$data0['CurrencyName'] = array();}
		$data1_obj = @$simplexml->Result->CurrencyName;
		$data0['CurrencyName'] = @(string)$data1_obj;
	$data0['currencyname'] = @$data0['CurrencyName'];
if(!isset($data0['IsDeliverable'])){$data0['IsDeliverable'] = array();}
		$data1_obj = @$simplexml->Result->IsDeliverable;
		$data0['IsDeliverable'] = @$data1_obj;
	$data0['isdeliverable'] = @$data0['IsDeliverable'];
if(!isset($data0['DeliveryPrice'])){$data0['DeliveryPrice'] = array();}
		$data1_obj = @$simplexml->Result->DeliveryPrice;
if(!isset($data0['DeliveryPrice']['OriginalPrice'])){$data0['DeliveryPrice']['OriginalPrice'] = array();}
			$data2_obj = @$simplexml->Result->DeliveryPrice->OriginalPrice;
			$data0['DeliveryPrice']['OriginalPrice'] = @$data2_obj;
		$data0['DeliveryPrice']['originalprice'] = @$data0['DeliveryPrice']['OriginalPrice'];
if(!isset($data0['DeliveryPrice']['MarginPrice'])){$data0['DeliveryPrice']['MarginPrice'] = array();}
			$data2_obj = @$simplexml->Result->DeliveryPrice->MarginPrice;
			$data0['DeliveryPrice']['MarginPrice'] = @$data2_obj;
		$data0['DeliveryPrice']['marginprice'] = @$data0['DeliveryPrice']['MarginPrice'];
if(!isset($data0['DeliveryPrice']['OriginalCurrencyCode'])){$data0['DeliveryPrice']['OriginalCurrencyCode'] = array();}
			$data2_obj = @$simplexml->Result->DeliveryPrice->OriginalCurrencyCode;
			$data0['DeliveryPrice']['OriginalCurrencyCode'] = @(string)$data2_obj;
		$data0['DeliveryPrice']['originalcurrencycode'] = @$data0['DeliveryPrice']['OriginalCurrencyCode'];
if(!isset($data0['DeliveryPrice']['ConvertedPriceList'])){$data0['DeliveryPrice']['ConvertedPriceList'] = array();}
			$data2_obj = @$simplexml->Result->DeliveryPrice->ConvertedPriceList;
if(!isset($data0['DeliveryPrice']['ConvertedPriceList']['Internal'])){$data0['DeliveryPrice']['ConvertedPriceList']['Internal'] = array();}
				$data3_obj = @$simplexml->Result->DeliveryPrice->ConvertedPriceList->Internal;
				$data0['DeliveryPrice']['ConvertedPriceList']['Internal'] = @$data3_obj;
			$data0['DeliveryPrice']['ConvertedPriceList']['internal'] = @$data0['DeliveryPrice']['ConvertedPriceList']['Internal'];
if(!isset($data0['DeliveryPrice']['ConvertedPriceList']['DisplayedMoneys'])){$data0['DeliveryPrice']['ConvertedPriceList']['DisplayedMoneys'] = array();}

	if(!isset($simplexml->Result->DeliveryPrice->ConvertedPriceList->DisplayedMoneys) || is_null($simplexml->Result->DeliveryPrice->ConvertedPriceList->DisplayedMoneys) || !$simplexml->Result->DeliveryPrice->ConvertedPriceList->DisplayedMoneys)				$data3_obj = @array();

	else
				$data3_obj = @$simplexml->Result->DeliveryPrice->ConvertedPriceList->DisplayedMoneys->children();
				$data0['DeliveryPrice']['ConvertedPriceList']['DisplayedMoneys'] = @array();
				foreach($data3_obj as $value3){
					$data0['DeliveryPrice']['ConvertedPriceList']['DisplayedMoneys'][] = @$value3;
				}
			$data0['DeliveryPrice']['ConvertedPriceList']['displayedmoneys'] = @$data0['DeliveryPrice']['ConvertedPriceList']['DisplayedMoneys'];
		$data0['DeliveryPrice']['convertedpricelist'] = @$data0['DeliveryPrice']['ConvertedPriceList'];
	$data0['deliveryprice'] = @$data0['DeliveryPrice'];
if(!isset($data0['OneItemDeliveryPrice'])){$data0['OneItemDeliveryPrice'] = array();}
		$data1_obj = @$simplexml->Result->OneItemDeliveryPrice;
if(!isset($data0['OneItemDeliveryPrice']['OriginalPrice'])){$data0['OneItemDeliveryPrice']['OriginalPrice'] = array();}
			$data2_obj = @$simplexml->Result->OneItemDeliveryPrice->OriginalPrice;
			$data0['OneItemDeliveryPrice']['OriginalPrice'] = @$data2_obj;
		$data0['OneItemDeliveryPrice']['originalprice'] = @$data0['OneItemDeliveryPrice']['OriginalPrice'];
if(!isset($data0['OneItemDeliveryPrice']['MarginPrice'])){$data0['OneItemDeliveryPrice']['MarginPrice'] = array();}
			$data2_obj = @$simplexml->Result->OneItemDeliveryPrice->MarginPrice;
			$data0['OneItemDeliveryPrice']['MarginPrice'] = @$data2_obj;
		$data0['OneItemDeliveryPrice']['marginprice'] = @$data0['OneItemDeliveryPrice']['MarginPrice'];
if(!isset($data0['OneItemDeliveryPrice']['OriginalCurrencyCode'])){$data0['OneItemDeliveryPrice']['OriginalCurrencyCode'] = array();}
			$data2_obj = @$simplexml->Result->OneItemDeliveryPrice->OriginalCurrencyCode;
			$data0['OneItemDeliveryPrice']['OriginalCurrencyCode'] = @(string)$data2_obj;
		$data0['OneItemDeliveryPrice']['originalcurrencycode'] = @$data0['OneItemDeliveryPrice']['OriginalCurrencyCode'];
if(!isset($data0['OneItemDeliveryPrice']['ConvertedPriceList'])){$data0['OneItemDeliveryPrice']['ConvertedPriceList'] = array();}
			$data2_obj = @$simplexml->Result->OneItemDeliveryPrice->ConvertedPriceList;
if(!isset($data0['OneItemDeliveryPrice']['ConvertedPriceList']['Internal'])){$data0['OneItemDeliveryPrice']['ConvertedPriceList']['Internal'] = array();}
				$data3_obj = @$simplexml->Result->OneItemDeliveryPrice->ConvertedPriceList->Internal;
				$data0['OneItemDeliveryPrice']['ConvertedPriceList']['Internal'] = @$data3_obj;
			$data0['OneItemDeliveryPrice']['ConvertedPriceList']['internal'] = @$data0['OneItemDeliveryPrice']['ConvertedPriceList']['Internal'];
if(!isset($data0['OneItemDeliveryPrice']['ConvertedPriceList']['DisplayedMoneys'])){$data0['OneItemDeliveryPrice']['ConvertedPriceList']['DisplayedMoneys'] = array();}

	if(!isset($simplexml->Result->OneItemDeliveryPrice->ConvertedPriceList->DisplayedMoneys) || is_null($simplexml->Result->OneItemDeliveryPrice->ConvertedPriceList->DisplayedMoneys) || !$simplexml->Result->OneItemDeliveryPrice->ConvertedPriceList->DisplayedMoneys)				$data3_obj = @array();

	else
				$data3_obj = @$simplexml->Result->OneItemDeliveryPrice->ConvertedPriceList->DisplayedMoneys->children();
				$data0['OneItemDeliveryPrice']['ConvertedPriceList']['DisplayedMoneys'] = @array();
				foreach($data3_obj as $value3){
					$data0['OneItemDeliveryPrice']['ConvertedPriceList']['DisplayedMoneys'][] = @$value3;
				}
			$data0['OneItemDeliveryPrice']['ConvertedPriceList']['displayedmoneys'] = @$data0['OneItemDeliveryPrice']['ConvertedPriceList']['DisplayedMoneys'];
		$data0['OneItemDeliveryPrice']['convertedpricelist'] = @$data0['OneItemDeliveryPrice']['ConvertedPriceList'];
	$data0['oneitemdeliveryprice'] = @$data0['OneItemDeliveryPrice'];
if(!isset($data0['PriceWithoutDelivery'])){$data0['PriceWithoutDelivery'] = array();}
		$data1_obj = @$simplexml->Result->PriceWithoutDelivery;
if(!isset($data0['PriceWithoutDelivery']['OriginalPrice'])){$data0['PriceWithoutDelivery']['OriginalPrice'] = array();}
			$data2_obj = @$simplexml->Result->PriceWithoutDelivery->OriginalPrice;
			$data0['PriceWithoutDelivery']['OriginalPrice'] = @$data2_obj;
		$data0['PriceWithoutDelivery']['originalprice'] = @$data0['PriceWithoutDelivery']['OriginalPrice'];
if(!isset($data0['PriceWithoutDelivery']['MarginPrice'])){$data0['PriceWithoutDelivery']['MarginPrice'] = array();}
			$data2_obj = @$simplexml->Result->PriceWithoutDelivery->MarginPrice;
			$data0['PriceWithoutDelivery']['MarginPrice'] = @$data2_obj;
		$data0['PriceWithoutDelivery']['marginprice'] = @$data0['PriceWithoutDelivery']['MarginPrice'];
if(!isset($data0['PriceWithoutDelivery']['OriginalCurrencyCode'])){$data0['PriceWithoutDelivery']['OriginalCurrencyCode'] = array();}
			$data2_obj = @$simplexml->Result->PriceWithoutDelivery->OriginalCurrencyCode;
			$data0['PriceWithoutDelivery']['OriginalCurrencyCode'] = @(string)$data2_obj;
		$data0['PriceWithoutDelivery']['originalcurrencycode'] = @$data0['PriceWithoutDelivery']['OriginalCurrencyCode'];
if(!isset($data0['PriceWithoutDelivery']['ConvertedPriceList'])){$data0['PriceWithoutDelivery']['ConvertedPriceList'] = array();}
			$data2_obj = @$simplexml->Result->PriceWithoutDelivery->ConvertedPriceList;
if(!isset($data0['PriceWithoutDelivery']['ConvertedPriceList']['Internal'])){$data0['PriceWithoutDelivery']['ConvertedPriceList']['Internal'] = array();}
				$data3_obj = @$simplexml->Result->PriceWithoutDelivery->ConvertedPriceList->Internal;
				$data0['PriceWithoutDelivery']['ConvertedPriceList']['Internal'] = @$data3_obj;
			$data0['PriceWithoutDelivery']['ConvertedPriceList']['internal'] = @$data0['PriceWithoutDelivery']['ConvertedPriceList']['Internal'];
if(!isset($data0['PriceWithoutDelivery']['ConvertedPriceList']['DisplayedMoneys'])){$data0['PriceWithoutDelivery']['ConvertedPriceList']['DisplayedMoneys'] = array();}

	if(!isset($simplexml->Result->PriceWithoutDelivery->ConvertedPriceList->DisplayedMoneys) || is_null($simplexml->Result->PriceWithoutDelivery->ConvertedPriceList->DisplayedMoneys) || !$simplexml->Result->PriceWithoutDelivery->ConvertedPriceList->DisplayedMoneys)				$data3_obj = @array();

	else
				$data3_obj = @$simplexml->Result->PriceWithoutDelivery->ConvertedPriceList->DisplayedMoneys->children();
				$data0['PriceWithoutDelivery']['ConvertedPriceList']['DisplayedMoneys'] = @array();
				foreach($data3_obj as $value3){
					$data0['PriceWithoutDelivery']['ConvertedPriceList']['DisplayedMoneys'][] = @$value3;
				}
			$data0['PriceWithoutDelivery']['ConvertedPriceList']['displayedmoneys'] = @$data0['PriceWithoutDelivery']['ConvertedPriceList']['DisplayedMoneys'];
		$data0['PriceWithoutDelivery']['convertedpricelist'] = @$data0['PriceWithoutDelivery']['ConvertedPriceList'];
	$data0['pricewithoutdelivery'] = @$data0['PriceWithoutDelivery'];
	return $data0;
    }
    public function GetInstanceCurrencyRateList(){
        $params = array(
            
        );
        $params += $this->defaultLogin();
        $simplexml = $this->_getData('GetInstanceCurrencyRateList', $params);
        if (!$simplexml) return false;
        
        $data0 = array();
        
if(!isset($data0)){$data0 = array();}

	if(!isset($simplexml->Result->Content) || is_null($simplexml->Result->Content) || !$simplexml->Result->Content)	$data0_obj = @array();

	else
	$data0_obj = @$simplexml->Result->Content->children();
	$data0 = @array();
	foreach($data0_obj as $value0){
		$data0[] = @$value0;
	}
	return $data0;
    }
    public function GetCurrencyInstanceList(){
        $params = array(
            
        );
        $params += $this->defaultLogin();
        $simplexml = $this->_getData('GetCurrencyInstanceList', $params);
        if (!$simplexml) return false;
        
        $data0 = array();
        
if(!isset($data0)){$data0 = array();}
	$data0_obj = @$simplexml->Result;
if(!isset($data0['Internal'])){$data0['Internal'] = array();}
		$data1_obj = @$simplexml->Result->Internal;
if(!isset($data0['Internal']['Code'])){$data0['Internal']['Code'] = array();}
			$data2_obj = @$simplexml->Result->Internal->Code;
			$data0['Internal']['Code'] = @(string)$data2_obj;
		$data0['Internal']['code'] = @$data0['Internal']['Code'];
if(!isset($data0['Internal']['Description'])){$data0['Internal']['Description'] = array();}
			$data2_obj = @$simplexml->Result->Internal->Description;
			$data0['Internal']['Description'] = @(string)$data2_obj;
		$data0['Internal']['description'] = @$data0['Internal']['Description'];
if(!isset($data0['Internal']['Sign'])){$data0['Internal']['Sign'] = array();}
			$data2_obj = @$simplexml->Result->Internal->Sign;
			$data0['Internal']['Sign'] = @(string)$data2_obj;
		$data0['Internal']['sign'] = @$data0['Internal']['Sign'];
	$data0['internal'] = @$data0['Internal'];
if(!isset($data0['DisplayedMoneys'])){$data0['DisplayedMoneys'] = array();}

	if(!isset($simplexml->Result->DisplayedMoneys) || is_null($simplexml->Result->DisplayedMoneys) || !$simplexml->Result->DisplayedMoneys)		$data1_obj = @array();

	else
		$data1_obj = @$simplexml->Result->DisplayedMoneys->children();
		$data0['DisplayedMoneys'] = @array();
		foreach($data1_obj as $value1){
			$data1_tmp = @array();
			$data1_tmp['Code'] = @(string)$value1->Code;
			$data1_tmp['code'] = @(string)$value1->Code;
			$data1_tmp['Description'] = @(string)$value1->Description;
			$data1_tmp['description'] = @(string)$value1->Description;
			$data1_tmp['Sign'] = @(string)$value1->Sign;
			$data1_tmp['sign'] = @(string)$value1->Sign;
			$data0['DisplayedMoneys'][] = @$data1_tmp;
		}
	$data0['displayedmoneys'] = @$data0['DisplayedMoneys'];
	return $data0;
    }
    public function AddPrices($xmlFirst, $xmlSecond){
        $params = array(
            'xmlFirst' => $xmlFirst,
	    'xmlSecond' => $xmlSecond
        );
        $params += $this->defaultLogin();
        $simplexml = $this->_getData('AddPrices', $params);
        if (!$simplexml) return false;
        
        $data0 = array();
        
if(!isset($data0)){$data0 = array();}
	$data0_obj = @$simplexml->Result;
if(!isset($data0['OriginalPrice'])){$data0['OriginalPrice'] = array();}
		$data1_obj = @$simplexml->Result->OriginalPrice;
		$data0['OriginalPrice'] = @$data1_obj;
	$data0['originalprice'] = @$data0['OriginalPrice'];
if(!isset($data0['MarginPrice'])){$data0['MarginPrice'] = array();}
		$data1_obj = @$simplexml->Result->MarginPrice;
		$data0['MarginPrice'] = @$data1_obj;
	$data0['marginprice'] = @$data0['MarginPrice'];
if(!isset($data0['OriginalCurrencyCode'])){$data0['OriginalCurrencyCode'] = array();}
		$data1_obj = @$simplexml->Result->OriginalCurrencyCode;
		$data0['OriginalCurrencyCode'] = @(string)$data1_obj;
	$data0['originalcurrencycode'] = @$data0['OriginalCurrencyCode'];
if(!isset($data0['ConvertedPriceList'])){$data0['ConvertedPriceList'] = array();}
		$data1_obj = @$simplexml->Result->ConvertedPriceList;
if(!isset($data0['ConvertedPriceList']['Internal'])){$data0['ConvertedPriceList']['Internal'] = array();}
			$data2_obj = @$simplexml->Result->ConvertedPriceList->Internal;
			$data0['ConvertedPriceList']['Internal'] = @$data2_obj;
		$data0['ConvertedPriceList']['internal'] = @$data0['ConvertedPriceList']['Internal'];
if(!isset($data0['ConvertedPriceList']['DisplayedMoneys'])){$data0['ConvertedPriceList']['DisplayedMoneys'] = array();}

	if(!isset($simplexml->Result->ConvertedPriceList->DisplayedMoneys) || is_null($simplexml->Result->ConvertedPriceList->DisplayedMoneys) || !$simplexml->Result->ConvertedPriceList->DisplayedMoneys)			$data2_obj = @array();

	else
			$data2_obj = @$simplexml->Result->ConvertedPriceList->DisplayedMoneys->children();
			$data0['ConvertedPriceList']['DisplayedMoneys'] = @array();
			foreach($data2_obj as $value2){
				$data0['ConvertedPriceList']['DisplayedMoneys'][] = @$value2;
			}
		$data0['ConvertedPriceList']['displayedmoneys'] = @$data0['ConvertedPriceList']['DisplayedMoneys'];
	$data0['convertedpricelist'] = @$data0['ConvertedPriceList'];
	return $data0;
    }
    public function AddPriceFormationGroup($sessionId, $xmlPriceFormationGroupInfo){
        $params = array(
            'sessionId' => $sessionId,
	    'xmlPriceFormationGroupInfo' => $xmlPriceFormationGroupInfo
        );
        $params += $this->defaultLogin();
        $simplexml = $this->_getData('AddPriceFormationGroup', $params);
        if (!$simplexml) return false;
        
        $data0 = array();
        
if(!isset($data0)){$data0 = array();}
	$data0_obj = @$simplexml->Result;
	$data0 = @$data0_obj;
	return $data0;
    }
    public function EditPriceFormationGroup($sessionId, $priceFormationGroupId, $xmlPriceFormationGroupInfo){
        $params = array(
            'sessionId' => $sessionId,
	    'priceFormationGroupId' => $priceFormationGroupId,
	    'xmlPriceFormationGroupInfo' => $xmlPriceFormationGroupInfo
        );
        $params += $this->defaultLogin();
        $simplexml = $this->_getData('EditPriceFormationGroup', $params);
        if (!$simplexml) return false;
        
        $data0 = array();
        
if(!isset($data0)){$data0 = array();}
	$data0_obj = @$simplexml;
	$data0 = @$data0_obj;
	return $data0;
    }
public function GetPriceFormationGroupList($sessionId) {
    $params = array(
        'sessionId' => $sessionId
    );
    $params += $this->defaultLogin();
    $simplexml = $this->_getData('GetPriceFormationGroupList', $params);
    if (!$simplexml) return false;

    $data0 = array();


    if(is_null($simplexml->Result) || !$simplexml->Result)	$data0_obj = array();

    else
    $data0_obj = $simplexml->Result->Content->children();

    $data0 = array();
    foreach($data0_obj as $value0) {
        $data1_obj = $value0->Settings;
        $data2_obj = (string)$value0->Settings->MarginPercent;
        $data0_tmp = array();
        $data0_tmp['Name'] = (string)$value0['Name'];
        $data0_tmp['name'] = (string)$value0['Name'];
        $data0_tmp['Description'] = (string)$value0['Description'];
        $data0_tmp['description'] = (string)$value0['Description'];
        $data0_tmp['IsDefault'] = (string)$value0['IsDefault'];
        $data0_tmp['isdefault'] = (string)$value0['IsDefault'];
        $data0_tmp['StrategyType'] = (string)$value0['StrategyType'];
        $data0_tmp['strategytype'] = (string)$value0['StrategyType'];
        $data2_obj = (string)$value0->Id;
        $data0_tmp['Id'] = $data2_obj;
        $data0_tmp['id'] = $data2_obj;
        $data0_tmp['Settings']['MarginPercent'] = $data2_obj;
        $data0_tmp['Settings']['marginpercent'] = $data0_tmp['Settings']['MarginPercent'];
        $data2_obj = (string)$value0->Settings->MinimumLimit;
        $data0_tmp['Settings']['MinimumLimit'] = $data2_obj;
        $data0_tmp['Settings']['minimumlimit'] = $data0_tmp['Settings']['MinimumLimit'];
        $data2_obj = (string)$value0->Settings->MaximumLimit;
        $data0_tmp['Settings']['MaximumLimit'] = $data2_obj;
        $data0_tmp['Settings']['maximumlimit'] = $data0_tmp['Settings']['MaximumLimit'];
        $data2_obj = (string)$value0->Settings->MinimumMargin;
        $data0_tmp['Settings']['MinimumMargin'] = $data2_obj;
        $data0_tmp['Settings']['minimummargin'] = $data0_tmp['Settings']['MinimumMargin'];
        $data2_obj = (string)$value0->Settings->MaximumMargin;
        $data0_tmp['Settings']['MaximumMargin'] = $data2_obj;
        $data0_tmp['Settings']['maximummargin'] = $data0_tmp['Settings']['MaximumMargin'];
        $data2_obj = (string)$value0->Settings->InternalDeliveryPrice;
        $data0_tmp['Settings']['InternalDeliveryPrice'] = $data2_obj;
        $data0_tmp['Settings']['internaldeliveryprice'] = $data0_tmp['Settings']['InternalDeliveryPrice'];

        if(is_null($value0->Settings->PriceFormationIntervals) || !$value0->Settings->PriceFormationIntervals) {			
            $data2_obj = array();
        } else {
            $data2_obj = $value0->Settings->PriceFormationIntervals->children();
        }

        $data0_tmp['Settings']['PriceFormationIntervals'] = array();
        foreach($data2_obj as $value2) {
            $data0_tmp2 = array();
            $data0_tmp2['Id'] = (string)$value2['Id'];
            $data0_tmp2['id'] = (string)$value2['Id'];
            $data0_tmp2['MarginPercent'] = (string)$value2->MarginPercent;
            $data0_tmp2['marginpercent'] = (string)$value2->MarginPercent;
            $data0_tmp2['MarginFixed'] = (string)$value2->MarginFixed;
            $data0_tmp2['marginfixed'] = (string)$value2->MarginFixed;
            $data0_tmp2['MinimumLimit'] = (string)$value2->MinimumLimit;
            $data0_tmp2['minimumlimit'] = (string)$value2->MinimumLimit;
            $data0_tmp2['internaldeliveryprice'] = (string)$value2->InternalDeliveryPrice;
            $data0_tmp2['internaldeliveryprice'] = (string)$value2->InternalDeliveryPrice;
            $data0_tmp['Settings']['PriceFormationIntervals'][] = $data0_tmp2;
            $data0_tmp['Settings']['priceformationintervals'][] = $data0_tmp2;
        }
        $data0_tmp['settings'] = $data0_tmp['Settings'];
        $data0[] = $data0_tmp;
    }
    return $data0;
}public function GetPriceFormationGroup($sessionId, $priceFormationGroupId){
    $params = array(
        'sessionId' => $sessionId,
        'priceFormationGroupId' => $priceFormationGroupId
    );
    $params += $this->defaultLogin();
    $simplexml = $this->_getData('GetPriceFormationGroup', $params);
    if (!$simplexml) return false;

    $data0 = array();

    $value0 = @$simplexml->Result;

    $data1_obj = $value0->Settings;
    $data2_obj = (string)$value0->Settings->MarginPercent;
    $data0_tmp['Name'] = (string)$value0['Name'];
    $data0_tmp['name'] = (string)$value0['Name'];
    $data0_tmp['Description'] = (string)$value0['Description'];
    $data0_tmp['description'] = (string)$value0['Description'];
    $data0_tmp['IsDefault'] = (string)$value0['IsDefault'];
    $data0_tmp['isdefault'] = (string)$value0['IsDefault'];
    $data0_tmp['StrategyType'] = (string)$value0['StrategyType'];
    $data0_tmp['strategytype'] = (string)$value0['StrategyType'];
    $data2_obj = (string)$value0->Id;
    $data0_tmp['Id'] = $data2_obj;
    $data0_tmp['id'] = $data2_obj;
    $data0_tmp['Settings']['MarginPercent'] = $data2_obj;
    $data0_tmp['Settings']['marginpercent'] = $data0_tmp['Settings']['MarginPercent'];
    $data2_obj = (string)$value0->Settings->MinimumLimit;
    $data0_tmp['Settings']['MinimumLimit'] = $data2_obj;
    $data0_tmp['Settings']['minimumlimit'] = $data0_tmp['Settings']['MinimumLimit'];
    $data2_obj = (string)$value0->Settings->MaximumLimit;
    $data0_tmp['Settings']['MaximumLimit'] = $data2_obj;
    $data0_tmp['Settings']['maximumlimit'] = $data0_tmp['Settings']['MaximumLimit'];
    $data2_obj = (string)$value0->Settings->MinimumMargin;
    $data0_tmp['Settings']['MinimumMargin'] = $data2_obj;
    $data0_tmp['Settings']['minimummargin'] = $data0_tmp['Settings']['MinimumMargin'];
    $data2_obj = (string)$value0->Settings->MaximumMargin;
    $data0_tmp['Settings']['MaximumMargin'] = $data2_obj;
    $data0_tmp['Settings']['maximummargin'] = $data0_tmp['Settings']['MaximumMargin'];
    $data2_obj = (string)$value0->Settings->InternalDeliveryPrice;
    $data0_tmp['Settings']['InternalDeliveryPrice'] = $data2_obj;
    $data0_tmp['Settings']['internaldeliveryprice'] = $data0_tmp['Settings']['InternalDeliveryPrice'];

    if(is_null($value0->Settings->PriceFormationIntervals) || !$value0->Settings->PriceFormationIntervals) {			
        $data2_obj = array();
    } else {
        $data2_obj = $value0->Settings->PriceFormationIntervals->children();
    }

    $data0_tmp['Settings']['PriceFormationIntervals'] = array();
    foreach($data2_obj as $value2) {
        $data0_tmp2 = array();
        $data0_tmp2['Id'] = (string)$value2['Id'];
        $data0_tmp2['id'] = (string)$value2['Id'];
        $data0_tmp2['MarginPercent'] = (string)$value2->MarginPercent;
        $data0_tmp2['marginpercent'] = (string)$value2->MarginPercent;
        $data0_tmp2['MinimumLimit'] = (string)$value2->MinimumLimit;
        $data0_tmp2['minimumlimit'] = (string)$value2->MinimumLimit;
        $data0_tmp2['MarginFixed'] = (string)$value2->MarginFixed;
        $data0_tmp2['marginfixed'] = (string)$value2->MarginFixed;
        $data0_tmp2['internaldeliveryprice'] = (string)$value2->InternalDeliveryPrice;
        $data0_tmp2['internaldeliveryprice'] = (string)$value2->InternalDeliveryPrice;
        $data0_tmp['Settings']['PriceFormationIntervals'][] = $data0_tmp2;
        $data0_tmp['Settings']['priceformationintervals'][] = $data0_tmp2;
        
    }
    $data0_tmp['settings'] = $data0_tmp['Settings'];
    $data0 = $data0_tmp;
    return $data0;
}public function GetPriceFormationStrategyList($sessionId){
    $params = array(
        'sessionId' => $sessionId
    );
    $params += $this->defaultLogin();
    $simplexml = $this->_getData('GetPriceFormationStrategyList', $params);
    if (!$simplexml) return false;

    $data0 = array();
    //var_dump($simplexml);


    if(is_null($simplexml->Result->Content) || !$simplexml->Result->Content)	$data0_obj = array();

    else
    $data0_obj = $simplexml->Result->Content->children();
    $data0 = array();
    foreach($data0_obj as $value0){
        $data0_tmp['Id'] = (string)$value0->Id->Value;
        $data0_tmp['id'] = (string)$value0->Id->Value;
        $data0_tmp['Name'] = (string)$value0['Name'];
        $data0_tmp['name'] = (string)$value0['Name'];
        $data0_tmp['Description'] = (string)$value0['Description'];
        $data0_tmp['description'] = (string)$value0['Description'];
        $data0[] = $data0_tmp;
    }
    return $data0;
}
    public function GetPriceFormationStrategy($sessionId, $strategyId){
        $params = array(
            'sessionId' => $sessionId,
	    'strategyId' => $strategyId
        );
        $params += $this->defaultLogin();
        $simplexml = $this->_getData('GetPriceFormationStrategy', $params);
        if (!$simplexml) return false;
        
        $data0 = array();
        
if(!isset($data0)){$data0 = array();}
	$data0_obj = @$simplexml->Result;
	$data0['name'] = @$data0['Name'];
	$data0['description'] = @$data0['Description'];
if(!isset($data0['Id'])){$data0['Id'] = array();}
		$data1_obj = @$simplexml->Result->Id->Value;
		$data0['Id'] = @$data1_obj;
	$data0['id'] = @$data0['Id'];
	return $data0;
    }
    public function SetPriceFormationGroupToCategory($sessionId, $categoryId, $priceFormationGroupId){
        $params = array(
            'sessionId' => $sessionId,
	    'categoryId' => $categoryId,
	    'priceFormationGroupId' => $priceFormationGroupId
        );
        $params += $this->defaultLogin();
        $simplexml = $this->_getData('SetPriceFormationGroupToCategory', $params);
        if (!$simplexml) return false;
        
        $data0 = array();
        
if(!isset($data0)){$data0 = array();}
	$data0_obj = @$simplexml;
	$data0 = @$data0_obj;
	return $data0;
    }
    public function SetDefaultPriceFormationGroup($sessionId, $priceFormationGroupId){
        $params = array(
            'sessionId' => $sessionId,
	    'priceFormationGroupId' => $priceFormationGroupId
        );
        $params += $this->defaultLogin();
        $simplexml = $this->_getData('SetDefaultPriceFormationGroup', $params);
        if (!$simplexml) return false;
        
        $data0 = array();
        
if(!isset($data0)){$data0 = array();}
	$data0_obj = @$simplexml;
	$data0 = @$data0_obj;
	return $data0;
    }
    public function RemovePriceFormationGroup($sessionId, $priceFormationGroupId){
        $params = array(
            'sessionId' => $sessionId,
	    'priceFormationGroupId' => $priceFormationGroupId
        );
        $params += $this->defaultLogin();
        $simplexml = $this->_getData('RemovePriceFormationGroup', $params);
        if (!$simplexml) return false;
        
        $data0 = array();
        
if(!isset($data0)){$data0 = array();}
	$data0_obj = @$simplexml;
	$data0 = @$data0_obj;
	return $data0;
    }
    public function RemoveCategoryFromPriceFormationGroup($sessionId, $categoryId, $priceFormationGroupId){
        $params = array(
            'sessionId' => $sessionId,
	    'categoryId' => $categoryId,
	    'priceFormationGroupId' => $priceFormationGroupId
        );
        $params += $this->defaultLogin();
        $simplexml = $this->_getData('RemoveCategoryFromPriceFormationGroup', $params);
        if (!$simplexml) return false;
        
        $data0 = array();
        
if(!isset($data0)){$data0 = array();}
	$data0_obj = @$simplexml;
	$data0 = @$data0_obj;
	return $data0;
    }
    public function GetCategoriesOfPriceFormationGroup($sessionId, $priceFormationGroupId){
        $params = array(
            'sessionId' => $sessionId,
	    'priceFormationGroupId' => $priceFormationGroupId
        );
        $params += $this->defaultLogin();
        $simplexml = $this->_getData('GetCategoriesOfPriceFormationGroup', $params);
        if (!$simplexml) return false;
        
        $data0 = array();
        
if(!isset($data0)){$data0 = array();}

	if(!isset($simplexml->CategoryInfoList->Content) || is_null($simplexml->CategoryInfoList->Content) || !$simplexml->CategoryInfoList->Content)	$data0_obj = @array();

	else
	$data0_obj = @$simplexml->CategoryInfoList->Content->children();
	$data0 = @array();
	foreach($data0_obj as $value0){
		$data0_tmp = @array();
		$data0_tmp['IsHidden'] = @$value0->IsHidden;
		$data0_tmp['ishidden'] = @$value0->IsHidden;
		$data0_tmp['IsVirtual'] = @$value0->IsVirtual;
		$data0_tmp['isvirtual'] = @$value0->IsVirtual;
		$data0_tmp['Id'] = @(string)$value0->Id;
		$data0_tmp['id'] = @(string)$value0->Id;
		$data0_tmp['ExternalId'] = @(string)$value0->ExternalId;
		$data0_tmp['externalid'] = @(string)$value0->ExternalId;
		$data0_tmp['Name'] = @(string)$value0->Name;
		$data0_tmp['name'] = @(string)$value0->Name;
		$data0_tmp['IsParent'] = @$value0->IsParent;
		$data0_tmp['isparent'] = @$value0->IsParent;
		$data0_tmp['ParentId'] = @(string)$value0->ParentId;
		$data0_tmp['parentid'] = @(string)$value0->ParentId;
		$data0_tmp['ApproxWeight'] = @$value0->ApproxWeight;
		$data0_tmp['approxweight'] = @$value0->ApproxWeight;
if (isset($value0->RootPath)){ $data0_tmp['path'] = $this->_parseCategotyInfo($value0->RootPath->Content->children()); }		$data0[] = @$data0_tmp;
	}
	return $data0;
    }
    public function GetPriceFormationSettings($sessionId){
        $params = array(
            'sessionId' => $sessionId
        );
        $params += $this->defaultLogin();
        $simplexml = $this->_getData('GetPriceFormationSettings', $params);
        if (!$simplexml) return false;
        
        $data0 = array();
        
if(!isset($data0)){$data0 = array();}
	$data0_obj = @$simplexml->Result;
	$data0['priceroundingfactor'] = @$data0['PriceRoundingFactor'];
	return $data0;
    }
    public function EditPriceFormationSettings($sessionId, $xmlPriceFormationSettings){
        $params = array(
            'sessionId' => $sessionId,
	    'xmlPriceFormationSettings' => $xmlPriceFormationSettings
        );
        $params += $this->defaultLogin();
        $simplexml = $this->_getData('EditPriceFormationSettings', $params);
        if (!$simplexml) return false;
        
        $data0 = array();
        
if(!isset($data0)){$data0 = array();}
	$data0_obj = @$simplexml;
	$data0 = @$data0_obj;
	return $data0;
    }
    public function GetAvailableFeatureInfoList(){
        $params = array(
            
        );
        $params += $this->defaultLogin();
        $simplexml = $this->_getData('GetAvailableFeatureInfoList', $params);
        if (!$simplexml) return false;
        
        $data0 = array();
        
if(!isset($data0)){$data0 = array();}

	if(!isset($simplexml->Result->Content) || is_null($simplexml->Result->Content) || !$simplexml->Result->Content)	$data0_obj = @array();

	else
	$data0_obj = @$simplexml->Result->Content->children();
	$data0 = @array();
	foreach($data0_obj as $value0){
		$data0_tmp = @array();
		$data0_tmp['Name'] = @(string)$value0->Name;
		$data0_tmp['name'] = @(string)$value0->Name;
		$data0_tmp['Description'] = @(string)$value0->Description;
		$data0_tmp['description'] = @(string)$value0->Description;
if(!isset($data0_tmp['Types'])){$data0_tmp['Types'] = array();}

	if(!isset($value0->Types) || is_null($value0->Types) || !$value0->Types)		$data1_obj = @array();

	else
		$data1_obj = @$value0->Types->children();
		$data0_tmp['Types'] = @array();
		foreach($data1_obj as $value1){
			$data0_tmp['Types'][] = @$value1;
		}
		$data0[] = @$data0_tmp;
	}
	return $data0;
    }
    public function RegisterUser($userParameters){
        $params = array(
            'userParameters' => $userParameters
        );
        $params += $this->defaultLogin();
        $simplexml = $this->_getData('RegisterUser', $params);
        if (!$simplexml) return false;
        
        $data0 = array();
        
if(!isset($data0)){$data0 = array();}
	$data0_obj = @$simplexml->EmailConfirmationInfo;
if(!isset($data0['IsEmailVerificationUsed'])){$data0['IsEmailVerificationUsed'] = array();}
		$data1_obj = @$simplexml->EmailConfirmationInfo->IsEmailVerificationUsed;
		$data0['IsEmailVerificationUsed'] = @$data1_obj;
	$data0['isemailverificationused'] = @$data0['IsEmailVerificationUsed'];
if(!isset($data0['EmailConfirmationCode'])){$data0['EmailConfirmationCode'] = array();}
		$data1_obj = @$simplexml->EmailConfirmationInfo->EmailConfirmationCode;
		$data0['EmailConfirmationCode'] = @(string)$data1_obj;
	$data0['emailconfirmationcode'] = @$data0['EmailConfirmationCode'];

	$data0['ErrorCode'] = $simplexml->ErrorCode;
	$data0['ErrorDescription'] = $simplexml->ErrorDescription;
	return $data0;
    }
    public function Authenticate($sessionId, $userLogin, $userPassword, $rememberMe){
        $params = array(
            'sessionId' => $sessionId,
	    'userLogin' => $userLogin,
	    'userPassword' => $userPassword,
	    'rememberMe' => $rememberMe
        );
        $params += $this->defaultLogin();
        $simplexml = $this->_getData('Authenticate', $params);
        if (!$simplexml) return false;
        
        $data0 = array();
        
if(!isset($data0)){$data0 = array();}
	$data0_obj = @$simplexml->SessionId;
	$data0 = @(string)$data0_obj;
	return $data0;
    }
    public function ChangePassword($sessionId, $currentPassword, $newPassword){
        $params = array(
            'sessionId' => $sessionId,
	    'currentPassword' => $currentPassword,
	    'newPassword' => $newPassword
        );
        $params += $this->defaultLogin();
        $simplexml = $this->_getData('ChangePassword', $params);
        if (!$simplexml) return false;
        
        $data0 = array();
        
if(!isset($data0)){$data0 = array();}
	$data0_obj = @$simplexml;
	$data0 = @$data0_obj;
	return $data0;
    }
    public function RequestPasswordRecovery($userIdentifier){
        $params = array(
            'userIdentifier' => $userIdentifier
        );
        $params += $this->defaultLogin();
        $simplexml = $this->_getData('RequestPasswordRecovery', $params);
        if (!$simplexml) return false;
        
        $data0 = array();
        
if(!isset($data0)){$data0 = array();}
	$data0_obj = @$simplexml->Result;
if(!isset($data0['Email'])){$data0['Email'] = array();}
		$data1_obj = @$simplexml->Result->Email;
		$data0['Email'] = @(string)$data1_obj;
	$data0['email'] = @$data0['Email'];
if(!isset($data0['ConfirmationCode'])){$data0['ConfirmationCode'] = array();}
		$data1_obj = @$simplexml->Result->ConfirmationCode;
		$data0['ConfirmationCode'] = @(string)$data1_obj;
	$data0['confirmationcode'] = @$data0['ConfirmationCode'];
	return $data0;
    }
    public function ConfirmPasswordRecovery($confirmationCode){
        $params = array(
            'confirmationCode' => $confirmationCode
        );
        $params += $this->defaultLogin();
        $simplexml = $this->_getData('ConfirmPasswordRecovery', $params);
        if (!$simplexml) return false;
        
        $data0 = array();
        
if(!isset($data0)){$data0 = array();}
	$data0_obj = @$simplexml->Result;
if(!isset($data0['Email'])){$data0['Email'] = array();}
		$data1_obj = @$simplexml->Result->Email;
		$data0['Email'] = @(string)$data1_obj;
	$data0['email'] = @$data0['Email'];
if(!isset($data0['Login'])){$data0['Login'] = array();}
		$data1_obj = @$simplexml->Result->Login;
		$data0['Login'] = @(string)$data1_obj;
	$data0['login'] = @$data0['Login'];
if(!isset($data0['Password'])){$data0['Password'] = array();}
		$data1_obj = @$simplexml->Result->Password;
		$data0['Password'] = @(string)$data1_obj;
	$data0['password'] = @$data0['Password'];
	return $data0;
    }
    public function ChangeEmail($sessionId, $currentPassword, $newEmail){
        $params = array(
            'sessionId' => $sessionId,
	    'currentPassword' => $currentPassword,
	    'newEmail' => $newEmail
        );
        $params += $this->defaultLogin();
        $simplexml = $this->_getData('ChangeEmail', $params);
        if (!$simplexml) return false;
        
        $data0 = array();
        
if(!isset($data0)){$data0 = array();}
	$data0_obj = @$simplexml->EmailConfirmationInfo;
if(!isset($data0['IsEmailVerificationUsed'])){$data0['IsEmailVerificationUsed'] = array();}
		$data1_obj = @$simplexml->EmailConfirmationInfo->IsEmailVerificationUsed;
		$data0['IsEmailVerificationUsed'] = @$data1_obj;
	$data0['isemailverificationused'] = @$data0['IsEmailVerificationUsed'];
if(!isset($data0['EmailConfirmationCode'])){$data0['EmailConfirmationCode'] = array();}
		$data1_obj = @$simplexml->EmailConfirmationInfo->EmailConfirmationCode;
		$data0['EmailConfirmationCode'] = @(string)$data1_obj;
	$data0['emailconfirmationcode'] = @$data0['EmailConfirmationCode'];
	return $data0;
    }
    public function GetUserInfo($sessionId){
        $params = array(
            'sessionId' => $sessionId
        );
        $params += $this->defaultLogin();
        $simplexml = $this->_getData('GetUserInfo', $params);
        if (!$simplexml) return false;
        
        $data0 = array();
        
if(!isset($data0)){$data0 = array();}
	$data0_obj = @$simplexml->UserInfo;
if(!isset($data0['IsEmailVerified'])){$data0['IsEmailVerified'] = array();}
		$data1_obj = @$simplexml->UserInfo->IsEmailVerified;
		$data0['IsEmailVerified'] = @$data1_obj;
	$data0['isemailverified'] = @$data0['IsEmailVerified'];
if(!isset($data0['Id'])){$data0['Id'] = array();}
		$data1_obj = @$simplexml->UserInfo->Id;
		$data0['Id'] = @$data1_obj;
	$data0['id'] = @$data0['Id'];
if(!isset($data0['IsActive'])){$data0['IsActive'] = array();}
		$data1_obj = @$simplexml->UserInfo->IsActive;
		$data0['IsActive'] = @$data1_obj;
	$data0['isactive'] = @$data0['IsActive'];
if(!isset($data0['Login'])){$data0['Login'] = array();}
		$data1_obj = @$simplexml->UserInfo->Login;
		$data0['Login'] = @(string)$data1_obj;
	$data0['login'] = @$data0['Login'];
if(!isset($data0['FirstName'])){$data0['FirstName'] = array();}
		$data1_obj = @$simplexml->UserInfo->FirstName;
		$data0['FirstName'] = @(string)$data1_obj;
	$data0['firstname'] = @$data0['FirstName'];
if(!isset($data0['LastName'])){$data0['LastName'] = array();}
		$data1_obj = @$simplexml->UserInfo->LastName;
		$data0['LastName'] = @(string)$data1_obj;
	$data0['lastname'] = @$data0['LastName'];
if(!isset($data0['MiddleName'])){$data0['MiddleName'] = array();}
		$data1_obj = @$simplexml->UserInfo->MiddleName;
		$data0['MiddleName'] = @(string)$data1_obj;
	$data0['middlename'] = @$data0['MiddleName'];
if(!isset($data0['Sex'])){$data0['Sex'] = array();}
		$data1_obj = @$simplexml->UserInfo->Sex;
		$data0['Sex'] = @$data1_obj;
	$data0['sex'] = @$data0['Sex'];
if(!isset($data0['Email'])){$data0['Email'] = array();}
		$data1_obj = @$simplexml->UserInfo->Email;
		$data0['Email'] = @(string)$data1_obj;
	$data0['email'] = @$data0['Email'];
if(!isset($data0['CountryCode'])){$data0['CountryCode'] = array();}
		$data1_obj = @$simplexml->UserInfo->CountryCode;
		$data0['CountryCode'] = @(string)$data1_obj;
	$data0['countrycode'] = @$data0['CountryCode'];
if(!isset($data0['Country'])){$data0['Country'] = array();}
		$data1_obj = @$simplexml->UserInfo->Country;
		$data0['Country'] = @(string)$data1_obj;
	$data0['country'] = @$data0['Country'];
if(!isset($data0['City'])){$data0['City'] = array();}
		$data1_obj = @$simplexml->UserInfo->City;
		$data0['City'] = @(string)$data1_obj;
	$data0['city'] = @$data0['City'];
if(!isset($data0['Address'])){$data0['Address'] = array();}
		$data1_obj = @$simplexml->UserInfo->Address;
		$data0['Address'] = @(string)$data1_obj;
	$data0['address'] = @$data0['Address'];
if(!isset($data0['Phone'])){$data0['Phone'] = array();}
		$data1_obj = @$simplexml->UserInfo->Phone;
		$data0['Phone'] = @(string)$data1_obj;
	$data0['phone'] = @$data0['Phone'];
if(!isset($data0['PostalCode'])){$data0['PostalCode'] = array();}
		$data1_obj = @$simplexml->UserInfo->PostalCode;
		$data0['PostalCode'] = @(string)$data1_obj;
	$data0['postalcode'] = @$data0['PostalCode'];
if(!isset($data0['Region'])){$data0['Region'] = array();}
		$data1_obj = @$simplexml->UserInfo->Region;
		$data0['Region'] = @(string)$data1_obj;
	$data0['region'] = @$data0['Region'];
if(!isset($data0['RecipientLastName'])){$data0['RecipientLastName'] = array();}
		$data1_obj = @$simplexml->UserInfo->RecipientLastName;
		$data0['RecipientLastName'] = @(string)$data1_obj;
	$data0['recipientlastname'] = @$data0['RecipientLastName'];
if(!isset($data0['RecipientFirstName'])){$data0['RecipientFirstName'] = array();}
		$data1_obj = @$simplexml->UserInfo->RecipientFirstName;
		$data0['RecipientFirstName'] = @(string)$data1_obj;
	$data0['recipientfirstname'] = @$data0['RecipientFirstName'];
if(!isset($data0['RecipientMiddleName'])){$data0['RecipientMiddleName'] = array();}
		$data1_obj = @$simplexml->UserInfo->RecipientMiddleName;
		$data0['RecipientMiddleName'] = @(string)$data1_obj;
	$data0['recipientmiddlename'] = @$data0['RecipientMiddleName'];
if(!isset($data0['AdditionalInfo'])){$data0['AdditionalInfo'] = array();}
		$data1_obj = @$simplexml->UserInfo->AdditionalInfo;
		$data0['AdditionalInfo'] = @(string)$data1_obj;
	$data0['additionalinfo'] = @$data0['AdditionalInfo'];
if(!isset($data0['RegistrationDate'])){$data0['RegistrationDate'] = array();}
		$data1_obj = @$simplexml->UserInfo->RegistrationDate;
		$data0['RegistrationDate'] = @$data1_obj;
	$data0['registrationdate'] = @$data0['RegistrationDate'];
if(!isset($data0['PurchaseVolume'])){$data0['PurchaseVolume'] = array();}
		$data1_obj = @$simplexml->UserInfo->PurchaseVolume;
		$data0['PurchaseVolume'] = @$data1_obj;
	$data0['purchasevolume'] = @$data0['PurchaseVolume'];
	return $data0;
    }
    public function GetUserStatusInfo($sessionId){
        $params = array(
            'sessionId' => $sessionId
        );
        $params += $this->defaultLogin();
        $simplexml = $this->_getData('GetUserStatusInfo', $params);
        if (!$simplexml) return false;
        
        $data0 = array();
        
if(!isset($data0)){$data0 = array();}
	$data0_obj = @$simplexml->UserStatusInfo->Login;
	$data0 = @$data0_obj;
	return $data0;
    }
    public function UpdateUser($sessionId, $userParameters){
        $params = array(
            'sessionId' => $sessionId,
	    'userParameters' => $userParameters
        );
        $params += $this->defaultLogin();
        $simplexml = $this->_getData('UpdateUser', $params);
        if (!$simplexml) return false;
        
        $data0 = array();
        
if(!isset($data0)){$data0 = array();}
	$data0_obj = @$simplexml;
	$data0 = @$data0_obj;
	return $data0;
    }
    public function ConfirmEmail($confirmationCode){
        $params = array(
            'confirmationCode' => $confirmationCode
        );
        $params += $this->defaultLogin();
        $simplexml = $this->_getData('ConfirmEmail', $params);
        if (!$simplexml) return false;
        
        $data0 = array();
        
if(!isset($data0)){$data0 = array();}
	$data0_obj = @$simplexml;
	$data0 = @$data0_obj;
	return $data0;
    }
    public function DeleteAccount($sessionId, $currentPassword){
        $params = array(
            'sessionId' => $sessionId,
	    'currentPassword' => $currentPassword
        );
        $params += $this->defaultLogin();
        $simplexml = $this->_getData('DeleteAccount', $params);
        if (!$simplexml) return false;
        
        $data0 = array();
        
if(!isset($data0)){$data0 = array();}
	$data0_obj = @$simplexml;
	$data0 = @$data0_obj;
	return $data0;
    }
    public function AuthenticateAsUser($sessionId, $userLogin){
        $params = array(
            'sessionId' => $sessionId,
	    'userLogin' => $userLogin
        );
        $params += $this->defaultLogin();
        $simplexml = $this->_getData('AuthenticateAsUser', $params);
        if (!$simplexml) return false;
        
        $data0 = array();
        
if(!isset($data0)){$data0 = array();}
	$data0_obj = @$simplexml->SessionId;
	$data0 = @(string)$data0_obj;
	return $data0;
    }
    public function FindBaseUserInfoListFrame($sessionId, $userFilter, $framePosition = 0, $frameSize = 18){
        $params = array(
            'sessionId' => $sessionId,
	    'userFilter' => $userFilter,
	    'framePosition' => $framePosition,
	    'frameSize' => $frameSize
        );
        $params += $this->defaultLogin();
        $simplexml = $this->_getData('FindBaseUserInfoListFrame', $params);
        if (!$simplexml) return false;
        
        $data0 = array();
        
if(!isset($data0)){$data0 = array();}
	$data0_obj = @$simplexml->Result;
if(!isset($data0['Content'])){$data0['Content'] = array();}

	if(!isset($simplexml->Result->Content) || is_null($simplexml->Result->Content) || !$simplexml->Result->Content)		$data1_obj = @array();

	else
		$data1_obj = @$simplexml->Result->Content->children();
		$data0['Content'] = @array();
		foreach($data1_obj as $value1){
			$data1_tmp = @array();
			$data1_tmp['Id'] = @$value1->Id;
			$data1_tmp['id'] = @$value1->Id;
			$data1_tmp['Login'] = @(string)$value1->Login;
			$data1_tmp['login'] = @(string)$value1->Login;
			$data1_tmp['Email'] = @(string)$value1->Email;
			$data1_tmp['email'] = @(string)$value1->Email;
			$data1_tmp['IsActive'] = @$value1->IsActive;
			$data1_tmp['isactive'] = @$value1->IsActive;
			$data1_tmp['FirstName'] = @(string)$value1->FirstName;
			$data1_tmp['firstname'] = @(string)$value1->FirstName;
			$data1_tmp['LastName'] = @(string)$value1->LastName;
			$data1_tmp['lastname'] = @(string)$value1->LastName;
			$data1_tmp['MiddleName'] = @(string)$value1->MiddleName;
			$data1_tmp['middlename'] = @(string)$value1->MiddleName;
			$data1_tmp['PersonalAccountId'] = @(string)$value1->PersonalAccountId;
			$data1_tmp['personalaccountid'] = @(string)$value1->PersonalAccountId;
			$data0['Content'][] = @$data1_tmp;
		}
	$data0['content'] = @$data0['Content'];
if(!isset($data0['TotalCount'])){$data0['TotalCount'] = array();}
		$data1_obj = @$simplexml->Result->TotalCount;
		$data0['TotalCount'] = @$data1_obj;
	$data0['totalcount'] = @$data0['TotalCount'];
	return $data0;
    }
    public function GetUserInfoForOperator($sessionId, $userId){
        $params = array(
            'sessionId' => $sessionId,
	    'userId' => $userId
        );
        $params += $this->defaultLogin();
        $simplexml = $this->_getData('GetUserInfoForOperator', $params);
        if (!$simplexml) return false;
        
        $data0 = array();
        
if(!isset($data0)){$data0 = array();}
	$data0_obj = @$simplexml->UserInfo;
if(!isset($data0['IsEmailVerified'])){$data0['IsEmailVerified'] = array();}
		$data1_obj = @$simplexml->UserInfo->IsEmailVerified;
		$data0['IsEmailVerified'] = @$data1_obj;
	$data0['isemailverified'] = @$data0['IsEmailVerified'];
if(!isset($data0['Id'])){$data0['Id'] = array();}
		$data1_obj = @$simplexml->UserInfo->Id;
		$data0['Id'] = @$data1_obj;
	$data0['id'] = @$data0['Id'];
if(!isset($data0['IsActive'])){$data0['IsActive'] = array();}
		$data1_obj = @$simplexml->UserInfo->IsActive;
		$data0['IsActive'] = @$data1_obj;
	$data0['isactive'] = @$data0['IsActive'];
if(!isset($data0['Login'])){$data0['Login'] = array();}
		$data1_obj = @$simplexml->UserInfo->Login;
		$data0['Login'] = @(string)$data1_obj;
	$data0['login'] = @$data0['Login'];
if(!isset($data0['FirstName'])){$data0['FirstName'] = array();}
		$data1_obj = @$simplexml->UserInfo->FirstName;
		$data0['FirstName'] = @(string)$data1_obj;
	$data0['firstname'] = @$data0['FirstName'];
if(!isset($data0['LastName'])){$data0['LastName'] = array();}
		$data1_obj = @$simplexml->UserInfo->LastName;
		$data0['LastName'] = @(string)$data1_obj;
	$data0['lastname'] = @$data0['LastName'];
if(!isset($data0['MiddleName'])){$data0['MiddleName'] = array();}
		$data1_obj = @$simplexml->UserInfo->MiddleName;
		$data0['MiddleName'] = @(string)$data1_obj;
	$data0['middlename'] = @$data0['MiddleName'];
if(!isset($data0['Sex'])){$data0['Sex'] = array();}
		$data1_obj = @$simplexml->UserInfo->Sex;
		$data0['Sex'] = @$data1_obj;
	$data0['sex'] = @$data0['Sex'];
if(!isset($data0['Email'])){$data0['Email'] = array();}
		$data1_obj = @$simplexml->UserInfo->Email;
		$data0['Email'] = @(string)$data1_obj;
	$data0['email'] = @$data0['Email'];
if(!isset($data0['CountryCode'])){$data0['CountryCode'] = array();}
		$data1_obj = @$simplexml->UserInfo->CountryCode;
		$data0['CountryCode'] = @(string)$data1_obj;
	$data0['countrycode'] = @$data0['CountryCode'];
if(!isset($data0['Country'])){$data0['Country'] = array();}
		$data1_obj = @$simplexml->UserInfo->Country;
		$data0['Country'] = @(string)$data1_obj;
	$data0['country'] = @$data0['Country'];
if(!isset($data0['City'])){$data0['City'] = array();}
		$data1_obj = @$simplexml->UserInfo->City;
		$data0['City'] = @(string)$data1_obj;
	$data0['city'] = @$data0['City'];
if(!isset($data0['Address'])){$data0['Address'] = array();}
		$data1_obj = @$simplexml->UserInfo->Address;
		$data0['Address'] = @(string)$data1_obj;
	$data0['address'] = @$data0['Address'];
if(!isset($data0['Phone'])){$data0['Phone'] = array();}
		$data1_obj = @$simplexml->UserInfo->Phone;
		$data0['Phone'] = @(string)$data1_obj;
	$data0['phone'] = @$data0['Phone'];
if(!isset($data0['PostalCode'])){$data0['PostalCode'] = array();}
		$data1_obj = @$simplexml->UserInfo->PostalCode;
		$data0['PostalCode'] = @(string)$data1_obj;
	$data0['postalcode'] = @$data0['PostalCode'];
if(!isset($data0['Region'])){$data0['Region'] = array();}
		$data1_obj = @$simplexml->UserInfo->Region;
		$data0['Region'] = @(string)$data1_obj;
	$data0['region'] = @$data0['Region'];
if(!isset($data0['RecipientLastName'])){$data0['RecipientLastName'] = array();}
		$data1_obj = @$simplexml->UserInfo->RecipientLastName;
		$data0['RecipientLastName'] = @(string)$data1_obj;
	$data0['recipientlastname'] = @$data0['RecipientLastName'];
if(!isset($data0['RecipientFirstName'])){$data0['RecipientFirstName'] = array();}
		$data1_obj = @$simplexml->UserInfo->RecipientFirstName;
		$data0['RecipientFirstName'] = @(string)$data1_obj;
	$data0['recipientfirstname'] = @$data0['RecipientFirstName'];
if(!isset($data0['RecipientMiddleName'])){$data0['RecipientMiddleName'] = array();}
		$data1_obj = @$simplexml->UserInfo->RecipientMiddleName;
		$data0['RecipientMiddleName'] = @(string)$data1_obj;
	$data0['recipientmiddlename'] = @$data0['RecipientMiddleName'];
if(!isset($data0['AdditionalInfo'])){$data0['AdditionalInfo'] = array();}
		$data1_obj = @$simplexml->UserInfo->AdditionalInfo;
		$data0['AdditionalInfo'] = @(string)$data1_obj;
	$data0['additionalinfo'] = @$data0['AdditionalInfo'];
if(!isset($data0['RegistrationDate'])){$data0['RegistrationDate'] = array();}
		$data1_obj = @$simplexml->UserInfo->RegistrationDate;
		$data0['RegistrationDate'] = @$data1_obj;
	$data0['registrationdate'] = @$data0['RegistrationDate'];
if(!isset($data0['PurchaseVolume'])){$data0['PurchaseVolume'] = array();}
		$data1_obj = @$simplexml->UserInfo->PurchaseVolume;
		$data0['PurchaseVolume'] = @$data1_obj;
	$data0['purchasevolume'] = @$data0['PurchaseVolume'];
	return $data0;
    }
    public function AddUser($sessionId, $userParameters){
        $params = array(
            'sessionId' => $sessionId,
	    'userParameters' => $userParameters
        );
        $params += $this->defaultLogin();
        $simplexml = $this->_getData('AddUser', $params);
        if (!$simplexml) return false;
        
        $data0 = array();
        
if(!isset($data0)){$data0 = array();}
	$data0_obj = @$simplexml->Result;
	$data0 = @$data0_obj;
	return $data0;
    }
    public function EditUser($sessionId, $userParameters){
        $params = array(
            'sessionId' => $sessionId,
	    'userParameters' => $userParameters
        );
        $params += $this->defaultLogin();
        $simplexml = $this->_getData('EditUser', $params);
        if (!$simplexml) return false;
        
        $data0 = array();
        
if(!isset($data0)){$data0 = array();}
	$data0_obj = @$simplexml;
	$data0 = @$data0_obj;
	return $data0;
    }
    public function DeleteUser($sessionId, $userId){
        $params = array(
            'sessionId' => $sessionId,
	    'userId' => $userId
        );
        $params += $this->defaultLogin();
        $simplexml = $this->_getData('DeleteUser', $params);
        if (!$simplexml) return false;
        
        $data0 = array();
        
if(!isset($data0)){$data0 = array();}
	$data0_obj = @$simplexml;
	$data0 = @$data0_obj;
	return $data0;
    }
    public function SetUserBan($sessionId, $userId, $isBanned){
        $params = array(
            'sessionId' => $sessionId,
	    'userId' => $userId,
	    'isBanned' => $isBanned
        );
        $params += $this->defaultLogin();
        $simplexml = $this->_getData('SetUserBan', $params);
        if (!$simplexml) return false;
        
        $data0 = array();
        
if(!isset($data0)){$data0 = array();}
	$data0_obj = @$simplexml;
	$data0 = @$data0_obj;
	return $data0;
    }
    public function SearchUsersWithSummary($sessionId, $userFilter, $framePosition = 0, $frameSize = 18){
        $params = array(
            'sessionId' => $sessionId,
	    'userFilter' => $userFilter,
	    'framePosition' => $framePosition,
	    'frameSize' => $frameSize
        );
        $params += $this->defaultLogin();
        $simplexml = $this->_getData('SearchUsersWithSummary', $params);
        if (!$simplexml) return false;
        
        $data0 = array();
        
if(!isset($data0)){$data0 = array();}
	$data0_obj = @$simplexml->Result;
if(!isset($data0['Content'])){$data0['Content'] = array();}

	if(!isset($simplexml->Result->Content) || is_null($simplexml->Result->Content) || !$simplexml->Result->Content)		$data1_obj = @array();

	else
		$data1_obj = @$simplexml->Result->Content->children();
		$data0['Content'] = @array();
		foreach($data1_obj as $value1){
			$data1_tmp = @array();
			$data1_tmp['Id'] = @$value1->Id;
			$data1_tmp['id'] = @$value1->Id;
			$data1_tmp['Login'] = @(string)$value1->Login;
			$data1_tmp['login'] = @(string)$value1->Login;
			$data1_tmp['Email'] = @(string)$value1->Email;
			$data1_tmp['email'] = @(string)$value1->Email;
			$data1_tmp['IsActive'] = @$value1->IsActive;
			$data1_tmp['isactive'] = @$value1->IsActive;
			$data1_tmp['FirstName'] = @(string)$value1->FirstName;
			$data1_tmp['firstname'] = @(string)$value1->FirstName;
			$data1_tmp['LastName'] = @(string)$value1->LastName;
			$data1_tmp['lastname'] = @(string)$value1->LastName;
			$data1_tmp['MiddleName'] = @(string)$value1->MiddleName;
			$data1_tmp['middlename'] = @(string)$value1->MiddleName;
			$data1_tmp['PersonalAccountId'] = @(string)$value1->PersonalAccountId;
			$data1_tmp['personalaccountid'] = @(string)$value1->PersonalAccountId;
			$data0['Content'][] = @$data1_tmp;
		}
	$data0['content'] = @$data0['Content'];
if(!isset($data0['TotalCount'])){$data0['TotalCount'] = array();}
		$data1_obj = @$simplexml->Result->TotalCount;
		$data0['TotalCount'] = @$data1_obj;
	$data0['totalcount'] = @$data0['TotalCount'];
if(!isset($data0['TotalReceived'])){$data0['TotalReceived'] = array();}
		$data1_obj = @$simplexml->Result->TotalReceived;
		$data0['TotalReceived'] = @$data1_obj;
	$data0['totalreceived'] = @$data0['TotalReceived'];
if(!isset($data0['TotalReserved'])){$data0['TotalReserved'] = array();}
		$data1_obj = @$simplexml->Result->TotalReserved;
		$data0['TotalReserved'] = @$data1_obj;
	$data0['totalreserved'] = @$data0['TotalReserved'];
if(!isset($data0['TotalAvailable'])){$data0['TotalAvailable'] = array();}
		$data1_obj = @$simplexml->Result->TotalAvailable;
		$data0['TotalAvailable'] = @$data1_obj;
	$data0['totalavailable'] = @$data0['TotalAvailable'];
if(!isset($data0['TotalWaitingForPayment'])){$data0['TotalWaitingForPayment'] = array();}
		$data1_obj = @$simplexml->Result->TotalWaitingForPayment;
		$data0['TotalWaitingForPayment'] = @$data1_obj;
	$data0['totalwaitingforpayment'] = @$data0['TotalWaitingForPayment'];
	return $data0;
    }
    public function AuthenticateInstanceOperator($userLogin, $userPassword){
        $params = array(
            'userLogin' => $userLogin,
	    'userPassword' => $userPassword
        );
        $params += $this->defaultLogin();
        $simplexml = $this->_getData('AuthenticateInstanceOperator', $params);
        if (!$simplexml) return false;
        
        $data0 = array();
        
        $data = array();
        $data['SessionId'] = (string)$simplexml->SessionId->Value;

        return $data;

    }
    public function EditOperatorInfo($sessionId, $xmlOperatorInfo){
        $params = array(
            'sessionId' => $sessionId,
	    'xmlOperatorInfo' => $xmlOperatorInfo
        );
        $params += $this->defaultLogin();
        $simplexml = $this->_getData('EditOperatorInfo', $params);
        if (!$simplexml) return false;
        
        $data0 = array();
        
if(!isset($data0)){$data0 = array();}
	$data0_obj = @$simplexml;
	$data0 = @$data0_obj;
	return $data0;
    }
    public function ChangeOperatorPassword($sessionId, $currentPassword, $newPassword){
        $params = array(
            'sessionId' => $sessionId,
	    'currentPassword' => $currentPassword,
	    'newPassword' => $newPassword
        );
        $params += $this->defaultLogin();
        $simplexml = $this->_getData('ChangeOperatorPassword', $params);
        if (!$simplexml) return false;
        
        $data0 = array();
        
if(!isset($data0)){$data0 = array();}
	$data0_obj = @$simplexml;
	$data0 = @$data0_obj;
	return $data0;
    }
    public function GetOperatorInfo($sessionId){
        $params = array(
            'sessionId' => $sessionId
        );
        $params += $this->defaultLogin();
        $simplexml = $this->_getData('GetOperatorInfo', $params);
        if (!$simplexml) return false;
        
        $data0 = array();
        
if(!isset($data0)){$data0 = array();}
	$data0_obj = @$simplexml->Result;
if(!isset($data0['OperatorId'])){$data0['OperatorId'] = array();}
		$data1_obj = @$simplexml->Result->OperatorId;
		$data0['OperatorId'] = @(string)$data1_obj;
	$data0['operatorid'] = @$data0['OperatorId'];
if(!isset($data0['FirstName'])){$data0['FirstName'] = array();}
		$data1_obj = @$simplexml->Result->FirstName;
		$data0['FirstName'] = @(string)$data1_obj;
	$data0['firstname'] = @$data0['FirstName'];
if(!isset($data0['MiddleName'])){$data0['MiddleName'] = array();}
		$data1_obj = @$simplexml->Result->MiddleName;
		$data0['MiddleName'] = @(string)$data1_obj;
	$data0['middlename'] = @$data0['MiddleName'];
if(!isset($data0['LastName'])){$data0['LastName'] = array();}
		$data1_obj = @$simplexml->Result->LastName;
		$data0['LastName'] = @(string)$data1_obj;
	$data0['lastname'] = @$data0['LastName'];
if(!isset($data0['IsSalesOperator'])){$data0['IsSalesOperator'] = array();}
		$data1_obj = @$simplexml->Result->IsSalesOperator;
		$data0['IsSalesOperator'] = @$data1_obj;
	$data0['issalesoperator'] = @$data0['IsSalesOperator'];
	return $data0;
    }
    public function SetSalesOperator($sessionId, $salesId, $salesOperatorId){
        $params = array(
            'sessionId' => $sessionId,
	    'salesId' => $salesId,
	    'salesOperatorId' => $salesOperatorId
        );
        $params += $this->defaultLogin();
        $simplexml = $this->_getData('SetSalesOperator', $params);
        if (!$simplexml) return false;
        
        $data0 = array();
        
if(!isset($data0)){$data0 = array();}
	$data0_obj = @$simplexml;
	$data0 = @$data0_obj;
	return $data0;
    }
    public function GetSalesOperatorInfoList($sessionId){
        $params = array(
            'sessionId' => $sessionId
        );
        $params += $this->defaultLogin();
        $simplexml = $this->_getData('GetSalesOperatorInfoList', $params);
        if (!$simplexml) return false;
        
        $data0 = array();
        
if(!isset($data0)){$data0 = array();}

	if(!isset($simplexml->Result->Content) || is_null($simplexml->Result->Content) || !$simplexml->Result->Content)	$data0_obj = @array();

	else
	$data0_obj = @$simplexml->Result->Content->children();
	$data0 = @array();
	foreach($data0_obj as $value0){
		$data0_tmp = @array();
		$data0_tmp['OperatorId'] = @(string)$value0->OperatorId;
		$data0_tmp['operatorid'] = @(string)$value0->OperatorId;
		$data0_tmp['FirstName'] = @(string)$value0->FirstName;
		$data0_tmp['firstname'] = @(string)$value0->FirstName;
		$data0_tmp['MiddleName'] = @(string)$value0->MiddleName;
		$data0_tmp['middlename'] = @(string)$value0->MiddleName;
		$data0_tmp['LastName'] = @(string)$value0->LastName;
		$data0_tmp['lastname'] = @(string)$value0->LastName;
		$data0_tmp['IsSalesOperator'] = @$value0->IsSalesOperator;
		$data0_tmp['issalesoperator'] = @$value0->IsSalesOperator;
		$data0[] = @$data0_tmp;
	}
	return $data0;
    }
    public function GetInstanceUserRoleList($sessionId){
        $params = array(
            'sessionId' => $sessionId
        );
        $params += $this->defaultLogin();
        $simplexml = $this->_getData('GetInstanceUserRoleList', $params);
        if (!$simplexml) return false;
        
        $data0 = array();
        
if(!isset($data0)){$data0 = array();}

	if(!isset($simplexml->Result->Content) || is_null($simplexml->Result->Content) || !$simplexml->Result->Content)	$data0_obj = @array();

	else
	$data0_obj = @$simplexml->Result->Content->children();
	$data0 = @array();
	foreach($data0_obj as $value0){
		$data0_tmp = @array();
		$data0_tmp['Name'] = @(string)$value0->Name;
		$data0_tmp['name'] = @(string)$value0->Name;
		$data0_tmp['Description'] = @(string)$value0->Description;
		$data0_tmp['description'] = @(string)$value0->Description;
		$data0[] = @$data0_tmp;
	}
	return $data0;
    }
    public function GetAvailableRoleList($sessionId){
        $params = array(
            'sessionId' => $sessionId
        );
        $params += $this->defaultLogin();
        $simplexml = $this->_getData('GetAvailableRoleList', $params);
        if (!$simplexml) return false;
        
        $data0 = array();
        
if(!isset($data0)){$data0 = array();}

	if(!isset($simplexml->Result->Content) || is_null($simplexml->Result->Content) || !$simplexml->Result->Content)	$data0_obj = @array();

	else
	$data0_obj = @$simplexml->Result->Content->children();
	$data0 = @array();
	foreach($data0_obj as $value0){
		$data0_tmp = @array();
		$data0_tmp['Name'] = @(string)$value0->Name;
		$data0_tmp['name'] = @(string)$value0->Name;
		$data0_tmp['Description'] = @(string)$value0->Description;
		$data0_tmp['description'] = @(string)$value0->Description;
		$data0[] = @$data0_tmp;
	}
	return $data0;
    }
    public function AddInstanceUserToRole($sessionId, $roleName, $userLogin){
        $params = array(
            'sessionId' => $sessionId,
	    'roleName' => $roleName,
	    'userLogin' => $userLogin
        );
        $params += $this->defaultLogin();
        $simplexml = $this->_getData('AddInstanceUserToRole', $params);
        if (!$simplexml) return false;
        
        $data0 = array();
        
if(!isset($data0)){$data0 = array();}
	$data0_obj = @$simplexml;
	$data0 = @$data0_obj;
	return $data0;
    }
    public function GetInstanceUserRoleListByLogin($sessionId, $userLogin){
        $params = array(
            'sessionId' => $sessionId,
	    'userLogin' => $userLogin
        );
        $params += $this->defaultLogin();
        $simplexml = $this->_getData('GetInstanceUserRoleListByLogin', $params);
        if (!$simplexml) return false;
        
        $data0 = array();
        
if(!isset($data0)){$data0 = array();}

	if(!isset($simplexml->Result->Content) || is_null($simplexml->Result->Content) || !$simplexml->Result->Content)	$data0_obj = @array();

	else
	$data0_obj = @$simplexml->Result->Content->children();
	$data0 = @array();
	foreach($data0_obj as $value0){
		$data0_tmp = @array();
		$data0_tmp['Name'] = @(string)$value0->Name;
		$data0_tmp['name'] = @(string)$value0->Name;
		$data0_tmp['Description'] = @(string)$value0->Description;
		$data0_tmp['description'] = @(string)$value0->Description;
		$data0[] = @$data0_tmp;
	}
	return $data0;
    }
    public function RemoveInstanceUserFromRole($sessionId, $roleName, $userLogin){
        $params = array(
            'sessionId' => $sessionId,
	    'roleName' => $roleName,
	    'userLogin' => $userLogin
        );
        $params += $this->defaultLogin();
        $simplexml = $this->_getData('RemoveInstanceUserFromRole', $params);
        if (!$simplexml) return false;
        
        $data0 = array();
        
if(!isset($data0)){$data0 = array();}
	$data0_obj = @$simplexml;
	$data0 = @$data0_obj;
	return $data0;
    }
    public function CreateInstanceUser($sessionId, $xmlCreateData){
        $params = array(
            'sessionId' => $sessionId,
	    'xmlCreateData' => $xmlCreateData
        );
        $params += $this->defaultLogin();
        $simplexml = $this->_getData('CreateInstanceUser', $params);
        if (!$simplexml) return false;
        
        $data0 = array();
        
if(!isset($data0)){$data0 = array();}
	$data0_obj = @$simplexml->Result;
	$data0 = @(string)$data0_obj;
	return $data0;
    }
    public function UpdateInstanceUser($sessionId, $xmlUpdateData){
        $params = array(
            'sessionId' => $sessionId,
	    'xmlUpdateData' => $xmlUpdateData
        );
        $params += $this->defaultLogin();
        $simplexml = $this->_getData('UpdateInstanceUser', $params);
        if (!$simplexml) return false;
        
        $data0 = array();
        
if(!isset($data0)){$data0 = array();}
	$data0_obj = @$simplexml;
	$data0 = @$data0_obj;
	return $data0;
    }
    public function DeleteInstanceUser($sessionId, $userLogin){
        $params = array(
            'sessionId' => $sessionId,
	    'userLogin' => $userLogin
        );
        $params += $this->defaultLogin();
        $simplexml = $this->_getData('DeleteInstanceUser', $params);
        if (!$simplexml) return false;
        
        $data0 = array();
        
if(!isset($data0)){$data0 = array();}
	$data0_obj = @$simplexml;
	$data0 = @$data0_obj;
	return $data0;
    }
    public function GetInstanceUserList($sessionId){
        $params = array(
            'sessionId' => $sessionId
        );
        $params += $this->defaultLogin();
        $simplexml = $this->_getData('GetInstanceUserList', $params);
        if (!$simplexml) return false;
        
        $data0 = array();
        
if(!isset($data0)){$data0 = array();}

	if(!isset($simplexml->Result->Content) || is_null($simplexml->Result->Content) || !$simplexml->Result->Content)	$data0_obj = @array();

	else
	$data0_obj = @$simplexml->Result->Content->children();
	$data0 = @array();
	foreach($data0_obj as $value0){
		$data0_tmp = @array();
		$data0_tmp['Id'] = @(int)$value0->Id;
		$data0_tmp['id'] = @(int)$value0->Id;
		$data0_tmp['Login'] = @(string)$value0->Login;
		$data0_tmp['login'] = @(string)$value0->Login;
		$data0_tmp['Password'] = @(string)$value0->Password;
		$data0_tmp['password'] = @(string)$value0->Password;
		$data0_tmp['Name'] = @(string)$value0->Name;
		$data0_tmp['name'] = @(string)$value0->Name;
		$data0_tmp['Email'] = @(string)$value0->Email;
		$data0_tmp['email'] = @(string)$value0->Email;
if(!isset($data0_tmp['Roles'])){$data0_tmp['Roles'] = array();}

	if(!isset($value0->Roles) || is_null($value0->Roles) || !$value0->Roles)		$data1_obj = @array();

	else
		$data1_obj = @$value0->Roles->children();
		$data0_tmp['Roles'] = @array();
		foreach($data1_obj as $value1){
			$data1_tmp = @array();
			$data1_tmp['Name'] = @(string)$value1->Name;
			$data1_tmp['name'] = @(string)$value1->Name;
			$data1_tmp['Description'] = @(string)$value1->Description;
			$data1_tmp['description'] = @(string)$value1->Description;
			$data0_tmp['Roles'][] = @$data1_tmp;
		}
		$data0[] = @$data0_tmp;
	}
	return $data0;
    }
    public function GetWebUISettings($sessionId){
        $params = array(
            'sessionId' => $sessionId
        );
        $params += $this->defaultLogin();
        $simplexml = $this->_getData('GetWebUISettings', $params);
        if (!$simplexml) return false;
        
        $data0 = array();
        
        return $simplexml;

    }
    public function GetShowcase($sessionId){
        $params = array(
            'sessionId' => $sessionId
        );
        $params += $this->defaultLogin();
        $simplexml = $this->_getData('GetShowcase', $params);
        if (!$simplexml) return false;
        
        $data0 = array();
        
        return $simplexml;

    }
    public function SetWebUISettings($sessionId, $settings){
        $params = array(
            'sessionId' => $sessionId,
	    'settings' => $settings
        );
        $params += $this->defaultLogin();
        $simplexml = $this->_getData('SetWebUISettings', $params);
        if (!$simplexml) return false;
        
        $data0 = array();
        
if(!isset($data0)){$data0 = array();}
	$data0_obj = @$simplexml;
	$data0 = @$data0_obj;
	return $data0;
    }
    public function SetShowcaseSettings($sessionId, $settings){
        $params = array(
            'sessionId' => $sessionId,
	    'settings' => $settings
        );
        $params += $this->defaultLogin();
        $simplexml = $this->_getData('SetShowcaseSettings', $params);
        if (!$simplexml) return false;
        
        $data0 = array();
        
if(!isset($data0)){$data0 = array();}
	$data0_obj = @$simplexml;
	$data0 = @$data0_obj;
	return $data0;
    }
    public function GetShowcaseCurrencyRates(){
        $params = array(
            
        );
        $params += $this->defaultLogin();
        $simplexml = $this->_getData('GetShowcaseCurrencyRates', $params);
        if (!$simplexml) return false;
        
        $data0 = array();
        
if(!isset($data0)){$data0 = array();}
	$data0_obj = @$simplexml->CurrencyRates;
if(!isset($data0['Ruble'])){$data0['Ruble'] = array();}
		$data1_obj = @$simplexml->CurrencyRates->Ruble;
if(!isset($data0['Ruble']['Name'])){$data0['Ruble']['Name'] = array();}
			$data2_obj = @$simplexml->CurrencyRates->Ruble->Name;
			$data0['Ruble']['Name'] = @(string)$data2_obj;
		$data0['Ruble']['name'] = @$data0['Ruble']['Name'];
if(!isset($data0['Ruble']['IsUse'])){$data0['Ruble']['IsUse'] = array();}
			$data2_obj = @$simplexml->CurrencyRates->Ruble->IsUse;
			$data0['Ruble']['IsUse'] = @$data2_obj;
		$data0['Ruble']['isuse'] = @$data0['Ruble']['IsUse'];
if(!isset($data0['Ruble']['Rate'])){$data0['Ruble']['Rate'] = array();}
			$data2_obj = @$simplexml->CurrencyRates->Ruble->Rate;
			$data0['Ruble']['Rate'] = @$data2_obj;
		$data0['Ruble']['rate'] = @$data0['Ruble']['Rate'];
	$data0['ruble'] = @$data0['Ruble'];
if(!isset($data0['Dollar'])){$data0['Dollar'] = array();}
		$data1_obj = @$simplexml->CurrencyRates->Dollar;
if(!isset($data0['Dollar']['Name'])){$data0['Dollar']['Name'] = array();}
			$data2_obj = @$simplexml->CurrencyRates->Dollar->Name;
			$data0['Dollar']['Name'] = @(string)$data2_obj;
		$data0['Dollar']['name'] = @$data0['Dollar']['Name'];
if(!isset($data0['Dollar']['IsUse'])){$data0['Dollar']['IsUse'] = array();}
			$data2_obj = @$simplexml->CurrencyRates->Dollar->IsUse;
			$data0['Dollar']['IsUse'] = @$data2_obj;
		$data0['Dollar']['isuse'] = @$data0['Dollar']['IsUse'];
if(!isset($data0['Dollar']['Rate'])){$data0['Dollar']['Rate'] = array();}
			$data2_obj = @$simplexml->CurrencyRates->Dollar->Rate;
			$data0['Dollar']['Rate'] = @$data2_obj;
		$data0['Dollar']['rate'] = @$data0['Dollar']['Rate'];
	$data0['dollar'] = @$data0['Dollar'];
if(!isset($data0['Yuan'])){$data0['Yuan'] = array();}
		$data1_obj = @$simplexml->CurrencyRates->Yuan;
if(!isset($data0['Yuan']['Name'])){$data0['Yuan']['Name'] = array();}
			$data2_obj = @$simplexml->CurrencyRates->Yuan->Name;
			$data0['Yuan']['Name'] = @(string)$data2_obj;
		$data0['Yuan']['name'] = @$data0['Yuan']['Name'];
if(!isset($data0['Yuan']['IsUse'])){$data0['Yuan']['IsUse'] = array();}
			$data2_obj = @$simplexml->CurrencyRates->Yuan->IsUse;
			$data0['Yuan']['IsUse'] = @$data2_obj;
		$data0['Yuan']['isuse'] = @$data0['Yuan']['IsUse'];
if(!isset($data0['Yuan']['Rate'])){$data0['Yuan']['Rate'] = array();}
			$data2_obj = @$simplexml->CurrencyRates->Yuan->Rate;
			$data0['Yuan']['Rate'] = @$data2_obj;
		$data0['Yuan']['rate'] = @$data0['Yuan']['Rate'];
	$data0['yuan'] = @$data0['Yuan'];
	return $data0;
    }
    public function GetInstanceOptionsInfo($sessionId){
        $params = array(
            'sessionId' => $sessionId
        );
        $params += $this->defaultLogin();
        $simplexml = $this->_getData('GetInstanceOptionsInfo', $params);
        if (!$simplexml) return false;
        
        $data0 = array();
        
if(!isset($data0)){$data0 = array();}
	$data0_obj = @$simplexml->Result;
if(!isset($data0['IsEmailConfirmationUsed'])){$data0['IsEmailConfirmationUsed'] = array();}
		$data1_obj = @$simplexml->Result->IsEmailConfirmationUsed;
		$data0['IsEmailConfirmationUsed'] = @$data1_obj;
	$data0['isemailconfirmationused'] = @$data0['IsEmailConfirmationUsed'];
if(!isset($data0['IsIPCheckUsed'])){$data0['IsIPCheckUsed'] = array();}
		$data1_obj = @$simplexml->Result->IsIPCheckUsed;
		$data0['IsIPCheckUsed'] = @$data1_obj;
	$data0['isipcheckused'] = @$data0['IsIPCheckUsed'];
if(!isset($data0['AllowedIPs'])){$data0['AllowedIPs'] = array();}

	if(!isset($simplexml->Result->AllowedIPs) || is_null($simplexml->Result->AllowedIPs) || !$simplexml->Result->AllowedIPs)		$data1_obj = @array();

	else
		$data1_obj = @$simplexml->Result->AllowedIPs->children();
		$data0['AllowedIPs'] = @array();
		foreach($data1_obj as $value1){
			$data0['AllowedIPs'][] = @$value1;
		}
	$data0['allowedips'] = @$data0['AllowedIPs'];
if(!isset($data0['AdminPanelLanguage'])){$data0['AdminPanelLanguage'] = array();}
		$data1_obj = @$simplexml->Result->AdminPanelLanguage;
		$data0['AdminPanelLanguage'] = @(string)$data1_obj;
	$data0['adminpanellanguage'] = @$data0['AdminPanelLanguage'];
if(!isset($data0['AvailableLanguages'])){$data0['AvailableLanguages'] = array();}

	if(!isset($simplexml->Result->AvailableLanguages) || is_null($simplexml->Result->AvailableLanguages) || !$simplexml->Result->AvailableLanguages)		$data1_obj = @array();

	else
		$data1_obj = @$simplexml->Result->AvailableLanguages->children();
		$data0['AvailableLanguages'] = @array();
		foreach($data1_obj as $value1){
			$data1_tmp = @array();
			$data1_tmp['Name'] = @(string)$value1->Name;
			$data1_tmp['name'] = @(string)$value1->Name;
			$data1_tmp['Description'] = @(string)$value1->Description;
			$data1_tmp['description'] = @(string)$value1->Description;
			$data0['AvailableLanguages'][] = @$data1_tmp;
		}
	$data0['availablelanguages'] = @$data0['AvailableLanguages'];
if(!isset($data0['Features'])){$data0['Features'] = array();}

	if(!isset($simplexml->Result->Features) || is_null($simplexml->Result->Features) || !$simplexml->Result->Features)		$data1_obj = @array();

	else
		$data1_obj = @$simplexml->Result->Features->children();
		$data0['Features'] = @array();
		foreach($data1_obj as $value1){
			$data1_tmp = @array();
			$data1_tmp['Name'] = @(string)$value1->Name;
			$data1_tmp['name'] = @(string)$value1->Name;
			$data1_tmp['Description'] = @(string)$value1->Description;
			$data1_tmp['description'] = @(string)$value1->Description;
			$data0['Features'][] = @$data1_tmp;
		}
	$data0['features'] = @$data0['Features'];
	return $data0;
    }

}