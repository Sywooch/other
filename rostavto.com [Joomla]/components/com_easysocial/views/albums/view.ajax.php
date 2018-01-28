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
	public function exceeded($uid=null)
	{
		$ajax = Foundry::ajax();

		$uid  = (!empty($uid)) ? $uid : JRequest::getInt('userid' , null);
		$user = Foundry::user( $uid );

		$theme = Foundry::themes();
		$theme->set( 'showProfileHeader', false );
		$theme->set( 'user'   , $user );

		$html = $theme->output( 'site/albums/exceeded' );
		$ajax->resolve( $html );
	}

	public function restricted($uid=null)
	{
		$ajax = Foundry::ajax();

		$uid  = (!empty($uid)) ? $uid : JRequest::getInt('userid' , null);
		$user = Foundry::user( $uid );

		$theme = Foundry::themes();
		$theme->set( 'showProfileHeader', false );
		$theme->set( 'user'   , $user );

		$html = $theme->output( 'site/albums/restricted' );
		$ajax->resolve( $html );
	}

	public function deleted($uid=null)
	{
		$ajax = Foundry::ajax();

		$uid  = (!empty($uid)) ? $uid : JRequest::getInt('userid' , null);
		$user = Foundry::user( $uid );

		$theme = Foundry::themes();
		$theme->set( 'user'   , $user );
		$html = $theme->output( 'site/albums/deleted' );

		$ajax->resolve( $html );
	}

	/**
	 * Post process after retrieving albums
	 *
	 * @since	1.2
	 * @access	public
	 * @param	string
	 * @return	
	 */
	public function getAlbums( $albums , $pagination ) 
	{
		$ajax 	= Foundry::ajax();

		$lib 	= Foundry::albums( Foundry::user()->id , SOCIAL_TYPE_USER );

		$theme 	= Foundry::themes();

		$theme->set( 'lib' , $lib );
		$theme->set( 'albums' , $albums );
		$theme->set( 'pagination' , $pagination );

		// Wrap it with the albums wrapper.
		$contents 	= $theme->output( 'site/albums/all.items' );

		return $ajax->resolve( $contents );
	}

	/**
	 * Renders the single album view
	 *
	 * @since	1.0
	 * @access	public
	 */
	public function item()
	{
		$ajax = Foundry::ajax();

		$my = Foundry::user();

		// Get the album id
		$id 	= JRequest::getInt( 'id' );
		
		$album 	= Foundry::table( 'Album' );
		$album->load( $id );

		// Empty id or invalid id is not allowed.
		if( !$id || !$album->id )
		{
			return $this->deleted();
		}

		// Load up the albums library
		$lib 	= Foundry::albums( $album->uid , $album->type , $album->id );

		// Check if the album is viewable
		// if( !$lib->viewable() )
		if( !$lib->data->viewable() )
		{
			return $this->restricted( $lib->data->uid );
		}

		// Get the rendering options
		$options	= JRequest::getVar( 'renderOptions' , array());

		// Render the album item
		$output 	= $lib->renderItem( $options );

		return $ajax->resolve( $output );
	}

	/**
	 * Renders the album form.
	 *
	 * @since	1.0
	 * @access	public
	 */
	public function form()
	{
		// Only allow registered users to upload photos
		Foundry::requireLogin();

		$ajax	= Foundry::ajax();

		// Get current logged in user
		$my		= Foundry::user();

		// Get album id
		$id		= JRequest::getInt( 'id', null );

		// Get the uid and type from request
		$uid 	= JRequest::getInt( 'uid' );
		$type 	= JRequest::getWord( 'type' , SOCIAL_TYPE_USER );

		// Load up the albums library
		$lib 	= Foundry::albums( $uid , $type , $id );

		// If we are creating an album
		if ( !$lib->data->id )
		{
			// Check if we have exceeded album creation limit first
			if( $lib->exceededLimits() )
			{
				return $this->exceeded( $my->id );
			}

			// Set album ownershipts
			$lib->data->uid 		= $uid;
			$lib->data->type 		= $type;

			// Set album creator to the current logged in user.
			$lib->data->user_id 	= $my->id;
		}

		if( !$lib->editable( $lib->data ) )
		{
			return $this->restricted( $lib->data->uid );
		}

		// Render options
		$options = array(
							'layout' => 'form',
							'showStats'    => false,
							'showResponse' => false,
							'showTags'     => false
						);

		// Render the album item
		$output	= $lib->renderItem( $options );


		return $ajax->resolve( $output );
	}

	/**
	 * Displays the album browser
	 *
	 * @since	1.0
	 * @access	public
	 * @param	string
	 * @return	
	 */
	public function dialog()
	{
		// Only logged in user is allowed here.
		Foundry::requireLogin();

		// Load the ajax library
		$ajax = Foundry::ajax();

		// Get the current user.
		$my 		= Foundry::user();

		// Get the items to be loaded
		$uid 		= JRequest::getInt( 'uid' );
		$type 		= JRequest::getCmd( 'type' );

		// Load up the album library
		$lib 		= Foundry::albums( $uid , $type );

		// @TODO: Check if the current viewer can really browse items here.
		if( !$lib->allowMediaBrowser() )
		{
			return $ajax->reject();
		}
		
		// Browser menu
		$id 		= JRequest::getInt( 'id' );

		// Retrieve the albums now.
		$model 		= Foundry::model( 'Albums' );
		$albums 	= $model->getAlbums( $uid , $type );

		$content	= '<div class="es-content-hint">' . JText::_('COM_EASYSOCIAL_ALBUMS_SELECT_ALBUM_HINT') . '</div>';
		$layout		= "item";


		$theme = Foundry::themes();

		$theme->set( 'id'     	, $id );
		$theme->set( 'content'	, $content );
		$theme->set( 'albums' 	, $albums );
		$theme->set( 'uuid'   	, uniqid() );
		$theme->set( 'layout' 	, $layout );

		$html = $theme->output( 'site/albums/dialog' );

		return $ajax->resolve( $html );
	}

	/**
	 * Returns a list of likes for this album
	 *
	 * @since	1.0
	 * @access	public
	 * @param	string
	 * @return
	 */
	public function response()
	{
		$ajax = Foundry::ajax();

		// Get id from request.
		$id 	= JRequest::getInt( 'id' );

		$album 	= Foundry::table( 'Album' );
		$album->load( $id );

		if( !$id || !$album->id )
		{
			return $ajax->reject();
		}

		$theme = Foundry::themes();
		$theme->set( 'album' , $album );
		$html = $theme->output( 'site/albums/album.response' );

		return $ajax->resolve( $html );
	}

	/**
	 * Retrieves a list of albums
	 *
	 * @since	1.0
	 * @access	public
	 * @param	string
	 * @return
	 */
	public function listItems( $albums )
	{
		$ajax 	= Foundry::ajax();

		return $ajax->resolve( $albums );
	}

	/**
	 * Returns album object to the caller.
	 *
	 * @since	1.0
	 * @access	public
	 * @param	string
	 * @return
	 */
	public function getAlbum( $album = null )
	{
		$ajax 	= Foundry::ajax();

		if( $this->hasErrors() )
		{
			return $ajax->reject( $this->getMessage() );
		}

		return $ajax->resolve( $album->export(array('cover', 'photos')) );
	}

	/**
	 * Post processing when creating a new album
	 *
	 * @since	1.0
	 * @access	public
	 */
	public function store( $album = null )
	{
		$ajax 	= Foundry::ajax();

		if( $this->hasErrors() )
		{
			return $ajax->reject( $this->getMessage() );
		}

		// Success message
		$theme 		= Foundry::themes();
		$theme->set( 'album' , $album );
		$message 	= $theme->output( 'site/albums/message.album.save' );

		// Notify user that the msg is saved
		$ajax->notify($message, SOCIAL_MSG_SUCCESS);
		
		// Load up the library
		$lib 	= Foundry::albums( $album->uid , $album->type , $album->id );
		$output = $lib->renderItem();

		return $ajax->resolve( $album->export() , $output );
	}

	/**
	 * Post process after an album is deleted
	 *
	 * @since	1.0
	 * @access	public
	 * @param	int		The state
	 */
	public function delete( $state )
	{
		$ajax = Foundry::ajax();

		if (!$state) {

			return $ajax->reject( $this->getMessage() );
		}

		$redirect = JRequest::getBool('redirect', 1);

		if ($redirect)
		{
			$url = FRoute::albums();
			return $ajax->redirect( $url );
		}
		else
		{
			return $ajax->resolve();
		}
	}

	/**
	 * Displays a confirmation dialog to delete an album.
	 *
	 * @since	1.0
	 * @access	public
	 */
	public function confirmDelete()
	{
		$ajax = Foundry::ajax();

		$id 	= JRequest::getInt( 'id' );

		// Get dialog
		$theme	= Foundry::themes();
		$theme->set( 'id' , $id );
		$output	= $theme->output( 'site/albums/dialog.delete' );

		return $ajax->resolve( $output );
	}

	public function setCover( $photo = null )
	{
		$ajax = Foundry::ajax();

		if( $this->hasErrors() )
		{
			return $ajax->reject( $this->getMessage() );
		}

		return $ajax->resolve( $photo->export() );
	}

	public function playlist( $photos = array() )
	{
		$ajax 	= Foundry::ajax();

		if( $this->hasErrors() )
		{
			return $ajax->reject( $this->getMessage() );
		}
		
		return $ajax->resolve( $photos );
	}

	public function loadMore( $photos = array(), $nextStart = 0 )
	{
		$ajax = Foundry::ajax();

		if( $this->hasErrors() )
		{
			return $ajax->reject( $this->getMessage() );
		}

		// Get the current logged in user.
		$my = Foundry::user();		

		// Get layout
		$layout = JRequest::getCmd('layout', 'item');

		$options = array(
			'viewer' => $my->id,
			'layout' => $layout,
			'showResponse' => false,
			'showTags'     => false
		);

		if ($layout=="dialog") {
			$options['showForm'] = false;
			$options['showInfo'] = false;
			$options['showStats'] = false;
			$options['showToolbar'] = false;
		}

		$htmls = array();

		foreach( $photos as $photo )
		{
			$htmls[] = Foundry::photo( $photo->id )->renderItem( $options );
		}		

		return $ajax->resolve( $htmls, $nextStart );
	}

	public function reorder()
	{
		$ajax = Foundry::ajax();

		if( $this->hasErrors() )
		{
			return $ajax->reject( $this->getMessage() );
		}

		return $ajax->resolve();
	}

}
