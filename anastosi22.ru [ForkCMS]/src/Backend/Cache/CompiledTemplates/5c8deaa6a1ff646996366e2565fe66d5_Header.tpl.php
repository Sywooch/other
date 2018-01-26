<?php error_reporting(0); ini_set('display_errors', 'Off'); ?>
<div id="headerHolder">
	<h1><a href="/<?php
					if(isset($this->variables['SITE_MULTILANGUAGE']) && count($this->variables['SITE_MULTILANGUAGE']) != 0 && $this->variables['SITE_MULTILANGUAGE'] != '' && $this->variables['SITE_MULTILANGUAGE'] !== false)
					{
						?><?php echo $this->variables['LANGUAGE']; ?><?php } ?>" title="<?php echo SpoonFilter::ucfirst($this->variables['lblVisitWebsite']); ?>"><?php echo $this->variables['SITE_TITLE']; ?></a></h1>
	<table id="header">
		<tr>
			<td id="navigation">
				<?php echo Backend\Core\Engine\TemplateModifiers::getMainNavigation($this->variables['var']); ?>
			</td>
			<td id="user">
				<ul>
					<?php
					if(isset($this->variables['debug']) && count($this->variables['debug']) != 0 && $this->variables['debug'] != '' && $this->variables['debug'] !== false)
					{
						?>
						<li>
							<div id="debugnotify"><?php echo SpoonFilter::ucfirst($this->variables['lblDebugMode']); ?></div>
						</li>
					<?php } ?>

					<?php
					if(isset($this->variables['SITE_MULTILANGUAGE']) && count($this->variables['SITE_MULTILANGUAGE']) != 0 && $this->variables['SITE_MULTILANGUAGE'] != '' && $this->variables['SITE_MULTILANGUAGE'] !== false)
					{
						?>
					<?php
					if(isset($this->variables['workingLanguages']) && count($this->variables['workingLanguages']) != 0 && $this->variables['workingLanguages'] != '' && $this->variables['workingLanguages'] !== false)
					{
						?>
						<li>
							<label for="workingLanguage"><?php echo $this->variables['msgNowEditing']; ?>:</label>
							<select id="workingLanguage">
								<?php
				if(isset(${'workingLanguages'})) $this->iterations['5c8deaa6a1ff646996366e2565fe66d5_Header.tpl.php_1']['old'] = ${'workingLanguages'};
				$this->iterations['5c8deaa6a1ff646996366e2565fe66d5_Header.tpl.php_1']['iteration'] = $this->variables['workingLanguages'];
				$this->iterations['5c8deaa6a1ff646996366e2565fe66d5_Header.tpl.php_1']['i'] = 1;
				$this->iterations['5c8deaa6a1ff646996366e2565fe66d5_Header.tpl.php_1']['count'] = count($this->iterations['5c8deaa6a1ff646996366e2565fe66d5_Header.tpl.php_1']['iteration']);
				foreach((array) $this->iterations['5c8deaa6a1ff646996366e2565fe66d5_Header.tpl.php_1']['iteration'] as ${'workingLanguages'})
				{
					if(!isset(${'workingLanguages'}['first']) && $this->iterations['5c8deaa6a1ff646996366e2565fe66d5_Header.tpl.php_1']['i'] == 1) ${'workingLanguages'}['first'] = true;
					if(!isset(${'workingLanguages'}['last']) && $this->iterations['5c8deaa6a1ff646996366e2565fe66d5_Header.tpl.php_1']['i'] == $this->iterations['5c8deaa6a1ff646996366e2565fe66d5_Header.tpl.php_1']['count']) ${'workingLanguages'}['last'] = true;
					if(isset(${'workingLanguages'}['formElements']) && is_array(${'workingLanguages'}['formElements']))
					{
						foreach(${'workingLanguages'}['formElements'] as $name => $object)
						{
							${'workingLanguages'}[$name] = $object->parse();
							${'workingLanguages'}[$name .'Error'] = (is_callable(array($object, 'getErrors')) && $object->getErrors() != '') ? '<span class="formError">' . $object->getErrors() .'</span>' : '';
						}
					} ?>
									<option<?php
					if(isset(${'workingLanguages'}['selected']) && count(${'workingLanguages'}['selected']) != 0 && ${'workingLanguages'}['selected'] != '' && ${'workingLanguages'}['selected'] !== false)
					{
						?> selected="selected"<?php } ?> value="<?php echo ${'workingLanguages'}['abbr']; ?>"><?php echo SpoonFilter::ucfirst(${'workingLanguages'}['label']); ?></option>
								<?php
					$this->iterations['5c8deaa6a1ff646996366e2565fe66d5_Header.tpl.php_1']['i']++;
				}
				if(isset($this->iterations['5c8deaa6a1ff646996366e2565fe66d5_Header.tpl.php_1']['old'])) ${'workingLanguages'} = $this->iterations['5c8deaa6a1ff646996366e2565fe66d5_Header.tpl.php_1']['old'];
				else unset($this->iterations['5c8deaa6a1ff646996366e2565fe66d5_Header.tpl.php_1']);
				?>
							</select>
						</li>
					<?php } ?>
					<?php } ?>

					<li id="account">
						<a href="#ddAccount" id="openAccountDropdown" class="fakeDropdown">
							<span class="avatar av24 block">
								<img src="<?php echo $this->variables['FRONTEND_FILES_URL']; ?>/backend_users/avatars/32x32/<?php echo $this->variables['authenticatedUserAvatar']; ?>" width="24" height="24" alt="<?php echo $this->variables['authenticatedUserNickname']; ?>" />
							</span>
							<span class="nickname"><?php echo $this->variables['authenticatedUserNickname']; ?></span>
							<span class="arrow">&#x25BC;</span>
						</a>
						<ul class="hidden" id="ddAccount">
							<?php
					if(isset($this->variables['authenticatedUserEditUrl']) && count($this->variables['authenticatedUserEditUrl']) != 0 && $this->variables['authenticatedUserEditUrl'] != '' && $this->variables['authenticatedUserEditUrl'] !== false)
					{
						?><li><a href="<?php echo $this->variables['authenticatedUserEditUrl']; ?>"><?php echo SpoonFilter::ucfirst($this->variables['lblEditProfile']); ?></a></li><?php } ?>
							<li class="lastChild"><a href="<?php echo Backend\Core\Engine\TemplateModifiers::getURL($this->variables['var'], 'logout', 'authentication'); ?>"><?php echo SpoonFilter::ucfirst($this->variables['lblSignOut']); ?></a></li>
						</ul>
					</li>
				</ul>
			</td>
		</tr>
	</table>
</div>
