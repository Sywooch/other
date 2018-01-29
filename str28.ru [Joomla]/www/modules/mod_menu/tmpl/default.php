<?php

// No direct access.
defined('_REXEC') or die;

// Note. It is important to remove spaces between elements.
?>

<ul class="menu<?php echo $class_sfx;?>"<?php
	$tag = '';
	if ($params->get('tag_id')!=NULL) {
		$tag = $params->get('tag_id').'';
		echo ' id="'.$tag.'"';
	}
?>>
<?php
foreach ($list as $i => &$element) :
	$class = 'element-'.$element->id;
	if ($element->id == $active_id) {
		$class .= ' current';
	}

	if (in_array($element->id, $path)) {
		$class .= ' active';
	}
	elseif ($element->type == 'alias') {
		$aliasToId = $element->params->get('aliasoptions');
		if (count($path) > 0 && $aliasToId == $path[count($path)-1]) {
			$class .= ' active';
		}
		elseif (in_array($aliasToId, $path)) {
			$class .= ' alias-parent-active';
		}
	}

	if ($element->deeper) {
		$class .= ' deeper';
	}

	if ($element->parent) {
		$class .= ' parent';
	}

	if (!empty($class)) {
		$class = ' class="'.trim($class) .'"';
	}

	echo '<li'.$class.'>';

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
