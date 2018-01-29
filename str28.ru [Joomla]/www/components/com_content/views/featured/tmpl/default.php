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

// If the page class is defined, add to class as suffix.
// It will be a separate class if the user starts it with a space
?>
<div class="blog-featured<?php echo $this->pageclass_sfx;?>">
<?php if ( $this->params->get('show_page_heading')!=0) : ?>
	<h1>
	<?php echo $this->escape($this->params->get('page_heading')); ?>
	</h1>
<?php endif; ?>

<?php $leadingcount=0 ; ?>
<?php if (!empty($this->lead_elements)) : ?>
<div class="elements-leading">
	<?php foreach ($this->lead_elements as &$element) : ?>
		<div class="leading-<?php echo $leadingcount; ?><?php echo $element->state == 0 ? ' main-unpublished' : null; ?>">
			<?php
				$this->element = &$element;
				echo $this->loadTemplate('element');
			?>
		</div>
		<?php
			$leadingcount++;
		?>
	<?php endforeach; ?>
</div>
<?php endif; ?>
<?php
	$introcount=(count($this->intro_elements));
	$counter=0;
?>
<?php if (!empty($this->intro_elements)) : ?>
	<?php foreach ($this->intro_elements as $key => &$element) : ?>

	<?php
		$key= ($key-$leadingcount)+1;
		$rowcount=( ((int)$key-1) %	(int) $this->columns) +1;
		$row = $counter / $this->columns ;

		if ($rowcount==1) : ?>

			<div class="elements-row cols-<?php echo (int) $this->columns;?> <?php echo 'row-'.$row ; ?>">
		<?php endif; ?>
		<div class="element column-<?php echo $rowcount;?><?php echo $element->state == 0 ? ' main-unpublished"' : null; ?>">
			<?php
					$this->element = &$element;
					echo $this->loadTemplate('element');
			?>
		</div>
		<?php $counter++; ?>
			<?php if (($rowcount == $this->columns) or ($counter ==$introcount)): ?>
				<span class="row-separator"></span>
				</div>

			<?php endif; ?>
	<?php endforeach; ?>
<?php endif; ?>

<?php if (!empty($this->link_elements)) : ?>
	<div class="elements-more">
	<?php echo $this->loadTemplate('links'); ?>
	</div>
<?php endif; ?>

<?php if ($this->params->def('show_pagination', 2) == 1  || ($this->params->get('show_pagination') == 2 && $this->pagination->get('pages.total') > 1)) : ?>
	<div class="pagination">

		<?php if ($this->params->def('show_pagination_results', 1)) : ?>
			<p class="counter">
				<?php echo $this->pagination->getPagesCounter(); ?>
			</p>
		<?php  endif; ?>
				<?php echo $this->pagination->getPagesLinks(); ?>
	</div>
<?php endif; ?>

</div>
