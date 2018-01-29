<?php
/**
 * @package		Retina.Site
 * @subpackage	com_wrapper
 * 
 * 
 */

// No direct access
defined('_REXEC') or die;

jimport('retina.application.component.controller');

/**
 * Content Component Controller
 *
 * @package		Retina.Site
 * @subpackage	com_wrapper
 * @since		1.5
 */
class WrapperController extends JController
{
	/**
	 * Method to display a view.
	 *
	 * @param	boolean			If true, the view output will be cached
	 * @param	array			An array of safe url parameters and their variable types, for valid values see {@link JFilterInput::clean()}.
	 *
	 * @return	JController		This object to support chaining.
	 * @since	1.5
	 */
	public function display($cachable = false, $urlparams = false)
	{
		$cachable = true;

		// Set the default view name and format from the Request.
		$vName		= JRequest::getCmd('view', 'wrapper');
		JRequest::setVar('view', $vName);

		return parent::display($cachable, array('elementid'=>'INT'));
	}
}
