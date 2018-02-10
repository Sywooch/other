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
					if(isset($this->forms['add']))
					{
						?><form accept-charset="UTF-8" action="<?php echo $this->forms['add']->getAction(); ?>" method="<?php echo $this->forms['add']->getMethod(); ?>"<?php echo $this->forms['add']->getParametersHTML(); ?>>
						<?php echo $this->forms['add']->getField('form')->parse();
						if($this->forms['add']->getUseToken())
						{
							?><input type="hidden" name="form_token" id="<?php echo $this->forms['add']->getField('form_token')->getAttribute('id'); ?>" value="<?php echo htmlspecialchars($this->forms['add']->getField('form_token')->getValue()); ?>" />
						<?php } ?>
	<div class="box horizontal">
		<div class="heading">
			<h3><?php echo SpoonFilter::ucfirst($this->variables['lblExtensions']); ?>: <?php echo $this->variables['lblAddTemplate']; ?></h3>
		</div>

		<div class="options">
			<p>
				<label for="file"><?php echo SpoonFilter::ucfirst($this->variables['msgPathToTemplate']); ?></label>
				<label for="theme" class="visuallyHidden"><?php echo SpoonFilter::ucfirst($this->variables['lblTheme']); ?></label>
				<?php echo $this->variables['ddmTheme']; ?><small><code>/Core/Layout/Templates/</code></small><?php echo $this->variables['txtFile']; ?> <?php echo $this->variables['ddmThemeError']; ?> <?php echo $this->variables['txtFileError']; ?>
				<span class="helpTxt"><?php echo $this->variables['msgHelpTemplateLocation']; ?></span>
			</p>
			<p>
				<label for="label"><?php echo SpoonFilter::ucfirst($this->variables['lblLabel']); ?></label>
				<?php echo $this->variables['txtLabel']; ?> <?php echo $this->variables['txtLabelError']; ?>
			</p>
		</div>
	</div>

	<div class="box horizontal">
		<div class="heading">
			<h3><?php echo SpoonFilter::ucfirst($this->variables['lblPositions']); ?></h3>
		</div>

		
		<div id="positionsList" class="options">

			<?php
				if(isset(${'positions'})) $this->iterations['3453825479600b747e181213c923534b_AddThemeTemplate.tpl.php_1']['old'] = ${'positions'};
				$this->iterations['3453825479600b747e181213c923534b_AddThemeTemplate.tpl.php_1']['iteration'] = $this->variables['positions'];
				$this->iterations['3453825479600b747e181213c923534b_AddThemeTemplate.tpl.php_1']['i'] = 1;
				$this->iterations['3453825479600b747e181213c923534b_AddThemeTemplate.tpl.php_1']['count'] = count($this->iterations['3453825479600b747e181213c923534b_AddThemeTemplate.tpl.php_1']['iteration']);
				foreach((array) $this->iterations['3453825479600b747e181213c923534b_AddThemeTemplate.tpl.php_1']['iteration'] as ${'positions'})
				{
					if(!isset(${'positions'}['first']) && $this->iterations['3453825479600b747e181213c923534b_AddThemeTemplate.tpl.php_1']['i'] == 1) ${'positions'}['first'] = true;
					if(!isset(${'positions'}['last']) && $this->iterations['3453825479600b747e181213c923534b_AddThemeTemplate.tpl.php_1']['i'] == $this->iterations['3453825479600b747e181213c923534b_AddThemeTemplate.tpl.php_1']['count']) ${'positions'}['last'] = true;
					if(isset(${'positions'}['formElements']) && is_array(${'positions'}['formElements']))
					{
						foreach(${'positions'}['formElements'] as $name => $object)
						{
							${'positions'}[$name] = $object->parse();
							${'positions'}[$name .'Error'] = (is_callable(array($object, 'getErrors')) && $object->getErrors() != '') ? '<span class="formError">' . $object->getErrors() .'</span>' : '';
						}
					} ?>
				<div class="position clearfix"<?php if(!isset(${'positions'}['i']) || count(${'positions'}['i']) == 0 || ${'positions'}['i'] == '' || ${'positions'}['i'] === false): ?> style="display: none"<?php endif; ?>>

					
					<label for="position<?php echo ${'positions'}['i']; ?>"><span class="positionLabel"><?php echo SpoonFilter::ucfirst($this->variables['lblPosition']); ?></span> <a href="#" class="deletePosition button icon iconOnly iconDelete"><span><?php echo SpoonFilter::ucfirst($this->variables['lblDeletePosition']); ?></span></a></label>

					
					<?php echo ${'positions'}['txtPosition']; ?>

					<?php echo ${'positions'}['txtPositionError']; ?>

					<div class="defaultBlocks">

						
						<?php
					if(isset(${'positions'}['blocks']) && count(${'positions'}['blocks']) != 0 && ${'positions'}['blocks'] != '' && ${'positions'}['blocks'] !== false)
					{
						?>
							<?php
				if(isset(${'positions'}['blocks'])) $this->iterations['3453825479600b747e181213c923534b_AddThemeTemplate.tpl.php_2']['blocks']['old'] = ${'positions'}['blocks'];
				$this->iterations['3453825479600b747e181213c923534b_AddThemeTemplate.tpl.php_2']['blocks']['iteration'] = ${'positions'}['blocks'];
				$this->iterations['3453825479600b747e181213c923534b_AddThemeTemplate.tpl.php_2']['blocks']['i'] = 1;
				$this->iterations['3453825479600b747e181213c923534b_AddThemeTemplate.tpl.php_2']['blocks']['count'] = count($this->iterations['3453825479600b747e181213c923534b_AddThemeTemplate.tpl.php_2']['blocks']['iteration']);
				foreach((array) $this->iterations['3453825479600b747e181213c923534b_AddThemeTemplate.tpl.php_2']['blocks']['iteration'] as ${'positions'}['blocks'])
				{
					if(!isset(${'positions'}['blocks']['first']) && $this->iterations['3453825479600b747e181213c923534b_AddThemeTemplate.tpl.php_2']['blocks']['i'] == 1) ${'positions'}['blocks']['first'] = true;
					if(!isset(${'positions'}['blocks']['last']) && $this->iterations['3453825479600b747e181213c923534b_AddThemeTemplate.tpl.php_2']['blocks']['i'] == $this->iterations['3453825479600b747e181213c923534b_AddThemeTemplate.tpl.php_2']['blocks']['count']) ${'positions'}['blocks']['last'] = true;
					if(isset(${'positions'}['blocks']['formElements']) && is_array(${'positions'}['blocks']['formElements']))
					{
						foreach(${'positions'}['blocks']['formElements'] as $name => $object)
						{
							${'positions'}['blocks'][$name] = $object->parse();
							${'positions'}['blocks'][$name .'Error'] = (is_callable(array($object, 'getErrors')) && $object->getErrors() != '') ? '<span class="formError">' . $object->getErrors() .'</span>' : '';
						}
					} ?>
								<div class="defaultBlock">
									<?php echo ${'positions'}['blocks']['ddmType']; ?>
									<?php echo ${'positions'}['blocks']['ddmTypeError']; ?>

									
									<a href="#" class="deleteBlock button icon iconOnly iconDelete"><span><?php echo SpoonFilter::ucfirst($this->variables['lblDeleteBlock']); ?></span></a>
								</div>
							<?php
					$this->iterations['3453825479600b747e181213c923534b_AddThemeTemplate.tpl.php_2']['blocks']['i']++;
				}
				if(isset($this->iterations['3453825479600b747e181213c923534b_AddThemeTemplate.tpl.php_2']['blocks']['old'])) ${'positions'}['blocks'] = $this->iterations['3453825479600b747e181213c923534b_AddThemeTemplate.tpl.php_2']['blocks']['old'];
				else unset($this->iterations['3453825479600b747e181213c923534b_AddThemeTemplate.tpl.php_2']['blocks']);
				?>
						<?php } ?>

						
						<a href="#" class="addBlock button icon iconAdd"><span><?php echo SpoonFilter::ucfirst($this->variables['lblAddBlock']); ?></span></a>

					</div>

				</div>
			<?php
					$this->iterations['3453825479600b747e181213c923534b_AddThemeTemplate.tpl.php_1']['i']++;
				}
				if(isset($this->iterations['3453825479600b747e181213c923534b_AddThemeTemplate.tpl.php_1']['old'])) ${'positions'} = $this->iterations['3453825479600b747e181213c923534b_AddThemeTemplate.tpl.php_1']['old'];
				else unset($this->iterations['3453825479600b747e181213c923534b_AddThemeTemplate.tpl.php_1']);
				?>

			
			<p>
				<a href="#" id="addPosition" class="button icon iconAdd"><span><?php echo SpoonFilter::ucfirst($this->variables['lblAddPosition']); ?></span></a>
			</p>

			<?php
					if(isset($this->variables['formErrors']) && count($this->variables['formErrors']) != 0 && $this->variables['formErrors'] != '' && $this->variables['formErrors'] !== false)
					{
						?><span class="formError"><?php echo $this->variables['formErrors']; ?></span><?php } ?>
		</div>
	</div>

	<div class="box horizontal">
		<div class="heading">
			<h3>
				<label for="format"><?php echo SpoonFilter::ucfirst($this->variables['lblLayout']); ?></label>
			</h3>
		</div>

		<div id="templateLayout" class="options clearfix">
			<p>
				<?php echo $this->variables['txtFormat']; ?> <?php echo $this->variables['txtFormatError']; ?>
				<span class="helpTxt"><?php echo $this->variables['msgHelpTemplateFormat']; ?></span>
			</p>

			<div class="longHelpTxt">
				<?php echo $this->variables['msgHelpPositionsLayout']; ?>
			</div>
		</div>
	</div>

	<div class="box horizontal">
		<div class="heading">
			<h3><?php echo SpoonFilter::ucfirst($this->variables['lblStatus']); ?></h3>
		</div>

		<div class="options">
			<ul class="inputList pb0">
				<li><label for="active"><?php echo $this->variables['chkActive']; ?> <?php echo SpoonFilter::ucfirst($this->variables['lblActive']); ?></label> <?php echo $this->variables['chkActiveError']; ?></li>
				<li><label for="default"><?php echo $this->variables['chkDefault']; ?> <?php echo SpoonFilter::ucfirst($this->variables['lblDefault']); ?></label> <?php echo $this->variables['chkDefaultError']; ?></li>
			</ul>
		</div>
	</div>

	<div class="fullwidthOptions">
		<div class="buttonHolderRight">
			<input id="addButton" class="inputButton button mainButton" type="submit" name="add" value="<?php echo SpoonFilter::ucfirst($this->variables['lblSave']); ?>" />
		</div>
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
