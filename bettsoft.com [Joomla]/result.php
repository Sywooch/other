<?php
header('Content-type: text/html; charset=utf-8');
//SESSION_START();
mysql_connect("localhost", "045806063_web", "Admin123");
mysql_select_db("bohatko_web");
require_once "/home/users2/b/bohatko/domains/bettsoft.com/joomla.php";
//$user = JFactory::getUser(); 
//if ($user->guest) {
//перенаправление на страницу авторизации
//echo'
//<script type="text/javascript"> //
//  window.location.href = "/account/pages/examples/login.html"
//</script>
//';
//exit();
//} else{
//$_ids=$user->id;
//} 

$AMOUNT=$_GET['AMOUNT'];
$SIGN=$_GET['SIGN'];
$MERCHANT_ORDER_ID=$_GET['MERCHANT_ORDER_ID'];
$P_EMAIL=$_GET['P_EMAIL'];
$CUR_ID=$_GET['CUR_ID'];

mysql_query("INSERT INTO `uxsg3_pay` (`AMOUNT`, `SIGN`, `MERCHANT_ORDER_ID`, `P_EMAIL`, `CUR_ID` ) VALUES ('".$AMOUNT."','".$SIGN."','".$MERCHANT_ORDER_ID."','".$P_EMAIL."','".$CUR_ID."')");	

//вычисление сегодняшних даты и времени.

$date_pay=date("Y-m-d");
$time_pay=date("H:i:s");

$y1 = mysql_query("SELECT * FROM `uxsg3_users` WHERE `email` = '".$P_EMAIL."'");
$f1 = mysql_fetch_assoc($y1);
$user_id=$f1['id'];

$y2 = mysql_query("SELECT * FROM `uxsg3_users_podpiska` WHERE `id_user` = '".$user_id."'");
$t2 = mysql_num_rows($y2);

if($t2 == 0){//вставка
mysql_query("INSERT INTO `uxsg3_users_podpiska` (`id_user`, `date`, `time` ) VALUES ('".$user_id."','".$date_pay."','".$time_pay."')");	

}else{//обновление
mysql_query("UPDATE `uxsg3_users_podpiska` SET `date`='".$date_pay."', `time`='".$time_pay."' WHERE `id_user` = '".$user_id."' ");	

}


mysql_query("INSERT INTO `uxsg3_users_financial_operations` (`user_id`, `operation`, `desc`, `sum`, `date`, `time` ) VALUES ('".$user_id."','Оплата подписки','Оплата подписки на месяц','50$','".$date_pay."','".$time_pay."')");	


?>

