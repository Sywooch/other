<?php error_reporting(0); ini_set('display_errors', 'Off'); ?>
<?php
				ob_start();
				?><?php echo $this->variables['PATH_WWW']; ?>/src/Install/Layout/Templates/Head.tpl<?php
				$include = eval('return \'' . str_replace('\'', '\\\'', ob_get_clean()) .'\';');
				if($this->getForceCompile() || !file_exists($this->getCompileDirectory() .'/' . $this->getCompileName($include, 'D:\localhost\htdocs\src\Install\Layout\Templates'))) $this->compile('D:\localhost\htdocs\src\Install\Layout\Templates', $include);
				$return = @include $this->getCompileDirectory() .'/' . $this->getCompileName($include, 'D:\localhost\htdocs\src\Install\Layout\Templates');
				if($return === false && $this->compile('D:\localhost\htdocs\src\Install\Layout\Templates', $include))
				{
					$return = @include $this->getCompileDirectory() .'/' . $this->getCompileName($include, 'D:\localhost\htdocs\src\Install\Layout\Templates');
				}
?>

<h2>Your login info</h2>
<?php
					if(isset($this->forms['step6']))
					{
						?><form accept-charset="UTF-8" action="<?php echo $this->forms['step6']->getAction(); ?>" method="<?php echo $this->forms['step6']->getMethod(); ?>"<?php echo $this->forms['step6']->getParametersHTML(); ?>>
						<?php echo $this->forms['step6']->getField('form')->parse();
						if($this->forms['step6']->getUseToken())
						{
							?><input type="hidden" name="form_token" id="<?php echo $this->forms['step6']->getField('form_token')->getAttribute('id'); ?>" value="<?php echo htmlspecialchars($this->forms['step6']->getField('form_token')->getValue()); ?>" />
						<?php } ?>
	<div class="horizontal">
		<p>Enter the e-mail address and password you'd like to use to log in.</p>
		<p>
			<label for="email">E-mail <abbr title="Required field">*</abbr></label>
			<?php echo $this->variables['txtEmail']; ?> <?php echo $this->variables['txtEmailError']; ?>
		</p>
		<p>
			<label for="password">Password <abbr title="Required field">*</abbr></label>
			<?php echo $this->variables['txtPassword']; ?> <?php echo $this->variables['txtPasswordError']; ?>
		</p>
		<table id="passwordStrengthMeter" class="passwordStrength" data-id="password">
			<tr>
				<td class="strength" id="passwordStrength">
					<p class="strength none">/</p>
					<p class="strength weak">Weak</p>
					<p class="strength ok">OK</p>
					<p class="strength strong">Strong</p>
				</td>
				<td>
					<p class="helpTxt">Strong passwords consist of a combination of capitals, small letters, digits and special characters.</p>
				</td>
			</tr>
		</table>
		<p>
			<label for="confirm">Confirm <abbr title="Required field">*</abbr></label>
			<?php echo $this->variables['txtConfirm']; ?> <?php echo $this->variables['txtConfirmError']; ?>
		</p>
	</div>
	<p class="spacing buttonHolder">
		<a href="index.php?step=5" class="button">Previous</a>
		<input id="installerButton" class="inputButton button mainButton" type="submit" name="installer" value="Finish installation" />
		<img id="ajaxSpinner" src="/src/Backend/Core/Layout/images/spinner.gif" width="16" height="16" alt="loading" style="float: left; margin-top: 4px; display: none;" />
	</p>
</form>
				<?php } ?>

<?php
				ob_start();
				?><?php echo $this->variables['PATH_WWW']; ?>/src/Install/Layout/Templates/Foot.tpl<?php
				$include = eval('return \'' . str_replace('\'', '\\\'', ob_get_clean()) .'\';');
				if($this->getForceCompile() || !file_exists($this->getCompileDirectory() .'/' . $this->getCompileName($include, 'D:\localhost\htdocs\src\Install\Layout\Templates'))) $this->compile('D:\localhost\htdocs\src\Install\Layout\Templates', $include);
				$return = @include $this->getCompileDirectory() .'/' . $this->getCompileName($include, 'D:\localhost\htdocs\src\Install\Layout\Templates');
				if($return === false && $this->compile('D:\localhost\htdocs\src\Install\Layout\Templates', $include))
				{
					$return = @include $this->getCompileDirectory() .'/' . $this->getCompileName($include, 'D:\localhost\htdocs\src\Install\Layout\Templates');
				}
?>
