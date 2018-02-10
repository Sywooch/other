<?php error_reporting(E_ALL | E_STRICT); ini_set('display_errors', 'On'); ?>
<?php
				ob_start();
				?><?php if(array_key_exists('BACKEND_CORE_PATH', (array) $this->variables)) { echo $this->variables['BACKEND_CORE_PATH']; } else { ?>{$BACKEND_CORE_PATH}<?php } ?>/Layout/Templates/Head.tpl<?php
				$include = eval('return \'' . str_replace('\'', '\\\'', ob_get_clean()) .'\';');
				if($this->getForceCompile() || !file_exists($this->getCompileDirectory() .'/' . $this->getCompileName($include, '/home/segaz/domains/techno-mir.net/public_html/src/Backend/Modules/Profiles/Layout/Templates'))) $this->compile('/home/segaz/domains/techno-mir.net/public_html/src/Backend/Modules/Profiles/Layout/Templates', $include);
				$return = @include $this->getCompileDirectory() .'/' . $this->getCompileName($include, '/home/segaz/domains/techno-mir.net/public_html/src/Backend/Modules/Profiles/Layout/Templates');
				if($return === false && $this->compile('/home/segaz/domains/techno-mir.net/public_html/src/Backend/Modules/Profiles/Layout/Templates', $include))
				{
					$return = @include $this->getCompileDirectory() .'/' . $this->getCompileName($include, '/home/segaz/domains/techno-mir.net/public_html/src/Backend/Modules/Profiles/Layout/Templates');
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
				if($this->getForceCompile() || !file_exists($this->getCompileDirectory() .'/' . $this->getCompileName($include, '/home/segaz/domains/techno-mir.net/public_html/src/Backend/Modules/Profiles/Layout/Templates'))) $this->compile('/home/segaz/domains/techno-mir.net/public_html/src/Backend/Modules/Profiles/Layout/Templates', $include);
				$return = @include $this->getCompileDirectory() .'/' . $this->getCompileName($include, '/home/segaz/domains/techno-mir.net/public_html/src/Backend/Modules/Profiles/Layout/Templates');
				if($return === false && $this->compile('/home/segaz/domains/techno-mir.net/public_html/src/Backend/Modules/Profiles/Layout/Templates', $include))
				{
					$return = @include $this->getCompileDirectory() .'/' . $this->getCompileName($include, '/home/segaz/domains/techno-mir.net/public_html/src/Backend/Modules/Profiles/Layout/Templates');
				}
if($return === false)
				{
					?>{include:<?php if(array_key_exists('BACKEND_CORE_PATH', (array) $this->variables)) { echo $this->variables['BACKEND_CORE_PATH']; } else { ?>{$BACKEND_CORE_PATH}<?php } ?>/Layout/Templates/StructureStartModule.tpl}<?php
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
	<div class="box">
		<div class="heading">
			<h3><?php if(array_key_exists('lblProfile', (array) $this->variables)) { echo SpoonFilter::ucfirst($this->variables['lblProfile']); } else { ?>{$lblProfile|ucfirst}<?php } ?></h3>
		</div>
		<div class="options">
			<fieldset>
				<p>
					<label for="email"><?php if(array_key_exists('lblEmail', (array) $this->variables)) { echo SpoonFilter::ucfirst($this->variables['lblEmail']); } else { ?>{$lblEmail|ucfirst}<?php } ?><abbr title="<?php if(array_key_exists('lblRequiredField', (array) $this->variables)) { echo SpoonFilter::ucfirst($this->variables['lblRequiredField']); } else { ?>{$lblRequiredField|ucfirst}<?php } ?>">*</abbr></label>
					<?php if(array_key_exists('txtEmail', (array) $this->variables)) { echo $this->variables['txtEmail']; } else { ?>{$txtEmail}<?php } ?> <?php if(array_key_exists('txtEmailError', (array) $this->variables)) { echo $this->variables['txtEmailError']; } else { ?>{$txtEmailError}<?php } ?>
				</p>
				<p>
					<label for="displayName"><?php if(array_key_exists('lblDisplayName', (array) $this->variables)) { echo SpoonFilter::ucfirst($this->variables['lblDisplayName']); } else { ?>{$lblDisplayName|ucfirst}<?php } ?><abbr title="<?php if(array_key_exists('lblRequiredField', (array) $this->variables)) { echo SpoonFilter::ucfirst($this->variables['lblRequiredField']); } else { ?>{$lblRequiredField|ucfirst}<?php } ?>">*</abbr></label>
					<?php if(array_key_exists('txtDisplayName', (array) $this->variables)) { echo $this->variables['txtDisplayName']; } else { ?>{$txtDisplayName}<?php } ?> <?php if(array_key_exists('txtDisplayNameError', (array) $this->variables)) { echo $this->variables['txtDisplayNameError']; } else { ?>{$txtDisplayNameError}<?php } ?>
				</p>
				<p>
					<label for="password"><?php if(array_key_exists('lblPassword', (array) $this->variables)) { echo SpoonFilter::ucfirst($this->variables['lblPassword']); } else { ?>{$lblPassword|ucfirst}<?php } ?><abbr title="<?php if(array_key_exists('lblRequiredField', (array) $this->variables)) { echo SpoonFilter::ucfirst($this->variables['lblRequiredField']); } else { ?>{$lblRequiredField|ucfirst}<?php } ?>">*</abbr></label>
					<?php if(array_key_exists('txtPassword', (array) $this->variables)) { echo $this->variables['txtPassword']; } else { ?>{$txtPassword}<?php } ?> <?php if(array_key_exists('txtPasswordError', (array) $this->variables)) { echo $this->variables['txtPasswordError']; } else { ?>{$txtPasswordError}<?php } ?>
				</p>
			</fieldset>
		</div>

		<div class="heading">
			<h3><?php if(array_key_exists('lblSettings', (array) $this->variables)) { echo SpoonFilter::ucfirst($this->variables['lblSettings']); } else { ?>{$lblSettings|ucfirst}<?php } ?></h3>
		</div>
		<div class="options">
			<fieldset>
				<p>
					<label for="firstName"><?php if(array_key_exists('lblFirstName', (array) $this->variables)) { echo SpoonFilter::ucfirst($this->variables['lblFirstName']); } else { ?>{$lblFirstName|ucfirst}<?php } ?></label>
					<?php if(array_key_exists('txtFirstName', (array) $this->variables)) { echo $this->variables['txtFirstName']; } else { ?>{$txtFirstName}<?php } ?> <?php if(array_key_exists('txtFirstNameError', (array) $this->variables)) { echo $this->variables['txtFirstNameError']; } else { ?>{$txtFirstNameError}<?php } ?>
				</p>
				<p>
					<label for="lastName"><?php if(array_key_exists('lblLastName', (array) $this->variables)) { echo SpoonFilter::ucfirst($this->variables['lblLastName']); } else { ?>{$lblLastName|ucfirst}<?php } ?></label>
					<?php if(array_key_exists('txtLastName', (array) $this->variables)) { echo $this->variables['txtLastName']; } else { ?>{$txtLastName}<?php } ?> <?php if(array_key_exists('txtLastNameError', (array) $this->variables)) { echo $this->variables['txtLastNameError']; } else { ?>{$txtLastNameError}<?php } ?>
				</p>
				<p>
					<label for="gender"><?php if(array_key_exists('lblGender', (array) $this->variables)) { echo SpoonFilter::ucfirst($this->variables['lblGender']); } else { ?>{$lblGender|ucfirst}<?php } ?></label>
					<?php if(array_key_exists('ddmGender', (array) $this->variables)) { echo $this->variables['ddmGender']; } else { ?>{$ddmGender}<?php } ?> <?php if(array_key_exists('ddmGenderError', (array) $this->variables)) { echo $this->variables['ddmGenderError']; } else { ?>{$ddmGenderError}<?php } ?>
				</p>
				<p>
					<label for="day"><?php if(array_key_exists('lblBirthDate', (array) $this->variables)) { echo SpoonFilter::ucfirst($this->variables['lblBirthDate']); } else { ?>{$lblBirthDate|ucfirst}<?php } ?></label>
					<span class="tinyInput"><?php if(array_key_exists('ddmDay', (array) $this->variables)) { echo $this->variables['ddmDay']; } else { ?>{$ddmDay}<?php } ?></span> <span class="smallInput"><?php if(array_key_exists('ddmMonth', (array) $this->variables)) { echo $this->variables['ddmMonth']; } else { ?>{$ddmMonth}<?php } ?></span> <span class="tinyInput"><?php if(array_key_exists('ddmYear', (array) $this->variables)) { echo $this->variables['ddmYear']; } else { ?>{$ddmYear}<?php } ?></span> <?php if(array_key_exists('ddmYearError', (array) $this->variables)) { echo $this->variables['ddmYearError']; } else { ?>{$ddmYearError}<?php } ?>
				</p>
				<p>
					<label for="city"><?php if(array_key_exists('lblCity', (array) $this->variables)) { echo SpoonFilter::ucfirst($this->variables['lblCity']); } else { ?>{$lblCity|ucfirst}<?php } ?></label>
					<?php if(array_key_exists('txtCity', (array) $this->variables)) { echo $this->variables['txtCity']; } else { ?>{$txtCity}<?php } ?> <?php if(array_key_exists('txtCityError', (array) $this->variables)) { echo $this->variables['txtCityError']; } else { ?>{$txtCityError}<?php } ?>
				</p>
				<p>
					<label for="country"><?php if(array_key_exists('lblCountry', (array) $this->variables)) { echo SpoonFilter::ucfirst($this->variables['lblCountry']); } else { ?>{$lblCountry|ucfirst}<?php } ?></label>
					<?php if(array_key_exists('ddmCountry', (array) $this->variables)) { echo $this->variables['ddmCountry']; } else { ?>{$ddmCountry}<?php } ?> <?php if(array_key_exists('ddmCountryError', (array) $this->variables)) { echo $this->variables['ddmCountryError']; } else { ?>{$ddmCountryError}<?php } ?>
				</p>
			</fieldset>
		</div>
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
				if($this->getForceCompile() || !file_exists($this->getCompileDirectory() .'/' . $this->getCompileName($include, '/home/segaz/domains/techno-mir.net/public_html/src/Backend/Modules/Profiles/Layout/Templates'))) $this->compile('/home/segaz/domains/techno-mir.net/public_html/src/Backend/Modules/Profiles/Layout/Templates', $include);
				$return = @include $this->getCompileDirectory() .'/' . $this->getCompileName($include, '/home/segaz/domains/techno-mir.net/public_html/src/Backend/Modules/Profiles/Layout/Templates');
				if($return === false && $this->compile('/home/segaz/domains/techno-mir.net/public_html/src/Backend/Modules/Profiles/Layout/Templates', $include))
				{
					$return = @include $this->getCompileDirectory() .'/' . $this->getCompileName($include, '/home/segaz/domains/techno-mir.net/public_html/src/Backend/Modules/Profiles/Layout/Templates');
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
				if($this->getForceCompile() || !file_exists($this->getCompileDirectory() .'/' . $this->getCompileName($include, '/home/segaz/domains/techno-mir.net/public_html/src/Backend/Modules/Profiles/Layout/Templates'))) $this->compile('/home/segaz/domains/techno-mir.net/public_html/src/Backend/Modules/Profiles/Layout/Templates', $include);
				$return = @include $this->getCompileDirectory() .'/' . $this->getCompileName($include, '/home/segaz/domains/techno-mir.net/public_html/src/Backend/Modules/Profiles/Layout/Templates');
				if($return === false && $this->compile('/home/segaz/domains/techno-mir.net/public_html/src/Backend/Modules/Profiles/Layout/Templates', $include))
				{
					$return = @include $this->getCompileDirectory() .'/' . $this->getCompileName($include, '/home/segaz/domains/techno-mir.net/public_html/src/Backend/Modules/Profiles/Layout/Templates');
				}
if($return === false)
				{
					?>{include:<?php if(array_key_exists('BACKEND_CORE_PATH', (array) $this->variables)) { echo $this->variables['BACKEND_CORE_PATH']; } else { ?>{$BACKEND_CORE_PATH}<?php } ?>/Layout/Templates/Footer.tpl}<?php
				}
?>
