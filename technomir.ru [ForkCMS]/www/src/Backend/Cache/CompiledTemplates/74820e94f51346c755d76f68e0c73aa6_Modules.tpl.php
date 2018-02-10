<?php error_reporting(E_ALL | E_STRICT); ini_set('display_errors', 'On'); ?>
<?php
				ob_start();
				?><?php if(array_key_exists('BACKEND_CORE_PATH', (array) $this->variables)) { echo $this->variables['BACKEND_CORE_PATH']; } else { ?>{$BACKEND_CORE_PATH}<?php } ?>/Layout/Templates/Head.tpl<?php
				$include = eval('return \'' . str_replace('\'', '\\\'', ob_get_clean()) .'\';');
				if($this->getForceCompile() || !file_exists($this->getCompileDirectory() .'/' . $this->getCompileName($include, '/home/segaz/domains/techno-mir.net/public_html/src/Backend/Modules/Extensions/Layout/Templates'))) $this->compile('/home/segaz/domains/techno-mir.net/public_html/src/Backend/Modules/Extensions/Layout/Templates', $include);
				$return = @include $this->getCompileDirectory() .'/' . $this->getCompileName($include, '/home/segaz/domains/techno-mir.net/public_html/src/Backend/Modules/Extensions/Layout/Templates');
				if($return === false && $this->compile('/home/segaz/domains/techno-mir.net/public_html/src/Backend/Modules/Extensions/Layout/Templates', $include))
				{
					$return = @include $this->getCompileDirectory() .'/' . $this->getCompileName($include, '/home/segaz/domains/techno-mir.net/public_html/src/Backend/Modules/Extensions/Layout/Templates');
				}
if($return === false)
				{
					?>{include:<?php if(array_key_exists('BACKEND_CORE_PATH', (array) $this->variables)) { echo $this->variables['BACKEND_CORE_PATH']; } else { ?>{$BACKEND_CORE_PATH}<?php } ?>/Layout/Templates/Head.tpl}<?php
				}
?>
<?php
				ob_start();
				?><?php if(array_key_exists('BACKEND_CORE_PATH', (array) $this->variables)) { echo $this->variables['BACKEND_CORE_PATH']; } else { ?>{$BACKEND_CORE_PATH}<?php } ?>/Layout/Templates/StructureStartModule.tpl<?php
				$include = eval('return \'' . str_replace('\'', '\\\'', ob_get_clean()) .'\';');
				if($this->getForceCompile() || !file_exists($this->getCompileDirectory() .'/' . $this->getCompileName($include, '/home/segaz/domains/techno-mir.net/public_html/src/Backend/Modules/Extensions/Layout/Templates'))) $this->compile('/home/segaz/domains/techno-mir.net/public_html/src/Backend/Modules/Extensions/Layout/Templates', $include);
				$return = @include $this->getCompileDirectory() .'/' . $this->getCompileName($include, '/home/segaz/domains/techno-mir.net/public_html/src/Backend/Modules/Extensions/Layout/Templates');
				if($return === false && $this->compile('/home/segaz/domains/techno-mir.net/public_html/src/Backend/Modules/Extensions/Layout/Templates', $include))
				{
					$return = @include $this->getCompileDirectory() .'/' . $this->getCompileName($include, '/home/segaz/domains/techno-mir.net/public_html/src/Backend/Modules/Extensions/Layout/Templates');
				}
if($return === false)
				{
					?>{include:<?php if(array_key_exists('BACKEND_CORE_PATH', (array) $this->variables)) { echo $this->variables['BACKEND_CORE_PATH']; } else { ?>{$BACKEND_CORE_PATH}<?php } ?>/Layout/Templates/StructureStartModule.tpl}<?php
				}
?>

<div class="pageTitle">
	<h2><?php if(array_key_exists('lblExtensions', (array) $this->variables)) { echo SpoonFilter::ucfirst($this->variables['lblExtensions']); } else { ?>{$lblExtensions|ucfirst}<?php } ?>: <?php if(array_key_exists('lblModules', (array) $this->variables)) { echo $this->variables['lblModules']; } else { ?>{$lblModules}<?php } ?></h2>
	<div class="buttonHolderRight">
		<?php
					if(isset($this->variables['showExtensionsUploadModule']) && count($this->variables['showExtensionsUploadModule']) != 0 && $this->variables['showExtensionsUploadModule'] != '' && $this->variables['showExtensionsUploadModule'] !== false)
					{
						?>
		<a href="<?php if(array_key_exists('var', (array) $this->variables)) { echo Backend\Core\Engine\TemplateModifiers::getURL($this->variables['var'], 'upload_module'); } else { ?>{$var|geturl:'upload_module'}<?php } ?>" class="button icon iconImport" title="<?php if(array_key_exists('lblUploadModule', (array) $this->variables)) { echo SpoonFilter::ucfirst($this->variables['lblUploadModule']); } else { ?>{$lblUploadModule|ucfirst}<?php } ?>">
			<span><?php if(array_key_exists('lblUploadModule', (array) $this->variables)) { echo SpoonFilter::ucfirst($this->variables['lblUploadModule']); } else { ?>{$lblUploadModule|ucfirst}<?php } ?></span>
		</a>
		<?php } ?>

		<a href="http://www.fork-cms.com/extensions" class="button icon iconNext" title="<?php if(array_key_exists('lblFindModules', (array) $this->variables)) { echo SpoonFilter::ucfirst($this->variables['lblFindModules']); } else { ?>{$lblFindModules|ucfirst}<?php } ?>">
			<span><?php if(array_key_exists('lblFindModules', (array) $this->variables)) { echo SpoonFilter::ucfirst($this->variables['lblFindModules']); } else { ?>{$lblFindModules|ucfirst}<?php } ?></span>
		</a>
	</div>
</div>

<?php
					if(isset($this->variables['warnings']) && count($this->variables['warnings']) != 0 && $this->variables['warnings'] != '' && $this->variables['warnings'] !== false)
					{
						?>
	<div class="generalMessage infoMessage">
		<p><strong><?php if(array_key_exists('msgModulesWarnings', (array) $this->variables)) { echo $this->variables['msgModulesWarnings']; } else { ?>{$msgModulesWarnings}<?php } ?>:</strong></p>
		<ul>
			<li>
				<strong><?php if(isset($this->variables['warnings']) && array_key_exists('module', (array) $this->variables['warnings'])) { echo $this->variables['warnings']['module']; } else { ?>{$warnings.module}<?php } ?></strong>
				<ul>
					<?php
					if(!isset($this->variables['warnings']['warnings']))
					{
						?>{iteration:warnings.warnings}<?php
						$this->variables['warnings']['warnings'] = array();
						$this->iterations['74820e94f51346c755d76f68e0c73aa6_Modules.tpl.php_1']['warnings']['fail'] = true;
					}
				if(isset(${'warnings'}['warnings'])) $this->iterations['74820e94f51346c755d76f68e0c73aa6_Modules.tpl.php_1']['warnings']['old'] = ${'warnings'}['warnings'];
				$this->iterations['74820e94f51346c755d76f68e0c73aa6_Modules.tpl.php_1']['warnings']['iteration'] = $this->variables['warnings']['warnings'];
				$this->iterations['74820e94f51346c755d76f68e0c73aa6_Modules.tpl.php_1']['warnings']['i'] = 1;
				$this->iterations['74820e94f51346c755d76f68e0c73aa6_Modules.tpl.php_1']['warnings']['count'] = count($this->iterations['74820e94f51346c755d76f68e0c73aa6_Modules.tpl.php_1']['warnings']['iteration']);
				foreach((array) $this->iterations['74820e94f51346c755d76f68e0c73aa6_Modules.tpl.php_1']['warnings']['iteration'] as ${'warnings'}['warnings'])
				{
					if(!isset(${'warnings'}['warnings']['first']) && $this->iterations['74820e94f51346c755d76f68e0c73aa6_Modules.tpl.php_1']['warnings']['i'] == 1) ${'warnings'}['warnings']['first'] = true;
					if(!isset(${'warnings'}['warnings']['last']) && $this->iterations['74820e94f51346c755d76f68e0c73aa6_Modules.tpl.php_1']['warnings']['i'] == $this->iterations['74820e94f51346c755d76f68e0c73aa6_Modules.tpl.php_1']['warnings']['count']) ${'warnings'}['warnings']['last'] = true;
					if(isset(${'warnings'}['warnings']['formElements']) && is_array(${'warnings'}['warnings']['formElements']))
					{
						foreach(${'warnings'}['warnings']['formElements'] as $name => $object)
						{
							${'warnings'}['warnings'][$name] = $object->parse();
							${'warnings'}['warnings'][$name .'Error'] = (is_callable(array($object, 'getErrors')) && $object->getErrors() != '') ? '<span class="formError">' . $object->getErrors() .'</span>' : '';
						}
					} ?>
						<li>- <?php if(isset(${'warnings'}['warnings']) && array_key_exists('message', (array) ${'warnings'}['warnings'])) { echo ${'warnings'}['warnings']['message']; } else { ?>{$warnings.warnings->message}<?php } ?></li>
					<?php
					$this->iterations['74820e94f51346c755d76f68e0c73aa6_Modules.tpl.php_1']['warnings']['i']++;
				}
					if(isset($this->iterations['74820e94f51346c755d76f68e0c73aa6_Modules.tpl.php_1']['warnings']['fail']) && $this->iterations['74820e94f51346c755d76f68e0c73aa6_Modules.tpl.php_1']['warnings']['fail'] == true)
					{
						?>{/iteration:warnings.warnings}<?php
					}
				if(isset($this->iterations['74820e94f51346c755d76f68e0c73aa6_Modules.tpl.php_1']['warnings']['old'])) ${'warnings'}['warnings'] = $this->iterations['74820e94f51346c755d76f68e0c73aa6_Modules.tpl.php_1']['warnings']['old'];
				else unset($this->iterations['74820e94f51346c755d76f68e0c73aa6_Modules.tpl.php_1']['warnings']);
				?>
				</ul>
			</li>
		</ul>
	</div>
<?php } ?>

<?php
					if(isset($this->variables['dataGridInstalledModules']) && count($this->variables['dataGridInstalledModules']) != 0 && $this->variables['dataGridInstalledModules'] != '' && $this->variables['dataGridInstalledModules'] !== false)
					{
						?>
<div class="dataGridHolder">
	<div class="tableHeading">
		<h3><?php if(array_key_exists('lblInstalledModules', (array) $this->variables)) { echo SpoonFilter::ucfirst($this->variables['lblInstalledModules']); } else { ?>{$lblInstalledModules|ucfirst}<?php } ?></h3>
	</div>
	<?php if(array_key_exists('dataGridInstalledModules', (array) $this->variables)) { echo $this->variables['dataGridInstalledModules']; } else { ?>{$dataGridInstalledModules}<?php } ?>
</div>
<?php } ?>
<?php if(!isset($this->variables['dataGridInstalledModules']) || count($this->variables['dataGridInstalledModules']) == 0 || $this->variables['dataGridInstalledModules'] == '' || $this->variables['dataGridInstalledModules'] === false): ?><p><?php if(array_key_exists('msgNoModulesInstalled', (array) $this->variables)) { echo $this->variables['msgNoModulesInstalled']; } else { ?>{$msgNoModulesInstalled}<?php } ?></p><?php endif; ?>

<?php
					if(isset($this->variables['dataGridInstallableModules']) && count($this->variables['dataGridInstallableModules']) != 0 && $this->variables['dataGridInstallableModules'] != '' && $this->variables['dataGridInstallableModules'] !== false)
					{
						?>
	<div class="dataGridHolder">
		<div class="tableHeading">
			<h3><?php if(array_key_exists('lblInstallableModules', (array) $this->variables)) { echo SpoonFilter::ucfirst($this->variables['lblInstallableModules']); } else { ?>{$lblInstallableModules|ucfirst}<?php } ?></h3>
		</div>
		<?php if(array_key_exists('dataGridInstallableModules', (array) $this->variables)) { echo $this->variables['dataGridInstallableModules']; } else { ?>{$dataGridInstallableModules}<?php } ?>
	</div>
<?php } ?>

<?php
				ob_start();
				?><?php if(array_key_exists('BACKEND_CORE_PATH', (array) $this->variables)) { echo $this->variables['BACKEND_CORE_PATH']; } else { ?>{$BACKEND_CORE_PATH}<?php } ?>/Layout/Templates/StructureEndModule.tpl<?php
				$include = eval('return \'' . str_replace('\'', '\\\'', ob_get_clean()) .'\';');
				if($this->getForceCompile() || !file_exists($this->getCompileDirectory() .'/' . $this->getCompileName($include, '/home/segaz/domains/techno-mir.net/public_html/src/Backend/Modules/Extensions/Layout/Templates'))) $this->compile('/home/segaz/domains/techno-mir.net/public_html/src/Backend/Modules/Extensions/Layout/Templates', $include);
				$return = @include $this->getCompileDirectory() .'/' . $this->getCompileName($include, '/home/segaz/domains/techno-mir.net/public_html/src/Backend/Modules/Extensions/Layout/Templates');
				if($return === false && $this->compile('/home/segaz/domains/techno-mir.net/public_html/src/Backend/Modules/Extensions/Layout/Templates', $include))
				{
					$return = @include $this->getCompileDirectory() .'/' . $this->getCompileName($include, '/home/segaz/domains/techno-mir.net/public_html/src/Backend/Modules/Extensions/Layout/Templates');
				}
if($return === false)
				{
					?>{include:<?php if(array_key_exists('BACKEND_CORE_PATH', (array) $this->variables)) { echo $this->variables['BACKEND_CORE_PATH']; } else { ?>{$BACKEND_CORE_PATH}<?php } ?>/Layout/Templates/StructureEndModule.tpl}<?php
				}
?>
<?php
				ob_start();
				?><?php if(array_key_exists('BACKEND_CORE_PATH', (array) $this->variables)) { echo $this->variables['BACKEND_CORE_PATH']; } else { ?>{$BACKEND_CORE_PATH}<?php } ?>/Layout/Templates/Footer.tpl<?php
				$include = eval('return \'' . str_replace('\'', '\\\'', ob_get_clean()) .'\';');
				if($this->getForceCompile() || !file_exists($this->getCompileDirectory() .'/' . $this->getCompileName($include, '/home/segaz/domains/techno-mir.net/public_html/src/Backend/Modules/Extensions/Layout/Templates'))) $this->compile('/home/segaz/domains/techno-mir.net/public_html/src/Backend/Modules/Extensions/Layout/Templates', $include);
				$return = @include $this->getCompileDirectory() .'/' . $this->getCompileName($include, '/home/segaz/domains/techno-mir.net/public_html/src/Backend/Modules/Extensions/Layout/Templates');
				if($return === false && $this->compile('/home/segaz/domains/techno-mir.net/public_html/src/Backend/Modules/Extensions/Layout/Templates', $include))
				{
					$return = @include $this->getCompileDirectory() .'/' . $this->getCompileName($include, '/home/segaz/domains/techno-mir.net/public_html/src/Backend/Modules/Extensions/Layout/Templates');
				}
if($return === false)
				{
					?>{include:<?php if(array_key_exists('BACKEND_CORE_PATH', (array) $this->variables)) { echo $this->variables['BACKEND_CORE_PATH']; } else { ?>{$BACKEND_CORE_PATH}<?php } ?>/Layout/Templates/Footer.tpl}<?php
				}
?>
