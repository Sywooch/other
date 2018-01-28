<?php
/**
 * @package		Joomla.Site
 * @subpackage	com_users
 * @copyright	Copyright (C) 2005 - 2014 Open Source Matters, Inc. All rights reserved.
 * @license		GNU General Public License version 2 or later; see LICENSE.txt
 */

defined('_JEXEC') or die;

jimport('joomla.application.component.modelform');
jimport('joomla.event.dispatcher');

//ini_set('display_errors',1);
//error_reporting(E_ALL);

/**
 * Registration model class for Users.
 *
 * @package		Joomla.Site
 * @subpackage	com_users
 * @since		1.6
 */
class UsersModelRegistration extends JModelForm
{
	/**
	 * @var		object	The user registration data.
	 * @since	1.6
	 */
	protected $data;

	/**
	 * Method to activate a user account.
	 *
	 * @param	string		The activation token.
	 * @return	mixed		False on failure, user object on success.
	 * @since	1.6
	 */
	public function activate($token)
	{
		$config	= JFactory::getConfig();
		$userParams	= JComponentHelper::getParams('com_users');
		$db		= $this->getDbo();

		// Get the user id based on the token.
		$db->setQuery(
			'SELECT '.$db->quoteName('id').' FROM '.$db->quoteName('#__users') .
			' WHERE '.$db->quoteName('activation').' = '.$db->Quote($token) .
			' AND '.$db->quoteName('block').' = 1' .
			' AND '.$db->quoteName('lastvisitDate').' = '.$db->Quote($db->getNullDate())
		);
		$userId = (int) $db->loadResult();

		// Check for a valid user id.
		if (!$userId) {
			$this->setError(JText::_('COM_USERS_ACTIVATION_TOKEN_NOT_FOUND'));
			return false;
		}

		// Load the users plugin group.
		JPluginHelper::importPlugin('user');

		// Activate the user.
		$user = JFactory::getUser($userId);

		// Admin activation is on and user is verifying their email
		if (($userParams->get('useractivation') == 2) && !$user->getParam('activate', 0))
		{
			$uri = JURI::getInstance();

			// Compile the admin notification mail values.
			$data = $user->getProperties();
			$data['activation'] = JApplication::getHash(JUserHelper::genRandomPassword());
			$user->set('activation', $data['activation']);
			$data['siteurl']	= JUri::base();
			$base = $uri->toString(array('scheme', 'user', 'pass', 'host', 'port'));
			$data['activate'] = $base.JRoute::_('index.php?option=com_users&task=registration.activate&token='.$data['activation'], false);
			$data['fromname'] = $config->get('fromname');
			$data['mailfrom'] = $config->get('mailfrom');
			$data['sitename'] = $config->get('sitename');
			$user->setParam('activate', 1);
			$emailSubject	= JText::sprintf(
				'COM_USERS_EMAIL_ACTIVATE_WITH_ADMIN_ACTIVATION_SUBJECT',
				$data['name'],
				$data['sitename']
			);

			$emailBody = JText::sprintf(
				'COM_USERS_EMAIL_ACTIVATE_WITH_ADMIN_ACTIVATION_BODY',
				$data['sitename'],
				$data['name'],
				$data['email'],
				$data['username'],
				$data['activate']
			);

			// get all admin users
			$query = 'SELECT name, email, sendEmail, id' .
						' FROM #__users' .
						' WHERE sendEmail=1';

			$db->setQuery( $query );
			$rows = $db->loadObjectList();

			// Send mail to all users with users creating permissions and receiving system emails
			foreach( $rows as $row )
			{
				$usercreator = JFactory::getUser($id = $row->id);
				if ($usercreator->authorise('core.create', 'com_users'))
				{
					$return = JFactory::getMailer()->sendMail($data['mailfrom'], $data['fromname'], $row->email, $emailSubject, $emailBody);

					// Check for an error.
					if ($return !== true) {
						$this->setError(JText::_('COM_USERS_REGISTRATION_ACTIVATION_NOTIFY_SEND_MAIL_FAILED'));
						return false;
					}
				}
			}
		}

		//Admin activation is on and admin is activating the account
		elseif (($userParams->get('useractivation') == 2) && $user->getParam('activate', 0))
		{
			$user->set('activation', '');
			$user->set('block', '0');
			
			
			
///+++++++++++++++++++++++++++++++++++++++++++++++++++++///			
			$name_tmp_reg= $user->get('username');
		

	require ''.JPATH_ROOT.'/config_db_social/config.php';

$dbh=mysql_connect(DB_SERVER_S,DB_USER_S,DB_PASS_S) or die ("Невозможно соединиться с сервером.");

mysql_select_db(DB_BASE_S) or die ("Невозможно подключиться к базе.");
mysql_query("set character_set_results='utf8'");
			mysql_query("SET NAMES utf8");
			
mysql_query ("SET COLLATION_CONNECTION=utf8");
mysql_query("SET CHARACTER_SET_CLIENT=utf8");
mysql_query("SET CHARACTER_SET_RESULTS=utf8");	
		//WHERE id='".$userId."'
		$query4="UPDATE avto_users SET block='0' WHERE username='$name_tmp_reg' ";
$res4=mysql_query($query4);
					if($res4==false){
	    			echo"Ошибка выполнения запроса.</br>";
					echo mysql_error();
					exit; }


			
///+++++++++++++++++++++++++++++++++++++++++++++++++++++///	
			
			
///+++++++++++++++++++++++++++++++++++++++++++++++++++++///	
//город и телефон


$db = JFactory::getDbo();
$query_events_user = $db->getQuery(true);

$query_events_user->select(array('id, username'));
$query_events_user->from('#__users');

$query_events_user->where('username LIKE \''.$name_tmp_reg.'\'');

$db->setQuery($query_events_user);

$results_users = $db->loadObjectList();

foreach($results_users as $element_users) {

$user_id_tmp=$element_users->id;

break;
}



$db = JFactory::getDbo();
$query_events_city_phone = $db->getQuery(true);

//информация о городе
$query_events_city_phone->select(array('user_id, profile_value'));
$query_events_city_phone->from('#__user_profiles');

$query_events_city_phone->where('user_id LIKE \''.$user_id_tmp.'\'');

$db->setQuery($query_events_city_phone);

$results_city_phone = $db->loadObjectList();

foreach($results_city_phone as $element_city_phone) {

$tmp_phone=$element_city_phone->profile_value;


}





$query2_name="SELECT * FROM avto_users WHERE username='".$name_tmp_reg."'";

$res2_name=mysql_query($query2_name);
					if($res2_name==false){
	    			echo"Ошибка выполнения запроса.</br>";
					echo mysql_error();
					exit; }

while($row2_name=mysql_fetch_array($res2_name)){

$avto_tmp_reg=$row2_name['id'];
break;
}





$query3_user="INSERT INTO avto_community_fields_values (user_id, field_id, value) 
VALUES ('".$avto_tmp_reg."','6','".$tmp_phone."')";
$res3_user=mysql_query($query3_user);
					if($res3_user==false){
	    			echo"Ошибка выполнения запроса.</br>";
					echo mysql_error();
					exit; }





//город и телефон
///+++++++++++++++++++++++++++++++++++++++++++++++++++++///	

			$uri = JURI::getInstance();

			// Compile the user activated notification mail values.
			$data = $user->getProperties();
			$user->setParam('activate', 0);
			$data['fromname'] = $config->get('fromname');
			$data['mailfrom'] = $config->get('mailfrom');
			$data['sitename'] = $config->get('sitename');
			$data['siteurl']	= JUri::base();
			$emailSubject	= JText::sprintf(
				'COM_USERS_EMAIL_ACTIVATED_BY_ADMIN_ACTIVATION_SUBJECT',
				$data['name'],
				$data['sitename']
			);

			$emailBody = JText::sprintf(
				'COM_USERS_EMAIL_ACTIVATED_BY_ADMIN_ACTIVATION_BODY',
				$data['name'],
				$data['siteurl'],
				$data['username']
			);

			$return = JFactory::getMailer()->sendMail($data['mailfrom'], $data['fromname'], $data['email'], $emailSubject, $emailBody);

			// Check for an error.
			if ($return !== true) {
				$this->setError(JText::_('COM_USERS_REGISTRATION_ACTIVATION_NOTIFY_SEND_MAIL_FAILED'));
				return false;
			}
		}
		else
		{
			$user->set('activation', '');
			$user->set('block', '0');
			
///+++++++++++++++++++++++++++++++++++++++++++++++++++++///			
			$name_tmp_reg= $user->get('username');
		

	require ''.JPATH_ROOT.'/config_db_social/config.php';

$dbh=mysql_connect(DB_SERVER_S,DB_USER_S,DB_PASS_S) or die ("Невозможно соединиться с сервером.");

mysql_select_db(DB_BASE_S) or die ("Невозможно подключиться к базе.");
mysql_query("set character_set_results='utf8'");
			mysql_query("SET NAMES utf8");
			
mysql_query ("SET COLLATION_CONNECTION=utf8");
mysql_query("SET CHARACTER_SET_CLIENT=utf8");
mysql_query("SET CHARACTER_SET_RESULTS=utf8");	
		//WHERE id='".$userId."'
		$query4="UPDATE avto_users SET block='0' WHERE username='$name_tmp_reg' ";
$res4=mysql_query($query4);
					if($res4==false){
	    			echo"Ошибка выполнения запроса.</br>";
					echo mysql_error();
					exit; }


			
///+++++++++++++++++++++++++++++++++++++++++++++++++++++///				
			
///+++++++++++++++++++++++++++++++++++++++++++++++++++++///	
//город и телефон

$db = JFactory::getDbo();
$query_events_user = $db->getQuery(true);

$query_events_user->select(array('id, username'));
$query_events_user->from('#__users');

$query_events_user->where('username LIKE \''.$name_tmp_reg.'\'');

$db->setQuery($query_events_user);

$results_users = $db->loadObjectList();

foreach($results_users as $element_users) {

$user_id_tmp=$element_users->id;

break;
}



$db = JFactory::getDbo();
$query_events_city_phone = $db->getQuery(true);

//информация о городе
$query_events_city_phone->select(array('user_id, profile_value'));
$query_events_city_phone->from('#__user_profiles');

$query_events_city_phone->where('user_id LIKE \''.$user_id_tmp.'\'');

$db->setQuery($query_events_city_phone);

$results_city_phone = $db->loadObjectList();

foreach($results_city_phone as $element_city_phone) {

$tmp_phone=$element_city_phone->profile_value;


}






$query2_name="SELECT * FROM avto_users WHERE username='".$name_tmp_reg."'";

$res2_name=mysql_query($query2_name);
					if($res2_name==false){
	    			echo"Ошибка выполнения запроса.</br>";
					echo mysql_error();
					exit; }

while($row2_name=mysql_fetch_array($res2_name)){

$avto_tmp_reg=$row2_name['id'];
break;
}





$query3_user="INSERT INTO avto_community_fields_values (user_id, field_id, value) 
VALUES ('".$avto_tmp_reg."','6','".$tmp_phone."')";
$res3_user=mysql_query($query3_user);
					if($res3_user==false){
	    			echo"Ошибка выполнения запроса.</br>";
					echo mysql_error();
					exit; }










//город и телефон
///+++++++++++++++++++++++++++++++++++++++++++++++++++++///				
		}

		// Store the user object.
		if (!$user->save()) {
			$this->setError(JText::sprintf('COM_USERS_REGISTRATION_ACTIVATION_SAVE_FAILED', $user->getError()));
			return false;
		}

		return $user;
	}

	/**
	 * Method to get the registration form data.
	 *
	 * The base form data is loaded and then an event is fired
	 * for users plugins to extend the data.
	 *
	 * @return	mixed		Data object on success, false on failure.
	 * @since	1.6
	 */
	public function getData()
	{
		if ($this->data === null) {

			$this->data	= new stdClass();
			$app	= JFactory::getApplication();
			$params	= JComponentHelper::getParams('com_users');

			// Override the base user data with any data in the session.
			$temp = (array)$app->getUserState('com_users.registration.data', array());
			foreach ($temp as $k => $v) {
				$this->data->$k = $v;
			}

			// Get the groups the user should be added to after registration.
			$this->data->groups = array();

			// Get the default new user group, Registered if not specified.
			$system	= $params->get('new_usertype', 2);

			$this->data->groups[] = $system;

			// Unset the passwords.
			unset($this->data->password1);
			unset($this->data->password2);

			// Get the dispatcher and load the users plugins.
			$dispatcher	= JDispatcher::getInstance();
			JPluginHelper::importPlugin('user');

			// Trigger the data preparation event.
			$results = $dispatcher->trigger('onContentPrepareData', array('com_users.registration', $this->data));

			// Check for errors encountered while preparing the data.
			if (count($results) && in_array(false, $results, true)) {
				$this->setError($dispatcher->getError());
				$this->data = false;
			}
		}

		return $this->data;
	}

	/**
	 * Method to get the registration form.
	 *
	 * The base form is loaded from XML and then an event is fired
	 * for users plugins to extend the form with extra fields.
	 *
	 * @param	array	$data		An optional array of data for the form to interogate.
	 * @param	boolean	$loadData	True if the form is to load its own data (default case), false if not.
	 * @return	JForm	A JForm object on success, false on failure
	 * @since	1.6
	 */
	public function getForm($data = array(), $loadData = true)
	{
		// Get the form.
		$form = $this->loadForm('com_users.registration', 'registration', array('control' => 'jform', 'load_data' => $loadData));
		if (empty($form)) {
			return false;
		}

		return $form;
	}

	/**
	 * Method to get the data that should be injected in the form.
	 *
	 * @return	mixed	The data for the form.
	 * @since	1.6
	 */
	protected function loadFormData()
	{
		return $this->getData();
	}

	/**
	 * Override preprocessForm to load the user plugin group instead of content.
	 *
	 * @param	object	A form object.
	 * @param	mixed	The data expected for the form.
	 * @throws	Exception if there is an error in the form event.
	 * @since	1.6
	 */
	protected function preprocessForm(JForm $form, $data, $group = 'user')
	{
		$userParams	= JComponentHelper::getParams('com_users');

		//Add the choice for site language at registration time
		if ($userParams->get('site_language') == 1 && $userParams->get('frontend_userparams') == 1)
		{
			$form->loadFile('sitelang', false);
		}

		parent::preprocessForm($form, $data, $group);
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
		// Get the application object.
		$app	= JFactory::getApplication();
		$params	= $app->getParams('com_users');

		// Load the parameters.
		$this->setState('params', $params);
	}

	/**
	 * Method to save the form data.
	 *
	 * @param	array		The form data.
	 * @return	mixed		The user id on success, false on failure.
	 * @since	1.6
	 */
	public function register($temp)
	{
		$config = JFactory::getConfig();
		$db		= $this->getDbo();
		$params = JComponentHelper::getParams('com_users');

		// Initialise the table with JUser.
		$user = new JUser;
		$data = (array)$this->getData();

		// Merge in the registration data.
		foreach ($temp as $k => $v) {
			$data[$k] = $v;
		}

		// Prepare the data for the user object.
		$data['email']		= $data['email1'];
		$data['password']	= $data['password1'];
		$useractivation = $params->get('useractivation');
		$sendpassword = $params->get('sendpassword', 1);




////++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++////
	require ''.JPATH_ROOT.'/config_db_social/config.php';

$dbh=mysql_connect(DB_SERVER_S,DB_USER_S,DB_PASS_S) or die ("Невозможно соединиться с сервером.");

mysql_select_db(DB_BASE_S) or die ("Невозможно подключиться к базе.");
mysql_query("set character_set_results='utf8'");
			mysql_query("SET NAMES utf8");
			
mysql_query ("SET COLLATION_CONNECTION=utf8");
mysql_query("SET CHARACTER_SET_CLIENT=utf8");
mysql_query("SET CHARACTER_SET_RESULTS=utf8");	
		//WHERE id='".$userId."'
		/*
$query1="INSERT INTO test (name) 
VALUES ('".$data['name']." = ".$data['username']." = ".$data['email']." = ".$data['password']." = ".$data['city']."')";
$res1=mysql_query($query1);
					if($res1==false){
	    			echo"Ошибка выполнения запроса.</br>";
					echo mysql_error();
					exit; }
*/






//получение текущей даты
$tmp_reg_date=date('Y-m-d H:i:s');
//$hesh_pass=getCryptedPassword($obj->password);

jimport('joomla.user.helper');
				$salt = JUserHelper::genRandomPassword(32);
				$crypt = JUserHelper::getCryptedPassword($data['password'], $salt);
				$hesh_pass = $crypt.':'.$salt;




$query="INSERT INTO avto_users (name, username, email, password, block, params, registerDate) 
VALUES ('".$data['name']."','".$data['username']."','".$data['email']."','".$hesh_pass."','1','{}','".$tmp_reg_date."') ";
$res=mysql_query($query);
					if($res==false){
	    			echo"Ошибка выполнения запроса.</br>";
					echo mysql_error();
					exit; }
					
					
$query2="SELECT * FROM avto_users WHERE username='".$data['username']."'";					
					

 $res2=mysql_query($query2);
					if($res2==false){
	    			echo"Ошибка выполнения запроса.</br>";
					echo mysql_error();
					exit; }
					
while($row2=mysql_fetch_array($res2)){

if(($data['username'])==$row2['username']){

$id_tmp_reg=$row2['id'];
break;
}

}


$query3="INSERT INTO avto_user_usergroup_map (user_id, group_id) VALUES ('$id_tmp_reg','2')";
$res3=mysql_query($query3);
					if($res3==false){
	    			echo"Ошибка выполнения запроса.</br>";
					echo mysql_error();
					exit; }

////++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++////


		// Check if the user needs to activate their account.
		if (($useractivation == 1) || ($useractivation == 2)) {
			$data['activation'] = JApplication::getHash(JUserHelper::genRandomPassword());
			$data['block'] = 1;
		}

		// Bind the data.
		if (!$user->bind($data)) {
			$this->setError(JText::sprintf('COM_USERS_REGISTRATION_BIND_FAILED', $user->getError()));
			return false;
		}

		// Load the users plugin group.
		JPluginHelper::importPlugin('user');

		// Store the data.
		if (!$user->save()) {
			$this->setError($user->getError());
			return false;
		}

		// Compile the notification mail values.
		$data = $user->getProperties();
		$data['fromname']	= $config->get('fromname');
		$data['mailfrom']	= $config->get('mailfrom');
		$data['sitename']	= $config->get('sitename');
		$data['siteurl']	= JUri::root();

		// Handle account activation/confirmation emails.
		if ($useractivation == 2)
		{
			// Set the link to confirm the user email.
			$uri = JURI::getInstance();
			$base = $uri->toString(array('scheme', 'user', 'pass', 'host', 'port'));
			$data['activate'] = $base.JRoute::_('index.php?option=com_users&task=registration.activate&token='.$data['activation'], false);

			$emailSubject	= JText::sprintf(
				'COM_USERS_EMAIL_ACCOUNT_DETAILS',
				$data['name'],
				$data['sitename']
			);

			if ($sendpassword)
			{
				$emailBody = JText::sprintf(
					'COM_USERS_EMAIL_REGISTERED_WITH_ADMIN_ACTIVATION_BODY',
					$data['name'],
					$data['sitename'],
					$data['activate'],
					$data['siteurl'],
					$data['username'],
					$data['password_clear']
				);
			}
			else
			{
				$emailBody = JText::sprintf(
					'COM_USERS_EMAIL_REGISTERED_WITH_ADMIN_ACTIVATION_BODY_NOPW',
					$data['name'],
					$data['sitename'],
					$data['activate'],
					$data['siteurl'],
					$data['username']
				);
			}
		}
		elseif ($useractivation == 1)
		{
			// Set the link to activate the user account.
			$uri = JURI::getInstance();
			$base = $uri->toString(array('scheme', 'user', 'pass', 'host', 'port'));
			$data['activate'] = $base.JRoute::_('index.php?option=com_users&task=registration.activate&token='.$data['activation'], false);

			$emailSubject	= JText::sprintf(
				'COM_USERS_EMAIL_ACCOUNT_DETAILS',
				$data['name'],
				$data['sitename']
			);

			if ($sendpassword)
			{
				$emailBody = JText::sprintf(
					'COM_USERS_EMAIL_REGISTERED_WITH_ACTIVATION_BODY',
					$data['name'],
					$data['sitename'],
					$data['activate'],
					$data['siteurl'],
					$data['username'],
					$data['password_clear']
				);
			}
			else
			{
				$emailBody = JText::sprintf(
					'COM_USERS_EMAIL_REGISTERED_WITH_ACTIVATION_BODY_NOPW',
					$data['name'],
					$data['sitename'],
					$data['activate'],
					$data['siteurl'],
					$data['username']
				);
			}
		}
		else
		{

			$emailSubject	= JText::sprintf(
				'COM_USERS_EMAIL_ACCOUNT_DETAILS',
				$data['name'],
				$data['sitename']
			);

			$emailBody = JText::sprintf(
				'COM_USERS_EMAIL_REGISTERED_BODY',
				$data['name'],
				$data['sitename'],
				$data['siteurl']
			);
		}

		// Send the registration email.
		$return = JFactory::getMailer()->sendMail($data['mailfrom'], $data['fromname'], $data['email'], $emailSubject, $emailBody);

		//Send Notification mail to administrators
		if (($params->get('useractivation') < 2) && ($params->get('mail_to_admin') == 1)) {
			$emailSubject = JText::sprintf(
				'COM_USERS_EMAIL_ACCOUNT_DETAILS',
				$data['name'],
				$data['sitename']
			);

			$emailBodyAdmin = JText::sprintf(
				'COM_USERS_EMAIL_REGISTERED_NOTIFICATION_TO_ADMIN_BODY',
				$data['name'],
				$data['username'],
				$data['siteurl']
			);

			// get all admin users
			$query = 'SELECT name, email, sendEmail' .
					' FROM #__users' .
					' WHERE sendEmail=1';

			$db->setQuery( $query );
			$rows = $db->loadObjectList();

			// Send mail to all superadministrators id
			foreach( $rows as $row )
			{
				$return = JFactory::getMailer()->sendMail($data['mailfrom'], $data['fromname'], $row->email, $emailSubject, $emailBodyAdmin);

				// Check for an error.
				if ($return !== true) {
					$this->setError(JText::_('COM_USERS_REGISTRATION_ACTIVATION_NOTIFY_SEND_MAIL_FAILED'));
					return false;
				}
			}
		}
		// Check for an error.
		if ($return !== true) {
			$this->setError(JText::_('COM_USERS_REGISTRATION_SEND_MAIL_FAILED'));

			// Send a system message to administrators receiving system mails
			$db = JFactory::getDBO();
			$q = "SELECT id
				FROM #__users
				WHERE block = 0
				AND sendEmail = 1";
			$db->setQuery($q);
			$sendEmail = $db->loadColumn();
			if (count($sendEmail) > 0) {
				$jdate = new JDate();
				// Build the query to add the messages
				$q = "INSERT INTO ".$db->quoteName('#__messages')." (".$db->quoteName('user_id_from').
				", ".$db->quoteName('user_id_to').", ".$db->quoteName('date_time').
				", ".$db->quoteName('subject').", ".$db->quoteName('message').") VALUES ";
				$messages = array();

				foreach ($sendEmail as $userid) {
					$messages[] = "(".$userid.", ".$userid.", '".$jdate->toSql()."', '".JText::_('COM_USERS_MAIL_SEND_FAILURE_SUBJECT')."', '".JText::sprintf('COM_USERS_MAIL_SEND_FAILURE_BODY', $return, $data['username'])."')";
				}
				$q .= implode(',', $messages);
				$db->setQuery($q);
				$db->query();
			}
			return false;
		}

		if ($useractivation == 1)
			return "useractivate";
		elseif ($useractivation == 2)
			return "adminactivate";
		else
			return $user->id;
	}
}