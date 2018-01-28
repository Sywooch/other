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
<?php echo $this->loadTemplate( 'site/groups/default.items.category' , array( 'activeCategory' => isset( $activeCategory ) ? $activeCategory : false ) ); ?>

<div class="featured-groups<?php echo !$featuredGroups ? ' is-empty' : '';?>">
	<?php if( $featuredGroups ){ ?>
	<div class="featured-groups-list">
		<?php foreach( $featuredGroups as $group ){ ?>
		<div class="group-featured"
			data-groups-featured-item
			data-groups-item-id="<?php echo $group->id;?>"
			data-groups-item-type="<?php echo $group->isOpen() ? 'open' : 'closed';?>"
		>
			<div class="group-featured-label">
				<span><?php echo JText::_( 'COM_EASYSOCIAL_GROUPS_FEATURED_GROUPS' );?></span>
			</div>
			<?php echo $this->loadTemplate( 'site/groups/default.items.group' , array( 'group' => $group , 'featured' => true ) ); ?>
		</div>
		<?php } ?>
	</div>
	<?php } ?>

	<?php if( $filter == 'featured' ){ ?>
	<div class="empty">
		<?php echo JText::_( 'COM_EASYSOCIAL_GROUPS_NO_FEATURED_GROUPS_YET' );?>
	</div>
	<?php } ?>
</div>

<div class="groups-listing<?php echo !$groups ? ' is-empty' : '';?>">
	<?php if( $groups ){ ?>
	<ul class="list-unstyled es-group-list mt-10" data-groups-list>
		<?php foreach( $groups as $group ){ ?>
		<li data-id="<?php echo $group->id;?>" class="es-groups-item" data-groups-item 
			data-groups-item-id="<?php echo $group->id;?>"
			data-groups-item-type="<?php echo $group->isOpen() ? 'open' : 'closed';?>"
		>
			<div class="es-group">
				<?php echo $this->loadTemplate( 'site/groups/default.items.group' , array( 'group' => $group , 'featured' => false ) ); ?>
			</div>
		</li>
		<?php } ?>
	</ul>

	<div class="es-pagination-footer">
		<?php echo $pagination->getListFooter( 'site' );?>
	</div>

	<?php } else { ?>
		<?php if( $filter != 'featured' ){ ?>
		<div class="empty">
			<?php echo JText::_( 'COM_EASYSOCIAL_GROUPS_NO_GROUPS_YET' );?>
		</div>
		<?php } ?>
	<?php } ?>
</div>
