<?php 
require 'configuration2.php';

$dbh=mysql_connect(DB_SERVER,DB_USER,DB_PASS) or die ("Невозможно соединиться с сервером.");
mysql_select_db(DB_BASE) or die ("Невозможно подключиться к базе.");
mysql_query("set character_set_results='utf8'");
			mysql_query("SET NAMES utf8");
mysql_query ("SET COLLATION_CONNECTION=utf8");
mysql_query("SET CHARACTER_SET_CLIENT=utf8");
mysql_query("SET CHARACTER_SET_RESULTS=utf8");


if((!isset($_GET['p']))||($_GET['p']=="")||($_GET['p']==NULL)||($_GET['p']=="form")){
//вывод формы

echo'

<div id="f" name="f" style="width:520px; height:340px; border-style:solid; border-width:1px; 
			border-color:white;padding:10px; margin-top:0px; position:absolute; top:50%; left:50%; 
 margin-top:-170px; margin-left:-260px; background-color:blue;">
		
			
			<p style="font-size:12pt; color:white">Добавить новость</p>
			 <form id="responsesForm" action="news.php?p=action" enctype="multipart/form-data" method="post" accept-charset="utf-8">
					
                        <table border="0">
                            <tr><!--text-->
                                <td style="height: 35px; width: 130px;border-style:solid; border-width:1px; border-color:white">
								<span style="margin-left:20px; color:white; font-weight:bold;">Текст</span>
								</td> 
								
                                <td style="height: 35px; width:360px;border-style:solid; border-width:1px; border-color:white">
								 <textarea  name="text"  style="width: 300px;background-color:#FFFF99;margin-left:3px;
								 height:100px;"></textarea>
								</td>
                            </tr><!--text-->
							
							  <tr><!--image-->
                                <td style="height: 35px; width: 130px;border-style:solid; border-width:1px; border-color:white">
								<span style="margin-left:20px; color:white; font-weight:bold;">Изображение</span>
								</td> 
								
                                <td style="height: 35px; width:360px;border-style:solid; border-width:1px; border-color:white">
								<input type="file" name="image" maxlength="30" style="width: 300px;background-color:#FFFF99;margin-left:3px"/>
								</td>
                            </tr><!--image-->
							
                            </table>
                       <input type="submit" name="submit" value="Добавить" 
						style="width: 119px; height: 38px; margin-top:10px; 
						-moz-border-radius: 5px;
						-webkit-border-radius: 5px;
						border-radius: 5px;
						"/>
						
                        <input type="reset" value="Сброс" 
						style="width: 119px; height: 38px; margin-top:10px " />
						
  
                        
						

                    </form>
			
			</div>';
			
			
			

}
else if(($_GET['p']=="action")){

$image_name="";


//контроль над загрузкой файла картинки
if(($_FILES['image']['name']!="")&&($_FILES['image']['name']!=NULL)&&(isset($_FILES['image']['name']))){
   //if($_FILES['image']['type']!="image/jpeg"){echo"<h3>Ошибка. Файл картинки должен иметь расширение .jpg</h3>";
   //строка с ссылкой на главную страницу.
  //exit; }


 if(preg_match("/[А-Яа-я]/",$_FILES['icon0']['name'])==true){echo"<h3>Ошибка. Файл картинки не должен содержать символов кириллицы.</h3>";	 
	 exit;}

$tmp1=rand();
$tmp2=$tmp1.rand();
$_FILES['image']['name']=$tmp2.$_FILES['image']['name'];

copy($_FILES['image']['tmp_name'],"images/news/".basename($_FILES['image']['name']));
$image_name="images/news/".$_FILES['image']['name'];
};//$_FILES['image']['name']!=""

//получить текущие дату и время
$today = getdate();
$year=$today['year'];
$mon=$today['mon'];
$day=$today['mday'];
$weekday=$today['weekday'];
$hours=$today['hours'];
$minutes=$today['minutes'];
$seconds=$today['seconds'];


if($year<10){$year='0'.$year; };
if($mon<10){$mon='0'.$mon; };
if($day<10){$day='0'.$day; };
if($hours<10){$hours='0'.$hours; };
if($minutes<10){$minutes='0'.$minutes; };
if($seconds<10){$seconds='0'.$seconds; };


$date="".$year."-".$mon."-".$day."";
$time="".$hours.":".$minutes.":".$seconds."";

$result_today="".$year."-".$mon."-".$day.", ".$weekday.", ".$hours.":".$minutes.":".$seconds."";



 $query = "INSERT INTO cms_retinanews(image, text, date) VALUES ('".$image_name."','".$_POST['text']."','".$result_today."') ";
 $res=mysql_query($query);
	     if($res==false){
 echo"Ошибка выполнения запроса.";
 echo mysql_error();
 exit; }
	    mysql_close($dbh);	

header("Refresh: 1; URL=news.php?p=form");
echo'Операция прошла успешно. Перенаправление...';
exit;

}//$_GET['p']=="action"





/*$query="SELECT * FROM cms_retinanews";
$res=mysql_query($query);
					if($res==false){
	    			echo"Ошибка выполнения запроса.</br>";
					echo mysql_error();
					exit; }

	while($row=mysql_fetch_array($res)){


}			
*/





?>