<?php
/**
 * @package		Retina.Site
 * @subpackage	com_users
 * 
 * 
 * @since		1.5
 */

defined('_REXEC') or die;

if ($this->user->get('guest')):
	// The user is not logged in.
	echo $this->loadTemplate('login');
else:
	// The user is already logged in.
	echo $this->loadTemplate('logout');
endif;
