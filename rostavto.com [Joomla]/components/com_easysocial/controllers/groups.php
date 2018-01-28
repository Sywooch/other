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

// Import main controller
Foundry::import( 'site:/controllers/controller' );

jimport( 'joomla.filesystem.file' );

class EasySocialControllerGroups extends EasySocialController
{

	/**
	 * Selects a category
	 *
	 * @since	1.2
	 * @access	public
	 * @param	string
	 * @return
	 */
	public function selectCategory()
	{
		// Only logged in users are allowed to use this.
		Foundry::requireLogin();

		// Get the current view
		$view 	= $this->getCurrentView();

		// Get the logged in user.
		$my 	= Foundry::user();

		// Check if the user really has access to create groups
		if( !$my->getAccess()->allowed( 'groups.create' ) && !$my->isSiteAdmin() )
		{
			$view->setMessage( JText::_( 'COM_EASYSOCIAL_GROUPS_NO_ACCESS_CREATE_GROUP' ) , SOCIAL_MSG_ERROR );
			return $view->call( __FUNCTION__ );
		}

		// Get the category id from request
		$id 		= JRequest::getInt( 'category_id' , 0 );

		$category	= Foundry::table( 'GroupCategory' );
		$category->load( $id );

		// If there's no profile id selected, throw an error.
		if( !$id || !$category->id )
		{
			$view->setMessage( JText::_( 'COM_EASYSOCIAL_GROUPS_INVALID_GROUP_ID' ) , SOCIAL_MSG_ERROR );

			return $view->call( __FUNCTION__ );
		}

		// @task: Let's set some info about the profile into the session.
		$session		= JFactory::getSession();
		$session->set( 'category_id' , $id , SOCIAL_SESSION_NAMESPACE );

		// @task: Try to load more information about the current registration procedure.
		$stepSession				= Foundry::table( 'StepSession' );
		$stepSession->load( $session->getId() );

		if( !$stepSession->session_id )
		{
			$stepSession->session_id 	= $session->getId();
		}

		$stepSession->uid 			= $category->id;
		$stepSession->type 			= SOCIAL_TYPE_GROUP;

		// When user accesses this page, the following will be the first page
		$stepSession->set( 'step' , 1 );

		// Add the first step into the accessible list.
		$stepSession->addStepAccess( 1 );
		$stepSession->store();

		return $view->call( __FUNCTION__ );
	}

	/**
	 * Creates a new group
	 *
	 * @since	1.2
	 * @access	public
	 * @return
	 */
	public function store()
	{
		// Check for request forgeries
		Foundry::checkToken();

		// Only logged in user is allowed to create groups
		Foundry::requireLogin();

		// Check if the user really has access to create groups
		$my 	= Foundry::user();

		// Get the current view
		$view 	= $this->getCurrentView();
		$config	= Foundry::config();


		if( !$my->getAccess()->allowed( 'groups.create' ) && !$my->isSiteAdmin() )
		{
			$view->setMessage( JText::_( 'COM_EASYSOCIAL_GROUPS_NO_ACCESS_CREATE_GROUP' ) , SOCIAL_MSG_ERROR );
			return $view->call( __FUNCTION__ );
		}

		// Get the total groups created by the user
		$total 	= $my->getTotalGroups();

		// Check if the user's group limit has exceeded or going to be exceeded
		if( $my->getAccess()->exceeded( 'groups.limit' , $total , true ) && !$my->isSiteAdmin() )
		{
			$view->setMessage( JText::_( 'COM_EASYSOCIAL_GROUPS_NO_ACCESS_CREATE_GROUP' ) , SOCIAL_MSG_ERROR );
			return $view->call( __FUNCTION__ );
		}

		// Get current user's info
		$session    = JFactory::getSession();

		// Get necessary info about the current registration process.
		$stepSession		= Foundry::table( 'StepSession' );
		$stepSession->load( $session->getId() );

		// Load the group category
		$category 	= Foundry::table( 'GroupCategory' );
		$category->load( $stepSession->uid );

		// Load the current step.
		$step 		= Foundry::table( 'FieldStep' );
		$step->loadBySequence( $category->id , SOCIAL_TYPE_CLUSTERS , $stepSession->step );

		// Merge the post values
		$registry 	= Foundry::get( 'Registry' );
		$registry->load( $stepSession->values );

		// Load up groups model
		$groupsModel		= Foundry::model( 'Groups' );

		// Get all published fields apps that are available in the current form to perform validations
		$fieldsModel 		= Foundry::model( 'Fields' );
		$fields				= $fieldsModel->getCustomFields( array( 'step_id' => $step->id, 'visible' => SOCIAL_GROUPS_VIEW_REGISTRATION ) );

		// Load json library.
		$json 	= Foundry::json();

		// Retrieve all file objects if needed
		$files 		= JRequest::get( 'FILES' );
		$post		= JRequest::get( 'POST' );
		$token      = Foundry::token();

		// Process $_POST vars
		foreach( $post as $key => $value )
		{
			if( $key != $token )
			{
				if( is_array( $value ) )
				{
					$value  = Foundry::json()->encode( $value );
				}
				$registry->set( $key , $value );
			}
		}

		// Convert the values into an array.
		$data		= $registry->toArray();

		$args       = array( &$data , &$stepSession );

		// Perform field validations here. Validation should only trigger apps that are loaded on the form
		// @trigger onRegisterValidate
		$fieldsLib			= Foundry::fields();

		// Get the trigger handler
		$handler			= $fieldsLib->getHandler();

		// Get error messages
		$errors				= $fieldsLib->trigger( 'onRegisterValidate' , SOCIAL_FIELDS_GROUP_GROUP , $fields , $args, array( $handler, 'validate' ) );

		// The values needs to be stored in a JSON notation.
		$stepSession->values   = $json->encode( $data );

		// Store registration into the temporary table.
		$stepSession->store();

		// Get the current step (before saving)
		$currentStep    = $stepSession->step;

		// Add the current step into the accessible list
		$stepSession->addStepAccess( $currentStep );

		// Bind any errors into the registration object
		$stepSession->setErrors( $errors );

		// Saving was intercepted by one of the field applications.
		if( is_array( $errors ) && count( $errors ) > 0 )
		{
			// @rule: If there are any errors on the current step, remove access to future steps to avoid any bypass
			$stepSession->removeAccess( $currentStep );

			// @rule: Reset steps to the current step
			$stepSession->step = $currentStep;
			$stepSession->store();

			$view->setMessage( JText::_( 'COM_EASYSOCIAL_REGISTRATION_SOME_ERRORS_IN_THE_REGISTRATION_FORM' ) , SOCIAL_MSG_ERROR );

			return $view->call( 'saveStep' , $stepSession , $currentStep );
		}

		// Determine whether the next step is completed. It has to be before updating the registration table's step
		// Otherwise, the step doesn't exist in the site.
		$step       = Foundry::table( 'FieldStep' );
		$step->loadBySequence( $category->id , SOCIAL_TYPE_CLUSTERS , $stepSession->step );

		// Determine if this is the last step.
		$completed      = $step->isFinalStep( SOCIAL_PROFILES_VIEW_REGISTRATION );

		// Update creation date
		$stepSession->created 	= Foundry::date()->toMySQL();

		// Since user has already came through this step, add the step access
		$nextStep		= $step->getNextSequence( SOCIAL_GROUPS_VIEW_REGISTRATION );

		if( $nextStep !== false )
		{
			$stepSession->addStepAccess( $nextStep );
		}

		// Save the temporary data.
		$stepSession->store();

		// If this is the last step, we try to save all user's data and create the necessary values.
		if( $completed )
		{
			// Create the group now.
			$group 	= $groupsModel->createGroup( $stepSession );

			// If there's no id, we know that there's some errors.
			if( !$group->id )
			{
				$errors 		= $groupsModel->getError();

				$view->setMessage( $errors , SOCIAL_MSG_ERROR );

				return $view->call( 'saveStep' , $registration , $currentStep );
			}

			// @points: groups.create
			// Assign points to the user when a group is created
			$points = Foundry::points();
			$points->assign( 'groups.create' , 'com_easysocial' , $my->id );

			// Get the registration data
			$sessionData 	= Foundry::registry( $stepSession->values );

			// Clear existing session objects once the creation is completed.
			$stepSession->delete();

			// Default message
			$message 	= JText::_( 'COM_EASYSOCIAL_GROUPS_CREATED_PENDING_APPROVAL' );

			// If the group is published, we need to perform other activities
			if( $group->state == SOCIAL_STATE_PUBLISHED )
			{
				$message 	= JText::_( 'COM_EASYSOCIAL_GROUPS_CREATED_SUCCESSFULLY' );

				// Add activity logging when a user creates a new group.
				if( $config->get( 'groups.stream.create' ) )
				{
					$stream				= Foundry::stream();
					$streamTemplate		= $stream->getTemplate();

					// Set the actor
					$streamTemplate->setActor( $my->id , SOCIAL_TYPE_USER );

					// Set the context
					$streamTemplate->setContext( $group->id , SOCIAL_TYPE_GROUPS );

					$streamTemplate->setVerb( 'create' );
					$streamTemplate->setSiteWide();
					$streamTemplate->setPublicStream( 'core.view' );

					// Set the params to cache the group data
					$registry	= Foundry::registry();
					$registry->set( 'group' , $group );

					// Set the params to cache the group data
					$streamTemplate->setParams( $registry );

					// Add stream template.
					$stream->add( $streamTemplate );
				}
			}

			$view->setMessage( $message , SOCIAL_MSG_SUCCESS );

			// Render the view now
			return $view->call( 'complete' , $group );
		}

		// Always increment the step by one and save the current step.
		$stepSession->step		= $currentStep + 1;

		// Don't increase by 1, use field step to find the next valid step instead
		$stepSession->step = $step->getNextSequence( SOCIAL_PROFILES_VIEW_REGISTRATION );

		// Save the temporary data.
		$stepSession->store();

		// Get the currentIndex based on currentStep
		$currentIndex = $registry->get( 'currentStep' );

		return $view->saveStep( $stepSession , $currentIndex , $completed );
	}

	/**
	 * Allows caller to trigger the delete method
	 *
	 * @since	1.2
	 * @access	public
	 * @param	string
	 * @return
	 */
	public function delete()
	{
		// Check for request forgeries
		Foundry::checkToken();

		// Only registered members allowed
		Foundry::requireLogin();

		// Get the current view
		$view 	= $this->getCurrentView();

		// Get the group
		$id 	= JRequest::getInt( 'id' );
		$group	= Foundry::group( $id );

		if( !$group->id || !$id )
		{
			$view->setMessage( JText::_( 'COM_EASYSOCIAL_GROUPS_INVALID_ID_PROVIDED' ) , SOCIAL_MSG_ERROR );

			return $view->call( __FUNCTION__ );
		}

		// Only allow super admins to delete groups
		$my 	= Foundry::user();

		if( !$my->isSiteAdmin() )
		{
			$view->setMessage( JText::_( 'COM_EASYSOCIAL_GROUPS_NO_ACCESS' ) , SOCIAL_MSG_ERROR );

			return $view->call( __FUNCTION__ );
		}

		// Try to delete the group
		$group->delete();

		$view->setMessage( JText::_( 'COM_EASYSOCIAL_GROUPS_GROUP_DELETED_SUCCESS' ) , SOCIAL_MSG_SUCCESS );
		return $view->call( __FUNCTION__ );
	}

	/**
	 * Updates the group
	 *
	 * @since	1.2
	 * @access	public
	 * @param	string
	 * @return
	 */
	public function update()
	{
		// Check for request forgeries
		Foundry::checkToken();

		// Only registered members allowed
		Foundry::requireLogin();

		// Get the current view
		$view 	= $this->getCurrentView();

		// Get the group
		$id 	= JRequest::getInt( 'id' );
		$group	= Foundry::group( $id );

		if( !$group->id || !$id )
		{
			$view->setMessage( JText::_( 'COM_EASYSOCIAL_GROUPS_INVALID_ID_PROVIDED' ) , SOCIAL_MSG_ERROR );

			return $view->call( __FUNCTION__ );
		}

		// Only allow user to edit if they have access
		if( !$group->isAdmin() )
		{
			$view->setMessage( JText::_( 'COM_EASYSOCIAL_GROUPS_NO_ACCESS' ) , SOCIAL_MSG_ERROR );

			return $view->call( __FUNCTION__ );
		}

		// Get post data.
		$post 	= JRequest::get( 'POST' );

		// Get all published fields apps that are available in the current form to perform validations
		$fieldsModel 	= Foundry::model( 'Fields' );

		// Only fetch relevant fields for this user.
		$options		= array( 'group' => SOCIAL_TYPE_GROUP , 'uid' => $group->getCategory()->id , 'data' => true, 'dataId' => $group->id, 'dataType' => SOCIAL_TYPE_GROUP , 'visible' => SOCIAL_PROFILES_VIEW_EDIT, 'group' => SOCIAL_FIELDS_GROUP_GROUP );

		$fields			= $fieldsModel->getCustomFields( $options );

		// Load json library.
		$json 		= Foundry::json();

		// Initialize default registry
		$registry 	= Foundry::registry();

		// Get disallowed keys so we wont get wrong values.
		$disallowed = array( Foundry::token() , 'option' , 'task' , 'controller' );

		// Process $_POST vars
		foreach( $post as $key => $value )
		{
			if( !in_array( $key , $disallowed ) )
			{
				if( is_array( $value ) )
				{
					$value  = $json->encode( $value );
				}
				$registry->set( $key , $value );
			}
		}

		// Convert the values into an array.
		$data		= $registry->toArray();

		// Perform field validations here. Validation should only trigger apps that are loaded on the form
		// @trigger onRegisterValidate
		$fieldsLib	= Foundry::fields();

		// Get the general field trigger handler
		$handler = $fieldsLib->getHandler();

		// Build arguments to be passed to the field apps.
		$args 		= array( &$data , &$group );

		// Ensure that there is no errors.
		// @trigger onEditValidate
		$errors 	= $fieldsLib->trigger( 'onEditValidate' , SOCIAL_FIELDS_GROUP_GROUP , $fields , $args, array( $handler, 'validate' ) );

		// If there are errors, we should be exiting here.
		if( is_array( $errors ) && count( $errors ) > 0 )
		{
			$view->setMessage( JText::_( 'COM_EASYSOCIAL_GROUPS_PROFILE_SAVE_ERRORS' ) , SOCIAL_MSG_ERROR );

			// We need to set the proper vars here so that the es-wrapper contains appropriate class
			JRequest::setVar( 'view' 	, 'groups' , 'POST' );
			JRequest::setVar( 'layout'	, 'edit' , 'POST' );

			// We need to set the data into the post again because onEditValidate might have changed the data structure
			JRequest::set( $data , 'post' );

			return $view->call( 'edit', $errors , $data );
		}

		// @trigger onEditBeforeSave
		$errors 	= $fieldsLib->trigger( 'onEditBeforeSave' , SOCIAL_FIELDS_GROUP_GROUP , $fields , $args, array( $handler, 'beforeSave' ) );

		if( is_array( $errors ) && count( $errors ) > 0 )
		{
			$view->setMessage( JText::_( 'COM_EASYSOCIAL_PROFILE_ERRORS_IN_FORM' ) , SOCIAL_MSG_ERROR );

			// We need to set the proper vars here so that the es-wrapper contains appropriate class
			JRequest::setVar( 'view' 	, 'groups' );
			JRequest::setVar( 'layout'	, 'edit' );

			// We need to set the data into the post again because onEditValidate might have changed the data structure
			JRequest::set( $data, 'post' );

			return $view->call( 'edit' , $errors );
		}

		// Save the group now
		$group->save();

		// @points: groups.update
		// Add points to the user that updated the group
		$my 	= Foundry::user();
		$points = Foundry::points();
		$points->assign( 'groups.update' , 'com_easysocial' , $my->id );

		// Reconstruct args
		$args 		= array( &$data , &$group );

		// @trigger onEditAfterSave
		$fieldsLib->trigger( 'onEditAfterSave' , SOCIAL_FIELDS_GROUP_GROUP , $fields , $args );

		// Bind custom fields for the user.
		$group->bindCustomFields( $data );

		// Reconstruct args
		$args 		= array( &$data , &$group );

		// @trigger onEditAfterSaveFields
		$fieldsLib->trigger( 'onEditAfterSaveFields' , SOCIAL_FIELDS_GROUP_GROUP, $fields , $args );

		// Add stream item to notify the world that this user updated their profile.
		$group->createStream( Foundry::user()->id , 'update' );

		$view->setMessage( JText::_( 'COM_EASYSOCIAL_GROUPS_PROFILE_UPDATED_SUCCESSFULLY' ) , SOCIAL_MSG_SUCCESS );

		return $view->call( __FUNCTION__ , $group );
	}

	/**
	 * Approves user to join a group
	 *
	 * @since	1.2
	 * @access	public
	 */
	public function approve()
	{
		// Check for request forgeries
		Foundry::checkToken();

		// Only registered members allowed
		Foundry::requireLogin();

		// Get current user
		$my 	= Foundry::user();

		// Get the current view
		$view	= $this->getCurrentView();

		// Get the user id
		$userId 	= JRequest::getInt( 'userId' );

		if( !$userId )
		{
			$view->setMessage( JText::_( 'COM_EASYSOCIAL_GROUPS_INVALID_ID_PROVIDED' ) , SOCIAL_MSG_ERROR );

			return $view->call( __FUNCTION__ );
		}

		// Get the group id
		$id 	= JRequest::getInt( 'id' );
		$group	= Foundry::group( $id );

		if( !$group->id || !$id )
		{
			$view->setMessage( JText::_( 'COM_EASYSOCIAL_GROUPS_INVALID_ID_PROVIDED' ) , SOCIAL_MSG_ERROR );

			return $view->call( __FUNCTION__ );
		}

		// If there's a key provided, match it with the group
		$key 	= JRequest::getVar( 'key' , '' );

		// Ensure that the current user is the admin of the group
		if( !$group->isAdmin() && $group->key != $key )
		{
			$view->setMessage( JText::_( 'COM_EASYSOCIAL_GROUPS_NO_ACCESS' ) , SOCIAL_MSG_ERROR );

			return $view->call( __FUNCTION__ );
		}

		$user 		= Foundry::user( $userId );

		// Approve the member
		$group->approveUser( $user->id );

		$view->setMessage( JText::sprintf( 'COM_EASYSOCIAL_GROUPS_MEMBER_APPROVED_SUCCESS', $user->getName() ) , SOCIAL_MSG_SUCCESS );

		return $view->call( __FUNCTION__ , $group );
	}


	/**
	 * Rejects user from joining a group
	 *
	 * @since	1.2
	 * @access	public
	 */
	public function reject()
	{
		// Check for request forgeries
		Foundry::checkToken();

		// Only registered members allowed
		Foundry::requireLogin();

		// Get current user
		$my 	= Foundry::user();

		// Get the current view
		$view	= $this->getCurrentView();

		// Get the group id
		$id 	= JRequest::getInt( 'id' );
		$group	= Foundry::group( $id );

		if( !$group->id || !$id )
		{
			$view->setMessage( JText::_( 'COM_EASYSOCIAL_GROUPS_INVALID_ID_PROVIDED' ) , SOCIAL_MSG_ERROR );

			return $view->call( __FUNCTION__ );
		}

		// Ensure that the current user is the admin of the group
		if( !$group->isAdmin() )
		{
			$view->setMessage( JText::_( 'COM_EASYSOCIAL_GROUPS_NO_ACCESS' ) , SOCIAL_MSG_ERROR );

			return $view->call( __FUNCTION__ );
		}

		// Get the user id
		$userId 	= JRequest::getInt( 'userId' );
		$user 		= Foundry::user( $userId );

		// Reject the member
		$group->rejectUser( $user->id );

		return $view->call( __FUNCTION__ , $group );
	}

	/**
	 * Allows user to join a group
	 *
	 * @since	1.2
	 * @access	public
	 */
	public function joinGroup()
	{
		// Check for request forgeries
		Foundry::checkToken();

		// Only registered members allowed
		Foundry::requireLogin();

		// Get current user
		$my 	= Foundry::user();

		// Get the current view
		$view	= $this->getCurrentView();

		// Get the group id
		$id 	= JRequest::getInt( 'id' );
		$group	= Foundry::group( $id );

		if( !$group->id || !$id )
		{
			$view->setMessage( JText::_( 'COM_EASYSOCIAL_GROUPS_INVALID_ID_PROVIDED' ) , SOCIAL_MSG_ERROR );

			return $view->call( __FUNCTION__ );
		}

		// Create a member record for the group
		$group->createMember( $my->id );

		return $view->call( __FUNCTION__ , $group );
	}

	/**
	 * Allows user to withdraw application to join a group
	 *
	 * @since	1.2
	 * @access	public
	 */
	public function withdraw()
	{
		// Check for request forgeries
		Foundry::checkToken();

		// Only registered members allowed
		Foundry::requireLogin();

		// Get current user
		$my 	= Foundry::user();

		// Get the current view
		$view	= $this->getCurrentView();

		// Get the group id
		$id 	= JRequest::getInt( 'id' );
		$group	= Foundry::group( $id );

		if( !$group->id || !$id )
		{
			$view->setMessage( JText::_( 'COM_EASYSOCIAL_GROUPS_INVALID_ID_PROVIDED' ) , SOCIAL_MSG_ERROR );

			return $view->call( __FUNCTION__ );
		}

		// Remove the user from the group.
		$group->deleteMember( $my->id );

		$view->setMessage( JText::sprintf( 'COM_EASYSOCIAL_GROUPS_WITHDRAWN_REQUEST_SUCCESS' , $group->getName() ) , SOCIAL_MSG_SUCCESS );

		return $view->call( __FUNCTION__ , $group );
	}

	/**
	 * Allows admin of a group to remove member from the group
	 *
	 * @since	1.2
	 * @access	public
	 */
	public function removeMember()
	{
		// Check for request forgeries
		Foundry::checkToken();

		// Only registered members allowed
		Foundry::requireLogin();

		// Get current user
		$my 	= Foundry::user();

		// Get the current view
		$view	= $this->getCurrentView();

		// Get the group id
		$id 	= JRequest::getInt( 'id' );
		$group	= Foundry::group( $id );

		if( !$group->id || !$id )
		{
			$view->setMessage( JText::_( 'COM_EASYSOCIAL_GROUPS_INVALID_ID_PROVIDED' ) , SOCIAL_MSG_ERROR );

			return $view->call( __FUNCTION__ );
		}

		// Check if the user that is deleting is an admin of the group
		if( !$group->isAdmin() )
		{
			$view->setMessage( JText::_( 'COM_EASYSOCIAL_GROUPS_NO_ACCESS' ) , SOCIAL_MSG_ERROR );

			return $view->call( __FUNCTION__ );
		}

		// Get the target user that needs to be removed
		$userId 	= JRequest::getInt( 'userId' );
		$user 		= Foundry::user( $userId );

		// Remove the user from the group.
		$group->deleteMember( $user->id );

		$view->setMessage( JText::sprintf( 'COM_EASYSOCIAL_GROUPS_REMOVED_USER_SUCCESS' , $user->getName() ) , SOCIAL_MSG_SUCCESS );

		return $view->call( __FUNCTION__ , $group );
	}

	/**
	 * Allows user to leave a group
	 *
	 * @since	1.2
	 * @access	public
	 */
	public function leaveGroup()
	{
		// Check for request forgeries
		Foundry::checkToken();

		// Only registered members allowed
		Foundry::requireLogin();

		// Get current user
		$my 	= Foundry::user();

		// Get the current view
		$view	= $this->getCurrentView();

		// Get the group id
		$id 	= JRequest::getInt( 'id' );
		$group	= Foundry::group( $id );

		if( !$group->id || !$id )
		{
			$view->setMessage( JText::_( 'COM_EASYSOCIAL_GROUPS_INVALID_ID_PROVIDED' ) , SOCIAL_MSG_ERROR );

			return $view->call( __FUNCTION__ );
		}

		// Remove the user from the group.
		$group->leave( $my->id );

		// Notify group members
		$group->notifyMembers( 'leave' , array( 'userId' => $my->id ) );

		$view->setMessage( JText::sprintf( 'COM_EASYSOCIAL_GROUPS_LEAVE_GROUP_SUCCESS' , $group->getName() ) , SOCIAL_MSG_SUCCESS );

		return $view->call( __FUNCTION__ , $group );
	}

	/**
	 * Unpublishes a group
	 *
	 * @since	1.2
	 * @access	public
	 * @param	string
	 * @return
	 */
	public function unpublish()
	{
		// Check for request forgeries
		Foundry::checkToken();

		// Get the current view
		$view 	= $this->getCurrentView();

		// Get the id of the group
		$id 	= JRequest::getInt( 'id' );

		// Load up the group
		$group 	= Foundry::table( 'Group' );
		$group->load( $id );

		if( !$id || !$group->id )
		{
			$view->setMessage( JText::_( 'COM_EASYSOCIAL_GROUPS_INVALID_ID_PROVIDED' ) , SOCIAL_MSG_ERROR );
			return $view->call( __FUNCTION__ );
		}

		// Only allow super admin's to do this
		$my 	= Foundry::user();

		if( !$my->isSiteAdmin() )
		{
			$view->setMessage( JText::_( 'COM_EASYSOCIAL_GROUPS_NOT_ALLOWED_TO_UNPUBLISH_GROUP' ) , SOCIAL_MSG_ERROR );
			return $view->call( __FUNCTION__ );
		}

		// Try to unpublish the group now
		$state 	= $group->unpublish();

		if( !$state )
		{
			$view->setMessage( JText::_( 'COM_EASYSOCIAL_GROUPS_ERROR_UNPUBLISHING_GROUP' ) , SOCIAL_MSG_ERROR );

			return $view->call( __FUNCTION__ );
		}

		$view->setMessage( JText::_( 'COM_EASYSOCIAL_GROUPS_UNPUBLISHED_SUCCESS' ) , SOCIAL_MSG_SUCCESS );
		return $view->call( __FUNCTION__ );
	}

	/**
	 * Retrieves the group's stream filters.
	 *
	 * @since	1.2
	 * @access	public
	 * @param	string
	 * @return
	 */
	public function getFilter()
	{
		// Check for request forgeries.
		Foundry::checkToken();

		// In order to access the dashboard apps, user must be logged in.
		Foundry::requireLogin();

		// Get the current view
		$view 	= $this->getCurrentView();

		$id 		= JRequest::getInt( 'id', 0 );
		$groupId 	= JRequest::getInt( 'clusterId' );
		$group 		= Foundry::group( $groupId );

		if( !$id && !$group->id )
		{
			$view->setMessage( JText::_( 'COM_EASYSOCIAL_GROUPS_INVALID_ID_PROVIDED' ) );
			return $view->call( __FUNCTION__ );
		}

		// Only group members are allowed to use this
		if( !$group->isMember() )
		{
			$view->setMessage( JText::_( 'COM_EASYSOCIAL_GROUPS_NO_ACCESS' ) );
			return $view->call( __FUNCTION__ );
		}

		$my 	= Foundry::user();

		$filter 	= Foundry::table( 'StreamFilter' );
		$filter->load( $id );

		return $view->call( __FUNCTION__, $filter , $group->id );
	}

	/**
	 * this method is called from the dialog to quickly add new filter based on the viewing hashtag.
	 *
	 * @since	1.2
	 * @access	public
	 * @param
	 * @return
	 */
	public function addFilter()
	{
		// Check for request forgeries.
		Foundry::checkToken();

		// In order to access the dashboard apps, user must be logged in.
		Foundry::requireLogin();

		$my 	= Foundry::user();

		$view 	= $this->getCurrentView();

		$title   	= JRequest::getVar( 'title' );
		$tag   		= JRequest::getVar( 'tag' );
		$groupId   	= JRequest::getVar( 'id' );

		$filter = Foundry::table( 'StreamFilter' );

		$filter->title 		= $title;
		$filter->uid   		= $groupId;
		$filter->utype 		= SOCIAL_TYPE_GROUP;
		$filter->user_id 	= $my->id;

		$filter->store();

		// add hashtag into filter
		$filterItem = Foundry::table( 'StreamFilterItem' );

		$filterItem->filter_id 	= $filter->id;
		$filterItem->type 		= 'hashtag';
		$filterItem->content 	= $tag;

		$filterItem->store();

		$view->setMessage( JText::_( 'COM_EASYSOCIAL_STREAM_FILTER_SAVED' ) , SOCIAL_MSG_SUCCESS );

		return $view->call( __FUNCTION__, $filter, $groupId );
	}


	/**
	 * Stores the groups's hashtag filter.
	 *
	 * @since	1.2
	 * @access	public
	 * @param
	 * @return
	 */
	public function saveFilter()
	{
		// Check for request forgeries.
		Foundry::checkToken();

		// In order to access the dashboard apps, user must be logged in.
		Foundry::requireLogin();

		$my 	= Foundry::user();

		$id 		= JRequest::getInt( 'id' , 0 );
		$groupId 	= JRequest::getInt( 'uid', 0 );

		$post   = JRequest::get( 'POST' );


		// Get the current view.
		$view 	= $this->getCurrentView();

		// Load the filter table
		$filter = Foundry::table( 'StreamFilter' );

		if(! trim( $post['title'] ) )
		{
			$view->setError( JText::_( 'COM_EASYSOCIAL_GROUP_STREAM_FILTER_WARNING_TITLE_EMPTY' ) );
			return $view->call( __FUNCTION__, $filter );
		}

		if(!trim( $post['hashtag'] ) )
		{
			$view->setError( JText::_( 'COM_EASYSOCIAL_GROUP_STREAM_FILTER_WARNING_HASHTAG_EMPTY' ) );
			return $view->call( __FUNCTION__, $filter );
		}

		if( $id )
		{
			$filter->load( $id );
		}

		$filter->title = $post[ 'title' ];
		$filter->uid   = $groupId;
		$filter->utype = SOCIAL_TYPE_GROUP;
		$filter->user_id = $my->id;
		$filter->store();

		// now we save the filter type and content.
		if( $post['hashtag'] )
		{
			$hashtag = trim( $post[ 'hashtag' ] );
			$hashtag = str_replace( '#', '', $hashtag);
			$hashtag = str_replace( ' ', '', $hashtag);


			$filterItem = Foundry::table( 'StreamFilterItem' );
			$filterItem->load( array( 'filter_id' => $filter->id, 'type' => 'hashtag') );

			$filterItem->filter_id 	= $filter->id;
			$filterItem->type 		= 'hashtag';
			$filterItem->content 	= $hashtag;

			$filterItem->store();
		}
		else
		{
			$filter->deleteItem( 'hashtag' );
		}

		$view->setMessage( JText::_( 'COM_EASYSOCIAL_GROUP_STREAM_FILTER_SAVED' ) , SOCIAL_MSG_SUCCESS );

		return $view->call( __FUNCTION__, $filter, $groupId );
	}

	/**
	 * Stores the groups's hashtag filter.
	 *
	 * @since	1.2
	 * @access	public
	 * @param
	 * @return
	 */
	public function deleteFilter()
	{
		// Check for request forgeries.
		Foundry::checkToken();

		// In order to access the dashboard apps, user must be logged in.
		Foundry::requireLogin();

		$view 	= $this->getCurrentView();

		$my 	= Foundry::user();

		$id 		= JRequest::getInt( 'id', 0 );
		$groupId 	= JRequest::getInt( 'uid', 0 );

		if(! $id )
		{
			Foundry::getInstance( 'Info' )->set( JText::_( 'Invalid filter id - ' . $id ) , 'error' );
			$view->setError( JText::_( 'Invalid filter id.' ) );
			return $view->call( __FUNCTION__ );
		}


		$filter = Foundry::table( 'StreamFilter' );

		// make sure the user is the filter owner before we delete.
		$filter->load( array( 'id' => $id, 'uid' => $groupId, 'utype' => SOCIAL_TYPE_GROUP ) );

		if(! $filter->id )
		{
			Foundry::getInstance( 'Info' )->set( JText::_( 'Filter not found - ' . $id ) , 'error' );
			$view->setError( JText::_( 'Filter not found. Action aborted.' ) );
			return $view->call( __FUNCTION__ );
		}

		$filter->deleteItem();
		$filter->delete();

		$view->setMessage( JText::_( 'COM_EASYSOCIAL_STREAM_FILTER_DELETED' ) , SOCIAL_MSG_SUCCESS );

		return $view->call( __FUNCTION__, $groupId );
	}


	/**
	 * Retrieves the group's stream items.
	 *
	 * @since	1.2
	 * @access	public
	 * @param	string
	 * @return
	 */
	public function getStream()
	{
		// Check for request forgeries
		Foundry::checkToken();

		// Get the current view
		$view 	= $this->getCurrentView();

		// Load up the group
		$id 	= JRequest::getInt( 'id' );
		$group 	= Foundry::group( $id );

		// Check if the group can be seen by this user
		if( $group->isClosed() && !$group->isMember() )
		{
			$view->setMessage( JText::_( 'COM_EASYSOCIAL_GROUPS_NO_ACCESS' ) , SOCIAL_MSG_ERROR );

			return $view->call( __FUNCTION__ );
		}

		// Retrieve the stream
		$stream 	= Foundry::stream();

		if( $group->isMember() )
		{
			$story  = Foundry::get( 'Story' , SOCIAL_TYPE_GROUP );
			$story->setCluster( $group->id, SOCIAL_TYPE_GROUP );
			$story->showPrivacy( false );

			$stream->story  = $story;
		}

		// lets get stream items for this group
		$options = array(
							'clusterId' 	=> $group->id,
							'clusterType' 	=> SOCIAL_TYPE_GROUP
						 );

		$filterId   = JRequest::getInt( 'filterId' );
		if( $filterId )
		{
			$sfilter = Foundry::table( 'StreamFilter' );
			$sfilter->load( $filterId );

			$hashtags = $sfilter->getHashTag();
			$tags = explode( ',', $hashtags );

			if( $tags )
			{
				$options[ 'tag' ] = $tags;
			}
		}


		$stream->get( $options );

		return $view->call( __FUNCTION__ , $stream );
	}

	/**
	 * Allows caller to retrieve groups
	 *
	 * @since	1.2
	 * @access	public
	 * @param	string
	 * @return
	 */
	public function getGroups()
	{
		// Check for request forgeries
		Foundry::checkToken();

		// Get the current view
		$view 	= $this->getCurrentView();

		// Check if the caller passed us a category id.
		$categoryId 	= JRequest::getInt( 'categoryId' );

		// Load up the model
		$model 		= Foundry::model( 'Groups' );

		// Filter
		$filter 	= JRequest::getVar( 'filter' );

		// Options
		$options 	= array( 'state' => SOCIAL_CLUSTER_PUBLISHED );

		// Default values
		$groups 		= array();
		$featuredGroups	= array();

		if( $filter == 'featured' )
		{
			// Get a list of featured groups
			$options[ 'featured' ]	= true;
			$featuredGroups	= $model->getGroups( $options );
		}
		else
		{
			// Determine the pagination limit
			$limit 				= Foundry::themes()->getConfig()->get( 'groups_limit' , 20 );
			$options[ 'limit' ]	= $limit;

			if( $filter == 'mine' )
			{
				$options[ 'uid' ]		= Foundry::user()->id;
				$options[ 'types' ]		= 'all';
			}

			if( $filter == 'invited' )
			{
				$options[ 'invited' ]	= Foundry::user()->id;
				$options[ 'types' ]		= 'all';
			}

			if( $categoryId )
			{
				$options[ 'category' ]	= $categoryId;
			}

			// Get the groups
			$groups 	= $model->getGroups( $options );
		}

		// Get the pagination
		$pagination	= $model->getPagination();

		// Define those query strings here
		$pagination->setVar( 'Itemid'	, FRoute::getItemId( 'groups' ) );
		$pagination->setVar( 'view'		, 'groups' );
		$pagination->setVar( 'filter' , $filter );

		return $view->call( __FUNCTION__ , $groups , $pagination , $featuredGroups );
	}

	/**
	 * Allows caller to response to invitation
	 *
	 * @since	1.2
	 * @access	public
	 */
	public function respondInvitation()
	{
		// Check for request forgeries
		Foundry::checkToken();

		// Only registered users are allowed to do this
		Foundry::requireLogin();

		// Get the current view
		$view 	= $this->getCurrentView();

		// Get the current user
		$my 	= Foundry::user();

		// Get the group
		$id 	= JRequest::getInt( 'id' );
		$group	= Foundry::group( $id );

		if( !$id || !$group )
		{
			$view->setMessage( JText::_( 'COM_EASYSOCIAL_GROUPS_INVALID_ID_PROVIDED' ) , SOCIAL_MSG_ERROR );
			return $view->call( __FUNCTION__ );
		}

		$member	= Foundry::table( 'GroupMember' );
		$member->load( array( 'cluster_id' => $group->id , 'uid' => $my->id ) );

		if( !$member->id )
		{
			$view->setMessage( JText::_( 'COM_EASYSOCIAL_GROUPS_NOT_INVITED' ) , SOCIAL_MSG_ERROR );
			return $view->call( __FUNCTION__ );
		}

		// Get the response action
		$action	= JRequest::getWord( 'action' );

		// If user rejected, just delete the invitation record.
		if( $action == 'reject' )
		{
			$member->delete();

			$message 	= JText::sprintf( 'COM_EASYSOCIAL_GROUPS_REJECT_RESPONSE_SUCCESS' , $group->getName() );
		}

		if( $action == 'accept' )
		{
			$member->state 	= SOCIAL_GROUPS_MEMBER_PUBLISHED;
			$member->store();

			// @points: groups.join
			// Add points when user joins a group
			$points = Foundry::points();
			$points->assign( 'groups.join' , 'com_easysocial' , $my->id );

			// Notify members when a new member is added
			$group->notifyMembers( 'join' , array( 'userId' => $my->id ) );
			$message 	= JText::sprintf( 'COM_EASYSOCIAL_GROUPS_ACCEPT_RESPONSE_SUCCESS' , $group->getName() );
		}

		$view->setMessage( $message , SOCIAL_MSG_SUCCESS );
		return $view->call( __FUNCTION__ , $group , $action );
	}

	/**
	 * Allows caller to invite other users to join the group.
	 *
	 * @since	1.2
	 * @access	public
	 */
	public function invite()
	{
		// Check for request forgeries
		Foundry::checkToken();

		// Only registered users are allowed to do this
		Foundry::requireLogin();

		// Get the current view
		$view 	= $this->getCurrentView();

		// Get the current user
		$my 	= Foundry::user();

		// Get the group
		$id 	= JRequest::getInt( 'id' );
		$group	= Foundry::group( $id );

		if( !$id || !$group )
		{
			$view->setMessage( JText::_( 'COM_EASYSOCIAL_GROUPS_INVALID_ID_PROVIDED' ) , SOCIAL_MSG_ERROR );
			return $view->call( __FUNCTION__ );
		}

		// Determine if the user is a member of the group
		if( !$group->isMember() )
		{
			$view->setMessage( JText::_( 'COM_EASYSOCIAL_GROUPS_NEED_TO_BE_MEMBER_TO_INVITE' ) , SOCIAL_MSG_ERROR );
			return $view->call( __FUNCTION__ );
		}

		// Get the list of members that are invited
		$ids 	= JRequest::getVar( 'uid' );

		if( !$ids )
		{
			$view->setMessage( JText::_( 'COM_EASYSOCIAL_GROUPS_ENTER_FRIENDS_NAME_TO_INVITE' ) , SOCIAL_MSG_ERROR );
			return $view->call( __FUNCTION__ );
		}

		foreach( $ids as $id )
		{
			// Ensure that the user is not a member already
			if( !$group->isMember( $id ) )
			{
				$group->invite( $id , $my->id );
			}
		}

		$view->setMessage( JText::_( 'COM_EASYSOCIAL_GROUPS_FRIENDS_INVITED_SUCCESS' ) , SOCIAL_MSG_SUCCESS );

		return $view->call( __FUNCTION__ , $group );
	}

	/**
	 * Retrieves the dashboard contents.
	 *
	 * @since	1.0
	 * @access	public
	 */
	public function getAppContents()
	{
		// Check for request forgeries.
		Foundry::checkToken();

		// In order to access the dashboard apps, user must be logged in.
		Foundry::requireLogin();

		// Get the group id
		$groupId	= JRequest::getInt( 'groupId' );

		// Try to load the group
		$group		= Foundry::group( $groupId );

		if( !$groupId || !$group )
		{
			$view->setMessage( JText::_( 'COM_EASYSOCIAL_GROUPS_INVALID_ID_PROVIDED' ) , SOCIAL_MSG_ERROR );
			return $view->call( __FUNCTION__ );
		}

		if( !$group->canViewItem() )
		{
			$view->setMessage( JText::_( 'COM_EASYSOCIAL_GROUPS_NO_ACCESS' ) , SOCIAL_MSG_ERROR );
			return $view->call( __FUNCTION__ );
		}

		// Get the app id.
		$appId 		= JRequest::getInt( 'appId' );

		// Load application.
		$app 	= Foundry::table( 'App' );
		$state 	= $app->load( $appId );

		// Get the view.
		$view 	= $this->getCurrentView();

		// If application id is not valid, throw an error.
		if( !$appId || !$state )
		{
			$view->setMessage( JText::_( 'COM_EASYSOCIAL_APPS_INVALID_APP_ID_PROVIDED' ) , SOCIAL_MSG_ERROR );
			return $view->call( __FUNCTION__ , $app );
		}

		$my 	= Foundry::user();

		return $view->call( __FUNCTION__ , $app );
	}

	/**
	 * Allows caller to set a group as a featured group
	 *
	 * @since	1.2
	 * @access	public
	 */
	public function removeFeatured()
	{
		// Check for request forgeries
		Foundry::checkToken();

		// Require the user to be logged in
		Foundry::requireLogin();

		// Get the current view
		$view	= $this->getCurrentView();

		// Get the current user
		$my		= Foundry::user();

		// Get the group
		$id 	= JRequest::getInt( 'id' );
		$group	= Foundry::group( $id );

		if( !$id || !$group->id )
		{
			$view->setMessage( JText::_( 'COM_EASYSOCIAL_GROUPS_INVALID_ID_PROVIDED' ) , SOCIAL_MSG_ERROR );
			return $view->call( __FUNCTION__ , $group );
		}

		if( !$my->isSiteAdmin() )
		{
			$view->setMessage( JText::_( 'COM_EASYSOCIAL_GROUPS_NO_ACCESS' ) , SOCIAL_MSG_ERROR );
			return $view->call( __FUNCTION__ , $group );
		}

		// Set it as featured
		$group->removeFeatured();

		return $view->call( __FUNCTION__ , $group );
	}

	/**
	 * Allows caller to set a group as a featured group
	 *
	 * @since	1.2
	 * @access	public
	 */
	public function setFeatured()
	{
		// Check for request forgeries
		Foundry::checkToken();

		// Require the user to be logged in
		Foundry::requireLogin();

		// Get the current view
		$view	= $this->getCurrentView();

		// Get the current user
		$my		= Foundry::user();

		// Get the group
		$id 	= JRequest::getInt( 'id' );
		$group	= Foundry::group( $id );

		if( !$id || !$group->id )
		{
			$view->setMessage( JText::_( 'COM_EASYSOCIAL_GROUPS_INVALID_ID_PROVIDED' ) , SOCIAL_MSG_ERROR );
			return $view->call( __FUNCTION__ , $group );
		}

		if( !$my->isSiteAdmin() )
		{
			$view->setMessage( JText::_( 'COM_EASYSOCIAL_GROUPS_NO_ACCESS' ) , SOCIAL_MSG_ERROR );
			return $view->call( __FUNCTION__ , $group );
		}

		// Set it as featured
		$group->setFeatured();

		return $view->call( __FUNCTION__ , $group );
	}

	/**
	 * Make a user an admin of a group
	 *
	 * @since	1.2
	 * @access	public
	 * @param	string
	 * @return
	 */
	public function makeAdmin()
	{
		// Check for request forgeries
		Foundry::checkToken();

		// Require the user to be logged in
		Foundry::requireLogin();

		// Get the current view
		$view	= $this->getCurrentView();

		// Get the current user
		$my		= Foundry::user();

		// Get the group
		$id 	= JRequest::getInt( 'id' );
		$group	= Foundry::group( $id );

		if( !$group->isOwner() && !$group->isAdmin() )
		{
			$view->setMessage( JText::_( 'COM_EASYSOCIAL_GROUPS_NO_ACCESS' ) );
			return $view->call( __FUNCTION__ );
		}

		// Get the target user
		$userId	= JRequest::getInt( 'userId' );

		$member	= Foundry::table( 'GroupMember' );
		$member->load( array( 'uid' => $userId , 'cluster_id' => $group->id ) );

		// Make the user as the admin
		$member->makeAdmin();

		// add stream
		$group->createStream( $userId , 'makeadmin' );

		return $view->call( __FUNCTION__ );
	}

	/**
	 * Service Hook for explorer
	 *
	 * @since	1.2
	 * @access	public
	 * @param	string
	 * @return
	 */
	public function explorer()
	{
		// Check for request forgeries
		Foundry::checkToken();

		// Require the user to be logged in
		Foundry::requireLogin();

		// Get the current view
		$view		= $this->getCurrentView();

		// Get the group object
		$groupId 	= JRequest::getInt( 'uid' );
		$group 		= Foundry::group( $groupId );

		// Determine if the viewer can really view items
		if( !$group->canViewItem() )
		{
			return $view->call( __FUNCTION__ );
		}

		// Load up the explorer library
		$explorer	= Foundry::explorer( $group->id , SOCIAL_TYPE_GROUP );
		$hook		= JRequest::getCmd( 'hook' );

		$result 	= $explorer->hook( $hook );

		$exception	= Foundry::exception( 'Folder retrieval successful' , SOCIAL_MSG_SUCCESS );

		return $view->call( __FUNCTION__ , $exception , $result );
	}
}
