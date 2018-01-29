<?php
/**
 * @package		Retina.Site
 * @subpackage	com_content
 * 
 * 
 */

// no direct access 2
defined('_REXEC') or die;

JHtml::addIncludePath(RPATH_COMPONENT . '/helpers');
$params = &$this->params;
?>

<ul id="archive-elements">
<?php foreach ($this->elements as $i => $element) : ?>
	<li class="row<?php echo $i % 2; ?>">

		<h2>
		<?php if ($params->get('link_titles')): ?>
			<a href="<?php echo JRoute::_(ContentHelperRoute::getArticleRoute($element->slug, $element->catslug)); ?>">
				<?php echo $this->escape($element->title); ?></a>
		<?php else: ?>
				<?php echo $this->escape($element->title); ?>
		<?php endif; ?>
		</h2>

<?php if (($params->get('show_author')) or ($params->get('show_parent_category')) or ($params->get('show_category')) or ($params->get('show_create_date')) or ($params->get('show_modify_date')) or ($params->get('show_publish_date'))  or ($params->get('show_hits'))) : ?>
<dl class="article-info">
<dt class="article-info-term"><?php echo RText::_('COM_CONTENT_ARTICLE_INFO'); ?></dt>
<?php endif; ?>
<?php if ($params->get('show_parent_category')) : ?>
		<dd class="parent-category-name">
			<?php	$title = $this->escape($element->parent_title);
					$url = '<a href="'.JRoute::_(ContentHelperRoute::getCategoryRoute($element->parent_slug)).'">'.$title.'</a>';?>
			<?php if ($params->get('link_parent_category') && $element->parent_slug) : ?>
				<?php echo RText::sprintf('COM_CONTENT_PARENT', $url); ?>
				<?php else : ?>
				<?php echo RText::sprintf('COM_CONTENT_PARENT', $title); ?>
			<?php endif; ?>
		</dd>
<?php endif; ?>

<?php if ($params->get('show_category')) : ?>
		<dd class="category-name">
			<?php	$title = $this->escape($element->category_title);
					$url = '<a href="' . JRoute::_(ContentHelperRoute::getCategoryRoute($element->catslug)) . '">' . $title . '</a>'; ?>
			<?php if ($params->get('link_category') && $element->catslug) : ?>
				<?php echo RText::sprintf('COM_CONTENT_CATEGORY', $url); ?>
				<?php else : ?>
				<?php echo RText::sprintf('COM_CONTENT_CATEGORY', $title); ?>
			<?php endif; ?>
		</dd>
<?php endif; ?>
<?php if ($params->get('show_create_date')) : ?>
		<dd class="create">
		<?php echo RText::sprintf('COM_CONTENT_CREATED_DATE_ON', JHtml::_('date', $element->created, RText::_('DATE_FORMAT_LC2'))); ?>
		</dd>
<?php endif; ?>
<?php if ($params->get('show_modify_date')) : ?>
		<dd class="modified">
		<?php echo RText::sprintf('COM_CONTENT_LAST_UPDATED', JHtml::_('date', $element->modified, RText::_('DATE_FORMAT_LC2'))); ?>
		</dd>
<?php endif; ?>
<?php if ($params->get('show_publish_date')) : ?>
		<dd class="published">
		<?php echo RText::sprintf('COM_CONTENT_PUBLISHED_DATE_ON', JHtml::_('date', $element->publish_up, RText::_('DATE_FORMAT_LC2'))); ?>
		</dd>
<?php endif; ?>
<?php if ($params->get('show_author') && !empty($element->author )) : ?>
	<dd class="createdby">
		<?php $author =  $element->author; ?>
		<?php $author = ($element->created_by_alias ? $element->created_by_alias : $author);?>

			<?php if (!empty($element->contactid ) &&  $params->get('link_author') == true):?>
				<?php 	echo RText::sprintf('COM_CONTENT_WRITTEN_BY' ,
				 JHtml::_('link', JRoute::_('index.php?option=com_contact&view=contact&id='.$element->contactid), $author)); ?>

			<?php else :?>
				<?php echo RText::sprintf('COM_CONTENT_WRITTEN_BY', $author); ?>
			<?php endif; ?>
	</dd>
<?php endif; ?>
<?php if ($params->get('show_hits')) : ?>
		<dd class="hits">
		<?php echo RText::sprintf('COM_CONTENT_ARTICLE_HITS', $element->hits); ?>
		</dd>
<?php endif; ?>
<?php if (($params->get('show_author')) or ($params->get('show_category')) or ($params->get('show_create_date')) or ($params->get('show_modify_date')) or ($params->get('show_publish_date'))  or ($params->get('show_hits'))) :?>
	</dl>
<?php endif; ?>

<?php if ($params->get('show_intro')) :?>
	<div class="intro">
		<?php echo JHtml::_('string.truncate', $element->introtext, $params->get('introtext_limit')); ?>
	</div>
<?php endif; ?>
	</li>
<?php endforeach; ?>
</ul>

<div class="pagination">
	<p class="counter">
		<?php echo $this->pagination->getPagesCounter(); ?>
	</p>
	<?php echo $this->pagination->getPagesLinks(); ?>
</div>
