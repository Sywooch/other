<?php error_reporting(0); ini_set('display_errors', 'Off'); ?>
<?php
				ob_start();
				?><?php echo $this->variables['BACKEND_CORE_PATH']; ?>/Layout/Templates/Head.tpl<?php
				$include = eval('return \'' . str_replace('\'', '\\\'', ob_get_clean()) .'\';');
				if($this->getForceCompile() || !file_exists($this->getCompileDirectory() .'/' . $this->getCompileName($include, '/home/anastosi/domains/anastosi.ru/public_html/src/Backend/Modules/Groups/Layout/Templates'))) $this->compile('/home/anastosi/domains/anastosi.ru/public_html/src/Backend/Modules/Groups/Layout/Templates', $include);
				$return = @include $this->getCompileDirectory() .'/' . $this->getCompileName($include, '/home/anastosi/domains/anastosi.ru/public_html/src/Backend/Modules/Groups/Layout/Templates');
				if($return === false && $this->compile('/home/anastosi/domains/anastosi.ru/public_html/src/Backend/Modules/Groups/Layout/Templates', $include))
				{
					$return = @include $this->getCompileDirectory() .'/' . $this->getCompileName($include, '/home/anastosi/domains/anastosi.ru/public_html/src/Backend/Modules/Groups/Layout/Templates');
				}
?>
<?php
				ob_start();
				?><?php echo $this->variables['BACKEND_CORE_PATH']; ?>/Layout/Templates/StructureStartModule.tpl<?php
				$include = eval('return \'' . str_replace('\'', '\\\'', ob_get_clean()) .'\';');
				if($this->getForceCompile() || !file_exists($this->getCompileDirectory() .'/' . $this->getCompileName($include, '/home/anastosi/domains/anastosi.ru/public_html/src/Backend/Modules/Groups/Layout/Templates'))) $this->compile('/home/anastosi/domains/anastosi.ru/public_html/src/Backend/Modules/Groups/Layout/Templates', $include);
				$return = @include $this->getCompileDirectory() .'/' . $this->getCompileName($include, '/home/anastosi/domains/anastosi.ru/public_html/src/Backend/Modules/Groups/Layout/Templates');
				if($return === false && $this->compile('/home/anastosi/domains/anastosi.ru/public_html/src/Backend/Modules/Groups/Layout/Templates', $include))
				{
					$return = @include $this->getCompileDirectory() .'/' . $this->getCompileName($include, '/home/anastosi/domains/anastosi.ru/public_html/src/Backend/Modules/Groups/Layout/Templates');
				}
?>

<div class="pageTitle">
	<h2><?php echo SpoonFilter::ucfirst($this->variables['lblGroups']); ?></h2>

	<?php
					if(isset($this->variables['showGroupsAdd']) && count($this->variables['showGroupsAdd']) != 0 && $this->variables['showGroupsAdd'] != '' && $this->variables['showGroupsAdd'] !== false)
					{
						?>
	<div class="buttonHolderRight">
		<a class="button icon iconAdd" href="<?php echo Backend\Core\Engine\TemplateModifiers::getURL($this->variables['var'], 'add'); ?>"><span><?php echo SpoonFilter::ucfirst($this->variables['lblAddGroup']); ?></span></a>
	</div>
	<?php } ?>
</div>
<div class="dataGridHolder">
	<?php
					if(isset($this->variables['dataGrid']) && count($this->variables['dataGrid']) != 0 && $this->variables['dataGrid'] != '' && $this->variables['dataGrid'] !== false)
					{
						?><?php echo $this->variables['dataGrid']; ?><?php } ?>
</div>

<?php
				ob_start();
				?><?php echo $this->variables['BACKEND_CORE_PATH']; ?>/Layout/Templates/StructureEndModule.tpl<?php
				$include = eval('return \'' . str_replace('\'', '\\\'', ob_get_clean()) .'\';');
				if($this->getForceCompile() || !file_exists($this->getCompileDirectory() .'/' . $this->getCompileName($include, '/home/anastosi/domains/anastosi.ru/public_html/src/Backend/Modules/Groups/Layout/Templates'))) $this->compile('/home/anastosi/domains/anastosi.ru/public_html/src/Backend/Modules/Groups/Layout/Templates', $include);
				$return = @include $this->getCompileDirectory() .'/' . $this->getCompileName($include, '/home/anastosi/domains/anastosi.ru/public_html/src/Backend/Modules/Groups/Layout/Templates');
				if($return === false && $this->compile('/home/anastosi/domains/anastosi.ru/public_html/src/Backend/Modules/Groups/Layout/Templates', $include))
				{
					$return = @include $this->getCompileDirectory() .'/' . $this->getCompileName($include, '/home/anastosi/domains/anastosi.ru/public_html/src/Backend/Modules/Groups/Layout/Templates');
				}
?>
<?php
				ob_start();
				?><?php echo $this->variables['BACKEND_CORE_PATH']; ?>/Layout/Templates/Footer.tpl<?php
				$include = eval('return \'' . str_replace('\'', '\\\'', ob_get_clean()) .'\';');
				if($this->getForceCompile() || !file_exists($this->getCompileDirectory() .'/' . $this->getCompileName($include, '/home/anastosi/domains/anastosi.ru/public_html/src/Backend/Modules/Groups/Layout/Templates'))) $this->compile('/home/anastosi/domains/anastosi.ru/public_html/src/Backend/Modules/Groups/Layout/Templates', $include);
				$return = @include $this->getCompileDirectory() .'/' . $this->getCompileName($include, '/home/anastosi/domains/anastosi.ru/public_html/src/Backend/Modules/Groups/Layout/Templates');
				if($return === false && $this->compile('/home/anastosi/domains/anastosi.ru/public_html/src/Backend/Modules/Groups/Layout/Templates', $include))
				{
					$return = @include $this->getCompileDirectory() .'/' . $this->getCompileName($include, '/home/anastosi/domains/anastosi.ru/public_html/src/Backend/Modules/Groups/Layout/Templates');
				}
?>
