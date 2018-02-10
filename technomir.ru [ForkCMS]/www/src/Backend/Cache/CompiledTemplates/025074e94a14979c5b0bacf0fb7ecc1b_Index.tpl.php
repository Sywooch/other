<?php error_reporting(E_ALL | E_STRICT); ini_set('display_errors', 'On'); ?>
<?php
				ob_start();
				?><?php if(array_key_exists('BACKEND_CORE_PATH', (array) $this->variables)) { echo $this->variables['BACKEND_CORE_PATH']; } else { ?>{$BACKEND_CORE_PATH}<?php } ?>/Layout/Templates/Head.tpl<?php
				$include = eval('return \'' . str_replace('\'', '\\\'', ob_get_clean()) .'\';');
				if($this->getForceCompile() || !file_exists($this->getCompileDirectory() .'/' . $this->getCompileName($include, 'J:\home\technomir.com\www\src\Backend\Modules\Users\Layout\Templates'))) $this->compile('J:\home\technomir.com\www\src\Backend\Modules\Users\Layout\Templates', $include);
				$return = @include $this->getCompileDirectory() .'/' . $this->getCompileName($include, 'J:\home\technomir.com\www\src\Backend\Modules\Users\Layout\Templates');
				if($return === false && $this->compile('J:\home\technomir.com\www\src\Backend\Modules\Users\Layout\Templates', $include))
				{
					$return = @include $this->getCompileDirectory() .'/' . $this->getCompileName($include, 'J:\home\technomir.com\www\src\Backend\Modules\Users\Layout\Templates');
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
				if($this->getForceCompile() || !file_exists($this->getCompileDirectory() .'/' . $this->getCompileName($include, 'J:\home\technomir.com\www\src\Backend\Modules\Users\Layout\Templates'))) $this->compile('J:\home\technomir.com\www\src\Backend\Modules\Users\Layout\Templates', $include);
				$return = @include $this->getCompileDirectory() .'/' . $this->getCompileName($include, 'J:\home\technomir.com\www\src\Backend\Modules\Users\Layout\Templates');
				if($return === false && $this->compile('J:\home\technomir.com\www\src\Backend\Modules\Users\Layout\Templates', $include))
				{
					$return = @include $this->getCompileDirectory() .'/' . $this->getCompileName($include, 'J:\home\technomir.com\www\src\Backend\Modules\Users\Layout\Templates');
				}
if($return === false)
				{
					?>{include:<?php if(array_key_exists('BACKEND_CORE_PATH', (array) $this->variables)) { echo $this->variables['BACKEND_CORE_PATH']; } else { ?>{$BACKEND_CORE_PATH}<?php } ?>/Layout/Templates/StructureStartModule.tpl}<?php
				}
?>

<div class="pageTitle">
	<h2><?php if(array_key_exists('lblUsers', (array) $this->variables)) { echo SpoonFilter::ucfirst($this->variables['lblUsers']); } else { ?>{$lblUsers|ucfirst}<?php } ?></h2>

	<?php
					if(isset($this->variables['showUsersAdd']) && count($this->variables['showUsersAdd']) != 0 && $this->variables['showUsersAdd'] != '' && $this->variables['showUsersAdd'] !== false)
					{
						?>
	<div class="buttonHolderRight">
		<a class="button icon iconAdd" href="<?php if(array_key_exists('var', (array) $this->variables)) { echo Backend\Core\Engine\TemplateModifiers::getURL($this->variables['var'], 'add'); } else { ?>{$var|geturl:'add'}<?php } ?>"><span><?php if(array_key_exists('lblAdd', (array) $this->variables)) { echo SpoonFilter::ucfirst($this->variables['lblAdd']); } else { ?>{$lblAdd|ucfirst}<?php } ?></span></a>
	</div>
	<?php } ?>
</div>
<div class="dataGridHolder">
	<?php
					if(isset($this->variables['dataGrid']) && count($this->variables['dataGrid']) != 0 && $this->variables['dataGrid'] != '' && $this->variables['dataGrid'] !== false)
					{
						?><?php if(array_key_exists('dataGrid', (array) $this->variables)) { echo $this->variables['dataGrid']; } else { ?>{$dataGrid}<?php } ?><?php } ?>
</div>

<?php
				ob_start();
				?><?php if(array_key_exists('BACKEND_CORE_PATH', (array) $this->variables)) { echo $this->variables['BACKEND_CORE_PATH']; } else { ?>{$BACKEND_CORE_PATH}<?php } ?>/Layout/Templates/StructureEndModule.tpl<?php
				$include = eval('return \'' . str_replace('\'', '\\\'', ob_get_clean()) .'\';');
				if($this->getForceCompile() || !file_exists($this->getCompileDirectory() .'/' . $this->getCompileName($include, 'J:\home\technomir.com\www\src\Backend\Modules\Users\Layout\Templates'))) $this->compile('J:\home\technomir.com\www\src\Backend\Modules\Users\Layout\Templates', $include);
				$return = @include $this->getCompileDirectory() .'/' . $this->getCompileName($include, 'J:\home\technomir.com\www\src\Backend\Modules\Users\Layout\Templates');
				if($return === false && $this->compile('J:\home\technomir.com\www\src\Backend\Modules\Users\Layout\Templates', $include))
				{
					$return = @include $this->getCompileDirectory() .'/' . $this->getCompileName($include, 'J:\home\technomir.com\www\src\Backend\Modules\Users\Layout\Templates');
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
				if($this->getForceCompile() || !file_exists($this->getCompileDirectory() .'/' . $this->getCompileName($include, 'J:\home\technomir.com\www\src\Backend\Modules\Users\Layout\Templates'))) $this->compile('J:\home\technomir.com\www\src\Backend\Modules\Users\Layout\Templates', $include);
				$return = @include $this->getCompileDirectory() .'/' . $this->getCompileName($include, 'J:\home\technomir.com\www\src\Backend\Modules\Users\Layout\Templates');
				if($return === false && $this->compile('J:\home\technomir.com\www\src\Backend\Modules\Users\Layout\Templates', $include))
				{
					$return = @include $this->getCompileDirectory() .'/' . $this->getCompileName($include, 'J:\home\technomir.com\www\src\Backend\Modules\Users\Layout\Templates');
				}
if($return === false)
				{
					?>{include:<?php if(array_key_exists('BACKEND_CORE_PATH', (array) $this->variables)) { echo $this->variables['BACKEND_CORE_PATH']; } else { ?>{$BACKEND_CORE_PATH}<?php } ?>/Layout/Templates/Footer.tpl}<?php
				}
?>
