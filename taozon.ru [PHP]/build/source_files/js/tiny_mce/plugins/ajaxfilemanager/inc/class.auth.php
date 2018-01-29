<?php 
/**
 * the purpose I added this class is to make the file system much flexible 
 * for customization.
 * Actually,  this is a kind of interface and you should modify it to fit your system
 * @author Logan Cai (cailongqun [at] yahoo [dot] com [dot] cn)
 * @link www.phpletter.com
 * @since 4/August/2007
 */
	class Auth
	{
		var $__loginIndexInSession = 'ajax_user';
		function __construct()
		{
			
		}
		
		function Auth()
		{
			$this->__construct();
		}
		/**
		 * check if the user has logged
		 *
		 * @return boolean
		 */
		function isLoggedIn()
		{
			require_once('../../../../configcustom.php');
			require_once('../../../../lib/timer.php');
			require_once('../../../../lib/Curl.class.php');
			require_once('../../../../otapilib.php');
			global $otapilib;
			$otapilib = new OTAPIlib();
			$sid = @$_SESSION['sid'];
			$otapilib->GetWebUISettings($sid);
			return !($otapilib->error_message == 'SessionExpired' || $sid == '');
		}
		/**
		 * validate the username & password
		 * @return boolean
		 *
		 */
		function login()
		{
			if($_POST['username'] == CONFIG_LOGIN_USERNAME && $_POST['password'] == CONFIG_LOGIN_PASSWORD)
			{
				$_SESSION[$this->__loginIndexInSession] = true;
				return true;
			}else 
			{
				return false;
			}
		}
	}
?>