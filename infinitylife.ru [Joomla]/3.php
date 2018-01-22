

<!--

<div class="poster_items tmp1121">
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
<div class="black_shadow_1">
    
    
</div>
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
    
    
    //поиск дочерних категорий
    $database_parent = JFactory::getDbo();
    $database_parent->setQuery("SELECT * FROM #__k2_categories WHERE parent='5' AND published=1 AND trash=0");
    $list_parent = $database_parent->loadObjectList();
    
    $parents="";
 
    foreach($list_parent as $it_parent) {
        
        $parents=$parents.($it_parent->id).",";
        
        
        
    }
    
    
   // echo $parents;
    
    
		//echo $this->category->id;
   // $database->setQuery("SELECT * FROM #__k2_items WHERE catid=".($this->category->id)." AND published=1 AND trash=0 ORDER BY publish_down,publish_up");
	 $database->setQuery("SELECT * FROM #__k2_items WHERE catid IN (1,2,3,4,5,6,7,8,9,10,11,12,13,14) AND published=1 AND trash=0 ORDER BY publish_down,publish_up");
		
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
//$alias1=str_replace("vse/","",$it->alias);
//$cat_alias=str_replace("vse","",$cat_alias);
$alias1=$it->alias;
$link1=str_replace("//","/","/afishi/".$cat_alias."/".$alias1);

$link1=str_replace("afishi/afishi/","afishi/vse/",$link1);


?>

<div class="poster_img tmp372" >
<div class="black_shadow_1">
    
    
</div>    
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



<div class="main_afisha_banners cat" style="display:none;">
    
    
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

		
		$database->setQuery("SELECT * FROM #__banners WHERE catid='17'  AND state='1'");
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




-->