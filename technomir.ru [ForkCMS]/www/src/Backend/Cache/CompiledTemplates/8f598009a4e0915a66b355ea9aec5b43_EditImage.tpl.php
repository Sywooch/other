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
    <h2><?php if(array_key_exists('lblGallery', (array) $this->variables)) { echo SpoonFilter::ucfirst($this->variables['lblGallery']); } else { ?>{$lblGallery|ucfirst}<?php } ?>: <?php if(isset($this->variables['gallery']) && array_key_exists('title', (array) $this->variables['gallery'])) { echo $this->variables['gallery']['title']; } else { ?>{$gallery.title}<?php } ?></h2>
</div>

<?php
					if(isset($this->forms['edit']))
					{
						?><form accept-charset="UTF-8" action="<?php echo $this->forms['edit']->getAction(); ?>" method="<?php echo $this->forms['edit']->getMethod(); ?>"<?php echo $this->forms['edit']->getParametersHTML(); ?>>
						<?php echo $this->forms['edit']->getField('form')->parse();
						if($this->forms['edit']->getUseToken())
						{
							?><input type="hidden" name="form_token" id="<?php echo $this->forms['edit']->getField('form_token')->getAttribute('id'); ?>" value="<?php echo htmlspecialchars($this->forms['edit']->getField('form_token')->getValue()); ?>" />
						<?php } ?>
    <p>
            <?php if(array_key_exists('lblTitle', (array) $this->variables)) { echo SpoonFilter::ucfirst($this->variables['lblTitle']); } else { ?>{$lblTitle|ucfirst}<?php } ?><br/>
            <?php if(array_key_exists('txtTitle', (array) $this->variables)) { echo $this->variables['txtTitle']; } else { ?>{$txtTitle}<?php } ?> <?php if(array_key_exists('txtTitleError', (array) $this->variables)) { echo $this->variables['txtTitleError']; } else { ?>{$txtTitleError}<?php } ?>
    </p>
    <p>
            <?php if(array_key_exists('lblLink', (array) $this->variables)) { echo SpoonFilter::ucfirst($this->variables['lblLink']); } else { ?>{$lblLink|ucfirst}<?php } ?><br/>
            <?php if(array_key_exists('txtLink', (array) $this->variables)) { echo $this->variables['txtLink']; } else { ?>{$txtLink}<?php } ?> <?php if(array_key_exists('txtLinkError', (array) $this->variables)) { echo $this->variables['txtLinkError']; } else { ?>{$txtLinkError}<?php } ?>
    </p>
    <div class="ui-tabs">
        <div class="ui-tabs-panel">
            <div class="options">
                <table border="0" cellspacing="0" cellpadding="0" width="100%">
                    <tr>
                        <td id="leftColumn">

                            <div class="box">
                                <div class="heading">
                                    <h3><?php if(array_key_exists('lblDescription', (array) $this->variables)) { echo SpoonFilter::ucfirst($this->variables['lblDescription']); } else { ?>{$lblDescription|ucfirst}<?php } ?><abbr title="<?php if(array_key_exists('lblRequiredField', (array) $this->variables)) { echo $this->variables['lblRequiredField']; } else { ?>{$lblRequiredField}<?php } ?>"></abbr></h3>
                                </div>
                                <div class="optionsRTE">
                                    <?php if(array_key_exists('txtDescription', (array) $this->variables)) { echo $this->variables['txtDescription']; } else { ?>{$txtDescription}<?php } ?> <?php if(array_key_exists('txtDescriptionError', (array) $this->variables)) { echo $this->variables['txtDescriptionError']; } else { ?>{$txtDescriptionError}<?php } ?>
                                </div>
                            </div>
                            <p>
                                <?php
					if(isset($this->variables['item']['filename']) && count($this->variables['item']['filename']) != 0 && $this->variables['item']['filename'] != '' && $this->variables['item']['filename'] !== false)
					{
						?>
                                    <img src="/src/Frontend/Files/userfiles/images/slideshow/thumbnails/<?php if(isset($this->variables['item']) && array_key_exists('filename', (array) $this->variables['item'])) { echo $this->variables['item']['filename']; } else { ?>{$item.filename}<?php } ?>" alt="" />
                                <?php } ?>
                                <label for="filename">Afbeelding</label>
                                <?php if(array_key_exists('fileFilename', (array) $this->variables)) { echo $this->variables['fileFilename']; } else { ?>{$fileFilename}<?php } ?> <?php if(array_key_exists('fileFilenameError', (array) $this->variables)) { echo $this->variables['fileFilenameError']; } else { ?>{$fileFilenameError}<?php } ?>
                            </p>
                        </td>

                        <td id="sidebar">
                            <div id="publishOptions" class="box">
                                <div class="heading">
                                    <h3><?php if(array_key_exists('lblStatus', (array) $this->variables)) { echo SpoonFilter::ucfirst($this->variables['lblStatus']); } else { ?>{$lblStatus|ucfirst}<?php } ?></h3>
                                </div>
                                <div class="options">
                                    <ul class="inputList">
                                        <?php
					if(!isset($this->variables['hidden']))
					{
						?>{iteration:hidden}<?php
						$this->variables['hidden'] = array();
						$this->iterations['8f598009a4e0915a66b355ea9aec5b43_EditImage.tpl.php_1']['fail'] = true;
					}
				if(isset(${'hidden'})) $this->iterations['8f598009a4e0915a66b355ea9aec5b43_EditImage.tpl.php_1']['old'] = ${'hidden'};
				$this->iterations['8f598009a4e0915a66b355ea9aec5b43_EditImage.tpl.php_1']['iteration'] = $this->variables['hidden'];
				$this->iterations['8f598009a4e0915a66b355ea9aec5b43_EditImage.tpl.php_1']['i'] = 1;
				$this->iterations['8f598009a4e0915a66b355ea9aec5b43_EditImage.tpl.php_1']['count'] = count($this->iterations['8f598009a4e0915a66b355ea9aec5b43_EditImage.tpl.php_1']['iteration']);
				foreach((array) $this->iterations['8f598009a4e0915a66b355ea9aec5b43_EditImage.tpl.php_1']['iteration'] as ${'hidden'})
				{
					if(!isset(${'hidden'}['first']) && $this->iterations['8f598009a4e0915a66b355ea9aec5b43_EditImage.tpl.php_1']['i'] == 1) ${'hidden'}['first'] = true;
					if(!isset(${'hidden'}['last']) && $this->iterations['8f598009a4e0915a66b355ea9aec5b43_EditImage.tpl.php_1']['i'] == $this->iterations['8f598009a4e0915a66b355ea9aec5b43_EditImage.tpl.php_1']['count']) ${'hidden'}['last'] = true;
					if(isset(${'hidden'}['formElements']) && is_array(${'hidden'}['formElements']))
					{
						foreach(${'hidden'}['formElements'] as $name => $object)
						{
							${'hidden'}[$name] = $object->parse();
							${'hidden'}[$name .'Error'] = (is_callable(array($object, 'getErrors')) && $object->getErrors() != '') ? '<span class="formError">' . $object->getErrors() .'</span>' : '';
						}
					} ?>
                                        <li>
                                            <?php if(array_key_exists('rbtHidden', (array) ${'hidden'})) { echo ${'hidden'}['rbtHidden']; } else { ?>{$hidden->rbtHidden}<?php } ?>
                                            <label for="<?php if(array_key_exists('id', (array) ${'hidden'})) { echo ${'hidden'}['id']; } else { ?>{$hidden->id}<?php } ?>"><?php if(array_key_exists('label', (array) ${'hidden'})) { echo ${'hidden'}['label']; } else { ?>{$hidden->label}<?php } ?></label>
                                        </li>
                                        <?php
					$this->iterations['8f598009a4e0915a66b355ea9aec5b43_EditImage.tpl.php_1']['i']++;
				}
					if(isset($this->iterations['8f598009a4e0915a66b355ea9aec5b43_EditImage.tpl.php_1']['fail']) && $this->iterations['8f598009a4e0915a66b355ea9aec5b43_EditImage.tpl.php_1']['fail'] == true)
					{
						?>{/iteration:hidden}<?php
					}
				if(isset($this->iterations['8f598009a4e0915a66b355ea9aec5b43_EditImage.tpl.php_1']['old'])) ${'hidden'} = $this->iterations['8f598009a4e0915a66b355ea9aec5b43_EditImage.tpl.php_1']['old'];
				else unset($this->iterations['8f598009a4e0915a66b355ea9aec5b43_EditImage.tpl.php_1']);
				?>
                                    </ul>
                                </div>
                            </div>
                        </td>

                    </tr>
                </table>
            </div>
        </div>

        <div class="fullwidthOptions">
            <a href="<?php if(array_key_exists('var', (array) $this->variables)) { echo Backend\Core\Engine\TemplateModifiers::getURL($this->variables['var'], 'delete_image'); } else { ?>{$var|geturl:'delete_image'}<?php } ?>&amp;id=<?php if(isset($this->variables['item']) && array_key_exists('id', (array) $this->variables['item'])) { echo $this->variables['item']['id']; } else { ?>{$item.id}<?php } ?>&amp;gallery_id=<?php if(isset($this->variables['item']) && array_key_exists('gallery_id', (array) $this->variables['item'])) { echo $this->variables['item']['gallery_id']; } else { ?>{$item.gallery_id}<?php } ?>" data-message-id="confirmDelete" class="askConfirmation button linkButton icon iconDelete">
                <span><?php if(array_key_exists('lblDelete', (array) $this->variables)) { echo SpoonFilter::ucfirst($this->variables['lblDelete']); } else { ?>{$lblDelete|ucfirst}<?php } ?></span>
            </a>
            <div class="buttonHolderRight">
                <input id="editButton" class="inputButton button mainButton" type="submit" name="edit" value="<?php if(array_key_exists('lblSave', (array) $this->variables)) { echo SpoonFilter::ucfirst($this->variables['lblSave']); } else { ?>{$lblSave|ucfirst}<?php } ?>" />
            </div>
        </div>

        <div id="confirmDelete" title="<?php if(array_key_exists('lblDelete', (array) $this->variables)) { echo SpoonFilter::ucfirst($this->variables['lblDelete']); } else { ?>{$lblDelete|ucfirst}<?php } ?>?" style="display: none;">
            <p>
                Verwijderen? <?php if(isset($this->variables['item']) && array_key_exists('title', (array) $this->variables['item'])) { echo $this->variables['item']['title']; } else { ?>{$item.title}<?php } ?>
            </p>
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
