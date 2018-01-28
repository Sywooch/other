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

// Necessary to import the custom view.
Foundry::import( 'site:/views/views' );

class EasySocialViewDashboard extends EasySocialSiteView
{
	/**
	 * Responsible to output the dashboard layout for the current logged in user.
	 *
	 * @since	1.0
	 * @access	public
	 * @param	string	The name of the template file to parse; automatically searches through the template paths.
	 * @return	null
	 * @author	Mark Lee <mark@stackideas.com>
	 */
	public function display( $tpl = null )
	{
		// Get the current logged in user.
		$user 	= Foundry::user();

		// If the user is not logged in, display the dashboard's unity layout.
		if( !$user->id )
		{
			return $this->displayGuest();
		}

		// Set the page title
		Foundry::page()->title( $user->getName() . ' - ' . JText::_( 'COM_EASYSOCIAL_PAGE_TITLE_DASHBOARD' ) );

		// Set the page breadcrumb
		Foundry::page()->breadcrumb( JText::_( 'COM_EASYSOCIAL_PAGE_TITLE_DASHBOARD' ) );

		// Get config object.
		$config 	= Foundry::config();

		// Get list of apps
		$model		= Foundry::model( 'Apps' );
		$options	= array( 'view' => 'dashboard' , 'uid' => $user->id , 'key' => SOCIAL_TYPE_USER );

		// Retrieve apps
		$apps 		= $model->getApps( $options );

		// We need to load the app's own css file.
		if( $apps )
		{
			foreach( $apps as $app )
			{
				// Load app language
				Foundry::language()->loadApp( $app->group , $app->element );

				// Load app's css
				$app->loadCss();
			}
		}

		// Check if there is an app id in the current request as we need to show the app's content.
		$appId 			= JRequest::getInt( 'appId' );
		$contents 		= '';
		$isAppView 		= false;

		if( $appId )
		{
			// Load the application.
			$app 		= Foundry::table( 'App' );
			$app->load( $appId );

			// Check if the user has access to this app
			if( !$app->accessible( $user->id ) )
			{
				Foundry::info()->set( null , JText::_( 'COM_EASYSOCIAL_DASHBOARD_APP_IS_NOT_INSTALLED' ) , SOCIAL_MSG_ERROR );
				return $this->redirect( FRoute::dashboard( array() , false ) );
			}

			$app->loadCss();

			// Load application language file
			Foundry::language()->loadApp( $app->group , $app->element );

			Foundry::page()->title( $user->getName() . ' - ' . $app->get( 'title' ) );


			// Load the library.
			$lib		= Foundry::apps();
			$contents 	= $lib->renderView( SOCIAL_APPS_VIEW_TYPE_EMBED , 'dashboard' , $app , array( 'userId' => $user->id ) );

			$isAppView 	= true;
		}


		$start 			= $config->get( 'users.dashboard.start' );

		//check if there is any stream filtering or not.
		$filter			= JRequest::getWord( 'type' , $start );

		$listId 		= JRequest::getInt( 'listId' );
		$fid 			= '';


		// Determine if the current request is for "tags"
		$hashtag 		= JRequest::getVar( 'tag' );

		if( !empty( $hashtag ) )
		{
			$filter = 'hashtag';
		}

		// Retrieve user's groups
		$groupModel 	= Foundry::model( 'Groups' );
		$groups 		= $groupModel->getGroups( array( 'uid' => $user->id ) );

		// Retrieve user's status
		$story 			= Foundry::get( 'Story' , SOCIAL_TYPE_USER );
		$story->setTarget( $user->id );

		// Retrieve user's stream
		$stream 		= Foundry::stream();
		$stream->story  = $story;

		$groupId 		= false;

		$tags = array();

		switch( $filter )
		{
			case 'list';

				if( !empty( $listId ) )
				{
					$list 		= Foundry::table( 'List' );
					$list->load( $listId );

					Foundry::page()->title( $user->getName() . ' - ' . $list->get( 'title' ) );


					// Get list of users from this list.
					$friends 	= $list->getMembers();

					if( $friends )
					{
						$stream->get( array( 'listId' => $listId ) );
					}
					else
					{
						$stream->filter 	= 'list';
					}
				}

				break;

			case 'hashtag':
				Foundry::page()->title( $user->getName() . ' - #' . $hashtag );

				$stream->get( array( 'tag' => $hashtag ) );
				$tags = array($hashtag);
				break;

			case 'everyone':

				$stream->get( array(
									'guest' 	=> true
								)
							);

				break;

			case 'following':

				// Set the page title
				Foundry::page()->title( $user->getName() . ' - ' . JText::_( 'COM_EASYSOCIAL_DASHBOARD_FEED_FOLLLOW' ) );

				$stream->get(
							array(
								'context' 	=> SOCIAL_STREAM_CONTEXT_TYPE_ALL,
								'type' 		=> 'follow'
								)
						);
				break;

			case 'filter':

				$fid 		= JRequest::getInt( 'filterid' , 0 );
				$sfilter	= Foundry::table( 'StreamFilter' );
				$sfilter->load( $fid );

				// Set the page title
				Foundry::page()->title( $user->getName() . ' - ' . $sfilter->title );

				if( $sfilter->id )
				{
					$hashtags	= $sfilter->getHashTag();
					$tags 		= explode( ',', $hashtags );

					if( $tags )
					{
						$stream->get( array( 'context' 	=> SOCIAL_STREAM_CONTEXT_TYPE_ALL, 'tag' => $tags ) );
					}
				}

				$stream->filter = 'custom';

				break;

			case 'filterForm':

				// Set the page title
				Foundry::page()->title( $user->getName() . ' - ' . JText::_( 'COM_EASYSOCIAL_PAGE_TITLE_FILTER_FORM') );

				$id 	= JRequest::getInt( 'id' );

				// Load up the theme lib so we can output the contents
				$theme 	= Foundry::themes();

				$filter = Foundry::table( 'StreamFilter' );
				$filter->load( $id );

				$theme->set( 'filter', $filter );

				$contents	= $theme->output( 'site/stream/form.edit' );

				break;

			case 'group':
				$id 		= JRequest::getInt( 'groupId', 0 );
				$group		= Foundry::group( $id );
				$groupId	= $group->id;

				// Check if the user is a member of the group
				if( !$group->isMember() )
				{
					$this->setMessage( JText::_( 'COM_EASYSOCIAL_STREAM_GROUPS_NO_PERMISSIONS' ) , SOCIAL_MSG_ERROR );
					Foundry::info()->set( $this->getMessage() );
					return $this->redirect( FRoute::dashboard( array() , false ) );
				}

				// When posting stories into the stream, it should be made to the group
				$story 			= Foundry::get( 'Story' , SOCIAL_TYPE_GROUP );
				$story->setCluster( $group->id, SOCIAL_TYPE_GROUP );
				$story->showPrivacy( false );
				$stream->story 	= $story;

				$stream->get( array( 'clusterId' => $group->id , 'clusterType' => SOCIAL_TYPE_GROUP ) );

				break;

			case 'me':
			default:
				$stream->get();
				break;
		}

		// Set hashtags
		$story->setHashtags($tags);

		// Retrieve lists model
		$listsModel		= Foundry::model( 'Lists' );

		// Only fetch x amount of list to be shown by default.
		$limit 			= Foundry::config()->get( 'lists.display.limit' );

		// Get the friend's list.
		$lists 			= $listsModel->setLimit( $limit )->getLists( array( 'user_id' => $user->id , 'showEmpty' => $config->get('friends.list.showEmpty' ) )  );

		// Get stream filter list
		$model 		= Foundry::model( 'Stream' );
		$filterList = $model->getFilters( $user->id );

		$this->set( 'groupId'		, $groupId );
		$this->set( 'groups'		, $groups );
		$this->set( 'hashtag'		, $hashtag );
		$this->set( 'listId'		, $listId );
		$this->set( 'filter'		, $filter );
		$this->set( 'isAppView'		, $isAppView );
		$this->set( 'apps'			, $apps );
		$this->set( 'lists'			, $lists );
		$this->set( 'appId'			, $appId );
		$this->set( 'contents'		, $contents );
		$this->set( 'user'			, $user );
		$this->set( 'stream'		, $stream );
		$this->set( 'filterList'	, $filterList );
		$this->set( 'fid'			, $fid );


		echo parent::display( 'site/dashboard/default' );
	}

	/**
	 * Displays the guest view for the dashboard
	 *
	 * @since	1.0
	 * @access	public
	 * @param	string
	 * @return
	 */
	public function displayGuest()
	{
		// Get the layout to use.
		$stream 	= Foundry::stream();
		$stream->getPublicStream( SOCIAL_STREAM_GUEST_LIMIT, 0 );

		// Get any callback urls.
		$return 	= Foundry::getCallback();

		// If return value is empty, always redirect back to the dashboard
		if( !$return )
		{
			$return	= FRoute::dashboard( array() , false );
		}

		$return 	= base64_encode( $return );
		$facebook	= Foundry::oauth( 'Facebook' );

		$this->set( 'filter'	, 'everyone' );
		$this->set( 'facebook'	, $facebook );
		$this->set( 'stream'	, $stream );
		$this->set( 'return'	, $return );

		$config = Foundry::config();

		if( $config->get( 'registrations.enabled' ) )
		{
			$fieldsModel = Foundry::model( 'fields' );

			$options = array(
				'visible' => SOCIAL_PROFILES_VIEW_MINI_REGISTRATION,
				'profile_id' => Foundry::model( 'profiles' )->getDefaultProfile()->id
			);

			$fields = $fieldsModel->getCustomFields( $options );

			if( !empty( $fields ) )
			{
				Foundry::language()->loadAdmin();

				$fieldsLib = Foundry::fields();

				$session    	= JFactory::getSession();
				$registration	= Foundry::table( 'Registration' );
				$registration->load( $session->getId() );

				$data           = $registration->getValues();

				$args = array( &$data, &$registration );

				$fieldsLib->trigger( 'onRegisterMini', SOCIAL_FIELDS_GROUP_USER, $fields, $args );

				$this->set( 'fields', $fields );
			}
		}

		echo parent::display( 'site/dashboard/default.guests' );
	}
}
