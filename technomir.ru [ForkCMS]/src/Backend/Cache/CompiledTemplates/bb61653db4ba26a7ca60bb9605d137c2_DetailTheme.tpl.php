<?php error_reporting(0); ini_set('display_errors', 'Off'); ?>
<?php
				ob_start();
				?><?php echo $this->variables['BACKEND_CORE_PATH']; ?>/Layout/Templates/Head.tpl<?php
				$include = eval('return \'' . str_replace('\'', '\\\'', ob_get_clean()) .'\';');
				if($this->getForceCompile() || !file_exists($this->getCompileDirectory() .'/' . $this->getCompileName($include, '/home/segaz/domains/techno-mir.net/public_html/src/Backend/Modules/Extensions/Layout/Templates'))) $this->compile('/home/segaz/domains/techno-mir.net/public_html/src/Backend/Modules/Extensions/Layout/Templates', $include);
				$return = @include $this->getCompileDirectory() .'/' . $this->getCompileName($include, '/home/segaz/domains/techno-mir.net/public_html/src/Backend/Modules/Extensions/Layout/Templates');
				if($return === false && $this->compile('/home/segaz/domains/techno-mir.net/public_html/src/Backend/Modules/Extensions/Layout/Templates', $include))
				{
					$return = @include $this->getCompileDirectory() .'/' . $this->getCompileName($include, '/home/segaz/domains/techno-mir.net/public_html/src/Backend/Modules/Extensions/Layout/Templates');
				}
?>
<?php
				ob_start();
				?><?php echo $this->variables['BACKEND_CORE_PATH']; ?>/Layout/Templates/StructureStartModule.tpl<?php
				$include = eval('return \'' . str_replace('\'', '\\\'', ob_get_clean()) .'\';');
				if($this->getForceCompile() || !file_exists($this->getCompileDirectory() .'/' . $this->getCompileName($include, '/home/segaz/domains/techno-mir.net/public_html/src/Backend/Modules/Extensions/Layout/Templates'))) $this->compile('/home/segaz/domains/techno-mir.net/public_html/src/Backend/Modules/Extensions/Layout/Templates', $include);
				$return = @include $this->getCompileDirectory() .'/' . $this->getCompileName($include, '/home/segaz/domains/techno-mir.net/public_html/src/Backend/Modules/Extensions/Layout/Templates');
				if($return === false && $this->compile('/home/segaz/domains/techno-mir.net/public_html/src/Backend/Modules/Extensions/Layout/Templates', $include))
				{
					$return = @include $this->getCompileDirectory() .'/' . $this->getCompileName($include, '/home/segaz/domains/techno-mir.net/public_html/src/Backend/Modules/Extensions/Layout/Templates');
				}
?>

<div class="pageTitle">
	<h2><?php echo SpoonFilter::ucfirst($this->variables['lblExtensions']); ?>: <?php echo sprintf($this->variables['msgTheme'], $this->variables['name']); ?></h2>
</div>

<?php
					if(isset($this->variables['warnings']) && count($this->variables['warnings']) != 0 && $this->variables['warnings'] != '' && $this->variables['warnings'] !== false)
					{
						?>
	<div class="generalMessage infoMessage content">
		<ul class="pb0">
			<?php
				if(isset(${'warnings'})) $this->iterations['bb61653db4ba26a7ca60bb9605d137c2_DetailTheme.tpl.php_1']['old'] = ${'warnings'};
				$this->iterations['bb61653db4ba26a7ca60bb9605d137c2_DetailTheme.tpl.php_1']['iteration'] = $this->variables['warnings'];
				$this->iterations['bb61653db4ba26a7ca60bb9605d137c2_DetailTheme.tpl.php_1']['i'] = 1;
				$this->iterations['bb61653db4ba26a7ca60bb9605d137c2_DetailTheme.tpl.php_1']['count'] = count($this->iterations['bb61653db4ba26a7ca60bb9605d137c2_DetailTheme.tpl.php_1']['iteration']);
				foreach((array) $this->iterations['bb61653db4ba26a7ca60bb9605d137c2_DetailTheme.tpl.php_1']['iteration'] as ${'warnings'})
				{
					if(!isset(${'warnings'}['first']) && $this->iterations['bb61653db4ba26a7ca60bb9605d137c2_DetailTheme.tpl.php_1']['i'] == 1) ${'warnings'}['first'] = true;
					if(!isset(${'warnings'}['last']) && $this->iterations['bb61653db4ba26a7ca60bb9605d137c2_DetailTheme.tpl.php_1']['i'] == $this->iterations['bb61653db4ba26a7ca60bb9605d137c2_DetailTheme.tpl.php_1']['count']) ${'warnings'}['last'] = true;
					if(isset(${'warnings'}['formElements']) && is_array(${'warnings'}['formElements']))
					{
						foreach(${'warnings'}['formElements'] as $name => $object)
						{
							${'warnings'}[$name] = $object->parse();
							${'warnings'}[$name .'Error'] = (is_callable(array($object, 'getErrors')) && $object->getErrors() != '') ? '<span class="formError">' . $object->getErrors() .'</span>' : '';
						}
					} ?>
				<li><?php echo ${'warnings'}['message']; ?></li>
			<?php
					$this->iterations['bb61653db4ba26a7ca60bb9605d137c2_DetailTheme.tpl.php_1']['i']++;
				}
				if(isset($this->iterations['bb61653db4ba26a7ca60bb9605d137c2_DetailTheme.tpl.php_1']['old'])) ${'warnings'} = $this->iterations['bb61653db4ba26a7ca60bb9605d137c2_DetailTheme.tpl.php_1']['old'];
				else unset($this->iterations['bb61653db4ba26a7ca60bb9605d137c2_DetailTheme.tpl.php_1']);
				?>
		</ul>
	</div>
<?php } ?>

<?php
					if(isset($this->variables['information']) && count($this->variables['information']) != 0 && $this->variables['information'] != '' && $this->variables['information'] !== false)
					{
						?>
	<table width="100%">
		<tr>
			<td id="leftColumn">
				<?php
					if(isset($this->variables['information']['description']) && count($this->variables['information']['description']) != 0 && $this->variables['information']['description'] != '' && $this->variables['information']['description'] !== false)
					{
						?>
					<div class="box">
						<div class="heading">
							<h3><?php echo SpoonFilter::ucfirst($this->variables['lblDescription']); ?></h3>
						</div>
						<div class="options">
							<p><?php echo $this->variables['information']['description']; ?></p>
						</div>
					</div>
				<?php } ?>
				<?php
					if(isset($this->variables['dataGridTemplates']) && count($this->variables['dataGridTemplates']) != 0 && $this->variables['dataGridTemplates'] != '' && $this->variables['dataGridTemplates'] !== false)
					{
						?>
					<div class="box">
						<div class="heading">
							<h3><?php echo SpoonFilter::ucfirst($this->variables['lblTemplates']); ?></h3>
						</div>
						<div class="dataGridHolder">
							<?php echo $this->variables['dataGridTemplates']; ?>
						</div>
					</div>
				<?php } ?>
			</td>
			<td id="sidebar">
				<?php
					if(isset($this->variables['information']['thumbnail']) && count($this->variables['information']['thumbnail']) != 0 && $this->variables['information']['thumbnail'] != '' && $this->variables['information']['thumbnail'] !== false)
					{
						?>
					<div class="box">
						<div class="heading">
							<h3><?php echo SpoonFilter::ucfirst($this->variables['lblImage']); ?></h3>
						</div>
						<div class="options">
							<img src="/src/Frontend/Themes/<?php echo $this->variables['name']; ?>/<?php echo $this->variables['information']['thumbnail']; ?>" alt="<?php echo $this->variables['name']; ?>" />
						</div>
					</div>
				<?php } ?>

				<?php
					if(isset($this->variables['information']['version']) && count($this->variables['information']['version']) != 0 && $this->variables['information']['version'] != '' && $this->variables['information']['version'] !== false)
					{
						?>
					<div class="box">
						<div class="heading">
							<h3><?php echo SpoonFilter::ucfirst($this->variables['lblVersion']); ?></h3>
						</div>
						<div class="options">
							<p><?php echo $this->variables['information']['version']; ?></p>
						</div>
					</div>
				<?php } ?>

				<?php
					if(isset($this->variables['information']['authors']) && count($this->variables['information']['authors']) != 0 && $this->variables['information']['authors'] != '' && $this->variables['information']['authors'] !== false)
					{
						?>
					<div class="box">
						<div class="heading">
							<h3><?php echo SpoonFilter::ucfirst($this->variables['lblAuthors']); ?></h3>
						</div>
						<div class="options">
							<ul>
								<?php
				if(isset(${'information'}['authors'])) $this->iterations['bb61653db4ba26a7ca60bb9605d137c2_DetailTheme.tpl.php_2']['authors']['old'] = ${'information'}['authors'];
				$this->iterations['bb61653db4ba26a7ca60bb9605d137c2_DetailTheme.tpl.php_2']['authors']['iteration'] = $this->variables['information']['authors'];
				$this->iterations['bb61653db4ba26a7ca60bb9605d137c2_DetailTheme.tpl.php_2']['authors']['i'] = 1;
				$this->iterations['bb61653db4ba26a7ca60bb9605d137c2_DetailTheme.tpl.php_2']['authors']['count'] = count($this->iterations['bb61653db4ba26a7ca60bb9605d137c2_DetailTheme.tpl.php_2']['authors']['iteration']);
				foreach((array) $this->iterations['bb61653db4ba26a7ca60bb9605d137c2_DetailTheme.tpl.php_2']['authors']['iteration'] as ${'information'}['authors'])
				{
					if(!isset(${'information'}['authors']['first']) && $this->iterations['bb61653db4ba26a7ca60bb9605d137c2_DetailTheme.tpl.php_2']['authors']['i'] == 1) ${'information'}['authors']['first'] = true;
					if(!isset(${'information'}['authors']['last']) && $this->iterations['bb61653db4ba26a7ca60bb9605d137c2_DetailTheme.tpl.php_2']['authors']['i'] == $this->iterations['bb61653db4ba26a7ca60bb9605d137c2_DetailTheme.tpl.php_2']['authors']['count']) ${'information'}['authors']['last'] = true;
					if(isset(${'information'}['authors']['formElements']) && is_array(${'information'}['authors']['formElements']))
					{
						foreach(${'information'}['authors']['formElements'] as $name => $object)
						{
							${'information'}['authors'][$name] = $object->parse();
							${'information'}['authors'][$name .'Error'] = (is_callable(array($object, 'getErrors')) && $object->getErrors() != '') ? '<span class="formError">' . $object->getErrors() .'</span>' : '';
						}
					} ?>
									<li>
										<?php
					if(isset(${'information'}['authors']['url']) && count(${'information'}['authors']['url']) != 0 && ${'information'}['authors']['url'] != '' && ${'information'}['authors']['url'] !== false)
					{
						?>
											<a href="<?php echo ${'information'}['authors']['url']; ?>" title="<?php echo ${'information'}['authors']['name']; ?>">
										<?php } ?>
										<?php echo ${'information'}['authors']['name']; ?>
										<?php
					if(isset(${'information'}['authors']['url']) && count(${'information'}['authors']['url']) != 0 && ${'information'}['authors']['url'] != '' && ${'information'}['authors']['url'] !== false)
					{
						?>
											</a>
										<?php } ?>
									</li>
								<?php
					$this->iterations['bb61653db4ba26a7ca60bb9605d137c2_DetailTheme.tpl.php_2']['authors']['i']++;
				}
				if(isset($this->iterations['bb61653db4ba26a7ca60bb9605d137c2_DetailTheme.tpl.php_2']['authors']['old'])) ${'information'}['authors'] = $this->iterations['bb61653db4ba26a7ca60bb9605d137c2_DetailTheme.tpl.php_2']['authors']['old'];
				else unset($this->iterations['bb61653db4ba26a7ca60bb9605d137c2_DetailTheme.tpl.php_2']['authors']);
				?>
							</ul>
						</div>
					</div>
				<?php } ?>
			</td>
		</tr>
	</table>
<?php } ?>

<?php
					if(isset($this->variables['showExtensionsInstallTheme']) && count($this->variables['showExtensionsInstallTheme']) != 0 && $this->variables['showExtensionsInstallTheme'] != '' && $this->variables['showExtensionsInstallTheme'] !== false)
					{
						?>
<div class="fullwidthOptions">
	<div class="buttonHolderRight">
		<a href="<?php echo Backend\Core\Engine\TemplateModifiers::getURL($this->variables['var'], 'install_theme'); ?>&amp;theme=<?php echo $this->variables['name']; ?>" data-message-id="confirmInstall" class="askConfirmation button mainButton">
			<span><?php echo SpoonFilter::ucfirst($this->variables['lblInstall']); ?></span>
		</a>
	</div>
</div>
<?php } ?>

<div id="confirmInstall" title="<?php echo SpoonFilter::ucfirst($this->variables['lblInstall']); ?>?" style="display: none;">
	<p>
		<?php echo sprintf($this->variables['msgConfirmThemeInstall'], $this->variables['name']); ?>
	</p>
</div>

<?php
				ob_start();
				?><?php echo $this->variables['BACKEND_CORE_PATH']; ?>/Layout/Templates/StructureEndModule.tpl<?php
				$include = eval('return \'' . str_replace('\'', '\\\'', ob_get_clean()) .'\';');
				if($this->getForceCompile() || !file_exists($this->getCompileDirectory() .'/' . $this->getCompileName($include, '/home/segaz/domains/techno-mir.net/public_html/src/Backend/Modules/Extensions/Layout/Templates'))) $this->compile('/home/segaz/domains/techno-mir.net/public_html/src/Backend/Modules/Extensions/Layout/Templates', $include);
				$return = @include $this->getCompileDirectory() .'/' . $this->getCompileName($include, '/home/segaz/domains/techno-mir.net/public_html/src/Backend/Modules/Extensions/Layout/Templates');
				if($return === false && $this->compile('/home/segaz/domains/techno-mir.net/public_html/src/Backend/Modules/Extensions/Layout/Templates', $include))
				{
					$return = @include $this->getCompileDirectory() .'/' . $this->getCompileName($include, '/home/segaz/domains/techno-mir.net/public_html/src/Backend/Modules/Extensions/Layout/Templates');
				}
?>
<?php
				ob_start();
				?><?php echo $this->variables['BACKEND_CORE_PATH']; ?>/Layout/Templates/Footer.tpl<?php
				$include = eval('return \'' . str_replace('\'', '\\\'', ob_get_clean()) .'\';');
				if($this->getForceCompile() || !file_exists($this->getCompileDirectory() .'/' . $this->getCompileName($include, '/home/segaz/domains/techno-mir.net/public_html/src/Backend/Modules/Extensions/Layout/Templates'))) $this->compile('/home/segaz/domains/techno-mir.net/public_html/src/Backend/Modules/Extensions/Layout/Templates', $include);
				$return = @include $this->getCompileDirectory() .'/' . $this->getCompileName($include, '/home/segaz/domains/techno-mir.net/public_html/src/Backend/Modules/Extensions/Layout/Templates');
				if($return === false && $this->compile('/home/segaz/domains/techno-mir.net/public_html/src/Backend/Modules/Extensions/Layout/Templates', $include))
				{
					$return = @include $this->getCompileDirectory() .'/' . $this->getCompileName($include, '/home/segaz/domains/techno-mir.net/public_html/src/Backend/Modules/Extensions/Layout/Templates');
				}
?>
