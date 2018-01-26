<?php error_reporting(0); ini_set('display_errors', 'Off'); ?>
<?php
				ob_start();
				?><?php echo $this->variables['BACKEND_CORE_PATH']; ?>/Layout/Templates/Head.tpl<?php
				$include = eval('return \'' . str_replace('\'', '\\\'', ob_get_clean()) .'\';');
				if($this->getForceCompile() || !file_exists($this->getCompileDirectory() .'/' . $this->getCompileName($include, '/home/anastosi/domains/anastosi.ru/public_html/src/Backend/Modules/Users/Layout/Templates'))) $this->compile('/home/anastosi/domains/anastosi.ru/public_html/src/Backend/Modules/Users/Layout/Templates', $include);
				$return = @include $this->getCompileDirectory() .'/' . $this->getCompileName($include, '/home/anastosi/domains/anastosi.ru/public_html/src/Backend/Modules/Users/Layout/Templates');
				if($return === false && $this->compile('/home/anastosi/domains/anastosi.ru/public_html/src/Backend/Modules/Users/Layout/Templates', $include))
				{
					$return = @include $this->getCompileDirectory() .'/' . $this->getCompileName($include, '/home/anastosi/domains/anastosi.ru/public_html/src/Backend/Modules/Users/Layout/Templates');
				}
?>
<?php
				ob_start();
				?><?php echo $this->variables['BACKEND_CORE_PATH']; ?>/Layout/Templates/StructureStartModule.tpl<?php
				$include = eval('return \'' . str_replace('\'', '\\\'', ob_get_clean()) .'\';');
				if($this->getForceCompile() || !file_exists($this->getCompileDirectory() .'/' . $this->getCompileName($include, '/home/anastosi/domains/anastosi.ru/public_html/src/Backend/Modules/Users/Layout/Templates'))) $this->compile('/home/anastosi/domains/anastosi.ru/public_html/src/Backend/Modules/Users/Layout/Templates', $include);
				$return = @include $this->getCompileDirectory() .'/' . $this->getCompileName($include, '/home/anastosi/domains/anastosi.ru/public_html/src/Backend/Modules/Users/Layout/Templates');
				if($return === false && $this->compile('/home/anastosi/domains/anastosi.ru/public_html/src/Backend/Modules/Users/Layout/Templates', $include))
				{
					$return = @include $this->getCompileDirectory() .'/' . $this->getCompileName($include, '/home/anastosi/domains/anastosi.ru/public_html/src/Backend/Modules/Users/Layout/Templates');
				}
?>

<div class="pageTitle">
	<h2><?php echo SpoonFilter::ucfirst($this->variables['lblUsers']); ?>: <?php echo $this->variables['lblAdd']; ?></h2>
</div>

<?php
					if(isset($this->forms['add']))
					{
						?><form accept-charset="UTF-8" action="<?php echo $this->forms['add']->getAction(); ?>" method="<?php echo $this->forms['add']->getMethod(); ?>"<?php echo $this->forms['add']->getParametersHTML(); ?>>
						<?php echo $this->forms['add']->getField('form')->parse();
						if($this->forms['add']->getUseToken())
						{
							?><input type="hidden" name="form_token" id="<?php echo $this->forms['add']->getField('form_token')->getAttribute('id'); ?>" value="<?php echo htmlspecialchars($this->forms['add']->getField('form_token')->getValue()); ?>" />
						<?php } ?>
	<div id="tabs" class="tabs">
		<ul>
			<li><a href="#tabProfile"><?php echo SpoonFilter::ucfirst($this->variables['lblProfile']); ?></a></li>
			<li><a href="#tabPermissions"><?php echo SpoonFilter::ucfirst($this->variables['lblPermissions']); ?></a></li>
		</ul>

		<div id="tabProfile">
			<div class="subtleBox">
				<div class="heading">
					<h3><?php echo SpoonFilter::ucfirst($this->variables['lblLoginDetails']); ?></h3>
				</div>
				<div class="options labelWidthLong horizontal">
					<p>
						<label for="email"><?php echo SpoonFilter::ucfirst($this->variables['lblEmail']); ?><abbr title="<?php echo $this->variables['lblRequiredField']; ?>">*</abbr></label>
						<?php echo $this->variables['txtEmail']; ?> <?php echo $this->variables['txtEmailError']; ?>
					</p>
					<div class="oneLiner" style="margin-bottom: 6px;">
						<p>
							<label for="password"><?php echo SpoonFilter::ucfirst($this->variables['lblPassword']); ?><abbr title="<?php echo $this->variables['lblRequiredField']; ?>">*</abbr></label>
							<?php echo $this->variables['txtPassword']; ?>
						</p>
						<?php echo $this->variables['txtPasswordError']; ?>
					</div>
					<table id="passwordStrengthMeter" class="passwordStrength" data-id="password">
						<tr>
							<td class="strength" id="passwordStrength">
								<p class="strength none"><?php echo SpoonFilter::ucfirst($this->variables['lblNone']); ?></p>
								<p class="strength weak"><?php echo SpoonFilter::ucfirst($this->variables['lblWeak']); ?></p>
								<p class="strength average"><?php echo SpoonFilter::ucfirst($this->variables['lblAverage']); ?></p>
								<p class="strength strong"><?php echo SpoonFilter::ucfirst($this->variables['lblStrong']); ?></p>
							</td>
							<td>
								<p class="helpTxt"><?php echo $this->variables['msgHelpStrongPassword']; ?></p>
							</td>
						</tr>
					</table>
					<p>
						<label for="confirmPassword"><?php echo SpoonFilter::ucfirst($this->variables['lblConfirmPassword']); ?><abbr title="<?php echo $this->variables['lblRequiredField']; ?>">*</abbr></label>
						<?php echo $this->variables['txtConfirmPassword']; ?> <?php echo $this->variables['txtConfirmPasswordError']; ?>
					</p>
				</div>
			</div>

			<div class="subtleBox">
				<div class="heading">
					<h3><?php echo SpoonFilter::ucfirst($this->variables['lblPersonalInformation']); ?></h3>
				</div>
				<div class="options labelWidthLong horizontal">
					<p>
						<label for="name"><?php echo SpoonFilter::ucfirst($this->variables['lblName']); ?><abbr title="<?php echo $this->variables['lblRequiredField']; ?>">*</abbr></label>
						<?php echo $this->variables['txtName']; ?> <?php echo $this->variables['txtNameError']; ?>
					</p>
					<p>
						<label for="surname"><?php echo SpoonFilter::ucfirst($this->variables['lblSurname']); ?><abbr title="<?php echo $this->variables['lblRequiredField']; ?>">*</abbr></label>
						<?php echo $this->variables['txtSurname']; ?> <?php echo $this->variables['txtSurnameError']; ?>
					</p>
					<p>
						<label for="nickname"><?php echo SpoonFilter::ucfirst($this->variables['lblNickname']); ?><abbr title="<?php echo $this->variables['lblRequiredField']; ?>">*</abbr></label>
						<?php echo $this->variables['txtNickname']; ?> <?php echo $this->variables['txtNicknameError']; ?>
						<span class="helpTxt"><?php echo $this->variables['msgHelpNickname']; ?></span>
					</p>
					<p>
						<label for="avatar"><?php echo SpoonFilter::ucfirst($this->variables['lblAvatar']); ?></label>
						<?php echo $this->variables['fileAvatar']; ?> <?php echo $this->variables['fileAvatarError']; ?>
						<span class="helpTxt"><?php echo $this->variables['msgHelpAvatar']; ?></span>
					</p>
				</div>
			</div>

			<div class="subtleBox">
				<div class="heading">
					<h3><?php echo SpoonFilter::ucfirst($this->variables['lblInterfacePreferences']); ?></h3>
				</div>
				<div class="options labelWidthLong horizontal">
					<p>
						<label for="interfaceLanguage"><?php echo SpoonFilter::ucfirst($this->variables['lblLanguage']); ?></label>
						<?php echo $this->variables['ddmInterfaceLanguage']; ?> <?php echo $this->variables['ddmInterfaceLanguageError']; ?>
					</p>
					<p>
						<label for="dateFormat"><?php echo SpoonFilter::ucfirst($this->variables['lblDateFormat']); ?></label>
						<?php echo $this->variables['ddmDateFormat']; ?> <?php echo $this->variables['ddmDateFormatError']; ?>
					</p>
					<p>
						<label for="timeFormat"><?php echo SpoonFilter::ucfirst($this->variables['lblTimeFormat']); ?></label>
						<?php echo $this->variables['ddmTimeFormat']; ?> <?php echo $this->variables['ddmTimeFormatError']; ?>
					</p>
					<p>
						<label for="numberFormat"><?php echo SpoonFilter::ucfirst($this->variables['lblNumberFormat']); ?></label>
						<?php echo $this->variables['ddmNumberFormat']; ?> <?php echo $this->variables['ddmNumberFormatError']; ?>
					</p>
				</div>
			</div>
			<div class="subtleBox">
				<div class="heading">
					<h3><?php echo SpoonFilter::ucfirst($this->variables['lblCSV']); ?></h3>
				</div>
				<div class="options horizontal labelWidthLong">
					<p>
						<label for="csvSplitCharacter"><?php echo SpoonFilter::ucfirst($this->variables['lblSplitCharacter']); ?></label>
						<?php echo $this->variables['ddmCsvSplitCharacter']; ?> <?php echo $this->variables['ddmCsvSplitCharacterError']; ?>
					</p>
					<p>
						<label for="csvLineEnding"><?php echo SpoonFilter::ucfirst($this->variables['lblLineEnding']); ?></label>
						<?php echo $this->variables['ddmCsvLineEnding']; ?> <?php echo $this->variables['ddmCsvLineEndingError']; ?>
					</p>
				</div>
			</div>
		</div>

		<div id="tabPermissions">
			<div class="subtleBox">
				<div class="heading">
					<h3><?php echo SpoonFilter::ucfirst($this->variables['lblAccountManagement']); ?></h3>
				</div>
				<div class="options last">
					<ul class="inputList">
						<li><?php echo $this->variables['chkActive']; ?> <label for="active"><?php echo $this->variables['msgHelpActive']; ?></label> <?php echo $this->variables['chkActiveError']; ?></li>
						<li><?php echo $this->variables['chkApiAccess']; ?> <label for="apiAccess"><?php echo $this->variables['msgHelpAPIAccess']; ?></label> <?php echo $this->variables['chkApiAccessError']; ?></li>
					</ul>
					<p><?php echo SpoonFilter::ucfirst($this->variables['lblGroups']); ?></p>
					<ul id="groupList" class="inputList">
						<?php
				if(isset(${'groups'})) $this->iterations['1e69633ce2f3fb58d2ab8a4c0b930be4_Add.tpl.php_1']['old'] = ${'groups'};
				$this->iterations['1e69633ce2f3fb58d2ab8a4c0b930be4_Add.tpl.php_1']['iteration'] = $this->variables['groups'];
				$this->iterations['1e69633ce2f3fb58d2ab8a4c0b930be4_Add.tpl.php_1']['i'] = 1;
				$this->iterations['1e69633ce2f3fb58d2ab8a4c0b930be4_Add.tpl.php_1']['count'] = count($this->iterations['1e69633ce2f3fb58d2ab8a4c0b930be4_Add.tpl.php_1']['iteration']);
				foreach((array) $this->iterations['1e69633ce2f3fb58d2ab8a4c0b930be4_Add.tpl.php_1']['iteration'] as ${'groups'})
				{
					if(!isset(${'groups'}['first']) && $this->iterations['1e69633ce2f3fb58d2ab8a4c0b930be4_Add.tpl.php_1']['i'] == 1) ${'groups'}['first'] = true;
					if(!isset(${'groups'}['last']) && $this->iterations['1e69633ce2f3fb58d2ab8a4c0b930be4_Add.tpl.php_1']['i'] == $this->iterations['1e69633ce2f3fb58d2ab8a4c0b930be4_Add.tpl.php_1']['count']) ${'groups'}['last'] = true;
					if(isset(${'groups'}['formElements']) && is_array(${'groups'}['formElements']))
					{
						foreach(${'groups'}['formElements'] as $name => $object)
						{
							${'groups'}[$name] = $object->parse();
							${'groups'}[$name .'Error'] = (is_callable(array($object, 'getErrors')) && $object->getErrors() != '') ? '<span class="formError">' . $object->getErrors() .'</span>' : '';
						}
					} ?>
							<li><?php echo ${'groups'}['chkGroups']; ?> <label for="<?php echo ${'groups'}['id']; ?>"><?php echo ${'groups'}['label']; ?></label></li>
						<?php
					$this->iterations['1e69633ce2f3fb58d2ab8a4c0b930be4_Add.tpl.php_1']['i']++;
				}
				if(isset($this->iterations['1e69633ce2f3fb58d2ab8a4c0b930be4_Add.tpl.php_1']['old'])) ${'groups'} = $this->iterations['1e69633ce2f3fb58d2ab8a4c0b930be4_Add.tpl.php_1']['old'];
				else unset($this->iterations['1e69633ce2f3fb58d2ab8a4c0b930be4_Add.tpl.php_1']);
				?>
					</ul>
					<?php echo $this->variables['chkGroupsError']; ?>
				</div>
			</div>
		</div>
	</div>

	<div class="fullwidthOptions">
		<div class="buttonHolderRight">
			<input id="addButton" class="button mainButton" type="submit" name="add" value="<?php echo SpoonFilter::ucfirst($this->variables['lblAdd']); ?>" />
		</div>
	</div>
</form>
				<?php } ?>

<?php
				ob_start();
				?><?php echo $this->variables['BACKEND_CORE_PATH']; ?>/Layout/Templates/StructureEndModule.tpl<?php
				$include = eval('return \'' . str_replace('\'', '\\\'', ob_get_clean()) .'\';');
				if($this->getForceCompile() || !file_exists($this->getCompileDirectory() .'/' . $this->getCompileName($include, '/home/anastosi/domains/anastosi.ru/public_html/src/Backend/Modules/Users/Layout/Templates'))) $this->compile('/home/anastosi/domains/anastosi.ru/public_html/src/Backend/Modules/Users/Layout/Templates', $include);
				$return = @include $this->getCompileDirectory() .'/' . $this->getCompileName($include, '/home/anastosi/domains/anastosi.ru/public_html/src/Backend/Modules/Users/Layout/Templates');
				if($return === false && $this->compile('/home/anastosi/domains/anastosi.ru/public_html/src/Backend/Modules/Users/Layout/Templates', $include))
				{
					$return = @include $this->getCompileDirectory() .'/' . $this->getCompileName($include, '/home/anastosi/domains/anastosi.ru/public_html/src/Backend/Modules/Users/Layout/Templates');
				}
?>
<?php
				ob_start();
				?><?php echo $this->variables['BACKEND_CORE_PATH']; ?>/Layout/Templates/Footer.tpl<?php
				$include = eval('return \'' . str_replace('\'', '\\\'', ob_get_clean()) .'\';');
				if($this->getForceCompile() || !file_exists($this->getCompileDirectory() .'/' . $this->getCompileName($include, '/home/anastosi/domains/anastosi.ru/public_html/src/Backend/Modules/Users/Layout/Templates'))) $this->compile('/home/anastosi/domains/anastosi.ru/public_html/src/Backend/Modules/Users/Layout/Templates', $include);
				$return = @include $this->getCompileDirectory() .'/' . $this->getCompileName($include, '/home/anastosi/domains/anastosi.ru/public_html/src/Backend/Modules/Users/Layout/Templates');
				if($return === false && $this->compile('/home/anastosi/domains/anastosi.ru/public_html/src/Backend/Modules/Users/Layout/Templates', $include))
				{
					$return = @include $this->getCompileDirectory() .'/' . $this->getCompileName($include, '/home/anastosi/domains/anastosi.ru/public_html/src/Backend/Modules/Users/Layout/Templates');
				}
?>
