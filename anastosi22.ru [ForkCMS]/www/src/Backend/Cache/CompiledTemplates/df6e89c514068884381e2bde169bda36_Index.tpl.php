<?php error_reporting(0); ini_set('display_errors', 'Off'); ?>
<?php
				ob_start();
				?><?php echo $this->variables['BACKEND_CORE_PATH']; ?>/Layout/Templates/Head.tpl<?php
				$include = eval('return \'' . str_replace('\'', '\\\'', ob_get_clean()) .'\';');
				if($this->getForceCompile() || !file_exists($this->getCompileDirectory() .'/' . $this->getCompileName($include, '/home/anastosi/domains/anastosi.ru/public_html/src/Backend/Modules/Pages/Layout/Templates'))) $this->compile('/home/anastosi/domains/anastosi.ru/public_html/src/Backend/Modules/Pages/Layout/Templates', $include);
				$return = @include $this->getCompileDirectory() .'/' . $this->getCompileName($include, '/home/anastosi/domains/anastosi.ru/public_html/src/Backend/Modules/Pages/Layout/Templates');
				if($return === false && $this->compile('/home/anastosi/domains/anastosi.ru/public_html/src/Backend/Modules/Pages/Layout/Templates', $include))
				{
					$return = @include $this->getCompileDirectory() .'/' . $this->getCompileName($include, '/home/anastosi/domains/anastosi.ru/public_html/src/Backend/Modules/Pages/Layout/Templates');
				}
?>
<?php
				ob_start();
				?><?php echo $this->variables['BACKEND_MODULES_PATH']; ?>/Pages/Layout/Templates/StructureStart.tpl<?php
				$include = eval('return \'' . str_replace('\'', '\\\'', ob_get_clean()) .'\';');
				if($this->getForceCompile() || !file_exists($this->getCompileDirectory() .'/' . $this->getCompileName($include, '/home/anastosi/domains/anastosi.ru/public_html/src/Backend/Modules/Pages/Layout/Templates'))) $this->compile('/home/anastosi/domains/anastosi.ru/public_html/src/Backend/Modules/Pages/Layout/Templates', $include);
				$return = @include $this->getCompileDirectory() .'/' . $this->getCompileName($include, '/home/anastosi/domains/anastosi.ru/public_html/src/Backend/Modules/Pages/Layout/Templates');
				if($return === false && $this->compile('/home/anastosi/domains/anastosi.ru/public_html/src/Backend/Modules/Pages/Layout/Templates', $include))
				{
					$return = @include $this->getCompileDirectory() .'/' . $this->getCompileName($include, '/home/anastosi/domains/anastosi.ru/public_html/src/Backend/Modules/Pages/Layout/Templates');
				}
?>

<div class="pageTitle">
	<h2>
		<?php
					if(isset($this->variables['dgDrafts']) && count($this->variables['dgDrafts']) != 0 && $this->variables['dgDrafts'] != '' && $this->variables['dgDrafts'] !== false)
					{
						?><?php echo SpoonFilter::ucfirst($this->variables['lblDrafts']); ?><?php } ?>
		<?php if(!isset($this->variables['dgDrafts']) || count($this->variables['dgDrafts']) == 0 || $this->variables['dgDrafts'] == '' || $this->variables['dgDrafts'] === false): ?><?php echo SpoonFilter::ucfirst($this->variables['lblRecentlyEdited']); ?><?php endif; ?>
	</h2>

	<?php
					if(isset($this->variables['showPagesAdd']) && count($this->variables['showPagesAdd']) != 0 && $this->variables['showPagesAdd'] != '' && $this->variables['showPagesAdd'] !== false)
					{
						?>
	<div class="buttonHolderRight">
		<a href="<?php echo Backend\Core\Engine\TemplateModifiers::getURL($this->variables['var'], 'add'); ?>" class="button icon iconAdd">
			<span><?php echo SpoonFilter::ucfirst($this->variables['lblAdd']); ?></span>
		</a>
	</div>
	<?php } ?>
</div>

<?php
					if(isset($this->variables['dgDrafts']) && count($this->variables['dgDrafts']) != 0 && $this->variables['dgDrafts'] != '' && $this->variables['dgDrafts'] !== false)
					{
						?>
	<div class="dataGridHolder <?php if(!isset($this->variables['dgDrafts']) || count($this->variables['dgDrafts']) == 0 || $this->variables['dgDrafts'] == '' || $this->variables['dgDrafts'] === false): ?>dataGridHolderNoDataGrid<?php endif; ?>">
		<?php echo $this->variables['dgDrafts']; ?>
	</div>

	<div class="pageTitle">
		<h2>
			<?php echo SpoonFilter::ucfirst($this->variables['lblRecentlyEdited']); ?>
		</h2>

		<?php
					if(isset($this->variables['showPagesAdd']) && count($this->variables['showPagesAdd']) != 0 && $this->variables['showPagesAdd'] != '' && $this->variables['showPagesAdd'] !== false)
					{
						?>
		<div class="buttonHolderRight">
			<a href="<?php echo Backend\Core\Engine\TemplateModifiers::getURL($this->variables['var'], 'add'); ?>" class="button icon iconAdd">
				<span><?php echo SpoonFilter::ucfirst($this->variables['lblAdd']); ?></span>
			</a>
		</div>
		<?php } ?>
	</div>

<?php } ?>


<div class="dataGridHolder <?php if(!isset($this->variables['dgRecentlyEdited']) || count($this->variables['dgRecentlyEdited']) == 0 || $this->variables['dgRecentlyEdited'] == '' || $this->variables['dgRecentlyEdited'] === false): ?>dataGridHolderNoDataGrid<?php endif; ?>">
	<?php
					if(isset($this->variables['dgRecentlyEdited']) && count($this->variables['dgRecentlyEdited']) != 0 && $this->variables['dgRecentlyEdited'] != '' && $this->variables['dgRecentlyEdited'] !== false)
					{
						?><?php echo $this->variables['dgRecentlyEdited']; ?><?php } ?>
	<?php if(!isset($this->variables['dgRecentlyEdited']) || count($this->variables['dgRecentlyEdited']) == 0 || $this->variables['dgRecentlyEdited'] == '' || $this->variables['dgRecentlyEdited'] === false): ?><p><?php echo $this->variables['msgNoItems']; ?></p><?php endif; ?>
</div>

<?php
				ob_start();
				?><?php echo $this->variables['BACKEND_MODULES_PATH']; ?>/Pages/Layout/Templates/StructureEnd.tpl<?php
				$include = eval('return \'' . str_replace('\'', '\\\'', ob_get_clean()) .'\';');
				if($this->getForceCompile() || !file_exists($this->getCompileDirectory() .'/' . $this->getCompileName($include, '/home/anastosi/domains/anastosi.ru/public_html/src/Backend/Modules/Pages/Layout/Templates'))) $this->compile('/home/anastosi/domains/anastosi.ru/public_html/src/Backend/Modules/Pages/Layout/Templates', $include);
				$return = @include $this->getCompileDirectory() .'/' . $this->getCompileName($include, '/home/anastosi/domains/anastosi.ru/public_html/src/Backend/Modules/Pages/Layout/Templates');
				if($return === false && $this->compile('/home/anastosi/domains/anastosi.ru/public_html/src/Backend/Modules/Pages/Layout/Templates', $include))
				{
					$return = @include $this->getCompileDirectory() .'/' . $this->getCompileName($include, '/home/anastosi/domains/anastosi.ru/public_html/src/Backend/Modules/Pages/Layout/Templates');
				}
?>
<?php
				ob_start();
				?><?php echo $this->variables['BACKEND_CORE_PATH']; ?>/Layout/Templates/Footer.tpl<?php
				$include = eval('return \'' . str_replace('\'', '\\\'', ob_get_clean()) .'\';');
				if($this->getForceCompile() || !file_exists($this->getCompileDirectory() .'/' . $this->getCompileName($include, '/home/anastosi/domains/anastosi.ru/public_html/src/Backend/Modules/Pages/Layout/Templates'))) $this->compile('/home/anastosi/domains/anastosi.ru/public_html/src/Backend/Modules/Pages/Layout/Templates', $include);
				$return = @include $this->getCompileDirectory() .'/' . $this->getCompileName($include, '/home/anastosi/domains/anastosi.ru/public_html/src/Backend/Modules/Pages/Layout/Templates');
				if($return === false && $this->compile('/home/anastosi/domains/anastosi.ru/public_html/src/Backend/Modules/Pages/Layout/Templates', $include))
				{
					$return = @include $this->getCompileDirectory() .'/' . $this->getCompileName($include, '/home/anastosi/domains/anastosi.ru/public_html/src/Backend/Modules/Pages/Layout/Templates');
				}
?>
