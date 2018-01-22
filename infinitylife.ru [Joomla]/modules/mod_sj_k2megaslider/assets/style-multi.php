<?php
/*------------------------------------------------------------------------
 # Sj K2 Mega Slider  - Version 1.1
 # Copyright (C) 2011 SmartAddons.Com. All Rights Reserved.
 # @license http://www.gnu.org/licenses/gpl-2.0.html GNU/GPL
 # Author: SmartAddons.Com
 # Websites: http://www.smartaddons.com/
 -------------------------------------------------------------------------*/

defined( '_JEXEC' ) or die( 'Restricted access' );
?>

<style>
    .content-box-normal-<?php echo $module->id;?>{
        background:<?php echo $bg_navication;?>;
    }
    
    .caption_opacity_theme2_<?php echo $module->id?>{
        bottom:<?php echo $thumb_height?>px;
    }
    .button_img_<?php echo $module->id?>{
        background: <?php echo $normal_background?>;
        color: <?php echo $normal_description_color?>;
    }
    .button_img_selected_<?php echo $module->id?>{
        z-index:2000;
        background: <?php echo $normal_active_background?>;
        color: <?php echo $normal_desc_active_color?>;
    }
    
    .button_img_selected_<?php echo $module->id?> .yt_post_item .yt_item_title a{
        color:<?php echo $title_active_color;?>;
        z-index:2000;
    }
    div.caption_content_<?php echo $module->id?>{
    }
    .button_img_theme5_<?php echo $module->id?>{
        color:<?php echo $normal_description_color?>;
        
    }
    .button_img_theme5_<?php echo $module->id?> .yt_post_item_<?php echo $module->id;?>{
        background: #FFFFFF;
    }
    .button_img_selected_theme5_<?php echo $module->id?>{
        color: <?php echo $normal_desc_active_color?>;
        opacity: 1;
    }
    .button_img_selected_theme5_<?php echo $module->id?> .yt_post_item_<?php echo $module->id;?>{
        background:<?php echo $bg_item_nav?>;
        
    }
    .button_img_theme5_<?php echo $module->id?> .yt_meta_img_<?php echo $theme;?>{
        display:block;
    }
    .button_img_theme5_<?php echo $module->id?> .normal-content-active{
        display:none;
    }
    <?php if($nav_style_mega == 'nav_style01'):?>
    .button_img_selected_theme5_<?php echo $module->id?> .yt_meta_img_<?php echo $theme;?>{
        display:none;
    }
    .button_img_selected_theme5_<?php echo $module->id?> .normal-content-active{
        display: block;
    }
    <?php endif;?>
    <?php if($nav_style_mega == 'nav_style03'):?>
    .normal-content-active{
        display: none;
    }
    <?php endif;?>
    .button_img_selected_theme5_<?php echo $module->id?> .yt_post_item .yt_item_title a{
        color:<?php echo $title_active_color;?>;
    }
    div.yt_post_item div.yt_item_title a {
    	color:<?php echo $title_color;?>;
    }

    div.yt_item_content div.yt_post_item {
        background: white;
        
    }
    
    div.cover_buttons_number ul.image_button_number li.button_img_theme5_<?php echo $module->id?>{
        background: url(<?php echo JURI::base().'modules/'.$module->module.'/assets/num_button.png';?>) no-repeat;
        color:#FFFFFF;
        font-weight: bold;
		padding-left: 0px;
		
    }
    div.cover_buttons_number ul.image_button_number li.button_img_selected_theme5_<?php echo $module->id?>{
        background: url(<?php echo JURI::base().'modules/'.$module->module.'/assets/num_button_active.png';?>) no-repeat;               
        color:#FFFFFF;
        font-weight: bold;
        padding-left: 0px; 
    }

</style>