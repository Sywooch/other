<?php
session_start();
header('Content-type: text/html; charset=utf-8');
 require 'config/config.php';
 if(!isset($_SESSION['user'])||($_SESSION['user']==NULL)||($_SESSION['user']=="")){
$x="login";
header('Location: '.$x.".php");//перенаправление на форму авторизации.
 }
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Учёт клиентов</title>

<script type="text/javascript" src="js/jquery.min.js"></script>

<script type="text/javascript">
function f_show(){
$("#f").show(2000);
}
function f_steals2(){
$("#f").hide(2000);
}

function action(t){
var t2=("actions2.php?id_action="+t);

window.location.href=t2;

}
</script>

<script type="text/javascript">
function f_show3(){
$("#f3").show(2000);
}

function f_steals(){
$("#f3").hide(2000);
}
</script>

</head>

<body style="background-color:blue; color:white;overflow-x:hidden ">
<?php
echo"<span style=\"position:absolute; background-color:black\">Вы вошли как: <strong>".$_SESSION['user']."</strong></span>";


?>
<div align="center" style="width:100%; color:white; font-family:Arial, Helvetica, sans-serif">
<div align="center" style="width:1300px; min-height:100px; padding:10px; border:2px white solid">

<div align="center" style="width:1200px; height:40px; padding:5px; border:1px white solid; font-size:15pt">
<span>Все организации - фильтр по отраслям</span>
</div>
<div align="center" style="width:1200px;  border:1px white solid; border-top:0px; font-size:15pt;  padding:5px">

<table style="width:1100px; font-size:11pt">

<!--
<tr>

<td colspan="9">

<?php
//echo'
//Сортировка: 
//<select name="sort" style="width:200px;margin-left:3px;background-color:#FFFF99" 
//onChange="if(';
//echo"this.options[this.selectedIndex].value!=''){window.location=this.options[this.selectedIndex].value}";
//echo'else{this.options[selectedIndex=0];}">
//<option value="organisations.php?sort=1"'; if($_GET['sort']==1){echo' selected';} echo'>"ID" - возрастание</option>
//<option value="organisations.php?sort=2"'; if($_GET['sort']==2){echo' selected';} echo'>"ID" - убывание</option>
//<option value="organisations.php?sort=3"'; if($_GET['sort']==3){echo' selected';} echo'>"Организация" - возрастание</option>
//<option value="organisations.php?sort=4"'; if($_GET['sort']==4){echo' selected';} echo'>"Организация" - убывание</option>
//<option value="organisations.php?sort=5"'; if($_GET['sort']==5){echo' selected';} echo'>"Отрасль" - возрастание</option>
//<option value="organisations.php?sort=6"'; if($_GET['sort']==6){echo' selected';} echo'>"Отрасль" - убывание</option>
//<option value="organisations.php?sort=7"'; if($_GET['sort']==7){echo' selected';} echo'>"Адрес" - возрастание</option>
//<option value="organisations.php?sort=8"'; if($_GET['sort']==8){echo' selected';} echo'>"Адрес" - убывание</option>';
?>
</select></td></tr>-->

<tr>
<tr>



<tr>

<!-------------------------------->
<!--------------------------------->
<td colspan="9">
<a href="index.php">
<input type="button" value="На главную" style="height:40px; width:100px; cursor:pointer; margin-top:4px; margin-bottom:20px; cursor:pointer" /></a>
<a href="clients.php">
<input type="button" value="Клиенты" style="height:40px; width:100px; cursor:pointer; margin-top:4px; margin-bottom:20px; cursor:pointer" /></a>
<a href="contacts.php">
<input type="button" value="Контакты" style="height:40px; width:100px; cursor:pointer; margin-top:4px; margin-bottom:20px; cursor:pointer" /></a>
<a href="actions.php">
<input type="button" value="События" style="height:40px; width:100px; cursor:pointer; margin-top:4px; margin-bottom:20px; cursor:pointer" /></a>
<a href="organisations.php">
<input type="button" value="Назад" style="height:40px; width:100px; cursor:pointer; margin-top:4px; margin-bottom:20px; cursor:pointer" /></a>

</td>
</tr>
<!-------------------------------->


<tr>
 <td style="background-color:#3637ea; width:50px; padding:2px"></td>
<td style="background-color:#3637ea; width:50px; padding:2px">ID<?php //echo'<select name="sort" style="width:20px;margin-left:3px;background-color:#FFFF99" 
//onChange="if(';
//echo"this.options[this.selectedIndex].value!=''){window.location=this.options[this.selectedIndex].value}";
//echo'else{this.options[selectedIndex=0];}">
//<option value="filter_a.php?sort=1"'; if($_GET['sort']==1){echo' selected';} echo'>"ID" - возрастание</option>
//<option value="filter_a.php?sort=2"'; if($_GET['sort']==2){echo' selected';} echo'>"ID" - убывание</option>';
?>
</select></td>


<td style="background-color:#3637ea; width:140px; padding:2px">Организация<?php //echo'<select name="sort" style="width:20px;margin-left:3px;background-color:#FFFF99" 
//onChange="if(';
//echo"this.options[this.selectedIndex].value!=''){window.location=this.options[this.selectedIndex].value}";
//echo'else{this.options[selectedIndex=0];}">
//<option value="filter_a.php?sort=3"'; if($_GET['sort']==3){echo' selected';} echo'>"Организация" - возрастание</option>
//<option value="filter_a.php?sort=4"'; if($_GET['sort']==4){echo' selected';} echo'>"Организация" - убывание</option>';
?>
</select></td>

<td style="background-color:#3637ea; width:132px; padding:2px">Отрасль<?php //echo'<select name="sort" style="width:20px;margin-left:3px;background-color:#FFFF99" 
//onChange="if(';
//echo"this.options[this.selectedIndex].value!=''){window.location=this.options[this.selectedIndex].value}";
//echo'else{this.options[selectedIndex=0];}">
//<option value="filter_a.php?sort=5"'; if($_GET['sort']==5){echo' selected';} echo'>"Отрасль" - возрастание</option>
//<option value="filter_a.php?sort=6"'; if($_GET['sort']==6){echo' selected';} echo'>"Отрасль" - убывание</option>';
?>
</select></td>

<td style="background-color:#3637ea; width:132px; padding:2px">Телефон</td>
<td style="background-color:#3637ea; width:132px; padding:2px">Сайт</td>
<td style="background-color:#3637ea; width:132px; padding:2px">E-mail</td>
<td style="background-color:#3637ea; width:122px; padding:2px">Адрес<?php //echo'<select name="sort" style="width:20px;margin-left:3px;background-color:#FFFF99" 
//onChange="if(';
//echo"this.options[this.selectedIndex].value!=''){window.location=this.options[this.selectedIndex].value}";
//echo'else{this.options[selectedIndex=0];}">
//<option value="filter_a.php?sort=5"'; if($_GET['sort']==5){echo' selected';} echo'>"Адрес" - возрастание</option>
//<option value="filter_a.php?sort=6"'; if($_GET['sort']==6){echo' selected';} echo'>"Адрес" - убывание</option>';
?>
</select></td>

<td style="background-color:#3637ea; width:142px; padding:2px">Категории</td>


</tr>

<?php

$dbh=mysql_connect(DB_SERVER,DB_USER,DB_PASS) or die ("Невозможно соединиться с сервером.");
mysql_select_db(DB_BASE) or die ("Невозможно подключиться к базе.");
mysql_query("set character_set_results='utf8'");
			mysql_query("SET NAMES utf8");
mysql_query ("SET COLLATION_CONNECTION=utf8");
mysql_query("SET CHARACTER_SET_CLIENT=utf8");
mysql_query("SET CHARACTER_SET_RESULTS=utf8");

if(!isset($_GET['sort'])){

$query="SELECT * FROM big_table ORDER BY ID";
}
else if($_GET['sort']==1){
$query="SELECT * FROM big_table ORDER BY ID";
}
else if($_GET['sort']==2){
$query="SELECT * FROM big_table ORDER BY ID DESC";
}
else if($_GET['sort']==3){
$query="SELECT * FROM big_table ORDER BY A";
}
else if($_GET['sort']==4){
$query="SELECT * FROM big_table ORDER BY A DESC";
}
else if($_GET['sort']==5){
$query="SELECT * FROM big_table ORDER BY B";
}
else if($_GET['sort']==6){
$query="SELECT * FROM big_table ORDER BY B DESC";
}
else if($_GET['sort']==7){
$query="SELECT * FROM big_table ORDER BY F";
}
else if($_GET['sort']==8){
$query="SELECT * FROM big_table ORDER BY F DESC";
}




$res=mysql_query($query);
					if($res==false){
	    			echo"Ошибка выполнения запроса (error1).</br>";
					echo mysql_error();
					exit; }
$count=0;//число организаций
 while($row=mysql_fetch_array($res)){
$i3=0;
$log=0;
while($i3<$_SESSION['i_tmp']){

if($row['B']==$_POST['Checkbox1'.$i3.'']){
$log=1;
}

$i3++;
}
if($log==1){


if(!isset($row['User'])||($row['User']==NULL)||($row['User']=="")){


echo'
<tr>
<td style="background-color:#3637ea; width:40px; padding-top:5px; padding-bottom:5px; padding-right:2px; padding-left:12px; font-size:10pt">
<a href="new_organisation.php?id='.$row['ID'].'" style="color:white"><img src="images/plus.png" alt="Добавить в список клиентов" 
title="Добавить организацию в список пользователя '.$_SESSION['user'].'"/></a>



</td>
<td style="background-color:#3637ea; width:50px;max-width:50px; padding:2px; overflow:hidden;font-size:10pt">'.$row['ID'].'</td>
<td style="background-color:#3637ea; width:140px;max-width:140px; padding:2px; overflow:hidden;font-size:10pt">'.$row['A'].'</td>
<td style="background-color:#3637ea; width:132px;max-width:132px; padding:2px; overflow:hidden;font-size:10pt">'.$row['B'].'</td>
<td style="background-color:#3637ea; width:132px;max-width:132px; padding:2px; overflow:hidden;font-size:10pt">'.$row['C'].'</td>
<td style="background-color:#3637ea; width:132px;max-width:132px; padding:2px; overflow:hidden;font-size:10pt">'.$row['D'].'
<div style="width:100px; height:35px"> 
<a href="http://www.yandex.ru/yandsearch?p=2&clid=165535&lr=77&text='.$row['A'].'%20'.$row['B'].'%20'.$row['City'].' " 
style="color:white"><img src="images/search_yandex.png" alt="Искать информацию об организации в системе Yandex"
title="Искать информацию об организации в системе Yandex"/></a>
<a href="http://www.google.ru/#hl=ru&gs_rn=12&gs_ri=psy-ab&cp=15&gs_id=2l&xhr=t&q='.$row['A'].'+'.$row['B'].'+'.$row['City'].'&es_nrs=true&pf=p&newwindow=1&output=search&sclient=psy-ab" 
style="color:white"><img src="images/search_google.png" alt="Искать информацию об организации в системе Google"
title="Искать информацию об организации в системе Google"/></a></div></td>
<td style="background-color:#3637ea; width:132px;max-width:132px; padding:2px; overflow:hidden;font-size:10pt">'.$row['E'].'</td>
<td style="background-color:#3637ea; width:122px;max-width:122px; padding:2px; overflow:hidden;font-size:10pt">'.$row['F'].'</td>
<td style="background-color:#3637ea; width:142px;max-width:142px; padding:2px; overflow:hidden;font-size:10pt">'.$row['G'].'</td>
</tr>';
$count++;

}//isset($row['User'])||($row['User']==NULL)||($row['User']=="") 
else if(isset($row['User'])&&($row['User']!=NULL)&&($row['User']!="")){



echo'<tr>
<td style="background-color:#3637ea; width:50px; padding:2px;font-size:10pt">
</td>
<td style="background-color:#3637ea; width:50px;max-width:50px; padding:2px; overflow:hidden;font-size:10pt;
border:1px yellow solid; cursor:pointer" title="Организация уже добавлена в список пользователя '.$row['User'].'">'.$row['ID'].'</td>
<td style="background-color:#3637ea; width:140px;max-width:140px; padding:2px; overflow:hidden;font-size:10pt;
border:1px yellow solid; cursor:pointer" title="Организация уже добавлена в список пользователя '.$row['User'].'">'.$row['A'].'</td>
<td style="background-color:#3637ea; width:132px;max-width:132px; padding:2px; overflow:hidden;font-size:10pt;
border:1px yellow solid; cursor:pointer" title="Организация уже добавлена в список пользователя '.$row['User'].'">'.$row['B'].'</td>
<td style="background-color:#3637ea; width:132px;max-width:132px; padding:2px; overflow:hidden;font-size:10pt;
border:1px yellow solid; cursor:pointer" title="Организация уже добавлена в список пользователя '.$row['User'].'">'.$row['C'].'</td>
<td style="background-color:#3637ea; width:132px;max-width:132px; padding:2px; overflow:hidden;font-size:10pt;
border:1px yellow solid; cursor:pointer" title="Организация уже добавлена в список пользователя '.$row['User'].'">'.$row['D'].'
<div style="width:100px; height:35px">
<a href="http://www.yandex.ru/yandsearch?p=2&clid=165535&lr=77&text='.$row['A'].'%20'.$row['B'].'%20'.$row['City'].' " 
style="color:white"><img src="images/search_yandex.png" alt="Искать информацию об организации в системе Yandex"
title="Искать информацию об организации в системе Yandex"/></a>
<a href="http://www.google.ru/#hl=ru&gs_rn=12&gs_ri=psy-ab&cp=15&gs_id=2l&xhr=t&q='.$row['A'].'+'.$row['B'].'+'.$row['City'].'&es_nrs=true&pf=p&newwindow=1&output=search&sclient=psy-ab" 
style="color:white"><img src="images/search_google.png" alt="Искать информацию об организации в системе Google"
title="Искать информацию об организации в системе Google"/></a></div></td>

<td style="background-color:#3637ea; width:132px;max-width:132px; padding:2px; overflow:hidden;font-size:10pt;
border:1px yellow solid; cursor:pointer" title="Организация уже добавлена в список пользователя '.$row['User'].'">'.$row['E'].'</td>
<td style="background-color:#3637ea; width:122px;max-width:122px; padding:2px; overflow:hidden;font-size:10pt;
border:1px yellow solid; cursor:pointer" title="Организация уже добавлена в список пользователя '.$row['User'].'">'.$row['F'].'</td>
<td style="background-color:#3637ea; width:142px;max-width:142px; padding:2px; overflow:hidden;font-size:10pt;
border:1px yellow solid; cursor:pointer" title="Организация уже добавлена в список пользователя '.$row['User'].'">'.$row['G'].'</td>

</tr>';
$count++;
};//isset($row['User'])&&($row['User']!=NULL)&&($row['User']!="")



};//if($log==1){
}





 
?>
<?php
echo'
<div style="position:fixed; margin-top:-40px;margin-left:-40px;color:blue; background-color:white">
<span>Количество организаций: '.$count.'</span> 
</div>';
?>


</table>



</div>


<?php
//echo'<table border="0" width="90%" cellpadding="5" align="center">






//</table>';
?>


<a href="index.php"><input type="button" value="На главную" style="height:40px; width:100px; cursor:pointer; margin-top:20px" /></a>


</div>


</div>


</body>

</html>
