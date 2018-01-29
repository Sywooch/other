<?php
#####################################################################################################
#
#					Module pour la plateforme de paiement mainpay
#						Version : 1.2 (révision 33398)
#									########################
#					Développé pour retinashop
#						Version : 2.0.0
#						Compatibilité plateforme : V2
#									########################
#					Développé par Lyra Network
#						http://www.lyra-network.com/
#						20/02/2012
#						Contact : supportvad@lyra-network.com
#
#####################################################################################################

// Check to ensure this file is within the rest of the framework
defined('RPATH_BASE') or die();

/**
 * Renders a label element
 */

class JElementmainpayLabel extends JElement
{
	/**
	* Element name
	*
	* @access	protected
	* @var		string
	*/
	var	$_name = 'mainpayLabel';

	function fetchElement($name, $value, &$node, $control_name)
	{
		$class = ( $node->attributes('class') ? 'class="'.$node->attributes('class').'"' : 'class="text_area"' );
		return '<label for="'.$name.'"'.$class.'>'.$value.'</label>';
	}
}