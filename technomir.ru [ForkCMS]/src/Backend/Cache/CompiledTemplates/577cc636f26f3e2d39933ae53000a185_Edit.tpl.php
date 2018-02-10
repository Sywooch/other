<?php error_reporting(E_ALL | E_STRICT); ini_set('display_errors', 'On'); ?>
<?php
				ob_start();
				?><?php if(array_key_exists('BACKEND_CORE_PATH', (array) $this->variables)) { echo $this->variables['BACKEND_CORE_PATH']; } else { ?>{$BACKEND_CORE_PATH}<?php } ?>/Layout/Templates/Head.tpl<?php
				$include = eval('return \'' . str_replace('\'', '\\\'', ob_get_clean()) .'\';');
				if($this->getForceCompile() || !file_exists($this->getCompileDirectory() .'/' . $this->getCompileName($include, 'J:\home\technomir.com\www\src\Backend\Modules\Users\Layout\Templates'))) $this->compile('J:\home\technomir.com\www\src\Backend\Modules\Users\Layout\Templates', $include);
				$return = @include $this->getCompileDirectory() .'/' . $this->getCompileName($include, 'J:\home\technomir.com\www\src\Backend\Modules\Users\Layout\Templates');
				if($return === false && $this->compile('J:\home\technomir.com\www\src\Backend\Modules\Users\Layout\Templates', $include))
				{
					$return = @include $this->getCompileDirectory() .'/' . $this->getCompileName($include, 'J:\home\technomir.com\www\src\Backend\Modules\Users\Layout\Templates');
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
				if($this->getForceCompile() || !file_exists($this->getCompileDirectory() .'/' . $this->getCompileName($include, 'J:\home\technomir.com\www\src\Backend\Modules\Users\Layout\Templates'))) $this->compile('J:\home\technomir.com\www\src\Backend\Modules\Users\Layout\Templates', $include);
				$return = @include $this->getCompileDirectory() .'/' . $this->getCompileName($include, 'J:\home\technomir.com\www\src\Backend\Modules\Users\Layout\Templates');
				if($return === false && $this->compile('J:\home\technomir.com\www\src\Backend\Modules\Users\Layout\Templates', $include))
				{
					$return = @include $this->getCompileDirectory() .'/' . $this->getCompileName($include, 'J:\home\technomir.com\www\src\Backend\Modules\Users\Layout\Templates');
				}
if($return === false)
				{
					?>{include:<?php if(array_key_exists('BACKEND_CORE_PATH', (array) $this->variables)) { echo $this->variables['BACKEND_CORE_PATH']; } else { ?>{$BACKEND_CORE_PATH}<?php } ?>/Layout/Templates/StructureStartModule.tpl}<?php
				}
?>

<div class="pageTitle">
	<h2><?php if(array_key_exists('lblUsers', (array) $this->variables)) { echo SpoonFilter::ucfirst($this->variables['lblUsers']); } else { ?>{$lblUsers|ucfirst}<?php } ?>: <?php if(array_key_exists('msgEditUser', (array) $this->variables) && isset($this->variables['record']['settings']) && array_key_exists('nickname', (array) $this->variables['record']['settings'])) { echo sprintf($this->variables['msgEditUser'], $this->variables['record']['settings']['nickname']); } else { ?>{$msgEditUser|sprintf:<?php if(isset($this->variables['record']['settings']) && array_key_exists('nickname', (array) $this->variables['record']['settings'])) { echo $this->variables['record']['settings']['nickname']; } else { ?>{$record.settings.nickname}<?php } ?>}<?php } ?></h2>
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
						<img src="<?php if(array_key_exists('FRONTEND_FILES_URL', (array) $this->variables)) { echo $this->variables['FRONTEND_FILES_URL']; } else { ?>{$FRONTEND_FILES_URL}<?php } ?>/backend_users/avatars/64x64/<?php if(isset($this->variables['record']['settings']) && array_key_exists('avatar', (array) $this->variables['record']['settings'])) { echo $this->variables['record']['settings']['avatar']; } else { ?>{$record.settings.avatar}<?php } ?>" width="48" height="48" alt="" />
					<?php } ?>
				</div>
			</td>
			<td>
				<table class="infoGrid">
					<tr>
						<th><?php if(array_key_exists('lblName', (array) $this->variables)) { echo SpoonFilter::ucfirst($this->variables['lblName']); } else { ?>{$lblName|ucfirst}<?php } ?>:</th>
						<td><strong><?php if(isset($this->variables['record']['settings']) && array_key_exists('name', (array) $this->variables['record']['settings'])) { echo $this->variables['record']['settings']['name']; } else { ?>{$record.settings.name}<?php } ?> <?php if(isset($this->variables['record']['settings']) && array_key_exists('surname', (array) $this->variables['record']['settings'])) { echo $this->variables['record']['settings']['surname']; } else { ?>{$record.settings.surname}<?php } ?></strong></td>
					</tr>
					<tr>
						<th><?php if(array_key_exists('lblNickname', (array) $this->variables)) { echo SpoonFilter::ucfirst($this->variables['lblNickname']); } else { ?>{$lblNickname|ucfirst}<?php } ?>:</th>
						<td><?php if(isset($this->variables['record']['settings']) && array_key_exists('nickname', (array) $this->variables['record']['settings'])) { echo $this->variables['record']['settings']['nickname']; } else { ?>{$record.settings.nickname}<?php } ?></td>
					</tr>
					<tr>
						<th><?php if(array_key_exists('lblEmail', (array) $this->variables)) { echo SpoonFilter::ucfirst($this->variables['lblEmail']); } else { ?>{$lblEmail|ucfirst}<?php } ?>:</th>
						<td><?php if(isset($this->variables['record']) && array_key_exists('email', (array) $this->variables['record'])) { echo $this->variables['record']['email']; } else { ?>{$record.email}<?php } ?></td>
					</tr>
					<tr>
						<th><?php if(array_key_exists('lblLastLogin', (array) $this->variables)) { echo SpoonFilter::ucfirst($this->variables['lblLastLogin']); } else { ?>{$lblLastLogin|ucfirst}<?php } ?>:</th>
						<td>
							<?php
					if(isset($this->variables['record']['settings']['last_login']) && count($this->variables['record']['settings']['last_login']) != 0 && $this->variables['record']['settings']['last_login'] != '' && $this->variables['record']['settings']['last_login'] !== false)
					{
						?><?php if(isset($this->variables['record']['settings']) && array_key_exists('last_login', (array) $this->variables['record']['settings']) && array_key_exists('authenticatedUserDateFormat', (array) $this->variables) && array_key_exists('authenticatedUserTimeFormat', (array) $this->variables) && array_key_exists('INTERFACE_LANGUAGE', (array) $this->variables)) { echo SpoonTemplateModifiers::date($this->variables['record']['settings']['last_login'], '' . $this->variables['authenticatedUserDateFormat'] .' ' . $this->variables['authenticatedUserTimeFormat'] .'', $this->variables['INTERFACE_LANGUAGE']); } else { ?>{$record.settings.last_login|date:'<?php if(array_key_exists('authenticatedUserDateFormat', (array) $this->variables)) { echo $this->variables['authenticatedUserDateFormat']; } else { ?>{$authenticatedUserDateFormat}<?php } ?> <?php if(array_key_exists('authenticatedUserTimeFormat', (array) $this->variables)) { echo $this->variables['authenticatedUserTimeFormat']; } else { ?>{$authenticatedUserTimeFormat}<?php } ?>':<?php if(array_key_exists('INTERFACE_LANGUAGE', (array) $this->variables)) { echo $this->variables['INTERFACE_LANGUAGE']; } else { ?>{$INTERFACE_LANGUAGE}<?php } ?>}<?php } ?><?php } ?>
							<?php if(!isset($this->variables['record']['settings']['last_login']) || count($this->variables['record']['settings']['last_login']) == 0 || $this->variables['record']['settings']['last_login'] == '' || $this->variables['record']['settings']['last_login'] === false): ?><?php if(array_key_exists('lblNoPreviousLogin', (array) $this->variables)) { echo $this->variables['lblNoPreviousLogin']; } else { ?>{$lblNoPreviousLogin}<?php } ?><?php endif; ?>
						</td>
					</tr>
					<?php
					if(isset($this->variables['record']['settings']['last_failed_login_attempt']) && count($this->variables['record']['settings']['last_failed_login_attempt']) != 0 && $this->variables['record']['settings']['last_failed_login_attempt'] != '' && $this->variables['record']['settings']['last_failed_login_attempt'] !== false)
					{
						?>
						<tr>
							<th><?php if(array_key_exists('lblLastFailedLoginAttempt', (array) $this->variables)) { echo SpoonFilter::ucfirst($this->variables['lblLastFailedLoginAttempt']); } else { ?>{$lblLastFailedLoginAttempt|ucfirst}<?php } ?>:</th>
							<td><?php if(isset($this->variables['record']['settings']) && array_key_exists('last_failed_login_attempt', (array) $this->variables['record']['settings']) && array_key_exists('authenticatedUserDateFormat', (array) $this->variables) && array_key_exists('authenticatedUserTimeFormat', (array) $this->variables) && array_key_exists('INTERFACE_LANGUAGE', (array) $this->variables)) { echo SpoonTemplateModifiers::date($this->variables['record']['settings']['last_failed_login_attempt'], '' . $this->variables['authenticatedUserDateFormat'] .' ' . $this->variables['authenticatedUserTimeFormat'] .'', $this->variables['INTERFACE_LANGUAGE']); } else { ?>{$record.settings.last_failed_login_attempt|date:'<?php if(array_key_exists('authenticatedUserDateFormat', (array) $this->variables)) { echo $this->variables['authenticatedUserDateFormat']; } else { ?>{$authenticatedUserDateFormat}<?php } ?> <?php if(array_key_exists('authenticatedUserTimeFormat', (array) $this->variables)) { echo $this->variables['authenticatedUserTimeFormat']; } else { ?>{$authenticatedUserTimeFormat}<?php } ?>':<?php if(array_key_exists('INTERFACE_LANGUAGE', (array) $this->variables)) { echo $this->variables['INTERFACE_LANGUAGE']; } else { ?>{$INTERFACE_LANGUAGE}<?php } ?>}<?php } ?></td>
						</tr>
					<?php } ?>
					<tr>
						<th><?php if(array_key_exists('lblLastPasswordChange', (array) $this->variables)) { echo SpoonFilter::ucfirst($this->variables['lblLastPasswordChange']); } else { ?>{$lblLastPasswordChange|ucfirst}<?php } ?>:</th>
						<td>
							<?php
					if(isset($this->variables['record']['settings']['last_password_change']) && count($this->variables['record']['settings']['last_password_change']) != 0 && $this->variables['record']['settings']['last_password_change'] != '' && $this->variables['record']['settings']['last_password_change'] !== false)
					{
						?><?php if(isset($this->variables['record']['settings']) && array_key_exists('last_password_change', (array) $this->variables['record']['settings']) && array_key_exists('authenticatedUserDateFormat', (array) $this->variables) && array_key_exists('authenticatedUserTimeFormat', (array) $this->variables) && array_key_exists('INTERFACE_LANGUAGE', (array) $this->variables)) { echo SpoonTemplateModifiers::date($this->variables['record']['settings']['last_password_change'], '' . $this->variables['authenticatedUserDateFormat'] .' ' . $this->variables['authenticatedUserTimeFormat'] .'', $this->variables['INTERFACE_LANGUAGE']); } else { ?>{$record.settings.last_password_change|date:'<?php if(array_key_exists('authenticatedUserDateFormat', (array) $this->variables)) { echo $this->variables['authenticatedUserDateFormat']; } else { ?>{$authenticatedUserDateFormat}<?php } ?> <?php if(array_key_exists('authenticatedUserTimeFormat', (array) $this->variables)) { echo $this->variables['authenticatedUserTimeFormat']; } else { ?>{$authenticatedUserTimeFormat}<?php } ?>':<?php if(array_key_exists('INTERFACE_LANGUAGE', (array) $this->variables)) { echo $this->variables['INTERFACE_LANGUAGE']; } else { ?>{$INTERFACE_LANGUAGE}<?php } ?>}<?php } ?><?php } ?>
							<?php if(!isset($this->variables['record']['settings']['last_password_change']) || count($this->variables['record']['settings']['last_password_change']) == 0 || $this->variables['record']['settings']['last_password_change'] == '' || $this->variables['record']['settings']['last_password_change'] === false): ?><?php if(array_key_exists('lblNever', (array) $this->variables)) { echo $this->variables['lblNever']; } else { ?>{$lblNever}<?php } ?><?php endif; ?>
						</td>
					</tr>
				</table>
			</td>
		</tr>
	</table>

	<div id="tabs" class="tabs">
		<ul>
			<li><a href="#tabProfile"><?php if(array_key_exists('lblProfile', (array) $this->variables)) { echo SpoonFilter::ucfirst($this->variables['lblProfile']); } else { ?>{$lblProfile|ucfirst}<?php } ?></a></li>
			<?php
					if(isset($this->variables['allowPasswordEdit']) && count($this->variables['allowPasswordEdit']) != 0 && $this->variables['allowPasswordEdit'] != '' && $this->variables['allowPasswordEdit'] !== false)
					{
						?><li><a href="#tabPassword"><?php if(array_key_exists('lblPassword', (array) $this->variables)) { echo SpoonFilter::ucfirst($this->variables['lblPassword']); } else { ?>{$lblPassword|ucfirst}<?php } ?></a></li><?php } ?>
			<li><a href="#tabSettings"><?php if(array_key_exists('lblSettings', (array) $this->variables)) { echo SpoonFilter::ucfirst($this->variables['lblSettings']); } else { ?>{$lblSettings|ucfirst}<?php } ?></a></li>
			<?php
					if(isset($this->variables['allowUserRights']) && count($this->variables['allowUserRights']) != 0 && $this->variables['allowUserRights'] != '' && $this->variables['allowUserRights'] !== false)
					{
						?><li><a href="#tabPermissions"><?php if(array_key_exists('lblPermissions', (array) $this->variables)) { echo SpoonFilter::ucfirst($this->variables['lblPermissions']); } else { ?>{$lblPermissions|ucfirst}<?php } ?></a></li><?php } ?>
		</ul>

		<div id="tabProfile">
			<div class="subtleBox">
				<div class="heading">
					<h3><?php if(array_key_exists('lblPersonalInformation', (array) $this->variables)) { echo SpoonFilter::ucfirst($this->variables['lblPersonalInformation']); } else { ?>{$lblPersonalInformation|ucfirst}<?php } ?></h3>
				</div>
				<div class="options horizontal labelWidthLong">
					<p>
						<label for="email"><?php if(array_key_exists('lblEmail', (array) $this->variables)) { echo SpoonFilter::ucfirst($this->variables['lblEmail']); } else { ?>{$lblEmail|ucfirst}<?php } ?><abbr title="<?php if(array_key_exists('lblRequiredField', (array) $this->variables)) { echo $this->variables['lblRequiredField']; } else { ?>{$lblRequiredField}<?php } ?>">*</abbr></label>
						<?php if(array_key_exists('txtEmail', (array) $this->variables)) { echo $this->variables['txtEmail']; } else { ?>{$txtEmail}<?php } ?> <?php if(array_key_exists('txtEmailError', (array) $this->variables)) { echo $this->variables['txtEmailError']; } else { ?>{$txtEmailError}<?php } ?>
					</p>
					<p>
						<label for="name"><?php if(array_key_exists('lblName', (array) $this->variables)) { echo SpoonFilter::ucfirst($this->variables['lblName']); } else { ?>{$lblName|ucfirst}<?php } ?><abbr title="<?php if(array_key_exists('lblRequiredField', (array) $this->variables)) { echo $this->variables['lblRequiredField']; } else { ?>{$lblRequiredField}<?php } ?>">*</abbr></label>
						<?php if(array_key_exists('txtName', (array) $this->variables)) { echo $this->variables['txtName']; } else { ?>{$txtName}<?php } ?> <?php if(array_key_exists('txtNameError', (array) $this->variables)) { echo $this->variables['txtNameError']; } else { ?>{$txtNameError}<?php } ?>
					</p>
					<p>
						<label for="surname"><?php if(array_key_exists('lblSurname', (array) $this->variables)) { echo SpoonFilter::ucfirst($this->variables['lblSurname']); } else { ?>{$lblSurname|ucfirst}<?php } ?><abbr title="<?php if(array_key_exists('lblRequiredField', (array) $this->variables)) { echo $this->variables['lblRequiredField']; } else { ?>{$lblRequiredField}<?php } ?>">*</abbr></label>
						<?php if(array_key_exists('txtSurname', (array) $this->variables)) { echo $this->variables['txtSurname']; } else { ?>{$txtSurname}<?php } ?> <?php if(array_key_exists('txtSurnameError', (array) $this->variables)) { echo $this->variables['txtSurnameError']; } else { ?>{$txtSurnameError}<?php } ?>
					</p>
					<p>
						<label for="nickname"><?php if(array_key_exists('lblNickname', (array) $this->variables)) { echo SpoonFilter::ucfirst($this->variables['lblNickname']); } else { ?>{$lblNickname|ucfirst}<?php } ?><abbr title="<?php if(array_key_exists('lblRequiredField', (array) $this->variables)) { echo $this->variables['lblRequiredField']; } else { ?>{$lblRequiredField}<?php } ?>">*</abbr></label>
						<?php if(array_key_exists('txtNickname', (array) $this->variables)) { echo $this->variables['txtNickname']; } else { ?>{$txtNickname}<?php } ?> <?php if(array_key_exists('txtNicknameError', (array) $this->variables)) { echo $this->variables['txtNicknameError']; } else { ?>{$txtNicknameError}<?php } ?>
						<span class="helpTxt"><?php if(array_key_exists('msgHelpNickname', (array) $this->variables)) { echo $this->variables['msgHelpNickname']; } else { ?>{$msgHelpNickname}<?php } ?></span>
					</p>
					<p>
						<label for="avatar"><?php if(array_key_exists('lblAvatar', (array) $this->variables)) { echo SpoonFilter::ucfirst($this->variables['lblAvatar']); } else { ?>{$lblAvatar|ucfirst}<?php } ?></label>
						<?php if(array_key_exists('fileAvatar', (array) $this->variables)) { echo $this->variables['fileAvatar']; } else { ?>{$fileAvatar}<?php } ?> <?php if(array_key_exists('fileAvatarError', (array) $this->variables)) { echo $this->variables['fileAvatarError']; } else { ?>{$fileAvatarError}<?php } ?>
						<span class="helpTxt"><?php if(array_key_exists('msgHelpAvatar', (array) $this->variables)) { echo $this->variables['msgHelpAvatar']; } else { ?>{$msgHelpAvatar}<?php } ?></span>
					</p>
				</div>
			</div>
		</div>

		<div id="tabSettings">
			<div class="subtleBox">
				<div class="heading">
					<h3><?php if(array_key_exists('lblInterfacePreferences', (array) $this->variables)) { echo SpoonFilter::ucfirst($this->variables['lblInterfacePreferences']); } else { ?>{$lblInterfacePreferences|ucfirst}<?php } ?></h3>
				</div>
				<div class="options horizontal labelWidthLong">
					<p>
						<label for="interfaceLanguage"><?php if(array_key_exists('lblLanguage', (array) $this->variables)) { echo SpoonFilter::ucfirst($this->variables['lblLanguage']); } else { ?>{$lblLanguage|ucfirst}<?php } ?></label>
						<?php if(array_key_exists('ddmInterfaceLanguage', (array) $this->variables)) { echo $this->variables['ddmInterfaceLanguage']; } else { ?>{$ddmInterfaceLanguage}<?php } ?> <?php if(array_key_exists('ddmInterfaceLanguageError', (array) $this->variables)) { echo $this->variables['ddmInterfaceLanguageError']; } else { ?>{$ddmInterfaceLanguageError}<?php } ?>
					</p>
					<p>
						<label for="dateFormat"><?php if(array_key_exists('lblDateFormat', (array) $this->variables)) { echo SpoonFilter::ucfirst($this->variables['lblDateFormat']); } else { ?>{$lblDateFormat|ucfirst}<?php } ?></label>
						<?php if(array_key_exists('ddmDateFormat', (array) $this->variables)) { echo $this->variables['ddmDateFormat']; } else { ?>{$ddmDateFormat}<?php } ?> <?php if(array_key_exists('ddmDateFormatError', (array) $this->variables)) { echo $this->variables['ddmDateFormatError']; } else { ?>{$ddmDateFormatError}<?php } ?>
					</p>
					<p>
						<label for="timeFormat"><?php if(array_key_exists('lblTimeFormat', (array) $this->variables)) { echo SpoonFilter::ucfirst($this->variables['lblTimeFormat']); } else { ?>{$lblTimeFormat|ucfirst}<?php } ?></label>
						<?php if(array_key_exists('ddmTimeFormat', (array) $this->variables)) { echo $this->variables['ddmTimeFormat']; } else { ?>{$ddmTimeFormat}<?php } ?> <?php if(array_key_exists('ddmTimeFormatError', (array) $this->variables)) { echo $this->variables['ddmTimeFormatError']; } else { ?>{$ddmTimeFormatError}<?php } ?>
					</p>
					<p>
						<label for="numberFormat"><?php if(array_key_exists('lblNumberFormat', (array) $this->variables)) { echo SpoonFilter::ucfirst($this->variables['lblNumberFormat']); } else { ?>{$lblNumberFormat|ucfirst}<?php } ?></label>
						<?php if(array_key_exists('ddmNumberFormat', (array) $this->variables)) { echo $this->variables['ddmNumberFormat']; } else { ?>{$ddmNumberFormat}<?php } ?> <?php if(array_key_exists('ddmNumberFormatError', (array) $this->variables)) { echo $this->variables['ddmNumberFormatError']; } else { ?>{$ddmNumberFormatError}<?php } ?>
					</p>
				</div>
			</div>
			<div class="subtleBox">
				<div class="heading">
					<h3><?php if(array_key_exists('lblCSV', (array) $this->variables)) { echo SpoonFilter::ucfirst($this->variables['lblCSV']); } else { ?>{$lblCSV|ucfirst}<?php } ?></h3>
				</div>
				<div class="options horizontal labelWidthLong">
					<p>
						<label for="csvSplitCharacter"><?php if(array_key_exists('lblSplitCharacter', (array) $this->variables)) { echo SpoonFilter::ucfirst($this->variables['lblSplitCharacter']); } else { ?>{$lblSplitCharacter|ucfirst}<?php } ?></label>
						<?php if(array_key_exists('ddmCsvSplitCharacter', (array) $this->variables)) { echo $this->variables['ddmCsvSplitCharacter']; } else { ?>{$ddmCsvSplitCharacter}<?php } ?> <?php if(array_key_exists('ddmCsvSplitCharacterError', (array) $this->variables)) { echo $this->variables['ddmCsvSplitCharacterError']; } else { ?>{$ddmCsvSplitCharacterError}<?php } ?>
					</p>
					<p>
						<label for="csvLineEnding"><?php if(array_key_exists('lblLineEnding', (array) $this->variables)) { echo SpoonFilter::ucfirst($this->variables['lblLineEnding']); } else { ?>{$lblLineEnding|ucfirst}<?php } ?></label>
						<?php if(array_key_exists('ddmCsvLineEnding', (array) $this->variables)) { echo $this->variables['ddmCsvLineEnding']; } else { ?>{$ddmCsvLineEnding}<?php } ?> <?php if(array_key_exists('ddmCsvLineEndingError', (array) $this->variables)) { echo $this->variables['ddmCsvLineEndingError']; } else { ?>{$ddmCsvLineEndingError}<?php } ?>
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
						<h3><?php if(array_key_exists('lblCurrentPassword', (array) $this->variables)) { echo SpoonFilter::ucfirst($this->variables['lblCurrentPassword']); } else { ?>{$lblCurrentPassword|ucfirst}<?php } ?></h3>
					</div>
					<div class="options">
						<p>
							<label><?php if(array_key_exists('lblPasswordStrength', (array) $this->variables)) { echo SpoonFilter::ucfirst($this->variables['lblPasswordStrength']); } else { ?>{$lblPasswordStrength|ucfirst}<?php } ?></label>
							<span class="strength <?php if(isset($this->variables['record']['settings']) && array_key_exists('password_strength', (array) $this->variables['record']['settings'])) { echo $this->variables['record']['settings']['password_strength']; } else { ?>{$record.settings.password_strength}<?php } ?>"><?php if(array_key_exists('passwordStrengthLabel', (array) $this->variables)) { echo SpoonFilter::ucfirst($this->variables['passwordStrengthLabel']); } else { ?>{$passwordStrengthLabel|ucfirst}<?php } ?></span>
						</p>
					</div>
				</div>
			<?php } ?>

			<div class="subtleBox">
				<div class="heading">
					<h3><?php if(array_key_exists('lblChangePassword', (array) $this->variables)) { echo SpoonFilter::ucfirst($this->variables['lblChangePassword']); } else { ?>{$lblChangePassword|ucfirst}<?php } ?></h3>
				</div>
				<div class="options horizontal labelWidthLong">
					<p>
						<label for="newPassword"><?php if(array_key_exists('lblPassword', (array) $this->variables)) { echo SpoonFilter::ucfirst($this->variables['lblPassword']); } else { ?>{$lblPassword|ucfirst}<?php } ?></label>
						<?php if(array_key_exists('txtNewPassword', (array) $this->variables)) { echo $this->variables['txtNewPassword']; } else { ?>{$txtNewPassword}<?php } ?> <?php if(array_key_exists('txtNewPasswordError', (array) $this->variables)) { echo $this->variables['txtNewPasswordError']; } else { ?>{$txtNewPasswordError}<?php } ?>
					</p>
					<table id="passwordStrengthMeter" class="passwordStrength" data-id="newPassword">
						<tr>
							<td class="strength" id="passwordStrength">
								<p class="strength none">/</p>
								<p class="strength weak"><?php if(array_key_exists('lblWeak', (array) $this->variables)) { echo SpoonFilter::ucfirst($this->variables['lblWeak']); } else { ?>{$lblWeak|ucfirst}<?php } ?></p>
								<p class="strength average"><?php if(array_key_exists('lblAverage', (array) $this->variables)) { echo SpoonFilter::ucfirst($this->variables['lblAverage']); } else { ?>{$lblAverage|ucfirst}<?php } ?></p>
								<p class="strength strong"><?php if(array_key_exists('lblStrong', (array) $this->variables)) { echo SpoonFilter::ucfirst($this->variables['lblStrong']); } else { ?>{$lblStrong|ucfirst}<?php } ?></p>
							</td>
							<td>
								<p class="helpTxt"><?php if(array_key_exists('msgHelpStrongPassword', (array) $this->variables)) { echo $this->variables['msgHelpStrongPassword']; } else { ?>{$msgHelpStrongPassword}<?php } ?></p>
							</td>
						</tr>
					</table>
					<p>
						<label for="confirmPassword"><?php if(array_key_exists('lblConfirmPassword', (array) $this->variables)) { echo SpoonFilter::ucfirst($this->variables['lblConfirmPassword']); } else { ?>{$lblConfirmPassword|ucfirst}<?php } ?></label>
						<?php if(array_key_exists('txtConfirmPassword', (array) $this->variables)) { echo $this->variables['txtConfirmPassword']; } else { ?>{$txtConfirmPassword}<?php } ?> <?php if(array_key_exists('txtConfirmPasswordError', (array) $this->variables)) { echo $this->variables['txtConfirmPasswordError']; } else { ?>{$txtConfirmPasswordError}<?php } ?>
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
					<h3><?php if(array_key_exists('lblAccountManagement', (array) $this->variables)) { echo SpoonFilter::ucfirst($this->variables['lblAccountManagement']); } else { ?>{$lblAccountManagement|ucfirst}<?php } ?></h3>
				</div>

				<div class="options">
					<ul class="inputList">
						<li><?php if(array_key_exists('chkActive', (array) $this->variables)) { echo $this->variables['chkActive']; } else { ?>{$chkActive}<?php } ?> <label for="active"><?php if(array_key_exists('msgHelpActive', (array) $this->variables)) { echo $this->variables['msgHelpActive']; } else { ?>{$msgHelpActive}<?php } ?></label> <?php if(array_key_exists('chkActiveError', (array) $this->variables)) { echo $this->variables['chkActiveError']; } else { ?>{$chkActiveError}<?php } ?></li>
						<li><?php if(array_key_exists('chkApiAccess', (array) $this->variables)) { echo $this->variables['chkApiAccess']; } else { ?>{$chkApiAccess}<?php } ?> <label for="apiAccess"><?php if(array_key_exists('msgHelpAPIAccess', (array) $this->variables)) { echo $this->variables['msgHelpAPIAccess']; } else { ?>{$msgHelpAPIAccess}<?php } ?></label> <?php if(array_key_exists('chkApiAccessError', (array) $this->variables)) { echo $this->variables['chkApiAccessError']; } else { ?>{$chkApiAccessError}<?php } ?></li>
					</ul>
					<p><?php if(array_key_exists('lblGroups', (array) $this->variables)) { echo SpoonFilter::ucfirst($this->variables['lblGroups']); } else { ?>{$lblGroups|ucfirst}<?php } ?></p>
					<ul id="groupList" class="inputList">
						<?php
					if(!isset($this->variables['groups']))
					{
						?>{iteration:groups}<?php
						$this->variables['groups'] = array();
						$this->iterations['577cc636f26f3e2d39933ae53000a185_Edit.tpl.php_1']['fail'] = true;
					}
				if(isset(${'groups'})) $this->iterations['577cc636f26f3e2d39933ae53000a185_Edit.tpl.php_1']['old'] = ${'groups'};
				$this->iterations['577cc636f26f3e2d39933ae53000a185_Edit.tpl.php_1']['iteration'] = $this->variables['groups'];
				$this->iterations['577cc636f26f3e2d39933ae53000a185_Edit.tpl.php_1']['i'] = 1;
				$this->iterations['577cc636f26f3e2d39933ae53000a185_Edit.tpl.php_1']['count'] = count($this->iterations['577cc636f26f3e2d39933ae53000a185_Edit.tpl.php_1']['iteration']);
				foreach((array) $this->iterations['577cc636f26f3e2d39933ae53000a185_Edit.tpl.php_1']['iteration'] as ${'groups'})
				{
					if(!isset(${'groups'}['first']) && $this->iterations['577cc636f26f3e2d39933ae53000a185_Edit.tpl.php_1']['i'] == 1) ${'groups'}['first'] = true;
					if(!isset(${'groups'}['last']) && $this->iterations['577cc636f26f3e2d39933ae53000a185_Edit.tpl.php_1']['i'] == $this->iterations['577cc636f26f3e2d39933ae53000a185_Edit.tpl.php_1']['count']) ${'groups'}['last'] = true;
					if(isset(${'groups'}['formElements']) && is_array(${'groups'}['formElements']))
					{
						foreach(${'groups'}['formElements'] as $name => $object)
						{
							${'groups'}[$name] = $object->parse();
							${'groups'}[$name .'Error'] = (is_callable(array($object, 'getErrors')) && $object->getErrors() != '') ? '<span class="formError">' . $object->getErrors() .'</span>' : '';
						}
					} ?>
							<li><?php if(array_key_exists('chkGroups', (array) ${'groups'})) { echo ${'groups'}['chkGroups']; } else { ?>{$groups->chkGroups}<?php } ?> <label for="<?php if(array_key_exists('id', (array) ${'groups'})) { echo ${'groups'}['id']; } else { ?>{$groups->id}<?php } ?>"><?php if(array_key_exists('label', (array) ${'groups'})) { echo ${'groups'}['label']; } else { ?>{$groups->label}<?php } ?></label></li>
						<?php
					$this->iterations['577cc636f26f3e2d39933ae53000a185_Edit.tpl.php_1']['i']++;
				}
					if(isset($this->iterations['577cc636f26f3e2d39933ae53000a185_Edit.tpl.php_1']['fail']) && $this->iterations['577cc636f26f3e2d39933ae53000a185_Edit.tpl.php_1']['fail'] == true)
					{
						?>{/iteration:groups}<?php
					}
				if(isset($this->iterations['577cc636f26f3e2d39933ae53000a185_Edit.tpl.php_1']['old'])) ${'groups'} = $this->iterations['577cc636f26f3e2d39933ae53000a185_Edit.tpl.php_1']['old'];
				else unset($this->iterations['577cc636f26f3e2d39933ae53000a185_Edit.tpl.php_1']);
				?>
					</ul>
					<?php if(array_key_exists('chkGroupsError', (array) $this->variables)) { echo $this->variables['chkGroupsError']; } else { ?>{$chkGroupsError}<?php } ?>
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
			<a href="<?php if(array_key_exists('var', (array) $this->variables)) { echo Backend\Core\Engine\TemplateModifiers::getURL($this->variables['var'], 'delete'); } else { ?>{$var|geturl:'delete'}<?php } ?>&amp;id=<?php if(isset($this->variables['record']) && array_key_exists('id', (array) $this->variables['record'])) { echo $this->variables['record']['id']; } else { ?>{$record.id}<?php } ?>" data-message-id="confirmDelete" class="askConfirmation button linkButton icon iconDelete">
				<span><?php if(array_key_exists('lblDelete', (array) $this->variables)) { echo SpoonFilter::ucfirst($this->variables['lblDelete']); } else { ?>{$lblDelete|ucfirst}<?php } ?></span>
			</a>
		<?php } ?>

		<div class="buttonHolderRight">
			<input id="editButton" class="inputButton button mainButton" type="submit" name="edit" value="<?php if(array_key_exists('lblSave', (array) $this->variables)) { echo SpoonFilter::ucfirst($this->variables['lblSave']); } else { ?>{$lblSave|ucfirst}<?php } ?>" />
		</div>
	</div>

	<div id="confirmDelete" title="<?php if(array_key_exists('lblDelete', (array) $this->variables)) { echo SpoonFilter::ucfirst($this->variables['lblDelete']); } else { ?>{$lblDelete|ucfirst}<?php } ?>?" style="display: none;">
		<p>
			<?php if(array_key_exists('msgConfirmDelete', (array) $this->variables) && isset($this->variables['record']['settings']) && array_key_exists('nickname', (array) $this->variables['record']['settings'])) { echo sprintf($this->variables['msgConfirmDelete'], $this->variables['record']['settings']['nickname']); } else { ?>{$msgConfirmDelete|sprintf:<?php if(isset($this->variables['record']['settings']) && array_key_exists('nickname', (array) $this->variables['record']['settings'])) { echo $this->variables['record']['settings']['nickname']; } else { ?>{$record.settings.nickname}<?php } ?>}<?php } ?>
		</p>
	</div>
</form>
				<?php } ?>

<?php
				ob_start();
				?><?php if(array_key_exists('BACKEND_CORE_PATH', (array) $this->variables)) { echo $this->variables['BACKEND_CORE_PATH']; } else { ?>{$BACKEND_CORE_PATH}<?php } ?>/Layout/Templates/StructureEndModule.tpl<?php
				$include = eval('return \'' . str_replace('\'', '\\\'', ob_get_clean()) .'\';');
				if($this->getForceCompile() || !file_exists($this->getCompileDirectory() .'/' . $this->getCompileName($include, 'J:\home\technomir.com\www\src\Backend\Modules\Users\Layout\Templates'))) $this->compile('J:\home\technomir.com\www\src\Backend\Modules\Users\Layout\Templates', $include);
				$return = @include $this->getCompileDirectory() .'/' . $this->getCompileName($include, 'J:\home\technomir.com\www\src\Backend\Modules\Users\Layout\Templates');
				if($return === false && $this->compile('J:\home\technomir.com\www\src\Backend\Modules\Users\Layout\Templates', $include))
				{
					$return = @include $this->getCompileDirectory() .'/' . $this->getCompileName($include, 'J:\home\technomir.com\www\src\Backend\Modules\Users\Layout\Templates');
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
				if($this->getForceCompile() || !file_exists($this->getCompileDirectory() .'/' . $this->getCompileName($include, 'J:\home\technomir.com\www\src\Backend\Modules\Users\Layout\Templates'))) $this->compile('J:\home\technomir.com\www\src\Backend\Modules\Users\Layout\Templates', $include);
				$return = @include $this->getCompileDirectory() .'/' . $this->getCompileName($include, 'J:\home\technomir.com\www\src\Backend\Modules\Users\Layout\Templates');
				if($return === false && $this->compile('J:\home\technomir.com\www\src\Backend\Modules\Users\Layout\Templates', $include))
				{
					$return = @include $this->getCompileDirectory() .'/' . $this->getCompileName($include, 'J:\home\technomir.com\www\src\Backend\Modules\Users\Layout\Templates');
				}
if($return === false)
				{
					?>{include:<?php if(array_key_exists('BACKEND_CORE_PATH', (array) $this->variables)) { echo $this->variables['BACKEND_CORE_PATH']; } else { ?>{$BACKEND_CORE_PATH}<?php } ?>/Layout/Templates/Footer.tpl}<?php
				}
?>
