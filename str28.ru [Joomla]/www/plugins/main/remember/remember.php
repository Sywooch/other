<?php
/**
 * 
 * 
 */

// no direct access 2
defined('_REXEC') or die;

/**
 * Retina main Remember Me Plugin
 *
 * @package		retina.Plugin
 * @subpackage	main.remember
 */
class plgmainRemember extends JPlugin
{
	function onAfterInitialise()
	{
		$app = JFactory::getApplication();

		// No remember me for admin
		if ($app->isAdmin()) {
			return;
		}

		$user = JFactory::getUser();
		if ($user->get('guest'))
		{
			jimport('retina.utilities.utility');
			$hash = JApplication::getHash('JLOGIN_REMEMBER');

			if ($str = JRequest::getString($hash, '', 'cookie', JREQUEST_ALLOWRAW | JREQUEST_NOTRIM))
			{
				jimport('retina.utilities.simplecrypt');

				// Create the encryption key, apply extra hardening using the user agent string.
                // Since we're decoding, no UA validity check is required.
				$key = JApplication::getHash(@$_SERVER['HTTP_USER_AGENT']);

				$crypt = new JSimpleCrypt($key);
				$str = $crypt->decrypt($str);
                $cookieData = @unserialize($str);
                // Deserialized cookie could be any object structure, so make sure the
                // credentials are well structured and only have user and password.
                $credentials = array();
                $filter = JFilterInput::getInstance();
                $goodCookie = true;
                if (is_array($credentials)) {
                    if (isset($cookieData['username']) && is_string($cookieData['username'])) {
                        $credentials['username'] = $filter -> clean($cookieData['username'], 'username');
                    } else {
                        $goodCookie = false;
                    }
                    if (isset($cookieData['password']) && is_string($cookieData['password'])) {
                        $credentials['password'] = $filter -> clean($cookieData['password'], 'string');
                    } else {
                        $goodCookie = false;
                    }
                } else {
                    $goodCookie = false;
                }

				if (! $goodCookie || !$app->login($credentials, array('silent' => true))) {
					$config = JFactory::getConfig();
					$cookie_domain = $config->get('cookie_domain', '');
					$cookie_path = $config->get('cookie_path', '/');
					// Clear the remember me cookie
					setcookie(
                        JApplication::getHash('JLOGIN_REMEMBER'), false, time() - 86400,
                        $cookie_path, $cookie_domain
                    );
				}
			}
		}
	}
}
