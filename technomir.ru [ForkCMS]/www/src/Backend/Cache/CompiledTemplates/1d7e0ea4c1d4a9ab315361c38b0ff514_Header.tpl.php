<?php error_reporting(E_ALL | E_STRICT); ini_set('display_errors', 'On'); ?>
<div id="headerHolder">
	<h1><a href="/<?php
					if(isset($this->variables['SITE_MULTILANGUAGE']) && count($this->variables['SITE_MULTILANGUAGE']) != 0 && $this->variables['SITE_MULTILANGUAGE'] != '' && $this->variables['SITE_MULTILANGUAGE'] !== false)
					{
						?><?php if(array_key_exists('LANGUAGE', (array) $this->variables)) { echo $this->variables['LANGUAGE']; } else { ?>{$LANGUAGE}<?php } ?><?php } ?>" title="<?php if(array_key_exists('lblVisitWebsite', (array) $this->variables)) { echo SpoonFilter::ucfirst($this->variables['lblVisitWebsite']); } else { ?>{$lblVisitWebsite|ucfirst}<?php } ?>"><?php if(array_key_exists('SITE_TITLE', (array) $this->variables)) { echo $this->variables['SITE_TITLE']; } else { ?>{$SITE_TITLE}<?php } ?></a></h1>
	<table id="header">
		<tr>
			<td id="navigation">
				<?php if(array_key_exists('var', (array) $this->variables)) { echo Backend\Core\Engine\TemplateModifiers::getMainNavigation($this->variables['var']); } else { ?>{$var|getmainnavigation}<?php } ?>
			</td>
			<td id="user">
				<ul>
					<?php
					if(isset($this->variables['debug']) && count($this->variables['debug']) != 0 && $this->variables['debug'] != '' && $this->variables['debug'] !== false)
					{
						?>
						<li>
							<div id="debugnotify"><?php if(array_key_exists('lblDebugMode', (array) $this->variables)) { echo SpoonFilter::ucfirst($this->variables['lblDebugMode']); } else { ?>{$lblDebugMode|ucfirst}<?php } ?></div>
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
							<label for="workingLanguage"><?php if(array_key_exists('msgNowEditing', (array) $this->variables)) { echo $this->variables['msgNowEditing']; } else { ?>{$msgNowEditing}<?php } ?>:</label>
							<select id="workingLanguage">
								<?php
					if(!isset($this->variables['workingLanguages']))
					{
						?>{iteration:workingLanguages}<?php
						$this->variables['workingLanguages'] = array();
						$this->iterations['1d7e0ea4c1d4a9ab315361c38b0ff514_Header.tpl.php_1']['fail'] = true;
					}
				if(isset(${'workingLanguages'})) $this->iterations['1d7e0ea4c1d4a9ab315361c38b0ff514_Header.tpl.php_1']['old'] = ${'workingLanguages'};
				$this->iterations['1d7e0ea4c1d4a9ab315361c38b0ff514_Header.tpl.php_1']['iteration'] = $this->variables['workingLanguages'];
				$this->iterations['1d7e0ea4c1d4a9ab315361c38b0ff514_Header.tpl.php_1']['i'] = 1;
				$this->iterations['1d7e0ea4c1d4a9ab315361c38b0ff514_Header.tpl.php_1']['count'] = count($this->iterations['1d7e0ea4c1d4a9ab315361c38b0ff514_Header.tpl.php_1']['iteration']);
				foreach((array) $this->iterations['1d7e0ea4c1d4a9ab315361c38b0ff514_Header.tpl.php_1']['iteration'] as ${'workingLanguages'})
				{
					if(!isset(${'workingLanguages'}['first']) && $this->iterations['1d7e0ea4c1d4a9ab315361c38b0ff514_Header.tpl.php_1']['i'] == 1) ${'workingLanguages'}['first'] = true;
					if(!isset(${'workingLanguages'}['last']) && $this->iterations['1d7e0ea4c1d4a9ab315361c38b0ff514_Header.tpl.php_1']['i'] == $this->iterations['1d7e0ea4c1d4a9ab315361c38b0ff514_Header.tpl.php_1']['count']) ${'workingLanguages'}['last'] = true;
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
						?> selected="selected"<?php } ?> value="<?php if(array_key_exists('abbr', (array) ${'workingLanguages'})) { echo ${'workingLanguages'}['abbr']; } else { ?>{$workingLanguages->abbr}<?php } ?>"><?php if(array_key_exists('label', (array) ${'workingLanguages'})) { echo SpoonFilter::ucfirst(${'workingLanguages'}['label']); } else { ?>{$workingLanguages->label|ucfirst}<?php } ?></option>
								<?php
					$this->iterations['1d7e0ea4c1d4a9ab315361c38b0ff514_Header.tpl.php_1']['i']++;
				}
					if(isset($this->iterations['1d7e0ea4c1d4a9ab315361c38b0ff514_Header.tpl.php_1']['fail']) && $this->iterations['1d7e0ea4c1d4a9ab315361c38b0ff514_Header.tpl.php_1']['fail'] == true)
					{
						?>{/iteration:workingLanguages}<?php
					}
				if(isset($this->iterations['1d7e0ea4c1d4a9ab315361c38b0ff514_Header.tpl.php_1']['old'])) ${'workingLanguages'} = $this->iterations['1d7e0ea4c1d4a9ab315361c38b0ff514_Header.tpl.php_1']['old'];
				else unset($this->iterations['1d7e0ea4c1d4a9ab315361c38b0ff514_Header.tpl.php_1']);
				?>
							</select>
						</li>
					<?php } ?>
					<?php } ?>

					<li id="account">
						<a href="#ddAccount" id="openAccountDropdown" class="fakeDropdown">
							<span class="avatar av24 block">
								<img src="<?php if(array_key_exists('FRONTEND_FILES_URL', (array) $this->variables)) { echo $this->variables['FRONTEND_FILES_URL']; } else { ?>{$FRONTEND_FILES_URL}<?php } ?>/backend_users/avatars/32x32/<?php if(array_key_exists('authenticatedUserAvatar', (array) $this->variables)) { echo $this->variables['authenticatedUserAvatar']; } else { ?>{$authenticatedUserAvatar}<?php } ?>" width="24" height="24" alt="<?php if(array_key_exists('authenticatedUserNickname', (array) $this->variables)) { echo $this->variables['authenticatedUserNickname']; } else { ?>{$authenticatedUserNickname}<?php } ?>" />
							</span>
							<span class="nickname"><?php if(array_key_exists('authenticatedUserNickname', (array) $this->variables)) { echo $this->variables['authenticatedUserNickname']; } else { ?>{$authenticatedUserNickname}<?php } ?></span>
							<span class="arrow">&#x25BC;</span>
						</a>
						<ul class="hidden" id="ddAccount">
							<?php
					if(isset($this->variables['authenticatedUserEditUrl']) && count($this->variables['authenticatedUserEditUrl']) != 0 && $this->variables['authenticatedUserEditUrl'] != '' && $this->variables['authenticatedUserEditUrl'] !== false)
					{
						?><li><a href="<?php if(array_key_exists('authenticatedUserEditUrl', (array) $this->variables)) { echo $this->variables['authenticatedUserEditUrl']; } else { ?>{$authenticatedUserEditUrl}<?php } ?>"><?php if(array_key_exists('lblEditProfile', (array) $this->variables)) { echo SpoonFilter::ucfirst($this->variables['lblEditProfile']); } else { ?>{$lblEditProfile|ucfirst}<?php } ?></a></li><?php } ?>
							<li class="lastChild"><a href="<?php if(array_key_exists('var', (array) $this->variables)) { echo Backend\Core\Engine\TemplateModifiers::getURL($this->variables['var'], 'logout', 'authentication'); } else { ?>{$var|geturl:'logout':'authentication'}<?php } ?>"><?php if(array_key_exists('lblSignOut', (array) $this->variables)) { echo SpoonFilter::ucfirst($this->variables['lblSignOut']); } else { ?>{$lblSignOut|ucfirst}<?php } ?></a></li>
						</ul>
					</li>
				</ul>
			</td>
		</tr>
	</table>
</div>
