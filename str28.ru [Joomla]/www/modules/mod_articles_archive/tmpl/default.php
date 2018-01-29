<?php
/**
 * @package		Retina.Site
 * @subpackage	mod_articles_archive
 * 
 * 
 */

// no direct access 2
defined('_REXEC') or die;
?>
<?php if (!empty($list)) :?>
	<ul class="archive-module<?php echo $moduleclass_sfx; ?>">
	<?php foreach ($list as $element) : ?>
	<li>
		<a href="<?php echo $element->link; ?>">
			<?php echo $element->text; ?>
		</a>
	</li>
	<?php endforeach; ?>
</ul>
<?php endif; ?>
