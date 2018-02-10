<?php error_reporting(0); ini_set('display_errors', 'Off'); ?>

	<article itemscope itemtype="http://schema.org/Blog">
			<meta itemprop="interactionCount" content="UserComments:<?php echo $this->variables['commentsCount']; ?>">
			<meta itemprop="author" content="<?php echo Frontend\Core\Engine\TemplateModifiers::userSetting($this->variables['item']['user_id'], 'nickname'); ?>">
			<header>
				<h1 itemprop="name"><?php echo $this->variables['item']['title']; ?></h1>
				<p class="lead">
					
					<?php echo sprintf(SpoonFilter::ucfirst($this->variables['msgWrittenBy']), Frontend\Core\Engine\TemplateModifiers::userSetting($this->variables['item']['user_id'], 'nickname')); ?>
					
					
					<?php echo $this->variables['lblIn']; ?> <?php echo $this->variables['lblThe']; ?> <?php echo $this->variables['lblCategory']; ?> <a itemprop="articleSection" href="<?php echo $this->variables['item']['category_full_url']; ?>" title="<?php echo $this->variables['item']['category_title']; ?>"><?php echo $this->variables['item']['category_title']; ?></a><?php if(!isset($this->variables['item']['tags']) || count($this->variables['item']['tags']) == 0 || $this->variables['item']['tags'] == '' || $this->variables['item']['tags'] === false): ?>.<?php endif; ?>					
				</p>
				<hr>
				<p class="pull-left"><span class="glyphicon glyphicon-time"></span>
					
					<time itemprop="datePublished" datetime="<?php echo SpoonTemplateModifiers::date($this->variables['item']['publish_on'], 'Y-m-d\TH:i:s'); ?>"><?php echo SpoonTemplateModifiers::date($this->variables['item']['publish_on'], $this->variables['dateFormatLong'], $this->variables['LANGUAGE']); ?></time>
				</p>

				
				<?php
					if(isset($this->variables['item']['allow_comments']) && count($this->variables['item']['allow_comments']) != 0 && $this->variables['item']['allow_comments'] != '' && $this->variables['item']['allow_comments'] !== false)
					{
						?>
				<div class="text-right">
					<?php if(!isset($this->variables['comments']) || count($this->variables['comments']) == 0 || $this->variables['comments'] == '' || $this->variables['comments'] === false): ?><a href="<?php echo $this->variables['item']['full_url']; ?>#<?php echo $this->variables['actComment']; ?>" itemprop="discussionUrl"><?php echo SpoonFilter::ucfirst($this->variables['msgBlogNoComments']); ?></a><?php endif; ?>
					<?php
					if(isset($this->variables['comments']) && count($this->variables['comments']) != 0 && $this->variables['comments'] != '' && $this->variables['comments'] !== false)
					{
						?>
						<?php
					if(isset($this->variables['blogCommentsMultiple']) && count($this->variables['blogCommentsMultiple']) != 0 && $this->variables['blogCommentsMultiple'] != '' && $this->variables['blogCommentsMultiple'] !== false)
					{
						?><a href="<?php echo $this->variables['item']['full_url']; ?>#<?php echo $this->variables['actComments']; ?>" itemprop="discussionUrl"><?php echo sprintf($this->variables['msgBlogNumberOfComments'], $this->variables['commentsCount']); ?></a><?php } ?>
						<?php if(!isset($this->variables['blogCommentsMultiple']) || count($this->variables['blogCommentsMultiple']) == 0 || $this->variables['blogCommentsMultiple'] == '' || $this->variables['blogCommentsMultiple'] === false): ?><a href="<?php echo $this->variables['item']['full_url']; ?>#<?php echo $this->variables['actComments']; ?>" itemprop="discussionUrl"><?php echo $this->variables['msgBlogOneComment']; ?></a><?php endif; ?>
					<?php } ?>
				</div>
				<?php } ?>
				<hr>
				
				
					
					<?php
					if(isset($this->variables['item']['tags']) && count($this->variables['item']['tags']) != 0 && $this->variables['item']['tags'] != '' && $this->variables['item']['tags'] !== false)
					{
						?>
					<p>
						<?php echo $this->variables['lblWith']; ?> <?php echo $this->variables['lblThe']; ?> <?php echo $this->variables['lblTags']; ?>
						<span itemprop="keywords">
							<?php
				if(isset(${'item'}['tags'])) $this->iterations['9ccca6d560b2d43c32b752064cc5a8b2_Detail.tpl.php_1']['tags']['old'] = ${'item'}['tags'];
				$this->iterations['9ccca6d560b2d43c32b752064cc5a8b2_Detail.tpl.php_1']['tags']['iteration'] = $this->variables['item']['tags'];
				$this->iterations['9ccca6d560b2d43c32b752064cc5a8b2_Detail.tpl.php_1']['tags']['i'] = 1;
				$this->iterations['9ccca6d560b2d43c32b752064cc5a8b2_Detail.tpl.php_1']['tags']['count'] = count($this->iterations['9ccca6d560b2d43c32b752064cc5a8b2_Detail.tpl.php_1']['tags']['iteration']);
				foreach((array) $this->iterations['9ccca6d560b2d43c32b752064cc5a8b2_Detail.tpl.php_1']['tags']['iteration'] as ${'item'}['tags'])
				{
					if(!isset(${'item'}['tags']['first']) && $this->iterations['9ccca6d560b2d43c32b752064cc5a8b2_Detail.tpl.php_1']['tags']['i'] == 1) ${'item'}['tags']['first'] = true;
					if(!isset(${'item'}['tags']['last']) && $this->iterations['9ccca6d560b2d43c32b752064cc5a8b2_Detail.tpl.php_1']['tags']['i'] == $this->iterations['9ccca6d560b2d43c32b752064cc5a8b2_Detail.tpl.php_1']['tags']['count']) ${'item'}['tags']['last'] = true;
					if(isset(${'item'}['tags']['formElements']) && is_array(${'item'}['tags']['formElements']))
					{
						foreach(${'item'}['tags']['formElements'] as $name => $object)
						{
							${'item'}['tags'][$name] = $object->parse();
							${'item'}['tags'][$name .'Error'] = (is_callable(array($object, 'getErrors')) && $object->getErrors() != '') ? '<span class="formError">' . $object->getErrors() .'</span>' : '';
						}
					} ?>
								<a href="<?php echo ${'item'}['tags']['full_url']; ?>" rel="tag" title="<?php echo ${'item'}['tags']['name']; ?>"><?php echo ${'item'}['tags']['name']; ?></a><?php if(!isset(${'item'}['tags']['last']) || count(${'item'}['tags']['last']) == 0 || ${'item'}['tags']['last'] == '' || ${'item'}['tags']['last'] === false): ?>, <?php endif; ?><?php
					if(isset(${'item'}['tags']['last']) && count(${'item'}['tags']['last']) != 0 && ${'item'}['tags']['last'] != '' && ${'item'}['tags']['last'] !== false)
					{
						?>.<?php } ?>
							<?php
					$this->iterations['9ccca6d560b2d43c32b752064cc5a8b2_Detail.tpl.php_1']['tags']['i']++;
				}
				if(isset($this->iterations['9ccca6d560b2d43c32b752064cc5a8b2_Detail.tpl.php_1']['tags']['old'])) ${'item'}['tags'] = $this->iterations['9ccca6d560b2d43c32b752064cc5a8b2_Detail.tpl.php_1']['tags']['old'];
				else unset($this->iterations['9ccca6d560b2d43c32b752064cc5a8b2_Detail.tpl.php_1']['tags']);
				?>
						</span>
					</p>
					<hr>
					<?php } ?>

					<a href="<?php echo $this->variables['item']['full_url']; ?>" class="share"><?php echo SpoonFilter::ucfirst($this->variables['lblShare']); ?></a>
					<hr>

			</header>

			<div itemprop="articleBody">
				<?php
					if(isset($this->variables['item']['image']) && count($this->variables['item']['image']) != 0 && $this->variables['item']['image'] != '' && $this->variables['item']['image'] !== false)
					{
						?><img src="<?php echo $this->variables['FRONTEND_FILES_URL']; ?>/blog/images/source/<?php echo $this->variables['item']['image']; ?>" alt="<?php echo $this->variables['item']['title']; ?>" itemprop="image" class="img-responsive" /><?php } ?>
				<?php echo $this->variables['item']['text']; ?>
			</div>

			<footer class="ft">
				<?php
					if(isset($this->variables['navigation']) && count($this->variables['navigation']) != 0 && $this->variables['navigation'] != '' && $this->variables['navigation'] !== false)
					{
						?>
				<ul class="pager">
					<?php
					if(isset($this->variables['navigation']['previous']) && count($this->variables['navigation']['previous']) != 0 && $this->variables['navigation']['previous'] != '' && $this->variables['navigation']['previous'] !== false)
					{
						?>
						<li class="previous">
							<a href="<?php echo $this->variables['navigation']['previous']['url']; ?>" rel="prev"><?php echo SpoonFilter::ucfirst($this->variables['lblPreviousArticle']); ?>: <?php echo $this->variables['navigation']['previous']['title']; ?></a>
						</li>
					<?php } ?>
					<?php
					if(isset($this->variables['navigation']['next']) && count($this->variables['navigation']['next']) != 0 && $this->variables['navigation']['next'] != '' && $this->variables['navigation']['next'] !== false)
					{
						?>
						<li class="next">
							<a href="<?php echo $this->variables['navigation']['next']['url']; ?>" rel="next"><?php echo SpoonFilter::ucfirst($this->variables['lblNextArticle']); ?>: <?php echo $this->variables['navigation']['next']['title']; ?></a>
						</li>
					<?php } ?>
				</ul>
				<?php } ?>
			</footer>
	</article>

	<?php
					if(isset($this->variables['comments']) && count($this->variables['comments']) != 0 && $this->variables['comments'] != '' && $this->variables['comments'] !== false)
					{
						?>
		<?php
					if(isset($this->variables['item']['allow_comments']) && count($this->variables['item']['allow_comments']) != 0 && $this->variables['item']['allow_comments'] != '' && $this->variables['item']['allow_comments'] !== false)
					{
						?>
			<section id="blogComments" class="mod" itemscope itemtype="http://schema.org/Article">
				<div class="inner">
					<header class="hd">
						<h3 id="<?php echo $this->variables['actComments']; ?>"><?php echo SpoonFilter::ucfirst($this->variables['lblComments']); ?></h3>
					</header>
					<div class="bd content">
						<?php
				if(isset(${'comments'})) $this->iterations['9ccca6d560b2d43c32b752064cc5a8b2_Detail.tpl.php_2']['old'] = ${'comments'};
				$this->iterations['9ccca6d560b2d43c32b752064cc5a8b2_Detail.tpl.php_2']['iteration'] = $this->variables['comments'];
				$this->iterations['9ccca6d560b2d43c32b752064cc5a8b2_Detail.tpl.php_2']['i'] = 1;
				$this->iterations['9ccca6d560b2d43c32b752064cc5a8b2_Detail.tpl.php_2']['count'] = count($this->iterations['9ccca6d560b2d43c32b752064cc5a8b2_Detail.tpl.php_2']['iteration']);
				foreach((array) $this->iterations['9ccca6d560b2d43c32b752064cc5a8b2_Detail.tpl.php_2']['iteration'] as ${'comments'})
				{
					if(!isset(${'comments'}['first']) && $this->iterations['9ccca6d560b2d43c32b752064cc5a8b2_Detail.tpl.php_2']['i'] == 1) ${'comments'}['first'] = true;
					if(!isset(${'comments'}['last']) && $this->iterations['9ccca6d560b2d43c32b752064cc5a8b2_Detail.tpl.php_2']['i'] == $this->iterations['9ccca6d560b2d43c32b752064cc5a8b2_Detail.tpl.php_2']['count']) ${'comments'}['last'] = true;
					if(isset(${'comments'}['formElements']) && is_array(${'comments'}['formElements']))
					{
						foreach(${'comments'}['formElements'] as $name => $object)
						{
							${'comments'}[$name] = $object->parse();
							${'comments'}[$name .'Error'] = (is_callable(array($object, 'getErrors')) && $object->getErrors() != '') ? '<span class="formError">' . $object->getErrors() .'</span>' : '';
						}
					} ?>
							
							<div id="comment-<?php echo ${'comments'}['id']; ?>" class="comment" itemprop="comment" itemscope itemtype="http://schema.org/UserComments">
								<meta itemprop="discusses" content="<?php echo $this->variables['item']['title']; ?>" />
								<div class="imageHolder">
									<?php
					if(isset(${'comments'}['website']) && count(${'comments'}['website']) != 0 && ${'comments'}['website'] != '' && ${'comments'}['website'] !== false)
					{
						?><a href="<?php echo ${'comments'}['website']; ?>"><?php } ?>
										<img src="<?php echo $this->variables['FRONTEND_CORE_URL']; ?>/layout/images/default_author_avatar.gif" width="48" height="48" alt="<?php echo ${'comments'}['author']; ?>" class="replaceWithGravatar" data-gravatar-id="<?php echo ${'comments'}['gravatar_id']; ?>" />
									<?php
					if(isset(${'comments'}['website']) && count(${'comments'}['website']) != 0 && ${'comments'}['website'] != '' && ${'comments'}['website'] !== false)
					{
						?></a><?php } ?>
								</div>
								<div class="commentContent">
									<p class="commentAuthor" itemscope itemtype="http://schema.org/Person">
										<?php
					if(isset(${'comments'}['website']) && count(${'comments'}['website']) != 0 && ${'comments'}['website'] != '' && ${'comments'}['website'] !== false)
					{
						?><a href="<?php echo ${'comments'}['website']; ?>" itemprop="url"><?php } ?>
											<span itemprop="creator name"><?php echo ${'comments'}['author']; ?></span>
										<?php
					if(isset(${'comments'}['website']) && count(${'comments'}['website']) != 0 && ${'comments'}['website'] != '' && ${'comments'}['website'] !== false)
					{
						?></a><?php } ?>
										<?php echo $this->variables['lblWrote']; ?>
										<time itemprop="commentTime" datetime="<?php echo SpoonTemplateModifiers::date(${'comments'}['created_on'], 'Y-m-d\TH:i:s'); ?>"><?php echo Frontend\Core\Engine\TemplateModifiers::timeAgo(${'comments'}['created_on']); ?></time>
									</p>
									<div class="commentText content" itemprop="commentText">
										<?php echo Frontend\Core\Engine\TemplateModifiers::cleanupPlainText(${'comments'}['text']); ?>
									</div>
								</div>
							</div>
						<?php
					$this->iterations['9ccca6d560b2d43c32b752064cc5a8b2_Detail.tpl.php_2']['i']++;
				}
				if(isset($this->iterations['9ccca6d560b2d43c32b752064cc5a8b2_Detail.tpl.php_2']['old'])) ${'comments'} = $this->iterations['9ccca6d560b2d43c32b752064cc5a8b2_Detail.tpl.php_2']['old'];
				else unset($this->iterations['9ccca6d560b2d43c32b752064cc5a8b2_Detail.tpl.php_2']);
				?>
					</div>
				</div>
			</section>
		<?php } ?>
	<?php } ?>
	<?php
					if(isset($this->variables['item']['allow_comments']) && count($this->variables['item']['allow_comments']) != 0 && $this->variables['item']['allow_comments'] != '' && $this->variables['item']['allow_comments'] !== false)
					{
						?>
		<section id="blogCommentForm" class="mod">
			<div class="inner">
				<header class="hd">
					<h3 id="<?php echo $this->variables['actComment']; ?>"><?php echo SpoonFilter::ucfirst($this->variables['msgComment']); ?></h3>
				</header>
				<div class="bd">
					<?php
					if(isset($this->variables['commentIsInModeration']) && count($this->variables['commentIsInModeration']) != 0 && $this->variables['commentIsInModeration'] != '' && $this->variables['commentIsInModeration'] !== false)
					{
						?><div class="message warning"><p><?php echo $this->variables['msgBlogCommentInModeration']; ?></p></div><?php } ?>
					<?php
					if(isset($this->variables['commentIsSpam']) && count($this->variables['commentIsSpam']) != 0 && $this->variables['commentIsSpam'] != '' && $this->variables['commentIsSpam'] !== false)
					{
						?><div class="message error"><p><?php echo $this->variables['msgBlogCommentIsSpam']; ?></p></div><?php } ?>
					<?php
					if(isset($this->variables['commentIsAdded']) && count($this->variables['commentIsAdded']) != 0 && $this->variables['commentIsAdded'] != '' && $this->variables['commentIsAdded'] !== false)
					{
						?><div class="message success"><p><?php echo $this->variables['msgBlogCommentIsAdded']; ?></p></div><?php } ?>
					<?php
					if(isset($this->forms['commentsForm']))
					{
						?><form accept-charset="UTF-8" action="<?php echo $this->forms['commentsForm']->getAction(); ?>" method="<?php echo $this->forms['commentsForm']->getMethod(); ?>"<?php echo $this->forms['commentsForm']->getParametersHTML(); ?>>
						<?php echo $this->forms['commentsForm']->getField('form')->parse();
						if($this->forms['commentsForm']->getUseToken())
						{
							?><input type="hidden" name="form_token" id="<?php echo $this->forms['commentsForm']->getField('form_token')->getAttribute('id'); ?>" value="<?php echo htmlspecialchars($this->forms['commentsForm']->getField('form_token')->getValue()); ?>" />
						<?php } ?>
						<div class="alignBlocks">
							<p <?php
					if(isset($this->variables['txtAuthorError']) && count($this->variables['txtAuthorError']) != 0 && $this->variables['txtAuthorError'] != '' && $this->variables['txtAuthorError'] !== false)
					{
						?>class="errorArea"<?php } ?>>
								<label for="author"><?php echo SpoonFilter::ucfirst($this->variables['lblName']); ?><abbr title="<?php echo $this->variables['lblRequiredField']; ?>">*</abbr></label>
								<?php echo $this->variables['txtAuthor']; ?> <?php echo $this->variables['txtAuthorError']; ?>
							</p>
							<p <?php
					if(isset($this->variables['txtEmailError']) && count($this->variables['txtEmailError']) != 0 && $this->variables['txtEmailError'] != '' && $this->variables['txtEmailError'] !== false)
					{
						?>class="errorArea"<?php } ?>>
								<label for="email"><?php echo SpoonFilter::ucfirst($this->variables['lblEmail']); ?><abbr title="<?php echo $this->variables['lblRequiredField']; ?>">*</abbr></label>
								<?php echo $this->variables['txtEmail']; ?> <?php echo $this->variables['txtEmailError']; ?>
							</p>
						</div>
						<p class="bigInput<?php
					if(isset($this->variables['txtWebsiteError']) && count($this->variables['txtWebsiteError']) != 0 && $this->variables['txtWebsiteError'] != '' && $this->variables['txtWebsiteError'] !== false)
					{
						?> errorArea<?php } ?>">
							<label for="website"><?php echo SpoonFilter::ucfirst($this->variables['lblWebsite']); ?></label>
							<?php echo $this->variables['txtWebsite']; ?> <?php echo $this->variables['txtWebsiteError']; ?>
						</p>
						<p class="bigInput<?php
					if(isset($this->variables['txtMessageError']) && count($this->variables['txtMessageError']) != 0 && $this->variables['txtMessageError'] != '' && $this->variables['txtMessageError'] !== false)
					{
						?> errorArea<?php } ?>">
							<label for="message"><?php echo SpoonFilter::ucfirst($this->variables['lblMessage']); ?><abbr title="<?php echo $this->variables['lblRequiredField']; ?>">*</abbr></label>
							<?php echo $this->variables['txtMessage']; ?> <?php echo $this->variables['txtMessageError']; ?>
						</p>
						<p>
							<input class="inputSubmit" type="submit" name="comment" value="<?php echo SpoonFilter::ucfirst($this->variables['msgComment']); ?>" />
						</p>
					</form>
				<?php } ?>
				</div>
			</div>
		</section>
	<?php } ?>