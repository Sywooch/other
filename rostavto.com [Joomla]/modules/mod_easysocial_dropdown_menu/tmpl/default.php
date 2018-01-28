<?php
/**
* @package 		EasySocial
* @copyright	Copyright (C) 2010 - 2013 Stack Ideas Sdn Bhd. All rights reserved.
* @license 		Proprietary Use License http://stackideas.com/licensing.html
* @author 		Stack Ideas Sdn Bhd
*/
defined( '_JEXEC' ) or die( 'Unauthorized Access' );
?>
<div id="fd" class="es mod-es-dropdown-menu module-dropdown-menu<?php echo $suffix;?>">
	<div class="mod-bd">
		<a href="javascript:void(0);" class="dropdown-toggle_ login-link loginLink" data-bs-toggle="dropdown">
			<span class="es-avatar">
				<img src="<?php echo $my->getAvatar();?>" alt="<?php echo $modules->html( 'string.escape' , $my->getName() );?>" />
			</span>
			<span class="dropdown-toggle-user-name"><?php echo JText::_( 'MOD_EASYSOCIAL_DROPDOWN_MENU_HI' );?>, <strong><?php echo $my->getName();?></strong></span>
			<b class="caret"></b>
		</a>

		<ul class="dropdown-menu dropdown-menu-user">
			<?php if( $params->get( 'show_my_profile' , true ) ){ ?>
			<li>
				<a href="<?php echo $my->getPermalink();?>">
					<?php echo JText::_( 'MOD_EASYSOCIAL_DROPDOWN_MENU_MY_PROFILE' );?>
				</a>
			</li>
			<?php } ?>

			<?php if( $params->get( 'show_account_settings' , true ) ){ ?>
			<li>
				<a href="<?php echo FRoute::profile( array( 'layout' => 'edit' ) );?>">
					<?php echo JText::_( 'MOD_EASYSOCIAL_DROPDOWN_MENU_ACCOUNT_SETTINGS' );?>
				</a>
			</li>
			<?php } ?>

			<?php if( $items ){ ?>
				<?php foreach( $items as $item ){ ?>
				<li class="menu-<?php echo $item->id;?>">
					<a href="<?php echo $item->flink;?>"><?php echo $item->title;?></a>
				</li>
				<?php } ?>
			<?php } ?>


			<?php if( $params->get( 'show_sign_out' , true ) ){ ?>
			<li>
				<a href="javascript:void(0);" onclick="document.getElementById('es-dropdown-logout-form').submit();">
					<?php echo JText::_( 'MOD_EASYSOCIAL_DROPDOWN_MENU_SIGN_OUT' );?>
				</a>
				<form class="logout-form" id="es-dropdown-logout-form">
					<input type="hidden" name="return" value="<?php echo $logoutReturn;?>" />
					<input type="hidden" name="option" value="com_users" />
					<input type="hidden" name="task" value="user.logout" />
					<?php echo $modules->html( 'form.token' ); ?>
				</form>
			</li>
			<?php } ?>

		</ul>
	</div>
</div>
