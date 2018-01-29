<?php
/**
 * @package		Retina.Site
 * @subpackage	com_content
 * 
 * 
 */

// no direct access 2
defined('_REXEC') or die;
?>
<h3><?php echo RText::_('COM_CONTENT_MORE_ARTICLES'); ?></h3>

<ol>
<?php foreach ($this->link_elements as &$element) : ?>
	<li>
		<a href="<?php echo JRoute::_(ContentHelperRoute::getArticleRoute($element->slug, $element->catslug)); ?>">
			<?php echo $element->title; ?></a>
	</li>
<?php endforeach; ?>
</ol>
