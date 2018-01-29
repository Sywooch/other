<?php
/**
* @version 1.0.0
* @package RSEvents!Pro 1.0.0
* @copyright (C) 2012 www.rsjoomla.com
* @license GPL, http://www.gnu.org/copyleft/gpl.html
*/

// no direct access
defined('_JEXEC') or die('Restricted access'); ?>

<?php $open = !$links ? 'target="_blank"' : ''; ?>
<?php if (!empty($locations)) { ?>
<ul class="rsepro_locations<?php echo $suffix; ?>">
<?php foreach ($locations as $location) { ?>
	<li>
		<a <?php echo $open; ?> href="<?php echo rseventsproHelper::route('index.php?option=com_rseventspro&location='.rseventsproHelper::sef($location->id,$location->name),true,$itemid); ?>"><?php echo $location->name; ?></a>
	</li>
<?php } ?>
</ul>
<?php } ?>