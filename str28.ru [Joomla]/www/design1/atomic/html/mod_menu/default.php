<?php
/**
 * @package		Retina.Site
 * @subpackage	design1.atomic
 * 
 * 
 */

// No direct access.
defined('_REXEC') or die;

// Note. It is important to remove spaces between elements.
?>
<!-- The class on the root UL tag was changed to match the Blueprint nav style -->
<ul class="retina-nav<?php echo $params->get('class_sfx');?>"<?php
	$tag = '';
	if ($params->get('tag_id')!=NULL) {
		$tag = $params->get('tag_id').'';
		echo ' id="'.$tag.'"';
	}
?>>
<?php
foreach ($list as $i => &$element) :
	$id = '';
	if($element->id == $active_id)
	{
		$id = ' id="current"';
	}
	$class = '';
	if(in_array($element->id, $path))
	{
		// Changed the active style to match the Blueprint nav style
		$class .= 'selected ';
	}
	if($element->deeper) {
		$class .= 'parent ';
	}

	$class = ' class="'.$class.'element'.$element->id.'"';

	echo '<li'.$id.$class.'>';

	// Render the menu element.
	switch ($element->type) :
		case 'separator':
		case 'url':
		case 'component':
			require JModuleHelper::getLayoutPath('mod_menu', 'default_'.$element->type);
			break;

		default:
			require JModuleHelper::getLayoutPath('mod_menu', 'default_url');
			break;
	endswitch;

	// The next element is deeper.
	if ($element->deeper) {
		echo '<ul>';
	}
	// The next element is shallower.
	elseif ($element->shallower) {
		echo '</li>';
		echo str_repeat('</ul></li>', $element->level_diff);
	}
	// The next element is on the same level.
	else {
		echo '</li>';
	}
endforeach;
?></ul>
