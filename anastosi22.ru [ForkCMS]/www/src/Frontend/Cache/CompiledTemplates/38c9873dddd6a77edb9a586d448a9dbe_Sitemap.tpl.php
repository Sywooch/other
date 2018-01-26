<?php error_reporting(0); ini_set('display_errors', 'Off'); ?>
<?php
					if(isset($this->variables['navigation']) && count($this->variables['navigation']) != 0 && $this->variables['navigation'] != '' && $this->variables['navigation'] !== false)
					{
						?>
	<ul>
		<?php
				if(isset(${'navigation'})) $this->iterations['38c9873dddd6a77edb9a586d448a9dbe_Sitemap.tpl.php_1']['old'] = ${'navigation'};
				$this->iterations['38c9873dddd6a77edb9a586d448a9dbe_Sitemap.tpl.php_1']['iteration'] = $this->variables['navigation'];
				$this->iterations['38c9873dddd6a77edb9a586d448a9dbe_Sitemap.tpl.php_1']['i'] = 1;
				$this->iterations['38c9873dddd6a77edb9a586d448a9dbe_Sitemap.tpl.php_1']['count'] = count($this->iterations['38c9873dddd6a77edb9a586d448a9dbe_Sitemap.tpl.php_1']['iteration']);
				foreach((array) $this->iterations['38c9873dddd6a77edb9a586d448a9dbe_Sitemap.tpl.php_1']['iteration'] as ${'navigation'})
				{
					if(!isset(${'navigation'}['first']) && $this->iterations['38c9873dddd6a77edb9a586d448a9dbe_Sitemap.tpl.php_1']['i'] == 1) ${'navigation'}['first'] = true;
					if(!isset(${'navigation'}['last']) && $this->iterations['38c9873dddd6a77edb9a586d448a9dbe_Sitemap.tpl.php_1']['i'] == $this->iterations['38c9873dddd6a77edb9a586d448a9dbe_Sitemap.tpl.php_1']['count']) ${'navigation'}['last'] = true;
					if(isset(${'navigation'}['formElements']) && is_array(${'navigation'}['formElements']))
					{
						foreach(${'navigation'}['formElements'] as $name => $object)
						{
							${'navigation'}[$name] = $object->parse();
							${'navigation'}[$name .'Error'] = (is_callable(array($object, 'getErrors')) && $object->getErrors() != '') ? '<span class="formError">' . $object->getErrors() .'</span>' : '';
						}
					} ?>
			<li>
				<a href="<?php echo ${'navigation'}['link']; ?>" title="<?php echo ${'navigation'}['navigation_title']; ?>"<?php
					if(isset(${'navigation'}['nofollow']) && count(${'navigation'}['nofollow']) != 0 && ${'navigation'}['nofollow'] != '' && ${'navigation'}['nofollow'] !== false)
					{
						?> rel="nofollow"<?php } ?>><?php echo ${'navigation'}['navigation_title']; ?></a>
				<?php echo ${'navigation'}['children']; ?>
			</li>
		<?php
					$this->iterations['38c9873dddd6a77edb9a586d448a9dbe_Sitemap.tpl.php_1']['i']++;
				}
				if(isset($this->iterations['38c9873dddd6a77edb9a586d448a9dbe_Sitemap.tpl.php_1']['old'])) ${'navigation'} = $this->iterations['38c9873dddd6a77edb9a586d448a9dbe_Sitemap.tpl.php_1']['old'];
				else unset($this->iterations['38c9873dddd6a77edb9a586d448a9dbe_Sitemap.tpl.php_1']);
				?>
	</ul>
<?php } ?>