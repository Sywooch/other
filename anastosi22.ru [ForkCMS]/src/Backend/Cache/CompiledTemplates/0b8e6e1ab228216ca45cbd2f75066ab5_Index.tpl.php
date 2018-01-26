<?php error_reporting(0); ini_set('display_errors', 'Off'); ?>
<?php
				ob_start();
				?><?php echo $this->variables['BACKEND_CORE_PATH']; ?>/Layout/Templates/Head.tpl<?php
				$include = eval('return \'' . str_replace('\'', '\\\'', ob_get_clean()) .'\';');
				if($this->getForceCompile() || !file_exists($this->getCompileDirectory() .'/' . $this->getCompileName($include, '/home/anastosi/domains/anastosi.ru/public_html/src/Backend/Modules/Authentication/Layout/Templates'))) $this->compile('/home/anastosi/domains/anastosi.ru/public_html/src/Backend/Modules/Authentication/Layout/Templates', $include);
				$return = @include $this->getCompileDirectory() .'/' . $this->getCompileName($include, '/home/anastosi/domains/anastosi.ru/public_html/src/Backend/Modules/Authentication/Layout/Templates');
				if($return === false && $this->compile('/home/anastosi/domains/anastosi.ru/public_html/src/Backend/Modules/Authentication/Layout/Templates', $include))
				{
					$return = @include $this->getCompileDirectory() .'/' . $this->getCompileName($include, '/home/anastosi/domains/anastosi.ru/public_html/src/Backend/Modules/Authentication/Layout/Templates');
				}
?>
<body id="login">
	<?php
				ob_start();
				?><?php echo $this->variables['BACKEND_MODULES_PATH']; ?>/<?php echo $this->variables['MODULE']; ?>/Layout/Templates/Ie6.tpl<?php
				$include = eval('return \'' . str_replace('\'', '\\\'', ob_get_clean()) .'\';');
				if($this->getForceCompile() || !file_exists($this->getCompileDirectory() .'/' . $this->getCompileName($include, '/home/anastosi/domains/anastosi.ru/public_html/src/Backend/Modules/Authentication/Layout/Templates'))) $this->compile('/home/anastosi/domains/anastosi.ru/public_html/src/Backend/Modules/Authentication/Layout/Templates', $include);
				$return = @include $this->getCompileDirectory() .'/' . $this->getCompileName($include, '/home/anastosi/domains/anastosi.ru/public_html/src/Backend/Modules/Authentication/Layout/Templates');
				if($return === false && $this->compile('/home/anastosi/domains/anastosi.ru/public_html/src/Backend/Modules/Authentication/Layout/Templates', $include))
				{
					$return = @include $this->getCompileDirectory() .'/' . $this->getCompileName($include, '/home/anastosi/domains/anastosi.ru/public_html/src/Backend/Modules/Authentication/Layout/Templates');
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
							<p><?php echo $this->variables['errInvalidEmailPasswordCombination']; ?></p>
						</div>
					</div>
				<?php } ?>

				<?php
					if(isset($this->variables['hasTooManyAttemps']) && count($this->variables['hasTooManyAttemps']) != 0 && $this->variables['hasTooManyAttemps'] != '' && $this->variables['hasTooManyAttemps'] !== false)
					{
						?>
					<div id="loginError">
						<div class="errorMessage singleMessage">
							<p><?php echo $this->variables['errTooManyLoginAttempts']; ?></p>
						</div>
					</div>
				<?php } ?>

				<div id="loginBox" <?php
					if(isset($this->variables['hasError']) && count($this->variables['hasError']) != 0 && $this->variables['hasError'] != '' && $this->variables['hasError'] !== false)
					{
						?>class="hasError"<?php } ?>>
					<div id="loginBoxTop">
						<h2><?php echo $this->variables['SITE_TITLE']; ?></h2>
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
									<label for="backendEmail"><?php echo SpoonFilter::ucfirst($this->variables['lblEmail']); ?></label>
									<?php echo $this->variables['txtBackendEmail']; ?> <?php echo $this->variables['txtBackendEmailError']; ?>
								</p>
								<p>
									<label for="backendPassword"><?php echo SpoonFilter::ucfirst($this->variables['lblPassword']); ?></label>
									<?php echo $this->variables['txtBackendPassword']; ?> <?php echo $this->variables['txtBackendPasswordError']; ?>
								</p>
							</div>
							<p class="spacing">
								<input name="login" type="submit" value="<?php echo SpoonFilter::ucfirst($this->variables['lblSignIn']); ?>" class="inputButton button mainButton" />
							</p>
						</div>
					</form>
				<?php } ?>

					<ul id="loginNav">
						<li><a href="#" id="forgotPasswordLink" class="toggleBalloon" data-message-id="forgotPasswordHolder"><?php echo $this->variables['msgForgotPassword']; ?></a></li>
					</ul>
				</div>

				<div id="forgotPasswordHolder" class="balloon <?php if(!isset($this->variables['showForm']) || count($this->variables['showForm']) == 0 || $this->variables['showForm'] == '' || $this->variables['showForm'] === false): ?>balloonNoMessage<?php endif; ?>"<?php if(!isset($this->variables['showForm']) || count($this->variables['showForm']) == 0 || $this->variables['showForm'] == '' || $this->variables['showForm'] === false): ?> style="display: none;"<?php endif; ?>>
					<div id="forgotPasswordBox">

						<a class="button linkButton icon iconClose iconOnly toggleBalloon" href="#" data-message-id="forgotPasswordHolder"><span>X</span></a>

						<div class="balloonTop">&nbsp;</div>

						<p><?php echo $this->variables['msgHelpForgotPassword']; ?></p>
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
								<p><label for="backendEmailForgot"><?php echo SpoonFilter::ucfirst($this->variables['lblEmail']); ?></label></p>
								<p><?php echo $this->variables['txtBackendEmailForgot']; ?></p>
								<p>
									<input id="send" type="submit" name="send" value="<?php echo SpoonFilter::ucfirst($this->variables['lblSend']); ?>" />
								</p>
							</div>

							<?php
					if(isset($this->variables['txtBackendEmailForgotError']) && count($this->variables['txtBackendEmailForgotError']) != 0 && $this->variables['txtBackendEmailForgotError'] != '' && $this->variables['txtBackendEmailForgotError'] !== false)
					{
						?>
								<div class="errorMessage singleMessage">
									<p><?php echo $this->variables['txtBackendEmailForgotError']; ?></p>
								</div>
							<?php } ?>

							<?php
					if(isset($this->variables['isForgotPasswordSuccess']) && count($this->variables['isForgotPasswordSuccess']) != 0 && $this->variables['isForgotPasswordSuccess'] != '' && $this->variables['isForgotPasswordSuccess'] !== false)
					{
						?>
								<div class="successMessage singleMessage">
									<p><?php echo $this->variables['msgLoginFormForgotPasswordSuccess']; ?></p>
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
				?><?php echo $this->variables['BACKEND_CORE_PATH']; ?>/Layout/Templates/Footer.tpl<?php
				$include = eval('return \'' . str_replace('\'', '\\\'', ob_get_clean()) .'\';');
				if($this->getForceCompile() || !file_exists($this->getCompileDirectory() .'/' . $this->getCompileName($include, '/home/anastosi/domains/anastosi.ru/public_html/src/Backend/Modules/Authentication/Layout/Templates'))) $this->compile('/home/anastosi/domains/anastosi.ru/public_html/src/Backend/Modules/Authentication/Layout/Templates', $include);
				$return = @include $this->getCompileDirectory() .'/' . $this->getCompileName($include, '/home/anastosi/domains/anastosi.ru/public_html/src/Backend/Modules/Authentication/Layout/Templates');
				if($return === false && $this->compile('/home/anastosi/domains/anastosi.ru/public_html/src/Backend/Modules/Authentication/Layout/Templates', $include))
				{
					$return = @include $this->getCompileDirectory() .'/' . $this->getCompileName($include, '/home/anastosi/domains/anastosi.ru/public_html/src/Backend/Modules/Authentication/Layout/Templates');
				}
?>
