<?php error_reporting(E_ALL | E_STRICT); ini_set('display_errors', 'On'); ?>
<?php
				ob_start();
				?><?php if(array_key_exists('BACKEND_CORE_PATH', (array) $this->variables)) { echo $this->variables['BACKEND_CORE_PATH']; } else { ?>{$BACKEND_CORE_PATH}<?php } ?>/Layout/Templates/Head.tpl<?php
				$include = eval('return \'' . str_replace('\'', '\\\'', ob_get_clean()) .'\';');
				if($this->getForceCompile() || !file_exists($this->getCompileDirectory() .'/' . $this->getCompileName($include, 'J:\home\technomir.com\www\src\Backend\Modules\Authentication\Layout\Templates'))) $this->compile('J:\home\technomir.com\www\src\Backend\Modules\Authentication\Layout\Templates', $include);
				$return = @include $this->getCompileDirectory() .'/' . $this->getCompileName($include, 'J:\home\technomir.com\www\src\Backend\Modules\Authentication\Layout\Templates');
				if($return === false && $this->compile('J:\home\technomir.com\www\src\Backend\Modules\Authentication\Layout\Templates', $include))
				{
					$return = @include $this->getCompileDirectory() .'/' . $this->getCompileName($include, 'J:\home\technomir.com\www\src\Backend\Modules\Authentication\Layout\Templates');
				}
if($return === false)
				{
					?>{include:<?php if(array_key_exists('BACKEND_CORE_PATH', (array) $this->variables)) { echo $this->variables['BACKEND_CORE_PATH']; } else { ?>{$BACKEND_CORE_PATH}<?php } ?>/Layout/Templates/Head.tpl}<?php
				}
?>
<body id="login">
	<?php
				ob_start();
				?><?php if(array_key_exists('BACKEND_MODULES_PATH', (array) $this->variables)) { echo $this->variables['BACKEND_MODULES_PATH']; } else { ?>{$BACKEND_MODULES_PATH}<?php } ?>/<?php if(array_key_exists('MODULE', (array) $this->variables)) { echo $this->variables['MODULE']; } else { ?>{$MODULE}<?php } ?>/Layout/Templates/Ie6.tpl<?php
				$include = eval('return \'' . str_replace('\'', '\\\'', ob_get_clean()) .'\';');
				if($this->getForceCompile() || !file_exists($this->getCompileDirectory() .'/' . $this->getCompileName($include, 'J:\home\technomir.com\www\src\Backend\Modules\Authentication\Layout\Templates'))) $this->compile('J:\home\technomir.com\www\src\Backend\Modules\Authentication\Layout\Templates', $include);
				$return = @include $this->getCompileDirectory() .'/' . $this->getCompileName($include, 'J:\home\technomir.com\www\src\Backend\Modules\Authentication\Layout\Templates');
				if($return === false && $this->compile('J:\home\technomir.com\www\src\Backend\Modules\Authentication\Layout\Templates', $include))
				{
					$return = @include $this->getCompileDirectory() .'/' . $this->getCompileName($include, 'J:\home\technomir.com\www\src\Backend\Modules\Authentication\Layout\Templates');
				}
if($return === false)
				{
					?>{include:<?php if(array_key_exists('BACKEND_MODULES_PATH', (array) $this->variables)) { echo $this->variables['BACKEND_MODULES_PATH']; } else { ?>{$BACKEND_MODULES_PATH}<?php } ?>/<?php if(array_key_exists('MODULE', (array) $this->variables)) { echo $this->variables['MODULE']; } else { ?>{$MODULE}<?php } ?>/Layout/Templates/Ie6.tpl}<?php
				}
?>
	<?php
					if(isset($this->variables['debug']) && count($this->variables['debug']) != 0 && $this->variables['debug'] != '' && $this->variables['debug'] !== false)
					{
						?><div id="debugnotify">Debug mode</div><?php } ?>
	<table id="loginHolder">
		<tr>
			<td>
				<?php
					if(isset($this->variables['hasError']) && count($this->variables['hasError']) != 0 && $this->variables['hasError'] != '' && $this->variables['hasError'] !== false)
					{
						?>
					<div id="loginError">
						<div class="errorMessage singleMessage">
							<p><?php if(array_key_exists('errInvalidEmailPasswordCombination', (array) $this->variables)) { echo $this->variables['errInvalidEmailPasswordCombination']; } else { ?>{$errInvalidEmailPasswordCombination}<?php } ?></p>
						</div>
					</div>
				<?php } ?>

				<?php
					if(isset($this->variables['hasTooManyAttemps']) && count($this->variables['hasTooManyAttemps']) != 0 && $this->variables['hasTooManyAttemps'] != '' && $this->variables['hasTooManyAttemps'] !== false)
					{
						?>
					<div id="loginError">
						<div class="errorMessage singleMessage">
							<p><?php if(array_key_exists('errTooManyLoginAttempts', (array) $this->variables)) { echo $this->variables['errTooManyLoginAttempts']; } else { ?>{$errTooManyLoginAttempts}<?php } ?></p>
						</div>
					</div>
				<?php } ?>

				<div id="loginBox" <?php
					if(isset($this->variables['hasError']) && count($this->variables['hasError']) != 0 && $this->variables['hasError'] != '' && $this->variables['hasError'] !== false)
					{
						?>class="hasError"<?php } ?>>
					<div id="loginBoxTop">
						<h2><?php if(array_key_exists('SITE_TITLE', (array) $this->variables)) { echo $this->variables['SITE_TITLE']; } else { ?>{$SITE_TITLE}<?php } ?></h2>
					</div>

					<?php
					if(isset($this->forms['authenticationIndex']))
					{
						?><form accept-charset="UTF-8" action="<?php echo $this->forms['authenticationIndex']->getAction(); ?>" method="<?php echo $this->forms['authenticationIndex']->getMethod(); ?>"<?php echo $this->forms['authenticationIndex']->getParametersHTML(); ?>>
						<?php echo $this->forms['authenticationIndex']->getField('form')->parse();
						if($this->forms['authenticationIndex']->getUseToken())
						{
							?><input type="hidden" name="form_token" id="<?php echo $this->forms['authenticationIndex']->getField('form_token')->getAttribute('id'); ?>" value="<?php echo htmlspecialchars($this->forms['authenticationIndex']->getField('form_token')->getValue()); ?>" />
						<?php } ?>
						<div class="horizontal">
							<div id="loginFields">
								<p>
									<label for="backendEmail"><?php if(array_key_exists('lblEmail', (array) $this->variables)) { echo SpoonFilter::ucfirst($this->variables['lblEmail']); } else { ?>{$lblEmail|ucfirst}<?php } ?></label>
									<?php if(array_key_exists('txtBackendEmail', (array) $this->variables)) { echo $this->variables['txtBackendEmail']; } else { ?>{$txtBackendEmail}<?php } ?> <?php if(array_key_exists('txtBackendEmailError', (array) $this->variables)) { echo $this->variables['txtBackendEmailError']; } else { ?>{$txtBackendEmailError}<?php } ?>
								</p>
								<p>
									<label for="backendPassword"><?php if(array_key_exists('lblPassword', (array) $this->variables)) { echo SpoonFilter::ucfirst($this->variables['lblPassword']); } else { ?>{$lblPassword|ucfirst}<?php } ?></label>
									<?php if(array_key_exists('txtBackendPassword', (array) $this->variables)) { echo $this->variables['txtBackendPassword']; } else { ?>{$txtBackendPassword}<?php } ?> <?php if(array_key_exists('txtBackendPasswordError', (array) $this->variables)) { echo $this->variables['txtBackendPasswordError']; } else { ?>{$txtBackendPasswordError}<?php } ?>
								</p>
							</div>
							<p class="spacing">
								<input name="login" type="submit" value="<?php if(array_key_exists('lblSignIn', (array) $this->variables)) { echo SpoonFilter::ucfirst($this->variables['lblSignIn']); } else { ?>{$lblSignIn|ucfirst}<?php } ?>" class="inputButton button mainButton" />
							</p>
						</div>
					</form>
				<?php } ?>

					<ul id="loginNav">
						<li><a href="#" id="forgotPasswordLink" class="toggleBalloon" data-message-id="forgotPasswordHolder"><?php if(array_key_exists('msgForgotPassword', (array) $this->variables)) { echo $this->variables['msgForgotPassword']; } else { ?>{$msgForgotPassword}<?php } ?></a></li>
					</ul>
				</div>

				<div id="forgotPasswordHolder" class="balloon <?php if(!isset($this->variables['showForm']) || count($this->variables['showForm']) == 0 || $this->variables['showForm'] == '' || $this->variables['showForm'] === false): ?>balloonNoMessage<?php endif; ?>"<?php if(!isset($this->variables['showForm']) || count($this->variables['showForm']) == 0 || $this->variables['showForm'] == '' || $this->variables['showForm'] === false): ?> style="display: none;"<?php endif; ?>>
					<div id="forgotPasswordBox">

						<a class="button linkButton icon iconClose iconOnly toggleBalloon" href="#" data-message-id="forgotPasswordHolder"><span>X</span></a>

						<div class="balloonTop">&nbsp;</div>

						<p><?php if(array_key_exists('msgHelpForgotPassword', (array) $this->variables)) { echo $this->variables['msgHelpForgotPassword']; } else { ?>{$msgHelpForgotPassword}<?php } ?></p>
						<?php
					if(isset($this->forms['forgotPassword']))
					{
						?><form accept-charset="UTF-8" action="<?php echo $this->forms['forgotPassword']->getAction(); ?>" method="<?php echo $this->forms['forgotPassword']->getMethod(); ?>"<?php echo $this->forms['forgotPassword']->getParametersHTML(); ?>>
						<?php echo $this->forms['forgotPassword']->getField('form')->parse();
						if($this->forms['forgotPassword']->getUseToken())
						{
							?><input type="hidden" name="form_token" id="<?php echo $this->forms['forgotPassword']->getField('form_token')->getAttribute('id'); ?>" value="<?php echo htmlspecialchars($this->forms['forgotPassword']->getField('form_token')->getValue()); ?>" />
						<?php } ?>
							<div class="oneLiner">
								<p><label for="backendEmailForgot"><?php if(array_key_exists('lblEmail', (array) $this->variables)) { echo SpoonFilter::ucfirst($this->variables['lblEmail']); } else { ?>{$lblEmail|ucfirst}<?php } ?></label></p>
								<p><?php if(array_key_exists('txtBackendEmailForgot', (array) $this->variables)) { echo $this->variables['txtBackendEmailForgot']; } else { ?>{$txtBackendEmailForgot}<?php } ?></p>
								<p>
									<input id="send" type="submit" name="send" value="<?php if(array_key_exists('lblSend', (array) $this->variables)) { echo SpoonFilter::ucfirst($this->variables['lblSend']); } else { ?>{$lblSend|ucfirst}<?php } ?>" />
								</p>
							</div>

							<?php
					if(isset($this->variables['txtBackendEmailForgotError']) && count($this->variables['txtBackendEmailForgotError']) != 0 && $this->variables['txtBackendEmailForgotError'] != '' && $this->variables['txtBackendEmailForgotError'] !== false)
					{
						?>
								<div class="errorMessage singleMessage">
									<p><?php if(array_key_exists('txtBackendEmailForgotError', (array) $this->variables)) { echo $this->variables['txtBackendEmailForgotError']; } else { ?>{$txtBackendEmailForgotError}<?php } ?></p>
								</div>
							<?php } ?>

							<?php
					if(isset($this->variables['isForgotPasswordSuccess']) && count($this->variables['isForgotPasswordSuccess']) != 0 && $this->variables['isForgotPasswordSuccess'] != '' && $this->variables['isForgotPasswordSuccess'] !== false)
					{
						?>
								<div class="successMessage singleMessage">
									<p><?php if(array_key_exists('msgLoginFormForgotPasswordSuccess', (array) $this->variables)) { echo $this->variables['msgLoginFormForgotPasswordSuccess']; } else { ?>{$msgLoginFormForgotPasswordSuccess}<?php } ?></p>
								</div>
							<?php } ?>
						</form>
				<?php } ?>
					</div>
				</div>

			</td>
		</tr>
	</table>
<?php
				ob_start();
				?><?php if(array_key_exists('BACKEND_CORE_PATH', (array) $this->variables)) { echo $this->variables['BACKEND_CORE_PATH']; } else { ?>{$BACKEND_CORE_PATH}<?php } ?>/Layout/Templates/Footer.tpl<?php
				$include = eval('return \'' . str_replace('\'', '\\\'', ob_get_clean()) .'\';');
				if($this->getForceCompile() || !file_exists($this->getCompileDirectory() .'/' . $this->getCompileName($include, 'J:\home\technomir.com\www\src\Backend\Modules\Authentication\Layout\Templates'))) $this->compile('J:\home\technomir.com\www\src\Backend\Modules\Authentication\Layout\Templates', $include);
				$return = @include $this->getCompileDirectory() .'/' . $this->getCompileName($include, 'J:\home\technomir.com\www\src\Backend\Modules\Authentication\Layout\Templates');
				if($return === false && $this->compile('J:\home\technomir.com\www\src\Backend\Modules\Authentication\Layout\Templates', $include))
				{
					$return = @include $this->getCompileDirectory() .'/' . $this->getCompileName($include, 'J:\home\technomir.com\www\src\Backend\Modules\Authentication\Layout\Templates');
				}
if($return === false)
				{
					?>{include:<?php if(array_key_exists('BACKEND_CORE_PATH', (array) $this->variables)) { echo $this->variables['BACKEND_CORE_PATH']; } else { ?>{$BACKEND_CORE_PATH}<?php } ?>/Layout/Templates/Footer.tpl}<?php
				}
?>
