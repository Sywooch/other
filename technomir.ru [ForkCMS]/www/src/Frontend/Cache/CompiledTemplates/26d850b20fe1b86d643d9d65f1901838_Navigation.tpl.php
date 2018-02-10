<?php error_reporting(E_ALL | E_STRICT); ini_set('display_errors', 'On'); ?>
<?php
					if(isset($this->variables['navigation']) && count($this->variables['navigation']) != 0 && $this->variables['navigation'] != '' && $this->variables['navigation'] !== false)
					{
						?>

		<?php
					if(!isset($this->variables['navigation']))
					{
						?>{iteration:navigation}<?php
						$this->variables['navigation'] = array();
						$this->iterations['26d850b20fe1b86d643d9d65f1901838_Navigation.tpl.php_1']['fail'] = true;
					}
				if(isset(${'navigation'})) $this->iterations['26d850b20fe1b86d643d9d65f1901838_Navigation.tpl.php_1']['old'] = ${'navigation'};
				$this->iterations['26d850b20fe1b86d643d9d65f1901838_Navigation.tpl.php_1']['iteration'] = $this->variables['navigation'];
				$this->iterations['26d850b20fe1b86d643d9d65f1901838_Navigation.tpl.php_1']['i'] = 1;
				$this->iterations['26d850b20fe1b86d643d9d65f1901838_Navigation.tpl.php_1']['count'] = count($this->iterations['26d850b20fe1b86d643d9d65f1901838_Navigation.tpl.php_1']['iteration']);
				foreach((array) $this->iterations['26d850b20fe1b86d643d9d65f1901838_Navigation.tpl.php_1']['iteration'] as ${'navigation'})
				{
					if(!isset(${'navigation'}['first']) && $this->iterations['26d850b20fe1b86d643d9d65f1901838_Navigation.tpl.php_1']['i'] == 1) ${'navigation'}['first'] = true;
					if(!isset(${'navigation'}['last']) && $this->iterations['26d850b20fe1b86d643d9d65f1901838_Navigation.tpl.php_1']['i'] == $this->iterations['26d850b20fe1b86d643d9d65f1901838_Navigation.tpl.php_1']['count']) ${'navigation'}['last'] = true;
					if(isset(${'navigation'}['formElements']) && is_array(${'navigation'}['formElements']))
					{
						foreach(${'navigation'}['formElements'] as $name => $object)
						{
							${'navigation'}[$name] = $object->parse();
							${'navigation'}[$name .'Error'] = (is_callable(array($object, 'getErrors')) && $object->getErrors() != '') ? '<span class="formError">' . $object->getErrors() .'</span>' : '';
						}
					} ?>

			<?php if(!isset(${'navigation'}['children']) || count(${'navigation'}['children']) == 0 || ${'navigation'}['children'] == '' || ${'navigation'}['children'] === false): ?>
			<li<?php
					if(isset(${'navigation'}['selected']) && count(${'navigation'}['selected']) != 0 && ${'navigation'}['selected'] != '' && ${'navigation'}['selected'] !== false)
					{
						?> class="active"<?php } ?>>
				<a href="<?php if(array_key_exists('link', (array) ${'navigation'})) { echo ${'navigation'}['link']; } else { ?>{$navigation->link}<?php } ?>" title="<?php if(array_key_exists('navigation_title', (array) ${'navigation'})) { echo ${'navigation'}['navigation_title']; } else { ?>{$navigation->navigation_title}<?php } ?>"<?php
					if(isset(${'navigation'}['nofollow']) && count(${'navigation'}['nofollow']) != 0 && ${'navigation'}['nofollow'] != '' && ${'navigation'}['nofollow'] !== false)
					{
						?> rel="nofollow"<?php } ?>><?php if(array_key_exists('navigation_title', (array) ${'navigation'})) { echo ${'navigation'}['navigation_title']; } else { ?>{$navigation->navigation_title}<?php } ?></a>
			</li>
			<?php endif; ?>

			<?php
					if(isset(${'navigation'}['children']) && count(${'navigation'}['children']) != 0 && ${'navigation'}['children'] != '' && ${'navigation'}['children'] !== false)
					{
						?>
			<li class="dropdown<?php
					if(isset(${'navigation'}['selected']) && count(${'navigation'}['selected']) != 0 && ${'navigation'}['selected'] != '' && ${'navigation'}['selected'] !== false)
					{
						?> active<?php } ?>" id="dropdownNavigation">
				<a href="<?php if(array_key_exists('link', (array) ${'navigation'})) { echo ${'navigation'}['link']; } else { ?>{$navigation->link}<?php } ?>" class="dropdown-toggle" data-toggle="dropdown"><?php if(array_key_exists('navigation_title', (array) ${'navigation'})) { echo ${'navigation'}['navigation_title']; } else { ?>{$navigation->navigation_title}<?php } ?> <b class="caret"></b></a>
					<ul class="dropdown-menu">	
					<?php if(array_key_exists('children', (array) ${'navigation'})) { echo ${'navigation'}['children']; } else { ?>{$navigation->children}<?php } ?>
			</li>
			<?php } ?>
		
		<?php
					$this->iterations['26d850b20fe1b86d643d9d65f1901838_Navigation.tpl.php_1']['i']++;
				}
					if(isset($this->iterations['26d850b20fe1b86d643d9d65f1901838_Navigation.tpl.php_1']['fail']) && $this->iterations['26d850b20fe1b86d643d9d65f1901838_Navigation.tpl.php_1']['fail'] == true)
					{
						?>{/iteration:navigation}<?php
					}
				if(isset($this->iterations['26d850b20fe1b86d643d9d65f1901838_Navigation.tpl.php_1']['old'])) ${'navigation'} = $this->iterations['26d850b20fe1b86d643d9d65f1901838_Navigation.tpl.php_1']['old'];
				else unset($this->iterations['26d850b20fe1b86d643d9d65f1901838_Navigation.tpl.php_1']);
				?>
	</ul>
<?php } ?>