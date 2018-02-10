<?php error_reporting(E_ALL | E_STRICT); ini_set('display_errors', 'On'); ?>
<?php
					if(isset($this->variables['navigation']) && count($this->variables['navigation']) != 0 && $this->variables['navigation'] != '' && $this->variables['navigation'] !== false)
					{
						?>
	<ul>
		<?php
					if(!isset($this->variables['navigation']))
					{
						?>{iteration:navigation}<?php
						$this->variables['navigation'] = array();
						$this->iterations['7eb43dfeb4beb2a6f116ac8a07a34ece_Navigation.tpl.php_1']['fail'] = true;
					}
				if(isset(${'navigation'})) $this->iterations['7eb43dfeb4beb2a6f116ac8a07a34ece_Navigation.tpl.php_1']['old'] = ${'navigation'};
				$this->iterations['7eb43dfeb4beb2a6f116ac8a07a34ece_Navigation.tpl.php_1']['iteration'] = $this->variables['navigation'];
				$this->iterations['7eb43dfeb4beb2a6f116ac8a07a34ece_Navigation.tpl.php_1']['i'] = 1;
				$this->iterations['7eb43dfeb4beb2a6f116ac8a07a34ece_Navigation.tpl.php_1']['count'] = count($this->iterations['7eb43dfeb4beb2a6f116ac8a07a34ece_Navigation.tpl.php_1']['iteration']);
				foreach((array) $this->iterations['7eb43dfeb4beb2a6f116ac8a07a34ece_Navigation.tpl.php_1']['iteration'] as ${'navigation'})
				{
					if(!isset(${'navigation'}['first']) && $this->iterations['7eb43dfeb4beb2a6f116ac8a07a34ece_Navigation.tpl.php_1']['i'] == 1) ${'navigation'}['first'] = true;
					if(!isset(${'navigation'}['last']) && $this->iterations['7eb43dfeb4beb2a6f116ac8a07a34ece_Navigation.tpl.php_1']['i'] == $this->iterations['7eb43dfeb4beb2a6f116ac8a07a34ece_Navigation.tpl.php_1']['count']) ${'navigation'}['last'] = true;
					if(isset(${'navigation'}['formElements']) && is_array(${'navigation'}['formElements']))
					{
						foreach(${'navigation'}['formElements'] as $name => $object)
						{
							${'navigation'}[$name] = $object->parse();
							${'navigation'}[$name .'Error'] = (is_callable(array($object, 'getErrors')) && $object->getErrors() != '') ? '<span class="formError">' . $object->getErrors() .'</span>' : '';
						}
					} ?>
			<li<?php
					if(isset(${'navigation'}['selected']) && count(${'navigation'}['selected']) != 0 && ${'navigation'}['selected'] != '' && ${'navigation'}['selected'] !== false)
					{
						?> class="selected"<?php } ?>>
				<a href="<?php if(array_key_exists('link', (array) ${'navigation'})) { echo ${'navigation'}['link']; } else { ?>{$navigation->link}<?php } ?>" title="<?php if(array_key_exists('navigation_title', (array) ${'navigation'})) { echo ${'navigation'}['navigation_title']; } else { ?>{$navigation->navigation_title}<?php } ?>"<?php
					if(isset(${'navigation'}['nofollow']) && count(${'navigation'}['nofollow']) != 0 && ${'navigation'}['nofollow'] != '' && ${'navigation'}['nofollow'] !== false)
					{
						?> rel="nofollow"<?php } ?>><?php if(array_key_exists('navigation_title', (array) ${'navigation'})) { echo ${'navigation'}['navigation_title']; } else { ?>{$navigation->navigation_title}<?php } ?></a>
				<?php
					if(isset(${'navigation'}['selected']) && count(${'navigation'}['selected']) != 0 && ${'navigation'}['selected'] != '' && ${'navigation'}['selected'] !== false)
					{
						?><?php if(array_key_exists('children', (array) ${'navigation'})) { echo ${'navigation'}['children']; } else { ?>{$navigation->children}<?php } ?><?php } ?>
			</li>
		<?php
					$this->iterations['7eb43dfeb4beb2a6f116ac8a07a34ece_Navigation.tpl.php_1']['i']++;
				}
					if(isset($this->iterations['7eb43dfeb4beb2a6f116ac8a07a34ece_Navigation.tpl.php_1']['fail']) && $this->iterations['7eb43dfeb4beb2a6f116ac8a07a34ece_Navigation.tpl.php_1']['fail'] == true)
					{
						?>{/iteration:navigation}<?php
					}
				if(isset($this->iterations['7eb43dfeb4beb2a6f116ac8a07a34ece_Navigation.tpl.php_1']['old'])) ${'navigation'} = $this->iterations['7eb43dfeb4beb2a6f116ac8a07a34ece_Navigation.tpl.php_1']['old'];
				else unset($this->iterations['7eb43dfeb4beb2a6f116ac8a07a34ece_Navigation.tpl.php_1']);
				?>
	</ul>
<?php } ?>