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


// Define default image size (do not change)
K2HelperUtilities::setDefaultImage($this->item, 'itemlist', $this->params);

?>



<?php


//echo $this->item->id;
//извлечение категории
 
$category_id=$this->item->catid;

//echo $_GET['location'];


if($_GET['localion']=="17"){

$database2 = JFactory::getDbo();
$database2->setQuery("SELECT * FROM #__k2_categories WHERE id='".$category_id."'");
						
 $list2 = $database2->loadObjectList();
                                        
foreach($list2 as $it2){

$parent_id=$it2->parent;

}


//echo $parent_id;

//извлечение родительской категории

$database2 = JFactory::getDbo();
$database2->setQuery("SELECT * FROM #__k2_categories WHERE id='".$parent_id."'");
						
 $list2 = $database2->loadObjectList();
                                        
foreach($list2 as $it2){

$parent_id=$it2->parent;

}


//echo $parent_id;



}else{
    
   
    
    $database2 = JFactory::getDbo();
$database2->setQuery("SELECT * FROM #__k2_categories WHERE id='".$category_id."'");
						
 $list2 = $database2->loadObjectList();
                                        
foreach($list2 as $it2){

$parent_id=$it2->parent;

}



//echo $parent_id;
    
    
}




?>

<?php

if($parent_id==$_GET['localion']){
?>





	  <?php   if( (isset($_GET['day']))  ){ 
	  
	  if(substr(($this->item->created),0,10)==$_GET['day']) {
	  //&&(substr(($this->item->created),0,10)==$_GET['day'])
	  
	   ?>


<li class="thumb">
    <span>
        <a href="<?php 
        
        
        $link1=str_replace("amurskaya-obl/blagoveshchensk/","",($this->item->link));
        $link1=str_replace("blagoveshchensk/","",($link1));
        echo $link1;  
        
        
        
        
        ?>">
            
     
     
     
     
          
            
            
<?php      

//$r=$this->item->params->get('itemExtraFields');

//foreach($this->item->extra_fields as $item){
//echo"+++ ";
//$extrafields[$item->id] = $item->value;//
//}
?>            
    

	  
	  
            <img class="sigProImg ssig2" src="/plugins/content/jw_sigpro/jw_sigpro/includes/images/transparent.gif" style="background-image:url('<?php
            
            
            
            
            	$database2 = JFactory::getDbo();
		        $database2->setQuery("SELECT * FROM #__k2_items WHERE id=".$this->item->id."");
		        $list2 = $database2->loadObjectList();
 
		        foreach($list2 as $it) {
                 $name=$it->extra_fields;
		        }

                $e_fields = json_decode($name);
                //echo $e_fields;
            //var_dump($e_fields);
            if(($e_fields[1]->value[1])==""){
            echo "/images/avatars/kak_pravilno_vybrat_fotoapparat_readmas.ru_04.jpg";
                
            }else{
            echo $e_fields[1]->value[1];
                
            }
            
            
            ?>');">
            
           <!--
            <span class="time"><?php  
            // $datetime = explode(" ", $item->created);
   // $date = explode("-", $datetime[0]);
  //  $time = explode(":", $datetime[1]);
            
         //   echo $time[0].":".$time[1];
            
            ?></span>
            -->
            <!--
            <span class="data"><?php 
           
            
            
            ?></span>-->
            
            <span class="title"><?php 
            
            
            echo mb_strimwidth($this->item->title, 0, 30, "..."); 
            
             ?></span>
             
             
             
             
             
             
            <span class="date"><?php  //echo JHTML::_('date', $this->item->created , JText::_('DATE_FORMAT_LC2')); 
            
             $datetime = explode(" ",  $this->item->created);
    $date = explode("-", $datetime[0]);
    $time = explode(":", $datetime[1]);
    
     echo "<div class='date1'>".$date[2].".".$date[1].".".$date[0]."</div>";
            
            echo "<div class='time1'>".$time[0].":".$time[1]."</div>";
            
            
            
            ?>  <?php  echo "<div class='hits1'>".$this->item->hits."</div>";  ?></span>
            
            
            
            <span class="category">Категория: <?php
            
            $category_id=$this->item->catid;  
            	$database2 = JFactory::getDbo();
		        $database2->setQuery("SELECT * FROM #__k2_categories WHERE id=".$category_id."");
		        $list2 = $database2->loadObjectList();
 
		        foreach($list2 as $it) {
                $name=$it->name;
		        }
		    
		    echo $name;
            ?></span>
            
                <!--<span class="rating">
              <div class="itemRatingBlock">
           
		            <div class="itemRatingForm">
			            <ul class="itemRatingList">
				            <li class="itemCurrentRating" id="itemCurrentRating<?php echo $this->item->id; ?>" style="width:<?php echo $this->item->votingPercentage; ?>%;"></li>
				            <li><span  class="one-star">1</span></li>
				            <li><span  class="two-stars">2</span></li>
				            <li><span  class="three-stars">3</span></li>
				            <li><span  class="four-stars">4</span></li>
				            <li><span  class="five-stars">5</span></li>
			            </ul>
			            <div id="itemRatingLog<?php echo $this->item->id; ?>" class="itemRatingLog"><?php echo $this->item->numOfvotes; ?></div>
			            <div class="clr"></div>
		            </div>
		            
	           </div>  
	           </span>-->
            
            
        </a>
    </span>
    
                
    
    
</li>



<?php

	  }
	  }else{

?>



<li class="thumb">
    <span>
        <a href="<?php 
        
        
        $link1=str_replace("amurskaya-obl/blagoveshchensk/","",($this->item->link));
        $link1=str_replace("blagoveshchensk/","",($link1));
        echo $link1; 
        
        
        
        
        ?>">
            
     
     
     
     
          
            
            
<?php      

//$r=$this->item->params->get('itemExtraFields');

//foreach($this->item->extra_fields as $item){
//echo"+++ ";
//$extrafields[$item->id] = $item->value;//
//}
?>            
    

	 
	  
	  
            <img class="sigProImg ssig2" src="/plugins/content/jw_sigpro/jw_sigpro/includes/images/transparent.gif" style="background-image:url('<?php
            
            
            
            
            	$database2 = JFactory::getDbo();
		        $database2->setQuery("SELECT * FROM #__k2_items WHERE id=".$this->item->id."");
		        $list2 = $database2->loadObjectList();
 
		        foreach($list2 as $it) {
                 $name=$it->extra_fields;
		        }

                $e_fields = json_decode($name);
                //echo $e_fields;
            //var_dump($e_fields);
            if(($e_fields[1]->value[1])==""){
            echo "/images/avatars/kak_pravilno_vybrat_fotoapparat_readmas.ru_04.jpg";
                
            }else{
            echo $e_fields[1]->value[1];
                
            }
            
            
            ?>');">
            
           <!--
            <span class="time"><?php  
            // $datetime = explode(" ", $item->created);
   // $date = explode("-", $datetime[0]);
  //  $time = explode(":", $datetime[1]);
            
         //   echo $time[0].":".$time[1];
            
            ?></span>
            -->
            <!--
            <span class="data"><?php 
           
            
            
            ?></span>-->
            
            <span class="title"><?php 
            
            
            echo mb_strimwidth($this->item->title, 0, 30, "..."); 
            
             ?></span>
             
             
             
             
             
             
            <span class="date"><?php  //echo JHTML::_('date', $this->item->created , JText::_('DATE_FORMAT_LC2')); 
            
             $datetime = explode(" ",  $this->item->created);
    $date = explode("-", $datetime[0]);
    $time = explode(":", $datetime[1]);
    
     echo "<div class='date1'>".$date[2].".".$date[1].".".$date[0]."</div>";
            
            echo "<div class='time1'>".$time[0].":".$time[1]."</div>";
            
            
            
            ?>  <?php  echo "<div class='hits1'>".$this->item->hits."</div>";  ?></span>
            
            
            
            <span class="category">Категория: <?php
            
            $category_id=$this->item->catid;  
            	$database2 = JFactory::getDbo();
		        $database2->setQuery("SELECT * FROM #__k2_categories WHERE id=".$category_id."");
		        $list2 = $database2->loadObjectList();
 
		        foreach($list2 as $it) {
                $name=$it->name;
		        }
		    
		    echo $name;
            ?></span>
            
                <!--<span class="rating">
              <div class="itemRatingBlock">
           
		            <div class="itemRatingForm">
			            <ul class="itemRatingList">
				            <li class="itemCurrentRating" id="itemCurrentRating<?php echo $this->item->id; ?>" style="width:<?php echo $this->item->votingPercentage; ?>%;"></li>
				            <li><span  class="one-star">1</span></li>
				            <li><span  class="two-stars">2</span></li>
				            <li><span  class="three-stars">3</span></li>
				            <li><span  class="four-stars">4</span></li>
				            <li><span  class="five-stars">5</span></li>
			            </ul>
			            <div id="itemRatingLog<?php echo $this->item->id; ?>" class="itemRatingLog"><?php echo $this->item->numOfvotes; ?></div>
			            <div class="clr"></div>
		            </div>
		            

	           </div>  
	           </span>-->
            
            
        </a>
    </span>
    
                
    
    
</li>





<?php

	  }

?>









<?php
}

?>
