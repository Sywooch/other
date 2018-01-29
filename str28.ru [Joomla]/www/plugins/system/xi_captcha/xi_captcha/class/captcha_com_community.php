<?php
/**
 *
 * Author : Shyam Verma
 * Email  : shyam@joomlaxi.com
 * (Copyright) www.joomlaxi.com
 * License : Commercial and Non-Redistributable
 */
// no direct access
defined( '_JEXEC' ) or die( 'Restricted access' );

class captcha_com_community
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
			case 'JS_GRP_FORM_SHOW' :
				return $this->_buildCaptchaCreateGroup($image,$body);
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
			//XITODO: It will be added later on
			//case 'JS_GRP_FORM_SAVE' :
				return 'VERIFY';
		
			case 'JS_REG_FORM_SHOW' :
			//case 'JS_GRP_FORM_SHOW' :
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
		
		if($task=='register' || $view=='register')
			return 'JS_REG_FORM_SHOW';
			
		if($view == 'groups' && $task == 'create')
		{
			if(JRequest::getVar('action', '', 'POST') == 'save')
				return 'JS_GRP_FORM_SAVE';
			else
				return 'JS_GRP_FORM_SHOW';
		}
		
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

		
		$searchFor	 =	'<span id="errjspassword2msg" style="display:none;">&nbsp;</span>';
		$replaceWith =  '<span id="errjspassword2msg" style="display:none;">&nbsp;</span>'
						.'</td></tr>'
						.$contents;
						
		assert($searchFor && $replaceWith);
		$count=0;
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
	
	
	function _buildCaptchaCreateGroup($image,$body)
	{
		ob_start();
		?>
		<div class="items">
			<div style="float:left;">			
			<?php echo JText::_('XI VERIFY CODE'); ?>
			</div>
			<div style="float:left; margin-left:90px;">
			<?php echo JText::_('XI PLEASE ENTER CAPTCHA'); ?>
			</div>
		</div>
		<div style="clear:both"></div>
		<div style="float:left; margin-left:150px;">
			<img id='xiCaptchaImage' src="<?php echo $image; ?>" /> 
			<br />
			<input class="inputbox required" type="text" id="jsCaptchaValue" name="jsCaptchaValue" size="20" value="" />
		</div>
		<div style="clear:both"></div>
			<?php
		$contents	= ob_get_contents();
		ob_end_clean();

		$searchFor	 =	'<textarea name="description" id="description" class="required inputbox" value=""></textarea>';
		$replaceWith =  '<textarea name="description" id="description" class="required inputbox" value=""></textarea>'
						.$contents;
						
		assert($searchFor && $replaceWith);
		$count=0;
		$body = str_replace($searchFor, $replaceWith, $body, $count);
		if($this->_debugMode){
			if($count)
				$message=JText::_('XI CAPTCHA DURING CREATE GROUP REPLACED');
			else
				$message=sprintf(JText::_('XI CAPTCHA DURING CREATE GROUP NOT REPLACED'),$searchFor,$replaceWith);
			
			debugMessage($message);			
		}
		return $body;
	}
}
