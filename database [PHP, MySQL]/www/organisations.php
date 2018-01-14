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
<script type="text/javascript" src="http://likbezz.ru/_source/_js/lib/jq.scrollTo-min.js"></script>
<script type="text/javascript" src="js/AnchorScroller.js"></script> <!--  ПОДКЛЮЧЕНИЕ AnchorScroller -->
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
<script type="text/javascript"> 

</script>


</head>

<body style="background-color:blue; color:white;overflow-x:hidden ">
<?php
echo"<span style=\"position:absolute; background-color:black\">Вы вошли как: <strong>".$_SESSION['user']."</strong></span>";


?>
<!--блок с кнопкой -наверх- -->
<div align="center" id="rightcol10" name="rightcol10" 
style="position:fixed; display:none; height:50px; width:50px; z-index:1111; top:40% " >
<a href="#inf" onclick="return anchorScroller(this)"><img src="images/up.png"/></a>
</div>
<!--блок с кнопкой -наверх- -->


<div id="inf" name="inf" align="center" style="width:100%; color:white; font-family:Arial, Helvetica, sans-serif">
<div align="center" style="width:1300px; min-height:100px; padding:10px; border:2px white solid">

<div align="center" style="width:1200px; height:40px; padding:5px; border:1px white solid; font-size:15pt">
<span>Все организации</span>
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
<td colspan="9" style="padding-bottom:10px">
<?php
echo'
Показать: 
<select name="sort" style="width:230px;margin-left:3px;background-color:#FFFF99" 
onChange="if(';
echo"this.options[this.selectedIndex].value!=''){window.location=this.options[this.selectedIndex].value}";
if(($_GET['sort']==NULL)||($_GET['sort']=="")||(!isset($_GET['sort']))){$_GET['sort']=1; };
echo'else{this.options[selectedIndex=0];}">
<option value="organisations.php?sort='.$_GET['sort'].'&visible=1"'; if($_GET['visible']==1){echo' selected';} echo'>Все огранизации</option>
<option value="organisations.php?sort='.$_GET['sort'].'&visible=2"'; if($_GET['visible']==2){echo' selected';} echo'>Огранизации, у которых есть сайт</option>
<option value="organisations.php?sort='.$_GET['sort'].'&visible=3"'; if($_GET['visible']==3){echo' selected';} echo'>Организации, у которых нет сайта</option>';
?>
</select>
</td>
</tr>
<tr>
<td colspan="9" style="padding-bottom:20px">
<!--поиск-->
<div id="f2" name="f2" style="width:520px; height:20px; margin-top:10px">

			<input name="Button1" type="button" value="Поиск" onclick="f_show()" />
			</div>
			<div id="f" name="f" style="width:520px; height:250px; border-style:solid; border-width:1px; 
			border-color:white;padding:10px; margin-top:10px; display:none">
			<input name="Button11" id="Button11" type="button" value="Скрыть" onclick="f_steals2()" />
			 <form id="responsesForm" action="action/search_organisations.php" enctype="multipart/form-data" method="post" accept-charset="utf-8">
					
                        <table border="0">
                            <tr><!--имя-->
                            <td style="height: 35px; width: 130px;border-style:solid; border-width:1px; border-color:white">
								<span style="margin-left:20px">Что искать</span>
								</td> 
								
                                <td style="height: 35px; width:360px;border-style:solid; border-width:1px; border-color:white">
								 <input type="text" name="title" maxlength="30" style="width: 200px;background-color:#FFFF99;margin-left:3px"/>
								</td>
                            </tr><!--имя-->
							
                            <tr><!--текст-->
                                <td style="height: 85px; width:130px; border-style:solid; border-width:1px; border-color:white">
								<span style="margin-left:20px">Где искать</span>
								</td> 
								
                                <td style="height:85px; width:360px; border-style:solid; border-width:1px; border-color:white">
										<div id="checkboxes" >	
									<input type="checkbox" name="Checkbox1"> 
									<span>Организация</span><br>
									<input type="checkbox" name="Checkbox2">
									<span>Отрасль</span><br>
									<input type="checkbox" name="Checkbox3"> 
									<span>Телефон</span><br>
									<input type="checkbox" name="Checkbox4"> 
									<span>Сайт</span><br>
									<input type="checkbox" name="Checkbox5"> 
									<span>E-mail</span><br>
									<input type="checkbox" name="Checkbox6"> 
									<span>Адрес<br></span>
									<input type="checkbox" name="Checkbox7"> 
									<span>Категории<br></span>

									</div>

								
								</td>
                            </tr><!--текст-->
		              </table>
                        <input type="submit" name="submit" value="Искать" 
						style="width: 119px; height: 38px; margin-top:10px; 
						-moz-border-radius: 5px;
						-webkit-border-radius: 5px;
						border-radius: 5px;
						background-image:url('images/button.png');"/>
						
                        <input type="reset" value="Сброс" 
						style="width: 119px; height: 38px; margin-top:10px " />
						
  

                    </form>
			
			</div>



<!--поиск-->

</td>
</tr>

<!-------------------------------->






<tr>
<td colspan="9" style="padding-bottom:20px">
<!--фильтр по категориям-->
<div style="width:520px; height:20px; margin-top:10px">
			<input name="Button1" type="button" value="Фильтр по отраслям" onclick="f_show3()" />
			
			</div>
			<div id="f3" name="f3" style="width:520px;  border-style:solid; border-width:1px; 
			border-color:white;padding:10px; margin-top:10px; display:none">
			<input name="Button11" id="Button11" type="button" value="Скрыть" onclick="f_steals()" />
			 <form id="responsesForm3" action="filter_a.php" enctype="multipart/form-data" method="post" accept-charset="utf-8">
					
                        <table border="0">
                         
							
                            <tr><!--текст-->
                                <td style=" width:110px; border-style:solid; border-width:1px; border-color:white; padding-left:20px">
								<span style="margin-left:0px">Показать отрасли</span>
								</td> 
								
                                <td style=" width:360px; border-style:solid; border-width:1px; border-color:white">


<?php
//обращение к базе и получение списка всех отраслей
$dbh=mysql_connect(DB_SERVER,DB_USER,DB_PASS) or die ("Невозможно соединиться с сервером.");
mysql_select_db(DB_BASE) or die ("Невозможно подключиться к базе.");
mysql_query("set character_set_results='utf8'");
			mysql_query("SET NAMES utf8");
mysql_query ("SET COLLATION_CONNECTION=utf8");
mysql_query("SET CHARACTER_SET_CLIENT=utf8");
mysql_query("SET CHARACTER_SET_RESULTS=utf8");

$query="SELECT * FROM big_table GROUP BY B";
$res=mysql_query($query);
					if($res==false){
	    			echo"Ошибка выполнения запроса (error 88).</br>";
					echo mysql_error();
					exit; }
echo'<div id="checkboxes" >	';				
$i_tmp=0;					
echo'

<div style="width:350px; height:200px; border-style:solid; border-width:1px; border-color:white;padding:10px; overflow:auto"> ';
 while($row=mysql_fetch_array($res)){
 //echo"".$row['B']."</br>";
 echo'<input type="checkbox" name="Checkbox1'.$i_tmp.'" value="'.$row['B'].'">'; 
 echo'<span style="margin-top:8px">'.$row['B'].'</span><br>';
$i_tmp++;
 }

$_SESSION['i_tmp']=$i_tmp;

echo'</div>';					
					echo'				</div>';

?>

								
								</td>
                            </tr><!--текст-->
		              </table>
                        <input type="submit" name="submit" value="Показать" 
						style="width: 119px; height: 38px; margin-top:10px; 
						-moz-border-radius: 5px;
						-webkit-border-radius: 5px;
						border-radius: 5px;
						background-image:url('images/button.png');"/>
						
                        <input type="reset" value="Сброс" 
						style="width: 119px; height: 38px; margin-top:10px " />
						
  

                    </form>
			
			</div>



<!--фильтр по категориям-->

</td>
</tr>


<!------------------------------------------------------------------------->
<!--сложный запрос-->




<!-------------------------------------------------------------------------->

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
</td></tr>
<!-------------------------------->


<tr>
 <td style="background-color:#3637ea; width:50px; padding:2px"></td>
<td style="background-color:#3637ea; width:50px; padding:2px">ID<?php echo'<select name="sort" style="width:20px;margin-left:3px;background-color:#FFFF99" 
onChange="if(';
echo"this.options[this.selectedIndex].value!=''){window.location=this.options[this.selectedIndex].value}";
echo'else{this.options[selectedIndex=0];}">
<option value="organisations.php?sort=1"'; if($_GET['sort']==1){echo' selected';} echo'>"ID" - возрастание</option>
<option value="organisations.php?sort=2"'; if($_GET['sort']==2){echo' selected';} echo'>"ID" - убывание</option>';
?>
</select></td>


<td style="background-color:#3637ea; width:140px; padding:2px">Организация<?php echo'<select name="sort" style="width:20px;margin-left:3px;background-color:#FFFF99" 
onChange="if(';
echo"this.options[this.selectedIndex].value!=''){window.location=this.options[this.selectedIndex].value}";
echo'else{this.options[selectedIndex=0];}">
<option value="organisations.php?sort=3"'; if($_GET['sort']==3){echo' selected';} echo'>"Организация" - возрастание</option>
<option value="organisations.php?sort=4"'; if($_GET['sort']==4){echo' selected';} echo'>"Организация" - убывание</option>';
?>
</select></td>

<td style="background-color:#3637ea; width:132px; padding:2px">Отрасль<?php echo'<select name="sort" style="width:20px;margin-left:3px;background-color:#FFFF99" 
onChange="if(';
echo"this.options[this.selectedIndex].value!=''){window.location=this.options[this.selectedIndex].value}";
echo'else{this.options[selectedIndex=0];}">
<option value="organisations.php?sort=5"'; if($_GET['sort']==5){echo' selected';} echo'>"Отрасль" - возрастание</option>
<option value="organisations.php?sort=6"'; if($_GET['sort']==6){echo' selected';} echo'>"Отрасль" - убывание</option>';
?>
</select></td>

<td style="background-color:#3637ea; width:132px; padding:2px">Телефон</td>
<td style="background-color:#3637ea; width:132px; padding:2px">Сайт</td>
<td style="background-color:#3637ea; width:132px; padding:2px">E-mail</td>
<td style="background-color:#3637ea; width:122px; padding:2px">Адрес<?php echo'<select name="sort" style="width:20px;margin-left:3px;background-color:#FFFF99" 
onChange="if(';
echo"this.options[this.selectedIndex].value!=''){window.location=this.options[this.selectedIndex].value}";
echo'else{this.options[selectedIndex=0];}">
<option value="organisations.php?sort=5"'; if($_GET['sort']==5){echo' selected';} echo'>"Адрес" - возрастание</option>
<option value="organisations.php?sort=6"'; if($_GET['sort']==6){echo' selected';} echo'>"Адрес" - убывание</option>';
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

$count=0;//число организаций
$query_count="SELECT COUNT(*) FROM big_table";
$res_count=mysql_query($query_count);
					if($res_count==false){
	    			echo"Ошибка выполнения запроса (error_count).</br>";
					echo mysql_error();
					exit; }
	$row_count=mysql_fetch_array($res_count);				
$count=$row_count[0];


$res=mysql_query($query);
					if($res==false){
	    			echo"Ошибка выполнения запроса (error1).</br>";
					echo mysql_error();
					exit; }

$listing=0;

//занесение списка организаций в пронумерованный массив
$i_tmp=0;
 while($row=mysql_fetch_array($res)){
$list[$i_tmp]['ID']=$row['ID'];
$list[$i_tmp]['A']=$row['A'];
$list[$i_tmp]['B']=$row['B'];
$list[$i_tmp]['C']=$row['C'];
$list[$i_tmp]['D']=$row['D'];
$list[$i_tmp]['E']=$row['E'];
$list[$i_tmp]['F']=$row['F'];
$list[$i_tmp]['G']=$row['G'];
$list[$i_tmp]['User']=$row['User'];
$list[$i_tmp]['City']=$row['City'];
$list[$i_tmp]['Description']=$row['Description'];
$list[$i_tmp]['Pos1']=$row['Pos1'];
$list[$i_tmp]['Pos2']=$row['Pos2'];

$i_tmp++;
}
////////////////////////////////////////////


//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
echo'<p>Показать <select name="sort" style="width:80px;margin-left:0px;background-color:#FFFF99" 
onChange="if(';
echo"this.options[this.selectedIndex].value!=''){window.location=this.options[this.selectedIndex].value}";
echo'else{this.options[selectedIndex=0];}">
<option value="organisations.php?count_str=10"'; 
if(($_GET['count_str']==10)||(!isset($_GET['count_str']))||($_GET['count_str']==NULL)||($_GET['count_str']=="")){echo' selected';} echo'>10</option>
<option value="organisations.php?count_str=20"'; if($_GET['count_str']==20){echo' selected';} echo'>20</option>
<option value="organisations.php?count_str=30"'; if($_GET['count_str']==30){echo' selected';} echo'>30</option>
<option value="organisations.php?count_str=40"'; if($_GET['count_str']==40){echo' selected';} echo'>40</option>
<option value="organisations.php?count_str=50"'; if($_GET['count_str']==50){echo' selected';} echo'>50</option>
<option value="organisations.php?count_str=100"'; if($_GET['count_str']==100){echo' selected';} echo'>100</option>
</select>'; echo' строк</p>';



if((!isset($_GET['count_str']))||($_GET['count_str']==NULL)||($_GET['count_str']=="")){
$_GET['count_str']=10;
}

if($count>$_GET['count_str']){
if((!isset($_GET['list']))||($_GET['list']==NULL)||($_GET['list']=="")||($_GET['list']==1)){//первая страница
$g=2;
echo'<a href="organisations.php?list='.$g.'&count_str='.$_GET['count_str'].'" style="color:white">NEXT</a></br>';}//первая страница
else if($_GET['list']==(ceil($count/$_GET['count_str']))){//последняя страница
$g=$_GET['list']-1;
echo'<a href="organisations.php?list='.$g.'&count_str='.$_GET['count_str'].'" style="color:white">PREV</a></br>';
}//последняя страница
else{//страница где-то в середине
$g1=$_GET['list']+1;
$g2=$_GET['list']-1;

echo'<a href="organisations.php?list='.$g2.'&count_str='.$_GET['count_str'].'" style="color:white">PREV</a>';
echo'<a href="organisations.php?list='.$g1.'&count_str='.$_GET['count_str'].'" style="color:white; margin-left:5px">NEXT</a></br>';
}//страница где-то в середине



}




$i_tmp=0;

if((!isset($_GET['list']))||($_GET['list']==NULL)||($_GET['list']=="")||($_GET['list']==1)){$i_tmp=0; $_GET['list']=1; }
else{

$i_tmp=($_GET['count_str']*$_GET['list'])-$_GET['count_str'];
$i_tmp--;

}



 while($listing<$_GET['count_str']){
if($_GET['visible']==2){//показать компании, у которых есть сайты
if(($list[$i_tmp]['D']!=NULL)&&($list[$i_tmp]['D']!="")&&(isset($list[$i_tmp]['D']))){
$ind=0;
if(($list[$i_tmp]['User']!=NULL)&&(isset($list[$i_tmp]['User']))&&($list[$i_tmp]['User']!="")){$ind=1; };//организация уже находится в "разработке"

if($ind==0){


echo'<tr>
<td style="background-color:#3637ea; width:40px; padding-top:5px; padding-bottom:5px; padding-right:2px; padding-left:12px; font-size:10pt">
<a href="new_organisation.php?id='.$list[$i_tmp]['ID'].'" style="color:white"><img src="images/plus.png" alt="Добавить в список клиентов" 
title="Добавить организацию в список пользователя '.$_SESSION['user'].'"/></a>



</td>
<td style="background-color:#3637ea; width:50px;max-width:50px; padding:2px; overflow:hidden;font-size:10pt">'.$list[$i_tmp]['ID'].'</td>
<td style="background-color:#3637ea; width:140px;max-width:140px; padding:2px; overflow:hidden;font-size:10pt">'.$list[$i_tmp]['A'].'</td>
<td style="background-color:#3637ea; width:132px;max-width:132px; padding:2px; overflow:hidden;font-size:10pt">'.$list[$i_tmp]['B'].'</td>
<td style="background-color:#3637ea; width:132px;max-width:132px; padding:2px; overflow:hidden;font-size:10pt">'.$list[$i_tmp]['C'].'</td>
<td style="background-color:#3637ea; width:132px;max-width:132px; padding:2px; overflow:hidden;font-size:10pt">'.$list[$i_tmp]['D'].'
<div style="width:100px; height:35px"> 
<a href="http://www.yandex.ru/yandsearch?p=2&clid=165535&lr=77&text='.$list[$i_tmp]['A'].'%20'.$list[$i_tmp]['B'].'%20'.$list[$i_tmp]['City'].' " 
style="color:white"><img src="images/search_yandex.png" alt="Искать информацию об организации в системе Yandex"
title="Искать информацию об организации в системе Yandex"/></a>
<a href="http://www.google.ru/#hl=ru&gs_rn=12&gs_ri=psy-ab&cp=15&gs_id=2l&xhr=t&q='.$list[$i_tmp]['A'].'+'.$list[$i_tmp]['B'].'+'.$list[$i_tmp]['City'].'&es_nrs=true&pf=p&newwindow=1&output=search&sclient=psy-ab" 
style="color:white"><img src="images/search_google.png" alt="Искать информацию об организации в системе Google"
title="Искать информацию об организации в системе Google"/></a></div></td>
<td style="background-color:#3637ea; width:132px;max-width:132px; padding:2px; overflow:hidden;font-size:10pt">'.$list[$i_tmp]['E'].'</td>
<td style="background-color:#3637ea; width:122px;max-width:122px; padding:2px; overflow:hidden;font-size:10pt">'.$list[$i_tmp]['F'].'
<div style="width:110px; height:32px; margin-top:5px">
<a href="map.php?Pos1='.$list[$i_tmp]['Pos1'].'&Pos2='.$list[$i_tmp]['Pos2'].'&A='.$list[$i_tmp]['A'].'&F='.$list[$i_tmp]['F'].'&City='.$list[$i_tmp]['City'].'&C='.$list[$i_tmp]['C'].' " 
style="color:white"><img src="images/map.png" alt="Посмотреть на карте"
title="Посмотреть на карте"/></a></div>
</td>
<td style="background-color:#3637ea; width:142px;max-width:142px; padding:2px; overflow:hidden;font-size:10pt">'.$list[$i_tmp]['G'].'</td>

</tr>';



}
else if($ind==1){

echo'<tr>
<td style="background-color:#3637ea; width:50px; padding:2px;font-size:10pt">
</td>
<td style="background-color:#3637ea; width:50px;max-width:50px; padding:2px; overflow:hidden;font-size:10pt;
border:1px yellow solid; cursor:pointer" title="Организация уже добавлена в список пользователя '.$list[$i_tmp]['User'].'">'.$list[$i_tmp]['ID'].'</td>
<td style="background-color:#3637ea; width:140px;max-width:140px; padding:2px; overflow:hidden;font-size:10pt;
border:1px yellow solid; cursor:pointer" title="Организация уже добавлена в список пользователя '.$list[$i_tmp]['User'].'">'.$list[$i_tmp]['A'].'</td>
<td style="background-color:#3637ea; width:132px;max-width:132px; padding:2px; overflow:hidden;font-size:10pt;
border:1px yellow solid; cursor:pointer" title="Организация уже добавлена в список пользователя '.$list[$i_tmp]['User'].'">'.$list[$i_tmp]['B'].'</td>
<td style="background-color:#3637ea; width:132px;max-width:132px; padding:2px; overflow:hidden;font-size:10pt;
border:1px yellow solid; cursor:pointer" title="Организация уже добавлена в список пользователя '.$list[$i_tmp]['User'].'">'.$list[$i_tmp]['C'].'</td>
<td style="background-color:#3637ea; width:132px;max-width:132px; padding:2px; overflow:hidden;font-size:10pt;
border:1px yellow solid; cursor:pointer" title="Организация уже добавлена в список пользователя '.$list[$i_tmp]['User'].'">'.$list[$i_tmp]['D'].'
<div style="width:100px; height:35px">
<a href="http://www.yandex.ru/yandsearch?p=2&clid=165535&lr=77&text='.$list[$i_tmp]['A'].'%20'.$list[$i_tmp]['B'].'%20'.$list[$i_tmp]['City'].' " 
style="color:white"><img src="images/search_yandex.png" alt="Искать информацию об организации в системе Yandex"
title="Искать информацию об организации в системе Yandex"/></a>
<a href="http://www.google.ru/#hl=ru&gs_rn=12&gs_ri=psy-ab&cp=15&gs_id=2l&xhr=t&q='.$list[$i_tmp]['A'].'+'.$list[$i_tmp]['B'].'+'.$list[$i_tmp]['City'].'&es_nrs=true&pf=p&newwindow=1&output=search&sclient=psy-ab" 
style="color:white"><img src="images/search_google.png" alt="Искать информацию об организации в системе Google"
title="Искать информацию об организации в системе Google"/></a></div></td>
<td style="background-color:#3637ea; width:132px;max-width:132px; padding:2px; overflow:hidden;font-size:10pt;
border:1px yellow solid; cursor:pointer" title="Организация уже добавлена в список пользователя '.$list[$i_tmp]['User'].'">'.$list[$i_tmp]['E'].'
</td>
<td style="background-color:#3637ea; width:122px;max-width:122px; padding:2px; overflow:hidden;font-size:10pt;
border:1px yellow solid; cursor:pointer" title="Организация уже добавлена в список пользователя '.$list[$i_tmp]['User'].'">'.$list[$i_tmp]['F'].'
<div style="width:110px; height:32px; margin-top:5px">
<a href="map.php?Pos1='.$list[$i_tmp]['Pos1'].'&Pos2='.$list[$i_tmp]['Pos2'].'&A='.$list[$i_tmp]['A'].'&F='.$list[$i_tmp]['F'].'&City='.$list[$i_tmp]['City'].'&C='.$list[$i_tmp]['C'].' " 
style="color:white"><img src="images/map.png" alt="Посмотреть на карте"
title="Посмотреть на карте"/></a></div></td>
<td style="background-color:#3637ea; width:142px;max-width:142px; padding:2px; overflow:hidden;font-size:10pt;
border:1px yellow solid; cursor:pointer" title="Организация уже добавлена в список пользователя '.$list[$i_tmp]['User'].'">'.$list[$i_tmp]['G'].'</td>

</tr>';
}




}}//показать компании, у которых есть сайты
else if($_GET['visible']==3){//показать компании, у которых нет сайта
if(($list[$i_tmp]['D']==NULL)||($list[$i_tmp]['D']=="")||!(isset($list[$i_tmp]['D']))){

$ind=0;
if(($list[$i_tmp]['User']!=NULL)&&(isset($list[$i_tmp]['User']))&&($list[$i_tmp]['User']!="")){$ind=1; };//организация уже находится в "разработке"

if($ind==0){

echo'<tr>
<td style="background-color:#3637ea; width:40px; padding-top:5px; padding-bottom:5px; padding-right:2px; padding-left:12px; font-size:10pt">
<a href="new_organisation.php?id='.$list[$i_tmp]['ID'].'" style="color:white"><img src="images/plus.png" alt="Добавить в список клиентов"
title="Добавить организацию в список пользователя '.$_SESSION['user'].'"/></a>


<td style="background-color:#3637ea; width:50px;max-width:50px; padding:2px; overflow:hidden;font-size:10pt">'.$list[$i_tmp]['ID'].'</td>
<td style="background-color:#3637ea; width:140px;max-width:140px; padding:2px; overflow:hidden;font-size:10pt">'.$list[$i_tmp]['A'].'</td>
<td style="background-color:#3637ea; width:132px;max-width:132px; padding:2px; overflow:hidden;font-size:10pt">'.$list[$i_tmp]['B'].'</td>
<td style="background-color:#3637ea; width:132px;max-width:132px; padding:2px; overflow:hidden;font-size:10pt">'.$list[$i_tmp]['C'].'</td>
<td style="background-color:#3637ea; width:132px;max-width:132px; padding:2px; overflow:hidden;font-size:10pt">'.$list[$i_tmp]['D'].'
<div style="width:100px; height:35px">
<a href="http://www.yandex.ru/yandsearch?p=2&clid=165535&lr=77&text='.$list[$i_tmp]['A'].'%20'.$list[$i_tmp]['B'].'%20'.$list[$i_tmp]['City'].' " 
style="color:white"><img src="images/search_yandex.png" alt="Искать информацию об организации в системе Yandex"
title="Искать информацию об организации в системе Yandex"/></a>
<a href="http://www.google.ru/#hl=ru&gs_rn=12&gs_ri=psy-ab&cp=15&gs_id=2l&xhr=t&q='.$list[$i_tmp]['A'].'+'.$list[$i_tmp]['B'].'+'.$list[$i_tmp]['City'].'&es_nrs=true&pf=p&newwindow=1&output=search&sclient=psy-ab" 
style="color:white"><img src="images/search_google.png" alt="Искать информацию об организации в системе Google"
title="Искать информацию об организации в системе Google"/></a></div></td>
<td style="background-color:#3637ea; width:132px;max-width:132px; padding:2px; overflow:hidden;font-size:10pt">'.$list[$i_tmp]['E'].'</td>
<td style="background-color:#3637ea; width:122px;max-width:122px; padding:2px; overflow:hidden;font-size:10pt">'.$list[$i_tmp]['F'].'
<div style="width:110px; height:32px; margin-top:5px">
<a href="map.php?Pos1='.$list[$i_tmp]['Pos1'].'&Pos2='.$list[$i_tmp]['Pos2'].'&A='.$list[$i_tmp]['A'].'&F='.$list[$i_tmp]['F'].'&City='.$list[$i_tmp]['City'].'&C='.$list[$i_tmp]['C'].' " 
style="color:white"><img src="images/map.png" alt="Посмотреть на карте"
title="Посмотреть на карте"/></a></div></td>
<td style="background-color:#3637ea; width:142px;max-width:142px; padding:2px; overflow:hidden;font-size:10pt">'.$list[$i_tmp]['G'].'</td>

</tr>';
}
else if($ind==1){

echo'<tr>
<td style="background-color:#3637ea; width:50px; padding:2px;font-size:10pt">
</td>
<td style="background-color:#3637ea; width:50px;max-width:50px; padding:2px; overflow:hidden;font-size:10pt;
border:1px yellow solid; cursor:pointer" title="Организация уже добавлена в список пользователя '.$list[$i_tmp]['User'].'">'.$list[$i_tmp]['ID'].'</td>
<td style="background-color:#3637ea; width:140px;max-width:140px; padding:2px; overflow:hidden;font-size:10pt;
border:1px yellow solid; cursor:pointer" title="Организация уже добавлена в список пользователя '.$list[$i_tmp]['User'].'">'.$list[$i_tmp]['A'].'</td>
<td style="background-color:#3637ea; width:132px;max-width:132px; padding:2px; overflow:hidden;font-size:10pt;
border:1px yellow solid; cursor:pointer" title="Организация уже добавлена в список пользователя '.$list[$i_tmp]['User'].'">'.$list[$i_tmp]['B'].'</td>
<td style="background-color:#3637ea; width:132px;max-width:132px; padding:2px; overflow:hidden;font-size:10pt;
border:1px yellow solid; cursor:pointer" title="Организация уже добавлена в список пользователя '.$list[$i_tmp]['User'].'">'.$list[$i_tmp]['C'].'</td>

<td style="background-color:#3637ea; width:132px;max-width:132px; padding:2px; overflow:hidden;font-size:10pt;
border:1px yellow solid; cursor:pointer" title="Организация уже добавлена в список пользователя '.$list[$i_tmp]['User'].'">'.$list[$i_tmp]['D'].'
<div style="width:100px; height:35px">
<a href="http://www.yandex.ru/yandsearch?p=2&clid=165535&lr=77&text='.$list[$i_tmp]['A'].'%20'.$list[$i_tmp]['B'].'%20'.$list[$i_tmp]['City'].' " 
style="color:white"><img src="images/search_yandex.png" alt="Искать информацию об организации в системе Yandex"
title="Искать информацию об организации в системе Yandex"/></a>
<a href="http://www.google.ru/#hl=ru&gs_rn=12&gs_ri=psy-ab&cp=15&gs_id=2l&xhr=t&q='.$list[$i_tmp]['A'].'+'.$list[$i_tmp]['B'].'+'.$list[$i_tmp]['City'].'&es_nrs=true&pf=p&newwindow=1&output=search&sclient=psy-ab" 
style="color:white"><img src="images/search_google.png" alt="Искать информацию об организации в системе Google"
title="Искать информацию об организации в системе Google"/></a></div></td>

<td style="background-color:#3637ea; width:132px;max-width:132px; padding:2px; overflow:hidden;font-size:10pt;
border:1px yellow solid; cursor:pointer" title="Организация уже добавлена в список пользователя '.$list[$i_tmp]['User'].'">'.$list[$i_tmp]['E'].'</td>
<td style="background-color:#3637ea; width:122px;max-width:122px; padding:2px; overflow:hidden;font-size:10pt;
border:1px yellow solid; cursor:pointer" title="Организация уже добавлена в список пользователя '.$list[$i_tmp]['User'].'">'.$list[$i_tmp]['F'].'
<div style="width:110px; height:32px; margin-top:5px">
<a href="map.php?Pos1='.$list[$i_tmp]['Pos1'].'&Pos2='.$list[$i_tmp]['Pos2'].'&A='.$list[$i_tmp]['A'].'&F='.$list[$i_tmp]['F'].'&City='.$list[$i_tmp]['City'].'&C='.$list[$i_tmp]['C'].' " 
style="color:white"><img src="images/map.png" alt="Посмотреть на карте"
title="Посмотреть на карте"/></a></div></td>
<td style="background-color:#3637ea; width:142px;max-width:142px; padding:2px; overflow:hidden;font-size:10pt;
border:1px yellow solid; cursor:pointer" title="Организация уже добавлена в список пользователя '.$list[$i_tmp]['User'].'">'.$list[$i_tmp]['G'].'</td>

</tr>';
}


}}//показать компании, у которых нет сайта
else{//показать все компании

$ind=0;
if(($list[$i_tmp]['User']!=NULL)&&(isset($list[$i_tmp]['User']))&&($list[$i_tmp]['User']!="")){$ind=1; };//организация уже находится в "разработке"

if($ind==0){

echo'<tr>
<td style="background-color:#3637ea; width:40px; padding-top:5px; padding-bottom:5px; padding-right:2px; padding-left:12px; font-size:10pt">
<a href="new_organisation.php?id='.$list[$i_tmp]['ID'].'" style="color:white"><img src="images/plus.png" alt="Добавить в список клиентов"
title="Добавить организацию в список пользователя '.$_SESSION['user'].'"/></a>


</td>
<td style="background-color:#3637ea; width:50px;max-width:50px; padding:2px; overflow:hidden;font-size:10pt">'.$list[$i_tmp]['ID'].'</td>
<td style="background-color:#3637ea; width:140px;max-width:140px; padding:2px; overflow:hidden;font-size:10pt">'.$list[$i_tmp]['A'].'</td>
<td style="background-color:#3637ea; width:132px;max-width:132px; padding:2px; overflow:hidden;font-size:10pt">'.$list[$i_tmp]['B'].'</td>
<td style="background-color:#3637ea; width:132px;max-width:132px; padding:2px; overflow:hidden;font-size:10pt">'.$list[$i_tmp]['C'].'</td>
<td style="background-color:#3637ea; width:132px;max-width:132px; padding:2px; overflow:hidden;font-size:10pt">'.$list[$i_tmp]['D'].'
<div style="width:100px; height:35px">
<a href="http://www.yandex.ru/yandsearch?p=2&clid=165535&lr=77&text='.$list[$i_tmp]['A'].'%20'.$list[$i_tmp]['B'].'%20'.$list[$i_tmp]['City'].' " 
style="color:white"><img src="images/search_yandex.png" alt="Искать информацию об организации в системе Yandex"
title="Искать информацию об организации в системе Yandex"/></a>
<a href="http://www.google.ru/#hl=ru&gs_rn=12&gs_ri=psy-ab&cp=15&gs_id=2l&xhr=t&q='.$list[$i_tmp]['A'].'+'.$list[$i_tmp]['B'].'+'.$list[$i_tmp]['City'].'&es_nrs=true&pf=p&newwindow=1&output=search&sclient=psy-ab" 
style="color:white"><img src="images/search_google.png" alt="Искать информацию об организации в системе Google"
title="Искать информацию об организации в системе Google"/></a></div></td>
<td style="background-color:#3637ea; width:132px;max-width:132px; padding:2px; overflow:hidden;font-size:10pt">'.$list[$i_tmp]['E'].'</td>
<td style="background-color:#3637ea; width:122px;max-width:122px; padding:2px; overflow:hidden;font-size:10pt">'.$list[$i_tmp]['F'].'
<div style="width:110px; height:32px; margin-top:5px">
<a href="map.php?Pos1='.$list[$i_tmp]['Pos1'].'&Pos2='.$list[$i_tmp]['Pos2'].'&A='.$list[$i_tmp]['A'].'&F='.$list[$i_tmp]['F'].'&City='.$list[$i_tmp]['City'].'&C='.$list[$i_tmp]['C'].' " 
style="color:white"><img src="images/map.png" alt="Посмотреть на карте"
title="Посмотреть на карте"/></a></div></td>
<td style="background-color:#3637ea; width:142px;max-width:142px; padding:2px; overflow:hidden;font-size:10pt">'.$list[$i_tmp]['G'].'</td>

</tr>';
}
else if($ind==1){

echo'<tr>
<td style="background-color:#3637ea; width:50px; padding:2px;font-size:10pt">
</td>
<td style="background-color:#3637ea; width:50px;max-width:50px; padding:2px; overflow:hidden;font-size:10pt;
border:1px yellow solid; cursor:pointer" title="Организация уже добавлена в список пользователя '.$list[$i_tmp]['User'].'">'.$list[$i_tmp]['ID'].'</td>
<td style="background-color:#3637ea; width:140px;max-width:140px; padding:2px; overflow:hidden;font-size:10pt;
border:1px yellow solid; cursor:pointer" title="Организация уже добавлена в список пользователя '.$list[$i_tmp]['User'].'">'.$list[$i_tmp]['A'].'</td>
<td style="background-color:#3637ea; width:132px;max-width:132px; padding:2px; overflow:hidden;font-size:10pt;
border:1px yellow solid; cursor:pointer" title="Организация уже добавлена в список пользователя '.$list[$i_tmp]['User'].'">'.$list[$i_tmp]['B'].'</td>
<td style="background-color:#3637ea; width:132px;max-width:132px; padding:2px; overflow:hidden;font-size:10pt;
border:1px yellow solid; cursor:pointer" title="Организация уже добавлена в список пользователя '.$list[$i_tmp]['User'].'">'.$list[$i_tmp]['C'].'</td>
<td style="background-color:#3637ea; width:132px;max-width:132px; padding:2px; overflow:hidden;font-size:10pt;
border:1px yellow solid; cursor:pointer" title="Организация уже добавлена в список пользователя '.$list[$i_tmp]['User'].'">'.$list[$i_tmp]['D'].'
<div style="width:100px; height:35px">
<a href="http://www.yandex.ru/yandsearch?p=2&clid=165535&lr=77&text='.$list[$i_tmp]['A'].'%20'.$list[$i_tmp]['B'].'%20'.$list[$i_tmp]['City'].' " 
style="color:white"><img src="images/search_yandex.png" alt="Искать информацию об организации в системе Yandex"
title="Искать информацию об организации в системе Yandex"/></a>
<a href="http://www.google.ru/#hl=ru&gs_rn=12&gs_ri=psy-ab&cp=15&gs_id=2l&xhr=t&q='.$list[$i_tmp]['A'].'+'.$list[$i_tmp]['B'].'+'.$list[$i_tmp]['City'].'&es_nrs=true&pf=p&newwindow=1&output=search&sclient=psy-ab" 
style="color:white"><img src="images/search_google.png" alt="Искать информацию об организации в системе Google"
title="Искать информацию об организации в системе Google"/></a></div></td>

<td style="background-color:#3637ea; width:132px;max-width:132px; padding:2px; overflow:hidden;font-size:10pt;
border:1px yellow solid; cursor:pointer" title="Организация уже добавлена в список пользователя '.$list[$i_tmp]['User'].'">'.$list[$i_tmp]['E'].'</td>
<td style="background-color:#3637ea; width:122px;max-width:122px; padding:2px; overflow:hidden;font-size:10pt;
border:1px yellow solid; cursor:pointer" title="Организация уже добавлена в список пользователя '.$list[$i_tmp]['User'].'">'.$list[$i_tmp]['F'].'
<div style="width:110px; height:32px; margin-top:5px">
<a href="map.php?Pos1='.$list[$i_tmp]['Pos1'].'&Pos2='.$list[$i_tmp]['Pos2'].'&A='.$list[$i_tmp]['A'].'&F='.$list[$i_tmp]['F'].'&City='.$list[$i_tmp]['City'].'&C='.$list[$i_tmp]['C'].' " 
style="color:white"><img src="images/map.png" alt="Посмотреть на карте"
title="Посмотреть на карте"/></a></div></td>
<td style="background-color:#3637ea; width:142px;max-width:142px; padding:2px; overflow:hidden;font-size:10pt;
border:1px yellow solid; cursor:pointer" title="Организация уже добавлена в список пользователя '.$list[$i_tmp]['User'].'">'.$list['i_tmp']['G'].'</td>

</tr>';
}





}//показать все компании

//if($listing==9){break;}
$listing++;
$i_tmp++;
}//конец цикла
 
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
<script type="text/javascript">
window.onscroll = function () 
{
    var scrollTop = window.pageYOffset ? window.pageYOffset : (document.documentElement.scrollTop ? document.documentElement.scrollTop : document.body.scrollTop);

    if(scrollTop >= 200)
    { 
      $("#rightcol10").show(2000);
    }
	if(scrollTop < 200)
	{
	 $("#rightcol10").hide(2000);
	}
}

</script>




</body>

</html>
