<?php // no direct access
defined('_JEXEC') or die('Restricted access'); ?>
<?php if($type == 'logout') : ?>
<form action="<?php echo JRoute::_('index.php', true, $params->get('usesecure')); ?>" method="post" name="login" id="form-login">
<?php if ($params->get('greeting')) : ?>
    <br/>
	<div>
	<?php if ($params->get('name') == 1) : {
		echo sprintf( _JSHOP_HINAME, $params->get('title')." ".$user->get('f_name') );
	} elseif($params->get('name') == 0) : {
		echo sprintf( _JSHOP_HINAME, $params->get('title')." ".$user->get('u_name') );
	}elseif($params->get('name') == 2) :{ 
        echo sprintf( _JSHOP_HINAME, $params->get('title')." ".$user->get('l_name') );
    }else :{
        echo sprintf( _JSHOP_HINAME, $params->get('title')." ".$user->get('f_name')." ".$user->get('l_name') );
    }endif; 
    
    
    ?>
	</div>
<?php endif; ?>
    <div>
        <a href="<?php echo SEFLink('index.php?option=com_jshopping&controller=user&task=myaccount', 1); ?>"><?php print JText::_('MY_ACCOUNT')?></a>
    </div>
    <br/>
	<div align="center">
		<input type="submit" name="Submit" class="button" value="<?php print JText::_('LOGOUT') ?>" />
	</div>

	<input type="hidden" name="option" value="com_users" />
	<input type="hidden" name="task" value="user.logout" />
	<input type="hidden" name="return" value="<?php echo $return; ?>" />
    <?php echo JHTML::_( 'form.token' ); ?>
</form>
<?php else : ?>
<?php if(JPluginHelper::isEnabled('authentication', 'openid')) :
		$lang->load( 'plg_authentication_openid', JPATH_ADMINISTRATOR );
		$langScript = 	'var JLanguage = {};'.
						' JLanguage.WHAT_IS_OPENID = \''.JText::_( 'WHAT_IS_OPENID' ).'\';'.
						' JLanguage.LOGIN_WITH_OPENID = \''.JText::_( 'LOGIN_WITH_OPENID' ).'\';'.
						' JLanguage.NORMAL_LOGIN = \''.JText::_( 'NORMAL_LOGIN' ).'\';'.
						' var modlogin = 1;';
		$document = JFactory::getDocument();
		$document->addScriptDeclaration( $langScript );
		JHTML::_('script', 'openid.js');
endif; ?>
<form action="<?php echo JRoute::_( 'index.php', true, $params->get('usesecure')); ?>" method="post" name="login" id="form-login" >
	<?php echo $params->get('pretext'); ?>

	<p id="form-login-username">
		<label for="modlgn_username"><?php echo JText::_('USERNAME') ?></label><br />
		<input id="modlgn_username" type="text" name="username" class="inputbox" alt="username" size="18" />
	</p>
	<p id="form-login-password">
		<label for="modlgn_passwd"><?php echo JText::_('PASSWORD') ?></label><br />
		<input id="modlgn_passwd" type="password" name="passwd" class="inputbox" size="18" alt="password" />
	</p>
	<?php if(JPluginHelper::isEnabled('system', 'remember')) : ?>
	<p id="form-login-remember">
		<label for="modlgn_remember"><?php echo JText::_('REMEMBER_ME') ?></label>
		<input id="modlgn_remember" type="checkbox" name="remember" value="yes" alt="Remember Me" />
	</p>
	<?php endif; ?>
	<input type="submit" name="Submit" class="button" value="<?php echo JText::_('LOGIN') ?>" />

	<div>
	    <a href="<?php echo JRoute::_( 'index.php?option=com_users&view=reset'); ?>"><?php print JText::_('LOST_PASSWORD') ?></a>
    </div>
    <?php /*<div>
	    <a href="<?php echo JRoute::_( 'index.php?option=com_user&view=remind' ); ?>"><?php echo JText::_('FORGOT_YOUR_USERNAME'); ?></a>
    </div> */ ?>
	<?php
	$usersConfig = JComponentHelper::getParams( 'com_users' );
	if ($usersConfig->get('allowUserRegistration')) : ?>
	<div>
		<a href="<?php echo SEFLink('index.php?option=com_jshopping&controller=user&task=register', 1); ?>"><?php print JText::_('REGISTRATION') ?></a>
	</div>
	<?php endif; ?>
	<?php echo $params->get('posttext'); ?>

	<input type="hidden" name="option" value="com_jshopping" />
    <input type="hidden" name="controller" value="user" />
	<input type="hidden" name="task" value="loginsave" />
	<input type="hidden" name="return" value="<?php echo $return; ?>" />
	<?php echo JHTML::_( 'form.token' ); ?>
</form>
<?php endif; ?>