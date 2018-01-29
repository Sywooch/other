<?php

// no direct access 2
defined('_REXEC') or die;

require_once RPATH_ROOT . '/components/com_banners/helpers/banner.php';
$baseurl = JURI::base();
?>
<div class="retina-banner-div<?php echo $moduleclass_sfx ?>" 
style="border:0px black solid !important; margin-top:0px !important; margin-bottom:0px !important; padding:0 !important">
<?php if ($headerText) : ?>
	<?php echo $headerText; ?>
<?php endif; ?>


	<div class="retina-banner-element" style="border:0px black solid !important; 
	border:0px black solid !important; margin-top:0px !important; margin-bottom:0px !important; padding:0 !important; 
	background-color:transparent !important; height:120px !important">
		
		
		
		
		<div class="div-hidden-both"></div>
	</div>



</div>
