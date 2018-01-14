<? 
$mysqli = new mysqli('mysql89.1gb.ru', 'gb_shop_d', '8cb25a97345', 'gb_shop_d');
if ($mysqli->connect_error) {
    die('Connect Error (' . $mysqli->connect_errno . ') ' . $mysqli->connect_error);
}
?>