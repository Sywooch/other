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
    <h2><?php if(array_key_exists('lblGallery', (array) $this->variables)) { echo SpoonFilter::ucfirst($this->variables['lblGallery']); } else { ?>{$lblGallery|ucfirst}<?php } ?>: <?php if(isset($this->variables['item']) && array_key_exists('title', (array) $this->variables['item'])) { echo $this->variables['item']['title']; } else { ?>{$item.title}<?php } ?></h2>
    <div class="buttonHolderRight">
        <a href="<?php if(array_key_exists('var', (array) $this->variables)) { echo Backend\Core\Engine\TemplateModifiers::getURL($this->variables['var'], 'add_image'); } else { ?>{$var|geturl:'add_image'}<?php } ?>&amp;id=<?php if(isset($this->variables['item']) && array_key_exists('id', (array) $this->variables['item'])) { echo $this->variables['item']['id']; } else { ?>{$item.id}<?php } ?>" class="button icon iconAdd" title="<?php if(array_key_exists('lblAddImages', (array) $this->variables)) { echo SpoonFilter::ucfirst($this->variables['lblAddImages']); } else { ?>{$lblAddImages|ucfirst}<?php } ?>">
            <span><?php if(array_key_exists('lblAddImages', (array) $this->variables)) { echo SpoonFilter::ucfirst($this->variables['lblAddImages']); } else { ?>{$lblAddImages|ucfirst}<?php } ?></span>
        </a>
    </div>
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
    <?php
					if(isset($this->variables['categories']) && count($this->variables['categories']) != 0 && $this->variables['categories'] != '' && $this->variables['categories'] !== false)
					{
						?>
    <p>
        <label for="title"><?php if(array_key_exists('lblTitle', (array) $this->variables)) { echo SpoonFilter::ucfirst($this->variables['lblTitle']); } else { ?>{$lblTitle|ucfirst}<?php } ?><abbr title="<?php if(array_key_exists('lblRequiredField', (array) $this->variables)) { echo $this->variables['lblRequiredField']; } else { ?>{$lblRequiredField}<?php } ?>">*</abbr></label>
        <?php if(array_key_exists('txtTitle', (array) $this->variables)) { echo $this->variables['txtTitle']; } else { ?>{$txtTitle}<?php } ?> <?php if(array_key_exists('txtTitleError', (array) $this->variables)) { echo $this->variables['txtTitleError']; } else { ?>{$txtTitleError}<?php } ?>
    </p>

    <div id="pageUrl">
        <div class="oneLiner">
            <?php
					if(isset($this->variables['detailURL']) && count($this->variables['detailURL']) != 0 && $this->variables['detailURL'] != '' && $this->variables['detailURL'] !== false)
					{
						?><p><span><a href="<?php if(array_key_exists('detailURL', (array) $this->variables)) { echo $this->variables['detailURL']; } else { ?>{$detailURL}<?php } ?>"><?php if(array_key_exists('detailURL', (array) $this->variables)) { echo $this->variables['detailURL']; } else { ?>{$detailURL}<?php } ?>/<span id="generatedUrl"></span></a></span></p><?php } ?>
            <?php if(!isset($this->variables['detailURL']) || count($this->variables['detailURL']) == 0 || $this->variables['detailURL'] == '' || $this->variables['detailURL'] === false): ?><p class="infoMessage"><?php if(array_key_exists('errNoModuleLinked', (array) $this->variables)) { echo $this->variables['errNoModuleLinked']; } else { ?>{$errNoModuleLinked}<?php } ?></p><?php endif; ?>
        </div>
    </div>

    <div class="tabs">
        <ul>
            <li><a href="#tabContent"><?php if(array_key_exists('lblContent', (array) $this->variables)) { echo SpoonFilter::ucfirst($this->variables['lblContent']); } else { ?>{$lblContent|ucfirst}<?php } ?></a></li>
            <li><a href="#images"><?php if(array_key_exists('lblImages', (array) $this->variables)) { echo SpoonFilter::ucfirst($this->variables['lblImages']); } else { ?>{$lblImages|ucfirst}<?php } ?></a></li>
            <?php
					if(isset($this->variables['settingsPerSlideshow']) && count($this->variables['settingsPerSlideshow']) != 0 && $this->variables['settingsPerSlideshow'] != '' && $this->variables['settingsPerSlideshow'] !== false)
					{
						?>
            <li><a href="#settings"><?php if(array_key_exists('lblSettings', (array) $this->variables)) { echo SpoonFilter::ucfirst($this->variables['lblSettings']); } else { ?>{$lblSettings|ucfirst}<?php } ?></a></li>
            <?php } ?>
            <li><a href="#tabSEO"><?php if(array_key_exists('lblSEO', (array) $this->variables)) { echo SpoonFilter::ucfirst($this->variables['lblSEO']); } else { ?>{$lblSEO|ucfirst}<?php } ?></a></li>
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
                                    <h3><?php if(array_key_exists('lblDescription', (array) $this->variables)) { echo SpoonFilter::ucfirst($this->variables['lblDescription']); } else { ?>{$lblDescription|ucfirst}<?php } ?><abbr title="<?php if(array_key_exists('lblRequiredField', (array) $this->variables)) { echo $this->variables['lblRequiredField']; } else { ?>{$lblRequiredField}<?php } ?>">*</abbr></h3>
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
                                    <p>
                                        <img src="/src/Frontend/Files/userfiles/images/slideshow/thumbnails/<?php if(isset($this->variables['item']) && array_key_exists('filename', (array) $this->variables['item'])) { echo $this->variables['item']['filename']; } else { ?>{$item.filename}<?php } ?>" width="200" alt="" />
                                    </p>
                                    <p>
                                        <label for="deleteImage"><?php if(array_key_exists('chkDeleteImage', (array) $this->variables)) { echo $this->variables['chkDeleteImage']; } else { ?>{$chkDeleteImage}<?php } ?> <?php if(array_key_exists('lblDelete', (array) $this->variables)) { echo SpoonFilter::ucfirst($this->variables['lblDelete']); } else { ?>{$lblDelete|ucfirst}<?php } ?></label>
                                        <?php if(array_key_exists('chkDeleteImageError', (array) $this->variables)) { echo $this->variables['chkDeleteImageError']; } else { ?>{$chkDeleteImageError}<?php } ?>
                                    </p>
                                    <?php } ?>
                                    <label for="filename"><?php if(array_key_exists('lblImage', (array) $this->variables)) { echo SpoonFilter::ucfirst($this->variables['lblImage']); } else { ?>{$lblImage|ucfirst}<?php } ?></label>
                                    <?php if(array_key_exists('fileFilename', (array) $this->variables)) { echo $this->variables['fileFilename']; } else { ?>{$fileFilename}<?php } ?> <?php if(array_key_exists('fileFilenameError', (array) $this->variables)) { echo $this->variables['fileFilenameError']; } else { ?>{$fileFilenameError}<?php } ?>
                                </p>

                        </td>

                        <td id="sidebar">

                            <div id="slideshowCategory" class="box">
                                <div class="heading">
                                    <h3><?php if(array_key_exists('lblCategory', (array) $this->variables)) { echo SpoonFilter::ucfirst($this->variables['lblCategory']); } else { ?>{$lblCategory|ucfirst}<?php } ?><abbr title="<?php if(array_key_exists('lblRequiredField', (array) $this->variables)) { echo $this->variables['lblRequiredField']; } else { ?>{$lblRequiredField}<?php } ?>">*</abbr></h3>
                                </div>

                                <div class="options">
                                    <p>
                                        <?php if(array_key_exists('ddmCategories', (array) $this->variables)) { echo $this->variables['ddmCategories']; } else { ?>{$ddmCategories}<?php } ?> <?php if(array_key_exists('ddmCategoriesError', (array) $this->variables)) { echo $this->variables['ddmCategoriesError']; } else { ?>{$ddmCategoriesError}<?php } ?>
                                    </p>
                                </div>
                            </div>

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
						$this->iterations['4190bc663d53a71c0ae54eed39841637_Edit.tpl.php_1']['fail'] = true;
					}
				if(isset(${'hidden'})) $this->iterations['4190bc663d53a71c0ae54eed39841637_Edit.tpl.php_1']['old'] = ${'hidden'};
				$this->iterations['4190bc663d53a71c0ae54eed39841637_Edit.tpl.php_1']['iteration'] = $this->variables['hidden'];
				$this->iterations['4190bc663d53a71c0ae54eed39841637_Edit.tpl.php_1']['i'] = 1;
				$this->iterations['4190bc663d53a71c0ae54eed39841637_Edit.tpl.php_1']['count'] = count($this->iterations['4190bc663d53a71c0ae54eed39841637_Edit.tpl.php_1']['iteration']);
				foreach((array) $this->iterations['4190bc663d53a71c0ae54eed39841637_Edit.tpl.php_1']['iteration'] as ${'hidden'})
				{
					if(!isset(${'hidden'}['first']) && $this->iterations['4190bc663d53a71c0ae54eed39841637_Edit.tpl.php_1']['i'] == 1) ${'hidden'}['first'] = true;
					if(!isset(${'hidden'}['last']) && $this->iterations['4190bc663d53a71c0ae54eed39841637_Edit.tpl.php_1']['i'] == $this->iterations['4190bc663d53a71c0ae54eed39841637_Edit.tpl.php_1']['count']) ${'hidden'}['last'] = true;
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
					$this->iterations['4190bc663d53a71c0ae54eed39841637_Edit.tpl.php_1']['i']++;
				}
					if(isset($this->iterations['4190bc663d53a71c0ae54eed39841637_Edit.tpl.php_1']['fail']) && $this->iterations['4190bc663d53a71c0ae54eed39841637_Edit.tpl.php_1']['fail'] == true)
					{
						?>{/iteration:hidden}<?php
					}
				if(isset($this->iterations['4190bc663d53a71c0ae54eed39841637_Edit.tpl.php_1']['old'])) ${'hidden'} = $this->iterations['4190bc663d53a71c0ae54eed39841637_Edit.tpl.php_1']['old'];
				else unset($this->iterations['4190bc663d53a71c0ae54eed39841637_Edit.tpl.php_1']);
				?>
                                    </ul>
                                </div>

                                <div class="options">
                                    <p class="p0"><label for="publishOnDate"><?php if(array_key_exists('lblPublishOn', (array) $this->variables)) { echo SpoonFilter::ucfirst($this->variables['lblPublishOn']); } else { ?>{$lblPublishOn|ucfirst}<?php } ?></label></p>
                                    <div class="oneLiner">
                                    <p>
                                        <?php if(array_key_exists('txtPublishOnDate', (array) $this->variables)) { echo $this->variables['txtPublishOnDate']; } else { ?>{$txtPublishOnDate}<?php } ?> <?php if(array_key_exists('txtPublishOnDateError', (array) $this->variables)) { echo $this->variables['txtPublishOnDateError']; } else { ?>{$txtPublishOnDateError}<?php } ?>
                                    </p>
                                    <p>
                                        <label for="publishOnTime"><?php if(array_key_exists('lblAt', (array) $this->variables)) { echo $this->variables['lblAt']; } else { ?>{$lblAt}<?php } ?></label>
                                    </p>
                                    <p>
                                        <?php if(array_key_exists('txtPublishOnTime', (array) $this->variables)) { echo $this->variables['txtPublishOnTime']; } else { ?>{$txtPublishOnTime}<?php } ?> <?php if(array_key_exists('txtPublishOnTimeError', (array) $this->variables)) { echo $this->variables['txtPublishOnTimeError']; } else { ?>{$txtPublishOnTimeError}<?php } ?>
                                    </p>
                                    </div>
                                </div>
                            </div>

                                <div id="publishOptions" class="box">
                                    <div class="heading">
                                        <h3><?php if(array_key_exists('lblDimensions', (array) $this->variables)) { echo SpoonFilter::ucfirst($this->variables['lblDimensions']); } else { ?>{$lblDimensions|ucfirst}<?php } ?></h3>
                                    </div>
                                    <div class="options">
                                        <label for="width"><?php if(array_key_exists('lblWidth', (array) $this->variables)) { echo SpoonFilter::ucfirst($this->variables['lblWidth']); } else { ?>{$lblWidth|ucfirst}<?php } ?><abbr title="<?php if(array_key_exists('lblRequiredField', (array) $this->variables)) { echo $this->variables['lblRequiredField']; } else { ?>{$lblRequiredField}<?php } ?>">*</abbr></label>
                                        <p>
                                            <?php if(array_key_exists('txtWidth', (array) $this->variables)) { echo $this->variables['txtWidth']; } else { ?>{$txtWidth}<?php } ?> <?php if(array_key_exists('txtWidthError', (array) $this->variables)) { echo $this->variables['txtWidthError']; } else { ?>{$txtWidthError}<?php } ?>
                                        </p>
                                        <label for="height"><?php if(array_key_exists('lblHeight', (array) $this->variables)) { echo SpoonFilter::ucfirst($this->variables['lblHeight']); } else { ?>{$lblHeight|ucfirst}<?php } ?></label>
                                        <p>
                                            <?php if(array_key_exists('txtHeight', (array) $this->variables)) { echo $this->variables['txtHeight']; } else { ?>{$txtHeight}<?php } ?> <?php if(array_key_exists('txtHeightError', (array) $this->variables)) { echo $this->variables['txtHeightError']; } else { ?>{$txtHeightError}<?php } ?>
                                        </p>
                                    </div>
                                </div>
                        </td>
                    </tr>
                </table>
            </div>
        </div>

        <div id="images">
            <?php
					if(isset($this->variables['dataGrid']) && count($this->variables['dataGrid']) != 0 && $this->variables['dataGrid'] != '' && $this->variables['dataGrid'] !== false)
					{
						?>
            <div class="dataGridHolder">
            <?php if(array_key_exists('dataGrid', (array) $this->variables)) { echo $this->variables['dataGrid']; } else { ?>{$dataGrid}<?php } ?>
            </div>
            <?php } ?>

            <?php if(!isset($this->variables['dataGrid']) || count($this->variables['dataGrid']) == 0 || $this->variables['dataGrid'] == '' || $this->variables['dataGrid'] === false): ?>
                <p><?php if(array_key_exists('msgNoItems', (array) $this->variables)) { echo $this->variables['msgNoItems']; } else { ?>{$msgNoItems}<?php } ?></p>
            <?php endif; ?>
        </div>

<?php
					if(isset($this->variables['settingsPerSlideshow']) && count($this->variables['settingsPerSlideshow']) != 0 && $this->variables['settingsPerSlideshow'] != '' && $this->variables['settingsPerSlideshow'] !== false)
					{
						?>
<div id="settings">
    <div class="box horizontal">
        <div class="heading">
            <h3><?php if(array_key_exists('lblGeneralSlideshowSettings', (array) $this->variables)) { echo SpoonFilter::ucfirst($this->variables['lblGeneralSlideshowSettings']); } else { ?>{$lblGeneralSlideshowSettings|ucfirst}<?php } ?></h3>
        </div>
        <div class="options">
            <p>
                <label for="animation_type"><?php if(array_key_exists('lblAnimationType', (array) $this->variables)) { echo SpoonFilter::ucfirst($this->variables['lblAnimationType']); } else { ?>{$lblAnimationType|ucfirst}<?php } ?></label>
                <?php if(array_key_exists('ddmAnimationType', (array) $this->variables)) { echo $this->variables['ddmAnimationType']; } else { ?>{$ddmAnimationType}<?php } ?> <?php if(array_key_exists('ddmAnimationTypeError', (array) $this->variables)) { echo $this->variables['ddmAnimationTypeError']; } else { ?>{$ddmAnimationTypeError}<?php } ?>
            </p>
        </div>
        <div class="options">
            <p>
                <label for="slide_direction"><?php if(array_key_exists('lblSlideDirection', (array) $this->variables)) { echo SpoonFilter::ucfirst($this->variables['lblSlideDirection']); } else { ?>{$lblSlideDirection|ucfirst}<?php } ?></label>
                <?php if(array_key_exists('ddmSlideDirection', (array) $this->variables)) { echo $this->variables['ddmSlideDirection']; } else { ?>{$ddmSlideDirection}<?php } ?> <?php if(array_key_exists('ddmSlideDirectionError', (array) $this->variables)) { echo $this->variables['ddmSlideDirectionError']; } else { ?>{$ddmSlideDirectionError}<?php } ?>
            </p>
        </div>
        <div class="options">
            <p>
                <label for="slideshow_speed"><?php if(array_key_exists('lblSlideshowSpeed', (array) $this->variables)) { echo SpoonFilter::ucfirst($this->variables['lblSlideshowSpeed']); } else { ?>{$lblSlideshowSpeed|ucfirst}<?php } ?></label>
                <?php if(array_key_exists('ddmSlideshowSpeed', (array) $this->variables)) { echo $this->variables['ddmSlideshowSpeed']; } else { ?>{$ddmSlideshowSpeed}<?php } ?> <?php if(array_key_exists('ddmSlideshowSpeedError', (array) $this->variables)) { echo $this->variables['ddmSlideshowSpeedError']; } else { ?>{$ddmSlideshowSpeedError}<?php } ?>
                <span class="helpTxt">
                <?php if(array_key_exists('msgHelpSlideshowSpeed', (array) $this->variables)) { echo $this->variables['msgHelpSlideshowSpeed']; } else { ?>{$msgHelpSlideshowSpeed}<?php } ?>
                </span>
            </p>
        </div>
        <div class="options">
            <p>
                <label for="animation_duration"><?php if(array_key_exists('lblAnimationDuration', (array) $this->variables)) { echo SpoonFilter::ucfirst($this->variables['lblAnimationDuration']); } else { ?>{$lblAnimationDuration|ucfirst}<?php } ?></label>
                <?php if(array_key_exists('ddmAnimationDuration', (array) $this->variables)) { echo $this->variables['ddmAnimationDuration']; } else { ?>{$ddmAnimationDuration}<?php } ?> <?php if(array_key_exists('ddmAnimationDurationError', (array) $this->variables)) { echo $this->variables['ddmAnimationDurationError']; } else { ?>{$ddmAnimationDurationError}<?php } ?>
                <span class="helpTxt">
                <?php if(array_key_exists('msgHelpAnimationDuration', (array) $this->variables)) { echo $this->variables['msgHelpAnimationDuration']; } else { ?>{$msgHelpAnimationDuration}<?php } ?>
                </span>
            </p>
        </div>
    </div>

    <div class="box">
        <div class="heading">
            <h3><?php if(array_key_exists('lblNavigationSlideshowSettings', (array) $this->variables)) { echo SpoonFilter::ucfirst($this->variables['lblNavigationSlideshowSettings']); } else { ?>{$lblNavigationSlideshowSettings|ucfirst}<?php } ?></h3>
        </div>
        <div class="options">
            <ul class="inputList">
                <li><label for="direct_navigation"><?php if(array_key_exists('chkDirectNavigation', (array) $this->variables)) { echo $this->variables['chkDirectNavigation']; } else { ?>{$chkDirectNavigation}<?php } ?> <?php if(array_key_exists('lblDirectNavigation', (array) $this->variables)) { echo SpoonFilter::ucfirst($this->variables['lblDirectNavigation']); } else { ?>{$lblDirectNavigation|ucfirst}<?php } ?></label>
                    <span class="helpTxt">
                    <?php if(array_key_exists('msgHelpDirectNavigation', (array) $this->variables)) { echo $this->variables['msgHelpDirectNavigation']; } else { ?>{$msgHelpDirectNavigation}<?php } ?>
                    </span>
                </li>
                <li><label for="control_navigation"><?php if(array_key_exists('chkControlNavigation', (array) $this->variables)) { echo $this->variables['chkControlNavigation']; } else { ?>{$chkControlNavigation}<?php } ?> <?php if(array_key_exists('lblControlNavigation', (array) $this->variables)) { echo SpoonFilter::ucfirst($this->variables['lblControlNavigation']); } else { ?>{$lblControlNavigation|ucfirst}<?php } ?></label>
                    <span class="helpTxt">
                    <?php if(array_key_exists('msgHelpControlNavigation', (array) $this->variables)) { echo $this->variables['msgHelpControlNavigation']; } else { ?>{$msgHelpControlNavigation}<?php } ?>
                    </span>
                </li>
                <li><label for="keyboard_navigation"><?php if(array_key_exists('chkKeyboardNavigation', (array) $this->variables)) { echo $this->variables['chkKeyboardNavigation']; } else { ?>{$chkKeyboardNavigation}<?php } ?> <?php if(array_key_exists('lblKeyboardNavigation', (array) $this->variables)) { echo SpoonFilter::ucfirst($this->variables['lblKeyboardNavigation']); } else { ?>{$lblKeyboardNavigation|ucfirst}<?php } ?></label>
                    <span class="helpTxt">
                    <?php if(array_key_exists('msgHelpKeyboardNavigation', (array) $this->variables)) { echo $this->variables['msgHelpKeyboardNavigation']; } else { ?>{$msgHelpKeyboardNavigation}<?php } ?>
                    </span>
                </li>
                <li><label for="mousewheel_navigation"><?php if(array_key_exists('chkMousewheelNavigation', (array) $this->variables)) { echo $this->variables['chkMousewheelNavigation']; } else { ?>{$chkMousewheelNavigation}<?php } ?> <?php if(array_key_exists('lblMousewheelNavigation', (array) $this->variables)) { echo SpoonFilter::ucfirst($this->variables['lblMousewheelNavigation']); } else { ?>{$lblMousewheelNavigation|ucfirst}<?php } ?></label>
                    <span class="helpTxt">
                    <?php if(array_key_exists('msgHelpMousewheelNavigation', (array) $this->variables)) { echo $this->variables['msgHelpMousewheelNavigation']; } else { ?>{$msgHelpMousewheelNavigation}<?php } ?>
                    </span>
                </li>
            </ul>
        </div>
    </div>

    <div class="box">
        <div class="heading">
            <h3><?php if(array_key_exists('lblOptionalSlideshowSettings', (array) $this->variables)) { echo SpoonFilter::ucfirst($this->variables['lblOptionalSlideshowSettings']); } else { ?>{$lblOptionalSlideshowSettings|ucfirst}<?php } ?></h3>
        </div>
        <div class="options">
            <ul class="inputList">
                <li><label for="random_order"><?php if(array_key_exists('chkRandomOrder', (array) $this->variables)) { echo $this->variables['chkRandomOrder']; } else { ?>{$chkRandomOrder}<?php } ?> <?php if(array_key_exists('lblRandomOrder', (array) $this->variables)) { echo SpoonFilter::ucfirst($this->variables['lblRandomOrder']); } else { ?>{$lblRandomOrder|ucfirst}<?php } ?></label>
                    <span class="helpTxt">
                    <?php if(array_key_exists('msgHelpRandomOrder', (array) $this->variables)) { echo $this->variables['msgHelpRandomOrder']; } else { ?>{$msgHelpRandomOrder}<?php } ?>
                    </span>
                </li>
                <li><label for="auto_animate"><?php if(array_key_exists('chkAutoAnimate', (array) $this->variables)) { echo $this->variables['chkAutoAnimate']; } else { ?>{$chkAutoAnimate}<?php } ?> <?php if(array_key_exists('lblAutoAnimate', (array) $this->variables)) { echo SpoonFilter::ucfirst($this->variables['lblAutoAnimate']); } else { ?>{$lblAutoAnimate|ucfirst}<?php } ?></label>
                    <span class="helpTxt">
                    <?php if(array_key_exists('msgHelpAutoAnimate', (array) $this->variables)) { echo $this->variables['msgHelpAutoAnimate']; } else { ?>{$msgHelpAutoAnimate}<?php } ?>
                    </span>
                </li>
                <li><label for="animation_loop"><?php if(array_key_exists('chkAnimationLoop', (array) $this->variables)) { echo $this->variables['chkAnimationLoop']; } else { ?>{$chkAnimationLoop}<?php } ?> <?php if(array_key_exists('lblAnimationLoop', (array) $this->variables)) { echo SpoonFilter::ucfirst($this->variables['lblAnimationLoop']); } else { ?>{$lblAnimationLoop|ucfirst}<?php } ?></label>
                    <span class="helpTxt">
                    <?php if(array_key_exists('msgHelpAnimationLoop', (array) $this->variables)) { echo $this->variables['msgHelpAnimationLoop']; } else { ?>{$msgHelpAnimationLoop}<?php } ?>
                    </span>
                </li>
            </ul>
        </div>
    </div>
</div>
<?php } ?>

        <div id="tabSEO">
            <?php
				ob_start();
				?><?php if(array_key_exists('BACKEND_CORE_PATH', (array) $this->variables)) { echo $this->variables['BACKEND_CORE_PATH']; } else { ?>{$BACKEND_CORE_PATH}<?php } ?>/layout/templates/seo.tpl<?php
				$include = eval('return \'' . str_replace('\'', '\\\'', ob_get_clean()) .'\';');
				if($this->getForceCompile() || !file_exists($this->getCompileDirectory() .'/' . $this->getCompileName($include, '/home/segaz/domains/techno-mir.net/public_html/src/Backend/Modules/Slideshow/Layout/Templates'))) $this->compile('/home/segaz/domains/techno-mir.net/public_html/src/Backend/Modules/Slideshow/Layout/Templates', $include);
				$return = @include $this->getCompileDirectory() .'/' . $this->getCompileName($include, '/home/segaz/domains/techno-mir.net/public_html/src/Backend/Modules/Slideshow/Layout/Templates');
				if($return === false && $this->compile('/home/segaz/domains/techno-mir.net/public_html/src/Backend/Modules/Slideshow/Layout/Templates', $include))
				{
					$return = @include $this->getCompileDirectory() .'/' . $this->getCompileName($include, '/home/segaz/domains/techno-mir.net/public_html/src/Backend/Modules/Slideshow/Layout/Templates');
				}
if($return === false)
				{
					?>{include:<?php if(array_key_exists('BACKEND_CORE_PATH', (array) $this->variables)) { echo $this->variables['BACKEND_CORE_PATH']; } else { ?>{$BACKEND_CORE_PATH}<?php } ?>/layout/templates/seo.tpl}<?php
				}
?>
        </div>

        </div>
        <div class="fullwidthOptions">
            <a href="<?php if(array_key_exists('var', (array) $this->variables)) { echo Backend\Core\Engine\TemplateModifiers::getURL($this->variables['var'], 'delete'); } else { ?>{$var|geturl:'delete'}<?php } ?>&amp;id=<?php if(isset($this->variables['item']) && array_key_exists('id', (array) $this->variables['item'])) { echo $this->variables['item']['id']; } else { ?>{$item.id}<?php } ?>" data-message-id="confirmDelete" class="askConfirmation button linkButton icon iconDelete">
                <span><?php if(array_key_exists('lblDelete', (array) $this->variables)) { echo SpoonFilter::ucfirst($this->variables['lblDelete']); } else { ?>{$lblDelete|ucfirst}<?php } ?></span>
            </a>
            <div class="buttonHolderRight">
                <input id="editButton" class="inputButton button mainButton" type="submit" name="edit" value="<?php if(array_key_exists('lblPublish', (array) $this->variables)) { echo SpoonFilter::ucfirst($this->variables['lblPublish']); } else { ?>{$lblPublish|ucfirst}<?php } ?>" />
            </div>
        </div>

        <div id="confirmDelete" title="<?php if(array_key_exists('lblDelete', (array) $this->variables)) { echo SpoonFilter::ucfirst($this->variables['lblDelete']); } else { ?>{$lblDelete|ucfirst}<?php } ?>?" style="display: none;">
            <p>
                Verwijderen? <?php if(isset($this->variables['item']) && array_key_exists('title', (array) $this->variables['item'])) { echo $this->variables['item']['title']; } else { ?>{$item.title}<?php } ?>
            </p>
        </div>
    <?php } ?>

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
