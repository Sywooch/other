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
?>
<?php
if( $fields )
{
	$required	= false;
?>


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



<!--
<script type="text/javascript">
function ml(n){




//alert(n);

$('#form_1').show('slow');





// for(var i = 0; i < document.getElementById('field17').length; i++)   {
//        if(document.getElementById('field17').options[i].value == n) {
//       document.getElementById('field17').options[i].selected = true;
//       }
//}






}
</script>-->

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



<form action="<?php echo CRoute::getURI(); ?>" method="post" id="jomsForm" name="jomsForm" class="community-form-validate" style="background-color:transparent;">
<?php
	foreach( $fields as $group )
	{
		$fieldName	= $group->name == 'ungrouped' ? '' : $group->name;
?>
		<div class="ctitle">
			<h2><?php echo JText::_( $fieldName ); ?></h2>
		</div>

		<ul class="cFormList cFormHorizontal cResetList">
<?php
		foreach($group->fields as $field )
		{
			if( !$required && $field->required == 1 )
				$required	= true;

			$html = CProfileLibrary::getFieldHTML($field);
?>
          
     
          

          
				<li <?php
          
          
$pi = explode("_", $field->name);


          if($pi[0]=="Model"){ echo'style="background-color:transparent; "'; };
          
          
?>  >
					<label id="lblfield<?php echo $field->id;?>" for="field<?php echo $field->id;?>" class="form-label"><?php echo JText::_($field->name); ?><?php if($field->required == 1) echo '<span class="required-sign">&nbsp;*</span>'; ?></label>
                  <div class="form-field">
						<?php echo $html; ?>
						<div class="form-privacy">
							<?php echo CPrivacy::getHTML( 'privacy' . $field->id ); ?>
						</div>
					



	
						
					<?php 
					
					if(($field->id)=="17"){
					
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

<?php
	}
?>
<?php
	if( $required )
	{
?>
		<li></li>
		<li class="has-seperator">
			<div class="form-field">
				<span class="form-helper"><?php echo JText::_( 'COM_COMMUNITY_REGISTER_REQUIRED_FILEDS' ); ?></span>
			</div>
		</li>
<?php
	}
?>
		<li>
			<div class="form-field">
				<div id="cwin-wait" style="display:none;"></div>
				<input class="btn btn-primary validateSubmit" type="submit" id="btnSubmit" value="<?php echo JText::_('COM_COMMUNITY_REGISTER'); ?>" name="submit">
			</div>
		</li>
	</ul>
  
  <script type="text/javascript">
    function action_av(){
     
      // alert("123");
      
      
    }   
  </script>
  
  
  
	<input type="hidden" name="profileType" value="<?php echo $profileType;?>" />
	<input type="hidden" name="task" value="registerUpdateProfile" />
	<input type="hidden" id="authenticate" name="authenticate" value="0" />
	<input type="hidden" id="authkey" name="authkey" value="" />
	</form>
	<script type="text/javascript">
		cvalidate.init();
		cvalidate.setSystemText('REM','<?php echo addslashes(JText::_("COM_COMMUNITY_ENTRY_MISSING")); ?>');

		joms.jQuery( '#jomsForm' ).submit( function() {
			joms.jQuery('#btnSubmit').hide();
			joms.jQuery('#cwin-wait').show();

			if(joms.jQuery('#authenticate').val() != '1')
			{
				joms.registrations.authenticateAssign();
				return false;
			}
		});

		joms.jQuery( document ).ready( function(){
			joms.privacy.init();
		});
	</script>
<?php
}
else
{
?>
	<div class="cAlert"><?php echo JText::_('COM_COMMUNITY_NO_CUSTOM_PROFILE_CREATED_YET');?></div>
<?php
}
?>