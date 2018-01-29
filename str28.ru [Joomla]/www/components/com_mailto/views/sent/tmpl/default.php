<?php
/**
 * @package		Retina.Site
 * @subpackage	com_mailto
 * 
 * 
 */

// no direct access 2
defined('_REXEC') or die;
?>
<div style="padding: 10px;">
	<div style="text-align:right">
		<a href="javascript: void window.close()">
			<?php echo RText::_('COM_MAILTO_CLOSE_WINDOW'); ?> <?php echo JHtml::_('image', 'mailto/close-x.png', NULL, NULL, true); ?></a>
	</div>

	<h2>
		<?php echo RText::_('COM_MAILTO_EMAIL_SENT'); ?>
	</h2>
</div>
