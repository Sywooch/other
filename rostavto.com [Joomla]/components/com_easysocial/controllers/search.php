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

Foundry::import( 'site:/controllers/controller' );

class EasySocialControllerSearch extends EasySocialController
{
	/**
	 * get activity logs.
	 *
	 * @since	1.0
	 * @access	public
	 */
	public function getItems()
	{
		// Check for request forgeries!
		Foundry::checkToken();

		// search controller do not need to check islogin.

		// Get the current view
		$view 			= $this->getCurrentView();

		// Get current logged in user
		$my 			= Foundry::user();

		$type 			= JRequest::getVar( 'type', '' );
		$keywords 		= JRequest::getVar( 'q', '' );
		$next_limit 	= JRequest::getVar( 'next_limit', '' );
		$last_type 		= JRequest::getVar( 'last_type', '' );
		$isloadmore 	= JRequest::getVar( 'loadmore', false );
		$ismini 		= JRequest::getVar( 'mini', false );

		$limit 			= ( $ismini ) ? Foundry::themes()->getConfig()->get( 'search_toolbarlimit' ) : Foundry::themes()->getConfig()->get( 'search_limit' );

		// @badge: search.create
		// Assign badge for the person that initiated the friend request.
		$badge 	= Foundry::badges();
		$badge->log( 'com_easysocial' , 'search.create' , $my->id , JText::_( 'COM_EASYSOCIAL_SEARCH_BADGE_SEARCHED_ITEM' ) );

		$model			= Foundry::model( 'Search' );
		$result 		= $model->getItems( $keywords, $type, $next_limit, $limit );
		$count 			= $model->getCount();
		$next_limit 	= $model->getNextLimit();

		return $view->call( __FUNCTION__, $result, $last_type, $next_limit, $isloadmore, $ismini, $count );

	}

	public function deleteFilter()
	{
		// Check for request forgeries.
		Foundry::checkToken();

		// In order to access the dashboard apps, user must be logged in.
		Foundry::requireLogin();

		$view 	= Foundry::view( 'Search' , false );
		$my 	= Foundry::user();

		$id 	= JRequest::getInt( 'fid', 0 );

		if(! $id )
		{
			Foundry::getInstance( 'Info' )->set( JText::_( 'Invalid filter id - ' . $id ) , 'error' );
			$view->setError( JText::_( 'Invalid filter id.' ) );
			return $view->call( __FUNCTION__ );
		}


		$filter = Foundry::table( 'SearchFilter' );

		// make sure the user is the filter owner before we delete.
		$filter->load( array( 'id' => $id, 'uid' => $my->id, 'element' => 'user' ) );

		if(! $filter->id )
		{
			Foundry::getInstance( 'Info' )->set( JText::_( 'Filter not found - ' . $id ) , 'error' );
			$view->setError( JText::_( 'Filter not found. Action aborted.' ) );
			return $view->call( __FUNCTION__ );
		}

		$filter->delete();

		$view->setMessage( JText::_( 'COM_EASYSOCIAL_STREAM_FILTER_DELETED' ) , SOCIAL_MSG_SUCCESS );

		return $view->call( __FUNCTION__ );
	}

	// this method is called from the dialog to quickly add new filter based on the viewing hashtag.
	public function addFilter()
	{
		// Check for request forgeries.
		Foundry::checkToken();

		// In order to access the dashboard apps, user must be logged in.
		Foundry::requireLogin();

		$my 	= Foundry::user();

		$view 	= Foundry::view( 'Search' , false );

		$title   	= JRequest::getVar( 'title' );
		$data   	= JRequest::getVar( 'data' );

		$filter = Foundry::table( 'SearchFilter' );

		$filter->title 		= $title;
		$filter->uid   		= $my->id;
		$filter->element 	= SOCIAL_TYPE_USER;
		$filter->created_by = $my->id;
		$filter->filter 	= $data; // as as json string.
		$filter->created 	= Foundry::date()->toMySQL();

		$filter->store();

		$view->setMessage( JText::_( 'COM_EASYSOCIAL_ADVANCED_SEARCH_FILTER_SAVED' ) , SOCIAL_MSG_SUCCESS );

		return $view->call( __FUNCTION__, $filter );
	}

	/**
	 * Allows caller to retrieve saved search results
	 *
	 * @since	1.2
	 * @access	public
	 */
	public function getFilterResults()
	{
		// Check for request forgeries.
		Foundry::checkToken();

		// In order to access the dashboard apps, user must be logged in.
		Foundry::requireLogin();

		$view 	= Foundry::view( 'Search' , false );
		$fid 	= JRequest::getVar( 'fid', '' );
		$fname  = '';

		$data['criteria'] 			= '';
		$data['match']				= 'all';
		$data['avatarOnly']			= 0;
		$data['total'] 				= 0;
		$data['results']			= null;
		$data['nextlimit']			= null;

		$library 	= Foundry::get( 'AdvancedSearch' );

		// this is doing new search
		$options = array();
		$options[ 'showPlus' ] 	= true;

		if( $fid )
		{
			// lets get the criteria from db.
			$filter = Foundry::table( 'SearchFilter' );
			$filter->load( $fid );

			$fname = $filter->title;

			// data saved as json format. so we need to decode it.
			//
			// var_dump( $filter->filter  );
			$dataFilter = Foundry::json()->decode( $filter->filter );

			$values = array();
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

			// perform search
			$values['match'] 			= isset( $dataFilter->matchType ) ? $dataFilter->matchType : 'all';
			$values['avatarOnly']		= isset( $dataFilter->avatarOnly ) ? true : false;

			$results 	= null;
			$total 		= 0;
			$nextlimit 	= null;

			// echo '<pre>';print_r( $values );echo '</pre>';exit;

			if( $values['criterias'] )
			{
				$results = $library->search( $values );

				$total 		= $library->getTotal();
				$nextlimit 	= $library->getNextLimit();
			}

			$criteriaHTML	= $library->getCriteriaHTML( $options, $values );

			$data['criteria'] 		= $criteriaHTML;
			$data['match']			= $values['match'];
			$data['avatarOnly']		= $values['avatarOnly'];
			$data['total'] 			= $total;
			$data['results']		= $results;
			$data['nextlimit']		= $nextlimit;
		}
		else
		{
			$criteriaHTML 		= $library->getCriteriaHTML( $options );
			$data['criteria'] 	= $criteriaHTML;
		}

		return $view->call( __FUNCTION__, $fid, $data );

	}

	public function loadmore()
	{
		Foundry::checkToken();

		$view 	= Foundry::view( 'Search' , false );

		$data 			= JRequest::getVar( 'data', '' );
		$nextlimit 		= JRequest::getVar( 'nextlimit', '' );

		$library 	= Foundry::get( 'AdvancedSearch' );


		// data saved as json format. so we need to decode it.
		$dataFilter = Foundry::json()->decode( $data );

		$values = array();
		$values['criterias'] 		= $dataFilter->{'criterias[]'};
		$values['operators'] 		= $dataFilter->{'operators[]'};
		$values['conditions'] 		= $dataFilter->{'conditions[]'};

		// perform search
		$values['match'] 			= $dataFilter->matchType;
		$values['avatarOnly']		= isset( $dataFilter->avatarOnly ) ? true : false;
		$values['nextlimit'] 		= $nextlimit;

		$results 	= null;
		$total 		= 0;
		$nextlimit 	= null;

		// var_dump( $values );


		if( $values['criterias'] )
		{
			$results 	= $library->search( $values );
			$total 		= $library->getTotal();
			$nextlimit 	= $library->getNextLimit();
		}


		// var_dump( $results, $nextlimit );
		// exit;

		return $view->call( __FUNCTION__, $results, $nextlimit );
	}

	/**
	 * Allows caller to get a list of operators for advanced search
	 *
	 * @since	1.2
	 * @access	public
	 */
	public function getOperators()
	{
		// Check for request forgeries.
		Foundry::checkToken();

		$key 			= JRequest::getVar( 'key' );
		$element 		= JRequest::getVar( 'element' );

		// Get the current view
		$view	= $this->getCurrentView();

		// Set the default options
		$options				= array();
		$options[ 'fieldCode' ] = $key;
		$options[ 'fieldType' ] = $element;

		// Load up advanced search library
		$library		= Foundry::get( 'AdvancedSearch' );

		// Get the operator's html codes
		$operatorHTML	= $library->getOperatorHTML( $options );

		// now we get the default condition
		$options[ 'fieldOperator' ] = 'equal';
		$conditionHTML	= $library->getConditionHTML( $options );

		return $view->call( __FUNCTION__, $operatorHTML, $conditionHTML );
	}


	/**
	 * Allows caller to get a list of conditions for advanced search
	 *
	 * @since	1.2
	 * @access	public
	 */
	public function getConditions()
	{
		// Check for request forgeries.
		Foundry::checkToken();

		$element 		= JRequest::getVar( 'element' );
		$operator 		= JRequest::getVar( 'operator' );

		// Get the current view
		$view 	= $this->getCurrentView();

		$options 					= array();
		$options[ 'fieldType' ]		= $element;
		$options[ 'fieldOperator' ] = $operator;

		$library 		= Foundry::get( 'AdvancedSearch' );
		$conditionHTML	= $library->getConditionHTML( $options );

		return $view->call( __FUNCTION__, $conditionHTML );
	}

}
