<?php
/**
* @version 1.4.0
* @package RSform!Pro 1.4.0
* @copyright (C) 2007-2011 www.rsjoomla.com
* @license GPL, http://www.gnu.org/copyleft/gpl.html
*/
// no direct access
defined( '_JEXEC' ) or die( 'Restricted access' );

jimport( 'joomla.plugin.plugin' );

/**
 * RSForm! Pro system plugin
 */
class plgSystemRSFPvTiger extends JPlugin
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
	function plgSystemRSFPvTiger(&$subject, $config)
	{
		parent::__construct($subject, $config);
	}
	
	function rsfp_onFormSave($form)
	{
		$post = JRequest::get('post', JREQUEST_ALLOWRAW);
		$post['form_id'] = $post['formId'];
		
		$row = JTable::getInstance('RSForm_vTiger', 'Table');
		if (!$row)
			return;
		if (!$row->bind($post))
		{
			JError::raiseWarning(500, $row->getError());
			return false;
		}
		
		$db = JFactory::getDBO();
		$db->setQuery("SELECT form_id FROM #__rsform_vtiger WHERE form_id='".(int) $post['form_id']."'");
		if (!$db->loadResult())
		{
			$db->setQuery("INSERT INTO #__rsform_vtiger SET form_id='".(int) $post['form_id']."'");
			$db->execute();
		}
		
		$row->vt_custom_fields = '';
		if (!empty($post['vt_api_name']))
		{
			$row->vt_custom_fields = array();
			for ($i=0; $i<count($post['vt_api_name']); $i++)
			{
				$tmp = new stdClass();
				$tmp->api_name = $post['vt_api_name'][$i];
				$tmp->value = $post['vt_value'][$i];
				
				$row->vt_custom_fields[] = $tmp;
			}
			$row->vt_custom_fields = serialize($row->vt_custom_fields);
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
		$lang->load('plg_system_rsfpvtiger');
		
		$row = JTable::getInstance('RSForm_vTiger', 'Table');
		if (!$row)
			return;
		$row->load($formId);
		$row->vt_custom_fields = !empty($row->vt_custom_fields) ? unserialize($row->vt_custom_fields) : array();
		
		$lists['published'] = RSFormProHelper::renderHTML('select.booleanlist','vt_published','class="inputbox" onclick="enablevTiger(this.value)"',$row->vt_published);
		$lists['debug'] = RSFormProHelper::renderHTML('select.booleanlist','vt_debug','class="inputbox" onclick="enablevTigerDebug(this.value)"',$row->vt_debug);
		
		echo '<div id="vtigerdiv">';
			include JPATH_ADMINISTRATOR.'/components/com_rsform/helpers/vtiger.php';
		echo '</div>';
	}
	
	function rsfp_bk_onAfterShowFormEditTabsTab()
	{
		$lang = JFactory::getLanguage();
		$lang->load('plg_system_rsfpvtiger');
		
		echo '<li><a href="javascript: void(0);" id="vtiger"><span>'.JText::_('RSFP_VTIGER_INTEGRATION').'</span></a></li>';
	}
	
	function rsfp_f_onAfterFormProcess($args)
	{
		$db = JFactory::getDBO();
		$formId = (int) $args['formId'];
		$SubmissionId = (int) $args['SubmissionId'];
		
		$db->setQuery("SELECT * FROM #__rsform_vtiger WHERE `form_id`='".$formId."' AND `vt_published`='1'");
		if ($row = $db->loadObject())
		{
			list($replace, $with) = RSFormProHelper::getReplacements($SubmissionId);
			$replace[] = '\n';
			$with[]	   = "\n";

            foreach ($row as $key => $elem) {
                if ($key != 'vt_custom_fields' && $key != 'vt_username' && $key != 'vt_accesskey' && $key != 'vt_hostname') {
                    $element_array[substr($key, 3)] = str_replace($replace, $with, $elem);
                }
            }
			
			$row->vt_custom_fields = !empty($row->vt_custom_fields) ? unserialize($row->vt_custom_fields) : array();
			
            $username 	= str_replace($replace, $with, $row->vt_username);
            $accessKey 	= str_replace($replace, $with, $row->vt_accesskey);
            $hostname 	= rtrim(str_replace($replace, $with, $row->vt_hostname), '/');
			$debug 		= $row->vt_debug;
			$email 		= $row->vt_debugEmail;
        
            $response = $this->webservice($hostname, $username, $debug, $email, array(
				'operation' => 'getchallenge',
				'username' => $username
			));
            if (!$response['success']) {
				if ($debug)
				{
					JError::raiseWarning(500, $response['error']['message']);
					if ($email)
						$this->sendDebugEmail($email, print_r($response, 1));
				}
					
				return false;
            }
            $token = $response['result']['token'];
			
            $response = $this->webservice($hostname, $username, $debug, $email, array(
                'operation' => 'login',
                'username' => $username,
                'accessKey' => md5($token . $accessKey),
            ), true);
			
            if (!$response['success']) {
				if ($debug)
				{
					JError::raiseWarning(500, $response['error']['message']);
					if ($email)
						$this->sendDebugEmail($email, print_r($response, 1));
				}
				
				return false;
            }
			
            $sessionName = $response['result']['sessionName'];
            $userId = $response['result']['userId'];
            $element_array['assigned_user_id'] =  $userId;
            
			if (!empty($row->vt_custom_fields)) {
				$response = $this->webservice($hostname, $username, $debug, $email, array(
					'operation' => 'describe',
					'sessionName' => $sessionName,
					'elementType' => 'Leads'
				));
				
				if (!$response['success']) {
					if ($debug)
					{
						JError::raiseWarning(500, $response['error']['message']);
						if ($email)
							$this->sendDebugEmail($email, print_r($response, 1));
					}
					
					return false;
				}
				
				// map custom fields
				foreach ($row->vt_custom_fields as $field)
				{
					foreach ($response['result']['fields'] as $vt_field) {
						if (substr($vt_field['name'], 0, 3) == 'cf_' && $vt_field['label'] == $field->api_name) {
							$element_array[$vt_field['name']] = str_replace($replace, $with, $field->value);
							break;
						}
					}
				}
			}
			
            $response = $this->webservice($hostname, $username, $debug, $email, array(
                'operation' => 'create',
                'sessionName' => $sessionName,
                'elementType' => 'Leads',
                'element' => json_encode($element_array)
            ), true);
            if (!$response['success']) {
                if ($debug)
				{
					JError::raiseWarning(500, $response['error']['message']);
					if ($email)
						$this->sendDebugEmail($email, print_r($response, 1));
				}
				
				return false;
            }
            $this->webservice($hostname, $username, $debug, $email, array(
                'operation' => 'logout',
                'sessionName' => $sessionName,
            ), true);
		}
	}
    
    function webservice($hostname, $username, $debug, $email, $data = null, $post = false) {
	
		$url = $hostname."/webservice.php";
		if ($post) {
			$curl = curl_init($url);
			curl_setopt($curl, CURLOPT_POST, true);
            curl_setopt($curl, CURLOPT_POSTFIELDS, $data);
		} else {
			$fields = array();
			foreach ($data as $k => $v)
				$fields[] = urlencode($k).'='.urlencode($v);
			$curl = curl_init($url.'?'.implode('&', $fields));
		}
	
		@curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
		@curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, false);
        @curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        $json = curl_exec($curl);
		if ($error = curl_error($curl))
		{
			if ($debug)
			{
				JError::raiseWarning(500, $error);
				if ($email)
					$this->sendDebugEmail($email, $error);
			}
		}
        curl_close($curl);
        return json_decode($json, true);
    }
	
	function sendDebugEmail($recipient, $body)
	{
		$app 		= JFactory::getApplication();
		$from 		= $app->getCfg('mailfrom');
		$fromname 	= $app->getCfg('fromname');
		$subject	= 'RSForm! Pro - vTiger debug for '.JURI::root();
		
		RSFormProHelper::sendMail($from, $fromname, $recipient, $subject, $body, $mode=0);
	}
}