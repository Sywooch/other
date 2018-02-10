<?php error_reporting(E_ALL | E_STRICT); ini_set('display_errors', 'On'); ?>
<div class="navbar navbar-inverse navbar-fixed-top" role="navigation">
	<div class="container">
		<div class="navbar-header">
			<button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
			<!--@ToDo label Toggle Navigation -->
			<span class="sr-only">Toggle navigation</span>
			<span class="icon-bar"></span>
			<span class="icon-bar"></span>
			<span class="icon-bar"></span>
			</button>
			<a class="navbar-brand" href="/"><?php if(array_key_exists('siteTitle', (array) $this->variables)) { echo $this->variables['siteTitle']; } else { ?>{$siteTitle}<?php } ?></a>
		</div>
		<div class="navbar-collapse collapse">
			
			<nav id="headerNavigation">
				<h4><?php if(array_key_exists('lblMainNavigation', (array) $this->variables)) { echo SpoonFilter::ucfirst($this->variables['lblMainNavigation']); } else { ?>{$lblMainNavigation|ucfirst}<?php } ?></h4>
				<ul class="nav navbar-nav">
				<?php if(array_key_exists('var', (array) $this->variables)) { echo Frontend\Core\Engine\TemplateModifiers::getNavigation($this->variables['var'], 'page', 0, 2); } else { ?>{$var|getnavigation:'page':0:2}<?php } ?>
			</nav>


			
			<nav id="headerLanguage">
				<h4><?php if(array_key_exists('lblLanguage', (array) $this->variables)) { echo SpoonFilter::ucfirst($this->variables['lblLanguage']); } else { ?>{$lblLanguage|ucfirst}<?php } ?></h4>
				<?php $includes = array();
                ob_start();
                ?>Core/Layout/Templates/Languages.tpl<?php
                $includes[] = str_replace('//', '/', eval('return \'' . str_replace('\'', '\\\'', ob_get_clean()) .'\';'));
                ob_start();
                ?>/home/segaz/domains/techno-mir.net/public_html/app/../src/Frontend/Themes/bootstrap/Core/Layout/Templates/Languages.tpl<?php
                $includes[] = str_replace('//', '/', eval('return \'' . str_replace('\'', '\\\'', ob_get_clean()) .'\';'));
                ob_start();
                ?>/home/segaz/domains/techno-mir.net/public_html/app/../src/Frontend/Core/Layout/Templates/Languages.tpl<?php
                $includes[] = str_replace('//', '/', eval('return \'' . str_replace('\'', '\\\'', ob_get_clean()) .'\';'));
                foreach($includes as $include) if(@file_exists($include) && is_file($include)) break;
                if($this->getForceCompile() || !file_exists($this->getCompileDirectory() .'/' . $this->getCompileName($include, '/home/segaz/domains/techno-mir.net/public_html/src/Frontend/Themes/bootstrap/Core/Layout/Templates'))) $this->compile('/home/segaz/domains/techno-mir.net/public_html/src/Frontend/Themes/bootstrap/Core/Layout/Templates', $include);
                $return = @include $this->getCompileDirectory() .'/' . $this->getCompileName($include, '/home/segaz/domains/techno-mir.net/public_html/src/Frontend/Themes/bootstrap/Core/Layout/Templates');
                if($return === false && $this->compile('/home/segaz/domains/techno-mir.net/public_html/src/Frontend/Themes/bootstrap/Core/Layout/Templates', $include)) {
                    $return = @include $this->getCompileDirectory() .'/' . $this->getCompileName($include, '/home/segaz/domains/techno-mir.net/public_html/src/Frontend/Themes/bootstrap/Core/Layout/Templates');
                }
if($return === false) {
                    ?>{include:Core/Layout/Templates/Languages.tpl}<?php
                }
?>
			</nav>

			
			<?php
					if(!isset($this->variables['positionSearch']))
					{
						?>{iteration:positionSearch}<?php
						$this->variables['positionSearch'] = array();
						$this->iterations['57b531c60db39b3903355dce3f5550f1_Header.tpl.php_1']['fail'] = true;
					}
				if(isset(${'positionSearch'})) $this->iterations['57b531c60db39b3903355dce3f5550f1_Header.tpl.php_1']['old'] = ${'positionSearch'};
				$this->iterations['57b531c60db39b3903355dce3f5550f1_Header.tpl.php_1']['iteration'] = $this->variables['positionSearch'];
				$this->iterations['57b531c60db39b3903355dce3f5550f1_Header.tpl.php_1']['i'] = 1;
				$this->iterations['57b531c60db39b3903355dce3f5550f1_Header.tpl.php_1']['count'] = count($this->iterations['57b531c60db39b3903355dce3f5550f1_Header.tpl.php_1']['iteration']);
				foreach((array) $this->iterations['57b531c60db39b3903355dce3f5550f1_Header.tpl.php_1']['iteration'] as ${'positionSearch'})
				{
					if(!isset(${'positionSearch'}['first']) && $this->iterations['57b531c60db39b3903355dce3f5550f1_Header.tpl.php_1']['i'] == 1) ${'positionSearch'}['first'] = true;
					if(!isset(${'positionSearch'}['last']) && $this->iterations['57b531c60db39b3903355dce3f5550f1_Header.tpl.php_1']['i'] == $this->iterations['57b531c60db39b3903355dce3f5550f1_Header.tpl.php_1']['count']) ${'positionSearch'}['last'] = true;
					if(isset(${'positionSearch'}['formElements']) && is_array(${'positionSearch'}['formElements']))
					{
						foreach(${'positionSearch'}['formElements'] as $name => $object)
						{
							${'positionSearch'}[$name] = $object->parse();
							${'positionSearch'}[$name .'Error'] = (is_callable(array($object, 'getErrors')) && $object->getErrors() != '') ? '<span class="formError">' . $object->getErrors() .'</span>' : '';
						}
					} ?>
				<?php if(!isset(${'positionSearch'}['blockIsHTML']) || count(${'positionSearch'}['blockIsHTML']) == 0 || ${'positionSearch'}['blockIsHTML'] == '' || ${'positionSearch'}['blockIsHTML'] === false): ?>
					<?php if(array_key_exists('blockContent', (array) ${'positionSearch'})) { echo ${'positionSearch'}['blockContent']; } else { ?>{$positionSearch->blockContent}<?php } ?>
				<?php endif; ?>
			<?php
					$this->iterations['57b531c60db39b3903355dce3f5550f1_Header.tpl.php_1']['i']++;
				}
					if(isset($this->iterations['57b531c60db39b3903355dce3f5550f1_Header.tpl.php_1']['fail']) && $this->iterations['57b531c60db39b3903355dce3f5550f1_Header.tpl.php_1']['fail'] == true)
					{
						?>{/iteration:positionSearch}<?php
					}
				if(isset($this->iterations['57b531c60db39b3903355dce3f5550f1_Header.tpl.php_1']['old'])) ${'positionSearch'} = $this->iterations['57b531c60db39b3903355dce3f5550f1_Header.tpl.php_1']['old'];
				else unset($this->iterations['57b531c60db39b3903355dce3f5550f1_Header.tpl.php_1']);
				?>

		</div>
	</div>
</div>