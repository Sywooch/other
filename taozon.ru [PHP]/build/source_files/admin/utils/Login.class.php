<?php

class Login
{
    static function auth()
    {
        if (isset($_POST['login'], $_POST['password'])) {

            $GLOBALS['log'] = $_POST['login'];

            /*
            *  SessionId
            *
            *  $_SESSIONS
            */

            global $otapilib;
            $data = $otapilib->AuthenticateInstanceOperator($_POST['login'], $_POST['password']);

            if($data === false)
                show_error();

            if (isset($data['SessionId'])) {
                $_SESSION['sid'] = (string)$data['SessionId'];
                unset($_SESSION['current_roles']);
                $GLOBALS['ssid'] = session_id();
                if(defined('CFG_SAVE_ADMIN_COOKIE')){
                    $cookieName = str_replace(array(' ',',',';','='),'',CFG_SITE_NAME).'AuthAdmin';
                    $cookieValue = (string)$data['SessionId'];
                    $cookieExpires = time() + (10 * 24 * 60);
                    setcookie($cookieName, $cookieValue, $cookieExpires);
                }
            }
            header('Location: index.php');
        }

        $cookieName = str_replace(array(' ',',',';','='),'',CFG_SITE_NAME).'AuthAdmin';
        if(defined('CFG_SAVE_ADMIN_COOKIE') && @$_COOKIE[$cookieName]){
            $_SESSION['sid'] = $_COOKIE[$cookieName];
            $GLOBALS['ssid'] = session_id();
        }
        if(isset($_GET['expired'])){
            $cookieExpires = time()-3600;
            setcookie($cookieName, '', $cookieExpires);
            header('Location: index.php?cmd=login');
        }

        if (@$_SESSION['sid'] != '')
        return true;

        /*
        if($GLOBALS['ssid'] != '')
            return true;
        */
        return false;
    }

}