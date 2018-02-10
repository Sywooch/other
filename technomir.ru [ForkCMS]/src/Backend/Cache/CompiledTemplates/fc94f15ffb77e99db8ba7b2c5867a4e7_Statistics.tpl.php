<?php error_reporting(E_ALL | E_STRICT); ini_set('display_errors', 'On'); ?>
<div class="box" id="widgetUsersStatistics">
	<div class="heading">
		<h3><a href="<?php if(array_key_exists('authenticatedUserEditUrl', (array) $this->variables)) { echo $this->variables['authenticatedUserEditUrl']; } else { ?>{$authenticatedUserEditUrl}<?php } ?>"><?php if(array_key_exists('lblUsers', (array) $this->variables)) { echo SpoonFilter::ucfirst($this->variables['lblUsers']); } else { ?>{$lblUsers|ucfirst}<?php } ?>: <?php if(array_key_exists('lblStatistics', (array) $this->variables)) { echo SpoonFilter::ucfirst($this->variables['lblStatistics']); } else { ?>{$lblStatistics|ucfirst}<?php } ?></a></h3>
	</div>

	<div class="options settingsUserInfo">
		<table class="infoGrid m0">
			<tr>
				<th><?php if(array_key_exists('lblLastLogin', (array) $this->variables)) { echo SpoonFilter::ucfirst($this->variables['lblLastLogin']); } else { ?>{$lblLastLogin|ucfirst}<?php } ?>:</th>
				<td>
					<?php
					if(isset($this->variables['authenticatedUserLastLogin']) && count($this->variables['authenticatedUserLastLogin']) != 0 && $this->variables['authenticatedUserLastLogin'] != '' && $this->variables['authenticatedUserLastLogin'] !== false)
					{
						?><?php if(array_key_exists('authenticatedUserLastLogin', (array) $this->variables) && array_key_exists('authenticatedUserDateFormat', (array) $this->variables) && array_key_exists('authenticatedUserTimeFormat', (array) $this->variables) && array_key_exists('INTERFACE_LANGUAGE', (array) $this->variables)) { echo SpoonTemplateModifiers::date($this->variables['authenticatedUserLastLogin'], '' . $this->variables['authenticatedUserDateFormat'] .' ' . $this->variables['authenticatedUserTimeFormat'] .'', $this->variables['INTERFACE_LANGUAGE']); } else { ?>{$authenticatedUserLastLogin|date:'<?php if(array_key_exists('authenticatedUserDateFormat', (array) $this->variables)) { echo $this->variables['authenticatedUserDateFormat']; } else { ?>{$authenticatedUserDateFormat}<?php } ?> <?php if(array_key_exists('authenticatedUserTimeFormat', (array) $this->variables)) { echo $this->variables['authenticatedUserTimeFormat']; } else { ?>{$authenticatedUserTimeFormat}<?php } ?>':<?php if(array_key_exists('INTERFACE_LANGUAGE', (array) $this->variables)) { echo $this->variables['INTERFACE_LANGUAGE']; } else { ?>{$INTERFACE_LANGUAGE}<?php } ?>}<?php } ?><?php } ?>
					<?php if(!isset($this->variables['authenticatedUserLastLogin']) || count($this->variables['authenticatedUserLastLogin']) == 0 || $this->variables['authenticatedUserLastLogin'] == '' || $this->variables['authenticatedUserLastLogin'] === false): ?><?php if(array_key_exists('lblNoPreviousLogin', (array) $this->variables)) { echo $this->variables['lblNoPreviousLogin']; } else { ?>{$lblNoPreviousLogin}<?php } ?><?php endif; ?>
				</td>
			</tr>
			<?php
					if(isset($this->variables['authenticatedUserLastFailedLoginAttempt']) && count($this->variables['authenticatedUserLastFailedLoginAttempt']) != 0 && $this->variables['authenticatedUserLastFailedLoginAttempt'] != '' && $this->variables['authenticatedUserLastFailedLoginAttempt'] !== false)
					{
						?>
				<tr>
					<th><?php if(array_key_exists('lblLastFailedLoginAttempt', (array) $this->variables)) { echo SpoonFilter::ucfirst($this->variables['lblLastFailedLoginAttempt']); } else { ?>{$lblLastFailedLoginAttempt|ucfirst}<?php } ?>:</th>
					<td><?php if(array_key_exists('authenticatedUserLastFailedLoginAttempt', (array) $this->variables) && array_key_exists('authenticatedUserDateFormat', (array) $this->variables) && array_key_exists('authenticatedUserTimeFormat', (array) $this->variables) && array_key_exists('INTERFACE_LANGUAGE', (array) $this->variables)) { echo SpoonTemplateModifiers::date($this->variables['authenticatedUserLastFailedLoginAttempt'], '' . $this->variables['authenticatedUserDateFormat'] .' ' . $this->variables['authenticatedUserTimeFormat'] .'', $this->variables['INTERFACE_LANGUAGE']); } else { ?>{$authenticatedUserLastFailedLoginAttempt|date:'<?php if(array_key_exists('authenticatedUserDateFormat', (array) $this->variables)) { echo $this->variables['authenticatedUserDateFormat']; } else { ?>{$authenticatedUserDateFormat}<?php } ?> <?php if(array_key_exists('authenticatedUserTimeFormat', (array) $this->variables)) { echo $this->variables['authenticatedUserTimeFormat']; } else { ?>{$authenticatedUserTimeFormat}<?php } ?>':<?php if(array_key_exists('INTERFACE_LANGUAGE', (array) $this->variables)) { echo $this->variables['INTERFACE_LANGUAGE']; } else { ?>{$INTERFACE_LANGUAGE}<?php } ?>}<?php } ?></td>
				</tr>
			<?php } ?>
			<tr>
				<th><?php if(array_key_exists('lblLastPasswordChange', (array) $this->variables)) { echo SpoonFilter::ucfirst($this->variables['lblLastPasswordChange']); } else { ?>{$lblLastPasswordChange|ucfirst}<?php } ?>:</th>
				<td>
					<?php
					if(isset($this->variables['authenticatedUserLastPasswordChange']) && count($this->variables['authenticatedUserLastPasswordChange']) != 0 && $this->variables['authenticatedUserLastPasswordChange'] != '' && $this->variables['authenticatedUserLastPasswordChange'] !== false)
					{
						?><?php if(array_key_exists('authenticatedUserLastPasswordChange', (array) $this->variables) && array_key_exists('authenticatedUserDateFormat', (array) $this->variables) && array_key_exists('authenticatedUserTimeFormat', (array) $this->variables) && array_key_exists('INTERFACE_LANGUAGE', (array) $this->variables)) { echo SpoonTemplateModifiers::date($this->variables['authenticatedUserLastPasswordChange'], '' . $this->variables['authenticatedUserDateFormat'] .' ' . $this->variables['authenticatedUserTimeFormat'] .'', $this->variables['INTERFACE_LANGUAGE']); } else { ?>{$authenticatedUserLastPasswordChange|date:'<?php if(array_key_exists('authenticatedUserDateFormat', (array) $this->variables)) { echo $this->variables['authenticatedUserDateFormat']; } else { ?>{$authenticatedUserDateFormat}<?php } ?> <?php if(array_key_exists('authenticatedUserTimeFormat', (array) $this->variables)) { echo $this->variables['authenticatedUserTimeFormat']; } else { ?>{$authenticatedUserTimeFormat}<?php } ?>':<?php if(array_key_exists('INTERFACE_LANGUAGE', (array) $this->variables)) { echo $this->variables['INTERFACE_LANGUAGE']; } else { ?>{$INTERFACE_LANGUAGE}<?php } ?>}<?php } ?><?php } ?>
					<?php if(!isset($this->variables['authenticatedUserLastPasswordChange']) || count($this->variables['authenticatedUserLastPasswordChange']) == 0 || $this->variables['authenticatedUserLastPasswordChange'] == '' || $this->variables['authenticatedUserLastPasswordChange'] === false): ?><?php if(array_key_exists('lblNever', (array) $this->variables)) { echo $this->variables['lblNever']; } else { ?>{$lblNever}<?php } ?><?php endif; ?>
				</td>
			</tr>
			<?php
					if(isset($this->variables['showPasswordStrength']) && count($this->variables['showPasswordStrength']) != 0 && $this->variables['showPasswordStrength'] != '' && $this->variables['showPasswordStrength'] !== false)
					{
						?>
				<tr>
					<th><?php if(array_key_exists('lblPasswordStrength', (array) $this->variables)) { echo SpoonFilter::ucfirst($this->variables['lblPasswordStrength']); } else { ?>{$lblPasswordStrength|ucfirst}<?php } ?>:</th>
					<td><?php if(array_key_exists('passwordStrengthLabel', (array) $this->variables)) { echo $this->variables['passwordStrengthLabel']; } else { ?>{$passwordStrengthLabel}<?php } ?></td>
				</tr>
			<?php } ?>
		</table>
	</div>

	<div class="footer">
		<div class="buttonHolderRight">
			<a href="<?php if(array_key_exists('authenticatedUserEditUrl', (array) $this->variables)) { echo $this->variables['authenticatedUserEditUrl']; } else { ?>{$authenticatedUserEditUrl}<?php } ?>" class="button"><span><?php if(array_key_exists('lblEditProfile', (array) $this->variables)) { echo SpoonFilter::ucfirst($this->variables['lblEditProfile']); } else { ?>{$lblEditProfile|ucfirst}<?php } ?></span></a>
		</div>
	</div>
</div>