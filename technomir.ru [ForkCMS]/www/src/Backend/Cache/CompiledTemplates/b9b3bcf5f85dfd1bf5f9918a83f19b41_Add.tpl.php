<?php error_reporting(E_ALL | E_STRICT); ini_set('display_errors', 'On'); ?>
<?php
				ob_start();
				?><?php if(array_key_exists('BACKEND_CORE_PATH', (array) $this->variables)) { echo $this->variables['BACKEND_CORE_PATH']; } else { ?>{$BACKEND_CORE_PATH}<?php } ?>/Layout/Templates/Head.tpl<?php
				$include = eval('return \'' . str_replace('\'', '\\\'', ob_get_clean()) .'\';');
				if($this->getForceCompile() || !file_exists($this->getCompileDirectory() .'/' . $this->getCompileName($include, '/home/segaz/domains/techno-mir.net/public_html/src/Backend/Modules/ContentBlocks/Layout/Templates'))) $this->compile('/home/segaz/domains/techno-mir.net/public_html/src/Backend/Modules/ContentBlocks/Layout/Templates', $include);
				$return = @include $this->getCompileDirectory() .'/' . $this->getCompileName($include, '/home/segaz/domains/techno-mir.net/public_html/src/Backend/Modules/ContentBlocks/Layout/Templates');
				if($return === false && $this->compile('/home/segaz/domains/techno-mir.net/public_html/src/Backend/Modules/ContentBlocks/Layout/Templates', $include))
				{
					$return = @include $this->getCompileDirectory() .'/' . $this->getCompileName($include, '/home/segaz/domains/techno-mir.net/public_html/src/Backend/Modules/ContentBlocks/Layout/Templates');
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
				if($this->getForceCompile() || !file_exists($this->getCompileDirectory() .'/' . $this->getCompileName($include, '/home/segaz/domains/techno-mir.net/public_html/src/Backend/Modules/ContentBlocks/Layout/Templates'))) $this->compile('/home/segaz/domains/techno-mir.net/public_html/src/Backend/Modules/ContentBlocks/Layout/Templates', $include);
				$return = @include $this->getCompileDirectory() .'/' . $this->getCompileName($include, '/home/segaz/domains/techno-mir.net/public_html/src/Backend/Modules/ContentBlocks/Layout/Templates');
				if($return === false && $this->compile('/home/segaz/domains/techno-mir.net/public_html/src/Backend/Modules/ContentBlocks/Layout/Templates', $include))
				{
					$return = @include $this->getCompileDirectory() .'/' . $this->getCompileName($include, '/home/segaz/domains/techno-mir.net/public_html/src/Backend/Modules/ContentBlocks/Layout/Templates');
				}
if($return === false)
				{
					?>{include:<?php if(array_key_exists('BACKEND_CORE_PATH', (array) $this->variables)) { echo $this->variables['BACKEND_CORE_PATH']; } else { ?>{$BACKEND_CORE_PATH}<?php } ?>/Layout/Templates/StructureStartModule.tpl}<?php
				}
?>

<div class="pageTitle">
	<h2><?php if(array_key_exists('lblContentBlocks', (array) $this->variables)) { echo SpoonFilter::ucfirst($this->variables['lblContentBlocks']); } else { ?>{$lblContentBlocks|ucfirst}<?php } ?>: <?php if(array_key_exists('lblAdd', (array) $this->variables)) { echo $this->variables['lblAdd']; } else { ?>{$lblAdd}<?php } ?></h2>
</div>

<?php
					if(isset($this->forms['add']))
					{
						?><form accept-charset="UTF-8" action="<?php echo $this->forms['add']->getAction(); ?>" method="<?php echo $this->forms['add']->getMethod(); ?>"<?php echo $this->forms['add']->getParametersHTML(); ?>>
						<?php echo $this->forms['add']->getField('form')->parse();
						if($this->forms['add']->getUseToken())
						{
							?><input type="hidden" name="form_token" id="<?php echo $this->forms['add']->getField('form_token')->getAttribute('id'); ?>" value="<?php echo htmlspecialchars($this->forms['add']->getField('form_token')->getValue()); ?>" />
						<?php } ?>
	<p>
		<label for="title"><?php if(array_key_exists('lblTitle', (array) $this->variables)) { echo SpoonFilter::ucfirst($this->variables['lblTitle']); } else { ?>{$lblTitle|ucfirst}<?php } ?></label>
		<?php if(array_key_exists('txtTitle', (array) $this->variables)) { echo $this->variables['txtTitle']; } else { ?>{$txtTitle}<?php } ?> <?php if(array_key_exists('txtTitleError', (array) $this->variables)) { echo $this->variables['txtTitleError']; } else { ?>{$txtTitleError}<?php } ?>
	</p>

	<div class="content">
		<fieldset>
			<div class="box">
				<div class="heading">
					<h3>
						<label for="text"><?php if(array_key_exists('lblContent', (array) $this->variables)) { echo SpoonFilter::ucfirst($this->variables['lblContent']); } else { ?>{$lblContent|ucfirst}<?php } ?><abbr title="<?php if(array_key_exists('lblRequiredField', (array) $this->variables)) { echo $this->variables['lblRequiredField']; } else { ?>{$lblRequiredField}<?php } ?>">*</abbr></label>
					</h3>
				</div>
				<div class="optionsRTE">
					<?php if(array_key_exists('txtText', (array) $this->variables)) { echo $this->variables['txtText']; } else { ?>{$txtText}<?php } ?> <?php if(array_key_exists('txtTextError', (array) $this->variables)) { echo $this->variables['txtTextError']; } else { ?>{$txtTextError}<?php } ?>
				</div>
			</div>

			<?php
					if(isset($this->variables['ddmTemplate']) && count($this->variables['ddmTemplate']) != 0 && $this->variables['ddmTemplate'] != '' && $this->variables['ddmTemplate'] !== false)
					{
						?><p><?php if(array_key_exists('lblTemplate', (array) $this->variables)) { echo SpoonFilter::ucfirst($this->variables['lblTemplate']); } else { ?>{$lblTemplate|ucfirst}<?php } ?> <label for="template"><?php if(array_key_exists('ddmTemplate', (array) $this->variables)) { echo $this->variables['ddmTemplate']; } else { ?>{$ddmTemplate}<?php } ?> <?php if(array_key_exists('ddmTemplateError', (array) $this->variables)) { echo $this->variables['ddmTemplateError']; } else { ?>{$ddmTemplateError}<?php } ?></label></p><?php } ?>
			<p><label for="hidden"><?php if(array_key_exists('chkHidden', (array) $this->variables)) { echo $this->variables['chkHidden']; } else { ?>{$chkHidden}<?php } ?> <?php if(array_key_exists('chkHiddenError', (array) $this->variables)) { echo $this->variables['chkHiddenError']; } else { ?>{$chkHiddenError}<?php } ?> <?php if(array_key_exists('lblVisibleOnSite', (array) $this->variables)) { echo SpoonFilter::ucfirst($this->variables['lblVisibleOnSite']); } else { ?>{$lblVisibleOnSite|ucfirst}<?php } ?></label></p>
		</fieldset>
	</div>

	<div class="fullwidthOptions">
		<div class="buttonHolderRight">
			<input id="addButton" class="inputButton button mainButton" type="submit" name="add" value="<?php if(array_key_exists('lblAdd', (array) $this->variables)) { echo SpoonFilter::ucfirst($this->variables['lblAdd']); } else { ?>{$lblAdd|ucfirst}<?php } ?>" />
		</div>
	</div>
</form>
				<?php } ?>

<?php
				ob_start();
				?><?php if(array_key_exists('BACKEND_CORE_PATH', (array) $this->variables)) { echo $this->variables['BACKEND_CORE_PATH']; } else { ?>{$BACKEND_CORE_PATH}<?php } ?>/Layout/Templates/StructureEndModule.tpl<?php
				$include = eval('return \'' . str_replace('\'', '\\\'', ob_get_clean()) .'\';');
				if($this->getForceCompile() || !file_exists($this->getCompileDirectory() .'/' . $this->getCompileName($include, '/home/segaz/domains/techno-mir.net/public_html/src/Backend/Modules/ContentBlocks/Layout/Templates'))) $this->compile('/home/segaz/domains/techno-mir.net/public_html/src/Backend/Modules/ContentBlocks/Layout/Templates', $include);
				$return = @include $this->getCompileDirectory() .'/' . $this->getCompileName($include, '/home/segaz/domains/techno-mir.net/public_html/src/Backend/Modules/ContentBlocks/Layout/Templates');
				if($return === false && $this->compile('/home/segaz/domains/techno-mir.net/public_html/src/Backend/Modules/ContentBlocks/Layout/Templates', $include))
				{
					$return = @include $this->getCompileDirectory() .'/' . $this->getCompileName($include, '/home/segaz/domains/techno-mir.net/public_html/src/Backend/Modules/ContentBlocks/Layout/Templates');
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
				if($this->getForceCompile() || !file_exists($this->getCompileDirectory() .'/' . $this->getCompileName($include, '/home/segaz/domains/techno-mir.net/public_html/src/Backend/Modules/ContentBlocks/Layout/Templates'))) $this->compile('/home/segaz/domains/techno-mir.net/public_html/src/Backend/Modules/ContentBlocks/Layout/Templates', $include);
				$return = @include $this->getCompileDirectory() .'/' . $this->getCompileName($include, '/home/segaz/domains/techno-mir.net/public_html/src/Backend/Modules/ContentBlocks/Layout/Templates');
				if($return === false && $this->compile('/home/segaz/domains/techno-mir.net/public_html/src/Backend/Modules/ContentBlocks/Layout/Templates', $include))
				{
					$return = @include $this->getCompileDirectory() .'/' . $this->getCompileName($include, '/home/segaz/domains/techno-mir.net/public_html/src/Backend/Modules/ContentBlocks/Layout/Templates');
				}
if($return === false)
				{
					?>{include:<?php if(array_key_exists('BACKEND_CORE_PATH', (array) $this->variables)) { echo $this->variables['BACKEND_CORE_PATH']; } else { ?>{$BACKEND_CORE_PATH}<?php } ?>/Layout/Templates/Footer.tpl}<?php
				}
?>
