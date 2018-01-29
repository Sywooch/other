<?php
/**
 * @package		Retina.Site
 * @subpackage	mod_stats
 * 
 * 
 */

// no direct access 2
defined('_REXEC') or die;
?>
<dl class="stats-module<?php echo $moduleclass_sfx ?>">
<?php foreach ($list as $element) : ?>
	<dt><?php echo $element->title;?></dt>
	<dd><?php echo $element->data;?></dd>
<?php endforeach; ?>
</dl>
