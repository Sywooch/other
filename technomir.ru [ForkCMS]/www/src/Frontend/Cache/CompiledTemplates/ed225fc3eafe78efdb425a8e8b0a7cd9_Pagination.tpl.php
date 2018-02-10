<?php error_reporting(E_ALL | E_STRICT); ini_set('display_errors', 'On'); ?>
<?php
					if(isset($this->variables['pagination']) && count($this->variables['pagination']) != 0 && $this->variables['pagination'] != '' && $this->variables['pagination'] !== false)
					{
						?>
	<?php
					if(isset($this->variables['pagination']['multiple_pages']) && count($this->variables['pagination']['multiple_pages']) != 0 && $this->variables['pagination']['multiple_pages'] != '' && $this->variables['pagination']['multiple_pages'] !== false)
					{
						?>
		<nav class="pagination">
					<ul class="pagination">
						<li class="previousPage">
							<?php
					if(isset($this->variables['pagination']['show_previous']) && count($this->variables['pagination']['show_previous']) != 0 && $this->variables['pagination']['show_previous'] != '' && $this->variables['pagination']['show_previous'] !== false)
					{
						?><a href="<?php if(isset($this->variables['pagination']) && array_key_exists('previous_url', (array) $this->variables['pagination'])) { echo $this->variables['pagination']['previous_url']; } else { ?>{$pagination.previous_url}<?php } ?>" rel="prev nofollow" title="<?php if(array_key_exists('lblPreviousPage', (array) $this->variables)) { echo SpoonFilter::ucfirst($this->variables['lblPreviousPage']); } else { ?>{$lblPreviousPage|ucfirst}<?php } ?>"><?php } ?>
							<?php if(!isset($this->variables['pagination']['show_previous']) || count($this->variables['pagination']['show_previous']) == 0 || $this->variables['pagination']['show_previous'] == '' || $this->variables['pagination']['show_previous'] === false): ?><span><?php endif; ?>
								&lsaquo; <?php if(array_key_exists('lblPreviousPage', (array) $this->variables)) { echo SpoonFilter::ucfirst($this->variables['lblPreviousPage']); } else { ?>{$lblPreviousPage|ucfirst}<?php } ?>
							<?php if(!isset($this->variables['pagination']['show_previous']) || count($this->variables['pagination']['show_previous']) == 0 || $this->variables['pagination']['show_previous'] == '' || $this->variables['pagination']['show_previous'] === false): ?></span><?php endif; ?>
							<?php
					if(isset($this->variables['pagination']['show_previous']) && count($this->variables['pagination']['show_previous']) != 0 && $this->variables['pagination']['show_previous'] != '' && $this->variables['pagination']['show_previous'] !== false)
					{
						?></a><?php } ?>
						</li>

						<?php
					if(isset($this->variables['pagination']['first']) && count($this->variables['pagination']['first']) != 0 && $this->variables['pagination']['first'] != '' && $this->variables['pagination']['first'] !== false)
					{
						?>
							<?php
					if(!isset($this->variables['pagination']['first']))
					{
						?>{iteration:pagination.first}<?php
						$this->variables['pagination']['first'] = array();
						$this->iterations['ed225fc3eafe78efdb425a8e8b0a7cd9_Pagination.tpl.php_1']['first']['fail'] = true;
					}
				if(isset(${'pagination'}['first'])) $this->iterations['ed225fc3eafe78efdb425a8e8b0a7cd9_Pagination.tpl.php_1']['first']['old'] = ${'pagination'}['first'];
				$this->iterations['ed225fc3eafe78efdb425a8e8b0a7cd9_Pagination.tpl.php_1']['first']['iteration'] = $this->variables['pagination']['first'];
				$this->iterations['ed225fc3eafe78efdb425a8e8b0a7cd9_Pagination.tpl.php_1']['first']['i'] = 1;
				$this->iterations['ed225fc3eafe78efdb425a8e8b0a7cd9_Pagination.tpl.php_1']['first']['count'] = count($this->iterations['ed225fc3eafe78efdb425a8e8b0a7cd9_Pagination.tpl.php_1']['first']['iteration']);
				foreach((array) $this->iterations['ed225fc3eafe78efdb425a8e8b0a7cd9_Pagination.tpl.php_1']['first']['iteration'] as ${'pagination'}['first'])
				{
					if(!isset(${'pagination'}['first']['first']) && $this->iterations['ed225fc3eafe78efdb425a8e8b0a7cd9_Pagination.tpl.php_1']['first']['i'] == 1) ${'pagination'}['first']['first'] = true;
					if(!isset(${'pagination'}['first']['last']) && $this->iterations['ed225fc3eafe78efdb425a8e8b0a7cd9_Pagination.tpl.php_1']['first']['i'] == $this->iterations['ed225fc3eafe78efdb425a8e8b0a7cd9_Pagination.tpl.php_1']['first']['count']) ${'pagination'}['first']['last'] = true;
					if(isset(${'pagination'}['first']['formElements']) && is_array(${'pagination'}['first']['formElements']))
					{
						foreach(${'pagination'}['first']['formElements'] as $name => $object)
						{
							${'pagination'}['first'][$name] = $object->parse();
							${'pagination'}['first'][$name .'Error'] = (is_callable(array($object, 'getErrors')) && $object->getErrors() != '') ? '<span class="formError">' . $object->getErrors() .'</span>' : '';
						}
					} ?><li><a href="<?php if(isset(${'pagination'}['first']) && array_key_exists('url', (array) ${'pagination'}['first'])) { echo ${'pagination'}['first']['url']; } else { ?>{$pagination.first->url}<?php } ?>" rel="nofollow" title="<?php if(array_key_exists('lblGoToPage', (array) $this->variables)) { echo SpoonFilter::ucfirst($this->variables['lblGoToPage']); } else { ?>{$lblGoToPage|ucfirst}<?php } ?> <?php if(isset(${'pagination'}['first']) && array_key_exists('label', (array) ${'pagination'}['first'])) { echo ${'pagination'}['first']['label']; } else { ?>{$pagination.first->label}<?php } ?>"><?php if(isset(${'pagination'}['first']) && array_key_exists('label', (array) ${'pagination'}['first'])) { echo ${'pagination'}['first']['label']; } else { ?>{$pagination.first->label}<?php } ?></a></li><?php
					$this->iterations['ed225fc3eafe78efdb425a8e8b0a7cd9_Pagination.tpl.php_1']['first']['i']++;
				}
					if(isset($this->iterations['ed225fc3eafe78efdb425a8e8b0a7cd9_Pagination.tpl.php_1']['first']['fail']) && $this->iterations['ed225fc3eafe78efdb425a8e8b0a7cd9_Pagination.tpl.php_1']['first']['fail'] == true)
					{
						?>{/iteration:pagination.first}<?php
					}
				if(isset($this->iterations['ed225fc3eafe78efdb425a8e8b0a7cd9_Pagination.tpl.php_1']['first']['old'])) ${'pagination'}['first'] = $this->iterations['ed225fc3eafe78efdb425a8e8b0a7cd9_Pagination.tpl.php_1']['first']['old'];
				else unset($this->iterations['ed225fc3eafe78efdb425a8e8b0a7cd9_Pagination.tpl.php_1']['first']);
				?>
							<li class="ellipsis"><span>&hellip;</span></li>
						<?php } ?>

						<?php
					if(!isset($this->variables['pagination']['pages']))
					{
						?>{iteration:pagination.pages}<?php
						$this->variables['pagination']['pages'] = array();
						$this->iterations['ed225fc3eafe78efdb425a8e8b0a7cd9_Pagination.tpl.php_2']['pages']['fail'] = true;
					}
				if(isset(${'pagination'}['pages'])) $this->iterations['ed225fc3eafe78efdb425a8e8b0a7cd9_Pagination.tpl.php_2']['pages']['old'] = ${'pagination'}['pages'];
				$this->iterations['ed225fc3eafe78efdb425a8e8b0a7cd9_Pagination.tpl.php_2']['pages']['iteration'] = $this->variables['pagination']['pages'];
				$this->iterations['ed225fc3eafe78efdb425a8e8b0a7cd9_Pagination.tpl.php_2']['pages']['i'] = 1;
				$this->iterations['ed225fc3eafe78efdb425a8e8b0a7cd9_Pagination.tpl.php_2']['pages']['count'] = count($this->iterations['ed225fc3eafe78efdb425a8e8b0a7cd9_Pagination.tpl.php_2']['pages']['iteration']);
				foreach((array) $this->iterations['ed225fc3eafe78efdb425a8e8b0a7cd9_Pagination.tpl.php_2']['pages']['iteration'] as ${'pagination'}['pages'])
				{
					if(!isset(${'pagination'}['pages']['first']) && $this->iterations['ed225fc3eafe78efdb425a8e8b0a7cd9_Pagination.tpl.php_2']['pages']['i'] == 1) ${'pagination'}['pages']['first'] = true;
					if(!isset(${'pagination'}['pages']['last']) && $this->iterations['ed225fc3eafe78efdb425a8e8b0a7cd9_Pagination.tpl.php_2']['pages']['i'] == $this->iterations['ed225fc3eafe78efdb425a8e8b0a7cd9_Pagination.tpl.php_2']['pages']['count']) ${'pagination'}['pages']['last'] = true;
					if(isset(${'pagination'}['pages']['formElements']) && is_array(${'pagination'}['pages']['formElements']))
					{
						foreach(${'pagination'}['pages']['formElements'] as $name => $object)
						{
							${'pagination'}['pages'][$name] = $object->parse();
							${'pagination'}['pages'][$name .'Error'] = (is_callable(array($object, 'getErrors')) && $object->getErrors() != '') ? '<span class="formError">' . $object->getErrors() .'</span>' : '';
						}
					} ?>
							<li<?php
					if(isset(${'pagination'}['pages']['current']) && count(${'pagination'}['pages']['current']) != 0 && ${'pagination'}['pages']['current'] != '' && ${'pagination'}['pages']['current'] !== false)
					{
						?> class="currentPage"<?php } ?>>
								<?php if(!isset(${'pagination'}['pages']['current']) || count(${'pagination'}['pages']['current']) == 0 || ${'pagination'}['pages']['current'] == '' || ${'pagination'}['pages']['current'] === false): ?><a href="<?php if(isset(${'pagination'}['pages']) && array_key_exists('url', (array) ${'pagination'}['pages'])) { echo ${'pagination'}['pages']['url']; } else { ?>{$pagination.pages->url}<?php } ?>" rel="nofollow" title="<?php if(array_key_exists('lblGoToPage', (array) $this->variables)) { echo SpoonFilter::ucfirst($this->variables['lblGoToPage']); } else { ?>{$lblGoToPage|ucfirst}<?php } ?> <?php if(isset(${'pagination'}['pages']) && array_key_exists('label', (array) ${'pagination'}['pages'])) { echo ${'pagination'}['pages']['label']; } else { ?>{$pagination.pages->label}<?php } ?>"><?php endif; ?>
								<?php
					if(isset(${'pagination'}['pages']['current']) && count(${'pagination'}['pages']['current']) != 0 && ${'pagination'}['pages']['current'] != '' && ${'pagination'}['pages']['current'] !== false)
					{
						?><span><?php } ?>
									<?php if(isset(${'pagination'}['pages']) && array_key_exists('label', (array) ${'pagination'}['pages'])) { echo ${'pagination'}['pages']['label']; } else { ?>{$pagination.pages->label}<?php } ?>
								<?php
					if(isset(${'pagination'}['pages']['current']) && count(${'pagination'}['pages']['current']) != 0 && ${'pagination'}['pages']['current'] != '' && ${'pagination'}['pages']['current'] !== false)
					{
						?></span><?php } ?>
								<?php if(!isset(${'pagination'}['pages']['current']) || count(${'pagination'}['pages']['current']) == 0 || ${'pagination'}['pages']['current'] == '' || ${'pagination'}['pages']['current'] === false): ?></a><?php endif; ?>
							</li>
						<?php
					$this->iterations['ed225fc3eafe78efdb425a8e8b0a7cd9_Pagination.tpl.php_2']['pages']['i']++;
				}
					if(isset($this->iterations['ed225fc3eafe78efdb425a8e8b0a7cd9_Pagination.tpl.php_2']['pages']['fail']) && $this->iterations['ed225fc3eafe78efdb425a8e8b0a7cd9_Pagination.tpl.php_2']['pages']['fail'] == true)
					{
						?>{/iteration:pagination.pages}<?php
					}
				if(isset($this->iterations['ed225fc3eafe78efdb425a8e8b0a7cd9_Pagination.tpl.php_2']['pages']['old'])) ${'pagination'}['pages'] = $this->iterations['ed225fc3eafe78efdb425a8e8b0a7cd9_Pagination.tpl.php_2']['pages']['old'];
				else unset($this->iterations['ed225fc3eafe78efdb425a8e8b0a7cd9_Pagination.tpl.php_2']['pages']);
				?>

						<?php
					if(isset($this->variables['pagination']['last']) && count($this->variables['pagination']['last']) != 0 && $this->variables['pagination']['last'] != '' && $this->variables['pagination']['last'] !== false)
					{
						?>
							<li><span>&hellip;</span></li>
							<?php
					if(!isset($this->variables['pagination']['last']))
					{
						?>{iteration:pagination.last}<?php
						$this->variables['pagination']['last'] = array();
						$this->iterations['ed225fc3eafe78efdb425a8e8b0a7cd9_Pagination.tpl.php_3']['last']['fail'] = true;
					}
				if(isset(${'pagination'}['last'])) $this->iterations['ed225fc3eafe78efdb425a8e8b0a7cd9_Pagination.tpl.php_3']['last']['old'] = ${'pagination'}['last'];
				$this->iterations['ed225fc3eafe78efdb425a8e8b0a7cd9_Pagination.tpl.php_3']['last']['iteration'] = $this->variables['pagination']['last'];
				$this->iterations['ed225fc3eafe78efdb425a8e8b0a7cd9_Pagination.tpl.php_3']['last']['i'] = 1;
				$this->iterations['ed225fc3eafe78efdb425a8e8b0a7cd9_Pagination.tpl.php_3']['last']['count'] = count($this->iterations['ed225fc3eafe78efdb425a8e8b0a7cd9_Pagination.tpl.php_3']['last']['iteration']);
				foreach((array) $this->iterations['ed225fc3eafe78efdb425a8e8b0a7cd9_Pagination.tpl.php_3']['last']['iteration'] as ${'pagination'}['last'])
				{
					if(!isset(${'pagination'}['last']['first']) && $this->iterations['ed225fc3eafe78efdb425a8e8b0a7cd9_Pagination.tpl.php_3']['last']['i'] == 1) ${'pagination'}['last']['first'] = true;
					if(!isset(${'pagination'}['last']['last']) && $this->iterations['ed225fc3eafe78efdb425a8e8b0a7cd9_Pagination.tpl.php_3']['last']['i'] == $this->iterations['ed225fc3eafe78efdb425a8e8b0a7cd9_Pagination.tpl.php_3']['last']['count']) ${'pagination'}['last']['last'] = true;
					if(isset(${'pagination'}['last']['formElements']) && is_array(${'pagination'}['last']['formElements']))
					{
						foreach(${'pagination'}['last']['formElements'] as $name => $object)
						{
							${'pagination'}['last'][$name] = $object->parse();
							${'pagination'}['last'][$name .'Error'] = (is_callable(array($object, 'getErrors')) && $object->getErrors() != '') ? '<span class="formError">' . $object->getErrors() .'</span>' : '';
						}
					} ?><li><a href="<?php if(isset(${'pagination'}['last']) && array_key_exists('url', (array) ${'pagination'}['last'])) { echo ${'pagination'}['last']['url']; } else { ?>{$pagination.last->url}<?php } ?>" rel="nofollow" title="<?php if(array_key_exists('lblGoToPage', (array) $this->variables)) { echo SpoonFilter::ucfirst($this->variables['lblGoToPage']); } else { ?>{$lblGoToPage|ucfirst}<?php } ?> <?php if(isset(${'pagination'}['last']) && array_key_exists('label', (array) ${'pagination'}['last'])) { echo ${'pagination'}['last']['label']; } else { ?>{$pagination.last->label}<?php } ?>"><?php if(isset(${'pagination'}['last']) && array_key_exists('label', (array) ${'pagination'}['last'])) { echo ${'pagination'}['last']['label']; } else { ?>{$pagination.last->label}<?php } ?></a></li><?php
					$this->iterations['ed225fc3eafe78efdb425a8e8b0a7cd9_Pagination.tpl.php_3']['last']['i']++;
				}
					if(isset($this->iterations['ed225fc3eafe78efdb425a8e8b0a7cd9_Pagination.tpl.php_3']['last']['fail']) && $this->iterations['ed225fc3eafe78efdb425a8e8b0a7cd9_Pagination.tpl.php_3']['last']['fail'] == true)
					{
						?>{/iteration:pagination.last}<?php
					}
				if(isset($this->iterations['ed225fc3eafe78efdb425a8e8b0a7cd9_Pagination.tpl.php_3']['last']['old'])) ${'pagination'}['last'] = $this->iterations['ed225fc3eafe78efdb425a8e8b0a7cd9_Pagination.tpl.php_3']['last']['old'];
				else unset($this->iterations['ed225fc3eafe78efdb425a8e8b0a7cd9_Pagination.tpl.php_3']['last']);
				?>
						<?php } ?>

						<li class="nextPage">
							<?php
					if(isset($this->variables['pagination']['show_next']) && count($this->variables['pagination']['show_next']) != 0 && $this->variables['pagination']['show_next'] != '' && $this->variables['pagination']['show_next'] !== false)
					{
						?><a href="<?php if(isset($this->variables['pagination']) && array_key_exists('next_url', (array) $this->variables['pagination'])) { echo $this->variables['pagination']['next_url']; } else { ?>{$pagination.next_url}<?php } ?>" rel="next nofollow" title="<?php if(array_key_exists('lblNextPage', (array) $this->variables)) { echo SpoonFilter::ucfirst($this->variables['lblNextPage']); } else { ?>{$lblNextPage|ucfirst}<?php } ?>"><?php } ?>
							<?php if(!isset($this->variables['pagination']['show_next']) || count($this->variables['pagination']['show_next']) == 0 || $this->variables['pagination']['show_next'] == '' || $this->variables['pagination']['show_next'] === false): ?><span><?php endif; ?>
								<?php if(array_key_exists('lblNextPage', (array) $this->variables)) { echo SpoonFilter::ucfirst($this->variables['lblNextPage']); } else { ?>{$lblNextPage|ucfirst}<?php } ?> &#8250;
							<?php if(!isset($this->variables['pagination']['show_next']) || count($this->variables['pagination']['show_next']) == 0 || $this->variables['pagination']['show_next'] == '' || $this->variables['pagination']['show_next'] === false): ?></span><?php endif; ?>
							<?php
					if(isset($this->variables['pagination']['show_next']) && count($this->variables['pagination']['show_next']) != 0 && $this->variables['pagination']['show_next'] != '' && $this->variables['pagination']['show_next'] !== false)
					{
						?></a><?php } ?>
						</li>
					</ul>
		</nav>
	<?php } ?>
<?php } ?>