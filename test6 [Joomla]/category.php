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


<style type="text/css">
.jspPane{
width:100% !important;
height:100% !important;
top:75px !important;
}


</style>


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
			
			echo '<div class="date '.$class.' " id="date_0" onclick="date(0, \''.date("Y-m-d H:i:s").'\');" style="width:100px !important; color:black !important; "><span class="date_num">'.$time.'</span>
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
		                    
		                    
		                    <?php
		                    if(($it2->name)=="Благовещенск"){
		                    ?>
		                    
		                    <li style="padding:0px; margin:0px; list-style-type: none;"><a href="/afishi?localion=<?php  echo $it2->id;   ?>&location_name=<?php echo $it2->alias; ?>" style="padding:0px; margin:0px; width:140px; 
		                    background-image:none !important; border-top:1px #fff solid; text-align:left; padding-left:15px;  margin-top:0px !important;
		                    margin-bottom:0px !important;"><?php echo $it2->name;  ?></a></li>
							
		                    
		                    <?php
		                    }else{
		                    ?>    
		                    
		                    
		                    <li style="padding:0px; margin:0px; list-style-type: none;"><a href="/<?php  echo $it2->alias; ?>/afisha?localion=<?php  echo $it2->id;   ?>&location_name=<?php echo $it2->alias; ?>" style="padding:0px; margin:0px; width:140px; 
		                    background-image:none !important; border-top:1px #fff solid; text-align:left; padding-left:15px;  margin-top:0px !important;
		                    margin-bottom:0px !important;"><?php echo $it2->name;  ?></a></li>
							
							<?php
		                    }
		                    ?>
							                
		                  <?php    
		                      }
		                  
		                  
		                                }
						
						?>
						    
						    
				
						
						
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
		
		
		
		if(($it->name)=="ВСЕ"){
		$uri = &JFactory::getURI();
        $url = $uri->toString(array('path', 'query', 'fragment'));
        
        if( ($url=="/afishi") || ($url=="/afishi?localion=".$_GET['localion']."&location_name=".$_GET['location_name']."") ){
        echo'<span class="cat_name tmp13 active "><a href="/afishi?localion='.$_GET['localion'].'&location_name='.$_GET['location_name'].'">'.$it->name.'</a></span>';
            
        }else{                                 
		echo'<span class="cat_name tmp13  "><a href="/afishi?localion='.$_GET['localion'].'&location_name='.$_GET['location_name'].'">'.$it->name.'</a></span>';
        }
        
		}
		
		
		
		
		}
		
 
 
 
 
		foreach($list2 as $it) { 
		
		if( (isset($_GET['subcategory'])) && ($_GET['subcategory']==($it->id)) ){
		    
		if(($it->name)=="ВСЕ"){
		echo'<span class="cat_name tmp11"><a href="/afishi?localion='.$_GET['localion'].'&location_name='.$_GET['location_name'].'">'.$it->name.'</a></span>';
		    
		}else{   
		echo'<span class="cat_name tmp12" style="color:#2194BB;"><a href="/afishi/'.$it->alias.'?subcategory='.$it->id.'&localion='.$_GET['localion'].'&location_name='.$_GET['location_name'].'"  style="color:#2194BB;">'.$it->name.'</a></span>';
		}
		
		
		
		}else{
		
		if(($it->name)=="ВСЕ"){
		//echo'<span class="cat_name tmp13"><a href="/afishi?localion='.$_GET['localion'].'&location_name='.$_GET['location_name'].'">'.$it->name.'</a></span>';
		    
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

//window.history.replaceState("","","<?php  echo $url_mas[0]; ?>")

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




<div class="pickmeup pmu-view-days display_none tmp3" style="display: none !important; top: 427px; left: 210px;"><div class="pmu-instance"><nav><div class="pmu-prev pmu-button" style="visibility: visible;">◀</div><div class="pmu-month pmu-button">Июнь, 2015</div><div class="pmu-next pmu-button" style="visibility: visible;">▶</div></nav><nav class="pmu-day-of-week"><div>Пн</div><div>Вт</div><div>Ср</div><div>Чт</div><div>Пт</div><div>Сб</div><div>Вс</div></nav><div class="pmu-years"><div class=" pmu-button">2009</div><div class=" pmu-button">2010</div><div class=" pmu-button">2011</div><div class=" pmu-button">2012</div><div class=" pmu-button">2013</div><div class=" pmu-button">2014</div><div class="pmu-selected pmu-button">2015</div><div class=" pmu-button">2016</div><div class=" pmu-button">2017</div><div class=" pmu-button">2018</div><div class=" pmu-button">2019</div><div class=" pmu-button">2020</div></div><div class="pmu-months"><div class=" pmu-button">Янв</div><div class=" pmu-button">Фев</div><div class=" pmu-button">Март</div><div class=" pmu-button">Апр</div><div class=" pmu-button">Май</div><div class="pmu-selected pmu-button">Июнь</div><div class=" pmu-button">Июль</div><div class=" pmu-button">Авг</div><div class=" pmu-button">Сент</div><div class=" pmu-button">Окт</div><div class=" pmu-button">Нояб</div><div class=" pmu-button">Дек</div></div><div class="pmu-days"><div class=" pmu-button">1</div><div class=" pmu-button">2</div><div class=" pmu-button">3</div><div class=" pmu-button">4</div><div class=" pmu-button">5</div><div class="pmu-saturday pmu-button">6</div><div class="pmu-sunday pmu-button">7</div><div class=" pmu-button">8</div><div class=" pmu-button">9</div><div class=" pmu-button">10</div><div class=" pmu-button">11</div><div class=" pmu-button">12</div><div class="pmu-saturday pmu-button">13</div><div class="pmu-sunday pmu-button">14</div><div class=" pmu-button">15</div><div class=" pmu-button">16</div><div class=" pmu-button">17</div><div class=" pmu-button">18</div><div class=" pmu-button">19</div><div class="pmu-saturday pmu-button">20</div><div class="pmu-sunday pmu-button">21</div><div class=" pmu-button">22</div><div class=" pmu-button">23</div><div class=" pmu-button">24</div><div class=" pmu-button">25</div><div class="pmu-selected pmu-today pmu-button">26</div><div class="pmu-saturday pmu-button">27</div><div class="pmu-sunday pmu-button">28</div><div class=" pmu-button">29</div><div class=" pmu-button">30</div><div class="pmu-not-in-month pmu-button">1</div><div class="pmu-not-in-month pmu-button">2</div><div class="pmu-not-in-month pmu-button">3</div><div class="pmu-not-in-month pmu-saturday pmu-button">4</div><div class="pmu-not-in-month pmu-sunday pmu-button">5</div><div class="pmu-not-in-month pmu-button">6</div><div class="pmu-not-in-month pmu-button">7</div><div class="pmu-not-in-month pmu-button">8</div><div class="pmu-not-in-month pmu-button">9</div><div class="pmu-not-in-month pmu-button">10</div><div class="pmu-not-in-month pmu-saturday pmu-button">11</div><div class="pmu-not-in-month pmu-sunday pmu-button">12</div></div></div></div>



<script type="text/javascript">
var $j2 = jQuery.noConflict();
$j2('body').scroll(function(){
    
var t=$j2(".jspPane").css('top');
t=t.replace("-","");
t=t.replace("px","");

if(t>300){

    $j2(".calendar_container.tmp323").css({"position" : "fixed"});
    $j2(".calendar_container.tmp323").css({"top" : "75px"});
    $j2(".calendar_container.tmp323").css({"padding-right" : "157px"});
    $j2(".calendar_container.tmp323").css({"z-index" : "10"});
    $j2(".calendar_container.tmp323").css({"width" : "100%"});
    $j2(".calendar_container.tmp0").css({"display" : "none"});
    
    
}else{
    $j2(".calendar_container.tmp323").css({"position" : "relative"});
    $j2(".calendar_container.tmp323").css({"padding-right" : "38px"});
    $j2(".calendar_container.tmp323").css({"z-index" : "10"});
    //$j2(".calendar_container.tmp323").css({"top" : "375px"});
}
    
    
});
</script>


<script type="text/javascript">
var $j2 = jQuery.noConflict();

$j2(window).load(function () {



var h=$j2(".main_afisha_banners.tmp1").css('height');
var h2=$j2(".poster_items ").css('height');

//alert(h);

if(h>h2){
$j2(".poster_items ").css({"height" : "calc("+h+" + 30px)"});
}



 });

</script>
<script type='text/javascript' src='/js/resize_window.js'></script>
<script type='text/javascript' src='/js/resize_window_main.js'></script>

<?php

?>