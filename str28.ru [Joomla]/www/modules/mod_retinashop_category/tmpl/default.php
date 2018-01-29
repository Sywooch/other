<?php // no direct access 2
defined('_REXEC') or die('Restricted access');
//JHTML::stylesheet ( 'menucss.css', 'modules/mod_retinashop_category/css/', false );

/* ID for jQuery dropdown */
$ID = str_replace('.', '_', substr(microtime(true), -8, 8));
$js="jQuery(document).ready(function() {
		jQuery('#rsmenu".$ID." li.rsClose ul').hide();
		jQuery('#rsmenu".$ID." li .rsArrowdown').click(
		function() {

			if (jQuery(this).parent().next('ul').is(':hidden')) {
				jQuery('#rsmenu".$ID." ul:visible').delay(500).slideUp(500,'linear').parents('li').addClass('rsClose').removeClass('rsOpen');
				jQuery(this).parent().next('ul').slideDown(500,'linear');
				jQuery(this).parents('li').addClass('rsOpen').removeClass('rsClose');
			}
		});
	});" ;

		$document = JFactory::getDocument();
		$document->addScriptDeclaration($js);
?>

<ul class="rsmenu<?php echo $class_sfx ?>" ID="<?php echo "rsmenu".$ID ?>" >
<?php foreach ($categories as $category) {
		 $active_menu = 'class="rsClose"';
		$caturl = JRoute::_('index.php?option=com_retinashop&view=category&retinashop_category_id='.$category->retinashop_category_id);
		$cattext = $category->category_name;
		//if ($active_category_id == $category->retinashop_category_id) $active_menu = 'class="active"';
		if (in_array( $category->retinashop_category_id, $parentCategories)) $active_menu = 'class="rsOpen"';

		?>

<li <?php echo $active_menu ?>>
	<div >
		<?php echo JHTML::link($caturl, $cattext);
		if ($category->childs) {
			?>
			<span class="rsArrowdown"> </span>
			<?php
		}
		?>
	</div>
<?php if ($category->childs) { ?>
<ul class="menu<?php echo $class_sfx; ?>">
<?php
		foreach ($category->childs as $child) {

		$caturl = JRoute::_('index.php?option=com_retinashop&view=category&retinashop_category_id='.$child->retinashop_category_id);
		$cattext = $child->category_name;
		?>

<li>
	<div ><?php echo JHTML::link($caturl, $cattext); ?></div>
</li>
<?php		} ?>
</ul>
<?php 	} ?>
</li>
<?php
	} ?>
</ul>
