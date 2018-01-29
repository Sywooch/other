<?php

class UsersVisitsInfo
{
    public static $session;
    public static $sessionsDir;

    public static function onHeadRendered()
    {
        $action = defined('SCRIPT_NAME') ? SCRIPT_NAME : '';
        print '<script>var action = "'.$action.'";</script>';
        print '<script src="/lib/users_visits_info/js/user_visit.js"></script>';
    }

    public static function initSession($eTag, $forceReInit = false) {
        if (!$forceReInit && file_exists(self::$sessionsDir . $eTag)) {
            self::$session = unserialize(file_get_contents(self::$sessionsDir . $eTag));
        }
        else {
            General::loadEnabledFeatures();
            $features = General::$enabledFeatures;
            sort($features);
            self::$session = array("visits" => 1, "last_visit" => date('Y-m-d H:i:s'), "last_page" => $_REQUEST['referrer'],
                'is_custom_exists' => (int)self::isCustomExists(), 'release_version' => self::getCurrentVersion(),
                'modules' => $features);
        }
    }

    public static function updateSession() {
        self::$session["visits"] += 1;
        self::$session["last_visit"] = date('Y-m-d H:i:s');
        self::$session["last_page"] = $_REQUEST['referrer'];
        self::$session["otapi_calls"] = isset($_SESSION['otapi_calls']) ? $_SESSION['otapi_calls'] : array();
        unset($_SESSION['otapi_calls']);
        self::$session["loading_time"] = isset($_SESSION['loading_time']) ? $_SESSION['loading_time'] : 0;
        unset($_SESSION['loading_time']);
    }

    // Write any changes to the disk
    public static function storeSession($eTag) {
        $fid = fopen(self::$sessionsDir . $eTag, "w");
        fwrite($fid, serialize(self::$session));
        fclose($fid);

        $fid = fopen(self::$sessionsDir . $eTag . '_', "w");
        fwrite($fid, json_encode(self::$session));
        fclose($fid);
    }

    private static function isCustomExists()
    {
        $baseDir = dirname(dirname(dirname(__FILE__))) . '/';
        $templatesCustomDir = $baseDir . 'templatescustom/';
        $blocksCustomDir = $baseDir . 'blockscustom/';
        return (file_exists($templatesCustomDir . 'main/itemlistnew.html') || file_exists($blocksCustomDir . 'ItemListNew.class.php'))

            || (file_exists($templatesCustomDir . 'menu/menushortnew.html') && !file_exists($blocksCustomDir . 'MenuShortNew.class.php'))
            || (!file_exists($templatesCustomDir . 'menu/menushortnew.html') && file_exists($blocksCustomDir . 'MenuShortNew.class.php'))

            || (file_exists($templatesCustomDir . 'main/itemsetsnew.html') && !file_exists($blocksCustomDir . 'ItemSetsNew.class.php'))
            || (file_exists($templatesCustomDir . 'main/iteminfonew.html') || file_exists($blocksCustomDir . 'ItemInfoNew.class.php'))
            || (file_exists($templatesCustomDir . 'main/headernew.html') || file_exists($blocksCustomDir . 'HeaderNew.class.php'))
            || (file_exists($templatesCustomDir . 'order/step3new.html') || file_exists($templatesCustomDir . 'order/step4new.html')
                    || file_exists($blocksCustomDir . 'UserZakazNew.class.php'))
            || (file_exists($templatesCustomDir . 'pay/pay.html') || file_exists($templatesCustomDir . 'pay/pay_form.html')
                    || file_exists($blocksCustomDir . 'Pay.class.php'))
            ;
    }

    private static function getCurrentVersion() {
        $baseDir = dirname(dirname(dirname(__FILE__))) . '/';
        $path = $baseDir . 'updates/version.xml';
        if (file_exists($path)) {
            $versions = simplexml_load_file($path);
            $v = (string)$versions->Version[0]->Number;
        } else {
            $v = 0;
        }
        return $v;
    }
}