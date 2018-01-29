<?php
/**
 * @package		Retina.Site
 * @subpackage	mod_menu
 * 
 * 
 */

// No direct access.
defined('_REXEC') or die;
jimport('retina.filter.output');
// Note. It is important to remove spaces between elements.
$class = $element->anchor_css ? 'class="'.$element->anchor_css.'" ' : '';
$title = $element->anchor_title ? 'title="'.$element->anchor_title.'" ' : '';
if ($element->menu_image) {
		$element->params->get('menu_text', 1 ) ?
		$linktype = '<img src="'.$element->menu_image.'" alt="'.$element->title.'" /><span class="image-title">'.$element->title.'</span> ' :
		$linktype = '<img src="'.$element->menu_image.'" alt="'.$element->title.'" />';
}
else { $linktype = $element->title;
}
$flink = $element->flink;
$flink = JFilterOutput::ampReplace(htmlspecialchars($flink));

switch ($element->browserNav) :
	default:
	case 0:
?><a <?php echo $class; ?>href="<?php echo $flink; ?>" <?php echo $title; ?>><?php echo $linktype; ?></a><?php
		break;
	case 1:
		// _blank
?><a <?php echo $class; ?>href="<?php echo $flink; ?>" target="_blank" <?php echo $title; ?>><?php echo $linktype; ?></a><?php
		break;
	case 2:
		// window.open
		$options = 'toolbar=no,location=no,status=no,menubar=no,scrollbars=yes,resizable=yes,'.$params->get('window_open');
			?><a <?php echo $class; ?>href="<?php echo $flink; ?>" onclick="window.open(this.href,'targetWindow','<?php echo $options;?>');return false;" <?php echo $title; ?>><?php echo $linktype; ?></a><?php
		break;
endswitch;
