<?php error_reporting(E_ALL | E_STRICT); ini_set('display_errors', 'On'); ?>


<?php
					if(isset($this->variables['searchTerm']) && count($this->variables['searchTerm']) != 0 && $this->variables['searchTerm'] != '' && $this->variables['searchTerm'] !== false)
					{
						?>
	<section id="searchResults" class="mod">
		<div class="inner">
			<?php if(!isset($this->variables['searchResults']) || count($this->variables['searchResults']) == 0 || $this->variables['searchResults'] == '' || $this->variables['searchResults'] === false): ?>
				<div class="bd content">
					<p><?php if(array_key_exists('msgSearchNoItems', (array) $this->variables)) { echo $this->variables['msgSearchNoItems']; } else { ?>{$msgSearchNoItems}<?php } ?></p>
				</div>
			<?php endif; ?>
			<?php
					if(isset($this->variables['searchResults']) && count($this->variables['searchResults']) != 0 && $this->variables['searchResults'] != '' && $this->variables['searchResults'] !== false)
					{
						?>
				<?php
					if(!isset($this->variables['searchResults']))
					{
						?>{iteration:searchResults}<?php
						$this->variables['searchResults'] = array();
						$this->iterations['276cb3f423fe72cb3859d15d9c3a41a3_Results.tpl.php_1']['fail'] = true;
					}
				if(isset(${'searchResults'})) $this->iterations['276cb3f423fe72cb3859d15d9c3a41a3_Results.tpl.php_1']['old'] = ${'searchResults'};
				$this->iterations['276cb3f423fe72cb3859d15d9c3a41a3_Results.tpl.php_1']['iteration'] = $this->variables['searchResults'];
				$this->iterations['276cb3f423fe72cb3859d15d9c3a41a3_Results.tpl.php_1']['i'] = 1;
				$this->iterations['276cb3f423fe72cb3859d15d9c3a41a3_Results.tpl.php_1']['count'] = count($this->iterations['276cb3f423fe72cb3859d15d9c3a41a3_Results.tpl.php_1']['iteration']);
				foreach((array) $this->iterations['276cb3f423fe72cb3859d15d9c3a41a3_Results.tpl.php_1']['iteration'] as ${'searchResults'})
				{
					if(!isset(${'searchResults'}['first']) && $this->iterations['276cb3f423fe72cb3859d15d9c3a41a3_Results.tpl.php_1']['i'] == 1) ${'searchResults'}['first'] = true;
					if(!isset(${'searchResults'}['last']) && $this->iterations['276cb3f423fe72cb3859d15d9c3a41a3_Results.tpl.php_1']['i'] == $this->iterations['276cb3f423fe72cb3859d15d9c3a41a3_Results.tpl.php_1']['count']) ${'searchResults'}['last'] = true;
					if(isset(${'searchResults'}['formElements']) && is_array(${'searchResults'}['formElements']))
					{
						foreach(${'searchResults'}['formElements'] as $name => $object)
						{
							${'searchResults'}[$name] = $object->parse();
							${'searchResults'}[$name .'Error'] = (is_callable(array($object, 'getErrors')) && $object->getErrors() != '') ? '<span class="formError">' . $object->getErrors() .'</span>' : '';
						}
					} ?>
					<div class="bd">
						<section class="mod">
							<div class="inner">
								<header class="hd">
									<h3>
										<a href="<?php if(array_key_exists('full_url', (array) ${'searchResults'})) { echo ${'searchResults'}['full_url']; } else { ?>{$searchResults->full_url}<?php } ?>" title="<?php if(array_key_exists('title', (array) ${'searchResults'})) { echo ${'searchResults'}['title']; } else { ?>{$searchResults->title}<?php } ?>">
											<?php if(array_key_exists('title', (array) ${'searchResults'})) { echo ${'searchResults'}['title']; } else { ?>{$searchResults->title}<?php } ?>
										</a>
									</h3>
								</header>
								<div class="bd content">
									<?php if(!isset(${'searchResults'}['introduction']) || count(${'searchResults'}['introduction']) == 0 || ${'searchResults'}['introduction'] == '' || ${'searchResults'}['introduction'] === false): ?><?php if(array_key_exists('text', (array) ${'searchResults'})) { echo Frontend\Core\Engine\TemplateModifiers::truncate(${'searchResults'}['text'], 200); } else { ?>{$searchResults->text|truncate:200}<?php } ?><?php endif; ?>
									<?php
					if(isset(${'searchResults'}['introduction']) && count(${'searchResults'}['introduction']) != 0 && ${'searchResults'}['introduction'] != '' && ${'searchResults'}['introduction'] !== false)
					{
						?><?php if(array_key_exists('introduction', (array) ${'searchResults'})) { echo ${'searchResults'}['introduction']; } else { ?>{$searchResults->introduction}<?php } ?><?php } ?>
								</div>
							</div>
						</section>
					</div>
				<?php
					$this->iterations['276cb3f423fe72cb3859d15d9c3a41a3_Results.tpl.php_1']['i']++;
				}
					if(isset($this->iterations['276cb3f423fe72cb3859d15d9c3a41a3_Results.tpl.php_1']['fail']) && $this->iterations['276cb3f423fe72cb3859d15d9c3a41a3_Results.tpl.php_1']['fail'] == true)
					{
						?>{/iteration:searchResults}<?php
					}
				if(isset($this->iterations['276cb3f423fe72cb3859d15d9c3a41a3_Results.tpl.php_1']['old'])) ${'searchResults'} = $this->iterations['276cb3f423fe72cb3859d15d9c3a41a3_Results.tpl.php_1']['old'];
				else unset($this->iterations['276cb3f423fe72cb3859d15d9c3a41a3_Results.tpl.php_1']);
				?>
			<?php } ?>
		</div>
	</section>
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
                if($this->getForceCompile() || !file_exists($this->getCompileDirectory() .'/' . $this->getCompileName($include, '/home/segaz/domains/techno-mir.net/public_html/src/Frontend/Modules/Search/Layout/Templates'))) $this->compile('/home/segaz/domains/techno-mir.net/public_html/src/Frontend/Modules/Search/Layout/Templates', $include);
                $return = @include $this->getCompileDirectory() .'/' . $this->getCompileName($include, '/home/segaz/domains/techno-mir.net/public_html/src/Frontend/Modules/Search/Layout/Templates');
                if($return === false && $this->compile('/home/segaz/domains/techno-mir.net/public_html/src/Frontend/Modules/Search/Layout/Templates', $include)) {
                    $return = @include $this->getCompileDirectory() .'/' . $this->getCompileName($include, '/home/segaz/domains/techno-mir.net/public_html/src/Frontend/Modules/Search/Layout/Templates');
                }
if($return === false) {
                    ?>{include:Core/Layout/Templates/Pagination.tpl}<?php
                }
?>
<?php } ?>
