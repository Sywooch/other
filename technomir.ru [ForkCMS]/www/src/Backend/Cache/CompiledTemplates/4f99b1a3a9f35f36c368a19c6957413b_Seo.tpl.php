<?php error_reporting(E_ALL | E_STRICT); ini_set('display_errors', 'On'); ?>
<div id="seoMeta" class="subtleBox">
	<div class="heading">
		<h3><?php if(array_key_exists('lblMetaInformation', (array) $this->variables)) { echo SpoonFilter::ucfirst($this->variables['lblMetaInformation']); } else { ?>{$lblMetaInformation|ucfirst}<?php } ?></h3>
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
		<?php
					if(isset($this->variables['txtMetaCustom']) && count($this->variables['txtMetaCustom']) != 0 && $this->variables['txtMetaCustom'] != '' && $this->variables['txtMetaCustom'] !== false)
					{
						?>
			<div class="textareaHolder">
				<p>
					<label for="metaCustom"><?php if(array_key_exists('lblExtraMetaTags', (array) $this->variables)) { echo SpoonFilter::ucfirst($this->variables['lblExtraMetaTags']); } else { ?>{$lblExtraMetaTags|ucfirst}<?php } ?></label>
					<span class="helpTxt"><?php if(array_key_exists('msgHelpMetaCustom', (array) $this->variables)) { echo $this->variables['msgHelpMetaCustom']; } else { ?>{$msgHelpMetaCustom}<?php } ?></span>
				</p>
				<?php if(array_key_exists('txtMetaCustom', (array) $this->variables)) { echo $this->variables['txtMetaCustom']; } else { ?>{$txtMetaCustom}<?php } ?> <?php if(array_key_exists('txtMetaCustomError', (array) $this->variables)) { echo $this->variables['txtMetaCustomError']; } else { ?>{$txtMetaCustomError}<?php } ?>
			</div>
		<?php } ?>
	</div>
</div>

<div class="subtleBox">
	<div class="heading">
		<h3><?php if(array_key_exists('lblURL', (array) $this->variables)) { echo SpoonTemplateModifiers::uppercase($this->variables['lblURL']); } else { ?>{$lblURL|uppercase}<?php } ?></h3>
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
				<?php
					if(isset($this->variables['detailURL']) && count($this->variables['detailURL']) != 0 && $this->variables['detailURL'] != '' && $this->variables['detailURL'] !== false)
					{
						?><span id="urlFirstPart"><?php if(array_key_exists('detailURL', (array) $this->variables)) { echo $this->variables['detailURL']; } else { ?>{$detailURL}<?php } ?>/</span><?php } ?><?php if(array_key_exists('txtUrl', (array) $this->variables)) { echo $this->variables['txtUrl']; } else { ?>{$txtUrl}<?php } ?> <?php if(array_key_exists('txtUrlError', (array) $this->variables)) { echo $this->variables['txtUrlError']; } else { ?>{$txtUrlError}<?php } ?>
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
						$this->iterations['4f99b1a3a9f35f36c368a19c6957413b_Seo.tpl.php_1']['fail'] = true;
					}
				if(isset(${'seo_index'})) $this->iterations['4f99b1a3a9f35f36c368a19c6957413b_Seo.tpl.php_1']['old'] = ${'seo_index'};
				$this->iterations['4f99b1a3a9f35f36c368a19c6957413b_Seo.tpl.php_1']['iteration'] = $this->variables['seo_index'];
				$this->iterations['4f99b1a3a9f35f36c368a19c6957413b_Seo.tpl.php_1']['i'] = 1;
				$this->iterations['4f99b1a3a9f35f36c368a19c6957413b_Seo.tpl.php_1']['count'] = count($this->iterations['4f99b1a3a9f35f36c368a19c6957413b_Seo.tpl.php_1']['iteration']);
				foreach((array) $this->iterations['4f99b1a3a9f35f36c368a19c6957413b_Seo.tpl.php_1']['iteration'] as ${'seo_index'})
				{
					if(!isset(${'seo_index'}['first']) && $this->iterations['4f99b1a3a9f35f36c368a19c6957413b_Seo.tpl.php_1']['i'] == 1) ${'seo_index'}['first'] = true;
					if(!isset(${'seo_index'}['last']) && $this->iterations['4f99b1a3a9f35f36c368a19c6957413b_Seo.tpl.php_1']['i'] == $this->iterations['4f99b1a3a9f35f36c368a19c6957413b_Seo.tpl.php_1']['count']) ${'seo_index'}['last'] = true;
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
					$this->iterations['4f99b1a3a9f35f36c368a19c6957413b_Seo.tpl.php_1']['i']++;
				}
					if(isset($this->iterations['4f99b1a3a9f35f36c368a19c6957413b_Seo.tpl.php_1']['fail']) && $this->iterations['4f99b1a3a9f35f36c368a19c6957413b_Seo.tpl.php_1']['fail'] == true)
					{
						?>{/iteration:seo_index}<?php
					}
				if(isset($this->iterations['4f99b1a3a9f35f36c368a19c6957413b_Seo.tpl.php_1']['old'])) ${'seo_index'} = $this->iterations['4f99b1a3a9f35f36c368a19c6957413b_Seo.tpl.php_1']['old'];
				else unset($this->iterations['4f99b1a3a9f35f36c368a19c6957413b_Seo.tpl.php_1']);
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
						$this->iterations['4f99b1a3a9f35f36c368a19c6957413b_Seo.tpl.php_2']['fail'] = true;
					}
				if(isset(${'seo_follow'})) $this->iterations['4f99b1a3a9f35f36c368a19c6957413b_Seo.tpl.php_2']['old'] = ${'seo_follow'};
				$this->iterations['4f99b1a3a9f35f36c368a19c6957413b_Seo.tpl.php_2']['iteration'] = $this->variables['seo_follow'];
				$this->iterations['4f99b1a3a9f35f36c368a19c6957413b_Seo.tpl.php_2']['i'] = 1;
				$this->iterations['4f99b1a3a9f35f36c368a19c6957413b_Seo.tpl.php_2']['count'] = count($this->iterations['4f99b1a3a9f35f36c368a19c6957413b_Seo.tpl.php_2']['iteration']);
				foreach((array) $this->iterations['4f99b1a3a9f35f36c368a19c6957413b_Seo.tpl.php_2']['iteration'] as ${'seo_follow'})
				{
					if(!isset(${'seo_follow'}['first']) && $this->iterations['4f99b1a3a9f35f36c368a19c6957413b_Seo.tpl.php_2']['i'] == 1) ${'seo_follow'}['first'] = true;
					if(!isset(${'seo_follow'}['last']) && $this->iterations['4f99b1a3a9f35f36c368a19c6957413b_Seo.tpl.php_2']['i'] == $this->iterations['4f99b1a3a9f35f36c368a19c6957413b_Seo.tpl.php_2']['count']) ${'seo_follow'}['last'] = true;
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
					$this->iterations['4f99b1a3a9f35f36c368a19c6957413b_Seo.tpl.php_2']['i']++;
				}
					if(isset($this->iterations['4f99b1a3a9f35f36c368a19c6957413b_Seo.tpl.php_2']['fail']) && $this->iterations['4f99b1a3a9f35f36c368a19c6957413b_Seo.tpl.php_2']['fail'] == true)
					{
						?>{/iteration:seo_follow}<?php
					}
				if(isset($this->iterations['4f99b1a3a9f35f36c368a19c6957413b_Seo.tpl.php_2']['old'])) ${'seo_follow'} = $this->iterations['4f99b1a3a9f35f36c368a19c6957413b_Seo.tpl.php_2']['old'];
				else unset($this->iterations['4f99b1a3a9f35f36c368a19c6957413b_Seo.tpl.php_2']);
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
