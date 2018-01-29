<?php

/**
 * Работа с пользователями + ЛК
 */
class Users
{
    public static function loginUser()
    {
        global $otapilib;

        $sid = Session::getUserOrGuestSession();
        $user = $otapilib->GetUserStatusInfo($sid);

        if(!(bool)$user){
            Session::clearUserData();
        }

        return $user;
    }

    public static function AutoLogin() {
        global $otapilib;

        $cookieName = str_replace(array(' ',',',';','='),'',$_SERVER['HTTP_HOST']).'Auth';

        if(isset($_COOKIE[$cookieName]))
            $sid = $_COOKIE[$cookieName];
        else
            return false;

        $auth = (string)$otapilib->GetUserStatusInfo($sid);
        if($auth!=''){
            Session::setUserData(array(
                'sid' => $sid,
                'username' => (string)$auth,
                'IsAuthenticated' => true
            ));
            Session::set(Session::getHttpHost() . 'isMayAuthenticated', true);
        }
        else{
            $cookieValue = false;
            $cookieExpires = time() - (60 * 60 * 24 * 60);

            setcookie($cookieName, $cookieValue, $cookieExpires);
            unset($_COOKIE[$cookieName]);
        }
        return $auth;
    }
    public static function Login($fields){
        global $otapilib;
        $otapilib->setErrorsAsExceptionsOn();

        $remember = @(bool)$fields['remember'] ? 'true' : 'false';
        $auth = $otapilib->Authenticate(session_id(), trim($fields['username']), trim($fields['password']), $remember);
        if($auth){
            Session::setUserData(array(
                'sid' => $auth,
                'username' => $fields['username'],
                'IsAuthenticated' => true
            ));
            Session::set(Session::getHttpHost() . 'isMayAuthenticated', true);
            
            if(@$fields['remember']){
                $cookieName = str_replace(array(' ',',',';','='),'',$_SERVER['HTTP_HOST']).'Auth';
                $cookieValue = $auth;
                $cookieExpires = time() + (60 * 60 * 24 * 60);

                setcookie($cookieName, $cookieValue, $cookieExpires);
            }

            $otapilib->setErrorsAsExceptionsOff();
            return array(true, '');
        }
        else{
            $otapilib->setErrorsAsExceptionsOff();
            return array(false, $otapilib->error_message);
        }
    }
    public static function Logout()
    {
        Session::clearUserData();

        $cookieName = str_replace(array(' ',',',';','='),'',$_SERVER['HTTP_HOST']).'Auth';
        $cookieValue = '';
        $cookieExpires = time() -3600;

        setcookie($cookieName, $cookieValue, $cookieExpires);

        unset($_COOKIE[$cookieName]);
    }

    public static function getCookieSession()
    {
        $cookieName = str_replace(array(' ',',',';','='),'',$_SERVER['HTTP_HOST']).'ServiceAuth';

        if(isset($_COOKIE[$cookieName]))
            return $_COOKIE[$cookieName];
        else
            return false;
    }

    public static function setCookieSession($sid)
    {
        $cookieName = str_replace(array(' ',',',';','='),'',$_SERVER['HTTP_HOST']).'ServiceAuth';
        $cookieValue = $sid;
        $cookieExpires = time() + (60 * 60 * 24 * 60);

        setcookie($cookieName, $cookieValue, $cookieExpires);
    }

    public static function clearCookieSession()
    {
        $cookieName = str_replace(array(' ',',',';','='),'',$_SERVER['HTTP_HOST']).'ServiceAuth';
        setcookie($cookieName, '');
    }
}
