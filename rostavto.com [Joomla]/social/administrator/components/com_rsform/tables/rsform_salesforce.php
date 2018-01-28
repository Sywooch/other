<?php
/**
* @version 1.4.0
* @package RSform!Pro 1.4.0
* @copyright (C) 2007-2011 www.rsjoomla.com
* @license GPL, http://www.gnu.org/copyleft/gpl.html
*/
defined('_JEXEC') or die('Restricted access');

class TableRSForm_Salesforce extends JTable
{
	/**
	 * Primary Key
	 *
	 * @var int
	 */
	var $form_id = null;
	
	var $slsf_lead_source = null;
	var $slsf_first_name = null;
	var $slsf_last_name = null;
	var $slsf_title = null;
	var $slsf_company = null;
	var $slsf_email = null;
	var $slsf_phone = null;
	var $slsf_street = null;
	var $slsf_city = null;
	var $slsf_state = null;
	var $slsf_zip = null;
	var $slsf_country = null;
	var $slsf_debug = null;
	var $slsf_oid = 0;
	var $slsf_debugEmail = null;
	var $slsf_industry = null;
	var $slsf_description = null;
	var $slsf_mobile = null;
	var $slsf_fax = null;
	var $slsf_website = null;
	var $slsf_salutation = null;
	var $slsf_revenue = null;
	var $slsf_employees = null;
	var $slsf_custom_fields = null;
	var $slsf_campaign_id = null;
	var $slsf_donotcall = null;
	var $slsf_emailoptout = null;
	var $slsf_faxoptout = null;
	
	var $slsf_published = 0;
		
	/**
	 * Constructor
	 *
	 * @param object Database connector object
	 */
	function TableRSForm_Salesforce(& $db)
	{
		parent::__construct('#__rsform_salesforce', 'form_id', $db);
	}
}