<?php
/**
 * @package		Retina.Site
 * @subpackage	Contact
 * 
 * 
 */

defined('_REXEC') or die;

class JFormRuleContactEmailMessage extends JFormRule
{
	public function test(& $element, $value, $group = null, & $input = null, & $form = null)
	{
		$params = JComponentHelper::getParams('com_contact');
		$banned = $params->get('banned_text');

		foreach(explode(';', $banned) as $element){
			if (JString::stristr($element, $value) !== false)
					return false;
		}

		return true;
	}
}
