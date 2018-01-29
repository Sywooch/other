<?

$server = str_replace('www.', '', isset($_SERVER['SERVER_NAME']) ? $_SERVER['SERVER_NAME'] : '');

if (file_exists($server.'.php'))
{
    include($server.'.php');
} else {
    if (file_exists(dirname(__FILE__).'/configcustom.php'))
    {
        include(dirname(__FILE__).'/configcustom.php');
    } else {
        define('CFG_SERVICE_APPPASSWORD', 'test');
        define('CFG_SERVICE_APPKEY', 'app_key_16');
        define('CFG_SERVICE_INSTANCEKEY', 'opendemo');        
        // Alert
        define('CFG_NEED_CUSTOM_CONFIG', true);
		define('CFG_WEBPHOTO', true);
    }
}

?>