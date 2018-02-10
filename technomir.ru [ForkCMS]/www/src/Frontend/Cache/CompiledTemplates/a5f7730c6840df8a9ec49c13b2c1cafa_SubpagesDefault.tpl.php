<?php error_reporting(E_ALL | E_STRICT); ini_set('display_errors', 'On'); ?>


<?php
					if(isset($this->variables['widgetSubpages']) && count($this->variables['widgetSubpages']) != 0 && $this->variables['widgetSubpages'] != '' && $this->variables['widgetSubpages'] !== false)
					{
						?>
	<div id="subpagesBlocks">
		<?php
					if(!isset($this->variables['widgetSubpages']))
					{
						?>{iteration:widgetSubpages}<?php
						$this->variables['widgetSubpages'] = array();
						$this->iterations['a5f7730c6840df8a9ec49c13b2c1cafa_SubpagesDefault.tpl.php_1']['fail'] = true;
					}
				if(isset(${'widgetSubpages'})) $this->iterations['a5f7730c6840df8a9ec49c13b2c1cafa_SubpagesDefault.tpl.php_1']['old'] = ${'widgetSubpages'};
				$this->iterations['a5f7730c6840df8a9ec49c13b2c1cafa_SubpagesDefault.tpl.php_1']['iteration'] = $this->variables['widgetSubpages'];
				$this->iterations['a5f7730c6840df8a9ec49c13b2c1cafa_SubpagesDefault.tpl.php_1']['i'] = 1;
				$this->iterations['a5f7730c6840df8a9ec49c13b2c1cafa_SubpagesDefault.tpl.php_1']['count'] = count($this->iterations['a5f7730c6840df8a9ec49c13b2c1cafa_SubpagesDefault.tpl.php_1']['iteration']);
				foreach((array) $this->iterations['a5f7730c6840df8a9ec49c13b2c1cafa_SubpagesDefault.tpl.php_1']['iteration'] as ${'widgetSubpages'})
				{
					if(!isset(${'widgetSubpages'}['first']) && $this->iterations['a5f7730c6840df8a9ec49c13b2c1cafa_SubpagesDefault.tpl.php_1']['i'] == 1) ${'widgetSubpages'}['first'] = true;
					if(!isset(${'widgetSubpages'}['last']) && $this->iterations['a5f7730c6840df8a9ec49c13b2c1cafa_SubpagesDefault.tpl.php_1']['i'] == $this->iterations['a5f7730c6840df8a9ec49c13b2c1cafa_SubpagesDefault.tpl.php_1']['count']) ${'widgetSubpages'}['last'] = true;
					if(isset(${'widgetSubpages'}['formElements']) && is_array(${'widgetSubpages'}['formElements']))
					{
						foreach(${'widgetSubpages'}['formElements'] as $name => $object)
						{
							${'widgetSubpages'}[$name] = $object->parse();
							${'widgetSubpages'}[$name .'Error'] = (is_callable(array($object, 'getErrors')) && $object->getErrors() != '') ? '<span class="formError">' . $object->getErrors() .'</span>' : '';
						}
					} ?>
			<div class="subpagesBlock">
				<h3><a href="<?php if(array_key_exists('full_url', (array) ${'widgetSubpages'})) { echo ${'widgetSubpages'}['full_url']; } else { ?>{$widgetSubpages->full_url}<?php } ?>" title="<?php if(array_key_exists('title', (array) ${'widgetSubpages'})) { echo ${'widgetSubpages'}['title']; } else { ?>{$widgetSubpages->title}<?php } ?>"><?php if(array_key_exists('title', (array) ${'widgetSubpages'})) { echo ${'widgetSubpages'}['title']; } else { ?>{$widgetSubpages->title}<?php } ?></a></h3>
				<?php if(array_key_exists('description', (array) ${'widgetSubpages'})) { echo ${'widgetSubpages'}['description']; } else { ?>{$widgetSubpages->description}<?php } ?>
			</div>
		<?php
					$this->iterations['a5f7730c6840df8a9ec49c13b2c1cafa_SubpagesDefault.tpl.php_1']['i']++;
				}
					if(isset($this->iterations['a5f7730c6840df8a9ec49c13b2c1cafa_SubpagesDefault.tpl.php_1']['fail']) && $this->iterations['a5f7730c6840df8a9ec49c13b2c1cafa_SubpagesDefault.tpl.php_1']['fail'] == true)
					{
						?>{/iteration:widgetSubpages}<?php
					}
				if(isset($this->iterations['a5f7730c6840df8a9ec49c13b2c1cafa_SubpagesDefault.tpl.php_1']['old'])) ${'widgetSubpages'} = $this->iterations['a5f7730c6840df8a9ec49c13b2c1cafa_SubpagesDefault.tpl.php_1']['old'];
				else unset($this->iterations['a5f7730c6840df8a9ec49c13b2c1cafa_SubpagesDefault.tpl.php_1']);
				?>
	</div>
<?php } ?>