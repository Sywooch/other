<?php
session_start();
header('Content-type: text/html; charset=utf-8');
require '../config/config.php';

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Результаты поиска - Мои клиенты</title>



</head>

<body style="background-color:blue; color:white">
<?php
echo"<span style=\"position:absolute; background-color:black\">Вы вошли как: <strong>".$_SESSION['user']."</strong></span>";


?>
<div align="center" style="width:100%; color:white; font-family:Arial, Helvetica, sans-serif">
<div align="center" style="width:1100px; min-height:100px; padding:10px; border:2px white solid">

<div align="center" style="width:990px; height:40px; padding:5px; border:1px white solid; font-size:15pt">
<span>Результаты поиска: Мои клиенты</span>
</div>
<div align="center" style="width:990px;  border:1px white solid; border-top:0px; font-size:15pt;  padding:5px">

<table style="width:980px; font-size:11pt">
<tr>
<td style="background-color:#3637ea; width:20px; padding:2px">ID</td>
<td style="background-color:#3637ea; width:130px; padding:2px">Клиент</td>
<td style="background-color:#3637ea; width:130px; padding:2px">Отрасль</td>
<td style="background-color:#3637ea; width:130px; padding:2px">Лояльность</td>
<td style="background-color:#3637ea; width:130px; padding:2px">Телефон</td>
<td style="background-color:#3637ea; width:130px; padding:2px">E-mail</td>
<td style="background-color:#3637ea; width:130px; padding:2px">Контакт</td>
<td style="background-color:#3637ea; width:20px; padding:2px">ID контакта</td>
</tr>

<?php
$title=$_POST['title'];
if(!isset($_POST['Checkbox1'])&&!isset($_POST['Checkbox2'])&&
!isset($_POST['Checkbox3'])&&!isset($_POST['Checkbox4'])&&
!isset($_POST['Checkbox5'])&&!isset($_POST['Checkbox6'])){echo'Ошибка! Необходимо выбрать хотя бы одну область поиска.'; die;}


$dbh=mysql_connect(DB_SERVER,DB_USER,DB_PASS) or die ("Невозможно соединиться с сервером.");
mysql_select_db(DB_BASE) or die ("Невозможно подключиться к базе.");

$query="SELECT * FROM qdfmain WHERE User='".$_SESSION['user']."' ORDER BY Client";




$res=mysql_query($query);
					if($res==false){
	    			echo"Ошибка выполнения запроса.</br>";
					echo mysql_error();
					exit; }

 while($row=mysql_fetch_array($res)){
 /////////
 if(isset($_POST['Checkbox1'])){
 
$pos=stripos($row['Client'],$title); 
 if($pos===false){}
 else{
 $s_len=strlen($title);
 //echo"".$s_len."</br>";
 $sub=substr($row['Client'],$pos,$s_len);
 //echo"".$sub."</br>";
 $sub1=substr($row['Client'],0,$pos);
 // echo"".$sub1."</br>";
 $sub2=substr($row['Client'],($pos+$s_len));
 // echo"".$sub2."</br>";
 
 echo'<tr>
<td style="background-color:#3637ea; width:20px; padding:2px">'.$row['ID'].'</td>
<td style="background-color:#3637ea; width:130px; padding:2px">'.$sub1.'<span style="background-color:yellow; color:blue">'.$sub.'</span>'.$sub2.'</td>
<td style="background-color:#3637ea; width:130px; padding:2px">'.$row['Industry'].'</td>
<td style="background-color:#3637ea; width:130px; padding:2px">'.$row['Loyalty'].'</td>
<td style="background-color:#3637ea; width:130px; padding:2px">'.$row['Phone'].'</td>
<td style="background-color:#3637ea; width:130px; padding:2px">'.$row['Email'].'</td>
<td style="background-color:#3637ea; width:130px; padding:2px">'.$row['Contacts'].'</td>
<td style="background-color:#3637ea; width:20px; padding:2px">'.$row['ID_Contacts'].'</td>
</tr>';
continue;
 }
 
 
 }//isset($_POST['Checkbox1'])
 
 ///////
  if(isset($_POST['Checkbox2'])){
 
$pos=stripos($row['Industry'],$title); 
 if($pos===false){}
 else{
 $s_len=strlen($title);
 $sub=substr($row['Industry'],$pos,$s_len);
 $sub1=substr($row['Industry'],0,$pos);
 $sub2=substr($row['Industry'],($pos+$s_len));
 
 echo'<tr>
<td style="background-color:#3637ea; width:20px; padding:2px">'.$row['ID'].'</td>
<td style="background-color:#3637ea; width:130px; padding:2px">'.$row['Client'].'</td>
<td style="background-color:#3637ea; width:130px; padding:2px">'.$sub1.'<span style="background-color:yellow; color:blue">'.$sub.'</span>'.$sub2.'</td>
<td style="background-color:#3637ea; width:130px; padding:2px">'.$row['Loyalty'].'</td>
<td style="background-color:#3637ea; width:130px; padding:2px">'.$row['Phone'].'</td>
<td style="background-color:#3637ea; width:130px; padding:2px">'.$row['Email'].'</td>
<td style="background-color:#3637ea; width:130px; padding:2px">'.$row['Contacts'].'</td>
<td style="background-color:#3637ea; width:20px; padding:2px">'.$row['ID_Contacts'].'</td>
</tr>';
continue;
 }
 
 
 }//isset($_POST['Checkbox2'])
 ////////
  ///////
  if(isset($_POST['Checkbox3'])){
 
$pos=stripos($row['Loyalty'],$title); 
 if($pos===false){}
 else{
 $s_len=strlen($title);
 $sub=substr($row['Loyalty'],$pos,$s_len);
 $sub1=substr($row['Loyalty'],0,$pos);
 $sub2=substr($row['Loyalty'],($pos+$s_len));
 
 echo'<tr>
<td style="background-color:#3637ea; width:20px; padding:2px">'.$row['ID'].'</td>
<td style="background-color:#3637ea; width:130px; padding:2px">'.$row['Client'].'</td>
<td style="background-color:#3637ea; width:130px; padding:2px">'.$row['Industry'].'</td>
<td style="background-color:#3637ea; width:130px; padding:2px">'.$sub1.'<span style="background-color:yellow; color:blue">'.$sub.'</span>'.$sub2.'</td>
<td style="background-color:#3637ea; width:130px; padding:2px">'.$row['Phone'].'</td>
<td style="background-color:#3637ea; width:130px; padding:2px">'.$row['Email'].'</td>
<td style="background-color:#3637ea; width:130px; padding:2px">'.$row['Contacts'].'</td>
<td style="background-color:#3637ea; width:20px; padding:2px">'.$row['ID_Contacts'].'</td>
</tr>';
continue;
 }
 
 
 }//isset($_POST['Checkbox3'])
 ////////
  ///////
  if(isset($_POST['Checkbox4'])){
 
$pos=stripos($row['Phone'],$title); 
 if($pos===false){}
 else{
 $s_len=strlen($title);
 $sub=substr($row['Phone'],$pos,$s_len);
 $sub1=substr($row['Phone'],0,$pos);
 $sub2=substr($row['Phone'],($pos+$s_len));
 
 echo'<tr>
<td style="background-color:#3637ea; width:20px; padding:2px">'.$row['ID'].'</td>
<td style="background-color:#3637ea; width:130px; padding:2px">'.$row['Client'].'</td>
<td style="background-color:#3637ea; width:130px; padding:2px">'.$row['Industry'].'</td>
<td style="background-color:#3637ea; width:130px; padding:2px">'.$row['Loyalty'].'</td>
<td style="background-color:#3637ea; width:130px; padding:2px">'.$sub1.'<span style="background-color:yellow; color:blue">'.$sub.'</span>'.$sub2.'</td>
<td style="background-color:#3637ea; width:130px; padding:2px">'.$row['Email'].'</td>
<td style="background-color:#3637ea; width:130px; padding:2px">'.$row['Contacts'].'</td>
<td style="background-color:#3637ea; width:20px; padding:2px">'.$row['ID_Contacts'].'</td>
</tr>';
continue;
 }
 
 
 }//isset($_POST['Checkbox4'])
 ////////
   ///////
  if(isset($_POST['Checkbox5'])){
 
$pos=stripos($row['Email'],$title); 
 if($pos===false){}
 else{
 $s_len=strlen($title);
 $sub=substr($row['Email'],$pos,$s_len);
 $sub1=substr($row['Email'],0,$pos);
 $sub2=substr($row['Email'],($pos+$s_len));
 
 echo'<tr>
<td style="background-color:#3637ea; width:20px; padding:2px">'.$row['ID'].'</td>
<td style="background-color:#3637ea; width:130px; padding:2px">'.$row['Client'].'</td>
<td style="background-color:#3637ea; width:130px; padding:2px">'.$row['Industry'].'</td>
<td style="background-color:#3637ea; width:130px; padding:2px">'.$row['Loyalty'].'</td>
<td style="background-color:#3637ea; width:130px; padding:2px">'.$row['Phone'].'</td>
<td style="background-color:#3637ea; width:130px; padding:2px">'.$sub1.'<span style="background-color:yellow; color:blue">'.$sub.'</span>'.$sub2.'</td>
<td style="background-color:#3637ea; width:130px; padding:2px">'.$row['Contacts'].'</td>
<td style="background-color:#3637ea; width:20px; padding:2px">'.$row['ID_Contacts'].'</td>
</tr>';
continue;
 }
 
 
 }//isset($_POST['Checkbox5'])
 ////////
    ///////
  if(isset($_POST['Checkbox6'])){
 
$pos=stripos($row['Contacts'],$title); 
 if($pos===false){}
 else{
 $s_len=strlen($title);
 $sub=substr($row['Contacts'],$pos,$s_len);
 $sub1=substr($row['Contacts'],0,$pos);
 $sub2=substr($row['Contacts'],($pos+$s_len));
 
 echo'<tr>
<td style="background-color:#3637ea; width:20px; padding:2px">'.$row['ID'].'</td>
<td style="background-color:#3637ea; width:130px; padding:2px">'.$row['Client'].'</td>
<td style="background-color:#3637ea; width:130px; padding:2px">'.$row['Industry'].'</td>
<td style="background-color:#3637ea; width:130px; padding:2px">'.$row['Loyalty'].'</td>
<td style="background-color:#3637ea; width:130px; padding:2px">'.$row['Phone'].'</td>
<td style="background-color:#3637ea; width:130px; padding:2px">'.$row['Email'].'</td>
<td style="background-color:#3637ea; width:130px; padding:2px">'.$sub1.'<span style="background-color:yellow; color:blue">'.$sub.'</span>'.$sub2.'</td>
<td style="background-color:#3637ea; width:20px; padding:2px">'.$row['ID_Contacts'].'</td>
</tr>';
continue;
 }
 
 
 }//isset($_POST['Checkbox6'])
 ////////
 
 
 
 }

?>


</table>



</div>


<?php
echo'<table border="0" width="90%" cellpadding="5" align="center">





</table>';
?>

<a href="../my_clients.php"><input type="button" value="Назад" style="height:40px; width:100px; cursor:pointer; margin-top:20px" /></a>

</div>


</div>
</body>

</html>
