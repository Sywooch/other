<?php error_reporting(E_ALL | E_STRICT); ini_set('display_errors', 'On'); ?>
<?php
					if(isset($this->variables['warnings']) && count($this->variables['warnings']) != 0 && $this->variables['warnings'] != '' && $this->variables['warnings'] !== false)
					{
						?>
	<div class="box" id="widgetSettingsAnalyse">
		<div class="heading">
			<h3><?php if(array_key_exists('lblAnalysis', (array) $this->variables)) { echo SpoonFilter::ucfirst($this->variables['lblAnalysis']); } else { ?>{$lblAnalysis|ucfirst}<?php } ?></h3>
		</div>
		<div class="options content">
			<ul>
				<?php
					if(!isset($this->variables['warnings']))
					{
						?>{iteration:warnings}<?php
						$this->variables['warnings'] = array();
						$this->iterations['83c9073b90f865be8f3a107c7cb78749_Analyse.tpl.php_1']['fail'] = true;
					}
				if(isset(${'warnings'})) $this->iterations['83c9073b90f865be8f3a107c7cb78749_Analyse.tpl.php_1']['old'] = ${'warnings'};
				$this->iterations['83c9073b90f865be8f3a107c7cb78749_Analyse.tpl.php_1']['iteration'] = $this->variables['warnings'];
				$this->iterations['83c9073b90f865be8f3a107c7cb78749_Analyse.tpl.php_1']['i'] = 1;
				$this->iterations['83c9073b90f865be8f3a107c7cb78749_Analyse.tpl.php_1']['count'] = count($this->iterations['83c9073b90f865be8f3a107c7cb78749_Analyse.tpl.php_1']['iteration']);
				foreach((array) $this->iterations['83c9073b90f865be8f3a107c7cb78749_Analyse.tpl.php_1']['iteration'] as ${'warnings'})
				{
					if(!isset(${'warnings'}['first']) && $this->iterations['83c9073b90f865be8f3a107c7cb78749_Analyse.tpl.php_1']['i'] == 1) ${'warnings'}['first'] = true;
					if(!isset(${'warnings'}['last']) && $this->iterations['83c9073b90f865be8f3a107c7cb78749_Analyse.tpl.php_1']['i'] == $this->iterations['83c9073b90f865be8f3a107c7cb78749_Analyse.tpl.php_1']['count']) ${'warnings'}['last'] = true;
					if(isset(${'warnings'}['formElements']) && is_array(${'warnings'}['formElements']))
					{
						foreach(${'warnings'}['formElements'] as $name => $object)
						{
							${'warnings'}[$name] = $object->parse();
							${'warnings'}[$name .'Error'] = (is_callable(array($object, 'getErrors')) && $object->getErrors() != '') ? '<span class="formError">' . $object->getErrors() .'</span>' : '';
						}
					} ?>
					<li><?php if(array_key_exists('message', (array) ${'warnings'})) { echo ${'warnings'}['message']; } else { ?>{$warnings->message}<?php } ?></li>
				<?php
					$this->iterations['83c9073b90f865be8f3a107c7cb78749_Analyse.tpl.php_1']['i']++;
				}
					if(isset($this->iterations['83c9073b90f865be8f3a107c7cb78749_Analyse.tpl.php_1']['fail']) && $this->iterations['83c9073b90f865be8f3a107c7cb78749_Analyse.tpl.php_1']['fail'] == true)
					{
						?>{/iteration:warnings}<?php
					}
				if(isset($this->iterations['83c9073b90f865be8f3a107c7cb78749_Analyse.tpl.php_1']['old'])) ${'warnings'} = $this->iterations['83c9073b90f865be8f3a107c7cb78749_Analyse.tpl.php_1']['old'];
				else unset($this->iterations['83c9073b90f865be8f3a107c7cb78749_Analyse.tpl.php_1']);
				?>
			</ul>
		</div>
	</div>
<?php } ?>