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

<?php
					if(isset($this->forms['edit']))
					{
						?><form accept-charset="UTF-8" action="<?php echo $this->forms['edit']->getAction(); ?>" method="<?php echo $this->forms['edit']->getMethod(); ?>"<?php echo $this->forms['edit']->getParametersHTML(); ?>>
						<?php echo $this->forms['edit']->getField('form')->parse();
						if($this->forms['edit']->getUseToken())
						{
							?><input type="hidden" name="form_token" id="<?php echo $this->forms['edit']->getField('form_token')->getAttribute('id'); ?>" value="<?php echo htmlspecialchars($this->forms['edit']->getField('form_token')->getValue()); ?>" />
						<?php } ?>
	<?php echo $this->variables['hidTemplateId']; ?>

	<div class="pageTitle">
		<h2><?php echo SpoonFilter::ucfirst($this->variables['lblPages']); ?>: <?php echo $this->variables['lblEdit']; ?></h2>
		<div class="buttonHolderRight">
			<?php
					if(isset($this->variables['showPagesAdd']) && count($this->variables['showPagesAdd']) != 0 && $this->variables['showPagesAdd'] != '' && $this->variables['showPagesAdd'] !== false)
					{
						?>
			<a href="<?php echo Backend\Core\Engine\TemplateModifiers::getURL($this->variables['var'], 'add'); ?>" class="button icon iconAdd">
				<span><?php echo SpoonFilter::ucfirst($this->variables['lblAdd']); ?></span>
			</a>
			<?php } ?>

			<?php if(!isset($this->variables['item']['is_hidden']) || count($this->variables['item']['is_hidden']) == 0 || $this->variables['item']['is_hidden'] == '' || $this->variables['item']['is_hidden'] === false): ?>
				<a href="<?php echo $this->variables['SITE_URL']; ?><?php echo $this->variables['item']['full_url']; ?><?php
					if(isset($this->variables['appendRevision']) && count($this->variables['appendRevision']) != 0 && $this->variables['appendRevision'] != '' && $this->variables['appendRevision'] !== false)
					{
						?>?page_revision=<?php echo $this->variables['item']['revision_id']; ?><?php } ?>" class="button icon iconZoom previewButton targetBlank">
					<span><?php echo SpoonFilter::ucfirst($this->variables['lblView']); ?></span>
				</a>
			<?php endif; ?>

			<?php
					if(isset($this->variables['showPagesIndex']) && count($this->variables['showPagesIndex']) != 0 && $this->variables['showPagesIndex'] != '' && $this->variables['showPagesIndex'] !== false)
					{
						?>
			<a href="<?php echo Backend\Core\Engine\TemplateModifiers::getURL($this->variables['var'], 'index'); ?>" class="button icon iconBack">
				<span><?php echo SpoonFilter::ucfirst($this->variables['lblOverview']); ?></span>
			</a>
			<?php } ?>
		</div>
	</div>

	<p id="pagesPageTitle">
		<label for="title"><?php echo SpoonFilter::ucfirst($this->variables['lblTitle']); ?></label>
		<?php echo $this->variables['txtTitle']; ?> <?php echo $this->variables['txtTitleError']; ?>
		<span class="oneLiner">
			<span><a href="<?php echo $this->variables['SITE_URL']; ?><?php echo $this->variables['prefixURL']; ?>/<?php echo $this->variables['item']['url']; ?><?php
					if(isset($this->variables['appendRevision']) && count($this->variables['appendRevision']) != 0 && $this->variables['appendRevision'] != '' && $this->variables['appendRevision'] !== false)
					{
						?>?page_revision=<?php echo $this->variables['item']['revision_id']; ?><?php } ?>"><?php echo $this->variables['SITE_URL']; ?><?php echo $this->variables['prefixURL']; ?>/<span id="generatedUrl"><?php echo $this->variables['item']['url']; ?></span></a></span>
		</span>
	</p>

	<div id="tabs" class="tabs">
		<ul>
			<li style="float: left;"><a href="#tabContent"><?php echo SpoonFilter::ucfirst($this->variables['lblContent']); ?></a></li>
			<!-- Reverse order after content tab [floatRight] -->
			<li><a href="#tabSettings"><?php echo SpoonFilter::ucfirst($this->variables['lblSettings']); ?></a></li>
			<li><a href="#tabRedirect"><?php echo SpoonFilter::ucfirst($this->variables['lblRedirect']); ?></a></li>
			<li><a href="#tabTags"><?php echo SpoonFilter::ucfirst($this->variables['lblTags']); ?></a></li>
			<li><a href="#tabSEO"><?php echo SpoonFilter::ucfirst($this->variables['lblSEO']); ?></a></li>
			<li><a href="#tabVersions"><?php echo SpoonFilter::ucfirst($this->variables['lblVersions']); ?></a></li>
		</ul>

		<div id="tabContent">
			<div id="editTemplate">
				<div class="pageTitle">
					
					<h2><?php echo SpoonFilter::ucfirst($this->variables['lblTemplate']); ?>: <span id="tabTemplateLabel">&nbsp;</span></h2>
					<div class="buttonHolderRight">
						<a id="changeTemplate" href="#" class="button icon iconEdit">
							<span><?php echo SpoonFilter::ucfirst($this->variables['lblChangeTemplate']); ?></span>
						</a>
					</div>
				</div>

				<?php
					if(isset($this->variables['formErrors']) && count($this->variables['formErrors']) != 0 && $this->variables['formErrors'] != '' && $this->variables['formErrors'] !== false)
					{
						?><span class="formError"><?php echo $this->variables['formErrors']; ?></span><?php } ?>

				<div id="templateVisualFallback" style="display: none">
					<div id="fallback" class="generalMessage singleMessage infoMessage">
						<div id="fallbackInfo">
							<?php echo $this->variables['msgFallbackInfo']; ?>
						</div>

						<table cellspacing="10">
							<tbody>
								<tr>
									<td data-position="fallback" id="templatePosition-fallback" colspan="1" class="box">
										<div class="heading linkedBlocksTitle"><h3><?php echo SpoonFilter::ucfirst($this->variables['lblFallback']); ?></h3></div>
										<div class="linkedBlocks"><!-- linked blocks will be added here --></div>
									</td>
								</tr>
							</tbody>
						</table>
					</div>
				</div>

				<div id="templateVisualLarge">
					&nbsp;
				</div>
			</div>

			
			<div id="editContent">
				<?php
				if(isset(${'positions'})) $this->iterations['9d34787c73daea397d24566d2cd20890_Edit.tpl.php_1']['old'] = ${'positions'};
				$this->iterations['9d34787c73daea397d24566d2cd20890_Edit.tpl.php_1']['iteration'] = $this->variables['positions'];
				$this->iterations['9d34787c73daea397d24566d2cd20890_Edit.tpl.php_1']['i'] = 1;
				$this->iterations['9d34787c73daea397d24566d2cd20890_Edit.tpl.php_1']['count'] = count($this->iterations['9d34787c73daea397d24566d2cd20890_Edit.tpl.php_1']['iteration']);
				foreach((array) $this->iterations['9d34787c73daea397d24566d2cd20890_Edit.tpl.php_1']['iteration'] as ${'positions'})
				{
					if(!isset(${'positions'}['first']) && $this->iterations['9d34787c73daea397d24566d2cd20890_Edit.tpl.php_1']['i'] == 1) ${'positions'}['first'] = true;
					if(!isset(${'positions'}['last']) && $this->iterations['9d34787c73daea397d24566d2cd20890_Edit.tpl.php_1']['i'] == $this->iterations['9d34787c73daea397d24566d2cd20890_Edit.tpl.php_1']['count']) ${'positions'}['last'] = true;
					if(isset(${'positions'}['formElements']) && is_array(${'positions'}['formElements']))
					{
						foreach(${'positions'}['formElements'] as $name => $object)
						{
							${'positions'}[$name] = $object->parse();
							${'positions'}[$name .'Error'] = (is_callable(array($object, 'getErrors')) && $object->getErrors() != '') ? '<span class="formError">' . $object->getErrors() .'</span>' : '';
						}
					} ?>
					<?php
				if(isset(${'positions'}['blocks'])) $this->iterations['9d34787c73daea397d24566d2cd20890_Edit.tpl.php_8']['blocks']['old'] = ${'positions'}['blocks'];
				$this->iterations['9d34787c73daea397d24566d2cd20890_Edit.tpl.php_8']['blocks']['iteration'] = ${'positions'}['blocks'];
				$this->iterations['9d34787c73daea397d24566d2cd20890_Edit.tpl.php_8']['blocks']['i'] = 1;
				$this->iterations['9d34787c73daea397d24566d2cd20890_Edit.tpl.php_8']['blocks']['count'] = count($this->iterations['9d34787c73daea397d24566d2cd20890_Edit.tpl.php_8']['blocks']['iteration']);
				foreach((array) $this->iterations['9d34787c73daea397d24566d2cd20890_Edit.tpl.php_8']['blocks']['iteration'] as ${'positions'}['blocks'])
				{
					if(!isset(${'positions'}['blocks']['first']) && $this->iterations['9d34787c73daea397d24566d2cd20890_Edit.tpl.php_8']['blocks']['i'] == 1) ${'positions'}['blocks']['first'] = true;
					if(!isset(${'positions'}['blocks']['last']) && $this->iterations['9d34787c73daea397d24566d2cd20890_Edit.tpl.php_8']['blocks']['i'] == $this->iterations['9d34787c73daea397d24566d2cd20890_Edit.tpl.php_8']['blocks']['count']) ${'positions'}['blocks']['last'] = true;
					if(isset(${'positions'}['blocks']['formElements']) && is_array(${'positions'}['blocks']['formElements']))
					{
						foreach(${'positions'}['blocks']['formElements'] as $name => $object)
						{
							${'positions'}['blocks'][$name] = $object->parse();
							${'positions'}['blocks'][$name .'Error'] = (is_callable(array($object, 'getErrors')) && $object->getErrors() != '') ? '<span class="formError">' . $object->getErrors() .'</span>' : '';
						}
					} ?>
						<div class="box contentBlock" style="margin: 0;">
							<div class="blockContentHTML optionsRTE">
								<fieldset>
									<div class="generalMessage singleMessage infoMessage">
										<?php echo $this->variables['msgContentSaveWarning']; ?>
									</div>
									<div class="heading">
										<h3><?php echo SpoonFilter::ucfirst($this->variables['lblEditor']); ?></h3>
									</div>
									<?php echo ${'positions'}['blocks']['txtHTML']; ?>
									<?php echo ${'positions'}['blocks']['txtHTMLError']; ?>
								</fieldset>
							</div>

							
							<?php echo ${'positions'}['blocks']['hidExtraId']; ?>

							
							<?php echo ${'positions'}['blocks']['hidPosition']; ?>

							
							<div style="display: none"><?php echo ${'positions'}['blocks']['chkVisible']; ?></div>
						</div>
					<?php
					$this->iterations['9d34787c73daea397d24566d2cd20890_Edit.tpl.php_8']['blocks']['i']++;
				}
				if(isset($this->iterations['9d34787c73daea397d24566d2cd20890_Edit.tpl.php_8']['blocks']['old'])) ${'positions'}['blocks'] = $this->iterations['9d34787c73daea397d24566d2cd20890_Edit.tpl.php_8']['blocks']['old'];
				else unset($this->iterations['9d34787c73daea397d24566d2cd20890_Edit.tpl.php_8']['blocks']);
				?>
				<?php
					$this->iterations['9d34787c73daea397d24566d2cd20890_Edit.tpl.php_1']['i']++;
				}
				if(isset($this->iterations['9d34787c73daea397d24566d2cd20890_Edit.tpl.php_1']['old'])) ${'positions'} = $this->iterations['9d34787c73daea397d24566d2cd20890_Edit.tpl.php_1']['old'];
				else unset($this->iterations['9d34787c73daea397d24566d2cd20890_Edit.tpl.php_1']);
				?>
			</div>
		</div>

		<div id="tabRedirect">
			<div class="subtleBox">
				<div class="options">
					<?php echo $this->variables['rbtRedirectError']; ?>
					<ul class="inputList radiobuttonFieldCombo">
						<?php
				if(isset(${'redirect'})) $this->iterations['9d34787c73daea397d24566d2cd20890_Edit.tpl.php_2']['old'] = ${'redirect'};
				$this->iterations['9d34787c73daea397d24566d2cd20890_Edit.tpl.php_2']['iteration'] = $this->variables['redirect'];
				$this->iterations['9d34787c73daea397d24566d2cd20890_Edit.tpl.php_2']['i'] = 1;
				$this->iterations['9d34787c73daea397d24566d2cd20890_Edit.tpl.php_2']['count'] = count($this->iterations['9d34787c73daea397d24566d2cd20890_Edit.tpl.php_2']['iteration']);
				foreach((array) $this->iterations['9d34787c73daea397d24566d2cd20890_Edit.tpl.php_2']['iteration'] as ${'redirect'})
				{
					if(!isset(${'redirect'}['first']) && $this->iterations['9d34787c73daea397d24566d2cd20890_Edit.tpl.php_2']['i'] == 1) ${'redirect'}['first'] = true;
					if(!isset(${'redirect'}['last']) && $this->iterations['9d34787c73daea397d24566d2cd20890_Edit.tpl.php_2']['i'] == $this->iterations['9d34787c73daea397d24566d2cd20890_Edit.tpl.php_2']['count']) ${'redirect'}['last'] = true;
					if(isset(${'redirect'}['formElements']) && is_array(${'redirect'}['formElements']))
					{
						foreach(${'redirect'}['formElements'] as $name => $object)
						{
							${'redirect'}[$name] = $object->parse();
							${'redirect'}[$name .'Error'] = (is_callable(array($object, 'getErrors')) && $object->getErrors() != '') ? '<span class="formError">' . $object->getErrors() .'</span>' : '';
						}
					} ?>
							<li>
								<label for="<?php echo ${'redirect'}['id']; ?>"><?php echo ${'redirect'}['rbtRedirect']; ?> <?php echo ${'redirect'}['label']; ?></label>
								<?php
					if(isset(${'redirect'}['isInternal']) && count(${'redirect'}['isInternal']) != 0 && ${'redirect'}['isInternal'] != '' && ${'redirect'}['isInternal'] !== false)
					{
						?>
										<label for="internalRedirect" class="visuallyHidden"><?php echo ${'redirect'}['label']; ?></label>
										<?php echo $this->variables['ddmInternalRedirect']; ?> <?php echo $this->variables['ddmInternalRedirectError']; ?>
										<span class="helpTxt"><?php echo $this->variables['msgHelpInternalRedirect']; ?></span>
								<?php } ?>

								<?php
					if(isset(${'redirect'}['isExternal']) && count(${'redirect'}['isExternal']) != 0 && ${'redirect'}['isExternal'] != '' && ${'redirect'}['isExternal'] !== false)
					{
						?>
										<label for="externalRedirect" class="visuallyHidden"><?php echo ${'redirect'}['label']; ?></label>
										<?php echo $this->variables['txtExternalRedirect']; ?> <?php echo $this->variables['txtExternalRedirectError']; ?>
										<span class="helpTxt"><?php echo $this->variables['msgHelpExternalRedirect']; ?></span>
								<?php } ?>
							</li>
						<?php
					$this->iterations['9d34787c73daea397d24566d2cd20890_Edit.tpl.php_2']['i']++;
				}
				if(isset($this->iterations['9d34787c73daea397d24566d2cd20890_Edit.tpl.php_2']['old'])) ${'redirect'} = $this->iterations['9d34787c73daea397d24566d2cd20890_Edit.tpl.php_2']['old'];
				else unset($this->iterations['9d34787c73daea397d24566d2cd20890_Edit.tpl.php_2']);
				?>
					</ul>
				</div>
			</div>
		</div>

		<div id="tabVersions">
			<?php
					if(isset($this->variables['drafts']) && count($this->variables['drafts']) != 0 && $this->variables['drafts'] != '' && $this->variables['drafts'] !== false)
					{
						?>
				<div class="tableHeading">
					<div class="oneLiner">
						<h3 class="oneLinerElement"><?php echo SpoonFilter::ucfirst($this->variables['lblDrafts']); ?></h3>
						<abbr class="help">(?)</abbr>
						<div class="tooltip" style="display: none;">
							<p><?php echo $this->variables['msgHelpDrafts']; ?></p>
						</div>
					</div>
				</div>

				<div class="dataGridHolder">
					<?php echo $this->variables['drafts']; ?>
				</div>
			<?php } ?>

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

		<div id="tabSEO">
			<div class="subtleBox">
				<div class="heading">
					<h3><?php echo SpoonFilter::ucfirst($this->variables['lblTitles']); ?></h3>
				</div>
				<div class="options">
					<p>
						<label for="pageTitleOverwrite"><?php echo SpoonFilter::ucfirst($this->variables['lblPageTitle']); ?></label>
						<span class="helpTxt"><?php echo $this->variables['msgHelpPageTitle']; ?></span>
					</p>
					<ul class="inputList checkboxTextFieldCombo">
						<li>
							<?php echo $this->variables['chkPageTitleOverwrite']; ?>
							<label for="pageTitle" class="visuallyHidden"><?php echo SpoonFilter::ucfirst($this->variables['lblPageTitle']); ?></label>
							<?php echo $this->variables['txtPageTitle']; ?> <?php echo $this->variables['txtPageTitleError']; ?>
						</li>
					</ul>
					<p>
						<label for="navigationTitleOverwrite"><?php echo SpoonFilter::ucfirst($this->variables['lblNavigationTitle']); ?></label>
						<span class="helpTxt"><?php echo $this->variables['msgHelpNavigationTitle']; ?></span>
					</p>
					<ul class="inputList checkboxTextFieldCombo">
						<li>
							<?php echo $this->variables['chkNavigationTitleOverwrite']; ?>
							<label for="navigationTitle" class="visuallyHidden"><?php echo SpoonFilter::ucfirst($this->variables['lblNavigationTitle']); ?></label>
							<?php echo $this->variables['txtNavigationTitle']; ?> <?php echo $this->variables['txtNavigationTitleError']; ?>
						</li>
					</ul>
				</div>
			</div>

			<div id="seoMeta" class="subtleBox">
				<div class="heading">
					<h3><?php echo SpoonFilter::ucfirst($this->variables['lblMetaInformation']); ?></h3>
				</div>
				<div class="options">
					<p>
						<label for="metaDescriptionOverwrite"><?php echo SpoonFilter::ucfirst($this->variables['lblDescription']); ?></label>
						<span class="helpTxt"><?php echo $this->variables['msgHelpMetaDescription']; ?></span>
					</p>
					<ul class="inputList checkboxTextFieldCombo">
						<li>
							<?php echo $this->variables['chkMetaDescriptionOverwrite']; ?>
							<label for="metaDescription" class="visuallyHidden"><?php echo SpoonFilter::ucfirst($this->variables['lblDescription']); ?></label>
							<?php echo $this->variables['txtMetaDescription']; ?> <?php echo $this->variables['txtMetaDescriptionError']; ?>
						</li>
					</ul>
					<p>
						<label for="metaKeywordsOverwrite"><?php echo SpoonFilter::ucfirst($this->variables['lblKeywords']); ?></label>
						<span class="helpTxt"><?php echo $this->variables['msgHelpMetaKeywords']; ?></span>
					</p>
					<ul class="inputList checkboxTextFieldCombo">
						<li>
							<?php echo $this->variables['chkMetaKeywordsOverwrite']; ?>
							<label for="metaKeywords" class="visuallyHidden"><?php echo SpoonFilter::ucfirst($this->variables['lblKeywords']); ?></label>
							<?php echo $this->variables['txtMetaKeywords']; ?> <?php echo $this->variables['txtMetaKeywordsError']; ?>
						</li>
					</ul>
					<div class="textareaHolder">
						<p>
							<label for="metaCustom"><?php echo SpoonFilter::ucfirst($this->variables['lblExtraMetaTags']); ?></label>
							<span class="helpTxt"><?php echo $this->variables['msgHelpMetaCustom']; ?></span>
						</p>
						<?php echo $this->variables['txtMetaCustom']; ?> <?php echo $this->variables['txtMetaCustomError']; ?>
					</div>
				</div>
			</div>

			<div class="subtleBox">
				<div class="heading">
					<h3><?php echo $this->variables['lblURL']; ?></h3>
				</div>
				<div class="options">
					<p>
						<label for="urlOverwrite"><?php echo SpoonFilter::ucfirst($this->variables['lblCustomURL']); ?></label>
						<span class="helpTxt"><?php echo $this->variables['msgHelpMetaURL']; ?></span>
					</p>
					<ul class="inputList checkboxTextFieldCombo">
						<li>
							<?php echo $this->variables['chkUrlOverwrite']; ?>
							<label for="url" class="visuallyHidden"><?php echo SpoonFilter::ucfirst($this->variables['lblCustomURL']); ?></label>
							<span id="urlFirstPart"><?php echo $this->variables['SITE_URL']; ?><?php echo $this->variables['prefixURL']; ?>/</span><?php echo $this->variables['txtUrl']; ?> <?php echo $this->variables['txtUrlError']; ?>
						</li>
					</ul>
				</div>
			</div>

			<div class="subtleBox">
				<div class="heading">
					<h3><?php echo SpoonTemplateModifiers::uppercase($this->variables['lblSEO']); ?></h3>
				</div>
				<div class="options">
					<p class="label"><?php echo $this->variables['lblIndex']; ?></p>
					<?php echo $this->variables['rbtSeoIndexError']; ?>
					<ul class="inputList inputListHorizontal">
						<?php
				if(isset(${'seo_index'})) $this->iterations['9d34787c73daea397d24566d2cd20890_Edit.tpl.php_3']['old'] = ${'seo_index'};
				$this->iterations['9d34787c73daea397d24566d2cd20890_Edit.tpl.php_3']['iteration'] = $this->variables['seo_index'];
				$this->iterations['9d34787c73daea397d24566d2cd20890_Edit.tpl.php_3']['i'] = 1;
				$this->iterations['9d34787c73daea397d24566d2cd20890_Edit.tpl.php_3']['count'] = count($this->iterations['9d34787c73daea397d24566d2cd20890_Edit.tpl.php_3']['iteration']);
				foreach((array) $this->iterations['9d34787c73daea397d24566d2cd20890_Edit.tpl.php_3']['iteration'] as ${'seo_index'})
				{
					if(!isset(${'seo_index'}['first']) && $this->iterations['9d34787c73daea397d24566d2cd20890_Edit.tpl.php_3']['i'] == 1) ${'seo_index'}['first'] = true;
					if(!isset(${'seo_index'}['last']) && $this->iterations['9d34787c73daea397d24566d2cd20890_Edit.tpl.php_3']['i'] == $this->iterations['9d34787c73daea397d24566d2cd20890_Edit.tpl.php_3']['count']) ${'seo_index'}['last'] = true;
					if(isset(${'seo_index'}['formElements']) && is_array(${'seo_index'}['formElements']))
					{
						foreach(${'seo_index'}['formElements'] as $name => $object)
						{
							${'seo_index'}[$name] = $object->parse();
							${'seo_index'}[$name .'Error'] = (is_callable(array($object, 'getErrors')) && $object->getErrors() != '') ? '<span class="formError">' . $object->getErrors() .'</span>' : '';
						}
					} ?>
							<li><label for="<?php echo ${'seo_index'}['id']; ?>"><?php echo ${'seo_index'}['rbtSeoIndex']; ?> <?php echo ${'seo_index'}['label']; ?></label></li>
						<?php
					$this->iterations['9d34787c73daea397d24566d2cd20890_Edit.tpl.php_3']['i']++;
				}
				if(isset($this->iterations['9d34787c73daea397d24566d2cd20890_Edit.tpl.php_3']['old'])) ${'seo_index'} = $this->iterations['9d34787c73daea397d24566d2cd20890_Edit.tpl.php_3']['old'];
				else unset($this->iterations['9d34787c73daea397d24566d2cd20890_Edit.tpl.php_3']);
				?>
					</ul>
					<p class="label"><?php echo $this->variables['lblFollow']; ?></p>
					<?php echo $this->variables['rbtSeoFollowError']; ?>
					<ul class="inputList inputListHorizontal">
						<?php
				if(isset(${'seo_follow'})) $this->iterations['9d34787c73daea397d24566d2cd20890_Edit.tpl.php_4']['old'] = ${'seo_follow'};
				$this->iterations['9d34787c73daea397d24566d2cd20890_Edit.tpl.php_4']['iteration'] = $this->variables['seo_follow'];
				$this->iterations['9d34787c73daea397d24566d2cd20890_Edit.tpl.php_4']['i'] = 1;
				$this->iterations['9d34787c73daea397d24566d2cd20890_Edit.tpl.php_4']['count'] = count($this->iterations['9d34787c73daea397d24566d2cd20890_Edit.tpl.php_4']['iteration']);
				foreach((array) $this->iterations['9d34787c73daea397d24566d2cd20890_Edit.tpl.php_4']['iteration'] as ${'seo_follow'})
				{
					if(!isset(${'seo_follow'}['first']) && $this->iterations['9d34787c73daea397d24566d2cd20890_Edit.tpl.php_4']['i'] == 1) ${'seo_follow'}['first'] = true;
					if(!isset(${'seo_follow'}['last']) && $this->iterations['9d34787c73daea397d24566d2cd20890_Edit.tpl.php_4']['i'] == $this->iterations['9d34787c73daea397d24566d2cd20890_Edit.tpl.php_4']['count']) ${'seo_follow'}['last'] = true;
					if(isset(${'seo_follow'}['formElements']) && is_array(${'seo_follow'}['formElements']))
					{
						foreach(${'seo_follow'}['formElements'] as $name => $object)
						{
							${'seo_follow'}[$name] = $object->parse();
							${'seo_follow'}[$name .'Error'] = (is_callable(array($object, 'getErrors')) && $object->getErrors() != '') ? '<span class="formError">' . $object->getErrors() .'</span>' : '';
						}
					} ?>
							<li><label for="<?php echo ${'seo_follow'}['id']; ?>"><?php echo ${'seo_follow'}['rbtSeoFollow']; ?> <?php echo ${'seo_follow'}['label']; ?></label></li>
						<?php
					$this->iterations['9d34787c73daea397d24566d2cd20890_Edit.tpl.php_4']['i']++;
				}
				if(isset($this->iterations['9d34787c73daea397d24566d2cd20890_Edit.tpl.php_4']['old'])) ${'seo_follow'} = $this->iterations['9d34787c73daea397d24566d2cd20890_Edit.tpl.php_4']['old'];
				else unset($this->iterations['9d34787c73daea397d24566d2cd20890_Edit.tpl.php_4']);
				?>
					</ul>
				</div>
			</div>

			
			<?php echo $this->variables['hidMetaId']; ?>
			<?php echo $this->variables['hidBaseFieldName']; ?>
			<?php echo $this->variables['hidCustom']; ?>
			<?php echo $this->variables['hidClassName']; ?>
			<?php echo $this->variables['hidMethodName']; ?>
			<?php echo $this->variables['hidParameters']; ?>
		</div>

		<div id="tabTags">
			<div class="subtleBox">
				<div class="heading">
					<h3>
						<label for="addValue-tags"><?php echo SpoonFilter::ucfirst($this->variables['lblTags']); ?></label>
					</h3>
				</div>
				<div class="options">
					<?php echo $this->variables['txtTags']; ?> <?php echo $this->variables['txtTagsError']; ?>
				</div>
			</div>
		</div>

		<div id="tabSettings">
			<ul class="inputList">
				<?php
				if(isset(${'hidden'})) $this->iterations['9d34787c73daea397d24566d2cd20890_Edit.tpl.php_5']['old'] = ${'hidden'};
				$this->iterations['9d34787c73daea397d24566d2cd20890_Edit.tpl.php_5']['iteration'] = $this->variables['hidden'];
				$this->iterations['9d34787c73daea397d24566d2cd20890_Edit.tpl.php_5']['i'] = 1;
				$this->iterations['9d34787c73daea397d24566d2cd20890_Edit.tpl.php_5']['count'] = count($this->iterations['9d34787c73daea397d24566d2cd20890_Edit.tpl.php_5']['iteration']);
				foreach((array) $this->iterations['9d34787c73daea397d24566d2cd20890_Edit.tpl.php_5']['iteration'] as ${'hidden'})
				{
					if(!isset(${'hidden'}['first']) && $this->iterations['9d34787c73daea397d24566d2cd20890_Edit.tpl.php_5']['i'] == 1) ${'hidden'}['first'] = true;
					if(!isset(${'hidden'}['last']) && $this->iterations['9d34787c73daea397d24566d2cd20890_Edit.tpl.php_5']['i'] == $this->iterations['9d34787c73daea397d24566d2cd20890_Edit.tpl.php_5']['count']) ${'hidden'}['last'] = true;
					if(isset(${'hidden'}['formElements']) && is_array(${'hidden'}['formElements']))
					{
						foreach(${'hidden'}['formElements'] as $name => $object)
						{
							${'hidden'}[$name] = $object->parse();
							${'hidden'}[$name .'Error'] = (is_callable(array($object, 'getErrors')) && $object->getErrors() != '') ? '<span class="formError">' . $object->getErrors() .'</span>' : '';
						}
					} ?>
					<li><?php echo ${'hidden'}['rbtHidden']; ?> <label for="<?php echo ${'hidden'}['id']; ?>"><?php echo SpoonFilter::ucfirst(${'hidden'}['label']); ?></label></li>
				<?php
					$this->iterations['9d34787c73daea397d24566d2cd20890_Edit.tpl.php_5']['i']++;
				}
				if(isset($this->iterations['9d34787c73daea397d24566d2cd20890_Edit.tpl.php_5']['old'])) ${'hidden'} = $this->iterations['9d34787c73daea397d24566d2cd20890_Edit.tpl.php_5']['old'];
				else unset($this->iterations['9d34787c73daea397d24566d2cd20890_Edit.tpl.php_5']);
				?>
			</ul>
			<p>
				<label for="isAction"><?php echo $this->variables['chkIsAction']; ?> <?php echo $this->variables['msgIsAction']; ?></label>
			</p>
			<?php
					if(isset($this->variables['isGod']) && count($this->variables['isGod']) != 0 && $this->variables['isGod'] != '' && $this->variables['isGod'] !== false)
					{
						?>
				<ul class="inputList">
					<?php
				if(isset(${'allow'})) $this->iterations['9d34787c73daea397d24566d2cd20890_Edit.tpl.php_6']['old'] = ${'allow'};
				$this->iterations['9d34787c73daea397d24566d2cd20890_Edit.tpl.php_6']['iteration'] = $this->variables['allow'];
				$this->iterations['9d34787c73daea397d24566d2cd20890_Edit.tpl.php_6']['i'] = 1;
				$this->iterations['9d34787c73daea397d24566d2cd20890_Edit.tpl.php_6']['count'] = count($this->iterations['9d34787c73daea397d24566d2cd20890_Edit.tpl.php_6']['iteration']);
				foreach((array) $this->iterations['9d34787c73daea397d24566d2cd20890_Edit.tpl.php_6']['iteration'] as ${'allow'})
				{
					if(!isset(${'allow'}['first']) && $this->iterations['9d34787c73daea397d24566d2cd20890_Edit.tpl.php_6']['i'] == 1) ${'allow'}['first'] = true;
					if(!isset(${'allow'}['last']) && $this->iterations['9d34787c73daea397d24566d2cd20890_Edit.tpl.php_6']['i'] == $this->iterations['9d34787c73daea397d24566d2cd20890_Edit.tpl.php_6']['count']) ${'allow'}['last'] = true;
					if(isset(${'allow'}['formElements']) && is_array(${'allow'}['formElements']))
					{
						foreach(${'allow'}['formElements'] as $name => $object)
						{
							${'allow'}[$name] = $object->parse();
							${'allow'}[$name .'Error'] = (is_callable(array($object, 'getErrors')) && $object->getErrors() != '') ? '<span class="formError">' . $object->getErrors() .'</span>' : '';
						}
					} ?>
						<li><?php echo ${'allow'}['chkAllow']; ?> <label for="<?php echo ${'allow'}['id']; ?>"><?php echo ${'allow'}['label']; ?></label></li>
					<?php
					$this->iterations['9d34787c73daea397d24566d2cd20890_Edit.tpl.php_6']['i']++;
				}
				if(isset($this->iterations['9d34787c73daea397d24566d2cd20890_Edit.tpl.php_6']['old'])) ${'allow'} = $this->iterations['9d34787c73daea397d24566d2cd20890_Edit.tpl.php_6']['old'];
				else unset($this->iterations['9d34787c73daea397d24566d2cd20890_Edit.tpl.php_6']);
				?>
				</ul>
			<?php } ?>
		</div>
	</div>

	
	<div id="addBlock" class="forkForms" title="<?php echo SpoonFilter::ucfirst($this->variables['lblChooseContent']); ?>" style="display: none;">
		<input type="hidden" id="extraForBlock" name="extraForBlock" value="" />
		<div class="options horizontal">
			<p><?php echo $this->variables['msgHelpBlockContent']; ?></p>
			<p id="extraWarningAlreadyBlock">
				<span class="infoMessage"><?php echo $this->variables['msgModuleBlockAlreadyLinked']; ?></span>
			</p>
			<p id="extraWarningHomeNoBlock">
				<span class="infoMessage"><?php echo $this->variables['msgHomeNoBlock']; ?></span>
			</p>
			<p>
				<label for="extraType"><?php echo SpoonFilter::ucfirst($this->variables['lblType']); ?></label>
				<?php echo $this->variables['ddmExtraType']; ?>
			</p>
			<p id="extraModuleHolder" style="display: none;">
				<label for="extraModule"><?php echo SpoonFilter::ucfirst($this->variables['lblWhichModule']); ?></label>
				<select id="extraModule">
					<option value="-1">-</option>
				</select>
			</p>
			<p id="extraExtraIdHolder" style="display: none;">
				<label for="extraExtraId"><?php echo SpoonFilter::ucfirst($this->variables['lblWhichWidget']); ?></label>
				<select id="extraExtraId">
					<option value="-1">-</option>
				</select>
			</p>
		</div>
	</div>

	
	<div id="chooseTemplate" class="forkForms" title="<?php echo SpoonFilter::ucfirst($this->variables['lblChooseATemplate']); ?>" style="display: none;">
		<div class="generalMessage singleMessage infoMessage">
			<p><?php echo $this->variables['msgTemplateChangeWarning']; ?></p>
		</div>
		<div id="templateList">
			<ul>
				<?php
				if(isset(${'templates'})) $this->iterations['9d34787c73daea397d24566d2cd20890_Edit.tpl.php_9']['old'] = ${'templates'};
				$this->iterations['9d34787c73daea397d24566d2cd20890_Edit.tpl.php_9']['iteration'] = $this->variables['templates'];
				$this->iterations['9d34787c73daea397d24566d2cd20890_Edit.tpl.php_9']['i'] = 1;
				$this->iterations['9d34787c73daea397d24566d2cd20890_Edit.tpl.php_9']['count'] = count($this->iterations['9d34787c73daea397d24566d2cd20890_Edit.tpl.php_9']['iteration']);
				foreach((array) $this->iterations['9d34787c73daea397d24566d2cd20890_Edit.tpl.php_9']['iteration'] as ${'templates'})
				{
					if(!isset(${'templates'}['first']) && $this->iterations['9d34787c73daea397d24566d2cd20890_Edit.tpl.php_9']['i'] == 1) ${'templates'}['first'] = true;
					if(!isset(${'templates'}['last']) && $this->iterations['9d34787c73daea397d24566d2cd20890_Edit.tpl.php_9']['i'] == $this->iterations['9d34787c73daea397d24566d2cd20890_Edit.tpl.php_9']['count']) ${'templates'}['last'] = true;
					if(isset(${'templates'}['formElements']) && is_array(${'templates'}['formElements']))
					{
						foreach(${'templates'}['formElements'] as $name => $object)
						{
							${'templates'}[$name] = $object->parse();
							${'templates'}[$name .'Error'] = (is_callable(array($object, 'getErrors')) && $object->getErrors() != '') ? '<span class="formError">' . $object->getErrors() .'</span>' : '';
						}
					} ?>
			<?php
					if(isset(${'templates'}['break']) && count(${'templates'}['break']) != 0 && ${'templates'}['break'] != '' && ${'templates'}['break'] !== false)
					{
						?>
			</ul>
			<ul class="lastChild">
			<?php } ?>
					<li<?php
					if(isset(${'templates'}['disabled']) && count(${'templates'}['disabled']) != 0 && ${'templates'}['disabled'] != '' && ${'templates'}['disabled'] !== false)
					{
						?> class="disabled"<?php } ?>>
						<label for="template<?php echo ${'templates'}['id']; ?>"><input type="radio" id="template<?php echo ${'templates'}['id']; ?>" value="<?php echo ${'templates'}['id']; ?>" name="template_id_chooser" class="inputRadio"<?php
					if(isset(${'templates'}['checked']) && count(${'templates'}['checked']) != 0 && ${'templates'}['checked'] != '' && ${'templates'}['checked'] !== false)
					{
						?> checked="checked"<?php } ?><?php
					if(isset(${'templates'}['disabled']) && count(${'templates'}['disabled']) != 0 && ${'templates'}['disabled'] != '' && ${'templates'}['disabled'] !== false)
					{
						?> disabled="disabled"<?php } ?> /><?php echo ${'templates'}['label']; ?></label>
						<div class="templateVisual current">
							<?php echo ${'templates'}['html']; ?>
						</div>
					</li>
				<?php
					$this->iterations['9d34787c73daea397d24566d2cd20890_Edit.tpl.php_9']['i']++;
				}
				if(isset($this->iterations['9d34787c73daea397d24566d2cd20890_Edit.tpl.php_9']['old'])) ${'templates'} = $this->iterations['9d34787c73daea397d24566d2cd20890_Edit.tpl.php_9']['old'];
				else unset($this->iterations['9d34787c73daea397d24566d2cd20890_Edit.tpl.php_9']);
				?>
			</ul>
		</div>
	</div>

	
	<div id="confirmDeleteBlock" class="forkForms" title="<?php echo SpoonFilter::ucfirst($this->variables['lblDeleteBlock']); ?>" style="display: none;">
		<p><?php echo $this->variables['msgConfirmDeleteBlock']; ?></p>
	</div>

	<div class="fullwidthOptions">
		<?php
					if(isset($this->variables['showPagesDelete']) && count($this->variables['showPagesDelete']) != 0 && $this->variables['showPagesDelete'] != '' && $this->variables['showPagesDelete'] !== false)
					{
						?>
			<a href="<?php echo Backend\Core\Engine\TemplateModifiers::getURL($this->variables['var'], 'delete'); ?>&amp;id=<?php echo $this->variables['item']['id']; ?>&revision_id=<?php echo $this->variables['item']['revision_id']; ?>" data-message-id="confirmDelete" class="askConfirmation button linkButton icon iconDelete">
				<span><?php echo SpoonFilter::ucfirst($this->variables['lblDelete']); ?></span>
			</a>
			<div id="confirmDelete" title="<?php echo SpoonFilter::ucfirst($this->variables['lblDelete']); ?>?" style="display: none;">
				<p><?php echo sprintf($this->variables['msgConfirmDelete'], $this->variables['item']['title']); ?></p>
			</div>
		<?php } ?>

		<div class="buttonHolderRight">
			<input id="editButton" class="inputButton button mainButton" type="submit" name="edit" value="<?php echo SpoonFilter::ucfirst($this->variables['lblSave']); ?>" />
			<a href="#" id="saveAsDraft" class="inputButton button"><span><?php echo SpoonFilter::ucfirst($this->variables['lblSaveDraft']); ?></span></a>
		</div>
	</div>
</form>
				<?php } ?>

<div class="box" id="blockHtml" style="display: none;">
	<div class="blockContentHTML optionsRTE">
		<fieldset>
			<div class="generalMessage singleMessage infoMessage">
				<?php echo $this->variables['msgContentSaveWarning']; ?>
			</div>
			<div class="heading">
				<h3><?php echo SpoonFilter::ucfirst($this->variables['lblEditor']); ?></h3>
			</div>
			<?php echo $this->variables['txtHtml']; ?>
			<?php echo $this->variables['txtHtmlError']; ?>
		</fieldset>
	</div>
</div>

<script type="text/javascript">
	//<![CDATA[
		//the ID of the page
		var pageID = <?php echo $this->variables['item']['id']; ?>;

		// all the possible templates
		var templates = {};
		<?php
				if(isset(${'templates'})) $this->iterations['9d34787c73daea397d24566d2cd20890_Edit.tpl.php_7']['old'] = ${'templates'};
				$this->iterations['9d34787c73daea397d24566d2cd20890_Edit.tpl.php_7']['iteration'] = $this->variables['templates'];
				$this->iterations['9d34787c73daea397d24566d2cd20890_Edit.tpl.php_7']['i'] = 1;
				$this->iterations['9d34787c73daea397d24566d2cd20890_Edit.tpl.php_7']['count'] = count($this->iterations['9d34787c73daea397d24566d2cd20890_Edit.tpl.php_7']['iteration']);
				foreach((array) $this->iterations['9d34787c73daea397d24566d2cd20890_Edit.tpl.php_7']['iteration'] as ${'templates'})
				{
					if(!isset(${'templates'}['first']) && $this->iterations['9d34787c73daea397d24566d2cd20890_Edit.tpl.php_7']['i'] == 1) ${'templates'}['first'] = true;
					if(!isset(${'templates'}['last']) && $this->iterations['9d34787c73daea397d24566d2cd20890_Edit.tpl.php_7']['i'] == $this->iterations['9d34787c73daea397d24566d2cd20890_Edit.tpl.php_7']['count']) ${'templates'}['last'] = true;
					if(isset(${'templates'}['formElements']) && is_array(${'templates'}['formElements']))
					{
						foreach(${'templates'}['formElements'] as $name => $object)
						{
							${'templates'}[$name] = $object->parse();
							${'templates'}[$name .'Error'] = (is_callable(array($object, 'getErrors')) && $object->getErrors() != '') ? '<span class="formError">' . $object->getErrors() .'</span>' : '';
						}
					} ?>templates[<?php echo ${'templates'}['id']; ?>] = <?php echo ${'templates'}['json']; ?>;<?php
					$this->iterations['9d34787c73daea397d24566d2cd20890_Edit.tpl.php_7']['i']++;
				}
				if(isset($this->iterations['9d34787c73daea397d24566d2cd20890_Edit.tpl.php_7']['old'])) ${'templates'} = $this->iterations['9d34787c73daea397d24566d2cd20890_Edit.tpl.php_7']['old'];
				else unset($this->iterations['9d34787c73daea397d24566d2cd20890_Edit.tpl.php_7']);
				?>

		// the data for the extra's
		var extrasData = {};
		<?php
					if(isset($this->variables['extrasData']) && count($this->variables['extrasData']) != 0 && $this->variables['extrasData'] != '' && $this->variables['extrasData'] !== false)
					{
						?>extrasData = <?php echo $this->variables['extrasData']; ?>;<?php } ?>

		// the extra's, but in a way we can access them based on their ID
		var extrasById = {};
		<?php
					if(isset($this->variables['extrasById']) && count($this->variables['extrasById']) != 0 && $this->variables['extrasById'] != '' && $this->variables['extrasById'] !== false)
					{
						?>extrasById = <?php echo $this->variables['extrasById']; ?>;<?php } ?>

		// indicator that the default blocks may not be set on pageload
		var initDefaults = false;

		// fix selected state in the tree
		var selectedId = 'page-'+ pageID;
	//]]>
</script>

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
