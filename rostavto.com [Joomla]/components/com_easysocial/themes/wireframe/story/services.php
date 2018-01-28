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
<div class="row">
	<div class="story-users col-sm-6" data-story-tags>
		<i class="ies-user"></i>
		<div class="es-story-friends-textbox textboxlist">
			<input type="text" class="textboxlist-textField" autocomplete="off" placeholder="<?php echo JText::_( 'COM_EASYSOCIAL_WHO_ARE_YOU_WITH' , true ); ?>" data-textboxlist-textField />
		</div>
	</div>

	<div class="story-location col-sm-6 es-story-locations" data-story-location>
		<i class="ies-location-2"></i>

		<div class="location-form" data-story-location-form>
			<div class="es-story-location-textbox" data-story-location-textbox data-language="<?php echo Foundry::config()->get('general.location.language'); ?>">
				<input type="text" class="input-sm form-control" placeholder="<?php echo JText::_('COM_EASYSOCIAL_WHERE_ARE_YOU_NOW'); ?>" autocomplete="off" data-story-location-textField disabled/>
				<div class="es-story-location-remove-button" data-story-location-remove-button><i class="ies-cancel-2"></i></div>
				<div class="es-story-location-loading-indicator" data-story-location-loading-indicator><i class="loading-indicator fd-small"></i></div>
			</div>

			<button type="button" class="btn btn-es detect-location" data-es-provide="tooltip" data-placement="top" data-original-title="<?php echo JText::_( 'COM_EASYSOCIAL_DETECT_CURRENT_LOCATION' , true );?>" data-story-location-detect-button>
				<i class="ies-location-2"></i>
			</button>

			<div class="es-story-location-autocomplete" data-story-location-autocomplete>

				<div class="es-story-location-autocomplete-shadow"><div class="real-shadow"></div></div>

				<div class="es-story-location-suggestions"
				     data-story-location-suggestions></div>
			</div>
		</div>
	</div>

</div>