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
<div class="btn-group btn-group-xs es-photo-tag-list" data-photo-tag-list>
	<div class="es-media-item-menu-item btn btn-media btn-es dropdown_" data-item-actions-menu>
		<a href="javascript: void(0);" data-bs-toggle="dropdown">
			<i class="ies-tag"></i> Tags
		</a>
		<div class="es-photo-tag-list-item-group dropdown-menu" data-photo-tag-list-item-group>
			<?php if( $tags ){ ?>
				<?php foreach( $tags as $tag ){ ?>
					<?php echo $this->includeTemplate('site/photos/taglist.item', array('tag' => $tag)); ?>
				<?php } ?>
			<?php } ?>
			<?php if ($photo->taggable()) { ?>
			<div data-photo-tag-button="enable" class="btn btn-es btn-media es-photo-tag-button"><a href="javascript: void(0);"><i class="ies-plus"></i> <?php echo JText::_("COM_EASYSOCIAL_TAG_PHOTO"); ?></a></div>
			<?php } ?>
		</div>
	</div>
</div>
