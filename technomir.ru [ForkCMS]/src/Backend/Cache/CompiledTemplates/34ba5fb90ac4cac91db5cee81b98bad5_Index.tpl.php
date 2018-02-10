<?php error_reporting(E_ALL | E_STRICT); ini_set('display_errors', 'On'); ?>
<?php
				ob_start();
				?><?php if(array_key_exists('BACKEND_CORE_PATH', (array) $this->variables)) { echo $this->variables['BACKEND_CORE_PATH']; } else { ?>{$BACKEND_CORE_PATH}<?php } ?>/Layout/Templates/Head.tpl<?php
				$include = eval('return \'' . str_replace('\'', '\\\'', ob_get_clean()) .'\';');
				if($this->getForceCompile() || !file_exists($this->getCompileDirectory() .'/' . $this->getCompileName($include, '/home/segaz/domains/techno-mir.net/public_html/src/Backend/Modules/Profiles/Layout/Templates'))) $this->compile('/home/segaz/domains/techno-mir.net/public_html/src/Backend/Modules/Profiles/Layout/Templates', $include);
				$return = @include $this->getCompileDirectory() .'/' . $this->getCompileName($include, '/home/segaz/domains/techno-mir.net/public_html/src/Backend/Modules/Profiles/Layout/Templates');
				if($return === false && $this->compile('/home/segaz/domains/techno-mir.net/public_html/src/Backend/Modules/Profiles/Layout/Templates', $include))
				{
					$return = @include $this->getCompileDirectory() .'/' . $this->getCompileName($include, '/home/segaz/domains/techno-mir.net/public_html/src/Backend/Modules/Profiles/Layout/Templates');
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
				if($this->getForceCompile() || !file_exists($this->getCompileDirectory() .'/' . $this->getCompileName($include, '/home/segaz/domains/techno-mir.net/public_html/src/Backend/Modules/Profiles/Layout/Templates'))) $this->compile('/home/segaz/domains/techno-mir.net/public_html/src/Backend/Modules/Profiles/Layout/Templates', $include);
				$return = @include $this->getCompileDirectory() .'/' . $this->getCompileName($include, '/home/segaz/domains/techno-mir.net/public_html/src/Backend/Modules/Profiles/Layout/Templates');
				if($return === false && $this->compile('/home/segaz/domains/techno-mir.net/public_html/src/Backend/Modules/Profiles/Layout/Templates', $include))
				{
					$return = @include $this->getCompileDirectory() .'/' . $this->getCompileName($include, '/home/segaz/domains/techno-mir.net/public_html/src/Backend/Modules/Profiles/Layout/Templates');
				}
if($return === false)
				{
					?>{include:<?php if(array_key_exists('BACKEND_CORE_PATH', (array) $this->variables)) { echo $this->variables['BACKEND_CORE_PATH']; } else { ?>{$BACKEND_CORE_PATH}<?php } ?>/Layout/Templates/StructureStartModule.tpl}<?php
				}
?>

<div class="pageTitle">
	<h2><?php if(array_key_exists('lblProfiles', (array) $this->variables)) { echo SpoonFilter::ucfirst($this->variables['lblProfiles']); } else { ?>{$lblProfiles|ucfirst}<?php } ?></h2>

	<div class="buttonHolderRight">
		<a href="<?php if(array_key_exists('var', (array) $this->variables)) { echo Backend\Core\Engine\TemplateModifiers::getURL($this->variables['var'], 'add'); } else { ?>{$var|geturl:'add'}<?php } ?>" class="button icon iconAdd" title="<?php if(array_key_exists('lblAdd', (array) $this->variables)) { echo SpoonFilter::ucfirst($this->variables['lblAdd']); } else { ?>{$lblAdd|ucfirst}<?php } ?>"><span><?php if(array_key_exists('lblAdd', (array) $this->variables)) { echo SpoonFilter::ucfirst($this->variables['lblAdd']); } else { ?>{$lblAdd|ucfirst}<?php } ?></span></a>
		<?php
					if(isset($this->variables['showProfilesImport']) && count($this->variables['showProfilesImport']) != 0 && $this->variables['showProfilesImport'] != '' && $this->variables['showProfilesImport'] !== false)
					{
						?>
		<a href="<?php if(array_key_exists('var', (array) $this->variables)) { echo Backend\Core\Engine\TemplateModifiers::getURL($this->variables['var'], 'import'); } else { ?>{$var|geturl:'import'}<?php } ?>" class="button icon iconImport" title="<?php if(array_key_exists('lblImport', (array) $this->variables)) { echo SpoonFilter::ucfirst($this->variables['lblImport']); } else { ?>{$lblImport|ucfirst}<?php } ?>"><span><?php if(array_key_exists('lblImport', (array) $this->variables)) { echo SpoonFilter::ucfirst($this->variables['lblImport']); } else { ?>{$lblImport|ucfirst}<?php } ?></span></a>
		<?php } ?>
	</div>
</div>

<div class="dataGridHolder">
	<?php
					if(isset($this->forms['filter']))
					{
						?><form accept-charset="UTF-8" action="<?php echo $this->forms['filter']->getAction(); ?>" method="<?php echo $this->forms['filter']->getMethod(); ?>"<?php echo $this->forms['filter']->getParametersHTML(); ?>>
						<?php echo $this->forms['filter']->getField('form')->parse();
						if($this->forms['filter']->getUseToken())
						{
							?><input type="hidden" name="form_token" id="<?php echo $this->forms['filter']->getField('form_token')->getAttribute('id'); ?>" value="<?php echo htmlspecialchars($this->forms['filter']->getField('form_token')->getValue()); ?>" />
						<?php } ?>
		<div class="dataFilter">
			<table>
				<tbody>
					<tr>
						<td>
							<div class="options">
								<p>
									<label for="email"><?php if(array_key_exists('lblEmail', (array) $this->variables)) { echo SpoonFilter::ucfirst($this->variables['lblEmail']); } else { ?>{$lblEmail|ucfirst}<?php } ?></label>
									<?php if(array_key_exists('txtEmail', (array) $this->variables)) { echo $this->variables['txtEmail']; } else { ?>{$txtEmail}<?php } ?> <?php if(array_key_exists('txtEmailError', (array) $this->variables)) { echo $this->variables['txtEmailError']; } else { ?>{$txtEmailError}<?php } ?>
								</p>
							</div>
						</td>
						<td>
							<div class="options">
								<p>
									<label for="status"><?php if(array_key_exists('lblStatus', (array) $this->variables)) { echo SpoonFilter::ucfirst($this->variables['lblStatus']); } else { ?>{$lblStatus|ucfirst}<?php } ?></label>
									<?php if(array_key_exists('ddmStatus', (array) $this->variables)) { echo $this->variables['ddmStatus']; } else { ?>{$ddmStatus}<?php } ?> <?php if(array_key_exists('ddmStatusError', (array) $this->variables)) { echo $this->variables['ddmStatusError']; } else { ?>{$ddmStatusError}<?php } ?>
								</p>
							</div>
						</td>
						<?php
					if(isset($this->variables['ddmGroup']) && count($this->variables['ddmGroup']) != 0 && $this->variables['ddmGroup'] != '' && $this->variables['ddmGroup'] !== false)
					{
						?>
							<td>
								<div class="options">
									<p>
										<label for="group"><?php if(array_key_exists('lblGroup', (array) $this->variables)) { echo SpoonFilter::ucfirst($this->variables['lblGroup']); } else { ?>{$lblGroup|ucfirst}<?php } ?></label>
										<?php if(array_key_exists('ddmGroup', (array) $this->variables)) { echo $this->variables['ddmGroup']; } else { ?>{$ddmGroup}<?php } ?> <?php if(array_key_exists('ddmGroupError', (array) $this->variables)) { echo $this->variables['ddmGroupError']; } else { ?>{$ddmGroupError}<?php } ?>
									</p>
								</div>
							</td>
						<?php } ?>
					</tr>
				</tbody>
				<tfoot>
					<tr>
						<td colspan="99">
							<div class="options">
								<div class="buttonHolder">
									<input id="search" class="inputButton button mainButton" type="submit" name="search" value="<?php if(array_key_exists('lblUpdateFilter', (array) $this->variables)) { echo SpoonFilter::ucfirst($this->variables['lblUpdateFilter']); } else { ?>{$lblUpdateFilter|ucfirst}<?php } ?>" />
								</div>
							</div>
						</td>
					</tr>
				</tfoot>
			</table>
		</div>
	</form>
				<?php } ?>

	<?php
					if(isset($this->variables['dgProfiles']) && count($this->variables['dgProfiles']) != 0 && $this->variables['dgProfiles'] != '' && $this->variables['dgProfiles'] !== false)
					{
						?>
		<form action="<?php if(array_key_exists('var', (array) $this->variables)) { echo Backend\Core\Engine\TemplateModifiers::getURL($this->variables['var'], 'mass_action'); } else { ?>{$var|geturl:'mass_action'}<?php } ?>" method="get" class="forkForms submitWithLink">
			<div>
				<input type="hidden" name="offset" value="<?php if(array_key_exists('offset', (array) $this->variables)) { echo $this->variables['offset']; } else { ?>{$offset}<?php } ?>" />
				<input type="hidden" name="order" value="<?php if(array_key_exists('order', (array) $this->variables)) { echo $this->variables['order']; } else { ?>{$order}<?php } ?>" />
				<input type="hidden" name="sort" value="<?php if(array_key_exists('sort', (array) $this->variables)) { echo $this->variables['sort']; } else { ?>{$sort}<?php } ?>" />
				<input type="hidden" name="email" value="<?php if(array_key_exists('email', (array) $this->variables)) { echo $this->variables['email']; } else { ?>{$email}<?php } ?>" />
				<input type="hidden" name="status" value="<?php if(array_key_exists('status', (array) $this->variables)) { echo $this->variables['status']; } else { ?>{$status}<?php } ?>" />
				<input type="hidden" name="newGroup" value="" />
			</div>
			<?php if(array_key_exists('dgProfiles', (array) $this->variables)) { echo $this->variables['dgProfiles']; } else { ?>{$dgProfiles}<?php } ?>
		</form>
	<?php } ?>

	<?php if(!isset($this->variables['dgProfiles']) || count($this->variables['dgProfiles']) == 0 || $this->variables['dgProfiles'] == '' || $this->variables['dgProfiles'] === false): ?>
		<p><?php if(array_key_exists('msgNoItems', (array) $this->variables)) { echo $this->variables['msgNoItems']; } else { ?>{$msgNoItems}<?php } ?></p>
	<?php endif; ?>
</div>

<div id="confirmDelete" title="<?php if(array_key_exists('lblDelete', (array) $this->variables)) { echo SpoonFilter::ucfirst($this->variables['lblDelete']); } else { ?>{$lblDelete|ucfirst}<?php } ?>?" style="display: none;">
	<p><?php if(array_key_exists('msgConfirmMassDelete', (array) $this->variables)) { echo $this->variables['msgConfirmMassDelete']; } else { ?>{$msgConfirmMassDelete}<?php } ?></p>
</div>
<div id="confirmAddToGroup" title="<?php if(array_key_exists('lblAddToGroup', (array) $this->variables)) { echo SpoonFilter::ucfirst($this->variables['lblAddToGroup']); } else { ?>{$lblAddToGroup|ucfirst}<?php } ?>?" style="display: none;">
	<p><?php if(array_key_exists('msgConfirmMassAddToGroup', (array) $this->variables)) { echo $this->variables['msgConfirmMassAddToGroup']; } else { ?>{$msgConfirmMassAddToGroup}<?php } ?></p>
	<div id="massAddToGroupListPlaceholder"></div>
</div>

<?php
				ob_start();
				?><?php if(array_key_exists('BACKEND_CORE_PATH', (array) $this->variables)) { echo $this->variables['BACKEND_CORE_PATH']; } else { ?>{$BACKEND_CORE_PATH}<?php } ?>/Layout/Templates/StructureEndModule.tpl<?php
				$include = eval('return \'' . str_replace('\'', '\\\'', ob_get_clean()) .'\';');
				if($this->getForceCompile() || !file_exists($this->getCompileDirectory() .'/' . $this->getCompileName($include, '/home/segaz/domains/techno-mir.net/public_html/src/Backend/Modules/Profiles/Layout/Templates'))) $this->compile('/home/segaz/domains/techno-mir.net/public_html/src/Backend/Modules/Profiles/Layout/Templates', $include);
				$return = @include $this->getCompileDirectory() .'/' . $this->getCompileName($include, '/home/segaz/domains/techno-mir.net/public_html/src/Backend/Modules/Profiles/Layout/Templates');
				if($return === false && $this->compile('/home/segaz/domains/techno-mir.net/public_html/src/Backend/Modules/Profiles/Layout/Templates', $include))
				{
					$return = @include $this->getCompileDirectory() .'/' . $this->getCompileName($include, '/home/segaz/domains/techno-mir.net/public_html/src/Backend/Modules/Profiles/Layout/Templates');
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
				if($this->getForceCompile() || !file_exists($this->getCompileDirectory() .'/' . $this->getCompileName($include, '/home/segaz/domains/techno-mir.net/public_html/src/Backend/Modules/Profiles/Layout/Templates'))) $this->compile('/home/segaz/domains/techno-mir.net/public_html/src/Backend/Modules/Profiles/Layout/Templates', $include);
				$return = @include $this->getCompileDirectory() .'/' . $this->getCompileName($include, '/home/segaz/domains/techno-mir.net/public_html/src/Backend/Modules/Profiles/Layout/Templates');
				if($return === false && $this->compile('/home/segaz/domains/techno-mir.net/public_html/src/Backend/Modules/Profiles/Layout/Templates', $include))
				{
					$return = @include $this->getCompileDirectory() .'/' . $this->getCompileName($include, '/home/segaz/domains/techno-mir.net/public_html/src/Backend/Modules/Profiles/Layout/Templates');
				}
if($return === false)
				{
					?>{include:<?php if(array_key_exists('BACKEND_CORE_PATH', (array) $this->variables)) { echo $this->variables['BACKEND_CORE_PATH']; } else { ?>{$BACKEND_CORE_PATH}<?php } ?>/Layout/Templates/Footer.tpl}<?php
				}
?>
