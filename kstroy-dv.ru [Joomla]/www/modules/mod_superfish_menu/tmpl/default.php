<?php
/**
 * @package		Joomla.Site
 * @subpackage	mod_menu
 * @copyright	Copyright (C) 2005 - 2012 Open Source Matters, Inc. All rights reserved.
 * @license		GNU General Public License version 2 or later; see LICENSE.txt
 */

// No direct access.
defined('_JEXEC') or die;

// Note. It is important to remove spaces between elements.
?>
	<script type="text/javascript" src="<?php echo $path2 ?>modules/mod_superfish_menu/js/superfish.js"></script>
<script type="text/javascript" src="<?php echo $path2 ?>modules/mod_superfish_menu/js/jquery.hoverIntent.js"></script>

<ul id="nav_top" class="sf_menu <?php echo $class_sfx;?>"<?php
	$tag = '';
	if ($params->get('tag_id')!=NULL) {
		$tag = $params->get('tag_id').'';
		echo ' id="'.$tag.'"';
	}
?>>

<?php
$count=1;
foreach ($list as $i => &$item) :
	$class = 'item-'.$item->id;
	if ($item->id == $active_id) {
		$class .= ' current';
	}

	if (in_array($item->id, $path)) {
		$class .= ' active';
	}
	elseif ($item->type == 'alias') {
		$aliasToId = $item->params->get('aliasoptions');
		if (count($path) > 0 && $aliasToId == $path[count($path)-1]) {
			$class .= ' active';
		}
		elseif (in_array($aliasToId, $path)) {
			$class .= ' alias-parent-active';
		}
	}

	if ($item->deeper) {
		$class .= ' deeper';
	}

	if ($item->parent) {
		$class .= ' parent';
	}
	if ($item->parent) {
		$span   = '<span class="Arrowdown"></span>';
	}else {$span   = '';}
	

	if (!empty($class)) {
		$class = ' class="'.trim($class) .'"';
	}

	echo '<li'.$class.'>';
		echo $span;


	// Render the menu item.
	switch ($item->type) :
		case 'separator':
		case 'url':
		case 'component':
			require JModuleHelper::getLayoutPath('mod_superfish_menu', 'default_'.$item->type);
			break;

		default:
			require JModuleHelper::getLayoutPath('mod_superfish_menu', 'default_url');
			break;
	endswitch;

	// The next item is deeper.
	if ($item->deeper) {
		echo '<ul class="sub-menu2">';
	}
	
	// The next item is shallower.
	elseif ($item->shallower) {
		echo '</li>';
		echo str_repeat('</ul></li>', $item->level_diff);
			

	}
	// The next item is on the same level.
	else {
		echo '</li>';
	}
endforeach;
?></ul>

<script type="text/javascript">
	// initialise plugins
	jQuery(function(){
		jQuery('ul.sf_menu').superfish({
		    hoverClass:    'sfHover',         
		    pathClass:     'overideThisToUse',
		    pathLevels:    1,    
		    delay:         <?php echo $params->get('sf-delay'); ?>, 
		    animation:     {<?php echo $params->get('sf-animation'); ?>}, 
		    speed:         '<?php echo $params->get("sf-speed"); ?>',   
		    dropShadows:   false, 
		    disableHI:     false, 
		    easing:        "<?php echo $params->get('easing'); ?>"
		});
	});
</script>