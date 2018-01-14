<?php
session_start();
header('Content-type: text/html; charset=utf-8');
require '../config/config.php';

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Результаты поиска - Все организации</title>



</head>

<body style="background-color:blue; color:white; overflow-x:hidden">
<?php
echo"<span style=\"position:absolute; background-color:black\">Вы вошли как: <strong>".$_SESSION['user']."</strong></span>";


?>
<div align="center" style="width:100%; color:white; font-family:Arial, Helvetica, sans-serif">
<div align="center" style="width:1300px; min-height:100px; padding:10px; border:2px white solid">

<div align="center" style="width:1200px; height:40px; padding:5px; border:1px white solid; font-size:15pt">
<span>Результаты поиска: Все организации</span>
</div>
<div align="center" style="width:1200px;  border:1px white solid; border-top:0px; font-size:15pt;  padding:5px">

<table style="width:1100px; font-size:11pt">
<tr>
 <td style="background-color:#3637ea; width:50px; padding:2px"></td>
<td style="background-color:#3637ea; width:50px; padding:2px">ID</td>
<td style="background-color:#3637ea; width:140px; padding:2px">Организация</td>
<td style="background-color:#3637ea; width:132px; padding:2px">Отрасль</td>
<td style="background-color:#3637ea; width:132px; padding:2px">Телефон</td>
<td style="background-color:#3637ea; width:132px; padding:2px">Сайт</td>
<td style="background-color:#3637ea; width:132px; padding:2px">E-mail</td>
<td style="background-color:#3637ea; width:122px; padding:2px">Адрес</td>
<td style="background-color:#3637ea; width:142px; padding:2px">Категории</td>
</tr>

<?php
$title=$_POST['title'];
if(!isset($_POST['Checkbox1'])&&!isset($_POST['Checkbox2'])&&
!isset($_POST['Checkbox3'])&&!isset($_POST['Checkbox4'])&&
!isset($_POST['Checkbox5'])&&!isset($_POST['Checkbox6'])&&!isset($_POST['Checkbox7'])){echo'Ошибка! Необходимо выбрать хотя бы одну область поиска.'; die;}

///echo"".$title."</br>";

$dbh=mysql_connect(DB_SERVER,DB_USER,DB_PASS) or die ("Невозможно соединиться с сервером.");
mysql_select_db(DB_BASE) or die ("Невозможно подключиться к базе.");
mysql_query("set character_set_results='utf8'");
			mysql_query("SET NAMES utf8");
mysql_query ("SET COLLATION_CONNECTION=utf8");
mysql_query("SET CHARACTER_SET_CLIENT=utf8");
mysql_query("SET CHARACTER_SET_RESULTS=utf8");


$query="SELECT * FROM big_table ORDER BY ID";




$res=mysql_query($query);
					if($res==false){
	    			echo"Ошибка выполнения запроса.</br>";
					echo mysql_error();
					exit; }

 while($row=mysql_fetch_array($res)){
 /////////
 if(isset($_POST['Checkbox1'])){
 
$pos=stripos($row['A'],$title); 
 if($pos===false){}
 else{
 $s_len=strlen($title);
 //echo"".$s_len."</br>";
 $sub=substr($row['A'],$pos,$s_len);
 //echo"".$sub."</br>";
 $sub1=substr($row['A'],0,$pos);
 // echo"".$sub1."</br>";
 $sub2=substr($row['A'],($pos+$s_len));
 // echo"".$sub2."</br>";
 
 
 //.$sub1.'<span style="background-color:yellow; color:blue">'.$sub.'</span>'.$sub2.'
 echo'<tr>
 <td style="background-color:#3637ea; width:50px; padding:2px"></td>
<td style="background-color:#3637ea;max-width:50px; width:50px;overflow:hidden; padding:2px">'.$row['ID'].'</td>
<td style="background-color:#3637ea;max-width:140px; width:140px;overflow:hidden; 
padding:2px">'.$sub1.'<span style="background-color:yellow; color:blue">'.$sub.'</span>'.$sub2.'</td>
<td style="background-color:#3637ea;max-width:132px; width:132px;overflow:hidden; padding:2px">'.$row['B'].'</td>
<td style="background-color:#3637ea;max-width:132px; width:132px;overflow:hidden; padding:2px">'.$row['C'].'</td>
<td style="background-color:#3637ea;max-width:132px; width:132px;overflow:hidden; padding:2px">'.$row['D'].'</td>
<td style="background-color:#3637ea;max-width:132px; width:132px;overflow:hidden; padding:2px">'.$row['E'].'</td>
<td style="background-color:#3637ea;max-width:122px; width:122px;overflow:hidden; padding:2px">'.$row['F'].'</td>
<td style="background-color:#3637ea;max-width:142px; width:142px;overflow:hidden; padding:2px">'.$row['G'].'</td>
</tr>';
continue;
 }
 
 
 }//isset($_POST['Checkbox1'])
 
 ///////
  if(isset($_POST['Checkbox2'])){
 
$pos=stripos($row['B'],$title); 
 if($pos===false){}
 else{
 $s_len=strlen($title);
 $sub=substr($row['B'],$pos,$s_len);
 $sub1=substr($row['B'],0,$pos);
 $sub2=substr($row['B'],($pos+$s_len));
 
 echo'<tr>
 <td style="background-color:#3637ea; width:50px; padding:2px"></td>
<td style="background-color:#3637ea; width:50px; padding:2px">'.$row['ID'].'</td>
<td style="background-color:#3637ea; width:140px; padding:2px">'.$row['A'].'</td>
<td style="background-color:#3637ea; width:132px; padding:2px">'.$sub1.'<span style="background-color:yellow; color:blue">'.$sub.'</span>'.$sub2.'</td>
<td style="background-color:#3637ea; width:132px; padding:2px">'.$row['C'].'</td>
<td style="background-color:#3637ea; width:132px; padding:2px">'.$row['D'].'</td>
<td style="background-color:#3637ea; width:132px; padding:2px">'.$row['E'].'</td>
<td style="background-color:#3637ea; width:122px; padding:2px">'.$row['F'].'</td>
<td style="background-color:#3637ea; width:142px; padding:2px">'.$row['G'].'</td>
</tr>';
continue;
 }
 
 
 }//isset($_POST['Checkbox2'])
 ////////
  ///////
  if(isset($_POST['Checkbox3'])){
 
$pos=stripos($row['C'],$title); 
 if($pos===false){}
 else{
 $s_len=strlen($title);
 $sub=substr($row['C'],$pos,$s_len);
 $sub1=substr($row['C'],0,$pos);
 $sub2=substr($row['C'],($pos+$s_len));
 
 echo'<tr>
 <td style="background-color:#3637ea; width:50px; padding:2px"></td>
<td style="background-color:#3637ea; width:50px; padding:2px">'.$row['ID'].'</td>
<td style="background-color:#3637ea; width:140px; padding:2px">'.$row['A'].'</td>
<td style="background-color:#3637ea; width:132px; padding:2px">'.$row['B'].'</td>
<td style="background-color:#3637ea; width:132px; padding:2px">'.$sub1.'<span style="background-color:yellow; color:blue">'.$sub.'</span>'.$sub2.'</td>
<td style="background-color:#3637ea; width:132px; padding:2px">'.$row['D'].'</td>
<td style="background-color:#3637ea; width:132px; padding:2px">'.$row['E'].'</td>
<td style="background-color:#3637ea; width:122px; padding:2px">'.$row['F'].'</td>
<td style="background-color:#3637ea; width:142px; padding:2px">'.$row['G'].'</td>
</tr>';
continue;
 }
 
 
 }//isset($_POST['Checkbox3'])
 ////////
  ///////
  if(isset($_POST['Checkbox4'])){
 
$pos=stripos($row['D'],$title); 
 if($pos===false){}
 else{
 $s_len=strlen($title);
 $sub=substr($row['D'],$pos,$s_len);
 $sub1=substr($row['D'],0,$pos);
 $sub2=substr($row['D'],($pos+$s_len));
 
 echo'<tr>
 <td style="background-color:#3637ea; width:50px; padding:2px"></td>
<td style="background-color:#3637ea; width:50px; padding:2px">'.$row['ID'].'</td>
<td style="background-color:#3637ea; width:140px; padding:2px">'.$row['A'].'</td>
<td style="background-color:#3637ea; width:132px; padding:2px">'.$row['B'].'</td>
<td style="background-color:#3637ea; width:132px; padding:2px">'.$row['C'].'</td>
<td style="background-color:#3637ea; width:132px; padding:2px">'.$sub1.'<span style="background-color:yellow; color:blue">'.$sub.'</span>'.$sub2.'</td>
<td style="background-color:#3637ea; width:132px; padding:2px">'.$row['E'].'</td>
<td style="background-color:#3637ea; width:122px; padding:2px">'.$row['F'].'</td>
<td style="background-color:#3637ea; width:142px; padding:2px">'.$row['G'].'</td>
</tr>';
continue;
 }
 
 
 }//isset($_POST['Checkbox4'])
 ////////
   ///////
  if(isset($_POST['Checkbox5'])){
 
$pos=stripos($row['E'],$title); 
 if($pos===false){}
 else{
 $s_len=strlen($title);
 $sub=substr($row['E'],$pos,$s_len);
 $sub1=substr($row['E'],0,$pos);
 $sub2=substr($row['E'],($pos+$s_len));
 
 echo'<tr>
 <td style="background-color:#3637ea; width:50px; padding:2px"></td>
<td style="background-color:#3637ea; width:50px; padding:2px">'.$row['ID'].'</td>
<td style="background-color:#3637ea; width:140px; padding:2px">'.$row['A'].'</td>
<td style="background-color:#3637ea; width:132px; padding:2px">'.$row['B'].'</td>
<td style="background-color:#3637ea; width:132px; padding:2px">'.$row['C'].'</td>
<td style="background-color:#3637ea; width:132px; padding:2px">'.$row['D'].'</td>
<td style="background-color:#3637ea; width:132px; padding:2px">'.$sub1.'<span style="background-color:yellow; color:blue">'.$sub.'</span>'.$sub2.'</td>
<td style="background-color:#3637ea; width:122px; padding:2px">'.$row['F'].'</td>
<td style="background-color:#3637ea; width:142px; padding:2px">'.$row['G'].'</td>
</tr>';
continue;
 }
 
 
 }//isset($_POST['Checkbox5'])
 ////////
    ///////
  if(isset($_POST['Checkbox6'])){
 
$pos=stripos($row['F'],$title); 
 if($pos===false){}
 else{
 $s_len=strlen($title);
 $sub=substr($row['F'],$pos,$s_len);
 $sub1=substr($row['F'],0,$pos);
 $sub2=substr($row['F'],($pos+$s_len));
 
 echo'<tr>
 <td style="background-color:#3637ea; width:50px; padding:2px"></td>
<td style="background-color:#3637ea; width:50px; padding:2px">'.$row['ID'].'</td>
<td style="background-color:#3637ea; width:140px; padding:2px">'.$row['A'].'</td>
<td style="background-color:#3637ea; width:132px; padding:2px">'.$row['B'].'</td>
<td style="background-color:#3637ea; width:132px; padding:2px">'.$row['C'].'</td>
<td style="background-color:#3637ea; width:132px; padding:2px">'.$row['D'].'</td>
<td style="background-color:#3637ea; width:132px; padding:2px">'.$row['E'].'</td>
<td style="background-color:#3637ea; width:122px; padding:2px">'.$sub1.'<span style="background-color:yellow; color:blue">'.$sub.'</span>'.$sub2.'</td>
<td style="background-color:#3637ea; width:142px; padding:2px">'.$row['G'].'</td>
</tr>';
 continue;
 }
 
 //

 }//isset($_POST['Checkbox6'])
 ////////
  if(isset($_POST['Checkbox7'])){
 
$pos=stripos($row['G'],$title); 
 if($pos===false){}
 else{
 $s_len=strlen($title);
 $sub=substr($row['G'],$pos,$s_len);
 $sub1=substr($row['G'],0,$pos);
 $sub2=substr($row['G'],($pos+$s_len));
 
 echo'<tr>
 <td style="background-color:#3637ea; width:50px; padding:2px"></td>
<td style="background-color:#3637ea; width:50px; padding:2px">'.$row['ID'].'</td>
<td style="background-color:#3637ea; width:140px; padding:2px">'.$row['A'].'</td>
<td style="background-color:#3637ea; width:132px; padding:2px">'.$row['B'].'</td>
<td style="background-color:#3637ea; width:132px; padding:2px">'.$row['C'].'</td>
<td style="background-color:#3637ea; width:132px; padding:2px">'.$row['D'].'</td>
<td style="background-color:#3637ea; width:132px; padding:2px">'.$row['E'].'</td>
<td style="background-color:#3637ea; width:122px; padding:2px">'.$row['F'].'</td>
<td style="background-color:#3637ea; width:142px; padding:2px">'.$sub1.'<span style="background-color:yellow; color:blue">'.$sub.'</span>'.$sub2.'</td>
</tr>';
 continue;
 }
 
 //

 }//isset($_POST['Checkbox7'])
 
 
 
 }//конец цикла

?>


</table>



</div>


<?php
echo'<table border="0" width="90%" cellpadding="5" align="center">





</table>';
?>

<a href="../organisations.php"><input type="button" value="Назад" style="height:40px; width:100px; cursor:pointer; margin-top:20px" /></a>

</div>


</div>
</body>

</html>
