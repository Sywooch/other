<?php
/**
 * @package		Retina.Site
 * @subpackage	com_weblinks
 * 
 * 
 */

// No direct access.
defined('_REXEC') or die;

require_once RPATH_COMPONENT_admin.'/models/weblink.php';

/**
 * Weblinks model.
 *
 * @package		Retina.Site
 * @subpackage	com_weblinks
 * @since		1.6
 */
class WeblinksModelForm extends WeblinksModelWeblink
{
	/**
	 * Get the return URL.
	 *
	 * @return	string	The return URL.
	 * @since	1.6
	 */
	public function getReturnPage()
	{
		return base64_encode($this->getState('return_page'));
	}

	/**
	 * Method to auto-populate the model state.
	 *
	 * Note. Calling getState in this method will result in recursion.
	 *
	 * @since	1.6
	 */
	protected function populateState()
	{
		$app = JFactory::getApplication();

		// Load state from the request.
		$pk = JRequest::getInt('w_id');
		$this->setState('weblink.id', $pk);
		// Add compatibility variable for default naming conventions.
		$this->setState('form.id', $pk);

		$categoryId	= JRequest::getInt('catid');
		$this->setState('weblink.catid', $categoryId);

		$return = JRequest::getVar('return', null, 'default', 'base64');

		if (!JUri::isInternal(base64_decode($return))) {
			$return = null;
		}

		$this->setState('return_page', base64_decode($return));

		// Load the parameters.
		$params	= $app->getParams();
		$this->setState('params', $params);

		$this->setState('layout', JRequest::getCmd('layout'));
	}
}
