<?php error_reporting(E_ALL | E_STRICT); ini_set('display_errors', 'On'); ?>
<div class="box" id="widgetBlogComments">
	<div class="heading">
		<h3><a href="<?php if(array_key_exists('var', (array) $this->variables)) { echo Backend\Core\Engine\TemplateModifiers::getURL($this->variables['var'], 'comments', 'blog'); } else { ?>{$var|geturl:'comments':'blog'}<?php } ?>"><?php if(array_key_exists('lblBlog', (array) $this->variables)) { echo SpoonFilter::ucfirst($this->variables['lblBlog']); } else { ?>{$lblBlog|ucfirst}<?php } ?>: <?php if(array_key_exists('lblLatestComments', (array) $this->variables)) { echo SpoonFilter::ucfirst($this->variables['lblLatestComments']); } else { ?>{$lblLatestComments|ucfirst}<?php } ?></a></h3>
	</div>

	<?php
					if(isset($this->variables['blogNumCommentsToModerate']) && count($this->variables['blogNumCommentsToModerate']) != 0 && $this->variables['blogNumCommentsToModerate'] != '' && $this->variables['blogNumCommentsToModerate'] !== false)
					{
						?>
	<div class="moderate">
		<div class="oneLiner">
			<p><?php if(array_key_exists('msgCommentsToModerate', (array) $this->variables) && array_key_exists('blogNumCommentsToModerate', (array) $this->variables)) { echo sprintf($this->variables['msgCommentsToModerate'], $this->variables['blogNumCommentsToModerate']); } else { ?>{$msgCommentsToModerate|sprintf:<?php if(array_key_exists('blogNumCommentsToModerate', (array) $this->variables)) { echo $this->variables['blogNumCommentsToModerate']; } else { ?>{$blogNumCommentsToModerate}<?php } ?>}<?php } ?></p>
			<div class="buttonHolder">
				<a href="<?php if(array_key_exists('var', (array) $this->variables)) { echo Backend\Core\Engine\TemplateModifiers::getURL($this->variables['var'], 'comments', 'blog'); } else { ?>{$var|geturl:'comments':'blog'}<?php } ?>#tabModeration" class="button"><span><?php if(array_key_exists('lblModerate', (array) $this->variables)) { echo SpoonFilter::ucfirst($this->variables['lblModerate']); } else { ?>{$lblModerate|ucfirst}<?php } ?></span></a>
			</div>
		</div>
	</div>
	<?php } ?>

	<?php
					if(isset($this->variables['blogComments']) && count($this->variables['blogComments']) != 0 && $this->variables['blogComments'] != '' && $this->variables['blogComments'] !== false)
					{
						?>
	<div class="dataGridHolder">
		<table class="dataGrid">
			<tbody>
				<?php
					if(!isset($this->variables['blogComments']))
					{
						?>{iteration:blogComments}<?php
						$this->variables['blogComments'] = array();
						$this->iterations['d08326052576b901c1b04063098d37e6_Comments.tpl.php_1']['fail'] = true;
					}
				if(isset(${'blogComments'})) $this->iterations['d08326052576b901c1b04063098d37e6_Comments.tpl.php_1']['old'] = ${'blogComments'};
				$this->iterations['d08326052576b901c1b04063098d37e6_Comments.tpl.php_1']['iteration'] = $this->variables['blogComments'];
				$this->iterations['d08326052576b901c1b04063098d37e6_Comments.tpl.php_1']['i'] = 1;
				$this->iterations['d08326052576b901c1b04063098d37e6_Comments.tpl.php_1']['count'] = count($this->iterations['d08326052576b901c1b04063098d37e6_Comments.tpl.php_1']['iteration']);
				foreach((array) $this->iterations['d08326052576b901c1b04063098d37e6_Comments.tpl.php_1']['iteration'] as ${'blogComments'})
				{
					if(!isset(${'blogComments'}['first']) && $this->iterations['d08326052576b901c1b04063098d37e6_Comments.tpl.php_1']['i'] == 1) ${'blogComments'}['first'] = true;
					if(!isset(${'blogComments'}['last']) && $this->iterations['d08326052576b901c1b04063098d37e6_Comments.tpl.php_1']['i'] == $this->iterations['d08326052576b901c1b04063098d37e6_Comments.tpl.php_1']['count']) ${'blogComments'}['last'] = true;
					if(isset(${'blogComments'}['formElements']) && is_array(${'blogComments'}['formElements']))
					{
						foreach(${'blogComments'}['formElements'] as $name => $object)
						{
							${'blogComments'}[$name] = $object->parse();
							${'blogComments'}[$name .'Error'] = (is_callable(array($object, 'getErrors')) && $object->getErrors() != '') ? '<span class="formError">' . $object->getErrors() .'</span>' : '';
						}
					} ?>
				<tr class="<?php
					$arguments = array();
						ob_start();
						?>odd<?php
						$arguments[] = eval('return \'' . str_replace('\'', '\\\'', ob_get_clean()) .'\';');
						ob_start();
						?>even<?php
						$arguments[] = eval('return \'' . str_replace('\'', '\\\'', ob_get_clean()) .'\';');
					echo $this->cycle($this->iterations['d08326052576b901c1b04063098d37e6_Comments.tpl.php_1']['i'], $arguments);
					?>
">
					<td><a href="<?php if(array_key_exists('full_url', (array) ${'blogComments'})) { echo ${'blogComments'}['full_url']; } else { ?>{$blogComments->full_url}<?php } ?>"><?php if(array_key_exists('title', (array) ${'blogComments'})) { echo ${'blogComments'}['title']; } else { ?>{$blogComments->title}<?php } ?></a></td>
					<td class="name"><?php if(array_key_exists('author', (array) ${'blogComments'})) { echo ${'blogComments'}['author']; } else { ?>{$blogComments->author}<?php } ?></td>
				</tr>
				<?php
					$this->iterations['d08326052576b901c1b04063098d37e6_Comments.tpl.php_1']['i']++;
				}
					if(isset($this->iterations['d08326052576b901c1b04063098d37e6_Comments.tpl.php_1']['fail']) && $this->iterations['d08326052576b901c1b04063098d37e6_Comments.tpl.php_1']['fail'] == true)
					{
						?>{/iteration:blogComments}<?php
					}
				if(isset($this->iterations['d08326052576b901c1b04063098d37e6_Comments.tpl.php_1']['old'])) ${'blogComments'} = $this->iterations['d08326052576b901c1b04063098d37e6_Comments.tpl.php_1']['old'];
				else unset($this->iterations['d08326052576b901c1b04063098d37e6_Comments.tpl.php_1']);
				?>
			</tbody>
		</table>
	</div>
	<?php } ?>

	<?php if(!isset($this->variables['blogComments']) || count($this->variables['blogComments']) == 0 || $this->variables['blogComments'] == '' || $this->variables['blogComments'] === false): ?>
	<div class="options content">
		<p><?php if(array_key_exists('msgNoPublishedComments', (array) $this->variables)) { echo $this->variables['msgNoPublishedComments']; } else { ?>{$msgNoPublishedComments}<?php } ?></p>
	</div>
	<?php endif; ?>

	<div class="footer">
		<div class="buttonHolderRight">
			<a href="<?php if(array_key_exists('var', (array) $this->variables)) { echo Backend\Core\Engine\TemplateModifiers::getURL($this->variables['var'], 'comments', 'blog'); } else { ?>{$var|geturl:'comments':'blog'}<?php } ?>" class="button"><span><?php if(array_key_exists('lblAllComments', (array) $this->variables)) { echo SpoonFilter::ucfirst($this->variables['lblAllComments']); } else { ?>{$lblAllComments|ucfirst}<?php } ?></span></a>
		</div>
	</div>
</div>