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
	<h2><?php echo SpoonFilter::ucfirst($this->variables['lblUsers']); ?>: <?php echo sprintf($this->variables['msgEditUser'], $this->variables['record']['settings']['nickname']); ?></h2>
</div>

<?php
					if(isset($this->forms['edit']))
					{
						?><form accept-charset="UTF-8" action="<?php echo $this->forms['edit']->getAction(); ?>" method="<?php echo $this->forms['edit']->getMethod(); ?>"<?php echo $this->forms['edit']->getParametersHTML(); ?>>
						<?php echo $this->forms['edit']->getField('form')->parse();
						if($this->forms['edit']->getUseToken())
						{
							?><input type="hidden" name="form_token" id="<?php echo $this->forms['edit']->getField('form_token')->getAttribute('id'); ?>" value="<?php echo htmlspecialchars($this->forms['edit']->getField('form_token')->getValue()); ?>" />
						<?php } ?>
	<table class="settingsUserInfo">
		<tr>
			<td>
				<div class="avatar av48">
					<?php
					if(isset($this->variables['record']['settings']['avatar']) && count($this->variables['record']['settings']['avatar']) != 0 && $this->variables['record']['settings']['avatar'] != '' && $this->variables['record']['settings']['avatar'] !== false)
					{
						?>
						<img src="<?php echo $this->variables['FRONTEND_FILES_URL']; ?>/backend_users/avatars/64x64/<?php echo $this->variables['record']['settings']['avatar']; ?>" width="48" height="48" alt="" />
					<?php } ?>
				</div>
			</td>
			<td>
				<table class="infoGrid">
					<tr>
						<th><?php echo SpoonFilter::ucfirst($this->variables['lblName']); ?>:</th>
						<td><strong><?php echo $this->variables['record']['settings']['name']; ?> <?php echo $this->variables['record']['settings']['surname']; ?></strong></td>
					</tr>
					<tr>
						<th><?php echo SpoonFilter::ucfirst($this->variables['lblNickname']); ?>:</th>
						<td><?php echo $this->variables['record']['settings']['nickname']; ?></td>
					</tr>
					<tr>
						<th><?php echo SpoonFilter::ucfirst($this->variables['lblEmail']); ?>:</th>
						<td><?php echo $this->variables['record']['email']; ?></td>
					</tr>
					<tr>
						<th><?php echo SpoonFilter::ucfirst($this->variables['lblLastLogin']); ?>:</th>
						<td>
							<?php
					if(isset($this->variables['record']['settings']['last_login']) && count($this->variables['record']['settings']['last_login']) != 0 && $this->variables['record']['settings']['last_login'] != '' && $this->variables['record']['settings']['last_login'] !== false)
					{
						?><?php echo SpoonTemplateModifiers::date($this->variables['record']['settings']['last_login'], '' . $this->variables['authenticatedUserDateFormat'] .' ' . $this->variables['authenticatedUserTimeFormat'] .'', $this->variables['INTERFACE_LANGUAGE']); ?><?php } ?>
							<?php if(!isset($this->variables['record']['settings']['last_login']) || count($this->variables['record']['settings']['last_login']) == 0 || $this->variables['record']['settings']['last_login'] == '' || $this->variables['record']['settings']['last_login'] === false): ?><?php echo $this->variables['lblNoPreviousLogin']; ?><?php endif; ?>
						</td>
					</tr>
					<?php
					if(isset($this->variables['record']['settings']['last_failed_login_attempt']) && count($this->variables['record']['settings']['last_failed_login_attempt']) != 0 && $this->variables['record']['settings']['last_failed_login_attempt'] != '' && $this->variables['record']['settings']['last_failed_login_attempt'] !== false)
					{
						?>
						<tr>
							<th><?php echo SpoonFilter::ucfirst($this->variables['lblLastFailedLoginAttempt']); ?>:</th>
							<td><?php echo SpoonTemplateModifiers::date($this->variables['record']['settings']['last_failed_login_attempt'], '' . $this->variables['authenticatedUserDateFormat'] .' ' . $this->variables['authenticatedUserTimeFormat'] .'', $this->variables['INTERFACE_LANGUAGE']); ?></td>
						</tr>
					<?php } ?>
					<tr>
						<th><?php echo SpoonFilter::ucfirst($this->variables['lblLastPasswordChange']); ?>:</th>
						<td>
							<?php
					if(isset($this->variables['record']['settings']['last_password_change']) && count($this->variables['record']['settings']['last_password_change']) != 0 && $this->variables['record']['settings']['last_password_change'] != '' && $this->variables['record']['settings']['last_password_change'] !== false)
					{
						?><?php echo SpoonTemplateModifiers::date($this->variables['record']['settings']['last_password_change'], '' . $this->variables['authenticatedUserDateFormat'] .' ' . $this->variables['authenticatedUserTimeFormat'] .'', $this->variables['INTERFACE_LANGUAGE']); ?><?php } ?>
							<?php if(!isset($this->variables['record']['settings']['last_password_change']) || count($this->variables['record']['settings']['last_password_change']) == 0 || $this->variables['record']['settings']['last_password_change'] == '' || $this->variables['record']['settings']['last_password_change'] === false): ?><?php echo $this->variables['lblNever']; ?><?php endif; ?>
						</td>
					</tr>
				</table>
			</td>
		</tr>
	</table>

	<div id="tabs" class="tabs">
		<ul>
			<li><a href="#tabProfile"><?php echo SpoonFilter::ucfirst($this->variables['lblProfile']); ?></a></li>
			<?php
					if(isset($this->variables['allowPasswordEdit']) && count($this->variables['allowPasswordEdit']) != 0 && $this->variables['allowPasswordEdit'] != '' && $this->variables['allowPasswordEdit'] !== false)
					{
						?><li><a href="#tabPassword"><?php echo SpoonFilter::ucfirst($this->variables['lblPassword']); ?></a></li><?php } ?>
			<li><a href="#tabSettings"><?php echo SpoonFilter::ucfirst($this->variables['lblSettings']); ?></a></li>
			<?php
					if(isset($this->variables['allowUserRights']) && count($this->variables['allowUserRights']) != 0 && $this->variables['allowUserRights'] != '' && $this->variables['allowUserRights'] !== false)
					{
						?><li><a href="#tabPermissions"><?php echo SpoonFilter::ucfirst($this->variables['lblPermissions']); ?></a></li><?php } ?>
		</ul>

		<div id="tabProfile">
			<div class="subtleBox">
				<div class="heading">
					<h3><?php echo SpoonFilter::ucfirst($this->variables['lblPersonalInformation']); ?></h3>
				</div>
				<div class="options horizontal labelWidthLong">
					<p>
						<label for="email"><?php echo SpoonFilter::ucfirst($this->variables['lblEmail']); ?><abbr title="<?php echo $this->variables['lblRequiredField']; ?>">*</abbr></label>
						<?php echo $this->variables['txtEmail']; ?> <?php echo $this->variables['txtEmailError']; ?>
					</p>
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
		</div>

		<div id="tabSettings">
			<div class="subtleBox">
				<div class="heading">
					<h3><?php echo SpoonFilter::ucfirst($this->variables['lblInterfacePreferences']); ?></h3>
				</div>
				<div class="options horizontal labelWidthLong">
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

		<?php
					if(isset($this->variables['allowPasswordEdit']) && count($this->variables['allowPasswordEdit']) != 0 && $this->variables['allowPasswordEdit'] != '' && $this->variables['allowPasswordEdit'] !== false)
					{
						?>
		<div id="tabPassword">
			<?php
					if(isset($this->variables['showPasswordStrength']) && count($this->variables['showPasswordStrength']) != 0 && $this->variables['showPasswordStrength'] != '' && $this->variables['showPasswordStrength'] !== false)
					{
						?>
				<div class="subtleBox settingsUserInfo">
					<div class="heading">
						<h3><?php echo SpoonFilter::ucfirst($this->variables['lblCurrentPassword']); ?></h3>
					</div>
					<div class="options">
						<p>
							<label><?php echo SpoonFilter::ucfirst($this->variables['lblPasswordStrength']); ?></label>
							<span class="strength <?php echo $this->variables['record']['settings']['password_strength']; ?>"><?php echo SpoonFilter::ucfirst($this->variables['passwordStrengthLabel']); ?></span>
						</p>
					</div>
				</div>
			<?php } ?>

			<div class="subtleBox">
				<div class="heading">
					<h3><?php echo SpoonFilter::ucfirst($this->variables['lblChangePassword']); ?></h3>
				</div>
				<div class="options horizontal labelWidthLong">
					<p>
						<label for="newPassword"><?php echo SpoonFilter::ucfirst($this->variables['lblPassword']); ?></label>
						<?php echo $this->variables['txtNewPassword']; ?> <?php echo $this->variables['txtNewPasswordError']; ?>
					</p>
					<table id="passwordStrengthMeter" class="passwordStrength" data-id="newPassword">
						<tr>
							<td class="strength" id="passwordStrength">
								<p class="strength none">/</p>
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
						<label for="confirmPassword"><?php echo SpoonFilter::ucfirst($this->variables['lblConfirmPassword']); ?></label>
						<?php echo $this->variables['txtConfirmPassword']; ?> <?php echo $this->variables['txtConfirmPasswordError']; ?>
					</p>
				</div>
			</div>
		</div>
		<?php } ?>

		<?php
					if(isset($this->variables['allowUserRights']) && count($this->variables['allowUserRights']) != 0 && $this->variables['allowUserRights'] != '' && $this->variables['allowUserRights'] !== false)
					{
						?>
		<div id="tabPermissions">
			<div class="subtleBox">
				<div class="heading">
					<h3><?php echo SpoonFilter::ucfirst($this->variables['lblAccountManagement']); ?></h3>
				</div>

				<div class="options">
					<ul class="inputList">
						<li><?php echo $this->variables['chkActive']; ?> <label for="active"><?php echo $this->variables['msgHelpActive']; ?></label> <?php echo $this->variables['chkActiveError']; ?></li>
						<li><?php echo $this->variables['chkApiAccess']; ?> <label for="apiAccess"><?php echo $this->variables['msgHelpAPIAccess']; ?></label> <?php echo $this->variables['chkApiAccessError']; ?></li>
					</ul>
					<p><?php echo SpoonFilter::ucfirst($this->variables['lblGroups']); ?></p>
					<ul id="groupList" class="inputList">
						<?php
				if(isset(${'groups'})) $this->iterations['7f5631ee27c436247e5b6ca6cd1b52c2_Edit.tpl.php_1']['old'] = ${'groups'};
				$this->iterations['7f5631ee27c436247e5b6ca6cd1b52c2_Edit.tpl.php_1']['iteration'] = $this->variables['groups'];
				$this->iterations['7f5631ee27c436247e5b6ca6cd1b52c2_Edit.tpl.php_1']['i'] = 1;
				$this->iterations['7f5631ee27c436247e5b6ca6cd1b52c2_Edit.tpl.php_1']['count'] = count($this->iterations['7f5631ee27c436247e5b6ca6cd1b52c2_Edit.tpl.php_1']['iteration']);
				foreach((array) $this->iterations['7f5631ee27c436247e5b6ca6cd1b52c2_Edit.tpl.php_1']['iteration'] as ${'groups'})
				{
					if(!isset(${'groups'}['first']) && $this->iterations['7f5631ee27c436247e5b6ca6cd1b52c2_Edit.tpl.php_1']['i'] == 1) ${'groups'}['first'] = true;
					if(!isset(${'groups'}['last']) && $this->iterations['7f5631ee27c436247e5b6ca6cd1b52c2_Edit.tpl.php_1']['i'] == $this->iterations['7f5631ee27c436247e5b6ca6cd1b52c2_Edit.tpl.php_1']['count']) ${'groups'}['last'] = true;
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
					$this->iterations['7f5631ee27c436247e5b6ca6cd1b52c2_Edit.tpl.php_1']['i']++;
				}
				if(isset($this->iterations['7f5631ee27c436247e5b6ca6cd1b52c2_Edit.tpl.php_1']['old'])) ${'groups'} = $this->iterations['7f5631ee27c436247e5b6ca6cd1b52c2_Edit.tpl.php_1']['old'];
				else unset($this->iterations['7f5631ee27c436247e5b6ca6cd1b52c2_Edit.tpl.php_1']);
				?>
					</ul>
					<?php echo $this->variables['chkGroupsError']; ?>
				</div>
			</div>
		</div>
        <?php } ?>
	</div>

	<div class="fullwidthOptions">
		<?php
					if(isset($this->variables['showUsersDelete']) && count($this->variables['showUsersDelete']) != 0 && $this->variables['showUsersDelete'] != '' && $this->variables['showUsersDelete'] !== false)
					{
						?>
			<a href="<?php echo Backend\Core\Engine\TemplateModifiers::getURL($this->variables['var'], 'delete'); ?>&amp;id=<?php echo $this->variables['record']['id']; ?>" data-message-id="confirmDelete" class="askConfirmation button linkButton icon iconDelete">
				<span><?php echo SpoonFilter::ucfirst($this->variables['lblDelete']); ?></span>
			</a>
		<?php } ?>

		<div class="buttonHolderRight">
			<input id="editButton" class="inputButton button mainButton" type="submit" name="edit" value="<?php echo SpoonFilter::ucfirst($this->variables['lblSave']); ?>" />
		</div>
	</div>

	<div id="confirmDelete" title="<?php echo SpoonFilter::ucfirst($this->variables['lblDelete']); ?>?" style="display: none;">
		<p>
			<?php echo sprintf($this->variables['msgConfirmDelete'], $this->variables['record']['settings']['nickname']); ?>
		</p>
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
