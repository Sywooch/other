<?php
//SESSION_START();
require_once "/home/users2/b/bohatko/domains/bettsoft.com/joomla.php";
$user = JFactory::getUser(); 
if ($user->guest) {
//если пользователь оказалс€ неавторизован
exit();

} 
else{
$_ids=$user->id;
} 


//установка/изменение номера телефона дл€ отправки —ћ—

mysql_connect("localhost", "045806063_web", "Admin123");
mysql_select_db("bohatko_web");


$irs_from=$_POST['irs_from']; //час
$irs_to=$_POST['irs_to']; // час
$irs_from2=$_POST['irs_from2']; //день
$irs_to2=$_POST['irs_to2']; //день
$irs_single=$_POST['irs_single']; // секунда
$user_id=$_POST['user_id']; 



//проверка: оплатил ли пользователь подписку
					$y2 = mysql_query("SELECT * FROM `uxsg3_users_podpiska` WHERE `id_user` = '".$_ids."'");
													$f2 = mysql_fetch_assoc($y2);
													$user_date=$f2['date'];//год-мес€ц-день
													$user_time=$f2['time'];
													
													
													//$user_date="2014-10-29";
													//$user_time="24:44:00";
													if(($user_date=="0000-00-00")&&($user_time=="00:00:00")){
													//подписка не оплачена
													//echo "width: 100%";
													echo"0";
													exit;
													}else{
													//подписка когда-то была оплачена, надо проверить, сколько ещЄ осталось.
													//вычисление сегодн€шних даты и времени.
													$timestamp_today = time();
													$tmp_time=$user_date."T".$user_time;
													$timestamp_user = strtotime($tmp_time);
													
													$timestamp_user = intval($timestamp_user); 
													$timestamp_today = intval($timestamp_today);
													
														if ($timestamp_today && $timestamp_user)  {
														$time_lapse = $timestamp_today - $timestamp_user;
														}
														
														$diff_hours=$time_lapse/3600;//разница в часах 
														//между сегодн€шним днЄм и датой последней оплаты подписки
														$diff_hours=round($diff_hours); 
														
													//в 30 сутках 720 часов.
													$progress_rodp=($diff_hours*100)/720;
													$progress_rodp=round($progress_rodp, 2); 
													//echo $progress_rodp."%";
													
													if($progress_rodp<100){


$y = mysql_query("SELECT * FROM `uxsg3_users_date_time_sms` WHERE `user_id` = '".$user_id."'");
$t = mysql_num_rows($y);

if($t == 0){//вставка
mysql_query("INSERT INTO `uxsg3_users_date_time_sms` (`irs_from`, `irs_to`, `irs_from2`, `irs_to2`, `irs_single`, `user_id` ) VALUES ('".$irs_from."','".$irs_to."','".$irs_from2."','".$irs_to2."','".$irs_single."','".$user_id."')");	

}else{//обновление
mysql_query("UPDATE `uxsg3_users_date_time_sms` SET `irs_from`='".$irs_from."', `irs_to`='".$irs_to."', `irs_from2`='".$irs_from2."', `irs_to2`='".$irs_to2."', `irs_single`='".$irs_single."' WHERE `user_id` = '".$user_id."' ");	

}

													
													echo "1";
													exit;
													}else{
													echo"0";
													exit;													
													}
													
													
													
													}

								

/*
$y = mysql_query("SELECT * FROM `uxsg3_users` WHERE `username` = '".$_REQUEST['id1']."' AND `password` = '".md5($_REQUEST['id2'])."'");
$t = mysql_num_rows($y);
if($t == 1){
$f = mysql_fetch_assoc($y);
$_SESSION['ids'] = $f[id];
//$fil = file("a2.php");
//$aa1 = $fil[0].$fil[1].$fil[2].$fil[3].$fil[4].$fil[5].$fil[6].$fil[7].$fil[8].$fil[9].$fil[10].$fil[11].$fil[12];
include "a2.php";
   $id1 = trim($_REQUEST['id1']);
   $id1 = strip_tags($id1);
   $id1 = htmlspecialchars($id1);
   $id1 = stripslashes($id1);
   $id2 = trim($_REQUEST['id2']);
   $id2 = strip_tags($id2);
   $id2 = htmlspecialchars($id2);
   $id2 = stripslashes($id2);



?>
<meta http-equiv="refresh" content="0; URL=http://bettsoft.com/account/pages/UI/timeline.html">
<?php
} else {echo 'No validate login OR password'; }


*/
?>
