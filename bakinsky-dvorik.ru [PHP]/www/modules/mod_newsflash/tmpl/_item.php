<?php // no direct access
defined('_JEXEC') or die('Restricted access'); ?>
<div class="item">
<?php if ($params->get('item_title')) : ?>

	<?php if ($params->get('link_titles') && $item->linkOn != '') : ?>
		<a href="<?php echo $item->linkOn;?>" class="contentpagetitle<?php echo $params->get( 'moduleclass_sfx' ); ?>">
			<?php echo $item->title;?></a>
	<?php else : ?>
	<p class="title"><?php echo JHTML::_('date', $item->created, JText::_('DATE_FORMAT_LC1')); ?>	<?php echo $item->title; ?> </p>
	<?php endif; ?>

<?php endif; ?>

<?php if (!$params->get('intro_only')) :
	echo $item->afterDisplayTitle;
endif; ?>

<?php echo $item->beforeDisplayContent; ?>
<div class="intro">
<?php echo $item->text; ?>
</div>
       <?php if (isset($item->linkOn) && $item->readmore && $params->get('readmore')) :
	      echo '<p class="more"><a class="readmore" href="'.$item->linkOn.'">'.$item->linkText.'</a></p>';
        endif; ?>

</div>