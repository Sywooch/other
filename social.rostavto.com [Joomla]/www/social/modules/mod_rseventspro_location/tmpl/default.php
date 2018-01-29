<?php
/**
* @version 1.0.0
* @package RSEvents!Pro 1.0.0
* @copyright (C) 2012 www.rsjoomla.com
* @license GPL, http://www.gnu.org/copyleft/gpl.html
*/

// no direct access
defined('_JEXEC') or die('Restricted access'); ?>

<?php if (!empty($location)) { ?>
<div class="rsepro_location_list<?php echo $suffix; ?>">
	<?php if ($map && !empty($location->coordinates)) { ?>
	<div class="rsepro_location_map">
		<a href="<?php echo rseventsproHelper::route('index.php?option=com_rseventspro&layout=location&id='.rseventsproHelper::sef($location->id,$location->name),true,$itemid); ?>">
			<img src="http://maps.google.com/maps/api/staticmap?zoom=<?php echo $zoom; ?>&size=<?php echo $width; ?>x<?php echo $height; ?>&markers=<?php echo $location->coordinates; ?>&sensor=false" alt="" />
		</a>
	</div>
	<?php } ?>
	<?php if ($address) { ?>
	<div class="rsepro_location_address">
		<span id="rsepro_location_name">
			<a href="<?php echo rseventsproHelper::route('index.php?option=com_rseventspro&layout=location&id='.rseventsproHelper::sef($location->id,$location->name),true,$itemid); ?>">
				<?php echo $location->name; ?>
			</a>
		</span>
		<span><?php echo $location->address; ?></span>
	</div>
	<?php } ?>
	<?php if ($url && !empty($location->url)) { ?>
	<a href="<?php echo $location->url; ?>"><?php echo $location->url; ?></a>
	<?php } ?>
</div>
<?php } ?>