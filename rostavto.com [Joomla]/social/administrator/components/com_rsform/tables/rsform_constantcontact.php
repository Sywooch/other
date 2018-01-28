<?php
/**
* @version 1.3.0
* @package RSform!Pro 1.3.0
* @copyright (C) 2007-2010 www.rsjoomla.com
* @license GPL, http://www.gnu.org/copyleft/gpl.html
*/

defined('_JEXEC') or die('Restricted access');

class TableRSForm_ConstantContact extends JTable
{
	/**
	 * Primary Key
	 *
	 * @var int
	 */
	var $form_id = null;
	
	var $cc_list_id = '';
	var $cc_action = 1; // 0 - unsubscribe; 1 - subscribe, 2 - let the user decide
	var $cc_action_field = '';
	var $cc_merge_vars = '';
	var $cc_email_type = 'HTML';
	var $cc_email_type_field = '';
	var $cc_delete_member = 0;	
	var $cc_published = 0;
		
	/**
	 * Constructor
	 *
	 * @param object Database connector object
	 */
	function TableRSForm_ConstantContact(& $db)
	{
		parent::__construct('#__rsform_constantcontact', 'form_id', $db);
	}
}