<?php

class Request
{
    /**
     * Классы, доступность которых зависит от наличия включенной фичи
    **/
    private static $featuresClassesMap = array(
        'Warehouse' => array('Warehouse'),
        'FleaMarket' => array('Pristroy'),
    );

    private static $cmdToCaseSensitiveClassMap = array(
        'siteconfiguration'       => 'SiteConfiguration',
        'ipaccess'                => 'IpAccess',
        'multilingualsettings'    => 'MultilingualSettings',
    );

    /**
     * @param   RequestWrapper            $request
     * @param   AuthenticationListener    $authenticationListener
     * @return  mixed
     * @throws  Exception
     */
    static function handle($request, $authenticationListener)
    {
        $path = RightsManager::defaultPath();
        $cmd = $request->request('cmd') ? $request->request('cmd') : $path['cmd'];
        $do = $request->request('do') ? $request->request('do') : $path['do'];

        if (strtolower($cmd) !== 'login') {
            // Если мы не на странице логаута или логина, проверим авторизованность пользователя
            if (! $authenticationListener->IsAuthenticated($request)) {
                $loginUrl = 'http://' . $request->env('HTTP_HOST') . '/' . $request->getUriPart(0) . '/?cmd=Login';
                if ($request->env('HTTP_X_REQUESTED_WITH')
                    && (strtolower($request->env('HTTP_X_REQUESTED_WITH')) === 'xmlhttprequest')
                ) {
                    if ($request->getReferrer()) {
                        $loginUrl .= '&retpath=' . $request->getReferrer();
                    }
                    $message = LangAdmin::get('Session_expired');
                    $response = array(
                        'error' => 1,
                        'message' => $message,
                        'redirect' => $loginUrl,
                        'expired' => 1
                    );
                    Session::setError($message);
                    echo json_encode($response);
                    die();
                } else {
                    $authenticationListener->Logout($request);
                    $request->LocationRedirect($loginUrl);
                }
            }

            if (! RightsManager::isAvailableCmd($cmd, $do)) {
                $path = RightsManager::defaultPath($cmd, $do);
                if (strtolower($cmd) !== strtolower($path['cmd'])) {
                    Session::setError(LangAdmin::get('Action_not_allowed_for_user'));
                }
                $redirectUrl = 'http://' . $request->env('HTTP_HOST') . '/' . $request->getUriPart(0) . '/?' . http_build_query($path);
                $request->LocationRedirect($redirectUrl);
            }
        }

        $class_name = self::getCmdClass($cmd);
        $method_name = $do . 'Action';
        if (self::isFeatureEnabled($class_name) && class_exists($class_name, true)) {
            $cmd = new $class_name();
            if (! method_exists($cmd, $method_name) && method_exists($cmd, 'getDefaultAction')) {
                $do = $cmd->getDefaultAction();
                $method_name = $do . 'Action';
            }
            if (method_exists($cmd, $method_name)) {
                if (method_exists($cmd, 'onBeforeAction')) {
                    $cmd->onBeforeAction($do);
                }

                $isMultiCurlAction = in_array($do, $cmd->getMultiCurlActions());

                if (OTBase::isMultiCurlEnabled() && $isMultiCurlAction) {
                    $cmd->startMulti();
                    $cmd->$method_name($request);
                    $cmd->doMulti();
                }

                $output = $cmd->$method_name($request);

                if (OTBase::isMultiCurlEnabled() && $isMultiCurlAction) {
                    $cmd->stopMulti();
                }

                return $output;
            }
        }

        throw new Exception('Unknown Request '.$class_name.'::'.$method_name, 1);
    }


    public static function getCmdClass($cmd)
    {
        $lowerCmd = strtolower($cmd);
        $result = $cmd;
        if (isset(self::$cmdToCaseSensitiveClassMap[$lowerCmd])) {
            $result = self::$cmdToCaseSensitiveClassMap[$lowerCmd];
        }
        return ucfirst($result);
    }

    /**
     * Проверяет соотвествие запрашиваемых классов набору разрешённых фич
    **/
    private static function isFeatureEnabled($class_name)
    {
        foreach (self::$featuresClassesMap as $feature => $classes) {
            if (! CMS::isFeatureEnabled($feature) && in_array($class_name, $classes)) {
                return false;
            }
        }
        return true;
    }

    static function http($url, $method, $params) {

        $ch = curl_init();

        $url = $url . '?' . http_build_query($params,'','&');
        curl_setopt($ch, CURLOPT_URL, $url );
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST,  $method );
        curl_setopt($ch, CURLOPT_POSTFIELDS, $params);

        $data = curl_exec($ch);
        if (curl_errno($ch)) {
            throw new Exception(curl_error($ch));
        }
        $data = new SimpleXmlElement($data);

        switch($data->ErrorCode){
            case 'Ok':
                break;
            case 'SessionExpired':
                throw new Exception($data->ErrorDescription,ERR_SESSION_EXPIRED);
                break;
            default:
                throw new Exception($data->ErrorDescription,ERR_UNKNOWN);
        }

        curl_close($ch);

        return $data;
    }
}
