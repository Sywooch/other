<?php
/**
 * @package		Retina.Site
 * @subpackage	mod_articles_news
 * 
 * 
 */

// no direct access 2
defined('_REXEC') or die;
?>
<?php if ($params->get('element_title')) : ?>

	<<?php echo $params->get('element_heading'); ?> class="newsflash-title<?php echo $params->get('moduleclass_sfx'); ?>">
	<?php if ($params->get('link_titles') && $element->link != '') : ?>
		<a href="<?php echo $element->link;?>">
			<?php echo $element->title;?></a>
	<?php else : ?>
		<?php echo $element->title; ?>
	<?php endif; ?>
	</<?php echo $params->get('element_heading'); ?>>

<?php endif; ?>

<?php if (!$params->get('intro_only')) :
	echo $element->afterDisplayTitle;
endif; ?>

<?php echo $element->beforeDisplayContent; ?>

<?php echo $element->introtext; ?>

<?php if (isset($element->link) && $element->readmore && $params->get('readmore')) :
	echo '<a class="readmore" href="'.$element->link.'">'.$element->linkText.'</a>';
endif; ?>
