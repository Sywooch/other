<?php error_reporting(E_ALL | E_STRICT); ini_set('display_errors', 'On'); ?>


<section id="searchIndex" class="mod">
	<div class="inner">
		<header class="hd">
			<h4><?php if(array_key_exists('lblSearchAgain', (array) $this->variables)) { echo SpoonFilter::ucfirst($this->variables['lblSearchAgain']); } else { ?>{$lblSearchAgain|ucfirst}<?php } ?></h4>
		</header>
		<div class="bd">
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
						?> class="errorArea"<?php } ?>>
					<label for="q"><?php if(array_key_exists('lblSearchTerm', (array) $this->variables)) { echo SpoonFilter::ucfirst($this->variables['lblSearchTerm']); } else { ?>{$lblSearchTerm|ucfirst}<?php } ?><abbr title="<?php if(array_key_exists('lblRequiredField', (array) $this->variables)) { echo $this->variables['lblRequiredField']; } else { ?>{$lblRequiredField}<?php } ?>">*</abbr></label>
					<?php if(array_key_exists('txtQ', (array) $this->variables)) { echo $this->variables['txtQ']; } else { ?>{$txtQ}<?php } ?> <?php if(array_key_exists('txtQError', (array) $this->variables)) { echo $this->variables['txtQError']; } else { ?>{$txtQError}<?php } ?>
				</p>
				<p>
					<input id="submit" class="inputSubmit" type="submit" name="submit" value="<?php if(array_key_exists('lblSearch', (array) $this->variables)) { echo SpoonFilter::ucfirst($this->variables['lblSearch']); } else { ?>{$lblSearch|ucfirst}<?php } ?>" />
				</p>
			</form>
				<?php } ?>
		</div>
	</div>
</section>


<div id="searchContainer">
	<?php $includes = array();
                ob_start();
                ?>Modules/Search/Layout/Templates/Results.tpl<?php
                $includes[] = str_replace('//', '/', eval('return \'' . str_replace('\'', '\\\'', ob_get_clean()) .'\';'));
                ob_start();
                ?>/home/segaz/domains/techno-mir.net/public_html/app/../src/Frontend/Themes/Core/Modules/Search/Layout/Templates/Results.tpl<?php
                $includes[] = str_replace('//', '/', eval('return \'' . str_replace('\'', '\\\'', ob_get_clean()) .'\';'));
                ob_start();
                ?>/home/segaz/domains/techno-mir.net/public_html/app/../src/Frontend/Modules/Search/Layout/Templates/Results.tpl<?php
                $includes[] = str_replace('//', '/', eval('return \'' . str_replace('\'', '\\\'', ob_get_clean()) .'\';'));
                foreach($includes as $include) if(@file_exists($include) && is_file($include)) break;
                if($this->getForceCompile() || !file_exists($this->getCompileDirectory() .'/' . $this->getCompileName($include, '/home/segaz/domains/techno-mir.net/public_html/src/Frontend/Modules/Search/Layout/Templates'))) $this->compile('/home/segaz/domains/techno-mir.net/public_html/src/Frontend/Modules/Search/Layout/Templates', $include);
                $return = @include $this->getCompileDirectory() .'/' . $this->getCompileName($include, '/home/segaz/domains/techno-mir.net/public_html/src/Frontend/Modules/Search/Layout/Templates');
                if($return === false && $this->compile('/home/segaz/domains/techno-mir.net/public_html/src/Frontend/Modules/Search/Layout/Templates', $include)) {
                    $return = @include $this->getCompileDirectory() .'/' . $this->getCompileName($include, '/home/segaz/domains/techno-mir.net/public_html/src/Frontend/Modules/Search/Layout/Templates');
                }
if($return === false) {
                    ?>{include:Modules/Search/Layout/Templates/Results.tpl}<?php
                }
?>
</div>
