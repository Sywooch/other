<?php error_reporting(0); ini_set('display_errors', 'Off'); ?>
<?php
					if(isset($this->variables['warnings']) && count($this->variables['warnings']) != 0 && $this->variables['warnings'] != '' && $this->variables['warnings'] !== false)
					{
						?>
	<div class="box" id="widgetSettingsAnalyse">
		<div class="heading">
			<h3><?php echo SpoonFilter::ucfirst($this->variables['lblAnalysis']); ?></h3>
		</div>
		<div class="options content">
			<ul>
				<?php
				if(isset(${'warnings'})) $this->iterations['4cbea7a3e696f4dbea74c2da17e98197_Analyse.tpl.php_1']['old'] = ${'warnings'};
				$this->iterations['4cbea7a3e696f4dbea74c2da17e98197_Analyse.tpl.php_1']['iteration'] = $this->variables['warnings'];
				$this->iterations['4cbea7a3e696f4dbea74c2da17e98197_Analyse.tpl.php_1']['i'] = 1;
				$this->iterations['4cbea7a3e696f4dbea74c2da17e98197_Analyse.tpl.php_1']['count'] = count($this->iterations['4cbea7a3e696f4dbea74c2da17e98197_Analyse.tpl.php_1']['iteration']);
				foreach((array) $this->iterations['4cbea7a3e696f4dbea74c2da17e98197_Analyse.tpl.php_1']['iteration'] as ${'warnings'})
				{
					if(!isset(${'warnings'}['first']) && $this->iterations['4cbea7a3e696f4dbea74c2da17e98197_Analyse.tpl.php_1']['i'] == 1) ${'warnings'}['first'] = true;
					if(!isset(${'warnings'}['last']) && $this->iterations['4cbea7a3e696f4dbea74c2da17e98197_Analyse.tpl.php_1']['i'] == $this->iterations['4cbea7a3e696f4dbea74c2da17e98197_Analyse.tpl.php_1']['count']) ${'warnings'}['last'] = true;
					if(isset(${'warnings'}['formElements']) && is_array(${'warnings'}['formElements']))
					{
						foreach(${'warnings'}['formElements'] as $name => $object)
						{
							${'warnings'}[$name] = $object->parse();
							${'warnings'}[$name .'Error'] = (is_callable(array($object, 'getErrors')) && $object->getErrors() != '') ? '<span class="formError">' . $object->getErrors() .'</span>' : '';
						}
					} ?>
					<li><?php echo ${'warnings'}['message']; ?></li>
				<?php
					$this->iterations['4cbea7a3e696f4dbea74c2da17e98197_Analyse.tpl.php_1']['i']++;
				}
				if(isset($this->iterations['4cbea7a3e696f4dbea74c2da17e98197_Analyse.tpl.php_1']['old'])) ${'warnings'} = $this->iterations['4cbea7a3e696f4dbea74c2da17e98197_Analyse.tpl.php_1']['old'];
				else unset($this->iterations['4cbea7a3e696f4dbea74c2da17e98197_Analyse.tpl.php_1']);
				?>
			</ul>
		</div>
	</div>
<?php } ?>