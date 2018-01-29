<?php
/**
 * @package		Retina.Site
 * @subpackage	mod_syndicate
 * 
 * 
 */

// no direct access 2
defined('_REXEC') or die;
?>
<a href="<?php echo $link ?>" class="syndicate-module<?php echo $moduleclass_sfx ?>">
	<?php echo JHtml::_('image', 'main/livemarks.png', 'feed-image', NULL, true); ?>
	<?php if ($params->get('display_text', 1)) : ?>
		<span>
		<?php if (str_replace(' ', '', $text) != '') : ?>
			<?php echo $text; ?>
		<?php else : ?>
			<?php echo RText::_('MOD_SYNDICATE_DEFAULT_FEED_ENTRIES'); ?>
		<?php endif; ?>
		</span>
	<?php endif; ?>
</a>
