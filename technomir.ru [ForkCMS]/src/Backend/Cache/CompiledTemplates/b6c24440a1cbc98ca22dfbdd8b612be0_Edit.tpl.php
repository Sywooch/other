<?php error_reporting(E_ALL | E_STRICT); ini_set('display_errors', 'On'); ?>
<?php
				ob_start();
				?><?php if(array_key_exists('BACKEND_CORE_PATH', (array) $this->variables)) { echo $this->variables['BACKEND_CORE_PATH']; } else { ?>{$BACKEND_CORE_PATH}<?php } ?>/Layout/Templates/Head.tpl<?php
				$include = eval('return \'' . str_replace('\'', '\\\'', ob_get_clean()) .'\';');
				if($this->getForceCompile() || !file_exists($this->getCompileDirectory() .'/' . $this->getCompileName($include, '/home/segaz/domains/techno-mir.net/public_html/src/Backend/Modules/Blog/Layout/Templates'))) $this->compile('/home/segaz/domains/techno-mir.net/public_html/src/Backend/Modules/Blog/Layout/Templates', $include);
				$return = @include $this->getCompileDirectory() .'/' . $this->getCompileName($include, '/home/segaz/domains/techno-mir.net/public_html/src/Backend/Modules/Blog/Layout/Templates');
				if($return === false && $this->compile('/home/segaz/domains/techno-mir.net/public_html/src/Backend/Modules/Blog/Layout/Templates', $include))
				{
					$return = @include $this->getCompileDirectory() .'/' . $this->getCompileName($include, '/home/segaz/domains/techno-mir.net/public_html/src/Backend/Modules/Blog/Layout/Templates');
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
				if($this->getForceCompile() || !file_exists($this->getCompileDirectory() .'/' . $this->getCompileName($include, '/home/segaz/domains/techno-mir.net/public_html/src/Backend/Modules/Blog/Layout/Templates'))) $this->compile('/home/segaz/domains/techno-mir.net/public_html/src/Backend/Modules/Blog/Layout/Templates', $include);
				$return = @include $this->getCompileDirectory() .'/' . $this->getCompileName($include, '/home/segaz/domains/techno-mir.net/public_html/src/Backend/Modules/Blog/Layout/Templates');
				if($return === false && $this->compile('/home/segaz/domains/techno-mir.net/public_html/src/Backend/Modules/Blog/Layout/Templates', $include))
				{
					$return = @include $this->getCompileDirectory() .'/' . $this->getCompileName($include, '/home/segaz/domains/techno-mir.net/public_html/src/Backend/Modules/Blog/Layout/Templates');
				}
if($return === false)
				{
					?>{include:<?php if(array_key_exists('BACKEND_CORE_PATH', (array) $this->variables)) { echo $this->variables['BACKEND_CORE_PATH']; } else { ?>{$BACKEND_CORE_PATH}<?php } ?>/Layout/Templates/StructureStartModule.tpl}<?php
				}
?>

<div class="pageTitle">
	<h2><?php if(array_key_exists('lblBlog', (array) $this->variables)) { echo SpoonFilter::ucfirst($this->variables['lblBlog']); } else { ?>{$lblBlog|ucfirst}<?php } ?>: <?php if(array_key_exists('msgEditArticle', (array) $this->variables) && isset($this->variables['item']) && array_key_exists('title', (array) $this->variables['item'])) { echo sprintf($this->variables['msgEditArticle'], $this->variables['item']['title']); } else { ?>{$msgEditArticle|sprintf:<?php if(isset($this->variables['item']) && array_key_exists('title', (array) $this->variables['item'])) { echo $this->variables['item']['title']; } else { ?>{$item.title}<?php } ?>}<?php } ?></h2>
	<div class="buttonHolderRight">
		<a href="<?php if(array_key_exists('detailURL', (array) $this->variables)) { echo $this->variables['detailURL']; } else { ?>{$detailURL}<?php } ?>/<?php if(isset($this->variables['item']) && array_key_exists('url', (array) $this->variables['item'])) { echo $this->variables['item']['url']; } else { ?>{$item.url}<?php } ?><?php
					if(isset($this->variables['item']['revision_id']) && count($this->variables['item']['revision_id']) != 0 && $this->variables['item']['revision_id'] != '' && $this->variables['item']['revision_id'] !== false)
					{
						?>?revision=<?php if(isset($this->variables['item']) && array_key_exists('revision_id', (array) $this->variables['item'])) { echo $this->variables['item']['revision_id']; } else { ?>{$item.revision_id}<?php } ?><?php } ?>" class="button icon iconZoom previewButton targetBlank">
			<span><?php if(array_key_exists('lblView', (array) $this->variables)) { echo SpoonFilter::ucfirst($this->variables['lblView']); } else { ?>{$lblView|ucfirst}<?php } ?></span>
		</a>
	</div>
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
	<label for="title"><?php if(array_key_exists('lblTitle', (array) $this->variables)) { echo SpoonFilter::ucfirst($this->variables['lblTitle']); } else { ?>{$lblTitle|ucfirst}<?php } ?></label>
	<?php if(array_key_exists('txtTitle', (array) $this->variables)) { echo $this->variables['txtTitle']; } else { ?>{$txtTitle}<?php } ?> <?php if(array_key_exists('txtTitleError', (array) $this->variables)) { echo $this->variables['txtTitleError']; } else { ?>{$txtTitleError}<?php } ?>

	<div id="pageUrl">
		<div class="oneLiner">
			<?php
					if(isset($this->variables['detailURL']) && count($this->variables['detailURL']) != 0 && $this->variables['detailURL'] != '' && $this->variables['detailURL'] !== false)
					{
						?><p><span><a href="<?php if(array_key_exists('detailURL', (array) $this->variables)) { echo $this->variables['detailURL']; } else { ?>{$detailURL}<?php } ?>/<?php if(isset($this->variables['item']) && array_key_exists('url', (array) $this->variables['item'])) { echo $this->variables['item']['url']; } else { ?>{$item.url}<?php } ?>"><?php if(array_key_exists('detailURL', (array) $this->variables)) { echo $this->variables['detailURL']; } else { ?>{$detailURL}<?php } ?>/<span id="generatedUrl"><?php if(isset($this->variables['item']) && array_key_exists('url', (array) $this->variables['item'])) { echo $this->variables['item']['url']; } else { ?>{$item.url}<?php } ?></span></a></span></p><?php } ?>
			<?php if(!isset($this->variables['detailURL']) || count($this->variables['detailURL']) == 0 || $this->variables['detailURL'] == '' || $this->variables['detailURL'] === false): ?><p class="infoMessage"><?php if(array_key_exists('errNoModuleLinked', (array) $this->variables)) { echo $this->variables['errNoModuleLinked']; } else { ?>{$errNoModuleLinked}<?php } ?></p><?php endif; ?>
		</div>
	</div>

	<div class="tabs">
		<ul>
			<li><a href="#tabContent"><?php if(array_key_exists('lblContent', (array) $this->variables)) { echo SpoonFilter::ucfirst($this->variables['lblContent']); } else { ?>{$lblContent|ucfirst}<?php } ?></a></li>
			<li><a href="#tabVersions"><?php if(array_key_exists('lblVersions', (array) $this->variables)) { echo SpoonFilter::ucfirst($this->variables['lblVersions']); } else { ?>{$lblVersions|ucfirst}<?php } ?></a></li>
			<li><a href="#tabPermissions"><?php if(array_key_exists('lblComments', (array) $this->variables)) { echo SpoonFilter::ucfirst($this->variables['lblComments']); } else { ?>{$lblComments|ucfirst}<?php } ?></a></li>
			<li><a href="#tabSEO"><?php if(array_key_exists('lblSEO', (array) $this->variables)) { echo SpoonFilter::ucfirst($this->variables['lblSEO']); } else { ?>{$lblSEO|ucfirst}<?php } ?></a></li>
		</ul>

		<div id="tabContent">
			<table width="100%">
				<tr>
					<td id="leftColumn">

						
						<div class="box">
							<div class="heading">
								<h3>
									<label for="text"><?php if(array_key_exists('lblMainContent', (array) $this->variables)) { echo SpoonFilter::ucfirst($this->variables['lblMainContent']); } else { ?>{$lblMainContent|ucfirst}<?php } ?><abbr title="<?php if(array_key_exists('lblRequiredField', (array) $this->variables)) { echo $this->variables['lblRequiredField']; } else { ?>{$lblRequiredField}<?php } ?>">*</abbr></label>
								</h3>
							</div>
							<div class="optionsRTE">
								<?php if(array_key_exists('txtText', (array) $this->variables)) { echo $this->variables['txtText']; } else { ?>{$txtText}<?php } ?> <?php if(array_key_exists('txtTextError', (array) $this->variables)) { echo $this->variables['txtTextError']; } else { ?>{$txtTextError}<?php } ?>
							</div>
						</div>

						
						<?php
					if(isset($this->variables['imageIsAllowed']) && count($this->variables['imageIsAllowed']) != 0 && $this->variables['imageIsAllowed'] != '' && $this->variables['imageIsAllowed'] !== false)
					{
						?>
						<div class="box">
							<div class="heading">
								<h3><?php if(array_key_exists('lblImage', (array) $this->variables)) { echo SpoonFilter::ucfirst($this->variables['lblImage']); } else { ?>{$lblImage|ucfirst}<?php } ?></h3>
							</div>
							<div class="options clearfix">
								<?php
					if(isset($this->variables['item']['image']) && count($this->variables['item']['image']) != 0 && $this->variables['item']['image'] != '' && $this->variables['item']['image'] !== false)
					{
						?>
								<p class="imageHolder">
									<img src="<?php if(array_key_exists('FRONTEND_FILES_URL', (array) $this->variables)) { echo $this->variables['FRONTEND_FILES_URL']; } else { ?>{$FRONTEND_FILES_URL}<?php } ?>/blog/images/128x128/<?php if(isset($this->variables['item']) && array_key_exists('image', (array) $this->variables['item'])) { echo $this->variables['item']['image']; } else { ?>{$item.image}<?php } ?>" width="128" height="128" alt="<?php if(array_key_exists('lblImage', (array) $this->variables)) { echo SpoonFilter::ucfirst($this->variables['lblImage']); } else { ?>{$lblImage|ucfirst}<?php } ?>" />
									<label for="deleteImage"><?php if(array_key_exists('chkDeleteImage', (array) $this->variables)) { echo $this->variables['chkDeleteImage']; } else { ?>{$chkDeleteImage}<?php } ?> <?php if(array_key_exists('lblDelete', (array) $this->variables)) { echo SpoonFilter::ucfirst($this->variables['lblDelete']); } else { ?>{$lblDelete|ucfirst}<?php } ?></label>
									<?php if(array_key_exists('chkDeleteImageError', (array) $this->variables)) { echo $this->variables['chkDeleteImageError']; } else { ?>{$chkDeleteImageError}<?php } ?>
								</p>
								<?php } ?>
								<p>
									<label for="image"><?php if(array_key_exists('lblImage', (array) $this->variables)) { echo SpoonFilter::ucfirst($this->variables['lblImage']); } else { ?>{$lblImage|ucfirst}<?php } ?></label>
									<?php if(array_key_exists('fileImage', (array) $this->variables)) { echo $this->variables['fileImage']; } else { ?>{$fileImage}<?php } ?> <?php if(array_key_exists('fileImageError', (array) $this->variables)) { echo $this->variables['fileImageError']; } else { ?>{$fileImageError}<?php } ?>
								</p>
							</div>
						</div>
						<?php } ?>

						
						<div class="box">
							<div class="heading">
								<div class="oneLiner">
									<h3>
										<label for="introduction"><?php if(array_key_exists('lblSummary', (array) $this->variables)) { echo SpoonFilter::ucfirst($this->variables['lblSummary']); } else { ?>{$lblSummary|ucfirst}<?php } ?></label>
									</h3>
									<abbr class="help">(?)</abbr>
									<div class="tooltip" style="display: none;">
										<p><?php if(array_key_exists('msgHelpSummary', (array) $this->variables)) { echo $this->variables['msgHelpSummary']; } else { ?>{$msgHelpSummary}<?php } ?></p>
									</div>
								</div>
							</div>
							<div class="optionsRTE">
								<?php if(array_key_exists('txtIntroduction', (array) $this->variables)) { echo $this->variables['txtIntroduction']; } else { ?>{$txtIntroduction}<?php } ?> <?php if(array_key_exists('txtIntroductionError', (array) $this->variables)) { echo $this->variables['txtIntroductionError']; } else { ?>{$txtIntroductionError}<?php } ?>
							</div>
						</div>

					</td>

					<td id="sidebar">
						<div id="publishOptions" class="box">
							<div class="heading">
								<h3><?php if(array_key_exists('lblStatus', (array) $this->variables)) { echo SpoonFilter::ucfirst($this->variables['lblStatus']); } else { ?>{$lblStatus|ucfirst}<?php } ?></h3>
							</div>

							<?php
					if(isset($this->variables['usingDraft']) && count($this->variables['usingDraft']) != 0 && $this->variables['usingDraft'] != '' && $this->variables['usingDraft'] !== false)
					{
						?>
							<div class="options">
								<div class="buttonHolder">
									<a href="<?php if(array_key_exists('detailURL', (array) $this->variables)) { echo $this->variables['detailURL']; } else { ?>{$detailURL}<?php } ?>/<?php if(isset($this->variables['item']) && array_key_exists('url', (array) $this->variables['item'])) { echo $this->variables['item']['url']; } else { ?>{$item.url}<?php } ?>?revision=<?php if(array_key_exists('draftId', (array) $this->variables)) { echo $this->variables['draftId']; } else { ?>{$draftId}<?php } ?>" class="button icon iconZoom targetBlank"><span><?php if(array_key_exists('lblPreview', (array) $this->variables)) { echo SpoonFilter::ucfirst($this->variables['lblPreview']); } else { ?>{$lblPreview|ucfirst}<?php } ?></span></a>
								</div>
							</div>
							<?php } ?>

							<div class="options">
								<ul class="inputList">
									<?php
					if(!isset($this->variables['hidden']))
					{
						?>{iteration:hidden}<?php
						$this->variables['hidden'] = array();
						$this->iterations['b6c24440a1cbc98ca22dfbdd8b612be0_Edit.tpl.php_1']['fail'] = true;
					}
				if(isset(${'hidden'})) $this->iterations['b6c24440a1cbc98ca22dfbdd8b612be0_Edit.tpl.php_1']['old'] = ${'hidden'};
				$this->iterations['b6c24440a1cbc98ca22dfbdd8b612be0_Edit.tpl.php_1']['iteration'] = $this->variables['hidden'];
				$this->iterations['b6c24440a1cbc98ca22dfbdd8b612be0_Edit.tpl.php_1']['i'] = 1;
				$this->iterations['b6c24440a1cbc98ca22dfbdd8b612be0_Edit.tpl.php_1']['count'] = count($this->iterations['b6c24440a1cbc98ca22dfbdd8b612be0_Edit.tpl.php_1']['iteration']);
				foreach((array) $this->iterations['b6c24440a1cbc98ca22dfbdd8b612be0_Edit.tpl.php_1']['iteration'] as ${'hidden'})
				{
					if(!isset(${'hidden'}['first']) && $this->iterations['b6c24440a1cbc98ca22dfbdd8b612be0_Edit.tpl.php_1']['i'] == 1) ${'hidden'}['first'] = true;
					if(!isset(${'hidden'}['last']) && $this->iterations['b6c24440a1cbc98ca22dfbdd8b612be0_Edit.tpl.php_1']['i'] == $this->iterations['b6c24440a1cbc98ca22dfbdd8b612be0_Edit.tpl.php_1']['count']) ${'hidden'}['last'] = true;
					if(isset(${'hidden'}['formElements']) && is_array(${'hidden'}['formElements']))
					{
						foreach(${'hidden'}['formElements'] as $name => $object)
						{
							${'hidden'}[$name] = $object->parse();
							${'hidden'}[$name .'Error'] = (is_callable(array($object, 'getErrors')) && $object->getErrors() != '') ? '<span class="formError">' . $object->getErrors() .'</span>' : '';
						}
					} ?>
									<li>
										<?php if(array_key_exists('rbtHidden', (array) ${'hidden'})) { echo ${'hidden'}['rbtHidden']; } else { ?>{$hidden->rbtHidden}<?php } ?>
										<label for="<?php if(array_key_exists('id', (array) ${'hidden'})) { echo ${'hidden'}['id']; } else { ?>{$hidden->id}<?php } ?>"><?php if(array_key_exists('label', (array) ${'hidden'})) { echo ${'hidden'}['label']; } else { ?>{$hidden->label}<?php } ?></label>
									</li>
									<?php
					$this->iterations['b6c24440a1cbc98ca22dfbdd8b612be0_Edit.tpl.php_1']['i']++;
				}
					if(isset($this->iterations['b6c24440a1cbc98ca22dfbdd8b612be0_Edit.tpl.php_1']['fail']) && $this->iterations['b6c24440a1cbc98ca22dfbdd8b612be0_Edit.tpl.php_1']['fail'] == true)
					{
						?>{/iteration:hidden}<?php
					}
				if(isset($this->iterations['b6c24440a1cbc98ca22dfbdd8b612be0_Edit.tpl.php_1']['old'])) ${'hidden'} = $this->iterations['b6c24440a1cbc98ca22dfbdd8b612be0_Edit.tpl.php_1']['old'];
				else unset($this->iterations['b6c24440a1cbc98ca22dfbdd8b612be0_Edit.tpl.php_1']);
				?>
								</ul>
							</div>

							<div class="options">
								<p class="p0"><label for="publishOnDate"><?php if(array_key_exists('lblPublishOn', (array) $this->variables)) { echo SpoonFilter::ucfirst($this->variables['lblPublishOn']); } else { ?>{$lblPublishOn|ucfirst}<?php } ?></label></p>
								<div class="oneLiner">
									<p>
										<?php if(array_key_exists('txtPublishOnDate', (array) $this->variables)) { echo $this->variables['txtPublishOnDate']; } else { ?>{$txtPublishOnDate}<?php } ?> <?php if(array_key_exists('txtPublishOnDateError', (array) $this->variables)) { echo $this->variables['txtPublishOnDateError']; } else { ?>{$txtPublishOnDateError}<?php } ?>
									</p>
									<p>
										<label for="publishOnTime"><?php if(array_key_exists('lblAt', (array) $this->variables)) { echo $this->variables['lblAt']; } else { ?>{$lblAt}<?php } ?></label>
									</p>
									<p>
										<?php if(array_key_exists('txtPublishOnTime', (array) $this->variables)) { echo $this->variables['txtPublishOnTime']; } else { ?>{$txtPublishOnTime}<?php } ?> <?php if(array_key_exists('txtPublishOnTimeError', (array) $this->variables)) { echo $this->variables['txtPublishOnTimeError']; } else { ?>{$txtPublishOnTimeError}<?php } ?>
									</p>
								</div>
							</div>
						</div>

						<div class="box" id="articleMeta">
							<div class="heading">
								<h3><?php if(array_key_exists('lblMetaData', (array) $this->variables)) { echo SpoonFilter::ucfirst($this->variables['lblMetaData']); } else { ?>{$lblMetaData|ucfirst}<?php } ?></h3>
							</div>
							<div class="options">
								<label for="categoryId"><?php if(array_key_exists('lblCategory', (array) $this->variables)) { echo SpoonFilter::ucfirst($this->variables['lblCategory']); } else { ?>{$lblCategory|ucfirst}<?php } ?></label>
								<?php if(array_key_exists('ddmCategoryId', (array) $this->variables)) { echo $this->variables['ddmCategoryId']; } else { ?>{$ddmCategoryId}<?php } ?> <?php if(array_key_exists('ddmCategoryIdError', (array) $this->variables)) { echo $this->variables['ddmCategoryIdError']; } else { ?>{$ddmCategoryIdError}<?php } ?>
							</div>
							<div class="options">
								<label for="userId"><?php if(array_key_exists('lblAuthor', (array) $this->variables)) { echo SpoonFilter::ucfirst($this->variables['lblAuthor']); } else { ?>{$lblAuthor|ucfirst}<?php } ?></label>
								<?php if(array_key_exists('ddmUserId', (array) $this->variables)) { echo $this->variables['ddmUserId']; } else { ?>{$ddmUserId}<?php } ?> <?php if(array_key_exists('ddmUserIdError', (array) $this->variables)) { echo $this->variables['ddmUserIdError']; } else { ?>{$ddmUserIdError}<?php } ?>
							</div>
							<?php
					if(isset($this->variables['showTagsIndex']) && count($this->variables['showTagsIndex']) != 0 && $this->variables['showTagsIndex'] != '' && $this->variables['showTagsIndex'] !== false)
					{
						?>
								<div class="options">
									<label for="tags"><?php if(array_key_exists('lblTags', (array) $this->variables)) { echo SpoonFilter::ucfirst($this->variables['lblTags']); } else { ?>{$lblTags|ucfirst}<?php } ?></label>
									<?php if(array_key_exists('txtTags', (array) $this->variables)) { echo $this->variables['txtTags']; } else { ?>{$txtTags}<?php } ?> <?php if(array_key_exists('txtTagsError', (array) $this->variables)) { echo $this->variables['txtTagsError']; } else { ?>{$txtTagsError}<?php } ?>
								</div>
							<?php } ?>
						</div>

					</td>
				</tr>
			</table>
		</div>

		<div id="tabPermissions">
			<table width="100%">
				<tr>
					<td>
						<?php if(array_key_exists('chkAllowComments', (array) $this->variables)) { echo $this->variables['chkAllowComments']; } else { ?>{$chkAllowComments}<?php } ?> <label for="allowComments"><?php if(array_key_exists('lblAllowComments', (array) $this->variables)) { echo SpoonFilter::ucfirst($this->variables['lblAllowComments']); } else { ?>{$lblAllowComments|ucfirst}<?php } ?></label>
					</td>
				</tr>
			</table>
		</div>

		<div id="tabVersions">
			<?php
					if(isset($this->variables['drafts']) && count($this->variables['drafts']) != 0 && $this->variables['drafts'] != '' && $this->variables['drafts'] !== false)
					{
						?>
				<div class="tableHeading">
					<div class="oneLiner">
						<h3 class="oneLinerElement"><?php if(array_key_exists('lblDrafts', (array) $this->variables)) { echo SpoonFilter::ucfirst($this->variables['lblDrafts']); } else { ?>{$lblDrafts|ucfirst}<?php } ?></h3>
						<abbr class="help">(?)</abbr>
						<div class="tooltip" style="display: none;">
							<p><?php if(array_key_exists('msgHelpDrafts', (array) $this->variables)) { echo $this->variables['msgHelpDrafts']; } else { ?>{$msgHelpDrafts}<?php } ?></p>
						</div>
					</div>
				</div>

				<div class="dataGridHolder">
					<?php if(array_key_exists('drafts', (array) $this->variables)) { echo $this->variables['drafts']; } else { ?>{$drafts}<?php } ?>
				</div>
			<?php } ?>

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

		<div id="tabSEO">
			<?php
				ob_start();
				?><?php if(array_key_exists('BACKEND_CORE_PATH', (array) $this->variables)) { echo $this->variables['BACKEND_CORE_PATH']; } else { ?>{$BACKEND_CORE_PATH}<?php } ?>/Layout/Templates/Seo.tpl<?php
				$include = eval('return \'' . str_replace('\'', '\\\'', ob_get_clean()) .'\';');
				if($this->getForceCompile() || !file_exists($this->getCompileDirectory() .'/' . $this->getCompileName($include, '/home/segaz/domains/techno-mir.net/public_html/src/Backend/Modules/Blog/Layout/Templates'))) $this->compile('/home/segaz/domains/techno-mir.net/public_html/src/Backend/Modules/Blog/Layout/Templates', $include);
				$return = @include $this->getCompileDirectory() .'/' . $this->getCompileName($include, '/home/segaz/domains/techno-mir.net/public_html/src/Backend/Modules/Blog/Layout/Templates');
				if($return === false && $this->compile('/home/segaz/domains/techno-mir.net/public_html/src/Backend/Modules/Blog/Layout/Templates', $include))
				{
					$return = @include $this->getCompileDirectory() .'/' . $this->getCompileName($include, '/home/segaz/domains/techno-mir.net/public_html/src/Backend/Modules/Blog/Layout/Templates');
				}
if($return === false)
				{
					?>{include:<?php if(array_key_exists('BACKEND_CORE_PATH', (array) $this->variables)) { echo $this->variables['BACKEND_CORE_PATH']; } else { ?>{$BACKEND_CORE_PATH}<?php } ?>/Layout/Templates/Seo.tpl}<?php
				}
?>
		</div>
	</div>

	<div class="fullwidthOptions">
		<?php
					if(isset($this->variables['showBlogDelete']) && count($this->variables['showBlogDelete']) != 0 && $this->variables['showBlogDelete'] != '' && $this->variables['showBlogDelete'] !== false)
					{
						?>
		<a href="<?php if(array_key_exists('var', (array) $this->variables)) { echo Backend\Core\Engine\TemplateModifiers::getURL($this->variables['var'], 'delete'); } else { ?>{$var|geturl:'delete'}<?php } ?>&amp;id=<?php if(isset($this->variables['item']) && array_key_exists('id', (array) $this->variables['item'])) { echo $this->variables['item']['id']; } else { ?>{$item.id}<?php } ?><?php
					if(isset($this->variables['categoryId']) && count($this->variables['categoryId']) != 0 && $this->variables['categoryId'] != '' && $this->variables['categoryId'] !== false)
					{
						?>&amp;category=<?php if(array_key_exists('categoryId', (array) $this->variables)) { echo $this->variables['categoryId']; } else { ?>{$categoryId}<?php } ?><?php } ?>" data-message-id="confirmDelete" class="askConfirmation button linkButton icon iconDelete">
			<span><?php if(array_key_exists('lblDelete', (array) $this->variables)) { echo SpoonFilter::ucfirst($this->variables['lblDelete']); } else { ?>{$lblDelete|ucfirst}<?php } ?></span>
		</a>

		<div id="confirmDelete" title="<?php if(array_key_exists('lblDelete', (array) $this->variables)) { echo SpoonFilter::ucfirst($this->variables['lblDelete']); } else { ?>{$lblDelete|ucfirst}<?php } ?>?" style="display: none;">
			<p>
				<?php if(array_key_exists('msgConfirmDelete', (array) $this->variables) && isset($this->variables['item']) && array_key_exists('title', (array) $this->variables['item'])) { echo sprintf($this->variables['msgConfirmDelete'], $this->variables['item']['title']); } else { ?>{$msgConfirmDelete|sprintf:<?php if(isset($this->variables['item']) && array_key_exists('title', (array) $this->variables['item'])) { echo $this->variables['item']['title']; } else { ?>{$item.title}<?php } ?>}<?php } ?>
			</p>
		</div>
		<?php } ?>

		<div class="buttonHolderRight">
			<input id="editButton" class="inputButton button mainButton" type="submit" name="edit" value="<?php if(array_key_exists('lblPublish', (array) $this->variables)) { echo SpoonFilter::ucfirst($this->variables['lblPublish']); } else { ?>{$lblPublish|ucfirst}<?php } ?>" />
			<a href="#" id="saveAsDraft" class="inputButton button"><span><?php if(array_key_exists('lblSaveDraft', (array) $this->variables)) { echo SpoonFilter::ucfirst($this->variables['lblSaveDraft']); } else { ?>{$lblSaveDraft|ucfirst}<?php } ?></span></a>
		</div>
	</div>

	<div id="addCategoryDialog" class="forkForms" title="<?php if(array_key_exists('lblAddCategory', (array) $this->variables)) { echo SpoonFilter::ucfirst($this->variables['lblAddCategory']); } else { ?>{$lblAddCategory|ucfirst}<?php } ?>" style="display: none;">
		<div id="templateList">
			<p>
				<label for="categoryTitle"><?php if(array_key_exists('lblTitle', (array) $this->variables)) { echo SpoonFilter::ucfirst($this->variables['lblTitle']); } else { ?>{$lblTitle|ucfirst}<?php } ?><abbr title="<?php if(array_key_exists('lblRequiredField', (array) $this->variables)) { echo $this->variables['lblRequiredField']; } else { ?>{$lblRequiredField}<?php } ?>">*</abbr></label>
				<input type="text" name="categoryTitle" id="categoryTitle" class="inputText" maxlength="255" />
				<span class="formError" id="categoryTitleError" style="display: none;"><?php if(array_key_exists('errFieldIsRequired', (array) $this->variables)) { echo SpoonFilter::ucfirst($this->variables['errFieldIsRequired']); } else { ?>{$errFieldIsRequired|ucfirst}<?php } ?></span>
			</p>
		</div>
	</div>
</form>
				<?php } ?>

<?php
				ob_start();
				?><?php if(array_key_exists('BACKEND_CORE_PATH', (array) $this->variables)) { echo $this->variables['BACKEND_CORE_PATH']; } else { ?>{$BACKEND_CORE_PATH}<?php } ?>/Layout/Templates/StructureEndModule.tpl<?php
				$include = eval('return \'' . str_replace('\'', '\\\'', ob_get_clean()) .'\';');
				if($this->getForceCompile() || !file_exists($this->getCompileDirectory() .'/' . $this->getCompileName($include, '/home/segaz/domains/techno-mir.net/public_html/src/Backend/Modules/Blog/Layout/Templates'))) $this->compile('/home/segaz/domains/techno-mir.net/public_html/src/Backend/Modules/Blog/Layout/Templates', $include);
				$return = @include $this->getCompileDirectory() .'/' . $this->getCompileName($include, '/home/segaz/domains/techno-mir.net/public_html/src/Backend/Modules/Blog/Layout/Templates');
				if($return === false && $this->compile('/home/segaz/domains/techno-mir.net/public_html/src/Backend/Modules/Blog/Layout/Templates', $include))
				{
					$return = @include $this->getCompileDirectory() .'/' . $this->getCompileName($include, '/home/segaz/domains/techno-mir.net/public_html/src/Backend/Modules/Blog/Layout/Templates');
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
				if($this->getForceCompile() || !file_exists($this->getCompileDirectory() .'/' . $this->getCompileName($include, '/home/segaz/domains/techno-mir.net/public_html/src/Backend/Modules/Blog/Layout/Templates'))) $this->compile('/home/segaz/domains/techno-mir.net/public_html/src/Backend/Modules/Blog/Layout/Templates', $include);
				$return = @include $this->getCompileDirectory() .'/' . $this->getCompileName($include, '/home/segaz/domains/techno-mir.net/public_html/src/Backend/Modules/Blog/Layout/Templates');
				if($return === false && $this->compile('/home/segaz/domains/techno-mir.net/public_html/src/Backend/Modules/Blog/Layout/Templates', $include))
				{
					$return = @include $this->getCompileDirectory() .'/' . $this->getCompileName($include, '/home/segaz/domains/techno-mir.net/public_html/src/Backend/Modules/Blog/Layout/Templates');
				}
if($return === false)
				{
					?>{include:<?php if(array_key_exists('BACKEND_CORE_PATH', (array) $this->variables)) { echo $this->variables['BACKEND_CORE_PATH']; } else { ?>{$BACKEND_CORE_PATH}<?php } ?>/Layout/Templates/Footer.tpl}<?php
				}
?>
