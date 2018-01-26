<?php error_reporting(0); ini_set('display_errors', 'Off'); ?>
<?php
				ob_start();
				?><?php echo $this->variables['BACKEND_CORE_PATH']; ?>/Layout/Templates/Head.tpl<?php
				$include = eval('return \'' . str_replace('\'', '\\\'', ob_get_clean()) .'\';');
				if($this->getForceCompile() || !file_exists($this->getCompileDirectory() .'/' . $this->getCompileName($include, '/home/anastosi/domains/anastosi.ru/public_html/src/Backend/Modules/Slideshow/Layout/Templates'))) $this->compile('/home/anastosi/domains/anastosi.ru/public_html/src/Backend/Modules/Slideshow/Layout/Templates', $include);
				$return = @include $this->getCompileDirectory() .'/' . $this->getCompileName($include, '/home/anastosi/domains/anastosi.ru/public_html/src/Backend/Modules/Slideshow/Layout/Templates');
				if($return === false && $this->compile('/home/anastosi/domains/anastosi.ru/public_html/src/Backend/Modules/Slideshow/Layout/Templates', $include))
				{
					$return = @include $this->getCompileDirectory() .'/' . $this->getCompileName($include, '/home/anastosi/domains/anastosi.ru/public_html/src/Backend/Modules/Slideshow/Layout/Templates');
				}
?>
<?php
				ob_start();
				?><?php echo $this->variables['BACKEND_CORE_PATH']; ?>/Layout/Templates/StructureStartModule.tpl<?php
				$include = eval('return \'' . str_replace('\'', '\\\'', ob_get_clean()) .'\';');
				if($this->getForceCompile() || !file_exists($this->getCompileDirectory() .'/' . $this->getCompileName($include, '/home/anastosi/domains/anastosi.ru/public_html/src/Backend/Modules/Slideshow/Layout/Templates'))) $this->compile('/home/anastosi/domains/anastosi.ru/public_html/src/Backend/Modules/Slideshow/Layout/Templates', $include);
				$return = @include $this->getCompileDirectory() .'/' . $this->getCompileName($include, '/home/anastosi/domains/anastosi.ru/public_html/src/Backend/Modules/Slideshow/Layout/Templates');
				if($return === false && $this->compile('/home/anastosi/domains/anastosi.ru/public_html/src/Backend/Modules/Slideshow/Layout/Templates', $include))
				{
					$return = @include $this->getCompileDirectory() .'/' . $this->getCompileName($include, '/home/anastosi/domains/anastosi.ru/public_html/src/Backend/Modules/Slideshow/Layout/Templates');
				}
?>

<div class="pageTitle">
    <h2><?php echo SpoonFilter::ucfirst($this->variables['lblSlideshow']); ?>: <?php echo $this->variables['lblGalleries']; ?></h2>
    <div class="buttonHolderRight">
        <a href="<?php echo Backend\Core\Engine\TemplateModifiers::getURL($this->variables['var'], 'add'); ?>" class="button icon iconAdd" title="<?php echo SpoonFilter::ucfirst($this->variables['lblAdd']); ?>">
            <span><?php echo SpoonFilter::ucfirst($this->variables['lblAddGallery']); ?></span>
        </a>
    </div>
</div>

<div id="dataGridModelsHolder">
    <?php
					if(isset($this->variables['dataGrids']) && count($this->variables['dataGrids']) != 0 && $this->variables['dataGrids'] != '' && $this->variables['dataGrids'] !== false)
					{
						?>
        <?php
				if(isset(${'dataGrids'})) $this->iterations['a4f40731b414227d313638166d7f6dbb_Index.tpl.php_1']['old'] = ${'dataGrids'};
				$this->iterations['a4f40731b414227d313638166d7f6dbb_Index.tpl.php_1']['iteration'] = $this->variables['dataGrids'];
				$this->iterations['a4f40731b414227d313638166d7f6dbb_Index.tpl.php_1']['i'] = 1;
				$this->iterations['a4f40731b414227d313638166d7f6dbb_Index.tpl.php_1']['count'] = count($this->iterations['a4f40731b414227d313638166d7f6dbb_Index.tpl.php_1']['iteration']);
				foreach((array) $this->iterations['a4f40731b414227d313638166d7f6dbb_Index.tpl.php_1']['iteration'] as ${'dataGrids'})
				{
					if(!isset(${'dataGrids'}['first']) && $this->iterations['a4f40731b414227d313638166d7f6dbb_Index.tpl.php_1']['i'] == 1) ${'dataGrids'}['first'] = true;
					if(!isset(${'dataGrids'}['last']) && $this->iterations['a4f40731b414227d313638166d7f6dbb_Index.tpl.php_1']['i'] == $this->iterations['a4f40731b414227d313638166d7f6dbb_Index.tpl.php_1']['count']) ${'dataGrids'}['last'] = true;
					if(isset(${'dataGrids'}['formElements']) && is_array(${'dataGrids'}['formElements']))
					{
						foreach(${'dataGrids'}['formElements'] as $name => $object)
						{
							${'dataGrids'}[$name] = $object->parse();
							${'dataGrids'}[$name .'Error'] = (is_callable(array($object, 'getErrors')) && $object->getErrors() != '') ? '<span class="formError">' . $object->getErrors() .'</span>' : '';
						}
					} ?>
            <div class="dataGridHolder" id="dataGrid-<?php echo ${'dataGrids'}['id']; ?>">
                <div class="tableHeading">
                    <h3><?php echo ${'dataGrids'}['title']; ?></h3>
                </div>
                <?php
					if(isset(${'dataGrids'}['content']) && count(${'dataGrids'}['content']) != 0 && ${'dataGrids'}['content'] != '' && ${'dataGrids'}['content'] !== false)
					{
						?>
                    <?php echo ${'dataGrids'}['content']; ?>
                <?php } ?>

            </div>
        <?php
					$this->iterations['a4f40731b414227d313638166d7f6dbb_Index.tpl.php_1']['i']++;
				}
				if(isset($this->iterations['a4f40731b414227d313638166d7f6dbb_Index.tpl.php_1']['old'])) ${'dataGrids'} = $this->iterations['a4f40731b414227d313638166d7f6dbb_Index.tpl.php_1']['old'];
				else unset($this->iterations['a4f40731b414227d313638166d7f6dbb_Index.tpl.php_1']);
				?>
    <?php } ?>
</div>

<?php if(!isset($this->variables['dataGrids']) || count($this->variables['dataGrids']) == 0 || $this->variables['dataGrids'] == '' || $this->variables['dataGrids'] === false): ?>
    <p><?php echo $this->variables['msgNoItems']; ?></p>
<?php endif; ?>

<?php
				ob_start();
				?><?php echo $this->variables['BACKEND_CORE_PATH']; ?>/Layout/Templates/StructureEndModule.tpl<?php
				$include = eval('return \'' . str_replace('\'', '\\\'', ob_get_clean()) .'\';');
				if($this->getForceCompile() || !file_exists($this->getCompileDirectory() .'/' . $this->getCompileName($include, '/home/anastosi/domains/anastosi.ru/public_html/src/Backend/Modules/Slideshow/Layout/Templates'))) $this->compile('/home/anastosi/domains/anastosi.ru/public_html/src/Backend/Modules/Slideshow/Layout/Templates', $include);
				$return = @include $this->getCompileDirectory() .'/' . $this->getCompileName($include, '/home/anastosi/domains/anastosi.ru/public_html/src/Backend/Modules/Slideshow/Layout/Templates');
				if($return === false && $this->compile('/home/anastosi/domains/anastosi.ru/public_html/src/Backend/Modules/Slideshow/Layout/Templates', $include))
				{
					$return = @include $this->getCompileDirectory() .'/' . $this->getCompileName($include, '/home/anastosi/domains/anastosi.ru/public_html/src/Backend/Modules/Slideshow/Layout/Templates');
				}
?>
<?php
				ob_start();
				?><?php echo $this->variables['BACKEND_CORE_PATH']; ?>/Layout/Templates/Footer.tpl<?php
				$include = eval('return \'' . str_replace('\'', '\\\'', ob_get_clean()) .'\';');
				if($this->getForceCompile() || !file_exists($this->getCompileDirectory() .'/' . $this->getCompileName($include, '/home/anastosi/domains/anastosi.ru/public_html/src/Backend/Modules/Slideshow/Layout/Templates'))) $this->compile('/home/anastosi/domains/anastosi.ru/public_html/src/Backend/Modules/Slideshow/Layout/Templates', $include);
				$return = @include $this->getCompileDirectory() .'/' . $this->getCompileName($include, '/home/anastosi/domains/anastosi.ru/public_html/src/Backend/Modules/Slideshow/Layout/Templates');
				if($return === false && $this->compile('/home/anastosi/domains/anastosi.ru/public_html/src/Backend/Modules/Slideshow/Layout/Templates', $include))
				{
					$return = @include $this->getCompileDirectory() .'/' . $this->getCompileName($include, '/home/anastosi/domains/anastosi.ru/public_html/src/Backend/Modules/Slideshow/Layout/Templates');
				}
?>