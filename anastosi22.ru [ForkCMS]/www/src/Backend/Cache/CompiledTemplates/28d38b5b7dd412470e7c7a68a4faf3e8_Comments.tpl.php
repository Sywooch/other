<?php error_reporting(0); ini_set('display_errors', 'Off'); ?>
<div class="box" id="widgetBlogComments">
	<div class="heading">
		<h3><a href="<?php echo Backend\Core\Engine\TemplateModifiers::getURL($this->variables['var'], 'comments', 'blog'); ?>"><?php echo SpoonFilter::ucfirst($this->variables['lblBlog']); ?>: <?php echo SpoonFilter::ucfirst($this->variables['lblLatestComments']); ?></a></h3>
	</div>

	<?php
					if(isset($this->variables['blogNumCommentsToModerate']) && count($this->variables['blogNumCommentsToModerate']) != 0 && $this->variables['blogNumCommentsToModerate'] != '' && $this->variables['blogNumCommentsToModerate'] !== false)
					{
						?>
	<div class="moderate">
		<div class="oneLiner">
			<p><?php echo sprintf($this->variables['msgCommentsToModerate'], $this->variables['blogNumCommentsToModerate']); ?></p>
			<div class="buttonHolder">
				<a href="<?php echo Backend\Core\Engine\TemplateModifiers::getURL($this->variables['var'], 'comments', 'blog'); ?>#tabModeration" class="button"><span><?php echo SpoonFilter::ucfirst($this->variables['lblModerate']); ?></span></a>
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
				if(isset(${'blogComments'})) $this->iterations['28d38b5b7dd412470e7c7a68a4faf3e8_Comments.tpl.php_1']['old'] = ${'blogComments'};
				$this->iterations['28d38b5b7dd412470e7c7a68a4faf3e8_Comments.tpl.php_1']['iteration'] = $this->variables['blogComments'];
				$this->iterations['28d38b5b7dd412470e7c7a68a4faf3e8_Comments.tpl.php_1']['i'] = 1;
				$this->iterations['28d38b5b7dd412470e7c7a68a4faf3e8_Comments.tpl.php_1']['count'] = count($this->iterations['28d38b5b7dd412470e7c7a68a4faf3e8_Comments.tpl.php_1']['iteration']);
				foreach((array) $this->iterations['28d38b5b7dd412470e7c7a68a4faf3e8_Comments.tpl.php_1']['iteration'] as ${'blogComments'})
				{
					if(!isset(${'blogComments'}['first']) && $this->iterations['28d38b5b7dd412470e7c7a68a4faf3e8_Comments.tpl.php_1']['i'] == 1) ${'blogComments'}['first'] = true;
					if(!isset(${'blogComments'}['last']) && $this->iterations['28d38b5b7dd412470e7c7a68a4faf3e8_Comments.tpl.php_1']['i'] == $this->iterations['28d38b5b7dd412470e7c7a68a4faf3e8_Comments.tpl.php_1']['count']) ${'blogComments'}['last'] = true;
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
					echo $this->cycle($this->iterations['28d38b5b7dd412470e7c7a68a4faf3e8_Comments.tpl.php_1']['i'], $arguments);
					?>
">
					<td><a href="<?php echo ${'blogComments'}['full_url']; ?>"><?php echo ${'blogComments'}['title']; ?></a></td>
					<td class="name"><?php echo ${'blogComments'}['author']; ?></td>
				</tr>
				<?php
					$this->iterations['28d38b5b7dd412470e7c7a68a4faf3e8_Comments.tpl.php_1']['i']++;
				}
				if(isset($this->iterations['28d38b5b7dd412470e7c7a68a4faf3e8_Comments.tpl.php_1']['old'])) ${'blogComments'} = $this->iterations['28d38b5b7dd412470e7c7a68a4faf3e8_Comments.tpl.php_1']['old'];
				else unset($this->iterations['28d38b5b7dd412470e7c7a68a4faf3e8_Comments.tpl.php_1']);
				?>
			</tbody>
		</table>
	</div>
	<?php } ?>

	<?php if(!isset($this->variables['blogComments']) || count($this->variables['blogComments']) == 0 || $this->variables['blogComments'] == '' || $this->variables['blogComments'] === false): ?>
	<div class="options content">
		<p><?php echo $this->variables['msgNoPublishedComments']; ?></p>
	</div>
	<?php endif; ?>

	<div class="footer">
		<div class="buttonHolderRight">
			<a href="<?php echo Backend\Core\Engine\TemplateModifiers::getURL($this->variables['var'], 'comments', 'blog'); ?>" class="button"><span><?php echo SpoonFilter::ucfirst($this->variables['lblAllComments']); ?></span></a>
		</div>
	</div>
</div>