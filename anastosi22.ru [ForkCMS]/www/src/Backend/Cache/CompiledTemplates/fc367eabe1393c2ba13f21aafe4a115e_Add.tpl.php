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
					if(isset($this->forms['add']))
					{
						?><form accept-charset="UTF-8" action="<?php echo $this->forms['add']->getAction(); ?>" method="<?php echo $this->forms['add']->getMethod(); ?>"<?php echo $this->forms['add']->getParametersHTML(); ?>>
						<?php echo $this->forms['add']->getField('form')->parse();
						if($this->forms['add']->getUseToken())
						{
							?><input type="hidden" name="form_token" id="<?php echo $this->forms['add']->getField('form_token')->getAttribute('id'); ?>" value="<?php echo htmlspecialchars($this->forms['add']->getField('form_token')->getValue()); ?>" />
						<?php } ?>
	<div class="pageTitle">
		<h2><?php echo SpoonFilter::ucfirst($this->variables['lblFormBuilder']); ?>: <?php echo $this->variables['lblAdd']; ?></h2>
	</div>

	<div class="tabs">
		<ul>
			<li><a href="#tabGeneral"><?php echo SpoonFilter::ucfirst($this->variables['lblGeneral']); ?></a></li>
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
						<label for="email"><?php echo SpoonFilter::ucfirst($this->variables['lblRecipient']); ?><abbr title="<?php echo $this->variables['lblRequiredField']; ?>">*</abbr></label>
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
			</div>		</div>

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
		<div class="buttonHolderRight">
			<input id="addButton" class="inputButton button mainButton" type="submit" name="add" value="<?php echo SpoonFilter::ucfirst($this->variables['lblAdd']); ?>" />
		</div>
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
