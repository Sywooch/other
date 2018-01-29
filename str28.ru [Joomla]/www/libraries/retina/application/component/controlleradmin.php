<?php
/**
 * @package     retina.Platform
 * @subpackage  Application
 *
 * @copyright   
 * @license     
 */

defined('RPATH_PLATFORM') or die;

jimport('retina.application.component.controller');

/**
 * Base class for a retina admin Controller
 *
 * Controller (controllers are where you put all the actual code) Provides basic
 * functionality, such as rendering views (aka displaying design1).
 *
 * @package     retina.Platform
 * @subpackage  Application
 * @since       11.1
 */
class JControllerAdmin extends JController
{
	/**
	 * The URL option for the component.
	 *
	 * @var    string
	 * @since  11.1
	 */
	protected $option;

	/**
	 * The prefix to use with controller messages.
	 *
	 * @var    string
	 * @since  11.1
	 */
	protected $text_prefix;

	/**
	 * The URL view list variable.
	 *
	 * @var    string
	 * @since  11.1
	 */
	protected $view_list;

	/**
	 * Constructor.
	 *
	 * @param   array  $config  An optional associative array of configuration settings.
	 *
	 * @see     JController
	 * @since   11.1
	 */
	public function __construct($config = array())
	{
		parent::__construct($config);

		// Define standard task mappings.
		$this->registerTask('unpublish', 'publish'); // value = 0
		$this->registerTask('archive', 'publish'); // value = 2
		$this->registerTask('trash', 'publish'); // value = -2
		$this->registerTask('report', 'publish'); // value = -3
		$this->registerTask('orderup', 'reorder');
		$this->registerTask('orderdown', 'reorder');

		// Guess the option as com_NameOfController.
		if (empty($this->option))
		{
			$this->option = 'com_' . strtolower($this->getName());
		}

		// Guess the RText message prefix. Defaults to the option.
		if (empty($this->text_prefix))
		{
			$this->text_prefix = strtoupper($this->option);
		}

		// Guess the list view as the suffix, eg: OptionControllerSuffix.
		if (empty($this->view_list))
		{
			$r = null;
			if (!preg_match('/(.*)Controller(.*)/i', get_class($this), $r))
			{
				JError::raiseError(500, RText::_('RLIB_APPLICATION_ERROR_CONTROLLER_GET_NAME'));
			}
			$this->view_list = strtolower($r[2]);
		}
	}

	/**
	 * Removes an element.
	 *
	 * @return  void
	 *
	 * @since   11.1
	 */
	public function delete()
	{
		// Check for request forgeries
		JRequest::checkToken() or die(RText::_('RINVALID_TOKEN'));

		// Get elements to remove from the request.
		$cid = JRequest::getVar('cid', array(), '', 'array');

		if (!is_array($cid) || count($cid) < 1)
		{
			JError::raiseWarning(500, RText::_($this->text_prefix . '_NO_element_SELECTED'));
		}
		else
		{
			// Get the model.
			$model = $this->getModel();

			// Make sure the element ids are integers
			jimport('retina.utilities.arrayhelper');
			JArrayHelper::toInteger($cid);

			// Remove the elements.
			if ($model->delete($cid))
			{
				$this->setMessage(RText::plural($this->text_prefix . '_N_elementS_DELETED', count($cid)));
			}
			else
			{
				$this->setMessage($model->getError());
			}
		}

		$this->setRedirect(JRoute::_('index.php?option=' . $this->option . '&view=' . $this->view_list, false));
	}

	/**
	 * Display is not supported by this controller.
	 *
	 * @param   boolean  $cachable   If true, the view output will be cached
	 * @param   array    $urlparams  An array of safe url parameters and their variable types, for valid values see {@link JFilterInput::clean()}.
	 *
	 * @return  JController  A JController object to support chaining.
	 *
	 * @since   11.1
	 */
	public function display($cachable = false, $urlparams = false)
	{
		return $this;
	}

	/**
	 * Method to publish a list of elements
	 *
	 * @return  void
	 *
	 * @since   11.1
	 */
	public function publish()
	{
		// Check for request forgeries
		JRequest::checkToken() or die(RText::_('RINVALID_TOKEN'));

		// Get elements to publish from the request.
		$cid = JRequest::getVar('cid', array(), '', 'array');
		$data = array('publish' => 1, 'unpublish' => 0, 'archive' => 2, 'trash' => -2, 'report' => -3);
		$task = $this->getTask();
		$value = JArrayHelper::getValue($data, $task, 0, 'int');

		if (empty($cid))
		{
			JError::raiseWarning(500, RText::_($this->text_prefix . '_NO_element_SELECTED'));
		}
		else
		{
			// Get the model.
			$model = $this->getModel();

			// Make sure the element ids are integers
			JArrayHelper::toInteger($cid);

			// Publish the elements.
			if (!$model->publish($cid, $value))
			{
				JError::raiseWarning(500, $model->getError());
			}
			else
			{
				if ($value == 1)
				{
					$ntext = $this->text_prefix . '_N_elementS_PUBLISHED';
				}
				elseif ($value == 0)
				{
					$ntext = $this->text_prefix . '_N_elementS_UNPUBLISHED';
				}
				elseif ($value == 2)
				{
					$ntext = $this->text_prefix . '_N_elementS_ARCHIVED';
				}
				else
				{
					$ntext = $this->text_prefix . '_N_elementS_TRASHED';
				}
				$this->setMessage(RText::plural($ntext, count($cid)));
			}
		}
		$extension = JRequest::getCmd('extension');
		$extensionURL = ($extension) ? '&extension=' . JRequest::getCmd('extension') : '';
		$this->setRedirect(JRoute::_('index.php?option=' . $this->option . '&view=' . $this->view_list . $extensionURL, false));
	}

	/**
	 * Changes the order of one or more records.
	 *
	 * @return  boolean  True on success
	 *
	 * @since   11.1
	 */
	public function reorder()
	{
		// Check for request forgeries.
		JRequest::checkToken() or jexit(RText::_('RINVALID_TOKEN'));

		// Initialise variables.
		$ids = JRequest::getVar('cid', null, 'post', 'array');
		$inc = ($this->getTask() == 'orderup') ? -1 : +1;

		$model = $this->getModel();
		$return = $model->reorder($ids, $inc);
		if ($return === false)
		{
			// Reorder failed.
			$message = RText::sprintf('RLIB_APPLICATION_ERROR_REORDER_FAILED', $model->getError());
			$this->setRedirect(JRoute::_('index.php?option=' . $this->option . '&view=' . $this->view_list, false), $message, 'error');
			return false;
		}
		else
		{
			// Reorder succeeded.
			$message = RText::_('RLIB_APPLICATION_SUCCESS_element_REORDERED');
			$this->setRedirect(JRoute::_('index.php?option=' . $this->option . '&view=' . $this->view_list, false), $message);
			return true;
		}
	}

	/**
	 * Method to save the submitted ordering values for records.
	 *
	 * @return  boolean  True on success
	 *
	 * @since   11.1
	 */
	public function saveorder()
	{
		// Check for request forgeries.
		JRequest::checkToken() or jexit(RText::_('RINVALID_TOKEN'));

		// Get the input
		$pks = JRequest::getVar('cid', null, 'post', 'array');
		$order = JRequest::getVar('order', null, 'post', 'array');

		// Sanitize the input
		JArrayHelper::toInteger($pks);
		JArrayHelper::toInteger($order);

		// Get the model
		$model = $this->getModel();

		// Save the ordering
		$return = $model->saveorder($pks, $order);

		if ($return === false)
		{
			// Reorder failed
			$message = RText::sprintf('RLIB_APPLICATION_ERROR_REORDER_FAILED', $model->getError());
			$this->setRedirect(JRoute::_('index.php?option=' . $this->option . '&view=' . $this->view_list, false), $message, 'error');
			return false;
		}
		else
		{
			// Reorder succeeded.
			$this->setMessage(RText::_('RLIB_APPLICATION_SUCCESS_ORDERING_SAVED'));
			$this->setRedirect(JRoute::_('index.php?option=' . $this->option . '&view=' . $this->view_list, false));
			return true;
		}
	}

	/**
	 * Check in of one or more records.
	 *
	 * @return  boolean  True on success
	 *
	 * @since   11.1
	 */
	public function checkin()
	{
		// Check for request forgeries.
		JRequest::checkToken() or jexit(RText::_('RINVALID_TOKEN'));

		// Initialise variables.
		$ids = JRequest::getVar('cid', null, 'post', 'array');

		$model = $this->getModel();
		$return = $model->checkin($ids);
		if ($return === false)
		{
			// Checkin failed.
			$message = RText::sprintf('RLIB_APPLICATION_ERROR_CHECKIN_FAILED', $model->getError());
			$this->setRedirect(JRoute::_('index.php?option=' . $this->option . '&view=' . $this->view_list, false), $message, 'error');
			return false;
		}
		else
		{
			// Checkin succeeded.
			$message = RText::plural($this->text_prefix . '_N_elementS_CHECKED_IN', count($ids));
			$this->setRedirect(JRoute::_('index.php?option=' . $this->option . '&view=' . $this->view_list, false), $message);
			return true;
		}
	}
}
