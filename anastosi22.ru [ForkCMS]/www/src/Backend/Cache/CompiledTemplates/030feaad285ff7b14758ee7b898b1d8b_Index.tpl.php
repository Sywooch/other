<?php error_reporting(0); ini_set('display_errors', 'Off'); ?>
<?php
				ob_start();
				?><?php echo $this->variables['BACKEND_CORE_PATH']; ?>/Layout/Templates/Head.tpl<?php
				$include = eval('return \'' . str_replace('\'', '\\\'', ob_get_clean()) .'\';');
				if($this->getForceCompile() || !file_exists($this->getCompileDirectory() .'/' . $this->getCompileName($include, '/home/anastosi/domains/anastosi.ru/public_html/src/Backend/Modules/FormBuilder/Layout/Templates'))) $this->compile('/home/anastosi/domains/anastosi.ru/public_html/src/Backend/Modules/FormBuilder/Layout/Templates', $include);
				$return = @include $this->getCompileDirectory() .'/' . $this->getCompileName($include, '/home/anastosi/domains/anastosi.ru/public_html/src/Backend/Modules/FormBuilder/Layout/Templates');
				if($return === false && $this->compile('/home/anastosi/domains/anastosi.ru/public_html/src/Backend/Modules/FormBuilder/Layout/Templates', $include))
				{
					$return = @include $this->getCompileDirectory() .'/' . $this->getCompileName($include, '/home/anastosi/domains/anastosi.ru/public_html/src/Backend/Modules/FormBuilder/Layout/Templates');
				}
?>
<?php
				ob_start();
				?><?php echo $this->variables['BACKEND_CORE_PATH']; ?>/Layout/Templates/StructureStartModule.tpl<?php
				$include = eval('return \'' . str_replace('\'', '\\\'', ob_get_clean()) .'\';');
				if($this->getForceCompile() || !file_exists($this->getCompileDirectory() .'/' . $this->getCompileName($include, '/home/anastosi/domains/anastosi.ru/public_html/src/Backend/Modules/FormBuilder/Layout/Templates'))) $this->compile('/home/anastosi/domains/anastosi.ru/public_html/src/Backend/Modules/FormBuilder/Layout/Templates', $include);
				$return = @include $this->getCompileDirectory() .'/' . $this->getCompileName($include, '/home/anastosi/domains/anastosi.ru/public_html/src/Backend/Modules/FormBuilder/Layout/Templates');
				if($return === false && $this->compile('/home/anastosi/domains/anastosi.ru/public_html/src/Backend/Modules/FormBuilder/Layout/Templates', $include))
				{
					$return = @include $this->getCompileDirectory() .'/' . $this->getCompileName($include, '/home/anastosi/domains/anastosi.ru/public_html/src/Backend/Modules/FormBuilder/Layout/Templates');
				}
?>

<div class="pageTitle">
	<h2><?php echo SpoonFilter::ucfirst($this->variables['lblFormBuilder']); ?></h2>

    <?php
					if(isset($this->variables['showFormBuilderAdd']) && count($this->variables['showFormBuilderAdd']) != 0 && $this->variables['showFormBuilderAdd'] != '' && $this->variables['showFormBuilderAdd'] !== false)
					{
						?>
	<div class="buttonHolderRight">
		<a href="<?php echo Backend\Core\Engine\TemplateModifiers::getURL($this->variables['var'], 'add'); ?>" class="button icon iconAdd" title="<?php echo SpoonFilter::ucfirst($this->variables['lblAdd']); ?>">
			<span><?php echo SpoonFilter::ucfirst($this->variables['lblAdd']); ?></span>
		</a>
	</div>
    <?php } ?>
</div>

<?php
					if(isset($this->variables['dataGrid']) && count($this->variables['dataGrid']) != 0 && $this->variables['dataGrid'] != '' && $this->variables['dataGrid'] !== false)
					{
						?>
	<div class="dataGridHolder">
		<?php echo $this->variables['dataGrid']; ?>
	</div>
<?php } ?>
<?php if(!isset($this->variables['dataGrid']) || count($this->variables['dataGrid']) == 0 || $this->variables['dataGrid'] == '' || $this->variables['dataGrid'] === false): ?><p><?php echo $this->variables['msgNoItems']; ?></p><?php endif; ?>

<?php
				ob_start();
				?><?php echo $this->variables['BACKEND_CORE_PATH']; ?>/Layout/Templates/StructureEndModule.tpl<?php
				$include = eval('return \'' . str_replace('\'', '\\\'', ob_get_clean()) .'\';');
				if($this->getForceCompile() || !file_exists($this->getCompileDirectory() .'/' . $this->getCompileName($include, '/home/anastosi/domains/anastosi.ru/public_html/src/Backend/Modules/FormBuilder/Layout/Templates'))) $this->compile('/home/anastosi/domains/anastosi.ru/public_html/src/Backend/Modules/FormBuilder/Layout/Templates', $include);
				$return = @include $this->getCompileDirectory() .'/' . $this->getCompileName($include, '/home/anastosi/domains/anastosi.ru/public_html/src/Backend/Modules/FormBuilder/Layout/Templates');
				if($return === false && $this->compile('/home/anastosi/domains/anastosi.ru/public_html/src/Backend/Modules/FormBuilder/Layout/Templates', $include))
				{
					$return = @include $this->getCompileDirectory() .'/' . $this->getCompileName($include, '/home/anastosi/domains/anastosi.ru/public_html/src/Backend/Modules/FormBuilder/Layout/Templates');
				}
?>
<?php
				ob_start();
				?><?php echo $this->variables['BACKEND_CORE_PATH']; ?>/Layout/Templates/Footer.tpl<?php
				$include = eval('return \'' . str_replace('\'', '\\\'', ob_get_clean()) .'\';');
				if($this->getForceCompile() || !file_exists($this->getCompileDirectory() .'/' . $this->getCompileName($include, '/home/anastosi/domains/anastosi.ru/public_html/src/Backend/Modules/FormBuilder/Layout/Templates'))) $this->compile('/home/anastosi/domains/anastosi.ru/public_html/src/Backend/Modules/FormBuilder/Layout/Templates', $include);
				$return = @include $this->getCompileDirectory() .'/' . $this->getCompileName($include, '/home/anastosi/domains/anastosi.ru/public_html/src/Backend/Modules/FormBuilder/Layout/Templates');
				if($return === false && $this->compile('/home/anastosi/domains/anastosi.ru/public_html/src/Backend/Modules/FormBuilder/Layout/Templates', $include))
				{
					$return = @include $this->getCompileDirectory() .'/' . $this->getCompileName($include, '/home/anastosi/domains/anastosi.ru/public_html/src/Backend/Modules/FormBuilder/Layout/Templates');
				}
?>
