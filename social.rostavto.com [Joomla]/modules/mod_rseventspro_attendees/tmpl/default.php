<?php
/**
* @version 1.0.0
* @package RSEvents!Pro 1.0.0
* @copyright (C) 2012 www.rsjoomla.com
* @license GPL, http://www.gnu.org/copyleft/gpl.html
*/

// no direct access
defined('_JEXEC') or die('Restricted access'); ?>

<?php if (!empty($guests)) { ?>
<ul class="rsepro_attendees<?php echo $suffix; ?>">
<?php foreach ($guests as $guest) { ?>
	<li>
		<?php if (!empty($guest->url)) { ?><a href="<?php echo $guest->url; ?>"><?php } ?>
		<?php echo $guest->avatar; ?>
		<?php echo $guest->name; ?>
		<?php if (!empty($guest->url)) { ?></a><?php } ?>
	</li>
<?php } ?>
</ul>
<span class="attendees_clear"></span>
<?php } ?>