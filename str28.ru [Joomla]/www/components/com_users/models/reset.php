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
	 * ����� �������� ����� ������ ������
	 *
	 * @param	array	$data		������ ��� �����.
	 * @param	boolean	$loadData	True ���� ����� ��������� ����������� ������ (�� ���������), false - � ��������� ������.
	 * @return	JForm	���������� JForm � ������ ������, false - � ������ �������.
	 * @since	1.6
	 */
	public function getForm($data = array(), $loadData = true)
	{
		// ��������� �����.
		$form = $this->loadForm('com_users.reset_request', 'reset_request', array('control' => 'rinputform', 'load_data' => $loadData));
		if (empty($form)) {
			return false;
		}

		return $form;
	}

	/**
	 * ����� ��� ��������� ������ ����� ������ ������.
	 *
	 * @param	array	$data		������ ��� �����.
	 * @param	boolean	$loadData	True ���� ����� ��������� ����������� ������ (�� ���������), false - � ��������� ������.
	 * @return	JForm	���������� JForm � ������ ������, false - � ������ �������.
	 * @since	1.6
	 */
	public function getResetCompleteForm($data = array(), $loadData = true)
	{
		// ��������� �����.
		$form = $this->loadForm('com_users.reset_complete', 'reset_complete', $options = array('control' => 'rinputform'));
		if (empty($form)) {
			return false;
		}

		return $form;
	}

	/**
	 * ����� ��� ��������� ����� ������������� ������ ������.
	 *
	 * @param	array	$data		������ ��� �����.
	 * @param	boolean	$loadData	True ���� ����� ��������� ����������� ������ (�� ���������), false - � ��������� ������.
	 * @return	JForm	���������� JForm � ������ ������, false - � ������ �������.
	 * @since	1.6
	 */
	public function getResetConfirmForm($data = array(), $loadData = true)
	{
		// ��������� �����.
		$form = $this->loadForm('com_users.reset_confirm', 'reset_confirm', $options = array('control' => 'rinputform'));
		if (empty($form)) {
			return false;
		}

		return $form;
	}

	/**
	 * Override preprocessForm ��������� � �������� ����������� ������ ������ �������������.
	 *
	 * @param	object	������ �����.
	 * @param	mixed	������ ��� �����.
	 * @throws	���������� � ������ ������ � �������� �����.
	 * @since	1.6
	 */
	protected function preprocessForm(JForm $form, $data, $group = 'user')
	{
		parent::preprocessForm($form, $data, $group);
	}

	/**
	 * ����� ��������������� ����������.
	 *
	 * ���������. ����� getState � ���� ������ ������� � ��������.
	 *
	 * @since	1.6
	 */
	protected function populateState()
	{
		// �������� ������� ����������.
		$params	= JFactory::getApplication()->getParams('com_users');

		// �������� ����������.
		$this->setState('params', $params);
	}

	/**
	 * @since	1.6
	 */
	function processResetComplete($data)
	{
		// ��������� �����.
		$form = $this->getResetCompleteForm();

		// �������� �� ������� ������.
		if ($form instanceof Exception) {
			return $form;
		}

		// ���������� � �������� ������ �����.
		$data	= $form->filter($data);
		$return	= $form->validate($data);

		// �������� �� ������� ������.
		if ($return instanceof Exception) {
			return $return;
		}

		// �������� �����������.
		if ($return === false) {
			// �������� ���������, ���������� �� �����.
			foreach ($form->getErrors() as $message) {
				$this->setError($message);
			}
			return false;
		}

		// ��������� ����� � �������������� ������������ �� �������� �������������.
		$app	= JFactory::getApplication();
		$token	= $app->getUserState('com_users.reset.token', null);
		$userId	= $app->getUserState('com_users.reset.user', null);

		// �������� ����� � �������������� ������������.
		if (empty($token) || empty($userId)) {
			return new JException(RText::_('COM_USERS_RESET_COMPLETE_TOKENS_MISSING'), 403);
		}

		// �������� ������� ������������.
		$user = JUser::getInstance($userId);

		// �������� ����� ������������.
		if (empty($user) || $user->activation !== $token) {
			$this->setError(RText::_('COM_USERS_USER_NOT_FOUND'));
			return false;
		}

		// ��������, ��� ������������ �� ������������.
		if ($user->block) {
			$this->setError(RText::_('COM_USERS_USER_BLOCKED'));
			return false;
		}

		// ��������� ������������� ������.
		$salt		= JUserHelper::genRandomPassword(32);//��������� ���������� ������. ����� ������ 32 �������. (����)
		$crypted	= JUserHelper::getCryptedPassword($data['password1'], $salt);//��������� ������������� ������. 
		$password	= $crypted.':'.$salt;//����������. ��������� - "������������ ������:����"

		// ���������� ������� ������������.
		$user->password			= $password;
		$user->activation		= '';
		$user->password_clear	= $data['password1'];

		// ���������� ������������ � ���� ������.
		if (!$user->save(true)) {
			return new JException(RText::sprintf('COM_USERS_USER_SAVE_FAILED', $user->getError()), 500);
		}

		// ������� ���������������� ������ � ������.
		$app->setUserState('com_users.reset.token', null);
		$app->setUserState('com_users.reset.user', null);

		return true;
	}

	/**
	 * @since	1.6
	 */
	function processResetConfirm($data)
	{
		// ��������� �����.
		$form = $this->getResetConfirmForm();

		// �������� �� ������� ������.
		if ($form instanceof Exception) {
			return $form;
		}

		// ���������� � �������� ������ �����.
		$data	= $form->filter($data);
		$return	= $form->validate($data);

		// �������� �� ������� ������.
		if ($return instanceof Exception) {
			return $return;
		}

		// �������� �����������.
		if ($return === false) {
			// �������� ��������� �� �����.
			foreach ($form->getErrors() as $message) {
				$this->setError($message);
			}
			return false;
		}

		// ����� ������������� ������������ � ������ ������.
		$db	= $this->getDbo();
		$query	= $db->getQuery(true);
		$query->select('activation');
		$query->select('id');
		$query->select('block');
		$query->from($db->quoteName('#__users'));
		$query->where($db->quoteName('username').' = '.$db->Quote($data['username']));

		// ��������� �������������� ������������.
		$db->setQuery((string) $query);
		$user = $db->loadObject();

		// �������� �� ������� ������.
		if ($db->getErrorNum()) {
			return new JException(RText::sprintf('COM_USERS_DATABASE_ERROR', $db->getErrorMsg()), 500);
		}

		// �������� ��� ������������.
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

		// �������� �����.
		if (!($crypt == $testcrypt))
		{
			$this->setError(RText::_('COM_USERS_USER_NOT_FOUND'));
			return false;
		}

		// ��������, ��� ������������ �� ������������.
		if ($user->block) {
			$this->setError(RText::_('COM_USERS_USER_BLOCKED'));
			return false;
		}

		// ��������� ���������������� ������ � ������.
		$app = JFactory::getApplication();
		$app->setUserState('com_users.reset.token', $crypt.':'.$salt);
		$app->setUserState('com_users.reset.user', $user->id);

		return true;
	}

	/**
	 * ����� ������� �������� ������ ������.
	 *
	 * @since	1.6
	 */
	public function processResetRequest($data)
	{
		$config	= JFactory::getConfig();

		// ��������� �����.
		$form = $this->getForm();

		// �������� �� ������� ������.
		if ($form instanceof Exception) {
			return $form;
		}

		// ���������� � �������� ������ �����.
		$data	= $form->filter($data);
		$return	= $form->validate($data);

		// �������� �� ������� ������.
		if ($return instanceof Exception) {
			return $return;
		}

		// �������� ������������ �����������.
		if ($return === false) {
			// �������� ������������ ��������� �� �����.
			foreach ($form->getErrors() as $message) {
				$this->setError($message);
			}
			return false;
		}

		// ��������� �������������� ������������ ��� ������� ������ ����������� �����.
		$db	= $this->getDbo();
		$query	= $db->getQuery(true);
		$query->select('id');
		$query->from($db->quoteName('#__users'));
		$query->where($db->quoteName('email').' = '.$db->Quote($data['email']));

		// ��������� ������� ������������.
		$db->setQuery((string) $query);
		$userId = $db->loadResult();

		// �������� �� ������� ������.
		if ($db->getErrorNum()) {
			$this->setError(RText::sprintf('COM_USERS_DATABASE_ERROR', $db->getErrorMsg()), 500);
			return false;
		}

		// �������� ��� ������������.
		if (empty($userId)) {
			$this->setError(RText::_('COM_USERS_INVALID_EMAIL'));
			return false;
		}

		// ��������� ������� ������������.
		$user = JUser::getInstance($userId);

		// ��������, ��� ������������ �� ������������.
		if ($user->block) {
			$this->setError(RText::_('COM_USERS_USER_BLOCKED'));
			return false;
		}

		// ��������, ��� ������������ �� �������� ��������������������.
		if ($user->authorise('core.admin')) {
			$this->setError(RText::_('COM_USERS_REMIND_SUPERADMIN_ERROR'));
			return false;
		}

		// ���������� ����� �������������.
		$token = JApplication::getHash(JUserHelper::genRandomPassword());//��������� ���� �� ���������� ������.
		$salt = JUserHelper::getSalt('crypt-md5');//��������� "����".
		$hashedToken = md5($token.$salt).':'.$salt;//��������� ������������������ - md5(���.����):����

		$user->activation = $hashedToken;//��������� ������������.

		// ���������� ������������ � ���� ������.
		if (!$user->save(true)) {
			return new JException(RText::sprintf('COM_USERS_USER_SAVE_FAILED', $user->getError()), 500);
		}

		// �������� ������ ������������� ������ ������.
		$mode = $config->get('force_ssl', 0) == 2 ? 1 : -1;
		$elementid = UsersHelperRoute::getLoginRoute();
		$elementid = $elementid !== null ? '&elementid='.$elementid : '';
		$link = 'index.php?option=com_users&view=reset&layout=confirm'.$elementid;

		// ������ ������ ��� �������� �� ����������� �����.
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

		// �������� ������ ��� ������ ������ �� ����������� �����.
		$return = JFactory::getMailer()->sendMail($data['mailfrom'], $data['fromname'], $user->email, $subject, $body);
		// �������� �� ������� ������.
		if ($return !== true) {
			return new JException(RText::_('COM_USERS_MAIL_FAILED'), 500);
		}

		return true;
	}
}
