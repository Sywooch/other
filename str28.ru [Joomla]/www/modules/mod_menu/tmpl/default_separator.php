<?php


// No direct access.
defined('_REXEC') or die;

// Note. It is important to remove spaces between elements.
$title = $element->anchor_title ? 'title="'.$element->anchor_title.'" ' : '';
if ($element->menu_image) {
		$element->params->get('menu_text', 1 ) ?
		$linktype = '<img src="'.$element->menu_image.'" alt="'.$element->title.'" /><span class="image-title">'.$element->title.'</span> ' :
		$linktype = '<img src="'.$element->menu_image.'" alt="'.$element->title.'" />';
}
else { $linktype = $element->title;
}

?><span class="separator"><?php echo $title; ?><?php echo $linktype; ?></span>
