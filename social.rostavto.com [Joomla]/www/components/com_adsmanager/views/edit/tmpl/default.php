<?php
// Check to ensure this file is within the rest of the framework
defined('JPATH_BASE') or die();
 
if (isset($this->warning_text))
	echo $this->warning_text;
if (isset($this->error_text))
	echo $this->error_text;
echo JText::_('ADSMANAGER_RULESREAD');
?>


<?php
//запрос к базе соц. сети и извлечение полей 
//"Имя", "Email", "Телефон", "Город"





 $user = JFactory::getUser(); 




if ( ((!isset($_GET['user_social']))||($_GET['user_social']=="")||($_GET['user_social']==NULL))&&((!isset($_GET['model']))||($_GET['model']=="")||($_GET['model']==NULL)) ){
//пользователь попал на страницу не из социальной сети


/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

 $user = JFactory::getUser(); 

if ($user->guest) {


}else{


$db = JFactory::getDbo();
$query_events_h = $db->getQuery(true);

$query_events_h->select(array('id', 'username'));
$query_events_h->from('#__users');
$query_events_h->where('id LIKE \''.($user->id).'\'');

$db->setQuery($query_events_h);

$resultsh = $db->loadObjectList();

foreach($resultsh as $element_h) {
$rostavto_login=$element_h->username;

break;
}



require '/config_db_social/config.php';

$dbh=mysql_connect(DB_SERVER_S,DB_USER_S,DB_PASS_S) or die ("Невозможно соединиться с сервером.");

mysql_select_db(DB_BASE_S) or die ("Невозможно подключиться к базе.");
mysql_query("set character_set_results='utf8'");
			mysql_query("SET NAMES utf8");
			
mysql_query ("SET COLLATION_CONNECTION=utf8");
mysql_query("SET CHARACTER_SET_CLIENT=utf8");
mysql_query("SET CHARACTER_SET_RESULTS=utf8");


$query_ra="SELECT * FROM avto_users WHERE username='".($rostavto_login)."'";

$res_ra=mysql_query($query_ra);
					if($res_ra==false){
	    			echo"Ошибка выполнения запроса.</br>";
					echo mysql_error();
					exit; }

while($row_ra=mysql_fetch_array($res_ra)){

$social_id=$row_ra['id'];
$social_name=$row_ra['name'];
$social_email=$row_ra['email'];

//echo"".$social_id."<br>";
//echo"".$social_name."<br>";
//echo"".$social_email."<br>";

break;
}




$query_ra_1="SELECT * FROM avto_community_fields_values WHERE user_id='".($social_id)."' AND field_id='6'";
$res_ra_1=mysql_query($query_ra_1);
					if($res_ra_1==false){
	    			echo"Ошибка выполнения запроса.</br>";
					echo mysql_error();
					exit; }
$row_ra_1=mysql_fetch_array($res_ra_1);
$social_phone=$row_ra_1['value'];

					

$query_ra_2="SELECT * FROM avto_community_fields_values WHERE user_id='".($social_id)."' AND field_id='10'";
$res_ra_2=mysql_query($query_ra_2);
					if($res_ra_2==false){
	    			echo"Ошибка выполнения запроса.</br>";
					echo mysql_error();
					exit; }
$row_ra_2=mysql_fetch_array($res_ra_2);
$social_city=$row_ra_2['value'];	

//echo"".$social_phone."<br>";
//echo"".$social_city."<br>";
			



}

?>






<script type="text/javascript">
function CaracMax(text, max)
{
	if (text.value.length >= max)
	{
		text.value = text.value.substr(0, max - 1) ;
	}
}

function checkEnter(e){
	 e = e || event;
	 if(e.keyCode == 13 && e.target.nodeName!='TEXTAREA')
     {
       e.preventDefault();
       return false;
     }
}

function submitbutton(mfrm) {
	
	var me = mfrm.elements;
	var r = new RegExp("[\<|\>|\"|\'|\%|\;|\(|\)|\&|\+|\-]", "i");
	var r_num = new RegExp("[^0-9\., ]", "i");
	var r_email = new RegExp("^[a-zA-Z0-9._-]+@[a-zA-Z0-9.-]{2,}[.][a-zA-Z]{2,3}$" ,"i");

	var errorMSG = '';
	var iserror=0;
	
	<?php 
	if (function_exists("loadEditFormCheck")){
		loadEditFormCheck();
	}
	?>
	
	<?php if ($this->nbcats > 1)
	{
	?>
		var form = document.adminForm;
		var srcList = eval( 'form.selected_cats' );
		var srcLen = srcList.length;
		if (srcLen == 0)
		{
			errorMSG += <?php echo json_encode(JText::_('ADSMANAGER_FORM_CATEGORY')); ?>+" : "+<?php echo json_encode(JText::_('ADSMANAGER_REGWARN_ERROR')); ?>+'\n';
			srcList.style.background = "red";
			iserror=1;
		}
		else
		{
			for (var i=0; i < srcLen; i++) {
				srcList.options[i].selected = true;
			}
		}
	<?php
	}
	?>
	
	if (mfrm.username && (r.exec(mfrm.username.value) || mfrm.username.value.length < 3)) {
		errorMSG += mfrm.username.getAttribute('mosLabel').replace('&nbsp;',' ') + ' : '+<?php echo json_encode(sprintf( JText::_('ADSMANAGER_VALID_AZ09'), JText::_('ADSMANAGER_PROMPT_UNAME'), 4 )); ?>+'\n';
		mfrm.username.style.background = "red";
		iserror=1;
	} 
	if (mfrm.password && r.exec(mfrm.password.value)) {
		errorMSG += mfrm.password.getAttribute('mosLabel').replace('&nbsp;',' ') + ' : '+<?php echo json_encode(sprintf( JText::_('ADSMANAGER_VALID_AZ09'), JText::_('ADSMANAGER_REGISTER_PASS'), 6 )); ?>+'\n';
		mfrm.password.style.background = "red";
		iserror=1;
	}
	
	if (mfrm.email && !r_email.exec(mfrm.email.value) && mfrm.email.getAttribute('mosReq')) {
		errorMSG += mfrm.email.getAttribute('mosLabel').replace('&nbsp;',' ') + ' : '+<?php echo json_encode(JText::_('ADSMANAGER_REGWARN_EMAIL')); ?>+'\n';
		mfrm.email.style.background = "red";
		iserror=1;
	}
				
	// loop through all input elements in form
	for (var i=0; i < me.length; i++) {
	
		if ((me[i].getAttribute('test') == 'number' ) && (r_num.exec(me[i].value))) {
			errorMSG += me[i].getAttribute('mosLabel').replace('&nbsp;',' ') + ' : '+<?php echo json_encode(JText::_('ADSMANAGER_REGWARN_NUMBER')); ?>+'\n';
			iserror=1;
		}
		
		// check if element is mandatory; here mosReq="1"
		if ((me[i].getAttribute('mosReq') == 1)&&(me[i].type == 'hidden')&&(me[i].value == '')) {
			// add up all error messages
			errorMSG += me[i].getAttribute('mosLabel').replace('&nbsp;',' ') + ' : '+<?php echo json_encode(JText::_('ADSMANAGER_REGWARN_ERROR')); ?>+'\n';
			// notify user by changing background color, in this case to red
			el = me[i].getAttribute('mosElem');

			elem = document.getElementById(el);
			elem.style.background = "red";
			iserror=1;
		} else if ((me[i].getAttribute('mosReq') == 1)&&(me[i].style.visibility != 'hidden')) {
			if (me[i].type == 'radio' || me[i].type == 'checkbox') {
				var rOptions = me[me[i].getAttribute('name')];
				var rChecked = 0;
				if(rOptions.length > 1) {
					for (var r=0; r < rOptions.length; r++) {
						if (rOptions[r].checked) {
							rChecked=1;
						}
					}
				} else {
					if (me[i].checked) {
						rChecked=1;
					}
				}
				if(rChecked==0) {
					// add up all error messages
					errorMSG += me[i].getAttribute('mosLabel').replace('&nbsp;',' ') + ' : '+<?php echo json_encode(JText::_('ADSMANAGER_REGWARN_ERROR')); ?>+'\n';
					// notify user by changing background color, in this case to red
					me[i].style.background = "red";
					iserror=1;
				} 
			}
			if (me[i].value == '') {
				// add up all error messages
				errorMSG += me[i].getAttribute('mosLabel').replace('&nbsp;',' ') + ' : '+<?php echo json_encode(JText::_('ADSMANAGER_REGWARN_ERROR')); ?>+'\n';
				// notify user by changing background color, in this case to red
				me[i].style.background = "red";
				iserror=1;
			} 
		}
	}
	
	if(iserror==1) {
		alert(errorMSG);
		return false;
	} else {
		 var uploader = jQ('#uploader').pluploadQueue();
			
        // Files in queue upload them first
        if (uploader.files.length > 0) {
            // When all files are uploaded submit form
            uploader.bind('StateChanged', function() {
                if (uploader.files.length === (uploader.total.uploaded + uploader.total.failed)) {
                	//Little hack to be able to return the selected_cats
            		<?php if ($this->nbcats > 1) { ?>
            		var srcList = eval( 'form.selected_cats' );
            		srcList.name = "selected_cats[]"; 
            		<?php } ?>
            		jQ('#adminForm')[0].submit();
                }
            });
                
            uploader.start();
            return false;
        }  
	        
		//Little hack to be able to return the selected_cats
		<?php if ($this->nbcats > 1) { ?>
			srcList.name = "selected_cats[]"; 
		<?php } ?>
		return true;
	}
}

function updateFields() {
	var form = document.adminForm;
	var singlecat = 0;
	var length = 0;
	
	if ( typeof(document.adminForm.category ) != "undefined" ) {
		singlecat = 1;
		length = 1;
	}
	else
	{
		length = form.selected_cats.length;
	}
	
	<?php
	foreach($this->fields as $field)
	{ 
		if (strpos($field->catsid, ",-1,") === false)
		{
			$name = $field->name;
			if (($field->type == "multicheckbox")||($field->type == "multiselect"))
				$name .= "[]";
		?>
		var input = document.getElementById('<?php echo $name;?>');
		var trzone = document.getElementById('tr_<?php echo $field->name;?>');
		if (((singlecat == 0)&&(length == 0))||
		    ((singlecat == 1)&&(document.adminForm.category.value == 0)))
		{
			if (input != null)
				input.style.visibility = 'hidden';
			trzone.style.visibility = 'hidden';
			trzone.style.display = 'none';
		}
		else
		{
			for (var i=0; i < length; i++) {
				var field_<?php echo $field->name;?> = '<?php echo $field->catsid;?>';
				var temp;
				if (singlecat == 0)
					temp = form.selected_cats.options[i].value;
				else
					temp = document.adminForm.category.value;
					
				var test = field_<?php echo $field->name;?>.indexOf( ","+temp+",", 0 );
				if (test != -1)
				{
					if (input != null)
						input.style.visibility = 'visible';
					trzone.style.visibility = 'visible';
					trzone.style.display = '';
					break;
				}
				else
				{
					if (input != null)
						input.style.visibility = 'hidden';
					trzone.style.visibility = 'hidden';
					trzone.style.display = 'none';
				}
			}
		}
	<?php
		}
	} 
	?>
}
</script>

<fieldset id="adsmanager_fieldset">
	<!-- titel -->
	<legend>
	<?php
	 if($this->isUpdateMode) {
	   echo JText::_('ADSMANAGER_CONTENT_EDIT');
	 }
	 else {
	   echo JText::_('ADSMANAGER_CONTENT_WRITE');
	 }
	 ?>
	</legend>
	<!-- titel -->
  <!-- form -->
 
<!--список автомобилей пользователя-->  
   
<?php

//$social_id

 $user = JFactory::getUser(); 

if ($user->guest) {


}else{

$query_ra_models="SELECT * FROM avto_community_fields_values WHERE user_id='".($social_id)."' AND field_id='17'";
$res_ra_models=mysql_query($query_ra_models);
					if($res_ra_models==false){
	    			echo"Ошибка выполнения запроса.</br>";
					echo mysql_error();
					exit; }
$row_ra_models=mysql_fetch_array($res_ra_models);
$social_models=$row_ra_models['value'];	


$MAS_social_models=explode(",",$social_models);

echo'
<script type="text/javascript">

function insert_title(n)
{

//alert(n);
//document.getElementById(\'ad_headline\').value =  "123";

var arr = n.split(/[+]/);
  //for (var i=0,len=arr.length;i<len;i++) {
  //  alert(arr[i]);
 
 // }

document.getElementById(\'ad_amarka\').value =  arr[0];

document.getElementById(\'ad_kuzov\').value =  arr[1];

document.getElementById(\'ad_year\').value =  arr[4];

document.getElementById(\'ad_type\').value =  arr[2];

document.getElementById(\'ad_litr\').value =  arr[3];

document.getElementById(\'ad_rul\').value =  arr[6];

document.getElementById(\'ad_color\').value =  arr[5];

document.getElementById(\'ad_korobka\').value =  arr[7];

document.getElementById(\'ad_privod\').value =  arr[8];



}

</script>
';



echo'Вы можете выбрать одну из своих машин: <select id="user_models" onchange="insert_title(this.value)">
<option value=""></option>
';
for ($i = 0; $i < (count($MAS_social_models)-1); $i++) 
{ 


$model_1=$MAS_social_models[$i];




$query_2_tmp="SELECT * FROM avto_adsmanager_ads WHERE userid='".($social_id)."' AND ad_model='".$model_1."'";

$res_2_tmp=mysql_query($query_2_tmp);
					if($res_2_tmp==false){
	    			echo"Ошибка выполнения запроса.</br>";
					echo mysql_error();
					exit; }

$row_2_tmp=mysql_fetch_array($res_2_tmp);


$ad_model_tmp=$model_1;
$ad_tipkuzova_tmp=$row_2_tmp['ad_tipkuzova'];
$ad_tipdvigatelya_tmp=$row_2_tmp['ad_tipdvigatelya'];
$ad_objemdvigatelya_tmp=$row_2_tmp['ad_objemdvigatelya'];
$ad_godvipuska_tmp=$row_2_tmp['ad_godvipuska'];
$ad_cviet_tmp=$row_2_tmp['ad_cviet'];
$ad_rul_tmp=$row_2_tmp['ad_rul'];
$ad_korobkaperedach_tmp=$row_2_tmp['ad_korobkaperedach'];
$ad_privod_tmp=$row_2_tmp['ad_privod'];
$ad_obshiiprobeg_tmp=$row_2_tmp['ad_obshiiprobeg'];




$db = JFactory::getDbo();
$query_events_3 = $db->getQuery(true);

$query_events_3->select(array('fieldid', 'fieldtitle', 'fieldvalue'));
$query_events_3->from('#__adsmanager_field_values');
$query_events_3->where('fieldid LIKE \'11\'');

$db->setQuery($query_events_3);

$results3 = $db->loadObjectList();
$ad_model_tmp2="";
foreach($results3 as $element_3) {

$pos = strpos($ad_model_tmp, ($element_3->fieldtitle) );
if ($pos === false) {


}else{
	
$ad_model_tmp2=($element_3->fieldvalue);
	
	break;	
	
}

}



switch($ad_tipkuzova_tmp)
{
case 1:
$ad_tipkuzova_tmp="Седан";
break;

case 2:
$ad_tipkuzova_tmp="Хетчбек";
break;

case 3:
$ad_tipkuzova_tmp="Универсал";
break;

case 4:
$ad_tipkuzova_tmp="Внедорожник";
break;

case 5:
$ad_tipkuzova_tmp="Кабриолет";
break;

case 6:
$ad_tipkuzova_tmp="Кроссовер";
break;

case 7:
$ad_tipkuzova_tmp="Купе";
break;

case 8:
$ad_tipkuzova_tmp="Лимузин";
break;

case 9:
$ad_tipkuzova_tmp="Минивен";
break;

case 10:
$ad_tipkuzova_tmp="Пикап";
break;

case 11:
$ad_tipkuzova_tmp="Фургон";
break;

case 12:
$ad_tipkuzova_tmp="Микроавтобус";
break;

}






$query_events_4 = $db->getQuery(true);

$query_events_4->select(array('fieldid', 'fieldtitle', 'fieldvalue'));
$query_events_4->from('#__adsmanager_field_values');
$query_events_4->where('fieldid LIKE \'13\'');

$db->setQuery($query_events_4);

$results4 = $db->loadObjectList();
$ad_tipkuzova_tmp2="";
foreach($results4 as $element_4) {

//echo "--- ".($element_4->fieldtitle)."<br>";
//echo "--- ".($ad_tipkuzova)."<br>";

if(($element_4->fieldtitle)==$ad_tipkuzova_tmp){


$ad_tipkuzova_tmp2=($element_4->fieldvalue);



}

}



//$ad_godvipuska_tmp




$query_events_god = $db->getQuery(true);

$query_events_god->select(array('fieldid', 'fieldtitle', 'fieldvalue'));
$query_events_god->from('#__adsmanager_field_values');
$query_events_god->where('fieldid LIKE \'12\'');

$db->setQuery($query_events_god);

$resultsgod = $db->loadObjectList();
$ad_godvipuska_tmp2="";
foreach($resultsgod as $element_god) {

//echo "--- ".($element_god->fieldtitle)."<br>";
//echo "--- ".($ad_objemdvigatelya)."<br>";

if(($element_god->fieldtitle)==$ad_godvipuska_tmp){



$ad_godvipuska_tmp2=($element_god->fieldvalue);


}

}






switch($ad_tipdvigatelya_tmp)
{
case 1:
$ad_tipdvigatelya_tmp="Бензиновый";
break;

case 2:
$ad_tipdvigatelya_tmp="Дизельный";
break;

case 3:
$ad_tipdvigatelya_tmp="Гибридный";
break;

}




//echo"".$ad_tipdvigatelya."<br>";



$query_events_5 = $db->getQuery(true);

$query_events_5->select(array('fieldid', 'fieldtitle', 'fieldvalue'));
$query_events_5->from('#__adsmanager_field_values');
$query_events_5->where('fieldid LIKE \'15\'');

$db->setQuery($query_events_5);

$results5 = $db->loadObjectList();
$ad_tipdvigatelya_tmp2="";
foreach($results5 as $element_5) {

//echo "--- ".($element_5->fieldtitle)."<br>";
//echo "--- ".($ad_tipdvigatelya)."<br>";

if(($element_5->fieldtitle)==$ad_tipdvigatelya_tmp){




$ad_tipdvigatelya_tmp2=($element_5->fieldvalue);




}

}





switch($ad_objemdvigatelya_tmp)
{
case 1:
$ad_objemdvigatelya_tmp="0.8";
break;

case 2:
$ad_objemdvigatelya_tmp="0.9";
break;

case 3:
$ad_objemdvigatelya_tmp="1.0";
break;

case 4:
$ad_objemdvigatelya_tmp="1.1";
break;

case 5:
$ad_objemdvigatelya_tmp="1.2";
break;

case 6:
$ad_objemdvigatelya_tmp="1.3";
break;

case 7:
$ad_objemdvigatelya_tmp="1.4";
break;

case 8:
$ad_objemdvigatelya_tmp="1.5";
break;

case 9:
$ad_objemdvigatelya_tmp="1.6";
break;

case 10:
$ad_objemdvigatelya_tmp="1.7";
break;

case 11:
$ad_objemdvigatelya_tmp="1.8";
break;

case 12:
$ad_objemdvigatelya_tmp="1.9";
break;

case 13:
$ad_objemdvigatelya_tmp="2.0";
break;

case 14:
$ad_objemdvigatelya_tmp="2.1";
break;

case 15:
$ad_objemdvigatelya_tmp="2.2";
break;

case 16:
$ad_objemdvigatelya_tmp="2.3";
break;

case 17:
$ad_objemdvigatelya_tmp="2.4";
break;

case 18:
$ad_objemdvigatelya_tmp="2.5";
break;

case 19:
$ad_objemdvigatelya_tmp="2.6";
break;

case 20:
$ad_objemdvigatelya_tmp="2.7";
break;

case 21:
$ad_objemdvigatelya_tmp="2.8";
break;

case 22:
$ad_objemdvigatelya_tmp="2.9";
break;

case 23:
$ad_objemdvigatelya_tmp="3.0";
break;

case 24:
$ad_objemdvigatelya_tmp="3.1";
break;

case 25:
$ad_objemdvigatelya_tmp="3.2";
break;

case 26:
$ad_objemdvigatelya_tmp="3.3";
break;

case 27:
$ad_objemdvigatelya_tmp="3.4";
break;

case 28:
$ad_objemdvigatelya_tmp="3.5";
break;

case 29:
$ad_objemdvigatelya_tmp="3.6";
break;

case 30:
$ad_objemdvigatelya_tmp="3.7";
break;

case 31:
$ad_objemdvigatelya_tmp="3.8";
break;

case 32:
$ad_objemdvigatelya_tmp="3.9";
break;

case 33:
$ad_objemdvigatelya_tmp="4.0";
break;

case 34:
$ad_objemdvigatelya_tmp="4.1";
break;

case 35:
$ad_objemdvigatelya_tmp="4.2";
break;

case 36:
$ad_objemdvigatelya_tmp="4.3";
break;

case 37:
$ad_objemdvigatelya_tmp="4.4";
break;

case 38:
$ad_objemdvigatelya_tmp="4.5";
break;

case 39:
$ad_objemdvigatelya_tmp="4.6";
break;

case 40:
$ad_objemdvigatelya_tmp="4.7";
break;

case 41:
$ad_objemdvigatelya_tmp="4.8";
break;

case 42:
$ad_objemdvigatelya_tmp="4.9";
break;

case 43:
$ad_objemdvigatelya_tmp="5.0";
break;

case 44:
$ad_objemdvigatelya_tmp="5.1";
break;

case 45:
$ad_objemdvigatelya_tmp="5.2";
break;

case 46:
$ad_objemdvigatelya_tmp="5.3";
break;

case 47:
$ad_objemdvigatelya_tmp="5.4";
break;

case 48:
$ad_objemdvigatelya_tmp="5.5";
break;

case 49:
$ad_objemdvigatelya_tmp="5.6";
break;

case 50:
$ad_objemdvigatelya_tmp="5.7";
break;

case 51:
$ad_objemdvigatelya_tmp="5.8";
break;

case 52:
$ad_objemdvigatelya_tmp="5.9";
break;

case 53:
$ad_objemdvigatelya_tmp="6.0";
break;

}



//echo"".$ad_objemdvigatelya."<br>";





$query_events_6 = $db->getQuery(true);

$query_events_6->select(array('fieldid', 'fieldtitle', 'fieldvalue'));
$query_events_6->from('#__adsmanager_field_values');
$query_events_6->where('fieldid LIKE \'14\'');

$db->setQuery($query_events_6);

$results6 = $db->loadObjectList();
$ad_objemdvigatelya_tmp2="";
foreach($results6 as $element_6) {

//echo "--- ".($element_6->fieldtitle)."<br>";
//echo "--- ".($ad_objemdvigatelya)."<br>";

if(($element_6->fieldtitle)==$ad_objemdvigatelya_tmp){



$ad_objemdvigatelya_tmp2=($element_6->fieldvalue);
	

}

}








switch($ad_rul_tmp)
{
case 1:
$ad_rul_tmp="Левый";
break;

case 2:
$ad_rul_tmp="Правый";
break;

}
//echo"".$ad_rul."<br>";


$query_events_8 = $db->getQuery(true);

$query_events_8->select(array('fieldid', 'fieldtitle', 'fieldvalue'));
$query_events_8->from('#__adsmanager_field_values');
$query_events_8->where('fieldid LIKE \'16\'');

$db->setQuery($query_events_8);

$results8 = $db->loadObjectList();
$ad_rul_tmp2="";
foreach($results8 as $element_8) {

//echo "--- ".($element_8->fieldtitle)."<br>";
//echo "--- ".($ad_rul)."<br>";

if(($element_8->fieldtitle)==$ad_rul_tmp){



$ad_rul_tmp2=($element_8->fieldvalue);

break;	

}

}







switch($ad_cviet_tmp)
{
case 1:
$ad_cviet_tmp="Бежевый";
break;

case 2:
$ad_cviet_tmp="Белый";
break;

case 3:
$ad_cviet_tmp="Голубой";
break;

case 4:
$ad_cviet_tmp="Жёлтый";
break;

case 5:
$ad_cviet_tmp="Зелёный";
break;

case 6:
$ad_cviet_tmp="Золотой";
break;

case 7:
$ad_cviet_tmp="Коричневый";
break;

case 8:
$ad_cviet_tmp="Красный";
break;

case 9:
$ad_cviet_tmp="Оранжевый";
break;

case 10:
$ad_cviet_tmp="Пурпурный";
break;

case 11:
$ad_cviet_tmp="Розовый";
break;

case 12:
$ad_cviet_tmp="Серебряный";
break;

case 13:
$ad_cviet_tmp="Серый";
break;

case 14:
$ad_cviet_tmp="Синий";
break;

case 15:
$ad_cviet_tmp="Филетовый";
break;

case 16:
$ad_cviet_tmp="Чёрный";
break;

}
//echo"".$ad_cviet."<br>";


$query_events_7 = $db->getQuery(true);

$query_events_7->select(array('fieldid', 'fieldtitle', 'fieldvalue'));
$query_events_7->from('#__adsmanager_field_values');
$query_events_7->where('fieldid LIKE \'18\'');

$db->setQuery($query_events_7);

$results7 = $db->loadObjectList();
$ad_cviet_tmp2="";
foreach($results7 as $element_7) {

//echo "--- ".($element_7->fieldtitle)."<br>";
//echo "--- ".($ad_cviet)."<br>";

if(($element_7->fieldtitle)==$ad_cviet_tmp){



$ad_cviet_tmp2=($element_7->fieldvalue);

break;	

}

}







switch($ad_korobkaperedach_tmp)
{
case 1:
$ad_korobkaperedach_tmp="Автоматическая";
break;

case 2:
$ad_korobkaperedach_tmp="Механическая";
break;

case 3:
$ad_korobkaperedach_tmp="Вариатор";
break;

case 4:
$ad_korobkaperedach_tmp="Робот";
break;

}
//echo"".$ad_korobkaperedach."<br>";





$query_events_9 = $db->getQuery(true);

$query_events_9->select(array('fieldid', 'fieldtitle', 'fieldvalue'));
$query_events_9->from('#__adsmanager_field_values');
$query_events_9->where('fieldid LIKE \'19\'');

$db->setQuery($query_events_9);

$results9 = $db->loadObjectList();
$ad_korobkaperedach_tmp2="";
foreach($results9 as $element_9) {

//echo "--- ".($element_9->fieldtitle)."<br>";
//echo "--- ".($ad_korobkaperedach)."<br>";

if(($element_9->fieldtitle)==$ad_korobkaperedach_tmp){



$ad_korobkaperedach_tmp2=($element_9->fieldvalue);

break;	

}

}





switch($ad_privod_tmp)
{
case 1:
$ad_privod_tmp="Передний";
break;

case 2:
$ad_privod_tmp="Задний";
break;

case 3:
$ad_privod_tmp="Полный";
break;


}


//echo"".$ad_privod."<br>";



$query_events_10 = $db->getQuery(true);

$query_events_10->select(array('fieldid', 'fieldtitle', 'fieldvalue'));
$query_events_10->from('#__adsmanager_field_values');
$query_events_10->where('fieldid LIKE \'20\'');

$db->setQuery($query_events_10);

$results10 = $db->loadObjectList();
$ad_privod_tmp2="";
foreach($results10 as $element_10) {

//echo "--- ".($element_10->fieldtitle)."<br>";
//echo "--- ".($ad_privod)."<br>";

if(($element_10->fieldtitle)==$ad_privod_tmp){




$ad_privod_tmp2=($element_10->fieldvalue);

break;	

}

}





echo'<option value="'.$ad_model_tmp2.'+'.$ad_tipkuzova_tmp2.'+'.$ad_tipdvigatelya_tmp2.'+'.$ad_objemdvigatelya_tmp2.'+'.$ad_godvipuska_tmp2.'+'.$ad_cviet_tmp2.'+'.$ad_rul_tmp2.'+'.$ad_korobkaperedach_tmp2.'+'.$ad_privod_tmp2.'+'.$ad_obshiiprobeg_tmp.'">'.$MAS_social_models[$i].'</option>';


   
} 
echo'</select><br><br>';









}

?>   
   


   
  
<!--список автомобилей пользователя-->
   
   <!-- category -->
   
   <table border='0' id="adformtable" style="background-color:transparent;">
   <tr name='category'>
	<td width="100"><?php echo JText::_('ADSMANAGER_FORM_CATEGORY'); ?></td>
	<td>
	<?php
	  $target = TRoute::_("index.php?option=com_adsmanager&task=save"); 
	  if ($this->nbcats == 1)
	  {
		$this->displaySingleCatChooser(@$this->content->id,$this->conf,"com_adsmanager",$this->cats,$this->catid);
		?>
		</td></tr></table>
		<form action="<?php echo $target;?>" method="post" name="adminForm" id="adminForm" enctype="multipart/form-data" onkeypress="return checkEnter(event)" onsubmit="return submitbutton(this)">
		<table border='0' id="adformtable">
		<?php
		echo "<input type='hidden' name='category' value='$this->catid' />";
		
	  }
	  else
	  {
		?>
		</td></tr></table>
   		<form action="<?php echo $target;?>" method="post" name="adminForm" id="adminForm" enctype="multipart/form-data" onsubmit="return submitbutton(this)">
   		<table border='0' id="adformtable">
   		<tr name='category'>
		<td colspan="2">
		<?php
		if (!isset($this->content->catsid))
			$this->content->catsid = 0;
		$this->displayMultipleCatsChooser($this->content->catsid,$this->cats,$this->conf,"com_adsmanager");
	  	?></td></tr><?php 
	  }
	?>
	<!-- fields -->
	<?php
	

	
	
	
	?>
	<?php
	if (($this->nbcats != 1)||(!isset($this->catid))||($this->catid != 0))
	{
		/* Submission_type == 0 -> Account Creation with ad posting */
		if ($this->account_creation == 1)
		{
			echo "<tr><td colspan='2'>".JText::_('ADSMANAGER_AUTOMATIC_ACCOUNT')."</td></tr>";
			echo "<tr><td>".JText::_('ADSMANAGER_UNAME')."</td>\n";
			if (isset($this->content->username))
			{
				$username = $this->content->username;
				$password = $this->content->password;
				$email = $this->content->email;
				$name = $this->content->name;
				$style = 'style="background-color:#ff0000"';
			}
			else
			{
				$username = "";
				$password = "";
				$email = "";
				$name =  "";
				$style = "";
			}
								
			if (isset($this->content->firstname))
				$firstname = $this->content->firstname;
			else
				$firstname = "";
			
			if (isset($this->content->middlename))
				$middlename = $this->content->middlename;
			else
				$middlename = "";
			
			if (COMMUNITY_BUILDER == 1)
			{
				include_once( JPATH_BASE .'/administrator/components/com_comprofiler/ue_config.php' );
				$namestyle = $ueConfig['name_style'];
			}
			else
				$namestyle = 1;
				
			echo "<td><input $style class='adsmanager_required' mosReq='1' id='username' type='text' mosLabel='".htmlspecialchars(JText::_('ADSMANAGER_UNAME'),ENT_QUOTES)."' name='username' size='20' maxlength='20' value='$username' /></td></tr>\n"; 
			
			echo "<tr><td>".JText::_('ADSMANAGER_PASSWORD')."</td>\n";
			echo "<td><input $style class='adsmanager_required' mosReq='1' id='password' type='password' mosLabel='".htmlspecialchars(JText::_('ADSMANAGER_PASS'),ENT_QUOTES)."' name='password' size='20' maxlength='20' value='$password' />\n</td></tr>"; 
			$emailField = false;
			$nameField = false;
			foreach($this->fields as $field) 
			{
				if (($field->name == "email")&&((strpos($field->catsid, ",$this->catid,") !== false)||(strpos($field->catsid, ",-1,") !== false)))
				{
					$emailField = true;
					// Force required 
					$field->required = 1;
				}
				else if (($field->name == "name")&&((strpos($field->catsid, ",$this->catid,") !== false)||(strpos($field->catsid, ",-1,") !== false)))
				{
					$nameField = true;
					// Force required 
					$field->required = 1;
				}
				else if (($namestyle >= 2)&&($field->name == "firstname")&&((strpos($field->catsid, ",$this->catid,") !== false)||(strpos($field->catsid, ",-1,") !== false)))
				{
					$firstnameField = true;
					// Force required 
					$field->required = 1;
				}
				else if( ($namestyle == 3)&&($field->name == "middlename")&&((strpos($field->catsid, ",$this->catid,") !== false)||(strpos($field->catsid, ",-1,") !== false)))
				{
					$middlenameField = true;
					// Force required 
					$field->required = 1;
				}			
			}
			if (($namestyle >= 2)&&($firstnameField == false))
			{
				echo "<tr><td>".JText::_('ADSMANAGER_FNAME')."</td>\n";
				echo "<td><input $style class='adsmanager_required' mosReq='1' id='firstname' type='text' mosLabel='".htmlspecialchars(JText::_('ADSMANAGER_FNAME'),ENT_QUOTES)."' name='firstname' size='20' maxlength='20' value='$firstname' /></td></tr>\n"; 
			}
			if ( ($namestyle == 3)&&($middlenameField == false))
			{
				echo "<tr><td>".JText::_('ADSMANAGER_MNAME')."</td>\n";
				echo "<td><input $style class='adsmanager_required' mosReq='1' id='middlename' type='text' mosLabel='".htmlspecialchars(JText::_('ADSMANAGER_MNAME'),ENT_QUOTES)."' name='middlename' size='20' maxlength='20' value='$middlename' /></td></tr>\n"; 
			}
			if ($nameField == false)
			{
				echo "<tr><td>".JText::_('ADSMANAGER_FORM_NAME')."</td>\n";
				echo "<td><input $style class='adsmanager_required' mosReq='1' id='name' type='text' mosLabel='".htmlspecialchars(JText::_('_NAME'),ENT_QUOTES)."' name='name' size='20' maxlength='20' value='$name' /></td></tr>\n"; 
			}
			if ($emailField == false)
			{
				echo "<tr><td>".JText::_('ADSMANAGER_FORM_EMAIL')."</td>\n";
				echo "<td><input $style class='adsmanager_required' mosReq='1' id='email' type='text' mosLabel='".htmlspecialchars(JText::_('_EMAIL'),ENT_QUOTES)."' name='email' size='20' maxlength='20' value='$email' /></td></tr>\n"; 
			}
		}




		
/* Display Fields */
		foreach($this->fields as $field)
		{
			$fieldform = $this->field->showFieldForm($field,$this->content,$this->default);
			if ($fieldform != "") {
				echo "<tr id=\"tr_{$field->name}\"><td>".$this->field->showFieldLabel($field,$this->content,$this->default)."</td>\n";
				echo "<td>".$fieldform."</td></tr>\n";
			}
		}	
		//echo $this->field->showFieldForm($this->fields['ad_price'],$this->content,$this->default);
		?>
		
		
		
		
		
		
		
		
<div id="adsmanager_writead_header">

			<?php /*
			foreach($this->searchfields as $fsearch) {
				$title = $this->field->showFieldTitle($this->catid,$fsearch);
				echo "<tr><td>".htmlspecialchars($title)."</td><td>";
				$this->field->showFieldSearch($fsearch,$this->catid,null);
				echo "</td></tr>";
			}
			echo "<pre>";
			var_export ();
			echo "</pre>";
			?>
		
			<?php echo JText::_('ADSMANAGER_FORM_CATEGORY'); ?>
			
<select name='category_choose' onchange="jumpmenu('parent',this)">			
<option value="<?php echo TRoute::_("index.php?option=com_adsmanager&task=write&catid=$this->catid"); ?>" <?php if ($this->catid == 0) echo 'selected="selected"'; ?>><?php echo JText::_('ADSMANAGER_MENU_ALL_ADS'); ?></option>
					<?php
					 $link = "index.php?option=com_adsmanager&task=write";
					 $this->selectCategories(18,"",$this->cats,$this->catid,1,$link,0); 
					// $this->cats - массив категорий, $this->catid - идентификатор категории
					?>
</select>

<?php 
			echo "<pre>";
			var_export ();
			echo "</pre>";
*/?>

</div>







		
		<!-- fields -->
		<!-- image -->
		<tr id='tr_images'><td><?php echo JText::_('ADSMANAGER_FORM_AD_PICTURE')?></td><td id="uploader_td"><div id="uploader"></div>
		<div><?php echo JText::_('ADSMANAGER_MAX_NUMBER_OF_PICTURES')?>: <span id="maximum"><?php echo $this->conf->nb_images?></span> / <span id="totalcount"><?php echo $this->conf->nb_images?></span></div>
		<style>
		<?php
		$width = $this->conf->max_width_t; 
		$height = $this->conf->max_height_t + 20; 
		?>
		#currentimages li { width: <?php echo $width ?>px; height: <?php echo $height ?>px; }
		</style>
		<ul id="currentimages">
		<?php 
		$currentnbimages = 0;
		if (@$this->content->pending == 1) {
			$i=1;
			$ad_id = $this->content->id;
			foreach($this->content->images as $img) {
				$dir = JPATH_SITE."/images/com_adsmanager/ads/tmp/";
				$thumb = $dir.$img->thumbnail;
				echo "<li class='ui-state-default' id='li_img_$i'><img src='".$thumb."?time=".time()."' align='top' border='0' alt='image".$ad_id."' />";
				echo "<br/><input type='checkbox' name='cb_image$i' onClick='removeImage($i)' value='".$img."' />".JText::_('ADSMANAGER_CONTENT_DELETE_IMAGE').'</li>';
				$currentnbimages++;
				$i++;
			}
		} else if ($this->isUpdateMode) {
			$i=0;
			foreach($this->content->images as $img) {
				$i++;
				$index = $img->index;
				$currentnbimages++;
				echo "<li class='ui-state-default' id='li_img_$i' ><img src='".$this->baseurl."images/com_adsmanager/ads/".$img->thumbnail."?time=".time()."' align='top' border='0' alt='image".$this->content->id."' />";
				echo "<br/><input type='checkbox' name='cb_image$i' onClick='removeImage($i,$index)' value='delete' />".JText::_('ADSMANAGER_CONTENT_DELETE_IMAGE').'</li>';
			}
		}
		?>
		</ul>
		<input type="hidden" name="deleted_images" id="deleted_images" value=""/>
		<input type="hidden" name="orderimages" id="orderimages" value="" />
		<script type="text/javascript">
		var current_uploaded_files_count = <?php echo $currentnbimages?>;
		var nb_files_in_queue = 0;
		var max_total_file_count =  <?php echo ($this->conf->nb_images)?>;

		function removeTmpImage(fileid){
			if (confirm(<?php echo json_encode(JText::_('ADSMANAGER_CONFIRM_DELETE_IMAGE'))?>)) {
				jQ('#li_img_'+fileid).remove();
				var uploader = jQ('#uploader').pluploadQueue();
				jQ.each(uploader.files, function(i, file) {
					if (file.id == fileid)
						uploader.removeFile(file);
				});
				var inputCount = 0, inputHTML= "";
				jQ.each(uploader.files, function(i, file) {
					if (file.status == plupload.DONE) {
						if (file.target_name) {
							inputHTML += '<input type="hidden" name="' + id + '_' + inputCount + '_tmpname" value="' + plupload.xmlEncode(file.target_name) + '" />';
						}
	
						inputHTML += '<input type="hidden" name="' + id + '_' + inputCount + '_id" value="' + plupload.xmlEncode(file.id) + '" />';
						inputHTML += '<input type="hidden" name="' + id + '_' + inputCount + '_name" value="' + plupload.xmlEncode(file.name) + '" />';
						inputHTML += '<input type="hidden" name="' + id + '_' + inputCount + '_status" value="' + (file.status == plupload.DONE ? 'done' : 'failed') + '" />';
	
						inputCount++;
	
						jQ('#' + id + '_count').val(inputCount);
					} 
				});
				jQ('#pluploadfield').html(inputHTML);
				nb_files_in_queue = uploader.files.length;
				setCurrentFileCount();
			} else {
				jQ('#li_img_'+fileid+' input:checkbox').attr('checked',false);
			}
		}
		
		function removeImage(id,index) {
			if (confirm(<?php echo json_encode(JText::_('ADSMANAGER_CONFIRM_DELETE_IMAGE'))?>)) {
				deleted_images = jQ('#deleted_images').val();
				if (deleted_images == "")
					deleted_images = index;
				else
					deleted_images = deleted_images+","+index;
				jQ('#deleted_images').val(deleted_images);
				
				jQ('#li_img_'+id).remove();
				if (typeof updatePaidCurrentFileCount != "undefined") {
			    	updatePaidCurrentFileCount(current_uploaded_files_count+nb_files_in_queue,
			    							   current_uploaded_files_count+nb_files_in_queue-1);
			    }
				current_uploaded_files_count -= 1;
				setCurrentFileCount();
			} else {
				jQ('#li_img_'+id+' input:checkbox').attr('checked',false);
			}
		}
		
		function setCurrentFileCount() {
			jQ('#maximum').html(current_uploaded_files_count+nb_files_in_queue);
			jQ( "#currentimages" ).sortable(
				{
				 placeholder: "ui-state-highlight",
				 stop: function(event, ui) { 
					 jQ('#orderimages').val(jQ('#currentimages').sortable('toArray'));
				 },
				 create:function(event,ui) {
					 jQ('#orderimages').val(jQ('#currentimages').sortable('toArray'));
				}
				}
				 );
			
			jQ( "#currentimages" ).disableSelection();
			jQ('#orderimages').val(jQ('#currentimages').sortable('toArray'));
		}
		function setTotalFileCount(number) {
			jQ('#totalcount').html(number);
		}
		setCurrentFileCount();
		// Convert divs to queue widgets when the DOM is ready
		jQ(function() {
			jQ("#uploader").pluploadQueue({
				// General settings
				runtimes : 'html5,flash,html4',
				url : '<?php echo TRoute::_('index.php?option=com_adsmanager&task=upload&tmpl=component')?>',
				max_file_size : '10mb',
				chunk_size : '1mb',
				unique_names : true,
		
				// Resize images on clientside if we can
				resize : {width : <?php echo $this->conf->max_width?>, height : <?php echo $this->conf->max_height?>, quality : 90},
		
				// Specify what files to browse for
				filters : [
					{title : "Image files", extensions : "jpg,gif,png"}
				],
		
				// Flash settings
				flash_swf_url : '<?php echo $this->baseurl?>components/com_adsmanager/js/plupload/plupload.flash.swf',

				init : {
		            FilesAdded: function(up, files) {
						maxnewimages = max_total_file_count - current_uploaded_files_count;
						// Check if the size of the queue is bigger than max_file_count
					    if(up.files.length > maxnewimages)
					    {
					        // Removing the extra files
					        while(up.files.length > maxnewimages)
					        {
					            if(up.files.length > maxnewimages)
					            	up.removeFile(up.files[maxnewimages]);
					        }
					        alert('<?php echo JText::_(sprintf("Max %s Files",$this->conf->nb_images))?>');
					    }

					    if (typeof updatePaidCurrentFileCount != "undefined") {
					    	updatePaidCurrentFileCount(current_uploaded_files_count+nb_files_in_queue,
					    							   current_uploaded_files_count+up.files.length);
					    }
					    nb_files_in_queue = up.files.length;
				        setCurrentFileCount();
					},
					FilesRemoved: function(up, files) {
						if (typeof updatePaidCurrentFileCount != "undefined") {
							updatePaidCurrentFileCount(current_uploaded_files_count+nb_files_in_queue,
	    							   				   current_uploaded_files_count+up.files.length);
					    }
						nb_files_in_queue = up.files.length;
				        setCurrentFileCount();
					},
					FileUploaded: function(up, file,info) {
						maxheight = <?php echo $this->conf->max_height_t ?>;
						name = '<?php echo JURI::base() ?>/tmp/plupload/'+file.target_name;
						html = "<li class='ui-state-default' id='li_img_"+file.id+"'><img height='"+maxheight+"' src='"+name+"' align='top' border='0' alt='' />";
						html += "<br/><input type='checkbox' onClick='removeTmpImage(\""+file.id+"\")' value='' /><?php echo JText::_('ADSMANAGER_CONTENT_DELETE_IMAGE')?></li>";
						jQ('#currentimages').append(html);
						setCurrentFileCount();
					}
				}
			});
		});
		</script>
		</td></tr>
		<?php
		if ($this->conf->metadata_mode == 'frontendbackend') {
		
		echo "<tr id='tr_metadata'><td colspan='2'>".JText::_('ADSMANAGER_METADATA')."</td></tr>";
		?>
		<tr>
		<td><?php echo JText::_('ADSMANAGER_METADATA_DESCRIPTION'); ?></td>
		<td>
		<textarea cols="50" rows="10" name="metadata_description"><?php echo htmlspecialchars(@$this->content->metadata_description)?></textarea>			
		</td>
		</tr>
		
		<tr>
		<td><?php echo JText::_('ADSMANAGER_METADATA_KEYWORDS'); ?></td>
		<td>
		<textarea cols="50" rows="10" name="metadata_keywords"><?php echo htmlspecialchars(@$this->content->metadata_keywords)?></textarea>			
		</td>
		</tr>
		
		<?php } ?>
		
		<?php
		
		if (function_exists("editPaidAd")){
			editPaidAd($this->content,$this->isUpdateMode,$this->conf);
		}
		?>
		<?php echo $this->event->onContentAfterForm ?>	
		<!-- buttons -->
		<input type="hidden" name="gflag" value="0" />
		<?php
		if (isset($this->content->date_created))
			echo "<input type='hidden' name='date_created' value='".$this->content->date_created."' />";	
			
		echo "<input type='hidden' name='isUpdateMode' value='".$this->isUpdateMode."' />";
		echo "<input type='hidden' name='id' value='".@$this->content->id."' />";
		echo "<input type='hidden' name='pending' value='".@$this->content->pending."' />";
		?>
		<tr><td><br/><br/></td></tr>
		<tr>
		<td>
		<input type="submit" class="button" value="<?php echo JText::_('ADSMANAGER_FORM_SUBMIT_TEXT'); ?>" />
		</td>
		<td>
		<input type="button" class="button" onclick='window.location="<?php echo TRoute::_("index.php?option=com_adsmanager&view=list"); ?>"' value="<?php echo JText::_('ADSMANAGER_FORM_CANCEL_TEXT'); ?>" />
		</td>
		</tr>
		<!-- buttons -->
	<?php
	}
	?>
  <?php echo JHTML::_( 'form.token' ); ?>
</table>
</form>
<!-- form -->
</fieldset>
<script type="text/javascript">
updateFields();
</script>


<?php



?>

<?php

$db = JFactory::getDbo();
$query_events_h1 = $db->getQuery(true);

$query_events_h1->select(array('fieldtitle', 'fieldvalue'));
$query_events_h1->from('#__adsmanager_field_values');
$query_events_h1->where('fieldid LIKE \'26\'');

$rostavto_fieldvalue_2="";

$db->setQuery($query_events_h1);



$resultsh = $db->loadObjectList();
 

 
foreach($resultsh as $element_h1) {
$rostavto_fieldtitle=$element_h1->fieldtitle;
$rostavto_fieldvalue=$element_h1->fieldvalue;

//echo"".$rostavto_fieldtitle."<br>";
//echo"".$rostavto_fieldvalue."<br>";

//echo"social_city ". $social_city."<br>";

//echo"rostavto_fieldtitle ". $rostavto_fieldtitle."<br>";




if($social_city===$rostavto_fieldtitle){
$rostavto_fieldvalue_2=$rostavto_fieldvalue;
//echo"12345".$rostavto_fieldvalue_2."<br>";
break;
}

}

?>

<?php
if($rostavto_fieldvalue_2!==""){
//echo $rostavto_fieldvalue_2;



echo'

<script type="text/javascript">

document.getElementById(\'ad_citys\').value = "'.$rostavto_fieldvalue_2.'";
</script>
';

}
?>











<?php


?>
<script type="text/javascript">
document.getElementById('name').value = "<?php  echo $social_name;   ?>";
document.getElementById('email').value = "<?php  echo $social_email;   ?>";
document.getElementById('ad_phone').value = "<?php  echo $social_phone;   ?>";



</script>






<?php

/*
//$social_id

$query_2="SELECT * FROM avto_adsmanager_ads WHERE userid='".($social_id)."' AND ad_model='".$_GET['model']."'";

$res_2=mysql_query($query_2);
					if($res_2==false){
	    			echo"Ошибка выполнения запроса.</br>";
					echo mysql_error();
					exit; }

$row_2=mysql_fetch_array($res_2);

$ad_model=$_GET['model'];
$ad_tipkuzova=$row_2['ad_tipkuzova'];
$ad_tipdvigatelya=$row_2['ad_tipdvigatelya'];
$ad_objemdvigatelya=$row_2['ad_objemdvigatelya'];
$ad_godvipuska=$row_2['ad_godvipuska'];
$ad_cviet=$row_2['ad_cviet'];
$ad_rul=$row_2['ad_rul'];
$ad_korobkaperedach=$row_2['ad_korobkaperedach'];
$ad_privod=$row_2['ad_privod'];
$ad_obshiiprobeg=$row_2['ad_obshiiprobeg'];




//echo"".$ad_model."<br>";




$db = JFactory::getDbo();
$query_events_3 = $db->getQuery(true);

$query_events_3->select(array('fieldid', 'fieldtitle', 'fieldvalue'));
$query_events_3->from('#__adsmanager_field_values');
$query_events_3->where('fieldid LIKE \'11\'');

$db->setQuery($query_events_3);

$results3 = $db->loadObjectList();

foreach($results3 as $element_3) {

$pos = strpos($ad_model, ($element_3->fieldtitle) );
if ($pos === false) {


}else{
	
//echo "===". $ad_model."<br>";	
//echo "===".($element_3->fieldvalue)."<br><br>";	


	
	
	
echo'
<script type="text/javascript">
document.getElementById(\'ad_amarka\').value = "'.($element_3->fieldvalue).'";
</script>
';
	
	
	break;	
	
}




}




switch($ad_tipkuzova)
{
case 1:
$ad_tipkuzova="Седан";
break;

case 2:
$ad_tipkuzova="Хетчбек";
break;

case 3:
$ad_tipkuzova="Универсал";
break;

case 4:
$ad_tipkuzova="Внедорожник";
break;

case 5:
$ad_tipkuzova="Кабриолет";
break;

case 6:
$ad_tipkuzova="Кроссовер";
break;

case 7:
$ad_tipkuzova="Купе";
break;

case 8:
$ad_tipkuzova="Лимузин";
break;

case 9:
$ad_tipkuzova="Минивен";
break;

case 10:
$ad_tipkuzova="Пикап";
break;

case 11:
$ad_tipkuzova="Фургон";
break;

case 12:
$ad_tipkuzova="Микроавтобус";
break;

}


$query_events_4 = $db->getQuery(true);

$query_events_4->select(array('fieldid', 'fieldtitle', 'fieldvalue'));
$query_events_4->from('#__adsmanager_field_values');
$query_events_4->where('fieldid LIKE \'13\'');

$db->setQuery($query_events_4);

$results4 = $db->loadObjectList();

foreach($results4 as $element_4) {

//echo "--- ".($element_4->fieldtitle)."<br>";
//echo "--- ".($ad_tipkuzova)."<br>";

if(($element_4->fieldtitle)==$ad_tipkuzova){



echo'
<script type="text/javascript">
document.getElementById(\'ad_kuzov\').value = "'.($element_4->fieldvalue).'";
</script>
';
break;	

}

}



	





//echo"".$ad_tipkuzova."<br>";




switch($ad_tipdvigatelya)
{
case 1:
$ad_tipdvigatelya="Бензиновый";
break;

case 2:
$ad_tipdvigatelya="Дизельный";
break;

case 3:
$ad_tipdvigatelya="Гибридный";
break;

}




//echo"".$ad_tipdvigatelya."<br>";



$query_events_5 = $db->getQuery(true);

$query_events_5->select(array('fieldid', 'fieldtitle', 'fieldvalue'));
$query_events_5->from('#__adsmanager_field_values');
$query_events_5->where('fieldid LIKE \'15\'');

$db->setQuery($query_events_5);

$results5 = $db->loadObjectList();

foreach($results5 as $element_5) {

//echo "--- ".($element_5->fieldtitle)."<br>";
//echo "--- ".($ad_tipdvigatelya)."<br>";

if(($element_5->fieldtitle)==$ad_tipdvigatelya){



echo'
<script type="text/javascript">
document.getElementById(\'ad_type\').value = "'.($element_5->fieldvalue).'";
</script>
';
break;	

}

}












switch($ad_objemdvigatelya)
{
case 1:
$ad_objemdvigatelya="0.8";
break;

case 2:
$ad_objemdvigatelya="0.9";
break;

case 3:
$ad_objemdvigatelya="1.0";
break;

case 4:
$ad_objemdvigatelya="1.1";
break;

case 5:
$ad_objemdvigatelya="1.2";
break;

case 6:
$ad_objemdvigatelya="1.3";
break;

case 7:
$ad_objemdvigatelya="1.4";
break;

case 8:
$ad_objemdvigatelya="1.5";
break;

case 9:
$ad_objemdvigatelya="1.6";
break;

case 10:
$ad_objemdvigatelya="1.7";
break;

case 11:
$ad_objemdvigatelya="1.8";
break;

case 12:
$ad_objemdvigatelya="1.9";
break;

case 13:
$ad_objemdvigatelya="2.0";
break;

case 14:
$ad_objemdvigatelya="2.1";
break;

case 15:
$ad_objemdvigatelya="2.2";
break;

case 16:
$ad_objemdvigatelya="2.3";
break;

case 17:
$ad_objemdvigatelya="2.4";
break;

case 18:
$ad_objemdvigatelya="2.5";
break;

case 19:
$ad_objemdvigatelya="2.6";
break;

case 20:
$ad_objemdvigatelya="2.7";
break;

case 21:
$ad_objemdvigatelya="2.8";
break;

case 22:
$ad_objemdvigatelya="2.9";
break;

case 23:
$ad_objemdvigatelya="3.0";
break;

case 24:
$ad_objemdvigatelya="3.1";
break;

case 25:
$ad_objemdvigatelya="3.2";
break;

case 26:
$ad_objemdvigatelya="3.3";
break;

case 27:
$ad_objemdvigatelya="3.4";
break;

case 28:
$ad_objemdvigatelya="3.5";
break;

case 29:
$ad_objemdvigatelya="3.6";
break;

case 30:
$ad_objemdvigatelya="3.7";
break;

case 31:
$ad_objemdvigatelya="3.8";
break;

case 32:
$ad_objemdvigatelya="3.9";
break;

case 33:
$ad_objemdvigatelya="4.0";
break;

case 34:
$ad_objemdvigatelya="4.1";
break;

case 35:
$ad_objemdvigatelya="4.2";
break;

case 36:
$ad_objemdvigatelya="4.3";
break;

case 37:
$ad_objemdvigatelya="4.4";
break;

case 38:
$ad_objemdvigatelya="4.5";
break;

case 39:
$ad_objemdvigatelya="4.6";
break;

case 40:
$ad_objemdvigatelya="4.7";
break;

case 41:
$ad_objemdvigatelya="4.8";
break;

case 42:
$ad_objemdvigatelya="4.9";
break;

case 43:
$ad_objemdvigatelya="5.0";
break;

case 44:
$ad_objemdvigatelya="5.1";
break;

case 45:
$ad_objemdvigatelya="5.2";
break;

case 46:
$ad_objemdvigatelya="5.3";
break;

case 47:
$ad_objemdvigatelya="5.4";
break;

case 48:
$ad_objemdvigatelya="5.5";
break;

case 49:
$ad_objemdvigatelya="5.6";
break;

case 50:
$ad_objemdvigatelya="5.7";
break;

case 51:
$ad_objemdvigatelya="5.8";
break;

case 52:
$ad_objemdvigatelya="5.9";
break;

case 53:
$ad_objemdvigatelya="6.0";
break;

}



//echo"".$ad_objemdvigatelya."<br>";





$query_events_6 = $db->getQuery(true);

$query_events_6->select(array('fieldid', 'fieldtitle', 'fieldvalue'));
$query_events_6->from('#__adsmanager_field_values');
$query_events_6->where('fieldid LIKE \'14\'');

$db->setQuery($query_events_6);

$results6 = $db->loadObjectList();

foreach($results6 as $element_6) {

//echo "--- ".($element_6->fieldtitle)."<br>";
//echo "--- ".($ad_objemdvigatelya)."<br>";

if(($element_6->fieldtitle)==$ad_objemdvigatelya){



echo'
<script type="text/javascript">
document.getElementById(\'ad_litr\').value = "'.($element_6->fieldvalue).'";
</script>
';
break;	

}

}













//echo"".$ad_godvipuska."<br>";






$query_events_god = $db->getQuery(true);

$query_events_god->select(array('fieldid', 'fieldtitle', 'fieldvalue'));
$query_events_god->from('#__adsmanager_field_values');
$query_events_god->where('fieldid LIKE \'12\'');

$db->setQuery($query_events_god);

$resultsgod = $db->loadObjectList();

foreach($resultsgod as $element_god) {

//echo "--- ".($element_god->fieldtitle)."<br>";
//echo "--- ".($ad_objemdvigatelya)."<br>";

if(($element_god->fieldtitle)==$ad_godvipuska){



echo'
<script type="text/javascript">
document.getElementById(\'ad_year\').value = "'.($element_god->fieldvalue).'";
</script>
';
break;	

}

}







switch($ad_cviet)
{
case 1:
$ad_cviet="Бежевый";
break;

case 2:
$ad_cviet="Белый";
break;

case 3:
$ad_cviet="Голубой";
break;

case 4:
$ad_cviet="Жёлтый";
break;

case 5:
$ad_cviet="Зелёный";
break;

case 6:
$ad_cviet="Золотой";
break;

case 7:
$ad_cviet="Коричневый";
break;

case 8:
$ad_cviet="Красный";
break;

case 9:
$ad_cviet="Оранжевый";
break;

case 10:
$ad_cviet="Пурпурный";
break;

case 11:
$ad_cviet="Розовый";
break;

case 12:
$ad_cviet="Серебряный";
break;

case 13:
$ad_cviet="Серый";
break;

case 14:
$ad_cviet="Синий";
break;

case 15:
$ad_cviet="Филетовый";
break;

case 16:
$ad_cviet="Чёрный";
break;

}
//echo"".$ad_cviet."<br>";


$query_events_7 = $db->getQuery(true);

$query_events_7->select(array('fieldid', 'fieldtitle', 'fieldvalue'));
$query_events_7->from('#__adsmanager_field_values');
$query_events_7->where('fieldid LIKE \'18\'');

$db->setQuery($query_events_7);

$results7 = $db->loadObjectList();

foreach($results7 as $element_7) {

//echo "--- ".($element_7->fieldtitle)."<br>";
//echo "--- ".($ad_cviet)."<br>";

if(($element_7->fieldtitle)==$ad_cviet){



echo'
<script type="text/javascript">
document.getElementById(\'ad_color\').value = "'.($element_7->fieldvalue).'";
</script>
';
break;	

}

}




switch($ad_rul)
{
case 1:
$ad_rul="Левый";
break;

case 2:
$ad_rul="Правый";
break;

}
//echo"".$ad_rul."<br>";


$query_events_8 = $db->getQuery(true);

$query_events_8->select(array('fieldid', 'fieldtitle', 'fieldvalue'));
$query_events_8->from('#__adsmanager_field_values');
$query_events_8->where('fieldid LIKE \'16\'');

$db->setQuery($query_events_8);

$results8 = $db->loadObjectList();

foreach($results8 as $element_8) {

//echo "--- ".($element_8->fieldtitle)."<br>";
//echo "--- ".($ad_rul)."<br>";

if(($element_8->fieldtitle)==$ad_rul){



echo'
<script type="text/javascript">
document.getElementById(\'ad_rul\').value = "'.($element_8->fieldvalue).'";
</script>
';
break;	

}

}








switch($ad_korobkaperedach)
{
case 1:
$ad_korobkaperedach="Автоматическая";
break;

case 2:
$ad_korobkaperedach="Механическая";
break;

case 3:
$ad_korobkaperedach="Вариатор";
break;

case 4:
$ad_korobkaperedach="Робот";
break;

}
//echo"".$ad_korobkaperedach."<br>";





$query_events_9 = $db->getQuery(true);

$query_events_9->select(array('fieldid', 'fieldtitle', 'fieldvalue'));
$query_events_9->from('#__adsmanager_field_values');
$query_events_9->where('fieldid LIKE \'19\'');

$db->setQuery($query_events_9);

$results9 = $db->loadObjectList();

foreach($results9 as $element_9) {

//echo "--- ".($element_9->fieldtitle)."<br>";
//echo "--- ".($ad_korobkaperedach)."<br>";

if(($element_9->fieldtitle)==$ad_korobkaperedach){



echo'
<script type="text/javascript">
document.getElementById(\'ad_korobka\').value = "'.($element_9->fieldvalue).'";
</script>
';
break;	

}

}














switch($ad_privod)
{
case 1:
$ad_privod="Передний";
break;

case 2:
$ad_privod="Задний";
break;

case 3:
$ad_privod="Полный";
break;


}


//echo"".$ad_privod."<br>";



$query_events_10 = $db->getQuery(true);

$query_events_10->select(array('fieldid', 'fieldtitle', 'fieldvalue'));
$query_events_10->from('#__adsmanager_field_values');
$query_events_10->where('fieldid LIKE \'20\'');

$db->setQuery($query_events_10);

$results10 = $db->loadObjectList();

foreach($results10 as $element_10) {

//echo "--- ".($element_10->fieldtitle)."<br>";
//echo "--- ".($ad_privod)."<br>";

if(($element_10->fieldtitle)==$ad_privod){



echo'
<script type="text/javascript">
document.getElementById(\'ad_privod\').value = "'.($element_10->fieldvalue).'";
</script>
';
break;	

}

}


*/












/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
}else{
//пользователь пришёл из соц. сети по ссылке "Продать машину"






$db = JFactory::getDbo();
$query_events_h = $db->getQuery(true);

$query_events_h->select(array('id', 'username'));
$query_events_h->from('#__users');
$query_events_h->where('id LIKE \''.($user->id).'\'');

$db->setQuery($query_events_h);

$resultsh = $db->loadObjectList();

foreach($resultsh as $element_h) {
$rostavto_login=$element_h->username;

break;
}



require '/config_db_social/config.php';

$dbh=mysql_connect(DB_SERVER_S,DB_USER_S,DB_PASS_S) or die ("Невозможно соединиться с сервером.");

mysql_select_db(DB_BASE_S) or die ("Невозможно подключиться к базе.");
mysql_query("set character_set_results='utf8'");
			mysql_query("SET NAMES utf8");
			
mysql_query ("SET COLLATION_CONNECTION=utf8");
mysql_query("SET CHARACTER_SET_CLIENT=utf8");
mysql_query("SET CHARACTER_SET_RESULTS=utf8");


$query_ra="SELECT * FROM avto_users WHERE username='".($rostavto_login)."'";

$res_ra=mysql_query($query_ra);
					if($res_ra==false){
	    			echo"Ошибка выполнения запроса.</br>";
					echo mysql_error();
					exit; }

while($row_ra=mysql_fetch_array($res_ra)){

$social_id=$row_ra['id'];
$social_name=$row_ra['name'];
$social_email=$row_ra['email'];

//echo"".$social_id."<br>";
//echo"".$social_name."<br>";
//echo"".$social_email."<br>";

break;
}




$query_ra_1="SELECT * FROM avto_community_fields_values WHERE user_id='".($social_id)."' AND field_id='6'";
$res_ra_1=mysql_query($query_ra_1);
					if($res_ra_1==false){
	    			echo"Ошибка выполнения запроса.</br>";
					echo mysql_error();
					exit; }
$row_ra_1=mysql_fetch_array($res_ra_1);
$social_phone=$row_ra_1['value'];

					

$query_ra_2="SELECT * FROM avto_community_fields_values WHERE user_id='".($social_id)."' AND field_id='10'";
$res_ra_2=mysql_query($query_ra_2);
					if($res_ra_2==false){
	    			echo"Ошибка выполнения запроса.</br>";
					echo mysql_error();
					exit; }
$row_ra_2=mysql_fetch_array($res_ra_2);
$social_city=$row_ra_2['value'];	

//echo"".$social_phone."<br>";
//echo"".$social_city."<br>";
			

?>






<script type="text/javascript">
function CaracMax(text, max)
{
	if (text.value.length >= max)
	{
		text.value = text.value.substr(0, max - 1) ;
	}
}

function checkEnter(e){
	 e = e || event;
	 if(e.keyCode == 13 && e.target.nodeName!='TEXTAREA')
     {
       e.preventDefault();
       return false;
     }
}

function submitbutton(mfrm) {
	
	var me = mfrm.elements;
	var r = new RegExp("[\<|\>|\"|\'|\%|\;|\(|\)|\&|\+|\-]", "i");
	var r_num = new RegExp("[^0-9\., ]", "i");
	var r_email = new RegExp("^[a-zA-Z0-9._-]+@[a-zA-Z0-9.-]{2,}[.][a-zA-Z]{2,3}$" ,"i");

	var errorMSG = '';
	var iserror=0;
	
	<?php 
	if (function_exists("loadEditFormCheck")){
		loadEditFormCheck();
	}
	?>
	
	<?php if ($this->nbcats > 1)
	{
	?>
		var form = document.adminForm;
		var srcList = eval( 'form.selected_cats' );
		var srcLen = srcList.length;
		if (srcLen == 0)
		{
			errorMSG += <?php echo json_encode(JText::_('ADSMANAGER_FORM_CATEGORY')); ?>+" : "+<?php echo json_encode(JText::_('ADSMANAGER_REGWARN_ERROR')); ?>+'\n';
			srcList.style.background = "red";
			iserror=1;
		}
		else
		{
			for (var i=0; i < srcLen; i++) {
				srcList.options[i].selected = true;
			}
		}
	<?php
	}
	?>
	
	if (mfrm.username && (r.exec(mfrm.username.value) || mfrm.username.value.length < 3)) {
		errorMSG += mfrm.username.getAttribute('mosLabel').replace('&nbsp;',' ') + ' : '+<?php echo json_encode(sprintf( JText::_('ADSMANAGER_VALID_AZ09'), JText::_('ADSMANAGER_PROMPT_UNAME'), 4 )); ?>+'\n';
		mfrm.username.style.background = "red";
		iserror=1;
	} 
	if (mfrm.password && r.exec(mfrm.password.value)) {
		errorMSG += mfrm.password.getAttribute('mosLabel').replace('&nbsp;',' ') + ' : '+<?php echo json_encode(sprintf( JText::_('ADSMANAGER_VALID_AZ09'), JText::_('ADSMANAGER_REGISTER_PASS'), 6 )); ?>+'\n';
		mfrm.password.style.background = "red";
		iserror=1;
	}
	
	if (mfrm.email && !r_email.exec(mfrm.email.value) && mfrm.email.getAttribute('mosReq')) {
		errorMSG += mfrm.email.getAttribute('mosLabel').replace('&nbsp;',' ') + ' : '+<?php echo json_encode(JText::_('ADSMANAGER_REGWARN_EMAIL')); ?>+'\n';
		mfrm.email.style.background = "red";
		iserror=1;
	}
				
	// loop through all input elements in form
	for (var i=0; i < me.length; i++) {
	
		if ((me[i].getAttribute('test') == 'number' ) && (r_num.exec(me[i].value))) {
			errorMSG += me[i].getAttribute('mosLabel').replace('&nbsp;',' ') + ' : '+<?php echo json_encode(JText::_('ADSMANAGER_REGWARN_NUMBER')); ?>+'\n';
			iserror=1;
		}
		
		// check if element is mandatory; here mosReq="1"
		if ((me[i].getAttribute('mosReq') == 1)&&(me[i].type == 'hidden')&&(me[i].value == '')) {
			// add up all error messages
			errorMSG += me[i].getAttribute('mosLabel').replace('&nbsp;',' ') + ' : '+<?php echo json_encode(JText::_('ADSMANAGER_REGWARN_ERROR')); ?>+'\n';
			// notify user by changing background color, in this case to red
			el = me[i].getAttribute('mosElem');

			elem = document.getElementById(el);
			elem.style.background = "red";
			iserror=1;
		} else if ((me[i].getAttribute('mosReq') == 1)&&(me[i].style.visibility != 'hidden')) {
			if (me[i].type == 'radio' || me[i].type == 'checkbox') {
				var rOptions = me[me[i].getAttribute('name')];
				var rChecked = 0;
				if(rOptions.length > 1) {
					for (var r=0; r < rOptions.length; r++) {
						if (rOptions[r].checked) {
							rChecked=1;
						}
					}
				} else {
					if (me[i].checked) {
						rChecked=1;
					}
				}
				if(rChecked==0) {
					// add up all error messages
					errorMSG += me[i].getAttribute('mosLabel').replace('&nbsp;',' ') + ' : '+<?php echo json_encode(JText::_('ADSMANAGER_REGWARN_ERROR')); ?>+'\n';
					// notify user by changing background color, in this case to red
					me[i].style.background = "red";
					iserror=1;
				} 
			}
			if (me[i].value == '') {
				// add up all error messages
				errorMSG += me[i].getAttribute('mosLabel').replace('&nbsp;',' ') + ' : '+<?php echo json_encode(JText::_('ADSMANAGER_REGWARN_ERROR')); ?>+'\n';
				// notify user by changing background color, in this case to red
				me[i].style.background = "red";
				iserror=1;
			} 
		}
	}
	
	if(iserror==1) {
		alert(errorMSG);
		return false;
	} else {
		 var uploader = jQ('#uploader').pluploadQueue();
			
        // Files in queue upload them first
        if (uploader.files.length > 0) {
            // When all files are uploaded submit form
            uploader.bind('StateChanged', function() {
                if (uploader.files.length === (uploader.total.uploaded + uploader.total.failed)) {
                	//Little hack to be able to return the selected_cats
            		<?php if ($this->nbcats > 1) { ?>
            		var srcList = eval( 'form.selected_cats' );
            		srcList.name = "selected_cats[]"; 
            		<?php } ?>
            		jQ('#adminForm')[0].submit();
                }
            });
                
            uploader.start();
            return false;
        }  
	        
		//Little hack to be able to return the selected_cats
		<?php if ($this->nbcats > 1) { ?>
			srcList.name = "selected_cats[]"; 
		<?php } ?>
		return true;
	}
}

function updateFields() {
	var form = document.adminForm;
	var singlecat = 0;
	var length = 0;
	
	if ( typeof(document.adminForm.category ) != "undefined" ) {
		singlecat = 1;
		length = 1;
	}
	else
	{
		length = form.selected_cats.length;
	}
	
	<?php
	foreach($this->fields as $field)
	{ 
		if (strpos($field->catsid, ",-1,") === false)
		{
			$name = $field->name;
			if (($field->type == "multicheckbox")||($field->type == "multiselect"))
				$name .= "[]";
		?>
		var input = document.getElementById('<?php echo $name;?>');
		var trzone = document.getElementById('tr_<?php echo $field->name;?>');
		if (((singlecat == 0)&&(length == 0))||
		    ((singlecat == 1)&&(document.adminForm.category.value == 0)))
		{
			if (input != null)
				input.style.visibility = 'hidden';
			trzone.style.visibility = 'hidden';
			trzone.style.display = 'none';
		}
		else
		{
			for (var i=0; i < length; i++) {
				var field_<?php echo $field->name;?> = '<?php echo $field->catsid;?>';
				var temp;
				if (singlecat == 0)
					temp = form.selected_cats.options[i].value;
				else
					temp = document.adminForm.category.value;
					
				var test = field_<?php echo $field->name;?>.indexOf( ","+temp+",", 0 );
				if (test != -1)
				{
					if (input != null)
						input.style.visibility = 'visible';
					trzone.style.visibility = 'visible';
					trzone.style.display = '';
					break;
				}
				else
				{
					if (input != null)
						input.style.visibility = 'hidden';
					trzone.style.visibility = 'hidden';
					trzone.style.display = 'none';
				}
			}
		}
	<?php
		}
	} 
	?>
}
</script>

<fieldset id="adsmanager_fieldset">
	<!-- titel -->
	<legend>
	<?php
	 if($this->isUpdateMode) {
	   echo JText::_('ADSMANAGER_CONTENT_EDIT');
	 }
	 else {
	   echo JText::_('ADSMANAGER_CONTENT_WRITE');
	 }
	 ?>
	</legend>
	<!-- titel -->
  <!-- form -->
   <!-- category -->
   <table border='0' id="adformtable" style="background-color:transparent;">
   <tr name='category'>
	<td width="100"><?php echo JText::_('ADSMANAGER_FORM_CATEGORY'); ?></td>
	<td>
	<?php
	  $target = TRoute::_("index.php?option=com_adsmanager&task=save"); 
	  if ($this->nbcats == 1)
	  {
		$this->displaySingleCatChooser(@$this->content->id,$this->conf,"com_adsmanager",$this->cats,$this->catid);
		?>
		</td></tr></table>
		<form action="<?php echo $target;?>" method="post" name="adminForm" id="adminForm" enctype="multipart/form-data" onkeypress="return checkEnter(event)" onsubmit="return submitbutton(this)">
		<table border='0' id="adformtable">
		<?php
		echo "<input type='hidden' name='category' value='$this->catid' />";
		
	  }
	  else
	  {
		?>
		</td></tr></table>
   		<form action="<?php echo $target;?>" method="post" name="adminForm" id="adminForm" enctype="multipart/form-data" onsubmit="return submitbutton(this)">
   		<table border='0' id="adformtable">
   		<tr name='category'>
		<td colspan="2">
		<?php
		if (!isset($this->content->catsid))
			$this->content->catsid = 0;
		$this->displayMultipleCatsChooser($this->content->catsid,$this->cats,$this->conf,"com_adsmanager");
	  	?></td></tr><?php 
	  }
	?>
	<!-- fields -->
	<?php
	

	
	
	
	?>
	<?php
	if (($this->nbcats != 1)||(!isset($this->catid))||($this->catid != 0))
	{
		/* Submission_type == 0 -> Account Creation with ad posting */
		if ($this->account_creation == 1)
		{
			echo "<tr><td colspan='2'>".JText::_('ADSMANAGER_AUTOMATIC_ACCOUNT')."</td></tr>";
			echo "<tr><td>".JText::_('ADSMANAGER_UNAME')."</td>\n";
			if (isset($this->content->username))
			{
				$username = $this->content->username;
				$password = $this->content->password;
				$email = $this->content->email;
				$name = $this->content->name;
				$style = 'style="background-color:#ff0000"';
			}
			else
			{
				$username = "";
				$password = "";
				$email = "";
				$name =  "";
				$style = "";
			}
								
			if (isset($this->content->firstname))
				$firstname = $this->content->firstname;
			else
				$firstname = "";
			
			if (isset($this->content->middlename))
				$middlename = $this->content->middlename;
			else
				$middlename = "";
			
			if (COMMUNITY_BUILDER == 1)
			{
				include_once( JPATH_BASE .'/administrator/components/com_comprofiler/ue_config.php' );
				$namestyle = $ueConfig['name_style'];
			}
			else
				$namestyle = 1;
				
			echo "<td><input $style class='adsmanager_required' mosReq='1' id='username' type='text' mosLabel='".htmlspecialchars(JText::_('ADSMANAGER_UNAME'),ENT_QUOTES)."' name='username' size='20' maxlength='20' value='$username' /></td></tr>\n"; 
			
			echo "<tr><td>".JText::_('ADSMANAGER_PASSWORD')."</td>\n";
			echo "<td><input $style class='adsmanager_required' mosReq='1' id='password' type='password' mosLabel='".htmlspecialchars(JText::_('ADSMANAGER_PASS'),ENT_QUOTES)."' name='password' size='20' maxlength='20' value='$password' />\n</td></tr>"; 
			$emailField = false;
			$nameField = false;
			foreach($this->fields as $field) 
			{
				if (($field->name == "email")&&((strpos($field->catsid, ",$this->catid,") !== false)||(strpos($field->catsid, ",-1,") !== false)))
				{
					$emailField = true;
					// Force required 
					$field->required = 1;
				}
				else if (($field->name == "name")&&((strpos($field->catsid, ",$this->catid,") !== false)||(strpos($field->catsid, ",-1,") !== false)))
				{
					$nameField = true;
					// Force required 
					$field->required = 1;
				}
				else if (($namestyle >= 2)&&($field->name == "firstname")&&((strpos($field->catsid, ",$this->catid,") !== false)||(strpos($field->catsid, ",-1,") !== false)))
				{
					$firstnameField = true;
					// Force required 
					$field->required = 1;
				}
				else if( ($namestyle == 3)&&($field->name == "middlename")&&((strpos($field->catsid, ",$this->catid,") !== false)||(strpos($field->catsid, ",-1,") !== false)))
				{
					$middlenameField = true;
					// Force required 
					$field->required = 1;
				}			
			}
			if (($namestyle >= 2)&&($firstnameField == false))
			{
				echo "<tr><td>".JText::_('ADSMANAGER_FNAME')."</td>\n";
				echo "<td><input $style class='adsmanager_required' mosReq='1' id='firstname' type='text' mosLabel='".htmlspecialchars(JText::_('ADSMANAGER_FNAME'),ENT_QUOTES)."' name='firstname' size='20' maxlength='20' value='$firstname' /></td></tr>\n"; 
			}
			if ( ($namestyle == 3)&&($middlenameField == false))
			{
				echo "<tr><td>".JText::_('ADSMANAGER_MNAME')."</td>\n";
				echo "<td><input $style class='adsmanager_required' mosReq='1' id='middlename' type='text' mosLabel='".htmlspecialchars(JText::_('ADSMANAGER_MNAME'),ENT_QUOTES)."' name='middlename' size='20' maxlength='20' value='$middlename' /></td></tr>\n"; 
			}
			if ($nameField == false)
			{
				echo "<tr><td>".JText::_('ADSMANAGER_FORM_NAME')."</td>\n";
				echo "<td><input $style class='adsmanager_required' mosReq='1' id='name' type='text' mosLabel='".htmlspecialchars(JText::_('_NAME'),ENT_QUOTES)."' name='name' size='20' maxlength='20' value='$name' /></td></tr>\n"; 
			}
			if ($emailField == false)
			{
				echo "<tr><td>".JText::_('ADSMANAGER_FORM_EMAIL')."</td>\n";
				echo "<td><input $style class='adsmanager_required' mosReq='1' id='email' type='text' mosLabel='".htmlspecialchars(JText::_('_EMAIL'),ENT_QUOTES)."' name='email' size='20' maxlength='20' value='$email' /></td></tr>\n"; 
			}
		}




		
/* Display Fields */
		foreach($this->fields as $field)
		{
			$fieldform = $this->field->showFieldForm($field,$this->content,$this->default);
			if ($fieldform != "") {
				echo "<tr id=\"tr_{$field->name}\"><td>".$this->field->showFieldLabel($field,$this->content,$this->default)."</td>\n";
				echo "<td>".$fieldform."</td></tr>\n";
			}
		}	
		//echo $this->field->showFieldForm($this->fields['ad_price'],$this->content,$this->default);
		?>
		
		
		
		
		
		
		
		
<div id="adsmanager_writead_header">

			<?php /*
			foreach($this->searchfields as $fsearch) {
				$title = $this->field->showFieldTitle($this->catid,$fsearch);
				echo "<tr><td>".htmlspecialchars($title)."</td><td>";
				$this->field->showFieldSearch($fsearch,$this->catid,null);
				echo "</td></tr>";
			}
			echo "<pre>";
			var_export ();
			echo "</pre>";
			?>
		
			<?php echo JText::_('ADSMANAGER_FORM_CATEGORY'); ?>
			
<select name='category_choose' onchange="jumpmenu('parent',this)">			
<option value="<?php echo TRoute::_("index.php?option=com_adsmanager&task=write&catid=$this->catid"); ?>" <?php if ($this->catid == 0) echo 'selected="selected"'; ?>><?php echo JText::_('ADSMANAGER_MENU_ALL_ADS'); ?></option>
					<?php
					 $link = "index.php?option=com_adsmanager&task=write";
					 $this->selectCategories(18,"",$this->cats,$this->catid,1,$link,0); 
					// $this->cats - массив категорий, $this->catid - идентификатор категории
					?>
</select>

<?php 
			echo "<pre>";
			var_export ();
			echo "</pre>";
*/?>

</div>







		
		<!-- fields -->
		<!-- image -->
		<tr id='tr_images'><td><?php echo JText::_('ADSMANAGER_FORM_AD_PICTURE')?></td><td id="uploader_td"><div id="uploader"></div>
		<div><?php echo JText::_('ADSMANAGER_MAX_NUMBER_OF_PICTURES')?>: <span id="maximum"><?php echo $this->conf->nb_images?></span> / <span id="totalcount"><?php echo $this->conf->nb_images?></span></div>
		<style>
		<?php
		$width = $this->conf->max_width_t; 
		$height = $this->conf->max_height_t + 20; 
		?>
		#currentimages li { width: <?php echo $width ?>px; height: <?php echo $height ?>px; }
		</style>
		<ul id="currentimages">
		<?php 
		$currentnbimages = 0;
		if (@$this->content->pending == 1) {
			$i=1;
			$ad_id = $this->content->id;
			foreach($this->content->images as $img) {
				$dir = JPATH_SITE."/images/com_adsmanager/ads/tmp/";
				$thumb = $dir.$img->thumbnail;
				echo "<li class='ui-state-default' id='li_img_$i'><img src='".$thumb."?time=".time()."' align='top' border='0' alt='image".$ad_id."' />";
				echo "<br/><input type='checkbox' name='cb_image$i' onClick='removeImage($i)' value='".$img."' />".JText::_('ADSMANAGER_CONTENT_DELETE_IMAGE').'</li>';
				$currentnbimages++;
				$i++;
			}
		} else if ($this->isUpdateMode) {
			$i=0;
			foreach($this->content->images as $img) {
				$i++;
				$index = $img->index;
				$currentnbimages++;
				echo "<li class='ui-state-default' id='li_img_$i' ><img src='".$this->baseurl."images/com_adsmanager/ads/".$img->thumbnail."?time=".time()."' align='top' border='0' alt='image".$this->content->id."' />";
				echo "<br/><input type='checkbox' name='cb_image$i' onClick='removeImage($i,$index)' value='delete' />".JText::_('ADSMANAGER_CONTENT_DELETE_IMAGE').'</li>';
			}
		}
		?>
		</ul>
		<input type="hidden" name="deleted_images" id="deleted_images" value=""/>
		<input type="hidden" name="orderimages" id="orderimages" value="" />
		<script type="text/javascript">
		var current_uploaded_files_count = <?php echo $currentnbimages?>;
		var nb_files_in_queue = 0;
		var max_total_file_count =  <?php echo ($this->conf->nb_images)?>;

		function removeTmpImage(fileid){
			if (confirm(<?php echo json_encode(JText::_('ADSMANAGER_CONFIRM_DELETE_IMAGE'))?>)) {
				jQ('#li_img_'+fileid).remove();
				var uploader = jQ('#uploader').pluploadQueue();
				jQ.each(uploader.files, function(i, file) {
					if (file.id == fileid)
						uploader.removeFile(file);
				});
				var inputCount = 0, inputHTML= "";
				jQ.each(uploader.files, function(i, file) {
					if (file.status == plupload.DONE) {
						if (file.target_name) {
							inputHTML += '<input type="hidden" name="' + id + '_' + inputCount + '_tmpname" value="' + plupload.xmlEncode(file.target_name) + '" />';
						}
	
						inputHTML += '<input type="hidden" name="' + id + '_' + inputCount + '_id" value="' + plupload.xmlEncode(file.id) + '" />';
						inputHTML += '<input type="hidden" name="' + id + '_' + inputCount + '_name" value="' + plupload.xmlEncode(file.name) + '" />';
						inputHTML += '<input type="hidden" name="' + id + '_' + inputCount + '_status" value="' + (file.status == plupload.DONE ? 'done' : 'failed') + '" />';
	
						inputCount++;
	
						jQ('#' + id + '_count').val(inputCount);
					} 
				});
				jQ('#pluploadfield').html(inputHTML);
				nb_files_in_queue = uploader.files.length;
				setCurrentFileCount();
			} else {
				jQ('#li_img_'+fileid+' input:checkbox').attr('checked',false);
			}
		}
		
		function removeImage(id,index) {
			if (confirm(<?php echo json_encode(JText::_('ADSMANAGER_CONFIRM_DELETE_IMAGE'))?>)) {
				deleted_images = jQ('#deleted_images').val();
				if (deleted_images == "")
					deleted_images = index;
				else
					deleted_images = deleted_images+","+index;
				jQ('#deleted_images').val(deleted_images);
				
				jQ('#li_img_'+id).remove();
				if (typeof updatePaidCurrentFileCount != "undefined") {
			    	updatePaidCurrentFileCount(current_uploaded_files_count+nb_files_in_queue,
			    							   current_uploaded_files_count+nb_files_in_queue-1);
			    }
				current_uploaded_files_count -= 1;
				setCurrentFileCount();
			} else {
				jQ('#li_img_'+id+' input:checkbox').attr('checked',false);
			}
		}
		
		function setCurrentFileCount() {
			jQ('#maximum').html(current_uploaded_files_count+nb_files_in_queue);
			jQ( "#currentimages" ).sortable(
				{
				 placeholder: "ui-state-highlight",
				 stop: function(event, ui) { 
					 jQ('#orderimages').val(jQ('#currentimages').sortable('toArray'));
				 },
				 create:function(event,ui) {
					 jQ('#orderimages').val(jQ('#currentimages').sortable('toArray'));
				}
				}
				 );
			
			jQ( "#currentimages" ).disableSelection();
			jQ('#orderimages').val(jQ('#currentimages').sortable('toArray'));
		}
		function setTotalFileCount(number) {
			jQ('#totalcount').html(number);
		}
		setCurrentFileCount();
		// Convert divs to queue widgets when the DOM is ready
		jQ(function() {
			jQ("#uploader").pluploadQueue({
				// General settings
				runtimes : 'html5,flash,html4',
				url : '<?php echo TRoute::_('index.php?option=com_adsmanager&task=upload&tmpl=component')?>',
				max_file_size : '10mb',
				chunk_size : '1mb',
				unique_names : true,
		
				// Resize images on clientside if we can
				resize : {width : <?php echo $this->conf->max_width?>, height : <?php echo $this->conf->max_height?>, quality : 90},
		
				// Specify what files to browse for
				filters : [
					{title : "Image files", extensions : "jpg,gif,png"}
				],
		
				// Flash settings
				flash_swf_url : '<?php echo $this->baseurl?>components/com_adsmanager/js/plupload/plupload.flash.swf',

				init : {
		            FilesAdded: function(up, files) {
						maxnewimages = max_total_file_count - current_uploaded_files_count;
						// Check if the size of the queue is bigger than max_file_count
					    if(up.files.length > maxnewimages)
					    {
					        // Removing the extra files
					        while(up.files.length > maxnewimages)
					        {
					            if(up.files.length > maxnewimages)
					            	up.removeFile(up.files[maxnewimages]);
					        }
					        alert('<?php echo JText::_(sprintf("Max %s Files",$this->conf->nb_images))?>');
					    }

					    if (typeof updatePaidCurrentFileCount != "undefined") {
					    	updatePaidCurrentFileCount(current_uploaded_files_count+nb_files_in_queue,
					    							   current_uploaded_files_count+up.files.length);
					    }
					    nb_files_in_queue = up.files.length;
				        setCurrentFileCount();
					},
					FilesRemoved: function(up, files) {
						if (typeof updatePaidCurrentFileCount != "undefined") {
							updatePaidCurrentFileCount(current_uploaded_files_count+nb_files_in_queue,
	    							   				   current_uploaded_files_count+up.files.length);
					    }
						nb_files_in_queue = up.files.length;
				        setCurrentFileCount();
					},
					FileUploaded: function(up, file,info) {
						maxheight = <?php echo $this->conf->max_height_t ?>;
						name = '<?php echo JURI::base() ?>/tmp/plupload/'+file.target_name;
						html = "<li class='ui-state-default' id='li_img_"+file.id+"'><img height='"+maxheight+"' src='"+name+"' align='top' border='0' alt='' />";
						html += "<br/><input type='checkbox' onClick='removeTmpImage(\""+file.id+"\")' value='' /><?php echo JText::_('ADSMANAGER_CONTENT_DELETE_IMAGE')?></li>";
						jQ('#currentimages').append(html);
						setCurrentFileCount();
					}
				}
			});
		});
		</script>
		</td></tr>
		<?php
		if ($this->conf->metadata_mode == 'frontendbackend') {
		
		echo "<tr id='tr_metadata'><td colspan='2'>".JText::_('ADSMANAGER_METADATA')."</td></tr>";
		?>
		<tr>
		<td><?php echo JText::_('ADSMANAGER_METADATA_DESCRIPTION'); ?></td>
		<td>
		<textarea cols="50" rows="10" name="metadata_description"><?php echo htmlspecialchars(@$this->content->metadata_description)?></textarea>			
		</td>
		</tr>
		
		<tr>
		<td><?php echo JText::_('ADSMANAGER_METADATA_KEYWORDS'); ?></td>
		<td>
		<textarea cols="50" rows="10" name="metadata_keywords"><?php echo htmlspecialchars(@$this->content->metadata_keywords)?></textarea>			
		</td>
		</tr>
		
		<?php } ?>
		
		<?php
		
		if (function_exists("editPaidAd")){
			editPaidAd($this->content,$this->isUpdateMode,$this->conf);
		}
		?>
		<?php echo $this->event->onContentAfterForm ?>	
		<!-- buttons -->
		<input type="hidden" name="gflag" value="0" />
		<?php
		if (isset($this->content->date_created))
			echo "<input type='hidden' name='date_created' value='".$this->content->date_created."' />";	
			
		echo "<input type='hidden' name='isUpdateMode' value='".$this->isUpdateMode."' />";
		echo "<input type='hidden' name='id' value='".@$this->content->id."' />";
		echo "<input type='hidden' name='pending' value='".@$this->content->pending."' />";
		?>
		<tr><td><br/><br/></td></tr>
		<tr>
		<td>
		<input type="submit" class="button" value="<?php echo JText::_('ADSMANAGER_FORM_SUBMIT_TEXT'); ?>" />
		</td>
		<td>
		<input type="button" class="button" onclick='window.location="<?php echo TRoute::_("index.php?option=com_adsmanager&view=list"); ?>"' value="<?php echo JText::_('ADSMANAGER_FORM_CANCEL_TEXT'); ?>" />
		</td>
		</tr>
		<!-- buttons -->
	<?php
	}
	?>
  <?php echo JHTML::_( 'form.token' ); ?>
</table>
</form>
<!-- form -->
</fieldset>
<script type="text/javascript">
updateFields();
</script>


<?php



?>

<?php

$db = JFactory::getDbo();
$query_events_h1 = $db->getQuery(true);

$query_events_h1->select(array('fieldtitle', 'fieldvalue'));
$query_events_h1->from('#__adsmanager_field_values');
$query_events_h1->where('fieldid LIKE \'26\'');

$rostavto_fieldvalue_2="";

$db->setQuery($query_events_h1);



$resultsh = $db->loadObjectList();
 

 
foreach($resultsh as $element_h1) {
$rostavto_fieldtitle=$element_h1->fieldtitle;
$rostavto_fieldvalue=$element_h1->fieldvalue;

//echo"".$rostavto_fieldtitle."<br>";
//echo"".$rostavto_fieldvalue."<br>";

//echo"social_city ". $social_city."<br>";

//echo"rostavto_fieldtitle ". $rostavto_fieldtitle."<br>";




if($social_city===$rostavto_fieldtitle){
$rostavto_fieldvalue_2=$rostavto_fieldvalue;
//echo"12345".$rostavto_fieldvalue_2."<br>";
break;
}

}

?>

<?php
if($rostavto_fieldvalue_2!==""){
//echo $rostavto_fieldvalue_2;



echo'

<script type="text/javascript">

document.getElementById(\'ad_citys\').value = "'.$rostavto_fieldvalue_2.'";
</script>
';

}
?>











<?php


?>
<script type="text/javascript">
document.getElementById('name').value = "<?php  echo $social_name;   ?>";
document.getElementById('email').value = "<?php  echo $social_email;   ?>";
document.getElementById('ad_phone').value = "<?php  echo $social_phone;   ?>";



</script>



<?php
//$social_id

$query_2="SELECT * FROM avto_adsmanager_ads WHERE userid='".($social_id)."' AND ad_model='".$_GET['model']."'";

$res_2=mysql_query($query_2);
					if($res_2==false){
	    			echo"Ошибка выполнения запроса.</br>";
					echo mysql_error();
					exit; }

$row_2=mysql_fetch_array($res_2);

$ad_model=$_GET['model'];
$ad_tipkuzova=$row_2['ad_tipkuzova'];
$ad_tipdvigatelya=$row_2['ad_tipdvigatelya'];
$ad_objemdvigatelya=$row_2['ad_objemdvigatelya'];
$ad_godvipuska=$row_2['ad_godvipuska'];
$ad_cviet=$row_2['ad_cviet'];
$ad_rul=$row_2['ad_rul'];
$ad_korobkaperedach=$row_2['ad_korobkaperedach'];
$ad_privod=$row_2['ad_privod'];
$ad_obshiiprobeg=$row_2['ad_obshiiprobeg'];




//echo"".$ad_model."<br>";




$db = JFactory::getDbo();
$query_events_3 = $db->getQuery(true);

$query_events_3->select(array('fieldid', 'fieldtitle', 'fieldvalue'));
$query_events_3->from('#__adsmanager_field_values');
$query_events_3->where('fieldid LIKE \'11\'');

$db->setQuery($query_events_3);

$results3 = $db->loadObjectList();

foreach($results3 as $element_3) {

$pos = strpos($ad_model, ($element_3->fieldtitle) );
if ($pos === false) {


}else{
	
//echo "===". $ad_model."<br>";	
//echo "===".($element_3->fieldvalue)."<br><br>";	


	
	
	
echo'
<script type="text/javascript">
document.getElementById(\'ad_amarka\').value = "'.($element_3->fieldvalue).'";
</script>
';
	
	
	break;	
	
}




}




switch($ad_tipkuzova)
{
case 1:
$ad_tipkuzova="Седан";
break;

case 2:
$ad_tipkuzova="Хетчбек";
break;

case 3:
$ad_tipkuzova="Универсал";
break;

case 4:
$ad_tipkuzova="Внедорожник";
break;

case 5:
$ad_tipkuzova="Кабриолет";
break;

case 6:
$ad_tipkuzova="Кроссовер";
break;

case 7:
$ad_tipkuzova="Купе";
break;

case 8:
$ad_tipkuzova="Лимузин";
break;

case 9:
$ad_tipkuzova="Минивен";
break;

case 10:
$ad_tipkuzova="Пикап";
break;

case 11:
$ad_tipkuzova="Фургон";
break;

case 12:
$ad_tipkuzova="Микроавтобус";
break;

}


$query_events_4 = $db->getQuery(true);

$query_events_4->select(array('fieldid', 'fieldtitle', 'fieldvalue'));
$query_events_4->from('#__adsmanager_field_values');
$query_events_4->where('fieldid LIKE \'13\'');

$db->setQuery($query_events_4);

$results4 = $db->loadObjectList();

foreach($results4 as $element_4) {

//echo "--- ".($element_4->fieldtitle)."<br>";
//echo "--- ".($ad_tipkuzova)."<br>";

if(($element_4->fieldtitle)==$ad_tipkuzova){



echo'
<script type="text/javascript">
document.getElementById(\'ad_kuzov\').value = "'.($element_4->fieldvalue).'";
</script>
';
break;	

}

}



	





//echo"".$ad_tipkuzova."<br>";




switch($ad_tipdvigatelya)
{
case 1:
$ad_tipdvigatelya="Бензиновый";
break;

case 2:
$ad_tipdvigatelya="Дизельный";
break;

case 3:
$ad_tipdvigatelya="Гибридный";
break;

}




//echo"".$ad_tipdvigatelya."<br>";



$query_events_5 = $db->getQuery(true);

$query_events_5->select(array('fieldid', 'fieldtitle', 'fieldvalue'));
$query_events_5->from('#__adsmanager_field_values');
$query_events_5->where('fieldid LIKE \'15\'');

$db->setQuery($query_events_5);

$results5 = $db->loadObjectList();

foreach($results5 as $element_5) {

//echo "--- ".($element_5->fieldtitle)."<br>";
//echo "--- ".($ad_tipdvigatelya)."<br>";

if(($element_5->fieldtitle)==$ad_tipdvigatelya){



echo'
<script type="text/javascript">
document.getElementById(\'ad_type\').value = "'.($element_5->fieldvalue).'";
</script>
';
break;	

}

}












switch($ad_objemdvigatelya)
{
case 1:
$ad_objemdvigatelya="0.8";
break;

case 2:
$ad_objemdvigatelya="0.9";
break;

case 3:
$ad_objemdvigatelya="1.0";
break;

case 4:
$ad_objemdvigatelya="1.1";
break;

case 5:
$ad_objemdvigatelya="1.2";
break;

case 6:
$ad_objemdvigatelya="1.3";
break;

case 7:
$ad_objemdvigatelya="1.4";
break;

case 8:
$ad_objemdvigatelya="1.5";
break;

case 9:
$ad_objemdvigatelya="1.6";
break;

case 10:
$ad_objemdvigatelya="1.7";
break;

case 11:
$ad_objemdvigatelya="1.8";
break;

case 12:
$ad_objemdvigatelya="1.9";
break;

case 13:
$ad_objemdvigatelya="2.0";
break;

case 14:
$ad_objemdvigatelya="2.1";
break;

case 15:
$ad_objemdvigatelya="2.2";
break;

case 16:
$ad_objemdvigatelya="2.3";
break;

case 17:
$ad_objemdvigatelya="2.4";
break;

case 18:
$ad_objemdvigatelya="2.5";
break;

case 19:
$ad_objemdvigatelya="2.6";
break;

case 20:
$ad_objemdvigatelya="2.7";
break;

case 21:
$ad_objemdvigatelya="2.8";
break;

case 22:
$ad_objemdvigatelya="2.9";
break;

case 23:
$ad_objemdvigatelya="3.0";
break;

case 24:
$ad_objemdvigatelya="3.1";
break;

case 25:
$ad_objemdvigatelya="3.2";
break;

case 26:
$ad_objemdvigatelya="3.3";
break;

case 27:
$ad_objemdvigatelya="3.4";
break;

case 28:
$ad_objemdvigatelya="3.5";
break;

case 29:
$ad_objemdvigatelya="3.6";
break;

case 30:
$ad_objemdvigatelya="3.7";
break;

case 31:
$ad_objemdvigatelya="3.8";
break;

case 32:
$ad_objemdvigatelya="3.9";
break;

case 33:
$ad_objemdvigatelya="4.0";
break;

case 34:
$ad_objemdvigatelya="4.1";
break;

case 35:
$ad_objemdvigatelya="4.2";
break;

case 36:
$ad_objemdvigatelya="4.3";
break;

case 37:
$ad_objemdvigatelya="4.4";
break;

case 38:
$ad_objemdvigatelya="4.5";
break;

case 39:
$ad_objemdvigatelya="4.6";
break;

case 40:
$ad_objemdvigatelya="4.7";
break;

case 41:
$ad_objemdvigatelya="4.8";
break;

case 42:
$ad_objemdvigatelya="4.9";
break;

case 43:
$ad_objemdvigatelya="5.0";
break;

case 44:
$ad_objemdvigatelya="5.1";
break;

case 45:
$ad_objemdvigatelya="5.2";
break;

case 46:
$ad_objemdvigatelya="5.3";
break;

case 47:
$ad_objemdvigatelya="5.4";
break;

case 48:
$ad_objemdvigatelya="5.5";
break;

case 49:
$ad_objemdvigatelya="5.6";
break;

case 50:
$ad_objemdvigatelya="5.7";
break;

case 51:
$ad_objemdvigatelya="5.8";
break;

case 52:
$ad_objemdvigatelya="5.9";
break;

case 53:
$ad_objemdvigatelya="6.0";
break;

}



//echo"".$ad_objemdvigatelya."<br>";





$query_events_6 = $db->getQuery(true);

$query_events_6->select(array('fieldid', 'fieldtitle', 'fieldvalue'));
$query_events_6->from('#__adsmanager_field_values');
$query_events_6->where('fieldid LIKE \'14\'');

$db->setQuery($query_events_6);

$results6 = $db->loadObjectList();

foreach($results6 as $element_6) {

//echo "--- ".($element_6->fieldtitle)."<br>";
//echo "--- ".($ad_objemdvigatelya)."<br>";

if(($element_6->fieldtitle)==$ad_objemdvigatelya){



echo'
<script type="text/javascript">
document.getElementById(\'ad_litr\').value = "'.($element_6->fieldvalue).'";
</script>
';
break;	

}

}













//echo"".$ad_godvipuska."<br>";






$query_events_god = $db->getQuery(true);

$query_events_god->select(array('fieldid', 'fieldtitle', 'fieldvalue'));
$query_events_god->from('#__adsmanager_field_values');
$query_events_god->where('fieldid LIKE \'12\'');

$db->setQuery($query_events_god);

$resultsgod = $db->loadObjectList();

foreach($resultsgod as $element_god) {

//echo "--- ".($element_god->fieldtitle)."<br>";
//echo "--- ".($ad_objemdvigatelya)."<br>";

if(($element_god->fieldtitle)==$ad_godvipuska){



echo'
<script type="text/javascript">
document.getElementById(\'ad_year\').value = "'.($element_god->fieldvalue).'";
</script>
';
break;	

}

}







switch($ad_cviet)
{
case 1:
$ad_cviet="Бежевый";
break;

case 2:
$ad_cviet="Белый";
break;

case 3:
$ad_cviet="Голубой";
break;

case 4:
$ad_cviet="Жёлтый";
break;

case 5:
$ad_cviet="Зелёный";
break;

case 6:
$ad_cviet="Золотой";
break;

case 7:
$ad_cviet="Коричневый";
break;

case 8:
$ad_cviet="Красный";
break;

case 9:
$ad_cviet="Оранжевый";
break;

case 10:
$ad_cviet="Пурпурный";
break;

case 11:
$ad_cviet="Розовый";
break;

case 12:
$ad_cviet="Серебряный";
break;

case 13:
$ad_cviet="Серый";
break;

case 14:
$ad_cviet="Синий";
break;

case 15:
$ad_cviet="Филетовый";
break;

case 16:
$ad_cviet="Чёрный";
break;

}
//echo"".$ad_cviet."<br>";


$query_events_7 = $db->getQuery(true);

$query_events_7->select(array('fieldid', 'fieldtitle', 'fieldvalue'));
$query_events_7->from('#__adsmanager_field_values');
$query_events_7->where('fieldid LIKE \'18\'');

$db->setQuery($query_events_7);

$results7 = $db->loadObjectList();

foreach($results7 as $element_7) {

//echo "--- ".($element_7->fieldtitle)."<br>";
//echo "--- ".($ad_cviet)."<br>";

if(($element_7->fieldtitle)==$ad_cviet){



echo'
<script type="text/javascript">
document.getElementById(\'ad_color\').value = "'.($element_7->fieldvalue).'";
</script>
';
break;	

}

}




switch($ad_rul)
{
case 1:
$ad_rul="Левый";
break;

case 2:
$ad_rul="Правый";
break;

}
//echo"".$ad_rul."<br>";


$query_events_8 = $db->getQuery(true);

$query_events_8->select(array('fieldid', 'fieldtitle', 'fieldvalue'));
$query_events_8->from('#__adsmanager_field_values');
$query_events_8->where('fieldid LIKE \'16\'');

$db->setQuery($query_events_8);

$results8 = $db->loadObjectList();

foreach($results8 as $element_8) {

//echo "--- ".($element_8->fieldtitle)."<br>";
//echo "--- ".($ad_rul)."<br>";

if(($element_8->fieldtitle)==$ad_rul){



echo'
<script type="text/javascript">
document.getElementById(\'ad_rul\').value = "'.($element_8->fieldvalue).'";
</script>
';
break;	

}

}








switch($ad_korobkaperedach)
{
case 1:
$ad_korobkaperedach="Автоматическая";
break;

case 2:
$ad_korobkaperedach="Механическая";
break;

case 3:
$ad_korobkaperedach="Вариатор";
break;

case 4:
$ad_korobkaperedach="Робот";
break;

}
//echo"".$ad_korobkaperedach."<br>";





$query_events_9 = $db->getQuery(true);

$query_events_9->select(array('fieldid', 'fieldtitle', 'fieldvalue'));
$query_events_9->from('#__adsmanager_field_values');
$query_events_9->where('fieldid LIKE \'19\'');

$db->setQuery($query_events_9);

$results9 = $db->loadObjectList();

foreach($results9 as $element_9) {

//echo "--- ".($element_9->fieldtitle)."<br>";
//echo "--- ".($ad_korobkaperedach)."<br>";

if(($element_9->fieldtitle)==$ad_korobkaperedach){



echo'
<script type="text/javascript">
document.getElementById(\'ad_korobka\').value = "'.($element_9->fieldvalue).'";
</script>
';
break;	

}

}














switch($ad_privod)
{
case 1:
$ad_privod="Передний";
break;

case 2:
$ad_privod="Задний";
break;

case 3:
$ad_privod="Полный";
break;


}


//echo"".$ad_privod."<br>";



$query_events_10 = $db->getQuery(true);

$query_events_10->select(array('fieldid', 'fieldtitle', 'fieldvalue'));
$query_events_10->from('#__adsmanager_field_values');
$query_events_10->where('fieldid LIKE \'20\'');

$db->setQuery($query_events_10);

$results10 = $db->loadObjectList();

foreach($results10 as $element_10) {

//echo "--- ".($element_10->fieldtitle)."<br>";
//echo "--- ".($ad_privod)."<br>";

if(($element_10->fieldtitle)==$ad_privod){



echo'
<script type="text/javascript">
document.getElementById(\'ad_privod\').value = "'.($element_10->fieldvalue).'";
</script>
';
break;	

}

}








//echo"".$ad_obshiiprobeg."<br>";





//получение из соц. сети ссылки на сервисную книжку и историю
/*

echo $_GET['history']."<br>";
echo $_GET['service_book']."<br>";


if((!isset($_GET['history']))||($_GET['history']==NULL)||($_GET['history']=="")){


}else{


$str_hiasory='<a href="/istorii-avtomobilej-polzovatelej/entry/'.$_GET['history'].'\">История автомобиля</a><br>';

echo'
<script type="text/javascript">
document.getElementById(\'ad_text\').value = "";
</script>
';


}

*/



}


?>






