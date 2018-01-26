<?php error_reporting(0); ini_set('display_errors', 'Off'); ?>
<?php
				ob_start();
				?><?php echo $this->variables['BACKEND_CORE_PATH']; ?>/Layout/Templates/Head.tpl<?php
				$include = eval('return \'' . str_replace('\'', '\\\'', ob_get_clean()) .'\';');
				if($this->getForceCompile() || !file_exists($this->getCompileDirectory() .'/' . $this->getCompileName($include, '/home/anastosi/domains/anastosi.ru/public_html/src/Backend/Modules/Settings/Layout/Templates'))) $this->compile('/home/anastosi/domains/anastosi.ru/public_html/src/Backend/Modules/Settings/Layout/Templates', $include);
				$return = @include $this->getCompileDirectory() .'/' . $this->getCompileName($include, '/home/anastosi/domains/anastosi.ru/public_html/src/Backend/Modules/Settings/Layout/Templates');
				if($return === false && $this->compile('/home/anastosi/domains/anastosi.ru/public_html/src/Backend/Modules/Settings/Layout/Templates', $include))
				{
					$return = @include $this->getCompileDirectory() .'/' . $this->getCompileName($include, '/home/anastosi/domains/anastosi.ru/public_html/src/Backend/Modules/Settings/Layout/Templates');
				}
?>
<?php
				ob_start();
				?><?php echo $this->variables['BACKEND_CORE_PATH']; ?>/Layout/Templates/StructureStartModule.tpl<?php
				$include = eval('return \'' . str_replace('\'', '\\\'', ob_get_clean()) .'\';');
				if($this->getForceCompile() || !file_exists($this->getCompileDirectory() .'/' . $this->getCompileName($include, '/home/anastosi/domains/anastosi.ru/public_html/src/Backend/Modules/Settings/Layout/Templates'))) $this->compile('/home/anastosi/domains/anastosi.ru/public_html/src/Backend/Modules/Settings/Layout/Templates', $include);
				$return = @include $this->getCompileDirectory() .'/' . $this->getCompileName($include, '/home/anastosi/domains/anastosi.ru/public_html/src/Backend/Modules/Settings/Layout/Templates');
				if($return === false && $this->compile('/home/anastosi/domains/anastosi.ru/public_html/src/Backend/Modules/Settings/Layout/Templates', $include))
				{
					$return = @include $this->getCompileDirectory() .'/' . $this->getCompileName($include, '/home/anastosi/domains/anastosi.ru/public_html/src/Backend/Modules/Settings/Layout/Templates');
				}
?>

<div class="pageTitle">
	<h2><?php echo SpoonFilter::ucfirst($this->variables['lblGeneralSettings']); ?></h2>
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
			<h3><?php echo SpoonFilter::ucfirst($this->variables['lblEmail']); ?></h3>
		</div>
	<?php
					if(isset($this->variables['isGod']) && count($this->variables['isGod']) != 0 && $this->variables['isGod'] != '' && $this->variables['isGod'] !== false)
					{
						?>
		<div class="options">
			<h4><label for="mailerType"><?php echo SpoonFilter::ucfirst($this->variables['lblSendingEmails']); ?></label></h4>
			<p><?php echo $this->variables['msgHelpSendingEmails']; ?></p>
			<p>
				<?php echo $this->variables['ddmMailerType']; ?> <?php echo $this->variables['ddmMailerTypeError']; ?>

				<small>
					<a id="testEmailConnection" href="#"><?php echo $this->variables['msgSendTestMail']; ?></a>
					<span id="testEmailConnectionSpinner" style="display: none;"><img style="margin-top: 3px;" src="/src/Backend/Core/Layout/images/spinner.gif" width="12px" height="12px" alt="loading" /></span>
					<span id="testEmailConnectionError" style="display: none;" class="formError"><?php echo $this->variables['errErrorWhileSendingEmail']; ?></span>
					<span id="testEmailConnectionSuccess" style="display: none;" class="formSuccess"><?php echo $this->variables['msgTestWasSent']; ?></span>
				</small>
			</p>
		</div>
	<?php } ?>
		<div class="options">
			<h4><?php echo SpoonFilter::ucfirst($this->variables['lblFrom']); ?></h4>
			<p><?php echo $this->variables['msgHelpEmailFrom']; ?></p>
			<p>
				<label for="mailerFromName"><?php echo SpoonFilter::ucfirst($this->variables['lblName']); ?><abbr title="<?php echo $this->variables['lblRequiredField']; ?>">*</abbr></label>
				<?php echo $this->variables['txtMailerFromName']; ?> <?php echo $this->variables['txtMailerFromNameError']; ?>
			</p>
			<p>
				<label for="mailerFromEmail"><?php echo SpoonFilter::ucfirst($this->variables['lblEmail']); ?><abbr title="<?php echo $this->variables['lblRequiredField']; ?>">*</abbr></label>
				<?php echo $this->variables['txtMailerFromEmail']; ?> <?php echo $this->variables['txtMailerFromEmailError']; ?>
			</p>
		</div>
		<div class="options">
			<h4><?php echo SpoonFilter::ucfirst($this->variables['lblTo']); ?></h4>
			<p><?php echo $this->variables['msgHelpEmailTo']; ?></p>
			<p>
				<label for="mailerToName"><?php echo SpoonFilter::ucfirst($this->variables['lblName']); ?><abbr title="<?php echo $this->variables['lblRequiredField']; ?>">*</abbr></label>
				<?php echo $this->variables['txtMailerToName']; ?> <?php echo $this->variables['txtMailerToNameError']; ?>
			</p>
			<p>
				<label for="mailerToEmail"><?php echo SpoonFilter::ucfirst($this->variables['lblEmail']); ?><abbr title="<?php echo $this->variables['lblRequiredField']; ?>">*</abbr></label>
				<?php echo $this->variables['txtMailerToEmail']; ?> <?php echo $this->variables['txtMailerToEmailError']; ?>
			</p>
		</div>
		<div class="options">
			<h4><?php echo SpoonFilter::ucfirst($this->variables['lblReplyTo']); ?></h4>
			<p>
				<label for="mailerReplyToName"><?php echo SpoonFilter::ucfirst($this->variables['lblName']); ?><abbr title="<?php echo $this->variables['lblRequiredField']; ?>">*</abbr></label>
				<?php echo $this->variables['txtMailerReplyToName']; ?> <?php echo $this->variables['txtMailerReplyToNameError']; ?>
			</p>
			<p>
				<label for="mailerReplyToEmail"><?php echo SpoonFilter::ucfirst($this->variables['lblEmail']); ?><abbr title="<?php echo $this->variables['lblRequiredField']; ?>">*</abbr></label>
				<?php echo $this->variables['txtMailerReplyToEmail']; ?> <?php echo $this->variables['txtMailerReplyToEmailError']; ?>
			</p>
		</div>
	</div>

	<?php
					if(isset($this->variables['isGod']) && count($this->variables['isGod']) != 0 && $this->variables['isGod'] != '' && $this->variables['isGod'] !== false)
					{
						?>
	<div class="box">
		<div class="heading">
			<h3><?php echo SpoonFilter::ucfirst($this->variables['lblSMTP']); ?></h3>
		</div>
		<div class="options">
			<p>
				<label for="smtpServer" style="float: left;"><?php echo SpoonFilter::ucfirst($this->variables['lblServer']); ?></label><label for="smtpPort">&#160;&amp; <?php echo $this->variables['lblPort']; ?></label>
				<?php echo $this->variables['txtSmtpServer']; ?>:<?php echo $this->variables['txtSmtpPort']; ?> <?php echo $this->variables['txtSmtpServerError']; ?> <?php echo $this->variables['txtSmtpPortError']; ?>
				<span class="helpTxt"><?php echo $this->variables['msgHelpSMTPServer']; ?></span>
			</p>
			<p>
				<label for="smtpUsername"><?php echo SpoonFilter::ucfirst($this->variables['lblUsername']); ?></label>
				<?php echo $this->variables['txtSmtpUsername']; ?> <?php echo $this->variables['txtSmtpUsernameError']; ?>
			</p>
			<p>
				<label for="smtpPassword"><?php echo SpoonFilter::ucfirst($this->variables['lblPassword']); ?></label>
				<?php echo $this->variables['txtSmtpPassword']; ?> <?php echo $this->variables['txtSmtpPasswordError']; ?>
			</p>
			<p>
		   <label for="smtpSecureLayer"><?php echo SpoonFilter::ucfirst($this->variables['lblSmtpSecureLayer']); ?></label>
			   <?php echo $this->variables['ddmSmtpSecureLayer']; ?> 
			</p>
		</div>
	</div>
	<?php } ?>

	<div class="fullwidthOptions">
		<div class="buttonHolderRight">
			<input id="save" class="inputButton button mainButton" type="submit" name="save" value="<?php echo SpoonFilter::ucfirst($this->variables['lblSave']); ?>" />
		</div>
	</div>
</form>
				<?php } ?>

<?php
				ob_start();
				?><?php echo $this->variables['BACKEND_CORE_PATH']; ?>/Layout/Templates/StructureEndModule.tpl<?php
				$include = eval('return \'' . str_replace('\'', '\\\'', ob_get_clean()) .'\';');
				if($this->getForceCompile() || !file_exists($this->getCompileDirectory() .'/' . $this->getCompileName($include, '/home/anastosi/domains/anastosi.ru/public_html/src/Backend/Modules/Settings/Layout/Templates'))) $this->compile('/home/anastosi/domains/anastosi.ru/public_html/src/Backend/Modules/Settings/Layout/Templates', $include);
				$return = @include $this->getCompileDirectory() .'/' . $this->getCompileName($include, '/home/anastosi/domains/anastosi.ru/public_html/src/Backend/Modules/Settings/Layout/Templates');
				if($return === false && $this->compile('/home/anastosi/domains/anastosi.ru/public_html/src/Backend/Modules/Settings/Layout/Templates', $include))
				{
					$return = @include $this->getCompileDirectory() .'/' . $this->getCompileName($include, '/home/anastosi/domains/anastosi.ru/public_html/src/Backend/Modules/Settings/Layout/Templates');
				}
?>
<?php
				ob_start();
				?><?php echo $this->variables['BACKEND_CORE_PATH']; ?>/Layout/Templates/Footer.tpl<?php
				$include = eval('return \'' . str_replace('\'', '\\\'', ob_get_clean()) .'\';');
				if($this->getForceCompile() || !file_exists($this->getCompileDirectory() .'/' . $this->getCompileName($include, '/home/anastosi/domains/anastosi.ru/public_html/src/Backend/Modules/Settings/Layout/Templates'))) $this->compile('/home/anastosi/domains/anastosi.ru/public_html/src/Backend/Modules/Settings/Layout/Templates', $include);
				$return = @include $this->getCompileDirectory() .'/' . $this->getCompileName($include, '/home/anastosi/domains/anastosi.ru/public_html/src/Backend/Modules/Settings/Layout/Templates');
				if($return === false && $this->compile('/home/anastosi/domains/anastosi.ru/public_html/src/Backend/Modules/Settings/Layout/Templates', $include))
				{
					$return = @include $this->getCompileDirectory() .'/' . $this->getCompileName($include, '/home/anastosi/domains/anastosi.ru/public_html/src/Backend/Modules/Settings/Layout/Templates');
				}
?>
