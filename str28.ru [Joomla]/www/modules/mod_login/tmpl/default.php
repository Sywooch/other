<?php
/**
 * @package		Retina.Site
 * @subpackage	mod_login
 * 
 * 
 */

// no direct access 2
defined('_REXEC') or die;
JHtml::_('behavior.keepalive');
?>
<?php if ($type == 'logout') : ?>
<form action="<?php echo JRoute::_('index.php', true, $params->get('usesecure')); ?>" method="post" id="login-form" >
<?php if ($params->get('greeting')) : ?>
	<div class="login-greeting" >
	<?php if($params->get('name') == 0) : {
		echo RText::sprintf('MOD_LOGIN_HINAME', $user->get('name'));
	} else : {
		echo RText::sprintf('MOD_LOGIN_HINAME', $user->get('username'));
	} endif; ?>
	</div>
<?php endif; ?>
	<div class="logout-button">
		<input type="submit" name="Submit" class="button" value="<?php echo RText::_('JLOGOUT'); ?>" />
		<input type="hidden" name="option" value="com_users" />
		<input type="hidden" name="task" value="user.logout" />
		<input type="hidden" name="return" value="<?php echo $return; ?>" />
		<?php echo JHtml::_('form.token'); ?>
	</div>
</form>
<?php else : ?>
<form action="<?php echo JRoute::_('index.php', true, $params->get('usesecure')); ?>" method="post" id="login-form" 
style="background-color:#fafafa !important; padding-top:10px !important; padding-bottom:10px !important;">
	<?php if ($params->get('pretext')): ?>
		<div class="pretext">
		<p><?php echo $params->get('pretext'); ?></p>
		</div>
	<?php endif; ?>
	<fieldset class="userdata">
	<p id="form-login-username">
		<!--<label for="modlgn-username"><?php echo RText::_('MOD_LOGIN_VALUE_USERNAME') ?></label>-->
		<input id="modlgn-username" type="text" name="username" class="inputbox"  size="18" 
		style="border:#a8a6a6 1px solid !important; width:200px !important" placeholder="Имя пользователя"/>
	</p>
	<p id="form-login-password">
		<!--<label for="modlgn-passwd"><?php echo RText::_('RGLOBAL_PASSWORD') ?></label>-->
		<input id="modlgn-passwd" type="password" name="password" class="inputbox" size="18"
		style="border:#a8a6a6 1px solid !important; width:200px !important" placeholder="Пароль" />
	</p>
	<?php if (JPluginHelper::isEnabled('main', 'remember')) : ?>
	<p id="form-login-remember" style="color:#a8a6a6 !important">
		<label for="modlgn-remember"><?php echo RText::_('MOD_LOGIN_REMEMBER_ME') ?></label>
		<input id="modlgn-remember" type="checkbox" name="remember" class="inputbox" value="yes"/>
	</p>
	<?php endif; ?>
	<input type="submit" name="Submit" class="button" 
	style="color:#a8a6a6 !important; border:1px #a8a6a6 solid" value="<?php echo RText::_('JLOGIN') ?>" />
	<input type="hidden" name="option" value="com_users" />
	<input type="hidden" name="task" value="user.login" />
	<input type="hidden" name="return" value="<?php echo $return; ?>" />
	<?php echo JHtml::_('form.token'); ?>
	</fieldset>
	<ul>
		<li>
			<a href="<?php echo JRoute::_('index.php?option=com_users&view=reset'); ?>" style="color:#a8a6a6 !important">
			<?php echo RText::_('MOD_LOGIN_FORGOT_YOUR_PASSWORD'); ?></a>
		</li>
		<!--<li>
			<a href="<?php //echo JRoute::_('index.php?option=com_users&view=remind'); ?>">
			<?php //echo RText::_('MOD_LOGIN_FORGOT_YOUR_USERNAME'); ?></a>
		</li>-->
		<?php
		$usersConfig = JComponentHelper::getParams('com_users');
		if ($usersConfig->get('allowUserRegistration')) : ?>
		<li>
			<a href="<?php echo JRoute::_('index.php?option=com_users&view=registration'); ?>"  style="color:#a8a6a6 !important">
				<?php echo RText::_('MOD_LOGIN_REGISTER'); ?></a>
		</li>
		<?php endif; ?>
	</ul>
	<?php if ($params->get('posttext')): ?>
		<div class="posttext">
		<p><?php echo $params->get('posttext'); ?></p>
		</div>
	<?php endif; ?>
</form>
<?php endif; ?>
