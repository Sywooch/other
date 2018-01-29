<?php
/**
 * @package		Retina.Site
 * @subpackage	mod_random_image
 * 
 * 
 */

// no direct access 2
defined('_REXEC') or die;
?>
<div class="random-image<?php echo $moduleclass_sfx ?>">
<?php if ($link) : ?>
<a href="<?php echo $link; ?>">
<?php endif; ?>
	<?php echo JHtml::_('image', $image->folder.'/'.$image->name, $image->name, array('width' => $image->width, 'height' => $image->height)); ?>
<?php if ($link) : ?>
</a>
<?php endif; ?>
</div>
