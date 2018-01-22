<?php
/**
 * @version		2.6.x
 * @package		K2
 * @author		JoomlaWorks http://www.joomlaworks.net
 * @copyright	Copyright (c) 2006 - 2014 JoomlaWorks Ltd. All rights reserved.
 * @license		GNU/GPL license: http://www.gnu.org/copyleft/gpl.html
 */

// no direct access
defined('_JEXEC') or die;

?>


<?php



if( (!isset($_GET['localion'])) || ($_GET['localion']=="") || ($_GET['localion']==NULL) ){
    
    $_GET['localion']="17";
}

if( (!isset($_GET['location_name'])) || ($_GET['location_name']=="") || ($_GET['location_name']==NULL) ){
    
    $_GET['location_name']="blagoveshchensk";
}

?>



<div class="calendar_container tmp323">
	<div class="calendar">
    	<div class="top">
        <div class="top2" id="top2_id">
        	<?php
			$time = date('d');
			
			
$day[0] = "ВС"; 
$day[1] = "ПН"; 
$day[2] = "ВТ"; 
$day[3] = "СР"; 
$day[4] = "ЧТ"; 
$day[5] = "ПТ"; 
$day[6] = "СБ"; 
			
			
			$day_1=date("w");
			
			
			if(($day_1==0)||($day_1==6)){
			$class="red";		
			}
			else{
			$class="";
			};
			
			echo '<div class="date '.$class.' " id="date_0" onclick="date(0, \''.date("Y-m-d H:i:s").'\');" style="width:100px !important; color:black !important; /* background-image: none; border-bottom-width:0px;*/"><span class="date_num">'.$time.'</span>
			<span class="w_num">Сегодня</span>
			</div>';
			for($i=1;$i<90;$i++){
				$time = date('d', time()+(86400*$i));
				$day_1=date("w", time()+(86400*$i));
				
				if(($day_1==0)||($day_1==6)){
				$class="red";		
				}
				else{
				$class="";
				};
				
				
				//echo substr($_GET['day'],0,10)." --- ".substr(date("Y-m-d H:i:s", time()+(86400*$i)),0,10);
				if((isset($_GET['day']))&&(substr($_GET['day'],0,10)==substr(date("Y-m-d H:i:s", time()+(86400*$i)),0,10) ) ){
					
					echo '<div  style="width: 100px; border-bottom-width: 0px; background-image: none;"  class="date f '.$class.'" id="date_'.$i.'" onclick="date('.$i.', \''.date("Y-m-d H:i:s", time()+(86400*$i)).'\');"><span class="date_num">'.$time.'</span>
				<span class="w_num">'.$day[$day_1]."</span>
				</div>";
				
				}else{
				
				echo '<div class="date tmp1 '.$class.'" id="date_'.$i.'" onclick="date('.$i.', \''.date("Y-m-d H:i:s", time()+(86400*$i)).'\');"><span class="date_num">'.$time.'</span>
				<span class="w_num">'.$day[$day_1]."</span>
				</div>";
				
				
				}
				
				
				
				
			}
			
			
			?>
        </div>
        
        
        
        </div>
        
        <div class="bottom">
        <div class="bottom2" style="width: 168px;
  float: left;
  display: inline-block;
  margin-right: 5px;">
        <div class="hd1"></div>
<span class="date datepick" style="position:relative;">  <a>


<?php 
if(isset($_GET['day'])){
echo $_GET['day'];

}else{
?>



Выбрать дату

<?php
}
?>


</a><input type="hidden" class="datepickhidden" value=""></span>
</div>

<span class="date datepick2 tmp1" style="position:relative;"><a><?php
   // echo $_GET['localion']; 
    	$database2 = JFactory::getDbo();
						$database2->setQuery("SELECT * FROM #__k2_categories WHERE id='".$_GET['localion']."'");
						
						 $list2 = $database2->loadObjectList();
                                        
		                                foreach($list2 as $it2){
		                                    
		                                    $name_city=$it2->name;
		                                }
    
    
    echo $name_city; 
    
    
    
    
    ?></a><input type="hidden" class="datepickhidden" value="">
    
    
    <div class="radiochosefull1" style="position:absolute; top: 38px;
  left: 7px; display:none; z-index:99;">
						<ul style="padding:0px; margin:0px; ">
						    
						
						<?php
						$database2 = JFactory::getDbo();
						$database2->setQuery("SELECT * FROM #__k2_categories WHERE parent='25'");
						
						 $list2 = $database2->loadObjectList();
                                        
		                                foreach($list2 as $it2){
		                           
		                           
		                      if(($it2->id)!=$_GET['localion'])   {  
		                           
		                                    
		                    ?>                
		                    <li style="padding:0px; margin:0px; list-style-type: none;"><a href="/<?php  echo $it2->alias; ?>/afisha?localion=<?php  echo $it2->id;   ?>&location_name=<?php echo $it2->alias; ?>" style="padding:0px; margin:0px; width:140px; 
		                    background-image:none !important; border-top:1px #fff solid; text-align:left; padding-left:15px;  margin-top:0px !important;
		                    margin-bottom:0px !important;"><?php echo $it2->name;  ?></a></li>
							                
		                  <?php    
		                      }
		                  
		                  
		                                }
						
						?>
						    
						    
						    
							<!--<li style="padding:0px; margin:0px;"><a href="/" style="padding:0px; margin:0px; width:155px; background-image:none; border-top:1px #fff solid;">Item 1</a></li>
							<li style="padding:0px; margin:0px;"><a href="/" style="padding:0px; margin:0px; width:155px; background-image:none; border-top:1px #fff solid;">Item 2</a></li>
							<li style="padding:0px; margin:0px;"><a href="/" style="padding:0px; margin:0px; width:155px; background-image:none; border-top:1px #fff solid;">Item 3</a></li>
							<li style="padding:0px; margin:0px;"><a href="/" style="padding:0px; margin:0px; width:155px; background-image:none; border-top:1px #fff solid;">Item 4</a></li>
							<li  style="padding:0px; margin:0px;"><a href="/" style="padding:0px; margin:0px; width:155px; background-image:none; border-top:1px #fff solid;">Item 5</a></li>
						-->
						
						
					</ul>
					</div>
    
    
    </span>
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    	<span class="date datepick3" style="  position:absolute; z-index:99; left:336px;    display: none;  width: 192px; top:0px;">
		    <a style="background-image: url(http://hinewsgc.bget.ru/templates/infinitilife/images/spoil3.png);">КАТЕГОРИИ</a><input type="hidden" class="datepickhidden" value="">
    
    
    <div class="radiochosefull3" style="position: absolute; top: 40px; left: 19px; display: none;">
						<ul style="padding:0px; margin:0px; ">
		
		<?php
		
		
		$database4 = JFactory::getDbo();
		$database4->setQuery("SELECT * FROM #__k2_categories WHERE parent=17");
		$list4 = $database4->loadObjectList();
 
		foreach($list4 as $it4) { 
		
		//echo $it->name;echo"<br>";
		//echo $it->id;
			if(($it4->name)=="Афиши"){
		
				$afishi_id=$it4->id;
			
			}
		
		}
		
		
		$database2 = JFactory::getDbo();
		$database2->setQuery("SELECT * FROM #__k2_categories WHERE parent=".$afishi_id."");
		$list2 = $database2->loadObjectList();
 
		foreach($list2 as $it) { 
		
		if( (isset($_GET['subcategory'])) && ($_GET['subcategory']==($it->id)) ){
		    
		if(($it->name)=="ВСЕ"){
		echo' <li style="padding:0px; margin:0px; padding-right:15px; list-style-type:none;"><a href="/afisha.html?localion='.$_GET['localion'].'&location_name='.$_GET['location_name'].'"
		style="padding: 0px 0px 0px 15px; margin: 0px; width: 160px; border-top-width: 1px; border-top-color: rgb(255, 255, 255);
		                     border-top-style: solid; text-align: left; background-image: none !important; margin-top:0px !important; margin-bottom:0px !important;">'.$it->name.'</a></li>';
		    
		}else{   
		echo'<li style="padding:0px; margin:0px; padding-right:15px;  list-style-type:none;">
		<a href="/afisha.html?subcategory='.$it->id.'&localion='.$_GET['localion'].'&location_name='.$_GET['location_name'].'" 
		style="padding: 0px 0px 0px 15px; margin: 0px; width: 160px; border-top-width: 1px; border-top-color: rgb(255, 255, 255);
		                     border-top-style: solid; text-align: left; background-image: none !important; margin-top:0px !important; margin-bottom:0px !important;">'.$it->name.'</a></li>';
		}
		
		
		
		}else{
		
		if(($it->name)=="ВСЕ"){
		echo'<li style="padding:0px; margin:0px; padding-right:15px; list-style-type:none;">
		<a href="/afisha.html?localion='.$_GET['localion'].'&location_name='.$_GET['location_name'].'" 
		style="padding: 0px 0px 0px 15px; margin: 0px; width: 160px; border-top-width: 1px; border-top-color: rgb(255, 255, 255);
		                     border-top-style: solid; text-align: left; background-image: none !important; margin-top:0px !important; margin-bottom:0px !important;">'.$it->name.'</a></li>';
		    
		}else{
		 
		echo'<li style="padding:0px; margin:0px; padding-right:15px; list-style-type:none;">
		<a href="/afisha.html?subcategory='.$it->id.'&localion='.$_GET['localion'].'&location_name='.$_GET['location_name'].'"
		style="padding: 0px 0px 0px 15px; margin: 0px; width: 160px; border-top-width: 1px; border-top-color: rgb(255, 255, 255);
		                     border-top-style: solid; text-align: left; background-image: none !important; margin-top:0px !important; margin-bottom:0px !important;">'.$it->name.'</a></li>';
		}
		
		
		}
		
		
		}
		
		
		
		
		
		?>
		
		
		
		
		              
		                   
						    
							<!--<li style="padding:0px; margin:0px;"><a href="/" style="padding:0px; margin:0px; width:155px; background-image:none; border-top:1px #fff solid;">Item 1</a></li>
							<li style="padding:0px; margin:0px;"><a href="/" style="padding:0px; margin:0px; width:155px; background-image:none; border-top:1px #fff solid;">Item 2</a></li>
							<li style="padding:0px; margin:0px;"><a href="/" style="padding:0px; margin:0px; width:155px; background-image:none; border-top:1px #fff solid;">Item 3</a></li>
							<li style="padding:0px; margin:0px;"><a href="/" style="padding:0px; margin:0px; width:155px; background-image:none; border-top:1px #fff solid;">Item 4</a></li>
							<li  style="padding:0px; margin:0px;"><a href="/" style="padding:0px; margin:0px; width:155px; background-image:none; border-top:1px #fff solid;">Item 5</a></li>
						-->
						
						
						</ul>
					</div>
    
    
    </span>
		
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    


     <script type="text/javascript">
   var $j2 = jQuery.noConflict();
   $j2('.date.datepick2 a').click(function(){
       
       var display1=$j2(".date.datepick2 .radiochosefull1").css("display");
       //alert(display1);
       if(display1=="none"){
       
        $j2('.date.datepick2 .radiochosefull1').css({'display' : 'block'});
        $j2('.date.datepick2 a').css({'background-image' : 'url(/templates/infinitilife/images/spoil3_2.png)'});
       
       }else{
           
           $j2('.date.datepick2 .radiochosefull1').css({'display' : 'none'});
           $j2('.date.datepick2 a').css({'background-image' : 'url(/templates/infinitilife/images/spoil3.png)'});
       }
       
       
       
   }); 
   
   
   
  
</script>

   
        
        
        
        
        
        <?php
		//вывод подкатегорий
		
		
		
		if($_GET['localion']=="17"){////////////////////////
		
		
		
		
		
		
		
		
		$database4 = JFactory::getDbo();
		$database4->setQuery("SELECT * FROM #__k2_categories WHERE parent=17");
		$list4 = $database4->loadObjectList();
 
		foreach($list4 as $it4) { 
		
		//echo $it->name;echo"<br>";
		//echo $it->id;
			if(($it4->name)=="Афиши"){
		
				$afishi_id=$it4->id;
			
			}
		
		}
		
		
		$database2 = JFactory::getDbo();
		$database2->setQuery("SELECT * FROM #__k2_categories WHERE parent=".$afishi_id."");
		$list2 = $database2->loadObjectList();
 
		foreach($list2 as $it) { 
		
		if( (isset($_GET['subcategory'])) && ($_GET['subcategory']==($it->id)) ){
		    
		if(($it->name)=="ВСЕ"){
		echo'<span class="cat_name tmp11"><a href="/afishi?localion='.$_GET['localion'].'&location_name='.$_GET['location_name'].'">'.$it->name.'</a></span>';
		    
		}else{   
		echo'<span class="cat_name tmp12" style="text-decoration:underline;"><a href="/afishi/'.$it->alias.'?subcategory='.$it->id.'&localion='.$_GET['localion'].'&location_name='.$_GET['location_name'].'">'.$it->name.'</a></span>';
		}
		
		
		
		}else{
		
		if(($it->name)=="ВСЕ"){
		echo'<span class="cat_name tmp13"><a href="/afishi?localion='.$_GET['localion'].'&location_name='.$_GET['location_name'].'">'.$it->name.'</a></span>';
		    
		}else{
		 
		echo'<span class="cat_name tmp144"><a href="/afishi/'.$it->alias.'?subcategory='.$it->id.'&localion='.$_GET['localion'].'&location_name='.$_GET['location_name'].'">'.$it->name.'</a></span>';
		}
		
		
		}
		
		
		}
		
		
		
		
		
		
		
		?> 
		
		
		
<script type="text/javascript">
<?php
$uri = &JFactory::getURI();
$url = $uri->toString(array('path', 'query', 'fragment'));
$url_mas=explode("?",$url);


?>

window.history.replaceState("","","<?php  echo $url_mas[0]; ?>")

</script>
		
		
		
		
		
		
		
		
			<span class="date datepick3" style="  position:absolute; z-index:99; left:336px;    display: none;  width: 192px; top:0px;">
		    <a style="background-image: url(http://hinewsgc.bget.ru/templates/infinitilife/images/spoil3.png);">КАТЕГОРИИ</a><input type="hidden" class="datepickhidden" value="">
    
    
    <div class="radiochosefull3" style="position: absolute; top: 40px; left: 19px; display: none;">
						<ul style="padding:0px; margin:0px; ">
		
		<?php
		
		
		$database4 = JFactory::getDbo();
		$database4->setQuery("SELECT * FROM #__k2_categories WHERE parent=17");
		$list4 = $database4->loadObjectList();
 
		foreach($list4 as $it4) { 
		
		//echo $it->name;echo"<br>";
		//echo $it->id;
			if(($it4->name)=="Афиши"){
		
				$afishi_id=$it4->id;
			
			}
		
		}
		
		
		$database2 = JFactory::getDbo();
		$database2->setQuery("SELECT * FROM #__k2_categories WHERE parent=".$afishi_id."");
		$list2 = $database2->loadObjectList();
 
		foreach($list2 as $it) { 
		
		if( (isset($_GET['subcategory'])) && ($_GET['subcategory']==($it->id)) ){
		    
		if(($it->name)=="ВСЕ"){
		echo' <li style="padding:0px; margin:0px; padding-right:15px; list-style-type:none;"><a href="/afisha.html?localion='.$_GET['localion'].'&location_name='.$_GET['location_name'].'"
		style="padding: 0px 0px 0px 15px; margin: 0px; width: 160px; border-top-width: 1px; border-top-color: rgb(255, 255, 255);
		                     border-top-style: solid; text-align: left; background-image: none !important; margin-top:0px !important; margin-bottom:0px !important;">'.$it->name.'</a></li>';
		    
		}else{   
		echo'<li style="padding:0px; margin:0px; padding-right:15px;  list-style-type:none;">
		<a href="/afisha.html?subcategory='.$it->id.'&localion='.$_GET['localion'].'&location_name='.$_GET['location_name'].'" 
		style="padding: 0px 0px 0px 15px; margin: 0px; width: 160px; border-top-width: 1px; border-top-color: rgb(255, 255, 255);
		                     border-top-style: solid; text-align: left; background-image: none !important; margin-top:0px !important; margin-bottom:0px !important;">'.$it->name.'</a></li>';
		}
		
		
		
		}else{
		
		if(($it->name)=="ВСЕ"){
		echo'<li style="padding:0px; margin:0px; padding-right:15px; list-style-type:none;">
		<a href="/afisha.html?localion='.$_GET['localion'].'&location_name='.$_GET['location_name'].'" 
		style="padding: 0px 0px 0px 15px; margin: 0px; width: 160px; border-top-width: 1px; border-top-color: rgb(255, 255, 255);
		                     border-top-style: solid; text-align: left; background-image: none !important; margin-top:0px !important; margin-bottom:0px !important;">'.$it->name.'</a></li>';
		    
		}else{
		 
		echo'<li style="padding:0px; margin:0px; padding-right:15px; list-style-type:none;">
		<a href="/afisha.html?subcategory='.$it->id.'&localion='.$_GET['localion'].'&location_name='.$_GET['location_name'].'"
		style="padding: 0px 0px 0px 15px; margin: 0px; width: 160px; border-top-width: 1px; border-top-color: rgb(255, 255, 255);
		                     border-top-style: solid; text-align: left; background-image: none !important; margin-top:0px !important; margin-bottom:0px !important;">'.$it->name.'</a></li>';
		}
		
		
		}
		
		
		}
		
		
		
		
		
		?>
		
		
		
		
		              
		                   
						    
							<!--<li style="padding:0px; margin:0px;"><a href="/" style="padding:0px; margin:0px; width:155px; background-image:none; border-top:1px #fff solid;">Item 1</a></li>
							<li style="padding:0px; margin:0px;"><a href="/" style="padding:0px; margin:0px; width:155px; background-image:none; border-top:1px #fff solid;">Item 2</a></li>
							<li style="padding:0px; margin:0px;"><a href="/" style="padding:0px; margin:0px; width:155px; background-image:none; border-top:1px #fff solid;">Item 3</a></li>
							<li style="padding:0px; margin:0px;"><a href="/" style="padding:0px; margin:0px; width:155px; background-image:none; border-top:1px #fff solid;">Item 4</a></li>
							<li  style="padding:0px; margin:0px;"><a href="/" style="padding:0px; margin:0px; width:155px; background-image:none; border-top:1px #fff solid;">Item 5</a></li>
						-->
						
						
						</ul>
					</div>
    
    
    </span>
		
		
		
		
		
	
						    
						  
		   
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
     <script type="text/javascript">
   var $j2 = jQuery.noConflict();		
		
 $j2('.date.datepick3 a').click(function(){
       
       var display1=$j2(".date.datepick3 .radiochosefull3").css("display");
    
       if(display1=="none"){
       
        $j2('.date.datepick3 .radiochosefull3').css({'display' : 'block'});
        $j2('.date.datepick3 a').css({'background-image' : 'url(/templates/infinitilife/images/spoil3_2.png)'});
       
       }else{
           
           $j2('.date.datepick3 .radiochosefull3').css({'display' : 'none'});
           $j2('.date.datepick3 a').css({'background-image' : 'url(/templates/infinitilife/images/spoil3.png)'});
       }
       
       
       
   });		
		
</script>		
		
		
		
		
		
		<?php
		
		
		
		
		}else{//////////////////////////////////////
		
		
		/*
		$database4 = JFactory::getDbo();
		$database4->setQuery("SELECT * FROM #__k2_categories WHERE parent='".$_GET['localion']."'");
		$list4 = $database4->loadObjectList();
 
		foreach($list4 as $it4) { 
		
		//echo $it->name;echo"<br>";
		//echo $it->id;
			if(($it4->name)=="Афиша"){
		
				$afishi_id=$it4->id;
			echo $afishi_id;
			}
		
		}
		
		
		
		
		
		$database2 = JFactory::getDbo();
		$database2->setQuery("SELECT * FROM #__k2_categories WHERE parent=5");
		$list2 = $database2->loadObjectList();
 
		foreach($list2 as $it) { 
		
		if( (isset($_GET['subcategory'])) && ($_GET['subcategory']==($it->id)) ){
		    
		if(($it->name)=="ВСЕ"){
		echo'<span class="cat_name tmp11"><a href="/afisha.html?localion='.$_GET['localion'].'&location_name='.$_GET['location_name'].'">'.$it->name.'</a></span>';
		    
		}else{   
		echo'<span class="cat_name tmp12" style="text-decoration:underline;"><a href="/afisha.html?subcategory='.$it->id.'&localion='.$_GET['localion'].'&location_name='.$_GET['location_name'].'">'.$it->name.'</a></span>';
		}
		
		
		
		}else{
		
		if(($it->name)=="ВСЕ"){
		echo'<span class="cat_name tmp13"><a href="/afisha.html?localion='.$_GET['localion'].'&location_name='.$_GET['location_name'].'">'.$it->name.'</a></span>';
		    
		}else{
		 
		echo'<span class="cat_name tmp14"><a href="/afisha.html?subcategory='.$it->id.'&localion='.$_GET['localion'].'&location_name='.$_GET['location_name'].'">'.$it->name.'</a></span>';
		}
		
		
		}
		
		
		}
		
		*/
		
		echo'<span class="cat_name tmp14"><a href="/afisha.html?localion='.$_GET['localion'].'&location_name='.$_GET['location_name'].'">ВСЕ</a></span>';
		
		
		}///////////////////////////////////////
		
		
		
		
		?>
        
        
        </div>
        
        
        
        
    </div>
    
            <div class="button_right" onclick="c_right();"></div>
    		<div class="button_left" onclick="c_left();"></div>
</div>

<div class="poster_items tmp111">
<?php

if(isset($_GET['localion'])&&($_GET['localion']!="17")){
 //echo $_GET['localion'];
//получение id категории, которая является родительской по отношению к текущей.
$database = JFactory::getDbo();
   $database->setQuery("SELECT * FROM #__k2_categories WHERE parent=".$_GET['localion']." AND name='Афиша'"); 
  $list = $database->loadObjectList();
  foreach($list as $it) { 

$af_id=$it->id;

   
  }
  
//echo $af_id; 


    
    
$database = JFactory::getDbo();
 $database->setQuery("SELECT * FROM #__k2_items WHERE catid=".$af_id." AND published=1 AND trash=0 ORDER BY publish_down,publish_up");
    
    

$list = $database->loadObjectList();
 
foreach($list as $it) { 
   
   
   $hash = md5('Image'.$it->id);
	//echo $hash;
?>


<?php

//echo $it->publish_up;
//echo"<br>";
//echo $it->publish_down;
//echo"<br>";


if( (isset($_GET['day'])) ){
    
$today=$_GET['day'];
//echo $today;
}
else{
$today=date("Y-m-d H:i:s");
}//echo $today;

$result=(($it->publish_up)<$today);
$result2=($today<($it->publish_down));

//echo $result;
//echo $result2;

for($i_1=0;$i_1<30;$i_1++){
//$tmp_date=("Y-m-d H:i:s", time()+(86400*$i_1));
$day_7=date("Y-m-d H:i:s", time()+(86400*$i_1));


$result=(($it->publish_up)<$day_7);
$result2=($day_7<($it->publish_down));

if(($result==true)&&($result2==true)){ break; };
}






if(($result==true)&&($result2==true)){
	

$catid=$it->catid;

 $database3 = JFactory::getDbo();
     $database3->setQuery("SELECT * FROM #__k2_categories WHERE id='".$catid."'  ");
     
    $list3 = $database3->loadObjectList();
    
    foreach($list3 as $it3) {
        $cat_alias=$it3->alias;
    }
    
    
    
$alias1=str_replace("vse/","",$it->alias);
$cat_alias=str_replace("vse","",$cat_alias);
$link1=str_replace("//","/","/afishi/".$cat_alias."/".$alias1);
$link1=str_replace("afishi","",$link1);
$link1=str_replace("//","/",$link1);

//echo $link1;
//echo $_GET['location_name'];

$link1=$_GET['location_name'].$link1

?>


<div class="poster_img tmp371" >
<div class="poster_img2" style="background-image:url(/media/k2/items/src/<?php echo $hash;?>.jpg);">
<a href="<?php echo $link1; ?>" style="width:100%; height:100%; display:block;"></a>
</div>
</div>



<script type="text/javascript">
var $j2 = jQuery.noConflict();
    var temp_width=$j2(".poster_img").css("width");
    //alert(temp_width);
    //var temp_height=temp_width*2;
    
     $j2(".poster_img").css({"height" : "calc("+temp_width+" * 1)"});
    
    
</script>




<?php
}
?>



<?php	
	
	
}

?>

    
<?php    
    
    

}//if(isset($_GET['localion'])&&($_GET['localion']!="17")){
else{
?>




<?php
$database = JFactory::getDbo();

if( (isset($_GET['subcategory'])) ){
		    
    $database->setQuery("SELECT * FROM #__k2_items WHERE catid=".($this->category->id)." AND published=1 AND trash=0 ORDER BY publish_down,publish_up");
	
}else{
		//echo $this->category->id;
    $database->setQuery("SELECT * FROM #__k2_items WHERE catid=".($this->category->id)." AND published=1 AND trash=0 ORDER BY publish_down,publish_up");
		
}

$list = $database->loadObjectList();
 
foreach($list as $it) { 
   
   
   $hash = md5('Image'.$it->id);
	//echo $hash;
?>


<?php

//echo $it->publish_up;
//echo"<br>";
//echo $it->publish_down;
//echo"<br>";


if( (isset($_GET['day'])) ){
    
$today=$_GET['day'];
//echo $today;
}
else{
$today=date("Y-m-d H:i:s");
}//echo $today;

$result=(($it->publish_up)<$today);
$result2=($today<($it->publish_down));

for($i_1=0;$i_1<30;$i_1++){
//$tmp_date=("Y-m-d H:i:s", time()+(86400*$i_1));
$day_7=date("Y-m-d H:i:s", time()+(86400*$i_1));


$result=(($it->publish_up)<$day_7);
$result2=($day_7<($it->publish_down));

if(($result==true)&&($result2==true)){ break; };
}






if(($result==true)&&($result2==true)){
	

$catid=$it->catid;

 $database3 = JFactory::getDbo();
     $database3->setQuery("SELECT * FROM #__k2_categories WHERE id='".$catid."'  ");
     
    $list3 = $database3->loadObjectList();
    
    foreach($list3 as $it3) {
        $cat_alias=$it3->alias;
    }
$alias1=str_replace("vse/","",$it->alias);
$cat_alias=str_replace("vse","",$cat_alias);
$link1=str_replace("//","/","/afishi/".$cat_alias."/".$alias1);




?>

<div class="poster_img tmp372" >
<div class="poster_img2" style="background-image:url(/media/k2/items/src/<?php echo $hash;?>.jpg);">
<a href="<?php echo $link1; ?>" style="width:100%; height:100%; display:block;"></a>
</div>
</div>



<script type="text/javascript">
var $j2 = jQuery.noConflict();
    var temp_width=$j2(".poster_img").css("width");
    //alert(temp_width);
    //var temp_height=temp_width*2;
    
     $j2(".poster_img").css({"height" : "calc("+temp_width+" * 1)"});
    
    
</script>




<?php
}
?>



<?php	
	
	
}

?>

</div>


<div class="main_afisha_banners">
    
    
    <?php
    $database =& JFactory::getDBO();

		
		$database->setQuery("SELECT * FROM #__banners WHERE catid='21' AND state='1'");
		$list = $database->loadObjectList();
 
		foreach($list as $it) {
		    
		    $url=$it->params;
		    $m=explode('":"',$url);
		    $url=$m[1];
		    $m=explode('","',$url);
		    $url=$m[0];
		    $url=str_replace("\\","",$url);
		    
		    $width=$it->params;
		    $m=explode(',"',$width);
		    $width=$m[1];
		    $m=explode('":',$width);
		    $width=$m[1];
		    
		    $height=$it->params;
		    $m=explode(',"',$height);
		    $height=$m[2];
		    
		    $m=explode('":',$height);
		    $height=$m[1];
		   
		    
 ?>

  <?php
  if($it->clickurl==""){
	  
	  ?>
	<img src="<?php echo $url; ?>" width="<?php echo $width; ?>" height="<?php echo $height; ?>" alt="" title=""/>  
    <?php
  }else{
	?>  
   <a href="<?php echo $it->clickurl; ?>"><img src="<?php echo $url; ?>" width="<?php echo $width; ?>" height="<?php echo $height; ?>" alt="" title=""/></a>    
  
  <?php
  
  }
  
  ?>
 
 <?php
 	  	 
        
		}
        ?>
        
        


    
    
    
    
    
    
    
    
    
    
    
    
    
    

<?php
    $database =& JFactory::getDBO();

		
		$database->setQuery("SELECT * FROM #__banners WHERE catid='17'");
		$list = $database->loadObjectList();
 
		foreach($list as $it) {
		    
		    $url=$it->params;
		    $m=explode('":"',$url);
		    $url=$m[1];
		    $m=explode('","',$url);
		    $url=$m[0];
		    $url=str_replace("\\","",$url);
		    
		    $width=$it->params;
		    $m=explode(',"',$width);
		    $width=$m[1];
		    $m=explode('":',$width);
		    $width=$m[1];
		    
		    $height=$it->params;
		    $m=explode(',"',$height);
		    $height=$m[2];
		    
		    $m=explode('":',$height);
		    $height=$m[1];
		   
		    
 ?>

  <?php
  if($it->clickurl==""){
	  
	  ?>
	<img src="<?php echo $url; ?>" width="<?php echo $width; ?>" height="<?php echo $height; ?>" alt="" title=""/>  
    <?php
  }else{
	?>  
   <a href="<?php echo $it->clickurl; ?>"><img src="<?php echo $url; ?>" width="<?php echo $width; ?>" height="<?php echo $height; ?>" alt="" title=""/></a>    
  
  <?php
  
  }
  
  ?>
 
 <?php
 	  	 
        
		}
		
		
}
        ?>
        
        




</div>






<script type="text/javascript">
 var temp_width=$j(".poster_img").css("width");

function c_right(){
	var $j = jQuery.noConflict();
	//var len=$j('.calendar_container .top2').css('height');
	
	element = document.getElementById('top2_id');
	len = window.getComputedStyle(element).marginLeft;
	len=len.replace("px","");
	
	len=len-47;
	$j('.calendar_container .top2').css({'margin-left' : ''+len+'px'});

}

function c_left(){
	var $j = jQuery.noConflict();
		
	element = document.getElementById('top2_id');
	len = window.getComputedStyle(element).marginLeft;
	
	len=len.replace("px","");
	
	if(len!='0'){
	    len=eval(len)+eval(47);
	    //alert(len);
	    $j('.calendar_container .top2').css({'margin-left' : ''+len+'px'});
    }
	
}


function date(d, date){
    var $j = jQuery.noConflict();
     var class_f=$j('.calendar_container .top2 #date_'+d+'').hasClass("f");
	//
		
		
		//alert(class_f);
		
		if(class_f==true){
		
		$j('.calendar_container .top2 .date').css({'width' : '48px'});
		$j('.calendar_container .top2 .date').css({'background-image' : 'url(/templates/infinitilife/images/date_item_fon.png)'});
		$j('.calendar_container .top2 .date').css({'border-bottom-width' : '1px'});
		$j('.calendar_container .top2 .date').removeClass('f');
		
		
		
   $j.ajax({  
                    type: "POST",  
                    url: "/action/poster_date_r_mouth.php?razdel=<?php echo $this->category->id;  ?>",  
                    data: "date="+(date),
	  	 		
                    success: function(html){  
				//	alert(html);
					    $j(".poster_items").html(html);
					    $j(".poster_img").css({"height" : "calc("+temp_width+" * 1)"});	
                    }  
         });



		
		
	}else{
  
    
	

	$j('.calendar_container .top2 .date').css({'width' : '48px'});
	$j('.calendar_container .top2 #date_'+d+'').css({'width' : '100px'});

	$j('.calendar_container .top2 .date').css({'background-image' : 'url(/templates/infinitilife/images/date_item_fon.png)'});
	$j('.calendar_container .top2 #date_'+d+'').css({'background-image' : 'none'});

	$j('.calendar_container .top2 .date').css({'border-bottom-width' : '1px'});
	$j('.calendar_container .top2 #date_'+d+'').css({'border-bottom-width' : '0px'});

$j('.calendar_container .top2 .date').removeClass('f');
$j('.calendar_container .top2 #date_'+d+'').addClass('f');





   $j.ajax({  
                    type: "POST",  
                    url: "/action/poster_date_r.php?razdel=<?php echo $this->category->id;  ?>",  
                    data: "date="+(date),
	  	 		
                    success: function(html){  
				//	alert(html);
					    $j(".poster_items").html(html);
					    $j(".poster_img").css({"height" : "calc("+temp_width+" * 1)"});	
                    }  
         });



  
	}
    


}



</script>

<script type="text/javascript">
var $j2 = jQuery.noConflict();
$j2(window).scroll(function(){
var st = $j2(this).scrollTop();

if(st>306){
    $j2('.calendar_container').css({'position' : 'fixed'});
    $j2('.calendar_container').css({'top' : '75px'});
    $j2('.calendar_container').css({'z-index' : '9'});
}else{
    $j2('.calendar_container').css({'position' : 'absolute'});
    $j2('.calendar_container').css({'top' : '375px'});
    $j2('.calendar_container').css({'z-index' : '9'});
    
}




});
</script>



<?php  



?>


<!-- Start K2 Category Layout -->

<!--

<div id="k2Container" class="tmp2 itemListView<?php if($this->params->get('pageclass_sfx')) echo ' '.$this->params->get('pageclass_sfx'); ?>" style="display:none;" >

	<?php if($this->params->get('show_page_title')): ?>
	<!-- Page title -->
<!--	<div class="componentheading<?php echo $this->params->get('pageclass_sfx')?>">
		<?php echo $this->escape($this->params->get('page_title')); ?>
	</div>
	<?php endif; ?>

	<?php if($this->params->get('catFeedIcon')): ?>
	<!-- RSS feed icon -->
<!--	<div class="k2FeedIcon">
		<a href="<?php echo $this->feed; ?>" title="<?php echo JText::_('K2_SUBSCRIBE_TO_THIS_RSS_FEED'); ?>">
			<span><?php echo JText::_('K2_SUBSCRIBE_TO_THIS_RSS_FEED'); ?></span>
		</a>
		<div class="clr"></div>
	</div>
	<?php endif; ?>

	<?php if(isset($this->category) || ( $this->params->get('subCategories') && isset($this->subCategories) && count($this->subCategories) )): ?>
	<!-- Blocks for current category and subcategories -->
<!--	<div class="itemListCategoriesBlock">

		<?php if(isset($this->category) && ( $this->params->get('catImage') || $this->params->get('catTitle') || $this->params->get('catDescription') || $this->category->event->K2CategoryDisplay )): ?>
		<!-- Category block -->
<!--		<div class="itemListCategory">

			<?php if(isset($this->addLink)): ?>
			<!-- Item add link -->
<!--			<span class="catItemAddLink">
				<a class="modal" rel="{handler:'iframe',size:{x:990,y:650}}" href="<?php echo $this->addLink; ?>">
					<?php echo JText::_('K2_ADD_A_NEW_ITEM_IN_THIS_CATEGORY'); ?>
				</a>
			</span>
			<?php endif; ?>

			<?php if($this->params->get('catImage') && $this->category->image): ?>
			<!-- Category image -->
<!--			<img alt="<?php echo K2HelperUtilities::cleanHtml($this->category->name); ?>" src="<?php echo $this->category->image; ?>" style="width:<?php echo $this->params->get('catImageWidth'); ?>px; height:auto;" />
			<?php endif; ?>

			<?php if($this->params->get('catTitle')): ?>
			<!-- Category title -->
<!--			<h2><?php echo $this->category->name; ?><?php if($this->params->get('catTitleItemCounter')) echo ' ('.$this->pagination->total.')'; ?></h2>
			<?php endif; ?>

			<?php if($this->params->get('catDescription')): ?>
			<!-- Category description -->
<!--			<p><?php echo $this->category->description; ?></p>
			<?php endif; ?>

			<!-- K2 Plugins: K2CategoryDisplay -->
<!--			<?php echo $this->category->event->K2CategoryDisplay; ?>

			<div class="clr"></div>
		</div>
		<?php endif; ?>

		<?php if($this->params->get('subCategories') && isset($this->subCategories) && count($this->subCategories)): ?>
		<!-- Subcategories -->
<!--		<div class="itemListSubCategories">
			<h3><?php echo JText::_('K2_CHILDREN_CATEGORIES'); ?></h3>

			<?php foreach($this->subCategories as $key=>$subCategory): ?>

			<?php
			// Define a CSS class for the last container on each row
			if( (($key+1)%($this->params->get('subCatColumns'))==0))
				$lastContainer= ' subCategoryContainerLast';
			else
				$lastContainer='';
			?>

			<div class="subCategoryContainer<?php echo $lastContainer; ?>"<?php echo (count($this->subCategories)==1) ? '' : ' style="width:'.number_format(100/$this->params->get('subCatColumns'), 1).'%;"'; ?>>
				<div class="subCategory">
					<?php if($this->params->get('subCatImage') && $subCategory->image): ?>
					<!-- Subcategory image -->
<!--					<a class="subCategoryImage" href="<?php echo $subCategory->link; ?>">
						<img alt="<?php echo K2HelperUtilities::cleanHtml($subCategory->name); ?>" src="<?php echo $subCategory->image; ?>" />
					</a>
					<?php endif; ?>

					<?php if($this->params->get('subCatTitle')): ?>
					<!-- Subcategory title -->
<!--					<h2>
						<a href="<?php echo $subCategory->link; ?>">
							<?php echo $subCategory->name; ?><?php if($this->params->get('subCatTitleItemCounter')) echo ' ('.$subCategory->numOfItems.')'; ?>
						</a>
					</h2>
					<?php endif; ?>

					<?php if($this->params->get('subCatDescription')): ?>
					<!-- Subcategory description -->
<!--					<p><?php echo $subCategory->description; ?></p>
					<?php endif; ?>

					<!-- Subcategory more... -->
<!--					<a class="subCategoryMore" href="<?php echo $subCategory->link; ?>">
						<?php echo JText::_('K2_VIEW_ITEMS'); ?>
					</a>

					<div class="clr"></div>
				</div>
			</div>
			<?php if(($key+1)%($this->params->get('subCatColumns'))==0): ?>
			<div class="clr"></div>
			<?php endif; ?>
			<?php endforeach; ?>

			<div class="clr"></div>
		</div>
		<?php endif; ?>

	</div>
	<?php endif; ?>



	<?php if((isset($this->leading) || isset($this->primary) || isset($this->secondary) || isset($this->links)) && (count($this->leading) || count($this->primary) || count($this->secondary) || count($this->links))): ?>
	<!-- Item list -->
<!--	<div class="itemList">

		<?php if(isset($this->leading) && count($this->leading)): ?>
		<!-- Leading items -->
<!--		<div id="itemListLeading">
			<?php foreach($this->leading as $key=>$item): ?>

			<?php
			// Define a CSS class for the last container on each row
			if( (($key+1)%($this->params->get('num_leading_columns'))==0) || count($this->leading)<$this->params->get('num_leading_columns') )
				$lastContainer= ' itemContainerLast';
			else
				$lastContainer='';
			?>
			
			<div class="itemContainer<?php echo $lastContainer; ?>"<?php echo (count($this->leading)==1) ? '' : ' style="width:'.number_format(100/$this->params->get('num_leading_columns'), 1).'%;"'; ?>>
				<?php
					// Load category_item.php by default
					$this->item=$item;
					echo $this->loadTemplate('item');
				?>
			</div>
			<?php if(($key+1)%($this->params->get('num_leading_columns'))==0): ?>
			<div class="clr"></div>
			<?php endif; ?>
			<?php endforeach; ?>
			<div class="clr"></div>
		</div>
		<?php endif; ?>

		<?php if(isset($this->primary) && count($this->primary)): ?>
		<!-- Primary items -->
<!--		<div id="itemListPrimary">
			<?php foreach($this->primary as $key=>$item): ?>
			
			<?php
			// Define a CSS class for the last container on each row
			if( (($key+1)%($this->params->get('num_primary_columns'))==0) || count($this->primary)<$this->params->get('num_primary_columns') )
				$lastContainer= ' itemContainerLast';
			else
				$lastContainer='';
			?>
			
			<div class="itemContainer<?php echo $lastContainer; ?>"<?php echo (count($this->primary)==1) ? '' : ' style="width:'.number_format(100/$this->params->get('num_primary_columns'), 1).'%;"'; ?>>
				<?php
					// Load category_item.php by default
					$this->item=$item;
					echo $this->loadTemplate('item');
				?>
			</div>
			<?php if(($key+1)%($this->params->get('num_primary_columns'))==0): ?>
			<div class="clr"></div>
			<?php endif; ?>
			<?php endforeach; ?>
			<div class="clr"></div>
		</div>
		<?php endif; ?>

		<?php if(isset($this->secondary) && count($this->secondary)): ?>
		<!-- Secondary items -->
<!--		<div id="itemListSecondary">
			<?php foreach($this->secondary as $key=>$item): ?>
			
			<?php
			// Define a CSS class for the last container on each row
			if( (($key+1)%($this->params->get('num_secondary_columns'))==0) || count($this->secondary)<$this->params->get('num_secondary_columns') )
				$lastContainer= ' itemContainerLast';
			else
				$lastContainer='';
			?>
			
			<div class="itemContainer<?php echo $lastContainer; ?>"<?php echo (count($this->secondary)==1) ? '' : ' style="width:'.number_format(100/$this->params->get('num_secondary_columns'), 1).'%;"'; ?>>
				<?php
					// Load category_item.php by default
					$this->item=$item;
					echo $this->loadTemplate('item');
				?>
			</div>
			<?php if(($key+1)%($this->params->get('num_secondary_columns'))==0): ?>
			<div class="clr"></div>
			<?php endif; ?>
			<?php endforeach; ?>
			<div class="clr"></div>
		</div>
		<?php endif; ?>

		<?php if(isset($this->links) && count($this->links)): ?>
		<!-- Link items -->
<!--		<div id="itemListLinks">
			<h4><?php echo JText::_('K2_MORE'); ?></h4>
			<?php foreach($this->links as $key=>$item): ?>

			<?php
			// Define a CSS class for the last container on each row
			if( (($key+1)%($this->params->get('num_links_columns'))==0) || count($this->links)<$this->params->get('num_links_columns') )
				$lastContainer= ' itemContainerLast';
			else
				$lastContainer='';
			?>

			<div class="itemContainer<?php echo $lastContainer; ?>"<?php echo (count($this->links)==1) ? '' : ' style="width:'.number_format(100/$this->params->get('num_links_columns'), 1).'%;"'; ?>>
				<?php
					// Load category_item_links.php by default
					$this->item=$item;
					echo $this->loadTemplate('item_links');
				?>
			</div>
			<?php if(($key+1)%($this->params->get('num_links_columns'))==0): ?>
			<div class="clr"></div>
			<?php endif; ?>
			<?php endforeach; ?>
			<div class="clr"></div>
		</div>
		<?php endif; ?> 
 
	</div>

	<!-- Pagination -->
	<?php if($this->pagination->getPagesLinks()): ?>
<!--	<div class="k2Pagination">
		<?php if($this->params->get('catPagination')) echo $this->pagination->getPagesLinks(); ?>
		<div class="clr"></div>
		<?php if($this->params->get('catPaginationResults')) echo $this->pagination->getPagesCounter(); ?>
	</div>
	<?php endif; ?>

	<?php endif; ?>
</div>
<!-- End K2 Category Layout -->




<div class="pickmeup pmu-view-days display_none tmp3" style="display: none !important; top: 427px; left: 210px;"><div class="pmu-instance"><nav><div class="pmu-prev pmu-button" style="visibility: visible;">◀</div><div class="pmu-month pmu-button">Июнь, 2015</div><div class="pmu-next pmu-button" style="visibility: visible;">▶</div></nav><nav class="pmu-day-of-week"><div>Пн</div><div>Вт</div><div>Ср</div><div>Чт</div><div>Пт</div><div>Сб</div><div>Вс</div></nav><div class="pmu-years"><div class=" pmu-button">2009</div><div class=" pmu-button">2010</div><div class=" pmu-button">2011</div><div class=" pmu-button">2012</div><div class=" pmu-button">2013</div><div class=" pmu-button">2014</div><div class="pmu-selected pmu-button">2015</div><div class=" pmu-button">2016</div><div class=" pmu-button">2017</div><div class=" pmu-button">2018</div><div class=" pmu-button">2019</div><div class=" pmu-button">2020</div></div><div class="pmu-months"><div class=" pmu-button">Янв</div><div class=" pmu-button">Фев</div><div class=" pmu-button">Март</div><div class=" pmu-button">Апр</div><div class=" pmu-button">Май</div><div class="pmu-selected pmu-button">Июнь</div><div class=" pmu-button">Июль</div><div class=" pmu-button">Авг</div><div class=" pmu-button">Сент</div><div class=" pmu-button">Окт</div><div class=" pmu-button">Нояб</div><div class=" pmu-button">Дек</div></div><div class="pmu-days"><div class=" pmu-button">1</div><div class=" pmu-button">2</div><div class=" pmu-button">3</div><div class=" pmu-button">4</div><div class=" pmu-button">5</div><div class="pmu-saturday pmu-button">6</div><div class="pmu-sunday pmu-button">7</div><div class=" pmu-button">8</div><div class=" pmu-button">9</div><div class=" pmu-button">10</div><div class=" pmu-button">11</div><div class=" pmu-button">12</div><div class="pmu-saturday pmu-button">13</div><div class="pmu-sunday pmu-button">14</div><div class=" pmu-button">15</div><div class=" pmu-button">16</div><div class=" pmu-button">17</div><div class=" pmu-button">18</div><div class=" pmu-button">19</div><div class="pmu-saturday pmu-button">20</div><div class="pmu-sunday pmu-button">21</div><div class=" pmu-button">22</div><div class=" pmu-button">23</div><div class=" pmu-button">24</div><div class=" pmu-button">25</div><div class="pmu-selected pmu-today pmu-button">26</div><div class="pmu-saturday pmu-button">27</div><div class="pmu-sunday pmu-button">28</div><div class=" pmu-button">29</div><div class=" pmu-button">30</div><div class="pmu-not-in-month pmu-button">1</div><div class="pmu-not-in-month pmu-button">2</div><div class="pmu-not-in-month pmu-button">3</div><div class="pmu-not-in-month pmu-saturday pmu-button">4</div><div class="pmu-not-in-month pmu-sunday pmu-button">5</div><div class="pmu-not-in-month pmu-button">6</div><div class="pmu-not-in-month pmu-button">7</div><div class="pmu-not-in-month pmu-button">8</div><div class="pmu-not-in-month pmu-button">9</div><div class="pmu-not-in-month pmu-button">10</div><div class="pmu-not-in-month pmu-saturday pmu-button">11</div><div class="pmu-not-in-month pmu-sunday pmu-button">12</div></div></div></div>

<style type="text/css">
    #djslider-loader125{
    
        display:none;
    }
    
</style>


