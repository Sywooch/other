<?php error_reporting(0); ini_set('display_errors', 'Off'); ?>
<?php
				ob_start();
				?><?php echo $this->variables['BACKEND_CORE_PATH']; ?>/Layout/Templates/Head.tpl<?php
				$include = eval('return \'' . str_replace('\'', '\\\'', ob_get_clean()) .'\';');
				if($this->getForceCompile() || !file_exists($this->getCompileDirectory() .'/' . $this->getCompileName($include, '/home/anastosi/domains/anastosi.ru/public_html/src/Backend/Modules/ContentBlocks/Layout/Templates'))) $this->compile('/home/anastosi/domains/anastosi.ru/public_html/src/Backend/Modules/ContentBlocks/Layout/Templates', $include);
				$return = @include $this->getCompileDirectory() .'/' . $this->getCompileName($include, '/home/anastosi/domains/anastosi.ru/public_html/src/Backend/Modules/ContentBlocks/Layout/Templates');
				if($return === false && $this->compile('/home/anastosi/domains/anastosi.ru/public_html/src/Backend/Modules/ContentBlocks/Layout/Templates', $include))
				{
					$return = @include $this->getCompileDirectory() .'/' . $this->getCompileName($include, '/home/anastosi/domains/anastosi.ru/public_html/src/Backend/Modules/ContentBlocks/Layout/Templates');
				}
?>
<?php
				ob_start();
				?><?php echo $this->variables['BACKEND_CORE_PATH']; ?>/Layout/Templates/StructureStartModule.tpl<?php
				$include = eval('return \'' . str_replace('\'', '\\\'', ob_get_clean()) .'\';');
				if($this->getForceCompile() || !file_exists($this->getCompileDirectory() .'/' . $this->getCompileName($include, '/home/anastosi/domains/anastosi.ru/public_html/src/Backend/Modules/ContentBlocks/Layout/Templates'))) $this->compile('/home/anastosi/domains/anastosi.ru/public_html/src/Backend/Modules/ContentBlocks/Layout/Templates', $include);
				$return = @include $this->getCompileDirectory() .'/' . $this->getCompileName($include, '/home/anastosi/domains/anastosi.ru/public_html/src/Backend/Modules/ContentBlocks/Layout/Templates');
				if($return === false && $this->compile('/home/anastosi/domains/anastosi.ru/public_html/src/Backend/Modules/ContentBlocks/Layout/Templates', $include))
				{
					$return = @include $this->getCompileDirectory() .'/' . $this->getCompileName($include, '/home/anastosi/domains/anastosi.ru/public_html/src/Backend/Modules/ContentBlocks/Layout/Templates');
				}
?>

<div class="pageTitle">
	<h2><?php echo SpoonFilter::ucfirst($this->variables['lblContentBlocks']); ?>: <?php echo sprintf($this->variables['msgEditContentBlock'], $this->variables['title']); ?></h2>
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
			<li><a href="#tabContent"><?php echo SpoonFilter::ucfirst($this->variables['lblContent']); ?></a></li>
			<li><a href="#tabVersions"><?php echo SpoonFilter::ucfirst($this->variables['lblVersions']); ?></a></li>
		</ul>

		<div id="tabContent">
			<fieldset>
				<p>
					<label for="title"><?php echo SpoonFilter::ucfirst($this->variables['lblTitle']); ?><abbr title="<?php echo $this->variables['lblRequiredField']; ?>">*</abbr></label>
					<?php echo $this->variables['txtTitle']; ?> <?php echo $this->variables['txtTitleError']; ?>
				</p>

				<div class="box">
					<div class="heading">
						<h3>
							<label for="text"><?php echo SpoonFilter::ucfirst($this->variables['lblContent']); ?><abbr title="<?php echo $this->variables['lblRequiredField']; ?>">*</abbr></label>
						</h3>
					</div>
					<div class="optionsRTE">
						<?php echo $this->variables['txtText']; ?> <?php echo $this->variables['txtTextError']; ?>
					</div>
				</div>
				<?php
					if(isset($this->variables['ddmTemplate']) && count($this->variables['ddmTemplate']) != 0 && $this->variables['ddmTemplate'] != '' && $this->variables['ddmTemplate'] !== false)
					{
						?><p><?php echo SpoonFilter::ucfirst($this->variables['lblTemplate']); ?> <label for="template"><?php echo $this->variables['ddmTemplate']; ?> <?php echo $this->variables['ddmTemplateError']; ?></label></p><?php } ?>
				<p><label for="hidden"><?php echo $this->variables['chkHidden']; ?> <?php echo $this->variables['chkHiddenError']; ?> <?php echo SpoonFilter::ucfirst($this->variables['lblVisibleOnSite']); ?></label></p>
			</fieldset>
		</div>

		<div id="tabVersions">
			<div class="tableHeading">
				<div class="oneLiner">
					<h3 class="oneLinerElement"><?php echo SpoonFilter::ucfirst($this->variables['lblPreviousVersions']); ?></h3>
					<abbr class="help">(?)</abbr>
					<div class="tooltip" style="display: none;">
						<p><?php echo $this->variables['msgHelpRevisions']; ?></p>
					</div>
				</div>
			</div>

			<?php
					if(isset($this->variables['revisions']) && count($this->variables['revisions']) != 0 && $this->variables['revisions'] != '' && $this->variables['revisions'] !== false)
					{
						?>
			<div class="dataGridHolder">
				<?php echo $this->variables['revisions']; ?>
			</div>
			<?php } ?>

			<?php if(!isset($this->variables['revisions']) || count($this->variables['revisions']) == 0 || $this->variables['revisions'] == '' || $this->variables['revisions'] === false): ?>
				<p><?php echo $this->variables['msgNoRevisions']; ?></p>
			<?php endif; ?>
		</div>
	</div>

	<div class="fullwidthOptions">
		<?php
					if(isset($this->variables['showContentBlocksDelete']) && count($this->variables['showContentBlocksDelete']) != 0 && $this->variables['showContentBlocksDelete'] != '' && $this->variables['showContentBlocksDelete'] !== false)
					{
						?>
		<a href="<?php echo Backend\Core\Engine\TemplateModifiers::getURL($this->variables['var'], 'delete'); ?>&amp;id=<?php echo $this->variables['id']; ?>" data-message-id="confirmDelete" class="askConfirmation button linkButton icon iconDelete">
			<span><?php echo SpoonFilter::ucfirst($this->variables['lblDelete']); ?></span>
		</a>
		<?php } ?>

		<div class="buttonHolderRight">
			<input id="editButton" class="inputButton button mainButton" type="submit" name="edit" value="<?php echo SpoonFilter::ucfirst($this->variables['lblSave']); ?>" />
		</div>
	</div>

	<div id="confirmDelete" title="<?php echo SpoonFilter::ucfirst($this->variables['lblDelete']); ?>?" style="display: none;">
		<p>
			<?php echo sprintf($this->variables['msgConfirmDelete'], $this->variables['title']); ?>
		</p>
	</div>
</form>
				<?php } ?>

<?php
				ob_start();
				?><?php echo $this->variables['BACKEND_CORE_PATH']; ?>/Layout/Templates/StructureEndModule.tpl<?php
				$include = eval('return \'' . str_replace('\'', '\\\'', ob_get_clean()) .'\';');
				if($this->getForceCompile() || !file_exists($this->getCompileDirectory() .'/' . $this->getCompileName($include, '/home/anastosi/domains/anastosi.ru/public_html/src/Backend/Modules/ContentBlocks/Layout/Templates'))) $this->compile('/home/anastosi/domains/anastosi.ru/public_html/src/Backend/Modules/ContentBlocks/Layout/Templates', $include);
				$return = @include $this->getCompileDirectory() .'/' . $this->getCompileName($include, '/home/anastosi/domains/anastosi.ru/public_html/src/Backend/Modules/ContentBlocks/Layout/Templates');
				if($return === false && $this->compile('/home/anastosi/domains/anastosi.ru/public_html/src/Backend/Modules/ContentBlocks/Layout/Templates', $include))
				{
					$return = @include $this->getCompileDirectory() .'/' . $this->getCompileName($include, '/home/anastosi/domains/anastosi.ru/public_html/src/Backend/Modules/ContentBlocks/Layout/Templates');
				}
?>
<?php
				ob_start();
				?><?php echo $this->variables['BACKEND_CORE_PATH']; ?>/Layout/Templates/Footer.tpl<?php
				$include = eval('return \'' . str_replace('\'', '\\\'', ob_get_clean()) .'\';');
				if($this->getForceCompile() || !file_exists($this->getCompileDirectory() .'/' . $this->getCompileName($include, '/home/anastosi/domains/anastosi.ru/public_html/src/Backend/Modules/ContentBlocks/Layout/Templates'))) $this->compile('/home/anastosi/domains/anastosi.ru/public_html/src/Backend/Modules/ContentBlocks/Layout/Templates', $include);
				$return = @include $this->getCompileDirectory() .'/' . $this->getCompileName($include, '/home/anastosi/domains/anastosi.ru/public_html/src/Backend/Modules/ContentBlocks/Layout/Templates');
				if($return === false && $this->compile('/home/anastosi/domains/anastosi.ru/public_html/src/Backend/Modules/ContentBlocks/Layout/Templates', $include))
				{
					$return = @include $this->getCompileDirectory() .'/' . $this->getCompileName($include, '/home/anastosi/domains/anastosi.ru/public_html/src/Backend/Modules/ContentBlocks/Layout/Templates');
				}
?>
