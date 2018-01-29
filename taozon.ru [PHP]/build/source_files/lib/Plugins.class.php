<?php
/**
 * Created by JetBrains PhpStorm.
 * User: dima
 * Date: 20.08.12
 * Time: 11:13
 * To change this template use File | Settings | File Templates.
 */
class Plugins{
    const NOTHING_CALLED = false;

    public static function onAddScriptProcessor($scriptName, $suffix=''){
        if(!file_exists(CFG_APP_ROOT . '/config/script_controller'.$suffix.'.xml')){
            return false;
        }
        $xml = simplexml_load_file(CFG_APP_ROOT . '/config/script_controller'.$suffix.'.xml');
        $script = $xml->xpath('script[@name="'.$scriptName.'"]');

        if(@!$script[0])
            $script = self::findPackagesRoutes($scriptName);
        if(@!$script[0])
            return false;

        $script = $script[0];

        $action = $script->xpath('action');
        if(count($action)){
            $action = $action[0];
            $blockName = (string)$action['block'];
            $methodName = (string)$action['action'] . 'Action';

            if(isset($action['path']) && !empty($action['path'])){
                require_once CFG_APP_ROOT . '/' . $action['path'] . $blockName . '.class.php';
            }
            $block = new $blockName;

            $parameters = array();
            if(count($action->xpath('param'))){
                foreach($action->xpath('param') as $p){
                    $parameters[(string)$p['name']] =
                        call_user_func(array('RequestWrapper', (string)$p['method']), (string)$p['name']);
                }
            }

            $parameters[] = new RequestWrapper();
            call_user_func_array(array($block, $methodName), $parameters);
            die();
        }

        $template = $script->xpath('template');

        define('CFG_PAGE_TEMPLATE', (string)$template[0]['name']);
        if(isset($script['no_debug']) && !defined('NO_DEBUG'))
            define('NO_DEBUG', true);

        $templateBlocks = array();
        $blocks = $script->xpath('blocks/block');
        foreach($blocks as $block){
            $templateBlocks[] = (string)$block['name'];
        }
        return $templateBlocks;
    }

    public static function onAddScriptProcessorCheck($scriptName, $suffix=''){
        if(file_exists(CFG_APP_ROOT . '/config/script_controller'.$suffix.'.xml')){
            $xml = simplexml_load_file(CFG_APP_ROOT . '/config/script_controller'.$suffix.'.xml');
            $script = $xml->xpath('script[@name="'.$scriptName.'"]');
            if(@!$script[0])
                $script = self::findPackagesRoutes($scriptName);
            if(@!$script[0])
                return false;
            return $scriptName;
        }
        return false;
    }

    public static function onRenderUserEditForm(&$user){
        if(defined('CFG_TAO141')){
            return Tao141Clients::onRenderUserEditForm($user);
        }
    }
    public static function onAddUser($data, $newUserId){
        if(defined('CFG_TAO141')){
            return Tao141Clients::onAddUser($data, $newUserId);
        }
        if(defined('CFG_SITE_CUSTOMIZE') && CFG_SITE_CUSTOMIZE == 'Tbe'){
            return TbeClients::onAddUser($data);
        }
    }
    public static function onEditUser($data){
        if(defined('CFG_TAO141')){
            return Tao141Clients::onEditUser($data);
        }
        if(defined('CFG_SITE_CUSTOMIZE') && CFG_SITE_CUSTOMIZE == 'Tbe'){
            return TbeClients::onEditUser($data);
        }
    }
    public static function onRenderMoneyInfo($sid){
        if(defined('CFG_TAO141')){
            return Tao141Clients::onRenderMoneyInfo($sid);
        }
        else{
            return false;
        }
    }
    public static function onCreateOrder($sid, $model){
        if(defined('CFG_TAO141')){
            return Tao141Clients::onCreateOrder($sid, $model);
        }
        else{
            return 0;
        }
    }
    public static function onRenderFilterOrdersForm(){
        if(defined('CFG_SITE_CUSTOMIZE')){
            $res = @call_user_func_array(CFG_SITE_CUSTOMIZE.'Clients::onRenderFilterOrdersForm', array());
            if($res) return $res;
        }
        return false;
    }
    public static function onRenderNotificationForm(){
        if(defined('SEND_EMAIL_NOTIFICATION')) {
            ob_start();
            require dirname(__FILE__).'/tpl/clients.onRenderNotificationForm.html';
            $c = ob_get_contents();
            ob_end_clean();
            return $c;
        }
        return false;
    }
    public static function invokeEvent($event, $args = array()){
        if(defined('CFG_SITE_CUSTOMIZE')){
            $res = @call_user_func_array(CFG_SITE_CUSTOMIZE.'Clients::'.$event, $args);
            if($res)
                return $res;
        }

        $result = '';

        list($isFinal, $invokePackage) = self::findPackageForEvent($event, $args);
        if($invokePackage != self::NOTHING_CALLED && $isFinal)
            return $invokePackage;
        elseif(self::NOTHING_CALLED)
            $result .= $invokePackage;

        $invokePackage = self::callPriorityPackage($event, $args);
        if($invokePackage != self::NOTHING_CALLED)
            $result .= $invokePackage;

        return $result === '' ? false : $result;
    }

    private static function callPriorityPackage($event, $args){

        if(!file_exists(CFG_APP_ROOT.'/config/events.xml'))
            return self::NOTHING_CALLED;

        $events = simplexml_load_file(CFG_APP_ROOT.'/config/events.xml');
        $eventHandler = $events->xpath('event[@name="'.$event.'"]');

        if(!$eventHandler)
            return self::NOTHING_CALLED;

        if(!class_exists((string)$eventHandler[0]['class_name'], false)){
            require CFG_APP_ROOT.'/packages/'.(string)$eventHandler[0]['pakage_path'].'/'
                .(string)$eventHandler[0]['class_name'].'.class.php';
        }

        return call_user_func_array((string)$eventHandler[0]['class_name'].'::'.$event, $args);
    }

    private static function findPackageForEvent($event, $args){
        $packages = glob(CFG_APP_ROOT . '/packages/*');
        if(!$packages)
            return array(false, self::NOTHING_CALLED);

        $result = '';

        foreach($packages as $package){
            if(!file_exists($package.'/config/events.xml'))
                continue;

            $events = simplexml_load_file($package.'/config/events.xml');
            $eventHandler = $events->xpath('event[@name="'.$event.'"]');
            if(!$eventHandler)
                continue;

            if(!class_exists((string)$eventHandler[0]['class_name'], false)){
                require CFG_APP_ROOT.'/packages/'.(string)$eventHandler[0]['pakage_path'].'/'
                    .(string)$eventHandler[0]['class_name'].'.class.php';
            }
            if(isset($eventHandler[0]['allow_other_handlers']) && (string)$eventHandler[0]['allow_other_handlers'])
                $result .= call_user_func_array((string)$eventHandler[0]['class_name'].'::'.$event, $args);
            else
                return array(true, call_user_func_array((string)$eventHandler[0]['class_name'].'::'.$event, $args));
        }

        return array(false, $result);
    }

    private static function findPackagesRoutes($scriptName){
        $packages = glob(CFG_APP_ROOT . '/packages/*');
        if(!$packages)
            return false;

        foreach($packages as $package){
            if(!file_exists($package.'/config/script_controller.xml'))
                continue;

            $routes = simplexml_load_file($package.'/config/script_controller.xml');
            $routeHandler = $routes->xpath('script[@name="'.$scriptName.'"]');
            if(@$routeHandler[0]){
                return $routeHandler;
            }
        }

        return false;
    }
}
