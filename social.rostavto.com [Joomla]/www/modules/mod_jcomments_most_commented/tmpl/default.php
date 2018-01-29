<?php
// no direct access
defined('_JEXEC') or die;
?>
<?php if (!empty($list)) :?>
<ul class="jcomments-most-commented<?php echo $params->get('moduleclass_sfx'); ?>">
	<?php foreach ($list as $item) : ?>
	<li>
		<a href="<?php echo $item->link; ?>">
			<?php if ($params->get('showCommentsCount')) :?>
				<?php echo $item->title; ?></a>&nbsp;<a href="<?php echo $item->link; ?>#comments">(+<?php echo $item->commentsCount; ?>)</a>
			<?php else : ?>
				<?php echo $item->title; ?>
			<?php endif; ?>
		</a>
	</li>
	<?php endforeach; ?>
</ul>
<?php endif; ?>
