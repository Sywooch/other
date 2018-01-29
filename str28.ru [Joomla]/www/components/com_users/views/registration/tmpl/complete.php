<?php
/**
 * @package		Retina.Site
 * @subpackage	com_users
 * 
 * 
 * @since		1.6
 */

defined('_REXEC') or die;
?>
<div class="registration-complete<?php echo $this->pageclass_sfx;?>">
	<?php if ($this->params->get('show_page_heading')) : ?>
	<h1>
		<?php echo $this->escape($this->params->get('page_heading')); ?>
	</h1>
	<?php endif; ?>
</div>
