<?php
// no direct access
defined( '_JEXEC' ) or die( 'Restricted access' );

class captcha_com_contact
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
			case 'JS_CONTACT_FORM_SHOW' :
				return $this->_buildCaptchaOnContact($image,$body);
			default :
				return $body;
		}
	}
	
	// will tell you if verification or adding a captcha required
	function needToVerify()
	{
		switch($this->_getEventName())
		{
			case 'JS_CONTACT_FORM_SEND' :
				return 'VERIFY';
		
			case 'JS_CONTACT_FORM_SHOW' :
				return 'ADD_CAPTCHA';
			
			default :
				return 'DO_NOTHING';
		}
	}
	
	function _getEventName()
	{
		$view 	= JRequest::getCmd('view');
		$task 	= JRequest::getCmd('task');
		
		if($view == 'contact' && $task == 'submit')
				return 'JS_CONTACT_FORM_SEND';
		
		if($view == 'contact')
				return 'JS_CONTACT_FORM_SHOW';
		
		return false;
	}
		
	
	function _buildCaptchaOnContact($image,$body)
	{
		ob_start();
		?>
			<div>
				<div style="float:left;" >
					<?php echo JText::_('XI PLEASE ENTER CAPTCHA').':'; ?>
				</div>
				<br />
				<div style="" >
					<img id='xiCaptchaImage' src="<?php echo $image; ?>" /> 
				</div>
				
				<div style="" >
					<input class="inputbox required" type="text" id="jsCaptchaValue" name="jsCaptchaValue" size="20" value="" />
				</div>
			</div>
			<div style="clear:both"></div>

		<?php
		$contents	= ob_get_contents();
		ob_end_clean();

		
		$searchFor	 =	'<textarea cols="50" rows="10" name="text" id="contact_text" class="inputbox required"></textarea>';
		$replaceWith =  '<textarea cols="50" rows="10" name="text" id="contact_text" class="inputbox required"></textarea>'
						.'<br /><br />'
						.$contents;
						
		assert($searchFor && $replaceWith);
		$count=0;
		$body = str_replace($searchFor, $replaceWith, $body, $count);
		if($this->_debugMode){
			if($count)
				$message=JText::_('XI CAPTCHA ON CONTACT REPLACED');
			else
				$message=sprintf(JText::_('XI CAPTCHA ON CONTACT NOT REPLACED'),$searchFor,$replaceWith);
			
			debugMessage($message);			
		}
		return $body;
	}
}
