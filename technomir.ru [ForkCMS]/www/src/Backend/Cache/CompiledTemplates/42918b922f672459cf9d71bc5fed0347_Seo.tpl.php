<?php error_reporting(E_ALL | E_STRICT); ini_set('display_errors', 'On'); ?>
<?php
				ob_start();
				?><?php if(array_key_exists('BACKEND_CORE_PATH', (array) $this->variables)) { echo $this->variables['BACKEND_CORE_PATH']; } else { ?>{$BACKEND_CORE_PATH}<?php } ?>/Layout/Templates/Head.tpl<?php
				$include = eval('return \'' . str_replace('\'', '\\\'', ob_get_clean()) .'\';');
				if($this->getForceCompile() || !file_exists($this->getCompileDirectory() .'/' . $this->getCompileName($include, '/home/segaz/domains/techno-mir.net/public_html/src/Backend/Modules/Settings/Layout/Templates'))) $this->compile('/home/segaz/domains/techno-mir.net/public_html/src/Backend/Modules/Settings/Layout/Templates', $include);
				$return = @include $this->getCompileDirectory() .'/' . $this->getCompileName($include, '/home/segaz/domains/techno-mir.net/public_html/src/Backend/Modules/Settings/Layout/Templates');
				if($return === false && $this->compile('/home/segaz/domains/techno-mir.net/public_html/src/Backend/Modules/Settings/Layout/Templates', $include))
				{
					$return = @include $this->getCompileDirectory() .'/' . $this->getCompileName($include, '/home/segaz/domains/techno-mir.net/public_html/src/Backend/Modules/Settings/Layout/Templates');
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
				if($this->getForceCompile() || !file_exists($this->getCompileDirectory() .'/' . $this->getCompileName($include, '/home/segaz/domains/techno-mir.net/public_html/src/Backend/Modules/Settings/Layout/Templates'))) $this->compile('/home/segaz/domains/techno-mir.net/public_html/src/Backend/Modules/Settings/Layout/Templates', $include);
				$return = @include $this->getCompileDirectory() .'/' . $this->getCompileName($include, '/home/segaz/domains/techno-mir.net/public_html/src/Backend/Modules/Settings/Layout/Templates');
				if($return === false && $this->compile('/home/segaz/domains/techno-mir.net/public_html/src/Backend/Modules/Settings/Layout/Templates', $include))
				{
					$return = @include $this->getCompileDirectory() .'/' . $this->getCompileName($include, '/home/segaz/domains/techno-mir.net/public_html/src/Backend/Modules/Settings/Layout/Templates');
				}
if($return === false)
				{
					?>{include:<?php if(array_key_exists('BACKEND_CORE_PATH', (array) $this->variables)) { echo $this->variables['BACKEND_CORE_PATH']; } else { ?>{$BACKEND_CORE_PATH}<?php } ?>/Layout/Templates/StructureStartModule.tpl}<?php
				}
?>

<div class="pageTitle">
	<h2><?php if(array_key_exists('lblSEOSettings', (array) $this->variables)) { echo SpoonFilter::ucfirst($this->variables['lblSEOSettings']); } else { ?>{$lblSEOSettings|ucfirst}<?php } ?></h2>
</div>

<?php
					if(isset($this->forms['settingsSeo']))
					{
						?><form accept-charset="UTF-8" action="<?php echo $this->forms['settingsSeo']->getAction(); ?>" method="<?php echo $this->forms['settingsSeo']->getMethod(); ?>"<?php echo $this->forms['settingsSeo']->getParametersHTML(); ?>>
						<?php echo $this->forms['settingsSeo']->getField('form')->parse();
						if($this->forms['settingsSeo']->getUseToken())
						{
							?><input type="hidden" name="form_token" id="<?php echo $this->forms['settingsSeo']->getField('form_token')->getAttribute('id'); ?>" value="<?php echo htmlspecialchars($this->forms['settingsSeo']->getField('form_token')->getValue()); ?>" />
						<?php } ?>
	<div class="box">
		<div class="heading">
			<h3><?php if(array_key_exists('lblSEO', (array) $this->variables)) { echo SpoonFilter::ucfirst($this->variables['lblSEO']); } else { ?>{$lblSEO|ucfirst}<?php } ?></h3>
		</div>
		<div class="options">
			<ul class="inputList">
				<li>
					<label for="seoNoodp"><?php if(array_key_exists('chkSeoNoodp', (array) $this->variables)) { echo $this->variables['chkSeoNoodp']; } else { ?>{$chkSeoNoodp}<?php } ?> NOODP</label>
					<span class="helpTxt"><?php if(array_key_exists('msgHelpSEONoodp', (array) $this->variables)) { echo $this->variables['msgHelpSEONoodp']; } else { ?>{$msgHelpSEONoodp}<?php } ?></span>
				</li>
				<li>
					<label for="seoNoydir"><?php if(array_key_exists('chkSeoNoydir', (array) $this->variables)) { echo $this->variables['chkSeoNoydir']; } else { ?>{$chkSeoNoydir}<?php } ?> NOYDIR</label>
					<span class="helpTxt"><?php if(array_key_exists('msgHelpSEONoydir', (array) $this->variables)) { echo $this->variables['msgHelpSEONoydir']; } else { ?>{$msgHelpSEONoydir}<?php } ?></span>
				</li>
				<li>
					<label for="seoNofollowInComments"><?php if(array_key_exists('chkSeoNofollowInComments', (array) $this->variables)) { echo $this->variables['chkSeoNofollowInComments']; } else { ?>{$chkSeoNofollowInComments}<?php } ?> <?php if(array_key_exists('msgSEONoFollowInComments', (array) $this->variables)) { echo $this->variables['msgSEONoFollowInComments']; } else { ?>{$msgSEONoFollowInComments}<?php } ?></label>
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
				if($this->getForceCompile() || !file_exists($this->getCompileDirectory() .'/' . $this->getCompileName($include, '/home/segaz/domains/techno-mir.net/public_html/src/Backend/Modules/Settings/Layout/Templates'))) $this->compile('/home/segaz/domains/techno-mir.net/public_html/src/Backend/Modules/Settings/Layout/Templates', $include);
				$return = @include $this->getCompileDirectory() .'/' . $this->getCompileName($include, '/home/segaz/domains/techno-mir.net/public_html/src/Backend/Modules/Settings/Layout/Templates');
				if($return === false && $this->compile('/home/segaz/domains/techno-mir.net/public_html/src/Backend/Modules/Settings/Layout/Templates', $include))
				{
					$return = @include $this->getCompileDirectory() .'/' . $this->getCompileName($include, '/home/segaz/domains/techno-mir.net/public_html/src/Backend/Modules/Settings/Layout/Templates');
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
				if($this->getForceCompile() || !file_exists($this->getCompileDirectory() .'/' . $this->getCompileName($include, '/home/segaz/domains/techno-mir.net/public_html/src/Backend/Modules/Settings/Layout/Templates'))) $this->compile('/home/segaz/domains/techno-mir.net/public_html/src/Backend/Modules/Settings/Layout/Templates', $include);
				$return = @include $this->getCompileDirectory() .'/' . $this->getCompileName($include, '/home/segaz/domains/techno-mir.net/public_html/src/Backend/Modules/Settings/Layout/Templates');
				if($return === false && $this->compile('/home/segaz/domains/techno-mir.net/public_html/src/Backend/Modules/Settings/Layout/Templates', $include))
				{
					$return = @include $this->getCompileDirectory() .'/' . $this->getCompileName($include, '/home/segaz/domains/techno-mir.net/public_html/src/Backend/Modules/Settings/Layout/Templates');
				}
if($return === false)
				{
					?>{include:<?php if(array_key_exists('BACKEND_CORE_PATH', (array) $this->variables)) { echo $this->variables['BACKEND_CORE_PATH']; } else { ?>{$BACKEND_CORE_PATH}<?php } ?>/Layout/Templates/Footer.tpl}<?php
				}
?>
