<?php

// No direct access
defined('_REXEC') or die;

/**
 * retina Authentication plugin
 *
 * @package		retina.Plugin
 * @subpackage	Authentication.retina
 * @since 1.5
 */
class plgAuthenticationretina extends JPlugin
{
	/**
	 * ���� ����� ������������ �������������� � ���������� ��������� ��������.
	 *
	 * @access	public
	 * @param	array	������, ���������� ������� ������ ������������.
	 * @param	array	������ � ��������������� �������.
	 * @param	object	������, ������������ �������� ��������������.
	 * @return	boolean
	 * @since 1.5
	 */
	function onUserAuthenticate($credentials, $options, &$response)
	{
		$response->type = 'retina';
		// �������� - ������ �� ������????
		if (empty($credentials['password'])) {
			$response->status = JAuthentication::STATUS_FAILURE;
			$response->error_message = RText::_('RGLOBAL_AUTH_EMPTY_PASS_NOT_ALLOWED');
			return false;
		}

		// ������������� ����������.
		$conditions = '';

		// ��������� ������� ���� ������
		$db		= JFactory::getDbo();
		$query	= $db->getQuery(true);

		$query->select('id, password');//////////////////////////////////////����������� ������� ���� - 
		$query->from('#__users');///////////////////////////////////////////SELECT id, password FROM _users WHERE username='��� ������������, �������� 
		$query->where('username=' . $db->Quote($credentials['username']));//� ����� �����������';

		$db->setQuery($query);//���������� �������
		$result = $db->loadObject();//��������� ����������

		if ($result) {
			$parts	= explode(':', $result->password);// $result->password = 57f3bd166698f2712ca33f2f7fa4f369:N3DJndNTMr0FiR4xrNhRfefOf90HXWRz
			$crypt	= $parts[0];//: - �����������. $crypt = 57f3bd166698f2712ca33f2f7fa4f369 - ������������ ������
			$salt	= @$parts[1];//$salt = N3DJndNTMr0FiR4xrNhRfefOf90HXWRz - "����"
			$testcrypt = JUserHelper::getCryptedPassword($credentials['password'], $salt);//����������� ������
			//$testcrypt= md5($credentials['password']+$salt)
			//$credentials['password'] - �������� ������������� ������
			//$salt - ����
			//$testcrypt - ��� ��������� ������

			if ($crypt == $testcrypt) {// ������ ������������ �� ���� ������������� ������ � ����� ������, ������� ��� ������������
				$user = JUser::getInstance($result->id); // Bring this in line with the rest of the main
				$response->email = $user->email;
				$response->fullname = $user->name;
				if (JFactory::getApplication()->isAdmin()) {
					$response->language = $user->getParam('admin_language');
				}
				else {
					$response->language = $user->getParam('language');
				}
				$response->status = JAuthentication::STATUS_SUCCESS;//�������������� �������
				$response->error_message = '';
			} else {
				$response->status = JAuthentication::STATUS_FAILURE;//�������������� ���������: �������� ������.
				$response->error_message = RText::_('RGLOBAL_AUTH_INVALID_PASS');
			}
		} else {
			$response->status = JAuthentication::STATUS_FAILURE;// ���� ������ � ���� �� ������, �� 
			$response->error_message = RText::_('RGLOBAL_AUTH_NO_USER');//��������� � ���, ��� ��� ���������� ������������.
		}
	}
}
