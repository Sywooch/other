<?php
/**
 * Класс для работы с сессиями
 */
class Session
{
    public static function getHttpHost()
    {
        $result = str_replace(':8080', '', $_SERVER['HTTP_HOST']);
        return $result;
    }

    public static function start()
    {
        session_start();
    }

    public static function getUserSession()
    {
        if (is_array(self::getUserData())) {
            if (! array_key_exists('sid', self::getUserData())) {
                throw new NotFoundException('Not found user session', '-1');
            }
        } else {
            throw new NotFoundException('Not found user session', '-1');
        }
        $sid = self::getUserData('sid');
        if (empty($sid)) {
            throw new InternalError('User session is empty');
        }
        return $sid;
    }

    public static function getUserOrGuestSession()
    {
        if (self::getUserData('sid')) {
            $sid = self::getUserData('sid');
            Users::setCookieSession($sid);
        } elseif (Users::getCookieSession()) {
            $sid = Users::getCookieSession();
        } else {
            $sid = session_id();
            Users::setCookieSession(session_id());
        }
        return $sid;
    }

    public static function isAuthenticated()
    {
        $userData = new UserData();
        if (self::get(self::getHttpHost() . 'isMayAuthenticated')) {
            $userStatus = $userData->getUserStatus();
            $return = $userStatus['isAccount'];
        } else {
            $return = false;
        }
        return $return;
    }

    public static function set($name, $value)
    {
        $_SESSION[$name] = $value;
    }

    public static function get($name)
    {
        return array_key_exists($name, $_SESSION) ? $_SESSION[$name] : null;
    }

    public static function extract($name)
    {
        $result = self::get($name);
        self::clear($name);
        return $result;
    }

    public static function clear($name)
    {
        unset($_SESSION[$name]);
    }

    public static function setUserData($userData)
    {
        self::set(self::getHttpHost() . 'loginUserData', $userData);
        if ($userData && ! empty($userData['IsAuthenticated'])) {
            self::set(self::getHttpHost() . 'isMayAuthenticated', true);
        }
    }

    public static function setUserDataKey($key, $data)
    {
        self::setUserData(array_merge(self::getUserData(), array($key => $data)));
    }

    public static function getUserData($key = null)
    {
        $data = self::get(self::getHttpHost() . 'loginUserData');

        if ($key) {
            return is_array($data) && array_key_exists($key, $data) ? $data[$key] : null;
        }

        return !is_null($data) ? $data : array();
    }

    public static function clearUserData()
    {
        Users::clearCookieSession();
        self::clear(self::getHttpHost() . 'isMayAuthenticated');
        self::clear(self::getHttpHost() . 'loginUserData');
        self::clear(self::getHttpHost() . 'loginUserInfo');
        //session_destroy();
    }

    public static function getUserDataSid()
    {
        return self::getUserOrGuestSession();
    }

    public static function getUserDataByKey($key)
    {
        return self::getUserData($key);
    }

    public static function setUserInfo($userInfo)
    {
        self::set(self::getHttpHost() . 'loginUserInfo', $userInfo);
    }

    public static function setUserInfoKey($key, $data)
    {
        self::setUserInfo(array_merge(self::getUserInfo(), array($key => $data)));
    }


    /**
     * @TODO: чем это тметод отличается от getUserData ?
     * В каких случаях надо использовать этот метода, а в каких getUserData?
     * Почему в этом методе используются ключи 'loginUserInfo' и 'loginUserData' ??
    **/
    public static function getUserInfo($key = null)
    {
        if($key){
            $data = self::get(self::getHttpHost() . 'loginUserInfo');
            if ($key && is_array($data) && array_key_exists($key, $data)) {
                return $data[$key];
            }
            return $data;
        }
        else{
            return isset($_SESSION[self::getHttpHost().'loginUserData']) ? $_SESSION[self::getHttpHost().'loginUserData'] :
                array(
                    'username' => '',
                    'IsAuthenticated' => false
                );
        }
    }

    public static function setError($description, $code = null)
    {
        self::set('error', array(
            'description' => (string)$description,
            'code' => (string)$code,
        ));
    }

    public static function getErrorCode()
    {
        $error = self::get('error');
        return is_array($error) && !empty($error['code']) ? $error['code'] : null;
    }

    public static function getErrorDescription()
    {
        $error = self::get('error');
        if (is_array($error)) {
            $result = $error['description'];
            self::clear('error');
            return $result;
        }
    }

    public static function checkErrors()
    {
        return (bool) self::get('error');
    }

    public static function checkAdminErrors()
    {
        $error = self::get('error');
        if (is_array($error) && !empty($error['description'])) {
            print '<script> $(function () {
                show_error("'. $error['description'] .'"); });
            </script>';
            self::clear('error');
        }
    }

    public static function clearError()
    {
        self::clear('error');
    }

    public static function setMessage($message)
    {
        self::set('info-message', $message);
    }

    public static function getMessage()
    {
        $message = self::get('info-message');
        self::clear('info-message');
        return $message;
    }

    public static function isSessionExpired()
    {
        return (bool) (self::getErrorCode() == 'SessionExpired');
    }

    public static function getActiveLang()
    {
        return self::get('active_lang');
    }

    public static function setActiveLang($value)
    {
        self::set('active_lang', $value);
    }

    public static function getActiveAdminLang()
    {
        return self::get('active_lang_admin') ? self::get('active_lang_admin') : 'ru';
    }

    public static function setActiveAdminLang($value)
    {
        self::set('active_lang_admin', $value);
    }
}
