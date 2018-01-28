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
<div class="es-story" data-story="<?php echo $story->id;?>" data-story-form data-story-hashtags="<?php echo implode(',', $story->hashtags); ?>">
	
	<div class="es-story-panel-top">
		<?php if( $story->panels ){ ?>
		<div class="es-story-content">
			<div class="es-story-panel-buttons" data-story-panel-buttons>
				<div class="es-story-panel-button active" data-story-panel-button data-story-panel-button-default>
					<i class="ies-pencil-2" data-story-attachment-icon data-es-provide="tooltip" data-placement="bottom" data-original-title="<?php echo JText::_( 'COM_EASYSOCIAL_STORY_POST_UPDATES' , true );?>"></i>
				</div><?php foreach( $story->panels as $panel ){ ?><div class="es-story-panel-button" data-story-panel-button data-story-plugin-name="<?php echo $panel->name;?>"><?php echo $panel->button->html;?></div><?php } ?>
			</div>
		</div>
		<?php } ?>
	</div>

	<div class="es-story-header es-story-section" data-story-header>

		<div class="es-avatar es-stream-avatar">
			<img alt="<?php echo $this->html( 'string.escape' , $this->my->getName() );?>" src="<?php echo $this->my->getAvatar();?>" />
		</div>
		<button data-story-reset="" class="close es-story-reset-button" type="button"><i class="ies-cancel-2"></i></button>

		<div class="es-story-content">
			<div class="es-story-textbox mentions-textfield" data-story-textbox>
				<div class="mentions">
					<div data-mentions-overlay data-default="<?php echo $this->html( 'string.escape' , $story->overlay ); ?>"><?php echo $story->overlay; ?></div>
					<textarea class="es-story-textfield" name="content" autocomplete="off"
						data-story-textField
						data-mentions-textarea
						data-default="<?php echo $this->html( 'string.escape' , $story->content ); ?>"
						data-initial="0"
						placeholder="<?php echo JText::_( 'COM_EASYSOCIAL_STORY_PLACEHOLDER' ); ?>"><?php echo $story->content; ?></textarea>
				</div>
			</div>
		</div>
	</div>
	
	<div class="es-story-panel-content es-story-section">
		<div class="es-story-content">

			<div class="es-story-panel-contents" data-story-panel-contents>
				<?php foreach ($story->panels as $panel) { ?>
					<div class="es-story-panel-content <?php echo $panel->content->classname; ?> for-<?php echo $panel->name; ?>" data-story-panel-content data-story-plugin-name="<?php echo $panel->name; ?>">
						<?php echo $panel->content->html; ?>
					</div>
				<?php } ?>
			</div>
		</div>
	</div>

	<div class="es-story-meta es-story-section">
		<?php echo $this->includeTemplate( 'site/story/services' ); ?>
	</div>

	<div class="es-story-footer es-story-section" data-story-footer>
		<div class="es-story-content">
			<div class="es-story-panel-buttons" data-story-panel-buttons>
				<div class="es-story-actions<?php echo !$story->requirePrivacy() ? ' without-privacy' : '';?>">
					<div class="btn-group es-story-action-submit">
						<button class="btn btn-es-primary es-story-submit" data-story-submit><?php echo JText::_("COM_EASYSOCIAL_STORY_SHARE"); ?></button>

						<?php if( $story->requirePrivacy() ) { ?>
						<div class="es-story-privacy solid" data-story-privacy><?php echo Foundry::privacy()->form( null , SOCIAL_TYPE_STORY , $this->my->id , 'story.view', true ); ?></div>
						<?php } ?>
					</div>
				</div>
			</div>
		</div>
	</div>

	<input type="hidden" name="target" data-story-target value="<?php echo $story->getTarget(); ?>" />
	<input type="hidden" name="cluster" data-story-cluster value="<?php echo $story->getClusterId(); ?>" />
	<input type="hidden" name="clustertype" data-story-clustertype value="<?php echo $story->getClusterType(); ?>" />

	<i class="loading-indicator"></i>
</div>
