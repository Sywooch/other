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

<body class="<?php if(array_key_exists('LANGUAGE', (array) $this->variables)) { echo $this->variables['LANGUAGE']; } else { ?>{$LANGUAGE}<?php } ?>" itemscope itemtype="http://schema.org/WebPage">

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

	
	<?php
					if(!isset($this->variables['positionMain']))
					{
						?>{iteration:positionMain}<?php
						$this->variables['positionMain'] = array();
						$this->iterations['ac618a4b6d03ebf35b83050778da1850_Home.tpl.php_1']['fail'] = true;
					}
				if(isset(${'positionMain'})) $this->iterations['ac618a4b6d03ebf35b83050778da1850_Home.tpl.php_1']['old'] = ${'positionMain'};
				$this->iterations['ac618a4b6d03ebf35b83050778da1850_Home.tpl.php_1']['iteration'] = $this->variables['positionMain'];
				$this->iterations['ac618a4b6d03ebf35b83050778da1850_Home.tpl.php_1']['i'] = 1;
				$this->iterations['ac618a4b6d03ebf35b83050778da1850_Home.tpl.php_1']['count'] = count($this->iterations['ac618a4b6d03ebf35b83050778da1850_Home.tpl.php_1']['iteration']);
				foreach((array) $this->iterations['ac618a4b6d03ebf35b83050778da1850_Home.tpl.php_1']['iteration'] as ${'positionMain'})
				{
					if(!isset(${'positionMain'}['first']) && $this->iterations['ac618a4b6d03ebf35b83050778da1850_Home.tpl.php_1']['i'] == 1) ${'positionMain'}['first'] = true;
					if(!isset(${'positionMain'}['last']) && $this->iterations['ac618a4b6d03ebf35b83050778da1850_Home.tpl.php_1']['i'] == $this->iterations['ac618a4b6d03ebf35b83050778da1850_Home.tpl.php_1']['count']) ${'positionMain'}['last'] = true;
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
		<div class="container">
			<div class="jumbotron">
				<?php if(array_key_exists('blockContent', (array) ${'positionMain'})) { echo ${'positionMain'}['blockContent']; } else { ?>{$positionMain->blockContent}<?php } ?>
				<p><a class="btn btn-lg btn-primary" href="#" role="button"><?php if(array_key_exists('lblMore', (array) $this->variables)) { echo SpoonFilter::ucfirst($this->variables['lblMore']); } else { ?>{$lblMore|ucfirst}<?php } ?> &raquo;</a></p>
			</div>
		</div>
		<?php } ?>
		<?php if(!isset(${'positionMain'}['blockIsHTML']) || count(${'positionMain'}['blockIsHTML']) == 0 || ${'positionMain'}['blockIsHTML'] == '' || ${'positionMain'}['blockIsHTML'] === false): ?>
			<div class="container">
				<?php if(array_key_exists('blockContent', (array) ${'positionMain'})) { echo ${'positionMain'}['blockContent']; } else { ?>{$positionMain->blockContent}<?php } ?>
			</div>
		<?php endif; ?>
	<?php
					$this->iterations['ac618a4b6d03ebf35b83050778da1850_Home.tpl.php_1']['i']++;
				}
					if(isset($this->iterations['ac618a4b6d03ebf35b83050778da1850_Home.tpl.php_1']['fail']) && $this->iterations['ac618a4b6d03ebf35b83050778da1850_Home.tpl.php_1']['fail'] == true)
					{
						?>{/iteration:positionMain}<?php
					}
				if(isset($this->iterations['ac618a4b6d03ebf35b83050778da1850_Home.tpl.php_1']['old'])) ${'positionMain'} = $this->iterations['ac618a4b6d03ebf35b83050778da1850_Home.tpl.php_1']['old'];
				else unset($this->iterations['ac618a4b6d03ebf35b83050778da1850_Home.tpl.php_1']);
				?>

	<div class="container">
		<div class="row">
			<div class="col-md-4">
				
				<?php
					if(!isset($this->variables['positionLeft']))
					{
						?>{iteration:positionLeft}<?php
						$this->variables['positionLeft'] = array();
						$this->iterations['ac618a4b6d03ebf35b83050778da1850_Home.tpl.php_2']['fail'] = true;
					}
				if(isset(${'positionLeft'})) $this->iterations['ac618a4b6d03ebf35b83050778da1850_Home.tpl.php_2']['old'] = ${'positionLeft'};
				$this->iterations['ac618a4b6d03ebf35b83050778da1850_Home.tpl.php_2']['iteration'] = $this->variables['positionLeft'];
				$this->iterations['ac618a4b6d03ebf35b83050778da1850_Home.tpl.php_2']['i'] = 1;
				$this->iterations['ac618a4b6d03ebf35b83050778da1850_Home.tpl.php_2']['count'] = count($this->iterations['ac618a4b6d03ebf35b83050778da1850_Home.tpl.php_2']['iteration']);
				foreach((array) $this->iterations['ac618a4b6d03ebf35b83050778da1850_Home.tpl.php_2']['iteration'] as ${'positionLeft'})
				{
					if(!isset(${'positionLeft'}['first']) && $this->iterations['ac618a4b6d03ebf35b83050778da1850_Home.tpl.php_2']['i'] == 1) ${'positionLeft'}['first'] = true;
					if(!isset(${'positionLeft'}['last']) && $this->iterations['ac618a4b6d03ebf35b83050778da1850_Home.tpl.php_2']['i'] == $this->iterations['ac618a4b6d03ebf35b83050778da1850_Home.tpl.php_2']['count']) ${'positionLeft'}['last'] = true;
					if(isset(${'positionLeft'}['formElements']) && is_array(${'positionLeft'}['formElements']))
					{
						foreach(${'positionLeft'}['formElements'] as $name => $object)
						{
							${'positionLeft'}[$name] = $object->parse();
							${'positionLeft'}[$name .'Error'] = (is_callable(array($object, 'getErrors')) && $object->getErrors() != '') ? '<span class="formError">' . $object->getErrors() .'</span>' : '';
						}
					} ?>
					<?php if(array_key_exists('blockContent', (array) ${'positionLeft'})) { echo ${'positionLeft'}['blockContent']; } else { ?>{$positionLeft->blockContent}<?php } ?>
				<?php
					$this->iterations['ac618a4b6d03ebf35b83050778da1850_Home.tpl.php_2']['i']++;
				}
					if(isset($this->iterations['ac618a4b6d03ebf35b83050778da1850_Home.tpl.php_2']['fail']) && $this->iterations['ac618a4b6d03ebf35b83050778da1850_Home.tpl.php_2']['fail'] == true)
					{
						?>{/iteration:positionLeft}<?php
					}
				if(isset($this->iterations['ac618a4b6d03ebf35b83050778da1850_Home.tpl.php_2']['old'])) ${'positionLeft'} = $this->iterations['ac618a4b6d03ebf35b83050778da1850_Home.tpl.php_2']['old'];
				else unset($this->iterations['ac618a4b6d03ebf35b83050778da1850_Home.tpl.php_2']);
				?>
			</div>
			<div class="col-md-4">
				
				<?php
					if(!isset($this->variables['positionMiddle']))
					{
						?>{iteration:positionMiddle}<?php
						$this->variables['positionMiddle'] = array();
						$this->iterations['ac618a4b6d03ebf35b83050778da1850_Home.tpl.php_3']['fail'] = true;
					}
				if(isset(${'positionMiddle'})) $this->iterations['ac618a4b6d03ebf35b83050778da1850_Home.tpl.php_3']['old'] = ${'positionMiddle'};
				$this->iterations['ac618a4b6d03ebf35b83050778da1850_Home.tpl.php_3']['iteration'] = $this->variables['positionMiddle'];
				$this->iterations['ac618a4b6d03ebf35b83050778da1850_Home.tpl.php_3']['i'] = 1;
				$this->iterations['ac618a4b6d03ebf35b83050778da1850_Home.tpl.php_3']['count'] = count($this->iterations['ac618a4b6d03ebf35b83050778da1850_Home.tpl.php_3']['iteration']);
				foreach((array) $this->iterations['ac618a4b6d03ebf35b83050778da1850_Home.tpl.php_3']['iteration'] as ${'positionMiddle'})
				{
					if(!isset(${'positionMiddle'}['first']) && $this->iterations['ac618a4b6d03ebf35b83050778da1850_Home.tpl.php_3']['i'] == 1) ${'positionMiddle'}['first'] = true;
					if(!isset(${'positionMiddle'}['last']) && $this->iterations['ac618a4b6d03ebf35b83050778da1850_Home.tpl.php_3']['i'] == $this->iterations['ac618a4b6d03ebf35b83050778da1850_Home.tpl.php_3']['count']) ${'positionMiddle'}['last'] = true;
					if(isset(${'positionMiddle'}['formElements']) && is_array(${'positionMiddle'}['formElements']))
					{
						foreach(${'positionMiddle'}['formElements'] as $name => $object)
						{
							${'positionMiddle'}[$name] = $object->parse();
							${'positionMiddle'}[$name .'Error'] = (is_callable(array($object, 'getErrors')) && $object->getErrors() != '') ? '<span class="formError">' . $object->getErrors() .'</span>' : '';
						}
					} ?>
					<?php if(array_key_exists('blockContent', (array) ${'positionMiddle'})) { echo ${'positionMiddle'}['blockContent']; } else { ?>{$positionMiddle->blockContent}<?php } ?>
				<?php
					$this->iterations['ac618a4b6d03ebf35b83050778da1850_Home.tpl.php_3']['i']++;
				}
					if(isset($this->iterations['ac618a4b6d03ebf35b83050778da1850_Home.tpl.php_3']['fail']) && $this->iterations['ac618a4b6d03ebf35b83050778da1850_Home.tpl.php_3']['fail'] == true)
					{
						?>{/iteration:positionMiddle}<?php
					}
				if(isset($this->iterations['ac618a4b6d03ebf35b83050778da1850_Home.tpl.php_3']['old'])) ${'positionMiddle'} = $this->iterations['ac618a4b6d03ebf35b83050778da1850_Home.tpl.php_3']['old'];
				else unset($this->iterations['ac618a4b6d03ebf35b83050778da1850_Home.tpl.php_3']);
				?>
			</div>
			<div class="col-md-4">
				
				<?php
					if(!isset($this->variables['positionRight']))
					{
						?>{iteration:positionRight}<?php
						$this->variables['positionRight'] = array();
						$this->iterations['ac618a4b6d03ebf35b83050778da1850_Home.tpl.php_4']['fail'] = true;
					}
				if(isset(${'positionRight'})) $this->iterations['ac618a4b6d03ebf35b83050778da1850_Home.tpl.php_4']['old'] = ${'positionRight'};
				$this->iterations['ac618a4b6d03ebf35b83050778da1850_Home.tpl.php_4']['iteration'] = $this->variables['positionRight'];
				$this->iterations['ac618a4b6d03ebf35b83050778da1850_Home.tpl.php_4']['i'] = 1;
				$this->iterations['ac618a4b6d03ebf35b83050778da1850_Home.tpl.php_4']['count'] = count($this->iterations['ac618a4b6d03ebf35b83050778da1850_Home.tpl.php_4']['iteration']);
				foreach((array) $this->iterations['ac618a4b6d03ebf35b83050778da1850_Home.tpl.php_4']['iteration'] as ${'positionRight'})
				{
					if(!isset(${'positionRight'}['first']) && $this->iterations['ac618a4b6d03ebf35b83050778da1850_Home.tpl.php_4']['i'] == 1) ${'positionRight'}['first'] = true;
					if(!isset(${'positionRight'}['last']) && $this->iterations['ac618a4b6d03ebf35b83050778da1850_Home.tpl.php_4']['i'] == $this->iterations['ac618a4b6d03ebf35b83050778da1850_Home.tpl.php_4']['count']) ${'positionRight'}['last'] = true;
					if(isset(${'positionRight'}['formElements']) && is_array(${'positionRight'}['formElements']))
					{
						foreach(${'positionRight'}['formElements'] as $name => $object)
						{
							${'positionRight'}[$name] = $object->parse();
							${'positionRight'}[$name .'Error'] = (is_callable(array($object, 'getErrors')) && $object->getErrors() != '') ? '<span class="formError">' . $object->getErrors() .'</span>' : '';
						}
					} ?>
					<?php if(array_key_exists('blockContent', (array) ${'positionRight'})) { echo ${'positionRight'}['blockContent']; } else { ?>{$positionRight->blockContent}<?php } ?>
				<?php
					$this->iterations['ac618a4b6d03ebf35b83050778da1850_Home.tpl.php_4']['i']++;
				}
					if(isset($this->iterations['ac618a4b6d03ebf35b83050778da1850_Home.tpl.php_4']['fail']) && $this->iterations['ac618a4b6d03ebf35b83050778da1850_Home.tpl.php_4']['fail'] == true)
					{
						?>{/iteration:positionRight}<?php
					}
				if(isset($this->iterations['ac618a4b6d03ebf35b83050778da1850_Home.tpl.php_4']['old'])) ${'positionRight'} = $this->iterations['ac618a4b6d03ebf35b83050778da1850_Home.tpl.php_4']['old'];
				else unset($this->iterations['ac618a4b6d03ebf35b83050778da1850_Home.tpl.php_4']);
				?>
			</div>
		</div>
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
						$this->iterations['ac618a4b6d03ebf35b83050778da1850_Home.tpl.php_5']['fail'] = true;
					}
				if(isset(${'jsFiles'})) $this->iterations['ac618a4b6d03ebf35b83050778da1850_Home.tpl.php_5']['old'] = ${'jsFiles'};
				$this->iterations['ac618a4b6d03ebf35b83050778da1850_Home.tpl.php_5']['iteration'] = $this->variables['jsFiles'];
				$this->iterations['ac618a4b6d03ebf35b83050778da1850_Home.tpl.php_5']['i'] = 1;
				$this->iterations['ac618a4b6d03ebf35b83050778da1850_Home.tpl.php_5']['count'] = count($this->iterations['ac618a4b6d03ebf35b83050778da1850_Home.tpl.php_5']['iteration']);
				foreach((array) $this->iterations['ac618a4b6d03ebf35b83050778da1850_Home.tpl.php_5']['iteration'] as ${'jsFiles'})
				{
					if(!isset(${'jsFiles'}['first']) && $this->iterations['ac618a4b6d03ebf35b83050778da1850_Home.tpl.php_5']['i'] == 1) ${'jsFiles'}['first'] = true;
					if(!isset(${'jsFiles'}['last']) && $this->iterations['ac618a4b6d03ebf35b83050778da1850_Home.tpl.php_5']['i'] == $this->iterations['ac618a4b6d03ebf35b83050778da1850_Home.tpl.php_5']['count']) ${'jsFiles'}['last'] = true;
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
					$this->iterations['ac618a4b6d03ebf35b83050778da1850_Home.tpl.php_5']['i']++;
				}
					if(isset($this->iterations['ac618a4b6d03ebf35b83050778da1850_Home.tpl.php_5']['fail']) && $this->iterations['ac618a4b6d03ebf35b83050778da1850_Home.tpl.php_5']['fail'] == true)
					{
						?>{/iteration:jsFiles}<?php
					}
				if(isset($this->iterations['ac618a4b6d03ebf35b83050778da1850_Home.tpl.php_5']['old'])) ${'jsFiles'} = $this->iterations['ac618a4b6d03ebf35b83050778da1850_Home.tpl.php_5']['old'];
				else unset($this->iterations['ac618a4b6d03ebf35b83050778da1850_Home.tpl.php_5']);
				?>

	
	<script src="<?php if(array_key_exists('THEME_URL', (array) $this->variables)) { echo $this->variables['THEME_URL']; } else { ?>{$THEME_URL}<?php } ?>/Core/Js/boots.js"></script>
	<script src="<?php if(array_key_exists('THEME_URL', (array) $this->variables)) { echo $this->variables['THEME_URL']; } else { ?>{$THEME_URL}<?php } ?>/Core/Js/bootstrap.min.js"></script>

	
	<?php if(array_key_exists('siteHTMLFooter', (array) $this->variables)) { echo $this->variables['siteHTMLFooter']; } else { ?>{$siteHTMLFooter}<?php } ?>
</body>
</html>