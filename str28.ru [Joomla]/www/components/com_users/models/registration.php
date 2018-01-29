<?php


defined('_REXEC') or die;

jimport('retina.application.component.modelform');
jimport('retina.event.dispatcher');

/**
 * Регистрация класса модели для пользователей.
 *
 * @package		Retina.Site
 * @subpackage	com_users
 * @since		1.6
 */
class UsersModelRegistration extends JModelForm
{
	/**
	 * @var		object	Регистрационные данные пользователя.
	 * @since	1.6
	 */
	protected $data;

	/**
	 * Метод активации учётной записи пользователя.
	 *
	 * @param	string		Метка активации.
	 * @return	mixed		False в случае ошибки, объект успешно зарегистрированного пользователя.
	 * @since	1.6
	 */
	public function activate($token)//активация пользоваеля
	{
		$config	= JFactory::getConfig();
		$userParams	= JComponentHelper::getParams('com_users');
		$db		= $this->getDbo();

		// Получение идентификатора пользователя на основе маркера.
		$db->setQuery(
			'SELECT '.$db->quoteName('id').' FROM '.$db->quoteName('#__users') .//запрос к таблице _users.
			' WHERE '.$db->quoteName('activation').' = '.$db->Quote($token) .   //
			' AND '.$db->quoteName('block').' = 1' .
			' AND '.$db->quoteName('lastvisitDate').' = '.$db->Quote($db->getNullDate())
		);
		$userId = (int) $db->loadResult();

		// Проверка кода пользователя.
		if (!$userId) {
			$this->setError(RText::_('COM_USERS_ACTIVATION_TOKEN_NOT_FOUND'));
			return false;
		}

		// Загрузка модуля пользовательской группы.
		JPluginHelper::importPlugin('user');

		// Активация пользователя.
		$user = JFactory::getUser($userId);

		// Запуск активации, после чего пользователь должен проверить свою электронную почту.
		if (($userParams->get('useractivation') == 2) && !$user->getParam('activate', 0))
		{
			$uri = JURI::getInstance();

			// Формирование текста письма, высылаемого на электронную почту.
			$data = $user->getProperties();
			$data['activation'] = JApplication::getHash(JUserHelper::genRandomPassword());
			$user->set('activation', $data['activation']);
			$data['siteurl']	= JUri::base();
			$base = $uri->toString(array('scheme', 'user', 'pass', 'host', 'port'));
			$data['activate'] = $base.JRoute::_('index.php?option=com_users&task=registration.activate&token='.$data['activation'], false);//
			//ссылка для активации
			$data['fromname'] = $config->get('fromname');
			$data['mailfrom'] = $config->get('mailfrom');
			$data['sitename'] = $config->get('sitename');
			$user->setParam('activate', 1);
			$emailSubject	= RText::sprintf(
				'COM_USERS_EMAIL_ACTIVATE_WITH_ADMIN_ACTIVATION_SUBJECT',
				$data['name'],
				$data['sitename']
			);

			$emailBody = RText::sprintf(
				'COM_USERS_EMAIL_ACTIVATE_WITH_ADMIN_ACTIVATION_BODY',
				$data['sitename'],
				$data['name'],
				$data['email'],
				$data['username'],
				$data['siteurl'].'index.php?option=com_users&task=registration.activate&token='.$data['activation']
			);

			// Получение всех пользователей.
			$query = 'SELECT name, email, sendEmail' .
						' FROM #__users' .
						' WHERE sendEmail=1';

			$db->setQuery( $query );
			$rows = $db->loadObjectList();

			// Отправка.
			foreach( $rows as $row )
			{
				$return = JFactory::getMailer()->sendMail($data['mailfrom'], $data['fromname'], $row->email, $emailSubject, $emailBody);

				// Проверка на наличие ошибок.
				if ($return !== true) {
					$this->setError(RText::_('COM_USERS_REGISTRATION_ACTIVATION_NOTIFY_SEND_MAIL_FAILED'));
					return false;
				}
			}
		}

		//Включение активации учётной записи.
		elseif (($userParams->get('useractivation') == 2) && $user->getParam('activate', 0))
		{
			$user->set('activation', '');
			$user->set('block', '0');

			$uri = JURI::getInstance();

			// Формирование текста письма, высылаемого на электронную почту.
			$data = $user->getProperties();
			$user->setParam('activate', 0);
			$data['fromname'] = $config->get('fromname');
			$data['mailfrom'] = $config->get('mailfrom');
			$data['sitename'] = $config->get('sitename');
			$data['siteurl']	= JUri::base();
			$emailSubject	= RText::sprintf(
				'COM_USERS_EMAIL_ACTIVATED_BY_ADMIN_ACTIVATION_SUBJECT',
				$data['name'],
				$data['sitename']
			);

			$emailBody = RText::sprintf(
				'COM_USERS_EMAIL_ACTIVATED_BY_ADMIN_ACTIVATION_BODY',
				$data['name'],
				$data['siteurl'],
				$data['username']
			);

			$return = JFactory::getMailer()->sendMail($data['mailfrom'], $data['fromname'], $data['email'], $emailSubject, $emailBody);

			// Проверка на наличие ошибок.
			if ($return !== true) {
				$this->setError(RText::_('COM_USERS_REGISTRATION_ACTIVATION_NOTIFY_SEND_MAIL_FAILED'));
				return false;
			}
		}
		else
		{
			$user->set('activation', '');
			$user->set('block', '0');
		}

		// Сохранение объекта пользователя.
		if (!$user->save()) {
			$this->setError(RText::sprintf('COM_USERS_REGISTRATION_ACTIVATION_SAVE_FAILED', $user->getError()));
			return false;
		}

		return $user;
	}

	/**
	 * Метод получения данных регистрационной формы.
	 *
	 * Загружается база данных, затем и затем запускается событие для пользователей.
	 *
	 *
	 * @return	mixed		данные объекта в случае успеха, false - в случае неудачи.
	 * @since	1.6
	 */
	public function getData()
	{
		if ($this->data === null) {

			$this->data	= new stdClass();
			$app	= JFactory::getApplication();
			$params	= JComponentHelper::getParams('com_users');

			// Переопределение базовых пользовательских данных на данные сессии.
			$temp = (array)$app->getUserState('com_users.registration.data', array());
			foreach ($temp as $k => $v) {
				$this->data->$k = $v;
			}

			// Получение группы, в которую должен быть добавлен пользователь после регистрации.
			$this->data->groups = isset($this->data->groups) ? array_unique($this->data->groups) : array();

			// По умолчанию получить новую группу пользователей.
			$main	= $params->get('new_usertype', 2);

			$this->data->groups[] = $main;

			// Возврат паролей в исходное состояние.
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
		$form = $this->loadForm('com_users.registration', 'registration', array('control' => 'rinputform', 'load_data' => $loadData));
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
	 * Метод сохранения данных формы.
	 *
	 * @param	array		Данные формы.
	 * @return	mixed		Идентификатор пользователя в случае успеха, false - в случае неудачи.
	 * @since	1.6
	 */
	public function register($temp)
	{
		$config = JFactory::getConfig();
		$db		= $this->getDbo();
		$params = JComponentHelper::getParams('com_users');

		// Инициализация таблицы JUser.
		$user = new JUser;
		$data = (array)$this->getData();

		// Добавление в регистрационные данные.
		foreach ($temp as $k => $v) {
			$data[$k] = $v;
		}

		// Подготовка данных для объекта пользователя.
		$data['email']		= $data['email1'];
		$data['password']	= $data['password1'];
		$useractivation = $params->get('useractivation');

		// Проверка : активировал ли пользователь свою учётную запись.
		if (($useractivation == 1) || ($useractivation == 2)) {
			$data['activation'] = JApplication::getHash(JUserHelper::genRandomPassword());
			$data['block'] = 1;
		}

		// Привязки данных.
		if (!$user->bind($data)) {
			$this->setError(RText::sprintf('COM_USERS_REGISTRATION_BIND_FAILED', $user->getError()));
			return false;
		}

		// Load the users plugin group.
		JPluginHelper::importPlugin('user');

		// Store the data.
		if (!$user->save()) {
			$this->setError(RText::sprintf('COM_USERS_REGISTRATION_SAVE_FAILED', $user->getError()));
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

			$emailSubject	= RText::sprintf(
				'COM_USERS_EMAIL_ACCOUNT_DETAILS',
				$data['name'],
				$data['sitename']
			);

			$emailBody = RText::sprintf(
				'COM_USERS_EMAIL_REGISTERED_WITH_ADMIN_ACTIVATION_BODY',
				$data['name'],
				$data['sitename'],
				$data['siteurl'].'index.php?option=com_users&task=registration.activate&token='.$data['activation'],
				$data['siteurl'],
				$data['username'],
				$data['password_clear']
			);
		}
		elseif ($useractivation == 1)
		{
			// Set the link to activate the user account.
			$uri = JURI::getInstance();
			$base = $uri->toString(array('scheme', 'user', 'pass', 'host', 'port'));
			$data['activate'] = $base.JRoute::_('index.php?option=com_users&task=registration.activate&token='.$data['activation'], false);

			$emailSubject	= RText::sprintf(
				'COM_USERS_EMAIL_ACCOUNT_DETAILS',
				$data['name'],
				$data['sitename']
			);

			$emailBody = RText::sprintf(
				'COM_USERS_EMAIL_REGISTERED_WITH_ACTIVATION_BODY',
				$data['name'],
				$data['sitename'],
				$data['siteurl'].'index.php?option=com_users&task=registration.activate&token='.$data['activation'],
				$data['siteurl'],
				$data['username'],
				$data['password_clear']
			);
		} else {

			$emailSubject	= RText::sprintf(
				'COM_USERS_EMAIL_ACCOUNT_DETAILS',
				$data['name'],
				$data['sitename']
			);

			$emailBody = RText::sprintf(
				'COM_USERS_EMAIL_REGISTERED_BODY',
				$data['name'],
				$data['sitename'],
				$data['siteurl']
			);
		}

		// Send the registration email.
		$return = JFactory::getMailer()->sendMail($data['mailfrom'], $data['fromname'], $data['email'], $emailSubject, $emailBody);

		//Send Notification mail to admins
		if (($params->get('useractivation') < 2) && ($params->get('mail_to_admin') == 1)) {
			$emailSubject = RText::sprintf(
				'COM_USERS_EMAIL_ACCOUNT_DETAILS',
				$data['name'],
				$data['sitename']
			);

			$emailBodyAdmin = RText::sprintf(
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

			// Send mail to all superadmins id
			foreach( $rows as $row )
			{
				$return = JFactory::getMailer()->sendMail($data['mailfrom'], $data['fromname'], $row->email, $emailSubject, $emailBodyAdmin);

				// Check for an error.
				if ($return !== true) {
					$this->setError(RText::_('COM_USERS_REGISTRATION_ACTIVATION_NOTIFY_SEND_MAIL_FAILED'));
					return false;
				}
			}
		}
		// Check for an error.
		if ($return !== true) {
			$this->setError(RText::_('COM_USERS_REGISTRATION_SEND_MAIL_FAILED'));

			// Send a main message to admins receiving main mails
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
					$messages[] = "(".$userid.", ".$userid.", '".$jdate->toSql()."', '".RText::_('COM_USERS_MAIL_SEND_FAILURE_SUBJECT')."', '".RText::sprintf('COM_USERS_MAIL_SEND_FAILURE_BODY', $return, $data['username'])."')";
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
