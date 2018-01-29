<?php
defined('_REXEC') or  die( 'Direct Access to '.basename(__FILE__).' is not allowed.' );
/**
* @version $Id: mod_retinashop_search.php 5171 2011-12-27 15:41:22Z alatak $
* @package retinashop
* @subpackage modules
*
* @copyright (C) 2011 Patrick Kohl
* @license http://www.gnu.org/copyleft/gpl.html GNU/GPL
* retinashop is Free Software.
* retinashop comes with absolute no warranty.
*
* www.retinashop.net
*/

// Load the retinashop main parse code
$button			 = $params->get('button', '');
$imagebutton	 = $params->get('imagebutton', '');
$button_pos		 = $params->get('button_pos', 'left');
$button_text	 = $params->get('button_text', RText::_('Search'));
$width			 = intval($params->get('width', 20));
$maxlength		 = $width > 20 ? $width : 20;
$text			 = $params->get('text', RText::_('search...'));
$set_elementid		 = intval($params->get('set_elementid', 0));
$moduleclass_sfx = $params->get('moduleclass_sfx', '');

if ( $params->get('filter_category', 0) ){
    $category_id = JRequest::getInt('retinashop_category_id', 0);
} else {
    $category_id = 0 ;
}
require(JModuleHelper::getLayoutPath('mod_retinashop_search'));
?>
