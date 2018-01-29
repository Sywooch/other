<?
ini_set( "display_errors", 0);
// define('CFG_SERVICE_URL', 'http://5.9.32.197/OtapiWebService2.asmx/');
define('CFG_SERVICE_URL', 'http://otapi.net/OtapiWebService2.asmx/');
define('CFG_SERVICE_INSTANCEKEY', 'ad8c006b-f095-425f-959b-54f7027f4bc6');
define('CFG_SITE_NAME', 'Taozon.ru');
define('CFG_CACHED', false);
define('CFG_MULTI_CURL', 0);

if(!isset($_GET['debug']))
define('NO_DEBUG', true);

define('DB_HOST', 'localhost');
define('DB_USER', 'opentao');
define('DB_PASS', 'owelomejaxiye057');
define('DB_BASE', 'opentao');

?>