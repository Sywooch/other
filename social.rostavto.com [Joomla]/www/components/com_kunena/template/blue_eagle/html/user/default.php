<?php
/**
 * Kunena Component
 * @package Kunena.Template.Blue_Eagle
 * @subpackage User
 *
 * @copyright (C) 2008 - 2012 Kunena Team. All rights reserved.
 * @license http://www.gnu.org/copyleft/gpl.html GNU/GPL
 * @link http://www.kunena.org
 **/
defined ( '_JEXEC' ) or die ();

$this->document->addScriptDeclaration ( "// <![CDATA[
window.addEvent('domready', function(){ $$('dl.tabs').each(function(tabs){ new KunenaTabs(tabs); }); });
// ]]>" );
?>


<?php

//извлечение данных из ближней базы
$user =& JFactory::getUser();

$user_id=$user->id;
$user_login=$user->username; 
	
$tmp_user_name=$user->name;



	$db = JFactory::getDbo();
$query_events_1 = $db->getQuery(true);



$query_events_1->select(array('userid', 'gender', 'birthdate', 'location'));
$query_events_1->from('#__kunena_users');
$query_events_1->where('userid LIKE \''.$user_id.'\'');

$db->setQuery($query_events_1);

$results = $db->loadObjectList();

foreach($results as $element_1) {

$tmp_gender=$element_1->gender;
$tmp_birthdate=$element_1->birthdate;
$tmp_location=$element_1->location;

break;

}



	$db = JFactory::getDbo();
$query_events_2 = $db->getQuery(true);



$query_events_2->select(array('id', 'name', 'email'));
$query_events_2->from('#__users');
$query_events_2->where('id LIKE \''.$user_id.'\'');

$db->setQuery($query_events_2);

$results = $db->loadObjectList();

foreach($results as $element_2) {

$tmp_name=$element_2->name;
$tmp_email=$element_2->email;

break;

}




//вставка

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




if(($tmp_name!="")||($tmp_name!=NULL)){


$query4="UPDATE avto_users SET name='$tmp_name' WHERE id='$avto_tmp_reg'";
$res4=mysql_query($query4);
					if($res4==false){
	    			echo"Ошибка выполнения запроса.</br>";
					echo mysql_error();
					exit; }


}

if(($tmp_email!="")||($tmp_email!=NULL)){


$query4="UPDATE avto_users SET email='$tmp_email' WHERE id='$avto_tmp_reg'";
$res4=mysql_query($query4);
					if($res4==false){
	    			echo"Ошибка выполнения запроса.</br>";
					echo mysql_error();
					exit; }


}


//$tmp_gender
//$tmp_birthdate
//$tmp_location

if(($tmp_gender!="")||($tmp_gender!=NULL)){


$q="SELECT * FROM avto_community_fields_values WHERE user_id=$avto_tmp_reg AND field_id='2'";



$res2_name=mysql_query($q);
					if($res2_name==false){
	    			echo"Ошибка выполнения запроса.</br>";
					echo mysql_error();
					exit; }

$i_tmp=0;

if($tmp_gender=="1"){ $tmp_gender="Муж.";  }
else if($tmp_gender=="2"){ $tmp_gender="Жен.";  }

while($row2_name=mysql_fetch_array($res2_name)){

$i_tmp++;
}



if ($i_tmp==0){
//вставка



$query3_user="INSERT INTO avto_community_fields_values (user_id, field_id, value) 
VALUES ('".$avto_tmp_reg."','2','".$tmp_gender."')";
$res3_user=mysql_query($query3_user);
					if($res3_user==false){
	    			echo"Ошибка выполнения запроса.</br>";
					echo mysql_error();
					exit; }


}else{
//обновление


$query4="UPDATE avto_community_fields_values SET value='$tmp_gender' WHERE user_id='$avto_tmp_reg' AND field_id='2' ";
$res4=mysql_query($query4);
					if($res4==false){
	    			echo"Ошибка выполнения запроса.</br>";
					echo mysql_error();
					exit; }

}





}






if(($tmp_birthdate!="")||($tmp_birthdate!=NULL)){


$q="SELECT * FROM avto_community_fields_values WHERE user_id=$avto_tmp_reg AND field_id='3'";



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
VALUES ('".$avto_tmp_reg."','3','".$tmp_birthdate."')";
$res3_user=mysql_query($query3_user);
					if($res3_user==false){
	    			echo"Ошибка выполнения запроса.</br>";
					echo mysql_error();
					exit; }


}else{
//обновление


$query4="UPDATE avto_community_fields_values SET value='$tmp_birthdate' WHERE user_id='$avto_tmp_reg' AND field_id='3' ";
$res4=mysql_query($query4);
					if($res4==false){
	    			echo"Ошибка выполнения запроса.</br>";
					echo mysql_error();
					exit; }

}




}







if(($tmp_location!="")||($tmp_location!=NULL)){



$q="SELECT * FROM avto_community_fields_values WHERE user_id=$avto_tmp_reg AND field_id='10'";



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
VALUES ('".$avto_tmp_reg."','10','".$tmp_location."')";
$res3_user=mysql_query($query3_user);
					if($res3_user==false){
	    			echo"Ошибка выполнения запроса.</br>";
					echo mysql_error();
					exit; }


}else{
//обновление


$query4="UPDATE avto_community_fields_values SET value='$tmp_location' WHERE user_id='$avto_tmp_reg' AND field_id='10' ";
$res4=mysql_query($query4);
					if($res4==false){
	    			echo"Ошибка выполнения запроса.</br>";
					echo mysql_error();
					exit; }

}



}


?>



<div class="kblock k-profile">
	<div class="kheader">
		<h2><span class="k-name"><?php echo JText::_('COM_KUNENA_USER_PROFILE'); ?> <?php echo $this->profile->getLink(); ?></span>
		<?php if (!empty($this->editlink)) echo '<span class="kheadbtn kright">'.$this->editlink.'</span>';?></h2>
	</div>
	<div class="kcontainer">
		<div class="kbody">
			<table class = "kblocktable" id ="kprofile">
				<tr>
					<td class = "kcol-first kcol-left">
						<div id="kprofile-leftcol">
							<?php $this->displaySummary(); ?>
						</div>
					</td>
					<td class="kcol-mid kcol-right">
						<div id="kprofile-rightcol">
							<?php $this->displayTab(); ?>
						</div>
					</td>
				</tr>
			</table>
		</div>
	</div>
</div>
