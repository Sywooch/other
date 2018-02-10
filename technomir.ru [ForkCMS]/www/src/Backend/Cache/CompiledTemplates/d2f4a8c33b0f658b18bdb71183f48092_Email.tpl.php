<?php error_reporting(E_ALL | E_STRICT); ini_set('display_errors', 'On'); ?>
<?php
				ob_start();
				?><?php if(array_key_exists('BACKEND_CORE_PATH', (array) $this->variables)) { echo $this->variables['BACKEND_CORE_PATH']; } else { ?>{$BACKEND_CORE_PATH}<?php } ?>/Layout/Templates/Head.tpl<?php
				$include = eval('return \'' . str_replace('\'', '\\\'', ob_get_clean()) .'\';');
				if($this->getForceCompile() || !file_exists($this->getCompileDirectory() .'/' . $this->getCompileName($include, '/home/segaz/domains/techno-mir.net/public_html/src/Backend/Modules/Settings/Layout/Templates'))) $this->compile('/home/segaz/domains/techno-mir.net/public_html/src/Backend/Modules/Settings/Layout/Templates', $include);
				$return = @include $this->getCompileDirectory() .'/' . $this->getCompileName($include, '/home/segaz/domains/techno-mir.net/public_html/src/Backend/Modules/Settings/Layout/Templates');
				if($return === false && $this->compile('/home/segaz/domains/techno-mir.net/public_html/src/Backend/Modules/Settings/Layout/Templates', $include))
				{
					$return = @include $this->getCompileDirectory() .'/' . $this->getCompileName($include, '/home/segaz/domains/techno-mir.net/public_html/src/Backend/Modules/Settings/Layout/Templates');
				}
if($return === false)
				{
					?>{include:<?php if(array_key_exists('BACKEND_CORE_PATH', (array) $this->variables)) { echo $this->variables['BACKEND_CORE_PATH']; } else { ?>{$BACKEND_CORE_PATH}<?php } ?>/Layout/Templates/Head.tpl}<?php
				}
?>
<?php
				ob_start();
				?><?php if(array_key_exists('BACKEND_CORE_PATH', (array) $this->variables)) { echo $this->variables['BACKEND_CORE_PATH']; } else { ?>{$BACKEND_CORE_PATH}<?php } ?>/Layout/Templates/StructureStartModule.tpl<?php
				$include = eval('return \'' . str_replace('\'', '\\\'', ob_get_clean()) .'\';');
				if($this->getForceCompile() || !file_exists($this->getCompileDirectory() .'/' . $this->getCompileName($include, '/home/segaz/domains/techno-mir.net/public_html/src/Backend/Modules/Settings/Layout/Templates'))) $this->compile('/home/segaz/domains/techno-mir.net/public_html/src/Backend/Modules/Settings/Layout/Templates', $include);
				$return = @include $this->getCompileDirectory() .'/' . $this->getCompileName($include, '/home/segaz/domains/techno-mir.net/public_html/src/Backend/Modules/Settings/Layout/Templates');
				if($return === false && $this->compile('/home/segaz/domains/techno-mir.net/public_html/src/Backend/Modules/Settings/Layout/Templates', $include))
				{
					$return = @include $this->getCompileDirectory() .'/' . $this->getCompileName($include, '/home/segaz/domains/techno-mir.net/public_html/src/Backend/Modules/Settings/Layout/Templates');
				}
if($return === false)
				{
					?>{include:<?php if(array_key_exists('BACKEND_CORE_PATH', (array) $this->variables)) { echo $this->variables['BACKEND_CORE_PATH']; } else { ?>{$BACKEND_CORE_PATH}<?php } ?>/Layout/Templates/StructureStartModule.tpl}<?php
				}
?>

<div class="pageTitle">
	<h2><?php if(array_key_exists('lblGeneralSettings', (array) $this->variables)) { echo SpoonFilter::ucfirst($this->variables['lblGeneralSettings']); } else { ?>{$lblGeneralSettings|ucfirst}<?php } ?></h2>
</div>

<?php
					if(isset($this->forms['settingsEmail']))
					{
						?><form accept-charset="UTF-8" action="<?php echo $this->forms['settingsEmail']->getAction(); ?>" method="<?php echo $this->forms['settingsEmail']->getMethod(); ?>"<?php echo $this->forms['settingsEmail']->getParametersHTML(); ?>>
						<?php echo $this->forms['settingsEmail']->getField('form')->parse();
						if($this->forms['settingsEmail']->getUseToken())
						{
							?><input type="hidden" name="form_token" id="<?php echo $this->forms['settingsEmail']->getField('form_token')->getAttribute('id'); ?>" value="<?php echo htmlspecialchars($this->forms['settingsEmail']->getField('form_token')->getValue()); ?>" />
						<?php } ?>
	<div class="box">
		<div class="heading">
			<h3><?php if(array_key_exists('lblEmail', (array) $this->variables)) { echo SpoonFilter::ucfirst($this->variables['lblEmail']); } else { ?>{$lblEmail|ucfirst}<?php } ?></h3>
		</div>
	<?php
					if(isset($this->variables['isGod']) && count($this->variables['isGod']) != 0 && $this->variables['isGod'] != '' && $this->variables['isGod'] !== false)
					{
						?>
		<div class="options">
			<h4><label for="mailerType"><?php if(array_key_exists('lblSendingEmails', (array) $this->variables)) { echo SpoonFilter::ucfirst($this->variables['lblSendingEmails']); } else { ?>{$lblSendingEmails|ucfirst}<?php } ?></label></h4>
			<p><?php if(array_key_exists('msgHelpSendingEmails', (array) $this->variables)) { echo $this->variables['msgHelpSendingEmails']; } else { ?>{$msgHelpSendingEmails}<?php } ?></p>
			<p>
				<?php if(array_key_exists('ddmMailerType', (array) $this->variables)) { echo $this->variables['ddmMailerType']; } else { ?>{$ddmMailerType}<?php } ?> <?php if(array_key_exists('ddmMailerTypeError', (array) $this->variables)) { echo $this->variables['ddmMailerTypeError']; } else { ?>{$ddmMailerTypeError}<?php } ?>

				<small>
					<a id="testEmailConnection" href="#"><?php if(array_key_exists('msgSendTestMail', (array) $this->variables)) { echo $this->variables['msgSendTestMail']; } else { ?>{$msgSendTestMail}<?php } ?></a>
					<span id="testEmailConnectionSpinner" style="display: none;"><img style="margin-top: 3px;" src="/src/Backend/Core/Layout/images/spinner.gif" width="12px" height="12px" alt="loading" /></span>
					<span id="testEmailConnectionError" style="display: none;" class="formError"><?php if(array_key_exists('errErrorWhileSendingEmail', (array) $this->variables)) { echo $this->variables['errErrorWhileSendingEmail']; } else { ?>{$errErrorWhileSendingEmail}<?php } ?></span>
					<span id="testEmailConnectionSuccess" style="display: none;" class="formSuccess"><?php if(array_key_exists('msgTestWasSent', (array) $this->variables)) { echo $this->variables['msgTestWasSent']; } else { ?>{$msgTestWasSent}<?php } ?></span>
				</small>
			</p>
		</div>
	<?php } ?>
		<div class="options">
			<h4><?php if(array_key_exists('lblFrom', (array) $this->variables)) { echo SpoonFilter::ucfirst($this->variables['lblFrom']); } else { ?>{$lblFrom|ucfirst}<?php } ?></h4>
			<p><?php if(array_key_exists('msgHelpEmailFrom', (array) $this->variables)) { echo $this->variables['msgHelpEmailFrom']; } else { ?>{$msgHelpEmailFrom}<?php } ?></p>
			<p>
				<label for="mailerFromName"><?php if(array_key_exists('lblName', (array) $this->variables)) { echo SpoonFilter::ucfirst($this->variables['lblName']); } else { ?>{$lblName|ucfirst}<?php } ?><abbr title="<?php if(array_key_exists('lblRequiredField', (array) $this->variables)) { echo $this->variables['lblRequiredField']; } else { ?>{$lblRequiredField}<?php } ?>">*</abbr></label>
				<?php if(array_key_exists('txtMailerFromName', (array) $this->variables)) { echo $this->variables['txtMailerFromName']; } else { ?>{$txtMailerFromName}<?php } ?> <?php if(array_key_exists('txtMailerFromNameError', (array) $this->variables)) { echo $this->variables['txtMailerFromNameError']; } else { ?>{$txtMailerFromNameError}<?php } ?>
			</p>
			<p>
				<label for="mailerFromEmail"><?php if(array_key_exists('lblEmail', (array) $this->variables)) { echo SpoonFilter::ucfirst($this->variables['lblEmail']); } else { ?>{$lblEmail|ucfirst}<?php } ?><abbr title="<?php if(array_key_exists('lblRequiredField', (array) $this->variables)) { echo $this->variables['lblRequiredField']; } else { ?>{$lblRequiredField}<?php } ?>">*</abbr></label>
				<?php if(array_key_exists('txtMailerFromEmail', (array) $this->variables)) { echo $this->variables['txtMailerFromEmail']; } else { ?>{$txtMailerFromEmail}<?php } ?> <?php if(array_key_exists('txtMailerFromEmailError', (array) $this->variables)) { echo $this->variables['txtMailerFromEmailError']; } else { ?>{$txtMailerFromEmailError}<?php } ?>
			</p>
		</div>
		<div class="options">
			<h4><?php if(array_key_exists('lblTo', (array) $this->variables)) { echo SpoonFilter::ucfirst($this->variables['lblTo']); } else { ?>{$lblTo|ucfirst}<?php } ?></h4>
			<p><?php if(array_key_exists('msgHelpEmailTo', (array) $this->variables)) { echo $this->variables['msgHelpEmailTo']; } else { ?>{$msgHelpEmailTo}<?php } ?></p>
			<p>
				<label for="mailerToName"><?php if(array_key_exists('lblName', (array) $this->variables)) { echo SpoonFilter::ucfirst($this->variables['lblName']); } else { ?>{$lblName|ucfirst}<?php } ?><abbr title="<?php if(array_key_exists('lblRequiredField', (array) $this->variables)) { echo $this->variables['lblRequiredField']; } else { ?>{$lblRequiredField}<?php } ?>">*</abbr></label>
				<?php if(array_key_exists('txtMailerToName', (array) $this->variables)) { echo $this->variables['txtMailerToName']; } else { ?>{$txtMailerToName}<?php } ?> <?php if(array_key_exists('txtMailerToNameError', (array) $this->variables)) { echo $this->variables['txtMailerToNameError']; } else { ?>{$txtMailerToNameError}<?php } ?>
			</p>
			<p>
				<label for="mailerToEmail"><?php if(array_key_exists('lblEmail', (array) $this->variables)) { echo SpoonFilter::ucfirst($this->variables['lblEmail']); } else { ?>{$lblEmail|ucfirst}<?php } ?><abbr title="<?php if(array_key_exists('lblRequiredField', (array) $this->variables)) { echo $this->variables['lblRequiredField']; } else { ?>{$lblRequiredField}<?php } ?>">*</abbr></label>
				<?php if(array_key_exists('txtMailerToEmail', (array) $this->variables)) { echo $this->variables['txtMailerToEmail']; } else { ?>{$txtMailerToEmail}<?php } ?> <?php if(array_key_exists('txtMailerToEmailError', (array) $this->variables)) { echo $this->variables['txtMailerToEmailError']; } else { ?>{$txtMailerToEmailError}<?php } ?>
			</p>
		</div>
		<div class="options">
			<h4><?php if(array_key_exists('lblReplyTo', (array) $this->variables)) { echo SpoonFilter::ucfirst($this->variables['lblReplyTo']); } else { ?>{$lblReplyTo|ucfirst}<?php } ?></h4>
			<p>
				<label for="mailerReplyToName"><?php if(array_key_exists('lblName', (array) $this->variables)) { echo SpoonFilter::ucfirst($this->variables['lblName']); } else { ?>{$lblName|ucfirst}<?php } ?><abbr title="<?php if(array_key_exists('lblRequiredField', (array) $this->variables)) { echo $this->variables['lblRequiredField']; } else { ?>{$lblRequiredField}<?php } ?>">*</abbr></label>
				<?php if(array_key_exists('txtMailerReplyToName', (array) $this->variables)) { echo $this->variables['txtMailerReplyToName']; } else { ?>{$txtMailerReplyToName}<?php } ?> <?php if(array_key_exists('txtMailerReplyToNameError', (array) $this->variables)) { echo $this->variables['txtMailerReplyToNameError']; } else { ?>{$txtMailerReplyToNameError}<?php } ?>
			</p>
			<p>
				<label for="mailerReplyToEmail"><?php if(array_key_exists('lblEmail', (array) $this->variables)) { echo SpoonFilter::ucfirst($this->variables['lblEmail']); } else { ?>{$lblEmail|ucfirst}<?php } ?><abbr title="<?php if(array_key_exists('lblRequiredField', (array) $this->variables)) { echo $this->variables['lblRequiredField']; } else { ?>{$lblRequiredField}<?php } ?>">*</abbr></label>
				<?php if(array_key_exists('txtMailerReplyToEmail', (array) $this->variables)) { echo $this->variables['txtMailerReplyToEmail']; } else { ?>{$txtMailerReplyToEmail}<?php } ?> <?php if(array_key_exists('txtMailerReplyToEmailError', (array) $this->variables)) { echo $this->variables['txtMailerReplyToEmailError']; } else { ?>{$txtMailerReplyToEmailError}<?php } ?>
			</p>
		</div>
	</div>

	<?php
					if(isset($this->variables['isGod']) && count($this->variables['isGod']) != 0 && $this->variables['isGod'] != '' && $this->variables['isGod'] !== false)
					{
						?>
	<div class="box">
		<div class="heading">
			<h3><?php if(array_key_exists('lblSMTP', (array) $this->variables)) { echo SpoonFilter::ucfirst($this->variables['lblSMTP']); } else { ?>{$lblSMTP|ucfirst}<?php } ?></h3>
		</div>
		<div class="options">
			<p>
				<label for="smtpServer" style="float: left;"><?php if(array_key_exists('lblServer', (array) $this->variables)) { echo SpoonFilter::ucfirst($this->variables['lblServer']); } else { ?>{$lblServer|ucfirst}<?php } ?></label><label for="smtpPort">&#160;&amp; <?php if(array_key_exists('lblPort', (array) $this->variables)) { echo $this->variables['lblPort']; } else { ?>{$lblPort}<?php } ?></label>
				<?php if(array_key_exists('txtSmtpServer', (array) $this->variables)) { echo $this->variables['txtSmtpServer']; } else { ?>{$txtSmtpServer}<?php } ?>:<?php if(array_key_exists('txtSmtpPort', (array) $this->variables)) { echo $this->variables['txtSmtpPort']; } else { ?>{$txtSmtpPort}<?php } ?> <?php if(array_key_exists('txtSmtpServerError', (array) $this->variables)) { echo $this->variables['txtSmtpServerError']; } else { ?>{$txtSmtpServerError}<?php } ?> <?php if(array_key_exists('txtSmtpPortError', (array) $this->variables)) { echo $this->variables['txtSmtpPortError']; } else { ?>{$txtSmtpPortError}<?php } ?>
				<span class="helpTxt"><?php if(array_key_exists('msgHelpSMTPServer', (array) $this->variables)) { echo $this->variables['msgHelpSMTPServer']; } else { ?>{$msgHelpSMTPServer}<?php } ?></span>
			</p>
			<p>
				<label for="smtpUsername"><?php if(array_key_exists('lblUsername', (array) $this->variables)) { echo SpoonFilter::ucfirst($this->variables['lblUsername']); } else { ?>{$lblUsername|ucfirst}<?php } ?></label>
				<?php if(array_key_exists('txtSmtpUsername', (array) $this->variables)) { echo $this->variables['txtSmtpUsername']; } else { ?>{$txtSmtpUsername}<?php } ?> <?php if(array_key_exists('txtSmtpUsernameError', (array) $this->variables)) { echo $this->variables['txtSmtpUsernameError']; } else { ?>{$txtSmtpUsernameError}<?php } ?>
			</p>
			<p>
				<label for="smtpPassword"><?php if(array_key_exists('lblPassword', (array) $this->variables)) { echo SpoonFilter::ucfirst($this->variables['lblPassword']); } else { ?>{$lblPassword|ucfirst}<?php } ?></label>
				<?php if(array_key_exists('txtSmtpPassword', (array) $this->variables)) { echo $this->variables['txtSmtpPassword']; } else { ?>{$txtSmtpPassword}<?php } ?> <?php if(array_key_exists('txtSmtpPasswordError', (array) $this->variables)) { echo $this->variables['txtSmtpPasswordError']; } else { ?>{$txtSmtpPasswordError}<?php } ?>
			</p>
			<p>
		   <label for="smtpSecureLayer"><?php if(array_key_exists('lblSmtpSecureLayer', (array) $this->variables)) { echo SpoonFilter::ucfirst($this->variables['lblSmtpSecureLayer']); } else { ?>{$lblSmtpSecureLayer|ucfirst}<?php } ?></label>
			   <?php if(array_key_exists('ddmSmtpSecureLayer', (array) $this->variables)) { echo $this->variables['ddmSmtpSecureLayer']; } else { ?>{$ddmSmtpSecureLayer}<?php } ?> 
			</p>
		</div>
	</div>
	<?php } ?>

	<div class="fullwidthOptions">
		<div class="buttonHolderRight">
			<input id="save" class="inputButton button mainButton" type="submit" name="save" value="<?php if(array_key_exists('lblSave', (array) $this->variables)) { echo SpoonFilter::ucfirst($this->variables['lblSave']); } else { ?>{$lblSave|ucfirst}<?php } ?>" />
		</div>
	</div>
</form>
				<?php } ?>

<?php
				ob_start();
				?><?php if(array_key_exists('BACKEND_CORE_PATH', (array) $this->variables)) { echo $this->variables['BACKEND_CORE_PATH']; } else { ?>{$BACKEND_CORE_PATH}<?php } ?>/Layout/Templates/StructureEndModule.tpl<?php
				$include = eval('return \'' . str_replace('\'', '\\\'', ob_get_clean()) .'\';');
				if($this->getForceCompile() || !file_exists($this->getCompileDirectory() .'/' . $this->getCompileName($include, '/home/segaz/domains/techno-mir.net/public_html/src/Backend/Modules/Settings/Layout/Templates'))) $this->compile('/home/segaz/domains/techno-mir.net/public_html/src/Backend/Modules/Settings/Layout/Templates', $include);
				$return = @include $this->getCompileDirectory() .'/' . $this->getCompileName($include, '/home/segaz/domains/techno-mir.net/public_html/src/Backend/Modules/Settings/Layout/Templates');
				if($return === false && $this->compile('/home/segaz/domains/techno-mir.net/public_html/src/Backend/Modules/Settings/Layout/Templates', $include))
				{
					$return = @include $this->getCompileDirectory() .'/' . $this->getCompileName($include, '/home/segaz/domains/techno-mir.net/public_html/src/Backend/Modules/Settings/Layout/Templates');
				}
if($return === false)
				{
					?>{include:<?php if(array_key_exists('BACKEND_CORE_PATH', (array) $this->variables)) { echo $this->variables['BACKEND_CORE_PATH']; } else { ?>{$BACKEND_CORE_PATH}<?php } ?>/Layout/Templates/StructureEndModule.tpl}<?php
				}
?>
<?php
				ob_start();
				?><?php if(array_key_exists('BACKEND_CORE_PATH', (array) $this->variables)) { echo $this->variables['BACKEND_CORE_PATH']; } else { ?>{$BACKEND_CORE_PATH}<?php } ?>/Layout/Templates/Footer.tpl<?php
				$include = eval('return \'' . str_replace('\'', '\\\'', ob_get_clean()) .'\';');
				if($this->getForceCompile() || !file_exists($this->getCompileDirectory() .'/' . $this->getCompileName($include, '/home/segaz/domains/techno-mir.net/public_html/src/Backend/Modules/Settings/Layout/Templates'))) $this->compile('/home/segaz/domains/techno-mir.net/public_html/src/Backend/Modules/Settings/Layout/Templates', $include);
				$return = @include $this->getCompileDirectory() .'/' . $this->getCompileName($include, '/home/segaz/domains/techno-mir.net/public_html/src/Backend/Modules/Settings/Layout/Templates');
				if($return === false && $this->compile('/home/segaz/domains/techno-mir.net/public_html/src/Backend/Modules/Settings/Layout/Templates', $include))
				{
					$return = @include $this->getCompileDirectory() .'/' . $this->getCompileName($include, '/home/segaz/domains/techno-mir.net/public_html/src/Backend/Modules/Settings/Layout/Templates');
				}
if($return === false)
				{
					?>{include:<?php if(array_key_exists('BACKEND_CORE_PATH', (array) $this->variables)) { echo $this->variables['BACKEND_CORE_PATH']; } else { ?>{$BACKEND_CORE_PATH}<?php } ?>/Layout/Templates/Footer.tpl}<?php
				}
?>
