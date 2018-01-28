<?php
/**
* @package		EasySocial
* @copyright	Copyright (C) 2010 - 2013 Stack Ideas Sdn Bhd. All rights reserved.
* @license		GNU/GPL, see LICENSE.php
* EasySocial is free software. This version may have been modified pursuant
* to the GNU General Public License, and as distributed it includes or
* is derivative of works licensed under the GNU General Public License or
* other free or open source software licenses.
* See COPYRIGHT.php for copyright notices and details.
*/
defined( '_JEXEC' ) or die( 'Unauthorized Access' );
?>
<div class="es-header"
	data-id="<?php echo $group->id;?>"
	data-name="<?php echo $this->html( 'string.escape' , $group->getName() );?>"
	data-avatar="<?php echo $group->getAvatar();?>">

	<div class="es-header-cover with-cover">
		<?php echo $this->includeTemplate( 'site/groups/cover' ); ?>

		<?php echo $this->includeTemplate( 'site/groups/avatar' ); ?>

		<?php echo $this->render( 'widgets' , 'group' , 'item' , 'afterAvatar' , array( $group ) ); ?>
	</div>

	<div class="es-header-content">
		<div class="es-action pull-right">

			<?php echo $this->render( 'module' , 'es-groups-before-actions' ); ?>

			<?php echo $this->render( 'widgets' , 'group' , 'item' , 'beforeActions' , array( $group ) ); ?>

			<ul class="fd-nav fd-nav-stacked pull-right group-actions list-unstyled">

				<?php if( $group->isPendingMember() ){ ?>
				<li>
					<div class="btn-group">
						<a class="btn btn-es dropdown-toggle" href="javascript:void(0);" data-bs-toggle="dropdown"><i class="ies-eye"></i> <?php echo JText::_( 'COM_EASYSOCIAL_GROUPS_PENDING_APPROVAL' );?> <i class="ies-arrow-down"></i></a>

						<ul class="dropdown-menu dropdown-menu-user messageDropDown">
							<li>
								<a href="javascript:void(0);" data-es-group-withdraw><?php echo JText::_( 'COM_EASYSOCIAL_GROUPS_WITHDRAW_REQUEST' );?></a>
							</li>
						</ul>
					</div>
				</li>
				<?php } ?>

				<?php if( $group->isInvited() && !$group->isMember() ){ ?>
					<a class="btn btn-es-success btn-sm" href="javascript:void(0);" data-es-group-respond>
						<i class="ies-power"></i> <?php echo JText::_( 'COM_EASYSOCIAL_GROUPS_RESPOND_TO_INVITATION' );?>
					</a>
				<?php } ?>

				<?php if( !$group->isInviteOnly() && !$group->isMember() && !$group->isPendingMember() && !$group->isInvited() ){ ?>
				<li>
					<a class="btn btn-es-success btn-sm" href="javascript:void(0);" data-es-group-join>
						<i class="ies-power"></i> <?php echo JText::_( 'COM_EASYSOCIAL_GROUPS_JOIN_THIS_GROUP' );?>
					</a>
				</li>
				<?php } ?>

				<?php if( $group->isMember() ){ ?>
				<li>
					<a class="btn btn-es btn-sm" href="javascript:void(0);" data-es-group-invite><i class="ies-users"></i> <?php echo JText::_( 'COM_EASYSOCIAL_GROUPS_INVITE_FRIENDS' );?></a>
				</li>
				<?php } ?>

				<?php if( $group->isMember() && !$group->isOwner() ){ ?>
				<li>
					<a class="btn btn-es-danger" href="javascript:void(0);" data-es-group-leave><i class="ies-exit"></i> <?php echo JText::_( 'COM_EASYSOCIAL_GROUPS_LEAVE_GROUP' );?></a>
				</li>
				<?php } ?>

				<?php if( $this->my->isSiteAdmin() || $group->isOwner() || $group->isAdmin() ){ ?>
				<li>
					<a class="btn btn-es-primary btn-sm" href="javascript:void(0);" data-bs-toggle="dropdown">
						<i class="ies-cog-2"></i> <?php echo JText::_( 'COM_EASYSOCIAL_GROUPS_MANAGE_GROUP' );?> <i class="ies-arrow-down"></i>
					</a>

					<ul class="dropdown-menu dropdown-menu-user messageDropDown">
						<?php echo $this->render( 'widgets' , 'group' , 'groups' , 'groupAdminStart' , array( $group ) ); ?>

						<li>
							<a href="<?php echo FRoute::groups( array( 'layout' => 'edit' , 'id' => $group->getAlias() ) );?>"><?php echo JText::_( 'COM_EASYSOCIAL_GROUPS_EDIT_GROUP' );?></a>
						</li>

						<?php if( $this->my->isSiteAdmin() ){ ?>
						<li class="divider"></li>
						<li>
							<a href="javascript:void(0);" data-es-group-unpublish><?php echo JText::_( 'COM_EASYSOCIAL_GROUPS_UNPUBLISH_GROUP' );?></a>
						</li>
						<li>
							<a href="javascript:void(0);" data-es-group-delete><?php echo JText::_( 'COM_EASYSOCIAL_GROUPS_DELETE_GROUP' );?></a>
						</li>
						<?php echo $this->render( 'widgets' , 'group' , 'groups' , 'groupAdminEnd' , array( $group ) ); ?>
						<?php } ?>
					</ul>
				</li>
				<?php } ?>
			</ul>

			<?php echo $this->render( 'module' , 'es-groups-after-actions' ); ?>

			<?php echo $this->render( 'widgets' , 'group' , 'item' , 'afterActions' , array( $group ) ); ?>
		</div>

		<div class="es-header-info">
			<?php echo $this->render( 'module' , 'es-groups-before-name' ); ?>

			<ul class="list-unstyled mt-10">
				<li>
					<h2 class="h3 es-cover-title">
						<a href="<?php echo $group->getPermalink();?>"><?php echo $group->getName();?></a>
					</h2>
				</li>
				<li>
					<?php if( $group->isOpen() ){ ?>
					<span class="label label-success" data-original-title="<?php echo JText::_('COM_EASYSOCIAL_GROUPS_OPEN_GROUP_TOOLTIP' , true );?>" data-es-provide="tooltip" data-placement="bottom">
						<i class="ies-earth"></i> <?php echo JText::_( 'COM_EASYSOCIAL_GROUPS_OPEN_GROUP' ); ?>
					</span>
					<?php } ?>

					<?php if( $group->isClosed() ){ ?>
					<span class="label label-important" data-original-title="<?php echo JText::_('COM_EASYSOCIAL_GROUPS_CLOSED_GROUP_TOOLTIP' , true );?>" data-es-provide="tooltip" data-placement="bottom">
						<i class="ies-locked"></i> <?php echo JText::_( 'COM_EASYSOCIAL_GROUPS_CLOSED_GROUP' ); ?>
					</span>
					<?php } ?>

					<?php if( $group->isInviteOnly() ){ ?>
					<span class="label label-warning" data-original-title="<?php echo JText::_('COM_EASYSOCIAL_GROUPS_INVITE_GROUP_TOOLTIP' , true );?>" data-es-provide="tooltip" data-placement="bottom">
						<i class="ies-locked"></i> <?php echo JText::_( 'COM_EASYSOCIAL_GROUPS_INVITE_GROUP' ); ?>
					</span>
					<?php } ?>
				</li>
				<li>
					<div class="es-desp"><?php echo JString::substr( strip_tags( $group->description ) , 0 , 150 );?></div>
				</li>
			</ul>

			<?php echo $this->render( 'module' , 'es-groups-after-name' ); ?>

			<div class="group-user-actions mt-10">
				<a href="<?php echo FRoute::groups( array( 'layout' => 'info' , 'id' => $group->getAlias() ) );?>"><?php echo JText::_( 'COM_EASYSOCIAL_GROUPS_MORE_INFO' ); ?></a>

				<?php if( !$group->isOwner() && $this->access->allowed( 'reports.submit' ) && $this->config->get( 'reports.enabled' ) ){ ?>
				 &middot;
				<?php echo Foundry::reports()->getForm( 'com_easysocial' , SOCIAL_TYPE_GROUPS , $group->id , $group->getName() , JText::_( 'COM_EASYSOCIAL_GROUPS_REPORT_GROUP' ) ); ?>
				<?php } ?>
			</div>
		</div>

	</div>

	<div class="es-header-footer">
		<ul class="fd-nav pull-left list-unstyled">
			<?php echo $this->render( 'widgets' , 'group' , 'groups' , 'groupStatsStart' , array( $group ) ); ?>
			<li>
				<span>
					<a href="<?php echo FRoute::groups( array( 'layout' => 'category' , 'id' => $group->getCategory()->getAlias() ) );?>">
						<i class="ies-database ies-small"></i> <?php echo $group->getCategory()->get( 'title' ); ?>
					</a>
				</span>
			</li>
			<li>
				<span>
					<a href="<?php echo FRoute::albums( array( 'uid' => $group->getAlias() , 'type' => SOCIAL_TYPE_GROUP ) );?>">
						<i class="ies-picture ies-small"></i> <?php echo JText::sprintf( Foundry::string()->computeNoun( 'COM_EASYSOCIAL_GROUPS_ALBUMS' , $group->getTotalAlbums() ) , $group->getTotalAlbums() ); ?>
					</a>
				</span>
			</li>
			<li>
				<span>
					<i class="ies-users ies-small"></i> <?php echo JText::sprintf( Foundry::string()->computeNoun( 'COM_EASYSOCIAL_GROUPS_MEMBERS' , $group->getTotalMembers() ) , $group->getTotalMembers() ); ?>
				</span>
			</li>
			<li>
				<span>
					<i class="ies-eye ies-small"></i> <?php echo JText::sprintf( Foundry::string()->computeNoun( 'COM_EASYSOCIAL_GROUPS_VIEWS' , $group->hits ) , $group->hits ); ?>
				</span>
			</li>
			<?php echo $this->render( 'widgets' , 'group' , 'groups' , 'groupStatsEnd' , array( $group ) ); ?>
		</ul>

		<span class="creator-info pull-right">
			<span>
				<?php echo JText::sprintf( 'COM_EASYSOCIAL_GROUPS_CREATED_BY' , $this->html( 'html.user' , $group->getCreator()->id , true , 'bottom-left' ) );?>
			</span>

			<span>
				<?php echo Foundry::sharing( array( 'url' => FRoute::groups( array( 'layout' => 'item', 'id' => $group->getPermalink(), 'external' => true, 'xhtml' => true ) ), 'display' => 'dialog', 'text' => JText::_( 'COM_EASYSOCIAL_STREAM_SOCIAL' ) , 'css' => 'fd-small' ) )->getHTML( true ); ?>
			</span>
		</span>
	</div>
</div>
