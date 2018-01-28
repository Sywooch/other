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
	 * Retrieves groups
	 *
	 * @since	1.0
	 * @access	public
	 * @param	Array 	An array of groups
	 */
	public function getGroups( $groups = array() , $pagination = null , $featuredGroups = array() )
	{
		$ajax 	= Foundry::ajax();

		if( $this->hasErrors() )
		{
			return $ajax->reject( $this->getMessage() );
		}

		// Determines if we should add the category header
		$categoryId		= JRequest::getInt( 'categoryId' );
		$category 		= false;

		$theme 	= Foundry::themes();

		if( $categoryId )
		{
			$category 	= Foundry::table( 'GroupCategory' );
			$category->load( $categoryId );
		}

		// Filter
		$filter 		= JRequest::getVar( 'filter' );

		$theme->set( 'activeCategory' , $category );
		$theme->set( 'filter'			, $filter );
		$theme->set( 'pagination' 		, $pagination );
		$theme->set( 'featuredGroups'	, $featuredGroups );
		$theme->set( 'groups' 			, $groups );

		// Retrieve items from the template
		$content	= $theme->output( 'site/groups/default.items' );

		return $ajax->resolve( $content );
	}

	/**
	 * Responsible to output the application contents.
	 *
	 * @since	1.0
	 * @access	public
	 * @param	SocialAppTable	The application ORM.
	 */
	public function getAppContents( $app )
	{
		$ajax 	= Foundry::ajax();

		// If there's an error throw it back to the caller.
		if( $this->hasErrors() )
		{
			return $ajax->reject( $this->getMessage() );
		}

		// Get the current logged in user.
		$groupId 	= JRequest::getInt( 'groupId' );
		$group 		= Foundry::group( $groupId );

		// Load the library.
		$lib		= Foundry::getInstance( 'Apps' );
		$contents 	= $lib->renderView( SOCIAL_APPS_VIEW_TYPE_EMBED , 'groups' , $app , array( 'groupId' => $group->id ) );

		// Return the contents
		return $ajax->resolve( $contents );
	}

	/**
	 * Displays the invite friend form
	 *
	 * @since	1.0
	 * @access	public
	 * @param	string
	 * @return
	 */
	public function inviteFriends()
	{
		$ajax 	= Foundry::ajax();

		// Get the group id from request
		$id 	= JRequest::getInt( 'id' );

		// Load up the group
		$group 	= Foundry::group( $id );
		$my 	= Foundry::user();

		// Get a list of friends that are already in this group
		$model 		= Foundry::model( 'Groups' );
		$friends	= $model->getFriendsInGroup( $group->id , array( 'userId' => $my->id ) );
		$exclusion	= array();

		if( $friends )
		{
			foreach( $friends as $friend )
			{
				$exclusion[]	= $friend->id;
			}
		}

		$theme 	= Foundry::themes();
		$theme->set( 'exclusion' , $exclusion );
		$theme->set( 'group' , $group );

		$contents 	= $theme->output( 'site/groups/dialog.invite' );

		return $ajax->resolve( $contents );
	}

	/**
	 * Displays the confirmation dialog to set a group as featured
	 *
	 * @since	1.0
	 * @access	public
	 * @param	string
	 * @return
	 */
	public function setFeatured()
	{
		$ajax 	= Foundry::ajax();

		// Get the group id from request
		$id 	= JRequest::getInt( 'id' );

		// Load up the group
		$group 	= Foundry::group( $id );

		$theme 	= Foundry::themes();
		$theme->set( 'group' , $group );

		$contents 	= $theme->output( 'site/groups/dialog.featured' );

		return $ajax->resolve( $contents );
	}

	/**
	 * Displays the confirmation dialog to set a group as featured
	 *
	 * @since	1.0
	 * @access	public
	 * @param	string
	 * @return
	 */
	public function removeFeatured()
	{
		$ajax 	= Foundry::ajax();

		// Get the group id from request
		$id 	= JRequest::getInt( 'id' );

		// Load up the group
		$group 	= Foundry::group( $id );

		$theme 	= Foundry::themes();
		$theme->set( 'group' , $group );

		$contents 	= $theme->output( 'site/groups/dialog.unfeature' );

		return $ajax->resolve( $contents );
	}

	/**
	 * Displays the respond to invitation dialog
	 *
	 * @since	1.0
	 * @access	public
	 * @param	string
	 * @return
	 */
	public function respondInvitation()
	{
		$ajax 	= Foundry::ajax();

		// Get the group id from request
		$id 	= JRequest::getInt( 'id' );

		// Load up the group
		$group 	= Foundry::group( $id );

		// Get the current user.
		$my 	= Foundry::user();

		// Load the member
		$member = Foundry::table( 'GroupMember' );
		$member->load( array( 'cluster_id' => $group->id , 'uid' => $my->id ) );

		// Get the invitor
		$invitor	= Foundry::user( $member->invited_by );

		$theme 		= Foundry::themes();
		$theme->set( 'group' 	, $group );
		$theme->set( 'invitor'	, $invitor );

		$contents 	= $theme->output( 'site/groups/dialog.respond' );

		return $ajax->resolve( $contents );
	}

	/**
	 * Displays the confirmation to delete a group
	 *
	 * @since	1.2
	 * @access	public
	 * @param	string
	 * @return
	 */
	public function confirmDelete()
	{
		$ajax 	= Foundry::ajax();

		// Get the group id from request
		$id 	= JRequest::getInt( 'id' );

		// Load up the group
		$group 	= Foundry::group( $id );

		$theme 	= Foundry::themes();
		$theme->set( 'group' , $group );

		$contents 	= $theme->output( 'site/groups/dialog.delete' );

		return $ajax->resolve( $contents );
	}

	/**
	 * Displays the confirmation to delete a group
	 *
	 * @since	1.2
	 * @access	public
	 * @param	string
	 * @return
	 */
	public function confirmUnpublishGroup()
	{
		$ajax 	= Foundry::ajax();

		// Get the group id from request
		$id 	= JRequest::getInt( 'id' );

		// Load up the group
		$group 	= Foundry::group( $id );

		$theme 	= Foundry::themes();
		$theme->set( 'group' , $group );

		$contents 	= $theme->output( 'site/groups/dialog.unpublish' );

		return $ajax->resolve( $contents );
	}

	/**
	 * Displays the confirmation to withdraw application
	 *
	 * @since	1.2
	 * @access	public
	 * @param	string
	 * @return
	 */
	public function confirmWithdraw()
	{
		$ajax 	= Foundry::ajax();

		// Get the group id from request
		$id 	= JRequest::getInt( 'id' );

		// Load up the group
		$group 	= Foundry::group( $id );

		$theme 	= Foundry::themes();
		$theme->set( 'group' , $group );

		$contents 	= $theme->output( 'site/groups/dialog.withdraw' );

		return $ajax->resolve( $contents );
	}

	/**
	 * Displays the confirmation to approve user application
	 *
	 * @since	1.2
	 * @access	public
	 * @param	string
	 * @return
	 */
	public function confirmApprove()
	{
		$ajax 	= Foundry::ajax();

		// Get the group id from request
		$id 	= JRequest::getInt( 'id' );

		// Load up the group
		$group 	= Foundry::group( $id );

		// Get the user id
		$userId = JRequest::getInt( 'userId' );
		$user 	= Foundry::user( $userId );

		$theme 	= Foundry::themes();
		$theme->set( 'group'	, $group );
		$theme->set( 'user'		, $user );

		$contents 	= $theme->output( 'site/groups/dialog.approve' );

		return $ajax->resolve( $contents );
	}

	/**
	 * Displays the confirmation to remove user from group
	 *
	 * @since	1.2
	 * @access	public
	 * @param	string
	 * @return
	 */
	public function confirmRemoveMember()
	{
		$ajax 	= Foundry::ajax();

		// Get the group id from request
		$id 	= JRequest::getInt( 'id' );

		// Load up the group
		$group 	= Foundry::group( $id );

		// Get the user id
		$userId = JRequest::getInt( 'userId' );
		$user 	= Foundry::user( $userId );

		$theme 	= Foundry::themes();
		$theme->set( 'group'	, $group );
		$theme->set( 'user'		, $user );

		$contents 	= $theme->output( 'site/groups/dialog.remove.member' );

		return $ajax->resolve( $contents );
	}

	/**
	 * Displays the confirmation to reject user application
	 *
	 * @since	1.2
	 * @access	public
	 * @param	string
	 * @return
	 */
	public function confirmReject()
	{
		$ajax 	= Foundry::ajax();

		// Get the group id from request
		$id 	= JRequest::getInt( 'id' );

		// Load up the group
		$group 	= Foundry::group( $id );

		// Get the user id
		$userId = JRequest::getInt( 'userId' );
		$user 	= Foundry::user( $userId );

		$theme 	= Foundry::themes();
		$theme->set( 'group'	, $group );
		$theme->set( 'user'		, $user );

		$contents 	= $theme->output( 'site/groups/dialog.reject' );

		return $ajax->resolve( $contents );
	}

	/**
	 * Displays the join group dialog
	 *
	 * @since	1.0
	 * @access	public
	 * @param	string
	 * @return
	 */
	public function joinGroup()
	{
		$ajax 	= Foundry::ajax();

		// Get the group id from request
		$id 	= JRequest::getInt( 'id' );

		// Load up the group
		$group 	= Foundry::group( $id );

		$theme 	= Foundry::themes();
		$theme->set( 'group' , $group );

		// Check if the group is open or closed
		if( $group->isClosed() )
		{
			$contents 	= $theme->output( 'site/groups/dialog.join.closed' );
		}

		if( $group->isOpen() )
		{
			$contents 	= $theme->output( 'site/groups/dialog.join.open' );
		}

		return $ajax->resolve( $contents );
	}

	/**
	 * Post process after a user is made an admin
	 *
	 * @since	1.2
	 * @access	public
	 */
	public function makeAdmin()
	{
		$ajax 	= Foundry::ajax();

		if( $this->hasErrors() )
		{
			return $ajax->reject( $this->getMessage() );
		}

		return $ajax->resolve();
	}

	/**
	 * Displays the make admin confirmation dialog
	 *
	 * @since	1.0
	 * @access	public
	 * @param	string
	 * @return
	 */
	public function confirmMakeAdmin()
	{
		$ajax 	= Foundry::ajax();

		// Get the group id from request
		$id 	= JRequest::getInt( 'id' );

		// Load up the group
		$user 	= Foundry::user( $id );

		$theme 	= Foundry::themes();
		$theme->set( 'user' , $user );

		// Check if the group is open or closed
		$contents 	= $theme->output( 'site/groups/dialog.admin' );

		return $ajax->resolve( $contents );
	}

	/**
	 * Responsible to return data for file explorer
	 *
	 * @since	1.2
	 * @access	public
	 * @param	string
	 * @return
	 */
	public function explorer( $exception = false , $result = array() )
	{
		$ajax 	= Foundry::ajax();

		if( $exception->type != SOCIAL_MSG_SUCCESS )
		{
			return $ajax->reject( $exception );
		}

		$hook		= JRequest::getCmd( 'hook' );

		if( $hook == 'removeFolder' )
		{
			return $ajax->resolve( JRequest::getInt( 'id' ) , $result );
		}

		return $ajax->resolve( $result );
	}

	/**
	 * Displays the join group dialog
	 *
	 * @since	1.0
	 * @access	public
	 * @param	string
	 * @return
	 */
	public function confirmLeaveGroup()
	{
		$ajax 	= Foundry::ajax();

		// Get the group id from request
		$id 	= JRequest::getInt( 'id' );

		// Load up the group
		$group 	= Foundry::group( $id );

		$theme 	= Foundry::themes();
		$theme->set( 'group' , $group );

		// Check if the group is open or closed
		$contents 	= $theme->output( 'site/groups/dialog.leave' );

		return $ajax->resolve( $contents );
	}

	public function getStream( $stream = null )
	{
		$ajax 	= Foundry::ajax();

		if( $this->hasErrors() )
		{
			return $ajax->reject( $this->getMessage() );
		}

		$contents 	= $stream->html();

		return $ajax->resolve( $contents );
	}


	/**
	 * Displays the stream filter form
	 *
	 * @since	1.2
	 * @access	public
	 * @param	string
	 * @return
	 */
	public function getFilter( $filter, $groupId )
	{
		$ajax 		= Foundry::ajax();
		$group 		= Foundry::group( $groupId );

		$theme 		= Foundry::themes();

		$theme->set( 'controller'	, 'groups' );
		$theme->set( 'filter'		, $filter );
		$theme->set( 'uid'			, $group->id );

		$contents	= $theme->output( 'site/stream/form.edit' );

		return $ajax->resolve( $contents );
	}

	/**
	 * post processing for quicky adding group filter.
	 *
	 * @since	1.2
	 * @access	public
	 * @param	string
	 * @return
	 */
	public function addFilter( $filter, $groupId )
	{
		$ajax 	= Foundry::ajax();

		Foundry::requireLogin();

		$theme 		= Foundry::themes();

		$group 		= Foundry::group( $groupId );


		$theme->set( 'filter'	, $filter );
		$theme->set( 'group'	, $group );
		$theme->set( 'filterId'	, '0' );

		$content	= $theme->output( 'site/groups/item.filter' );

		return $ajax->resolve( $content, JText::_( 'COM_EASYSOCIAL_STREAM_FILTER_SAVED' ) );
	}

	/**
	 * post processing after group filter get deleted.
	 *
	 * @since	1.2
	 * @access	public
	 * @param	string
	 * @return
	 */
	public function deleteFilter( $groupId )
	{
		$ajax 	= Foundry::ajax();

		Foundry::requireLogin();
		Foundry::info()->set( $this->getMessage() );

		$group 	= Foundry::group( $groupId );
		$url 	= FRoute::groups( array( 'layout' => 'item' , 'id' => $group->getAlias() ), false );

		return $ajax->redirect( $url );
	}

}
