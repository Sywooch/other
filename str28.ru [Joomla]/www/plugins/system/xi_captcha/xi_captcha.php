<?php
// no direct access
defined( '_JEXEC' ) or die( 'Restricted access' );

jimport( 'joomla.plugin.plugin' );
jimport('joomla.filesystem.file');

class plgSystemxi_captcha extends JPlugin
{
	var $_debugMode;
	var $_preText = 'captcha_';
	var $params;

	function plgSystemxi_captcha( &$subject, $params )
	{
		parent::__construct( $subject, $params );
	}
	
	function onAfterRoute()
	{
 		global $mainframe;	
		
		// Dont run in admin
		if ($mainframe->isAdmin())
			return; 
		
		$plugin 	=& JPluginHelper::getPlugin('system', 'xi_captcha');
		$this->params   	= new JParameter($plugin->params);
		$this->_debugMode	=	$this->params->get('xiDebugMode', 0);	
		
		// Create object of required class according to option
		//XITODO : Fix for SEO enabled contact us page
		$option = JRequest::getCmd('option','');
		$task = JRequest::getCmd('task','','GET');
		
		//checking URL for generating image
		if($option == "com_joomlaxi" && $task == "generateImage")
		{
			//generating image
			$this->_generateCaptchaImage();			
			die();
		}
		
		// include class file
		$filename = $this->_preText.$option.'.php';
		if(!JFile::exists(dirname(__FILE__).DS.'xi_captcha'.DS.'class'.DS.$filename))
			return;
		
		require_once( dirname(__FILE__).DS.'xi_captcha'.DS.'utils.php');
		require_once( dirname(__FILE__).DS.'xi_captcha'.DS.'class'.DS.$filename );
		$classname = $this->_preText.$option;
		$class = new $classname($this->_debugMode);
		
		// if Captcha verification not required, user will be redirected back
		if($class->needToVerify() != 'VERIFY')
			return;
		
		JPlugin::loadLanguage( 'plg_xi_captcha', JPATH_ADMINISTRATOR );
		$this->_verifyCaptcha();
		return;
	}
	
	// add captcha
	function onAfterRender()
	{
		$document	=& JFactory::getDocument();
		$doctype	= $document->getType();

		// Only render for HTML output
		if ( $doctype !== 'html' )
			return;
		
		// Create object of required class according to option
		$option = JRequest::getCmd('option','','GET');
		$filename = $this->_preText.$option.'.php';
		
		// if file does not exist
		if(!JFile::exists(dirname(__FILE__).DS.'xi_captcha'.DS.'class'.DS.$filename))
			return;
		
		require_once( dirname(__FILE__).DS.'xi_captcha'.DS.'class'.DS.$filename );
		$classname = $this->_preText.$option;
		$class = new $classname($this->_debugMode);
		
		if($class->needToVerify() != 'ADD_CAPTCHA')
			return;
		
		JPlugin::loadLanguage( 'plg_xi_captcha', JPATH_ADMINISTRATOR );
		
		$mySess =& JFactory::getSession();
		$mySess->set('CAPTCHA_RETURL', $this->_getCurrentURL(),'JSPTCAPTCHA');
		$val = $this->_genFilename();
		
		//Creating a dummy url of image genration , by checking that will genrate image
		$image = JRoute::_("index.php?option=com_joomlaxi&task=generateImage&value=".$val,false);
		
		$body = JResponse::getBody();
		$body = $class->addCaptchaForm($image,$body);
		//in debug mode, we should send value in a variable
		JResponse::setBody($body);
	}
		
	//verify capctcha
	function _verifyCaptcha()
	{
		global $mainframe;
		// collect information from session
		$mySess =& JFactory::getSession();
		$retURL = $mySess->get('CAPTCHA_RETURL', 0, 'JSPTCAPTCHA');
		$retURL	= $retURL ? base64_decode($retURL) : 'index.php';
		
		$value	= JRequest::getVar('jsCaptchaValue','0','POST');
		if(!$value)
			$mainframe->redirect($retURL,false);
		
		// test the give key and value, sending key as 0 b'coz it's not required
		// will collect it from session
		if($this->_keyValuePair('GET',0, $value) == false)
		{
			$mainframe->enqueueMessage(JText::_('XI CAPTCHA INVALID'));
			$mainframe->redirect($retURL,false);			
		}
		
		if($this->_debugMode)
			$mainframe->enqueueMessage(JText::_('XI CAPTCHA VERIFIED'));
	}
	
	// decode the return URL, so that we can return to proper address.
	function _getCurrentURL()
	{
		// TO DO : Get url
		$url = JFactory::getURI()->toString( array('scheme', 'user', 'pass', 'host', 'port', 'path', 'query', 'fragment'));
		return base64_encode($url);
	}
	
	// query the database
	function _keyValuePair($what='SET', $key , $value)
	{		
		$mySess =& JFactory::getSession();
		// add the key-value
		if($what == 'SET')
		{
			$mySess->set('CAPTCHA_KEY', $key, 'JSPTCAPTCHA');
			$mySess->set('CAPTCHA_VALUE', $value, 'JSPTCAPTCHA');
			if($this->_debugMode)
			{
				$mySess =& JFactory::getSession();
				$this->insertDebugValue($value);
			}
			return true;
		}
		
		// Give the key-value pair, clear also, for security
		if($what == 'GET')
		{
			//assert($this->_captchaLifetime);
			$sessionValue = $mySess->get('CAPTCHA_VALUE', 0, 'JSPTCAPTCHA');
			
			// clear session
			$mySess->clear('CAPTCHA_KEY','JSPTCAPTCHA');
			$mySess->clear('CAPTCHA_VALUE','JSPTCAPTCHA');
			$mySess->clear('CAPTCHA_RETURL','JSPTCAPTCHA');

			debugMessage("Stored=$sessionValue and given value=$value",$this->_debugMode);
			return ($sessionValue == strtolower($value));
		}
		
		assert(0);
		return 0;
	}
	
	
	function _generateCaptchaImage()
	{
		require_once( dirname(__FILE__).DS.'xi_captcha'.DS.'xi_captcha_engine.php' );
		
		// init engine
		assert($this->params);
		$engine	= new CaptchaEngine($this->params,$this->_debugMode);
		
		// generate filename
		$key	=  $this->_genFilename();
				
		// generate image
		$value	= $engine->_genImage();
		
		// store key v/s code
		$this->_keyValuePair('SET',$key, $value);
		return $value;
	}
	
	
	function _genFilename()
	{
		// generate from Unix time stamp
		// todo : add security, mix some random number
		return time();
	}
	
	function insertDebugValue($value)
	{
		$query = 'CREATE TABLE IF NOT EXISTS `#__xi_captcha` (
				`id` int(10) NOT NULL auto_increment,  
				`value` varchar(20) NOT NULL default \'UNKNOWN\', 
				PRIMARY KEY  (`id`) 
			) ENGINE=MyISAM  DEFAULT CHARSET=utf8';
		
		$db =& JFactory::getDBO();
		$db->setQuery($query);
		$db->query();

		$query = "INSERT INTO `#__xi_captcha` (`value`) VALUES ('$value')";
		$db->setQuery($query);
		$db->query();
	}
}
