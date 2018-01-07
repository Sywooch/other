<?

function customAutoload($className) {
    if (!CModule::RequireAutoloadClass($className)) {

        $path = $_SERVER["DOCUMENT_ROOT"]."/local/php_interface/include/classes/" .
            str_replace('\\', DIRECTORY_SEPARATOR, $className) . '.php';

        if (file_exists($path)) {
            require_once $path;
            return true;
        }
        return false;
    }
    return true;
}

if(file_exists($_SERVER["DOCUMENT_ROOT"]."/local/php_interface/include/constants.php"))
    require_once($_SERVER["DOCUMENT_ROOT"]."/local/php_interface/include/constants.php");

if(file_exists($_SERVER["DOCUMENT_ROOT"]."/local/php_interface/include/helpers.php"))
    require_once($_SERVER["DOCUMENT_ROOT"]."/local/php_interface/include/helpers.php");

if(file_exists($_SERVER["DOCUMENT_ROOT"]."/local/php_interface/include/handlers.php"))
    require_once($_SERVER["DOCUMENT_ROOT"]."/local/php_interface/include/handlers.php");

if(file_exists($_SERVER["DOCUMENT_ROOT"]."/local/php_interface/include/functions.php"))
require_once($_SERVER["DOCUMENT_ROOT"]."/local/php_interface/include/functions.php");


spl_autoload_register('customAutoload', false);


