<?php error_reporting(0); ini_set('display_errors', 'Off'); ?>
<div class="box" id="widgetUsersStatistics">
	<div class="heading">
		<h3><a href="<?php echo $this->variables['authenticatedUserEditUrl']; ?>"><?php echo SpoonFilter::ucfirst($this->variables['lblUsers']); ?>: <?php echo SpoonFilter::ucfirst($this->variables['lblStatistics']); ?></a></h3>
	</div>

	<div class="options settingsUserInfo">
		<table class="infoGrid m0">
			<tr>
				<th><?php echo SpoonFilter::ucfirst($this->variables['lblLastLogin']); ?>:</th>
				<td>
					<?php
					if(isset($this->variables['authenticatedUserLastLogin']) && count($this->variables['authenticatedUserLastLogin']) != 0 && $this->variables['authenticatedUserLastLogin'] != '' && $this->variables['authenticatedUserLastLogin'] !== false)
					{
						?><?php echo SpoonTemplateModifiers::date($this->variables['authenticatedUserLastLogin'], '' . $this->variables['authenticatedUserDateFormat'] .' ' . $this->variables['authenticatedUserTimeFormat'] .'', $this->variables['INTERFACE_LANGUAGE']); ?><?php } ?>
					<?php if(!isset($this->variables['authenticatedUserLastLogin']) || count($this->variables['authenticatedUserLastLogin']) == 0 || $this->variables['authenticatedUserLastLogin'] == '' || $this->variables['authenticatedUserLastLogin'] === false): ?><?php echo $this->variables['lblNoPreviousLogin']; ?><?php endif; ?>
				</td>
			</tr>
			<?php
					if(isset($this->variables['authenticatedUserLastFailedLoginAttempt']) && count($this->variables['authenticatedUserLastFailedLoginAttempt']) != 0 && $this->variables['authenticatedUserLastFailedLoginAttempt'] != '' && $this->variables['authenticatedUserLastFailedLoginAttempt'] !== false)
					{
						?>
				<tr>
					<th><?php echo SpoonFilter::ucfirst($this->variables['lblLastFailedLoginAttempt']); ?>:</th>
					<td><?php echo SpoonTemplateModifiers::date($this->variables['authenticatedUserLastFailedLoginAttempt'], '' . $this->variables['authenticatedUserDateFormat'] .' ' . $this->variables['authenticatedUserTimeFormat'] .'', $this->variables['INTERFACE_LANGUAGE']); ?></td>
				</tr>
			<?php } ?>
			<tr>
				<th><?php echo SpoonFilter::ucfirst($this->variables['lblLastPasswordChange']); ?>:</th>
				<td>
					<?php
					if(isset($this->variables['authenticatedUserLastPasswordChange']) && count($this->variables['authenticatedUserLastPasswordChange']) != 0 && $this->variables['authenticatedUserLastPasswordChange'] != '' && $this->variables['authenticatedUserLastPasswordChange'] !== false)
					{
						?><?php echo SpoonTemplateModifiers::date($this->variables['authenticatedUserLastPasswordChange'], '' . $this->variables['authenticatedUserDateFormat'] .' ' . $this->variables['authenticatedUserTimeFormat'] .'', $this->variables['INTERFACE_LANGUAGE']); ?><?php } ?>
					<?php if(!isset($this->variables['authenticatedUserLastPasswordChange']) || count($this->variables['authenticatedUserLastPasswordChange']) == 0 || $this->variables['authenticatedUserLastPasswordChange'] == '' || $this->variables['authenticatedUserLastPasswordChange'] === false): ?><?php echo $this->variables['lblNever']; ?><?php endif; ?>
				</td>
			</tr>
			<?php
					if(isset($this->variables['showPasswordStrength']) && count($this->variables['showPasswordStrength']) != 0 && $this->variables['showPasswordStrength'] != '' && $this->variables['showPasswordStrength'] !== false)
					{
						?>
				<tr>
					<th><?php echo SpoonFilter::ucfirst($this->variables['lblPasswordStrength']); ?>:</th>
					<td><?php echo $this->variables['passwordStrengthLabel']; ?></td>
				</tr>
			<?php } ?>
		</table>
	</div>

	<div class="footer">
		<div class="buttonHolderRight">
			<a href="<?php echo $this->variables['authenticatedUserEditUrl']; ?>" class="button"><span><?php echo SpoonFilter::ucfirst($this->variables['lblEditProfile']); ?></span></a>
		</div>
	</div>
</div>