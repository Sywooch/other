<?php


defined('_REXEC') or die;

jimport('retina.application.component.modelform');
jimport('retina.event.dispatcher');

/**
 * Rest model class for Users.
 *
 * @package		Retina.Site
 * @subpackage	com_users
 * @since		1.5
 */
class UsersModelReset extends JModelForm
{
	/**
	 * Метод получает форму сброса пароля
	 *
	 * @param	array	$data		Данные для формы.
	 * @param	boolean	$loadData	True если форма загружает собственные данные (по умолчанию), false - в противном случае.
	 * @return	JForm	Возвращает JForm в случае успеха, false - в случае неудачи.
	 * @since	1.6
	 */
	public function getForm($data = array(), $loadData = true)
	{
		// Получение формы.
		$form = $this->loadForm('com_users.reset_request', 'reset_request', array('control' => 'rinputform', 'load_data' => $loadData));
		if (empty($form)) {
			return false;
		}

		return $form;
	}

	/**
	 * Метод для получение полной формы сброса пароля.
	 *
	 * @param	array	$data		Данные для формы.
	 * @param	boolean	$loadData	True если форма загружает собственные данные (по умолчанию), false - в противном случае.
	 * @return	JForm	Возвращает JForm в случае успеха, false - в случае неудачи.
	 * @since	1.6
	 */
	public function getResetCompleteForm($data = array(), $loadData = true)
	{
		// Получение формы.
		$form = $this->loadForm('com_users.reset_complete', 'reset_complete', $options = array('control' => 'rinputform'));
		if (empty($form)) {
			return false;
		}

		return $form;
	}

	/**
	 * Метод для получения формы подтверждения сброса пароля.
	 *
	 * @param	array	$data		Данные для формы.
	 * @param	boolean	$loadData	True если форма загружает собственные данные (по умолчанию), false - в противном случае.
	 * @return	JForm	Возвращает JForm в случае успеха, false - в случае неудачи.
	 * @since	1.6
	 */
	public function getResetConfirmForm($data = array(), $loadData = true)
	{
		// Получение формы.
		$form = $this->loadForm('com_users.reset_confirm', 'reset_confirm', $options = array('control' => 'rinputform'));
		if (empty($form)) {
			return false;
		}

		return $form;
	}

	/**
	 * Override preprocessForm загружает в качестве содержимого плагин группы пользователей.
	 *
	 * @param	object	Объект формы.
	 * @param	mixed	Данные для формы.
	 * @throws	Исключение в случае ошибки в элементе формы.
	 * @since	1.6
	 */
	protected function preprocessForm(JForm $form, $data, $group = 'user')
	{
		parent::preprocessForm($form, $data, $group);
	}

	/**
	 * Метод автоматического заполнения.
	 *
	 * Замечание. Вызов getState в этом методе приведёт к рекурсии.
	 *
	 * @since	1.6
	 */
	protected function populateState()
	{
		// Полчение объекта приложения.
		$params	= JFactory::getApplication()->getParams('com_users');

		// Загрузка параметров.
		$this->setState('params', $params);
	}

	/**
	 * @since	1.6
	 */
	function processResetComplete($data)
	{
		// Получение формы.
		$form = $this->getResetCompleteForm();

		// Проверка на наличие ошибок.
		if ($form instanceof Exception) {
			return $form;
		}

		// Фильтрация и проверка данных формы.
		$data	= $form->filter($data);
		$return	= $form->validate($data);

		// Проверка на наличие ошибок.
		if ($return instanceof Exception) {
			return $return;
		}

		// Проверка результатов.
		if ($return === false) {
			// Проверка сообщений, полученных от формы.
			foreach ($form->getErrors() as $message) {
				$this->setError($message);
			}
			return false;
		}

		// Получение метки и идентификатора пользователя из процесса подтверждения.
		$app	= JFactory::getApplication();
		$token	= $app->getUserState('com_users.reset.token', null);
		$userId	= $app->getUserState('com_users.reset.user', null);

		// Проверка метки и идентификатора пользователя.
		if (empty($token) || empty($userId)) {
			return new JException(RText::_('COM_USERS_RESET_COMPLETE_TOKENS_MISSING'), 403);
		}

		// Проверка объекта пользователя.
		$user = JUser::getInstance($userId);

		// Проверка меток пользователя.
		if (empty($user) || $user->activation !== $token) {
			$this->setError(RText::_('COM_USERS_USER_NOT_FOUND'));
			return false;
		}

		// Проверка, что пользователь не заблокирован.
		if ($user->block) {
			$this->setError(RText::_('COM_USERS_USER_BLOCKED'));
			return false;
		}

		// генерация хешированного пароля.
		$salt		= JUserHelper::genRandomPassword(32);//генерация случайного пароля. Длина пароля 32 символа. (соль)
		$crypted	= JUserHelper::getCryptedPassword($data['password1'], $salt);//получение хешированного пароля. 
		$password	= $crypted.':'.$salt;//склеивание. результат - "хешированный пароль:соль"

		// Обновление объекта пользователя.
		$user->password			= $password;
		$user->activation		= '';
		$user->password_clear	= $data['password1'];

		// Сохранение пользователя в базе данных.
		if (!$user->save(true)) {
			return new JException(RText::sprintf('COM_USERS_USER_SAVE_FAILED', $user->getError()), 500);
		}

		// Очистка пользовательских данных в сессии.
		$app->setUserState('com_users.reset.token', null);
		$app->setUserState('com_users.reset.user', null);

		return true;
	}

	/**
	 * @since	1.6
	 */
	function processResetConfirm($data)
	{
		// Получение формы.
		$form = $this->getResetConfirmForm();

		// Проверка на наличие ошибок.
		if ($form instanceof Exception) {
			return $form;
		}

		// Фильтрация и проверка данных формы.
		$data	= $form->filter($data);
		$return	= $form->validate($data);

		// Проверка на наличие ошибок.
		if ($return instanceof Exception) {
			return $return;
		}

		// Проверка пезультатов.
		if ($return === false) {
			// Проверка сообщений от формы.
			foreach ($form->getErrors() as $message) {
				$this->setError($message);
			}
			return false;
		}

		// Найти идентификатор пользователя с данной меткой.
		$db	= $this->getDbo();
		$query	= $db->getQuery(true);
		$query->select('activation');
		$query->select('id');
		$query->select('block');
		$query->from($db->quoteName('#__users'));
		$query->where($db->quoteName('username').' = '.$db->Quote($data['username']));

		// Получение идентификатора пользователя.
		$db->setQuery((string) $query);
		$user = $db->loadObject();

		// Проверка на наличие ошибок.
		if ($db->getErrorNum()) {
			return new JException(RText::sprintf('COM_USERS_DATABASE_ERROR', $db->getErrorMsg()), 500);
		}

		// Проверка для пользователя.
		if (empty($user)) {
			$this->setError(RText::_('COM_USERS_USER_NOT_FOUND'));
			return false;
		}

		$parts	= explode( ':', $user->activation );
		$crypt	= $parts[0];
		if (!isset($parts[1])) {
			$this->setError(RText::_('COM_USERS_USER_NOT_FOUND'));
			return false;
		}
		$salt	= $parts[1];
		$testcrypt = JUserHelper::getCryptedPassword($data['token'], $salt);

		// Проверка метки.
		if (!($crypt == $testcrypt))
		{
			$this->setError(RText::_('COM_USERS_USER_NOT_FOUND'));
			return false;
		}

		// Проверка, что пользователь не заблокирован.
		if ($user->block) {
			$this->setError(RText::_('COM_USERS_USER_BLOCKED'));
			return false;
		}

		// Помещение пользовательских данных в сессию.
		$app = JFactory::getApplication();
		$app->setUserState('com_users.reset.token', $crypt.':'.$salt);
		$app->setUserState('com_users.reset.user', $user->id);

		return true;
	}

	/**
	 * Метод запуска процесса сброса пароля.
	 *
	 * @since	1.6
	 */
	public function processResetRequest($data)
	{
		$config	= JFactory::getConfig();

		// Получение формы.
		$form = $this->getForm();

		// Проверка на наличие ошибок.
		if ($form instanceof Exception) {
			return $form;
		}

		// Фильтрация и проверка данных формы.
		$data	= $form->filter($data);
		$return	= $form->validate($data);

		// Проверка на наличие ошибок.
		if ($return instanceof Exception) {
			return $return;
		}

		// Проверка превильности результатов.
		if ($return === false) {
			// Проверка правильности сообщений от формы.
			foreach ($form->getErrors() as $message) {
				$this->setError($message);
			}
			return false;
		}

		// Получение идентификатора пользователя для данного адреса электронной почты.
		$db	= $this->getDbo();
		$query	= $db->getQuery(true);
		$query->select('id');
		$query->from($db->quoteName('#__users'));
		$query->where($db->quoteName('email').' = '.$db->Quote($data['email']));

		// Получение объекта пользователя.
		$db->setQuery((string) $query);
		$userId = $db->loadResult();

		// Проверка на наличие ошибок.
		if ($db->getErrorNum()) {
			$this->setError(RText::sprintf('COM_USERS_DATABASE_ERROR', $db->getErrorMsg()), 500);
			return false;
		}

		// Проверка для пользователя.
		if (empty($userId)) {
			$this->setError(RText::_('COM_USERS_INVALID_EMAIL'));
			return false;
		}

		// Получение объекта пользователя.
		$user = JUser::getInstance($userId);

		// Проверка, что пользователь не заблокирован.
		if ($user->block) {
			$this->setError(RText::_('COM_USERS_USER_BLOCKED'));
			return false;
		}

		// Проверка, что пользователь не является СуперАдминистратором.
		if ($user->authorise('core.admin')) {
			$this->setError(RText::_('COM_USERS_REMIND_SUPERADMIN_ERROR'));
			return false;
		}

		// Усстановка метки подтверждения.
		$token = JApplication::getHash(JUserHelper::genRandomPassword());//получение хеша из случайного пароля.
		$salt = JUserHelper::getSalt('crypt-md5');//получение "соли".
		$hashedToken = md5($token.$salt).':'.$salt;//получение последовательности - md5(хеш.соль):соль

		$user->activation = $hashedToken;//активация пользователя.

		// Сохранение пользователя в базе данных.
		if (!$user->save(true)) {
			return new JException(RText::sprintf('COM_USERS_USER_SAVE_FAILED', $user->getError()), 500);
		}

		// Создание ссылки подтверждения сброса пароля.
		$mode = $config->get('force_ssl', 0) == 2 ? 1 : -1;
		$elementid = UsersHelperRoute::getLoginRoute();
		$elementid = $elementid !== null ? '&elementid='.$elementid : '';
		$link = 'index.php?option=com_users&view=reset&layout=confirm'.$elementid;

		// Шаблон данных для отправки на электронную почту.
		$data = $user->getProperties();
		$data['fromname']	= $config->get('fromname');
		$data['mailfrom']	= $config->get('mailfrom');
		$data['sitename']	= $config->get('sitename');
		$data['link_text']	= JRoute::_($link, false, $mode);
		$data['link_html']	= JRoute::_($link, true, $mode);
		$data['token']		= $token;

		$subject = RText::sprintf(
			'COM_USERS_EMAIL_PASSWORD_RESET_SUBJECT',
			$data['sitename']
		);

		$body = RText::sprintf(
			'COM_USERS_EMAIL_PASSWORD_RESET_BODY',
			$data['sitename'],
			$data['token'],
			$data['link_text']
		);

		// Отправка ссылки для сброса пароля на электронную почту.
		$return = JFactory::getMailer()->sendMail($data['mailfrom'], $data['fromname'], $user->email, $subject, $body);
		// Проверка на наличие ошибок.
		if ($return !== true) {
			return new JException(RText::_('COM_USERS_MAIL_FAILED'), 500);
		}

		return true;
	}
}
