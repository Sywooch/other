<?php
/*
# author Roland Soos
# copyright Copyright (C) Nextendweb.com. All Rights Reserved.
# @license - http://www.gnu.org/licenses/gpl-3.0.txt GNU/GPL
*/
defined('_JEXEC') or die('Restricted access'); ?><?php
$js = NextendJavascript::getInstance();
$js->addLibraryJsFile('jquery', dirname(__FILE__) . DIRECTORY_SEPARATOR . 'slider.js');

$backgroundimage = $this->_sliderParams->get('fullpagebackgroundimage', '');
$backgroundimagecss = '';
if ($backgroundimage && $backgroundimage != '-1') $backgroundimagecss = 'background-image: url(' . NextendUri::fixrelative($backgroundimage) . ');';

$flux = (array)NextendParse::parse($this->_sliderParams->get('fullpagebackgroundanimation', '0|*|bars||blocks'));
$flux[0] = $this->_backend ? 0 : intval($flux[0]);
foreach($this->_slides AS $slide){
    if ($slide['bg']['desktop'] == ''){
        $flux[0] = 0;
        break;
    }
}

if (!isset($flux[1])) $flux[1] = 'bars';
$flux[1] = (array)$flux[1];
if ($flux[0]) {
    $js->addLibraryJsFile('jquery', dirname(__FILE__) . DIRECTORY_SEPARATOR . 'flux.jquery.js');
}

?>
<script type="text/javascript">
    window['<?php echo $id; ?>-onresize'] = [];
</script>

<div id="<?php echo $id; ?>" class="<?php echo $sliderClasses; ?>" style="font-size: <?php echo intval($fontsize[0]); ?>px;" data-allfontsize="<?php echo intval($fontsize[0]); ?>" data-desktopfontsize="<?php echo intval($fontsize[0]); ?>" data-tabletfontsize="<?php echo intval($fontsize[1]); ?>" data-phonefontsize="<?php echo intval($fontsize[2]); ?>">
    <div class="smart-slider-border1" style="<?php echo $backgroundimagecss . $this->_sliderParams->get('fullpageslidercss', ''); ?>">
        <div class="smart-slider-border2">
            <?php if ($flux[0]): ?>
                <div class="nextend-flux">
                    <?php foreach ($this->_slides AS $i => $slide): ?>
                        <img<?php echo $this->makeImg($slide['bg'], $i); ?> class="nextend-slide-bg"<?php if ($slide['first']) echo ' style="z-index:2;position: absolute; top: 0px; left: 0px;" '; ?>/>
                    <?php endforeach; ?>
                </div>
            <?php endif; ?>
            
            <?php
            $database = JFactory::getDbo();
$database->setQuery("SELECT * FROM #__k2_items WHERE catid=16 AND trash=0");
$list = $database->loadObjectList();

            
            
			?>
            
           
			
			
            <?php
			  $tmp1="";
			  
			 $tmp1="smart-slider-canvas smart-slider-bg-colored";
			 //$tmp2=$slide['style'];
			 $tmp2="width: 991px; height: 351px; left: -1000%; top: 0px; opacity: 1;";
			 //$tmp3=$slide['link'];
			$tmp3="/";
			 $tmp4="";
			 $tmp5="";
			 
			  ?>
			  
             <?php
			 $img_hash="";
             foreach($list as $it) { 
			 $img_hash=md5('Image'.$it->id);
			 $head_tmp=$it->title;
			 $desc_tmp=$it->introtext;
			 break;
			 }
			 ?> 
              
              
              
			 <?php foreach ($this->_slides AS $i => $slide): ?>
             <?php // $tmp1=$slide['classes']; 
			   $tmp4=$slide['slide']; $tmp5=$i;
			 
			 ?>
                <div class="<?php echo $slide['classes']; ?> smart-slider-bg-colored" style="<?php echo $slide['style']; ?> "<?php echo $slide['link']; ?> >
                    <?php if (!$this->_backend && !$flux[0] && $slide['bg']['desktop']): ?>
                        <!--<img<?php //echo $this->makeImg($slide['bg'], $i); ?> class="nextend-slide-bg"/>-->
                        <img src="<?php echo'/media/k2/items/src/'.$img_hash.'.jpg'; ?>" data-desktop="<?php echo'/media/k2/items/src/'.$img_hash.'.jpg'; ?>" class="nextend-slide-bg"/>
                        
                        <div class="layer1">
                    <div class="layer2">
                    <div class="layer3">
                    </div>
                    
                    	<span class="head"><?php  echo $head_tmp; ?></span>
                        <span class="desc"><?php
						 $abc = explode(" ", $desc_tmp);
				  $mydesc2="";
				  
				  for($i2=0; $i2<10; $i2++){$mydesc2 = $mydesc2.$abc[$i2]." ";}
				  $mydesc = $mydesc2."...";
						
						
						  echo $mydesc; ?></span>
                        
                    </div>
                    <?php
                    $link_mas=explode(" ",$it->extra_fields_search);
                    ?>
                    
                    <a href="<?php echo $link_mas[1];  ?>">БОЛЬШЕ >></a>
                    </div>
                        
                        
                        
                    <?php endif; ?>
                    <?php if ($this->_backend && strpos($slide['classes'], 'smart-slider-slide-active') !== false): ?>
                        <img src="<?php echo ($slide['bg']['desktop'] ? $slide['bg']['desktop'] : 'data:image/gif;base64,R0lGODlhAQABAIAAAAAAAP///yH5BAEAAAAALAAAAAABAAEAAAIBRAA7'); ?>" class="nextend-slide-bg"/>
                    <?php endif; ?>
                    <div class="smart-slider-canvas-inner tmp1">
                        <?php echo $items->render($slide['slide'], $i); ?>
                    </div>
                </div>
                
                <?php  break; ?>
            <?php endforeach; ?>
      
      
      
      
      

      
      
      
      
       <?php
	   $cont_tmp=0;
             foreach($list as $it) { 
			 
			 if($cont_tmp==0){
			 	$cont_tmp=1;
			 	continue;
			 }
			 
			 ?> 
            
			    <div class="<?php echo $tmp1; ?> tmp3" style="<?php echo $tmp2; ?>"<?php echo $tmp3; ?>>
                <?php $hash = md5('Image'.$it->id);  ?>
                	<img src="<?php echo'/media/k2/items/src/'.$hash.'.jpg'; ?>" data-desktop="<?php echo'/media/k2/items/src/'.$hash.'.jpg'; ?>" class="nextend-slide-bg"/>
                    
                    <div class="layer1">
                    <div class="layer2">
                    <div class="layer3">
                    </div>
                    
                    	<span class="head"><?php  echo $it->title; ?></span>
                        <span class="desc"><?php
						 $abc = explode(" ", $it->introtext);
				  $mydesc2="";
				  
				  for($i2=0; $i2<10; $i2++){$mydesc2 = $mydesc2.$abc[$i2]." ";}
				  $mydesc = $mydesc2."...";
						
						
						  echo $mydesc; ?></span>
                        
                    </div>
                    <a href="/">БОЛЬШЕ >></a>
                    </div>
                    
                    <!--<?php //if (!$this->_backend && !$flux[0] && $slide['bg']['desktop']): ?>
                        <img<?php //echo $this->makeImg($slide['bg'], $i); ?> class="nextend-slide-bg"/>
                    <?php //endif; ?>
                    <?php //if ($this->_backend && strpos($slide['classes'], 'smart-slider-slide-active') !== false): ?>
                        <img src="<?php //echo ($slide['bg']['desktop'] ? $slide['bg']['desktop'] : 'data:image/gif;base64,R0lGODlhAQABAIAAAAAAAP///yH5BAEAAAAALAAAAAABAAEAAAIBRAA7'); ?>" class="nextend-slide-bg"/>
                    <?php //endif; ?>-->
                    <div class="smart-slider-canvas-inner tmp1">
                        <?php echo $items->render($tmp4, $tmp5); ?>
                    </div>
                    
                </div>
            
            
            
            <?php
			 }
			 
			 ?>
      
      
      
      
      
      
      
      
      
      
        </div>
    </div>
    <?php
    $widgets->echoRemainder();
    ?>
</div>

<?php

$properties['type'] = 'ssFullpageSlider';
$properties['animation'] = explode('||', $this->_sliderParams->get('fullpageanimation', 'no'));

$animationproperties = NextendParse::parse($this->_sliderParams->get('fullpageanimationproperties', '1500|*|0|*|easeInOutQuint|*|0.45'));
$properties['animationSettings'] = array(
    'duration' => intval($animationproperties[0]),
    'delay' => intval($animationproperties[1]),
    'easing' => $animationproperties[2],
    'parallax' => floatval($animationproperties[3])
);

$properties['flux'] = $flux;

$properties['responsive']['maxwidth'] = intval($this->_sliderParams->get('fullpageresponsivemaxwidth', 3000));

$fullscale = NextendParse::parse($this->_sliderParams->get('fullscale', '0|*|0'));
$properties['responsive']['horizontal'] = intval($fullscale[0]);
$properties['responsive']['vertical'] = intval($fullscale[1]);

$properties['carousel'] = intval($this->_sliderParams->get('fullcarousel', 0));

$fullfocus = NextendParse::parse($this->_sliderParams->get('fullfocus', '1|*|0'));

$properties['focus'] = array(
    'user' => intval($fullfocus[0]),
    'autoplay' => intval($fullfocus[1])
);

?>
<script type="text/javascript">
    njQuery(document).ready(function () {
        njQuery('#<?php echo $id; ?>').smartslider(<?php echo json_encode($properties); ?>);
    });
</script>
<div style="clear: both;"></div>
<style type="text/css">
    .center{
    padding-top:0px !important;
    }
    
     .nivo-slider-wrapper.theme-light{
        margin-top:76px !important;
    }
    
    .ss2-align .nextend-thumbnail-strip-hider{
        height: 375px !important;
    }
    
    .ss2-align div#nextend-smart-slider-1 .smart-slider-border1{
          height: 378px !important;
    }
    
    .ss2-align div#nextend-smart-slider-1{
        height: 376px !important;
    }
    
    
    .ss2-align .smart-slider-canvas.smart-slider-bg-colored .layer1{
        top:145px !important;
    }
    .ss2-align .nextend-arrow-previous{
        top:190px !important;
    }
    
    .ss2-align .nextend-arrow-next{
        top:190px !important;
    }
</style>

<script type="text/javascript">
var $j = jQuery.noConflict();
$j("#nextend-smart-slider-1-thumbnail").bind('mousewheel', function(e){



return false;
   
});
    
</script>


