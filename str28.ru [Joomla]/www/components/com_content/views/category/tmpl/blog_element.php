<?php
/**
 * @package		Retina.Site
 * @subpackage	com_content
 * 
 * 
 */

// no direct access 2
defined('_REXEC') or die;

// Create a shortcut for params.
$params = &$this->element->params;
$images = json_decode($this->element->images);
$canEdit	= $this->element->params->get('access-edit');
JHtml::addIncludePath(RPATH_COMPONENT.'/helpers/html');
JHtml::_('behavior.tooltip');
JHtml::core();

?>

<?php if ($this->element->state == 0) : ?>
<div class="main-unpublished">
<?php endif; ?>
<?php if ($params->get('show_title')) : ?>
	<h2>
		<?php if ($params->get('link_titles') && $params->get('access-view')) : ?>
			<a href="<?php echo JRoute::_(ContentHelperRoute::getArticleRoute($this->element->slug, $this->element->catid)); ?>">
			<?php echo $this->escape($this->element->title); ?></a>
		<?php else : ?>
			<?php echo $this->escape($this->element->title); ?>
		<?php endif; ?>
	</h2>
<?php endif; ?>

<?php if ($params->get('show_print_icon') || $params->get('show_email_icon') || $canEdit) : ?>
	<ul class="actions">
		<?php if ($params->get('show_print_icon')) : ?>
		<li class="print-icon">
			<?php echo JHtml::_('icon.print_popup', $this->element, $params); ?>
		</li>
		<?php endif; ?>
		<?php if ($params->get('show_email_icon')) : ?>
		<li class="email-icon">
			<?php echo JHtml::_('icon.email', $this->element, $params); ?>
		</li>
		<?php endif; ?>
		<?php if ($canEdit) : ?>
		<li class="edit-icon">
			<?php echo JHtml::_('icon.edit', $this->element, $params); ?>
		</li>
		<?php endif; ?>
	</ul>
<?php endif; ?>

<?php if (!$params->get('show_intro')) : ?>
	<?php echo $this->element->event->afterDisplayTitle; ?>
<?php endif; ?>

<?php echo $this->element->event->beforeDisplayContent; ?>

<?php // to do not that elegant would be nice to group the params ?>

<?php if (($params->get('show_author')) or ($params->get('show_category')) or ($params->get('show_create_date')) or ($params->get('show_modify_date')) or ($params->get('show_publish_date')) or ($params->get('show_parent_category')) or ($params->get('show_hits'))) : ?>
 <dl class="article-info">
 <dt class="article-info-term"><?php echo RText::_('COM_CONTENT_ARTICLE_INFO'); ?></dt>
<?php endif; ?>
<?php if ($params->get('show_parent_category') && $this->element->parent_id != 1) : ?>
		<dd class="parent-category-name">
			<?php $title = $this->escape($this->element->parent_title);
				$url = '<a href="' . JRoute::_(ContentHelperRoute::getCategoryRoute($this->element->parent_id)) . '">' . $title . '</a>'; ?>
			<?php if ($params->get('link_parent_category')) : ?>
				<?php echo RText::sprintf('COM_CONTENT_PARENT', $url); ?>
				<?php else : ?>
				<?php echo RText::sprintf('COM_CONTENT_PARENT', $title); ?>
			<?php endif; ?>
		</dd>
<?php endif; ?>
<?php if ($params->get('show_category')) : ?>
		<dd class="category-name">
			<?php $title = $this->escape($this->element->category_title);
					$url = '<a href="' . JRoute::_(ContentHelperRoute::getCategoryRoute($this->element->catid)) . '">' . $title . '</a>'; ?>
			<?php if ($params->get('link_category')) : ?>
				<?php echo RText::sprintf('COM_CONTENT_CATEGORY', $url); ?>
				<?php else : ?>
				<?php echo RText::sprintf('COM_CONTENT_CATEGORY', $title); ?>
			<?php endif; ?>
		</dd>
<?php endif; ?>
<?php if ($params->get('show_create_date')) : ?>
		<dd class="create">
		<?php echo RText::sprintf('COM_CONTENT_CREATED_DATE_ON', JHtml::_('date', $this->element->created, RText::_('DATE_FORMAT_LC2'))); ?>
		</dd>
<?php endif; ?>
<?php if ($params->get('show_modify_date')) : ?>
		<dd class="modified">
		<?php echo RText::sprintf('COM_CONTENT_LAST_UPDATED', JHtml::_('date', $this->element->modified, RText::_('DATE_FORMAT_LC2'))); ?>
		</dd>
<?php endif; ?>
<?php if ($params->get('show_publish_date')) : ?>
		<dd class="published">
		<?php echo RText::sprintf('COM_CONTENT_PUBLISHED_DATE_ON', JHtml::_('date', $this->element->publish_up, RText::_('DATE_FORMAT_LC2'))); ?>
		</dd>
<?php endif; ?>
<?php if ($params->get('show_author') && !empty($this->element->author )) : ?>
	<dd class="createdby">
		<?php $author =  $this->element->author; ?>
		<?php $author = ($this->element->created_by_alias ? $this->element->created_by_alias : $author);?>

			<?php if (!empty($this->element->contactid ) &&  $params->get('link_author') == true):?>
				<?php 	echo RText::sprintf('COM_CONTENT_WRITTEN_BY' ,
				 JHtml::_('link', JRoute::_('index.php?option=com_contact&view=contact&id='.$this->element->contactid), $author)); ?>

			<?php else :?>
				<?php echo RText::sprintf('COM_CONTENT_WRITTEN_BY', $author); ?>
			<?php endif; ?>
	</dd>
<?php endif; ?>
<?php if ($params->get('show_hits')) : ?>
		<dd class="hits">
		<?php echo RText::sprintf('COM_CONTENT_ARTICLE_HITS', $this->element->hits); ?>
		</dd>
<?php endif; ?>
<?php if (($params->get('show_author')) or ($params->get('show_category')) or ($params->get('show_create_date')) or ($params->get('show_modify_date')) or ($params->get('show_publish_date')) or ($params->get('show_parent_category')) or ($params->get('show_hits'))) :?>
 	</dl>
<?php endif; ?>
<?php  if (isset($images->image_intro) and !empty($images->image_intro)) : ?>
	<?php $imgfloat = (empty($images->float_intro)) ? $params->get('float_intro') : $images->float_intro; ?>
	<div class="img-intro-<?php echo htmlspecialchars($imgfloat); ?>">
	<img
		<?php if ($images->image_intro_caption):
			echo 'class="caption"'.' title="' .htmlspecialchars($images->image_intro_caption) .'"';
		endif; ?>
		src="<?php echo htmlspecialchars($images->image_intro); ?>" alt="<?php echo htmlspecialchars($images->image_intro_alt); ?>"/>
	</div>
<?php endif; ?>
<?php echo $this->element->introtext; ?>

<?php if ($params->get('show_readmore') && $this->element->readmore) :
	if ($params->get('access-view')) :
		$link = JRoute::_(ContentHelperRoute::getArticleRoute($this->element->slug, $this->element->catid));
	else :
		$menu = JFactory::getApplication()->getMenu();
		$active = $menu->getActive();
		$elementId = $active->id;
		$link1 = JRoute::_('index.php?option=com_users&view=login&elementid=' . $elementId);
		$returnURL = JRoute::_(ContentHelperRoute::getArticleRoute($this->element->slug, $this->element->catid));
		$link = new JURI($link1);
		$link->setVar('return', base64_encode($returnURL));
	endif;
?>
		<p class="readmore">
				<a href="<?php echo $link; ?>">
					<?php if (!$params->get('access-view')) :
						echo RText::_('COM_CONTENT_REGISTER_TO_READ_MORE');
					elseif ($readmore = $this->element->alternative_readmore) :
						echo $readmore;
						if ($params->get('show_readmore_title', 0) != 0) :
						    echo JHtml::_('string.truncate', ($this->element->title), $params->get('readmore_limit'));
						endif;
					elseif ($params->get('show_readmore_title', 0) == 0) :
						echo RText::sprintf('COM_CONTENT_READ_MORE_TITLE');
					else :
						echo RText::_('COM_CONTENT_READ_MORE');
						echo JHtml::_('string.truncate', ($this->element->title), $params->get('readmore_limit'));
					endif; ?></a>
		</p>
<?php endif; ?>

<?php if ($this->element->state == 0) : ?>
</div>
<?php endif; ?>

<div class="element-separator"></div>
<?php echo $this->element->event->afterDisplayContent; ?>
