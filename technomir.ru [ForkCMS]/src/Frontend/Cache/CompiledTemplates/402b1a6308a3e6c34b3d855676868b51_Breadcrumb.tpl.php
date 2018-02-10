<?php error_reporting(E_ALL | E_STRICT); ini_set('display_errors', 'On'); ?>
<p itemprop="breadcrumb">
	<ol class="breadcrumb">	
	<?php
					if(!isset($this->variables['breadcrumb']))
					{
						?>{iteration:breadcrumb}<?php
						$this->variables['breadcrumb'] = array();
						$this->iterations['402b1a6308a3e6c34b3d855676868b51_Breadcrumb.tpl.php_1']['fail'] = true;
					}
				if(isset(${'breadcrumb'})) $this->iterations['402b1a6308a3e6c34b3d855676868b51_Breadcrumb.tpl.php_1']['old'] = ${'breadcrumb'};
				$this->iterations['402b1a6308a3e6c34b3d855676868b51_Breadcrumb.tpl.php_1']['iteration'] = $this->variables['breadcrumb'];
				$this->iterations['402b1a6308a3e6c34b3d855676868b51_Breadcrumb.tpl.php_1']['i'] = 1;
				$this->iterations['402b1a6308a3e6c34b3d855676868b51_Breadcrumb.tpl.php_1']['count'] = count($this->iterations['402b1a6308a3e6c34b3d855676868b51_Breadcrumb.tpl.php_1']['iteration']);
				foreach((array) $this->iterations['402b1a6308a3e6c34b3d855676868b51_Breadcrumb.tpl.php_1']['iteration'] as ${'breadcrumb'})
				{
					if(!isset(${'breadcrumb'}['first']) && $this->iterations['402b1a6308a3e6c34b3d855676868b51_Breadcrumb.tpl.php_1']['i'] == 1) ${'breadcrumb'}['first'] = true;
					if(!isset(${'breadcrumb'}['last']) && $this->iterations['402b1a6308a3e6c34b3d855676868b51_Breadcrumb.tpl.php_1']['i'] == $this->iterations['402b1a6308a3e6c34b3d855676868b51_Breadcrumb.tpl.php_1']['count']) ${'breadcrumb'}['last'] = true;
					if(isset(${'breadcrumb'}['formElements']) && is_array(${'breadcrumb'}['formElements']))
					{
						foreach(${'breadcrumb'}['formElements'] as $name => $object)
						{
							${'breadcrumb'}[$name] = $object->parse();
							${'breadcrumb'}[$name .'Error'] = (is_callable(array($object, 'getErrors')) && $object->getErrors() != '') ? '<span class="formError">' . $object->getErrors() .'</span>' : '';
						}
					} ?>
		<li <?php if(!isset(${'breadcrumb'}['last']) || count(${'breadcrumb'}['last']) == 0 || ${'breadcrumb'}['last'] == '' || ${'breadcrumb'}['last'] === false): ?>class="active"<?php endif; ?>><?php
					if(isset(${'breadcrumb'}['url']) && count(${'breadcrumb'}['url']) != 0 && ${'breadcrumb'}['url'] != '' && ${'breadcrumb'}['url'] !== false)
					{
						?><a href="<?php if(array_key_exists('url', (array) ${'breadcrumb'})) { echo ${'breadcrumb'}['url']; } else { ?>{$breadcrumb->url}<?php } ?>" title="<?php if(array_key_exists('title', (array) ${'breadcrumb'})) { echo ${'breadcrumb'}['title']; } else { ?>{$breadcrumb->title}<?php } ?>"><?php } ?><?php if(array_key_exists('title', (array) ${'breadcrumb'})) { echo ${'breadcrumb'}['title']; } else { ?>{$breadcrumb->title}<?php } ?><?php
					if(isset(${'breadcrumb'}['url']) && count(${'breadcrumb'}['url']) != 0 && ${'breadcrumb'}['url'] != '' && ${'breadcrumb'}['url'] !== false)
					{
						?></a><?php } ?></li>
	<?php
					$this->iterations['402b1a6308a3e6c34b3d855676868b51_Breadcrumb.tpl.php_1']['i']++;
				}
					if(isset($this->iterations['402b1a6308a3e6c34b3d855676868b51_Breadcrumb.tpl.php_1']['fail']) && $this->iterations['402b1a6308a3e6c34b3d855676868b51_Breadcrumb.tpl.php_1']['fail'] == true)
					{
						?>{/iteration:breadcrumb}<?php
					}
				if(isset($this->iterations['402b1a6308a3e6c34b3d855676868b51_Breadcrumb.tpl.php_1']['old'])) ${'breadcrumb'} = $this->iterations['402b1a6308a3e6c34b3d855676868b51_Breadcrumb.tpl.php_1']['old'];
				else unset($this->iterations['402b1a6308a3e6c34b3d855676868b51_Breadcrumb.tpl.php_1']);
				?>
	</ol>
</p>