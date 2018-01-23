<?php 
/*
# ------------------------------------------------------------------------
# TCVN Highslide Module for Joomla 2.5
# ------------------------------------------------------------------------
# Copyright(C) 2008-2012 www.Thecoders.vn. All Rights Reserved.
# @license http://www.gnu.org/licenseses/gpl-3.0.html GNU/GPL
# Author: Thecoders.vn
# Websites: http://Thecoders.com
# ------------------------------------------------------------------------
*/
// no direct access
defined('_JEXEC') or die;

$id = "'highslide-html-" . $module->id . "'";
?>
<script type="text/javascript" > 
hs.addSlideshow({
	slideshowGroup: '<?php echo $module->id; ?>',
	interval: <?php echo $interval; ?>,
	repeat: <?php echo $repeat==1?'true':'false'; ?>,
	useControls: true,
	fixedControls: 'fit',
	overlayOptions: {
		className: 'text-controls',
		opacity: '0.95',
		position: 'bottom center',
		offsetX: '0',
		offsetY: '-60',
		relativeTo: 'viewport',
		hideOnMouseOut: false
	},
	thumbstrip: {
		mode: 'horizontal',
		position: 'bottom center',
		relativeTo: 'viewport'
	}
}); 
</script>
<div class="highslide-gallery">
	<ul>
	<?php
    foreach($list as $i=>$item):
        $target = ' target="'.$item->target_open.'"';
        $showLink = isset($item->show_link)?$item->show_link:0;
        $item->id = $module->id;
        if($showLink && isset($item->link)){
            $subtitle = '<a href="'.$item->link.'"'.$target.'>'.$item->subtitle.'</a>';
        }else{
            $subtitle = $item->subtitle;
        }
        $highslide = modTCVNHighSlideHelper::getHighSlideAttr( "gallery-caption".$module->id."-".$i, $module->id, $item, $params, $overrideAttr );
    
    ?>
		<li><a  id="thumbnail_<?php echo $module->id."_".$i; ?>" href="<?php echo $item->mainImage; ?>" style="padding-right:5px;" class="highslide" onclick="return <?php echo $highslide;?>">
		 <?php if($item->showThumb): ?>
			<img src="<?php echo $item->thumbnail; ?>" alt="<?php echo $item->subtitle; ?>" title="<?php echo JText::_("Click to enlarge"); ?>"<?php echo $widthHeight;?>/>
			<?php else: 
			echo $item->subtitle;
			endif; ?>
		</a>
		<div class="gallery-caption-<?php echo $module->id."-".$i;?>" style="display:none">
			<?php echo $subtitle; ?>
		</div>
		</li>
	<?php
    endforeach;
    ?>
	</ul>
	<div style="clear:both"></div>
</div>