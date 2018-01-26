<?php error_reporting(0); ini_set('display_errors', 'Off'); ?>
<?php
				ob_start();
				?><?php echo $this->variables['BACKEND_CORE_PATH']; ?>/Layout/Templates/Head.tpl<?php
				$include = eval('return \'' . str_replace('\'', '\\\'', ob_get_clean()) .'\';');
				if($this->getForceCompile() || !file_exists($this->getCompileDirectory() .'/' . $this->getCompileName($include, '/home/anastosi/domains/anastosi.ru/public_html/src/Backend/Modules/Mailmotor/Layout/Templates'))) $this->compile('/home/anastosi/domains/anastosi.ru/public_html/src/Backend/Modules/Mailmotor/Layout/Templates', $include);
				$return = @include $this->getCompileDirectory() .'/' . $this->getCompileName($include, '/home/anastosi/domains/anastosi.ru/public_html/src/Backend/Modules/Mailmotor/Layout/Templates');
				if($return === false && $this->compile('/home/anastosi/domains/anastosi.ru/public_html/src/Backend/Modules/Mailmotor/Layout/Templates', $include))
				{
					$return = @include $this->getCompileDirectory() .'/' . $this->getCompileName($include, '/home/anastosi/domains/anastosi.ru/public_html/src/Backend/Modules/Mailmotor/Layout/Templates');
				}
?>
<?php
				ob_start();
				?><?php echo $this->variables['BACKEND_CORE_PATH']; ?>/Layout/Templates/StructureStartModule.tpl<?php
				$include = eval('return \'' . str_replace('\'', '\\\'', ob_get_clean()) .'\';');
				if($this->getForceCompile() || !file_exists($this->getCompileDirectory() .'/' . $this->getCompileName($include, '/home/anastosi/domains/anastosi.ru/public_html/src/Backend/Modules/Mailmotor/Layout/Templates'))) $this->compile('/home/anastosi/domains/anastosi.ru/public_html/src/Backend/Modules/Mailmotor/Layout/Templates', $include);
				$return = @include $this->getCompileDirectory() .'/' . $this->getCompileName($include, '/home/anastosi/domains/anastosi.ru/public_html/src/Backend/Modules/Mailmotor/Layout/Templates');
				if($return === false && $this->compile('/home/anastosi/domains/anastosi.ru/public_html/src/Backend/Modules/Mailmotor/Layout/Templates', $include))
				{
					$return = @include $this->getCompileDirectory() .'/' . $this->getCompileName($include, '/home/anastosi/domains/anastosi.ru/public_html/src/Backend/Modules/Mailmotor/Layout/Templates');
				}
?>

<div class="pageTitle">
	<h2><?php echo SpoonFilter::ucfirst($this->variables['lblModuleSettings']); ?>: <?php echo SpoonFilter::ucfirst($this->variables['lblMailmotor']); ?></h2>
</div>

<?php if(!isset($this->variables['clientId']) || count($this->variables['clientId']) == 0 || $this->variables['clientId'] == '' || $this->variables['clientId'] === false): ?>
	<div class="generalMessage infoMessage content">
		<p><strong><?php echo $this->variables['msgConfigurationError']; ?></strong></p>
		<ul class="pb0">
			<?php if(!isset($this->variables['account']) || count($this->variables['account']) == 0 || $this->variables['account'] == '' || $this->variables['account'] === false): ?><li><?php echo $this->variables['errNoCMAccount']; ?></li><?php endif; ?>
			<?php
					if(isset($this->variables['account']) && count($this->variables['account']) != 0 && $this->variables['account'] != '' && $this->variables['account'] !== false)
					{
						?><li><?php echo $this->variables['errNoCMClientID']; ?></li><?php } ?>
		</ul>
	</div>
<?php endif; ?>

<div class="tabs">
	<ul>
		<li><a href="#tabSettingsGeneral"><?php echo SpoonFilter::ucfirst($this->variables['lblGeneral']); ?></a></li>
		<li><a href="#tabSettingsAccount">CampaignMonitor - <?php echo SpoonFilter::ucfirst($this->variables['lblAccountSettings']); ?></a></li>
		<?php
					if(isset($this->variables['account']) && count($this->variables['account']) != 0 && $this->variables['account'] != '' && $this->variables['account'] !== false)
					{
						?><li><a href="#tabSettingsClient">CampaignMonitor - <?php echo SpoonFilter::ucfirst($this->variables['lblClientSettings']); ?></a></li><?php } ?>
	</ul>

	<div id="tabSettingsGeneral">
		<?php
					if(isset($this->forms['settingsGeneral']))
					{
						?><form accept-charset="UTF-8" action="<?php echo $this->forms['settingsGeneral']->getAction(); ?>" method="<?php echo $this->forms['settingsGeneral']->getMethod(); ?>"<?php echo $this->forms['settingsGeneral']->getParametersHTML(); ?>>
						<?php echo $this->forms['settingsGeneral']->getField('form')->parse();
						if($this->forms['settingsGeneral']->getUseToken())
						{
							?><input type="hidden" name="form_token" id="<?php echo $this->forms['settingsGeneral']->getField('form_token')->getAttribute('id'); ?>" value="<?php echo htmlspecialchars($this->forms['settingsGeneral']->getField('form_token')->getValue()); ?>" />
						<?php } ?>
		<div id="general">
			<div class="box horizontal">
				<div class="heading">
					<h3><?php echo SpoonFilter::ucfirst($this->variables['lblSender']); ?></h3>
				</div>

				<div class="options">
					<p>
						<label for="fromName"><?php echo SpoonFilter::ucfirst($this->variables['lblName']); ?><abbr title="<?php echo SpoonFilter::ucfirst($this->variables['lblRequiredField']); ?>">*</abbr></label>
						<?php echo $this->variables['txtFromName']; ?> <?php echo $this->variables['txtFromNameError']; ?>
					</p>

					<p>
						<label for="fromEmail"><?php echo SpoonFilter::ucfirst($this->variables['lblEmailAddress']); ?><abbr title="<?php echo SpoonFilter::ucfirst($this->variables['lblRequiredField']); ?>">*</abbr></label>
						<?php echo $this->variables['txtFromEmail']; ?> <?php echo $this->variables['txtFromEmailError']; ?>
					</p>
				</div>
			</div>

			<div class="box horizontal">
				<div class="heading">
					<h3><?php echo SpoonFilter::ucfirst($this->variables['lblReplyTo']); ?></h3>
				</div>

				<div class="options">
					<p>
						<label for="replyToEmail"><?php echo SpoonFilter::ucfirst($this->variables['lblEmailAddress']); ?><abbr title="<?php echo SpoonFilter::ucfirst($this->variables['lblRequiredField']); ?>">*</abbr></label>
						<?php echo $this->variables['txtReplyToEmail']; ?> <?php echo $this->variables['txtReplyToEmailError']; ?>
					</p>
				</div>
			</div>

			<div class="box">
				<div class="heading">
					<h3><?php echo SpoonFilter::ucfirst($this->variables['lblPlainTextVersion']); ?></h3>
				</div>

				<div class="options">
					<ul class="inputList p0">
						<li><?php echo $this->variables['chkPlainTextEditable']; ?> <label for="plainTextEditable"><?php echo SpoonFilter::ucfirst($this->variables['msgPlainTextEditable']); ?></label></li>
					</ul>
				</div>
			</div>

			<?php
					if(isset($this->variables['userIsGod']) && count($this->variables['userIsGod']) != 0 && $this->variables['userIsGod'] != '' && $this->variables['userIsGod'] !== false)
					{
						?>
			<div class="box horizontal">
				<div class="heading">
					<h3><?php echo SpoonFilter::ucfirst($this->variables['lblPrices']); ?></h3>
				</div>

				<div class="options">
					<p>
						<label for="pricePerEmail"><?php echo SpoonFilter::ucfirst($this->variables['lblPerSentMailing']); ?><abbr title="<?php echo SpoonFilter::ucfirst($this->variables['lblRequiredField']); ?>">*</abbr></label>
						€ <?php echo $this->variables['txtPricePerEmail']; ?> <?php echo $this->variables['txtPricePerEmailError']; ?>
						<span class="helpTxt"><?php echo $this->variables['msgHelpPrice']; ?></span>
					</p>
					<p>
						<label for="pricePerEmail"><?php echo SpoonFilter::ucfirst($this->variables['lblPerCampaign']); ?><abbr title="<?php echo SpoonFilter::ucfirst($this->variables['lblRequiredField']); ?>">*</abbr></label>
						€ <?php echo $this->variables['txtPricePerCampaign']; ?> <?php echo $this->variables['txtPricePerCampaignError']; ?>
						<span class="helpTxt"><?php echo $this->variables['msgHelpPrice']; ?></span>
					</p>
				</div>
			</div>
			<?php } ?>

			<div class="fullwidthOptions">
				<div class="buttonHolderRight">
					<input id="save" class="inputButton button mainButton" type="submit" name="save" value="<?php echo SpoonFilter::ucfirst($this->variables['lblSave']); ?>" />
				</div>
			</div>
		</div>
		</form>
				<?php } ?>
	</div>

	<div id="tabSettingsAccount">
		<?php
					if(isset($this->forms['settingsAccount']))
					{
						?><form accept-charset="UTF-8" action="<?php echo $this->forms['settingsAccount']->getAction(); ?>" method="<?php echo $this->forms['settingsAccount']->getMethod(); ?>"<?php echo $this->forms['settingsAccount']->getParametersHTML(); ?>>
						<?php echo $this->forms['settingsAccount']->getField('form')->parse();
						if($this->forms['settingsAccount']->getUseToken())
						{
							?><input type="hidden" name="form_token" id="<?php echo $this->forms['settingsAccount']->getField('form_token')->getAttribute('id'); ?>" value="<?php echo htmlspecialchars($this->forms['settingsAccount']->getField('form_token')->getValue()); ?>" />
						<?php } ?>
		<div class="box horizontal" id="accountBox">
			<div class="heading">
				<h3>CampaignMonitor - Account</h3>
			</div>
			<div class="options">
				<p>
					<label for="url"><?php echo SpoonTemplateModifiers::uppercase($this->variables['lblURL']); ?><abbr title="<?php echo SpoonFilter::ucfirst($this->variables['lblRequiredField']); ?>">*</abbr></label>
					<?php echo $this->variables['txtUrl']; ?> <?php echo $this->variables['txtUrlError']; ?>
					<span class="helpTxt"><?php echo $this->variables['msgHelpCMURL']; ?></span>
				</p>
				<p>
					<label for="username"><?php echo SpoonFilter::ucfirst($this->variables['lblUsername']); ?><abbr title="<?php echo SpoonFilter::ucfirst($this->variables['lblRequiredField']); ?>">*</abbr></label>
					<?php echo $this->variables['txtUsername']; ?> <?php echo $this->variables['txtUsernameError']; ?>
				</p>
				<p>
					<label for="password"><?php echo SpoonFilter::ucfirst($this->variables['lblPassword']); ?><abbr title="<?php echo SpoonFilter::ucfirst($this->variables['lblRequiredField']); ?>">*</abbr></label>
					<?php echo $this->variables['txtPassword']; ?> <?php echo $this->variables['txtPasswordError']; ?>
				</p>
				<div class="buttonHolder">
					<?php if(!isset($this->variables['account']) || count($this->variables['account']) == 0 || $this->variables['account'] == '' || $this->variables['account'] === false): ?><a id="linkAccount" href="#" class="askConfirmation button inputButton"><span><?php echo $this->variables['msgLinkCMAccount']; ?></span></a><?php endif; ?>
					<?php
					if(isset($this->variables['account']) && count($this->variables['account']) != 0 && $this->variables['account'] != '' && $this->variables['account'] !== false)
					{
						?>
					<a id="unlinkAccount" href="#" class="askConfirmation submitButton button inputButton"><span><?php echo $this->variables['msgUnlinkCMAccount']; ?></span></a>
					<?php
					if(isset($this->variables['clientId']) && count($this->variables['clientId']) != 0 && $this->variables['clientId'] != '' && $this->variables['clientId'] !== false)
					{
						?><a href="<?php echo Backend\Core\Engine\TemplateModifiers::getURL($this->variables['var'], 'index'); ?>" class="mainButton button"><span><?php echo $this->variables['msgViewMailings']; ?></span></a><?php } ?>
					<?php } ?>
				</div>
			</div>
		</div>
		</form>
				<?php } ?>
	</div>

	<?php
					if(isset($this->variables['account']) && count($this->variables['account']) != 0 && $this->variables['account'] != '' && $this->variables['account'] !== false)
					{
						?>
	<div id="tabSettingsClient">
		<?php
					if(isset($this->forms['settingsClient']))
					{
						?><form accept-charset="UTF-8" action="<?php echo $this->forms['settingsClient']->getAction(); ?>" method="<?php echo $this->forms['settingsClient']->getMethod(); ?>"<?php echo $this->forms['settingsClient']->getParametersHTML(); ?>>
						<?php echo $this->forms['settingsClient']->getField('form')->parse();
						if($this->forms['settingsClient']->getUseToken())
						{
							?><input type="hidden" name="form_token" id="<?php echo $this->forms['settingsClient']->getField('form_token')->getAttribute('id'); ?>" value="<?php echo htmlspecialchars($this->forms['settingsClient']->getField('form_token')->getValue()); ?>" />
						<?php } ?>
		<div class="box horizontal">
			<div class="heading">
				<h3>CampaignMonitor - Client</h3>
			</div>
			<div class="options id">
				<p>
					<label for="clientId"><?php echo SpoonFilter::ucfirst($this->variables['lblClient']); ?></label>
					<?php echo $this->variables['ddmClientId']; ?>
				</p>
				<?php if(!isset($this->variables['clientId']) || count($this->variables['clientId']) == 0 || $this->variables['clientId'] == '' || $this->variables['clientId'] === false): ?><p class="formError"><strong><?php echo $this->variables['msgNoClientID']; ?></strong></p><?php endif; ?>
			</div>

			<div class="options generate">
				<p>
					<label for="companyName"><?php echo SpoonFilter::ucfirst($this->variables['lblCompanyName']); ?><abbr title="<?php echo SpoonFilter::ucfirst($this->variables['lblRequiredField']); ?>">*</abbr></label>
					<?php echo $this->variables['txtCompanyName']; ?> <?php echo $this->variables['txtCompanyNameError']; ?>
				</p>
				<p>
					<label for="countries"><?php echo SpoonFilter::ucfirst($this->variables['lblCountry']); ?></label>
					<?php echo $this->variables['ddmCountries']; ?> <?php echo $this->variables['ddmCountriesError']; ?>
				</p>
				<p>
					<label for="timezones"><?php echo SpoonFilter::ucfirst($this->variables['lblTimezone']); ?></label>
					<?php echo $this->variables['ddmTimezones']; ?> <?php echo $this->variables['ddmTimezonesError']; ?>
				</p>
			</div>

			<div class="fullwidthOptions">
				<div class="buttonHolderRight">
					<input id="save" class="inputButton button mainButton" type="submit" name="save" value="<?php echo SpoonFilter::ucfirst($this->variables['lblSave']); ?>" />
				</div>
			</div>
		</div>
		</form>
				<?php } ?>
	</div>
	<?php } ?>
</div>

<?php
				ob_start();
				?><?php echo $this->variables['BACKEND_CORE_PATH']; ?>/Layout/Templates/StructureEndModule.tpl<?php
				$include = eval('return \'' . str_replace('\'', '\\\'', ob_get_clean()) .'\';');
				if($this->getForceCompile() || !file_exists($this->getCompileDirectory() .'/' . $this->getCompileName($include, '/home/anastosi/domains/anastosi.ru/public_html/src/Backend/Modules/Mailmotor/Layout/Templates'))) $this->compile('/home/anastosi/domains/anastosi.ru/public_html/src/Backend/Modules/Mailmotor/Layout/Templates', $include);
				$return = @include $this->getCompileDirectory() .'/' . $this->getCompileName($include, '/home/anastosi/domains/anastosi.ru/public_html/src/Backend/Modules/Mailmotor/Layout/Templates');
				if($return === false && $this->compile('/home/anastosi/domains/anastosi.ru/public_html/src/Backend/Modules/Mailmotor/Layout/Templates', $include))
				{
					$return = @include $this->getCompileDirectory() .'/' . $this->getCompileName($include, '/home/anastosi/domains/anastosi.ru/public_html/src/Backend/Modules/Mailmotor/Layout/Templates');
				}
?>
<?php
				ob_start();
				?><?php echo $this->variables['BACKEND_CORE_PATH']; ?>/Layout/Templates/Footer.tpl<?php
				$include = eval('return \'' . str_replace('\'', '\\\'', ob_get_clean()) .'\';');
				if($this->getForceCompile() || !file_exists($this->getCompileDirectory() .'/' . $this->getCompileName($include, '/home/anastosi/domains/anastosi.ru/public_html/src/Backend/Modules/Mailmotor/Layout/Templates'))) $this->compile('/home/anastosi/domains/anastosi.ru/public_html/src/Backend/Modules/Mailmotor/Layout/Templates', $include);
				$return = @include $this->getCompileDirectory() .'/' . $this->getCompileName($include, '/home/anastosi/domains/anastosi.ru/public_html/src/Backend/Modules/Mailmotor/Layout/Templates');
				if($return === false && $this->compile('/home/anastosi/domains/anastosi.ru/public_html/src/Backend/Modules/Mailmotor/Layout/Templates', $include))
				{
					$return = @include $this->getCompileDirectory() .'/' . $this->getCompileName($include, '/home/anastosi/domains/anastosi.ru/public_html/src/Backend/Modules/Mailmotor/Layout/Templates');
				}
?>
