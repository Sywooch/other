<?php error_reporting(0); ini_set('display_errors', 'Off'); ?>
<?php
				ob_start();
				?><?php echo $this->variables['BACKEND_CORE_PATH']; ?>/Layout/Templates/Head.tpl<?php
				$include = eval('return \'' . str_replace('\'', '\\\'', ob_get_clean()) .'\';');
				if($this->getForceCompile() || !file_exists($this->getCompileDirectory() .'/' . $this->getCompileName($include, '/home/segaz/domains/techno-mir.net/public_html/src/Backend/Modules/Locale/Layout/Templates'))) $this->compile('/home/segaz/domains/techno-mir.net/public_html/src/Backend/Modules/Locale/Layout/Templates', $include);
				$return = @include $this->getCompileDirectory() .'/' . $this->getCompileName($include, '/home/segaz/domains/techno-mir.net/public_html/src/Backend/Modules/Locale/Layout/Templates');
				if($return === false && $this->compile('/home/segaz/domains/techno-mir.net/public_html/src/Backend/Modules/Locale/Layout/Templates', $include))
				{
					$return = @include $this->getCompileDirectory() .'/' . $this->getCompileName($include, '/home/segaz/domains/techno-mir.net/public_html/src/Backend/Modules/Locale/Layout/Templates');
				}
?>
<?php
				ob_start();
				?><?php echo $this->variables['BACKEND_CORE_PATH']; ?>/Layout/Templates/StructureStartModule.tpl<?php
				$include = eval('return \'' . str_replace('\'', '\\\'', ob_get_clean()) .'\';');
				if($this->getForceCompile() || !file_exists($this->getCompileDirectory() .'/' . $this->getCompileName($include, '/home/segaz/domains/techno-mir.net/public_html/src/Backend/Modules/Locale/Layout/Templates'))) $this->compile('/home/segaz/domains/techno-mir.net/public_html/src/Backend/Modules/Locale/Layout/Templates', $include);
				$return = @include $this->getCompileDirectory() .'/' . $this->getCompileName($include, '/home/segaz/domains/techno-mir.net/public_html/src/Backend/Modules/Locale/Layout/Templates');
				if($return === false && $this->compile('/home/segaz/domains/techno-mir.net/public_html/src/Backend/Modules/Locale/Layout/Templates', $include))
				{
					$return = @include $this->getCompileDirectory() .'/' . $this->getCompileName($include, '/home/segaz/domains/techno-mir.net/public_html/src/Backend/Modules/Locale/Layout/Templates');
				}
?>

<div class="pageTitle">
	<h2><?php echo SpoonFilter::ucfirst($this->variables['lblTranslations']); ?></h2>
		<div class="buttonHolderRight">
			<?php
					if(isset($this->variables['showLocaleAdd']) && count($this->variables['showLocaleAdd']) != 0 && $this->variables['showLocaleAdd'] != '' && $this->variables['showLocaleAdd'] !== false)
					{
						?><a href="<?php echo Backend\Core\Engine\TemplateModifiers::getURL($this->variables['var'], 'add'); ?><?php echo $this->variables['filter']; ?>" class="button icon iconAdd"><span><?php echo SpoonFilter::ucfirst($this->variables['lblAdd']); ?></span></a><?php } ?>
			<?php
					if(isset($this->variables['showLocaleExport']) && count($this->variables['showLocaleExport']) != 0 && $this->variables['showLocaleExport'] != '' && $this->variables['showLocaleExport'] !== false)
					{
						?><a href="<?php echo Backend\Core\Engine\TemplateModifiers::getURL($this->variables['var'], 'export'); ?><?php echo $this->variables['filter']; ?>" class="button icon iconExport"><span><?php echo SpoonFilter::ucfirst($this->variables['lblExport']); ?></span></a><?php } ?>
			<?php
					if(isset($this->variables['showLocaleImport']) && count($this->variables['showLocaleImport']) != 0 && $this->variables['showLocaleImport'] != '' && $this->variables['showLocaleImport'] !== false)
					{
						?><a href="<?php echo Backend\Core\Engine\TemplateModifiers::getURL($this->variables['var'], 'import'); ?><?php echo $this->variables['filter']; ?>" class="button icon iconImport"><span><?php echo SpoonFilter::ucfirst($this->variables['lblImport']); ?></span></a><?php } ?>
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
			<table>
				<tbody>
					<tr>
						<td>
							<div class="options">
								<p>
									<label for="application"><?php echo SpoonFilter::ucfirst($this->variables['lblApplication']); ?></label>
									<?php echo $this->variables['ddmApplication']; ?> <?php echo $this->variables['ddmApplicationError']; ?>
								</p>
								<p>
									<label for="module"><?php echo SpoonFilter::ucfirst($this->variables['lblModule']); ?></label>
									<?php echo $this->variables['ddmModule']; ?> <?php echo $this->variables['ddmModuleError']; ?>
								</p>
							</div>
						</td>
						<td>
							<div class="options">
								<label><?php echo SpoonFilter::ucfirst($this->variables['lblTypes']); ?></label>
								<?php
					if(isset($this->variables['type']) && count($this->variables['type']) != 0 && $this->variables['type'] != '' && $this->variables['type'] !== false)
					{
						?>
									<ul>
										<?php
				if(isset(${'type'})) $this->iterations['263faf24a74c4f7fb676ce6d60995747_Index.tpl.php_1']['old'] = ${'type'};
				$this->iterations['263faf24a74c4f7fb676ce6d60995747_Index.tpl.php_1']['iteration'] = $this->variables['type'];
				$this->iterations['263faf24a74c4f7fb676ce6d60995747_Index.tpl.php_1']['i'] = 1;
				$this->iterations['263faf24a74c4f7fb676ce6d60995747_Index.tpl.php_1']['count'] = count($this->iterations['263faf24a74c4f7fb676ce6d60995747_Index.tpl.php_1']['iteration']);
				foreach((array) $this->iterations['263faf24a74c4f7fb676ce6d60995747_Index.tpl.php_1']['iteration'] as ${'type'})
				{
					if(!isset(${'type'}['first']) && $this->iterations['263faf24a74c4f7fb676ce6d60995747_Index.tpl.php_1']['i'] == 1) ${'type'}['first'] = true;
					if(!isset(${'type'}['last']) && $this->iterations['263faf24a74c4f7fb676ce6d60995747_Index.tpl.php_1']['i'] == $this->iterations['263faf24a74c4f7fb676ce6d60995747_Index.tpl.php_1']['count']) ${'type'}['last'] = true;
					if(isset(${'type'}['formElements']) && is_array(${'type'}['formElements']))
					{
						foreach(${'type'}['formElements'] as $name => $object)
						{
							${'type'}[$name] = $object->parse();
							${'type'}[$name .'Error'] = (is_callable(array($object, 'getErrors')) && $object->getErrors() != '') ? '<span class="formError">' . $object->getErrors() .'</span>' : '';
						}
					} ?><li><?php echo ${'type'}['chkType']; ?> <label for="<?php echo ${'type'}['id']; ?>"><?php echo SpoonFilter::ucfirst(${'type'}['label']); ?></label></li><?php
					$this->iterations['263faf24a74c4f7fb676ce6d60995747_Index.tpl.php_1']['i']++;
				}
				if(isset($this->iterations['263faf24a74c4f7fb676ce6d60995747_Index.tpl.php_1']['old'])) ${'type'} = $this->iterations['263faf24a74c4f7fb676ce6d60995747_Index.tpl.php_1']['old'];
				else unset($this->iterations['263faf24a74c4f7fb676ce6d60995747_Index.tpl.php_1']);
				?>
									</ul>
								<?php } ?>
							</div>
						</td>
						<td>
							<div class="options">
								<label><?php echo SpoonFilter::ucfirst($this->variables['lblLanguages']); ?></label>
								<?php
					if(isset($this->variables['language']) && count($this->variables['language']) != 0 && $this->variables['language'] != '' && $this->variables['language'] !== false)
					{
						?>
									<ul>
										<?php
				if(isset(${'language'})) $this->iterations['263faf24a74c4f7fb676ce6d60995747_Index.tpl.php_2']['old'] = ${'language'};
				$this->iterations['263faf24a74c4f7fb676ce6d60995747_Index.tpl.php_2']['iteration'] = $this->variables['language'];
				$this->iterations['263faf24a74c4f7fb676ce6d60995747_Index.tpl.php_2']['i'] = 1;
				$this->iterations['263faf24a74c4f7fb676ce6d60995747_Index.tpl.php_2']['count'] = count($this->iterations['263faf24a74c4f7fb676ce6d60995747_Index.tpl.php_2']['iteration']);
				foreach((array) $this->iterations['263faf24a74c4f7fb676ce6d60995747_Index.tpl.php_2']['iteration'] as ${'language'})
				{
					if(!isset(${'language'}['first']) && $this->iterations['263faf24a74c4f7fb676ce6d60995747_Index.tpl.php_2']['i'] == 1) ${'language'}['first'] = true;
					if(!isset(${'language'}['last']) && $this->iterations['263faf24a74c4f7fb676ce6d60995747_Index.tpl.php_2']['i'] == $this->iterations['263faf24a74c4f7fb676ce6d60995747_Index.tpl.php_2']['count']) ${'language'}['last'] = true;
					if(isset(${'language'}['formElements']) && is_array(${'language'}['formElements']))
					{
						foreach(${'language'}['formElements'] as $name => $object)
						{
							${'language'}[$name] = $object->parse();
							${'language'}[$name .'Error'] = (is_callable(array($object, 'getErrors')) && $object->getErrors() != '') ? '<span class="formError">' . $object->getErrors() .'</span>' : '';
						}
					} ?><li><?php echo ${'language'}['chkLanguage']; ?> <label for="<?php echo ${'language'}['id']; ?>"><?php echo SpoonFilter::ucfirst(${'language'}['label']); ?></label></li><?php
					$this->iterations['263faf24a74c4f7fb676ce6d60995747_Index.tpl.php_2']['i']++;
				}
				if(isset($this->iterations['263faf24a74c4f7fb676ce6d60995747_Index.tpl.php_2']['old'])) ${'language'} = $this->iterations['263faf24a74c4f7fb676ce6d60995747_Index.tpl.php_2']['old'];
				else unset($this->iterations['263faf24a74c4f7fb676ce6d60995747_Index.tpl.php_2']);
				?>
									</ul>
								<?php } ?>
							</div>
						</td>
						<td>
							<div class="options">
								<div class="oneLiner">
									<p>
										<label for="name"><?php echo SpoonFilter::ucfirst($this->variables['lblReferenceCode']); ?></label>
									</p>
									<p>
										<abbr class="help">(?)</abbr>
										<span class="tooltip" style="display: none;">
											<?php echo $this->variables['msgHelpName']; ?>
										</span>
									</p>
								</div>
								<?php echo $this->variables['txtName']; ?> <?php echo $this->variables['txtNameError']; ?>

								<div class="oneLiner">
									<p>
										<label for="value"><?php echo SpoonFilter::ucfirst($this->variables['lblValue']); ?></label>
									</p>
									<p>
										<abbr class="help">(?)</abbr>
										<span class="tooltip" style="display: none;">
											<?php echo $this->variables['msgHelpValue']; ?>
										</span>
									</p>
								</div>
								<?php echo $this->variables['txtValue']; ?> <?php echo $this->variables['txtValueError']; ?>

							</div>
						</td>
					</tr>
				</tbody>
				<tfoot>
					<tr>
						<td colspan="99">
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
					if(isset($this->variables['dgLabels']) && count($this->variables['dgLabels']) != 0 && $this->variables['dgLabels'] != '' && $this->variables['dgLabels'] !== false)
					{
						?>
	<div class="dataGridHolder">
		<div class="tableHeading">
			<h3><?php echo SpoonFilter::ucfirst($this->variables['lblLabels']); ?></h3>
		</div>
		<?php echo $this->variables['dgLabels']; ?>
	</div>
	<?php } ?>

	<?php
					if(isset($this->variables['dgMessages']) && count($this->variables['dgMessages']) != 0 && $this->variables['dgMessages'] != '' && $this->variables['dgMessages'] !== false)
					{
						?>
	<div class="dataGridHolder">
		<div class="tableHeading">
			<h3><?php echo SpoonFilter::ucfirst($this->variables['lblMessages']); ?></h3>
		</div>
		<?php echo $this->variables['dgMessages']; ?>
	</div>
	<?php } ?>

	<?php
					if(isset($this->variables['dgErrors']) && count($this->variables['dgErrors']) != 0 && $this->variables['dgErrors'] != '' && $this->variables['dgErrors'] !== false)
					{
						?>
	<div class="dataGridHolder">
		<div class="tableHeading">
			<h3><?php echo SpoonFilter::ucfirst($this->variables['lblErrors']); ?></h3>
		</div>
		<?php echo $this->variables['dgErrors']; ?>
	</div>
	<?php } ?>

	<?php
					if(isset($this->variables['dgActions']) && count($this->variables['dgActions']) != 0 && $this->variables['dgActions'] != '' && $this->variables['dgActions'] !== false)
					{
						?>
	<div class="dataGridHolder">
		<div class="tableHeading oneLiner">
			<h3><?php echo SpoonFilter::ucfirst($this->variables['lblActions']); ?> </h3>
				<abbr class="help">(?)</abbr>
				<span class="tooltip" style="display: none;">
					<?php echo $this->variables['msgHelpActionValue']; ?>
				</span>
		</div>
		<?php echo $this->variables['dgActions']; ?>
	</div>
	<?php } ?>

	<?php
					if(isset($this->variables['noItems']) && count($this->variables['noItems']) != 0 && $this->variables['noItems'] != '' && $this->variables['noItems'] !== false)
					{
						?>
		<p><?php echo sprintf($this->variables['msgNoItemsFilter'], $this->variables['addURL']); ?></p>
	<?php } ?>
</div>

<?php
				ob_start();
				?><?php echo $this->variables['BACKEND_CORE_PATH']; ?>/Layout/Templates/StructureEndModule.tpl<?php
				$include = eval('return \'' . str_replace('\'', '\\\'', ob_get_clean()) .'\';');
				if($this->getForceCompile() || !file_exists($this->getCompileDirectory() .'/' . $this->getCompileName($include, '/home/segaz/domains/techno-mir.net/public_html/src/Backend/Modules/Locale/Layout/Templates'))) $this->compile('/home/segaz/domains/techno-mir.net/public_html/src/Backend/Modules/Locale/Layout/Templates', $include);
				$return = @include $this->getCompileDirectory() .'/' . $this->getCompileName($include, '/home/segaz/domains/techno-mir.net/public_html/src/Backend/Modules/Locale/Layout/Templates');
				if($return === false && $this->compile('/home/segaz/domains/techno-mir.net/public_html/src/Backend/Modules/Locale/Layout/Templates', $include))
				{
					$return = @include $this->getCompileDirectory() .'/' . $this->getCompileName($include, '/home/segaz/domains/techno-mir.net/public_html/src/Backend/Modules/Locale/Layout/Templates');
				}
?>
<?php
				ob_start();
				?><?php echo $this->variables['BACKEND_CORE_PATH']; ?>/Layout/Templates/Footer.tpl<?php
				$include = eval('return \'' . str_replace('\'', '\\\'', ob_get_clean()) .'\';');
				if($this->getForceCompile() || !file_exists($this->getCompileDirectory() .'/' . $this->getCompileName($include, '/home/segaz/domains/techno-mir.net/public_html/src/Backend/Modules/Locale/Layout/Templates'))) $this->compile('/home/segaz/domains/techno-mir.net/public_html/src/Backend/Modules/Locale/Layout/Templates', $include);
				$return = @include $this->getCompileDirectory() .'/' . $this->getCompileName($include, '/home/segaz/domains/techno-mir.net/public_html/src/Backend/Modules/Locale/Layout/Templates');
				if($return === false && $this->compile('/home/segaz/domains/techno-mir.net/public_html/src/Backend/Modules/Locale/Layout/Templates', $include))
				{
					$return = @include $this->getCompileDirectory() .'/' . $this->getCompileName($include, '/home/segaz/domains/techno-mir.net/public_html/src/Backend/Modules/Locale/Layout/Templates');
				}
?>
