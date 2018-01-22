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


//$items[0]->catid
$catimg = JPATH_SITE."/media/k2/categories/".$items[0]->catid.".*";
$fullpath = glob($catimg);
$ext = pathinfo($fullpath[0], PATHINFO_EXTENSION);
$catimg = "/media/k2/categories/".$items[0]->catid.".".$ext;

$module->title = str_replace(" ", "<br>", $module->title);



//echo "===]".$module->title;
?>



<?php


$module->title = str_replace("События<br>партнёров", "События партнёров", $module->title);

?>
<div style="background-image: url('<?php echo $catimg; ?>');" class="tmp7 k2ItemsBlock<?php if($params->get('moduleclass_sfx')) echo ' '.$params->get('moduleclass_sfx'); ?>" id="k2ModuleBox<?php echo $module->id; ?>">
    <div>
        <div>
            <div>
                <h1><?php echo $module->title; ?></h1>
                
            </div>
        </div>
    </div>
    <div>
        
    <?php 
    if(($module->title)=="новости"){ echo '<div class="tmp_text1">запуск раздела:</div><div class="tmp_text2">ИЮЛЬ 2015</div>';  }; 
    if(($module->title)=="Обзоры"){ echo '<div class="tmp_text1">запуск раздела:</div><div class="tmp_text2">ИЮЛЬ 2015</div>';  }; 
    if(($module->title)=="Видео"){ echo '<div class="tmp_text1">запуск раздела:</div><div class="tmp_text2">ИЮЛЬ 2015</div>';  }; 
    if(($module->title)=="События партнёров"){ echo '<div class="tmp_text1">запуск раздела:</div><div class="tmp_text2">ИЮЛЬ 2015</div>';  }; 
    if(($module->title)=="Купоны"){ echo '';  }; 
    if(($module->title)=="Голосования и опросы"){ echo '';  }; 
    
    
    ?>    
       
       

<!-----===================================---->       
<?php if(($module->title)=="Афиши"){  ?>




<?php  shuffle($items);  ?>
<?php foreach ($items as $key=>$item):
?>   

<?php    
    $datetime = explode(" ", $item->created);
    $date = explode("-", $datetime[0]);
    $time = explode(":", $datetime[1]);

    ?>
    

    
    
        <div class="info tmp8">
    
<?php


//echo $item->catid;


$catid=$item->catid;

 $database3 = JFactory::getDbo();
     $database3->setQuery("SELECT * FROM #__k2_categories WHERE id='".$catid."'  ");
     
    $list3 = $database3->loadObjectList();
    
    foreach($list3 as $it3) {
        $cat_alias=$it3->alias;
     //   echo $cat_alias;
    }


?>            
<?php
$alias1=str_replace("vse/","",$item->alias);
$cat_alias=str_replace("vse","",$cat_alias);
$link1=str_replace("//","/","/afishi/".$cat_alias."/".$alias1);
?>



            
<?php if($params->get('itemImage') && isset($item->imageSmall)): ?>

            <div class="img">
                
                

                <a class="moduleItemImage" href="<?php 
                
                //echo $item->link; 
                echo $link1; 
                ?>" title="<?php echo JText::_('K2_CONTINUE_READING'); ?> &quot;<?php echo K2HelperUtilities::cleanHtml($item->title); ?>&quot;">
                    <div style="background-image: url('<?php echo $item->imageSmall; ?>');" class="tmp9"></div>
                </a>
            </div>
<?php endif; ?>
            <div class="text"><a style="display: block;" class="moduleItemTitle" 
            title="<?php echo JText::_('K2_CONTINUE_READING'); ?> &quot;<?php echo K2HelperUtilities::cleanHtml($item->title); ?>&quot;" 
            href="<?php echo $link1; ?>"><?php echo $item->title; ?></a></div>
            <div class="views"><?php echo $item->hits; ?></div>
            <div class="time"><?php echo $time[0].":".$time[1]; ?></div>
            <div class="data"><?php echo $date[2].".".$date[1].".".$date[0]; ?></div>
            
            
            
            
            
        </div>
        <?php endforeach; ?>
        
        
<?php  }else{  ?>


<?php foreach ($items as $key=>$item):
   

    
    $datetime = explode(" ", $item->created);
    $date = explode("-", $datetime[0]);
    $time = explode(":", $datetime[1])
    ?>
        <div>
<?php if($params->get('itemImage') && isset($item->imageSmall)): ?>
            <div class="img">
                <a class="moduleItemImage" href="<?php echo $item->link; ?>" title="<?php echo JText::_('K2_CONTINUE_READING'); ?> &quot;<?php echo K2HelperUtilities::cleanHtml($item->title); ?>&quot;">
                    <div style="background-image: url('<?php echo $item->imageSmall; ?>');"></div>
                </a>
            </div>
<?php endif; ?>
            <div class="text"><a style="display: block;" class="moduleItemTitle" title="<?php echo JText::_('K2_CONTINUE_READING'); ?> &quot;<?php echo K2HelperUtilities::cleanHtml($item->title); ?>&quot;" href="<?php echo $item->link; ?>"><?php echo $item->title; ?></a></div>
            <div class="views"><?php echo $item->hits; ?></div>
            <div class="time"><?php echo $time[0].":".$time[1]; ?></div>
            <div class="data"><?php echo $date[2].".".$date[1].".".$date[0]; ?></div>
            
            
            
            
            
        </div>
        <?php endforeach; ?>

<?php } ?>

<!-----===================================---->    
    
        
        
        
        
    </div>
</div>