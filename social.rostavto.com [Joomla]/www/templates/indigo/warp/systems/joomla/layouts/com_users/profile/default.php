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
//���������� ������ �� ������� ����
$user =& JFactory::getUser();

$user_id=$user->id;
$user_login=$user->username; 
	
$tmp_user_name=$user->name;


//�����	
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




//������	
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



//�������
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


//���� ���������
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
return strtr($path, array("\U0430"=>"�", "\U0431"=>"�", "\U0432"=>"�", 
"\U0433"=>"�", "\U0434"=>"�", "\U0435"=>"�", "\U0451"=>"�", "\U0436"=>"�", "\U0437"=>"�", "\U0438"=>"�", 
"\U0439"=>"�", "\U043A"=>"�", "\U043B"=>"�", "\U043C"=>"�", "\U043D"=>"�", "\U043E"=>"�", "\U043F"=>"�", 
"\U0440"=>"�", "\U0441"=>"�", "\U0442"=>"�", "\U0443"=>"�", "\U0444"=>"�", "\U0445"=>"�", "\U0446"=>"�", 
"\U0447"=>"�", "\U0448"=>"�", "\U0449"=>"�", "\U044A"=>"�", "\U044B"=>"�", "\U044C"=>"�", "\U044D"=>"�", 
"\U044E"=>"�", "\U044F"=>"�", "\U0410"=>"�", "\U0411"=>"�", "\U0412"=>"�", "\U0413"=>"�", "\U0414"=>"�", 
"\U0415"=>"�", "\U0401"=>"�", "\U0416"=>"�", "\U0417"=>"�", "\U0418"=>"�", "\U0419"=>"�", "\U041A"=>"�", 
"\U041B"=>"�", "\U041C"=>"�", "\U041D"=>"�", "\U041E"=>"�", "\U041F"=>"�", "\U0420"=>"�", "\U0421"=>"�", 
"\U0422"=>"�", "\U0423"=>"�", "\U0424"=>"�", "\U0425"=>"�", "\U0426"=>"�", "\U0427"=>"�", "\U0428"=>"�", 
"\U0429"=>"�", "\U042A"=>"�", "\U042B"=>"�", "\U042C"=>"�", "\U042D"=>"�", "\U042E"=>"�", "\U042F"=>"�")); 
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

$dbh=mysql_connect(DB_SERVER_S,DB_USER_S,DB_PASS_S) or die ("���������� ����������� � ��������.");

mysql_select_db(DB_BASE_S) or die ("���������� ������������ � ����.");
mysql_query("set character_set_results='utf8'");
			mysql_query("SET NAMES utf8");
			
mysql_query ("SET COLLATION_CONNECTION=utf8");
mysql_query("SET CHARACTER_SET_CLIENT=utf8");
mysql_query("SET CHARACTER_SET_RESULTS=utf8");	


$query2_name="SELECT * FROM avto_users WHERE username='".$user_login."'";

$res2_name=mysql_query($query2_name);
					if($res2_name==false){
	    			echo"������ ���������� �������.</br>";
					echo mysql_error();
					exit; }

while($row2_name=mysql_fetch_array($res2_name)){

$avto_tmp_reg=$row2_name['id'];//id ������������
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


//������
$q="SELECT * FROM avto_community_fields_values WHERE user_id=$avto_tmp_reg AND field_id='11'";



$res2_name=mysql_query($q);
					if($res2_name==false){
	    			echo"������ ���������� �������.</br>";
					echo mysql_error();
					exit; }

$i_tmp=0;

while($row2_name=mysql_fetch_array($res2_name)){

$i_tmp++;
}



if ($i_tmp==0){
//�������


$query3_user="INSERT INTO avto_community_fields_values (user_id, field_id, value) 
VALUES ('".$avto_tmp_reg."','11','".$tmp_country."')";
$res3_user=mysql_query($query3_user);
					if($res3_user==false){
	    			echo"������ ���������� �������.</br>";
					echo mysql_error();
					exit; }


}else{
//����������


$query4="UPDATE avto_community_fields_values SET value='$tmp_country' WHERE user_id='$avto_tmp_reg' AND field_id='11' ";
$res4=mysql_query($query4);
					if($res4==false){
	    			echo"������ ���������� �������.</br>";
					echo mysql_error();
					exit; }

}





//�����
$q="SELECT * from avto_community_fields_values WHERE user_id=$avto_tmp_reg AND field_id='10'";


$res2_name=mysql_query($q);
					if($res2_name==false){
	    			echo"������ ���������� �������.</br>";
					echo mysql_error();
					exit; }

$i_tmp=0;

while($row2_name=mysql_fetch_array($res2_name)){

$i_tmp++;
}



if ($i_tmp==0){
//�������

$query3_user="INSERT INTO avto_community_fields_values (user_id, field_id, value) 
VALUES ('".$avto_tmp_reg."','10','".$tmp_city."')";
$res3_user=mysql_query($query3_user);
					if($res3_user==false){
	    			echo"������ ���������� �������.</br>";
					echo mysql_error();
					exit; }


}else{
//����������


$query4="UPDATE avto_community_fields_values SET value='$tmp_city' WHERE user_id='$avto_tmp_reg' AND field_id='10' ";
$res4=mysql_query($query4);
					if($res4==false){
	    			echo"������ ���������� �������.</br>";
					echo mysql_error();
					exit; }

}




//���� ��������
$q="SELECT * from avto_community_fields_values WHERE user_id=$avto_tmp_reg AND field_id='3'";


$res2_name=mysql_query($q);
					if($res2_name==false){
	    			echo"������ ���������� �������.</br>";
					echo mysql_error();
					exit; }

$i_tmp=0;

while($row2_name=mysql_fetch_array($res2_name)){

$i_tmp++;
}



if ($i_tmp==0){
//�������

$query3_user="INSERT INTO avto_community_fields_values (user_id, field_id, value) 
VALUES ('".$avto_tmp_reg."','3','".$tmp_dob."')";
$res3_user=mysql_query($query3_user);
					if($res3_user==false){
	    			echo"������ ���������� �������.</br>";
					echo mysql_error();
					exit; }


}else{
//����������


$query4="UPDATE avto_community_fields_values SET value='$tmp_dob' WHERE user_id='$avto_tmp_reg' AND field_id='3' ";
$res4=mysql_query($query4);
					if($res4==false){
	    			echo"������ ���������� �������.</br>";
					echo mysql_error();
					exit; }

}






//�������
$q="SELECT * from avto_community_fields_values WHERE user_id=$avto_tmp_reg AND field_id='6'";


$res2_name=mysql_query($q);
					if($res2_name==false){
	    			echo"������ ���������� �������.</br>";
					echo mysql_error();
					exit; }

$i_tmp=0;

while($row2_name=mysql_fetch_array($res2_name)){

$i_tmp++;
}



if ($i_tmp==0){
//�������

$query3_user="INSERT INTO avto_community_fields_values (user_id, field_id, value) 
VALUES ('".$avto_tmp_reg."','6','".$tmp_phone."')";
$res3_user=mysql_query($query3_user);
					if($res3_user==false){
	    			echo"������ ���������� �������.</br>";
					echo mysql_error();
					exit; }


}else{
//����������


$query4="UPDATE avto_community_fields_values SET value='$tmp_phone' WHERE user_id='$avto_tmp_reg' AND field_id='6' ";
$res4=mysql_query($query4);
					if($res4==false){
	    			echo"������ ���������� �������.</br>";
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