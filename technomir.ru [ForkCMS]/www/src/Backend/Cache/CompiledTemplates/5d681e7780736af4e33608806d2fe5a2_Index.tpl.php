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
	<h2>
		<?php if(array_key_exists('lblBlog', (array) $this->variables)) { echo SpoonFilter::ucfirst($this->variables['lblBlog']); } else { ?>{$lblBlog|ucfirst}<?php } ?>:

		<?php if(!isset($this->variables['filterCategory']) || count($this->variables['filterCategory']) == 0 || $this->variables['filterCategory'] == '' || $this->variables['filterCategory'] === false): ?><?php if(array_key_exists('lblArticles', (array) $this->variables)) { echo $this->variables['lblArticles']; } else { ?>{$lblArticles}<?php } ?><?php endif; ?>
		<?php
					if(isset($this->variables['filterCategory']) && count($this->variables['filterCategory']) != 0 && $this->variables['filterCategory'] != '' && $this->variables['filterCategory'] !== false)
					{
						?><?php if(array_key_exists('msgArticlesFor', (array) $this->variables) && isset($this->variables['filterCategory']) && array_key_exists('title', (array) $this->variables['filterCategory'])) { echo sprintf($this->variables['msgArticlesFor'], $this->variables['filterCategory']['title']); } else { ?>{$msgArticlesFor|sprintf:<?php if(isset($this->variables['filterCategory']) && array_key_exists('title', (array) $this->variables['filterCategory'])) { echo $this->variables['filterCategory']['title']; } else { ?>{$filterCategory.title}<?php } ?>}<?php } ?><?php } ?>
	</h2>

	<?php
					if(isset($this->variables['showBlogAdd']) && count($this->variables['showBlogAdd']) != 0 && $this->variables['showBlogAdd'] != '' && $this->variables['showBlogAdd'] !== false)
					{
						?>
	<div class="buttonHolderRight">
		<?php
					if(isset($this->variables['filterCategory']) && count($this->variables['filterCategory']) != 0 && $this->variables['filterCategory'] != '' && $this->variables['filterCategory'] !== false)
					{
						?><a href="<?php if(array_key_exists('var', (array) $this->variables) && isset($this->variables['filterCategory']) && array_key_exists('id', (array) $this->variables['filterCategory'])) { echo Backend\Core\Engine\TemplateModifiers::getURL($this->variables['var'], 'add', null, '&category=' . $this->variables['filterCategory']['id'] .''); } else { ?>{$var|geturl:'add':null:'&category=<?php if(isset($this->variables['filterCategory']) && array_key_exists('id', (array) $this->variables['filterCategory'])) { echo $this->variables['filterCategory']['id']; } else { ?>{$filterCategory.id}<?php } ?>'}<?php } ?>" class="button icon iconAdd" title="<?php if(array_key_exists('lblAdd', (array) $this->variables)) { echo SpoonFilter::ucfirst($this->variables['lblAdd']); } else { ?>{$lblAdd|ucfirst}<?php } ?>"><?php } ?>
		<?php if(!isset($this->variables['filterCategory']) || count($this->variables['filterCategory']) == 0 || $this->variables['filterCategory'] == '' || $this->variables['filterCategory'] === false): ?><a href="<?php if(array_key_exists('var', (array) $this->variables)) { echo Backend\Core\Engine\TemplateModifiers::getURL($this->variables['var'], 'add'); } else { ?>{$var|geturl:'add'}<?php } ?>" class="button icon iconAdd" title="<?php if(array_key_exists('lblAdd', (array) $this->variables)) { echo SpoonFilter::ucfirst($this->variables['lblAdd']); } else { ?>{$lblAdd|ucfirst}<?php } ?>"><?php endif; ?>
			<span><?php if(array_key_exists('lblAdd', (array) $this->variables)) { echo SpoonFilter::ucfirst($this->variables['lblAdd']); } else { ?>{$lblAdd|ucfirst}<?php } ?></span>
		</a>
	</div>
	<?php } ?>
</div>

<?php
					if(isset($this->forms['filter']))
					{
						?><form accept-charset="UTF-8" action="<?php echo $this->forms['filter']->getAction(); ?>" method="<?php echo $this->forms['filter']->getMethod(); ?>"<?php echo $this->forms['filter']->getParametersHTML(); ?>>
						<?php echo $this->forms['filter']->getField('form')->parse();
						if($this->forms['filter']->getUseToken())
						{
							?><input type="hidden" name="form_token" id="<?php echo $this->forms['filter']->getField('form_token')->getAttribute('id'); ?>" value="<?php echo htmlspecialchars($this->forms['filter']->getField('form_token')->getValue()); ?>" />
						<?php } ?>
	<p class="oneLiner">
		<label for="category"><?php if(array_key_exists('msgShowOnlyItemsInCategory', (array) $this->variables)) { echo $this->variables['msgShowOnlyItemsInCategory']; } else { ?>{$msgShowOnlyItemsInCategory}<?php } ?></label>
		&nbsp;<?php if(array_key_exists('ddmCategory', (array) $this->variables)) { echo $this->variables['ddmCategory']; } else { ?>{$ddmCategory}<?php } ?> <?php if(array_key_exists('ddmCategoryError', (array) $this->variables)) { echo $this->variables['ddmCategoryError']; } else { ?>{$ddmCategoryError}<?php } ?>
	</p>
</form>
				<?php } ?>

<?php
					if(isset($this->variables['dgRecent']) && count($this->variables['dgRecent']) != 0 && $this->variables['dgRecent'] != '' && $this->variables['dgRecent'] !== false)
					{
						?>
	<div class="dataGridHolder">
		<div class="tableHeading">
			<h3><?php if(array_key_exists('lblRecentlyEdited', (array) $this->variables)) { echo SpoonFilter::ucfirst($this->variables['lblRecentlyEdited']); } else { ?>{$lblRecentlyEdited|ucfirst}<?php } ?></h3>
		</div>
		<?php if(array_key_exists('dgRecent', (array) $this->variables)) { echo $this->variables['dgRecent']; } else { ?>{$dgRecent}<?php } ?>
	</div>
<?php } ?>

<?php
					if(isset($this->variables['dgDrafts']) && count($this->variables['dgDrafts']) != 0 && $this->variables['dgDrafts'] != '' && $this->variables['dgDrafts'] !== false)
					{
						?>
	<div class="dataGridHolder">
		<div class="tableHeading">
			<h3><?php if(array_key_exists('lblDrafts', (array) $this->variables)) { echo SpoonFilter::ucfirst($this->variables['lblDrafts']); } else { ?>{$lblDrafts|ucfirst}<?php } ?></h3>
		</div>
		<?php if(array_key_exists('dgDrafts', (array) $this->variables)) { echo $this->variables['dgDrafts']; } else { ?>{$dgDrafts}<?php } ?>
	</div>
<?php } ?>

<?php
					if(isset($this->variables['dgPosts']) && count($this->variables['dgPosts']) != 0 && $this->variables['dgPosts'] != '' && $this->variables['dgPosts'] !== false)
					{
						?>
	<div class="dataGridHolder">
		<div class="tableHeading">
			<h3><?php if(array_key_exists('lblPublishedArticles', (array) $this->variables)) { echo SpoonFilter::ucfirst($this->variables['lblPublishedArticles']); } else { ?>{$lblPublishedArticles|ucfirst}<?php } ?></h3>
		</div>
		<?php if(array_key_exists('dgPosts', (array) $this->variables)) { echo $this->variables['dgPosts']; } else { ?>{$dgPosts}<?php } ?>
	</div>
<?php } ?>

<?php if(!isset($this->variables['dgPosts']) || count($this->variables['dgPosts']) == 0 || $this->variables['dgPosts'] == '' || $this->variables['dgPosts'] === false): ?>
	<?php
					if(isset($this->variables['filterCategory']) && count($this->variables['filterCategory']) != 0 && $this->variables['filterCategory'] != '' && $this->variables['filterCategory'] !== false)
					{
						?><p><?php if(array_key_exists('msgNoItems', (array) $this->variables) && array_key_exists('var', (array) $this->variables) && isset($this->variables['filterCategory']) && array_key_exists('id', (array) $this->variables['filterCategory'])) { echo sprintf($this->variables['msgNoItems'], Backend\Core\Engine\TemplateModifiers::getURL($this->variables['var'], 'add', null, '&category=' . $this->variables['filterCategory']['id'] .'')); } else { ?>{$msgNoItems|sprintf:<?php if(array_key_exists('var', (array) $this->variables) && isset($this->variables['filterCategory']) && array_key_exists('id', (array) $this->variables['filterCategory'])) { echo Backend\Core\Engine\TemplateModifiers::getURL($this->variables['var'], 'add', null, '&category=' . $this->variables['filterCategory']['id'] .''); } else { ?>{$var|geturl:'add':null:'&category=<?php if(isset($this->variables['filterCategory']) && array_key_exists('id', (array) $this->variables['filterCategory'])) { echo $this->variables['filterCategory']['id']; } else { ?>{$filterCategory.id}<?php } ?>'}<?php } ?>}<?php } ?></p><?php } ?>
	<?php if(!isset($this->variables['filterCategory']) || count($this->variables['filterCategory']) == 0 || $this->variables['filterCategory'] == '' || $this->variables['filterCategory'] === false): ?><p><?php if(array_key_exists('msgNoItems', (array) $this->variables) && array_key_exists('var', (array) $this->variables)) { echo sprintf($this->variables['msgNoItems'], Backend\Core\Engine\TemplateModifiers::getURL($this->variables['var'], 'add')); } else { ?>{$msgNoItems|sprintf:<?php if(array_key_exists('var', (array) $this->variables)) { echo Backend\Core\Engine\TemplateModifiers::getURL($this->variables['var'], 'add'); } else { ?>{$var|geturl:'add'}<?php } ?>}<?php } ?></p><?php endif; ?>
<?php endif; ?>

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
