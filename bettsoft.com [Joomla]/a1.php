<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.8.1/jquery.min.js"></script>
<?php
mysql_connect("localhost", "045806063_web", "Admin123");
mysql_select_db("bohatko_web");

$y = mysql_query("SELECT * FROM `uxsg3_users` WHERE `username` = '".$_REQUEST['id4']."' OR `email` = '".$_REQUEST['id2']."'");
$t = mysql_num_rows($y);
if($t ==0){
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
   $id3 = trim($_REQUEST['id3']);
   $id3 = strip_tags($id3);
   $id3 = htmlspecialchars($id3);
   $id3 = stripslashes($id3);
   $id4 = trim($_REQUEST['id4']);
   $id4 = strip_tags($id4);
   $id4 = htmlspecialchars($id4);
   $id4 = stripslashes($id4);
   $id5 = trim($_REQUEST['id5']);
   $id5 = strip_tags($id5);
   $id6 = htmlspecialchars($id5);
   $id5 = stripslashes($id5);
   $id6 = trim($_REQUEST['id6']);
   $id6 = strip_tags($id6);
   $id6 = htmlspecialchars($id6);
   $id6 = stripslashes($id6);
$a = date( "y-m-d H:i" );
//uxsg3_user_usergroup_map
   mysql_query("INSERT INTO `uxsg3_users` (`name`, `username`, `email`, `password`, `registerDate`, `params`, `phone`) VALUES ('".iconv("utf-8", "windows-1251", $_REQUEST['id1'])."','".iconv("utf-8", "windows-1251", $_REQUEST['id4'])."','".$_REQUEST['id2']."','".md5($_REQUEST['id5'])."','".$a."','{}','".$_REQUEST['id3']."')");
$y = mysql_query("SELECT * FROM `uxsg3_users` WHERE `username` = '".$_REQUEST['id4']."'");
$f = mysql_fetch_assoc($y);  
//$aa1


mail($_REQUEST['id2'], "Регистрация", $aa1,  "From: ivan@example.com\r\n" 
             ."Content-type: text/html; charset=utf-8\r\n"
             ."X-Mailer: PHP mail script");
mysql_query("INSERT INTO `uxsg3_user_usergroup_map` (`user_id`, `group_id`) VALUES ('".$f[id]."', '2')"); 

//добавление записи в _users_podpiska, таблицу, в которой хранятся данные о подписках пользователей.
$user_id=$f[id];
mysql_query("INSERT INTO `uxsg3_users_podpiska` (`id_user`, `date`, `time`) VALUES ('".$user_id."', '0000-00-00', '00:00:00')"); 

?>
<meta http-equiv="refresh" content="0; URL=blank.html">
<?php
} else {
echo 'login zan9t';
}
?>
