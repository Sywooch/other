<?php
/**
* @package		EasySocial
* @copyright	Copyright (C) 2010 - 2012 Stack Ideas Sdn Bhd. All rights reserved.
* @license		GNU/GPL, see LICENSE.php
* EasySocial is free software. This version may have been modified pursuant
* to the GNU General Public License, and as distributed it includes or
* is derivative of works licensed under the GNU General Public License or
* other free or open source software licenses.
* See COPYRIGHT.php for copyright notices and details.
*/
defined( '_JEXEC' ) or die( 'Unauthorized Access' );

Foundry::import( 'site:/views/views' );

class EasySocialViewLogin extends EasySocialSiteView
{
	/**
	 * Determines if the view should be visible on lockdown mode
	 *
	 * @since	1.0
	 * @access	public
	 * @return	bool
	 */
	public function isLockDown()
	{
		$config 	= Foundry::config();

		if( $config->get( 'site.general.lockdown.registration' ) )
		{
			return true;
		}

		return false;
	}
	
	/**
	 * Responsible to display the generic login form.
	 *
	 * @since	1.0
	 * @access	public
	 */
	public function display( $tpl = null )
	{
		$my 	= Foundry::user();

		// If user is already logged in, they should not see this page.
		if( $my->id > 0 )
		{
			return $this->redirect( FRoute::dashboard( array() , false ) );
		}

		// Add page title
		Foundry::page()->title( JText::_( 'COM_EASYSOCIAL_LOGIN_PAGE_TITLE' ) );

		// Add breadcrumb
		Foundry::page()->breadcrumb( JText::_( 'COM_EASYSOCIAL_LOGIN_PAGE_BREADCRUMB' ) );

		// Facebook codes.
		$facebook 	= Foundry::oauth( 'Facebook' );

		// Get any callback urls.
		$return 	= Foundry::getCallback();

		// If return value is empty, always redirect back to the dashboard
		if( !$return )
		{
			$return	= FRoute::dashboard( array() , false );
		}

		// Determine if there's a login redirection
		$config 		= Foundry::config();
		$loginMenu 		= $config->get( 'general.site.login' );

		if( $loginMenu != 'null' )
		{
			$return 	= Foundry::get( 'toolbar' )->getRedirectionUrl( $loginMenu );
		}

		$return 	= base64_encode( $return );


		$this->set( 'return'	, $return );
		$this->set( 'facebook' 	, $facebook );

		return parent::display( 'site/login/default' );
	}

	/**
	 * Responsible to log the user out from the system.
	 *
	 * @since	1.0
	 * @access	public
	 * @param	string
	 * @return	
	 */
	public function logout()
	{
		$my 		= Foundry::user();
		$redirect	= FRoute::login( array() , false );

		if( !$my->id )
		{
			return $this->redirect( $redirect );
		}
		

		// Try to log the user out.
		$app 	= JFactory::getApplication();

		// Perform the log out.
		$error = $app->logout();

		// Get the return URL
		return $this->redirect( $redirect );
	}
}
