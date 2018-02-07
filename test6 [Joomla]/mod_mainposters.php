<?php

defined('_JEXEC') or die;


?>

<!--постеры-->
<div class="poster_items tmp2">
<?php

$m=0;


?>










<!------------------------------------------------>



<?php

if( (isset($_GET['day'])) ){
    
$today=$_GET['day'];









$date=$today;
//$razdel=$_GET['razdel'];



// получение идентификаторов дочерних категорий категории Афиши
$database = JFactory::getDbo();
$database->setQuery("SELECT * FROM #__k2_categories WHERE parent=5 AND published=1 AND trash=0");
$list = $database->loadObjectList();

 
 


 
foreach($list as $it) { 

$sub_cat_id=$it->id;

//$html=$html.$sub_cat_id;



    $database2 = JFactory::getDbo();
     $database2->setQuery("SELECT * FROM #__k2_items WHERE catid=".$sub_cat_id."  AND trash=0");
     
    $list2 = $database2->loadObjectList();
    
    foreach($list2 as $it2) {
    
       $hash2 = md5('Image'.$it2->id);
    
        $today=$date;
        $today10=substr($today,0,10);
        
        
        
        $publish_down10=substr($it2->publish_down,0,10);
        
        
        //$html=$html.$publish_down10;
  //  echo $today;

  //  $result=(($it2->publish_up)<$today);
//    $result2=($today<($it2->publish_down));

   if($today10==$publish_down10){



$catid=$it2->catid;

 $database3 = JFactory::getDbo();
     $database3->setQuery("SELECT * FROM #__k2_categories WHERE id='".$catid."'  ");
     
    $list3 = $database3->loadObjectList();
    
    foreach($list3 as $it3) {
        $cat_alias=$it3->alias;
    }
$alias1=str_replace("vse/","",$it2->alias);
$cat_alias=str_replace("vse","",$cat_alias);
$link1=str_replace("//","/","/afishi/".$cat_alias."/".$alias1);



   echo'  
<div class="poster_img" style="height: calc(208px);">
<div class="black_shadow_1">
    
    
</div>
<a href="'.$link1.'" style="width:100%; height:100%; display:block;">
<img class="poster_img2" src="/media/k2/items/src/'.$hash2.'.jpg" style="z-index: 500;">
</a>
</div>';
    
    
  }
   
    
    }
    
    
   
 
    
}





}

?>










<!------------------------------------------------>


    
    
<?php

if( (!isset($_GET['day'])) ){

?>
    
    

<?php
$database = JFactory::getDbo();

if( (isset($_GET['subcategory'])) ){
		    
    $database->setQuery("SELECT * FROM #__k2_items WHERE catid=".$_GET['subcategory']."  AND trash=0 ORDER BY publish_down,publish_up");
	
}else{
		
    $database->setQuery("SELECT * FROM #__k2_items WHERE catid=5 AND trash=0 ORDER BY publish_down,publish_up");
		
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

if(($result==true)||($result2==true)){ break; };
}






if(($result==true)||($result2==true)){
	

?>







<div class="poster_img tmp33" >

<div class="poster_img2" style="background-image:url(/media/k2/items/src/<?php echo $hash;?>.jpg);">
    
<div class="black_shadow_1">
    
    
</div>   
    
    
<a href="/component/k2/item/<?php echo $it->id;  ?>-<?php echo $it->alias; ?>" style="width:100%; height:100%; display:block;"></a>
<!--<span style="position:absolute; background-color:#fff; z-index:9999;"><?php echo $it->publish_up;echo" - "; echo $it->catid;  echo"<br>"; echo  $it->publish_down;    ?></span>-->
</div>
</div> 

<?php

$MAS_hash[$m]=$hash;
$MAS_id[$m]=$it->id;
$MAS_alias[$m]=$it->alias;

$m++;
?>



































<?php
}
?>



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




<!-- поиск по подкатегориям --->


<?php


if( (isset($_GET['subcategory'])) ){
    

}else{

// получение идентификаторов дочерних категорий категории Афиши
$database->setQuery("SELECT * FROM #__k2_categories WHERE parent=5 AND published=1 AND trash=0");
$list = $database->loadObjectList();


$m1=0;
$sql1="";
 
foreach($list as $it) { 

$sub_cat_id_m[$m1]=$it->id;

$sql1=$sql1.$sub_cat_id_m[$m1].",";
//echo $sub_cat_id_m[$m1]." = ";


$m1++;
    
}//foreach($list as $it) 



$sql1=substr_replace($sql1, '', strrpos($sql1, ','));

//echo "=======".$sql1;


    $database2 = JFactory::getDbo();
     $database2->setQuery("SELECT * FROM #__k2_items WHERE catid IN (".$sql1.") AND trash=0 ORDER BY publish_down,publish_up ");
     
    $list2 = $database2->loadObjectList();
    
    foreach($list2 as $it2) {
    
       $hash2 = md5('Image'.$it2->id);
    
    
    
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

$result=(($it2->publish_up)<$today);
$result2=($today<($it2->publish_down));

for($i_1=0;$i_1<30;$i_1++){
//$tmp_date=("Y-m-d H:i:s", time()+(86400*$i_1));
$day_7=date("Y-m-d H:i:s", time()+(86400*$i_1));



//echo $day_7."<br>";

//$result=(($it2->publish_up)<$today);
//$result2=($today<($it2->publish_down));



$result=(($it2->publish_up)<$day_7);
$result2=($day_7<($it2->publish_down));

//echo ($it2->publish_up)." - ".;

//echo $result." = ".$result2."   <br>";

if(($result==true)&&($result2==true)){ break; };
}






if(($result==true)&&($result2==true)){
	

?>









<div class="poster_img tmp3512">

<div class="black_shadow_1">
    
    
</div>


    
<?php

$catid=$it2->catid;

 $database3 = JFactory::getDbo();
     $database3->setQuery("SELECT * FROM #__k2_categories WHERE id='".$catid."'  ");
     
    $list3 = $database3->loadObjectList();
    
    foreach($list3 as $it3) {
        $cat_alias=$it3->alias;
    }


?>

<?php
$alias1=str_replace("vse/","",$it2->alias);
//$cat_alias=str_replace("vse","",$cat_alias);
//$alias1=$it->alias;
//if($cat_alias==""){
//    
//    $cat_alias="vse";//
//}

$link1=str_replace("//","/","/afishi/".$cat_alias."/".$alias1);


?>


    

<a href="<?php echo $link1; ?>" style="width:100%; height:100%; display:block;">
<img class="poster_img2" src="/media/k2/items/src/<?php echo $hash2;?>.jpg"/>
</a>

</div>


<?php

$MAS_hash[$m]=$hash;
$MAS_id[$m]=$it->id;
$MAS_alias[$m]=$it->alias;

$m++;
?>



<?php
}/////if(($result==true)&&($result2==true))
    
}//foreach($list2 as $it2)

}


}

?>


</div>
<!--постеры-->

<script type="text/javascript">
var $j2 = jQuery.noConflict();
    //var temp_width=$j2(".poster_items .poster_img .poster_img2").outerWidth();
    
	var temp_width=$j2(".poster_items").width();
	temp_width=temp_width/5;
    //var temp_height=temp_width*2;
    
     $j2(".poster_img").css({"height" : "calc("+temp_width+"px)"});
    
    
</script>




















<!--баннеры-->
<div class="main_afisha_banners tmp1">


   
    
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

		
		$database->setQuery("SELECT * FROM #__banners WHERE catid='17' AND state='1'");
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
        
        




</div>
<!--баннеры-->










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
                    url: "/action/poster_date.php",  
                    data: "date="+(date),
	  	 		
                    success: function(html){  
			
					    $j(".poster_items").html(html);
					    $j(".poster_img").css({"height" : "calc("+temp_width+" * 1)"});	
                    }  
         });



    
    


}



</script>













