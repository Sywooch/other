<?php error_reporting(0); ini_set('display_errors', 'Off'); ?>


<?php
					if(isset($this->variables['widgetBlogRecentArticlesList']) && count($this->variables['widgetBlogRecentArticlesList']) != 0 && $this->variables['widgetBlogRecentArticlesList'] != '' && $this->variables['widgetBlogRecentArticlesList'] !== false)
					{
						?>
	<section id="blogRecentArticlesListWidget" class="well">
			<header>
				<h3><?php echo SpoonFilter::ucfirst($this->variables['lblRecentArticles']); ?></h3>
			</header>
				<ul>
					<?php
				if(isset(${'widgetBlogRecentArticlesList'})) $this->iterations['c3f10b374f9154ac6d6f899561aede11_RecentArticlesList.tpl.php_1']['old'] = ${'widgetBlogRecentArticlesList'};
				$this->iterations['c3f10b374f9154ac6d6f899561aede11_RecentArticlesList.tpl.php_1']['iteration'] = $this->variables['widgetBlogRecentArticlesList'];
				$this->iterations['c3f10b374f9154ac6d6f899561aede11_RecentArticlesList.tpl.php_1']['i'] = 1;
				$this->iterations['c3f10b374f9154ac6d6f899561aede11_RecentArticlesList.tpl.php_1']['count'] = count($this->iterations['c3f10b374f9154ac6d6f899561aede11_RecentArticlesList.tpl.php_1']['iteration']);
				foreach((array) $this->iterations['c3f10b374f9154ac6d6f899561aede11_RecentArticlesList.tpl.php_1']['iteration'] as ${'widgetBlogRecentArticlesList'})
				{
					if(!isset(${'widgetBlogRecentArticlesList'}['first']) && $this->iterations['c3f10b374f9154ac6d6f899561aede11_RecentArticlesList.tpl.php_1']['i'] == 1) ${'widgetBlogRecentArticlesList'}['first'] = true;
					if(!isset(${'widgetBlogRecentArticlesList'}['last']) && $this->iterations['c3f10b374f9154ac6d6f899561aede11_RecentArticlesList.tpl.php_1']['i'] == $this->iterations['c3f10b374f9154ac6d6f899561aede11_RecentArticlesList.tpl.php_1']['count']) ${'widgetBlogRecentArticlesList'}['last'] = true;
					if(isset(${'widgetBlogRecentArticlesList'}['formElements']) && is_array(${'widgetBlogRecentArticlesList'}['formElements']))
					{
						foreach(${'widgetBlogRecentArticlesList'}['formElements'] as $name => $object)
						{
							${'widgetBlogRecentArticlesList'}[$name] = $object->parse();
							${'widgetBlogRecentArticlesList'}[$name .'Error'] = (is_callable(array($object, 'getErrors')) && $object->getErrors() != '') ? '<span class="formError">' . $object->getErrors() .'</span>' : '';
						}
					} ?>
						<li><a href="<?php echo ${'widgetBlogRecentArticlesList'}['full_url']; ?>" title="<?php echo ${'widgetBlogRecentArticlesList'}['title']; ?>"><?php echo ${'widgetBlogRecentArticlesList'}['title']; ?></a></li>
					<?php
					$this->iterations['c3f10b374f9154ac6d6f899561aede11_RecentArticlesList.tpl.php_1']['i']++;
				}
				if(isset($this->iterations['c3f10b374f9154ac6d6f899561aede11_RecentArticlesList.tpl.php_1']['old'])) ${'widgetBlogRecentArticlesList'} = $this->iterations['c3f10b374f9154ac6d6f899561aede11_RecentArticlesList.tpl.php_1']['old'];
				else unset($this->iterations['c3f10b374f9154ac6d6f899561aede11_RecentArticlesList.tpl.php_1']);
				?>
				</ul>
			<footer class="ft">
				<p>
					<a href="<?php echo Frontend\Core\Engine\TemplateModifiers::getURLForBlock($this->variables['var'], 'blog'); ?>"><?php echo SpoonFilter::ucfirst($this->variables['lblBlogArchive']); ?></a>
					<a id="RSSfeed" href="<?php echo $this->variables['widgetBlogRecentArticlesFullRssLink']; ?>"><?php echo SpoonFilter::ucfirst($this->variables['lblSubscribeToTheRSSFeed']); ?></a>
				</p>
			</footer>
	</section>
<?php } ?>