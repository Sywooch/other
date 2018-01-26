<?php error_reporting(0); ini_set('display_errors', 'Off'); ?>
<?php if(!isset($this->variables['cookieBarHide']) || count($this->variables['cookieBarHide']) == 0 || $this->variables['cookieBarHide'] == '' || $this->variables['cookieBarHide'] === false): ?>
	<div id="cookieBar" class="fullWidthAlert alert">
		<?php echo $this->variables['msgCookiesWarning']; ?>
		<a href="#" id="cookieBarAgree"><?php echo SpoonFilter::ucfirst($this->variables['lblIAgree']); ?></a>
		<a href="#" id="cookieBarDisagree"><?php echo SpoonFilter::ucfirst($this->variables['lblIDisagree']); ?></a>
	</div>
<?php endif; ?>