<?php
if(file_exists('/home/user1167996/www/muravey.by/bitrix/php_interface/dbconn.php'))
{
	require suffix . '/bitrix/php_interface/dbconn.php';
}

$dsn 		= "mysql:host=$DBHost;dbname=$DBName;charset=utf8";
$opt 		= array(
						PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
						PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
				   );
$db 		= new PDO($dsn, $DBLogin, $DBPassword, $opt);
$db->exec('SET NAMES utf8');

?>