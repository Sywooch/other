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
<?php if (!empty($events)) { ?>
<ul class="rsepro_featured<?php echo $suffix; ?>">
	<?php foreach ($events as $eventid) { ?>
	<?php $details = rseventsproHelper::details($eventid->id); ?>
	<?php if (isset($details['event']) && !empty($details['event'])) $event = $details['event']; else continue; ?>
	<li>
		<a <?php echo $open; ?> href="<?php echo rseventsproHelper::route('index.php?option=com_rseventspro&layout=show&id='.rseventsproHelper::sef($event->id,$event->name),true,$itemid); ?>"><?php echo $event->name; ?></a> <small>(<?php echo $event->allday ? rseventsproHelper::date($event->start,rseventsproHelper::getConfig('global_date'),true) : rseventsproHelper::date($event->start,null,true); ?>)</small>
	</li>
	<?php } ?>
</ul>
<?php } ?>