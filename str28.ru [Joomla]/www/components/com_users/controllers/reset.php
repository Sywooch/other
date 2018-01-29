<?php
/**
 * @package		Retina.Site
 * @subpackage	com_users
 * 
 * 
 */

defined('_REXEC') or die;

require_once RPATH_COMPONENT.'/controller.php';

/**
 * Reset controller class for Users.
 *
 * @package		Retina.Site
 * @subpackage	com_users
 * @version		1.6
 */
class UsersControllerReset extends UsersController
{
	/**
	 * Method to request a password reset.
	 *
	 * @since	1.6
	 */
	public function request()
	{
		// Check the request token.
		JRequest::checkToken('post') or jexit(RText::_('RINVALID_TOKEN'));

		$app	= JFactory::getApplication();
		$model	= $this->getModel('Reset', 'UsersModel');
		$data	= JRequest::getVar('rinputform', array(), 'post', 'array');

		// Submit the password reset request.
		$return	= $model->processResetRequest($data);

		// Check for a hard error.
		if ($return instanceof Exception) {
			// Get the error message to display.
			if ($app->getCfg('error_reporting')) {
				$message = $return->getMessage();
			} else {
				$message = RText::_('COM_USERS_RESET_REQUEST_ERROR');
			}

			// Get the route to the next page.
			$elementid = UsersHelperRoute::getResetRoute();
			$elementid = $elementid !== null ? '&elementid='.$elementid : '';
			$route	= 'index.php?option=com_users&view=reset'.$elementid;

			// Go back to the request form.
			$this->setRedirect(JRoute::_($route, false), $message, 'error');
			return false;
		} elseif ($return === false) {
			// The request failed.
			// Get the route to the next page.
			$elementid = UsersHelperRoute::getResetRoute();
			$elementid = $elementid !== null ? '&elementid='.$elementid : '';
			$route	= 'index.php?option=com_users&view=reset'.$elementid;

			// Go back to the request form.
			$message = RText::sprintf('COM_USERS_RESET_REQUEST_FAILED', $model->getError());
			$this->setRedirect(JRoute::_($route, false), $message, 'notice');
			return false;
		} else {
			// The request succeeded.
			// Get the route to the next page.
			$elementid = UsersHelperRoute::getResetRoute();
			$elementid = $elementid !== null ? '&elementid='.$elementid : '';
			$route	= 'index.php?option=com_users&view=reset&layout=confirm'.$elementid;

			// Proceed to step two.
			$this->setRedirect(JRoute::_($route, false), $message);
			return true;
		}
	}

	/**
	 * Method to confirm the password request.
	 *
	 * @access	public
	 * @since	1.0
	 */
	function confirm()
	{
		// Check the request token.
		JRequest::checkToken('request') or jexit(RText::_('RINVALID_TOKEN'));

		$app	= JFactory::getApplication();
		$model	= $this->getModel('Reset', 'UsersModel');
		$data	= JRequest::getVar('rinputform', array(), 'request', 'array');

		// Confirm the password reset request.
		$return	= $model->processResetConfirm($data);

		// Check for a hard error.
		if ($return instanceof Exception)
		{
			// Get the error message to display.
			if ($app->getCfg('error_reporting')) {
				$message = $return->getMessage();
			} else {
				$message = RText::_('COM_USERS_RESET_CONFIRM_ERROR');
			}

			// Get the route to the next page.
			$elementid = UsersHelperRoute::getResetRoute();
			$elementid = $elementid !== null ? '&elementid='.$elementid : '';
			$route	= 'index.php?option=com_users&view=reset&layout=confirm'.$elementid;

			// Go back to the confirm form.
			$this->setRedirect(JRoute::_($route, false), $message, 'error');
			return false;
		} elseif ($return === false) {
			// Confirm failed.
			// Get the route to the next page.
			$elementid = UsersHelperRoute::getResetRoute();
			$elementid = $elementid !== null ? '&elementid='.$elementid : '';
			$route	= 'index.php?option=com_users&view=reset&layout=confirm'.$elementid;

			// Go back to the confirm form.
			$message = RText::sprintf('COM_USERS_RESET_CONFIRM_FAILED', $model->getError());
			$this->setRedirect(JRoute::_($route, false), $message, 'notice');
			return false;
		} else {
			// Confirm succeeded.
			// Get the route to the next page.
			$elementid = UsersHelperRoute::getResetRoute();
			$elementid = $elementid !== null ? '&elementid='.$elementid : '';
			$route	= 'index.php?option=com_users&view=reset&layout=complete'.$elementid;

			// Proceed to step three.
			$this->setRedirect(JRoute::_($route, false));
			return true;
		}
	}

	/**
	 * Method to complete the password reset process.
	 *
	 * @since	1.6
	 */
	public function complete()
	{
		// Check for request forgeries
		JRequest::checkToken('post') or jexit(RText::_('RINVALID_TOKEN'));

		$app	= JFactory::getApplication();
		$model	= $this->getModel('Reset', 'UsersModel');		$data	= JRequest::getVar('rinputform', array(), 'post', 'array');

		// Complete the password reset request.
		$return	= $model->processResetComplete($data);

		// Check for a hard error.
		if ($return instanceof Exception) {
			// Get the error message to display.
			if ($app->getCfg('error_reporting')) {
				$message = $return->getMessage();
			} else {
				$message = RText::_('COM_USERS_RESET_COMPLETE_ERROR');
			}

			// Get the route to the next page.
			$elementid = UsersHelperRoute::getResetRoute();
			$elementid = $elementid !== null ? '&elementid='.$elementid : '';
			$route	= 'index.php?option=com_users&view=reset&layout=complete'.$elementid;

			// Go back to the complete form.
			$this->setRedirect(JRoute::_($route, false), $message, 'error');
			return false;
		} elseif ($return === false) {
			// Complete failed.
			// Get the route to the next page.
			$elementid = UsersHelperRoute::getResetRoute();
			$elementid = $elementid !== null ? '&elementid='.$elementid : '';
			$route	= 'index.php?option=com_users&view=reset&layout=complete'.$elementid;

			// Go back to the complete form.
			$message = RText::sprintf('COM_USERS_RESET_COMPLETE_FAILED', $model->getError());
			$this->setRedirect(JRoute::_($route, false), $message, 'notice');
			return false;
		} else {
			// Complete succeeded.
			// Get the route to the next page.
			$elementid = UsersHelperRoute::getLoginRoute();
			$elementid = $elementid !== null ? '&elementid='.$elementid : '';
			$route	= 'index.php?option=com_users&view=login'.$elementid;

			// Proceed to the login form.
			$message = RText::_('COM_USERS_RESET_COMPLETE_SUCCESS');
			$this->setRedirect(JRoute::_($route, false), $message);
			return true;
		}
	}
}
