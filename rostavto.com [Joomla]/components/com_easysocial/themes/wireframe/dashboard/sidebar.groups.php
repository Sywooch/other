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
<div class="es-widget es-widget-borderless">
	<div class="es-widget-head">
		<?php echo JText::_( 'COM_EASYSOCIAL_DASHBOARD_SIDEBAR_GROUPS' );?>
	</div>

	<div class="es-widget-body">
		<ul class="fd-nav fd-nav-stacked feed-items" data-dashboard-groups>
			<?php if( $groups ){ ?>
				<?php foreach( $groups as $group ){ ?>
					<li class="widget-filter<?php echo $groupId == $group->id ? ' active' : '';?>"
						data-dashboard-group-item
						data-dashboardSidebar-menu
						data-type="group"
						data-id="<?php echo $group->id;?>">
						<a href="<?php echo FRoute::dashboard( array( 'type' => 'group' , 'groupId' => $group->getAlias() ) );?>" 
							title="<?php echo $this->html( 'string.escape' , $this->my->getName() ) . ' - ' . $this->html( 'string.escape' , $group->getName() ); ?>">
							<i class="ies-users mr-5"></i> <?php echo $group->getName(); ?>
							<div class="label label-notification pull-right mr-20" data-stream-counter-list-<?php echo $group->id; ?>>0</div>
						</a>
					</li>
				<?php } ?>
			<?php } ?>
		</ul>
	</div>

</div>
