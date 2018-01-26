<?php error_reporting(0); ini_set('display_errors', 'Off'); ?>
<section id="sitemapIndex" class="mod">
	<div class="inner">
		<div class="bd content">
			<?php echo Frontend\Core\Engine\TemplateModifiers::getNavigation($this->variables['var'], 'page', 0, null, null, '/Modules/Pages/Layout/Templates/Sitemap.tpl'); ?>
			<?php echo Frontend\Core\Engine\TemplateModifiers::getNavigation($this->variables['var'], 'meta', 0, null, null, '/Modules/Pages/Layout/Templates/Sitemap.tpl'); ?>
		</div>
	</div>
</section>
