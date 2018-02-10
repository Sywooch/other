<?php error_reporting(0); ini_set('display_errors', 'Off'); ?>

<section id="searchIndex">
	<h4><?php echo SpoonFilter::ucfirst($this->variables['lblSearchAgain']); ?></h4>
		<div class="form-group">
			<?php
					if(isset($this->forms['search']))
					{
						?><form accept-charset="UTF-8" action="<?php echo $this->forms['search']->getAction(); ?>" method="<?php echo $this->forms['search']->getMethod(); ?>"<?php echo $this->forms['search']->getParametersHTML(); ?>>
						<?php echo $this->forms['search']->getField('form')->parse();
						if($this->forms['search']->getUseToken())
						{
							?><input type="hidden" name="form_token" id="<?php echo $this->forms['search']->getField('form_token')->getAttribute('id'); ?>" value="<?php echo htmlspecialchars($this->forms['search']->getField('form_token')->getValue()); ?>" />
						<?php } ?>
				<p<?php
					if(isset($this->variables['txtQError']) && count($this->variables['txtQError']) != 0 && $this->variables['txtQError'] != '' && $this->variables['txtQError'] !== false)
					{
						?> class="alert alert-danger"<?php } ?>>
					<label for="q"><?php echo SpoonFilter::ucfirst($this->variables['lblSearchTerm']); ?><abbr title="<?php echo $this->variables['lblRequiredField']; ?>">*</abbr></label>
					<?php echo $this->variables['txtQ']; ?> <?php echo $this->variables['txtQError']; ?>
				</p>
				<p>
					<input id="submit" class="inputSubmit btn btn-success" type="submit" name="submit" value="<?php echo SpoonFilter::ucfirst($this->variables['lblSearch']); ?>" />
				</p>
			</form>
				<?php } ?>
		</div>
</section>


<div id="searchContainer">
	<?php $includes = array();
                ob_start();
                ?>modules/search/layout/templates/results.tpl<?php
                $includes[] = str_replace('//', '/', eval('return \'' . str_replace('\'', '\\\'', ob_get_clean()) .'\';'));
                ob_start();
                ?>/home/segaz/domains/techno-mir.net/public_html/app/../src/Frontend/Themes/bootstrap/modules/search/layout/templates/results.tpl<?php
                $includes[] = str_replace('//', '/', eval('return \'' . str_replace('\'', '\\\'', ob_get_clean()) .'\';'));
                ob_start();
                ?>/home/segaz/domains/techno-mir.net/public_html/app/../src/Frontend/modules/search/layout/templates/results.tpl<?php
                $includes[] = str_replace('//', '/', eval('return \'' . str_replace('\'', '\\\'', ob_get_clean()) .'\';'));
                foreach($includes as $include) if(@file_exists($include) && is_file($include)) break;
                if($this->getForceCompile() || !file_exists($this->getCompileDirectory() .'/' . $this->getCompileName($include, '/home/segaz/domains/techno-mir.net/public_html/src/Frontend/Themes/bootstrap/Modules/Search/Layout/Templates'))) $this->compile('/home/segaz/domains/techno-mir.net/public_html/src/Frontend/Themes/bootstrap/Modules/Search/Layout/Templates', $include);
                $return = @include $this->getCompileDirectory() .'/' . $this->getCompileName($include, '/home/segaz/domains/techno-mir.net/public_html/src/Frontend/Themes/bootstrap/Modules/Search/Layout/Templates');
                if($return === false && $this->compile('/home/segaz/domains/techno-mir.net/public_html/src/Frontend/Themes/bootstrap/Modules/Search/Layout/Templates', $include)) {
                    $return = @include $this->getCompileDirectory() .'/' . $this->getCompileName($include, '/home/segaz/domains/techno-mir.net/public_html/src/Frontend/Themes/bootstrap/Modules/Search/Layout/Templates');
                }
?>
</div>