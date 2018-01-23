<?php
/**
* @title		joombig slider effects with thumbnail display module
* @website		http://www.joombig.com
* @copyright	Copyright (C) 2013 joombig.com. All rights reserved.
* @license		http://www.gnu.org/licenses/gpl-2.0.html GNU/GPL
*/

    // no direct access
    defined('_JEXEC') or die;
?>
<script>
jQuery.noConflict();
</script>

<link href="<?php echo $mosConfig_live_site; ?>/modules/mod_joombig_slider_effects_with_thumbnail_display/tmpl/Slidereffectswiththumbnai/css/reset.css" media="screen" rel="stylesheet" type="text/css" />
<link href="<?php echo $mosConfig_live_site; ?>/modules/mod_joombig_slider_effects_with_thumbnail_display/tmpl/Slidereffectswiththumbnai/css/site.css" media="screen" rel="stylesheet" type="text/css" />
<link href="<?php echo $mosConfig_live_site; ?>/modules/mod_joombig_slider_effects_with_thumbnail_display/tmpl/Slidereffectswiththumbnai/css/quake.slider.css" rel="stylesheet" type="text/css" />
<link href="<?php echo $mosConfig_live_site; ?>/modules/mod_joombig_slider_effects_with_thumbnail_display/tmpl/Slidereffectswiththumbnai/css/quake.skin.css" rel="stylesheet" type="text/css" />
<?php
if (JVERSION < 3) {?>
	<script src="<?php echo $mosConfig_live_site; ?>/modules/mod_joombig_slider_effects_with_thumbnail_display/tmpl/Slidereffectswiththumbnai/js/jquery.min.js" type="text/javascript"></script>
	<script src="<?php echo $mosConfig_live_site; ?>/modules/mod_joombig_slider_effects_with_thumbnail_display/tmpl/Slidereffectswiththumbnai/js/quake.slider.js" type="text/javascript"></script>
<?php }?>
<?php
$document->addScript('modules/mod_joombig_slider_effects_with_thumbnail_display/tmpl/Slidereffectswiththumbnai/js/quake.slider.js');
$document->addScriptDeclaration('
		var  call_width, call_height;
		call_width = '.$width_module.';
		call_height = '.$height_module.';
');
?>
<script src="<?php echo $mosConfig_live_site; ?>/modules/mod_joombig_slider_effects_with_thumbnail_display/tmpl/Slidereffectswiththumbnai/js/demo.js" type="text/javascript"></script>
<script src="<?php echo $mosConfig_live_site; ?>/modules/mod_joombig_slider_effects_with_thumbnail_display/tmpl/Slidereffectswiththumbnai/js/thumbnaildisplay.js" type="text/javascript"></script>
<?php
$count_img =0;
foreach($data as $index=>$value)
{		
	$count_img++ ; 
} 
$width_quake_nav_wrapper = 22*$count_img-6;
?>
	
<?php
// add your stylesheet
$document->addStyleSheet( 'modules/mod_joombig_slider_effects_with_thumbnail_display/tmpl/Slidereffectswiththumbnai/css/site.css' );
// style declaration
$document->addStyleDeclaration( '
	.mCont
	{
		width: '.$width_module.'px;
		height: '.$height_module.'px;
	}
	.quake-slider
	{
		width: '.$width_module.'px;
		height: '.$height_module.'px;
	}
	.quake-slider-caption.vertical
	{
		width: 210px;
		height: '.$height_module.'px;
	}
	.quake-slider-caption.horizontal
	{
		width: '.$width_module.'px;
		height: 50px;
	}
	.quake-slider-caption-container.vertical
	{
		width: 220px;
		height: '.$height_module.'px;
	}
	.quake-slider-caption-container.horizontal
	{
		width: '.$width_module.'px;
		height: 50px;
	}
	.quake-dn{
		background-size:'.$width_module.'px '.$height_module.'px;
	}
	.quake-nav
	{
		width: '.($width_module+20).'px;
	}
	.quake-nav-wrapper.inside
	{
		width: '.$width_quake_nav_wrapper.'px;
	}
' );
?>

 <div id="body-wrapper">
       
        <!-- /header -->
        <div id="intro" class="interactive">
            <div class="mCont">
                <!-- Quake Image Slider -->
                <div class="quake-slider">
                    <div class="quake-slider-images">
					<?php
					$count1 =1;
					foreach($data as $index=>$value)
					{?>
                        <a target="_blank" href="javascript:">
                            <img src="<?php echo JURI::root().$value['image'] ?>" alt="" />
                        </a>
					<?php
							$count1++ ; 
					} ?>
                        </a>
                    </div>
                    <div class="quake-slider-captions">
					<?php
					$count1 =1;
					foreach($data as $index=>$value)
					{?>
                        <div class="quake-slider-caption">
                            <?php echo $value['title']?>  <a href="<?php echo $value['Link']?>"> more </a>
                        </div>
                    <?php
							$count1++ ; 
					} ?>
                    </div>
                </div>
                <!-- /Quake Image Slider -->
            </div>
        </div>
        
        
        <div class="hide_copyright"></div>
        
        
    </div>
