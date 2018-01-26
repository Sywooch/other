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

<h2>Settings</h2>
<?php
					if(isset($this->forms['step4']))
					{
						?><form accept-charset="UTF-8" action="<?php echo $this->forms['step4']->getAction(); ?>" method="<?php echo $this->forms['step4']->getMethod(); ?>"<?php echo $this->forms['step4']->getParametersHTML(); ?>>
						<?php echo $this->forms['step4']->getField('form')->parse();
						if($this->forms['step4']->getUseToken())
						{
							?><input type="hidden" name="form_token" id="<?php echo $this->forms['step4']->getField('form_token')->getAttribute('id'); ?>" value="<?php echo htmlspecialchars($this->forms['step4']->getField('form_token')->getValue()); ?>" />
						<?php } ?>
	<?php
					if(isset($this->variables['formError']) && count($this->variables['formError']) != 0 && $this->variables['formError'] != '' && $this->variables['formError'] !== false)
					{
						?><div class="formMessage errorMessage"><p><?php echo $this->variables['formError']; ?></p></div><?php } ?>
		<div>
			<h3 class="noPadding">Modules</h3>
			<p>Which modules would you like to install?</p>
			<ul id="moduleList" class="inputList noPadding">
				<?php
				if(isset(${'modules'})) $this->iterations['2d88691c8bb42dc1104157969d988a57_Step4.tpl.php_1']['old'] = ${'modules'};
				$this->iterations['2d88691c8bb42dc1104157969d988a57_Step4.tpl.php_1']['iteration'] = $this->variables['modules'];
				$this->iterations['2d88691c8bb42dc1104157969d988a57_Step4.tpl.php_1']['i'] = 1;
				$this->iterations['2d88691c8bb42dc1104157969d988a57_Step4.tpl.php_1']['count'] = count($this->iterations['2d88691c8bb42dc1104157969d988a57_Step4.tpl.php_1']['iteration']);
				foreach((array) $this->iterations['2d88691c8bb42dc1104157969d988a57_Step4.tpl.php_1']['iteration'] as ${'modules'})
				{
					if(!isset(${'modules'}['first']) && $this->iterations['2d88691c8bb42dc1104157969d988a57_Step4.tpl.php_1']['i'] == 1) ${'modules'}['first'] = true;
					if(!isset(${'modules'}['last']) && $this->iterations['2d88691c8bb42dc1104157969d988a57_Step4.tpl.php_1']['i'] == $this->iterations['2d88691c8bb42dc1104157969d988a57_Step4.tpl.php_1']['count']) ${'modules'}['last'] = true;
					if(isset(${'modules'}['formElements']) && is_array(${'modules'}['formElements']))
					{
						foreach(${'modules'}['formElements'] as $name => $object)
						{
							${'modules'}[$name] = $object->parse();
							${'modules'}[$name .'Error'] = (is_callable(array($object, 'getErrors')) && $object->getErrors() != '') ? '<span class="formError">' . $object->getErrors() .'</span>' : '';
						}
					} ?>
					<li><?php echo ${'modules'}['chkModules']; ?> <label for="<?php echo ${'modules'}['id']; ?>"><?php echo ${'modules'}['label']; ?></label></li>
				<?php
					$this->iterations['2d88691c8bb42dc1104157969d988a57_Step4.tpl.php_1']['i']++;
				}
				if(isset($this->iterations['2d88691c8bb42dc1104157969d988a57_Step4.tpl.php_1']['old'])) ${'modules'} = $this->iterations['2d88691c8bb42dc1104157969d988a57_Step4.tpl.php_1']['old'];
				else unset($this->iterations['2d88691c8bb42dc1104157969d988a57_Step4.tpl.php_1']);
				?>
			</ul>

			<h3>Example data</h3>
			<p>If you are new to Fork CMS, you might prefer to have an example website with a default theme set up.</p>
			<ul class="inputList noPadding">
				<li>
					<?php echo $this->variables['chkExampleData']; ?> <label for="exampleData">Install example data </label>
					<span class="helpTxt">(The blog-module is required and will be installed)</span>
				</li>
			</ul>

			<h3>Debug mode</h3>
			<p>Warning: debug mode is only useful when developing on Fork CMS.</p>
			<p>You can enable debug mode by adding "SetEnv FORK_DEBUG 1" in your virtualhosts file.</p>
			<ul class="inputList noPadding">
				<li>
					<?php echo $this->variables['chkDifferentDebugEmail']; ?> <label for="differentDebugEmail">Use a specific debug email address </label>
					<span class="helpTxt">(Exception emails will be sent to this email address)</span>
				</li>
				<li id="debugEmailHolder">
					<?php echo $this->variables['txtDebugEmail']; ?> <?php echo $this->variables['txtDebugEmailError']; ?>
				</li>
			</ul>
		</div>
		<div class="fullwidthOptions">
			<div class="buttonHolder">
				<a href="index.php?step=3" class="button">Previous</a>
				<input id="installerButton" class="inputButton button mainButton" type="submit" name="installer" value="Next" />
			</div>
		</div>
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
