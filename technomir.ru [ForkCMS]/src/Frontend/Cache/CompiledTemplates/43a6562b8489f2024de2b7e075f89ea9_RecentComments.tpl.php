<?php error_reporting(0); ini_set('display_errors', 'Off'); ?>


<?php
					if(isset($this->variables['widgetBlogRecentComments']) && count($this->variables['widgetBlogRecentComments']) != 0 && $this->variables['widgetBlogRecentComments'] != '' && $this->variables['widgetBlogRecentComments'] !== false)
					{
						?>
	<section id="blogRecentCommentsWidget" class="well">
		<header>
			<h3><?php echo SpoonFilter::ucfirst($this->variables['lblRecentComments']); ?></h3>
		</header>
		<ul>
			<?php
				if(isset(${'widgetBlogRecentComments'})) $this->iterations['43a6562b8489f2024de2b7e075f89ea9_RecentComments.tpl.php_1']['old'] = ${'widgetBlogRecentComments'};
				$this->iterations['43a6562b8489f2024de2b7e075f89ea9_RecentComments.tpl.php_1']['iteration'] = $this->variables['widgetBlogRecentComments'];
				$this->iterations['43a6562b8489f2024de2b7e075f89ea9_RecentComments.tpl.php_1']['i'] = 1;
				$this->iterations['43a6562b8489f2024de2b7e075f89ea9_RecentComments.tpl.php_1']['count'] = count($this->iterations['43a6562b8489f2024de2b7e075f89ea9_RecentComments.tpl.php_1']['iteration']);
				foreach((array) $this->iterations['43a6562b8489f2024de2b7e075f89ea9_RecentComments.tpl.php_1']['iteration'] as ${'widgetBlogRecentComments'})
				{
					if(!isset(${'widgetBlogRecentComments'}['first']) && $this->iterations['43a6562b8489f2024de2b7e075f89ea9_RecentComments.tpl.php_1']['i'] == 1) ${'widgetBlogRecentComments'}['first'] = true;
					if(!isset(${'widgetBlogRecentComments'}['last']) && $this->iterations['43a6562b8489f2024de2b7e075f89ea9_RecentComments.tpl.php_1']['i'] == $this->iterations['43a6562b8489f2024de2b7e075f89ea9_RecentComments.tpl.php_1']['count']) ${'widgetBlogRecentComments'}['last'] = true;
					if(isset(${'widgetBlogRecentComments'}['formElements']) && is_array(${'widgetBlogRecentComments'}['formElements']))
					{
						foreach(${'widgetBlogRecentComments'}['formElements'] as $name => $object)
						{
							${'widgetBlogRecentComments'}[$name] = $object->parse();
							${'widgetBlogRecentComments'}[$name .'Error'] = (is_callable(array($object, 'getErrors')) && $object->getErrors() != '') ? '<span class="formError">' . $object->getErrors() .'</span>' : '';
						}
					} ?>
				<li>
					<?php
					if(isset(${'widgetBlogRecentComments'}['website']) && count(${'widgetBlogRecentComments'}['website']) != 0 && ${'widgetBlogRecentComments'}['website'] != '' && ${'widgetBlogRecentComments'}['website'] !== false)
					{
						?><a href="<?php echo ${'widgetBlogRecentComments'}['website']; ?>" rel="nofollow"><?php } ?>
						<?php echo ${'widgetBlogRecentComments'}['author']; ?>
					<?php
					if(isset(${'widgetBlogRecentComments'}['website']) && count(${'widgetBlogRecentComments'}['website']) != 0 && ${'widgetBlogRecentComments'}['website'] != '' && ${'widgetBlogRecentComments'}['website'] !== false)
					{
						?></a><?php } ?>
					<?php echo $this->variables['lblCommentedOn']; ?> <a href="<?php echo ${'widgetBlogRecentComments'}['full_url']; ?>"><?php echo ${'widgetBlogRecentComments'}['post_title']; ?></a>
				</li>
			<?php
					$this->iterations['43a6562b8489f2024de2b7e075f89ea9_RecentComments.tpl.php_1']['i']++;
				}
				if(isset($this->iterations['43a6562b8489f2024de2b7e075f89ea9_RecentComments.tpl.php_1']['old'])) ${'widgetBlogRecentComments'} = $this->iterations['43a6562b8489f2024de2b7e075f89ea9_RecentComments.tpl.php_1']['old'];
				else unset($this->iterations['43a6562b8489f2024de2b7e075f89ea9_RecentComments.tpl.php_1']);
				?>
		</ul>
	</section>
<?php } ?>