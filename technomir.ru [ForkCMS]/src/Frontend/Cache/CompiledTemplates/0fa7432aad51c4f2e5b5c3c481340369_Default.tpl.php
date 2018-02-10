<?php error_reporting(E_ALL | E_STRICT); ini_set('display_errors', 'On'); ?>
<?php $includes = array();
                ob_start();
                ?>Core/Layout/Templates/Head.tpl<?php
                $includes[] = str_replace('//', '/', eval('return \'' . str_replace('\'', '\\\'', ob_get_clean()) .'\';'));
                ob_start();
                ?>/home/segaz/domains/techno-mir.net/public_html/app/../src/Frontend/Themes/bootstrap/Core/Layout/Templates/Head.tpl<?php
                $includes[] = str_replace('//', '/', eval('return \'' . str_replace('\'', '\\\'', ob_get_clean()) .'\';'));
                ob_start();
                ?>/home/segaz/domains/techno-mir.net/public_html/app/../src/Frontend/Core/Layout/Templates/Head.tpl<?php
                $includes[] = str_replace('//', '/', eval('return \'' . str_replace('\'', '\\\'', ob_get_clean()) .'\';'));
                foreach($includes as $include) if(@file_exists($include) && is_file($include)) break;
                if($this->getForceCompile() || !file_exists($this->getCompileDirectory() .'/' . $this->getCompileName($include, '/home/segaz/domains/techno-mir.net/public_html/src/Frontend/Themes/bootstrap/Core/Layout/Templates'))) $this->compile('/home/segaz/domains/techno-mir.net/public_html/src/Frontend/Themes/bootstrap/Core/Layout/Templates', $include);
                $return = @include $this->getCompileDirectory() .'/' . $this->getCompileName($include, '/home/segaz/domains/techno-mir.net/public_html/src/Frontend/Themes/bootstrap/Core/Layout/Templates');
                if($return === false && $this->compile('/home/segaz/domains/techno-mir.net/public_html/src/Frontend/Themes/bootstrap/Core/Layout/Templates', $include)) {
                    $return = @include $this->getCompileDirectory() .'/' . $this->getCompileName($include, '/home/segaz/domains/techno-mir.net/public_html/src/Frontend/Themes/bootstrap/Core/Layout/Templates');
                }
if($return === false) {
                    ?>{include:Core/Layout/Templates/Head.tpl}<?php
                }
?>

<body class="<?php if(array_key_exists('LANGUAGE', (array) $this->variables)) { echo $this->variables['LANGUAGE']; } else { ?>{$LANGUAGE}<?php } ?> horizontal-layout" itemscope itemtype="http://schema.org/WebPage">
	
	<?php $includes = array();
                ob_start();
                ?>Core/Layout/Templates/Header.tpl<?php
                $includes[] = str_replace('//', '/', eval('return \'' . str_replace('\'', '\\\'', ob_get_clean()) .'\';'));
                ob_start();
                ?>/home/segaz/domains/techno-mir.net/public_html/app/../src/Frontend/Themes/bootstrap/Core/Layout/Templates/Header.tpl<?php
                $includes[] = str_replace('//', '/', eval('return \'' . str_replace('\'', '\\\'', ob_get_clean()) .'\';'));
                ob_start();
                ?>/home/segaz/domains/techno-mir.net/public_html/app/../src/Frontend/Core/Layout/Templates/Header.tpl<?php
                $includes[] = str_replace('//', '/', eval('return \'' . str_replace('\'', '\\\'', ob_get_clean()) .'\';'));
                foreach($includes as $include) if(@file_exists($include) && is_file($include)) break;
                if($this->getForceCompile() || !file_exists($this->getCompileDirectory() .'/' . $this->getCompileName($include, '/home/segaz/domains/techno-mir.net/public_html/src/Frontend/Themes/bootstrap/Core/Layout/Templates'))) $this->compile('/home/segaz/domains/techno-mir.net/public_html/src/Frontend/Themes/bootstrap/Core/Layout/Templates', $include);
                $return = @include $this->getCompileDirectory() .'/' . $this->getCompileName($include, '/home/segaz/domains/techno-mir.net/public_html/src/Frontend/Themes/bootstrap/Core/Layout/Templates');
                if($return === false && $this->compile('/home/segaz/domains/techno-mir.net/public_html/src/Frontend/Themes/bootstrap/Core/Layout/Templates', $include)) {
                    $return = @include $this->getCompileDirectory() .'/' . $this->getCompileName($include, '/home/segaz/domains/techno-mir.net/public_html/src/Frontend/Themes/bootstrap/Core/Layout/Templates');
                }
if($return === false) {
                    ?>{include:Core/Layout/Templates/Header.tpl}<?php
                }
?>

    <div class="container">
				
				<?php
					if(!isset($this->variables['positionMain']))
					{
						?>{iteration:positionMain}<?php
						$this->variables['positionMain'] = array();
						$this->iterations['0fa7432aad51c4f2e5b5c3c481340369_Default.tpl.php_1']['fail'] = true;
					}
				if(isset(${'positionMain'})) $this->iterations['0fa7432aad51c4f2e5b5c3c481340369_Default.tpl.php_1']['old'] = ${'positionMain'};
				$this->iterations['0fa7432aad51c4f2e5b5c3c481340369_Default.tpl.php_1']['iteration'] = $this->variables['positionMain'];
				$this->iterations['0fa7432aad51c4f2e5b5c3c481340369_Default.tpl.php_1']['i'] = 1;
				$this->iterations['0fa7432aad51c4f2e5b5c3c481340369_Default.tpl.php_1']['count'] = count($this->iterations['0fa7432aad51c4f2e5b5c3c481340369_Default.tpl.php_1']['iteration']);
				foreach((array) $this->iterations['0fa7432aad51c4f2e5b5c3c481340369_Default.tpl.php_1']['iteration'] as ${'positionMain'})
				{
					if(!isset(${'positionMain'}['first']) && $this->iterations['0fa7432aad51c4f2e5b5c3c481340369_Default.tpl.php_1']['i'] == 1) ${'positionMain'}['first'] = true;
					if(!isset(${'positionMain'}['last']) && $this->iterations['0fa7432aad51c4f2e5b5c3c481340369_Default.tpl.php_1']['i'] == $this->iterations['0fa7432aad51c4f2e5b5c3c481340369_Default.tpl.php_1']['count']) ${'positionMain'}['last'] = true;
					if(isset(${'positionMain'}['formElements']) && is_array(${'positionMain'}['formElements']))
					{
						foreach(${'positionMain'}['formElements'] as $name => $object)
						{
							${'positionMain'}[$name] = $object->parse();
							${'positionMain'}[$name .'Error'] = (is_callable(array($object, 'getErrors')) && $object->getErrors() != '') ? '<span class="formError">' . $object->getErrors() .'</span>' : '';
						}
					} ?>
					<?php if(array_key_exists('blockContent', (array) ${'positionMain'})) { echo ${'positionMain'}['blockContent']; } else { ?>{$positionMain->blockContent}<?php } ?>
				<?php
					$this->iterations['0fa7432aad51c4f2e5b5c3c481340369_Default.tpl.php_1']['i']++;
				}
					if(isset($this->iterations['0fa7432aad51c4f2e5b5c3c481340369_Default.tpl.php_1']['fail']) && $this->iterations['0fa7432aad51c4f2e5b5c3c481340369_Default.tpl.php_1']['fail'] == true)
					{
						?>{/iteration:positionMain}<?php
					}
				if(isset($this->iterations['0fa7432aad51c4f2e5b5c3c481340369_Default.tpl.php_1']['old'])) ${'positionMain'} = $this->iterations['0fa7432aad51c4f2e5b5c3c481340369_Default.tpl.php_1']['old'];
				else unset($this->iterations['0fa7432aad51c4f2e5b5c3c481340369_Default.tpl.php_1']);
				?>
	</div>

	<?php $includes = array();
                ob_start();
                ?>Core/Layout/Templates/Footer.tpl<?php
                $includes[] = str_replace('//', '/', eval('return \'' . str_replace('\'', '\\\'', ob_get_clean()) .'\';'));
                ob_start();
                ?>/home/segaz/domains/techno-mir.net/public_html/app/../src/Frontend/Themes/bootstrap/Core/Layout/Templates/Footer.tpl<?php
                $includes[] = str_replace('//', '/', eval('return \'' . str_replace('\'', '\\\'', ob_get_clean()) .'\';'));
                ob_start();
                ?>/home/segaz/domains/techno-mir.net/public_html/app/../src/Frontend/Core/Layout/Templates/Footer.tpl<?php
                $includes[] = str_replace('//', '/', eval('return \'' . str_replace('\'', '\\\'', ob_get_clean()) .'\';'));
                foreach($includes as $include) if(@file_exists($include) && is_file($include)) break;
                if($this->getForceCompile() || !file_exists($this->getCompileDirectory() .'/' . $this->getCompileName($include, '/home/segaz/domains/techno-mir.net/public_html/src/Frontend/Themes/bootstrap/Core/Layout/Templates'))) $this->compile('/home/segaz/domains/techno-mir.net/public_html/src/Frontend/Themes/bootstrap/Core/Layout/Templates', $include);
                $return = @include $this->getCompileDirectory() .'/' . $this->getCompileName($include, '/home/segaz/domains/techno-mir.net/public_html/src/Frontend/Themes/bootstrap/Core/Layout/Templates');
                if($return === false && $this->compile('/home/segaz/domains/techno-mir.net/public_html/src/Frontend/Themes/bootstrap/Core/Layout/Templates', $include)) {
                    $return = @include $this->getCompileDirectory() .'/' . $this->getCompileName($include, '/home/segaz/domains/techno-mir.net/public_html/src/Frontend/Themes/bootstrap/Core/Layout/Templates');
                }
if($return === false) {
                    ?>{include:Core/Layout/Templates/Footer.tpl}<?php
                }
?>

	<noscript>
		<div class="message notice">
			<h4><?php if(array_key_exists('lblEnableJavascript', (array) $this->variables)) { echo SpoonFilter::ucfirst($this->variables['lblEnableJavascript']); } else { ?>{$lblEnableJavascript|ucfirst}<?php } ?></h4>
			<p><?php if(array_key_exists('msgEnableJavascript', (array) $this->variables)) { echo $this->variables['msgEnableJavascript']; } else { ?>{$msgEnableJavascript}<?php } ?></p>
		</div>
	</noscript>	

	
	<?php
					if(!isset($this->variables['jsFiles']))
					{
						?>{iteration:jsFiles}<?php
						$this->variables['jsFiles'] = array();
						$this->iterations['0fa7432aad51c4f2e5b5c3c481340369_Default.tpl.php_2']['fail'] = true;
					}
				if(isset(${'jsFiles'})) $this->iterations['0fa7432aad51c4f2e5b5c3c481340369_Default.tpl.php_2']['old'] = ${'jsFiles'};
				$this->iterations['0fa7432aad51c4f2e5b5c3c481340369_Default.tpl.php_2']['iteration'] = $this->variables['jsFiles'];
				$this->iterations['0fa7432aad51c4f2e5b5c3c481340369_Default.tpl.php_2']['i'] = 1;
				$this->iterations['0fa7432aad51c4f2e5b5c3c481340369_Default.tpl.php_2']['count'] = count($this->iterations['0fa7432aad51c4f2e5b5c3c481340369_Default.tpl.php_2']['iteration']);
				foreach((array) $this->iterations['0fa7432aad51c4f2e5b5c3c481340369_Default.tpl.php_2']['iteration'] as ${'jsFiles'})
				{
					if(!isset(${'jsFiles'}['first']) && $this->iterations['0fa7432aad51c4f2e5b5c3c481340369_Default.tpl.php_2']['i'] == 1) ${'jsFiles'}['first'] = true;
					if(!isset(${'jsFiles'}['last']) && $this->iterations['0fa7432aad51c4f2e5b5c3c481340369_Default.tpl.php_2']['i'] == $this->iterations['0fa7432aad51c4f2e5b5c3c481340369_Default.tpl.php_2']['count']) ${'jsFiles'}['last'] = true;
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
					$this->iterations['0fa7432aad51c4f2e5b5c3c481340369_Default.tpl.php_2']['i']++;
				}
					if(isset($this->iterations['0fa7432aad51c4f2e5b5c3c481340369_Default.tpl.php_2']['fail']) && $this->iterations['0fa7432aad51c4f2e5b5c3c481340369_Default.tpl.php_2']['fail'] == true)
					{
						?>{/iteration:jsFiles}<?php
					}
				if(isset($this->iterations['0fa7432aad51c4f2e5b5c3c481340369_Default.tpl.php_2']['old'])) ${'jsFiles'} = $this->iterations['0fa7432aad51c4f2e5b5c3c481340369_Default.tpl.php_2']['old'];
				else unset($this->iterations['0fa7432aad51c4f2e5b5c3c481340369_Default.tpl.php_2']);
				?>

	
	<script src="<?php if(array_key_exists('THEME_URL', (array) $this->variables)) { echo $this->variables['THEME_URL']; } else { ?>{$THEME_URL}<?php } ?>/Core/Js/boots.js"></script>
	<script src="<?php if(array_key_exists('THEME_URL', (array) $this->variables)) { echo $this->variables['THEME_URL']; } else { ?>{$THEME_URL}<?php } ?>/Core/Js/bootstrap.min.js"></script>

	
	<?php if(array_key_exists('siteHTMLFooter', (array) $this->variables)) { echo $this->variables['siteHTMLFooter']; } else { ?>{$siteHTMLFooter}<?php } ?>
</body>
</html>