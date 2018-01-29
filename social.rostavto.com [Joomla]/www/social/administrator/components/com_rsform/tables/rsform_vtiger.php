<?php
/**
* @version 1.4.0
* @package RSform!Pro 1.4.0
* @copyright (C) 2007-2011 www.rsjoomla.com
* @license GPL, http://www.gnu.org/copyleft/gpl.html
*/
defined('_JEXEC') or die('Restricted access');

class TableRSForm_vTiger extends JTable
{
	/**
	 * Primary Key
	 *
	 * @var int
	 */
	var $form_id = null;
	
	var $vt_leadsource = null;
    var $vt_leadstatus = null;
    var $vt_salutationtype = null;
	var $vt_firstname = null;
	var $vt_lastname = null;
	var $vt_designation = null;
	var $vt_company = null;
	var $vt_email = null;
	var $vt_phone = null;
	var $vt_lane = null;
	var $vt_city = null;
	var $vt_state = null;
	var $vt_code = null;
	var $vt_country = null;
	var $vt_industry = null;
	var $vt_description = null;
	var $vt_mobile = null;
	var $vt_fax = null;
	var $vt_website = null;
	var $vt_annualrevenue = null;
	var $vt_noofemployees = null;
	var $vt_custom_fields = null;
	var $vt_pobox = null;
	var $vt_rating = null;
	var $vt_secondaryemail = null;
	
	var $vt_published = 0;
    var $vt_debug = null;
	var $vt_accesskey = 0;
    var $vt_username = 0;
    var $vt_hostname = 0;
	var $vt_debugEmail = null;
		
	/**
	 * Constructor
	 *
	 * @param object Database connector object
	 */
	function TableRSForm_vTiger(& $db)
	{
		parent::__construct('#__rsform_vtiger', 'form_id', $db);
	}
}