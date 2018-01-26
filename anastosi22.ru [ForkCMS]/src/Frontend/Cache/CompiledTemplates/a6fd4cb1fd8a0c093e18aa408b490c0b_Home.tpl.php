<?php error_reporting(0); ini_set('display_errors', 'Off'); ?>
<?php $includes = array();
                ob_start();
                ?>Core/Layout/Templates/Head.tpl<?php
                $includes[] = str_replace('//', '/', eval('return \'' . str_replace('\'', '\\\'', ob_get_clean()) .'\';'));
                ob_start();
                ?>/home/anastosi/domains/anastosi.ru/public_html/app/../src/Frontend/Themes/Core/Core/Layout/Templates/Head.tpl<?php
                $includes[] = str_replace('//', '/', eval('return \'' . str_replace('\'', '\\\'', ob_get_clean()) .'\';'));
                ob_start();
                ?>/home/anastosi/domains/anastosi.ru/public_html/app/../src/Frontend/Core/Layout/Templates/Head.tpl<?php
                $includes[] = str_replace('//', '/', eval('return \'' . str_replace('\'', '\\\'', ob_get_clean()) .'\';'));
                foreach($includes as $include) if(@file_exists($include) && is_file($include)) break;
                if($this->getForceCompile() || !file_exists($this->getCompileDirectory() .'/' . $this->getCompileName($include, '/home/anastosi/domains/anastosi.ru/public_html/src/Frontend/Core/Layout/Templates'))) $this->compile('/home/anastosi/domains/anastosi.ru/public_html/src/Frontend/Core/Layout/Templates', $include);
                $return = @include $this->getCompileDirectory() .'/' . $this->getCompileName($include, '/home/anastosi/domains/anastosi.ru/public_html/src/Frontend/Core/Layout/Templates');
                if($return === false && $this->compile('/home/anastosi/domains/anastosi.ru/public_html/src/Frontend/Core/Layout/Templates', $include)) {
                    $return = @include $this->getCompileDirectory() .'/' . $this->getCompileName($include, '/home/anastosi/domains/anastosi.ru/public_html/src/Frontend/Core/Layout/Templates');
                }
?>

<body class="<?php echo $this->variables['LANGUAGE']; ?>" itemscope itemtype="http://schema.org/WebPage">

	<?php $includes = array();
                ob_start();
                ?>Core/Layout/Templates/Cookies.tpl<?php
                $includes[] = str_replace('//', '/', eval('return \'' . str_replace('\'', '\\\'', ob_get_clean()) .'\';'));
                ob_start();
                ?>/home/anastosi/domains/anastosi.ru/public_html/app/../src/Frontend/Themes/Core/Core/Layout/Templates/Cookies.tpl<?php
                $includes[] = str_replace('//', '/', eval('return \'' . str_replace('\'', '\\\'', ob_get_clean()) .'\';'));
                ob_start();
                ?>/home/anastosi/domains/anastosi.ru/public_html/app/../src/Frontend/Core/Layout/Templates/Cookies.tpl<?php
                $includes[] = str_replace('//', '/', eval('return \'' . str_replace('\'', '\\\'', ob_get_clean()) .'\';'));
                foreach($includes as $include) if(@file_exists($include) && is_file($include)) break;
                if($this->getForceCompile() || !file_exists($this->getCompileDirectory() .'/' . $this->getCompileName($include, '/home/anastosi/domains/anastosi.ru/public_html/src/Frontend/Core/Layout/Templates'))) $this->compile('/home/anastosi/domains/anastosi.ru/public_html/src/Frontend/Core/Layout/Templates', $include);
                $return = @include $this->getCompileDirectory() .'/' . $this->getCompileName($include, '/home/anastosi/domains/anastosi.ru/public_html/src/Frontend/Core/Layout/Templates');
                if($return === false && $this->compile('/home/anastosi/domains/anastosi.ru/public_html/src/Frontend/Core/Layout/Templates', $include)) {
                    $return = @include $this->getCompileDirectory() .'/' . $this->getCompileName($include, '/home/anastosi/domains/anastosi.ru/public_html/src/Frontend/Core/Layout/Templates');
                }
?>

<div id="container">
<section>
			
			<?php
				if(isset(${'positionMain'})) $this->iterations['a6fd4cb1fd8a0c093e18aa408b490c0b_Home.tpl.php_1']['old'] = ${'positionMain'};
				$this->iterations['a6fd4cb1fd8a0c093e18aa408b490c0b_Home.tpl.php_1']['iteration'] = $this->variables['positionMain'];
				$this->iterations['a6fd4cb1fd8a0c093e18aa408b490c0b_Home.tpl.php_1']['i'] = 1;
				$this->iterations['a6fd4cb1fd8a0c093e18aa408b490c0b_Home.tpl.php_1']['count'] = count($this->iterations['a6fd4cb1fd8a0c093e18aa408b490c0b_Home.tpl.php_1']['iteration']);
				foreach((array) $this->iterations['a6fd4cb1fd8a0c093e18aa408b490c0b_Home.tpl.php_1']['iteration'] as ${'positionMain'})
				{
					if(!isset(${'positionMain'}['first']) && $this->iterations['a6fd4cb1fd8a0c093e18aa408b490c0b_Home.tpl.php_1']['i'] == 1) ${'positionMain'}['first'] = true;
					if(!isset(${'positionMain'}['last']) && $this->iterations['a6fd4cb1fd8a0c093e18aa408b490c0b_Home.tpl.php_1']['i'] == $this->iterations['a6fd4cb1fd8a0c093e18aa408b490c0b_Home.tpl.php_1']['count']) ${'positionMain'}['last'] = true;
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
					$this->iterations['a6fd4cb1fd8a0c093e18aa408b490c0b_Home.tpl.php_1']['i']++;
				}
				if(isset($this->iterations['a6fd4cb1fd8a0c093e18aa408b490c0b_Home.tpl.php_1']['old'])) ${'positionMain'} = $this->iterations['a6fd4cb1fd8a0c093e18aa408b490c0b_Home.tpl.php_1']['old'];
				else unset($this->iterations['a6fd4cb1fd8a0c093e18aa408b490c0b_Home.tpl.php_1']);
				?>
</section>

		<footer>
			<?php $includes = array();
                ob_start();
                ?>Core/Layout/Templates/Footer.tpl<?php
                $includes[] = str_replace('//', '/', eval('return \'' . str_replace('\'', '\\\'', ob_get_clean()) .'\';'));
                ob_start();
                ?>/home/anastosi/domains/anastosi.ru/public_html/app/../src/Frontend/Themes/Core/Core/Layout/Templates/Footer.tpl<?php
                $includes[] = str_replace('//', '/', eval('return \'' . str_replace('\'', '\\\'', ob_get_clean()) .'\';'));
                ob_start();
                ?>/home/anastosi/domains/anastosi.ru/public_html/app/../src/Frontend/Core/Layout/Templates/Footer.tpl<?php
                $includes[] = str_replace('//', '/', eval('return \'' . str_replace('\'', '\\\'', ob_get_clean()) .'\';'));
                foreach($includes as $include) if(@file_exists($include) && is_file($include)) break;
                if($this->getForceCompile() || !file_exists($this->getCompileDirectory() .'/' . $this->getCompileName($include, '/home/anastosi/domains/anastosi.ru/public_html/src/Frontend/Core/Layout/Templates'))) $this->compile('/home/anastosi/domains/anastosi.ru/public_html/src/Frontend/Core/Layout/Templates', $include);
                $return = @include $this->getCompileDirectory() .'/' . $this->getCompileName($include, '/home/anastosi/domains/anastosi.ru/public_html/src/Frontend/Core/Layout/Templates');
                if($return === false && $this->compile('/home/anastosi/domains/anastosi.ru/public_html/src/Frontend/Core/Layout/Templates', $include)) {
                    $return = @include $this->getCompileDirectory() .'/' . $this->getCompileName($include, '/home/anastosi/domains/anastosi.ru/public_html/src/Frontend/Core/Layout/Templates');
                }
?>
		</footer>
	</div>
	
	<?php
				if(isset(${'jsFiles'})) $this->iterations['a6fd4cb1fd8a0c093e18aa408b490c0b_Home.tpl.php_2']['old'] = ${'jsFiles'};
				$this->iterations['a6fd4cb1fd8a0c093e18aa408b490c0b_Home.tpl.php_2']['iteration'] = $this->variables['jsFiles'];
				$this->iterations['a6fd4cb1fd8a0c093e18aa408b490c0b_Home.tpl.php_2']['i'] = 1;
				$this->iterations['a6fd4cb1fd8a0c093e18aa408b490c0b_Home.tpl.php_2']['count'] = count($this->iterations['a6fd4cb1fd8a0c093e18aa408b490c0b_Home.tpl.php_2']['iteration']);
				foreach((array) $this->iterations['a6fd4cb1fd8a0c093e18aa408b490c0b_Home.tpl.php_2']['iteration'] as ${'jsFiles'})
				{
					if(!isset(${'jsFiles'}['first']) && $this->iterations['a6fd4cb1fd8a0c093e18aa408b490c0b_Home.tpl.php_2']['i'] == 1) ${'jsFiles'}['first'] = true;
					if(!isset(${'jsFiles'}['last']) && $this->iterations['a6fd4cb1fd8a0c093e18aa408b490c0b_Home.tpl.php_2']['i'] == $this->iterations['a6fd4cb1fd8a0c093e18aa408b490c0b_Home.tpl.php_2']['count']) ${'jsFiles'}['last'] = true;
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
					$this->iterations['a6fd4cb1fd8a0c093e18aa408b490c0b_Home.tpl.php_2']['i']++;
				}
				if(isset($this->iterations['a6fd4cb1fd8a0c093e18aa408b490c0b_Home.tpl.php_2']['old'])) ${'jsFiles'} = $this->iterations['a6fd4cb1fd8a0c093e18aa408b490c0b_Home.tpl.php_2']['old'];
				else unset($this->iterations['a6fd4cb1fd8a0c093e18aa408b490c0b_Home.tpl.php_2']);
				?>
	
	<?php echo $this->variables['siteHTMLFooter']; ?>
</body>
</html>
