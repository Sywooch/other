<?php error_reporting(E_ALL | E_STRICT); ini_set('display_errors', 'On'); ?>
<?php
				ob_start();
				?><?php if(array_key_exists('BACKEND_CORE_PATH', (array) $this->variables)) { echo $this->variables['BACKEND_CORE_PATH']; } else { ?>{$BACKEND_CORE_PATH}<?php } ?>/Layout/Templates/Head.tpl<?php
				$include = eval('return \'' . str_replace('\'', '\\\'', ob_get_clean()) .'\';');
				if($this->getForceCompile() || !file_exists($this->getCompileDirectory() .'/' . $this->getCompileName($include, '/home/segaz/domains/techno-mir.net/public_html/src/Backend/Modules/Blog/Layout/Templates'))) $this->compile('/home/segaz/domains/techno-mir.net/public_html/src/Backend/Modules/Blog/Layout/Templates', $include);
				$return = @include $this->getCompileDirectory() .'/' . $this->getCompileName($include, '/home/segaz/domains/techno-mir.net/public_html/src/Backend/Modules/Blog/Layout/Templates');
				if($return === false && $this->compile('/home/segaz/domains/techno-mir.net/public_html/src/Backend/Modules/Blog/Layout/Templates', $include))
				{
					$return = @include $this->getCompileDirectory() .'/' . $this->getCompileName($include, '/home/segaz/domains/techno-mir.net/public_html/src/Backend/Modules/Blog/Layout/Templates');
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
				if($this->getForceCompile() || !file_exists($this->getCompileDirectory() .'/' . $this->getCompileName($include, '/home/segaz/domains/techno-mir.net/public_html/src/Backend/Modules/Blog/Layout/Templates'))) $this->compile('/home/segaz/domains/techno-mir.net/public_html/src/Backend/Modules/Blog/Layout/Templates', $include);
				$return = @include $this->getCompileDirectory() .'/' . $this->getCompileName($include, '/home/segaz/domains/techno-mir.net/public_html/src/Backend/Modules/Blog/Layout/Templates');
				if($return === false && $this->compile('/home/segaz/domains/techno-mir.net/public_html/src/Backend/Modules/Blog/Layout/Templates', $include))
				{
					$return = @include $this->getCompileDirectory() .'/' . $this->getCompileName($include, '/home/segaz/domains/techno-mir.net/public_html/src/Backend/Modules/Blog/Layout/Templates');
				}
if($return === false)
				{
					?>{include:<?php if(array_key_exists('BACKEND_CORE_PATH', (array) $this->variables)) { echo $this->variables['BACKEND_CORE_PATH']; } else { ?>{$BACKEND_CORE_PATH}<?php } ?>/Layout/Templates/StructureStartModule.tpl}<?php
				}
?>

<div class="pageTitle">
	<h2><?php if(array_key_exists('lblBlog', (array) $this->variables)) { echo SpoonFilter::ucfirst($this->variables['lblBlog']); } else { ?>{$lblBlog|ucfirst}<?php } ?>: <?php if(array_key_exists('lblComments', (array) $this->variables)) { echo $this->variables['lblComments']; } else { ?>{$lblComments}<?php } ?></h2>
</div>

<div id="tabs" class="tabs">
	<ul>
		<li><a href="#tabPublished"><?php if(array_key_exists('lblPublished', (array) $this->variables)) { echo SpoonFilter::ucfirst($this->variables['lblPublished']); } else { ?>{$lblPublished|ucfirst}<?php } ?> (<?php if(array_key_exists('numPublished', (array) $this->variables)) { echo $this->variables['numPublished']; } else { ?>{$numPublished}<?php } ?>)</a></li>
		<li><a href="#tabModeration"><?php if(array_key_exists('lblWaitingForModeration', (array) $this->variables)) { echo SpoonFilter::ucfirst($this->variables['lblWaitingForModeration']); } else { ?>{$lblWaitingForModeration|ucfirst}<?php } ?> (<?php if(array_key_exists('numModeration', (array) $this->variables)) { echo $this->variables['numModeration']; } else { ?>{$numModeration}<?php } ?>)</a></li>
		<li><a href="#tabSpam"><?php if(array_key_exists('lblSpam', (array) $this->variables)) { echo SpoonFilter::ucfirst($this->variables['lblSpam']); } else { ?>{$lblSpam|ucfirst}<?php } ?> (<?php if(array_key_exists('numSpam', (array) $this->variables)) { echo $this->variables['numSpam']; } else { ?>{$numSpam}<?php } ?>)</a></li>
	</ul>

	<div id="tabPublished">
		<?php
					if(isset($this->variables['dgPublished']) && count($this->variables['dgPublished']) != 0 && $this->variables['dgPublished'] != '' && $this->variables['dgPublished'] !== false)
					{
						?>
			<form action="<?php if(array_key_exists('var', (array) $this->variables)) { echo Backend\Core\Engine\TemplateModifiers::getURL($this->variables['var'], 'mass_comment_action'); } else { ?>{$var|geturl:'mass_comment_action'}<?php } ?>" method="get" class="forkForms" id="commentsPublished">
				<div class="dataGridHolder">
					<input type="hidden" name="from" value="published" />
					<?php if(array_key_exists('dgPublished', (array) $this->variables)) { echo $this->variables['dgPublished']; } else { ?>{$dgPublished}<?php } ?>
				</div>
			</form>
		<?php } ?>
		<?php if(!isset($this->variables['dgPublished']) || count($this->variables['dgPublished']) == 0 || $this->variables['dgPublished'] == '' || $this->variables['dgPublished'] === false): ?><?php if(array_key_exists('msgNoComments', (array) $this->variables)) { echo $this->variables['msgNoComments']; } else { ?>{$msgNoComments}<?php } ?><?php endif; ?>
	</div>

	<div id="tabModeration">
		<?php
					if(isset($this->variables['dgModeration']) && count($this->variables['dgModeration']) != 0 && $this->variables['dgModeration'] != '' && $this->variables['dgModeration'] !== false)
					{
						?>
			<form action="<?php if(array_key_exists('var', (array) $this->variables)) { echo Backend\Core\Engine\TemplateModifiers::getURL($this->variables['var'], 'mass_comment_action'); } else { ?>{$var|geturl:'mass_comment_action'}<?php } ?>" method="get" class="forkForms" id="commentsModeration">
				<div class="dataGridHolder">
					<input type="hidden" name="from" value="moderation" />
					<?php if(array_key_exists('dgModeration', (array) $this->variables)) { echo $this->variables['dgModeration']; } else { ?>{$dgModeration}<?php } ?>
				</div>
			</form>
		<?php } ?>
		<?php if(!isset($this->variables['dgModeration']) || count($this->variables['dgModeration']) == 0 || $this->variables['dgModeration'] == '' || $this->variables['dgModeration'] === false): ?><?php if(array_key_exists('msgNoComments', (array) $this->variables)) { echo $this->variables['msgNoComments']; } else { ?>{$msgNoComments}<?php } ?><?php endif; ?>
	</div>

	<div id="tabSpam">
		<?php
					if(isset($this->variables['dgSpam']) && count($this->variables['dgSpam']) != 0 && $this->variables['dgSpam'] != '' && $this->variables['dgSpam'] !== false)
					{
						?>
			<form action="<?php if(array_key_exists('var', (array) $this->variables)) { echo Backend\Core\Engine\TemplateModifiers::getURL($this->variables['var'], 'mass_comment_action'); } else { ?>{$var|geturl:'mass_comment_action'}<?php } ?>" method="get" class="forkForms" id="commentsSpam">
				<div class="dataGridHolder">
					<input type="hidden" name="from" value="spam" />
					<div class="generalMessage infoMessage">
						<?php if(array_key_exists('msgDeleteAllSpam', (array) $this->variables)) { echo $this->variables['msgDeleteAllSpam']; } else { ?>{$msgDeleteAllSpam}<?php } ?>
						<a href="<?php if(array_key_exists('var', (array) $this->variables)) { echo Backend\Core\Engine\TemplateModifiers::getURL($this->variables['var'], 'delete_spam'); } else { ?>{$var|geturl:'delete_spam'}<?php } ?>"><?php if(array_key_exists('lblDelete', (array) $this->variables)) { echo SpoonFilter::ucfirst($this->variables['lblDelete']); } else { ?>{$lblDelete|ucfirst}<?php } ?></a>
					</div>
					<?php if(array_key_exists('dgSpam', (array) $this->variables)) { echo $this->variables['dgSpam']; } else { ?>{$dgSpam}<?php } ?>
				</div>
			</form>
		<?php } ?>
		<?php if(!isset($this->variables['dgSpam']) || count($this->variables['dgSpam']) == 0 || $this->variables['dgSpam'] == '' || $this->variables['dgSpam'] === false): ?><?php if(array_key_exists('msgNoComments', (array) $this->variables)) { echo $this->variables['msgNoComments']; } else { ?>{$msgNoComments}<?php } ?><?php endif; ?>
	</div>
</div>

<div id="confirmDeletePublished" title="<?php if(array_key_exists('lblDelete', (array) $this->variables)) { echo SpoonFilter::ucfirst($this->variables['lblDelete']); } else { ?>{$lblDelete|ucfirst}<?php } ?>?" style="display: none;">
	<p><?php if(array_key_exists('msgConfirmMassDelete', (array) $this->variables)) { echo $this->variables['msgConfirmMassDelete']; } else { ?>{$msgConfirmMassDelete}<?php } ?></p>
</div>
<div id="confirmSpamPublished" title="<?php if(array_key_exists('lblSpam', (array) $this->variables)) { echo SpoonFilter::ucfirst($this->variables['lblSpam']); } else { ?>{$lblSpam|ucfirst}<?php } ?>?" style="display: none;">
	<p><?php if(array_key_exists('msgConfirmMassSpam', (array) $this->variables)) { echo $this->variables['msgConfirmMassSpam']; } else { ?>{$msgConfirmMassSpam}<?php } ?></p>
</div>
<div id="confirmDeleteModeration" title="<?php if(array_key_exists('lblDelete', (array) $this->variables)) { echo SpoonFilter::ucfirst($this->variables['lblDelete']); } else { ?>{$lblDelete|ucfirst}<?php } ?>?" style="display: none;">
	<p><?php if(array_key_exists('msgConfirmMassDelete', (array) $this->variables)) { echo $this->variables['msgConfirmMassDelete']; } else { ?>{$msgConfirmMassDelete}<?php } ?></p>
</div>
<div id="confirmSpamModeration" title="<?php if(array_key_exists('lblSpam', (array) $this->variables)) { echo SpoonFilter::ucfirst($this->variables['lblSpam']); } else { ?>{$lblSpam|ucfirst}<?php } ?>?" style="display: none;">
	<p><?php if(array_key_exists('msgConfirmMassSpam', (array) $this->variables)) { echo $this->variables['msgConfirmMassSpam']; } else { ?>{$msgConfirmMassSpam}<?php } ?></p>
</div>
<div id="confirmDeleteSpam" title="<?php if(array_key_exists('lblDelete', (array) $this->variables)) { echo SpoonFilter::ucfirst($this->variables['lblDelete']); } else { ?>{$lblDelete|ucfirst}<?php } ?>?" style="display: none;">
	<p><?php if(array_key_exists('msgConfirmMassDelete', (array) $this->variables)) { echo $this->variables['msgConfirmMassDelete']; } else { ?>{$msgConfirmMassDelete}<?php } ?></p>
</div>

<?php
				ob_start();
				?><?php if(array_key_exists('BACKEND_CORE_PATH', (array) $this->variables)) { echo $this->variables['BACKEND_CORE_PATH']; } else { ?>{$BACKEND_CORE_PATH}<?php } ?>/Layout/Templates/StructureEndModule.tpl<?php
				$include = eval('return \'' . str_replace('\'', '\\\'', ob_get_clean()) .'\';');
				if($this->getForceCompile() || !file_exists($this->getCompileDirectory() .'/' . $this->getCompileName($include, '/home/segaz/domains/techno-mir.net/public_html/src/Backend/Modules/Blog/Layout/Templates'))) $this->compile('/home/segaz/domains/techno-mir.net/public_html/src/Backend/Modules/Blog/Layout/Templates', $include);
				$return = @include $this->getCompileDirectory() .'/' . $this->getCompileName($include, '/home/segaz/domains/techno-mir.net/public_html/src/Backend/Modules/Blog/Layout/Templates');
				if($return === false && $this->compile('/home/segaz/domains/techno-mir.net/public_html/src/Backend/Modules/Blog/Layout/Templates', $include))
				{
					$return = @include $this->getCompileDirectory() .'/' . $this->getCompileName($include, '/home/segaz/domains/techno-mir.net/public_html/src/Backend/Modules/Blog/Layout/Templates');
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
				if($this->getForceCompile() || !file_exists($this->getCompileDirectory() .'/' . $this->getCompileName($include, '/home/segaz/domains/techno-mir.net/public_html/src/Backend/Modules/Blog/Layout/Templates'))) $this->compile('/home/segaz/domains/techno-mir.net/public_html/src/Backend/Modules/Blog/Layout/Templates', $include);
				$return = @include $this->getCompileDirectory() .'/' . $this->getCompileName($include, '/home/segaz/domains/techno-mir.net/public_html/src/Backend/Modules/Blog/Layout/Templates');
				if($return === false && $this->compile('/home/segaz/domains/techno-mir.net/public_html/src/Backend/Modules/Blog/Layout/Templates', $include))
				{
					$return = @include $this->getCompileDirectory() .'/' . $this->getCompileName($include, '/home/segaz/domains/techno-mir.net/public_html/src/Backend/Modules/Blog/Layout/Templates');
				}
if($return === false)
				{
					?>{include:<?php if(array_key_exists('BACKEND_CORE_PATH', (array) $this->variables)) { echo $this->variables['BACKEND_CORE_PATH']; } else { ?>{$BACKEND_CORE_PATH}<?php } ?>/Layout/Templates/Footer.tpl}<?php
				}
?>
