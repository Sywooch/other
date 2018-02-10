<?php error_reporting(E_ALL | E_STRICT); ini_set('display_errors', 'On'); ?>


<section id="tagsIndex" class="mod">
	<div class="inner">
		<div class="bd content">
			<?php if(!isset($this->variables['tags']) || count($this->variables['tags']) == 0 || $this->variables['tags'] == '' || $this->variables['tags'] === false): ?><p><?php if(array_key_exists('msgTagsNoItems', (array) $this->variables)) { echo $this->variables['msgTagsNoItems']; } else { ?>{$msgTagsNoItems}<?php } ?></p><?php endif; ?>
			<?php
					if(isset($this->variables['tags']) && count($this->variables['tags']) != 0 && $this->variables['tags'] != '' && $this->variables['tags'] !== false)
					{
						?>
				<ul>
					<?php
					if(!isset($this->variables['tags']))
					{
						?>{iteration:tags}<?php
						$this->variables['tags'] = array();
						$this->iterations['99ec728399ccedadd1238ab381acb819_Index.tpl.php_1']['fail'] = true;
					}
				if(isset(${'tags'})) $this->iterations['99ec728399ccedadd1238ab381acb819_Index.tpl.php_1']['old'] = ${'tags'};
				$this->iterations['99ec728399ccedadd1238ab381acb819_Index.tpl.php_1']['iteration'] = $this->variables['tags'];
				$this->iterations['99ec728399ccedadd1238ab381acb819_Index.tpl.php_1']['i'] = 1;
				$this->iterations['99ec728399ccedadd1238ab381acb819_Index.tpl.php_1']['count'] = count($this->iterations['99ec728399ccedadd1238ab381acb819_Index.tpl.php_1']['iteration']);
				foreach((array) $this->iterations['99ec728399ccedadd1238ab381acb819_Index.tpl.php_1']['iteration'] as ${'tags'})
				{
					if(!isset(${'tags'}['first']) && $this->iterations['99ec728399ccedadd1238ab381acb819_Index.tpl.php_1']['i'] == 1) ${'tags'}['first'] = true;
					if(!isset(${'tags'}['last']) && $this->iterations['99ec728399ccedadd1238ab381acb819_Index.tpl.php_1']['i'] == $this->iterations['99ec728399ccedadd1238ab381acb819_Index.tpl.php_1']['count']) ${'tags'}['last'] = true;
					if(isset(${'tags'}['formElements']) && is_array(${'tags'}['formElements']))
					{
						foreach(${'tags'}['formElements'] as $name => $object)
						{
							${'tags'}[$name] = $object->parse();
							${'tags'}[$name .'Error'] = (is_callable(array($object, 'getErrors')) && $object->getErrors() != '') ? '<span class="formError">' . $object->getErrors() .'</span>' : '';
						}
					} ?>
						<li><a href="<?php if(array_key_exists('var', (array) $this->variables)) { echo Frontend\Core\Engine\TemplateModifiers::getURLForBlock($this->variables['var'], 'Tags', 'Detail'); } else { ?>{$var|geturlforblock:'Tags':'Detail'}<?php } ?>/<?php if(array_key_exists('url', (array) ${'tags'})) { echo ${'tags'}['url']; } else { ?>{$tags->url}<?php } ?>"><?php if(array_key_exists('name', (array) ${'tags'})) { echo ${'tags'}['name']; } else { ?>{$tags->name}<?php } ?></a></li>
					<?php
					$this->iterations['99ec728399ccedadd1238ab381acb819_Index.tpl.php_1']['i']++;
				}
					if(isset($this->iterations['99ec728399ccedadd1238ab381acb819_Index.tpl.php_1']['fail']) && $this->iterations['99ec728399ccedadd1238ab381acb819_Index.tpl.php_1']['fail'] == true)
					{
						?>{/iteration:tags}<?php
					}
				if(isset($this->iterations['99ec728399ccedadd1238ab381acb819_Index.tpl.php_1']['old'])) ${'tags'} = $this->iterations['99ec728399ccedadd1238ab381acb819_Index.tpl.php_1']['old'];
				else unset($this->iterations['99ec728399ccedadd1238ab381acb819_Index.tpl.php_1']);
				?>
				</ul>
			<?php } ?>
		</div>
	</div>
</section>
