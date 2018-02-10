<?php error_reporting(0); ini_set('display_errors', 'Off'); ?>
<?php $includes = array();
                ob_start();
                ?>Core/Layout/Templates/Head.tpl<?php
                $includes[] = str_replace('//', '/', eval('return \'' . str_replace('\'', '\\\'', ob_get_clean()) .'\';'));
                ob_start();
                ?>/home/segaz/domains/techno-mir.net/public_html/app/../src/Frontend/Themes/triton/Core/Layout/Templates/Head.tpl<?php
                $includes[] = str_replace('//', '/', eval('return \'' . str_replace('\'', '\\\'', ob_get_clean()) .'\';'));
                ob_start();
                ?>/home/segaz/domains/techno-mir.net/public_html/app/../src/Frontend/Core/Layout/Templates/Head.tpl<?php
                $includes[] = str_replace('//', '/', eval('return \'' . str_replace('\'', '\\\'', ob_get_clean()) .'\';'));
                foreach($includes as $include) if(@file_exists($include) && is_file($include)) break;
                if($this->getForceCompile() || !file_exists($this->getCompileDirectory() .'/' . $this->getCompileName($include, '/home/segaz/domains/techno-mir.net/public_html/src/Frontend/Themes/triton/Core/Layout/Templates'))) $this->compile('/home/segaz/domains/techno-mir.net/public_html/src/Frontend/Themes/triton/Core/Layout/Templates', $include);
                $return = @include $this->getCompileDirectory() .'/' . $this->getCompileName($include, '/home/segaz/domains/techno-mir.net/public_html/src/Frontend/Themes/triton/Core/Layout/Templates');
                if($return === false && $this->compile('/home/segaz/domains/techno-mir.net/public_html/src/Frontend/Themes/triton/Core/Layout/Templates', $include)) {
                    $return = @include $this->getCompileDirectory() .'/' . $this->getCompileName($include, '/home/segaz/domains/techno-mir.net/public_html/src/Frontend/Themes/triton/Core/Layout/Templates');
                }
?>

<body class="<?php echo $this->variables['LANGUAGE']; ?>" itemscope itemtype="http://schema.org/WebPage">
	<?php $includes = array();
                ob_start();
                ?>Core/Layout/Templates/Cookies.tpl<?php
                $includes[] = str_replace('//', '/', eval('return \'' . str_replace('\'', '\\\'', ob_get_clean()) .'\';'));
                ob_start();
                ?>/home/segaz/domains/techno-mir.net/public_html/app/../src/Frontend/Themes/triton/Core/Layout/Templates/Cookies.tpl<?php
                $includes[] = str_replace('//', '/', eval('return \'' . str_replace('\'', '\\\'', ob_get_clean()) .'\';'));
                ob_start();
                ?>/home/segaz/domains/techno-mir.net/public_html/app/../src/Frontend/Core/Layout/Templates/Cookies.tpl<?php
                $includes[] = str_replace('//', '/', eval('return \'' . str_replace('\'', '\\\'', ob_get_clean()) .'\';'));
                foreach($includes as $include) if(@file_exists($include) && is_file($include)) break;
                if($this->getForceCompile() || !file_exists($this->getCompileDirectory() .'/' . $this->getCompileName($include, '/home/segaz/domains/techno-mir.net/public_html/src/Frontend/Themes/triton/Core/Layout/Templates'))) $this->compile('/home/segaz/domains/techno-mir.net/public_html/src/Frontend/Themes/triton/Core/Layout/Templates', $include);
                $return = @include $this->getCompileDirectory() .'/' . $this->getCompileName($include, '/home/segaz/domains/techno-mir.net/public_html/src/Frontend/Themes/triton/Core/Layout/Templates');
                if($return === false && $this->compile('/home/segaz/domains/techno-mir.net/public_html/src/Frontend/Themes/triton/Core/Layout/Templates', $include)) {
                    $return = @include $this->getCompileDirectory() .'/' . $this->getCompileName($include, '/home/segaz/domains/techno-mir.net/public_html/src/Frontend/Themes/triton/Core/Layout/Templates');
                }
?>

	<div id="topWrapper">
		<header id="header">
			<div class="container">

				
				<div id="logo">
					<h2><a href="/"><?php echo $this->variables['siteTitle']; ?></a></h2>
				</div>

				
				<div id="skip">
					<p><a href="#main"><?php echo SpoonFilter::ucfirst($this->variables['lblSkipToContent']); ?></a></p>
				</div>

				
				<nav id="headerNavigation">
					<h4><?php echo SpoonFilter::ucfirst($this->variables['lblMainNavigation']); ?></h4>
					<?php echo Frontend\Core\Engine\TemplateModifiers::getNavigation($this->variables['var'], 'page', 0, 1); ?>
				</nav>

				
				<nav id="headerLanguage">
					<h4><?php echo SpoonFilter::ucfirst($this->variables['lblLanguage']); ?></h4>
					<?php $includes = array();
                ob_start();
                ?>Core/Layout/Templates/Languages.tpl<?php
                $includes[] = str_replace('//', '/', eval('return \'' . str_replace('\'', '\\\'', ob_get_clean()) .'\';'));
                ob_start();
                ?>/home/segaz/domains/techno-mir.net/public_html/app/../src/Frontend/Themes/triton/Core/Layout/Templates/Languages.tpl<?php
                $includes[] = str_replace('//', '/', eval('return \'' . str_replace('\'', '\\\'', ob_get_clean()) .'\';'));
                ob_start();
                ?>/home/segaz/domains/techno-mir.net/public_html/app/../src/Frontend/Core/Layout/Templates/Languages.tpl<?php
                $includes[] = str_replace('//', '/', eval('return \'' . str_replace('\'', '\\\'', ob_get_clean()) .'\';'));
                foreach($includes as $include) if(@file_exists($include) && is_file($include)) break;
                if($this->getForceCompile() || !file_exists($this->getCompileDirectory() .'/' . $this->getCompileName($include, '/home/segaz/domains/techno-mir.net/public_html/src/Frontend/Themes/triton/Core/Layout/Templates'))) $this->compile('/home/segaz/domains/techno-mir.net/public_html/src/Frontend/Themes/triton/Core/Layout/Templates', $include);
                $return = @include $this->getCompileDirectory() .'/' . $this->getCompileName($include, '/home/segaz/domains/techno-mir.net/public_html/src/Frontend/Themes/triton/Core/Layout/Templates');
                if($return === false && $this->compile('/home/segaz/domains/techno-mir.net/public_html/src/Frontend/Themes/triton/Core/Layout/Templates', $include)) {
                    $return = @include $this->getCompileDirectory() .'/' . $this->getCompileName($include, '/home/segaz/domains/techno-mir.net/public_html/src/Frontend/Themes/triton/Core/Layout/Templates');
                }
?>
				</nav>

				
				<?php
				if(isset(${'positionTop'})) $this->iterations['9c877261053f96b4b0e747045816a180_Home.tpl.php_1']['old'] = ${'positionTop'};
				$this->iterations['9c877261053f96b4b0e747045816a180_Home.tpl.php_1']['iteration'] = $this->variables['positionTop'];
				$this->iterations['9c877261053f96b4b0e747045816a180_Home.tpl.php_1']['i'] = 1;
				$this->iterations['9c877261053f96b4b0e747045816a180_Home.tpl.php_1']['count'] = count($this->iterations['9c877261053f96b4b0e747045816a180_Home.tpl.php_1']['iteration']);
				foreach((array) $this->iterations['9c877261053f96b4b0e747045816a180_Home.tpl.php_1']['iteration'] as ${'positionTop'})
				{
					if(!isset(${'positionTop'}['first']) && $this->iterations['9c877261053f96b4b0e747045816a180_Home.tpl.php_1']['i'] == 1) ${'positionTop'}['first'] = true;
					if(!isset(${'positionTop'}['last']) && $this->iterations['9c877261053f96b4b0e747045816a180_Home.tpl.php_1']['i'] == $this->iterations['9c877261053f96b4b0e747045816a180_Home.tpl.php_1']['count']) ${'positionTop'}['last'] = true;
					if(isset(${'positionTop'}['formElements']) && is_array(${'positionTop'}['formElements']))
					{
						foreach(${'positionTop'}['formElements'] as $name => $object)
						{
							${'positionTop'}[$name] = $object->parse();
							${'positionTop'}[$name .'Error'] = (is_callable(array($object, 'getErrors')) && $object->getErrors() != '') ? '<span class="formError">' . $object->getErrors() .'</span>' : '';
						}
					} ?>
					<?php echo ${'positionTop'}['blockContent']; ?>
				<?php
					$this->iterations['9c877261053f96b4b0e747045816a180_Home.tpl.php_1']['i']++;
				}
				if(isset($this->iterations['9c877261053f96b4b0e747045816a180_Home.tpl.php_1']['old'])) ${'positionTop'} = $this->iterations['9c877261053f96b4b0e747045816a180_Home.tpl.php_1']['old'];
				else unset($this->iterations['9c877261053f96b4b0e747045816a180_Home.tpl.php_1']);
				?>

				
				<div id="breadcrumb">
					<h4><?php echo SpoonFilter::ucfirst($this->variables['lblBreadcrumb']); ?></h4>
					<?php $includes = array();
                ob_start();
                ?>Core/Layout/Templates/Breadcrumb.tpl<?php
                $includes[] = str_replace('//', '/', eval('return \'' . str_replace('\'', '\\\'', ob_get_clean()) .'\';'));
                ob_start();
                ?>/home/segaz/domains/techno-mir.net/public_html/app/../src/Frontend/Themes/triton/Core/Layout/Templates/Breadcrumb.tpl<?php
                $includes[] = str_replace('//', '/', eval('return \'' . str_replace('\'', '\\\'', ob_get_clean()) .'\';'));
                ob_start();
                ?>/home/segaz/domains/techno-mir.net/public_html/app/../src/Frontend/Core/Layout/Templates/Breadcrumb.tpl<?php
                $includes[] = str_replace('//', '/', eval('return \'' . str_replace('\'', '\\\'', ob_get_clean()) .'\';'));
                foreach($includes as $include) if(@file_exists($include) && is_file($include)) break;
                if($this->getForceCompile() || !file_exists($this->getCompileDirectory() .'/' . $this->getCompileName($include, '/home/segaz/domains/techno-mir.net/public_html/src/Frontend/Themes/triton/Core/Layout/Templates'))) $this->compile('/home/segaz/domains/techno-mir.net/public_html/src/Frontend/Themes/triton/Core/Layout/Templates', $include);
                $return = @include $this->getCompileDirectory() .'/' . $this->getCompileName($include, '/home/segaz/domains/techno-mir.net/public_html/src/Frontend/Themes/triton/Core/Layout/Templates');
                if($return === false && $this->compile('/home/segaz/domains/techno-mir.net/public_html/src/Frontend/Themes/triton/Core/Layout/Templates', $include)) {
                    $return = @include $this->getCompileDirectory() .'/' . $this->getCompileName($include, '/home/segaz/domains/techno-mir.net/public_html/src/Frontend/Themes/triton/Core/Layout/Templates');
                }
?>
				</div>

				
				<?php
				if(isset(${'positionAdvertisement'})) $this->iterations['9c877261053f96b4b0e747045816a180_Home.tpl.php_2']['old'] = ${'positionAdvertisement'};
				$this->iterations['9c877261053f96b4b0e747045816a180_Home.tpl.php_2']['iteration'] = $this->variables['positionAdvertisement'];
				$this->iterations['9c877261053f96b4b0e747045816a180_Home.tpl.php_2']['i'] = 1;
				$this->iterations['9c877261053f96b4b0e747045816a180_Home.tpl.php_2']['count'] = count($this->iterations['9c877261053f96b4b0e747045816a180_Home.tpl.php_2']['iteration']);
				foreach((array) $this->iterations['9c877261053f96b4b0e747045816a180_Home.tpl.php_2']['iteration'] as ${'positionAdvertisement'})
				{
					if(!isset(${'positionAdvertisement'}['first']) && $this->iterations['9c877261053f96b4b0e747045816a180_Home.tpl.php_2']['i'] == 1) ${'positionAdvertisement'}['first'] = true;
					if(!isset(${'positionAdvertisement'}['last']) && $this->iterations['9c877261053f96b4b0e747045816a180_Home.tpl.php_2']['i'] == $this->iterations['9c877261053f96b4b0e747045816a180_Home.tpl.php_2']['count']) ${'positionAdvertisement'}['last'] = true;
					if(isset(${'positionAdvertisement'}['formElements']) && is_array(${'positionAdvertisement'}['formElements']))
					{
						foreach(${'positionAdvertisement'}['formElements'] as $name => $object)
						{
							${'positionAdvertisement'}[$name] = $object->parse();
							${'positionAdvertisement'}[$name .'Error'] = (is_callable(array($object, 'getErrors')) && $object->getErrors() != '') ? '<span class="formError">' . $object->getErrors() .'</span>' : '';
						}
					} ?>
					<?php
					if(isset(${'positionAdvertisement'}['blockIsHTML']) && count(${'positionAdvertisement'}['blockIsHTML']) != 0 && ${'positionAdvertisement'}['blockIsHTML'] != '' && ${'positionAdvertisement'}['blockIsHTML'] !== false)
					{
						?>
						<div id="headerAd">
							<?php echo ${'positionAdvertisement'}['blockContent']; ?>
						</div>
					<?php } ?>
					<?php if(!isset(${'positionAdvertisement'}['blockIsHTML']) || count(${'positionAdvertisement'}['blockIsHTML']) == 0 || ${'positionAdvertisement'}['blockIsHTML'] == '' || ${'positionAdvertisement'}['blockIsHTML'] === false): ?>
						<?php echo ${'positionAdvertisement'}['blockContent']; ?>
					<?php endif; ?>
				<?php
					$this->iterations['9c877261053f96b4b0e747045816a180_Home.tpl.php_2']['i']++;
				}
				if(isset($this->iterations['9c877261053f96b4b0e747045816a180_Home.tpl.php_2']['old'])) ${'positionAdvertisement'} = $this->iterations['9c877261053f96b4b0e747045816a180_Home.tpl.php_2']['old'];
				else unset($this->iterations['9c877261053f96b4b0e747045816a180_Home.tpl.php_2']);
				?>

			</div>

		</header>
		<div id="main">
			<div class="container">

				
				<div class="col col-12 lastCol">

					
					<?php if(!isset($this->variables['hideContentTitle']) || count($this->variables['hideContentTitle']) == 0 || $this->variables['hideContentTitle'] == '' || $this->variables['hideContentTitle'] === false): ?>
						<header class="mainTitle">
							<h1><?php echo $this->variables['page']['title']; ?></h1>
						</header>
					<?php endif; ?>

					
					<?php
				if(isset(${'positionMain'})) $this->iterations['9c877261053f96b4b0e747045816a180_Home.tpl.php_3']['old'] = ${'positionMain'};
				$this->iterations['9c877261053f96b4b0e747045816a180_Home.tpl.php_3']['iteration'] = $this->variables['positionMain'];
				$this->iterations['9c877261053f96b4b0e747045816a180_Home.tpl.php_3']['i'] = 1;
				$this->iterations['9c877261053f96b4b0e747045816a180_Home.tpl.php_3']['count'] = count($this->iterations['9c877261053f96b4b0e747045816a180_Home.tpl.php_3']['iteration']);
				foreach((array) $this->iterations['9c877261053f96b4b0e747045816a180_Home.tpl.php_3']['iteration'] as ${'positionMain'})
				{
					if(!isset(${'positionMain'}['first']) && $this->iterations['9c877261053f96b4b0e747045816a180_Home.tpl.php_3']['i'] == 1) ${'positionMain'}['first'] = true;
					if(!isset(${'positionMain'}['last']) && $this->iterations['9c877261053f96b4b0e747045816a180_Home.tpl.php_3']['i'] == $this->iterations['9c877261053f96b4b0e747045816a180_Home.tpl.php_3']['count']) ${'positionMain'}['last'] = true;
					if(isset(${'positionMain'}['formElements']) && is_array(${'positionMain'}['formElements']))
					{
						foreach(${'positionMain'}['formElements'] as $name => $object)
						{
							${'positionMain'}[$name] = $object->parse();
							${'positionMain'}[$name .'Error'] = (is_callable(array($object, 'getErrors')) && $object->getErrors() != '') ? '<span class="formError">' . $object->getErrors() .'</span>' : '';
						}
					} ?>
						<?php
					if(isset(${'positionMain'}['blockIsHTML']) && count(${'positionMain'}['blockIsHTML']) != 0 && ${'positionMain'}['blockIsHTML'] != '' && ${'positionMain'}['blockIsHTML'] !== false)
					{
						?>
							<section class="mod">
								<div class="inner">
									<div class="bd content">
										<?php echo ${'positionMain'}['blockContent']; ?>
									</div>
								</div>
							</section>
						<?php } ?>
						<?php if(!isset(${'positionMain'}['blockIsHTML']) || count(${'positionMain'}['blockIsHTML']) == 0 || ${'positionMain'}['blockIsHTML'] == '' || ${'positionMain'}['blockIsHTML'] === false): ?>
							<?php echo ${'positionMain'}['blockContent']; ?>
						<?php endif; ?>
					<?php
					$this->iterations['9c877261053f96b4b0e747045816a180_Home.tpl.php_3']['i']++;
				}
				if(isset($this->iterations['9c877261053f96b4b0e747045816a180_Home.tpl.php_3']['old'])) ${'positionMain'} = $this->iterations['9c877261053f96b4b0e747045816a180_Home.tpl.php_3']['old'];
				else unset($this->iterations['9c877261053f96b4b0e747045816a180_Home.tpl.php_3']);
				?>

				</div>

				
				<div class="col col-6">

				
				<?php
				if(isset(${'positionLeft'})) $this->iterations['9c877261053f96b4b0e747045816a180_Home.tpl.php_4']['old'] = ${'positionLeft'};
				$this->iterations['9c877261053f96b4b0e747045816a180_Home.tpl.php_4']['iteration'] = $this->variables['positionLeft'];
				$this->iterations['9c877261053f96b4b0e747045816a180_Home.tpl.php_4']['i'] = 1;
				$this->iterations['9c877261053f96b4b0e747045816a180_Home.tpl.php_4']['count'] = count($this->iterations['9c877261053f96b4b0e747045816a180_Home.tpl.php_4']['iteration']);
				foreach((array) $this->iterations['9c877261053f96b4b0e747045816a180_Home.tpl.php_4']['iteration'] as ${'positionLeft'})
				{
					if(!isset(${'positionLeft'}['first']) && $this->iterations['9c877261053f96b4b0e747045816a180_Home.tpl.php_4']['i'] == 1) ${'positionLeft'}['first'] = true;
					if(!isset(${'positionLeft'}['last']) && $this->iterations['9c877261053f96b4b0e747045816a180_Home.tpl.php_4']['i'] == $this->iterations['9c877261053f96b4b0e747045816a180_Home.tpl.php_4']['count']) ${'positionLeft'}['last'] = true;
					if(isset(${'positionLeft'}['formElements']) && is_array(${'positionLeft'}['formElements']))
					{
						foreach(${'positionLeft'}['formElements'] as $name => $object)
						{
							${'positionLeft'}[$name] = $object->parse();
							${'positionLeft'}[$name .'Error'] = (is_callable(array($object, 'getErrors')) && $object->getErrors() != '') ? '<span class="formError">' . $object->getErrors() .'</span>' : '';
						}
					} ?>
					<?php
					if(isset(${'positionLeft'}['blockIsHTML']) && count(${'positionLeft'}['blockIsHTML']) != 0 && ${'positionLeft'}['blockIsHTML'] != '' && ${'positionLeft'}['blockIsHTML'] !== false)
					{
						?>
						<section class="mod">
							<div class="inner">
								<div class="bd content">
									<?php echo ${'positionLeft'}['blockContent']; ?>
								</div>
							</div>
						</section>
					<?php } ?>
					<?php if(!isset(${'positionLeft'}['blockIsHTML']) || count(${'positionLeft'}['blockIsHTML']) == 0 || ${'positionLeft'}['blockIsHTML'] == '' || ${'positionLeft'}['blockIsHTML'] === false): ?>
						<?php echo ${'positionLeft'}['blockContent']; ?>
					<?php endif; ?>
				<?php
					$this->iterations['9c877261053f96b4b0e747045816a180_Home.tpl.php_4']['i']++;
				}
				if(isset($this->iterations['9c877261053f96b4b0e747045816a180_Home.tpl.php_4']['old'])) ${'positionLeft'} = $this->iterations['9c877261053f96b4b0e747045816a180_Home.tpl.php_4']['old'];
				else unset($this->iterations['9c877261053f96b4b0e747045816a180_Home.tpl.php_4']);
				?>

				</div>

				
				<div class="col col-6 lastCol">

				
				<?php
				if(isset(${'positionRight'})) $this->iterations['9c877261053f96b4b0e747045816a180_Home.tpl.php_5']['old'] = ${'positionRight'};
				$this->iterations['9c877261053f96b4b0e747045816a180_Home.tpl.php_5']['iteration'] = $this->variables['positionRight'];
				$this->iterations['9c877261053f96b4b0e747045816a180_Home.tpl.php_5']['i'] = 1;
				$this->iterations['9c877261053f96b4b0e747045816a180_Home.tpl.php_5']['count'] = count($this->iterations['9c877261053f96b4b0e747045816a180_Home.tpl.php_5']['iteration']);
				foreach((array) $this->iterations['9c877261053f96b4b0e747045816a180_Home.tpl.php_5']['iteration'] as ${'positionRight'})
				{
					if(!isset(${'positionRight'}['first']) && $this->iterations['9c877261053f96b4b0e747045816a180_Home.tpl.php_5']['i'] == 1) ${'positionRight'}['first'] = true;
					if(!isset(${'positionRight'}['last']) && $this->iterations['9c877261053f96b4b0e747045816a180_Home.tpl.php_5']['i'] == $this->iterations['9c877261053f96b4b0e747045816a180_Home.tpl.php_5']['count']) ${'positionRight'}['last'] = true;
					if(isset(${'positionRight'}['formElements']) && is_array(${'positionRight'}['formElements']))
					{
						foreach(${'positionRight'}['formElements'] as $name => $object)
						{
							${'positionRight'}[$name] = $object->parse();
							${'positionRight'}[$name .'Error'] = (is_callable(array($object, 'getErrors')) && $object->getErrors() != '') ? '<span class="formError">' . $object->getErrors() .'</span>' : '';
						}
					} ?>
					<?php
					if(isset(${'positionRight'}['blockIsHTML']) && count(${'positionRight'}['blockIsHTML']) != 0 && ${'positionRight'}['blockIsHTML'] != '' && ${'positionRight'}['blockIsHTML'] !== false)
					{
						?>
						<section class="mod">
							<div class="inner">
								<div class="bd content">
									<?php echo ${'positionRight'}['blockContent']; ?>
								</div>
							</div>
						</section>
					<?php } ?>
					<?php if(!isset(${'positionRight'}['blockIsHTML']) || count(${'positionRight'}['blockIsHTML']) == 0 || ${'positionRight'}['blockIsHTML'] == '' || ${'positionRight'}['blockIsHTML'] === false): ?>
						<?php echo ${'positionRight'}['blockContent']; ?>
					<?php endif; ?>
				<?php
					$this->iterations['9c877261053f96b4b0e747045816a180_Home.tpl.php_5']['i']++;
				}
				if(isset($this->iterations['9c877261053f96b4b0e747045816a180_Home.tpl.php_5']['old'])) ${'positionRight'} = $this->iterations['9c877261053f96b4b0e747045816a180_Home.tpl.php_5']['old'];
				else unset($this->iterations['9c877261053f96b4b0e747045816a180_Home.tpl.php_5']);
				?>

				</div>
			</div>
		</div>
		<noscript>
			<div class="message notice">
				<h4><?php echo SpoonFilter::ucfirst($this->variables['lblEnableJavascript']); ?></h4>
				<p><?php echo $this->variables['msgEnableJavascript']; ?></p>
			</div>
		</noscript>
	</div>
	<div id="bottomWrapper">
		<?php $includes = array();
                ob_start();
                ?>Core/Layout/Templates/Footer.tpl<?php
                $includes[] = str_replace('//', '/', eval('return \'' . str_replace('\'', '\\\'', ob_get_clean()) .'\';'));
                ob_start();
                ?>/home/segaz/domains/techno-mir.net/public_html/app/../src/Frontend/Themes/triton/Core/Layout/Templates/Footer.tpl<?php
                $includes[] = str_replace('//', '/', eval('return \'' . str_replace('\'', '\\\'', ob_get_clean()) .'\';'));
                ob_start();
                ?>/home/segaz/domains/techno-mir.net/public_html/app/../src/Frontend/Core/Layout/Templates/Footer.tpl<?php
                $includes[] = str_replace('//', '/', eval('return \'' . str_replace('\'', '\\\'', ob_get_clean()) .'\';'));
                foreach($includes as $include) if(@file_exists($include) && is_file($include)) break;
                if($this->getForceCompile() || !file_exists($this->getCompileDirectory() .'/' . $this->getCompileName($include, '/home/segaz/domains/techno-mir.net/public_html/src/Frontend/Themes/triton/Core/Layout/Templates'))) $this->compile('/home/segaz/domains/techno-mir.net/public_html/src/Frontend/Themes/triton/Core/Layout/Templates', $include);
                $return = @include $this->getCompileDirectory() .'/' . $this->getCompileName($include, '/home/segaz/domains/techno-mir.net/public_html/src/Frontend/Themes/triton/Core/Layout/Templates');
                if($return === false && $this->compile('/home/segaz/domains/techno-mir.net/public_html/src/Frontend/Themes/triton/Core/Layout/Templates', $include)) {
                    $return = @include $this->getCompileDirectory() .'/' . $this->getCompileName($include, '/home/segaz/domains/techno-mir.net/public_html/src/Frontend/Themes/triton/Core/Layout/Templates');
                }
?>
	</div>

	
	<?php
				if(isset(${'jsFiles'})) $this->iterations['9c877261053f96b4b0e747045816a180_Home.tpl.php_6']['old'] = ${'jsFiles'};
				$this->iterations['9c877261053f96b4b0e747045816a180_Home.tpl.php_6']['iteration'] = $this->variables['jsFiles'];
				$this->iterations['9c877261053f96b4b0e747045816a180_Home.tpl.php_6']['i'] = 1;
				$this->iterations['9c877261053f96b4b0e747045816a180_Home.tpl.php_6']['count'] = count($this->iterations['9c877261053f96b4b0e747045816a180_Home.tpl.php_6']['iteration']);
				foreach((array) $this->iterations['9c877261053f96b4b0e747045816a180_Home.tpl.php_6']['iteration'] as ${'jsFiles'})
				{
					if(!isset(${'jsFiles'}['first']) && $this->iterations['9c877261053f96b4b0e747045816a180_Home.tpl.php_6']['i'] == 1) ${'jsFiles'}['first'] = true;
					if(!isset(${'jsFiles'}['last']) && $this->iterations['9c877261053f96b4b0e747045816a180_Home.tpl.php_6']['i'] == $this->iterations['9c877261053f96b4b0e747045816a180_Home.tpl.php_6']['count']) ${'jsFiles'}['last'] = true;
					if(isset(${'jsFiles'}['formElements']) && is_array(${'jsFiles'}['formElements']))
					{
						foreach(${'jsFiles'}['formElements'] as $name => $object)
						{
							${'jsFiles'}[$name] = $object->parse();
							${'jsFiles'}[$name .'Error'] = (is_callable(array($object, 'getErrors')) && $object->getErrors() != '') ? '<span class="formError">' . $object->getErrors() .'</span>' : '';
						}
					} ?>
		<script src="<?php echo ${'jsFiles'}['file']; ?>"></script>
	<?php
					$this->iterations['9c877261053f96b4b0e747045816a180_Home.tpl.php_6']['i']++;
				}
				if(isset($this->iterations['9c877261053f96b4b0e747045816a180_Home.tpl.php_6']['old'])) ${'jsFiles'} = $this->iterations['9c877261053f96b4b0e747045816a180_Home.tpl.php_6']['old'];
				else unset($this->iterations['9c877261053f96b4b0e747045816a180_Home.tpl.php_6']);
				?>

	
	<script src="<?php echo $this->variables['THEME_URL']; ?>/Core/Js/triton.js"></script>

	
	<?php echo $this->variables['siteHTMLFooter']; ?>
</body>
</html>
