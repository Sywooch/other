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

class EasySocialViewStream extends EasySocialSiteView
{
	/**
	 * Responsible to output a single stream item.
	 *
	 * @access	public
	 * @return	null
	 *
	 */
	public function item()
	{
		// Get the stream id from the request
		$id 	= JRequest::getInt( 'id' );

		if( !$id )
		{
			Foundry::info()->set( JText::_( 'COM_EASYSOCIAL_STREAM_INVALID_STREAM_ID' ) , SOCIAL_MSG_ERROR );

			return $this->redirect( FRoute::dashbaord( array() , false ) );
		}

		// Get the current logged in user.
		$user 	= Foundry::user();

		// Retrieve stream
		$streamLib 	= Foundry::stream();
		$stream		= $streamLib->getItem( $id );


		if( $stream === true || count( $stream ) <= 0 )
		{
			// this mean either the user do not have have permission to view the stream or user do not have the required app to generate the stream.
			$actor = $streamLib->getStreamActor( $id );

			$this->set( 'user' , $actor );
			parent::display( 'site/stream/restricted' );

			return;
		}

		$stream 	= $stream[0];

		$title		= strip_tags( $stream->title );

		// Set the page title
		Foundry::page()->title( $title );


		// Get stream actions
		$actions 	= $streamLib->getActions( $stream );

		$this->set( 'actions' , $actions );
		$this->set( 'user' 	, $user );
		$this->set( 'stream', $stream );

		echo parent::display( 'site/stream/item' );
	}

	public function saveFilter( $filter )
	{
		// Unauthorized users should not be allowed to access this page.
		Foundry::requireLogin();

		Foundry::info()->set( $this->getMessage() );

		if( $filter->id )
		{
			//$this->redirect( FRoute::stream( array( 'layout' => 'form', 'id' => $filter->id ) , false ) );
			$this->redirect( FRoute::dashboard( array(), false ) );
		}
		else
		{
			$model = Foundry::model( 'Stream' );
			$items = $model->getFilters( Foundry::user()->id );

			$this->set( 'items', $items );

			$this->set( 'filter', $filter );
			echo parent::display( 'site/stream/filter.form' );
		}
	}


	public function form()
	{
		// Unauthorized users should not be allowed to access this page.
		Foundry::requireLogin();

		$my 	= Foundry::user();
		$id 	= JRequest::getInt( 'id', 0 );

		$filter = Foundry::table( 'StreamFilter' );
		$filter->load( $id );

		$model = Foundry::model( 'Stream' );
		$items = $model->getFilters( $my->id );

		$this->set( 'filter', $filter );
		$this->set( 'items', $items );


		// Set page title
		if( $filter->id )
		{
			Foundry::page()->title( JText::sprintf( 'COM_EASYSOCIAL_STREAM_FILTER_EDIT_FILTER', $filter->title ) );
		}
		else
		{
			Foundry::page()->title( JText::_( 'COM_EASYSOCIAL_STREAM_FILTER_CREATE_NEW_FILTER' ) );
		}

		// Set the page breadcrumb
		Foundry::page()->breadcrumb( JText::_( 'COM_EASYSOCIAL_PAGE_TITLE_DASHBOARD' ) , FRoute::dashboard() );
		Foundry::page()->breadcrumb( JText::_( 'Filter' ) );


		echo parent::display( 'site/stream/filter.form' );
	}

}
