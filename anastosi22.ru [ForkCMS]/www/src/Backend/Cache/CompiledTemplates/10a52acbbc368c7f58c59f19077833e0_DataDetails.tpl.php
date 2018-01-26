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

<div class="pageTitle">
	<h2><?php echo SpoonFilter::ucfirst($this->variables['lblFormBuilder']); ?>: <?php echo sprintf($this->variables['lblFormData'], $this->variables['name']); ?></h2>

	<?php
					if(isset($this->variables['showFormBuilderData']) && count($this->variables['showFormBuilderData']) != 0 && $this->variables['showFormBuilderData'] != '' && $this->variables['showFormBuilderData'] !== false)
					{
						?>
	<div class="buttonHolderRight">
		<a href="<?php echo Backend\Core\Engine\TemplateModifiers::getURL($this->variables['var'], 'data'); ?>&amp;id=<?php echo $this->variables['formId']; ?>&amp;start_date=<?php echo $this->variables['filter']['start_date']; ?>&amp;end_date=<?php echo $this->variables['filter']['end_date']; ?>" class="button icon iconBack"><span><?php echo SpoonFilter::ucfirst($this->variables['lblBackToData']); ?></span></a>
	</div>
	<?php } ?>
</div>

<div class="box">
	<div class="heading">
		<h3><?php echo SpoonFilter::ucfirst($this->variables['lblSenderInformation']); ?></h3>
	</div>
	<div class="options">
		<p><strong><?php echo SpoonFilter::ucfirst($this->variables['lblSentOn']); ?>:</strong> <?php echo Backend\Core\Engine\TemplateModifiers::formatDateTime($this->variables['sentOn']); ?></p>
	</div>
</div>

<div class="box">
	<div class="heading">
		<h3><?php echo SpoonFilter::ucfirst($this->variables['lblContent']); ?></h3>
	</div>
	<div class="options">
		<?php
					if(isset($this->variables['data']) && count($this->variables['data']) != 0 && $this->variables['data'] != '' && $this->variables['data'] !== false)
					{
						?>
			<?php
				if(isset(${'data'})) $this->iterations['10a52acbbc368c7f58c59f19077833e0_DataDetails.tpl.php_1']['old'] = ${'data'};
				$this->iterations['10a52acbbc368c7f58c59f19077833e0_DataDetails.tpl.php_1']['iteration'] = $this->variables['data'];
				$this->iterations['10a52acbbc368c7f58c59f19077833e0_DataDetails.tpl.php_1']['i'] = 1;
				$this->iterations['10a52acbbc368c7f58c59f19077833e0_DataDetails.tpl.php_1']['count'] = count($this->iterations['10a52acbbc368c7f58c59f19077833e0_DataDetails.tpl.php_1']['iteration']);
				foreach((array) $this->iterations['10a52acbbc368c7f58c59f19077833e0_DataDetails.tpl.php_1']['iteration'] as ${'data'})
				{
					if(!isset(${'data'}['first']) && $this->iterations['10a52acbbc368c7f58c59f19077833e0_DataDetails.tpl.php_1']['i'] == 1) ${'data'}['first'] = true;
					if(!isset(${'data'}['last']) && $this->iterations['10a52acbbc368c7f58c59f19077833e0_DataDetails.tpl.php_1']['i'] == $this->iterations['10a52acbbc368c7f58c59f19077833e0_DataDetails.tpl.php_1']['count']) ${'data'}['last'] = true;
					if(isset(${'data'}['formElements']) && is_array(${'data'}['formElements']))
					{
						foreach(${'data'}['formElements'] as $name => $object)
						{
							${'data'}[$name] = $object->parse();
							${'data'}[$name .'Error'] = (is_callable(array($object, 'getErrors')) && $object->getErrors() != '') ? '<span class="formError">' . $object->getErrors() .'</span>' : '';
						}
					} ?>
				<p><strong><?php echo ${'data'}['label']; ?>:</strong> <?php echo ${'data'}['value']; ?></p>
			<?php
					$this->iterations['10a52acbbc368c7f58c59f19077833e0_DataDetails.tpl.php_1']['i']++;
				}
				if(isset($this->iterations['10a52acbbc368c7f58c59f19077833e0_DataDetails.tpl.php_1']['old'])) ${'data'} = $this->iterations['10a52acbbc368c7f58c59f19077833e0_DataDetails.tpl.php_1']['old'];
				else unset($this->iterations['10a52acbbc368c7f58c59f19077833e0_DataDetails.tpl.php_1']);
				?>
		<?php } ?>
	</div>
</div>

<?php
					if(isset($this->variables['showFormBuilderMassDataAction']) && count($this->variables['showFormBuilderMassDataAction']) != 0 && $this->variables['showFormBuilderMassDataAction'] != '' && $this->variables['showFormBuilderMassDataAction'] !== false)
					{
						?>
<div class="fullwidthOptions">
	<a href="<?php echo Backend\Core\Engine\TemplateModifiers::getURL($this->variables['var'], 'mass_data_action'); ?>&amp;action=delete&amp;form_id=<?php echo $this->variables['formId']; ?>&amp;id=<?php echo $this->variables['id']; ?>" data-message-id="confirmDelete" class="askConfirmation button linkButton icon iconDelete">
		<span><?php echo SpoonFilter::ucfirst($this->variables['lblDelete']); ?></span>
	</a>
</div>
<?php } ?>

<div id="confirmDelete" title="<?php echo SpoonFilter::ucfirst($this->variables['lblDelete']); ?>?" style="display: none;">
	<p><?php echo $this->variables['msgConfirmDeleteData']; ?></p>
</div>

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
