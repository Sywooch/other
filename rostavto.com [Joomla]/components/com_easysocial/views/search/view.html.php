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

class EasySocialViewSearch extends EasySocialSiteView
{
	/**
	 * Responsible to output the search layout.
	 *
	 * @access	public
	 * @return	null
	 *
	 */
	public function display( $tpl = null )
	{
		// Get the current logged in user.

		$query	= JRequest::getVar( 'q', NULL );
		$type	= JRequest::getString( 'type', '' );

		$indexModel 	= Foundry::model( 'Indexer' );


		// make the the type are the supported type.
		$supportedType = $indexModel->getSupportedType();

		if( ! in_array( $type, $supportedType ) )
		{
			$type = '';
		}

		$my 	= Foundry::user();

		// default value.
		$data			= null;
		$types			= null;
		$count 			= 0;
		$next_limit 	= '';
		$limit 			= Foundry::themes()->getConfig()->get( 'search_limit' );

		$model 	= Foundry::model( 'Search' );

		if( !empty( $query ) )
		{
			$data			= $model->getItems( $query, $type, $next_limit, $limit );
			$count   		= $model->getCount();
			$next_limit 	= $model->getNextLimit();

			// @badge: search.create
			// Assign badge for the person that initiated the friend request.
			$badge 	= Foundry::badges();
			$badge->log( 'com_easysocial' , 'search.create' , $my->id , JText::_( 'COM_EASYSOCIAL_SEARCH_BADGE_SEARCHED_ITEM' ) );
		}

		// Set the page title
		Foundry::page()->title( JText::_( 'COM_EASYSOCIAL_PAGE_TITLE_SEARCH' ) );

		// Set the page breadcrumb
		Foundry::page()->breadcrumb( JText::_( 'COM_EASYSOCIAL_PAGE_TITLE_SEARCH' ) );

		// get types
		$types	= $model->getTypes();

		foreach( $types as &$type )
		{
			$type->icon = 'file';

			if( $type->utype == 'users' )
			{
				$type->icon 	= 'user';
			}

			if( $type->utype == 'photos' )
			{
				$type->icon		= 'picture';
			}

			if( $type->utype == 'lists' )
			{
				$type->icon		= 'bookmark';
			}

			if( $type->utype == 'albums' )
			{
				$type->icon		= 'pictures';
			}
		}

		$this->set( 'types'		, $types );
		$this->set( 'data'		, $data );
		$this->set( 'query'		, $query );
		$this->set( 'total'		, $count );
		$this->set( 'next_limit', $next_limit);
		$this->set( 'totalcount', $count );

		echo parent::display( 'site/search/default' );
	}

	/**
	 * Displays the advanced search form
	 *
	 * @since	1.0
	 * @access	public
	 */
	public function advanced( $tpl = null )
	{
		// Set the page title
		Foundry::page()->title( JText::_( 'COM_EASYSOCIAL_PAGE_TITLE_ADVANCED_SEARCH' ) );

		// Set the page breadcrumb
		Foundry::page()->breadcrumb( JText::_( 'COM_EASYSOCIAL_PAGE_TITLE_ADVANCED_SEARCH' ) );

		// Get current logged in user.
		$my 			= Foundry::user();

		// What is this? - this is advanced search filter id.
		$fid 			= JRequest::getInt( 'fid', 0 );

		// Get filters
		$model 		= Foundry::model( 'Search' );
		$filters 	= $model->getFilters( $my->id );

		// Load up advanced search library
		$library 	= Foundry::get( 'AdvancedSearch' );

		// default values
		// Get values from posted data
		$match 		= JRequest::getVar( 'matchType', 'all' );
		$avatarOnly	= JRequest::getInt( 'avatarOnly', 0 );

		// Get values from posted data
		$values 				= array();
		$values[ 'criterias' ] 	= JRequest::getVar( 'criterias' );
		$values[ 'operators' ] 	= JRequest::getVar( 'operators' );
		$values[ 'conditions' ] = JRequest::getVar( 'conditions' );
		$values[ 'match' ] 		= $match;
		$values[ 'avatarOnly' ] = $avatarOnly;

		// Default values
		$results 		= null;
		$total 			= 0;
		$nextlimit 		= null;
		$criteriaHTML 	= '';


		if( $fid && empty( $values[ 'criterias' ] ) )
		{
			// we need to load the data from db and do the search based on the saved filter.
			$filter = Foundry::table( 'SearchFilter' );
			$filter->load( $fid );

			// data saved as json format. so we need to decode it.
			$dataFilter = Foundry::json()->decode( $filter->filter );

			// override with the one from db.
			$values['criterias'] 		= $dataFilter->{'criterias[]'};
			$values['operators'] 		= $dataFilter->{'operators[]'};
			$values['conditions'] 		= $dataFilter->{'conditions[]'};

			// we need check if the item passed in is array or not. if not, make it an array.
			if( ! is_array( $values['criterias'] ) )
			{
				$values['criterias'] = array( $values['criterias'] );
			}

			if( ! is_array( $values['operators'] ) )
			{
				$values['operators'] = array( $values['operators'] );
			}

			if( ! is_array( $values['conditions'] ) )
			{
				$values['conditions'] = array( $values['conditions'] );
			}


			$values['match'] 			= isset( $dataFilter->matchType ) ? $dataFilter->matchType : 'all';
			$values['avatarOnly']		= isset( $dataFilter->avatarOnly ) ? true : false;

			$match 		= $values['match'];
			$avatarOnly	= $values['avatarOnly'];

		}

		// If there are criterias, we know the user is making a post request to search
		if( $values[ 'criterias' ] )
		{
			$results	= $library->search( $values );
			$total 		= $library->getTotal();
			$nextlimit 	= $library->getNextLimit();
		}

		// Get search criteria output
		$criteriaHTML	= $library->getCriteriaHTML( array() , $values );

		$this->set( 'criteriaHTML'	, $criteriaHTML );
		$this->set( 'match'			, $match );
		$this->set( 'avatarOnly'	, $avatarOnly );
		$this->set( 'results'		, $results );
		$this->set( 'total'			, $total );
		$this->set( 'nextlimit'		, $nextlimit );
		$this->set( 'filters'		, $filters);
		$this->set( 'fid'			, $fid );

		echo parent::display( 'site/advancedsearch/user/default' );
	}
}
