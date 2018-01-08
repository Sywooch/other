<?php // no direct access
defined('_JEXEC') or die('Restricted access'); ?>
<script language="javascript" type="text/javascript">

	function tableOrdering( order, dir, task )
	{
		var form = document.adminForm;

		form.filter_order.value 	= order;
		form.filter_order_Dir.value	= dir;
		document.adminForm.submit( task );
	}
</script>
<div id="list_item">
<form action="<?php echo $this->action; ?>" method="post" name="adminForm">
<?php if ($this->params->get('filter') || $this->params->get('show_pagination_limit')) : ?>
		<?php if ($this->params->get('filter')) : ?>
		<?php endif; ?>
		<?php if ($this->params->get('show_pagination_limit')) : ?>
			<?php
				echo '<h4>'.JText::_('Показывать по:');
				echo $this->pagination->getLimitBox();
				echo '</h4>';
			?>
		<?php endif; ?>
<?php endif; ?>
<?php if ($this->params->get('show_headings')) : ?>

		

	<?php if ($this->params->get('show_date')) : ?>

	<?php endif; ?>
	<?php if ($this->params->get('show_author')) : ?>
		<?php echo JHTML::_('grid.sort',  'Author', 'author', $this->lists['order_Dir'], $this->lists['order'] ); ?>
	<?php endif; ?>
	<?php if ($this->params->get('show_hits')) : ?>
		<?php echo JHTML::_('grid.sort',  'Hits', 'a.hits', $this->lists['order_Dir'], $this->lists['order'] ); ?>
	<?php endif; ?>
<?php endif; ?>
<?php foreach ($this->items as $item) : ?>
	<?php if ($this->params->get('show_title')) : ?>
	<?php if ($item->access <= $this->user->get('aid', 0)) : ?>
		<p><a href="<?php echo $item->link; ?>">
			<?php echo $item->title; ?></a></p>
			<?php $this->item = $item; echo JHTML::_('icon.edit', $item, $this->params, $this->access) ?>
	<?php else : ?>
		<?php
			echo $this->escape($item->title).' : ';
			$link = JRoute::_('index.php?option=com_user&task=register');
		?>
		<a href="<?php echo $link; ?>">
			<?php echo JText::_( 'Register to read more...' ); ?></a>
	<?php endif; ?>
	<?php endif; ?>
	<?php if ($this->params->get('show_date')) : ?>
		<?php echo $item->created; ?>
	<?php endif; ?>
	<?php if ($this->params->get('show_author')) : ?>
		<?php echo $item->created_by_alias ? $item->created_by_alias : $item->author; ?>
	<?php endif; ?>
	<?php if ($this->params->get('show_hits')) : ?>
		<?php echo $item->hits ? $item->hits : '-'; ?>
	<?php endif; ?>
<?php endforeach; ?>
<?php if ($this->params->get('show_pagination')) : ?>
	<div id="list">
		<?php echo $this->pagination->getPagesLinks(); ?>
</div>
	
		<?php //echo $this->pagination->getPagesCounter(); ?>
		
<?php endif; ?>

<input type="hidden" name="id" value="<?php echo $this->category->id; ?>" />
<input type="hidden" name="sectionid" value="<?php echo $this->category->sectionid; ?>" />
<input type="hidden" name="task" value="<?php echo $this->lists['task']; ?>" />
<input type="hidden" name="filter_order" value="<?php echo $this->lists['order']; ?>" />
<input type="hidden" name="filter_order_Dir" value="" />
</form>
</div>