<?php
/**
 * @package		Joomla.Site
 * @subpackage	mod_whosonline
 * @copyright	Copyright (C) 2005 - 2012 Open Source Matters, Inc. All rights reserved.
 * @license		GNU General Public License version 2 or later; see LICENSE.txt
 */

// no direct access
defined('_JEXEC') or die;
?>

<?php if ($showmode == 0 || $showmode == 2) : ?>
	<?php $guest = JText::plural('MOD_WHOSONLINE_GUESTS', $count['guest']); ?>
	<?php $member = JText::plural('MOD_WHOSONLINE_MEMBERS', $count['user']); ?>
	<?php echo JText::sprintf('MOD_WHOSONLINE_WE_HAVE', $guest, $member); ?>
<?php endif; ?>

<?php if (($showmode > 0) && count($names)) : ?>
	<div  class="whosonline<?php echo $moduleclass_sfx ?>" >
	<?php if ($params->get('filter_groups')):?>
	<?php echo JText::_('MOD_WHOSONLINE_SAME_GROUP_MESSAGE'); ?>
	<?php endif;?>
	<?php foreach($names as $name) : ?>	
	{&nbsp;<a><?php echo $name->name;  ?></a>&nbsp;}
	<?php endforeach;  ?>
	</div>
<?php endif;
