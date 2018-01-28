<?php
/**
* @version 1.3.0
* @package RSform!Pro 1.3.0
* @copyright (C) 2007-2010 www.rsjoomla.com
* @license GPL, http://www.gnu.org/copyleft/gpl.html
* @Special thanks to http://www.jiliko.net for prodiving improvements to this plugin.
*/

// no direct access
defined( '_JEXEC' ) or die( 'Restricted access' );

jimport( 'joomla.plugin.plugin' );

/**
 * RSForm! Pro system plugin
 */
class plgSystemRSFPConstantContact extends JPlugin
{
	/**
	 * Constructor
	 *
	 * For php4 compatibility we must not use the __constructor as a constructor for plugins
	 * because func_get_args ( void ) returns a copy of all passed arguments NOT references.
	 * This causes problems with cross-referencing necessary for the observer design pattern.
	 *
	 * @access	protected
	 * @param	object	$subject The object to observe
	 * @param 	array   $config  An array that holds the plugin configuration
	 * @since	1.0
	 */
	function plgSystemRSFPConstantContact(&$subject, $config)
	{
		parent::__construct($subject, $config);
	}
	
	function canRun()
	{
		if (class_exists('RSFormProHelper')) return true;
		
		$helper = JPATH_ADMINISTRATOR.'/components/com_rsform/helpers/rsform.php';
		if (file_exists($helper))
		{
			require_once $helper;
			RSFormProHelper::readConfig();
			return true;
		}
		
		return false;
	}
	
	function rsfp_onFormSave($form)
	{
		$post = JRequest::get('post', JREQUEST_ALLOWRAW);
		$post['form_id'] = $post['formId'];
		
		$row = JTable::getInstance('RSForm_ConstantContact', 'Table');
		if (!$row)
			return;
		if (!$row->bind($post))
		{
			JError::raiseWarning(500, $row->getError());
			return false;
		}
		
		$row->cc_merge_vars = serialize($post['merge_vars']);
		
		$db = JFactory::getDBO();
		$db->setQuery("SELECT form_id FROM #__rsform_constantcontact WHERE form_id='".(int) $post['form_id']."'");
		if (!$db->loadResult())
		{
			$db->setQuery("INSERT INTO #__rsform_constantcontact SET form_id='".(int) $post['form_id']."'");
			$db->execute();
		}
		
		if ($row->store())
		{
			return true;
		}
		else
		{
			JError::raiseWarning(500, $row->getError());
			return false;
		}
	}
	
	function rsfp_bk_onAfterShowFormEditTabs()
	{
		$formId = JRequest::getInt('formId');
		
		$lang = JFactory::getLanguage();
		$lang->load('plg_system_rsfpconstantcontact');
		
		$row = JTable::getInstance('RSForm_ConstantContact', 'Table');
		if (!$row) return;
		$row->load($formId);
		$row->cc_merge_vars = @unserialize($row->cc_merge_vars);
		if ($row->cc_merge_vars === false)
			$row->cc_merge_vars = array();
		
		require_once JPATH_ADMINISTRATOR.'/components/com_rsform/helpers/ccapi.php';
		$constantcontact = new RSFConstantContact();
		
		// Fields
		$fields_array = $this->_getFields($formId);
		$fields = array();
		$fields[] = JHTML::_('select.option', '', JText::_('RSFP_CC_IGNORE'));
		foreach ($fields_array as $field)
			$fields[] = JHTML::_('select.option', $field, $field);
		
		// Action
		$cc_action = array(
			JHTML::_('select.option', 1, JText::_('RSFP_CC_ACTION_SUBSCRIBE')),
			JHTML::_('select.option', 0, JText::_('RSFP_CC_ACTION_UNSUBSCRIBE')),
			JHTML::_('select.option', 2, JText::_('RSFP_CC_LET_USER_DECIDE'))
		);
		$lists['cc_action'] = JHTML::_('select.genericlist', $cc_action, 'cc_action', 'onchange="rsfp_changeCcAction(this);"', 'value', 'text', $row->cc_action);
		
		// Action Field
		$lists['cc_action_field'] = JHTML::_('select.genericlist', $fields, 'cc_action_field', $row->cc_action != 2 ? 'disabled="disabled"' : '', 'value', 'text', $row->cc_action_field);
		
		// Email Type
		$cc_email_type = array(
			JHTML::_('select.option', 'HTML', JText::_('RSFP_CC_HTML')),
			JHTML::_('select.option', 'Text', JText::_('RSFP_CC_TEXT')),
			JHTML::_('select.option', 'user', JText::_('RSFP_CC_LET_USER_DECIDE'))
		);
		$lists['cc_email_type'] = JHTML::_('select.genericlist', $cc_email_type, 'cc_email_type', 'onchange="rsfp_changeCcEmailType(this);"', 'value', 'text', $row->cc_email_type);
		
		// Email Type Field
		$lists['cc_email_type_field'] = JHTML::_('select.genericlist', $fields, 'cc_email_type_field', $row->cc_email_type != 'user' ? 'disabled="disabled"' : '', 'value', 'text', $row->cc_email_type_field);
		
		// Constant Contact Lists
		$results = $constantcontact->getLists('',true);
		$cc_lists = array(
			JHTML::_('select.option', '0', JText::_('RSFP_PLEASE_SELECT_LIST'))
		);
		if (!empty($results))
			foreach ($results as $result)
				$cc_lists[] = JHTML::_('select.option', $result['id'], $result['title']);
		$lists['cc_list_id'] = JHTML::_('select.genericlist', $cc_lists, 'cc_list_id', 'onchange="rsfp_showCcVars(this.value)"', 'value', 'text', $row->cc_list_id);
		
		// Merge Vars
		$merge_vars = array("email_address" => JText::_('RSFP_CC_EMAIL_ADDRESS'),"first_name" => JText::_('RSFP_CC_FIRSTNAME'),"last_name" => JText::_('RSFP_CC_LASTNAME'),
							"middle_name" => JText::_('RSFP_CC_MIDDLENAME'),"home_number" => JText::_('RSFP_CC_HOMEPHONE'),"address_line_1" => JText::_('RSFP_CC_ADDR1'),
							"address_line_2" => JText::_('RSFP_CC_ADDR2'),"address_line_3" => JText::_('RSFP_CC_ADDR3'),"city_name" => JText::_('RSFP_CC_CITY'),
							"state_code" => JText::_('RSFP_CC_STATECODE'),
							"state_name" => JText::_('RSFP_CC_STATENAME'),"country_code" => JText::_('RSFP_CC_COUNTRYCODE'),"zip_code" => JText::_('RSFP_CC_POSTALCODE'),
							"sub_zip_code" => JText::_('RSFP_CC_SUBPOSTALCODE'),"notes" => JText::_('RSFP_CC_NOTES'),"company_name" => JText::_('RSFP_CC_COMPANYNAME'),
							"job_title" => JText::_('RSFP_CC_JOBTITLE'),"work_number" => JText::_('RSFP_CC_WORKPHONE'),
							"CustomField1" => JText::_('RSFP_CC_CF1'),"CustomField2" => JText::_('RSFP_CC_CF2'),"CustomField3" => JText::_('RSFP_CC_CF3'),"CustomField4" => JText::_('RSFP_CC_CF4'),
							"CustomField5" => JText::_('RSFP_CC_CF5'),"CustomField6" => JText::_('RSFP_CC_CF6'),"CustomField7" => JText::_('RSFP_CC_CF7'),
							"CustomField8" => JText::_('RSFP_CC_CF8'),"CustomField9" => JText::_('RSFP_CC_CF9'),"CustomField10" => JText::_('RSFP_CC_CF10'),
							"CustomField11" => JText::_('RSFP_CC_CF11'),"CustomField12" => JText::_('RSFP_CC_CF12'),"CustomField13" => JText::_('RSFP_CC_CF13'),
							"CustomField14" => JText::_('RSFP_CC_CF14'),"CustomField15" => JText::_('RSFP_CC_CF15'));
		
		$lists['fields'] = array();
		if (is_array($merge_vars))
			foreach ($merge_vars as $merge_var => $title)
			{
				$lists['fields'][$merge_var] = JHTML::_('select.genericlist', $fields, 'merge_vars['.$merge_var.']', null, 'value', 'text', isset($row->cc_merge_vars[$merge_var]) ? $row->cc_merge_vars[$merge_var] : null);
			}
		
		
		$lists['cc_delete_member'] = RSFormProHelper::renderHTML('select.booleanlist','cc_delete_member','class="inputbox"',$row->cc_delete_member);		
		$lists['published'] = RSFormProHelper::renderHTML('select.booleanlist','cc_published','class="inputbox"',$row->cc_published);
		
		echo '<div id="constantcontactdiv">';
			include JPATH_ADMINISTRATOR.'/components/com_rsform/helpers/constantcontact.php';
		echo '</div>';
	}
	
	function rsfp_bk_onAfterShowFormEditTabsTab()
	{
		$lang = JFactory::getLanguage();
		$lang->load('plg_system_rsfpconstantcontact');
		
		echo '<li><a href="javascript: void(0);" id="constantcontact"><span>'.JText::_('RSFP_CONSTANTCONTACT_INTEGRATION').'</span></a></li>';
	}
	
	function rsfp_f_onAfterFormProcess($args)
	{
		$db = JFactory::getDBO();
		
		$formId = (int) $args['formId'];
		$SubmissionId = (int) $args['SubmissionId'];
		
		$db->setQuery("SELECT * FROM #__rsform_constantcontact WHERE `form_id`='".$formId."' AND `cc_published`='1'");
		if ($row = $db->loadObject())
		{
			if (!$row->cc_list_id) return;
			
			require_once JPATH_ADMINISTRATOR.'/components/com_rsform/helpers/ccapi.php';
			$constantcontact = new RSFConstantContact();			
			
			list($replace, $with) = RSFormProHelper::getReplacements($SubmissionId);
			
			$row->cc_merge_vars = @unserialize($row->cc_merge_vars);
			if ($row->cc_merge_vars === false)
				$row->cc_merge_vars = array();
			
			if (!isset($row->cc_merge_vars['email_address']))
				return;
			
			$form = JRequest::getVar('form');
			
			$email_address = @$form[$row->cc_merge_vars['email_address']];
			
			$merge_vars = array();
			$merge_vars['email_address'] = $email_address;
			foreach ($row->cc_merge_vars as $tag => $field)
			{
				if (empty($tag)) continue;
				if ($tag == 'email_address') continue;
				
				if (!isset($form[$field]))
					$form[$field] = '';
				
				if (is_array($form[$field]))
				{
					array_walk($form[$field], array('plgSystemRSFPConstantContact', '_escapeCommas'));
					$form[$field] = implode(',', $form[$field]);
				}
				
				if (strncmp($tag, 'CustomField', strlen('CustomField')) === 0)
					$merge_vars['custom_fields'][substr($tag, strlen('CustomField'), strlen($tag)-1)] = $form[$field];
				else
					$merge_vars[$tag] = $form[$field];
			}
			
			// Email Type
			$email_type = $row->cc_email_type;
			$valid = array('HTML', 'Text');
			if ($row->cc_email_type == 'user')
				$email_type = isset($form[$row->cc_email_type_field]) && in_array(strtolower(trim($form[$row->cc_email_type_field])), $valid) ? $form[$row->cc_email_type_field] : 'HTML';
			
			$merge_vars['mail_type'] = $email_type;
			
			$delete_member = $row->cc_delete_member;
			$list_id = $row->cc_list_id;
			$merge_vars['lists'][] = $list_id;
			
			// Subscribe action - Subscribe, Unsubscribe or Let the user choose
			//						true, 		false,			null
			$subscribe = true;
			if ($row->cc_action == 1)
				$subscribe = true;
			elseif ($row->cc_action == 0)
				$subscribe = false;
			elseif ($row->cc_action == 2 && isset($form[$row->cc_action_field]))
			{
				$subscribe = null;
				if (is_array($form[$row->cc_action_field]))
					foreach ($form[$row->cc_action_field] as $i => $value)
					{
						$value = strtolower(trim($value));
						if ($value == 'subscribe')
						{
							$subscribe = true;
							break;
						}
						elseif ($value == 'unsubscribe')
						{
							$subscribe = false;
							break;
						}
					}
				else
				{
					$form[$row->cc_action_field] = strtolower(trim($form[$row->cc_action_field]));
					if ($form[$row->cc_action_field] == 'subscribe')
						$subscribe = true;
					elseif ($form[$row->cc_action_field] == 'unsubscribe')
						$subscribe = false;
					else
						$subscribe = null;
				}
			}
			
			if ($subscribe)
			{
				if (!$constantcontact->subscriberExists($email_address,$list_id))
				{
					//The email is not a subscriber to the list but it can be subscriber to another list or in removed state
					$contactId = $constantcontact->subscriberExists($email_address, null);
					
					//If that's the case
					if($contactId) {
						//Retrieving subscriber information (mandatory)
						$contact = $constantcontact->getSubscriberDetails($email_address);
						//Adding the list to the existing contact list
						$contact['lists'][] = $list_id;
						$xml = $constantcontact->createContactXML($contact['id'], $contact);
						$code = $constantcontact->editSubscriber($contact['id'], $xml);
					//If not, we create the contact and the subscription
					} else {
						$xml = $constantcontact->createContactXML(null,$merge_vars);
						$code = $constantcontact->addSubscriber($xml);
					}
				}
			}
			elseif ($subscribe === false)
			{
				if ($delete_member)
					$constantcontact->removeSubscriber($email_address);
				else
					$constantcontact->deleteSubscriber($email_address);
			}
		}
	}
	
	function rsfp_bk_onAfterShowConfigurationTabs($tabs)
	{
		$lang = JFactory::getLanguage();
		$lang->load('plg_system_rsfpconstantcontact');
		
		$tabs->addTitle(JText::_('Constant Contact'), 'form-constantcontact');
		$tabs->addContent($this->constantContactConfigurationScreen());
	}
	
	function constantContactConfigurationScreen()
	{
		ob_start();
		
		?>
		<div id="page-recaptcha">
			<table class="admintable">
				<tr>
					<td width="200" style="width: 200px;" align="right" class="key"><label for="ccusername"><span class="hasTip" title="<?php echo JText::_('RSFP_CC_LOGIN_DESC'); ?>"><?php echo JText::_( 'RSFP_CC_LOGIN' ); ?></span></label></td>
					<td><input type="text" name="rsformConfig[cc.username]" id="ccusername" value="<?php echo RSFormProHelper::htmlEscape(RSFormProHelper::getConfig('cc.username')); ?>" size="50" maxlength="100"></td>
				</tr>
				<tr>
					<td width="200" style="width: 200px;" align="right" class="key"><label for="ccpass"><span class="hasTip" title="<?php echo JText::_('RSFP_CC_PASS_DESC'); ?>"><?php echo JText::_( 'RSFP_CC_PASS' ); ?></span></label></td>
					<td><input type="password" name="rsformConfig[cc.password]" id="ccpass" value="<?php echo RSFormProHelper::htmlEscape(RSFormProHelper::getConfig('cc.password')); ?>" size="50" maxlength="100"></td>
				</tr>
				<tr>
					<td width="200" style="width: 200px;" align="right" class="key"><label for="cckey"><span class="hasTip" title="<?php echo JText::_('RSFP_CC_API_KEY_DESC'); ?>"><?php echo JText::_( 'RSFP_CC_API_KEY' ); ?></span></label></td>
					<td><input type="text" name="rsformConfig[cc.key]" id="cckey" value="<?php echo RSFormProHelper::htmlEscape(RSFormProHelper::getConfig('cc.key')); ?>" size="100" maxlength="100"></td>
				</tr>
			</table>
		</div>
		<?php
		
		$contents = ob_get_contents();
		ob_end_clean();
		return $contents;
	}
	
	function _getFields($formId)
	{
		$db = JFactory::getDBO();
		
		$db->setQuery("SELECT p.PropertyValue FROM #__rsform_components c LEFT JOIN #__rsform_properties p ON (c.ComponentId=p.ComponentId) WHERE c.FormId='".(int) $formId."' AND p.PropertyName='NAME' ORDER BY c.Order");
		return $db->loadColumn();
	}
	
	function _escapeCommas(&$item)
	{
		$item = str_replace(',', '\,', $item);
	}
}