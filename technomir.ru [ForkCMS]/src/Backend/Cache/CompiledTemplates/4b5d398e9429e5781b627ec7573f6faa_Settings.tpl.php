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
    <h2><?php if(array_key_exists('lblModuleSettings', (array) $this->variables)) { echo SpoonFilter::ucfirst($this->variables['lblModuleSettings']); } else { ?>{$lblModuleSettings|ucfirst}<?php } ?>: <?php if(array_key_exists('lblSlideshow', (array) $this->variables)) { echo $this->variables['lblSlideshow']; } else { ?>{$lblSlideshow}<?php } ?></h2>
</div>

<?php
					if(isset($this->forms['settings']))
					{
						?><form accept-charset="UTF-8" action="<?php echo $this->forms['settings']->getAction(); ?>" method="<?php echo $this->forms['settings']->getMethod(); ?>"<?php echo $this->forms['settings']->getParametersHTML(); ?>>
						<?php echo $this->forms['settings']->getField('form')->parse();
						if($this->forms['settings']->getUseToken())
						{
							?><input type="hidden" name="form_token" id="<?php echo $this->forms['settings']->getField('form_token')->getAttribute('id'); ?>" value="<?php echo htmlspecialchars($this->forms['settings']->getField('form_token')->getValue()); ?>" />
						<?php } ?>
<div class="box">
        <div class="heading">
            <h3><?php if(array_key_exists('lblModeSlideshowSettings', (array) $this->variables)) { echo SpoonFilter::ucfirst($this->variables['lblModeSlideshowSettings']); } else { ?>{$lblModeSlideshowSettings|ucfirst}<?php } ?></h3>
        </div>
        <div class="options">
            <ul class="inputList">
                <li><label for="direct_navigation"><?php if(array_key_exists('chkSettingsPerSlide', (array) $this->variables)) { echo $this->variables['chkSettingsPerSlide']; } else { ?>{$chkSettingsPerSlide}<?php } ?> <?php if(array_key_exists('lblSettingsPerSlide', (array) $this->variables)) { echo SpoonFilter::ucfirst($this->variables['lblSettingsPerSlide']); } else { ?>{$lblSettingsPerSlide|ucfirst}<?php } ?></label>
                    <span class="helpTxt">
                    <?php if(array_key_exists('msgHelpSettingsPerSlide', (array) $this->variables)) { echo $this->variables['msgHelpSettingsPerSlide']; } else { ?>{$msgHelpSettingsPerSlide}<?php } ?>
                    </span>
                </li>
            </ul>
        </div>
</div>

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

    <div class="fullwidthOptions">
        <div class="buttonHolderRight">
            <input id="save" class="inputButton button mainButton" type="submit" name="save" value="<?php if(array_key_exists('lblSave', (array) $this->variables)) { echo SpoonFilter::ucfirst($this->variables['lblSave']); } else { ?>{$lblSave|ucfirst}<?php } ?>" />
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
