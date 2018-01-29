<?php
// no direct access
defined( '_JEXEC' ) or die( 'Restricted access' );

class captcha_com_user
{
	var $_debugMode;
	function __construct( $debugMode )
	{
		$this->_debugMode=$debugMode;
	}
	function addCaptchaForm($image,$body)
	{
		switch($this->_getEventName())
		{
			case 'JS_REG_FORM_SHOW' :
				return $this->_buildCaptchaForRegistration($image,$body);
			case 'JS_REMIND_FORM_SHOW' :
				return $this->_buildCaptchaForRemind($image,$body);
			case 'JS_RESET_FORM_SHOW' :
				return $this->_buildCaptchaForReset($image,$body);
			default :
				return $body;
		}
	}
	
	// will tell you if verification or adding a captcha required
	function needToVerify()
	{
		switch($this->_getEventName())
		{
			case 'JS_REG_FORM_SAVE' :
			case 'JS_RESET_PWD_SUCCESS' :
			case 'JS_RESET_USERNAME_SUCCESS' :
				return 'VERIFY';
		
			case 'JS_REG_FORM_SHOW' :
			case 'JS_RESET_FORM_SHOW' :
			case 'JS_REMIND_FORM_SHOW' :
				return 'ADD_CAPTCHA';
			
			default :
				return 'DO_NOTHING';
		}
	}
	
	function _getEventName()
	{
		$view 	= JRequest::getCmd('view');
		$task 	= JRequest::getCmd('task');
				
		if($task=='register_save')
			return 'JS_REG_FORM_SAVE';
		
		if($task == 'requestreset')
			return 'JS_RESET_PWD_SUCCESS';
		
		if($task == 'remindusername')
			return 'JS_RESET_USERNAME_SUCCESS';
			
		if($view=='register')
			return 'JS_REG_FORM_SHOW';
		
		//when click on forgot password		
		if($view == 'reset')
			return 'JS_RESET_FORM_SHOW';
		
		//when user click on forgot username
		if($view == 'remind')
			return 'JS_REMIND_FORM_SHOW';
		
		
		return false;
	}
	
	
	function _buildCaptchaForRegistration($image,$body)
	{
		ob_start();
		?>
		<tr >
			<td class="paramlist_key"><?php echo JText::_('XI VERIFY CODE'); ?></td>
			<td class="paramlist_value"><?php echo JText::_('XI PLEASE ENTER CAPTCHA'); ?></td>
		</tr>
		<tr>
			<td></td>
			<td class="paramlist_value">
			<img id='xiCaptchaImage' src="<?php echo $image; ?>" /> 
			<br /><br />
			<input class="inputbox required" type="text" id="jsCaptchaValue" name="jsCaptchaValue" size="20" value="" />
		<?php
		$contents	= ob_get_contents();
		ob_end_clean();

		
		$searchFor	 =	'<input class="inputbox required validate-passverify" type="password" id="password2" name="password2" size="40" value="" />';
		$replaceWith =  '<input class="inputbox required validate-passverify" type="password" id="password2" name="password2" size="40" value="" />'
						.'</td></tr>'
						.$contents;
						
		assert($searchFor && $replaceWith);
		$count = 0;
		$body = str_replace($searchFor, $replaceWith, $body, $count);
		
		if($this->_debugMode){
			if($count)
				$message=JText::_('XI CAPTCHA FOR REGISTRATION REPLACED');
			else
				$message=sprintf(JText::_('XI CAPTCHA FOR REGISTRATION NOT REPLACED'),$searchFor,$replaceWith);
			
			debugMessage($message);			
		}
		return $body;
	}
	
	
	function _buildCaptchaForRemind($image,$body)
	{
		ob_start();
		?>
		<tr >
			<td class="paramlist_key"><?php echo JText::_('XI VERIFY CODE'); ?></td>
			<td class="paramlist_value"><?php echo JText::_('XI PLEASE ENTER CAPTCHA'); ?></td>
		</tr>
		<tr>
			<td></td>
			<td class="paramlist_value">
			<img id='xiCaptchaImage' src="<?php echo $image; ?>" /> 
			<br /><br />
			<input class="inputbox required" type="text" id="jsCaptchaValue" name="jsCaptchaValue" size="20" value="" />
		<?php
		$contents	= ob_get_contents();
		ob_end_clean();

		
		$searchFor	 =	'<input id="email" name="email" type="text" class="required validate-email" />';
		$replaceWith =  '<input id="email" name="email" type="text" class="required validate-email" />'
						.'</td></tr>'
						.$contents;
						
		assert($searchFor && $replaceWith);
		$count=0;
		$body = str_replace($searchFor, $replaceWith, $body, $count);
		if($this->_debugMode){
			if($count)
				$message=JText::_('XI CAPTCHA FOR REMIND REPLACED');
			else
				$message=sprintf(JText::_('XI CAPTCHA FOR REMIND NOT REPLACED'),$searchFor,$replaceWith);
			
			debugMessage($message);			
		}
		return $body;
	}
	
	
	function _buildCaptchaForReset($image,$body)
	{
		ob_start();
		?>
		<tr >
			<td class="paramlist_key"><?php echo JText::_('XI VERIFY CODE'); ?></td>
			<td class="paramlist_value"><?php echo JText::_('XI PLEASE ENTER CAPTCHA'); ?></td>
		</tr>
		<tr>
			<td></td>
			<td class="paramlist_value">
			<img id='xiCaptchaImage' src="<?php echo $image; ?>" /> 
			<br /><br />
			<input class="inputbox required" type="text" id="jsCaptchaValue" name="jsCaptchaValue" size="20" value="" />
		<?php
		$contents	= ob_get_contents();
		ob_end_clean();

		
		$searchFor	 =	'<input id="email" name="email" type="text" class="required validate-email" />';
		$replaceWith =  '<input id="email" name="email" type="text" class="required validate-email" />'
						.'</td></tr>'
						.$contents;
						
		assert($searchFor && $replaceWith);
		$count = 0;
		$body = str_replace($searchFor, $replaceWith, $body, $count);
		if($this->_debugMode){
			if($count)
				$message=JText::_('XI CAPTCHA FOR RESET REPLACED');
			else
				$message=sprintf(JText::_('XI CAPTCHA FOR RESET NOT REPLACED'),$searchFor,$replaceWith);
			
			debugMessage($message);			
		}
		return $body;
	}
}
