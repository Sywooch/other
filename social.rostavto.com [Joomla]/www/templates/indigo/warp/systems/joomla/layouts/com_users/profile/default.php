<?php
/**
* @package   Warp Theme Framework
* @author    YOOtheme http://www.yootheme.com
* @copyright Copyright (C) YOOtheme GmbH
* @license   http://www.gnu.org/licenses/gpl.html GNU/GPL
*/

// no direct access
defined('_JEXEC') or die;

JHtml::_('behavior.tooltip');
?>

<div id="system">
	
	<?php if ($this->params->get('show_page_heading')) : ?>
	<h1 class="title"><?php echo $this->escape($this->params->get('page_heading')); ?></h1>
	<?php endif; ?>

	<?php echo $this->loadTemplate('core'); ?>
	
<?php
//извлечение данных из ближней базы
$user =& JFactory::getUser();

$user_id=$user->id;
$user_login=$user->username; 
	
$tmp_user_name=$user->name;


//Город	
	$db = JFactory::getDbo();
$query_events_1 = $db->getQuery(true);



$query_events_1->select(array('profile_key', 'profile_value'));
$query_events_1->from('#__user_profiles');
$query_events_1->where('user_id LIKE \''.$user_id.'\'');
$query_events_1->where('profile_key LIKE \'profile.city\'');

$db->setQuery($query_events_1);

$results = $db->loadObjectList();

foreach($results as $element_1) {

$tmp_city=$element_1->profile_value;

break;

}

//$tmp_city = $db->loadResult();




//Страна	
	$db = JFactory::getDbo();
$query_events_2 = $db->getQuery(true);



$query_events_2->select(array('profile_key', 'profile_value'));
$query_events_2->from('#__user_profiles');
$query_events_2->where('user_id LIKE \''.$user_id.'\'');
$query_events_2->where('profile_key LIKE \'profile.country\'');

$db->setQuery($query_events_2);

$results = $db->loadObjectList();

foreach($results as $element_2) {

$tmp_country=$element_2->profile_value;

break;

}
//$tmp_country = $db->loadResult();



//Телефон
	$db = JFactory::getDbo();
$query_events_3 = $db->getQuery(true);



$query_events_3->select(array('profile_key', 'profile_value'));
$query_events_3->from('#__user_profiles');
$query_events_3->where('user_id LIKE \''.$user_id.'\'');
$query_events_3->where('profile_key LIKE \'profile.phone\'');

$db->setQuery($query_events_3);

$results = $db->loadObjectList();

foreach($results as $element_3) {

$tmp_phone=$element_3->profile_value;

break;

}
//$tmp_phone = $db->loadResult();


//Дата рождениия
	$db = JFactory::getDbo();
$query_events_4 = $db->getQuery(true);



$query_events_4->select(array('profile_key', 'profile_value'));
$query_events_4->from('#__user_profiles');
$query_events_4->where('user_id LIKE \''.$user_id.'\'');
$query_events_4->where('profile_key LIKE \'profile.dob\'');

$db->setQuery($query_events_4);

$results = $db->loadObjectList();

foreach($results as $element_4) {

$tmp_dob=$element_4->profile_value;

break;

}
//$tmp_dob = $db->loadResult();



function Escape_win ($path) { 
$path = strtoupper ($path); 
return strtr($path, array("\U0430"=>"а", "\U0431"=>"б", "\U0432"=>"в", 
"\U0433"=>"г", "\U0434"=>"д", "\U0435"=>"е", "\U0451"=>"ё", "\U0436"=>"ж", "\U0437"=>"з", "\U0438"=>"и", 
"\U0439"=>"й", "\U043A"=>"к", "\U043B"=>"л", "\U043C"=>"м", "\U043D"=>"н", "\U043E"=>"о", "\U043F"=>"п", 
"\U0440"=>"р", "\U0441"=>"с", "\U0442"=>"т", "\U0443"=>"у", "\U0444"=>"ф", "\U0445"=>"х", "\U0446"=>"ц", 
"\U0447"=>"ч", "\U0448"=>"ш", "\U0449"=>"щ", "\U044A"=>"ъ", "\U044B"=>"ы", "\U044C"=>"ь", "\U044D"=>"э", 
"\U044E"=>"ю", "\U044F"=>"я", "\U0410"=>"А", "\U0411"=>"Б", "\U0412"=>"В", "\U0413"=>"Г", "\U0414"=>"Д", 
"\U0415"=>"Е", "\U0401"=>"Ё", "\U0416"=>"Ж", "\U0417"=>"З", "\U0418"=>"И", "\U0419"=>"Й", "\U041A"=>"К", 
"\U041B"=>"Л", "\U041C"=>"М", "\U041D"=>"Н", "\U041E"=>"О", "\U041F"=>"П", "\U0420"=>"Р", "\U0421"=>"С", 
"\U0422"=>"Т", "\U0423"=>"У", "\U0424"=>"Ф", "\U0425"=>"Х", "\U0426"=>"Ц", "\U0427"=>"Ч", "\U0428"=>"Ш", 
"\U0429"=>"Щ", "\U042A"=>"Ъ", "\U042B"=>"Ы", "\U042C"=>"Ь", "\U042D"=>"Э", "\U042E"=>"Ю", "\U042F"=>"Я")); 
} 



$tmp_city = Escape_win ($tmp_city); 
$tmp_country = Escape_win ($tmp_country); 


$tmp_city=iconv('CP1251','UTF-8',$tmp_city);
$tmp_country=iconv('CP1251','UTF-8',$tmp_country);


//echo"".$tmp_city."<br>";
//echo"".$tmp_country."<br>";
//echo"".$tmp_phone."<br>";
///echo"".$tmp_dob."<br>";



require '/config_db_social/config.php';

$dbh=mysql_connect(DB_SERVER_S,DB_USER_S,DB_PASS_S) or die ("Невозможно соединиться с сервером.");

mysql_select_db(DB_BASE_S) or die ("Невозможно подключиться к базе.");
mysql_query("set character_set_results='utf8'");
			mysql_query("SET NAMES utf8");
			
mysql_query ("SET COLLATION_CONNECTION=utf8");
mysql_query("SET CHARACTER_SET_CLIENT=utf8");
mysql_query("SET CHARACTER_SET_RESULTS=utf8");	


$query2_name="SELECT * FROM avto_users WHERE username='".$user_login."'";

$res2_name=mysql_query($query2_name);
					if($res2_name==false){
	    			echo"Ошибка выполнения запроса.</br>";
					echo mysql_error();
					exit; }

while($row2_name=mysql_fetch_array($res2_name)){

$avto_tmp_reg=$row2_name['id'];//id пользователя
break;
}




$tmp_city=str_replace("\"","",$tmp_city);
$tmp_country=str_replace("\"","",$tmp_country);
$tmp_phone=str_replace("\"","",$tmp_phone);
$tmp_dob=str_replace("\"","",$tmp_dob);

/*
echo"".$tmp_city."<br>";
echo"".$tmp_country."<br>";
echo"".$tmp_phone."<br>";
echo"".$tmp_dob."<br>";
*/


//страна
$q="SELECT * FROM avto_community_fields_values WHERE user_id=$avto_tmp_reg AND field_id='11'";



$res2_name=mysql_query($q);
					if($res2_name==false){
	    			echo"Ошибка выполнения запроса.</br>";
					echo mysql_error();
					exit; }

$i_tmp=0;

while($row2_name=mysql_fetch_array($res2_name)){

$i_tmp++;
}



if ($i_tmp==0){
//вставка


$query3_user="INSERT INTO avto_community_fields_values (user_id, field_id, value) 
VALUES ('".$avto_tmp_reg."','11','".$tmp_country."')";
$res3_user=mysql_query($query3_user);
					if($res3_user==false){
	    			echo"Ошибка выполнения запроса.</br>";
					echo mysql_error();
					exit; }


}else{
//обновление


$query4="UPDATE avto_community_fields_values SET value='$tmp_country' WHERE user_id='$avto_tmp_reg' AND field_id='11' ";
$res4=mysql_query($query4);
					if($res4==false){
	    			echo"Ошибка выполнения запроса.</br>";
					echo mysql_error();
					exit; }

}





//город
$q="SELECT * from avto_community_fields_values WHERE user_id=$avto_tmp_reg AND field_id='10'";


$res2_name=mysql_query($q);
					if($res2_name==false){
	    			echo"Ошибка выполнения запроса.</br>";
					echo mysql_error();
					exit; }

$i_tmp=0;

while($row2_name=mysql_fetch_array($res2_name)){

$i_tmp++;
}



if ($i_tmp==0){
//вставка

$query3_user="INSERT INTO avto_community_fields_values (user_id, field_id, value) 
VALUES ('".$avto_tmp_reg."','10','".$tmp_city."')";
$res3_user=mysql_query($query3_user);
					if($res3_user==false){
	    			echo"Ошибка выполнения запроса.</br>";
					echo mysql_error();
					exit; }


}else{
//обновление


$query4="UPDATE avto_community_fields_values SET value='$tmp_city' WHERE user_id='$avto_tmp_reg' AND field_id='10' ";
$res4=mysql_query($query4);
					if($res4==false){
	    			echo"Ошибка выполнения запроса.</br>";
					echo mysql_error();
					exit; }

}




//день рождения
$q="SELECT * from avto_community_fields_values WHERE user_id=$avto_tmp_reg AND field_id='3'";


$res2_name=mysql_query($q);
					if($res2_name==false){
	    			echo"Ошибка выполнения запроса.</br>";
					echo mysql_error();
					exit; }

$i_tmp=0;

while($row2_name=mysql_fetch_array($res2_name)){

$i_tmp++;
}



if ($i_tmp==0){
//вставка

$query3_user="INSERT INTO avto_community_fields_values (user_id, field_id, value) 
VALUES ('".$avto_tmp_reg."','3','".$tmp_dob."')";
$res3_user=mysql_query($query3_user);
					if($res3_user==false){
	    			echo"Ошибка выполнения запроса.</br>";
					echo mysql_error();
					exit; }


}else{
//обновление


$query4="UPDATE avto_community_fields_values SET value='$tmp_dob' WHERE user_id='$avto_tmp_reg' AND field_id='3' ";
$res4=mysql_query($query4);
					if($res4==false){
	    			echo"Ошибка выполнения запроса.</br>";
					echo mysql_error();
					exit; }

}






//телефон
$q="SELECT * from avto_community_fields_values WHERE user_id=$avto_tmp_reg AND field_id='6'";


$res2_name=mysql_query($q);
					if($res2_name==false){
	    			echo"Ошибка выполнения запроса.</br>";
					echo mysql_error();
					exit; }

$i_tmp=0;

while($row2_name=mysql_fetch_array($res2_name)){

$i_tmp++;
}



if ($i_tmp==0){
//вставка

$query3_user="INSERT INTO avto_community_fields_values (user_id, field_id, value) 
VALUES ('".$avto_tmp_reg."','6','".$tmp_phone."')";
$res3_user=mysql_query($query3_user);
					if($res3_user==false){
	    			echo"Ошибка выполнения запроса.</br>";
					echo mysql_error();
					exit; }


}else{
//обновление


$query4="UPDATE avto_community_fields_values SET value='$tmp_phone' WHERE user_id='$avto_tmp_reg' AND field_id='6' ";
$res4=mysql_query($query4);
					if($res4==false){
	    			echo"Ошибка выполнения запроса.</br>";
					echo mysql_error();
					exit; }

}




	
?>

	

	<?php echo $this->loadTemplate('params'); ?>

	<?php echo $this->loadTemplate('custom'); ?>

	<?php if (JFactory::getUser()->id == $this->data->id) : ?>
	<a href="<?php echo JRoute::_('index.php?option=com_users&task=profile.edit&user_id='.(int) $this->data->id);?>"><?php echo JText::_('COM_USERS_Edit_Profile'); ?></a>
	<?php endif; ?>

</div>