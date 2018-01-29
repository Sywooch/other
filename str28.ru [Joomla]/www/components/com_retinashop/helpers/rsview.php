<?php
defined('_REXEC') or die('');
/**
 * abstract controller class containing get,store,delete,publish and pagination
 *
 *
 * This class provides the functions for the calculatoins
 *
 * @package	Magazin
 * @subpackage Helpers
 * @author Max Milbers
 * @copyright Copyright (c) 2011 retinashop Team. All rights reserved.
 * @license http://www.gnu.org/copyleft/gpl.html GNU/GPL, see LICENSE.php
 * 
 * to the GNU General Public License, and as distributed it includes or
 * is derivative of works licensed under the GNU General Public License or
 * other free or open source software licenses.
 * See /admin/components/com_retinashop/COPYRIGHT.php for copyright notices and details.
 *
 * http://retinashop.net
 */
// Load the view framework
jimport( 'retina.application.component.view');
// Load default helpers

class rsView extends JView{

	function linkIcon($link,$altText ='',$boutonName,$verifyConfigValue=false, $modal = true, $use_icon=true,$use_text=false){
		if ($verifyConfigValue) {
			if ( !rsConfig::get($verifyConfigValue, 0) ) return '';
		}
		$folder = (Jrs_VERSION===1) ? '/images/M_images/' : '/media/main/images/';
		$text='';
		if ( $use_icon ) $text .= JHtml::_('image.site', $boutonName.'.png', $folder, null, null, RText::_($altText));
		if ( $use_text ) $text .= '&nbsp;'. RText::_($altText);
		if ( $text=='' )  $text .= '&nbsp;'. RText::_($altText);
		if ($modal) return '<a class="modal" rel="{handler: \'iframe\', size: {x: 700, y: 550}}" title="'. RText::_($altText).'" href="'.JRoute::_($link).'">'.$text.'</a>';
		else 		return '<a title="'. RText::_($altText).'" href="'.JRoute::_($link).'">'.$text.'</a>';
	}

}