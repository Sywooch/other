<?php
/**
 * @package		Retina.Site
 * @subpackage	mod_articles_popular
 * 
 * 
 */

// no direct access 2
defined('_REXEC') or die;
?>
<ul class="mostread<?php echo $moduleclass_sfx; ?>">
<?php foreach ($list as $element) : ?>
	<li>
		<a href="<?php echo $element->link; ?>">
			<?php echo $element->title; ?></a>
	</li>
<?php endforeach; ?>
</ul>
