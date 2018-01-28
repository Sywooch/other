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
<div id="fd" class="es mod-es-register module-register<?php echo $suffix;?> es-responsive">
	
	<?php echo Foundry::info()->toHTML();?>

	<form name="registration" method="post" action="<?php echo JRoute::_( 'index.php' );?>">
		<div class="quick-register clearfix<?php echo $params->get( 'splash_image' , true ) ? ' has-splash' : '';?>">

			<?php if( $params->get( 'splash_image' , true ) ){ ?>
			<div class="quick-register-splash">
				<div class="splash-image" style="background-image:url(<?php echo $splashImage;?>);"></div>

				<div class="splash-header">
					<h2><?php echo JText::_( $params->get( 'splash_image_title' , 'MOD_EASYSOCIAL_REGISTER_SPLASH_TITLE_JOIN_US_TODAY' ) );?></h2>
				</div>

				<div class="splash-footer">
					<?php echo JText::_( $params->get( 'splash_footer_content' , 'MOD_EASYSOCIAL_REGISTER_SPLASH_FOOTER_CONTENT' ) ); ?>
				</div>
			</div>
			<?php } ?>

			<div class="quick-register-form">
				<?php if( $params->get( 'show_heading_title' , true ) || $params->get( 'show_heading_desc' , true ) ){ ?>
				<div class="text-center">
					<?php if( $params->get( 'show_heading_title' , true ) ){ ?>
					<h3>
						<?php echo $params->get( 'heading_title' , JText::_( 'MOD_EASYSOCIAL_REGISTER_DONT_HAVE_ACCOUNT' ) ); ?>
					</h3>
					<?php } ?>

					<?php if( $params->get( 'show_heading_desc' , true ) ){ ?>
					<p class="center mb-20">
						<?php echo $params->get( 'heading_desc' , JText::_( 'MOD_EASYSOCIAL_REGISTER_NOW_TO_JOIN' ) );?>
					</p>
					<?php } ?>
				</div>
				<hr />
				<?php } ?>

				<div>
					<div class="form-group">
						<div class="form-inline">
							<i class="ies-vcard"></i> 
							<input type="text" placeholder="<?php echo JText::_( 'MOD_EASYSOCIAL_REGISTER_PLACEHOLDER_YOUR_NAME' , true );?>" name="name" class="form-control" />
						</div>
					</div>
				</div>
				<div>
					<div class="form-group">
						<div class="form-inline">
							<i class="ies-user"></i> 
							<input type="text" placeholder="<?php echo JText::_( 'MOD_EASYSOCIAL_REGISTER_PLACEHOLDER_USERNAME' , true );?>" autocomplete="off" id="joomla_username" name="username" class="form-control" />
						</div>
					</div>
				</div>
				<div>
					<div class="form-group">
						<div class="form-inline">
							<i class="ies-key"></i>
							<input type="password" placeholder="<?php echo JText::_( 'MOD_EASYSOCIAL_REGISTER_PLACEHOLDER_PASSWORD' , true );?>" name="password" id="password" autocomplete="off" class="form-control ">
						</div>
					</div>
				</div>
				<div>
					<div class="form-group">
						<div class="form-inline">
							<i class="ies-mail-2"></i>
							<input type="text" placeholder="<?php echo JText::_( 'MOD_EASYSOCIAL_REGISTER_PLACEHOLDER_EMAIL' );?>" name="email" id="email" class="form-control" />
						</div>
					</div>
				</div>
				<?php if( $showGender ){ ?>
				<div>
					<div class="form-group" data-field-gender="">
						<label class="radio-inline">
							<input type="radio" name="gender" value="1" /> <?php echo JText::_( 'MOD_EASYSOCIAL_REGISTER_GENDER_MALE' ); ?>
						</label>
						<label class="radio-inline">
							<input type="radio" name="gender" value="2" /> <?php echo JText::_( 'MOD_EASYSOCIAL_REGISTER_GENDER_FEMALE' ); ?>
						</label>
					</div>
				</div>
				<?php } ?>

				<button class="btn btn-es-primary btn-block mb-20"><?php echo JText::_( 'MOD_EASYSOCIAL_REGISTER_REGISTER_NOW_BUTTON' );?> &rarr;</button>
			</div>
		</div>

		<?php echo $modules->html( 'form.token' ); ?>
		<input type="hidden" name="redirect" value="<?php echo base64_encode( JRequest::getURI() );?>" />
		<input type="hidden" name="option" value="com_easysocial" />
		<input type="hidden" name="controller" value="registration" />
		<input type="hidden" name="task" value="moduleRegister" />
		<input type="hidden" name="id" value="<?php echo $module->id;?>" />
	</form>

</div>
