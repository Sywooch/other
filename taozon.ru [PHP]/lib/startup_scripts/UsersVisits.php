<?php

class UsersVisits {

    private static $newVisitsNotificationUrl = 'http://statistics.opentao.net/on_ready_new_visits_log';
    private static $newPurchasesNotificationUrl = 'http://statistics.opentao.net/on_ready_new_purchases_log';

    private static $visitsStatServerHost = 'users-visits.opentao.net';
    private static $visitsStatServerPort = 8082;

    //private static $visitsStatServerHost = '127.0.0.1';
    //private static $visitsStatServerPort = 6543;

    public static function saveVisit($uuid=false, $sessionData=array()){
        if ($uuid === false)
            return;

        $request = new RequestWrapper();
        if ($request->isAjax()) {
            return ;
        }

        $data = self::getClientData();
        $data['uuid'] = $uuid;
        $data['session_data'] = $sessionData;
        $data['session_data']['action'] = defined('SCRIPT_NAME') ? SCRIPT_NAME : RequestWrapper::get('action');
        $fp = fsockopen(self::$visitsStatServerHost, self::$visitsStatServerPort, $errNo, $errStr, 1);

        $out = "POST /rest/visits HTTP/1.1\r\n";
        $out.= "Host: ".self::$visitsStatServerHost.":".self::$visitsStatServerPort."\r\n";
        $out.= "X-Instance-Key: ".CFG_SERVICE_INSTANCEKEY."\r\n";
        $out.= "Content-Type: application/json\r\n";
        $out.= "Content-Length: ".strlen(json_encode($data))."\r\n";
        $out.= "Connection: Close\r\n\r\n";
        $out.= json_encode($data);

        fwrite($fp, $out);
        fclose($fp);
    }

    public static function saveUserPurchase($orderId, $amount){
        $data = self::getClientData();
        $ip = $data['ip'];
        $userName = $data['username'];
        $userCookie = $data['user_agent'];

        $repo = new UsersPurchasesRepository(new CMS());
        $repo->AddPurchase($orderId, $amount, $ip, $userCookie, $userName);
    }

    public static function getClientData(){
        $ip = self::getClientIp();
        $userName = Session::getUserData('username') !== null ? Session::getUserData('username') : '';

        return array(
            'ip' => $ip,
            'username' => $userName,
            'user_agent' => self::getUserAgent()
        );
    }

    public static function getUserAgent()
    {
        $request = new RequestWrapper();
        return $request->env('HTTP_USER_AGENT', 'Undefined');
    }

    public static function getClientIp(){
        $request = new RequestWrapper();
        $client  = $request->env('HTTP_CLIENT_IP', false);
        $forward  = $request->env('HTTP_X_FORWARDED_FOR', false);
        $remote  = $request->env('REMOTE_ADDR', false);

        if(filter_var($client, FILTER_VALIDATE_IP)){
            $ip = $client;
        }
        elseif(filter_var($forward, FILTER_VALIDATE_IP)){
            $ip = $forward;
        }
        else{
            $ip = $remote;
        }

        return htmlspecialchars($ip,ENT_QUOTES);
    }

    public static function notifyOnNewPurchases(){
        $purchasesRepo = new UsersPurchasesRepository(new CMS());
        if($purchasesRepo->GetNewPurchasesCount() > 10){
            $curl = new Curl(self::$newPurchasesNotificationUrl, 5, true, 10);
            $curl->setReferer('http://' . trim($_SERVER['HTTP_HOST'], '/') . '/');

            $visitsJson = json_encode($purchasesRepo->GetNewPurchases());
            $curl->setPost(array('json' => $visitsJson, 'time' => time()));
            $curl->connect();

            if($curl->getStatus() == 200){
                $purchasesRepo->SetNewPurchasesAsSent();
                $purchasesRepo->DeleteOldPurchases();
            }
        }
    }

    public static function notifyOnNewVisits(){
        $visitsRepo = new UsersVisitsRepository(new CMS());
        if($visitsRepo->GetNewVisitsCount() > 100){
            $curl = new Curl(self::$newVisitsNotificationUrl, 5, true, 10);
            $curl->setReferer('http://' . trim($_SERVER['HTTP_HOST'], '/') . '/');

            $visitsJson = json_encode($visitsRepo->GetNewVisits());
            $curl->setPost(array('json' => $visitsJson, 'time' => time()));
            $curl->connect();

            if($curl->getStatus() == 200){
                $visitsRepo->SetNewVisitsAsSent();
                $visitsRepo->DeleteOldVisits();
            }
        }
    }
}