<?php error_reporting(E_ALL | E_STRICT); ini_set('display_errors', 'On'); ?>
<?php if(!isset($this->variables['cookieBarHide']) || count($this->variables['cookieBarHide']) == 0 || $this->variables['cookieBarHide'] == '' || $this->variables['cookieBarHide'] === false): ?>
	<div id="cookieBar" class="fullWidthAlert alert">
		<?php if(array_key_exists('msgCookiesWarning', (array) $this->variables)) { echo $this->variables['msgCookiesWarning']; } else { ?>{$msgCookiesWarning}<?php } ?>
		<a href="#" id="cookieBarAgree"><?php if(array_key_exists('lblIAgree', (array) $this->variables)) { echo SpoonFilter::ucfirst($this->variables['lblIAgree']); } else { ?>{$lblIAgree|ucfirst}<?php } ?></a>
		<a href="#" id="cookieBarDisagree"><?php if(array_key_exists('lblIDisagree', (array) $this->variables)) { echo SpoonFilter::ucfirst($this->variables['lblIDisagree']); } else { ?>{$lblIDisagree|ucfirst}<?php } ?></a>
	</div>
<?php endif; ?>