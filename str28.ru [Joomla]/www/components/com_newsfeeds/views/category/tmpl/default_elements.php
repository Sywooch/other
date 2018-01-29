<?php
/**
 * @package		Retina.Site
 * @subpackage	com_newsfeeds
 * 
 * 
 */

// no direct access 2
defined('_REXEC') or die;

JHtml::core();

$n			= count($this->elements);
$listOrder	= $this->escape($this->state->get('list.ordering'));
$listDirn	= $this->escape($this->state->get('list.direction'));
?>

<?php if (empty($this->elements)) : ?>
	<p> <?php echo RText::_('COM_NEWSFEEDS_NO_ARTICLES'); ?>	 </p>
<?php else : ?>

<form action="<?php echo htmlspecialchars(JFactory::getURI()->toString()); ?>" method="post" name="adminForm" id="adminForm">
	<fieldset class="filters">
	<legend class="hidelabeltxt"><?php echo RText::_('RGLOBAL_FILTER_LABEL'); ?></legend>
	<?php if ($this->params->get('show_pagination_limit')) : ?>
		<div class="display-limit">
			<?php echo RText::_('RGLOBAL_DISPLAY_NUM'); ?>&#160;
			<?php echo $this->pagination->getLimitBox(); ?>
		</div>
	<?php endif; ?>
	<input type="hidden" name="filter_order" value="<?php echo $listOrder; ?>" />
	<input type="hidden" name="filter_order_Dir" value="<?php echo $listDirn; ?>" />
	</fieldset>
	<table class="category">
		<?php if ($this->params->get('show_headings')==1) : ?>
		<thead><tr>

				<th class="element-title" id="tableOrdering">
					<?php echo JHtml::_('grid.sort', 'COM_NEWSFEEDS_FEED_NAME', 'a.name', $listDirn, $listOrder); ?>
				</th>


				<?php if ($this->params->get('show_articles')) : ?>
				<th class="element-num-art" id="tableOrdering2">
					<?php echo JHtml::_('grid.sort', 'COM_NEWSFEEDS_NUM_ARTICLES', 'a.numarticles', $listDirn, $listOrder); ?>
				</th>
				<?php endif; ?>

				<?php if ($this->params->get('show_link')) : ?>
				<th class="element-link" id="tableOrdering3">
					<?php echo JHtml::_('grid.sort', 'COM_NEWSFEEDS_FEED_LINK', 'a.link', $listDirn, $listOrder); ?>
				</th>
				<?php endif; ?>

			</tr>
		</thead>
		<?php endif; ?>

		<tbody>
			<?php foreach ($this->elements as $i => $element) : ?>
		<?php if ($this->elements[$i]->published == 0) : ?>
			<tr class="main-unpublished cat-list-row<?php echo $i % 2; ?>">
		<?php else: ?>
			<tr class="cat-list-row<?php echo $i % 2; ?>" >
		<?php endif; ?>

					<td class="element-title">
						<a href="<?php echo JRoute::_(NewsFeedsHelperRoute::getNewsfeedRoute($element->slug, $element->catid)); ?>">
							<?php echo $element->name; ?></a>
					</td>

					<?php  if ($this->params->get('show_articles')) : ?>
						<td class="element-num-art">
							<?php echo $element->numarticles; ?>
						</td>
					<?php  endif; ?>

					<?php  if ($this->params->get('show_link')) : ?>
						<td class="element-link">
							<a href="<?php echo $element->link; ?>"><?php echo $element->link; ?></a>
						</td>
					<?php  endif; ?>

				</tr>

			<?php endforeach; ?>

		</tbody>
	</table>

	<?php if ($this->params->get('show_pagination')) : ?>
	<div class="pagination">
	<?php if ($this->params->def('show_pagination_results', 1)) : ?>
		<p class="counter">
			<?php echo $this->pagination->getPagesCounter(); ?>
		</p>
	<?php endif; ?>
	<?php echo $this->pagination->getPagesLinks(); ?>
	</div>
	<?php endif; ?>

</form>
<?php endif; ?>
