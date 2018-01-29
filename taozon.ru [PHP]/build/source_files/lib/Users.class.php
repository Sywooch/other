<?php

/**
 * Работа с пользователями + ЛК
 */
class Users {
    public static function loginUser(){
        global $otapilib;
        
        if(isset($_SESSION[CFG_SITE_NAME.'loginUserData']) && $_SESSION[CFG_SITE_NAME.'loginUserData']['sid']) 
            $sid = $_SESSION[CFG_SITE_NAME.'loginUserData']['sid'];
        else 
            $sid = session_id();
        $user = $otapilib->GetUserStatusInfo($sid);
        
        if(!(bool)$user){
            unset($_SESSION[CFG_SITE_NAME.'loginUserData']);
        }
        
        return $user;
    }
    public static function AutoLogin() {
        global $otapilib;
        
        $cookieName = str_replace(array(' ',',',';','='),'',CFG_SITE_NAME).'Auth';
        
        if(isset($_COOKIE[$cookieName]))
            $sid = $_COOKIE[$cookieName];
        else
            return false;
        
        $auth = (string)$otapilib->GetUserStatusInfo($sid);
        if($auth!=''){
            $_SESSION[CFG_SITE_NAME.'loginUserData'] = array(
                'sid' => $sid,
                'username' => (string)$auth
            );
        }
        return $auth;
    }
    public static function Login($fields){
        global $otapilib;
        
        $remember = @(bool)$fields['remember'] ? 'true' : 'false';
        $auth = $otapilib->Authenticate(session_id(), $fields['username'], $fields['password'], $remember);
        if($auth){
            $_SESSION[CFG_SITE_NAME.'loginUserData'] = array(
                'sid' => $auth,
                'username' => $fields['username'],
                'IsAuthenticated' => true
            );
            
            if(@$fields['remember']){
                $cookieName = str_replace(array(' ',',',';','='),'',CFG_SITE_NAME).'Auth';
                $cookieValue = $auth;
                $cookieExpires = time() + (60 * 60 * 24 * 60);

                setcookie($cookieName, $cookieValue, $cookieExpires);
            }
            
            return array(true, '');
        }
        else{
            return array(false, $otapilib->error_message);
        }
    }
    public static function Logout(){
        unset($_SESSION[CFG_SITE_NAME.'loginUserData']);
        setcookie('PHPSESSID', '');

        $cookieName = str_replace(array(' ',',',';','='),'',CFG_SITE_NAME).'Auth';
        $cookieValue = '';
        $cookieExpires = time() -3600;

        setcookie($cookieName, $cookieValue, $cookieExpires);
    }
}

?>
