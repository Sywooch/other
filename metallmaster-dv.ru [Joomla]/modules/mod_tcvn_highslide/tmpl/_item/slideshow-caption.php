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

$id_number = "highslide_".$module->id;
?>
<div>
<?php
	foreach($list as $i => $item) {
		$target 	= isset($item->target_open) ? ' target="' . $item->target_open . '"' : "";
		$showLink 	= isset($item->show_link) ? $item->show_link:0;
		$item->id 	= $module->id;
		
		if($showLink && isset($item->link)) {
			$subtitle = '<a href="'.$item->link.'"'.$target.'>'.$item->title.'</a>';
		}
		else {
			$subtitle = $item->title;
		}
		$highslide = modTCVNHighSlideHelper::getHighSlideAttr($id_number."_".$i, $id_number, $item, $params, $overrideAttr);
	?>
        <a id="thumbnail_<?php echo $module->id."_".$i; ?>" href="<?php echo $item->mainImage; ?>" style="padding-right:5px;" class="highslide" onclick="return <?php echo $highslide; ?>" title="<?php echo $item->title; ?>">
        <?php if(isset($item->showThumb)): ?>
        	<img src="<?php echo $item->thumbnail;?>" alt="<?php echo $item->subtitle; ?>" title="<?php echo JText::_('Click to enlarge'); ?>"<?php echo $widthHeight; ?>/>
        <?php else: echo $item->title; endif; ?>
        </a>
        <div class="highslide-caption <?php echo $control_type=="icon"?"caption-icon":""; ?>" id="<?php echo $id_number."_".$i; ?>">
            <div class="highslide-body"></div>
            <div class="tcvn-highslide-caption">
            	<?php echo $subtitle; ?>
            </div>
            <a href="#" id="tcvn_prev" onclick="return hs.previous(this); return false;" class="control" style="float:left; display: block">
                <?php echo JText::_("Назад"); ?>
            </a>
            <a href="#" id="tcvn_next" onclick="return hs.next(this); return false;" class="control" style="float:left; display: block; text-align: right; margin-left: 50px">
                <?php echo JText::_("Вперед"); ?>
            </a>
			<?php
                if($showClose == "1"){ 
                ?>
                <a href="#" id="tcvn_close" onclick="return hs.close(this); return false;" class="control"><?php echo JText::_("Зарыть"); ?></a>
            <?php
                }	
                if($showMove == "1") {
            ?>
                <a href="#" id="tcvn_move" onclick="return false" class="highslide-move control"><?php echo JText::_("Переместить"); ?></a>
                <?php 
                }		
            ?>
			<div style="clear:both"> </div>
		</div>
	<?php
	}
?>
</div>