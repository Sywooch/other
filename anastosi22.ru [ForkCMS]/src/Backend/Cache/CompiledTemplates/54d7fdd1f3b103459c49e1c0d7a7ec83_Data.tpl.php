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
	<h2><?php echo SpoonFilter::ucfirst($this->variables['lblFormBuilder']); ?>: <?php echo sprintf($this->variables['lblFormData'], $this->variables['name']); ?></h2>

	<div class="buttonHolderRight">
		<?php
					if(isset($this->variables['showFormBuilderIndex']) && count($this->variables['showFormBuilderIndex']) != 0 && $this->variables['showFormBuilderIndex'] != '' && $this->variables['showFormBuilderIndex'] !== false)
					{
						?><a href="<?php echo Backend\Core\Engine\TemplateModifiers::getURL($this->variables['var'], 'index'); ?>" class="button icon iconBack"><span><?php echo SpoonFilter::ucfirst($this->variables['lblOverview']); ?></span></a><?php } ?>
		<?php
					if(isset($this->variables['showFormBuilderExportData']) && count($this->variables['showFormBuilderExportData']) != 0 && $this->variables['showFormBuilderExportData'] != '' && $this->variables['showFormBuilderExportData'] !== false)
					{
						?><a href="<?php echo Backend\Core\Engine\TemplateModifiers::getURL($this->variables['var'], 'export_data'); ?>&id=<?php echo $this->variables['id']; ?>&amp;start_date=<?php echo $this->variables['start_date']; ?>&amp;end_date=<?php echo $this->variables['end_date']; ?>" class="button icon iconExport"><span><?php echo SpoonFilter::ucfirst($this->variables['lblExport']); ?></span></a><?php } ?>
	</div>
</div>

<div class="dataGridHolder">
	<?php
					if(isset($this->forms['filter']))
					{
						?><form accept-charset="UTF-8" action="<?php echo $this->forms['filter']->getAction(); ?>" method="<?php echo $this->forms['filter']->getMethod(); ?>"<?php echo $this->forms['filter']->getParametersHTML(); ?>>
						<?php echo $this->forms['filter']->getField('form')->parse();
						if($this->forms['filter']->getUseToken())
						{
							?><input type="hidden" name="form_token" id="<?php echo $this->forms['filter']->getField('form_token')->getAttribute('id'); ?>" value="<?php echo htmlspecialchars($this->forms['filter']->getField('form_token')->getValue()); ?>" />
						<?php } ?>
		<div class="dataFilter">

			<input type="hidden" name="id" value="<?php echo $this->variables['id']; ?>" />

			<table>
				<tbody>
					<tr>
						<td>
							<div class="options">
								<p>
									<label for="startDate"><?php echo SpoonFilter::ucfirst($this->variables['lblStartDate']); ?></label>
									<?php echo $this->variables['txtStartDate']; ?> <?php echo $this->variables['txtStartDateError']; ?>
								</p>
							</div>
						</td>
						<td>
							<div class="options">
								<p>
									<label for="endDate"><?php echo SpoonFilter::ucfirst($this->variables['lblEndDate']); ?></label>
									<?php echo $this->variables['txtEndDate']; ?> <?php echo $this->variables['txtEndDateError']; ?>
								</p>
							</div>
						</td>
					</tr>
				</tbody>
				<tfoot>
					<tr>
						<td colspan="2">
							<div class="options">
								<div class="buttonHolder">
									<input id="search" class="inputButton button mainButton" type="submit" name="search" value="<?php echo SpoonFilter::ucfirst($this->variables['lblUpdateFilter']); ?>" />
								</div>
							</div>
						</td>
					</tr>
				</tfoot>
			</table>
		</div>
	</form>
				<?php } ?>

	<?php
					if(isset($this->variables['dataGrid']) && count($this->variables['dataGrid']) != 0 && $this->variables['dataGrid'] != '' && $this->variables['dataGrid'] !== false)
					{
						?>
		<form action="<?php echo Backend\Core\Engine\TemplateModifiers::getURL($this->variables['var'], 'mass_data_action'); ?>" method="get" class="forkForms">
			<div class="dataGridHolder">
				<input type="hidden" name="form_id" value="<?php echo $this->variables['id']; ?>" />
				<?php echo $this->variables['dataGrid']; ?>
			</div>
		</form>
	<?php } ?>
	<?php if(!isset($this->variables['dataGrid']) || count($this->variables['dataGrid']) == 0 || $this->variables['dataGrid'] == '' || $this->variables['dataGrid'] === false): ?><p><?php echo $this->variables['msgNoData']; ?></p><?php endif; ?>
</div>

<div id="confirmDelete" title="<?php echo SpoonFilter::ucfirst($this->variables['lblDelete']); ?>?" style="display: none;">
	<p><?php echo $this->variables['msgConfirmMassDelete']; ?></p>
</div>

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
