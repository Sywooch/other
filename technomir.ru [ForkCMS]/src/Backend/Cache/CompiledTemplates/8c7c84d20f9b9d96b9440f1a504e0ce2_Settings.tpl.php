<?php error_reporting(0); ini_set('display_errors', 'Off'); ?>
<?php
				ob_start();
				?><?php echo $this->variables['BACKEND_CORE_PATH']; ?>/Layout/Templates/Head.tpl<?php
				$include = eval('return \'' . str_replace('\'', '\\\'', ob_get_clean()) .'\';');
				if($this->getForceCompile() || !file_exists($this->getCompileDirectory() .'/' . $this->getCompileName($include, '/home/segaz/domains/techno-mir.net/public_html/src/Backend/Modules/Search/Layout/Templates'))) $this->compile('/home/segaz/domains/techno-mir.net/public_html/src/Backend/Modules/Search/Layout/Templates', $include);
				$return = @include $this->getCompileDirectory() .'/' . $this->getCompileName($include, '/home/segaz/domains/techno-mir.net/public_html/src/Backend/Modules/Search/Layout/Templates');
				if($return === false && $this->compile('/home/segaz/domains/techno-mir.net/public_html/src/Backend/Modules/Search/Layout/Templates', $include))
				{
					$return = @include $this->getCompileDirectory() .'/' . $this->getCompileName($include, '/home/segaz/domains/techno-mir.net/public_html/src/Backend/Modules/Search/Layout/Templates');
				}
?>
<?php
				ob_start();
				?><?php echo $this->variables['BACKEND_CORE_PATH']; ?>/Layout/Templates/StructureStartModule.tpl<?php
				$include = eval('return \'' . str_replace('\'', '\\\'', ob_get_clean()) .'\';');
				if($this->getForceCompile() || !file_exists($this->getCompileDirectory() .'/' . $this->getCompileName($include, '/home/segaz/domains/techno-mir.net/public_html/src/Backend/Modules/Search/Layout/Templates'))) $this->compile('/home/segaz/domains/techno-mir.net/public_html/src/Backend/Modules/Search/Layout/Templates', $include);
				$return = @include $this->getCompileDirectory() .'/' . $this->getCompileName($include, '/home/segaz/domains/techno-mir.net/public_html/src/Backend/Modules/Search/Layout/Templates');
				if($return === false && $this->compile('/home/segaz/domains/techno-mir.net/public_html/src/Backend/Modules/Search/Layout/Templates', $include))
				{
					$return = @include $this->getCompileDirectory() .'/' . $this->getCompileName($include, '/home/segaz/domains/techno-mir.net/public_html/src/Backend/Modules/Search/Layout/Templates');
				}
?>


<div class="pageTitle">
	<h2><?php echo SpoonFilter::ucfirst($this->variables['lblModuleSettings']); ?>: <?php echo $this->variables['lblSearch']; ?></h2>
</div>

<?php
					if(isset($this->forms['settings']))
					{
						?><form accept-charset="UTF-8" action="<?php echo $this->forms['settings']->getAction(); ?>" method="<?php echo $this->forms['settings']->getMethod(); ?>"<?php echo $this->forms['settings']->getParametersHTML(); ?>>
						<?php echo $this->forms['settings']->getField('form')->parse();
						if($this->forms['settings']->getUseToken())
						{
							?><input type="hidden" name="form_token" id="<?php echo $this->forms['settings']->getField('form_token')->getAttribute('id'); ?>" value="<?php echo htmlspecialchars($this->forms['settings']->getField('form_token')->getValue()); ?>" />
						<?php } ?>
	<div class="box">
		<div class="heading">
			<h3><?php echo SpoonFilter::ucfirst($this->variables['lblPagination']); ?></h3>
		</div>
		<div class="options">
			<p>
				<label for="overviewNumItems"><?php echo SpoonFilter::ucfirst($this->variables['lblItemsPerPage']); ?></label>
				<?php echo $this->variables['ddmOverviewNumItems']; ?> <?php echo $this->variables['ddmOverviewNumItemsError']; ?>
			</p>
			<p>
				<label for="autocompleteNumItems"><?php echo SpoonFilter::ucfirst($this->variables['lblItemsForAutocomplete']); ?></label>
				<?php echo $this->variables['ddmAutocompleteNumItems']; ?> <?php echo $this->variables['ddmAutocompleteNumItemsError']; ?>
			</p>
			<p>
				<label for="autosuggestNumItems"><?php echo SpoonFilter::ucfirst($this->variables['lblItemsForAutosuggest']); ?></label>
				<?php echo $this->variables['ddmAutosuggestNumItems']; ?> <?php echo $this->variables['ddmAutosuggestNumItemsError']; ?>
			</p>
		</div>
	</div>

	<div class="box">
		<div class="heading">
			<h3><?php echo SpoonFilter::ucfirst($this->variables['lblModuleWeight']); ?></h3>
		</div>

		<div class="options" id="searchModules">

			<p><?php echo $this->variables['msgHelpWeightGeneral']; ?></p>
			<div class="dataGridHolder">
				<table class="dataGrid">
					<tr>
						<th style="width: 30%;"><span><?php echo $this->variables['msgIncludeInSearch']; ?></span></th>
						<th><span><?php echo SpoonFilter::ucfirst($this->variables['lblModule']); ?></span></th>
						<th>
							<span>
								<div class="oneLiner">
									<p><?php echo SpoonFilter::ucfirst($this->variables['lblWeight']); ?></p>
									<abbr class="help">(?)</abbr>
									<div class="tooltip" style="display: none;">
										<p><?php echo $this->variables['msgHelpWeight']; ?></p>
									</div>
								</div>
							</span>
						</th>
					</tr>
					<?php
				if(isset(${'modules'})) $this->iterations['8c7c84d20f9b9d96b9440f1a504e0ce2_Settings.tpl.php_1']['old'] = ${'modules'};
				$this->iterations['8c7c84d20f9b9d96b9440f1a504e0ce2_Settings.tpl.php_1']['iteration'] = $this->variables['modules'];
				$this->iterations['8c7c84d20f9b9d96b9440f1a504e0ce2_Settings.tpl.php_1']['i'] = 1;
				$this->iterations['8c7c84d20f9b9d96b9440f1a504e0ce2_Settings.tpl.php_1']['count'] = count($this->iterations['8c7c84d20f9b9d96b9440f1a504e0ce2_Settings.tpl.php_1']['iteration']);
				foreach((array) $this->iterations['8c7c84d20f9b9d96b9440f1a504e0ce2_Settings.tpl.php_1']['iteration'] as ${'modules'})
				{
					if(!isset(${'modules'}['first']) && $this->iterations['8c7c84d20f9b9d96b9440f1a504e0ce2_Settings.tpl.php_1']['i'] == 1) ${'modules'}['first'] = true;
					if(!isset(${'modules'}['last']) && $this->iterations['8c7c84d20f9b9d96b9440f1a504e0ce2_Settings.tpl.php_1']['i'] == $this->iterations['8c7c84d20f9b9d96b9440f1a504e0ce2_Settings.tpl.php_1']['count']) ${'modules'}['last'] = true;
					if(isset(${'modules'}['formElements']) && is_array(${'modules'}['formElements']))
					{
						foreach(${'modules'}['formElements'] as $name => $object)
						{
							${'modules'}[$name] = $object->parse();
							${'modules'}[$name .'Error'] = (is_callable(array($object, 'getErrors')) && $object->getErrors() != '') ? '<span class="formError">' . $object->getErrors() .'</span>' : '';
						}
					} ?>
						<tr class="<?php
					$arguments = array();
						ob_start();
						?>odd<?php
						$arguments[] = eval('return \'' . str_replace('\'', '\\\'', ob_get_clean()) .'\';');
						ob_start();
						?>even<?php
						$arguments[] = eval('return \'' . str_replace('\'', '\\\'', ob_get_clean()) .'\';');
					echo $this->cycle($this->iterations['8c7c84d20f9b9d96b9440f1a504e0ce2_Settings.tpl.php_1']['i'], $arguments);
					?>
">
							<td><span class="checkboxHolder"><?php echo ${'modules'}['chk']; ?></span></td>
							<td><label for="<?php echo ${'modules'}['id']; ?>"><?php echo ${'modules'}['label']; ?></label></td>
							<td><label for="<?php echo ${'modules'}['id']; ?>Weight" class="visuallyHidden"><?php echo SpoonFilter::ucfirst($this->variables['lblWeight']); ?></label><?php echo ${'modules'}['txt']; ?> <?php
					if(isset(${'modules'}['txtError']) && count(${'modules'}['txtError']) != 0 && ${'modules'}['txtError'] != '' && ${'modules'}['txtError'] !== false)
					{
						?><span class="formError"><?php echo ${'modules'}['txtError']; ?></span><?php } ?></td>
						</tr>
					<?php
					$this->iterations['8c7c84d20f9b9d96b9440f1a504e0ce2_Settings.tpl.php_1']['i']++;
				}
				if(isset($this->iterations['8c7c84d20f9b9d96b9440f1a504e0ce2_Settings.tpl.php_1']['old'])) ${'modules'} = $this->iterations['8c7c84d20f9b9d96b9440f1a504e0ce2_Settings.tpl.php_1']['old'];
				else unset($this->iterations['8c7c84d20f9b9d96b9440f1a504e0ce2_Settings.tpl.php_1']);
				?>
				</table>
			</div>

		</div>
	</div>

	<div class="fullwidthOptions">
		<div class="buttonHolderRight">
			<input id="save" class="inputButton button mainButton" type="submit" name="save" value="<?php echo SpoonFilter::ucfirst($this->variables['lblSave']); ?>" />
		</div>
	</div>
</form>
				<?php } ?>

<?php
				ob_start();
				?><?php echo $this->variables['BACKEND_CORE_PATH']; ?>/Layout/Templates/StructureEndModule.tpl<?php
				$include = eval('return \'' . str_replace('\'', '\\\'', ob_get_clean()) .'\';');
				if($this->getForceCompile() || !file_exists($this->getCompileDirectory() .'/' . $this->getCompileName($include, '/home/segaz/domains/techno-mir.net/public_html/src/Backend/Modules/Search/Layout/Templates'))) $this->compile('/home/segaz/domains/techno-mir.net/public_html/src/Backend/Modules/Search/Layout/Templates', $include);
				$return = @include $this->getCompileDirectory() .'/' . $this->getCompileName($include, '/home/segaz/domains/techno-mir.net/public_html/src/Backend/Modules/Search/Layout/Templates');
				if($return === false && $this->compile('/home/segaz/domains/techno-mir.net/public_html/src/Backend/Modules/Search/Layout/Templates', $include))
				{
					$return = @include $this->getCompileDirectory() .'/' . $this->getCompileName($include, '/home/segaz/domains/techno-mir.net/public_html/src/Backend/Modules/Search/Layout/Templates');
				}
?>
<?php
				ob_start();
				?><?php echo $this->variables['BACKEND_CORE_PATH']; ?>/Layout/Templates/Footer.tpl<?php
				$include = eval('return \'' . str_replace('\'', '\\\'', ob_get_clean()) .'\';');
				if($this->getForceCompile() || !file_exists($this->getCompileDirectory() .'/' . $this->getCompileName($include, '/home/segaz/domains/techno-mir.net/public_html/src/Backend/Modules/Search/Layout/Templates'))) $this->compile('/home/segaz/domains/techno-mir.net/public_html/src/Backend/Modules/Search/Layout/Templates', $include);
				$return = @include $this->getCompileDirectory() .'/' . $this->getCompileName($include, '/home/segaz/domains/techno-mir.net/public_html/src/Backend/Modules/Search/Layout/Templates');
				if($return === false && $this->compile('/home/segaz/domains/techno-mir.net/public_html/src/Backend/Modules/Search/Layout/Templates', $include))
				{
					$return = @include $this->getCompileDirectory() .'/' . $this->getCompileName($include, '/home/segaz/domains/techno-mir.net/public_html/src/Backend/Modules/Search/Layout/Templates');
				}
?>
