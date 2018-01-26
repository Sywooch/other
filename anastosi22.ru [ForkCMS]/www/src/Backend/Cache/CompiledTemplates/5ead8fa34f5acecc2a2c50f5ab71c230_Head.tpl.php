<?php error_reporting(0); ini_set('display_errors', 'Off'); ?>
<!DOCTYPE html>
<html lang="<?php echo $this->variables['INTERFACE_LANGUAGE']; ?>">
<head>
	<meta charset="utf-8" />
	<meta http-equiv="X-UA-Compatible" content="chrome=1" />
	<meta name="robots" content="noindex, nofollow" />

	<title><?php echo $this->variables['SITE_TITLE']; ?> - Fork CMS</title>
	<link rel="shortcut icon" href="/src/Backend/favicon.ico" />

	<?php
				if(isset(${'cssFiles'})) $this->iterations['5ead8fa34f5acecc2a2c50f5ab71c230_Head.tpl.php_1']['old'] = ${'cssFiles'};
				$this->iterations['5ead8fa34f5acecc2a2c50f5ab71c230_Head.tpl.php_1']['iteration'] = $this->variables['cssFiles'];
				$this->iterations['5ead8fa34f5acecc2a2c50f5ab71c230_Head.tpl.php_1']['i'] = 1;
				$this->iterations['5ead8fa34f5acecc2a2c50f5ab71c230_Head.tpl.php_1']['count'] = count($this->iterations['5ead8fa34f5acecc2a2c50f5ab71c230_Head.tpl.php_1']['iteration']);
				foreach((array) $this->iterations['5ead8fa34f5acecc2a2c50f5ab71c230_Head.tpl.php_1']['iteration'] as ${'cssFiles'})
				{
					if(!isset(${'cssFiles'}['first']) && $this->iterations['5ead8fa34f5acecc2a2c50f5ab71c230_Head.tpl.php_1']['i'] == 1) ${'cssFiles'}['first'] = true;
					if(!isset(${'cssFiles'}['last']) && $this->iterations['5ead8fa34f5acecc2a2c50f5ab71c230_Head.tpl.php_1']['i'] == $this->iterations['5ead8fa34f5acecc2a2c50f5ab71c230_Head.tpl.php_1']['count']) ${'cssFiles'}['last'] = true;
					if(isset(${'cssFiles'}['formElements']) && is_array(${'cssFiles'}['formElements']))
					{
						foreach(${'cssFiles'}['formElements'] as $name => $object)
						{
							${'cssFiles'}[$name] = $object->parse();
							${'cssFiles'}[$name .'Error'] = (is_callable(array($object, 'getErrors')) && $object->getErrors() != '') ? '<span class="formError">' . $object->getErrors() .'</span>' : '';
						}
					} ?><link rel="stylesheet" href="<?php echo ${'cssFiles'}['file']; ?>" /><?php echo $this->variables['CRLF']; ?><?php echo $this->variables['TAB']; ?><?php
					$this->iterations['5ead8fa34f5acecc2a2c50f5ab71c230_Head.tpl.php_1']['i']++;
				}
				if(isset($this->iterations['5ead8fa34f5acecc2a2c50f5ab71c230_Head.tpl.php_1']['old'])) ${'cssFiles'} = $this->iterations['5ead8fa34f5acecc2a2c50f5ab71c230_Head.tpl.php_1']['old'];
				else unset($this->iterations['5ead8fa34f5acecc2a2c50f5ab71c230_Head.tpl.php_1']);
				?>
	<!--[if IE 7]><link rel="stylesheet" href="/src/Backend/Core/Layout/Css/conditionals/ie7.css" /><![endif]-->
	<!--[if IE 8]><link rel="stylesheet" href="/src/Backend/Core/Layout/Css/conditionals/ie8.css" /><![endif]-->

	<?php
				if(isset(${'jsFiles'})) $this->iterations['5ead8fa34f5acecc2a2c50f5ab71c230_Head.tpl.php_2']['old'] = ${'jsFiles'};
				$this->iterations['5ead8fa34f5acecc2a2c50f5ab71c230_Head.tpl.php_2']['iteration'] = $this->variables['jsFiles'];
				$this->iterations['5ead8fa34f5acecc2a2c50f5ab71c230_Head.tpl.php_2']['i'] = 1;
				$this->iterations['5ead8fa34f5acecc2a2c50f5ab71c230_Head.tpl.php_2']['count'] = count($this->iterations['5ead8fa34f5acecc2a2c50f5ab71c230_Head.tpl.php_2']['iteration']);
				foreach((array) $this->iterations['5ead8fa34f5acecc2a2c50f5ab71c230_Head.tpl.php_2']['iteration'] as ${'jsFiles'})
				{
					if(!isset(${'jsFiles'}['first']) && $this->iterations['5ead8fa34f5acecc2a2c50f5ab71c230_Head.tpl.php_2']['i'] == 1) ${'jsFiles'}['first'] = true;
					if(!isset(${'jsFiles'}['last']) && $this->iterations['5ead8fa34f5acecc2a2c50f5ab71c230_Head.tpl.php_2']['i'] == $this->iterations['5ead8fa34f5acecc2a2c50f5ab71c230_Head.tpl.php_2']['count']) ${'jsFiles'}['last'] = true;
					if(isset(${'jsFiles'}['formElements']) && is_array(${'jsFiles'}['formElements']))
					{
						foreach(${'jsFiles'}['formElements'] as $name => $object)
						{
							${'jsFiles'}[$name] = $object->parse();
							${'jsFiles'}[$name .'Error'] = (is_callable(array($object, 'getErrors')) && $object->getErrors() != '') ? '<span class="formError">' . $object->getErrors() .'</span>' : '';
						}
					} ?><script src="<?php echo ${'jsFiles'}['file']; ?>"></script><?php echo $this->variables['CRLF']; ?><?php echo $this->variables['TAB']; ?><?php
					$this->iterations['5ead8fa34f5acecc2a2c50f5ab71c230_Head.tpl.php_2']['i']++;
				}
				if(isset($this->iterations['5ead8fa34f5acecc2a2c50f5ab71c230_Head.tpl.php_2']['old'])) ${'jsFiles'} = $this->iterations['5ead8fa34f5acecc2a2c50f5ab71c230_Head.tpl.php_2']['old'];
				else unset($this->iterations['5ead8fa34f5acecc2a2c50f5ab71c230_Head.tpl.php_2']);
				?>
	<script>
		//<![CDATA[
			<?php echo $this->variables['jsData']; ?>

			// reports
			$(function()
			{
				<?php
					if(isset($this->variables['formError']) && count($this->variables['formError']) != 0 && $this->variables['formError'] != '' && $this->variables['formError'] !== false)
					{
						?>jsBackend.messages.add('error', "<?php echo addslashes($this->variables['errFormError']); ?>");<?php } ?>
				<?php
					if(isset($this->variables['usingRevision']) && count($this->variables['usingRevision']) != 0 && $this->variables['usingRevision'] != '' && $this->variables['usingRevision'] !== false)
					{
						?>jsBackend.messages.add('notice', "<?php echo addslashes($this->variables['msgUsingARevision']); ?>");<?php } ?>
				<?php
					if(isset($this->variables['usingDraft']) && count($this->variables['usingDraft']) != 0 && $this->variables['usingDraft'] != '' && $this->variables['usingDraft'] !== false)
					{
						?>jsBackend.messages.add('notice', "<?php echo addslashes($this->variables['msgUsingADraft']); ?>");<?php } ?>
				<?php
					if(isset($this->variables['report']) && count($this->variables['report']) != 0 && $this->variables['report'] != '' && $this->variables['report'] !== false)
					{
						?>jsBackend.messages.add('success', "<?php echo addslashes($this->variables['reportMessage']); ?>");<?php } ?>
				<?php
					if(isset($this->variables['errorMessage']) && count($this->variables['errorMessage']) != 0 && $this->variables['errorMessage'] != '' && $this->variables['errorMessage'] !== false)
					{
						?>jsBackend.messages.add('error', "<?php echo addslashes($this->variables['errorMessage']); ?>");<?php } ?>
			});
		//]]>
	</script>
</head>
