<?php error_reporting(E_ALL | E_STRICT); ini_set('display_errors', 'On'); ?>
<div id="messaging">
	<noscript>
		<div class="formMessage errorMessage">
			<p><?php if(array_key_exists('errJavascriptNotEnabled', (array) $this->variables)) { echo $this->variables['errJavascriptNotEnabled']; } else { ?>{$errJavascriptNotEnabled}<?php } ?></p>
		</div>
	</noscript>
	<div id="noCookies" class="formMessage errorMessage" style="display: none;">
		<p><?php if(array_key_exists('errCookiesNotEnabled', (array) $this->variables)) { echo $this->variables['errCookiesNotEnabled']; } else { ?>{$errCookiesNotEnabled}<?php } ?></p>
	</div>
</div>