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

$app = JFactory::getApplication();
$template = $app->getTemplate('template')->template;
$doc = JFactory::getDocument();
$doc->addStyleSheet($this->baseurl . '/templates/' . $template . '/css/photo.css');
$doc->addScript($this->baseurl . '/templates/' . $template . '/js/photo.js');

echo '<script src="'.$this->baseurl . '/templates/' . $template . '/js/jquery.cycle2.carousel2.js'.'"></script>';
?>



<?php



if( (!isset($_GET['localion'])) || ($_GET['localion']=="") || ($_GET['localion']==NULL) ){
    
    $_GET['localion']="17";
}


?>




<!--

<div class="photocontent-top">




    <div class="scrollbanners" data-cycle-fx=carousel2 data-cycle-timeout=0 data-allow-wrap=false
         data-cycle-next=".next"
         data-cycle-prev=".prev"
        ><!--data-cycle-center-horz=true  data-cycle-fx=scrollHorz-->
   <!--     <?php $i = 0; foreach($this->leading as $key=>$item):
            K2HelperUtilities::setDefaultImage($item, 'itemlist', $this->params);
            ?>

            <div>
                <a>
                    <img class="sigProImg" src="<?php echo $item->image; ?>">
                </a>

                <div class="buttons">
                    <div class="floattitle">
                        <div class="title"><?php echo $item->title; ?></div>
                        <div class="introtext">
                            <?php echo $item->introtext; ?>
                        </div>
                        <a href="<?php echo $item->link; ?>" class="button">БОЛЬШЕ >></a>
                    </div>

                    <!--<a href="<?php echo $item->link; ?>" class="sigProLink"></a>-->
         <!--         <a href=# class="prev">&lt;&lt; Prev </a>
                    <a href=# class="next"> Next &gt;&gt; </a>
                    <a href=# onclick="jQuery('.scrollbanners').cycle('goto', <?php echo $i++; ?>); return false;"
                       class="select"></a>
                </div>
            </div>
        <?php endforeach; ?>
    </div>
</div>

-->


<div class="p1 photocontent-center <?php if( count(JModuleHelper::getModules('rightmenu')) ) echo "rightmenu" ?>">




<div class="photo_sub_cats">
    
    
<?php
  //$module = JModuleHelper::getModules('photocategory');
  //$attribs['style'] = 'none';
  //echo JModuleHelper::renderModule( $module[0], $attribs );

    if(JRequest::getInt('month') && JRequest::getInt('year') && JRequest::getInt('day')){ $date =  (JRequest::getInt('day') < 10 ? "0". JRequest::getInt('day') : JRequest::getInt('day')).".".(JRequest::getInt('month') < 10 ? "0". JRequest::getInt('month') : JRequest::getInt('month')).".". JRequest::getInt('year'); } else { $date = "Выбрать дату"; }
 
		                                  $uri = &JFactory::getURI();
                                            $url = $uri->toString(array('path', 'query', 'fragment'));
		                                 // echo $url;
		                              


            if($_GET['localion']=="17"){

	                                    $database = JFactory::getDbo();
		                                $database->setQuery("SELECT * FROM #__k2_categories WHERE  parent='3'");
		                                $list = $database->loadObjectList();
                                        
		                                foreach($list as $it){
		                               
		                               
		                                    if($it->alias=="vse"){
		                                      ?>  
		                                  
		                                 
		                                  <a class="tmp1" href="/<?php echo "fotoobzor?localion=17&location_name=blagoveshchensk"; ?>"  <?php
		                                  
		                                  if($url=="/fotoobzor?localion=17&location_name=blagoveshchensk"){ echo ' class="active" ';  }
		                                  
		                                  ?>><?php echo "Все";  ?></a>
		                                    
		                                    
		                                    <?php
		                                    
		                                    }else{
		                               
		                                  ?>
		                                  
		                                  <a class="tmp2" href="/fotoobzor/<?php echo $it->alias; ?>?localion=17&location_name=blagoveshchensk" <?php
		                                  
		                                  if($url=="/fotoobzor/".$it->alias."?localion=17&location_name=blagoveshchensk"){ echo ' class="active" ';  }
		                                  
		                                  ?>><?php echo $it->name;  ?></a>
		                                  
		                                  
		                                  <?php
		                                    }
		                                  
		                                }
    
    
    ?>
    
    
    
    
    
    
        <span class="date datepick3" style="  position:absolute; z-index:99; left:0px;   display: none; width: 192px; top:-14px;">
            <a style="background-image: url(http://hinewsgc.bget.ru/templates/infinitilife/images/spoil3.png);">КАТЕГОРИИ</a><input type="hidden" class="datepickhidden" value="">
    
    
    <div class="radiochosefull3" style="position: absolute; top: 40px; left: 19px; display: none;">
						<ul style="padding:0px; margin:0px; margin-left: -100% !important;">
						    
						  
    <?php
       $database = JFactory::getDbo(); 
		                                $database->setQuery("SELECT * FROM #__menu WHERE menutype='bokovoe-menyu' AND parent_id='119'");
		                                $list = $database->loadObjectList();
                                        
		                                foreach($list as $it){
		                               
		                               
		                                    if($it->title=="Все"){
		                                      ?>  
		                                  
		                                 
		                                  <li style="padding:0px; margin:0px; padding-right:15px;"><a href="/<?php echo "fotoobzor?localion=17&location_name=blagoveshchensk"; ?>"  <?php
		                                  
		                                  if($url=="/fotoobzor?localion=17&location_name=blagoveshchensk"){ echo ' class="active" ';  }
		                                  
		                                  ?> style="padding: 0px 0px 0px 15px; margin: 0px; width: 160px; border-top-width: 1px; border-top-color: rgb(255, 255, 255);
		                     border-top-style: solid; text-align: left; background-image: none !important;"><?php echo "Все";  ?></a></li>
		                                    
		                                    
		                                    <?php
		                                    
		                                    }else{
		                               
		                                  ?>
		                                  
		                                  <li style="padding:0px; margin:0px; padding-right:15px;"><a href="/<?php echo $it->path; ?>?localion=17&location_name=blagoveshchensk" <?php
		                                  
		                                  if($url=="/".$it->path."?localion=17&location_name=blagoveshchensk"){ echo ' class="active" ';  }
		                                  
		                                  ?>  style="padding: 0px 0px 0px 15px; margin: 0px; width: 160px; border-top-width: 1px; border-top-color: rgb(255, 255, 255);
		                     border-top-style: solid; text-align: left; background-image: none !important;"><?php echo $it->title;  ?></a></li>
		                                  
		                                  
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
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    <?php
    
    
            }else{
                
                ?>
               
                <a href="/fotoobzor?localion=<?php  echo $_GET['localion'];  ?>"  
                
                 <?php
		                                  
		                                  if($url=="/fotoobzor?localion=".$_GET['localion'].""){ echo ' class="active" ';  }
		                                  
		                                  ?>
                
                >Все</a>
                
                <?php
                
                
            }
    
    
    
    
    
    
    
    ?>


</div>


 <div class="bottom2" style="width: 168px;
  float: left;
  display: inline-block;
  margin-right: 0px;">
        <div class="hd1"></div>

    <span class="date datepick" style="position:absolute; z-index:99; left:10px"><a>
	
	
	<?php //echo $date; ?>
    
    
    
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
  

    
    
    
    
    

    <span class="date datepick2" style="position:absolute; z-index:99; left:168px"><a><?php
   // echo $_GET['localion']; 
    	$database2 = JFactory::getDbo();
						$database2->setQuery("SELECT * FROM #__k2_categories WHERE id='".$_GET['localion']."'");
						
						 $list2 = $database2->loadObjectList();
                                        
		                                foreach($list2 as $it2){
		                                    
		                                    $name_city=$it2->name;
		                                }
    
    
    echo $name_city; 
    
    
    
    
    ?></a><input type="hidden" class="datepickhidden" value="">
    
    
    <div class="radiochosefull1" style="position:absolute; top: 40px;
  left: 19px; display:none;">
						<ul style="padding:0px; margin:0px;">
						    
						
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
		                    
		                    <li style="padding:0px; margin:0px;"><a href="/fotoobzor?localion=<?php  echo $it2->id;   ?>&location_name=<?php echo $it2->alias; ?>" style="padding:0px; margin:0px; width:140px; 
		                    background-image:none !important; border-top:1px #fff solid; text-align:left; padding-left:15px;"><?php echo $it2->name;  ?></a></li>
							  
							<?php
		                    }else{
							?>
							  
							<li style="padding:0px; margin:0px;"><a href="/<?php  echo $it2->alias; ?>/fotoobzory?localion=<?php  echo $it2->id;   ?>&location_name=<?php echo $it2->alias; ?>" style="padding:0px; margin:0px; width:140px; 
		                    background-image:none !important; border-top:1px #fff solid; text-align:left; padding-left:15px;"><?php echo $it2->name;  ?></a></li>
							   
							  
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


</div>




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




<div class="photocontent-bottom">

    <table border="0" cellspacing="0" width="100%">
        <tr>
            <td class="banner">
                <div class="photobanner left tmp1">
                    <?php
                    $module = JModuleHelper::getModules('photobanner-left');
                    $attribs['style'] = 'none';
                    echo JModuleHelper::renderModule( $module[1], $attribs );
                    echo JModuleHelper::renderModule( $module[0], $attribs );
                    ?>
                </div>
            </td>
            <td>
                <!-- Start K2 Category Layout -->
                <div id="k2Container" class="itemListView<?php if($this->params->get('pageclass_sfx')) echo ' '.$this->params->get('pageclass_sfx'); ?>">

                    <?php if((isset($this->leading) || isset($this->primary) || isset($this->secondary) || isset($this->links)) && (count($this->leading) || count($this->primary) || count($this->secondary) || count($this->links))): ?>
                        <!-- Item list -->
                        <div class="itemList">

                            <?php if(isset($this->leading) && count($this->leading)): ?>
                                <!-- Leading items -->
                                <div id="itemListLeading">
                                    <ul class="container">
                                        <?php $count_cat=0; ?>
                                        <?php foreach($this->leading as $key=>$item): ?>
                                        
                                            <?php
                                            // Load category_item.php by default
                                            $this->item=$item;
                                            echo $this->loadTemplate('item');
                                            ?>
                                            <?php  $count_cat++; ?>
                                        <?php endforeach; ?>
                                        
                                        
                                        <div class="clr"></div>
                                    </ul>
                                    <div class="clr"></div>
                                </div>
                            <?php endif; ?>
                            <?php if(!count($this->leading)){ ?>
                            
                            <span class="empty_category">Категория пуста</span>
                            <?php } ?>
                            
                            
                            
                        </div>

                        <!-- Pagination -->
                        <?php if($this->pagination->getPagesLinks()): ?>
                            <div class="k2Pagination">
                                <?php if($this->params->get('catPagination')) echo $this->pagination->getPagesLinks(); ?>
                                <div class="clr"></div>
                            </div>
                        <?php endif; ?>

                    <?php endif; ?>
                    
                    
                    
                    <?php
                                        if($count_cat==0){
                                            echo '<span class="empty_category">Категория пуста</span>';
                                        }
                                        
                    ?>
                    
                   
                    
                    
                    
                </div><!--
     End K2 Category Layout

    -->
            </td>
            <td class="banner">
                <div class="photobanner right tmp2 <?php if( count(JModuleHelper::getModules('rightmenu')) ) echo "rightmenu" ?>">
                    <?php
                    $module = JModuleHelper::getModules('photobanner-right');
                    $attribs['style'] = 'none';
                    echo JModuleHelper::renderModule( $module[1], $attribs );
                    echo JModuleHelper::renderModule( $module[0], $attribs );
                    ?>
                </div>
            </td>
        </tr>
    </table>

</div>

<script type="text/javascript">
<?php
$uri = &JFactory::getURI();
$url = $uri->toString(array('path', 'query', 'fragment'));
$url_mas=explode("?",$url);


?>

window.history.replaceState("","","<?php  echo $url_mas[0]; ?>")

</script>

<div class="pickmeup pmu-view-days display_none" style="display: none; top: 427px; left: 220px;"><div class="pmu-instance"><nav><div class="pmu-prev pmu-button" style="visibility: visible;">◀</div><div class="pmu-month pmu-button">Июнь, 2015</div><div class="pmu-next pmu-button" style="visibility: visible;">▶</div></nav><nav class="pmu-day-of-week"><div>Пн</div><div>Вт</div><div>Ср</div><div>Чт</div><div>Пт</div><div>Сб</div><div>Вс</div></nav><div class="pmu-years"><div class=" pmu-button">2009</div><div class=" pmu-button">2010</div><div class=" pmu-button">2011</div><div class=" pmu-button">2012</div><div class=" pmu-button">2013</div><div class=" pmu-button">2014</div><div class="pmu-selected pmu-button">2015</div><div class=" pmu-button">2016</div><div class=" pmu-button">2017</div><div class=" pmu-button">2018</div><div class=" pmu-button">2019</div><div class=" pmu-button">2020</div></div><div class="pmu-months"><div class=" pmu-button">Янв</div><div class=" pmu-button">Фев</div><div class=" pmu-button">Март</div><div class=" pmu-button">Апр</div><div class=" pmu-button">Май</div><div class="pmu-selected pmu-button">Июнь</div><div class=" pmu-button">Июль</div><div class=" pmu-button">Авг</div><div class=" pmu-button">Сент</div><div class=" pmu-button">Окт</div><div class=" pmu-button">Нояб</div><div class=" pmu-button">Дек</div></div><div class="pmu-days"><div class=" pmu-button">1</div><div class=" pmu-button">2</div><div class=" pmu-button">3</div><div class=" pmu-button">4</div><div class=" pmu-button">5</div><div class="pmu-saturday pmu-button">6</div><div class="pmu-sunday pmu-button">7</div><div class=" pmu-button">8</div><div class=" pmu-button">9</div><div class=" pmu-button">10</div><div class=" pmu-button">11</div><div class=" pmu-button">12</div><div class="pmu-saturday pmu-button">13</div><div class="pmu-sunday pmu-button">14</div><div class=" pmu-button">15</div><div class=" pmu-button">16</div><div class=" pmu-button">17</div><div class=" pmu-button">18</div><div class=" pmu-button">19</div><div class="pmu-saturday pmu-button">20</div><div class="pmu-sunday pmu-button">21</div><div class=" pmu-button">22</div><div class=" pmu-button">23</div><div class=" pmu-button">24</div><div class=" pmu-button">25</div><div class="pmu-selected pmu-today pmu-button">26</div><div class="pmu-saturday pmu-button">27</div><div class="pmu-sunday pmu-button">28</div><div class=" pmu-button">29</div><div class=" pmu-button">30</div><div class="pmu-not-in-month pmu-button">1</div><div class="pmu-not-in-month pmu-button">2</div><div class="pmu-not-in-month pmu-button">3</div><div class="pmu-not-in-month pmu-saturday pmu-button">4</div><div class="pmu-not-in-month pmu-sunday pmu-button">5</div><div class="pmu-not-in-month pmu-button">6</div><div class="pmu-not-in-month pmu-button">7</div><div class="pmu-not-in-month pmu-button">8</div><div class="pmu-not-in-month pmu-button">9</div><div class="pmu-not-in-month pmu-button">10</div><div class="pmu-not-in-month pmu-saturday pmu-button">11</div><div class="pmu-not-in-month pmu-sunday pmu-button">12</div></div></div></div>


<style type="text/css">

.nicescroll-rails{
display:block !important;	
}

body > .nicescroll-rails > div{
height:200px !important;	
}

.center > .content{
width:calc(100% + 16px) !important
}
.ss2-align{
    display:none;
}

.nivo-slider-wrapper.theme-light{
    display:none;
}
.center{
    padding-top:75px !important;
}

</style>




