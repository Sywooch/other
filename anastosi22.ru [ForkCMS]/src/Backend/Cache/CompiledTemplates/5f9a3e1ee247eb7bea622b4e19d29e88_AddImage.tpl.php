<?php error_reporting(0); ini_set('display_errors', 'Off'); ?>
<?php
				ob_start();
				?><?php echo $this->variables['BACKEND_CORE_PATH']; ?>/Layout/Templates/Head.tpl<?php
				$include = eval('return \'' . str_replace('\'', '\\\'', ob_get_clean()) .'\';');
				if($this->getForceCompile() || !file_exists($this->getCompileDirectory() .'/' . $this->getCompileName($include, '/home/anastosi/domains/anastosi.ru/public_html/src/Backend/Modules/Slideshow/Layout/Templates'))) $this->compile('/home/anastosi/domains/anastosi.ru/public_html/src/Backend/Modules/Slideshow/Layout/Templates', $include);
				$return = @include $this->getCompileDirectory() .'/' . $this->getCompileName($include, '/home/anastosi/domains/anastosi.ru/public_html/src/Backend/Modules/Slideshow/Layout/Templates');
				if($return === false && $this->compile('/home/anastosi/domains/anastosi.ru/public_html/src/Backend/Modules/Slideshow/Layout/Templates', $include))
				{
					$return = @include $this->getCompileDirectory() .'/' . $this->getCompileName($include, '/home/anastosi/domains/anastosi.ru/public_html/src/Backend/Modules/Slideshow/Layout/Templates');
				}
?>
<?php
				ob_start();
				?><?php echo $this->variables['BACKEND_CORE_PATH']; ?>/Layout/Templates/StructureStartModule.tpl<?php
				$include = eval('return \'' . str_replace('\'', '\\\'', ob_get_clean()) .'\';');
				if($this->getForceCompile() || !file_exists($this->getCompileDirectory() .'/' . $this->getCompileName($include, '/home/anastosi/domains/anastosi.ru/public_html/src/Backend/Modules/Slideshow/Layout/Templates'))) $this->compile('/home/anastosi/domains/anastosi.ru/public_html/src/Backend/Modules/Slideshow/Layout/Templates', $include);
				$return = @include $this->getCompileDirectory() .'/' . $this->getCompileName($include, '/home/anastosi/domains/anastosi.ru/public_html/src/Backend/Modules/Slideshow/Layout/Templates');
				if($return === false && $this->compile('/home/anastosi/domains/anastosi.ru/public_html/src/Backend/Modules/Slideshow/Layout/Templates', $include))
				{
					$return = @include $this->getCompileDirectory() .'/' . $this->getCompileName($include, '/home/anastosi/domains/anastosi.ru/public_html/src/Backend/Modules/Slideshow/Layout/Templates');
				}
?>

<div class="pageTitle">
    <h2><?php echo SpoonFilter::ucfirst($this->variables['lblSlideshow']); ?>: <?php echo $this->variables['item']['title']; ?> (<?php echo $this->variables['item']['width']; ?> x <?php echo $this->variables['item']['height']; ?>)</h2>
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
    <div class="ui-tabs">
        <div class="ui-tabs-panel">
            <div class="options">
                <table border="0" cellspacing="0" cellpadding="0" width="100%">
                    <tr>
                        <td id="leftColumn">
                                <p>
                                    <label for="filename"><?php echo SpoonFilter::ucfirst($this->variables['lblImages']); ?></label>
                                    <?php
				if(isset(${'imageInput'})) $this->iterations['5f9a3e1ee247eb7bea622b4e19d29e88_AddImage.tpl.php_1']['old'] = ${'imageInput'};
				$this->iterations['5f9a3e1ee247eb7bea622b4e19d29e88_AddImage.tpl.php_1']['iteration'] = $this->variables['imageInput'];
				$this->iterations['5f9a3e1ee247eb7bea622b4e19d29e88_AddImage.tpl.php_1']['i'] = 1;
				$this->iterations['5f9a3e1ee247eb7bea622b4e19d29e88_AddImage.tpl.php_1']['count'] = count($this->iterations['5f9a3e1ee247eb7bea622b4e19d29e88_AddImage.tpl.php_1']['iteration']);
				foreach((array) $this->iterations['5f9a3e1ee247eb7bea622b4e19d29e88_AddImage.tpl.php_1']['iteration'] as ${'imageInput'})
				{
					if(!isset(${'imageInput'}['first']) && $this->iterations['5f9a3e1ee247eb7bea622b4e19d29e88_AddImage.tpl.php_1']['i'] == 1) ${'imageInput'}['first'] = true;
					if(!isset(${'imageInput'}['last']) && $this->iterations['5f9a3e1ee247eb7bea622b4e19d29e88_AddImage.tpl.php_1']['i'] == $this->iterations['5f9a3e1ee247eb7bea622b4e19d29e88_AddImage.tpl.php_1']['count']) ${'imageInput'}['last'] = true;
					if(isset(${'imageInput'}['formElements']) && is_array(${'imageInput'}['formElements']))
					{
						foreach(${'imageInput'}['formElements'] as $name => $object)
						{
							${'imageInput'}[$name] = $object->parse();
							${'imageInput'}[$name .'Error'] = (is_callable(array($object, 'getErrors')) && $object->getErrors() != '') ? '<span class="formError">' . $object->getErrors() .'</span>' : '';
						}
					} ?>
                                    <p>
                                    <?php echo ${'imageInput'}['Image']; ?> <?php echo ${'imageInput'}['ImageError']; ?>
                                    </p>
                                    <?php
					$this->iterations['5f9a3e1ee247eb7bea622b4e19d29e88_AddImage.tpl.php_1']['i']++;
				}
				if(isset($this->iterations['5f9a3e1ee247eb7bea622b4e19d29e88_AddImage.tpl.php_1']['old'])) ${'imageInput'} = $this->iterations['5f9a3e1ee247eb7bea622b4e19d29e88_AddImage.tpl.php_1']['old'];
				else unset($this->iterations['5f9a3e1ee247eb7bea622b4e19d29e88_AddImage.tpl.php_1']);
				?>
                        </td>
                        </td>
                    </tr>
                </table>
            </div>
        </div>

        <div class="fullwidthOptions">
            <div class="buttonHolderRight">
                <input id="editButton" class="inputButton button mainButton" type="submit" name="edit" value="<?php echo SpoonFilter::ucfirst($this->variables['lblAdd']); ?>" />
            </div>
        </div>
</form>
				<?php } ?>

<?php
				ob_start();
				?><?php echo $this->variables['BACKEND_CORE_PATH']; ?>/Layout/Templates/StructureEndModule.tpl<?php
				$include = eval('return \'' . str_replace('\'', '\\\'', ob_get_clean()) .'\';');
				if($this->getForceCompile() || !file_exists($this->getCompileDirectory() .'/' . $this->getCompileName($include, '/home/anastosi/domains/anastosi.ru/public_html/src/Backend/Modules/Slideshow/Layout/Templates'))) $this->compile('/home/anastosi/domains/anastosi.ru/public_html/src/Backend/Modules/Slideshow/Layout/Templates', $include);
				$return = @include $this->getCompileDirectory() .'/' . $this->getCompileName($include, '/home/anastosi/domains/anastosi.ru/public_html/src/Backend/Modules/Slideshow/Layout/Templates');
				if($return === false && $this->compile('/home/anastosi/domains/anastosi.ru/public_html/src/Backend/Modules/Slideshow/Layout/Templates', $include))
				{
					$return = @include $this->getCompileDirectory() .'/' . $this->getCompileName($include, '/home/anastosi/domains/anastosi.ru/public_html/src/Backend/Modules/Slideshow/Layout/Templates');
				}
?>
<?php
				ob_start();
				?><?php echo $this->variables['BACKEND_CORE_PATH']; ?>/Layout/Templates/Footer.tpl<?php
				$include = eval('return \'' . str_replace('\'', '\\\'', ob_get_clean()) .'\';');
				if($this->getForceCompile() || !file_exists($this->getCompileDirectory() .'/' . $this->getCompileName($include, '/home/anastosi/domains/anastosi.ru/public_html/src/Backend/Modules/Slideshow/Layout/Templates'))) $this->compile('/home/anastosi/domains/anastosi.ru/public_html/src/Backend/Modules/Slideshow/Layout/Templates', $include);
				$return = @include $this->getCompileDirectory() .'/' . $this->getCompileName($include, '/home/anastosi/domains/anastosi.ru/public_html/src/Backend/Modules/Slideshow/Layout/Templates');
				if($return === false && $this->compile('/home/anastosi/domains/anastosi.ru/public_html/src/Backend/Modules/Slideshow/Layout/Templates', $include))
				{
					$return = @include $this->getCompileDirectory() .'/' . $this->getCompileName($include, '/home/anastosi/domains/anastosi.ru/public_html/src/Backend/Modules/Slideshow/Layout/Templates');
				}
?>
