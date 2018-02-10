<?php error_reporting(E_ALL | E_STRICT); ini_set('display_errors', 'On'); ?>
<?php $includes = array();
                ob_start();
                ?>Core/Layout/Templates/Head.tpl<?php
                $includes[] = str_replace('//', '/', eval('return \'' . str_replace('\'', '\\\'', ob_get_clean()) .'\';'));
                ob_start();
                ?>/home/segaz/domains/techno-mir.net/public_html/app/../src/Frontend/Themes/Core/Core/Layout/Templates/Head.tpl<?php
                $includes[] = str_replace('//', '/', eval('return \'' . str_replace('\'', '\\\'', ob_get_clean()) .'\';'));
                ob_start();
                ?>/home/segaz/domains/techno-mir.net/public_html/app/../src/Frontend/Core/Layout/Templates/Head.tpl<?php
                $includes[] = str_replace('//', '/', eval('return \'' . str_replace('\'', '\\\'', ob_get_clean()) .'\';'));
                foreach($includes as $include) if(@file_exists($include) && is_file($include)) break;
                if($this->getForceCompile() || !file_exists($this->getCompileDirectory() .'/' . $this->getCompileName($include, '/home/segaz/domains/techno-mir.net/public_html/src/Frontend/Core/Layout/Templates'))) $this->compile('/home/segaz/domains/techno-mir.net/public_html/src/Frontend/Core/Layout/Templates', $include);
                $return = @include $this->getCompileDirectory() .'/' . $this->getCompileName($include, '/home/segaz/domains/techno-mir.net/public_html/src/Frontend/Core/Layout/Templates');
                if($return === false && $this->compile('/home/segaz/domains/techno-mir.net/public_html/src/Frontend/Core/Layout/Templates', $include)) {
                    $return = @include $this->getCompileDirectory() .'/' . $this->getCompileName($include, '/home/segaz/domains/techno-mir.net/public_html/src/Frontend/Core/Layout/Templates');
                }
if($return === false) {
                    ?>{include:Core/Layout/Templates/Head.tpl}<?php
                }
?>

<body class="<?php if(array_key_exists('LANGUAGE', (array) $this->variables)) { echo $this->variables['LANGUAGE']; } else { ?>{$LANGUAGE}<?php } ?> horizontal-layout" itemscope itemtype="http://schema.org/WebPage">
	<?php $includes = array();
                ob_start();
                ?>Core/Layout/Templates/Cookies.tpl<?php
                $includes[] = str_replace('//', '/', eval('return \'' . str_replace('\'', '\\\'', ob_get_clean()) .'\';'));
                ob_start();
                ?>/home/segaz/domains/techno-mir.net/public_html/app/../src/Frontend/Themes/Core/Core/Layout/Templates/Cookies.tpl<?php
                $includes[] = str_replace('//', '/', eval('return \'' . str_replace('\'', '\\\'', ob_get_clean()) .'\';'));
                ob_start();
                ?>/home/segaz/domains/techno-mir.net/public_html/app/../src/Frontend/Core/Layout/Templates/Cookies.tpl<?php
                $includes[] = str_replace('//', '/', eval('return \'' . str_replace('\'', '\\\'', ob_get_clean()) .'\';'));
                foreach($includes as $include) if(@file_exists($include) && is_file($include)) break;
                if($this->getForceCompile() || !file_exists($this->getCompileDirectory() .'/' . $this->getCompileName($include, '/home/segaz/domains/techno-mir.net/public_html/src/Frontend/Core/Layout/Templates'))) $this->compile('/home/segaz/domains/techno-mir.net/public_html/src/Frontend/Core/Layout/Templates', $include);
                $return = @include $this->getCompileDirectory() .'/' . $this->getCompileName($include, '/home/segaz/domains/techno-mir.net/public_html/src/Frontend/Core/Layout/Templates');
                if($return === false && $this->compile('/home/segaz/domains/techno-mir.net/public_html/src/Frontend/Core/Layout/Templates', $include)) {
                    $return = @include $this->getCompileDirectory() .'/' . $this->getCompileName($include, '/home/segaz/domains/techno-mir.net/public_html/src/Frontend/Core/Layout/Templates');
                }
if($return === false) {
                    ?>{include:Core/Layout/Templates/Cookies.tpl}<?php
                }
?>
<header>
	<div id="logo">
		<a href="/" title="Мир технологий - мир ваших идей"><span><img src="/images/technomir.png" /></span></a></div>
</header>
	<div id="container">
	
	
		<?php
					if(!isset($this->variables['positionMain']))
					{
						?>{iteration:positionMain}<?php
						$this->variables['positionMain'] = array();
						$this->iterations['74e02239ed7f9eb44cd91e9cf4cbf79e_Default.tpl.php_1']['fail'] = true;
					}
				if(isset(${'positionMain'})) $this->iterations['74e02239ed7f9eb44cd91e9cf4cbf79e_Default.tpl.php_1']['old'] = ${'positionMain'};
				$this->iterations['74e02239ed7f9eb44cd91e9cf4cbf79e_Default.tpl.php_1']['iteration'] = $this->variables['positionMain'];
				$this->iterations['74e02239ed7f9eb44cd91e9cf4cbf79e_Default.tpl.php_1']['i'] = 1;
				$this->iterations['74e02239ed7f9eb44cd91e9cf4cbf79e_Default.tpl.php_1']['count'] = count($this->iterations['74e02239ed7f9eb44cd91e9cf4cbf79e_Default.tpl.php_1']['iteration']);
				foreach((array) $this->iterations['74e02239ed7f9eb44cd91e9cf4cbf79e_Default.tpl.php_1']['iteration'] as ${'positionMain'})
				{
					if(!isset(${'positionMain'}['first']) && $this->iterations['74e02239ed7f9eb44cd91e9cf4cbf79e_Default.tpl.php_1']['i'] == 1) ${'positionMain'}['first'] = true;
					if(!isset(${'positionMain'}['last']) && $this->iterations['74e02239ed7f9eb44cd91e9cf4cbf79e_Default.tpl.php_1']['i'] == $this->iterations['74e02239ed7f9eb44cd91e9cf4cbf79e_Default.tpl.php_1']['count']) ${'positionMain'}['last'] = true;
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
				<?php if(array_key_exists('blockContent', (array) ${'positionMain'})) { echo ${'positionMain'}['blockContent']; } else { ?>{$positionMain->blockContent}<?php } ?>
				<?php } ?>
				<?php if(!isset(${'positionMain'}['blockIsHTML']) || count(${'positionMain'}['blockIsHTML']) == 0 || ${'positionMain'}['blockIsHTML'] == '' || ${'positionMain'}['blockIsHTML'] === false): ?>
					<?php if(array_key_exists('blockContent', (array) ${'positionMain'})) { echo ${'positionMain'}['blockContent']; } else { ?>{$positionMain->blockContent}<?php } ?>
				<?php endif; ?>
			<?php
					$this->iterations['74e02239ed7f9eb44cd91e9cf4cbf79e_Default.tpl.php_1']['i']++;
				}
					if(isset($this->iterations['74e02239ed7f9eb44cd91e9cf4cbf79e_Default.tpl.php_1']['fail']) && $this->iterations['74e02239ed7f9eb44cd91e9cf4cbf79e_Default.tpl.php_1']['fail'] == true)
					{
						?>{/iteration:positionMain}<?php
					}
				if(isset($this->iterations['74e02239ed7f9eb44cd91e9cf4cbf79e_Default.tpl.php_1']['old'])) ${'positionMain'} = $this->iterations['74e02239ed7f9eb44cd91e9cf4cbf79e_Default.tpl.php_1']['old'];
				else unset($this->iterations['74e02239ed7f9eb44cd91e9cf4cbf79e_Default.tpl.php_1']);
				?>
	

		<footer>
			<?php $includes = array();
                ob_start();
                ?>Core/Layout/Templates/Footer.tpl<?php
                $includes[] = str_replace('//', '/', eval('return \'' . str_replace('\'', '\\\'', ob_get_clean()) .'\';'));
                ob_start();
                ?>/home/segaz/domains/techno-mir.net/public_html/app/../src/Frontend/Themes/Core/Core/Layout/Templates/Footer.tpl<?php
                $includes[] = str_replace('//', '/', eval('return \'' . str_replace('\'', '\\\'', ob_get_clean()) .'\';'));
                ob_start();
                ?>/home/segaz/domains/techno-mir.net/public_html/app/../src/Frontend/Core/Layout/Templates/Footer.tpl<?php
                $includes[] = str_replace('//', '/', eval('return \'' . str_replace('\'', '\\\'', ob_get_clean()) .'\';'));
                foreach($includes as $include) if(@file_exists($include) && is_file($include)) break;
                if($this->getForceCompile() || !file_exists($this->getCompileDirectory() .'/' . $this->getCompileName($include, '/home/segaz/domains/techno-mir.net/public_html/src/Frontend/Core/Layout/Templates'))) $this->compile('/home/segaz/domains/techno-mir.net/public_html/src/Frontend/Core/Layout/Templates', $include);
                $return = @include $this->getCompileDirectory() .'/' . $this->getCompileName($include, '/home/segaz/domains/techno-mir.net/public_html/src/Frontend/Core/Layout/Templates');
                if($return === false && $this->compile('/home/segaz/domains/techno-mir.net/public_html/src/Frontend/Core/Layout/Templates', $include)) {
                    $return = @include $this->getCompileDirectory() .'/' . $this->getCompileName($include, '/home/segaz/domains/techno-mir.net/public_html/src/Frontend/Core/Layout/Templates');
                }
if($return === false) {
                    ?>{include:Core/Layout/Templates/Footer.tpl}<?php
                }
?>
		</footer>
	</div>


	
	<?php if(array_key_exists('siteHTMLFooter', (array) $this->variables)) { echo $this->variables['siteHTMLFooter']; } else { ?>{$siteHTMLFooter}<?php } ?>
</body>
</html>
