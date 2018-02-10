<?php error_reporting(E_ALL | E_STRICT); ini_set('display_errors', 'On'); ?>
<?php
				ob_start();
				?><?php if(array_key_exists('BACKEND_CORE_PATH', (array) $this->variables)) { echo $this->variables['BACKEND_CORE_PATH']; } else { ?>{$BACKEND_CORE_PATH}<?php } ?>/Layout/Templates/Head.tpl<?php
				$include = eval('return \'' . str_replace('\'', '\\\'', ob_get_clean()) .'\';');
				if($this->getForceCompile() || !file_exists($this->getCompileDirectory() .'/' . $this->getCompileName($include, '/home/segaz/domains/techno-mir.net/public_html/src/Backend/Modules/Slideshow/Layout/Templates'))) $this->compile('/home/segaz/domains/techno-mir.net/public_html/src/Backend/Modules/Slideshow/Layout/Templates', $include);
				$return = @include $this->getCompileDirectory() .'/' . $this->getCompileName($include, '/home/segaz/domains/techno-mir.net/public_html/src/Backend/Modules/Slideshow/Layout/Templates');
				if($return === false && $this->compile('/home/segaz/domains/techno-mir.net/public_html/src/Backend/Modules/Slideshow/Layout/Templates', $include))
				{
					$return = @include $this->getCompileDirectory() .'/' . $this->getCompileName($include, '/home/segaz/domains/techno-mir.net/public_html/src/Backend/Modules/Slideshow/Layout/Templates');
				}
if($return === false)
				{
					?>{include:<?php if(array_key_exists('BACKEND_CORE_PATH', (array) $this->variables)) { echo $this->variables['BACKEND_CORE_PATH']; } else { ?>{$BACKEND_CORE_PATH}<?php } ?>/Layout/Templates/Head.tpl}<?php
				}
?>
<?php
				ob_start();
				?><?php if(array_key_exists('BACKEND_CORE_PATH', (array) $this->variables)) { echo $this->variables['BACKEND_CORE_PATH']; } else { ?>{$BACKEND_CORE_PATH}<?php } ?>/Layout/Templates/StructureStartModule.tpl<?php
				$include = eval('return \'' . str_replace('\'', '\\\'', ob_get_clean()) .'\';');
				if($this->getForceCompile() || !file_exists($this->getCompileDirectory() .'/' . $this->getCompileName($include, '/home/segaz/domains/techno-mir.net/public_html/src/Backend/Modules/Slideshow/Layout/Templates'))) $this->compile('/home/segaz/domains/techno-mir.net/public_html/src/Backend/Modules/Slideshow/Layout/Templates', $include);
				$return = @include $this->getCompileDirectory() .'/' . $this->getCompileName($include, '/home/segaz/domains/techno-mir.net/public_html/src/Backend/Modules/Slideshow/Layout/Templates');
				if($return === false && $this->compile('/home/segaz/domains/techno-mir.net/public_html/src/Backend/Modules/Slideshow/Layout/Templates', $include))
				{
					$return = @include $this->getCompileDirectory() .'/' . $this->getCompileName($include, '/home/segaz/domains/techno-mir.net/public_html/src/Backend/Modules/Slideshow/Layout/Templates');
				}
if($return === false)
				{
					?>{include:<?php if(array_key_exists('BACKEND_CORE_PATH', (array) $this->variables)) { echo $this->variables['BACKEND_CORE_PATH']; } else { ?>{$BACKEND_CORE_PATH}<?php } ?>/Layout/Templates/StructureStartModule.tpl}<?php
				}
?>

<div class="pageTitle">
    <h2><?php if(array_key_exists('lblSlideshow', (array) $this->variables)) { echo SpoonFilter::ucfirst($this->variables['lblSlideshow']); } else { ?>{$lblSlideshow|ucfirst}<?php } ?>: <?php if(array_key_exists('lblGalleries', (array) $this->variables)) { echo $this->variables['lblGalleries']; } else { ?>{$lblGalleries}<?php } ?></h2>
    <div class="buttonHolderRight">
        <a href="<?php if(array_key_exists('var', (array) $this->variables)) { echo Backend\Core\Engine\TemplateModifiers::getURL($this->variables['var'], 'add'); } else { ?>{$var|geturl:'add'}<?php } ?>" class="button icon iconAdd" title="<?php if(array_key_exists('lblAdd', (array) $this->variables)) { echo SpoonFilter::ucfirst($this->variables['lblAdd']); } else { ?>{$lblAdd|ucfirst}<?php } ?>">
            <span><?php if(array_key_exists('lblAddGallery', (array) $this->variables)) { echo SpoonFilter::ucfirst($this->variables['lblAddGallery']); } else { ?>{$lblAddGallery|ucfirst}<?php } ?></span>
        </a>
    </div>
</div>

<div id="dataGridModelsHolder">
    <?php
					if(isset($this->variables['dataGrids']) && count($this->variables['dataGrids']) != 0 && $this->variables['dataGrids'] != '' && $this->variables['dataGrids'] !== false)
					{
						?>
        <?php
					if(!isset($this->variables['dataGrids']))
					{
						?>{iteration:dataGrids}<?php
						$this->variables['dataGrids'] = array();
						$this->iterations['e20d974af08de9f7a582766c539d91cc_Index.tpl.php_1']['fail'] = true;
					}
				if(isset(${'dataGrids'})) $this->iterations['e20d974af08de9f7a582766c539d91cc_Index.tpl.php_1']['old'] = ${'dataGrids'};
				$this->iterations['e20d974af08de9f7a582766c539d91cc_Index.tpl.php_1']['iteration'] = $this->variables['dataGrids'];
				$this->iterations['e20d974af08de9f7a582766c539d91cc_Index.tpl.php_1']['i'] = 1;
				$this->iterations['e20d974af08de9f7a582766c539d91cc_Index.tpl.php_1']['count'] = count($this->iterations['e20d974af08de9f7a582766c539d91cc_Index.tpl.php_1']['iteration']);
				foreach((array) $this->iterations['e20d974af08de9f7a582766c539d91cc_Index.tpl.php_1']['iteration'] as ${'dataGrids'})
				{
					if(!isset(${'dataGrids'}['first']) && $this->iterations['e20d974af08de9f7a582766c539d91cc_Index.tpl.php_1']['i'] == 1) ${'dataGrids'}['first'] = true;
					if(!isset(${'dataGrids'}['last']) && $this->iterations['e20d974af08de9f7a582766c539d91cc_Index.tpl.php_1']['i'] == $this->iterations['e20d974af08de9f7a582766c539d91cc_Index.tpl.php_1']['count']) ${'dataGrids'}['last'] = true;
					if(isset(${'dataGrids'}['formElements']) && is_array(${'dataGrids'}['formElements']))
					{
						foreach(${'dataGrids'}['formElements'] as $name => $object)
						{
							${'dataGrids'}[$name] = $object->parse();
							${'dataGrids'}[$name .'Error'] = (is_callable(array($object, 'getErrors')) && $object->getErrors() != '') ? '<span class="formError">' . $object->getErrors() .'</span>' : '';
						}
					} ?>
            <div class="dataGridHolder" id="dataGrid-<?php if(array_key_exists('id', (array) ${'dataGrids'})) { echo ${'dataGrids'}['id']; } else { ?>{$dataGrids->id}<?php } ?>">
                <div class="tableHeading">
                    <h3><?php if(array_key_exists('title', (array) ${'dataGrids'})) { echo ${'dataGrids'}['title']; } else { ?>{$dataGrids->title}<?php } ?></h3>
                </div>
                <?php
					if(isset(${'dataGrids'}['content']) && count(${'dataGrids'}['content']) != 0 && ${'dataGrids'}['content'] != '' && ${'dataGrids'}['content'] !== false)
					{
						?>
                    <?php if(array_key_exists('content', (array) ${'dataGrids'})) { echo ${'dataGrids'}['content']; } else { ?>{$dataGrids->content}<?php } ?>
                <?php } ?>

            </div>
        <?php
					$this->iterations['e20d974af08de9f7a582766c539d91cc_Index.tpl.php_1']['i']++;
				}
					if(isset($this->iterations['e20d974af08de9f7a582766c539d91cc_Index.tpl.php_1']['fail']) && $this->iterations['e20d974af08de9f7a582766c539d91cc_Index.tpl.php_1']['fail'] == true)
					{
						?>{/iteration:dataGrids}<?php
					}
				if(isset($this->iterations['e20d974af08de9f7a582766c539d91cc_Index.tpl.php_1']['old'])) ${'dataGrids'} = $this->iterations['e20d974af08de9f7a582766c539d91cc_Index.tpl.php_1']['old'];
				else unset($this->iterations['e20d974af08de9f7a582766c539d91cc_Index.tpl.php_1']);
				?>
    <?php } ?>
</div>

<?php if(!isset($this->variables['dataGrids']) || count($this->variables['dataGrids']) == 0 || $this->variables['dataGrids'] == '' || $this->variables['dataGrids'] === false): ?>
    <p><?php if(array_key_exists('msgNoItems', (array) $this->variables)) { echo $this->variables['msgNoItems']; } else { ?>{$msgNoItems}<?php } ?></p>
<?php endif; ?>

<?php
				ob_start();
				?><?php if(array_key_exists('BACKEND_CORE_PATH', (array) $this->variables)) { echo $this->variables['BACKEND_CORE_PATH']; } else { ?>{$BACKEND_CORE_PATH}<?php } ?>/Layout/Templates/StructureEndModule.tpl<?php
				$include = eval('return \'' . str_replace('\'', '\\\'', ob_get_clean()) .'\';');
				if($this->getForceCompile() || !file_exists($this->getCompileDirectory() .'/' . $this->getCompileName($include, '/home/segaz/domains/techno-mir.net/public_html/src/Backend/Modules/Slideshow/Layout/Templates'))) $this->compile('/home/segaz/domains/techno-mir.net/public_html/src/Backend/Modules/Slideshow/Layout/Templates', $include);
				$return = @include $this->getCompileDirectory() .'/' . $this->getCompileName($include, '/home/segaz/domains/techno-mir.net/public_html/src/Backend/Modules/Slideshow/Layout/Templates');
				if($return === false && $this->compile('/home/segaz/domains/techno-mir.net/public_html/src/Backend/Modules/Slideshow/Layout/Templates', $include))
				{
					$return = @include $this->getCompileDirectory() .'/' . $this->getCompileName($include, '/home/segaz/domains/techno-mir.net/public_html/src/Backend/Modules/Slideshow/Layout/Templates');
				}
if($return === false)
				{
					?>{include:<?php if(array_key_exists('BACKEND_CORE_PATH', (array) $this->variables)) { echo $this->variables['BACKEND_CORE_PATH']; } else { ?>{$BACKEND_CORE_PATH}<?php } ?>/Layout/Templates/StructureEndModule.tpl}<?php
				}
?>
<?php
				ob_start();
				?><?php if(array_key_exists('BACKEND_CORE_PATH', (array) $this->variables)) { echo $this->variables['BACKEND_CORE_PATH']; } else { ?>{$BACKEND_CORE_PATH}<?php } ?>/Layout/Templates/Footer.tpl<?php
				$include = eval('return \'' . str_replace('\'', '\\\'', ob_get_clean()) .'\';');
				if($this->getForceCompile() || !file_exists($this->getCompileDirectory() .'/' . $this->getCompileName($include, '/home/segaz/domains/techno-mir.net/public_html/src/Backend/Modules/Slideshow/Layout/Templates'))) $this->compile('/home/segaz/domains/techno-mir.net/public_html/src/Backend/Modules/Slideshow/Layout/Templates', $include);
				$return = @include $this->getCompileDirectory() .'/' . $this->getCompileName($include, '/home/segaz/domains/techno-mir.net/public_html/src/Backend/Modules/Slideshow/Layout/Templates');
				if($return === false && $this->compile('/home/segaz/domains/techno-mir.net/public_html/src/Backend/Modules/Slideshow/Layout/Templates', $include))
				{
					$return = @include $this->getCompileDirectory() .'/' . $this->getCompileName($include, '/home/segaz/domains/techno-mir.net/public_html/src/Backend/Modules/Slideshow/Layout/Templates');
				}
if($return === false)
				{
					?>{include:<?php if(array_key_exists('BACKEND_CORE_PATH', (array) $this->variables)) { echo $this->variables['BACKEND_CORE_PATH']; } else { ?>{$BACKEND_CORE_PATH}<?php } ?>/Layout/Templates/Footer.tpl}<?php
				}
?>