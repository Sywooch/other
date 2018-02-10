<?php error_reporting(E_ALL | E_STRICT); ini_set('display_errors', 'On'); ?>
<section id="sitemapIndex" class="mod">
	<div class="inner">
		<div class="bd content">
			<?php if(array_key_exists('var', (array) $this->variables)) { echo Frontend\Core\Engine\TemplateModifiers::getNavigation($this->variables['var'], 'page', 0, null, null, '/Modules/Pages/Layout/Templates/Sitemap.tpl'); } else { ?>{$var|getnavigation:'page':0:null:null:'/Modules/Pages/Layout/Templates/Sitemap.tpl'}<?php } ?>
			<?php if(array_key_exists('var', (array) $this->variables)) { echo Frontend\Core\Engine\TemplateModifiers::getNavigation($this->variables['var'], 'meta', 0, null, null, '/Modules/Pages/Layout/Templates/Sitemap.tpl'); } else { ?>{$var|getnavigation:'meta':0:null:null:'/Modules/Pages/Layout/Templates/Sitemap.tpl'}<?php } ?>
		</div>
	</div>
</section>
