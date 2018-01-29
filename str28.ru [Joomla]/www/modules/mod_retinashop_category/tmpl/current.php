<?php // no direct access 2
defined('_REXEC') or die('Restricted access');
//JHTML::stylesheet ( 'menucss.css', 'modules/mod_retinashop_category/css/', false );
$ID = str_replace('.', '_', substr(microtime(true), -8, 8));
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
<?php if ($active_menu=='class="rsOpen"') {


	?>
	<ul class="menu<?php echo $class_sfx; ?>">
	<?php
		foreach ($category->childs as $child) {

			$caturl = JRoute::_('index.php?option=com_retinashop&view=category&retinashop_category_id='.$child->retinashop_category_id);
			$cattext = $child->category_name;
			?>

			<li>
				<div ><?php echo JHTML::link($caturl, $cattext); ?></div>
			</li>
			<?php
		}
		?>
	</ul>
	<?php
}
?>
</li>
<?php
	} ?>
</ul>
