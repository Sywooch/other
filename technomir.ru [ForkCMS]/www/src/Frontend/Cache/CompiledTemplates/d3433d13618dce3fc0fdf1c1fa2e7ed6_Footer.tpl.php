<?php error_reporting(0); ini_set('display_errors', 'Off'); ?>
<footer id="footer">
	<div class="container">
		<div id="footerLogo">
			<p>&copy; <?php echo SpoonTemplateModifiers::date($this->variables['now'], 'Y'); ?> <?php echo $this->variables['siteTitle']; ?></p>
		</div>
		<nav id="footerNavigation">
			<h4><?php echo $this->variables['lblFooterNavigation']; ?></h4>
			<ul>
				<?php
				if(isset(${'footerLinks'})) $this->iterations['d3433d13618dce3fc0fdf1c1fa2e7ed6_Footer.tpl.php_1']['old'] = ${'footerLinks'};
				$this->iterations['d3433d13618dce3fc0fdf1c1fa2e7ed6_Footer.tpl.php_1']['iteration'] = $this->variables['footerLinks'];
				$this->iterations['d3433d13618dce3fc0fdf1c1fa2e7ed6_Footer.tpl.php_1']['i'] = 1;
				$this->iterations['d3433d13618dce3fc0fdf1c1fa2e7ed6_Footer.tpl.php_1']['count'] = count($this->iterations['d3433d13618dce3fc0fdf1c1fa2e7ed6_Footer.tpl.php_1']['iteration']);
				foreach((array) $this->iterations['d3433d13618dce3fc0fdf1c1fa2e7ed6_Footer.tpl.php_1']['iteration'] as ${'footerLinks'})
				{
					if(!isset(${'footerLinks'}['first']) && $this->iterations['d3433d13618dce3fc0fdf1c1fa2e7ed6_Footer.tpl.php_1']['i'] == 1) ${'footerLinks'}['first'] = true;
					if(!isset(${'footerLinks'}['last']) && $this->iterations['d3433d13618dce3fc0fdf1c1fa2e7ed6_Footer.tpl.php_1']['i'] == $this->iterations['d3433d13618dce3fc0fdf1c1fa2e7ed6_Footer.tpl.php_1']['count']) ${'footerLinks'}['last'] = true;
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
					$this->iterations['d3433d13618dce3fc0fdf1c1fa2e7ed6_Footer.tpl.php_1']['i']++;
				}
				if(isset($this->iterations['d3433d13618dce3fc0fdf1c1fa2e7ed6_Footer.tpl.php_1']['old'])) ${'footerLinks'} = $this->iterations['d3433d13618dce3fc0fdf1c1fa2e7ed6_Footer.tpl.php_1']['old'];
				else unset($this->iterations['d3433d13618dce3fc0fdf1c1fa2e7ed6_Footer.tpl.php_1']);
				?>
				<li><a href="http://www.fork-cms.com" title="Fork CMS">Fork CMS</a></li>
			</ul>
		</nav>
	</div>
</footer>