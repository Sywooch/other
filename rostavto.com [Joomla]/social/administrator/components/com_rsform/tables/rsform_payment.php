<?php
/**
* @version 1.4.0
* @package RSform!Pro 1.4.0
* @copyright (C) 2007-2011 www.rsjoomla.com
* @license GPL, http://www.gnu.org/copyleft/gpl.html
*/
defined('_JEXEC') or die('Restricted access');

class TableRSForm_Payment extends JTable
{
	/**
	 * Primary Key
	 *
	 * @var int
	 */
	var $form_id = null;
	
	var $params = null;
	
	/**
	 * Constructor
	 *
	 * @param object Database connector object
	 */
	function TableRSForm_Payment(& $db)
	{
		parent::__construct('#__rsform_payment', 'form_id', $db);
	}
}