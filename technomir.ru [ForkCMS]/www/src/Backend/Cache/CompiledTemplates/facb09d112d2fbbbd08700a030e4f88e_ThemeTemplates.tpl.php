<?php error_reporting(0); ini_set('display_errors', 'Off'); ?>
<?php
				ob_start();
				?><?php echo $this->variables['BACKEND_CORE_PATH']; ?>/Layout/Templates/Head.tpl<?php
				$include = eval('return \'' . str_replace('\'', '\\\'', ob_get_clean()) .'\';');
				if($this->getForceCompile() || !file_exists($this->getCompileDirectory() .'/' . $this->getCompileName($include, '/home/segaz/domains/techno-mir.net/public_html/src/Backend/Modules/Extensions/Layout/Templates'))) $this->compile('/home/segaz/domains/techno-mir.net/public_html/src/Backend/Modules/Extensions/Layout/Templates', $include);
				$return = @include $this->getCompileDirectory() .'/' . $this->getCompileName($include, '/home/segaz/domains/techno-mir.net/public_html/src/Backend/Modules/Extensions/Layout/Templates');
				if($return === false && $this->compile('/home/segaz/domains/techno-mir.net/public_html/src/Backend/Modules/Extensions/Layout/Templates', $include))
				{
					$return = @include $this->getCompileDirectory() .'/' . $this->getCompileName($include, '/home/segaz/domains/techno-mir.net/public_html/src/Backend/Modules/Extensions/Layout/Templates');
				}
?>
<?php
				ob_start();
				?><?php echo $this->variables['BACKEND_CORE_PATH']; ?>/Layout/Templates/StructureStartModule.tpl<?php
				$include = eval('return \'' . str_replace('\'', '\\\'', ob_get_clean()) .'\';');
				if($this->getForceCompile() || !file_exists($this->getCompileDirectory() .'/' . $this->getCompileName($include, '/home/segaz/domains/techno-mir.net/public_html/src/Backend/Modules/Extensions/Layout/Templates'))) $this->compile('/home/segaz/domains/techno-mir.net/public_html/src/Backend/Modules/Extensions/Layout/Templates', $include);
				$return = @include $this->getCompileDirectory() .'/' . $this->getCompileName($include, '/home/segaz/domains/techno-mir.net/public_html/src/Backend/Modules/Extensions/Layout/Templates');
				if($return === false && $this->compile('/home/segaz/domains/techno-mir.net/public_html/src/Backend/Modules/Extensions/Layout/Templates', $include))
				{
					$return = @include $this->getCompileDirectory() .'/' . $this->getCompileName($include, '/home/segaz/domains/techno-mir.net/public_html/src/Backend/Modules/Extensions/Layout/Templates');
				}
?>

<?php
					if(isset($this->forms['themes']))
					{
						?><form accept-charset="UTF-8" action="<?php echo $this->forms['themes']->getAction(); ?>" method="<?php echo $this->forms['themes']->getMethod(); ?>"<?php echo $this->forms['themes']->getParametersHTML(); ?>>
						<?php echo $this->forms['themes']->getField('form')->parse();
						if($this->forms['themes']->getUseToken())
						{
							?><input type="hidden" name="form_token" id="<?php echo $this->forms['themes']->getField('form_token')->getAttribute('id'); ?>" value="<?php echo htmlspecialchars($this->forms['themes']->getField('form_token')->getValue()); ?>" />
						<?php } ?>
	<div class="pageTitle">
		<h2>
			<?php echo SpoonFilter::ucfirst($this->variables['lblExtensions']); ?>: <label for="theme"><?php echo $this->variables['lblTemplates']; ?> <?php echo $this->variables['lblFor']; ?></label> <?php echo $this->variables['ddmTheme']; ?>
		</h2>

		<?php
					if(isset($this->variables['showExtensionsAddThemeTemplate']) && count($this->variables['showExtensionsAddThemeTemplate']) != 0 && $this->variables['showExtensionsAddThemeTemplate'] != '' && $this->variables['showExtensionsAddThemeTemplate'] !== false)
					{
						?>
		<div class="buttonHolderRight">
			<a href="<?php echo Backend\Core\Engine\TemplateModifiers::getURL($this->variables['var'], 'export_theme_templates'); ?><?php
					if(isset($this->variables['selectedTheme']) && count($this->variables['selectedTheme']) != 0 && $this->variables['selectedTheme'] != '' && $this->variables['selectedTheme'] !== false)
					{
						?>&amp;theme=<?php echo $this->variables['selectedTheme']; ?><?php } ?>" class="button icon iconExport" title="<?php echo SpoonFilter::ucfirst($this->variables['lblExport']); ?>">
				<span><?php echo SpoonFilter::ucfirst($this->variables['lblExport']); ?></span>
			</a>
			<a href="<?php echo Backend\Core\Engine\TemplateModifiers::getURL($this->variables['var'], 'add_theme_template'); ?><?php
					if(isset($this->variables['selectedTheme']) && count($this->variables['selectedTheme']) != 0 && $this->variables['selectedTheme'] != '' && $this->variables['selectedTheme'] !== false)
					{
						?>&amp;theme=<?php echo $this->variables['selectedTheme']; ?><?php } ?>" class="button icon iconAdd" title="<?php echo SpoonFilter::ucfirst($this->variables['lblAddTemplate']); ?>">
				<span><?php echo SpoonFilter::ucfirst($this->variables['lblAddTemplate']); ?></span>
			</a>
		</div>
		<?php } ?>
	</div>

	<div class="dataGridHolder">
		<?php
					if(isset($this->variables['dataGrid']) && count($this->variables['dataGrid']) != 0 && $this->variables['dataGrid'] != '' && $this->variables['dataGrid'] !== false)
					{
						?><?php echo $this->variables['dataGrid']; ?><?php } ?>
		<?php if(!isset($this->variables['dataGrid']) || count($this->variables['dataGrid']) == 0 || $this->variables['dataGrid'] == '' || $this->variables['dataGrid'] === false): ?><p><?php echo $this->variables['msgNoItems']; ?></p><?php endif; ?>
	</div>
</form>
				<?php } ?>

<?php
				ob_start();
				?><?php echo $this->variables['BACKEND_CORE_PATH']; ?>/Layout/Templates/StructureEndModule.tpl<?php
				$include = eval('return \'' . str_replace('\'', '\\\'', ob_get_clean()) .'\';');
				if($this->getForceCompile() || !file_exists($this->getCompileDirectory() .'/' . $this->getCompileName($include, '/home/segaz/domains/techno-mir.net/public_html/src/Backend/Modules/Extensions/Layout/Templates'))) $this->compile('/home/segaz/domains/techno-mir.net/public_html/src/Backend/Modules/Extensions/Layout/Templates', $include);
				$return = @include $this->getCompileDirectory() .'/' . $this->getCompileName($include, '/home/segaz/domains/techno-mir.net/public_html/src/Backend/Modules/Extensions/Layout/Templates');
				if($return === false && $this->compile('/home/segaz/domains/techno-mir.net/public_html/src/Backend/Modules/Extensions/Layout/Templates', $include))
				{
					$return = @include $this->getCompileDirectory() .'/' . $this->getCompileName($include, '/home/segaz/domains/techno-mir.net/public_html/src/Backend/Modules/Extensions/Layout/Templates');
				}
?>
<?php
				ob_start();
				?><?php echo $this->variables['BACKEND_CORE_PATH']; ?>/Layout/Templates/Footer.tpl<?php
				$include = eval('return \'' . str_replace('\'', '\\\'', ob_get_clean()) .'\';');
				if($this->getForceCompile() || !file_exists($this->getCompileDirectory() .'/' . $this->getCompileName($include, '/home/segaz/domains/techno-mir.net/public_html/src/Backend/Modules/Extensions/Layout/Templates'))) $this->compile('/home/segaz/domains/techno-mir.net/public_html/src/Backend/Modules/Extensions/Layout/Templates', $include);
				$return = @include $this->getCompileDirectory() .'/' . $this->getCompileName($include, '/home/segaz/domains/techno-mir.net/public_html/src/Backend/Modules/Extensions/Layout/Templates');
				if($return === false && $this->compile('/home/segaz/domains/techno-mir.net/public_html/src/Backend/Modules/Extensions/Layout/Templates', $include))
				{
					$return = @include $this->getCompileDirectory() .'/' . $this->getCompileName($include, '/home/segaz/domains/techno-mir.net/public_html/src/Backend/Modules/Extensions/Layout/Templates');
				}
?>
