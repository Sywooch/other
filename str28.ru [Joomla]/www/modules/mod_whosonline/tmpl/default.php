<?php
/**
 * @package		Retina.Site
 * @subpackage	mod_whosonline
 * 
 * 
 */

// no direct access 2
defined('_REXEC') or die;
?>

<?php if ($showmode == 0 || $showmode == 2) : ?>
	<?php $guest = RText::plural('MOD_WHOSONLINE_GUESTS', $count['guest']); ?>
	<?php $member = RText::plural('MOD_WHOSONLINE_MEMBERS', $count['user']); ?>
	<p><?php echo RText::sprintf('MOD_WHOSONLINE_WE_HAVE', $guest, $member); ?></p>
<?php endif; ?>

<?php if (($showmode > 0) && count($names)) : ?>
	<ul  class="whosonline<?php echo $moduleclass_sfx ?>" >
	<?php if ($params->get('filter_groups')):?>
		<p><?php echo RText::_('MOD_WHOSONLINE_SAME_GROUP_MESSAGE'); ?></p>
	<?php endif;?>
	<?php foreach($names as $name) : ?>
		<li>
			<?php echo $name->username; ?>
		</li>
	<?php endforeach;  ?>
	</ul>
<?php endif;
