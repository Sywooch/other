<?php error_reporting(0); ini_set('display_errors', 'Off'); ?>
<!DOCTYPE html>
<!--[if lt IE 7 ]> <html lang="<?php echo $this->variables['LANGUAGE']; ?>" class="ie6"> <![endif]-->
<!--[if IE 7 ]> <html lang="<?php echo $this->variables['LANGUAGE']; ?>" class="ie7"> <![endif]-->
<!--[if IE 8 ]> <html lang="<?php echo $this->variables['LANGUAGE']; ?>" class="ie8"> <![endif]-->
<!--[if IE 9 ]> <html lang="<?php echo $this->variables['LANGUAGE']; ?>" class="ie9"> <![endif]-->
<!--[if (gt IE 9)|!(IE)]><!--> <html lang="<?php echo $this->variables['LANGUAGE']; ?>"> <!--<![endif]-->
<head>
	
	<meta charset="utf-8" />
	<meta name="generator" content="Fork CMS" />
	<?php echo $this->variables['meta']; ?>
	<?php echo $this->variables['metaCustom']; ?>

	<title><?php echo $this->variables['pageTitle']; ?></title>

	
	<link rel="shortcut icon" href="/favicon.ico" />
	<link rel="apple-touch-icon" href="/apple-touch-icon.png" />

	
	<meta name="application-name" content="<?php echo $this->variables['siteTitle']; ?>"/>
	<meta name="msapplication-TileColor" content="#3380aa"/>
	<meta name="msapplication-TileImage" content="/tile.png"/>

	
	<?php
				if(isset(${'cssFiles'})) $this->iterations['a12a5732bfe56e15c9d289a19994cff9_Head.tpl.php_1']['old'] = ${'cssFiles'};
				$this->iterations['a12a5732bfe56e15c9d289a19994cff9_Head.tpl.php_1']['iteration'] = $this->variables['cssFiles'];
				$this->iterations['a12a5732bfe56e15c9d289a19994cff9_Head.tpl.php_1']['i'] = 1;
				$this->iterations['a12a5732bfe56e15c9d289a19994cff9_Head.tpl.php_1']['count'] = count($this->iterations['a12a5732bfe56e15c9d289a19994cff9_Head.tpl.php_1']['iteration']);
				foreach((array) $this->iterations['a12a5732bfe56e15c9d289a19994cff9_Head.tpl.php_1']['iteration'] as ${'cssFiles'})
				{
					if(!isset(${'cssFiles'}['first']) && $this->iterations['a12a5732bfe56e15c9d289a19994cff9_Head.tpl.php_1']['i'] == 1) ${'cssFiles'}['first'] = true;
					if(!isset(${'cssFiles'}['last']) && $this->iterations['a12a5732bfe56e15c9d289a19994cff9_Head.tpl.php_1']['i'] == $this->iterations['a12a5732bfe56e15c9d289a19994cff9_Head.tpl.php_1']['count']) ${'cssFiles'}['last'] = true;
					if(isset(${'cssFiles'}['formElements']) && is_array(${'cssFiles'}['formElements']))
					{
						foreach(${'cssFiles'}['formElements'] as $name => $object)
						{
							${'cssFiles'}[$name] = $object->parse();
							${'cssFiles'}[$name .'Error'] = (is_callable(array($object, 'getErrors')) && $object->getErrors() != '') ? '<span class="formError">' . $object->getErrors() .'</span>' : '';
						}
					} ?>
		<link rel="stylesheet" href="<?php echo ${'cssFiles'}['file']; ?>" />
	<?php
					$this->iterations['a12a5732bfe56e15c9d289a19994cff9_Head.tpl.php_1']['i']++;
				}
				if(isset($this->iterations['a12a5732bfe56e15c9d289a19994cff9_Head.tpl.php_1']['old'])) ${'cssFiles'} = $this->iterations['a12a5732bfe56e15c9d289a19994cff9_Head.tpl.php_1']['old'];
				else unset($this->iterations['a12a5732bfe56e15c9d289a19994cff9_Head.tpl.php_1']);
				?>

	<!-- HTML5 shim, for IE6-8 support of HTML5 elements -->
	<!--[if lt IE 9]>
		<script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
	<![endif]-->

	
	<?php echo $this->variables['siteHTMLHeader']; ?>
</head>