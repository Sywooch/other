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

// Create shortcuts to some parameters.
$params		= $this->element->params;
$images = json_decode($this->element->images);
$urls = json_decode($this->element->urls);
$canEdit	= $this->element->params->get('access-edit');
$user		= JFactory::getUser();

?>
<div class="element-page<?php echo $this->pageclass_sfx?>">
<?php if ($this->params->get('show_page_heading', 1)) : ?>
	<h1 >
	<?php 
	if(($this->escape($this->params->get('page_heading')))=='Магазин'){echo "Главная";}
	else{
	echo $this->escape($this->params->get('page_heading'));}; ?>
	</h1>
<?php endif; ?>
<?php
if (!empty($this->element->pagination) AND $this->element->pagination && !$this->element->paginationposition && $this->element->paginationrelative)
{
 echo $this->element->pagination;
}
 ?>

<?php if ($params->get('show_title')) : ?>
	<h1 >
	<?php if ($params->get('link_titles') && !empty($this->element->readmore_link)) : ?>
		
		<span style="color:#333 !important"><?php echo $this->escape($this->element->title); ?>
		</span>
		
	<?php else : ?>
		<?php echo $this->escape($this->element->title); ?>
	<?php endif; ?>
	</h1>
<?php endif; ?>
<!---------------------------------------------------------------------------------------------->
<?php //if ($canEdit ||  $params->get('show_print_icon') || $params->get('show_email_icon')) : ?>
	<ul class="actions">
	<?php //if (!$this->print) : ?>
		<?php //if ($params->get('show_print_icon')) : ?>
			<li class="print-icon">
			<?php //echo JHtml::_('icon.print_popup',  $this->element, $params); ?>
			</li>
		<?php //endif; ?>

		<?php //if ($params->get('show_email_icon')) : ?>
			<li class="email-icon">
			<?php //echo JHtml::_('icon.email',  $this->element, $params); ?>
			</li>
		<?php //endif; ?>

		<?php //if ($canEdit) : ?>
			<li class="edit-icon">
			<?php //echo JHtml::_('icon.edit', $this->element, $params); ?>
			</li>
		<?php //endif; ?>

	<?php //else : ?>
		<li>
		<?php //echo JHtml::_('icon.print_screen',  $this->element, $params); ?>
		</li>
	<?php //endif; ?>

	</ul>
<?php //endif; ?>
<!---------------------------------------------------------------------------------------------->
<?php  if (!$params->get('show_intro')) :
	echo $this->element->event->afterDisplayTitle;
endif; ?>

<?php echo $this->element->event->beforeDisplayContent; ?>

<?php $useDefList = (($params->get('show_author')) or ($params->get('show_category')) or ($params->get('show_parent_category'))
	or ($params->get('show_create_date')) or ($params->get('show_modify_date')) or ($params->get('show_publish_date'))
	or ($params->get('show_hits'))); ?>

<?php if ($useDefList) : ?>
	<dl class="article-info">
	<dt class="article-info-term"><?php  echo RText::_('COM_CONTENT_ARTICLE_INFO'); ?></dt>
<?php endif; ?>
<?php if ($params->get('show_parent_category') && $this->element->parent_slug != '1:root') : ?>
	<dd class="parent-category-name">
	<?php	$title = $this->escape($this->element->parent_title);
	$url = '<a href="'.JRoute::_(ContentHelperRoute::getCategoryRoute($this->element->parent_slug)).'">'.$title.'</a>';?>
	<?php if ($params->get('link_parent_category') and $this->element->parent_slug) : ?>
		<?php echo RText::sprintf('COM_CONTENT_PARENT', $url); ?>
	<?php else : ?>
		<?php echo RText::sprintf('COM_CONTENT_PARENT', $title); ?>
	<?php endif; ?>
	</dd>
<?php endif; ?>
<?php if ($params->get('show_category')) : ?>
	<dd class="category-name">
	<?php 	$title = $this->escape($this->element->category_title);
	$url = '<a href="'.JRoute::_(ContentHelperRoute::getCategoryRoute($this->element->catslug)).'">'.$title.'</a>';?>
	<?php if ($params->get('link_category') and $this->element->catslug) : ?>
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
<!--	<dd class="published" >
	<?php //echo RText::sprintf('COM_CONTENT_PUBLISHED_DATE_ON', JHtml::_('date', $this->element->publish_up, RText::_('DATE_FORMAT_LC2'))); ?>
	</dd>-->
<?php endif; ?>

<?php //if ($params->get('show_author') && !empty($this->element->author )) : ?>
<!--	<dd class="createdby">
	<?php// $author = $this->element->created_by_alias ? $this->element->created_by_alias : $this->element->author; ?>
	<?php //if (!empty($this->element->contactid) && $params->get('link_author') == true): ?>
	<?php
		//$needle = 'index.php?option=com_contact&view=contact&id=' . $this->element->contactid;
		//$element = JSite::getMenu()->getelements('link', $needle, true);
		//$cntlink = !empty($element) ? $needle . '&elementid=' . $element->id : $needle;
	?>
		<?php //echo RText::sprintf('COM_CONTENT_WRITTEN_BY', JHtml::_('link', JRoute::_($cntlink), $author)); ?>
	<?php //else: ?>
		<?php //echo RText::sprintf('COM_CONTENT_WRITTEN_BY', $author); ?>
	<?php //endif; ?>
	</dd>-->
<?php //endif; ?>



<?php //if ($params->get('show_hits')) : ?>
	<!--<dd class="hits">
	<?php //echo RText::sprintf('COM_CONTENT_ARTICLE_HITS', $this->element->hits); ?>
	</dd>-->
<?php //endif; ?>



<?php if ($useDefList) : ?>
	</dl>
<?php endif; ?>

<?php if (isset ($this->element->toc)) : ?>
	<?php echo $this->element->toc; ?>
<?php endif; ?>

<?php if (isset($urls) AND ((!empty($urls->urls_position) AND ($urls->urls_position=='0')) OR  ($params->get('urls_position')=='0' AND empty($urls->urls_position) ))
		OR (empty($urls->urls_position) AND (!$params->get('urls_position')))): ?>
<?php echo $this->loadTemplate('links'); ?>
<?php endif; ?>

<?php if ($params->get('access-view')):?>
<?php  if (isset($images->image_fulltext) and !empty($images->image_fulltext)) : ?>
<?php $imgfloat = (empty($images->float_fulltext)) ? $params->get('float_fulltext') : $images->float_fulltext; ?>
<div class="img-fulltext-<?php echo htmlspecialchars($imgfloat); ?>">
<img
	<?php if ($images->image_fulltext_caption):
		echo 'class="caption"'.' title="' .htmlspecialchars($images->image_fulltext_caption) .'"';
	endif; ?>
	src="<?php echo htmlspecialchars($images->image_fulltext); ?>" alt="<?php echo htmlspecialchars($images->image_fulltext_alt); ?>"/>
</div>
<?php endif; ?>
<?php
if (!empty($this->element->pagination) AND $this->element->pagination AND !$this->element->paginationposition AND !$this->element->paginationrelative):
	echo $this->element->pagination;
 endif;
?>
<?php echo $this->element->text; ?>
<?php
if (!empty($this->element->pagination) AND $this->element->pagination AND $this->element->paginationposition AND!$this->element->paginationrelative):
	 echo $this->element->pagination;?>
<?php endif; ?>

<?php if (isset($urls) AND ((!empty($urls->urls_position)  AND ($urls->urls_position=='1')) OR ( $params->get('urls_position')=='1') )): ?>
<?php echo $this->loadTemplate('links'); ?>
<?php endif; ?>
	<?php //optional teaser intro text for guests ?>
<?php elseif ($params->get('show_noauth') == true and  $user->get('guest') ) : ?>
	<?php echo $this->element->introtext; ?>
	<?php //Optional link to let them register to see the whole article. ?>
	<?php if ($params->get('show_readmore') && $this->element->fulltext != null) :
		$link1 = JRoute::_('index.php?option=com_users&view=login');
		$link = new JURI($link1);?>
		<p class="readmore">
		<a href="<?php echo $link; ?>">
		<?php $attribs = json_decode($this->element->attribs);  ?>
		<?php
		if ($attribs->alternative_readmore == null) :
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
<?php endif; ?>
<?php
if (!empty($this->element->pagination) AND $this->element->pagination AND $this->element->paginationposition AND $this->element->paginationrelative):
	 echo $this->element->pagination;?>
<?php endif; ?>

<?php echo $this->element->event->afterDisplayContent; ?>
</div>
