<?php error_reporting(E_ALL | E_STRICT); ini_set('display_errors', 'On'); ?>
<!--[if lte IE 6]>
	<style type="text/css" media="screen">
		#debugnotify, #loginBox {
			display: none
		}
		#browserSupport {
			padding: 20px;
			border: 1px solid #DDD;
			width: 400px;
			margin: 40px auto
		}
		#browserSupport h2 {
			padding: 0 0 12px;
		}
		body {
			background: #FFF !important;
		}
	</style>
	<div id="browserSupport" class="content">
		<h2><?php if(array_key_exists('lblBrowserNotSupported', (array) $this->variables)) { echo SpoonFilter::ucfirst($this->variables['lblBrowserNotSupported']); } else { ?>{$lblBrowserNotSupported|ucfirst}<?php } ?></h2>
		<?php if(array_key_exists('errBrowserNotSupported', (array) $this->variables)) { echo $this->variables['errBrowserNotSupported']; } else { ?>{$errBrowserNotSupported}<?php } ?>
	</div>
<![endif]-->