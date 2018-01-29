<?php
/**
 * @package		Retina.Site
 * @subpackage	mod_articles_category
 * 
 * 
 */

// no direct access 2
defined('_REXEC') or die;
?>
<ul class="category-module<?php echo $moduleclass_sfx; ?>">
<?php if ($grouped) : ?>
	<?php foreach ($list as $group_name => $group) : ?>
	<li>
		<h<?php echo $element_heading; ?>><?php echo $group_name; ?></h<?php echo $element_heading; ?>>
		<ul>
			<?php foreach ($group as $element) : ?>
				<li>
					<h<?php echo $element_heading+1; ?>>
					   	<?php if ($params->get('link_titles') == 1) : ?>
						<a class="mod-articles-category-title <?php echo $element->active; ?>" href="<?php echo $element->link; ?>">
						<?php echo $element->title; ?>
				        <?php if ($element->displayHits) :?>
							<span class="mod-articles-category-hits">
				            (<?php echo $element->displayHits; ?>)  </span>
				        <?php endif; ?></a>
				        <?php else :?>
				        <?php echo $element->title; ?>
				        	<?php if ($element->displayHits) :?>
							<span class="mod-articles-category-hits">
				            (<?php echo $element->displayHits; ?>)  </span>
				        <?php endif; ?></a>
				            <?php endif; ?>
			        </h<?php echo $element_heading+1; ?>>


				<?php if ($params->get('show_author')) :?>
					<span class="mod-articles-category-writtenby">
					<?php echo $element->displayAuthorName; ?>
					</span>
				<?php endif;?>

				<?php if ($element->displayCategoryTitle) :?>
					<span class="mod-articles-category-category">
					(<?php echo $element->displayCategoryTitle; ?>)
					</span>
				<?php endif; ?>
				<?php if ($element->displayDate) : ?>
					<span class="mod-articles-category-date"><?php echo $element->displayDate; ?></span>
				<?php endif; ?>
				<?php if ($params->get('show_introtext')) :?>
			<p class="mod-articles-category-introtext">
			<?php echo $element->displayIntrotext; ?>
			</p>
		<?php endif; ?>

		<?php if ($params->get('show_readmore')) :?>
			<p class="mod-articles-category-readmore">
				<a class="mod-articles-category-title <?php echo $element->active; ?>" href="<?php echo $element->link; ?>">
				<?php if ($element->params->get('access-view')== FALSE) :
						echo RText::_('MOD_ARTICLES_CATEGORY_REGISTER_TO_READ_MORE');
					elseif ($readmore = $element->alternative_readmore) :
						echo $readmore;
						echo JHtml::_('string.truncate', $element->title, $params->get('readmore_limit'));
						if ($params->get('show_readmore_title', 0) != 0) :
							echo JHtml::_('string.truncate', ($this->element->title), $params->get('readmore_limit'));
						endif;
					elseif ($params->get('show_readmore_title', 0) == 0) :
						echo RText::sprintf('MOD_ARTICLES_CATEGORY_READ_MORE_TITLE');
					else :

						echo RText::_('MOD_ARTICLES_CATEGORY_READ_MORE');
						echo JHtml::_('string.truncate', ($element->title), $params->get('readmore_limit'));
					endif; ?>
	        </a>
			</p>
			<?php endif; ?>
		</li>
			<?php endforeach; ?>
		</ul>
	</li>
	<?php endforeach; ?>
<?php else : ?>
	<?php foreach ($list as $element) : ?>
	    <li>
	   	<h<?php echo $element_heading; ?>>
	   	<?php if ($params->get('link_titles') == 1) : ?>
		<a class="mod-articles-category-title <?php echo $element->active; ?>" href="<?php echo $element->link; ?>">
		<?php echo $element->title; ?>
        <?php if ($element->displayHits) :?>
			<span class="mod-articles-category-hits">
            (<?php echo $element->displayHits; ?>)  </span>
        <?php endif; ?></a>
        <?php else :?>
        <?php echo $element->title; ?>
        	<?php if ($element->displayHits) :?>
			<span class="mod-articles-category-hits">
            (<?php echo $element->displayHits; ?>)  </span>
        <?php endif; ?></a>
            <?php endif; ?>
        </h<?php echo $element_heading; ?>>

       	<?php if ($params->get('show_author')) :?>
       		<span class="mod-articles-category-writtenby">
			<?php echo $element->displayAuthorName; ?>
			</span>
		<?php endif;?>
		<?php if ($element->displayCategoryTitle) :?>
			<span class="mod-articles-category-category">
			(<?php echo $element->displayCategoryTitle; ?>)
			</span>
		<?php endif; ?>
        <?php if ($element->displayDate) : ?>
			<span class="mod-articles-category-date"><?php echo $element->displayDate; ?></span>
		<?php endif; ?>
		<?php if ($params->get('show_introtext')) :?>
			<p class="mod-articles-category-introtext">
			<?php echo $element->displayIntrotext; ?>
			</p>
		<?php endif; ?>

		<?php if ($params->get('show_readmore')) :?>
			<p class="mod-articles-category-readmore">
				<a class="mod-articles-category-title <?php echo $element->active; ?>" href="<?php echo $element->link; ?>">
		        <?php if ($element->params->get('access-view')== FALSE) :
						echo RText::_('MOD_ARTICLES_CATEGORY_REGISTER_TO_READ_MORE');
					elseif ($readmore = $element->alternative_readmore) :
						echo $readmore;
						echo JHtml::_('string.truncate', $element->title, $params->get('readmore_limit'));
					elseif ($params->get('show_readmore_title', 0) == 0) :
						echo RText::sprintf('MOD_ARTICLES_CATEGORY_READ_MORE_TITLE');
					else :
						echo RText::_('MOD_ARTICLES_CATEGORY_READ_MORE');
						echo JHtml::_('string.truncate', $element->title, $params->get('readmore_limit'));
					endif; ?>
	        </a>
			</p>
		<?php endif; ?>
	</li>
	<?php endforeach; ?>
<?php endif; ?>
</ul>
