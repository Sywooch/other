<?php error_reporting(0); ini_set('display_errors', 'Off'); ?>
<ul>
	<li>&copy; <?php echo SpoonTemplateModifiers::date($this->variables['now'], 'Y'); ?> <?php echo $this->variables['siteTitle']; ?></li>
	<?php
				if(isset(${'footerLinks'})) $this->iterations['cce28d9af95f27a3085ea6887d023450_Footer.tpl.php_1']['old'] = ${'footerLinks'};
				$this->iterations['cce28d9af95f27a3085ea6887d023450_Footer.tpl.php_1']['iteration'] = $this->variables['footerLinks'];
				$this->iterations['cce28d9af95f27a3085ea6887d023450_Footer.tpl.php_1']['i'] = 1;
				$this->iterations['cce28d9af95f27a3085ea6887d023450_Footer.tpl.php_1']['count'] = count($this->iterations['cce28d9af95f27a3085ea6887d023450_Footer.tpl.php_1']['iteration']);
				foreach((array) $this->iterations['cce28d9af95f27a3085ea6887d023450_Footer.tpl.php_1']['iteration'] as ${'footerLinks'})
				{
					if(!isset(${'footerLinks'}['first']) && $this->iterations['cce28d9af95f27a3085ea6887d023450_Footer.tpl.php_1']['i'] == 1) ${'footerLinks'}['first'] = true;
					if(!isset(${'footerLinks'}['last']) && $this->iterations['cce28d9af95f27a3085ea6887d023450_Footer.tpl.php_1']['i'] == $this->iterations['cce28d9af95f27a3085ea6887d023450_Footer.tpl.php_1']['count']) ${'footerLinks'}['last'] = true;
					if(isset(${'footerLinks'}['formElements']) && is_array(${'footerLinks'}['formElements']))
					{
						foreach(${'footerLinks'}['formElements'] as $name => $object)
						{
							${'footerLinks'}[$name] = $object->parse();
							${'footerLinks'}[$name .'Error'] = (is_callable(array($object, 'getErrors')) && $object->getErrors() != '') ? '<span class="formError">' . $object->getErrors() .'</span>' : '';
						}
					} ?>
		<li<?php
					if(isset(${'footerLinks'}['selected']) && count(${'footerLinks'}['selected']) != 0 && ${'footerLinks'}['selected'] != '' && ${'footerLinks'}['selected'] !== false)
					{
						?> class="selected"<?php } ?>>
			<a href="<?php echo ${'footerLinks'}['url']; ?>" title="<?php echo ${'footerLinks'}['title']; ?>"<?php
					if(isset(${'footerLinks'}['rel']) && count(${'footerLinks'}['rel']) != 0 && ${'footerLinks'}['rel'] != '' && ${'footerLinks'}['rel'] !== false)
					{
						?> rel="<?php echo ${'footerLinks'}['rel']; ?>"<?php } ?>>
				<?php echo ${'footerLinks'}['navigation_title']; ?>
			</a>
		</li>
	<?php
					$this->iterations['cce28d9af95f27a3085ea6887d023450_Footer.tpl.php_1']['i']++;
				}
				if(isset($this->iterations['cce28d9af95f27a3085ea6887d023450_Footer.tpl.php_1']['old'])) ${'footerLinks'} = $this->iterations['cce28d9af95f27a3085ea6887d023450_Footer.tpl.php_1']['old'];
				else unset($this->iterations['cce28d9af95f27a3085ea6887d023450_Footer.tpl.php_1']);
				?>
	<li><a href="http://www.fork-cms.be" title="Fork CMS">Fork CMS</a></li>
</ul>