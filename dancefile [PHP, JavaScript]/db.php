<? 
$mysqli = new mysqli('mysql90.1gb.ru', 'gb_reg_dance', 'e67e4zc82yui', 'gb_reg_dance');
if ($mysqli->connect_error) {
    die('Connect Error (' . $mysqli->connect_errno . ') ' . $mysqli->connect_error);
}
?>