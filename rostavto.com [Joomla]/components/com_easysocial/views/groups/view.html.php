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


class EasySocialViewGroups extends EasySocialSiteView
{
	/**
	 * Checks if this feature should be enabled or not.
	 *
	 * @since	1.2
	 * @access	private
	 * @author	Mark Lee <mark@stackideas.com>
	 */
	private function checkFeature()
	{
		$config	= Foundry::config();

		// Do not allow user to access groups if it's not enabled
		if( !$config->get( 'groups.enabled' ) )
		{
			$this->setMessage( JText::_( 'COM_EASYSOCIAL_GROUPS_DISABLED' ) , SOCIAL_MSG_ERROR );

			Foundry::info()->set( $this->getMessage() );
			$this->redirect( FRoute::dashboard( array() , false ) );
			$this->close();
		}
	}

	/**
	 * Default method to display the all groups page.
	 *
	 * @since	1.2
	 * @access	public
	 * @author	Mark Lee <mark@stackideas.com>
	 */
	public function display( $tpl = null )
	{
		$this->checkFeature();

		// Set the page title
		Foundry::page()->title( JText::_( 'COM_EASYSOCIAL_PAGE_TITLE_GROUPS' ) );

		// Set the page breadcrumb
		Foundry::page()->breadcrumb( JText::_( 'COM_EASYSOCIAL_PAGE_TITLE_GROUPS' ) );

		$id 	= JRequest::getInt( 'userid' );
		$id 	= !$id ? null : $id;
		$user 	= Foundry::user( $id );
		$my 	= Foundry::user();

		// Get active filter
		$filter			= JRequest::getWord( 'filter' , 'all' );

		// Get a list of group categories
		$model 			= Foundry::model( 'Groups' );
		$categories 	= $model->getCategories( array( 'state' => SOCIAL_STATE_PUBLISHED ) );

		$options 		= array( 'state' => SOCIAL_STATE_PUBLISHED , 'featured' => false );

		// Determine the pagination limit
		$limit 				= Foundry::themes()->getConfig()->get( 'groups_limit' , 20 );
		$options[ 'limit' ]	= $limit;

		// Determine if this is filtering groups by category
		$categoryId 	= JRequest::getInt( 'categoryid' );

		if( $categoryId )
		{
			$category 	= Foundry::table( 'GroupCategory' );
			$category->load( $categoryId );

			$this->set( 'activeCategory'	, $category );

			$options[ 'category' ]	= $category->id;
			$filter 	= 'all';

			Foundry::page()->title( $category->get( 'title' ) );
		}
		else
		{
			$this->set( 'activeCategory' , false );
		}

		// If the default filter is invited, we only want to fetch groups that the user has been
		// invited to.
		if( $filter == 'invited' )
		{
			Foundry::page()->title( JText::_( 'COM_EASYSOCIAL_PAGE_TITLE_GROUPS_FILTER_INVITED' ) );

			$options[ 'invited' ]	= $my->id;
			$options[ 'types' ]		= 'all';
		}

		// Filter by own groups
		if( $filter == 'mine' )
		{
			Foundry::page()->title( JText::_( 'COM_EASYSOCIAL_PAGE_TITLE_GROUPS_FILTER_MY_GROUPS' ) );

			$options[ 'uid' ]		= $my->id;
			$options[ 'types' ]		= 'all';
		}

		// Get a list of groups
		if( $filter == 'featured' )
		{
			Foundry::page()->title( JText::_( 'COM_EASYSOCIAL_PAGE_TITLE_GROUPS_FILTER_FEATURED' ) );

			$groups 	= array();
		}
		else
		{
			$groups 		= $model->getGroups( $options );
		}

		// Load up the pagination for the groups here.
		$pagination 	= $model->getPagination();

		// Get total number of groups on the site
		$totalGroups 	= $model->getTotalGroups();

		// Get total number of featured groups on the site
		$totalFeaturedGroups 	= $model->getTotalGroups( array( 'featured' => true ) );

		// Get the total number of groups the user created
		$totalCreatedGroups		= $my->getTotalGroups();

		// Get a list of featured groups
		$options[ 'featured' ]	= true;
		$featuredGroups	= $model->getGroups( $options );

		// Get total number of invitations
		$totalInvites	= $model->getTotalInvites( $my->id );


		$this->set( 'totalCreatedGroups'	, $totalCreatedGroups );
		$this->set( 'totalFeaturedGroups' , $totalFeaturedGroups );
		$this->set( 'totalGroups'	, $totalGroups );
		$this->set( 'pagination'	, $pagination );
		$this->set( 'totalInvites'	, $totalInvites );
		$this->set( 'featuredGroups', $featuredGroups );
		$this->set( 'groups'		, $groups );
		$this->set( 'filter'		, $filter );
		$this->set( 'categories'	, $categories );
		$this->set( 'user'			, $user );

		parent::display( 'site/groups/default' );
	}

	/**
	 * Default method to display the group creation page.
	 * This is the first page that displays the category selection.
	 *
	 * @since	1.2
	 * @access	public
	 * @author	Mark Lee <mark@stackideas.com>
	 */
	public function create( $tpl = null )
	{
		// Only users with valid account is allowed to create
		Foundry::requireLogin();

		// Check if the user is allowed to create group or not.
		$my			= Foundry::user();

		if( !$my->getAccess()->get( 'groups.create' ) )
		{
			$this->setMessage( JText::_( 'COM_EASYSOCIAL_GROUPS_NOT_ALLOWED_TO_CREATE_GROUP' ) , SOCIAL_MSG_ERROR );
			Foundry::info()->set( $this->getMessage() );

			return $this->redirect( FRoute::dashboard( array() , false ) );
		}

		$model 		= Foundry::model( 'Groups' );
		$categories	= $model->getCategories( array( 'state' => SOCIAL_STATE_PUBLISHED ) );

		// Set the page title
		Foundry::page()->title( JText::_( 'COM_EASYSOCIAL_PAGE_TITLE_SELECT_GROUP_CATEGORY' ) );

		Foundry::page()->breadcrumb( JText::_( 'COM_EASYSOCIAL_PAGE_TITLE_GROUPS' ) , FRoute::groups() );
		Foundry::page()->breadcrumb( JText::_( 'COM_EASYSOCIAL_PAGE_TITLE_SELECT_GROUP_CATEGORY' ) );

		$this->set( 'categories' , $categories );

		parent::display( 'site/groups/create' );
	}

	/**
	 * Post process after user withdraws application to join the group
	 *
	 * @since	1.2
	 * @access	public
	 */
	public function withdraw( $group )
	{
		Foundry::info()->set( $this->getMessage() );

		return $this->redirect( FRoute::groups( array( 'layout' => 'item' , 'id' => $group->getAlias() ) , false ) );
	}

	/**
	 * Post process after a user leaves a group
	 *
	 * @since	1.2
	 * @access	public
	 */
	public function leaveGroup( $group )
	{
		Foundry::info()->set( $this->getMessage() );

		return $this->redirect( FRoute::groups( array( 'layout' => 'item' , 'id' => $group->getAlias() ) , false ) );
	}

	/**
	 * The workflow for creating a new group.
	 *
	 * @since	1.2
	 * @access	public
	 * @param	string
	 * @return
	 */
	public function steps()
	{
		// Only users with a valid account is allowed here.
		Foundry::requireLogin();

		// Check if the user is allowed to create group or not.
		$my			= Foundry::user();

		if( !$my->getAccess()->get( 'groups.create' ) )
		{
			$this->setMessage( JText::_( 'COM_EASYSOCIAL_GROUPS_NOT_ALLOWED_TO_CREATE_GROUP' ) , SOCIAL_MSG_ERROR );
			Foundry::info()->set( $this->getMessage() );

			return $this->redirect( FRoute::dashboard( array() , false ) );
		}

		// Get configuration data
		$config 	= Foundry::config();
		$info 		= Foundry::info();

		// Retrieve the user's session.
		$session    	= JFactory::getSession();
		$stepSession	= Foundry::table( 'StepSession' );
		$stepSession->load( $session->getId() );

		// If there's no registration info stored, the user must be a lost user.
		if( is_null( $stepSession->step ) )
		{
			$info->set( JText::_( 'Unable to detect active step access' ) , SOCIAL_MSG_ERROR );
			return $this->redirect( FRoute::groups( array() , false ) );
		}

		// Try to retrieve any available errors from the current registration object.
		$errors			= $stepSession->getErrors();

		// Try to remember the state of the user data that they have entered.
		$data           = $stepSession->getValues();

		// Get the current step index
		$stepIndex		= JRequest::getInt( 'step' , 1 );

		// Get the category that is being selected
		$categoryId 	= $stepSession->uid;

		// Load up the category
		$category		= Foundry::table( 'GroupCategory' );
		$category->load( $categoryId );

		// Determine the sequence from the step
		$sequence		= $category->getSequenceFromIndex( $stepIndex , SOCIAL_PROFILES_VIEW_REGISTRATION );

		// Users should not be allowed to proceed to a future step if they didn't traverse their sibling steps.
		if( empty( $stepSession->session_id ) || ( $sequence != 1 && !$stepSession->hasStepAccess( $sequence ) ) )
		{
			$info->set( false , JText::sprintf( 'Please complete the previous step %1s first.' , $sequence ) , SOCIAL_MSG_ERROR );

			return $this->redirect( FRoute::groups( array( 'layout' => 'steps' , 'step' => 1 ) , false ) );
		}

		// Check if this is a valid step in the profile
		if( !$category->isValidStep( $sequence, SOCIAL_GROUPS_VIEW_REGISTRATION ) )
		{
			$info->set( false , JText::sprintf( 'No access to this step %1s' , $sequence ) , SOCIAL_MSG_ERROR );

			return $this->redirect( FRoute::groups( array( 'layout' => 'steps' , 'step' => 1 ) , false ) );
		}

		// Remember current state of registration step
		$stepSession->set( 'step' , $sequence );
		$stepSession->store();

		// Load the current workflow / step.
		$step 		= Foundry::table( 'FieldStep' );
		$step->loadBySequence( $category->id , SOCIAL_TYPE_CLUSTERS , $sequence );

		// Determine the total steps for this profile.
		$totalSteps	= $category->getTotalSteps();

		// Since they are bound to the respective groups, assign the fields into the appropriate groups.
		$args 			= array( &$data , &$stepSession );

		// Get fields library as we need to format them.
		$fields 		= Foundry::getInstance( 'Fields' );

		// Retrieve custom fields for the current step
		$fieldsModel 	= Foundry::model( 'Fields' );
		$customFields	= $fieldsModel->getCustomFields( array( 'step_id' => $step->id , 'visible' => SOCIAL_GROUPS_VIEW_REGISTRATION ) );

		// Set the breadcrumb
		Foundry::page()->breadcrumb( JText::_( 'Groups' ) , FRoute::groups() );
		Foundry::page()->breadcrumb( JText::_( 'Create' ) , FRoute::groups( array( 'layout' => 'create' ) ) );
		Foundry::page()->breadcrumb( $step->get( 'title' ) );

		// Set the page title
		Foundry::page()->title( $step->get( 'title' ) );

		// Set the callback for the triggered custom fields
		$callback = array( $fields->getHandler(), 'getOutput' );

		// Trigger onRegister for custom fields.
		if( !empty( $customFields ) )
		{
			$fields->trigger( 'onRegister' , SOCIAL_FIELDS_GROUP_GROUP , $customFields , $args, $callback );
		}

		// Pass in the steps for this profile type.
		$steps 			= $category->getSteps( SOCIAL_GROUPS_VIEW_REGISTRATION );

		// Get the total steps
		$totalSteps		= $category->getTotalSteps( SOCIAL_PROFILES_VIEW_REGISTRATION );

		$this->set( 'stepSession'	, $stepSession );
		$this->set( 'steps'			, $steps );
		$this->set( 'currentStep'	, $sequence );
		$this->set( 'currentIndex'	, $stepIndex );
		$this->set( 'totalSteps'	, $totalSteps );
		$this->set( 'step'			, $step );
		$this->set( 'fields' 		, $customFields );
		$this->set( 'errors' 		, $errors );
		$this->set( 'category'		, $category );

		parent::display( 'site/groups/create.steps' );
	}

	/**
	 * Editing a group
	 *
	 * @since	1.2
	 * @access	public
	 * @param	string
	 * @return
	 */
	public function edit( $errors = false )
	{
		// Only users with a valid account is allowed here.
		Foundry::requireLogin();

		// Get configuration data
		$config 	= Foundry::config();
		$info 		= Foundry::info();

		// Load the language file from the back end.
		JFactory::getLanguage()->load( 'com_easysocial' , JPATH_ADMINISTRATOR );

		// Check if the user is allowed to create group or not.
		$my			= Foundry::user();

		// Get the group id
		$id 		= JRequest::getInt( 'id' );

		// Load the group
		$group		= Foundry::group( $id );

		if( !$id || !$group )
		{
			$this->setMessage( JText::_( 'COM_EASYSOCIAL_GROUPS_INVALID_GROUP_ID' ) , SOCIAL_MSG_ERROR );
			$info->set( $this->getMessage() );

			return $this->redirect( FRoute::dashboard( array() , false ) );
		}

		// Check if the user is allowed to edit this group
		if( !$group->isOwner() && !$group->isAdmin() && !$my->isSiteAdmin() )
		{
			$this->setMessage( JText::_( 'COM_EASYSOCIAL_GROUPS_NO_ACCESS' ) , SOCIAL_MSG_ERROR );
			$info->set( $this->getMessage() );

			return $this->redirect( FRoute::dashboard( array() , false ) );
		}

		// Set the breadcrumb
		Foundry::page()->breadcrumb( JText::_( 'Groups' ) , FRoute::groups() );
		Foundry::page()->breadcrumb( $group->getName() , $group->getPermalink() );
		Foundry::page()->breadcrumb( JText::_( 'Edit' ) );

		// Set the page title
		Foundry::page()->title( JText::sprintf( 'COM_EASYSOCIAL_PAGE_TITLE_GROUPS_EDIT' , $group->getName() ) );

		// Load up the category
		$category		= Foundry::table( 'GroupCategory' );
		$category->load( $group->category_id );

		// Get the steps model
		$stepsModel 	= Foundry::model( 'Steps' );
		$steps 			= $stepsModel->getSteps( $category->id , SOCIAL_TYPE_CLUSTERS , SOCIAL_PROFILES_VIEW_EDIT );
		$fieldsModel 	= Foundry::model( 'Fields' );

		// Get custom fields library.
		$fields 		= Foundry::fields();

		// Set the callback for the triggered custom fields
		$callback = array( $fields->getHandler(), 'getOutput' );

		// Get the custom fields for each of the steps.
		foreach( $steps as &$step )
		{
			$step->fields 	= $fieldsModel->getCustomFields( array( 'step_id' => $step->id , 'data' => true , 'dataId' => $group->id , 'dataType' => SOCIAL_TYPE_GROUP , 'visible' => 'edit' ) );

			// Trigger onEdit for custom fields.
			if( !empty( $step->fields ) )
			{
				$post	= JRequest::get( 'post' );
				$args 	= array( &$post , &$group , $errors );
				$fields->trigger( 'onEdit' , SOCIAL_TYPE_GROUP , $step->fields , $args, $callback );
			}
		}

		$this->set( 'group'	, $group );
		$this->set( 'steps'	, $steps );

		echo parent::display( 'site/groups/edit' );
	}

	/**
	 * Method is invoked each time a step is saved. Responsible to redirect or show necessary info about the current step.
	 *
	 * @since	1.0
	 * @access	public
	 * @param	SocialTableRegistration
	 * @param	int
	 * @param	bool
	 * @return	null
	 *
	 * @author	Mark Lee <mark@stackideas.com>
	 */
	public function saveStep( $session , $currentIndex , $completed = false )
	{
		$info 		= Foundry::info();
		$config 	= Foundry::config();

		// Set any message that was passed from the controller.
		$info->set( $this->getMessage() );

		// If there's an error, redirect back user to the correct step and show the error.
		if( $this->hasErrors() )
		{
			return $this->redirect( FRoute::groups( array( 'layout' => 'steps' , 'step' => $currentIndex ) , false ) );
		}

		// Registration is not completed yet, redirect user to the appropriate step.
		return $this->redirect( FRoute::groups( array( 'layout' => 'steps' , 'step' => $currentIndex + 1 ) , false ) );
	}

	/**
	 * Default method to display the group entry page.
	 *
	 * @since	1.2
	 * @access	public
	 * @author	Mark Lee <mark@stackideas.com>
	 */
	public function item( $tpl = null )
	{
		$id 		= JRequest::getInt( 'id' );
		$group 		= Foundry::group( $id );

		// Check if the group is valid
		if( !$id || !$group->id )
		{
			$this->setMessage( JText::_( 'COM_EASYSOCIAL_GROUPS_INVALID_GROUP_ID' ) , SOCIAL_MSG_ERROR );
			Foundry::info()->set( $this->getMessage() );

			return $this->redirect( FRoute::dashboard( array() , false ) );
		}

		// Ensure that the group is published
		if( !$group->isPublished() )
		{
			$this->setMessage( JText::_( 'COM_EASYSOCIAL_GROUPS_UNAVAILABLE' ) , SOCIAL_MSG_ERROR );
			Foundry::info()->set( $this->getMessage() );

			return $this->redirect( FRoute::dashboard( array() , false ) );
		}

		// Check if the group is accessible
		if( $group->isInviteOnly() && !$group->isMember() && !$group->isInvited() )
		{
			$this->setMessage( JText::_( 'COM_EASYSOCIAL_GROUPS_NOT_ALLOWED' ) , SOCIAL_MSG_ERROR );
			Foundry::info()->set( $this->getMessage() );

			return $this->redirect( FRoute::dashboard( array() , false ) );
		}

		// Set the page title.
		Foundry::page()->title( $group->getName() );

		// Set the breadcrumbs
		Foundry::page()->breadcrumb( JText::_( 'COM_EASYSOCIAL_GROUPS_PAGE_TITLE' ) , FRoute::groups() );
		Foundry::page()->breadcrumb( $group->getName() );

		// Update the hit counter
		$group->hit();

		// Load list of apps for this group
		$model		= Foundry::model( 'Apps' );

		// Retrieve apps
		$apps 		= $model->getGroupApps();

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

		// Check if there is an app id in the current request as we need to show the app's content.
		$filterId 			= JRequest::getInt( 'filterId' );

		$contents 		= '';
		$isAppView 		= false;

		if( $appId )
		{
			// Load the application.
			$app 		= Foundry::table( 'App' );
			$app->load( $appId );
			$app->loadCss();

			// Load application language file
			Foundry::language()->loadApp( $app->group , $app->element );

			Foundry::page()->title( $group->getName() . ' - ' . $app->get( 'title' ) );


			// Load the library.
			$lib		= Foundry::apps();
			$contents 	= $lib->renderView( SOCIAL_APPS_VIEW_TYPE_EMBED , 'groups' , $app , array( 'groupId' => $group->id ) );

			$isAppView 	= true;
		}


		// Determine if the current request is for "tags"
		$hashtag 		= JRequest::getVar( 'tag' );

		// Retrieve story form for group
		$story 			= Foundry::get( 'Story' , SOCIAL_TYPE_GROUP );

		$story->setCluster( $group->id, SOCIAL_TYPE_GROUP );
		$story->showPrivacy( false );

		if( $hashtag )
		{
			$story->setHashtags( array( $hashtag ) );
		}

		// Retrieve group's stream
		$stream 		= Foundry::stream();

		// only group members allowed to post story updates on group page.
		if( $group->isMember() )
		{
			$stream->story  = $story;
		}

		// lets get stream items for this group
		$options = array( 'clusterId' => $group->id, 'clusterType' 	=> SOCIAL_TYPE_GROUP );

		// we only wan streams thats has this hashtag associated.
		if( $hashtag )
		{
			$options['tag'] = array( $hashtag );
		}

		$stream->get( $options );

		//get group's filter for this logged in user.
		$filters = $group->getFilters( Foundry::user()->id );

		// Determines if we should display the filter form.
		$type 		= JRequest::getCmd( 'type' );

		if( $type == 'filterForm' )
		{
			$theme 			= Foundry::themes();
			$streamFilter 	= Foundry::table( 'StreamFilter' );

			if( $filterId )
			{
				$streamFilter->load( $filterId );
			}

			// $theme->set( 'filter'	, $streamFilter );
			// $theme->set( 'clusterId' , $group->id );

			// $contents	= $theme->output( 'site/groups/filter.edit' );


			$theme->set( 'controller'	, 'groups' );
			$theme->set( 'filter'		, $streamFilter );
			$theme->set( 'uid'			, $group->id );

			$contents	= $theme->output( 'site/stream/form.edit' );

		}

		// Set template variables
		$this->set( 'stream'	, $stream );
		$this->set( 'appId'		, $appId );
		$this->set( 'filterId'	, $filterId );
		$this->set( 'contents'	, $contents );
		$this->set( 'apps'		, $apps );
		$this->set( 'group' 	, $group );
		$this->set( 'filters'	, $filters );
		$this->set( 'hashtag'	, $hashtag );

		// Determine if the user shouldn't be able to view the group's content
		if( ( $group->isInviteOnly() || $group->isClosed() ) && !$group->isMember() )
		{
			// Display private group contents;
			$this->set( 'group' , $group );
			parent::display( 'site/groups/restricted' );
			return;
		}


		parent::display( 'site/groups/item' );
	}

	/**
	 * Post process after a group is created
	 *
	 * @since	1.0
	 * @access	public
	 * @param	string
	 * @return
	 */
	public function complete( $group )
	{
		Foundry::info()->set( $this->getMessage() );

		$url 	= FRoute::groups( array() , false );

		if( $group->state == SOCIAL_STATE_PUBLISHED )
		{
			$url 	= FRoute::groups( array( 'layout' => 'item' , 'id' => $group->getAlias() ) , false );
		}

		$this->redirect( $url );
	}

	/**
	 * Displays information from groups within a particular category
	 *
	 * @since	1.2
	 * @access	public
	 * @param	string
	 * @return
	 */
	public function category()
	{
		// Get the category id from the query
		$id 		= JRequest::getInt( 'id' );

		$category	= Foundry::table( 'GroupCategory' );
		$category->load( $id );

		// Check if the category is valid
		if( !$id || !$category->id )
		{
			return JError::raise( E_ERROR , 404 , JText::_( 'COM_EASYSOCIAL_GROUPS_INVALID_GROUP_ID' ) );
		}

		// Set the page title to this category
		Foundry::page()->title( $category->get( 'title' ) );

		// Set the breadcrumbs
		Foundry::page()->breadcrumb( JText::_( 'COM_EASYSOCIAL_PAGE_TITLE_GROUPS' ) , FRoute::groups() );
		Foundry::page()->breadcrumb( $category->get( 'title' ) );

		// Get recent 10 groups from this category
		$options 	= array( 'sort' => 'random' , 'category' => $category->id );

		$model		= Foundry::model( 'Groups' );
		$groups 	= $model->getGroups( $options );

		// Get random members from this category
		$randomMembers 	= $model->getRandomCategoryMembers( $category->id );

		// Get group creation stats for this category
		$stats 			= $model->getCreationStats( $category->id );

		// Get total groups within a category
		$totalGroups 	= $model->getTotalGroups( array( 'category_id' => $category->id ) );

		// Get the stream for this group
		$stream 	= Foundry::stream();
		$stream->get( array( 'clusterCategory' => $category->id , 'clusterType' => SOCIAL_TYPE_GROUP ) );

		// Get random albums for groups in this category
		$randomAlbums 	= $model->getRandomAlbums( array( 'category_id' => $category->id , 'core' => false ) );

		$this->set( 'randomAlbums'	, $randomAlbums );
		$this->set( 'stream'		, $stream );
		$this->set( 'totalGroups'	, $totalGroups );
		$this->set( 'stats' 		, $stats );
		$this->set( 'randomMembers' , $randomMembers );
		$this->set( 'groups'		, $groups );
		$this->set( 'category'		, $category );

		parent::display( 'site/groups/category.item' );
	}

	/**
	 * Displays the information about a group.
	 *
	 * @since	1.2
	 * @access	public
	 * @param	string
	 * @return
	 */
	public function info()
	{
		$id 		= JRequest::getInt( 'id' );
		$group 		= Foundry::group( $id );

		// Check if the group is valid
		if( !$id || !$group->id )
		{
			$this->setMessage( JText::_( 'COM_EASYSOCIAL_GROUPS_INVALID_GROUP_ID' ) , SOCIAL_MSG_ERROR );
			Foundry::info()->set( $this->getMessage() );

			return $this->redirect( FRoute::dashboard( array() , false ) );
		}

		// Check if the group is accessible
		if( $group->type == SOCIAL_GROUPS_INVITE_TYPE && !$group->isMember() )
		{
			$this->setMessage( JText::_( 'COM_EASYSOCIAL_GROUPS_NOT_ALLOWED' ) , SOCIAL_MSG_ERROR );
			Foundry::info()->set( $this->getMessage() );

			return $this->redirect( FRoute::dashboard( array() , false ) );
		}

		// Set the page title.
		Foundry::page()->title( $group->getName() );

		// Set the breadcrumbs
		Foundry::page()->breadcrumb( JText::_( 'COM_EASYSOCIAL_GROUPS_PAGE_TITLE' ) , FRoute::groups() );
		Foundry::page()->breadcrumb( $group->getName() );

		// Determine if the user shouldn't be able to view the group's content
		if( $group->type == SOCIAL_GROUPS_PRIVATE_TYPE && !$group->isMember() )
		{
			// Display private group contents;
			return;
		}

		// Load language file from back end.
		JFactory::getLanguage()->load( 'com_easysocial' , JPATH_ROOT . '/administrator' );

		// Get the custom fields steps.
		// Get the steps model
		$stepsModel		= Foundry::model( 'Steps' );
		$steps			= $stepsModel->getSteps( $group->category_id , SOCIAL_TYPE_CLUSTERS , SOCIAL_PROFILES_VIEW_DISPLAY );
		$fields			= Foundry::fields();
		$fieldsModel	= Foundry::model( 'Fields' );
		$incomplete 	= false;

		// Get the custom fields for each of the steps.
		foreach( $steps as &$step )
		{
			$step->fields 	= $fieldsModel->getCustomFields( array( 'step_id' => $step->id , 'data' => true , 'dataId' => $group->id , 'dataType' => SOCIAL_TYPE_GROUP , 'visible' => SOCIAL_PROFILES_VIEW_DISPLAY ) );

			// Trigger onDisplay for custom fields.
			if( !empty( $step->fields ) )
			{
				$args 	= array( $group );

				$fields->trigger( 'onDisplay' , SOCIAL_FIELDS_GROUP_GROUP , $step->fields , $args );
			}


			$step->hide = true;

			foreach( $step->fields as $field )
			{
				// If the key output is set but is empty, means that the field does have an output, but there is no data to show
				// In this case, we mark this profile as incomplete
				// Incomplete profile will have a info displayed above saying "complete your profile now"
				// If incomplete has been marked true, then no point marking it as true again
				// We don't break from the loop here because there is other checking going on
				if( isset( $field->output ) && empty( $field->output ) && $incomplete === false )
				{
					$incomplete = true;
				}

				// As long as one of the field in the step has an output, then this step shouldn't be hidden
				// If step has been marked false, then no point marking it as false again
				// We don't break from the loop here because there is other checking going on
				if( !empty( $field->output ) && $step->hide === true )
				{
					$step->hide = false;
				}
			}
		}


		// Set template variables
		$this->set( 'incomplete', $incomplete );
		$this->set( 'steps'		, $steps );
		$this->set( 'group' 	, $group );

		parent::display( 'site/groups/info' );
	}

	/**
	 * Post process after a user is rejected to join the group
	 *
	 * @since	1.2
	 * @access	public
	 * @param	SocialGroup
	 */
	public function reject( $group )
	{
		Foundry::info()->set( $this->getMessage() );

		$this->redirect( FRoute::groups( array( 'layout' => 'item' , 'id' => $group->getAlias() ) , false ) );
	}

	/**
	 * Post process after a user is deleted from the group
	 *
	 * @since	1.2
	 * @access	public
	 * @param	SocialGroup
	 */
	public function removeMember( $group )
	{
		Foundry::info()->set( $this->getMessage() );

		$this->redirect( FRoute::groups( array( 'layout' => 'item' , 'id' => $group->getAlias() ) , false ) );
	}

	/**
	 * Post process after a user is approved to join the group
	 *
	 * @since	1.2
	 * @access	public
	 * @param	SocialGroup
	 */
	public function approve( $group = null )
	{
		Foundry::info()->set( $this->getMessage() );

		if( $this->hasErrors() )
		{
			return $this->redirect( FRoute::groups( array() , false ) );
		}

		$this->redirect( FRoute::groups( array( 'layout' => 'item' , 'id' => $group->getAlias() ) , false ) );
	}

	/**
	 * Post process after a user is invited to join the group
	 *
	 * @since	1.2
	 * @access	public
	 * @param	SocialGroup
	 */
	public function invite( $group )
	{
		Foundry::info()->set( $this->getMessage() );

		$this->redirect( FRoute::groups( array( 'layout' => 'item' , 'id' => $group->getAlias() ) , false ) );
	}

	/**
	 * Post process after a group is set as featured
	 *
	 * @since	1.2
	 * @access	public
	 * @param	SocialGroup
	 */
	public function setFeatured( $group )
	{
		Foundry::info()->set( $this->getMessage() );

		$this->redirect( FRoute::groups( array() , false ) );
	}

	/**
	 * Post process after a group is removed from being featured
	 *
	 * @since	1.2
	 * @access	public
	 * @param	SocialGroup
	 */
	public function removeFeatured( $group )
	{
		Foundry::info()->set( $this->getMessage() );

		$this->redirect( FRoute::groups( array() , false ) );
	}

	/**
	 * Post process after category has been selected
	 *
	 * @since	1.2
	 * @access	public
	 * @return
	 */
	public function selectCategory()
	{
		// Set message data.
		Foundry::info()->set( $this->getMessage() );

		// @task: Check for errors.
		if( $this->hasErrors() )
		{
			return $this->redirect( FRoute::groups( array() , false ) );
		}

		// @task: We always know that after selecting the profile type, the next step would always be the first step.
		$url 	= FRoute::groups( array( 'layout' => 'steps' , 'step' => 1 ) , false );

		return $this->redirect( FRoute::groups( array( 'layout' => 'steps' , 'step' => 1 ) , false ) );
	}

	/**
	 * Post process when a group is deleted
	 *
	 * @since	1.2
	 * @access	public
	 * @param	string
	 * @return
	 */
	public function delete()
	{
		Foundry::info()->set( $this->getMessage() );

		$this->redirect( FRoute::groups( array() , false ) );
	}

	/**
	 * Post process when a group is unpublished
	 *
	 * @since	1.2
	 * @access	public
	 * @param	string
	 * @return
	 */
	public function unpublish()
	{
		Foundry::info()->set( $this->getMessage() );

		$this->redirect( FRoute::groups( array() , false ) );
	}

	/**
	 * Post process after saving group
	 *
	 * @since	1.2
	 * @access	public
	 * @param	string
	 * @return
	 */
	public function update( $group )
	{
		Foundry::info()->set( $this->getMessage() );

		return $this->redirect( $group->getPermalink( false ) );
	}

	/**
	 * Post process after a user response to the invitation.
	 *
	 * @since	1.2
	 * @access	public
	 * @param	string
	 */
	public function respondInvitation( $group , $action )
	{
		Foundry::info()->set( $this->getMessage() );

		if( $action == 'reject' )
		{
			return $this->redirect( FRoute::groups( array( 'filter' => 'invited' ) , false ) );
		}

		return $this->redirect( FRoute::groups( array( 'layout' => 'item' , 'id' => $group->getAlias() ) , false ) );
	}


	/**
	 * Post process after saving group filter
	 *
	 * @since	1.2
	 * @access	public
	 * @param	StreamFilter object
	 * @return
	 */
	public function saveFilter( $filter, $groupId )
	{
		// Unauthorized users should not be allowed to access this page.
		Foundry::requireLogin();

		Foundry::info()->set( $this->getMessage() );

		$group = Foundry::group( $groupId );

		$this->redirect( FRoute::groups( array( 'layout' => 'item' , 'id' => $group->getAlias() ), false ) );
	}



	/**
	 * Allows viewer to download a conversation file
	 *
	 * @since	1.0
	 * @access	public
	 * @param	string
	 * @return
	 */
	public function preview()
	{
		// Currently only registered users are allowed to view a file.
		Foundry::requireLogin();

		// Get the file id from the request
		$fileId 	= JRequest::getInt( 'fileid' , null );

		$file 	= Foundry::table( 'File' );
		$file->load( $fileId );

		if( !$file->id || !$fileId )
		{
			// Throw error message here.
			$this->redirect( FRoute::dashboard( array() , false ) );
			$this->close();
		}

		// Load up the group
		$group		= Foundry::group( $file->uid );

		// Ensure that the user can really view this group
		if( !$group->canViewItem() )
		{
			// Throw error message here.
			$this->redirect( FRoute::dashboard( array() , false ) );
			$this->close();
		}
		
		$file->preview();
		exit;
	}

}
