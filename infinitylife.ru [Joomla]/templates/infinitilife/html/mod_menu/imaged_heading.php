<?php
/**
 * @package     Joomla.Site
 * @subpackage  mod_menu
 *
 * @copyright   Copyright (C) 2005 - 2015 Open Source Matters, Inc. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */

defined('_JEXEC') or die;

$title = $item->anchor_title ? 'title="' . $item->anchor_title . '" ' : '';

if ($item->menu_image)
{
	$item->params->get('menu_text', 1) ?
        $linktype = '<span style="background-image: url(/'. $item->menu_image.');" class="image-title">' . $item->title . '</span>' :
        $linktype = '<span style="background-image: url(/'. $item->menu_image.');" class="image-title"></span>';
}
else
{
	$linktype = $item->title;
}
?>
<span class="nav-header <?php echo $item->anchor_css; ?>" <?php echo $title; ?>><?php echo $linktype; ?></span>
