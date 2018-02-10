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
    <h2><?php if(array_key_exists('lblSlideshow', (array) $this->variables)) { echo SpoonFilter::ucfirst($this->variables['lblSlideshow']); } else { ?>{$lblSlideshow|ucfirst}<?php } ?>: <?php if(isset($this->variables['item']) && array_key_exists('title', (array) $this->variables['item'])) { echo $this->variables['item']['title']; } else { ?>{$item.title}<?php } ?> (<?php if(isset($this->variables['item']) && array_key_exists('width', (array) $this->variables['item'])) { echo $this->variables['item']['width']; } else { ?>{$item.width}<?php } ?> x <?php if(isset($this->variables['item']) && array_key_exists('height', (array) $this->variables['item'])) { echo $this->variables['item']['height']; } else { ?>{$item.height}<?php } ?>)</h2>
</div>

<?php
					if(isset($this->forms['add']))
					{
						?><form accept-charset="UTF-8" action="<?php echo $this->forms['add']->getAction(); ?>" method="<?php echo $this->forms['add']->getMethod(); ?>"<?php echo $this->forms['add']->getParametersHTML(); ?>>
						<?php echo $this->forms['add']->getField('form')->parse();
						if($this->forms['add']->getUseToken())
						{
							?><input type="hidden" name="form_token" id="<?php echo $this->forms['add']->getField('form_token')->getAttribute('id'); ?>" value="<?php echo htmlspecialchars($this->forms['add']->getField('form_token')->getValue()); ?>" />
						<?php } ?>
    <div class="ui-tabs">
        <div class="ui-tabs-panel">
            <div class="options">
                <table border="0" cellspacing="0" cellpadding="0" width="100%">
                    <tr>
                        <td id="leftColumn">
                                <p>
                                    <label for="filename"><?php if(array_key_exists('lblImages', (array) $this->variables)) { echo SpoonFilter::ucfirst($this->variables['lblImages']); } else { ?>{$lblImages|ucfirst}<?php } ?></label>
                                    <?php
					if(!isset($this->variables['imageInput']))
					{
						?>{iteration:imageInput}<?php
						$this->variables['imageInput'] = array();
						$this->iterations['7188a258d68a2c34432e51aa1d121b84_AddImage.tpl.php_1']['fail'] = true;
					}
				if(isset(${'imageInput'})) $this->iterations['7188a258d68a2c34432e51aa1d121b84_AddImage.tpl.php_1']['old'] = ${'imageInput'};
				$this->iterations['7188a258d68a2c34432e51aa1d121b84_AddImage.tpl.php_1']['iteration'] = $this->variables['imageInput'];
				$this->iterations['7188a258d68a2c34432e51aa1d121b84_AddImage.tpl.php_1']['i'] = 1;
				$this->iterations['7188a258d68a2c34432e51aa1d121b84_AddImage.tpl.php_1']['count'] = count($this->iterations['7188a258d68a2c34432e51aa1d121b84_AddImage.tpl.php_1']['iteration']);
				foreach((array) $this->iterations['7188a258d68a2c34432e51aa1d121b84_AddImage.tpl.php_1']['iteration'] as ${'imageInput'})
				{
					if(!isset(${'imageInput'}['first']) && $this->iterations['7188a258d68a2c34432e51aa1d121b84_AddImage.tpl.php_1']['i'] == 1) ${'imageInput'}['first'] = true;
					if(!isset(${'imageInput'}['last']) && $this->iterations['7188a258d68a2c34432e51aa1d121b84_AddImage.tpl.php_1']['i'] == $this->iterations['7188a258d68a2c34432e51aa1d121b84_AddImage.tpl.php_1']['count']) ${'imageInput'}['last'] = true;
					if(isset(${'imageInput'}['formElements']) && is_array(${'imageInput'}['formElements']))
					{
						foreach(${'imageInput'}['formElements'] as $name => $object)
						{
							${'imageInput'}[$name] = $object->parse();
							${'imageInput'}[$name .'Error'] = (is_callable(array($object, 'getErrors')) && $object->getErrors() != '') ? '<span class="formError">' . $object->getErrors() .'</span>' : '';
						}
					} ?>
                                    <p>
                                    <?php if(array_key_exists('Image', (array) ${'imageInput'})) { echo ${'imageInput'}['Image']; } else { ?>{$imageInput->Image}<?php } ?> <?php if(array_key_exists('ImageError', (array) ${'imageInput'})) { echo ${'imageInput'}['ImageError']; } else { ?>{$imageInput->ImageError}<?php } ?>
                                    </p>
                                    <?php
					$this->iterations['7188a258d68a2c34432e51aa1d121b84_AddImage.tpl.php_1']['i']++;
				}
					if(isset($this->iterations['7188a258d68a2c34432e51aa1d121b84_AddImage.tpl.php_1']['fail']) && $this->iterations['7188a258d68a2c34432e51aa1d121b84_AddImage.tpl.php_1']['fail'] == true)
					{
						?>{/iteration:imageInput}<?php
					}
				if(isset($this->iterations['7188a258d68a2c34432e51aa1d121b84_AddImage.tpl.php_1']['old'])) ${'imageInput'} = $this->iterations['7188a258d68a2c34432e51aa1d121b84_AddImage.tpl.php_1']['old'];
				else unset($this->iterations['7188a258d68a2c34432e51aa1d121b84_AddImage.tpl.php_1']);
				?>
                        </td>
                        </td>
                    </tr>
                </table>
            </div>
        </div>

        <div class="fullwidthOptions">
            <div class="buttonHolderRight">
                <input id="editButton" class="inputButton button mainButton" type="submit" name="edit" value="<?php if(array_key_exists('lblAdd', (array) $this->variables)) { echo SpoonFilter::ucfirst($this->variables['lblAdd']); } else { ?>{$lblAdd|ucfirst}<?php } ?>" />
            </div>
        </div>
</form>
				<?php } ?>

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
