<?php
/**
* @version 1.3.0
* @package RSform!Pro 1.3.0
* @copyright (C) 2007-2010 www.rsjoomla.com
* @license GPL, http://www.gnu.org/copyleft/gpl.html
*/

defined('_JEXEC') or die('Restricted access');

class TableRSForm_Akismet extends JTable
{
	/**
	 * Primary Key
	 *
	 * @var int
	 */
	var $form_id = null;
	var $aki_merge_vars = '';
	var $aki_published = 0;
		
	/**
	 * Constructor
	 *
	 * @param object Database connector object
	 */
	function TableRSForm_Akismet(& $db)
	{
		parent::__construct('#__rsform_akismet', 'form_id', $db);
	}
}