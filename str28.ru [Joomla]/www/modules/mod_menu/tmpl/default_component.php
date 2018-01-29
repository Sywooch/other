<?php
/**
 * @package		Retina.Site
 * @subpackage	mod_menu
 * 
 * 
 */

// No direct access.
defined('_REXEC') or die;

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

switch ($element->browserNav) :
	default:
	case 0:
?><a <?php echo $class; ?>href="<?php echo $element->flink; ?>" <?php echo $title; ?>><?php echo $linktype; ?></a><?php
		break;
	case 1:
		// _blank
?><a <?php echo $class; ?>href="<?php echo $element->flink; ?>" target="_blank" <?php echo $title; ?>><?php echo $linktype; ?></a><?php
		break;
	case 2:
	// window.open
?><a <?php echo $class; ?>href="<?php echo $element->flink; ?>" onclick="window.open(this.href,'targetWindow','toolbar=no,location=no,status=no,menubar=no,scrollbars=yes,resizable=yes');return false;" <?php echo $title; ?>><?php echo $linktype; ?></a>
<?php
		break;
endswitch;
