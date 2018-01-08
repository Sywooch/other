<?php
//if (!in_array($_SERVER['REMOTE_ADDR'], array('83.229.142.164'))) {
//	include 'tw.php';
//	exit;
//}

ini_set('display_errors', 'on');

if (!function_exists('gettext')) {
    function gettext($t)
    {
        return $t;
    }

    function _($t)
    {
        return gettext($t);
    }
}

/**
 * Development mode
 */
if ($_SERVER['SERVER_ADDR'] === '192.168.0.13') {
    defined('ZF_DEBUG') or define('ZF_DEBUG', true);
} else {
    defined('ZF_DEBUG') or define('ZF_DEBUG', false);
}

define('ROOT_PATH', dirname(__FILE__) . '/');
define('SMARTY_DIR', ROOT_PATH . 'zf/third-party/smarty/libs/');

require_once file_exists(ROOT_PATH . '.zf_compiled/requirer.php') ? ROOT_PATH . '.zf_compiled/requirer.php' : ROOT_PATH . 'zf/requirer.php';

zf::run_app();