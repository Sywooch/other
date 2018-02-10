<?php error_reporting(E_ALL | E_STRICT); ini_set('display_errors', 'On'); ?>
<?php
				ob_start();
				?><?php if(array_key_exists('BACKEND_CORE_PATH', (array) $this->variables)) { echo $this->variables['BACKEND_CORE_PATH']; } else { ?>{$BACKEND_CORE_PATH}<?php } ?>/Layout/Templates/Head.tpl<?php
				$include = eval('return \'' . str_replace('\'', '\\\'', ob_get_clean()) .'\';');
				if($this->getForceCompile() || !file_exists($this->getCompileDirectory() .'/' . $this->getCompileName($include, 'J:\home\technomir.com\www\src\Backend\Modules\Pages\Layout\Templates'))) $this->compile('J:\home\technomir.com\www\src\Backend\Modules\Pages\Layout\Templates', $include);
				$return = @include $this->getCompileDirectory() .'/' . $this->getCompileName($include, 'J:\home\technomir.com\www\src\Backend\Modules\Pages\Layout\Templates');
				if($return === false && $this->compile('J:\home\technomir.com\www\src\Backend\Modules\Pages\Layout\Templates', $include))
				{
					$return = @include $this->getCompileDirectory() .'/' . $this->getCompileName($include, 'J:\home\technomir.com\www\src\Backend\Modules\Pages\Layout\Templates');
				}
if($return === false)
				{
					?>{include:<?php if(array_key_exists('BACKEND_CORE_PATH', (array) $this->variables)) { echo $this->variables['BACKEND_CORE_PATH']; } else { ?>{$BACKEND_CORE_PATH}<?php } ?>/Layout/Templates/Head.tpl}<?php
				}
?>
<?php
				ob_start();
				?><?php if(array_key_exists('BACKEND_MODULES_PATH', (array) $this->variables)) { echo $this->variables['BACKEND_MODULES_PATH']; } else { ?>{$BACKEND_MODULES_PATH}<?php } ?>/Pages/Layout/Templates/StructureStart.tpl<?php
				$include = eval('return \'' . str_replace('\'', '\\\'', ob_get_clean()) .'\';');
				if($this->getForceCompile() || !file_exists($this->getCompileDirectory() .'/' . $this->getCompileName($include, 'J:\home\technomir.com\www\src\Backend\Modules\Pages\Layout\Templates'))) $this->compile('J:\home\technomir.com\www\src\Backend\Modules\Pages\Layout\Templates', $include);
				$return = @include $this->getCompileDirectory() .'/' . $this->getCompileName($include, 'J:\home\technomir.com\www\src\Backend\Modules\Pages\Layout\Templates');
				if($return === false && $this->compile('J:\home\technomir.com\www\src\Backend\Modules\Pages\Layout\Templates', $include))
				{
					$return = @include $this->getCompileDirectory() .'/' . $this->getCompileName($include, 'J:\home\technomir.com\www\src\Backend\Modules\Pages\Layout\Templates');
				}
if($return === false)
				{
					?>{include:<?php if(array_key_exists('BACKEND_MODULES_PATH', (array) $this->variables)) { echo $this->variables['BACKEND_MODULES_PATH']; } else { ?>{$BACKEND_MODULES_PATH}<?php } ?>/Pages/Layout/Templates/StructureStart.tpl}<?php
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
	<?php if(array_key_exists('hidTemplateId', (array) $this->variables)) { echo $this->variables['hidTemplateId']; } else { ?>{$hidTemplateId}<?php } ?>

	<div class="pageTitle">
		<h2><?php if(array_key_exists('lblPages', (array) $this->variables)) { echo SpoonFilter::ucfirst($this->variables['lblPages']); } else { ?>{$lblPages|ucfirst}<?php } ?>: <?php if(array_key_exists('lblAdd', (array) $this->variables)) { echo $this->variables['lblAdd']; } else { ?>{$lblAdd}<?php } ?></h2>

		<?php
					if(isset($this->variables['showPagesIndex']) && count($this->variables['showPagesIndex']) != 0 && $this->variables['showPagesIndex'] != '' && $this->variables['showPagesIndex'] !== false)
					{
						?>
		<div class="buttonHolderRight">
			<a href="<?php if(array_key_exists('var', (array) $this->variables)) { echo Backend\Core\Engine\TemplateModifiers::getURL($this->variables['var'], 'index'); } else { ?>{$var|geturl:'index'}<?php } ?>" class="button icon iconBack"><span><?php if(array_key_exists('lblOverview', (array) $this->variables)) { echo SpoonFilter::ucfirst($this->variables['lblOverview']); } else { ?>{$lblOverview|ucfirst}<?php } ?></span></a>
		</div>
		<?php } ?>
	</div>

	<p id="pagesPageTitle">
		<label for="title"><?php if(array_key_exists('lblTitle', (array) $this->variables)) { echo SpoonFilter::ucfirst($this->variables['lblTitle']); } else { ?>{$lblTitle|ucfirst}<?php } ?></label>
		<?php if(array_key_exists('txtTitle', (array) $this->variables)) { echo $this->variables['txtTitle']; } else { ?>{$txtTitle}<?php } ?> <?php if(array_key_exists('txtTitleError', (array) $this->variables)) { echo $this->variables['txtTitleError']; } else { ?>{$txtTitleError}<?php } ?>
		<span class="oneLiner">
			<span><a href="<?php if(array_key_exists('SITE_URL', (array) $this->variables)) { echo $this->variables['SITE_URL']; } else { ?>{$SITE_URL}<?php } ?>"><?php if(array_key_exists('SITE_URL', (array) $this->variables)) { echo $this->variables['SITE_URL']; } else { ?>{$SITE_URL}<?php } ?><?php if(array_key_exists('prefixURL', (array) $this->variables)) { echo $this->variables['prefixURL']; } else { ?>{$prefixURL}<?php } ?>/<span id="generatedUrl"></span></a></span>
		</span>
	</p>

	<div id="tabs" class="tabs">
		<ul>
			<li style="float: left;"><a href="#tabContent"><?php if(array_key_exists('lblContent', (array) $this->variables)) { echo SpoonFilter::ucfirst($this->variables['lblContent']); } else { ?>{$lblContent|ucfirst}<?php } ?></a></li>
			<!-- Reverse order after content tab [floatRight] -->
			<li><a href="#tabSettings"><?php if(array_key_exists('lblSettings', (array) $this->variables)) { echo SpoonFilter::ucfirst($this->variables['lblSettings']); } else { ?>{$lblSettings|ucfirst}<?php } ?></a></li>
			<li><a href="#tabRedirect"><?php if(array_key_exists('lblRedirect', (array) $this->variables)) { echo SpoonFilter::ucfirst($this->variables['lblRedirect']); } else { ?>{$lblRedirect|ucfirst}<?php } ?></a></li>
			<li><a href="#tabTags"><?php if(array_key_exists('lblTags', (array) $this->variables)) { echo SpoonFilter::ucfirst($this->variables['lblTags']); } else { ?>{$lblTags|ucfirst}<?php } ?></a></li>
			<li><a href="#tabSEO"><?php if(array_key_exists('lblSEO', (array) $this->variables)) { echo SpoonFilter::ucfirst($this->variables['lblSEO']); } else { ?>{$lblSEO|ucfirst}<?php } ?></a></li>
		</ul>

		<div id="tabContent" class="editTemplateTab">
			<div id="editTemplate">
				<div class="pageTitle">
					
					<h2><?php if(array_key_exists('lblTemplate', (array) $this->variables)) { echo SpoonFilter::ucfirst($this->variables['lblTemplate']); } else { ?>{$lblTemplate|ucfirst}<?php } ?>: <span id="tabTemplateLabel">&nbsp;</span></h2>
					<div class="buttonHolderRight">
						<a id="changeTemplate" href="#" class="button icon iconEdit">
							<span><?php if(array_key_exists('lblChangeTemplate', (array) $this->variables)) { echo SpoonFilter::ucfirst($this->variables['lblChangeTemplate']); } else { ?>{$lblChangeTemplate|ucfirst}<?php } ?></span>
						</a>
					</div>
				</div>

				<?php
					if(isset($this->variables['formErrors']) && count($this->variables['formErrors']) != 0 && $this->variables['formErrors'] != '' && $this->variables['formErrors'] !== false)
					{
						?><span class="formError"><?php if(array_key_exists('formErrors', (array) $this->variables)) { echo $this->variables['formErrors']; } else { ?>{$formErrors}<?php } ?></span><?php } ?>

				<div id="templateVisualFallback" style="display: none">
					<div id="fallback" class="generalMessage singleMessage infoMessage">
						<div id="fallbackInfo">
							<?php if(array_key_exists('msgFallbackInfo', (array) $this->variables)) { echo $this->variables['msgFallbackInfo']; } else { ?>{$msgFallbackInfo}<?php } ?>
						</div>

						<table cellspacing="10">
							<tbody>
								<tr>
									<td data-position="fallback" id="templatePosition-fallback" colspan="1" class="box">
										<div class="heading linkedBlocksTitle"><h3><?php if(array_key_exists('lblFallback', (array) $this->variables)) { echo SpoonFilter::ucfirst($this->variables['lblFallback']); } else { ?>{$lblFallback|ucfirst}<?php } ?></h3></div>
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
					if(!isset($this->variables['positions']))
					{
						?>{iteration:positions}<?php
						$this->variables['positions'] = array();
						$this->iterations['9bf6e36b1d9cefaae7d4865e516cb527_Add.tpl.php_1']['fail'] = true;
					}
				if(isset(${'positions'})) $this->iterations['9bf6e36b1d9cefaae7d4865e516cb527_Add.tpl.php_1']['old'] = ${'positions'};
				$this->iterations['9bf6e36b1d9cefaae7d4865e516cb527_Add.tpl.php_1']['iteration'] = $this->variables['positions'];
				$this->iterations['9bf6e36b1d9cefaae7d4865e516cb527_Add.tpl.php_1']['i'] = 1;
				$this->iterations['9bf6e36b1d9cefaae7d4865e516cb527_Add.tpl.php_1']['count'] = count($this->iterations['9bf6e36b1d9cefaae7d4865e516cb527_Add.tpl.php_1']['iteration']);
				foreach((array) $this->iterations['9bf6e36b1d9cefaae7d4865e516cb527_Add.tpl.php_1']['iteration'] as ${'positions'})
				{
					if(!isset(${'positions'}['first']) && $this->iterations['9bf6e36b1d9cefaae7d4865e516cb527_Add.tpl.php_1']['i'] == 1) ${'positions'}['first'] = true;
					if(!isset(${'positions'}['last']) && $this->iterations['9bf6e36b1d9cefaae7d4865e516cb527_Add.tpl.php_1']['i'] == $this->iterations['9bf6e36b1d9cefaae7d4865e516cb527_Add.tpl.php_1']['count']) ${'positions'}['last'] = true;
					if(isset(${'positions'}['formElements']) && is_array(${'positions'}['formElements']))
					{
						foreach(${'positions'}['formElements'] as $name => $object)
						{
							${'positions'}[$name] = $object->parse();
							${'positions'}[$name .'Error'] = (is_callable(array($object, 'getErrors')) && $object->getErrors() != '') ? '<span class="formError">' . $object->getErrors() .'</span>' : '';
						}
					} ?>
					<?php
					if(!isset(${'positions'}['blocks']))
					{
						?>{iteration:positions->blocks}<?php
						${'positions'}['blocks'] = array();
						$this->iterations['9bf6e36b1d9cefaae7d4865e516cb527_Add.tpl.php_8']['blocks']['fail'] = true;
					}
				if(isset(${'positions'}['blocks'])) $this->iterations['9bf6e36b1d9cefaae7d4865e516cb527_Add.tpl.php_8']['blocks']['old'] = ${'positions'}['blocks'];
				$this->iterations['9bf6e36b1d9cefaae7d4865e516cb527_Add.tpl.php_8']['blocks']['iteration'] = ${'positions'}['blocks'];
				$this->iterations['9bf6e36b1d9cefaae7d4865e516cb527_Add.tpl.php_8']['blocks']['i'] = 1;
				$this->iterations['9bf6e36b1d9cefaae7d4865e516cb527_Add.tpl.php_8']['blocks']['count'] = count($this->iterations['9bf6e36b1d9cefaae7d4865e516cb527_Add.tpl.php_8']['blocks']['iteration']);
				foreach((array) $this->iterations['9bf6e36b1d9cefaae7d4865e516cb527_Add.tpl.php_8']['blocks']['iteration'] as ${'positions'}['blocks'])
				{
					if(!isset(${'positions'}['blocks']['first']) && $this->iterations['9bf6e36b1d9cefaae7d4865e516cb527_Add.tpl.php_8']['blocks']['i'] == 1) ${'positions'}['blocks']['first'] = true;
					if(!isset(${'positions'}['blocks']['last']) && $this->iterations['9bf6e36b1d9cefaae7d4865e516cb527_Add.tpl.php_8']['blocks']['i'] == $this->iterations['9bf6e36b1d9cefaae7d4865e516cb527_Add.tpl.php_8']['blocks']['count']) ${'positions'}['blocks']['last'] = true;
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
										<?php if(array_key_exists('msgContentSaveWarning', (array) $this->variables)) { echo $this->variables['msgContentSaveWarning']; } else { ?>{$msgContentSaveWarning}<?php } ?>
									</div>
									<div class="heading">
										<h3><?php if(array_key_exists('lblEditor', (array) $this->variables)) { echo SpoonFilter::ucfirst($this->variables['lblEditor']); } else { ?>{$lblEditor|ucfirst}<?php } ?></h3>
									</div>
									<?php if(isset(${'positions'}['blocks']) && array_key_exists('txtHTML', (array) ${'positions'}['blocks'])) { echo ${'positions'}['blocks']['txtHTML']; } else { ?>{$positions->blocks.txtHTML}<?php } ?>
									<?php if(isset(${'positions'}['blocks']) && array_key_exists('txtHTMLError', (array) ${'positions'}['blocks'])) { echo ${'positions'}['blocks']['txtHTMLError']; } else { ?>{$positions->blocks.txtHTMLError}<?php } ?>
								</fieldset>
							</div>

							
							<?php if(isset(${'positions'}['blocks']) && array_key_exists('hidExtraId', (array) ${'positions'}['blocks'])) { echo ${'positions'}['blocks']['hidExtraId']; } else { ?>{$positions->blocks.hidExtraId}<?php } ?>

							
							<?php if(isset(${'positions'}['blocks']) && array_key_exists('hidPosition', (array) ${'positions'}['blocks'])) { echo ${'positions'}['blocks']['hidPosition']; } else { ?>{$positions->blocks.hidPosition}<?php } ?>

							
							<div style="display: none"><?php if(isset(${'positions'}['blocks']) && array_key_exists('chkVisible', (array) ${'positions'}['blocks'])) { echo ${'positions'}['blocks']['chkVisible']; } else { ?>{$positions->blocks.chkVisible}<?php } ?></div>
						</div>
					<?php
					$this->iterations['9bf6e36b1d9cefaae7d4865e516cb527_Add.tpl.php_8']['blocks']['i']++;
				}
					if(isset($this->iterations['9bf6e36b1d9cefaae7d4865e516cb527_Add.tpl.php_8']['blocks']['fail']) && $this->iterations['9bf6e36b1d9cefaae7d4865e516cb527_Add.tpl.php_8']['blocks']['fail'] == true)
					{
						?>{/iteration:positions->blocks}<?php
					}
				if(isset($this->iterations['9bf6e36b1d9cefaae7d4865e516cb527_Add.tpl.php_8']['blocks']['old'])) ${'positions'}['blocks'] = $this->iterations['9bf6e36b1d9cefaae7d4865e516cb527_Add.tpl.php_8']['blocks']['old'];
				else unset($this->iterations['9bf6e36b1d9cefaae7d4865e516cb527_Add.tpl.php_8']['blocks']);
				?>
				<?php
					$this->iterations['9bf6e36b1d9cefaae7d4865e516cb527_Add.tpl.php_1']['i']++;
				}
					if(isset($this->iterations['9bf6e36b1d9cefaae7d4865e516cb527_Add.tpl.php_1']['fail']) && $this->iterations['9bf6e36b1d9cefaae7d4865e516cb527_Add.tpl.php_1']['fail'] == true)
					{
						?>{/iteration:positions}<?php
					}
				if(isset($this->iterations['9bf6e36b1d9cefaae7d4865e516cb527_Add.tpl.php_1']['old'])) ${'positions'} = $this->iterations['9bf6e36b1d9cefaae7d4865e516cb527_Add.tpl.php_1']['old'];
				else unset($this->iterations['9bf6e36b1d9cefaae7d4865e516cb527_Add.tpl.php_1']);
				?>
			</div>
		</div>

		<div id="tabSEO">
			<div class="subtleBox">
				<div class="heading">
					<h3><?php if(array_key_exists('lblTitles', (array) $this->variables)) { echo SpoonFilter::ucfirst($this->variables['lblTitles']); } else { ?>{$lblTitles|ucfirst}<?php } ?></h3>
				</div>
				<div class="options">
					<p>
						<label for="pageTitleOverwrite"><?php if(array_key_exists('lblPageTitle', (array) $this->variables)) { echo SpoonFilter::ucfirst($this->variables['lblPageTitle']); } else { ?>{$lblPageTitle|ucfirst}<?php } ?></label>
						<span class="helpTxt"><?php if(array_key_exists('msgHelpPageTitle', (array) $this->variables)) { echo $this->variables['msgHelpPageTitle']; } else { ?>{$msgHelpPageTitle}<?php } ?></span>
					</p>
					<ul class="inputList checkboxTextFieldCombo">
						<li>
							<?php if(array_key_exists('chkPageTitleOverwrite', (array) $this->variables)) { echo $this->variables['chkPageTitleOverwrite']; } else { ?>{$chkPageTitleOverwrite}<?php } ?>
							<label for="pageTitle" class="visuallyHidden"><?php if(array_key_exists('lblPageTitle', (array) $this->variables)) { echo SpoonFilter::ucfirst($this->variables['lblPageTitle']); } else { ?>{$lblPageTitle|ucfirst}<?php } ?></label>
							<?php if(array_key_exists('txtPageTitle', (array) $this->variables)) { echo $this->variables['txtPageTitle']; } else { ?>{$txtPageTitle}<?php } ?> <?php if(array_key_exists('txtPageTitleError', (array) $this->variables)) { echo $this->variables['txtPageTitleError']; } else { ?>{$txtPageTitleError}<?php } ?>
						</li>
					</ul>
					<p>
						<label for="navigationTitleOverwrite"><?php if(array_key_exists('lblNavigationTitle', (array) $this->variables)) { echo SpoonFilter::ucfirst($this->variables['lblNavigationTitle']); } else { ?>{$lblNavigationTitle|ucfirst}<?php } ?></label>
						<span class="helpTxt"><?php if(array_key_exists('msgHelpNavigationTitle', (array) $this->variables)) { echo $this->variables['msgHelpNavigationTitle']; } else { ?>{$msgHelpNavigationTitle}<?php } ?></span>
					</p>
					<ul class="inputList checkboxTextFieldCombo">
						<li>
							<?php if(array_key_exists('chkNavigationTitleOverwrite', (array) $this->variables)) { echo $this->variables['chkNavigationTitleOverwrite']; } else { ?>{$chkNavigationTitleOverwrite}<?php } ?>
							<label for="navigationTitle" class="visuallyHidden"><?php if(array_key_exists('lblNavigationTitle', (array) $this->variables)) { echo SpoonFilter::ucfirst($this->variables['lblNavigationTitle']); } else { ?>{$lblNavigationTitle|ucfirst}<?php } ?></label>
							<?php if(array_key_exists('txtNavigationTitle', (array) $this->variables)) { echo $this->variables['txtNavigationTitle']; } else { ?>{$txtNavigationTitle}<?php } ?> <?php if(array_key_exists('txtNavigationTitleError', (array) $this->variables)) { echo $this->variables['txtNavigationTitleError']; } else { ?>{$txtNavigationTitleError}<?php } ?>
						</li>
					</ul>
				</div>
			</div>

			<div id="seoMeta" class="subtleBox">
				<div class="heading">
					<h3><?php if(array_key_exists('lblMetaInformation', (array) $this->variables)) { echo SpoonFilter::ucfirst($this->variables['lblMetaInformation']); } else { ?>{$lblMetaInformation|ucfirst}<?php } ?></h3>
				</div>
				<div class="options">
					<p>
						<label for="metaDescriptionOverwrite"><?php if(array_key_exists('lblDescription', (array) $this->variables)) { echo SpoonFilter::ucfirst($this->variables['lblDescription']); } else { ?>{$lblDescription|ucfirst}<?php } ?></label>
						<span class="helpTxt"><?php if(array_key_exists('msgHelpMetaDescription', (array) $this->variables)) { echo $this->variables['msgHelpMetaDescription']; } else { ?>{$msgHelpMetaDescription}<?php } ?></span>
					</p>
					<ul class="inputList checkboxTextFieldCombo">
						<li>
							<?php if(array_key_exists('chkMetaDescriptionOverwrite', (array) $this->variables)) { echo $this->variables['chkMetaDescriptionOverwrite']; } else { ?>{$chkMetaDescriptionOverwrite}<?php } ?>
							<label for="metaDescription" class="visuallyHidden"><?php if(array_key_exists('lblDescription', (array) $this->variables)) { echo SpoonFilter::ucfirst($this->variables['lblDescription']); } else { ?>{$lblDescription|ucfirst}<?php } ?></label>
							<?php if(array_key_exists('txtMetaDescription', (array) $this->variables)) { echo $this->variables['txtMetaDescription']; } else { ?>{$txtMetaDescription}<?php } ?> <?php if(array_key_exists('txtMetaDescriptionError', (array) $this->variables)) { echo $this->variables['txtMetaDescriptionError']; } else { ?>{$txtMetaDescriptionError}<?php } ?>
						</li>
					</ul>
					<p>
						<label for="metaKeywordsOverwrite"><?php if(array_key_exists('lblKeywords', (array) $this->variables)) { echo SpoonFilter::ucfirst($this->variables['lblKeywords']); } else { ?>{$lblKeywords|ucfirst}<?php } ?></label>
						<span class="helpTxt"><?php if(array_key_exists('msgHelpMetaKeywords', (array) $this->variables)) { echo $this->variables['msgHelpMetaKeywords']; } else { ?>{$msgHelpMetaKeywords}<?php } ?></span>
					</p>
					<ul class="inputList checkboxTextFieldCombo">
						<li>
							<?php if(array_key_exists('chkMetaKeywordsOverwrite', (array) $this->variables)) { echo $this->variables['chkMetaKeywordsOverwrite']; } else { ?>{$chkMetaKeywordsOverwrite}<?php } ?>
							<label for="metaKeywords" class="visuallyHidden"><?php if(array_key_exists('lblKeywords', (array) $this->variables)) { echo SpoonFilter::ucfirst($this->variables['lblKeywords']); } else { ?>{$lblKeywords|ucfirst}<?php } ?></label>
							<?php if(array_key_exists('txtMetaKeywords', (array) $this->variables)) { echo $this->variables['txtMetaKeywords']; } else { ?>{$txtMetaKeywords}<?php } ?> <?php if(array_key_exists('txtMetaKeywordsError', (array) $this->variables)) { echo $this->variables['txtMetaKeywordsError']; } else { ?>{$txtMetaKeywordsError}<?php } ?>
						</li>
					</ul>
					<div class="textareaHolder">
						<p>
							<label for="metaCustom"><?php if(array_key_exists('lblExtraMetaTags', (array) $this->variables)) { echo SpoonFilter::ucfirst($this->variables['lblExtraMetaTags']); } else { ?>{$lblExtraMetaTags|ucfirst}<?php } ?></label>
							<span class="helpTxt"><?php if(array_key_exists('msgHelpMetaCustom', (array) $this->variables)) { echo $this->variables['msgHelpMetaCustom']; } else { ?>{$msgHelpMetaCustom}<?php } ?></span>
						</p>
						<?php if(array_key_exists('txtMetaCustom', (array) $this->variables)) { echo $this->variables['txtMetaCustom']; } else { ?>{$txtMetaCustom}<?php } ?> <?php if(array_key_exists('txtMetaCustomError', (array) $this->variables)) { echo $this->variables['txtMetaCustomError']; } else { ?>{$txtMetaCustomError}<?php } ?>
					</div>
				</div>
			</div>

			<div class="subtleBox">
				<div class="heading">
					<h3><?php if(array_key_exists('lblURL', (array) $this->variables)) { echo $this->variables['lblURL']; } else { ?>{$lblURL}<?php } ?></h3>
				</div>
				<div class="options">
					<p>
						<label for="urlOverwrite"><?php if(array_key_exists('lblCustomURL', (array) $this->variables)) { echo SpoonFilter::ucfirst($this->variables['lblCustomURL']); } else { ?>{$lblCustomURL|ucfirst}<?php } ?></label>
						<span class="helpTxt"><?php if(array_key_exists('msgHelpMetaURL', (array) $this->variables)) { echo $this->variables['msgHelpMetaURL']; } else { ?>{$msgHelpMetaURL}<?php } ?></span>
					</p>
					<ul class="inputList checkboxTextFieldCombo">
						<li>
							<?php if(array_key_exists('chkUrlOverwrite', (array) $this->variables)) { echo $this->variables['chkUrlOverwrite']; } else { ?>{$chkUrlOverwrite}<?php } ?>
							<label for="url" class="visuallyHidden"><?php if(array_key_exists('lblCustomURL', (array) $this->variables)) { echo SpoonFilter::ucfirst($this->variables['lblCustomURL']); } else { ?>{$lblCustomURL|ucfirst}<?php } ?></label>
							<span id="urlFirstPart"><?php if(array_key_exists('SITE_URL', (array) $this->variables)) { echo $this->variables['SITE_URL']; } else { ?>{$SITE_URL}<?php } ?><?php if(array_key_exists('prefixURL', (array) $this->variables)) { echo $this->variables['prefixURL']; } else { ?>{$prefixURL}<?php } ?></span><?php if(array_key_exists('txtUrl', (array) $this->variables)) { echo $this->variables['txtUrl']; } else { ?>{$txtUrl}<?php } ?> <?php if(array_key_exists('txtUrlError', (array) $this->variables)) { echo $this->variables['txtUrlError']; } else { ?>{$txtUrlError}<?php } ?>
						</li>
					</ul>
				</div>
			</div>

			<div class="subtleBox">
				<div class="heading">
					<h3><?php if(array_key_exists('lblSEO', (array) $this->variables)) { echo SpoonTemplateModifiers::uppercase($this->variables['lblSEO']); } else { ?>{$lblSEO|uppercase}<?php } ?></h3>
				</div>
				<div class="options">
					<p class="label"><?php if(array_key_exists('lblIndex', (array) $this->variables)) { echo $this->variables['lblIndex']; } else { ?>{$lblIndex}<?php } ?></p>
					<?php if(array_key_exists('rbtSeoIndexError', (array) $this->variables)) { echo $this->variables['rbtSeoIndexError']; } else { ?>{$rbtSeoIndexError}<?php } ?>
					<ul class="inputList inputListHorizontal">
						<?php
					if(!isset($this->variables['seo_index']))
					{
						?>{iteration:seo_index}<?php
						$this->variables['seo_index'] = array();
						$this->iterations['9bf6e36b1d9cefaae7d4865e516cb527_Add.tpl.php_2']['fail'] = true;
					}
				if(isset(${'seo_index'})) $this->iterations['9bf6e36b1d9cefaae7d4865e516cb527_Add.tpl.php_2']['old'] = ${'seo_index'};
				$this->iterations['9bf6e36b1d9cefaae7d4865e516cb527_Add.tpl.php_2']['iteration'] = $this->variables['seo_index'];
				$this->iterations['9bf6e36b1d9cefaae7d4865e516cb527_Add.tpl.php_2']['i'] = 1;
				$this->iterations['9bf6e36b1d9cefaae7d4865e516cb527_Add.tpl.php_2']['count'] = count($this->iterations['9bf6e36b1d9cefaae7d4865e516cb527_Add.tpl.php_2']['iteration']);
				foreach((array) $this->iterations['9bf6e36b1d9cefaae7d4865e516cb527_Add.tpl.php_2']['iteration'] as ${'seo_index'})
				{
					if(!isset(${'seo_index'}['first']) && $this->iterations['9bf6e36b1d9cefaae7d4865e516cb527_Add.tpl.php_2']['i'] == 1) ${'seo_index'}['first'] = true;
					if(!isset(${'seo_index'}['last']) && $this->iterations['9bf6e36b1d9cefaae7d4865e516cb527_Add.tpl.php_2']['i'] == $this->iterations['9bf6e36b1d9cefaae7d4865e516cb527_Add.tpl.php_2']['count']) ${'seo_index'}['last'] = true;
					if(isset(${'seo_index'}['formElements']) && is_array(${'seo_index'}['formElements']))
					{
						foreach(${'seo_index'}['formElements'] as $name => $object)
						{
							${'seo_index'}[$name] = $object->parse();
							${'seo_index'}[$name .'Error'] = (is_callable(array($object, 'getErrors')) && $object->getErrors() != '') ? '<span class="formError">' . $object->getErrors() .'</span>' : '';
						}
					} ?>
							<li><label for="<?php if(array_key_exists('id', (array) ${'seo_index'})) { echo ${'seo_index'}['id']; } else { ?>{$seo_index->id}<?php } ?>"><?php if(array_key_exists('rbtSeoIndex', (array) ${'seo_index'})) { echo ${'seo_index'}['rbtSeoIndex']; } else { ?>{$seo_index->rbtSeoIndex}<?php } ?> <?php if(array_key_exists('label', (array) ${'seo_index'})) { echo ${'seo_index'}['label']; } else { ?>{$seo_index->label}<?php } ?></label></li>
						<?php
					$this->iterations['9bf6e36b1d9cefaae7d4865e516cb527_Add.tpl.php_2']['i']++;
				}
					if(isset($this->iterations['9bf6e36b1d9cefaae7d4865e516cb527_Add.tpl.php_2']['fail']) && $this->iterations['9bf6e36b1d9cefaae7d4865e516cb527_Add.tpl.php_2']['fail'] == true)
					{
						?>{/iteration:seo_index}<?php
					}
				if(isset($this->iterations['9bf6e36b1d9cefaae7d4865e516cb527_Add.tpl.php_2']['old'])) ${'seo_index'} = $this->iterations['9bf6e36b1d9cefaae7d4865e516cb527_Add.tpl.php_2']['old'];
				else unset($this->iterations['9bf6e36b1d9cefaae7d4865e516cb527_Add.tpl.php_2']);
				?>
					</ul>
					<p class="label"><?php if(array_key_exists('lblFollow', (array) $this->variables)) { echo $this->variables['lblFollow']; } else { ?>{$lblFollow}<?php } ?></p>
					<?php if(array_key_exists('rbtSeoFollowError', (array) $this->variables)) { echo $this->variables['rbtSeoFollowError']; } else { ?>{$rbtSeoFollowError}<?php } ?>
					<ul class="inputList inputListHorizontal">
						<?php
					if(!isset($this->variables['seo_follow']))
					{
						?>{iteration:seo_follow}<?php
						$this->variables['seo_follow'] = array();
						$this->iterations['9bf6e36b1d9cefaae7d4865e516cb527_Add.tpl.php_3']['fail'] = true;
					}
				if(isset(${'seo_follow'})) $this->iterations['9bf6e36b1d9cefaae7d4865e516cb527_Add.tpl.php_3']['old'] = ${'seo_follow'};
				$this->iterations['9bf6e36b1d9cefaae7d4865e516cb527_Add.tpl.php_3']['iteration'] = $this->variables['seo_follow'];
				$this->iterations['9bf6e36b1d9cefaae7d4865e516cb527_Add.tpl.php_3']['i'] = 1;
				$this->iterations['9bf6e36b1d9cefaae7d4865e516cb527_Add.tpl.php_3']['count'] = count($this->iterations['9bf6e36b1d9cefaae7d4865e516cb527_Add.tpl.php_3']['iteration']);
				foreach((array) $this->iterations['9bf6e36b1d9cefaae7d4865e516cb527_Add.tpl.php_3']['iteration'] as ${'seo_follow'})
				{
					if(!isset(${'seo_follow'}['first']) && $this->iterations['9bf6e36b1d9cefaae7d4865e516cb527_Add.tpl.php_3']['i'] == 1) ${'seo_follow'}['first'] = true;
					if(!isset(${'seo_follow'}['last']) && $this->iterations['9bf6e36b1d9cefaae7d4865e516cb527_Add.tpl.php_3']['i'] == $this->iterations['9bf6e36b1d9cefaae7d4865e516cb527_Add.tpl.php_3']['count']) ${'seo_follow'}['last'] = true;
					if(isset(${'seo_follow'}['formElements']) && is_array(${'seo_follow'}['formElements']))
					{
						foreach(${'seo_follow'}['formElements'] as $name => $object)
						{
							${'seo_follow'}[$name] = $object->parse();
							${'seo_follow'}[$name .'Error'] = (is_callable(array($object, 'getErrors')) && $object->getErrors() != '') ? '<span class="formError">' . $object->getErrors() .'</span>' : '';
						}
					} ?>
							<li><label for="<?php if(array_key_exists('id', (array) ${'seo_follow'})) { echo ${'seo_follow'}['id']; } else { ?>{$seo_follow->id}<?php } ?>"><?php if(array_key_exists('rbtSeoFollow', (array) ${'seo_follow'})) { echo ${'seo_follow'}['rbtSeoFollow']; } else { ?>{$seo_follow->rbtSeoFollow}<?php } ?> <?php if(array_key_exists('label', (array) ${'seo_follow'})) { echo ${'seo_follow'}['label']; } else { ?>{$seo_follow->label}<?php } ?></label></li>
						<?php
					$this->iterations['9bf6e36b1d9cefaae7d4865e516cb527_Add.tpl.php_3']['i']++;
				}
					if(isset($this->iterations['9bf6e36b1d9cefaae7d4865e516cb527_Add.tpl.php_3']['fail']) && $this->iterations['9bf6e36b1d9cefaae7d4865e516cb527_Add.tpl.php_3']['fail'] == true)
					{
						?>{/iteration:seo_follow}<?php
					}
				if(isset($this->iterations['9bf6e36b1d9cefaae7d4865e516cb527_Add.tpl.php_3']['old'])) ${'seo_follow'} = $this->iterations['9bf6e36b1d9cefaae7d4865e516cb527_Add.tpl.php_3']['old'];
				else unset($this->iterations['9bf6e36b1d9cefaae7d4865e516cb527_Add.tpl.php_3']);
				?>
					</ul>
				</div>
			</div>

			
			<?php if(array_key_exists('hidMetaId', (array) $this->variables)) { echo $this->variables['hidMetaId']; } else { ?>{$hidMetaId}<?php } ?>
			<?php if(array_key_exists('hidBaseFieldName', (array) $this->variables)) { echo $this->variables['hidBaseFieldName']; } else { ?>{$hidBaseFieldName}<?php } ?>
			<?php if(array_key_exists('hidCustom', (array) $this->variables)) { echo $this->variables['hidCustom']; } else { ?>{$hidCustom}<?php } ?>
			<?php if(array_key_exists('hidClassName', (array) $this->variables)) { echo $this->variables['hidClassName']; } else { ?>{$hidClassName}<?php } ?>
			<?php if(array_key_exists('hidMethodName', (array) $this->variables)) { echo $this->variables['hidMethodName']; } else { ?>{$hidMethodName}<?php } ?>
			<?php if(array_key_exists('hidParameters', (array) $this->variables)) { echo $this->variables['hidParameters']; } else { ?>{$hidParameters}<?php } ?>
		</div>

		<div id="tabTags">
			<div class="subtleBox">
				<div class="heading">
					<h3>
						<label for="addValue-tags"><?php if(array_key_exists('lblTags', (array) $this->variables)) { echo SpoonFilter::ucfirst($this->variables['lblTags']); } else { ?>{$lblTags|ucfirst}<?php } ?></label>
					</h3>
				</div>
				<div class="options">
					<?php if(array_key_exists('txtTags', (array) $this->variables)) { echo $this->variables['txtTags']; } else { ?>{$txtTags}<?php } ?> <?php if(array_key_exists('txtTagsError', (array) $this->variables)) { echo $this->variables['txtTagsError']; } else { ?>{$txtTagsError}<?php } ?>
				</div>
			</div>
		</div>

		<div id="tabRedirect">
			<div class="subtleBox">
				<div class="heading">
					<h3>Redirect</h3>
				</div>
				<div class="options">
					<?php if(array_key_exists('rbtRedirectError', (array) $this->variables)) { echo $this->variables['rbtRedirectError']; } else { ?>{$rbtRedirectError}<?php } ?>
					<ul class="inputList radiobuttonFieldCombo">
						<?php
					if(!isset($this->variables['redirect']))
					{
						?>{iteration:redirect}<?php
						$this->variables['redirect'] = array();
						$this->iterations['9bf6e36b1d9cefaae7d4865e516cb527_Add.tpl.php_4']['fail'] = true;
					}
				if(isset(${'redirect'})) $this->iterations['9bf6e36b1d9cefaae7d4865e516cb527_Add.tpl.php_4']['old'] = ${'redirect'};
				$this->iterations['9bf6e36b1d9cefaae7d4865e516cb527_Add.tpl.php_4']['iteration'] = $this->variables['redirect'];
				$this->iterations['9bf6e36b1d9cefaae7d4865e516cb527_Add.tpl.php_4']['i'] = 1;
				$this->iterations['9bf6e36b1d9cefaae7d4865e516cb527_Add.tpl.php_4']['count'] = count($this->iterations['9bf6e36b1d9cefaae7d4865e516cb527_Add.tpl.php_4']['iteration']);
				foreach((array) $this->iterations['9bf6e36b1d9cefaae7d4865e516cb527_Add.tpl.php_4']['iteration'] as ${'redirect'})
				{
					if(!isset(${'redirect'}['first']) && $this->iterations['9bf6e36b1d9cefaae7d4865e516cb527_Add.tpl.php_4']['i'] == 1) ${'redirect'}['first'] = true;
					if(!isset(${'redirect'}['last']) && $this->iterations['9bf6e36b1d9cefaae7d4865e516cb527_Add.tpl.php_4']['i'] == $this->iterations['9bf6e36b1d9cefaae7d4865e516cb527_Add.tpl.php_4']['count']) ${'redirect'}['last'] = true;
					if(isset(${'redirect'}['formElements']) && is_array(${'redirect'}['formElements']))
					{
						foreach(${'redirect'}['formElements'] as $name => $object)
						{
							${'redirect'}[$name] = $object->parse();
							${'redirect'}[$name .'Error'] = (is_callable(array($object, 'getErrors')) && $object->getErrors() != '') ? '<span class="formError">' . $object->getErrors() .'</span>' : '';
						}
					} ?>
							<li>
								<label for="<?php if(array_key_exists('id', (array) ${'redirect'})) { echo ${'redirect'}['id']; } else { ?>{$redirect->id}<?php } ?>"><?php if(array_key_exists('rbtRedirect', (array) ${'redirect'})) { echo ${'redirect'}['rbtRedirect']; } else { ?>{$redirect->rbtRedirect}<?php } ?> <?php if(array_key_exists('label', (array) ${'redirect'})) { echo ${'redirect'}['label']; } else { ?>{$redirect->label}<?php } ?></label>
								<?php
					if(isset(${'redirect'}['isInternal']) && count(${'redirect'}['isInternal']) != 0 && ${'redirect'}['isInternal'] != '' && ${'redirect'}['isInternal'] !== false)
					{
						?>
										<label for="internalRedirect" class="visuallyHidden"><?php if(array_key_exists('label', (array) ${'redirect'})) { echo ${'redirect'}['label']; } else { ?>{$redirect->label}<?php } ?></label>
										<?php if(array_key_exists('ddmInternalRedirect', (array) $this->variables)) { echo $this->variables['ddmInternalRedirect']; } else { ?>{$ddmInternalRedirect}<?php } ?> <?php if(array_key_exists('ddmInternalRedirectError', (array) $this->variables)) { echo $this->variables['ddmInternalRedirectError']; } else { ?>{$ddmInternalRedirectError}<?php } ?>
										<span class="helpTxt"><?php if(array_key_exists('msgHelpInternalRedirect', (array) $this->variables)) { echo $this->variables['msgHelpInternalRedirect']; } else { ?>{$msgHelpInternalRedirect}<?php } ?></span>
								<?php } ?>

								<?php
					if(isset(${'redirect'}['isExternal']) && count(${'redirect'}['isExternal']) != 0 && ${'redirect'}['isExternal'] != '' && ${'redirect'}['isExternal'] !== false)
					{
						?>
										<label for="externalRedirect" class="visuallyHidden"><?php if(array_key_exists('label', (array) ${'redirect'})) { echo ${'redirect'}['label']; } else { ?>{$redirect->label}<?php } ?></label>
										<?php if(array_key_exists('txtExternalRedirect', (array) $this->variables)) { echo $this->variables['txtExternalRedirect']; } else { ?>{$txtExternalRedirect}<?php } ?> <?php if(array_key_exists('txtExternalRedirectError', (array) $this->variables)) { echo $this->variables['txtExternalRedirectError']; } else { ?>{$txtExternalRedirectError}<?php } ?>
										<span class="helpTxt"><?php if(array_key_exists('msgHelpExternalRedirect', (array) $this->variables)) { echo $this->variables['msgHelpExternalRedirect']; } else { ?>{$msgHelpExternalRedirect}<?php } ?></span>
								<?php } ?>
							</li>
						<?php
					$this->iterations['9bf6e36b1d9cefaae7d4865e516cb527_Add.tpl.php_4']['i']++;
				}
					if(isset($this->iterations['9bf6e36b1d9cefaae7d4865e516cb527_Add.tpl.php_4']['fail']) && $this->iterations['9bf6e36b1d9cefaae7d4865e516cb527_Add.tpl.php_4']['fail'] == true)
					{
						?>{/iteration:redirect}<?php
					}
				if(isset($this->iterations['9bf6e36b1d9cefaae7d4865e516cb527_Add.tpl.php_4']['old'])) ${'redirect'} = $this->iterations['9bf6e36b1d9cefaae7d4865e516cb527_Add.tpl.php_4']['old'];
				else unset($this->iterations['9bf6e36b1d9cefaae7d4865e516cb527_Add.tpl.php_4']);
				?>
					</ul>
				</div>
			</div>
		</div>

		<div id="tabSettings">
			<div class="subtleBox">
				<div class="heading">
					<h3>Settings</h3>
				</div>
				<div class="options">
					<ul class="inputList">
						<?php
					if(!isset($this->variables['hidden']))
					{
						?>{iteration:hidden}<?php
						$this->variables['hidden'] = array();
						$this->iterations['9bf6e36b1d9cefaae7d4865e516cb527_Add.tpl.php_5']['fail'] = true;
					}
				if(isset(${'hidden'})) $this->iterations['9bf6e36b1d9cefaae7d4865e516cb527_Add.tpl.php_5']['old'] = ${'hidden'};
				$this->iterations['9bf6e36b1d9cefaae7d4865e516cb527_Add.tpl.php_5']['iteration'] = $this->variables['hidden'];
				$this->iterations['9bf6e36b1d9cefaae7d4865e516cb527_Add.tpl.php_5']['i'] = 1;
				$this->iterations['9bf6e36b1d9cefaae7d4865e516cb527_Add.tpl.php_5']['count'] = count($this->iterations['9bf6e36b1d9cefaae7d4865e516cb527_Add.tpl.php_5']['iteration']);
				foreach((array) $this->iterations['9bf6e36b1d9cefaae7d4865e516cb527_Add.tpl.php_5']['iteration'] as ${'hidden'})
				{
					if(!isset(${'hidden'}['first']) && $this->iterations['9bf6e36b1d9cefaae7d4865e516cb527_Add.tpl.php_5']['i'] == 1) ${'hidden'}['first'] = true;
					if(!isset(${'hidden'}['last']) && $this->iterations['9bf6e36b1d9cefaae7d4865e516cb527_Add.tpl.php_5']['i'] == $this->iterations['9bf6e36b1d9cefaae7d4865e516cb527_Add.tpl.php_5']['count']) ${'hidden'}['last'] = true;
					if(isset(${'hidden'}['formElements']) && is_array(${'hidden'}['formElements']))
					{
						foreach(${'hidden'}['formElements'] as $name => $object)
						{
							${'hidden'}[$name] = $object->parse();
							${'hidden'}[$name .'Error'] = (is_callable(array($object, 'getErrors')) && $object->getErrors() != '') ? '<span class="formError">' . $object->getErrors() .'</span>' : '';
						}
					} ?>
							<li><?php if(array_key_exists('rbtHidden', (array) ${'hidden'})) { echo ${'hidden'}['rbtHidden']; } else { ?>{$hidden->rbtHidden}<?php } ?> <label for="<?php if(array_key_exists('id', (array) ${'hidden'})) { echo ${'hidden'}['id']; } else { ?>{$hidden->id}<?php } ?>"><?php if(array_key_exists('label', (array) ${'hidden'})) { echo SpoonFilter::ucfirst(${'hidden'}['label']); } else { ?>{$hidden->label|ucfirst}<?php } ?></label></li>
						<?php
					$this->iterations['9bf6e36b1d9cefaae7d4865e516cb527_Add.tpl.php_5']['i']++;
				}
					if(isset($this->iterations['9bf6e36b1d9cefaae7d4865e516cb527_Add.tpl.php_5']['fail']) && $this->iterations['9bf6e36b1d9cefaae7d4865e516cb527_Add.tpl.php_5']['fail'] == true)
					{
						?>{/iteration:hidden}<?php
					}
				if(isset($this->iterations['9bf6e36b1d9cefaae7d4865e516cb527_Add.tpl.php_5']['old'])) ${'hidden'} = $this->iterations['9bf6e36b1d9cefaae7d4865e516cb527_Add.tpl.php_5']['old'];
				else unset($this->iterations['9bf6e36b1d9cefaae7d4865e516cb527_Add.tpl.php_5']);
				?>
					</ul>
					<p>
						<label for="isAction"><?php if(array_key_exists('chkIsAction', (array) $this->variables)) { echo $this->variables['chkIsAction']; } else { ?>{$chkIsAction}<?php } ?> <?php if(array_key_exists('msgIsAction', (array) $this->variables)) { echo $this->variables['msgIsAction']; } else { ?>{$msgIsAction}<?php } ?></label>
					</p>
					<?php
					if(isset($this->variables['isGod']) && count($this->variables['isGod']) != 0 && $this->variables['isGod'] != '' && $this->variables['isGod'] !== false)
					{
						?>
						<ul class="inputList">
							<?php
					if(!isset($this->variables['allow']))
					{
						?>{iteration:allow}<?php
						$this->variables['allow'] = array();
						$this->iterations['9bf6e36b1d9cefaae7d4865e516cb527_Add.tpl.php_6']['fail'] = true;
					}
				if(isset(${'allow'})) $this->iterations['9bf6e36b1d9cefaae7d4865e516cb527_Add.tpl.php_6']['old'] = ${'allow'};
				$this->iterations['9bf6e36b1d9cefaae7d4865e516cb527_Add.tpl.php_6']['iteration'] = $this->variables['allow'];
				$this->iterations['9bf6e36b1d9cefaae7d4865e516cb527_Add.tpl.php_6']['i'] = 1;
				$this->iterations['9bf6e36b1d9cefaae7d4865e516cb527_Add.tpl.php_6']['count'] = count($this->iterations['9bf6e36b1d9cefaae7d4865e516cb527_Add.tpl.php_6']['iteration']);
				foreach((array) $this->iterations['9bf6e36b1d9cefaae7d4865e516cb527_Add.tpl.php_6']['iteration'] as ${'allow'})
				{
					if(!isset(${'allow'}['first']) && $this->iterations['9bf6e36b1d9cefaae7d4865e516cb527_Add.tpl.php_6']['i'] == 1) ${'allow'}['first'] = true;
					if(!isset(${'allow'}['last']) && $this->iterations['9bf6e36b1d9cefaae7d4865e516cb527_Add.tpl.php_6']['i'] == $this->iterations['9bf6e36b1d9cefaae7d4865e516cb527_Add.tpl.php_6']['count']) ${'allow'}['last'] = true;
					if(isset(${'allow'}['formElements']) && is_array(${'allow'}['formElements']))
					{
						foreach(${'allow'}['formElements'] as $name => $object)
						{
							${'allow'}[$name] = $object->parse();
							${'allow'}[$name .'Error'] = (is_callable(array($object, 'getErrors')) && $object->getErrors() != '') ? '<span class="formError">' . $object->getErrors() .'</span>' : '';
						}
					} ?>
								<li><?php if(array_key_exists('chkAllow', (array) ${'allow'})) { echo ${'allow'}['chkAllow']; } else { ?>{$allow->chkAllow}<?php } ?> <label for="<?php if(array_key_exists('id', (array) ${'allow'})) { echo ${'allow'}['id']; } else { ?>{$allow->id}<?php } ?>"><?php if(array_key_exists('label', (array) ${'allow'})) { echo ${'allow'}['label']; } else { ?>{$allow->label}<?php } ?></label></li>
							<?php
					$this->iterations['9bf6e36b1d9cefaae7d4865e516cb527_Add.tpl.php_6']['i']++;
				}
					if(isset($this->iterations['9bf6e36b1d9cefaae7d4865e516cb527_Add.tpl.php_6']['fail']) && $this->iterations['9bf6e36b1d9cefaae7d4865e516cb527_Add.tpl.php_6']['fail'] == true)
					{
						?>{/iteration:allow}<?php
					}
				if(isset($this->iterations['9bf6e36b1d9cefaae7d4865e516cb527_Add.tpl.php_6']['old'])) ${'allow'} = $this->iterations['9bf6e36b1d9cefaae7d4865e516cb527_Add.tpl.php_6']['old'];
				else unset($this->iterations['9bf6e36b1d9cefaae7d4865e516cb527_Add.tpl.php_6']);
				?>
						</ul>
					<?php } ?>
				</div>
			</div>
		</div>
	</div>

	
	<div id="addBlock" class="forkForms" title="<?php if(array_key_exists('lblChooseContent', (array) $this->variables)) { echo SpoonFilter::ucfirst($this->variables['lblChooseContent']); } else { ?>{$lblChooseContent|ucfirst}<?php } ?>" style="display: none;">
		<input type="hidden" id="extraForBlock" name="extraForBlock" value="" />
		<div class="options horizontal">
			<p><?php if(array_key_exists('msgHelpBlockContent', (array) $this->variables)) { echo $this->variables['msgHelpBlockContent']; } else { ?>{$msgHelpBlockContent}<?php } ?></p>
			<p id="extraWarningAlreadyBlock">
				<span class="infoMessage"><?php if(array_key_exists('msgModuleBlockAlreadyLinked', (array) $this->variables)) { echo $this->variables['msgModuleBlockAlreadyLinked']; } else { ?>{$msgModuleBlockAlreadyLinked}<?php } ?></span>
			</p>
			<p id="extraWarningHomeNoBlock">
				<span class="infoMessage"><?php if(array_key_exists('msgHomeNoBlock', (array) $this->variables)) { echo $this->variables['msgHomeNoBlock']; } else { ?>{$msgHomeNoBlock}<?php } ?></span>
			</p>
			<p>
				<label for="extraType"><?php if(array_key_exists('lblType', (array) $this->variables)) { echo SpoonFilter::ucfirst($this->variables['lblType']); } else { ?>{$lblType|ucfirst}<?php } ?></label>
				<?php if(array_key_exists('ddmExtraType', (array) $this->variables)) { echo $this->variables['ddmExtraType']; } else { ?>{$ddmExtraType}<?php } ?>
			</p>
			<p id="extraModuleHolder" style="display: none;">
				<label for="extraModule"><?php if(array_key_exists('lblWhichModule', (array) $this->variables)) { echo SpoonFilter::ucfirst($this->variables['lblWhichModule']); } else { ?>{$lblWhichModule|ucfirst}<?php } ?></label>
				<select id="extraModule">
					<option value="-1">-</option>
				</select>
			</p>
			<p id="extraExtraIdHolder" style="display: none;">
				<label for="extraExtraId"><?php if(array_key_exists('lblWhichWidget', (array) $this->variables)) { echo SpoonFilter::ucfirst($this->variables['lblWhichWidget']); } else { ?>{$lblWhichWidget|ucfirst}<?php } ?></label>
				<select id="extraExtraId">
					<option value="-1">-</option>
				</select>
			</p>
		</div>
	</div>

	
	<div id="chooseTemplate" class="forkForms" title="<?php if(array_key_exists('lblChooseATemplate', (array) $this->variables)) { echo SpoonFilter::ucfirst($this->variables['lblChooseATemplate']); } else { ?>{$lblChooseATemplate|ucfirst}<?php } ?>" style="display: none;">
		<div class="generalMessage singleMessage infoMessage">
			<p><?php if(array_key_exists('msgTemplateChangeWarning', (array) $this->variables)) { echo $this->variables['msgTemplateChangeWarning']; } else { ?>{$msgTemplateChangeWarning}<?php } ?></p>
		</div>
		<div id="templateList">
			<ul>
				<?php
					if(!isset($this->variables['templates']))
					{
						?>{iteration:templates}<?php
						$this->variables['templates'] = array();
						$this->iterations['9bf6e36b1d9cefaae7d4865e516cb527_Add.tpl.php_9']['fail'] = true;
					}
				if(isset(${'templates'})) $this->iterations['9bf6e36b1d9cefaae7d4865e516cb527_Add.tpl.php_9']['old'] = ${'templates'};
				$this->iterations['9bf6e36b1d9cefaae7d4865e516cb527_Add.tpl.php_9']['iteration'] = $this->variables['templates'];
				$this->iterations['9bf6e36b1d9cefaae7d4865e516cb527_Add.tpl.php_9']['i'] = 1;
				$this->iterations['9bf6e36b1d9cefaae7d4865e516cb527_Add.tpl.php_9']['count'] = count($this->iterations['9bf6e36b1d9cefaae7d4865e516cb527_Add.tpl.php_9']['iteration']);
				foreach((array) $this->iterations['9bf6e36b1d9cefaae7d4865e516cb527_Add.tpl.php_9']['iteration'] as ${'templates'})
				{
					if(!isset(${'templates'}['first']) && $this->iterations['9bf6e36b1d9cefaae7d4865e516cb527_Add.tpl.php_9']['i'] == 1) ${'templates'}['first'] = true;
					if(!isset(${'templates'}['last']) && $this->iterations['9bf6e36b1d9cefaae7d4865e516cb527_Add.tpl.php_9']['i'] == $this->iterations['9bf6e36b1d9cefaae7d4865e516cb527_Add.tpl.php_9']['count']) ${'templates'}['last'] = true;
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
						<label for="template<?php if(array_key_exists('id', (array) ${'templates'})) { echo ${'templates'}['id']; } else { ?>{$templates->id}<?php } ?>"><input type="radio" id="template<?php if(array_key_exists('id', (array) ${'templates'})) { echo ${'templates'}['id']; } else { ?>{$templates->id}<?php } ?>" value="<?php if(array_key_exists('id', (array) ${'templates'})) { echo ${'templates'}['id']; } else { ?>{$templates->id}<?php } ?>" name="template_id_chooser" class="inputRadio"<?php
					if(isset(${'templates'}['checked']) && count(${'templates'}['checked']) != 0 && ${'templates'}['checked'] != '' && ${'templates'}['checked'] !== false)
					{
						?> checked="checked"<?php } ?><?php
					if(isset(${'templates'}['disabled']) && count(${'templates'}['disabled']) != 0 && ${'templates'}['disabled'] != '' && ${'templates'}['disabled'] !== false)
					{
						?> disabled="disabled"<?php } ?> /><?php if(array_key_exists('label', (array) ${'templates'})) { echo ${'templates'}['label']; } else { ?>{$templates->label}<?php } ?></label>
						<div class="templateVisual current">
							<?php if(array_key_exists('html', (array) ${'templates'})) { echo ${'templates'}['html']; } else { ?>{$templates->html}<?php } ?>
						</div>
					</li>
				<?php
					$this->iterations['9bf6e36b1d9cefaae7d4865e516cb527_Add.tpl.php_9']['i']++;
				}
					if(isset($this->iterations['9bf6e36b1d9cefaae7d4865e516cb527_Add.tpl.php_9']['fail']) && $this->iterations['9bf6e36b1d9cefaae7d4865e516cb527_Add.tpl.php_9']['fail'] == true)
					{
						?>{/iteration:templates}<?php
					}
				if(isset($this->iterations['9bf6e36b1d9cefaae7d4865e516cb527_Add.tpl.php_9']['old'])) ${'templates'} = $this->iterations['9bf6e36b1d9cefaae7d4865e516cb527_Add.tpl.php_9']['old'];
				else unset($this->iterations['9bf6e36b1d9cefaae7d4865e516cb527_Add.tpl.php_9']);
				?>
			</ul>
		</div>
	</div>

	
	<div id="confirmDeleteBlock" class="forkForms" title="<?php if(array_key_exists('lblDeleteBlock', (array) $this->variables)) { echo SpoonFilter::ucfirst($this->variables['lblDeleteBlock']); } else { ?>{$lblDeleteBlock|ucfirst}<?php } ?>" style="display: none;">
		<p><?php if(array_key_exists('msgConfirmDeleteBlock', (array) $this->variables)) { echo $this->variables['msgConfirmDeleteBlock']; } else { ?>{$msgConfirmDeleteBlock}<?php } ?></p>
	</div>

	
	<div id="pageButtons" class="fullwidthOptions">
		<div class="buttonHolderRight">
			<input id="addButton" class="button mainButton" type="submit" name="add" value="<?php if(array_key_exists('lblAdd', (array) $this->variables)) { echo SpoonFilter::ucfirst($this->variables['lblAdd']); } else { ?>{$lblAdd|ucfirst}<?php } ?>" />
			<a href="#" id="saveAsDraft" class="inputButton button"><span><?php if(array_key_exists('lblSaveDraft', (array) $this->variables)) { echo SpoonFilter::ucfirst($this->variables['lblSaveDraft']); } else { ?>{$lblSaveDraft|ucfirst}<?php } ?></span></a>
		</div>
	</div>
</form>
				<?php } ?>

<div class="box" id="blockHtml" style="display: none;">
	<div class="blockContentHTML optionsRTE">
		<fieldset>
			<div class="generalMessage singleMessage infoMessage">
				<?php if(array_key_exists('msgContentSaveWarning', (array) $this->variables)) { echo $this->variables['msgContentSaveWarning']; } else { ?>{$msgContentSaveWarning}<?php } ?>
			</div>
			<div class="heading">
				<h3><?php if(array_key_exists('lblEditor', (array) $this->variables)) { echo SpoonFilter::ucfirst($this->variables['lblEditor']); } else { ?>{$lblEditor|ucfirst}<?php } ?></h3>
			</div>
			<?php if(array_key_exists('txtHtml', (array) $this->variables)) { echo $this->variables['txtHtml']; } else { ?>{$txtHtml}<?php } ?>
			<?php if(array_key_exists('txtHtmlError', (array) $this->variables)) { echo $this->variables['txtHtmlError']; } else { ?>{$txtHtmlError}<?php } ?>
		</fieldset>
	</div>
</div>

<script type="text/javascript">
	//<![CDATA[
		// all the possible templates
		var templates = {};
		<?php
					if(!isset($this->variables['templates']))
					{
						?>{iteration:templates}<?php
						$this->variables['templates'] = array();
						$this->iterations['9bf6e36b1d9cefaae7d4865e516cb527_Add.tpl.php_7']['fail'] = true;
					}
				if(isset(${'templates'})) $this->iterations['9bf6e36b1d9cefaae7d4865e516cb527_Add.tpl.php_7']['old'] = ${'templates'};
				$this->iterations['9bf6e36b1d9cefaae7d4865e516cb527_Add.tpl.php_7']['iteration'] = $this->variables['templates'];
				$this->iterations['9bf6e36b1d9cefaae7d4865e516cb527_Add.tpl.php_7']['i'] = 1;
				$this->iterations['9bf6e36b1d9cefaae7d4865e516cb527_Add.tpl.php_7']['count'] = count($this->iterations['9bf6e36b1d9cefaae7d4865e516cb527_Add.tpl.php_7']['iteration']);
				foreach((array) $this->iterations['9bf6e36b1d9cefaae7d4865e516cb527_Add.tpl.php_7']['iteration'] as ${'templates'})
				{
					if(!isset(${'templates'}['first']) && $this->iterations['9bf6e36b1d9cefaae7d4865e516cb527_Add.tpl.php_7']['i'] == 1) ${'templates'}['first'] = true;
					if(!isset(${'templates'}['last']) && $this->iterations['9bf6e36b1d9cefaae7d4865e516cb527_Add.tpl.php_7']['i'] == $this->iterations['9bf6e36b1d9cefaae7d4865e516cb527_Add.tpl.php_7']['count']) ${'templates'}['last'] = true;
					if(isset(${'templates'}['formElements']) && is_array(${'templates'}['formElements']))
					{
						foreach(${'templates'}['formElements'] as $name => $object)
						{
							${'templates'}[$name] = $object->parse();
							${'templates'}[$name .'Error'] = (is_callable(array($object, 'getErrors')) && $object->getErrors() != '') ? '<span class="formError">' . $object->getErrors() .'</span>' : '';
						}
					} ?>templates[<?php if(array_key_exists('id', (array) ${'templates'})) { echo ${'templates'}['id']; } else { ?>{$templates->id}<?php } ?>] = <?php if(array_key_exists('json', (array) ${'templates'})) { echo ${'templates'}['json']; } else { ?>{$templates->json}<?php } ?>;<?php
					$this->iterations['9bf6e36b1d9cefaae7d4865e516cb527_Add.tpl.php_7']['i']++;
				}
					if(isset($this->iterations['9bf6e36b1d9cefaae7d4865e516cb527_Add.tpl.php_7']['fail']) && $this->iterations['9bf6e36b1d9cefaae7d4865e516cb527_Add.tpl.php_7']['fail'] == true)
					{
						?>{/iteration:templates}<?php
					}
				if(isset($this->iterations['9bf6e36b1d9cefaae7d4865e516cb527_Add.tpl.php_7']['old'])) ${'templates'} = $this->iterations['9bf6e36b1d9cefaae7d4865e516cb527_Add.tpl.php_7']['old'];
				else unset($this->iterations['9bf6e36b1d9cefaae7d4865e516cb527_Add.tpl.php_7']);
				?>

		// the data for the extra's
		var extrasData = {};
		<?php
					if(isset($this->variables['extrasData']) && count($this->variables['extrasData']) != 0 && $this->variables['extrasData'] != '' && $this->variables['extrasData'] !== false)
					{
						?>extrasData = <?php if(array_key_exists('extrasData', (array) $this->variables)) { echo $this->variables['extrasData']; } else { ?>{$extrasData}<?php } ?>;<?php } ?>

		// the extra's, but in a way we can access them based on their ID
		var extrasById = {};
		<?php
					if(isset($this->variables['extrasById']) && count($this->variables['extrasById']) != 0 && $this->variables['extrasById'] != '' && $this->variables['extrasById'] !== false)
					{
						?>extrasById = <?php if(array_key_exists('extrasById', (array) $this->variables)) { echo $this->variables['extrasById']; } else { ?>{$extrasById}<?php } ?>;<?php } ?>

		// indicator that the default blocks may be set on pageload
		var initDefaults = true;
	//]]>
</script>

<?php
				ob_start();
				?><?php if(array_key_exists('BACKEND_MODULES_PATH', (array) $this->variables)) { echo $this->variables['BACKEND_MODULES_PATH']; } else { ?>{$BACKEND_MODULES_PATH}<?php } ?>/Pages/Layout/Templates/StructureEnd.tpl<?php
				$include = eval('return \'' . str_replace('\'', '\\\'', ob_get_clean()) .'\';');
				if($this->getForceCompile() || !file_exists($this->getCompileDirectory() .'/' . $this->getCompileName($include, 'J:\home\technomir.com\www\src\Backend\Modules\Pages\Layout\Templates'))) $this->compile('J:\home\technomir.com\www\src\Backend\Modules\Pages\Layout\Templates', $include);
				$return = @include $this->getCompileDirectory() .'/' . $this->getCompileName($include, 'J:\home\technomir.com\www\src\Backend\Modules\Pages\Layout\Templates');
				if($return === false && $this->compile('J:\home\technomir.com\www\src\Backend\Modules\Pages\Layout\Templates', $include))
				{
					$return = @include $this->getCompileDirectory() .'/' . $this->getCompileName($include, 'J:\home\technomir.com\www\src\Backend\Modules\Pages\Layout\Templates');
				}
if($return === false)
				{
					?>{include:<?php if(array_key_exists('BACKEND_MODULES_PATH', (array) $this->variables)) { echo $this->variables['BACKEND_MODULES_PATH']; } else { ?>{$BACKEND_MODULES_PATH}<?php } ?>/Pages/Layout/Templates/StructureEnd.tpl}<?php
				}
?>
<?php
				ob_start();
				?><?php if(array_key_exists('BACKEND_CORE_PATH', (array) $this->variables)) { echo $this->variables['BACKEND_CORE_PATH']; } else { ?>{$BACKEND_CORE_PATH}<?php } ?>/Layout/Templates/Footer.tpl<?php
				$include = eval('return \'' . str_replace('\'', '\\\'', ob_get_clean()) .'\';');
				if($this->getForceCompile() || !file_exists($this->getCompileDirectory() .'/' . $this->getCompileName($include, 'J:\home\technomir.com\www\src\Backend\Modules\Pages\Layout\Templates'))) $this->compile('J:\home\technomir.com\www\src\Backend\Modules\Pages\Layout\Templates', $include);
				$return = @include $this->getCompileDirectory() .'/' . $this->getCompileName($include, 'J:\home\technomir.com\www\src\Backend\Modules\Pages\Layout\Templates');
				if($return === false && $this->compile('J:\home\technomir.com\www\src\Backend\Modules\Pages\Layout\Templates', $include))
				{
					$return = @include $this->getCompileDirectory() .'/' . $this->getCompileName($include, 'J:\home\technomir.com\www\src\Backend\Modules\Pages\Layout\Templates');
				}
if($return === false)
				{
					?>{include:<?php if(array_key_exists('BACKEND_CORE_PATH', (array) $this->variables)) { echo $this->variables['BACKEND_CORE_PATH']; } else { ?>{$BACKEND_CORE_PATH}<?php } ?>/Layout/Templates/Footer.tpl}<?php
				}
?>
