<?php error_reporting(0); ini_set('display_errors', 'Off'); ?>
<?php
				ob_start();
				?><?php echo $this->variables['BACKEND_CORE_PATH']; ?>/Layout/Templates/Head.tpl<?php
				$include = eval('return \'' . str_replace('\'', '\\\'', ob_get_clean()) .'\';');
				if($this->getForceCompile() || !file_exists($this->getCompileDirectory() .'/' . $this->getCompileName($include, '/home/anastosi/domains/anastosi.ru/public_html/src/Backend/Modules/Extensions/Layout/Templates'))) $this->compile('/home/anastosi/domains/anastosi.ru/public_html/src/Backend/Modules/Extensions/Layout/Templates', $include);
				$return = @include $this->getCompileDirectory() .'/' . $this->getCompileName($include, '/home/anastosi/domains/anastosi.ru/public_html/src/Backend/Modules/Extensions/Layout/Templates');
				if($return === false && $this->compile('/home/anastosi/domains/anastosi.ru/public_html/src/Backend/Modules/Extensions/Layout/Templates', $include))
				{
					$return = @include $this->getCompileDirectory() .'/' . $this->getCompileName($include, '/home/anastosi/domains/anastosi.ru/public_html/src/Backend/Modules/Extensions/Layout/Templates');
				}
?>
<?php
				ob_start();
				?><?php echo $this->variables['BACKEND_CORE_PATH']; ?>/Layout/Templates/StructureStartModule.tpl<?php
				$include = eval('return \'' . str_replace('\'', '\\\'', ob_get_clean()) .'\';');
				if($this->getForceCompile() || !file_exists($this->getCompileDirectory() .'/' . $this->getCompileName($include, '/home/anastosi/domains/anastosi.ru/public_html/src/Backend/Modules/Extensions/Layout/Templates'))) $this->compile('/home/anastosi/domains/anastosi.ru/public_html/src/Backend/Modules/Extensions/Layout/Templates', $include);
				$return = @include $this->getCompileDirectory() .'/' . $this->getCompileName($include, '/home/anastosi/domains/anastosi.ru/public_html/src/Backend/Modules/Extensions/Layout/Templates');
				if($return === false && $this->compile('/home/anastosi/domains/anastosi.ru/public_html/src/Backend/Modules/Extensions/Layout/Templates', $include))
				{
					$return = @include $this->getCompileDirectory() .'/' . $this->getCompileName($include, '/home/anastosi/domains/anastosi.ru/public_html/src/Backend/Modules/Extensions/Layout/Templates');
				}
?>

<div class="pageTitle">
	<h2><?php echo SpoonFilter::ucfirst($this->variables['lblExtensions']); ?>: <?php echo $this->variables['lblModules']; ?></h2>
	<div class="buttonHolderRight">
		<?php
					if(isset($this->variables['showExtensionsUploadModule']) && count($this->variables['showExtensionsUploadModule']) != 0 && $this->variables['showExtensionsUploadModule'] != '' && $this->variables['showExtensionsUploadModule'] !== false)
					{
						?>
		<a href="<?php echo Backend\Core\Engine\TemplateModifiers::getURL($this->variables['var'], 'upload_module'); ?>" class="button icon iconImport" title="<?php echo SpoonFilter::ucfirst($this->variables['lblUploadModule']); ?>">
			<span><?php echo SpoonFilter::ucfirst($this->variables['lblUploadModule']); ?></span>
		</a>
		<?php } ?>

		<a href="http://www.fork-cms.com/extensions" class="button icon iconNext" title="<?php echo SpoonFilter::ucfirst($this->variables['lblFindModules']); ?>">
			<span><?php echo SpoonFilter::ucfirst($this->variables['lblFindModules']); ?></span>
		</a>
	</div>
</div>

<?php
					if(isset($this->variables['warnings']) && count($this->variables['warnings']) != 0 && $this->variables['warnings'] != '' && $this->variables['warnings'] !== false)
					{
						?>
	<div class="generalMessage infoMessage">
		<p><strong><?php echo $this->variables['msgModulesWarnings']; ?>:</strong></p>
		<ul>
			<li>
				<strong><?php echo $this->variables['warnings']['module']; ?></strong>
				<ul>
					<?php
				if(isset(${'warnings'}['warnings'])) $this->iterations['3446a3d55f32fac9d07fd739b03662a7_Modules.tpl.php_1']['warnings']['old'] = ${'warnings'}['warnings'];
				$this->iterations['3446a3d55f32fac9d07fd739b03662a7_Modules.tpl.php_1']['warnings']['iteration'] = $this->variables['warnings']['warnings'];
				$this->iterations['3446a3d55f32fac9d07fd739b03662a7_Modules.tpl.php_1']['warnings']['i'] = 1;
				$this->iterations['3446a3d55f32fac9d07fd739b03662a7_Modules.tpl.php_1']['warnings']['count'] = count($this->iterations['3446a3d55f32fac9d07fd739b03662a7_Modules.tpl.php_1']['warnings']['iteration']);
				foreach((array) $this->iterations['3446a3d55f32fac9d07fd739b03662a7_Modules.tpl.php_1']['warnings']['iteration'] as ${'warnings'}['warnings'])
				{
					if(!isset(${'warnings'}['warnings']['first']) && $this->iterations['3446a3d55f32fac9d07fd739b03662a7_Modules.tpl.php_1']['warnings']['i'] == 1) ${'warnings'}['warnings']['first'] = true;
					if(!isset(${'warnings'}['warnings']['last']) && $this->iterations['3446a3d55f32fac9d07fd739b03662a7_Modules.tpl.php_1']['warnings']['i'] == $this->iterations['3446a3d55f32fac9d07fd739b03662a7_Modules.tpl.php_1']['warnings']['count']) ${'warnings'}['warnings']['last'] = true;
					if(isset(${'warnings'}['warnings']['formElements']) && is_array(${'warnings'}['warnings']['formElements']))
					{
						foreach(${'warnings'}['warnings']['formElements'] as $name => $object)
						{
							${'warnings'}['warnings'][$name] = $object->parse();
							${'warnings'}['warnings'][$name .'Error'] = (is_callable(array($object, 'getErrors')) && $object->getErrors() != '') ? '<span class="formError">' . $object->getErrors() .'</span>' : '';
						}
					} ?>
						<li>- <?php echo ${'warnings'}['warnings']['message']; ?></li>
					<?php
					$this->iterations['3446a3d55f32fac9d07fd739b03662a7_Modules.tpl.php_1']['warnings']['i']++;
				}
				if(isset($this->iterations['3446a3d55f32fac9d07fd739b03662a7_Modules.tpl.php_1']['warnings']['old'])) ${'warnings'}['warnings'] = $this->iterations['3446a3d55f32fac9d07fd739b03662a7_Modules.tpl.php_1']['warnings']['old'];
				else unset($this->iterations['3446a3d55f32fac9d07fd739b03662a7_Modules.tpl.php_1']['warnings']);
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
		<h3><?php echo SpoonFilter::ucfirst($this->variables['lblInstalledModules']); ?></h3>
	</div>
	<?php echo $this->variables['dataGridInstalledModules']; ?>
</div>
<?php } ?>
<?php if(!isset($this->variables['dataGridInstalledModules']) || count($this->variables['dataGridInstalledModules']) == 0 || $this->variables['dataGridInstalledModules'] == '' || $this->variables['dataGridInstalledModules'] === false): ?><p><?php echo $this->variables['msgNoModulesInstalled']; ?></p><?php endif; ?>

<?php
					if(isset($this->variables['dataGridInstallableModules']) && count($this->variables['dataGridInstallableModules']) != 0 && $this->variables['dataGridInstallableModules'] != '' && $this->variables['dataGridInstallableModules'] !== false)
					{
						?>
	<div class="dataGridHolder">
		<div class="tableHeading">
			<h3><?php echo SpoonFilter::ucfirst($this->variables['lblInstallableModules']); ?></h3>
		</div>
		<?php echo $this->variables['dataGridInstallableModules']; ?>
	</div>
<?php } ?>

<?php
				ob_start();
				?><?php echo $this->variables['BACKEND_CORE_PATH']; ?>/Layout/Templates/StructureEndModule.tpl<?php
				$include = eval('return \'' . str_replace('\'', '\\\'', ob_get_clean()) .'\';');
				if($this->getForceCompile() || !file_exists($this->getCompileDirectory() .'/' . $this->getCompileName($include, '/home/anastosi/domains/anastosi.ru/public_html/src/Backend/Modules/Extensions/Layout/Templates'))) $this->compile('/home/anastosi/domains/anastosi.ru/public_html/src/Backend/Modules/Extensions/Layout/Templates', $include);
				$return = @include $this->getCompileDirectory() .'/' . $this->getCompileName($include, '/home/anastosi/domains/anastosi.ru/public_html/src/Backend/Modules/Extensions/Layout/Templates');
				if($return === false && $this->compile('/home/anastosi/domains/anastosi.ru/public_html/src/Backend/Modules/Extensions/Layout/Templates', $include))
				{
					$return = @include $this->getCompileDirectory() .'/' . $this->getCompileName($include, '/home/anastosi/domains/anastosi.ru/public_html/src/Backend/Modules/Extensions/Layout/Templates');
				}
?>
<?php
				ob_start();
				?><?php echo $this->variables['BACKEND_CORE_PATH']; ?>/Layout/Templates/Footer.tpl<?php
				$include = eval('return \'' . str_replace('\'', '\\\'', ob_get_clean()) .'\';');
				if($this->getForceCompile() || !file_exists($this->getCompileDirectory() .'/' . $this->getCompileName($include, '/home/anastosi/domains/anastosi.ru/public_html/src/Backend/Modules/Extensions/Layout/Templates'))) $this->compile('/home/anastosi/domains/anastosi.ru/public_html/src/Backend/Modules/Extensions/Layout/Templates', $include);
				$return = @include $this->getCompileDirectory() .'/' . $this->getCompileName($include, '/home/anastosi/domains/anastosi.ru/public_html/src/Backend/Modules/Extensions/Layout/Templates');
				if($return === false && $this->compile('/home/anastosi/domains/anastosi.ru/public_html/src/Backend/Modules/Extensions/Layout/Templates', $include))
				{
					$return = @include $this->getCompileDirectory() .'/' . $this->getCompileName($include, '/home/anastosi/domains/anastosi.ru/public_html/src/Backend/Modules/Extensions/Layout/Templates');
				}
?>
