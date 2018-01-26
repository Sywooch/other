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
					if(isset($this->forms['settingsIndex']))
					{
						?><form accept-charset="UTF-8" action="<?php echo $this->forms['settingsIndex']->getAction(); ?>" method="<?php echo $this->forms['settingsIndex']->getMethod(); ?>"<?php echo $this->forms['settingsIndex']->getParametersHTML(); ?>>
						<?php echo $this->forms['settingsIndex']->getField('form')->parse();
						if($this->forms['settingsIndex']->getUseToken())
						{
							?><input type="hidden" name="form_token" id="<?php echo $this->forms['settingsIndex']->getField('form_token')->getAttribute('id'); ?>" value="<?php echo htmlspecialchars($this->forms['settingsIndex']->getField('form_token')->getValue()); ?>" />
						<?php } ?>
	<?php
					if(isset($this->variables['warnings']) && count($this->variables['warnings']) != 0 && $this->variables['warnings'] != '' && $this->variables['warnings'] !== false)
					{
						?>
		<div class="generalMessage infoMessage content">
			<p><strong><?php echo $this->variables['msgConfigurationError']; ?></strong></p>
			<ul class="pb0">
				<?php
				if(isset(${'warnings'})) $this->iterations['f2a895cb0e9d0b3f69867d8ef30bff0e_Index.tpl.php_1']['old'] = ${'warnings'};
				$this->iterations['f2a895cb0e9d0b3f69867d8ef30bff0e_Index.tpl.php_1']['iteration'] = $this->variables['warnings'];
				$this->iterations['f2a895cb0e9d0b3f69867d8ef30bff0e_Index.tpl.php_1']['i'] = 1;
				$this->iterations['f2a895cb0e9d0b3f69867d8ef30bff0e_Index.tpl.php_1']['count'] = count($this->iterations['f2a895cb0e9d0b3f69867d8ef30bff0e_Index.tpl.php_1']['iteration']);
				foreach((array) $this->iterations['f2a895cb0e9d0b3f69867d8ef30bff0e_Index.tpl.php_1']['iteration'] as ${'warnings'})
				{
					if(!isset(${'warnings'}['first']) && $this->iterations['f2a895cb0e9d0b3f69867d8ef30bff0e_Index.tpl.php_1']['i'] == 1) ${'warnings'}['first'] = true;
					if(!isset(${'warnings'}['last']) && $this->iterations['f2a895cb0e9d0b3f69867d8ef30bff0e_Index.tpl.php_1']['i'] == $this->iterations['f2a895cb0e9d0b3f69867d8ef30bff0e_Index.tpl.php_1']['count']) ${'warnings'}['last'] = true;
					if(isset(${'warnings'}['formElements']) && is_array(${'warnings'}['formElements']))
					{
						foreach(${'warnings'}['formElements'] as $name => $object)
						{
							${'warnings'}[$name] = $object->parse();
							${'warnings'}[$name .'Error'] = (is_callable(array($object, 'getErrors')) && $object->getErrors() != '') ? '<span class="formError">' . $object->getErrors() .'</span>' : '';
						}
					} ?>
					<li><?php echo ${'warnings'}['message']; ?></li>
				<?php
					$this->iterations['f2a895cb0e9d0b3f69867d8ef30bff0e_Index.tpl.php_1']['i']++;
				}
				if(isset($this->iterations['f2a895cb0e9d0b3f69867d8ef30bff0e_Index.tpl.php_1']['old'])) ${'warnings'} = $this->iterations['f2a895cb0e9d0b3f69867d8ef30bff0e_Index.tpl.php_1']['old'];
				else unset($this->iterations['f2a895cb0e9d0b3f69867d8ef30bff0e_Index.tpl.php_1']);
				?>
			</ul>
		</div>
	<?php } ?>

	<div class="box">
		<div class="heading">
			<h3>
				<label for="siteTitle"><?php echo SpoonFilter::ucfirst($this->variables['lblWebsiteTitle']); ?><abbr title="<?php echo $this->variables['lblRequiredField']; ?>">*</abbr></label>
			</h3>
		</div>
		<div class="options">
			<?php echo $this->variables['txtSiteTitle']; ?> <?php echo $this->variables['txtSiteTitleError']; ?>
		</div>
	</div>

	<div class="box">
		<div class="heading">
			<h3><?php echo SpoonFilter::ucfirst($this->variables['lblScripts']); ?></h3>
		</div>
		<div class="options">
			<div class="textareaHolder">
				<p class="p0"><label for="siteHtmlHeader"><code>&lt;head&gt;</code> script(s)</label></p>
				<?php echo $this->variables['txtSiteHtmlHeader']; ?> <?php echo $this->variables['txtSiteHtmlHeaderError']; ?>
				<span class="helpTxt"><?php echo $this->variables['msgHelpScriptsHead']; ?></span>
			</div>
		</div>
		<div class="options">
			<div class="textareaHolder">
				<p class="p0"><label for="siteHtmlFooter">End of <code>&lt;body&gt;</code> script(s)</label></p>
				<?php echo $this->variables['txtSiteHtmlFooter']; ?> <?php echo $this->variables['txtSiteHtmlFooterError']; ?>
				<span class="helpTxt"><?php echo $this->variables['msgHelpScriptsFoot']; ?></span>
			</div>
		</div>
	</div>

	<div class="box">
		<div class="heading">
			<h3><?php echo SpoonFilter::ucfirst($this->variables['lblLanguages']); ?></h3>
		</div>
		<div class="options">
			<p><?php echo $this->variables['msgHelpLanguages']; ?></p>
			<ul id="activeLanguages" class="inputList pb0">
				<?php
				if(isset(${'activeLanguages'})) $this->iterations['f2a895cb0e9d0b3f69867d8ef30bff0e_Index.tpl.php_2']['old'] = ${'activeLanguages'};
				$this->iterations['f2a895cb0e9d0b3f69867d8ef30bff0e_Index.tpl.php_2']['iteration'] = $this->variables['activeLanguages'];
				$this->iterations['f2a895cb0e9d0b3f69867d8ef30bff0e_Index.tpl.php_2']['i'] = 1;
				$this->iterations['f2a895cb0e9d0b3f69867d8ef30bff0e_Index.tpl.php_2']['count'] = count($this->iterations['f2a895cb0e9d0b3f69867d8ef30bff0e_Index.tpl.php_2']['iteration']);
				foreach((array) $this->iterations['f2a895cb0e9d0b3f69867d8ef30bff0e_Index.tpl.php_2']['iteration'] as ${'activeLanguages'})
				{
					if(!isset(${'activeLanguages'}['first']) && $this->iterations['f2a895cb0e9d0b3f69867d8ef30bff0e_Index.tpl.php_2']['i'] == 1) ${'activeLanguages'}['first'] = true;
					if(!isset(${'activeLanguages'}['last']) && $this->iterations['f2a895cb0e9d0b3f69867d8ef30bff0e_Index.tpl.php_2']['i'] == $this->iterations['f2a895cb0e9d0b3f69867d8ef30bff0e_Index.tpl.php_2']['count']) ${'activeLanguages'}['last'] = true;
					if(isset(${'activeLanguages'}['formElements']) && is_array(${'activeLanguages'}['formElements']))
					{
						foreach(${'activeLanguages'}['formElements'] as $name => $object)
						{
							${'activeLanguages'}[$name] = $object->parse();
							${'activeLanguages'}[$name .'Error'] = (is_callable(array($object, 'getErrors')) && $object->getErrors() != '') ? '<span class="formError">' . $object->getErrors() .'</span>' : '';
						}
					} ?>
					<li><?php echo ${'activeLanguages'}['chkActiveLanguages']; ?> <label for="<?php echo ${'activeLanguages'}['id']; ?>"><?php echo SpoonFilter::ucfirst(${'activeLanguages'}['label']); ?><?php
					if(isset(${'activeLanguages'}['default']) && count(${'activeLanguages'}['default']) != 0 && ${'activeLanguages'}['default'] != '' && ${'activeLanguages'}['default'] !== false)
					{
						?> (<?php echo $this->variables['lblDefault']; ?>)<?php } ?></label></li>
				<?php
					$this->iterations['f2a895cb0e9d0b3f69867d8ef30bff0e_Index.tpl.php_2']['i']++;
				}
				if(isset($this->iterations['f2a895cb0e9d0b3f69867d8ef30bff0e_Index.tpl.php_2']['old'])) ${'activeLanguages'} = $this->iterations['f2a895cb0e9d0b3f69867d8ef30bff0e_Index.tpl.php_2']['old'];
				else unset($this->iterations['f2a895cb0e9d0b3f69867d8ef30bff0e_Index.tpl.php_2']);
				?>
			</ul>
		</div>
		<div class="options">
			<p><?php echo $this->variables['msgHelpRedirectLanguages']; ?></p>
			<ul id="redirectLanguages" class="inputList pb0">
				<?php
				if(isset(${'redirectLanguages'})) $this->iterations['f2a895cb0e9d0b3f69867d8ef30bff0e_Index.tpl.php_3']['old'] = ${'redirectLanguages'};
				$this->iterations['f2a895cb0e9d0b3f69867d8ef30bff0e_Index.tpl.php_3']['iteration'] = $this->variables['redirectLanguages'];
				$this->iterations['f2a895cb0e9d0b3f69867d8ef30bff0e_Index.tpl.php_3']['i'] = 1;
				$this->iterations['f2a895cb0e9d0b3f69867d8ef30bff0e_Index.tpl.php_3']['count'] = count($this->iterations['f2a895cb0e9d0b3f69867d8ef30bff0e_Index.tpl.php_3']['iteration']);
				foreach((array) $this->iterations['f2a895cb0e9d0b3f69867d8ef30bff0e_Index.tpl.php_3']['iteration'] as ${'redirectLanguages'})
				{
					if(!isset(${'redirectLanguages'}['first']) && $this->iterations['f2a895cb0e9d0b3f69867d8ef30bff0e_Index.tpl.php_3']['i'] == 1) ${'redirectLanguages'}['first'] = true;
					if(!isset(${'redirectLanguages'}['last']) && $this->iterations['f2a895cb0e9d0b3f69867d8ef30bff0e_Index.tpl.php_3']['i'] == $this->iterations['f2a895cb0e9d0b3f69867d8ef30bff0e_Index.tpl.php_3']['count']) ${'redirectLanguages'}['last'] = true;
					if(isset(${'redirectLanguages'}['formElements']) && is_array(${'redirectLanguages'}['formElements']))
					{
						foreach(${'redirectLanguages'}['formElements'] as $name => $object)
						{
							${'redirectLanguages'}[$name] = $object->parse();
							${'redirectLanguages'}[$name .'Error'] = (is_callable(array($object, 'getErrors')) && $object->getErrors() != '') ? '<span class="formError">' . $object->getErrors() .'</span>' : '';
						}
					} ?>
					<li><?php echo ${'redirectLanguages'}['chkRedirectLanguages']; ?> <label for="<?php echo ${'redirectLanguages'}['id']; ?>"><?php echo SpoonFilter::ucfirst(${'redirectLanguages'}['label']); ?><?php
					if(isset(${'redirectLanguages'}['default']) && count(${'redirectLanguages'}['default']) != 0 && ${'redirectLanguages'}['default'] != '' && ${'redirectLanguages'}['default'] !== false)
					{
						?> (<?php echo $this->variables['lblDefault']; ?>)<?php } ?></label></li>
				<?php
					$this->iterations['f2a895cb0e9d0b3f69867d8ef30bff0e_Index.tpl.php_3']['i']++;
				}
				if(isset($this->iterations['f2a895cb0e9d0b3f69867d8ef30bff0e_Index.tpl.php_3']['old'])) ${'redirectLanguages'} = $this->iterations['f2a895cb0e9d0b3f69867d8ef30bff0e_Index.tpl.php_3']['old'];
				else unset($this->iterations['f2a895cb0e9d0b3f69867d8ef30bff0e_Index.tpl.php_3']);
				?>
			</ul>
		</div>
	</div>

	<div class="box horizontal">
		<div class="heading">
			<h3><?php echo SpoonFilter::ucfirst($this->variables['lblDateAndTime']); ?></h3>
		</div>
		<div class="options labelWidthLong">
			<p>
				<label for="timeFormat"><?php echo SpoonFilter::ucfirst($this->variables['lblTimeFormat']); ?></label>
				<?php echo $this->variables['ddmTimeFormat']; ?> <?php echo $this->variables['ddmTimeFormatError']; ?>
				<span class="helpTxt"><?php echo $this->variables['msgHelpTimeFormat']; ?></span>
			</p>
			<p>
				<label for="dateFormatShort"><?php echo SpoonFilter::ucfirst($this->variables['lblShortDateFormat']); ?></label>
				<?php echo $this->variables['ddmDateFormatShort']; ?> <?php echo $this->variables['ddmDateFormatShortError']; ?>
				<span class="helpTxt"><?php echo $this->variables['msgHelpDateFormatShort']; ?></span>
			</p>
			<p>
				<label for="dateFormatLong"><?php echo SpoonFilter::ucfirst($this->variables['lblLongDateFormat']); ?></label>
				<?php echo $this->variables['ddmDateFormatLong']; ?> <?php echo $this->variables['ddmDateFormatLongError']; ?>
				<span class="helpTxt"><?php echo $this->variables['msgHelpDateFormatLong']; ?></span>
			</p>
		</div>
	</div>

	<div class="box horizontal">
		<div class="heading">
			<h3><?php echo SpoonFilter::ucfirst($this->variables['lblNumbers']); ?></h3>
		</div>
		<div class="options labelWidthLong">
			<p>
				<label for="numberFormat"><?php echo SpoonFilter::ucfirst($this->variables['lblNumberFormat']); ?></label>
				<?php echo $this->variables['ddmNumberFormat']; ?> <?php echo $this->variables['ddmNumberFormatError']; ?>
				<span class="helpTxt"><?php echo $this->variables['msgHelpNumberFormat']; ?></span>
			</p>
		</div>
	</div>

	<div id="settingsApiKeys" class="box">
		<div class="heading">
			<h3><?php echo SpoonFilter::ucfirst($this->variables['lblAPIKeys']); ?></h3>
		</div>
		<div class="content">
			<p><?php echo $this->variables['msgHelpAPIKeys']; ?></p>
			<div class="dataGridHolder">
				<table class="dataGrid dynamicStriping">
					<thead>
						<tr>
							<th class="title" style="width: 20%;"><span><?php echo SpoonFilter::ucfirst($this->variables['lblName']); ?></span></th>
							<th style="width: 40%;"><span><?php echo SpoonFilter::ucfirst($this->variables['lblAPIKey']); ?></span></th>
							<th style="width: 60%;"><span><?php echo SpoonFilter::ucfirst($this->variables['lblAPIURL']); ?></span></th>
						</tr>
					</thead>
					<tbody>
						<tr>
							<td class="title"><label for="forkApiPublicKey">Fork public key</label></td>
							<td><?php echo $this->variables['txtForkApiPublicKey']; ?> <?php echo $this->variables['txtForkApiPublicKeyError']; ?></td>
							<td>&nbsp;</td>
						</tr>
						<tr>
							<td class="title"><label for="forkApiPrivateKey">Fork private key</label></td>
							<td><?php echo $this->variables['txtForkApiPrivateKey']; ?> <?php echo $this->variables['txtForkApiPrivateKeyError']; ?></td>
							<td>&nbsp;</td>
						</tr>
						<?php
					if(isset($this->variables['needsGoogleMaps']) && count($this->variables['needsGoogleMaps']) != 0 && $this->variables['needsGoogleMaps'] != '' && $this->variables['needsGoogleMaps'] !== false)
					{
						?>
							<tr>
								<td class="title"><label for="googleMapsKey">Google maps key<abbr title="<?php echo $this->variables['lblRequiredField']; ?>">*</abbr></label></td>
								<td><?php echo $this->variables['txtGoogleMapsKey']; ?> <?php echo $this->variables['txtGoogleMapsKeyError']; ?></td>
								<td><a href="http://code.google.com/apis/maps/signup.html">http://code.google.com/apis/maps/signup.html</a></td>
							</tr>
						<?php } ?>
						<?php
					if(isset($this->variables['needsAkismet']) && count($this->variables['needsAkismet']) != 0 && $this->variables['needsAkismet'] != '' && $this->variables['needsAkismet'] !== false)
					{
						?>
							<tr>
								<td class="title"><label for="akismetKey">Akismet key</label></td>
								<td><?php echo $this->variables['txtAkismetKey']; ?> <?php echo $this->variables['txtAkismetKeyError']; ?></td>
								<td><a href="http://akismet.com/personal">http://akismet.com/personal</a></td>
							</tr>
						<?php } ?>
					</tbody>
				</table>
			</div>
		</div>
	</div>

	<div class="box horizontal">
		<div class="heading">
			<h3>CKFinder</h3>
		</div>
		<div class="options labelWidthLong">
			<p>
				<label for="ckfinderLicenseName"><?php echo SpoonFilter::ucfirst($this->variables['lblLicenseName']); ?></label>
				<?php echo $this->variables['txtCkfinderLicenseName']; ?> <?php echo $this->variables['txtCkfinderLicenseNameError']; ?>
			</p>
			<p>
				<label for="ckfinderLicenseKey"><?php echo SpoonFilter::ucfirst($this->variables['lblLicenseKey']); ?></label>
				<?php echo $this->variables['txtCkfinderLicenseKey']; ?> <?php echo $this->variables['txtCkfinderLicenseKeyError']; ?>
			</p>
			<p>
				<label for="ckfinderImageMaxWidth"><?php echo SpoonFilter::ucfirst($this->variables['lblMaximumWidth']); ?></label>
				<?php echo $this->variables['txtCkfinderImageMaxWidth']; ?> <?php echo $this->variables['txtCkfinderImageMaxWidthError']; ?>
				<span class="helpTxt"><?php echo $this->variables['msgHelpCkfinderMaximumWidth']; ?></span>
			</p>
			<p>
				<label for="ckfinderImageMaxHeight"><?php echo SpoonFilter::ucfirst($this->variables['lblMaximumHeight']); ?></label>
				<?php echo $this->variables['txtCkfinderImageMaxHeight']; ?> <?php echo $this->variables['txtCkfinderImageMaxHeightError']; ?>
				<span class="helpTxt"><?php echo $this->variables['msgHelpCkfinderMaximumHeight']; ?></span>
			</p>
		</div>
	</div>

	<div class="box horizontal">
		<div class="heading">
			<h3>Facebook</h3>
		</div>
		<div class="options labelWidthLong">
			<p>
				<label for="addValue-facebookAdminIds"><?php echo SpoonFilter::ucfirst($this->variables['lblAdminIds']); ?></label>
				<span style="float: left;">
					<?php echo $this->variables['txtFacebookAdminIds']; ?> <?php echo $this->variables['txtFacebookAdminIdsError']; ?>
				</span>
				<span class="helpTxt" style="clear: left;"><?php echo $this->variables['msgHelpFacebookAdminIds']; ?></span>
			</p>
			<p>
				<label for="facebookApplicationId"><?php echo SpoonFilter::ucfirst($this->variables['lblApplicationId']); ?></label>
				<?php echo $this->variables['txtFacebookApplicationId']; ?> <?php echo $this->variables['txtFacebookApplicationIdError']; ?>
				<span class="helpTxt"><?php echo $this->variables['msgHelpFacebookApplicationId']; ?></span>
			</p>
			<p>
				<label for="facebookApplicationSecret"><?php echo SpoonFilter::ucfirst($this->variables['lblApplicationSecret']); ?></label>
				<?php echo $this->variables['txtFacebookApplicationSecret']; ?> <?php echo $this->variables['txtFacebookApplicationSecretError']; ?>
				<span class="helpTxt"><?php echo $this->variables['msgHelpFacebookApplicationSecret']; ?></span>
			</p>
		</div>
	</div>

    <div class="box horizontal">
        <div class="heading">
            <h3>Twitter</h3>
        </div>
        <div class="options labelWidthLong">
            <p>
                <label for="twitterSiteName"><?php echo SpoonFilter::ucfirst($this->variables['lblTwitterSiteName']); ?></label>
                <span style="float: left;">
                    @ <?php echo $this->variables['txtTwitterSiteName']; ?> <?php echo $this->variables['txtTwitterSiteNameError']; ?>
                </span>
            </p>
        </div>
    </div>

	<div class="box">
		<div class="heading">
			<h3><?php echo SpoonFilter::ucfirst($this->variables['lblCookies']); ?></h3>
		</div>
		<div class="options">
			<p><?php echo $this->variables['msgHelpCookies']; ?></p>
			<ul class="inputList pb0">
				<li><?php echo $this->variables['chkShowCookieBar']; ?> <label for="showCookieBar"><?php echo $this->variables['msgShowCookieBar']; ?></label></li>
			</ul>
		</div>
	</div>


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
