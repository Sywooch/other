<?php

/**
 * @package		Retina.Site
 * @subpackage	com_content
 * 
 * 
 */

// no direct access 2
defined('_REXEC') or die;
$class = ' class="first"';
if (count($this->elements[$this->parent->id]) > 0 && $this->maxLevelcat != 0) :
?>
<ul>
<?php foreach($this->elements[$this->parent->id] as $id => $element) : ?>
	<?php
	if ($this->params->get('show_empty_categories_cat') || $element->numelements || count($element->getChildren())) :
	if (!isset($this->elements[$this->parent->id][$id + 1]))
	{
		$class = ' class="last"';
	}
	?>
	<li<?php echo $class; ?>>
	<?php $class = ''; ?>
		<span class="element-title"><a href="<?php echo JRoute::_(ContentHelperRoute::getCategoryRoute($element->id));?>">
			<?php echo $this->escape($element->title); ?></a>
		</span>
		<?php if ($this->params->get('show_subcat_desc_cat') == 1) :?>
		<?php if ($element->description) : ?>
			<div class="category-desc">
				<?php echo JHtml::_('content.prepare', $element->description, '', 'com_content.categories'); ?>
			</div>
		<?php endif; ?>
        <?php endif; ?>
		<?php if ($this->params->get('show_cat_num_articles_cat') == 1) :?>
			<dl><dt>
				<?php echo RText::_('COM_CONTENT_NUM_elementS'); ?></dt>
				<dd><?php echo $element->numelements; ?></dd>
			</dl>
		<?php endif; ?>

		<?php if (count($element->getChildren()) > 0) :
			$this->elements[$element->id] = $element->getChildren();
			$this->parent = $element;
			$this->maxLevelcat--;
			echo $this->loadTemplate('elements');
			$this->parent = $element->getParent();
			$this->maxLevelcat++;
		endif; ?>

	</li>
	<?php endif; ?>
<?php endforeach; ?>
</ul>
<?php endif; ?>
