<?php
/**
* @package 		EasySocial
* @copyright	Copyright (C) 2010 - 2013 Stack Ideas Sdn Bhd. All rights reserved.
* @license 		Proprietary Use License http://stackideas.com/licensing.html
* @author 		Stack Ideas Sdn Bhd
*/
defined( '_JEXEC' ) or die( 'Unauthorized Access' );
?>
<div id="fd" class="es mod-es-notifications module-menu<?php echo $suffix;?>">
	<div class="es-notification">

		<div class="es-menu-items">

			<?php if( $params->get( 'show_system_notifications' , true ) ){ ?>
			<div class="es-menu-item notice-recent has-notice"
				data-original-title="<?php echo JText::_( 'MOD_EASYSOCIAL_NOTIFICATIONS_NOTIFICATIONS' );?>"
				data-es-provide="tooltip"
				data-placement="bottom"
			>
				<a href="javascript:void(0);" data-popbox="module://easysocial/notifications/popbox"
				   data-popbox-toggle="click"
				   data-popbox-position="<?php $params->get('popbox_position', 'bottom'); ?>"
				   data-popbox-collision="<?php $params->get('popbox_collision', 'flip'); ?>">
					<i class="ies-earth"></i>
					<span class="badge badge-notification<?php echo $my->getTotalNewNotifications() <= 0 ? ' hide' : '';?>"><?php echo $my->getTotalNewNotifications();?></span>
				</a>
			</div>
			<?php } ?>

			<?php if( $params->get( 'show_friends_notifications' , true ) ){ ?>
			<div class="es-menu-item notice-friend has-notice"
				data-original-title="<?php echo JText::_( 'MOD_EASYSOCIAL_NOTIFICATIONS_FRIEND_REQUESTS' );?>"
				data-es-provide="tooltip"
				data-placement="bottom"
			>
				<a href="javascript:void(0);"
				   data-popbox="module://easysocial/friends/popbox"
				   data-popbox-toggle="click"
				   data-popbox-position="<?php $params->get('popbox_position', 'bottom'); ?>"
				   data-popbox-collision="<?php $params->get('popbox_collision', 'flip'); ?>">
					<i class="ies-users"></i>
					<span class="badge badge-notification<?php echo $my->getTotalFriendRequests() <= 0 ? ' hide' : '';?>"><?php echo $my->getTotalFriendRequests();?></span>
				</a>
			</div>
			<?php } ?>

			<?php if( $params->get( 'show_conversation_notifications' , true ) ){ ?>
			<div class="es-menu-item notice-message has-notice"
				data-original-title="<?php echo JText::_( 'MOD_EASYSOCIAL_NOTIFICATIONS_CONVERSATIONS' );?>"
				data-es-provide="tooltip"
				data-placement="bottom"
			>
				<a href="javascript:void(0);" data-popbox="module://easysocial/conversations/popbox"
				   data-popbox-toggle="click"
				   data-popbox-position="<?php $params->get('popbox_position', 'bottom'); ?>"
				   data-popbox-collision="<?php $params->get('popbox_collision', 'flip'); ?>">		   
					<i class="ies-mail-2"></i>
					<span class="badge badge-notification<?php echo $my->getTotalNewConversations() <= 0 ? ' hide' : '';?>"><?php echo $my->getTotalNewConversations();?></span>
				</a>
			</div>
			<?php } ?>
		</div>
	</div>

</div>
