<?php
/**
 * @package		Retina.Site
 * @subpackage	Contact
 * 
 * 
 */

defined('_REXEC') or die;

require_once RPATH_PLATFORM. '/retina/form/rules/email.php';

class JFormRuleContactEmail extends JFormRuleEmail
{
	public function test(& $element, $value, $group = null, & $input = null, & $form = null)
	{
		if(!parent::test($element, $value, $group, $input, $form)){
			return false;
		}

		$params = JComponentHelper::getParams('com_contact');
		$banned = $params->get('banned_email');

		foreach(explode(';', $banned) as $element){
			if (JString::stristr($element, $value) !== false)
					return false;
		}

		return true;
	}

}
