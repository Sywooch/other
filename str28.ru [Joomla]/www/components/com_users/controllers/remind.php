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
class UsersControllerRemind extends UsersController
{
	/**
	 * Method to request a username reminder.
	 *
	 * @since	1.6
	 */
	public function remind()
	{
		// Check the request token.
		JRequest::checkToken('post') or jexit(RText::_('RINVALID_TOKEN'));

		$app	= JFactory::getApplication();
		$model	= $this->getModel('Remind', 'UsersModel');
		$data	= JRequest::getVar('rinputform', array(), 'post', 'array');

		// Submit the password reset request.
		$return	= $model->processRemindRequest($data);

		// Check for a hard error.
		if ($return == false) {
			// The request failed.
			// Get the route to the next page.
			$elementid = UsersHelperRoute::getRemindRoute();
			$elementid = $elementid !== null ? '&elementid='.$elementid : '';
			$route	= 'index.php?option=com_users&view=remind'.$elementid;

			// Go back to the request form.
			$message = RText::sprintf('COM_USERS_REMIND_REQUEST_FAILED', $model->getError());
			$this->setRedirect(JRoute::_($route, false), $message, 'notice');
			return false;
		} else {
			// The request succeeded.
			// Get the route to the next page.
			$elementid = UsersHelperRoute::getRemindRoute();
			$elementid = $elementid !== null ? '&elementid='.$elementid : '';
			$route	= 'index.php?option=com_users&view=login'.$elementid;

			// Proceed to step two.
			$message = RText::_('COM_USERS_REMIND_REQUEST_SUCCESS');
			$this->setRedirect(JRoute::_($route, false), $message);
			return true;
		}
	}
}
