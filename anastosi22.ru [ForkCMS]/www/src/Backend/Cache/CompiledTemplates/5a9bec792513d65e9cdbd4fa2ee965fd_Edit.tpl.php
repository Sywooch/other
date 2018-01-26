<?php error_reporting(0); ini_set('display_errors', 'Off'); ?>
<?php
				ob_start();
				?><?php echo $this->variables['BACKEND_CORE_PATH']; ?>/Layout/Templates/Head.tpl<?php
				$include = eval('return \'' . str_replace('\'', '\\\'', ob_get_clean()) .'\';');
				if($this->getForceCompile() || !file_exists($this->getCompileDirectory() .'/' . $this->getCompileName($include, '/home/anastosi/domains/anastosi.ru/public_html/src/Backend/Modules/FormBuilder/Layout/Templates'))) $this->compile('/home/anastosi/domains/anastosi.ru/public_html/src/Backend/Modules/FormBuilder/Layout/Templates', $include);
				$return = @include $this->getCompileDirectory() .'/' . $this->getCompileName($include, '/home/anastosi/domains/anastosi.ru/public_html/src/Backend/Modules/FormBuilder/Layout/Templates');
				if($return === false && $this->compile('/home/anastosi/domains/anastosi.ru/public_html/src/Backend/Modules/FormBuilder/Layout/Templates', $include))
				{
					$return = @include $this->getCompileDirectory() .'/' . $this->getCompileName($include, '/home/anastosi/domains/anastosi.ru/public_html/src/Backend/Modules/FormBuilder/Layout/Templates');
				}
?>
<?php
				ob_start();
				?><?php echo $this->variables['BACKEND_CORE_PATH']; ?>/Layout/Templates/StructureStartModule.tpl<?php
				$include = eval('return \'' . str_replace('\'', '\\\'', ob_get_clean()) .'\';');
				if($this->getForceCompile() || !file_exists($this->getCompileDirectory() .'/' . $this->getCompileName($include, '/home/anastosi/domains/anastosi.ru/public_html/src/Backend/Modules/FormBuilder/Layout/Templates'))) $this->compile('/home/anastosi/domains/anastosi.ru/public_html/src/Backend/Modules/FormBuilder/Layout/Templates', $include);
				$return = @include $this->getCompileDirectory() .'/' . $this->getCompileName($include, '/home/anastosi/domains/anastosi.ru/public_html/src/Backend/Modules/FormBuilder/Layout/Templates');
				if($return === false && $this->compile('/home/anastosi/domains/anastosi.ru/public_html/src/Backend/Modules/FormBuilder/Layout/Templates', $include))
				{
					$return = @include $this->getCompileDirectory() .'/' . $this->getCompileName($include, '/home/anastosi/domains/anastosi.ru/public_html/src/Backend/Modules/FormBuilder/Layout/Templates');
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
	<div class="pageTitle">
		<h2><?php echo SpoonFilter::ucfirst($this->variables['lblFormBuilder']); ?>: <?php echo sprintf($this->variables['lblEditForm'], $this->variables['name']); ?></h2>
	</div>

	<script type="text/javascript">
		//<![CDATA[
			var defaultErrorMessages = {};

			<?php
					if(isset($this->variables['errors']) && count($this->variables['errors']) != 0 && $this->variables['errors'] != '' && $this->variables['errors'] !== false)
					{
						?>
				<?php
				if(isset(${'errors'})) $this->iterations['5a9bec792513d65e9cdbd4fa2ee965fd_Edit.tpl.php_1']['old'] = ${'errors'};
				$this->iterations['5a9bec792513d65e9cdbd4fa2ee965fd_Edit.tpl.php_1']['iteration'] = $this->variables['errors'];
				$this->iterations['5a9bec792513d65e9cdbd4fa2ee965fd_Edit.tpl.php_1']['i'] = 1;
				$this->iterations['5a9bec792513d65e9cdbd4fa2ee965fd_Edit.tpl.php_1']['count'] = count($this->iterations['5a9bec792513d65e9cdbd4fa2ee965fd_Edit.tpl.php_1']['iteration']);
				foreach((array) $this->iterations['5a9bec792513d65e9cdbd4fa2ee965fd_Edit.tpl.php_1']['iteration'] as ${'errors'})
				{
					if(!isset(${'errors'}['first']) && $this->iterations['5a9bec792513d65e9cdbd4fa2ee965fd_Edit.tpl.php_1']['i'] == 1) ${'errors'}['first'] = true;
					if(!isset(${'errors'}['last']) && $this->iterations['5a9bec792513d65e9cdbd4fa2ee965fd_Edit.tpl.php_1']['i'] == $this->iterations['5a9bec792513d65e9cdbd4fa2ee965fd_Edit.tpl.php_1']['count']) ${'errors'}['last'] = true;
					if(isset(${'errors'}['formElements']) && is_array(${'errors'}['formElements']))
					{
						foreach(${'errors'}['formElements'] as $name => $object)
						{
							${'errors'}[$name] = $object->parse();
							${'errors'}[$name .'Error'] = (is_callable(array($object, 'getErrors')) && $object->getErrors() != '') ? '<span class="formError">' . $object->getErrors() .'</span>' : '';
						}
					} ?>
					defaultErrorMessages.<?php echo ${'errors'}['type']; ?> = '<?php echo ${'errors'}['message']; ?>';
				<?php
					$this->iterations['5a9bec792513d65e9cdbd4fa2ee965fd_Edit.tpl.php_1']['i']++;
				}
				if(isset($this->iterations['5a9bec792513d65e9cdbd4fa2ee965fd_Edit.tpl.php_1']['old'])) ${'errors'} = $this->iterations['5a9bec792513d65e9cdbd4fa2ee965fd_Edit.tpl.php_1']['old'];
				else unset($this->iterations['5a9bec792513d65e9cdbd4fa2ee965fd_Edit.tpl.php_1']);
				?>
			<?php } ?>
		//]]>
	</script>

	<input type="hidden" name="id" id="formId" value="<?php echo $this->variables['id']; ?>" />

	<div class="tabs">
		<ul>
			<li><a href="#tabGeneral"><?php echo SpoonFilter::ucfirst($this->variables['lblGeneral']); ?></a></li>
			<li><a href="#tabFields"><?php echo SpoonFilter::ucfirst($this->variables['lblFields']); ?></a></li>
			<li><a href="#tabExtra"><?php echo SpoonFilter::ucfirst($this->variables['lblExtra']); ?></a></li>
		</ul>

		<div id="tabGeneral" class="box">
			<div class="horizontal">
				<div class="options">
					<p>
						<label for="name"><?php echo SpoonFilter::ucfirst($this->variables['lblName']); ?><abbr title="<?php echo $this->variables['lblRequiredField']; ?>">*</abbr></label>
						<?php echo $this->variables['txtName']; ?> <?php echo $this->variables['txtNameError']; ?>
					</p>
				</div>
				<div class="options">
					<p class="p0">
						<label for="method"><?php echo SpoonFilter::ucfirst($this->variables['lblMethod']); ?><abbr title="<?php echo $this->variables['lblRequiredField']; ?>">*</abbr></label>
						<?php echo $this->variables['ddmMethod']; ?> <?php echo $this->variables['ddmMethodError']; ?>
					</p>
					<p id="emailWrapper" class="hidden">
						<label for="addValue-email"><?php echo SpoonFilter::ucfirst($this->variables['lblRecipient']); ?><abbr title="<?php echo $this->variables['lblRequiredField']; ?>">*</abbr></label>
						<?php echo $this->variables['txtEmail']; ?> <?php echo $this->variables['txtEmailError']; ?>
					</p>
				</div>
			</div>
			<div class="options">
				<div class="heading">
					<h3>
						<label for="successMessage"><?php echo SpoonFilter::ucfirst($this->variables['lblSuccessMessage']); ?><abbr title="<?php echo $this->variables['lblRequiredField']; ?>">*</abbr></label>
					</h3>
				</div>
				<div class="optionsRTE">
					<?php echo $this->variables['txtSuccessMessage']; ?> <?php echo $this->variables['txtSuccessMessageError']; ?>
				</div>
			</div>
		</div>

		<div id="tabFields">
			<div class="generalMessage infoMessage singleMessage content">
				<p class="lastChild"><?php echo $this->variables['msgImportantImmediateUpdate']; ?></p>
			</div>
			<div class="clearfix">
				<div id="leftColumn">
					<div class="box boxLevel2">
						<div class="heading">
							<h3><?php echo SpoonFilter::ucfirst($this->variables['lblPreview']); ?></h3>
						</div>
						<div id="fieldsHolder" class="sequenceByDragAndDrop">
							<?php
					if(isset($this->variables['fields']) && count($this->variables['fields']) != 0 && $this->variables['fields'] != '' && $this->variables['fields'] !== false)
					{
						?>
								<?php
				if(isset(${'fields'})) $this->iterations['5a9bec792513d65e9cdbd4fa2ee965fd_Edit.tpl.php_2']['old'] = ${'fields'};
				$this->iterations['5a9bec792513d65e9cdbd4fa2ee965fd_Edit.tpl.php_2']['iteration'] = $this->variables['fields'];
				$this->iterations['5a9bec792513d65e9cdbd4fa2ee965fd_Edit.tpl.php_2']['i'] = 1;
				$this->iterations['5a9bec792513d65e9cdbd4fa2ee965fd_Edit.tpl.php_2']['count'] = count($this->iterations['5a9bec792513d65e9cdbd4fa2ee965fd_Edit.tpl.php_2']['iteration']);
				foreach((array) $this->iterations['5a9bec792513d65e9cdbd4fa2ee965fd_Edit.tpl.php_2']['iteration'] as ${'fields'})
				{
					if(!isset(${'fields'}['first']) && $this->iterations['5a9bec792513d65e9cdbd4fa2ee965fd_Edit.tpl.php_2']['i'] == 1) ${'fields'}['first'] = true;
					if(!isset(${'fields'}['last']) && $this->iterations['5a9bec792513d65e9cdbd4fa2ee965fd_Edit.tpl.php_2']['i'] == $this->iterations['5a9bec792513d65e9cdbd4fa2ee965fd_Edit.tpl.php_2']['count']) ${'fields'}['last'] = true;
					if(isset(${'fields'}['formElements']) && is_array(${'fields'}['formElements']))
					{
						foreach(${'fields'}['formElements'] as $name => $object)
						{
							${'fields'}[$name] = $object->parse();
							${'fields'}[$name .'Error'] = (is_callable(array($object, 'getErrors')) && $object->getErrors() != '') ? '<span class="formError">' . $object->getErrors() .'</span>' : '';
						}
					} ?>
									<?php echo ${'fields'}['field']; ?>
								<?php
					$this->iterations['5a9bec792513d65e9cdbd4fa2ee965fd_Edit.tpl.php_2']['i']++;
				}
				if(isset($this->iterations['5a9bec792513d65e9cdbd4fa2ee965fd_Edit.tpl.php_2']['old'])) ${'fields'} = $this->iterations['5a9bec792513d65e9cdbd4fa2ee965fd_Edit.tpl.php_2']['old'];
				else unset($this->iterations['5a9bec792513d65e9cdbd4fa2ee965fd_Edit.tpl.php_2']);
				?>
							<?php } ?>

							
							<div id="noFields" class="options"<?php
					if(isset($this->variables['fields']) && count($this->variables['fields']) != 0 && $this->variables['fields'] != '' && $this->variables['fields'] !== false)
					{
						?> style="display: none;"<?php } ?>>
								<img src="/src/Backend/Modules/FormBuilder/Layout/images/placeholder_<?php echo $this->variables['INTERFACE_LANGUAGE']; ?>.png" alt="<?php echo $this->variables['msgNoFields']; ?>" />
							</div>

							
							<div class="options clearfix">
								<p class="floatLeft buttonHolder p0">
									<?php echo $this->variables['btnSubmitField']; ?>
								</p>
								<p class="floatRight buttonHolderRight p0">
									<a href="#edit-<?php echo $this->variables['submitId']; ?>" class="button iconOnly icon iconEdit editField floatRight" rel="<?php echo $this->variables['submitId']; ?>"><span><?php echo $this->variables['lblEdit']; ?></span></a>
								</p>
							</div>
						</div>
					</div>
				</div>
				<div id="rightColumn">
					<div class="box boxLevel2" id="formElements">
						<div class="heading">
							<h3><?php echo SpoonFilter::ucfirst($this->variables['lblAddFields']); ?></h3>
						</div>
						<div class="options">
							<h3><?php echo SpoonFilter::ucfirst($this->variables['lblFormElements']); ?></h3>
							<ul>
								<li id="textboxSelector"><a href="#textbox" rel="textboxDialog" class="openFieldDialog"><?php echo SpoonFilter::ucfirst($this->variables['lblTextbox']); ?></a></li>
								<li id="textareaSelector"><a href="#textarea" rel="textareaDialog" class="openFieldDialog"><?php echo SpoonFilter::ucfirst($this->variables['lblTextarea']); ?></a></li>
								<li id="dropdownSelector"><a href="#dropdown" rel="dropdownDialog" class="openFieldDialog"><?php echo SpoonFilter::ucfirst($this->variables['lblDropdown']); ?></a></li>
								<li id="checkboxSelector"><a href="#checkbox" rel="checkboxDialog" class="openFieldDialog"><?php echo SpoonFilter::ucfirst($this->variables['lblCheckbox']); ?></a></li>
								<li id="radiobuttonSelector"><a href="#radiobutton" rel="radiobuttonDialog" class="openFieldDialog"><?php echo SpoonFilter::ucfirst($this->variables['lblRadiobutton']); ?></a></li>
							</ul>
						</div>
						<div class="options">
							<h3><?php echo SpoonFilter::ucfirst($this->variables['lblTextElements']); ?></h3>
							<ul>
								<li id="headingSelector"><a href="#heading" rel="headingDialog" class="openFieldDialog"><?php echo SpoonFilter::ucfirst($this->variables['lblHeading']); ?></a></li>
								<li id="paragraphSelector"><a href="#paragraph" rel="paragraphDialog" class="openFieldDialog"><?php echo SpoonFilter::ucfirst($this->variables['lblParagraph']); ?></a></li>
							</ul>
						</div>
					</div>
				</div>
			</div>
		</div>

		<div id="tabExtra" class="box">
			<div class="horizontal">
				<div class="options">
					<p>
						<label for="identifier">
							<?php echo SpoonFilter::ucfirst($this->variables['lblIdentifier']); ?>
							<abbr class="help">(?)</abbr>
							<span class="tooltip" style="display: none;"><?php echo $this->variables['msgHelpIdentifier']; ?></span>
						</label>
						<?php echo $this->variables['txtIdentifier']; ?> <?php echo $this->variables['txtIdentifierError']; ?>
					</p>
				</div>
			</div>
		</div>
	</div>

	<div class="fullwidthOptions">
		<?php
					if(isset($this->variables['showFormBuilderDelete']) && count($this->variables['showFormBuilderDelete']) != 0 && $this->variables['showFormBuilderDelete'] != '' && $this->variables['showFormBuilderDelete'] !== false)
					{
						?>
		<a href="<?php echo Backend\Core\Engine\TemplateModifiers::getURL($this->variables['var'], 'delete'); ?>&amp;id=<?php echo $this->variables['id']; ?>" data-message-id="confirmDelete" class="askConfirmation button linkButton icon iconDelete">
			<span><?php echo SpoonFilter::ucfirst($this->variables['lblDelete']); ?></span>
		</a>
		<div id="confirmDelete" title="<?php echo SpoonFilter::ucfirst($this->variables['lblDelete']); ?>?" style="display: none;">
			<p><?php echo sprintf($this->variables['msgConfirmDelete'], $this->variables['name']); ?></p>
		</div>
		<?php } ?>

		<div class="buttonHolderRight">
			<input id="editButton" class="inputButton button mainButton" type="submit" name="edit" value="<?php echo SpoonFilter::ucfirst($this->variables['lblSave']); ?>" />
		</div>
	</div>

	
	<div id="textboxDialog" title="<?php echo SpoonFilter::ucfirst($this->variables['lblTextbox']); ?>" class="dialog" style="display: none;">
		<input type="hidden" name="textbox_id" id="textboxId" value="" />

		<div class="tabs forkForms">
			<ul>
				<li><a href="#tabTextboxBasic"><?php echo SpoonFilter::ucfirst($this->variables['lblBasic']); ?></a></li>
				<li><a href="#tabTextboxProperties"><?php echo SpoonFilter::ucfirst($this->variables['lblProperties']); ?></a></li>
			</ul>

			<div id="tabTextboxBasic" class="box">
				<div class="horizontal">
					<div class="options">
						<p>
							<label for="textboxLabel"><?php echo SpoonFilter::ucfirst($this->variables['lblLabel']); ?><abbr title="<?php echo $this->variables['lblRequiredField']; ?>">*</abbr></label>
							<?php echo $this->variables['txtTextboxLabel']; ?>
							<span id="textboxLabelError" class="formError" style="display: none;"></span>
						</p>
					</div>
				</div>
			</div>
			<div id="tabTextboxProperties" class="box">
				<div class="horizontal">
					<div class="options">
						<p>
							<label for="textboxValue"><?php echo SpoonFilter::ucfirst($this->variables['lblDefaultValue']); ?></label>
							<?php echo $this->variables['txtTextboxValue']; ?>
						</p>
					</div>
					<div class="options">
						<p class="p0">
							<label for="textboxReplyTo"><?php echo SpoonFilter::ucfirst($this->variables['lblReplyTo']); ?></label>
							<?php echo $this->variables['chkTextboxReplyTo']; ?>
							<abbr class="help">(?)</abbr>
							<span class="tooltip" style="display: none;"><?php echo $this->variables['msgHelpReplyTo']; ?></span>
						</p>
					</div>
					<div class="validation options">
						<p class="p0">
							<label for="textboxRequired"><?php echo SpoonFilter::ucfirst($this->variables['lblRequiredField']); ?></label>
							<?php echo $this->variables['chkTextboxRequired']; ?>
						</p>
						<p class="validationRequiredErrorMessage hidden">
							<label for="textboxRequiredErrorMessage"><?php echo SpoonFilter::ucfirst($this->variables['lblErrorMessage']); ?><abbr title="<?php echo $this->variables['lblRequiredField']; ?>">*</abbr></label>
							<?php echo $this->variables['txtTextboxRequiredErrorMessage']; ?>
							<span id="textboxRequiredErrorMessageError" class="formError" style="display: none;"></span>
						</p>
					</div>
					<div class="validation options">
						<p class="p0">
							<label for="textboxValidation"><?php echo SpoonFilter::ucfirst($this->variables['lblValidation']); ?></label>
							<?php echo $this->variables['ddmTextboxValidation']; ?>
						</p>
						<p class="validationParameter" style="display: none;">
							<label for="textboxValidationParameter"><?php echo SpoonFilter::ucfirst($this->variables['lblParameter']); ?><abbr title="<?php echo $this->variables['lblRequiredField']; ?>">*</abbr></label>
							<?php echo $this->variables['txtTextboxValidationParameter']; ?>
						</p>
						<p class="validationErrorMessage" style="display: none;">
							<label for="textboxErrorMessage"><?php echo SpoonFilter::ucfirst($this->variables['lblErrorMessage']); ?><abbr title="<?php echo $this->variables['lblRequiredField']; ?>">*</abbr></label>
							<?php echo $this->variables['txtTextboxErrorMessage']; ?>
							<span id="textboxErrorMessageError" class="formError" style="display: none;"></span>
						</p>
					</div>
				</div>

			</div>
		</div>
	</div>

	
	<div id="textareaDialog" title="<?php echo SpoonFilter::ucfirst($this->variables['lblTextarea']); ?>" class="dialog" style="display: none;">
		<input type="hidden" name="textarea_id" id="textareaId" value="" />

		<div class="tabs forkForms">
			<ul>
				<li><a href="#tabTextareaBasic"><?php echo SpoonFilter::ucfirst($this->variables['lblBasic']); ?></a></li>
				<li><a href="#tabTextareaProperties"><?php echo SpoonFilter::ucfirst($this->variables['lblProperties']); ?></a></li>
			</ul>

			<div id="tabTextareaBasic" class="box">
				<div class="horizontal">
					<div class="options">
						<p>
							<label for="textareaLabel"><?php echo SpoonFilter::ucfirst($this->variables['lblLabel']); ?><abbr title="<?php echo $this->variables['lblRequiredField']; ?>">*</abbr></label>
							<?php echo $this->variables['txtTextareaLabel']; ?>
							<span id="textareaLabelError" class="formError" style="display: none;"></span>
						</p>
					</div>
				</div>
			</div>

			<div id="tabTextareaProperties" class="box">
				<div class="horizontal">
					<div class="options">
						<p>
							<label for="textareaValue"><?php echo SpoonFilter::ucfirst($this->variables['lblDefaultValue']); ?></label>
							<?php echo $this->variables['txtTextareaValue']; ?>
						</p>
					</div>
					<div class="validation options">
						<p class="p0">
							<label for="textareaRequired"><?php echo SpoonFilter::ucfirst($this->variables['lblRequiredField']); ?></label>
							<?php echo $this->variables['chkTextareaRequired']; ?>
						</p>
						<p class="validationRequiredErrorMessage hidden">
							<label for="textareaRequiredErrorMessage"><?php echo SpoonFilter::ucfirst($this->variables['lblErrorMessage']); ?><abbr title="<?php echo $this->variables['lblRequiredField']; ?>">*</abbr></label>
							<?php echo $this->variables['txtTextareaRequiredErrorMessage']; ?>
							<span id="textareaRequiredErrorMessageError" class="formError" style="display: none;"></span>
						</p>
					</div>
					<div class="validation options" style="display: none;">
						<p class="p0">
							<label for="textareaValidation"><?php echo SpoonFilter::ucfirst($this->variables['lblValidation']); ?></label>
							<?php echo $this->variables['ddmTextareaValidation']; ?>
						</p>
						<p class="validationParameter" style="display: none;">
							<label for="textareaValidationParameter"><?php echo SpoonFilter::ucfirst($this->variables['lblParameter']); ?><abbr title="<?php echo $this->variables['lblRequiredField']; ?>">*</abbr></label>
							<?php echo $this->variables['txtTextareaValidationParameter']; ?>
						</p>
						<p class="validationErrorMessage" style="display: none;">
							<label for="textareaErrorMessage"><?php echo SpoonFilter::ucfirst($this->variables['lblErrorMessage']); ?><abbr title="<?php echo $this->variables['lblRequiredField']; ?>">*</abbr></label>
							<?php echo $this->variables['txtTextareaErrorMessage']; ?>
							<span id="textareaErrorMessageError" class="formError" style="display: none;"></span>
						</p>
					</div>
				</div>
			</div>
		</div>
	</div>

	
	<div id="dropdownDialog" title="<?php echo SpoonFilter::ucfirst($this->variables['lblDropdown']); ?>" class="dialog" style="display: none;">
		<input type="hidden" name="dropdown_id" id="dropdownId" value="" />

		<div class="tabs forkForms">
			<ul>
				<li><a href="#tabDropdownBasic"><?php echo SpoonFilter::ucfirst($this->variables['lblBasic']); ?></a></li>
				<li><a href="#tabDropdownProperties"><?php echo SpoonFilter::ucfirst($this->variables['lblProperties']); ?></a></li>
			</ul>

			<div id="tabDropdownBasic" class="box">
				<div class="horizontal">
					<div class="options">
						<p>
							<label for="dropdownLabel"><?php echo SpoonFilter::ucfirst($this->variables['lblLabel']); ?><abbr title="<?php echo $this->variables['lblRequiredField']; ?>">*</abbr></label>
							<?php echo $this->variables['txtDropdownLabel']; ?>
							<span id="dropdownLabelError" class="formError" style="display: none;"></span>
						</p>
						<p>
							<label for="dropdownValues"><?php echo SpoonFilter::ucfirst($this->variables['lblValues']); ?></label>
							<?php echo $this->variables['txtDropdownValues']; ?> <?php echo $this->variables['txtDropdownValuesError']; ?>
							<span id="dropdownValuesError" class="formError" style="display: none;"></span>
						</p>
					</div>
				</div>
			</div>

			<div id="tabDropdownProperties" class="box">
				<div class="horizontal">
					<div class="options">
						<p>
							<label for="dropdownDefaultValue"><?php echo SpoonFilter::ucfirst($this->variables['lblDefaultValue']); ?></label>
							<?php echo $this->variables['ddmDropdownDefaultValue']; ?>
						</p>
					</div>
					<div class="options validation">
						<p class="p0">
							<label for="dropdownRequired"><?php echo SpoonFilter::ucfirst($this->variables['lblRequiredField']); ?></label>
							<?php echo $this->variables['chkDropdownRequired']; ?>
						</p>
						<p class="validationRequiredErrorMessage hidden">
							<label for="dropdownRequiredErrorMessage"><?php echo SpoonFilter::ucfirst($this->variables['lblErrorMessage']); ?><abbr title="<?php echo $this->variables['lblRequiredField']; ?>">*</abbr></label>
							<?php echo $this->variables['txtDropdownRequiredErrorMessage']; ?>
							<span id="dropdownRequiredErrorMessageError" class="formError" style="display: none;"></span>
						</p>
					</div>
				</div>
			</div>
		</div>
	</div>

	
	<div id="radiobuttonDialog" title="<?php echo SpoonFilter::ucfirst($this->variables['lblRadiobutton']); ?>" class="dialog" style="display: none;">
		<input type="hidden" name="radiobutton_id" id="radiobuttonId" value="" />

		<div class="tabs forkForms">
			<ul>
				<li><a href="#tabRadiobuttonBasic"><?php echo SpoonFilter::ucfirst($this->variables['lblBasic']); ?></a></li>
				<li><a href="#tabRadiobuttonProperties"><?php echo SpoonFilter::ucfirst($this->variables['lblProperties']); ?></a></li>
			</ul>

			<div id="tabRadiobuttonBasic" class="box">
				<div class="horizontal">
					<div class="options">
						<p>
							<label for="radiobuttonLabel"><?php echo SpoonFilter::ucfirst($this->variables['lblLabel']); ?><abbr title="<?php echo $this->variables['lblRequiredField']; ?>">*</abbr></label>
							<?php echo $this->variables['txtRadiobuttonLabel']; ?>
							<span id="radiobuttonLabelError" class="formError" style="display: none;"></span>
						</p>
						<p>
							<label for="radiobuttonValues"><?php echo SpoonFilter::ucfirst($this->variables['lblValues']); ?></label>
							<?php echo $this->variables['txtRadiobuttonValues']; ?> <?php echo $this->variables['txtRadiobuttonValuesError']; ?>
							<span id="radiobuttonValuesError" class="formError" style="display: none;"></span>
						</p>
					</div>
				</div>
			</div>

			<div id="tabRadiobuttonProperties" class="box">
				<div class="horizontal">
					<div class="options">
						<p>
							<label for="radiobuttonDefaultValue"><?php echo SpoonFilter::ucfirst($this->variables['lblDefaultValue']); ?></label>
							<?php echo $this->variables['ddmRadiobuttonDefaultValue']; ?>
						</p>
					</div>
					<div class="options validation">
						<p class="p0">
							<label for="radiobuttonRequired"><?php echo SpoonFilter::ucfirst($this->variables['lblRequiredField']); ?></label>
							<?php echo $this->variables['chkRadiobuttonRequired']; ?>
						</p>
						<p class="validationRequiredErrorMessage hidden">
							<label for="radiobuttonRequiredErrorMessage"><?php echo SpoonFilter::ucfirst($this->variables['lblErrorMessage']); ?><abbr title="<?php echo $this->variables['lblRequiredField']; ?>">*</abbr></label>
							<?php echo $this->variables['txtRadiobuttonRequiredErrorMessage']; ?>
							<span id="radiobuttonRequiredErrorMessageError" class="formError" style="display: none;"></span>
						</p>
					</div>
				</div>
			</div>
		</div>
	</div>

	
	<div id="checkboxDialog" title="<?php echo SpoonFilter::ucfirst($this->variables['lblCheckbox']); ?>" class="dialog" style="display: none;">
		<input type="hidden" name="checkbox_id" id="checkboxId" value="" />

		<div class="tabs forkForms">
			<ul>
				<li><a href="#tabCheckboxBasic"><?php echo SpoonFilter::ucfirst($this->variables['lblBasic']); ?></a></li>
				<li><a href="#tabCheckboxProperties"><?php echo SpoonFilter::ucfirst($this->variables['lblProperties']); ?></a></li>
			</ul>

			<div id="tabCheckboxBasic" class="box">
				<div class="horizontal">
					<div class="options">
						<p>
							<label for="checkboxLabel"><?php echo SpoonFilter::ucfirst($this->variables['lblLabel']); ?><abbr title="<?php echo $this->variables['lblRequiredField']; ?>">*</abbr></label>
							<?php echo $this->variables['txtCheckboxLabel']; ?>
							<span id="checkboxLabelError" class="formError" style="display: none;"></span>
						</p>
						<p>
							<label for="checkboxValues"><?php echo SpoonFilter::ucfirst($this->variables['lblValues']); ?></label>
							<?php echo $this->variables['txtCheckboxValues']; ?> <?php echo $this->variables['txtCheckboxValuesError']; ?>
						</p>
					</div>
				</div>
			</div>

			<div id="tabCheckboxProperties" class="box">
				<div class="horizontal">
					<div class="options">
						<p>
							<label for="checkboxDefaultValue"><?php echo SpoonFilter::ucfirst($this->variables['lblDefaultValue']); ?></label>
							<?php echo $this->variables['ddmCheckboxDefaultValue']; ?>
						</p>
					</div>
					<div class="options validation">
						<p class="p0">
							<label for="checkboxRequired"><?php echo SpoonFilter::ucfirst($this->variables['lblRequiredField']); ?></label>
							<?php echo $this->variables['chkCheckboxRequired']; ?>
						</p>
						<p class="validationRequiredErrorMessage hidden">
							<label for="checkboxRequiredErrorMessage"><?php echo SpoonFilter::ucfirst($this->variables['lblErrorMessage']); ?><abbr title="<?php echo $this->variables['lblRequiredField']; ?>">*</abbr></label>
							<?php echo $this->variables['txtCheckboxRequiredErrorMessage']; ?>
							<span id="checkboxRequiredErrorMessageError" class="formError" style="display: none;"></span>
						</p>
					</div>
				</div>
			</div>
		</div>
	</div>

	
	<div id="submitDialog" title="<?php echo SpoonFilter::ucfirst($this->variables['lblSubmitButton']); ?>" class="dialog box forkForms" style="display: none;">
		<div class="horizontal">
			<div class="options">
				<input type="hidden" name="submit_id" id="submitId" value="" />
				<p>
					<label for="submit"><?php echo SpoonFilter::ucfirst($this->variables['lblContent']); ?><abbr title="<?php echo $this->variables['lblRequiredField']; ?>">*</abbr></label>
					<?php echo $this->variables['txtSubmit']; ?>
				</p>
				<div class="validation">
					<span id="submitError" class="formError" style="display: none;"></span>
				</div>
			</div>
		</div>
	</div>

	
	<div id="headingDialog" title="<?php echo SpoonFilter::ucfirst($this->variables['lblHeading']); ?>" class="dialog box forkForms" style="display: none;">
		<div class="horizontal">
			<div class="options">
				<input type="hidden" name="heading_id" id="headingId" value="" />
				<p>
					<label for="heading"><?php echo SpoonFilter::ucfirst($this->variables['lblContent']); ?><abbr title="<?php echo $this->variables['lblRequiredField']; ?>">*</abbr></label>
					<?php echo $this->variables['txtHeading']; ?>
					<span id="headingError" class="formError" style="display: none;"></span>
				</p>
			</div>
		</div>
	</div>

	
	<div id="paragraphDialog" title="<?php echo SpoonFilter::ucfirst($this->variables['lblParagraph']); ?>" class="dialog box boxLevel2 forkForms" style="display: none;">
		<input type="hidden" name="paragraph_id" id="paragraphId" value="" />
		<div class="heading">
			<h3><?php echo SpoonFilter::ucfirst($this->variables['lblContent']); ?></h3>
		</div>
		<p>
			<?php echo $this->variables['txtParagraph']; ?>
			<span id="paragraphError" class="formError" style="display: none;"></span>
		</p>
	</div>
</form>
				<?php } ?>

<?php
				ob_start();
				?><?php echo $this->variables['BACKEND_CORE_PATH']; ?>/Layout/Templates/StructureEndModule.tpl<?php
				$include = eval('return \'' . str_replace('\'', '\\\'', ob_get_clean()) .'\';');
				if($this->getForceCompile() || !file_exists($this->getCompileDirectory() .'/' . $this->getCompileName($include, '/home/anastosi/domains/anastosi.ru/public_html/src/Backend/Modules/FormBuilder/Layout/Templates'))) $this->compile('/home/anastosi/domains/anastosi.ru/public_html/src/Backend/Modules/FormBuilder/Layout/Templates', $include);
				$return = @include $this->getCompileDirectory() .'/' . $this->getCompileName($include, '/home/anastosi/domains/anastosi.ru/public_html/src/Backend/Modules/FormBuilder/Layout/Templates');
				if($return === false && $this->compile('/home/anastosi/domains/anastosi.ru/public_html/src/Backend/Modules/FormBuilder/Layout/Templates', $include))
				{
					$return = @include $this->getCompileDirectory() .'/' . $this->getCompileName($include, '/home/anastosi/domains/anastosi.ru/public_html/src/Backend/Modules/FormBuilder/Layout/Templates');
				}
?>
<?php
				ob_start();
				?><?php echo $this->variables['BACKEND_CORE_PATH']; ?>/Layout/Templates/Footer.tpl<?php
				$include = eval('return \'' . str_replace('\'', '\\\'', ob_get_clean()) .'\';');
				if($this->getForceCompile() || !file_exists($this->getCompileDirectory() .'/' . $this->getCompileName($include, '/home/anastosi/domains/anastosi.ru/public_html/src/Backend/Modules/FormBuilder/Layout/Templates'))) $this->compile('/home/anastosi/domains/anastosi.ru/public_html/src/Backend/Modules/FormBuilder/Layout/Templates', $include);
				$return = @include $this->getCompileDirectory() .'/' . $this->getCompileName($include, '/home/anastosi/domains/anastosi.ru/public_html/src/Backend/Modules/FormBuilder/Layout/Templates');
				if($return === false && $this->compile('/home/anastosi/domains/anastosi.ru/public_html/src/Backend/Modules/FormBuilder/Layout/Templates', $include))
				{
					$return = @include $this->getCompileDirectory() .'/' . $this->getCompileName($include, '/home/anastosi/domains/anastosi.ru/public_html/src/Backend/Modules/FormBuilder/Layout/Templates');
				}
?>
