<?php error_reporting(E_ALL | E_STRICT); ini_set('display_errors', 'On'); ?>
<?php
				ob_start();
				?><?php if(array_key_exists('BACKEND_CORE_PATH', (array) $this->variables)) { echo $this->variables['BACKEND_CORE_PATH']; } else { ?>{$BACKEND_CORE_PATH}<?php } ?>/Layout/Templates/Head.tpl<?php
				$include = eval('return \'' . str_replace('\'', '\\\'', ob_get_clean()) .'\';');
				if($this->getForceCompile() || !file_exists($this->getCompileDirectory() .'/' . $this->getCompileName($include, '/home/segaz/domains/techno-mir.net/public_html/src/Backend/Modules/Mailmotor/Layout/Templates'))) $this->compile('/home/segaz/domains/techno-mir.net/public_html/src/Backend/Modules/Mailmotor/Layout/Templates', $include);
				$return = @include $this->getCompileDirectory() .'/' . $this->getCompileName($include, '/home/segaz/domains/techno-mir.net/public_html/src/Backend/Modules/Mailmotor/Layout/Templates');
				if($return === false && $this->compile('/home/segaz/domains/techno-mir.net/public_html/src/Backend/Modules/Mailmotor/Layout/Templates', $include))
				{
					$return = @include $this->getCompileDirectory() .'/' . $this->getCompileName($include, '/home/segaz/domains/techno-mir.net/public_html/src/Backend/Modules/Mailmotor/Layout/Templates');
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
				if($this->getForceCompile() || !file_exists($this->getCompileDirectory() .'/' . $this->getCompileName($include, '/home/segaz/domains/techno-mir.net/public_html/src/Backend/Modules/Mailmotor/Layout/Templates'))) $this->compile('/home/segaz/domains/techno-mir.net/public_html/src/Backend/Modules/Mailmotor/Layout/Templates', $include);
				$return = @include $this->getCompileDirectory() .'/' . $this->getCompileName($include, '/home/segaz/domains/techno-mir.net/public_html/src/Backend/Modules/Mailmotor/Layout/Templates');
				if($return === false && $this->compile('/home/segaz/domains/techno-mir.net/public_html/src/Backend/Modules/Mailmotor/Layout/Templates', $include))
				{
					$return = @include $this->getCompileDirectory() .'/' . $this->getCompileName($include, '/home/segaz/domains/techno-mir.net/public_html/src/Backend/Modules/Mailmotor/Layout/Templates');
				}
if($return === false)
				{
					?>{include:<?php if(array_key_exists('BACKEND_CORE_PATH', (array) $this->variables)) { echo $this->variables['BACKEND_CORE_PATH']; } else { ?>{$BACKEND_CORE_PATH}<?php } ?>/Layout/Templates/StructureStartModule.tpl}<?php
				}
?>

<div class="pageTitle">
	<h2><?php if(array_key_exists('lblModuleSettings', (array) $this->variables)) { echo SpoonFilter::ucfirst($this->variables['lblModuleSettings']); } else { ?>{$lblModuleSettings|ucfirst}<?php } ?>: <?php if(array_key_exists('lblMailmotor', (array) $this->variables)) { echo SpoonFilter::ucfirst($this->variables['lblMailmotor']); } else { ?>{$lblMailmotor|ucfirst}<?php } ?></h2>
</div>

<?php if(!isset($this->variables['clientId']) || count($this->variables['clientId']) == 0 || $this->variables['clientId'] == '' || $this->variables['clientId'] === false): ?>
	<div class="generalMessage infoMessage content">
		<p><strong><?php if(array_key_exists('msgConfigurationError', (array) $this->variables)) { echo $this->variables['msgConfigurationError']; } else { ?>{$msgConfigurationError}<?php } ?></strong></p>
		<ul class="pb0">
			<?php if(!isset($this->variables['account']) || count($this->variables['account']) == 0 || $this->variables['account'] == '' || $this->variables['account'] === false): ?><li><?php if(array_key_exists('errNoCMAccount', (array) $this->variables)) { echo $this->variables['errNoCMAccount']; } else { ?>{$errNoCMAccount}<?php } ?></li><?php endif; ?>
			<?php
					if(isset($this->variables['account']) && count($this->variables['account']) != 0 && $this->variables['account'] != '' && $this->variables['account'] !== false)
					{
						?><li><?php if(array_key_exists('errNoCMClientID', (array) $this->variables)) { echo $this->variables['errNoCMClientID']; } else { ?>{$errNoCMClientID}<?php } ?></li><?php } ?>
		</ul>
	</div>
<?php endif; ?>

<div class="tabs">
	<ul>
		<li><a href="#tabSettingsGeneral"><?php if(array_key_exists('lblGeneral', (array) $this->variables)) { echo SpoonFilter::ucfirst($this->variables['lblGeneral']); } else { ?>{$lblGeneral|ucfirst}<?php } ?></a></li>
		<li><a href="#tabSettingsAccount">CampaignMonitor - <?php if(array_key_exists('lblAccountSettings', (array) $this->variables)) { echo SpoonFilter::ucfirst($this->variables['lblAccountSettings']); } else { ?>{$lblAccountSettings|ucfirst}<?php } ?></a></li>
		<?php
					if(isset($this->variables['account']) && count($this->variables['account']) != 0 && $this->variables['account'] != '' && $this->variables['account'] !== false)
					{
						?><li><a href="#tabSettingsClient">CampaignMonitor - <?php if(array_key_exists('lblClientSettings', (array) $this->variables)) { echo SpoonFilter::ucfirst($this->variables['lblClientSettings']); } else { ?>{$lblClientSettings|ucfirst}<?php } ?></a></li><?php } ?>
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
					<h3><?php if(array_key_exists('lblSender', (array) $this->variables)) { echo SpoonFilter::ucfirst($this->variables['lblSender']); } else { ?>{$lblSender|ucfirst}<?php } ?></h3>
				</div>

				<div class="options">
					<p>
						<label for="fromName"><?php if(array_key_exists('lblName', (array) $this->variables)) { echo SpoonFilter::ucfirst($this->variables['lblName']); } else { ?>{$lblName|ucfirst}<?php } ?><abbr title="<?php if(array_key_exists('lblRequiredField', (array) $this->variables)) { echo SpoonFilter::ucfirst($this->variables['lblRequiredField']); } else { ?>{$lblRequiredField|ucfirst}<?php } ?>">*</abbr></label>
						<?php if(array_key_exists('txtFromName', (array) $this->variables)) { echo $this->variables['txtFromName']; } else { ?>{$txtFromName}<?php } ?> <?php if(array_key_exists('txtFromNameError', (array) $this->variables)) { echo $this->variables['txtFromNameError']; } else { ?>{$txtFromNameError}<?php } ?>
					</p>

					<p>
						<label for="fromEmail"><?php if(array_key_exists('lblEmailAddress', (array) $this->variables)) { echo SpoonFilter::ucfirst($this->variables['lblEmailAddress']); } else { ?>{$lblEmailAddress|ucfirst}<?php } ?><abbr title="<?php if(array_key_exists('lblRequiredField', (array) $this->variables)) { echo SpoonFilter::ucfirst($this->variables['lblRequiredField']); } else { ?>{$lblRequiredField|ucfirst}<?php } ?>">*</abbr></label>
						<?php if(array_key_exists('txtFromEmail', (array) $this->variables)) { echo $this->variables['txtFromEmail']; } else { ?>{$txtFromEmail}<?php } ?> <?php if(array_key_exists('txtFromEmailError', (array) $this->variables)) { echo $this->variables['txtFromEmailError']; } else { ?>{$txtFromEmailError}<?php } ?>
					</p>
				</div>
			</div>

			<div class="box horizontal">
				<div class="heading">
					<h3><?php if(array_key_exists('lblReplyTo', (array) $this->variables)) { echo SpoonFilter::ucfirst($this->variables['lblReplyTo']); } else { ?>{$lblReplyTo|ucfirst}<?php } ?></h3>
				</div>

				<div class="options">
					<p>
						<label for="replyToEmail"><?php if(array_key_exists('lblEmailAddress', (array) $this->variables)) { echo SpoonFilter::ucfirst($this->variables['lblEmailAddress']); } else { ?>{$lblEmailAddress|ucfirst}<?php } ?><abbr title="<?php if(array_key_exists('lblRequiredField', (array) $this->variables)) { echo SpoonFilter::ucfirst($this->variables['lblRequiredField']); } else { ?>{$lblRequiredField|ucfirst}<?php } ?>">*</abbr></label>
						<?php if(array_key_exists('txtReplyToEmail', (array) $this->variables)) { echo $this->variables['txtReplyToEmail']; } else { ?>{$txtReplyToEmail}<?php } ?> <?php if(array_key_exists('txtReplyToEmailError', (array) $this->variables)) { echo $this->variables['txtReplyToEmailError']; } else { ?>{$txtReplyToEmailError}<?php } ?>
					</p>
				</div>
			</div>

			<div class="box">
				<div class="heading">
					<h3><?php if(array_key_exists('lblPlainTextVersion', (array) $this->variables)) { echo SpoonFilter::ucfirst($this->variables['lblPlainTextVersion']); } else { ?>{$lblPlainTextVersion|ucfirst}<?php } ?></h3>
				</div>

				<div class="options">
					<ul class="inputList p0">
						<li><?php if(array_key_exists('chkPlainTextEditable', (array) $this->variables)) { echo $this->variables['chkPlainTextEditable']; } else { ?>{$chkPlainTextEditable}<?php } ?> <label for="plainTextEditable"><?php if(array_key_exists('msgPlainTextEditable', (array) $this->variables)) { echo SpoonFilter::ucfirst($this->variables['msgPlainTextEditable']); } else { ?>{$msgPlainTextEditable|ucfirst}<?php } ?></label></li>
					</ul>
				</div>
			</div>

			<?php
					if(isset($this->variables['userIsGod']) && count($this->variables['userIsGod']) != 0 && $this->variables['userIsGod'] != '' && $this->variables['userIsGod'] !== false)
					{
						?>
			<div class="box horizontal">
				<div class="heading">
					<h3><?php if(array_key_exists('lblPrices', (array) $this->variables)) { echo SpoonFilter::ucfirst($this->variables['lblPrices']); } else { ?>{$lblPrices|ucfirst}<?php } ?></h3>
				</div>

				<div class="options">
					<p>
						<label for="pricePerEmail"><?php if(array_key_exists('lblPerSentMailing', (array) $this->variables)) { echo SpoonFilter::ucfirst($this->variables['lblPerSentMailing']); } else { ?>{$lblPerSentMailing|ucfirst}<?php } ?><abbr title="<?php if(array_key_exists('lblRequiredField', (array) $this->variables)) { echo SpoonFilter::ucfirst($this->variables['lblRequiredField']); } else { ?>{$lblRequiredField|ucfirst}<?php } ?>">*</abbr></label>
						€ <?php if(array_key_exists('txtPricePerEmail', (array) $this->variables)) { echo $this->variables['txtPricePerEmail']; } else { ?>{$txtPricePerEmail}<?php } ?> <?php if(array_key_exists('txtPricePerEmailError', (array) $this->variables)) { echo $this->variables['txtPricePerEmailError']; } else { ?>{$txtPricePerEmailError}<?php } ?>
						<span class="helpTxt"><?php if(array_key_exists('msgHelpPrice', (array) $this->variables)) { echo $this->variables['msgHelpPrice']; } else { ?>{$msgHelpPrice}<?php } ?></span>
					</p>
					<p>
						<label for="pricePerEmail"><?php if(array_key_exists('lblPerCampaign', (array) $this->variables)) { echo SpoonFilter::ucfirst($this->variables['lblPerCampaign']); } else { ?>{$lblPerCampaign|ucfirst}<?php } ?><abbr title="<?php if(array_key_exists('lblRequiredField', (array) $this->variables)) { echo SpoonFilter::ucfirst($this->variables['lblRequiredField']); } else { ?>{$lblRequiredField|ucfirst}<?php } ?>">*</abbr></label>
						€ <?php if(array_key_exists('txtPricePerCampaign', (array) $this->variables)) { echo $this->variables['txtPricePerCampaign']; } else { ?>{$txtPricePerCampaign}<?php } ?> <?php if(array_key_exists('txtPricePerCampaignError', (array) $this->variables)) { echo $this->variables['txtPricePerCampaignError']; } else { ?>{$txtPricePerCampaignError}<?php } ?>
						<span class="helpTxt"><?php if(array_key_exists('msgHelpPrice', (array) $this->variables)) { echo $this->variables['msgHelpPrice']; } else { ?>{$msgHelpPrice}<?php } ?></span>
					</p>
				</div>
			</div>
			<?php } ?>

			<div class="fullwidthOptions">
				<div class="buttonHolderRight">
					<input id="save" class="inputButton button mainButton" type="submit" name="save" value="<?php if(array_key_exists('lblSave', (array) $this->variables)) { echo SpoonFilter::ucfirst($this->variables['lblSave']); } else { ?>{$lblSave|ucfirst}<?php } ?>" />
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
					<label for="url"><?php if(array_key_exists('lblURL', (array) $this->variables)) { echo SpoonTemplateModifiers::uppercase($this->variables['lblURL']); } else { ?>{$lblURL|uppercase}<?php } ?><abbr title="<?php if(array_key_exists('lblRequiredField', (array) $this->variables)) { echo SpoonFilter::ucfirst($this->variables['lblRequiredField']); } else { ?>{$lblRequiredField|ucfirst}<?php } ?>">*</abbr></label>
					<?php if(array_key_exists('txtUrl', (array) $this->variables)) { echo $this->variables['txtUrl']; } else { ?>{$txtUrl}<?php } ?> <?php if(array_key_exists('txtUrlError', (array) $this->variables)) { echo $this->variables['txtUrlError']; } else { ?>{$txtUrlError}<?php } ?>
					<span class="helpTxt"><?php if(array_key_exists('msgHelpCMURL', (array) $this->variables)) { echo $this->variables['msgHelpCMURL']; } else { ?>{$msgHelpCMURL}<?php } ?></span>
				</p>
				<p>
					<label for="username"><?php if(array_key_exists('lblUsername', (array) $this->variables)) { echo SpoonFilter::ucfirst($this->variables['lblUsername']); } else { ?>{$lblUsername|ucfirst}<?php } ?><abbr title="<?php if(array_key_exists('lblRequiredField', (array) $this->variables)) { echo SpoonFilter::ucfirst($this->variables['lblRequiredField']); } else { ?>{$lblRequiredField|ucfirst}<?php } ?>">*</abbr></label>
					<?php if(array_key_exists('txtUsername', (array) $this->variables)) { echo $this->variables['txtUsername']; } else { ?>{$txtUsername}<?php } ?> <?php if(array_key_exists('txtUsernameError', (array) $this->variables)) { echo $this->variables['txtUsernameError']; } else { ?>{$txtUsernameError}<?php } ?>
				</p>
				<p>
					<label for="password"><?php if(array_key_exists('lblPassword', (array) $this->variables)) { echo SpoonFilter::ucfirst($this->variables['lblPassword']); } else { ?>{$lblPassword|ucfirst}<?php } ?><abbr title="<?php if(array_key_exists('lblRequiredField', (array) $this->variables)) { echo SpoonFilter::ucfirst($this->variables['lblRequiredField']); } else { ?>{$lblRequiredField|ucfirst}<?php } ?>">*</abbr></label>
					<?php if(array_key_exists('txtPassword', (array) $this->variables)) { echo $this->variables['txtPassword']; } else { ?>{$txtPassword}<?php } ?> <?php if(array_key_exists('txtPasswordError', (array) $this->variables)) { echo $this->variables['txtPasswordError']; } else { ?>{$txtPasswordError}<?php } ?>
				</p>
				<div class="buttonHolder">
					<?php if(!isset($this->variables['account']) || count($this->variables['account']) == 0 || $this->variables['account'] == '' || $this->variables['account'] === false): ?><a id="linkAccount" href="#" class="askConfirmation button inputButton"><span><?php if(array_key_exists('msgLinkCMAccount', (array) $this->variables)) { echo $this->variables['msgLinkCMAccount']; } else { ?>{$msgLinkCMAccount}<?php } ?></span></a><?php endif; ?>
					<?php
					if(isset($this->variables['account']) && count($this->variables['account']) != 0 && $this->variables['account'] != '' && $this->variables['account'] !== false)
					{
						?>
					<a id="unlinkAccount" href="#" class="askConfirmation submitButton button inputButton"><span><?php if(array_key_exists('msgUnlinkCMAccount', (array) $this->variables)) { echo $this->variables['msgUnlinkCMAccount']; } else { ?>{$msgUnlinkCMAccount}<?php } ?></span></a>
					<?php
					if(isset($this->variables['clientId']) && count($this->variables['clientId']) != 0 && $this->variables['clientId'] != '' && $this->variables['clientId'] !== false)
					{
						?><a href="<?php if(array_key_exists('var', (array) $this->variables)) { echo Backend\Core\Engine\TemplateModifiers::getURL($this->variables['var'], 'index'); } else { ?>{$var|geturl:'index'}<?php } ?>" class="mainButton button"><span><?php if(array_key_exists('msgViewMailings', (array) $this->variables)) { echo $this->variables['msgViewMailings']; } else { ?>{$msgViewMailings}<?php } ?></span></a><?php } ?>
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
					<label for="clientId"><?php if(array_key_exists('lblClient', (array) $this->variables)) { echo SpoonFilter::ucfirst($this->variables['lblClient']); } else { ?>{$lblClient|ucfirst}<?php } ?></label>
					<?php if(array_key_exists('ddmClientId', (array) $this->variables)) { echo $this->variables['ddmClientId']; } else { ?>{$ddmClientId}<?php } ?>
				</p>
				<?php if(!isset($this->variables['clientId']) || count($this->variables['clientId']) == 0 || $this->variables['clientId'] == '' || $this->variables['clientId'] === false): ?><p class="formError"><strong><?php if(array_key_exists('msgNoClientID', (array) $this->variables)) { echo $this->variables['msgNoClientID']; } else { ?>{$msgNoClientID}<?php } ?></strong></p><?php endif; ?>
			</div>

			<div class="options generate">
				<p>
					<label for="companyName"><?php if(array_key_exists('lblCompanyName', (array) $this->variables)) { echo SpoonFilter::ucfirst($this->variables['lblCompanyName']); } else { ?>{$lblCompanyName|ucfirst}<?php } ?><abbr title="<?php if(array_key_exists('lblRequiredField', (array) $this->variables)) { echo SpoonFilter::ucfirst($this->variables['lblRequiredField']); } else { ?>{$lblRequiredField|ucfirst}<?php } ?>">*</abbr></label>
					<?php if(array_key_exists('txtCompanyName', (array) $this->variables)) { echo $this->variables['txtCompanyName']; } else { ?>{$txtCompanyName}<?php } ?> <?php if(array_key_exists('txtCompanyNameError', (array) $this->variables)) { echo $this->variables['txtCompanyNameError']; } else { ?>{$txtCompanyNameError}<?php } ?>
				</p>
				<p>
					<label for="countries"><?php if(array_key_exists('lblCountry', (array) $this->variables)) { echo SpoonFilter::ucfirst($this->variables['lblCountry']); } else { ?>{$lblCountry|ucfirst}<?php } ?></label>
					<?php if(array_key_exists('ddmCountries', (array) $this->variables)) { echo $this->variables['ddmCountries']; } else { ?>{$ddmCountries}<?php } ?> <?php if(array_key_exists('ddmCountriesError', (array) $this->variables)) { echo $this->variables['ddmCountriesError']; } else { ?>{$ddmCountriesError}<?php } ?>
				</p>
				<p>
					<label for="timezones"><?php if(array_key_exists('lblTimezone', (array) $this->variables)) { echo SpoonFilter::ucfirst($this->variables['lblTimezone']); } else { ?>{$lblTimezone|ucfirst}<?php } ?></label>
					<?php if(array_key_exists('ddmTimezones', (array) $this->variables)) { echo $this->variables['ddmTimezones']; } else { ?>{$ddmTimezones}<?php } ?> <?php if(array_key_exists('ddmTimezonesError', (array) $this->variables)) { echo $this->variables['ddmTimezonesError']; } else { ?>{$ddmTimezonesError}<?php } ?>
				</p>
			</div>

			<div class="fullwidthOptions">
				<div class="buttonHolderRight">
					<input id="save" class="inputButton button mainButton" type="submit" name="save" value="<?php if(array_key_exists('lblSave', (array) $this->variables)) { echo SpoonFilter::ucfirst($this->variables['lblSave']); } else { ?>{$lblSave|ucfirst}<?php } ?>" />
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
				?><?php if(array_key_exists('BACKEND_CORE_PATH', (array) $this->variables)) { echo $this->variables['BACKEND_CORE_PATH']; } else { ?>{$BACKEND_CORE_PATH}<?php } ?>/Layout/Templates/StructureEndModule.tpl<?php
				$include = eval('return \'' . str_replace('\'', '\\\'', ob_get_clean()) .'\';');
				if($this->getForceCompile() || !file_exists($this->getCompileDirectory() .'/' . $this->getCompileName($include, '/home/segaz/domains/techno-mir.net/public_html/src/Backend/Modules/Mailmotor/Layout/Templates'))) $this->compile('/home/segaz/domains/techno-mir.net/public_html/src/Backend/Modules/Mailmotor/Layout/Templates', $include);
				$return = @include $this->getCompileDirectory() .'/' . $this->getCompileName($include, '/home/segaz/domains/techno-mir.net/public_html/src/Backend/Modules/Mailmotor/Layout/Templates');
				if($return === false && $this->compile('/home/segaz/domains/techno-mir.net/public_html/src/Backend/Modules/Mailmotor/Layout/Templates', $include))
				{
					$return = @include $this->getCompileDirectory() .'/' . $this->getCompileName($include, '/home/segaz/domains/techno-mir.net/public_html/src/Backend/Modules/Mailmotor/Layout/Templates');
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
				if($this->getForceCompile() || !file_exists($this->getCompileDirectory() .'/' . $this->getCompileName($include, '/home/segaz/domains/techno-mir.net/public_html/src/Backend/Modules/Mailmotor/Layout/Templates'))) $this->compile('/home/segaz/domains/techno-mir.net/public_html/src/Backend/Modules/Mailmotor/Layout/Templates', $include);
				$return = @include $this->getCompileDirectory() .'/' . $this->getCompileName($include, '/home/segaz/domains/techno-mir.net/public_html/src/Backend/Modules/Mailmotor/Layout/Templates');
				if($return === false && $this->compile('/home/segaz/domains/techno-mir.net/public_html/src/Backend/Modules/Mailmotor/Layout/Templates', $include))
				{
					$return = @include $this->getCompileDirectory() .'/' . $this->getCompileName($include, '/home/segaz/domains/techno-mir.net/public_html/src/Backend/Modules/Mailmotor/Layout/Templates');
				}
if($return === false)
				{
					?>{include:<?php if(array_key_exists('BACKEND_CORE_PATH', (array) $this->variables)) { echo $this->variables['BACKEND_CORE_PATH']; } else { ?>{$BACKEND_CORE_PATH}<?php } ?>/Layout/Templates/Footer.tpl}<?php
				}
?>
