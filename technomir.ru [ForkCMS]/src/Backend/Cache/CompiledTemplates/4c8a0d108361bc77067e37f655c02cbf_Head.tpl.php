<?php error_reporting(E_ALL | E_STRICT); ini_set('display_errors', 'On'); ?>
<!DOCTYPE html>
<html lang="<?php if(array_key_exists('INTERFACE_LANGUAGE', (array) $this->variables)) { echo $this->variables['INTERFACE_LANGUAGE']; } else { ?>{$INTERFACE_LANGUAGE}<?php } ?>">
<head>
	<meta charset="utf-8" />
	<meta http-equiv="X-UA-Compatible" content="chrome=1" />
	<meta name="robots" content="noindex, nofollow" />

	<title><?php if(array_key_exists('SITE_TITLE', (array) $this->variables)) { echo $this->variables['SITE_TITLE']; } else { ?>{$SITE_TITLE}<?php } ?> - Fork CMS</title>
	<link rel="shortcut icon" href="/src/Backend/favicon.ico" />

	<?php
					if(!isset($this->variables['cssFiles']))
					{
						?>{iteration:cssFiles}<?php
						$this->variables['cssFiles'] = array();
						$this->iterations['4c8a0d108361bc77067e37f655c02cbf_Head.tpl.php_1']['fail'] = true;
					}
				if(isset(${'cssFiles'})) $this->iterations['4c8a0d108361bc77067e37f655c02cbf_Head.tpl.php_1']['old'] = ${'cssFiles'};
				$this->iterations['4c8a0d108361bc77067e37f655c02cbf_Head.tpl.php_1']['iteration'] = $this->variables['cssFiles'];
				$this->iterations['4c8a0d108361bc77067e37f655c02cbf_Head.tpl.php_1']['i'] = 1;
				$this->iterations['4c8a0d108361bc77067e37f655c02cbf_Head.tpl.php_1']['count'] = count($this->iterations['4c8a0d108361bc77067e37f655c02cbf_Head.tpl.php_1']['iteration']);
				foreach((array) $this->iterations['4c8a0d108361bc77067e37f655c02cbf_Head.tpl.php_1']['iteration'] as ${'cssFiles'})
				{
					if(!isset(${'cssFiles'}['first']) && $this->iterations['4c8a0d108361bc77067e37f655c02cbf_Head.tpl.php_1']['i'] == 1) ${'cssFiles'}['first'] = true;
					if(!isset(${'cssFiles'}['last']) && $this->iterations['4c8a0d108361bc77067e37f655c02cbf_Head.tpl.php_1']['i'] == $this->iterations['4c8a0d108361bc77067e37f655c02cbf_Head.tpl.php_1']['count']) ${'cssFiles'}['last'] = true;
					if(isset(${'cssFiles'}['formElements']) && is_array(${'cssFiles'}['formElements']))
					{
						foreach(${'cssFiles'}['formElements'] as $name => $object)
						{
							${'cssFiles'}[$name] = $object->parse();
							${'cssFiles'}[$name .'Error'] = (is_callable(array($object, 'getErrors')) && $object->getErrors() != '') ? '<span class="formError">' . $object->getErrors() .'</span>' : '';
						}
					} ?><link rel="stylesheet" href="<?php if(array_key_exists('file', (array) ${'cssFiles'})) { echo ${'cssFiles'}['file']; } else { ?>{$cssFiles->file}<?php } ?>" /><?php if(array_key_exists('CRLF', (array) $this->variables)) { echo $this->variables['CRLF']; } else { ?>{$CRLF}<?php } ?><?php if(array_key_exists('TAB', (array) $this->variables)) { echo $this->variables['TAB']; } else { ?>{$TAB}<?php } ?><?php
					$this->iterations['4c8a0d108361bc77067e37f655c02cbf_Head.tpl.php_1']['i']++;
				}
					if(isset($this->iterations['4c8a0d108361bc77067e37f655c02cbf_Head.tpl.php_1']['fail']) && $this->iterations['4c8a0d108361bc77067e37f655c02cbf_Head.tpl.php_1']['fail'] == true)
					{
						?>{/iteration:cssFiles}<?php
					}
				if(isset($this->iterations['4c8a0d108361bc77067e37f655c02cbf_Head.tpl.php_1']['old'])) ${'cssFiles'} = $this->iterations['4c8a0d108361bc77067e37f655c02cbf_Head.tpl.php_1']['old'];
				else unset($this->iterations['4c8a0d108361bc77067e37f655c02cbf_Head.tpl.php_1']);
				?>
	<!--[if IE 7]><link rel="stylesheet" href="/src/Backend/Core/Layout/Css/conditionals/ie7.css" /><![endif]-->
	<!--[if IE 8]><link rel="stylesheet" href="/src/Backend/Core/Layout/Css/conditionals/ie8.css" /><![endif]-->

	<?php
					if(!isset($this->variables['jsFiles']))
					{
						?>{iteration:jsFiles}<?php
						$this->variables['jsFiles'] = array();
						$this->iterations['4c8a0d108361bc77067e37f655c02cbf_Head.tpl.php_2']['fail'] = true;
					}
				if(isset(${'jsFiles'})) $this->iterations['4c8a0d108361bc77067e37f655c02cbf_Head.tpl.php_2']['old'] = ${'jsFiles'};
				$this->iterations['4c8a0d108361bc77067e37f655c02cbf_Head.tpl.php_2']['iteration'] = $this->variables['jsFiles'];
				$this->iterations['4c8a0d108361bc77067e37f655c02cbf_Head.tpl.php_2']['i'] = 1;
				$this->iterations['4c8a0d108361bc77067e37f655c02cbf_Head.tpl.php_2']['count'] = count($this->iterations['4c8a0d108361bc77067e37f655c02cbf_Head.tpl.php_2']['iteration']);
				foreach((array) $this->iterations['4c8a0d108361bc77067e37f655c02cbf_Head.tpl.php_2']['iteration'] as ${'jsFiles'})
				{
					if(!isset(${'jsFiles'}['first']) && $this->iterations['4c8a0d108361bc77067e37f655c02cbf_Head.tpl.php_2']['i'] == 1) ${'jsFiles'}['first'] = true;
					if(!isset(${'jsFiles'}['last']) && $this->iterations['4c8a0d108361bc77067e37f655c02cbf_Head.tpl.php_2']['i'] == $this->iterations['4c8a0d108361bc77067e37f655c02cbf_Head.tpl.php_2']['count']) ${'jsFiles'}['last'] = true;
					if(isset(${'jsFiles'}['formElements']) && is_array(${'jsFiles'}['formElements']))
					{
						foreach(${'jsFiles'}['formElements'] as $name => $object)
						{
							${'jsFiles'}[$name] = $object->parse();
							${'jsFiles'}[$name .'Error'] = (is_callable(array($object, 'getErrors')) && $object->getErrors() != '') ? '<span class="formError">' . $object->getErrors() .'</span>' : '';
						}
					} ?><script src="<?php if(array_key_exists('file', (array) ${'jsFiles'})) { echo ${'jsFiles'}['file']; } else { ?>{$jsFiles->file}<?php } ?>"></script><?php if(array_key_exists('CRLF', (array) $this->variables)) { echo $this->variables['CRLF']; } else { ?>{$CRLF}<?php } ?><?php if(array_key_exists('TAB', (array) $this->variables)) { echo $this->variables['TAB']; } else { ?>{$TAB}<?php } ?><?php
					$this->iterations['4c8a0d108361bc77067e37f655c02cbf_Head.tpl.php_2']['i']++;
				}
					if(isset($this->iterations['4c8a0d108361bc77067e37f655c02cbf_Head.tpl.php_2']['fail']) && $this->iterations['4c8a0d108361bc77067e37f655c02cbf_Head.tpl.php_2']['fail'] == true)
					{
						?>{/iteration:jsFiles}<?php
					}
				if(isset($this->iterations['4c8a0d108361bc77067e37f655c02cbf_Head.tpl.php_2']['old'])) ${'jsFiles'} = $this->iterations['4c8a0d108361bc77067e37f655c02cbf_Head.tpl.php_2']['old'];
				else unset($this->iterations['4c8a0d108361bc77067e37f655c02cbf_Head.tpl.php_2']);
				?>
	<script>
		//<![CDATA[
			<?php if(array_key_exists('jsData', (array) $this->variables)) { echo $this->variables['jsData']; } else { ?>{$jsData}<?php } ?>

			// reports
			$(function()
			{
				<?php
					if(isset($this->variables['formError']) && count($this->variables['formError']) != 0 && $this->variables['formError'] != '' && $this->variables['formError'] !== false)
					{
						?>jsBackend.messages.add('error', "<?php if(array_key_exists('errFormError', (array) $this->variables)) { echo addslashes($this->variables['errFormError']); } else { ?>{$errFormError|addslashes}<?php } ?>");<?php } ?>
				<?php
					if(isset($this->variables['usingRevision']) && count($this->variables['usingRevision']) != 0 && $this->variables['usingRevision'] != '' && $this->variables['usingRevision'] !== false)
					{
						?>jsBackend.messages.add('notice', "<?php if(array_key_exists('msgUsingARevision', (array) $this->variables)) { echo addslashes($this->variables['msgUsingARevision']); } else { ?>{$msgUsingARevision|addslashes}<?php } ?>");<?php } ?>
				<?php
					if(isset($this->variables['usingDraft']) && count($this->variables['usingDraft']) != 0 && $this->variables['usingDraft'] != '' && $this->variables['usingDraft'] !== false)
					{
						?>jsBackend.messages.add('notice', "<?php if(array_key_exists('msgUsingADraft', (array) $this->variables)) { echo addslashes($this->variables['msgUsingADraft']); } else { ?>{$msgUsingADraft|addslashes}<?php } ?>");<?php } ?>
				<?php
					if(isset($this->variables['report']) && count($this->variables['report']) != 0 && $this->variables['report'] != '' && $this->variables['report'] !== false)
					{
						?>jsBackend.messages.add('success', "<?php if(array_key_exists('reportMessage', (array) $this->variables)) { echo addslashes($this->variables['reportMessage']); } else { ?>{$reportMessage|addslashes}<?php } ?>");<?php } ?>
				<?php
					if(isset($this->variables['errorMessage']) && count($this->variables['errorMessage']) != 0 && $this->variables['errorMessage'] != '' && $this->variables['errorMessage'] !== false)
					{
						?>jsBackend.messages.add('error', "<?php if(array_key_exists('errorMessage', (array) $this->variables)) { echo addslashes($this->variables['errorMessage']); } else { ?>{$errorMessage|addslashes}<?php } ?>");<?php } ?>
			});
		//]]>
	</script>
</head>
