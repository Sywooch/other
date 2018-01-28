<?php
/**
 * @package		EasyBlog
 * @copyright	Copyright (C) 2010 Stack Ideas Private Limited. All rights reserved.
 * @license		GNU/GPL, see LICENSE.php
 *
 * EasyBlog is free software. This version may have been modified pursuant
 * to the GNU General Public License, and as distributed it includes or
 * is derivative of works licensed under the GNU General Public License or
 * other free or open source software licenses.
 * See COPYRIGHT.php for copyright notices and details.
 */

defined('_JEXEC') or die('Restricted access');
?>

<style>
	.ezblog-postmap .locationMap {
		width: <?php echo $params->get( 'mapwidth' ); ?>px !important;
		height: <?php echo $params->get( 'mapheight' ); ?>px !important;
	}
	.ezblog-postmap .locationMap .ebpostmap_infoWindow {
		max-width: <?php echo $params->get( 'infowidth' ); ?>px;
	}
	.ezblog-postmap .locationMap .ebpostmap_infoWindow .ebpostmap_featuredImage img {
		max-width: <?php echo $params->get( 'featuredimgwidth' ); ?>px !important;
		max-height: <?php echo $params->get( 'featuredimgheight' ); ?>px !important;
	}
</style>


<?php if( $loadedHeaders )
{
	if( !empty( $locations) )
	{
?>

<!-- Location services -->
<script type="text/javascript">
EasyBlog.require()
	.script(
		"location"
	)
	.done(function($) {
		$(".ezblog-postmap").implement(
			"EasyBlog.Controller.Location.Map",
			{
				language: "<?php echo $params->get( 'language', 'en' ); ?>",
				zoom: <?php echo $params->get( 'zoom', 15 ); ?>,
				fitBounds: <?php echo $params->get( 'fitbounds', 1 ); ?>,
				useStaticMap: false,
				disableMapsUi: <?php echo $params->get( 'mapui', 0 ) == 1 ? "false" : "true"; ?>,
				locations: <?php echo json_encode($locations); ?>
			}
		);
	});
</script>

<div class="ezb-mod ezblog-postmap<?php echo $params->get( 'moduleclass_sfx' ) ?>">
	<div class="locationMap">
	</div>
</div>
<?php
	} else {
?>
<div class="ezb-mod ezblog-postmap<?php echo $params->get( 'moduleclass_sfx' ) ?>">
	<p><?php echo JText::_( 'MOD_EASYBLOGPOSTMAP_NO_LOCATION_POST_FOUND' ); ?></p>
</div>
<?php
	}
} else { ?>
<div class="ezb-mod ezblog-postmap<?php echo $params->get( 'moduleclass_sfx' ) ?>">
	<p><?php echo JText::_( 'MOD_EASYBLOGPOSTMAP_ERROR_LOADING_HEADERS' ); ?></p>
</div>
<?php } ?>
