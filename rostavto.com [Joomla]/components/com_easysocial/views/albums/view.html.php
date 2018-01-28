<?php
/**
* @package		EasySocial
* @copyright	Copyright (C) 2010 Stack Ideas Private Limited. All rights reserved.
* @license		GNU/GPL, see LICENSE.php
* EasyBlog is free software. This version may have been modified pursuant
* to the GNU General Public License, and as distributed it includes or
* is derivative of works licensed under the GNU General Public License or
* other free or open source software licenses.
* See COPYRIGHT.php for copyright notices and details.
*/
defined( '_JEXEC' ) or die( 'Unauthorized Access' );

// Import parent view
Foundry::import( 'site:/views/views' );

class EasySocialViewAlbums extends EasySocialSiteView
{
	/**
	 * Determines if the photos is enabled.
	 *
	 * @since	1.0
	 * @access	public
	 */
	private function checkFeature()
	{
		$config	= Foundry::config();

		// Do not allow user to access photos if it's not enabled
		if( !$config->get( 'photos.enabled' ) )
		{
			$this->setMessage( JText::_( 'COM_EASYSOCIAL_ALBUMS_PHOTOS_DISABLED' ) , SOCIAL_MSG_ERROR );

			Foundry::info()->set( $this->getMessage() );
			$this->redirect( FRoute::dashboard( array() , false ) );
			$this->close();
		}
	}

	/**
	 * Displays a list of recent albums that the user created.
	 *
	 * @since	1.0
	 * @access	public
	 * @return
	 */
	public function display( $tpl = null )
	{
		// Check if photos is enabled
		$this->checkFeature();

		// Check if the current request is made for the current logged in user or another user.
		$uid 	= JRequest::getInt( 'uid' , null );
		$type 	= JRequest::getWord( 'type' , SOCIAL_TYPE_USER );

		// Load up the albums library
		$lib 	= Foundry::albums( $uid , $type );

		// Determine if the node is valid
		$valid 	= $lib->isValidNode();

		// Determines if the viewer is trying to view albums for a valid node.
		if( !$lib->isValidNode() )
		{
			$this->setMessage( $lib->getError() , SOCIAL_MSG_ERROR );

			Foundry::info()->set( $this->getMessage() );
			$this->redirect( FRoute::dashboard( array() , false ) );
			$this->close();
		}

		// Set the page title
		$title 			= $lib->getPageTitle( $this->getLayout() );
		Foundry::page()->title( $title );

		// Set the breadcrumbs
		$breadcrumbs	= $lib->setBreadcrumbs( $this->getLayout() );

		// Get albums model
		$model 	= Foundry::model( 'Albums' );
		$model->initStates();

		// Get the start limit from the request
		$startlimit 	= JRequest::getVar( 'limitstart', '');
		
		if( !$startlimit )
		{
			$model->setState( 'limitstart', 0);
		}

		// Get a list of normal albums
		$options 				= array();
		$options['pagination']	= true;
		$options['order'] 		= 'a.assigned_date';
		$options['direction'] 	= 'DESC';

		// Get the albums
		$albums 	= $model->getAlbums( $uid , $type , $options );

		// Get the album pagination
		$pagination = $model->getPagination();

		// Format albums by date
		$data	= $lib->groupAlbumsByDate( $albums );

		// Load up the themes now
		$theme	= Foundry::themes();

		$theme->set( 'lib'			, $lib );
		$theme->set( 'data' 		, $data );
		$theme->set( 'pagination' 	, $pagination );

		// Get the theme output
		$output = $theme->output( 'site/albums/list' );

		// Wrap it with the albums wrapper.
		return $this->output( $lib->uid , $lib->type , $output );
	}

	/**
	 * Displays all albums from the site.
	 *
	 * @since	1.2
	 * @access	public
	 * @param	string
	 * @return	
	 */
	/**
	 * Displays a list of recent albums that the user created.
	 *
	 * @since	1.0
	 * @access	public
	 * @return
	 */
	public function all( $tpl = null )
	{
		// Check if photos is enabled
		$this->checkFeature();

		// Set the page title
		Foundry::page()->title( JText::_( 'COM_EASYSOCIAL_ALBUMS_ALL_ALBUMS' ) );

		// Set the breadcrumbs
		Foundry::page()->breadcrumb( JText::_( 'COM_EASYSOCIAL_ALBUMS_ALL_ALBUMS' ) );

		// Get albums model
		$model 	= Foundry::model( 'Albums' );
		$model->initStates();

		// Get the start limit from the request
		$startlimit 	= JRequest::getVar( 'limitstart', '');

		// By default albums should be sorted by creation date.
		$ordering 		= JRequest::getVar( 'ordering' , 'created' );

		if( !$startlimit )
		{
			$model->setState( 'limitstart', 0);
		}

		// Get a list of normal albums
		$options 				= array();
		$options['pagination']	= true;
		$options['order'] 		= 'a.assigned_date';
		$options['direction'] 	= 'DESC';
		$options[ 'core' ]		= false;

		if( $ordering == 'alphabetical' )
		{
			$options[ 'order' ]		= 'a.title';
			$options[ 'direction' ]	= 'ASC';
		}

		if( $ordering == 'popular' )
		{
			$options[ 'order' ]		= 'a.hits';
			$options[ 'direction' ]	= 'DESC';
		}

		// Get the albums
		$albums 		= $model->getAlbums( '' , SOCIAL_TYPE_USER , $options );

		// Get the album pagination
		$pagination 	= $model->getPagination();

		$lib 			= Foundry::albums( Foundry::user()->id , SOCIAL_TYPE_USER );
		
		$this->set( 'ordering'		, $ordering );
		$this->set( 'lib'			, $lib );
		$this->set( 'albums'		, $albums );
		$this->set( 'pagination' 	, $pagination );

		// Wrap it with the albums wrapper.
		echo parent::display( 'site/albums/all' );
	}

	/**
	 * Displays a restricted page
	 *
	 * @since	1.0
	 * @access	public
	 * @param	int		The user's id
	 */
	public function restricted( $uid=null )
	{
		$uid  = (!empty($uid)) ? $uid : JRequest::getInt('userid' , null);
		$user = Foundry::user( $uid );

		$this->set( 'showProfileHeader', true);
		$this->set( 'user'   , $user );

		echo parent::display( 'site/albums/restricted' );
	}

	/**
	 * If the user is viewing an invalid album.
	 *
	 * @since	1.0
	 * @access	public
	 * @param	int		Optional user id
	 */
	public function deleted()
	{
		$uid 	= JRequest::getInt( 'uid' );
		$type 	= JRequest::getWord( 'type' , SOCIAL_TYPE_USER );

		// Load the albums library
		$albums 	= Foundry::albums( $uid , $type );

		$this->set( 'lib' , $albums );

		echo parent::display( 'site/albums/deleted' );
	}

	/**
	 * Displays the album item
	 *
	 * @since	1.0
	 * @access	public
	 */
	public function item()
	{
		// Check if photos is enabled
		$this->checkFeature();

		// Get logged in user
		$my		= Foundry::user();

		// Get the unique id and type
		$uid 	= JRequest::getInt( 'uid' );
		$type 	= JRequest::getWord( 'type' , SOCIAL_TYPE_USER );

		// Retrieve the album from request
		$id		= JRequest::getInt( 'id', null );

		// Load up teh albums library
		$lib 	= Foundry::albums( $uid , $type , $id );

		// Empty id or invalid id is not allowed.
		if( !$id || !$lib->data->id )
		{
			return $this->deleted();
		}

		// Check if the album is viewable
		if( !$lib->data->viewable() )
		{
			return $this->restricted( $lib->data->uid );
		}

		// Increment the hit of the album
		$lib->data->addHit();

		// Get a list of photos within this album
		$photos 	= $lib->getPhotos( $lib->data->id );
		$photos 	= $photos[ 'photos' ];

		// Set the opengraph data for photos within this album
		if( $photos )
		{
			foreach( $photos as $photo )
			{
				Foundry::opengraph()->addImage( $photo->getSource() );
			}
		}

		// Set page title
		$title 	= $lib->getPageTitle( $this->getLayout() );
		Foundry::page()->title( $title );

		// Set the breadcrumbs
		$lib->setBreadcrumbs( $this->getLayout() );

		// Render options
		$options = array( 'viewer' => $my->id );

		// Render item
		$output 	= $lib->renderItem( $options );

		return $this->output( $uid , $type , $output , $lib->data );
	}

	/**
	 * Renders the album's form
	 *
	 * @since	1.0
	 * @access	public
	 */
	public function form()
	{
		// Check if photos is enabled
		$this->checkFeature();

		// Only allow registered users to upload photos
		Foundry::requireLogin();

		// Get the current user
		$my		= Foundry::user();

		// Get album id
		$id		= JRequest::getInt( 'id', null );

		// Load album library
		$uid 	= JRequest::getInt( 'uid' );
		$type 	= JRequest::getWord( 'type' , SOCIAL_TYPE_USER );

		$lib 	= Foundry::albums( $uid , $type , $id );

		// If we are creating an album
		if ( !$lib->data->id )
		{
			// Set the ownership of the album
			$lib->data->uid 	= $lib->uid;
			$lib->data->type 	= $lib->type;

			// Check if we have exceeded album creation limit.
			if( $lib->exceededLimits() )
			{
				return $this->output( $lib->getExceededHTML() , $lib->data );
			}
		}

		// Set the page title
		$title 	= $lib->getPageTitle( $this->getLayout() );
		Foundry::page()->title( $title );

		// Set the breadcrumbs
		$lib->setBreadcrumbs( $this->getLayout() );

		// Determines if the current user can edit this album
		if( !$lib->editable( $lib->data ) )
		{
			return $this->restricted( $lib );
		}

		// Render options
		$options = array(
							'viewer'       => $my->id,
							'layout'       => 'form',
							'showStats'    => false,
							'showResponse' => false,
							'showTags'     => false
						);

		// Render item
		$output	= $lib->renderItem( $options );

		return $this->output( $lib->uid , $lib->type , $output , $lib->data );
	}

	/**
	 * Displays the albums a user has
	 *
	 * @since	1.0
	 * @access	public
	 * @author	Mark Lee <mark@stackideas.com>
	 */
	public function output( $uid , $type , $content = '' , $album = false )
	{
		// Load up the albums library
		$lib 	= Foundry::albums( $uid , $type , $album ? $album->id : null );

		// If no layout was given, load recent layout
		$layout		= JRequest::getCmd( 'layout' , 'recent' );

		// Browser menu
		$id 		= JRequest::getInt( 'id' );

		// Load up the model
		$model		= Foundry::model( 'Albums' );

		// Get a list of core albums
		$coreAlbums	= $model->getAlbums( $lib->uid , $lib->type , array( 'coreAlbumsOnly' => true ) );

		// Get a list of normal albums
		$options				= array();
		$options['core'] 		= false;
		$options['order'] 		= 'a.assigned_date';
		$options['direction'] 	= 'DESC';

		$albums 	= $model->getAlbums( $lib->uid , $lib->type , $options );

		// Browser frame
		// Get the user alias
		$userAlias 		= '';
		// $userAlias	= $user->getAlias();

		$this->set( 'lib'		, $lib );
		$this->set( 'userAlias'	, $userAlias );
		$this->set( 'id'     	, $id );
		$this->set( 'coreAlbums', $coreAlbums );
		$this->set( 'albums' 	, $albums );
		$this->set( 'content'	, $content );
		$this->set( 'uuid'   	, uniqid() );
		$this->set( 'layout' 	, $layout );

		echo parent::display( 'site/albums/default' );
	}

	/**
	 * Post processing when creating a new album
	 *
	 * @since	1.0
	 * @access	public
	 */
	public function store( $album = null )
	{
		// Require user to be logged in
		Foundry::requireLogin();

		Foundry::info()->set( $this->getMessage() );

		if( $this->hasErrors() )
		{
			return $this->form();
		}

		return $this->redirect( FRoute::albums( array('id' => $album->getAlias() , 'layout' => 'item' )) );
	}

	/**
	 * Post processing when deleting an album
	 *
	 * @since	1.0
	 * @access	public
	 * @param	string
	 * @return
	 */
	public function delete( $link )
	{
		// Require user to be logged in
		Foundry::requireLogin();

		Foundry::info()->set( $this->getMessage() );

		$this->redirect( $link );
	}
}
