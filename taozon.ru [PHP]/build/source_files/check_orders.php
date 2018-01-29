<!DOCTYPE html>
<head>
    <meta http-equiv="Content-Type" content="text/html;charset=UTF-8" />
    <title>Opentao dev</title>
    <link rel="stylesheet" href="css/style.css"/>
    <link rel="stylesheet" href="css/custom.css"/>
</head>
<body>
<?

// Запоминаем время начала генерации страницы
$GLOBALS['script_start_time'] = microtime(true);
$GLOBALS['trace'] = array();

// Подключаем файл с паролями от сервиса
require_once('config.php');

// Подключаем конфигурационный файл
require_once('config/config.php');

session_cache_expire(60*24);

/*
 * test user.
 */
$login = 'mm182';
$password = '123456';

$sid = $otapilib->Authenticate(session_id(), $login, $password, 'false');


$id = 15868268842;
$quantity = 1;
$itemTitle = 'кассета vivi фондирует тип Европ 2012 лет новый и Америка восстанавливая снежок парика старого актера ковбоя закручивает шелк бутона цветка для того чтобы вышить цельному платью L80112';
$price = "198.00";
$currencyName =  "yuan";
$externalURL = "http://item.taobao.com/item.htm?id=15868268842";
$spm =  "2014.12424337.0.0";
$pictureURL =  "http://img04.taobaocdn.com/bao/uploaded/i4/T1xabcXX8lXXb9JaUW_022504.jpg";
$vendorId = "尚古主义旗舰店";
$configurationId = "19895371080";
$itemConfiguration = "Цвет:Синий юбка;Размер:XS;";
$comment = "";

$items = $otapilib->GetBasket($sid);

if(!count($items)){
    $r = $otapilib->AddItemToBasket($sid, $id, $quantity, 
                $itemTitle, $configurationId, $price, $currencyName,
                $externalURL, $pictureURL, $vendorId,
                $itemConfiguration, $comment);

    if(!r){
        //echo 'Не получилось положить в корзину товар. Ошибка: '.$otapilib->error_message;
    } else {
        //echo 'Товар добавлен в корзину. Id: '.$r;
    }
}

//  создание нового заказа

echo '<br/><br/><h3>Попытка создать новый заказ.</h3>';
echo 'Количество товаров в корзине до: '.count($otapilib->GetBasket($sid));

$model_id = '';
$comment = '';
$weight = 2;
$order_id = 0;

$models = $otapilib->GetDeliveryModesWithPrice('RU', $weight);

if(!$models) {
    echo 'Не получены способы доставки. Ошибка: ' . $otapilib->error_message;
} else {
    foreach($models as $model){
        $model_id = $model['id']; break;
    }

    $r = $otapilib->CreateSalesOrder($sid, $model_id, $comment, $weight);

    if(!$r){
        echo '<br/>Не получилось создать новый заказ. Ошибка: ' . $otapilib->error_message;
    } else {
        echo '<br/>Заказ успешно создан. Id: '.$r['Id'];
        $order_id = $r['Id'];
        //var_dump($r);
        //$items = $otapilib->GetBasket($sid);
        //echo '<br/>Количество товаров в корзине: '. count($items);
    } 
}
echo '<br/>Количество товаров в корзине после: '.count($otapilib->GetBasket($sid));

if(!$order_id) {
    
    $orders = $otapilib->GetSalesOrdersList($sid, 0);

    foreach($orders as $order) {
        $order_id = $order['id']; break;
    }
}

$r = $otapilib->AddItemToBasket($sid, $id, $quantity, 
                $itemTitle, $configurationId, $price, $currencyName,
                $externalURL, $pictureURL, $vendorId,
                $itemConfiguration, $comment);


echo '<br/><br/><h3>Попытка создать дозаказ к заказу с id: '.$order_id.'</h3>';
echo 'Количество товаров в корзине до: '.count($otapilib->GetBasket($sid));

if($order_id){
    
    $r = $otapilib->RecreateSalesOrder($sid, $order_id, $weight);
    
    if(!$r){
        echo '<br/>Не получилось сделать дозаказ к заказу ' . $order_id . '. Ошибка: ' . $otapilib->error_message;
    } else {
        echo '<br/>Дозаказ к заказу ' . $order_id . ' успешно создан ';
    }
} else {
    echo 'Невозможно создать дозаказ!';
}
echo '<br/>Количество товаров в корзине после: '.count($otapilib->GetBasket($sid));

?>

</body>
</html>	