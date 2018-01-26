<?php error_reporting(0); ini_set('display_errors', 'Off'); ?>
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
		<h2><?php echo SpoonFilter::ucfirst($this->variables['lblBrowserNotSupported']); ?></h2>
		<?php echo $this->variables['errBrowserNotSupported']; ?>
	</div>
<![endif]-->