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
	<h2><?php if(array_key_exists('lblContentBlocks', (array) $this->variables)) { echo SpoonFilter::ucfirst($this->variables['lblContentBlocks']); } else { ?>{$lblContentBlocks|ucfirst}<?php } ?>: <?php if(array_key_exists('msgEditContentBlock', (array) $this->variables) && array_key_exists('title', (array) $this->variables)) { echo sprintf($this->variables['msgEditContentBlock'], $this->variables['title']); } else { ?>{$msgEditContentBlock|sprintf:<?php if(array_key_exists('title', (array) $this->variables)) { echo $this->variables['title']; } else { ?>{$title}<?php } ?>}<?php } ?></h2>
</div>

<?php
					if(isset($this->forms['edit']))
					{
						?><form accept-charset="UTF-8" action="<?php echo $this->forms['edit']->getAction(); ?>" method="<?php echo $this->forms['edit']->getMethod(); ?>"<?php echo $this->forms['edit']->getParametersHTML(); ?>>
						<?php echo $this->forms['edit']->getField('form')->parse();
						if($this->forms['edit']->getUseToken())
						{
							?><input type="hidden" name="form_token" id="<?php echo $this->forms['edit']->getField('form_token')->getAttribute('id'); ?>" value="<?php echo htmlspecialchars($this->forms['edit']->getField('form_token')->getValue()); ?>" />
						<?php } ?>
	<div class="tabs">
		<ul>
			<li><a href="#tabContent"><?php if(array_key_exists('lblContent', (array) $this->variables)) { echo SpoonFilter::ucfirst($this->variables['lblContent']); } else { ?>{$lblContent|ucfirst}<?php } ?></a></li>
			<li><a href="#tabVersions"><?php if(array_key_exists('lblVersions', (array) $this->variables)) { echo SpoonFilter::ucfirst($this->variables['lblVersions']); } else { ?>{$lblVersions|ucfirst}<?php } ?></a></li>
		</ul>

		<div id="tabContent">
			<fieldset>
				<p>
					<label for="title"><?php if(array_key_exists('lblTitle', (array) $this->variables)) { echo SpoonFilter::ucfirst($this->variables['lblTitle']); } else { ?>{$lblTitle|ucfirst}<?php } ?><abbr title="<?php if(array_key_exists('lblRequiredField', (array) $this->variables)) { echo $this->variables['lblRequiredField']; } else { ?>{$lblRequiredField}<?php } ?>">*</abbr></label>
					<?php if(array_key_exists('txtTitle', (array) $this->variables)) { echo $this->variables['txtTitle']; } else { ?>{$txtTitle}<?php } ?> <?php if(array_key_exists('txtTitleError', (array) $this->variables)) { echo $this->variables['txtTitleError']; } else { ?>{$txtTitleError}<?php } ?>
				</p>

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

		<div id="tabVersions">
			<div class="tableHeading">
				<div class="oneLiner">
					<h3 class="oneLinerElement"><?php if(array_key_exists('lblPreviousVersions', (array) $this->variables)) { echo SpoonFilter::ucfirst($this->variables['lblPreviousVersions']); } else { ?>{$lblPreviousVersions|ucfirst}<?php } ?></h3>
					<abbr class="help">(?)</abbr>
					<div class="tooltip" style="display: none;">
						<p><?php if(array_key_exists('msgHelpRevisions', (array) $this->variables)) { echo $this->variables['msgHelpRevisions']; } else { ?>{$msgHelpRevisions}<?php } ?></p>
					</div>
				</div>
			</div>

			<?php
					if(isset($this->variables['revisions']) && count($this->variables['revisions']) != 0 && $this->variables['revisions'] != '' && $this->variables['revisions'] !== false)
					{
						?>
			<div class="dataGridHolder">
				<?php if(array_key_exists('revisions', (array) $this->variables)) { echo $this->variables['revisions']; } else { ?>{$revisions}<?php } ?>
			</div>
			<?php } ?>

			<?php if(!isset($this->variables['revisions']) || count($this->variables['revisions']) == 0 || $this->variables['revisions'] == '' || $this->variables['revisions'] === false): ?>
				<p><?php if(array_key_exists('msgNoRevisions', (array) $this->variables)) { echo $this->variables['msgNoRevisions']; } else { ?>{$msgNoRevisions}<?php } ?></p>
			<?php endif; ?>
		</div>
	</div>

	<div class="fullwidthOptions">
		<?php
					if(isset($this->variables['showContentBlocksDelete']) && count($this->variables['showContentBlocksDelete']) != 0 && $this->variables['showContentBlocksDelete'] != '' && $this->variables['showContentBlocksDelete'] !== false)
					{
						?>
		<a href="<?php if(array_key_exists('var', (array) $this->variables)) { echo Backend\Core\Engine\TemplateModifiers::getURL($this->variables['var'], 'delete'); } else { ?>{$var|geturl:'delete'}<?php } ?>&amp;id=<?php if(array_key_exists('id', (array) $this->variables)) { echo $this->variables['id']; } else { ?>{$id}<?php } ?>" data-message-id="confirmDelete" class="askConfirmation button linkButton icon iconDelete">
			<span><?php if(array_key_exists('lblDelete', (array) $this->variables)) { echo SpoonFilter::ucfirst($this->variables['lblDelete']); } else { ?>{$lblDelete|ucfirst}<?php } ?></span>
		</a>
		<?php } ?>

		<div class="buttonHolderRight">
			<input id="editButton" class="inputButton button mainButton" type="submit" name="edit" value="<?php if(array_key_exists('lblSave', (array) $this->variables)) { echo SpoonFilter::ucfirst($this->variables['lblSave']); } else { ?>{$lblSave|ucfirst}<?php } ?>" />
		</div>
	</div>

	<div id="confirmDelete" title="<?php if(array_key_exists('lblDelete', (array) $this->variables)) { echo SpoonFilter::ucfirst($this->variables['lblDelete']); } else { ?>{$lblDelete|ucfirst}<?php } ?>?" style="display: none;">
		<p>
			<?php if(array_key_exists('msgConfirmDelete', (array) $this->variables) && array_key_exists('title', (array) $this->variables)) { echo sprintf($this->variables['msgConfirmDelete'], $this->variables['title']); } else { ?>{$msgConfirmDelete|sprintf:<?php if(array_key_exists('title', (array) $this->variables)) { echo $this->variables['title']; } else { ?>{$title}<?php } ?>}<?php } ?>
		</p>
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
