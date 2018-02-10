<?php error_reporting(E_ALL | E_STRICT); ini_set('display_errors', 'On'); ?>
<?php
					if(isset($this->variables['languages']) && count($this->variables['languages']) != 0 && $this->variables['languages'] != '' && $this->variables['languages'] !== false)
					{
						?>
	<ul>
		<?php
					if(!isset($this->variables['languages']))
					{
						?>{iteration:languages}<?php
						$this->variables['languages'] = array();
						$this->iterations['19137f15fad28bda423562e58f47fc61_Languages.tpl.php_1']['fail'] = true;
					}
				if(isset(${'languages'})) $this->iterations['19137f15fad28bda423562e58f47fc61_Languages.tpl.php_1']['old'] = ${'languages'};
				$this->iterations['19137f15fad28bda423562e58f47fc61_Languages.tpl.php_1']['iteration'] = $this->variables['languages'];
				$this->iterations['19137f15fad28bda423562e58f47fc61_Languages.tpl.php_1']['i'] = 1;
				$this->iterations['19137f15fad28bda423562e58f47fc61_Languages.tpl.php_1']['count'] = count($this->iterations['19137f15fad28bda423562e58f47fc61_Languages.tpl.php_1']['iteration']);
				foreach((array) $this->iterations['19137f15fad28bda423562e58f47fc61_Languages.tpl.php_1']['iteration'] as ${'languages'})
				{
					if(!isset(${'languages'}['first']) && $this->iterations['19137f15fad28bda423562e58f47fc61_Languages.tpl.php_1']['i'] == 1) ${'languages'}['first'] = true;
					if(!isset(${'languages'}['last']) && $this->iterations['19137f15fad28bda423562e58f47fc61_Languages.tpl.php_1']['i'] == $this->iterations['19137f15fad28bda423562e58f47fc61_Languages.tpl.php_1']['count']) ${'languages'}['last'] = true;
					if(isset(${'languages'}['formElements']) && is_array(${'languages'}['formElements']))
					{
						foreach(${'languages'}['formElements'] as $name => $object)
						{
							${'languages'}[$name] = $object->parse();
							${'languages'}[$name .'Error'] = (is_callable(array($object, 'getErrors')) && $object->getErrors() != '') ? '<span class="formError">' . $object->getErrors() .'</span>' : '';
						}
					} ?>
			<li<?php
					if(isset(${'languages'}['current']) && count(${'languages'}['current']) != 0 && ${'languages'}['current'] != '' && ${'languages'}['current'] !== false)
					{
						?> class="selected"<?php } ?>>
				<a href="<?php if(array_key_exists('url', (array) ${'languages'})) { echo ${'languages'}['url']; } else { ?>{$languages->url}<?php } ?>"><?php if(array_key_exists('label', (array) ${'languages'})) { echo SpoonTemplateModifiers::uppercase(${'languages'}['label']); } else { ?>{$languages->label|uppercase}<?php } ?></a>
			</li>
		<?php
					$this->iterations['19137f15fad28bda423562e58f47fc61_Languages.tpl.php_1']['i']++;
				}
					if(isset($this->iterations['19137f15fad28bda423562e58f47fc61_Languages.tpl.php_1']['fail']) && $this->iterations['19137f15fad28bda423562e58f47fc61_Languages.tpl.php_1']['fail'] == true)
					{
						?>{/iteration:languages}<?php
					}
				if(isset($this->iterations['19137f15fad28bda423562e58f47fc61_Languages.tpl.php_1']['old'])) ${'languages'} = $this->iterations['19137f15fad28bda423562e58f47fc61_Languages.tpl.php_1']['old'];
				else unset($this->iterations['19137f15fad28bda423562e58f47fc61_Languages.tpl.php_1']);
				?>
	</ul>
<?php } ?>