<?php
/**
 * @package		Retina.Site
 * @subpackage	mod_related_elements
 * 
 * 
 */

// no direct access 2
defined('_REXEC') or die;
?>
<ul class="relatedelements<?php echo $moduleclass_sfx; ?>">
<?php foreach ($list as $element) :	?>
<li>
	<a href="<?php echo $element->route; ?>">
		<?php if ($showDate) echo JHTML::_('date', $element->created, RText::_('DATE_FORMAT_LC4')). " - "; ?>
		<?php echo $element->title; ?></a>
</li>
<?php endforeach; ?>
</ul>
