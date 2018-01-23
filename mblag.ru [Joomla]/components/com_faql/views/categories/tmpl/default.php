<?php // no direct access
defined('_JEXEC') or die; ?>

<?php if ( ($this->params->def('image', -1) != -1) || $this->params->def('show_comp_description', 1) ) : ?>
<div class="listcatdescr">
	<table width="100%" cellpadding="4" cellspacing="0" border="0" align="center" class="contentpane<?php echo $this->escape($this->params->get('pageclass_sfx')); ?>">
	<tr>
		<td valign="top" class="contentdescription<?php echo $this->escape($this->params->get('pageclass_sfx')); ?>">
		<?php
			if (!empty($this->image)) echo $this->image;
			$desc = $this->params->get('comp_description');
			$desc = preg_replace('/\\r\\n/', '<br />', $desc );
			echo $desc;
		?>
		</td>
	</tr>
	</table>
</div>
<?php endif; ?>

<?php if ( $this->params->def( 'show_page_title', 1 ) ) : ?>
	<div class="componentheading<?php echo $this->escape($this->params->get('pageclass_sfx')); ?>">
		<?php echo '<h3>'.$this->escape($this->params->get('page_title')).'</h3>'; ?>
	</div>
<?php endif; ?>

<?php if ($this->categories) {
	if ($this->params->get('total_qa')) {
		echo '<div class="total"><p>'.JText::_('IN_A_DATABASE_OF_QUESTIONS') .': '.JText::_('TOTAL').'-'.$this->total->quest
			 .', '.JText::_('TODAY').'-'.$this->total->questtoday.'; &nbsp;&nbsp;&nbsp;'
			 .JText::_('ANSWERS').': '.JText::_('TOTAL').'-'.$this->total->answer.', '.JText::_('TODAY').'-'.$this->total->answertoday
			 .'</p></div>';
	}
?>
<div class="catimg">
<ul>
<?php foreach ( $this->categories as $category ) : ?>
	<li>
		<?php 
			if ($category->params->get('image'))
			{
				$attribs['align']  = 'left';
				$attribs['height'] = '30px';

				// Use the static HTML library to build the image tag
				echo JHTML::_('image', $category->params->get('image'), JText::_('faql'), $attribs);
			}
		?>
		<a href="<?php echo $category->link; ?>" class="category<?php echo $this->escape($this->params->get( 'pageclass_sfx' )); ?>">
			<?php echo $this->escape($category->title);?></a>
		<?php if ($this->params->get('num_questions')) { ?>
            <p class="faql_small">
                &nbsp;&nbsp;&nbsp;<?php echo JText::_('QUESTIONS') .': '.JText::_('TOTAL').'-'.$category->numquestion.', '
							.JText::_('TODAY').'-'.$category->catquest_t.'; &nbsp;&nbsp;&nbsp;'
							.JText::_('ANSWERS') .': '.JText::_('TOTAL').'-'.$category->numanswer.', '
							.JText::_('TODAY').'-'.$category->catansw_t;
		?>
            </p>
        <?php } ?>
		<?php if ($this->params->get('cat_desc')) { ?>
        	<br />
            <div><?php echo $category->description; ?></div>
        <?php } ?>
       
	</li>
<?php endforeach; ?>
</ul>
</div>
<?php } else {
	echo JText::_('CATEGORIES_NOT_FOUND');
} ?>
