<?php
/**
 * 
 * 
 */

// no direct access 2
defined('_REXEC') or die;

/**
 * Retina main Logging Plugin
 *
 * @package		retina.Plugin
 * @subpackage	main.log
 */
class  plgmainLog extends JPlugin
{
	function onUserLoginFailure($response)
	{
		$log = JLog::getInstance();
		$errorlog = array();

		switch($response['status'])
		{
			case JAuthentication::STATUS_SUCCESS :
			{
				$errorlog['status']  = $response['type'] . " CANCELED: ";
				$errorlog['comment'] = $response['error_message'];
				$log->addEntry($errorlog);
			} break;

			case JAuthentication::STATUS_FAILURE :
			{
				$errorlog['status']  = $response['type'] . " FAILURE: ";
				if ($this->params->get('log_username', 0)) {
					$errorlog['comment'] = $response['error_message'] . ' ("' . $response['username'] . '")';
				}
				else {
					$errorlog['comment'] = $response['error_message'];
				}
				$log->addEntry($errorlog);
			}	break;

			default :
			{
				$errorlog['status']  = $response['type'] . " UNKNOWN ERROR: ";
				$errorlog['comment'] = $response['error_message'];
				$log->addEntry($errorlog);
			}	break;
		}
	}
}
