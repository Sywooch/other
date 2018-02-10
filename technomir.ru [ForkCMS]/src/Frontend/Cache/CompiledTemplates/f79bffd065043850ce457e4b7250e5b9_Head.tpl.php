<?php error_reporting(E_ALL | E_STRICT); ini_set('display_errors', 'On'); ?>
<!DOCTYPE html>
<!--[if lt IE 7 ]> <html lang="<?php if(array_key_exists('LANGUAGE', (array) $this->variables)) { echo $this->variables['LANGUAGE']; } else { ?>{$LANGUAGE}<?php } ?>" class="ie6"> <![endif]-->
<!--[if IE 7 ]> <html lang="<?php if(array_key_exists('LANGUAGE', (array) $this->variables)) { echo $this->variables['LANGUAGE']; } else { ?>{$LANGUAGE}<?php } ?>" class="ie7"> <![endif]-->
<!--[if IE 8 ]> <html lang="<?php if(array_key_exists('LANGUAGE', (array) $this->variables)) { echo $this->variables['LANGUAGE']; } else { ?>{$LANGUAGE}<?php } ?>" class="ie8"> <![endif]-->
<!--[if IE 9 ]> <html lang="<?php if(array_key_exists('LANGUAGE', (array) $this->variables)) { echo $this->variables['LANGUAGE']; } else { ?>{$LANGUAGE}<?php } ?>" class="ie9"> <![endif]-->
<!--[if (gt IE 9)|!(IE)]><!--> <html lang="<?php if(array_key_exists('LANGUAGE', (array) $this->variables)) { echo $this->variables['LANGUAGE']; } else { ?>{$LANGUAGE}<?php } ?>"> <!--<![endif]-->
<head>
	
	<meta charset="utf-8" />
	<meta name="generator" content="Fork CMS" />
	<?php if(array_key_exists('meta', (array) $this->variables)) { echo $this->variables['meta']; } else { ?>{$meta}<?php } ?>
	<?php if(array_key_exists('metaCustom', (array) $this->variables)) { echo $this->variables['metaCustom']; } else { ?>{$metaCustom}<?php } ?>
	<title><?php if(array_key_exists('pageTitle', (array) $this->variables)) { echo $this->variables['pageTitle']; } else { ?>{$pageTitle}<?php } ?></title>
	
	<link href="/favicon.ico" rel="shortcut icon" type="image/vnd.microsoft.icon" />
	<link rel="apple-touch-icon" href="/apple-touch-icon.png" />
	
	<meta name="application-name" content="<?php if(array_key_exists('siteTitle', (array) $this->variables)) { echo $this->variables['siteTitle']; } else { ?>{$siteTitle}<?php } ?>"/>
	<meta name="msapplication-TileColor" content="#3380aa"/>
	<meta name="msapplication-TileImage" content="/tile.png"/>
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
	
<?php
					if(!isset($this->variables['cssFiles']))
					{
						?>{iteration:cssFiles}<?php
						$this->variables['cssFiles'] = array();
						$this->iterations['f79bffd065043850ce457e4b7250e5b9_Head.tpl.php_1']['fail'] = true;
					}
				if(isset(${'cssFiles'})) $this->iterations['f79bffd065043850ce457e4b7250e5b9_Head.tpl.php_1']['old'] = ${'cssFiles'};
				$this->iterations['f79bffd065043850ce457e4b7250e5b9_Head.tpl.php_1']['iteration'] = $this->variables['cssFiles'];
				$this->iterations['f79bffd065043850ce457e4b7250e5b9_Head.tpl.php_1']['i'] = 1;
				$this->iterations['f79bffd065043850ce457e4b7250e5b9_Head.tpl.php_1']['count'] = count($this->iterations['f79bffd065043850ce457e4b7250e5b9_Head.tpl.php_1']['iteration']);
				foreach((array) $this->iterations['f79bffd065043850ce457e4b7250e5b9_Head.tpl.php_1']['iteration'] as ${'cssFiles'})
				{
					if(!isset(${'cssFiles'}['first']) && $this->iterations['f79bffd065043850ce457e4b7250e5b9_Head.tpl.php_1']['i'] == 1) ${'cssFiles'}['first'] = true;
					if(!isset(${'cssFiles'}['last']) && $this->iterations['f79bffd065043850ce457e4b7250e5b9_Head.tpl.php_1']['i'] == $this->iterations['f79bffd065043850ce457e4b7250e5b9_Head.tpl.php_1']['count']) ${'cssFiles'}['last'] = true;
					if(isset(${'cssFiles'}['formElements']) && is_array(${'cssFiles'}['formElements']))
					{
						foreach(${'cssFiles'}['formElements'] as $name => $object)
						{
							${'cssFiles'}[$name] = $object->parse();
							${'cssFiles'}[$name .'Error'] = (is_callable(array($object, 'getErrors')) && $object->getErrors() != '') ? '<span class="formError">' . $object->getErrors() .'</span>' : '';
						}
					} ?>
	<link rel="stylesheet" href="<?php if(array_key_exists('file', (array) ${'cssFiles'})) { echo ${'cssFiles'}['file']; } else { ?>{$cssFiles->file}<?php } ?>" />
<?php
					$this->iterations['f79bffd065043850ce457e4b7250e5b9_Head.tpl.php_1']['i']++;
				}
					if(isset($this->iterations['f79bffd065043850ce457e4b7250e5b9_Head.tpl.php_1']['fail']) && $this->iterations['f79bffd065043850ce457e4b7250e5b9_Head.tpl.php_1']['fail'] == true)
					{
						?>{/iteration:cssFiles}<?php
					}
				if(isset($this->iterations['f79bffd065043850ce457e4b7250e5b9_Head.tpl.php_1']['old'])) ${'cssFiles'} = $this->iterations['f79bffd065043850ce457e4b7250e5b9_Head.tpl.php_1']['old'];
				else unset($this->iterations['f79bffd065043850ce457e4b7250e5b9_Head.tpl.php_1']);
				?>
	<!-- HTML5 shim, for IE6-8 support of HTML5 elements -->
	<!--[if lt IE 9]>
	<script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
	<![endif]-->

<?php
					if(!isset($this->variables['jsFiles']))
					{
						?>{iteration:jsFiles}<?php
						$this->variables['jsFiles'] = array();
						$this->iterations['f79bffd065043850ce457e4b7250e5b9_Head.tpl.php_2']['fail'] = true;
					}
				if(isset(${'jsFiles'})) $this->iterations['f79bffd065043850ce457e4b7250e5b9_Head.tpl.php_2']['old'] = ${'jsFiles'};
				$this->iterations['f79bffd065043850ce457e4b7250e5b9_Head.tpl.php_2']['iteration'] = $this->variables['jsFiles'];
				$this->iterations['f79bffd065043850ce457e4b7250e5b9_Head.tpl.php_2']['i'] = 1;
				$this->iterations['f79bffd065043850ce457e4b7250e5b9_Head.tpl.php_2']['count'] = count($this->iterations['f79bffd065043850ce457e4b7250e5b9_Head.tpl.php_2']['iteration']);
				foreach((array) $this->iterations['f79bffd065043850ce457e4b7250e5b9_Head.tpl.php_2']['iteration'] as ${'jsFiles'})
				{
					if(!isset(${'jsFiles'}['first']) && $this->iterations['f79bffd065043850ce457e4b7250e5b9_Head.tpl.php_2']['i'] == 1) ${'jsFiles'}['first'] = true;
					if(!isset(${'jsFiles'}['last']) && $this->iterations['f79bffd065043850ce457e4b7250e5b9_Head.tpl.php_2']['i'] == $this->iterations['f79bffd065043850ce457e4b7250e5b9_Head.tpl.php_2']['count']) ${'jsFiles'}['last'] = true;
					if(isset(${'jsFiles'}['formElements']) && is_array(${'jsFiles'}['formElements']))
					{
						foreach(${'jsFiles'}['formElements'] as $name => $object)
						{
							${'jsFiles'}[$name] = $object->parse();
							${'jsFiles'}[$name .'Error'] = (is_callable(array($object, 'getErrors')) && $object->getErrors() != '') ? '<span class="formError">' . $object->getErrors() .'</span>' : '';
						}
					} ?>
	<script src="<?php if(array_key_exists('file', (array) ${'jsFiles'})) { echo ${'jsFiles'}['file']; } else { ?>{$jsFiles->file}<?php } ?>"></script>
<?php
					$this->iterations['f79bffd065043850ce457e4b7250e5b9_Head.tpl.php_2']['i']++;
				}
					if(isset($this->iterations['f79bffd065043850ce457e4b7250e5b9_Head.tpl.php_2']['fail']) && $this->iterations['f79bffd065043850ce457e4b7250e5b9_Head.tpl.php_2']['fail'] == true)
					{
						?>{/iteration:jsFiles}<?php
					}
				if(isset($this->iterations['f79bffd065043850ce457e4b7250e5b9_Head.tpl.php_2']['old'])) ${'jsFiles'} = $this->iterations['f79bffd065043850ce457e4b7250e5b9_Head.tpl.php_2']['old'];
				else unset($this->iterations['f79bffd065043850ce457e4b7250e5b9_Head.tpl.php_2']);
				?>

<?php if(array_key_exists('siteHTMLHeader', (array) $this->variables)) { echo $this->variables['siteHTMLHeader']; } else { ?>{$siteHTMLHeader}<?php } ?>
</head>