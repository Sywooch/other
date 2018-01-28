<?php
/**
* @copyright (C) 2013 iJoomla, Inc. - All rights reserved.
* @license GNU General Public License, version 2 (http://www.gnu.org/licenses/gpl-2.0.html)
* @author iJoomla.com <webmaster@ijoomla.com>
* @url https://www.jomsocial.com/license-agreement
* The PHP code portions are distributed under the GPL license. If not otherwise stated, all images, manuals, cascading style sheets, and included JavaScript *are NOT GPL, and are released under the IJOOMLA Proprietary Use License v1.0
* More info at https://www.jomsocial.com/license-agreement
*/
defined('_JEXEC') or die();
$validPassword = JText::sprintf( JText::_( 'JLIB_DATABASE_ERROR_VALID_AZ09', true ), JText::_( 'Password', true ), 4 );
?>
<style>
	input{
		
	}
	input:hover{
		color: #444 !important;
		background: none repeat scroll 0px 0px #EEE !important;
		border: 1px solid #DDD !important;
		border-radius: 4px !important;
	}
</style>



<?php
echo'
<script type="text/javascript" src="/social/js/jquery-1.11.1.min.js"></script>
';
?>
<script type="text/javascript">
function form_1(){

$('#form_1').show('slow');
   
}

function form_1_close(){

$('#form_1').hide('slow');

}
</script>

<script type="text/javascript">
function select_1(n,m){

//alert(n);
//alert(m);

if(document.getElementById(m).style.color=='blue')
{
document.getElementById(m).style.color = 'black';

}else{
document.getElementById(m).style.color = 'blue';
}


 for(var i = 0; i < document.getElementById('field17').length; i++)   {
       if(document.getElementById('field17').options[i].value == n) {
	   
	   if(document.getElementById('field17').options[i].selected == true){
       document.getElementById('field17').options[i].selected = false;
	   }
	   else{
	   document.getElementById('field17').options[i].selected = true;
	   }
       
	   
	   
	   }

}





}
</script>





<!-------------------------------------------------------------->

<?php
$db = JFactory::getDbo();
$query_events_form = $db->getQuery(true);

$query_events_form->select(array('id', 'options', 'ordering'));
$query_events_form->from('#__community_fields');
$query_events_form->where('ordering LIKE \'19\'');

$db->setQuery($query_events_form);

$results_form = $db->loadObjectList();


foreach($results_form as $element_form) {


$MAS_tmp1_form=explode("\n",$element_form->options);



for ($i_form = 0; $i_form < count($MAS_tmp1_form); $i_form++) 
{

$MAS_tmp1_form2[$i_form]=str_replace(" ","",$MAS_tmp1_form[$i_form]);


echo'
<script type="text/javascript">
function ml_'.$MAS_tmp1_form2[$i_form].'(){

$(\'#form_'.$MAS_tmp1_form2[$i_form].'\').show(\'slow\');

}
</script>
';

echo'
<script type="text/javascript">
function form_'.$MAS_tmp1_form2[$i_form].'_close(){

$(\'#form_'.$MAS_tmp1_form2[$i_form].'\').hide(\'slow\');

}
</script>';



echo'
<div id="form_'.$MAS_tmp1_form2[$i_form].'" name="form_'.$MAS_tmp1_form2[$i_form].'" 
style="position:fixed; width:800px; height:600px; top:50%; left:50%;
margin-top:-300px; margin-left:-400px;
 display:none; background-color:white; border:2px blue solid;
z-index:99999;  overflow:auto;">
<div style="width:100%; height:20px; ">
<span style="float:right; margin-right:5px; cursor:pointer; " onclick="form_'.$MAS_tmp1_form2[$i_form].'_close();">Закрыть</span>
</div>';
//выборка по определённой марке

echo'
<div align="center" style="width:100%; height:40px;">'.$MAS_tmp1_form[$i_form].'</div>
';

//$MAS_tmp1_form[$i_form]

	$db = JFactory::getDbo();
$query_events_2_v = $db->getQuery(true);

$query_events_2_v->select(array('id', 'options', 'ordering'));
$query_events_2_v->from('#__community_fields');
$query_events_2_v->where('ordering LIKE \'17\'');


$db->setQuery($query_events_2_v);
  
  
$results2_v = $db->loadObjectList();

//	echo $MAS_tmp1[$i]."<br>";

////////////////////////////////
echo'<div align="left" style="width:330px; background-color:transparent; float:left;">';

foreach($results2_v as $element_2_v) {


$MAS_v_v=explode("\n",$element_2_v->options);

for($iv_v=0; $iv_v<count($MAS_v_v); $iv_v++){



$MAS_len_v=strlen($MAS_tmp1_form[$i_form]);


$sub_1_v=substr($MAS_v_v[$iv_v], 0, ($MAS_len_v));

//$sub_1_v=str_replace(" ","",$sub_1_v);




//echo"MAS_tmp1_form[i_form] ".$MAS_tmp1_form[$i_form]."<br>";
//echo"sub_1_v ".$sub_1_v."<br>";
//echo"MAS_v_v[iv_v] ".$MAS_v_v[$iv_v]."<br>";



if($MAS_tmp1_form[$i_form]==$sub_1_v){

$tmp_MAS_v_v=str_replace(" ","",$MAS_v_v[$iv_v]);

if(strpos($tmp_MAS_v_v,"#")==true){ continue; }

echo '<span id="'.$tmp_MAS_v_v.'" 
style="margin-left:20px; cursor:pointer;" 
onclick="select_1(\''.$MAS_v_v[$iv_v].'\',\''.$tmp_MAS_v_v.'\')">'.$MAS_v_v[$iv_v]."</span><br>";


}


}



}

echo'</div>';


echo'



<div style="width:360px; float:left;">

<div align="center" style="width:100%; height:30px;">
<span style="cursor:pointer; text-decoration:underline;" 
onclick="showTooltip_'.$MAS_tmp1_form2[$i_form].'();">У меня несколько машин одной марки</span></div>

<div style="width:360px; background-color:transparent; margin-left:30px; 
display:none;" id="my_'.$MAS_tmp1_form2[$i_form].'">
';


foreach($results2_v as $element_2_v) {


$MAS_v_v=explode("\n",$element_2_v->options);

$tmp_count=0;

for($iv_v=0; $iv_v<count($MAS_v_v); $iv_v++){



$MAS_len_v=strlen($MAS_tmp1_form[$i_form]);


$sub_1_v=substr($MAS_v_v[$iv_v], 0, ($MAS_len_v));

//$sub_1_v=str_replace(" ","",$sub_1_v);




//echo"MAS_tmp1_form[i_form] ".$MAS_tmp1_form[$i_form]."<br>";
//echo"sub_1_v ".$sub_1_v."<br>";
//echo"MAS_v_v[iv_v] ".$MAS_v_v[$iv_v]."<br>";



if($MAS_tmp1_form[$i_form]==$sub_1_v){

$tmp_MAS_v_v=str_replace(" ","",$MAS_v_v[$iv_v]);

if(strpos($tmp_MAS_v_v,"#")==false){ continue; }


echo '<span id="'.$tmp_MAS_v_v.'" 
style="margin-left:20px; cursor:pointer;" 
onclick="select_1(\''.$MAS_v_v[$iv_v].'\',\''.$tmp_MAS_v_v.'\')">'.$MAS_v_v[$iv_v]."</span><br>";

if($tmp_count==1){  echo"<br>"; $tmp_count=0; }else{

$tmp_count++;

}
}


}



}


echo'
</div>
</div>

<script type="text/javascript">
function showTooltip_'.$MAS_tmp1_form2[$i_form].'(){

var myDiv=document.getElementById(\'my_'.$MAS_tmp1_form2[$i_form].'\');
myDiv.style.display=\'block\';

}
</script>

';


////////////////////////////////




//выборка по определённой марке



echo'
</div>';




}


}


?>



<!-------------------------------------------------------------->







<?php if( $showProfileType ){ ?>
<div class="com-notice">
		<?php if( $multiprofile->id != COMMUNITY_DEFAULT_PROFILE ){ ?>
			<?php echo JText::sprintf('COM_COMMUNITY_CURRENT_PROFILE_TYPE' , $multiprofile->name );?>
		<?php } else { ?>
			<?php echo JText::_('COM_COMMUNITY_CURRENT_DEFAULT_PROFILE_TYPE');?>
		<?php } ?>
		[ <a href="<?php echo CRoute::_('index.php?option=com_community&view=multiprofile&task=changeprofile');?>"><?php echo JText::_('COM_COMMUNITY_CHANGE');?></a> ]
</div>
<?php } ?>

<div class="cLayout cProfile-Edit">
<?php


$name_tmp_reg=$user->get('username');

//выборка данных о поле, городе и дате рождения пользователя
//$name_tmp_reg
require ''.JPATH_ROOT.'/config_db_rostavto/config.php';

$dbh=mysql_connect(DB_SERVER_RA,DB_USER_RA,DB_PASS_RA) or die ("Невозможно соединиться с сервером.");

mysql_select_db(DB_BASE_RA) or die ("Невозможно подключиться к базе.");
mysql_query("set character_set_results='utf8'");
			mysql_query("SET NAMES utf8");
			
mysql_query ("SET COLLATION_CONNECTION=utf8");
mysql_query("SET CHARACTER_SET_CLIENT=utf8");
mysql_query("SET CHARACTER_SET_RESULTS=utf8");



$db = JFactory::getDbo();
$query_events_r = $db->getQuery(true);

$query_events_r->select(array('id', 'username'));
$query_events_r->from('#__users');

//$conditions = array(
//  'name LIKE \'ad_diagnostika%\' ');

//$query_events_r->where($conditions);
$query_events_r->where('username LIKE \''.$name_tmp_reg.'\'');


$db->setQuery($query_events_r);

$results = $db->loadObjectList();

foreach($results as $element_r) {

$id_user_tmp=$element_r->id;

break;
}



$db = JFactory::getDbo();
$query_events_r_city = $db->getQuery(true);

//информация о городе
$query_events_r_city->select(array('user_id, value'));
$query_events_r_city->from('#__community_fields_values');

$query_events_r_city->where('field_id LIKE \'10\'');

$db->setQuery($query_events_r_city);

$results_city = $db->loadObjectList();

foreach($results_city as $element_r_city) {

if(($element_r_city->user_id)==$id_user_tmp){

$city_tmp=$element_r_city->value;

break;

}
}





$db = JFactory::getDbo();
$query_events_r_gender = $db->getQuery(true);


//информация о поле
$query_events_r_gender->select(array('id', 'value'));
$query_events_r_gender->from('#__community_fields_values');
$query_events_r_gender->where('user_id LIKE \''.$id_user_tmp.'\'');
$query_events_r_gender->where('field_id LIKE \'2\'');

$db->setQuery($query_events_r_gender);

$results = $db->loadObjectList();

foreach($results as $element_r_gender) {

$gender_tmp=$element_r_gender->value;

break;
}


$db = JFactory::getDbo();
$query_events_r_birthdate = $db->getQuery(true);

//информация о дате рождения
$query_events_r_birthdate->select(array('id', 'value'));
$query_events_r_birthdate->from('#__community_fields_values');
$query_events_r_birthdate->where('user_id LIKE \''.$id_user_tmp.'\'');
$query_events_r_birthdate->where('field_id LIKE \'3\'');

$db->setQuery($query_events_r_birthdate);

$results = $db->loadObjectList();

foreach($results as $element_r_birthdate) {

$birthdate_tmp=$element_r_birthdate->value;

break;
}



//вставка информации о городе, поле, дате рождения в базу rostavto


$query2r="SELECT * FROM boc9w_users WHERE username='".$name_tmp_reg."'";

$res2r=mysql_query($query2r);
					if($res2r==false){
	    			echo"Ошибка выполнения запроса.</br>";
					echo mysql_error();
					exit; }

while($row2r=mysql_fetch_array($res2r)){

$id2_tmp_reg=$row2r['id'];
break;
}






/*
$query3="INSERT INTO test (name) VALUES ('".$name_tmp_reg." = ".$id2_tmp_reg."')";
$res3=mysql_query($query3);
					if($res3==false){
	    			echo"Ошибка выполнения запроса.</br>";
					echo mysql_error();
					exit; }
*/

if($gender_tmp=="Муж."){ $gender_tmp="1";  }
else if($gender_tmp=="Жен."){ $gender_tmp="2";  };

//$query4="UPDATE boc9w_users SET block='0' WHERE username='$name_tmp_reg' ";
$query3r="UPDATE boc9w_kunena_users 
SET gender='".$gender_tmp."', birthdate='".$birthdate_tmp."', location='".$city_tmp."' WHERE userid='$id2_tmp_reg'";

$res3r=mysql_query($query3r);
					if($res3r==false){
	    			echo"Ошибка выполнения запроса.</br>";
					echo mysql_error();
					exit; }






?>
		<!-- Tab header -->
		<ul class="cTabsMenu cResetList cFloatedList clearfix">
			<li><a href="#basicSet" style="color:#760F00;"><?php echo JText::_('COM_COMMUNITY_PROFILE_SETTING_INFO');?></a></li>
			<li><a href="#detailSet" style="color:#760F00;"><?php echo JText::_('COM_COMMUNITY_PROFILE_SETTING_INFO_DETAILS');?></a></li>
		</ul>
		<!-- Tab content -->
		<div class="cTabsContent">						
			<div id="basicSet" class="section"> <!-- Profile Basic Setting -->
				<form name="jsform-profile-edit" id="frmSaveProfile" action="<?php echo CRoute::getURI(); ?>" method="POST" class="cForm community-form-validate">
					<?php
					foreach ( $fields as $name => $fieldGroup )
					{
							if ($name != 'ungrouped')
							{
					?>
					<div class="ctitle">
						<h2 style="color:#760F00;"><?php echo JText::_( $name );?></h2>
					</div>
					<?php
							}
					?>
					<ul class="cFormList cFormHorizontal cResetList" style="background-color:transparent;">
						<?php
							foreach ( $fieldGroup as $f )
							{
								$f = JArrayHelper::toObject ( $f );

								// DO not escape 'SELECT' values. Otherwise, comparison for
								// selected values won't work
								if($f->type != 'select'){
									$f->value	= $this->escape( $f->value );
								}
						?>
								<li>
									<label id="lblfield<?php echo $f->id;?>" for="field<?php echo $f->id;?>" class="form-label">
										<?php echo JText::_( $f->name );?><?php if($f->required == 1) echo '<span class="required-sign"> *</span>'; ?>
									</label>
									<div class="form-field" style="background-color:transparent;">
										<?php echo CProfileLibrary::getFieldHTML( $f , '' ); ?>
										<div class="form-privacy">
											<?php echo CPrivacy::getHTML( 'privacy' . $f->id , $f->access ); ?>
										</div>
										
							




	
						
					<?php 
					
					if(($f->id)=="17"){
					
	echo'<div style="width:200px; height:300px; overflow:auto; float:left;">';				
					
					
					$db = JFactory::getDbo();
$query_events_1 = $db->getQuery(true);

$query_events_1->select(array('id', 'options', 'ordering'));
$query_events_1->from('#__community_fields');
$query_events_1->where('ordering LIKE \'19\'');

$db->setQuery($query_events_1);

$results = $db->loadObjectList();


foreach($results as $element_1) {
 
//echo $element_1->options."<br>";

$MAS_tmp1=explode("\n",$element_1->options);


for ($i = 0; $i < count($MAS_tmp1); $i++) 
  { 
  
  
  		$db = JFactory::getDbo();
$query_events_2 = $db->getQuery(true);

$query_events_2->select(array('id', 'options', 'ordering'));
$query_events_2->from('#__community_fields');
$query_events_2->where('ordering LIKE \'17\'');


$db->setQuery($query_events_2);
  
  
$results2 = $db->loadObjectList();

//	echo $MAS_tmp1[$i]."<br>";


foreach($results2 as $element_2) {

//echo $element_2->options."<br>";

$MAS_v=explode("\n",$element_2->options);

for($iv=0; $iv<count($MAS_v); $iv++){


$MAS_len=strlen($MAS_tmp1[$i]);

//echo $MAS_v[$iv]."<br>";
//echo $MAS_len."<br>";


$sub_1=substr($MAS_v[$iv], 0, ($MAS_len));

//echo $sub_1."<br>";

if($MAS_tmp1[$i]==$sub_1){

//echo $MAS_v[$iv]."<br>";

$MAS_tmp1_d=str_replace(" ","",$MAS_tmp1[$i]);

echo'<span style="cursor:pointer;"  onclick="ml_'.$MAS_tmp1_d.'();">'.$MAS_tmp1[$i].'</span><br>';

break;
}




}

}




 //  echo'<span style="cursor:pointer;"  onclick="ml(\''.$MAS_tmp3[i2].'\')">'.$MAS_tmp1[$i].'</span><br>'; 

	
	
  } 


}
					
	


echo"</div>";
				
					
					
				//	echo'<input type="button" value="Выбрать через форму" style="padding:30px; margin-left:20px; " 
					//onclick="form_1();"/>';
				
?>



<?php
	
					}					
					
					?>



			
										
										
										
										
									</div>
								</li>
						<?php
							}
						?>
					</ul>
					<?php
					}
					?>

					<?php if(!empty($afterFormDisplay)){ ?>
						<?php echo $afterFormDisplay; ?>
					<?php } ?>
					
				
					<ul class="cFormList cFormHorizontal cResetList">
						<li class="has-seperator">
							<div class="form-field">
								<span class="form-helper"><?php echo JText::_( 'COM_COMMUNITY_REGISTER_REQUIRED_FILEDS' ); ?></span>
							</div>
						</li>
						<li>
							<div class="form-field">
								<input type="hidden" name="action" value="profile" />								
								<?php echo JHTML::_( 'form.token' ); ?>
								<input type="submit" name="frmSubmit" onclick="submitbutton('frmSaveProfile'); return false;" class="btn btn-primary btn1" value="<?php echo JText::_('COM_COMMUNITY_SAVE_BUTTON'); ?>" />
							</div>
						</li>
					</ul>
				</form>
			</div> <!-- end basic setting -->
													
			<div id="detailSet" class="section"> <!-- Profile Detail Setting -->
				<form name="jsform-profile-edit" id="frmSaveDetailProfile" action="<?php echo CRoute::getURI(); ?>" method="POST" class="cForm community-form-validate">
					<?php if(!empty($beforeFormDisplay)){ ?>
					<div class="before-form">
						<?php echo $beforeFormDisplay; ?>
					</div>
					<?php } ?>

					<ul class="cFormList cFormHorizontal cResetList">
						<!-- username -->
						<li>
							<label class="form-label" for="username"><?php echo JText::_('COM_COMMUNITY_PROFILE_USERNAME'); ?></label>
							<div class="form-field">
								<span class="uneditable-input"><?php echo $this->escape($user->get('username')); ?></span>
							</div>
						</li>
						<?php if (!$isUseFirstLastName) { ?>
						<!-- fullname -->
						<li>
							<label class="form-label" for="name"><?php echo JText::_('COM_COMMUNITY_PROFILE_YOURNAME'); ?></label>
							<div class="form-field">
								<input class="input text" type="text" id="name" name="name" size="40" value="<?php echo $this->escape($user->get('name'));?>" />
							</div>
						</li>
						<?php } ?>
						<!-- email -->
						<li>
							<label class="form-label" for="jsemail"><?php echo JText::_( 'COM_COMMUNITY_EMAIL' ); ?></label>
							<div class="form-field">
								<input type="text" class="input text" id="jsemail" name="jsemail" size="40" value="<?php echo $this->escape( $user->get('email') ); ?>" />
								<input type="hidden" id="email" name="email" value="<?php echo $user->get('email'); ?>" />
								<input type="hidden" id="emailpass" name="emailpass" id="emailpass" value="<?php echo $this->escape( $user->get('email') ); ?>"/>
								<span id="errjsemailmsg" style="display:none;">&nbsp;</span>
							</div>
						</li>
						<?php if ( !$associated ) : ?>
						<?php     if ( $user->get('password') ) : ?>
						<!-- password -->
						<li>
							<label class="form-label" for="jspassword"><?php echo JText::_( 'COM_COMMUNITY_PASSWORD' ); ?></label>
							<div class="form-field">
								<input id="jspassword" name="jspassword" class="input password" size="40" type="password" value="" />
								<span id="errjspasswordmsg" style="display: none;"> </span>
							</div>
						</li>
						<!-- 2nd password -->
						<li>
							<label class="form-label" for="jspassword2"><?php echo JText::_( 'COM_COMMUNITY_VERIFY_PASSWORD' ); ?></label>
							<div class="form-field">
								<input id="jspassword2" name="jspassword2" class="input password" type="password" size="40" value="" />
								<span id="errjspassword2msg" style="display:none;"> </span>
								<div style="clear:both;"></div>
								<span id="errpasswordmsg" style="display:none;">&nbsp;</span>
							</div>
						</li>
						<?php     endif; ?>
						<?php endif; ?>

						<?php if(isset($params))
								echo $params->render( 'params' );
						 ?>

						<!-- DST -->
						<li class="has-seperator">
								<label class="form-label jomNameTips" title="<?php echo JText::_('COM_COMMUNITY_DAYLIGHT_SAVING_OFFSET_TOOLTIP');?>" for="daylightsavingoffset">
									<?php echo JText::_( 'COM_COMMUNITY_DAYLIGHT_SAVING_OFFSET' ); ?>
								</label>
							<div class="form-field">
								<?php echo $offsetList; ?>
							</div>
						</li>

						<!-- group buttons -->
						<input type="hidden" name="id" value="<?php echo $user->get('id');?>" />
						<input type="hidden" name="gid" value="<?php echo $user->get('gid');?>" />
						<input type="hidden" name="option" value="com_community" />
						<input type="hidden" name="view" value="profile" />
						<input type="hidden" name="task" value="edit" />
						<input type="hidden" id="password" name="password" />
						<input type="hidden" id="password2" name="password2" />						

					</ul>

					<?php
					if( $config->get('fbconnectkey') && $config->get('fbconnectsecret') )
					{
					?>
						<div class="ctitle"><h2><?php echo JText::_('COM_COMMUNITY_ASSOCIATE_FACEBOOK_LOGIN' );?></h2></div>
					<?php
						if( $isAdmin )
						{
					?>
						<div class="small facebook"><?php echo JText::_('COM_COMMUNITY_ADMIN_NOT_ALLOWED_TO_ASSOCIATE_FACEBOOK');?></div>
					<?php
						}
						else
						{
							if( $associated )
							{
							?>
								<div class="small facebook"><?php echo JText::_('COM_COMMUNITY_ACCOUNT_ALREADY_MERGED');?></div>
								<!--
								<div>
									<input<?php echo $readPermission ? ' checked="checked" disabled="true"' : '';?> type="checkbox" id="facebookread" name="connectpermission" onclick="FB.Connect.showPermissionDialog('read_stream', function(x){if(!x){ joms.jQuery('#facebookread').attr('checked',false);}}, true );">
									<label for="facebookread" style="display: inline;"><?php echo JText::_('COM_COMMUNITY_ALLOW_SITE_TO_READ_UPDATES_FROM_YOUR_FACEBOOK_ACCOUNT');?></label>
								</div>
								-->
								<br/>
								<div>
									<input<?php echo !empty($fbPostStatus) ? ' checked="checked"' : '';?> type="checkbox" id="postFacebookStatus" name="postFacebookStatus">
									<label for="postFacebookStatus" style="display: inline;"><?php echo JText::_('COM_COMMUNITY_ALLOW_SITE_TO_PUBLISH_UPDATES_TO_YOUR_FACEBOOK_ACCOUNT');?></label>
								</div>
							<?php
							}
							else
							{
								echo $fbHtml;
							}
						}
					}
					?>
					
					<ul class="cFormList cFormHorizontal cResetList">
						<li class="has-seperator">
							<div class="form-field">
								<span class="form-helper"><?php echo JText::_( 'COM_COMMUNITY_REGISTER_REQUIRED_FILEDS' ); ?></span>
							</div>
						</li>
						<li>
							<div class="form-field">
								<input type="hidden" name="action" value="detail" />								
								<?php echo JHTML::_( 'form.token' ); ?>
								<input type="submit" name="frmSubmit" onclick="submitbutton('frmSaveDetailProfile'); return false;" class="btn btn-primary" value="<?php echo JText::_('COM_COMMUNITY_SAVE_BUTTON'); ?>" />
							</div>
						</li>
					</ul>
				</form>			
			</div>											
	</div> <!-- .end: .cTabsContent-->
</div>
<script type="text/javascript">
	cvalidate.init();
	cvalidate.setSystemText('REM','<?php echo addslashes(JText::_("COM_COMMUNITY_ENTRY_MISSING")); ?>');
	cvalidate.setSystemText('JOINTEXT','<?php echo addslashes(JText::_("COM_COMMUNITY_AND")); ?>');

	joms.jQuery( document ).ready( function(){

		joms.privacy.init();

	var tabContainers = joms.jQuery('.cTabsContent > div');

	var url = document.location.href;

	var filter = ':first';

	if(url.indexOf("#detailSet")!== -1)
	{
		filter = ':last';
	}

	joms.jQuery('.cTabsMenu li a').click(function () {
		tabContainers.hide().filter(this.hash).fadeIn(500);
		joms.jQuery('.cTabsMenu li a').removeClass('selected');
		joms.jQuery(this).addClass('selected');
		return false;
	}).filter(filter).click();

	});

function submitbutton(formId) {
	var r = new RegExp("[\<|\>|\"|\'|\%|\;|\(|\)|\&|\+|\-]", "i");

	//hide all the error messsage span 1st
	joms.jQuery('#name').removeClass('invalid');
	joms.jQuery('#jspassword').removeClass('invalid');
	joms.jQuery('#jspassword2').removeClass('invalid');
	joms.jQuery('#jsemail').removeClass('invalid');

	joms.jQuery('#errnamemsg').hide();
	joms.jQuery('#errnamemsg').html('&nbsp');

	joms.jQuery('#errpasswordmsg').hide();
	joms.jQuery('#errpasswordmsg').html('&nbsp');

	joms.jQuery('#errjsemailmsg').hide();
	joms.jQuery('#errjsemailmsg').html('&nbsp');

	joms.jQuery('#password').val(joms.jQuery('#jspassword').val());
	joms.jQuery('#password2').val(joms.jQuery('#jspassword2').val());

	// do field validation
	var isValid	= true;

	if (joms.jQuery('#name').val() == "") {
		isValid = false;
		joms.jQuery('#errnamemsg').html('<?php echo addslashes(JText::_( 'COM_COMMUNITY_PLEASE_ENTER_NAME', true ));?>');
		joms.jQuery('#errnamemsg').show();
		joms.jQuery('#name').addClass('invalid');
	}

	if(joms.jQuery('#jsemail').val() !=  joms.jQuery('#email').val())
	{
		regex=/^[a-zA-Z0-9._-]+@([a-zA-Z0-9.-]+\.)+[a-zA-Z0-9.-]{2,4}$/;
		isValid = regex.test(joms.jQuery('#jsemail').val());

		var fieldname = joms.jQuery('#jsemail').attr('name');;
		if(isValid == false){
			cvalidate.setMessage(fieldname, '', 'COM_COMMUNITY_INVALID_EMAIL');
			joms.jQuery('#jsemail').addClass('invalid');
		}
	}

	if(joms.jQuery('#password').val().length > 0 || joms.jQuery('#password2').val().length > 0) {
		//check the password only when the password is not empty!
		if(joms.jQuery('#password').val().length < 6 ){
			isValid = false;
			joms.jQuery('#jspassword').addClass('invalid');
			alert('<?php echo addslashes(JText::_( 'COM_COMMUNITY_PASSWORD_TOO_SHORT' ));?>');
		} else if (((joms.jQuery('#password').val() != "") || (joms.jQuery('#password2').val() != "")) && (joms.jQuery('#password').val() != joms.jQuery('#password2').val())){
			isValid = false;
			joms.jQuery('#jspassword').addClass('invalid');
			joms.jQuery('#jspassword2').addClass('invalid');
			var err_msg = "<?php echo addslashes(JText::_( 'COM_COMMUNITY_PASSWORD_NOT_SAME' )); ?>";
			alert(err_msg);
		}
	}

	if(isValid) {
		//replace the email value.
		joms.jQuery('#email').val(joms.jQuery('#jsemail').val());
		joms.jQuery('#' + formId).submit();
	}
}

// Password strenght indicator
var password_strength_settings = {
	'texts' : {
		1 : '<?php echo addslashes(JText::_('COM_COMMUNITY_PASSWORD_STRENGHT_L1')); ?>',
		2 : '<?php echo addslashes(JText::_('COM_COMMUNITY_PASSWORD_STRENGHT_L2')); ?>',
		3 : '<?php echo addslashes(JText::_('COM_COMMUNITY_PASSWORD_STRENGHT_L3')); ?>',
		4 : '<?php echo addslashes(JText::_('COM_COMMUNITY_PASSWORD_STRENGHT_L4')); ?>',
		5 : '<?php echo addslashes(JText::_('COM_COMMUNITY_PASSWORD_STRENGHT_L5')); ?>'
	}
}

joms.jQuery('#jspassword').password_strength(password_strength_settings);
</script>