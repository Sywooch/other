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
<div class="es-header es-header-mini es-group-header-mini" data-id="<?php echo $group->id;?>" data-name="<?php echo $this->html( 'string.escape' , $group->getName() );?>" data-avatar="<?php echo $group->getAvatar();?>">

	<div class="es-header-mini-cover" style="background-image: url('<?php echo $group->getCover()->getSource();?>');background-position: <?php echo $group->getCover()->getPosition();?>;">
		<b></b>
		<b></b>
	</div>

	<div class="es-header-avatar">
		<a class="es-avatar es-avatar-medium" href="<?php echo $group->getPermalink();?>">
			<img alt="<?php echo $this->html( 'string.escape' , $group->getName() );?>" src="<?php echo $group->getAvatar( SOCIAL_AVATAR_SQUARE );?>" />
		</a>
	</div>

	<div class="es-header-content" data-appscroll>
		<div class="es-header-info">
			<ul class="list-unstyled">
				<li>
					<h2 class="h4 es-cover-title">
						<a href="<?php echo $group->getPermalink();?>" title="<?php echo $this->html( 'string.escape' , $group->getName() );?>"><?php echo $group->getName();?></a>
					</h2>
					<?php if( $group->isOpen() ){ ?>
					<span class="label label-success" data-original-title="<?php echo JText::_('COM_EASYSOCIAL_GROUPS_OPEN_GROUP_TOOLTIP' , true );?>" data-es-provide="tooltip" data-placement="top">
						<i class="ies-earth"></i> <?php echo JText::_( 'COM_EASYSOCIAL_GROUPS_OPEN_GROUP' ); ?>
					</span>
					<?php } ?>

					<?php if( $group->isClosed() ){ ?>
					<span class="label label-important" data-original-title="<?php echo JText::_('COM_EASYSOCIAL_GROUPS_CLOSED_GROUP_TOOLTIP' , true );?>" data-es-provide="tooltip" data-placement="top">
						<i class="ies-locked"></i> <?php echo JText::_( 'COM_EASYSOCIAL_GROUPS_CLOSED_GROUP' ); ?>
					</span>
					<?php } ?>
				</li>
			</ul>

			<div class="fd-small info-actions">
				<a href="<?php echo FRoute::groups( array( 'layout' => 'info' , 'id' => $group->getAlias() ) );?>"><?php echo JText::_( 'More about this group' ); ?></a>

				<?php if( $this->access->allowed( 'reports.submit' ) ){ ?>
				&middot; <?php echo Foundry::reports()->getForm( 'com_easysocial' , SOCIAL_TYPE_GROUPS , $group->id , $group->getName() , JText::_( 'Report this group' ) ); ?>
				<?php } ?>
			</div>

		</div>

		<?php if( $group->getApps() && ( $group->isMember() || $group->isOpen() ) ){ ?>
		<div class="btn- btn-scroll" data-appscroll-buttons>
			<a href="javascript:void(0);" class="btn btn-left" data-appscroll-prev-button>
				<i class="ies-arrow-left"></i>
			</a>
			<a href="javascript:void(0);" class="btn btn-right" data-appscroll-next-button>
				<i class="ies-arrow-right"></i>
			</a>
		</div>
		
		<div class="es-action" data-appscroll-viewport>
			<ul class="fd-nav fd-nav- fd-nav-apps" data-appscroll-content>
				<?php foreach( $group->getApps() as $app ){ ?>
				<li>
					<a class="btn btn-clean" href="<?php echo FRoute::groups( array( 'layout' => 'item' , 'id' => $group->getAlias() , 'appId' => $app->getAlias() ) );?>">
						<span><?php echo $app->get( 'title' ); ?></span>
						<img src="<?php echo $app->getIcon();?>" class="fd-nav-apps-icons" />
					</a>
				</li>				
				<?php } ?>
			</ul>
		</div>
		<?php } ?>

	</div>

	<div class="es-header-footer">
		<div class="pull-left">
			<ul class="list-unstyled fd-nav group-stats">
				<?php echo $this->render( 'widgets' , 'group' , 'groups' , 'groupStatsStart' , array( $group ) ); ?>
				<li>
					<a href="<?php echo FRoute::groups( array( 'layout' => 'category' , 'id' => $group->getCategory()->getAlias() ) );?>">
						<i class="ies-database"></i> <?php echo $group->getCategory()->get( 'title' ); ?>
					</a>
				</li>
				<li>
					<a href="<?php echo FRoute::albums( array( 'uid' => $group->id , 'type' => SOCIAL_TYPE_GROUP ) );?>">
						<i class="ies-picture"></i> <?php echo JText::sprintf( Foundry::string()->computeNoun( 'COM_EASYSOCIAL_GROUPS_ALBUMS' , $group->getTotalAlbums() ) , $group->getTotalAlbums() ); ?>
					</a>
				</li>
				<li>
					<i class="ies-users"></i> <?php echo JText::sprintf( Foundry::string()->computeNoun( 'COM_EASYSOCIAL_GROUPS_MEMBERS' , $group->getTotalMembers() ) , $group->getTotalMembers() ); ?>
				</li>
				<li>
					<i class="ies-eye"></i> <?php echo JText::sprintf( Foundry::string()->computeNoun( 'COM_EASYSOCIAL_GROUPS_VIEWS' , $group->hits ) , $group->hits ); ?></a>
				</li>
				<?php echo $this->render( 'widgets' , 'group' , 'groups' , 'groupStatsEnd' , array( $group ) ); ?>
				<li>
					<?php echo Foundry::sharing( array( 'url' => FRoute::groups( array( 'layout' => 'item', 'id' => $group->getPermalink(), 'external' => true, 'xhtml' => true ) ), 'display' => 'dialog', 'text' => JText::_( 'COM_EASYSOCIAL_STREAM_SOCIAL' ) , 'css' => 'fd-small' ) )->getHTML( true ); ?>
				</li>
			</ul>
		</div>

		<div class="pull-right">
			<span class="action">
				<?php if( !$group->isMember() && !$group->isPendingMember() ){ ?>
				<a class="btn btn-es-primary" href="javascript:void(0);" data-es-group-join><?php echo JText::_( 'Join This Group' );?> &rarr;</a>
				<?php } ?>
			</span>
		</div>

	</div>
</div>
