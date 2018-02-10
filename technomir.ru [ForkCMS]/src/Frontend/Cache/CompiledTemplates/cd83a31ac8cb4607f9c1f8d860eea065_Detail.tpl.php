<?php error_reporting(E_ALL | E_STRICT); ini_set('display_errors', 'On'); ?>

<div id="blogDetail">
	<article class="mod article" itemscope itemtype="http://schema.org/Blog">
		<div class="inner">
			<meta itemprop="interactionCount" content="UserComments:<?php if(array_key_exists('commentsCount', (array) $this->variables)) { echo $this->variables['commentsCount']; } else { ?>{$commentsCount}<?php } ?>">
			<meta itemprop="author" content="<?php if(isset($this->variables['item']) && array_key_exists('user_id', (array) $this->variables['item'])) { echo Frontend\Core\Engine\TemplateModifiers::userSetting($this->variables['item']['user_id'], 'nickname'); } else { ?>{$item.user_id|usersetting:'nickname'}<?php } ?>">
			<header class="hd">
				<h1 itemprop="name"><?php if(isset($this->variables['item']) && array_key_exists('title', (array) $this->variables['item'])) { echo $this->variables['item']['title']; } else { ?>{$item.title}<?php } ?></h1>
				<ul>
					<li>
						
						<?php if(array_key_exists('msgWrittenBy', (array) $this->variables) && isset($this->variables['item']) && array_key_exists('user_id', (array) $this->variables['item'])) { echo sprintf(SpoonFilter::ucfirst($this->variables['msgWrittenBy']), Frontend\Core\Engine\TemplateModifiers::userSetting($this->variables['item']['user_id'], 'nickname')); } else { ?>{$msgWrittenBy|ucfirst|sprintf:<?php if(isset($this->variables['item']) && array_key_exists('user_id', (array) $this->variables['item'])) { echo Frontend\Core\Engine\TemplateModifiers::userSetting($this->variables['item']['user_id'], 'nickname'); } else { ?>{$item.user_id|usersetting:'nickname'}<?php } ?>}<?php } ?>

						
						<?php if(array_key_exists('lblOn', (array) $this->variables)) { echo $this->variables['lblOn']; } else { ?>{$lblOn}<?php } ?> <time itemprop="datePublished" datetime="<?php if(isset($this->variables['item']) && array_key_exists('publish_on', (array) $this->variables['item'])) { echo SpoonTemplateModifiers::date($this->variables['item']['publish_on'], 'Y-m-d\TH:i:s'); } else { ?>{$item.publish_on|date:'Y-m-d\TH:i:s'}<?php } ?>"><?php if(isset($this->variables['item']) && array_key_exists('publish_on', (array) $this->variables['item']) && array_key_exists('dateFormatLong', (array) $this->variables) && array_key_exists('LANGUAGE', (array) $this->variables)) { echo SpoonTemplateModifiers::date($this->variables['item']['publish_on'], $this->variables['dateFormatLong'], $this->variables['LANGUAGE']); } else { ?>{$item.publish_on|date:<?php if(array_key_exists('dateFormatLong', (array) $this->variables)) { echo $this->variables['dateFormatLong']; } else { ?>{$dateFormatLong}<?php } ?>:<?php if(array_key_exists('LANGUAGE', (array) $this->variables)) { echo $this->variables['LANGUAGE']; } else { ?>{$LANGUAGE}<?php } ?>}<?php } ?></time>

						
						<?php if(array_key_exists('lblIn', (array) $this->variables)) { echo $this->variables['lblIn']; } else { ?>{$lblIn}<?php } ?> <?php if(array_key_exists('lblThe', (array) $this->variables)) { echo $this->variables['lblThe']; } else { ?>{$lblThe}<?php } ?> <?php if(array_key_exists('lblCategory', (array) $this->variables)) { echo $this->variables['lblCategory']; } else { ?>{$lblCategory}<?php } ?> <a itemprop="articleSection" href="<?php if(isset($this->variables['item']) && array_key_exists('category_full_url', (array) $this->variables['item'])) { echo $this->variables['item']['category_full_url']; } else { ?>{$item.category_full_url}<?php } ?>" title="<?php if(isset($this->variables['item']) && array_key_exists('category_title', (array) $this->variables['item'])) { echo $this->variables['item']['category_title']; } else { ?>{$item.category_title}<?php } ?>"><?php if(isset($this->variables['item']) && array_key_exists('category_title', (array) $this->variables['item'])) { echo $this->variables['item']['category_title']; } else { ?>{$item.category_title}<?php } ?></a><?php if(!isset($this->variables['item']['tags']) || count($this->variables['item']['tags']) == 0 || $this->variables['item']['tags'] == '' || $this->variables['item']['tags'] === false): ?>.<?php endif; ?>

						
						<?php
					if(isset($this->variables['item']['tags']) && count($this->variables['item']['tags']) != 0 && $this->variables['item']['tags'] != '' && $this->variables['item']['tags'] !== false)
					{
						?>
							<?php if(array_key_exists('lblWith', (array) $this->variables)) { echo $this->variables['lblWith']; } else { ?>{$lblWith}<?php } ?> <?php if(array_key_exists('lblThe', (array) $this->variables)) { echo $this->variables['lblThe']; } else { ?>{$lblThe}<?php } ?> <?php if(array_key_exists('lblTags', (array) $this->variables)) { echo $this->variables['lblTags']; } else { ?>{$lblTags}<?php } ?>
							<span itemprop="keywords">
								<?php
					if(!isset($this->variables['item']['tags']))
					{
						?>{iteration:item.tags}<?php
						$this->variables['item']['tags'] = array();
						$this->iterations['cd83a31ac8cb4607f9c1f8d860eea065_Detail.tpl.php_1']['tags']['fail'] = true;
					}
				if(isset(${'item'}['tags'])) $this->iterations['cd83a31ac8cb4607f9c1f8d860eea065_Detail.tpl.php_1']['tags']['old'] = ${'item'}['tags'];
				$this->iterations['cd83a31ac8cb4607f9c1f8d860eea065_Detail.tpl.php_1']['tags']['iteration'] = $this->variables['item']['tags'];
				$this->iterations['cd83a31ac8cb4607f9c1f8d860eea065_Detail.tpl.php_1']['tags']['i'] = 1;
				$this->iterations['cd83a31ac8cb4607f9c1f8d860eea065_Detail.tpl.php_1']['tags']['count'] = count($this->iterations['cd83a31ac8cb4607f9c1f8d860eea065_Detail.tpl.php_1']['tags']['iteration']);
				foreach((array) $this->iterations['cd83a31ac8cb4607f9c1f8d860eea065_Detail.tpl.php_1']['tags']['iteration'] as ${'item'}['tags'])
				{
					if(!isset(${'item'}['tags']['first']) && $this->iterations['cd83a31ac8cb4607f9c1f8d860eea065_Detail.tpl.php_1']['tags']['i'] == 1) ${'item'}['tags']['first'] = true;
					if(!isset(${'item'}['tags']['last']) && $this->iterations['cd83a31ac8cb4607f9c1f8d860eea065_Detail.tpl.php_1']['tags']['i'] == $this->iterations['cd83a31ac8cb4607f9c1f8d860eea065_Detail.tpl.php_1']['tags']['count']) ${'item'}['tags']['last'] = true;
					if(isset(${'item'}['tags']['formElements']) && is_array(${'item'}['tags']['formElements']))
					{
						foreach(${'item'}['tags']['formElements'] as $name => $object)
						{
							${'item'}['tags'][$name] = $object->parse();
							${'item'}['tags'][$name .'Error'] = (is_callable(array($object, 'getErrors')) && $object->getErrors() != '') ? '<span class="formError">' . $object->getErrors() .'</span>' : '';
						}
					} ?>
									<a href="<?php if(isset(${'item'}['tags']) && array_key_exists('full_url', (array) ${'item'}['tags'])) { echo ${'item'}['tags']['full_url']; } else { ?>{$item.tags->full_url}<?php } ?>" rel="tag" title="<?php if(isset(${'item'}['tags']) && array_key_exists('name', (array) ${'item'}['tags'])) { echo ${'item'}['tags']['name']; } else { ?>{$item.tags->name}<?php } ?>"><?php if(isset(${'item'}['tags']) && array_key_exists('name', (array) ${'item'}['tags'])) { echo ${'item'}['tags']['name']; } else { ?>{$item.tags->name}<?php } ?></a><?php if(!isset(${'item'}['tags']['last']) || count(${'item'}['tags']['last']) == 0 || ${'item'}['tags']['last'] == '' || ${'item'}['tags']['last'] === false): ?>, <?php endif; ?><?php
					if(isset(${'item'}['tags']['last']) && count(${'item'}['tags']['last']) != 0 && ${'item'}['tags']['last'] != '' && ${'item'}['tags']['last'] !== false)
					{
						?>.<?php } ?>
								<?php
					$this->iterations['cd83a31ac8cb4607f9c1f8d860eea065_Detail.tpl.php_1']['tags']['i']++;
				}
					if(isset($this->iterations['cd83a31ac8cb4607f9c1f8d860eea065_Detail.tpl.php_1']['tags']['fail']) && $this->iterations['cd83a31ac8cb4607f9c1f8d860eea065_Detail.tpl.php_1']['tags']['fail'] == true)
					{
						?>{/iteration:item.tags}<?php
					}
				if(isset($this->iterations['cd83a31ac8cb4607f9c1f8d860eea065_Detail.tpl.php_1']['tags']['old'])) ${'item'}['tags'] = $this->iterations['cd83a31ac8cb4607f9c1f8d860eea065_Detail.tpl.php_1']['tags']['old'];
				else unset($this->iterations['cd83a31ac8cb4607f9c1f8d860eea065_Detail.tpl.php_1']['tags']);
				?>
							</span>
						<?php } ?>
					</li>
					
					<?php
					if(isset($this->variables['item']['allow_comments']) && count($this->variables['item']['allow_comments']) != 0 && $this->variables['item']['allow_comments'] != '' && $this->variables['item']['allow_comments'] !== false)
					{
						?>
						<li>
							<?php if(!isset($this->variables['comments']) || count($this->variables['comments']) == 0 || $this->variables['comments'] == '' || $this->variables['comments'] === false): ?><a href="<?php if(isset($this->variables['item']) && array_key_exists('full_url', (array) $this->variables['item'])) { echo $this->variables['item']['full_url']; } else { ?>{$item.full_url}<?php } ?>#<?php if(array_key_exists('actComment', (array) $this->variables)) { echo $this->variables['actComment']; } else { ?>{$actComment}<?php } ?>" itemprop="discussionUrl"><?php if(array_key_exists('msgBlogNoComments', (array) $this->variables)) { echo SpoonFilter::ucfirst($this->variables['msgBlogNoComments']); } else { ?>{$msgBlogNoComments|ucfirst}<?php } ?></a><?php endif; ?>
							<?php
					if(isset($this->variables['comments']) && count($this->variables['comments']) != 0 && $this->variables['comments'] != '' && $this->variables['comments'] !== false)
					{
						?>
								<?php
					if(isset($this->variables['blogCommentsMultiple']) && count($this->variables['blogCommentsMultiple']) != 0 && $this->variables['blogCommentsMultiple'] != '' && $this->variables['blogCommentsMultiple'] !== false)
					{
						?><a href="<?php if(isset($this->variables['item']) && array_key_exists('full_url', (array) $this->variables['item'])) { echo $this->variables['item']['full_url']; } else { ?>{$item.full_url}<?php } ?>#<?php if(array_key_exists('actComments', (array) $this->variables)) { echo $this->variables['actComments']; } else { ?>{$actComments}<?php } ?>" itemprop="discussionUrl"><?php if(array_key_exists('msgBlogNumberOfComments', (array) $this->variables) && array_key_exists('commentsCount', (array) $this->variables)) { echo sprintf($this->variables['msgBlogNumberOfComments'], $this->variables['commentsCount']); } else { ?>{$msgBlogNumberOfComments|sprintf:<?php if(array_key_exists('commentsCount', (array) $this->variables)) { echo $this->variables['commentsCount']; } else { ?>{$commentsCount}<?php } ?>}<?php } ?></a><?php } ?>
								<?php if(!isset($this->variables['blogCommentsMultiple']) || count($this->variables['blogCommentsMultiple']) == 0 || $this->variables['blogCommentsMultiple'] == '' || $this->variables['blogCommentsMultiple'] === false): ?><a href="<?php if(isset($this->variables['item']) && array_key_exists('full_url', (array) $this->variables['item'])) { echo $this->variables['item']['full_url']; } else { ?>{$item.full_url}<?php } ?>#<?php if(array_key_exists('actComments', (array) $this->variables)) { echo $this->variables['actComments']; } else { ?>{$actComments}<?php } ?>" itemprop="discussionUrl"><?php if(array_key_exists('msgBlogOneComment', (array) $this->variables)) { echo $this->variables['msgBlogOneComment']; } else { ?>{$msgBlogOneComment}<?php } ?></a><?php endif; ?>
							<?php } ?>
						</li>
					<?php } ?>
					<li>
						<a href="<?php if(isset($this->variables['item']) && array_key_exists('full_url', (array) $this->variables['item'])) { echo $this->variables['item']['full_url']; } else { ?>{$item.full_url}<?php } ?>" class="share"><?php if(array_key_exists('lblShare', (array) $this->variables)) { echo SpoonFilter::ucfirst($this->variables['lblShare']); } else { ?>{$lblShare|ucfirst}<?php } ?></a>
					</li>
				</ul>
			</header>
			<div class="bd content" itemprop="articleBody">
				<?php
					if(isset($this->variables['item']['image']) && count($this->variables['item']['image']) != 0 && $this->variables['item']['image'] != '' && $this->variables['item']['image'] !== false)
					{
						?><img src="<?php if(array_key_exists('FRONTEND_FILES_URL', (array) $this->variables)) { echo $this->variables['FRONTEND_FILES_URL']; } else { ?>{$FRONTEND_FILES_URL}<?php } ?>/blog/images/source/<?php if(isset($this->variables['item']) && array_key_exists('image', (array) $this->variables['item'])) { echo $this->variables['item']['image']; } else { ?>{$item.image}<?php } ?>" alt="<?php if(isset($this->variables['item']) && array_key_exists('title', (array) $this->variables['item'])) { echo $this->variables['item']['title']; } else { ?>{$item.title}<?php } ?>" itemprop="image" /><?php } ?>
				<?php if(isset($this->variables['item']) && array_key_exists('text', (array) $this->variables['item'])) { echo $this->variables['item']['text']; } else { ?>{$item.text}<?php } ?>
			</div>
			<footer class="ft">
				<?php
					if(isset($this->variables['navigation']) && count($this->variables['navigation']) != 0 && $this->variables['navigation'] != '' && $this->variables['navigation'] !== false)
					{
						?>
				<ul class="pageNavigation">
					<?php
					if(isset($this->variables['navigation']['previous']) && count($this->variables['navigation']['previous']) != 0 && $this->variables['navigation']['previous'] != '' && $this->variables['navigation']['previous'] !== false)
					{
						?>
						<li class="previousLink">
							<a href="<?php if(isset($this->variables['navigation']['previous']) && array_key_exists('url', (array) $this->variables['navigation']['previous'])) { echo $this->variables['navigation']['previous']['url']; } else { ?>{$navigation.previous.url}<?php } ?>" rel="prev"><?php if(array_key_exists('lblPreviousArticle', (array) $this->variables)) { echo SpoonFilter::ucfirst($this->variables['lblPreviousArticle']); } else { ?>{$lblPreviousArticle|ucfirst}<?php } ?>: <?php if(isset($this->variables['navigation']['previous']) && array_key_exists('title', (array) $this->variables['navigation']['previous'])) { echo $this->variables['navigation']['previous']['title']; } else { ?>{$navigation.previous.title}<?php } ?></a>
						</li>
					<?php } ?>
					<?php
					if(isset($this->variables['navigation']['next']) && count($this->variables['navigation']['next']) != 0 && $this->variables['navigation']['next'] != '' && $this->variables['navigation']['next'] !== false)
					{
						?>
						<li class="nextLink">
							<a href="<?php if(isset($this->variables['navigation']['next']) && array_key_exists('url', (array) $this->variables['navigation']['next'])) { echo $this->variables['navigation']['next']['url']; } else { ?>{$navigation.next.url}<?php } ?>" rel="next"><?php if(array_key_exists('lblNextArticle', (array) $this->variables)) { echo SpoonFilter::ucfirst($this->variables['lblNextArticle']); } else { ?>{$lblNextArticle|ucfirst}<?php } ?>: <?php if(isset($this->variables['navigation']['next']) && array_key_exists('title', (array) $this->variables['navigation']['next'])) { echo $this->variables['navigation']['next']['title']; } else { ?>{$navigation.next.title}<?php } ?></a>
						</li>
					<?php } ?>
				</ul>
				<?php } ?>
			</footer>
		</div>
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
						<h3 id="<?php if(array_key_exists('actComments', (array) $this->variables)) { echo $this->variables['actComments']; } else { ?>{$actComments}<?php } ?>"><?php if(array_key_exists('lblComments', (array) $this->variables)) { echo SpoonFilter::ucfirst($this->variables['lblComments']); } else { ?>{$lblComments|ucfirst}<?php } ?></h3>
					</header>
					<div class="bd content">
						<?php
					if(!isset($this->variables['comments']))
					{
						?>{iteration:comments}<?php
						$this->variables['comments'] = array();
						$this->iterations['cd83a31ac8cb4607f9c1f8d860eea065_Detail.tpl.php_2']['fail'] = true;
					}
				if(isset(${'comments'})) $this->iterations['cd83a31ac8cb4607f9c1f8d860eea065_Detail.tpl.php_2']['old'] = ${'comments'};
				$this->iterations['cd83a31ac8cb4607f9c1f8d860eea065_Detail.tpl.php_2']['iteration'] = $this->variables['comments'];
				$this->iterations['cd83a31ac8cb4607f9c1f8d860eea065_Detail.tpl.php_2']['i'] = 1;
				$this->iterations['cd83a31ac8cb4607f9c1f8d860eea065_Detail.tpl.php_2']['count'] = count($this->iterations['cd83a31ac8cb4607f9c1f8d860eea065_Detail.tpl.php_2']['iteration']);
				foreach((array) $this->iterations['cd83a31ac8cb4607f9c1f8d860eea065_Detail.tpl.php_2']['iteration'] as ${'comments'})
				{
					if(!isset(${'comments'}['first']) && $this->iterations['cd83a31ac8cb4607f9c1f8d860eea065_Detail.tpl.php_2']['i'] == 1) ${'comments'}['first'] = true;
					if(!isset(${'comments'}['last']) && $this->iterations['cd83a31ac8cb4607f9c1f8d860eea065_Detail.tpl.php_2']['i'] == $this->iterations['cd83a31ac8cb4607f9c1f8d860eea065_Detail.tpl.php_2']['count']) ${'comments'}['last'] = true;
					if(isset(${'comments'}['formElements']) && is_array(${'comments'}['formElements']))
					{
						foreach(${'comments'}['formElements'] as $name => $object)
						{
							${'comments'}[$name] = $object->parse();
							${'comments'}[$name .'Error'] = (is_callable(array($object, 'getErrors')) && $object->getErrors() != '') ? '<span class="formError">' . $object->getErrors() .'</span>' : '';
						}
					} ?>
							
							<div id="comment-<?php if(array_key_exists('id', (array) ${'comments'})) { echo ${'comments'}['id']; } else { ?>{$comments->id}<?php } ?>" class="comment" itemprop="comment" itemscope itemtype="http://schema.org/UserComments">
								<meta itemprop="discusses" content="<?php if(isset($this->variables['item']) && array_key_exists('title', (array) $this->variables['item'])) { echo $this->variables['item']['title']; } else { ?>{$item.title}<?php } ?>" />
								<div class="imageHolder">
									<?php
					if(isset(${'comments'}['website']) && count(${'comments'}['website']) != 0 && ${'comments'}['website'] != '' && ${'comments'}['website'] !== false)
					{
						?><a href="<?php if(array_key_exists('website', (array) ${'comments'})) { echo ${'comments'}['website']; } else { ?>{$comments->website}<?php } ?>"><?php } ?>
										<img src="<?php if(array_key_exists('FRONTEND_CORE_URL', (array) $this->variables)) { echo $this->variables['FRONTEND_CORE_URL']; } else { ?>{$FRONTEND_CORE_URL}<?php } ?>/Layout/images/default_author_avatar.gif" width="48" height="48" alt="<?php if(array_key_exists('author', (array) ${'comments'})) { echo ${'comments'}['author']; } else { ?>{$comments->author}<?php } ?>" class="replaceWithGravatar" data-gravatar-id="<?php if(array_key_exists('gravatar_id', (array) ${'comments'})) { echo ${'comments'}['gravatar_id']; } else { ?>{$comments->gravatar_id}<?php } ?>" />
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
						?><a href="<?php if(array_key_exists('website', (array) ${'comments'})) { echo ${'comments'}['website']; } else { ?>{$comments->website}<?php } ?>" itemprop="url"><?php } ?>
											<span itemprop="creator name"><?php if(array_key_exists('author', (array) ${'comments'})) { echo ${'comments'}['author']; } else { ?>{$comments->author}<?php } ?></span>
										<?php
					if(isset(${'comments'}['website']) && count(${'comments'}['website']) != 0 && ${'comments'}['website'] != '' && ${'comments'}['website'] !== false)
					{
						?></a><?php } ?>
										<?php if(array_key_exists('lblWrote', (array) $this->variables)) { echo $this->variables['lblWrote']; } else { ?>{$lblWrote}<?php } ?>
										<time itemprop="commentTime" datetime="<?php if(array_key_exists('created_on', (array) ${'comments'})) { echo SpoonTemplateModifiers::date(${'comments'}['created_on'], 'Y-m-d\TH:i:s'); } else { ?>{$comments->created_on|date:'Y-m-d\TH:i:s'}<?php } ?>"><?php if(array_key_exists('created_on', (array) ${'comments'})) { echo Frontend\Core\Engine\TemplateModifiers::timeAgo(${'comments'}['created_on']); } else { ?>{$comments->created_on|timeago}<?php } ?></time>
									</p>
									<div class="commentText content" itemprop="commentText">
										<?php if(array_key_exists('text', (array) ${'comments'})) { echo Frontend\Core\Engine\TemplateModifiers::cleanupPlainText(${'comments'}['text']); } else { ?>{$comments->text|cleanupplaintext}<?php } ?>
									</div>
								</div>
							</div>
						<?php
					$this->iterations['cd83a31ac8cb4607f9c1f8d860eea065_Detail.tpl.php_2']['i']++;
				}
					if(isset($this->iterations['cd83a31ac8cb4607f9c1f8d860eea065_Detail.tpl.php_2']['fail']) && $this->iterations['cd83a31ac8cb4607f9c1f8d860eea065_Detail.tpl.php_2']['fail'] == true)
					{
						?>{/iteration:comments}<?php
					}
				if(isset($this->iterations['cd83a31ac8cb4607f9c1f8d860eea065_Detail.tpl.php_2']['old'])) ${'comments'} = $this->iterations['cd83a31ac8cb4607f9c1f8d860eea065_Detail.tpl.php_2']['old'];
				else unset($this->iterations['cd83a31ac8cb4607f9c1f8d860eea065_Detail.tpl.php_2']);
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
					<h3 id="<?php if(array_key_exists('actComment', (array) $this->variables)) { echo $this->variables['actComment']; } else { ?>{$actComment}<?php } ?>"><?php if(array_key_exists('msgComment', (array) $this->variables)) { echo SpoonFilter::ucfirst($this->variables['msgComment']); } else { ?>{$msgComment|ucfirst}<?php } ?></h3>
				</header>
				<div class="bd">
					<?php
					if(isset($this->variables['commentIsInModeration']) && count($this->variables['commentIsInModeration']) != 0 && $this->variables['commentIsInModeration'] != '' && $this->variables['commentIsInModeration'] !== false)
					{
						?><div class="message warning"><p><?php if(array_key_exists('msgBlogCommentInModeration', (array) $this->variables)) { echo $this->variables['msgBlogCommentInModeration']; } else { ?>{$msgBlogCommentInModeration}<?php } ?></p></div><?php } ?>
					<?php
					if(isset($this->variables['commentIsSpam']) && count($this->variables['commentIsSpam']) != 0 && $this->variables['commentIsSpam'] != '' && $this->variables['commentIsSpam'] !== false)
					{
						?><div class="message error"><p><?php if(array_key_exists('msgBlogCommentIsSpam', (array) $this->variables)) { echo $this->variables['msgBlogCommentIsSpam']; } else { ?>{$msgBlogCommentIsSpam}<?php } ?></p></div><?php } ?>
					<?php
					if(isset($this->variables['commentIsAdded']) && count($this->variables['commentIsAdded']) != 0 && $this->variables['commentIsAdded'] != '' && $this->variables['commentIsAdded'] !== false)
					{
						?><div class="message success"><p><?php if(array_key_exists('msgBlogCommentIsAdded', (array) $this->variables)) { echo $this->variables['msgBlogCommentIsAdded']; } else { ?>{$msgBlogCommentIsAdded}<?php } ?></p></div><?php } ?>
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
								<label for="author"><?php if(array_key_exists('lblName', (array) $this->variables)) { echo SpoonFilter::ucfirst($this->variables['lblName']); } else { ?>{$lblName|ucfirst}<?php } ?><abbr title="<?php if(array_key_exists('lblRequiredField', (array) $this->variables)) { echo $this->variables['lblRequiredField']; } else { ?>{$lblRequiredField}<?php } ?>">*</abbr></label>
								<?php if(array_key_exists('txtAuthor', (array) $this->variables)) { echo $this->variables['txtAuthor']; } else { ?>{$txtAuthor}<?php } ?> <?php if(array_key_exists('txtAuthorError', (array) $this->variables)) { echo $this->variables['txtAuthorError']; } else { ?>{$txtAuthorError}<?php } ?>
							</p>
							<p <?php
					if(isset($this->variables['txtEmailError']) && count($this->variables['txtEmailError']) != 0 && $this->variables['txtEmailError'] != '' && $this->variables['txtEmailError'] !== false)
					{
						?>class="errorArea"<?php } ?>>
								<label for="email"><?php if(array_key_exists('lblEmail', (array) $this->variables)) { echo SpoonFilter::ucfirst($this->variables['lblEmail']); } else { ?>{$lblEmail|ucfirst}<?php } ?><abbr title="<?php if(array_key_exists('lblRequiredField', (array) $this->variables)) { echo $this->variables['lblRequiredField']; } else { ?>{$lblRequiredField}<?php } ?>">*</abbr></label>
								<?php if(array_key_exists('txtEmail', (array) $this->variables)) { echo $this->variables['txtEmail']; } else { ?>{$txtEmail}<?php } ?> <?php if(array_key_exists('txtEmailError', (array) $this->variables)) { echo $this->variables['txtEmailError']; } else { ?>{$txtEmailError}<?php } ?>
							</p>
						</div>
						<p class="bigInput<?php
					if(isset($this->variables['txtWebsiteError']) && count($this->variables['txtWebsiteError']) != 0 && $this->variables['txtWebsiteError'] != '' && $this->variables['txtWebsiteError'] !== false)
					{
						?> errorArea<?php } ?>">
							<label for="website"><?php if(array_key_exists('lblWebsite', (array) $this->variables)) { echo SpoonFilter::ucfirst($this->variables['lblWebsite']); } else { ?>{$lblWebsite|ucfirst}<?php } ?></label>
							<?php if(array_key_exists('txtWebsite', (array) $this->variables)) { echo $this->variables['txtWebsite']; } else { ?>{$txtWebsite}<?php } ?> <?php if(array_key_exists('txtWebsiteError', (array) $this->variables)) { echo $this->variables['txtWebsiteError']; } else { ?>{$txtWebsiteError}<?php } ?>
						</p>
						<p class="bigInput<?php
					if(isset($this->variables['txtMessageError']) && count($this->variables['txtMessageError']) != 0 && $this->variables['txtMessageError'] != '' && $this->variables['txtMessageError'] !== false)
					{
						?> errorArea<?php } ?>">
							<label for="message"><?php if(array_key_exists('lblMessage', (array) $this->variables)) { echo SpoonFilter::ucfirst($this->variables['lblMessage']); } else { ?>{$lblMessage|ucfirst}<?php } ?><abbr title="<?php if(array_key_exists('lblRequiredField', (array) $this->variables)) { echo $this->variables['lblRequiredField']; } else { ?>{$lblRequiredField}<?php } ?>">*</abbr></label>
							<?php if(array_key_exists('txtMessage', (array) $this->variables)) { echo $this->variables['txtMessage']; } else { ?>{$txtMessage}<?php } ?> <?php if(array_key_exists('txtMessageError', (array) $this->variables)) { echo $this->variables['txtMessageError']; } else { ?>{$txtMessageError}<?php } ?>
						</p>
						<p>
							<input class="inputSubmit" type="submit" name="comment" value="<?php if(array_key_exists('msgComment', (array) $this->variables)) { echo SpoonFilter::ucfirst($this->variables['msgComment']); } else { ?>{$msgComment|ucfirst}<?php } ?>" />
						</p>
					</form>
				<?php } ?>
				</div>
			</div>
		</section>
	<?php } ?>
</div>
