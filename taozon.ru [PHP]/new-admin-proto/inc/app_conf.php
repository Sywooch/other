<?

/* app titles */
$menu = array(
    '/' => 'Tradehub System. Главная',
    '/orders' => 'Заказы. Роль Агента. Расчетный центр Tradehub System',
);

$path = str_replace('\\', '/', dirname(dirname(__FILE__)));
$diff = str_replace($_SERVER['DOCUMENT_ROOT'],'', $path);

$uri = trim(str_replace($diff, '', $_SERVER["REQUEST_URI"]), '/');
