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
	<h2><?php if(array_key_exists('lblExtensions', (array) $this->variables)) { echo SpoonFilter::ucfirst($this->variables['lblExtensions']); } else { ?>{$lblExtensions|ucfirst}<?php } ?>: <?php if(array_key_exists('lblThemes', (array) $this->variables)) { echo $this->variables['lblThemes']; } else { ?>{$lblThemes}<?php } ?></h2>
	<div class="buttonHolderRight">
		<?php
					if(isset($this->variables['showExtensionsUploadTheme']) && count($this->variables['showExtensionsUploadTheme']) != 0 && $this->variables['showExtensionsUploadTheme'] != '' && $this->variables['showExtensionsUploadTheme'] !== false)
					{
						?>
		<a href="<?php if(array_key_exists('var', (array) $this->variables)) { echo Backend\Core\Engine\TemplateModifiers::getURL($this->variables['var'], 'upload_theme'); } else { ?>{$var|geturl:'upload_theme'}<?php } ?>" class="button icon iconImport" title="<?php if(array_key_exists('lblUploadTheme', (array) $this->variables)) { echo SpoonFilter::ucfirst($this->variables['lblUploadTheme']); } else { ?>{$lblUploadTheme|ucfirst}<?php } ?>">
			<span><?php if(array_key_exists('lblUploadTheme', (array) $this->variables)) { echo SpoonFilter::ucfirst($this->variables['lblUploadTheme']); } else { ?>{$lblUploadTheme|ucfirst}<?php } ?></span>
		</a>
		<?php } ?>

		<a href="http://www.fork-cms.com/extensions" class="button icon iconNext" title="<?php if(array_key_exists('lblFindThemes', (array) $this->variables)) { echo SpoonFilter::ucfirst($this->variables['lblFindThemes']); } else { ?>{$lblFindThemes|ucfirst}<?php } ?>">
			<span><?php if(array_key_exists('lblFindThemes', (array) $this->variables)) { echo SpoonFilter::ucfirst($this->variables['lblFindThemes']); } else { ?>{$lblFindThemes|ucfirst}<?php } ?></span>
		</a>
	</div>
</div>

<?php
					if(isset($this->forms['settingsThemes']))
					{
						?><form accept-charset="UTF-8" action="<?php echo $this->forms['settingsThemes']->getAction(); ?>" method="<?php echo $this->forms['settingsThemes']->getMethod(); ?>"<?php echo $this->forms['settingsThemes']->getParametersHTML(); ?>>
						<?php echo $this->forms['settingsThemes']->getField('form')->parse();
						if($this->forms['settingsThemes']->getUseToken())
						{
							?><input type="hidden" name="form_token" id="<?php echo $this->forms['settingsThemes']->getField('form_token')->getAttribute('id'); ?>" value="<?php echo htmlspecialchars($this->forms['settingsThemes']->getField('form_token')->getValue()); ?>" />
						<?php } ?>
	<?php
					if(isset($this->variables['installableThemes']) && count($this->variables['installableThemes']) != 0 && $this->variables['installableThemes'] != '' && $this->variables['installableThemes'] !== false)
					{
						?>
	<div class="box">
		<div class="heading">
			<h3><?php if(array_key_exists('lblInstallableThemes', (array) $this->variables)) { echo SpoonFilter::ucfirst($this->variables['lblInstallableThemes']); } else { ?>{$lblInstallableThemes|ucfirst}<?php } ?></h3>
		</div>
		<div class="options">
			<p><?php if(array_key_exists('msgHelpInstallableThemes', (array) $this->variables)) { echo $this->variables['msgHelpInstallableThemes']; } else { ?>{$msgHelpInstallableThemes}<?php } ?></p>
			<ul id="installableThemes" class="selectThumbList clearfix">
				<?php
					if(!isset($this->variables['installableThemes']))
					{
						?>{iteration:installableThemes}<?php
						$this->variables['installableThemes'] = array();
						$this->iterations['4e1596be93462fb88ed8d0116c724bb4_Themes.tpl.php_1']['fail'] = true;
					}
				if(isset(${'installableThemes'})) $this->iterations['4e1596be93462fb88ed8d0116c724bb4_Themes.tpl.php_1']['old'] = ${'installableThemes'};
				$this->iterations['4e1596be93462fb88ed8d0116c724bb4_Themes.tpl.php_1']['iteration'] = $this->variables['installableThemes'];
				$this->iterations['4e1596be93462fb88ed8d0116c724bb4_Themes.tpl.php_1']['i'] = 1;
				$this->iterations['4e1596be93462fb88ed8d0116c724bb4_Themes.tpl.php_1']['count'] = count($this->iterations['4e1596be93462fb88ed8d0116c724bb4_Themes.tpl.php_1']['iteration']);
				foreach((array) $this->iterations['4e1596be93462fb88ed8d0116c724bb4_Themes.tpl.php_1']['iteration'] as ${'installableThemes'})
				{
					if(!isset(${'installableThemes'}['first']) && $this->iterations['4e1596be93462fb88ed8d0116c724bb4_Themes.tpl.php_1']['i'] == 1) ${'installableThemes'}['first'] = true;
					if(!isset(${'installableThemes'}['last']) && $this->iterations['4e1596be93462fb88ed8d0116c724bb4_Themes.tpl.php_1']['i'] == $this->iterations['4e1596be93462fb88ed8d0116c724bb4_Themes.tpl.php_1']['count']) ${'installableThemes'}['last'] = true;
					if(isset(${'installableThemes'}['formElements']) && is_array(${'installableThemes'}['formElements']))
					{
						foreach(${'installableThemes'}['formElements'] as $name => $object)
						{
							${'installableThemes'}[$name] = $object->parse();
							${'installableThemes'}[$name .'Error'] = (is_callable(array($object, 'getErrors')) && $object->getErrors() != '') ? '<span class="formError">' . $object->getErrors() .'</span>' : '';
						}
					} ?>
					<li>
						<label>
							<img src="<?php if(array_key_exists('thumbnail', (array) ${'installableThemes'})) { echo ${'installableThemes'}['thumbnail']; } else { ?>{$installableThemes->thumbnail}<?php } ?>" width="172" height="129" alt="<?php if(array_key_exists('label', (array) ${'installableThemes'})) { echo SpoonFilter::ucfirst(${'installableThemes'}['label']); } else { ?>{$installableThemes->label|ucfirst}<?php } ?>" />
							<span><?php if(array_key_exists('label', (array) ${'installableThemes'})) { echo SpoonFilter::ucfirst(${'installableThemes'}['label']); } else { ?>{$installableThemes->label|ucfirst}<?php } ?></span>
						</label>
						<?php
					if(isset($this->variables['showExtensionsInstallTheme']) && count($this->variables['showExtensionsInstallTheme']) != 0 && $this->variables['showExtensionsInstallTheme'] != '' && $this->variables['showExtensionsInstallTheme'] !== false)
					{
						?>
							<a href="<?php if(array_key_exists('var', (array) $this->variables)) { echo Backend\Core\Engine\TemplateModifiers::getURL($this->variables['var'], 'install_theme'); } else { ?>{$var|geturl:'install_theme'}<?php } ?>&theme=<?php if(array_key_exists('value', (array) ${'installableThemes'})) { echo ${'installableThemes'}['value']; } else { ?>{$installableThemes->value}<?php } ?>" data-message-id="confirmInstall<?php if(array_key_exists('value', (array) ${'installableThemes'})) { echo SpoonFilter::ucfirst(${'installableThemes'}['value']); } else { ?>{$installableThemes->value|ucfirst}<?php } ?>" class="askConfirmation button icon iconNext linkButton" title="<?php if(array_key_exists('label', (array) ${'installableThemes'})) { echo SpoonFilter::ucfirst(${'installableThemes'}['label']); } else { ?>{$installableThemes->label|ucfirst}<?php } ?>"><span><?php if(array_key_exists('lblInstall', (array) $this->variables)) { echo SpoonFilter::ucfirst($this->variables['lblInstall']); } else { ?>{$lblInstall|ucfirst}<?php } ?></span></a>
							<div id="confirmInstall<?php if(array_key_exists('value', (array) ${'installableThemes'})) { echo SpoonFilter::ucfirst(${'installableThemes'}['value']); } else { ?>{$installableThemes->value|ucfirst}<?php } ?>" title="<?php if(array_key_exists('lblInstall', (array) $this->variables)) { echo SpoonFilter::ucfirst($this->variables['lblInstall']); } else { ?>{$lblInstall|ucfirst}<?php } ?>?" style="display: none;">
								<p>
									<?php if(array_key_exists('msgConfirmThemeInstall', (array) $this->variables)) { echo $this->variables['msgConfirmThemeInstall']; } else { ?>{$msgConfirmThemeInstall}<?php } ?>
								</p>
							</div>
						<?php } ?>
						<?php
					if(isset($this->variables['showExtensionsDetailTheme']) && count($this->variables['showExtensionsDetailTheme']) != 0 && $this->variables['showExtensionsDetailTheme'] != '' && $this->variables['showExtensionsDetailTheme'] !== false)
					{
						?><a href="<?php if(array_key_exists('var', (array) $this->variables)) { echo Backend\Core\Engine\TemplateModifiers::getURL($this->variables['var'], 'detail_theme'); } else { ?>{$var|geturl:'detail_theme'}<?php } ?>&theme=<?php if(array_key_exists('value', (array) ${'installableThemes'})) { echo ${'installableThemes'}['value']; } else { ?>{$installableThemes->value}<?php } ?>" class="button icon iconDetail linkButton" title="<?php if(array_key_exists('label', (array) ${'installableThemes'})) { echo SpoonFilter::ucfirst(${'installableThemes'}['label']); } else { ?>{$installableThemes->label|ucfirst}<?php } ?>"><span><?php if(array_key_exists('lblDetails', (array) $this->variables)) { echo SpoonFilter::ucfirst($this->variables['lblDetails']); } else { ?>{$lblDetails|ucfirst}<?php } ?></span></a><?php } ?>
					</li>
				<?php
					$this->iterations['4e1596be93462fb88ed8d0116c724bb4_Themes.tpl.php_1']['i']++;
				}
					if(isset($this->iterations['4e1596be93462fb88ed8d0116c724bb4_Themes.tpl.php_1']['fail']) && $this->iterations['4e1596be93462fb88ed8d0116c724bb4_Themes.tpl.php_1']['fail'] == true)
					{
						?>{/iteration:installableThemes}<?php
					}
				if(isset($this->iterations['4e1596be93462fb88ed8d0116c724bb4_Themes.tpl.php_1']['old'])) ${'installableThemes'} = $this->iterations['4e1596be93462fb88ed8d0116c724bb4_Themes.tpl.php_1']['old'];
				else unset($this->iterations['4e1596be93462fb88ed8d0116c724bb4_Themes.tpl.php_1']);
				?>
			</ul>
		</div>
	</div>
	<?php } ?>

	<div class="box">
		<div class="heading">
			<h3><?php if(array_key_exists('lblInstalledThemes', (array) $this->variables)) { echo SpoonFilter::ucfirst($this->variables['lblInstalledThemes']); } else { ?>{$lblInstalledThemes|ucfirst}<?php } ?> <abbr title="<?php if(array_key_exists('lblRequiredField', (array) $this->variables)) { echo $this->variables['lblRequiredField']; } else { ?>{$lblRequiredField}<?php } ?>">*</abbr></h3>
		</div>
		<div class="options">
			<p><?php if(array_key_exists('msgHelpThemes', (array) $this->variables)) { echo $this->variables['msgHelpThemes']; } else { ?>{$msgHelpThemes}<?php } ?></p>
			<ul id="installedThemes" class="selectThumbList clearfix">
				<?php
					if(!isset($this->variables['installedThemes']))
					{
						?>{iteration:installedThemes}<?php
						$this->variables['installedThemes'] = array();
						$this->iterations['4e1596be93462fb88ed8d0116c724bb4_Themes.tpl.php_2']['fail'] = true;
					}
				if(isset(${'installedThemes'})) $this->iterations['4e1596be93462fb88ed8d0116c724bb4_Themes.tpl.php_2']['old'] = ${'installedThemes'};
				$this->iterations['4e1596be93462fb88ed8d0116c724bb4_Themes.tpl.php_2']['iteration'] = $this->variables['installedThemes'];
				$this->iterations['4e1596be93462fb88ed8d0116c724bb4_Themes.tpl.php_2']['i'] = 1;
				$this->iterations['4e1596be93462fb88ed8d0116c724bb4_Themes.tpl.php_2']['count'] = count($this->iterations['4e1596be93462fb88ed8d0116c724bb4_Themes.tpl.php_2']['iteration']);
				foreach((array) $this->iterations['4e1596be93462fb88ed8d0116c724bb4_Themes.tpl.php_2']['iteration'] as ${'installedThemes'})
				{
					if(!isset(${'installedThemes'}['first']) && $this->iterations['4e1596be93462fb88ed8d0116c724bb4_Themes.tpl.php_2']['i'] == 1) ${'installedThemes'}['first'] = true;
					if(!isset(${'installedThemes'}['last']) && $this->iterations['4e1596be93462fb88ed8d0116c724bb4_Themes.tpl.php_2']['i'] == $this->iterations['4e1596be93462fb88ed8d0116c724bb4_Themes.tpl.php_2']['count']) ${'installedThemes'}['last'] = true;
					if(isset(${'installedThemes'}['formElements']) && is_array(${'installedThemes'}['formElements']))
					{
						foreach(${'installedThemes'}['formElements'] as $name => $object)
						{
							${'installedThemes'}[$name] = $object->parse();
							${'installedThemes'}[$name .'Error'] = (is_callable(array($object, 'getErrors')) && $object->getErrors() != '') ? '<span class="formError">' . $object->getErrors() .'</span>' : '';
						}
					} ?>
					<li<?php
					if(isset(${'installedThemes'}['selected']) && count(${'installedThemes'}['selected']) != 0 && ${'installedThemes'}['selected'] != '' && ${'installedThemes'}['selected'] !== false)
					{
						?> class="selected"<?php } ?>>
						<?php if(array_key_exists('rbtInstalledThemes', (array) ${'installedThemes'})) { echo ${'installedThemes'}['rbtInstalledThemes']; } else { ?>{$installedThemes->rbtInstalledThemes}<?php } ?>
						<label for="<?php if(array_key_exists('id', (array) ${'installedThemes'})) { echo ${'installedThemes'}['id']; } else { ?>{$installedThemes->id}<?php } ?>">
							<img src="<?php if(array_key_exists('thumbnail', (array) ${'installedThemes'})) { echo ${'installedThemes'}['thumbnail']; } else { ?>{$installedThemes->thumbnail}<?php } ?>" width="172" height="129" alt="<?php if(array_key_exists('label', (array) ${'installedThemes'})) { echo SpoonFilter::ucfirst(${'installedThemes'}['label']); } else { ?>{$installedThemes->label|ucfirst}<?php } ?>" />
							<span><?php if(array_key_exists('label', (array) ${'installedThemes'})) { echo SpoonFilter::ucfirst(${'installedThemes'}['label']); } else { ?>{$installedThemes->label|ucfirst}<?php } ?></span>
						</label>
						<?php
					if(isset($this->variables['showExtensionsDetailTheme']) && count($this->variables['showExtensionsDetailTheme']) != 0 && $this->variables['showExtensionsDetailTheme'] != '' && $this->variables['showExtensionsDetailTheme'] !== false)
					{
						?><a href="<?php if(array_key_exists('var', (array) $this->variables)) { echo Backend\Core\Engine\TemplateModifiers::getURL($this->variables['var'], 'detail_theme'); } else { ?>{$var|geturl:'detail_theme'}<?php } ?>&theme=<?php if(array_key_exists('value', (array) ${'installedThemes'})) { echo ${'installedThemes'}['value']; } else { ?>{$installedThemes->value}<?php } ?>" class="button icon iconDetail linkButton" title="<?php if(array_key_exists('label', (array) ${'installedThemes'})) { echo SpoonFilter::ucfirst(${'installedThemes'}['label']); } else { ?>{$installedThemes->label|ucfirst}<?php } ?>"><span><?php if(array_key_exists('lblDetails', (array) $this->variables)) { echo SpoonFilter::ucfirst($this->variables['lblDetails']); } else { ?>{$lblDetails|ucfirst}<?php } ?></span></a><?php } ?>
					</li>
				<?php
					$this->iterations['4e1596be93462fb88ed8d0116c724bb4_Themes.tpl.php_2']['i']++;
				}
					if(isset($this->iterations['4e1596be93462fb88ed8d0116c724bb4_Themes.tpl.php_2']['fail']) && $this->iterations['4e1596be93462fb88ed8d0116c724bb4_Themes.tpl.php_2']['fail'] == true)
					{
						?>{/iteration:installedThemes}<?php
					}
				if(isset($this->iterations['4e1596be93462fb88ed8d0116c724bb4_Themes.tpl.php_2']['old'])) ${'installedThemes'} = $this->iterations['4e1596be93462fb88ed8d0116c724bb4_Themes.tpl.php_2']['old'];
				else unset($this->iterations['4e1596be93462fb88ed8d0116c724bb4_Themes.tpl.php_2']);
				?>
			</ul>
			<?php
					if(isset($this->variables['rbtInstalledThemesError']) && count($this->variables['rbtInstalledThemesError']) != 0 && $this->variables['rbtInstalledThemesError'] != '' && $this->variables['rbtInstalledThemesError'] !== false)
					{
						?><p class="error"><?php if(array_key_exists('rbtThemesError', (array) $this->variables)) { echo $this->variables['rbtThemesError']; } else { ?>{$rbtThemesError}<?php } ?></p><?php } ?>
		</div>
	</div>

	<div class="fullwidthOptions">
		<div class="buttonHolderRight">
			<input id="save" class="inputButton button mainButton" type="submit" name="save" value="<?php if(array_key_exists('lblSave', (array) $this->variables)) { echo SpoonFilter::ucfirst($this->variables['lblSave']); } else { ?>{$lblSave|ucfirst}<?php } ?>" />
		</div>
	</div>
</form>
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
