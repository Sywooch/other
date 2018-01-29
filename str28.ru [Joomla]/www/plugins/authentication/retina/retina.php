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
	 * Этот метод осуществляет аутентификацию и возвращает результат субъекту.
	 *
	 * @access	public
	 * @param	array	массив, содержащий учётные данные пользователя.
	 * @param	array	массив с дополнительными опциями.
	 * @param	object	объект, возвращаемый функцией аутентификации.
	 * @return	boolean
	 * @since 1.5
	 */
	function onUserAuthenticate($credentials, $options, &$response)
	{
		$response->type = 'retina';
		// проверка - пустой ли пароль????
		if (empty($credentials['password'])) {
			$response->status = JAuthentication::STATUS_FAILURE;
			$response->error_message = RText::_('RGLOBAL_AUTH_EMPTY_PASS_NOT_ALLOWED');
			return false;
		}

		// Инициализация переменных.
		$conditions = '';

		// Получение объекта базы данных
		$db		= JFactory::getDbo();
		$query	= $db->getQuery(true);

		$query->select('id, password');//////////////////////////////////////составление запроса типа - 
		$query->from('#__users');///////////////////////////////////////////SELECT id, password FROM _users WHERE username='имя пользователя, введённое 
		$query->where('username=' . $db->Quote($credentials['username']));//в форму авторизации';

		$db->setQuery($query);//выполнение запроса
		$result = $db->loadObject();//получение результата

		if ($result) {
			$parts	= explode(':', $result->password);// $result->password = 57f3bd166698f2712ca33f2f7fa4f369:N3DJndNTMr0FiR4xrNhRfefOf90HXWRz
			$crypt	= $parts[0];//: - разделитель. $crypt = 57f3bd166698f2712ca33f2f7fa4f369 - хешированный пароль
			$salt	= @$parts[1];//$salt = N3DJndNTMr0FiR4xrNhRfefOf90HXWRz - "соль"
			$testcrypt = JUserHelper::getCryptedPassword($credentials['password'], $salt);//хеширование пароля
			//$testcrypt= md5($credentials['password']+$salt)
			//$credentials['password'] - введённый пользователем пароль
			//$salt - соль
			//$testcrypt - хеш введённого пароля

			if ($crypt == $testcrypt) {// сверка извлечённого из базы хешированного пароля с хешем пароля, который ввёл пользователь
				$user = JUser::getInstance($result->id); // Bring this in line with the rest of the main
				$response->email = $user->email;
				$response->fullname = $user->name;
				if (JFactory::getApplication()->isAdmin()) {
					$response->language = $user->getParam('admin_language');
				}
				else {
					$response->language = $user->getParam('language');
				}
				$response->status = JAuthentication::STATUS_SUCCESS;//аутентификация успешна
				$response->error_message = '';
			} else {
				$response->status = JAuthentication::STATUS_FAILURE;//аутентификация неуспешна: неверный пароль.
				$response->error_message = RText::_('RGLOBAL_AUTH_INVALID_PASS');
			}
		} else {
			$response->status = JAuthentication::STATUS_FAILURE;// если запрос к базе не удался, то 
			$response->error_message = RText::_('RGLOBAL_AUTH_NO_USER');//сообщение о том, что нет указанного пользователя.
		}
	}
}
