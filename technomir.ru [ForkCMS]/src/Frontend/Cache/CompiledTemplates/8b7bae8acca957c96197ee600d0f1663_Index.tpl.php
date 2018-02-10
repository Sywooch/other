<?php error_reporting(E_ALL | E_STRICT); ini_set('display_errors', 'On'); ?>


<?php if(!isset($this->variables['items']) || count($this->variables['items']) == 0 || $this->variables['items'] == '' || $this->variables['items'] === false): ?>
	<div id="blogIndex">
		<section class="mod">
			<div class="inner">
				<div class="bd content">
					<p><?php if(array_key_exists('msgBlogNoItems', (array) $this->variables)) { echo $this->variables['msgBlogNoItems']; } else { ?>{$msgBlogNoItems}<?php } ?></p>
				</div>
			</div>
		</section>
	</div>
<?php endif; ?>
<?php
					if(isset($this->variables['items']) && count($this->variables['items']) != 0 && $this->variables['items'] != '' && $this->variables['items'] !== false)
					{
						?>
	<div id="blogIndex">
		<?php
					if(!isset($this->variables['items']))
					{
						?>{iteration:items}<?php
						$this->variables['items'] = array();
						$this->iterations['8b7bae8acca957c96197ee600d0f1663_Index.tpl.php_1']['fail'] = true;
					}
				if(isset(${'items'})) $this->iterations['8b7bae8acca957c96197ee600d0f1663_Index.tpl.php_1']['old'] = ${'items'};
				$this->iterations['8b7bae8acca957c96197ee600d0f1663_Index.tpl.php_1']['iteration'] = $this->variables['items'];
				$this->iterations['8b7bae8acca957c96197ee600d0f1663_Index.tpl.php_1']['i'] = 1;
				$this->iterations['8b7bae8acca957c96197ee600d0f1663_Index.tpl.php_1']['count'] = count($this->iterations['8b7bae8acca957c96197ee600d0f1663_Index.tpl.php_1']['iteration']);
				foreach((array) $this->iterations['8b7bae8acca957c96197ee600d0f1663_Index.tpl.php_1']['iteration'] as ${'items'})
				{
					if(!isset(${'items'}['first']) && $this->iterations['8b7bae8acca957c96197ee600d0f1663_Index.tpl.php_1']['i'] == 1) ${'items'}['first'] = true;
					if(!isset(${'items'}['last']) && $this->iterations['8b7bae8acca957c96197ee600d0f1663_Index.tpl.php_1']['i'] == $this->iterations['8b7bae8acca957c96197ee600d0f1663_Index.tpl.php_1']['count']) ${'items'}['last'] = true;
					if(isset(${'items'}['formElements']) && is_array(${'items'}['formElements']))
					{
						foreach(${'items'}['formElements'] as $name => $object)
						{
							${'items'}[$name] = $object->parse();
							${'items'}[$name .'Error'] = (is_callable(array($object, 'getErrors')) && $object->getErrors() != '') ? '<span class="formError">' . $object->getErrors() .'</span>' : '';
						}
					} ?>
			<article class="mod">
				<div class="inner">
					<header class="hd">
						<h3><a href="<?php if(array_key_exists('full_url', (array) ${'items'})) { echo ${'items'}['full_url']; } else { ?>{$items->full_url}<?php } ?>" title="<?php if(array_key_exists('title', (array) ${'items'})) { echo ${'items'}['title']; } else { ?>{$items->title}<?php } ?>"><?php if(array_key_exists('title', (array) ${'items'})) { echo ${'items'}['title']; } else { ?>{$items->title}<?php } ?></a></h3>
						<ul>
							<li>
								
								<?php if(array_key_exists('msgWrittenBy', (array) $this->variables) && array_key_exists('user_id', (array) ${'items'})) { echo sprintf(SpoonFilter::ucfirst($this->variables['msgWrittenBy']), Frontend\Core\Engine\TemplateModifiers::userSetting(${'items'}['user_id'], 'nickname')); } else { ?>{$msgWrittenBy|ucfirst|sprintf:<?php if(array_key_exists('user_id', (array) ${'items'})) { echo Frontend\Core\Engine\TemplateModifiers::userSetting(${'items'}['user_id'], 'nickname'); } else { ?>{$items->user_id|usersetting:'nickname'}<?php } ?>}<?php } ?>

								
								<?php if(array_key_exists('lblOn', (array) $this->variables)) { echo $this->variables['lblOn']; } else { ?>{$lblOn}<?php } ?> <?php if(array_key_exists('publish_on', (array) ${'items'}) && array_key_exists('dateFormatLong', (array) $this->variables) && array_key_exists('LANGUAGE', (array) $this->variables)) { echo SpoonTemplateModifiers::date(${'items'}['publish_on'], $this->variables['dateFormatLong'], $this->variables['LANGUAGE']); } else { ?>{$items->publish_on|date:<?php if(array_key_exists('dateFormatLong', (array) $this->variables)) { echo $this->variables['dateFormatLong']; } else { ?>{$dateFormatLong}<?php } ?>:<?php if(array_key_exists('LANGUAGE', (array) $this->variables)) { echo $this->variables['LANGUAGE']; } else { ?>{$LANGUAGE}<?php } ?>}<?php } ?>

								
								<?php if(array_key_exists('lblIn', (array) $this->variables)) { echo $this->variables['lblIn']; } else { ?>{$lblIn}<?php } ?> <?php if(array_key_exists('lblThe', (array) $this->variables)) { echo $this->variables['lblThe']; } else { ?>{$lblThe}<?php } ?> <?php if(array_key_exists('lblCategory', (array) $this->variables)) { echo $this->variables['lblCategory']; } else { ?>{$lblCategory}<?php } ?> <a href="<?php if(array_key_exists('category_full_url', (array) ${'items'})) { echo ${'items'}['category_full_url']; } else { ?>{$items->category_full_url}<?php } ?>" title="<?php if(array_key_exists('category_title', (array) ${'items'})) { echo ${'items'}['category_title']; } else { ?>{$items->category_title}<?php } ?>"><?php if(array_key_exists('category_title', (array) ${'items'})) { echo ${'items'}['category_title']; } else { ?>{$items->category_title}<?php } ?></a><?php if(!isset(${'items'}['tags']) || count(${'items'}['tags']) == 0 || ${'items'}['tags'] == '' || ${'items'}['tags'] === false): ?>.<?php endif; ?>

								
								<?php
					if(isset(${'items'}['tags']) && count(${'items'}['tags']) != 0 && ${'items'}['tags'] != '' && ${'items'}['tags'] !== false)
					{
						?>
									<?php if(array_key_exists('lblWith', (array) $this->variables)) { echo $this->variables['lblWith']; } else { ?>{$lblWith}<?php } ?> <?php if(array_key_exists('lblThe', (array) $this->variables)) { echo $this->variables['lblThe']; } else { ?>{$lblThe}<?php } ?> <?php if(array_key_exists('lblTags', (array) $this->variables)) { echo $this->variables['lblTags']; } else { ?>{$lblTags}<?php } ?>
									<?php
					if(!isset(${'items'}['tags']))
					{
						?>{iteration:items->tags}<?php
						${'items'}['tags'] = array();
						$this->iterations['8b7bae8acca957c96197ee600d0f1663_Index.tpl.php_2']['tags']['fail'] = true;
					}
				if(isset(${'items'}['tags'])) $this->iterations['8b7bae8acca957c96197ee600d0f1663_Index.tpl.php_2']['tags']['old'] = ${'items'}['tags'];
				$this->iterations['8b7bae8acca957c96197ee600d0f1663_Index.tpl.php_2']['tags']['iteration'] = ${'items'}['tags'];
				$this->iterations['8b7bae8acca957c96197ee600d0f1663_Index.tpl.php_2']['tags']['i'] = 1;
				$this->iterations['8b7bae8acca957c96197ee600d0f1663_Index.tpl.php_2']['tags']['count'] = count($this->iterations['8b7bae8acca957c96197ee600d0f1663_Index.tpl.php_2']['tags']['iteration']);
				foreach((array) $this->iterations['8b7bae8acca957c96197ee600d0f1663_Index.tpl.php_2']['tags']['iteration'] as ${'items'}['tags'])
				{
					if(!isset(${'items'}['tags']['first']) && $this->iterations['8b7bae8acca957c96197ee600d0f1663_Index.tpl.php_2']['tags']['i'] == 1) ${'items'}['tags']['first'] = true;
					if(!isset(${'items'}['tags']['last']) && $this->iterations['8b7bae8acca957c96197ee600d0f1663_Index.tpl.php_2']['tags']['i'] == $this->iterations['8b7bae8acca957c96197ee600d0f1663_Index.tpl.php_2']['tags']['count']) ${'items'}['tags']['last'] = true;
					if(isset(${'items'}['tags']['formElements']) && is_array(${'items'}['tags']['formElements']))
					{
						foreach(${'items'}['tags']['formElements'] as $name => $object)
						{
							${'items'}['tags'][$name] = $object->parse();
							${'items'}['tags'][$name .'Error'] = (is_callable(array($object, 'getErrors')) && $object->getErrors() != '') ? '<span class="formError">' . $object->getErrors() .'</span>' : '';
						}
					} ?>
										<a href="<?php if(isset(${'items'}['tags']) && array_key_exists('full_url', (array) ${'items'}['tags'])) { echo ${'items'}['tags']['full_url']; } else { ?>{$items->tags.full_url}<?php } ?>" rel="tag" title="<?php if(isset(${'items'}['tags']) && array_key_exists('name', (array) ${'items'}['tags'])) { echo ${'items'}['tags']['name']; } else { ?>{$items->tags.name}<?php } ?>"><?php if(isset(${'items'}['tags']) && array_key_exists('name', (array) ${'items'}['tags'])) { echo ${'items'}['tags']['name']; } else { ?>{$items->tags.name}<?php } ?></a><?php if(!isset(${'items'}['tags']['last']) || count(${'items'}['tags']['last']) == 0 || ${'items'}['tags']['last'] == '' || ${'items'}['tags']['last'] === false): ?>, <?php endif; ?><?php
					if(isset(${'items'}['tags']['last']) && count(${'items'}['tags']['last']) != 0 && ${'items'}['tags']['last'] != '' && ${'items'}['tags']['last'] !== false)
					{
						?>.<?php } ?>
									<?php
					$this->iterations['8b7bae8acca957c96197ee600d0f1663_Index.tpl.php_2']['tags']['i']++;
				}
					if(isset($this->iterations['8b7bae8acca957c96197ee600d0f1663_Index.tpl.php_2']['tags']['fail']) && $this->iterations['8b7bae8acca957c96197ee600d0f1663_Index.tpl.php_2']['tags']['fail'] == true)
					{
						?>{/iteration:items->tags}<?php
					}
				if(isset($this->iterations['8b7bae8acca957c96197ee600d0f1663_Index.tpl.php_2']['tags']['old'])) ${'items'}['tags'] = $this->iterations['8b7bae8acca957c96197ee600d0f1663_Index.tpl.php_2']['tags']['old'];
				else unset($this->iterations['8b7bae8acca957c96197ee600d0f1663_Index.tpl.php_2']['tags']);
				?>
								<?php } ?>
							</li>
							
							<?php
					if(isset(${'items'}['allow_comments']) && count(${'items'}['allow_comments']) != 0 && ${'items'}['allow_comments'] != '' && ${'items'}['allow_comments'] !== false)
					{
						?>
								<li>
									<?php if(!isset(${'items'}['comments']) || count(${'items'}['comments']) == 0 || ${'items'}['comments'] == '' || ${'items'}['comments'] === false): ?><a href="<?php if(array_key_exists('full_url', (array) ${'items'})) { echo ${'items'}['full_url']; } else { ?>{$items->full_url}<?php } ?>#<?php if(array_key_exists('actComment', (array) $this->variables)) { echo $this->variables['actComment']; } else { ?>{$actComment}<?php } ?>"><?php if(array_key_exists('msgBlogNoComments', (array) $this->variables)) { echo SpoonFilter::ucfirst($this->variables['msgBlogNoComments']); } else { ?>{$msgBlogNoComments|ucfirst}<?php } ?></a><?php endif; ?>
									<?php
					if(isset(${'items'}['comments']) && count(${'items'}['comments']) != 0 && ${'items'}['comments'] != '' && ${'items'}['comments'] !== false)
					{
						?>
										<?php
					if(isset(${'items'}['comments_multiple']) && count(${'items'}['comments_multiple']) != 0 && ${'items'}['comments_multiple'] != '' && ${'items'}['comments_multiple'] !== false)
					{
						?><a href="<?php if(array_key_exists('full_url', (array) ${'items'})) { echo ${'items'}['full_url']; } else { ?>{$items->full_url}<?php } ?>#<?php if(array_key_exists('actComments', (array) $this->variables)) { echo $this->variables['actComments']; } else { ?>{$actComments}<?php } ?>"><?php if(array_key_exists('msgBlogNumberOfComments', (array) $this->variables) && array_key_exists('comments_count', (array) ${'items'})) { echo sprintf($this->variables['msgBlogNumberOfComments'], ${'items'}['comments_count']); } else { ?>{$msgBlogNumberOfComments|sprintf:<?php if(array_key_exists('comments_count', (array) ${'items'})) { echo ${'items'}['comments_count']; } else { ?>{$items->comments_count}<?php } ?>}<?php } ?></a><?php } ?>
										<?php if(!isset(${'items'}['comments_multiple']) || count(${'items'}['comments_multiple']) == 0 || ${'items'}['comments_multiple'] == '' || ${'items'}['comments_multiple'] === false): ?><a href="<?php if(array_key_exists('full_url', (array) ${'items'})) { echo ${'items'}['full_url']; } else { ?>{$items->full_url}<?php } ?>#<?php if(array_key_exists('actComments', (array) $this->variables)) { echo $this->variables['actComments']; } else { ?>{$actComments}<?php } ?>"><?php if(array_key_exists('msgBlogOneComment', (array) $this->variables)) { echo $this->variables['msgBlogOneComment']; } else { ?>{$msgBlogOneComment}<?php } ?></a><?php endif; ?>
									<?php } ?>
								</li>
							<?php } ?>
						</ul>
					</header>
					<div class="bd content">
						<?php
					if(isset(${'items'}['image']) && count(${'items'}['image']) != 0 && ${'items'}['image'] != '' && ${'items'}['image'] !== false)
					{
						?><img src="<?php if(array_key_exists('FRONTEND_FILES_URL', (array) $this->variables)) { echo $this->variables['FRONTEND_FILES_URL']; } else { ?>{$FRONTEND_FILES_URL}<?php } ?>/blog/images/source/<?php if(array_key_exists('image', (array) ${'items'})) { echo ${'items'}['image']; } else { ?>{$items->image}<?php } ?>" alt="<?php if(array_key_exists('title', (array) ${'items'})) { echo ${'items'}['title']; } else { ?>{$items->title}<?php } ?>" /><?php } ?>
						<?php if(!isset(${'items'}['introduction']) || count(${'items'}['introduction']) == 0 || ${'items'}['introduction'] == '' || ${'items'}['introduction'] === false): ?><?php if(array_key_exists('text', (array) ${'items'})) { echo ${'items'}['text']; } else { ?>{$items->text}<?php } ?><?php endif; ?>
						<?php
					if(isset(${'items'}['introduction']) && count(${'items'}['introduction']) != 0 && ${'items'}['introduction'] != '' && ${'items'}['introduction'] !== false)
					{
						?><?php if(array_key_exists('introduction', (array) ${'items'})) { echo ${'items'}['introduction']; } else { ?>{$items->introduction}<?php } ?><?php } ?>
					</div>
				</div>
			</article>
		<?php
					$this->iterations['8b7bae8acca957c96197ee600d0f1663_Index.tpl.php_1']['i']++;
				}
					if(isset($this->iterations['8b7bae8acca957c96197ee600d0f1663_Index.tpl.php_1']['fail']) && $this->iterations['8b7bae8acca957c96197ee600d0f1663_Index.tpl.php_1']['fail'] == true)
					{
						?>{/iteration:items}<?php
					}
				if(isset($this->iterations['8b7bae8acca957c96197ee600d0f1663_Index.tpl.php_1']['old'])) ${'items'} = $this->iterations['8b7bae8acca957c96197ee600d0f1663_Index.tpl.php_1']['old'];
				else unset($this->iterations['8b7bae8acca957c96197ee600d0f1663_Index.tpl.php_1']);
				?>
	</div>
	<?php $includes = array();
                ob_start();
                ?>Core/Layout/Templates/Pagination.tpl<?php
                $includes[] = str_replace('//', '/', eval('return \'' . str_replace('\'', '\\\'', ob_get_clean()) .'\';'));
                ob_start();
                ?>/home/segaz/domains/techno-mir.net/public_html/app/../src/Frontend/Themes/Core/Core/Layout/Templates/Pagination.tpl<?php
                $includes[] = str_replace('//', '/', eval('return \'' . str_replace('\'', '\\\'', ob_get_clean()) .'\';'));
                ob_start();
                ?>/home/segaz/domains/techno-mir.net/public_html/app/../src/Frontend/Core/Layout/Templates/Pagination.tpl<?php
                $includes[] = str_replace('//', '/', eval('return \'' . str_replace('\'', '\\\'', ob_get_clean()) .'\';'));
                foreach($includes as $include) if(@file_exists($include) && is_file($include)) break;
                if($this->getForceCompile() || !file_exists($this->getCompileDirectory() .'/' . $this->getCompileName($include, '/home/segaz/domains/techno-mir.net/public_html/src/Frontend/Modules/Blog/Layout/Templates'))) $this->compile('/home/segaz/domains/techno-mir.net/public_html/src/Frontend/Modules/Blog/Layout/Templates', $include);
                $return = @include $this->getCompileDirectory() .'/' . $this->getCompileName($include, '/home/segaz/domains/techno-mir.net/public_html/src/Frontend/Modules/Blog/Layout/Templates');
                if($return === false && $this->compile('/home/segaz/domains/techno-mir.net/public_html/src/Frontend/Modules/Blog/Layout/Templates', $include)) {
                    $return = @include $this->getCompileDirectory() .'/' . $this->getCompileName($include, '/home/segaz/domains/techno-mir.net/public_html/src/Frontend/Modules/Blog/Layout/Templates');
                }
if($return === false) {
                    ?>{include:Core/Layout/Templates/Pagination.tpl}<?php
                }
?>
<?php } ?>
