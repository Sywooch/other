<?php error_reporting(0); ini_set('display_errors', 'Off'); ?>
<?php
				ob_start();
				?><?php echo $this->variables['BACKEND_CORE_PATH']; ?>/Layout/Templates/Head.tpl<?php
				$include = eval('return \'' . str_replace('\'', '\\\'', ob_get_clean()) .'\';');
				if($this->getForceCompile() || !file_exists($this->getCompileDirectory() .'/' . $this->getCompileName($include, '/home/segaz/domains/techno-mir.net/public_html/src/Backend/Modules/Slideshow/Layout/Templates'))) $this->compile('/home/segaz/domains/techno-mir.net/public_html/src/Backend/Modules/Slideshow/Layout/Templates', $include);
				$return = @include $this->getCompileDirectory() .'/' . $this->getCompileName($include, '/home/segaz/domains/techno-mir.net/public_html/src/Backend/Modules/Slideshow/Layout/Templates');
				if($return === false && $this->compile('/home/segaz/domains/techno-mir.net/public_html/src/Backend/Modules/Slideshow/Layout/Templates', $include))
				{
					$return = @include $this->getCompileDirectory() .'/' . $this->getCompileName($include, '/home/segaz/domains/techno-mir.net/public_html/src/Backend/Modules/Slideshow/Layout/Templates');
				}
?>
<?php
				ob_start();
				?><?php echo $this->variables['BACKEND_CORE_PATH']; ?>/Layout/Templates/StructureStartModule.tpl<?php
				$include = eval('return \'' . str_replace('\'', '\\\'', ob_get_clean()) .'\';');
				if($this->getForceCompile() || !file_exists($this->getCompileDirectory() .'/' . $this->getCompileName($include, '/home/segaz/domains/techno-mir.net/public_html/src/Backend/Modules/Slideshow/Layout/Templates'))) $this->compile('/home/segaz/domains/techno-mir.net/public_html/src/Backend/Modules/Slideshow/Layout/Templates', $include);
				$return = @include $this->getCompileDirectory() .'/' . $this->getCompileName($include, '/home/segaz/domains/techno-mir.net/public_html/src/Backend/Modules/Slideshow/Layout/Templates');
				if($return === false && $this->compile('/home/segaz/domains/techno-mir.net/public_html/src/Backend/Modules/Slideshow/Layout/Templates', $include))
				{
					$return = @include $this->getCompileDirectory() .'/' . $this->getCompileName($include, '/home/segaz/domains/techno-mir.net/public_html/src/Backend/Modules/Slideshow/Layout/Templates');
				}
?>

<div class="pageTitle">
    <h2><?php echo SpoonFilter::ucfirst($this->variables['lblGallery']); ?>: <?php echo $this->variables['lblAdd']; ?></h2>
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
    <?php
					if(isset($this->variables['categories']) && count($this->variables['categories']) != 0 && $this->variables['categories'] != '' && $this->variables['categories'] !== false)
					{
						?>
    <p>
        <label for="title"><?php echo SpoonFilter::ucfirst($this->variables['lblTitle']); ?><abbr title="<?php echo $this->variables['lblRequiredField']; ?>">*</abbr></label>
        <?php echo $this->variables['txtTitle']; ?> <?php echo $this->variables['txtTitleError']; ?>
    </p>

    <div id="pageUrl">
        <div class="oneLiner">
            <?php
					if(isset($this->variables['detailURL']) && count($this->variables['detailURL']) != 0 && $this->variables['detailURL'] != '' && $this->variables['detailURL'] !== false)
					{
						?><p><span><a href="<?php echo $this->variables['detailURL']; ?>"><?php echo $this->variables['detailURL']; ?>/<span id="generatedUrl"></span></a></span></p><?php } ?>
            <?php if(!isset($this->variables['detailURL']) || count($this->variables['detailURL']) == 0 || $this->variables['detailURL'] == '' || $this->variables['detailURL'] === false): ?><p class="infoMessage"><?php echo $this->variables['errNoModuleLinked']; ?></p><?php endif; ?>
        </div>
    </div>

    <div class="tabs">
        <ul>
            <li><a href="#tabContent"><?php echo SpoonFilter::ucfirst($this->variables['lblContent']); ?></a></li>
            <li><a href="#tabSEO"><?php echo SpoonFilter::ucfirst($this->variables['lblSEO']); ?></a></li>
        </ul>

        <div class="ui-tabs">
            <div class="ui-tabs-panel">

                <div id="tabContent">
                    <div class="options">
                        <table border="0" cellspacing="0" cellpadding="0" width="100%">
                            <tr>
                                <td id="leftColumn">
                                    <div class="box">
                                        <div class="heading">
                                            <h3>
                                                <label for="text"><?php echo SpoonFilter::ucfirst($this->variables['lblDescription']); ?><abbr title="<?php echo $this->variables['lblRequiredField']; ?>">*</abbr></label>
                                            </h3>
                                        </div>
                                        <div class="optionsRTE">
                                            <?php echo $this->variables['txtDescription']; ?> <?php echo $this->variables['txtDescriptionError']; ?>
                                        </div>
                                    </div>
                                    <p>
                                    <?php
					if(isset($this->variables['item']['filename']) && count($this->variables['item']['filename']) != 0 && $this->variables['item']['filename'] != '' && $this->variables['item']['filename'] !== false)
					{
						?>
                                    <p>
                                        <img src="<?php echo $this->variables['FRONTEND_FILES_URL']; ?>/userfiles/images/slideshow/thumbnails/<?php echo $this->variables['item']['filename']; ?>" width="200" alt="" />
                                    </p>
                                    <p>
                                        <label for="deleteImage"><?php echo $this->variables['chkDeleteImage']; ?> <?php echo SpoonFilter::ucfirst($this->variables['lblDelete']); ?></label>
                                        <?php echo $this->variables['chkDeleteImageError']; ?>
                                    </p>
                                    <?php } ?>
                                    <label for="filename"><?php echo SpoonFilter::ucfirst($this->variables['lblImage']); ?></label>
                                    <?php echo $this->variables['fileFilename']; ?> <?php echo $this->variables['fileFilenameError']; ?>
                                    </p>
                                </td>

                                <td id="sidebar">

                                    <div id="slideshowCategory" class="box">
                                        <div class="heading">
                                            <h3><?php echo SpoonFilter::ucfirst($this->variables['lblCategory']); ?><abbr title="<?php echo $this->variables['lblRequiredField']; ?>">*</abbr></h3>
                                        </div>

                                        <div class="options">
                                            <p>
                                                <?php echo $this->variables['ddmCategories']; ?> <?php echo $this->variables['ddmCategoriesError']; ?>
                                            </p>
                                        </div>
                                    </div>

                                    <div id="publishOptions" class="box">
                                        <div class="heading">
                                            <h3><?php echo SpoonFilter::ucfirst($this->variables['lblStatus']); ?></h3>
                                        </div>

                                        <div class="options">
                                            <ul class="inputList">
                                                <?php
				if(isset(${'hidden'})) $this->iterations['f6dc5f55bd0b29f88e77f3589212e033_Add.tpl.php_1']['old'] = ${'hidden'};
				$this->iterations['f6dc5f55bd0b29f88e77f3589212e033_Add.tpl.php_1']['iteration'] = $this->variables['hidden'];
				$this->iterations['f6dc5f55bd0b29f88e77f3589212e033_Add.tpl.php_1']['i'] = 1;
				$this->iterations['f6dc5f55bd0b29f88e77f3589212e033_Add.tpl.php_1']['count'] = count($this->iterations['f6dc5f55bd0b29f88e77f3589212e033_Add.tpl.php_1']['iteration']);
				foreach((array) $this->iterations['f6dc5f55bd0b29f88e77f3589212e033_Add.tpl.php_1']['iteration'] as ${'hidden'})
				{
					if(!isset(${'hidden'}['first']) && $this->iterations['f6dc5f55bd0b29f88e77f3589212e033_Add.tpl.php_1']['i'] == 1) ${'hidden'}['first'] = true;
					if(!isset(${'hidden'}['last']) && $this->iterations['f6dc5f55bd0b29f88e77f3589212e033_Add.tpl.php_1']['i'] == $this->iterations['f6dc5f55bd0b29f88e77f3589212e033_Add.tpl.php_1']['count']) ${'hidden'}['last'] = true;
					if(isset(${'hidden'}['formElements']) && is_array(${'hidden'}['formElements']))
					{
						foreach(${'hidden'}['formElements'] as $name => $object)
						{
							${'hidden'}[$name] = $object->parse();
							${'hidden'}[$name .'Error'] = (is_callable(array($object, 'getErrors')) && $object->getErrors() != '') ? '<span class="formError">' . $object->getErrors() .'</span>' : '';
						}
					} ?>
                                                <li>
                                                    <?php echo ${'hidden'}['rbtHidden']; ?>
                                                    <label for="<?php echo ${'hidden'}['id']; ?>"><?php echo ${'hidden'}['label']; ?></label>
                                                </li>
                                                <?php
					$this->iterations['f6dc5f55bd0b29f88e77f3589212e033_Add.tpl.php_1']['i']++;
				}
				if(isset($this->iterations['f6dc5f55bd0b29f88e77f3589212e033_Add.tpl.php_1']['old'])) ${'hidden'} = $this->iterations['f6dc5f55bd0b29f88e77f3589212e033_Add.tpl.php_1']['old'];
				else unset($this->iterations['f6dc5f55bd0b29f88e77f3589212e033_Add.tpl.php_1']);
				?>
                                            </ul>
                                        </div>

                                        <div class="options">
                                            <p class="p0"><label for="publishOnDate"><?php echo SpoonFilter::ucfirst($this->variables['lblPublishOn']); ?></label></p>
                                            <div class="oneLiner">
                                                <p>
                                                    <?php echo $this->variables['txtPublishOnDate']; ?> <?php echo $this->variables['txtPublishOnDateError']; ?>
                                                </p>
                                                <p>
                                                    <label for="publishOnTime"><?php echo $this->variables['lblAt']; ?></label>
                                                </p>
                                                <p>
                                                    <?php echo $this->variables['txtPublishOnTime']; ?> <?php echo $this->variables['txtPublishOnTimeError']; ?>
                                                </p>
                                            </div>
                                        </div>
                                    </div>

                                    <div id="publishOptions" class="box">
                                        <div class="heading">
                                            <h3><?php echo SpoonFilter::ucfirst($this->variables['lblDimensions']); ?></h3>
                                        </div>
                                        <div class="options">
                                            <?php echo SpoonFilter::ucfirst($this->variables['lblWidth']); ?><abbr title="<?php echo $this->variables['lblRequiredField']; ?>">*</abbr>
                                            <p>
                                            <?php echo $this->variables['txtWidth']; ?> <?php echo $this->variables['txtWidthError']; ?>
                                            </p>
                                            <?php echo SpoonFilter::ucfirst($this->variables['lblHeight']); ?>
                                            <p>
                                            <?php echo $this->variables['txtHeight']; ?> <?php echo $this->variables['txtHeightError']; ?>
                                            </p>
                                        </div>
                                    </div>

                                </td>
                            </tr>
                        </table>
                    </div>
                </div>
            </div>

        <div id="tabSEO">
            <?php
				ob_start();
				?><?php echo $this->variables['BACKEND_CORE_PATH']; ?>/layout/templates/seo.tpl<?php
				$include = eval('return \'' . str_replace('\'', '\\\'', ob_get_clean()) .'\';');
				if($this->getForceCompile() || !file_exists($this->getCompileDirectory() .'/' . $this->getCompileName($include, '/home/segaz/domains/techno-mir.net/public_html/src/Backend/Modules/Slideshow/Layout/Templates'))) $this->compile('/home/segaz/domains/techno-mir.net/public_html/src/Backend/Modules/Slideshow/Layout/Templates', $include);
				$return = @include $this->getCompileDirectory() .'/' . $this->getCompileName($include, '/home/segaz/domains/techno-mir.net/public_html/src/Backend/Modules/Slideshow/Layout/Templates');
				if($return === false && $this->compile('/home/segaz/domains/techno-mir.net/public_html/src/Backend/Modules/Slideshow/Layout/Templates', $include))
				{
					$return = @include $this->getCompileDirectory() .'/' . $this->getCompileName($include, '/home/segaz/domains/techno-mir.net/public_html/src/Backend/Modules/Slideshow/Layout/Templates');
				}
?>
        </div>

        </div>
        <div class="fullwidthOptions">
            <div class="buttonHolderRight">
                <input id="addButton" class="inputButton button mainButton" type="submit" name="add" value="<?php echo SpoonFilter::ucfirst($this->variables['lblPublish']); ?>" />
            </div>
        </div>
    <?php } ?>

</form>
				<?php } ?>

<?php
				ob_start();
				?><?php echo $this->variables['BACKEND_CORE_PATH']; ?>/Layout/Templates/StructureEndModule.tpl<?php
				$include = eval('return \'' . str_replace('\'', '\\\'', ob_get_clean()) .'\';');
				if($this->getForceCompile() || !file_exists($this->getCompileDirectory() .'/' . $this->getCompileName($include, '/home/segaz/domains/techno-mir.net/public_html/src/Backend/Modules/Slideshow/Layout/Templates'))) $this->compile('/home/segaz/domains/techno-mir.net/public_html/src/Backend/Modules/Slideshow/Layout/Templates', $include);
				$return = @include $this->getCompileDirectory() .'/' . $this->getCompileName($include, '/home/segaz/domains/techno-mir.net/public_html/src/Backend/Modules/Slideshow/Layout/Templates');
				if($return === false && $this->compile('/home/segaz/domains/techno-mir.net/public_html/src/Backend/Modules/Slideshow/Layout/Templates', $include))
				{
					$return = @include $this->getCompileDirectory() .'/' . $this->getCompileName($include, '/home/segaz/domains/techno-mir.net/public_html/src/Backend/Modules/Slideshow/Layout/Templates');
				}
?>
<?php
				ob_start();
				?><?php echo $this->variables['BACKEND_CORE_PATH']; ?>/Layout/Templates/Footer.tpl<?php
				$include = eval('return \'' . str_replace('\'', '\\\'', ob_get_clean()) .'\';');
				if($this->getForceCompile() || !file_exists($this->getCompileDirectory() .'/' . $this->getCompileName($include, '/home/segaz/domains/techno-mir.net/public_html/src/Backend/Modules/Slideshow/Layout/Templates'))) $this->compile('/home/segaz/domains/techno-mir.net/public_html/src/Backend/Modules/Slideshow/Layout/Templates', $include);
				$return = @include $this->getCompileDirectory() .'/' . $this->getCompileName($include, '/home/segaz/domains/techno-mir.net/public_html/src/Backend/Modules/Slideshow/Layout/Templates');
				if($return === false && $this->compile('/home/segaz/domains/techno-mir.net/public_html/src/Backend/Modules/Slideshow/Layout/Templates', $include))
				{
					$return = @include $this->getCompileDirectory() .'/' . $this->getCompileName($include, '/home/segaz/domains/techno-mir.net/public_html/src/Backend/Modules/Slideshow/Layout/Templates');
				}
?>
