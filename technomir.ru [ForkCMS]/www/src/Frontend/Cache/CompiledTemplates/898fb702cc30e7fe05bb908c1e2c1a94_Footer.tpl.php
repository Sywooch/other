<?php error_reporting(E_ALL | E_STRICT); ini_set('display_errors', 'On'); ?>
<footer id="footer">
	<div class="container">
		<hr>
		<div id="footerLogo">		
			<p>&copy; <?php if(array_key_exists('now', (array) $this->variables)) { echo SpoonTemplateModifiers::date($this->variables['now'], 'Y'); } else { ?>{$now|date:'Y'}<?php } ?> <?php if(array_key_exists('siteTitle', (array) $this->variables)) { echo $this->variables['siteTitle']; } else { ?>{$siteTitle}<?php } ?></p>
		</div>
		<nav id="footerNavigation">
			<h4><?php if(array_key_exists('lblFooterNavigation', (array) $this->variables)) { echo $this->variables['lblFooterNavigation']; } else { ?>{$lblFooterNavigation}<?php } ?></h4>
			<ul>
				<?php
					if(!isset($this->variables['footerLinks']))
					{
						?>{iteration:footerLinks}<?php
						$this->variables['footerLinks'] = array();
						$this->iterations['898fb702cc30e7fe05bb908c1e2c1a94_Footer.tpl.php_1']['fail'] = true;
					}
				if(isset(${'footerLinks'})) $this->iterations['898fb702cc30e7fe05bb908c1e2c1a94_Footer.tpl.php_1']['old'] = ${'footerLinks'};
				$this->iterations['898fb702cc30e7fe05bb908c1e2c1a94_Footer.tpl.php_1']['iteration'] = $this->variables['footerLinks'];
				$this->iterations['898fb702cc30e7fe05bb908c1e2c1a94_Footer.tpl.php_1']['i'] = 1;
				$this->iterations['898fb702cc30e7fe05bb908c1e2c1a94_Footer.tpl.php_1']['count'] = count($this->iterations['898fb702cc30e7fe05bb908c1e2c1a94_Footer.tpl.php_1']['iteration']);
				foreach((array) $this->iterations['898fb702cc30e7fe05bb908c1e2c1a94_Footer.tpl.php_1']['iteration'] as ${'footerLinks'})
				{
					if(!isset(${'footerLinks'}['first']) && $this->iterations['898fb702cc30e7fe05bb908c1e2c1a94_Footer.tpl.php_1']['i'] == 1) ${'footerLinks'}['first'] = true;
					if(!isset(${'footerLinks'}['last']) && $this->iterations['898fb702cc30e7fe05bb908c1e2c1a94_Footer.tpl.php_1']['i'] == $this->iterations['898fb702cc30e7fe05bb908c1e2c1a94_Footer.tpl.php_1']['count']) ${'footerLinks'}['last'] = true;
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
						?> class="active"<?php } ?>>
						<a href="<?php if(array_key_exists('url', (array) ${'footerLinks'})) { echo ${'footerLinks'}['url']; } else { ?>{$footerLinks->url}<?php } ?>" title="<?php if(array_key_exists('title', (array) ${'footerLinks'})) { echo ${'footerLinks'}['title']; } else { ?>{$footerLinks->title}<?php } ?>"<?php
					if(isset(${'footerLinks'}['rel']) && count(${'footerLinks'}['rel']) != 0 && ${'footerLinks'}['rel'] != '' && ${'footerLinks'}['rel'] !== false)
					{
						?> rel="<?php if(array_key_exists('rel', (array) ${'footerLinks'})) { echo ${'footerLinks'}['rel']; } else { ?>{$footerLinks->rel}<?php } ?>"<?php } ?>>
							<?php if(array_key_exists('navigation_title', (array) ${'footerLinks'})) { echo ${'footerLinks'}['navigation_title']; } else { ?>{$footerLinks->navigation_title}<?php } ?>
						</a>
					</li>
				<?php
					$this->iterations['898fb702cc30e7fe05bb908c1e2c1a94_Footer.tpl.php_1']['i']++;
				}
					if(isset($this->iterations['898fb702cc30e7fe05bb908c1e2c1a94_Footer.tpl.php_1']['fail']) && $this->iterations['898fb702cc30e7fe05bb908c1e2c1a94_Footer.tpl.php_1']['fail'] == true)
					{
						?>{/iteration:footerLinks}<?php
					}
				if(isset($this->iterations['898fb702cc30e7fe05bb908c1e2c1a94_Footer.tpl.php_1']['old'])) ${'footerLinks'} = $this->iterations['898fb702cc30e7fe05bb908c1e2c1a94_Footer.tpl.php_1']['old'];
				else unset($this->iterations['898fb702cc30e7fe05bb908c1e2c1a94_Footer.tpl.php_1']);
				?>
				<li><a href="http://www.fork-cms.com" title="Fork CMS">Fork CMS</a></li>
			</ul>
		</nav>

	</div>
</footer>