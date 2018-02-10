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

<div class="box">
	<div class="heading">
		<h3><?php echo SpoonFilter::ucfirst($this->variables['lblExtensions']); ?>: <?php echo $this->variables['lblUploadTheme']; ?></h3>
	</div>

	<?php
					if(isset($this->variables['zlibIsMissing']) && count($this->variables['zlibIsMissing']) != 0 && $this->variables['zlibIsMissing'] != '' && $this->variables['zlibIsMissing'] !== false)
					{
						?>
		<div class="options">
			<p>
				<?php echo $this->variables['msgZlibIsMissing']; ?>
			</p>
		</div>
	<?php } ?>

	<?php
					if(isset($this->variables['notWritable']) && count($this->variables['notWritable']) != 0 && $this->variables['notWritable'] != '' && $this->variables['notWritable'] !== false)
					{
						?>
		<div class="options">
			<p>
				<?php echo $this->variables['msgThemesNotWritable']; ?>
			</p>
		</div>
	<?php } ?>

	<?php if(!isset($this->variables['zlibIsMissing']) || count($this->variables['zlibIsMissing']) == 0 || $this->variables['zlibIsMissing'] == '' || $this->variables['zlibIsMissing'] === false): ?>
		<?php
					if(isset($this->forms['upload']))
					{
						?><form accept-charset="UTF-8" action="<?php echo $this->forms['upload']->getAction(); ?>" method="<?php echo $this->forms['upload']->getMethod(); ?>"<?php echo $this->forms['upload']->getParametersHTML(); ?>>
						<?php echo $this->forms['upload']->getField('form')->parse();
						if($this->forms['upload']->getUseToken())
						{
							?><input type="hidden" name="form_token" id="<?php echo $this->forms['upload']->getField('form_token')->getAttribute('id'); ?>" value="<?php echo htmlspecialchars($this->forms['upload']->getField('form_token')->getValue()); ?>" />
						<?php } ?>
			<div class="options">
				<div class="horizontal">
					<p>
						<label for="file"><?php echo SpoonFilter::ucfirst($this->variables['lblFile']); ?><abbr title="<?php echo $this->variables['lblRequiredField']; ?>">*</abbr></label>
						<?php echo $this->variables['fileFile']; ?> <?php echo $this->variables['fileFileError']; ?>
					</p>
				</div>
			</div>

			<div class="fullwidthOptions">
				<div class="buttonHolderRight">
					<input id="importButton" class="inputButton button mainButton" type="submit" name="add" value="<?php echo SpoonFilter::ucfirst($this->variables['lblInstall']); ?>" />
				</div>
			</div>
		</form>
				<?php } ?>
	<?php endif; ?>
</div>

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
