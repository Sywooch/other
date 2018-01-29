<?php
// Check to ensure this file is included in Joomla!
defined('_JEXEC') or die();

class JElementviewimage extends JElement
{
	/**
	 * Element name
	 *
	 * @access	protected
	 * @var		string
	 */
	var	$_name = 'viewimage';

	function fetchElement($name, $value, &$node, $control_name)
	{
		
		$val = time();
		$img = JURI::root()."index.php?option=com_joomlaxi&task=generateImage&value=".$val ;
		$image = '<img src="'.$img.'" />';
		return $image;
	}
}