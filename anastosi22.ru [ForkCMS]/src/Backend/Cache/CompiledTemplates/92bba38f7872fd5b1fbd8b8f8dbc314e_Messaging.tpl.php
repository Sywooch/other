<?php error_reporting(0); ini_set('display_errors', 'Off'); ?>
<div id="messaging">
	<noscript>
		<div class="formMessage errorMessage">
			<p><?php echo $this->variables['errJavascriptNotEnabled']; ?></p>
		</div>
	</noscript>
	<div id="noCookies" class="formMessage errorMessage" style="display: none;">
		<p><?php echo $this->variables['errCookiesNotEnabled']; ?></p>
	</div>
</div>