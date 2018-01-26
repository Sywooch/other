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

<h2>Database configuration</h2>
<?php
					if(isset($this->forms['step5']))
					{
						?><form accept-charset="UTF-8" action="<?php echo $this->forms['step5']->getAction(); ?>" method="<?php echo $this->forms['step5']->getMethod(); ?>"<?php echo $this->forms['step5']->getParametersHTML(); ?>>
						<?php echo $this->forms['step5']->getField('form')->parse();
						if($this->forms['step5']->getUseToken())
						{
							?><input type="hidden" name="form_token" id="<?php echo $this->forms['step5']->getField('form_token')->getAttribute('id'); ?>" value="<?php echo htmlspecialchars($this->forms['step5']->getField('form_token')->getValue()); ?>" />
						<?php } ?>
	<?php
					if(isset($this->variables['formError']) && count($this->variables['formError']) != 0 && $this->variables['formError'] != '' && $this->variables['formError'] !== false)
					{
						?><div class="formMessage errorMessage"><p><?php echo $this->variables['formError']; ?></p></div><?php } ?>
	<div id="javascriptDisabled" class="formMessage errorMessage"><p>Javascript should be enabled.</p></div>
	<div class="horizontal">
		<p>Enter your database details. Make sure this database already exists.</p>
		<p>
			<label for="hostname">Hostname<abbr title="Required field">*</abbr></label>
			<?php echo $this->variables['txtHostname']; ?> : <?php echo $this->variables['txtPort']; ?> <?php echo $this->variables['txtHostnameError']; ?> <?php echo $this->variables['txtPortError']; ?>
			<span class="helpTxt">If you are working locally, your hostname is probably <strong>localhost</strong>.</span>
		</p>
		<p>
			<label for="database">Database<abbr title="Required field">*</abbr></label>
			<?php echo $this->variables['txtDatabase']; ?> <?php echo $this->variables['txtDatabaseError']; ?>
			<span class="helpTxt">Make sure this database is empty!</span>
		</p>
		<p>
			<label for="username">Username<abbr title="Required field">*</abbr></label>
			<?php echo $this->variables['txtUsername']; ?> <?php echo $this->variables['txtUsernameError']; ?>
		</p>
		<p>
			<label for="password">Password<abbr title="Required field">*</abbr></label>
			<?php echo $this->variables['txtPassword']; ?> <?php echo $this->variables['txtPasswordError']; ?>
		</p>
	</div>
	<p class="buttonHolder spacing">
		<a href="index.php?step=4" class="button">Previous</a>
		<input id="installerButton" class="button inputButton mainButton" type="submit" name="installer" value="Next" disabled="disabled" />
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
