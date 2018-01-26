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
					if(isset($this->forms['step3']))
					{
						?><form accept-charset="UTF-8" action="<?php echo $this->forms['step3']->getAction(); ?>" method="<?php echo $this->forms['step3']->getMethod(); ?>"<?php echo $this->forms['step3']->getParametersHTML(); ?>>
						<?php echo $this->forms['step3']->getField('form')->parse();
						if($this->forms['step3']->getUseToken())
						{
							?><input type="hidden" name="form_token" id="<?php echo $this->forms['step3']->getField('form_token')->getAttribute('id'); ?>" value="<?php echo htmlspecialchars($this->forms['step3']->getField('form_token')->getValue()); ?>" />
						<?php } ?>
	<?php
					if(isset($this->variables['formError']) && count($this->variables['formError']) != 0 && $this->variables['formError'] != '' && $this->variables['formError'] !== false)
					{
						?><div class="formMessage errorMessage"><p><?php echo $this->variables['formError']; ?></p></div><?php } ?>
		<div>
			<h3>Languages</h3>
			<p>Will your site be available in multiple languages or just one? Changing this setting later on will change your URL structure.</p>

			<ul class="inputList">
				<?php
				if(isset(${'language_type'})) $this->iterations['d5f630ebd4ca7e0564f629de31ae8e6e_Step3.tpl.php_1']['old'] = ${'language_type'};
				$this->iterations['d5f630ebd4ca7e0564f629de31ae8e6e_Step3.tpl.php_1']['iteration'] = $this->variables['language_type'];
				$this->iterations['d5f630ebd4ca7e0564f629de31ae8e6e_Step3.tpl.php_1']['i'] = 1;
				$this->iterations['d5f630ebd4ca7e0564f629de31ae8e6e_Step3.tpl.php_1']['count'] = count($this->iterations['d5f630ebd4ca7e0564f629de31ae8e6e_Step3.tpl.php_1']['iteration']);
				foreach((array) $this->iterations['d5f630ebd4ca7e0564f629de31ae8e6e_Step3.tpl.php_1']['iteration'] as ${'language_type'})
				{
					if(!isset(${'language_type'}['first']) && $this->iterations['d5f630ebd4ca7e0564f629de31ae8e6e_Step3.tpl.php_1']['i'] == 1) ${'language_type'}['first'] = true;
					if(!isset(${'language_type'}['last']) && $this->iterations['d5f630ebd4ca7e0564f629de31ae8e6e_Step3.tpl.php_1']['i'] == $this->iterations['d5f630ebd4ca7e0564f629de31ae8e6e_Step3.tpl.php_1']['count']) ${'language_type'}['last'] = true;
					if(isset(${'language_type'}['formElements']) && is_array(${'language_type'}['formElements']))
					{
						foreach(${'language_type'}['formElements'] as $name => $object)
						{
							${'language_type'}[$name] = $object->parse();
							${'language_type'}[$name .'Error'] = (is_callable(array($object, 'getErrors')) && $object->getErrors() != '') ? '<span class="formError">' . $object->getErrors() .'</span>' : '';
						}
					} ?>
					<li><?php echo ${'language_type'}['rbtLanguageType']; ?> <label for="<?php echo ${'language_type'}['id']; ?>"><?php echo ${'language_type'}['label']; ?></label>
					<?php
					if(isset(${'language_type'}['multiple']) && count(${'language_type'}['multiple']) != 0 && ${'language_type'}['multiple'] != '' && ${'language_type'}['multiple'] !== false)
					{
						?>
						<ul id="languages" class="hidden inputList noPadding">
							<?php
				if(isset(${'languages'})) $this->iterations['d5f630ebd4ca7e0564f629de31ae8e6e_Step3.tpl.php_3']['old'] = ${'languages'};
				$this->iterations['d5f630ebd4ca7e0564f629de31ae8e6e_Step3.tpl.php_3']['iteration'] = $this->variables['languages'];
				$this->iterations['d5f630ebd4ca7e0564f629de31ae8e6e_Step3.tpl.php_3']['i'] = 1;
				$this->iterations['d5f630ebd4ca7e0564f629de31ae8e6e_Step3.tpl.php_3']['count'] = count($this->iterations['d5f630ebd4ca7e0564f629de31ae8e6e_Step3.tpl.php_3']['iteration']);
				foreach((array) $this->iterations['d5f630ebd4ca7e0564f629de31ae8e6e_Step3.tpl.php_3']['iteration'] as ${'languages'})
				{
					if(!isset(${'languages'}['first']) && $this->iterations['d5f630ebd4ca7e0564f629de31ae8e6e_Step3.tpl.php_3']['i'] == 1) ${'languages'}['first'] = true;
					if(!isset(${'languages'}['last']) && $this->iterations['d5f630ebd4ca7e0564f629de31ae8e6e_Step3.tpl.php_3']['i'] == $this->iterations['d5f630ebd4ca7e0564f629de31ae8e6e_Step3.tpl.php_3']['count']) ${'languages'}['last'] = true;
					if(isset(${'languages'}['formElements']) && is_array(${'languages'}['formElements']))
					{
						foreach(${'languages'}['formElements'] as $name => $object)
						{
							${'languages'}[$name] = $object->parse();
							${'languages'}[$name .'Error'] = (is_callable(array($object, 'getErrors')) && $object->getErrors() != '') ? '<span class="formError">' . $object->getErrors() .'</span>' : '';
						}
					} ?>
								<li><?php echo ${'languages'}['chkLanguages']; ?> <label for="<?php echo ${'languages'}['id']; ?>"><?php echo ${'languages'}['label']; ?></label></li>
							<?php
					$this->iterations['d5f630ebd4ca7e0564f629de31ae8e6e_Step3.tpl.php_3']['i']++;
				}
				if(isset($this->iterations['d5f630ebd4ca7e0564f629de31ae8e6e_Step3.tpl.php_3']['old'])) ${'languages'} = $this->iterations['d5f630ebd4ca7e0564f629de31ae8e6e_Step3.tpl.php_3']['old'];
				else unset($this->iterations['d5f630ebd4ca7e0564f629de31ae8e6e_Step3.tpl.php_3']);
				?>
						</ul>
					<?php } ?>
					</li>
					<?php
					if(isset(${'language_type'}['single']) && count(${'language_type'}['single']) != 0 && ${'language_type'}['single'] != '' && ${'language_type'}['single'] !== false)
					{
						?>
						<li id="languageSingle" class="hidden">
							<?php echo $this->variables['ddmLanguage']; ?> <?php echo $this->variables['ddmLanguageError']; ?>
						</li>
					<?php } ?>
				<?php
					$this->iterations['d5f630ebd4ca7e0564f629de31ae8e6e_Step3.tpl.php_1']['i']++;
				}
				if(isset($this->iterations['d5f630ebd4ca7e0564f629de31ae8e6e_Step3.tpl.php_1']['old'])) ${'language_type'} = $this->iterations['d5f630ebd4ca7e0564f629de31ae8e6e_Step3.tpl.php_1']['old'];
				else unset($this->iterations['d5f630ebd4ca7e0564f629de31ae8e6e_Step3.tpl.php_1']);
				?>
			</ul>
			<div id="defaultLanguageContainer">
				<p>What is the default language we should use for the website?</p>
				<p><?php echo $this->variables['ddmDefaultLanguage']; ?> <?php echo $this->variables['ddmDefaultLanguageError']; ?></p>
			</div>

			<h3>CMS interface languages</h3>
			<p>What languages do you plan to use in the CMS interface?</p>

			<ul class="inputList">
				<li>
					<?php echo $this->variables['chkSameInterfaceLanguage']; ?> <label for="sameInterfaceLanguage">Use the same language(s) for the CMS interface.</label>
					<p id="interfaceLanguagesExplanation" class="hidden noPadding">Select the language(s) you would like to use use in the CMS interface.</p>
					<ul id="interfaceLanguages" class="hidden inputList noPadding">
						<?php
				if(isset(${'interfaceLanguages'})) $this->iterations['d5f630ebd4ca7e0564f629de31ae8e6e_Step3.tpl.php_2']['old'] = ${'interfaceLanguages'};
				$this->iterations['d5f630ebd4ca7e0564f629de31ae8e6e_Step3.tpl.php_2']['iteration'] = $this->variables['interfaceLanguages'];
				$this->iterations['d5f630ebd4ca7e0564f629de31ae8e6e_Step3.tpl.php_2']['i'] = 1;
				$this->iterations['d5f630ebd4ca7e0564f629de31ae8e6e_Step3.tpl.php_2']['count'] = count($this->iterations['d5f630ebd4ca7e0564f629de31ae8e6e_Step3.tpl.php_2']['iteration']);
				foreach((array) $this->iterations['d5f630ebd4ca7e0564f629de31ae8e6e_Step3.tpl.php_2']['iteration'] as ${'interfaceLanguages'})
				{
					if(!isset(${'interfaceLanguages'}['first']) && $this->iterations['d5f630ebd4ca7e0564f629de31ae8e6e_Step3.tpl.php_2']['i'] == 1) ${'interfaceLanguages'}['first'] = true;
					if(!isset(${'interfaceLanguages'}['last']) && $this->iterations['d5f630ebd4ca7e0564f629de31ae8e6e_Step3.tpl.php_2']['i'] == $this->iterations['d5f630ebd4ca7e0564f629de31ae8e6e_Step3.tpl.php_2']['count']) ${'interfaceLanguages'}['last'] = true;
					if(isset(${'interfaceLanguages'}['formElements']) && is_array(${'interfaceLanguages'}['formElements']))
					{
						foreach(${'interfaceLanguages'}['formElements'] as $name => $object)
						{
							${'interfaceLanguages'}[$name] = $object->parse();
							${'interfaceLanguages'}[$name .'Error'] = (is_callable(array($object, 'getErrors')) && $object->getErrors() != '') ? '<span class="formError">' . $object->getErrors() .'</span>' : '';
						}
					} ?>
							<li><?php echo ${'interfaceLanguages'}['chkInterfaceLanguages']; ?> <label for="<?php echo ${'interfaceLanguages'}['id']; ?>"><?php echo ${'interfaceLanguages'}['label']; ?></label></li>
						<?php
					$this->iterations['d5f630ebd4ca7e0564f629de31ae8e6e_Step3.tpl.php_2']['i']++;
				}
				if(isset($this->iterations['d5f630ebd4ca7e0564f629de31ae8e6e_Step3.tpl.php_2']['old'])) ${'interfaceLanguages'} = $this->iterations['d5f630ebd4ca7e0564f629de31ae8e6e_Step3.tpl.php_2']['old'];
				else unset($this->iterations['d5f630ebd4ca7e0564f629de31ae8e6e_Step3.tpl.php_2']);
				?>
					</ul>
				</li>
			</ul>
			<div id="defaultInterfaceLanguageContainer">
				<p>What is the default language we should use for the CMS interface?</p>
				<p><?php echo $this->variables['ddmDefaultInterfaceLanguage']; ?> <?php echo $this->variables['ddmDefaultInterfaceLanguageError']; ?></p>
			</div>
		</div>
		<div class="fullwidthOptions">
			<div class="buttonHolder">
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
