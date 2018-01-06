<?php
/**
 * @version		$Id$
 * @author		Joomlaites
 * @package		Joomlaites
 * @subpackage	mod_jimagerotator
 * @copyright	Copyright (C) 2015 Joomlaites. All rights reserved.
 * @license		License GNU General Public License version 2 or later; see LICENSE.txt, see LICENSE.php
 */
// no direct access
defined('_JEXEC') or die('Restricted access');

?>
<style>
.bx-image-viewport{ padding:20px 0px; }
.autorun{display:<?php if ($autorun == 'no' ){echo 'none';} ?>;}
.bx-image-controls-direction{display:<?php if ($arrow_button == 'no' ){echo 'none';} ?>;}
.bx-default-pager{display:<?php if ($camera_pag == 'no' ){echo 'none';} ?>;}
.bx-image-viewport{padding:<?php echo $params->get('bx_image_container_padding') ?>;margin:<?php echo $params->get('bx_image_container_margin') ?>;background:<?php echo $params->get('bx_image_container_background') ?>;box-shadow:0px 0px <?php echo $params->get('bx_image_container_shadow_color') ?> <?php echo $params->get('bx_image_container_shadow_color') ?>;}
.cap-img_<?php echo $module->id; ?>{padding:<?php echo $params->get('sliderboxpadding') ?>;border-left:<?php echo $params->get('borderleftstyle') ?> <?php echo $params->get('borderleftweight') ?> <?php echo $params->get('borderleftcolor') ?>;border-right:<?php echo $params->get('borderrightstyle') ?> <?php echo $params->get('borderrightweight') ?> <?php echo $params->get('borderrightcolor') ?>;}
.bx-image-wrapper{ width:100% !important; max-width:<?php echo $params->get('maincontainerwidth') ?>% !important;}
.jml-bxslider_<?php echo $module->id; ?>{margin:<?php echo $params->get('img_margin') ?>; background:<?php echo $params->get('img_background') ?>;
box-shadow:<?php echo $params->get('img_shadow_size') ?> <?php echo $params->get('img_shadow') ?>;}
.bx-image-wrapper .bx-prev_<?php echo $module->id; ?> {left:10px;background: url(../elements/controls.png) no-repeat 0 -32px;}
.bx-image-wrapper .bx-image-next_<?php echo $module->id; ?> {right:20px;background: url(../elements/controls.png) no-repeat -43px -32px;}
</style>

<div class="image-bxslider_<?php echo $module->id; ?>">
<?php 
 $lists = json_decode($images);
foreach ($lists as $list){ ?> 
    <span class="jml-bxslider_<?php echo $module->id; ?>"><a href="<?php echo $list->link; ?>"/><img src="<?php echo $list->imagesrc; ?>" height="<?php echo $sliderboxheight ?>" class="cap-img_<?php echo $module->id; ?>"/></a>
    
    <div class="v_test_cus" style="padding:<?php echo $sliderboxpadding; ?>;">
        <h3><?php echo $list->title; ?></h3>
       <p> <?php echo $list->description; ?></p>
    </div>
    </span>
<?php } ?>
</div>

<script>

var $j=jQuery.noConflict();
            $j(document).ready(function(){
            $j('.image-bxslider_<?php echo $module->id; ?>').image_bxSlider({
                slideWidth: <?php echo $sliderboxwidth; ?>,
                minSlides: 0,
                maxSlides: <?php echo $numberboxshow; ?>,
           });
           var autorun = '<?php echo $autorun ?>';
		
           if( autorun == 'yes' ){
           setInterval(function(){ 
           $j(".bx-image-next").click();
           },5000);
           }

          });
</script>