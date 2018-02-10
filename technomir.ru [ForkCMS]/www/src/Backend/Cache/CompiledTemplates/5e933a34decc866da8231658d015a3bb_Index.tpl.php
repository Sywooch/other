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
			<p><strong><?php if(array_key_exists('msgConfigurationError', (array) $this->variables)) { echo $this->variables['msgConfigurationError']; } else { ?>{$msgConfigurationError}<?php } ?></strong></p>
			<ul class="pb0">
				<?php
					if(!isset($this->variables['warnings']))
					{
						?>{iteration:warnings}<?php
						$this->variables['warnings'] = array();
						$this->iterations['5e933a34decc866da8231658d015a3bb_Index.tpl.php_1']['fail'] = true;
					}
				if(isset(${'warnings'})) $this->iterations['5e933a34decc866da8231658d015a3bb_Index.tpl.php_1']['old'] = ${'warnings'};
				$this->iterations['5e933a34decc866da8231658d015a3bb_Index.tpl.php_1']['iteration'] = $this->variables['warnings'];
				$this->iterations['5e933a34decc866da8231658d015a3bb_Index.tpl.php_1']['i'] = 1;
				$this->iterations['5e933a34decc866da8231658d015a3bb_Index.tpl.php_1']['count'] = count($this->iterations['5e933a34decc866da8231658d015a3bb_Index.tpl.php_1']['iteration']);
				foreach((array) $this->iterations['5e933a34decc866da8231658d015a3bb_Index.tpl.php_1']['iteration'] as ${'warnings'})
				{
					if(!isset(${'warnings'}['first']) && $this->iterations['5e933a34decc866da8231658d015a3bb_Index.tpl.php_1']['i'] == 1) ${'warnings'}['first'] = true;
					if(!isset(${'warnings'}['last']) && $this->iterations['5e933a34decc866da8231658d015a3bb_Index.tpl.php_1']['i'] == $this->iterations['5e933a34decc866da8231658d015a3bb_Index.tpl.php_1']['count']) ${'warnings'}['last'] = true;
					if(isset(${'warnings'}['formElements']) && is_array(${'warnings'}['formElements']))
					{
						foreach(${'warnings'}['formElements'] as $name => $object)
						{
							${'warnings'}[$name] = $object->parse();
							${'warnings'}[$name .'Error'] = (is_callable(array($object, 'getErrors')) && $object->getErrors() != '') ? '<span class="formError">' . $object->getErrors() .'</span>' : '';
						}
					} ?>
					<li><?php if(array_key_exists('message', (array) ${'warnings'})) { echo ${'warnings'}['message']; } else { ?>{$warnings->message}<?php } ?></li>
				<?php
					$this->iterations['5e933a34decc866da8231658d015a3bb_Index.tpl.php_1']['i']++;
				}
					if(isset($this->iterations['5e933a34decc866da8231658d015a3bb_Index.tpl.php_1']['fail']) && $this->iterations['5e933a34decc866da8231658d015a3bb_Index.tpl.php_1']['fail'] == true)
					{
						?>{/iteration:warnings}<?php
					}
				if(isset($this->iterations['5e933a34decc866da8231658d015a3bb_Index.tpl.php_1']['old'])) ${'warnings'} = $this->iterations['5e933a34decc866da8231658d015a3bb_Index.tpl.php_1']['old'];
				else unset($this->iterations['5e933a34decc866da8231658d015a3bb_Index.tpl.php_1']);
				?>
			</ul>
		</div>
	<?php } ?>

	<div class="box">
		<div class="heading">
			<h3>
				<label for="siteTitle"><?php if(array_key_exists('lblWebsiteTitle', (array) $this->variables)) { echo SpoonFilter::ucfirst($this->variables['lblWebsiteTitle']); } else { ?>{$lblWebsiteTitle|ucfirst}<?php } ?><abbr title="<?php if(array_key_exists('lblRequiredField', (array) $this->variables)) { echo $this->variables['lblRequiredField']; } else { ?>{$lblRequiredField}<?php } ?>">*</abbr></label>
			</h3>
		</div>
		<div class="options">
			<?php if(array_key_exists('txtSiteTitle', (array) $this->variables)) { echo $this->variables['txtSiteTitle']; } else { ?>{$txtSiteTitle}<?php } ?> <?php if(array_key_exists('txtSiteTitleError', (array) $this->variables)) { echo $this->variables['txtSiteTitleError']; } else { ?>{$txtSiteTitleError}<?php } ?>
		</div>
	</div>

	<div class="box">
		<div class="heading">
			<h3><?php if(array_key_exists('lblScripts', (array) $this->variables)) { echo SpoonFilter::ucfirst($this->variables['lblScripts']); } else { ?>{$lblScripts|ucfirst}<?php } ?></h3>
		</div>
		<div class="options">
			<div class="textareaHolder">
				<p class="p0"><label for="siteHtmlHeader"><code>&lt;head&gt;</code> script(s)</label></p>
				<?php if(array_key_exists('txtSiteHtmlHeader', (array) $this->variables)) { echo $this->variables['txtSiteHtmlHeader']; } else { ?>{$txtSiteHtmlHeader}<?php } ?> <?php if(array_key_exists('txtSiteHtmlHeaderError', (array) $this->variables)) { echo $this->variables['txtSiteHtmlHeaderError']; } else { ?>{$txtSiteHtmlHeaderError}<?php } ?>
				<span class="helpTxt"><?php if(array_key_exists('msgHelpScriptsHead', (array) $this->variables)) { echo $this->variables['msgHelpScriptsHead']; } else { ?>{$msgHelpScriptsHead}<?php } ?></span>
			</div>
		</div>
		<div class="options">
			<div class="textareaHolder">
				<p class="p0"><label for="siteHtmlFooter">End of <code>&lt;body&gt;</code> script(s)</label></p>
				<?php if(array_key_exists('txtSiteHtmlFooter', (array) $this->variables)) { echo $this->variables['txtSiteHtmlFooter']; } else { ?>{$txtSiteHtmlFooter}<?php } ?> <?php if(array_key_exists('txtSiteHtmlFooterError', (array) $this->variables)) { echo $this->variables['txtSiteHtmlFooterError']; } else { ?>{$txtSiteHtmlFooterError}<?php } ?>
				<span class="helpTxt"><?php if(array_key_exists('msgHelpScriptsFoot', (array) $this->variables)) { echo $this->variables['msgHelpScriptsFoot']; } else { ?>{$msgHelpScriptsFoot}<?php } ?></span>
			</div>
		</div>
	</div>

	<div class="box">
		<div class="heading">
			<h3><?php if(array_key_exists('lblLanguages', (array) $this->variables)) { echo SpoonFilter::ucfirst($this->variables['lblLanguages']); } else { ?>{$lblLanguages|ucfirst}<?php } ?></h3>
		</div>
		<div class="options">
			<p><?php if(array_key_exists('msgHelpLanguages', (array) $this->variables)) { echo $this->variables['msgHelpLanguages']; } else { ?>{$msgHelpLanguages}<?php } ?></p>
			<ul id="activeLanguages" class="inputList pb0">
				<?php
					if(!isset($this->variables['activeLanguages']))
					{
						?>{iteration:activeLanguages}<?php
						$this->variables['activeLanguages'] = array();
						$this->iterations['5e933a34decc866da8231658d015a3bb_Index.tpl.php_2']['fail'] = true;
					}
				if(isset(${'activeLanguages'})) $this->iterations['5e933a34decc866da8231658d015a3bb_Index.tpl.php_2']['old'] = ${'activeLanguages'};
				$this->iterations['5e933a34decc866da8231658d015a3bb_Index.tpl.php_2']['iteration'] = $this->variables['activeLanguages'];
				$this->iterations['5e933a34decc866da8231658d015a3bb_Index.tpl.php_2']['i'] = 1;
				$this->iterations['5e933a34decc866da8231658d015a3bb_Index.tpl.php_2']['count'] = count($this->iterations['5e933a34decc866da8231658d015a3bb_Index.tpl.php_2']['iteration']);
				foreach((array) $this->iterations['5e933a34decc866da8231658d015a3bb_Index.tpl.php_2']['iteration'] as ${'activeLanguages'})
				{
					if(!isset(${'activeLanguages'}['first']) && $this->iterations['5e933a34decc866da8231658d015a3bb_Index.tpl.php_2']['i'] == 1) ${'activeLanguages'}['first'] = true;
					if(!isset(${'activeLanguages'}['last']) && $this->iterations['5e933a34decc866da8231658d015a3bb_Index.tpl.php_2']['i'] == $this->iterations['5e933a34decc866da8231658d015a3bb_Index.tpl.php_2']['count']) ${'activeLanguages'}['last'] = true;
					if(isset(${'activeLanguages'}['formElements']) && is_array(${'activeLanguages'}['formElements']))
					{
						foreach(${'activeLanguages'}['formElements'] as $name => $object)
						{
							${'activeLanguages'}[$name] = $object->parse();
							${'activeLanguages'}[$name .'Error'] = (is_callable(array($object, 'getErrors')) && $object->getErrors() != '') ? '<span class="formError">' . $object->getErrors() .'</span>' : '';
						}
					} ?>
					<li><?php if(array_key_exists('chkActiveLanguages', (array) ${'activeLanguages'})) { echo ${'activeLanguages'}['chkActiveLanguages']; } else { ?>{$activeLanguages->chkActiveLanguages}<?php } ?> <label for="<?php if(array_key_exists('id', (array) ${'activeLanguages'})) { echo ${'activeLanguages'}['id']; } else { ?>{$activeLanguages->id}<?php } ?>"><?php if(array_key_exists('label', (array) ${'activeLanguages'})) { echo SpoonFilter::ucfirst(${'activeLanguages'}['label']); } else { ?>{$activeLanguages->label|ucfirst}<?php } ?><?php
					if(isset(${'activeLanguages'}['default']) && count(${'activeLanguages'}['default']) != 0 && ${'activeLanguages'}['default'] != '' && ${'activeLanguages'}['default'] !== false)
					{
						?> (<?php if(array_key_exists('lblDefault', (array) $this->variables)) { echo $this->variables['lblDefault']; } else { ?>{$lblDefault}<?php } ?>)<?php } ?></label></li>
				<?php
					$this->iterations['5e933a34decc866da8231658d015a3bb_Index.tpl.php_2']['i']++;
				}
					if(isset($this->iterations['5e933a34decc866da8231658d015a3bb_Index.tpl.php_2']['fail']) && $this->iterations['5e933a34decc866da8231658d015a3bb_Index.tpl.php_2']['fail'] == true)
					{
						?>{/iteration:activeLanguages}<?php
					}
				if(isset($this->iterations['5e933a34decc866da8231658d015a3bb_Index.tpl.php_2']['old'])) ${'activeLanguages'} = $this->iterations['5e933a34decc866da8231658d015a3bb_Index.tpl.php_2']['old'];
				else unset($this->iterations['5e933a34decc866da8231658d015a3bb_Index.tpl.php_2']);
				?>
			</ul>
		</div>
		<div class="options">
			<p><?php if(array_key_exists('msgHelpRedirectLanguages', (array) $this->variables)) { echo $this->variables['msgHelpRedirectLanguages']; } else { ?>{$msgHelpRedirectLanguages}<?php } ?></p>
			<ul id="redirectLanguages" class="inputList pb0">
				<?php
					if(!isset($this->variables['redirectLanguages']))
					{
						?>{iteration:redirectLanguages}<?php
						$this->variables['redirectLanguages'] = array();
						$this->iterations['5e933a34decc866da8231658d015a3bb_Index.tpl.php_3']['fail'] = true;
					}
				if(isset(${'redirectLanguages'})) $this->iterations['5e933a34decc866da8231658d015a3bb_Index.tpl.php_3']['old'] = ${'redirectLanguages'};
				$this->iterations['5e933a34decc866da8231658d015a3bb_Index.tpl.php_3']['iteration'] = $this->variables['redirectLanguages'];
				$this->iterations['5e933a34decc866da8231658d015a3bb_Index.tpl.php_3']['i'] = 1;
				$this->iterations['5e933a34decc866da8231658d015a3bb_Index.tpl.php_3']['count'] = count($this->iterations['5e933a34decc866da8231658d015a3bb_Index.tpl.php_3']['iteration']);
				foreach((array) $this->iterations['5e933a34decc866da8231658d015a3bb_Index.tpl.php_3']['iteration'] as ${'redirectLanguages'})
				{
					if(!isset(${'redirectLanguages'}['first']) && $this->iterations['5e933a34decc866da8231658d015a3bb_Index.tpl.php_3']['i'] == 1) ${'redirectLanguages'}['first'] = true;
					if(!isset(${'redirectLanguages'}['last']) && $this->iterations['5e933a34decc866da8231658d015a3bb_Index.tpl.php_3']['i'] == $this->iterations['5e933a34decc866da8231658d015a3bb_Index.tpl.php_3']['count']) ${'redirectLanguages'}['last'] = true;
					if(isset(${'redirectLanguages'}['formElements']) && is_array(${'redirectLanguages'}['formElements']))
					{
						foreach(${'redirectLanguages'}['formElements'] as $name => $object)
						{
							${'redirectLanguages'}[$name] = $object->parse();
							${'redirectLanguages'}[$name .'Error'] = (is_callable(array($object, 'getErrors')) && $object->getErrors() != '') ? '<span class="formError">' . $object->getErrors() .'</span>' : '';
						}
					} ?>
					<li><?php if(array_key_exists('chkRedirectLanguages', (array) ${'redirectLanguages'})) { echo ${'redirectLanguages'}['chkRedirectLanguages']; } else { ?>{$redirectLanguages->chkRedirectLanguages}<?php } ?> <label for="<?php if(array_key_exists('id', (array) ${'redirectLanguages'})) { echo ${'redirectLanguages'}['id']; } else { ?>{$redirectLanguages->id}<?php } ?>"><?php if(array_key_exists('label', (array) ${'redirectLanguages'})) { echo SpoonFilter::ucfirst(${'redirectLanguages'}['label']); } else { ?>{$redirectLanguages->label|ucfirst}<?php } ?><?php
					if(isset(${'redirectLanguages'}['default']) && count(${'redirectLanguages'}['default']) != 0 && ${'redirectLanguages'}['default'] != '' && ${'redirectLanguages'}['default'] !== false)
					{
						?> (<?php if(array_key_exists('lblDefault', (array) $this->variables)) { echo $this->variables['lblDefault']; } else { ?>{$lblDefault}<?php } ?>)<?php } ?></label></li>
				<?php
					$this->iterations['5e933a34decc866da8231658d015a3bb_Index.tpl.php_3']['i']++;
				}
					if(isset($this->iterations['5e933a34decc866da8231658d015a3bb_Index.tpl.php_3']['fail']) && $this->iterations['5e933a34decc866da8231658d015a3bb_Index.tpl.php_3']['fail'] == true)
					{
						?>{/iteration:redirectLanguages}<?php
					}
				if(isset($this->iterations['5e933a34decc866da8231658d015a3bb_Index.tpl.php_3']['old'])) ${'redirectLanguages'} = $this->iterations['5e933a34decc866da8231658d015a3bb_Index.tpl.php_3']['old'];
				else unset($this->iterations['5e933a34decc866da8231658d015a3bb_Index.tpl.php_3']);
				?>
			</ul>
		</div>
	</div>

	<div class="box horizontal">
		<div class="heading">
			<h3><?php if(array_key_exists('lblDateAndTime', (array) $this->variables)) { echo SpoonFilter::ucfirst($this->variables['lblDateAndTime']); } else { ?>{$lblDateAndTime|ucfirst}<?php } ?></h3>
		</div>
		<div class="options labelWidthLong">
			<p>
				<label for="timeFormat"><?php if(array_key_exists('lblTimeFormat', (array) $this->variables)) { echo SpoonFilter::ucfirst($this->variables['lblTimeFormat']); } else { ?>{$lblTimeFormat|ucfirst}<?php } ?></label>
				<?php if(array_key_exists('ddmTimeFormat', (array) $this->variables)) { echo $this->variables['ddmTimeFormat']; } else { ?>{$ddmTimeFormat}<?php } ?> <?php if(array_key_exists('ddmTimeFormatError', (array) $this->variables)) { echo $this->variables['ddmTimeFormatError']; } else { ?>{$ddmTimeFormatError}<?php } ?>
				<span class="helpTxt"><?php if(array_key_exists('msgHelpTimeFormat', (array) $this->variables)) { echo $this->variables['msgHelpTimeFormat']; } else { ?>{$msgHelpTimeFormat}<?php } ?></span>
			</p>
			<p>
				<label for="dateFormatShort"><?php if(array_key_exists('lblShortDateFormat', (array) $this->variables)) { echo SpoonFilter::ucfirst($this->variables['lblShortDateFormat']); } else { ?>{$lblShortDateFormat|ucfirst}<?php } ?></label>
				<?php if(array_key_exists('ddmDateFormatShort', (array) $this->variables)) { echo $this->variables['ddmDateFormatShort']; } else { ?>{$ddmDateFormatShort}<?php } ?> <?php if(array_key_exists('ddmDateFormatShortError', (array) $this->variables)) { echo $this->variables['ddmDateFormatShortError']; } else { ?>{$ddmDateFormatShortError}<?php } ?>
				<span class="helpTxt"><?php if(array_key_exists('msgHelpDateFormatShort', (array) $this->variables)) { echo $this->variables['msgHelpDateFormatShort']; } else { ?>{$msgHelpDateFormatShort}<?php } ?></span>
			</p>
			<p>
				<label for="dateFormatLong"><?php if(array_key_exists('lblLongDateFormat', (array) $this->variables)) { echo SpoonFilter::ucfirst($this->variables['lblLongDateFormat']); } else { ?>{$lblLongDateFormat|ucfirst}<?php } ?></label>
				<?php if(array_key_exists('ddmDateFormatLong', (array) $this->variables)) { echo $this->variables['ddmDateFormatLong']; } else { ?>{$ddmDateFormatLong}<?php } ?> <?php if(array_key_exists('ddmDateFormatLongError', (array) $this->variables)) { echo $this->variables['ddmDateFormatLongError']; } else { ?>{$ddmDateFormatLongError}<?php } ?>
				<span class="helpTxt"><?php if(array_key_exists('msgHelpDateFormatLong', (array) $this->variables)) { echo $this->variables['msgHelpDateFormatLong']; } else { ?>{$msgHelpDateFormatLong}<?php } ?></span>
			</p>
		</div>
	</div>

	<div class="box horizontal">
		<div class="heading">
			<h3><?php if(array_key_exists('lblNumbers', (array) $this->variables)) { echo SpoonFilter::ucfirst($this->variables['lblNumbers']); } else { ?>{$lblNumbers|ucfirst}<?php } ?></h3>
		</div>
		<div class="options labelWidthLong">
			<p>
				<label for="numberFormat"><?php if(array_key_exists('lblNumberFormat', (array) $this->variables)) { echo SpoonFilter::ucfirst($this->variables['lblNumberFormat']); } else { ?>{$lblNumberFormat|ucfirst}<?php } ?></label>
				<?php if(array_key_exists('ddmNumberFormat', (array) $this->variables)) { echo $this->variables['ddmNumberFormat']; } else { ?>{$ddmNumberFormat}<?php } ?> <?php if(array_key_exists('ddmNumberFormatError', (array) $this->variables)) { echo $this->variables['ddmNumberFormatError']; } else { ?>{$ddmNumberFormatError}<?php } ?>
				<span class="helpTxt"><?php if(array_key_exists('msgHelpNumberFormat', (array) $this->variables)) { echo $this->variables['msgHelpNumberFormat']; } else { ?>{$msgHelpNumberFormat}<?php } ?></span>
			</p>
		</div>
	</div>

	<div id="settingsApiKeys" class="box">
		<div class="heading">
			<h3><?php if(array_key_exists('lblAPIKeys', (array) $this->variables)) { echo SpoonFilter::ucfirst($this->variables['lblAPIKeys']); } else { ?>{$lblAPIKeys|ucfirst}<?php } ?></h3>
		</div>
		<div class="content">
			<p><?php if(array_key_exists('msgHelpAPIKeys', (array) $this->variables)) { echo $this->variables['msgHelpAPIKeys']; } else { ?>{$msgHelpAPIKeys}<?php } ?></p>
			<div class="dataGridHolder">
				<table class="dataGrid dynamicStriping">
					<thead>
						<tr>
							<th class="title" style="width: 20%;"><span><?php if(array_key_exists('lblName', (array) $this->variables)) { echo SpoonFilter::ucfirst($this->variables['lblName']); } else { ?>{$lblName|ucfirst}<?php } ?></span></th>
							<th style="width: 40%;"><span><?php if(array_key_exists('lblAPIKey', (array) $this->variables)) { echo SpoonFilter::ucfirst($this->variables['lblAPIKey']); } else { ?>{$lblAPIKey|ucfirst}<?php } ?></span></th>
							<th style="width: 60%;"><span><?php if(array_key_exists('lblAPIURL', (array) $this->variables)) { echo SpoonFilter::ucfirst($this->variables['lblAPIURL']); } else { ?>{$lblAPIURL|ucfirst}<?php } ?></span></th>
						</tr>
					</thead>
					<tbody>
						<tr>
							<td class="title"><label for="forkApiPublicKey">Fork public key</label></td>
							<td><?php if(array_key_exists('txtForkApiPublicKey', (array) $this->variables)) { echo $this->variables['txtForkApiPublicKey']; } else { ?>{$txtForkApiPublicKey}<?php } ?> <?php if(array_key_exists('txtForkApiPublicKeyError', (array) $this->variables)) { echo $this->variables['txtForkApiPublicKeyError']; } else { ?>{$txtForkApiPublicKeyError}<?php } ?></td>
							<td>&nbsp;</td>
						</tr>
						<tr>
							<td class="title"><label for="forkApiPrivateKey">Fork private key</label></td>
							<td><?php if(array_key_exists('txtForkApiPrivateKey', (array) $this->variables)) { echo $this->variables['txtForkApiPrivateKey']; } else { ?>{$txtForkApiPrivateKey}<?php } ?> <?php if(array_key_exists('txtForkApiPrivateKeyError', (array) $this->variables)) { echo $this->variables['txtForkApiPrivateKeyError']; } else { ?>{$txtForkApiPrivateKeyError}<?php } ?></td>
							<td>&nbsp;</td>
						</tr>
						<?php
					if(isset($this->variables['needsGoogleMaps']) && count($this->variables['needsGoogleMaps']) != 0 && $this->variables['needsGoogleMaps'] != '' && $this->variables['needsGoogleMaps'] !== false)
					{
						?>
							<tr>
								<td class="title"><label for="googleMapsKey">Google maps key<abbr title="<?php if(array_key_exists('lblRequiredField', (array) $this->variables)) { echo $this->variables['lblRequiredField']; } else { ?>{$lblRequiredField}<?php } ?>">*</abbr></label></td>
								<td><?php if(array_key_exists('txtGoogleMapsKey', (array) $this->variables)) { echo $this->variables['txtGoogleMapsKey']; } else { ?>{$txtGoogleMapsKey}<?php } ?> <?php if(array_key_exists('txtGoogleMapsKeyError', (array) $this->variables)) { echo $this->variables['txtGoogleMapsKeyError']; } else { ?>{$txtGoogleMapsKeyError}<?php } ?></td>
								<td><a href="http://code.google.com/apis/maps/signup.html">http://code.google.com/apis/maps/signup.html</a></td>
							</tr>
						<?php } ?>
						<?php
					if(isset($this->variables['needsAkismet']) && count($this->variables['needsAkismet']) != 0 && $this->variables['needsAkismet'] != '' && $this->variables['needsAkismet'] !== false)
					{
						?>
							<tr>
								<td class="title"><label for="akismetKey">Akismet key</label></td>
								<td><?php if(array_key_exists('txtAkismetKey', (array) $this->variables)) { echo $this->variables['txtAkismetKey']; } else { ?>{$txtAkismetKey}<?php } ?> <?php if(array_key_exists('txtAkismetKeyError', (array) $this->variables)) { echo $this->variables['txtAkismetKeyError']; } else { ?>{$txtAkismetKeyError}<?php } ?></td>
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
				<label for="ckfinderLicenseName"><?php if(array_key_exists('lblLicenseName', (array) $this->variables)) { echo SpoonFilter::ucfirst($this->variables['lblLicenseName']); } else { ?>{$lblLicenseName|ucfirst}<?php } ?></label>
				<?php if(array_key_exists('txtCkfinderLicenseName', (array) $this->variables)) { echo $this->variables['txtCkfinderLicenseName']; } else { ?>{$txtCkfinderLicenseName}<?php } ?> <?php if(array_key_exists('txtCkfinderLicenseNameError', (array) $this->variables)) { echo $this->variables['txtCkfinderLicenseNameError']; } else { ?>{$txtCkfinderLicenseNameError}<?php } ?>
			</p>
			<p>
				<label for="ckfinderLicenseKey"><?php if(array_key_exists('lblLicenseKey', (array) $this->variables)) { echo SpoonFilter::ucfirst($this->variables['lblLicenseKey']); } else { ?>{$lblLicenseKey|ucfirst}<?php } ?></label>
				<?php if(array_key_exists('txtCkfinderLicenseKey', (array) $this->variables)) { echo $this->variables['txtCkfinderLicenseKey']; } else { ?>{$txtCkfinderLicenseKey}<?php } ?> <?php if(array_key_exists('txtCkfinderLicenseKeyError', (array) $this->variables)) { echo $this->variables['txtCkfinderLicenseKeyError']; } else { ?>{$txtCkfinderLicenseKeyError}<?php } ?>
			</p>
			<p>
				<label for="ckfinderImageMaxWidth"><?php if(array_key_exists('lblMaximumWidth', (array) $this->variables)) { echo SpoonFilter::ucfirst($this->variables['lblMaximumWidth']); } else { ?>{$lblMaximumWidth|ucfirst}<?php } ?></label>
				<?php if(array_key_exists('txtCkfinderImageMaxWidth', (array) $this->variables)) { echo $this->variables['txtCkfinderImageMaxWidth']; } else { ?>{$txtCkfinderImageMaxWidth}<?php } ?> <?php if(array_key_exists('txtCkfinderImageMaxWidthError', (array) $this->variables)) { echo $this->variables['txtCkfinderImageMaxWidthError']; } else { ?>{$txtCkfinderImageMaxWidthError}<?php } ?>
				<span class="helpTxt"><?php if(array_key_exists('msgHelpCkfinderMaximumWidth', (array) $this->variables)) { echo $this->variables['msgHelpCkfinderMaximumWidth']; } else { ?>{$msgHelpCkfinderMaximumWidth}<?php } ?></span>
			</p>
			<p>
				<label for="ckfinderImageMaxHeight"><?php if(array_key_exists('lblMaximumHeight', (array) $this->variables)) { echo SpoonFilter::ucfirst($this->variables['lblMaximumHeight']); } else { ?>{$lblMaximumHeight|ucfirst}<?php } ?></label>
				<?php if(array_key_exists('txtCkfinderImageMaxHeight', (array) $this->variables)) { echo $this->variables['txtCkfinderImageMaxHeight']; } else { ?>{$txtCkfinderImageMaxHeight}<?php } ?> <?php if(array_key_exists('txtCkfinderImageMaxHeightError', (array) $this->variables)) { echo $this->variables['txtCkfinderImageMaxHeightError']; } else { ?>{$txtCkfinderImageMaxHeightError}<?php } ?>
				<span class="helpTxt"><?php if(array_key_exists('msgHelpCkfinderMaximumHeight', (array) $this->variables)) { echo $this->variables['msgHelpCkfinderMaximumHeight']; } else { ?>{$msgHelpCkfinderMaximumHeight}<?php } ?></span>
			</p>
		</div>
	</div>

	<div class="box horizontal">
		<div class="heading">
			<h3>Facebook</h3>
		</div>
		<div class="options labelWidthLong">
			<p>
				<label for="addValue-facebookAdminIds"><?php if(array_key_exists('lblAdminIds', (array) $this->variables)) { echo SpoonFilter::ucfirst($this->variables['lblAdminIds']); } else { ?>{$lblAdminIds|ucfirst}<?php } ?></label>
				<span style="float: left;">
					<?php if(array_key_exists('txtFacebookAdminIds', (array) $this->variables)) { echo $this->variables['txtFacebookAdminIds']; } else { ?>{$txtFacebookAdminIds}<?php } ?> <?php if(array_key_exists('txtFacebookAdminIdsError', (array) $this->variables)) { echo $this->variables['txtFacebookAdminIdsError']; } else { ?>{$txtFacebookAdminIdsError}<?php } ?>
				</span>
				<span class="helpTxt" style="clear: left;"><?php if(array_key_exists('msgHelpFacebookAdminIds', (array) $this->variables)) { echo $this->variables['msgHelpFacebookAdminIds']; } else { ?>{$msgHelpFacebookAdminIds}<?php } ?></span>
			</p>
			<p>
				<label for="facebookApplicationId"><?php if(array_key_exists('lblApplicationId', (array) $this->variables)) { echo SpoonFilter::ucfirst($this->variables['lblApplicationId']); } else { ?>{$lblApplicationId|ucfirst}<?php } ?></label>
				<?php if(array_key_exists('txtFacebookApplicationId', (array) $this->variables)) { echo $this->variables['txtFacebookApplicationId']; } else { ?>{$txtFacebookApplicationId}<?php } ?> <?php if(array_key_exists('txtFacebookApplicationIdError', (array) $this->variables)) { echo $this->variables['txtFacebookApplicationIdError']; } else { ?>{$txtFacebookApplicationIdError}<?php } ?>
				<span class="helpTxt"><?php if(array_key_exists('msgHelpFacebookApplicationId', (array) $this->variables)) { echo $this->variables['msgHelpFacebookApplicationId']; } else { ?>{$msgHelpFacebookApplicationId}<?php } ?></span>
			</p>
			<p>
				<label for="facebookApplicationSecret"><?php if(array_key_exists('lblApplicationSecret', (array) $this->variables)) { echo SpoonFilter::ucfirst($this->variables['lblApplicationSecret']); } else { ?>{$lblApplicationSecret|ucfirst}<?php } ?></label>
				<?php if(array_key_exists('txtFacebookApplicationSecret', (array) $this->variables)) { echo $this->variables['txtFacebookApplicationSecret']; } else { ?>{$txtFacebookApplicationSecret}<?php } ?> <?php if(array_key_exists('txtFacebookApplicationSecretError', (array) $this->variables)) { echo $this->variables['txtFacebookApplicationSecretError']; } else { ?>{$txtFacebookApplicationSecretError}<?php } ?>
				<span class="helpTxt"><?php if(array_key_exists('msgHelpFacebookApplicationSecret', (array) $this->variables)) { echo $this->variables['msgHelpFacebookApplicationSecret']; } else { ?>{$msgHelpFacebookApplicationSecret}<?php } ?></span>
			</p>
		</div>
	</div>

    <div class="box horizontal">
        <div class="heading">
            <h3>Twitter</h3>
        </div>
        <div class="options labelWidthLong">
            <p>
                <label for="twitterSiteName"><?php if(array_key_exists('lblTwitterSiteName', (array) $this->variables)) { echo SpoonFilter::ucfirst($this->variables['lblTwitterSiteName']); } else { ?>{$lblTwitterSiteName|ucfirst}<?php } ?></label>
                <span style="float: left;">
                    @ <?php if(array_key_exists('txtTwitterSiteName', (array) $this->variables)) { echo $this->variables['txtTwitterSiteName']; } else { ?>{$txtTwitterSiteName}<?php } ?> <?php if(array_key_exists('txtTwitterSiteNameError', (array) $this->variables)) { echo $this->variables['txtTwitterSiteNameError']; } else { ?>{$txtTwitterSiteNameError}<?php } ?>
                </span>
            </p>
        </div>
    </div>

	<div class="box">
		<div class="heading">
			<h3><?php if(array_key_exists('lblCookies', (array) $this->variables)) { echo SpoonFilter::ucfirst($this->variables['lblCookies']); } else { ?>{$lblCookies|ucfirst}<?php } ?></h3>
		</div>
		<div class="options">
			<p><?php if(array_key_exists('msgHelpCookies', (array) $this->variables)) { echo $this->variables['msgHelpCookies']; } else { ?>{$msgHelpCookies}<?php } ?></p>
			<ul class="inputList pb0">
				<li><?php if(array_key_exists('chkShowCookieBar', (array) $this->variables)) { echo $this->variables['chkShowCookieBar']; } else { ?>{$chkShowCookieBar}<?php } ?> <label for="showCookieBar"><?php if(array_key_exists('msgShowCookieBar', (array) $this->variables)) { echo $this->variables['msgShowCookieBar']; } else { ?>{$msgShowCookieBar}<?php } ?></label></li>
			</ul>
		</div>
	</div>


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
