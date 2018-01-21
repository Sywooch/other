<?php
SESSION_START();
?>
<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.8.1/jquery.min.js"></script>
<?php
mysql_connect("localhost", "045806063_web", "Admin123");
mysql_select_db("bohatko_web");

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
?>
