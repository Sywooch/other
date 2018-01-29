<?php
/**
 * Класс для работы с сессиями
 */
class Session
{
    public static function getUserSession(){
        if(!isset($_SESSION[CFG_SITE_NAME.'loginUserData']['sid']))
            throw new NotFoundException('Not found user session');
        $sid = $_SESSION[CFG_SITE_NAME.'loginUserData']['sid'];
        if(empty($sid))
            throw new InternalError('User session is empty');

        return $sid;
    }

    public static function getUserOrGuestSession(){
        if(isset($_SESSION[CFG_SITE_NAME.'loginUserData']['sid']))
            $sid = $_SESSION[CFG_SITE_NAME.'loginUserData']['sid'];
        else
            $sid = session_id();

        return $sid;
    }

    public static function set($name, $value){
        $_SESSION[$name] = $value;
    }

    public static function get($name){
        return isset($_SESSION[$name]) ? $_SESSION[$name] : false;
    }

    public static function setError($description, $code){
        $_SESSION['error'] = array(
            'description' => (string)$description,
            'code' => (string)$code,
        );
    }

    public static function checkErrors(){
        if(isset($_SESSION['error']) && is_array($_SESSION['error'])){
            show_error($_SESSION['error']['description']);
            unset($_SESSION['error']);
        }
    }

    public static function checkAdminErrors(){
        if(isset($_SESSION['error']) && is_array($_SESSION['error'])){
            print '<script>
                show_error("'. $_SESSION['error']['description'] .'");
            </script>';
            unset($_SESSION['error']);
        }
    }

    public static function clearError(){
        unset($_SESSION['error']);
    }

    public static function isSessionExpired(){
        return isset($_SESSION['error']['code']) && $_SESSION['error']['code'] == 'SessionExpired';
    }
}
