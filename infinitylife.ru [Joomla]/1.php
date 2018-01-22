






<div class="poster_items">
<?php
$database = JFactory::getDbo();
$database->setQuery("SELECT * FROM #__k2_items WHERE catid=5 AND published=1 AND trash=0 ORDER BY publish_up DESC");
$list = $database->loadObjectList();
$id_tmp=0;
 
foreach($list as $it) { 
   
   
   $hash = md5('Image'.$it->id);
	//echo $hash;
?>


<?php

//echo $it->publish_up;
//echo"<br>";
//echo $it->publish_down;
//echo"<br>";
$today=date("Y-m-d H:i:s");
//echo $today;

$result=(($it->publish_up)<$today);
$result2=($today<($it->publish_down));

if(($result==true)&&($result2==true)){
	

?>
<?php
//$alias1=str_replace("vse/","",$it->alias);
//$cat_alias=str_replace("vse","",$cat_alias);
$alias1=$it->alias;
if($cat_alias==""){
    
    $cat_alias="vse";
}
$link1=str_replace("//","/","/afishi/".$cat_alias."/".$alias1);

?>  
    


<div class="poster_img tmp331" id="<?php echo "i_".$id_tmp; $id_tmp++;  ?>">
<div class="black_shadow_1">
    
    
</div>
<div class="poster_img2" style="background-image:url(/media/k2/items/src/<?php echo $hash;?>.jpg);">
<a href="<?php echo $link1; ?>" style="width:100%; height:100%; display:block;"></a>
</div>
</div>



<script type="text/javascript">
    var $j = jQuery.noConflict();
 var temp_width=$j(".poster_img").css("width");
$j(".poster_img").css({"height" : "calc("+temp_width+" * 1)"});	


    
</script>




<?php
}
?>



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


$result=(($it2->publish_up)<$day_7);
$result2=($day_7<($it2->publish_down));

if(($result==true)&&($result2==true)){ break; };
}






if(($result==true)&&($result2==true)){
	

?>










    
<?php

$catid=$it2->catid;

 $database3 = JFactory::getDbo();
     $database3->setQuery("SELECT * FROM #__k2_categories WHERE id='".$catid."'  ");
     
    $list3 = $database3->loadObjectList();
    
    foreach($list3 as $it3) {
        $cat_alias=$it3->alias;
    }



?>
    

<!--
    -->
    
    
    
    
<?php
//$alias1=str_replace("vse/","",$it2->alias);
//$cat_alias=str_replace("vse","",$cat_alias);
$alias1=$it2->alias;
//$cat_alias=$cat_alias;
$link1=str_replace("//","/","/afishi/".$cat_alias."/".$alias1);
?>  
    
    
    
    
<div class="poster_img tmp34" >
<div class="black_shadow_1">
    
    
</div>    

<div class="poster_img2" style="background-image:url(/media/k2/items/src/<?php echo $hash2;?>.jpg);">
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
    
    
    
    
    
   // }
    
    
}






}


?>






















</div>


