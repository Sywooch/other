<?php
/**
 * @version		$Id: default.php 2012-06-20 vinaora $
 * @package		VINAORA NICE SLIDESHOW
 * @subpackage	mod_slideshow
 * @copyright	Copyright (C) 2012 VINAORA. All rights reserved.
 * 
 *
 * @website		http://vinaora.com
 * @twitter		http://twitter.com/vinaora
 * @facebook	http://facebook.com/vinaora
 * @google+		https://plus.google.com/111142324019789502653
 */

// no direct access 2
defined('_REXEC') or die;
?>


<div class="slideshow58<?php echo $moduleclass_sfx; ?>" style="margin-bottom:0px !important">
<?php if ( !empty($slider) ){ ?>
	<div id="slideshow58<?php echo $module_id;?>">
		<div class="ws_images" ><ul><?php echo $slider['images']; ?></ul></div>
<?php if( $params->get('ShowBullets')=='true' ){ ?>
		<div class="ws_bullets"><div><?php echo $slider['bullets']; ?></div></div>
<?php } ?>
<?php if( $params->get('noFrame')=='false' ){ ?>
		<a href="#" class="ws_frame"></a>
		<div class="ws_shadow"></div>
<?php } ?>
	</div><!--slideshow58-->
<?php }else{ ?>
		<div style="background-color:#ccc; color:#000; padding: 10px;"> Image Not Found </div>
<?php } ?>
</div>
<script type="text/javascript" src="<?php echo $script; ?>"></script>

